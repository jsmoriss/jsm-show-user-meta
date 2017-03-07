=== JSM's Show User Meta on User Editing Pages ===
Plugin Name: JSM's Show User Meta
Plugin Slug: jsm-show-user-meta
Text Domain: jsm-show-user-meta
Domain Path: /languages
License: GPLv3
License URI: https://www.gnu.org/licenses/gpl.txt
Donate Link: https://www.paypal.me/jsmoriss
Assets URI: https://jsmoriss.github.io/jsm-show-user-meta/assets/
Tags: meta, user meta, custom fields, debug, tools
Contributors: jsmoriss
Requires At Least: 3.8
Tested Up To: 4.7.3
Stable Tag: 1.0.3-1

Show all user meta (aka custom fields) keys and their unserialized values in a metabox on user profile editing pages.

== Description ==

<strong>Wondering about the user meta your theme and/or plugins might be creating?</strong>

<strong>Want to find the name of a specific user meta key?</strong>

<strong>Need some help debugging your user meta?</strong>

<p>The JSM's Show User Meta plugin displays all user meta (aka custom fields) keys and their unserialized values in a metabox at the bottom of user profile editing pages.</p>

<blockquote>
<p>There are no plugin settings &mdash; simply install and activate the plugin.</p>
</blockquote>

= Developers =

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

1. Download the plugin archive file.
1. Go to the wp-admin/ section of your website.
1. Select the *Plugins* menu item.
1. Select the *Add New* sub-menu item.
1. Click on *Upload* link (just under the Install Plugins page title).
1. Click the *Browse...* button.
1. Navigate your local folders / directories and choose the zip file you downloaded previously.
1. Click on the *Install Now* button.
1. Click the *Activate Plugin* link.

== Frequently Asked Questions ==

= Frequently Asked Questions =

* None

== Other Notes ==

= Additional Documentation =

**Developer Filters**

*'jsm_sum_view_cap' ( 'manage_options' )* &mdash; The current user must have these capabilities to view the "User Meta" metabox (default: 'manage_options' ).</p>

*'jsm_sum_screen_base' ( true, $screen_base )* &mdash; Add the "User Meta" metabox to the editing page for user screen base (example: 'user-edit', 'profile').</p>

*'jsm_sum_user_meta' ( $user_meta, $user_obj )* &mdash; The user meta array (unserialized) retrieved for display in the metabox.</p>

*'jsm_sum_skip_keys' ( $array )* &mdash; An array of key name regular expressions to ignore (default: '/^closedpostboxes_/', '/columnhidden$/', '/^meta-box-order_/', '/^metaboxhidden_/', and '/^screen_layout_/' ).</p>

== Screenshots ==

01. The User Meta metabox added to admin user profile pages.

== Changelog ==

= Repositories =

* [GitHub](https://jsmoriss.github.io/jsm-show-user-meta/)
* [WordPress.org](https://wordpress.org/plugins/jsm-show-user-meta/developers/)

= Version Numbering Scheme =

Version components: `{major}.{minor}.{bugfix}-{stage}{level}`

* {major} = Major code changes / re-writes or significant feature changes.
* {minor} = New features / options were added or improved.
* {bugfix} = Bugfixes or minor improvements.
* {stage}{level} = dev &lt; a (alpha) &lt; b (beta) &lt; rc (release candidate) &lt; # (production).

Note that the production stage level can be incremented on occasion for simple text revisions and/or translation updates. See [PHP's version_compare()](http://php.net/manual/en/function.version-compare.php) documentation for additional information on "PHP-standardized" version numbering.

= Changelog / Release Notes =

**Version 1.0.3-1 (2016/12/28)**

* *New Features*
	* None
* *Improvements*
	* Highlighted new user meta rows added by the 'jsm_sum_user_meta' filters.
* *Bugfixes*
	* None
* *Developer Notes*
	* None

**Version 1.0.2-1 (2016/12/23)**

* *New Features*
	* None
* *Improvements*
	* Added French translation of labels and notices.
	* Updated CSS to scroll overflow of meta values.
* *Bugfixes*
	* None
* *Developer Notes*
	* Maintenance release - minor refactoring of code.

**Version 1.0.1-1 (2016/08/04)**

* *New Features*
	* Initial release.
* *Improvements*
	* Added check for is_admin() before hooking actions and filters.
	* Added 20% width in CSS for the key column.
* *Bugfixes*
	* None
* *Developer Notes*
	* None

== Upgrade Notice ==

= 1.0.3-1 =

(2016/12/28) Highlighted new user meta rows added by the 'jsm_sum_user_meta' filters.

= 1.0.2-1 =

(2016/12/23) Maintenance release - minor refactoring of code. Added French translation of labels and notices. Updated CSS to scroll overflow of meta values.

= 1.0.1-1 =

(2016/08/04) Added check for is_admin() before hooking actions and filters. Added 20% width in CSS for the key column.

