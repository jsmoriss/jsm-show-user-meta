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
 * Version: 1.0.1-1
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

class JSM_Show_User_Meta {

	private static $instance;

	public $view_cap;

	public static function &get_instance() {
		if ( ! isset( self::$instance ) ) {
			self::$instance = new self;
			self::setup_actions();
		}
		return self::$instance;
	}

	private function __construct() {
	}

	private static function setup_actions() {
		if ( ! is_admin() )
			return;

		add_action( 'edit_user_profile', 
			array( self::$instance, 'show_meta_boxes' ), 1000, 1 );

		add_action( 'show_user_profile', 
			array( self::$instance, 'show_meta_boxes' ), 1000, 1 );
	}

	public function show_meta_boxes( $user_obj ) {
		if ( ! isset( $user_obj->ID ) )	// just in case
			return;

		$this->view_cap = apply_filters( 'jsm_sum_view_cap', 'manage_options' );
		$screen = get_current_screen();

		if ( ! current_user_can( $this->view_cap, $user_obj->ID ) || 
			! apply_filters( 'jsm_sum_screen_base', true, $screen->base ) )
				return;

		add_meta_box( 'jsm-sum', 'User Meta', 
			array( &$this, 'show_user_meta' ), 'jsm-sum-user', 'normal', 'low' );

		echo '<h3 id="jsm-sum-metaboxes">Show User Meta</h3>';
		echo '<div id="poststuff">';
		do_meta_boxes( 'jsm-sum-user', 'normal', $user_obj );
		echo '</div><!-- .poststuff -->';
	}

	public function show_user_meta( $user_obj ) {
		if ( empty( $user_obj->ID ) )
			return;

		$user_meta = apply_filters( 'jsm_sum_user_meta', 
			get_user_meta( $user_obj->ID ), $user_obj );	// since wp v3.0

		$skip_keys = apply_filters( 'jsm_sum_skip_keys', 
			array(
				'closedpostboxes_',
				'meta-box-order_',
				'metaboxhidden_',
				'screen_layout_',
			)
		);

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
			div#jsm-sum.postbox table .key-column { 
				width:20%;
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
	return JSM_Show_User_Meta::get_instance();
}

add_action( 'plugins_loaded', 'jsm_show_user_meta' );
