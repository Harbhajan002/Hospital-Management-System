<style>
 
   #DEPART{
   width:370px;
   font-size: 1rem;
    font-weight: 400;
    line-height: 1.5;
    padding: 0.375rem 2.25rem 0.375rem 0.75rem;
    border-color: #86b7fe;
    outline: 0;
    border-radius: var(--bs-border-radius);
    box-shadow: 0 0 0 0.25rem rgba(13,110,253,.25);
    
}
</style>
<select name="department"  class="form-select" id="department">
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
   <br><div class='doctor' id="doctor">
   </div>
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

<script type="text/javascript">
    $(document).ready(function () {
        $('#department').on('change', function () {
            var department_id = $(this).val();
           
            console.log("department_id", department_id);
            $.post('doctor.php', { D_ID: department_id}, 
            function (response) {
                $('#doctor').html(response);
              
            });
          
        });
    });

</script>