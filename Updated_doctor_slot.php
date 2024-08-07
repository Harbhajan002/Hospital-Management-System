<?php 
include ("connect.php");
// if (isset($_POST['updatedArray'])) {
//     $tdValues = $_POST['updatedArray'];
//     echo "only slot";

//     echo "<table class='table'>";
//     echo "<tr><th>Values</th></tr>";
//     echo '<tr>';
//     foreach ($tdValues as $value) {
//       print_r("<td id='1'>$value</td>") ;
//     }
//     echo '</tr>';
//     echo "</table>";
   
// }else{
//     echo "";
// }
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
 echo "<p class='success'>Slots saved successfully.</p>";
} else {
 echo "Invalid slot";
}




}else{
  echo "Not get any slot";
}

?>