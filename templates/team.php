<?php

//Template Name: Team

get_header() ?>
  <section class="b2-our-team">
    <div class="container">
      <?php $textssection = get_field('text_section');?>
      <div class="our-team-top">
        <div class="row">
          <div class="col-md-4" data-aos="fade-right">
            <div class="pre-title"><?php echo $textssection['subtitle']; ?></div>
            <h2><?php echo $textssection['title']; ?></h2>
          </div>
          <div class="col-md-8" data-aos="fade-left">
            <p><?php echo $textssection['texts']; ?></p>
          </div>
        </div>
      </div>

      <?php 
      
        $teams = get_field('teams');

        if($teams){
          foreach($teams as $team){?>

            <div class="our-team-bottom">
              <div class="row gx-3 gx-xl-4">
                <div class="col-12">
                  <h5><?php echo $team['team_title']; ?></h5>
                </div>

                <?php 
                $members = $team['member_detailss'];
                if($members){
                  foreach($members as $member){?>

                    <div class="col-md-4 col-lg-3">
                      <div class="profile" data-aos="fade">
                        <div class="top">
                          <img src="<?php echo get_template_directory_uri(); ?>/assets/images/icons/b2-transparent.svg" alt="b2-transparent" class="b2-bg">
                          <?php                       
                            if($member['members_image']){
                              echo '<img class="man" src="'.$member['members_image']['url'].'" alt="'.$member['members_image']['alt'].'" class="img-fluid position-relative">';
                            }
                          
                            if($member['linkedin_url']){ ?>
                            <a href="<?php echo $member['linkedin_url'];  ?>" class="social-link" target="_blank"><svg xmlns="http://www.w3.org/2000/svg" width="14" height="14"
                                viewBox="0 0 14 14" fill="none">
                                <path
                                  d="M3.08437 13.6574H0.363281V4.88528H3.08437V13.6574ZM1.72236 3.68868C0.852246 3.68868 0.146484 2.96719 0.146484 2.09614C0.146484 1.67774 0.312514 1.27647 0.608049 0.980618C0.903583 0.684764 1.30441 0.518555 1.72236 0.518555C2.14031 0.518555 2.54114 0.684764 2.83668 0.980618C3.13221 1.27647 3.29824 1.67774 3.29824 2.09614C3.29824 2.96719 2.59219 3.68868 1.72236 3.68868ZM13.2686 13.6574H10.5533V9.38721C10.5533 8.36951 10.5328 7.06439 9.13857 7.06439C7.72383 7.06439 7.50703 8.17007 7.50703 9.31389V13.6574H4.78887V4.88528H7.39863V6.08188H7.43672C7.8 5.39266 8.6874 4.66532 10.0113 4.66532C12.7652 4.66532 13.2715 6.48075 13.2715 8.83877V13.6574H13.2686Z"
                                  fill="white" />
                              </svg> </a>
                          <?php } ?>
                        </div>
                        <div class="bottom">
                          <ul class="flags">
                            <?php if($member['flags']){ foreach($member['flags'] as $flag){ ?>
                            <li><img src="<?php echo $flag['flag']['url'];  ?>" alt="<?php echo $flag['flag']['alt'];  ?>"></li>
                            <?php }} ?>
                          </ul>
                          <h4 class="profile-name"><?php echo $member['name'] ?></h4>
                          <div class="position"><?php echo $member['designation'] ?></div>
                          <p><?php echo limitWords($member['description'], 7) ?></p>
                          <div class="full-description" style="display:none"><?php echo $member['description'] ?></div>
                          <div class="jobstarts" style="display:none"><?php echo $member['working_since'] ?></div>
                          <ul class="contact">
                            <?php if($member['whatsapp']): ?>
                            <li><a class="whatsappnum" href="tel: <?php echo $member['whatsapp']; ?>"><img src="<?php echo get_template_directory_uri(); ?>/assets/images/icons/whatsup.svg" alt="Call"> <?php echo $member['whatsapp']; ?> </a></li>
                            <?php endif; if($member['email']): ?>
                            <li><a class="emailid" href="mailto:<?php echo $member['email']; ?>"><img src="<?php echo get_template_directory_uri(); ?>/assets/images/icons/mail.svg" alt="Email"> <?php echo $member['email']; ?></a></li>
                            <?php endif; ?>
                          </ul>
                          <a href="#" class="link-btn" data-bs-toggle="modal" data-bs-target="#seeMoreModal"><?php echo __('See more', 'donbosco'); ?> <svg xmlns="http://www.w3.org/2000/svg" width="7" height="11"
                              viewBox="0 0 7 11" fill="none">
                              <path d="M1 1.5L5 5.5L1 9.5" stroke="#FF551E" stroke-width="2" />
                            </svg></a>
                        </div>
                      </div>
                    </div>
                  <?php 
                  }
                }?>
              </div>
            <?php 
            
          }
        }
      ?>
      </div>
    </div>
  </section>

<?php get_footer(); ?>

