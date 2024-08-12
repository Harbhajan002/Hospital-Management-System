<tbody>
       <tr>
            <th>ID</th>
            <th>Doctor Name</th>
            <th>Number</th>
            <th>Email</th>
            <th>Department</th>
        </tr>
        <?php
        include("../connect.php");

        $doctor="SELECT * from doctor ";
        $statement=$connect->prepare($doctor);
        $statement->execute();
        $doctorResult  =$statement->get_result(); 
        
        if ($doctorResult ->num_rows > 0) {
            while ($data = $doctorResult ->fetch_assoc()) {
            $doctor_ID=$data['doctor_id'];
            $doctor_name=$data['name'];
            $mobile=$data['mobile'];
            $email=$data['email'];
            $department=$data['department_id'];
            // select department name from department table
            $sql = "SELECT *  FROM department WHERE department_id =  ?";
               $stmt = $connect->prepare($sql);
               $stmt->bind_param("i",$department);
               $stmt->execute();
               $departmentResult  = $stmt->get_result();
           if ($departmentResult ->num_rows>0) {
                while ($row = $departmentResult->fetch_assoc()) {
                    $depart_name = $row['depart_name'];
              }
            }
            echo "
                <tr>
                    <td>$doctor_ID</td>
                    <td>$doctor_name</td>
                    <td>$mobile</td>
                    <td>$email</td>
                    <td>$depart_name</td>
                </tr>
                ";
            }
         }else {
            $errorMessage="Enter Valid Name";
         }
        ?>
        </tbody>