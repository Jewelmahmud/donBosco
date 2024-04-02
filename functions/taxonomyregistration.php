<?php

// Register Custom FAQ Category
function FAQCategory() {

	$labels = array(
		'name'                       => _x( 'FAQ Category', 'FAQ Category', 'b2works' ),
		'singular_name'              => _x( 'FAQ Category', 'FAQ Category', 'b2works' ),
		'menu_name'                  => __( 'FAQ Category', 'b2works' ),
		'all_items'                  => __( 'All Items', 'b2works' ),
		'parent_item'                => __( 'Parent Item', 'b2works' ),
		'parent_item_colon'          => __( 'Parent Item:', 'b2works' ),
		'new_item_name'              => __( 'New Item Name', 'b2works' ),
		'add_new_item'               => __( 'Add New Item', 'b2works' ),
		'edit_item'                  => __( 'Edit Item', 'b2works' ),
		'update_item'                => __( 'Update Item', 'b2works' ),
		'view_item'                  => __( 'View Item', 'b2works' ),
		'separate_items_with_commas' => __( 'Separate items with commas', 'b2works' ),
		'add_or_remove_items'        => __( 'Add or remove items', 'b2works' ),
		'choose_from_most_used'      => __( 'Choose from the most used', 'b2works' ),
		'popular_items'              => __( 'Popular Items', 'b2works' ),
		'search_items'               => __( 'Search Items', 'b2works' ),
		'not_found'                  => __( 'Not Found', 'b2works' ),
		'no_terms'                   => __( 'No items', 'b2works' ),
		'items_list'                 => __( 'Items list', 'b2works' ),
		'items_list_navigation'      => __( 'Items list navigation', 'b2works' ),
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
        'name'                       => _x('Job Industries', 'Taxonomy General Name', 'b2works'),
        'singular_name'              => _x('Job Industry', 'Taxonomy Singular Name', 'b2works'),
        'menu_name'                  => __('Job Industry', 'b2works'),
        'all_items'                  => __('All Job Industries', 'b2works'),
        'parent_item'                => __('Parent Job Industry', 'b2works'),
        'parent_item_colon'          => __('Parent Job Industry:', 'b2works'),
        'new_item_name'              => __('New Job Industry Name', 'b2works'),
        'add_new_item'               => __('Add New Job Industry', 'b2works'),
        'edit_item'                  => __('Edit Job Industry', 'b2works'),
        'update_item'                => __('Update Job Industry', 'b2works'),
        'view_item'                  => __('View Job Industry', 'b2works'),
        'separate_items_with_commas' => __('Separate Job Industries with commas', 'b2works'),
        'add_or_remove_items'        => __('Add or remove Job Industries', 'b2works'),
        'choose_from_most_used'      => __('Choose from the most used', 'b2works'),
        'popular_items'              => __('Popular Job Industries', 'b2works'),
        'search_items'               => __('Search Job Industries', 'b2works'),
        'not_found'                  => __('Not Found', 'b2works'),
        'no_terms'                   => __('No Job Industries', 'b2works'),
        'items_list'                 => __('Job Industries list', 'b2works'),
        'items_list_navigation'      => __('Job Industries list navigation', 'b2works'),
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
