<?php

//Template Name: Home

get_header(); 
$searchsec = get_field('search_section');

?>

<section class="main-banner">
    <div class="container">
      <div class="row">
        <div class="col-md-7 col-xl-6 col-xxl-8" data-aos="fade-right">
          
          <h1><?php echo $searchsec['main_title'] ?></h1>
          <div class="pre-title-banner"><?php echo $searchsec['subtitle'] ?></div>
          

          <?php 
              $current_language = ICL_LANGUAGE_CODE;
              $swtich = $searchsec['search_switch']; 
              $salternate = $searchsec['search_sections_alternate'];         

              $button =  $salternate['button']; 
              $turnofflanguage = $salternate['for_which_language_you_wnat_to_turn_it_off'];

              $languages = languages();

              $shouldTurnOff = false;
              if($turnofflanguage){
                foreach ($turnofflanguage as $languageName) {
                    if (isset($languages[$languageName]) && $languages[$languageName] === $current_language) {
                        $shouldTurnOff = true;
                        break;
                    }
                }
              }

              if($swtich  === 'Off' && $shouldTurnOff){   if ($button): ?>       
              <a href="<?php echo $button["url"]; ?>" class="btn btn-secondary home-btn" target="<?php echo $button["target"]; ?>"><?php echo $button["title"]; ?></a>
              <?php 
              endif; }else {
          ?>

          <form id="homesearh" url="<?php echo site_url(); ?>">
            <input type="text" class="form-control searchinput" placeholder="Search for jobs...">
            <button type="submit" class="btn btn-secondary rounded-1">Search</button>
          </form>

          <ul class="banner-links">
              <li>
                <a href="#"><svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 22 22" fill="none">
                    <rect x="3.14307" y="3.14282" width="6.8323" height="6.8323" rx="2" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></rect>
                    <rect x="12.0249" y="3.14282" width="6.8323" height="6.8323" rx="2" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></rect>
                    <rect x="12.0249" y="12.0249" width="6.8323" height="6.8323" rx="2" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></rect>
                    <rect x="3.14307" y="12.0249" width="6.8323" height="6.8323" rx="2" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></rect>
                  </svg> All
                </a>
              </li>
              <?php

              $term_ids = $searchsec['category_limit'];
              if($term_ids){
                foreach ($term_ids as $term_id) {
                  
                    $term = get_term($term_id, 'job_category');
                    if ($term && !is_wp_error($term)) {
                        $category_image = get_field('category_image', $term);
                        ?>
                        <li>
                            <a href="<?php echo get_term_link($term->term_id, 'job_category'); ?>" data-catid="<?php echo $term->term_id; ?>">
                                <?php if ($category_image) : ?>
                                    <img src="<?php echo esc_url($category_image['url']); ?>" alt="<?php echo esc_attr($category_image['alt']); ?>">
                                <?php endif; ?>
                                <?php echo esc_html($term->name); ?>
                            </a>
                        </li>
                        <?php
                    }
                }
              }
              ?>
          </ul>
          <?php } ?>
        </div>
      </div>
    </div>
    <?php if($searchsec['image']): ?>
    <div class="smiling-man">
      <img src="<?php echo $searchsec['image']['url'] ?>" alt="<?php echo $searchsec['image']['alt'] ?>" class="img-fluid">
      <canvas id="smile-rive" width="82" height="82"></canvas>
    </div>
    <?php endif; ?>
    <div class="hero-animation-wrapper">
      <canvas id="hero-animation" width="260" height="414"></canvas>
    </div>

    <div class="rectangular-shape"></div>

    
  </section>

  <?php $videosection = get_field('video_section'); ?>
  <section class="b2-our-video-home mb-lg-5 pb-xl-4">
    <div class="container">
    <div class="row">
      <div class="col-lg-6">
      <div class="pe-lg-4 our-video-text-content" data-aos="fade-right">
      <h2><?php echo $videosection['title']; ?></h2>
      <p style="padding-bottom: 20px;"><?php echo $videosection['texts'] ?></p>
      </div>
          
          
        </div>
        <div class="col-lg-6">

          <div class="visible-video-div position-relative" data-aos="fade-left">
          <?php $videolink = $videosection['video']; ?>
          <!-- Popup video -->
            <div class="video-popup">
              <?php if (strpos($videolink, 'youtube.com') !== false || strpos($videolink, 'vimeo.com') !== false) : ?>
                <iframe src="<?php echo $videolink; ?>" width="640" height="564" frameborder="0" allow="autoplay; fullscreen" allowfullscreen></iframe>
              <?php endif; ?>
            </div>
          </div>
        </div>
      </div>
      <div class="row growth-opportunities mt-5">
        <div class="col-12 mb-3">
        <div class="d-flex align-items-center gap-2" style="font-weight: 600;color: #929292;"><?php echo $videosection['info_section']['pointing_text']; ?> <svg width="19" height="18" viewBox="0 0 19 18" fill="none" xmlns="http://www.w3.org/2000/svg"> <path d="M12.6667 15L12.6667 6.75C12.6667 4.6875 10.9266 3 8.79938 3V3L8.82313 3L4.75 3" stroke="#929292" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/> <path d="M9.46191 11.964L12.6666 15L15.8712 11.964" stroke="#929292" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg></div>
        </div>
        <div class="col-lg-10">
          <div class="d-flex flex-column gap-3 gap-lg-4">
          <div class="what-we-offer d-flex justify-content-between flex-wrap flex-column flex-lg-row">
            <div class="title"><?php echo $videosection['info_section']['title']; ?></div>
            <ul>
            <?php 
            
              $lane = $videosection['info_section']['we_works_in']; 
              
              if($lane){
                foreach($lane as $item){
                  echo '<li><img src="'.$item["icons"]["url"].'" alt="all">'.$item["field_name"].' </li>';
                }
              }
            
            ?>       
              

              
            </ul>
          </div>
          <div class="what-we-offer d-flex justify-content-between flex-wrap flex-column flex-lg-row">
            <div class="title"><?php echo $videosection['info_section_2']['title']; ?></div>
            <ul>
              <?php $lane = $videosection['info_section_2']['we_provide_our_employees_with'];               
              if($lane){
                foreach($lane as $item){
                  echo '<li><img src="'.$item["icon"]["url"].'" alt="all">'.$item["field_name"].' </li>';
                }
              }
              
              ?>
              
            </ul>
          </div>
          </div>
        </div>
        <div class="col-lg-2 mt-3 mt-lg-0">
          <?php if($videosection['learn_more']): ?>
            <a href="<?php echo $videosection['learn_more']['url'];  ?> " class="learn-more-2 btn btn-secondary d-flex"><?php echo $videosection['learn_more']['title'];  ?> <svg xmlns="http://www.w3.org/2000/svg" width="7" height="10" viewBox="0 0 7 10" fill="none">
                <path d="M1 1L5 5L1 9" stroke="#FF551E" stroke-width="2"></path>
              </svg>
            </a>
          <?php endif; ?>
        </div>
      </div>
    </div>
  </section>


  <?php $services = get_field('service_section'); ?>
  <section class="b2-our-service">
    <div class="container">
      
      <div class="row gx-2 gx-md-4" data-aos="fade-up">
        
        <div class="col-12 text-center d-flex align-items-center justify-content-center justify-content-md-between">
          <div class="d-none d-md-block mb-md-3"><img src="<?php echo get_template_directory_uri() ?>/assets/images/icons/shape-1.svg" alt="shape-1"></div>
          <div>
            <div class="pre-title"><?php echo $services['subtitle'] ?></div>
            <h2><?php echo $services['title'] ?></h2>
          </div>
          <div class="d-none d-md-block mb-md-3"><img src="<?php echo get_template_directory_uri() ?>/assets/images/icons/shape-3.svg" alt="shape-3"></div>
        </div>
        <div class="col-6">
          <div class="service-block">
            <?php if($services['i_need_job']['images']):?>
            <div class="block-image">
              <a href="<?php echo $services['i_need_job']['vacancy_link']['url']?>" target="<?php echo $services['i_need_job']['vacancy_link']['target']?>">
                <img src="<?php echo $services['i_need_job']['images']['url'] ?>" alt="<?php echo $services['i_need_job']['images']['alt'] ?>" class="img-fluid">
              </a>
            </div>
            <?php endif; ?>
            <div class="block-content">
              <h3><?php echo $services['i_need_job']['title']; ?></h3>
              <p><?php echo $services['i_need_job']['texts']; ?></p>

              <div class="btn-actions">
              <?php if($services['i_need_job']['vacancy_link']): ?>
                <a href="<?php echo $services['i_need_job']['vacancy_link']['url']?>" class="link-btn" target="<?php echo $services['i_need_job']['vacancy_link']['target']?>"><?php echo $services['i_need_job']['vacancy_link']['title']?> <svg xmlns="http://www.w3.org/2000/svg" width="7" height="10"
                    viewBox="0 0 7 10" fill="none">
                    <path d="M1 1L5 5L1 9" stroke="#FF551E" stroke-width="2" />
                  </svg></a>
                <?php endif; if($services['i_need_job']['application_link']):?>
                <a href="<?php echo $services['i_need_job']['application_link']['url']?>" class="link-btn" target="<?php echo $services['i_need_job']['application_link']['target']?>"><?php echo $services['i_need_job']['application_link']['title']?> 
                    <svg xmlns="http://www.w3.org/2000/svg" width="7" height="10" viewBox="0 0 7 10" fill="none">
                      <path d="M1 1L5 5L1 9" stroke="#FF551E" stroke-width="2" />
                    </svg>
                </a>
                <?php else: ?>
                <a href="#" class="link-btn takeJobModal" data-bs-toggle="modal" data-bs-target="#takeJobModal"><?php echo __('Application Form', 'donbosco'); ?>
                  <svg xmlns="http://www.w3.org/2000/svg" width="7"height="10" viewBox="0 0 7 10" fill="none">
                    <path d="M1 1L5 5L1 9" stroke="#FF551E" stroke-width="2" />
                  </svg>
                </a>
                <?php endif; ?>

              </div>
            </div>
          </div>
        </div>
        <div class="col-6">
          <div class="service-block">
            <?php if($services['i_need_people']['imaging']):?>
            <div class="block-image">
              <a href="<?php  echo $services['i_need_people']['vacancy_link']['url']; ?>" target="<?php  echo $services['i_need_people']['vacancy_link']['target']; ?>">
              <img src="<?php echo $services['i_need_people']['imaging']['url'] ?>" alt="<?php echo $services['i_need_people']['imaging']['alt'] ?>" class="img-fluid"></div>
              </a>
            <?php endif; ?>
            <div class="block-content">
              <h3><?php echo $services['i_need_people']['title']; ?></h3>
              <p><?php echo $services['i_need_people']['texts']; ?></p>

              <div class="btn-actions">
                <?php if($services['i_need_people']['vacancy_link']): ?>
                <a href="<?php  echo $services['i_need_people']['vacancy_link']['url']; ?>" class="link-btn" target="<?php  echo $services['i_need_people']['vacancy_link']['target']; ?>"><?php  echo $services['i_need_people']['vacancy_link']['title']; ?> <svg xmlns="http://www.w3.org/2000/svg" width="7" height="10"
                    viewBox="0 0 7 10" fill="none">
                    <path d="M1 1L5 5L1 9" stroke="#FF551E" stroke-width="2" />
                  </svg></a>
                <?php endif;  if($services['i_need_people']['application_link']): ?>
                <a href="<?php  echo $services['i_need_people']['application_link']['url']; ?>" class="link-btn" target="<?php  echo $services['i_need_people']['application_link']['target']; ?>"><?php  echo $services['i_need_people']['application_link']['title']; ?> <svg xmlns="http://www.w3.org/2000/svg" width="7"
                    height="10" viewBox="0 0 7 10" fill="none">
                    <path d="M1 1L5 5L1 9" stroke="#FF551E" stroke-width="2" />
                  </svg></a>
                <?php endif; ?>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>


  <?php $vacancy = get_field('vacancies_list'); ?>



  <section class="vacancies-home">
    <div class="container">
      <div class="row">
        <div class="col-12">
          <div class="head d-flex align-items-center justify-content-md-between" data-aos="fade-right">
            <div>
              <div class="pre-title"><?php echo $vacancy['subtitle_123']?></div>
              <h2><?php echo $vacancy['title_123']?></h2>
            </div>
            <div class="d-none d-md-block">
              <img src="<?php echo get_template_directory_uri() ?>/assets/images/icons/shape-1.svg" alt="" class="img-fluid">
            </div>
          </div>
          <div class="d-flex mb-4 mb-xxl-5 flex-wrap align-items-md-end justify-content-md-between"
            data-aos="fade-right" data-aos-delay="100">
            <div class="tabs-holder">

              <?php
                  $term_ids = $vacancy['choose_category'];
                  $i = 0;
                  if (!empty($term_ids)) { ?>

                      <ul class="nav nav-tabs">
                          <li class="nav-item">
                              <button class="nav-link catnav active" id="nav-all-tab" data-bs-toggle="tab" data-bs-target="#nav-all" type="button" role="tab" aria-controls="nav-all" aria-selected="true" url="<?php echo site_url();?>/vacancies">
                                <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 22 22" fill="none">
                                  <rect x="3.14307" y="3.14282" width="6.8323" height="6.8323" rx="2" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></rect>
                                  <rect x="12.0249" y="3.14282" width="6.8323" height="6.8323" rx="2" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></rect>
                                  <rect x="12.0249" y="12.0249" width="6.8323" height="6.8323" rx="2" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></rect>
                                  <rect x="3.14307" y="12.0249" width="6.8323" height="6.8323" rx="2" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></rect>
                                </svg>
                                <?php echo  __('All', 'donbosco') ?>
                              </button>
                          </li>
                          <?php
                          foreach ($term_ids as $term_id) {
                              $term = get_term($term_id, 'job_category');
                              if ($term && !is_wp_error($term)) {

                                  $category_image = get_field('category_image', $term);
                                  ?>
                                  <li class="nav-item">
                                      <button class="nav-link catnav" id="nav-<?php echo esc_attr($term->slug); ?>-tab" data-bs-toggle="tab" data-bs-target="#nav-<?php echo esc_attr($term->slug); ?>" type="button" role="tab" aria-controls="nav-<?php echo esc_attr($term->slug); ?>" aria-selected="false" url="<?php echo site_url();?>/vacancies?catid=<?php echo $term_id?>">
                                      <img class="catimg" src="<?php echo esc_url($category_image['url']); ?>" alt="<?php echo esc_attr($term->name); ?>"> <?php echo esc_html($term->name); ?>
                                      </button>
                                  </li>
                                  <?php
                              }
                              $i++;
                          }
                          ?>
                      </ul>
                      <?php
                  } else {
                      // Handle the case where no term IDs are provided
                      echo '<p>'.__('Please select category from backend to display jobs here.', 'donbosco').'</p>';
                  }
              ?>



              
            </div>
            <a href="<?php echo site_url() ?>/vacancies?&lang=<?php echo ICL_LANGUAGE_CODE; ?>" class="link-btn seeallcat"><?php echo __('See all vacancies', 'donbosco'); ?> 
                <svg xmlns="http://www.w3.org/2000/svg" width="7" height="10" viewBox="0 0 7 10" fill="none">
                  <path d="M1 1L5 5L1 9" stroke="#FF551E" stroke-width="2" />
                </svg>
            </a>
          </div>

            <div class="tab-content" id="nav-tabContent" data-aos="fade-right" data-aos-delay="250">
                <div class="tab-pane fade show active" id="nav-all" role="tabpanel" aria-labelledby="nav-all-tab" tabindex="0">
                  <div class="swiper swiper-container vacancies-sldier">
                    <div class="swiper-wrapper">

                      <?php
                        $args = array(
                            'post_type' => 'vacancies', 
                            'posts_per_page' => 10, 
                            'post_status' => 'publish'
                        );

                        $query = new WP_Query($args);

                        if ($query->have_posts()) {
                            while ($query->have_posts()) {
                                $query->the_post();
                                get_template_part('template-parts/content', 'slidejobs');
                            }
                            wp_reset_postdata();
                        } 
                      ?>                        
                    </div>
                    <div class="action-btns">
                      <div class="swiper-pagination"></div>
                      <div class="swiper-prev"><svg xmlns="http://www.w3.org/2000/svg" width="35" height="35"
                          viewBox="0 0 35 35" fill="none">
                          <circle cx="17.5" cy="17.5" r="17" transform="matrix(-1 0 0 1 35 0)" stroke="#F56537" />
                          <path d="M19 14L15 18L19 22" stroke="#FF551E" stroke-width="2" />
                        </svg></div>
                      <div class="swiper-next"><svg xmlns="http://www.w3.org/2000/svg" width="35" height="35"
                          viewBox="0 0 35 35" fill="none">
                          <circle cx="17.5" cy="17.5" r="17" stroke="#F56537" />
                          <path d="M16 14L20 18L16 22" stroke="#FF551E" stroke-width="2" />
                        </svg> </div>

                    </div>
                  </div>
                </div>


                <!-- Terms Jobs -->

                <?php 
                
                $i = 0;
                if (!empty($term_ids)) {
                
                  foreach ($term_ids as $term_id) {
                    $term = get_term($term_id, 'job_category');
                    if ($term && !is_wp_error($term)) {?>

                    <div class="tab-pane fade" id="nav-<?php echo esc_attr($term->slug); ?>" role="tabpanel" aria-labelledby="nav-<?php echo esc_attr($term->slug); ?>-tab" tabindex="0">
                      <div class="swiper swiper-container vacancies-sldier">
                        <div class="swiper-wrapper">

                          <?php
                            $args = array(
                                'post_type' => 'vacancies', 
                                'posts_per_page' => 10, 
                                'tax_query' => array(
                                    array(
                                        'taxonomy' => 'job_category',
                                        'field' => 'term_id',
                                        'terms' => $term_id,
                                    ),
                                ),
                            );

                            $query = new WP_Query($args);

                            if ($query->have_posts()) {
                                while ($query->have_posts()) {
                                    $query->the_post();
                                    get_template_part('template-parts/content', 'slidejobs');
                                }
                                wp_reset_postdata();
                            } 
                          ?>

                          
                          
                        </div>
                        <div class="action-btns">
                          <div class="swiper-pagination"></div>
                          <div class="swiper-prev"><svg xmlns="http://www.w3.org/2000/svg" width="35" height="35"
                              viewBox="0 0 35 35" fill="none">
                              <circle cx="17.5" cy="17.5" r="17" transform="matrix(-1 0 0 1 35 0)" stroke="#F56537" />
                              <path d="M19 14L15 18L19 22" stroke="#FF551E" stroke-width="2" />
                            </svg></div>
                          <div class="swiper-next"><svg xmlns="http://www.w3.org/2000/svg" width="35" height="35"
                              viewBox="0 0 35 35" fill="none">
                              <circle cx="17.5" cy="17.5" r="17" stroke="#F56537" />
                              <path d="M16 14L20 18L16 22" stroke="#FF551E" stroke-width="2" />
                            </svg> </div>

                        </div>
                      </div>
                    </div><?php $i++;

                  }
                  }
                }
                
              ?>



          </div>
        </div>
      </div>
    </div>
  </section>


  <?php $about = get_field('about_donbosco'); ?>

  <!-- aboutUs-home start -->
  <section class="aboutUs-home">
    <div class="half-circle">
      <svg xmlns="http://www.w3.org/2000/svg" class="img-fluid" width="112" height="201" viewBox="0 0 112 201"
        fill="none">
        <path
          d="M194.5 100.5C194.495 127.025 184.27 152.459 166.078 171.21C147.887 189.961 123.219 200.494 97.5 200.5C71.7791 200.5 47.1083 189.968 28.916 171.216C10.7233 152.464 0.5 127.027 0.5 100.5C0.5 73.9736 10.7233 48.5365 28.916 29.7839C47.1083 11.0319 71.7791 0.5 97.5001 0.5C123.219 0.505585 147.887 11.0392 166.078 29.7901C184.27 48.5415 194.495 73.9754 194.5 100.5Z"
          stroke="#F56537" />
      </svg>
    </div>
    <div class="svg-left"></div>
    <div class="container">
      <div class="row">
        <div class="col-md-6" data-aos="fade">
          <div class="left mb-5 mb-md-0">
            <?php if($about['image']): ?>
            <img class="img-fluid smiling-woman" src="<?php echo $about['image']['url'] ?>" alt="about-us-home" class="<?php echo $about['image']['alt'] ?>">
            <?php endif; ?>
            <img src="<?php echo get_template_directory_uri() ?>/assets/images/icons/shape-2.svg" alt="shape-2" class="img-with-shape1">
            <img src="<?php echo get_template_directory_uri() ?>/assets/images/icons/briefcase.svg" alt="briefcase" class="img-with-shape2" data-aos="fade-up"
              data-aos-delay="100">
            <canvas id="card-work" width="266" height="186" data-aos="fade-up"></canvas>
          </div>

        </div>
        <div class="col-md-6" data-aos="fade-left">
          <div class="right">
            <div class="pre-title"><?php echo $about['subtitle'] ?></div>
            <h2><?php echo $about['title'] ?></h2>
            <p><?php echo $about['texts'] ?></p>
            <?php if($about['link']):  ?>
            <a href="<?php echo $about['link']['url'] ?>" class="btn btn-secondary" target="<?php echo $about['link']['target'] ?>"><?php echo $about['link']['title'] ?></a>
            <?php endif; ?>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- aboutUs-home end -->
  <section class="b2-counter">
    <div class="counter-line-animation top"></div>
    <canvas id="smile-rive2" width="82" height="82" class="d-none d-lg-block"></canvas>
    <canvas id="line-b2" width="110" height="71" class="d-none d-lg-block"></canvas>
    <svg xmlns="http://www.w3.org/2000/svg" width="105" height="108" viewBox="0 0 105 108" fill="none"
      class="circle-dot d-none d-xxl-block">
      <path
        d="M32 92C31.9991 96.2432 30.3131 100.312 27.3127 103.313C24.3124 106.313 20.2432 107.999 16 108C11.7566 108 7.68689 106.314 4.68631 103.314C1.68572 100.313 0 96.2435 0 92C0 87.7565 1.68572 83.6869 4.68631 80.6863C7.68689 77.6857 11.7566 76 16 76C20.2432 76.0009 24.3124 77.6869 27.3127 80.6873C30.3131 83.6877 31.9991 87.7568 32 92Z"
        fill="#FE6330" />
      <path opacity="0.1"
        d="M89.2664 89.2663C99.0176 79.5151 104.497 66.2905 104.5 52.5001L89.2664 89.2663ZM89.2664 89.2663C79.5151 99.0176 66.2904 104.497 52.5 104.5M89.2664 89.2663L52.5 104.5M52.5 104.5C38.7088 104.5 25.4824 99.0215 15.7305 89.2696M52.5 104.5L15.7305 89.2696M15.7305 89.2696C5.9786 79.5177 0.5 66.2913 0.5 52.5M15.7305 89.2696L0.5 52.5M0.5 52.5C0.5 38.7088 5.9786 25.4823 15.7305 15.7304M0.5 52.5L15.7305 15.7304M15.7305 15.7304C25.4824 5.97856 38.7087 0.500028 52.5 0.5L15.7305 15.7304ZM52.5001 0.5C66.2904 0.502934 79.5151 5.98242 89.2664 15.7337C99.0176 25.4849 104.497 38.7096 104.5 52.4999L52.5001 0.5Z"
        stroke="#F56537" />
    </svg>
    <div class="container counter">
      <div class="row">
        <div class="col-12 mb-4 mb-lg-5 text-center">
          <?php $counting_section = get_field('counters', 'option'); ?>
          <h4><?php echo $counting_section['title']; ?></h4>
        </div>
      </div>
      <div class="row">
      
      <?php

          if ($counting_section) {
              ?>
              <div class="col-6 col-md-6 col-lg" data-aos="fade-up">
                  <div class="item">
                      <canvas id="icon-calendar-rive" width="28" height="28"></canvas>
                      <div class="count" data-count="<?php echo esc_attr($counting_section['experience']['experience_count']); ?>">0+</div>
                      <div class="text"><?php echo esc_html($counting_section['experience']['texts']); ?></div>
                  </div>
              </div>

              <div class="col-6 col-md-6 col-lg" data-aos="fade-up" data-aos-delay="50">
                  <div class="item">
                      <canvas id="icon-people-b2-rive" width="28" height="28"></canvas>
                      <div class="plus count" data-count="<?php echo esc_attr($counting_section['people_we_helped']['helped_count']); ?>">0+</div>
                      <div class="text"><?php echo esc_html($counting_section['people_we_helped']['texts']); ?></div>
                  </div>
              </div>

              <div class="col-6 col-md-6 col-lg" data-aos="fade-up" data-aos-delay="100">
                  <div class="item">
                      <canvas id="icon-user-rive" width="28" height="28"></canvas>
                      <div class="count" data-count="<?php echo esc_attr($counting_section['satisfied_client']['client_count']); ?>">0+</div>
                      <div class="text"><?php echo esc_html($counting_section['satisfied_client']['texts']); ?></div>
                  </div>
              </div>

              <div class="col-6 col-md-6 col-lg" data-aos="fade-up" data-aos-delay="150">
                  <div class="item">
                      <canvas id="icon-home-rive" width="28" height="28"></canvas>
                      <div class="plus count" data-count="<?php echo esc_attr($counting_section['housing_site']['housing_count']); ?>">0+</div>
                      <div class="text"><?php echo esc_html($counting_section['housing_site']['texts']); ?></div>
                  </div>
              </div>
              <?php
          }
          ?>

      </div>
    </div>
    <div class="counter-line-animation bottom"></div>
  </section>




  <?php
  // Assuming $testimonialSection is the ACF field data
  $testimonialSection = get_field('testimonials', 'option');

  if ($testimonialSection) {
      ?>
      <section class="testimonial-wrapper" data-aos="fade-down">
          <div class="container">
              <div class="row">
                  <div class="col-12">
                      <?php if ($testimonialSection['subtitle'] || $testimonialSection['title']) : ?>
                          <div class="pre-title"><?php echo $testimonialSection['subtitle']; ?></div>
                          <h2><?php echo $testimonialSection['title']; ?></h2>
                      <?php endif; ?>
                      <?php if ($testimonialSection['testimonial_details'] && is_array($testimonialSection['testimonial_details']) && !empty($testimonialSection['testimonial_details'])) : ?>
                          <div class="swiper swiper-container testimonial-sldier">
                              <div class="swiper-wrapper">
                                  <?php foreach ($testimonialSection['testimonial_details'] as $testimonial) : ?>
                                      <div class="swiper-slide">
                                          <div class="t-item">
                                              <?php if ($testimonial['testimonial']) : ?>
                                                  "<?php echo esc_html($testimonial['testimonial']); ?>"
                                              <?php endif; ?>
                                              <?php if ($testimonial['client_name'] || $testimonial['designation']) : ?>
                                                  <div class="reviewer">
                                                      <?php if ($testimonial['client_image']) : ?>
                                                          <div class="image"><img src="<?php echo esc_url($testimonial['client_image']['url']); ?>" alt="reviewer"></div>
                                                      <?php endif; ?>
                                                      <div><strong><?php echo esc_html($testimonial['client_name']); ?>,</strong> <?php echo esc_html($testimonial['designation']); ?></div>
                                                  </div>
                                              <?php endif; ?>
                                          </div>
                                      </div>
                                  <?php endforeach; ?>
                              </div>
                              <div class="btn-action">
                                  <div class="swiper-pagination"></div>
                              </div>
                              
                          <?php endif; ?>
                      </div>


                    <?php
                    $google_review = get_field('google_review', 'option');

                    if ($google_review) { 
                        $rating = $google_review['rating'];
                        $number_of_reviews = $google_review['number_of_reviews'];
                        $google_review_link = $google_review['google_review_link'];
                        ?>

                        <div class="google-review d-flex col-12">
                            <div>
                                <div><?php echo str_replace('.', ',', $rating) ?>/5</div>
                            </div>
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
                                <a href="<?php echo $google_review_link; ?>" target="_blank"> <?php echo $number_of_reviews; ?> google reviews</a>
                            </div>
                        </div>
                    <?php } ?>


                  </div>
              </div>
          </div>
      </section>
      <?php
  }
  ?>




  <?php $faqs = get_field('faq_section'); ?>
  <section class="faq-home">
    <div class="container">
      <div class="row">
        <div class="col-lg-6" data-aos="fade-right">
          <div class="faq-left mb-5 mb-lg-0">
            <div class="div-title">
              <h3><?php echo $faqs['certificate_title']; ?></h3>
            </div>
            <div class="certificates-list">
                <ul>

                  <?php 
                  $certificates = get_field('certificates', 'option'); 
                  $link = $faqs['link_to_certificate_page'];
                  
                  if($certificates): foreach($certificates as $item) :?>
                  <li>
                      <a href="<?php echo $link['url']; ?>" target="<?php echo $link['target']; ?>">
                        <img src="<?php echo $item['certificate_image']['url']?>" alt="<?php echo $item['certificate_image']['alt']?>">
                        <div>
                          <h5 class="name"><?php echo $item['certificate_title']?></h5>
                          <p><?php echo $item['certificate_details']?></p>
                        </div>
                      </a>
                  </li>
                  <?php endforeach; endif; ?>

                  <!-- <li>
                    <img src="https://i.postimg.cc/xNJ9kc1k/certificate-2.png" alt="">
                    <div>
                      <h5 class="name">SNF</h5>
                      <p>donbosco is in possession of the Stichting Normering Flexwonen (Flexible Living Standards Foundation) certification. </p>
                    </div>
                  </li>
                  <li>
                    <img src="https://i.postimg.cc/HjVYvP9p/certificate-3.png" alt="">
                    <div>
                      <h5 class="name">Fair Produce</h5>
                      <p>Fair Produce is a certification program focusing on fair and ethical labour practices within mushroom production in the Netherlands.</p>
                    </div>
                  </li>
                  <li>
                    <img src="https://i.postimg.cc/1nY95psh/certificate-4.png" alt="">
                    <div>
                      <h5 class="name">KWF Dutch Cancer Society</h5>
                      <p>KWF Dutch Cancer Society is a nation-wide organization for cancer related work in the Netherlands.</p>
                    </div>
                  </li>
                  <li>
                    <img src="https://i.postimg.cc/8s912BZL/certificate-5.png" alt="">
                    <div>
                      <h5 class="name">Samenwerkingsorganisatie Beroepsonderwijs Bedrijfsleven (SBB)</h5>
                      <p>SBB is the Dutch organization that promotes cooperation between vocational education and business.</p>
                    </div>
                  </li> -->
                </ul>
            </div>
            <?php 
            
            if($link){?>
                <a href="<?php echo $link['url']; ?>" class="link-btn" target="<?php echo $link['target']; ?>"><?php echo $link['title']; ?> <svg xmlns="http://www.w3.org/2000/svg" width="7" height="10" viewBox="0 0 7 10" fill="none">
                    <path d="M1 1L5 5L1 9" stroke="#FF551E" stroke-width="2"></path>
                  </svg>
                </a>
            <?php } ?>
            <!-- <div class="address-holder d-flex justify-content-between">
              <div class="left">
                <?php 
                
                $whatsapp = get_field('whatsapp', 'option');
                $email = get_field('email', 'option');
                $location = get_field('location', 'option');
                
                ?>
              <ul>
                <?php if (!empty($location)) : ?>
                    <li>
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none">
                            <path d="M7.5 11.8374C4.58917 12.2382 2.5 13.3141 2.5 14.5832C2.5 16.1941 5.8575 17.4999 10 17.4999C14.1425 17.4999 17.5 16.1941 17.5 14.5832C17.5 13.3141 15.4108 12.2382 12.5 11.8374" stroke="#FF551E" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                            <path d="M10.0002 14.1667V7.5" stroke="#FF551E" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                            <path d="M11.7678 3.23223C12.7441 4.20854 12.7441 5.79146 11.7678 6.76776C10.7915 7.74407 9.20854 7.74407 8.23223 6.76776C7.25592 5.79146 7.25592 4.20854 8.23223 3.23223C9.20854 2.25592 10.7915 2.25592 11.7678 3.23223" stroke="#FF551E" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                        </svg> <?php echo esc_html($location); ?>
                    </li>
                <?php endif; ?>

                <?php if (!empty($whatsapp)) : ?>
                    <li>
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none">
                            <path fill-rule="evenodd" clip-rule="evenodd" d="M15.1698 4.80187C13.7981 3.42938 11.974 2.67271 10.0306 2.67188C6.02479 2.67188 2.76563 5.92937 2.76479 9.93354C2.76313 11.2077 3.09729 12.4602 3.73396 13.5644L2.70312 17.3277L6.55479 16.3177C7.62063 16.8977 8.81396 17.2019 10.0273 17.2019H10.0306C14.0348 17.2019 17.294 13.9435 17.2956 9.93937C17.2965 7.99937 16.5415 6.17521 15.1698 4.80187Z" stroke="#FF551E" stroke-width="1.3" stroke-linecap="round" stroke-linejoin="round"></path>
                            <path d="M10.9121 11.2999L11.2504 10.9641C11.5613 10.6558 12.0529 10.6166 12.4113 10.8683C12.7579 11.1116 13.0713 11.3299 13.3629 11.5333C13.8263 11.8549 13.8821 12.5149 13.4829 12.9133L13.1838 13.2124" stroke="#FF551E" stroke-width="1.3" stroke-linecap="round" stroke-linejoin="round"></path>
                            <path d="M6.78711 6.81583L7.08628 6.51666C7.48461 6.11833 8.14461 6.17416 8.46628 6.63666C8.66878 6.92833 8.88711 7.24166 9.13128 7.58833C9.38294 7.94666 9.34461 8.43833 9.03544 8.74916L8.69961 9.08749" stroke="#FF551E" stroke-width="1.3" stroke-linecap="round" stroke-linejoin="round"></path>
                            <path d="M13.1841 13.2126C11.9499 14.4409 9.87578 13.3976 8.23828 11.7593" stroke="#FF551E" stroke-width="1.3" stroke-linecap="round" stroke-linejoin="round"></path>
                            <path d="M8.24006 11.7618C6.60256 10.1234 5.55922 8.05008 6.78756 6.81592" stroke="#FF551E" stroke-width="1.3" stroke-linecap="round" stroke-linejoin="round"></path>
                            <path d="M8.7002 9.0874C8.96603 9.50657 9.30686 9.92157 9.69186 10.3066L9.69353 10.3082C10.0785 10.6932 10.4935 11.0341 10.9127 11.2999" stroke="#FF551E" stroke-width="1.3" stroke-linecap="round" stroke-linejoin="round"></path>
                        </svg> <a href="https://wa.me/<?php echo extractDigits(esc_attr($whatsapp)); ?>" target="_blank"><?php echo esc_html($whatsapp); ?></a>
                    </li>
                <?php endif; ?>

                <?php if (!empty($email)) : ?>
                    <li>
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none">
                            <path fill-rule="evenodd" clip-rule="evenodd" d="M12.8119 10.5982L16.5669 8.05234C17.151 7.65734 17.5002 6.99817 17.5002 6.29317V6.29317C17.5002 5.11817 16.5485 4.1665 15.3744 4.1665H4.63853C3.46436 4.1665 2.5127 5.11817 2.5127 6.29234V6.29234C2.5127 6.99734 2.86186 7.6565 3.44603 8.05234L7.20103 10.5982C8.8952 11.7465 11.1177 11.7465 12.8119 10.5982V10.5982Z" stroke="#FF551E" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                            <path d="M2.5 6.29248V14.1666C2.5 15.5475 3.61917 16.6666 5 16.6666H15C16.3808 16.6666 17.5 15.5475 17.5 14.1666V6.29331" stroke="#FF551E" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                        </svg> <a href="mailto:<?php echo esc_attr($email); ?>"><?php echo esc_html($email); ?></a>
                    </li>
                <?php endif; ?>
              </ul>

              </div>
              <div class="right">
                <canvas id="quadrados-b2" width="150" height="134"></canvas>

              </div>
            </div> -->

          </div>
        </div>
        <div class="col-lg-6" data-aos="fade-left">
          <div class="div-title">
              <h3><?php echo $faqs['title']; ?></h3>
            </div>
          <div class="accordion" id="b2-faq">
          <?php
            $faq_args = array(
                'post_type'      => 'faq',
                'posts_per_page' => 7,
                'orderby'        => 'rand',
            );

            $faq_query = new WP_Query($faq_args);

            if ($faq_query->have_posts()) : $i = 0;
                while ($faq_query->have_posts()) : $faq_query->the_post();
                    $faq_id        = get_the_ID();
                    $translated_id = icl_object_id($faq_id, 'faq', true, ICL_LANGUAGE_CODE);

                    if ($translated_id) {
                        $faq_id = $translated_id;
                    }
                    ?>
                    <div class="accordion-item">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq-<?php echo esc_attr($faq_id); ?>" aria-expanded="<?php echo ($i != 0) ? 'false' : 'true' ?>" aria-controls="faq-<?php echo esc_attr($faq_id); ?>">
                                <?php the_title(); ?>
                            </button>
                        </h2>
                        <div id="faq-<?php echo esc_attr($faq_id); ?>" class="accordion-collapse collapsed collapse <?php // echo ($i != 0) ? '' : 'show' ?>" data-bs-parent="#b2-faq">
                            <div class="accordion-body">
                                <?php the_content(); ?>
                            </div>
                        </div>
                    </div><?php
                    $i++;
                endwhile;
                wp_reset_postdata();
            else :
                echo '<p>No FAQ items found.</p>';
            endif;
            ?>

            
          </div>
          <?php $link =  $faqs['link']; if($link) :?>
              <a href="<?php echo $link['url']?>" class="link-btn" target="<?php echo $link['target']?>"><?php echo $link['title']?> <svg xmlns="http://www.w3.org/2000/svg" width="7" height="10" viewBox="0 0 7 10" fill="none">
                    <path d="M1 1L5 5L1 9" stroke="#FF551E" stroke-width="2"></path>
                  </svg>
              </a>
          <?php endif; ?>
        </div>
      </div>
    </div>
  </section>

  <?php $clients = get_field('client_logo', 'option'); ?>
  <section class="b2-clients text-center" data-aos="fade-up" data-aos-delay="200">
    <div class="container">
    <h4 class="foto-note"><?php echo $clients['bottom_title']; ?></h4>
      <div class="swiper clients-logo">
        <div class="swiper-wrapper">
          <?php  if($clients['logos']): foreach($clients['logos'] as $clientlogo): ?>
            <div class="swiper-slide"><img src="<?php echo $clientlogo['logo_upload']['url'];  ?>" alt="<?php echo $clientlogo['logo_upload']['alt'];  ?>"></div>
          <?php endforeach; endif; ?>
        </div>

      </div>
      
    </div>
  </section>
