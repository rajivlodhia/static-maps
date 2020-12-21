<?php
/**
 * @package StaticMaps
 */

namespace Includes\Pages;

use Includes\Settings\Field;
use Includes\IRegister;
use Includes\Settings\Section;
use Includes\Settings\Setting;

class Admin implements IRegister {
	public function register() {
        add_action( 'admin_menu', [$this, 'add_admin_pages'] );

        add_filter( 'plugin_action_links_' . STATIC_MAPS_PLUGIN_BASE_NAME, [$this, 'settings_link'] );

		add_action( 'admin_init', [$this, 'register_custom_fields'] );

//		add_action( 'admin_head', [$this, 'admin_add_maps_api'] );
		add_action( 'admin_enqueue_scripts', [$this, 'admin_add_maps_api'] );
    }

    public function register_custom_fields(){
	    $setting = new Setting('static_maps_options_group', 'field_static_maps_google_api_key');
	    $setting->register();

	    $section = new Section('section_static_maps_google', 'Google Static Maps API Settings', [], 'static_maps_settings');
	    $section->register();

        $field = new Field('field_static_maps_google_api_key', 'Google Maps API Key', [$this, 'api_key_field_callback'], 'static_maps_settings', $section->id);
        $field->register();
	}


	public function api_key_field_callback()
	{
		$value = esc_attr( get_option( 'field_static_maps_google_api_key' ) );
		echo '<input type="text" class="regular-text" name="field_static_maps_google_api_key" value="' . $value . '" placeholder="">';
	}

    public function settings_link( $links ) {
        $settings_link = '<a href="options-general.php?page=static_maps_settings">Settings</a>';
        array_push( $links, $settings_link );
        return $links;
    }

    public function add_admin_pages() {
        add_submenu_page( 'options-general.php', 'Static Maps', 'Static Maps', 'manage_options', 'static_maps_settings', array( $this, 'admin_index' ), 110 );
    }

    /**
     * Function called by add_submenu_page() to output our admin page's template.
     */
    public function admin_index() {
        require_once STATIC_MAPS_PLUGIN_PATH . 'templates/admin.php';
    }

    public function admin_add_maps_api() {
	    $api_key = get_option('field_static_maps_google_api_key');
	    wp_enqueue_script( 'static_maps_admin_google_maps', "https://maps.googleapis.com/maps/api/js?key=$api_key" );
    }
}
