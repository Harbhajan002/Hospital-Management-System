
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="Hospital.css">
    <link rel="icon" type="image/png" sizes="16x16" href="./assets/lgo-removebg.png">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <title>Patient Table</title>
    <style>
 @media  screen and (max-width: 1023px) {

    .admin .black-section {
        padding: 25px;
    }
 }
</style>
</head>

<body class="patient-page">
    <div class="admin">
        <div class='result'>
         <a href="patient-login.php"><button>Back To Home</button></a><br>
        </div>
        <h2>Book Appointment</h2>
        <div class="black-section">
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
        </div>

        
    </div>
        <div class="admin" id="data">
        
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