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
  <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/assets/css/edits.css">
  <script>
    // Global variables
    const ajaxurl = "<?php echo admin_url('admin-ajax.php'); ?>";
    <?php $page_template = get_page_template_slug(); ?>

    <?php $message = get_field('form_message', 'option'); ?>
      let successmsg  = "<?php echo $message['success_message']?>";
      let errormsg    = "<?php echo $message['error_message']?>";
      let invaliemail = "<?php echo $message['invalid_email_message']?>";
      let mandatoryFields = "<?php echo $message['mandatory_fields']?>";
  </script>
</head>

<body <?php body_class(); ?>>
  <?php 
        $attachment_url = null; 
        if(is_single()){
          $attachment_id = get_post_thumbnail_id(get_the_ID());
          $attachmentdata = wp_get_attachment_image_src($attachment_id, 'full');
          if(is_array($attachmentdata)) $attachment_url = wp_get_attachment_image_src($attachment_id, 'full')[0];
          else $attachment_url = wp_get_attachment_image_src($attachment_id, 'full');
        }
        $pagebanner = get_field('banner');
        $defaultbanner = get_field('default_page_banner', 'option');

        if($pagebanner) $banner = $pagebanner['url'];
        elseif ( $attachment_url ) $banner = $attachment_url;
        else $banner = $defaultbanner['url'];
  ?>
  <div class="bg-home-top" style="background-image: linear-gradient(rgba(0,0,0,0.5),rgba(0,0,0,0.5)),url(<?php echo $banner; ?>);">
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
          <?php $mainlogo = get_field('logo', 'option');  ?>
          <?php if($mainlogo):  ?> 
          <a class="navbar-brand" href="<?php echo site_url('/'); ?>"><img src="<?php echo $mainlogo['url']; ?>" alt="<?php echo $mainlogo['alt']; ?>"></a>
          <?php else: ?>
          <a class="navbar-brand" href="<?php echo site_url('/'); ?>"><img src="<?php echo get_template_directory_uri(); ?>/assets/images/main-logo.svg" alt="Main logo"></a>
          <?php endif; ?>
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
              if (wp_is_mobile()) {
                  wp_nav_menu(array(
                      'theme_location' => 'mobilemenu',
                      'container' => false,
                      'items_wrap' => '%3$s',
                      'walker' => new Custom_Nav_Walker()
                  ));
              } else {
                  wp_nav_menu(array(
                      'theme_location' => 'mainmenu',
                      'container' => false,
                      'items_wrap' => '%3$s',
                      'walker' => new Custom_Nav_Walker()
                  ));
              }
              ?>
          </ul>

            <div class="d-flex align-items-center gap-2">
              <?php $link = get_field('header_action_button', 'option'); if($link): ?>
              <a href="<?php echo $link['url']; ?>" class="btn btn-primary" target="<?php echo $link['target']; ?>"><?php echo $link['title']; ?></a>
              <?php endif; ?>
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
        <div class="row">
          <div class="col-md-7 col-12">
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
          </div>
          <div class="col-md-5 col-12 donation-form-home">
                <?php echo do_shortcode("[donation_form]"); ?>
          </div>
        </div>

        <?php 
            $args = array(
                'post_type'      => 'fk_verhuur',
                'post_status'    => 'publish',
                'posts_per_page' => -1, 
            );

            $evnts = array(
              'post_type'      => 'fk_events',
              'post_status'    => 'publish',
              'posts_per_page' => -1, 
          );
          
          $verhuur = new WP_Query( $args );
          $events = new WP_Query( $evnts );
          
          ?>
          
          
        <?php if($events->have_posts() || $verhuur->have_posts()): ?>
        <div class="activity-tabs">
          <ul class="nav nav-tabs" id="myTab" role="tablist">
              <?php if ( $events->have_posts() ) :?>
              <li class="nav-item" role="presentation">
                  <button class="nav-link active" id="event-tab" data-bs-toggle="tab" data-bs-target="#event" type="button" role="tab" aria-controls="event" aria-selected="true">Event</button>
              </li>
              <?php endif; ?>
              <?php if ( $verhuur->have_posts() ) :?>
              <li class="nav-item" role="presentation">
                  <button class="nav-link  <?= (!$events->have_posts())? 'active': ''; ?>" id="verhuur-tab" data-bs-toggle="tab" data-bs-target="#verhuur" type="button" role="tab" aria-controls="verhuur" aria-selected="false">Verhuur</button>
              </li>
              <?php endif; ?>
          </ul>
        </div>
        <?php endif; ?>
        <?php if($events->have_posts() || $verhuur->have_posts()): ?>
          <div class="activity-box position-relative tab-content" id="myTabContent">
            <?php if ( $events->have_posts() ) :?>
              <div class="tab-pane fade show active" id="event" role="tabpanel" aria-labelledby="event-tab">
                <div class="row align-items-center">
                  <div class="col-lg-3">
                    <h4><?php echo $hero['activiteiten']['tab_1_title']?></h4>
                  </div>
                  <div class="col-lg-7">
                    <div class="swiper home-banner-slider">
                      <div class="swiper-wrapper">
                        <?php 
                        $args = array(
                            'post_type'      => 'fk_events',
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
                                <div class="row align-items-center gap-3 gap-md-4 gap-xl-0">
                                  <div class="col-md-5 col-xl-4">
                                    <div class="d-flex align-items-center gap-2">
                                      <img src="<?php echo get_template_directory_uri(); ?>/assets/images/icon-calendar.svg" alt="icon-calendar">
                                      <span class="text-grey"><?php the_field('start_date'); ?> - <?php the_field('end_date'); ?></span>
                                    </div>
                                    <h5 class="fw-600 evt-title"><?php the_title(); ?></h5>
                                    <div class="text-grey bornona"><?= limitWords(get_field('info_line')) ?></div>                                    
                                  </div>
                                  <div class="col-md-5">
                                    <div class="d-flex align-items-center gap-2 mb-1 mb-lg-2">
                                      <img src="<?php echo get_template_directory_uri(); ?>/assets/images/icon-time.svg" alt="icon-time">
                                      <span class="text-grey"><?php the_field('start_time'); ?> - <?php the_field('end_time'); ?> </span>
                                    </div>
                                    <div class="d-flex align-items-center gap-2 mb-1 mb-lg-2">
                                      <img src="<?php echo get_template_directory_uri(); ?>/assets/images/icon-map-addr.svg" alt="icon-map-addr.svg">
                                      <span class="text-grey"><?php the_field('location'); ?></span>
                                    </div>
                                  </div>
                                  <div class="col-xl-3 mt-3 mt-lg-0">
                                    <div class="d-flex align-items-center justify-content-between justify-content-xl-end">
                                      <?php $dematen = get_field('other_link');?>
                                      <div class="d-none dmaten-text"><?php echo (!empty($dematen) && is_array($dematen)) ? $dematen['title'] : ''; ?></div>
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
                    <div class="position-absolute bg-primary top-0 end-0 rounded-top-right rounded-bottom-left py-1 px-3 text-uppercase fw-bold dematen-title">
                      <?php echo $hero['activiteiten']['right_side_title']?>
                    </div>
                    <div class="action-btn d-flex align-items-center gap-1 justify-content-end d-none d-md-block">
                        <a href="#" class="activity-slider-prev"><img src="<?php echo get_template_directory_uri(); ?>/assets/images/icon-arrow.svg" alt="icon-arrow"></a>
                        <a href="#" class="activity-slider-next"><img src="<?php echo get_template_directory_uri(); ?>/assets/images/icon-arrow.svg" alt="icon-arrow"></a>
                      
                    </div>
                  </div>
                </div>
              </div>
            <?php endif; ?>
            <?php if ( $verhuur->have_posts() ) :?>
              <div class="tab-pane fade <?= (!$events->have_posts())? 'show active': ''; ?>" id="verhuur" role="tabpanel" aria-labelledby="verhuur-tab">
                <div class="row align-items-center">
                    <div class="col-lg-3">
                      <h4><?php echo $hero['activiteiten']['tab_2_title']?></h4>
                    </div>
                    <div class="col-lg-7">
                      <div class="swiper home-banner-slider">
                        <div class="swiper-wrapper">
                          <?php 
                          $args = array(
                              'post_type'      => 'fk_verhuur',
                              'post_status'    => 'publish',
                              'posts_per_page' => -1, 
                          );
                        
                        $query = new WP_Query( $args );
                        
                        if ( $query->have_posts() ) {
                          while ( $query->have_posts() ) { $query->the_post(); ?>
                                <div class="swiper-slide">
                                  <div class="row align-items-center gap-3 gap-md-4 gap-xl-0">
                                    <div class="col-md-5 col-xl-4">
                                      <div class="d-flex align-items-center gap-2">
                                        <img src="<?php echo get_template_directory_uri(); ?>/assets/images/icon-calendar.svg" alt="icon-calendar">
                                        <span class="text-grey"><?php the_date(); ?></span>
                                      </div>
                                      <h5 class="fw-600 evt-title"><?php the_title(); ?></h5>
                                      <div class="text-grey bornona"><?= limitWords(get_the_excerpt(), 5) ?></div>
                                    </div>
                                    <div class="col-md-5">
                                      <div class="d-flex align-items-center gap-2 mb-1 mb-lg-2">
                                        <img class="eurosign" src="<?php echo get_template_directory_uri(); ?>/assets/images/euro.svg" alt="SVG Image">
                                        <span class="text-grey"><?php the_field('price'); ?></span>
                                      </div>
                                    </div>
                                    <div class="col-xl-3 mt-3 mt-lg-0">
                                      <div class="d-flex align-items-center justify-content-between justify-content-xl-end">
                                        <?php $dematen = get_field('other_link');?>
                                        <div class="d-none dmaten-text"><?php echo (!empty($dematen) && is_array($dematen)) ? $dematen['title'] : ''; ?></div>
                                        <a href="<?php the_permalink(); ?>" class="text-link">
                                          Lees VERDER <img src="<?php echo get_template_directory_uri(); ?>/assets/images/icon-arrow.svg" alt="icon-arrow">
                                        </a>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                              <?php  
                          } 
                          wp_reset_postdata();                
                        };                 
                      ?>
                          
                        </div>
                      </div>
                    </div>
                    <div class="col-lg-2">
                      <div class="position-absolute bg-primary top-0 end-0 rounded-top-right rounded-bottom-left py-1 px-3 text-uppercase fw-bold dematen-title">
                        <?php echo $hero['activiteiten']['right_side_title']?>
                      </div>
                      <div class="action-btn d-flex align-items-center gap-1 justify-content-end d-none d-md-block">
                          <a href="#" class="activity-slider-prev"><img src="<?php echo get_template_directory_uri(); ?>/assets/images/icon-arrow.svg" alt="icon-arrow"></a>
                          <a href="#" class="activity-slider-next"><img src="<?php echo get_template_directory_uri(); ?>/assets/images/icon-arrow.svg" alt="icon-arrow"></a>
                        
                      </div>
                    </div>
                  </div>
                </div>
              <?php endif; ?>
          </div>
        <?php endif; ?>
      </div>
    </section>
    <?php endif; ?>
    <?php if(!is_404()): ?>
    <?php if(!is_front_page() && !is_home() && !is_single() && !is_page_template("templates/contact.php")): ?>
    <div class="page-banner">
      <div class="container">
        <div class="row">
          <div class="col-12">
            <div class="subtitle">
              <?php if(get_field('subtitle')) {
                echo get_field('subtitle');
              }elseif(is_search()){
                echo "Uw zoekresultaat";
              }else {
                echo "Een thuis voor jongeren";
              } ?>
              
            </div>
            <h1><?php
            if(is_search()) echo "Zoekresultaten";
            else the_title(); ?></h1>
            <nav aria-label="breadcrumb">
              <?php
                $breadcrumbs = get_breadcrumb();
                if ($breadcrumbs) : ?>
                  <ol class="breadcrumb">
                      <?php foreach ($breadcrumbs as $breadcrumb) : ?>
                          <li class="breadcrumb-item">
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
                    </ol>
              <?php endif; ?>
            </nav>
          </div>
        </div>
      </div>
    </div>
    <?php endif; ?>
    <?php endif; ?>
    <?php if(is_singular('post')): while (have_posts()) : the_post(); ?>
      <div class="single-news-header text-white">
          <div class="container">
              <h1 class="text-white"><?php the_title(); ?></h1>
              <div class="mt-4">
                  <div class="d-flex align-items-center gap-5">
                      <div class="d-flex align-items-center gap-3">
                          <img src="<?php echo get_template_directory_uri(); ?>/assets/images/icon-news-calendar.svg" alt="icon-news-calendar"> 
                          <?php echo get_the_date('d.m.Y'); ?>
                      </div>
                      <div class="d-flex align-items-center gap-3">
                          <?php
                          // Check if ACF is active and author image field exists
                          if (function_exists('get_field') && get_field('author_image')) {
                              $author_image = get_field('author_image');
                              echo '<img class="author-image" src="' . esc_url($author_image['url']) . '" alt="' . esc_attr(get_the_author()) . '">';
                          } else {
                              // Fallback to Gravatar if ACF field is not available
                              $author_email = get_the_author_meta('email');
                              $author_avatar = 'https://www.gravatar.com/avatar/' . md5(strtolower(trim($author_email))) . '?s=100';
                              echo '<img class="author-image" src="' . esc_url($author_avatar) . '" alt="' . esc_attr(get_the_author()) . '">';
                          }
                          ?>
                          <span><?php echo ucwords(strtolower(get_the_author_meta('display_name'))); ?></span>
                      </div>
                      <div class="d-flex align-items-center gap-3">
                          <img src="<?php echo get_template_directory_uri(); ?>/assets/images/icon-circle-back.svg" alt="icon-circle-back">
                          <a class="go-back" href="javascript:void(0);" onclick="history.back();">terug naar overzicht</a>
                      </div>
                  </div>
              </div>
          </div>
      </div>
  <?php endwhile; endif; ?>

      <?php if(is_singular( 'fk_events' ) || is_singular( 'fk_verhuur' )) { ?>
        <div class="page-banner text-white event-single-banner">
          <div class="container">
            <div class="row">
              <div class="col-lg-6 mb-5 mb-lg-0">


                <div class="event-date">
                  <img src="<?php echo get_template_directory_uri(); ?>/assets/images/icon-calendar-w.svg" alt="icon-calendar"> <?php echo !is_singular('fk_verhuur') ? get_field('start_date') . ' - ' . get_field('end_date') : get_the_date(); ?>
                </div>
                <h1><?php the_title(); ?></h1>
                <?php if(!is_singular('fk_verhuur')): ?>
                <div class="event-time">
                  <img src="<?php echo get_template_directory_uri(); ?>/assets/images/icon-clock.svg" alt="clock"><?php echo !is_singular('fk_verhuur') ? the_field('start_time') . ' - ' . the_field('end_time') : the_date(); ?>
                </div>
                <?php endif; ?>
                <?php if(!is_singular( 'fk_verhuur' )): ?>
                <div class="event-place">
                  <img src="<?php echo get_template_directory_uri(); ?>/assets/images/icon-place.svg" alt="place"> <?php the_field('location'); ?>
                </div>
                <?php endif; ?>

                <?php if(is_singular( 'fk_verhuur' )): ?>
                <div class="event-place">
                  <img class="eurosign" src="<?php echo get_template_directory_uri(); ?>/assets/images/euro-w.svg" alt="place"> <?php the_field('price'); ?>
                </div>
                <?php endif; ?>

                <div class="d-flex align-items-center gap-3 mt-4">
                  <?php $olink = get_field('other_link'); if($olink): ?>
                  <a href="<?php echo $olink['url']; ?>" class="btn btn-secondary" target="<?php echo $olink['title']; ?>"><?php echo $olink['title']; ?></a>
                  <?php endif; ?>
                  <?php $tlink = get_field('ticket_link'); if($tlink): ?>
                  <a href="<?php echo $tlink['url']; ?>" class="btn btn-outline-secondary"><img src="<?php echo get_template_directory_uri(); ?>/assets/images/icon-ticket.svg" alt="ticket" target="<?php echo $tlink['target']; ?>"><?php echo $tlink['title']; ?></a>
                  <?php endif; ?>
                </div>
              </div>
              <div class="col-lg-5 col-xl-4 offset-lg-1 offset-xl-2">
                <?php $totals = get_field('event_statistics'); if($totals):  ?>
                <ul class="event-summary">
                  <?php foreach($totals as $total):  ?>
                  <li>
                    <img src="<?php echo $total['icon']['url'];?>" alt="icon-users"> <span class="total-number"><?php echo $total['value'];?></span> <?php echo $total['key'];?>
                  </li>
                  <?php endforeach; ?>
                  
                </ul>
                <?php endif; ?>
              </div>
            </div>
          </div>
        </div>
      <?php } ?>

      <?php if(is_singular( 'vacatures' )) { ?>
      <div class="page-banner text-white">
        <div class="container">
          <div class="row">
            <div class="col-12">
              
              <?php echo (get_field('subtitle'))? '<div class="subtitle">'.get_field('subtitle').'</div>' : ''; ?>             
              <h1><?php the_title(); ?></h1>
              <?php echo (get_field('short_line_after_title'))? '<p>'.get_field('short_line_after_title').'</p>' : ''?> 
              <div class="d-flex align-items-center gap-3">
                <?php if(get_field('location')): ?>
                <div class="d-flex align-items-center gap-3">
                  <img src="<?php echo get_template_directory_uri(); ?>/assets/images/icon-map.svg" alt="map icon"><?php the_field('location'); ?>
                </div>
                <?php endif; ?>
                <?php if(get_field('location')): ?>
                <div class="d-flex align-items-center gap-3">
                  <img src="<?php echo get_template_directory_uri(); ?>/assets/images/icon-time-2.svg" alt="timeicon-time icon"><?php the_field('job_type'); ?>
                </div>
                <?php endif; ?>
              </div>
            </div>
          </div>
        </div>
      </div>
      <?php } ?>

<?php if(!is_page_template("templates/contact.php") && !is_404()):?>
  </div>
<?php endif; ?>


