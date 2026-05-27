<?php //include('config.php'); ?>
<?php include('db_connection.php'); ?>
<?php 
$client = $_POST['client'];
$bank = $_POST['bank'];
$atmid = $_POST['atmid'];
$con = OpenCon();

if($atmid!=''){
	$sql = mysqli_query($con,"select * from dvr_health where atmid='".$atmid."'");
}else{
	if($bank!=''){
	  $sitesql = mysqli_query($con,"select ATMID from sites where Customer='".$client."' and Bank='".$bank."'");
	}else{
		$sitesql = mysqli_query($con,"select ATMID from sites where Customer='".$client."'");
	}
	//$atmidarray = [];
	while($sitesql_result = mysqli_fetch_assoc($sitesql)){
		$atmidarray[] = $sitesql_result['ATMID'];
		//array_push($atmidarray,(string)$atmid);
	}
	$atmidarray=json_encode($atmidarray);
	$atmidarray=str_replace( array('[',']','"') , ''  , $atmidarray);
	$arr=explode(',',$atmidarray);
	$atmidarray = "'" . implode ( "', '", $arr )."'";
	
	$testsql = "SELECT * FROM dvr_health WHERE atmid IN (".$atmidarray.")";
    $sql = mysqli_query($con,$testsql);
}
$dvr_online_count = 0;
$dvr_offline_count = 0;

$camera_working_count = 0;
$camera_notworking_count = 0;
$hdd_fail_count = 0;
if(mysqli_num_rows($sql)){
	while($sql_result = mysqli_fetch_assoc($sql)){
		if($sql_result['login_status']=='0'){
			$dvr_online_count = $dvr_online_count + 1;
		}else{
			$dvr_offline_count = $dvr_offline_count + 1;
		}
		
		if($sql_result['cam1']=='working'){
			$camera_working_count = $camera_working_count + 1;
		}else{
			$camera_notworking_count = $camera_notworking_count + 1;
		}
		
		if($sql_result['cam2']=='working'){
			$camera_working_count = $camera_working_count + 1;
		}else{
			$camera_notworking_count = $camera_notworking_count + 1;
		}
		
		if($sql_result['cam3']=='working'){
			$camera_working_count = $camera_working_count + 1;
		}else{
			$camera_notworking_count = $camera_notworking_count + 1;
		}
		
		if($sql_result['cam4']=='working'){
			$camera_working_count = $camera_working_count + 1;
		}else{
			$camera_notworking_count = $camera_notworking_count + 1;
		}
		
		if($sql_result['hdd']!='ok'){
			$hdd_fail_count = $hdd_fail_count + 1;
		}
	}
}

$array = array(['dvr_online_count'=>$dvr_online_count,'dvr_offline_count'=>$dvr_offline_count,
                 'camera_working_count'=>$camera_working_count,'camera_notworking_count'=>$camera_notworking_count,
				 'hdd_fail_count'=>$hdd_fail_count]);
CloseCon($con);
echo json_encode($array);
?>


