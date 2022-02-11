<?php
/**
 * @package StaticMaps
 */

namespace StaticMaps\Settings;

use StaticMaps\IRegister;

/**
 * Class StaticMapsACFFields
 *
 * Create fields for the admin section of this plugin.
 */
class StaticMapsACFFields implements IRegister {
	function register() {
		$this->add_static_maps_acf_fields();
	}

	function add_static_maps_acf_fields() {
		if( function_exists('acf_add_local_field_group') ):

			acf_add_local_field_group(array(
				'key' => 'group_5fd64fb1993ad',
				'title' => 'Google Static Maps',
				'fields' => array(
					array(
						'key' => 'field_5fd801162473a',
						'label' => 'Center',
						'name' => 'center_group',
						'type' => 'group',
						'instructions' => 'The center of this map.',
						'required' => 0,
						'conditional_logic' => 0,
						'wrapper' => array(
							'width' => '',
							'class' => '',
							'id' => '',
						),
						'layout' => 'block',
						'sub_fields' => array(
							array(
								'key' => 'field_5fd7fc760047c',
								'label' => 'How would you like to choose the center of the map?',
								'name' => 'coordinates_options',
								'type' => 'radio',
								'instructions' => '',
								'required' => 0,
								'conditional_logic' => 0,
								'wrapper' => array(
									'width' => '',
									'class' => '',
									'id' => '',
								),
								'choices' => array(
									'text' => 'Text (lng and lat coordinates)',
									'map' => 'Map (requires Maps Javascript API enabled)',
								),
								'allow_null' => 0,
								'other_choice' => 0,
								'default_value' => '',
								'layout' => 'horizontal',
								'return_format' => 'value',
								'save_other_choice' => 0,
							),
							array(
								'key' => 'field_5fd8000ceb8b5',
								'label' => 'Center',
								'name' => 'coordinates_text',
								'type' => 'text',
								'instructions' => 'Longitude and Latitude separated by a comma.
e.g. 51.4925,-0.16707',
								'required' => 0,
								'conditional_logic' => array(
									array(
										array(
											'field' => 'field_5fd7fc760047c',
											'operator' => '==',
											'value' => 'text',
										),
									),
								),
								'wrapper' => array(
									'width' => '',
									'class' => '',
									'id' => '',
								),
								'default_value' => '',
								'placeholder' => '',
								'prepend' => '',
								'append' => '',
								'maxlength' => '',
							),
							array(
								'key' => 'field_5fd801a02473b',
								'label' => 'Center',
								'name' => 'map',
								'type' => 'google_map',
								'instructions' => '',
								'required' => 0,
								'conditional_logic' => array(
									array(
										array(
											'field' => 'field_5fd7fc760047c',
											'operator' => '==',
											'value' => 'map',
										),
									),
								),
								'wrapper' => array(
									'width' => '',
									'class' => '',
									'id' => '',
								),
								'center_lat' => '',
								'center_lng' => '',
								'zoom' => '',
								'height' => '',
							),
						),
					),
					array(
						'key' => 'field_5fd68a019650e',
						'label' => 'Size',
						'name' => 'size',
						'type' => 'text',
						'instructions' => 'Example: 400x400',
						'required' => 0,
						'conditional_logic' => 0,
						'wrapper' => array(
							'width' => '',
							'class' => '',
							'id' => '',
						),
						'default_value' => '',
						'placeholder' => '',
						'prepend' => '',
						'append' => '',
						'maxlength' => '',
					),
					array(
						'key' => 'field_5fd686dab2542',
						'label' => 'Zoom',
						'name' => 'zoom',
						'type' => 'number',
						'instructions' => 'Defaults to 10',
						'required' => 0,
						'conditional_logic' => 0,
						'wrapper' => array(
							'width' => '',
							'class' => '',
							'id' => '',
						),
						'default_value' => '',
						'placeholder' => '',
						'prepend' => '',
						'append' => '',
						'min' => 0,
						'max' => 21,
						'step' => 1,
					),
					array(
						'key' => 'field_5fd6876ab2543',
						'label' => 'Scale',
						'name' => 'scale',
						'type' => 'number',
						'instructions' => 'Defaults to 1',
						'required' => 0,
						'conditional_logic' => 0,
						'wrapper' => array(
							'width' => '',
							'class' => '',
							'id' => '',
						),
						'default_value' => 1,
						'placeholder' => '',
						'prepend' => '',
						'append' => '',
						'min' => '',
						'max' => '',
						'step' => '',
					),
					array(
						'key' => 'field_5fd687e2b2544',
						'label' => 'Map Type',
						'name' => 'map_type',
						'type' => 'select',
						'instructions' => '',
						'required' => 1,
						'conditional_logic' => 0,
						'wrapper' => array(
							'width' => '',
							'class' => '',
							'id' => '',
						),
						'choices' => array(
							'roadmap' => 'Roadmap',
							'satellite' => 'Satellite',
							'terrain' => 'Terrain',
							'hybrid' => 'Hybrid',
						),
						'default_value' => 'roadmap',
						'allow_null' => 0,
						'multiple' => 0,
						'ui' => 0,
						'return_format' => 'value',
						'ajax' => 0,
						'placeholder' => '',
					),
					array(
						'key' => 'field_5fd69dd3772e4',
						'label' => 'Markers',
						'name' => 'markers',
						'type' => 'repeater',
						'instructions' => '',
						'required' => 0,
						'conditional_logic' => 0,
						'wrapper' => array(
							'width' => '',
							'class' => '',
							'id' => '',
						),
						'collapsed' => '',
						'min' => 0,
						'max' => 0,
						'layout' => 'block',
						'button_label' => 'New marker',
						'sub_fields' => array(
							array(
								'key' => 'field_5fd7f07312b8c',
								'label' => 'Label',
								'name' => 'label',
								'type' => 'text',
								'instructions' => 'A single character A-Z or 0-9',
								'required' => 0,
								'conditional_logic' => 0,
								'wrapper' => array(
									'width' => '',
									'class' => '',
									'id' => '',
								),
								'default_value' => '',
								'placeholder' => '',
								'prepend' => '',
								'append' => '',
								'maxlength' => 1,
							),
							array(
								'key' => 'field_5fda6bd904f7f',
								'label' => 'Size',
								'name' => 'size',
								'type' => 'select',
								'instructions' => '',
								'required' => 1,
								'conditional_logic' => 0,
								'wrapper' => array(
									'width' => '',
									'class' => '',
									'id' => '',
								),
								'choices' => array(
									'tiny' => 'Tiny',
									'small' => 'Small',
									'mid' => 'Mid',
								),
								'default_value' => 'mid',
								'allow_null' => 0,
								'multiple' => 0,
								'ui' => 0,
								'return_format' => 'value',
								'ajax' => 0,
								'placeholder' => '',
							),
							array(
								'key' => 'field_5fd7ef0f12b8b',
								'label' => 'Color',
								'name' => 'color',
								'type' => 'color_picker',
								'instructions' => '',
								'required' => 0,
								'conditional_logic' => 0,
								'wrapper' => array(
									'width' => '',
									'class' => '',
									'id' => '',
								),
								'default_value' => '',
							),
							array(
								'key' => 'field_5fd7f99609457',
								'label' => 'How would you like to choose the location of this map pin?',
								'name' => 'coordinates_options',
								'type' => 'radio',
								'instructions' => '',
								'required' => 1,
								'conditional_logic' => 0,
								'wrapper' => array(
									'width' => '',
									'class' => '',
									'id' => '',
								),
								'choices' => array(
									'text' => 'Text (lng and lat coordinates)',
									'map' => 'Map (requires Maps Javascript API enabled)',
								),
								'allow_null' => 0,
								'other_choice' => 0,
								'default_value' => '',
								'layout' => 'horizontal',
								'return_format' => 'value',
								'save_other_choice' => 0,
							),
							array(
								'key' => 'field_60fd8dc586624',
								'label' => 'Pins',
								'name' => 'pins',
								'type' => 'google_map_multi',
								'instructions' => '',
								'required' => 0,
								'conditional_logic' => array(
									array(
										array(
											'field' => 'field_5fd7f99609457',
											'operator' => '==',
											'value' => 'map',
										),
									),
								),
								'wrapper' => array(
									'width' => '',
									'class' => '',
									'id' => '',
								),
								'center_lat' => '',
								'center_lng' => '',
								'zoom' => '',
								'height' => '',
								'max_pins' => '',
							),
							array(
								'key' => 'field_60fd8ff759eca',
								'label' => 'Map Coordinates',
								'name' => 'map_coordinates',
								'type' => 'repeater',
								'instructions' => '',
								'required' => 0,
								'conditional_logic' => array(
									array(
										array(
											'field' => 'field_5fd7f99609457',
											'operator' => '==',
											'value' => 'text',
										),
									),
								),
								'wrapper' => array(
									'width' => '',
									'class' => '',
									'id' => '',
								),
								'collapsed' => '',
								'min' => 0,
								'max' => 0,
								'layout' => 'row',
								'button_label' => 'Add Coordinates',
								'sub_fields' => array(
									array(
										'key' => 'field_60fd904159ecb',
										'label' => 'Coordinates',
										'name' => 'coordinates_text',
										'type' => 'text',
										'instructions' => 'Longitude and Latitude separated by a comma.
e.g. 51.4925,-0.16707',
										'required' => 0,
										'conditional_logic' => 0,
										'wrapper' => array(
											'width' => '',
											'class' => '',
											'id' => '',
										),
										'default_value' => '',
										'placeholder' => '',
										'prepend' => '',
										'append' => '',
										'maxlength' => '',
									),
								),
							),
						),
					),
				),
				'location' => array(
					array(
						array(
							'param' => 'post_type',
							'operator' => '==',
							'value' => 'static_map',
						),
					),
				),
				'menu_order' => 0,
				'position' => 'normal',
				'style' => 'seamless',
				'label_placement' => 'top',
				'instruction_placement' => 'label',
				'hide_on_screen' => '',
				'active' => true,
				'description' => '',
			));

		endif;
	}
}
