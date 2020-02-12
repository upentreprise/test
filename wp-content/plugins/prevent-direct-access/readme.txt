=== Prevent Direct Access - Protect WordPress Files ===
Contributors: gaupoit, rexhoang, wpdafiles, buildwps
Donate link: https://preventdirectaccess.com/pricing/?utm_source=wordpress&utm_medium=plugin&utm_campaign=donation
Tags: protect files, protect videos, secure downloads, expiring links, protect wordpress files
Requires at least: 4.0
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html
Tested up to: 5.3
Stable tag: 2.2

A simple way to prevent search engines and the public from indexing and accessing your files without complex user authentication.

== Description ==

Prevent Direct Access provides a simple way to protect your WordPress files as well as prevent Google, other search engines and unwanted users from indexing and stealing your hard-to-produce ebooks, documents and videos.

We've created an intuitive user interface under Media library list view. It's simple and easy to use. So you'll be able to protect your private files in no time.

= An Inside Look at Prevent Direct Access Gold =
https://www.youtube.com/watch?v=37wP7TTcW4Q

Our Free version offers the following features:

= Protect Up to 3 Uploaded Files =
Prevent Direct Access is designed to protect all your WordPress media files such as images (PNG, JPEG), documents (PDF, DOCX) and videos (MP4) that you upload to your website via Media, Pages or Posts.

Once protected, they cannot be accessed directly anymore. Unwanted users will be redirected to your 404 not found page if they attempt to read and download these files using their original URL.

= Auto-generate Private URLs =
Once a WordPress file is protected, Prevent Direct Access will automatically generate a private download link containing random strings for you to access the file. This private download link is the ONLY way for you to access the protected file.

You can then copy that private download link to clipboard and subsequently paste it on your browsers and/or email by clicking on the Copy URL button.

= Block Google from Indexing your Files =
Prevent Direct Access explicitly tells Google and other search engines not to index any of your protected files so that their content and original URLs will never appear on the search results.

= Prevent Image Hotlinking =
Our plugin also stops others from stealing and using your images on their website by linking them directly from your website, which could slow down your website significantly.

= Protect Uploads Directory =
The `wp-content/uploads` folder where all your uploaded images and files are stored will also be protected. No one will be able to see and browse the content on that folder anymore.

