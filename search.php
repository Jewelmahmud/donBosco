<?php
/**
 * Template Search Page
 *
 * @package donbosco
 * @author Huqson.nl
 * @link http://huqson.nl
 */

get_header();

?>
<serction class="vacancies-wrapper">
<div class="container">

<div class="row vacancies-card-holder" data-aos="fade-up">

<?php
  if (have_posts()) { 
          while (have_posts()) : the_post(); 
            get_template_part('template-parts/content', 'search'); 
          endwhile; 
    } else {
      echo "<div class='no_result'><h2>".__('Sorry!<br> Nothing Found', 'donbosco')."</h2>";
      echo '<img class="nothing_found" src="'.get_template_directory_uri().'/assets/images/nothing_found.svg" alt="Nothing Found"></div>';
    }?>
  
</div>

</div>
</section>
<?php
get_footer();