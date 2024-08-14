<?php
include ('connect.php');
if ($_SERVER["REQUEST_METHOD"] == "POST") {
$fname= $_POST['fname'];
$mno= $_POST['mno'];
$email=$_POST['email'];
$fees= $_POST['fees'];
$centrename=$_POST['centrename'];
$department=$_POST['department'];
$slot_day=isset($_POST['day']) ? $_POST['day']: [];
$slotarray =json_encode($slot_day);

$doctor="INSERT INTO doctor (name, mobile, email, fees, centre_id, department_id, slot_id)
VALUES (?,?,?,?,?,?,?)";
$stmt=$connect->prepare($doctor);
$stmt->bind_param("ssssiis",$fname,$mno,$email,$fees,$centrename,$department,$slotarray);
if ($stmt->execute() ) {

  $success= 'Doctor Register Successfully.';
}else{
  $error= 'Please Enter Correct Information.';
}
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="Hospital.css">

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="icon" type="image/png" sizes="16x16" href="./assets/lgo-removebg.png">

  <title>Doctor Signup</title>
  <style>
    .doc-section{
      display: flex;
    flex-direction: column;
    width: 90%;
    border: 1px solid;
    padding: 40px;
    border-radius: 5px;
    background-color: black;
    opacity: 0.7;
    color: #fff;
    }
  input, select {
    width: 100%;
  }
  .secparent {
    display: flex;
  }
  .parent {
    display: flex;
    align-items: center;
    justify-content: center;
  }
  .container2 {
    display: flex;
    flex-direction: column;
    align-items: center;
    border: 1px solid;
    background-color: rgb(33 21 47);

    border-radius: 10px;
  opacity: 0.9;
  color:white;
  }

  .slotdiv {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    height: auto;
  }

  .slotdiv p {
    
    display: flex;
    flex-direction: column;
    align-items: center;
    border: 2px solid rgb(255, 150, 255);
    border-radius: 10px;
    font-size: 15px;
    background: #cf3fff;
    margin: 20px 20px 10px 0px;
    cursor: pointer;
    color: white;
    width: auto;
    padding:0px 5px;
  }
  .slotdiv p input{
    height:20px;
  }
  span {
    font-size: larger;
    font-weight: 600;
  }

  .btnn {
    display: flex;
    justify-content: center;

  }

  .btnn a {
    margin-left: 20px;
  }

  p {
    display: flex;
    flex-direction: column;
  }

  .a1container {
    width: 100%;
    margin: 20px;
  }
  .success{
    margin-top:10px;
    width: 100%;
    text-align:center;
    color: rgb(60 241 60);
  }
  @media (max-width:767px) {
    .secparent {
    flex-direction:column;
  }
  .a1container {
    margin: 0px;
  }
  .slotdiv {
    grid-template-columns: repeat(2, 1fr);
  }
  }

  </style>
</head>
<body class="patient-page">
  <div class="parent">
  
    <div class="admin">
    <div class='result'>
         <a href="index.php"><button>Back To Home</button></a><br>
        </div>
      <h2>Doctor Details</h2>
      <form class="doc-section" action="" method="post">
        <div class="secparent">
          <div class="a1container">
            First Name<input type="text" class="form-control" placeholder="name" name="fname" required><br>
            Mobile No<input type="tel" class="form-control" placeholder="Number" name="mno" maxlength="10" required> <br>
            Email<input type="email" class="form-control" placeholder="email" name="email" required> <br>
          </div>
          <div class="a1container">
            Consultant Fees<input type="text" class="form-control" placeholder="Fee's" name="fees" required> <br>
            Select Center <br>
            <select name="centrename" id="centreName" class="form-select">
              <option value='select'>Select Center</option>
              <?php
                    $sql="SELECT * from centre_name";
                    $res=$connect->query($sql);
                  
                    if ($res->num_rows>0) {
                      while ( $data=$res->fetch_assoc()) {
                        echo "<option value=".$data['centre_id'].">".$data['name']."</option>";
                        } 
                    }
             ?>
            </select><br><br>
            <div class="innercontainer" id="department">
            </div>
          </div>

        </div>
        <div class="slotdiv">
          <p> <input type="checkbox" name="day[]" id="checkbox_monday" value="1">
            <label for="checkbox_monday">Monday</label>
          </p>
          <p> <input type="checkbox" name="day[]" id="checkbox_tuesday" value="2">
            <label for="checkbox_tuesday">Tuesday</label>
          </p>
          <p> <input type="checkbox" name="day[]" id="checkbox_wednesday" value="3">
            <label for="checkbox_wednesday">Wednesday</label>
          </p>
          <p> <input type="checkbox" name="day[]" id="checkbox_thursday" value="4">
            <label for="checkbox_thursday">Thursday</label>
          </p>
          <p> <input type="checkbox" name="day[]" id="checkbox_friday" value="5">
            <label for="checkbox_friday">Friday</label>
          </p>
          <p> <input type="checkbox" name="day[]" id="checkbox_saturday" value="6">
            <label for="checkbox_saturday">Saturday</label>
          </p>
          <p> <input type="checkbox" name="day[]" id="checkbox_sunday" value="7">
            <label for="checkbox_sunday">Sunday</label>
          </p>
        </div>
        <div class="btnn">
          <button type="submit" >SIGN UP</button>
        
        </div>
        <p class="success"> <?php if (!empty($success)) {
            echo $success; 
           }?><p>
      </form>
    </div>

  </div>
</body>
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script>
  $(document).ready(function () {
    $('#centreName').on('change', function () {
      var centre_id = $(this).val();
      console.log("centre_id", centre_id);
      $.post('DOCTOR-depart.php', { C_ID: centre_id }, function (response) {
        $('#department').html(response);

      });
    });
  });
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
  integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

</html>