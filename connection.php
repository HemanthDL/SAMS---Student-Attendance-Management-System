<?php
 $server = 'localhost';
 $username = 'root';
 $password = 'zeb in galaxy';
 $dbname='sams';
 
 $conn = mysqli_connect($server, $username, $password,$dbname);
 
 if ($conn->connect_error) {
     die('Connection failed: ' .$conn->connect_error);
 }
?>