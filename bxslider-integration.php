<?php
/*
Plugin Name: bxSlider integration for WordPress
Plugin URI: http://www.marvinlabs.com
Version: 1.7.2
Description: Replaces the native WordPress galleries by a slider based on the jQuery plugin: bxSlider 
Author: MarvinLabs
Author URI: http://www.marvinlabs.com
Text Domain: bxsg
Domain Path: /languages
*/

/*  Copyright 2013 MarvinLabs (contact@marvinlabs.com)

	This program is free software; you can redistribute it and/or modify
	it under the terms of the GNU General Public License as published by
	the Free Software Foundation; either version 2 of the License, or
	(at your option) any later version.

	This program is distributed in the hope that it will be useful,
	but WITHOUT ANY WARRANTY; without even the implied warranty of
	MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
	GNU General Public License for more details.

	You should have received a copy of the GNU General Public License
	along with this program; if not, write to the Free Software
	Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA 02110-1301 USA
*/

define( 'BXSG_PLUGIN_DIR', 		plugin_dir_path( __FILE__ ) );
define( 'BXSG_LANGUAGE_DIR', 	'bxslider-integration/languages' );
define( 'BXSG_INCLUDES_DIR', 	BXSG_PLUGIN_DIR . '/src/php' );

define( 'BXSG_PLUGIN_URL', 		WP_PLUGIN_URL . '/bxslider-integration/' );
define( 'BXSG_SCRIPTS_URL', 	BXSG_PLUGIN_URL . 'assets/js' );
define( 'BXSG_STYLES_URL', 		BXSG_PLUGIN_URL . 'assets/css' );

include_once( BXSG_INCLUDES_DIR . '/plugin.class.php' );
include_once( BXSG_INCLUDES_DIR . '/theme-utils.class.php' );

global $bsxg_plugin;
$bsxg_plugin = new BXSG_Plugin();
$bsxg_plugin->run();
