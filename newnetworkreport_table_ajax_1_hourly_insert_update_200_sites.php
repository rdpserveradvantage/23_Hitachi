<?php session_start();include('db_connection.php'); $con = OpenCon();
date_default_timezone_set('Asia/Kolkata');
$today = date('Y-m-d');
$created_at = date('Y-m-d H:i:s');
//echo $created_at;die;
$split_created_at = explode(' ',$created_at);
$split_time = explode(":", $split_created_at[1]);
$nowtime_hour = $split_time[0];
$total_hour_time = 0;
$lower_limit_arr = [0,3,6,9,12,15,18,21];
for($i=0;$i<count($lower_limit_arr);$i++){
	if($split_time[0]>=$lower_limit_arr[$i]){
		$total_hour_time = $total_hour_time + 1;
	}
}

$client = "Hitachi";

 $bank = "";$circle="";
 
$list=array();$list1=array();
$month = date('m');
$month = (int)$month;
$year = date('Y');

for($d=1; $d<=31; $d++)
{
    $time=mktime(12, 0, 0, $month, $d, $year);          
    if (date('m', $time)==$month){       
        $list[]=date('Y-m-d-D', $time);
		$list1[]=date('Y-m-d', $time);
	}
}


$bank = "PNB"; 
$sql_qry = "select ATMID,SN,SiteAddress,DVRIP,PanelIP,RouterIp,ATMID_2,ATMID_3,live_date,Zone,State from sites where Customer='" . $client . "' and Bank='" . $bank . "' and live='Y' AND ATMID IN (
'B1056110',
'D2234900',
'B1010510',
'A1922000',
'N4339400',
'N3188600',
'01654400',
'A1048910',
'N8308000',
'B1184410',
'N3670000',
'B1027500',
'N5056400',
'N3171500',
'N2245900',
'B1514410',
'D2448400',
'N1913800',
'N4074600',
'N2439000',
'N2388800',
'B1044900',
'N2245800',
'D3002300',
'N4044900',
'A1193910',
'N2250300',
'N9022800',
'N2238100',
'N3175700',
'N1766600',
'D2055900',
'L1867400',
'B1783400',
'N4307800',
'N6060600',
'N1078800',
'N1780000',
'N3142400',
'D9751200',
'D2055800',
'N6414200',
'A4179800',
'N8019700',
'D2612500',
'N4142400',
'N3448100',
'A6105610',
'D2007910',
'A2825400',
'N2273500',
'N3007910',
'N3495900',
'N5169900',
'N2219220',
'D2612400',
'B1637600',
'N2035500',
'N3097400',
'D3023320',
'E1933700',
'N2665100',
'N3397500',
'A1081510',
'N1795200',
'D7049000',
'B1086910',
'A1205810',
'N2102800',
'N5175500',
'D1597200',
'N2447400',
'A2921600',
'A1176810',
'L1628600',
'NB022800',
'N1994400',
'N1921700',
'N3129500',
'B2045300',
'A1183910',
'D1922400',
'D3670200',
'N5386100',
'A1921500',
'N2607100',
'B1235300',
'D3162220',
'D1775300',
'N1201900',
'A1933600',
'N3608200',
'N4075000',
'N2134600',
'N3444500',
'N1102600',
'N1112700',
'NC420900',
'N1998200',
'N5129500',
'N1591900',
'N3419200',
'N4093700',
'N4016400',
'N2081200',
'N3016400',
'N2210500',
'N2914000',
'D2190120',
'B1320300',
'N6083500',
'B1060020',
'N2490500',
'B1105110',
'N4300300',
'B1096900',
'NA605900',
'N1529100',
'A1921800',
'NB386900',
'N1519400',
'N3047500',
'B1145420',
'TC145100',
'B1084100',
'T1092320',
'N2103300',
'N6100300',
'D1933100',
'B1923800',
'A1209110',
'A1921300',
'N2961400',
'B2095210',
'N2091200',
'N1975900',
'N1231800',
'N3109000',
'N4109000',
'N2139600',
'N2302100',
'D1071420',
'N2207500',
'N1759700',
'N2283900',
'B1174020',
'A7025000',
'D4047500',
'A2123820',
'N2410700',
'N1218500',
'B1154100',
'A1034510',
'D1780300',
'B1150120',
'N3410700',
'N1794500',
'A1107510',
'B1479200',
'B1923900',
'D2063100',
'B1924000',
'D3404300',
'B1166310',
'B1945900',
'01654400',
'N3000500',
'N3523110',
'N1643100',
'N3016300',
'B1043700',
'B1946000',
'N1778200',
'B2012810',
'B1092000',
'A2754000',
'B1082800',
'B1942200',
'B1945800',
'N2080900',
'B2621100',
'A1214610',
'A1151210',
'A1126210',
'B1946200',
'B1248700',
'B2011920',
'N1595900',
'B2048710',
'N2766300',
'B1525910',
'B2053220',
'A1178310',
'D1070920',
'B1946100',
'D3084100',
'N2080900',
'N3608200',
'B1184410',
'D2448400',
'N3171500'
)";

