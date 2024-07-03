<?php
include "config.php";
$aid=$_POST['aid'];
$p1 = $_POST['p1'];
$p2 = $_POST['p2'];
$p3 = $_POST['p3'];
$p4 = $_POST['p4'];
$p5 = $_POST['p5'];
$p6 = $_POST['p6'];

 $sql = "UPDATE `att` SET `at_p1`='$p1',`at_p2`='$p2',`at_p3`='$p3',`at_p4`='$p4',`at_p5`='$p5',`at_p6`='$p6' WHERE at_id='$aid'";  
 if(mysqli_query($con, $sql))
 echo "1";
 else
 echo mysqli_error($con);
?>