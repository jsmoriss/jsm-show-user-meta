<?php
/*
 * Plugin Name: JSM's Show User Meta
 * Plugin URI: http://wordpress.org/extend/plugins/jsm-show-user-meta/
 * Author: JS Morisset
 * Author URI: http://surniaulula.com/
 * License: GPLv3
 * License URI: http://www.gnu.org/licenses/gpl.txt
 * Description: Show all user meta (aka custom fields) keys and their unserialized values in a metabox on user profile pages.
 * Tested Up To: 4.6
 * Version: 1.0.0-1
 */

class JSM_Show_User_Meta {

	private static $instance;

	public $view_cap;

	public static function instance() {
		if ( ! isset( self::$instance ) ) {
			self::$instance = new JSM_Show_User_Meta;
			self::setup_actions();
		}
		return self::$instance;
	}

	private function __construct() {
	}

	private static function setup_actions() {
		add_action( 'edit_user_profile', array( self::$instance, 'show_meta_boxes' ), 30 );
		add_action( 'show_user_profile', array( self::$instance, 'show_meta_boxes' ), 30 );
	}

	public function show_meta_boxes( $user_obj ) {
		$this->view_cap = apply_filters( 'jsm_sum_view_cap', 'manage_options' );
		$screen = get_current_screen();

		if ( ! current_user_can( $this->view_cap, $user_obj->ID ) || 
			! apply_filters( 'jsm_sum_screen_base', '__return_true', $screen->base ) )
				return;

		add_meta_box( 'jsm-sum', 'User Meta', array( &$this, 'show_user_meta' ), 'user', 'normal', 'low' );

		echo '<div id="poststuff">';
		do_meta_boxes( 'user', 'normal', $user_obj );
		echo '</div><!-- .poststuff -->';
	}

	public function show_user_meta( $user_obj ) {
		if ( empty( $user_obj->ID ) )
			return;

		$user_meta = apply_filters( 'jsm_sum_user_meta', get_user_meta( $user_obj->ID ), $user_obj );
		$skip_keys = apply_filters( 'jsm_sum_skip_keys', array(
			'closedpostboxes_',
			'meta-box-order_',
			'metaboxhidden_',
			'screen_layout_',
		) );

		?>
		<style>
			div#jsm-sum.postbox table { 
				width:100%;
				max-width:100%;
				text-align:left;
			}
			div#jsm-sum.postbox table td { 
				padding:10px;
				vertical-align:top;
				border:1px dotted #ccc;
			}
			div#jsm-sum.postbox table td pre { 
				margin:0;
				padding:0;
				white-space:pre-wrap;
			}
		</style>
		<table><thead><tr><th class="key-column">Key</th>
		<th class="value-column">Value</th></tr></thead><tbody>
		<?php

		ksort( $user_meta );
		foreach( $user_meta as $key => $arr ) {
			foreach ( $skip_keys as $dnsw )
				if ( strpos( $key, $dnsw ) === 0 )
					continue 2;

			foreach ( $arr as $num => $el )
				$arr[$num] = maybe_unserialize( $el );

			echo '<tr><td class="key-column">'.esc_html( $key ).'</td>'.
				'<td class="value-column"><pre>'.
					esc_html( var_export( $arr, true ) ).'</pre></td></tr>';
		}
		echo '</tbody></table>';
	}
}

function jsm_show_user_meta() {
	return JSM_Show_User_Meta::instance();
}

add_action( 'plugins_loaded', 'jsm_show_user_meta' );

