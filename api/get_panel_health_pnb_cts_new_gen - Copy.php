<?php include('db_connection.php'); 
 date_default_timezone_set('Asia/Kolkata');
 $created_at = date('Y-m-d H:i:s');
 
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
		
		echo $response;die;
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

$con = OpenCon();
//$mac_id = $_POST['mac_id'];
$ems_login_sql = mysqli_query($con,"select access_token,org_id,refresh_token from ems_login_access_panel_health where id=2");
$ems_login_access = mysqli_fetch_assoc($ems_login_sql);
$access_token = $ems_login_access['access_token'];
$org_id = $ems_login_access['org_id'];
$refresh_token = $ems_login_access['refresh_token'];

$url = 'http://103.141.218.138:4511/panel/esslist?org_id='.$org_id.'&group_id=0&items_per_page=500&page=1&state=All&active_sort=null&term=&sort_direction=null';

// http://103.141.218.138:4511/panel/esslist?org_id=1004&items_per_page=20&page=1&group_id=0&state=All&active_sort=null&term=&sort_direction=null

echo $url;
$response = getDevice($url,$access_token);
$check = json_decode($response,true);
echo '<pre>';print_r($check);echo '</pre>';die;
$mac_array = array();
$_isatm = 0;
if($check['statusCode']==401){
		$new_access_token  = getAccessToken($refresh_token);
        $access_token = $new_access_token;		
		//echo $access_token;die;
		if($new_access_token!=''){
			mysqli_query($con,"update ems_login_access_panel_health set access_token='".$new_access_token."' where id=2");
			$response = getDevice($url,$new_access_token);
			$check = json_decode($response,true);
			echo '<pre>';print_r($check);echo '</pre>';die;
			$_newdata = [];
			if($check['statusCode']==200){
				$gwlist = $check['result']['gwlist'];
				$finalarray = array();
				
				foreach($gwlist as $key=>$list){
					//echo '<pre>';print_r($list);echo '</pre>'; die;
					$arr = array();
					$mac_id = $list['mac_id'];
					$arr['mac_id'] = $list['mac_id'];
					if (array_key_exists('atmid', $list)) {
					   $arr['atmid'] = $list['atmid'];
					}else{
						$_panel_name = $list['panel_name'];
						if (strpos($_panel_name, '_') !== false) {
							// Split the string at underscore
							$parts = explode('_', $_panel_name);
							$arr['atmid'] = $parts[0];
						}else{
							$arr['atmid'] = $_panel_name;
						}
						array_push($mac_array,$mac_id);
						$_isatm = $_isatm + 1;
					}
					$arr['panel_name'] = $list['panel_name'];
					$arr['group_id'] = $list['group_id'];
					$arr['zone_config'] = json_encode($list['zone_config']);
					$arr['cams'] = json_encode($list['cams']);
					$arr['device_type'] = $list['device_type'];
					$arr['fw_ver'] = $list['fw_ver'];
					$arr['connection'] = $list['connection'];
					$arr['connection_display'] = $list['connection_display'];
					array_push($_newdata,$arr);
					//if($mac_id==$_mac_id){
					//$atm_macid = $_atmid."_".$mac_id;
					//	$_newdata = $list;
					//}
				}
			}
		}else{
			echo '201';
		}
		//$check = json_decode($response,true);

}else{
	
	$_newdata = [];
	if($check['statusCode']==200){
		$gwlist = $check['result']['gwlist'];
		$finalarray = array();
		echo count($gwlist);die;
		foreach($gwlist as $key=>$list){
			$arr = array();
			//echo '<pre>';print_r($list);echo '</pre>'; die;
			$mac_id = $list['mac_id'];
			$arr['mac_id'] = $list['mac_id'];
			if (array_key_exists('atmid', $list)) {
			   $arr['atmid'] = $list['atmid'];
			}else{
				$_panel_name = $list['panel_name'];
				if (strpos($_panel_name, '_') !== false) {
					// Split the string at underscore
					$parts = explode('_', $_panel_name);
					$arr['atmid'] = $parts[0];
				}else{
					$arr['atmid'] = $_panel_name;
				}
				array_push($mac_array,$mac_id);
				$_isatm = $_isatm + 1;
			}
			$arr['panel_name'] = $list['panel_name'];
			$arr['group_id'] = $list['group_id'];
			$arr['zone_config'] = json_encode($list['zone_config']);
			$arr['cams'] = json_encode($list['cams']);
			$arr['device_type'] = $list['device_type'];
			$arr['fw_ver'] = $list['fw_ver'];
			$arr['connection'] = $list['connection'];
			$arr['connection_display'] = $list['connection_display'];
			array_push($_newdata,$arr);
			//if($mac_id==$_mac_id){
			//$atm_macid = $_atmid."_".$mac_id;
			//	$_newdata = $list;
			//}
		}
	}
	//echo '<pre>';print_r($arr);echo '</pre>'; die;
	//echo $response;
}
	//echo $_isatm;
	//echo '<pre>';print_r($mac_array);echo '</pre>';
	//echo '<pre>';print_r($response);echo '</pre>';
	//echo '<pre>';print_r($_newdata);echo '</pre>'; die;
//	echo $result;


$org_id = 8;

$url = 'http://103.141.218.138:4511/panel/esslist?org_id='.$org_id.'&group_id=0';

