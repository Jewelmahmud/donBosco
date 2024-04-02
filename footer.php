<?php if (!is_front_page() && !is_home() && !is_404() && !is_page_template('templates/contact.php') && !is_page_template('templates/company.php')) : ?>
<?php $info = get_field('footer_info_section', 'option'); ?>
<section class="need-help-banner">
  <div class="shape-right">
    <img src="<?php echo get_template_directory_uri(); ?>/assets/images/icon_scr.svg" alt="svg image">
  </div>
    <canvas id="logo-b2-white" width="100px" height="100px" data-aos="fade"></canvas>
    <div class="container"><div class="row">
      <div class="col-md-7">
        <div class="left" data-aos="fade-right">
          <h2><?php echo $info['title']; ?></h2>
          <p><?php echo $info['description']; ?></p>
          <?php if($info['link']):?>
          <a href="<?php echo $info['link']['url'] ?>" class="btn btn-secondary" target="<?php echo $info['link']['target'] ?>"><?php echo $info['link']['title'] ?></a>
          <?php endif; ?>
        </div>
      </div>
    </div></div>
    <?php if ($info['image']): ?>
    <div class="image-right" style="background-image: url(<?php echo $info['image']['url']; ?>);"></div>
    <?php endif; ;?>
    <canvas id="smile-rive3" class="d-none d-lg-block ani3" width="82"px height="82"></canvas>
    <canvas id="line-white" class="d-none d-lg-block" width="108px" height="70px"></canvas>
  </section>
<?php endif; ?>

