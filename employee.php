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
        $stmt = $this->con->prepare("select * from employees where id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $res = $stmt->get_result();
        $result = $res->fetch_assoc();
        return $result;
    }
    public function store($data)
    {
        if (!isset($data["emp_name"], $data["emp_email"], $data["emp_phone"], $data["emp_salary"])) {
            return false;
        }

        $name = $data["emp_name"];
        $email = $data["emp_email"];
        $phone = $data["emp_phone"];
        $salary = $data["emp_salary"];

        $stmt_check = $this->con->prepare("select * from employees where name=?");
        $stmt_check->bind_param("s", $name);
        $stmt_check->execute();
        $res_check = $stmt_check->get_result();
        $rows = $res_check->num_rows;

        if ($rows > 0) {
            return false;
        } else {
            $stmt_insert = $this->con->prepare("insert into employees (name,email,phone,salary) values(?,?,?,?)");
            $stmt_insert->bind_param("sssd", $name, $email, $phone, $salary);
            $res = $stmt_insert->execute();
            if ($res) {
                return true;
            } else {
                return false;
            }
        }
    }

    public function update($id, $data)
    {
        if (!isset($data["emp_name"], $data["emp_email"], $data["emp_phone"], $data["emp_salary"])) {
            return false;
        }

        $name = $data["emp_name"];
        $email = $data["emp_email"];
        $phone = $data["emp_phone"];
        $salary = $data["emp_salary"];

        $stmt_update = $this->con->prepare("update employees set name=?, email=?, phone=?, salary=? where id=?");
        $stmt_update->bind_param("sssdi", $name, $email, $phone, $salary, $id);
        $res = $stmt_update->execute();
        if ($res) {
            return true;
        } else {
            return false;
        }
    }

    public function delete($id)
    {
        $stmt_delete = $this->con->prepare("delete from employees where id=?");
        $stmt_delete->bind_param("i", $id);
        $res = $stmt_delete->execute();
        if ($res) {
            return true;
        } else {
            return false;
        }
    }
}