$response = getDevice($url,$access_token);
$check = json_decode($response,true);
//echo '<pre>';print_r($check);echo '</pre>';die;
//$mac_array = array();
$_isatm = 0;
if($check['statusCode']==401){
		$new_access_token  = getAccessToken($refresh_token);
        $access_token = $new_access_token;		
		if($new_access_token!=''){
			mysqli_query($con,"update ems_login_access_panel_health set access_token='".$new_access_token."' where id=1");
			$response = getDevice($url,$new_access_token);
			$check = json_decode($response,true);
			//echo '<pre>';print_r($check);echo '</pre>';die;
			//$_newdata = [];
			if($check['statusCode']==200){
				$gwlist = $check['result']['gwlist'];
				$finalarray = array();
				
				foreach($gwlist as $key=>$list){
					//echo '<pre>';print_r($list);echo '</pre>'; die;
					$arr = array();
					$mac_id = $list['mac_id'];
					$arr['mac_id'] = $list['mac_id'];
					if (array_key_exists('atmid', $list)) {
					   $arr['atmid'] = $list['atmid'];
					}else{
						$_panel_name = $list['panel_name'];
						if (strpos($_panel_name, '_') !== false) {
							// Split the string at underscore
							$parts = explode('_', $_panel_name);
							$arr['atmid'] = $parts[0];
						}else{
							$arr['atmid'] = $_panel_name;
						}
						array_push($mac_array,$mac_id);
						$_isatm = $_isatm + 1;
					}
					$arr['panel_name'] = $list['panel_name'];
					$arr['group_id'] = $list['group_id'];
					$arr['zone_config'] = json_encode($list['zone_config']);
					$arr['cams'] = json_encode($list['cams']);
					$arr['device_type'] = $list['device_type'];
					$arr['fw_ver'] = $list['fw_ver'];
					$arr['connection'] = $list['connection'];
					$arr['connection_display'] = $list['connection_display'];
					array_push($_newdata,$arr);
					//if($mac_id==$_mac_id){
					//$atm_macid = $_atmid."_".$mac_id;
					//	$_newdata = $list;
					//}
				}
			}
		}else{
			echo '201';
		}
		//$check = json_decode($response,true);

}else{
	
	//$_newdata = [];
	if($check['statusCode']==200){
		$gwlist = $check['result']['gwlist'];
		$finalarray = array();
		
		foreach($gwlist as $key=>$list){
			$arr = array();
			//echo '<pre>';print_r($list);echo '</pre>'; die;
			$mac_id = $list['mac_id'];
			$arr['mac_id'] = $list['mac_id'];
			if (array_key_exists('atmid', $list)) {
			   $arr['atmid'] = $list['atmid'];
			}else{
				$_panel_name = $list['panel_name'];
				if (strpos($_panel_name, '_') !== false) {
					// Split the string at underscore
					$parts = explode('_', $_panel_name);
					$arr['atmid'] = $parts[0];
				}else{
					$arr['atmid'] = $_panel_name;
				}
				array_push($mac_array,$mac_id);
				$_isatm = $_isatm + 1;
			}
			$arr['panel_name'] = $list['panel_name'];
			$arr['group_id'] = $list['group_id'];
			$arr['zone_config'] = json_encode($list['zone_config']);
			$arr['cams'] = json_encode($list['cams']);
			$arr['device_type'] = $list['device_type'];
			$arr['fw_ver'] = $list['fw_ver'];
			$arr['connection'] = $list['connection'];
			$arr['connection_display'] = $list['connection_display'];
			array_push($_newdata,$arr);
			//if($mac_id==$_mac_id){
			//$atm_macid = $_atmid."_".$mac_id;
			//	$_newdata = $list;
			//}
		}
	}
	//echo '<pre>';print_r($arr);echo '</pre>'; die;
	//echo $response;
}

$org_id = 18;

$url = 'http://103.141.218.138:4511/panel/esslist?org_id='.$org_id.'&group_id=0';

$response = getDevice($url,$access_token);
$check = json_decode($response,true);
//echo '<pre>';print_r($check);echo '</pre>';die;
//$mac_array = array();
$_isatm = 0;
if($check['statusCode']==401){
		$new_access_token  = getAccessToken($refresh_token);	
		$access_token = $new_access_token;
		if($new_access_token!=''){
			mysqli_query($con,"update ems_login_access_panel_health set access_token='".$new_access_token."' where id=1");
			$response = getDevice($url,$new_access_token);
			$check = json_decode($response,true);
			//echo '<pre>';print_r($check);echo '</pre>';die;
			//$_newdata = [];
			if($check['statusCode']==200){
				$gwlist = $check['result']['gwlist'];
				$finalarray = array();
				
				foreach($gwlist as $key=>$list){
					//echo '<pre>';print_r($list);echo '</pre>'; die;
					$arr = array();
					$mac_id = $list['mac_id'];
					$arr['mac_id'] = $list['mac_id'];
					if (array_key_exists('atmid', $list)) {
					   $arr['atmid'] = $list['atmid'];
					}else{
						$_panel_name = $list['panel_name'];
						if (strpos($_panel_name, '_') !== false) {
							// Split the string at underscore
							$parts = explode('_', $_panel_name);
							$arr['atmid'] = $parts[0];
						}else{
							$arr['atmid'] = $_panel_name;
						}
						array_push($mac_array,$mac_id);
						$_isatm = $_isatm + 1;
					}
					$arr['panel_name'] = $list['panel_name'];
					$arr['group_id'] = $list['group_id'];
					$arr['zone_config'] = json_encode($list['zone_config']);
					$arr['cams'] = json_encode($list['cams']);
					$arr['device_type'] = $list['device_type'];
					$arr['fw_ver'] = $list['fw_ver'];
					$arr['connection'] = $list['connection'];
					$arr['connection_display'] = $list['connection_display'];
					array_push($_newdata,$arr);
					//if($mac_id==$_mac_id){
					//$atm_macid = $_atmid."_".$mac_id;
					//	$_newdata = $list;
					//}
				}
			}
		}else{
			echo '201';
		}
		//$check = json_decode($response,true);

}else{
	
	//$_newdata = [];
	if($check['statusCode']==200){
		$gwlist = $check['result']['gwlist'];
		$finalarray = array();
		
		foreach($gwlist as $key=>$list){
			$arr = array();
			//echo '<pre>';print_r($list);echo '</pre>'; die;
			$mac_id = $list['mac_id'];
			$arr['mac_id'] = $list['mac_id'];
			if (array_key_exists('atmid', $list)) {
			   $arr['atmid'] = $list['atmid'];
			}else{
				$_panel_name = $list['panel_name'];
				if (strpos($_panel_name, '_') !== false) {
					// Split the string at underscore
					$parts = explode('_', $_panel_name);
					$arr['atmid'] = $parts[0];
				}else{
					$arr['atmid'] = $_panel_name;
				}
				array_push($mac_array,$mac_id);
				$_isatm = $_isatm + 1;
			}
			$arr['panel_name'] = $list['panel_name'];
			$arr['group_id'] = $list['group_id'];
			$arr['zone_config'] = json_encode($list['zone_config']);
			$arr['cams'] = json_encode($list['cams']);
			$arr['device_type'] = $list['device_type'];
			$arr['fw_ver'] = $list['fw_ver'];
			$arr['connection'] = $list['connection'];
			$arr['connection_display'] = $list['connection_display'];
			array_push($_newdata,$arr);
			//if($mac_id==$_mac_id){
			//$atm_macid = $_atmid."_".$mac_id;
			//	$_newdata = $list;
			//}
		}
	}
	//echo '<pre>';print_r($arr);echo '</pre>'; die;
	//echo $response;
}

