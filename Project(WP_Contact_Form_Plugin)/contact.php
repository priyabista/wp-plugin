<?php
/*
Plugin Name: Contact Form 
Description: Contact form to integrate into their website
Version: 1.0
Text Domain: contact-form
Author: Priya
*/

if(! defined('ABSPATH')){
    exit;
}

class Cf_Contact_Form{

    public function __construct() 
    {
    // error_log(print_r($file_name, true));
      
      $this->init_hooks();

      add_shortcode('contact_form', array($this, 'cf_show_template_frontend_contact_form'));
      add_shortcode('display_contact_form', array($this, 'cf_show_contact_table'));

      $this->includes();
    }

    private function init_hooks()
    {
        register_activation_hook(__FILE__, array($this, 'cf_create_table'));
        register_deactivation_hook(__FILE__, array($this, 'cf_remove_table'));
        register_uninstall_hook(__FILE__, 'contact_form_uninstall');
    }

    public function cf_create_table()
    {
      global $wpdb;
        
       $table_name = $wpdb->prefix . 'contact_form';

       $charset_collate = $wpdb->get_charset_collate();
    
       $sql = "CREATE TABLE  $table_name (id int(9) PRIMARY KEY NOT NULL AUTO_INCREMENT,Name varchar(255) NOT NULL, 
       Email varchar(255) NOT NULL, Subject varchar(255) NOT NULL, Message varchar(255) NOT NULL ) $charset_collate;";

       $wpdb->query($sql);
    }

    public function cf_remove_table()
    {
        global $wpdb;
        
        $table_name = $wpdb->prefix . 'contact_form';

        $sql = "TRUNCATE TABLE `$table_name`";

        $wpdb->query($sql);
    }

    public function includes()
    {
      include_once __DIR__ . "/includes/class-handle-retrieve-contact-form.php";
    }

    public function cf_show_template_frontend_contact_form()
    {
          ob_start(); // Start output buffering
          include_once dirname(__FILE__) . '/templates/contact-form.php';
          return ob_get_clean(); // Return the buffered content 
    }

    public function cf_show_contact_table()
    {
        ob_start(); 
        include_once dirname(__FILE__) . '/templates/table-contact.php';
        return ob_get_clean();  
    }
}

    $contact_form_obj = new  Cf_Contact_Form();

?>