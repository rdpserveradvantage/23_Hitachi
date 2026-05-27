<?php date_default_timezone_set('Asia/Kolkata');
include('db_connection.php'); 
$con = OpenCon();
$ems_login_sql = mysqli_query($con,"select access_token,org_id,refresh_token from ems_login_access where id=1");
$ems_login_access = mysqli_fetch_assoc($ems_login_sql);
$access_token = $ems_login_access['access_token'];
$org_id = $ems_login_access['org_id'];
$refresh_token = $ems_login_access['refresh_token'];
function upload_dvr_image($file,$date,$time,$filename,$con,$access_token){
	$upname = $filename."_".$date."_".$time.".jpg";
    $cfile = new CURLFile($file, mime_content_type($file), $upname);
	$curl = curl_init();

	curl_setopt_array($curl, array(
	  CURLOPT_URL => 'https://eazyinfra.utopiatech.in/dvrimage',
	  CURLOPT_RETURNTRANSFER => true,
	  CURLOPT_SAFE_UPLOAD => false,
	  CURLOPT_ENCODING => '',
	  CURLOPT_MAXREDIRS => 10,
	  CURLOPT_TIMEOUT => 0,
	  CURLOPT_FOLLOWLOCATION => true,
	  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
	  CURLOPT_SSL_VERIFYPEER => false,
	  CURLOPT_POST => true,
	  CURLOPT_POSTFIELDS => array('atmid' => $filename,'folder_date' => $date,'folder_time' => $time,'file'=> $cfile ),
	  CURLOPT_HTTPHEADER => array(
		//'access_token: '.$access_token,
		'access_token: eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJpZCI6IjYxYzU4YmI1MWUxYzdmM2VjZTEzODRlZCIsImVtYWlsIjoiZHZyQGN0cy5jb20iLCJvcmdfaWQiOjAsImdyb3VwX2lkcyI6WyIwIl0sInJlYWQiOjAsIndyaXRlIjowLCJyb2xlX2lkIjoxMDAwLCJpYXQiOjE2NDAzMzY1NjgsImV4cCI6MTk1NTY5NjU2OH0.sipAiL8MMb8Ir8mhvYwI8nUx9TLkdv8z_NCwURogDGM',
		'Content-Type: multipart/form-data'
	  ),
	));

	
	if (curl_errno($curl)) {
		$response = curl_error($curl);
		//echo $error_msg;
	}else{
		$response = curl_exec($curl);
	}
	curl_close($curl);
	$currentdatetime = date("Y-m-d H:i:s");
	
    $sql = " INSERT INTO `dvr_image_upload_event`( `atmid`, `folder_date`, `folder_time`, `url_link`, `upload_status`, `uploaded_response`, `created_at`, `updated_at`) VALUES ('".$filename."','".$date."','".$time."','".$file."','1','".$response."','".$currentdatetime."','".$currentdatetime."') ";
    //$sql= " UPDATE `footage_request` SET `footage_avail`='".$footage_avail."',`footage_filename`='".$footage_filename."',`footage_date`='".$footage_date."',`footage_start_time`='".$footage_start_time."',`footage_end_time`='".$footage_end_time."',`date_of_presrv`='".$date_of_presrv."',`downlink`='".$downlink."', `status`='".$status."', `footage_receive_at`='".$footage_receive_at."' where `id`='".$id."' ";

    $result = mysqli_query($con,$sql);
	echo $response;
	return $result;
}
        

		$dt = date("Y-m-d");
		$t = "09";
		$myDirectory=opendir("D:\\Images");
						  
		while(false !== ($entryName=readdir($myDirectory))) {
		  $dirArray[]=$entryName; 
		}
			// echo '<pre>';print_r($dirArray);echo '</pre>'; die;
		natcasesort($dirArray);
		$i=0;
		foreach ($dirArray as $file) {
			if($file!="." && $file!=".."){
				$i++;
				$filepath = "D:\\Images\\$file\\$dt\\$t\\$file.jpg";
				//echo $path."</br>";
				//echo file_exists($path)."</br>";
				if(file_exists($filepath)){
					$select_sql = "SELECT id from dvr_image_upload_event where atmid='".$file."' AND folder_date='".$dt."' AND folder_time='".$t."'";
					$check_data = mysqli_query($con,$select_sql);
					if(mysqli_num_rows($check_data)==0){
						upload_dvr_image($filepath,$dt,$t,$file,$con,$access_token);
					}else{
					     echo "Already Uploaded";
					}
				}else{
					echo 'File Not Exist';
				}
			}
		}
	CloseCon($con);												
