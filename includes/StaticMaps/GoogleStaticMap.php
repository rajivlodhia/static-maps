<?php
/**
 * @package StaticMaps
 */

namespace Includes\StaticMaps;

use Includes\Base\Helper;

class GoogleStaticMap {

	// The post of the static map.
	public \WP_Post $post;

	public function __construct( \WP_Post $post ) {
		$this->post = $post;
	}

	public function generate_map_url() {
		$google_maps_api_key = get_option( 'field_static_maps_google_api_key' );

		$fields = get_fields( $this->post );

		// Build the static map URL.
		$url        = 'https://maps.googleapis.com/maps/api/staticmap?';
		$url_params = [
			'key'     => $google_maps_api_key,
			'center'  => $this->get_coords( $fields['center_group'] ),
			'size'    => Helper::get_field_from_fields( $fields, 'size', '400x400' ),
			'zoom'    => Helper::get_field_from_fields( $fields, 'zoom', '10' ),
			'scale'   => Helper::get_field_from_fields( $fields, 'scale', '1' ),
			'maptype' => Helper::get_field_from_fields( $fields, 'maptype', 'roadmap' ),
		];

		// Build the basis of our static map with the parameters we have so far.
		$url .= http_build_query( $url_params );

		// Add all our markers to the query string we've just built.
		if ( ! empty( $fields['markers'] ) ) {
			foreach ( $fields['markers'] as $marker ) {
				$url .= '&markers=' . $this->generate_marker( $marker );
			}
		}

		return $url;
	}

	/**
	 * Gets the coordinates depending on which coordinate option was chosen.
	 *
	 * @param array $field_group The field group containing the coordinate options, coordinate text and map fields.
	 *
	 * @return string
	 */
	private function get_coords( array $field_group ) {
		// Set some default coordinates.
		$coordinates = '51.4925,-0.16707';
		switch ( $field_group['coordinates_options'] ) {
			case 'map':
				if ( ! empty( $field_group['map'] ) ) {
					$coordinates = $field_group['map']['lat'] . ',' . $field_group['map']['lng'];
				}
				break;

			case 'text':
				if ( ! empty( $field_group['coordinates_text'] ) ) {
					$coordinates = preg_replace( '/\s+/', '', $field_group['coordinates_text'] );
				}
				break;
		}

		return $coordinates;
	}

	/**
	 * Generates the part of the query string specifically for a single marker for the Google Static Maps.
	 *
	 * @param array $field_group The field group containing the marker's data from ACF.
	 *
	 * @return string
	 */
	private function generate_marker( array $field_group ) {
		$marker = [
			'color:' . str_replace( '#', '0x', $field_group['color'] ),// todo optional field - handle this
			'label:' . $field_group['label'],//todo this field is optional - need to handle that
			'size:' . $field_group['size'],
		];

		foreach ( $field_group['pins'] as $pin ) {
			$marker[] = $this->get_coords( $pin );
		}

		// Join our marker data together with the encoded '|' (pipe) character.
		$marker_str = implode( '%7C', $marker );

		return $marker_str;
	}
}
