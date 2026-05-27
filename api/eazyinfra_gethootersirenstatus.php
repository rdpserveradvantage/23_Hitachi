<?php date_default_timezone_set('Asia/Kolkata');
include('eazyinfra_functions.php'); 
//$panel_id = $_POST['panel_id'];
//$group_id = $_POST['group_id'];
$panel_id = "565656";
$group_id = "29";
$get_details = json_decode(getHooterSirenStatus($org_id,$panel_id,$group_id,$access_token,$con),true);
//echo '<pre>';print_r($get_details);echo '</pre>';
if($get_details['statusCode']==200){
	echo json_encode($get_details);
}
else if($get_details['statusCode']==401){
	$login_data = userlogin($email,$password,$con);
	if($login_data==1){
		$ems_login_sql = mysqli_query($con,"select email,password,access_token,org_id,refresh_token from eazyinfra_login_access where id=1");
        $ems_login_access = mysqli_fetch_assoc($ems_login_sql);
		$access_token = $ems_login_access['access_token'];
		$org_id = $ems_login_access['org_id'];
		$refresh_token = $ems_login_access['refresh_token'];

		$email=$ems_login_access['email'];
		$password=$ems_login_access['password']; 
		$get_details = json_decode(getHooterSirenStatus($org_id,$panel_id,$group_id,$access_token,$con),true);
		echo json_encode($get_details);
	}else{
		echo 'Something Wrong check login credentials!';
	}
}else{
	echo 'Something Wrong !';
}


