
<?php

// SCHOOLS SEARCH FILTER

?>

<label for="name">School</label>
<input type="text" name="school" id="school_id" list="school-list" oninput="onInput()" required="">
<!-- <input type="submit" name="submit" value="Submit"> -->
<datalist id="school-list"></datalist>



<script type="text/javascript">
      var baseUrl = "https://boards-api.greenhouse.io/v1/boards/romeopower/education/schools";
      var selectedSchoolId = "";

      $(function () {
        $('#demo-form').parsley().on('field:validated', function() {
          var ok = $('.parsley-error').length === 0;
          $('.bs-callout-info').toggleClass('hidden', !ok);
          $('.bs-callout-warning').toggleClass('hidden', ok);
        })
        .on('form:submit', function() {
          console.log("School ID:", selectedSchoolId);
          return false; // Don't submit form for this demo
        });
      });

      function isSelected() {
        var term = $('#school_id').val();
        var options = document.getElementById('school-list').children;
        for(var i=0; i<options.length; i++) {
          if (options[i].value === term) {
            selectedSchoolId = options[i].dataset.id;
            $('#school-list').empty();
            return true;
          }
        }
        selectedSchoolId = "";
        return false;
      }

      function onInput() {
        window.setTimeout(() => {
          if (isSelected()) {
            return;
          }

          var term = $('#school_id').val();
          if (term.length > 3) {
            $.get(baseUrl + "?term=" + term, function(data) {
              $('#school-list').empty();
              var items = data.items;
              var lenLimit = 20;
              var length = (items.length > lenLimit) ? lenLimit : items.length;
              for (var i=0; i<length; i++) {
                var optionNode = document.createElement("option");
                optionNode.value = items[i].text;
                optionNode.dataset.id = items[i].id;
                $('#school-list').append(optionNode);
              }
            });
          }
        }, 1);
      }
    </script>
