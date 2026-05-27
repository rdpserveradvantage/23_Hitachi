<?php include('config.php'); session_start();
if(isset($_GET['bank'])){
$bank = $_GET['bank'];
echo getAtmids($bank);
}
if(isset($_GET['aiclient'])){
$client = $_GET['aiclient'];
echo getAIBanksByClientID($client);
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
if(isset($_GET['aibankname']) && isset($_GET['aiclientname'])){
	$client = $_GET['aiclientname'];
    $bank = $_GET['aibankname'];
    echo getAIAtmidList($client,$bank);
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
if(isset($_GET['aicirclebankname']) && isset($_GET['aicirclename'])){
	$bank = $_GET['aicirclebankname'];
	 $circle = $_GET['aicirclename'];
    echo getAtmidCircleList($bank,$circle);
}
if(isset($_GET['aibankcircle'])){
$bankcircle = $_GET['aibankcircle'];
echo getCirclesByBank($bankcircle);
}