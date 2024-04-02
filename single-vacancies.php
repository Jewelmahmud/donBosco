<?php get_header();?>
<script>
  let baseURL = '<?php echo esc_url(get_template_directory_uri()); ?>'
</script>
<section class="vacancies-single-holder">
    <div class="container">
      <div class="top">
        <div class="row">
          <div class="col-lg-6 left">
            
              <div><?php echo date_i18n('j F Y', strtotime(get_the_date())); ?></div>
              <!-- <div><?php echo __('Referrence number', 'b2works'); ?>: <?php echo get_field('reference_no'); ?></div> -->
            
          </div>
          
          <div class="col-lg-6 right">
              <?php
              $current_language = apply_filters('wpml_current_language', NULL);

              $previous_vacancy = get_previous_post(false, '', 'job_category');
              $next_vacancy = get_next_post(false, '', 'job_category');
              $post_language = wpml_get_language_information(get_the_ID())['language_code'];

              $args = array( 'post_type'      => 'vacancies', 'posts_per_page' => -1,  'status'         => 'publish', );                  
              $query = new WP_Query($args);
              $total_vacancies = $query->found_posts;
              wp_reset_postdata();

              // Get the adjacent post in the same language
              $prev_post = get_adjacent_post(false, '', true, 'job_category', $post_language);

              if (!empty($next_vacancy)) { ?>
                  <a href="<?php echo (!empty($next_vacancy) && is_object($next_vacancy)) ? get_permalink($next_vacancy->ID) : "#" ?>"
                    title="<?php echo (!empty($next_vacancy) && is_object($next_vacancy)) ? $next_vacancy->post_title : "#"; ?>">
                      <svg xmlns="http://www.w3.org/2000/svg" width="7" height="10" viewBox="0 0 7 10" fill="none">
                          <path d="M6 1L2 5L6 9" stroke="currentColor" stroke-width="2"/>
                      </svg> <?php echo __('previous', 'b2works'); ?>
                  </a>
              <?php } ?>

              <div>
                  <?php
                  $current_post_id = get_the_ID();

                  if ($current_post_id && $total_vacancies) {
                      $current_vacancy_number = array_search($current_post_id, get_posts(['post_type' => 'vacancies', 'lang' => $post_language, 'fields' => 'ids', 'posts_per_page' => -1]));

                      if ($current_vacancy_number !== false) {
                          $current_vacancy_number++;
                          echo __('vacancy', 'b2works') . ' (' . $current_vacancy_number . ' ' . __('of', 'b2works') . ' ' . $total_vacancies . ')';
                      }
                  }
                  ?>
              </div>

              <a href="<?php echo (!empty($previous_vacancy) && is_object($previous_vacancy)) ? get_permalink($previous_vacancy->ID) : '#' ?>"
                title="<?php echo (!empty($previous_vacancy) && is_object($previous_vacancy)) ? $previous_vacancy->post_title : '' ?>">
                  <?php echo __('next', 'b2works'); ?> <svg xmlns="http://www.w3.org/2000/svg" width="7" height="10"
                                                              viewBox="0 0 7 10" fill="none">
                      <path d="M1 1L5 5L1 9" stroke="currentColor" stroke-width="2"/>
                  </svg>
              </a>

              <?php // var_dump(get_posts(get_the_ID())) ?>
          </div>






        </div>
        
      </div>
      <div class="bottom">
        <div class="row">
          <div class="col-lg-4" data-aos="fade-right">
            <div class="job-details-box">
              <h5><?php echo __('Job details', 'b2works'); ?></h5>
              <ul>
                <!-- <li>
                  <div><svg xmlns="http://www.w3.org/2000/svg" width="19" height="18" viewBox="0 0 19 18" fill="none">
                    <path d="M6.49902 13.1267L7.99965 14.6273L6.49902 16.128" stroke="#FF551E" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M7.99895 14.6274H3.49707" stroke="#FF551E" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M11.0001 15.2082C13.806 14.5698 15.8991 12.2234 16.2142 9.3631C16.5293 6.5028 14.9972 3.75703 12.3976 2.52313C9.79796 1.28922 6.70197 1.83828 4.68519 3.89089C2.66841 5.9435 2.17395 9.04868 3.45344 11.6262" stroke="#FF551E" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M9.33887 6.34619V8.98429L11.4127 10.2493" stroke="#FF551E" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                  </svg> <?php echo __('Hours per week', 'b2works'); ?></div>
                  <div><?php echo (get_field('hours_per_week') ? esc_html(get_field('hours_per_week')) : '-'); ?></div>
                </li> -->
                <li>
                  <div>
                    <svg xmlns="http://www.w3.org/2000/svg" width="19" height="18" viewBox="0 0 19 18" fill="none">
                      <path d="M7.25 10.6538C4.63025 11.0146 2.75 11.9828 2.75 13.1251C2.75 14.5748 5.77175 15.7501 9.5 15.7501C13.2283 15.7501 16.25 14.5748 16.25 13.1251C16.25 11.9828 14.3698 11.0146 11.75 10.6538" stroke="#FF551E" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                      <path d="M9.5 12.75V6.75" stroke="#FF551E" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                      <path d="M11.091 2.90901C11.9697 3.78769 11.9697 5.21231 11.091 6.09099C10.2123 6.96967 8.78769 6.96967 7.90901 6.09099C7.03033 5.21231 7.03033 3.78769 7.90901 2.90901C8.78769 2.03033 10.2123 2.03033 11.091 2.90901" stroke="#FF551E" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg> <?php echo __('Location', 'b2works'); ?>
                  </div>
                  <div><?php echo (get_field('location') ? esc_html(get_field('location')) : '-'); ?></div>
                </li>
                <li>
                  <div>
                    <svg xmlns="http://www.w3.org/2000/svg" width="19" height="19" viewBox="0 0 19 19" fill="none">
                      <path fill-rule="evenodd" clip-rule="evenodd" d="M14.75 15.875H4.25C3.42125 15.875 2.75 15.2038 2.75 14.375V7.625C2.75 6.79625 3.42125 6.125 4.25 6.125H14.75C15.5788 6.125 16.25 6.79625 16.25 7.625V14.375C16.25 15.2038 15.5788 15.875 14.75 15.875Z" stroke="#FE6330" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                      <path d="M12.6301 6.125V4.625C12.6301 3.79625 11.9589 3.125 11.1301 3.125H7.86914C7.04039 3.125 6.36914 3.79625 6.36914 4.625V6.125" stroke="#FE6330" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg> <?php echo __('Job type', 'b2works'); ?>
                  </div>
                  <div><?php echo (get_field('job_type') ? esc_html(get_field('job_type')) : '-'); ?></div>
                </li>

                <li>
                  <div>
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none">
                      <path d="M15.2881 4.59614C18.0706 7.37863 18.0706 11.8899 15.2881 14.6724C12.5056 17.4549 7.99434 17.4549 5.21187 14.6724C2.42938 11.8899 2.42938 7.37861 5.21187 4.59614C7.99435 1.81366 12.5056 1.81366 15.2881 4.59614" stroke="#FE6330" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                      <path d="M13.0495 12.4335C11.5033 13.9796 8.99771 13.9796 7.45159 12.4335C5.90546 10.8874 5.90546 8.38174 7.45159 6.83562C8.99771 5.28949 11.5033 5.28949 13.0495 6.83562" stroke="#FE6330" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                      <path d="M10.25 8.54183H5.5" stroke="#FE6330" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                      <path d="M10.25 10.7269H5.5" stroke="#FE6330" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg> <?php echo __('Hourly rate', 'b2works'); ?>
                  </div>
                  <div>&euro; <?php echo (get_field('hourly_rate') ? esc_html(get_field('hourly_rate')) : '-'); ?></div>
                </li>
                <li>
                  <div>
                    <svg xmlns="http://www.w3.org/2000/svg" width="19" height="19" viewBox="0 0 19 19" fill="none">
                      <path d="M3.5 6.58423V15.8842H15.5V6.58423" stroke="#FF551E" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                      <path d="M2 7.63428L9.5 2.38428L17 7.63428" stroke="#FF551E" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                      <path d="M11.75 15.8843V11.3843C11.75 10.5555 11.0788 9.88428 10.25 9.88428H8.75C7.92125 9.88428 7.25 10.5555 7.25 11.3843V15.8843" stroke="#FF551E" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg> <?php echo __('Accomodation', 'b2works'); ?>
                  </div>
                  <div><?php echo (get_field('accommodation') ? esc_html(get_field('accommodation')) : '-'); ?></div>
                </li>
                <?php
                
                $terms = get_the_terms(get_the_ID(), 'job_category');                
                if ($terms && !is_wp_error($terms)) {
                
                  $term_names = array();
                  foreach ($terms as $term) {
                      $term_names[] = $term->name;
                  }
                }

                ?>
                <li>
                  <div>
                  <svg width="20" height="21" viewBox="0 0 22 23" fill="none" xmlns="http://www.w3.org/2000/svg">
                  <path d="M3.66943 8.57679L3.94093 4.3996C3.94093 4.13011 4.21242 3.99536 4.48391 3.99536H6.65584C6.92734 3.99536 7.19883 4.13011 7.19883 4.3996L7.33457 8.57679" stroke="#F56537" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                  <path d="M18.4829 7.22289C18.4394 7.25404 18.4002 7.29093 18.3571 7.32253L16.0127 9.04141C15.9696 9.07302 15.9306 9.11055 15.8859 9.1398C15.5982 9.32786 15.1233 9.05935 15.1233 8.67032V7.5541C15.1233 7.16507 14.6484 6.89656 14.3606 7.08462C14.3159 7.11387 14.2769 7.1514 14.2338 7.18301L11.8894 8.90188C11.8463 8.93349 11.8073 8.97103 11.7626 9.00027C11.4749 9.18833 11 8.91982 11 8.53079V7.27505C11 6.85647 10.5877 6.57741 10.1753 6.85647L7.67703 8.50498C7.51359 8.61283 7.32209 8.67032 7.12628 8.67032H3.44063C3.0283 8.67032 2.75342 8.94937 2.75342 9.36795V17.0419C2.75342 17.4605 3.0283 17.7396 3.44063 17.7396H18.6968C18.9717 17.7396 19.2465 17.4605 19.2465 17.1815V7.5541C19.2465 7.16461 18.7705 7.01673 18.4829 7.22289Z" stroke="#F56537" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                  <path d="M11.9165 12.7003H12.8328" stroke="#F56537" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                  <path d="M15.5811 12.7003H16.4973" stroke="#F56537" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                  <path d="M11.9165 14.5328H12.8328" stroke="#F56537" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                  <path d="M15.5811 14.5328H16.4973" stroke="#F56537" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                  <path d="M4.58594 13.2422C4.58594 12.6899 5.03365 12.2422 5.58594 12.2422H8.16736C8.71965 12.2422 9.16736 12.6899 9.16736 13.2422V17.7399H4.58594V13.2422Z" stroke="#F56537" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                  </svg>
                  <?php echo __('Industry', 'b2works');?>
                  </div>
                  <div><?php echo implode(', ', $term_names); ?></div>
                </li>
                <li>
                  <div>
                    <svg width="19" height="19" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M16 2V6" stroke="#FF551E" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M8 2V6" stroke="#FF551E" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M3 9H21" stroke="#FF551E" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                    <path fill-rule="evenodd" clip-rule="evenodd" d="M19 4H5C3.895 4 3 4.895 3 6V19C3 20.105 3.895 21 5 21H19C20.105 21 21 20.105 21 19V6C21 4.895 20.105 4 19 4Z" stroke="#FF551E" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                    <?php echo __('Years of experience', 'b2works'); ?>
                  </div>
                  <div id="refno"><?php echo (get_field('years_of_experience') ? esc_html(get_field('years_of_experience')) : '-'); ?></div>
                </li>
                <li>
                  <div>
                  <svg width="17" height="17" viewBox="0 0 17 17" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M11.9375 7.875C9.6975 7.875 7.875 9.6975 7.875 11.9375C7.875 14.1775 9.6975 16 11.9375 16C14.1775 16 16 14.1775 16 11.9375C16 9.6975 14.1775 7.875 11.9375 7.875ZM11.9375 15.375C10.0425 15.375 8.5 13.8331 8.5 11.9375C8.5 10.0419 10.0425 8.5 11.9375 8.5C13.8325 8.5 15.375 10.0419 15.375 11.9375C15.375 13.8331 13.8325 15.375 11.9375 15.375ZM12.7838 12.3412C12.9056 12.4631 12.9056 12.6612 12.7838 12.7831C12.7225 12.8444 12.6425 12.8744 12.5625 12.8744C12.4825 12.8744 12.4025 12.8437 12.3412 12.7831L11.7162 12.1581C11.6575 12.0994 11.625 12.02 11.625 11.9369V10.6869C11.625 10.5144 11.765 10.3744 11.9375 10.3744C12.11 10.3744 12.25 10.5144 12.25 10.6869V11.8075L12.7838 12.3412ZM13.1875 3.5H11.92C11.7638 2.09563 10.57 1 9.125 1H7.5625C6.1175 1 4.92312 2.09563 4.7675 3.5H3.8125C2.26188 3.5 1 4.76188 1 6.3125V13.1875C1 14.7381 2.26188 16 3.8125 16H7.5625C7.735 16 7.875 15.86 7.875 15.6875C7.875 15.515 7.735 15.375 7.5625 15.375H3.8125C2.60625 15.375 1.625 14.3937 1.625 13.1875V9.125H6.9375C7.11 9.125 7.25 8.985 7.25 8.8125C7.25 8.64 7.11 8.5 6.9375 8.5H1.625V6.3125C1.625 5.10625 2.60625 4.125 3.8125 4.125H13.1875C14.3937 4.125 15.375 5.10625 15.375 6.3125V7.5625C15.375 7.735 15.515 7.875 15.6875 7.875C15.86 7.875 16 7.735 16 7.5625V6.3125C16 4.76188 14.7381 3.5 13.1875 3.5ZM7.5625 1.625H9.125C10.225 1.625 11.1381 2.44125 11.29 3.5H5.3975C5.54938 2.44125 6.4625 1.625 7.5625 1.625Z" fill="#FF551E" stroke="#FF551E" stroke-width="0.7"/>
                  </svg> <?php echo __('Career level', 'b2works'); ?>
                  </div>
                  <div><?php echo (get_field('career_level') ? esc_html(get_field('career_level')) : '-'); ?></div>
                </li>
                <!-- <li>
                  <div>
                  <svg width="19" height="19" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
