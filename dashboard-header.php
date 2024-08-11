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
    
    header .logo2{
    float: left;
    padding-left: 30px;
        width:auto;
        display: flex;
        justify-content: space-between;
        }
        .logo2 img{
            width: 100px;
            height: 70px;
}

.main ul , li {
    width: 100%;
    display:flex;
    align-items:center;
    flex-direction:column;
}
.main ul li a{
    width: 80%;

}
.main ul li a button{
    width: 100%;

}
.main ul li button {
    width: 80%;
    border: 2px solid rgb(255, 150, 255);
    border-radius: 10px;
    font-size: 15px;
    background: #cf3fff;
    cursor: pointer;
    padding: 10px ;
    color:white;
}
table {
        width: 80%;
        border-collapse: collapse;
        margin: 20px 0;
        font-family: Arial, sans-serif;
    }

    table, th, td {
        border: 1px solid #ddd;
    }

    th, td {
        padding: 12px;
        text-align: left;
    }

    th {
        background-color: black;
        color: white;
        font-weight: bold;
    }

    td {
        background-color: rgb(160 159 163);
    }

    tr:hover {
        background-color: #ddd;
    }

    .status-cancel {
        background-color: #f44336; /* Red */
        color: white;
    }

    .status-finish {
        background-color: #4CAF50; /* Green */
        color: white;
    }

    /* Add a rounded border for the table */
    table {
        /* border-radius: 8px; */
        overflow: hidden;
    }

    /* Add a shadow effect to the table */
    table {
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    /* Add some spacing around the table */
    table {
        margin: 20px 0;
    }
    .menu2{
    width: auto;
    display:flex;
    justify-content:end
}
.menu2 a{
    margin-left:20px;
    color:black;
    
}
.menu2 a button{
    height: 35px;
    border: 2px solid rgb(255, 150, 255);
    border-radius: 10px;
    font-size: 15px;
    background: #cf3fff;
    padding: 0px 10px;
    margin-right: 20px;
    cursor: pointer;
    color: white;
    width: auto;
}

    @media (max-width:767px) {
        /* header section */
        .menu2{
    width: 70%;
    display:flex;
    justify-content:end
}
        /* main section */
        .main{
   
    flex-direction: column;
}
        .main .left{
    width: 100%;
    background-color: black;
    opacity: 0.7;
    color: #fff;
    height:auto;
        position:static;
    }

    .main .right{
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content:center;
        width: 100%;
        margin-left: 0px;
    }
    .logo2 h2{
        display: none;
    }
  .main .right  table{
        width: 100%;
    }
    
}

   </style>
</head>
<body class="patient-page">
 
     <div class="dashboard-header">
        <header>
            <div class="logo2">
                <a href="index.php"><img src="./assets/lgo-removebg.png" alt=""></a>
                <h2>HMS   </h2>
                <h2>Admin Dashboard</h2>
            </div>
            <div class="menu2">
                <h3>Welcome
                    <?=$name?>
                </h3>
                <a href="?logout"><button> Log Out</button>
                   </a>
            </div>
        </header>
    </div>