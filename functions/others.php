<?php

// Exit if accessed directly ---------------------------------------------------
if( !defined( 'ABSPATH' ) ) {
    die;
}


// ACF Functionality -----------------------------------------------------------
// Include the ACF plugin.
include_once( ACF_PATH . 'acf.php' );

// Customize the url setting to fix incorrect asset URLs.
function acf_settings_url( $url ) {
    return ACF_URL;
}
add_filter('acf/settings/url', 'acf_settings_url');

//(Optional) Hide the ACF admin menu item---------------------------------------
// function acf_settings_show_admin( $show_admin ) {
//     return false;
// }
// add_filter('acf/settings/show_admin', 'acf_settings_show_admin');

// Yost Metabox Priority to low -----------------------------------------------
function move_yoast_below_acf() {
    return 'low';
}
add_filter( 'wpseo_metabox_prio', 'move_yoast_below_acf');


// Data Formation -----------------------------------------------------------
// remove_filter( 'the_content', 'wpautop' );
// remove_filter( 'the_excerpt', 'wpautop' );

// Excerpt More Modification -------------------------------------------------
function wpdocs_excerpt_more( $more ) {
    return '...';
}
add_filter( 'excerpt_more', 'wpdocs_excerpt_more' );


// Hide the version Number to be safe from hacking ----------------------------
function wpb_remove_version() {
    return '';
}
add_filter('the_generator', 'wpb_remove_version');


@ini_set( 'upload_max_size' , '64M' );
@ini_set( 'post_max_size', '64M');
@ini_set( 'max_execution_time', '500' );

// Function for increasing excerpt length --------------------------------------
 
function lawyer_excerpt_length($length) {
    global $post;
    if ($post->post_type == 'post')
        return 15;
    else if ($post->post_type == 'advocaat')
        return 20;
    else if ($post->post_type == 'vragen')
        return 20;
    else
        return 30;
}
add_filter('excerpt_length', 'lawyer_excerpt_length');

// Welcome Notice -------------------------------------------------------------

function GisolaWelcomeNotice() {
	global $pagenow;

	if ( is_admin() && isset( $_GET['activated'] ) && 'themes.php' === $pagenow ) {
		echo '<div class="updated notice notice-success is-dismissible"><p>'.sprintf( __( 'Thank you for installing donbosco by Huqson.nl.', 'donbosco' )  ).'</p></div>';
	}
}
add_action( 'admin_notices', 'GisolaWelcomeNotice' );


function custom_admin_favicon() {
    $favicon = get_field('favicon', 'option');

    // var_dump($favicon);

    if ($favicon) {
        echo '<link rel="shortcut icon" href="' . esc_url($favicon) . '" />';
    }
}
add_action('admin_head', 'custom_admin_favicon');



// Change POSTS to Nieuws in WP dashboard ------------------------------------------------------------
add_action( 'admin_menu', 'pilau_change_post_menu_label' );
add_action( 'init', 'pilau_change_post_object_label' );
function pilau_change_post_menu_label() {
    global $menu;
    global $submenu;
    $menu[5][0] = 'Nieuws';
    $submenu['edit.php'][5][0] = 'Nieuws';
    $submenu['edit.php'][10][0] = 'Nieuws toevoegen';
    $submenu['edit.php'][16][0] = 'Nieuws-tags';
    echo '';
}
function pilau_change_post_object_label() {
    global $wp_post_types;
    $labels = &$wp_post_types['post']->labels;
    $labels->name = 'Nieuws';
    $labels->singular_name = 'Nieuws';
    $labels->add_new = 'Nieuws toevoegen';
    $labels->add_new_item = 'Nieuws toevoegen';
    $labels->edit_item = 'Nieuws bewerken';
    $labels->new_item = 'Nieuws';
    $labels->view_item = 'Bekijk Nieuws';
    $labels->search_items = 'Zoeken in Nieuws';
    $labels->not_found = 'Geen Nieuws gevonden';
    $labels->not_found_in_trash = 'Geen Nieuws gevonden in prullenbak';
} 


// Various Filters -----------------------------------------------------------




add_filter('wpcf7_form_elements', function($content) {
    $content = preg_replace('/<(span).*?class="\s*(?:.*\s)?wpcf7-form-control-wrap(?:\s[^"]+)?\s*"[^\>]*>(.*)<\/\1>/i', '\2', $content);
    $content = str_replace('<br />', '', $content);
    return $content;
});
add_filter('wpcf7_autop_or_not', '__return_false');


