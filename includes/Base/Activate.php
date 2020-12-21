<?php
/**
 * @package StaticMaps
 */

namespace Includes\Base;

use Includes\IRegister;
use Includes\Base\Constants;

class Activate implements IRegister{
    public function register() {
        register_activation_hook( STATIC_MAPS_PLUGIN_FILE, array( $this, 'activate' ) );
    }

    public static function activate() {
        flush_rewrite_rules();
    }
}
