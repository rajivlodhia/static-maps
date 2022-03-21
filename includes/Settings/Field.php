<?php
/**
 * @package StaticMaps
 */

namespace StaticMaps\Settings;


class Field {
	public $id;
	public $title;
	public $callback;
	public $page;
	public $section;
	public $args;

	public function __construct( $id, $title, $callback, $page, $section = 'default', $args = [] ) {
		$this->id = $id;
		$this->title = $title;
		$this->callback = $callback;
		$this->page = $page;
		$this->section = $section;
		$this->args = $args;

		return $this;
	}

	public function register() {
		$section = $this->section;
		// Handle passing the full Section object.
		if ( $this->section instanceof Section ) {
			$section = $this->section->id;
		}
		add_settings_field( $this->id, $this->title, $this->callback, $this->page, $section, $this->args );
	}
}
