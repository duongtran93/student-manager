<?php

class StudentManager
{
    protected $conn;

    public function __construct()
    {
        $db = new DBconnect('mysql:host=localhost;dbname=student_manager', 'root', 'ngocduong93');
        $this->conn = $db->connect();
    }

    public function getAll()
    {
        $sql = "SELECT * FROM Staffs";
        $stmt = $this->conn->query($sql);
        $result = $stmt->fetchAll();
        $staffs = [];
        foreach ($result as $value) {
            $staff = new User($value['name'], $value['phone'], $value['address']);
            $staff->id = $value['id'];
            array_push($staffs, $staff);
        }
        return $staffs;
    }

    public function add($student)
    {
        $stmt = $this->conn->prepare('INSERT INTO Staffs(name, phone, address) VALUES (:name , :phone, :address)');
        $stmt->bindParam(':name', $student->name);
        $stmt->bindParam(':phone', $student->phone);
        $stmt->bindParam(':address', $student->address);
        $stmt->execute();
    }

    public function delete($index)
    {
        $stmt = $this->conn->prepare('DELETE FROM Staffs WHERE id=:id');
        $stmt->bindParam(':id', $index);
        $stmt->execute();
    }
}