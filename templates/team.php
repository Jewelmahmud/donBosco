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
                        if ($index == 1 && $value['quote_details']['quote']) {?>
                            <div class="col-lg-4 col-md-6 mb-4">
                                <div class="team-ppl-status section-primary">
                                    <div class="status">"<?php echo $value['quote_details']['quote'] ?>"</div>
                                    <div class="status-giver">- <?php echo $value['quote_details']['quote_by'] ?></div>
                                </div>
                            </div>
        
                        <?php } ?>                
        
                        <div class="col-lg-4 col-md-6 mb-4">
                            <div class="news-card team-card">
                                <div class="news-card-header team-card-header">
                                <div class="card-image">
                                    <?php 
                                      $image_id = $item['image']['ID'];
                                      $resized_image_url = wp_get_attachment_image_src($image_id, 'teamimg')[0];
                                      $original_image_url = wp_get_attachment_image_src($image_id, 'full')[0];                                    
                                    ?>
                                    <img src="<?php echo $original_image_url; ?>" data-img="<?php echo $resized_image_url; ?>" alt="<?php echo $item['image']['alt']; ?>" class="img-fluid personimage">
                                </div>
                                
                                </div>
                                <div class="news-card-body team-card-body">
                                    <h3><?php echo $item['name']; ?></h3>
                                    <div class="position"><?php echo $item['position']; ?></div>
                                    <p><?php echo limitWords($item['details'], 12, true); ?></p>
                                    <p class="full-text d-none"><?php echo $item['details']; ?></p>
                                    <div data-bs-toggle="modal" data-bs-target="#teamPpl" class="text-link">Lees meer <img src="<?php echo get_template_directory_uri();?>/assets/images/icon-arrow.svg" alt="icon-arrow"></div>
                                    <div class="d-none pphone"><?php echo $item['phone']; ?></div>
                                    <div class="d-none pemail"><?php echo $item['email']; ?></div>
                                    <ul class="socials d-none">
                                      <?php 
                                      if ($item['social_media']) {
                                        $medias = social_medias();
                                        foreach ($item['social_media'] as $media) {
                                          $url = $media['link'];
                                          if ($media['link']) {
                                            if (extract_url_body($url) === 'whatsapp') {
                                              $pre = 'https://wa.me/';
                                            } else {
                                              $pre = '';
                                            }
                                            echo '<li><a href="'.$pre.$url.'" target="_blank">'.$medias[extract_url_body($url)].'</a></li>';
                                          }
                                        }
                                      }
                                      ?>
                                    </ul>

                                </div>
                            </div>
                        </div>
                    <?php } ?>
                </div>
        
                
            <?php } else {?>
        
                <div class="row mb-4 teap-member" style="--bs-gutter-x: 2rem;">
                    <div class="col-12">
                    <h2><?php echo $value['team_title']; ?></h2>
                    </div>
                    <?php foreach($value['member_details'] as $index => $item){
                        if ($index == 0 && $value['quote_details']['quote']) {?>
                            <div class="col-lg-4 col-md-6 mb-4">
                                <div class="team-ppl-status section-primary">
                                    <div class="status">"<?php echo $value['quote_details']['quote'] ?>"</div>
                                    <div class="status-giver">- <?php echo $value['quote_details']['quote_by'] ?></div>
                                </div>
                            </div>
        
                        <?php } ?>                
        
                        <div class="col-lg-4 col-md-6 mb-4">
                            <div class="news-card team-card">
                                <div class="news-card-header team-card-header">
                                <div class="card-image">
                                    <?php 
                                      $image_id = $item['image']['ID'];
                                      $resized_image_url = wp_get_attachment_image_src($image_id, 'teamimg')[0];
                                      $original_image_url = wp_get_attachment_image_src($image_id, 'full')[0];                                    
                                    ?>
                                    <img src="<?php echo $original_image_url; ?>" data-img="<?php echo $resized_image_url; ?>" alt="<?php echo $item['image']['alt']; ?>" class="img-fluid personimage">
                                </div>
                                
                                </div>
                                <div class="news-card-body team-card-body">
                                    <h3><?php echo $item['name']; ?></h3>
                                    <div class="position"><?php echo $item['position']; ?></div>
                                    <p><?php echo limitWords($item['details'], 12, true); ?></p>
                                    <p class="full-text d-none"><?php echo $item['details']; ?></p>
                                    <div data-bs-toggle="modal" data-bs-target="#teamPpl" class="text-link">Lees meer <img src="<?php echo get_template_directory_uri();?>/assets/images/icon-arrow.svg" alt="icon-arrow"></div>
                                    <div class="d-none pphone"><?php echo $item['phone']; ?></div>
                                    <div class="d-none pemail"><?php echo $item['email']; ?></div>
                                    <ul class="socials d-none">
                                      <?php 

        
                                      
                                      if ($item['social_media']) {
                                        $medias = social_medias();
                                        foreach ($item['social_media'] as $media) {
                                          $url = $media['link'];
                                          if ($media['link']) {
                                            if (extract_url_body($url) === 'whatsapp') {
                                              $pre = 'https://wa.me/';
                                            } else {
                                              $pre = '';
                                            }
                                            echo '<li><a href="'.$pre.$url.'" target="_blank">'.$medias[extract_url_body($url)].'</a></li>';
                                          }
                                        }
                                      }
                                      ?>
                                    </ul>

                                </div>
                            </div>
                        </div>
                    <?php } ?>
                </div>
        
            <?php }
        }


        ?>

    </div>
</section>

<!-- Modal -->
<div class="modal fade" id="teamPpl" tabindex="-1" aria-labelledby="teamPplLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      
      <div class="modal-body p-0">
        <div class="row mx-0">
          <div class="col-md-7 p-4 p-lg-5 order-2 order-md-0 modal-texts">
            <h3 class="person_name">Giovanni Bosco</h3>
            <div class="position">Jongerenwerker | Zevenhuizen</div>
            <p class="details">Lorem Ipsum is slechts een proeftekst uit het drukkerij- en zetterijwezen. Lorem Ipsum is de standaard proeftekst in deze bedrijfstak sinds de 16e eeuw, toen een onbekende drukker een zethaak met letters nam en ze door elkaar husselde om een font-catalogus te maken. Het heeft niet alleen vijf eeuwen overleefd maar is ook, vrijwel onveranderd en overgenomen in elektronische.</p>
            <div class="d-flex align-items-center gap-2 mb-2">
              <img src="<?php echo get_template_directory_uri(); ?>/assets/images/icon-mobile.svg" alt="icon-mobile"> <a class="modalphone" href="tel:0627057799" style="color: currentColor;font-size: 1rem;">06 - 27 05 77 99</a>
            </div>
            <div class="d-flex align-items-center gap-2 mb-2">
              <img src="<?php echo get_template_directory_uri(); ?>/assets/images/icon-envelope.svg" alt="icon-envelope"> <a class="modalemail" href="mailto:f.kilic@donboscoapeldoorn.nl" style="color: currentColor;font-size: 1rem;">f.kilic@donboscoapeldoorn.nl</a>
            </div>
            <ul class="social-icon-wrapper pt-4">
              
            </ul>
          </div>
          <div class="col-md-5 p-0 img-holder">
            <img src="<?php echo get_template_directory_uri(); ?>/assets/images/popup-image.jpg" alt="popup-image" class="rounded-3 w-100 person-img">
          </div>
        </div>
      </div>
      
    </div>
  </div>
</div>


<?php get_footer(); ?>