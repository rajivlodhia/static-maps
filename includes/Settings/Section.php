<?php
/**
 * @package StaticMaps
 */

namespace StaticMaps\Settings;


class Section {
	public $id;
	public $title;
	public $callback;
	public $page;

	public function __construct( $id, $title, $callback, $page ) {
		$this->id = $id;
		$this->title = $title;
		$this->callback = $callback;
		$this->page = $page;

		return $this;
	}

	public function register() {
		add_settings_section( $this->id, $this->title, $this->callback, $this->page );
	}

}
