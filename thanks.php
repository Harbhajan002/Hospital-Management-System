<style>
    a{
        color:white;
    }

</style>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
<link rel="stylesheet" href="Hospital.css">
    
    <title>Document</title>
</head>

<body class="patient-page">
    <div class="admin" >
      <div class='result'>
         <a href="index.php"><button>Back To Home</button></a><br>
        </div>
       
            
        <div class="black-slotbox" action="" method="post" id="admin">
        <h2>Hi! Thank you </h2>
        <h3 class="text">You are successfully Registered</h3>
          <?php
        session_start();
        include("connect.php");
        echo "<br>";

         echo "<h5>Patient Name : ".$_SESSION['fname']."</h5>";
         echo "<br>";

        echo  "<h5>Your MR. No : ".$_SESSION['mr']."</h5>"; ?>
        
        
            <a href="patient-login.php" class="btn btn-primary">Book</a>
       
        </div>
       
    </div>
</body>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

</html>