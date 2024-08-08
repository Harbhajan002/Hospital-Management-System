<?php

include ('connect.php');//accept connection
session_start();
if($_SERVER['REQUEST_METHOD']=='POST'){//req to server for post method

if (isset($_POST['admin_name'])) {
    $adminName = $_POST['admin_name'];
    $unique_id = $_POST['unique_id'];
    $password = $_POST['password'];
    // echo $unique_id , $adminName, $password;
    // die();
        //mobile number verify:::::::::::::::::::::::::::::::::::::::::::::::::::::::
        $sql="SELECT  name from admin WHERE name= ? and email =? and password=?";
        $statement=$connect->prepare($sql);
        $statement->bind_param("sss",$adminName, $unique_id, $password);
        $statement->execute();
        $result =$statement->get_result();

        if ($result->num_rows > 0) {
            $data =$result->fetch_assoc();
            $admin_name=$data['name'];
            $_SESSION['admin_name']= $admin_name;

            header("location:dashboard.php");
                
        }else {
            $error_msg= "Enter Valid Details !!";
        }
 }
 } ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="Hospital.css">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <title>Admin Login</title>
    <style>
       
    </style>
</head>

<body class="patient-page">
 
    <div class="admin">
    <div class='result'>
         <a href="index.php"><button>Back To Home</button></a><br>
        </div>
        <h2>Admin Log In </h2>
        <form class="black-section" action="" method="post" id="admin">
            <label class="filled" for="name">Name</label>
            <input type="text" id="name" name="admin_name"  placeholder="Enter Your Name" required>

            <label class="filled" for="unique_id">Email</label>
            <input type="email" id="unique_id" name="unique_id" placeholder="Email" required>
            <label class="filled" for="pw">Password</label>
            <input type="password" id="pw" name="password" placeholder="Password" required>
            <span class="error">
                <?php ?>
            </span>

            <button type="submit" id="btn_submit">Log In</button><br>
            <span class="msg">
                <?php echo isset( $error_msg)?$error_msg: "";  ?>
            </span>

        </form>
    </div>
</div>
</body>

<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

<script type="text/javascript">
    $(document).ready(function () {

        $('#doctor_slot').on('click', function () {
            var seleted_doctor_id = '<?php echo $doctor_ID;?>';
            console.log(seleted_doctor_id);
            $.ajax({
                url: 'DOCTOR_slot.php',
                method: 'POST',
                data: { select_d_id: seleted_doctor_id },
                success: function (response) {
                    $('#kkk').html(response);
                }
            });
        });
        $('#appointments').on('click', function () {
            var seleted_doctor_id = '<?php echo $doctor_ID;?>';

            $.ajax({
                url: 'DOCTOR_appointments.php',
                method: 'POST',
                data: { select_d_id: seleted_doctor_id },
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