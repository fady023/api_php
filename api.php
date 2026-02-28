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
           
        } elseif(preg_match('/^\/emp\/(\d+)$/',$end_point,$matches)) {
            $emp_id = $matches[1];
            $emp2 = $x->show_emp($emp_id);
            echo json_encode($emp2);
        } break;

        case "POST" :
            if($end_point==="/emp"){
                $data = json_decode(file_get_contents('php://input'),true);
               $emp = $x->store($data);
               if($emp){
                echo "data inserted";
               }else{
                echo "error in inserting ";
               }
            }break;

    case "PUT":
        if (preg_match('/^\/emp\/(\d+)$/', $end_point, $matches)) {
            $emp_id = $matches[1];
            $data = json_decode(file_get_contents('php://input'), true);
            $emp = $x->update($emp_id, $data);
            if ($emp) {
                echo "data updated";
            } else {
                echo "error in updating ";
            }
        }
        break;

    case "DELETE":
        if (preg_match('/^\/emp\/(\d+)$/', $end_point, $matches)) {
            $emp_id = $matches[1];
            $emp = $x->delete($emp_id);
            if ($emp) {
                echo "data deleted";
            } else {
                echo "error in deleting ";
            }
        }
        break;
}
