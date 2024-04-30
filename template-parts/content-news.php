<?php 
    $counter = $args['counter'];
    $counter++;
    $colors = array('ylw', 'green', 'red');
    $color = $colors[$counter % 3];
    $categories = get_the_category();
    $category_slugs = array();

    if (!empty($categories)) {
        foreach ($categories as $category) {
            $category_slugs[] = esc_attr($category->slug);
        }
    }
    $category_class = implode(' ', $category_slugs); 
    
    
    ?>
<div class="col-lg-4 col-md-6 mb-4 filter-item <?php echo $category_class; ?>">
<a href="<?php the_permalink(); ?>" class="news-card">
    <div class="news-card-header">
        <div class="card-image">
            <?php
            if (has_post_thumbnail()) {
                the_post_thumbnail('newsthumb', ['class' => 'img-fluid', 'alt' => 'card image']);
            } else {
            ?>
            <img src="<?php echo get_template_directory_uri(); ?>/assets/images/placeholoder_logo.jpg" alt="card image" class="img-fluid">
            <?php } ?>
        </div>
        <?php
        if (!empty($categories)) {
            $category_count = count($categories);
            foreach ($categories as $index => $category) {
                $category_names[] = $category->name;
                ?>
                <div class="news-card-tag tag-bg-<?php echo $color; ?>">
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/images/icon-info.svg" alt="info icon">
                    <?php echo esc_html(implode(', ', $category_names)); ?>
                </div>
                <?php
            }
        }
        ?>
    </div>
    <div class="news-card-body">
        <h3><?php the_title(); ?></h3>
        <p><?php echo wp_trim_words(get_the_excerpt(), 20, '...'); ?></p>
        <div class="text-link">Lees meer <img src="<?php echo get_template_directory_uri(); ?>/assets/images/icon-arrow.svg" alt="icon-arrow"></div>
    </div>
</a>
</div>