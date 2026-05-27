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
//$mon_date = '2023-05-07';
$mon_date = $today;
$created_at = $mon_date." ".$split_created_at[1];
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

//echo '<pre>';print_r($net_up_array);echo '</pre>';die;
//$month = 5;
$bank = "PNB"; 
//$mon_date = "2023-05-01";
$sql_qry = "select * from newdowntime_report where month_date='" . $mon_date . "' and today_tot_hit < '".$nowtime_hour."' limit 0,250";
//echo $sql_qry;die;
 $sql = mysqli_query($con,$sql_qry); 
 $yesterday = date('Y-m-d',strtotime("-1 days"));
	//$today = date('Y-m-d');
$count = 0; 
if(mysqli_num_rows($sql)>0){
	
	while($sql_result = mysqli_fetch_assoc($sql)){
		    $atm_id = $sql_result['ATMID'];
		    $_view = 1;
            $id = $sql_result['id'];
			if($_view == 1){
				$_correct_site_count = 0;
				$SN = $sql_result['SN'];
							    // echo $SN.'_';	
				$total_uptime = 0;$total_downtime = 0;
				$tot_cnt = 0;
		        $ok_cnt = 0;
				//$mon_date = $today;
				$is_nc = 0;$is_ok = 0;$duration="";$elapsedhr=0;
				$system_down_from = ''; $system_down_up_to = '';
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
						if($st=='OK'){
							$ok_cnt = $ok_cnt + 1;
						}
					}	
					//echo $system_down_from." ".$system_down_up_to;
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
				}else{
					$elapsedhr = 0;
				}
				//echo $ok_cnt;die;
				$total_downtime_day = $elapsedhr;
				$site_up_with_tat = 24 - $elapsedhr;
				
				//die;
				$total_time = 0;
				$total_net_his = mysqli_num_rows($net_sql_res);
				$net_his_not = 0;
				if($nowtime_hour==23){
					$nowtime_hour = 24;
				}
				//echo $total_net_his;die;
				if($mon_date<=$today){
					$tot_cnt = $tot_cnt + 1;
					if($ok_cnt>=8){
						$total_time = $nowtime_hour;
						//$total_time = 24;
						$system_down_from = '';
					}else{
						if($ok_cnt==0){
							if(in_array($SN,$net_up_array)){
								$_correct_site_count = $_correct_site_count + 1;
								$check_mode = $_correct_site_count % 4;
								
								if($check_mode==0){
									$system_down_from = '';
								}
								if($check_mode==1){
									$system_down_from = $mon_date." 07:05:00";
									$system_down_up_to = $mon_date." 08:05:00";
								}
								if($check_mode==2){
									$system_down_from = $mon_date." 13:35:00";
									$system_down_up_to = $mon_date." 15:35:00";
								}
								if($check_mode==3){
									$system_down_from = $mon_date." 09:25:00";
									$system_down_up_to = $mon_date." 12:25:00";
								}
							       //$total_time = 24 - $check_mode;
						           	$net_his_not = $check_mode;
									$total_time = $nowtime_hour - $check_mode;
							}else{
								if(in_array($SN,$_downsites_array)){
									$net_his_not = $nowtime_hour;
								    $total_time = 0;
									$system_down_from = $mon_date." 00:00:00";
									//$system_down_from = '';	
								}else{
									$net_his_not = $nowtime_hour;
								    $total_time = 0;
									$system_down_from = $mon_date." 00:00:00";
								//	$system_down_from = '';	
								}
							}
						}else{	
						    if($mon_date==$today){
								if($ok_cnt <= $total_hour_time){
									$net_his_not = $total_hour_time - $ok_cnt;
									$total_time = $nowtime_hour - $net_his_not;
									//$total_time = 24 - $net_his_not;
								}else{
									$total_time = $total_hour_time;
									$net_his_not = 0;
								}
							}else{
								$total_time = $nowtime_hour;
								$net_his_not = 0;
								//$total_time = $ok_cnt * 3;
								//$net_his_not = 24 - $total_time;
							}
						}
					}
				}
				//echo 'Total : '.$total_time;
				//die;
				$total_uptime = $total_uptime + $total_time;
				$total_downtime = $total_downtime + $net_his_not;
			   
			    $total_downtime_day = $total_downtime;
               
				if($total_downtime == 0){
					$system_down_from = "";
				}else{
					
						if($system_down_from!=''){
						
							$split_dwn_time = explode(" ",$system_down_from);
							$split_dwn_time_dt = $split_dwn_time[0];
							$split_dwn_time_dt_time = $split_dwn_time[1];
							$split_time_only = explode(":",$split_dwn_time_dt_time);
							
							if($mon_date==$today){
						       $split_time_hr = $total_downtime_day;
							}else{
							   $split_time_hr = $split_time_only[0] + $total_downtime_day;
							}
							if($split_time_hr<10){
								$split_time_hr = "0".$split_time_hr;
							}
							$system_down_up_to_time = $split_time_hr.":".$split_time_only[1].":".$split_time_only[2];
							$system_down_up_to = $split_dwn_time_dt." ".$system_down_up_to_time;
						}
					
				}
				
				$site_up_with_tat = $nowtime_hour - $total_downtime;
				$reason = "";
				$bank_advised_stop_surveillance = "N";
				$power_supply_inadequate_battery = "N" ; $operator_comments = ""; $total_downtime_current_month = 0;  
				
				$dwn_qry_sql = "SELECT total_downtime_current_month FROM `newdowntime_report` WHERE SN='".$SN."' AND month='".$month."' order by id DESC limit 1";
				
				$dwn_sql_res = mysqli_query($con,$dwn_qry_sql);
				$downtime_current_month = 0;
				if(mysqli_num_rows($dwn_sql_res)>0){
				   $dwntime_current_month = mysqli_fetch_assoc($dwn_sql_res);
				   $downtime_current_month = $dwntime_current_month['total_downtime_current_month'];
				}
				$total_downtime_current_month = $downtime_current_month + $net_his_not;
				
				if($system_down_from!=''){
				$set_sql = "UPDATE `newdowntime_report` SET  `system_down_from`='" . $system_down_from . "', `system_down_up_to`='" . $system_down_up_to . "', `total_downtime_day`='" . $total_downtime_day . "', `site_up_with_tat`='" . $site_up_with_tat . "', `total_downtime_current_month`='" . $total_downtime_current_month . "',`is_update`='1', `today_tot_hit`='".$nowtime_hour."' where id='" . $id . "'";
				}else{
				$set_sql = "UPDATE `newdowntime_report` SET  `total_downtime_day`='" . $total_downtime_day . "', `site_up_with_tat`='" . $site_up_with_tat . "', `total_downtime_current_month`='" . $total_downtime_current_month . "',`is_update`='1', `today_tot_hit`='".$nowtime_hour."' where id='" . $id . "'";
				}
				
				$set_result = mysqli_query($con, $set_sql);
				$count = $count + 1;
			   
			}
		}
	}
		CloseCon($con);
		echo $count;
	?>
                     