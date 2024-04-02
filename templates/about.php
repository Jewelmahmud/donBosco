<?php

//Template Name: About

get_header(); ?>

<section class="about-wrapper">

  <?php   $first_section = get_field('first_section');  ?>

    <div class="block-row block-row-one">
      <div class="container">
        <div class="row align-items-center justify-content-between">
          <div class="col-lg-5 order-2 order-lg-1">
            <div class="text-block" data-aos="fade-right">
              <div class="pre-title"><?php echo $first_section['subtitle']; ?></div>
                <h3><?php echo $first_section['title']; ?></h3>
                <p><?php echo $first_section['texts']; ?></p>
                <?php  
                  $link = $first_section['link']; 
                  $link2 = $first_section['link_2']; 
                
                ?>
                <div class="d-flex align-items-center gap-2">
                <?php if($link){ ?>
                <a href="<?php echo $link['url'] ?>" target="<?php echo $link['target'] ?>" class="btn btn-secondary"><?php echo $link['title'] ?></a>
                <?php } ?>
                <?php if($link2){ ?>
                <a href="<?php echo $link2['url'] ?>" target="<?php echo $link2['target'] ?>" class="btn btn-secondary"><?php echo $link2['title'] ?></a>
                <?php } ?>
              </div>
              
            </div>
          </div>
          <div class="col-lg-5 order-1 order-lg-2">
            <div class="image-block" data-aos="fade-left">
            <?php 
                $image = $first_section['images'];
                // var_dump($first_section);
                if($image){
              ?>
              <img src="<?php echo $image['url'] ?>" alt="<?php echo $image['alt'] ?>" class="img-fluid rounded">
              <?php } ?>
              <div class="shape-5"><img src="<?php echo get_template_directory_uri(); ?>/assets/images/icons/shape-5.svg" alt="shape-5" class="img-fluid"></div>
              <div class="circle-small"></div>
              <div class="circle-large"></div>
              <div class="bold-line-small"></div>
            </div>
          </div>
        </div>
      </div>
    </div>


    <?php   $second_section = get_field('second_section');  ?>
    <div class="block-row block-row-two">
      
      <canvas id="logo-b2-rive" width="120px" height="120px"></canvas>
      <div class="container">
        <div class="row align-items-end justify-content-between position-relative">
          <div class="col-lg-6">
            
            <div class="image-block" data-aos="fade-right">
            <img src="<?php echo get_template_directory_uri(); ?>/assets/images/block-row-two-bg.svg" alt="block-row-two-bg" class="block-row-two-bg img-fluid">
              <?php if($second_section['image']): ?>
              <img src="<?php echo $second_section['image']['url'] ?>" alt="<?php echo $second_section['image']['alt'] ?>" class="img-fluid">
              <?php endif; ?>
              <canvas id="smile-rive5" width="80px" height="80px"></canvas>
            </div>
          </div>
          <div class="col-lg-5">
            <div class="text-block" data-aos="fade-left">
              <div class="pre-title"><?php echo $second_section['subtitle']?></div>
              <h3><?php echo $second_section['title']?></h3>
              <p><?php echo $second_section['texts']?></p>
              
            </div>
          </div>
          
        </div>
      </div>
      <canvas id="b2-wave-rive" width="1440px" height="98px"></canvas>
    </div>


    <?php $third = get_field('third_section'); ?>
    <div class="block-row block-row-three">
      <div class="circle-half d-none d-lg-block"><svg xmlns="http://www.w3.org/2000/svg" width="138" height="201" viewBox="0 0 138 201" fill="none">
        <path d="M194.5 100.5C194.495 127.025 184.27 152.459 166.078 171.21C147.887 189.961 123.219 200.494 97.5 200.5C71.7791 200.5 47.1083 189.968 28.916 171.216C10.7233 152.464 0.5 127.027 0.5 100.5C0.5 73.9736 10.7233 48.5365 28.916 29.7839C47.1083 11.0319 71.7791 0.5 97.5001 0.5C123.219 0.505585 147.887 11.0392 166.078 29.7901C184.27 48.5415 194.495 73.9754 194.5 100.5Z" stroke="#F56537"/>
      </svg></div>
      <div class="container">
        <div class="row justify-content-between">
          <div class="col-lg-5">
            <div class="text-block" data-aos="fade-right">
              <div class="pre-title"><?php echo $third['left_side']['sub_title']; ?></div>
              <h3><?php echo $third['left_side']['title']; ?></h3>
              <p><?php echo $third['left_side']['texts']; ?></p>
              <?php if($third['left_side']['link']): ?>
              <a href="<?php echo $third['left_side']['link']['url']; ?>"  class="link-btn" target="<?php echo $third['left_side']['link']['target']; ?>"><?php echo $third['left_side']['link']['title']; ?> <svg xmlns="http://www.w3.org/2000/svg" width="7" height="10" viewBox="0 0 7 10" fill="none">
              <?php endif; ?>
  <path d="M1 1L5 5L1 9" stroke="#FF551E" stroke-width="2"/>
