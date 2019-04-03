<?php

/*
Degrees
https://developers.greenhouse.io/job-board.html#list-degrees

-------------------------------
GreenHouse API Development
Author: steveberry@romeopower.com
Property of Romeo Systems, Inc. 4380 Ayers Ave, Vernon, CA 90058
© Romeo Systems, Inc. 2019
*/

$degrees_curl = curl_init();
$degrees_array = array(
  CURLOPT_URL => "https://boards-api.greenhouse.io/v1/boards/romeopower/education/degrees",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "GET",
  CURLOPT_POSTFIELDS => "",
  CURLOPT_HTTPHEADER => array(
    "Postman-Token: abd3c9b9-f597-4b1a-b17a-e72175c52ede",
    "cache-control: no-cache"
  ),
);

curl_setopt_array( $degrees_curl, $degrees_array );

$degrees_response = curl_exec( $degrees_curl );

$degrees_err = curl_error( $degrees_curl );

curl_close( $degrees_curl );

if ( $degrees_err ) {
  echo "cURL Error #:" . $degrees_err;
} else {

  // CONDITIONAL VARIABLES
  $degrees_decoded = json_decode( $degrees_response, TRUE); // The original response decoded to an array
  $degrees = $degrees_decoded['items']; // The array of degrees
  $degrees_count = count( $degrees ) - 1;

  // echo "<br><hr><br>";
  // echo "<label>Degrees<select name='degrees'><option></option>";

  echo "<label for='degrees'>Degrees</label>";
  echo "<select name='degrees' required><option value=''>Select A Degree</option>";

  //echo $degrees;
  for ( $z = 0; $z <= $degrees_count; $z++ ) {

    $degrees_id = $degrees[$z]['id'];
    $degrees_text = $degrees[$z]['text'];

    echo "<option id='$degrees_id' value='$degrees_id'>$degrees_text</option>";

  }

  echo "</select></label>";
}
