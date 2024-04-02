<?php

// Register Custom FAQ Category
function FAQCategory() {

	$labels = array(
		'name'                       => _x( 'FAQ Category', 'FAQ Category', 'donbosco' ),
		'singular_name'              => _x( 'FAQ Category', 'FAQ Category', 'donbosco' ),
		'menu_name'                  => __( 'FAQ Category', 'donbosco' ),
		'all_items'                  => __( 'All Items', 'donbosco' ),
		'parent_item'                => __( 'Parent Item', 'donbosco' ),
		'parent_item_colon'          => __( 'Parent Item:', 'donbosco' ),
		'new_item_name'              => __( 'New Item Name', 'donbosco' ),
		'add_new_item'               => __( 'Add New Item', 'donbosco' ),
		'edit_item'                  => __( 'Edit Item', 'donbosco' ),
		'update_item'                => __( 'Update Item', 'donbosco' ),
		'view_item'                  => __( 'View Item', 'donbosco' ),
		'separate_items_with_commas' => __( 'Separate items with commas', 'donbosco' ),
		'add_or_remove_items'        => __( 'Add or remove items', 'donbosco' ),
		'choose_from_most_used'      => __( 'Choose from the most used', 'donbosco' ),
		'popular_items'              => __( 'Popular Items', 'donbosco' ),
		'search_items'               => __( 'Search Items', 'donbosco' ),
		'not_found'                  => __( 'Not Found', 'donbosco' ),
		'no_terms'                   => __( 'No items', 'donbosco' ),
		'items_list'                 => __( 'Items list', 'donbosco' ),
		'items_list_navigation'      => __( 'Items list navigation', 'donbosco' ),
	);
	$args = array(
		'labels'                     => $labels,
		'hierarchical'               => true,
		'public'                     => true,
		'show_ui'                    => true,
		'show_admin_column'          => true,
		'show_in_nav_menus'          => true,
		'show_tagcloud'              => true,
	);
	register_taxonomy( 'faq_category', array( 'faq' ), $args );

}
add_action( 'init', 'FAQCategory', 0 );


// Register Custom Taxonomy for vaccancy post
function register_job_category_taxonomy() {
    $labels = array(
        'name'                       => _x('Job Industries', 'Taxonomy General Name', 'donbosco'),
        'singular_name'              => _x('Job Industry', 'Taxonomy Singular Name', 'donbosco'),
        'menu_name'                  => __('Job Industry', 'donbosco'),
        'all_items'                  => __('All Job Industries', 'donbosco'),
        'parent_item'                => __('Parent Job Industry', 'donbosco'),
        'parent_item_colon'          => __('Parent Job Industry:', 'donbosco'),
        'new_item_name'              => __('New Job Industry Name', 'donbosco'),
        'add_new_item'               => __('Add New Job Industry', 'donbosco'),
        'edit_item'                  => __('Edit Job Industry', 'donbosco'),
        'update_item'                => __('Update Job Industry', 'donbosco'),
        'view_item'                  => __('View Job Industry', 'donbosco'),
        'separate_items_with_commas' => __('Separate Job Industries with commas', 'donbosco'),
        'add_or_remove_items'        => __('Add or remove Job Industries', 'donbosco'),
        'choose_from_most_used'      => __('Choose from the most used', 'donbosco'),
        'popular_items'              => __('Popular Job Industries', 'donbosco'),
        'search_items'               => __('Search Job Industries', 'donbosco'),
        'not_found'                  => __('Not Found', 'donbosco'),
        'no_terms'                   => __('No Job Industries', 'donbosco'),
        'items_list'                 => __('Job Industries list', 'donbosco'),
        'items_list_navigation'      => __('Job Industries list navigation', 'donbosco'),
    );
    $args = array(
        'labels'                     => $labels,
        'hierarchical'               => true,
        'public'                     => true,
        'show_ui'                    => true,
        'show_admin_column'          => true,
        'show_in_nav_menus'          => true,
        'show_tagcloud'              => true,
    );
    register_taxonomy('job_category', array('vacancies'), $args);
}

// Hook into the 'init' action
add_action('init', 'register_job_category_taxonomy', 0);
