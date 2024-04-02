<?php
$get =  sanitizeFields($_GET);
// Vacancies Archieve
if (isset($get['id'])) { 

      $custom_template_path = get_template_directory() . "/partials/job.php";

      if (file_exists($custom_template_path)) {
          if (is_readable($custom_template_path)) {
              require_once $custom_template_path;
          }
      }
      die();
}
 
// $locations = get_field_object('field_658cce5ba8f3d')['choices'];
// $education = get_field_object('field_658ccf04a8f3f')['choices'];
// $hours_per_week = get_field_object('field_658ccf9ea8f40')['choices'];
// $accomodation = get_field_object('field_658ccff9a8f41')['choices'];

$posts_per_page = get_option('posts_per_page');

get_header(); 

if(isset($get['search']) ){

  $search = isset($get['search']) ? sanitizeInput($get['search']) : null;
  $category = isset($get['cat']) ? sanitizeInput($get['cat']) : null;

  $args = array(
      'post_type'      => 'vacancies',
      'posts_per_page' => $posts_per_page,
      'status'=> 'publish',
  );

  if (!empty($category)) {
      $args['tax_query'] = array(
          array(
              'taxonomy' => 'job_category',
              'field'    => 'term_id',
              'terms'    => $category,
          ),
      );
  }

  if(!empty($search)){

    $args['s'] = $search;

    // $args['meta_query'] = array(
    //   'relation' => 'OR',
    //   array(
    //       'key'     => 'location',
    //       'value'   => $search,
    //       'compare' => 'LIKE',
    //   ),
    //   array(
    //       'key'     => 'reference_no',
    //       'value'   => $search,
    //       'compare' => 'LIKE',
    //   ),
    //   array(
    //       'key'     => 'company_name',
    //       'value'   => $search,
    //       'compare' => 'LIKE',
    //   ),
    //   array(
    //       'key'     => 'location',
    //       'value'   => $search,
    //       'compare' => 'LIKE',
    //   ),
    //   array(
    //       'key'     => 'hourly_rate',
    //       'value'   => $search,
    //       'compare' => 'LIKE',
    //   ),
    //   array(
    //       'key'     => 'reference_no',
    //       'value'   => $search,
    //       'compare' => 'LIKE',
    //   ),
    //   array(
    //       'key'     => 'educational_level',
    //       'value'   => $search,
    //       'compare' => 'LIKE',
    //   ),
    //   array(
    //       'key'     => 'hours_per_week',
    //       'value'   => $search,
    //       'compare' => 'LIKE',
    //   ),
    // );
  
  }

  $query = new WP_Query($args);

}


// Filter builder -----

$filterargs = array(
  'post_type'      => 'vacancies',
  'posts_per_page' => -1,
  'status'         => 'publish',
);

$filter = new WP_Query($filterargs);




$filterlists = [
  'locations' => [
      'item_counts' => [], // New array to store item counts
  ],
  'accommodation' => [
      'item_counts' => [],
  ],
  'hourlyrate' => [
      'item_counts' => [],
  ],
  'yearsofexperience' => [
      'item_counts' => [],
  ],
];


if ($filter->have_posts()) {
  while ($filter->have_posts()) {
      $filter->the_post();

      // Get meta data for each job
      $location = get_field('location');
      $accommodation = get_field('accommodation'); 
      $hourlyrate = get_field('hourly_rate');
      $yearsofexperience = get_field('years_of_experience');               

      // Track counts for each item
      if (!empty($location)) {
          $filterlists['locations']['item_counts'][$location] = isset($filterlists['locations']['item_counts'][$location]) ? $filterlists['locations']['item_counts'][$location] + 1 : 1;
      }
      if (!empty($accommodation)) {
          $filterlists['accommodation']['item_counts'][$accommodation] = isset($filterlists['accommodation']['item_counts'][$accommodation]) ? $filterlists['accommodation']['item_counts'][$accommodation] + 1 : 1;
      }
      if (!empty($hourlyrate)) {
          $filterlists['hourlyrate']['item_counts'][$hourlyrate] = isset($filterlists['hourlyrate']['item_counts'][$hourlyrate]) ? $filterlists['hourlyrate']['item_counts'][$hourlyrate] + 1 : 1;
      }
      if (!empty($yearsofexperience)) {
          $filterlists['yearsofexperience']['item_counts'][$yearsofexperience] = isset($filterlists['yearsofexperience']['item_counts'][$yearsofexperience]) ? $filterlists['yearsofexperience']['item_counts'][$yearsofexperience] + 1 : 1;
      }
  }

  $locations = $filterlists['locations']['item_counts'];
  $accomodation = $filterlists['accommodation']['item_counts'];
  $hourlyrates = $filterlists['hourlyrate']['item_counts'] ;
  $yearsofexperiences = $filterlists['yearsofexperience']['item_counts'];
 
  wp_reset_postdata();
}
$current_language = ICL_LANGUAGE_CODE;
$taxonomy = 'job_category';
$job_cats = get_terms($taxonomy, array('hide_empty' => true));



