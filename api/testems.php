<?php include('db_connection.php'); 
 date_default_timezone_set('Asia/Kolkata');
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
		  CURLOPT_URL => 'https://eazyinfra.utopiatech.in/user/accesstoken',
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
$con = OpenCon();

$ems_login_sql = mysqli_query($con,"select access_token,org_id,refresh_token from ems_login_access where id=1");
$ems_login_access = mysqli_fetch_assoc($ems_login_sql);
$access_token = $ems_login_access['access_token'];
$org_id = $ems_login_access['org_id'];
$refresh_token = $ems_login_access['refresh_token'];
 //echo $org_id;
$url = 'https://eazyinfra.utopiatech.in/panel/filterlist?org_id='.$org_id.'&group_id=0&state=All';
	/*  $access_token = 'eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJpZCI6IjYxZDVhMWFlMWUxYzdmM2VjZTI2MTAxYSIsImVtYWlsIjoiYXBpdXNlckBjdHMuY29tIiwib3JnX2lkIjoxMDA0LCJncm91cF9pZHMiOlsiMCJdLCJyZWFkIjo4MTg1LCJ3cml0ZSI6ODE4NSwicm9sZV9pZCI6MTEsImlhdCI6MTY0MTU0ODg4MiwiZXhwIjoxNjQxNTUyNDgyfQ.rnuHuktj3hLfEE2N2Y8s1SfN1QvKlFlR6GPcpP67y4k';
	  
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
echo '<pre>';print_r($check);echo '</pre>';die;
if($check['statusCode']==401){
		$new_access_token  = getAccessToken($refresh_token);	
		if($new_access_token!=''){
			mysqli_query($con,"update ems_login_access set access_token='".$new_access_token."' where id=1");
			$response = getDevice($url,$new_access_token);
			$check = json_decode($response,true);
			$gwlist = $check['result']['gwlist'];
			//echo $gwlist;
			$finalarray = array();
			//echo json_encode($gwlist);
			foreach($gwlist as $key=>$list){
				$panel_name = $list['panel_name'];
				$mac_id = $list['mac_id'];
				$explode = explode("_",$panel_name);
				$_atmid = $explode[0];
				if(in_array($_atmid,$atmidarray)){
					//$atm_macid = $_atmid."_".$mac_id;
					$_newdata = [];
					$_newdata['atmid'] = $_atmid;
					$_newdata['mac_id'] =$mac_id;
					$_newdata['more_details'] = $list;
					array_push($finalarray,$_newdata);
				}
			}
		}else{
			echo '201';
		}
		//$check = json_decode($response,true);

}else{ //echo json_encode($check);
	$gwlist = $check['result']['gwlist'];
	//echo $gwlist;
	$finalarray = array();
	if(count($gwlist)){
		foreach($gwlist as $key=>$list){
			$panel_name = $list['panel_name'];
			$mac_id = $list['mac_id'];
			$explode = explode("_",$panel_name);
			$_atmid = $explode[0];
			if(in_array($_atmid,$atmidarray)){
				//$atm_macid = $_atmid."_".$mac_id;
				$_newdata = [];
				$_newdata['atmid'] = $_atmid;
				$_newdata['mac_id'] =$mac_id;
				$_newdata['more_details'] = $list;
				array_push($finalarray,$_newdata);
			}
		}
	}
}
if(count($finalarray)>0){
	$array = array(['Code'=>200,'res_data'=>$finalarray]);
}else{
	$array = array(['Code'=>201]);
}
	echo json_encode($array);
//	echo $result;

?>





