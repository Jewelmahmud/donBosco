<?php
// Your Instagram API credentials
$client_id = '978844370289805';
$client_secret = 'f236bdfb1a6abdc93c635a84833e4219';
$redirect_uri = 'http://donbosco.fkpreview.nl';
$access_token = 'IGQWRPU0h2VDNVZAWJEVmMzMzRBTlc0R1YyMVpMZAnMzRjJKZAG1zdWJfNTNoMktDbFlPYkl3bjVTU0hZAdERPczRpM3h5OHI3SnZAKMjRRRzlhbDdFclhkeklVN2ZAPX1BtcmRIWEVjeVhSdEtJbkNoeG5WTnVtM1BGUncZD'; // This token will be obtained after authentication



/**
 * Initiates the authentication process with Instagram.
 *
 * @param string $client_id The client ID of your Instagram app.
 * @param string $redirect_uri The redirect URI registered with your Instagram app.
 * @param string $scope The scope of permissions your app requires.
 */
function initiate_instagram_authentication($client_id, $redirect_uri, $scope = 'user_profile,user_media') {
    // Authentication URL
    $auth_url = "https://api.instagram.com/oauth/authorize/?client_id=$client_id&redirect_uri=$redirect_uri&scope=$scope&response_type=code";

    // Redirect user to Instagram's authorization URL
    wp_redirect($auth_url);
    exit;
}


/**
 * Refreshes the long-lived access token provided by Instagram API.
 *
 * @param string $access_token The long-lived access token to be refreshed.
 * @param string $client_id The client ID of your Instagram app.
 * @param string $client_secret The client secret of your Instagram app.
 * @return array|WP_Error The response data containing the refreshed access token or WP_Error on failure.
 */
function refresh_instagram_access_token($access_token, $client_id, $client_secret) {
    $url = 'https://graph.instagram.com/refresh_access_token';

    $args = array(
        'body' => array(
            'grant_type' => 'ig_refresh_token',
            'access_token' => $access_token,
            'client_id' => $client_id,
            'client_secret' => $client_secret,
        ),
    );

    $response = wp_remote_post($url, $args);

    if (!is_wp_error($response)) {
        $body = wp_remote_retrieve_body($response);
        return json_decode($body, true);
    } else {
        return $response;
    }
}

// Fetch user's Instagram feed
function get_instagram_feed($access_token) {
    $url = "https://graph.instagram.com/me/media?fields=id,media_type,media_url,thumbnail_url,permalink&access_token=$access_token";
    $response = wp_remote_get($url);
    $body = wp_remote_retrieve_body($response);
    return json_decode($body, true);
}

// Usage example: Refresh access token
$refreshed_token_data = refresh_instagram_access_token($access_token, $client_id, $client_secret);

if (!is_wp_error($refreshed_token_data)) {
    $new_access_token = $refreshed_token_data['access_token'];
    // Update the access token in your database or wherever you store it
} else {
    $error_message = $refreshed_token_data->get_error_message();
    // Handle error
}

// Get Instagram feed
$instagram_feed = get_instagram_feed($access_token);

// Display Instagram feed in Swiper carousel
if ($instagram_feed && isset($instagram_feed['data'])) {
    echo '<div class="swiper-wrapper">';
    foreach ($instagram_feed['data'] as $post) {
        $image_url = $post['media_url'];
        $permalink = $post['permalink'];

        echo '<div class="swiper-slide">';
        echo '<a href="' . $permalink . '" target="_blank"><img src="' . $image_url . '" alt="Instagram Post" class="img-fluid"></a>';
        echo '</div>';
    }
    echo '</div>';
} else {
    echo 'Error: Unable to fetch Instagram feed.';
}
?>
