
    <?php
    include("connect.php"); 
       
          if ($_SERVER['REQUEST_METHOD']=='POST') {
            $depart=$_POST['D_ID'];
           
            $doctorinfo="SELECT * FROM doctor JOIN department ON 
            doctor.department_id = department.department_id
            WHERE department.department_id =?";
            // $doctorinfo="SELECT * FROM doctor  WHERE department_id =?";
            $sql=$connect->prepare($doctorinfo);
            $sql->bind_param("s",$depart);
            $sql->execute();
            $result=$sql->get_result();
            if ($result->num_rows>0) {
              while ($row=$result->fetch_assoc()) {
                  //session to get doc_id
                    $doctor_id=$row['doctor_id'];
                   $doctor_name=$row['name'];

                  echo"
                  <form  action='slotselect.php' method='post'>
                  <div class='card'>
                  <div class='card-body'>
                  
                    <h6 class='card-title'><span>Name</span> : ".$row['name']."</h6>
                    <h6 class='card-title'><span>Email</span> : ".$row['email']."</h6>
                    <h6 class='card-title'><span>Consultant Fees</span> : ".$row['fees']."</h6>         
                    <h6 class='card-text'><span>Department</span> : ".$row['depart_name']."</h6>
                    <a href='slotselect.php?doc_ID=$doctor_id' id='btn' class='btn btn-primary'>select date</a>
                   </div>
                   </div>
                   </form>";
                    }
            }else {
              echo "<p class='error'>Doctor not available 404!</p>";
            }
          }                  
        ?>
