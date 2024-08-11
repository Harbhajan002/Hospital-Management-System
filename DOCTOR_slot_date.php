  <style>
    .slotdiv{
      display: grid;
    grid-template-columns: 1fr 1fr 1fr;
  
    padding: 10px;
    margin: 20px;
    margin-top: 40px;
    }
    span{
  
    font-size: larger;
    font-weight: 600;
}

    
  </style>
  <?php
include ("connect.php");
if(isset($_POST['seleted_doctor_id'])) {
    $D_ID = $_POST['seleted_doctor_id'];
    $D_Date=$_POST['date'];
    $timestamp = strtotime($D_Date);
    $dayOfWeek = date("l", $timestamp);
    $selectUpdatedSlot="SELECT * from doctor_slot_availablity 
    where doctor_id = $D_ID and sl_date = '$D_Date'";
    $result=$connect->query($selectUpdatedSlot); 
 if ($result->num_rows>0 ) {
  // echo "A";
   while($data=$result->fetch_assoc()){
    $slot_id=$data['slot_id'];
    $time =$data['avilable_slot'];
    $timeArray = json_decode($time);                  
  }
    // Iterate over each time slot and generate a button
    echo "<div class='slotdiv' id='slot_id'>  "; 
    foreach ($timeArray as $slot) {
      echo"   <p><input type='checkbox'   id='dateslotTime' name='slotTime' checked='on' value='$slot'>
             <label   for='slotTime'> <span>$slot</span></label></p>";
   }
   echo " </div>";
}else
  {   
    // echo "B";
    $unBookeddataslot="SELECT * from unBookeddataslot 
     where doctor_id = $D_ID and slot_date = '$D_Date'";
        $result=$connect->query($unBookeddataslot); 

            if ($result->num_rows>0 ) {
              // echo "b1";
              while($data=$result->fetch_assoc()){
               $slot_id=$data['slot_id'];
                $time =$data['unBook_slot'];
                $timeArray = json_decode($time); 
             }
                // Iterate over each time slot and generate a button
                echo "<div class='slotdiv' id='slot_id'>  "; 
                foreach ($timeArray as $slot) {
                  echo"   <p><input type='checkbox'   id='dateslotTime' name='slotTime' checked='on' value='$slot'>
                         <label   for='slotTime'> <span>$slot</span></label></p>";
               }
               echo " </div>";   
               } else{
                // echo "c";
                $doctor_slot_array="SELECT slot_id from doctor where doctor_id=$D_ID";
                $result=$connect->query($doctor_slot_array);
                if ($result->num_rows>0 ) {
                     $data=$result->fetch_assoc();
                     $doc_slot_id=$data['slot_id'];
                    //  echo $doc_slot_id;
                     $sidArray = json_decode($doc_slot_id, true); 
                     
               $dateslot_slot_id="SELECT slot_id from dateslot where slot_Day='$dayOfWeek'";
               $result2=$connect->query($dateslot_slot_id);
               if ($result2->num_rows>0 ) {
                    $data=$result2->fetch_assoc();
                    $slot_id=$data['slot_id'];
                    // echo "$slot_id<br>";
                    if (in_array($slot_id,$sidArray)) {
                      // echo "selected slot id: $slot_id";
                      $time_slot="SELECT slot_id, slot_Time from dateslot where slot_id=$slot_id";
                      $res=$connect->query($time_slot);
                      if ($res->num_rows>0) {
                        while ( $d=$res->fetch_assoc()) {
                          $slot_id=$d['slot_id'];
                          $timeArray=json_decode($d['slot_Time']);
                          echo "<div class='slotdiv' id='slot_id'>  "; 
                          foreach ($timeArray as $slot) {
                            echo"   <p><input type='checkbox'   id='dateslotTime' name='slotTime' checked='on' value='$slot'>
                                   <label   for='slotTime'> <span>$slot</span></label></p>";
                         }
                         echo " </div>";
                        };
                       
                        
                      }
                    }else{
                      echo "<p class='error'>not any available slot <p>";
                    }
               }
                       } else{                
                         echo "no slot available <br>";
                       }
               }
         
          }   
           }
          ?>

<button type="submit" id="updateslot" class="btn btn-primary">Update</button>
<!-- get doctor slot -->
<div id="Updated_slot_date">
</div>
<script>
      var pValuesBasedOnDate = [];
  $('input[type="checkbox"]').on('change', function () {
      var div = $(this).closest('div');
      console.log("div", div);
      var p = div.attr('id');
      console.log("p", p);
      pValuesBasedOnDate = [];
      div.find("p").each(function () {
        if ($(this).find('input').length && !$(this).find('input').prop('checked')) {
          return;
        }
        var label = $(this).find('label').text().trim(); // Extract label text
            pValuesBasedOnDate.push(label); 
      });
  });
    $('#updateslot').on('click', function () {
      
      console.log("tdValues array:", pValuesBasedOnDate);
      var slot_id = '<?php echo  $slot_id;  ?>';
      var Doctor_ID = '<?php echo  $D_ID;  ?>';
      var Doc_date = '<?php echo    $D_Date;  ?>';
      console.log(Doc_date, Doctor_ID, slot_id);
      $.ajax({
        url: 'Updated_doctor_slot.php',
        method: 'POST',
        data: {
          finalSlot: pValuesBasedOnDate,
          slot_id: slot_id,
          Doctor_ID: Doctor_ID,
          Doc_date: Doc_date
        },
        success: function (response) {
          $('#Updated_slot_date').html(response);
        }
      });
    })

</script>