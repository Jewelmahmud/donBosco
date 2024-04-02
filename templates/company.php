<?php

//Template Name: Company
get_header();



$section1 = get_field('section_1');
?>

<section class="company-wrapper">
    <?php
      // Assuming $section1 is the ACF field data
      $section1 = get_field('section_1');
      if ($section1) {  ?>
    <div class="block-row block-row-one">
      <div class="container">
        <div class="row align-items-center justify-content-between">
          <div class="col-lg-6 order-2 order-lg-1">
            <div class="text-block" data-aos="fade-right">
                <div class="pre-title"><?php echo $section1['subtitle']; ?></div>
                <h3><?php echo $section1['title']; ?></h3>
                <p><?php echo wp_kses_post($section1['texts']); ?></p>

                <?php if ($section1['link']) : ?>
                    <a href="<?php echo esc_url($section1['link']['url']); ?>" class="btn btn-secondary">
                        <?php echo esc_html($section1['link']['title']); ?>
                    </a>
                <?php endif; ?>
            </div>
          </div>
          <div class="col-lg-5 order-1 order-lg-2">
            <div class="image-block" data-aos="fade-left">
              <?php

                if ($section1 && $section1['images']) {
                    ?>
                    <img src="<?php echo esc_url($section1['images']['url']); ?>" alt="<?php echo esc_attr($section1['images']['alt']); ?>" class="img-fluid rounded">
                    <?php
                }
              ?>
              <canvas id="smile-rive5" width="80px" height="80px"></canvas>
              <img src="<?php echo get_template_directory_uri(); ?>/assets/images/icons/shape-2.svg" alt="shape-2" class="img-with-shape3">
              <div class="circle-large"></div>
              <div class="bold-line-small"></div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <?php
    }
