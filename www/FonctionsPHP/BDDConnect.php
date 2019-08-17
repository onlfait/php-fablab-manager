<?php session_start();

include("config.php");
$connect=mysqli_connect($host, $user, $pass, $bdd) or die("Connection failed: " . mysqli_connect_error());
mysqli_query($connect,"SET NAMES UTF8");

return $connect;
