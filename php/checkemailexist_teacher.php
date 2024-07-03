<?php

include "config.php";
$uname = mysqli_real_escape_string($con,$_POST['username']);

$response = array( 
    'count' => 0, 
    'message' => '',
    'error'=>'' 
); 
if ($uname != ""){

    $sql_query = "select *  from teacher where t_email='".$uname."' ";
    $result = mysqli_query($con,$sql_query);
    
$count=0;
    while($row = mysqli_fetch_array($result)) 
    { 
        $count++;
}
}
echo $count;