<path fill-rule="evenodd" clip-rule="evenodd" d="M9.70316 4.09499L3.52916 7.52499C2.23116 8.24599 2.23116 10.112 3.52916 10.833L9.70316 14.263C11.1312 15.056 12.8682 15.056 14.2972 14.263L20.4712 10.833C21.7692 10.112 21.7692 8.24599 20.4712 7.52499L14.2972 4.09499C12.8682 3.30199 11.1322 3.30199 9.70316 4.09499Z" stroke="#FF551E" stroke-width="1.419" stroke-linecap="round" stroke-linejoin="round"/>
<path d="M5.99121 12.2V16.124C5.99121 17.073 6.46621 17.958 7.25521 18.483L8.86221 19.552C10.7632 20.816 13.2372 20.816 15.1372 19.552L16.7442 18.483C17.5342 17.958 18.0082 17.072 18.0082 16.124V12.2" stroke="#FF551E" stroke-width="1.4167" stroke-linecap="round" stroke-linejoin="round"/>
</svg> <?php echo __('Education Level', 'b2works'); ?>
                  </div>
                  <div id="refno"><?php echo (get_field('educational_level') ? esc_html(get_field('educational_level')) : '-'); ?></div>
                </li> -->
              </ul>
            </div>
          </div>
          <div class="col-lg-8" data-aos="fade-left">
            <div class="content-area">
              <?php the_content(); ?>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="extra-info border-top pt-5 mt-4 col-12">
            <ul class="left">
              <?php if(get_field('location')):?>
              <li><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none">
                <path d="M7.5 11.8375C4.58917 12.2384 2.5 13.3142 2.5 14.5834C2.5 16.1942 5.8575 17.5 10 17.5C14.1425 17.5 17.5 16.1942 17.5 14.5834C17.5 13.3142 15.4108 12.2384 12.5 11.8375" stroke="#F56537" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                <path d="M9.99967 14.1667V7.5" stroke="#F56537" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                <path d="M11.7678 3.23223C12.7441 4.20854 12.7441 5.79146 11.7678 6.76776C10.7915 7.74407 9.20854 7.74407 8.23223 6.76776C7.25592 5.79146 7.25592 4.20854 8.23223 3.23223C9.20854 2.25592 10.7915 2.25592 11.7678 3.23223" stroke="#F56537" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
              </svg> <?php the_field('location'); ?></li>
              <?php endif; if(get_field('job_type')):?>
              <li><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none">
                <path d="M6.66667 3.33337V14.1667" stroke="#F56537" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                <path d="M15.8327 14.1666V17.5" stroke="#F56537" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                <path d="M14.1663 3.33337H15.833C16.293 3.33337 16.6663 3.70671 16.6663 4.16671V13.3334C16.6663 13.7934 16.293 14.1667 15.833 14.1667H4.99967C4.07884 14.1667 3.33301 14.9125 3.33301 15.8334V15.8334C3.33301 16.7542 4.07884 17.5 4.99967 17.5H16.6663" stroke="#F56537" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                <path d="M3.33301 15.8334V5.00004C3.33301 4.07921 4.07884 3.33337 4.99967 3.33337H10.833" stroke="#F56537" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                <path fill-rule="evenodd" clip-rule="evenodd" d="M13.333 2.5H11.6663C11.2063 2.5 10.833 2.87333 10.833 3.33333V7.5L12.4997 6.66667L14.1663 7.5V3.33333C14.1663 2.87333 13.793 2.5 13.333 2.5Z" stroke="#F56537" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
              </svg> <?php the_field('job_type'); ?></li>
              <?php endif; if(get_field('hours_per_week')):?>
              <li><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none">
                <path fill-rule="evenodd" clip-rule="evenodd" d="M15.8333 17.0833H4.16667C3.24583 17.0833 2.5 16.3375 2.5 15.4167V7.91667C2.5 6.99583 3.24583 6.25 4.16667 6.25H15.8333C16.7542 6.25 17.5 6.99583 17.5 7.91667V15.4167C17.5 16.3375 16.7542 17.0833 15.8333 17.0833Z" stroke="#F56537" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                <path d="M13.4782 6.24996V4.58329C13.4782 3.66246 12.7323 2.91663 11.8115 2.91663H8.18815C7.26732 2.91663 6.52148 3.66246 6.52148 4.58329V6.24996" stroke="#F56537" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
              </svg> <?php the_field('hours_per_week'); ?></li>
              <?php endif; if(get_field('educational_level')):?>
              <li><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none">
                <path fill-rule="evenodd" clip-rule="evenodd" d="M8.08613 3.4125L2.94113 6.27083C1.85947 6.87166 1.85947 8.42666 2.94113 9.02749L8.08613 11.8858C9.27613 12.5467 10.7236 12.5467 11.9145 11.8858L17.0595 9.02749C18.1411 8.42666 18.1411 6.87166 17.0595 6.27083L11.9145 3.4125C10.7236 2.75166 9.27697 2.75166 8.08613 3.4125Z" stroke="#F56537" stroke-width="1.419" stroke-linecap="round" stroke-linejoin="round"/>
                <path d="M4.99316 10.1666V13.4366C4.99316 14.2275 5.389 14.965 6.0465 15.4025L7.38566 16.2933C8.96983 17.3466 11.0315 17.3466 12.6148 16.2933L13.954 15.4025C14.6123 14.965 15.0073 14.2266 15.0073 13.4366V10.1666" stroke="#F56537" stroke-width="1.4167" stroke-linecap="round" stroke-linejoin="round"/>
              </svg> <?php the_field('educational_level'); ?></li>
              <?php endif;?>
            </ul>
            <ul class="right">
              <li>
                  <a href="#" class="btn btn-outline-secondary" data-bs-toggle="modal" data-bs-target=".share-popup">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                      <path fill-rule="evenodd" clip-rule="evenodd" d="M11.0817 8.94979C6.19364 9.50144 2.49865 13.6347 2.49609 18.5538V19.166C4.62047 16.6069 7.75615 15.1026 11.0817 15.0473V18.2757C11.0818 18.7441 11.3495 19.1713 11.7711 19.3755C12.1926 19.5798 12.6938 19.5252 13.0615 19.2351L21.0548 12.9234C21.3386 12.6998 21.5042 12.3584 21.5042 11.9971C21.5042 11.6357 21.3386 11.2943 21.0548 11.0707L13.0615 4.75905C12.6938 4.46887 12.1926 4.41432 11.7711 4.61859C11.3495 4.82286 11.0818 5.25003 11.0817 5.71845V8.94979Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                  </a>
              </li>
              <?php $is_favorite = is_job_favorite(get_the_ID());?>
              <li><button class="btn btn-secondary btn-fav btn-fav-single <?php echo $is_favorite ? 'active' : ''; ?>" data-id="<?php echo get_the_ID() ?>"><svg xmlns="http://www.w3.org/2000/svg" width="21" height="21" viewBox="0 0 21 21" fill="none">
                <path fill-rule="evenodd" clip-rule="evenodd" d="M10.5 4.30937C11.1781 3.51575 12.3515 2.625 14.1382 2.625C17.2629 2.625 19.3594 5.558 19.3594 8.28975C19.3594 14 12.25 18.375 10.5 18.375C8.75 18.375 1.64062 14 1.64062 8.28975C1.64062 5.558 3.73712 2.625 6.86175 2.625C8.6485 2.625 9.82188 3.51575 10.5 4.30937Z" stroke="#fff" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
              </svg></button></li>
              <li><button type="button" class="btn btn-secondary takeJobModal" data-bs-toggle="modal" data-bs-target="#takeJobModal"><?php echo __('Apply now', 'b2works'); ?></button></li>
            </ul>
          </div>
        </div>
      </div>
    </div>
    <div class="vacancy-detail-toolbar">
      <div class="vacancy-detail-toolbar__content">
        <a href="#" class="btn btn-secondary takeJobModal" data-bs-toggle="modal" data-bs-target="#takeJobModal"><?php echo __('Apply now', 'b2works'); ?></a>
        <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" viewBox="0 0 21 21" fill="none">
          <path fill-rule="evenodd" clip-rule="evenodd" d="M10.5 4.30937C11.1781 3.51575 12.3515 2.625 14.1382 2.625C17.2629 2.625 19.3594 5.558 19.3594 8.28975C19.3594 14 12.25 18.375 10.5 18.375C8.75 18.375 1.64062 14 1.64062 8.28975C1.64062 5.558 3.73712 2.625 6.86175 2.625C8.6485 2.625 9.82188 3.51575 10.5 4.30937Z" stroke="#666" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
        </svg>


      </div>
    </div>
  </section>