//$sql_qry = "SELECT COUNT(id),SN FROM `newnetwork_report` WHERE month='".$month."' AND year='".$year."' AND uptime=0 AND downtime>0 GROUP BY SN";

 $sql = mysqli_query($con,$sql_qry); 
 $yesterday = date('Y-m-d',strtotime("-1 days"));
	$today = date('Y-m-d');
$count = 0; 
//echo mysqli_num_rows($sql);die;
if(mysqli_num_rows($sql)){
	while($sql_result = mysqli_fetch_assoc($sql)){
		$atm_id = $sql_result['ATMID'];
		$_view = 1;

		if($_view == 1){
			//$SN = "4008";
			 $SN = $sql_result['SN'];
			$_liv_dt = $sql_result['live_date'];
			$count++;
			
			$total_uptime = 0;$total_downtime = 0;
			$tot_cnt = 0;
		
		       // for($i=0;$i<count($list1);$i++){ 
				       //$mon_date = '2023-03-27';
						$mon_date = $today;
						//$mon_date = $list1[$i];
						
						$newnet_qry_sql = "SELECT id FROM `newnetwork_report` WHERE SN='" . $SN . "' AND month_date='".$mon_date."' AND month='".$month."' AND year='".$year."'";
						$newnet_sql_res = mysqli_query($con, $newnet_qry_sql);
						
							//if($_liv_dt<=$mon_date){
						$net_qry_sql = "SELECT status FROM `network_history` WHERE site_id='".$SN."' AND device='D' AND status='OK' AND CAST(rectime AS DATE)='".$mon_date."'";
						$net_sql_res = mysqli_query($con,$net_qry_sql);
						$total_time = 0;
						$total_net_his = mysqli_num_rows($net_sql_res);
						$net_his_not = 0;
						
						if($mon_date<=$today){
							$tot_cnt = $tot_cnt + 1;
							if($total_net_his>=8){
								$total_time = $nowtime_hour;
							}else{
								if($total_net_his>0){
									if($total_net_his<$total_hour_time){
										$net_his_not = $total_hour_time - $total_net_his;
										$total_time = $nowtime_hour - $net_his_not;
									}
								    else{
										$net_his_not = 0;
										$total_time = $nowtime_hour;
									}
								
								}
							}
						}
						
						$total_time = $nowtime_hour;
						
						if($total_time==23){
							$total_time = 24;
							$net_his_not = 0;
						}
						
						$total_uptime = $total_uptime + $total_time;
						$total_downtime = $total_downtime + $net_his_not;
						$n_r = mysqli_num_rows($newnet_sql_res);
						//echo 'Uptime : '.$total_uptime.' & Downtime : '.$total_downtime.' total :'.$n_r; die;
						
						if(mysqli_num_rows($newnet_sql_res)==0){
								$set_sql = "INSERT INTO `newnetwork_report`( `SN`, `month_date`, `month`, `year`, `uptime`, `downtime`, `created_at`) VALUES ('" . $SN . "','" . $mon_date . "','" . $month . "','" . $year . "','" . $total_time . "','" . $net_his_not . "','" . $created_at . "') ";
								$set_result = mysqli_query($con, $set_sql);
                           // }
						}else{
							$netrepsql_result = mysqli_fetch_assoc($newnet_sql_res);
							$id = $netrepsql_result['id'];
							$set_sql = "UPDATE `newnetwork_report` SET `uptime`='".$total_uptime."', `downtime`='".$total_downtime."',`is_update`='1' where id='" . $id . "'";
			                $set_result = mysqli_query($con, $set_sql);
						}
						
					//die;
						
				//}

				
			}
		}
	}
		CloseCon($con);
	?>
                     