<?php

// 'FORM'
// Create the form dynamically from api
// https://boards-api.greenhouse.io/v1/boards/romeopower/jobs/4236183002?questions=true

// GLOBAL VARIABLES
$job_base_url = "https://boards-api.greenhouse.io/v1/boards/romeopower/jobs/";
$job_id = "4236183002";
$job_end_url = "?questions=true";
$job_url = $job_base_url . $job_id . $job_end_url;

$job_curl = curl_init();
$job_curl_array = array(
  CURLOPT_URL => $job_url,
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "GET",
  CURLOPT_POSTFIELDS => "",
  CURLOPT_HTTPHEADER => array(
    "Postman-Token: f2968f66-0fc4-4c91-8557-6dd63193e053",
    "cache-control: no-cache"
  ),
);

curl_setopt_array( $job_curl, $job_curl_array );

$job_response = curl_exec( $job_curl );
$job_err = curl_error( $job_curl );

curl_close( $job_curl );

if ( $job_err ) {
  echo "cURL Error #:" . $job_err;
} else {

  // CONDITIONAL VARIABLES
  $job_decoded = json_decode( $job_response, TRUE); // The original response decoded to an array
  $questions = $job_decoded['questions']; // The array of jobs
  $questions_count = count( $questions ) - 1;
  $compliance = $job_decoded['compliance']; // The array of jobs
  $compliance_count = count( $compliance ) - 1;

  // DEMO

  /*
  FORM: Part 1
   - First Name, Last Name, Email, Phone, Location(City), Resume/CV, Cover Letter
   - LinkedIn Profile, Website, How did you hear about this job?, What college/university did you attend?
  */
  for ( $z = 0; $z <= $questions_count; $z++) {

      $question_label = $questions[$z]['label'];
      $question_name = $questions[$z]['fields'][0]['name'];
      $question_type = substr( $questions[$z]['fields'][0]['type'] , 6 );

      // echo "<label>$question_label <br><input type='$question_type' name='$question_name' /></label><br>";

      echo "<label for='$question_name'>$question_label</label>";
      echo "<input id='$question_name' type='$question_type' name='$question_name' required>";

  }


  /*
  FORM: EDUCATION
  School, Degree, Discipline, Start Date, End Date
  */
  include "education.php";

  /*
    FORM: Compliance

    [0] U.S. Equal Opportunity Employment Information (Completion is voluntary)
    [1] Race & Ethnicity Definitions
    [2] Voluntary Self-Identification of Disability
    [3] Reasonable Accommodation Notice
  */

  // LEVEL 1
  for ( $y = 0; $y <= $compliance_count; $y++ ) {

    $equal_opp_descrip = html_entity_decode( $compliance[$y]['description'] ); // The description HTML of the compliance.
    $equal_opp_question = $compliance[$y]['questions']; // An array of questions for this compliance.

    echo "<div class='equal_opp_descrip' style='padding: 10px; margin: 25px 0;'>$equal_opp_descrip</div>"; // Compliance Description

    // If the 'questions' property is NOT 'NULL'. ..
    if( !$equal_opp_question == NULL ){

      $equal_opp_question_count = count( $equal_opp_question ) - 1; // Number. The number of questions for this compliance.

      // LEVEL 2 - For every 'questions' create a select menu.
      for ( $x = 0; $x <= $equal_opp_question_count; $x++ ) {

        $equal_opp_label = $compliance[$y]['questions'][$x]['label'];
        $equal_opp_field_name = $compliance[$y]['questions'][$x]['fields'][0]['name'];
        $equal_opp_value_count = count( $compliance[$y]['questions'][$x]['fields'][0]['values'] ) - 1;

        // echo "<label>$equal_opp_label <br><select name='' required><option>Select An Option</option>";

        echo "<label for='$equal_opp_field_name'>$equal_opp_label</label>";
        echo "<select id='$equal_opp_field_name' name='$equal_opp_field_name' required><option value=''>Select An Option</option>";

        for ( $w = 0; $w <= $equal_opp_value_count; $w++ ) {

          // LEVEL 3
          $equal_opp_value_label = $compliance[$y]['questions'][$x]['fields'][0]['values'][$w]['label'];
          $equal_opp_value_value = $compliance[$y]['questions'][$x]['fields'][0]['values'][$w]['value'];

          echo "<option value='$equal_opp_value_value'>$equal_opp_value_label</option>";
        }

        echo "</select><br>"; // End select menu (level 2)

      }


    } // [end] 'if the questions property...'

  } // [end] Level 1

} // [end] conditional

























/*
FORM: Part 5
Race & Ethnicity Definitions
*/
// echo "<a target='_blank' href='https://boards-use1-cdn.greenhouse.io/docs/RaceEthnicityDefinitions.pdf'>Race &amp; Ethnicity Definitions</a>";
// echo html_entity_decode( $compliance[1]['description'] ) . "<br>"; // Description
// echo $compliance[1]['questions'][0]['label'] . "<br>"; // Veteran Status

/*
FORM: Part 6
Voluntary Self-Identification of Disability
*/
// echo html_entity_decode( $compliance[2]['description'] ) . "<br>"; // Description
// echo $compliance[2]['questions'][0]['label'] . "<br>"; // Disability Status

/*
FORM: Part 7
Reasonable Accommodation Notice
*/
// echo html_entity_decode( $compliance[3]['description'] ) . "<br>"; // Description
