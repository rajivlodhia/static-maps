<?php
/**
 * @package StaticMaps
 */

namespace Includes;

 /**
  * Ensure all the necessary classes have a register function
  * so the required functions are triggered on Init.
  */
interface IRegister {
    public function register();
}
