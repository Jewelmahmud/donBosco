<?php 

    // Template Name: Contact

    get_header();

      $map        = get_field('map_details', 'option');
      $latitude   = !empty($map['latitude'])? $map['latitude'] : 5.97454;
      $longitude  = !empty($map['longitude'])? $map['longitude'] : 52.29094;
      $iconsize   = !empty($map['icon_size']) ? $map['icon_size'] : 60;      
      $zoom       = !empty($map['zoom']) ? $map['zoom'] : 5;

      echo '<script>';
      echo 'const latitude = ' . json_encode($latitude) . ';';
      echo 'const longitude = ' . json_encode($longitude) . ';';
      echo 'const iconsize = ' . json_encode($iconsize) . ';';
      echo 'const zoom = ' .json_encode($zoom) . ';';
      echo 'console.log(zoom);';
      echo 'console.log(iconsize);';
      echo 'console.log(longitude);';
      echo 'console.log(latitude);';
      echo '</script>';

      $faqs = get_field('faq_&_certificates'); 

?>
 <section class="contact-wrapper">
    <div class="container">
      <div class="row">
        <div class="col-md-6">
          <div class="contact-left" data-aos="fade-right">
            
            
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
            <h1><?php the_field('main_title');?><br>
              <span class="p-color"><?php the_field('orange_title');?></span></h1>
              <p><?php the_field('description');?></p>

              <div class="send-email">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="23" viewBox="0 0 24 23" fill="none">
                  <path d="M21.7771 3.45776V11.9998" stroke="#FF551E" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                  <g opacity="0.5">
                    <path d="M23.0003 19.333H15.667" stroke="#FF551E" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M20.5557 16.8887L23.0001 19.3331L20.5557 21.7775" stroke="#FF551E" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                  </g>
                  <path d="M10.7777 16.8887H3.44443C2.09388 16.8887 1 15.7948 1 14.4442V3.45776" stroke="#FF551E" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                  <path fill-rule="evenodd" clip-rule="evenodd" d="M3.45787 1H19.321C20.6776 1 21.7789 2.09999 21.7789 3.45787V3.45787C21.7789 4.27309 21.3743 5.03453 20.6996 5.49164L14.1522 9.92949C12.4839 11.06 10.2937 11.06 8.62539 9.92949L2.07921 5.49286C1.40455 5.03575 1 4.27309 1 3.45909V3.45787C1 2.09999 2.09999 1 3.45787 1Z" stroke="#FF551E" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
                <div><?php echo __('or else send us an email', 'donbosco');?> <br> <a href="mailto:<?php the_field('email', 'option'); ?>"><?php the_field('email', 'option'); ?></a></div>

              </div>
              <div class="map" id="map"></div>
          </div>
        </div>
        <div class="col-md-6">
          <div class="contact-right" data-aos="fade-left">
            <h3><?php 
            $form_details = get_field('form_details');            
            echo $form_details['form_title'];  
            ?></h3>
            <?php
              

              function get_acf_field_value($field_name, $acf_settings, $type = 'placeholder') {
                  $field_key = 'field_' . $acf_settings[$field_name];
                  $value = get_field($field_key);
                  
                  if ($type === 'label') {
                      return esc_html($value);
                  } else {
                      return esc_attr($value);
                  }
              }

            ?>

            <form class="row g-3 g-xl-4" id="contact-form" data-url="<?php echo admin_url('admin-ajax.php'); ?>">
                <input type="hidden" name="honeypot" value="" id="honeypot">
                <div class="col-md-6">
                    <label for="naam" class="form-label"><?php echo $form_details['name_input']; ?> *</label>
                    <input type="text" class="form-control" id="naam" name="firstname" required>
                </div>
                <div class="col-md-6">
                    <label for="lastName" class="form-label"><?php echo $form_details['last_name_input']; ?></label>
                    <input type="text" class="form-control" id="lastName" name="lastName" >
                </div>
                <div class="col-12">
                    <label for="companyName" class="form-label"><?php echo $form_details['company_name_input']; ?></label>
                    <input type="text" class="form-control" id="companyName" name="companyName" >
                </div>
                <div class="col-md-6">
                    <label for="telephone" class="form-label"><?php echo $form_details['telephone_input']; ?> *</label>
                    <input type="tel" class="form-control" id="telephone" name="telephone" required>
                </div>
                <div class="col-md-6">
                    <label for="email" class="form-label"><?php echo $form_details['email_input']; ?> *</label>
                    <input type="email" class="form-control" id="email" name="email" required>
                </div>
                <div class="col-12">
                    <label for="textArea" class="form-label"><?php echo $form_details['textarea']; ?></label>
                    <textarea class="form-control" id="textArea" name="textArea" rows="5"></textarea>
                </div>

                <div class="col-12">
                    <div class="notes"><?php echo $form_details['agree_text']; ?></div>
                </div>
                <div class="col-12">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="gridCheck" name="checkbox">
                        <label class="form-check-label" for="gridCheck">
                        <?php echo $form_details['agree_check']; ?> *
                        </label>
                    </div>
                </div>
                <div class="col-12 submit-form-btns">
                    <button type="submit" class="btn btn-secondary submit-btn"><?php echo $form_details['send_button']; ?></button>
                    <div class="loader btn-secondary send-loader"></div>
                </div>
            </form>

            
        </div>

        </div>
      </div>
    </div>
  </section>

  <!-- <section class="faq-home pb-5 mb-lg-5">
    <?php $faq = get_field('faq_section'); ?>
    <div class="container">
      <div class="row">
        <div class="col-lg-6">
          <div class="faq-left" data-aos="fade-right">
            <div>
              <div class="pre-faq-title"><?php echo $faq['sub_title']; ?></div>
            <h2><?php echo $faq['title']; ?></h2>
            <a href="<?php echo $faq['faq_page_link']['url']; ?>" target="<?php echo $faq['faq_page_link']['target']; ?>" class="link-btn"><?php echo $faq['faq_page_link']['title']; ?> <svg xmlns="http://www.w3.org/2000/svg" width="7" height="10" viewBox="0 0 7 10" fill="none">
              <path d="M1 1L5 5L1 9" stroke="#FF551E" stroke-width="2"/>
            </svg></a>
            </div>
            <div class="address-holder d-flex justify-content-between">
              <div class="left">
                <ul>
                  <?php if(get_field('location', 'option')): ?>
                  <li><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none">
                    <path d="M7.5 11.8374C4.58917 12.2382 2.5 13.3141 2.5 14.5832C2.5 16.1941 5.8575 17.4999 10 17.4999C14.1425 17.4999 17.5 16.1941 17.5 14.5832C17.5 13.3141 15.4108 12.2382 12.5 11.8374" stroke="#FF551E" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M10.0002 14.1667V7.5" stroke="#FF551E" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M11.7678 3.23223C12.7441 4.20854 12.7441 5.79146 11.7678 6.76776C10.7915 7.74407 9.20854 7.74407 8.23223 6.76776C7.25592 5.79146 7.25592 4.20854 8.23223 3.23223C9.20854 2.25592 10.7915 2.25592 11.7678 3.23223" stroke="#FF551E" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                  </svg> <?php echo get_field('location', 'option'); ?></li>
                  <?php endif; ?>
                  <?php if(get_field('whatsapp', 'option')): ?>
                  <li><svg xmlns="http://www.w3.org/2000/svg" width="17" height="17" viewBox="0 0 17 17" fill="none">
