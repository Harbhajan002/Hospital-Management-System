<?php
include("connect.php");
if (isset($_POST['Appoint_id'] ) && isset($_POST['status'])) {
    $Id = $_POST['Appoint_id'];
    $status = $_POST['status'];
        // status update pending to cancle
            $update_status ="UPDATE appointment set status=?
            where Appointment_id =? ";
            $updated=$connect->prepare($update_status);
            $updated->bind_param("si",$status, $Id);
            if ( $updated->execute()) {
            echo "Success";
            }else{
            echo "<span class='error'>Slot Expired</span>";
            }
        }    
?>