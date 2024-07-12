<?php

// Exit if accessed directly
if( !defined( 'ABSPATH' ) ) {
    die;
}

/* ---------------------------------------------------------------------------
 * Theme Style
 * This file will register all the styles of the theme to WordPress
 * --------------------------------------------------------------------------- */

// Function to load common styles and scripts
// function load_common_styles_and_scripts() {
//     // Load Bootstrap CSS
//     wp_enqueue_style('bootstrap-css', 'https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css');

//     // Load Rive JS
//     wp_enqueue_script('rive-js', 'https://unpkg.com/@rive-app/canvas@2.7.0', array(), null, false);

//     // Load Google Fonts
//     wp_enqueue_style('google-fonts', 'https://fonts.googleapis.com/css2?family=Inter&family=Sora:wght@400;600&display=swap');

//     // Load Swiper CSS
//     wp_enqueue_style('swiper-css', 'https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css');

//     // Load Magnific Popup CSS
//     wp_enqueue_style('magnific-popup-css', 'https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/magnific-popup.min.css');

//     // Load AOS CSS
//     wp_enqueue_style('aos-css', 'https://unpkg.com/aos@next/dist/aos.css');

//     // Load Custom CSS
//     wp_enqueue_style('custom-css', get_template_directory_uri() . '/assets/css/style.css');
// }

// // Function to load common scripts
// function load_common_scripts() {
//     // Load jQuery
//     wp_enqueue_script('jquery', 'https://code.jquery.com/jquery-3.6.4.min.js', array(), null, true);

//     // Load Bootstrap JS
//     wp_enqueue_script('bootstrap-js', 'https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js', array('jquery'), null, true);

//     // Load Swiper JS
//     wp_enqueue_script('swiper-js', 'https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js', array(), null, true);

//     // Load Magnific Popup JS
//     wp_enqueue_script('magnific-popup-js', 'https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/jquery.magnific-popup.min.js', array('jquery'), null, true);

//     // Load AOS JS
//     wp_enqueue_script('aos-js', 'https://unpkg.com/aos@next/dist/aos.js', array(), null, true);

//     // Load Isotope JS
//     wp_enqueue_script('isotope-js', 'https://unpkg.com/isotope-layout@3/dist/isotope.pkgd.min.js', array(), null, true);

//     // Load Main JS
//     wp_enqueue_script('main-js', get_template_directory_uri() . '/assets/js/main.js', array(), null, true);
// }

// // Function to load footer scripts
// function load_footer_scripts() {

// }

// // Hook to load common styles and scripts
// add_action('wp_enqueue_scripts', 'load_common_styles_and_scripts');

// // Hook to load common scripts in the footer
// add_action('get_footer', 'load_common_scripts');

// // Function to load Mapbox scripts for the contact template
// function load_mapbox_scripts() {
//     // Check if it's the contact template
//     if (is_page_template('templates/contact.php')) {
//         // Load Mapbox CSS
//         wp_enqueue_style('mapbox-css', 'https://api.mapbox.com/mapbox-gl-js/v3.0.0/mapbox-gl.css');

//         // Load Mapbox JS
//         wp_enqueue_script('mapbox-js', 'https://api.mapbox.com/mapbox-gl-js/v3.0.0/mapbox-gl.js', array(), null, true);
//     }
// }

// // Hook to load Mapbox scripts for the contact template
// add_action('wp_enqueue_scripts', 'load_mapbox_scripts');

