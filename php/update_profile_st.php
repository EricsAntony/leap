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
  $batch = $_POST['batch'];
  $yoa = $_POST['yoa'];
  $admno = $_POST['admno'];
 
  
  $sql = "UPDATE student set s_name = '$name', s_email = '$email',s_phn = '$mobile',s_pass='$pwd', s_yoa = '$yoa', s_admno = '$admno',s_batch = '$batch' WHERE s_id = $id";
  $result=mysqli_query($conn, $sql);

  if($result)
  echo "1";
else
  echo "0";
?>