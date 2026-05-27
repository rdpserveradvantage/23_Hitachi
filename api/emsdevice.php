<?php
require_once 'HTTP/Request2.php';
$request = new HTTP_Request2();
$request->setUrl('"https://eazyinfra.utopiatech.in/panelmeterloglist?org_id=1004&mac_id=30000040');
$request->setMethod(HTTP_Request2::METHOD_GET);
$request->setConfig(array(
  'follow_redirects' => TRUE
));
$request->setHeader(array(
  'access_token' => 'eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJpZCI6IjYxZDVhMWFlMWUxYzdmM2VjZTI2MTAxYSIsImVtYWlsIjoiYXBpdXNlckBjdHMuY29tIiwib3JnX2lkIjoxMDA0LCJncm91cF9pZHMiOlsiMCJdLCJyZWFkIjo4MTg1LCJ3cml0ZSI6ODE4NSwicm9sZV9pZCI6MTEsImlhdCI6MTY0MTU0ODg4MiwiZXhwIjoxNjQxNTUyNDgyfQ.rnuHuktj3hLfEE2N2Y8s1SfN1QvKlFlR6GPcpP67y4k'
));
try {
  $response = $request->send();
  if ($response->getStatus() == 200) {
    echo $response->getBody();
  }
  else {
    echo 'Unexpected HTTP status: ' . $response->getStatus() . ' ' .
    $response->getReasonPhrase();
  }
}
catch(HTTP_Request2_Exception $e) {
  echo 'Error: ' . $e->getMessage();
}