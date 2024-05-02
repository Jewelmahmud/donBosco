<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);


// Exit if accessed directly ---------------------------------------------------
if( !defined( 'ABSPATH' ) ) {
    die;
}

function load_more_posts() {
    $response = [];
    $page = $_POST['page'];
    $category_slug = $_POST['category'];
    $posts_per_page = get_option('posts_per_page');
 
    $args = array(
       'posts_per_page' => $posts_per_page,
       'post_status'    => 'publish',
       'paged'          => $page,
    );

    if(!empty($category_slug)) $args['category_name'] = $category_slug;
 
    $query = new WP_Query($args);
    $response['count']  = count($query->posts);

    if ($query->have_posts()) {
        ob_start();
        while ($query->have_posts()) {
            $query->the_post();
            get_template_part('template-parts/content', 'news');
        }
        $response['posts'] = ob_get_clean();
        wp_reset_postdata();
    } 
    wp_send_json($response);
    wp_die();
 }
 
 add_action('wp_ajax_load_more_posts', 'load_more_posts');
 add_action('wp_ajax_nopriv_load_more_posts', 'load_more_posts');


 function load_posts_by_category() {
    $response = [];
    $category_slug = $_POST['category'];
    $posts_per_page = get_option('posts_per_page');
  
    $args = array(
      'posts_per_page' => $posts_per_page,
      'post_status'    => 'publish',
    );
    
    if(!empty($category_slug)) $args['category_name'] = $category_slug;
  
    $query = new WP_Query($args);
    $response['count']  = count($query->posts);

    if ($query->have_posts()) {
      ob_start();
      while ($query->have_posts()) {
        $query->the_post();
        get_template_part('template-parts/content', 'news');
      }
      $response['posts'] = ob_get_clean();
      wp_reset_postdata();
    }
    wp_send_json($response);
    wp_die();
 }
 
 add_action('wp_ajax_load_posts_by_category', 'load_posts_by_category');
 add_action('wp_ajax_nopriv_load_posts_by_category', 'load_posts_by_category');



// Server-side function for processing the search and returning posts
function search_posts() {
    $response = [];
    $searchTerm = $_POST['search'];
    $posts_per_page = get_option('posts_per_page');

    $args = array(
        'post_type' => 'post',
        'posts_per_page' => $posts_per_page,
        's' => $searchTerm,
    );

    $query = new WP_Query($args);
    $response['count']  = count($query->posts);

    if ($query->have_posts()) :
        ob_start();
        while ($query->have_posts()) : $query->the_post();
          get_template_part('template-parts/content', 'news');
        endwhile;
        $response['posts'] = ob_get_clean();
        wp_reset_postdata();
    endif;
    wp_send_json($response);
    die();
}

add_action('wp_ajax_search_posts', 'search_posts');
add_action('wp_ajax_nopriv_search_posts', 'search_posts');

// contact form submission ---------------------------
function submit_contact_form() {
    $post = sanitizeFields($_POST);
    $to_emails = get_field('form_email_addresses', 'option');

    // Get the form data string
    $form_data_string = isset($post['formData']) ? $post['formData'] : '';
    $url = $post['url'];
    $name = '';
    $email = '';
    $phone = '';
    $textarea = '';
    
    parse_str($form_data_string, $form_data_array);

    if (isset($form_data_array['name'])) {
        $name = $form_data_array['name'];
    }
    if (isset($form_data_array['email'])) {
        $email = $form_data_array['email'];
    }
    if (isset($form_data_array['phone'])) {
        $phone = $form_data_array['phone'];
    }
    if (isset($form_data_array['message'])) {
        $textarea = $form_data_array['message'];
    }
    if (isset($form_data_array['honeypot'])) {
        $honeypot = $form_data_array['honeypot'];
    }
    
    if(!empty($honeypot)) {
        wp_send_json(['status' => false]);
        exit();
    }

    $to = array();

    if (!empty($to_emails)) {
        foreach ($to_emails as $email_row) {
            $email = $email_row['email'];
            if (!empty($email)) {
                $to[] = trim($email);
            }
        }
    }

    if (empty($to)) {
        $response = array('status' => 'error');
        echo json_encode($response);
        exit();
    }


    // Use the form data to construct the HTML email
    $subject = 'Nieuw contactformulier ingediend door '.$name;
    $message = "<html><body style='text-align: center;'>";
    $message .= "<p style='text-align: left;'>Voor-en achternaam: {$name}</p>";
    $message .= "<p style='text-align: left;'>Telefoon: {$phone}</p>";
    $message .= "<p style='text-align: left;'>Bericht: {$textarea}</p>";
    $message .= "<p style='text-align: left;'>Formulier ingediend vanaf: {$url}</p>";
    $message .= "</body></html>";

    $headers = array('Content-Type: text/html; charset=UTF-8');


    $status = true;

    foreach ($to as $recipient) {
        $result = wp_mail($recipient, $subject, $message, $headers);
        if (!$result) {
            $status = false;
        }
    }

    $response = array('status' => $status);
    wp_send_json($response);
    exit();
}