<?php get_footer();?>

<!-- Share Popup Modal -->

<div class="share-popup modal fade" tabindex="-1" aria-labelledby="#sharePopupModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
      <div class="modal-header">
          <div class="d-flex gap-4 align-items-center">
          <h1 class="modal-title fs-5 fw-medium" id="#takeJobModalLabel">Share now</h1>
          <svg width="46" height="34" viewBox="0 0 46 34" fill="none" xmlns="http://www.w3.org/2000/svg">
<path d="M2 17.8002L2.20725 18.0874C12.1089 31.8098 31.3005 34.8251 44.9332 24.8001V24.8001" stroke="white" stroke-width="3"/>
<path d="M19.7326 1L16.9326 15.9333" stroke="white" stroke-width="3"/>
<path d="M33.7327 3.33337L31.3994 16.8667" stroke="white" stroke-width="3"/>
</svg>
          </div>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <ul class="modal-body">
          <?php  

              $email = get_field('email', 'option');

              $share = array(
                'subject' => __('A wonderful job for you', 'b2works'),
                'title' => __('Hey I have found an interesting job, you might be interested in. Here\'s the link for you ', 'b2works'),
              );
              
              $facebook_share_link = 'https://www.facebook.com/sharer/sharer.php?u=' . rawurlencode(get_the_permalink());
              $instagram_share_link = 'https://www.instagram.com/share?url=' . rawurlencode(get_the_permalink());
              $linkedin_share_link = 'https://www.linkedin.com/sharing/share-offsite/?url=' . rawurlencode(get_the_permalink());
              $mailto_link = 'mailto:' . $email . '?subject=' . rawurlencode($share['subject']) . '&body=' . rawurlencode($share['subject']." " . get_the_permalink());

              
          ?>
          <li>
            <a href="https://wa.me/?text=<?php echo rawurlencode(get_the_permalink()); ?>" target="_blank">
            <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 15 15" fill="none">
              <path fill-rule="evenodd" clip-rule="evenodd" d="M11.8945 2.8105C10.7286 1.64388 9.17806 1.00071 7.52623 1C4.12127 1 1.35098 3.76887 1.35027 7.17242C1.34885 8.25546 1.63289 9.32008 2.17406 10.2586L1.29785 13.4575L4.57177 12.599C5.47773 13.092 6.49206 13.3505 7.52339 13.3505H7.52623C10.9298 13.3505 13.7001 10.5809 13.7015 7.17737C13.7022 5.52837 13.0604 3.97783 11.8945 2.8105Z" stroke="#FF551E" stroke-width="1.3" stroke-linecap="round" stroke-linejoin="round"></path>
              <path d="M8.27539 8.33406L8.56297 8.0486C8.82718 7.78652 9.2451 7.75323 9.54968 7.96714C9.84435 8.17398 10.1107 8.35956 10.3586 8.53239C10.7524 8.80581 10.7999 9.36681 10.4606 9.70539L10.2063 9.95968" stroke="#FF551E" stroke-width="1.3" stroke-linecap="round" stroke-linejoin="round"></path>
              <path d="M4.76904 4.52253L5.02333 4.26824C5.36192 3.92966 5.92292 3.97711 6.19633 4.37024C6.36846 4.61816 6.55404 4.88449 6.76158 5.17916C6.9755 5.48374 6.94292 5.90166 6.68013 6.16586L6.39467 6.45345" stroke="#FF551E" stroke-width="1.3" stroke-linecap="round" stroke-linejoin="round"></path>
              <path d="M10.2064 9.9597C9.15736 11.0038 7.39432 10.1169 6.00244 8.72437" stroke="#FF551E" stroke-width="1.3" stroke-linecap="round" stroke-linejoin="round"></path>
              <path d="M6.00405 8.72654C4.61217 7.33396 3.72534 5.57162 4.76942 4.52258" stroke="#FF551E" stroke-width="1.3" stroke-linecap="round" stroke-linejoin="round"></path>
              <path d="M6.39502 6.45349C6.62098 6.80978 6.91069 7.16253 7.23794 7.48978L7.23935 7.4912C7.5666 7.81845 7.91935 8.10816 8.27564 8.33412" stroke="#FF551E" stroke-width="1.3" stroke-linecap="round" stroke-linejoin="round"></path>
            </svg> WhatsApp
          </a>
          </li>
          <li>
            <a href="<?php echo $facebook_share_link; ?>" target="_blank">   
            <svg width="9" height="16" viewBox="0 0 9 16" fill="none" xmlns="http://www.w3.org/2000/svg">
