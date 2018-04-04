=== JSM's Show User Meta ===
Plugin Name: JSM's Show User Meta
Plugin Slug: jsm-show-user-meta
Text Domain: jsm-show-user-meta
Domain Path: /languages
License: GPLv3
License URI: https://www.gnu.org/licenses/gpl.txt
Assets URI: https://jsmoriss.github.io/jsm-show-user-meta/assets/
Tags: meta, user meta, inspector, custom fields, debug, tools
Contributors: jsmoriss
Requires PHP: 5.4
Requires At Least: 3.8
Tested Up To: 4.9.5
Stable Tag: 1.0.5

Show all user meta in a metabox on user editing pages -- great plugin for developers or debugging issues with user meta.

== Description ==

Wondering about the user meta your theme and/or plugins might be creating?

Want to find the name of a specific user meta key?

Need some help debugging your user meta?

The JSM's Show User Meta plugin displays all user meta keys and their unserialized values in a metabox at the bottom of user profile editing pages.

There are no plugin settings &mdash; simply install and activate the plugin.

= Power-users / Developers =

See the plugin [Other Notes](https://wordpress.org/plugins/jsm-show-user-meta/other_notes/) page for information on available filters.

= Related Plugins =

* [JSM's Show Post Meta](https://wordpress.org/plugins/jsm-show-post-meta/)
* [JSM's Show Term Meta](https://wordpress.org/plugins/jsm-show-term-meta/) (requires WordPress v4.4 or better)

== Installation ==

= Automated Install =

1. Go to the wp-admin/ section of your website.
1. Select the *Plugins* menu item.
1. Select the *Add New* sub-menu item.
1. In the *Search* box, enter the plugin name.
1. Click the *Search Plugins* button.
1. Click the *Install Now* link for the plugin.
1. Click the *Activate Plugin* link.

= Semi-Automated Install =

1. Download the plugin ZIP file.
1. Go to the wp-admin/ section of your website.
1. Select the *Plugins* menu item.
1. Select the *Add New* sub-menu item.
1. Click on *Upload* link (just under the Install Plugins page title).
1. Click the *Browse...* button.
1. Navigate your local folders / directories and choose the ZIP file you downloaded previously.
1. Click on the *Install Now* button.
1. Click the *Activate Plugin* link.

== Frequently Asked Questions ==

<h3>Frequently Asked Questions</h3>

* None

== Other Notes ==

<h3>Additional Documentation</h3>

**Developer Filters**

*'jsm_sum_view_cap' ( 'manage_options' )* &mdash; The current user must have these capabilities to view the "User Meta" metabox (default: 'manage_options' ).</p>

*'jsm_sum_screen_base' ( true, $screen_base )* &mdash; Add the "User Meta" metabox to the editing page for user screen base (example: 'user-edit', 'profile').</p>

*'jsm_sum_user_meta' ( $user_meta, $user_obj )* &mdash; The user meta array (unserialized) retrieved for display in the metabox.</p>

*'jsm_sum_skip_keys' ( $array )* &mdash; An array of key name regular expressions to ignore (default: '/^closedpostboxes_/', '/columnhidden$/', '/^meta-box-order_/', '/^metaboxhidden_/', and '/^screen_layout_/' ).</p>

== Screenshots ==

01. The User Meta metabox added to admin user profile pages.

== Changelog ==

<h3>Repositories</h3>

* [GitHub](https://jsmoriss.github.io/jsm-show-user-meta/)
* [WordPress.org](https://plugins.trac.wordpress.org/browser/jsm-show-user-meta/)

<h3>Version Numbering</h3>

Version components: `{major}.{minor}.{bugfix}[-{stage}.{level}]`

* {major} = Major structural code changes / re-writes or incompatible API changes.
* {minor} = New functionality was added or improved in a backwards-compatible manner.
* {bugfix} = Backwards-compatible bug fixes or small improvements.
* {stage}.{level} = Pre-production release: dev < a (alpha) < b (beta) < rc (release candidate).

<h3>Changelog / Release Notes</h3>

**Version 1.0.5 (2017/04/08)**

* *New Features*
	* None
* *Improvements*
	* None
* *Bugfixes*
	* None
* *Developer Notes*
	* Maintenance release.

== Upgrade Notice ==

= 1.0.5 =

(2017/04/08) Maintenance release.

