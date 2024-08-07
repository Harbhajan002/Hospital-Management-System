<style>
    a{
        color:white;
    }
    .btn{
        margin: 40px;
        width:80px;
        color:white;   
    }
    .container{
        display: flex;
        align-items: center;
        margin-top:80px;
        justify-content: center;

    }
    .card2{
        display: flex;
        align-items: center;
        justify-content: center;
        background-color: rgb(213, 213, 247);
        flex-direction: column;
        padding-top:20px;
        border-radius:10px;
        box-shadow: 1px 1px;

        border:1px solid rgb(203, 213, 247);
    }
   
    .cart2:hover{
        box-shadow: 2px 2px;
      
    }
    p{
        margin-left: 40px;
    }
    h3 .text{
        color: rgb(83, 83, 83);


    }
</style>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    
    <title>Document</title>
</head>
<body>
    <div class="container">
    <div class="card2" style="width:30rem;">
        <h2>Hi! Thank you </h2><br>
        <h3 class="text">You are successfully Registered</h3>
        <?php
        session_start();
        include("connect.php");
        echo "<br>";

         echo "<h5>Patient Name : ".$_SESSION['fname']."</h5>";
         echo "<br>";

        echo  "<h5>Your MR. No : ".$_SESSION['mr']."</h5>"; ?>
        
        
            <a href="selectCentre.php" class="btn btn-primary">Book</a>
       

    </div>
    </div>
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

</html>