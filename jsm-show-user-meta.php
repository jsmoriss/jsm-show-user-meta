<?php
/**
 * Plugin Name: JSM's Show User Meta
 * Text Domain: jsm-show-user-meta
 * Domain Path: /languages
 * Plugin URI: https://surniaulula.com/extend/plugins/jsm-show-user-meta/
 * Assets URI: https://jsmoriss.github.io/jsm-show-user-meta/assets/
 * Author: JS Morisset
 * Author URI: https://surniaulula.com/
 * License: GPLv3
 * License URI: http://www.gnu.org/licenses/gpl.txt
 * Description: Show all user meta (aka custom fields) keys and their unserialized values in a metabox on user profile editing pages.
 * Requires PHP: 5.6
 * Requires At Least: 3.9
 * Tested Up To: 5.3
 * Version: 1.0.5
 *
 * Version Numbering: {major}.{minor}.{bugfix}[-{stage}.{level}]
 *
 *      {major}         Major structural code changes / re-writes or incompatible API changes.
 *      {minor}         New functionality was added or improved in a backwards-compatible manner.
 *      {bugfix}        Backwards-compatible bug fixes or small improvements.
 *      {stage}.{level} Pre-production release: dev < a (alpha) < b (beta) < rc (release candidate).
 *
 * Copyright 2016-2019 Jean-Sebastien Morisset (https://surniaulula.com/)
 */

if ( ! defined( 'ABSPATH' ) ) {
	die( 'These aren\'t the droids you\'re looking for...' );
}

if ( ! class_exists( 'JSM_Show_User_Meta' ) ) {

	class JSM_Show_User_Meta {

		private static $instance;
		private static $wp_min_version = '3.9';
	
		public $view_cap;
	
		private function __construct() {
			if ( is_admin() ) {
				add_action( 'plugins_loaded', array( __CLASS__, 'load_textdomain' ) );
				add_action( 'admin_init', array( __CLASS__, 'check_wp_version' ) );	// Requires WP v3.9 or better.
				add_action( 'edit_user_profile', array( $this, 'show_meta_boxes' ), 1000, 1 );
				add_action( 'show_user_profile', array( $this, 'show_meta_boxes' ), 1000, 1 );
			}
		}
	
		public static function &get_instance() {

			if ( ! isset( self::$instance ) ) {
				self::$instance = new self;
			}

			return self::$instance;
		}
	
		public static function load_textdomain() {
			load_plugin_textdomain( 'jsm-show-user-meta', false, 'jsm-show-user-meta/languages/' );
		}

		public static function check_wp_version() {

			global $wp_version;

			if ( version_compare( $wp_version, self::$wp_min_version, '<' ) ) {

				$plugin = plugin_basename( __FILE__ );

				if ( is_plugin_active( $plugin ) ) {

					if ( ! function_exists( 'deactivate_plugins' ) ) {
						require_once trailingslashit( ABSPATH ) . 'wp-admin/includes/plugin.php';
					}

					$plugin_data = get_plugin_data( __FILE__, $markup = false );

					deactivate_plugins( $plugin, $silent = true );

					wp_die( 
						'<p>' . sprintf( __( '%1$s requires %2$s version %3$s or higher and has been deactivated.',
							'jsm-show-user-meta' ), $plugin_data['Name'], 'WordPress', self::$wp_min_version ) . '</p>' . 
						'<p>' . sprintf( __( 'Please upgrade %1$s before trying to re-activate the %2$s plugin.',
							'jsm-show-user-meta' ), 'WordPress', $plugin_data['Name'] ) . '</p>'
					);
				}
			}
		}

		public function show_meta_boxes( $user_obj ) {

			if ( ! isset( $user_obj->ID ) ) {	// Just in case.
				return;
			}
	
			$screen = get_current_screen();

			$this->view_cap = apply_filters( 'jsm_sum_view_cap', 'manage_options' );
	
			if ( ! current_user_can( $this->view_cap, $user_obj->ID ) || ! apply_filters( 'jsm_sum_screen_base', true, $screen->base ) ) {
				return;
			}

			$metabox_id      = 'jsm-sum';
			$metabox_title   = __( 'User Meta', 'jsm-show-user-meta' );
			$metabox_screen  = 'jsm-sum-user';
			$metabox_context = 'normal';
			$metabox_prio    = 'low';
			$callback_args   = array(	// Second argument passed to the callback function / method.
				'__block_editor_compatible_meta_box' => true,
			);

			add_meta_box( $metabox_id, $metabox_title,
				array( $this, 'show_user_meta' ), $metabox_screen,
					$metabox_context, $metabox_prio, $callback_args );
	
			echo '<h3 id="jsm-sum-metaboxes">' . __( 'Show User Meta', 'jsm-show-user-meta' ) . '</h3>';
			echo '<div id="poststuff">';

			do_meta_boxes( 'jsm-sum-user', 'normal', $user_obj );

			echo '</div><!-- .poststuff -->';
		}
	
		public function show_user_meta( $user_obj ) {

			if ( empty( $user_obj->ID ) ) {
				return;
			}
	
			$user_meta          = get_user_meta( $user_obj->ID );
			$user_meta_filtered = apply_filters( 'jsm_sum_user_meta', $user_meta, $user_obj );
			$skip_keys          = apply_filters( 'jsm_sum_skip_keys', array(
				'/^closedpostboxes_/',
				'/columnshidden$/',
				'/^meta-box-order_/',
				'/^metaboxhidden_/',
				'/^screen_layout_/',
			) );
	
			?>
			<style>
				div#jsm-sum.postbox table { 
					width:100%;
					max-width:100%;
					text-align:left;
					table-layout:fixed;
				}
				div#jsm-sum.postbox table .key-column { 
					width:30%;
				}
				div#jsm-stm.postbox table tr.added-meta { 
					background-color:#eee;
				}
				div#jsm-sum.postbox table td { 
					padding:10px;
					vertical-align:top;
					border:1px dotted #ccc;
				}
				div#jsm-sum.postbox table td div {
					overflow-x:auto;
				}
				div#jsm-sum.postbox table td div pre { 
					margin:0;
					padding:0;
				}
			</style>
			<?php
	
			echo '<table><thead><tr><th class="key-column">' . __( 'Key', 'jsm-show-user-meta' ) . '</th>' . "\n";
			echo '<th class="value-column">' . __( 'Value', 'jsm-show-user-meta' ) . '</th></tr></thead><tbody>' . "\n";
	
			ksort( $user_meta_filtered );

			foreach( $user_meta_filtered as $meta_key => $arr ) {

				foreach ( $skip_keys as $preg_dns ) {
					if ( preg_match( $preg_dns, $meta_key ) ) {
						continue 2;
					}
				}
	
				foreach ( $arr as $num => $el ) {
					$arr[ $num ] = maybe_unserialize( $el );
				}
	
				$is_added = isset( $post_meta[ $meta_key ] ) ? false : true;

				echo $is_added ? '<tr class="added-meta">' : '<tr>';
				echo '<td class="key-column"><div class="key-cell"><pre>' . esc_html( $meta_key ) . '</pre></div></td>';
				echo '<td class="value-column"><div class="value-cell"><pre>' . esc_html( var_export( $arr, true ) ) . '</pre></div></td></tr>' . "\n";
			}

			echo '</tbody></table>';
		}
	}

	JSM_Show_User_Meta::get_instance();
}
