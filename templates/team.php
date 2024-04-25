<?php 

// template name: Team
get_header(); 

$teams = get_field('teams'); 

?>

<section class="team-wrapper">
    <div class="container my-5 py-lg-5">
        
        <?php 
        foreach ($teams as $index => $value) {
            if ($index % 2 == 0) {?>
        
                <div class="row mb-4" style="--bs-gutter-x: 2rem;">
                    <div class="col-12">
                    <h2><?php echo $value['team_title']; ?></h2>
                    </div>
                    <?php foreach($value['member_details'] as $index => $item){
                        if ($index == 1) {?>
                            <div class="col-lg-4 col-md-6 mb-4">
                                <div class="team-ppl-status section-primary">
                                    <div class="status">"<?php echo $value['quote_details']['quote'] ?>"</div>
                                    <div class="status-giver">- <?php echo $value['quote_details']['quote_by'] ?></div>
                                </div>
                            </div>
        
                        <?php } ?>                
        
                        <div class="col-lg-4 col-md-6 mb-4">
                            <a href="#" class="news-card team-card">
                                <div class="news-card-header team-card-header">
                                <div class="card-image">
                                    <img src="<?php echo $item['image']['url']; ?>" alt="<?php echo $item['image']['alt']; ?>" class="img-fluid">
                                </div>
                                
                                </div>
                                <div class="news-card-body team-card-body">
                                <h3><?php echo $item['name']; ?></h3>
                                <div class="position"><?php echo $item['position']; ?></div>
                                <p><?php echo $item['details']; ?></p>
                                <div class="text-link">Lees meer <img src="<?php echo get_template_directory_uri();?>/assets/images/icon-arrow.svg" alt="icon-arrow"></div>
                                </div>
                            </a>
                        </div>
                    <?php } ?>
                </div>
        
                
            <?php } else {?>
        
                <div class="row mb-4" style="--bs-gutter-x: 2rem;">
                    <div class="col-12">
                    <h2><?php echo $value['team_title']; ?></h2>
                    </div>
                    <?php foreach($value['member_details'] as $index => $item){
                        if ($index == 0) {?>
                            <div class="col-lg-4 col-md-6 mb-4">
                                <div class="team-ppl-status section-primary">
                                    <div class="status">"<?php echo $value['quote_details']['quote'] ?>"</div>
                                    <div class="status-giver">- <?php echo $value['quote_details']['quote_by'] ?></div>
                                </div>
                            </div>
        
                        <?php } ?>                
        
                        <div class="col-lg-4 col-md-6 mb-4">
                            <a href="#" class="news-card team-card">
                                <div class="news-card-header team-card-header">
                                <div class="card-image">
                                    <img src="<?php echo $item['image']['url']; ?>" alt="<?php echo $item['image']['alt']; ?>" class="img-fluid">
                                </div>
                                
                                </div>
                                <div class="news-card-body team-card-body">
                                <h3><?php echo $item['name']; ?></h3>
                                <div class="position"><?php echo $item['position']; ?></div>
                                <p><?php echo $item['details']; ?></p>
                                <div class="text-link">Lees meer <img src="<?php echo get_template_directory_uri();?>/assets/images/icon-arrow.svg" alt="icon-arrow"></div>
                                </div>
                            </a>
                        </div>
                    <?php } ?>
                </div>
        
            <?php }
        }
        ?>

    </div>
</section>


<?php get_footer(); ?>