<?php

// Exit if accessed directly
if( !defined( 'ABSPATH' ) ) {
    die;
}


// Register Custom FAQ -----------------------------------------------------------------
function register_faq_post_type() {

    $labels = array(
        'name'                  => _x( 'FAQs', 'FAQs', 'b2works' ),
        'singular_name'         => _x( 'FAQ', 'FAQ', 'b2works' ),
        'menu_name'             => __( 'FAQs', 'b2works' ),
        'name_admin_bar'        => __( 'FAQ', 'b2works' ),
        'archives'              => __( 'FAQ Archives', 'b2works' ),
        'attributes'            => __( 'FAQ Attributes', 'b2works' ),
        'parent_item_colon'     => __( 'Parent FAQ:', 'b2works' ),
        'all_items'             => __( 'All FAQs', 'b2works' ),
        'add_new_item'          => __( 'Add New FAQ', 'b2works' ),
        'add_new'               => __( 'Add New', 'b2works' ),
        'new_item'              => __( 'New FAQ', 'b2works' ),
        'edit_item'             => __( 'Edit FAQ', 'b2works' ),
        'update_item'           => __( 'Update FAQ', 'b2works' ),
        'view_item'             => __( 'View FAQ', 'b2works' ),
        'view_items'            => __( 'View FAQs', 'b2works' ),
        'search_items'          => __( 'Search FAQ', 'b2works' ),
        'not_found'             => __( 'Not found', 'b2works' ),
        'not_found_in_trash'    => __( 'Not found in Trash', 'b2works' ),
        'featured_image'        => __( 'Featured Image', 'b2works' ),
        'set_featured_image'    => __( 'Set featured image', 'b2works' ),
        'remove_featured_image' => __( 'Remove featured image', 'b2works' ),
        'use_featured_image'    => __( 'Use as featured image', 'b2works' ),
        'insert_into_item'      => __( 'Insert into FAQ', 'b2works' ),
        'uploaded_to_this_item' => __( 'Uploaded to this FAQ', 'b2works' ),
        'items_list'            => __( 'FAQs list', 'b2works' ),
        'items_list_navigation' => __( 'FAQs list navigation', 'b2works' ),
        'filter_items_list'     => __( 'Filter FAQs list', 'b2works' ),
    );
    $args = array(
        'label'                 => __( 'FAQ', 'b2works' ),
        'description'           => __( 'Frequently Asked Questions', 'b2works' ),
        'labels'                => $labels,
        'supports'              => array( 'title', 'editor', 'thumbnail', 'custom-fields', 'page-attributes' ),
        'hierarchical'          => false,
        'public'                => true,
        'show_ui'               => true,
        'show_in_menu'          => true,
        'menu_position'         => 5,
        'menu_icon'             => 'dashicons-welcome-learn-more', // Customize the dash icon
        'show_in_admin_bar'     => true,
        'show_in_nav_menus'     => true,
        'can_export'            => true,
        'has_archive'           => true,
        'exclude_from_search'   => false,
        'publicly_queryable'    => true,
        'capability_type'       => 'page',
    );
    register_post_type( 'faq', $args );

}
add_action( 'init', 'register_faq_post_type', 0 );



// Register Custom Post Type
function create_custom_post_type_vacancies() {
    $labels = array(
        'name'                  => _x('Vacancies', 'Post Type General Name', 'b2works'),
        'singular_name'         => _x('Vacancy', 'Post Type Singular Name', 'b2works'),
        'menu_name'             => __('Vacancies', 'b2works'),
        'name_admin_bar'        => __('Vacancy', 'b2works'),
        'archives'              => __('Vacancy Archives', 'b2works'),
        'attributes'            => __('Vacancy Attributes', 'b2works'),
        'parent_item_colon'     => __('Parent Vacancy:', 'b2works'),
        'all_items'             => __('All Vacancies', 'b2works'),
        'add_new_item'          => __('Add New Vacancy', 'b2works'),
        'add_new'               => __('Add New', 'b2works'),
        'new_item'              => __('New Vacancy', 'b2works'),
        'edit_item'             => __('Edit Vacancy', 'b2works'),
        'update_item'           => __('Update Vacancy', 'b2works'),
        'view_item'             => __('View Vacancy', 'b2works'),
        'view_items'            => __('View Vacancies', 'b2works'),
        'search_items'          => __('Search Vacancy', 'b2works'),
        'not_found'             => __('Not found', 'b2works'),
        'not_found_in_trash'    => __('Not found in Trash', 'b2works'),
        'featured_image'        => __('Featured Image', 'b2works'),
        'set_featured_image'    => __('Set featured image', 'b2works'),
        'remove_featured_image' => __('Remove featured image', 'b2works'),
        'use_featured_image'    => __('Use as featured image', 'b2works'),
        'insert_into_item'      => __('Insert into Vacancy', 'b2works'),
        'uploaded_to_this_item' => __('Uploaded to this Vacancy', 'b2works'),
        'items_list'            => __('Vacancies list', 'b2works'),
        'items_list_navigation' => __('Vacancies list navigation', 'b2works'),
        'filter_items_list'     => __('Filter Vacancies list', 'b2works'),
    );
    $args = array(
        'label'                 => __('Vacancy', 'b2works'),
        'description'           => __('Vacancy Description', 'b2works'),
        'labels'                => $labels,
        'supports'              => array('title', 'editor', 'custom-fields'),
        'taxonomies'            => array('job_category'),
        'hierarchical'          => false,
        'public'                => true,
        'show_ui'               => true,
        'show_in_menu'          => true,
        'menu_position'         => 5,
        'show_in_admin_bar'     => true,
        'show_in_nav_menus'     => true,
        'menu_icon'             => 'dashicons-businessman', // Specify your dashicon class here
        'can_export'            => true,
        'has_archive'           => true,
        'exclude_from_search'   => false,
        'publicly_queryable'    => true,
        'capability_type'       => 'post',
    );
    register_post_type('vacancies', $args);
}

// Hook into the 'init' action
add_action('init', 'create_custom_post_type_vacancies', 0);