$org_id = 22;

$url = 'http://103.141.218.138:4511/panel/esslist?org_id='.$org_id.'&group_id=0';

$response = getDevice($url,$access_token);
$check = json_decode($response,true);
//echo '<pre>';print_r($check);echo '</pre>';die;
//$mac_array = array();
$_isatm = 0;
if($check['statusCode']==401){
		$new_access_token  = getAccessToken($refresh_token);	
		$access_token = $new_access_token;
		if($new_access_token!=''){
			mysqli_query($con,"update ems_login_access_panel_health set access_token='".$new_access_token."' where id=1");
			$response = getDevice($url,$new_access_token);
			$check = json_decode($response,true);
			//echo '<pre>';print_r($check);echo '</pre>';die;
			//$_newdata = [];
			if($check['statusCode']==200){
				$gwlist = $check['result']['gwlist'];
				$finalarray = array();
				
				foreach($gwlist as $key=>$list){
					//echo '<pre>';print_r($list);echo '</pre>'; die;
					$arr = array();
					$mac_id = $list['mac_id'];
					$arr['mac_id'] = $list['mac_id'];
					if (array_key_exists('atmid', $list)) {
					   $arr['atmid'] = $list['atmid'];
					}else{
						$_panel_name = $list['panel_name'];
						if (strpos($_panel_name, '_') !== false) {
							// Split the string at underscore
							$parts = explode('_', $_panel_name);
							$arr['atmid'] = $parts[0];
						}else{
							$arr['atmid'] = $_panel_name;
						}
						array_push($mac_array,$mac_id);
						$_isatm = $_isatm + 1;
					}
					$arr['panel_name'] = $list['panel_name'];
					$arr['group_id'] = $list['group_id'];
					$arr['zone_config'] = json_encode($list['zone_config']);
					$arr['cams'] = json_encode($list['cams']);
					$arr['device_type'] = $list['device_type'];
					$arr['fw_ver'] = $list['fw_ver'];
					$arr['connection'] = $list['connection'];
					$arr['connection_display'] = $list['connection_display'];
					array_push($_newdata,$arr);
					//if($mac_id==$_mac_id){
					//$atm_macid = $_atmid."_".$mac_id;
					//	$_newdata = $list;
					//}
				}
			}
		}else{
			echo '201';
		}
		//$check = json_decode($response,true);

}else{
	
	//$_newdata = [];
	if($check['statusCode']==200){
		$gwlist = $check['result']['gwlist'];
		$finalarray = array();
		
		foreach($gwlist as $key=>$list){
			$arr = array();
			//echo '<pre>';print_r($list);echo '</pre>'; die;
			$mac_id = $list['mac_id'];
			$arr['mac_id'] = $list['mac_id'];
			if (array_key_exists('atmid', $list)) {
			   $arr['atmid'] = $list['atmid'];
			}else{
				$_panel_name = $list['panel_name'];
				if (strpos($_panel_name, '_') !== false) {
					// Split the string at underscore
					$parts = explode('_', $_panel_name);
					$arr['atmid'] = $parts[0];
				}else{
					$arr['atmid'] = $_panel_name;
				}
				array_push($mac_array,$mac_id);
				$_isatm = $_isatm + 1;
			}
			$arr['panel_name'] = $list['panel_name'];
			$arr['group_id'] = $list['group_id'];
			$arr['zone_config'] = json_encode($list['zone_config']);
			$arr['cams'] = json_encode($list['cams']);
			$arr['device_type'] = $list['device_type'];
			$arr['fw_ver'] = $list['fw_ver'];
			$arr['connection'] = $list['connection'];
			$arr['connection_display'] = $list['connection_display'];
			array_push($_newdata,$arr);
			//if($mac_id==$_mac_id){
			//$atm_macid = $_atmid."_".$mac_id;
			//	$_newdata = $list;
			//}
		}
	}
	//echo '<pre>';print_r($arr);echo '</pre>'; die;
	//echo $response;
}

$org_id = 2;

$url = 'http://103.141.218.138:4511/panel/esslist?org_id='.$org_id.'&group_id=0';

$response = getDevice($url,$access_token);
$check = json_decode($response,true);
//echo '<pre>';print_r($check);echo '</pre>';die;
//$mac_array = array();
$_isatm = 0;
if($check['statusCode']==401){
		$new_access_token  = getAccessToken($refresh_token);	
		$access_token = $new_access_token;
		if($new_access_token!=''){
			mysqli_query($con,"update ems_login_access_panel_health set access_token='".$new_access_token."' where id=1");
			$response = getDevice($url,$new_access_token);
			$check = json_decode($response,true);
			//echo '<pre>';print_r($check);echo '</pre>';die;
			//$_newdata = [];
			if($check['statusCode']==200){
				$gwlist = $check['result']['gwlist'];
				$finalarray = array();
				
				foreach($gwlist as $key=>$list){
					//echo '<pre>';print_r($list);echo '</pre>'; die;
					$arr = array();
					$mac_id = $list['mac_id'];
					$arr['mac_id'] = $list['mac_id'];
					if (array_key_exists('atmid', $list)) {
					   $arr['atmid'] = $list['atmid'];
					}else{
						$_panel_name = $list['panel_name'];
						if (strpos($_panel_name, '_') !== false) {
							// Split the string at underscore
							$parts = explode('_', $_panel_name);
							$arr['atmid'] = $parts[0];
						}else{
							$arr['atmid'] = $_panel_name;
						}
						array_push($mac_array,$mac_id);
						$_isatm = $_isatm + 1;
					}
					$arr['panel_name'] = $list['panel_name'];
					$arr['group_id'] = $list['group_id'];
					$arr['zone_config'] = json_encode($list['zone_config']);
					$arr['cams'] = json_encode($list['cams']);
					$arr['device_type'] = $list['device_type'];
					$arr['fw_ver'] = $list['fw_ver'];
					$arr['connection'] = $list['connection'];
					$arr['connection_display'] = $list['connection_display'];
					array_push($_newdata,$arr);
					//if($mac_id==$_mac_id){
					//$atm_macid = $_atmid."_".$mac_id;
					//	$_newdata = $list;
					//}
				}
			}
		}else{
			echo '201';
		}
		//$check = json_decode($response,true);

}else{
	
	//$_newdata = [];
	if($check['statusCode']==200){
		$gwlist = $check['result']['gwlist'];
		$finalarray = array();
		
		foreach($gwlist as $key=>$list){
			$arr = array();
			//echo '<pre>';print_r($list);echo '</pre>'; die;
			$mac_id = $list['mac_id'];
			$arr['mac_id'] = $list['mac_id'];
			if (array_key_exists('atmid', $list)) {
			   $arr['atmid'] = $list['atmid'];
			}else{
				$_panel_name = $list['panel_name'];
				if (strpos($_panel_name, '_') !== false) {
					// Split the string at underscore
					$parts = explode('_', $_panel_name);
					$arr['atmid'] = $parts[0];
				}else{
					$arr['atmid'] = $_panel_name;
				}
				array_push($mac_array,$mac_id);
				$_isatm = $_isatm + 1;
			}
			$arr['panel_name'] = $list['panel_name'];
			$arr['group_id'] = $list['group_id'];
			$arr['zone_config'] = json_encode($list['zone_config']);
			$arr['cams'] = json_encode($list['cams']);
			$arr['device_type'] = $list['device_type'];
			$arr['fw_ver'] = $list['fw_ver'];
			$arr['connection'] = $list['connection'];
			$arr['connection_display'] = $list['connection_display'];
			array_push($_newdata,$arr);
			//if($mac_id==$_mac_id){
			//$atm_macid = $_atmid."_".$mac_id;
			//	$_newdata = $list;
			//}
		}
	}
	//echo '<pre>';print_r($arr);echo '</pre>'; die;
	//echo $response;
}

