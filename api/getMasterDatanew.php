<?php include('config.php'); include('db_connection.php'); include('globalfunctionsNew.php'); 
$data = 'find';
if(isset($_GET['bank'])){
$bank = $_GET['bank'];
$data = getAtmids($bank);
}
if(isset($_POST['client']) && $_POST['client']!=''){
$client = $_POST['client'];
$user_id = $_POST['user_id'];
$data = getBanksByClientID($client,$user_id);
}
if(isset($_GET['code'])) {
    $state_code = $_GET['code'];
     $cities= json_decode(getCities($state_code));
    $data = json_encode($cities);
}
if(isset($_GET['allalertatmidwise'])) {
    $atmid = $_GET['allalertatmidwise'];
    $data = getallalerttype($atmid);
}
if(isset($_POST['bankname']) && isset($_POST['clientname'])){
	$client = $_POST['clientname'];
    $bank = $_POST['bankname'];
    $data = getAtmidList($client,$bank);
}

if(isset($_POST['client_list']) && $_POST['client_list']=='list'){
$user_id = $_POST['user_id'];
$data = getClients($user_id);
}

if(isset($_POST['dvronline_client_list']) && $_POST['dvronline_client_list']=='list'){
$user_id = $_POST['user_id'];
$data = getDVROnlineClients($user_id);
}

if(isset($_POST['dvronline_client']) && $_POST['dvronline_client']!=''){
$dvronline_client = $_POST['dvronline_client'];
$user_id = $_POST['user_id'];
$data = getDVROnlineBanksByClientID($dvronline_client,$user_id);
}

if(isset($_POST['dvronlinebankname']) && isset($_POST['dvronlineclientname'])){
	$client = $_POST['dvronlineclientname'];
    $bank = $_POST['dvronlinebankname'];
    $data = getDVROnlineAtmidList($client,$bank);
}
if(isset($_POST['circlebankname']) && isset($_POST['circlename'])){
	$bank = $_POST['circlebankname'];
	 $circle = $_POST['circlename'];
    $data =  getAtmidCircleList($bank,$circle);
}
if(isset($_POST['bankcircle'])){
$bankcircle = $_POST['bankcircle'];
$data =  getCirclesByBank($bankcircle);
}

$json_data=['data'=>$data];
    CloseCon($con);
    echo json_encode($json_data);
