<?php
  $url='localhost';
  $username='root';
  $password='';
  $conn=mysqli_connect($url,$username,$password,"lms");
 

  $name = $_POST['name'];
  $email = $_POST['email'];
  $mobile = $_POST['mob'];
  $id = $_POST['id'];
  $pwd = base64_encode($_POST['pwd']);
 
  
  $sql = "UPDATE teacher set t_name = '$name', t_email = '$email',t_phn = '$mobile',t_pass='$pwd' WHERE t_id = $id";
  $result=mysqli_query($conn, $sql);

  if($result)
  echo "1";
else
  echo "0";
?>