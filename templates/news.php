<?php 

// Template name: News
get_header(); 
$posts_per_page = get_option('posts_per_page');
?>

<section class="news-top-holder">
    <div class="container">
      <div class="row">
        <div class="col-md-7">
          <!--<a class="left" href="#" style="background-image: url(<?php echo get_template_directory_uri(); ?>/assets/images/top-news-main.jpg);" data-aos="fade-right">
            <div class="overlay"></div>
            <div>
              <div class="news-date">13 august 2023</div>
            <h2>Het welbevinden van onze medewerkers is van </h2>
            <div class="read-more">Read more <svg xmlns="http://www.w3.org/2000/svg" width="16" height="17" viewBox="0 0 16 17"
                fill="none">
                <path d="M6.00222 4.5L10 8.512L6 12.5" stroke="#FF551E" stroke-width="2" stroke-linecap="round"
                  stroke-linejoin="round" />
              </svg>
            </div>
            </div>
          </a>-->




          <?php
              $args = array(
                  'posts_per_page' => 1,
                  'post_status' => 'publish',
              );

              $recent_post = new WP_Query($args);

              if ($recent_post->have_posts()) {
                  $recent_post->the_post();

                  // Get the post data
                  $post_title = get_the_title();
                  $post_date = get_the_date('j F Y');
                  $post_link = get_permalink();
                  $post_image = get_the_post_thumbnail_url(get_the_ID(), 'full');
                  $post_image = wp_get_attachment_image_src(get_post_thumbnail_id(), 'full');
                  if ($post_image && is_array($post_image)) {
                    $post_image_url = $post_image[0];
                  } else {
                      $post_image_url = get_template_directory_uri() . '/assets/images/b2work_thumb_700x550.png';
                  }
                  
                  echo '<a class="left" href="' . $post_link . '" style="background-image: url(' . $post_image_url . ');" data-aos="fade-right">
                          <div class="overlay"></div>
                          <div>
                            <div class="news-date">' . $post_date . '</div>
                          <h2>' . $post_title . '</h2>
                          <div class="read-more">Read more <svg xmlns="http://www.w3.org/2000/svg" width="16" height="17" viewBox="0 0 16 17"
                              fill="none">
                              <path d="M6.00222 4.5L10 8.512L6 12.5" stroke="#FF551E" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" />
                            </svg>
                          </div>
                          </div>
                        </a>';
                  wp_reset_postdata();
              } else {
                  echo 'No posts found';
              }
            ?>







        </div>
        <div class="col-md-5">
          <div class="right">


          <?php
              $args = array(
                  'posts_per_page' => 4,
                  'post_status' => 'publish',
                  'orderby'        => 'rand',
              );

              $recent_posts = new WP_Query($args);

              if ($recent_posts->have_posts()) {
                  $count = 0;
                  while ($recent_posts->have_posts()) {
                      $recent_posts->the_post();

                      if ($count > 0) {
                          // Get the post data
                          $post_title = get_the_title();
                          $post_date = get_the_date('j F Y');
                          $post_link = get_permalink();
                          $post_image = wp_get_attachment_image_src(get_post_thumbnail_id(), 'full');
                          if ($post_image && is_array($post_image)) {
                              $post_image_url = $post_image[0];
                          } else {
                              $post_image_url = get_template_directory_uri() . '/assets/images/b2work_thumb_180x171.png';
                          }

                          // $post_image_url = $post_image[0]? $post_image[0] :  get_template_directory_uri() . '/assets/images/b2work_thumb_180x171.png';                          

                          // Output the HTML with dynamic data
                          echo '<a href="' . $post_link . '" data-aos="fade">
                                  <img src="' . $post_image_url . '" alt="' . $post_title . '" class="img-fluid">
                                  <div class="text">
                                    <div class="news-date">' . $post_date . '</div>
                                    <h5>' . $post_title . '</h5>
                                    <p>' . get_the_excerpt() . '</p>
                                    <div class="btn-link">Read more <svg xmlns="http://www.w3.org/2000/svg" width="16" height="17" viewBox="0 0 16 17"
                                        fill="none">
                                        <path d="M6.00222 4.5L10 8.512L6 12.5" stroke="#FF551E" stroke-width="2" stroke-linecap="round"
                                          stroke-linejoin="round" />
                                      </svg></div>
                                  </div>
                                </a>';
                      }

                      $count++;
                  }
                  wp_reset_postdata();
              } else {
                  echo 'No posts found';
              }
            ?>

          </div>
        </div>
      </div>
    </div>
  </section>

  <div class="news-bottom-holder">
    <div class="container">
      <div class="slide-content" data-aos="fade-right">
        <div class="area-slide">
          <div class="swiper-prev"><svg xmlns="http://www.w3.org/2000/svg" width="35" height="35" viewBox="0 0 35 35"
              fill="none">
              <circle cx="17.5" cy="17.5" r="17" transform="matrix(-1 0 0 1 35 0)" stroke="#F56537" />
              <path d="M19 14L15 18L19 22" stroke="#FF551E" stroke-width="2" />
            </svg></div>
          <div class="swiper swiper-container slide-tabs filters-button-group">
            <div class="swiper-wrapper">
              <div class="swiper-slide">
                <a href="#" class="tab newsselector active" data-name="*"><span><?php echo __('All', 'b2works'); ?></span></a>
              </div>

              <?php
                $categories = get_terms(array(
                    'taxonomy' => 'category',
                    'hide_empty' => false,
                ));

                if (!empty($categories)) {
                    foreach ($categories as $category) {
                      echo '<div class="swiper-slide">
                              <a href="#" class="tab newsselector" data-name=".' . esc_attr($category->slug) . '"><span>' . esc_html($category->name) . '</span></a>
                            </div>';
                    }
                }

              ?>
              
            </div>
          </div>
          <div class="swiper-next"><svg xmlns="http://www.w3.org/2000/svg" width="35" height="35" viewBox="0 0 35 35"
              fill="none">
              <circle cx="17.5" cy="17.5" r="17" stroke="#F56537" />
              <path d="M16 14L20 18L16 22" stroke="#FF551E" stroke-width="2" />
            </svg> </div>
        </div>
        <form action="" class="search">
          <button type="submit">
            <div class="icon">
              <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16" fill="none">
                <path
                  d="M11.7138 2.84531C14.1647 5.30572 14.1647 9.29483 11.7138 11.7552C9.26286 14.2157 5.28913 14.2157 2.8382 11.7552C0.387268 9.29483 0.387268 5.30572 2.8382 2.84531C5.28913 0.384897 9.26286 0.384897 11.7138 2.84531"
                  stroke="#FF551E" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                <path d="M15 15.0542L11.71 11.7515" stroke="#FF551E" stroke-width="1.5" stroke-linecap="round"
                  stroke-linejoin="round" />
              </svg>
            </div>
          </button>
          <input type="text" class="form-control" name="search" placeholder="Search questions" id="search">
        </form>
      </div>

      <div class="all-news clearfix">

        <?php
          $args = array(
              'posts_per_page' => $posts_per_page,
              'post_status'    => 'publish',
          );

          $recent_posts = new WP_Query($args);

          if ($recent_posts->have_posts()) {
              while ($recent_posts->have_posts()) {
                  $recent_posts->the_post();
                  get_template_part('template-parts/content', 'news'); 
              }

              wp_reset_postdata();

          } else {
              echo 'No posts found';
          }
          
        ?>


      </div>
      <div class="see-all-btn text-center mt-4" data-aos="fade-zoom-in">
        <button class="btn btn-secondary" id="load-more" data-cat=""><?php echo __('Load more', 'b2works'); ?></button>
      </div>
    </div>
  </div>
  
  <input type="hidden" id="ajaxurl" data-url="<?php echo admin_url('admin-ajax.php'); ?>">

<?php get_footer();?>
<script>
    const b2Logo = initializeRive("<?php echo get_template_directory_uri();?>/assets/rive/main-logo.riv", "main-logo", "b2Logo");
    const r8 = initializeRive("<?php echo get_template_directory_uri();?>/assets/rive/logo-b2-white.riv", "logo-b2-white", "r8");
    const r9 = initializeRive("<?php echo get_template_directory_uri();?>/assets/rive/line-white.riv", "line-white", "r9");
    const r10 = initializeRive("<?php echo get_template_directory_uri();?>/assets/rive/smile-white.riv", "smile-rive3", "r10");
</script>