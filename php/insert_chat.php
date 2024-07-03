<?php 
    session_start();
    if(isset($_SESSION['sid_id'])){
        include_once "config.php";
        $s_id = $_SESSION['sid'];
        $c_id = mysqli_real_escape_string($conn, $_POST['c_id']);
        $message = mysqli_real_escape_string($conn, $_POST['msg']);
        if(!empty($message)){
            $sql = mysqli_query($conn, "INSERT INTO message (m_cid, m_sid, m_message, m_date)
                                        VALUES ('$c_id', '$s_id', '$message', NOW())") or die();
        }
    }


    
?>