add_action('wp_ajax_submit_contact_form', 'submit_contact_form');
add_action('wp_ajax_nopriv_submit_contact_form', 'submit_contact_form');



function submit_page_form() {
    $post = sanitizeFields($_POST);
    $to_emails = get_field('form_email_addresses', 'option');
    

    $to = array();

    if (!empty($to_emails)) {
        foreach ($to_emails as $email_row) {
            $email = $email_row['email'];
            if (!empty($email)) {
                $to[] = trim($email);
            }
        }
    }

    if (empty($to)) {
        echo json_encode(['status' => 'error']);
        wp_die();
    }

    // Sanitize form data if needed
    $name       = $post['naam'];
    $company    = $post['companyName'];
    $telephone  = $post['phone'];
    $email      = $post['email'];
    $textarea   = $post['textArea'];
    $honeypot   = $post['honeypot'];
    $url        = $post['url'];

    if($honeypot) {
        echo json_encode(['status' => 'error']);
        wp_die();
    }

    // Use the form data to construct the email
    $subject = 'A new message from '.$name;
    $message = "<html><body style='text-align: center;'>";
    $message .= "<p style='text-align: left;'>Name: {$name}</p>";
    $message .= "<p style='text-align: left;'>Telephone: {$telephone}</p>";
    $message .= "<p style='text-align: left;'>Email: {$email}</p>";
    $message .= "<p style='text-align: left;'>Message: {$textarea}</p>";
    $message .= "<p style='text-align: left;'>Form submmited from: {$url}</p>";
    $message .= "</body></html>";

    $headers = array('Content-Type: text/html; charset=UTF-8');

    $status = 'success';

    foreach ($to as $recipient) {
        $result = wp_mail($recipient, $subject, $message, $headers);
        if (!$result) {
            $status = 'error';
        }
    }

    $response = array('status' => $status);
    echo json_encode($response);

    exit();

}

add_action('wp_ajax_submit_page_form', 'submit_page_form');
add_action('wp_ajax_nopriv_submit_page_form', 'submit_page_form');


