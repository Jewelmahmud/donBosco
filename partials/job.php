<?php 

    get_header(); 
    $job = getSingleJob($_GET['id']);

    // dd($job);
    
?>
<script>
  let baseURL = '<?php echo esc_url(get_template_directory_uri()); ?>'
</script>
<section class="vacancies-single-holder">
    <div class="container">
      <div class="top">
        <div class="row">
          <div class="col-lg-6 left">
            
              <div><?php echo date_i18n('j F Y', strtotime(get_the_date())); ?></div>
              <div>Referrence number: <?php echo get_field('reference_no'); ?></div>
            
          </div>
          
          <div class="col-lg-6 right">
              <?php
                $previous_vacancy = get_previous_post(false, '', 'vacancies');
                $next_vacancy = get_next_post(false, '', 'vacancies');

                $prev_post = get_adjacent_post(false, '', true);
                
                if(!empty($prev_post)) {  ?>

                <a href="<?php echo get_permalink($prev_post->ID)?> " title="<?php echo $prev_post->post_title; ?>">
                    <svg xmlns="http://www.w3.org/2000/svg" width="7" height="10" viewBox="0 0 7 10" fill="none">
                        <path d="M6 1L2 5L6 9" stroke="currentColor" stroke-width="2"/>
                    </svg> previous
                </a>
              <?php } ?>

              <div>
                  <?php
                  $current_post_id = get_the_ID();
                  $total_vacancies = wp_count_posts('vacancies')->publish;

                  if ($current_post_id && $total_vacancies) {
                      $current_vacancy_number = array_search($current_post_id, get_posts(['post_type' => 'vacancies', 'fields' => 'ids']));

                      if ($current_vacancy_number !== false) {
                          $current_vacancy_number++;
                          echo 'vacancy (' . $current_vacancy_number . ' of ' . $total_vacancies . ')';
                      }
                  }
                  ?>
              </div>

              <a href="<?php echo $next_vacancy ? get_permalink($next_vacancy) : '#'; ?>">
                  next <svg xmlns="http://www.w3.org/2000/svg" width="7" height="10" viewBox="0 0 7 10" fill="none">
                      <path d="M1 1L5 5L1 9" stroke="currentColor" stroke-width="2"/>
                  </svg>
              </a>
          </div>


        </div>
        
      </div>
      <div class="bottom">
        <div class="row">
          <div class="col-lg-4" data-aos="fade-right">
            <div class="job-details-box">
              <h5>Job details</h5>
              <ul>
                <?php if(get_field('hours_per_week')):?>
                <li>
                  <div><svg xmlns="http://www.w3.org/2000/svg" width="19" height="18" viewBox="0 0 19 18" fill="none">
                    <path d="M6.49902 13.1267L7.99965 14.6273L6.49902 16.128" stroke="#FF551E" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M7.99895 14.6274H3.49707" stroke="#FF551E" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M11.0001 15.2082C13.806 14.5698 15.8991 12.2234 16.2142 9.3631C16.5293 6.5028 14.9972 3.75703 12.3976 2.52313C9.79796 1.28922 6.70197 1.83828 4.68519 3.89089C2.66841 5.9435 2.17395 9.04868 3.45344 11.6262" stroke="#FF551E" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M9.33887 6.34619V8.98429L11.4127 10.2493" stroke="#FF551E" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                  </svg> Hours per week</div>
                  <div><?php echo get_field('hours_per_week') ?></div>
                </li>
                <?php endif; if(get_field('location')):?>
                <li>
                  <div>
                    <svg xmlns="http://www.w3.org/2000/svg" width="19" height="18" viewBox="0 0 19 18" fill="none">
                      <path d="M7.25 10.6538C4.63025 11.0146 2.75 11.9828 2.75 13.1251C2.75 14.5748 5.77175 15.7501 9.5 15.7501C13.2283 15.7501 16.25 14.5748 16.25 13.1251C16.25 11.9828 14.3698 11.0146 11.75 10.6538" stroke="#FF551E" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                      <path d="M9.5 12.75V6.75" stroke="#FF551E" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                      <path d="M11.091 2.90901C11.9697 3.78769 11.9697 5.21231 11.091 6.09099C10.2123 6.96967 8.78769 6.96967 7.90901 6.09099C7.03033 5.21231 7.03033 3.78769 7.90901 2.90901C8.78769 2.03033 10.2123 2.03033 11.091 2.90901" stroke="#FF551E" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg> Location
                  </div>
                  <div><?php echo get_field('location'); ?></div>
                </li>
                <?php endif; if(get_field('job_type')):?>
                <li>
                  <div>
                    <svg xmlns="http://www.w3.org/2000/svg" width="19" height="19" viewBox="0 0 19 19" fill="none">
                      <path fill-rule="evenodd" clip-rule="evenodd" d="M14.75 15.875H4.25C3.42125 15.875 2.75 15.2038 2.75 14.375V7.625C2.75 6.79625 3.42125 6.125 4.25 6.125H14.75C15.5788 6.125 16.25 6.79625 16.25 7.625V14.375C16.25 15.2038 15.5788 15.875 14.75 15.875Z" stroke="#FE6330" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                      <path d="M12.6301 6.125V4.625C12.6301 3.79625 11.9589 3.125 11.1301 3.125H7.86914C7.04039 3.125 6.36914 3.79625 6.36914 4.625V6.125" stroke="#FE6330" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg> Job type
                  </div>
                  <div><?php echo get_field('job_type'); ?></div>
                </li>
                <?php endif; if(get_field('hourly_rate')):?>
                <li>
                  <div>
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none">
                      <path d="M15.2881 4.59614C18.0706 7.37863 18.0706 11.8899 15.2881 14.6724C12.5056 17.4549 7.99434 17.4549 5.21187 14.6724C2.42938 11.8899 2.42938 7.37861 5.21187 4.59614C7.99435 1.81366 12.5056 1.81366 15.2881 4.59614" stroke="#FE6330" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                      <path d="M13.0495 12.4335C11.5033 13.9796 8.99771 13.9796 7.45159 12.4335C5.90546 10.8874 5.90546 8.38174 7.45159 6.83562C8.99771 5.28949 11.5033 5.28949 13.0495 6.83562" stroke="#FE6330" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                      <path d="M10.25 8.54183H5.5" stroke="#FE6330" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                      <path d="M10.25 10.7269H5.5" stroke="#FE6330" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg> Hourly Rate
                  </div>
                  <div>&euro; <?php echo get_field('hourly_rate'); ?></div>
                </li>
                <?php endif; if(get_field('accomodation')):?>
                <li>
                  <div>
                    <svg xmlns="http://www.w3.org/2000/svg" width="19" height="19" viewBox="0 0 19 19" fill="none">
                      <path d="M3.5 6.58423V15.8842H15.5V6.58423" stroke="#FF551E" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                      <path d="M2 7.63428L9.5 2.38428L17 7.63428" stroke="#FF551E" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                      <path d="M11.75 15.8843V11.3843C11.75 10.5555 11.0788 9.88428 10.25 9.88428H8.75C7.92125 9.88428 7.25 10.5555 7.25 11.3843V15.8843" stroke="#FF551E" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg> Accomodation
                  </div>
                  <div><?php echo get_field('accomodation'); ?></div>
                </li>
                <?php endif;
                
                $terms = get_the_terms(get_the_ID(), 'job_category');                
                if ($terms && !is_wp_error($terms)) {
                
                  $term_names = array();
                  foreach ($terms as $term) {
                      $term_names[] = $term->name;
                  }

                ?>
                <li>
                  <div>
                    <svg xmlns="http://www.w3.org/2000/svg" width="19" height="19" viewBox="0 0 19 19" fill="none">
                      <path d="M3.5 6.58423V15.8842H15.5V6.58423" stroke="#FF551E" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                      <path d="M2 7.63428L9.5 2.38428L17 7.63428" stroke="#FF551E" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                      <path d="M11.75 15.8843V11.3843C11.75 10.5555 11.0788 9.88428 10.25 9.88428H8.75C7.92125 9.88428 7.25 10.5555 7.25 11.3843V15.8843" stroke="#FF551E" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg> Industry
                  </div>
                  <div><?php echo implode(', ', $term_names); ?></div>
                </li>
                <?php } if(get_field('reference_no')):?>
                <li>
                  <div>
                    <svg xmlns="http://www.w3.org/2000/svg" width="19" height="19" viewBox="0 0 19 19" fill="none">
                      <path fill-rule="evenodd" clip-rule="evenodd" d="M5.36797 5.03817L3.06472 8.26317C2.69197 8.78442 2.69197 9.48567 3.06472 10.0069L5.36797 13.2319C5.64922 13.6257 6.10372 13.8597 6.58822 13.8597H14.7505C15.5792 13.8597 16.2505 13.1884 16.2505 12.3597V5.90967C16.2505 5.08092 15.5792 4.40967 14.7505 4.40967H6.58822C6.10372 4.40967 5.64922 4.64367 5.36797 5.03817Z" stroke="#FF551E" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                      <path d="M8.42959 8.18007C8.9568 8.70728 8.9568 9.56205 8.42959 10.0893C7.90238 10.6165 7.04761 10.6165 6.52041 10.0893C5.9932 9.56205 5.9932 8.70728 6.52041 8.18007C7.04761 7.65287 7.90239 7.65287 8.42959 8.18007" stroke="#FF551E" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg> Reference no:
                  </div>
                  <div id="refno"><?php echo get_field('reference_no'); ?></div>
                </li>
                <?php endif;?>
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
              <?php endif; if(get_field('educational_requirement')):?>
              <li><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none">
                <path fill-rule="evenodd" clip-rule="evenodd" d="M8.08613 3.4125L2.94113 6.27083C1.85947 6.87166 1.85947 8.42666 2.94113 9.02749L8.08613 11.8858C9.27613 12.5467 10.7236 12.5467 11.9145 11.8858L17.0595 9.02749C18.1411 8.42666 18.1411 6.87166 17.0595 6.27083L11.9145 3.4125C10.7236 2.75166 9.27697 2.75166 8.08613 3.4125Z" stroke="#F56537" stroke-width="1.419" stroke-linecap="round" stroke-linejoin="round"/>
                <path d="M4.99316 10.1666V13.4366C4.99316 14.2275 5.389 14.965 6.0465 15.4025L7.38566 16.2933C8.96983 17.3466 11.0315 17.3466 12.6148 16.2933L13.954 15.4025C14.6123 14.965 15.0073 14.2266 15.0073 13.4366V10.1666" stroke="#F56537" stroke-width="1.4167" stroke-linecap="round" stroke-linejoin="round"/>
              </svg> <?php the_field('educational_requirement'); ?></li>
              <?php endif;?>
            </ul>
            <ul class="right">
              <li>
                  <a href="https://wa.me/?text=<?php echo rawurlencode(get_the_permalink()); ?>" class="btn btn-outline-secondary" target="_blank">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                      <path fill-rule="evenodd" clip-rule="evenodd" d="M11.0817 8.94979C6.19364 9.50144 2.49865 13.6347 2.49609 18.5538V19.166C4.62047 16.6069 7.75615 15.1026 11.0817 15.0473V18.2757C11.0818 18.7441 11.3495 19.1713 11.7711 19.3755C12.1926 19.5798 12.6938 19.5252 13.0615 19.2351L21.0548 12.9234C21.3386 12.6998 21.5042 12.3584 21.5042 11.9971C21.5042 11.6357 21.3386 11.2943 21.0548 11.0707L13.0615 4.75905C12.6938 4.46887 12.1926 4.41432 11.7711 4.61859C11.3495 4.82286 11.0818 5.25003 11.0817 5.71845V8.94979Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                  </a>
              </li>
              <?php $is_favorite = is_job_favorite(get_the_ID());?>
              <li><button class="btn btn-secondary btn-fav btn-fav-single <?php echo $is_favorite ? 'active' : ''; ?>" data-id="<?php echo get_the_ID() ?>"><svg xmlns="http://www.w3.org/2000/svg" width="21" height="21" viewBox="0 0 21 21" fill="none">
                <path fill-rule="evenodd" clip-rule="evenodd" d="M10.5 4.30937C11.1781 3.51575 12.3515 2.625 14.1382 2.625C17.2629 2.625 19.3594 5.558 19.3594 8.28975C19.3594 14 12.25 18.375 10.5 18.375C8.75 18.375 1.64062 14 1.64062 8.28975C1.64062 5.558 3.73712 2.625 6.86175 2.625C8.6485 2.625 9.82188 3.51575 10.5 4.30937Z" stroke="#fff" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
              </svg></button></li>
              <li><button type="button" class="btn btn-secondary takeJobModal" data-bs-toggle="modal" data-bs-target="#takeJobModal">Take the job</button></li>
            </ul>
          </div>
        </div>
      </div>
    </div>
    <div class="vacancy-detail-toolbar">
      <div class="vacancy-detail-toolbar__content">
        <a href="#" class="btn btn-secondary takeJobModal" data-bs-toggle="modal" data-bs-target="#takeJobModal">Take the job</a>
        <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" viewBox="0 0 21 21" fill="none">
          <path fill-rule="evenodd" clip-rule="evenodd" d="M10.5 4.30937C11.1781 3.51575 12.3515 2.625 14.1382 2.625C17.2629 2.625 19.3594 5.558 19.3594 8.28975C19.3594 14 12.25 18.375 10.5 18.375C8.75 18.375 1.64062 14 1.64062 8.28975C1.64062 5.558 3.73712 2.625 6.86175 2.625C8.6485 2.625 9.82188 3.51575 10.5 4.30937Z" stroke="#666" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
        </svg>


      </div>
    </div>
  </section>
