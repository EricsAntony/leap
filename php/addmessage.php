<?php
include "config.php";

$cid = $_POST['cid'];
$sid = $_POST['sid'];
$msg = $_POST['msg'];



$sql = "INSERT INTO `message` (m_cid, m_sid, m_msg, m_date) VALUES ('$cid','$sid','$msg',NOW())";
$result = mysqli_query($con, $sql);

if ($result)
  echo "1";
else
  echo mysqli_error($con);



?>