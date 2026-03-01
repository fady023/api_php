<?php 

require_once "./curl_helper.php";
$baseurl = "https://dummyjson.com//users";

try{
    $users = send_request($baseurl);
    json_encode($users,true);


}catch(Exception $e){ echo $e;

}




?>