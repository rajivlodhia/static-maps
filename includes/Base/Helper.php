<?php
/**
 * @package StaticMaps
 */

namespace StaticMaps\Base;


class Helper {

	/**
	 * Uses ACF's get_field() with an additional default argument.
	 *
	 * The value of 'default' is used if the field has not been set.
	 *
	 * @param $selector
	 * @param bool $post_id
	 * @param bool $format_value
	 * @param bool $default
	 *
	 * @return bool|mixed
	 */
	public static function get_field( $selector, $post_id = false, $format_value = true, $default = false ) {
		if ( !function_exists( 'get_field' ) ) {
			return '';
		}

		$value = get_field( $selector, $post_id, $format_value );

		if ( empty( $value ) && $default !== false ) {
			$value = $default;
		}

		return $value;
	}

	/**
	 * Gets a field value from an array of fields and applies a default if empty.
	 * Able to search through multi-dimensional arrays.
	 *
	 * @param array $fields
	 * @param $field
	 * @param bool $default
	 *
	 * @return bool|mixed
	 */
	public static function get_field_from_fields( array $fields, $field, $default = false ) {
		$value = self::search_multi_array( $field, $fields );

		if ( empty( $fields[ $field ] ) && $default !== false ) {
			$value = $default;
		}

		return esc_html__( $value );
	}

	/**
	 * Search a multi-dimensional array for a specific array key.
	 *
	 * @param $needle
	 * @param array $haystack
	 *
	 * @return bool|mixed
	 */
	protected static function search_multi_array( $needle, array $haystack ) {
		// Check the current scope of the array for our needle. If it exists, great! Return it.
		if ( array_key_exists( $needle, $haystack ) ) {
			return $haystack[ $needle ];
		}

		foreach ( $haystack as $item ) {
			// If the current item is a nested array, we need to search that.
			if ( is_array( $item ) ) {
				return self::search_multi_array( $needle, $item );
			}
		}

		// If we didn't find anything matching, return false.
		return false;
	}

	/**
	 * Returns the Google API key set in either ACF or in this plugin's own API key field.
	 *
	 * @return bool|string
	 */
	public static function get_google_maps_api_key() {
		if ( !empty( acf_get_setting( 'google_api_key' ) ) ) {
			$api_key = acf_get_setting( 'google_api_key' );
		}
		elseif ( !empty( get_option( 'field_static_maps_google_api_key' ) ) ) {
			$api_key = get_option( 'field_static_maps_google_api_key' );
		}
		else {
			$api_key = '';
		}

		return esc_html__( $api_key );
	}
}
