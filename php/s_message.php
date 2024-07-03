<?php
include "config.php";

$cid = $_POST['c_id'];
$topic = $_POST['topic'];
$des = $_POST['des'];
$sid = $_POST['sid'];


$sql = "INSERT INTO announcement (an_topic,an_desc,an_cid,an_date,value,an_sid) VALUES ('$topic','$des','$cid',NOW(),'1','$sid')";
$result = mysqli_query($con, $sql);

if ($result)
  echo "1";
else
  echo mysqli_error($con);

  
?>