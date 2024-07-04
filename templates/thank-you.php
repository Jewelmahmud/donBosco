<?php 
// template name: Thank you
$amount = get_option('mollie_amount');
$logo = get_field('logo', 'option');
$favicon = get_field('favicon', 'option');
$site_title = get_bloginfo('name');

if ( $amount ) {
    $title = "Bedankt voor het doneren van €$amount aan een goed doel.";
    send_donation_notification($amount);
    delete_option('mollie_amount');
} else {
    $title = "Bedankt voor uw donatie.";
}
?>

<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" type="image/jpg" href="<?php echo $favicon; ?>"/>  <meta charset="utf-8">
    <title><?= $title; ?></title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            line-height: 1.6;
            margin: 0;
            padding: 0;
            background: url(<?php echo get_template_directory_uri(); ?>/assets/images/donbosco.webp) no-repeat;
            background-size: cover;
            background-attachment: fixed;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            padding: 80px;
            border-radius: 8px;
            background-color: #f9f9f9c2;
            position: relative;
            z-index: 2;
        }
        .overlay {
            position: fixed;
            z-index: 0;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: #00000078;
        }
        
        h1, h2 {
            color: #333;
        }
        p {
            margin: 10px 0;
        }
        .header-top {
            display: flex;
            align-items: center;
            justify-content: space-between;
        }
        .back-link a {
            text-decoration: none;
            padding: 10px 30px;
            background: #e60523;
            color: #fff;
            border-radius: 2px;
        }
        .signature {
            margin-top: 30px;
        }
        @media (max-width: 767px) {
            .header-top {
                align-items: flex-start;
                flex-direction: column;
                gap: 15px;
            }
            .header-top > div {
                width: 100%;
            }
            .header-top > div a {
                width: 100%;
                display: block;
                padding: 5px 0px;
                text-align: center;
            }
            .container {
                max-width: 95%;
                padding: 45px;
            }
        }
    </style>
</head>
<body>
    <div class="overlay"></div>
    <div class="container">
        <div class="header-top">
            <div class="main-logo">
                <a href="<?php echo site_url('/'); ?>" class="logo">
                    <img class="mainlogo" src="<?php echo $logo['url']; ?>" alt="<?php echo $logo['alt']; ?>" />
                </a>
            </div>
            <div class="back-link">
                <a href="<?php echo site_url('/'); ?>">Ga home</a>
            </div>
        </div> <!-- Closing tag fixed here -->
        <h2><?php echo $title; ?></h2>
        <p>Beste Donor,</p>
        <p>Hartelijk dank uit de grond van ons hart voor uw genereuze bijdrage aan <?php echo $site_title; ?>. Uw steun betekent de wereld voor ons en voor degenen die wij dienen.</p>
        <p>Uw donatie zal een significante impact hebben door [kort beschrijven hoe de donatie zal worden gebruikt, bijvoorbeeld "het voorzien van maaltijden voor gezinnen in nood," "het ondersteunen van educatieve programma's," "het financieren van essentieel medisch onderzoek," enz.]. Dankzij uw vriendelijkheid en vrijgevigheid zijn we een stap dichter bij het bereiken van onze missie van [de missie van uw organisatie].</p>
        <p>We zijn enorm dankbaar voor uw steun en uw vertrouwen in onze zaak. Uw donatie is meer dan alleen een gift; het is een investering in een betere toekomst voor degenen die het nodig hebben.</p>
        <p>Dank u voor het maken van een verschil en het zijn van een gewaardeerd lid van onze gemeenschap. Samen kunnen we hoop en positieve verandering blijven brengen in het leven van velen.</p>
        <div class="signature">
            <p>Met hartelijke dank,</p>
            <p>[Uw Naam]<br>
            [Uw Functie]<br>
            [Naam van uw organisatie]<br>
            [Contactinformatie]</p>
        </div>
    </div>
</body>
</html>
