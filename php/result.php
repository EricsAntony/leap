<?php
include 'config.php';
$sid=$_POST['s_id'];
$q_id=$_POST['q_id'];
$query="SELECT * FROM quiz_questions where qt_eid=$q_id";
$result = mysqli_query($con, $query);

if(isset($_POST['answer']))
{
    $len = count($_POST['answer']);
    $score=0;
    while($row = mysqli_fetch_assoc($result))
    {
        foreach($_POST['answer'] as $key=>$value)
        {
            if($key == $row['qt_id'])
            {
                $ins = "INSERT INTO quiz_answers(qa_qtid, qa_sid, qa_subans) VALUES('$key','$sid','$value')";
                $res = mysqli_query($con, $ins);

                if($row['qt_crct'] == $value)
                {
                    $score += 1;
                }

            }
        }
    }
    $queryResult = mysqli_query($con, "UPDATE quiz_results SET qr_result = '$score', qr_date = NOW() WHERE qr_qid=$q_id");
    header('location:../pages/student/s_index.php');
}
else
{
    echo "<script> alert('No questions attempted. Exam submitted') </script>";
    header('location:../pages/student/s_index.php');
}


 ?> 