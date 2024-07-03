<?php
include "config.php";
$cid = $_POST['id'];
$question = $_POST['question'];
$ans1 = $_POST['ans1'];
$ans2 = $_POST['ans2'];
$ans3 = $_POST['ans3'];
$ans4 = $_POST['ans4'];
$crct = $_POST['crct'];


 $sql = "UPDATE `quiz_questions` SET`qt_question`='$question',`qt_ans1`='$ans1',`qt_ans2`='$ans2',`qt_ans3`='$ans3',`qt_ans4`='$ans4',`qt_crct`='$crct' WHERE qt_id='$cid'";  
 if(mysqli_query($con, $sql))
 echo "1";
 else
 echo mysqli_error($con);
?>