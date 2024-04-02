<?php $is_favorite = is_job_favorite(get_the_ID());?>
<div class="col-md-6 col-lg-4 mb-4">
<div class="vacancies-card-item">
    <div>
    <button type="button" class="btn-fav <?php echo $is_favorite ? 'active' : ''; ?>" data-id="<?php echo get_the_ID(); ?>" onclick="addFavourite(this)"><svg xmlns="http://www.w3.org/2000/svg" width="21" height="21"
        viewBox="0 0 21 21" fill="none">
        <path fill-rule="evenodd" clip-rule="evenodd"
            d="M10.5 4.30937C11.1781 3.51575 12.3515 2.625 14.1382 2.625C17.2629 2.625 19.3594 5.558 19.3594 8.28975C19.3594 14 12.25 18.375 10.5 18.375C8.75 18.375 1.64062 14 1.64062 8.28975C1.64062 5.558 3.73712 2.625 6.86175 2.625C8.6485 2.625 9.82188 3.51575 10.5 4.30937Z"
            stroke="#828282" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
        </svg></button>
    <div class="top">
    <a href="<?php echo get_the_permalink(); ?>">
        <?php
        // Check local storage
        $terms = get_the_terms(get_the_ID(), 'job_category');

        if ($terms && !is_wp_error($terms)) :
            foreach ($terms as $term) :
                $category_image = get_field('category_image', $term);
                ?>
                <div class="vacancies-name">
                    <?php if ($category_image) : ?>
                        <img src="<?php echo esc_url($category_image['url']); ?>" alt="<?php echo esc_attr($term->name); ?>">
                    <?php endif; ?>
                    <?php echo esc_html($term->name); ?>
                </div>
                <?php
            endforeach;
        endif;
        ?>
        <h4 class="item-name"><?php echo get_the_title();; ?></h4>
        <!-- <p><?php echo get_field('tags'); ?></p> -->
    </a>
    </div>
    <div class="bottom">
        <ul>
            <?php $location = get_field('location'); ?>
            <li>
                <span><img src="<?php echo get_template_directory_uri(); ?>/assets/images/icons/i-pin.svg" alt="i-pin"> <?php echo __('Location', 'donbosco');?></span>
                <span><?php echo ($location ? esc_html($location) : '-'); ?></span>
            </li>

            <?php $jobType = get_field('job_type'); ?>
            <li>
                <span><img src="<?php echo get_template_directory_uri(); ?>/assets/images/icons/icon-job.svg" alt="icon-job"> <?php echo __('Job type', 'donbosco');?></span>
                <span><?php echo ($jobType ? esc_html($jobType) : '-'); ?></span>
            </li>

            <?php $hourly_rate = get_field('hourly_rate'); ?>
            <li>
                <span><img src="<?php echo get_template_directory_uri(); ?>/assets/images/icons/i-euro.svg" alt="i-euro"> <?php echo __('Hourly rate', 'donbosco');?></span>
                <span><?php echo ($hourly_rate ? '&euro; ' . esc_html($hourly_rate) : '-'); ?></span>
            </li>

            <?php 
            if ($terms && !is_wp_error($terms)) :
                foreach ($terms as $term) :
                    $category_image = get_field('category_image', $term);
                    ?>
                    <li>
                        <span>
                            <img src="<?php echo get_template_directory_uri(); ?>/assets/images/icons/i-industri.svg" alt="i-industri"> 
                            <?php echo __('Industry', 'donbosco');?>
                        </span>
                        <span><?php echo ($term ? esc_attr($term->name) : '-'); ?></span>
                    </li>
                    <?php
                endforeach;
            endif;
            ?>

            <?php $hours_per_week = get_field('hours_per_week'); ?>
            <!-- <li>
                <span><img src="<?php echo get_template_directory_uri(); ?>/assets/images/icons/i-time.svg" alt="i-time"> <?php echo __('Number of hours', 'donbosco');?></span>
                <span><?php echo ($hours_per_week ? esc_html($hours_per_week) : '-'); ?></span>
            </li> -->

            <?php $accommodation = get_field('accommodation'); ?>
            <li>
                <span><img src="<?php echo get_template_directory_uri(); ?>/assets/images/icons/i-home.svg" alt="i-home"> <?php echo __('Accommodation', 'donbosco');?></span>
                <span><?php echo ($accommodation ? esc_html($accommodation) : '-'); ?></span>
            </li>

        </ul>

    </div>
    </div>
    <a href="<?php echo get_the_permalink(); ?>" class="link-btn"><?php echo __('View Job', 'donbosco');  ?> <svg xmlns="http://www.w3.org/2000/svg" width="7" height="10"
        viewBox="0 0 7 10" fill="none">
        <path d="M1 1L5 5L1 9" stroke="#FF551E" stroke-width="2"></path>
    </svg></a>
</div>
</div>