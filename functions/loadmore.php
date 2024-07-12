<?php 

function more_post_ajax(){
    $offset = $_POST["offset"];
    $ppp = $_POST["ppp"];

    header("Content-Type: text/html");
    $args = [
        'suppress_filters' => true,
        'post_type' => 'post',
        'posts_per_page' => $ppp,
        'cat' => 1,
        'offset' => $offset,
    ];

    $loop = new WP_Query($args);

    while ($loop->have_posts()) { $loop->the_post(); 
        the_content();
    }
    exit; 
}

add_action('wp_ajax_nopriv_more_post_ajax', 'more_post_ajax'); 
add_action('wp_ajax_more_post_ajax', 'more_post_ajax');


// IGQVJYc1BEdDY2U2xHTllrQW8zZA2EyNWJnNWFXLW1nWHRvMUJGeVFvR2dHSk1kVkVIdUNPWnFJbktBT251RVVFVWZAldmItLUVObmg0UGZAGOHBKQy1vc3haQ1gzSS1QeEkwVG5aZAm1CX0VRU08yaGJfVwZDZD    //User Token for lifeinad
// IGQVJVNG1XMmdmY3lSOXBJOUU2NVoyZA3FHeUpaY1BRNG1TVFhHMnZALakxSSWtIelJ1aEt6RWVKbm8tY2JTaGJTRXYtdXV1UFRJbmcwRGxWaEtBbmZAHZAEdBNUxxaU0xd2RNTldlUVYyQ1J0YjgxR0dvSAZDZD    // Jewel Mahmud Account