?>

    <div class="block-row company-block-bg">
      <canvas id="logo-b2-rive" width="120px" height="120px"></canvas>
      
      <div class="container">
        <div class="row justify-content-between">
        <?php
            // Assuming $section2 is the ACF field data
            $section2 = get_field('section_2');

            if ($section2 && isset($section2['left'])) {
                $leftData = $section2['left'];
                ?>
                <div class="col-lg-5 position-relative">
                    <div class="position-absolute ani4" style="right: 10%; top: -5%;">
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/images//icons/shape-7.svg" alt="">
                    </div>
                    <div class="text-block" data-aos="fade-right">
                        <div class="pre-title"><?php echo esc_html($leftData['subtitle']); ?></div>
                        <h3><?php echo $leftData['title']; ?></h3>

                        <?php if ($leftData['paragraphs']): foreach($leftData['paragraphs'] as $item) : ?>
                        <div class="d-flex flex-column align-items-start flex-lg-row gap-3 gap-xl-4">
                            <?php if($item['para_icons']) {?>
                                <img src="<?php echo $item['para_icons']['url']; ?>"alt="<?php echo $item['para_icons']['alt']; ?>">
                            <?php } ?>
                            <p><?php echo wp_kses_post($item['para']); ?></p>
                        </div>
                        <?php endforeach; endif; ?>


                        <?php if ($leftData['link']) : ?>
                            <a href="<?php echo esc_url($leftData['link']['url']); ?>" class="btn btn-outline-secondary" target="<?php echo esc_url($leftData['link']['target']); ?>">
                                <?php echo esc_html($leftData['link']['title']); ?>
                            </a>
                        <?php endif; ?>
                    </div>
                </div>
                <?php
            }
            ?>

          <div class="col-12 col-lg">
            <div class="block-row-devider"></div>
          </div>
          <?php
          

            if ($section2 && isset($section2['right'])) {
                $rightData = $section2['right'];
                ?>
                <div class="col-lg-5 position-relative">
                    <div class="text-block" data-aos="fade-left">
                        <div class="pre-title"><?php echo $rightData['subtitle']; ?></div>
                        <h3><?php echo $rightData['title']; ?></h3>


                        <?php if ($rightData['paragraphs']): foreach($rightData['paragraphs'] as $item) : ?>
                        <div class="d-flex flex-column align-items-start flex-lg-row gap-3 gap-xl-4">
                            <?php if($item['para_icon']) {?>
                            <img src="<?php echo $item['para_icon']['url']; ?>"alt="<?php echo $item['para_icon']['alt']; ?>">
                            <?php } ?>
                            <p><?php echo wp_kses_post($item['para']); ?></p>
                        </div>
                        <?php endforeach; endif; ?>


                        <!-- <div class="d-flex flex-column align-items-start flex-lg-row gap-3 gap-xl-4">
                        <img src="<?php echo $rightData['para_1_icon']['url']; ?>"alt="<?php echo $rightData['para_1_icon']['alt']; ?>">
                        <?php echo wp_kses_post($rightData['para_1']); ?>
                        </div>
                        <div class="d-flex flex-column align-items-start flex-lg-row gap-3 gap-xl-4">
                        <img src="<?php echo $rightData['para_2_icon']['url']; ?>"alt="<?php echo $rightData['para_2_icon']['alt']; ?>">
                        <?php echo wp_kses_post($rightData['Para_2']); ?>
                        </div>
 -->



                        <?php if ($rightData['link']) : ?>
                            <a href="<?php echo esc_url($rightData['link']['url']); ?>" class="btn btn-outline-secondary" target="<?php echo $rightData['link']['target']; ?>">
                                <?php echo esc_html($rightData['link']['title']); ?>
                            </a>
                        <?php endif; ?>
                    </div>

                    <div class="position-absolute d-none d-lg-block ani3" style="right: 0; bottom: 20%;">
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/images//icons/shape-6.svg" alt="">
                    </div>
                </div>
                <?php
            }
            ?>

        </div>
      </div>
    </div>
    <div class="block-row block-row-one" style="border-bottom: 1px solid #e5e5e5;">
      <div class="container">
      <?php
        // Assuming $section3 is the ACF field data
        $section3 = get_field('section_3');

        if ($section3) {
            ?>
            <div class="row align-items-center justify-content-between" id="social">
                <div class="col-lg-5">
                    <?php if ($section3['imagee']) : ?>
                        <div class="image-block" data-aos="fade-right">
                            <img src="<?php echo esc_url($section3['imagee']['url']); ?>" alt="<?php echo esc_attr($section3['imagee']['alt']); ?>" class="img-fluid rounded">
                            <canvas id="smile-rive6" class="position-absolute" width="80px" height="80px" style="top: 5%; left: -2%;"></canvas>

                            <div class="circle-small" style="bottom: 10%; top: auto"></div>
                            <div class="bold-line-small"></div>
                        </div>
                    <?php endif; ?>
                </div>
                <div class="col-lg-6">
                    <?php if ($section3['subtitle'] || $section3['title'] || $section3['texts'] || $section3['link']) : ?>
                        <div class="text-block" data-aos="fade-left">
                            <?php if ($section3['subtitle']) : ?>
                                <div class="pre-title"><?php echo esc_html($section3['subtitle']); ?></div>
                            <?php endif; ?>
                            <?php if ($section3['title']) : ?>
                                <h3><?php echo $section3['title']; ?></h3>
                            <?php endif; ?>
                            <?php if ($section3['texts']) : ?>
                                <?php echo wp_kses_post($section3['texts']); ?>
                            <?php endif; ?> 
                            <?php if ($section3['link']) : ?>
                              <a href="<?php echo esc_url($section3['link']['url']); ?>" class="btn btn-secondary" target="<?php echo esc_attr($section3['link']['target']); ?>">
                                  <?php echo esc_html($section3['link']['title']); ?>
                              </a>
                            <?php endif; ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
            <?php
        }
        ?>

      </div>
    </div>
    <div class="block-row mt-4 mt-lg-5">
      <div class="container">
      <?php
        // Assuming $section4 is the ACF field data
        $section4 = get_field('section_4');

        if ($section4) {
            ?>
            <div class="row justify-content-between">
                <div class="col-lg-5" data-aos="fade-right">
                    <?php if ($section4['subtitle'] || $section4['title'] || $section4['texts'] || $section4['link']) : ?>
                        <div class="text-block">
                            <?php if ($section4['subtitle']) : ?>
                                <div class="pre-title"><?php echo esc_html($section4['subtitle']); ?></div>
                            <?php endif; ?>
                            <?php if ($section4['title']) : ?>
                                <h3><?php echo $section4['title']; ?></h3>
                            <?php endif; ?>
                            <?php if ($section4['texts']) : ?>
                                <?php echo wp_kses_post($section4['texts']); ?>
                            <?php endif; ?>
                            <?php if ($section4['link']) : ?>
                                <a href="<?php echo esc_url($section4['link']['url']); ?>" class="link-btn" target="<?php echo esc_url($section4['link']['target']); ?>">
                                    <?php echo esc_html($section4['link']['title']); ?>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="7" height="10" viewBox="0 0 7 10" fill="none">
                                        <path d="M1 1L5 5L1 9" stroke="#FF551E" stroke-width="2"></path>
                                    </svg>
                                </a>
                            <?php endif; ?>
                        </div>
                    <?php endif; ?>
                </div>
                <div class="col-lg-6" data-aos="fade-left">
                    <?php if ($section4['numberd_items'] && is_array($section4['numberd_items']) && !empty($section4['numberd_items'])) : $i = 1; ?>
                    <h4 class="mb-3"><?php echo $section4['numbered_item_title']; ?></h4>
                        <div class="card-block">
                            <?php foreach ($section4['numberd_items'] as $item) : ?>
                                <div class="card-item">
                                    <?php if ($item['title']) : ?>
                                        <div class="count-number"><?php echo $i; $i++; ?></div>
                                    <?php endif; ?>
                                    <?php if ($item['texts']) : ?>
                                        <div>
                                            <h5><?php echo esc_html($item['title']); ?></h5>
                                            <p><?php echo wp_kses_post($item['texts']); ?></p>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            <?php endforeach; ?>
                        </div>
                        <!-- <button class="see-more-box">
                            <span class="toggle-text">see more</span> 
                            <svg xmlns="http://www.w3.org/2000/svg" class="toggle-arrow" width="10" height="7" viewBox="0 0 10 7" fill="none">
                              <path d="M9 1L5 5L1 1" stroke="#FF551E" stroke-width="2"/>
                            </svg>
                        </button> -->
                    <?php endif; ?>
                </div>
            </div>
            <?php
        }
        ?>
      </div>
    </div>
  </section>

