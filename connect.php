<?php
  $host='localhost';
  $db_name='hospital';
  $user='root';
  // $password='mysql@333$harbhajan';
  $password='8816839205';


  $connect= new mysqli($host, $user, $password, $db_name);

  if(!$connect){
    die("error to connect database");
  }
 ?>