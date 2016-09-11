<?php // Exit if accessed directly

if (!defined('ABSPATH')) {echo '<h1>Forbidden</h1>'; exit();}



// Dinamic Sidebar

if (!function_exists('dynamic_sidebar') || !dynamic_sidebar('wodog-widgets-aside-right')) :

    _e ('add widgets here', 'wodog');

endif;

?>