<?php
include "config.php";

$cid = $_POST['c_id'];
$topic = $_POST['topic'];
$des = $_POST['des'];


$sql = "INSERT INTO announcement (an_topic,an_desc,an_cid,an_date) VALUES ('$topic','$des','$cid',NOW())";
$result = mysqli_query($con, $sql);

if ($result)
  echo "1";
else
  echo mysqli_error($con);

  
?>