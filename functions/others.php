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
    $eventDateTime = strtotime($eventEndDate . ' ' . $eventEndTime);

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
        'twitter' => '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-twitter-x" viewBox="0 0 16 16"><path d="M12.6.75h2.454l-5.36 6.142L16 15.25h-4.937l-3.867-5.07-4.425 5.07H.316l5.733-6.57L0 .75h5.063l3.495 4.633L12.601.75Zm-.86 13.028h1.36L4.323 2.145H2.865z"></path></svg>',
        'linkedin' => '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-linkedin" viewBox="0 0 16 16"><path d="M0 1.146C0 .513.526 0 1.175 0h13.65C15.474 0 16 .513 16 1.146v13.708c0 .633-.526 1.146-1.175 1.146H1.175C.526 16 0 15.487 0 14.854zm4.943 12.248V6.169H2.542v7.225zm-1.2-8.212c.837 0 1.358-.554 1.358-1.248-.015-.709-.52-1.248-1.342-1.248S2.4 3.226 2.4 3.934c0 .694.521 1.248 1.327 1.248zm4.908 8.212V9.359c0-.216.016-.432.08-.586.173-.431.568-.878 1.232-.878.869 0 1.216.662 1.216 1.634v3.865h2.401V9.25c0-2.22-1.184-3.252-2.764-3.252-1.274 0-1.845.7-2.165 1.193v.025h-.016l.016-.025V6.169h-2.4c.03.678 0 7.225 0 7.225z"></path></svg>',
        'instagram' => '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-instagram" viewBox="0 0 16 16"><path d="M8 0C5.829 0 5.556.01 4.703.048 3.85.088 3.269.222 2.76.42a3.9 3.9 0 0 0-1.417.923A3.9 3.9 0 0 0 .42 2.76C.222 3.268.087 3.85.048 4.7.01 5.555 0 5.827 0 8.001c0 2.172.01 2.444.048 3.297.04.852.174 1.433.372 1.942.205.526.478.972.923 1.417.444.445.89.719 1.416.923.51.198 1.09.333 1.942.372C5.555 15.99 5.827 16 8 16s2.444-.01 3.298-.048c.851-.04 1.434-.174 1.943-.372a3.9 3.9 0 0 0 1.416-.923c.445-.445.718-.891.923-1.417.197-.509.332-1.09.372-1.942C15.99 10.445 16 10.173 16 8s-.01-2.445-.048-3.299c-.04-.851-.175-1.433-.372-1.941a3.9 3.9 0 0 0-.923-1.417A3.9 3.9 0 0 0 13.24.42c-.51-.198-1.092-.333-1.943-.372C10.443.01 10.172 0 7.998 0zm-.717 1.442h.718c2.136 0 2.389.007 3.232.046.78.035 1.204.166 1.486.275.373.145.64.319.92.599s.453.546.598.92c.11.281.24.705.275 1.485.039.843.047 1.096.047 3.231s-.008 2.389-.047 3.232c-.035.78-.166 1.203-.275 1.485a2.5 2.5 0 0 1-.599.919c-.28.28-.546.453-.92.598-.28.11-.704.24-1.485.276-.843.038-1.096.047-3.232.047s-2.39-.009-3.233-.047c-.78-.036-1.203-.166-1.485-.276a2.5 2.5 0 0 1-.92-.598 2.5 2.5 0 0 1-.6-.92c-.109-.281-.24-.705-.275-1.485-.038-.843-.046-1.096-.046-3.233s.008-2.388.046-3.231c.036-.78.166-1.204.276-1.486.145-.373.319-.64.599-.92s.546-.453.92-.598c.282-.11.705-.24 1.485-.276.738-.034 1.024-.044 2.515-.045zm4.988 1.328a.96.96 0 1 0 0 1.92.96.96 0 0 0 0-1.92m-4.27 1.122a4.109 4.109 0 1 0 0 8.217 4.109 4.109 0 0 0 0-8.217m0 1.441a2.667 2.667 0 1 1 0 5.334 2.667 2.667 0 0 1 0-5.334"></path></svg>',
        'facebook' => '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-facebook" viewBox="0 0 16 16"><path d="M16 8.049c0-4.446-3.582-8.05-8-8.05C3.58 0-.002 3.603-.002 8.05c0 4.017 2.926 7.347 6.75 7.951v-5.625h-2.03V8.05H6.75V6.275c0-2.017 1.195-3.131 3.022-3.131.876 0 1.791.157 1.791.157v1.98h-1.009c-.993 0-1.303.621-1.303 1.258v1.51h2.218l-.354 2.326H9.25V16c3.824-.604 6.75-3.934 6.75-7.951"></path></svg>',
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