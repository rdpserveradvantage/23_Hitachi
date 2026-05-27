<?php date_default_timezone_set('Asia/Kolkata');
include('eazyinfra_functions.php'); 
//$onoff_type = $_POST['onoff_type'];
//$_ipaddress = $_POST['ip_address'];
//$set_type = $_POST['set_type'];

//$_ipaddress = '10.109.71.124';
$_ipaddress = '10.109.71.222';
$is_macid = 0;
$group_id = "0";
$org_id = 1004;
$get_atmid_sql = mysqli_query($con,"select ATMID from all_dvr_live where IPAddress='".$_ipaddress."'");
if(mysqli_num_rows($get_atmid_sql)>0){
  $get_atmid_data = mysqli_fetch_assoc($get_atmid_sql);
  $_atmid = $get_atmid_data['ATMID'];
  $get_macid_sql = mysqli_query($con,"select mac_id from panel_health_api_response where atmid='".$_atmid."'");
  if(mysqli_num_rows($get_macid_sql)>0){
	$get_macid_data = mysqli_fetch_assoc($get_macid_sql);
    $mac_id = $get_macid_data['mac_id'];
	$get_orgid_sql = mysqli_query($con,"select org_id from panel_macid_orgid where mac_id='".$mac_id."'");
	if(mysqli_num_rows($get_atmid_sql)>0){
	  $get_orgid_data = mysqli_fetch_assoc($get_orgid_sql);
	  $org_id = $get_orgid_data['org_id'];
	}
	
	$is_macid = 1;
  }
}

//$mac_id = $_POST['mac_id'];


function getAccessToken($refresh_token){
		$curl = curl_init();

		curl_setopt_array($curl, array(
		  CURLOPT_URL => 'http://103.141.218.138:4510/user/accesstoken',
		  CURLOPT_RETURNTRANSFER => true,  
		  CURLOPT_HEADER => 0,
		  CURLOPT_ENCODING => '',
		  CURLOPT_MAXREDIRS => 10,
		  CURLOPT_TIMEOUT => 0,
		  CURLOPT_FOLLOWLOCATION => true,
		  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		  CURLOPT_CUSTOMREQUEST => 'POST',
          CURLOPT_SSL_VERIFYPEER => false,
		  CURLOPT_HTTPHEADER => array(
			'refresh_token: '.$refresh_token
		  ),
		));

		$response = curl_exec($curl);
        if(curl_error($curl)) {  
			print_r( curl_error($curl));  
		} 
		//echo '<pre>';print_r($response->statusCode);echo '</pre>';die;
		$_check_res = json_decode($response,true);
		//echo '<pre>';print_r($_check_res);echo '</pre>';
		//echo $_check_res['statusCode'];die;
		//die;
		//echo $response;
		
		if($_check_res['statusCode']=='403'){
			$new_access_token  = getLogin();
		}else{
			$curl = curl_init();

			curl_setopt_array($curl, array(
			  CURLOPT_URL => 'http://103.141.218.138:4510/user/accesstoken',
			  CURLOPT_RETURNTRANSFER => true,  
			  CURLOPT_HEADER => 1,
			  CURLOPT_ENCODING => '',
			  CURLOPT_MAXREDIRS => 10,
			  CURLOPT_TIMEOUT => 0,
			  CURLOPT_FOLLOWLOCATION => true,
			  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			  CURLOPT_CUSTOMREQUEST => 'POST',
			  CURLOPT_SSL_VERIFYPEER => false,
			  CURLOPT_HTTPHEADER => array(
				'refresh_token: '.$refresh_token
			  ),
			));

			$response = curl_exec($curl);
			if(curl_error($curl)) {  
				print_r( curl_error($curl));  
			} 
			
			$headerSize = curl_getinfo( $curl , CURLINFO_HEADER_SIZE );
			$headerStr = substr( $response , 0 , $headerSize );
			$bodyStr = substr( $response , $headerSize );
		 
			// convert headers to array
			$headers = headersToArray( $headerStr );
			$new_access_token = $headers['access_token'];
			curl_close($curl);
		}
		
		if($new_access_token!=''){
		    return $new_access_token;
		}else{
			return '';
		}
	}
	
	function getLogin(){
		$curl = curl_init();
        $postData = [
			'email' => 'api@cts.in',
			'password' => 'api@123'
		];
		curl_setopt_array($curl, array(
		  CURLOPT_URL => 'http://103.141.218.138:4510/user/login',
		  CURLOPT_RETURNTRANSFER => true,  
		  CURLOPT_HEADER => 1,
		  CURLOPT_ENCODING => '',
		  CURLOPT_MAXREDIRS => 10,
		  CURLOPT_TIMEOUT => 0,
		  CURLOPT_FOLLOWLOCATION => true,
		  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		  CURLOPT_CUSTOMREQUEST => 'POST',
          CURLOPT_SSL_VERIFYPEER => false,
		  CURLOPT_POSTFIELDS => json_encode($postData),   
		  CURLOPT_HTTPHEADER => array(
			'Content-Type: application/json'
		  ), 
		));

		$response = curl_exec($curl);
        if(curl_error($curl)) {  
			print_r( curl_error($curl));  
		} 
		
		//echo $response;die;
		$headerSize = curl_getinfo( $curl , CURLINFO_HEADER_SIZE );
		$headerStr = substr( $response , 0 , $headerSize );
		$bodyStr = substr( $response , $headerSize );

		// convert headers to array
		$headers = headersToArray( $headerStr );
		$new_access_token = $headers['access_token'];
		curl_close($curl);
		if($new_access_token!=''){
		    return $new_access_token;
		}else{
			return '';
		}
	}

