<?php date_default_timezone_set('Asia/Kolkata');
include('db_connection.php'); 
$con = OpenCon();
$ems_login_sql = mysqli_query($con,"select email,password,access_token,org_id,refresh_token from eazyinfra_login_access where id=1");
$ems_login_access = mysqli_fetch_assoc($ems_login_sql);
$access_token = $ems_login_access['access_token'];
$org_id = $ems_login_access['org_id'];
$refresh_token = $ems_login_access['refresh_token'];

$email=$ems_login_access['email'];
$password=$ems_login_access['password'];

//echo userlogin($email,$password,$con);

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

function userlogin($email,$password,$con){
	$curl = curl_init();
	//$post_data = array('email' => $email,'password' => $password);
	$post_data = array();
	$post_data['email'] = $email;
	$post_data['password'] = $password;
	$final_array = array();
	array_push($final_array,$post_data);
	$foo = new StdClass();
	$foo->email = $email;
	$foo->password = $password;

	$json = json_encode($foo);
	//echo $json;
	
	curl_setopt_array($curl, array(
	  CURLOPT_URL => 'https://eazyinfra.utopiatech.in:4510/user/login',
	  CURLOPT_RETURNTRANSFER => true,
	  CURLOPT_HEADER => true,
	  CURLOPT_ENCODING => '',
	  CURLOPT_MAXREDIRS => 10,
	  CURLOPT_TIMEOUT => 0,
	  CURLOPT_FOLLOWLOCATION => true,
	  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
	  CURLOPT_POST => 1,
	  CURLOPT_SSL_VERIFYPEER => false,
	  CURLOPT_POSTFIELDS => $json,
	  /*CURLOPT_POSTFIELDS =>'{
		"email": "api@pnbcts.com",
		"password": "pnb@123"
		}', */
	  CURLOPT_HTTPHEADER => array(
	   // 'access_token: eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJpZCI6IjYyNjNjZTVkNzQ2ZGVmMmExYzdjOGI3MiIsImVtYWlsIjoiYXBpQHBuYmN0cy5jb20iLCJvcmdfaWQiOjEwMDQsImdyb3VwX2lkcyI6WyIwIiwiMSIsIjIiLCI0IiwiMyIsIjEwIiwiNyIsIjExIiwiOCIsIjEyIiwiMTMiLCIxNCIsIjE1IiwiMTYiLCIxNyIsIjUiLCI5IiwiNiIsIjE5IiwiMjAiLCIyMiIsIjIxIiwiMTgiLCIyMyIsIjI0IiwiMjUiLCIyNiIsIjI3IiwiMjgiXSwicmVhZCI6NzE2MCwid3JpdGUiOjgzMiwicm9sZV9pZCI6MTIsImFsbG93ZWRfb3JnX2lkcyI6W10sImlhdCI6MTY1Nzk2OTIxNCwiZXhwIjoxNjU3OTcyODE0fQ.oYOQtqM6TE5_4Rge0O0iwl2vU5f8m89sxdG3wi9V6sE',
		'Content-Type: application/json'
	  ),
	));

	$response = curl_exec($curl);
	
	// how big are the headers
	$headerSize = curl_getinfo( $curl , CURLINFO_HEADER_SIZE );
	$headerStr = substr( $response , 0 , $headerSize );
	$bodyStr = substr( $response , $headerSize );

	// convert headers to array
	$headers = headersToArray( $headerStr );
	
	if(count($headers)>0){
		if($headers['access_token']!=''){
			$access_token = $headers['access_token'];
			$refresh_token = $headers['refresh_token'];
			$currentdatetime = date("Y-m-d H:i:s");
			$id = 1;
			$sql= " UPDATE `eazyinfra_login_access` SET `access_token`='".$access_token."',`refresh_token`='".$refresh_token."',`updated_at`='".$currentdatetime."' where `id`='".$id."' ";
            $result = mysqli_query($con,$sql);
			
		}
	}

    $response = json_decode($bodyStr,true);
	curl_close($curl);
	if($response['statusCode']==200){
		return 1;
	}else{
		return 0;
	}
	
}


