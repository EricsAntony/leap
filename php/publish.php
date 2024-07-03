<?php
include "config.php";
$qid=$_POST['qid'];

 $sql = "UPDATE `quiz` SET `q_publish`='1' WHERE q_id='$qid'";  
 if(mysqli_query($con, $sql))
 echo "1";
 else
 echo mysqli_error($con);
?>