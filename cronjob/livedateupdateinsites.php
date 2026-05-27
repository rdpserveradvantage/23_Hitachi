<?php  include('db_connection.php'); $con = OpenCon();
    

      date_default_timezone_set('Asia/Kolkata');
	 // $query_date = date('Y-m-d');
	 // $start = date('Y-m-01', strtotime($query_date));
	  $totalupdate = 0;$err = "";
	  $sql = mysqli_query($con,"select * from atmdata");
	  if(mysqli_num_rows($sql)){
		while($sitesql_result = mysqli_fetch_assoc($sql)){
			$atmid = $sitesql_result['ATM'];
			$live_date = $sitesql_result['Date'];
			
			//$date = DateTime::createFromFormat('d-m-y', $query_date); // "d/m/y" corresponds to the input format
			//$live_date = $date->format('Y-m-d'); //outputs 2021-01-20
			echo $live_date."</br>";
			$updatesql= " UPDATE `sites` SET `live_date`='".$live_date."' where `ATMID`='".$atmid."'";
            $month_result = mysqli_query($con,$updatesql);
			if($month_result==1){
				$totalupdate = $totalupdate + 1;
			}else{
				$err .= "ATM ID : ".$atmid." not updated"."</br>";
			}		
		}
	  }
	  
	  CloseCon($con);
     echo "Total updated :".$totalupdate."</br>";
	 echo $err;