// function enqueue_custom_favicon_admin() {
//     $favicon_url = get_field('favicon', 'option');    
//     if ($favicon_url) {
//         echo '<link rel="icon" href="' . esc_url($favicon_url) . '" type="image/x-icon" />';
//     }
// }

// add_action('admin_head', 'enqueue_custom_favicon_admin');


function custom_wp_mail_from($original_email_address) {
    $custom_email_address = 'info@donbosco.eu';
    return $custom_email_address;
}

function custom_wp_mail_from_name($original_email_from) {
    $custom_sender_name = 'donbosco';
    return $custom_sender_name;
}

add_filter('wp_mail_from', 'custom_wp_mail_from', 10); 
add_filter('wp_mail_from_name', 'custom_wp_mail_from_name', 10);


function custom_language_redirect() {
    if (is_singular('vacancies')) {
        $post_id = get_queried_object_id();
        $translated_post_id = apply_filters('wpml_object_id', $post_id, 'vacancies', true);

        if (!$translated_post_id) {
            $current_language = apply_filters('wpml_current_language', NULL);
            wp_redirect(home_url('/vacancies?lang=' . $current_language));
            exit();
        }
    }
}

add_action('template_redirect', 'custom_language_redirect');

function custom_ipinfo_language_redirect() {
    
    $ip_address = $_SERVER['REMOTE_ADDR'];

    $response = wp_remote_get("https://ipinfo.io/{$ip_address}/json");
    $body = wp_remote_retrieve_body($response);

    return $response;

    // $logFilePath = trailingslashit(get_template_directory()) . '/logs/ipinfo.log';
    // if (!file_exists($logFilePath)) {
    //     touch($logFilePath);
    //     chmod($logFilePath, 0644);
    // }
    // file_put_contents($logFilePath, date('Y-m-d H:i:s') . " - Event:\n".$ip_address. print_r($body, true) . "\n", FILE_APPEND);

    // if (!is_wp_error($response) && !empty($body)) {
    //     $location_data = json_decode($body);
    //     if ($location_data->country === 'NL') {
    //         wp_redirect(home_url('/?lang=nl'));
    //         exit();
    //     }
    // }
}

add_action('template_redirect', 'custom_ipinfo_language_redirect');




function extractDigits($inputString) {
    $cleanedString = preg_replace('/[^0-9]/', '', $inputString);
    return $cleanedString;
}

function limitWords($inputString, $limit = 10) {
    $words = explode(' ', $inputString);
    $limitedWords = array_slice($words, 0, $limit);
    $resultString = implode(' ', $limitedWords);
    return $resultString;
}

function dd($input, $die = true) {
    // If $input is an array, apply strip_tags recursively to all its elements
    if (is_array($input)) {
        array_walk_recursive($input, function (&$value) {
            $value = strip_tags($value);
        });
    } else {
        $input = strip_tags($input);
    }
    echo "<pre>";
    print_r($input);
    echo "</pre>";

    if ($die) die();
}


function sanitizeFields($input) {
    if (is_array($input)) {
        foreach ($input as &$value) {
            $value = sanitizeFields($value);
        }
        unset($value); // unset reference to last element
    } else {
        // If it's not an array, sanitize the value
        $input = sanitize_text_field($input);
    }

    return $input;
}


function b2_validateFile($file, $allowedExtensions = ['pdf','doc','jpg','jpeg','png','docx'], $maxFileSizeMB=5) {
    $fileExtension = strtolower(substr(strrchr($file['name'], '.'), 1));

    // Check file type
    if (!in_array(strtolower($fileExtension), $allowedExtensions)) {
        wp_send_json_error(array('message' => "This file is not allowed. Please try only allowed files."));
        wp_die();
    }

    // Check file size
    if ($file['size'] > $maxFileSizeMB * 1024 * 1024) {
        wp_send_json_error(array('message' => 'File size exceeds the limit. Maximum size: ' . $maxFileSizeMB . ' MB.'));
        wp_die();
    }
}

