<?php 


function getJobs($page = 1, $limit = 10) {
    
    $baseUrl = 'https://api.forceflow.nl';
    $endpoint = '/connect/jobs';
    $url = $baseUrl . $endpoint;
    
    $apikey = get_field('api_key', 'option');
    
    $headers = [
        'Accept'        => 'application/json',
        'authorization' => $apikey,
    ];
    
    $params = [
        'page'  => $page,
        'limit' => $limit,
    ];
    
    $url .= '?' . http_build_query($params);
    
    $response = wp_remote_get($url, array('headers' => $headers));
    
    if (is_wp_error($response)) {
        return 'HTTP request failed: ' . $response->get_error_message();
    } else {
        $body = wp_remote_retrieve_body($response);
        $data = json_decode($body, true);
        
        return $data;
    }
}

function getFilteredJobs($filters = []) {
    
    $baseUrl = 'https://api.forceflow.nl';
    $endpoint = '/connect/jobs';
    $url = $baseUrl . $endpoint;

    $apikey = get_field('api_key', 'option');

    $headers = [
        'Accept'        => 'application/json',
        'authorization' => $apikey,
    ];

    if (!empty($filters)) {
        $url .= '?' . http_build_query($filters);
    }

    $response = wp_remote_get($url, array('headers' => $headers));

    if (is_wp_error($response)) {
        return 'HTTP request failed: ' . $response->get_error_message();
    } else {
        $body = wp_remote_retrieve_body($response);
        $data = json_decode($body, true);

        return $data;
    }
}


function getSingleJob($jobId) {
    
    $baseUrl = 'https://api.forceflow.nl';
    $endpoint = '/connect/jobs/' . $jobId;
    $url = $baseUrl . $endpoint;
    
    $apikey = get_field('api_key', 'option');
    
    $headers = [
        'Accept'        => 'application/json',
        'authorization' => $apikey,
    ];
    
    $response = wp_remote_get($url, array('headers' => $headers));
    
    if (is_wp_error($response)) {
        return 'HTTP request failed: ' . $response->get_error_message();
    } else {
        $body = wp_remote_retrieve_body($response);
        $data = json_decode($body, true);
        
        return $data;
    }
}



function postCandidate($data)
{
    $url = "https://api.forceflow.nl/connect/candidates";
    $expectedKey = get_field('api_key', 'option');
    $headers = [
        "Accept" => "application/json",
        "Authorization" => $expectedKey,
        "Content-Type" => "application/json"
    ];    

    $response = wp_remote_post($url, array(
        'headers'   => $headers,
        'body'      => json_encode($data),
        'method'    => 'POST',
        'multipart' => true,
    ));

    $logFilePath = trailingslashit(get_template_directory()) . '/logs/candidates.log';
    if (!file_exists($logFilePath)) {
        touch($logFilePath);
        chmod($logFilePath, 0644);
    }

    if (is_wp_error($response)) {

        file_put_contents($logFilePath, date('Y-m-d H:i:s') . " - Error:\n" . $response->get_error_message() . "\n", FILE_APPEND);
        return false;

    } else {

        $body = wp_remote_retrieve_body($response);
        if(!isset($body['error'])){
            file_put_contents($logFilePath, date('Y-m-d H:i:s') . " - Success:\n" .$body. "\n", FILE_APPEND);
            return $body;
        }else {
            file_put_contents($logFilePath, date('Y-m-d H:i:s') . " - Error:\n" .$body . "\n", FILE_APPEND);
            return false;
        }

        

    }
}