<?php
include_once 'User.php';

class StudentManager
{
    protected $conn;

    public function __construct()
    {
        $db = new DBConnect('mysql:host=localhost;dbname=student_manager', 'root', 'ngocduong93');
        $this->conn = $db->connect();
    }

    public function getAll()
    {
        $sql = "SELECT * FROM Staffs";
        $stmt = $this->conn->query($sql);
        $result = $stmt->fetchAll();
        $staffs = [];
        foreach ($result as $value) {
            $staff = new User($value['name'], $value['phone'], $value['address'], $value['image']);
            $staff->id = $value['id'];
            array_push($staffs, $staff);
        }
        return $staffs;
    }

    public function add($student)
    {
        $stmt = $this->conn->prepare('INSERT INTO Staffs(name, phone, address, image) VALUES (:name , :phone, :address, :image)');
        $stmt->bindParam(':name', $student->name);
        $stmt->bindParam(':phone', $student->phone);
        $stmt->bindParam(':address', $student->address);
        $stmt->bindParam(':image', $student->image);
        $stmt->execute();
    }

    public function delete($id, $image)
    {
        $stmt = $this->conn->prepare('DELETE FROM Staffs WHERE id=:id');
        $stmt->bindParam(':id', $id);
        $stmt->execute();
    }

    public function getStudentById($id)
    {

        $stmt = $this->conn->prepare('SELECT name,phone,address, image FROM Staffs WHERE id=:id');
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        $student =  $stmt->fetch();
        $name = $student['name'];
        $phone = $student['phone'];
        $address = $student['address'];
        $image = $student['image'];
        $student = new User($name, $phone, $address, $image);
        return $student;

    }

    public function update($id, $student)
    {
        $stmt = $this->conn->prepare('UPDATE Staffs SET name=:name,phone=:phone,address=:address,image=:image WHERE id=:id');
        $stmt->bindParam(':name', $student->name);
        $stmt->bindParam(':phone', $student->phone);
        $stmt->bindParam(':address', $student->address);
        $stmt->bindParam(':image', $student->image);
        $stmt->bindParam(':id', $id);
        $stmt->execute();

    }
}