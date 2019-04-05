
<style media="screen">
.education_block {
  background-color: transparent;
  padding: 20px 0;
  margin: 20px 0;
  border-top: 1px solid #d0d0d0;
}
.education_form {
  border-bottom: 1px solid #d0d0d0;

}
</style>

<div id="education_block" class="education_block">
  <div class="education_form" id="education_template" style="display: none;">

    <?php

      include "schools.php";

      include "degrees.php";

      include "disciplines.php";

      include "date.php";

    ?>

  </div>
</div>
<a id="add_education" style="cursor: pointer;">+ Add Another Education</a>

<script>
  $(document).ready(
    function () {
      addEducation();
    }
  );

  $("#add_education").click(function() {
    addEducation();
  });

  function addEducation() {
    var form = $("#education_template").clone();
    $(form).attr('id', "");
    $(form).css('display', 'block');
    form.insertBefore(".education_form:last");
    var form_count = $(".education_form").length - 1; // for template
    // var form_index = form_count-1;

    // Elements name update with index
    form.find('select').each(function() {
      var name = $(this).attr('name');
      name = name.replace('[0]', '['+form_count+']');
      $(this).attr('name', name);
    });
    form.children('input').each(function() {
      var name = $(this).attr('name');
      name = name.replace('[0]', '['+form_count+']');
      $(this).attr('name', name);
    });

    // Give unique id to datalist
    form.children("#school_name").attr('list', 'school-list'+form_count);
    form.children("#school-list").attr('id', 'school-list'+form_count);

    var data_div = document.createElement("div");
    data_div.dataset.index = form_count;
    data_div.className = "data_div";
    form.append(data_div);




    if (form.children(".remove_form").length === 0) {
      var remove_link = "<a class='remove_form' style='float: right; cursor: pointer;'>Remove this education</a>";
      form.prepend(remove_link);
    }

    // $(".education_form").on('click', '.remove_form', function(){
    // })
    $(".remove_form").click(function() {
      console.log('remove_form');
      $(this).parent().remove();
    });
  }
  // $(".remove_form:first").remove();
  // $(".remove_form:first").css("display", "none");
  
 
</script>