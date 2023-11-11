<?php
function silk_register_custom_post_types()
{
    //Register Services CPT
    $labels = array(
        'name'               => _x('Services', 'post type general name'),
        'singular_name'      => _x('Service', 'post type singular name'),
        'menu_name'          => _x('Services', 'admin menu'),
        'name_admin_bar'     => _x('Service', 'add new on admin bar'),
        'add_new'            => _x('Add New', 'service'),
        'add_new_item'       => __('Add New Service'),
        'new_item'           => __('New Service'),
        'edit_item'          => __('Edit Service'),
        'view_item'          => __('View Service'),
        'all_items'          => __('All Services'),
        'search_items'       => __('Search Services'),
        'parent_item_colon'  => __('Parent Services:'),
        'not_found'          => __('No Services found.'),
        'not_found_in_trash' => __('No Services found in Trash.'),
    );

    $args = array(
        'labels'             => $labels,
        'public'             => true,
        'publicly_queryable' => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'show_in_rest'       => true,
        'query_var'          => true,
        'rewrite'            => array('slug' => 'services'),
        'capability_type'    => 'post',
        'has_archive'        => false,
        'hierarchical'       => false,
        'menu_position'      => 7,
        'menu_icon'          => 'dashicons-smiley',
        'supports'           => array('title', 'thumbnail'),
        'template_lock'      => 'all'
    );

    register_post_type('silk-services', $args);

    //Register Testimonials CPT
    $labels = array(
        'name'               => _x('Testimonials', 'post type general name'),
        'singular_name'      => _x('Testimonial', 'post type singular name'),
        'menu_name'          => _x('Testimonials', 'admin menu'),
        'name_admin_bar'     => _x('Testimonial', 'add new on admin bar'),
        'add_new'            => _x('Add New', 'testimonial'),
        'add_new_item'       => __('Add New Testimonial'),
        'new_item'           => __('New Testimonial'),
        'edit_item'          => __('Edit Testimonial'),
        'view_item'          => __('View Testimonial'),
        'all_items'          => __('All Testimonials'),
        'search_items'       => __('Search Testimonials'),
        'parent_item_colon'  => __('Parent Testimonials:'),
        'not_found'          => __('No testimonials found.'),
        'not_found_in_trash' => __('No testimonials found in Trash.'),
    );

    $args = array(
        'labels'             => $labels,
        'public'             => true,
        'publicly_queryable' => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'show_in_rest'       => true,
        'query_var'          => true,
        'rewrite'            => array('slug' => 'testimonials'),
        'capability_type'    => 'post',
        'has_archive'        => true,
        'hierarchical'       => false,
        'menu_position'      => 7,
        'menu_icon'          => 'dashicons-businessperson',
        'supports'           => array('title'),
        'template_lock'      => 'all'
    );

    register_post_type('silk-testimonials', $args);
}

add_action('init', 'silk_register_custom_post_types');