<?php get_footer(); ?>


<div class="modal fade" id="takeJobModal" tabindex="-1" aria-labelledby="#takeJobModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-fullscreen-lg-down">
      <div class="modal-content">
        <div class="modal-header px-lg-5 pt-lg-5">
          <h1 class="modal-title fs-5" id="#takeJobModalLabel"><?php echo __('Apply for the job', 'donbosco'); ?></h1>
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
              <label for="firstname" class="form-label"><?php echo __('First name', 'donbosco');?> <span>(<?php echo __('Required', 'donbosco');?>)</span></label>
              <input type="text" class="form-control" id="firstname" name="firstname" placeholder="" required>
            </div>

            <div class="col-md-6">
              <label for="lastname" class="form-label"><?php echo __('Last name', 'donbosco');?> <span>(<?php echo __('Required', 'donbosco');?>)</span></label>
              <input type="text" class="form-control" id="lastname" placeholder="" name="lastname" required>
            </div>
            <div class="col-md-6">
              <label for="lastname" class="form-label"><?php echo __('Date of birth', 'donbosco');?> <span>(<?php echo __('Required', 'donbosco');?>)</span></label>
              <input type="text" class="form-control datepicker" id="dateOfBirth" placeholder="" name="dateOfBirth" required maxlength="10" data-valid="false">
            </div>

            <!-- <div class="col-md-6">
              <label for="dob" class="form-label">Date of birth <span>(Required)</span></label>
              <input type="text" class="form-control datepicker" id="dob" name="dob" placeholder="Date of birth" required>
            </div> -->

            <div class="col-md-6">
              <label for="phone" class="form-label"><?php echo __('Phone', 'donbosco');?> <span>(<?php echo __('Required', 'donbosco');?>)</span></label>
              <input type="text" class="form-control" id="phone" name="phone" placeholder="" required>
            </div>

            <div class="col-md-6">
              <label for="email" class="form-label"><?php echo __('E-mail address', 'donbosco');?> <span>(<?php echo __('Required', 'donbosco');?>)</span></label>
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
              <label for="availTo" class="form-label"><?php echo __('Current postion', 'donbosco');?></label>
              <input type="text" class="form-control" id="currentPosition" name="currentPosition" placeholder="">
            </div>

            <div class="col-md-6">
              <label for="availTo" class="form-label"><?php echo __('Current employer', 'donbosco');?></label>
              <input type="text" class="form-control" id="currentEmployer" name="currentEmployer" placeholder="">
            </div>

            <!-- <div class="col-md-6">
              <label for="availTo" class="form-label"><?php echo __('Skype', 'donbosco');?></label>
              <input type="text" class="form-control" id="skype" name="skype" placeholder="">
            </div>
            <div class="col-md-6">
              <label for="availTo" class="form-label"><?php echo __('LinkedIn', 'donbosco');?></label>
              <input type="text" class="form-control" id="linkedIn" name="linkedin" placeholder="">
            </div>
            <div class="col-md-6">
              <label for="availTo" class="form-label"><?php echo __('Facebook', 'donbosco');?></label>
              <input type="text" class="form-control" id="facebook" name="facebook" placeholder="">
            </div>
            <div class="col-md-6">
              <label for="availTo" class="form-label"><?php echo __('Instagram', 'donbosco');?></label>
              <input type="text" class="form-control" id="instagram" name="instagram" placeholder="">
            </div>
            <div class="col-md-6">
              <label for="availTo" class="form-label"><?php echo __('Twitter', 'donbosco');?></label>
              <input type="text" class="form-control" id="twitter" name="twitter" placeholder="">
            </div>
            <div class="col-md-6">
              <label for="availTo" class="form-label"><?php echo __('Website', 'donbosco');?></label>
              <input type="text" class="form-control" id="website" name="website" placeholder="">
            </div>
            <div class="col-md-6">
              <label for="availTo" class="form-label"><?php echo __('Blog', 'donbosco');?></label>
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
              <label class="form-label">Do you have your own accommodation, or do you need accommodation from donbosco?</label>
              <div class="input-group">
                <select class="form-select" aria-label="Default select example" name="accommodation">
                  <option selected>Select an option</option>
                  <option value="Own">Own</option>
                  <option value="donbosco">donbosco</option>
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
              <label for="textArea" class="form-label"><?php echo __('Motivation', 'donbosco'); ?></label>
              <textarea class="form-control" id="textArea" rows="5" name="motivation" placeholder=""></textarea>
            </div>

            <div class="col-12">
              <div class='file-input'>
                <input type='file' name="resume" id="resume">
                <span class='label uploadlabel' data-js-label><img src="<?php echo get_template_directory_uri(); ?>/assets/images/icons/i-upload.svg" alt="i-upload"> <?php echo __('Upload CV', 'donbosco'); ?></span>
                <span class='btn btn-secondary'><?php echo __('Select', 'donbosco'); ?></span>
              </div>
              <span><?php echo __('Select a resume .pdf of .doc file max 5mb', 'donbosco'); ?></span>
            </div>

            <!-- <div class="col-6">
              <div class='file-input'>
                <input type='file' name="cover" id="cover">
                <span class='label uploadlabel' data-js-label><img src="<?php echo get_template_directory_uri(); ?>/assets/images/icons/i-upload.svg" alt="i-upload"> Upload Cover</span>
                <span class='btn btn-secondary'>Select</span>
              </div>
              <span><?php echo __('Slect a cover letter pdf or doc file max 5 MB', 'donbosco'); ?></span>
            </div> -->

            <!-- <div class="col-6">
              <div class='file-input'>
                <input type='file' name="photo" id="photo">
                <span class='label uploadlabel' data-js-label><img src="<?php echo get_template_directory_uri(); ?>/assets/images/icons/i-upload.svg" alt="i-upload"> Upload Photo</span>
                <span class='btn btn-secondary'>Select</span>
              </div>
              <span><?php echo __('Select a photo jpg, jpeg or png file max 1 MB', 'donbosco'); ?></span>
            </div> -->

            <div class="col-lg-9">
              <div class="form-check">
                <input class="form-check-input" type="checkbox" id="gridCheck" name="gridCheck" required>
                <label class="ms-3 form-check-label" for="gridCheck">
                <?php echo __('By sending this contact form you give us permission to process your (personal) data. We handle your personal data carefully.', 'donbosco'); ?>
                </label>
              </div>
            </div>

            <input type="hidden" id="honeypot" name="honeypot" value="">
            <input type="hidden" id="honeypot" name="<?php echo __('Apply now', 'donbosco'); ?>" value="">

            <div class="col-12 mt-5">
              <button type="submit" class="btn btn-secondary submit-btn"><?php echo __('Send', 'donbosco'); ?></button>
              <div class="loader btn-secondary send-loader"></div>
            </div>
          </form>
          </div>
        </div>
        
      </div>
    </div>
  </div>

