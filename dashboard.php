<?php
include("dashboard-header.php");
?>
<div class="main ">
    <div class="left ">
        <ul>

           <li><a href="DOCTOR-Signup.php"><button>Doctor Sign Up</button></a></li>
            <li id="patient_list"><button >Patient List</button></li>
            <li id="doctor_list"><button >Doctor List</button></li>
            <li id="appoint_list"><a href="dashboard.php"><button>Appointments</button></a></li>
        </ul>
    </div>
    <div class="doctor-dashboard">
<div class="right">

    <table class="table" id="history_table">
        <tr>
            <th>Id</th>
            <th>Patient</th>
            <th>Doctor</th>
            <th>Date</th>
            <th>Time</th>
        </tr>
        <?php
    include("connect.php");
    $sno = 0;
    $appointments = "SELECT * FROM appointment ";
    $stmt_cancel = $connect->prepare($appointments);
    $stmt_cancel->execute();
    $appointments_result = $stmt_cancel->get_result();

    if ($appointments_result->num_rows > 0) {
        while ($data = $appointments_result->fetch_assoc()) {
            $pid = $data['patient_id'];
            $sid = $data['slot_id'];
            $did = $data['doctor_id'];
            $date = $data['appoint_date'];
            $time = $data['appoint_time'];
            $sno ++;
            // select patient name from patient table
            $sql = "SELECT *  FROM patient WHERE patient_id =  ?";
            $stmt = $connect->prepare($sql);
            $stmt->bind_param("i",$pid);
            $stmt->execute();
            $patientResult  = $stmt->get_result();
        if ($patientResult ->num_rows>0) {
             while ($row = $patientResult->fetch_assoc()) {
                 $patient_name = $row['fname'];
          
            echo "
            <tr>
                    <td>$sno</td>
                    <td>$patient_name</td>
                    
                    <td>$did</td>
                    <td>$date</td>
                    <td>$time</td>
                </tr>";
            }
        }
        }
    } else {
        echo "<tr><td colspan='5'>No appointment found</td></tr>";
    }

?>
    </table>

</div>
</div>
</div>
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

<script type="text/javascript">
    $(document).ready(function () {
        $("#appoint_list").find('button').addClass('active-btn');
    
        $('#doctor_list').on('click', function () {
            $('button').removeClass('active-btn');
            // Add the 'active' class to the clicked <li> element
            $(this).find('button').addClass('active-btn');
            
           console.log($(this).find('button'));
            $.ajax({
                url: './admin/doctor_list.php', 
                method: 'POST',
                success: function (response) {
                    $('#history_table').html(response);
                }
            });
        });
        
        $('#patient_list').on('click', function () {
            $('button').removeClass('active-btn');
            $(this).find('button').addClass('active-btn');

            console.log("patient_list");
         
            $.ajax({
                url: './admin/patient_list.php',
                method: 'POST',
                success: function (response) {
                    $('#history_table').html(response);
                    console.log(response);
                    
                }
            });
        });

    });
</script>
</body>