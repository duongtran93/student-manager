<?php
include_once 'User.php';
include_once 'DBconnect.php';
include_once 'StudentManager.php';

$studentManager = new StudentManager();
$index = $_GET['id'];

$stmt = $studentManager->showEdit($index);
$name = $stmt['name'];
$phone = $stmt['phone'];
$address = $stmt['address'];

?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<form action="update.php" method="post">
    <table>
        <tr>
            <td><input type="text" name="id" value="<?php echo $index ?>"></td>
        </tr>
        <tr>
            <td>Name:</td>
            <td><input type="text" name="name" value="<?php echo $name ?>"></td>
        </tr>
        <tr>
            <td>Phone:</td>
            <td><input type="text" name="phone" value="<?php echo $phone ?>"></td>
        </tr>
        <tr>
            <td>Address:</td>
            <td><input type="text" name="address" value="<?php echo $address ?>"></td>
        </tr>
        <tr>
            <td>
                <input type="submit" value="Update">
            </td>
        </tr>
    </table>

    <table border="1">
        <tr>
            <td>STT</td>
            <td>Name</td>
            <td>Phone</td>
            <td>Address</td>
        </tr>

        <?php
        $students = $studentManager->getAll();
        foreach ($students as $key => $value): ?>
            <tr>
                <td><?php echo ++$key ?></td>
                <td><?php echo $value->name ?></td>
                <td><?php echo $value->phone ?></td>
                <td><?php echo $value->address ?></td>
            </tr>
        <?php endforeach; ?>
    </table>
</form>
</body>
</html>
