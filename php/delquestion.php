<?php
include "config.php";
$sub_id = $_POST['id'];

$sql = "DELETE FROM `quiz_questions`  WHERE qt_id='$sub_id'";

if (mysqli_query($con, $sql))
    echo "1";
else
    echo mysqli_error($con);
?>