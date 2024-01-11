<?php

function showTemplateFrontend($redirect_after_registration){
   
    ob_start(); // Start output buffering
    UserRegistrationForm(); // Your form function
    return ob_get_clean(); // Return the buffered content
    
}
add_shortcode('template_content_register', 'showTemplateFrontend');
?>