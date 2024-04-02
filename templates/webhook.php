<?php
/**
 * Template Name: Webhook
 */


// Retrieve the raw POST data
$rawData = file_get_contents("php://input");
$jsonData = json_decode($rawData, true);

$logFilePath = trailingslashit(get_template_directory()) . 'webhoo_log.log';
if (!file_exists($logFilePath)) {
    touch($logFilePath);
    chmod($logFilePath, 0644);
}

file_put_contents($logFilePath, date('Y-m-d H:i:s') . " - Publish event:\n" . print_r($jsonData, true) . "\n\n", FILE_APPEND);


if ($_SERVER['REQUEST_METHOD'] !== 'POST') {

    $response = array(
        'success' => false,
        'message' => 'Invalid request method. Only POST requests are allowed.',
    );

    echo json_encode($response);
    // Move the die() here, after echoing the error message
    die();
}

// Continue with the rest of your code...

// Process the data as needed
if($jsonData) {
    $authorizationKey = $_SERVER['HTTP_AUTHORIZATION'];
    $expectedKey = get_field('api_key', 'option');

    if($authorizationKey === $expectedKey){

        $eventType = $jsonData['type'];

        switch ($eventType) {
            case 'publish':
                header('Content-Type: application/json');
                echo json_encode(handlePublishEvent($jsonData));
                break;
        
            case 'unpublish':
                header('Content-Type: application/json');
                echo json_encode(handleUnpublishEvent($jsonData));
                break;
        
            case 'update':
                header('Content-Type: application/json');
                echo json_encode(handleUpdateEvent($jsonData));
                break;
        
            default:
                error_log("Unsupported event type: $eventType");
                break;
        }

    } else {

        $response = array(
                'success' => false,
                'message' => 'Opps you need an API key to access!',
        );
        
        echo json_encode($response);
        die();
    }

} else {
    // Handle the case where no valid JSON data is received
    $response = array(
        'success' => false,
        'message' => 'No data in the request!',
    );
    header('Content-Type: application/json');
    echo json_encode($response);
    die();
}

