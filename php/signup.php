<?php

include "config.php";
$uname = mysqli_real_escape_string($con,$_POST['email']);
$mob = mysqli_real_escape_string($con,$_POST['mob']);
$pwd = mysqli_real_escape_string($con,base64_encode($_POST['pwd']));

if ($uname != ""){
    $sql_query = "update student set s_phn='".$mob."',s_pass='".$pwd."' where s_email='".$uname."' ";
    $result = mysqli_query($con,$sql_query);
    if($result)
    echo "1";
    else
    echo mysqli_error($con);
}
