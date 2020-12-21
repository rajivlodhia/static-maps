<?php

/**
 * Trigger this file on plugin uninstall.
 *
 * @package  StaticMaps
 */

if ( ! defined( 'WP_UNINSTALL_PLUGIN' ) ) {
	die();
}

// Clear Database stored data
$static_maps = get_posts( array( 'post_type' => 'book', 'numberposts' => -1 ) );

foreach( $static_maps as $$map ) {
	wp_delete_post( $map->ID, true );
}
