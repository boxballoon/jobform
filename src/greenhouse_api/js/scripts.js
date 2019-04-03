/*
GREENHOUSE JOBS SORT/FILTER SCRIPT

This script's responsibilites are:
  - I as a user have the ability to click on a department name. When I click on that name, all the jobs in that department will be filtered.
  - I as a user have the ability to click on a job posting. When I click on that name, all the jobs in that department will be filtered.

-------------------------------------
Dependencies: N/A
Version: Alpha (0.0.1)
Author: steveberry@romeopower.com
Property of Romeo Systems, Inc.
4380 Ayers Ave, Vernon, CA 90058
© Romeo Systems, Inc. 2019
*/

console.log("Charge The World...");

// CONSTANTS
var alljobs = r_job_posts(); // Fire the the job posting function.
// console.log(alljobs); // 'null'
// DEPARTMENT
// @param 'id' - The id of the anchor being clicked.
// Compare the id parameter and the id's of all the jobs in the array. If the id matches, show that job post.
function r_department(id, e){

  e.preventDefault(); //

  alljobs = r_job_posts();

  var department_id = String(id); // Turn the parameter into a string. ie: '4025589002' (10 digits)

  for (i = 0; i < alljobs.length; i++) {

    var i_department = String(alljobs[i].dataset.department); // String
    var i_match = id == i_department; // boolean

    // console.log(i_department);
    // The job ids match, show them and hide the rest.
    if(i_match){
      alljobs[i].classList.remove('hide_job_post');
      alljobs[i].classList.add('show_job_post');
    }else{
      alljobs[i].classList.remove('show_job_post');
      alljobs[i].classList.add('hide_job_post');
    }

  }
}

// JOB POSTS
// The cURL call has already been made. Go find all the jobs it has listed and list them in an 'current jobs' array.
function r_job_posts(){

  current_jobs = document.querySelectorAll('a[data-department]');

  // console.log("Venture", current_jobs);

  return current_jobs; // Returns an array

};

// SINGLE JOB POST
// @param 'id' - The job post's id that is being clicked.
// Show the modal. Fill in the title and the body with the data of the single job post.
function r_modal(id){

  // VARIABLES
  var job_post_modal = document.getElementById("romeo_job_modal").classList.add("show-job-container");
  var romeo_job_post_id = document.getElementById("romeo_job_post_id");
  var romeo_job_post_title = document.getElementById("romeo_job_post_title");
  var content_title = document.getElementById("romeo_job_title");
  var content_body = document.getElementById("romeo_job_content");
  var job_title = fetch('https://boards-api.greenhouse.io/v1/boards/romeopower/jobs/' + id).then( res => res.json() ).then( job => content_title.innerHTML = String(job.title).replace(/&lt;/g, "<").replace(/&gt;/g, ">") );
  var job_content = fetch('https://boards-api.greenhouse.io/v1/boards/romeopower/jobs/' + id).then( res => res.json() ).then( job => content_body.innerHTML = String(job.content).replace(/&lt;/g, "<").replace(/&gt;/g, ">") );
  var input_job_title = fetch('https://boards-api.greenhouse.io/v1/boards/romeopower/jobs/' + id).then( res => res.json() ).then( job => romeo_job_post_title.value = String(job.title).replace(/&lt;/g, "<").replace(/&gt;/g, ">") );

  // console.log("Job Title" + content_title.innerHTML);
  romeo_job_post_id.setAttribute("value", id); // Set the id of the form in the application.
  // romeo_job_post_title.setAttribute("value", content_title.innerHTML); // Set the hidden input value as the job title
}

// CLOSE SINGLE JOB POST
// Hide the modal.
function r_close_modal(){
  var close_post_modal = document.getElementById("romeo_job_modal").classList.remove("show-job-container");
}


/*
SEARCH
Perform a search against:
_DEPARTMENT
_TITLE
_LOCATION
_CONTENT

When the character count of the user's input reaches the required length(greater than 2) perform a search function on that string. If there are matching results, show them. If the user continues to type, stop what you are doing and start over.
*/

// var all_departments; // Place holder

// 'CHECK LENGTH'
// Search is requires greater than 2 characters before it is invoked.
function romeo_search(){

  r_job_posts();

  var value = document.getElementById("job_search").value.toLowerCase(); // The search field.  Coverted to lower case.
  var value_length = value.length; // Character count on the value in the search field.
  var get_all_jobs; // Place holder for fetching job data.

  if( value_length > 2 ){
    // Fetch the current job data.
    get_all_jobs = fetch('https://boards-api.greenhouse.io/v1/boards/romeopower/jobs?content=true').then( res => res.json() ).then( job => romeo_compare_term(job, value));

  }
}


function romeo_compare_term(array, term){

  // Loop through all departments.
  for (i_dept = 0; i_dept < array.jobs.length; i_dept++) {

    var this_dept_name = array.jobs[i_dept].departments[0].name.toLowerCase(); // STRING. The single job post's department name. Coverted to lower case.
    var this_job_title = array.jobs[i_dept].title.toLowerCase(); // STRING. The single job post's title. Coverted to lower case.
    var this_job_content = array.jobs[i_dept].content.toLowerCase(); // STRING. The single job post's content. Coverted to lower case.
    var exists_in_name = this_dept_name.includes(term); // BOOLEAN. Does the term you're searhing for exist in this job's department name? True or false?
    var exists_in_title = this_job_title.includes(term); // BOOLEAN. Does the term you're searhing for exist in this job's department name? True or false?
    var exists_in_content = this_job_content.includes(term); // BOOLEAN. Does the term you're searhing for exist in this job's department name? True or false?

     // console.log("JOBS", alljobs[0]);

    // If the term exists in the name of the department.
    if( exists_in_name || exists_in_title || exists_in_content ){
      alljobs[i_dept].classList.remove('hide_job_post');
      alljobs[i_dept].classList.add('show_job_post');
    }else{
      alljobs[i_dept].classList.remove('show_job_post');
      alljobs[i_dept].classList.add('hide_job_post');
    }

  }

}
