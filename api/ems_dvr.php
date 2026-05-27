<?php 

$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => 'https://eazyinfra.utopiatech.in/dvrevent',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'POST',
  CURLOPT_POSTFIELDS =>'{
"id": 2559,
"ip": "172.55.29.197",
"status": "1",
"cam1": "working",
"cam3": "working",
"cam2": "working",
"cam4": "working",
"hdd": "OK",
"latency": "94ms",
"cdate": 1643372439,
"login_status": 0,
"last_communication": 1643372439,
"atmid": "D3153700",
"capacity": "0",
"freespace": "",
"recording_from": "",
"recording_to": "",
"dvrtype": "Dahuva",
"live": "Y",
"SN": 3351
}',
  CURLOPT_HTTPHEADER => array(
    'access_token: eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJpZCI6IjYxYzU4YmI1MWUxYzdmM2VjZTEzODRlZCIsImVtYWlsIjoiZHZyQGN0cy5jb20iLCJvcmdfaWQiOjAsImdyb3VwX2lkcyI6WyIwIl0sInJlYWQiOjAsIndyaXRlIjowLCJyb2xlX2lkIjoxMDAwLCJpYXQiOjE2NDAzMzY1NjgsImV4cCI6MTk1NTY5NjU2OH0.sipAiL8MMb8Ir8mhvYwI8nUx9TLkdv8z_NCwURogDGM',
    'Content-Type: application/json'
  ),
));

$response = curl_exec($curl);

curl_close($curl);
echo json_encode($response);
