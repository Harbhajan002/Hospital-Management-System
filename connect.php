<?php

  // $host='sql110.infinityfree.com';
  // $db_name='if0_37115909_hospital';
  // $user='if0_37115909';
  // $password='AkRBIH401O';
  $host='localhost';
  $db_name='hospital';
  $user='root';
  $password='8816839205';
  $connect= new mysqli($host, $user, $password, $db_name);

  if(!$connect){
    die("error to connect database");
  }
 ?>