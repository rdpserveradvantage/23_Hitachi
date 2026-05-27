<?php session_start();include('db_connection.php'); $con = OpenCon();
date_default_timezone_set('Asia/Kolkata');


$start_date = $_GET['start_date'];
$end_date = $_GET['end_date'];

echo 'start: '.$start_date.'  End : '.$end_date;
?>


