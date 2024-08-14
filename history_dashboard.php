<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="Hospital.css"> 
    <title>Cancle Appointment List</title>
    <style>
     .admin .black-slotbox {
        width: 80%;
     }
     @media (max-width:767px) {
        .admin .black-slotbox {
        width: 100%;
        overflow-x: auto;
        align-items: start;
    
     }
     }
     
    </style>
</head>
<body class="patient-page">
    <div class="admin" >
      <div class='result'>
         <a href="index.php"><button>Back To Home</button></a><br>
        </div>
       
            
        <div class="black-slotbox" action="" method="post" id="admin">
       
        <table class="table"  id="history_table">
    <tr>
        <th>Patient</th>
        <th>Slot</th>
        <th>Doctor</th>
        <th colspan="2">Date</th>
        <th>Time</th>
        <th>Status</th>
    </tr>
<?php
include("connect.php");

    // file_put_contents('post_data.log', print_r($_POST, true));
    // Assign the values to variables
    if (isset($_GET['doctor-id'] ) ){
    $doctor_id= (int)$_GET['doctor-id'] ;

    echo "Doctor ID: HD000$doctor_id <br>";

    }
    $status1 = "Cancle";
    $status2 = "Finish";
    $history = "SELECT * FROM appointment WHERE (status = ? OR status = ?)  And doctor_id=? ";
    $stmt_cancel = $connect->prepare($history);
    $stmt_cancel->bind_param("ssi", $status1 , $status2, $doctor_id);
    $stmt_cancel->execute();
    $result_cancel = $stmt_cancel->get_result();

    if ($result_cancel->num_rows > 0) {
        while ($data = $result_cancel->fetch_assoc()) {
            $pid = $data['patient_id'];
            $sid = $data['slot_id'];
            $did = $data['doctor_id'];
            $date = $data['appoint_date'];
            $time = $data['appoint_time'];
            $status = $data['status'];
            $patient="SELECT fname, lname from patient where patient_id= $pid";
            $rows=$connect->query($patient);
                        
            if ($rows->num_rows>0) {
            $data=$rows->fetch_assoc();
            $fname= $data['fname'];
            $lname= $data['lname'];
            }
            $rowColor = ($status == "Cancle") ? "style='background-color:red;'" : (($status == "Finish") ? "style='background-color:green;'" : "");

        echo "<tbody>
        <tr $rowColor>
                    <td>$fname</td>
                    <td>$sid</td>
                    <td>$did</td>
                    <td  colspan='2'>$date</td>
                    <td>$time</td>
                    <td>$status</td>
                </tr></tbody>";
            }
                    } 
                    else {
                        echo "<tr><td colspan='7' style='background-color:red; text-align:center;'>No appointment found</td></tr>";
                    }
               
                ?>
                </table>
        </div>
       
    </div>

</body>
</html>
