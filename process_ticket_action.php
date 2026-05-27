<?php include('db_connection.php'); 
$con = OpenCon();
$id = $_POST['id'];
$ticket_status = $_POST['ticket_status'];
$remarks = $_POST['remarks'];
$alert = $_POST['alert_type'];
if($alert=='A'){
	$ticketsql = mysqli_query($con,"select * from alert_ticket_raise where id='".$id."'");
}else{
    $ticketsql = mysqli_query($con,"select * from ticket_raise where id='".$id."'");
}
    $ticket_data = mysqli_fetch_assoc($ticketsql);   
    $atmid = $ticket_data['atmid'];
	$alert_type = $ticket_data['alert_type'];
	$dvrip = $ticket_data['dvr_ip'];
	$location = $ticket_data['location'];
	if(function_exists('date_default_timezone_set')) {
		date_default_timezone_set("Asia/Kolkata");
	}
	$currentTime = date( 'Y-m-d h:i:s', time () );

	$client = $ticket_data['client'];
    $ticketid = $ticket_data['ticket_id'];
	$alarm_type = $ticket_data['alarm_type'];
	$ticketraiseid = $ticket_data['id'];
	
if($ticket_status=='1'){
	if($alert=='A'){
		$sql = "insert into alert_ticket_raise_history(ticket_raise_id,ticket_id,client,ticket_status,created_date,location,atmid,alert_type,dvr_ip,alarm_type,remarks) values('".$ticketraiseid."','".$ticketid."','".$client."','".$ticket_status."','".$currentTime."','".$location."','".$atmid."','".$alert_type."','".$dvrip."','".$alarm_type."','".$remarks."')";
	}else{
	 $sql = "insert into ticket_raise_history(ticket_raise_id,ticket_id,client,ticket_status,created_date,location,atmid,alert_type,dvr_ip,alarm_type,remarks) values('".$ticketraiseid."','".$ticketid."','".$client."','".$ticket_status."','".$currentTime."','".$location."','".$atmid."','".$alert_type."','".$dvrip."','".$alarm_type."','".$remarks."')";
	}
}else{
	if($alert=='A'){
	 $sql = "insert into alert_ticket_raise_history(ticket_raise_id,ticket_id,client,ticket_status,close_date,location,atmid,alert_type,dvr_ip,alarm_type,remarks) values('".$ticketraiseid."','".$ticketid."','".$client."','".$ticket_status."','".$currentTime."','".$location."','".$atmid."','".$alert_type."','".$dvrip."','".$alarm_type."','".$remarks."')";	
	 $update_sql = "update alert_ticket_raise SET ticket_status = 0,close_date='".$currentTime."' WHERE id = '".$id."'"; 
	}else{
	 $sql = "insert into ticket_raise_history(ticket_raise_id,ticket_id,client,ticket_status,close_date,location,atmid,alert_type,dvr_ip,alarm_type,remarks) values('".$ticketraiseid."','".$ticketid."','".$client."','".$ticket_status."','".$currentTime."','".$location."','".$atmid."','".$alert_type."','".$dvrip."','".$alarm_type."','".$remarks."')";
     $update_sql = "update ticket_raise SET ticket_status = 0,close_date='".$currentTime."' WHERE id = '".$id."'";
	}
}

	if(mysqli_query($con,$sql)){ 
      
   
        mysqli_query($con,$update_sql);
		CloseCon($con);
    echo '1';
	}else{
		CloseCon($con);
		echo '0';
	}
 ?>
 