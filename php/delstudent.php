<?php
  include "config.php";

  $id = $_POST['delid'];

  $sql = "DELETE FROM `student` WHERE s_id='$id'";
  $result=mysqli_query($con, $sql);

  if($result)
  echo "1";
else
  echo mysqli_error($con);
?>