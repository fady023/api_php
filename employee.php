<?php  

class employee{
    private $con;
    public function __construct($con){
        $this->con = $con;
    }

    public function get_emp(){
        $sql = "select * from employees";
    }
}






?>