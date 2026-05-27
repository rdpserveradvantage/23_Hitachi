<?php session_start();include('db_connection.php'); $con = OpenCon();
date_default_timezone_set('Asia/Kolkata');
$today = date('Y-m-d');
$created_at = date('Y-m-d H:i:s');

$client = "Hitachi";

 $bank = "";$circle="";
 
$list=array();$list1=array();
$month = 3;
$year = 2023;

for($d=1; $d<=31; $d++)
{
    $time=mktime(12, 0, 0, $month, $d, $year);          
    if (date('m', $time)==$month){       
        $list[]=date('Y-m-d-D', $time);
		$list1[]=date('Y-m-d', $time);
	}
}


$bank = "PNB"; 
$sql_qry = "select ATMID,SN,SiteAddress,DVRIP,PanelIP,RouterIp,ATMID_2,ATMID_3,live_date,Zone,State from sites where Customer='" . $client . "' and Bank='" . $bank . "' and live='Y'";

 $sql = mysqli_query($con,$sql_qry); 
 $yesterday = date('Y-m-d',strtotime("-1 days"));
	$today = date('Y-m-d');
$count = 0; 
if(mysqli_num_rows($sql)){
	while($sql_result = mysqli_fetch_assoc($sql)){
		$atm_id = $sql_result['ATMID'];
		$_view = 1;

		if($_view == 1){
			
			$SN = $sql_result['SN'];
			$_liv_dt = $sql_result['live_date'];
			$count++;
			
			$total_uptime = 0;$total_downtime = 0;
			$tot_cnt = 0;
		
		        for($i=0;$i<count($list1);$i++){ 
				        //$mon_date = '2023-03-03';
						//$mon_date = $today;
						$mon_date = $list1[$i];
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
								$total_time = 24;
							}else{
								if($total_net_his>0){
								$net_his_not = 8 - $total_net_his;
								$total_time = 24 - $net_his_not;
								}
							}
						}
						$total_uptime = $total_uptime + $total_time;
						$total_downtime = $total_downtime + $net_his_not;
						
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
						
				}

				
			}
		}
	}
		CloseCon($con);
	?>
                     