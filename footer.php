

  <?php $partner = get_field('partner_section', 'option'); ?>
  <section class="bg-primary text-white partner-holder py-5 ">
    <div class="container pt-xl-4 pb-xl-5">
      <div class="row">
        <div class="col-12">
          <div class="d-flex align-items-center gap-4 mb-4 mb-xl-5">
            <h6><?php echo $partner['title']; ?></h6>
            <div class="straight-line"></div>
          </div>
          <div class="partners-carosuel swiper">
            <div class="swiper-wrapper align-items-center">
              <?php if($partner['logos']): foreach($partner['logos'] as $logo): ?>
              <div class="swiper-slide">
                <a href="<?php echo $logo['url']; ?>" target="_blank">
                  <img src="<?php echo $logo['logo_image']['url']; ?>" alt="<?php echo $logo['logo_image']['alt']; ?>" class="img-fluid">
                </a>
              </div>
              <?php endforeach; endif; ?>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <?php $news = get_field('news_section', 'option'); ?>
  <section class="mb-5 mt-3 mt-xl-5 pt-5 pb-3">
    <div class="container py-xl-4">
      <div class="row mb-4 mb-xl-5 align-items-md-end">
        <div class="col-8">
          <div class="subtitle">
            <?php echo $news['subtitle']; ?>
          </div>
          <h2 class="mb-md-0"><?php echo $news['title']; ?></h2>
        </div>
        <div class="col-md-4 text-end">
          <a href="<?php echo $news['all_new_link']['url']; ?>" class="text-link justify-content-md-end"><?php echo $news['all_new_link']['title']; ?> <img src="<?php echo get_template_directory_uri(); ?>/assets/images/icon-arrow.svg" alt="icon-arrow"></a>
        </div>
      </div>
      <div class="news-carousel swiper">
        <div class="swiper-wrapper">
        <?php 
        $args = array(
            'posts_per_page' => 10,
            'post_status' => 'publish',
            'orderby' => 'rand',
          );

          $recent_post = new WP_Query($args);
          if ($recent_post->have_posts()) :
              $colors = array('ylw', 'green', 'red');
              $counter = 0;
              while ($recent_post->have_posts()) : $recent_post->the_post(); $counter ++; $color = $colors[$counter % 3];
                  $categories = get_the_category();
          ?>


          <div class="swiper-slide">
            <a href="<?php the_permalink(); ?>" class="news-card">
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
                      <h3><?php the_title(); ?></h3>
                      <p><?php echo wp_trim_words(get_the_excerpt(), 20, '...'); ?></p>
                      <div class="text-link">Lees meer <img src="<?php echo get_template_directory_uri(); ?>/assets/images/icon-arrow.svg" alt="icon-arrow"></div>
                  </div>
              </a>
          </div>
          <?php  endwhile; wp_reset_postdata(); endif;  ?>
        </div>
        <div class="carousel-action-both">
          <div class="swiper-next">
            <img src="<?php echo get_template_directory_uri(); ?>/assets/images/icon-arrow.svg" alt="icon-arrow">
          </div>
          <div class="swiper-prev">
            <img src="<?php echo get_template_directory_uri(); ?>/assets/images/icon-arrow.svg" alt="icon-arrow">
          </div>
          <div class="swiper-pagination"></div>
        </div>
      </div>
    </div>
  </section>

