<?php 

// Template name: Vacancies
get_header(); 
$posts_per_page = (int) get_field('post_per_page', 'option');
?>

<section class="vacancies-wrapper">
    <div class="container">
          <div class="slide-content">
            <div class="swiper-prev slide-arrow"><img src="<?php echo get_template_directory_uri(); ?>/assets/images/icon-arrow.svg" alt="icon-arrow"></div>
            <div class="slide-tabs filter-button-group swiper">
              <div class="swiper-wrapper">
                <div class="swiper-slide">
                  <a href="#" class="tab jobselector active" data-name="*"><img src="<?php echo get_template_directory_uri();?>/assets/images/icon-globe.svg" alt="">Alles</a>
                </div>

                <?php
                  $categories = get_categories(array(
                        'taxonomy' => 'vacaturecategorie',
                        'hide_empty' => true,
                  ));

                  if (!empty($categories)) {
                    foreach ($categories as $category) {
                        $slug_image_url = get_field('slug_image', $category);
                        $image_url = !empty($slug_image_url) ? $slug_image_url['url'] : get_template_directory_uri() . '/assets/images/icon-notes.svg'; ?>
                        <div class="swiper-slide">
                            <a href="#" class="tab jobselector" data-name=".<?php echo esc_attr($category->slug); ?>">
                                <img src="<?php echo esc_url($image_url); ?>" alt="">
                                <?php echo esc_html($category->name); ?>
                            </a>
                        </div>
                <?php
                    }
                }
              ?>

              </div>
            </div>
            <div class="swiper-next slide-arrow"><img src="<?php echo get_template_directory_uri(); ?>/assets/images/icon-arrow.svg" alt="icon-arrow"></div>
          </div>
        
        <div class="row filter-wrapper" style="--bs-gutter-x: 2rem;">
        <?php
          $args = array(
            'post_type' => 'vacatures',
            'posts_per_page' => -1,
            'post_status' => 'publish',
          );

          $recent_post = new WP_Query($args);
          if ($recent_post->have_posts()) :
              $colors = array('ylw', 'green', 'red');
              $counter = 0;
              while ($recent_post->have_posts()) : $recent_post->the_post(); $counter ++; $color = $colors[$counter % 3];
                $categories = get_the_terms( get_the_ID(), 'vacaturecategorie' );
                $category_slugs = array();
    
                if (!empty($categories)) {
                    foreach ($categories as $category) {
                        $category_slugs[] = esc_attr($category->slug);
                    }
                }
                $category_class = implode(' ', $category_slugs);  ?>
                <div class="col-lg-4 col-md-6 mb-4 filter-item <?php echo $category_class; ?>">
                  <a href="<?php the_permalink(); ?>" class="vacancies-card">
                    <div class="vacancies-card-header">
                      <div class="card-image">
                        <?php
                          if (has_post_thumbnail()) {
                              the_post_thumbnail('newsthumb', ['class' => 'img-fluid', 'alt' => 'card image']);
                          } else {
                          ?>
                            <img src="<?php echo get_template_directory_uri(); ?>/assets/images/card-image.jpg" alt="card image" class="img-fluid">
                          <?php } ?>
                      
                      </div>
                    </div>
                    <div class="vacancies-card-body">
                      <h3><?php the_title(); ?></h3>
                      <p><?php the_field('short_line_after_title'); ?></p>
                      <?php $feature = get_field('jobs_features'); if($feature): ?>
                      <ul class="feature-list">
                          <?php foreach($feature as $item) echo "<li>".$item['feature']."</li>";?>
                      </ul>
                      <?php endif; ?>
                      <div class="d-flex align-items-center gap-3">
                        <div class="d-flex align-items-center gap-3">
                          <img src="<?php echo get_template_directory_uri(); ?>/assets/images/icon-map.svg" alt="map icon"><?php the_field('location'); ?>
                        </div>
                        <div class="d-flex align-items-center gap-3">
                          <img src="<?php echo get_template_directory_uri(); ?>/assets/images/icon-time-2.svg" alt="timeicon-time icon"><?php the_field('job_type'); ?>
                        </div>
                      </div>
                      <div class="btn btn-primary">Bekijk vacature
                          <svg width="8" height="12" viewBox="0 0 8 12" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                          <circle cx="2" cy="2" r="2" fill="currentColor"></circle>
                          <circle cx="6" cy="6" r="2" fill="currentColor"></circle>
                          <circle cx="2" cy="10" r="2" fill="currentColor"></circle>
                          </svg>
                      </div>
                    </div>
                  </a>
                </div>
          <?php  endwhile; wp_reset_postdata(); endif;  ?>          
        </div>
        <!-- <div class="row my-5">
          <div class="col-12">
            <a href="#" class="text-link justify-content-center">BEKIJK ALLES <img src="<?php echo get_template_directory_uri(); ?>/assets/images/icon-arrow.svg" alt="icon-arrow"></a>
          </div>
        </div> -->
      
    </div>
  </section>

  <?php get_footer();?>