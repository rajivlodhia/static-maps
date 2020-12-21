<?php
/**
 * @package StaticMaps
 */

namespace Includes\PostTypes;

use Includes\IRegister;

class StaticMapsPostType implements IRegister {
    public function register() {
        add_action( 'init', array( $this, 'custom_post_type' ) );

	    add_action( 'edit_form_after_title', [$this, 'render_api_key_warning'] );
	    add_action( 'edit_form_after_title', [$this, 'render_shortcode'] );
    }

    public function custom_post_type() {
		register_post_type( 'static_map', [
                'public' => true,
                'label' => 'Static Maps',
                'has_archive' => false,
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
		if ($post->post_type !== 'static_map') {
			return;
		}

		// Render the shortcode.
		echo "<div class=''>Shortcode: <strong>[static_map map=$post->ID]</strong></div>";
	}

	function render_api_key_warning() {
		global $post;

		// Confirm if the post_type is 'static_map'.
		if ($post->post_type !== 'static_map') {
			return;
		}

		if (empty(get_option('field_static_maps_google_api_key'))) {
			// Render message if the API key settings field is empty
			echo "<div class='red' style='color: red'><p>No Google Maps API Key set yet! These maps wont work without one.</p>" .
			     "<p>Go <a href='/wp-admin/options-general.php?page=static_maps_settings'>here</a> to set your API Key</p></div>";
		}
	}
}