<?php
// Assuming $testimonialSection is the ACF field data

$review = get_field('reviews');

if(!empty($review)) { 
    $testimonialSection = $review;
} else{
    $testimonialSection = get_field('testimonials', 'option');
} 





if ($testimonialSection) {
    ?>
    <section class="testimonial-wrapper" data-aos="fade-down" style="border-top: 1px solid #e5e5e5;">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <?php if ($testimonialSection['subtitle'] || $testimonialSection['title']) : ?>
                        <div class="pre-title"><?php echo $testimonialSection['subtitle']; ?></div>
                        <h2><?php echo $testimonialSection['title']; ?></h2>
                    <?php endif; ?>
                    <?php if ($testimonialSection['testimonial_details'] && is_array($testimonialSection['testimonial_details']) && !empty($testimonialSection['testimonial_details'])) : ?>
                        <div class="swiper swiper-container testimonial-sldier">
                            <div class="swiper-wrapper">
                                <?php foreach ($testimonialSection['testimonial_details'] as $testimonial) : ?>
                                    <div class="swiper-slide">
                                        <div class="t-item">
                                            <?php if ($testimonial['testimonial']) : ?>
                                                "<?php echo esc_html($testimonial['testimonial']); ?>"
                                            <?php endif; ?>
                                            <?php if ($testimonial['client_name'] || $testimonial['designation']) : ?>
                                                <div class="reviewer">
                                                    <?php if ($testimonial['client_image']) : ?>
                                                        <div class="image"><img src="<?php echo esc_url($testimonial['client_image']['url']); ?>" alt="reviewer"></div>
                                                    <?php endif; ?>
                                                    <div><strong><?php echo $testimonial['client_name']; ?>,</strong> <?php echo $testimonial['designation']; ?></div>
                                                </div>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                            <div class="btn-action">
                                <div class="swiper-pagination"></div>
                            </div>
                        </div>
                        <?php
                        $google_review = get_field('google_review', 'option');

                        if ($google_review) { 
                            $rating = $google_review['rating'];
                            $number_of_reviews = $google_review['number_of_reviews'];
                            $google_review_link = $google_review['google_review_link'];
                            ?>

                            <div class="google-review d-flex col-12">
                                <div>
                                    <div><?php echo str_replace('.', ',', $rating) ?>/5</div>
                                </div>
                                <div>
                                    <?php
                                    for ($i = 1; $i <= 5; $i++) {
                                        if ($i <= $rating) {
                                            echo '<svg xmlns="http://www.w3.org/2000/svg" width="17" height="17" viewBox="0 0 17 17" fill="none">
                                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M5.09498 14.3571C4.81877 14.5053 4.48227 14.4831 4.2279 14.2999C3.97353 14.1168 3.84576 13.8047 3.89865 13.4958L4.49203 10.062L1.97905 7.62896C1.75696 7.41054 1.67772 7.08518 1.77453 6.78911C1.87134 6.49304 2.12748 6.27734 2.43571 6.23232L5.90986 5.73123L7.46167 2.60436C7.60186 2.32432 7.88818 2.14746 8.20135 2.14746C8.51452 2.14746 8.80083 2.32432 8.94102 2.60436L10.4928 5.73123L13.967 6.23232C14.2752 6.27734 14.5314 6.49304 14.6282 6.78911C14.725 7.08518 14.6457 7.41054 14.4236 7.62896L11.9093 10.0606L12.5027 13.4944C12.5562 13.8036 12.4287 14.1162 12.1742 14.2997C11.9197 14.4833 11.5828 14.5055 11.3063 14.3571L8.19998 12.7376L5.09498 14.3571Z" fill="#FF551E" stroke="#FE6330" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                                </svg>';
                                        } else {
                                            echo '<svg xmlns="http://www.w3.org/2000/svg" width="17" height="17" viewBox="0 0 17 17" fill="none">
                                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M5.69508 14.3571C5.41887 14.5053 5.08237 14.4831 4.828 14.2999C4.57363 14.1168 4.44585 13.8047 4.49875 13.4958L5.09213 10.062L2.57915 7.62896C2.35705 7.41054 2.27782 7.08518 2.37463 6.78911C2.47144 6.49304 2.72758 6.27734 3.03581 6.23232L6.50996 5.73123L8.06177 2.60436C8.20196 2.32432 8.48827 2.14746 8.80144 2.14746C9.11461 2.14746 9.40093 2.32432 9.54112 2.60436L11.0929 5.73123L14.5671 6.23232C14.8753 6.27734 15.1314 6.49304 15.2283 6.78911C15.3251 7.08518 15.2458 7.41054 15.0237 7.62896L12.5094 10.0606L13.1028 13.4944C13.1563 13.8036 13.0288 14.1162 12.7743 14.2997C12.5198 14.4833 12.1829 14.5055 11.9064 14.3571L8.80008 12.7376L5.69508 14.3571Z" stroke="#FE6330" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                                </svg>';
                                        }
                                    }
                                    ?>
                                </div>
                                <div>
                                    <a href="<?php echo $google_review_link; ?>" target="_blank"> <?php echo $number_of_reviews; ?> google reviews</a>
                                </div>
                            </div>
                        <?php } ?>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </section>
    <?php
}
?>

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
const r1 = initializeRive("<?php echo get_template_directory_uri();?>/assets/rive/smile-white.riv", "smile-rive3", "r1");
const r2 = initializeRive("<?php echo get_template_directory_uri();?>/assets/rive/smile-rive.riv", "smile-rive5", "r2");
const r3 = initializeRive("<?php echo get_template_directory_uri();?>/assets/rive/logo-b2.riv", "logo-b2-rive", "r3");
const r5 = initializeRive("<?php echo get_template_directory_uri();?>/assets/rive/logo-b2-white.riv", "logo-b2-white", "r5");
const r6 = initializeRive("<?php echo get_template_directory_uri();?>/assets/rive/line-white.riv", "line-white", "r6");
const r7 = initializeRive("<?php echo get_template_directory_uri();?>/assets/rive/smile-rive.riv", "smile-rive6", "r7");



// document.addEventListener("DOMContentLoaded", function() {
//   const cardItems = document.querySelectorAll('.card-item');
//   const seeMoreBtns = document.querySelectorAll('.see-more-box');

//   const itemsToShow = 3;

//   // Function to toggle visibility of items
//   function toggleItemsVisibility() {
//     for (let i = itemsToShow; i < cardItems.length; i++) {
//       cardItems[i].classList.toggle('hidden');
//     }

//     const isHidden = cardItems[itemsToShow].classList.contains('hidden');
//     const buttonText = isHidden ? 'see more' : 'see less';
//     const arrowTransform = isHidden ? '' : 'rotate(180deg)';

//     seeMoreBtns.forEach(btn => {
//       btn.querySelector('.toggle-text').innerText = buttonText;
//       btn.querySelector('.toggle-arrow').style.transform = arrowTransform;
//     });
//   }

//   // Initially hide items beyond the specified limit
//   for (let i = itemsToShow; i < cardItems.length; i++) {
//     cardItems[i].classList.add('hidden');
//   }

//   // Event listener for the "See More" buttons
//   seeMoreBtns.forEach(btn => {
//     btn.addEventListener('click', toggleItemsVisibility);
//   });
// });


  </script>