function getZone($org_id,$panel_id,$access_token,$con){
	$curl = curl_init();
	$panel_id_arr = array();
	
	array_push($panel_id_arr,$panel_id);
	//$panel_id_array = array();
	//array_push($panel_id_array ,$panel_id_arr);
	$foo = new StdClass();
	$foo->org_id = (int)$org_id;
	$foo->panel_id = $panel_id_arr;

	$json = json_encode($foo);
   // echo '<pre>';print_r($json);echo '</pre>';die;
	curl_setopt_array($curl, array(
	  CURLOPT_URL => 'https://eazyinfra.utopiatech.in:4510/panel/zonedata',
	  CURLOPT_RETURNTRANSFER => true,
	  CURLOPT_ENCODING => '',
	  CURLOPT_MAXREDIRS => 10,
	  CURLOPT_TIMEOUT => 0,
	  CURLOPT_FOLLOWLOCATION => true,
	  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
	  CURLOPT_CUSTOMREQUEST => 'POST',
	  CURLOPT_SSL_VERIFYPEER => false,
	  CURLOPT_POSTFIELDS => $json,
	/*  CURLOPT_POSTFIELDS =>'{
		"org_id" : 1004,
		"panel_id" : ["091364"]
	  }', */
	  CURLOPT_HTTPHEADER => array(
		'access_token: '.$access_token,
		'Content-Type: application/json'
	  ),
	));

	$response = curl_exec($curl);

	curl_close($curl);
	return $response;
}


function getHooterSirenStatus($org_id,$panel_id,$group_id,$access_token,$con){
	$curl = curl_init();
	$panel_id_arr = array();
	array_push($panel_id_arr,$panel_id);
	//$panel_id_array = array();
	//array_push($panel_id_array ,$panel_id_arr);
	$foo = new StdClass();
	$foo->org_id = (int)$org_id;
	$foo->group_id = $group_id;
	$foo->panel_id = $panel_id_arr;
	$foo->config_type = "ess_panel";

	$json = json_encode($foo);
   // echo '<pre>';print_r($json);echo '</pre>';
	curl_setopt_array($curl, array(
	  CURLOPT_URL => 'https://eazyinfra.utopiatech.in:4510/panel/configs/get_new',
	  CURLOPT_RETURNTRANSFER => true,
	  CURLOPT_ENCODING => '',
	  CURLOPT_MAXREDIRS => 10,
	  CURLOPT_TIMEOUT => 0,
	  CURLOPT_FOLLOWLOCATION => true,
	  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
	  CURLOPT_CUSTOMREQUEST => 'POST',
	  CURLOPT_SSL_VERIFYPEER => false,
	  CURLOPT_POSTFIELDS => $json,
	  /*CURLOPT_POSTFIELDS =>'{
		"org_id": 1004, 
		"group_id": "29", 
		"panel_id": ["565656"], 
		"config_type": "ess_panel"
		}', */
	  CURLOPT_HTTPHEADER => array(
		'access_token: '.$access_token,
		'Content-Type: application/json'
	  ),
	));

	$response = curl_exec($curl);

	curl_close($curl);
	return $response;
}

function setHooterSiren($org_id,$mac_id,$onoff_type,$set_type,$access_token,$con){
	$curl = curl_init();
	//$panel_id_arr = array();
	//array_push($panel_id_arr,$panel_id);
	//$panel_id_array = array();
	//array_push($panel_id_array ,$panel_id_arr);
	$foo = new StdClass();
	$foo->mac_id = $mac_id;
	$foo->org_id = (int)$org_id;
	$foo->cmd = (int)$set_type;
	$foo->data = (int)$onoff_type;

	$json = json_encode($foo);
    echo '<pre>';print_r($json);echo '</pre>';
	curl_setopt_array($curl, array(
	  CURLOPT_URL => 'https://eazyinfra.utopiatech.in:4510/diagnostics/cmd_new',
	  CURLOPT_RETURNTRANSFER => true,
	  CURLOPT_ENCODING => '',
	  CURLOPT_MAXREDIRS => 10,
	  CURLOPT_TIMEOUT => 0,
	  CURLOPT_FOLLOWLOCATION => true,
	  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
	  CURLOPT_CUSTOMREQUEST => 'POST',
	  CURLOPT_SSL_VERIFYPEER => false,
	  CURLOPT_POSTFIELDS => $json,
	  /*CURLOPT_POSTFIELDS =>'{
		"org_id": 1004, 
		"group_id": "29", 
		"panel_id": ["565656"], 
		"config_type": "ess_panel"
		}', */
	  CURLOPT_HTTPHEADER => array(
		'access_token: '.$access_token,
		'Content-Type: application/json'
	  ),
	));

	$response = curl_exec($curl);

	curl_close($curl);
	return $response;
}



