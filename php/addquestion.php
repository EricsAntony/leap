<?php
include "config.php";

$cid = $_POST['cid'];
$question = $_POST['question'];
$ans1 = $_POST['ans1'];
$ans2 = $_POST['ans2'];
$ans3 = $_POST['ans3'];
$ans4 = $_POST['ans4'];
$crct = $_POST['crct'];

$sql = "INSERT INTO quiz_questions (qt_eid,qt_question, qt_ans1, qt_ans2, qt_ans3,qt_ans4,qt_crct) VALUES ('$cid','$question','$ans1','$ans2','$ans3','$ans4','$crct')";
$result = mysqli_query($con, $sql);

if ($result)
  echo "1";
else
  echo mysqli_error($con);

  
?>