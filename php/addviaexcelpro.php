<?php
  $url='localhost';
  $username='root';
  $password='';
  $conn=mysqli_connect($url,$username,$password,"lms");
  
  
  $flag=0;

  $file = $_FILES['file']['tmp_name'];
  if ($file != '') {
   $handle = fopen($file, "r");
   $c = 1;
   while(($filesop = fgetcsv($handle, 1000, ",")) !== false)
   {
    $sql = mysqli_query($conn,"SELECT * FROM `student`");
    $name = $filesop[1];
    $email = $filesop[2];
    $adm_no= $filesop[0];
    $yoa=$filesop[4];
    $batch=$filesop[3];
    while($row=mysqli_fetch_assoc($sql))
    {
     
      if($email == $row['s_email'])
      $flag=1;
      
    }
    if($flag == 0)
    {
    $sql = "INSERT INTO student(s_name,s_email,s_admno,s_batch,s_yoa)values('$name','$email','$adm_no','$batch','$yoa')";
    $stmt = mysqli_prepare($conn,$sql);
    if(mysqli_stmt_execute($stmt))
    $m = 1;
    $c = $c + 1;
    }
    $flag=0;
  }
  echo 1;
}
else
{
  echo 2;
}




?>