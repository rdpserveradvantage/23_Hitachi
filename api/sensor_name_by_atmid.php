<?php include('db_connection.php'); 
	 date_default_timezone_set('Asia/Kolkata');
	 $con = OpenCon();


	$atmid = $_POST['atmid'];
	$panelsql = mysqli_query($con,"select Panel_Make from sites where ATMID='".$atmid."'");
	$panelsql_result = mysqli_fetch_assoc($panelsql);

	$panel_name = $panelsql_result['Panel_Make'];

    $paramater = 'SensorName';
	
	if($panel_name=='comfort'){
		$sql = mysqli_query($con,"select $paramater from comfort");
	}
	if($panel_name=='rass_boi'){
		$sql = mysqli_query($con,"select $paramater from rass_boi");
	}
	if($panel_name=='rass_pnb'){
		$sql = mysqli_query($con,"select $paramater from rass_pnb");
	}
	if($panel_name=='smarti_boi'){
		$sql = mysqli_query($con,"select $paramater from smarti_boi");
	}
	if($panel_name=='smarti_pnb'){
		$sql = mysqli_query($con,"select $paramater from smarti_pnb");
	}
	
    if($panel_name=='RASS'){
		$sql = mysqli_query($con,"select $paramater from rass");
	}
    if($panel_name=='rass_cloud'){
		$sql = mysqli_query($con,"select $paramater from rass_cloud");
	}
	if($panel_name=='rass_cloudnew'){
		$sql = mysqli_query($con,"select $paramater from rass_cloudnew");
	}
	if($panel_name=='rass_sbi'){
		$sql = mysqli_query($con,"select $paramater from rass_sbi");
	}
	if($panel_name=='SEC'){
		$sql = mysqli_query($con,"select $paramater from securico");
	}
	if($panel_name=='securico_gx4816'){
		$sql = mysqli_query($con,"select $paramater from securico_gx4816");
	}
	if($panel_name=='sec_sbi'){
		$sql = mysqli_query($con,"select $paramater from sec_sbi");
	}
	if($panel_name=='Raxx'){
		$sql = mysqli_query($con,"select $paramater from raxx");
	}
	if($panel_name=='SMART -I'){
		$sql = mysqli_query($con,"select $paramater from smarti");
	}
	if($panel_name=='SMART-IN'){
		$sql = mysqli_query($con,"select $paramater from smartinew");
	}
	if($panel_name=='rass_boi'){
		$sql = mysqli_query($con,"select $paramater from rass_boi");
	}
	$res_data = [];
    if(mysqli_num_rows($sql)>0){
	  while($result_data = mysqli_fetch_assoc($sql)){
		$value['label'] = $result_data['SensorName']; 
		$value['value'] = $result_data['SensorName'];   
		array_push($res_data,$value);  
	  }
	}
	
	
if(count($res_data)>0){
	$array = array(['Code'=>200,'res_data'=>$res_data]);
}else{
	$array = array(['Code'=>201]);
}


CloseCon($con);
echo json_encode($array);
?>