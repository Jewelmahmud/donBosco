<?php

//Template Name: Sponsor
get_header();
$sponsors = get_field('sponsors');
?>

<section class="sponsor-wrapper py-5 my-3 my-lg-5">
    <div class="container">
      <div class="row">
        <div class="col-12">
            <?php if($sponsors){ foreach($sponsors as $sponsor){?>
          <div class="sponsr-holder">
            <div class="subtitle"><?php echo $sponsor['sponsors_subtitle']; ?></div>
            <h2><?php echo $sponsor['sponsors_title']; ?></h2>
            <ul class="sponsor-list">
                <?php if($sponsor['sponsor']){ foreach($sponsor['sponsor'] as $item){
                    echo '<li><a href="'.$item['url'].'" target="_blank"><img src="'.$item['logo']['url'].'" alt="'.$item['logo']['alt'].'"></a></li>';
                }}?>
            </ul>
          </div>

          <?php }} ?>

          
        </div>
      </div>
    </div>
  </section>

<?php get_footer(); ?>

