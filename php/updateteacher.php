<?php
include "config.php";
$id=$_POST['id'];
$name=$_POST['name'];
$email=$_POST['email'];
$phone=$_POST['phone'];


 $sql = "UPDATE `teacher` SET`t_name`='$name',`t_email`='$email',`t_phn`='$phone' where t_id='$id'";  
 if(mysqli_query($con, $sql))
 echo "1";
 else
 echo mysqli_error($con);
?>