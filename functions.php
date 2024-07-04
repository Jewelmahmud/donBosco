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





