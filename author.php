<?php
/**
 * Author Template
 *
 * @package Gisola
 * @author Fatih
 * @link Fhttp://huqson.nl
 */

get_header('spage');
?>
<div class="container space-top-2">
    <div class="row">
    <?php
        while ( have_posts() ) : the_post(); 
            the_content(); 
        endwhile; 
        ?>
    </div>
</div>
<?php
get_footer();