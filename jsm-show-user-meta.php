<?php
/**
 * Plugin Name: JSM's Show User Metadata
 * Text Domain: jsm-show-user-meta
 * Domain Path: /languages
 * Plugin URI: https://surniaulula.com/extend/plugins/jsm-show-user-meta/
 * Assets URI: https://jsmoriss.github.io/jsm-show-user-meta/assets/
 * Author: JS Morisset
 * Author URI: https://surniaulula.com/
 * License: GPLv3
 * License URI: https://www.gnu.org/licenses/gpl.txt
 * Description: Show all user meta (aka custom fields) keys and their unserialized values in a metabox on user profile editing pages.
 * Requires PHP: 7.2
 * Requires At Least: 5.2
 * Tested Up To: 5.8.2
 * Version: 2.0.0-dev.2
 *
 * Version Numbering: {major}.{minor}.{bugfix}[-{stage}.{level}]
 *
 *      {major}         Major structural code changes / re-writes or incompatible API changes.
 *      {minor}         New functionality was added or improved in a backwards-compatible manner.
 *      {bugfix}        Backwards-compatible bug fixes or small improvements.
 *      {stage}.{level} Pre-production release: dev < a (alpha) < b (beta) < rc (release candidate).
 *
 * Copyright 2016-2021 Jean-Sebastien Morisset (https://surniaulula.com/)
 */

if ( ! defined( 'ABSPATH' ) ) {

	die( 'These aren\'t the droids you\'re looking for.' );
}

if ( ! class_exists( 'JsmShowUserMeta' ) ) {

	class JsmShowUserMeta {

		private static $instance = null;	// JsmShowUserMeta class object.

		private function __construct() {

			if ( is_admin() ) {

				add_action( 'plugins_loaded', array( $this, 'init_textdomain' ) );

				add_action( 'edit_user_profile', array( $this, 'show_meta_boxes' ), 1000, 1 );

				add_action( 'show_user_profile', array( $this, 'show_meta_boxes' ), 1000, 1 );
			}
		}

		public static function &get_instance() {

			if ( null === self::$instance ) {

				self::$instance = new self;
			}

			return self::$instance;
		}

		public function init_textdomain() {

			load_plugin_textdomain( 'jsm-show-user-meta', false, 'jsm-show-user-meta/languages/' );
		}

		public function show_meta_boxes( $user_obj ) {

			if ( ! isset( $user_obj->ID ) ) {	// Just in case.

				return;
			}

			$screen = get_current_screen();

			$view_cap = apply_filters( 'jsmsum_view_cap', 'manage_options' );

			if ( ! current_user_can( $view_cap, $user_obj->ID ) ) {

				return;
			
			} elseif ( ! apply_filters( 'jsmsum_screen_base', true, $screen->base ) ) {

				return;
			}

			$metabox_id      = 'jsmsum';
			$metabox_title   = __( 'User Metadata', 'jsm-show-user-meta' );
			$metabox_screen  = 'jsm-show-user-meta';
			$metabox_context = 'normal';
			$metabox_prio    = 'low';
			$callback_args   = array(	// Second argument passed to the callback function / method.
				'__block_editor_compatible_meta_box' => true,
			);

			add_meta_box( $metabox_id, $metabox_title, array( $this, 'show_user_metadata' ), $metabox_screen, $metabox_context, $metabox_prio, $callback_args );

			echo '<h3 id="jsmsum-metaboxes">' . __( 'Show User Metadata', 'jsm-show-user-meta' ) . '</h3>';

			echo '<div id="poststuff">';

			do_meta_boxes( 'jsm-show-user-meta', 'normal', $user_obj );

			echo '</div><!-- .poststuff -->';
		}

		public function show_user_metadata( $user_obj ) {

			if ( empty( $user_obj->ID ) ) {

				return;
			}

			$user_meta            = get_user_meta( $user_obj->ID );
			$user_meta_filtered   = apply_filters( 'jsmsum_user_meta', $user_meta, $user_obj );
			$skip_keys_preg_match = apply_filters( 'jsmsum_skip_keys', array(
				'/^closedpostboxes_/',
				'/columnshidden$/',
				'/^meta-box-order_/',
				'/^metaboxhidden_/',
				'/^screen_layout_/',
			) );

			?>
			<style type="text/css">
				div#jsmsum.postbox table {
					width:100%;
					max-width:100%;
					text-align:left;
					table-layout:fixed;
				}
				div#jsmsum.postbox table .key-column {
					width:30%;
				}
				div#jsmsum.postbox table tr.added-meta {
					background-color:#eee;
				}
				div#jsmsum.postbox table td {
					padding:10px;
					vertical-align:top;
					border:1px dotted #ccc;
				}
				div#jsmsum.postbox table td div {
					overflow-x:auto;
				}
				div#jsmsum.postbox table td div pre {
					margin:0;
					padding:0;
				}
			</style>
			<?php

			echo '<table><thead><tr><th class="key-column">' . __( 'Key', 'jsm-show-user-meta' ) . '</th>' . "\n";

			echo '<th class="value-column">' . __( 'Value', 'jsm-show-user-meta' ) . '</th></tr></thead><tbody>' . "\n";

			ksort( $user_meta_filtered );

			foreach( $user_meta_filtered as $meta_key => $arr ) {

				foreach ( $skip_keys_preg_match as $preg_expr ) {

					if ( preg_match( $preg_expr, $meta_key ) ) {

						continue 2;
					}
				}

				if ( is_array( $arr ) ) {	// Just in case.

					foreach ( $arr as $num => $el ) {

						$arr[ $num ] = maybe_unserialize( $el );
					}
				}

				$is_added = isset( $post_meta[ $meta_key ] ) ? false : true;

				echo $is_added ? '<tr class="added-meta">' : '<tr>';

				echo '<td class="key-column"><div class="key-cell"><pre>' . esc_html( $meta_key ) . '</pre></div></td>';

				echo '<td class="value-column"><div class="value-cell"><pre>' . esc_html( var_export( $arr, true ) ) . '</pre></div></td></tr>' . "\n";
			}

			echo '</tbody></table>';
		}
	}

	JsmShowUserMeta::get_instance();
}