<path d="M6.73927 2.62921H8.22808V0.110893C7.50723 0.0359351 6.78295 -0.00107249 6.05821 2.36501e-05C3.90418 2.36501e-05 2.4312 1.31462 2.4312 3.72206V5.7969H0V8.61615H2.4312V15.8385H5.34548V8.61615H7.76877L8.13305 5.7969H5.34548V3.99924C5.34548 3.16772 5.56722 2.62921 6.73927 2.62921Z" fill="#FF551E"/>
</svg>Facebook
            </a>
          </li>
          <li>
            <a href="<?php echo $instagram_share_link; ?>" target="_blank"> 
            <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
<path d="M12.1481 2.74005C11.9601 2.74005 11.7764 2.79579 11.6201 2.90021C11.4639 3.00463 11.3421 3.15305 11.2701 3.3267C11.1982 3.50034 11.1794 3.69142 11.2161 3.87576C11.2527 4.0601 11.3432 4.22943 11.4761 4.36233C11.609 4.49523 11.7784 4.58574 11.9627 4.62241C12.147 4.65908 12.3381 4.64026 12.5118 4.56833C12.6854 4.49641 12.8338 4.3746 12.9383 4.21833C13.0427 4.06205 13.0984 3.87832 13.0984 3.69036C13.0984 3.43833 12.9983 3.19661 12.8201 3.01839C12.6419 2.84018 12.4001 2.74005 12.1481 2.74005ZM15.791 4.65651C15.7755 3.99945 15.6525 3.34936 15.4267 2.73214C15.2253 2.20403 14.9119 1.72582 14.508 1.33043C14.1159 0.924512 13.6366 0.613088 13.1063 0.419719C12.4907 0.187021 11.8399 0.0611444 11.182 0.0475154C10.3425 -4.42522e-08 10.0733 0 7.91923 0C5.7652 0 5.49595 -4.42522e-08 4.65651 0.0475154C3.99854 0.0611444 3.34773 0.187021 2.73214 0.419719C2.20287 0.615046 1.72396 0.926202 1.33043 1.33043C0.924512 1.72257 0.613088 2.20189 0.419719 2.73214C0.187021 3.34773 0.0611444 3.99854 0.0475154 4.65651C-4.42522e-08 5.49595 0 5.7652 0 7.91923C0 10.0733 -4.42522e-08 10.3425 0.0475154 11.182C0.0611444 11.8399 0.187021 12.4907 0.419719 13.1063C0.613088 13.6366 0.924512 14.1159 1.33043 14.508C1.72396 14.9123 2.20287 15.2234 2.73214 15.4187C3.34773 15.6514 3.99854 15.7773 4.65651 15.791C5.49595 15.8385 5.7652 15.8385 7.91923 15.8385C10.0733 15.8385 10.3425 15.8385 11.182 15.791C11.8399 15.7773 12.4907 15.6514 13.1063 15.4187C13.6366 15.2254 14.1159 14.914 14.508 14.508C14.9137 14.1141 15.2274 13.6355 15.4267 13.1063C15.6525 12.4891 15.7755 11.839 15.791 11.182C15.791 10.3425 15.8385 10.0733 15.8385 7.91923C15.8385 5.7652 15.8385 5.49595 15.791 4.65651ZM14.3655 11.0869C14.3597 11.5896 14.2687 12.0877 14.0962 12.5599C13.9698 12.9045 13.7667 13.216 13.5023 13.4706C13.2454 13.7324 12.9347 13.935 12.5916 14.0646C12.1194 14.237 11.6213 14.328 11.1186 14.3338C10.3267 14.3734 10.0337 14.3813 7.95091 14.3813C5.86815 14.3813 5.57514 14.3813 4.78322 14.3338C4.26125 14.3436 3.74152 14.2632 3.24689 14.0962C2.91886 13.9601 2.62234 13.7579 2.37577 13.5023C2.11292 13.2479 1.91237 12.9362 1.78975 12.5916C1.5964 12.1126 1.48917 11.6032 1.47298 11.0869C1.47298 10.295 1.42546 10.002 1.42546 7.91923C1.42546 5.83647 1.42546 5.54346 1.47298 4.75154C1.47653 4.23763 1.57034 3.72833 1.75015 3.24689C1.88957 2.91262 2.10356 2.61466 2.37577 2.37577C2.61637 2.10348 2.91371 1.88723 3.24689 1.74223C3.7296 1.56804 4.23837 1.477 4.75154 1.47298C5.54346 1.47298 5.83647 1.42546 7.91923 1.42546C10.002 1.42546 10.295 1.42546 11.0869 1.47298C11.5896 1.47874 12.0877 1.56979 12.5599 1.74223C12.9198 1.87579 13.2428 2.09293 13.5023 2.37577C13.7618 2.61903 13.9646 2.91644 14.0962 3.24689C14.2722 3.72911 14.3633 4.2382 14.3655 4.75154C14.4051 5.54346 14.413 5.83647 14.413 7.91923C14.413 10.002 14.4051 10.295 14.3655 11.0869ZM7.91923 3.85667C7.11607 3.85823 6.3314 4.09783 5.66435 4.54518C4.99731 4.99253 4.47783 5.62756 4.17156 6.37004C3.86529 7.11251 3.78597 7.92911 3.94361 8.71664C4.10126 9.50418 4.48881 10.2273 5.05728 10.7947C5.62576 11.3621 6.34965 11.7482 7.13749 11.9043C7.92534 12.0604 8.74178 11.9795 9.48365 11.6718C10.2255 11.3641 10.8595 10.8434 11.3056 10.1754C11.7516 9.50754 11.9897 8.72239 11.9897 7.91923C11.9908 7.38477 11.8861 6.85537 11.6819 6.36149C11.4776 5.8676 11.1776 5.41898 10.7994 5.04142C10.4211 4.66387 9.97186 4.36483 9.47758 4.1615C8.9833 3.95818 8.4537 3.85458 7.91923 3.85667ZM7.91923 10.5563C7.39766 10.5563 6.88781 10.4017 6.45414 10.1119C6.02047 9.82214 5.68246 9.41028 5.48287 8.92841C5.28327 8.44654 5.23105 7.91631 5.3328 7.40476C5.43455 6.89321 5.68571 6.42332 6.05452 6.05452C6.42332 5.68571 6.89321 5.43455 7.40476 5.3328C7.91631 5.23105 8.44654 5.28327 8.92841 5.48287C9.41028 5.68246 9.82214 6.02047 10.1119 6.45414C10.4017 6.88781 10.5563 7.39766 10.5563 7.91923C10.5563 8.26554 10.4881 8.60846 10.3556 8.92841C10.2231 9.24836 10.0288 9.53907 9.78395 9.78395C9.53907 10.0288 9.24836 10.2231 8.92841 10.3556C8.60846 10.4881 8.26554 10.5563 7.91923 10.5563Z" fill="#FF551E"/>
</svg>