$org_id = 4;

$url = 'http://103.141.218.138:4511/panel/esslist?org_id='.$org_id.'&group_id=0';

$response = getDevice($url,$access_token);
$check = json_decode($response,true);
//echo '<pre>';print_r($check);echo '</pre>';die;
//$mac_array = array();
$_isatm = 0;
if($check['statusCode']==401){
		$new_access_token  = getAccessToken($refresh_token);	
		$access_token = $new_access_token;
		if($new_access_token!=''){
			mysqli_query($con,"update ems_login_access_panel_health set access_token='".$new_access_token."' where id=1");
			$response = getDevice($url,$new_access_token);
			$check = json_decode($response,true);
			//echo '<pre>';print_r($check);echo '</pre>';die;
			//$_newdata = [];
			if($check['statusCode']==200){
				$gwlist = $check['result']['gwlist'];
				$finalarray = array();
				
				foreach($gwlist as $key=>$list){
					//echo '<pre>';print_r($list);echo '</pre>'; die;
					$arr = array();
					$mac_id = $list['mac_id'];
					$arr['mac_id'] = $list['mac_id'];
					if (array_key_exists('atmid', $list)) {
					   $arr['atmid'] = $list['atmid'];
					}else{
						$_panel_name = $list['panel_name'];
						if (strpos($_panel_name, '_') !== false) {
							// Split the string at underscore
							$parts = explode('_', $_panel_name);
							$arr['atmid'] = $parts[0];
						}else{
							$arr['atmid'] = $_panel_name;
						}
						
						array_push($mac_array,$mac_id);
						$_isatm = $_isatm + 1;
					}
					$arr['panel_name'] = $list['panel_name'];
					$arr['group_id'] = $list['group_id'];
					$arr['zone_config'] = json_encode($list['zone_config']);
					$arr['cams'] = json_encode($list['cams']);
					$arr['device_type'] = $list['device_type'];
					$arr['fw_ver'] = $list['fw_ver'];
					$arr['connection'] = $list['connection'];
					$arr['connection_display'] = $list['connection_display'];
					array_push($_newdata,$arr);
					//if($mac_id==$_mac_id){
					//$atm_macid = $_atmid."_".$mac_id;
					//	$_newdata = $list;
					//}
				}
			}
		}else{
			echo '201';
		}
		//$check = json_decode($response,true);

}else{
	
	//$_newdata = [];
	if($check['statusCode']==200){
		$gwlist = $check['result']['gwlist'];
		$finalarray = array();
		
		foreach($gwlist as $key=>$list){
			$arr = array();
			//echo '<pre>';print_r($list);echo '</pre>'; die;
			$mac_id = $list['mac_id'];
			$arr['mac_id'] = $list['mac_id'];
			if (array_key_exists('atmid', $list)) {
			   $arr['atmid'] = $list['atmid'];
			}else{
				$_panel_name = $list['panel_name'];
				if (strpos($_panel_name, '_') !== false) {
					// Split the string at underscore
					$parts = explode('_', $_panel_name);
					$arr['atmid'] = $parts[0];
				}else{
					$arr['atmid'] = $_panel_name;
				}
				
				array_push($mac_array,$mac_id);
				$_isatm = $_isatm + 1;
			}
			$arr['panel_name'] = $list['panel_name'];
			$arr['group_id'] = $list['group_id'];
			$arr['zone_config'] = json_encode($list['zone_config']);
			$arr['cams'] = json_encode($list['cams']);
			$arr['device_type'] = $list['device_type'];
			$arr['fw_ver'] = $list['fw_ver'];
			$arr['connection'] = $list['connection'];
			$arr['connection_display'] = $list['connection_display'];
			array_push($_newdata,$arr);
			//if($mac_id==$_mac_id){
			//$atm_macid = $_atmid."_".$mac_id;
			//	$_newdata = $list;
			//}
		}
	}
	//echo '<pre>';print_r($arr);echo '</pre>'; die;
	//echo $response;
}

$org_id = 7;

$url = 'http://103.141.218.138:4511/panel/esslist?org_id='.$org_id.'&group_id=0';

