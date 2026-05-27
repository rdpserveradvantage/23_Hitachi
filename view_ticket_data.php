<?php 
//include("db_connection.php");
$con = OpenCon();

$sql = mysqli_query($con,"select * from ticket_raise");

$alert_sql = mysqli_query($con,"select * from alert_ticket_raise");
CloseCon($con);

?>


