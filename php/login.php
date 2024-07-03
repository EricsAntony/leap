<?php
session_start();
include "config.php";
$uname = mysqli_real_escape_string($con, $_POST['username']);
$password = mysqli_real_escape_string($con, base64_encode($_POST['password']));


if ($uname != "" && $password != "") {

    $sql_query = "select count(*) as cntUser,t_id, t_name, t_role from teacher where t_email='" . $uname . "' and t_pass='" . $password . "' and t_del = 0";
    $result = mysqli_query($con, $sql_query);
    $row = mysqli_fetch_array($result);
    $n = $row['t_name'];
    $count = $row['cntUser'];
    $id = $row['t_id'];
    $role = $row['t_role'];
    
   $sql_query2 = "select count(*) as cntUser,s_id, s_name  from student where s_email='" . $uname . "' and s_pass='" . $password . "'";
   $result2 = mysqli_query($con, $sql_query2);
   $row2 = mysqli_fetch_array($result2);

   $count2 = $row2['cntUser'];
   $sid = $row2['s_id'];
    $sname = $row2['s_name'];


    if ($count > 0 and $role == '1') {
        $_SESSION['teacher'] = $uname;
        $_SESSION['tid'] = $id;
        $_SESSION['tname'] = $n;
        $_SESSION['trole'] = $role;
        echo 1;
    } else if ($count2 > 0) {
        $_SESSION['student'] = $uname;
        $_SESSION['sid'] = $sid;
        $_SESSION['sname'] = $sname;
        echo 2;

    }else if($count > 0){
        $_SESSION['teacher'] = $uname;
        $_SESSION['tid'] = $id;
        $_SESSION['tname'] = $n;
        echo 3;

    }
    else {
        echo mysqli_error($con);
    }
}