<?php
/**
 * @package StaticMaps
 */

namespace StaticMaps\Settings;


class Setting {

	public string $option_group;
	public string $option_name;
	public $callback;

	public function __construct($option_group, $option_name, $callback = '') {
		$this->option_group = $option_group;
		$this->option_name = $option_name;
		$this->callback = $callback;

		return $this;
	}

	public function register() {
		register_setting( $this->option_group, $this->option_name, $this->callback );
	}

}