<!doctype html>
<html <?php language_attributes(); ?> class="page-id-<?php the_ID(); ?>">

<head>
  <?php 
    
    $favicon = get_field('favicon', 'option'); 
    if($favicon) echo '<link rel="shortcut icon" type="image/jpg" href="'.esc_url($favicon).'"/>';
  ?>
  <meta charset="utf-8">
  <?php wp_head(); ?>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- video popup css -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/magnific-popup.min.css">
  <!-- swiper slider css -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
  <link rel="stylesheet" href="//use.typekit.net/hca3mfo.css">
  <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/assets/css/style.css">
  
</head>

<body <?php body_class(); ?>>
  <div class="bg-home-top" style="background-image: linear-gradient(rgba(0,0,0,0.5),rgba(0,0,0,0.5)),url(<?php echo get_template_directory_uri(); ?>/assets/images/banner-bg.jpg);">
    <header class="header">
      <div class="header-top bg-primary d-none d-lg-block">
        <div class="container">
          <?php
            wp_nav_menu(array(
                'theme_location' => 'topmenu',
                'container' => 'ul',
                'container_class' => 'header-top-menu justify-content-end nav',
                'menu_class' => 'header-top-menu justify-content-end nav',
                'walker' => new Custom_Nav_Walker()
            ));
          ?>
        </div>
      </div>
      <nav class="navbar navbar-expand-lg">
        <div class="container">
          <a class="navbar-brand" href="#"><img src="<?php echo get_template_directory_uri(); ?>/assets/images/main-logo.svg" alt="main logo" class="img-fluid"></a>
          <div class="d-lg-none d-flex align-items-center gap-3">
            <div class="header-search dropdown">
              <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                aria-expanded="false">
                <img src="<?php echo get_template_directory_uri(); ?>/assets/images/icon-search.svg" alt="search icon">
              </a>
              <div class="dropdown-menu dropdown-menu-end">
                <form class="d-flex search-holder position-relative" role="search">
                  <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                  <button class="btn btn-primary" type="submit"><span class="d-none d-md-block">Zoek</span> <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-90deg-right d-md-none" viewBox="0 0 16 16">
                    <path fill-rule="evenodd" d="M14.854 4.854a.5.5 0 0 0 0-.708l-4-4a.5.5 0 0 0-.708.708L13.293 4H3.5A2.5 2.5 0 0 0 1 6.5v8a.5.5 0 0 0 1 0v-8A1.5 1.5 0 0 1 3.5 5h9.793l-3.147 3.146a.5.5 0 0 0 .708.708z"/>
                  </svg></button>
                </form>
              </div>

            </div>
            <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#main-nav"
              aria-controls="main-nav" aria-expanded="false" aria-label="Toggle navigation">
              <span></span>
              <span></span>
              <span></span>
            </button>
          </div>
          <div class="offcanvas offcanvas-top" id="main-nav"
          tabindex="-1" aria-labelledby="offcanvasNavbarLabel">
          <div class="offcanvas-header">
            <?php 
              $mainlogo = get_field('logo', 'option'); 
              if($mainlogo):  ?> 
              <a class="navbar-brand" href="<?php echo site_url('/'); ?>"><img src="<?php echo $mainlogo['url']; ?>" alt="<?php echo $mainlogo['alt']; ?>"></a>
              <?php else: ?>
              <a class="navbar-brand" href="<?php echo site_url('/'); ?>"><img src="<?php echo get_template_directory_uri(); ?>/assets/images/main-logo.svg" alt="Main logo"></a>
              <?php endif; ?>
            <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
          </div>
          <div class="offcanvas-body">
           

            <ul class="navbar-nav mx-auto mb-2 mb-lg-0">
                <?php
                    wp_nav_menu(array(
                        'theme_location' => 'mainmenu',
                        'container' => false,
                        'items_wrap' => '%3$s',
                        'walker' => new Custom_Nav_Walker()
                    ));
                ?>
            </ul>
            <div class="d-flex align-items-center gap-2">
              <a href="#" class="btn btn-primary">Nieuws</a>
              <div class="header-search dropdown d-none d-lg-block">
                <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                  aria-expanded="false">
                  <img src="<?php echo get_template_directory_uri(); ?>/assets/images/icon-search.svg" alt="search icon">
                </a>
                <div class="dropdown-menu dropdown-menu-end">
                  <form role="search" method="get" class="search-form d-flex search-holder position-relative" action="<?php echo esc_url( home_url( '/' ) ); ?>">
                      <input type="search" class="form-control me-2" placeholder="Search" value="<?php echo get_search_query(); ?>" name="s" aria-label="Search">
                      <button type="submit" class="btn btn-primary">Zoek</button>
                  </form>
                </div>

              </div>
            </div>
          </div>
        </div>
          
        </div>
      </nav>
    </header>

    <?php if(is_home() || is_front_page()): $hero = get_field('hero_section');?>
    <section class="banner-home">
      <div class="container">
        <?php if($hero['sub_title']): ?>
        <div class="subtitle p-color">
          <?php echo $hero['sub_title']; ?>
        </div>
        <?php endif; ?>
        <?php if($hero['title']): ?>
          <h1><?php echo $hero['title']; ?></h1>
        <?php endif; ?>
        <?php if($hero['texts']): ?>
        <p><?php echo $hero['texts']; ?></p>
        <?php endif; ?>
        
        <div class="d-grid d-md-flex align-items-center gap-3">
          <?php if($hero['learn_more']): ?>
            <a href="<?php echo $hero['learn_more']['url']; ?>" class="btn btn-primary" target="<?php echo $hero['learn_more']['target']; ?>"><?php echo $hero['learn_more']['title']; ?></a>
          <?php endif; ?>
          <?php if($hero['video']): ?>
            <a href="<?php echo $hero['video']['url']?>" class="btn btn-secondary openVideo d-flex align-items-center justify-content-center gap-2"><?php echo $hero['video']['title']?> <div class="btn-play"><span></span></div></a>
          <?php endif; ?>
        </div>
        

        <div class="activity-box position-relative">
          <div class="row align-items-center">
            <div class="col-lg-3">
              <h4><?php echo $hero['activiteiten']['title']?></h4>
            </div>
            <div class="col-lg-7">
              <div class="swiper home-banner-slider">
                <div class="swiper-wrapper">
                  <?php 
                  $args = array(
                      'post_type'      => 'activiteiten',
                      'post_status'    => 'publish',
                      'posts_per_page' => -1, 
                  );
                
                $query = new WP_Query( $args );
                
                if ( $query->have_posts() ) {
                  while ( $query->have_posts() ) { 
                    $query->the_post();
                    $enddata = get_field('end_date');
                    $endtime = get_field('end_time');

                      if(isEventAlive($enddata, $endtime)){ ?>
                        <div class="swiper-slide">
                          <div class="row align-items-center gap-4 gap-xl-0">
                            <div class="col-md-5 col-xl-4">
                              <div class="d-flex align-items-center gap-2">
                                <img src="<?php echo get_template_directory_uri(); ?>/assets/images/icon-calendar.svg" alt="icon-calendar">
                                <span class="text-grey"><?php the_field('start_date'); ?> - <?php the_field('end_date'); ?></span>
                              </div>
                              <h5 class="fw-600"><?php the_title(); ?></h5>
                              <div class="text-grey"><?php the_field('info_line'); ?></div>
                            </div>
                            <div class="col-md-5">
                              <div class="d-flex align-items-center gap-2 mb-2">
                                <img src="<?php echo get_template_directory_uri(); ?>/assets/images/icon-time.svg" alt="icon-time">
                                <span class="text-grey"><?php the_field('start_time'); ?> - <?php the_field('end_time'); ?> </span>
                              </div>
                              <div class="d-flex align-items-center gap-2 mb-2">
                                <img src="<?php echo get_template_directory_uri(); ?>/assets/images/icon-map-addr.svg" alt="icon-map-addr.svg">
                                <span class="text-grey"><?php the_field('location'); ?></span>
                              </div>
                            </div>
                            <div class="col-xl-3">
                              <div class="d-flex align-items-center justify-content-between justify-content-xl-end">
                                <a href="<?php the_permalink(); ?>" class="text-link">
                                  Lees VERDER <img src="<?php echo get_template_directory_uri(); ?>/assets/images/icon-arrow.svg" alt="icon-arrow">
                                </a>
                              </div>
                            </div>
                          </div>
                        </div>
                      <?php                    
                      }
                  }  
                  wp_reset_postdata();                
                };                 
              ?>
                  
                </div>
              </div>
            </div>
            <div class="col-lg-2">
              <div class="position-absolute bg-primary top-0 end-0 rounded-top-right rounded-bottom-left py-1 px-3 text-uppercase fw-bold">
                <?php echo $hero['activiteiten']['right_side_title']?>
              </div>
              <div class="action-btn d-flex align-items-center gap-1 justify-content-end">
                  <a href="#" class="activity-slider-prev"><img src="<?php echo get_template_directory_uri(); ?>/assets/images/icon-arrow.svg" alt="icon-arrow"></a>
                  <a href="#" class="activity-slider-next"><img src="<?php echo get_template_directory_uri(); ?>/assets/images/icon-arrow.svg" alt="icon-arrow"></a>
                 
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <?php endif; ?>
  </div>
