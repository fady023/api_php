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
}
