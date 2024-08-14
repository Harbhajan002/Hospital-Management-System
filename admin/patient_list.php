<tbody>
       <tr>
            <th>Patient Name</th>
            <th>Gender</th>
            <th>DOB</th>
            <th>Mobile</th>
            <th>MR. No</th>
        </tr>
        <?php
        include("../connect.php");

        $patient="SELECT * from patient ";
        $statement=$connect->prepare($patient);
        $statement->execute();
        $patientResult  =$statement->get_result(); 
        
        if ($patientResult ->num_rows > 0) {
            while ($data = $patientResult ->fetch_assoc()) {
            $fname=$data['fname'];
            $gender=$data['gender'];
            $dob=$data['dob'];
            $mobile=$data['mobile'];
            $mr=$data['mr'];
           
            echo "
                <tr>
                    <td>$fname</td>
                    <td>$gender</td>
                    <td>$dob</td>
                    <td>$mobile</td>
                    <td>$mr</td>
                </tr>
                ";
            }
         }else {
            $errorMessage="Enter Valid Name";
         }
        ?>
        </tbody>