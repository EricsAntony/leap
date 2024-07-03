<?php
include "config.php";
$qid=$_POST['id'];
$title=$_POST['title'];
$min=$_POST['min'];
$sec=$_POST['sec'];
$desc=$_POST['desc'];
$timer = $min.':'.$sec;


 $sql = "UPDATE `quiz` SET`q_title`='$title',`q_timer`='$timer',`q_desc`='$desc' WHERE q_id='$qid'";  
 if(mysqli_query($con, $sql))
 echo "1";
 else
 echo mysqli_error($con);
?>