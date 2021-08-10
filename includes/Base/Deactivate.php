<?php
/**
 * @package StaticMaps
 */

namespace StaticMaps\Base;

use StaticMaps\IRegister;

class Deactivate implements IRegister {
    public function register() {
        register_deactivation_hook( STATIC_MAPS_PLUGIN_FILE, array( $this, 'deactivate' ) );
    }

    public static function deactivate() {
        flush_rewrite_rules();
    }
}
