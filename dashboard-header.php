<!DOCTYPE html>

<?php
    session_start();
    if (!isset($_SESSION['admin_name'])) {
       header("location:admin-login.php");
       exit;
    }
    if (isset($_GET['logout'])) {
       session_destroy();
       header("location:admin-login.php");
       exit;
    }
     include("connect.php");
    // select current login admin name to display in dashboard
    if (isset($_SESSION['admin_name'])) {
        # code...
    }
    $admin_name= $_SESSION['admin_name'];
     $admin_query  = "SELECT name from admin where name= '$admin_name'";
     $stmt = $connect->query($admin_query );  
     if ($stmt->num_rows>0) {
      $data = $stmt->fetch_assoc();
      $name=$data['name'];
     }
     ?>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap-switch-button@1.1.0/css/bootstrap-switch-button.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap-switch-button@1.1.0/dist/bootstrap-switch-button.min.js"></script>
    <title>Document</title>
    <link rel="stylesheet" href="Hospital.css">
   <style>
    header{
        position: sticky;
    }
    header .logo2{
    float: left;
    padding-left: 30px;
        width:50%;
        display: flex;
        justify-content: space-between;
        align-items: center;
        }
        .logo2 img{
            width: 100px;
            height: 70px;
            margin-right:50px;
}

   </style>
</head>
<body>
 
     <div class="section-a">
        <header >
            <div class="logo2">
                <img src="./assets/lgo-removebg.png" alt="">
                <h2>HMS   </h2>
                <h2>Admin Dashboard</h2>
            </div>
            <div class="menu">
                <ul>
                <h3>Welcome
                    <?=$name?>
                </h3>
               
                <h3><a href="?logout">Log Out</a></h3>
                </ul>
            </div>
        </header>
    </div>
    <br>