



<!-- new -->
<?php

include ('connect.php');//accept connection
if($_SERVER['REQUEST_METHOD']=='POST'){//req to server for post method

if (isset($_POST['docname'])) {
    $docname = $_POST['docname'];
    $email = $_POST['email'];
//mobile number verify:::::::::::::::::::::::::::::::::::::::::::::::::::::::
$sql="SELECT doctor_id, name from doctor WHERE name= ? and email=?";
$statement=$connect->prepare($sql);
$statement->bind_param("ss",$docname, $email);
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
 } ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="Hospital.css">
<link rel="icon" type="image/png" sizes="16x16" href="./assets/lgo-removebg.png">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <title>Doctor Login</title>
    <style>

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
table{
    border:1px solid;
}
@media (max-width:767px) {
    .result {
    margin-top: 10px;
}
}

    </style>
</head>


<body class="patient-page">
    <div class="admin" id="kkk">
      <div class='result'>
         <a href="index.php"><button>Back To Home</button></a><br>
        </div>
        <?php if (!empty($successMessage)) {
                echo "<h2>Registered $doctor_name</h2>";
            }else{
                echo " <h2>Doctor Log In</h2>";
            } ?>
        <form class="black-section" action="" method="post" id="admin">
            <label class="filled" for="name">Name</label>
            <input type="text" id="name" name="docname"  placeholder="Enter Your Name" required>

            <label class="filled" for="unique_id">Email</label>
            <input type="email" id="unique_id" name="email" placeholder="Email" required>
            
            <p class="btn_submit"><button type="submit" id="btn_submit">Log In</button></p><br>
            <span class="msg">
            <?php if (!empty($errorMessage)) {
            echo " <span class='error-message'> $errorMessage </span>";  
           } 
           if (!empty($successMessage)) {
            echo "<span class='success-message'> $successMessage </span>"; 

           }?>
            </span>
            

        </form>
        <?php if (!empty($successMessage)) {
                    //verify mobile number with patient table 
              echo "<br><br>
              <div class='result'>
             <a href='doctor-dashboard.php? id=$doctor_ID'><button >View Dashboard</button></a>
             </div>";

            }
           ?>
    </div>
</body>
<!--makesh 99919 91296 -->


<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
    </script>

</html>