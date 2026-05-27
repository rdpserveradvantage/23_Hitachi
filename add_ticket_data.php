<?php 

function startsWith ($string, $startString){
    $len = strlen($startString);
    return (substr($string, 0, $len) === $startString);
}


function get_atmdetails($atmid,$parameter_name,$con){
	//global $con;
  //  $con = OpenCon();
	$sql = mysqli_query($con,"select $parameter_name from sites where ATMID='".$atmid."'");
	$sql_result = mysqli_fetch_assoc($sql);
  //  CloseCon($con);
	return $sql_result[$parameter_name];
}

function get_allalert_type($atmid,$con){
	//global $con;
  //  $con = OpenCon();
	$sql = mysqli_query($con,"select Panel_Make from sites where ATMID='".$atmid."'");
	$sql_result = mysqli_fetch_assoc($sql);
    $panelmake = $sql_result['Panel_Make'];
	
	if($panelmake=='RASS'){
		$rass_sql = mysqli_query($con,"SELECT SensorName FROM `rass`");
	}
	if($panelmake=='rass_cloud'){
		$rass_sql = mysqli_query($con,"SELECT SensorName FROM `rass_cloud`");
	}
	if($panelmake=='SMART-IN'){
		$rass_sql = mysqli_query($con,"SELECT SensorName FROM `smarti`");
	} 		
	if($panelmake=='rass_cloudnew'){
		$rass_sql = mysqli_query($con,"SELECT SensorName FROM `rass_cloudnew`");
	} 	
	
	
	$sensor_sql_result = mysqli_fetch_assoc($rass_sql);
	//CloseCon($con);
	return json_encode($sensor_sql_result);
}



?>


