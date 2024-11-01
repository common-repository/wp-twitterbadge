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

// If uninstall is not called from WordPress, exit
if ( !defined( 'WP_UNINSTALL_PLUGIN' ) )
{
	exit();
}

delete_option('wptb_twitter_account');
delete_option('wptb_label');
delete_option('wptb_color');
delete_option('wptb_side');
delete_option('wptb_from_top');

// For site options in Multisite
delete_site_option('wptb_twitter_account');
delete_site_option('wptb_label');
delete_site_option('wptb_color');
delete_site_option('wptb_side');
delete_site_option('wptb_from_top');
?>