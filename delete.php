<?php
include_once 'User.php';
include_once 'StudentManager.php';
include_once 'DBConnect.php';

$studentManager = new StudentManager();
$id = $_GET['id'];
$student = $studentManager->getStudentById($id);
$image = $student->image;
unlink("upload/".basename($image));
$studentManager->delete($id, $image);

header("Location:index.php");