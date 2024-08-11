<?php 
include ("connect.php");

//updated array based on date
if (isset($_POST['finalSlot'])) {

$tdValues = $_POST['finalSlot'];
$tdVal = json_encode($tdValues);
$slot_id = $_POST['slot_id'];
// $Day = $_POST['Day'];
$Doctor_ID = $_POST['Doctor_ID'];
$sl_date = $_POST['Doc_date'];

 $stmt = $connect->prepare("INSERT into doctor_slot_availablity (slot_id , doctor_id, sl_date, avilable_slot)
 VALUES (?,?,?,?)");
 $stmt->bind_param("iiss",$slot_id, $Doctor_ID, $sl_date, $tdVal);
 if ($stmt->execute()) {
 echo "<p class='success-message '>Slots saved successfully.</p>";
} else {
 echo "<p class='error '>Invalid slot</p>";
}




}else{
  echo "Not get any slot";
}

?>