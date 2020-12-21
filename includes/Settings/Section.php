<?php
/**
 * @package StaticMaps
 */

namespace Includes\Settings;


class Section {
	public string $id;
	public string $title;
	public $callback;
	public string $page;

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