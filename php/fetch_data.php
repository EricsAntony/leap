<?php
include ('config.php');
$c_id = $_GET['cid'];
$result = mysqli_query($con, "SELECT * FROM `message`,`student` WHERE m_cid='$c_id' and m_sid=s_id ");
$data = array();

if ($result->num_rows > 0) {
  // Loop through the result and add data to the array
  $i=0;
  while ($row = $result->fetch_assoc()) {
    $data[] = $row;
    $i++;
  }
}

// Send the data as a JSON response
echo json_encode($data);

$con->close();
?>