> #### Gold Version
> Our [Gold version](https://preventdirectaccess.com/features/?utm_source=wp.org&utm_medium=plugin_desc_link&utm_campaign=pda_lite&utm_content=premium-after-gold-heading) offers more advanced features:
>
>* Protect unlimited files and all file types
>* Restrict protected file access to logged-in users
>* Search and replace unprotected URLs in content
>* Create & customize unlimited Private Donwload Links
>* Expire Private Download Links by days and clicks
>* Restrict access to your Private Download Links by IP Addresses
>* Integrate with Multisite, Amazon S3, and top membership plugins
>* Protect multiple files at once and many other premium features
>
> Check out our Gold version [now](https://preventdirectaccess.com/features/?utm_source=wp.org&utm_medium=plugin-desc&utm_campaign=pda_lite&utm_content=premium-after-gold-features).
>
> If you need any help with the plugin or want to request new features, feel free to contact us through [this form](https://preventdirectaccess.com/contact/?utm_source=wp.org&utm_medium=plugin_desc_link&utm_campaign=pda_lite&utm_content=contact-after-gold-features) or drop us an email at [hello@preventdirectaccess.com](mailto:hello@preventdirectaccess.com)


== Installation ==

There are 2 easy ways to install our plugin:

1.The standard way

- In your Admin, go to menu Plugins > Add

- Search for "Prevent Direct Access"

- Click to install

- Activate the plugin

- Protect your files under `Media` list view

2.The nerdy way

- Download the plugin (.zip file) on the right column of this page

- In your Admin, go to menu Plugins > Add

- Select the tab "Upload"

- Upload the .zip file you just downloaded

- Activate the plugin

- Protect your files under `Media` list view

== Frequently Asked Questions ==

= Why do I get this "Plugin could not be activated because it triggered a fatal error"? =
It's likely that you're using an outdated version of PHP. Please check and upgrade the PHP version on your server to 5.6 or greater.

In fact, WordPress itself even recommends your host supports PHP version 7.2 or greater for security purposes.

= Why nothing happens after I activate the plugin? =
Prevent Direct Access supports websites hosted on Apache servers out of the box.

In case you're using WP Engine or other NGINX server, please [check out this instruction](https://preventdirectaccess.com/docs/nginx-support/?utm_source=wp.org&utm_medium=plugin_desc_link&utm_campaign=pda_lite&utm_content=wpengine-on-faq) on how to update the server configuration so that our plugin (both Free & Gold version) will work correctly as expected.

= Why do I see a warning message on top after activating the plugin? =
The plugin needs to add some mod_rewrite rules to your website .htaccess file (located on your website root folder) to prevents direct access to your files on the server.

So it's likely that your .htaccess is not writable (with at least 644 permission; whose owner must be also accessable by your apache server such as `www-data`). If that's the case, you must either make it writable or manually update your .htaccess with the mod_rewrite rules found under Settings > Permalinks.

= Why do I see the popup box that says I can protect only 3 files? =
The free version of this plugin offers protection up to 3 files only. Please [check out our Gold version](https://preventdirectaccess.com/features/?utm_source=wp-plugin-repo&utm_medium=plugin-desc&utm_campaign=premium-on-faq) which offer unlimited protected files and other premium features.

More documentation can be found in [our FAQ](https://preventdirectaccess.com/faq/?utm_source=wp.org&utm_medium=plugin_desc_link&utm_campaign=pda_lite&utm_content=faq-on-faq).

== Screenshots ==
1. Once you have installed the plugin, please click Activate
2. Go to Media to protect your files. Prevent Direct Access works best on List View.
3. You will notice there an extra column called "Prevent Direct Access" auto-generated by our plugin. Click on "Configure file protection" to open a popup that allows you to protect your private file.
4. Click on "Protect this file" button on the popup.
5. The file is now "protected". Its File Access Permission is set to "No one" which means no one can access the file's original link anymore. The only way to access your private file is through this auto-generated private download link.
6. The free version of Prevent Direct Access only allows you to protect up to 3 files. An notification will show up when you try to protect more than 3 files. Check out our Gold version which offers unlimited file protection, custom file access permision and many other premium features.

== Changelog ==

= 2.5.1.2 February 5, 2020 =
* Improve UI: hide Like Plugin column in the settings page

= 2.5.1.1 November 16, 2019 =
* Fix add_submenu_page PHP notice issue

= 2.5.1 November 7, 2019 =
* Add feature "Prevent Image Hotlinking"
* Prevent Google Indexing for private links
* Fix file access permission when filename contains size

= 2.5.0.4 October 4, 2019 =
* Improve UI under settings page

= 2.5.0.3 August 9, 2019 =
* Update switch button under settings page
* Show notification when saving settings successfully

= 2.5.0.2 May 16, 2019 =
* Fix get lucky button

= 2.5.0.1 December 04, 2018 =
* Fix typo

= 2.5.0 November 18, 2018 =
* Revamp UI

= 2.4.0.1 August 10, 2018 =
* Hot fix [] array declaration cannot work under PHP version < 5.4

= 2.4.0 June 14, 2018 =
* Fix cannot remove rewrite rules when deactivate plugin

= 2.3.9 Tue, April 17, 2018 =
* Fix "This plugin is not properly prepared for localization"

= 2.3.8 Thu, April 12, 2018 =
* Apply localisation

= 2.3.7 Wed, February 28, 2018 =
* Test Wordpress 4.9.4

= 2.3.6 Wed, January 31, 2018 =
* Fix undefined index when get option FREE_PDA_SETTINGS

= 2.3.5 Fri, January 26, 2018 =
* Improve UI for settings page

= 2.3.4 Tue, January 23, 2018 =
* Improve UI on settings page by revamping checkbox option
* Integrate stop image hotlinking feature
* Show information in order to know whether the file is protected

= 2.3.3 Mon, January 8, 2018 =
* Revamp settings page

= 2.3.2 Wed, November 15, 2017 =
* Fix wp::prepare warning messages when using in WordPress version 4.8.3.

= 2.3.1: Sat, November 4, 2017 =
* Add warning messages when users are using deprecated wp api plugin.

= 2.3: Thu, August 17, 2017 =
* Protect files from search engine's index

= 2.2: Wed, June 14, 2017 =
* Add settings page

= 2.1.5: Thu, June 1, 2017 =
* Notify users to upgrade to Gold version
* Update plugin's data after users remove media files

= 2.1.4: Mon, May 22, 2017 =
* Change the way to get non-protected URL
* Redirect to default 404 page if the file is protected
* Support websites hosted on WP Engine

= 2.1.3: February 25, 2017 =
* Tweak: Change the plugin's logic to cater for those files that couldn't be found in the _postmeta table

= 2.1.2 =
* Fix Twitter, Googleplus and Facebook open graph issue

= 2.1.1 =
* Fix .htaccess rules to recognize the special characters
* Find in _postmeta table in case of cropped images via wordpress

== Upgrade Notice ==
N/A
