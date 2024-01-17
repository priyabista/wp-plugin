<?php
function add_user_register_menu() {
    add_menu_page(
        'User Register Page',
        'User Register',
        'manage_options',
        'user-register',
        '',
        '',
        20
    );

    add_submenu_page(
        'user-register',
        'add user',
        'Add User',
        'manage_options',
        'user-register',
        'simple_user_register_form'
    );
}

add_action('admin_menu', 'add_user_register_menu');
?>