<?php
include_once 'DBConnect.php';
include_once 'User.php';
include_once 'StudentManager.php';

$studentManager = new StudentManager();
$id = $_POST['id'];
$image = $studentManager->getStudentById($id);
$imageName = $image->image;

if ($_FILES['image']['error'] == 4) {
    $name = $_POST['name'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];
    $student = new User($name, $phone, $address, $imageName);
    $studentManager->update($id,$student);


} else if ($_FILES['image']['error'] == 0) {
    unlink("upload/".basename($imageName));
    $name = $_POST['name'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];
    $images = $_FILES['image']['name'];
    $tmp_dir = $_FILES['image']['tmp_name'];
    $upload_dir = "upload/".date('y_m_d_h_i_s_a').basename($images);
    move_uploaded_file($tmp_dir, $upload_dir);
    $student = new User($name, $phone, $address, $upload_dir);
    $studentManager->update($id,$student);

}

header("Location:index.php");