function languages() {
    return array(
        'Dutch' => 'nl',
        'English' => 'en',
        'German' => 'de',
        'French' => 'fr',
        'Spanish' => 'es',
        'Chinese' => 'zh',
        'Japanese' => 'ja',
        'Korean' => 'ko',
        'Turkish' => 'tr',
        'Russian' => 'ru',
        'Polish' => 'pl',
        'Italian' => 'it',
        'Swedish' => 'sv',
        'Norwegian' => 'no',
        'Danish' => 'da',
        'Greek' => 'el',
        'Romanian' => 'ro',
        'Indonesian' => 'id',
        'Slovak' => 'sk',
        'Czech' => 'cs',
        'Finnish' => 'fi',
        'Hungarian' => 'hu',
        'Albanian' => 'sq',
        'Portuguese' => 'pt',
        'Afrikaans' => 'af',
        'Hindi' => 'hi',
        'Arabic' => 'ar',
        'Ukrainian' => 'uk',
        'Vietnamese' => 'vi',
        'Persian' => 'fa',
        'Filipino (Tagalog)' => 'tl',
        'Urdu' => 'ur',
        'Thai' => 'th',
        'Lithuanian' => 'lt',
        'Croatian' => 'hr',
        'Tamil' => 'ta',
        'Malay' => 'ms',
        'Hebrew' => 'he',
        'Bengali' => 'bn',
        'Latvian' => 'lv',
        'Estonian' => 'et',
        'Serbian' => 'sr',
        'Icelandic' => 'is',
        'Nepali' => 'ne'
    );
    
}

function next_prev_link($html) {
    $dom = new DOMDocument;
    $dom->loadHTML($html);

    $anchors = $dom->getElementsByTagName('a');

    if ($anchors->length > 0) {
        $firstAnchor = $anchors->item(0);

        $href = $firstAnchor->getAttribute('href');
        echo $href;
    } else {
        return false;
    }
}

function dateToISO8601($inputDate) {
    $dateObj = DateTime::createFromFormat('d/m/y', $inputDate);
    
    if ($dateObj === false) {
        $dateObj = DateTime::createFromFormat('d-m-y', $inputDate);
    }

    if ($dateObj !== false) {
        return $dateObj->format('Y-m-d\TH:i:s\Z');
    } else {
        return false;
    }
}

// Hook the setDefaultLanguage function to the 'init' action
// add_action('init', 'setDefaultLanguage');

// Your setDefaultLanguage function
// Your setDefaultLanguage function
// function setDefaultLanguage() {
//     $visitor_country = strtolower(get_ip_geolocation()['country']);

//     if ($visitor_country === 'bd') {
//         do_action('wpml_switch_language', 'nl');
//     } 

// }

// $visitor_country = strtolower(get_ip_geolocation()['country']);

// if ($visitor_country === 'bd') {
//     add_action('pre_get_posts', 'switch_the_language');
// } 
// function switch_the_language($query) {
//     if ( !is_admin() && !$query->is_main_query() ) {
//         global $sitepress;
//         $sitepress->switch_lang('nl');
//     }
// }

// $visitor_country = strtolower(get_ip_geolocation()['country']);


// if (!isset($_COOKIE['initial_language_set'])) {

//     if ($visitor_country === 'bd') {
//         setcookie('initial_language_set', 'nl', time() + 60 * 60, '/');
//         add_action('pre_get_posts', 'switch_the_language');
//     }

// } 
// function switch_the_language($query) {
//     if ( !is_admin() && !$query->is_main_query() ) {
//         global $sitepress;
//         $sitepress->switch_lang('nl');
//     }
// }


// function switch_language_based_on_country() {
//     global $sitepress;
//     $user_country = get_ip_geolocation()['country'];

//     if (defined('ICL_LANGUAGE_CODE')) {
//         $languages = icl_get_languages('skip_missing=0');

//         if (isset($languages[$user_country])) {  
//             $sitepress->switch_lang($user_country);

//             $lang_url = site_url(ICL_LANGUAGE_CODE == $lang_code ? remove_query_arg('lang') : add_query_arg('lang', 'nl'));

//         } else {
//             $sitepress->switch_lang('en');
//         }
//     }
// }

// // Hook the language switching logic into WordPress
// add_action('wp', 'switch_language_based_on_country');


// function set_language_cookie_on_switch($new_lang, $old_lang) {
//     setcookie('site_language', $new_lang, time() + 3600 * 24 * 30, COOKIEPATH, COOKIE_DOMAIN);
// }

// // Hook the language switch event to the custom function
// add_action('wpml_language_switched', 'set_language_cookie_on_switch', 10, 2);



// Your get_ip_geolocation function
function get_ip_geolocation($ip = '') {
    if (empty($ip)) {
        $ip = $_SERVER['REMOTE_ADDR'];
    }

    $api_url = "http://ipinfo.io/{$ip}/json";

    $response = wp_remote_get($api_url);

    if (is_wp_error($response)) {
        return false;
    }

    $data = json_decode(wp_remote_retrieve_body($response), true);

    return $data;
}

function isEventAlive($eventEndDate, $eventEndTime) {
    $eventDateTime = strtotime($eventEndDate . ' ' . $eventEndTime);

    $currentDateTime = time();
    if ($eventDateTime > $currentDateTime) {
        return true;
    } else {
        return false;
    }
}



