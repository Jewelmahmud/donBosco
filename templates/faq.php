


<?php
// Template Name: FAQ
get_header();


?>

  <section class="faq-wrapper">
    <div class="container">
      <div class="row">
        <div class="col-md-8">
          <div class="slide-content">
            <div class="swiper-prev slide-arrow"><img src="<?php echo get_template_directory_uri(); ?>/assets/images/icon-arrow.svg" alt="icon-arrow"></div>
            <div class="slide-tabs filter-button-group swiper">
              <div class="swiper-wrapper">
                <div class="swiper-slide">
                  <a href="#" class="tab faqselector active" data-name="*"><img src="<?php echo get_template_directory_uri(); ?>/assets/images/icon-globe.svg" alt="">Alles</a>
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
                        echo '<a href="#" class="tab faqselector" data-name="' . esc_attr('.' . $term->slug) . '"><img src="'.get_template_directory_uri().'/assets/images/icon-notes.svg" alt="">' . esc_html($term->name) . '</a>';
                        echo '</div>';
                    };
                }
                ?>
              </div>
            </div>
            <div class="swiper-next slide-arrow"><img src="<?php echo get_template_directory_uri(); ?>/assets/images/icon-arrow.svg" alt="icon-arrow"></div>
          </div>
        </div>
        <div class="col-md-4"></div>
      </div>
      <div class="all-faqs accordion" id="db-faq">


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


            <div class="faq-item <?php echo $category_class; ?>">
              <div class="accordion-item">
                  <h2 class="accordion-header">
                      <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq-<?php echo $i; ?>" aria-expanded="false" aria-controls="faq-<?php echo $i; ?>">
                        <?php the_title();?>
                      </button>
                  </h2>
                  <div id="faq-<?php echo $i; ?>" class="accordion-collapse collapse" data-bs-parent="#db-faq">
                      <div class="accordion-body">
                        <p class="mb-0"><?php echo get_the_content(); ?></p>
                      </div>
                  </div>
              </div>
            </div>
            <?php endwhile; wp_reset_postdata(); endif; ?>

      </div>
    </div>
  </section>

<?php get_footer();?>

