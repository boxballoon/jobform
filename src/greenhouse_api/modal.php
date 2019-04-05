<?php
/*
-------------------------------------

Version: Alpha (0.0.1)
Author: steveberry@romeopower.com
Property of Romeo Systems, Inc.
4380 Ayers Ave, Vernon, CA 90058
© Romeo Systems, Inc. 2019
*/

?>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js" type="text/javascript"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/parsley.js/2.8.2/parsley.min.js" type="text/javascript"></script>
<div id="romeo_job_modal">
  <div class="container">
    <header>
      <a id="romeo_close_modal" onclick="r_close_modal()" href="#">
        <i class="material-icons">chevron_left</i>
        <span>Back To Jobs</span>
      </a>

      <img id="" src="https://romeopower.com/whitetail/uploads/2019/02/bolt-neg-100.svg" alt="Romeo Power Systems">
    </header>
  </div>

  <div id="romeo_job_body">
    <div id="romeo_job_title" class="container"></div>
    <div class="container">
      <div class="row">
        <div id="romeo_job_content" class="col s12 m10">
          <!-- [begin] preloader -->
          Loading Job Post Data...
          <!-- [end] preloader -->
        </div>
      </div>

      <!-- [begin] FORM -->
      <div id="romeo_job_form">
        <h4>Apply for this Job</h4>
        <hr>
        <link href="https://fonts.googleapis.com/css?family=Roboto:300,400" rel="stylesheet">
        <link rel="stylesheet" href="<?php echo get_template_directory_uri() . "/greenhouse_api/css/style.css"; ?>">

        <form method="POST" action="<?php echo get_template_directory_uri() . "/greenhouse_api/includes/post.php"; ?>" id="romeo_application_form" enctype='multipart/form-data'>

          <!-- represents the ID of the job post -->
          <input type="hidden" name="romeo_job_post_id" id="romeo_job_post_id"/>
          <input type="hidden" name="romeo_job_post_title" id="romeo_job_post_title"/>
          <!-- place the value of the gh_src URL parameter in the field below -->
          <input type="hidden" name="mapped_url_token" value="token12345" />

          <?php include "includes/application.php"; ?>

          <!-- <input type="submit" /> -->
          <button type="submit" name="submit" style="cursor: pointer;">Submit Application</button>

        </form>
      </div>
      <!-- [end] FORM -->
    </div>

    <!-- FOOTER -->
    <footer id="modal_footer">
      <div class="container">
        <center>
          <img src="https://romeopower.com/whitetail/uploads/2019/02/bolt-neg-100.svg" alt="Romeo Power" style="max-width: 10%;">
          <p>
            <small>Romeo Systems, Inc. 4380 Ayers Ave, Vernon, CA 90058<br>© Romeo Systems, Inc.&nbsp;2019</small>
          </p>
        </center>
      </div>
    </footer>
    <!-- [end] 'footer' -->

  </div>
</div>


<script type="text/javascript">
  $(document).ready(
    function () {
      $('#romeo_application_form').parsley()

      .on('field:validated', function() {
        var ok = $('.parsley-error').length === 0;
        $('.bs-callout-info').toggleClass('hidden', !ok);
        $('.bs-callout-warning').toggleClass('hidden', ok);
      })

      .on('form:submit', function() {

        // DEMO DISPLAY
        var first_name = $('#first_name').val();
        var last_name = $('#last_name').val();
        var email = $('#email').val();
        var phone = $('#phone').val();
        var resume = $('#resume').val();
        var cover_letter = $('#cover_letter').val();
        var question_5532287002 = $('#question_5532287002').val(); // LinkedIn Profile
        var question_5532288002 = $('#question_5532288002').val(); // Website
        var question_5532289002 = $('#question_5532289002').val(); // How did you hear about this job?
        var question_5532290002 = $('#question_5532290002').val(); // What college/university did you attend?

        var eeoc_gender = $('#gender').find(":selected").val(); // Select Menu. Gender
        var eeoc_race = $('#race').find(":selected").val(); // Select Menu. Race
        var eeoc_veteran_status = $('#veteran_status').find(":selected").val(); // Select Menu. Veteran Status
        var disability_status = $('#disability_status').find(":selected").val(); // Select Menu. Disability Status

        // DEMO CONSOLE LOG
        console.log( "First Name: " + first_name );
        console.log( "Last Name: " + last_name );
        console.log( "Email: " + email );
        console.log( "Phone: " + phone );
        console.log( "Resume: " + resume );

        console.log( "Cover Letter: " + cover_letter );
        console.log( "LinkedIn Profile: " + question_5532287002 );
        console.log( "Website: " + question_5532288002 );
        console.log( "How did you hear about this job?: " + question_5532289002 );
        console.log( "What college/university did you attend?: " + question_5532290002 );

        console.log( "Gender: " + eeoc_gender );
        console.log( "Race: " + eeoc_race );
        console.log( "Veteran Status: " + eeoc_veteran_status );
        console.log( "Disability Status: " + disability_status );

        return true; // Don't submit form for this demo
      });
    }
  );
</script>