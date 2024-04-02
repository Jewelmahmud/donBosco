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
$isForm      = get_field('do_you_need_form');

if($isForm):

    $title   = $formDetails['form_title']? $formDetails['form_title'] : 'Send us message';
    $name    = $formDetails['name_input']? $formDetails['name_input'] : 'Full name';
    $company = $formDetails['company_name']? $formDetails['company_name'] : 'Company name';
    $phone   = $formDetails['phone_label']? $formDetails['phone_label'] : 'Phone';
    $email   = $formDetails['email_label']? $formDetails['email_label'] : 'Email';
    $message = $formDetails['message_label']? $formDetails['message_label'] : 'Message';
    $button  = $formDetails['send_button']? $formDetails['send_button'] : 'Send Message';

?>

<section class="textPageForm">
    <div class="container">
        <div class="row">
            <div class="col-lg-7">
                <div class="btn-form mt-5 d-lg-none">
                    <a href="#scrollform" class="py-2 btn btn-secondary w-100">
                        <span><?php echo __('Direct Contact', 'donbosco'); ?></span>
                    </a>
                </div>
                <div class="page-content">
                    <?php the_content(); ?>
                </div>
            </div>
            <div class="col-lg-5">
                <div class="contact-right" id="scrollform" data-aos="fade-up">
                    <h3><?php echo $title; ?></h3>
                    <form class="row g-3 g-xl-4" id="page-form" data-url="<?php echo admin_url('admin-ajax.php'); ?>">
                        <input type="hidden" name="honeypot" value="" id="honeypot" />
                        <div class="col-12">
                            <label for="naam" class="form-label"><?php echo $name; ?></label>
                            <input type="text" class="form-control" id="naam" name="naam" required />
                        </div>

                        <div class="col-12">
                            <label for="companyName" class="form-label"><?php echo $company; ?></label>
                            <input type="text" class="form-control" id="companyName" name="companyName" />
                        </div>
                        <div class="col-12">
                            <label for="telephone" class="form-label"><?php echo $phone; ?></label>
                            <input type="text" class="form-control" id="telephone" name="telephone" />
                        </div>
                        <div class="col-12">
                            <label for="email" class="form-label"><?php echo $email; ?></label>
                            <input type="text" class="form-control" id="email" name="email" required />
                        </div>
                        <div class="col-12">
                            <label for="textArea" class="form-label"><?php echo $message; ?></label>
                            <textarea class="form-control" id="textArea" name="textArea" rows="5" ></textarea>
                        </div>
                        <div class="col-12">
                            <button type="submit" class="btn btn-secondary submit-btn"><?php echo $button; ?></button>
                            <div class="loader btn-secondary send-loader"></div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

<?php else : ?>

<div class="container">
    <div class="page-content-width page-content">
        <?php the_content(); ?>
    </div>
</div>


<?php endif;  get_footer(); ?>

<script>
    const b2Logo = initializeRive("<?php echo get_template_directory_uri();?>/assets/rive/main-logo.riv", "main-logo", "b2Logo");
    const r8 = initializeRive("<?php echo get_template_directory_uri();?>/assets/rive/logo-b2-white.riv", "logo-b2-white", "r8");
    const r9 = initializeRive("<?php echo get_template_directory_uri();?>/assets/rive/line-white.riv", "line-white", "r9");
    const r10 = initializeRive("<?php echo get_template_directory_uri();?>/assets/rive/smile-white.riv", "smile-rive3", "r10");
</script>