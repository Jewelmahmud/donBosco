<?php

function register_faq_taxonomies() {
    // Add Category taxonomy
    $category_labels = array(
        'name'              => _x( 'FAQ Categories', 'FAQ general name', 'donbosco' ),
        'singular_name'     => _x( 'FAQ Category', 'FAQ singular name', 'donbosco' ),
        'search_items'      => __( 'Search FAQ Categories', 'donbosco' ),
        'all_items'         => __( 'All FAQ Categories', 'donbosco' ),
        'parent_item'       => __( 'Parent FAQ Category', 'donbosco' ),
        'parent_item_colon' => __( 'Parent FAQ Category:', 'donbosco' ),
        'edit_item'         => __( 'Edit FAQ Category', 'donbosco' ),
        'update_item'       => __( 'Update FAQ Category', 'donbosco' ),
        'add_new_item'      => __( 'Add New FAQ Category', 'donbosco' ),
        'new_item_name'     => __( 'New FAQ Category Name', 'donbosco' ),
        'menu_name'         => __( 'FAQ Categories', 'donbosco' ),
    );
    $category_args = array(
        'hierarchical'      => true,
        'labels'            => $category_labels,
        'show_ui'           => true,
        'show_admin_column' => true,
        'query_var'         => true,
        'rewrite'           => array( 'slug' => 'faq-category' ),
    );
    register_taxonomy( 'faq_category', array( 'don_faq' ), $category_args );

}
add_action( 'init', 'register_faq_taxonomies', 0 );
