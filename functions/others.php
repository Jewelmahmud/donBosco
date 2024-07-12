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

function wpautop_for_post_content( $content ) {
    return wpautop( $content );
}
add_filter( 'the_content', 'wpautop_for_post_content' );

// function restrict_search_to_posts($query) {
//     if ($query->is_search && !is_admin()) {
//         $query->set('post_type', 'post');
//     }
//     return $query;
// }
// add_filter('pre_get_posts', 'restrict_search_to_posts');

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

// Enable auto <p> tags in Classic Editor
// remove_filter('the_content', 'wpautop');
// add_filter('the_content', 'wpautop', 99);
// add_filter('the_content', 'shortcode_unautop', 100);

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

function exclude_post_types_from_search($query) {
    // Check if it's the main query and if it's a search query
    if ( $query->is_main_query() && $query->is_search() ) {
        // Array of post types to exclude from search
        $excluded_post_types = array( 'post_type1', 'post_type2' );

        // Get the existing post types from the query
        $post_types = $query->get( 'post_type' );

        // Make sure it's an array
        if ( ! is_array( $post_types ) ) {
            $post_types = array( $post_types );
        }

        // Exclude specified post types
        $query->set( 'post_type', array_diff( $post_types, $excluded_post_types ) );
    }
}
add_action('pre_get_posts', 'exclude_post_types_from_search');



function extractDigits($inputString) {
    $cleanedString = preg_replace('/[^0-9]/', '', $inputString);
    return $cleanedString;
}

function limitWords($inputString, $limit = 10, $dots = false) {
    $words = explode(' ', $inputString);
    $limitedWords = array_slice($words, 0, $limit);
    $resultString = implode(' ', $limitedWords);
    if($dots) return $resultString. "...";
    else return $resultString;
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
        unset($value);
    } else {
        if (!is_email($input)) {
            $input = trim($input);
        }
        $input = stripslashes($input);
        $input = wp_strip_all_tags($input);
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
    
    $dateParts = explode('/', $eventEndDate);
    if (count($dateParts) != 3) {
        return false;
    }
    $formattedDate = $dateParts[2] . '-' . $dateParts[1] . '-' . $dateParts[0];

    $eventDateTime = strtotime($formattedDate . ' ' . $eventEndTime);

    $currentDateTime = time();
    if ($eventDateTime > $currentDateTime) {
        return true;
    } else {
        return false;
    }
}


function alter_get_the_content($content) {

    $content = str_replace('&nbsp;', '<br><br>', $content);
    $doc = new DOMDocument();
    @$doc->loadHTML(mb_convert_encoding($content, 'HTML-ENTITIES', 'UTF-8'));

    $img_tags = $doc->getElementsByTagName('img');
    foreach ($img_tags as $img) {
        $figure = $doc->createElement('figure');
        $img->parentNode->insertBefore($figure, $img);
        $figure->appendChild($img);
        $img->setAttribute('class', 'img-fluid');
        
        $figcaption = $doc->createElement('figcaption', $img->getAttribute('alt'));
        $figure->appendChild($figcaption);
    }

    $ul_tags = $doc->getElementsByTagName('ul');
    foreach ($ul_tags as $ul) {
        $ul->setAttribute('class', 'dot-list-style');
    }

    $ol_tags = $doc->getElementsByTagName('ol');
    foreach ($ol_tags as $ol) {
        $ol->setAttribute('class', 'dot-list-style mb-3 mt-3');
    }

    $altered_content = $doc->saveHTML();
    return $altered_content;
}



