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
    register_post_type( 'don_faq', $args );

}
add_action( 'init', 'register_faq_post_type', 0 );



// Register Custom Activiteiten -----------------------------------------------------------------
function register_activiteiten_post_type() {

    $labels = array(
        'name'                  => _x( 'Activiteiten', 'Activiteiten', 'donbosco' ),
        'singular_name'         => _x( 'Activiteiten', 'Activiteiten', 'donbosco' ),
        'menu_name'             => __( 'Activiteiten', 'donbosco' ),
        'name_admin_bar'        => __( 'Activiteiten', 'donbosco' ),
        'archives'              => __( 'Activiteiten Archives', 'donbosco' ),
        'attributes'            => __( 'Activiteiten Attributes', 'donbosco' ),
        'parent_item_colon'     => __( 'Parent Activiteiten:', 'donbosco' ),
        'all_items'             => __( 'All Activiteiten', 'donbosco' ),
        'add_new_item'          => __( 'Add New Activiteiten', 'donbosco' ),
        'add_new'               => __( 'Add New', 'donbosco' ),
        'new_item'              => __( 'New Activiteiten', 'donbosco' ),
        'edit_item'             => __( 'Edit Activiteiten', 'donbosco' ),
        'update_item'           => __( 'Update Activiteiten', 'donbosco' ),
        'view_item'             => __( 'View Activiteiten', 'donbosco' ),
        'view_items'            => __( 'View Activiteiten', 'donbosco' ),
        'search_items'          => __( 'Search Activiteiten', 'donbosco' ),
        'not_found'             => __( 'Not found', 'donbosco' ),
        'not_found_in_trash'    => __( 'Not found in Trash', 'donbosco' ),
        'featured_image'        => __( 'Featured Image', 'donbosco' ),
        'set_featured_image'    => __( 'Set featured image', 'donbosco' ),
        'remove_featured_image' => __( 'Remove featured image', 'donbosco' ),
        'use_featured_image'    => __( 'Use as featured image', 'donbosco' ),
        'insert_into_item'      => __( 'Insert into Activiteiten', 'donbosco' ),
        'uploaded_to_this_item' => __( 'Uploaded to this Activiteiten', 'donbosco' ),
        'items_list'            => __( 'Activiteiten list', 'donbosco' ),
        'items_list_navigation' => __( 'Activiteiten list navigation', 'donbosco' ),
        'filter_items_list'     => __( 'Filter Activiteiten list', 'donbosco' ),
    );
    $args = array(
        'label'                 => __( 'Activiteiten', 'donbosco' ),
        'description'           => __( 'Alles activieiten', 'donbosco' ),
        'labels'                => $labels,
        'supports'              => array( 'title', 'editor', 'thumbnail', 'custom-fields', 'page-attributes' ),
        'hierarchical'          => false,
        'public'                => true,
        'show_ui'               => true,
        'show_in_menu'          => true,
        'menu_position'         => 5,
        'menu_icon'             => 'dashicons-list-view',
        'show_in_admin_bar'     => true,
        'show_in_nav_menus'     => true,
        'can_export'            => true,
        'has_archive'           => true,
        'exclude_from_search'   => false,
        'publicly_queryable'    => true,
        'capability_type'       => 'page',
    );
    register_post_type( 'activiteiten', $args );

}
add_action( 'init', 'register_activiteiten_post_type', 0 );


