<?php 

// Exit if accessed directly
if( !defined( 'ABSPATH' ) ) {
    die;
}


// Gosila Img Left Text Right -------------------------------------------------------------
function GisolaImageLeft ($attr){

    extract( shortcode_atts( array(
        "img_left_text_right_image" => "",
        "img_left_text_right_title" => "",
        "img_left_text_right_description" => "",
        "img_left_text_right_button_text" => "",
        "img_left_text_right_button_URL" => "",

    ), $attr ) 
    

    );

    ob_start();
?>
<div class="row justify-content-lg-between align-items-lg-center">


<div class="col-md-6">
  <!-- SVG Shape -->
  <figure>
    <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" viewBox="-23 100 860 979.2">

      <defs>
        <path id="mainHeroSVG1" d="M565.5,957.4c81.1-7.4,155.5-49.3,202.4-115.7C840,739.8,857,570,510.7,348.3C-35.5-1.5-4.2,340.3,2.7,389
  c0.7,4.7,1.2,9.5,1.7,14.2l29.3,321c14,154.2,150.6,267.8,304.9,253.8L565.5,957.4z"></path>
      </defs>
      <clipPath id="mainHeroSVG2">
        <use xlink:href="#mainHeroSVG1"></use>
      </clipPath>
      <g transform="matrix(1 0 0 1 0 0)" clip-path="url(#mainHeroSVG2)">
        <?php 

            $leftImage = wp_get_attachment_image_src($img_left_text_right_image,'full');

            if($leftImage){
            ?>
            <image width="600" height="750" xlink:href="<?php echo esc_html($leftImage[0]);?>" transform="matrix(1.4462 0 0 1.4448 0 0)"></image>
            <?php
            }
        
        ?>

      </g>
    </svg>
  </figure>
  <!-- End SVG Shape -->
</div>
<div class="col-lg-5 space-bottom-1 space-lg-2">
  <h2 class="mb-3"><?php echo esc_html($img_left_text_right_title);?></h2>
  <p class="mb-4"><?php echo esc_html($img_left_text_right_description);?></p>
  <a class="btn btn-sm btn-outline-primary btn-pill transition-3d-hover" href="<?php echo esc_html($img_left_text_right_button_URL);?>"><?php echo esc_html($img_left_text_right_button_text);?></a>
</div>
</div>
<?php
    return ob_get_clean();

}
add_shortcode( 'gisola_imgtext', 'GisolaImageLeft' );


// Gosila  Text Left Img Right -------------------------------------------------------------
function GisolaImageRight ($attr){

    extract( shortcode_atts( array(
        "img_right_text_left_image" => "",
        "img_right_text_left_title" => "",
        "img_right_text_left_description" => "",
        "img_right_text_left_button_text" => "",
        "img_right_text_left_button_URL" => "",

    ), $attr ) 
    

    );

    ob_start();
?>
<div class="row justify-content-lg-between align-items-lg-center">


<div class="col-md-6 order-lg-2">
  <!-- SVG Shape -->
  <figure>
    <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" viewBox="-23 100 860 979.2">

      <defs>
        <path id="mainHeroSVG1" d="M565.5,957.4c81.1-7.4,155.5-49.3,202.4-115.7C840,739.8,857,570,510.7,348.3C-35.5-1.5-4.2,340.3,2.7,389
  c0.7,4.7,1.2,9.5,1.7,14.2l29.3,321c14,154.2,150.6,267.8,304.9,253.8L565.5,957.4z"></path>
      </defs>
      <clipPath id="mainHeroSVG2">
        <use xlink:href="#mainHeroSVG1"></use>
      </clipPath>
      <g transform="matrix(1 0 0 1 0 0)" clip-path="url(#mainHeroSVG2)">
        <?php 

            $RightImage = wp_get_attachment_image_src($img_right_text_left_image,'full');

            if($RightImage){
            ?>
            <image width="600" height="750" xlink:href="<?php echo esc_html($RightImage[0]);?>" transform="matrix(1.4462 0 0 1.4448 0 0)"></image>
            <?php
            }
        
        ?>
    
        </g>
    </svg>
  </figure>
  <!-- End SVG Shape -->
</div>
<div class="col-lg-5 space-bottom-1 space-lg-2 order-lg-1">
  <h2 class="mb-3"><?php echo esc_html($img_right_text_left_title);?></h2>
  <p class="mb-4"><?php echo esc_html($img_right_text_left_description);?></p>
  <a class="btn btn-sm btn-outline-primary btn-pill transition-3d-hover" href="<?php echo esc_html($img_right_text_left_button_URL);?>"><?php echo esc_html($img_right_text_left_button_text);?></a>
</div>
</div>
<?php
    return ob_get_clean();

}
add_shortcode( 'gisola_imgtextright', 'GisolaImageRight' );


