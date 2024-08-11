<div class='card1' style='border:none;'>
      <form action="" method="post">
      <label for="datetime">Select a date:</label>
        <input type="date" class="form-control" id="datetime" name="datetime" required>
      </form>
</div>
<div id="slot_basedon_date_doc_id">
         <?php 
         include ("connect.php");
         if(isset($_POST['select_d_id'])) {
             $select_d_id= $_POST['select_d_id'];
          }
          ?>
</div>
<div id="final_Updated_doctor_slot"></div>

<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script>
 //Date and doctor_id pass to DOCTOR_slot_date.php
$(document).ready(function () {
         var today = new Date().toISOString().split('T')[0];
         $('#datetime').attr('min', today);
        //display slot according to selected date and docotr id
        $('#datetime').on('change', function () {
            var date =$(this).val();
            var seleted_doctor_id ='<?php echo  $select_d_id;?>';
            $.ajax({
                url: 'DOCTOR_slot_date.php',
                method: 'POST',
                 data: {date: date , seleted_doctor_id:seleted_doctor_id},
                success: function (response) {
                    $('#slot_basedon_date_doc_id').html(response);
                }
            });
          });
        });
</script>     