Instagram
            </a>
          </li>
          <li>
            <a href="<?php echo $linkedin_share_link; ?>" target="_blank">   
            <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
<g clip-path="url(#clip0_1283_7350)">
<path d="M12.6667 0H3.33333C1.49267 0 0 1.49267 0 3.33333V12.6667C0 14.5073 1.49267 16 3.33333 16H12.6667C14.508 16 16 14.5073 16 12.6667V3.33333C16 1.49267 14.508 0 12.6667 0ZM5.33333 12.6667H3.33333V5.33333H5.33333V12.6667ZM4.33333 4.488C3.68933 4.488 3.16667 3.96133 3.16667 3.312C3.16667 2.66267 3.68933 2.136 4.33333 2.136C4.97733 2.136 5.5 2.66267 5.5 3.312C5.5 3.96133 4.978 4.488 4.33333 4.488ZM13.3333 12.6667H11.3333V8.93067C11.3333 6.68533 8.66667 6.85533 8.66667 8.93067V12.6667H6.66667V5.33333H8.66667V6.51C9.59733 4.786 13.3333 4.65867 13.3333 8.16067V12.6667Z" fill="#FF551E"/>
</g>
<defs>
<clipPath id="clip0_1283_7350">
<rect width="16" height="16" fill="white"/>
</clipPath>
</defs>
</svg>
Linkedin
            </a>
          </li>
          <li>
            <a href="<?php echo $mailto_link; ?>" target="_blank">
            <svg width="18" height="16" viewBox="0 0 18 16" fill="none" xmlns="http://www.w3.org/2000/svg">