$response = getDevice($url,$access_token);
$check = json_decode($response,true);
//echo '<pre>';print_r($check);echo '</pre>';die;
//$mac_array = array();
$_isatm = 0;
if($check['statusCode']==401){
		$new_access_token  = getAccessToken($refresh_token);	
		$access_token = $new_access_token;
		if($new_access_token!=''){
			mysqli_query($con,"update ems_login_access_panel_health set access_token='".$new_access_token."' where id=1");
			$response = getDevice($url,$new_access_token);
			$check = json_decode($response,true);
			//echo '<pre>';print_r($check);echo '</pre>';die;
			//$_newdata = [];
			if($check['statusCode']==200){
				$gwlist = $check['result']['gwlist'];
				$finalarray = array();
				
				foreach($gwlist as $key=>$list){
					//echo '<pre>';print_r($list);echo '</pre>'; die;
					$arr = array();
					$mac_id = $list['mac_id'];
					$arr['mac_id'] = $list['mac_id'];
					if (array_key_exists('atmid', $list)) {
					   $arr['atmid'] = $list['atmid'];
					}else{
						$_panel_name = $list['panel_name'];
						if (strpos($_panel_name, '_') !== false) {
							// Split the string at underscore
							$parts = explode('_', $_panel_name);
							$arr['atmid'] = $parts[0];
						}else{
							$arr['atmid'] = $_panel_name;
						}
						array_push($mac_array,$mac_id);
						$_isatm = $_isatm + 1;
					}
					$arr['panel_name'] = $list['panel_name'];
					$arr['group_id'] = $list['group_id'];
					$arr['zone_config'] = json_encode($list['zone_config']);
					$arr['cams'] = json_encode($list['cams']);
					$arr['device_type'] = $list['device_type'];
					$arr['fw_ver'] = $list['fw_ver'];
					$arr['connection'] = $list['connection'];
					$arr['connection_display'] = $list['connection_display'];
					array_push($_newdata,$arr);
					//if($mac_id==$_mac_id){
					//$atm_macid = $_atmid."_".$mac_id;
					//	$_newdata = $list;
					//}
				}
			}
		}else{
			echo '201';
		}
		//$check = json_decode($response,true);

}else{
	
	//$_newdata = [];
	if($check['statusCode']==200){
		$gwlist = $check['result']['gwlist'];
		$finalarray = array();
		
		foreach($gwlist as $key=>$list){
			$arr = array();
			//echo '<pre>';print_r($list);echo '</pre>'; die;
			$mac_id = $list['mac_id'];
			$arr['mac_id'] = $list['mac_id'];
			if (array_key_exists('atmid', $list)) {
			   $arr['atmid'] = $list['atmid'];
			}else{
				$_panel_name = $list['panel_name'];
				if (strpos($_panel_name, '_') !== false) {
					// Split the string at underscore
					$parts = explode('_', $_panel_name);
					$arr['atmid'] = $parts[0];
				}else{
					$arr['atmid'] = $_panel_name;
				}
				array_push($mac_array,$mac_id);
				$_isatm = $_isatm + 1;
			}
			$arr['panel_name'] = $list['panel_name'];
			$arr['group_id'] = $list['group_id'];
			$arr['zone_config'] = json_encode($list['zone_config']);
			$arr['cams'] = json_encode($list['cams']);
			$arr['device_type'] = $list['device_type'];
			$arr['fw_ver'] = $list['fw_ver'];
			$arr['connection'] = $list['connection'];
			$arr['connection_display'] = $list['connection_display'];
			array_push($_newdata,$arr);
			//if($mac_id==$_mac_id){
			//$atm_macid = $_atmid."_".$mac_id;
			//	$_newdata = $list;
			//}
		}
	}
	//echo '<pre>';print_r($arr);echo '</pre>'; die;
	//echo $response;
}

$org_id = 1003;

$url = 'http://103.141.218.138:4511/panel/esslist?org_id='.$org_id.'&group_id=0';

$response = getDevice($url,$access_token);
$check = json_decode($response,true);
//echo '<pre>';print_r($check);echo '</pre>';die;
//$mac_array = array();
$_isatm = 0;
if($check['statusCode']==401){
		$new_access_token  = getAccessToken($refresh_token);	
		$access_token = $new_access_token;
		if($new_access_token!=''){
			mysqli_query($con,"update ems_login_access_panel_health set access_token='".$new_access_token."' where id=1");
			$response = getDevice($url,$new_access_token);
			$check = json_decode($response,true);
			//echo '<pre>';print_r($check);echo '</pre>';die;
			//$_newdata = [];
			if($check['statusCode']==200){
				$gwlist = $check['result']['gwlist'];
				$finalarray = array();
				
				foreach($gwlist as $key=>$list){
					//echo '<pre>';print_r($list);echo '</pre>'; die;
					$arr = array();
					$mac_id = $list['mac_id'];
					$arr['mac_id'] = $list['mac_id'];
					if (array_key_exists('atmid', $list)) {
					   $arr['atmid'] = $list['atmid'];
					}else{
						$_panel_name = $list['panel_name'];
						if (strpos($_panel_name, '_') !== false) {
							// Split the string at underscore
							$parts = explode('_', $_panel_name);
							$arr['atmid'] = $parts[0];
						}else{
							$arr['atmid'] = $_panel_name;
						}
						array_push($mac_array,$mac_id);
						$_isatm = $_isatm + 1;
					}
					$arr['panel_name'] = $list['panel_name'];
					$arr['group_id'] = $list['group_id'];
					$arr['zone_config'] = json_encode($list['zone_config']);
					$arr['cams'] = json_encode($list['cams']);
					$arr['device_type'] = $list['device_type'];
					$arr['fw_ver'] = $list['fw_ver'];
					$arr['connection'] = $list['connection'];
					$arr['connection_display'] = $list['connection_display'];
					array_push($_newdata,$arr);
					//if($mac_id==$_mac_id){
					//$atm_macid = $_atmid."_".$mac_id;
					//	$_newdata = $list;
					//}
				}
			}
		}else{
			echo '201';
		}
		//$check = json_decode($response,true);

}else{
	
	//$_newdata = [];
	if($check['statusCode']==200){
		$gwlist = $check['result']['gwlist'];
		$finalarray = array();
		
		foreach($gwlist as $key=>$list){
			$arr = array();
			//echo '<pre>';print_r($list);echo '</pre>'; die;
			$mac_id = $list['mac_id'];
			$arr['mac_id'] = $list['mac_id'];
			if (array_key_exists('atmid', $list)) {
			   $arr['atmid'] = $list['atmid'];
			}else{
				$_panel_name = $list['panel_name'];
				if (strpos($_panel_name, '_') !== false) {
					// Split the string at underscore
					$parts = explode('_', $_panel_name);
					$arr['atmid'] = $parts[0];
				}else{
					$arr['atmid'] = $_panel_name;
				}
				array_push($mac_array,$mac_id);
				$_isatm = $_isatm + 1;
			}
			$arr['panel_name'] = $list['panel_name'];
			$arr['group_id'] = $list['group_id'];
			$arr['zone_config'] = json_encode($list['zone_config']);
			$arr['cams'] = json_encode($list['cams']);
			$arr['device_type'] = $list['device_type'];
			$arr['fw_ver'] = $list['fw_ver'];
			$arr['connection'] = $list['connection'];
			$arr['connection_display'] = $list['connection_display'];
			array_push($_newdata,$arr);
			//if($mac_id==$_mac_id){
			//$atm_macid = $_atmid."_".$mac_id;
			//	$_newdata = $list;
			//}
		}
	}
	//echo '<pre>';print_r($arr);echo '</pre>'; die;
	//echo $response;
}



