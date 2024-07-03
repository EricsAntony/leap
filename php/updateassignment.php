<?php
include "config.php";
$ass_id = $_POST['assid'];
$aname = $_POST['topic'];
$ddate = $_POST['ddate'];
$des = $_POST['description'];
if (isset($_FILES['file_up']['name'])) {
    $s = "SELECT as_file from assignment where as_id='$ass_id'";
    $result = mysqli_query($con, $s);
    $row = mysqli_fetch_array($result);

    $dir = $_SERVER['DOCUMENT_ROOT'] . "/mainProject/php/assignments_folder";
    $data = $row['as_file'];
    unlink($dir . '/' . $data);

    $file_name = $_FILES['file_up']['name'];
    $file_tmp = explode(".", $_FILES["file_up"]["name"]);
    $newfilename = round(microtime(true)) . '.' . end($file_tmp);
    $_FILES["file_up"]["name"] = $newfilename;
    $targetfolder = "assignments_folder/";
    $targetfolder = $targetfolder . basename($_FILES['file_up']['name']);
    move_uploaded_file($_FILES['file_up']['tmp_name'], $targetfolder);
}



$sql = "UPDATE `assignment` SET `as_duedate`='$ddate',`as_name`='$aname', `as_desc` = '$des', `as_file` = '$newfilename' WHERE  as_id='$ass_id'";
if (mysqli_query($con, $sql))
    echo 1;
else
    echo mysqli_error($con);
?>