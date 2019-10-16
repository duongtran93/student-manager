<?php
include_once 'User.php';
include_once 'DBConnect.php';
include_once 'StudentManager.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];
    $images = $_FILES['image']['name'];
    $tmp_dir = $_FILES['image']['tmp_name'];

    $upload_dir = "upload/".basename($images);
    $imgExt = strtolower(pathinfo($images,PATHINFO_EXTENSION));
    $picProfile = rand(1000, 1000000).".".$imgExt;
    move_uploaded_file($tmp_dir, $upload_dir);

    $student = new User($name, $phone, $address, $upload_dir);
    $studentManager = new StudentManager();
    $studentManager->add($student);
}
header("Location:index.php");