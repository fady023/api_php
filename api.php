<?php
require "conn.php";
require "employee.php";


$x = new employee($con);

$method = $_SERVER['REQUEST_METHOD'];
$end_point  = $_SERVER['PATH_INFO'];

header("Content-Type:application/json");

switch ($method) {
    case "GET":
        if ($end_point === "/emp") {
            $emp = $x->get_emp();
            echo json_encode($emp);
            break;
        } elseif(preg_match('/^\/emp\/(\d+)$/',$end_point,$matches)) {
            $emp_id = $matches[1];
            $emp2 = $x->show_emp($emp_id);
            echo json_encode($emp2);
        }
}
