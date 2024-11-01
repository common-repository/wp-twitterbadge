<?php
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

?>
<!--Begin: Options file for WP-TwitterBadge-->
<style>
	.wp-twitterbadge .hndle {
		cursor: auto !important;
		-webkit-user-select: auto !important;
		-moz-user-select: auto !important;
		-ms-user-select: auto !important;
		user-select: auto !important;
	}
	.wp-twitterbadge .postbox .inside > p {
		padding-left: 10px;
		padding-right: 10px;
	}
	/* custom reset button style */
	.wp-core-ui .button-primary.reset {
		background: #ff4c4c;
		border-color: #ff3232 #ff0000 #ff0000;
		-webkit-box-shadow: 0 1px 0 #ff0000;
		box-shadow: 0 1px 0 #ff0000;
		color: #fff;
		text-decoration: none;
		text-shadow: 0 -1px 1px #ff0000,1px 0 1px #ff0000,0 1px 1px #ff0000,-1px 0 1px #ff0000;
		margin-right: 5px;
	}
	.wp-core-ui .button-primary.reset:hover {
		background: #ff6666;
	}
</style>
<div class="wrap wp-twitterbadge" id="sm_div">
	<form method="post" action="options.php">
		<?php 
			$wptb_plugin_url = WP_PLUGIN_URL.'/wp-twitterbadge/';

			wp_nonce_field('update-options');
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
		?>
		<h2>WP-TwitterBadge</h2>
		<p>
			<a href="https://www.kyleabaker.com/goodies/coding/wp-twitterbadge/" target="_blank" class="button"><?php _e('Plugin Homepage', 'wp-twitterbadge'); ?></a>
			<a href="https://wordpress.org/support/plugin/wp-twitterbadge" target="_blank" class="button"><?php _e('Support', 'wp-twitterbadge'); ?></a>
			<a href="https://wordpress.org/plugins/wp-twitterbadge/changelog/" target="_blank" class="button"><?php _e('Changelog', 'wp-twitterbadge'); ?></a>
			<a href="https://translate.wordpress.org/projects/wp-plugins/wp-twitterbadge" target="_blank" class="button"><?php _e('Translate', 'wp-twitterbadge'); ?></a>
			<a href="https://www.paypal.com/cgi-bin/webscr?cmd=_xclick&business=3S4Q4FH7BH9EG&item_name=Wordpress%20Plugin%20(WP-TwitterBadge)&no_shipping=1&no_note=1&tax=0&currency_code=USD&bn=PP%2dDonationsBF&charset=UTF%2d8&lc=US" target="_blank" class="button" title="<?php _e('Donate to Kyle Baker (kyleabaker.com) for this plugin via PayPal', 'wp-twitterbadge'); ?>"><?php _e('Donate', 'wp-twitterbadge'); ?></a>
		</p>
		<div id="poststuff" class="metabox-holder">
			<div id="post-body-content">
				<div class="meta-box-sortables">
					<!-- Info Box -->
					<div class="postbox">
						<button type="button" class="handlediv button-link" aria-expanded="true">
							<span class="screen-reader-text"><?php _e('Toggle panel', 'wp-twitterbadge'); ?>: <?php _e('Twitter &quot;Follow&quot; Badge for your site/blog', 'wp-twitterbadge'); ?></span><span class="toggle-indicator" aria-hidden="true"></span>
						</button>
						<h3 class="hndle"><span><?php _e('Twitter &quot;Follow&quot; Badge for your site/blog', 'wp-twitterbadge'); ?></span></h3>
						<div class="inside">
							<blockquote>
								<p class="description">
									<?php _e('This badge calls your users to start following your twitter account.', 'wp-twitterbadge'); ?><br />
									<?php _e('Twitter has proven itself to be a great communication channel with your site visitors.', 'wp-twitterbadge'); ?><br />
									<?php _e('This badge can be installed almost on any site. Just customize it a bit and take the code.', 'wp-twitterbadge'); ?><br />
									-- <em>(<a href="http://www.go2web20.net/twitterFollowBadge/">go2web20.net</a>)</em>
								</p>
							</blockquote>
						</div>
					</div>

					<!-- Your WP-TwitterBadge Settings Box -->
					<div class="postbox">
						<button type="button" class="handlediv button-link" aria-expanded="true">
							<span class="screen-reader-text"><?php _e('Toggle panel', 'wp-twitterbadge'); ?>: <?php _e('Your WP-TwitterBadge Settings', 'wp-twitterbadge'); ?></span><span class="toggle-indicator" aria-hidden="true"></span>
						</button>
						<h3 class="hndle"><span><?php _e('Your WP-TwitterBadge Settings', 'wp-twitterbadge'); ?></span></h3>
						<div class="inside">
							<p class="description"><?php _e('You can change the label, color and position of the Twitter Badge.', 'wp-twitterbadge'); ?></p>

							<table class="form-table">
								<tbody>
									<tr>
										<th><?php _e('Twitter account', 'wp-twitterbadge'); ?>:</th>
										<td><input type="text" id="wptb_twitter_account" name="wptb_twitter_account" value="<?php echo $wptb_twitter_account; ?>" /></td>
									</tr>
									<tr>
										<th><?php _e('Label', 'wp-twitterbadge'); ?>:</th>
										<td><select id="wptb_label" name="wptb_label">
												<option value="follow-us" <?php if ($wptb_label === 'follow-us') echo 'selected="selected"'; ?>><?php _e('Follow us', 'wp-twitterbadge'); ?></option>
												<option value="follow-me" <?php if ($wptb_label === 'follow-me') echo 'selected="selected"'; ?>><?php _e('Follow me', 'wp-twitterbadge'); ?></option>
												<option value="follow" <?php if ($wptb_label === 'follow') echo 'selected="selected"'; ?>><?php _e('Follow', 'wp-twitterbadge'); ?></option>
												<option value="my-twitter" <?php if ($wptb_label === 'my-twitter') echo 'selected="selected"'; ?>><?php _e('My twitter', 'wp-twitterbadge'); ?></option>
											</select>
										</td>
									</tr>
									<tr>
										<th><?php _e('Color', 'wp-twitterbadge'); ?>:</th>
										<td>
											<input type="text" id="wptb_color" name="wptb_color" value="<?php echo $wptb_color; ?>" class="iColorPicker" /><br />
											<p class="description"><?php _e('Copy and paste the following into the color field if you would like your background to show through', 'wp-twitterbadge'); ?>: <code>transparent</code></p>
										</td>
									</tr>
									<tr>
										<th><?php _e('Side', 'wp-twitterbadge'); ?>:</th>
										<td>
											<input type="radio" id="wptb_side_l" name="wptb_side" value="l" <?php if ($wptb_side === 'l') echo 'checked="checked"'; ?> /> <?php _e('Left', 'wp-twitterbadge'); ?>
											<input type="radio" id="wptb_side_r" name="wptb_side" value="r" <?php if ($wptb_side !== 'l') echo 'checked="checked"'; ?> /> <?php _e('Right', 'wp-twitterbadge'); ?>
										</td>
									</tr>
									<tr>
										<th><?php _e('From top', 'wp-twitterbadge'); ?>:</th>
										<td><input type="number" id="wptb_from_top" name="wptb_from_top" value="<?php echo $wptb_from_top; ?>" min="0" max="1000" /> <?php _e('Pixels', 'wp-twitterbadge'); ?></td>
									</tr>
								</tbody>
							</table>
						</div>
					</div>

					<!-- Help Box -->
					<div class="postbox">
						<button type="button" class="handlediv button-link" aria-expanded="true">
							<span class="screen-reader-text"><?php _e('Toggle panel', 'wp-twitterbadge'); ?>: <?php _e('Help', 'wp-twitterbadge'); ?></span><span class="toggle-indicator" aria-hidden="true"></span>
						</button>
						<h3 class="hndle"><span><?php _e('Help', 'wp-twitterbadge'); ?></span></h3>
						<div class="inside">
							<p><?php _e('WP-TwitterBadge is a simple plugin that allows you to display a Twitter \'Follow\' Badge on your site or blog.', 'wp-twitterbadge'); ?></p>

							<p>
								<a href="https://www.kyleabaker.com/goodies/coding/wp-twitterbadge/" target="_blank" class="button"><?php _e('Plugin Homepage', 'wp-twitterbadge'); ?></a>
								<a href="https://wordpress.org/support/plugin/wp-twitterbadge" target="_blank" class="button"><?php _e('Support', 'wp-twitterbadge'); ?></a>
								<a href="https://wordpress.org/plugins/wp-twitterbadge/changelog/" target="_blank" class="button"><?php _e('Changelog', 'wp-twitterbadge'); ?></a>
								<a href="https://translate.wordpress.org/projects/wp-plugins/wp-twitterbadge" target="_blank" class="button"><?php _e('Translate', 'wp-twitterbadge'); ?></a>
							</p>

							<table class="form-table">
								<tbody>
									<tr>
										<td>
											<p>
												<?php _e('If you have any problems, questions, comments or suggestions regarding WP-TwitterBadge please don\'t hesitate to contact me.', 'wp-twitterbadge'); ?><br />
												<strong><?php _e('Author', 'wp-twitterbadge'); ?>:</strong> Kyle Baker (kyleabaker) - <a href="http://twitter.com/kyleabaker">Twitter</a><br />
												<strong><?php _e('Plugin Homepage', 'wp-twitterbadge'); ?>:</strong> <a href="https://www.kyleabaker.com/goodies/coding/wp-twitterbadge/">https://www.kyleabaker.com/goodies/coding/wp-twitterbadge/</a><br />
												<?php _e('Help me afford the cost of maintaining this plugin and the work that goes into it!', 'wp-twitterbadge'); ?> <a href="https://www.paypal.com/cgi-bin/webscr?cmd=_xclick&business=3S4Q4FH7BH9EG&item_name=Wordpress%20Plugin%20(WP-TwitterBadge)&no_shipping=1&no_note=1&tax=0&currency_code=USD&bn=PP%2dDonationsBF&charset=UTF%2d8&lc=US" target="_new"><img src="https://www.paypal.com/en_US/i/btn/btn_donate_SM.gif" name="submit" alt="<?php _e('Donate to Kyle Baker (kyleabaker.com) for this plugin via PayPal', 'wp-twitterbadge'); ?>" title="<?php _e('Donate to Kyle Baker (kyleabaker.com) for this plugin via PayPal', 'wp-twitterbadge'); ?>" style="float:right" /></a>
											</p>
										</td>
									</tr>
								</tbody>
							</table>
						</div>
					</div>

				</div>
			</div>
		</div>

		<input type="hidden" name="action" value="update" />
		<input type="hidden" name="page_options" value="wptb_twitter_account, wptb_label, wptb_color, wptb_side, wptb_from_top" />

		<input type="submit" name="Submit" class="button-primary" value="<?php _e('Save Changes') ?>" />
	</form>

	<script src="<?php echo $wptb_plugin_url; ?>js/badge.js" type="text/javascript"></script>
	<script type="text/javascript">
		;(function($){
			"use strict";

			$.fn.wpTwitterBadge = function() {
				// WP-TwitterBadge Options Wrapper
				var $wp_twiterbadge = $(this),
					// Your WP-TwitterBadge Settings
					$wptb_twitter_account = $wp_twiterbadge.find('#wptb_twitter_account'),
					$wptb_label = $wp_twiterbadge.find('#wptb_label'),
					$wptb_color = $wp_twiterbadge.find('#wptb_color'),
					$wptb_side_l = $wp_twiterbadge.find('#wptb_side_l'),
					$wptb_side_r = $wp_twiterbadge.find('#wptb_side_r'),
					$wptb_from_top = $wp_twiterbadge.find('#wptb_from_top'),
					wptb_color_hex = null,

				// Element event groups
					$change = $wp_twiterbadge.find('#wptb_label,#wptb_color,#wptb_side_l,#wptb_side_r'),
					$keyup = $wp_twiterbadge.find('#wptb_twitter_account,#wptb_from_top,.iColorPicker');

				// Listen for changes to color selection from dialog,
				// also listen to admin menu when side is set to left
				function customListener() {
					"use strict";
					// Watch for color changes from dialog
					if (wptb_color_hex === null) {
						wptb_color_hex = $wptb_color.val();
					} else if (wptb_color_hex !== $wptb_color.val()) {
						preview();
					}
					// Watch for menu expanding when side is set to left
					if ($wptb_side_l.attr('checked')) {
						$('#tfbTab').css('z-index','9999');
						$('#tfbTab').css('left', $( "#adminmenuwrap" ).css('width'));
					}
					setTimeout(customListener, 500);
				}

				// Generate Comment Preview
				function preview() {
					"use strict";
					tfb.account = $wptb_twitter_account.val();
					tfb.label = $wptb_label.val();
					tfb.color = wptb_color_hex = $wptb_color.val();
					tfb.side = $wptb_side_l.attr('checked') ? 'l' : 'r';
					tfb.top = $wptb_from_top.val();
					tfb.showbadge();
				}

				// Toggle Metabox
				function toggleMetaBox() {
					"use strict";
					var $metaboxButton = $(this);
					$metaboxButton.closest('.postbox').toggleClass('closed');
				}

				// Initialize
				function init() {
					"use strict";
					tfb.path = '<?php echo $wptb_plugin_url.'img/'; ?>';
					customListener();
					preview();
				}

				// Event Handlers
				$change.on('change', preview);
				$keyup.on('input', preview);
				$wp_twiterbadge.find('.postbox button.handlediv.button-link').on('click', toggleMetaBox);

				// Initialize
				init();
			};
		})(jQuery);

		jQuery(document).ready(function () {
			jQuery('.wrap.wp-twitterbadge').wpTwitterBadge();
		});
	</script>
	<script type="text/javascript" src="<?php echo $wptb_plugin_url; ?>js/icolorpicker.js"></script>
	<script type="text/javascript">var imageUrl = '<?php echo $wptb_plugin_url; ?>img/color.png';</script>
</div>
<!--End: Options file for WP-TwitterBadge-->
