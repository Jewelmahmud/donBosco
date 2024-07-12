<?php 

$post_title = get_the_title();
$post_date = get_the_date('j F Y'); 
$post_link = get_permalink();
$post_image = wp_get_attachment_image_src(get_post_thumbnail_id(), 'full');
$post_image_url = $post_image ? $post_image[0] : get_template_directory_uri() . '/assets/images/b2work_thumb_280x160.png';

// Get the post categories
$post_categories = get_the_category();
$category_classes = '';

if ($post_categories) {
    foreach ($post_categories as $category) {
        $category_classes .= ' ' . esc_attr($category->slug);
    }
}

echo '<a href="' . $post_link . '" class="news-card ' . esc_attr($category_classes) . '">
        <div class="image">
        <img src="' . $post_image_url . '" alt="' . $post_title . '">
        <div class="tag">' . esc_html($post_categories[0]->name) . '</div>
        </div>
        <div class="text">
        <div class="news-date">' . $post_date . '</div>
        <h5>' . $post_title . '</h5>
        <p>' . get_the_excerpt() . '</p>
        <div class="read-more">Read more <svg xmlns="http://www.w3.org/2000/svg" width="16" height="17" viewBox="0 0 16 17"
            fill="none">
            <path d="M6.00222 4.5L10 8.512L6 12.5" stroke="#FF551E" stroke-width="2" stroke-linecap="round"
                stroke-linejoin="round" />
            </svg>
        </div>
        </div>
    </a>';
?>