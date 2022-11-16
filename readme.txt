=== JSM's Show User Metadata ===
Plugin Name: JSM's Show User Metadata
Plugin Slug: jsm-show-user-meta
Text Domain: jsm-show-user-meta
Domain Path: /languages
License: GPLv3
License URI: https://www.gnu.org/licenses/gpl.txt
Assets URI: https://jsmoriss.github.io/jsm-show-user-meta/assets/
Tags: meta, user meta, profile meta, delete, debug, inspector
Contributors: jsmoriss
Requires PHP: 7.2
Requires At Least: 5.2
Tested Up To: 6.1.1
Stable Tag: 3.0.6

Show user metadata in a metabox when editing users - a great tool for debugging issues with user metadata.

== Description ==

**The JSM's Show User Metadata plugin displays user profile meta keys and their unserialized values in a metabox at the bottom of user profile editing pages.**

The current user must have the [WordPress *manage_options* capability](https://wordpress.org/support/article/roles-and-capabilities/#manage_options) (allows access to administration options) to view the User Metadata metabox, and the *manage_options* capability to delete individual meta keys.

The default *manage_options* capability can be modified using the 'jsmsum_show_metabox_capability' and 'jsmsum_delete_meta_capability' filters (see filters.txt in the plugin folder).

There are no plugin settings - simply install and activate the plugin.

= Related Plugins =

* [JSM's Show Comment Metadata](https://wordpress.org/plugins/jsm-show-comment-meta/)
* [JSM's Show Post Metadata](https://wordpress.org/plugins/jsm-show-post-meta/)
* [JSM's Show Term Metadata](https://wordpress.org/plugins/jsm-show-term-meta/)
* [JSM's Show Registered Shortcodes](https://wordpress.org/plugins/jsm-show-registered-shortcodes/)

== Installation ==

== Frequently Asked Questions ==

== Screenshots ==

01. The "User Metadata" metabox added to admin user profile pages.

== Changelog ==

<h3 class="top">Version Numbering</h3>

Version components: `{major}.{minor}.{bugfix}[-{stage}.{level}]`

* {major} = Major structural code changes and/or incompatible API changes (ie. breaking changes).
* {minor} = New functionality was added or improved in a backwards-compatible manner.
* {bugfix} = Backwards-compatible bug fixes or small improvements.
* {stage}.{level} = Pre-production release: dev < a (alpha) < b (beta) < rc (release candidate).

<h3>Repositories</h3>

* [GitHub](https://jsmoriss.github.io/jsm-show-user-meta/)
* [WordPress.org](https://plugins.trac.wordpress.org/browser/jsm-show-user-meta/)

<h3>Changelog / Release Notes</h3>

**Version 3.0.6 (2022/10/20)**

* **New Features**
	* None.
* **Improvements**
	* None.
* **Bugfixes**
	* None.
* **Developer Notes**
	* Update for SucomUtil and SucomUtilWP library class.
* **Requires At Least**
	* PHP v7.2.
	* WordPress v5.2.

**Version 3.0.5 (2022/05/26)**

* **New Features**
	* None.
* **Improvements**
	* None.
* **Bugfixes**
	* None.
* **Developer Notes**
	* Update for SucomUtil library class.
* **Requires At Least**
	* PHP v7.2.
	* WordPress v5.2.

**Version 3.0.4 (2022/05/09)**

* **New Features**
	* None.
* **Improvements**
	* None.
* **Bugfixes**
	* Fixed missing `SucomCountryCodes` class for country related methods in `SucomUtil`.
* **Developer Notes**
	* None.
* **Requires At Least**
	* PHP v7.2.
	* WordPress v5.2.

**Version 3.0.3 (2022/03/18)**

* **New Features**
	* None.
* **Improvements**
	* None.
* **Bugfixes**
	* None.
* **Developer Notes**
	* Updated the sucom class library files.
* **Requires At Least**
	* PHP v7.2.
	* WordPress v5.2.

**Version 3.0.2 (2021/12/10)**

* **New Features**
	* None.
* **Improvements**
	* Added a `trim()` to the returned CSS id after successful delete, in case the ajax return is corrupted with a space or newline.
* **Bugfixes**
	* None.
* **Developer Notes**
	* None.
* **Requires At Least**
	* PHP v7.2.
	* WordPress v5.2.

**Version 3.0.1 (2021/12/09)**

* **New Features**
	* None.
* **Improvements**
	* None.
* **Bugfixes**
	* Fixed a missing table column if there is no metadata and allowed to delete meta is true.
* **Developer Notes**
	* Updated `SucomUtilMetabox::get_table_metadata()` to add a missing empty delete column if `$row_count` is 0.
* **Requires At Least**
	* PHP v7.2.
	* WordPress v5.2.

**Version 3.0.0 (2021/11/30)**

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

= 3.0.6 =

(2022/10/20) Update for SucomUtil and SucomUtilWP library class.

= 3.0.5 =

(2022/05/26) Update for SucomUtil library class.

= 3.0.4 =

(2022/05/09) Fixed missing `SucomCountryCodes` class for country related methods in `SucomUtil`.

= 3.0.3 =

(2022/03/18) Updated the sucom class library files.

= 3.0.2 =

(2021/12/10) Added a `trim()` to the returned CSS id after successful delete, in case the ajax return is corrupted with a space or newline.

= 3.0.1 =

(2021/12/09) Fixed a missing table column if there is no metadata and allowed to delete meta is true.

= 3.0.0 =

(2021/11/30) Added the ability to delete individual user meta.

= 2.0.0 =

(2021/11/26) Complete rewrite of the plugin - all class, method, and filter names have changed.

