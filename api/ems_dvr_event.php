<?php $ip = '172.55.41.42';
date_default_timezone_set('Asia/Kolkata');
$currentdatetime = date("Y-m-d H:i:s");
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

if(is_null($sitesql_result['recording_to'])){
	$recording_to = $currentdatetime;
}else{
$recording_to = $sitesql_result['recording_to'];
$recording_to = date("Y-m-d H:i:s",strtotime($recording_to));
}

$dvrtype = $sitesql_result['dvrtype'];
$live = $sitesql_result['live'];
$SN = $sitesql_result['SN'];
$post_data = [
"id" =>  $id,
"ip" =>  $ip,
"status" =>  $status,
"cam1" =>  $cam1,
"cam3" => $cam3,
"cam2" => $cam2,
"cam4"=> $cam4,
"hdd"=> $hdd,
"latency"=> $latency,
"cdate"=> $cdate,
"login_status"=> $login_status,
"last_communication"=> $last_communication,
"atmid"=> $atmid,
"capacity"=> $capacity,
"freespace"=> $freespace,
"recording_from"=> $recording_from,
"recording_to"=> $recording_to,
"dvrtype"=> $dvrtype,
"live"=> $live,
"SN"=> $SN
];
$post_data = json_encode($post_data);
$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => 'https://eazyinfra.utopiatech.in/dvrevent',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_SSL_VERIFYPEER => false,
  CURLOPT_CUSTOMREQUEST => 'POST',
  CURLOPT_POSTFIELDS => $post_data,
  CURLOPT_HTTPHEADER => array(
    'access_token: eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJpZCI6IjYxYzU4YmI1MWUxYzdmM2VjZTEzODRlZCIsImVtYWlsIjoiZHZyQGN0cy5jb20iLCJvcmdfaWQiOjAsImdyb3VwX2lkcyI6WyIwIl0sInJlYWQiOjAsIndyaXRlIjowLCJyb2xlX2lkIjoxMDAwLCJpYXQiOjE2NDAzMzY1NjgsImV4cCI6MTk1NTY5NjU2OH0.sipAiL8MMb8Ir8mhvYwI8nUx9TLkdv8z_NCwURogDGM',
    'Content-Type: application/json'
  ),
));

$response = curl_exec($curl);

curl_close($curl);
echo $response;die;
}