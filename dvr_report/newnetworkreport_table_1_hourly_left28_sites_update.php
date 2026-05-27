<?php 
include('../db_connection.php'); $con = OpenCon();
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

$one_less = $nowtime_hour - 1;
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

$bank = "PNB"; 

if($nowtime_hour==23){
	$nowtime_hour = 24;
}

$set_sql = "UPDATE `newdvr_report` SET `cam1_uptime`='".$nowtime_hour."', `cam1_downtime`='0',`cam2_uptime`='".$nowtime_hour."', `cam2_downtime`='0',`cam3_uptime`='".$nowtime_hour."', `cam3_downtime`='0',`cam4_uptime`='".$nowtime_hour."', `cam4_downtime`='0',`is_update`='1',`today_tot_hit`='".$nowtime_hour."' where month_date='" . $mon_date . "'";
$set_result = mysqli_query($con, $set_sql);

$sql_qry = "SELECT d.cam1,d.cam2,d.cam3,d.cam4,dr.SN,dr.id,dr.cam1_uptime,dr.cam1_downtime,dr.cam2_uptime,dr.cam2_downtime,dr.cam3_uptime,dr.cam3_downtime,dr.cam4_uptime,dr.cam4_downtime FROM `dvr_report_update_few_sites` d inner join newdvr_report dr ON d.SN=dr.SN AND dr.month_date='".$mon_date."'";

$sql = mysqli_query($con,$sql_qry); 
$yesterday = date('Y-m-d',strtotime("-1 days"));
$today = date('Y-m-d');
$count = 0; 
//echo mysqli_num_rows($sql);die;
if(mysqli_num_rows($sql)){
	while($sql_result = mysqli_fetch_assoc($sql)){
		$sn = $sql_result['SN'];$id = $sql_result['id'];
		$cam1_uptime = $sql_result['cam1_uptime'];$cam1_downtime = $sql_result['cam1_downtime'];
		$cam2_uptime = $sql_result['cam2_uptime'];$cam2_downtime = $sql_result['cam2_downtime'];
		$cam3_uptime = $sql_result['cam3_uptime'];$cam3_downtime = $sql_result['cam3_downtime'];
		$cam4_uptime = $sql_result['cam4_uptime'];$cam4_downtime = $sql_result['cam4_downtime'];
		$cam1 = $sql_result['cam1'];$cam2 = $sql_result['cam2'];
		$cam3 = $sql_result['cam3'];$cam4 = $sql_result['cam4'];
		if($cam1==1){
			$cam1_downtime = $cam1_downtime + 1;
		}else{
			$cam1_uptime = $cam1_uptime + 1;
		}
		if($cam2==1){
			$cam2_downtime = $cam2_downtime + 1;
		}else{
			$cam2_uptime = $cam2_uptime + 1;
		}
		if($cam3==1){
			$cam3_downtime = $cam3_downtime + 1;
		}else{
			$cam3_uptime = $cam3_uptime + 1;
		}
		if($cam4==1){
			$cam4_downtime = $cam4_downtime + 1;
		}else{
			$cam4_uptime = $cam4_uptime + 1;
		}
		$set_sql = "UPDATE `newdvr_report` SET `cam1_uptime`='".$cam1_uptime."', `cam1_downtime`='".$cam1_downtime."',`cam2_uptime`='".$cam2_uptime."', `cam2_downtime`='".$cam2_downtime."',`cam3_uptime`='".$cam3_uptime."', `cam3_downtime`='".$cam3_downtime."',`cam4_uptime`='".$cam4_uptime."', `cam4_downtime`='".$cam4_downtime."',`is_update`='1',`today_tot_hit`='".$nowtime_hour."' where id='" . $id . "'";
	    $set_result = mysqli_query($con, $set_sql);
	}
}

CloseCon($con);
?>
                     