<path d="M10.1133 10.8705L10.7747 10.214C11.3823 9.61126 12.3434 9.5347 13.0438 10.0267C13.7215 10.5023 14.334 10.9291 14.9041 11.3266C15.8099 11.9554 15.919 13.2455 15.1387 14.0242L14.5539 14.609" stroke="#FF551E" stroke-width="1.3" stroke-linecap="round" stroke-linejoin="round"/>
<path d="M2.05078 2.10512L2.63559 1.52031C3.41425 0.741655 4.7044 0.850798 5.33319 1.75489C5.72904 2.32503 6.15583 2.93753 6.63313 3.61519C7.12508 4.31566 7.05015 5.27676 6.44579 5.88437L5.78931 6.54574" stroke="#FF551E" stroke-width="1.3" stroke-linecap="round" stroke-linejoin="round"/>
<path d="M14.5548 14.6095C12.1422 17.0106 8.08768 14.9711 4.88672 11.7686" stroke="#FF551E" stroke-width="1.3" stroke-linecap="round" stroke-linejoin="round"/>
<path d="M4.89013 11.7733C1.68917 8.57068 -0.350324 4.51776 2.05081 2.10522" stroke="#FF551E" stroke-width="1.3" stroke-linecap="round" stroke-linejoin="round"/>
<path d="M5.78711 6.54614C6.30676 7.36552 6.97301 8.17676 7.72561 8.92935L7.72886 8.93261C8.48146 9.6852 9.29269 10.3515 10.1121 10.8711" stroke="#FF551E" stroke-width="1.3" stroke-linecap="round" stroke-linejoin="round"/>
</svg> <a href="tel: <?php echo get_field('whatsapp', 'option'); ?> "><?php echo get_field('whatsapp', 'option'); ?> </a></li>
                  <?php endif; ?>
                  <?php if(get_field('email', 'option')): ?>
                  <li><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none">
                    <path fill-rule="evenodd" clip-rule="evenodd" d="M12.8119 10.5982L16.5669 8.05234C17.151 7.65734 17.5002 6.99817 17.5002 6.29317V6.29317C17.5002 5.11817 16.5485 4.1665 15.3744 4.1665H4.63853C3.46436 4.1665 2.5127 5.11817 2.5127 6.29234V6.29234C2.5127 6.99734 2.86186 7.6565 3.44603 8.05234L7.20103 10.5982C8.8952 11.7465 11.1177 11.7465 12.8119 10.5982V10.5982Z" stroke="#FF551E" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M2.5 6.29248V14.1666C2.5 15.5475 3.61917 16.6666 5 16.6666H15C16.3808 16.6666 17.5 15.5475 17.5 14.1666V6.29331" stroke="#FF551E" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                  </svg> <a href="mailto:<?php echo get_field('email', 'option'); ?>"><?php echo get_field('email', 'option'); ?></a></li>
                  <?php endif; ?>
                </ul>
              </div>
              <div class="right">
              <canvas id="quadrados-b2" width="150" height="134"></canvas>

              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-6">
          <div class="accordion" id="b2-faq" data-aos="fade-left">
            <?php 
            $args = array(
              'post_type'      => 'faq', 
              'posts_per_page' => 5,
            );
            
            $faq_query = new WP_Query( $args );
            
            // Check if there are any FAQs
            if ( $faq_query->have_posts() ) : $i= 0;   while ( $faq_query->have_posts() ) : $faq_query->the_post(); $i++;  ?>
            <div class="accordion-item">
              <h2 class="accordion-header">
                <button class="accordion-button <?php echo ($i === 1)? '' : 'collapsed'; ?>" type="button" data-bs-toggle="collapse" data-bs-target="#faq-<?php echo $i; ?>" aria-expanded="<?php echo (!$i === 1)? 'true' : 'false'; ?>" aria-controls="faq-<?php echo $i; ?>">
                  <?php the_title();?>
                </button>
              </h2>
              <div id="faq-<?php echo $i; ?>" class="accordion-collapse collapse <?php echo ($i === 1)? 'show': ''; ?>" data-bs-parent="#b2-faq">
                <div class="accordion-body">
                  <p class="mb-0"><?php echo esc_html(get_the_content()); ?></p>
                </div>
              </div>
            </div>
            <?php endwhile; endif; ?>
          </div>
        </div>
      </div>
    </div>
  </section> -->





  <?php 
  
  // $faqs = get_field('faq_&_certificates'); 

  ?>
  <section class="faq-home" style="margin-bottom: 150px">
    <div class="container">
      <div class="row">
        <div class="col-lg-6" data-aos="fade-right">
          <div class="faq-left mb-5 mb-lg-0">
            <div class="div-title">
              <h3><?php echo $faqs['certificate_title']; ?></h3>
            </div>
            <div class="certificates-list">
                <ul>

                  <?php 
                  
                  $link = $faqs['certificate_pa_link'];
                  $certificates = get_field('certificates', 'option'); 

                  
                  if($certificates): foreach($certificates as $item) :?>
                  <li>
                    <a href="<?php echo $link['url']; ?>" target="<?php echo $link['target']; ?>">
                      <img src="<?php echo $item['certificate_image']['url']?>" alt="<?php echo $item['certificate_image']['alt']?>">
                      <div>
                        <h5 class="name"><?php echo $item['certificate_title']?></h5>
                        <p><?php echo $item['certificate_details']?></p>
                      </div>
                    </a>
                  </li>
                  <?php endforeach; endif; ?>

                  <!-- <li>
                    <img src="https://i.postimg.cc/xNJ9kc1k/certificate-2.png" alt="">
                    <div>
                      <h5 class="name">SNF</h5>
                      <p>donbosco is in possession of the Stichting Normering Flexwonen (Flexible Living Standards Foundation) certification. </p>
                    </div>
                  </li>
                  <li>
                    <img src="https://i.postimg.cc/HjVYvP9p/certificate-3.png" alt="">
                    <div>
                      <h5 class="name">Fair Produce</h5>
                      <p>Fair Produce is a certification program focusing on fair and ethical labour practices within mushroom production in the Netherlands.</p>
                    </div>
                  </li>
                  <li>
                    <img src="https://i.postimg.cc/1nY95psh/certificate-4.png" alt="">
                    <div>
                      <h5 class="name">KWF Dutch Cancer Society</h5>
                      <p>KWF Dutch Cancer Society is a nation-wide organization for cancer related work in the Netherlands.</p>
                    </div>
                  </li>
                  <li>
                    <img src="https://i.postimg.cc/8s912BZL/certificate-5.png" alt="">
                    <div>
                      <h5 class="name">Samenwerkingsorganisatie Beroepsonderwijs Bedrijfsleven (SBB)</h5>
                      <p>SBB is the Dutch organization that promotes cooperation between vocational education and business.</p>
                    </div>
                  </li> -->
                </ul>
            </div>
            <?php 
            
            if($link){?>
                <a href="<?php echo $link['url']; ?>" class="link-btn" target="<?php echo $link['target']; ?>"><?php echo $link['title']; ?> <svg xmlns="http://www.w3.org/2000/svg" width="7" height="10" viewBox="0 0 7 10" fill="none">
                    <path d="M1 1L5 5L1 9" stroke="#FF551E" stroke-width="2"></path>
                  </svg>
                </a>
            <?php } ?>
            <!-- <div class="address-holder d-flex justify-content-between">
              <div class="left">
                <?php 
                
                $whatsapp = get_field('whatsapp', 'option');
                $email = get_field('email', 'option');
                $location = get_field('location', 'option');
                
                ?>
              <ul>
                <?php if (!empty($location)) : ?>
                    <li>
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none">
                            <path d="M7.5 11.8374C4.58917 12.2382 2.5 13.3141 2.5 14.5832C2.5 16.1941 5.8575 17.4999 10 17.4999C14.1425 17.4999 17.5 16.1941 17.5 14.5832C17.5 13.3141 15.4108 12.2382 12.5 11.8374" stroke="#FF551E" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                            <path d="M10.0002 14.1667V7.5" stroke="#FF551E" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                            <path d="M11.7678 3.23223C12.7441 4.20854 12.7441 5.79146 11.7678 6.76776C10.7915 7.74407 9.20854 7.74407 8.23223 6.76776C7.25592 5.79146 7.25592 4.20854 8.23223 3.23223C9.20854 2.25592 10.7915 2.25592 11.7678 3.23223" stroke="#FF551E" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                        </svg> <?php echo esc_html($location); ?>
                    </li>
                <?php endif; ?>

                <?php if (!empty($whatsapp)) : ?>
                    <li>
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none">
                            <path fill-rule="evenodd" clip-rule="evenodd" d="M15.1698 4.80187C13.7981 3.42938 11.974 2.67271 10.0306 2.67188C6.02479 2.67188 2.76563 5.92937 2.76479 9.93354C2.76313 11.2077 3.09729 12.4602 3.73396 13.5644L2.70312 17.3277L6.55479 16.3177C7.62063 16.8977 8.81396 17.2019 10.0273 17.2019H10.0306C14.0348 17.2019 17.294 13.9435 17.2956 9.93937C17.2965 7.99937 16.5415 6.17521 15.1698 4.80187Z" stroke="#FF551E" stroke-width="1.3" stroke-linecap="round" stroke-linejoin="round"></path>
                            <path d="M10.9121 11.2999L11.2504 10.9641C11.5613 10.6558 12.0529 10.6166 12.4113 10.8683C12.7579 11.1116 13.0713 11.3299 13.3629 11.5333C13.8263 11.8549 13.8821 12.5149 13.4829 12.9133L13.1838 13.2124" stroke="#FF551E" stroke-width="1.3" stroke-linecap="round" stroke-linejoin="round"></path>
                            <path d="M6.78711 6.81583L7.08628 6.51666C7.48461 6.11833 8.14461 6.17416 8.46628 6.63666C8.66878 6.92833 8.88711 7.24166 9.13128 7.58833C9.38294 7.94666 9.34461 8.43833 9.03544 8.74916L8.69961 9.08749" stroke="#FF551E" stroke-width="1.3" stroke-linecap="round" stroke-linejoin="round"></path>
                            <path d="M13.1841 13.2126C11.9499 14.4409 9.87578 13.3976 8.23828 11.7593" stroke="#FF551E" stroke-width="1.3" stroke-linecap="round" stroke-linejoin="round"></path>
                            <path d="M8.24006 11.7618C6.60256 10.1234 5.55922 8.05008 6.78756 6.81592" stroke="#FF551E" stroke-width="1.3" stroke-linecap="round" stroke-linejoin="round"></path>
                            <path d="M8.7002 9.0874C8.96603 9.50657 9.30686 9.92157 9.69186 10.3066L9.69353 10.3082C10.0785 10.6932 10.4935 11.0341 10.9127 11.2999" stroke="#FF551E" stroke-width="1.3" stroke-linecap="round" stroke-linejoin="round"></path>
                        </svg> <a href="https://wa.me/<?php echo extractDigits(esc_attr($whatsapp)); ?>" target="_blank"><?php echo esc_html($whatsapp); ?></a>
                    </li>
                <?php endif; ?>

                <?php if (!empty($email)) : ?>
                    <li>
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none">
                            <path fill-rule="evenodd" clip-rule="evenodd" d="M12.8119 10.5982L16.5669 8.05234C17.151 7.65734 17.5002 6.99817 17.5002 6.29317V6.29317C17.5002 5.11817 16.5485 4.1665 15.3744 4.1665H4.63853C3.46436 4.1665 2.5127 5.11817 2.5127 6.29234V6.29234C2.5127 6.99734 2.86186 7.6565 3.44603 8.05234L7.20103 10.5982C8.8952 11.7465 11.1177 11.7465 12.8119 10.5982V10.5982Z" stroke="#FF551E" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                            <path d="M2.5 6.29248V14.1666C2.5 15.5475 3.61917 16.6666 5 16.6666H15C16.3808 16.6666 17.5 15.5475 17.5 14.1666V6.29331" stroke="#FF551E" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                        </svg> <a href="mailto:<?php echo esc_attr($email); ?>"><?php echo esc_html($email); ?></a>
                    </li>
                <?php endif; ?>
              </ul>

              </div>
              <div class="right">
                <canvas id="quadrados-b2" width="150" height="134"></canvas>

              </div>
            </div> -->

          </div>
        </div>
        <div class="col-lg-6" data-aos="fade-left">
          <div class="div-title">
              <h3><?php echo $faqs['title']; ?></h3>
            </div>
          <div class="accordion" id="b2-faq">



          <?php
            $faq_args = array(
                'post_type'      => 'faq',
                'posts_per_page' => 7,
                'orderby'        => 'rand',
            );

            $faq_query = new WP_Query($faq_args);

            if ($faq_query->have_posts()) : $i = 0;
                while ($faq_query->have_posts()) : $faq_query->the_post();
                    $faq_id        = get_the_ID();
                    $translated_id = icl_object_id($faq_id, 'faq', true, ICL_LANGUAGE_CODE);

                    if ($translated_id) {
                        $faq_id = $translated_id;
                    }
                    ?>
                    <div class="accordion-item">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq-<?php echo esc_attr($faq_id); ?>" aria-expanded="<?php echo ($i != 0) ? 'false' : 'true' ?>" aria-controls="faq-<?php echo esc_attr($faq_id); ?>">
                                <?php the_title(); ?>
                            </button>
                        </h2>
                        <div id="faq-<?php echo esc_attr($faq_id); ?>" class="accordion-collapse collapsed collapse <?php // echo ($i != 0) ? '' : 'show' ?>" data-bs-parent="#b2-faq">
                            <div class="accordion-body">
                                <?php the_content(); ?>
                            </div>
                        </div>
                    </div><?php
                    $i++;
                endwhile;
                wp_reset_postdata();
            else :
                echo '<p>No FAQ items found.</p>';
            endif;
            ?>

            
          </div>
          <?php $link =  $faqs['faq_page_link']; if($link) :?>
              <a href="<?php echo $link['url']?>" class="link-btn" target="<?php echo $link['target']?>"><?php echo $link['title']?> <svg xmlns="http://www.w3.org/2000/svg" width="7" height="10" viewBox="0 0 7 10" fill="none">
                    <path d="M1 1L5 5L1 9" stroke="#FF551E" stroke-width="2"></path>
                  </svg>
              </a>
          <?php endif; ?>
        </div>
      </div>
    </div>
  </section>
<?php get_footer(); ?>

<script>
  const b2Logo = initializeRive("<?php echo get_template_directory_uri();?>/assets/rive/main-logo.riv", "main-logo", "b2Logo");
  const r8 = initializeRive("<?php echo get_template_directory_uri();?>/assets/rive/logo-b2-white.riv", "logo-b2-white", "r8");
  const r9 = initializeRive("<?php echo get_template_directory_uri();?>/assets/rive/line-white.riv", "line-white", "r9");
  const r10 = initializeRive("<?php echo get_template_directory_uri();?>/assets/rive/smile-white.riv", "smile-rive3", "r10");
</script>