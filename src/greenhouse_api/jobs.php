<?php
/*
"CURRENT OPENINGS"
The display of all job posting.

-------------------------------------
HTML ID Prefix: 'romeo'
HTML CLASS Ref: See www.materializecss.com
Dependencies: cURL, Materializecss.com
-------------------------------------

Version: Alpha (0.0.1)
Author: steveberry@romeopower.com
Property of Romeo Systems, Inc.
4380 Ayers Ave, Vernon, CA 90058
© Romeo Systems, Inc. 2019
*/

// VARIABLES
$component_title = "Current Openings"; // The title displayed for this section.
$baseUrl = "https://boards-api.greenhouse.io/v1/boards/";
$boardToken = "romeopower";
$endpoint = "/jobs";
$param_content = "?content=true";

$curl = curl_init(); // Initializes a cURL session
$options = array( // Array of curl options.
  CURLOPT_URL => $baseUrl . $boardToken . $endpoint . $param_content ,
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "GET",
  CURLOPT_POSTFIELDS => "",
  CURLOPT_HTTPHEADER => array(
    "Postman-Token: d66988cc-e715-47fb-9edf-1d1438a6ec13",
    "cache-control: no-cache"
  )
);

curl_setopt_array($curl, $options); // Set multiple options for a cURL transfer
$response = curl_exec($curl); // Perform a cURL session
$err = curl_error($curl); // Return a string containing the last error for the current session
curl_close($curl); // Close a cURL session

if ($err) {
  echo "cURL Error #:" . $err;
} else {

  // RESPONSE
  // The response of the cURL call is a string. The string is then decoded to an array.

  // VARIABLES
  $jobs_response = json_decode($response, TRUE); // The original response decoded to an array
  $jobs = $jobs_response['jobs']; // The array of jobs
  $job_count = count($jobs); // A number. Represents the number of jobs in the array.



  for ($z = 0; $z <= $job_count; $z++) {
    $this_job_post_id = $jobs[$z]["id"];
    $this_job_post_title = $jobs[$z]["title"];
    $this_job_post_location = $jobs[$z]["offices"][$z]["location"];
    $this_job_post_dept_id = $jobs[$z]["departments"][0]["id"];

    // echo "<li><a onclick='r_modal($this_job_post_id)' data-department='$this_job_post_dept_id' href='#'><div class='single_job_title'><span>$this_job_post_title</span><span>$this_job_post_location</span></div></a></li>";

    echo "<a onclick='r_modal($this_job_post_id)' data-department='$this_job_post_dept_id' href='#'><div class='single_job_title'><span>$this_job_post_title</span><span>$this_job_post_location</span></div></a>";
  }

} // [end] 'else'



?>
