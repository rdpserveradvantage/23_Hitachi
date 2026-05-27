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
  function headersToArray( $str )
	{
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
		
		//echo $response;
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
/*
$client = $_POST['client'];
$userid = $_POST['user_id'];
$con = OpenCon();
$usersql = mysqli_query($con,"select cust_id,bank_id from loginusers where id='".$userid."'");
	$userdata = mysqli_fetch_assoc($usersql);
	$_bank_ids = $userdata['bank_id'];
    $banks = explode(",",$_bank_ids);
	$_bank_name = [];
	for($i=0;$i<count($banks);$i++){
	$_bank = explode("_",$banks[$i]);
	if($_bank[0]==$client){
	   array_push($_bank_name,$_bank[1]);
	}
	} 
	   
   $_bank_name=json_encode($_bank_name);
	$_bank_name=str_replace( array('[',']','"') , ''  , $_bank_name);
	$bankarr=explode(',',$_bank_name);
	$_bank_name = "'" . implode ( "', '", $bankarr )."'";

   $bank = "";
   $atmid = "";
if(isset($_POST['bank'])){
$bank = $_POST['bank'];
}
if(isset($_POST['atmid'])){
$atmid = $_POST['atmid'];
}

$atmidarray = [];
*/
$con = OpenCon();
//$mac_id = $_POST['mac_id'];
$ems_login_sql = mysqli_query($con,"select access_token,org_id,refresh_token from ems_login_access_panel_health where id=1");
$ems_login_access = mysqli_fetch_assoc($ems_login_sql);
$access_token = $ems_login_access['access_token'];
$org_id = $ems_login_access['org_id'];
$refresh_token = $ems_login_access['refresh_token'];

$url = 'http://103.141.218.138:4510/panel/esslist?org_id='.$org_id.'&group_id=0';
//$url = 'https://eazyinfra.utopiatech.in:4510/panelmeterloglist?org_id='.$org_id.'&mac_id='.$mac_id;
	//  $access_token = 'eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJpZCI6IjYxZDVhMWFlMWUxYzdmM2VjZTI2MTAxYSIsImVtYWlsIjoiYXBpdXNlckBjdHMuY29tIiwib3JnX2lkIjoxMDA0LCJncm91cF9pZHMiOlsiMCJdLCJyZWFkIjo4MTg1LCJ3cml0ZSI6ODE4NSwicm9sZV9pZCI6MTEsImlhdCI6MTY0MTU0ODg4MiwiZXhwIjoxNjQxNTUyNDgyfQ.rnuHuktj3hLfEE2N2Y8s1SfN1QvKlFlR6GPcpP67y4k';
	  
/*
$options = array(
        'http' => array(
            'header'  => "access_token: ".$access_token,
            'method'  => 'GET',
        )
    );
    $result = file_get_contents($url, false, stream_context_create($options)); */
$response = getDevice($url,$access_token);
$check = json_decode($response,true);
$mac_array = array();
$_isatm = 0;
if($check['statusCode']==401){
		$new_access_token  = getAccessToken($refresh_token);	
		if($new_access_token!=''){
			mysqli_query($con,"update ems_login_access_panel_health set access_token='".$new_access_token."' where id=1");
			$response = getDevice($url,$new_access_token);
			$check = json_decode($response,true);
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
						$arr['atmid'] = "";
						array_push($mac_array,$mac_id);
						$_isatm = $_isatm + 1;
					}
					$arr['panel_name'] = $list['panel_name'];
					$arr['group_id'] = $list['group_id'];
					$arr['zone_config'] = json_encode($list['zone_config']);
					$arr['cams'] = json_encode($list['cams']);
					$arr['device_type'] = $list['device_type'];
					$arr['fw_ver'] = $list['fw_ver'];
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
		
		foreach($gwlist as $key=>$list){
			$arr = array();
			//echo '<pre>';print_r($list);echo '</pre>'; die;
			$mac_id = $list['mac_id'];
			$arr['mac_id'] = $list['mac_id'];
			if (array_key_exists('atmid', $list)) {
			   $arr['atmid'] = $list['atmid'];
			}else{
				$arr['atmid'] = "";
				array_push($mac_array,$mac_id);
				$_isatm = $_isatm + 1;
			}
			$arr['panel_name'] = $list['panel_name'];
			$arr['group_id'] = $list['group_id'];
			$arr['zone_config'] = json_encode($list['zone_config']);
			$arr['cams'] = json_encode($list['cams']);
			$arr['device_type'] = $list['device_type'];
			$arr['fw_ver'] = $list['fw_ver'];
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
    
    $parts = array();    
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
      
	   $sql = "INSERT INTO panel_health_api_response (`mac_id`, `atmid`, `group_id`, `panel_name`, `zone_config`, `cams`,
	`device_type`,`fw_ver`,`created_at`) VALUES ('$mac_id','$atmid','$group_id','$panel_name','$zone_config','$cams','$device_type','$fw_ver','$created_at')"; 
	  
	  // $parts[] = "('$mac_id','$atmid','$group_id','$panel_name','$zone_config','$cams','$device_type','$fw_ver','$created_at')"; 
	  
	  $result = mysqli_query($con, $sql); 
	}
    /*
	$sql = "INSERT INTO panel_health_api_response (`mac_id`, `atmid`, `group_id`, `panel_name`, `zone_config`, `cams`,
	`device_type`,`fw_ver`,`created_at`) VALUES " . implode(', ', $parts); 
	*/
    //echo $sql;
	$result = mysqli_query($con, $sql); 
   
?>





