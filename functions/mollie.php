<?php 

function donation_form_shortcode() {
    ob_start();
    ?>
    <div class="donation my-4">
        <h2>Steun ons door te doneren</h2>
        <form id="donationForm" class="p-4">
            <?php generate_donation_frequency_options(); ?>
            <?php generate_donation_amount_options(); ?>
            <?php // generate_payment_method_tabs(); ?>
            <!-- <div id="idealInfo" class="mt-4 pay-section" style="display: block;">
                <?php // generate_ideal_information_fields(); ?>
            </div>
            <div id="paypalInfo" class="mt-4 pay-section" style="display: none;">
                <?php // generate_paypal_information_fields(); ?>
            </div>
            <div id="bankInfo" class="mt-4 pay-section" style="display: none;">
                <?php // generate_bank_information_fields(); ?>
            </div> -->
            <input type="radio" name="method" value="ideal" checked="" hidden="">
            
            <button type="button" class="btn btn-primary mt-3" id="donationSubmit">
                <div class="loading-animation">
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/images/loading.svg" alt="loading">
                </div>
                <div class="btntexts">Doneer</div>
            </button>
        </form>
    </div>
    <?php
    return ob_get_clean();
}
add_shortcode('donation_form', 'donation_form_shortcode');

function generate_donation_amount_options() {
    ?>
    <div class="mb-3 donation-amount">
        <label class="form-label">Kies een bedrag</label><br>
        <div class="d-flex flex-wrap">
            <div class="form-check mx-3">
                <input class="form-check-input" type="radio" name="amount" value="5" id="amount5">
                <label class="form-check-label" for="amount5">€5</label>
            </div>
            <div class="form-check mx-3">
                <input class="form-check-input" type="radio" name="amount" value="10" id="amount10">
                <label class="form-check-label" for="amount10">€10</label>
            </div>
            <div class="form-check mx-3 active">
                <input class="form-check-input" type="radio" name="amount" value="20" id="amount20" checked>
                <label class="form-check-label" for="amount20">€20</label>
            </div>
            <div class="form-check mx-3">
                <input class="form-check-input" type="radio" name="amount" value="50" id="amount50">
                <label class="form-check-label" for="amount50">€50</label>
            </div>
            <div class="form-check mx-3 other-amount">
                <input class="form-check-input" type="radio" name="amount" value="custom" id="amountCustom">
                <label class="form-check-label" for="amountCustom">Ander bedrag</label>
            </div>
            
        </div>
        <div class="custom-amount mt-4">
            <div class="euro-sign">€</div>
            <div class="form-floating mb-3">
                <input type="number" class="form-control" placeholder="Ander bedrag" id="custom_amount" name="custom_amount" min="0">
                <label for="custom_amount" name="custom_amount">Ander bedrag</label>
            </div>
        </div>
    </div>
    <?php
}

function generate_donation_frequency_options() {
    ?>
    <div class="mb-3 frequency">
        <label class="form-label">Frequentie</label><br>
        <div class="d-flex flex-wrap">
            <div class="form-check mx-3 active">
                <input class="form-check-input" type="radio" name="frequency" value="one_time" id="one_time" checked>
                <label class="form-check-label" for="one_time">Een keer</label>
            </div>
            <div class="form-check mx-3">
                <input class="form-check-input" type="radio" name="frequency" value="monthly" id="monthly">
                <label class="form-check-label" for="monthly">Maandelijks</label>
            </div>
        </div>
    </div>
    <?php
}

function generate_payment_method_tabs() {
    ?>
    <div class="mb-3 payment-methods">
        <label class="form-label">Betalingsmiddel</label><br>
        <ul class="nav nav-tabs" id="paymentMethodTab" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active" id="ideal-tab" data-bs-toggle="tab" data-bs-target="#ideal" type="button" role="tab" aria-controls="ideal" aria-selected="false">
                    <input type="radio" name="method" value="ideal" checked hidden> iDeal
                </button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="paypal-tab" data-bs-toggle="tab" data-bs-target="#paypal" type="button" role="tab" aria-controls="paypal" aria-selected="true">
                    <input type="radio" name="method" value="paypal" hidden> PayPal
                </button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="bank-tab" data-bs-toggle="tab" data-bs-target="#bank" type="button" role="tab" aria-controls="bank" aria-selected="false">
                    <input type="radio" name="method" value="bank" hidden> Overschrijving
                </button>
            </li>
            
        </ul>
    </div>
    <?php
}

function generate_paypal_information_fields() {
    ?>
    <div class="form-floating mb-3">
        <input type="text" class="form-control" placeholder="PayPal Email" id="paypal_email" name="paypal_email" required>
        <label for="paypal_email" name="paypal_email">Paypal E-mail</label>
    </div>
    
    <?php
}

function generate_bank_information_fields() {
    ?>
    <div class="form-floating mb-3">
        <input type="text" class="form-control" placeholder="Banknaam" id="bank_name" name="bank_name" required>
        <label for="bank_name" name="bank_name">Banknaam</label>
    </div>
    <div class="form-floating mb-3">
        <input type="text" class="form-control" placeholder="Naam begunstigde" id="bank_customer" name="bank_customer" required>
        <label for="bank_customer" name="bank_customer">Naam begunstigde</label>
    </div>
    <div class="form-floating mb-3">
        <input type="text" class="form-control" placeholder="IBAN" id="bank_account" name="bank_account" required>
        <label for="bank_account" name="bank_account">IBAN</label>
    </div>
    <div class="form-floating mb-3">
        <input type="text" class="form-control" placeholder="BIC" id="bank_bic" name="bank_bic" required>
        <label for="bank_bic" name="bank_bic">BIC</label>
    </div> 
    <?php
}