function application_form_submission() {

    $post = sanitizeFields($_POST);   

    // Check honeypot for spam
    if (!empty($post['honeypot'])) {
        wp_send_json_error(array('message' => 'Spam submission detected.'));
        wp_die();
    }

    // Validate required fields
    $required_fields = array('firstname', 'lastname', 'phone', 'email');
    foreach ($required_fields as $field) {
        if (empty($_POST[$field])) {
            wp_send_json_error(array('message' => 'Please fill in all required fields.'));
            wp_die();
        }
    }



    $data = array(
        'name' => $post['firstname']." ".$post['lastname'],
        'dateOfBirth'=> $post['dateOfBirth'],
        'email' => $post['email'],
        'phone' => $post['phone'],
        // 'skype'=> $post['skype'],
        // 'linkedin'=> $post['linkedin'],
        // 'facebook'=> $post['facebook'],
        // 'twitter'=> $post['twitter'],
        // 'website'=> $post['website'],
        // 'blog'=> $post['blog'],
        'currentEmployer'=> $post['currentEmployer'],
        'currentPosition'=> $post['currentPosition'],
        'motivation'=> $post['motivation'],
    );

    if(isset($_POST['jobid'])) $data['jobId'] = $post['jobid'];
    $data['source'] = "Website";

    if(isset($_FILES['resume']) && !empty($_FILES['resume'])){
        $resume = $_FILES['resume'];
        $fileExtension = strtolower(substr(strrchr($resume['name'], '.'), 1));

        if (!in_array(strtolower($fileExtension), ['pdf', 'doc', 'docx', 'jpg', 'odt', 'fodt', 'ott', 'jpeg', 'png'])) {
            wp_send_json_error(array('message' => "This file is not allowed. Please try only allowed files."));
            wp_die();
        }

        if ($resume['size'] > 5 * 1024 * 1024) {
            wp_send_json_error(array('message' => 'File size exceeds the limit. Maximum size: 5 MB.'));
            wp_die();
        }

        $resume_path = $resume['tmp_name'];
        $resume_name = $resume['name'];
        $resume = base64_encode(file_get_contents($resume_path));

        $resume_data = [
            'name'    => $resume_name,
            'content' => $resume,
        ];
        $data['resume'] = $resume_data;
    }

    // if(isset($_FILES['cover']) && !empty($_FILES['cover'])){
    //     $cover = $_FILES['cover'];
    //     $fileExtension = strtolower(substr(strrchr($cover['name'], '.'), 1));

    //     if (!in_array(strtolower($fileExtension), ['pdf', 'doc', 'docx', 'jpg', 'odt', 'fodt', 'ott', 'jpeg', 'png'])) {
    //         wp_send_json_error(array('message' => "This file is not allowed. Please try only allowed files."));
    //         wp_die();
    //     }

    //     if ($cover['size'] > 5 * 1024 * 1024) {
    //         wp_send_json_error(array('message' => 'File size exceeds the limit. Maximum size: 5 MB.'));
    //         wp_die();
    //     }
        
    //     $cover_path = $cover['tmp_name'];
    //     $cover_name = $cover['name'];
    //     $cover = base64_encode(file_get_contents($cover_path));

    //     $cover_data = [
    //         'name'    => $cover_name,
    //         'content' => $cover,
    //     ];
    //     $data['cover'] = $cover_data;
    // }
    // if(isset($_FILES['photo']) && !empty($_FILES['photo'])){
    //     $photo = $_FILES['photo'];
    //     $fileExtension = strtolower(substr(strrchr($photo['name'], '.'), 1));

    //     if (!in_array(strtolower($fileExtension), ['jpg', 'jpeg', 'png', 'gif'])) {
    //         wp_send_json_error(array('message' => "This file is not allowed. Please try only allowed files."));
    //         wp_die();
    //     }

    //     if ($photo['size'] > 1 * 1024 * 1024) {
    //         wp_send_json_error(array('message' => 'File size exceeds the limit. Maximum size: 1 MB.'));
    //         wp_die();
    //     }

    //     $photo_path = $photo['tmp_name'];
    //     $photo_name = $photo['name'];
    //     $photo = base64_encode(file_get_contents($photo_path));

    //     $photo_data = [
    //         'name'    => $photo_name,
    //         'content' => $photo,
    //     ];
    //     $data['photo'] = $photo_data;

    // }

    // send candidate to forceflow system

    if(postCandidate($data)) $status = "success";
    else $status = "error";

    wp_send_json(['send'=>$status, 'message' => __("Application has been successfully submitted.", 'donbosco')]);
    wp_die();
}


