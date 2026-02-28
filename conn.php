<?php  

$host ="localhost";
$user ="root";
$pass ="";
$db ="api_php_db";

$con = new mysqli($host,$user,$pass,$db);

if(!$con){
      die($con->error);
}




?>