?>
<style> body {overflow: auto !important;padding-right: 0px !important;}</style>
<input type="hidden" value="<?php echo admin_url('admin-ajax.php'); ?>" id="ajaxurl">
<section class="vacancies-wrapper">
  <?php if(!isset($_GET['favorites'])){?>
    <div class="vacancies-wrapper-top">
      <div class="container dessktop-filter">
        <div class="row filter-search d-none d-lg-flex">
          <!-- <div class="col-12">
            <div class="search-result">Search results (1 - 30 van 5.909)</div>
          </div> -->
          <?php if(!empty($job_cats) && !is_wp_error($job_cats)) : ?>
          <div class="col-12 col-md-6 col-lg-auto categories">
            <div class="cat-item dropdown">
              <a class="dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" data-bs-auto-close="outside"
                aria-expanded="false">
                <svg width="22" height="23" viewBox="0 0 22 23" fill="none" xmlns="http://www.w3.org/2000/svg">
                  <path d="M3.66943 8.57679L3.94093 4.3996C3.94093 4.13011 4.21242 3.99536 4.48391 3.99536H6.65584C6.92734 3.99536 7.19883 4.13011 7.19883 4.3996L7.33457 8.57679" stroke="#F56537" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                  <path d="M18.4829 7.22289C18.4394 7.25404 18.4002 7.29093 18.3571 7.32253L16.0127 9.04141C15.9696 9.07302 15.9306 9.11055 15.8859 9.1398C15.5982 9.32786 15.1233 9.05935 15.1233 8.67032V7.5541C15.1233 7.16507 14.6484 6.89656 14.3606 7.08462C14.3159 7.11387 14.2769 7.1514 14.2338 7.18301L11.8894 8.90188C11.8463 8.93349 11.8073 8.97103 11.7626 9.00027C11.4749 9.18833 11 8.91982 11 8.53079V7.27505C11 6.85647 10.5877 6.57741 10.1753 6.85647L7.67703 8.50498C7.51359 8.61283 7.32209 8.67032 7.12628 8.67032H3.44063C3.0283 8.67032 2.75342 8.94937 2.75342 9.36795V17.0419C2.75342 17.4605 3.0283 17.7396 3.44063 17.7396H18.6968C18.9717 17.7396 19.2465 17.4605 19.2465 17.1815V7.5541C19.2465 7.16461 18.7705 7.01673 18.4829 7.22289Z" stroke="#F56537" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                  <path d="M11.9165 12.7003H12.8328" stroke="#F56537" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                  <path d="M15.5811 12.7003H16.4973" stroke="#F56537" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                  <path d="M11.9165 14.5328H12.8328" stroke="#F56537" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                  <path d="M15.5811 14.5328H16.4973" stroke="#F56537" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                  <path d="M4.58594 13.2422C4.58594 12.6899 5.03365 12.2422 5.58594 12.2422H8.16736C8.71965 12.2422 9.16736 12.6899 9.16736 13.2422V17.7399H4.58594V13.2422Z" stroke="#F56537" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                </svg><?php echo __('Branches', 'b2works'); ?>
              </a>
              <div class="dropdown-menu fade">
                <div class="container">
                  <div class="jobboardfilter">
                    <div class="header">
                      <h3 class="title"><?php echo __('Branches', 'b2works')?></h3>
                      <button class="btn close-filter btn-close"><span class="icon">
                        
                      </span></button>
                    </div>
                    <div class="filter-scrolable-wrapper">
                      <ul class="filter-category branches">

                      <?php 

                        if(!empty($job_cats) && !is_wp_error($job_cats)) { $i= 0;
                          foreach($job_cats as $item){
                            $term_id = $item->term_id;
                            $term_slug = $item->slug;
                            $term_name = $item->name;                            
                            $post_count = get_term($term_id, $taxonomy)->count;
                            // $term = get_term($term_id, $taxonomy);

                            // if ($term && !is_wp_error($term)) {
                            //     $args = array(
                            //         'post_type'      => 'vacancies',
                            //         'posts_per_page' => -1,
                            //         'tax_query'      => array(
                            //             array(
                            //                 'taxonomy' => $taxonomy,
                            //                 'field'    => 'id',
                            //                 'terms'    => $term_id,
                            //             ),
                            //         ),
                            //         'post_status'    => 'publish',
                            //     );

                            //     $posts = get_posts($args);
                            //     $post_count = count($posts);
                            // }



                            ?>
                          <li class="filter-item">
                            <label for="br<?php echo $i; ?>">
                              <div class="checkbox__input">
                                <input id="br<?php echo $i; ?>" name="branches" value="<?php echo $term_id; ?>" type="checkbox">
                                <span class="checkbox__style" aria-hidden="true"> 
                                  <span class="icon">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="currentColor"><path d="m10 15.586-3.293-3.293-1.414 1.414L10 18.414l9.707-9.707-1.414-1.414z"></path></svg>
                                  </span>
                                </span>
                              </div>
                              <span class="checkbox__label"><?php echo $term_name; ?> <span class="filter__counter" data-for-filter="br<?php echo $i; ?>">(<?php echo $post_count; ?>)</span></span>
                            </label>
                          </li><?php 
                          $i++;}
                        }
                      ?>

                        
                      </ul>
                    </div>
                    <div class="form__container--summary">
                      <button class="btn btn-secondary close-filter v-search">
                        <?php echo __('Search Job', 'b2works'); ?>
                      </button>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <?php endif; ?>

          <?php if($locations) : ?>
          <div class="col-12 col-md-6 col-lg-auto location">
            <div class="cat-item dropdown">
              <a class="dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" data-bs-auto-close="outside"
                aria-expanded="false">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none">
                  <path d="M7.5 11.8375C4.58917 12.2384 2.5 13.3142 2.5 14.5834C2.5 16.1942 5.8575 17.5 10 17.5C14.1425 17.5 17.5 16.1942 17.5 14.5834C17.5 13.3142 15.4108 12.2384 12.5 11.8375" stroke="#F56537" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                  <path d="M9.99967 14.1667V7.5" stroke="#F56537" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                  <path d="M11.7678 3.23223C12.7441 4.20854 12.7441 5.79146 11.7678 6.76776C10.7915 7.74407 9.20854 7.74407 8.23223 6.76776C7.25592 5.79146 7.25592 4.20854 8.23223 3.23223C9.20854 2.25592 10.7915 2.25592 11.7678 3.23223" stroke="#F56537" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                </svg><?php echo __('Location', 'b2works'); ?>
              </a>
              <div class="dropdown-menu fade">
                <div class="container">
                  <div class="jobboardfilter">
                    <div class="header">
                      <h3 class="title"><?php echo __('Location', 'b2works')?></h3>
                      <button class="btn close-filter btn-close"><span class="icon">
                        
                      </span></button>
                    </div>
                    <div class="filter-scrolable-wrapper">
                      <ul class="filter-category locations">

                      <?php 

                        if($locations) { $i= 0;
                          foreach($locations as $key => $value){?>
                          <li class="filter-item">
                            <label for="a<?php echo $i; ?>">
                              <div class="checkbox__input">
                                <input id="a<?php echo $i; ?>" name="locations" value="<?php echo $key; ?>" type="checkbox">
                                <span class="checkbox__style" aria-hidden="true"> 
                                  <span class="icon">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="currentColor"><path d="m10 15.586-3.293-3.293-1.414 1.414L10 18.414l9.707-9.707-1.414-1.414z"></path></svg>
                                  </span>
                                </span>
                              </div>
                              <span class="checkbox__label"><?php echo $key; ?> <span class="filter__counter" data-for-filter="a<?php echo $i; ?>">(<?php echo $value; ?>)</span></span>
                            </label>
                          </li><?php 
                          $i++;}
                        }
                      ?>

                        
                      </ul>
                    </div>
                    <div class="form__container--summary">
                      <button class="btn btn-secondary close-filter v-search">
                        <?php echo __('Search Job', 'b2works'); ?>
                      </button>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <?php endif; ?>


          <?php if($accomodation) : ?>
          <!-- <div class="col-12 col-md-6 col-lg-auto housing">
            <div class="cat-item dropdown">
              <a class="dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" data-bs-auto-close="outside"
                aria-expanded="false">
                <svg xmlns="http://www.w3.org/2000/svg" width="19" height="19" viewBox="0 0 19 19" fill="none">
                  <path d="M3.5 6.58423V15.8842H15.5V6.58423" stroke="#FF551E" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                  <path d="M2 7.63428L9.5 2.38428L17 7.63428" stroke="#FF551E" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                  <path d="M11.75 15.8843V11.3843C11.75 10.5555 11.0788 9.88428 10.25 9.88428H8.75C7.92125 9.88428 7.25 10.5555 7.25 11.3843V15.8843" stroke="#FF551E" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                </svg><?php echo __('Accomodation', 'b2works'); ?>
              </a>
              <div class="dropdown-menu fade">
                <div class="container">
                  <div class="jobboardfilter">
                    <div class="header">
                      <h3 class="title"><?php echo __('Accomodation', 'b2works'); ?></h3>
                      <button class="btn close-filter btn-close"><span class="icon">
                        
                      </span></button>
                    </div>
                    <div class="filter-scrolable-wrapper">
                      <ul class="filter-category accomodation">
                        <?php 

                          if($accomodation) { $i= 0;
                            foreach($accomodation as $key => $value){?>
                            <li class="filter-item">
                              <label for="d<?php echo $i; ?>">
                                <div class="checkbox__input">
                                    <input id="d<?php echo $i; ?>" name="accomodation" value="<?php echo $key; ?>" type="checkbox">
                                    <span class="checkbox__style" aria-hidden="true"> 
                                      <span class="icon">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="currentColor"><path d="m10 15.586-3.293-3.293-1.414 1.414L10 18.414l9.707-9.707-1.414-1.414z"></path></svg>
                                      </span>
                                    </span>
                                </div>
                                <span class="checkbox__label"><?php echo $key; ?> <span class="filter__counter"
                                    data-for-filter="d<?php echo $i; ?>">(<?php echo $value; ?>)</span></span>
                              </label>
                            </li><?php 
                            $i++;}
                          }
                        ?>
                        
                      </ul>
                    </div>
                    <div class="form__container--summary">
                      <button class="btn btn-secondary close-filter v-search">
                        <?php echo __('Search Job', 'b2works'); ?>
                      </button>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div> -->
          <?php endif; ?>

          <?php if($hourlyrates) : ?>
          <div class="col-12 col-md-6 col-lg-auto hourlyrates">
            <div class="cat-item dropdown">
              <a class="dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" data-bs-auto-close="outside"
                aria-expanded="false">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none">
                  <path d="M15.2881 4.59614C18.0706 7.37863 18.0706 11.8899 15.2881 14.6724C12.5056 17.4549 7.99434 17.4549 5.21187 14.6724C2.42938 11.8899 2.42938 7.37861 5.21187 4.59614C7.99435 1.81366 12.5056 1.81366 15.2881 4.59614" stroke="#FE6330" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                  <path d="M13.0495 12.4335C11.5033 13.9796 8.99771 13.9796 7.45159 12.4335C5.90546 10.8874 5.90546 8.38174 7.45159 6.83562C8.99771 5.28949 11.5033 5.28949 13.0495 6.83562" stroke="#FE6330" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                  <path d="M10.25 8.54183H5.5" stroke="#FE6330" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                  <path d="M10.25 10.7269H5.5" stroke="#FE6330" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                </svg><?php echo __('Hourly rate', 'b2works'); ?>
              </a>


              <div class="dropdown-menu fade">
                <div class="container">
                  <div class="jobboardfilter">
                    <div class="header">
                      <h3 class="title"><?php echo __('Hourly rate', 'b2works'); ?></h3>
                      <button class="btn close-filter btn-close"><span class="icon">
                        
                      </span></button>
                    </div>
                    <div class="filter-scrolable-wrapper">
                      <ul class="filter-category hourlyrate">
                        <?php 

                          if($hourlyrates) { $i= 0;
                            foreach($hourlyrates as $key => $value){?>
                            <li class="filter-item">
                              <label for="e<?php echo $i; ?>">
                                <div class="checkbox__input">
                                  <input id="e<?php echo $i; ?>" name="hourlyrate" value="<?php echo $key; ?>" type="checkbox">
                                  <span class="checkbox__style" aria-hidden="true"> <span class="icon">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="currentColor"><path d="m10 15.586-3.293-3.293-1.414 1.414L10 18.414l9.707-9.707-1.414-1.414z"></path></svg>
                                  </span>
                                  </span>
                                </div>
                                <span class="checkbox__label"><?php echo $key; ?> <span class="filter__counter"
                                    data-for-filter="e<?php echo $i; ?>">(<?php echo $value; ?>)</span></span>
                              </label>
                            </li><?php 
                            $i++;}
                          }
                        ?>
                        
                      </ul>
                    </div>
                    <div class="form__container--summary">
                      <button class="btn btn-secondary close-filter v-search">
                        <?php echo __('Search Job', 'b2works'); ?>
                      </button>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <?php endif; ?>


          <?php if($yearsofexperiences) : ?>
          <div class="col-12 col-md-6 col-lg-auto yearsofexperiences">
            <div class="cat-item dropdown">
              <a class="dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" data-bs-auto-close="outside"
                aria-expanded="false">
                <svg width="19" height="19" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                  <path d="M16 2V6" stroke="#FF551E" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                  <path d="M8 2V6" stroke="#FF551E" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                  <path d="M3 9H21" stroke="#FF551E" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                  <path fill-rule="evenodd" clip-rule="evenodd" d="M19 4H5C3.895 4 3 4.895 3 6V19C3 20.105 3.895 21 5 21H19C20.105 21 21 20.105 21 19V6C21 4.895 20.105 4 19 4Z" stroke="#FF551E" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                </svg><?php echo __('Years of experience', 'b2works'); ?>
              </a>


              <div class="dropdown-menu fade">
                <div class="container">
                  <div class="jobboardfilter">
                    <div class="header">
                      <h3 class="title"><?php echo __('Years of Experience', 'b2works'); ?></h3>
                      <button class="btn close-filter btn-close"><span class="icon">
                        
                      </span></button>
                    </div>
                    <div class="filter-scrolable-wrapper">
                      <ul class="filter-category yearsofexperience">
                        <?php 

                          if($yearsofexperiences) { $i= 0;
                            foreach($yearsofexperiences as $key => $value){?>
                            <li class="filter-item">
                              <label for="f<?php echo $i; ?>">
                                <div class="checkbox__input">
                                  <input id="f<?php echo $i; ?>" name="yearsofexperience" value="<?php echo $key; ?>" type="checkbox">
                                  <span class="checkbox__style" aria-hidden="true"> <span class="icon">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="currentColor"><path d="m10 15.586-3.293-3.293-1.414 1.414L10 18.414l9.707-9.707-1.414-1.414z"></path></svg>
                                  </span>
                                  </span>
                                </div>
                                <span class="checkbox__label"><?php echo $key; ?> <span class="filter__counter"
                                    data-for-filter="f<?php echo $i; ?>">(<?php echo $value; ?>)</span></span>
                              </label>
                            </li><?php 
                            $i++;}
                          }
                        ?>
                        
                      </ul>
                    </div>
                    <div class="form__container--summary">
                      <button class="btn btn-secondary close-filter v-search">
                        <?php echo __('Search Job', 'b2works'); ?>
                      </button>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <?php endif; ?>
          <div class="col-12 col-lg-auto ms-auto">
            <button class="clear-filter"><?php echo __('Clear filter', 'b2works'); ?></button>
          </div>
        </div>
        
      </div>
      
      
      <div class="mobile-filter d-lg-none">
        <div class="filter-mobile-btn">
          <a data-bs-toggle="offcanvas" href="#mobile-filter-btn" role="button" aria-controls="mobile-filter-btn"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-sliders" viewBox="0 0 16 16">
            <path fill-rule="evenodd" d="M11.5 2a1.5 1.5 0 1 0 0 3 1.5 1.5 0 0 0 0-3M9.05 3a2.5 2.5 0 0 1 4.9 0H16v1h-2.05a2.5 2.5 0 0 1-4.9 0H0V3zM4.5 7a1.5 1.5 0 1 0 0 3 1.5 1.5 0 0 0 0-3M2.05 8a2.5 2.5 0 0 1 4.9 0H16v1H6.95a2.5 2.5 0 0 1-4.9 0H0V8zm9.45 4a1.5 1.5 0 1 0 0 3 1.5 1.5 0 0 0 0-3m-2.45 1a2.5 2.5 0 0 1 4.9 0H16v1h-2.05a2.5 2.5 0 0 1-4.9 0H0v-1z"/>
          </svg> <?php echo __('Filter', 'b2works'); ?></a>
        </div>
        <div class="filter-content offcanvas offcanvas-top" tabindex="-1" id="mobile-filter-btn" aria-labelledby="offcanvasExampleLabel">
          <div class="offcanvas-header">
            <h5 class="offcanvas-title" id="offcanvasExampleLabel">Filter</h5>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
          </div>
          <div class="offcanvas-body">
            <div class="swiper swiper-container filter-tabs" id="nav-tab" role="tablist">
              <div class="swiper-wrapper">
                  <?php if($job_cats) : ?>
                  <button class="swiper-slide filter-tabs-item" id="filter-one-tab" data-bs-toggle="tab" data-bs-target="#filter-one" type="button" role="tab" aria-controls="filter-one" aria-selected="true">
                    <svg width="22" height="23" viewBox="0 0 22 23" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M3.66943 8.57679L3.94093 4.3996C3.94093 4.13011 4.21242 3.99536 4.48391 3.99536H6.65584C6.92734 3.99536 7.19883 4.13011 7.19883 4.3996L7.33457 8.57679" stroke="#F56537" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M18.4829 7.22289C18.4394 7.25404 18.4002 7.29093 18.3571 7.32253L16.0127 9.04141C15.9696 9.07302 15.9306 9.11055 15.8859 9.1398C15.5982 9.32786 15.1233 9.05935 15.1233 8.67032V7.5541C15.1233 7.16507 14.6484 6.89656 14.3606 7.08462C14.3159 7.11387 14.2769 7.1514 14.2338 7.18301L11.8894 8.90188C11.8463 8.93349 11.8073 8.97103 11.7626 9.00027C11.4749 9.18833 11 8.91982 11 8.53079V7.27505C11 6.85647 10.5877 6.57741 10.1753 6.85647L7.67703 8.50498C7.51359 8.61283 7.32209 8.67032 7.12628 8.67032H3.44063C3.0283 8.67032 2.75342 8.94937 2.75342 9.36795V17.0419C2.75342 17.4605 3.0283 17.7396 3.44063 17.7396H18.6968C18.9717 17.7396 19.2465 17.4605 19.2465 17.1815V7.5541C19.2465 7.16461 18.7705 7.01673 18.4829 7.22289Z" stroke="#F56537" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M11.9165 12.7003H12.8328" stroke="#F56537" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M15.5811 12.7003H16.4973" stroke="#F56537" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M11.9165 14.5328H12.8328" stroke="#F56537" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M15.5811 14.5328H16.4973" stroke="#F56537" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M4.58594 13.2422C4.58594 12.6899 5.03365 12.2422 5.58594 12.2422H8.16736C8.71965 12.2422 9.16736 12.6899 9.16736 13.2422V17.7399H4.58594V13.2422Z" stroke="#F56537" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                  </svg><?php echo __('Branches', 'b2works'); ?>
                  </button>               
                  <?php endif; ?>
                  <?php if($locations) : ?>
                  <button class="swiper-slide filter-tabs-item" id="filter-two-tab" data-bs-toggle="tab" data-bs-target="#filter-two" type="button" role="tab" aria-controls="filter-two" aria-selected="false">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none">
                      <path d="M7.5 11.8375C4.58917 12.2384 2.5 13.3142 2.5 14.5834C2.5 16.1942 5.8575 17.5 10 17.5C14.1425 17.5 17.5 16.1942 17.5 14.5834C17.5 13.3142 15.4108 12.2384 12.5 11.8375" stroke="#F56537" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                      <path d="M9.99967 14.1667V7.5" stroke="#F56537" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                      <path d="M11.7678 3.23223C12.7441 4.20854 12.7441 5.79146 11.7678 6.76776C10.7915 7.74407 9.20854 7.74407 8.23223 6.76776C7.25592 5.79146 7.25592 4.20854 8.23223 3.23223C9.20854 2.25592 10.7915 2.25592 11.7678 3.23223" stroke="#F56537" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg><?php echo __('Location', 'b2works'); ?>
                  </button>                 
                  <?php endif; ?>
                  <?php if($accomodation) : ?>
                  <!-- <button class="swiper-slide filter-tabs-item" id="filter-five-tab" data-bs-toggle="tab" data-bs-target="#filter-five" type="button" role="tab" aria-controls="filter-five" aria-selected="false">
                      <svg xmlns="http://www.w3.org/2000/svg" width="19" height="19" viewBox="0 0 19 19" fill="none">
                        <path d="M3.5 6.58423V15.8842H15.5V6.58423" stroke="#FF551E" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                        <path d="M2 7.63428L9.5 2.38428L17 7.63428" stroke="#FF551E" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                        <path d="M11.75 15.8843V11.3843C11.75 10.5555 11.0788 9.88428 10.25 9.88428H8.75C7.92125 9.88428 7.25 10.5555 7.25 11.3843V15.8843" stroke="#FF551E" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                      </svg><?php echo __('Accomodation', 'b2works'); ?>
                  </button> -->
                  <?php endif; ?>

                  <?php if($hourlyrates) : ?>
                  <button class="swiper-slide filter-tabs-item" id="filter-six-tab" data-bs-toggle="tab" data-bs-target="#filter-six" type="button" role="tab" aria-controls="filter-six" aria-selected="false">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none">
                      <path d="M15.2881 4.59614C18.0706 7.37863 18.0706 11.8899 15.2881 14.6724C12.5056 17.4549 7.99434 17.4549 5.21187 14.6724C2.42938 11.8899 2.42938 7.37861 5.21187 4.59614C7.99435 1.81366 12.5056 1.81366 15.2881 4.59614" stroke="#FE6330" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                      <path d="M13.0495 12.4335C11.5033 13.9796 8.99771 13.9796 7.45159 12.4335C5.90546 10.8874 5.90546 8.38174 7.45159 6.83562C8.99771 5.28949 11.5033 5.28949 13.0495 6.83562" stroke="#FE6330" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                      <path d="M10.25 8.54183H5.5" stroke="#FE6330" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                      <path d="M10.25 10.7269H5.5" stroke="#FE6330" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                    </svg><?php echo __('Hourly rate', 'b2works'); ?>
                  </button>
                  <?php endif; ?>

                  <?php if($yearsofexperiences) : ?>
                  <button class="swiper-slide filter-tabs-item" id="filter-seven-tab" data-bs-toggle="tab" data-bs-target="#filter-seven" type="button" role="tab" aria-controls="filter-seven" aria-selected="false">
                    <svg width="19" height="19" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                      <path d="M16 2V6" stroke="#FF551E" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                      <path d="M8 2V6" stroke="#FF551E" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                      <path d="M3 9H21" stroke="#FF551E" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                      <path fill-rule="evenodd" clip-rule="evenodd" d="M19 4H5C3.895 4 3 4.895 3 6V19C3 20.105 3.895 21 5 21H19C20.105 21 21 20.105 21 19V6C21 4.895 20.105 4 19 4Z" stroke="#FF551E" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg><?php echo __('Years of experience', 'b2works'); ?>
                  </button>
                  <?php endif; ?>
                
              </div>
            </div>
            
            
            <div class="tab-content" id="nav-tabContent">
              <?php if($education) : ?>
              <div class="tab-pane fade show active" id="filter-one" role="tabpanel" aria-labelledby="filter-one-tab" tabindex="0">
                <div class="jobboardfilter">
                  <div class="header">

                  </div>
                  <div class="filter-scrolable-wrapper">
                    <ul class="filter-category">
                        <?php 

                        if($job_cats) { $i= 0;
                          foreach($job_cats as $item){
                            $term_id = $item->term_id;
                            $term_slug = $item->slug;
                            $term_name = $item->name;
                            
                            $post_count = get_term($term_id, $taxonomy)->count;

?>
                          <li class="filter-item">
                            <label for="a<?php echo $i; ?>">
                              <div class="checkbox__input">
                                <input id="a<?php echo $i; ?>" name="branches" value="<?php echo $term_id; ?>" type="checkbox">
                                <span class="checkbox__style" aria-hidden="true"> <span class="icon">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="currentColor"><path d="m10 15.586-3.293-3.293-1.414 1.414L10 18.414l9.707-9.707-1.414-1.414z"></path></svg>
                                  </span>
                                </span>
                              </div>
                              <span class="checkbox__label"><?php echo $term_name; ?> <span class="filter__counter"
                                  data-for-filter="a<?php echo $i; ?>">(<?php echo $post_count; ?>)</span></span>
                            </label>
                          </li><?php 
                          $i++;}
                        }
                        ?>
                    </ul>
                  </div>
                  
                </div>
              </div>
              <?php endif; ?>

              <?php if($locations) : ?>
              <div class="tab-pane fade" id="filter-two" role="tabpanel" aria-labelledby="filter-two-tab" tabindex="0">
                <div class="jobboardfilter">
                  <div class="header">
                    

                  </div>
                  <div class="filter-scrolable-wrapper">
                    <ul class="filter-category">  
                      <?php 

                        if($locations) { $i= 0;
                          foreach($locations as $key => $value){?>
                          <li class="filter-item">
                            <label for="b<?php echo $i; ?>">
                              <div class="checkbox__input">
                                <input id="b<?php echo $i; ?>" name="location" value="<?php echo $key; ?>" type="checkbox">
                                <span class="checkbox__style" aria-hidden="true"> <span class="icon">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="currentColor"><path d="m10 15.586-3.293-3.293-1.414 1.414L10 18.414l9.707-9.707-1.414-1.414z"></path></svg>
                                  </span>
                                </span>
                              </div>
                              <span class="checkbox__label"><?php echo $key; ?> <span class="filter__counter"
                                  data-for-filter="b<?php echo $i; ?>">(<?php echo $value; ?>)</span></span>
                            </label>
                          </li><?php 
                          $i++;}
                        }
                      ?>
                    </ul>
                  </div>
                  
                </div>
              </div>
              <?php endif; ?>

              

              <?php if($accomodation) : ?>
              <div class="tab-pane fade" id="filter-five" role="tabpanel" aria-labelledby="filter-five-tab" tabindex="0">
                <div class="jobboardfilter">
                  <div class="header">
                    

                  </div>
                  <div class="filter-scrolable-wrapper">
                    <ul class="filter-category">
                    <?php 

                        if($accomodation) { $i= 0;
                          foreach($accomodation as $item){?>
                          <li class="filter-item">
                            <label for="e<?php echo $i; ?>">
                              <div class="checkbox__input">
                                <input id="e<?php echo $i; ?>" name="accomodation" value="<?php echo $item; ?>" type="checkbox">
                                <span class="checkbox__style" aria-hidden="true"> <span class="icon">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="currentColor"><path d="m10 15.586-3.293-3.293-1.414 1.414L10 18.414l9.707-9.707-1.414-1.414z"></path></svg>
                                  </span>
                                </span>
                              </div>
                              <span class="checkbox__label"><?php echo $item; ?> <span class="filter__counter"
                                  data-for-filter="e<?php echo $i; ?>"></span></span>
                            </label>
                          </li><?php 
                          $i++;}
                        }
                      ?>
                    </ul>
                  </div>
                  
                </div>
              </div>
              <?php endif; ?>

              <?php if($hourlyrates) : ?>
              <div class="tab-pane fade" id="filter-six" role="tabpanel" aria-labelledby="filter-six-tab" tabindex="0">
                <div class="jobboardfilter">
                  <div class="header">
                    

                  </div>
                  <div class="filter-scrolable-wrapper">
                    <ul class="filter-category">
                    <?php 

                        if($hourlyrates) { $i= 0;
                          foreach($hourlyrates as $key => $value){?>
                          <li class="filter-item">
                            <label for="f<?php echo $i; ?>">
                              <div class="checkbox__input">
                                <input id="f<?php echo $i; ?>" name="hourlyrate" value="<?php echo $key; ?>" type="checkbox">
                                <span class="checkbox__style" aria-hidden="true"> <span class="icon">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="currentColor"><path d="m10 15.586-3.293-3.293-1.414 1.414L10 18.414l9.707-9.707-1.414-1.414z"></path></svg>
                                  </span>
                                </span>
                              </div>
                              <span class="checkbox__label"><?php echo $key; ?> <span class="filter__counter"
                                  data-for-filter="f<?php echo $i; ?>">(<?php echo $value; ?>)</span></span>
                            </label>
                          </li><?php 
                          $i++;}
                        }
                      ?>
                    </ul>
                  </div>
                  
                </div>
              </div>
              <?php endif; ?>

              <?php if($yearsofexperiences) : ?>
              <div class="tab-pane fade" id="filter-seven" role="tabpanel" aria-labelledby="filter-seven-tab" tabindex="0">
                <div class="jobboardfilter">
                  <div class="header">
                    

                  </div>
                  <div class="filter-scrolable-wrapper">
                    <ul class="filter-category">
                    <?php 

                        if($yearsofexperiences) { $i= 0;
                          foreach($yearsofexperiences as $key => $value){?>
                          <li class="filter-item">
                            <label for="g<?php echo $i; ?>">
                              <div class="checkbox__input">
                                <input id="g<?php echo $i; ?>" name="yearsofexperience" value="<?php echo $key; ?>" type="checkbox">
                                <span class="checkbox__style" aria-hidden="true"> <span class="icon">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="currentColor"><path d="m10 15.586-3.293-3.293-1.414 1.414L10 18.414l9.707-9.707-1.414-1.414z"></path></svg>
                                  </span>
                                </span>
                              </div>
                              <span class="checkbox__label"><?php echo $key; ?> <span class="filter__counter"
                                  data-for-filter="g<?php echo $i; ?>">(<?php echo $value; ?>)</span></span>
                            </label>
                          </li><?php 
                          $i++;}
                        }
                      ?>
                    </ul>
                  </div>
                  
                </div>
              </div>
              <?php endif; ?>
            </div>
          </div>
          <div class="offcanvas-footer">            
            <button type="button" class="btn btn-secondary v-search" data-bs-dismiss="offcanvas" aria-label="Close"><?php echo __('Search', 'b2works'); ?></button>
            <button class="clear-filter"><?php echo __('Clear filter', 'b2works'); ?></button>
          </div>
        </div>
      </div>
    </div>

<?php } ?>




    <div class="container">

      <div class="row vacancies-card-holder" data-aos="fade-up">

      <?php
          if (isset($_GET['favorites']) && $_GET['favorites'] === '1') {

            if (isset($_GET['job_ids']) && $_GET['job_ids'] != '[]') {

                $jobIds = json_decode($_GET['job_ids'], true);
                $args = array(
                    'post_type' => 'vacancies',
                    'post__in' => $jobIds,
                    'orderby' => 'post__in',
                    'posts_per_page' => $posts_per_page,
                );
                
                $query = new WP_Query($args);
        
                if ($query->have_posts()) :
                  while ($query->have_posts()) : $query->the_post();
                    get_template_part('template-parts/content', 'jobs'); 
                  endwhile; 
                endif; 

            }else {
              echo '<div class="no-jobs">No favorite items found!</div>';
            }


          }elseif(isset($_GET['search']) || isset($_GET['cat'])){

            if ($query->have_posts()) :
              while ($query->have_posts()) : $query->the_post();
                get_template_part('template-parts/content', 'jobs'); 
              endwhile; 
            else:
              echo '<div class="no-jobs">No favorite items found!</div>';
            endif;


          }else {
              if (have_posts()) { 
                while (have_posts()){ the_post(); 
                  get_template_part('template-parts/content', 'jobs');   

                }
              }
          } 
          
          ?>
        
      </div>
      
    </div>
  </section>

  <div class="modal fade" id="takeJobModal" tabindex="-1" aria-labelledby="#takeJobModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-fullscreen-lg-down">
      <div class="modal-content">
        <div class="modal-header px-lg-5 pt-lg-5">
          <h1 class="modal-title fs-5" id="#takeJobModalLabel"><?php echo __('Apply for the job', 'b2works'); ?></h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body p-lg-5">
          <div class="contact-right">

          <form class="row g-3 g-lg-4" id="application-form"  data-url="<?php echo admin_url('admin-ajax.php'); ?>">
            <!-- <div class="col-md-6">
              <label for="gender" class="form-label">Gender</label>
              <select class="form-select" aria-label="Default select example" name="gender" id="gender">
                <option selected>Select your gender</option>
                <option value="Male">Male</option>
                <option value="Female">Female</option>
                <option value="Neutral">Neutral</option>
              </select>
            </div> -->

            <div class="col-md-6">
              <label for="firstname" class="form-label"><?php echo __('First name', 'b2works');?> <span>(<?php echo __('Required', 'b2works');?>)</span></label>
              <input type="text" class="form-control" id="firstname" name="firstname" placeholder="" required>
            </div>

            <div class="col-md-6">
              <label for="lastname" class="form-label"><?php echo __('Last name', 'b2works');?> <span>(<?php echo __('Required', 'b2works');?>)</span></label>
              <input type="text" class="form-control" id="lastname" placeholder="" name="lastname" required>
            </div>
            <div class="col-md-6">
              <label for="lastname" class="form-label"><?php echo __('Date of birth', 'b2works');?> <span>(<?php echo __('Required', 'b2works');?>)</span></label>
              <input type="text" class="form-control datepicker" id="dateOfBirth" placeholder="" name="dateOfBirth" required maxlength="10" data-valid="false">
            </div>

            <!-- <div class="col-md-6">
              <label for="dob" class="form-label">Date of birth <span>(Required)</span></label>
              <input type="text" class="form-control datepicker" id="dob" name="dob" placeholder="Date of birth" required>
            </div> -->

            <div class="col-md-6">
              <label for="phone" class="form-label"><?php echo __('Phone', 'b2works');?> <span>(<?php echo __('Required', 'b2works');?>)</span></label>
              <input type="text" class="form-control" id="phone" name="phone" placeholder="" required>
            </div>

            <div class="col-md-6">
              <label for="email" class="form-label"><?php echo __('E-mail address', 'b2works');?> <span>(<?php echo __('Required', 'b2works');?>)</span></label>
              <input type="email" class="form-control" id="email" name="email" placeholder="" required>
            </div>

            <!-- Additional Address Fields -->

            <!-- <div class="col-md-6">
              <label for="place" class="form-label">Place <span>(Required)</span></label>
              <input type="text" class="form-control" id="place" name="place" placeholder="Place" required>
            </div> -->

            <!-- Additional Address Fields -->

            <!-- <div class="col-md-6">
              <label for="availFrom" class="form-label">Available from</label>
              <input type="text" class="form-control datepicker" id="availFrom" name="availFrom" placeholder="Available from">
            </div>

            <div class="col-md-6">
              <label for="availTo" class="form-label">Available to</label>
              <input type="text" class="form-control datepicker" id="availTo" name="availTo" placeholder="Available to">
            </div> -->

            <div class="col-md-6">
              <label for="availTo" class="form-label"><?php echo __('Current postion', 'b2works');?></label>
              <input type="text" class="form-control" id="currentPosition" name="currentPosition" placeholder="">
            </div>

            <div class="col-md-6">
              <label for="availTo" class="form-label"><?php echo __('Current employer', 'b2works');?></label>
              <input type="text" class="form-control" id="currentEmployer" name="currentEmployer" placeholder="">
            </div>

            <!-- <div class="col-md-6">
              <label for="availTo" class="form-label"><?php echo __('Skype', 'b2works');?></label>
              <input type="text" class="form-control" id="skype" name="skype" placeholder="">
            </div>
            <div class="col-md-6">
              <label for="availTo" class="form-label"><?php echo __('LinkedIn', 'b2works');?></label>
              <input type="text" class="form-control" id="linkedIn" name="linkedin" placeholder="">
            </div>
            <div class="col-md-6">
              <label for="availTo" class="form-label"><?php echo __('Facebook', 'b2works');?></label>
              <input type="text" class="form-control" id="facebook" name="facebook" placeholder="">
            </div>
            <div class="col-md-6">
              <label for="availTo" class="form-label"><?php echo __('Instagram', 'b2works');?></label>
              <input type="text" class="form-control" id="instagram" name="instagram" placeholder="">
            </div>
            <div class="col-md-6">
              <label for="availTo" class="form-label"><?php echo __('Twitter', 'b2works');?></label>
              <input type="text" class="form-control" id="twitter" name="twitter" placeholder="">
            </div>
            <div class="col-md-6">
              <label for="availTo" class="form-label"><?php echo __('Website', 'b2works');?></label>
              <input type="text" class="form-control" id="website" name="website" placeholder="">
            </div>
            <div class="col-md-6">
              <label for="availTo" class="form-label"><?php echo __('Blog', 'b2works');?></label>
              <input type="text" class="form-control" id="blog" name="blog" placeholder="">
            </div> -->


            <!-- <div class="col-md-6">
              <label class="form-label">Do you speak English</label>
              <select class="form-select" aria-label="Default select example" name="speakEnglish">
                <option selected>Select a language</option>
                <option value="Yes">Yes</option>
                <option value="No">No</option>
              </select>
            </div>
            <div class="col-md-6">
              <label class="form-label">Do you have a driving license?</label>
              <div class="input-group">
                <select class="form-select" aria-label="Default select example" name="drivingLicense">
                  <option selected>Select an option</option>
                  <option value="Yes">Yes</option>
                  <option value="No">No</option>
                </select>
              </div>
            </div>

            <div class="col-md-6">
              <label class="form-label">Have you worked in the Netherlands before?</label>
              <div class="input-group">
                <select class="form-select" aria-label="Default select example" name="workedInNetherlands">
                  <option selected>Select an option</option>
                  <option value="Yes">Yes</option>
                  <option value="No">No</option>
                </select>
              </div>
            </div>

            <div class="col-md-6">
              <label class="form-label">Are you currently staying in the Netherlands?</label>
              <div class="input-group">
                <select class="form-select" aria-label="Default select example" name="stayingInNetherlands">
                  <option selected>Select an option</option>
                  <option value="Yes">Yes</option>
                  <option value="No">No</option>
                </select>
              </div>
            </div>

            <div class="col-md-6">
              <label class="form-label">Do you have your own accommodation, or do you need accommodation from B2Works?</label>
              <div class="input-group">
                <select class="form-select" aria-label="Default select example" name="accommodation">
                  <option selected>Select an option</option>
                  <option value="Own">Own</option>
                  <option value="B2Works">B2Works</option>
                </select>
              </div>
            </div>

            <div class="col-md-6">
              <label class="form-label">Do you have one year or more of proven experience with the activities described in the vacancy?</label>
              <div class="input-group">
                <select class="form-select" aria-label="Default select example" name="provenExperience">
                  <option selected>Select an option</option>
                  <option value="Yes">Yes</option>
                  <option value="No">No</option>
                </select>
              </div>
            </div> -->

            

            <!-- Add more Yes/No fields as needed -->

            <div class="col-12">
              <label for="textArea" class="form-label"><?php echo __('Motivation', 'b2works'); ?></label>
              <textarea class="form-control" id="textArea" rows="5" name="motivation" placeholder=""></textarea>
            </div>

            <div class="col-12">
              <div class='file-input'>
                <input type='file' name="resume" id="resume">
                <span class='label uploadlabel' data-js-label><img src="<?php echo get_template_directory_uri(); ?>/assets/images/icons/i-upload.svg" alt="i-upload"> <?php echo __('Upload CV', 'b2works'); ?></span>
                <span class='btn btn-secondary'><?php echo __('Select', 'b2works'); ?></span>
              </div>
              <span><?php echo __('Select a resume .pdf of .doc file max 5mb', 'b2works'); ?></span>
            </div>

            <!-- <div class="col-6">
              <div class='file-input'>
                <input type='file' name="cover" id="cover">
                <span class='label uploadlabel' data-js-label><img src="<?php echo get_template_directory_uri(); ?>/assets/images/icons/i-upload.svg" alt="i-upload"> Upload Cover</span>
                <span class='btn btn-secondary'>Select</span>
              </div>
              <span><?php echo __('Slect a cover letter pdf or doc file max 5 MB', 'b2works'); ?></span>
            </div> -->

            <!-- <div class="col-6">
              <div class='file-input'>
                <input type='file' name="photo" id="photo">
                <span class='label uploadlabel' data-js-label><img src="<?php echo get_template_directory_uri(); ?>/assets/images/icons/i-upload.svg" alt="i-upload"> Upload Photo</span>
                <span class='btn btn-secondary'>Select</span>
              </div>
              <span><?php echo __('Select a photo jpg, jpeg or png file max 1 MB', 'b2works'); ?></span>
            </div> -->

            <div class="col-lg-9">
              <div class="form-check">
                <input class="form-check-input" type="checkbox" id="gridCheck" name="gridCheck" required>
                <label class="ms-3 form-check-label" for="gridCheck">
                <?php echo __('By sending this contact form you give us permission to process your (personal) data. We handle your personal data carefully.', 'b2works'); ?>
                </label>
              </div>
            </div>

            <input type="hidden" id="honeypot" name="honeypot" value="">
            <input type="hidden" id="honeypot" name="<?php echo __('Apply now', 'b2works'); ?>" value="">

            <div class="col-12 mt-5">
              <button type="submit" class="btn btn-secondary submit-btn"><?php echo __('Send', 'b2works'); ?></button>
              <div class="loader btn-secondary send-loader"></div>
            </div>
          </form>

          </div>
        </div>
        
      </div>
    </div>
  </div>

