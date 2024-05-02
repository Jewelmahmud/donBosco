<?php 
// template name: Test

// Initialize the InstagramAPI class
$instagram_api = new InstagramAPI();

$instagram_api->getInstagramFeed();

// Display Instagram feed
$instagram_api->displayInstagramFeed();