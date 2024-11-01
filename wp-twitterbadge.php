<?php
/*
 * Plugin Name: WP-TwitterBadge
 * Plugin URI: http://kyleabaker.com/goodies/coding/wp-twitterbadge/
 * Description: WP-TwitterBadge lets you easily add a small Twitter badge to the side of your blog to invite your visitors to follow you on Twitter!
 * Version: 1.0
 * Author: Kyle Baker
 * Author URI: https://www.kyleabaker.com/
 * Text Domain: wp-twitterbadge
 * Domain Path: /languages/
 */

/* Copyright 2008-2016  Kyle Baker  (email: kyleabaker@gmail.com)

This program is free software; you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation; either version 3 of the License, or
any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/

// Security measure
defined( 'ABSPATH' ) or die( 'Cannot access pages directly.' );

// Pre-2.6 compatibility
if (!defined('WP_CONTENT_URL'))
	define('WP_CONTENT_URL', get_option('siteurl').'/wp-content');
if (!defined('WP_CONTENT_DIR'))
	define('WP_CONTENT_DIR', ABSPATH.'wp-content');
if (!defined('WP_PLUGIN_URL'))
	define('WP_PLUGIN_URL', WP_CONTENT_URL.'/plugins');
if (!defined('WP_PLUGIN_DIR'))
	define('WP_PLUGIN_DIR', WP_CONTENT_DIR.'/plugins');

//Plugin Options
$wptb_plugin_url = WP_PLUGIN_URL.'/wp-twitterbadge/';

$wptb_twitter_account = get_option('wptb_twitter_account');
$wptb_label           = get_option('wptb_label');
$wptb_color           = get_option('wptb_color');
$wptb_side            = get_option('wptb_side');
$wptb_from_top        = get_option('wptb_from_top');

// Migrate settings from previous database schema if necessary
$wptb_old_twitter_account = get_option('tb_twitter_account');
if (empty($wptb_twitter_account) && !empty($wptb_old_twitter_account))
{
	// Attempt to retrieve settings stored using previous schema (transform where needed)
	$wptb_twitter_account = get_option('tb_twitter_account');
	$wptb_label           = get_option('tb_label');
	$wptb_color           = get_option('tb_color');
	$wptb_side            = get_option('tb_side');
	$wptb_from_top        = get_option('tb_from_top');

	// Add new options and attempt to specify no autoload
	if ( ! add_option( 'wptb_twitter_account', $wptb_twitter_account, '', 'no' ) ) update_option( 'wptb_twitter_account', $wptb_twitter_account );
	if ( ! add_option( 'wptb_label', $wptb_label, '', 'no' ) ) update_option( 'wptb_label', $wptb_label );
	if ( ! add_option( 'wptb_color', $wptb_color, '', 'no' ) ) update_option( 'wptb_color', $wptb_color );
	if ( ! add_option( 'wptb_side', $wptb_side, '', 'no' ) ) update_option( 'wptb_side', $wptb_side );
	if ( ! add_option( 'wptb_from_top', $wptb_from_top, '', 'no' ) ) update_option( 'wptb_from_top', $wptb_from_top );

	// New schema is initialized, ready to purge old schema...
	delete_option('tb_twitter_account');
	delete_option('tb_label');
	delete_option('tb_color');
	delete_option('tb_side');
	delete_option('tb_from_top');
}

// Set defaults
if (empty($wptb_label)) $wptb_label = 'follow-us';
if (empty($wptb_color)) $wptb_color = '#35ccff';
if (empty($wptb_side)) $wptb_side = 'r';
if (empty($wptb_from_top)) $wptb_from_top = '136';

// Safe escape user entered input
$tb_twitter_account = wptb_str_escape($tb_twitter_account);
$wptb_color = wptb_str_escape($wptb_color);
$wptb_from_top = wptb_str_escape($wptb_from_top);

/**
 * Escape quotes from user input so options are displayed correctly
 */
function wptb_str_escape($str)
{
	return esc_attr(htmlspecialchars(wp_strip_all_tags($str, false)));
}

function wptb_twitterbadge()
{
	global $wptb_plugin_url, $wptb_twitter_account, $wptb_label, $wptb_color, $wptb_side, $wptb_from_top;

	//Disable Twitter Badge when the default WPtouch theme is in use
	if ( function_exists('WPtouch') && function_exists('get_template') && get_template() == 'default' )
	{
		echo '<!-- WP-TwitterBadge: Disabled while the default WPtouch theme is in use -->';
		return;
	}

	if (empty($wptb_twitter_account))
	{
		echo '<!-- WP-TwitterBadge: You must first enter a twitter account name before your TwitterBadge will be displayed -->';
		return;
	}
?>
<!-- twitter follow badge by go2web20 -->
<script src='<?php echo $wptb_plugin_url; ?>js/badge.js' type='text/javascript'></script><script type='text/javascript' charset='utf-8'>
	var tfbSkipInit = typeof tfb === 'undefined';
	var tfb = tfb || {};
	tfb.account = '<?php echo $wptb_twitter_account; ?>';
	tfb.label = '<?php echo $wptb_label; ?>';
	tfb.color = '<?php echo $wptb_color; ?>';
	tfb.side = '<?php echo $wptb_side; ?>';
	tfb.top = <?php echo $wptb_from_top; ?>;
	tfb.path = '<?php echo $wptb_plugin_url ?>img/';
	if (!tfbSkipInit) tfb.showbadge();
</script>
<!-- end of twitter follow badge -->
<?php
}

/**
 * Add a link to our Options page for Admin users.
 */
add_action('admin_menu', 'wptb_add_option_page');
function wptb_add_option_page()
{
	add_options_page('WP-TwitterBadge', 'WP-TwitterBadge', 'manage_options', 'wp-twitterbadge/wp-twitterbadge-options.php');
}

/**
 * Add quick links to plugins page
 */
$plugin_basename = plugin_basename( __FILE__ );
add_filter( "plugin_action_links_$plugin_basename", 'wptb_add_action_links');
function wptb_add_action_links( $links )
{
	// Add a link to this plugin's settings page
	$settings_link = '<a href="options-general.php?page=wp-twitterbadge/wp-twitterbadge-options.php">Settings</a>';
	array_unshift( $links, $settings_link );
	return $links;
}

/**
 * Add activation hook to create necessary db options with autoload disabled
 */
register_activation_hook( __FILE__, 'wptb_activation' );
function wptb_activation()
{
	// Add new options and attempt to specify no autoload
	if ( ! add_option( 'wptb_twitter_account', '', '', 'no' ) ) update_option( 'wptb_twitter_account', '' );
	if ( ! add_option( 'wptb_label', '', '', 'no' ) ) update_option( 'wptb_label', '' );
	if ( ! add_option( 'wptb_color', '', '', 'no' ) ) update_option( 'wptb_color', '' );
	if ( ! add_option( 'wptb_side', '', '', 'no' ) ) update_option( 'wptb_side', '' );
	if ( ! add_option( 'wptb_from_top', '', '', 'no' ) ) update_option( 'wptb_from_top', '' );
}

/**
 * Load plugin textdomain: wp-twitterbadge
 */
add_action( 'plugins_loaded', 'wptb_load_textdomain' );
function wptb_load_textdomain()
{
	load_plugin_textdomain( 'wp-twitterbadge', false, plugin_basename( dirname( __FILE__ ) ) . '/languages' ); 
}

// Add hook to wordpress footer to invoke plugin
add_action('wp_footer', 'wptb_twitterbadge');

?>
