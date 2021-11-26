<?php
/**
 * License: GPLv3
 * License URI: https://www.gnu.org/licenses/gpl.txt
 * Copyright 2012-2021 Jean-Sebastien Morisset (https://surniaulula.com/)
 */

if ( ! defined( 'ABSPATH' ) ) {

	die( 'These aren\'t the droids you\'re looking for.' );
}

if ( ! defined( 'JSMSUM_PLUGINDIR' ) ) {

	die( 'Do. Or do not. There is no try.' );
}

if ( ! class_exists( 'JsmSumUser' ) ) {

	class JsmSumUser {

		public function __construct() {

			add_action( 'edit_user_profile', array( $this, 'add_meta_boxes' ), 1000, 1 );

			add_action( 'show_user_profile', array( $this, 'add_meta_boxes' ), 1000, 1 );
		}

		public function add_meta_boxes( $user_obj ) {

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

			add_meta_box( $metabox_id, $metabox_title, array( $this, 'show_metabox' ), $metabox_screen, $metabox_context, $metabox_prio, $callback_args );

			echo '<h3 id="jsmsum-metaboxes">' . __( 'Show User Metadata', 'jsm-show-user-meta' ) . '</h3>';
			echo '<div id="poststuff">';

			do_meta_boxes( $metabox_screen, 'normal', $user_obj );

			echo '</div><!-- .poststuff -->';
		}

		public function show_metabox( $user_obj ) {

			echo $this->get_metabox( $user_obj );
		}

		public function get_metabox( $user_obj ) {

			if ( empty( $user_obj->ID ) ) {

				return;
			}

			$user_meta   = get_user_meta( $user_obj->ID );
			$skip_keys   = array( '/^closedpostboxes_/', '/columnshidden$/', '/^meta-box-order_/', '/^metaboxhidden_/', '/^screen_layout_/' );
			$metabox_id  = 'jsmsum';
			$key_title   = __( 'Key', 'jsm-show-user-meta' );
			$value_title = __( 'Value', 'jsm-show-user-meta' );

			return SucomUtilMetabox::get_table_metadata( $user_meta, $skip_keys, $user_obj, $metabox_id, $key_title, $value_title );
		}
	}
}
