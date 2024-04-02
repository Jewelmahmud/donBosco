<?php 


add_action('rest_api_init', 'donbosco_register_custom_route');

function donbosco_register_custom_route() {
    register_rest_route('webhook/v1', '/jobs/', array(
        'methods'  => 'POST',
        'callback' => 'donbosco_handle_custom_request',
    ));
}

function donbosco_handle_custom_request($request) {

    $data = $request->get_params();
    
    $authorizationKey = isset($_SERVER['HTTP_AUTHORIZATION']) ? $_SERVER['HTTP_AUTHORIZATION'] : '';
    $expectedKey = get_field('api_key', 'option');

    // $logFilePath = trailingslashit(get_template_directory()) . '/logs/webhook.log';
    // if (!file_exists($logFilePath)) {
    //     touch($logFilePath);
    //     chmod($logFilePath, 0644);
    // }
    // file_put_contents($logFilePath, date('Y-m-d H:i:s') . " - Event:\n" . print_r($data, true) . "\n", FILE_APPEND);


    if($authorizationKey === $expectedKey){

        $eventType = $data['type'];
        $jobid = $data['job']['id'];

        if($jobid){
            switch ($eventType) {
                case 'publish':
                    publishUpdateHandler($data);
                    break;
                case 'published':
                    publishUpdateHandler($data);
                    break;
                case 'unpublish':
                    handleUnpublishEvent($data);
                    break;            
                case 'update':
                    publishUpdateHandler($data);
                    break;            
                default:
                    error_log("Unsupported event type: $eventType");
                    break;
            }
        }

    } else {

        $response = array(
            'error' => true,
            'message' => 'API key error, provide correct API key!',
        );

        return rest_ensure_response($response)->set_status(500);
    }

}




