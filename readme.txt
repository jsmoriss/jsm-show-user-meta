=== JSM's Show User Meta ===
Plugin Name: JSM's Show User Meta
Plugin Slug: jsm-show-user-meta
Contributors: jsmoriss
Tags: user meta, custom fields, tools
License: GPLv3
License URI: http://www.gnu.org/licenses/gpl.txt
Tested up to: 4.6
Requires At Least: 3.1
Stable tag: 1.0.0-1

Show all user meta (aka custom fields) keys and their unserialized values in a metabox on user profile editing pages.

== Description ==

<strong>Wondering about the user meta your theme and/or plugins might be creating?</strong>

<strong>Want to find the name of a specific user meta key?</strong>

<strong>Need some help debugging your user meta?</strong>

The JSM's Show User Meta plugin displays all user meta (aka custom fields) keys and their unserialized values in a metabox on the bottom of user profile editing pages.

= Available Filters =

<p> <code>jsm_sum_view_cap ( 'manage_options' )</code> &mdash; The current user must have these capabilities to view the "User Meta" metabox (default: 'manage_options' ).</p>

<p> <code>jsm_sum_screen_base ( true, $screen_base )</code> &mdash; Add the "User Meta" metabox to the editing page for user screen base (example: 'user-edit', 'profile').</p>

<p> <code>jsm_sum_user_meta ( $user_meta, $user_obj )</code> &mdash; The user meta array (unserialized) retrieved for display in the metabox.</p>

<p> <code>jsm_sum_skip_keys ( $array )</code> &mdash; An array of key name prefixes to ignore (default: 'closedpostboxes_', 'meta-box-order_', 'metaboxhidden_', and 'screen_layout_' ).</p>

== Installation ==

= Automated Install =

1. Go to the wp-admin/ section of your website
1. Select the *Plugins* menu item
1. Select the *Add New* sub-menu item
1. In the *Search* box, enter the plugin name
1. Click the *Search Plugins* button
1. Click the *Install Now* link for the plugin
1. Click the *Activate Plugin* link

= Semi-Automated Install =

1. Download the plugin archive file
1. Go to the wp-admin/ section of your website
1. Select the *Plugins* menu item
1. Select the *Add New* sub-menu item
1. Click on *Upload* link (just under the Install Plugins page title)
1. Click the *Browse...* button
1. Navigate your local folders / directories and choose the zip file you downloaded previously
1. Click on the *Install Now* button
1. Click the *Activate Plugin* link

== Frequently Asked Questions ==

= Frequently Asked Questions =

* None

== Other Notes ==

= Additional Documentation =

* None

== Screenshots ==

01. The User Meta metabox added to admin user profile pages.

== Changelog ==

= Repositories =

* [GitHub](https://github.com/jsmoriss/jsm-show-user-meta)
* [WordPress.org](https://wordpress.org/plugins/jsm-show-user-meta/developers/)

= Changelog / Release Notes =

**Version 1.0.0-1 (2016/07/30)**

* *New Features*
	* Initial release.
* *Improvements*
	* None
* *Bugfixes*
	* None
* *Developer Notes*
	* None

== Upgrade Notice ==

= 1.0.0-1 =

(2016/07/20) Initial release.