<path fill-rule="evenodd" clip-rule="evenodd" d="M11.9985 8.52853L16.0038 5.81298C16.6269 5.39165 16.9994 4.68853 16.9994 3.93654V3.93654C16.9994 2.6832 15.9842 1.66809 14.7318 1.66809H3.28025C2.02781 1.66809 1.0127 2.6832 1.0127 3.93565V3.93565C1.0127 4.68765 1.38514 5.39076 2.00825 5.81298L6.01358 8.52853C7.82069 9.75342 10.1914 9.75342 11.9985 8.52853V8.52853Z" stroke="#FF551E" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
<path d="M1 3.93579V12.3349C1 13.8078 2.19378 15.0016 3.66667 15.0016H14.3333C15.8062 15.0016 17 13.8078 17 12.3349V3.93668" stroke="#FF551E" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
</svg>
 <?php echo __('Email', 'b2works'); ?>
            </a>
          </li>
        </ul>
       </div>
    </div>
</div>

<!-- Take Job Modal -->
<div class="modal fade" id="takeJobModal" tabindex="-1" aria-labelledby="#takeJobModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-fullscreen-lg-down">
      <div class="modal-content">
        <div class="modal-header px-lg-5 pt-lg-5">
          <h1 class="modal-title fs-5" id="#takeJobModalLabel"><?php echo __('Apply now', 'b2works'); ?></h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body p-lg-5">
          <div class="contact-right">

          <form class="row g-3 g-lg-4" id="application-form"  data-url="<?php echo admin_url('admin-ajax.php'); ?>">
            <!-- <div class="col-md-6">
              <label for="gender" class="form-label">Gender</label>
              <select class="form-select" aria-label="Default select example" name="gender" id="gender">
                <option selected>Select your gender</option>
                <option value="Male">Male</option>
                <option value="Female">Female</option>
                <option value="Neutral">Neutral</option>
              </select>
            </div> -->

            <div class="col-md-6">
              <label for="firstname" class="form-label"><?php echo __('First name', 'b2works');?> <span>(<?php echo __('Required', 'b2works');?>)</span></label>
              <input type="text" class="form-control" id="firstname" name="firstname" placeholder="" required>
            </div>

            <div class="col-md-6">
              <label for="lastname" class="form-label"><?php echo __('Last name', 'b2works');?> <span>(<?php echo __('Required', 'b2works');?>)</span></label>
              <input type="text" class="form-control" id="lastname" placeholder="" name="lastname" required>
            </div>
            <div class="col-md-6">
              <label for="lastname" class="form-label"><?php echo __('Date of birth', 'b2works');?> <span>(<?php echo __('Required', 'b2works');?>)</span></label>
              <input type="text" class="form-control datepicker" id="dateOfBirth" placeholder="" name="dateOfBirth" maxlength="10" data-valid="false" required>
            </div>

            <!-- <div class="col-md-6">
              <label for="dob" class="form-label">Date of birth <span>(Required)</span></label>
              <input type="text" class="form-control datepicker" id="dob" name="dob" placeholder="Date of birth" required>
            </div> -->

            <div class="col-md-6">
              <label for="phone" class="form-label"><?php echo __('Phone', 'b2works');?> <span>(<?php echo __('Required', 'b2works');?>)</span></label>
              <input type="text" class="form-control" id="phone" name="phone" placeholder="" required>
            </div>

            <div class="col-md-6">
              <label for="email" class="form-label"><?php echo __('E-mail address', 'b2works');?> <span>(<?php echo __('Required', 'b2works');?>)</span></label>
              <input type="email" class="form-control" id="email" name="email" placeholder="" required>
            </div>

            <!-- Additional Address Fields -->

            <!-- <div class="col-md-6">
              <label for="place" class="form-label">Place <span>(Required)</span></label>
              <input type="text" class="form-control" id="place" name="place" placeholder="Place" required>
            </div> -->

            <!-- Additional Address Fields -->

            <!-- <div class="col-md-6">
              <label for="availFrom" class="form-label">Available from</label>
              <input type="text" class="form-control datepicker" id="availFrom" name="availFrom" placeholder="Available from">
            </div>

            <div class="col-md-6">
              <label for="availTo" class="form-label">Available to</label>
              <input type="text" class="form-control datepicker" id="availTo" name="availTo" placeholder="Available to">
            </div> -->

            <div class="col-md-6">
              <label for="availTo" class="form-label"><?php echo __('Current postion', 'b2works');?></label>
              <input type="text" class="form-control" id="currentPosition" name="currentPosition" placeholder="">
            </div>

            <div class="col-md-6">
              <label for="availTo" class="form-label"><?php echo __('Current employer', 'b2works');?></label>
              <input type="text" class="form-control" id="currentEmployer" name="currentEmployer" placeholder="">
            </div>

            <!-- <div class="col-md-6">
              <label for="availTo" class="form-label"><?php echo __('Skype', 'b2works');?></label>
              <input type="text" class="form-control" id="skype" name="skype" placeholder="">
            </div>
            <div class="col-md-6">
              <label for="availTo" class="form-label"><?php echo __('LinkedIn', 'b2works');?></label>
              <input type="text" class="form-control" id="linkedIn" name="linkedin" placeholder="">
            </div>
            <div class="col-md-6">
              <label for="availTo" class="form-label"><?php echo __('Facebook', 'b2works');?></label>
              <input type="text" class="form-control" id="facebook" name="facebook" placeholder="">
            </div>
            <div class="col-md-6">
              <label for="availTo" class="form-label"><?php echo __('Instagram', 'b2works');?></label>
              <input type="text" class="form-control" id="instagram" name="instagram" placeholder="">
            </div>
            <div class="col-md-6">
              <label for="availTo" class="form-label"><?php echo __('Twitter', 'b2works');?></label>
              <input type="text" class="form-control" id="twitter" name="twitter" placeholder="">
            </div>
            <div class="col-md-6">
              <label for="availTo" class="form-label"><?php echo __('Website', 'b2works');?></label>
              <input type="text" class="form-control" id="website" name="website" placeholder="">
            </div>
            <div class="col-md-6">
              <label for="availTo" class="form-label"><?php echo __('Blog', 'b2works');?></label>
              <input type="text" class="form-control" id="blog" name="blog" placeholder="">
            </div> -->


            <!-- <div class="col-md-6">
              <label class="form-label">Do you speak English</label>
              <select class="form-select" aria-label="Default select example" name="speakEnglish">
                <option selected>Select a language</option>
                <option value="Yes">Yes</option>
                <option value="No">No</option>
              </select>
            </div>
            <div class="col-md-6">
              <label class="form-label">Do you have a driving license?</label>
              <div class="input-group">
                <select class="form-select" aria-label="Default select example" name="drivingLicense">
                  <option selected>Select an option</option>
                  <option value="Yes">Yes</option>
                  <option value="No">No</option>
                </select>
              </div>
            </div>

            <div class="col-md-6">
              <label class="form-label">Have you worked in the Netherlands before?</label>
              <div class="input-group">
                <select class="form-select" aria-label="Default select example" name="workedInNetherlands">
                  <option selected>Select an option</option>
                  <option value="Yes">Yes</option>
                  <option value="No">No</option>
                </select>
              </div>
            </div>

            <div class="col-md-6">
              <label class="form-label">Are you currently staying in the Netherlands?</label>
              <div class="input-group">
                <select class="form-select" aria-label="Default select example" name="stayingInNetherlands">
                  <option selected>Select an option</option>
                  <option value="Yes">Yes</option>
                  <option value="No">No</option>
                </select>
              </div>
            </div>

            <div class="col-md-6">
              <label class="form-label">Do you have your own accommodation, or do you need accommodation from B2Works?</label>
              <div class="input-group">
                <select class="form-select" aria-label="Default select example" name="accommodation">
                  <option selected>Select an option</option>
                  <option value="Own">Own</option>
                  <option value="B2Works">B2Works</option>
                </select>
              </div>
            </div>

            <div class="col-md-6">
              <label class="form-label">Do you have one year or more of proven experience with the activities described in the vacancy?</label>
              <div class="input-group">
                <select class="form-select" aria-label="Default select example" name="provenExperience">
                  <option selected>Select an option</option>
                  <option value="Yes">Yes</option>
                  <option value="No">No</option>
                </select>
              </div>
            </div> -->

            

            <!-- Add more Yes/No fields as needed -->

            <div class="col-12">
              <label for="textArea" class="form-label"><?php echo __('Motivation', 'b2works'); ?></label>
              <textarea class="form-control" id="textArea" rows="5" name="motivation" placeholder=""></textarea>
            </div>

            <div class="col-12">
              <div class='file-input'>
                <input type='file' name="resume" id="resume">
                <span class='label uploadlabel' data-js-label><img src="<?php echo get_template_directory_uri(); ?>/assets/images/icons/i-upload.svg" alt="i-upload"> <?php echo __('Upload CV', 'b2works'); ?></span>
                <span class='btn btn-secondary'><?php echo __('Select', 'b2works'); ?></span>
              </div>
              <span><?php echo __('Select a resume .pdf of .doc file max 5mb', 'b2works'); ?></span>
            </div>

            <!-- <div class="col-6">
              <div class='file-input'>
                <input type='file' name="cover" id="cover">
                <span class='label uploadlabel' data-js-label><img src="<?php echo get_template_directory_uri(); ?>/assets/images/icons/i-upload.svg" alt="i-upload"> Upload Cover</span>
                <span class='btn btn-secondary'>Select</span>
              </div>
              <span><?php echo __('Slect a cover letter pdf or doc file max 5 MB', 'b2works'); ?></span>
            </div> -->

            <!-- <div class="col-6">
              <div class='file-input'>
                <input type='file' name="photo" id="photo">
                <span class='label uploadlabel' data-js-label><img src="<?php echo get_template_directory_uri(); ?>/assets/images/icons/i-upload.svg" alt="i-upload"> Upload Photo</span>
                <span class='btn btn-secondary'>Select</span>
              </div>
              <span><?php echo __('Select a photo jpg, jpeg or png file max 1 MB', 'b2works'); ?></span>
            </div> -->

            <div class="col-lg-9">
              <div class="form-check">
                <input class="form-check-input" type="checkbox" id="gridCheck" name="gridCheck" required>
                <label class="ms-3 form-check-label" for="gridCheck">
                <?php echo __('By sending this contact form you give us permission to process your (personal) data. We handle your personal data carefully.', 'b2works'); ?>
                </label>
              </div>
            </div>

            <input type="hidden" id="jobid" name="jobid" value="<?php echo get_field('reference_no'); ?>">
            <input type="hidden" id="honeypot" name="<?php echo __('Apply now', 'b2works'); ?>" value="">

            <div class="col-12 mt-5">
              <button type="submit" class="btn btn-secondary submit-btn"><?php echo __('Send', 'b2works'); ?></button>
              <div class="loader btn-secondary send-loader"></div>
            </div>
          </form>

          <!-- Add the following scripts to initialize datepickers -->
          <script>
            // $(document).ready(function () {
            //   $('.datepicker').datepicker({
            //     dateFormat: 'dd-mm-yy',
            //     changeMonth: true,
            //     changeYear: true,
            //     yearRange: '1900:' + new Date().getFullYear(),
            //     // Additional options if needed
            //   });
            // });
          </script>

          </div>
        </div>
        
      </div>
    </div>
  </div>

  <script>
    const b2Logo = initializeRive("<?php echo get_template_directory_uri();?>/assets/rive/main-logo.riv", "main-logo", "b2Logo");
    const r8 = initializeRive("<?php echo get_template_directory_uri();?>/assets/rive/logo-b2-white.riv", "logo-b2-white", "r8");
    const r9 = initializeRive("<?php echo get_template_directory_uri();?>/assets/rive/line-white.riv", "line-white", "r9");
    const r10 = initializeRive("<?php echo get_template_directory_uri();?>/assets/rive/smile-white.riv", "smile-rive3", "r10");
    const r11 = initializeRive("<?php echo get_template_directory_uri();?>/assets/rive/vacancies.riv", "vacancies-rive", "r11");
    const r12 = initializeRive("<?php echo get_template_directory_uri();?>/assets/rive/smile-rive.riv", "smile-rive4", "r12");

    {
      "@context": "https://schema.org",
      "@type": "JobPosting",
      "title": "<?php the_title(); ?>",
      "description": "<?php the_content();  ?>",
      "identifier": {
        "@type": "PropertyValue",
        "name": "Company",
        "value": "<?php echo get_field('company_name'); ?>"
      },
      "datePosted": "<?php echo get_the_date('F j, Y'); ?>",
      "employmentType": "<?php echo (get_field('job_type') ? esc_html(get_field('job_type')) : '-'); ?>",
      "jobLocation": {
        "@type": "Place",
        "address": {
          "@type": "PostalAddress",
          "addressLocality": "<?php echo (get_field('location') ? esc_html(get_field('location')) : '-'); ?>"
        }
      },
      "baseSalary": {
        "@type": "MonetaryAmount",
        "currency": "EUR",
        "value": {
          "@type": "QuantitativeValue",
          "value": <?php echo (get_field('hourly_rate') ? esc_html(get_field('hourly_rate')) : '-'); ?>,
          "unitText": "HOUR"
        }
      },
      "experienceRequirements": "<?php echo get_field('years_of_experience'); ?>",
      "educationRequirements": "<?php echo get_field('educational_level'); ?>",
      "benefits": "Accommodation provided"

    }

</script>