$org_id = 24;

$url = 'http://103.141.218.138:4511/panel/esslist?org_id='.$org_id.'&group_id=0';

$response = getDevice($url,$access_token);
$check = json_decode($response,true);
//echo '<pre>';print_r($check);echo '</pre>';die;
//$mac_array = array();
$_isatm = 0;
if($check['statusCode']==401){
		$new_access_token  = getAccessToken($refresh_token);	
		$access_token = $new_access_token;
		if($new_access_token!=''){
			mysqli_query($con,"update ems_login_access_panel_health set access_token='".$new_access_token."' where id=1");
			$response = getDevice($url,$new_access_token);
			$check = json_decode($response,true);
			//echo '<pre>';print_r($check);echo '</pre>';die;
			//$_newdata = [];
			if($check['statusCode']==200){
				$gwlist = $check['result']['gwlist'];
				$finalarray = array();
				
				foreach($gwlist as $key=>$list){
					//echo '<pre>';print_r($list);echo '</pre>'; die;
					$arr = array();
					$mac_id = $list['mac_id'];
					$arr['mac_id'] = $list['mac_id'];
					if (array_key_exists('atmid', $list)) {
					   $arr['atmid'] = $list['atmid'];
					}else{
						$_panel_name = $list['panel_name'];
						if (strpos($_panel_name, '_') !== false) {
							// Split the string at underscore
							$parts = explode('_', $_panel_name);
							$arr['atmid'] = $parts[0];
						}else{
							$arr['atmid'] = $_panel_name;
						}
						array_push($mac_array,$mac_id);
						$_isatm = $_isatm + 1;
					}
					$arr['panel_name'] = $list['panel_name'];
					$arr['group_id'] = $list['group_id'];
					$arr['zone_config'] = json_encode($list['zone_config']);
					$arr['cams'] = json_encode($list['cams']);
					$arr['device_type'] = $list['device_type'];
					$arr['fw_ver'] = $list['fw_ver'];
					$arr['connection'] = $list['connection'];
					$arr['connection_display'] = $list['connection_display'];
					array_push($_newdata,$arr);
					//if($mac_id==$_mac_id){
					//$atm_macid = $_atmid."_".$mac_id;
					//	$_newdata = $list;
					//}
				}
			}
		}else{
			echo '201';
		}
		//$check = json_decode($response,true);

}else{
	
	//$_newdata = [];
	if($check['statusCode']==200){
		$gwlist = $check['result']['gwlist'];
		$finalarray = array();
		
		foreach($gwlist as $key=>$list){
			$arr = array();
			//echo '<pre>';print_r($list);echo '</pre>'; die;
			$mac_id = $list['mac_id'];
			$arr['mac_id'] = $list['mac_id'];
			if (array_key_exists('atmid', $list)) {
			   $arr['atmid'] = $list['atmid'];
			}else{
				$_panel_name = $list['panel_name'];
				if (strpos($_panel_name, '_') !== false) {
					// Split the string at underscore
					$parts = explode('_', $_panel_name);
					$arr['atmid'] = $parts[0];
				}else{
					$arr['atmid'] = $_panel_name;
				}
				array_push($mac_array,$mac_id);
				$_isatm = $_isatm + 1;
			}
			$arr['panel_name'] = $list['panel_name'];
			$arr['group_id'] = $list['group_id'];
			$arr['zone_config'] = json_encode($list['zone_config']);
			$arr['cams'] = json_encode($list['cams']);
			$arr['device_type'] = $list['device_type'];
			$arr['fw_ver'] = $list['fw_ver'];
			$arr['connection'] = $list['connection'];
			$arr['connection_display'] = $list['connection_display'];
			array_push($_newdata,$arr);
			//if($mac_id==$_mac_id){
			//$atm_macid = $_atmid."_".$mac_id;
			//	$_newdata = $list;
			//}
		}
	}
	//echo '<pre>';print_r($arr);echo '</pre>'; die;
	//echo $response;
}

$org_id = 5;

$url = 'http://103.141.218.138:4511/panel/esslist?org_id='.$org_id.'&group_id=0';

