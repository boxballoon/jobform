<?php
/*
Template Name: Green House Jobs

'JOBS'
Displays all jobs and departments.
-------------------------------------
Version: Production (1.0.1)
Author: Romeo Power Development Team
Property of Romeo Systems, Inc.
4380 Ayers Ave, Vernon, CA 90058
© Romeo Systems, Inc. 2019

*/


function strposX($string, $looking_for, $number){
  if($number == '1'){
    return strpos($string, $looking_for);
  }elseif($number > '1'){
    return strpos($string, $looking_for, strposX($string, $looking_for, $number - 1) + strlen($looking_for));
  }else{
    return error_log('Error: Value for parameter $number is out of range');
  }
}


get_header();

$is_page_builder_used = et_pb_is_pagebuilder_used( get_the_ID() );

?>


<div id="main-content">

<?php if ( ! $is_page_builder_used ) : ?>

	<div class="container">
		<div id="content-area" class="clearfix">
			<div id="left-area">

<?php endif; ?>
<?php while ( have_posts() ) : the_post(); ?>

				<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

<?php if ( ! $is_page_builder_used ) : ?>

					<h1 class="entry-title main_title"><?php the_title(); ?></h1>

<?php endif; ?>

					<div class="entry-content">

<?php the_content(); ?>

					<div class="et_pb_section greenjobs et_pb_section_2 et_pb_with_background et_section_regular">
						<div class="et_pb_row et_pb_row_1-2 currentOpeningsContainer">
							<div class="et_pb_column et_pb_column_4_4 et_pb_column_1    et_pb_css_mix_blend_mode_passthrough et-last-child">
								<div class="et_pb_module et_pb_text et_pb_text_0 careerHeaders et_pb_bg_layout_light  et_pb_text_align_left">
									<div class="et_pb_text_inner">
										<h2>Current Openings</h2>
									</div>
								</div> <!-- .et_pb_text -->
							</div> <!-- .et_pb_column -->
						</div> <!-- .et_pb_row -->
						<div class="et_pb_row et_pb_row_2 currentOpeningsContainer">
							<div class="et_pb_module et_pb_text et_pb_text_3 et_pb_bg_layout_light  et_pb_text_align_left">
								<div class="et_builder_inner_content et_pb_gutters3" onload="r_job_posts()">
								    <div class="et_pb_column et_pb_column_1_4 et_pb_column_1 et_pb_css_mix_blend_mode_passthrough">
								      <div class="et_pb_module et_pb_text et_pb_text_3 et_pb_bg_layout_light et_pb_text_align_left">



<div id='romeo_search_container'>
  <form role='search' method='get' class='et-search-form' action='' style='max-width: 390px;'>
    <input id='job_search' onkeydown='romeo_search()' type='search' class='et-search-field' placeholder='Search …' value='' name='s' title='Search for:' style='font-size: 14px;'>
  </form>
</div>



<ul style="list-style: none; margin: 0; padding: 0;">

<?php
// DEPARTMENTS
$departments = get_template_directory_uri() . '/greenhouse_api/departments.php'; // Absolute path.
$dept_slash = "/"; // The occurance of the slash in the absolute path.
$dept_occurance = 3; // Everything after the 3rd occurance of the slash in the absolute path.
$dept_starting_point = strposX($departments, $dept_slash, $dept_occurance); // NUMBER. Returns the position of the '3' '$dept_slash'.
$dept_relative_path = substr( $departments , $dept_starting_point + 1 ); // Outputs the relative path to the include.
include "$dept_relative_path"; // Include the file
// [end] 'CURRENT JOBS'
?>

</ul>


											</div>
								    </div>

										<div class="et_pb_column et_pb_column_3_4 et_pb_column_2 et_pb_css_mix_blend_mode_passthrough">
									    <div class="et_pb_module et_pb_text et_pb_text_4 et_pb_bg_layout_light et_pb_text_align_left">

<ul>

<?php
// CURRENT JOBS
// Location = "http://" + "domain" + "install" + "wp-content/themes/romeo_divi/includes/greenhouse/current-openings.php"
// Whitetail = "https://" + "romeopower.com" + whitetail + themes/Divi/greenhouse_api/includes/greenhouse/current-openings.php
$current_openings = get_template_directory_uri() . '/greenhouse_api/jobs.php'; // Absolute path. Child Theme
$slash = "/"; // The occurance of the slash in the absolute path.
$occurance = 3; // Everything after the 3rd occurance of the slash in the absolute path.
$starting_point = strposX($current_openings, $slash, $occurance); // NUMBER. Returns the position of the '3' '$slash'.
$relative_path = substr( $current_openings , $starting_point + 1 ); // Outputs the relative path to the include.
include "$relative_path"; // Include the file
// [end] 'CURRENT JOBS'
?>

</ul>

											</div>
									  </div>
								  </div>
							</div> <!-- .et_pb_text -->
						</div> <!-- .et_pb_row -->
					</div> <!-- .et_pb_section -->
				</div> <!-- .entry-content -->
				</article> <!-- .et_pb_post -->

<?php endwhile; ?>
<?php if ( ! $is_page_builder_used ) : ?>

			</div> <!-- #left-area -->

			<?php get_sidebar(); ?>

		</div> <!-- #content-area -->
	</div> <!-- .container -->

<?php

endif;

?>
</div> <!-- #main-content -->


<?php
// CURRENT JOBS
// Location = "http://" + "domain" + "install" + "wp-content/themes/romeo_divi/includes/greenhouse/current-openings.php"
// Whitetail = "https://" + "romeopower.com" + whitetail + themes/Divi/greenhouse_api/includes/greenhouse/current-openings.php
$current_job_modal = get_template_directory_uri() . '/greenhouse_api/modal.php'; // Absolute path. Child Theme
$job_modal_slash = "/"; // The occurance of the slash in the absolute path.
$job_modal_occurance = 3; // Everything after the 3rd occurance of the slash in the absolute path.
$jmodal_starting_point = strposX( $current_job_modal, $job_modal_slash, $job_modal_occurance ); // NUMBER. Returns the position of the '3' '$job_modal_slash'.
$jmodal_relative_path = substr( $current_job_modal , $jmodal_starting_point + 1 ); // Outputs the relative path to the include.
include "$jmodal_relative_path"; // Include the file
// [end] 'CURRENT JOBS'

?>

<?php

get_footer();
?>
