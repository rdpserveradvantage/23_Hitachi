<?php  include('db_connection.php'); $con = OpenCon();
        date_default_timezone_set("Asia/Calcutta"); 
        $receivedtime = date('Y-m-d H:i:s');
		$qry =  "SELECT SN FROM `network_report_list` WHERE router_status=0 AND ATMID NOT IN ('A1128410',
'A1116710',
'NI112000',
'N4045220',
'N2170300',
'D1033510',
'T2799800',
'D7226400',
'D1131220',
'D1213320',
'A1026310',
'A1174610',
'D1045920',
'D1213800',
'D1133520',
'N7151500',
'N4606200',
'N3016600',
'B1120200',
'D1034300',
'D2042900',
'N2775000',
'B1637800',
'D2348500',
'A1200110',
'N3163100',
'D2276000',
'N2607700',
'E1630100',
'E3589100',
'D1070920',
'N2440200'
) limit 30";
		
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
     