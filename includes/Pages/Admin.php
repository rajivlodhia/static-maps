<?php
/**
 * @package StaticMaps
 */

namespace StaticMaps\Pages;

use StaticMaps\Settings\Field;
use StaticMaps\IRegister;
use StaticMaps\Settings\Section;
use StaticMaps\Settings\Setting;

class Admin implements IRegister {
	public function register() {
        add_action( 'admin_menu', [ $this, 'add_admin_pages' ] );

        add_filter( 'plugin_action_links_' . STATIC_MAPS_PLUGIN_BASE_NAME, [ $this, 'settings_link' ] );

		add_action( 'admin_init', [ $this, 'register_custom_fields' ] );

		// Register the Google Maps API key with ACF.
		add_action( 'acf/init', [ $this, 'acf_update_google_maps_api' ] );
    }

    public function register_custom_fields(){
	    $setting = new Setting( 'static_maps_options_group', 'field_static_maps_google_api_key' );
	    $setting->register();

	    $section = new Section( 'section_static_maps_google', __('Google Static Maps API Settings', 'static-maps'), [], 'static_maps_settings' );
	    $section->register();

        $field = new Field( 'field_static_maps_google_api_key', __('Google Maps API Key', 'static-maps'), [ $this, 'api_key_field_callback' ], 'static_maps_settings', $section->id );
        $field->register();
	}

	public function api_key_field_callback() {
		if ( is_admin() ) {
			$value = esc_attr( get_option( 'field_static_maps_google_api_key' ) );
			echo '<input type="text" class="regular-text" name="field_static_maps_google_api_key" value="' . $value . '" placeholder="">';
		}
	}

    public function settings_link( $links ) {
        $settings_link = '<a href="options-general.php?page=static_maps_settings">' . __('Settings', 'static-maps') . '</a>';
        array_push( $links, $settings_link );
        return $links;
    }

    public function add_admin_pages() {
        add_submenu_page( 'options-general.php', __('Static Maps', 'static-maps'), __('Static Maps', 'static-maps'), 'manage_options', 'static_maps_settings', array( $this, 'admin_index' ), 110 );
    }

    /**
     * Function called by add_submenu_page() to output our admin page's template.
     */
    public function admin_index() {
        require_once STATIC_MAPS_PLUGIN_PATH . 'templates/admin.php';
    }

	function acf_update_google_maps_api() {
		if ( is_admin() ) {
			acf_update_setting( 'google_api_key', esc_attr( get_option( 'field_static_maps_google_api_key' ) ) );
		}
	}

}
