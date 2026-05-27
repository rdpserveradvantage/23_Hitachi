<?php include('db_connection.php'); 
 date_default_timezone_set('Asia/Kolkata');
 $created_at = date('Y-m-d H:i:s');
 $today_date = date('Y-m-d');
 
    function datetimediff($datetime){
	    $datetime1 = new DateTime();
		$datetime2 = new DateTime($datetime);
		$interval = $datetime1->diff($datetime2);
		//$elapsed = $interval->format('%y years %m months %a days %h hours %i minutes %s seconds');
		$elapsed = $interval->format('%i');
		return $elapsed;
    }
    function headersToArray( $str ){
		$headers = array();
		$headersTmpArray = explode( "\r\n" , $str );
		for ( $i = 0 ; $i < count( $headersTmpArray ) ; ++$i )
		{
			// we dont care about the two \r\n lines at the end of the headers
			if ( strlen( $headersTmpArray[$i] ) > 0 )
			{
				// the headers start with HTTP status codes, which do not contain a colon so we can filter them out too
				if ( strpos( $headersTmpArray[$i] , ":" ) )
				{
					$headerName = substr( $headersTmpArray[$i] , 0 , strpos( $headersTmpArray[$i] , ":" ) );
					$headerValue = substr( $headersTmpArray[$i] , strpos( $headersTmpArray[$i] , ":" )+1 );
					$headers[$headerName] = $headerValue;
				}
			}
		}
		return $headers;
	}
	
	function getDevice($url,$access_token){
					
			$curl = curl_init();

			curl_setopt_array($curl, array(
			  CURLOPT_URL => $url,
			  CURLOPT_RETURNTRANSFER => true,
			  CURLOPT_ENCODING => '',
			  CURLOPT_MAXREDIRS => 10,
			  CURLOPT_TIMEOUT => 0,
			  CURLOPT_FOLLOWLOCATION => true,
			  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			  CURLOPT_CUSTOMREQUEST => 'GET',
			  CURLOPT_SSL_VERIFYPEER => false,
			  CURLOPT_HTTPHEADER => array(
				'access_token: '.$access_token
			  ),
			));

			$response = curl_exec($curl);
			if(curl_error($curl)) {  
				print_r( curl_error($curl));  
			}  

			curl_close($curl);
			return $response;
	}
	
	function getAccessToken($refresh_token){
		$curl = curl_init();

		curl_setopt_array($curl, array(
		  CURLOPT_URL => 'http://103.141.218.138:4511/user/accesstoken',
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
			  CURLOPT_URL => 'http://103.141.218.138:4511/user/accesstoken',
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
		  CURLOPT_URL => 'http://103.141.218.138:4511/user/login',
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
?>
<?php 
$org_id_arr = [1,2,4,5,6,7,8,18,22,24,1003,1004];
$org_name_arr = ["CTS","Hitachi","Hitachi SBI TOM","Hitachi Writer","SBI TOM","BOI CTS EM","HDFC Diebold","AGS_HDFC","HDFC Euronet Revamp","BOI CTS","Euronet HDFC","PNB CTS"];

$con = OpenCon();
//$mac_id = $_POST['mac_id'];
$ems_login_sql = mysqli_query($con,"select access_token,org_id,refresh_token from ems_login_access_panel_health where id=2");
$ems_login_access = mysqli_fetch_assoc($ems_login_sql);
$access_token = $ems_login_access['access_token'];
$org_id = $ems_login_access['org_id'];
$refresh_token = $ems_login_access['refresh_token'];


$_panel_health_org_list_sql_ch = mysqli_query($con,"select * from panel_health_orgid_list where today_date='".$today_date."'");
$_total_panel_update = mysqli_num_rows($_panel_health_org_list_sql_ch); 
if($_total_panel_update>0){
   $_panel_health_org_list_access_ch = mysqli_fetch_assoc($_panel_health_org_list_sql_ch);
}else{
   	$_total_panel_update = 0;
	for($i=0;$i<count($org_id_arr);$i++){
		$_org_id_val = $org_id_arr[$i];
		$_org_name_val = $org_name_arr[$i];
		$set_sql = "INSERT INTO `panel_health_orgid_list`( `org_id`, `org_name`, `today_date`, `created_at`, `updated_at`) VALUES ('" . $_org_id_val . "','" . $_org_name_val . "','" . $today_date . "','" . $created_at . "','" . $created_at . "') ";
			//	echo $set_sql;die;
		$set_result = mysqli_query($con, $set_sql);
		$_total_panel_update = $_total_panel_update + 1;
	}
	 
}

$_panel_health_org_list_sql = mysqli_query($con,"select * from panel_health_orgid_list where is_completed=0 AND today_date='".$today_date."'");
$_panel_health_org_list_access = mysqli_fetch_assoc($_panel_health_org_list_sql);
$org_id = $_panel_health_org_list_access['org_id'];
$_id = $_panel_health_org_list_access['id'];

$url = 'http://103.141.218.138:4511/panel/esslist?org_id='.$org_id.'&group_id=0&items_per_page=20&page=1&state=All&active_sort=null&term=&sort_direction=null';

// http://103.141.218.138:4511/panel/esslist?org_id=1004&items_per_page=20&page=1&group_id=0&state=All&active_sort=null&term=&sort_direction=null

//echo $url;
$response = getDevice($url,$access_token);
$check = json_decode($response,true);
//echo '<pre>';print_r($check);echo '</pre>';die;
$mac_array = array();

$_site_update = 0;
$_isatm = 0;
if($check['statusCode']==401){
		$new_access_token  = getAccessToken($refresh_token);
        $access_token = $new_access_token;		
		//echo $access_token;die;
		if($new_access_token!=''){
			mysqli_query($con,"update ems_login_access_panel_health set access_token='".$new_access_token."' where id=2");
			$response = getDevice($url,$new_access_token);
			$check = json_decode($response,true);
			//echo '<pre>';print_r($check);echo '</pre>';die;
			$_newdata = [];
			/*
			if($check['statusCode']==200){
				$gwlist = $check['result']['count'];
				$healthy_count = $gwlist['healthy_count'];
				$offline_count = $gwlist['offline_count'];
				$faulty_count = $gwlist['faulty_count'];
				$online_count = $gwlist['online_count'];
				$uncalibrated_count = $gwlist['uncalibrated_count'];
				$total = $gwlist['total'];
				$totalItems = $total;
				$totalPages = ceil($totalItems / $itemsPerPage);
			}
			*/
		}else{
			echo '201';
		}
		
}else{
	
	$_newdata = [];
	/*
	if($check['statusCode']==200){
		$gwlist = $check['result']['count'];
		$healthy_count = $gwlist['healthy_count'];
		$offline_count = $gwlist['offline_count'];
		$faulty_count = $gwlist['faulty_count'];
		$online_count = $gwlist['online_count'];
		$uncalibrated_count = $gwlist['uncalibrated_count'];
		$total = $gwlist['total'];
		$totalItems = $total;
		$totalPages = ceil($totalItems / $itemsPerPage);
	} 
	*/
	
}

for($i=0;$i<$_total_panel_update;$i++){
	
	$_panel_health_org_list_sql = mysqli_query($con,"select * from panel_health_orgid_list where is_completed=0 AND today_date='".$today_date."' order by id asc limit 1");
	$_panel_health_org_list_access = mysqli_fetch_assoc($_panel_health_org_list_sql);
	$org_id = $_panel_health_org_list_access['org_id'];
	$_id = $_panel_health_org_list_access['id'];
			
	$url = 'http://103.141.218.138:4511/panel/esslist?org_id='.$org_id.'&group_id=0&items_per_page=20&page=1&state=All&active_sort=null&term=&sort_direction=null';

	$response = getDevice($url,$access_token);
	$check = json_decode($response,true);
	
	$healthy_count = 0;
	$offline_count = 0;
	$faulty_count = 0;
	$online_count = 0;
	$uncalibrated_count = 0;
	$total = 0;
	$totalPages = 0;
	$itemsPerPage = 20;

	if($check['statusCode']==200){
		$gwlist = $check['result']['count'];
		$healthy_count = $gwlist['healthy_count'];
		$offline_count = $gwlist['offline_count'];
		$faulty_count = $gwlist['faulty_count'];
		$online_count = $gwlist['online_count'];
		$uncalibrated_count = $gwlist['uncalibrated_count'];
		$total = $gwlist['total'];
		
		$totalItems = $total;
		

		$totalPages = ceil($totalItems / $itemsPerPage);
		
	}

	$_update_sql = "update panel_health_orgid_list set healthy_count='".$healthy_count."',offline_count='".$offline_count."',faulty_count='".$faulty_count."',online_count='".$online_count."',uncalibrated_count='".$uncalibrated_count."',total_sites='".$total."',items_per_page='".$itemsPerPage."',page_no='".$totalPages."',is_completed=1 where id='".$_id."'";
	mysqli_query($con,$_update_sql);
    $_site_update = $_site_update + 1;
	
	//echo $_id.'_'.$org_id.'_'.$_org_id_val;die;
}
	
   /*	
    $sql = "INSERT INTO panel_health_api_response (`mac_id`, `atmid`, `group_id`, `panel_name`, `zone_config`, `cams`,
		`device_type`,`fw_ver`,`created_at`,`connection`,`connection_display`) VALUES ('$mac_id','$atmid','$group_id','$panel_name','$zone_config','$cams','$device_type','$fw_ver','$created_at','$connection','$connection_display')"; 
	$result = mysqli_query($con, $sql); 
	*/	  
  //  echo $count_data;
  
    echo $_site_update;
?>





