<?php $instagram = get_field('instagram_feed'); ?>
<section class="insta-wrapper">
    <div class="container">
      <div class="row mb-4 mb-xl-5 align-items-end">
        <div class="col-sm-6">
          <div class="subtitle"><?php echo $instagram['subtitle']; ?></div>
          <h2><?php echo $instagram['title']; ?></h2>
        </div>
        <div class="col-sm-6">
          <div class="d-flex gap-2 align-items-center justify-content-sm-end">
            <?php if($instagram['button_1']): ?>
              <a href="<?php echo $instagram['button_1']['url']; ?>" class="btn btn-primary" target="<?php echo $instagram['button_1']['target']; ?>"><?php echo $instagram['button_1']['title']; ?></a>
            <?php endif; ?>
            <?php if($instagram['button_2']): ?>
              <a href="<?php echo $instagram['button_2']['url']; ?>" class="btn btn-outline-primary" target="<?php echo $instagram['button_2']['target']; ?>"><?php echo $instagram['button_2']['title']; ?></a>
            <?php endif; ?>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-12">
          <div class="insta-carousel swiper">
            <div class="swiper-wrapper">
              <div class="swiper-slide">
                <img src="<?php echo get_template_directory_uri(); ?>/assets/images/insta-post.jpg" alt="insta-post" class="img-fluid">
              </div>
              <div class="swiper-slide">
                <img src="<?php echo get_template_directory_uri(); ?>/assets/images/insta-post.jpg" alt="insta-post" class="img-fluid">
              </div>
              <div class="swiper-slide">
                <img src="<?php echo get_template_directory_uri(); ?>/assets/images/insta-post.jpg" alt="insta-post" class="img-fluid">
              </div>
              <div class="swiper-slide">
                <img src="<?php echo get_template_directory_uri(); ?>/assets/images/insta-post.jpg" alt="insta-post" class="img-fluid">
              </div>
              <div class="swiper-slide">
                <img src="<?php echo get_template_directory_uri(); ?>/assets/images/insta-post.jpg" alt="insta-post" class="img-fluid">
              </div>
              <div class="swiper-slide">
                <img src="<?php echo get_template_directory_uri(); ?>/assets/images/insta-post.jpg" alt="insta-post" class="img-fluid">
              </div>
              <div class="swiper-slide">
                <img src="<?php echo get_template_directory_uri(); ?>/assets/images/insta-post.jpg" alt="insta-post" class="img-fluid">
              </div>
              <div class="swiper-slide">
                <img src="<?php echo get_template_directory_uri(); ?>/assets/images/insta-post.jpg" alt="insta-post" class="img-fluid">
              </div>
              <div class="swiper-slide">
                <img src="<?php echo get_template_directory_uri(); ?>/assets/images/insta-post.jpg" alt="insta-post" class="img-fluid">
              </div>
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
                <?php $logo = get_field('footer_logos', 'option'); 
                
                if($logo): ?>
                <img src="<?php echo $logo['url']; ?>" alt="logo-footer" class="footer-logo">
                <?php endif; ?>
                <img src="<?php echo get_template_directory_uri(); ?>/assets/images/samlogo.png" alt="samlogo" class="footer-logo-other">
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
              <div class="footer-menu">
                <h5 class="toggle">Menu</h5>
                <ul class="list-unstyled collapse-div">
                  <li><a href="#">Over ons</a></li>
                  <li><a href="#">Nieuws</a></li>
                  <li><a href="#">Media</a></li>
                  <li><a href="#">Webshop</a></li>
                  <li><a href="#">Steun ons</a></li>
                  <li><a href="#">Organisaties</a></li>
                  <li><a href="#">Veelgestelde vragen</a></li>
                  <li><a href="#">Contact</a></li>
                </ul>
              </div>
            </div>
            <div class="col-lg-6 offset-lg-1">
              <div class="row">
                <div class="col-md-6">
                  <div class="address">
                    <h5 class="toggle">Don Bosco Apeldoorn de Maten</h5>
                    <address class="collapse-div">
                      Eglantierlaan 203 <br>7329 AP Apeldoorn <br>055 - 542 59 51 <br>info@donboscoapeldoorn.nl
                    </address>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="address">
                    <h5 class="toggle">Don Bosco Apeldoorn Zevenhuizen</h5>
                    <address class="collapse-div">
                      Sluisoordlaan 200 <br>7322 EL Apeldoorn <br>055 - 366 46 38 <br>info@donboscoapeldoorn.nl
                    </address>
                  </div>
                </div>
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
              <p>© 2023 /// Don Bosco Apeldoorn <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" style="fill: currentColor;"><path d="m11.293 17.293 1.414 1.414L19.414 12l-6.707-6.707-1.414 1.414L15.586 11H6v2h9.586z"></path></svg> All rights reserved</p>
              <a href="#">Policy and terms</a>
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
  <script src="<?php echo get_template_directory_uri(); ?>/assets/js/scripts.js"></script>
</body>

</html>