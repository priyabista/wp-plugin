<?php
/*
Plugin Name: Custom Post Type
Description: Welcome to this  plugin --
Version: 1.0
Author: Priya
*/

function registering_cp_type_movie(){
    register_post_type('cp_type_movie',
    array(
        'labels'      => array(
            'name'          => __('Movies', 'textdomain'),
            'singular_name' => __('Movie', 'textdomain'),
            'add_new'  => __('Add new Movie', 'textdomain'),
            'add_new_item' => __('Add new Movie', 'textdomain'),
        ),                 
            'public'      => true,
            'has_archive' => true,
            
    )
);
}
add_action('init','registering_cp_type_movie');

add_action('add_meta_boxes','cmb_details');

function cmb_details(){
    add_meta_box('cmb_id','Movie Details','cmb_form_movie_details',null,'side','high');
}
function cmb_form_movie_details($post){
    
    $release_date = get_post_meta($post->ID,'release_date',true);
    $director = get_post_meta($post->ID,'director',true);
    $casts = get_post_meta($post->ID,'casts',true);
    ?>
<div>
    <form action="" method="post">
        <label for="date">Movie Release Date:</label>
        <input type="text" name="release_date" value="<?= $release_date ?>" ><br><br>

        <label for="director">Director:</label>
        <input type="text" name="director" required   value="<?= $director ?>"><br><br>

        <label for="casts">Casts:</label>
        <input type="text" name="casts" required    value="<?= $casts ?>" ><br>

    </form>

</div>
<?php
    
}
function cmb_handle_movie_form_data($post_id){
        if(isset($_POST['release_date']) && isset($_POST['director']) && isset($_POST['casts'])){
            $release_date = sanitize_text_field($_POST['release_date']);
            $director = sanitize_text_field($_POST['director']);
            $casts = sanitize_textarea_field($_POST['casts']);
    
            update_post_meta($post_id, 'release_date', $release_date);
            update_post_meta($post_id, 'director', $director);
            update_post_meta($post_id, 'casts', $casts);
        
    }
}
add_action('save_post','cmb_handle_movie_form_data');


function cmb_display_movie_details($content){
    $after_content = '';
    global $post;
    $release_date = get_post_meta($post->ID,'release_date', true);
    $director = get_post_meta($post->ID,'director', true);
    $casts = get_post_meta($post->ID,'casts', true);
    
    $after_content= "Release date:".$release_date."<br>"."Director: ".$director."<br>"."Casts:".$casts;

    $content.=$after_content;

return $content;
}
add_filter('the_content', 'cmb_display_movie_details');
?>