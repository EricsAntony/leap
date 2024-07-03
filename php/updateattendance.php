<?php
include "config.php";
$aid=$_POST['aid'];
$p1 = $_POST['p1'];
$p2 = $_POST['p2'];
$p3 = $_POST['p3'];
$p4 = $_POST['p4'];
$p5 = $_POST['p5'];
$p6 = $_POST['p6'];

 $sql = "UPDATE `attendance` SET `a_p1`='$p1',`a_p2`='$p2',`a_p3`='$p3',`a_p4`='$p4',`a_p5`='$p5',`a_p6`='$p6' WHERE a_id='$aid'";  
 if(mysqli_query($con, $sql))
 echo "1";
 else
 echo mysqli_error($con);
?>