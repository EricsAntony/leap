<?php
include "config.php";

$sid = $_POST['r_subid'];
$topic = $_POST['r_name'];
if(isset($_FILES['r_file']['name']))
{
$file_name = $_FILES['r_file']['name'];
$file_tmp = explode(".", $_FILES["r_file"]["name"]);
$newfilename = round(microtime(true)) . '.' . end($file_tmp);
$_FILES["r_file"]["name"]=$newfilename;
$targetfolder = "resources_folder/";
$targetfolder = $targetfolder . basename($_FILES['r_file']['name']);
move_uploaded_file($_FILES['r_file']['tmp_name'], $targetfolder);
$sql = "INSERT INTO resources (r_subid,r_name,r_file) VALUES ('$sid','$topic','$newfilename')";
$result = mysqli_query($con, $sql);

if ($result)
  echo "1";
else
  echo mysqli_error($con);
}
else
{
    echo "3";
}




  
?>