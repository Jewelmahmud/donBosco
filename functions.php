<?php
/**
 * Theme Functions
 *
 * @package Gisola
 * @author Jewel Mahmud
 * @link Fhttp://huqson.nl
 */

// Exit if accessed directly ---------------------------------------------------
if( !defined( 'ABSPATH' ) ) {
    die;
}


// Variable Declaration --------------------------------------------------------

define( 'THEME_DIR', get_template_directory() );
define( 'THEME_URI', get_template_directory_uri() );
define( 'STYLESHEET_DIR', get_stylesheet_directory() );
define( 'STYLESHEET_URI', get_stylesheet_directory_uri() );
define( 'THEME_NAME', 'donbosco' );
define( 'THEME_VERSION', '1.0' );

define( 'LIBS_DIR', THEME_DIR. '/functions' );
define( 'LIBS_URI', THEME_URI. '/functions' );
define( 'INC_DIR', THEME_DIR. '/includes' );
define( 'LANG_DIR', THEME_DIR. '/languages' );
define( 'LIB_DIR', THEME_DIR. '/lib' );

define( 'ACF_PATH', STYLESHEET_DIR. '/lib/acf/' );
define( 'ACF_URL', STYLESHEET_URI. '/lib/acf/' );

// Autoload Webhook --------------------------------------------------------
require_once get_template_directory() . '/vendor/autoload.php';
// Others Fucntions -----------------------------------------------------------
require_once( LIBS_DIR .'/others.php' );
// Functions ------------------------------------------------------------------
require_once( LIBS_DIR .'/theme-setup.php' );
// Theme Styles ---------------------------------------------------------------
require_once( LIBS_DIR .'/theme-styles.php' );
// Theme Script ---------------------------------------------------------------
require_once( LIBS_DIR .'/theme-scripts.php' );
// Post Registration ----------------------------------------------------------
require_once( LIBS_DIR .'/post-registration.php' );
// Taxonomy Registration-------------------------------------------------------
require_once( LIBS_DIR .'/taxonomyregistration.php' );
// Widget Registration --------------------------------------------------------
require_once( LIBS_DIR .'/widget-registration.php' );
// Shortcode Registration -----------------------------------------------------
require_once( LIBS_DIR .'/shortcodes.php' );
// Plugin Recommendation ------------------------------------------------------
require_once( LIBS_DIR .'/plugin-recommendation.php' );
// Login Customization --------------------------------------------------------
require_once( LIBS_DIR .'/loginCustomization.php' );
// Nav Walker --------------------------------------------------------
require_once( THEME_DIR .'/classes/nav-walker.php' );
// require_once( THEME_DIR .'/classes/footer-nav-walker.php' );
require_once(get_template_directory() . '/classes/footer-nav-walker.php');
// Bootstrap Nav Walker --------------------------------------------------------
require_once(get_template_directory() . '/classes/Custom-nav-Walker.php');
// Bootstrap Nav Walker --------------------------------------------------------
require_once(get_template_directory() . '/classes/InstagramAPI.php');
// ForceFull API --------------------------------------------------------
require_once( LIBS_DIR .'/api/api.php' );
// ForceFull Webhook --------------------------------------------------------
require_once( LIBS_DIR .'/webhook.php' );
// Mollie Include --------------------------------------------------------
require_once( LIBS_DIR .'/mollie.php' );



/* ---------------------------------------------------------------------------
 * Library Intigration
 * All the External Libraries will be included here
 * --------------------------------------------------------------------------- */

// CMB2 Intigration ----------------------------------------------------------
// require_once( LIB_DIR .'/cmb2/init.php' );
// require_once( LIB_DIR .'/cmb2/cmbfunctions.php' );

// Redux Framework Intigration ------------------------------------------------
// require_once( LIB_DIR .'/redux-framework/ReduxCore/framework.php' );
// require_once( LIB_DIR .'/redux-framework/sample/config.php' );

// TGM Plugin Activation ------------------------------------------------------
// require_once( INC_DIR .'/tgm/config.php' );


// Visual Composer Elements ---------------------------------------------------
require_once( LIBS_DIR .'/VisualComposer/functions.php' );
require_once( LIBS_DIR .'/VisualComposer/base.php' );


// Ajax Load More -------------------------------------------------------------
require_once( LIBS_DIR .'/ajaxcall.php' );

// Page Functionality ---------------------------------------------------------
// require_once( LIBS_DIR .'/pagefunctions.php' );

// Theme Options --------------------------------------------------------------
require_once( LIBS_DIR .'/themeoptions.php' );

// Loadmore Options -----------------------------------------------------------
// require_once( LIBS_DIR .'/loadmore.php' );


function flush_rewrite_rules_temp() {
    flush_rewrite_rules();
}
add_action('init', 'flush_rewrite_rules_temp');



class Custom_Nav_Walker extends Walker_Nav_Menu {
  // Start Level
  function start_lvl( &$output, $depth = 0, $args = null ) {
      $indent = str_repeat("\t", $depth);
      $submenu = ($depth > 0) ? ' sub-menu' : ' dropdown-menu';
      $output .= "\n$indent<ul class=\"$submenu\">\n";
  }

  // Start Element
  function start_el( &$output, $item, $depth = 0, $args = null, $id = 0 ) {
      $indent = ($depth) ? str_repeat("\t", $depth) : '';
      $classes = empty($item->classes) ? array() : (array) $item->classes;
      $classes[] = 'nav-item';

      if (in_array('menu-item-has-children', $classes)) {
          $classes[] = 'dropdown';
      }

      $class_names = join(' ', apply_filters('nav_menu_css_class', array_filter($classes), $item, $args));
      $class_names = $class_names ? ' class="' . esc_attr($class_names) . '"' : '';

      $id = apply_filters('nav_menu_item_id', 'menu-item-'. $item->ID, $item, $args);
      $id = $id ? ' id="' . esc_attr($id) . '"' : '';

      $output .= $indent . '<li' . $id . $class_names .'>';

      $atts = array();
      $atts['title']  = ! empty( $item->attr_title ) ? $item->attr_title : '';
      $atts['target'] = ! empty( $item->target )     ? $item->target     : '';
      $atts['rel']    = ! empty( $item->xfn )        ? $item->xfn        : '';
      $atts['href']   = ! empty( $item->url )        ? $item->url        : '';

      if ($depth == 0 && in_array('menu-item-has-children', $classes)) {
          $atts['class'] = 'nav-link dropdown-toggle';
          $atts['role'] = 'button';
          $atts['data-bs-toggle'] = 'dropdown';
          $atts['aria-expanded'] = 'false';
      } else {
          $atts['class'] = 'nav-link';
      }

      $atts = apply_filters('nav_menu_link_attributes', $atts, $item, $args, $depth);

      $attributes = '';
      foreach ( $atts as $attr => $value ) {
          if ( ! empty( $value ) ) {
              $value = ( 'href' === $attr ) ? esc_url( $value ) : esc_attr( $value );
              $attributes .= ' ' . $attr . '="' . $value . '"';
          }
      }

      $title = apply_filters('the_title', $item->title, $item->ID);

      $item_output = $args->before;
      $item_output .= '<a'. $attributes .'>';
      $item_output .= $args->link_before . $title . $args->link_after;
      $item_output .= '</a>';
      $item_output .= $args->after;

      $output .= apply_filters('walker_nav_menu_start_el', $item_output, $item, $depth, $args);
  }
}


