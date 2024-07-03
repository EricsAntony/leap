<?php
include "config.php";
$s_id=$_POST['s_id'];
$adm_no=$_POST['adm_no'];
$s_name=$_POST['s_name'];
$email=$_POST['email'];
$mob1=$_POST['mob1'];
$batch=$_POST['batch'];
$yoa=$_POST['yoa'];

 $sql = "UPDATE `student` SET`s_name`='$s_name',`s_email`='$email',`s_admno`='$adm_no',`s_phn`='$mob1',`s_batch`='$batch',`s_yoa`='$yoa' WHERE s_id='$s_id'";  
 if(mysqli_query($con, $sql))
 echo "1";
 else
 echo mysqli_error($con);
?>