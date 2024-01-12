<?php
/*
Plugin Name: Settings API
Description: Welcome to this send email plugin --
Version: 1.0
Author: Priya
*/

add_action( 'admin_menu', 'register_my_setting' );

function register_my_setting() {

    add_options_page('My Custom Plugin Settings', 'Custom Settings', 'manage_options', 'my-custom-plugin-settings', 'my_custom_plugin_settings_page');
    
} 

function my_custom_plugin_settings_page() {
    ?>
    <div class="wrap">
       
        <form method="post" action="options.php">
            <?php settings_fields('my_custom_plugin_options'); ?>
            <?php do_settings_sections('my-custom-plugin-settings'); ?>
            <?php submit_button(); ?>
        </form>
    </div>
    <?php
}

add_action('admin_init', 'my_custom_plugin_register_setting');

function my_custom_plugin_register_setting(){
  register_setting( 'my_custom_plugin_options', 'my_custom_firstname'); 
  register_setting( 'my_custom_plugin_options', 'my_custom_gender'); 
  register_setting( 'my_custom_plugin_options', 'my_custom_department'); 
  register_setting( 'my_custom_plugin_options', 'my_custom_description'); 
  register_setting( 'my_custom_plugin_options', 'my_custom_role'); 

  add_settings_section('my_custom_plugin_general','Custom_Settings','my_custom_settings_section_callback','my-custom-plugin-settings');
  add_settings_field('my_custom_firstname','Firstname', 'my_custom_plugin_input_field_callback', 'my-custom-plugin-settings','my_custom_plugin_general');
  add_settings_field('my_custom_gender', 'Gender', 'my_custom_plugin_radio_box_field_callback','my-custom-plugin-settings','my_custom_plugin_general');
  add_settings_field('my_custom_department', 'Department', 'my_custom_plugin_check_box_callback','my-custom-plugin-settings','my_custom_plugin_general');
  add_settings_field('my_custom_description', 'Description', 'my_custom_plugin_textarea_field_callback','my-custom-plugin-settings','my_custom_plugin_general');
  add_settings_field('my_custom_role', 'Role', 'my_custom_plugin_dropdown_callback','my-custom-plugin-settings','my_custom_plugin_general');
}

function my_custom_plugin_input_field_callback() {
    $options = get_option('my_custom_firstname');
    echo "<input type='text' name='my_custom_firstname' value='$options'/>";
}

function my_custom_plugin_radio_box_field_callback(){
  $options = get_option('my_custom_gender');
  echo "<label><input type='radio' name='my_custom_gender' value='male'> Male</label>&nbsp";
  echo "<label><input type='radio' name='my_custom_gender' value='female'> Female</label>&nbsp";
}

function my_custom_plugin_check_box_callback(){
  $option = get_option('my_custom_checkbox');
  echo "<label><input type='checkbox' name='my_custom_department' value='BCA'> BCA</label>&nbsp";
  echo "<label><input type='checkbox' name='my_custom_department' value='Bsc Csit'>Bsc Csit</label>";
}

function my_custom_plugin_textarea_field_callback(){
    $option = get_option('my_custom_description');
    echo "<input type='textarea' name='my_custom_description' value='$option'/>";
}

function my_custom_plugin_dropdown_callback(){
    $option = get_option('my_custom_role');
    echo "<select name='my_custom_role'>";
    
    echo "<option value='Teacher'>Teacher</option>";
    
    echo "<option value='Student'>Student</option>";

    echo "</select>";
}

function my_custom_settings_section_callback() {
    echo '<p>General settings for My Custom Plugin.</p>';
}

