<?php 
date_default_timezone_set('Asia/Kolkata');
$currentdatetime = date("Y-m-d H:i:s");
/*
													$dt = date("Y-m-d");
													$dt = '2022-03-16';
													$t= "13";
                                                    $myDirectory=opendir("D:\\python_codes\\Server_socket\\House_Keeping");
															 
																	  
													while(false !== ($entryName=readdir($myDirectory))) {
													  $dirArray[]=$entryName; 
													}
														// echo '<pre>';print_r($dirArray);echo '</pre>'; 
												    natcasesort($dirArray);
													$i=0;
													foreach ($dirArray as $file) {
														if($file!="." && $file!=".."){
															$i++;
															$path = "D:\\python_codes\\Server_socket\\House_Keeping\\ $file\\$dt\\$t\\$file.jpg";
															echo $path."</br>";
															echo file_exists($path)."</br>";
															if(file_exists($path)){
																echo $file.' : Yes';
															}
														}
													}
die;
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
//chmod("D:\\python_codes\\Server_socket\\House_Keeping",0755);
//require 'D:\\python_codes\\Server_socket\\House_Keeping';

function getCurlValue($filename, $contentType, $postname)
{
    // PHP 5.5 introduced a CurlFile object that deprecates the old @filename syntax
    // See: https://wiki.php.net/rfc/curl-file-upload
    if (function_exists('curl_file_create')) {
        return curl_file_create($filename, $contentType, $postname);
    }

    // Use the old style if using an older version of PHP
    $value = "@{$filename};filename=" . $postname;
    if ($contentType) {
        $value .= ';type=' . $contentType;
    }

    return $value;
}

function makeCurlFile($file){
$mime = mime_content_type($file);
$info = pathinfo($file);
$name = $info['basename'];
$output = new CURLFile($file, $mime, $name);
return $output;
}
$file = 'D:\python_codes\Server_socket\House_Keeping\ B1005900\2022-03-16\09/ B1005900.jpg';
//$filename = '/api/13/A1207910.jpg';
//$cfile = getCurlValue($filename,'image/jpeg',' A1207910.jpg');

//$file = __DIR__ . DIRECTORY_SEPARATOR . "13/A1207910.jpg";
//echo $file;die;
$upname = "B1005900.jpg";
$cfile = new CURLFile($file, mime_content_type($file), $upname);

//$cfile = makeCurlFile('13/A1207910.jpg');
//$cfile = curl_file_create($filename);
//$cfile = '@' . realpath($filename);
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