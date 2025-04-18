
<?php get_header(); 

 $form = get_field('single_page_form', 'option');
 $sform = get_field('form_details');
 $donationDetails = get_field('donation_form_details');
 $isForm = get_field('choose_a_form'); 
 $formSwitch = get_field('form_on_left_side'); 

if($isForm == 'General Form') $formtitle = $sform['form_title'];
elseif ($isForm == 'Donation Form') $formtitle = $donationDetails['form_title'];
else $formtitle = 'Ga naar formulier';

?>


<section class="text-content-page py-5 my-3 my-lg-5">
    <div class="container">
      <?php if(wp_is_mobile() && $isForm !== 'None') :?>
        <div class="goForm mb-4">
            <a href="#donForm" class="btn btn-primary"><?= $formtitle; ?></a>
        </div>
      <?php endif; ?>
      <div class="row">
        <?php if(!$formSwitch): ?>
        <div class="col-lg-<?= ($isForm == 'None')? 12 : 7; ?> mb-5 mb-lg-0">
            <?php 
                if(have_posts()){
                    while (have_posts()) {
                        the_post();
                        echo alter_get_the_content(get_the_content());
                    }
                }
            ?>
        </div>
        <?php endif; ?>

        <?php if($isForm !== 'None') : ?>        
            <div class="col-lg-5" id="donForm">
                <div class="form-box position-sticky" style="top: 20px">
                    <?php if($isForm !== 'Donation Form'): ?>
                    <div class="form-box-top">
                        <h4><?php 
                        if(!empty($sform['form_title'])) echo $sform['form_title'];
                        else echo $form['form_title']; ?></h4>

                        <p><?php if(!empty($sform['form_description'])) echo $sform['form_description'];
                        else echo $form['form_description']; ?></p>
                    </div>
                    <?php endif; ?>
                    <div class="form-wrapper <?php if($isForm === 'Donation Form') echo 'page-donation-form'; ?>">
                        <?php 
                            if($isForm === 'Donation Form'){
                                $title = $donationDetails['form_title'];
                                echo do_shortcode('[donation_form title="' . esc_attr($title) . '"]');
                            } elseif ($isForm === 'General Form'){ ?>
                                <form id="contact-form">
                                    <input type="hidden" value="" id="honeypot" name="honeypot">
                                    <div class="form-floating mb-3">
                                        <input type="text" class="form-control" placeholder="<?php echo $form['full_name']; ?>" id="name" name="name" />
                                        <label for="name" name="name"><?php echo $form['full_name']; ?></label>
                                    </div>
                                    <div class="form-floating mb-3">
                                        <input type="email" class="form-control" placeholder="<?php echo $form['email_input']; ?>*" id="email" name="email" />
                                        <label for="email" name="email"><?php echo $form['email_input']; ?>*</label>
                                    </div>
                                    <div class="form-floating mb-3">
                                        <input type="text" class="form-control" placeholder="<?php echo $form['telephone_input']; ?>*" id="phone" name="phone" />
                                        <label for="phone"><?php echo $form['telephone_input']; ?>*</label>
                                    </div>
                                    <div class="form-floating mb-2">
                                        <textarea class="form-control" placeholder="<?php echo $form['textarea']; ?>*" id="message" name="message" rows="5"></textarea>
                                        <label for="message"><?php echo $form['textarea']; ?>*</label>
                                    </div>
                                    <div class="text-start mb-3">
                                        *<?php echo $form['valid_field_texts']; ?>
                                    </div>
                                    <button type="submit" class="btn btn-primary btn-with-arrow submitbtn">
                                        <div class="loading-animation d-none">
                                            <img src="<?php echo get_template_directory_uri(); ?>/assets/images/loading.svg" alt="loading">
                                        </div>
                                        <div class="btntexts">
                                            <?php if(!empty($sform['send_button'])) echo $sform['send_button'];
                                            else echo $form['send_button']; ?>
                                            <svg width="8" height="12" viewBox="0 0 8 12" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                                <circle cx="2" cy="2" r="2" fill="currentColor"></circle>
                                                <circle cx="6" cy="6" r="2" fill="currentColor"></circle>
                                                <circle cx="2" cy="10" r="2" fill="currentColor"></circle>
                                            </svg>
                                        </div>
                                    </button>

                                    <div class="notes pt-4 mt-3 px-lg-4">
                                    <?php 
                                    if(!empty($sform['form_below_texts'])) echo $sform['form_below_texts'];
                                    else echo $form['form_below_texts']; ?>
                                    </div>
                                </form><?php 
                            }
                    ?></div>
                </div>
            </div>
        <?php endif; ?>
        <?php if($formSwitch): ?>
            <div class="col-lg-<?= ($isForm == 'None')? 12 : 7; ?> mb-5 mb-lg-0">
                <?php 
                    if(have_posts()){
                        while (have_posts()) {
                            the_post();
                            echo alter_get_the_content(get_the_content());
                        }
                    }
                ?>
            </div>
        <?php endif; ?>
      </div>
    </div>
  </section>

<?php get_footer(); ?>
