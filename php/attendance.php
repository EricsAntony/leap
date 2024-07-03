<?php 
include_once 'config.php';
$c_id = $_POST['cid'];
$date=date('Y-m-d');

  foreach ($_POST['sid'] as $id => $sid)
    {
      $sql = "SELECT * FROM attendance WHERE a_sid='$sid' AND a_cid='$c_id' AND a_date='$date'";
      $q = mysqli_query($con, $sql);
      if(mysqli_num_rows($q) == '0')
      {
       
        $p1 = $_POST['p1'][$id];
        $p2 = $_POST['p2'][$id];
        $p3 = $_POST['p3'][$id];
        $p4 = $_POST['p4'][$id];
        $p5 = $_POST['p5'][$id];
        $p6 = $_POST['p6'][$id];
        
         
       $sql="INSERT INTO `attendance` (a_sid, a_cid, a_p1, a_p2, a_p3, a_p4, a_p5, a_p6, a_date) VALUES ( '$sid', '$c_id', '$p1', '$p2', '$p3', '$p4', '$p5', '$p6','$date')";
       mysqli_query($con, $sql);

  }
  else
  {
    $p1 = $_POST['p1'][$id];
    $p2 = $_POST['p2'][$id];
    $p3 = $_POST['p3'][$id];
    $p4 = $_POST['p4'][$id];
    $p5 = $_POST['p5'][$id];
    $p6 = $_POST['p6'][$id];
    
     
   $sql="UPDATE `attendance` SET a_sid='$sid', a_cid='$c_id', a_p1='$p1', a_p2='$p2', a_p3='$p3', a_p4='$p4', a_p5='$p5', a_p6='$p6', a_date='$date' WHERE a_sid='$sid' AND a_cid='$c_id' AND a_date='$date'";
   mysqli_query($con, $sql);
  }

}
header('location:../pages/admin/a_attendance.php?c_id='.base64_encode($c_id));
?>