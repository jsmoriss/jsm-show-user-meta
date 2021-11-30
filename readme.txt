=== JSM's Show User Metadata ===
Plugin Name: JSM's Show User Metadata
Plugin Slug: jsm-show-user-meta
Text Domain: jsm-show-user-meta
Domain Path: /languages
License: GPLv3
License URI: https://www.gnu.org/licenses/gpl.txt
Assets URI: https://jsmoriss.github.io/jsm-show-user-meta/assets/
Tags: meta, user meta, profile meta, delete, debug
Contributors: jsmoriss
Requires PHP: 7.2
Requires At Least: 5.2
Tested Up To: 5.8.2
Stable Tag: 2.0.0

Show user metadata in a metabox when editing users - a great tool for debugging issues with user metadata.

== Description ==

The JSM's Show User Metadata plugin displays user profile meta keys and their unserialized values in a metabox at the bottom of user profile editing pages.

By default, the current user needs to have the 'manage_options' capability to view the User Metadata metabox, and the 'manage_options' capability to delete individual meta keys. The default 'manage_options' capability can be modified using the 'jsmsum_show_metabox_capability' and 'jsmsum_delete_meta_capability' filters (see filters.txt in the plugin folder).

There are no plugin settings - simply *install* and *activate* the plugin.

= Related Plugins =

* [JSM's Show Comment Metadata](https://wordpress.org/plugins/jsm-show-comment-meta/)
* [JSM's Show Post Metadata](https://wordpress.org/plugins/jsm-show-post-meta/)
* [JSM's Show Term Metadata](https://wordpress.org/plugins/jsm-show-term-meta/)
* [JSM's Show Registered Shortcodes](https://wordpress.org/plugins/jsm-show-registered-shortcodes/)

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

== Screenshots ==

01. The "User Metadata" metabox added to admin user profile pages.

== Changelog ==

<h3 class="top">Version Numbering</h3>

Version components: `{major}.{minor}.{bugfix}[-{stage}.{level}]`

* {major} = Major structural code changes / re-writes or incompatible API changes.
* {minor} = New functionality was added or improved in a backwards-compatible manner.
* {bugfix} = Backwards-compatible bug fixes or small improvements.
* {stage}.{level} = Pre-production release: dev < a (alpha) < b (beta) < rc (release candidate).

<h3>Repositories</h3>

* [GitHub](https://jsmoriss.github.io/jsm-show-user-meta/)
* [WordPress.org](https://plugins.trac.wordpress.org/browser/jsm-show-user-meta/)

<h3>Changelog / Release Notes</h3>

**Version 3.0.0-rc.1 (2021/11/30)**

* **New Features**
	* Added the ability to delete individual user meta.
* **Improvements**
	* None.
* **Bugfixes**
	* None.
* **Developer Notes**
	* None.
* **Requires At Least**
	* PHP v7.2.
	* WordPress v5.2.

**Version 2.0.0 (2021/11/26)**

* **New Features**
	* None.
* **Improvements**
	* None.
* **Bugfixes**
	* None.
* **Developer Notes**
	* Complete rewrite of the plugin - all class, method, and filter names have changed.
* **Requires At Least**
	* PHP v7.2.
	* WordPress v5.2.

== Upgrade Notice ==

= 3.0.0-rc.1 =

(2021/11/30) Added the ability to delete individual user meta.

= 2.0.0 =

(2021/11/26) Complete rewrite of the plugin - all class, method, and filter names have changed.

