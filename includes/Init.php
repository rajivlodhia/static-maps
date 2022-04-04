<?php
/**
 * @package StaticMaps
 */

namespace StaticMaps;

final class Init {
	/**
	 * Register all our services by creating a new instance of
	 * our classes and running the register function inside.
	 */
	public static function register_services() {
		foreach ( self::get_services() as $class ) {
			$service = self::instantiate( $class );
			if ( method_exists( $service, 'register' ) ) {
				$service->register();
			}
		}
	}

	/**
	 * Returns an array of classes to be instantiated.
	 */
	public static function get_services() {
		return [
			Base\Activate::class,
			Base\Deactivate::class,
			Pages\Admin::class,
			Settings\StaticMapsACFFields::class,
			PostTypes\StaticMapsPostType::class,
			Base\StaticMapShortcode::class,
		];
	}

	/**
	 * Used to instantiate our classes in register_services().
	 */
	private static function instantiate( $class ) {
		return new $class;
	}
}
