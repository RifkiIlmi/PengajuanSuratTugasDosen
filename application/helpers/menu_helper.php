<?php
if (!function_exists('active_link')) {
    function activate_menu($controller)
    {
        // mengambil class CI instance
        $CI = get_instance();
        // mendapatkan class active
        $class = $CI->router->fetch_class();
        return ($class == $controller) ? 'active' : '';
    }
}
