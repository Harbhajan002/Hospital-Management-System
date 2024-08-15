<style>
    h2{
        margin-left:40px;
    }
   .appoint{
    margin-left:40px;
    margin-bottom:40px;
   }
   a{
    width:90px;
   }
   .black-slotbox .card{
     width: 20rem;
   }
   @media (max-width:767px) {

    .black-slotbox .card {
    width: 100%;
}
   }
 
</style>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="Hospital.css">
  <link rel="icon" type="image/png" sizes="16x16" href="./assets/lgo-removebg.png">
  
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  <title>Appointment Card</title>
</head>
<style>
  .result a{
  width: 150px;
  text-align: end;
  }
 
</style>
<body class="patient-page">
  <div class="parent">
<div class="admin">
        <div class='result'>
         <a href="index.php"><button>Back To Home</button></a><br>
        </div>
        <h2>Appointment Details</h2>
        <div class="black-slotbox">
  

<?php
      include ("connect.php");
        if(isset($_GET['selected_time']) && isset($_GET['slot_id'])) {
            $doctor_id = $_GET['doctor_id'];
            $slot_time = $_GET['selected_time'];
           $slot_id = $_GET['slot_id'];
           $date = $_GET['selected_date'];
          $selectDepartment= "SELECT depart_name from department where department_id in 
           (select department_id from doctor where doctor_id = $doctor_id)";

           $result=$connect->query($selectDepartment);
           if ($result->num_rows > 0) {
                $data =$result->fetch_assoc();
                $depart_naam=$data['depart_name'];
                session_start();
                $patient_id=$_SESSION['patient_id'];
             
               echo"
              <div class='card'  ;'>
              <form action='' method='post'>
                <div class='card-body'>
                <h6 class='card-title'><span>Date</span> :$date $slot_time  </h6>
                <h6 class='card-title'><span>Slot Id</span> :  $slot_id</h6>
                <h6 class='card-title'><span>Doctor Id</span> : $doctor_id</h6>  
                <h6 class='card-title'><span>pid </span> : $patient_id</h6>  
                <h6 class='card-text'><span>Department</span> :$depart_naam </h6>
                <input type='hidden' id='action' name='action' value='cancel'> 
                 <p class='btn_submit'><button id='appointment_cancel'>Cancel</button></p>

               </div>
              </form> 
              </div>";
                     }
                   
                    //stage 2
                    $selectBookAppointment=" SELECT * from doctor_slot_availablity where
                    doctor_id=? and sl_date=?";
                    $statement=$connect->prepare($selectBookAppointment);
                        $statement->bind_param("is",$doctor_id,$date);
                        $statement->execute();
                        $result =$statement->get_result();                
                    if ($result->num_rows > 0) {
                    //  echo "A";
                        $data =$result->fetch_assoc(); 
                        $availableslot =$data['avilable_slot'];
                        $timeArray = json_decode($availableslot); 
                       
                        if(($key=array_search($slot_time, $timeArray))!== false){
                              unset($timeArray[$key]);
                        }
                        $updateSlot= json_encode(array_values($timeArray));
                        echo "<input type='hidden' class='slot'  value='$updateSlot'></input>";
                        $updated=$connect->prepare("UPDATE doctor_slot_availablity set avilable_slot=?
                        where doctor_id=? and sl_date=?");
                        $updated->bind_param("sis",$updateSlot,$doctor_id,$date);
                       
                        if ( $updated->execute()) {
                          echo "<span class='success-message'>Appointment Successfully</span>";
                        }else{
                          echo "<span class='error'>Slot Expired</span>";
                          }

                    } else{
                    
                        //  echo "B";
                        //select unBookeddataslot
                        $timestamp = strtotime($date);
                        $day = date("l", $timestamp);
                        $unBookeddataslot="SELECT * from unBookeddataslot where  doctor_id=? and slot_date=?";
                        $res=$connect->prepare($unBookeddataslot);
                        $res->bind_param("is", $doctor_id, $date);
                        $res->execute();

                         $stmt=$res->get_result();                
                        if ($stmt->num_rows > 0) {
                        //  echo "b1<br>";
                         $data =$stmt->fetch_assoc(); 
                         $unBook_slot =json_decode($data['unBook_slot']);
                         if(($key=array_search($slot_time, $unBook_slot))!== false){
                           unset($unBook_slot[$key]);
                         }
                          $updateunBook_slot= json_encode(array_values($unBook_slot));
                          echo "<input type='hidden'  class='slot'  value='$updateunBook_slot'></input>";
                          //update unBookeddataslot
                          $unBookupdated="UPDATE unBookeddataslot set unBook_slot=?
                         where slot_date =? and doctor_id=?";
                         $updated=$connect->prepare($unBookupdated);
                         $updated->bind_param("ssi",$updateunBook_slot, $date, $doctor_id);
                         if ( $updated->execute()) {
                           echo "<span class='success-message'>Appointment Successfully</span>";
                         }else{
                          echo "<span class='error'>Slot Expired</span>";
                          }
                       }else{
                        //  echo "b2<br>";
                         $doctor_slot_array="SELECT slot_id from doctor where doctor_id=$doctor_id";
                         $result=$connect->query($doctor_slot_array);
                         if ($result->num_rows>0 ) {
                              $data=$result->fetch_assoc();
                              $doc_slot_id=$data['slot_id'];
                              // echo $doc_slot_id;
                              $sidArray = json_decode($doc_slot_id, true); 
                              
                        $dateslot_slot_id="SELECT slot_id from dateslot where slot_Day='$day'";
                        $result2=$connect->query($dateslot_slot_id);
                        if ($result2->num_rows>0 ) {
                             $data=$result2->fetch_assoc();
                             $slot_id=$data['slot_id'];
                            //  echo "$slot_id<br>";
                             if (in_array($slot_id,$sidArray)) {
                              //  echo "selected slot id: $slot_id";
                               $time_slot="SELECT slot_id, slot_Time from dateslot where slot_id=$slot_id";
                               $res=$connect->query($time_slot);
                               if ($res->num_rows>0) {
                                 while ( $d=$res->fetch_assoc()) {
                                   $slot_id=$d['slot_id'];
                                   echo  " <input type='hidden' id='slot_id' value='$slot_id'>";
                                   $timeArray=json_decode($d['slot_Time']);
                       //
                            if(($key=array_search($slot_time, $timeArray))!== false){
                             unset($timeArray[$key]);
                             }
                              $updateSlot= json_encode(array_values($timeArray));
                              echo "<input type='hidden'  class='slot'  value='$updateSlot'></input>";
                                 };
                               }
                             }else{
                              echo "<span class='error'>No Slot Available</span>";
                              }
     
                               }
                            }else{
                              echo "<span class='error'>No Slot Available</span>";
                              }
                                     //insert into new table unBookedDataSlot
                                     $unbookslot ="INSERT into unBookeddataslot (slot_id,doctor_id, slot_date, unBook_slot)
                                     values (?,?,?,?)";
                                    $res=$connect->prepare($unbookslot);
                                             $res->bind_param("iiss", $slot_id, $doctor_id, $date, $updateSlot);
                                   
                                     if (  $res->execute()) {
                                      echo "<span class='success-message'>Appointment Successfully</span>";
                                    }else{
                                      echo "<span class='error'>Slot Expired</span>";
                                      }
                                }
                    }
                  
                    //
                   };
            ?>
 </div>

 </div></div>
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
 integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script>
$(document).ready(function () {
  $(".slot").each(function() {
    var slotValue = $(this).val();
    // console.log(slotValue);
    $.ajax({
      url: 'doctor_appointments.php',
      method: 'POST',
      data: { slot: slotValue },
      success: function(response) {
        // Handle successful response
        // console.log("AJAX request successful. Response:", response);/
        // console.log("Data sent:", slotValue);
      },
      error: function(xhr, status, error) {
        // Handle errors
        console.error("AJAX request failed:", status, error);
      }
    });
  });
  var selectedDate=$("#D_Date").val();

    $(document).on('click', '#appointment_cancel',  function (){
      console.log("click to cancle");
      
        var did=<?php echo json_encode($doctor_id);?>;
        var pid=<?php  echo json_encode($patient_id);?>;
        var date=<?php  echo json_encode($date);?>;
        var time=<?php  echo json_encode($slot_time);?>;
        var sid=<?php  echo json_encode($slot_id);?>;

      if (confirm("Are you sure to cancel appointment")) {
        
        $.ajax({
                  url: 'pda.php',
                  method: 'POST',
                  data: { Did: did, Pid:pid, Date:date, Time:time, Sid:sid, action: 'cancel'},
                  success:function (res) {
                  $('#cancel').html(res);
                    console.log(res);
                    // window.location.href = 'index.php';
                  }
                });

      }else{
        $.ajax({
                  url: 'pda.php',
                  method: 'POST',
                  data: { Did: did, Pid:pid, Date:date, Time:time, Sid:sid, action: 'update'},
                  success:function (res) {
                  $('#cancel').html(res);
                    console.log(res);
                    
                  }
                });
        console.log("error");
      }
      // $('#appointment_form').submit(); 
      
    })
});
</script>
</html>