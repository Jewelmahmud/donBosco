<?php 

// Exit if accessed directly
if( !defined( 'ABSPATH' ) ) {
    die;
}



function GisolaIntegrateWithVC() {

// Image Left section --------------------------------------------------------------------------------
    vc_map( array(
        "name"          => __( "Img Left Text Right", "b2works" ),
        "description"   => __("Img and Text section", "b2works" ),
        "base"          => "gisola_imgtext",
        "class"         => "",
        "category"      => __( "Gisola Elements", "b2works"),
        "icon"          => get_template_directory_uri()."/assets/img/vcicons/gisola.png",
        "params"        => array(
            array(
                "type" => "attach_image",
                "heading" => __( "Image", "b2works" ),
                "param_name" => "img_left_text_right_image",
            ),
            array(
                "type" => "textfield",
                "heading" => __( "Title", "b2works" ),
                "param_name" => "img_left_text_right_title",
            ),
            array(
                "type" => "textarea",
                "heading" => __( "Description", "b2works" ),
                "param_name" => "img_left_text_right_description",
            ),
            array(
                "type" => "textfield",
                "heading" => __( "Button Text", "b2works" ),
                "param_name" => "img_left_text_right_button_text",
            ),
            array(
                "type" => "textfield",
                "heading" => __( "Button URL", "b2works" ),
                "param_name" => "img_left_text_right_button_URL",
            ),
        )
    ) );

// Image right section --------------------------------------------------------------------------------
vc_map( array(
    "name"          => __( "Text Left Image Right", "b2works" ),
    "description"   => __("Img and Text section", "b2works" ),
    "base"          => "gisola_imgtextright",
    "class"         => "",
    "category"      => __( "Gisola Elements", "b2works"),
    "icon"          => get_template_directory_uri()."/assets/img/vcicons/gisola.png",
    "params"        => array(
        array(
            "type" => "attach_image",
            "heading" => __( "Image", "b2works" ),
            "param_name" => "img_right_text_left_image",
        ),
        array(
            "type" => "textfield",
            "heading" => __( "Title", "b2works" ),
            "param_name" => "img_right_text_left_title",
        ),
        array(
            "type" => "textarea",
            "heading" => __( "Description", "b2works" ),
            "param_name" => "img_right_text_left_description",
        ),
        array(
            "type" => "textfield",
            "heading" => __( "Button Text", "b2works" ),
            "param_name" => "img_right_text_left_button_text",
        ),
        array(
            "type" => "textfield",
            "heading" => __( "Button URL", "b2works" ),
            "param_name" => "img_right_text_left_button_URL",
        ),
    )
) );

// H2 Title and Text section --------------------------------------------------------------------------------
vc_map( array(
    "name"          => __( "H2 Title and Text", "b2works" ),
    "description"   => __("H2 Title and Text section", "b2works" ),
    "base"          => "gisola_h2_title",
    "class"         => "",
    "category"      => __( "Gisola Elements", "b2works"),
    "icon"          => get_template_directory_uri()."/assets/img/vcicons/gisola.png",
    "params"        => array(
        array(
            "type" => "textfield",
            "heading" => __( "H2 Title", "b2works" ),
            "param_name" => "h2_section_title",
        ),
        array(
            "type" => "textarea",
            "heading" => __( "Description", "b2works" ),
            "param_name" => "h2_section_description",
        )
    )
) );

// H3 Title and Text section --------------------------------------------------------------------------------
vc_map( array(
    "name"          => __( "H3 Title and Text", "b2works" ),
    "description"   => __("H3 Title and Text section", "b2works" ),
    "base"          => "gisola_h3_title",
    "class"         => "",
    "category"      => __( "Gisola Elements", "b2works"),
    "icon"          => get_template_directory_uri()."/assets/img/vcicons/gisola.png",
    "params"        => array(
        array(
            "type" => "textfield",
            "heading" => __( "H3 Title", "b2works" ),
            "param_name" => "h3_section_title",
        ),
        array(
            "type" => "textarea",
            "heading" => __( "Description", "b2works" ),
            "param_name" => "h3_section_description",
        )
    )
) );

// H4 Title and Text section --------------------------------------------------------------------------------
vc_map( array(
    "name"          => __( "H4 Title and Text", "b2works" ),
    "description"   => __("H3 Title and Text section", "b2works" ),
    "base"          => "gisola_h4_title",
    "class"         => "",
    "category"      => __( "Gisola Elements", "b2works"),
    "icon"          => get_template_directory_uri()."/assets/img/vcicons/gisola.png",
    "params"        => array(
        array(
            "type" => "textfield",
            "heading" => __( "H4 Title", "b2works" ),
            "param_name" => "h4_section_title",
        ),
        array(
            "type" => "textarea",
            "heading" => __( "Description", "b2works" ),
            "param_name" => "h4_section_description",
        )
    )
) );

// H4 Title and Text section --------------------------------------------------------------------------------
vc_map( array(
    "name"          => __( "Item List", "b2works" ),
    "description"   => __("Item List section", "b2works" ),
    "base"          => "gisola_item_list",
    "class"         => "",
    "category"      => __( "Gisola Elements", "b2works"),
    "icon"          => get_template_directory_uri()."/assets/img/vcicons/gisola.png",
    "params"        => array(
        array(
            "type" => "textfield",
            "heading" => __( "List Item", "b2works" ),
            "param_name" => "item_list_1",
        )
    )
) );

// Image and Text Section of Contact Page --------------------------------------------------------------------------------
vc_map( array(
    "name"          => __( "Image and Text of Contact Page", "b2works" ),
    "description"   => __("Contact Image text button", "b2works" ),
    "base"          => "gisola_imagetext_contact",
    "class"         => "",
    "category"      => __( "Gisola Elements", "b2works"),
    "icon"          => get_template_directory_uri()."/assets/img/vcicons/gisola.png",
    "params"        => array(
        array(
            "type" => "textfield",
            "heading" => __( "Title", "b2works" ),
            "param_name" => "gosila_contact_title",
        ),
        array(
            "type" => "textarea",
            "heading" => __( "Description", "b2works" ),
            "param_name" => "gosila_contact_description",
        ),
        array(
            "type" => "textfield",
            "heading" => __( "Button Text", "b2works" ),
            "param_name" => "gosila_contact_button_text",
        ),
        array(
            "type" => "textfield",
            "heading" => __( "Button URL", "b2works" ),
            "param_name" => "gosila_contact_button_url",
        ),
        
        array(
            "type" => "attach_image",
            "heading" => __( "Image", "b2works" ),
            "param_name" => "gosila_contact_image",
        ),
    )
) );


// Contact Information --------------------------------------------------------------------------------
vc_map( array(
    "name"          => __( "Contact Info", "b2works" ),
    "description"   => __("Contact Information", "b2works" ),
    "base"          => "gisola_contact_information",
    "class"         => "",
    "category"      => __( "Gisola Elements", "b2works"),
    "icon"          => get_template_directory_uri()."/assets/img/vcicons/gisola.png",
    "params"        => array(
        array(
            "type" => "textfield",
            "heading" => __( "Contact Section Title", "b2works" ),
            "param_name" => "gosila_contact_info_title",
        ),
        array(
            "type" => "textarea",
            "heading" => __( "Address", "b2works" ),
            "param_name" => "gosila_contact_info_address",
        ),
        array(
            "type" => "textfield",
            "heading" => __( "Telephone T", "b2works" ),
            "param_name" => "gosila_contact_info_telephone_1",
        ),
        array(
            "type" => "textfield",
            "heading" => __( "Telephone F", "b2works" ),
            "param_name" => "gosila_contact_info_telephone_2",
        ),
        array(
            "type" => "textfield",
            "heading" => __( "Email", "b2works" ),
            "param_name" => "gosila_contact_info_email",
        ),
        
    )
) );


}
add_action( 'vc_before_init', 'GisolaIntegrateWithVC' );
