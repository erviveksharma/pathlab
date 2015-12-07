<?php
/**
 * Created by PhpStorm.
 * User: Monty
 * Date: 06-11-2015
 * Time: 17:57
 */
?>
<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

if(!function_exists('active_link')) {
    /**
     * Add Active link to navigation
     * @param $controller - name to be active
     * @return string - class name
     */
    function activate_menu($controller) {
        // Getting CI class instance.
        $CI = get_instance();
        // Getting router class to active.
        $class = $CI->router->fetch_class();
        return ($class == $controller) ? 'active' : '';
    }
}?>