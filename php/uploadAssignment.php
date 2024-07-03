<?php
include "config.php";

$sid = $_POST['as_sid'];
$asid = $_POST['as_id'];
$file_name = $_FILES['file_up']['name'];
if(isset($_POST['as_comment']))
{
    $comment = $_POST['as_comment'];
}
else
{
    $comment = "";
}
if ($file_name != '') {
    $file_tmp = explode(".", $_FILES["file_up"]["name"]);
    $newfilename = round(microtime(true)) . '.' . end($file_tmp);
    $_FILES["file_up"]["name"] = $newfilename;
    $targetfolder = "studentUpload_folder/";
    $targetfolder = $targetfolder . basename($_FILES['file_up']['name']);
    move_uploaded_file($_FILES['file_up']['tmp_name'], $targetfolder);
} else {
    $newfilename = "";
}

$query = "SELECT * FROM document where d_asid = $asid and d_sid = $sid";
$val = mysqli_query($con, $query);
$row = mysqli_fetch_assoc($val);
if (mysqli_num_rows($val) >= 1) {
    $dir = $_SERVER['DOCUMENT_ROOT'] . "/mainProject/php/studentUpload_folder";
    $data = $row['d_name'];

    unlink($dir . '/' . $data);

    $sql = "UPDATE document SET d_name='$newfilename',d_date=NOW()";
    $result = mysqli_query($con, $sql);
} else {
    $sql = "INSERT INTO document (d_sid,d_asid,d_name,d_date,d_comment) VALUES ('$sid','$asid','$newfilename',NOW(),'$comment')";
    $result = mysqli_query($con, $sql);
}

if ($result)
    echo "1";
else
    echo mysqli_error($con);


?>