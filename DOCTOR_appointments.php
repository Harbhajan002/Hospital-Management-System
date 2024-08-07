<style>
        .green {
            background-color: lightgreen;
        }
        .red {
            background-color: lightcoral;
        }
        table, th, td {
  border: 1px solid black;
  border-collapse: collapse;
}

/* Popup container - can be anything you want */
.popup {
  position: relative;
  display: inline-block;
  cursor: pointer;
  -webkit-user-select: none;
  -moz-user-select: none;
  -ms-user-select: none;
  user-select: none;
}

/* The actual popup */
 .popup .popuptext {
  visibility: hidden;
  width: 160px;
  background-color: #555;
  color: #fff;
  text-align: center;
  border-radius: 6px;
  padding: 8px 0;
  position: absolute;
  z-index: 1;
  bottom: 125%;
  left: 50%;
  margin-left: -80px;
}

/* Popup arrow */
.popup .popuptext::after {
  content: "";
  position: absolute;
  top: 100%;
  left: 50%;
  margin-left: -5px;
  border-width: 5px;
  border-style: solid;
  border-color: #555 transparent transparent transparent;
}

/* Toggle this class - hide and show the popup */
.popup .show {
  visibility: visible;
  -webkit-animation: fadeIn 1s;
  animation: fadeIn 1s;
}
    </style>
   
<table class="t">
    <tr>
        <th colspan="2">Patient</th>
        <th  colspan="2">Slot</th>
        <th colspan="2" >Doctor</th>
        <th colspan="2">Date</th>
        <th colspan="2">Time</th>
        <th>Active</th>
    </tr>
    <p class="popuptext" id="myPopup">A Simple Popup!</p>
<?php 
include ("connect.php");
if(isset($_POST['slot'])) {
  $slots = $_POST['slot']; // Get the array of time slots
  print_r($slots);
} else {
  echo "No slots received";
}

if(isset($_POST['select_d_id'])) {

$select_doc_id= $_POST['select_d_id'];
echo " select_doc_id $select_doc_id";
$appointments="SELECT * from appointment where doctor_id= $select_doc_id";
$stmt=$connect->query($appointments);
if ($stmt->num_rows>0) {
while ( $data=$stmt->fetch_assoc()) {
$appointId=$data['Appointment_id'];
$pid= $data['patient_id'];

$sid= $data['slot_id'];
$id= $data['doctor_id'];
$date=  $data['appoint_date'];
$time= $data['appoint_time'];
              
$patient="SELECT fname, lname from patient where patient_id= $pid";
$rows=$connect->query($patient);
             
if ($rows->num_rows>0) {
$data=$rows->fetch_assoc();
$fname= $data['fname'];
$lname= $data['lname'];
}
echo "
<tr class='patient' data-id='$appointId'>

<td colspan='2'>$fname</td>
<td colspan='2'>  $sid</td>
<td colspan='2'>  $id </td>
<td colspan='2'>$date </td>
<td colspan='2'>$time </td>
<td><button class='u'>Update</button> 
<button class='c'>Cancel</button> 
<button class='f'>Finish</button> 
</td>
</tr>";
} ;
}else{
echo "There is not any appointment for you.";
}
}
?> 
</table>
<div id="cancel">
  <a href="history_dashboard.php">View</a>
</div>
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script> 
$(document).ready(function () {
  $(document).on('click', 'tr', function () {
    var appointId = $(this).attr('data-id');
    console.log("Data ID:", appointId);
    var popup = document.getElementById("myPopup");
  popup.classList.toggle("show");
  });
    $(document).on('click', '.f',  function (){
      $(this).closest('tr').addClass('green');
        var appointId = $(this).closest('tr').attr('id');
        console.log("AppointId: " + appointId);
      
        $.ajax({
                  url: 'history_dashboard.php',
                  method: 'POST',
                  data: { Appoint_id: appointId},
                  success: function(response) {
                    // $('#' + appointId)[0].style.backgroundColor = 'red'; // Add 'finished' class to the row
            }
                });
    })
    $(document).on('click', '.c',  function (){
      $(this).closest('tr').addClass('red');
        var appointId = $(this).closest('tr').attr('id');
        console.log(" AppointId: " + appointId);
        // $.ajax({
        //           url: 'history_dashboard.php',
        //           method: 'POST',
        //           data: { Appoint_id: appointId},
        //           success: function(response) {
                   
        //            $('#history_table tbody').append(response); 
        //            $('#' + appointId).remove(); // Remove the row from the table
                  
        //     },
        //         });
    })
 
});
</script>