// Register Custom Download Post Type
function register_download_post_type() {

    $labels = array(
        'name'                  => _x( 'Downloads', 'Downloads', 'donbosco' ),
        'singular_name'         => _x( 'Download', 'Download', 'donbosco' ),
        'menu_name'             => __( 'Downloads', 'donbosco' ),
        'name_admin_bar'        => __( 'Downloads', 'donbosco' ),
        'archives'              => __( 'Download Archives', 'donbosco' ),
        'attributes'            => __( 'Download Attributes', 'donbosco' ),
        'parent_item_colon'     => __( 'Parent Download:', 'donbosco' ),
        'all_items'             => __( 'All Downloads', 'donbosco' ),
        'add_new_item'          => __( 'Add New Download', 'donbosco' ),
        'add_new'               => __( 'Add New', 'donbosco' ),
        'new_item'              => __( 'New Download', 'donbosco' ),
        'edit_item'             => __( 'Edit Download', 'donbosco' ),
        'update_item'           => __( 'Update Download', 'donbosco' ),
        'view_item'             => __( 'View Download', 'donbosco' ),
        'view_items'            => __( 'View Downloads', 'donbosco' ),
        'search_items'          => __( 'Search Download', 'donbosco' ),
        'not_found'             => __( 'Not found', 'donbosco' ),
        'not_found_in_trash'    => __( 'Not found in Trash', 'donbosco' ),
        'featured_image'        => __( 'Featured Image', 'donbosco' ),
        'set_featured_image'    => __( 'Set featured image', 'donbosco' ),
        'remove_featured_image' => __( 'Remove featured image', 'donbosco' ),
        'use_featured_image'    => __( 'Use as featured image', 'donbosco' ),
        'insert_into_item'      => __( 'Insert into Download', 'donbosco' ),
        'uploaded_to_this_item' => __( 'Uploaded to this Download', 'donbosco' ),
        'items_list'            => __( 'Downloads list', 'donbosco' ),
        'items_list_navigation' => __( 'Downloads list navigation', 'donbosco' ),
        'filter_items_list'     => __( 'Filter Downloads list', 'donbosco' ),
    );
    $args = array(
        'label'                 => __( 'Download', 'donbosco' ),
        'description'           => __( 'Downloads', 'donbosco' ),
        'labels'                => $labels,
        'supports'              => array( 'title', 'editor', 'thumbnail', 'custom-fields', 'page-attributes' ),
        'hierarchical'          => false,
        'public'                => true,
        'show_ui'               => true,
        'show_in_menu'          => true,
        'menu_position'         => 5,
        'menu_icon'             => 'dashicons-download',
        'show_in_admin_bar'     => true,
        'show_in_nav_menus'     => true,
        'can_export'            => true,
        'has_archive'           => true,
        'exclude_from_search'   => false,
        'publicly_queryable'    => true,
        'capability_type'       => 'page',
    );
    register_post_type( 'download_items', $args );

}
add_action( 'init', 'register_download_post_type', 0 );

// Career post type

function create_vacatures_post_type() {
    $labels = array(
        'name'                  => _x( 'Vacatures', 'Post Type General Name', 'donbosco' ),
        'singular_name'         => _x( 'Vacature', 'Post Type Singular Name', 'donbosco' ),
        'menu_name'             => __( 'Vacatures', 'donbosco' ),
        'all_items'             => __( 'Alle Vacatures', 'donbosco' ),
        'add_new_item'          => __( 'Nieuwe Vacature Toevoegen', 'donbosco' ),
        'add_new'               => __( 'Nieuwe Toevoegen', 'donbosco' ),
        'new_item'              => __( 'Nieuwe Vacature', 'donbosco' ),
        'edit_item'             => __( 'Bewerk Vacature', 'donbosco' ),
        'update_item'           => __( 'Update Vacature', 'donbosco' ),
        'view_item'             => __( 'Bekijk Vacature', 'donbosco' ),
        'search_items'          => __( 'Zoek Vacatures', 'donbosco' ),
        'not_found'             => __( 'Niet gevonden', 'donbosco' ),
        'not_found_in_trash'    => __( 'Niet gevonden in prullenbak', 'donbosco' ),
    );
    $args = array(
        'label'                 => __( 'Vacature', 'donbosco' ),
        'description'           => __( 'Vacatures', 'donbosco' ),
        'labels'                => $labels,
        'supports'              => array( 'title', 'editor', 'thumbnail', 'excerpt', 'custom-fields' ),
        'hierarchical'          => false,
        'public'                => true,
        'show_ui'               => true,
        'show_in_menu'          => true,
        'menu_position'         => 5,
        'menu_icon'             => 'dashicons-portfolio',
        'show_in_admin_bar'     => true,
        'show_in_nav_menus'     => true,
        'can_export'            => true,
        'has_archive'           => true,
        'exclude_from_search'   => false,
        'publicly_queryable'    => true,
        'capability_type'       => 'post',
    );
    register_post_type( 'vacatures', $args );
}
add_action( 'init', 'create_vacatures_post_type', 0 );