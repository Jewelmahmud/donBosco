<?php

class InstagramAPI {
    private $client_id;
    private $client_secret;
    private $redirect_uri;
    private $access_token;

    public function __construct() {
        $this->client_id = get_field('instagram_client_id', 'option');
        $this->client_secret = get_field('instagram_client_secret', 'option');
        $this->redirect_uri = get_field('instagram_redirect_uri', 'option');
        $this->access_token = get_field('instagram_access_token', 'option');
    }

    public function refreshAccessTokenIfNeeded() {
        $token_expires_at = get_field('instagram_access_token_expires', 'option');
        if ($token_expires_at && strtotime($token_expires_at) <= time()) {
            $refreshed_token_data = $this->refreshAccessToken();

            if (!is_wp_error($refreshed_token_data)) {
                update_field('instagram_access_token', $refreshed_token_data['access_token'], 'option');
                update_field('instagram_access_token_expires', date('Y-m-d H:i:s', time() + $refreshed_token_data['expires_in']), 'option');
            } else {
                $error_message = $refreshed_token_data->get_error_message();
                return false;
            }
        }

        return true;
    }

    public function refreshAccessToken() {
        $url = 'https://graph.instagram.com/refresh_access_token';
        $args = array(
            'body' => array(
                'grant_type' => 'ig_refresh_token',
                'access_token' => $this->access_token,
                'client_id' => $this->client_id,
                'client_secret' => $this->client_secret,
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

    public function getInstagramFeed() {
        $refresh_result = $this->refreshAccessTokenIfNeeded();
        if (!$refresh_result) {
            return array();
        }

        $url = "https://graph.instagram.com/me/media?fields=id,media_type,media_url,thumbnail_url,permalink&access_token={$this->access_token}";
        $response = wp_remote_get($url);
        $body = wp_remote_retrieve_body($response);
        return json_decode($body, true);
    }

    public function displayInstagramFeed() {
        $instagram_feed = $this->getInstagramFeed();
    
        if ($instagram_feed && isset($instagram_feed['data'])) {
            echo '<div class="insta-carousel swiper">';
            echo '<div class="swiper-wrapper">';
            foreach ($instagram_feed['data'] as $post) {
                if ($post['media_type'] === 'IMAGE' || $post['media_type'] === 'CAROUSEL_ALBUM') {
                    $media_html = '<img src="' . $post['media_url'] . '" alt="Instagram Post" class="img-fluid">';
                } elseif ($post['media_type'] === 'VIDEO') {
                    $media_html = '<video controls>';
                    $media_html .= '<source src="' . $post['media_url'] . '" type="video/mp4">';
                    $media_html .= 'Your browser does not support the video tag.';
                    $media_html .= '</video>';
                } else {
                    $media_html = '';
                }
    
                $permalink = $post['permalink'];
                echo '<div class="swiper-slide">';
                echo '<div class="overlay"></div>';
                echo '<a href="' . $permalink . '" target="_blank">' . $media_html . '</a>';
                echo '</div>';
            }
            echo '</div>'; 
            echo '</div>'; 
        } else {
            echo 'Error: Unable to fetch Instagram feed.';
        }
    }
    
}