<script>
  $(document).ready(function(){
    const b2Logo = initializeRive("<?php echo get_template_directory_uri();?>/assets/rive/main-logo.riv", "main-logo", "b2Logo");
    const r3 = initializeRive("<?php echo get_template_directory_uri();?>/assets/rive/smile-rive.riv", "smile-rive", "r3");
    const r1 = initializeRive("<?php echo get_template_directory_uri();?>/assets/rive/hero-animation.riv", "hero-animation", "r1");
    // const r2 = initializeRive("<?php echo get_template_directory_uri();?>/assets/rive/play-button.riv", "play-button", "r2");
    // const r7 = initializeRive("<?php echo get_template_directory_uri();?>/assets/rive/quadrados-b2.riv", "quadrados-b2", "r7");
    // const r6 = initializeRive("<?php echo get_template_directory_uri();?>/assets/rive/line-white.riv", "white-line", "r6");
    // const rPeople = initializeRive("<?php echo get_template_directory_uri();?>/assets/rive/icon-people-b2.riv", "icon-people-rive", "rPeople");

    <?php if( ICL_LANGUAGE_CODE != 'nl'): ?>
        const r4 = initializeRive("<?php echo get_template_directory_uri();?>/assets/rive/card-work-b2.riv", "card-work", "r4");
    <?php else: ?>
        const r4 = initializeRive("<?php echo get_template_directory_uri();?>/assets/rive/card-work-dutch.riv", "card-work", "r4");
    <?php endif; ?>

    const r5 = initializeRive("<?php echo get_template_directory_uri();?>/assets/rive/smile-rive.riv", "smile-rive2", "r5");
    const r8 = initializeRive("<?php echo get_template_directory_uri();?>/assets/rive/line-b2.riv", "line-b2", "r8");
    const rHome = initializeRive("<?php echo get_template_directory_uri();?>/assets/rive/icon-home.riv", "icon-home-rive", "rHome");
    const rUser = initializeRive("<?php echo get_template_directory_uri();?>/assets/rive/icon-user.riv", "icon-user-rive", "rUser");
    const rCalendar = initializeRive("<?php echo get_template_directory_uri();?>/assets/rive/icon-calendar.riv", "icon-calendar-rive", "rCalendar");
    const rPeople = initializeRive("<?php echo get_template_directory_uri();?>/assets/rive/icon-people-b2.riv", "icon-people-b2-rive", "rPeople");
  });
</script>