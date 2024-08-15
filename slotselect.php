
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="Hospital.css">
  <link rel="icon" type="image/png" sizes="16x16" href="./assets/lgo-removebg.png">

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  <title>Doctor slot </title>
</head>
<body class="patient-page">
<div class="admin">
        <div class='result'>
         <a href="patient-login.php"><button>Back To Home</button></a><br>
        </div>
        <h2>Doctor Details</h2>
        <div  class="black-slotbox">
        <?php
                   include ("connect.php");
                 //get doctor id  using url
                     $Doctorid=$_GET['doc_ID'];
                     $doctorinfo=" SELECT * from  
                     doctor dr join department dt on dr.department_id=dt.department_id 
                     where doctor_id=?";
                     $sql=$connect->prepare($doctorinfo);
                     $sql->bind_param("i",$Doctorid);
                     $sql->execute();
                     $result=$sql->get_result();
                     if ($result->num_rows>0) {
                       while ($row=$result->fetch_assoc()) {
                        
                            $doctor_id=$row['doctor_id'];
                            $doctor_name=$row['name'];
                            $Department_name=$row['depart_name'];
                       }  
                       echo "<div class='card1'  '>                    
                        <div class='card_body'>
                            <img src='./assets/images.jfif'>                        
                        </div>
                        <div class='card-body2'>  
                         <h4 class='card-title'> $doctor_name</h4></br>
                         <h6 class='card-title'> $Department_name</h6>         
                        </div>
                        </div>";
                      }
           
                 ?><br>
            <div class='card1' style=' border:none;'>
              <form action="" method="post">
              <label for="datetime">Select a date:</label>
                <input type="date" class="form-control" id="datetime" name="datetime" required>
              </form>
            </div>
            <div id="slots"  class='slot-result'>
            </div> 
        </div>

        
    </div>
<!-- jhhhk -->
  
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script>
  
            $(document).ready(function () {
              //Disable Previous date to current date
                     var today = new Date().toISOString().split('T')[0];
                     $('#datetime').attr('min', today);
        
              // When the input date value changes
              $('#datetime').change(function () {
                var selectedDate= $(this).val();
                var doctorId = <?php echo ($Doctorid); ?>;
                $.ajax({
                  url: 'allslot.php',
                  type: 'POST',
                  data: { doctor_Id: doctorId, Date:selectedDate },
                  success: function (response) {
                    $('#slots').html(response);
                    console.log(response);
                    
                  }
                });
              });
              
              $(document).on('click', '.btn', function () { 
                var selectedDate=$("#D_Date").val();
                var Doc_Id=$("#D_ID").val();
                var SlotId=$("#slot_id").val();
                 var slotTime = $(this).text();               
                 console.log("slotselect",selectedDate,SlotId,Doc_Id,slotTime);  
                 $.ajax({
                  url: 'pda.php',
                  type: 'POST',
                  data: { Time: slotTime, Date:selectedDate },
                  success: function(response) {
                  console.log("Response from patient_delete_appoint.php:", response);
                  // Handle success if needed
                     },
                     error: function(xhr, status, error) {
                         console.error("Error in AJAX request to patient_delete_appoint.php:", error);
                   // Handle error
                     }
             
                });   
               $.ajax({
                        url: 'appoint.php',
                        type: 'POST',
                        data: {
                            doctor_id: Doc_Id,
                            selected_time: slotTime,
                            slot_id: SlotId,
                            selected_date:  selectedDate,                          
                        },
                        success: function(response) {
                          window.location='appointment_Card.php?doctor_id=' + Doc_Id  + 
                          '&slot_id=' + SlotId + 
                          '&selected_date=' +selectedDate + 
                          '&selected_time=' +slotTime;
            }
        });
   
               });
              
           });  
</script>
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
  integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

</html>