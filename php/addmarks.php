<?php
include "config.php";

$subid = $_POST['to_subid'];
$sid = $_POST['to_sid'];
$first = $_POST['to_first'];
$second = $_POST['to_second'];
$count = 0;
$len = count($subid);
for ($i = 0; $i < $len; $i++) {
    $query = "SELECT * FROM internal WHERE i_subid='$subid[$i]' and i_sid='$sid[$i]'";
    $j = mysqli_query($con, $query);
    // echo "num rows = ".mysqli_num_rows($j);
    if (mysqli_num_rows($j) != 0) {
        if ($first[$i] == '' && $second[$i] != '') {
            $q = "UPDATE internal SET  i_second = '$second[$i]' WHERE i_subid='$subid[$i]' and i_sid='$sid[$i]'";
            mysqli_query($con, $q);
            $count++;
        }
        else if($first[$i] != '' && $second[$i] == '')
        {
            $q = "UPDATE internal SET  i_first = '$first[$i]' WHERE i_subid='$subid[$i]' and i_sid='$sid[$i]'";
            mysqli_query($con, $q);
            $count++;
        }
        else
        {
        $q = "UPDATE internal SET i_first = '$first[$i]', i_second = '$second[$i]' WHERE i_subid='$subid[$i]' and i_sid='$sid[$i]'";
        mysqli_query($con, $q);
        $count++;
        }

    } else {
        $sql = "INSERT INTO internal (i_subid, i_sid, i_first, i_second) VALUES('$subid[$i]','$sid[$i]','$first[$i]','$second[$i]')";
        if (mysqli_query($con, $sql)) {
            $count++;
        }
    }
}
if ($len == $count) {
    echo "1";
} else {
    echo "0";
}

?>