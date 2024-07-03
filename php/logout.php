<?php
session_start();
unset($_SESSION['teacher']);
unset($_SESSION['tid']);
unset($_SESSION['tname']);

unset($_SESSION['student']);
unset($_SESSION['sid']);
unset($_SESSION['sname']);
if(session_destroy())
{
    echo 1;
}
?>

