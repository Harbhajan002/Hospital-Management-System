<?php
  $host='localhost';
  $db_name='hospital';
  $user='root';
  // $password='mysql@333$harbhajan';
  $password='8816839205';
  // $host='sql110.infinityfree.com';
  // $db_name='if0_37107241_hospital';
  // $user='if0_37107241';
  // $password='harbhajan172002';

  $connect= new mysqli($host, $user, $password, $db_name);

  if(!$connect){
    die("error to connect database");
  }
 ?>