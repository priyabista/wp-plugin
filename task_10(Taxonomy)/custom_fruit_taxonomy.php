<?php
/*
Plugin name: Fruits
Description: Welcome to Fruit Taxonomy
Version: 1.0
Author: priya
*/

function cf_register_fruits(){
    $labels  = array(
    'name'  => _x('Fruits', 'taxonomy general name'),
    'singular_name' => _x('Fruit', 'taxonomy singular name'),
    'search_items' => __('Search Fruits'),
    'all_items' => __('All Fruits'),
    'parent_item' => __('Parent Course'),
    'parent_item_colon' => __('Parent Course:'),
    'edit_item' => __('Edit Fruit'),
    'update_item' => __('Update Fruit'),
    'add_new_item' => __('Add New Fruit'),
    'new_item_name' => __('New Fruit Name'),
    'menu_name' => __('Fruit'),
     );
    $args =array(
     'hierarchical' => true,
     'labels' => $labels,
     'show_ui' => true,
     'show_in_rest' => true,
     'show_admin_column' => true,
     'query_var' => true,
     'rewrite' =>['slug' => 'fruit'],
      'publicly_queryable' => true,
    );
    register_taxonomy('fruit','post', $args);
   
}

add_action('init', 'cf_register_fruits');
?>