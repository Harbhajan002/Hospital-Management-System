<style>
  button{
    margin:10px;
    border-radius: 2px;
    border:none;
  background-color: rgb(183, 230, 244);
    
    border:1px solid;
  }
  
</style>
<!-- <h2>select slot</h2> -->
<!-- <div class="form">hello</div> -->
<?php 
include ("connect.php");
if(isset($_POST['doctor_Id']) && ($_POST['Date'])) {
    $D_ID = $_POST['doctor_Id'];
    $D_Date=$_POST['Date'];
 
    echo  " <input type='hidden' id='D_ID' value='$D_ID'> ";
    echo  " <input type='hidden' id='D_Date' value='$D_Date'>";
         
    //get day to selected date
    $timestamp = strtotime($D_Date);
    $dayOfWeek = date("l", $timestamp);

          $selectUpdatedSlot="SELECT * from doctor_slot_availablity 
                  where doctor_id = $D_ID and sl_date = '$D_Date'";
                  $result=$connect->query($selectUpdatedSlot); 
               if ($result->num_rows>0 ) {
                echo "A";
                 while($data=$result->fetch_assoc()){
                  $slot_id=$data['slot_id'];
                  $time =$data['avilable_slot'];
                  $timeArray = json_decode($time);                  
                  echo  " <input type='hidden' id='slot_id' value='$slot_id'>";
                }
                  // Iterate over each time slot and generate a button
                  foreach ($timeArray as $slot) {
                   echo "<button  class='btn btn-secondary'>$slot</button>";
                }
              }
   else{
    echo "B";
       $unBookeddataslot="SELECT * from unBookeddataslot 
        where doctor_id = $D_ID and slot_date = '$D_Date'";
           $result=$connect->query($unBookeddataslot); 

               if ($result->num_rows>0 ) {
                 while($data=$result->fetch_assoc()){
                  $slot_id=$data['slot_id'];
                   $time =$data['unBook_slot'];
                   $timeArray = json_decode($time); 
                  echo  " <input type='hidden' id='slot_id' value='$slot_id'>";
                }
                   // Iterate over each time slot and generate a button
                   foreach ($timeArray as $slot) {
                    echo "<button  class='btn btn-primary'>$slot</button>";
                 }
                  } 
                  else {
                    echo "c";
                    $doctor_slot_array="SELECT slot_id from doctor where doctor_id=$D_ID";
                    $result=$connect->query($doctor_slot_array);
                    if ($result->num_rows>0 ) {
                         $data=$result->fetch_assoc();
                         $doc_slot_id=$data['slot_id'];
                         echo $doc_slot_id;
                         $sidArray = json_decode($doc_slot_id, true); 
                         
                   $dateslot_slot_id="SELECT slot_id from dateslot where slot_Day='$dayOfWeek'";
                   $result2=$connect->query($dateslot_slot_id);
                   if ($result2->num_rows>0 ) {
                        $data=$result2->fetch_assoc();
                        $slot_id=$data['slot_id'];
                        echo "$slot_id<br>";
                        if (in_array($slot_id,$sidArray)) {
                          echo "selected slot id: $slot_id";
                          $time_slot="SELECT slot_id, slot_Time from dateslot where slot_id=$slot_id";
                          $res=$connect->query($time_slot);
                          if ($res->num_rows>0) {
                            while ( $d=$res->fetch_assoc()) {
                              $slot_id=$d['slot_id'];
                              echo  " <input type='hidden' id='slot_id' value='$slot_id'>";
                              $timeArray=json_decode($d['slot_Time']);
                              foreach ($timeArray as $slot) {
                                 echo "<button  class='btn btn-primary'>$slot</button>";
                             }
                            };
                           
                            
                          }
                        }else{
                          echo "not any available slot";
                        }
                   }
                           } else{                
                             echo "no slot available";
                           }
                    }
                  }
                }       

          ?>