<!-- Modal -->
<div class="modal fade modal-readmore" id="seeMoreModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-fullscreen-lg-down modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-md-6 order-md-2">
            <div class="profile-image">
              <img src="<?php echo get_template_directory_uri(); ?>/assets/images/icons/b2-transparent.svg" alt="b2-transparent" class="b2-bg">
              <img src="<?php echo get_template_directory_uri(); ?>/assets/images/man.png" alt="man" class="img-fluid position-relative">
              <a href="#" class="social-link" target="_blank">
                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 14 14" fill="none">
                  <path d="M3.08437 13.6574H0.363281V4.88528H3.08437V13.6574ZM1.72236 3.68868C0.852246 3.68868 0.146484 2.96719 0.146484 2.09614C0.146484 1.67774 0.312514 1.27647 0.608049 0.980618C0.903583 0.684764 1.30441 0.518555 1.72236 0.518555C2.14031 0.518555 2.54114 0.684764 2.83668 0.980618C3.13221 1.27647 3.29824 1.67774 3.29824 2.09614C3.29824 2.96719 2.59219 3.68868 1.72236 3.68868ZM13.2686 13.6574H10.5533V9.38721C10.5533 8.36951 10.5328 7.06439 9.13857 7.06439C7.72383 7.06439 7.50703 8.17007 7.50703 9.31389V13.6574H4.78887V4.88528H7.39863V6.08188H7.43672C7.8 5.39266 8.6874 4.66532 10.0113 4.66532C12.7652 4.66532 13.2715 6.48075 13.2715 8.83877V13.6574H13.2686Z" fill="white" />
                </svg> </a>
            </div>
          </div>
          <div class="col-md-6">
            <div class="profile-text">
              <h4>Cristian Jhonson</h4>
              <div class="position">CEO</div>
              <p class="description">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque efficitur purus a tempus tempus. Nam fringilla mollis purus, ut consectetur tortor. Pellentesque lacinia orci diam, at commodo mauris elementum at. Vestibulum sed dolor nunc. Maecenas id luctus augue, ac rutrum diam. Pellentesque luctus velit libero, ut vulputate ex aliquam vel.</p>
              <div class="p-color my-4">Working since 2002</div>
            <ul class="contact contactul">
              <li><a href="tel:+31 (0)24 641 2809"><img src="<?php echo get_template_directory_uri(); ?>/assets/images/icons/whatsup.svg" alt="Call"> +31 (0)24 641
                  2809 </a></li>
              <li><a href="mailto:info@donbosco.nl"><img src="<?php echo get_template_directory_uri(); ?>/assets/images/icons/mail.svg" alt="Email"> info@donbosco.nl</a>
              </li>
            </ul>
            </div>
          </div>
          
        </div>
      </div>
      
    </div>
  </div>
</div>


<script>
  
  $('.profile .bottom a.link-btn').on('click', function(event) {

    event.preventDefault();

    var profileImage  = $(this).closest('.profile').find('.man').attr('src');
    var $socialLinkElement = $(this).closest('.profile').find('.social-link');
    var linkedinUrl = $socialLinkElement.length > 0 ? $socialLinkElement.attr('href') : '';

    var flags         = $(this).closest('.profile').find('.flags li');
    var profileName   = $(this).closest('.profile').find('.profile-name').text();
    var position      = $(this).closest('.profile').find('.position').text();
    var description   = $(this).closest('.profile').find('.full-description').text();
    var workingsince  = $(this).closest('.profile').find('.jobstarts').text();
    var whatsapnumber = $(this).closest('.profile').find('.whatsappnum').text();
    var whatsaphref   = $(this).closest('.profile').find('.whatsappnum').attr('href');
    var email         = $(this).closest('.profile').find('.emailid').text();
    var contacts      = $(this).closest('.profile').find('.contact li');



    // Update modal content with the collected data
    $('.modal-body .profile-image img.img-fluid').attr('src', profileImage);
    $('.modal-body .profile-text h4').text(profileName);
    $('.modal-body .profile-text .position').text(position);
    $('.modal-body .profile-text p').text(description);
    $('.modal-body .contactul').html('');

    var $pColorElement = $('.modal-body .profile-text .p-color');
    if (workingsince.trim() !== '') {
        $pColorElement.text('Working since ' + workingsince);
    } else {
        $pColorElement.text('');
    }

    var $socialLinkElement = $('.modal-body .profile-image a.social-link');
    if (linkedinUrl.trim() !== '') {
        $socialLinkElement.attr('href', linkedinUrl).show();
    } else {
        $socialLinkElement.hide();
    }

    contacts.each(function () {
        var newContact = $(this).clone();
        $('.modal-body .contactul').append(newContact);
    });

  });

  const b2Logo = initializeRive("<?php echo get_template_directory_uri();?>/assets/rive/main-logo.riv", "main-logo", "b2Logo");
  const r8 = initializeRive("<?php echo get_template_directory_uri();?>/assets/rive/logo-b2-white.riv", "logo-b2-white", "r8");
  const r9 = initializeRive("<?php echo get_template_directory_uri();?>/assets/rive/line-white.riv", "line-white", "r9");
  const r10 = initializeRive("<?php echo get_template_directory_uri();?>/assets/rive/smile-white.riv", "smile-rive3", "r10");
  </script>

