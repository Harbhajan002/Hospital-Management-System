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
 </select><br>



