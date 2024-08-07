<?php

include ('connect.php');//accept connection
if($_SERVER['REQUEST_METHOD']=='POST'){//req to server for post method

if (isset($_POST['docname'])) {
    $docname = $_POST['docname'];
//mobile number verify:::::::::::::::::::::::::::::::::::::::::::::::::::::::
$sql="SELECT doctor_id, name from doctor WHERE name= ?";
$statement=$connect->prepare($sql);
$statement->bind_param("s",$docname);
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

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <title>Patient Table</title>
    <style>

.parent{
    display:flex;
    border:1px solid blue;

  }
        .error-message {
            color: red;
        }
        .success-message {
            color: green;
        }

        

        
      
  button{
    margin:10px;
    border-radius: 2px;
    border:none;
  background-color: rgb(183, 230, 244);
    
    border:1px solid;
  }
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
.double{
    display:flex;
}
    </style>
</head>

<body class="patient-page">

  <div class="parent">
    <div class="container" id="kkk">
        <form action="" method="post">
            <?php if (!empty($successMessage)) {
                echo "<h3>Registered $doctor_name</h3>";
            }else{
                echo " <h3>Registered Doctor Login</h3>";
            } ?>
       
            Admin<input type="text" class="form-control" placeholder="adimn name" name="docname" required>
           
                <?php if (!empty($errorMessage)) {
            echo " <p class='error-message'> $errorMessage </p>";  
           } 
           if (!empty($successMessage)) {
            echo "<p class='success-message'> $successMessage </p>"; 

           }?>
            


            <button type="submit" name="get_otp" class="btn btn-primary">Login</button><br>



        </form>
        <?php if (!empty($successMessage)) {
                    //verify mobile number with patient table 
              echo "<br><div class='double'><button  class='btn btn-primary' id='doctor_slot'>Change slot</button>
             <button  class='btn btn-primary' id='appointments'>Appointments</button>
             </div>";

            }
           ?>
    </div>
    </div>

</body>

<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

<script type="text/javascript">
    $(document).ready(function () {
    
        $('#doctor_slot').on('click', function () {
            var seleted_doctor_id ='<?php echo $doctor_ID;?>';
         console.log(seleted_doctor_id);
            $.ajax({
                url: 'DOCTOR_slot.php',
                method: 'POST',
                 data: {select_d_id: seleted_doctor_id},
                success: function (response) {
                    $('#kkk').html(response);
                }
            });
        });
        $('#appointments').on('click', function () {
            var seleted_doctor_id ='<?php echo $doctor_ID;?>';
         
            $.ajax({
                url: 'DOCTOR_appointments.php',
                method: 'POST',
                 data: {select_d_id: seleted_doctor_id},
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