<?php 
    session_start();
    $patient_id=$_SESSION['patient_id'];
                 include ("connect.php");
                 if(isset($_POST['selected_time']) && isset($_POST['slot_id'])) {
                     
                     $doctor_id = $_POST['doctor_id'];
                     $slot_time = $_POST['selected_time'];
                     $slot_id = $_POST['slot_id'];
                     $date = $_POST['selected_date'];
                     $timestamp = strtotime($date);
                     $day = date("l", $timestamp);
                         $sql = "INSERT into appointment (patient_id, slot_id, doctor_id, appoint_date, appoint_time)
                         values(?,?,?,?,?)";
                         $result=$connect->prepare($sql);
                         $result->bind_param("iiiss", $patient_id, $slot_id, $doctor_id, $date, $slot_time);
                         $result->execute();
                    
                        //  stage 2
                      
                }else{ echo "not fetch data"; }
                
         ?>