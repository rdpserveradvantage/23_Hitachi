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
//$month = (int)$month;
$year = date('Y');

$month = 4;

//$mon_date = $today;
//echo (int)$month.'-'.$year;die;
//$year = 2023;
$mon_date = '2023-04-18';
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
'A1214510',
'N4495900',
'B1052210',
'A1216510',
'A1220310',
'B1105610',
'A1188610',
'A1223010',
'N3463100',
'N2463100',
'B1135210',
'B1153910',
'A1214410',
'A1193310',
'A1193210',
'A1214710',
'A1156510',
'N2998200',
'EB105610',
'D3216510',
'E1111210',
'A1159810',
'N1877800',
'N2463600',
'N6046200',
'N2782600',
'N9046200',
'N3072800',
'A1202910',
'N1993100',
'B1142510',
'E1081610',
'B1111210',
'N1993200',
'A2922600',
'N5083500',
'N4083500',
'N1585700',
'N1913800',
'N2388800',
'EA105610',
'N3448100',
'A6105610',
'D7046200',
'B1111410',
'N3495900',
'N2219220',
'A5105610',
'E1933700',
'N1795200',
'N4048100',
'N3481800',
'A2921600',
'A1176810',
'N3493000',
'N1994400',
'N1921700',
'A1921500',
'A1933600',
'A1159910',
'N1998200',
'N1591900',
'N4016400',
'N3016400',
'N6083500',
'A1921800',
'A2922500',
'D1933100',
'A1921300',
'N2961400',
'A1178310',
'N8046200',
'E1135110',
'N3463600',
'B1998200',
'N2493000'
)";

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
				//$SN = "10024";
				$_liv_dt = $sql_result['live_date'];
				$count++;
				
				$total_uptime = 0;$total_downtime = 0;
				$tot_cnt = 0;
		
		       // for($i=0;$i<count($list1);$i++){ 
				       // $mon_date = '2023-03-15';
					//	$mon_date = $today;
						//$mon_date = $list1[$i];
						
						$ch_qry_sql = "SELECT id FROM `network_report_update_few_sites` WHERE SN='" . $SN . "' ";
						$ch_sql_res = mysqli_query($con, $ch_qry_sql);
						//echo mysqli_num_rows($ch_sql_res);die;
						if(mysqli_num_rows($ch_sql_res)==0){
						
						$newnet_qry_sql = "SELECT id,uptime,downtime FROM `newnetwork_report` WHERE SN='" . $SN . "' AND month_date='".$mon_date."' AND month='".$month."' AND year='".$year."'";
						$newnet_sql_res = mysqli_query($con, $newnet_qry_sql);
						
							//if($_liv_dt<=$mon_date){
						$net_qry_sql = "SELECT status,rectime FROM `network_history` WHERE site_id='".$SN."' AND device='D' AND status='OK' AND CAST(rectime AS DATE)='".$mon_date."'";
						//echo $net_qry_sql;die;
						$net_sql_res = mysqli_query($con,$net_qry_sql);
						$total_time = 0;
						$total_net_his = mysqli_num_rows($net_sql_res);
						//echo $total_net_his;die;
						$net_his_not = 0;
						
						if($mon_date<=$today){
							$tot_cnt = $tot_cnt + 1;
							if($total_net_his>=8){
								//$total_time = $nowtime_hour;
								$total_time = $total_net_his;
							}else{
								if($total_net_his==0){
									
								}else{	
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
						
					//	echo $total_time;die;
						$total_uptime = $total_uptime + $total_time;
						$total_downtime = $total_downtime + $net_his_not;
						
						//echo $SN." ";
						
						//echo $total_uptime.'-'.$total_downtime.'==';
						
						if(mysqli_num_rows($newnet_sql_res)==0){
								$set_sql = "INSERT INTO `newnetwork_report`( `SN`, `month_date`, `month`, `year`, `uptime`, `downtime`, `created_at`, `today_tot_hit` ) VALUES ('" . $SN . "','" . $mon_date . "','" . $month . "','" . $year . "','" . $total_time . "','" . $net_his_not . "','" . $created_at . "', '".$nowtime_hour."') ";
								$set_result = mysqli_query($con, $set_sql);
                           // }
						}else{
							$netrepsql_result = mysqli_fetch_assoc($newnet_sql_res);   
							$id = $netrepsql_result['id'];
						    $net_uptime = $netrepsql_result['uptime'];
							$net_downtime = $netrepsql_result['downtime'];
							/*
							if($net_uptime==0){
								if($net_downtime==0){
									$total_downtime = $nowtime_hour;
								}else{
									$total_downtime = $net_downtime + 1;
								} 
								$total_downtime = $nowtime_hour;
							}
							*/
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
							
							//echo $total_uptime.'-'.$total_downtime;die;
							
							$set_sql = "UPDATE `newnetwork_report` SET `uptime`='".$total_uptime."', `downtime`='".$total_downtime."',`is_update`='1', `today_tot_hit`='".$nowtime_hour."'  where id='" . $id . "'";
			                $set_result = mysqli_query($con, $set_sql);
						}
			        }
				//}

				
			}
		}
	}
		CloseCon($con);
	?>
                     