$_is_panel_zonedata = 0;

//$onoff_type = 1;
//$mac_id = "30000328";
//$set_type = 234;

if($is_macid==1){
	

	$get_details = json_decode(getPanelZoneData($org_id,$group_id,$mac_id,$access_token,$con),true);
	//echo '<pre>';print_r($get_details);echo '</pre>';die;
	if($get_details['statusCode']==200){
		$_is_panel_zonedata = 1;
		$panel_zone_data_array = $get_details['result'][0]['latest_config']['zone_config'];
		$connection_display = $get_details['result'][0]['latest_config']['connection_display'];
		//echo '<pre>';print_r($get_details['result'][0]['latest_config']);echo '</pre>';die;
		$array = array(['statusCode'=>200]);
	}
	else if($get_details['statusCode']==401){
		$login_data = user_login($email,$password,$con);
		$new_access_token  = getAccessToken($refresh_token);
		$access_token =  $new_access_token;		
		if($new_access_token!=''){
			mysqli_query($con,"update ems_login_access_panel_health set access_token='".$new_access_token."' where id=2");
			
		    $get_details = json_decode(getPanelZoneData($org_id,$group_id,$mac_id,$access_token,$con),true);
			//echo '<pre>';print_r($get_details);echo '</pre>';die;
			//$array = $get_details;
			$_is_panel_zonedata = 1;
			$panel_zone_data_array = $get_details['result'][0]['latest_config']['zone_config'];
			$connection_display = $get_details['result'][0]['latest_config']['connection_display'];
			$array = array(['statusCode'=>200]);
		}else{
		//	echo 'Something Wrong check login credentials!';
			$array = array(['statusCode'=>203,'status'=>'Fail','statusMessage'=>'Something Wrong check login credentials!']);
		}
	}
	else if($get_details['statusCode']==403){
		$login_data = user_login($email,$password,$con);
		$new_access_token  = getAccessToken($refresh_token);
		$access_token =  $new_access_token;		
		if($new_access_token!=''){
			mysqli_query($con,"update ems_login_access_panel_health set access_token='".$new_access_token."' where id=2");
			
		    $get_details = json_decode(getPanelZoneData($org_id,$group_id,$mac_id,$access_token,$con),true);
			//echo '<pre>';print_r($get_details);echo '</pre>';die;
			//$array = $get_details;
			$_is_panel_zonedata = 1;
			$panel_zone_data_array = $get_details['result'][0]['latest_config']['zone_config'];
			$connection_display = $get_details['result'][0]['latest_config']['connection_display'];
		}else{
		//	echo 'Something Wrong check login credentials!';
			$array = array(['statusCode'=>203,'status'=>'Fail','statusMessage'=>'Something Wrong check login credentials!']);
		}
	}
	else{
		//echo '<pre>';print_r($get_details);echo '</pre>';
		$array = $get_details;
		//$array = array(['statusCode'=>203,'status'=>'Fail','statusMessage'=>'No mac id exists for given IPAddress']);
	}
}else{
	$array = array(['statusCode'=>202,'status'=>'Fail','statusMessage'=>'No mac id exists for given IPAddress']);
}

if($_is_panel_zonedata == 1){
	$panel_health_status_qry = "update panel_health_update set status='".$connection_display."'";
    
	$_key = 0;
	foreach($panel_zone_data_array as $panel_zone_data_arr_value){
		
		//echo '<pre>';print_r($panel_zone_data_arr_value);echo '</pre>'; 
		$zone_no = $panel_zone_data_arr_value['zone_no'];
		$zone_status = $panel_zone_data_arr_value['status'];
		$zone_column_name = 'zon'.$zone_no;
		$panel_health_status_qry = $panel_health_status_qry.", ".$zone_column_name. " = '".$zone_status."'";
		
	}
	
	$panel_health_status_qry = $panel_health_status_qry."  where ip='".$_ipaddress."'";
	//echo $panel_health_status_qry;die;
	mysqli_query($con, $panel_health_status_qry);
}


echo json_encode($array);

?>
