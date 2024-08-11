<?php
include("dashboard-header.php");
?>
<div class="main">
    <div class="left ">
        <ul>

           <li><a href="DOCTOR-Signup.php"><button>Doctor Sign Up</button></a></li>
            <li><button>Patient List</button></li>
            <li><button>Doctor List</button></li>
            <li><button>Appointments</button></li>
        </ul>
    </div>
<div class="right">

    <table class="table" id="history_table">
        <tr>
            <th>Patient</th>
            <th>Slot</th>
            <th>Doctor</th>
            <th>Date</th>
            <th>Time</th>
        </tr>
        <?php
include("connect.php");

    $appointments = "SELECT * FROM appointment ";
    $stmt_cancel = $connect->prepare($appointments);
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

?>
    </table>

</div>
</div>

</body>