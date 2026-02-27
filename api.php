<?php  
require "conn.php";
require "employee.php";


$x = new employee($con);



$method = $_SERVER['REQUEST_METHOD'];

$end_point  = $_SERVER['PATH_INFO'];

echo $method ."<br>" . $end_point ;




?>