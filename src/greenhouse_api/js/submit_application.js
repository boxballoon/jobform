
var input_first_name;
var input_last_name;
var input_email;
var input_phone;

var data = null;

var xhr = new XMLHttpRequest();
xhr.withCredentials = true;

xhr.addEventListener("readystatechange", function () {
  if (this.readyState === 4) {
    console.log(this.responseText);
  }
});

xhr.open("POST", "https://romeopower.com/whitetail/themes/Divi/greenhouse_api/includes/greenhouse/post_job_app.php?job_id=4220907002&first_name=" + input_first_name + "%20&last_name=" + input_last_name + "&email=" + input_email + "&phone=" + input_phone + " ");
xhr.setRequestHeader("cache-control", "no-cache");
xhr.setRequestHeader("Postman-Token", "6c8b4fe9-a4ab-43f6-905f-6b73d01c34b5");

xhr.send( data );
