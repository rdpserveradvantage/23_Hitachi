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
//$mon_date = $today;
//$mon_date = '2023-05-14';
$mon_date = date('Y-m-d',strtotime("-1 days"));
//echo $mon_date;die;
$sql_qry = "select ATMID,SN,SiteAddress,DVRIP,PanelIP,RouterIp,ATMID_2,ATMID_3,live_date,Zone,State,NewPanelID from sites where Customer='" . $client . "' and Bank='" . $bank . "' and live='Y' AND SN NOT IN (SELECT SN from `newalert_report` WHERE month_date='".$mon_date."')";

//echo $sql_qry;die;
 $sql = mysqli_query($con,$sql_qry); 
 $yesterday = date('Y-m-d',strtotime("-1 days"));
	
$count = 0; 
if(mysqli_num_rows($sql)){
	while($sql_result = mysqli_fetch_assoc($sql)){
		$atm_id = $sql_result['ATMID'];
		$_view = 1;

		if($_view == 1){
			$newpanelid = $sql_result['NewPanelID'];
			$SN = $sql_result['SN'];
			$_liv_dt = $sql_result['live_date'];
			//$count++;
			
			$total_uptime = 0;$total_downtime = 0;
			$tot_cnt = 0;
	
			//$mon_date = $today;
			$newnet_qry_sql = "SELECT * FROM `alerts` WHERE panelid='" . $newpanelid . "' AND CAST(createtime AS DATE)='".$mon_date."' AND sendtoclient='S' AND status='C'";
			
			$newnet_sql_res = mysqli_query($con, $newnet_qry_sql);
			
			if(mysqli_num_rows($newnet_sql_res)>0){
				while($_insdata = mysqli_fetch_assoc($newnet_sql_res)){  
				    $event_occurence = $_insdata['createtime'];
					$event_closure = $_insdata['closedtime'];
					$alert_type = $_insdata['alerttype'];
					$total_time_to_close = "0";
					$is_2way_audio_used = "yes";
					$comment = $_insdata['comment'];
					$set_sql = "INSERT INTO `newalert_report`( `SN`, `ATMID`, `month_date`, `event_occurence`,`event_closure`,`alert_type`,`total_time_to_close`,`is_2way_audio_used`,`comments`, `created_at`) VALUES ('" . $SN . "','".$atm_id."','" . $mon_date . "','" . $event_occurence . "','" . $event_closure . "','".$alert_type."','" . $total_time_to_close . "','" . $is_2way_audio_used . "','" . $comment . "','" . $created_at . "') ";
					$set_result = mysqli_query($con, $set_sql);
					$count = $count + 1;
				}
			}
		}
	}
}
		CloseCon($con);
		echo $count;
	?>
                     