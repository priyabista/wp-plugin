<?php
/*
Plugin Name: Menu and Submenu
Description: Welcome to this send email plugin --
Version: 1.0
Author: Priya
*/
add_action('admin_menu', 'add_movie_menu');
function add_movie_menu() {
    add_menu_page(
        'Movie Menu Page',
        'Movie',
        'manage_options',
        'movie',
        'movie_dashboard',
        'dashicons-admin-media',
        20
    );

    add_submenu_page(
        'movie',
        'dashboard',
        'Dashboard',
        'manage_options',
        'movie-dashboard',
        'movie_dashboard'
    );

    add_submenu_page(
        'movie',
        'setting',
        'Setting',
        'manage_options',
        'my-setting-section-form',
        'my_setting_form_page'
    );
}



function movie_dashboard(){
  echo "<h4>Welcome to Movie Dashboard</h4>";
}

function my_setting_form_page() {
    ?>
    <div class="wrap">
       
        <form  action="options.php" method="post">
            <?php settings_fields('my_setting_option_group'); ?>
            <?php do_settings_sections('my-setting-section-form'); ?>
            <?php submit_button('save'); ?>
        
        </form>
    </div>
    <?php
}

add_action('admin_init', 'moviesetting_form_options');

function moviesetting_form_options(){
   register_setting( 'my_setting_option_group', 'my_setting_option_group');
  register_setting( 'my_setting_option_group', 'setting_firstname'); 
  register_setting( 'my_setting_option_group', 'setting_gender'); 
  register_setting( 'my_setting_option_group', 'setting_department'); 
  register_setting( 'my_setting_option_group', 'setting_description'); 
  register_setting( 'my_setting_option_group', 'setting_role'); 

  add_settings_section('setting-section','Custom_Settings','my_settings_section_callback','my-setting-section-form');
  add_settings_field('setting_firstname','Firstname', 'my_setting_input_field_callback', 'my-setting-section-form','setting-section');
  add_settings_field('setting_gender', 'Gender', 'my_setting_radio_box_field_callback','my-setting-section-form','setting-section');
  add_settings_field('setting_department', 'Department', 'my_setting_check_box_callback','my-setting-section-form','setting-section');
  add_settings_field('setting_description', 'Description', 'my_setting_textarea_field_callback','my-setting-section-form','setting-section');
  add_settings_field('setting_role', 'Role', 'my_setting_dropdown_callback','my-setting-section-form','setting-section');
}

function my_setting_input_field_callback() {
    $options = get_option('setting_firstname');
    echo "<input type='text' name='setting_firstname' value='" .$options. "'/>";
}

function my_setting_radio_box_field_callback(){
  $options = get_option('setting_gender');
  echo "<label><input type='radio' name='setting_gender' value='male' " . checked('male', $options, false) . "> Male</label>&nbsp";
  echo "<label><input type='radio' name='setting_gender' value='female' " . checked('female', $options, false) . "> Female</label>&nbsp";
}

function my_setting_check_box_callback(){
  $option = get_option('setting_department');
 

  echo "<label><input type='checkbox' name='setting_department[]' value='BCA' " . checked(in_array('BCA', $option), true, false) . "> BCA</label>&nbsp";
  echo "<label><input type='checkbox' name='setting_department[]' value='BscCsit'  " . checked(in_array('BscCsit', $option), true, false) . "> Bsc Csit</label>";

 
}

function my_setting_textarea_field_callback(){
    $option = get_option('setting_description');
    echo "<input type='textarea' name='setting_description' value=' " .$option. "'/>";
}

function my_setting_dropdown_callback(){
    $option = get_option('setting_role');
    echo "<select name='setting_role'>";
    
    echo "<option value='Teacher' " . selected('Teacher', $option, false) . ">Teacher</option>";
    
    echo "<option value='Student' " . selected('Student', $option, false) . ">Student</option>";

    echo "</select>";
}

function my_settings_section_callback() {
    echo '<p>General settings for My Custom Plugin.</p>';
}