function publishUpdateHandler($data) {
    $jobBody = '';
    $job = $data['job'];

    
    $jobId = $job['id'];
    $jobTitle = isset($job['title']) ? $job['title'] : '';
    $jobStatus = isset($job['status']) ? ($job['status'] === 'published' ? 'publish' : $job['status']) : '';
    $jobStatusacf = isset($job['status']) ? $job['status'] : '';
    $jobExcerpt = isset($job['summary']) ? $job['summary'] : '';
    $joblang = isset($job['jobLanguageCode']) ? $job['jobLanguageCode'] : 'en';

    if(isset($job['summary'])){
        $jobBody .= $job['summary'];  
    }

    if(isset($job['description'])){
        if($joblang == 'en') $jobBody .= "<h3>Your tasks:</h3>";
        elseif ($joblang == 'nl') $jobBody .= "<h3>Jouw functie:</h3>";
        $jobBody .= $job['description'];  
    }
    
    if(isset($job['qualifications'])){  
        if($joblang == 'en') $jobBody .= "<h3>Requirements:</h3>";
        elseif ($joblang == 'nl') $jobBody .= "<h3>Dit breng je mee:</h3>";
        $jobBody .= $job['qualifications'];   
    }

    if(isset($job['benefits']) && count($job['benefits']) > 0){
        if($joblang == 'en') $jobBody .= "<h3>Benefits:</h3>";
        elseif ($joblang == 'nl') $jobBody .= "<h3>Voordelen:</h3>";   
        $jobBody .= "<ul>";
        foreach($job['benefits'] as $item ) $jobBody .= "<li>".$item."</li>"; 
        $jobBody .= "</ul>";
    }

    if(isset($job['benefitsAdditional'])){ 
        if($joblang == 'en') $jobBody .= "<h3>Aditional Benifts:</h3>";
        elseif ($joblang == 'nl') $jobBody .= "<h3>Aanvullende voordelen:</h3>"; 
        $jobBody .= $job['benefitsAdditional'];   
    }

    if(isset($job['offer'])){ 
        if($joblang == 'en') $jobBody .= "<h3>Our offer:</h3>";
        elseif ($joblang == 'nl') $jobBody .= "<h3>Wij bieden:</h3>"; 
        $jobBody .= $job['offer'];   
    }

    if(isset($job['companyProfile'])){ 
        if($joblang == 'en') $jobBody .= "<h3>Company details:</h3>";
        elseif ($joblang == 'nl') $jobBody .= "<h3>Bedrijfsgegevens:</h3>";   
        $jobBody .= $job['companyProfile'];   
    }

    if(isset($job['applicationProcedure'])){
        if($joblang == 'en') $jobBody .= "<h3>Application Procedure:</h3>";
        elseif ($joblang == 'nl') $jobBody .= "<h3>Interesse?:</h3>";   
        $jobBody .= $job['applicationProcedure'];   
    }

    // Update ACF fields for the job type
    $educationalRequirement = isset($job['educationLevel'])? $job['educationLevel'] : null;
    $hoursPerWeek = isset($job['hoursTo']) ? $job['hoursTo'] : null;
    $accommodation = ($joblang == 'en')? 'Yes' : 'Ja';
    $salary = isset($job['salary']) ? $job['salary'] : null;
    $salaryto = isset($job['salaryTo']) ? $job['salaryTo'] : null;
    $location = isset($job['location']) ? $job['location'] : null;
    $salaryPeriod = isset($job['salaryPeriod']) ? $job['salaryPeriod'] : null;
    $company = isset($job['company']) ? $job['company'] : null;
    $tags = isset($job['tags']) ? $job['tags'] : null;
    $industries = isset($job['industries']) ? $job['industries'] : null;
    $jobtype = isset($job['employment']) ? $job['employment'][0] : null;
    $yearsWorkingExperience = isset($job['yearsWorkingExperience']) ? $job['yearsWorkingExperience'] : null;
    $careerLevel = isset($job['careerLevel']) ? $job['careerLevel'] : null;
    $careerLevel = isset($job['careerLevel']) ? $job['careerLevel'] : null;

    if($salaryPeriod !== 'Per month' && $salaryPeriod !== 'Per year' && $salaryPeriod !== 'Once' ){
        if($salaryto && $salary) $mainsalary = $salary. " - ". $salaryto;
        elseif(empty($salaryto) && $salary) $mainsalary = $salary;
        elseif(empty($salar) && $salaryto) $mainsalary = $salaryto;
    }else {
        $mainsalary = $salary;
    }

    $existing_post = get_posts(array(
        'post_type'      => 'vacancies',
        'meta_key'       => 'reference_no',
        'meta_value'     => $jobId,
        'posts_per_page' => 1,
    ));

    if ($existing_post) {
        
        if($joblang == 'en'){            

            $current_language = apply_filters('wpml_current_language', NULL);            
            do_action('wpml_switch_language', 'en');
        
            $existing_post_id = $existing_post[0]->ID;

            $updated_post = array(
                'ID'           => $existing_post_id,
                'post_title'   => $jobTitle,
                'post_excerpt' => $jobExcerpt,
                'post_content' => $jobBody, 
                'post_status'  => 'publish',
            );
            wp_update_post($updated_post);

            update_field('educational_level', $educationalRequirement, $existing_post_id);
            update_field('hours_per_week', $hoursPerWeek, $existing_post_id);
            update_field('salary_period', $salaryPeriod, $existing_post_id);
            update_field('accommodation', $accommodation, $existing_post_id);

            update_field('hourly_rate', $mainsalary, $existing_post_id);
            update_field('reference_no', $jobId, $existing_post_id);
            update_field('location', $location, $existing_post_id);
            update_field('job_status', $jobStatusacf, $existing_post_id);
            update_field('company_name', $company, $existing_post_id);
            update_field('job_type', $jobtype, $existing_post_id);
            update_field('years_of_experience', $yearsWorkingExperience, $existing_post_id);
            update_field('career_level', $careerLevel, $existing_post_id);

            if (!empty($tags)) {
                $comma_separated_tags = implode(', ', $tags);
                update_field('tags', $comma_separated_tags, $existing_post_id);
            }
            if (!empty($industries)) {
                $term_ids = array();

                // Remove existing job categories
                wp_set_post_terms($existing_post_id, array(), 'job_category');
            
                foreach ($industries as $industry) {
                    $existing_term = term_exists($industry, 'job_category');
            
                    if ($existing_term) {
                        $term_ids[] = $existing_term['term_id'];
                    } else {
                        $result = wp_insert_term($industry, 'job_category');
                        if (!is_wp_error($result)) {
                            $term_ids[] = $result['term_id'];
                        }
                    }
                }
            
                wp_set_post_terms($existing_post_id, $term_ids, 'job_category');
            }else {
                $term_ids[] = 40;
                wp_set_post_terms($existing_post_id, $term_ids, 'job_category');
            }

            do_action('wpml_switch_language', $current_language);


        } elseif ($joblang === 'nl') {

            $current_language = apply_filters('wpml_current_language', NULL);            
            do_action('wpml_switch_language', 'nl');
        
            $existing_post_id = $existing_post[0]->ID;

            $updated_post = array(
                'ID'           => $existing_post_id,
                'post_title'   => $jobTitle,
                'post_excerpt' => $jobExcerpt,
                'post_content' => $jobBody, 
                'post_status'  => 'publish',
            );
            wp_update_post($updated_post);

            update_field('educational_level', $educationalRequirement, $existing_post_id);
            update_field('hours_per_week', $hoursPerWeek, $existing_post_id);
            update_field('salary_period', $salaryPeriod, $existing_post_id);
            update_field('accommodation', $accommodation, $existing_post_id);
            update_field('hourly_rate', $mainsalary, $existing_post_id);
            update_field('reference_no', $jobId, $existing_post_id);
            update_field('location', $location, $existing_post_id);
            update_field('job_status', $jobStatusacf, $existing_post_id);
            update_field('company_name', $company, $existing_post_id);
            update_field('job_type', $jobtype, $existing_post_id);
            update_field('years_of_experience', $yearsWorkingExperience, $existing_post_id);
            update_field('career_level', $careerLevel, $existing_post_id);

            if (!empty($tags)) {
                $comma_separated_tags = implode(', ', $tags);
                update_field('tags', $comma_separated_tags, $existing_post_id);
            }
            if (!empty($industries)) {
                $term_ids = array();

                wp_set_post_terms($existing_post_id, array(), 'job_category');
            
                foreach ($industries as $industry) {
                    $existing_term = term_exists($industry, 'job_category');
            
                    if ($existing_term) {
                        $term_ids[] = $existing_term['term_id'];
                    } else {
                        $result = wp_insert_term($industry, 'job_category');
                        if (!is_wp_error($result)) {
                            $term_ids[] = $result['term_id'];
                        }
                    }
                }
            
                wp_set_post_terms($existing_post_id, $term_ids, 'job_category');
            }else {
                $term_ids[] = 40;
                wp_set_post_terms($existing_post_id, $term_ids, 'job_category');
            }

            do_action('wpml_switch_language', $current_language);
        }
        


    } else {

        if($joblang == 'en'){

            $current_language = apply_filters('wpml_current_language', NULL);            
            do_action('wpml_switch_language', 'en');

            $post_id = wp_insert_post(array(
                'post_title'   => $jobTitle,
                'post_type'    => 'vacancies',
                'post_excerpt' => $jobExcerpt,
                'post_content' => $jobBody,
                'post_status'  => 'publish',
            ));

            // Update ACF fields 
            update_field('educational_requirement', $educationalRequirement, $post_id);
            update_field('hours_per_week', $hoursPerWeek, $post_id);
            update_field('accommodation', $accommodation, $post_id);
            update_field('hourly_rate', $mainsalary, $post_id);
            update_field('reference_no', $jobId, $post_id);
            update_field('location', $location, $post_id);
            update_field('job_status', $jobStatusacf, $post_id);
            update_field('company_name', $company, $post_id);
            update_field('job_type', $jobtype, $post_id);
            update_field('years_of_experience', $yearsWorkingExperience, $post_id);
            update_field('career_level', $careerLevel, $post_id);

            

            if (!empty($tags)) {
                $comma_separated_tags = (count($tags) > 1) ? implode(', ', $tags) : $tags[0];
                update_field('tags', $comma_separated_tags, $post_id);
            }
            if (!empty($industries)) {
                $term_ids = array();
            
                foreach ($industries as $industry) {
                    $existing_term = term_exists($industry, 'job_category');
            
                    if ($existing_term) {
                        $term_ids[] = $existing_term['term_id'];
                    } else {
                        $result = wp_insert_term($industry, 'job_category');
                        if (!is_wp_error($result)) {
                            $term_ids[] = $result['term_id'];
                        }
                    }
                }
            
                wp_set_post_terms($post_id, $term_ids, 'job_category');
            }else {
                $term_ids[] = 40;
                wp_set_post_terms($post_id, $term_ids, 'job_category');
            }

            do_action('wpml_switch_language', $current_language);


        } elseif ($joblang === 'nl') {

            $current_language = apply_filters('wpml_current_language', NULL);

            do_action('wpml_switch_language', 'nl');

            $post_id_nl = wp_insert_post(array(
                'post_title'   => $jobTitle,
                'post_type'    => 'vacancies',
                'post_excerpt' => $jobExcerpt,
                'post_content' => $jobBody,
                'post_status'  => 'publish',
            ));

            // Update ACF fields for the Dutch post
            update_field('hours_per_week', $hoursPerWeek, $post_id_nl);
            update_field('accommodation', $accommodation, $post_id_nl);
            update_field('hourly_rate', $mainsalary, $post_id_nl);
            update_field('reference_no', $jobId, $post_id_nl);
            update_field('location', $location, $post_id_nl);
            update_field('job_status', $jobStatusacf, $post_id_nl);
            update_field('company_name', $company, $post_id_nl);
            update_field('job_type', $jobtype, $post_id_nl);
            update_field('years_of_experience', $yearsWorkingExperience, $post_id_nl);
            update_field('career_level', $careerLevel, $post_id_nl);
            update_field('educational_requirement', $educationalRequirement, $post_id_nl);



            if (!empty($tags)) {
                $comma_separated_tags_nl = (count($tags) > 1) ? implode(', ', $tags) : $tags[0];
                update_field('tags', $comma_separated_tags_nl, $post_id_nl);
            }

            if (!empty($industries)) {
                $term_ids_nl = array();

                foreach ($industries as $industry) {
                    $existing_term_nl = term_exists($industry, 'job_category');

                    if ($existing_term_nl) {
                        $term_ids_nl[] = $existing_term_nl['term_id'];
                    } else {
                        $result_nl = wp_insert_term($industry, 'job_category');
                        if (!is_wp_error($result_nl)) {
                            $term_ids_nl[] = $result_nl['term_id'];
                        }
                    }
                }

                wp_set_post_terms($post_id_nl, $term_ids_nl, 'job_category');
            } else {
                $term_ids_nl[] = 40;
                wp_set_post_terms($post_id_nl, $term_ids_nl, 'job_category');
            }

            do_action('wpml_switch_language', $current_language);
        }
    }

    $response = array(
        'success' => true,
        'message' => 'Job created!',
    );

    return rest_ensure_response($response)->set_status(200);
}


function handleUnpublishEvent($data) {
    $id = $data['job']['id'];

    $existing_post = get_posts(array(
        'post_type'      => 'vacancies',
        'meta_key'       => 'reference_no',
        'meta_value'     => $id,
        'posts_per_page' => 1,
    ));

    if (!empty($existing_post)) {
        $post_id = $existing_post[0]->ID;
        
        $result = wp_delete_post($post_id, true);

        if ($result !== 0) {
            error_log("reference_no: $id");
            $response = array(
                'success' => true,
                'message' => 'Job Deleted!',
            );
            return rest_ensure_response($response)->set_status(200);
        } else {
            error_log("Failed to update post status for reference_no: $id");
        }

    } else {
        error_log("Post not found to delete from API for reference_no: $id");
    }

    $response = array(
        'success' => false,
        'message' => 'Failed to update post status',
    );
    return rest_ensure_response($response)->set_status(500);
}
