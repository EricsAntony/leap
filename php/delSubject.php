<?php
include "config.php";
$sub_id = $_POST['sub_id'];

$sql = "DELETE FROM `subject`  WHERE sub_id='$sub_id'";

if (mysqli_query($con, $sql))
    echo "1";
else
    echo mysqli_error($con);
?>