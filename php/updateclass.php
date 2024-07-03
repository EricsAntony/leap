<?php
include "config.php";
$sub_id=$_POST['sub_id'];
$sub_name=$_POST['sub_name'];
$sub_batch=$_POST['sub_batch'];
$sub_yoa=$_POST['sub_yoa'];


 $sql = "UPDATE `class` SET`c_name`='$sub_name',`c_batch`='$sub_batch',`c_yoa`='$sub_yoa' WHERE c_id='$sub_id'";  
 if(mysqli_query($con, $sql))
 echo "1";
 else
 echo mysqli_error($con);
?>