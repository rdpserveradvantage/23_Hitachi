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
	
	function get_AccessToken($refresh_token){
		$curl = curl_init();

		curl_setopt_array($curl, array(
		  CURLOPT_URL => 'https://eazyinfra.utopiatech.in:4510/user/accesstoken',
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
		$new_access_token = '';
		if(isset($headers['access_token']))
		$new_access_token = $headers['access_token'];
		curl_close($curl);
		if($new_access_token!=''){
		    return $new_access_token;
		}else{
			return '';
		}
	}
	
	function getAccessToken($refresh_token,$con){
		$curl = curl_init();
		
		curl_setopt_array($curl, array(
		  CURLOPT_URL => 'https://eazyinfra.utopiatech.in:4510/user/login',
		  CURLOPT_RETURNTRANSFER => true,
		  CURLOPT_ENCODING => '',
		  CURLOPT_MAXREDIRS => 10,
		  CURLOPT_TIMEOUT => 0,
		  CURLOPT_FOLLOWLOCATION => true,
		  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		  CURLOPT_CUSTOMREQUEST => 'POST',
		  CURLOPT_SSL_VERIFYPEER => false,
		  CURLOPT_HEADER => true,
		  CURLOPT_POSTFIELDS =>'{
			"email": "api@pnbcts.com",
			"password": "pnb@123"
		}',
		  CURLOPT_HTTPHEADER => array(
			'Content-Type: application/json'
		  ),
		));

		$response = curl_exec($curl);
        if(curl_error($curl)) {  
			print_r( curl_error($curl));  
		} 
		
		//echo '<pre>';print_r($response);echo '</pre>';
		$headerSize = curl_getinfo( $curl , CURLINFO_HEADER_SIZE );
		$headerStr = substr( $response , 0 , $headerSize );
		$bodyStr = substr( $response , $headerSize );

		// convert headers to array
		$headers = headersToArray( $headerStr );
		
		$new_access_token = '';$new_refresh_token='';
		if(isset($headers['access_token']))
		$new_access_token = $headers['access_token'];
	    if(isset($headers['access_token']))
		$new_refresh_token = $headers['refresh_token'];
	    //echo $new_access_token;die;
		curl_close($curl);
		if($new_access_token!=''){
			mysqli_query($con,"update ems_login_access set access_token='".$new_access_token."',refresh_token='".$new_refresh_token."' where id=1");
		    return $new_access_token;
		}else{
			return '';
		}
	}
?>
<?php 
//$client = $_POST['client'];
$client='Hitachi';
//$userid = $_POST['user_id'];
$userid=24;
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

   $bank = "PNB";
   if(isset($_POST['bank'])){
	   $bank = $_POST['bank'];
   }
   $atmid = "";
   $atmidarray = [];
   $circle = '';
   if(isset($_POST['circle'])){
	  $circle = $_POST['circle'];
	}
if($bank!=''){
    
	if($circle!=''){
				$circlesql = mysqli_query($con,"select ATMID from site_circle where Circle='".$circle."'");
				$circleatmidarray = [];
				while($circlesql_result = mysqli_fetch_assoc($circlesql)){
					$circleatmidarray[] = $circlesql_result['ATMID'];
					
				}
				$circleatmidarray=json_encode($circleatmidarray);
				$circleatmidarray=str_replace( array('[',']','"') , ''  , $circleatmidarray);
				$circlearr=explode(',',$circleatmidarray);
				$circleatmidarray = "'" . implode ( "', '", $circlearr )."'";
				$sitesql = mysqli_query($con,"select ATMID from sites where Customer='".$client."' and Bank='".$bank."' and ATMID IN (".$circleatmidarray.") and live='Y'");
	}else{ 
		$sitesql = mysqli_query($con,"select ATMID from sites where Customer='".$client."' and Bank='".$bank."' and live='Y'");
	} 
 while($sitesql_result = mysqli_fetch_assoc($sitesql)){
		$atmidarray[] = $sitesql_result['ATMID'];
		
	}
}



$ems_login_sql = mysqli_query($con,"select access_token,org_id,refresh_token from ems_login_access where id=1");
$ems_login_access = mysqli_fetch_assoc($ems_login_sql);
$access_token = $ems_login_access['access_token'];
$org_id = $ems_login_access['org_id'];
$refresh_token = $ems_login_access['refresh_token'];
 //echo $org_id;
$url = 'https://eazyinfra.utopiatech.in:4510/panel/filterlist?org_id='.$org_id.'&group_id=0&state=All';
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
$finalarray = array();
//echo $check['statusCode'];die;
if($check['statusCode']==401){
		$new_access_token  = getAccessToken($refresh_token,$con);	
		if($new_access_token!=''){
			//mysqli_query($con,"update ems_login_access set access_token='".$new_access_token."' where id=1");
			$response = getDevice($url,$new_access_token);
			$check = json_decode($response,true);
			$gwlist = $check['result']['gwlist'];
			//echo $gwlist;
			
			//echo json_encode($gwlist);die;
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
			//echo '201';
		}
		//$check = json_decode($response,true);

}else{ //echo json_encode($check);
	$gwlist = $check['result']['gwlist'];
	//echo $gwlist;
	//$finalarray = array();
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
	$array = array(['Code'=>201,'check'=> $check]);
}
	echo json_encode($array);
//	echo $result;

?>