</svg></a>
            </div>
          </div>
          <div class="col-12 col-lg">
            <div class="block-row-devider"></div>
          </div>
          <div class="col-lg-5">
            <div class="text-block" data-aos="fade-left">
              <div class="pre-title"><?php echo $third['right_side']['sub_title']; ?></div>
              <h3><?php echo $third['right_side']['title']; ?></h3>
              <ul>
                <?php 
                  if($third['right_side']['list_items']) {
                    foreach($third['right_side']['list_items'] as $list){
                      echo '<li><img src="'.$list["icon"]["url"].'" alt="'.$list["icon"]["alt"].'" > <div>'.$list['item_texts'].'</div></li>';
                    }
                  }                
                ?>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </div>


    <?php $fourth = get_field('fourth_section'); ?>
    <div class="block-row block-row-four">
      <div class="container" data-aos="fade-right">
        <div class="row justify-content-between align-items-end">
          <div class="col-md-9 col-xl-8">
            <div class="pre-title"><?php echo $fourth['subtitle']; ?></div>
              <h3><?php echo $fourth['title']; ?></h3>
          </div>
          <div class="col-auto">
            <div class="slide-actions">
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
        </div> 
        
        <?php if($fourth['timelines']): ?>
        <div class="timeline-carousel-wrapper">
          <div class="horizontal-line"></div>
          <div class="container" data-aos="fade-right" data-aos-delay="200">
            <div class="swiper swiper-container timeline-carousel">
              <div class="swiper-wrapper">
                <?php foreach($fourth['timelines'] as $timeline): ?>
                  <div class="swiper-slide">
                    <div class="timeline">
                      <div class="year"><?php echo $timeline['year']; ?></div>
                      <div class="dot"></div>
                      <div class="content">
                        <h5><?php echo $timeline['title']; ?></h5>
                        <p><?php echo $timeline['texts']; ?> </p>
                      </div>
                    </div>
                  </div>
                <?php endforeach; ?>
              </div>
            </div>
          </div>
        </div>
        <?php endif; ?>
       
    </div>
  </section>




  <section class="b2-counter">
    <div class="counter-line-animation top"></div>
    <canvas id="smile-rive2" width="82" height="82" class="d-none d-lg-block"></canvas>
    <canvas id="white-line" width="108" height="70" class="d-none d-lg-block"></canvas>
    <svg xmlns="http://www.w3.org/2000/svg" width="105" height="108" viewBox="0 0 105 108" fill="none"
      class="circle-dot d-none d-xxl-block">
      <path
        d="M32 92C31.9991 96.2432 30.3131 100.312 27.3127 103.313C24.3124 106.313 20.2432 107.999 16 108C11.7566 108 7.68689 106.314 4.68631 103.314C1.68572 100.313 0 96.2435 0 92C0 87.7565 1.68572 83.6869 4.68631 80.6863C7.68689 77.6857 11.7566 76 16 76C20.2432 76.0009 24.3124 77.6869 27.3127 80.6873C30.3131 83.6877 31.9991 87.7568 32 92Z"
        fill="#FE6330" />
      <path opacity="0.1"
        d="M89.2664 89.2663C99.0176 79.5151 104.497 66.2905 104.5 52.5001L89.2664 89.2663ZM89.2664 89.2663C79.5151 99.0176 66.2904 104.497 52.5 104.5M89.2664 89.2663L52.5 104.5M52.5 104.5C38.7088 104.5 25.4824 99.0215 15.7305 89.2696M52.5 104.5L15.7305 89.2696M15.7305 89.2696C5.9786 79.5177 0.5 66.2913 0.5 52.5M15.7305 89.2696L0.5 52.5M0.5 52.5C0.5 38.7088 5.9786 25.4823 15.7305 15.7304M0.5 52.5L15.7305 15.7304M15.7305 15.7304C25.4824 5.97856 38.7087 0.500028 52.5 0.5L15.7305 15.7304ZM52.5001 0.5C66.2904 0.502934 79.5151 5.98242 89.2664 15.7337C99.0176 25.4849 104.497 38.7096 104.5 52.4999L52.5001 0.5Z"
        stroke="#F56537" />
    </svg>
    <div class="container counter">
      <div class="row">
        <div class="col-12 mb-4 mb-lg-5 text-center">
          <?php $counting_section = get_field('counters', 'option'); ?>
          <h4><?php echo $counting_section['title']; ?></h4>
        </div>
      </div>
      <div class="row">
      
      <?php
          if ($counting_section) {
              ?>
              <div class="col-6 col-md-6 col-lg" data-aos="fade-up">
                  <div class="item">
                      <canvas id="icon-calendar-rive" width="28" height="28"></canvas>
                      <div class="count" data-count="<?php echo esc_attr($counting_section['experience']['experience_count']); ?>">0+</div>
                      <div class="text"><?php echo esc_html($counting_section['experience']['texts']); ?></div>
                  </div>
              </div>

              <div class="col-6 col-md-6 col-lg" data-aos="fade-up" data-aos-delay="50">
                  <div class="item">
                      <canvas id="icon-people-b2-rive" width="28" height="28"></canvas>
                      <div class="plus count" data-count="<?php echo esc_attr($counting_section['people_we_helped']['helped_count']); ?>">0+</div>
                      <div class="text"><?php echo esc_html($counting_section['people_we_helped']['texts']); ?></div>
                  </div>
              </div>

              <div class="col-6 col-md-6 col-lg" data-aos="fade-up" data-aos-delay="100">
                  <div class="item">
                      <canvas id="icon-user-rive" width="28" height="28"></canvas>
                      <div class="count" data-count="<?php echo esc_attr($counting_section['satisfied_client']['client_count']); ?>">0+</div>
                      <div class="text"><?php echo esc_html($counting_section['satisfied_client']['texts']); ?></div>
                  </div>
              </div>

              <div class="col-6 col-md-6 col-lg" data-aos="fade-up" data-aos-delay="150">
                  <div class="item">
                      <canvas id="icon-home-rive" width="28" height="28"></canvas>
                      <div class="plus count" data-count="<?php echo esc_attr($counting_section['housing_site']['housing_count']); ?>">0+</div>
                      <div class="text"><?php echo esc_html($counting_section['housing_site']['texts']); ?></div>
                  </div>
              </div>
              <?php
          }
          ?>






      </div>
    </div>
    <div class="counter-line-animation bottom"></div>
  </section>
  


  <?php $clients = get_field('client_logo', 'option'); ?>
  <section class="b2-clients text-center" data-aos="fade-up" data-aos-delay="200">
    <div class="container">
    <h4 class="foto-note"><?php echo $clients['bottom_title']; ?></h4>
      <div class="swiper clients-logo">
        <div class="swiper-wrapper">
          <?php  if($clients['logos']): foreach($clients['logos'] as $clientlogo): ?>
            <div class="swiper-slide"><img src="<?php echo $clientlogo['logo_upload']['url'];  ?>" alt="<?php echo $clientlogo['logo_upload']['alt'];  ?>"></div>
          <?php endforeach; endif; ?>
        </div>

      </div>
      
    </div>
  </section>
    
  <?php get_footer(); ?>

