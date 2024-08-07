<style>
    .error-message{
        color:red;
    }
</style>

<?php
session_start();

include ('connect.php');//accept connection

if (isset($_SESSION['mobile_no'])) {
    $number= $_SESSION['mobile_no'];
    $getcode="SELECT otp_code, expire_time, curr_time FROM otp where mobile=?";
    $res=$connect->prepare($getcode);
      $res->bind_param("i",$number);
      $res->execute();
      $result =$res->get_result();
      if ($result->num_rows > 0) {
       while  ($row =$result->fetch_assoc()) {
        $otp_code=$row['otp_code'];
        $expire=$row['expire_time'];
       } 
    }
    else {
        echo "not registered number";
    }
} else {
    echo "Session variable 'mobile_no' is not set. Please log in again.";
}

if($_SERVER['REQUEST_METHOD']=='POST'){//req to server for post method
// $sql="select otp_code from otp where otp_code=?";
if (isset($_POST['otpverify'])) {
    $otpverify = $_POST['otpverify'];
    
    date_default_timezone_set('Asia/Kolkata'); 
    $current_Time= date("h:i:s");
    echo "$current_Time<br>  $expire";
//mobile number verify:::::::::::::::::::::::::::::::::::::::::::::::::::::::
$sql="SELECT otp_code from otp WHERE otp_code= ?";

$statement=$connect->prepare($sql);
$statement->bind_param("s",$otpverify);
$statement->execute();
$result =$statement->get_result();

if ($result->num_rows > 0) {
    $data =$result->fetch_assoc();
   if ($current_Time == $expire) {                
    echo "Expire OTP";
    
    } else {                
        echo "Times are equal.";
        header("location:selectCentre.php");
      exit();
          $successMessage="Valid OTP";
    }
}
else {

    $errorMessage= "Invalid OTP";
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
</head>

<body class="patient-page">
    <div class="container">
   
            <a href="patient-login.php" 
             class="btn btn-primary">Back To Home</a><br>
        <form action="" method="post">
         
            <h3>Enter OTP</h3>
            OTP Verify <?php echo "$otp_code " ?>
            <input type="text"  class="form-control" name="otpverify" maxlength="6" required>
           <p class="error-message">
             <?php if (!empty($errorMessage)) {
            echo " $errorMessage"; 
           }?>
           </p>

           <button type="submit" name="get_otp" id="liveToastBtn" class="btn btn-primary">Verify OTP</button><br>
            <!-- <span>New Patient <a href='patient-signup.php'>Click Here</a>To Register</span> -->
        </form>
        </div>
        </body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
    </script>

</html>