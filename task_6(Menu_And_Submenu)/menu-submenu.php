<?php
/*
Plugin Name: Menu and Submenu
Description: Welcome to this send email plugin --
Version: 1.0
Author: Priya
*/
function add_movie_menu() {
    add_menu_page(
        'Movie Menu Page',
        'Movie',
        'manage_options',
        'movie',
        '',
        'dashicons-admin-media',
        20
    );

    add_submenu_page(
        'movie',
        'dashboard',
        'Dashboard',
        'manage_options',
        'movie-dashboard',
        ''
    );

    add_submenu_page(
        'movie',
        'setting',
        'Setting',
        'manage_options',
        'movie-setting',
        ''
    );
}

add_action('admin_menu', 'add_movie_menu');