<script>
  const b2Logo = initializeRive("<?php echo get_template_directory_uri();?>/assets/rive/main-logo.riv", "main-logo", "b2Logo");
  const r2 = initializeRive("<?php echo get_template_directory_uri();?>/assets/rive/smile-rive.riv", "smile-rive5", "r2");
  const r8 = initializeRive("<?php echo get_template_directory_uri();?>/assets/rive/logo-b2-white.riv", "logo-b2-white", "r8");
  const r9 = initializeRive("<?php echo get_template_directory_uri();?>/assets/rive/line-white.riv", "line-white", "r9");
  const r10 = initializeRive("<?php echo get_template_directory_uri();?>/assets/rive/smile-white.riv", "smile-rive3", "r10");
  const r11 = initializeRive("<?php echo get_template_directory_uri();?>/assets/rive/b2-wave.riv", "b2-wave-rive", "r11");

  const rHome = initializeRive("<?php echo get_template_directory_uri();?>/assets/rive/icon-home.riv", "icon-home-rive", "rHome");
  // const rPeople = initializeRive("<?php // echo get_template_directory_uri();?>/assets/rive/icon-people-b2.riv", "icon-people-rive", "rPeople");
  const rUser = initializeRive("<?php echo get_template_directory_uri();?>/assets/rive/icon-user.riv", "icon-user-rive", "rUser");
  const rCalendar = initializeRive("<?php echo get_template_directory_uri();?>/assets/rive/icon-calendar.riv", "icon-calendar-rive", "rCalendar");
  const rPeople = initializeRive("<?php echo get_template_directory_uri();?>/assets/rive/icon-people-b2.riv", "icon-people-b2-rive", "rPeople");
</script>