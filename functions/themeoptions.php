<?php
if( function_exists('acf_add_options_page') ) {
	
	acf_add_options_page(array(
		'page_title' 	=> 'Theme Options',
		'menu_title'	=> 'Theme Options',
		'menu_slug' 	=> 'theme-options',
		'capability'	=> 'edit_posts',
		'redirect'		=> false
	));
	
	// acf_add_options_sub_page(array(
	// 	'page_title' 	=> 'Header Options',
	// 	'menu_title'	=> 'Header',
	// 	'parent_slug'	=> 'theme-options',
	// ));
	
	// acf_add_options_sub_page(array(
	// 	'page_title' 	=> 'Footer Options',
	// 	'menu_title'	=> 'Footer',
	// 	'parent_slug'	=> 'theme-options',
	// ));
	
}
