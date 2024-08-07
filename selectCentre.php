<style>
    button {
        border: none;
    }

    #submit {
        width: 110px;
    }

    a {
        text-decoration: none;
        color: white;
    }

    .doctor {
        display: grid;
        grid-template-columns: 1fr 1fr;

    }

    .card {
        margin: 20px;
    }

    .container {
        display: flex;

        width: 400px;
        align-items: center;
        justify-content: center;
    flex-direction: column;
    margin: 40px;
    align-items: center;
 width: 600px;
 
    }
   

    span {
        color: rgb(56, 14, 88);

    }
</style>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="Hospital.css">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <title>Patient Table</title>
</head>

<body class="patient-page">

    <!-- select cender from hospital from -->
    <div class="container" >
        <button type="submit">
            <a href="patient-login.php" class="btn btn-primary">Back To Home</a>
        </button><br>
        <h3>Book Appointment</h3><br>

        <select name="hospitalname" id="centerName" class="form-select">
            <option value='select'>Select Center</option>
            <?php
                    include('connect.php');
                    $sql="SELECT * from centre_name";
                    $res=$connect->query($sql);
                    if ($res->num_rows>0) {
                      while ( $data=$res->fetch_assoc()) {
                        echo "<option value=".$data['centre_id'].">".$data['name']."</option>";
                        } 
                    }
                    ?>
        </select>
    <!-- </div> -->
        
        <div class="container" id="data">
            <!-- <form action="" method="post"> -->
                <!-- <div class="innercontainer" id="data">

                    
                </div> -->
                <!-- <input type="submit" id="submit" class="btn btn-primary" value="View Doctor"> -->

            <!-- </form> -->

        </div>
                </div>


</body>

<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

<script type="text/javascript">
    $(document).ready(function () {
        $('#centerName').on('change', function () {
            var centre_id = $(this).val();
            console.log("center_id", centre_id);
            $.post('depart.php', { C_ID: centre_id }, function (response) {
                $('#data').html(response);

            });
        });
    });





</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
    </script>

</html>




<!-- doctor table card -->