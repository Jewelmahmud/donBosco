
<?php 

    // Template name: Timeline
    get_header(); 

    $info = get_field('info_section'); 
    $timelines = get_field('timeline_section'); 
?>

<section class="timeline-text-wrapper pt-5 mt-3 mt-lg-5">
    <div class="container">
      <div class="row">
        <div class="col-xl-10 mb-3 mb-xl-5">
          <div class="subtitle"><?php echo $info['subtitle']; ?></div>
          <h2><?php echo $info['title']; ?></h2>
          <p class="fw-bold"><?php echo $info['texts']; ?></p>

          
        </div>
      </div>
    </div>
    <div class="don-bosco"><?php echo $info['brand_name']; ?></div>
  </section>

  <section class="timeline">
    <div class="container">
      <div class="swiper-container-wrapper swiper-container-wrapper--timeline">
        <div class="timeline-pagination-responsive">
        <!-- Timeline -->
        <ul class="swiper-pagination-custom">
            <?php if($timelines){
                foreach($timelines as $index => $item ){?>
                    <li class='swiper-pagination-switch <?php if($index === 0) echo 'first active'; ?>'><span class='switch-title'><?php echo $item['year']; ?></span></li>
               <?php }
            }?>
        </ul>
      
        <!-- Progressbar -->
        <div class="swiper-pagination swiper-pagination-progressbar swiper-pagination-horizontal">
          
        </div>
      </div>
        <!-- Swiper -->
        <div class="swiper swiper-container swiper-container--timeline">
          <div class="swiper-wrapper"><?php 

            if($timelines){
                foreach($timelines as $index => $item ){?>
                    <div class="swiper-slide">
                    <div class="timeline-item">
                        <div class="year-rotate"><span><?php echo $item['year']; ?></span></div>
                        <div class="text-content">
                        <div class="year"><?php echo $item['year']; ?></div>
                        <h4><?php echo $item['main_title']; ?></h4>
                        <p><?php echo $item['description']; ?></p>
                        </div>
                        <div class="image-content">
                        <img src="<?php echo $item['timeline_image']['url']; ?>" alt="<?php echo $item['timeline_image']['alt']; ?>" class="img-fluid">
                        </div>
                    </div>
                    </div><?php 
                }
            }
            
            ?>
            
          </div>
        </div>
      </div>
    </div>
  </section>

  <?php get_footer(); ?>