function social_medias(){
    return $social_media_icons = array(
        'whatsapp' => '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-whatsapp" viewBox="0 0 16 16"><path d="M13.601 2.326A7.85 7.85 0 0 0 7.994 0C3.627 0 .068 3.558.064 7.926c0 1.399.366 2.76 1.057 3.965L0 16l4.204-1.102a7.9 7.9 0 0 0 3.79.965h.004c4.368 0 7.926-3.558 7.93-7.93A7.9 7.9 0 0 0 13.6 2.326zM7.994 14.521a6.6 6.6 0 0 1-3.356-.92l-.24-.144-2.494.654.666-2.433-.156-.251a6.56 6.56 0 0 1-1.007-3.505c0-3.626 2.957-6.584 6.591-6.584a6.56 6.56 0 0 1 4.66 1.931 6.56 6.56 0 0 1 1.928 4.66c-.004 3.639-2.961 6.592-6.592 6.592m3.615-4.934c-.197-.099-1.17-.578-1.353-.646-.182-.065-.315-.099-.445.099-.133.197-.513.646-.627.775-.114.133-.232.148-.43.05-.197-.1-.836-.308-1.592-.985-.59-.525-.985-1.175-1.103-1.372-.114-.198-.011-.304.088-.403.087-.088.197-.232.296-.346.1-.114.133-.198.198-.33.065-.134.034-.248-.015-.347-.05-.099-.445-1.076-.612-1.47-.16-.389-.323-.335-.445-.34-.114-.007-.247-.007-.38-.007a.73.73 0 0 0-.529.247c-.182.198-.691.677-.691 1.654s.71 1.916.81 2.049c.098.133 1.394 2.132 3.383 2.992.47.205.84.326 1.129.418.475.152.904.129 1.246.08.38-.058 1.171-.48 1.338-.943.164-.464.164-.86.114-.943-.049-.084-.182-.133-.38-.232"></path></svg>',
        'twitter' => '<svg width="36" height="36" viewBox="0 0 36 36" fill="none" xmlns="http://www.w3.org/2000/svg">
        <rect width="36" height="36" rx="18" fill="#F2F4F7"/>
        <path d="M25.2285 11.9296C24.4785 12.2971 23.7435 12.4464 22.9785 12.6721C22.1378 11.7234 20.8913 11.6709 19.6935 12.1194C18.4958 12.5679 17.7113 13.6644 17.7285 14.9221V15.6721C15.2948 15.7344 13.1273 14.6259 11.7285 12.6721C11.7285 12.6721 8.59202 18.2469 14.7285 20.9221C13.3245 21.8574 11.9243 22.4881 10.2285 22.4221C12.7095 23.7744 15.4133 24.2394 17.754 23.5599C20.439 22.7799 22.6455 20.7676 23.4923 17.7534C23.7449 16.8366 23.8703 15.8895 23.865 14.9386C23.8635 14.7519 24.9975 12.8596 25.2285 11.9289V11.9296Z" stroke="#282828" stroke-width="1.125" stroke-linecap="round" stroke-linejoin="round"/>
        </svg>',
        'linkedin' => '<svg width="36" height="36" viewBox="0 0 36 36" fill="none" xmlns="http://www.w3.org/2000/svg">
        <rect width="36" height="36" rx="18" fill="#F2F4F7"/>
        <path fill-rule="evenodd" clip-rule="evenodd" d="M14.625 11.25H21.378C23.2402 11.25 24.75 12.7597 24.75 14.622V21.3788C24.75 23.2403 23.2402 24.75 21.378 24.75H14.622C12.7597 24.75 11.25 23.2402 11.25 21.378V14.625C11.25 12.7613 12.7613 11.25 14.625 11.25V11.25Z" stroke="#282828" stroke-width="1.125" stroke-linecap="round" stroke-linejoin="round"/>
        <path d="M15.09 17.325V21.375" stroke="#282828" stroke-width="1.125" stroke-linecap="round" stroke-linejoin="round"/>
        <path d="M17.7892 21.3752V19.0127C17.7892 18.0804 18.5445 17.3252 19.4767 17.3252V17.3252C20.409 17.3252 21.1642 18.0804 21.1642 19.0127V21.3752" stroke="#282828" stroke-width="1.125" stroke-linecap="round" stroke-linejoin="round"/>
        <path d="M15.0885 14.8786C14.9955 14.8786 14.9198 14.9544 14.9205 15.0474C14.9205 15.1404 14.9963 15.2161 15.0893 15.2161C15.1823 15.2161 15.258 15.1404 15.258 15.0474C15.258 14.9536 15.1823 14.8786 15.0885 14.8786" stroke="#282828" stroke-width="1.125" stroke-linecap="round" stroke-linejoin="round"/>
        </svg>',
        'instagram' => '<svg width="36" height="36" viewBox="0 0 36 36" fill="none" xmlns="http://www.w3.org/2000/svg">
        <rect width="36" height="36" rx="18" fill="#F2F4F7"/>
        <path fill-rule="evenodd" clip-rule="evenodd" d="M15.2422 12.5237C13.896 12.5237 12.8047 13.615 12.8047 14.9612V20.9612C12.8047 22.3074 13.896 23.3987 15.2422 23.3987H21.2422C22.5884 23.3987 23.6797 22.3074 23.6797 20.9612V14.9612C23.6797 13.615 22.5884 12.5237 21.2422 12.5237H15.2422ZM11.6797 14.9612C11.6797 12.9937 13.2747 11.3987 15.2422 11.3987H21.2422C23.2097 11.3987 24.8047 12.9937 24.8047 14.9612V20.9612C24.8047 22.9287 23.2097 24.5237 21.2422 24.5237H15.2422C13.2747 24.5237 11.6797 22.9287 11.6797 20.9612V14.9612ZM18.2422 16.2737C17.3102 16.2737 16.5547 17.0292 16.5547 17.9612C16.5547 18.8932 17.3102 19.6487 18.2422 19.6487C19.1742 19.6487 19.9297 18.8932 19.9297 17.9612C19.9297 17.0292 19.1742 16.2737 18.2422 16.2737ZM15.4297 17.9612C15.4297 16.4079 16.6889 15.1487 18.2422 15.1487C19.7955 15.1487 21.0547 16.4079 21.0547 17.9612C21.0547 19.5145 19.7955 20.7737 18.2422 20.7737C16.6889 20.7737 15.4297 19.5145 15.4297 17.9612ZM22.1797 14.5862C22.1797 14.2755 21.9278 14.0237 21.6172 14.0237C21.3065 14.0237 21.0547 14.2755 21.0547 14.5862V14.5872C21.0547 14.8978 21.3065 15.1497 21.6172 15.1497C21.9278 15.1497 22.1797 14.8978 22.1797 14.5872V14.5862Z" fill="#282828"/>
        </svg>',
        'facebook' => '<svg width="36" height="36" viewBox="0 0 36 36" fill="none" xmlns="http://www.w3.org/2000/svg">
        <rect width="36" height="36" rx="18" fill="#F2F4F7"/>
        <path d="M13.9375 16.4609V19.4609H16.1875V24.7109H19.1875V19.4609H21.4375L22.1875 16.4609H19.1875V14.9609C19.1875 14.762 19.2665 14.5713 19.4072 14.4306C19.5478 14.29 19.7386 14.2109 19.9375 14.2109H22.1875V11.2109H19.9375C18.9429 11.2109 17.9891 11.606 17.2858 12.3093C16.5826 13.0125 16.1875 13.9664 16.1875 14.9609V16.4609H13.9375Z" stroke="#282828" stroke-width="1.125" stroke-linecap="round" stroke-linejoin="round"/>
        </svg>',
        'youtube' => '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-youtube" viewBox="0 0 16 16"><path d="M13.25 3.349a2.03 2.03 0 0 0-1.436-1.436C11.286 1 8 1 8 1s-3.286 0-3.814.913c-.29.39-.425 1.018-.424 1.437v.274c-.001.42.134 1.047.425 1.437C4.714 5 8 5 8 5s3.286 0 3.814-.913c.29-.39.425-1.017.436-1.437v-.274c-.011-.42-.146-1.047-.436-1.437zM6.5 6.773v2.454L9.25 8l-2.75-1.227z"/><path fill-rule="evenodd" d="M6.719 10.227V5.773L10 8l-3.281 2.227z"/></svg>'
    );
}


function extract_url_body($input) {
    if (is_numeric($input)) {
        return "whatsapp";
    }

    $pattern = '/^(?:https?:\/\/)?(?:www\.)?(?:[a-z]{2}\.)?([^\/]+)/i';

    preg_match($pattern, $input, $matches);

    if (isset($matches[1])) {
        $parts = explode('.', $matches[1]);
        if (count($parts) > 2) {
            array_shift($parts);
        }

        array_pop($parts);
        return implode('.', $parts);
    } else {
        return '';
    }
}

function identifyContact($input) {
    if (filter_var($input, FILTER_VALIDATE_EMAIL)) {
        return 'email';
    }
    
    if (preg_match('/^\+?[\d\s()-]+$/', $input)) {
        return 'phone';
    }
    
    return null;
}