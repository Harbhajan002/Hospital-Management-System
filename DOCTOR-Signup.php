<style>
  input {
    width: 100%;
  }

  .secparent {
    /* width: 600px; */
    display: flex;

  }

  .parent {
    display: flex;
    margin: 30px;
    align-items: center;
    justify-content: center;

    /* width: 200px; */

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
    /* text-align: center; */
    margin: 10px;
    display: flex;
    /* flex-wrap: wrap; */
    /* width: 500px; */
    justify-content: center;

    height: auto;
    gap: 17px;
  }

  .slotdiv p {
    background-color: #F4EDCC;
    padding: 10px;
    border-radius: 20px;
    display: flex;
    /* Display labels in the same row */
    flex-direction: column;

    margin-bottom: 10px;
    /* Add some bottom margin for spacing */
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
    color:green;
  }
</style>
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
  <!-- <link rel="stylesheet" href="Hospital.css"> -->
  <title>Patient Table</title>
</head>
<body class="patient-page">


  <div class="parent">
    <div class="container2">
      <h2>Doctor Details</h2>
      <form action="" method="post">
        <div class="secparent">
          <div class="a1container">
            First Name<input type="text" class="form-control" placeholder="name" name="fname" required><br>
            Mobile No<input type="tel" class="form-control" placeholder="Number" name="mno" maxlength="15" required> <br>
            Email<input type="email" class="form-control" placeholder="email" name="email" required> <br>
          </div>
          <div class="a1container">
            Consultant Fees<input type="text" class="form-control" placeholder="Fee's" name="fees" required> <br>
            Select Center
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
        </div>
        <div class="btnn">
          <button type="submit" class="btn btn-primary">SIGN UP</button>
          <a href="DOCTOR-Login.php" class="btn btn-primary">LOG IN</a><br>
         <p class="success"> <?php if (!empty($success)) {
            echo $success; 
           }?><p>
        </div>

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