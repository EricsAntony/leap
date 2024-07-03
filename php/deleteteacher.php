<?php
  include "config.php";

  $id = $_POST['id'];
  $sql = "DELETE FROM `teacher` WHERE t_id='$id'";
  $result=mysqli_query($con, $sql);

  if($result)
  echo "1";
else
  echo mysqli_error($con);
?>