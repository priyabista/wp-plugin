<?php

class Cf_Retrieve_Handle_Form
{

    public function __construct() 
    {
      add_action('wp_enqueue_scripts', array($this, 'cf_enqueue'));

      add_action('wp_ajax_contact_details', array($this, 'cf_save_new_contact_info'));
      add_action('wp_ajax_nopriv_contact_details', array($this, 'cf_save_new_contact_info'));

      add_action('wp_ajax_retrieve_contact_data', array($this, 'cf_display_contact_form_details'));
      add_action('wp_ajax_nopriv_retrieve_contact_data', array($this, 'cf_display_contact_form_details'));

      add_action('wp_ajax_update_contact_data', array($this, 'cf_update_contact_form_details'));
      add_action('wp_ajax_nopriv_update_contact_data', array($this, 'cf_update_contact_form_details'));

      add_action('wp_ajax_delete_contact_data', array($this, 'cf_delete_contact_form_details'));
      add_action('wp_ajax_nopriv_delete_contact_data', array($this, 'cf_delete_contact_form_details'));

    }
    public function includes()
    {
      include_once dirname(__DIR__) . '/templates/contact-form.php';
      include_once dirname(__DIR__) . '/templates/table-contact.php';
    }
    public function cf_enqueue()
    {
        wp_enqueue_script(
          'ajax-script',
          plugins_url('/assets/js/insert.js', __DIR__),
          array('jquery'),
          '1.0',
          true
        );
        wp_enqueue_script(
          'custom-script',
          plugins_url('/assets/js/retrieve.js', __DIR__),
          array('jquery'),
          '1.0',
          true
        );
        wp_enqueue_script(
          'update-script',
          plugins_url('/assets/js/update.js', __DIR__),
          array('jquery'),
          '1.0',
          true
        );
        wp_enqueue_script(
          'bootstrap-script',
          'https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js'
        );
        wp_localize_script(
          'ajax-script',
          'my_ajax_obj',
          array(
          'ajaxUrl' => admin_url('admin-ajax.php'),
          )
        );
        wp_enqueue_style(
          'style',
          plugins_url('/assets/css/style.css', __DIR__),
          null,
          '1.0',
          'all'
        );
        wp_enqueue_style('bootstrap', 
        'https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css');
    }
        function cf_save_new_contact_info()
      {
        if (!isset($_POST['nonce']) || !wp_verify_nonce($_POST['nonce'], 'cf_new_user')) 
        {
          //  wp_send_json_error()
            die(esc_html_e('Something went wrong, please try again!!', 'contact-form'));
        }

        global $wpdb;
        $table_name = $wpdb->prefix . 'contact_form';
        $name = sanitize_text_field($_POST['Name']);
        $email = sanitize_email($_POST['Email']);
        $subject = sanitize_text_field($_POST['Subject']);
        $message = sanitize_text_field($_POST['Message']);

        if (!$this->cf_validate_email($email)) 
        {
            esc_html_e('Invalid email address format.', 'contact-form');
            wp_die();
        }

        $duplicate_email = $wpdb->get_var($wpdb->prepare("SELECT Email FROM $table_name WHERE Email = %s", $email));

        if ($duplicate_email !== null) 
        {
            $update_data = array(
                'Subject' => $subject,
                'Message' => $message,
            );
            $where = array('Email' => $email);
            $wpdb->update($table_name, $update_data, $where);
            esc_html_e('Subject and Message Updated.', 'contact-form');
        } else 
          {
            // Email does not exist, insert new record
            $data = $wpdb->insert($table_name, array(
                'Name' => $name,
                'Email' => $email,
                'Subject' => $subject,
                'Message' => $message,
            ));
        
            if ($data) {
                esc_html_e('Registered Successfully', 'contact-form');
            } else {
                esc_html_e('User creation failed. Please check the error logs for more information.', 'contact-form');
            }
          }

        wp_die();
      }
      function cf_validate_email($email)
      {
        $pattern = "/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/";
        return preg_match($pattern, $email);  
      }

      function cf_display_contact_form_details() 
      {
        global $wpdb;
        $table_name = $wpdb->prefix . 'contact_form';
        
        $data = array();
        
        $orderBy = isset($_GET['orderby']) ? esc_sql($_GET['orderby']) : '';
        $order = isset($_GET['order']) ? esc_sql($_GET['order']) : '';
        $search = isset($_GET['search']) ? esc_sql($_GET['search']) : '';
    
        $sql = "SELECT * FROM $table_name";
    
          if (!empty($search)) {
            // add search condition to SQL query
            $sql .= " WHERE Name LIKE '%$search%' OR Email LIKE '%$search%'";
          }
      
          if ($order != "" && $orderBy != "") {
            $sql .= " ORDER BY $orderBy $order";
          }
    
        $data = $wpdb->get_results($sql, ARRAY_A);

        $data = apply_filters('cf_display_contact_form_details', $data, $order, $orderBy);
    
        wp_send_json_success(array('data' => $data));
    
        wp_die();
      }

      function cf_update_contact_form_details()
      {
        global $wpdb;
        $id = intval(sanitize_text_field($_POST['id']));
      
        $update_data = $wpdb->update($wpdb->prefix.'contact_form',
        array(
          'name' => sanitize_text_field($_POST['Name']),
           'email' => sanitize_text_field($_POST['Email']),
           'subject' => sanitize_text_field($_POST['Subject']),
           'message' => sanitize_text_field($_POST['Message'])
        ),
        array('id' => $id)
        );
      }
  
      function cf_delete_contact_form_details()
      {
         global $wpdb;
         $id = intval(sanitize_text_field($_GET['id']));
         error_log(print_r($id, true));
         $delete_data = $wpdb->delete($wpdb->prefix. 'contact_form',
         array(
            'id' => $id
         ),
        );
      }   
}
 new Cf_Retrieve_Handle_Form();
?>