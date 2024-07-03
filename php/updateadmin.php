<?php
include "config.php";
$id=$_POST['id'];
$current_id=$_POST['current_tid'];


 $sql = "UPDATE `teacher` SET `t_role`='1' where t_id='$id'";  
 $sql1 = "UPDATE `teacher` SET `t_role`='0' where t_id='$current_id'";
 if(mysqli_query($con, $sql) && mysqli_query($con, $sql1))
 echo "1";
 else
 echo mysqli_error($con);
?>