$response = getDevice($url,$access_token);
$check = json_decode($response,true);
//echo '<pre>';print_r($check);echo '</pre>';die;
//$mac_array = array();
$_isatm = 0;
if($check['statusCode']==401){
		$new_access_token  = getAccessToken($refresh_token);	
		$access_token = $new_access_token;
		if($new_access_token!=''){
			mysqli_query($con,"update ems_login_access_panel_health set access_token='".$new_access_token."' where id=1");
			$response = getDevice($url,$new_access_token);
			$check = json_decode($response,true);
			//echo '<pre>';print_r($check);echo '</pre>';die;
			//$_newdata = [];
			if($check['statusCode']==200){
				$gwlist = $check['result']['gwlist'];
				$finalarray = array();
				
				foreach($gwlist as $key=>$list){
					//echo '<pre>';print_r($list);echo '</pre>'; die;
					$arr = array();
					$mac_id = $list['mac_id'];
					$arr['mac_id'] = $list['mac_id'];
					if (array_key_exists('atmid', $list)) {
					   $arr['atmid'] = $list['atmid'];
					}else{
						$_panel_name = $list['panel_name'];
						if (strpos($_panel_name, '_') !== false) {
							// Split the string at underscore
							$parts = explode('_', $_panel_name);
							$arr['atmid'] = $parts[0];
						}else{
							$arr['atmid'] = $_panel_name;
						}
						array_push($mac_array,$mac_id);
						$_isatm = $_isatm + 1;
					}
					$arr['panel_name'] = $list['panel_name'];
					$arr['group_id'] = $list['group_id'];
					$arr['zone_config'] = json_encode($list['zone_config']);
					$arr['cams'] = json_encode($list['cams']);
					$arr['device_type'] = $list['device_type'];
					$arr['fw_ver'] = $list['fw_ver'];
					$arr['connection'] = $list['connection'];
					$arr['connection_display'] = $list['connection_display'];
					array_push($_newdata,$arr);
					//if($mac_id==$_mac_id){
					//$atm_macid = $_atmid."_".$mac_id;
					//	$_newdata = $list;
					//}
				}
			}
		}else{
			echo '201';
		}
		//$check = json_decode($response,true);

}else{
	
	//$_newdata = [];
	if($check['statusCode']==200){
		$gwlist = $check['result']['gwlist'];
		$finalarray = array();
		
		foreach($gwlist as $key=>$list){
			$arr = array();
			//echo '<pre>';print_r($list);echo '</pre>'; die;
			$mac_id = $list['mac_id'];
			$arr['mac_id'] = $list['mac_id'];
			if (array_key_exists('atmid', $list)) {
			   $arr['atmid'] = $list['atmid'];
			}else{
				$_panel_name = $list['panel_name'];
				if (strpos($_panel_name, '_') !== false) {
					// Split the string at underscore
					$parts = explode('_', $_panel_name);
					$arr['atmid'] = $parts[0];
				}else{
					$arr['atmid'] = $_panel_name;
				}
				array_push($mac_array,$mac_id);
				$_isatm = $_isatm + 1;
			}
			$arr['panel_name'] = $list['panel_name'];
			$arr['group_id'] = $list['group_id'];
			$arr['zone_config'] = json_encode($list['zone_config']);
			$arr['cams'] = json_encode($list['cams']);
			$arr['device_type'] = $list['device_type'];
			$arr['fw_ver'] = $list['fw_ver'];
			$arr['connection'] = $list['connection'];
			$arr['connection_display'] = $list['connection_display'];
			array_push($_newdata,$arr);
			//if($mac_id==$_mac_id){
			//$atm_macid = $_atmid."_".$mac_id;
			//	$_newdata = $list;
			//}
		}
	}
	//echo '<pre>';print_r($arr);echo '</pre>'; die;
	//echo $response;
}

$org_id = 6;

$url = 'http://103.141.218.138:4511/panel/esslist?org_id='.$org_id.'&group_id=0';

$response = getDevice($url,$access_token);
$check = json_decode($response,true);
//echo '<pre>';print_r($check);echo '</pre>';die;
//$mac_array = array();
$_isatm = 0;
if($check['statusCode']==401){
		$new_access_token  = getAccessToken($refresh_token);	
		$access_token = $new_access_token;
		if($new_access_token!=''){
			mysqli_query($con,"update ems_login_access_panel_health set access_token='".$new_access_token."' where id=1");
			$response = getDevice($url,$new_access_token);
			$check = json_decode($response,true);
			//echo '<pre>';print_r($check);echo '</pre>';die;
			//$_newdata = [];
			if($check['statusCode']==200){
				$gwlist = $check['result']['gwlist'];
				$finalarray = array();
				
				foreach($gwlist as $key=>$list){
					//echo '<pre>';print_r($list);echo '</pre>'; die;
					$arr = array();
					$mac_id = $list['mac_id'];
					$arr['mac_id'] = $list['mac_id'];
					if (array_key_exists('atmid', $list)) {
					   $arr['atmid'] = $list['atmid'];
					}else{
						$_panel_name = $list['panel_name'];
						if (strpos($_panel_name, '_') !== false) {
							// Split the string at underscore
							$parts = explode('_', $_panel_name);
							$arr['atmid'] = $parts[0];
						}else{
							$arr['atmid'] = $_panel_name;
						}
						array_push($mac_array,$mac_id);
						$_isatm = $_isatm + 1;
					}
					$arr['panel_name'] = $list['panel_name'];
					$arr['group_id'] = $list['group_id'];
					$arr['zone_config'] = json_encode($list['zone_config']);
					$arr['cams'] = json_encode($list['cams']);
					$arr['device_type'] = $list['device_type'];
					$arr['fw_ver'] = $list['fw_ver'];
					$arr['connection'] = $list['connection'];
					$arr['connection_display'] = $list['connection_display'];
					array_push($_newdata,$arr);
					//if($mac_id==$_mac_id){
					//$atm_macid = $_atmid."_".$mac_id;
					//	$_newdata = $list;
					//}
				}
			}
		}else{
			echo '201';
		}
		//$check = json_decode($response,true);

}else{
	
	//$_newdata = [];
	if($check['statusCode']==200){
		$gwlist = $check['result']['gwlist'];
		$finalarray = array();
		
		foreach($gwlist as $key=>$list){
			$arr = array();
			//echo '<pre>';print_r($list);echo '</pre>'; die;
			$mac_id = $list['mac_id'];
			$arr['mac_id'] = $list['mac_id'];
			if (array_key_exists('atmid', $list)) {
			   $arr['atmid'] = $list['atmid'];
			}else{
				$_panel_name = $list['panel_name'];
				if (strpos($_panel_name, '_') !== false) {
					// Split the string at underscore
					$parts = explode('_', $_panel_name);
					$arr['atmid'] = $parts[0];
				}else{
					$arr['atmid'] = $_panel_name;
				}
				array_push($mac_array,$mac_id);
				$_isatm = $_isatm + 1;
			}
			$arr['panel_name'] = $list['panel_name'];
			$arr['group_id'] = $list['group_id'];
			$arr['zone_config'] = json_encode($list['zone_config']);
			$arr['cams'] = json_encode($list['cams']);
			$arr['device_type'] = $list['device_type'];
			$arr['fw_ver'] = $list['fw_ver'];
			$arr['connection'] = $list['connection'];
			$arr['connection_display'] = $list['connection_display'];
			array_push($_newdata,$arr);
			//if($mac_id==$_mac_id){
			//$atm_macid = $_atmid."_".$mac_id;
			//	$_newdata = $list;
			//}
		}
	}
	//echo '<pre>';print_r($arr);echo '</pre>'; die;
	//echo $response;
}

$org_id = 1;

$url = 'http://103.141.218.138:4511/panel/esslist?org_id='.$org_id.'&group_id=0';

