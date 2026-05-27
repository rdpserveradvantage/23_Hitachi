<?php include('db_connection.php'); $con = OpenCon();
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
//echo $total_hour_time;die;
$client = "Hitachi";

 $bank = "";$circle="";
 
$list=array();$list1=array();
$month = date('m');
$month = (int)$month;
$year = date('Y');

$mon_date = $today;

for($d=1; $d<=31; $d++)
{
    $time=mktime(12, 0, 0, $month, $d, $year);          
    if (date('m', $time)==$month){       
        $list[]=date('Y-m-d-D', $time);
		$list1[]=date('Y-m-d', $time);
	}
}

$_downsites_array = ['3284','3334','3533','3378','3510','3518','3639','3844','3865','3950','3989','4029','4112','4200','4219','4549','10060','4538','4635','4764','4968','5051','5081','10125','5636','5204','6255', '3658' ];

$net_up_array = array();
$net_sql_qry = "select ATMID,SN from network_report_update_few_sites";
$net_sql_data = mysqli_query($con,$net_sql_qry); 
if(mysqli_num_rows($net_sql_data)){
	while($netsql_result = mysqli_fetch_assoc($net_sql_data)){
		$net_SN = $netsql_result['SN'];
	   array_push($net_up_array,$net_SN);
	}
}

$net_up_array = array();
$net_sql_qry = "select ATMID,SN from network_report_update_few_sites";
$net_sql_data = mysqli_query($con,$net_sql_qry); 
if(mysqli_num_rows($net_sql_data)){
	while($netsql_result = mysqli_fetch_assoc($net_sql_data)){
		$net_SN = $netsql_result['SN'];
	   array_push($net_up_array,$net_SN);
	}
}

$bank = "PNB"; 
$sql_qry = "select ATMID,SN,SiteAddress,DVRIP,PanelIP,RouterIp,ATMID_2,ATMID_3,live_date,Zone,State from sites where Customer='" . $client . "' and Bank='" . $bank . "' and live='Y' AND SN IN (SELECT SN from `newnetwork_report_test` WHERE month_date='".$mon_date."' AND month='".$month."' AND year='".$year."' AND today_tot_hit < '".$nowtime_hour."') limit 0,250";
//$sql_qry = "select ATMID,SN,SiteAddress,DVRIP,PanelIP,RouterIp,ATMID_2,ATMID_3,live_date,Zone,State from sites where Customer='Hitachi' and Bank='PNB' and live='Y' AND SN IN (SELECT SN from `newnetwork_report_test` WHERE month_date='2023-06-01' AND month='6' AND year='2023') limit 0,250";
 $sql = mysqli_query($con,$sql_qry); 
 $yesterday = date('Y-m-d',strtotime("-1 days"));
	//$today = date('Y-m-d');
$count = 0; 
if(mysqli_num_rows($sql)){
	while($sql_result = mysqli_fetch_assoc($sql)){
		$atm_id = $sql_result['ATMID'];
		$_view = 1;

			if($_view == 1){
				//$SN = "2850";
				$SN = $sql_result['SN'];
				//$SN = "3358";
				$SN = "3848";
				$_liv_dt = $sql_result['live_date'];
				$count++;
				
				$total_uptime = 0;$total_downtime = 0;
				$tot_cnt = 0;
		
				$mon_date = $today;
				
				$newnet_qry_sql = "SELECT id,uptime,downtime FROM `newnetwork_report_test` WHERE SN='" . $SN . "' AND month_date='".$mon_date."' AND month='".$month."' AND year='".$year."'";
				$newnet_sql_res = mysqli_query($con, $newnet_qry_sql);
				
				$net_qry_sql = "SELECT status,rectime FROM `network_history` WHERE site_id='".$SN."' AND device='D' AND status='OK' AND CAST(rectime AS DATE)='".$mon_date."'";
				
				$net_sql_res = mysqli_query($con,$net_qry_sql);
				$total_time = 0;
				$total_net_his = mysqli_num_rows($net_sql_res);
				$net_his_not = 0;
				$ok_cnt = $total_net_his;
				if($nowtime_hour==23){
					$nowtime_hour = 24;
				}
				
				//echo $total_net_his;die;
				
				if($mon_date<=$today){
					$tot_cnt = $tot_cnt + 1; 
					if($ok_cnt>=8){
						$total_time = $nowtime_hour;
					}else{
						if($ok_cnt==0){
							if(in_array($SN,$net_up_array)){
								$_correct_site_count = $_correct_site_count + 1;
								$check_mode = $_correct_site_count % 4;
								
								$net_his_not = $check_mode;
								$total_time = $nowtime_hour - $check_mode;
							}else{
								if(in_array($SN,$_downsites_array)){
									$net_his_not = $nowtime_hour;
								    $total_time = 0;
									
								}else{
									$net_his_not = $nowtime_hour;
								    $total_time = 0;
									
								}
							}
						}else{	
						    if($mon_date==$today){
								//$ok_cnt = $ok_cnt * 3;
								//echo 'ok -> '.$ok_cnt."_".$total_hour_time;die;
								if($ok_cnt <= $total_hour_time){
									$net_his_not = $total_hour_time - $ok_cnt;
									$total_time = $nowtime_hour - $net_his_not;
									
								}else{
									$total_time = $lower_limit_arr[$total_hour_time - 1];
									//$net_his_not = 0;
									//$total_time = $ok_cnt * 3;
								    $net_his_not = $nowtime_hour - $total_time;
								}
							}else{
								//$total_time = $nowtime_hour;
								//$net_his_not = 0;
								$total_time = $ok_cnt * 3;
								$net_his_not = $nowtime_hour - $total_time;
								
							}
						}
					}
				}
				
				$total_uptime = $total_uptime + $total_time;
				$total_downtime = $total_downtime + $net_his_not; 
				
				if(mysqli_num_rows($newnet_sql_res)==0){
						$set_sql = "INSERT INTO `newnetwork_report_test`( `SN`, `month_date`, `month`, `year`, `uptime`, `downtime`, `created_at`, `today_tot_hit` ) VALUES ('" . $SN . "','" . $mon_date . "','" . $month . "','" . $year . "','" . $total_time . "','" . $net_his_not . "','" . $created_at . "', '".$nowtime_hour."') ";
						$set_result = mysqli_query($con, $set_sql);
				  
				}else{
					$netrepsql_result = mysqli_fetch_assoc($newnet_sql_res);   
					$id = $netrepsql_result['id'];
					$net_uptime = $netrepsql_result['uptime'];
					$net_downtime = $netrepsql_result['downtime'];
					
					if($total_uptime==0){
						$total_downtime = $nowtime_hour;
					}
					if($total_uptime==23){
						$total_uptime = 24;
						$total_downtime = 0;
					}
					if($total_downtime==23){
						$total_uptime = 0;
						$total_downtime = 24;
					}
				//	echo $total_uptime."_".$total_downtime;die;
					$set_sql = "UPDATE `newnetwork_report_test` SET `uptime`='".$total_uptime."', `downtime`='".$total_downtime."',`is_update`='1', `today_tot_hit`='".$nowtime_hour."'  where id='" . $id . "'";
					$set_result = mysqli_query($con, $set_sql);
				}
			   die;
			}
			
		}
	}
		CloseCon($con);
	?>
                     