<?php include('db_connection.php'); $con = OpenCon();
date_default_timezone_set('Asia/Kolkata');
$today = date('Y-m-d');
$created_at = date('Y-m-d H:i:s');

$newnet_qry_sql = "SELECT SN,CNT from (SELECT SN,COUNT(id) AS CNT FROM `newnetwork_report` WHERE month_date='2023-06-08' AND month='6' AND year='2023' group by SN) AS t WHERE t.CNT>1";

$newnet_sql_res = mysqli_query($con, $newnet_qry_sql);
//echo mysqli_num_rows($newnet_sql_res);
$cnt = 0;
while($newnetrepsql_result = mysqli_fetch_assoc($newnet_sql_res)){
	$SN = $newnetrepsql_result['SN'];
	$CNT = $newnetrepsql_result['CNT'];
	if($CNT>1){
		$net_qry_sql = "SELECT id,SN,uptime,downtime FROM `newnetwork_report` WHERE SN='".$SN."' AND month_date='2023-06-07' AND month='6' AND year='2023' order by id desc limit 1";
		$net_sql_res = mysqli_query($con, $net_qry_sql);
		while($netrepsql_result = mysqli_fetch_assoc($net_sql_res)){
			$SN = $netrepsql_result['SN'];
			$id = $netrepsql_result['id'];
			$net_uptime = $netrepsql_result['uptime'];
			$net_downtime = $netrepsql_result['downtime'];
			$sum = $net_uptime + $net_downtime;
			
			if($sum<11){
				$cnt = $cnt + 1;
				//echo $id."_";
				//$del = "DELETE FROM `newnetwork_report` WHERE id='".$id."'";
				//mysqli_query($con, $del);
			}
		}
	}
}

echo $cnt;
					
					