// Gosila  H2 Title and Text -------------------------------------------------------------
function Gisolah2title ($attr){

    extract( shortcode_atts( array(
        "h2_section_title" => "",
        "h2_section_description" => "",

        ), $attr ) 
    

    );

    ob_start();
?>
<div class="mb-5">
    <h2><?php echo esc_html($h2_section_title);?></h2>
    <p><?php echo esc_html($h2_section_description);?></p>
</div>
<?php
    return ob_get_clean();

}
add_shortcode( 'gisola_h2_title', 'Gisolah2title' );

// Gosila  H3 Title and Text -------------------------------------------------------------
function Gisolah3title ($attr){

    extract( shortcode_atts( array(
        "h3_section_title" => "",
        "h3_section_description" => "",

        ), $attr ) 
    

    );

    ob_start();
?>
<div class="mb-5">
    <h3><?php echo esc_html($h3_section_title);?></h3>
    <p><?php echo esc_html($h3_section_description);?></p>
</div>
<?php
    return ob_get_clean();

}
add_shortcode( 'gisola_h3_title', 'Gisolah3title' );

// Gosila  H4 Title and Text -------------------------------------------------------------
function Gisolah4title ($attr){

    extract( shortcode_atts( array(
        "h4_section_title" => "",
        "h4_section_description" => "",

        ), $attr ) 
    

    );

    ob_start();
?>
<div class="mb-5">
    <h4><?php echo esc_html($h4_section_title);?></h4>
    <p><?php echo esc_html($h4_section_description);?></p>
</div>
<?php
    return ob_get_clean();

}
add_shortcode( 'gisola_h4_title', 'Gisolah4title' );

// Gosila  Item List -------------------------------------------------------------
function GisolaListItem ($attr){

    extract( shortcode_atts( array(
        "item_list_1" => "",

        ), $attr ) 
    

    );

    ob_start();
?>
<div class="media pb-2">
    <span class="icon icon-xs icon-soft-indigo icon-circle mr-3">
        <i class="fas fa-check"></i>
    </span>
    <div class="media-body">
        <p class="text-dark mb-0"><?php echo esc_html($item_list_1);?></p>
    </div>
</div>
<?php
    return ob_get_clean();

}
add_shortcode( 'gisola_item_list', 'GisolaListItem' );

