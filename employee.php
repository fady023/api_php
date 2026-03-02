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
        $sql = "select * from employees join departments on employees.dep_id=departments.id";
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

        $check_name = $this->con->query("select * from employees where name='$name'");
        $rows = $check_name->num_rows;

        if ($rows > 0) {
            return false;
        } else {
            $insert = "insert into employees (name,email,phone,salary,dep_id) values('$name','$email','$phone',$salary,1)";
            $res = $this->con->query($insert);
            if ($res) {
                return true;
            } else {
                return false;
            }
        }
    }

    public function destroy($id)
    {
        $sql = " delete from employees where id = '$id'";
        $res = $this->con->query($sql);
        if($res){return "deleted";}
        else{return "not deleted";}

    }

    public function update($id,$data)
    {
        $name = $data["name"];
        $email = $data["email"];
        $phone = $data["phone"];
        $salary = $data["salary"];

        $sql = "update employees set name='$name',email='$email',phone='$phone',salary='$salary' where id='$id'";

        $res = $this->con->query($sql);
        if($sql){
            return "updated";
        }else{return "not updated";}
    }
}
