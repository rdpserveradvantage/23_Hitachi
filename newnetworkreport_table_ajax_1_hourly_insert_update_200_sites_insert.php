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
$month = 4;
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
$sql_qry = "select ATMID,SN,SiteAddress,DVRIP,PanelIP,RouterIp,ATMID_2,ATMID_3,live_date,Zone,State from sites where Customer='" . $client . "' and Bank='" . $bank . "' and live='Y' AND SN IN ( SELECT SN FROM `newnetwork_report` WHERE month_date='2023-04-05' AND uptime=0 AND SN NOT IN (
'3284','3334','3533','3378','3510','3518','3639','3844','3865','3950','3989','4029','4112','4200','4219','4549','10060','4538','4635','4764','4968','5051','5081','10125','5636','5204','6255',
'3658'
)

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
		$SN = $sql_result['SN'];
		$set_sql = "INSERT INTO `network_report_update_few_sites`( `SN`, `ATMID`, `created_at`) VALUES ('" . $SN . "','" . $atm_id . "','" . $created_at . "') ";
		$set_result = mysqli_query($con, $set_sql);
	}
}
		CloseCon($con);
	?>
                     