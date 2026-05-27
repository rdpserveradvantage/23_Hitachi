<?php 
echo 'running';
$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => 'https://eazyinfra.utopiatech.in:4510/user/login',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_POST => 1,
  CURLOPT_SSL_VERIFYPEER => false,
  CURLOPT_POSTFIELDS =>'{
    "email": "api@pnbcts.com",
    "password": "pnb@123"
}',
  CURLOPT_HTTPHEADER => array(
   // 'access_token: eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJpZCI6IjYyNjNjZTVkNzQ2ZGVmMmExYzdjOGI3MiIsImVtYWlsIjoiYXBpQHBuYmN0cy5jb20iLCJvcmdfaWQiOjEwMDQsImdyb3VwX2lkcyI6WyIwIiwiMSIsIjIiLCI0IiwiMyIsIjEwIiwiNyIsIjExIiwiOCIsIjEyIiwiMTMiLCIxNCIsIjE1IiwiMTYiLCIxNyIsIjUiLCI5IiwiNiIsIjE5IiwiMjAiLCIyMiIsIjIxIiwiMTgiLCIyMyIsIjI0IiwiMjUiLCIyNiIsIjI3IiwiMjgiXSwicmVhZCI6NzE2MCwid3JpdGUiOjgzMiwicm9sZV9pZCI6MTIsImFsbG93ZWRfb3JnX2lkcyI6W10sImlhdCI6MTY1Nzk2OTIxNCwiZXhwIjoxNjU3OTcyODE0fQ.oYOQtqM6TE5_4Rge0O0iwl2vU5f8m89sxdG3wi9V6sE',
    'Content-Type: application/json'
  ),
));

$content = curl_exec($curl);
$response = curl_getinfo($curl);
echo curl_errno($curl);
/*
if (curl_errno($curl)) {
		$response = curl_error($curl);
		echo $response;
	}else{
		$response = curl_exec($curl);
	}
	curl_close($curl); */
var_dump($content);

echo '<pre>';print_r($response);
curl_close($curl);
echo 'stop';