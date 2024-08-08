<div class="black-section" >           
        <select name="department"  id="department">
        <option value='select'>Select Department</option>
        <?php           
        include("connect.php");                 
                    if(isset($_POST['C_ID'])) {
                        $centreId = $_POST['C_ID'];
                        $sql = "SELECT *  FROM department WHERE centre_id =  ?";
                        $stmt = $connect->prepare($sql);
                        $stmt->bind_param("i",$centreId);
                        $stmt->execute();
                        $result = $stmt->get_result();
                    if ($result->num_rows>0) {
                            while ($row = $result->fetch_assoc()) {
                            echo "<option value='". $row['department_id'] ."'>" . $row['depart_name'] . "</option>";
                        }
                        }
                    }     
                    ?>  
        </select>
 </div><br>
 <div class='doctor' id="doctor">
   </div>
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

<script type="text/javascript">
    $(document).ready(function () {
        $('#department').on('change', function () {
            var department_id = $(this).val();
           
            console.log("department_id", department_id);
            $.post('doctor.php', 
            { D_ID: department_id}, 
            function (response) {
                $('#doctor').html(response);
              
            });
          
        });
    });

</script>