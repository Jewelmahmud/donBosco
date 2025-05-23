<?php
/**
 * Page Template
 *
 * @package donbosco
 * @author Huqson
 * @link http://huqson.nl
 */

get_header();

$formDetails = get_field('form_details');
$donationDetails = get_field('donation_form_details');
$isForm      = get_field('choose_a_form');

if($isForm == 'General Form') $formtitle = $formDetails['form_title'];
elseif ($isForm == 'Donation Form') $formtitle = $donationDetails['form_title'];
else $formtitle = 'Ga naar formulier';


?>

<section class="text-content-page contents py-5 my-3 my-lg-5">
    <div class="container">
      <?php if(wp_is_mobile() && $isForm !== 'None') :?>
        <div class="goForm mb-4">
            <a href="#donForm" class="btn btn-primary"><?= $formtitle; ?></a>
        </div>
      <?php endif; ?>
      <div class="row">
        <div class="col-lg-<?php echo ($isForm !== 'None')? '6' : '12'; ?> mb-5 mb-lg-0">
            <?php the_content(); ?>
        </div>
        <?php if($isForm !== 'None'): ?>
        <div class="col-lg-6" id="donForm">
          <div class="form-box position-sticky" style="top: 20px">
            <?php if($isForm === 'General Form'):?>
            <div class="form-box-top">
                <?php $form = get_field('form_details'); ?>
                <h4><?php echo $form['form_title']; ?></h4>
                <p><?php echo $form['form_description']; ?></p>
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
                                    <?php echo $form['send_button']; ?>
                                    <svg width="8" height="12" viewBox="0 0 8 12" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                        <circle cx="2" cy="2" r="2" fill="currentColor"></circle>
                                        <circle cx="6" cy="6" r="2" fill="currentColor"></circle>
                                        <circle cx="2" cy="10" r="2" fill="currentColor"></circle>
                                    </svg>
                                </div>
                            </button>

                            <div class="notes pt-4 mt-3 px-lg-4"><?php echo $form['form_below_texts']; ?></div>
                        </form><?php 
                    }
            ?></div>
          </div>
        </div>
        <?php endif; ?>
      </div>
    </div>
  </section>


<?php get_footer(); ?>