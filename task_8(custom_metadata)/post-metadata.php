<?php
/*
Plugin Name: Post Metadata
Description: Welcome to this send email plugin --
Version: 1.0
Author: Priya
*/

add_action('add_meta_boxes','cmb_details');

function cmb_details(){
    add_meta_box('cmb_id','Custom Metabox','cmb_form_person_details','post','side','high');
}
function cmb_form_person_details($post){
    
    $name = get_post_meta($post->ID,'name',true);
    $country = get_post_meta($post->ID,'country',true);
    $message = get_post_meta($post->ID,'message',true);
    ?>
<div>
    <form action="" method="post">
        <label for="name">Name:</label>
        <input type="text" name="name" placeholder="Enter your name"  required value="<?= $name; ?>"></br>

        <label for="country">Country:</label>
        <select id="country" name="country"  required>
            <option value="" disabled selected>Select your country</option>
            <option value="usa" <?php selected( $country, 'usa' ); ?>>United States</option>
            <option value="canada"  <?php selected( $country, 'canada' ); ?>>Canada</option>
            <option value="uk"  <?php selected( $country, 'uk' ); ?>>United Kingdom</option>
        </select></br>

        <label for="message">Message:</label>
        <textarea name="message" cols="30" rows="10"><?php echo $message; ?></textarea>

    </form>

</div>
<?php
    
}
function cmb_handle_person_form_data($post_id){
        if(isset($_POST['name']) && isset($_POST['country']) && isset($_POST['message'])){
            $name = sanitize_text_field($_POST['name']);
            $country = sanitize_text_field($_POST['country']);
            $message = sanitize_textarea_field($_POST['message']);
    
            update_post_meta($post_id, 'name', $name);
            update_post_meta($post_id, 'country', $country);
            update_post_meta($post_id, 'message', $message);
        
    }
}
add_action('save_post','cmb_handle_person_form_data');


function cmb_display_person_details($content){
    $after_content = '';
    global $post;
    $name = get_post_meta($post->ID,'name', true);
    $country = get_post_meta($post->ID,'country', true);
    $message = get_post_meta($post->ID,'message', true);
    
    $after_content= "My name is:".$name."<br>"."I am from: ".$country."<br>"."My message:".$message;

    $content.=$after_content;
return $content;
}
add_filter('the_content', 'cmb_display_person_details');

?>