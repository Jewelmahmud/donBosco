<?php get_header(); ?>
<section class="s-news-banner">
    <div class="container">
      
      <?php
        $breadcrumbs = get_breadcrumb();
        if ($breadcrumbs) :
            ?>
            <ul class="breadcrumbs" aria-label="breadcrumb">
                <?php foreach ($breadcrumbs as $breadcrumb) : ?>
                    <li>
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
            </ul>
        <?php endif; ?>
    </div>
</section>

  <section class="s-news-content" data-aos="fade-up">
    <div class="container">
       <div class="s-news-image" style="background-image: url('<?php echo get_the_post_thumbnail_url(get_the_ID(), 'full'); ?>');"></div>
       <div class="page-content-width page-content">
        <div class="s-news-head">
          <div class="d-flex align-items-center gap-4 mb-4">
            <div class="tag"><?php
            $categories_list = get_the_category_list(', ');
            if ($categories_list) {
                echo $categories_list;
            }
            ?></div>
            <div class="date"><?php echo get_the_date('d/m/Y'); ?></div>
          </div>
          <h1><?php the_title(); ?></h1>
        </div>
        
        <?php the_content(); ?>
        </div>
    </div>
  </section>

  <section class="last-news">
    <div class="container">
      <h4>Last news</h4>
      <div class="swiper swiper-container last-news-slider">
        <div class="swiper-wrapper">
          <div class="swiper-slide">
            <a href="#" class="news-card" data-aos="fade">
              <div class="image">
                <img src="<?php echo get_template_directory_uri(); ?>/assets/images/new-img.jpg" alt="new-img">
                <div class="tag">Lorem</div>
              </div>
              <div class="text">
                <div class="news-date">13 august 2023</div>
              <h5>Het welbevinden van onze medewerkers is van </h5>
              <p>Het welbevinden van onze medewerkers is van .</p>
              <div class="read-more">Read more <svg xmlns="http://www.w3.org/2000/svg" width="16" height="17" viewBox="0 0 16 17"
                  fill="none">
                  <path d="M6.00222 4.5L10 8.512L6 12.5" stroke="#FF551E" stroke-width="2" stroke-linecap="round"
                    stroke-linejoin="round" />
                </svg>
              </div>
              </div>
            </a>
          </div>
          <div class="swiper-slide">
            <a href="#" class="news-card" data-aos="fade" data-aos-delay="50">
              <div class="image">
                <img src="<?php echo get_template_directory_uri(); ?>/assets/images/new-img.jpg" alt="new-img">
                <div class="tag">Lorem</div>
              </div>
              <div class="text">
                <div class="news-date">13 august 2023</div>
              <h5>Het welbevinden van onze medewerkers is van </h5>
              <p>Het welbevinden van onze medewerkers is van .</p>
              <div class="read-more">Read more <svg xmlns="http://www.w3.org/2000/svg" width="16" height="17" viewBox="0 0 16 17"
                  fill="none">
                  <path d="M6.00222 4.5L10 8.512L6 12.5" stroke="#FF551E" stroke-width="2" stroke-linecap="round"
                    stroke-linejoin="round" />
                </svg>
              </div>
              </div>
            </a>
          </div>
          <div class="swiper-slide">
            <a href="#" class="news-card" data-aos="fade" data-aos-delay="100">
              <div class="image">
                <img src="<?php echo get_template_directory_uri(); ?>/assets/images/new-img.jpg" alt="new-img">
                <div class="tag">Lorem</div>
              </div>
              <div class="text">
                <div class="news-date">13 august 2023</div>
              <h5>Het welbevinden van onze medewerkers is van </h5>
              <p>Het welbevinden van onze medewerkers is van .</p>
              <div class="read-more">Read more <svg xmlns="http://www.w3.org/2000/svg" width="16" height="17" viewBox="0 0 16 17"
                  fill="none">
                  <path d="M6.00222 4.5L10 8.512L6 12.5" stroke="#FF551E" stroke-width="2" stroke-linecap="round"
                    stroke-linejoin="round" />
                </svg>
              </div>
              </div>
            </a>
          </div>
          <div class="swiper-slide">
            <a href="#" class="news-card" data-aos="fade" data-aos-delay="150">
              <div class="image">
                <img src="<?php echo get_template_directory_uri(); ?>/assets/images/new-img.jpg" alt="new-img">
                <div class="tag">Lorem</div>
              </div>
              <div class="text">
                <div class="news-date">13 august 2023</div>
              <h5>Het welbevinden van onze medewerkers is van </h5>
              <p>Het welbevinden van onze medewerkers is van .</p>
              <div class="read-more">Read more <svg xmlns="http://www.w3.org/2000/svg" width="16" height="17" viewBox="0 0 16 17"
                  fill="none">
                  <path d="M6.00222 4.5L10 8.512L6 12.5" stroke="#FF551E" stroke-width="2" stroke-linecap="round"
                    stroke-linejoin="round" />
                </svg>
              </div>
              </div>
            </a>
          </div>
          <div class="swiper-slide">
            <a href="#" class="news-card" data-aos="fade" data-aos-delay="200">
              <div class="image">
                <img src="<?php echo get_template_directory_uri(); ?>/assets/images/new-img.jpg" alt="new-img">
                <div class="tag">Lorem</div>
              </div>
              <div class="text">
                <div class="news-date">13 august 2023</div>
              <h5>Het welbevinden van onze medewerkers is van </h5>
              <p>Het welbevinden van onze medewerkers is van .</p>
              <div class="read-more">Read more <svg xmlns="http://www.w3.org/2000/svg" width="16" height="17" viewBox="0 0 16 17"
                  fill="none">
                  <path d="M6.00222 4.5L10 8.512L6 12.5" stroke="#FF551E" stroke-width="2" stroke-linecap="round"
                    stroke-linejoin="round" />
                </svg>
              </div>
              </div>
            </a>
          </div>
          <div class="swiper-slide">
            <a href="#" class="news-card" data-aos="fade" data-aos-delay="250">
              <div class="image">
                <img src="<?php echo get_template_directory_uri(); ?>/assets/images/new-img.jpg" alt="new-img">
                <div class="tag">Lorem</div>
              </div>
              <div class="text">
                <div class="news-date">13 august 2023</div>
              <h5>Het welbevinden van onze medewerkers is van </h5>
              <p>Het welbevinden van onze medewerkers is van .</p>
              <div class="read-more">Read more <svg xmlns="http://www.w3.org/2000/svg" width="16" height="17" viewBox="0 0 16 17"
                  fill="none">
                  <path d="M6.00222 4.5L10 8.512L6 12.5" stroke="#FF551E" stroke-width="2" stroke-linecap="round"
                    stroke-linejoin="round" />
                </svg>
              </div>
              </div>
            </a>
          </div>
        </div>
        <div class="action-btns">
          <div class="swiper-pagination"></div>
          <div class="swiper-prev"><svg xmlns="http://www.w3.org/2000/svg" width="35" height="35" viewBox="0 0 35 35" fill="none">
            <circle cx="17.5" cy="17.5" r="17" transform="matrix(-1 0 0 1 35 0)" stroke="#F56537"/>
            <path d="M19 14L15 18L19 22" stroke="#FF551E" stroke-width="2"/>
          </svg></div>
          <div class="swiper-next"><svg xmlns="http://www.w3.org/2000/svg" width="35" height="35" viewBox="0 0 35 35" fill="none">
            <circle cx="17.5" cy="17.5" r="17" stroke="#F56537"/>
            <path d="M16 14L20 18L16 22" stroke="#FF551E" stroke-width="2"/>
          </svg> </div>
          
        </div>
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