<?php

// Exit if accessed directly
if( !defined( 'ABSPATH' ) ) {
    die;
}


// Register Custom FAQ -----------------------------------------------------------------
function register_faq_post_type() {

    $labels = array(
        'name'                  => _x( 'FAQs', 'FAQs', 'donbosco' ),
        'singular_name'         => _x( 'FAQ', 'FAQ', 'donbosco' ),
        'menu_name'             => __( 'FAQs', 'donbosco' ),
        'name_admin_bar'        => __( 'FAQ', 'donbosco' ),
        'archives'              => __( 'FAQ Archives', 'donbosco' ),
        'attributes'            => __( 'FAQ Attributes', 'donbosco' ),
        'parent_item_colon'     => __( 'Parent FAQ:', 'donbosco' ),
        'all_items'             => __( 'All FAQs', 'donbosco' ),
        'add_new_item'          => __( 'Add New FAQ', 'donbosco' ),
        'add_new'               => __( 'Add New', 'donbosco' ),
        'new_item'              => __( 'New FAQ', 'donbosco' ),
        'edit_item'             => __( 'Edit FAQ', 'donbosco' ),
        'update_item'           => __( 'Update FAQ', 'donbosco' ),
        'view_item'             => __( 'View FAQ', 'donbosco' ),
        'view_items'            => __( 'View FAQs', 'donbosco' ),
        'search_items'          => __( 'Search FAQ', 'donbosco' ),
        'not_found'             => __( 'Not found', 'donbosco' ),
        'not_found_in_trash'    => __( 'Not found in Trash', 'donbosco' ),
        'featured_image'        => __( 'Featured Image', 'donbosco' ),
        'set_featured_image'    => __( 'Set featured image', 'donbosco' ),
        'remove_featured_image' => __( 'Remove featured image', 'donbosco' ),
        'use_featured_image'    => __( 'Use as featured image', 'donbosco' ),
        'insert_into_item'      => __( 'Insert into FAQ', 'donbosco' ),
        'uploaded_to_this_item' => __( 'Uploaded to this FAQ', 'donbosco' ),
        'items_list'            => __( 'FAQs list', 'donbosco' ),
        'items_list_navigation' => __( 'FAQs list navigation', 'donbosco' ),
        'filter_items_list'     => __( 'Filter FAQs list', 'donbosco' ),
    );
    $args = array(
        'label'                 => __( 'FAQ', 'donbosco' ),
        'description'           => __( 'Frequently Asked Questions', 'donbosco' ),
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










