<?php 

// Template name: Downloads
get_header(); 
$posts_per_page = (int) get_field('post_per_page', 'option');
?>

<section class="news-wrapper">
    <div class="container">
      
        
          <div class="slide-content">
            <div class="swiper-prev slide-arrow"><img src="<?php echo get_template_directory_uri(); ?>/assets/images/icon-arrow.svg" alt="icon-arrow"></div>
            <div class="slide-tabs filter-button-group swiper">
              <div class="swiper-wrapper">
                <div class="swiper-slide">
                  <a href="#" class="tab downloadselector active" data-name="*" data-id="*"><img src="<?php echo get_template_directory_uri();?>/assets/images/icon-globe.svg" alt="">Alles</a>
                </div>
                  <?php
                    $categories = get_categories(array(
                        'taxonomy' => 'download_category',
                        'hide_empty' => true,
                    ));

                    if (!empty($categories)) {
                        foreach ($categories as $category) {
                            $slug_image_url = get_field('slug_image', $category);
                            $image_url = !empty($slug_image_url) ? $slug_image_url['url'] : get_template_directory_uri() . '/assets/images/icon-notes.svg'; ?>
                            <div class="swiper-slide">
                                <a href="#" class="tab downloadselector" data-name=".<?php echo esc_attr($category->slug); ?>" data-id="<?php echo esc_attr($category->term_id); ?>">
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
            'post_type' => 'download_items',
            'posts_per_page' => (int) get_field('post_per_page', 'option'),
            'post_status' => 'publish',
            'meta_key' => 'post_position', 
            'orderby' => 'meta_value_num',
            'order' => 'ASC', 
            'meta_query' => array(
                'relation' => 'OR',
                array(
                    'key' => 'post_position',
                    'compare' => 'EXISTS'
                ),
                array(
                    'key' => 'post_position',
                    'compare' => 'NOT EXISTS'
                )
            ),
          );

          $recent_post = new WP_Query($args);
          if ($recent_post->have_posts()) :
              $colors = array('ylw', 'green', 'red');
              $counter = 0;
              while ($recent_post->have_posts()) : $recent_post->the_post(); $counter ++; $color = $colors[$counter % 3];
                  $categories = get_the_terms( get_the_ID(), 'download_category' );
                  $category_slugs = array();
      
                  if (!empty($categories)) {
                      foreach ($categories as $category) {
                          $category_slugs[] = esc_attr($category->slug);
                      }
                  }
                  $category_class = implode(' ', $category_slugs);

                  // Definining is it video or URL
                  $pdf = get_field('pdf_file');
                  $youtube = get_field('youtube_rul');
                  if($pdf) {
                    $url = [
                      'url' => $pdf['url'],
                      'download' => true
                    ];
                  } elseif($youtube) {
                    $url = [
                      'url' => $youtube,
                      'download' => false
                    ];
                  }else {
                    $url = [
                      'url' => '',
                      'download' => ''
                    ];
                  }
          ?>
          <div class="col-lg-4 col-md-6 mb-4 filter-item <?php echo $category_class; ?>">
              <a href="<?= ($url['url'])? $url['url'] : '#'; ?>" class="news-card <?php if(!$url['download'] && $url['url']) echo 'openVideo'; ?>" <?= ($url['url'])? 'target="_blank"' : ''; ?>>
                  <div class="news-card-header">
                      <?php if(!$url['download'] && $url['url']): ?>
                      <div class="play_btn">
                          <img src="<?php echo get_template_directory_uri();?>/assets/images/play_video.png" alt="Play Button">
                      </div>
                      <?php endif; ?>
                      <div class="card-image">
                          <?php
                          if (has_post_thumbnail()) {
                              the_post_thumbnail('newsthumb', ['class' => 'img-fluid', 'alt' => 'card image']);
                          } else {
                          ?>
                              <img src="<?php echo get_template_directory_uri(); ?>/assets/images/placeholoder_logo.jpg" alt="card image" class="img-fluid">
                          <?php
                          }
                          ?>
                      </div>
                      <?php
                        if (!empty($categories)) {
                          $category_names = array();
                          foreach ($categories as $category)   $category_names[] = esc_html($category->name);
                            $slug_image_url = get_field('slug_image', $category);
                            $image_url = !empty($slug_image_url) ? $slug_image_url['url'] : get_template_directory_uri() . '/assets/images/icon-notes.svg'; ?>
                            <div class="news-card-tag tag-bg-<?php echo $color; ?>">
                                <img src="<?php echo $image_url; ?>" alt="info icon">
                                <?php echo implode(', ', $category_names); ?>
                            </div>
                            <?php
                        }
                      ?>
                  </div>
                  <div class="news-card-body">
                  <?php 
                  
                    if(!$url['download']) $linktext = 'Bekijk Video';
                    else $linktext = 'Download'; ?>

                      <h3><?php the_title(); ?></h3>
                      <p><?php echo wp_trim_words(get_the_excerpt(), 20, '...'); ?></p>
                      <div class="text-link"><?= $linktext; ?> <img src="<?php echo get_template_directory_uri(); ?>/assets/images/icon-arrow.svg" alt="icon-arrow"></div>
                  </div>
              </a>
          </div>
          <?php  endwhile; wp_reset_postdata(); endif;  ?>
        </div>
      
    </div>
  </section>

  <?php get_footer();?>