// Gosila  Contact Image Text -------------------------------------------------------------
function GisolaContactImageText ($attr){

    extract( shortcode_atts( array(
        "gosila_contact_title" => "",
        "gosila_contact_description" => "",
        "gosila_contact_button_text" => "",
        "gosila_contact_button_url" => "",
        "gosila_contact_image" => "",

        ), $attr ) 
    

    );

    ob_start();
?>
<div class="container space-top-2 space-bottom-3">
    <div class="row justify-content-lg-between align-items-md-center">
      <div class="col-md-6 order-md-2 mb-11 mb-md-0">
        <div class="position-relative">
          <?php 
                $contatimage = wp_get_attachment_image_src($gosila_contact_image,'full');
                if($contatimage){
                ?>
                <img class="img-fluid rounded" src="<?php echo esc_html($contatimage[0]);?>">
                <?php
                }
            
            ?>
          <!-- SVG Elements -->          
          <figure class="max-w-19rem w-100 position-absolute bottom-0 right-0 z-index-n1 d-none d-md-block">
            <div class="mb-n7 mr-n7">
              <img class="img-fluid" src="<?php echo get_template_directory_uri();?>/assets/svg/components/dots-2.svg" alt="Image Description">
            </div>
          </figure>
          <!-- End SVG Elements -->
        </div>
      </div>
      <div class="col-md-5 order-md-1">
        <h2 class="mb-4"><?php echo esc_html($gosila_contact_title);?></h2>
        <p class="mb-5"><?php echo esc_html($gosila_contact_description);?></p>
        <a class="btn btn-sm btn-wide btn-outline-primary btn-pill transition-3d-hover" href="<?php echo esc_html($gosila_contact_button_url);?>"><?php echo esc_html($gosila_contact_button_text);?></a>
      </div>
    </div>  
</div>

<div class="container">
  <div class="w-lg-65 mx-lg-auto">
    <hr class="my-0">
  </div>
</div>

<?php
    return ob_get_clean();

}
add_shortcode( 'gisola_imagetext_contact', 'GisolaContactImageText' );

// Gosila  Item List -------------------------------------------------------------
function GisolaContactItem ($attr){

    extract( shortcode_atts( array(
        "gosila_contact_info_title" => "",
        "gosila_contact_info_address" => "",
        "gosila_contact_info_telephone_1" => "",
        "gosila_contact_info_telephone_2" => "",
        "gosila_contact_info_email" => "",

        ), $attr ) 
    

    );

    ob_start();
?>
<div class="container space-2">
  
  <div class="row justify-content-md-center">
    <div class="col-12 mb-5 text-center">
      <h3 class="h2"><?php echo esc_html($gosila_contact_info_title);?></h3>
    </div>
    <div class="col-md-4 col-lg-3 mb-9 mb-lg-0">
      <!-- Icon Block -->
      <div class="step-dots text-center px-lg-4">
        <figure class="max-w-10rem mx-auto mb-3">
          <img class="img-fluid" src="<?php echo get_template_directory_uri();?>/assets/svg/icons/icon-8.svg" alt="SVG">
          </figure>
        <h4 class="camptonmedium">Adres</h4>
        <p class="small"><?php echo $gosila_contact_info_address;?></p>
      </div>
      <!-- End Icon Block -->
    </div>

    <div class="col-md-4 col-lg-3 mb-9 mb-lg-0">
      <!-- Icon Block -->
      <div class="step-dots text-center px-lg-4">
        
        <figure class="max-w-10rem mx-auto mb-3">
          <img class="img-fluid" src="<?php echo get_template_directory_uri();?>/assets/svg/icons/icon-16.svg" alt="SVG">
          </figure>
        <h4 class="camptonmedium">Telefoon</h4>
        <p class="small">T. <a href="tel:<?php echo esc_html($gosila_contact_info_telephone_1);?>"><?php echo esc_html($gosila_contact_info_telephone_1);?></a><br>F. <a href="tel:<?php echo esc_html($gosila_contact_info_telephone_2);?>"><?php echo esc_html($gosila_contact_info_telephone_2);?></a> </p>
      </div>
      <!-- End Icon Block -->
    </div>

    <div class="col-md-4 col-lg-3">
      <!-- Icon Block -->
      <div class="text-center px-lg-4">
        
        <figure class="max-w-10rem mx-auto mb-3">
          <img class="img-fluid" src="<?php echo get_template_directory_uri();?>/assets/svg/icons/icon-15.svg" alt="SVG">
          </figure>
        <h4 class="camptonmedium">E-mail</h4>
        <p class="small"><a href="mailto:<?php echo esc_html($gosila_contact_info_email);?>"><?php echo esc_html($gosila_contact_info_email);?></a></p>
      </div>
      <!-- End Icon Block -->
    </div>
  </div>
  

</div>


<?php
    return ob_get_clean();

}
add_shortcode( 'gisola_contact_information', 'GisolaContactItem' );
