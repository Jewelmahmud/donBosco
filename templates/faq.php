


<?php
// Template Name: FAQ

get_header();?>

<section class="faq-wrapper">
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
                <a href="#" class="tab faqselector active" data-name="*"><span><?php echo __('All', 'b2works'); ?></span></a>
              </div>
              <?php
                // Get the terms for the "faq_category" taxonomy
                $terms = get_terms(array(
                    'taxonomy' => 'faq_category',
                    'hide_empty' => true,
                ));

                // Check if there are any terms
                if (!empty($terms)) {

                    // Loop through each term
                    foreach ($terms as $term) {
                        // Generate the HTML structure for each term
                        echo '<div class="swiper-slide">';
                        echo '<a href="#" class="tab faqselector" data-name="' . esc_attr('.' . $term->slug) . '"><span>' . esc_html($term->name) . '</span></a>';
                        echo '</div>';
                    };
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
                <path d="M11.7138 2.84531C14.1647 5.30572 14.1647 9.29483 11.7138 11.7552C9.26286 14.2157 5.28913 14.2157 2.8382 11.7552C0.387268 9.29483 0.387268 5.30572 2.8382 2.84531C5.28913 0.384897 9.26286 0.384897 11.7138 2.84531" stroke="#FF551E" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                <path d="M15 15.0542L11.71 11.7515" stroke="#FF551E" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
              </svg>
            </div>
          </button>
          <input type="text" class="form-control" name="search" placeholder="<?php echo __('Search questions', 'b2works'); ?>" id="search">
        </form>
      </div>
      <div class="all-faqs accordion" id="b2-faq" data-aos="fade-up">


      <?php 
        $args = array(
          'post_type'      => 'faq', 
          'posts_per_page' => -1,
        );

        $faq_query = new WP_Query( $args );

        if ( $faq_query->have_posts() ) : $i = 0; while ( $faq_query->have_posts() ) : $faq_query->the_post(); $i++;

            $categories = get_the_terms( get_the_ID(), 'faq_category' );
            $category_slugs = array();

            if (!empty($categories)) {
                foreach ($categories as $category) {
                    $category_slugs[] = esc_attr($category->slug);
                }
            }
            
            $category_class = implode(' ', $category_slugs);

            ?>
            <div class="faq-item aa <?php echo $category_class; ?>">
              <div class="accordion-item">
                <h2 class="accordion-header">
                  <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq-<?php echo $i; ?>" aria-expanded="false" aria-controls="faq-<?php echo $i; ?>">
                    <?php the_title();?>
                  </button>
                </h2>
                <div id="faq-<?php echo $i; ?>" class="accordion-collapse collapse" data-bs-parent="#b2-faq">
                  <div class="accordion-body">
                    <p class="mb-0"><?php echo get_the_content(); ?></p>
                  </div>
                </div>
              </div>
            </div>
        <?php endwhile; endif; ?>

        
      </div>
    </div>
  </section>

<?php get_footer();?>

<script>
  const b2Logo = initializeRive("<?php echo get_template_directory_uri();?>/assets/rive/main-logo.riv", "main-logo", "b2Logo");
  const r8 = initializeRive("<?php echo get_template_directory_uri();?>/assets/rive/logo-b2-white.riv", "logo-b2-white", "r8");
  const r9 = initializeRive("<?php echo get_template_directory_uri();?>/assets/rive/line-white.riv", "line-white", "r9");
  const r10 = initializeRive("<?php echo get_template_directory_uri();?>/assets/rive/smile-white.riv", "smile-rive3", "r10");
</script>