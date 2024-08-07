<style>
  .card{
    background-color: rgb(236, 236, 255);


}
</style>

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
                  <form action='slotselect.php' method='post'>
                  <div class='card'  style='width: 18rem;'>
                  <div class='card-body'>
                  
                    <h6 class='card-title'><span>Name</span> : ".$row['name']."</h6>
                    <h6 class='card-title'><span>Email</span> : ".$row['email']."</h6>
                    <h6 class='card-title'><span>Consultant Fees</span> : ".$row['fees']."</h6>         
                    <h6 class='card-text'><span>Department</span> : ".$row['depart_name']."</h6>
                    <a href='slotselect.php ?doc_ID=$doctor_id' id='btn' class='btn btn-primary'>select date</a>
                   </div>
                   </div>
                   </form>";
                    }
            }else {
              echo "doctor not found 404!";
            }
          }                  
        ?>
<!-- <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

<script type="text/javascript">
    $(document).ready(function () {
    $('#btn').on('click', function () {
      

        console.log("Sending doctorid:", centerid); // Verify the data being sent
        $.ajax({
          method:"post",
          url:"slotselect.php",
          data:{doc_ID:doctorid, Cid:centerid}
        });
    });
  });
</script> -->