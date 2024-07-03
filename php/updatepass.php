<?php
include 'config.php';
$email = $_POST['email'];
$pass = base64_encode($_POST['pass']);
$s = mysqli_query($con, "SELECT * from teacher where t_email='$email'");
if (mysqli_num_rows($s) > 0) {
    $sql = mysqli_query($con, "UPDATE teacher SET t_pass = '$pass' WHERE t_email = '$email'");
    if ($sql) {
        echo "1";
    } else {
        echo "0";
    }
}


$s = mysqli_query($con, "SELECT * from student where s_email='$email'");
if (mysqli_num_rows($s) > 0) {
    $sql = mysqli_query($con, "UPDATE student SET s_pass = '$pass' WHERE s_email = '$email'");
    if ($sql) {
        echo "1";
    } else {
        echo "0";
    }
}