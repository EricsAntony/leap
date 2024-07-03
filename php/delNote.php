<?php
include "config.php";
$aid = $_POST['id'];
$s="SELECT * from notes where n_id='$aid'";
$result=mysqli_query($con,$s);
$row = mysqli_fetch_array($result);

$dir = $_SERVER['DOCUMENT_ROOT'] . "/mainProject/php/notes_folder";
$data = $row['n_fname'];

$sql = "DELETE FROM `notes` WHERE n_id='$aid'";
$result = mysqli_query($con, $sql);

unlink($dir . '/' . $data);



if ($result)
  echo "1";
else
  echo mysqli_error($con);
?>