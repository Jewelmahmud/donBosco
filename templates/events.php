<?php 

// Template name: Events
get_header(); 
$posts_per_page = (int) get_field('post_per_page', 'option');

$args = array(
  'post_type'      => 'fk_events',
  'posts_per_page' =>  -1,
  'post_status'    => 'publish',
  'order'          => 'ASC'
);

$query = new WP_Query($args);
$years = [];

if ($query->have_posts()) {
  while($query->have_posts()) {
    $query->the_post();
    $enddata = get_field('end_date');
    $endtime = get_field('end_time');
    if(!isEventAlive($enddata, $endtime)){
        $dateTime = DateTime::createFromFormat('d/m/Y', $enddata);
        $year = $dateTime->format('Y');
        array_push($years, (int)$year);

        $terms = wp_get_post_terms(get_the_ID(), 'activity_type');
        if (!empty($terms) && !is_wp_error($terms)) {
            foreach ($terms as $term) {
                wp_remove_object_terms(get_the_ID(), $term->term_id, 'activity_type');
            }
        }
    }
  }
  wp_reset_postdata();
}

$years = array_unique($years);
rsort($years);
?>
<section class="news-wrapper">
    <div class="container">
      
        <div class="row">
          <div class="col-lg-8 col-xl-9">
            <div class="slide-content">
              <div class="swiper-prev slide-arrow"><img src="<?php echo get_template_directory_uri(); ?>/assets/images/icon-arrow.svg" alt="icon-arrow"></div>
              <div class="slide-tabs filter-button-group swiper">
                <div class="swiper-wrapper">
                  <div class="swiper-slide">
                    <a href="#" class="tab eventselector active" data-name="*" data-id="*"><img src="images/icon-globe.svg" alt="">Alles</a>
                  </div>
                  <?php
                    $categories = get_categories(array(
                        'taxonomy' => 'activity_type',
                        'hide_empty' => true,
                    ));

                    if (!empty($categories)) {
                      foreach ($categories as $category) {
                          $slug_image_url = get_field('slug_image', $category);
                          $image_url = !empty($slug_image_url) ? $slug_image_url['url'] : get_template_directory_uri() . '/assets/images/icon-notes.svg'; ?>
                          <div class="swiper-slide">
                              <a href="#" class="tab eventselector" data-name=".<?php echo esc_attr($category->slug); ?>" data-id="<?php echo esc_html($category->term_id); ?>">
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
          </div>
          <div class="col-lg-4 col-xl-3">
            <div class="select-filter">
              Archief: 
              <select class="form-select" id="eventment">
              <option value="*" selected>Year</option>';
                <?php
                foreach($years as $year) {
                    echo '<option value="' . $year . '">' . $year . '</option>';
                }
                ?>
            </select>
            </div>
          </div>
        </div>
          
        
        <div class="row filter-wrapper" style="--bs-gutter-x: 2rem;">
        <?php
            $args = array(
                'post_type'      => 'fk_events',
                'posts_per_page' => (int) get_field('post_per_page', 'option'),
                'post_status'    => 'publish',
                'meta_key'       => 'start_date', 
                'orderby'        => 'meta_value_num',
                'order'          => 'ASC'
            );

            $recent_post = new WP_Query($args);
            if ($recent_post->have_posts()) :
                $colors = array('ylw', 'green', 'red');
                $counter = 0;
                while ($recent_post->have_posts()) : $recent_post->the_post(); $counter ++; $color = $colors[$counter % 3];

                    $categories = get_the_terms( get_the_ID(), 'activity_type' );
                    $category_slugs = array();
        
                    if (!empty($categories)) {
                        foreach ($categories as $category) {
                            $category_slugs[] = esc_attr($category->slug);
                        }
                    }
                    $category_class = implode(' ', $category_slugs); 

                    $enddata = get_field('end_date');
                    $endtime = get_field('end_time');


                    if(isEventAlive($enddata, $endtime)){
                    
                    
                    ?>

        
                    <div class="col-lg-4 col-md-6 mb-4 filter-item <?php echo $category_class; ?>">
                      <a href="<?php the_permalink(); ?>" class="news-card event-card">
                        <div class="news-card-header">
                          <div class="card-image">
                            <?php
                            if (has_post_thumbnail()) {
                                the_post_thumbnail('newsthumb', ['class' => 'img-fluid', 'alt' => 'card image']);
                            } else {  ?>
                                <img src="<?php echo get_template_directory_uri(); ?>/assets/images/placeholoder_logo.jpg" alt="card image" class="img-fluid">
                            <?php  }  ?>
                          </div>
                          <div class="news-card-tag tag-bg-<?php echo $color; ?>">
                            <img src="<?php echo get_template_directory_uri(); ?>/assets/images/icon-info.svg" alt="info icon">
                            <?php echo $category_class; ?>
                          </div>
                        </div>
                        <div class="news-card-body">
                          <?php if(get_field('start_date') && get_field('end_date')): ?>
                          <div class="event-date">
                            <img src="<?php echo get_template_directory_uri(); ?>/assets/images/icon-calendar.svg" alt="icon-calendar">
                            <?php the_field('start_date'); ?> - <?php the_field('end_date'); ?>
                          </div>
                          <?php endif;?>
                          <h3><?php the_title(); ?></h3>
                          <p><?php echo wp_trim_words(get_the_excerpt(), 10, '...'); ?></p>
                          <div class="mb-4 mb-xl-5">
                            <?php if(get_field('start_time')): ?>
                            <div class="d-flex align-items-center gap-2 mb-2 pb-1 text-grey fs13px">
                              <img src="<?php echo get_template_directory_uri(); ?>/assets/images/icon-clock-r.svg" alt="clock"> <?php the_field('start_time'); ?> - <?php the_field('end_time'); ?>
                            </div>
                            <?php endif;?>
                            <?php if(get_field('location')): ?>
                            <div class="d-flex align-items-center gap-2 mb-2 pb-1 text-grey fs13px">
                              <img src="<?php echo get_template_directory_uri(); ?>/assets/images/icon-place-r.svg" alt="place"> <?php the_field('location'); ?>
                            </div>
                            <?php endif;?>
                          </div>
                          <div class="text-link">Lees meer <img src="<?php echo get_template_directory_uri(); ?>/assets/images/icon-arrow.svg" alt="icon-arrow"></div>
                        </div>
                      </a>
                    </div><?php } 
                  endwhile; wp_reset_postdata(); 
            endif;  ?>
          




        </div>
        <!-- <div class="row my-5">
          <div class="col-12">
            <a href="#" class="text-link justify-content-center">BEKIJK ALLES <img src="<?php echo get_template_directory_uri();?>/assets/images/icon-arrow.svg" alt="icon-arrow"></a>
          </div>
        </div> -->
      
    </div>
  </section>

<?php get_footer();?>