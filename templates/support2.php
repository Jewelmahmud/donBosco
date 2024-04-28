<?php 

// template name: Support 2
get_header(); 
$section1 = get_field('section_1');
?>
 
 <section class="py-5 pb-xl-0">
    <div class="container py-3 pt-xl-5 pb-xl-0 mt-xl-5">
      <div class="row justify-content-between align-items-center mt-xl-4">
          <div class="col-md-6 mb-4 mb-md-0">
            <div class="position-relative mb-xl-m41">
              <img src="<?php echo $section1['images']['url']; ?>" alt="<?php echo $section1['images']['alt']; ?>" class="w-100">
              <div class="border-image"></div>
              <div class="position-absolute box-with-user bg-primary">
                <img src="<?php echo get_template_directory_uri(); ?>/assets/images/icon-users-w.svg" alt="icon-users">
              </div>
              <div class="position-absolute bottom-0 start-0">
                 <div class="image-over-text fw-bold text-white text-community"><?php echo $section1['text_on_image']; ?></div>
              </div>
            </div>
          </div>
          <div class="col-md-6 col-xl-5">
            <div class="subtitle"><?php echo $section1['subtitle']; ?></div>
            <h2><?php echo $section1['title']; ?></h2>
            <p class="mb-xl-5"><?php echo $section1['texts']; ?></p>
            <a href="<?php echo $section1['link']['url']; ?>" class="btn btn-primary btn-with-arrow" style="padding:1rem 3rem 0.9rem" target="<?php echo $section1['link']['target']; ?>"><?php echo $section1['link']['title']; ?> <svg width="8" height="12" viewBox="0 0 8 12" fill="currentColor" xmlns="http://www.w3.org/2000/svg"><circle cx="2" cy="2" r="2" fill="currentColor"/><circle cx="6" cy="6" r="2" fill="currentColor"/><circle cx="2" cy="10" r="2" fill="currentColor"/></svg></a>
          </div>
      </div>
    </div>
  </section>

  <?php $section2 = get_field('section_2'); ?>
  <section class="bg-primary text-white py-5">
    <div class="container">
      <div class="row align-items-end py-4 pt-lg-5 mt-lg-5">
        <div class="col-md-6 pe-lg-5">
          <div class="subtitle text-white">
            <?php echo $section2['subtitle']; ?>
          </div>
          <h2 class="text-white"><?php echo $section2['title']; ?></h2>
          <div class="pe-lg-5">
            <p><?php echo $section2['texts']; ?></p>
          <div class="bg-white px-4 py-3">
            <div class="d-flex align-items-center justify-content-between">
              <div>
                <h6 class="p-color mb-0"><?php echo $section2['donbosco']['number']; ?></h6>
                <div style="font-size: 12px;color: #505050;"><?php echo $section2['donbosco']['name']; ?></div>
              </div>
              <div>
                <img src="<?php echo $section2['donbosco']['icon']['url']; ?>" alt="<?php echo $section2['donbosco']['icon']['alt']; ?>">
              </div>
            </div>
          </div>
          </div>
        </div>
        <div class="col-md-6">
        <div class="swiper single-image-carousel">
          <div class="border-image"></div>
          <div class="swiper-wrapper">
            <div class="swiper-slide"><img src="<?php echo $section2['images']['url']; ?>" alt="<?php echo $section2['images']['alt']; ?>" class="img-fluid"></div>
            <div class="swiper-slide"><img src="<?php echo $section2['images']['url']; ?>" alt="<?php echo $section2['images']['alt']; ?>" class="img-fluid"></div>
            <div class="swiper-slide"><img src="<?php echo $section2['images']['url']; ?>" alt="<?php echo $section2['images']['alt']; ?>" class="img-fluid"></div>
            <div class="swiper-slide"><img src="<?php echo $section2['images']['url']; ?>" alt="<?php echo $section2['images']['alt']; ?>" class="img-fluid"></div>
          </div>
          <div class="swiper-pagination"></div>
        </div>
        </div>
      </div>
    </div>
  </section>
  
  <?php $activity = get_field('activity_&_pricing'); ?>

  <section class="mb-5 mt-3 my-xl-5 pt-5 pb-xl-5">
    <div class="container mb-4 mb-xl-5 mt-xl-5 pt-xl-5 pb-xl-4">
      <div class="row align-items-end">
        <div class="col-12 col-xl-10">
          <div class="subtitle"><?php echo $activity['subtitle']; ?></div>
            <h2><?php echo $activity['title']; ?></h2>
           <p class="mb-lg-0"><?php echo $activity['texts']; ?></p>
        </div> 
        
      </div>
    </div>
    <div class="four-column-full four-col-carousel-2 swiper">
      <div class="swiper-wrapper">
        <div class="swiper-slide">
          <a href="#" class="column">
            <img src="<?php echo get_template_directory_uri();?>/assets/images/pexels-rheza-aulia-3375234.jpg" alt="pexels-rheza-aulia-3375234" class="slider-image">
            <div class="overlay-content">
              <div class="content-top d-flex align-items-center justify-content-between">
                <div>
                  <h4>Kinderen</h4>
                  <p>Na school</p>
                </div>
                <div>
                  <div class="price"><span class="currency-sign">€</span> 750,-</div>
                </div>
              </div>
              <ul class="features">
                <li>Logo vermelding website</li>
                <li>Logo vermelding Social Media</li>
                <li>Vriend van plakaat</li>
                <li>Uitnodiging bijeenkomsten</li>
              </ul>
              <div class="text-link">bekijk alles <img src="<?php echo get_template_directory_uri();?>/assets/images/icon-arrow.svg" alt="icon-arrow"></div>
              <div class="content-btn">Lees VERDER</div>
            </div>
          </a>
        </div>
        <div class="swiper-slide">
          <a href="#" class="column">
            <img src="<?php echo get_template_directory_uri();?>/assets/images/mi-pham-xtd3zYWxEs4-unsplash.jpg" alt="mi-pham-xtd3zYWxEs4-unsplash" class="slider-image">
            <div class="overlay-content">
              <div class="content-top d-flex align-items-center justify-content-between">
                <div>
                  <h4>Kinderen</h4>
                  <p>Na school</p>
                </div>
                <div>
                  <div class="price"><span class="currency-sign">€</span> 750,-</div>
                </div>
              </div>
              <ul class="features">
                <li>Logo vermelding website</li>
                <li>Logo vermelding Social Media</li>
                <li>Vriend van plakaat</li>
                <li>Uitnodiging bijeenkomsten</li>
              </ul>
              <div class="text-link">bekijk alles <img src="<?php echo get_template_directory_uri();?>/assets/images/icon-arrow.svg" alt="icon-arrow"></div>
              <div class="content-btn">Lees VERDER</div>
            </div>
          </a>
        </div>
        <div class="swiper-slide">
          <a href="#" class="column">
            <img src="<?php echo get_template_directory_uri();?>/assets/images/mask-group.jpg" alt="mask-group" class="slider-image">
            <div class="overlay-content">
              <div class="content-top d-flex align-items-center justify-content-between">
                <div>
                  <h4>Kinderen</h4>
                  <p>Na school</p>
                </div>
                <div>
                  <div class="price"><span class="currency-sign">€</span> 750,-</div>
                </div>
              </div>
              <ul class="features">
                <li>Logo vermelding website</li>
                <li>Logo vermelding Social Media</li>
                <li>Vriend van plakaat</li>
                <li class="not-available">Uitnodiging bijeenkomsten</li>
              </ul>
              <div class="text-link">bekijk alles <img src="<?php echo get_template_directory_uri();?>/assets/images/icon-arrow.svg" alt="icon-arrow"></div>
              <div class="content-btn">Lees VERDER</div>
            </div>
          </a>
        </div>
        <div class="swiper-slide">
          <a href="#" class="column">
            <img src="<?php echo get_template_directory_uri();?>/assets/images/cdc-GDokEYnOfnE-unsplash.jpg" alt="cdc-GDokEYnOfnE-unsplash" class="slider-image">
            <div class="overlay-content">
              <div class="content-top d-flex align-items-center justify-content-between">
                <div>
                  <h4>Kinderen</h4>
                  <p>Na school</p>
                </div>
                <div>
                  <div class="price"><span class="currency-sign">€</span> 750,-</div>
                </div>
              </div>
              <ul class="features">
                <li>Logo vermelding website</li>
                <li>Logo vermelding Social Media</li>
                <li>Vriend van plakaat</li>
                <li>Uitnodiging bijeenkomsten</li>
              </ul>
              <div class="text-link">bekijk alles <img src="<?php echo get_template_directory_uri();?>/assets/images/icon-arrow.svg" alt="icon-arrow"></div>
              <div class="content-btn">Lees VERDER</div>
            </div>
          </a>
        </div>
      </div>
      
        <div class="swiper-next swiper-arrow">
          <img src="<?php echo get_template_directory_uri();?>/assets/images/icon-arrow.svg" alt="icon-arrow">
        </div>
        <div class="swiper-prev swiper-arrow">
          <img src="<?php echo get_template_directory_uri();?>/assets/images/icon-arrow.svg" alt="icon-arrow">
        </div>
      
    </div>
  </section>

  <?php get_footer(); ?>