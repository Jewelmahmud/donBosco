<?php

//Template Name: Home
 get_header();
 $community = get_field('community_section');
 ?>
  <section class="mb-5 mt-3 pt-5 pb-3 mb-xl-0 pb-xl-0 van-individueel">
    <div class="container">
      <div class="row justify-content-between">
        <div class="col-md-6 position-relative order-md-2 mb-4 mb-xl-0 photo-container">
          <div class="text-end img-topper-text">
           <?php echo $community['gray_text']; ?>
          </div>
          <div class="position-relative">
              <div class="heart-box position-absolute top-0 start-0 bg-primary">
               <img src="<?php echo get_template_directory_uri(); ?>/assets/images/icon-heart.svg" alt="icon-heart">
              </div>
            <?php

            if($community['i___images__1']):  ?>
              <img src="<?php echo $community['i___images__1']['url'] ?>" alt="<?php echo $community['i___images__1']['alt'] ?>" class="w-100">
            <?php endif; ?>
              <div class="border-image"></div>

          </div>
          <div class="position-absolute d-none d-xl-block" style="bottom: -72px;left: -150px;">
           <div class="position-relative">
              <?php if($community['i___images__2']): ?>
                <img src="<?php echo $community['i___images__2']['url'] ?>" alt="<?php echo $community['i___images__2']['alt'] ?>" class="img-fluid">
             <?php endif; ?>
             <div class="border-image"></div>
             <div class="position-absolute" style="top: -16px;left: -20px;transform: rotate(180deg);">
               <img src="<?php echo get_template_directory_uri(); ?>/assets/images/icon-arrow.svg" alt="icon-arrow" style="width: 40px;">
             </div>
             
           </div>
          </div>
       </div>
        <div class="col-md-6 col-xl-5 order-md-1">
          <div class="subtitle"><?php echo $community['subtitle']; ?></div>
          <h2><?php echo $community['title']; ?></h2>
          <p class="mb-xl-5"><?php echo $community['descriptions']; ?></p>
          <?php if($community['link']): ?>
          <a href="<?php echo $community['link']['url']; ?>" class="btn btn-primary btn-with-arrow" target="<?php echo $community['link']['target']; ?>"><?php echo $community['link']['title']; ?> <svg width="8" height="12" viewBox="0 0 8 12" fill="currentColor" xmlns="http://www.w3.org/2000/svg"><circle cx="2" cy="2" r="2" fill="currentColor"/><circle cx="6" cy="6" r="2" fill="currentColor"/><circle cx="2" cy="10" r="2" fill="currentColor"/></svg></a>
          <?php endif; ?>
        </div>
        
      </div>
    </div>
  </section>

  <?php $redsec = get_field('red_sectopm');
  
  ?>
  <section class="section-primary text-white py-5 pb-xl-0">
    <div class="container py-3 pt-xl-5 pb-xl-0 mt-xl-5">
      <div class="row justify-content-between align-items-center mt-xl-4">
          <div class="col-md-6 mb-4 mb-md-0">
            <div class="position-relative mb-xl-m41">
              <img src="<?php echo $redsec['image____red']['url']; ?>" alt="<?php echo $redsec['image____red']['alt']; ?>" class="w-100">
              <div class="border-image"></div>
              <div class="position-absolute box-with-user bg-white">
                <img src="<?php echo get_template_directory_uri(); ?>/assets/images/icon-users.svg" alt="icon-users">
              </div>
              <div class="position-absolute bottom-0 start-0">
                 <div class="image-over-text fw-bold"><?php echo $redsec['text_below_image']; ?></div>
              </div>
            </div>
          </div>
          <div class="col-md-6 col-xl-5">
            <div class="subtitle"><?php echo $redsec['subtitle']; ?></div>
            <h2><?php echo $redsec['title']; ?></h2>
            <p class="mb-xl-5"><?php echo $redsec['descriptions']; ?></p>
            <?php if($redsec['link']['url']): ?>
            <a href="<?php echo $redsec['link']['url']; ?>" class="btn btn-secondary btn-with-arrow" target="<?php echo $redsec['link']['target']; ?>"><?php echo $redsec['link']['title']; ?> <svg width="8" height="12" viewBox="0 0 8 12" fill="currentColor" xmlns="http://www.w3.org/2000/svg"><circle cx="2" cy="2" r="2" fill="currentColor"/><circle cx="6" cy="6" r="2" fill="currentColor"/><circle cx="2" cy="10" r="2" fill="currentColor"/></svg></a>
            <?php endif; ?>
          </div>
      </div>
    </div>
  </section>

  <?php $activity = get_field('activiteiten_section'); ?>
  <section class="mb-5 mt-3 mt-xl-5 pt-5 pb-3">
    <div class="container mb-4 mb-xl-5 mt-xl-5 pt-xl-5 pb-xl-4">
      <div class="row align-items-end">
        <div class="col-lg-6">
          <div class="subtitle"><?php echo $activity['subtitle']; ?></div>
            <h2 class="mb-lg-0"><?php echo $activity['title']; ?></h2>
        </div>
        <div class="col-lg-5 offset-lg-1">
          <p class="mb-lg-0"><?php echo $activity['descriptions']; ?></p>
        </div>
      </div>
    </div>
    <div class="four-column-full swiper">
      <div class="swiper-wrapper">
        <div class="swiper-slide">
          <a href="#" class="column">
            <img src="<?php echo get_template_directory_uri(); ?>/assets/images/pexels-rheza-aulia-3375234.jpg" alt="pexels-rheza-aulia-3375234" class="slider-image">
            <div class="overlay-content">
              <div class="content-top d-flex align-items-center justify-content-between">
                <div>
                  <h4>Kinderen</h4>
                  <p>Na school</p>
                </div>
                <div>
                  <img src="<?php echo get_template_directory_uri(); ?>/assets/images/icon-arrow.svg" alt="icon-arrow" class="arrow-right">
                </div>
              </div>
              <div class="content-btn">Lees VERDER</div>
            </div>
          </a>
        </div>
        <div class="swiper-slide">
          <a href="#" class="column">
            <img src="<?php echo get_template_directory_uri(); ?>/assets/images/mi-pham-xtd3zYWxEs4-unsplash.jpg" alt="mi-pham-xtd3zYWxEs4-unsplash" class="slider-image">
            <div class="overlay-content">
              <div class="content-top d-flex align-items-center justify-content-between">
                <div>
                  <h4>Kinderen</h4>
                  <p>Na school</p>
                </div>
                <div>
                  <img src="<?php echo get_template_directory_uri(); ?>/assets/images/icon-arrow.svg" alt="icon-arrow" class="arrow-right">
                </div>
              </div>
              <div class="content-btn">Lees VERDER</div>
            </div>
          </a>
        </div>
        <div class="swiper-slide">
          <a href="#" class="column">
            <img src="<?php echo get_template_directory_uri(); ?>/assets/images/mask-group.jpg" alt="mask-group" class="slider-image">
            <div class="overlay-content">
              <div class="content-top d-flex align-items-center justify-content-between">
                <div>
                  <h4>Kinderen</h4>
                  <p>Na school</p>
                </div>
                <div>
                  <img src="<?php echo get_template_directory_uri(); ?>/assets/images/icon-arrow.svg" alt="icon-arrow" class="arrow-right">
                </div>
              </div>
              <div class="content-btn">Lees VERDER</div>
            </div>
          </a>
        </div>
        <div class="swiper-slide">
          <a href="#" class="column">
            <img src="<?php echo get_template_directory_uri(); ?>/assets/images/cdc-GDokEYnOfnE-unsplash.jpg" alt="cdc-GDokEYnOfnE-unsplash" class="slider-image">
            <div class="overlay-content">
              <div class="content-top d-flex align-items-center justify-content-between">
                <div>
                  <h4>Kinderen</h4>
                  <p>Na school</p>
                </div>
                <div>
                  <img src="<?php echo get_template_directory_uri(); ?>/assets/images/icon-arrow.svg" alt="icon-arrow" class="arrow-right">
                </div>
              </div>
              <div class="content-btn">Lees VERDER</div>
            </div>
          </a>
        </div>
      </div>
      
        <div class="swiper-next swiper-arrow">
          <img src="<?php echo get_template_directory_uri(); ?>/assets/images/icon-arrow.svg" alt="icon-arrow">
        </div>
        <div class="swiper-prev swiper-arrow">
          <img src="<?php echo get_template_directory_uri(); ?>/assets/images/icon-arrow.svg" alt="icon-arrow">
        </div>
      
    </div>
  </section>

  <?php $white = get_field('white_section'); ?>
  <section class="mb-5 mb-xl-0 mt-3 pb-3 pb-xl-0 mt-xl-5 pt-xl-5">
    <div class="container">
      <div class="row align-items-center">
        <div class="col-md-6 order-md-2 pb-4 pb-md-0">
          <div class="position-relative">
            <img src="<?php echo  $white['white_image']['url']; ?>" alt="<?php echo  $white['white_image']['alt']; ?>" class="w-100">
            <div class="position-absolute top-0 d-none d-md-block" style="left: -13px;">
              <svg width="31" height="47" viewBox="0 0 31 47" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M20.7831 42.2673C20.0219 45.1081 17.0888 46.8051 14.2867 46.0362C11.4426 45.256 9.8302 42.3591 10.6247 39.4275C11.3564 36.6966 14.2957 35.0103 17.0544 35.7404C19.8488 36.4711 21.5398 39.4434 20.7831 42.2673ZM26.4599 0.672132C29.2749 1.42643 30.9505 4.3221 30.1939 7.14601C29.4372 9.96991 26.5521 11.6888 23.718 10.9385C20.8778 10.1775 19.2441 7.29304 20.0128 4.3908C20.7626 1.59226 23.6509 -0.0714644 26.4599 0.672132ZM7.54802 14.3808C10.3631 15.1351 12.0387 18.0308 11.282 20.8547C10.5253 23.6786 7.64023 25.3976 4.80613 24.6472C1.96592 23.8862 0.321591 21.008 1.10091 18.0995C1.88023 15.1911 4.73906 13.6372 7.54802 14.3808Z" fill="#E60523"/></svg>
            </div>
          </div>
        </div>
        <div class="col-md-6 order-md-1 pb-xl-5">
          <div class="subtitle"><?php echo  $white['subtitle']; ?></div>
          <h2><?php echo  $white['title']; ?></h2>
          <p class="mb-xl-5 pe-xl-5"><?php echo  $white['descriptions']; ?></p>
          <?php if($white['link']): ?>
          <a href="<?php echo $white['link']['url'] ?>" class="btn btn-primary btn-with-arrow" target="<?php echo $white['link']['target'] ?>"><?php echo $white['link']['title'] ?> <svg width="8" height="12" viewBox="0 0 8 12" fill="currentColor" xmlns="http://www.w3.org/2000/svg"><circle cx="2" cy="2" r="2" fill="currentColor"/><circle cx="6" cy="6" r="2" fill="currentColor"/><circle cx="2" cy="10" r="2" fill="currentColor"/></svg></a>
          <?php endif; ?>
        </div>
        
      </div>
    </div>
  </section>
  <?php $partner = get_field('partner_section'); ?>
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
                <img src="<?php echo $logo['logo_image']['url']; ?>" alt="<?php echo $logo['logo_image']['alt']; ?>" class="img-fluid">
              </div>
              <?php endforeach; endif; ?>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <?php $news = get_field('news_section'); ?>
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
          <a href="<?php echo $news['all_new_link']['url']; ?>" class="text-all_new_link justify-content-md-end"><?php echo $news['all_new_link']['title']; ?> <img src="<?php echo get_template_directory_uri(); ?>/assets/images/icon-arrow.svg" alt="icon-arrow"></a>
        </div>
      </div>
      <div class="news-carousel swiper">
        <div class="swiper-wrapper">
          <div class="swiper-slide">
            <a href="#" class="news-card">
              <div class="news-card-header">
                <div class="card-image">
                  <img src="<?php echo get_template_directory_uri(); ?>/assets/images/card-image.jpg" alt="card image" class="img-fluid">
                </div>
                <div class="news-card-tag tag-bg-ylw">
                  <img src="<?php echo get_template_directory_uri(); ?>/assets/images/icon-info.svg" alt="info icon">
                  vrije tijd
                </div>
              </div>
              <div class="news-card-body">
                <h3>Don Bosco De Maten tegen bekende Youtubers?</h3>
                <p>Het doel is dit keer niet om te winnen, maar om geld op te halen voor de Voedselbank in Apel...</p>
                <div class="text-link">Lees meer <img src="<?php echo get_template_directory_uri(); ?>/assets/images/icon-arrow.svg" alt="icon-arrow"></div>
              </div>
            </a>
          </div>
          <div class="swiper-slide">
            <a href="#" class="news-card">
              <div class="news-card-header">
                <div class="card-image">
                  <img src="<?php echo get_template_directory_uri(); ?>/assets/images/card-image.jpg" alt="card image" class="img-fluid">
                </div>
                <div class="news-card-tag tag-bg-green">
                  <img src="<?php echo get_template_directory_uri(); ?>/assets/images/icon-info.svg" alt="info icon">
                  Activiteitein
                </div>
              </div>
              <div class="news-card-body">
                <h3>Don Bosco De Maten tegen bekende Youtubers?</h3>
                <p>Het doel is dit keer niet om te winnen, maar om geld op te halen voor de Voedselbank in Apel...</p>
                <div class="text-link">Lees meer <img src="<?php echo get_template_directory_uri(); ?>/assets/images/icon-arrow.svg" alt="icon-arrow"></div>
              </div>
            </a>
          </div>
          <div class="swiper-slide">
            <a href="#" class="news-card">
              <div class="news-card-header">
                <div class="card-image">
                  <img src="<?php echo get_template_directory_uri(); ?>/assets/images/card-image.jpg" alt="card image" class="img-fluid">
                </div>
                <div class="news-card-tag tag-bg-red">
                  <img src="<?php echo get_template_directory_uri(); ?>/assets/images/icon-sun.svg" alt="sun icon">
                  talentontwikkeling
                </div>
              </div>
              <div class="news-card-body">
                <h3>Don Bosco De Maten tegen bekende Youtubers?</h3>
                <p>Het doel is dit keer niet om te winnen, maar om geld op te halen voor de Voedselbank in Apel...</p>
                <div class="text-link">Lees meer <img src="<?php echo get_template_directory_uri(); ?>/assets/images/icon-arrow.svg" alt="icon-arrow"></div>
              </div>
            </a>
          </div>
          <div class="swiper-slide">
            <a href="#" class="news-card">
              <div class="news-card-header">
                <div class="card-image">
                  <img src="<?php echo get_template_directory_uri(); ?>/assets/images/card-image.jpg" alt="card image" class="img-fluid">
                </div>
                <div class="news-card-tag tag-bg-ylw">
                  <img src="<?php echo get_template_directory_uri(); ?>/assets/images/icon-info.svg" alt="info icon">
                  vrije tijd
                </div>
              </div>
              <div class="news-card-body">
                <h3>Don Bosco De Maten tegen bekende Youtubers?</h3>
                <p>Het doel is dit keer niet om te winnen, maar om geld op te halen voor de Voedselbank in Apel...</p>
                <div class="text-link">Lees meer <img src="<?php echo get_template_directory_uri(); ?>/assets/images/icon-arrow.svg" alt="icon-arrow"></div>
              </div>
            </a>
          </div>
          <div class="swiper-slide">
            <a href="#" class="news-card">
              <div class="news-card-header">
                <div class="card-image">
                  <img src="<?php echo get_template_directory_uri(); ?>/assets/images/card-image.jpg" alt="card image" class="img-fluid">
                </div>
                <div class="news-card-tag tag-bg-green">
                  <img src="<?php echo get_template_directory_uri(); ?>/assets/images/icon-info.svg" alt="info icon">
                  Activiteitein
                </div>
              </div>
              <div class="news-card-body">
                <h3>Don Bosco De Maten tegen bekende Youtubers?</h3>
                <p>Het doel is dit keer niet om te winnen, maar om geld op te halen voor de Voedselbank in Apel...</p>
                <div class="text-link">Lees meer <img src="<?php echo get_template_directory_uri(); ?>/assets/images/icon-arrow.svg" alt="icon-arrow"></div>
              </div>
            </a>
          </div>
          <div class="swiper-slide">
            <a href="#" class="news-card">
              <div class="news-card-header">
                <div class="card-image">
                  <img src="<?php echo get_template_directory_uri(); ?>/assets/images/card-image.jpg" alt="card image" class="img-fluid">
                </div>
                <div class="news-card-tag tag-bg-red">
                  <img src="<?php echo get_template_directory_uri(); ?>/assets/images/icon-sun.svg" alt="sun icon">
                  talentontwikkeling
                </div>
              </div>
              <div class="news-card-body">
                <h3>Don Bosco De Maten tegen bekende Youtubers?</h3>
                <p>Het doel is dit keer niet om te winnen, maar om geld op te halen voor de Voedselbank in Apel...</p>
                <div class="text-link">Lees meer <img src="<?php echo get_template_directory_uri(); ?>/assets/images/icon-arrow.svg" alt="icon-arrow"></div>
              </div>
            </a>
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
  </section>
<?php get_footer(); ?>