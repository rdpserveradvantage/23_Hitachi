<?php include('config.php'); session_start();
if(isset($_GET['bank'])){
$bank = $_GET['bank'];
echo getAtmids($bank);
}
if(isset($_GET['client'])){
$client = $_GET['client'];
echo getBanksByClientID($client);
}
if(isset($_GET['code'])) {
    $state_code = $_GET['code'];
     $cities= json_decode(getCities($state_code));
    echo json_encode($cities);
}
if(isset($_GET['allalertatmidwise'])) {
    $atmid = $_GET['allalertatmidwise'];
    echo getallalerttype($atmid);
}
if(isset($_GET['bankname']) && isset($_GET['clientname'])){
	$client = $_GET['clientname'];
    $bank = $_GET['bankname'];
    echo getAtmidList($client,$bank);
}

if(isset($_GET['dvrbank'])){
$dvrbank = $_GET['dvrbank'];
echo getDvrOnlineAtmids($dvrbank);
}
if(isset($_GET['dvrclient'])){
$dvrclient = $_GET['dvrclient'];
echo getDvrOnlineBanksByClientID($dvrclient);
}

if(isset($_GET['videobank']) && isset($_GET['videoclient'])){
	$client = $_GET['videoclient'];
    $bank = $_GET['videobank'];
    echo getVideoAtmidList($client,$bank);
}
if(isset($_GET['cust_bank']) && isset($_GET['cust_client'])){
	$client = $_GET['cust_client'];
    $bank = $_GET['cust_bank'];
    echo getBankAtmidList($client,$bank);
}
if(isset($_GET['circlebankname']) && isset($_GET['circlename'])){
	$bank = $_GET['circlebankname'];
	 $circle = $_GET['circlename'];
    echo getAtmidCircleList($bank,$circle);
}
if(isset($_GET['bankcircle'])){
$bankcircle = $_GET['bankcircle'];
echo getCirclesByBank($bankcircle);
}
if(isset($_GET['videocirclebankname']) && isset($_GET['videocirclename'])){
	$bank = $_GET['videocirclebankname'];
	 $circle = $_GET['videocirclename'];
    echo getVideoAtmidCircleList($bank,$circle);
}