<footer>
    <div class="footer-top">
      <div class="container">
        <div class="row align-items-center">
          <div class="col-6">
            <?php 
            $current_language = apply_filters('wpml_current_language', NULL);
            $footerlogo = get_field('logo', 'option');
            if($footerlogo): ?>
            <a href="<?php echo site_url()."?lang=".$current_language; ?>">
            <img src="<?php echo $footerlogo['url'] ?> " alt="<?php echo $footerlogo['alt'] ?>" class="footer-logo">
            </a>
            <?php endif; ?>
          </div>
          <div class="col-6">

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
        <div class="row contact-holder">
          <div class="col-12">
            <?php 
            
              $footertitles =  get_field('footer_contact_section', 'option');
            
            ?>
            <h5 class="toggle"><?php echo ($footertitles['main_section_title'])? $footertitles['main_section_title'] : 'Contact'; ?></h5>
            <div class="row collapse-div justify-content-between align-items-end">
              <div class="col-lg-6 col-xl-auto">
                <div class="title"><?php echo (isset($footertitles['main_section_title']))? $footertitles['location_title'] : 'Location'; ?></div>
                <div class="content">
                <?php 
                  $location = get_field('location', 'option'); 
                  if($location):
                ?>
                  <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20"  fill="none">
                    <path d="M7.5 11.8374C4.58917 12.2382 2.5 13.3141 2.5 14.5832C2.5 16.1941 5.8575 17.4999 10 17.4999C14.1425 17.4999 17.5 16.1941 17.5 14.5832C17.5 13.3141 15.4108 12.2382 12.5 11.8374"   stroke="#FF551E" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                    <path d="M10.0002 14.1667V7.5" stroke="#FF551E" stroke-width="1.5" stroke-linecap="round"  stroke-linejoin="round" />
                    <path d="M11.7678 3.23223C12.7441 4.20854 12.7441 5.79146 11.7678 6.76776C10.7915 7.74407 9.20854 7.74407 8.23223 6.76776C7.25592 5.79146 7.25592 4.20854 8.23223 3.23223C9.20854 2.25592 10.7915 2.25592 11.7678 3.23223" stroke="#FF551E" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                  </svg> <?php echo $location; ?>
                <?php endif; ?>
                </div>

              </div>
              <div class="col-lg-6 col-xl-auto">
                <?php 
                  $whatsapp = get_field('whatsapp', 'option'); 
                  if($whatsapp): ?>
                    <div class="title"><?php echo ($footertitles['main_section_title'])? $footertitles['phone_title'] : 'Phone number'; ?></div>
                    <div class="content">
                    <svg xmlns="http://www.w3.org/2000/svg" width="17" height="17" viewBox="0 0 17 17" fill="none">
                    <path d="M10.1133 10.8705L10.7747 10.214C11.3823 9.61126 12.3434 9.5347 13.0438 10.0267C13.7215 10.5023 14.334 10.9291 14.9041 11.3266C15.8099 11.9554 15.919 13.2455 15.1387 14.0242L14.5539 14.609" stroke="#FF551E" stroke-width="1.3" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M2.05078 2.10512L2.63559 1.52031C3.41425 0.741655 4.7044 0.850798 5.33319 1.75489C5.72904 2.32503 6.15583 2.93753 6.63313 3.61519C7.12508 4.31566 7.05015 5.27676 6.44579 5.88437L5.78931 6.54574" stroke="#FF551E" stroke-width="1.3" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M14.5548 14.6095C12.1422 17.0106 8.08768 14.9711 4.88672 11.7686" stroke="#FF551E" stroke-width="1.3" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M4.89013 11.7733C1.68917 8.57068 -0.350324 4.51776 2.05081 2.10522" stroke="#FF551E" stroke-width="1.3" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M5.78711 6.54614C6.30676 7.36552 6.97301 8.17676 7.72561 8.92935L7.72886 8.93261C8.48146 9.6852 9.29269 10.3515 10.1121 10.8711" stroke="#FF551E" stroke-width="1.3" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg> <a href="tel: <?php echo $whatsapp; ?>"><?php echo $whatsapp; ?></a>
                    </div>
                  <?php endif; ?>
              </div>
              
              <div class="col-lg-6 col-xl-auto">
              <?php 
              
                $email = get_field('email', 'option'); 
                if($email):?>
                  <div class="title"><?php echo ($footertitles['main_section_title'])? $footertitles['email_title'] : 'Email'; ?></div>
                  <div class="content">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none">
                      <path fill-rule="evenodd" clip-rule="evenodd"
                        d="M12.8119 10.5982L16.5669 8.05234C17.151 7.65734 17.5002 6.99817 17.5002 6.29317V6.29317C17.5002 5.11817 16.5485 4.1665 15.3744 4.1665H4.63853C3.46436 4.1665 2.5127 5.11817 2.5127 6.29234V6.29234C2.5127 6.99734 2.86186 7.6565 3.44603 8.05234L7.20103 10.5982C8.8952 11.7465 11.1177 11.7465 12.8119 10.5982V10.5982Z"
                        stroke="#FF551E" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                      <path
                        d="M2.5 6.29248V14.1666C2.5 15.5475 3.61917 16.6666 5 16.6666H15C16.3808 16.6666 17.5 15.5475 17.5 14.1666V6.29331"
                        stroke="#FF551E" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                    </svg> <a href="mailto:<?php echo $email;  ?>"><?php echo $email;  ?></a>
                  </div>
                <?php endif; ?>
              </div>
              
              <div class="col-lg-6 col-xl-auto">
                <div class="title"><?php echo ($footertitles['main_section_title'])? $footertitles['working_hour_title'] : 'Open hours'; ?></div>
                <?php 
                  $openhours = get_field('open_hour', 'option'); 
                  if($openhours) echo '<div class="content"><svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M5.93941 1.61095C10.0202 -0.0796945 14.6984 1.85895 16.389 5.93978C18.0797 10.0206 16.1411 14.6988 12.0602 16.3894C7.97938 18.0801 3.30122 16.1414 1.61058 12.0606C-0.0791781 7.97976 1.85857 3.30159 5.93941 1.61095" stroke="#FF551E" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M8.74902 5.43115V9.56532L11.9988 11.5466" stroke="#FF551E" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                    '.$openhours.'</div>';
                ?>
                

              </div>
            </div>
          </div>

        </div>
      </div>
      <hr>
      <div class="container">
        <div class="row">
          <div class="col-xl-6">
            <?php 
              $menu_location = 'footer_menu_1';
              $menu_locations = get_nav_menu_locations();

              if (isset($menu_locations[$menu_location])) {

                  $menu_term_id = $menu_locations[$menu_location];
                  $menu_term = get_term($menu_term_id, 'nav_menu');

                  if ($menu_term && !is_wp_error($menu_term)) {
                    
                      $menu_name = $menu_term->name;
                      $menu_object = wp_get_nav_menu_object($menu_name);

                      if ($menu_object) {
                          $menu_description = esc_html($menu_object->description);

                          echo '<h5 class="toggle">' . esc_html($menu_name) . '</h5>';
                          echo '<div class="collapse-div">';
                          wp_nav_menu(array(
                              'theme_location' => $menu_location,
                              'container'      => false,
                              'menu_class'     => 'column-count',
                          ));
                          echo '</div>';
                      } else {
                          echo '<p>Menu not found: ' . esc_html($menu_name) . '</p>';
                      }
                  } else {
                      echo '<p>Error getting menu term.</p>';
                  }
              } else {
                  echo '<p>Menu location not found: ' . esc_html($menu_location) . '</p>';
              }
            
            ?>
          </div>
          <div class="col-xl-6">
          <?php 
              $menu_location = 'footer_menu_2';
              $menu_locations = get_nav_menu_locations();

              if (isset($menu_locations[$menu_location])) {

                  $menu_term_id = $menu_locations[$menu_location];
                  $menu_term = get_term($menu_term_id, 'nav_menu');

                  if ($menu_term && !is_wp_error($menu_term)) {
                    
                      $menu_name = $menu_term->name;
                      $menu_object = wp_get_nav_menu_object($menu_name);

                      if ($menu_object) {
                          $menu_description = esc_html($menu_object->description);

                          echo '<h5 class="toggle">' . esc_html($menu_name) . '</h5>';
                          echo '<div class="collapse-div">';
                          wp_nav_menu(array(
                              'theme_location' => $menu_location,
                              'container'      => false,
                              'menu_class'     => 'column-count',
                          ));
                          echo '</div>';
                      } else {
                          echo '<p>Menu not found: ' . esc_html($menu_name) . '</p>';
                      }
                  } else {
                      echo '<p>Error getting menu term.</p>';
                  }
              } else {
                  echo '<p>Menu location not found: ' . esc_html($menu_location) . '</p>';
              }
            
            ?>
          </div>
        </div>
      </div>
    </div>
    <div class="footer-bottom">
      <div class="container">
        <div class="row align-items-center">

          <ul class="left col-lg-4">
          <?php if(get_field('copyright_texts', 'option')): ?>
            <li><a href="<?php echo site_url(); ?>"><?php the_field('copyright_texts', 'option'); ?></a></li>
          <?php endif; ?>

            <?php 
              wp_nav_menu(array(
                'theme_location' => 'footer_bottom',
                'container'      => false,
                'items_wrap'     => '%3$s', // This removes the outer container
                'walker'         => new Footer_nav_walker(),
              ));
            ?>
          </ul>
          

          <?php
            $google_review = get_field('google_review', 'option');

            if ($google_review) { 
                $rating = $google_review['rating'];
                $number_of_reviews = $google_review['number_of_reviews'];
                $google_review_link = $google_review['google_review_link'];
                ?>

                <div class="middle d-flex col-lg-4">
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

            <?php
            // Assuming $partners_logos is the variable containing the ACF repeater field data
            $partners_logos = get_field('pratners_logo', 'option');

            if ($partners_logos) { ?>
                <ul class="right col-lg-4">
                    <?php foreach ($partners_logos as $partner_logo) { ?>
                        <li>
                            <img src="<?php echo esc_url($partner_logo['logo']['url']); ?>" alt="Partner Logo">
                        </li>
                    <?php } ?>
                </ul>
            <?php } ?>

        </div>
      </div>
    </div>
  </footer>
  <div class="responsive-footer-nav-holder">
  <?php $mobile_footer_buttons = get_field('mobile_footer_buttons', 'option'); ?>

    <ul>
        <?php if ($mobile_footer_buttons && !empty($mobile_footer_buttons['direct_call'])) : ?>

            <li>
                <a href="tel:<?php echo $mobile_footer_buttons['direct_call']; ?>">
                    <div class="icon-holder">
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/images/icons/icon-direct.svg" alt="icon">
                    </div>
                    <div class="text-holder">
                      <?php echo $mobile_footer_buttons['phone_number_title']; ?>
                    </div>
                </a>
            </li>
        <?php endif; ?>

        <?php if ($mobile_footer_buttons && !empty($mobile_footer_buttons['mediation']['url'])) : ?>
            <li>
                <a href="<?php echo esc_url($mobile_footer_buttons['mediation']['url']); ?>">
                    <div class="icon-holder">
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/images/icons/icon-mediation.svg" alt="icon">
                    </div>
                    <div class="text-holder">
                        <?php echo esc_html($mobile_footer_buttons['mediation']['title']); ?>
                    </div>
                </a>
            </li>
        <?php endif; ?>

        <?php if ($mobile_footer_buttons && !empty($mobile_footer_buttons['vacancies']['url'])) : ?>
            <li>
                <a href="<?php echo esc_url($mobile_footer_buttons['vacancies']['url']); ?>">
                    <div class="icon-holder">
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/images/icons/icon-familie.svg" alt="icon">
                    </div>
                    <div class="text-holder">
                        <?php echo esc_html($mobile_footer_buttons['vacancies']['title']); ?>
                    </div>
                </a>
            </li>
        <?php endif; ?>

        <?php if ($mobile_footer_buttons && !empty($mobile_footer_buttons['contact']['url'])) : ?>
            <li>
                <a href="<?php echo esc_url($mobile_footer_buttons['contact']['url']); ?>">
                    <div class="icon-holder">
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/images/icons/icon-contact.svg" alt="icon">
                    </div>
                    <div class="text-holder">
                        <?php echo esc_html($mobile_footer_buttons['contact']['title']); ?>
                    </div>
                </a>
            </li>
        <?php endif; ?>
    </ul>


  </div>
  <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/pikaday/1.6.0/pikaday.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

  <!-- swiper slider js -->
  <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/jquery.magnific-popup.min.js"></script>
  <script src="https://unpkg.com/aos@next/dist/aos.js"></script>
  <script src="https://unpkg.com/isotope-layout@3/dist/isotope.pkgd.min.js"></script>
  <script src="<?php echo get_template_directory_uri() ?>/assets/js/imagesloaded.pkgd.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.1/dist/sweetalert2.all.min.js"></script>
  <script src="<?php echo get_template_directory_uri() ?>/assets/js/main.js"></script>

  <?php if(is_page_template('templates/contact.php')): ?>
  <script src="<?php echo get_template_directory_uri() ?>/assets/js/mapbox.js"></script>
  <?php endif; ?>

  <?php 
  wp_footer(); 
  $current_language = apply_filters('wpml_current_language', NULL);    
  ?>

  <script>

    $('.favorites, .fav-nav').click(function (e) {
        e.preventDefault();

        var favoriteJobsLocal = JSON.parse(localStorage.getItem('favorite_jobs_local_'+sitelang));
        var urlWithParameters = "<?php echo site_url().'/vacancies?favorites=1&job_ids='?>" + encodeURIComponent(JSON.stringify(favoriteJobsLocal))+'&lang=<?php echo $current_language; ?>';
        window.location.href = urlWithParameters;

    });

    $('.clear-filter').click(function(){
        let url = '<?php echo site_url()."/vacancies" ?>?lang='+sitelang;
        window.location.href = url;
    });

    $('.lang-selector ul li a').click(function (e) {
      
        e.preventDefault();
        let langurl = $(this).attr('href');
        let langcode = $(this).attr('data-lang');
        let currentUrl = window.location.href;   
        let url;

        if (currentUrl.includes('favorites')) { 
            var favoriteJobsLocal = JSON.parse(localStorage.getItem('favorite_jobs_local_'+langcode));
                console.log('Fav: ' +favoriteJobsLocal);
                url = "<?php echo site_url().'/vacancies?favorites=1&job_ids='?>" + encodeURIComponent(JSON.stringify(favoriteJobsLocal))+'&lang='+langcode;
        }else {
          url = langurl;
        
        }


        window.location.href = url;

    });
    
    <?php if (!is_home() && !is_front_page() && !is_page() && !is_single()) { ?>
    const b2Logo = initializeRive("<?php echo get_template_directory_uri();?>/assets/rive/main-logo.riv", "main-logo", "b2Logo");
    const r8 = initializeRive("<?php echo get_template_directory_uri();?>/assets/rive/logo-b2-white.riv", "logo-b2-white", "r8");
    const r9 = initializeRive("<?php echo get_template_directory_uri();?>/assets/rive/line-white.riv", "line-white", "r9");
    const r10 = initializeRive("<?php echo get_template_directory_uri();?>/assets/rive/smile-white.riv", "smile-rive3", "r10");
    <?php } ?>

  </script>
    
 
</body>

</html>