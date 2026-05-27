<?php  include('db_connection.php'); $con = OpenCon();
      date_default_timezone_set('Asia/Kolkata');
	  $query_date = date('Y-m-d');
	  
	  $set_sql = "INSERT INTO `test_cron`( `month_date`) VALUES ('".$query_date."') ";
								$set_result = mysqli_query($con,$set_sql); 
	  CloseCon($con);
    