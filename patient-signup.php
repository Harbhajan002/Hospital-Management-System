<?php
session_start();
include ('connect.php');
if ($_SERVER["REQUEST_METHOD"] == "POST") {
$centername=$_POST['centername'];
$fname= $_POST['fname'];
$lname= $_POST['lname'];
$gender= $_POST['gender'];
$mno= $_POST['mno'];
$email=$_POST['email'];
$dob=$_POST['dob'];
$address=$_POST['address'];
$state=$_POST['state'];
$city=$_POST['city'];
$pin=$_POST['pin'];
$random=random_int(100000, 999999);
$val=1;
++$val;
$num=$val; 
$mr="HOS".$random."00".$num;
 
$_SESSION['fname']=$fname;
$_SESSION['mr']=$mr;
$_SESSION['MR_no']=$mr;





$sql="insert into patient (select_center, fname, lname ,gender, mobile , email, dob, address, state, city, pincode, mr ) values (?,?,?,?,?,?,?,?,?,?,?,?)";
$stmt = $connect->prepare($sql);
    $stmt->bind_param("ssssssssssss",$centername, $fname, $lname, $gender, $mno, $email, $dob, $address, $state, $city, $pin, $mr);

    if ($stmt->execute()) {
      header("location:thanks.php");
    } else {
        echo "Error: " . $sql . "<br>" . $connect->error;
    }

    $stmt->close();
    $connect->close();
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="Hospital.css">
    <title>Patient Table</title>
</head>
<body class="patient-page">
  <div class="admin">
    <div class='result'>
         <a href="index.php"><button>Back To Home</button></a><br>
        </div>
        <h2>Patient Resgistration Here... </h2>
        <form class="black-section" action="" method="post" >
        <!-- <form action="" method="post"> -->
         Select Center
         <select name="centername" id="" class="form-select">
            <?php
            $sql="SELECT name from centre_name";
            $res=$connect->query($sql);
            if ($res->num_rows>0) {
              while ( $data=$res->fetch_assoc()) {
                echo "<option>".$data['name']."</option>";
              } 

            }
            ?>
         </select>
         First Name<input type="text" class="form-control"placeholder="name" name="fname" required>
         Last Name<input type="text" class="form-control"placeholder="name" name="lname" required>
         Select Gender<select name="gender" id="" class="form-select">
            <option value="male">Male</option>
            <option value="female">Female</option>
         </select>
         Mobile No<input type="tel" class="form-control" placeholder="Number" name="mno" required>  <br>
         Email<input type="email" class="form-control" placeholder="email" name="email" required>  <br>
         DOB<input type="date" class="form-control" placeholder="yy-mm-dd" name="dob" required>  <br>
         Address<br><textarea id="w3review" name="address" rows="4" cols="50"></textarea><br>
         State<input type="text" class="form-control" name="state" required>  <br>
         City<input type="text" class="form-control"  name="city" required>  <br>
         Pincode<input type="text" class="form-control"  name="pin" required>  <br>
       
         <button type="submit" >SIGN UP</button>
         <button type="submit" >
            <a href="patient-login.php" >LOG IN</a></button>
       
        </form> 
    </div>
</div>
<!--  -->
   
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</html>