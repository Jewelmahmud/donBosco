<?php

// Exit if accessed directly
if( !defined( 'ABSPATH' ) ) {
    die;
}

/* ---------------------------------------------------------------------------
 * Theme Script
 * This file will register all the styles of the theme to WordPress
 * --------------------------------------------------------------------------- */

 function load_common_scripts() {
    wp_localize_script('main-js', 'ajax_object', array('ajax_url' => admin_url('admin-ajax.php')));
    if (is_page_template('templates/news.php') || is_page_template('templates/downloads.php') || is_page_template('templates/faq.php') || is_page_template('templates/events.php') || is_page_template('templates/vacanies.php')) {
        wp_enqueue_script('my-loadmore', get_stylesheet_directory_uri() . '/assets/js/loadmore.js', array('jquery'), null, true);
    }
}
add_action('wp_enqueue_scripts', 'load_common_scripts');

function enqueue_admin_scripts() {
    wp_enqueue_script('admin-script', get_template_directory_uri() . '/assets/js/admin.js', array('jquery'), '', true);
}

add_action('admin_enqueue_scripts', 'enqueue_admin_scripts', PHP_INT_MAX);

function enqueue_admin_styles() {
    // Enqueue the custom CSS file for the admin area
    wp_enqueue_style('admin-css', get_template_directory_uri() . '/assets/css/admin.css');
}

add_action('admin_enqueue_scripts', 'enqueue_admin_styles');