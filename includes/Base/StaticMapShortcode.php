<?php
/**
 * @package StaticMaps
 */

namespace StaticMaps\Base;

use StaticMaps\IRegister;
use StaticMaps\StaticMaps\GoogleStaticMap;

class StaticMapShortcode implements IRegister {
	public function register() {
		add_shortcode( 'static_map', [$this, 'static_map_shortcode'] );
	}

	public function static_map_shortcode( $atts = [] ) {
		// Return immediately if ACF's get_field function is not found.
		if ( !function_exists( 'get_field' ) ) {
			return new \WP_Error( 'missing_acf', __( 'Static Maps plugin is missing ACF.', 'static-maps' ) );
		}

		$map = '';

		// Default the "map" attribute to #.
		extract( shortcode_atts ( [
			'map' => '#'
		], $atts ) );

		// Load our Static Map post.
		$static_map_post = get_post( $map );

		// Make sure this is in fact a Static Map post. Return an empty string if not.
		if ( !isset( $static_map_post ) || $static_map_post->post_type !== 'static_map' ) {
			return '';
		}

		$map = new GoogleStaticMap( $static_map_post );
		$url = $map->generate_map_url();

		return "<img id='google-static-map-$static_map_post->ID' class='google-static-map' src='$url' alt='$static_map_post->post_title'>";
	}
}
