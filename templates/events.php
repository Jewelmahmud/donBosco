<?php 

// Template name: Events
get_header(); 
$posts_per_page = get_option('posts_per_page');
?>
<section class="news-wrapper">
    <div class="container">
      
        <div class="row">
          <div class="col-lg-8 col-xl-9">
            <div class="slide-content">
              <div class="swiper-prev slide-arrow"><img src="<?php echo get_template_directory_uri();?>/assets/images/icon-arrow.svg" alt="icon-arrow"></div>
              <div class="slide-tabs filter-button-group swiper">
                <div class="swiper-wrapper">
                  <div class="swiper-slide">
                    <a href="#" class="tab faqselector active" data-name="*"><img src="<?php echo get_template_directory_uri();?>/assets/images/icon-globe.svg" alt="">Alles</a>
                  </div>

                  <?php
                  $categories = get_categories(array(
                      'taxonomy' => 'activity_type',
                      'hide_empty' => true,
                  ));

                  if (!empty($categories)) {
                    foreach ($categories as $category) {
                        $slugimage = (get_field('slug_image', 'category_' . $category->term_id)) ? get_field('slug_image', 'category_' . $category->term_id)['url'] :  get_template_directory_uri().'/assets/images/icon-notes.svg'; ?>
                        <div class="swiper-slide">
                          <a href="#" class="tab faqselector" data-name=".<?php echo esc_attr($category->slug); ?>"><img src="<?php echo get_template_directory_uri(); ?>/assets/images/icon-notes.svg" alt=""><?php echo esc_html($category->name); ?></a>
                        </div> 
                        <?php 
                    }
                  }
                ?>
                  
                </div>
              </div>
              <div class="swiper-next slide-arrow"><img src="<?php echo get_template_directory_uri();?>/assets/images/icon-arrow.svg" alt="icon-arrow"></div>
            </div>
          </div>
          <div class="col-lg-4 col-xl-3">
            <div class="select-filter">
              <span class="text-grey">Archief:</span>
              <select class="form-select">
                <option selected>2024</option>
                <option value="1">2025</option>
                <option value="2">2026</option>
                <option value="3">2024</option>
              </select>
            </div>
          </div>
        </div>
          
        
        <div class="row filter-wrapper" style="--bs-gutter-x: 2rem;">
        <?php
          $args = array(
            'post_type' => 'activiteiten',
            'posts_per_page' => get_option('post_per_page'),
            'post_status' => 'publish',
          );

            $recent_post = new WP_Query($args);
            if ($recent_post->have_posts()) :
                $colors = array('ylw', 'green', 'red');
                $counter = 0;
                while ($recent_post->have_posts()) : $recent_post->the_post(); $counter ++; $color = $colors[$counter % 3];
                    $categories =get_the_terms( get_the_ID(), 'activity_type' );?>

                    <div class="col-lg-4 col-md-6 mb-4 filter-item">
                        <a href="<?php the_permalink(); ?>" class="news-card event-card">
                        <div class="news-card-header">
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
                                    $category_count = count($categories);
                                    foreach ($categories as $index => $category) {
                                        $category_names[] = $category->name;
                                        ?>
                                        <div class="news-card-tag tag-bg-<?php echo $color; ?>">
                                            <img src="<?php echo get_template_directory_uri(); ?>/assets/images/icon-info.svg" alt="info icon">
                                            <?php echo esc_html(implode(', ', $category_names)); ?>
                                        </div>
                                        <?php
                                    }
                                }
                            ?>
                        </div>
                        <div class="news-card-body">
                            <div class="event-date">
                            <img src="<?php echo get_template_directory_uri();?>/assets/images/icon-calendar.svg" alt="icon-calendar">
                            <?php the_field('start_date'); ?> - <?php the_field('end_date'); ?>
                            </div>
                            <h3><?php the_title(); ?></h3>
                            <p><?php echo limitWords(get_the_excerpt(), 12); ?></p>
                            <div class="mb-4 mb-xl-5">
                            <div class="d-flex align-items-center gap-2 mb-2 pb-1 text-grey fs13px">
                                <img src="<?php echo get_template_directory_uri();?>/assets/images/icon-clock-r.svg" alt="clock"> <?php the_field('start_time'); ?> - <?php the_field('end_time'); ?>
                            </div>
                            <div class="d-flex align-items-center gap-2 mb-2 pb-1 text-grey fs13px">
                                <img src="<?php echo get_template_directory_uri();?>/assets/images/icon-place-r.svg" alt="place"> <?php the_field('location'); ?>
                            </div>
                            </div>
                            <div class="text-link">Lees meer <img src="<?php echo get_template_directory_uri();?>/assets/images/icon-arrow.svg" alt="icon-arrow"></div>
                        </div>
                        </a>
                    </div><?php  
                endwhile; wp_reset_postdata(); 
            endif;  ?>
        </div>
        <div class="row my-5">
          <div class="col-12">
            <a href="#" class="text-link justify-content-center">BEKIJK ALLES <img src="<?php echo get_template_directory_uri();?>/assets/images/icon-arrow.svg" alt="icon-arrow"></a>
          </div>
        </div>
      
    </div>
  </section>

<?php get_footer();?>