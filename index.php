<?php 

require_once "./curl_helper.php";
$baseurl = "https://dummyjson.com/users";

try{
    $users = send_request($baseurl);
   $users =  json_decode($users,true);

    foreach($users['users'] as $user){
        echo $user["firstName"]."<br>";
    }


}catch(Exception $e){ echo $e;

}




?>