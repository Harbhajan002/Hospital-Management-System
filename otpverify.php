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
    // echo "$current_Time<br>  $expire";
//mobile number verify:::::::::::::::::::::::::::::::::::::::::::::::::::::::
$sql="SELECT otp_code from otp WHERE otp_code= ? and expire_time = ?";

$statement=$connect->prepare($sql);
$statement->bind_param("ss",$otpverify, $expire);
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
    <link rel="icon" type="image/png" sizes="16x16" href="./assets/lgo-removebg.png">

    <title>Patient Table</title>
    <style>
        p{
            margin-bottom:0px;
        }
        p span{
            margin-left:20px;
         letter-spacing: 10px;
        }
        span img{
            width: 20px;
            height:20px;
        }
    </style>
</head>

<body class="patient-page">
        <div class="admin">
        <div class='result'>
         <a href="patient-login.php"><button>Back To Home</button></a><br>
        </div>
        <h2>Enter OTP</h2>
        <form class="black-section" action="" method="post" id="admin">
         <p>Code:   <span id="otpDisplay"><img src="./assets/load.gif" alt=""></span></p>
          
                    <script>
                    setTimeout(function() {
                    // Replace '123456' with the actual OTP code from your PHP variable
                    document.getElementById('otpDisplay').textContent = "<?php echo $otp_code; ?>";
                    }, 5000); // 5000 milliseconds = 5 seconds
                    </script>
            <label class="filled" for="name"> Verify Code</label>
            <input type="text" id="name" name="otpverify"  maxlength="6"  required>

           
            <p class="btn_submit"><button type="submit" id="btn_submit">Login</button></p><br>
            
            <span class="msg">
            <?php if (!empty($errorMessage)) {
            echo " <p class='error-message'> $errorMessage </p>";  
           } 
           if (!empty($successMessage)) {
            echo "<p class='success-message'> $successMessage </p>"; 

           }?>
            </span><br>
            

        </form>
        </div>
        </body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
    </script>

</html>