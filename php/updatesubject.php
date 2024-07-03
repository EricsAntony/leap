<?php
include "config.php";
$sub_id=$_POST['sub_id'];
$sub_name=$_POST['sub_name'];



 $sql = "UPDATE `subject` SET`sub_name`='$sub_name' WHERE sub_id='$sub_id'";  
 if(mysqli_query($con, $sql))
 echo "1";
 else
 echo mysqli_error($con);
?>