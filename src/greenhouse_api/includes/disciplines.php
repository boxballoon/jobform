<?php

/*
Disciplines
https://developers.greenhouse.io/job-board.html#list-disciplines

-------------------------------
GreenHouse API Development
Author: steveberry@romeopower.com
Property of Romeo Systems, Inc. 4380 Ayers Ave, Vernon, CA 90058
© Romeo Systems, Inc. 2019
*/

$disciplines_curl = curl_init();
$disciplines_array = array(
   CURLOPT_URL => "https://boards-api.greenhouse.io/v1/boards/romeopower/education/disciplines",
   CURLOPT_RETURNTRANSFER => true,
   CURLOPT_ENCODING => "",
   CURLOPT_MAXREDIRS => 10,
   CURLOPT_TIMEOUT => 30,
   CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
   CURLOPT_CUSTOMREQUEST => "GET",
   CURLOPT_POSTFIELDS => "",
   CURLOPT_HTTPHEADER => array(
     "Postman-Token: 75ef62d8-8b24-4a82-9e09-26e8c81a0315",
     "cache-control: no-cache"
   ),
 );

curl_setopt_array( $disciplines_curl, $disciplines_array );

$disciplines_response = curl_exec( $disciplines_curl );

$disciplines_err = curl_error( $disciplines_curl );

curl_close( $disciplines_curl );

if ( $disciplines_err ) {
  echo "cURL Error #:" . $disciplines_err;
} else {

  // CONDITIONAL VARIABLES
  $disciplines_decoded = json_decode( $disciplines_response, TRUE); // The original response decoded to an array
  $disciplines = $disciplines_decoded['items']; // The array of degrees
  $disciplines_count = count( $disciplines ) - 1;

  // echo "<br><hr><br>";
  // echo "<label>Disciplines<select name='disciplines'><option value=''>Select A Discipline</option>";

  echo "<label for='disciplines'>Disciplines</label>";
  echo "<select name='educations[0][discipline_id]'><option value=''>Select A Discipline</option>";
  
  //echo $disciplines;
  for ( $z = 0; $z <= $disciplines_count; $z++) {

    $disciplines_id = $disciplines[$z]['id'];
    $disciplines_text = $disciplines[$z]['text'];

    echo "<option id='$disciplines_id' value='$disciplines_id'>$disciplines_text</option>";

  }

  echo "</select>";

}
