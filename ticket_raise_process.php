<?php include('config.php'); ?>
<?php 
$created_by = $_POST['created_by'];
$atmid = $_POST['atmid'];
$alert_type = $_POST['alert_type'];
$alarm_type = $_POST['alarm_type'];
if($alarm_type=='Alert'){
	$check_ticket_sql = mysqli_query($con,"SELECT id FROM `alert_ticket_raise` WHERE `ATMID` ='".$atmid."' AND alert_type = '".$alert_type."' AND ticket_status=1 ORDER by id DESC LIMIT 1");
}else{
    $check_ticket_sql = mysqli_query($con,"SELECT id FROM `ticket_raise` WHERE `ATMID` ='".$atmid."' AND alert_type = '".$alert_type."' AND ticket_status=1 ORDER by id DESC LIMIT 1");
}
if(mysqli_num_rows($check_ticket_sql)==0){
if(function_exists('date_default_timezone_set')) {
    date_default_timezone_set("Asia/Kolkata");
}
$currentTime = date( 'Y-m-d h:i:s', time () );

$panel_sql = mysqli_query($con,"SELECT * FROM `sites` WHERE `ATMID` ='".$atmid."'");
$dvrip = "";
$location = "";
if(mysqli_num_rows($panel_sql)>0){
	$panel_sql_result = mysqli_fetch_assoc($panel_sql);
	$dvrip = $panel_sql_result['DVRIP'];
	$location = $panel_sql_result['SiteAddress'];
}
$_ticketid = 1;
if($alarm_type=='Alert'){
	$ticket_sql = mysqli_query($con,"SELECT * FROM `alert_ticket_raise` ORDER by id DESC LIMIT 1");
}else{
 $ticket_sql = mysqli_query($con,"SELECT * FROM `ticket_raise` ORDER by id DESC LIMIT 1");
}
if(mysqli_num_rows($ticket_sql)>0){
	$ticket_sql_result = mysqli_fetch_assoc($ticket_sql);
	$_ticketid = $ticket_sql_result['ticket_id'];
	$_ticketid = $_ticketid + 1;
}
$today_date = date("Ymd");
if($alarm_type=='DVR'){
	$alarm = "D";
}
if($alarm_type=='Panel'){
	$alarm = "P";
}
if($alarm_type=='Alert'){
	$alarm = "A";
}

$ticketid = $today_date.$alarm.$_ticketid;
$client = $_POST['client'];


$remarks = $_POST['remarks'];
$ticket_status = 1;
if($alarm_type=='Alert'){
	$sql = "insert into alert_ticket_raise(ticket_id,client,ticket_status,created_date,location,atmid,alert_type,dvr_ip,alarm_type,remarks) values('".$ticketid."','".$client."','".$ticket_status."','".$currentTime."','".$location."','".$atmid."','".$alert_type."','".$dvrip."','".$alarm_type."','".$remarks."')";
}else{
 $sql = "insert into ticket_raise(ticket_id,client,ticket_status,created_date,location,atmid,alert_type,dvr_ip,alarm_type,remarks) values('".$ticketid."','".$client."','".$ticket_status."','".$currentTime."','".$location."','".$atmid."','".$alert_type."','".$dvrip."','".$alarm_type."','".$remarks."')";
}

//echo $sql;die;
if(mysqli_query($con,$sql)){ 

  $ticketraiseid = mysqli_insert_id($con);
  if($alarm_type=='Alert'){
	$historysql = "insert into alert_ticket_raise_history(ticket_raise_id,ticket_id,client,created_by,ticket_status,created_date,location,atmid,alert_type,dvr_ip,alarm_type,remarks) values('".$ticketraiseid."','".$ticketid."','".$client."','".$created_by."','".$ticket_status."','".$currentTime."','".$location."','".$atmid."','".$alert_type."','".$dvrip."','".$alarm_type."','".$remarks."')";  
  }else{
  $historysql = "insert into ticket_raise_history(ticket_raise_id,ticket_id,client,ticket_status,created_date,location,atmid,alert_type,dvr_ip,alarm_type,remarks) values('".$ticketraiseid."','".$ticketid."','".$client."','".$ticket_status."','".$currentTime."','".$location."','".$atmid."','".$alert_type."','".$dvrip."','".$alarm_type."','".$remarks."')";
  }  
  mysqli_query($con,$historysql);
  if($alarm_type=='Alert'){ ?>
	 <script>window.location = "view_alert_ticket.php?success=1";</script> 
<?php  }else{
?>
	<script>window.location = "view_ticket.php?success=1";</script>
  <?php } } }else{ ?>
	<script>window.location = "add_ticket.php?error=1";</script>
<?php }?>

 

