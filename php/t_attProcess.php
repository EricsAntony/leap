<?php 
include_once 'config.php';
$date = $_POST['date'];


  foreach ($_POST['sid'] as $id => $sid)
    {
      $sql = "SELECT * FROM att WHERE at_sid='$sid' AND at_date='$date'";
      $q = mysqli_query($con, $sql);
      if(mysqli_num_rows($q) == '0')
      {
       
        $p1 = $_POST['p1'][$id];
        $p2 = $_POST['p2'][$id];
        $p3 = $_POST['p3'][$id];
        $p4 = $_POST['p4'][$id];
        $p5 = $_POST['p5'][$id];
        $p6 = $_POST['p6'][$id];
        
         
       $sql="INSERT INTO `att` (at_sid, at_p1, at_p2, at_p3, at_p4, at_p5, at_p6, at_date) VALUES ( '$sid', '$p1', '$p2', '$p3', '$p4', '$p5', '$p6','$date')";
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
    
     
   $sql="UPDATE `att` SET at_sid='$sid', at_p1='$p1', at_p2='$p2', at_p3='$p3', at_p4='$p4', at_p5='$p5', at_p6='$p6', at_date='$date' WHERE at_sid='$sid' AND at_date='$date'";
   mysqli_query($con, $sql);
  }

}
header('location:../pages/teacher/t_classes.php');
?>