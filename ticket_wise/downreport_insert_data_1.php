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
//echo $total_hour_time;die;
$client = "Hitachi";

 $bank = "";$circle="";
 
$list=array();$list1=array();
$month = date('m');
$month = (int)$month;
$year = date('Y');
$mon_date = '2023-05-01';
//$mon_date = $today;
//echo (int)$month.'-'.$year;die;
//$year = 2023;

for($d=1; $d<=31; $d++)
{
    $time=mktime(12, 0, 0, $month, $d, $year);          
    if (date('m', $time)==$month){       
        $list[]=date('Y-m-d-D', $time);
		$list1[]=date('Y-m-d', $time);
	}
}


$bank = "PNB"; 
$sql_qry = "select ATMID,SN,SiteAddress,DVRIP,PanelIP,RouterIp,ATMID_2,ATMID_3,live_date,Zone,State from sites where Customer='" . $client . "' and Bank='" . $bank . "' and live='Y' AND SN NOT IN (SELECT SN from `newdowntime_report` WHERE month_date='".$mon_date."')";
//echo $sql_qry;die;
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
				$SN = "3160";
				$_liv_dt = $sql_result['live_date'];
				$count++;
				
				$total_uptime = 0;$total_downtime = 0;
				$tot_cnt = 0;
		
				$mon_date = $today;
				$is_nc = 0;$is_ok = 0;$duration="";
				$system_down_from = "";
				$net_qry_sql = "SELECT status,rectime FROM `network_history` WHERE site_id='".$SN."' AND device='D' AND CAST(rectime AS DATE)='".$mon_date."'";
				//echo $net_qry_sql;die;
				$net_sql_res = mysqli_query($con,$net_qry_sql);
				if(mysqli_num_rows($net_sql_res)>0){
				    while($nh = mysqli_fetch_assoc($net_sql_res)){
						$st = $nh['status'];
						if($is_nc==0){
							if($st=='NC'){
								$system_down_from = $nh['rectime'];
								$is_nc = 1;
							}
						}
						if($is_nc==1 && $is_ok==0){
							if($st=='OK'){
								$system_down_up_to = $nh['rectime'];
								$is_ok=1;
							}
						}
					}	
					
					$datetime1 = new DateTime($system_down_from);
					$datetime2 = new DateTime($system_down_up_to);
					$interval = $datetime1->diff($datetime2);
					
					$elapsedyear = $interval->format('%y');
					$elapsedmon = $interval->format('%m');
					$elapsed_day = $interval->format('%a');
					$elapsedhr = $interval->format('%h');
					$elapsedmin = $interval->format('%i');
					$elapsedsec = $interval->format('%s');
					$elapsedhour = $elapsedhr;
					if($elapsedhr<10){
						$elapsedhr = "0".$elapsedhr;
					}
					if($elapsedmin<10){
						$elapsedmin = "0".$elapsedmin;
					}
					$duration = $elapsedhr.":".$elapsedmin;
				}
				//echo $duration;die;
				//die;
				$total_time = 0;
				$total_net_his = mysqli_num_rows($net_sql_res);
				$net_his_not = 0;
				
				if($mon_date<=$today){
					$tot_cnt = $tot_cnt + 1;
					if($total_net_his>=8){
						//$total_time = $nowtime_hour;
						$total_time = 24;
					}else{
						if($total_net_his==0){
							
						}else{	
							if($total_net_his<$total_hour_time){
								$net_his_not = $total_hour_time - $total_net_his;
								//$total_time = $nowtime_hour - $net_his_not;
								$total_time = 24 - $net_his_not;
							}
							else{
								$net_his_not = 0;
								//$total_time = $nowtime_hour;
								$total_time = 24;
							}
						}
					}
				}
				
				
				$total_uptime = $total_uptime + $total_time;
				$total_downtime = $total_downtime + $net_his_not;
			    echo $total_uptime.'=='.$total_downtime;die;
				
				if(mysqli_num_rows($newnet_sql_res)==0){
						$set_sql = "INSERT INTO `newdowntime_report`( `SN`, `ATMID`, `month_date`, `system_down_from`, `system_down_up_to`, `total_downtime_day`, `site_up_with_tat`, `reason`, `bank_advised_stop_surveillance`, `power_supply_inadequate_battery`, `operator_comments`, `total_downtime_current_month`, `created_at` ) VALUES ('" . $SN . "','" . $atm_id . "','" . $mon_date . "','" . $month . "','" . $year . "','" . $total_time . "','" . $net_his_not . "','" . $created_at . "', '".$nowtime_hour."') ";
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
					
					$set_sql = "UPDATE `newnetwork_report` SET `uptime`='".$total_uptime."', `downtime`='".$total_downtime."',`is_update`='1', `today_tot_hit`='".$nowtime_hour."'  where id='" . $id . "'";
					$set_result = mysqli_query($con, $set_sql);
				}
			    
			}
		}
	}
		CloseCon($con);
	?>
                     