<?php
/*
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
 * Requires At Least: 3.7
 * Tested Up To: 4.7
 * Version: 1.0.2-dev1
 *
 * Version Components: {major}.{minor}.{bugfix}-{stage}{level}
 *
 *	{major}		Major code changes / re-writes or significant feature changes.
 *	{minor}		New features / options were added or improved.
 *	{bugfix}	Bugfixes or minor improvements.
 *	{stage}{level}	dev < a (alpha) < b (beta) < rc (release candidate) < # (production).
 *
 * See PHP's version_compare() documentation at http://php.net/manual/en/function.version-compare.php.
 * 
 * This script is free software; you can redistribute it and/or modify it under
 * the terms of the GNU General Public License as published by the Free Software
 * Foundation; either version 3 of the License, or (at your option) any later
 * version.
 * 
 * This script is distributed in the hope that it will be useful, but WITHOUT ANY
 * WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS FOR A
 * PARTICULAR PURPOSE. See the GNU General Public License for more details at
 * http://www.gnu.org/licenses/.
 * 
 * Copyright 2016 Jean-Sebastien Morisset (https://surniaulula.com/)
 */

if ( ! defined( 'ABSPATH' ) ) 
	die( 'These aren\'t the droids you\'re looking for...' );

if ( ! class_exists( 'JSM_Show_User_Meta' ) ) {

	class JSM_Show_User_Meta {

		private static $instance;
		private static $wp_min_version = 3.7;
	
		public $view_cap;
	
		public static function &get_instance() {
			if ( ! isset( self::$instance ) )
				self::$instance = new self;
			return self::$instance;
		}
	
		private function __construct() {
			if ( is_admin() ) {
				load_plugin_textdomain( 'jsm-show-user-meta', false, 'jsm-show-user-meta/languages/' );

				add_action( 'admin_init', array( __CLASS__, 'check_wp_version' ) );
				add_action( 'edit_user_profile', array( &$this, 'show_meta_boxes' ), 1000, 1 );
				add_action( 'show_user_profile', array( &$this, 'show_meta_boxes' ), 1000, 1 );
			}
		}
	
		public static function check_wp_version() {
			global $wp_version;
			if ( version_compare( $wp_version, self::$wp_min_version, '<' ) ) {
				$plugin = plugin_basename( __FILE__ );
				if ( is_plugin_active( $plugin ) ) {
					require_once( ABSPATH.'wp-admin/includes/plugin.php' );	// just in case
					$plugin_data = get_plugin_data( __FILE__, false );	// $markup = false
					deactivate_plugins( $plugin );
					wp_die( 
						sprintf( __( '%1$s requires WordPress version %2$s or higher and has been deactivated.',
							'jsm-show-user-meta' ), $plugin_data['Name'], self::$wp_min_version ).'<br/><br/>'.
						sprintf( __( 'Please upgrade WordPress before trying to reactivate the %1$s plugin.',
							'jsm-show-user-meta' ), $plugin_data['Name'] )
					);
				}
			}
		}

		public function show_meta_boxes( $user_obj ) {
			if ( ! isset( $user_obj->ID ) )	// just in case
				return;
	
			$this->view_cap = apply_filters( 'jsm_sum_view_cap', 'manage_options' );
			$screen = get_current_screen();
	
			if ( ! current_user_can( $this->view_cap, $user_obj->ID ) || 
				! apply_filters( 'jsm_sum_screen_base', true, $screen->base ) )
					return;
	
			add_meta_box( 'jsm-sum', __( 'User Meta', 'jsm-show-user-meta' ),
				array( &$this, 'show_user_meta' ), 'jsm-sum-user', 'normal', 'low' );
	
			echo '<h3 id="jsm-sum-metaboxes">'.__( 'Show User Meta', 'jsm-show-term-meta' ).'</h3>';
			echo '<div id="poststuff">';
			do_meta_boxes( 'jsm-sum-user', 'normal', $user_obj );
			echo '</div><!-- .poststuff -->';
		}
	
		public function show_user_meta( $user_obj ) {
			if ( empty( $user_obj->ID ) )
				return;
	
			$user_meta = apply_filters( 'jsm_sum_user_meta', 
				get_user_meta( $user_obj->ID ), $user_obj );	// since wp v3.0
	
			$skip_keys = apply_filters( 'jsm_sum_skip_keys', array(
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
	
			echo '<table><thead><tr><th class="key-column">'.__( 'Key', 'jsm-show-user-meta' ).'</th>'."\n";
			echo '<th class="value-column">'.__( 'Value', 'jsm-show-user-meta' ).'</th></tr></thead><tbody>'."\n";
	
			ksort( $user_meta );
			foreach( $user_meta as $meta_key => $arr ) {
				foreach ( $skip_keys as $preg_dns )
					if ( preg_match( $preg_dns, $meta_key ) )
						continue 2;
	
				foreach ( $arr as $num => $el )
					$arr[$num] = maybe_unserialize( $el );
	
				echo '<tr><td class="key-column"><div class="key-cell"><pre>'.
					esc_html( $meta_key ).'</pre></div></td>';
				echo '<td class="value-column"><div class="value-cell"><pre>'.
					esc_html( var_export( $arr, true ) ).'</pre></div></td></tr>'."\n";
			}
			echo '</tbody></table>';
		}
	}

	JSM_Show_User_Meta::get_instance();
}

?>
