<?php
/**
 * Child-Theme functions and definitions
 */


function vixus_child_scripts() {
    wp_enqueue_style( 'vixus-style', get_template_directory_uri(). '/style.css' );

    wp_enqueue_script( 'js-functions', get_stylesheet_directory_uri() . '/assets/js/js-functions.js' );
}
add_action( 'wp_enqueue_scripts', 'vixus_child_scripts' );


/*
* Creating a function to create our Custom Post Type
*/
function custom_post_type() {
    $labels = array(
        'name'               => _x( 'Job Position', 'post type general name', 'cosmic' ),
        'singular_name'      => _x( 'Job Position', 'post type singular name', 'cosmic' ),
        'menu_name'          => _x( 'Job Position', 'admin menu', 'cosmic' ),
        'name_admin_bar'     => _x( 'Job Position', 'add new on admin bar', 'cosmic' ),
        'add_new'            => _x( 'Add Job Position', 'book', 'cosmic' ),
        'add_new_item'       => __( 'Add New Job Position', 'cosmic' ),
        'new_item'           => __( 'New Job Position', 'cosmic' ),
        'edit_item'          => __( 'Edit Job Position', 'cosmic' ),
        'view_item'          => __( 'View Job Position', 'cosmic' ),
        'all_items'          => __( 'All Job Positions  ', 'cosmic' ),
        'search_items'       => __( 'Search Job Position', 'cosmic' ),
        'parent_item_colon'  => __( 'Parent Job Position:', 'cosmic' ),
        'not_found'          => __( 'No Job Position found.', 'cosmic' ),
        'not_found_in_trash' => __( 'No Job Position found in Trash.', 'cosmic' ),
    );
    $args = array(
        'public' => true,
        'labels' => $labels,
        'menu_icon' => 'dashicons-businessman',
        'has_archive' => false,
        'show_in_rest' => true,
        'taxonomies' => array( 'category','post_tag' ),
        'supports' => array( 'title', 'editor', 'thumbnail', 'author', 'excerpt' ),
        'rewrite' => array (
            'slug'=> 'careers',
            'with_front' => FALSE
        ),
    );
    register_post_type( 'job_position', $args );
}
add_action( 'init', 'custom_post_type', 0 );


include "inc/shortcodes.php";