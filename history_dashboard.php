<!DOCTYPE html>
<html>
<head>
  <title>Canceled Appointment Details</title>
</head>
<body>

<table class="table"  id="history_table">
    <tr>
        <th>Patient</th>
        <th>Slot</th>
        <th>Doctor</th>
        <th>Date</th>
        <th>Time</th>
    </tr>
<?php
include("connect.php");
if (isset($_POST['Appoint_id'])) {
    $Id = $_POST['Appoint_id'];
    file_put_contents('post_data.log', print_r($_POST, true));
    echo $Id;
    $cancel = "SELECT * FROM appointment WHERE Appointment_id = ?";
    $stmt_cancel = $connect->prepare($cancel);
    $stmt_cancel->bind_param("i", $Id);
    $stmt_cancel->execute();
    $result_cancel = $stmt_cancel->get_result();

    if ($result_cancel->num_rows > 0) {
        while ($data = $result_cancel->fetch_assoc()) {
            $pid = $data['patient_id'];
            $sid = $data['slot_id'];
            $did = $data['doctor_id'];
            $date = $data['appoint_date'];
            $time = $data['appoint_time'];
            echo "<tbody>
            <tr>
                    <td>$pid</td>
                    <td>$sid</td>
                    <td>$did</td>
                    <td>$date</td>
                    <td>$time</td>
                </tr></tbody>";
        }
    } else {
        echo "<tr><td colspan='5'>No appointment found</td></tr>";
    }
} else {
    echo "<tr><td colspan='5'>Data not received</td></tr>";
}
?>
</table>

<a href="Login.php">Back to Login</a>

</body>
</html>
