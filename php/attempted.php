<?php
include 'config.php';
$sid=$_POST['sid'];
$q_id=$_POST['qid'];

$sql = mysqli_query($con, "SELECT * FROM quiz_attempted WHERE qat_sid = $sid AND qat_qid = $q_id");
if(mysqli_num_rows($sql) == 0)
{
    $query = mysqli_query($con, "INSERT INTO quiz_attempted (qat_qid, qat_sid) VALUES ('$q_id','$sid')");
    $query1 = mysqli_query($con, "INSERT INTO quiz_results (qr_qid, qr_sid) VALUES ('$q_id','$sid')");
}
if($query)
echo "1";
else
echo "0";