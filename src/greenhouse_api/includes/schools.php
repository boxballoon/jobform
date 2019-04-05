
<?php

// SCHOOLS SEARCH FILTER

?>

<label for="name">School</label>
<input type="text" name="school" id="school_name" list="school-list" oninput="onInput(this)">
<input type="hidden" name="educations[0][school_name_id]" class="school_id" list="school-list" oninput="onInput()">
<!-- <input type="submit" name="submit" value="Submit"> -->
<datalist id="school-list"></datalist>



<script type="text/javascript">
      var baseUrl = "https://boards-api.greenhouse.io/v1/boards/romeopower/education/schools";
      var parentElement; // Current education block

      $(function () {
        // $('#demo-form').parsley().on('field:validated', function() {
        //   var ok = $('.parsley-error').length === 0;
        //   $('.bs-callout-info').toggleClass('hidden', !ok);
        //   $('.bs-callout-warning').toggleClass('hidden', ok);
        // })
        // .on('form:submit', function() {
        //   console.log("School ID:", selectedSchoolId);
        //   return false; // Don't submit form for this demo
        // });
      });

      function isSelected(term) {
        // var term = $('#school_name').val();
        // var options = document.getElementsByTagName('datalist')[0].children;
        var options = parentElement.children('datalist:first').children();
        var selected = false;

        parentElement.children('.school_id').val("");
        options.each(function(i) {
          if (this.value === term) {
            // console.log('this.dataset.id:', this.dataset.id);
            parentElement.children('.school_id').val(this.dataset.id);
            parentElement.children('datalist').empty();
            selected = true;
          }
        });
        
        // for(var i=0; i<options.length; i++) {
        //   if (options[i].value === term) {
        //     console.log('options[i].dataset.id:', options[i].dataset.id);
        //     parentElement.children('.school_id').val(options[i].dataset.id);
        //     parentElement.children('datalist').empty();
        //     return true;
        //   }
        // }
        return selected;
      }

      function onInput(obj) {
        // var this = $(this);
        parentElement = $(obj).parent();
        window.setTimeout(() => {
          var term = $(obj).val();
          if (isSelected(term)) {
            return;
          }

          if (term.length > 3) {
            $.get(baseUrl + "?term=" + term, function(data) {
              // $('#school-list').empty();
              parentElement.children('datalist').empty();
              var items = data.items;
              var lenLimit = 20;
              var length = (items.length > lenLimit) ? lenLimit : items.length;
              for (var i=0; i<length; i++) {
                var optionNode = document.createElement("option");
                optionNode.value = items[i].text;
                optionNode.dataset.id = items[i].id;
                parentElement.children('datalist').append(optionNode);
              }
            });
          }
        }, 1);
      }

      function getBlockElementByClass(obj) {

      }
    </script>
