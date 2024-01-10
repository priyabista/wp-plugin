<?php
function handle_submit_email_content(){
    if (isset($_POST['submit_button'])){
        $email_subject = sanitize_text_field($_POST['email_subject']);
        $email_content = sanitize_textarea_field($_POST['email_content']);
        $send_to = sanitize_email($_POST['send_to']);
    
        $email_content = apply_filters('task4_email_content',$email_content);
    
    
      
    
        $email_data = array(
            'post_title'   => $email_subject,
            'post_content' => $email_content,
            'post_name'    => $send_to,
            
        );
    
    
        $post_id = wp_insert_post($email_data);
    
    
        do_action('task5_email_data_after_post_insert', $email_data); //to pass $email_data as argument of function wp_insert_post in hook
    
       
            wp_mail($send_to, $email_subject, $email_content);
    
       wp_redirect(admin_url('admin.php?page=send-email'));
        exit();
    }
    }
    add_action('admin_init','handle_submit_email_content');
?>