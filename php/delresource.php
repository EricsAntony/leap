<?php
include "config.php";
$aid = $_POST['id'];
$s="SELECT r_file from resources where r_id='$aid'";
$result=mysqli_query($con,$s);
$row = mysqli_fetch_array($result);

$dir = $_SERVER['DOCUMENT_ROOT'] . "/mainProject/php/resources_folder";
$data = $row['r_file'];

$sql = "DELETE FROM `resources` WHERE r_id='$aid'";
$result = mysqli_query($con, $sql);

if($row['r_file'] != ''){

unlink($dir . '/' . $data);
}


if ($result )
  echo "1";
else
  echo mysqli_error($con);
?>