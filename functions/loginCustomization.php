<?php

// Exit if accessed directly
if( !defined( 'ABSPATH' ) ) {
    die;
}

// Login Customization Function -----------------------------------------------------------------
function CustomLogin() { 

    $logo = get_field('logo', 'option');
    $loginbg = get_field('login_bg', 'option');
    
    ?>
    <style type="text/css">
        .login {
            background-image: url(<?php echo $loginbg['url']; ?>);
            background-attchment: cover;
            background-size: 100%;
        }
        .login h1 {
            text-align: center;
            padding-top: 5px;
            padding-bottom: 0;
            border-radius: 5px;
        }
        #login h1 a, .login h1 a {
                background-image: url(<?php echo $logo['url']; ?>);
                height: 65px;
                width: 320px;
                background-size: 90%;
                background-repeat: no-repeat;
                padding-bottom: 30px;
            }
        .login form {
            margin-top: 20px;
            margin-left: 0;
            padding: 26px 24px 46px;
            font-weight: 400;
            overflow: hidden;
            background: #fff;
            border-radius: 10px;
            border: 1px solid #fff !important;
            box-shadow: 0px 10px 40px 10px rgba(140, 152, 164, 0.175) !important;
        }
        .login form .input {
            display: block!important;
            width: 100%!important;
            height: calc(1.6em + 1.625rem)!important;
            padding: 0.75rem 1rem!important;
            font-size: 1rem!important;
            font-weight: 400!important;
            line-height: 1.6!important;
            color: #1e2022!important;
            background-color: #fff!important;
            background-clip: padding-box!important;
            border: 0.0625rem solid #e7eaf3!important;
            border-radius: 0.3125rem!important;
            transition: 0.15s ease-in-out!important;
        }
        .login .button.wp-hide-pw .dashicons {
            top: .70rem!important;
        }
        input#wp-submit {
            background: transparent;
            color: #585757;
            border-radius: 10px;
            border: 1px solid #ddd;
        }
        .login .button.wp-hide-pw .dashicons {
            color: #002581;
        }  
    </style>
<?php }
add_action( 'login_enqueue_scripts', 'CustomLogin' );