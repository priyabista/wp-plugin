<?php
/*
Plugin name: Register User
Description: Welcome to User Registration
Version: 1.0
Author: priya
*/

require_once 'add_register_menu.php';

add_action('admin_enqueue_scripts', 'my_enqueue');

function my_enqueue($hook){
	
	if('toplevel_page_user-register' !== $hook){
		return;
	}


	wp_enqueue_script(
		'ajax-script',
		plugins_url('/js/myjquery.js', __FILE__),
        array('jquery'),
		'1.0.0',
		true,
	);
	wp_localize_script(
      'ajax-script',
	  'my_ajax_obj',
	  array(
		'ajax_url' => admin_url('admin-ajax.php','admin'),
	  )
	);

}
add_action('wp_ajax_register_user', 'validate_new_user');
// add_action('wp_ajax_nopriv_register_user', 'validate_new_user');

 function validate_new_user(){
  
	if(!isset($_POST['nonce']) || !wp_verify_nonce($_POST['nonce'],'ur_new_user')){
		die('Something went wrong, please try again!!');
	}
	if(isset($_POST['user_login']) && isset($_POST['user_email']) && isset($_POST['user_pass'])){
		$username = sanitize_text_field($_POST['user_login']);
		$email =  sanitize_email($_POST['user_email']);
		$password = wp_hash_password(sanitize_text_field($_POST['user_pass']));

		$user_data = array(
			'user_login' => $username,
			'user_email' => $email,
			'user_pass' => $password,
		);
	
		$user_id = wp_insert_user($user_data);

		if($user_id){
			echo " registered successfully";
		  }
	   else {
			
			echo 'User creation failed. Please check the error logs for more information.';
		}
		
		wp_die();
	}
	}
	

function simple_user_register_form(){
    ?>
	<div class="reg_Form">
   <form action="<?php echo admin_url('admin-ajax.php') ?>"  id="registrationForm" method="post">
        <label for="username">Username:</label>
        <input type="text" id="username" name="user_login" required><br><br>

        <label for="email">Email:</label>
        <input type="email" id="email" name="user_email" required><br><br>

        <label for="password">Password:</label>
        <input type="password" id="password" name="user_pass" required><br><br>
    <?php
	wp_nonce_field('ur_new_user','ur_new_user_nonce',true, true);
	submit_button(null, 'primary', 'submit_button');
	?>
    </form>
	<div class="result-message">

	</div>
    </div>
  <?php
}
?>