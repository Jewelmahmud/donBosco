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

// Register Custom Taxonomy
function register_download_taxonomy() {

    $labels = array(
        'name'                       => _x( 'Download Categories', 'Downloads', 'donbosco' ),
        'singular_name'              => _x( 'Download Category', 'Downloads', 'donbosco' ),
        'menu_name'                  => __( 'Download Categories', 'donbosco' ),
        'all_items'                  => __( 'All Categories', 'donbosco' ),
        'parent_item'                => __( 'Parent Category', 'donbosco' ),
        'parent_item_colon'          => __( 'Parent Category:', 'donbosco' ),
        'new_item_name'              => __( 'New Category Name', 'donbosco' ),
        'add_new_item'               => __( 'Add New Category', 'donbosco' ),
        'edit_item'                  => __( 'Edit Category', 'donbosco' ),
        'update_item'                => __( 'Update Category', 'donbosco' ),
        'view_item'                  => __( 'View Category', 'donbosco' ),
        'separate_items_with_commas' => __( 'Separate categories with commas', 'donbosco' ),
        'add_or_remove_items'        => __( 'Add or remove categories', 'donbosco' ),
        'choose_from_most_used'      => __( 'Choose from the most used', 'donbosco' ),
        'popular_items'              => __( 'Popular Categories', 'donbosco' ),
        'search_items'               => __( 'Search Categories', 'donbosco' ),
        'not_found'                  => __( 'Not Found', 'donbosco' ),
        'no_terms'                   => __( 'No categories', 'donbosco' ),
        'items_list'                 => __( 'Categories list', 'donbosco' ),
        'items_list_navigation'      => __( 'Categories list navigation', 'donbosco' ),
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
    register_taxonomy( 'download_category', array( 'download_items' ), $args );

}
add_action( 'init', 'register_download_taxonomy', 0 );


function create_vacatures_taxonomy() {
    $labels = array(
        'name'                       => _x( 'Vacaturecategorieën', 'Taxonomy General Name', 'donbosco' ),
        'singular_name'              => _x( 'Vacaturecategorie', 'Taxonomy Singular Name', 'donbosco' ),
        'menu_name'                  => __( 'Categorieën', 'donbosco' ),
        'all_items'                  => __( 'Alle Categorieën', 'donbosco' ),
        'parent_item'                => __( 'Parent Item', 'donbosco' ),
        'parent_item_colon'          => __( 'Parent Item:', 'donbosco' ),
        'new_item_name'              => __( 'Nieuwe Categorie', 'donbosco' ),
        'add_new_item'               => __( 'Voeg nieuwe categorie toe', 'donbosco' ),
        'edit_item'                  => __( 'Bewerk categorie', 'donbosco' ),
        'update_item'                => __( 'Update categorie', 'donbosco' ),
        'view_item'                  => __( 'Bekijk categorie', 'donbosco' ),
        'separate_items_with_commas' => __( 'Scheid categorieën met komma\'s', 'donbosco' ),
        'add_or_remove_items'        => __( 'Voeg categorieën toe of verwijder ze', 'donbosco' ),
        'choose_from_most_used'      => __( 'Kies uit meest gebruikte categorieën', 'donbosco' ),
        'popular_items'              => __( 'Populaire categorieën', 'donbosco' ),
        'search_items'               => __( 'Zoek categorieën', 'donbosco' ),
        'not_found'                  => __( 'Niet gevonden', 'donbosco' ),
        'no_terms'                   => __( 'Geen categorieën', 'donbosco' ),
        'items_list'                 => __( 'Categorieën lijst', 'donbosco' ),
        'items_list_navigation'      => __( 'Categorieën lijst navigatie', 'donbosco' ),
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
    register_taxonomy( 'vacaturecategorie', array( 'vacatures' ), $args );
}
add_action( 'init', 'create_vacatures_taxonomy', 0 );

