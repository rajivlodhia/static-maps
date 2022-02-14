<?php
/**
 * @package StaticMaps
 */

namespace StaticMaps\PostTypes;

use StaticMaps\Base\Helper;
use StaticMaps\IRegister;

class StaticMapsPostType implements IRegister {
    public function register() {
        add_action( 'init', array( $this, 'custom_post_type' ) );

	    add_action( 'admin_notices', [$this, 'api_key_warning'] );
	    add_action( 'edit_form_after_title', [$this, 'render_shortcode'] );
    }

    public function custom_post_type() {
		register_post_type( 'static_map', [
                'public' => true,
                'label' => 'Static Maps',
                'has_archive' => false,
                'publicly_queryable'  => false,
				'supports' => [
					'title',
					'custom-fields',
				],
            ]
        );
	}

	/**
	 * Render the shortcode of the current Static Map post under the title.
	 */
	function render_shortcode() {
		global $post;

		// Confirm if the post_type is 'static_map'.
		if ( $post->post_type !== 'static_map' ) {
			return;
		}

		// Render the shortcode.
		echo "<div id='edit-slug-box'><strong>Shortcode:</strong> [static_map map=$post->ID]</div>";
	}

	/**
	 * Show a red admin notice on the Static Maps edit forms if no Maps API is present.
	 */
	function api_key_warning() {
		global $post;

		// Confirm if the post_type is 'static_map'.
		if ( empty( $post ) || $post->post_type !== 'static_map' ) {
			return;
		}

		if ( empty( Helper::get_google_maps_api_key() ) ) {
			$settings_page_link = site_url() . '/wp-admin/options-general.php?page=static_maps_settings';
			$class = 'notice notice-error';
			$message = __( 'No Google Maps API Key set yet! These maps wont work without one.<br>Go <a href="' . $settings_page_link . '">here</a> to set your API Key', 'static-maps' );
			printf( '<div class="%1$s"><p>%2$s</p></div>', esc_attr( $class ), $message );
		}
	}
}
