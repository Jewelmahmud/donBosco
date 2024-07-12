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

function add_custom_script_to_footer_if_contact_template() {
    if (is_page_template('templates/events.php')) { ?>
        <script>
            jQuery(document).ready(function($) {
                var lastScrollTop = 0;
                $(window).scroll(function() {
                    var scrollTop = $(this).scrollTop();
                    if (scrollTop > lastScrollTop) {
                        loadmoreEvents();
                    }
                    lastScrollTop = scrollTop;
                });
            });
        </script> <?php
    }

    if (is_page_template('templates/nieuws.php')) {  ?>
        <script>
            jQuery(document).ready(function($) {
                var lastScrollTop = 0;
                $(window).scroll(function() {
                    var scrollTop = $(this).scrollTop();
                    if (scrollTop > lastScrollTop) {
                        load_news('', true);
                    }
                    lastScrollTop = scrollTop;
                });
            });
        </script> <?php
    }

    if (is_page_template('templates/downloads.php')) {  ?>
        <script>
            jQuery(document).ready(function($) {
                var lastScrollTop = 0;
                $(window).scroll(function() {
                    var scrollTop = $(this).scrollTop();
                    if (scrollTop > lastScrollTop) {
                        load_downloads('', true);
                    }
                    lastScrollTop = scrollTop;
                });
            });
        </script> <?php
    }
}
add_action('wp_footer', 'add_custom_script_to_footer_if_contact_template');