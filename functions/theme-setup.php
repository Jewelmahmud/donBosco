<?php

// Exit if accessed directly -------------------------------------------------------------------
if( !defined( 'ABSPATH' ) ) {
    die;
}

function donboscoThemeSetup() {
	
	/* Make theme available for translation.*/
	load_theme_textdomain( 'donbosco', LANG_DIR );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );
        
    // This theme styles the visual editor with editor-style.css to match the theme style.
	add_editor_style();
        
	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
	 */
	add_theme_support( 'post-thumbnails' );	
	// set_post_thumbnail_size( 900, 400, true ); 
	// add_image_size( 'newsbig', 385, 300, true );
	add_image_size( 'newsthumb', 384, 252, true );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(		
		'topmenu' 	=> esc_html__( 'Top Menu', 'donbosco' ),	
		'mainmenu' 	=> esc_html__( 'Main Menu', 'donbosco' ),	
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	) );

	// Set up the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'donbosco_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );

	// Add theme support for selective refresh for widgets.
	add_theme_support( 'customize-selective-refresh-widgets' );

	// Add support for custom logo.
	add_theme_support( 'custom-logo' );

	// Post format.
	add_theme_support( 'post-formats', array('video', 'audio', 'quote', 'gallery'));
	
	// WordPress 5.0 and Gutenberg support
	// Add support for Block Styles.
	add_theme_support( 'wp-block-styles' );

	// Add support for full and wide align images.
	add_theme_support( 'align-wide' );
		
	// Add support for editor styles.
	add_theme_support( 'editor-styles' );	
	
}
add_action( 'after_setup_theme', 'donboscoThemeSetup' );

function donboscoFallbackMenu() {

}


function get_breadcrumb() {
    $breadcrumbs = array();

    // Home page
    $breadcrumbs[] = array(
        'text' => wp_kses_post('<img src="' . get_template_directory_uri() . '/assets/images/icon-home.svg" alt="home">'),
        'url'  => home_url('/'),
    );

    // Single page
    if (is_page()) {
        // Current page
        $breadcrumbs[] = array(
            'text' => get_the_title(),
            'url'  => false,
        );
    } elseif (isset($_GET['favorites'])) {
        // Check for 'favorites' parameter
        $breadcrumbs[] = array(
            'text' => __('Favorites Jobs', 'donbosco'),
            'url'  => false,
        );
    } elseif (isset($_GET['s']) || isset($_GET['search'])) {
        // Check for 's' parameter (search)
        $breadcrumbs[] = array(
            'text' => __('Search', 'donbosco'),
            'url'  => false,
        );
    } elseif (is_post_type_archive()) {
        // Post type archive
        $post_type = get_post_type_object(get_post_type());

        // Post type archive link
        if ($post_type && property_exists($post_type, 'labels') && is_object($post_type->labels)) {
            $breadcrumbs[] = array(
                'text' => isset($post_type->labels->name) ? $post_type->labels->name : '',
                'url'  => get_post_type_archive_link($post_type->name),
            );
        }
    } elseif (is_single()) {
        // Single post
        $post_type        = get_post_type();
        $post_type_object = get_post_type_object($post_type);

        // Post type archive link
        if ($post_type_object && property_exists($post_type_object, 'labels') && is_object($post_type_object->labels)) {
            if ($post_type !== 'post') {
                $breadcrumbs[] = array(
                    'text' => isset($post_type_object->labels->name) ? $post_type_object->labels->name : '',
                    'url'  => get_post_type_archive_link($post_type),
                );
            }
        }

        // Current post
        $breadcrumbs[] = array(
            'text' => get_the_title(),
            'url'  => false,
        );
    } elseif (is_tax()) {
        // Custom Taxonomy archive
        $current_term    = get_queried_object();
        $taxonomy        = get_taxonomy($current_term->taxonomy);
        $breadcrumbs[]   = array(
            'text' => $taxonomy->labels->singular_name,
            'url'  => get_term_link($current_term),
        );
    }

    // WPML Translation
    if (function_exists('icl_get_languages')) {
        $languages = icl_get_languages('skip_missing=0');
        if ($languages) {
            foreach ($languages as $lang) {
                if ($lang['active']) {
                    $breadcrumbs[count($breadcrumbs) - 1]['text'] = icl_translate('donbosco', 'Breadcrumb Text', $breadcrumbs[count($breadcrumbs) - 1]['text']);
                }
            }
        }
    }

    return $breadcrumbs;
}





/**
 * Sanitize and validate user input.
 *
 * @param string|array|int $input The user input to sanitize.
 * @param string $type The type of sanitization to apply ('text', 'url', 'email', 'int', 'float', 'html', 'textarea', 'encoded_html').
 * @return mixed Sanitized and validated user input.
 */
function sanitizeInput($input, $type = 'text') {
    switch ($type) {
        case 'text':
            $output = sanitize_text_field($input);
            break;
        case 'url':
            $output = esc_url_raw($input);
            break;
        case 'email':
            $output = sanitize_email($input);
            break;
        case 'int':
            $output = absint($input);
            break;
        case 'float':
            $output = floatval($input);
            break;
        case 'html':
            $output = wp_kses_post($input);
            break;
        case 'textarea':
            $output = esc_textarea($input);
            break;
        case 'encoded_html':
            $output = htmlspecialchars($input, ENT_QUOTES, 'UTF-8');
            break;
        default:
            $output = sanitize_text_field($input);
            break;
    }

    return $output;
}


function is_job_favorite($job_id) {
    $favorite_jobs_local = json_decode(get_transient('favorite_jobs_local_'.ICL_LANGUAGE_CODE), true);
    return is_array($favorite_jobs_local) && in_array($job_id, $favorite_jobs_local);
}
function get_favorite_count() {
    $favorite_jobs_local = json_decode(get_transient('favorite_jobs_local_'.ICL_LANGUAGE_CODE), true);
    if (is_array($favorite_jobs_local)) {
        return count($favorite_jobs_local);
    } else {
        return false;
    }
}






