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
$year = date('Y');

$month = (int)$month;

for($d=1; $d<=31; $d++)
{
    $time=mktime(12, 0, 0, $month, $d, $year);          
    if (date('m', $time)==$month){       
        $list[]=date('Y-m-d-D', $time);
		$list1[]=date('Y-m-d', $time);
	}
}


$bank = "PNB"; 
$sql_qry = "select ATMID,SN,SiteAddress,DVRIP,PanelIP,RouterIp,ATMID_2,ATMID_3,live_date,Zone,State from sites where Customer='" . $client . "' and Bank='" . $bank . "' and live='Y' AND ATMID IN (SELECT ATMID from network_report_update_few_sites)";

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
				       // $mon_date = '2023-03-27';
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
								$set_sql = "INSERT INTO `newnetwork_report`( `SN`, `month_date`, `month`, `year`, `uptime`, `downtime`, `created_at`, `today_tot_hit`) VALUES ('" . $SN . "','" . $mon_date . "','" . $month . "','" . $year . "','" . $total_time . "','" . $net_his_not . "','" . $created_at . "', '".$nowtime_hour."') ";
								$set_result = mysqli_query($con, $set_sql);
                           // }
						}else{
							$netrepsql_result = mysqli_fetch_assoc($newnet_sql_res);
							$id = $netrepsql_result['id'];
							$set_sql = "UPDATE `newnetwork_report` SET `uptime`='".$total_uptime."', `downtime`='".$total_downtime."',`is_update`='1', `today_tot_hit`='".$nowtime_hour."' where id='" . $id . "'";
			                $set_result = mysqli_query($con, $set_sql);
						}
						
					//die;
						
				//}

				
			}
		}
	}
		CloseCon($con);
	?>
                     