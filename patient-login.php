<?php
session_start();

include ('connect.php');//accept connection
if($_SERVER['REQUEST_METHOD']=='POST'){//req to server for post method

if (isset($_POST['mobileno'])) {
    $mobile = $_POST['mobileno'];
//mobile number verify:::::::::::::::::::::::::::::::::::::::::::::::::::::::
$sql="SELECT mobile, patient_id from patient WHERE mobile= ?";
$statement=$connect->prepare($sql);
$statement->bind_param("s",$mobile);
$statement->execute();
$result =$statement->get_result();

if ($result->num_rows > 0) {
    $data =$result->fetch_assoc();
 //verify mobile number with patient table 
     echo "verify mobile number";                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                      
    $patient_mobile=  $data['mobile'];
    $patient_Id=  $data['patient_id'];

    //send mobile_no to otpverify.php
    $_SESSION['mobile_no'] =   $data['mobile'];
    //send patient_id to appoint.php
    $_SESSION['patient_id'] = $patient_Id;
     echo  $_SESSION['patient_id'];
    $current_time=date("H:i:s");
    
   // $expire_time = date("H:i:s", strtotime($current_time) + 15);

    $expire_time = date("H:i:s", strtotime("+5 seconds") );

    $otp_code=random_int(100000, 999999);
//insert data into otp table::::::::::::::::::::::::::::::::::::::::::::::::::::
     $otpdata="insert into otp (mobile ,patient_id, curr_time, expire_time ,otp_code) values (?,?,?,?,?)";
     $stmt=$connect->prepare($otpdata);
     $stmt->bind_param("iisss", $patient_mobile, $patient_Id,$current_time, $expire_time, $otp_code);
     if ($stmt->execute()) {
        header("location:otpverify.php");
        exit();
      } else {
          echo "Error: " . $sql . "<br>" . $connect->error;
      }
  
     
}
else {
    $errorMessage= "Your Number was not Registered! ";
}
  
                    }
                }

 $connect->close();
?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="Hospital.css">
    <title>Patient Table</title>
    <style>
        .error-message{
            color:red;
        }
    </style>
</head>

<body class="patient-page">
    <div class="container">
    <a href="index.php"
           class="btn btn-primary">Back To Home</a><br>
        <form action="" method="post">
            <h3>Registered Patients Login</h3>
            Mobile No<input type="tel" class="form-control" placeholder="Number" name="mobileno" required>
            <p class="error-message">
             <?php if (!empty($errorMessage)) {
            echo " $errorMessage"; 
           }?>
           </p>
                

           <button type="submit" name="get_otp" id="liveToastBtn" 
           class="btn btn-primary">GET OTP</button><br>
            <span>New Patient <a href='patient-signup.php'>Click Here</a>To Register</span>
        </form>
        </div>
        </body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
    </script>

</html>



      