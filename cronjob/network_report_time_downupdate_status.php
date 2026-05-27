<?php  include('db_connection.php'); $con = OpenCon();
        date_default_timezone_set("Asia/Calcutta"); 
        $receivedtime = date('Y-m-d H:i:s');
		$net_dwn_atm_id_array = array();
		$net_dwn_calls_qry = mysqli_query($con,"SELECT ATMID FROM `network_report_down_calls`");
		if(mysqli_num_rows($net_dwn_calls_qry)){
			while($netsql_result = mysqli_fetch_assoc($net_dwn_calls_qry)){
				$net_dwn_atm_id = $netsql_result['ATMID'];
				array_push($net_dwn_atm_id_array, $net_dwn_atm_id);
			}
		}
		
		$qry =  "SELECT SN,ATMID FROM `network_report_list` WHERE router_status=0";
		
	   $total_updated = 0;
	   // SELECT id,receivedtime FROM `ai_alerts` WHERE CAST(createtime AS DATE)='2022-05-30' AND DATE_FORMAT(createtime, '%k')<='16' AND status='O'
		  $sql = mysqli_query($con,$qry);
		  if(mysqli_num_rows($sql)){
			while($sitesql_result = mysqli_fetch_assoc($sql)){
				$SN = $sitesql_result['SN'];
				$atm_id = $sitesql_result['ATMID'];
				if(in_array($atm_id, $net_dwn_atm_id_array)){
					
				}else{
					$updatesql= " UPDATE `network_report` SET `router`='".$receivedtime."',`dvr`='".$receivedtime."',`panel`='".$receivedtime."' where `SN`='".$SN."'";
					$month_result = mysqli_query($con,$updatesql);
					if($month_result==1){
					   $total_updated = $total_updated + 1;
					}
				}
			}
		  }
		  CloseCon($con);
	  echo $total_updated;
     