function generate_ideal_information_fields() {
    ?>
    <div class="form-floating mb-3">
        <input type="text" class="form-control" placeholder="iDeal Account" id="ideal_account" name="ideal_account" required>
        <label for="ideal_account" name="ideal_account">iDeal</label>
    </div> 
    <?php
}





function process_donation_ajax() {
    // Validate the incoming data
    if (!isset($_POST['amount']) || !isset($_POST['frequency']) || !isset($_POST['method'])) {
        wp_send_json_error('Ongeldige donatiegegevens');
        wp_die();
    }

    $amount = $_POST['amount'];
    if ($amount === 'custom') {
        if (!isset($_POST['custom_amount']) || !is_numeric($_POST['custom_amount'])) {
            wp_send_json_error('Ongeldig aangepast bedrag');
            wp_die();
        }
        $amount = $_POST['custom_amount'];
    }
    $amount = (int) preg_replace('/[^0-9]/', '', $amount);

    
    
    // Set up Mollie API client
    $mollie = new \Mollie\Api\MollieApiClient();
    $mollie->setApiKey(get_field('mollie_api_key', 'option'));

    $method = $_POST['method'];
    $paymentMethod = '';

    if ($method === 'paypal') {
        if (!isset($_POST['paypal_email'])) {
            wp_send_json_error('PayPal-e-mailadres is vereist');
            wp_die();
        }
        $paymentMethod = 'paypal';
    } elseif ($method === 'bank') {
        if (!isset($_POST['bank_customer']) || !isset($_POST['bank_name']) || !isset($_POST['bank_iban']) || !isset($_POST['bank_bic'])) {
            wp_send_json_error('Bankgegevens zijn vereist');
            wp_die();
        }
        $paymentMethod = 'banktransfer';
    } elseif ($method === 'ideal') {
        // if (!isset($_POST['ideal_account'])) {
        //     wp_send_json_error('iDeal account is required');
        //     wp_die();
        // }
        $paymentMethod = 'ideal';
    } else {
        wp_send_json_error('Ongeldige betaalmethode');
        wp_die();
    }
    
    try {
        // Create a payment with Mollie
        $payment = $mollie->payments->create([
            'amount' => [
                'currency' => 'EUR',
                'value' => number_format((float)$amount, 2, '.', ''),
            ],
            'method' => $paymentMethod,
            'description' => 'Donation',
            'redirectUrl' => home_url('/thank-you/'),
            'webhookUrl' => home_url('/wp-json/mollie/v1/webhook'),
            'metadata' => [
                'frequency' => $_POST['frequency'],
                'method' => $method,
            ],
        ]);

        update_option('mollie_amount', number_format((float)$amount, 2, '.', ''));

        // Return the payment URL for the user to complete the payment
        wp_send_json_success(['paymentUrl' => $payment->getCheckoutUrl()]);
        wp_die();
    } catch (\Mollie\Api\Exceptions\ApiException $e) {
        wp_send_json_error('Betaling mislukt: ' . htmlspecialchars($e->getMessage()));
    }
}

add_action('wp_ajax_process_donation_ajax', 'process_donation_ajax');
add_action('wp_ajax_nopriv_process_donation_ajax', 'process_donation_ajax');


function mollie_webhook_handler(WP_REST_Request $request) {
    $body = $request->get_body();
    $data = json_decode($body, true);

    if (isset($data['id'])) {
        $paymentId = sanitize_text_field($data['id']);

       
        $mollie = new \Mollie\Api\MollieApiClient();
        $mollie->setApiKey(get_field('mollie_api_key', 'option'));

        try {
            $payment = $mollie->payments->get($paymentId);

            if ($payment->isPaid()) {
                // Payment is successful
                // Update your database and order status
            } elseif ($payment->isOpen()) {
                // Payment is open/pending
            } elseif ($payment->isCanceled()) {
                // Payment is canceled
            } elseif ($payment->isFailed()) {
                // Payment has failed
            }

            return new WP_REST_Response('Webhook handled', 200);
        } catch (Exception $e) {
            return new WP_Error('mollie_error', 'Error retrieving payment', array('status' => 500));
        }
    }

    return new WP_Error('mollie_error', 'Invalid data', array('status' => 400));
}

function send_donation_notification($amount) {
    
    $admins = get_users(array('role' => 'administrator'));
    $site_url = get_bloginfo('url');
    $parsed_url = parse_url($site_url);
    $domain = $parsed_url['host'];    
    $subject = 'Nieuwe Donatie Ontvangen';

    $message = "
        <html>
        <head>
            <title>€$amount Nieuwe Donatie Ontvangen</title>
        </head>
        <body>
            <h1>Nieuwe Donatie Ontvangen</h1>
            <p>Beste Admin,</p>
            <p>Er is zojuist een nieuwe donatie ontvangen van €$amount.</p>
            <p>Met vriendelijke groet,<br>[Uw Organisatienaam]</p>
        </body>
        </html>
    ";
    

    $headers = array('Content-Type: text/html; charset=UTF-8');
    $headers[] = 'From: no-reply@'.$domain;

    foreach ($admins as $admin) {
        wp_mail($admin->user_email, $subject, $message, $headers);
    }
}