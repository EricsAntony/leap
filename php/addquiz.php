<?php
include "config.php";

$cid = $_POST['cid'];
$title = $_POST['title'];
$min = $_POST['min'];
$sec = $_POST['sec'];
$desc = $_POST['desc'];
$timer = $min.':'.$sec;


$sql = "INSERT INTO quiz (q_cid,q_title, q_timer, q_desc, q_createdate) VALUES ('$cid','$title','$timer','$desc',NOW())";
$result = mysqli_query($con, $sql);

if ($result)
  echo "1";
else
  echo mysqli_error($con);

  
?>