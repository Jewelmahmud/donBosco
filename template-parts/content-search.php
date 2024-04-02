
<div class="col-md-6 col-lg-4 mb-4">
<div class="vacancies-card-item">
    <div>
    <div class="top">    
        <h4 class="item-name"><?php the_title(); ?></h4>
        <p><?php echo (get_the_excerpt())? limitWords(strip_tags(get_the_excerpt()), 7) : __('Click below details link to get more of this item', 'b2works') ?></p>
    </div>
    <!-- <div class="bottom">
        <ul>
            <li>
                <span>
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/images/icons/i-pin.svg" alt="i-pin">
                    <?php echo __('Type', 'b2works'); ?>
                </span>
                <span><?php echo get_post_type(); ?></span>
            </li>
            <li>
                <span>
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/images/icons/i-time.svg" alt="i-time">
                    <?php echo __('Created at', 'b2works'); ?>
                </span>
                <span><?php echo get_the_date(); ?></span>
            </li>
        </ul>

    </div> -->
    </div>
    <a href="<?php the_permalink(); ?>" class="link-btn"><?php echo __('View details', 'b2works'); ?> <svg xmlns="http://www.w3.org/2000/svg" width="7" height="10"
        viewBox="0 0 7 10" fill="none">
        <path d="M1 1L5 5L1 9" stroke="#FF551E" stroke-width="2"></path>
    </svg></a>
</div>
</div>