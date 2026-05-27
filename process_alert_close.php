<?php
include('config.php');
$panel_id = $_POST['panel_id'];
$alert_type = $_POST['alert_type'];
$atmid = $_POST['atm_id'];
$alert_close_type = $_POST['alert_close_type'];

$check_ticket_sql = mysqli_query($con,"SELECT id FROM `alert_ticket_raise` WHERE `ATMID` ='".$atmid."' AND alert_type = '".$alert_type."' AND ticket_status=1 ORDER by id DESC LIMIT 1");
if(mysqli_num_rows($check_ticket_sql)==0){
	$isticketgen = 0;
    if($alert_close_type == 'Alert Close with ticket generate'){
	    $remarks = $_POST['remarks'];
	    $ticket_status = 1;


		if(function_exists('date_default_timezone_set')) {
			date_default_timezone_set("Asia/Kolkata");
		}
		$currentTime = date( 'Y-m-d h:i:s', time () );

		$panel_sql = mysqli_query($con,"SELECT * FROM `sites` WHERE `ATMID` ='".$atmid."'");
		$dvrip = "";
		$location = "";
		$client = "";
		if(mysqli_num_rows($panel_sql)>0){
			$panel_sql_result = mysqli_fetch_assoc($panel_sql);
			$dvrip = $panel_sql_result['DVRIP'];
			$location = $panel_sql_result['SiteAddress'];
			$client = $panel_sql_result['Bank'];
		}
		$_ticketid = 1;
		$ticket_sql = mysqli_query($con,"SELECT * FROM `alert_ticket_raise` ORDER by id DESC LIMIT 1");
		if(mysqli_num_rows($ticket_sql)>0){
			$ticket_sql_result = mysqli_fetch_assoc($ticket_sql);
			$_ticketid = $ticket_sql_result['ticket_id'];
			$_ticketid = $_ticketid + 1;
		}
		$today_date = date("Ymd");
		$alarm = "A";
		$ticketid = $today_date.$alarm.$_ticketid;


		 $sql = "insert into alert_ticket_raise(ticket_id,client,ticket_status,created_date,location,atmid,alert_type,dvr_ip,alarm_type,remarks) values('".$ticketid."','".$client."','".$ticket_status."','".$currentTime."','".$location."','".$atmid."','".$alert_type."','".$dvrip."','".$alarm_type."','".$remarks."')";

		if(mysqli_query($con,$sql)){ 

		  $ticketraiseid = mysqli_insert_id($con);
		  $historysql = "insert into alert_ticket_raise_history(ticket_raise_id,ticket_id,client,ticket_status,created_date,location,atmid,alert_type,dvr_ip,alarm_type,remarks) values('".$ticketraiseid."','".$ticketid."','".$client."','".$ticket_status."','".$currentTime."','".$location."','".$atmid."','".$alert_type."','".$dvrip."','".$alarm_type."','".$remarks."')";
		   mysqli_query($con,$historysql);
		   $isticketgen = 1;
		}
	} 
	$update_sql = "update alerts SET status = 'C' WHERE panelid = '".$panel_id."'";
   
    mysqli_query($con,$update_sql); 
	if($isticketgen==1){
		echo '1';
	}else{
       echo '2';
	}
}else{
	echo '0';
}


?>
	
