<?php
  $url='localhost';
  $username='root';
  $password='';
  $conn=mysqli_connect($url,$username,$password,"lms");
 

  $name = $_POST['name'];
  $email = $_POST['email'];
  $adm = $_POST['adm'];
  $yoa = $_POST['yoa'];
  $batch = $_POST['batch'];
 
  
  $sql = "INSERT INTO student (s_name,s_email,s_admno,s_batch,s_yoa,s_del) VALUES ('$name','$email','$adm','$batch','$yoa','0')";
  $result=mysqli_query($conn, $sql);

  if($result)
  echo "1";
else
  echo "0";
?>