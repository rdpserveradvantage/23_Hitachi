<?php  include('db_connection.php'); $con = OpenCon();
        date_default_timezone_set("Asia/Calcutta"); 
        $receivedtime = date('Y-m-d H:i:s');
		$qry =  "SELECT SN FROM `sites` WHERE ATMID IN (
'A2012810',
'A1193210',
'B1078010',
'D1077110',
'D2196110',
'D1799800',
'B1141010',
'A1197710',
'D5255000',
'N2388800',
'N2169900',
'N7019700',
'N4142400',
'N3007910',
'D2612400',
'A1081510',
'D7049000',
'N1268500',
'NB022800',
'A1940700',
'N1939100',
'N3171500',
'N1716800',
'D5008300',
'D1934100',
'B1945900',
'N3523110',
'N1643100',
'B1946100',
'NE297700',
'T4199000',
'D2492900',
'B1006020',
'B1145600',
'B1142210',
'N3672900',
'N5037700'
)";
		/*
    	$qry =  "SELECT SN FROM `sites` WHERE ATMID IN ('D3313100',
														'A1117410',
														'N1044810',
														'D1047510',
														'NH023100',
														'N9036100',
														'D2223300',
														'N2470600',
														'B1134210',
														'B1181500',
														'B1085100',
														'B1517710',
														'B1068210',
														'D2016720',
														'B1354500',
														'D1153110',
														'N1590900',
														'N2661400',
														'B1104410',
														'N2355700',
														'D1192920',
														'A1174510',
														'D1045920',
														'B1049220',
														'N4013500',
														'D1193220',
														'N1176300',
														'A1037410',
														'E1097010',
														'N4652100',
														'N2414700',
														'D2332400',
														'L1735100',
														'N5614300',
														'D5388600',
														'D2016900',
														'N1672600',
														'B1119810',
														'N5644600',
														'NH329200',
														'N1779500',
														'D1851400',
														'N3671000',
														'N5004700',
														'B1084510',
														'A1139910',
														'N8064700',
														'D1736100',
														'N2656800',
														'N2641200',
														'N1107000',
														'D2064500',
														'D1598300',
														'N2026800',
														'N1993200',
														'B1071510',
														'D5255000',
														'N7019700',
														'A2825400',
														'N5386100',
														'N1778200',
														'N1102600')"; */
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
     