<?php get_footer();?>

<!-- Take Job Modal -->
<div class="modal fade" id="takeJobModal" tabindex="-1" aria-labelledby="#takeJobModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-fullscreen-lg-down">
      <div class="modal-content">
        <div class="modal-header px-lg-5 pt-lg-5">
          <h1 class="modal-title fs-5" id="#takeJobModalLabel">Apply for the job</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body p-lg-5">
          <div class="contact-right">

          <form class="row g-3 g-lg-4" id="application-form"  data-url="<?php echo admin_url('admin-ajax.php'); ?>">
            <div class="col-md-6">
              <label for="gender" class="form-label">Gender</label>
              <select class="form-select" aria-label="Default select example" name="gender" id="gender">
                <option selected>Select your gender</option>
                <option value="Male">Male</option>
                <option value="Female">Female</option>
                <option value="Neutral">Neutral</option>
              </select>
            </div>

            <div class="col-md-6">
              <label for="firstname" class="form-label">First name <span>(Required)</span></label>
              <input type="text" class="form-control" id="firstname" name="firstname" placeholder="First name" required>
            </div>

            <div class="col-md-6">
              <label for="lastname" class="form-label">Last Name <span>(Required)</span></label>
              <input type="text" class="form-control" id="lastname" placeholder="Last name" name="lastname" required>
            </div>

            <div class="col-md-6">
              <label for="dob" class="form-label">Date of birth <span>(Required)</span></label>
              <input type="text" class="form-control datepicker" id="dob" name="dob" placeholder="Date of birth" required>
            </div>

            <div class="col-md-6">
              <label for="phone" class="form-label">Phone <span>(Required)</span></label>
              <input type="text" class="form-control" id="phone" name="phone" placeholder="Phone" required>
            </div>

            <div class="col-md-6">
              <label for="email" class="form-label">E-mail address <span>(Required)</span></label>
              <input type="email" class="form-control" id="email" name="email" placeholder="E-mail address" required>
            </div>

            <!-- Additional Address Fields -->

            <div class="col-md-6">
              <label for="place" class="form-label">Place <span>(Required)</span></label>
              <input type="text" class="form-control" id="place" name="place" placeholder="Place" required>
            </div>

            <!-- Additional Address Fields -->

            <div class="col-md-6">
              <label for="availFrom" class="form-label">Available from</label>
              <input type="text" class="form-control datepicker" id="availFrom" name="availFrom" placeholder="Available from">
            </div>

            <div class="col-md-6">
              <label for="availTo" class="form-label">Available to</label>
              <input type="text" class="form-control datepicker" id="availTo" name="availTo" placeholder="Available to">
            </div>

            <div class="col-md-6">
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
            </div>

            <!-- Add more Yes/No fields as needed -->

            <div class="col-12">
              <label for="textArea" class="form-label">Comment</label>
              <textarea class="form-control" id="textArea" rows="5" name="textArea" placeholder="Comment"></textarea>
            </div>

            <div class="col-12">
              <div class='file-input'>
                <input type='file' name="file" id="file">
                <span class='label uploadlabel' data-js-label><img src="<?php echo get_template_directory_uri(); ?>/assets/images/icons/i-upload.svg" alt="i-upload"> Upload CV</span>
                <span class='btn btn-secondary'>Select file</span>
              </div>
              <span>Accepted file types: jpg, pdf, png, bmp, Max. file size: 5 MB.</span>
            </div>

            <div class="col-lg-9">
              <div class="form-check">
                <input class="form-check-input" type="checkbox" id="gridCheck" name="gridCheck" required>
                <label class="ms-3 form-check-label" for="gridCheck">
                  By sending this contact form you give us permission to process your (personal) data. We handle your personal data carefully.
                </label>
              </div>
            </div>

            <input type="hidden" id="honeypot" name="honeypot" value="">

            <div class="col-12 mt-5">
              <button type="submit" class="btn btn-secondary submit-btn">Apply for the Job</button>
              <div class="loader btn-secondary send-loader"></div>
            </div>
          </form>

          <!-- Add the following scripts to initialize datepickers -->
          <script>
            $(document).ready(function () {
              $('.datepicker').datepicker({
                dateFormat: 'dd-mm-yy',
                changeMonth: true,
                changeYear: true,
                yearRange: '1900:' + new Date().getFullYear(),
                // Additional options if needed
              });
            });
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
</script>