<!DOCTYPE html>
  <html <?php language_attributes(); ?> class="page-id-<?php the_ID(); ?>">

  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php wp_head(); ?>
    <?php 
    
      $favicon = get_field('favicon', 'option'); 
      if($favicon) echo '<link rel="shortcut icon" type="image/jpg" href="'.esc_url($favicon).'"/>';
    ?>
    

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://unpkg.com/@rive-app/canvas@2.7.0"></script>

    <link href="https://fonts.googleapis.com/css2?family=Inter&family=Sora:wght@400;600&display=swap" rel="stylesheet">
    <!-- swiper slider css -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/magnific-popup.min.css">
    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.1/dist/sweetalert2.min.css">
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

    <?php if(is_page_template('templates/contact.php')): ?>
    <link href="https://api.mapbox.com/mapbox-gl-js/v3.0.0/mapbox-gl.css" rel="stylesheet">
    <script src="https://api.mapbox.com/mapbox-gl-js/v3.0.0/mapbox-gl.js"></script>
    <?php endif; ?>

    <link rel="stylesheet" href="<?php echo get_template_directory_uri() ?>/assets/css/style.css">
    <link rel="stylesheet" href="<?php echo get_template_directory_uri() ?>/assets/css/custom.css">
    <script>
      // Global variables
      let sitelang = "<?php echo ICL_LANGUAGE_CODE; ?>";
    </script>
  </head>

  <body>
    <header>
      <div class="header-top d-none d-xl-block">
        <div class="container d-flex align-items-center justify-content-between">
          <div class="top-left">
          <?php
            $google_review = get_field('google_review', 'option');

            if ($google_review) { 
                $rating = $google_review['rating'];
                $number_of_reviews = $google_review['number_of_reviews'];
                $google_review_link = $google_review['google_review_link'];
                ?>

                <div class="middle d-flex">
                    <div>
                        <?php
                        for ($i = 1; $i <= 5; $i++) {
                            if ($i <= $rating) {
                                echo '<svg xmlns="http://www.w3.org/2000/svg" width="17" height="17" viewBox="0 0 17 17" fill="none">
                                        <path fill-rule="evenodd" clip-rule="evenodd" d="M5.09498 14.3571C4.81877 14.5053 4.48227 14.4831 4.2279 14.2999C3.97353 14.1168 3.84576 13.8047 3.89865 13.4958L4.49203 10.062L1.97905 7.62896C1.75696 7.41054 1.67772 7.08518 1.77453 6.78911C1.87134 6.49304 2.12748 6.27734 2.43571 6.23232L5.90986 5.73123L7.46167 2.60436C7.60186 2.32432 7.88818 2.14746 8.20135 2.14746C8.51452 2.14746 8.80083 2.32432 8.94102 2.60436L10.4928 5.73123L13.967 6.23232C14.2752 6.27734 14.5314 6.49304 14.6282 6.78911C14.725 7.08518 14.6457 7.41054 14.4236 7.62896L11.9093 10.0606L12.5027 13.4944C12.5562 13.8036 12.4287 14.1162 12.1742 14.2997C11.9197 14.4833 11.5828 14.5055 11.3063 14.3571L8.19998 12.7376L5.09498 14.3571Z" fill="#FF551E" stroke="#FE6330" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                      </svg>';
                            } else {
                                echo '<svg xmlns="http://www.w3.org/2000/svg" width="17" height="17" viewBox="0 0 17 17" fill="none">
                                        <path fill-rule="evenodd" clip-rule="evenodd" d="M5.69508 14.3571C5.41887 14.5053 5.08237 14.4831 4.828 14.2999C4.57363 14.1168 4.44585 13.8047 4.49875 13.4958L5.09213 10.062L2.57915 7.62896C2.35705 7.41054 2.27782 7.08518 2.37463 6.78911C2.47144 6.49304 2.72758 6.27734 3.03581 6.23232L6.50996 5.73123L8.06177 2.60436C8.20196 2.32432 8.48827 2.14746 8.80144 2.14746C9.11461 2.14746 9.40093 2.32432 9.54112 2.60436L11.0929 5.73123L14.5671 6.23232C14.8753 6.27734 15.1314 6.49304 15.2283 6.78911C15.3251 7.08518 15.2458 7.41054 15.0237 7.62896L12.5094 10.0606L13.1028 13.4944C13.1563 13.8036 13.0288 14.1162 12.7743 14.2997C12.5198 14.4833 12.1829 14.5055 11.9064 14.3571L8.80008 12.7376L5.69508 14.3571Z" stroke="#FE6330" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                      </svg>';
                            }
                        }
                        ?>
                    </div>
                    <div>
                        <div><?php echo str_replace('.', ',', $rating) ?>/5</div>
                    </div>
                    <div>
                        <a href="<?php echo $google_review_link; ?>" target="_blank"> <?php echo $number_of_reviews; ?> google reviews</a>
                    </div>
                </div>
            <?php } ?>

          
          </div>
          <div class="top-middle">
          <form role="search" method="get" class="search-form" action="<?php echo esc_url(home_url('/')); ?>">
              <input type="hidden" name="lang" value="<?php echo ICL_LANGUAGE_CODE; ?>">
              <input type="search" class="form-control" placeholder="<?php echo __('Search', 'donbosco'); ?>" value="<?php echo get_search_query(); ?>" name="s" />
              <button type="submit">
                  <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 12 12" fill="none">
                      <path d="M11 11L7.66667 7.66667M8.77778 4.88889C8.77778 5.39959 8.67719 5.90528 8.48175 6.3771C8.28632 6.84892 7.99987 7.27763 7.63875 7.63875C7.27763 7.99987 6.84892 8.28632 6.3771 8.48175C5.90528 8.67719 5.39959 8.77778 4.88889 8.77778C4.37819 8.77778 3.8725 8.67719 3.40068 8.48175C2.92885 8.28632 2.50015 7.99987 2.13903 7.63875C1.77791 7.27763 1.49146 6.84892 1.29602 6.3771C1.10059 5.90528 1 5.39959 1 4.88889C1 3.85749 1.40972 2.86834 2.13903 2.13903C2.86834 1.40972 3.85749 1 4.88889 1C5.92029 1 6.90944 1.40972 7.63875 2.13903C8.36806 2.86834 8.77778 3.85749 8.77778 4.88889Z" stroke="#5F5B57" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                  </svg>
              </button>
          </form>

          </div>
          

          <?php
            // Get the social media links repeater field
            $social_media_links = get_field('social_media_links', 'option');

            // Check if social media links exist
            if ($social_media_links) :
            ?>
                <ul class="b2-social-media">
                    <?php foreach ($social_media_links as $social_media_link) : ?>
                        <?php
                        // Get social media icon details
                        $icon = $social_media_link['social_media_details']['social_media_icon'];
                        $url = $social_media_link['social_media_details']['url'];

                        // Check if both icon and URL are provided
                        if ($icon && $url) :
                        ?>
                            <li>
                                <a href="<?php echo esc_url($url); ?>" target="_blank">
                                    <img src="<?php echo esc_url($icon['url']); ?>" alt="<?php echo esc_attr($icon['alt']); ?>">
                                </a>
                            </li>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </ul>
            <?php endif; ?>



        </div>
      </div>
      <div class="header-bottom">
        <nav class="navbar b2-navbar navbar-expand-xl">
          <div class="container">
            <?php $current_language = apply_filters('wpml_current_language', NULL);   ?>
            <a class="navbar-brand" href="<?php echo site_url(); ?>?lang=<?php echo $current_language; ?>"><canvas id="main-logo" width="132" height="44"></canvas></a>
            <div class="d-xl-none d-flex align-items-center gap-3">
              <a href="#" class="fav-nav">
                <span class="total-fav-items total-fav-mobile">0</span>
                <svg xmlns="http://www.w3.org/2000/svg" width="21" height="18" viewBox="0 0 21 18" fill="none">
                <path fill-rule="evenodd" clip-rule="evenodd" d="M10.5 2.71111C11.2272 1.90489 12.4854 1 14.4013 1C17.7519 1 20 3.97956 20 6.75467C20 12.5556 12.3765 17 10.5 17C8.62346 17 1 12.5556 1 6.75467C1 3.97956 3.2481 1 6.59867 1C8.51462 1 9.77284 1.90489 10.5 2.71111Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
              </svg></a>
              <?php
                  $loginButton = get_field('login_button', 'option');
                ?>
                <?php if ($loginButton) { ?>
                  <a href="<?php echo esc_url($loginButton['url']); ?>" target="<?php echo esc_url($loginButton['url']); ?>" class="login-nav"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                    <path d="M14.4749 4.52513C15.8417 5.89197 15.8417 8.10804 14.4749 9.47488C13.108 10.8417 10.892 10.8417 9.52513 9.47488C8.15829 8.10804 8.15829 5.89197 9.52513 4.52513C10.892 3.15829 13.108 3.15829 14.4749 4.52513" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                    <path fill-rule="evenodd" clip-rule="evenodd" d="M4 18.5001V19.5001C4 20.0521 4.448 20.5001 5 20.5001H19C19.552 20.5001 20 20.0521 20 19.5001V18.5001C20 15.4741 16.048 13.5081 12 13.5081C7.952 13.5081 4 15.4741 4 18.5001Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                  </svg></a>
                <?php } ?>
              <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" 
            data-bs-target="#main-nav"
            aria-controls="main-nav"
            aria-expanded="false" aria-label="Toggle navigation">
              <span></span>
              <span></span>
              <span></span>
            </button>
            </div>
            <div class="offcanvas offcanvas-top" id="main-nav"
            tabindex="-1" aria-labelledby="offcanvasNavbarLabel">
            <div class="container px-0">
              <div class="offcanvas-header">
                <a class="navbar-brand" href="<?php echo site_url(); ?>"><img src="<?php echo get_template_directory_uri() ?>/assets/images/main-logo.svg" alt=""></a>
                <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
              </div>
              <div class="offcanvas-body">
                

                <ul class="navbar-nav me-auto mb-2 mb-xl-0 ms-xl-4">
                  <?php

                  if( ! wp_is_mobile() ){

                    wp_nav_menu(array(
                        'theme_location' => 'mainmenu',
                        'menu_id'        => 'menu-main-menu',
                        'menu_class'     => 'navbar-nav',
                        'container'      => false,
                        'items_wrap'     => '%3$s', 
                        'walker'         => new Custom_Walker_Nav_Menu(),
                    ));

                  } else {

                    wp_nav_menu(array(
                      'theme_location' => 'mobile_menu',
                      'menu_id'        => 'menu-main-menu',
                      'menu_class'     => 'navbar-nav',
                      'container'      => false,
                      'items_wrap'     => '%3$s', 
                      'walker'         => new Custom_Walker_Nav_Menu(),
                    ));
                  }

                  
                  ?>
                </ul>


                <div class="nav-end"> 
                  <a href="#" class="favorites d-none d-xl-flex">
                    <span class="total-fav-items">0</span>
                    <svg xmlns="http://www.w3.org/2000/svg" width="21" height="18"
                      viewBox="0 0 21 18" fill="none">
                      <path fill-rule="evenodd" clip-rule="evenodd"
                        d="M10.5 2.71111C11.2272 1.90489 12.4854 1 14.4013 1C17.7519 1 20 3.97956 20 6.75467C20 12.5556 12.3765 17 10.5 17C8.62346 17 1 12.5556 1 6.75467C1 3.97956 3.2481 1 6.59867 1C8.51462 1 9.77284 1.90489 10.5 2.71111Z"
                        stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                    </svg><?php echo __('Favorites', 'donbosco'); ?></a>

                    <?php
                      $loginButton = get_field('login_button', 'option');
                      if ($loginButton) {
                          echo '<a href="' . esc_url($loginButton['url']) . '" target="' . esc_attr($loginButton['target']) . '" class="login d-none d-xl-flex">
                                  <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                      <path d="M14.4749 4.52513C15.8417 5.89197 15.8417 8.10804 14.4749 9.47488C13.108 10.8417 10.892 10.892 9.52513 9.47488C8.15829 8.10804 8.15829 5.89197 9.52513 4.52513C10.892 3.15829 13.108 3.15829 14.4749 4.52513" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                      <path fill-rule="evenodd" clip-rule="evenodd" d="M4 18.5001V19.5001C4 20.0521 4.448 20.5001 5 20.5001H19C19.552 20.5001 20 20.0521 20 19.5001V18.5001C20 15.4741 16.048 13.5081 12 13.5081C7.952 13.5081 4 15.4741 4 18.5001Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                  </svg> ' . esc_html($loginButton['title']) . '</a>';
                      }
                    ?>

                  
                  <div class="lang-selector dropdown-center">
                      <?php
                      // Get the current language code
                      $current_language_code = ICL_LANGUAGE_CODE;
                      $language_names = array(
                          'nl' => 'NL',
                          'en' => 'EN',
                      );

                      $flags = [
                          'nl' => '<img src="'.get_template_directory_uri().'/assets/images/nl.svg" alt="Netherland Flag">',
                          'en' => '<img src="'.get_template_directory_uri().'/assets/images/en.svg" alt="English Flag">'
                      ];

                      $current_language_name = isset($language_names[$current_language_code]) ? $language_names[$current_language_code] : '';

                      

                      // Output the language selector button
                      ?>
                      <button class="btn btn-secondary dropdown-toggle rounded-pill" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                          <?php echo esc_html($current_language_name); ?>
                      </button>
                      <ul class="dropdown-menu language-switch">
                          <?php
                            // foreach ($language_names as $lang_code => $lang_name) {
                            //     $lang_url = site_url(ICL_LANGUAGE_CODE == 'en' ? remove_query_arg('lang') : add_query_arg('lang', $lang_code));

                            //     echo '<li><a class="dropdown-item" href="' . esc_url($lang_url) . '" data-lang="' . esc_attr($lang_code) . '">' .strtolower($flags[$lang_code]). esc_html($lang_name) . '</a></li>';
                            // }

                            foreach ($language_names as $lang_code => $lang_name) {
                                $lang_url = site_url(ICL_LANGUAGE_CODE == $lang_code ? remove_query_arg('lang') : add_query_arg('lang', $lang_code));
                                echo '<li><a class="dropdown-item" href="' . esc_url($lang_url) . '" data-lang="' . esc_attr($lang_code) . '">' .strtolower($flags[$lang_code]). esc_html($lang_name) . '</a></li>';
                            }
                          ?>
                      </ul>
                  </div>

                  <?php // dd( $current_language_code );?>


                </div>
              </div>
            </div>
            </div>
          </div>
        </nav>
      </div>
    </header>

    <?php
      if (!is_front_page() && !is_home() && !is_404() && !is_single() && !is_page_template('templates/contact.php') && !is_page_template('templates/news.php') && !is_page_template('templates/home.php')) :
          ?>
          <div class="b2-page-banner">
              <div class="shape-7 d-none d-md-block"><img src="<?php echo get_template_directory_uri(); ?>/assets/images/icons/shape-7.svg" alt=""></div>
              <div class="shape-6 d-none d-md-block"><img src="<?php echo get_template_directory_uri(); ?>/assets/images/icons/shape-6.svg" alt=""></div>

              <?php 
                $page_banner = get_field('page_banner');
                $default_banner = get_field('default_page_banner', 'option');
                $banner = isset($page_banner) ? $page_banner : $default_banner;
              
              ?>

              <div class="banner-image" style="background-image: url(<?php echo $banner['url'] ?>);">
                  <div class="overlay"></div>
              </div>
              <div class="container">
                  <div class="banner-inner">
                      <div>
                      <?php
                        $breadcrumbs = get_breadcrumb();
                        if ($breadcrumbs) :
                            ?>
                            <ul class="breadcrumbs" aria-label="breadcrumb">
                                <?php foreach ($breadcrumbs as $breadcrumb) : ?>
                                    <li>
                                        <?php
                                        if ($breadcrumb['url']) {
                                            echo '<a href="' . esc_url($breadcrumb['url']) . '">';
                                        }
                                        echo $breadcrumb['text'];
                                        if ($breadcrumb['url']) {
                                            echo '</a>';
                                        }
                                        ?>
                                    </li>
                                <?php endforeach; ?>
                            </ul>
                        <?php endif; ?>

                        <h1><?php
                            if (isset($_GET['search'])) {
                                echo 'Search for: ' . esc_html($_GET['search']);
                            } elseif(isset($_GET['favorites'])){
                              echo __('Favorite jobs', 'donbosco');
                            }elseif (is_post_type_archive()) {
                                $post_type = get_post_type();
                                if ($post_type === 'vacancies') {
                                    echo __('Available jobs', 'donbosco');
                                } else {
                                    $post_type_object = get_post_type_object($post_type);
                                    if ($post_type_object && property_exists($post_type_object, 'labels') && is_object($post_type_object->labels)) {
                                        echo esc_html($post_type_object->labels->name);
                                    }
                                }
                            } elseif (is_search()) {

                                $search_term = get_search_query();
                                echo __('Search Results for', 'donbosco').': ' . esc_html($search_term);

                            }  elseif(is_tax()){

                              $current_taxonomy = get_queried_object();
                              echo  $current_taxonomy->name;

                            } else {
                                echo get_the_title();
                            }
                            ?></h1>

                      </div>
                      <div class="d-none d-md-block">
                          <img src="<?php echo get_template_directory_uri(); ?>/assets/images/icons/shape-4.svg" alt="shape-4" class="shape-4 img-fluid">
                      </div>
                  </div>
              </div>
          </div>
  <?php endif; ?>

  <?php if(is_page_template('templates/news.php')): ?>
  <div class="news-banner position-relative">
      <div class="shape-7 d-none d-md-block"><img src="<?php echo get_template_directory_uri(); ?>/assets/images/icons/shape-7.svg" alt=""></div>
      <div class="shape-6 d-none d-md-block"><img src="<?php echo get_template_directory_uri(); ?>/assets/images/icons/shape-6.svg" alt=""></div>
      <div class="container">
        <div class="row justify-content-between">
          <div class="col-lg-6 d-flex gap-5 align-items-end">
            <div>
              <?php
                $breadcrumbs = get_breadcrumb();
                if ($breadcrumbs) :
                    ?>
                    <ul class="breadcrumbs" aria-label="breadcrumb">
                        <?php foreach ($breadcrumbs as $breadcrumb) : ?>
                            <li>
                                <?php
                                if ($breadcrumb['url']) {
                                    echo '<a href="' . esc_url($breadcrumb['url']) . '">';
                                }
                                echo $breadcrumb['text'];
                                if ($breadcrumb['url']) {
                                    echo '</a>';
                                }
                                ?>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                <?php endif; ?>
                <h1><?php

                  if (isset($_GET['search'])) {
                    echo __('Search Results for','donbosco').': ' . esc_html($_GET['search']);
                  } 
                  elseif (is_post_type_archive()) {
                      $post_type = get_post_type();
                      if ($post_type === 'vacancies') {
                          echo __('Available Jobs', 'donbosco');
                      } else {
                          $post_type_object = get_post_type_object($post_type);
                          echo esc_html($post_type_object->labels->name);
                      }
                  } elseif (is_search()) {
                      $search_term = get_search_query();
                      echo __('Search Results for','donbosco').': ' . esc_html($search_term);
                  } else {
                      echo get_the_title();
                  }
                  
                ?></h1>
            </div>
            <div class="d-none d-md-block">
              <img src="<?php echo get_template_directory_uri(); ?>/assets/images/icons/shape-4.svg" alt="shape-4" class="shape-4 img-fluid">
            </div>
          </div>
          <div class="col-lg-5">
            <form><button type="submit"><svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 28 28"
                  fill="none">
                  <path
                    d="M16.558 6.51214C19.2785 9.2326 19.2785 13.6433 16.558 16.3638C13.8375 19.0842 9.42681 19.0842 6.70636 16.3638C3.9859 13.6433 3.9859 9.2326 6.70636 6.51214C9.42681 3.79169 13.8375 3.79169 16.558 6.51214"
                    stroke="#F56537" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                  <path d="M16.5078 16.4033L23.3328 23.3217" stroke="#F56537" stroke-width="1.5" stroke-linecap="round"
                    stroke-linejoin="round" />
                </svg></button>
              <input type="text" class="form-control search-news" placeholder="Zoek ">
            </form>

          </div>
        </div>
      </div>
    </div>
  <?php endif; ?>


  <?php if (is_singular('vacancies')) : ?>
    <div class="vacancies-single-banner">
      <canvas id="vacancies-rive" width="146" height="60" class="d-none d-lg-block"></canvas>
      <canvas id="smile-rive4" width="80" height="80" class="d-none d-lg-block"></canvas>
      <div class="half-circle-bottom" class="d-none d-lg-block"></div>
      <div class="container">
        <div class="banner-inner">
          <a href="#" class="back-btn" onclick="window.history.back();"><svg xmlns="http://www.w3.org/2000/svg" width="7" height="10" viewBox="0 0 7 10" fill="none">
            <path opacity="0.8" d="M6 1L2 5L6 9" stroke="currentColor" stroke-width="1.5"/>
          </svg> <?php echo __('Back to jobs', 'donbosco'); ?></a>
          <h1><?php the_title(); ?></h1>
          <div class="extra-info">
            <ul class="left">
              <?php if(get_field('location')):?>
              <li><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none">
                <path d="M7.5 11.8375C4.58917 12.2384 2.5 13.3142 2.5 14.5834C2.5 16.1942 5.8575 17.5 10 17.5C14.1425 17.5 17.5 16.1942 17.5 14.5834C17.5 13.3142 15.4108 12.2384 12.5 11.8375" stroke="#F56537" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                <path d="M9.99967 14.1667V7.5" stroke="#F56537" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                <path d="M11.7678 3.23223C12.7441 4.20854 12.7441 5.79146 11.7678 6.76776C10.7915 7.74407 9.20854 7.74407 8.23223 6.76776C7.25592 5.79146 7.25592 4.20854 8.23223 3.23223C9.20854 2.25592 10.7915 2.25592 11.7678 3.23223" stroke="#F56537" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
              </svg> <?php the_field('location'); ?></li>
              <?php endif; if(get_field('job_type')):?>
              <li><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none">
                <path d="M6.66667 3.33337V14.1667" stroke="#F56537" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                <path d="M15.8327 14.1666V17.5" stroke="#F56537" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                <path d="M14.1663 3.33337H15.833C16.293 3.33337 16.6663 3.70671 16.6663 4.16671V13.3334C16.6663 13.7934 16.293 14.1667 15.833 14.1667H4.99967C4.07884 14.1667 3.33301 14.9125 3.33301 15.8334V15.8334C3.33301 16.7542 4.07884 17.5 4.99967 17.5H16.6663" stroke="#F56537" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                <path d="M3.33301 15.8334V5.00004C3.33301 4.07921 4.07884 3.33337 4.99967 3.33337H10.833" stroke="#F56537" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                <path fill-rule="evenodd" clip-rule="evenodd" d="M13.333 2.5H11.6663C11.2063 2.5 10.833 2.87333 10.833 3.33333V7.5L12.4997 6.66667L14.1663 7.5V3.33333C14.1663 2.87333 13.793 2.5 13.333 2.5Z" stroke="#F56537" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
              </svg> <?php the_field('job_type'); ?></li>
              <?php endif; if(get_field('hours_per_week')):?>
              <li><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none">
                <path fill-rule="evenodd" clip-rule="evenodd" d="M15.8333 17.0833H4.16667C3.24583 17.0833 2.5 16.3375 2.5 15.4167V7.91667C2.5 6.99583 3.24583 6.25 4.16667 6.25H15.8333C16.7542 6.25 17.5 6.99583 17.5 7.91667V15.4167C17.5 16.3375 16.7542 17.0833 15.8333 17.0833Z" stroke="#F56537" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                <path d="M13.4782 6.24996V4.58329C13.4782 3.66246 12.7323 2.91663 11.8115 2.91663H8.18815C7.26732 2.91663 6.52148 3.66246 6.52148 4.58329V6.24996" stroke="#F56537" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
              </svg> <?php the_field('hours_per_week'); ?></li>
              <?php endif; if(get_field('educational_level')):?>
              <li><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none">
                <path fill-rule="evenodd" clip-rule="evenodd" d="M8.08613 3.4125L2.94113 6.27083C1.85947 6.87166 1.85947 8.42666 2.94113 9.02749L8.08613 11.8858C9.27613 12.5467 10.7236 12.5467 11.9145 11.8858L17.0595 9.02749C18.1411 8.42666 18.1411 6.87166 17.0595 6.27083L11.9145 3.4125C10.7236 2.75166 9.27697 2.75166 8.08613 3.4125Z" stroke="#F56537" stroke-width="1.419" stroke-linecap="round" stroke-linejoin="round"/>
                <path d="M4.99316 10.1666V13.4366C4.99316 14.2275 5.389 14.965 6.0465 15.4025L7.38566 16.2933C8.96983 17.3466 11.0315 17.3466 12.6148 16.2933L13.954 15.4025C14.6123 14.965 15.0073 14.2266 15.0073 13.4366V10.1666" stroke="#F56537" stroke-width="1.4167" stroke-linecap="round" stroke-linejoin="round"/>
              </svg> <?php the_field('educational_level'); ?></li>
              <?php endif;?>
            </ul>
            <ul class="right">
              <li>
              <a href="#" class="btn btn-outline-secondary" data-bs-toggle="modal" data-bs-target=".share-popup">
                      <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                        <path fill-rule="evenodd" clip-rule="evenodd" d="M11.0817 8.94979C6.19364 9.50144 2.49865 13.6347 2.49609 18.5538V19.166C4.62047 16.6069 7.75615 15.1026 11.0817 15.0473V18.2757C11.0818 18.7441 11.3495 19.1713 11.7711 19.3755C12.1926 19.5798 12.6938 19.5252 13.0615 19.2351L21.0548 12.9234C21.3386 12.6998 21.5042 12.3584 21.5042 11.9971C21.5042 11.6357 21.3386 11.2943 21.0548 11.0707L13.0615 4.75905C12.6938 4.46887 12.1926 4.41432 11.7711 4.61859C11.3495 4.82286 11.0818 5.25003 11.0817 5.71845V8.94979Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                      </svg>
                    </a>
              </li>

              <?php $is_favorite = is_job_favorite(get_the_ID());?>
              <li><button class="btn btn-secondary btn-fav btn-fav-single <?php echo $is_favorite ? 'active' : ''; ?>" data-id="<?php echo get_the_ID() ?>"><svg xmlns="http://www.w3.org/2000/svg" width="21" height="21" viewBox="0 0 21 21" fill="none">
                <path fill-rule="evenodd" clip-rule="evenodd" d="M10.5 4.30937C11.1781 3.51575 12.3515 2.625 14.1382 2.625C17.2629 2.625 19.3594 5.558 19.3594 8.28975C19.3594 14 12.25 18.375 10.5 18.375C8.75 18.375 1.64062 14 1.64062 8.28975C1.64062 5.558 3.73712 2.625 6.86175 2.625C8.6485 2.625 9.82188 3.51575 10.5 4.30937Z" stroke="#fff" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
              </svg></button></li>
              <li><button type="button" class="btn btn-secondary takeJobModal" data-bs-toggle="modal" data-bs-target="#takeJobModal"><?php echo __('Apply now', 'donbosco'); ?></button></li>
            </ul>
          </div>
        </div>
      </div>
    </div>
  <?php endif; ?>