<style>
        .green {
            background-color: lightgreen;
        }
        .red {
            background-color: lightcoral;
            border:none;
        }
     

    </style>
   
<table class="appointment-table">
    <tr>
        <th>Patient</th>
        <th >Slot</th>
        <th  >Doctor</th>
        <th >Date</th>
        <th >Time</th>
        <th >Status</th>
        <th>Active</th>
    </tr>
<?php 
include ("connect.php");
// if(isset($_POST['slot'])) {
//   $slots = $_POST['slot']; // Get the array of time slots
//   print_r($slots);
// } else {
//   echo "No slots received";
// }

if(isset($_POST['select_d_id'])) {
  $status_point = "Pending";
      $select_doc_id= $_POST['select_d_id'];
      $select_doc_id = (int)$_POST['select_d_id']; 
      echo "Doctor ID: HD000$select_doc_id<br>";

      $appointments="SELECT * from appointment where doctor_id= $select_doc_id and status = '$status_point'";
      $stmt=$connect->query($appointments);
      if ($stmt->num_rows>0) {
      while ( $data=$stmt->fetch_assoc()) {
      $appointId=$data['Appointment_id'];
      $pid= $data['patient_id'];

      $sid= $data['slot_id'];
      $id= $data['doctor_id'];
      $date=  $data['appoint_date'];
      $time= $data['appoint_time'];
      $status= $data['status'];
      if (isset($data['patient_id'])) {
        $patient="SELECT fname, lname from patient where patient_id= $pid";
        $rows=$connect->query($patient);
                    
        if ($rows->num_rows>0) {
        $data=$rows->fetch_assoc();
        $fname= $data['fname'];
        $lname= $data['lname'];
        }
      }
     
echo "
<tr class='patient' data-id='$appointId'>

    <td >$fname</td>
    <td >  $sid</td>
    <td >  $id </td>
    <td >$date </td>
    <td >$time </td>
    <td >$status </td>
    <td> 
    <div class='result'><button id='cancle'>Cancel</button> 
<button id='finish'>Finish</button> </div>

</td>
</tr>";
} ;
}else{
  echo "<tr><td colspan='14' style='background-color:red; color:white'>No appointment found</td></tr>";

}
}
?> 
</table>

<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script> 
$(document).ready(function () {
  $(document).on('click', 'tr', function () {
    var appointId = $(this).attr('data-id');
    // console.log("appoint ID:", appointId);
    // var popup = document.getElementById("myPopup");
    //  popup.classList.toggle("show");
  });
  // finish
    $(document).on('click', '#finish',  function (){
      console.log("finish");
      status = "Finish";
      $row = $(this).closest('tr');
      $row.addClass('green');
        var appointId = $(this).closest('tr').attr('data-id');
        console.log("AppointId of finish: " + appointId);
        if (confirm("You are sure to finish appointment")) {
      // show history table when status not pending
        $.ajax({
                  url: 'history_dashboard.php',
                  method: 'POST',
                  data: { Appoint_id: appointId, status: status},
                  success: function(response) {
                    // console.log(response);
                   }
                });

                // update appointment status
                $.ajax({
                  url: 'appointment_status.php',
                  method: 'POST',
                  data: { Appoint_id: appointId, status: status},
                  success: function(response) {
                    if (response.trim()==="Success") {
                          console.log($(this).closest('tr'));
                          
                            $row.fadeOut(1000);
                        
                          } else {
                            console.log("not updated service");                            
                          }
                   }
                });

              }else{
                console.log("Cancle opertion");


              }
    })
    // cancle
    $(document).on('click', '#cancle',  function (){
      console.log("cancle",$(this).closest('tr'));
      status = "Cancle";
      $row = $(this).closest('tr');
      $row.addClass('red');
        var appointId = $(this).closest('tr').attr('data-id');
        console.log(" AppointId: " + appointId);

        if (confirm("Are you sure to cancel appointment")) {
        $.ajax({
                  url: 'history_dashboard.php',
                  method: 'POST',
                  data: { Appoint_id: appointId, status: status},
                  success: function(response) {
                    // console.log(response);

                   },
                });

                 // update appointment status
                 $.ajax({
                  url: 'appointment_status.php',
                  method: 'POST',
                  data: { Appoint_id: appointId, status: status},
                  success: function(response) {
                    console.log(response);
                        if (response.trim()==="Success") {
                          console.log($(this).closest('tr'));
                          
                            $row.fadeOut(1000);
                        
                          } else {
                            console.log("not updated service");                            
                          }
                   }
                });
              }else{
                console.log("Cancle opertion");
                
              }
    })
 
});
</script>