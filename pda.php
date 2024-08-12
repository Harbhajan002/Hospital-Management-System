<?php
  include ("connect.php");
  $action = $_POST['action'];
  echo $action;
if ($action === 'cancel') {
    $doctor_id=$_POST['Did'];
    $slot_id=$_POST['Sid'];
    $pid=$_POST['Pid'];
    $slot_time = $_POST['Time'];
    $date = $_POST['Date'];
    //date to day conversion
    $timestamp = strtotime($date);
    $day = date("l", $timestamp);
   
   
    echo "Received Time: $doctor_id, Date: $slot_id $pid $slot_time $date";

    $delete_appoint="DELETE from appointment where patient_id=? and doctor_id=? and
        appoint_date=? and appoint_time=?";
           $result=$connect->prepare($delete_appoint);
           $result->bind_param("iiss",$pid,$doctor_id,$date,$slot_time);
           $result->execute();
           if ($result->execute()) {
            echo "deleted appointment";
           }
           else {
            echo "Failed to cancel appointment";
            }
           
          } elseif ($action === 'update'){
            //updated data in all table after remove appointed slot time

            echo "updated slot 1";
            // $selectBookAppointment=" SELECT * from doctor_slot_availablity where
            // doctor_id=? and sl_date=?";
            // $statement=$connect->prepare($selectBookAppointment);
            //     $statement->bind_param("is",$doctor_id,$date);
            //     $statement->execute();
            //     $result =$statement->get_result();                
            // if ($result->num_rows > 0) {
            //  echo "A";
            //     $data =$result->fetch_assoc(); 
            //     $availableslot =$data['avilable_slot'];
            //     $timeArray = json_decode($availableslot); 
               
            //     if(($key=array_search($slot_time, $timeArray))!== false){
            //           unset($timeArray[$key]);
            //     }
            //     $updateSlot= json_encode(array_values($timeArray));
            //     echo $updateSlot;
            //     $updated=$connect->prepare("UPDATE doctor_slot_availablity set avilable_slot=?
            //     where doctor_id=? and sl_date=?");
            //     $updated->bind_param("sis",$updateSlot,$doctor_id,$date);
            //     $updated->execute();
            //     echo "slot updated";

            // } else{
            
            //      echo "B";
            //     //select unBookeddataslot
            //     $timestamp = strtotime($date);
            //     $day = date("l", $timestamp);
            //     $unBookeddataslot="SELECT * from unBookeddataslot where  doctor_id=? and slot_date=?";
            //     $res=$connect->prepare($unBookeddataslot);
            //     $res->bind_param("is", $doctor_id, $date);
            //     $res->execute();

            //      $stmt=$res->get_result();                
            //     if ($stmt->num_rows > 0) {
            //      echo "b1<br>";
            //      $data =$stmt->fetch_assoc(); 
            //      $unBook_slot =json_decode($data['unBook_slot']);
            //      if(($key=array_search($slot_time, $unBook_slot))!== false){
            //        unset($unBook_slot[$key]);
            //      }
            //       $updateunBook_slot= json_encode(array_values($unBook_slot));
            //       //update unBookeddataslot
            //       $unBookupdated="UPDATE unBookeddataslot set unBook_slot=?
            //      where slot_date =? and doctor_id=?";
            //      $updated=$connect->prepare($unBookupdated);
            //      $updated->bind_param("ssi",$updateunBook_slot, $date, $doctor_id);
            //      if ( $updated->execute()) {
            //        echo "updated successfully";
            //      }else{
            //       echo "not updated";
            //       }
            //    }else{
            //      echo "b2<br>";
            //      $doctor_slot_array="SELECT slot_id from doctor where doctor_id=$doctor_id";
            //      $result=$connect->query($doctor_slot_array);
            //      if ($result->num_rows>0 ) {
            //           $data=$result->fetch_assoc();
            //           $doc_slot_id=$data['slot_id'];
            //           echo $doc_slot_id;
            //           $sidArray = json_decode($doc_slot_id, true); 
                      
            //     $dateslot_slot_id="SELECT slot_id from dateslot where slot_Day='$day'";
            //     $result2=$connect->query($dateslot_slot_id);
            //     if ($result2->num_rows>0 ) {
            //          $data=$result2->fetch_assoc();
            //          $slot_id=$data['slot_id'];
            //          echo "$slot_id<br>";
            //          if (in_array($slot_id,$sidArray)) {
            //            echo "selected slot id: $slot_id";
            //            $time_slot="SELECT slot_id, slot_Time from dateslot where slot_id=$slot_id";
            //            $res=$connect->query($time_slot);
            //            if ($res->num_rows>0) {
            //              while ( $d=$res->fetch_assoc()) {
            //                $slot_id=$d['slot_id'];
            //                echo  " <input type='hidden' id='slot_id' value='$slot_id'>";
            //                $timeArray=json_decode($d['slot_Time']);
            //    //
            //         if(($key=array_search($slot_time, $timeArray))!== false){
            //          unset($timeArray[$key]);
            //          }
            //           $updateSlot= json_encode(array_values($timeArray));
            //           echo    $updateSlot;  
            //              };
            //            }
            //          }else{
            //            echo "not any available slot";
            //          }

            //            }
            //         } else{                
            //         echo "no slot available";
            //         }
            //                  //insert into new table unBookedDataSlot
            //                  $unbookslot ="INSERT into unBookeddataslot (slot_id,doctor_id, slot_date, unBook_slot)
            //                  values (?,?,?,?)";
            //                 $res=$connect->prepare($unbookslot);
            //                          $res->bind_param("iiss", $slot_id, $doctor_id, $date, $updateSlot);
            //                 if ( $res->execute()) {
            //                    echo "dateSlot slot inserted<br>";
            //                  }else{
            //                    echo "data not inserted";
            //                  }
            //             }
            // }
           }else{
            echo "pda not cancle";
           }
  ?>