/*
include('db_connection.php'); 
$con = OpenCon();
$sitesql = mysqli_query($con,"select * from dvr_health where ip='".$ip."'");
if(mysqli_num_rows($sitesql)>0){
			$sitesql_result = mysqli_fetch_assoc($sitesql);
$id = $sitesql_result['id'];
$ip = $sitesql_result['ip'];
$status = $sitesql_result['status'];
$cam1 = $sitesql_result['cam1'];
$cam3 = $sitesql_result['cam3'];
$cam2 = $sitesql_result['cam2'];
$cam4 = $sitesql_result['cam4'];
if(is_null($cam4)){
	$cam4 = "not working";
}

$hdd = $sitesql_result['hdd'];
$latency = $sitesql_result['latency'];
$cdate = "";
if(is_null($sitesql_result['cdate'])){
    $cdate = "";
}else{
	$cdate = strtotime($sitesql_result['cdate']);
}
$login_status = $sitesql_result['login_status'];
$last_communication = "";
if(is_null($sitesql_result['last_communication'])){
    $last_communication = "";
}else{
	$last_communication = strtotime($sitesql_result['last_communication']);
}
$atmid = $sitesql_result['atmid'];
$capacity = $sitesql_result['capacity'];
$freespace = $sitesql_result['freespace'];
if(is_null($sitesql_result['recording_from'])){
	$recording_from = $currentdatetime;
}else{
$recording_from = $sitesql_result['recording_from'];
$recording_from = date("Y-m-d H:i:s",strtotime($recording_from));
}
*/


//$cfile = makeCurlFile('13/A1207910.jpg');
//$cfile = curl_file_create($filename);
//$cfile = '@' . realpath($filename);

//$filename = '/api/13/A1207910.jpg';
//$cfile = getCurlValue($filename,'image/jpeg',' A1207910.jpg');

//$file = __DIR__ . DIRECTORY_SEPARATOR . "13/A1207910.jpg";
//echo $file;die;
/*
$file = 'D:\python_codes\Server_socket\House_Keeping\ B1005900\2022-03-16\09/ B1005900.jpg';

$upname = "B1005900.jpg";
$cfile = new CURLFile($file, mime_content_type($file), $upname);

$atmid = "A1207910";
$folder_date = "2022-03-16";
$folder_time = "13";
$file = "";
$post_data = [
"atmid"=> $atmid,
"folder_date"=> $folder_date,
"folder_time"=> $folder_time,
"file"=> ''
];
$post_data = json_encode($post_data);

$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => 'https://eazyinfra.utopiatech.in/dvrimage',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_SAFE_UPLOAD => false,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_SSL_VERIFYPEER => false,
  CURLOPT_POST => true,
  CURLOPT_POSTFIELDS => array('atmid' => 'B1005900','folder_date' => '2022-03-16','folder_time' => '09','file'=> $cfile ),
  CURLOPT_HTTPHEADER => array(
    'access_token: eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJpZCI6IjYxYzU4YmI1MWUxYzdmM2VjZTEzODRlZCIsImVtYWlsIjoiZHZyQGN0cy5jb20iLCJvcmdfaWQiOjAsImdyb3VwX2lkcyI6WyIwIl0sInJlYWQiOjAsIndyaXRlIjowLCJyb2xlX2lkIjoxMDAwLCJpYXQiOjE2NDAzMzY1NjgsImV4cCI6MTk1NTY5NjU2OH0.sipAiL8MMb8Ir8mhvYwI8nUx9TLkdv8z_NCwURogDGM',
    'Content-Type: multipart/form-data'
  ),
));

$response = curl_exec($curl);
if (curl_errno($curl)) {
    $error_msg = curl_error($curl);
	echo $error_msg;
}
curl_close($curl);
echo $response;die;
*/
/*
$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => 'https://eazyinfra.utopiatech.in/dvrimage',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'POST',
  CURLOPT_POSTFIELDS => array('atmid' => ' A12007900','folder_date' => '2022-03-16','folder_time' => '13','file'=> new CURLFILE('D:/python_codes/Server_socket/House_Keeping/ A1207910/2022-03-16/13/ A1207910.jpg')),
));

$response = curl_exec($curl);

curl_close($curl);
echo $response;*/