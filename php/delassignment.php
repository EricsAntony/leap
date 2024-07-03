<?php
include "config.php";
$aid = $_POST['id'];
$s="SELECT as_file from assignment where as_id='$aid'";
$result=mysqli_query($con,$s);
$row = mysqli_fetch_array($result);

$dir = $_SERVER['DOCUMENT_ROOT'] . "/mainProject/php/assignments_folder";
$data = $row['as_file'];

$sql = "DELETE FROM `assignment` WHERE as_id='$aid'";
$result = mysqli_query($con, $sql);
$sql1 = "DELETE FROM `document` WHERE d_asid = '$aid'";

if($row['as_file'] != ''){

unlink($dir . '/' . $data);
}


if ($result && mysqli_query($con, $sql1))
  echo "1";
else
  echo mysqli_error($con);
?>