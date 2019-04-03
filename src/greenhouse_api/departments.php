<?php
// GREENHOUSE API

$dept_curl = curl_init();

curl_setopt_array($dept_curl, array(
  CURLOPT_URL => "https://boards-api.greenhouse.io/v1/boards/romeopower/departments",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "GET",
  CURLOPT_POSTFIELDS => "",
  CURLOPT_HTTPHEADER => array(
    "Postman-Token: 78796495-5856-4ae3-a375-84f69709e165",
    "cache-control: no-cache"
  ),
));

$dept_response = curl_exec($dept_curl);
$dept_err = curl_error($dept_curl);

curl_close($dept_curl);

if ($dept_err) {
  echo "cURL Error #:" . $dept_err;
} else {

  $departments_raw = json_decode( $dept_response, TRUE ); // The original response decoded to an array
  $departments = $departments_raw['departments']; // The array of jobs
  $dept_count = count($departments) - 1; // A number. Represents the number of jobs in the array.

  // echo $dept_count;

  for ( $x = 0; $x <= $dept_count; $x++ ) {
    // echo count( $departments[$x]['jobs'] ) . "<br>";

    $this_job_count = count( $departments[$x]['jobs'] );

    $this_dept_id = $departments[$x]['id'];
    $this_dept_name = $departments[$x]['name'];

    if( $this_job_count > 0 ){
      echo "<li><a href='#' id='$this_dept_id' onclick='r_department($this_dept_id, event)'>$this_dept_name</a></li>";
    }
  }

}