<?php get_footer();  ?>



<div class="filter_animation">
  <img src="<?php echo get_template_directory_uri(); ?>/assets/images/fade-stagger-circles.svg" alt="Animation">
</div>

<div href="#" class="v-floating-btn" >
    <p class="d-none d-lg-block"><?php echo __("<strong>Haven't found anything that suits you?</strong> <br>Apply anyway and we will try to find something for you!", "b2works");?></p>
    <a href="#" class="btn btn-secondary apply-btn takeJobModal" data-bs-toggle="modal" data-bs-target="#takeJobModal"><?php echo __('Apply Now', 'b2works');?></a>
</div>


<style>
.v-floating-btn {
    position: fixed;
    bottom: 1.5%;
    right: 1%;
    background-color: #F36030;
    color: #fff;
    align-items: center;
    gap: 17px;
    border-radius: 6px;
    line-height: 1.2;
    padding: .7rem 1rem;
    max-width: 310px;
    z-index: 9999;
}

.v-floating-btn p {
    color: #fff;
    font-size: 13px;
    /* text-align: right; */
    margin-bottom: 12px;
}
.v-floating-btn p strong {
    font-weight: 600;
    font-size: 15px;
    margin-bottom: 7px;
    display: inline-block;
}
.v-floating-btn .apply-btn {
    font-size: 13px;
    display: block;
}

@media(max-width:991.98px){

  .v-floating-btn {
    bottom: 7.5%;
    padding: 0.7rem;
    background-color: transparent;
}


}
</style>
