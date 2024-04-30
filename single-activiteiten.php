
<?php get_header(); ?>


<section class="text-content-page py-5 my-3 my-lg-5">
    <div class="container">
      <div class="row">
        <div class="col-lg-6 mb-5 mb-lg-0">
            <?php 
                
                while (have_posts()) {
                    the_post();
                    echo alter_get_the_content(get_the_content());
                }

            ?>
        </div>
        
        <div class="col-lg-6">
          <div class="form-box position-sticky" style="top: 20px">
            <div class="form-box-top">
                <?php $form = get_field('single_page_form', 'option');?>
                <h4><?php echo $form['form_title']; ?></h4>
                <p><?php echo $form['form_description']; ?></p>
            </div>
            <div class="form-wrapper">
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
                </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

<?php get_footer(); ?>