$response = getDevice($url,$access_token);
$check = json_decode($response,true);
//echo '<pre>';print_r($check);echo '</pre>';die;
//$mac_array = array();
$_isatm = 0;
if($check['statusCode']==401){
		$new_access_token  = getAccessToken($refresh_token);	
		$access_token = $new_access_token;
		if($new_access_token!=''){
			mysqli_query($con,"update ems_login_access_panel_health set access_token='".$new_access_token."' where id=1");
			$response = getDevice($url,$new_access_token);
			$check = json_decode($response,true);
			//echo '<pre>';print_r($check);echo '</pre>';die;
			//$_newdata = [];
			if($check['statusCode']==200){
				$gwlist = $check['result']['gwlist'];
				$finalarray = array();
				
				foreach($gwlist as $key=>$list){
					//echo '<pre>';print_r($list);echo '</pre>'; die;
					$arr = array();
					$mac_id = $list['mac_id'];
					$arr['mac_id'] = $list['mac_id'];
					if (array_key_exists('atmid', $list)) {
					   $arr['atmid'] = $list['atmid'];
					}else{
						$_panel_name = $list['panel_name'];
						if (strpos($_panel_name, '_') !== false) {
							// Split the string at underscore
							$parts = explode('_', $_panel_name);
							$arr['atmid'] = $parts[0];
						}else{
							$arr['atmid'] = $_panel_name;
						}
						array_push($mac_array,$mac_id);
						$_isatm = $_isatm + 1;
					}
					$arr['panel_name'] = $list['panel_name'];
					$arr['group_id'] = $list['group_id'];
					$arr['zone_config'] = json_encode($list['zone_config']);
					$arr['cams'] = json_encode($list['cams']);
					$arr['device_type'] = $list['device_type'];
					$arr['fw_ver'] = $list['fw_ver'];
					$arr['connection'] = $list['connection'];
					$arr['connection_display'] = $list['connection_display'];
					array_push($_newdata,$arr);
					//if($mac_id==$_mac_id){
					//$atm_macid = $_atmid."_".$mac_id;
					//	$_newdata = $list;
					//}
				}
			}
		}else{
			echo '201';
		}
		//$check = json_decode($response,true);

}else{
	
	//$_newdata = [];
	if($check['statusCode']==200){
		$gwlist = $check['result']['gwlist'];
		$finalarray = array();
		
		foreach($gwlist as $key=>$list){
			$arr = array();
			//echo '<pre>';print_r($list);echo '</pre>'; die;
			$mac_id = $list['mac_id'];
			$arr['mac_id'] = $list['mac_id'];
			if (array_key_exists('atmid', $list)) {
			   $arr['atmid'] = $list['atmid'];
			}else{
				$_panel_name = $list['panel_name'];
				if (strpos($_panel_name, '_') !== false) {
					// Split the string at underscore
					$parts = explode('_', $_panel_name);
					$arr['atmid'] = $parts[0];
				}else{
					$arr['atmid'] = $_panel_name;
				}
				array_push($mac_array,$mac_id);
				$_isatm = $_isatm + 1;
			}
			$arr['panel_name'] = $list['panel_name'];
			$arr['group_id'] = $list['group_id'];
			$arr['zone_config'] = json_encode($list['zone_config']);
			$arr['cams'] = json_encode($list['cams']);
			$arr['device_type'] = $list['device_type'];
			$arr['fw_ver'] = $list['fw_ver'];
			$arr['connection'] = $list['connection'];
			$arr['connection_display'] = $list['connection_display'];
			array_push($_newdata,$arr);
			//if($mac_id==$_mac_id){
			//$atm_macid = $_atmid."_".$mac_id;
			//	$_newdata = $list;
			//}
		}
	}
	//echo '<pre>';print_r($arr);echo '</pre>'; die;
	//echo $response;
}

  // echo '<pre>';print_r($_newdata);echo '</pre>'; die;
    
    $parts = array();    $count_data = 0;
	
	if(count($_newdata)>0){
		
		foreach($_newdata as $row=>$vsr) {
		  // echo '<pre>';print_r($vsr);echo '</pre>';
		   $mac_id=$vsr['mac_id'];
		   $atmid=$vsr['atmid'];
		   $group_id=$vsr['group_id'];
		   $panel_name=$vsr['panel_name'];
		   $zone_config=$vsr['zone_config'];
		   $cams=$vsr['cams'];
		   $device_type=$vsr['device_type'];
		   $fw_ver=$vsr['fw_ver'];
		   $connection=$vsr['connection'];
		   $connection_display=$vsr['connection_display'];
		   
		   $_delsql = "DELETE FROM panel_health_api_response WHERE mac_id='".$mac_id."'";
	       mysqli_query($con, $_delsql);
		  
		   $sql = "INSERT INTO panel_health_api_response (`mac_id`, `atmid`, `group_id`, `panel_name`, `zone_config`, `cams`,
		`device_type`,`fw_ver`,`created_at`,`connection`,`connection_display`) VALUES ('$mac_id','$atmid','$group_id','$panel_name','$zone_config','$cams','$device_type','$fw_ver','$created_at','$connection','$connection_display')"; 
		  
		  // $parts[] = "('$mac_id','$atmid','$group_id','$panel_name','$zone_config','$cams','$device_type','$fw_ver','$created_at')"; 
		  
		  $result = mysqli_query($con, $sql); 
		/*  
		  $_delsql = "DELETE FROM panel_health_api_response_history WHERE mac_id='".$mac_id."'";
	      mysqli_query($con, $_delsql);
		  
		  $sql_history = "INSERT INTO panel_health_api_response_history (`mac_id`, `atmid`, `group_id`, `panel_name`, `zone_config`, `cams`,
		`device_type`,`fw_ver`,`created_at`) VALUES ('$mac_id','$atmid','$group_id','$panel_name','$zone_config','$cams','$device_type','$fw_ver','$created_at')"; 
		  
		  $result_history = mysqli_query($con, $sql_history); 
		 */ 
		  
		  $count_data = $count_data + 1;
		}
	}
	
	
	$ems_panel_data_sql = mysqli_query($con,"select * from panel_health_api_response");
	if(mysqli_num_rows($ems_panel_data_sql)>0){
		
		$sql_history = "INSERT INTO panel_health_api_response_history select * FROM panel_health_api_response"; 
		  
		$result_history = mysqli_query($con, $sql_history); 
		
	}
	
    /*
	$sql = "INSERT INTO panel_health_api_response (`mac_id`, `atmid`, `group_id`, `panel_name`, `zone_config`, `cams`,
	`device_type`,`fw_ver`,`created_at`) VALUES " . implode(', ', $parts); 
	*/
    //echo $sql;
	//$result = mysqli_query($con, $sql); 
    echo $count_data;
?>





