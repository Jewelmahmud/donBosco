<?php 

    // Template Name: Contact

    get_header();     

?>
    <div class="page-banner text-white">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-xl-5">
                    <div class="subtitle">
                        <?php echo get_field('subtitle');?>
                    </div>
                    <h1><?php the_title(); ?></h1>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="<?php echo site_url(); ?>"><img src="<?php echo get_template_directory_uri(); ?>/assets/images/icon-home.svg" alt="icon-home" /></a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page"><?php the_title(); ?></li>
                        </ol>
                    </nav>

                    <div class="mt-5">
                        <p><?php the_field('description'); ?></p>
                        <?php $tabs = get_field('tab_sections'); ?>
                        <?php if ($tabs) : ?>
                            <ul class="nav nav-pills mb-4 my-lg-5 pb-tabs" id="pills-tab" role="tablist">
                                <?php foreach ($tabs as $index => $tab) : ?>
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link <?php echo ($index === 0) ? 'active' : ''; ?>" id="pills-<?php echo sanitize_title($tab['tab_title']); ?>-tab" data-bs-toggle="pill" data-bs-target="#pills-<?php echo sanitize_title($tab['tab_title']); ?>" type="button" role="tab" aria-controls="pills-<?php echo sanitize_title($tab['tab_title']); ?>" aria-selected="<?php echo ($index === 0) ? 'true' : 'false'; ?>">
                                            <?php echo $tab['tab_title']; ?>
                                        </button>
                                    </li>
                                <?php endforeach; ?>
                            </ul>
                            <div class="tab-content pb-tab-content" id="pills-tabContent">
                                <?php foreach ($tabs as $index => $tab) : ?>
                                    <div class="tab-pane fade <?php echo ($index === 0) ? 'show active' : ''; ?>" id="pills-<?php echo sanitize_title($tab['tab_title']); ?>" role="tabpanel" aria-labelledby="pills-<?php echo sanitize_title($tab['tab_title']); ?>-tab" tabindex="<?php echo ($index === 0) ? '0' : '-1'; ?>">
                                        <ul class="list-unstyled">
                                            <?php foreach ($tab['tab_items'] as $item) : 
                                                    $check = identifyContact($item['texts']['title']); 
                                                    if($check === 'email') $anchor = 'mailto:'.$item['texts']['title'];
                                                    if($check === 'phone') $anchor = 'tel:'.$item['texts']['title'];                                                
                                                    if($item['texts']['url'] !== '#' || $item['texts']['url'] !== '') {
                                                        $anchor = $item['texts']['url']; 
                                                        $target = 'target="_blank"';
                                                    } else{
                                                        $target = null;
                                                    }                                                
                                                ?>
                                                <li>
                                                    <?php if($check == 'email' || $check == 'phone' || $item['texts']['url'] !== '') echo "<a href='".$anchor."' ".$target.">";?>
                                                    <img src="<?php echo esc_url($item['icon']['url']); ?>" alt="<?php echo esc_attr($item['texts']['title']); ?>" /> <?php echo esc_html($item['texts']['title']); ?>
                                                    <?php if($check == 'email' || $check == 'phone' || $item['texts']['url'] !== '') echo "</a>";?>                                                    
                                                </li>
                                            <?php endforeach; ?>
                                        </ul>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        <?php endif; ?>

                    </div>
                </div>
                <div class="col-lg-6 offset-xl-1 mt-4 mt-lg-0">
                <?php $form = get_field('form_details'); ?>
                    <div class="form-box">
                        <div class="form-box-top">
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
    </div>
</div>
<?php get_footer(); ?>
