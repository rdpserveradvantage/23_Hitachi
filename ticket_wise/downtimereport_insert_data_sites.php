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
//$month = 6;
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
				$_correct_site_count = 0;
				$SN = $sql_result['SN'];
				//$SN = "3055";
				//$SN = "3199";
				$_liv_dt = $sql_result['live_date'];
				//$count++;
				
				$total_uptime = 0;$total_downtime = 0;
				$tot_cnt = 0;
		        $ok_cnt = 0;
				//$mon_date = $today;
				$is_nc = 0;$is_ok = 0;$duration="";$elapsedhr=0;
				$system_down_from = ''; $system_down_up_to = '';
								
				$total_uptime = 0;
				$total_downtime = 0;
			   
			    $total_downtime_day = $total_downtime;
               
				$site_up_with_tat = 0;
				$reason = "";
				$bank_advised_stop_surveillance = "N";
				$power_supply_inadequate_battery = "N" ; $operator_comments = ""; $total_downtime_current_month = 0;  
				
				$total_downtime_current_month = 0;
				$set_sql = "INSERT INTO `newdowntime_report`( `SN`, `ATMID`, `month`,`month_date`, `total_downtime_day`, `site_up_with_tat`, `reason`, `bank_advised_stop_surveillance`, `power_supply_inadequate_battery`, `operator_comments`, `total_downtime_current_month`, `created_at` ) VALUES ('" . $SN . "','" . $atm_id . "','" . $month . "','" . $mon_date . "','" . $total_downtime_day . "','" . $site_up_with_tat . "','" . $reason . "','" . $bank_advised_stop_surveillance . "','" . $power_supply_inadequate_battery . "','" . $operator_comments . "','" . $total_downtime_current_month . "','" . $created_at . "') ";	
			//	echo $set_sql;die;
				$set_result = mysqli_query($con, $set_sql);
				$count = $count + 1;
			   // die;
			}
		}
	}
		CloseCon($con);
		echo $count;
	?>
                     