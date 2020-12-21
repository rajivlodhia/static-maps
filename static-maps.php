<?php
/**
 * @package StaticMaps
 */

/*
Plugin Name: Static Maps
Plugin URI: https://www.rajivlodhia.com/static-maps
Description: Create static maps with Google's Static Maps API and use them anywhere with a shortcode.
Version: 0.0.1-alpha
Author: Rajiv Lodhia
Author URI: https://www.rajivlodhia.com
License: GPLv2 or later 
Text Domain: static-maps
*/

/*
This program is free software; you can redistribute it and/or
modify it under the terms of the GNU General Public License
as published by the Free Software Foundation; either version 2
of the License, or (at your option) any later version.
This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.
You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301, USA.
Copyright 2005-2015 Automattic, Inc.
*/

defined( 'ABSPATH' ) or die();

// Use the Composer Autoload.
if ( file_exists( dirname( __FILE__ ) . '/vendor/autoload.php' ) ) {
	require_once dirname( __FILE__ ) . '/vendor/autoload.php';
}

// Define constants.
define( 'STATIC_MAPS_PLUGIN_BASE_NAME', plugin_basename( __FILE__ ) );
define( 'STATIC_MAPS_PLUGIN_PATH', plugin_dir_path( __FILE__ ) );
define( 'STATIC_MAPS_PLUGIN_URL', plugin_dir_url( __FILE__ ) );
define( 'STATIC_MAPS_PLUGIN_FILE', __FILE__ );

// Initialise all the core classes of the plugin.
if ( class_exists( 'Includes\\Init' ) ) {
	Includes\Init::register_services();
}

/**
 * Advanced Custom Fields definitions.
 */
// Define path and URL to the ACF plugin.
define( 'STATIC_MAPS_ACF_PATH', STATIC_MAPS_PLUGIN_PATH . 'includes/acf/' );
define( 'STATIC_MAPS_ACF_URL', STATIC_MAPS_PLUGIN_URL . 'includes/acf/' );

// Include the ACF plugin.
include_once( STATIC_MAPS_ACF_PATH . 'acf.php' );

// Customize the url setting to fix incorrect asset URLs.
add_filter('acf/settings/url', 'static_maps_acf_settings_url');
function static_maps_acf_settings_url( $url ) {
	return STATIC_MAPS_ACF_URL;
}

// (Optional) Hide the ACF admin menu item.
//add_filter('acf/settings/show_admin', 'static_maps_acf_settings_show_admin');
function static_maps_acf_settings_show_admin( $show_admin ) {
	return false;
}

//if( function_exists('acf_add_local_field_group') ):
//
//	acf_add_local_field_group(array(
//		'key' => 'group_5fd64fb1993ad',
//		'title' => 'Google Static Maps',
//		'fields' => array(
//			array(
//				'key' => 'field_5fd64fe65abe0',
//				'label' => 'Pins',
//				'name' => 'pins',
//				'type' => 'google_map',
//				'instructions' => '',
//				'required' => 0,
//				'conditional_logic' => 0,
//				'wrapper' => array(
//					'width' => '',
//					'class' => '',
//					'id' => '',
//				),
//				'center_lat' => '',
//				'center_lng' => '',
//				'zoom' => 10,
//				'height' => '',
//			),
//			array(
//				'key' => 'field_5fd6501c5abe1',
//				'label' => 'Colour',
//				'name' => 'colour',
//				'type' => 'color_picker',
//				'instructions' => '',
//				'required' => 0,
//				'conditional_logic' => 0,
//				'wrapper' => array(
//					'width' => '',
//					'class' => '',
//					'id' => '',
//				),
//				'default_value' => '',
//			),
//		),
//		'location' => array(
//			array(
//				array(
//					'param' => 'post_type',
//					'operator' => '==',
//					'value' => 'static_map',
//				),
//			),
//		),
//		'menu_order' => 0,
//		'position' => 'normal',
//		'style' => 'seamless',
//		'label_placement' => 'top',
//		'instruction_placement' => 'label',
//		'hide_on_screen' => '',
//		'active' => true,
//		'description' => '',
//	));
//
//endif;
