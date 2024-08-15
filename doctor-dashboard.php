



<!-- new -->
<?php

include ('connect.php');//accept connection

if (isset($_GET['id'])) {
    $docid = $_GET['id'];
    // echo $docid;
//mobile number verify:::::::::::::::::::::::::::::::::::::::::::::::::::::::
$sql="SELECT doctor_id, name from doctor WHERE doctor_id= ? ";
$statement=$connect->prepare($sql);
$statement->bind_param("i",$docid);
$statement->execute();
$result =$statement->get_result(); 

if ($result->num_rows > 0) {
    $data =$result->fetch_assoc();
    $doctor_ID=$data['doctor_id'];
    $doctor_name=$data['name'];
    

    $successMessage="Verify Name";     
 }else {
    $errorMessage="Enter Valid Name";
 }
 }
  ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="Hospital.css">
<link rel="icon" type="image/png" sizes="16x16" href="./assets/lgo-removebg.png">

    <title>Doctor Login</title>
    <style>
.doctor-dashboard{
    display:flex;
    /* align-items: center; */
    width: 100%;
    padding:40px;
    background-color: black;
    opacity: 0.7;
    color: #fff;
}
.date{
    margin-top:40px;
    margin-left:70px;

}
.container{
    display: flex;
    flex-direction: column;
    margin: 40px;
  justify-content:center;
    align-items: center;
    border:1px solid;

   
   }
#slotTime , #dateslotTime{
    padding:20px;
    height: 20px;
    width: 34px;
}
@media  screen and (max-width: 1023px) {

.doctor-dashboard .right .card1 {
    width: 100%;
}
}
@media (max-width:767px) {

.doctor-dashboard{
        flex-direction: column;
          padding:0px 40px 35px 35px;
         border-radius: 5px;
       
    }
}

    </style>
</head>


<body class="patient-page">
    <div class="admin" >
      <div class='result'>
         <a href="index.php"><button>Back To Home</button></a><br>
        </div>
        <?php if (!empty($successMessage)) {
                echo "<h2>Registered $doctor_name</h2>";
            }else{
                echo " <h2>Doctor Log In</h2>";
            } ?>
        <div class="doctor-dashboard" action="" method="post" id="admin">
        <?php if (!empty($successMessage)) {
                    //verify mobile number with patient table 
              echo "<br>
              <div class='option-btn'>
              <button  id='doctor_slot'>Change slot</button>
            
             <button  id='appointments'>Appointments</button>
          
             <a href='history_dashboard.php? doctor-id=$docid '> <button  id='appointments'>History</button></a>

             </div>";

            }
           ?>
           <div class="right " id="kkk">
            
           </div>
        </div>
       
    </div>
</body>
<!--makesh 99919 91296 -->


<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

<script type="text/javascript">
    $(document).ready(function () {
    
        $('#doctor_slot').on('click', function () {
            var seleted_doctor_id ='<?php echo $doctor_ID;?>';
         console.log(seleted_doctor_id);
            $.ajax({
                url: 'doctor-slot.php',
                method: 'POST',
                 data: {select_d_id: seleted_doctor_id},
                success: function (response) {
                    $('#kkk').html(response);
                }
            });
        });
        $('#appointments').on('click', function () {
            var seleted_doctor_id ='<?php echo $doctor_ID;?>';
            console.log(typeof(seleted_doctor_id));
         
            $.ajax({
                url: 'doctor_appointments.php',
                method: 'POST',
                 data: {select_d_id: seleted_doctor_id},
                success: function (response) {
                    $('#kkk').html(response);
                    
                }
            });
        });

    });
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
    </script>

</html>