<?php
include "conn.php";
class employee
{
    private $con;
    public function __construct($con)
    {
        $this->con = $con;
    }

    public function get_emp()
    {
        $sql = "select * from employees";
        $res = $this->con->query($sql);
        $emp = array();
        while ($row = $res->fetch_assoc()) {
            $emp[] = $row;
        }
        return $emp;
    }

    public function show_emp($id)
    {
        $sql = "select * from employees where id = '$id'";
        $res = $this->con->query($sql);
        $result = $res->fetch_assoc();
        return $result;
    }
    public function store($data)
    {
        $name = $data["emp_name"];
        $email = $data["emp_email"];
        $phone = $data["emp_phone"];
        $salary = $data["emp_salary"];

        $insert = "insert into employees (name,email,phone,salary) values('$name','$email','$phone','$salary')";
        $this->con->query($insert);
    }
}
