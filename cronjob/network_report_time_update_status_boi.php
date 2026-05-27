<?php  include('db_connection.php'); $con = OpenCon();
        date_default_timezone_set("Asia/Calcutta"); 
        $receivedtime = date('Y-m-d H:i:s');
		$qry =  "SELECT SN FROM `sites` WHERE ATMID IN (SELECT ATMID FROM `network_report_list` WHERE Customer='Hitachi' AND Bank='BOI' AND router_status=0)";
		
	   $total_updated = 0;
	   // SELECT id,receivedtime FROM `ai_alerts` WHERE CAST(createtime AS DATE)='2022-05-30' AND DATE_FORMAT(createtime, '%k')<='16' AND status='O'
		  $sql = mysqli_query($con,$qry);
		  if(mysqli_num_rows($sql)){
			while($sitesql_result = mysqli_fetch_assoc($sql)){
				$SN = $sitesql_result['SN'];
				
				$updatesql= " UPDATE `network_report` SET `router`='".$receivedtime."',`dvr`='".$receivedtime."',`panel`='".$receivedtime."' where `SN`='".$SN."'";
				$month_result = mysqli_query($con,$updatesql);
				if($month_result==1){
					$updatesql_list= " UPDATE `network_report_list` SET `router_status`=1,`dvr_status`=1,`panel_status`=1,`router_lastcommunication`='".$receivedtime."',`dvr_lastcommunication`='".$receivedtime."',`panel_lastcommunication`='".$receivedtime."' where `SN`='".$SN."'";
				    $month_result_list = mysqli_query($con,$updatesql_list);
				   $total_updated = $total_updated + 1;
				}
				
			}
		  }
		  CloseCon($con);
	  echo $total_updated;
     