<?php $instagram = get_field('instagram_feed', 'option'); ?>
<section class="insta-wrapper">
    <div class="container">
      <div class="row mb-4 mb-xl-5 align-items-end">
        <div class="col-sm-6">
          <div class="subtitle"><?php echo $instagram['subtitle']; ?></div>
          <h2><?php echo $instagram['title']; ?></h2>
        </div>
        <div class="col-sm-6">
          <div class="d-flex gap-2 align-items-center justify-content-sm-end">
              <a href="#" class="btn btn-primary dematenbtn" target="">De Maten</a>
              <a href="#" class="btn btn-outline-primary zevenhuizenbtn">Zevenhuizen</a>
          </div>
        </div>
      </div>
    </div>


    <?php 

      $instagramdemaden = new InstagramAPI();
      $instagramzh = new InstagramAPI(get_field('instagram_access_token_2', 'option'));

    ?>
    <div class="container">
      <div class="row">
        <div class="col-12">
          <div class="dematen">
            <?php $instagramdemaden->displayInstagramFeed(); ?>
          </div>
          <div class="zevenhuizen d-none">
            <?php $instagramzh->displayInstagramFeed(); ?>
          </div>
        </div>
      </div>
    </div>
  </section>

  <footer class="bg-primary">
    <div class="footer-top">
      <div class="container">
          <div class="footer-top-first">
          <div class="row align-items-lg-center">
            <div class="col-lg-4 col-xl-auto mb-4 mb-lg-0">
              <div class="footer-top-left d-flex align-items-center justify-content-between">
                <?php 
                
                $logo = get_field('footer_logos', 'option'); 
                $icon = get_field('footer_logo_side_icon', 'option'); 
                
                if($logo): ?>
                <img src="<?php echo $logo['url']; ?>" alt="logo-footer" class="footer-logo">
                <?php endif; ?>
                <?php if($icon): ?>
                  <img src="<?php echo $icon; ?>" alt="samlogo" class="footer-logo-other">
                <?php endif; ?>
              </div>
            </div>
            <?php $socialmedia = get_field('social_medias', 'option'); if( $socialmedia): ?>
            <div class="col-lg-4 col-xl-auto mb-3 mb-lg-0">
              <ul class="footer-social-logos list-unstyled">
                <?php foreach($socialmedia as $social): ?>
                <li><a href="<?php echo $social['social_media_details']['url']; ?>" target="_blank"><img src="<?php echo $social['social_media_details']['social_media_icon']['url']; ?>" alt="<?php echo $social['social_media_details']['social_media_icon']['alt']; ?>"></a></li>
                <?php endforeach; ?>
              </ul>
            </div>
            <?php endif; ?>
            <div class="col-lg-4 col-xl">
              <div class="footer-newslater">
                <h5 class="toggle">Aanmelden nieuwsbrief:</h5>
                <div class="collapse-div">
                <div class="d-flex align-items-center gap-3">
                  <input type="email" placeholder="E-mail" class="rounded-pill form-control">
                  <input type="submit" value="Verzenden" class="btn btn-secondary">
                </div>
              </div>
              </div>
            </div>
          </div>
        </div>
        
          <div class="row">
            <div class="col-lg-5">
              <?php $footermenu = get_field('footer_menu', 'option'); if($footermenu):  ?>
              <div class="footer-menu">
                <h5 class="toggle"><?php echo $footermenu['menu_title']; ?></h5>
                <ul class="list-unstyled collapse-div">
                  <?php if($footermenu['menu_items']) : foreach($footermenu['menu_items'] as $item) :?>
                  <li><a href="<?php echo $item['link']['url'];?>" target="<?php echo $item['link']['target'];?>"><?php echo $item['link']['title'];?></a></li>
                  <?php endforeach; endif; ?>
                </ul>
              </div>
              <?php endif; ?>
            </div>
            <div class="col-lg-6 offset-lg-1">
              <div class="row">
                <?php $info = get_field('footer_info_1', 'option'); if($info): ?> 
                <div class="col-md-6">
                  <div class="address">
                    <h5 class="toggle"><?php echo $info['info_title']; ?></h5>
                    <address class="collapse-div">
                      <?php echo $info['info_texts']; ?>
                    </address>
                  </div>
                </div>
                <?php endif; ?>
                <?php $info = get_field('footer_info_2', 'option');  if($info): ?> 
                <div class="col-md-6">
                  <div class="address">
                    <h5 class="toggle"><?php echo $info['info_title']; ?></h5>
                    <address class="collapse-div">
                      <?php echo $info['info_texts']; ?>
                    </address>
                  </div>
                </div>
                <?php endif; ?>
              </div>
            </div>
          </div>
        
        
        </div>
    </div>
    <div class="footer-bottom">
      <div class="container">
        <div class="row">
          <div class="col-md-9">
            <div class="footer-bottom-left">
              <p><?php echo get_field('copyright_texts', 'option'); ?></p>
              <?php $menu = get_field('footer_bottom_menu', 'option'); if($menu) : foreach($menu as $item): ?>
              <a href="<?php echo $item['link']['url']; ?>" target="<?php echo $item['link']['target']; ?>"><?php echo $item['link']['title']; ?></a>
              <?php endforeach; endif; ?>
            </div>
          </div>
          <div class="col-md-3 text-end">
            <a href="#" class="back-top">back top <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chevron-up" viewBox="0 0 16 16"><path fill-rule="evenodd" d="M7.646 4.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1-.708.708L8 5.707l-5.646 5.647a.5.5 0 0 1-.708-.708z"/>
            </svg></a>
          </div>
        </div>
      </div>
    </div>
  </footer>
  <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/jquery.magnific-popup.min.js"></script>
  <script src="https://unpkg.com/aos@next/dist/aos.js"></script>
  <script src="https://unpkg.com/isotope-layout@3/dist/isotope.pkgd.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
  <?php wp_footer(); ?>
  <script src="<?php echo get_template_directory_uri(); ?>/assets/js/scripts.js"></script>
  <script src="<?php echo get_template_directory_uri(); ?>/assets/js/functions.js"></script>
</body>

</html>