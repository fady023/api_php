<?php

require_once "./curl_helper.php";
require_once "conn.php";
require_once "employee.php";

$y = new employee($con);

$baseurl = "https://dummyjson.com/users?Limit=9";

try {
    $users = send_request($baseurl);
    $users =  json_decode($users, true);
    $five_users = array_slice($users["users"], 0, 5);
    foreach ($five_users as $user) {
        $y->store([
            "emp_name" => $user["firstName"],
            "emp_email" => $user["email"],
            "emp_phone" => $user["phone"],
            "emp_salary" => $user["age"],
        ]);
    }
} catch (Exception $e) {
    echo $e;
}