// Function to set the email content type to HTML
function set_html_content_type() {
    return 'text/html';
}
  
    add_action('wp_ajax_application_form_submission', 'application_form_submission');
    add_action('wp_ajax_nopriv_application_form_submission', 'application_form_submission');

 

    function filter_vacancies() {
        
        $posts_per_page = get_option('posts_per_page');
        $post = sanitizeFields($_POST);

        if(isset($_POST['branches'])) $branches = $post['branches'];
        if(isset($_POST['location'])) $location = $post['location'];
        if(isset($_POST['hourlyrate'])) $hourlyrate = $post['hourlyrate'];
        if(isset($_POST['yearsofexperience'])) $yearsofexperience = $post['yearsofexperience'];
        
        $args = array(
            'post_type'      => 'vacancies',
            'posts_per_page' => $posts_per_page, 
            'status'         => 'publish',
            'meta_query'     => array(
                'relation'   => 'AND',
            ),
        );

        if (!empty($branches)) {
            $args['tax_query'] = array(
                array(
                    'taxonomy' => 'job_category',
                    'field'    => 'id',
                    'terms'    => $branches,
                    'operator' => 'IN',
                ),
            );
        }

        // Add meta queries for each custom field if it's not empty
        if (!empty($location)) {
            $args['meta_query'][] = array(
                'key'   => 'location', 
                'value' => $location,
                'compare' => 'IN',
            );
        }

        if (!empty($educations)) {
            $args['meta_query'][] = array(
                'key'   => 'educational_requirement', 
                'value' => $educations,
                'compare' => 'IN',
            );
        }


        if (!empty($hourlyrate)) {
            $args['meta_query'][] = array(
                'key'   => 'hourly_rate',
                'value' => $hourlyrate,
                'compare' => 'IN',
            );
        }

        if (!empty($yearsofexperience)) {
            $args['meta_query'][] = array(
                'key'   => 'years_of_experience',
                'value' => $yearsofexperience,
                'compare' => 'IN',
            );
        }

        $filter_args = $args; 
        $total_args = $args; 
        $filter_args['posts_per_page'] = -1;
        $total_args['posts_per_page'] = -1;
        // unset($filter_args['meta_query']);

        // Perform the custom query
        $query = new WP_Query($args);
        $filters = new WP_Query($filter_args);
        $total = new WP_Query($total_args);
        $filterlists = [
            'locations' => [
                'items' => [],
                'item_counts' => [], // New array to store item counts
            ],
            'hourlyrate' => [
                'items' => [],
                'item_counts' => [],
            ],
            'yearsofexperience' => [
                'items' => [],
                'item_counts' => [],
            ],
        ];
    

        if ($filters->have_posts()) {
            while ($filters->have_posts()) {
                $filters->the_post();
                // Get meta data for each job
                $location = get_field('location');
                $hourlyrate = get_field('hourly_rate');
                $yearsofexperience = get_field('years_of_experience');               
        
                // Track counts for each item
                if (!empty($location)) {
                    $filterlists['locations']['items'][] = $location;
                    $filterlists['locations']['item_counts'][$location] = isset($filterlists['locations']['item_counts'][$location]) ? $filterlists['locations']['item_counts'][$location] + 1 : 1;
                }
                if (!empty($hourlyrate)) {
                    $filterlists['hourlyrate']['items'][] = $hourlyrate;
                    $filterlists['hourlyrate']['item_counts'][$hourlyrate] = isset($filterlists['hourlyrate']['item_counts'][$hourlyrate]) ? $filterlists['hourlyrate']['item_counts'][$hourlyrate] + 1 : 1;
                }
                if (!empty($yearsofexperience)) {
                    $filterlists['yearsofexperience']['items'][] = $yearsofexperience;
                    $filterlists['yearsofexperience']['item_counts'][$yearsofexperience] = isset($filterlists['yearsofexperience']['item_counts'][$yearsofexperience]) ? $filterlists['yearsofexperience']['item_counts'][$yearsofexperience] + 1 : 1;
                }
            }

            $filterlists['locations']['items'] = array_unique($filterlists['locations']['items']);
            $filterlists['hourlyrate']['items'] = array_unique($filterlists['hourlyrate']['items']);
            $filterlists['yearsofexperience']['items'] = array_unique($filterlists['yearsofexperience']['items']);

        
            // Reset post data
            wp_reset_postdata();
        }

        if ($query->have_posts()) {
            ob_start();
            while ($query->have_posts()) {
                $query->the_post();
                get_template_part('template-parts/content', 'jobs');   
            }
            
            wp_reset_postdata();
            $jobs = ob_get_clean();
        } else {
            $jobs = null;
        }
        

        $text = __('Show', 'donbosco')." (".$total->found_posts.") ".__('results', 'donbosco');

        $returned= ['total_found' =>  $total->found_posts, 'jobs'=> $jobs, 'filters' => $filterlists, 'btn_text' => $text];

        $logFilePath = trailingslashit(get_template_directory()) . '/functions/query.log';
        if (!file_exists($logFilePath)) {
            touch($logFilePath);
            chmod($logFilePath, 0644);
        }
        file_put_contents($logFilePath, date('Y-m-d H:i:s') . " - Event:\n" . print_r($args, true) . "\n", FILE_APPEND);



        echo wp_send_json($returned);

        wp_die(); 
    }
    add_action('wp_ajax_filter_vacancies', 'filter_vacancies');
    add_action('wp_ajax_nopriv_filter_vacancies', 'filter_vacancies');


    function load_more_jobs() {

        $post = sanitizeFields($_POST);
        $posts_per_page = get_option('posts_per_page');
        $page = $post['page'];

        if(isset($_POST['branches'])) $branches = $post['branches'];
        if(isset($_POST['location'])) $location = $post['location'];
        if(isset($_POST['hourlyrate'])) $hourlyrate = $post['hourlyrate'];
        if(isset($_POST['yearsofexperience'])) $yearsofexperience = $post['yearsofexperience'];

        $args = array(
            'post_type' => 'vacancies',
            'posts_per_page' => $posts_per_page,
            'post_status' => 'publish',
            'paged' => $page,
        );

        if (!empty($branches)) {
            $args['tax_query'] = array(
                array(
                    'taxonomy' => 'job_category',
                    'field'    => 'id',
                    'terms'    => $branches,
                    'operator' => 'IN',
                ),
            );
        }


        $args['meta_query'] = array(
            'relation' => 'AND'
        );
        
        if (!empty($location)) {
            $args['meta_query'][] = array(
                'key'   => 'location', 
                'value' => $location,
                'compare' => 'IN',
            );
        }


        if (!empty($hourlyrate)) {
            $args['meta_query'][] = array(
                'key'   => 'hourly_rate',
                'value' => $hourlyrate,
                'compare' => 'IN',
            );
        }

        if (!empty($yearsofexperience)) {
            $args['meta_query'][] = array(
                'key'   => 'years_of_experience',
                'value' => $hoursperweek,
                'compare' => 'IN',
            );
        }


        $jobs_query = new WP_Query($args);
        $jobs = null; 

        if ($jobs_query->have_posts()) {
            ob_start();
            while ($jobs_query->have_posts()) {
                $jobs_query->the_post();
                get_template_part('template-parts/content', 'jobs');   
            }
            
            wp_reset_postdata();
            $jobs = ob_get_clean();
        } 
        echo wp_send_json(['jobs'=> $jobs]);
        wp_die();
    }

    add_action('wp_ajax_load_more_jobs', 'load_more_jobs');
    add_action('wp_ajax_nopriv_load_more_jobs', 'load_more_jobs');



    function fetch_events_by_year() {
    
        $post = sanitizeFields($_POST);
        $year = $post['year'];
        $start_date = mktime(0, 0, 0, 1, 1, $year);
        $end_date = mktime(23, 59, 59, 12, 31, $year);

    
        $args = array(
            'post_type' => 'activiteiten',
            'posts_per_page' => get_option('posts_per_page'),
            'status' => 'publish'
            // 'meta_query' => array(
            //     'relation' => 'AND',
            //     array(
            //         'key' => 'start_date',
            //         'value' => array(date('Ymd', $start_date), date('Ymd', $end_date)),
            //         'compare' => 'BETWEEN',
            //         'type' => 'DATE',
            //     ),
            // ),
        );
        $query = new WP_Query($args);
    
        ob_start();
        if ($query->have_posts()) {
            $colors = array('ylw', 'green', 'red');
            $counter = 0;
            while ($query->have_posts()) {
                $query->the_post();
                $counter ++; $color = $colors[$counter % 3];

                $categories = get_the_terms( get_the_ID(), 'activity_type' );
                $category_slugs = array();
    
                if (!empty($categories)) {
                    foreach ($categories as $category) {
                        $category_slugs[] = esc_attr($category->slug);
                    }
                }
                $category_class = implode(' ', $category_slugs); 
                $startdate = get_field('start_date');
                $start_year = date('Y', strtotime($startdate));

                $enddata = get_field('end_date');
                $endtime = get_field('end_time');

                if($year < date('Y')) {
                    if(!isEventAlive($enddata, $endtime) && $year === $start_year){ ?>        
                        <div class="col-lg-4 col-md-6 mb-4 filter-item <?php echo $category_class; ?>">
                            <a href="<?php the_permalink(); ?>" class="news-card event-card">
                            <div class="news-card-header">
                                <div class="card-image">
                                <?php
                                if (has_post_thumbnail()) {
                                    the_post_thumbnail('newsthumb', ['class' => 'img-fluid', 'alt' => 'card image']);
                                } else {  ?>
                                    <img src="<?php echo get_template_directory_uri(); ?>/assets/images/placeholoder_logo.jpg" alt="card image" class="img-fluid">
                                <?php  }  ?>
                                </div>
                                <div class="news-card-tag tag-bg-<?php echo $color; ?>">
                                <img src="<?php echo get_template_directory_uri(); ?>/assets/images/icon-info.svg" alt="info icon">
                                <?php echo $category_class; ?>
                                </div>
                            </div>
                            <div class="news-card-body">
                                <div class="event-date">
                                <img src="<?php echo get_template_directory_uri(); ?>/assets/images/icon-calendar.svg" alt="icon-calendar">
                                <?php the_field('start_date'); ?> - <?php the_field('end_date'); ?>
                                </div>
                                <h3><?php the_title(); ?></h3>
                                <p><?php echo wp_trim_words(get_the_excerpt(), 10, '...'); ?></p>
                                <div class="mb-4 mb-xl-5">
                                <div class="d-flex align-items-center gap-2 mb-2 pb-1 text-grey fs13px">
                                    <img src="<?php echo get_template_directory_uri(); ?>/assets/images/icon-clock-r.svg" alt="clock"> <?php the_field('start_time'); ?> - <?php the_field('end_time'); ?>
                                </div>
                                <div class="d-flex align-items-center gap-2 mb-2 pb-1 text-grey fs13px">
                                    <img src="<?php echo get_template_directory_uri(); ?>/assets/images/icon-place-r.svg" alt="place"> <?php the_field('location'); ?>
                                </div>
                                </div>
                                <div class="text-link">Lees meer <img src="<?php echo get_template_directory_uri(); ?>/assets/images/icon-arrow.svg" alt="icon-arrow"></div>
                            </div>
                            </a>
                        </div><?php 
                    } 

                } else {
                    if(isEventAlive($enddata, $endtime) && $year === $start_year){ ?>        
                        <div class="col-lg-4 col-md-6 mb-4 filter-item <?php echo $category_class; ?>">
                            <a href="<?php the_permalink(); ?>" class="news-card event-card">
                            <div class="news-card-header">
                                <div class="card-image">
                                <?php
                                if (has_post_thumbnail()) {
                                    the_post_thumbnail('newsthumb', ['class' => 'img-fluid', 'alt' => 'card image']);
                                } else {  ?>
                                    <img src="<?php echo get_template_directory_uri(); ?>/assets/images/placeholoder_logo.jpg" alt="card image" class="img-fluid">
                                <?php  }  ?>
                                </div>
                                <div class="news-card-tag tag-bg-<?php echo $color; ?>">
                                <img src="<?php echo get_template_directory_uri(); ?>/assets/images/icon-info.svg" alt="info icon">
                                <?php echo $category_class; ?>
                                </div>
                            </div>
                            <div class="news-card-body">
                                <div class="event-date">
                                <img src="<?php echo get_template_directory_uri(); ?>/assets/images/icon-calendar.svg" alt="icon-calendar">
                                <?php the_field('start_date'); ?> - <?php the_field('end_date'); ?>
                                </div>
                                <h3><?php the_title(); ?></h3>
                                <p><?php echo wp_trim_words(get_the_excerpt(), 10, '...'); ?></p>
                                <div class="mb-4 mb-xl-5">
                                <div class="d-flex align-items-center gap-2 mb-2 pb-1 text-grey fs13px">
                                    <img src="<?php echo get_template_directory_uri(); ?>/assets/images/icon-clock-r.svg" alt="clock"> <?php the_field('start_time'); ?> - <?php the_field('end_time'); ?>
                                </div>
                                <div class="d-flex align-items-center gap-2 mb-2 pb-1 text-grey fs13px">
                                    <img src="<?php echo get_template_directory_uri(); ?>/assets/images/icon-place-r.svg" alt="place"> <?php the_field('location'); ?>
                                </div>
                                </div>
                                <div class="text-link">Lees meer <img src="<?php echo get_template_directory_uri(); ?>/assets/images/icon-arrow.svg" alt="icon-arrow"></div>
                            </div>
                            </a>
                        </div><?php 
                    } 
                }
            }
            wp_reset_postdata();
        } else {
            echo 'No posts found';
        }

        $jobs = ob_get_clean();
    
        echo wp_send_json(['jobs'=> $jobs]);
        wp_die();
    }
    add_action('wp_ajax_fetch_events_by_year', 'fetch_events_by_year');
    add_action('wp_ajax_nopriv_fetch_events_by_year', 'fetch_events_by_year');