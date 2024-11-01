=== WP-TwitterBadge ===
Contributors: kyleabaker
Donate Link: https://www.paypal.com/cgi-bin/webscr?cmd=_xclick&business=3S4Q4FH7BH9EG&item_name=Wordpress%20Plugin%20(WP-TwitterBadge)&no_shipping=1&no_note=1&tax=0&currency_code=USD&bn=PP%2dDonationsBF&charset=UTF%2d8&lc=US
Tags: twitter,badge,link,social,follow,friend,tweet
Requires at least: 2.0
Tested up to: 4.8
Stable tag: 1.0

== Description ==

*WP-TwitterBadge* is a simple plugin that allows you to display a Twitter &quot;Follow&quot; Badge on your site or blog.

It uses the Twitter &quot;Follow&quot; Badge that is provided by [go2web20.net](http://www.go2web20.net/twitterFollowBadge/). This plugin takes the hassel out of having to manually edit the details and enter it into your theme each time you change themes.

I'm providing this plugin as it is since this Twitter Badge is actually written and maintained by [go2web20.net](http://www.go2web20.net/twitterFollowBadge/). However, I will be fixing bugs that are found in the plugin and updating with updates from [go2web20.net](http://www.go2web20.net/twitterFollowBadge/). That being said, your feedback is very important!

I do not claim ownership of any part(s) of the included &quot;badge.js&quot; Javascript file as it belongs to [go2web20.net](http://www.go2web20.net/twitterFollowBadge/). This javascript file is provided via this plugin as is and with no modification.

*WP-TwitterBadge* was written with Geany - [http://www.geany.org/](http://www.geany.org/)

== Installation ==

1. **Upload** the "wp-twitterbadge" folder to /wp-contents/plugins/
1. **Login** to your WordPress Admin menu, go to Plugins, and activate it.
1. In your WordPress Admin menu, you will find a new menu under **Settings** called WP-TwitterBadge. There you can choose the Twitter account to link to, label on the badge, color, side of page to display on and how far from the top to display it.

== Frequently Asked Questions ==

* How can I help?

You can help in a number of ways:

1. If you find a bug/issue, report it!
1. Speak another language? Help me [translate this plugin](https://translate.wordpress.org/projects/wp-plugins/wp-twitterbadge)!
1. Help me keep the lights on! [Donations are always appreciated](https://www.paypal.com/cgi-bin/webscr?cmd=_xclick&business=3S4Q4FH7BH9EG&item_name=Wordpress%20Plugin%20(WP-TwitterBadge)&no_shipping=1&no_note=1&tax=0&currency_code=USD&bn=PP%2dDonationsBF&charset=UTF%2d8&lc=US), large or small!

* Will you be taking feature suggestions?

No. I am only providing this plugin with the Twitter Badge script. I did not write the Twitter Badge script that is embeded with this plugin so I cannot maintain it or add features (ethically). ;) Sorry.

If you have any other questions, please don't hesitate to ask me! The easiest way to ask me a question, comment or suggest something is to post it in the comments on the [plugin homepage](https://www.kyleabaker.com/goodies/coding/wp-twiterbadge/).

If you have any questions, please don't hesitate to ask me! The easiest way to ask me a question, comment or suggest something is to post it in the comments on the [plugin homepage](https://wwww.kyleabaker.com/goodies/coding/wp-twitterbadge/).

== Screenshots ==

Screenshots are available at the plugin [plugin homepage](http://kyleabaker.com/goodies/coding/wp-twitterbadge/).

== Features ==

* Twitter Badge displayed links to your Twitter account to invite visitors to also follow you on Twitter!
* Your Twitter account name can be changed or adjusted easily via the options page if you decide to change accounts.
* You can customize the label on the Twitter badge with four available options.
* You can customize the color of the Twitter badge to any possible web safe color or use transparent so your background design shows through.
* The color option also provides an easy color picker tool (thanks to the iColorPicker javascript tools).
* You can customize the side of the page that you wish to display your Twitter Badge on.
* You can customize how far down the page your Twitter Badge should appear.

== Changelog ==

= 1.0 =
* Fix issue with Microsoft Edge/Internet Explorer in cases where view port is set to device width allowing for an overlay scrollbar that covered the badge.

= 0.9 =
* Updated and improved options page
* Refactored js to make it more reliable with js optimizers
* Added buttons for plugin home page, support, changelog, translate and [donate](https://www.paypal.com/cgi-bin/webscr?cmd=_xclick&business=3S4Q4FH7BH9EG&item_name=Wordpress%20Plugin%20(WP-TwitterBadge)&no_shipping=1&no_note=1&tax=0&currency_code=USD&bn=PP%2dDonationsBF&charset=UTF%2d8&lc=US)
* Plugin is now ready to be [translated by YOU](https://translate.wordpress.org/projects/wp-plugins/wp-twitterbadge)!
* Optimized image filesizes
* Added plugin icon

= 0.8 =
* Added ability to manually specify "transparent" as your color setting to allow your page background to show through (props: ric)

= 0.7 =
* Fixed a styling bug where the about icon wasn't using fixed positioning.

= 0.6 =
* Optimized packaged images to reduce filesizes without reducing image quality. While this saves only a few extra kilobytes of bandwidth, it helps sites that are striving to perfect network performance with Page Speed for Firefox or Speed Tracer for Chrome (optimizing images).

= 0.5 =
* Fixed a bug where WP-TwitterBadge depended on images and redirect pages from http://www.go2web20.net/ since their server seems to be having problems. WP-TwitterBage will now function properly regardless of their servers. (props: Khyan)
* Fixed a bug where the color was not auto-updated in the options page (by modifying the icolorpicker.js and added a call for the preview() function).
* Replaced the onkeyup event on the color textbox with an onchange event so the color is updated as you edit the field.
* Added tfb.path variables to hold paths to your wp-twitterbadge plugin files for wp-twitterbadge.php and wp-twitterbadge-options.php.
* Updated the WP-TwitterBadge Settings/Options page to be more inline with the design of WP 2.9+ (from the old WP 2.5 design).

= 0.4 =
* Fixed a bug with double slashes (//) in plugin file paths (props: morestar).

= 0.3 =
* Disable WP-TwitterBadge when the WPtouch plugin is installed and the mobile theme is being used (so the badge isn't intrusive on mobiles).
* Fixed format and syntax of the readme.txt file that's included.

= 0.2 =
* Finalize changes made in v0.1.1 and commit.

= 0.1.1-pre =
* This is a <strike>pre</strike> release to <strike>test for a</strike> fix <strike>to</strike> an Internet Explorer specific bug.
* Cleaned some javascript code that was copy/pasted from go2web20 (--&gt; became //--&gt;)
* Moved the preview function in the options page to the beginning fo the options code so that it is defined before each element that makes a reference to it can use it (only affected Internet Explorer).
* Hopefully this will solve the &quot;Internet Explorer cannot open the internet site...Operation aborted.&quot; issues.

= 0.1 =
* Initial release.

= TO-DO: =
* Feedback is always welcome.

== Upgrade Notice ==

= 1.0 =
* Fix issue with Microsoft Edge/Internet Explorer in cases where view port is set to device width allowing for an overlay scrollbar that covered the badge.
