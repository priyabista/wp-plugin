<?php
/*
Plugin Name: Template for User Registration
Description: Welcome to this send email plugin --
Version: 1.0
Author: Priya
*/

include_once('Shortcode_UR.php');

function handle_submit_user_registration_content(){
    if (isset($_POST['submit'])){
      error_log('Form submitted'); 
        $email = sanitize_email($_POST['user_email']);
        $password = wp_hash_password(sanitize_text_field($_POST['user_pass']));
        $username = sanitize_text_field($_POST['user_nicename']);
        $display_name = sanitize_text_field($_POST['display_name']);
        $firstname = sanitize_text_field($_POST['first_name']); 
        $lastname = sanitize_text_field($_POST['last_name']); 
        $fullname = $firstname . ' ' . $lastname;
        // $fullname = sanitize_text_field($_POST['user_login']);
        $role = sanitize_text_field($_POST['user_status']);
        

        $user_registration_data = array(
            'user_email'   => $email,
            'user_pass' => $password,
            'user_nicename'  => $username,
            'display_name' => $display_name,
            'user_login' => $fullname,
            'user_status' => $role

            
        );
    
    
        $user_id = wp_insert_user($user_registration_data);
         
      //  if($user_id){
      //   echo $fullname." registered successfully";
      //  }
       if (is_wp_error($user_id)) {
        error_log('User registration failed: ' . $user_id->get_error_message());
    }
    
        do_action('template_registration_data_after_post_insert', $user_registration_data); //to pass $email_data as argument of function wp_insert_post in hook
    
    }
    }
    add_action('init','handle_submit_user_registration_content');

function UserRegistrationForm(){
    ?>
     <div class="user-registration-form">
        <h2><center>User Registration</center></h2>
<form method="post">
   <div class="row">
    <div class="col-md-6">
          <div class="form-group">
            <label for="InputEmail1">Email address</label>
            <input type="email" name="user_email" class="form-control" placeholder="Enter email">
          </div>
          <div class="form-group">
            <label for="InputPassword1">Password</label>
            <input type="password" name="user_pass" class="form-control" placeholder="Password">
          </div>
          <div class="form-group">
            <label for="InputUsername">Username</label>
            <input type="text" name="user_nicename"  class="form-control">
          </div>
          <div class="form-group">
            <label for="InputDisplayname">Display Name</label>
            <input type="text" name="display_name"  class="form-control">
          </div>
          <div class="form-group">
            <label for="InputFirstName">First Name</label>
            <input type="text" name="first_name"  class="form-control">
          </div>
          <div class="form-group">
            <label for="InputLastName">Last Name</label>
            <input type="text" name="last_name" class="form-control">
          </div>
          <div class="form-group">
            <label for="InputRole">Role</label>
            <select name="user_status" class="form-control">
                <option value="subscriber">Subscriber</option>
                <option value="editor">Editor</option>
                <option value="administrator">Administrator</option>
            </select>
        </div>
        <div style="text-align:center; margin-top: 20px;">
        <input type="submit" name="submit" class="btn btn-primary">
        </div>
    </div>
   </div>
</form>
</div>
    <?php
}
