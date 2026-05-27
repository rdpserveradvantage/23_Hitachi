<?php 
    include('db_connection.php'); 
	$con = OpenCon(); 
	date_default_timezone_set('Asia/Kolkata');
	$rtime = '2022-11-16 00:00:00';
    $qr = mysqli_query($con,"SELECT * FROM wsites where rtime='".$rtime."'");
	$nrws=mysqli_num_rows($qr);
    while($qrfetch=mysqli_fetch_array($qr)){
		echo '<pre>';print_r($qrfetch);echo '</pre>';
	}
	
CloseCon($con);
//echo json_encode($data); 

?>