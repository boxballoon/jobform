<?php

/*
'APPLY FOR THIS JOB'
Receive the expected expected parameters and submit the application.
-------------------------------------

Version: Alpha (0.0.1)
Author: steveberry@romeopower.com
Property of Romeo Systems, Inc.
4380 Ayers Ave, Vernon, CA 90058
© Romeo Systems, Inc. 2019
*/

// POST REQUEST VARIABLES
$job_id = $_REQUEST['romeo_job_post_id']; // "4220907002"; // The id of the job.
$job_title = $_REQUEST['romeo_job_post_title']; // The name of the job being applied for.
$first_name = $_REQUEST['first_name']; // First Name
$last_name = $_REQUEST['last_name']; // Last Name
$email = $_REQUEST['email']; // Email
$phone = $_REQUEST['phone']; // Phone
$resume = $_FILES['resume']['name']; // Resume
$cover_letter = $_FILES['cover_letter']['name']; // Cover Letter
$question_5532287002 = $_REQUEST['question_5532287002']; // LinkedIn Profile
$question_5532288002 = $_REQUEST['question_5532288002']; // Website
$question_5532289002 = $_REQUEST['question_5532289002']; // How did you hear about this job?
$question_5532290002 = $_REQUEST['question_5532290002']; // What college/university did you attend?
$eeoc_gender = $_REQUEST['gender']; // Select Menu. Gender
$eeoc_race = $_REQUEST['race']; // Select Menu. Race
$eeoc_veteran_status = $_REQUEST['veteran_status']; // Select Menu. Veteran Status
$disability_status = $_REQUEST['disability_status']; // Select Menu. Disability Status

// EDUCATION
$school = $_REQUEST['school']; // ID of the school.
$degree = $_REQUEST['degrees']; // ID of the school.
$discipline = $_REQUEST['disciplines']; // ID of the school.

?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Thank You</title>

    <!-- CSS -->
    <link rel="stylesheet" href="../css/style.css">

  </head>
  <body id="post_thankyou">
    <div id="post_container">
      <div id="post_card">
        <?php
          echo "Thank You <span class='highlight'>$first_name</span> <br> For Submitting Your Application For <br> <span class='highlight'>$job_title</span>"
        ?>
        <hr>





        <?php
        $post_base_url = "https://boards-api.greenhouse.io/v1/boards/romeopower/jobs/";

        /*
        $post_fields = {
          "first_name": $first_name,
          "last_name": $last_name,
          "email": $email,
          "phone": $phone,
          "resume_text": $resume,
          "cover_letter_text": $cover_letter,
          "question_5532287002": $question_5532287002,
          "question_5532288002": $question_5532288002,
          "question_5532289002": $question_5532289002,
          "question_5532290002": $question_5532290002,
          "gender": $eeoc_gender,
          "race": $eeoc_race,
          "veteran_status": $eeoc_veteran_status,
          "disability_status": $disability_status
        };
        */

        $post_fields = "{\n
          \"first_name\": \"$first_name\",\n
          \"last_name\": \"$last_name\",\n
          \"email\": \"$email\",\n
          \"phone\": \"$phone\",\n
          \"resume_text\": \"$resume\",\n
          \"cover_letter_text\": \"$cover_letter\",\n
          \"question_5532287002\": \"$question_5532287002\",\n
          \"question_5532288002\": \"$question_5532288002\",\n
          \"question_5532289002\": \"$question_5532289002\",\n
          \"question_5532290002\": \"$question_5532290002\",\n
          \"gender\": $eeoc_gender,\n
          \"race\": $eeoc_race,\n
          \"veteran_status\": $eeoc_veteran_status,\n
          \"disability_status\": $disability_status  \n
        }";

        $post_curl = curl_init();
        $post_array = array(
          CURLOPT_URL => $post_base_url . $job_id,
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => "",
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 30,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => "POST",
          CURLOPT_POSTFIELDS => $post_fields,
          CURLOPT_HTTPHEADER => array(
            "Authorization: Basic ZjcyZDgyYjRjOTRmYjZkNDFjZTdiZTY1NTE0OTljZGUtMjo=",
            "Content-Type: application/json",
            "Postman-Token: 2dcc7eb5-46ee-4b02-8581-ec3db106317f",
            "cache-control: no-cache"
          ),
        );

        curl_setopt_array( $post_curl, $post_array );

        $post_response = curl_exec($post_curl);
        $post_err = curl_error($post_curl);

        curl_close($post_curl);

        if ($post_err) {
          echo "cURL Error #:" .$post_err;
        } else {
          // echo $post_response;
          // echo "Yes, it worked...";
        }

        ?>













        <hr>
        <ul>
          <li><a href="https://romeopower.com/devjobs/">Go Back To Careers</a></li>
          <li><a href="https://romeopower.com">Go To Romeo Home</a></li>
        </ul>
      </div>

      <?php  include "post_var_dump.php"; ?>

    </div>
  </body>
</html>
