<?php include('db_connection.php'); ?>
<?php 
$client = $_POST['client'];
$bank = $_POST['bank'];
$atmid = $_POST['atmid'];

/*
$client = 'Hitachi';
$bank = 'PNB';
$atmid = 'AB930300'; */
$con = OpenCon();


$port1 = 0;
$port2 = 0;
$port3 = 0;
$port4 = 0;

$live_sql = mysqli_query($con,"select * from ip_camera_details where ATMID='".$atmid."'");
if(mysqli_num_rows($live_sql)>0){
	$livesql_result = mysqli_fetch_assoc($live_sql);
	$cam1 = $livesql_result['cam1'];
	$cam2 = $livesql_result['cam2'];
	$cam3 = $livesql_result['cam3'];
	$cam4 = $livesql_result['cam4'];
	
	$port1 = $livesql_result['port1'];
	$port2 = $livesql_result['port2'];
	$port3 = $livesql_result['port3'];
	$port4 = $livesql_result['port4'];
	
	$username1 = $livesql_result['username1'];
	$username2 = $livesql_result['username2'];
	$username3 = $livesql_result['username3'];
	$username4 = $livesql_result['username4'];
	
	$password1 = $livesql_result['password1'];
	$password2 = $livesql_result['password2'];
	$password3 = $livesql_result['password3'];
	$password4 = $livesql_result['password4'];
	
	$dvrip = $livesql_result['DVRIP'];
	
}

$sql = mysqli_query($con,"select * from sites where Customer='".$client."' and ATMID='".$atmid."' and Bank='".$bank."'");
if(mysqli_num_rows($sql)>0){
    $sql_result = mysqli_fetch_assoc($sql);
	$dvrip = $sql_result['DVRIP'];
	$dvr_model = $sql_result['DVRName'];
	$UserName = $sql_result['UserName'];
	$Password = $sql_result['Password'];
	if($port1==0){
		$username1 = $UserName;
		$password1 = $Password;
		$cam1 = $dvr_model;
		$port1 = "554";
	}
	if($port2==0){
		$username2 = $UserName;
		$password2= $Password;
		$cam2 = $dvr_model;
		$port2 = "554";
	}
	if($port3==0){
		$username3 = $UserName;
		$password3 = $Password;
		$cam3 = $dvr_model;
		$port3 = "554";
	}
	if($port4==0){
		$username4 = $UserName;
		$password4 = $Password;
		$cam4 = $dvr_model;
		$port4 = "554";
	}
}
CloseCon($con);
$sql_result['cam1'] = "Lobby Camera";
$sql_result['cam2'] = "Backroom Camera";
$sql_result['cam3'] = "Outdoor Camera";
$sql_result['cam4'] = "Lobby IP Camera";
$array = array(['username1'=>$username1,'password1'=>$password1,'cam1'=>$cam1,'port1'=>$port1,
                'username2'=>$username2,'password2'=>$password2,'cam2'=>$cam2,'port2'=>$port2,
				'username3'=>$username3,'password3'=>$password3,'cam3'=>$cam3,'port3'=>$port3,
				'username4'=>$username4,'password4'=>$password4,'cam4'=>$cam4,'port4'=>$port4,
				'dvrip'=>$dvrip,'cam1_name'=>'Lobby Camera','cam2_name'=>'Backroom Camera','cam3_name'=>'Outdoor Camera','cam4_name'=>'Lobby IP Camera']);
echo json_encode($array);
?>





