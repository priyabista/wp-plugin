<?php
/*
Plugin Name: Hello world
Description: Welcome to this plugin -- 
Version: 1.0
Author: Priya
*/

function displayMessage(){
    echo '<div class="notice notice-success is-dismissible"><p>Hello World Plugin Activated! Additional message using add_action.</p></div>';
}

register_activation_hook(
    __FILE__, 'displayMessage'
   );
   
   add_action('my_custom_hook', 'displayMessage');
   do_action('my_custom_hook');
   
function notDisplayMessage(){
    echo '<h3>plugin-deactivated</h3>';
}

register_deactivation_hook(
  __FILE__, 'notDisplayMessage'
);
?>