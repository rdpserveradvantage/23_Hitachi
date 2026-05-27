<?php
include('db_connection.php');
$con = OpenCon();					
$set_sql = "INSERT INTO `esurv_network`( `atmid`, `date_1`,`date_2`, `date_3`, `date_4`, `date_5`, `date_6`) VALUES ('A1234','20','25','34','37','45','56') ";
$set_result = mysqli_query($con,$set_sql); 				
CloseCon($con);
?>
