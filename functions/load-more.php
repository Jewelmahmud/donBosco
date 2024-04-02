<?php 

add_action('rest_api_init', 'custom_api_get_projects');
function custom_api_get_projects(){
  register_rest_route( 'faq', '/all-posts', array(
    'methods' => 'GET',
    'callback' => 'custom_api_get_projects_callback'
  ));
}