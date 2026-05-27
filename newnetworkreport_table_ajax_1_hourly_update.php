<?php session_start();include('db_connection.php'); $con = OpenCon();
date_default_timezone_set('Asia/Kolkata');
$today = date('Y-m-d');
$created_at = date('Y-m-d H:i:s');

$client = "Hitachi";

 $bank = "";$circle="";
 
$list=array();$list1=array();
$month = 2;
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
//$sql_qry = "select ATMID,SN,SiteAddress,DVRIP,PanelIP,RouterIp,ATMID_2,ATMID_3,live_date,Zone,State from sites where Customer='" . $client . "' and Bank='" . $bank . "' and live='Y'";
$sql_qry = "SELECT id,SN,month_date FROM `newnetwork_report` WHERE month='".$month."' AND year='".$year."' AND month_date='2023-02-28' and is_update=0";
//echo $sql_qry;die;
 $sql = mysqli_query($con,$sql_qry); 
 $yesterday = date('Y-m-d',strtotime("-1 days"));
	$today = date('Y-m-d');
$count = 0; 
if(mysqli_num_rows($sql)){
	while($sql_result = mysqli_fetch_assoc($sql)){
		$id = $sql_result['id'];
		
	    $SN = $sql_result['SN'];
	    
	
	    $total_uptime = 0;$total_downtime = 0;
	    $tot_cnt = 0;
	
		$mon_date = $sql_result['month_date'];
		
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
	
			$set_sql = "UPDATE `newnetwork_report` SET `uptime`='".$total_uptime."', `downtime`='".$total_downtime."',`is_update`='1' where id='" . $id . "'";
			$set_result = mysqli_query($con, $set_sql);
            
			
		}
	}
		CloseCon($con);
	?>
                     