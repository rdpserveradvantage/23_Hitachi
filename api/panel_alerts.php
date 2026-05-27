<?php //include('config.php'); ?>
<?php include('db_connection.php'); 
 date_default_timezone_set('Asia/Kolkata');
 
  function getPanelName($panelid,$con){
//	global $con;
//	$con = OpenCon();
	$sql = mysqli_query($con,"select Panel_Make from sites where NewPanelID='".$panelid."'");
	$sql_result = mysqli_fetch_assoc($sql);
//	CloseCon($con);
	return $sql_result['Panel_Make'];
}
 
function get_sensor_name($zone,$panelid,$con)
{
   // global $con;
	//$con = OpenCon();
	$sql = "";
	$panel_name = getPanelName($panelid,$con);
	$paramater = 'SensorName';
    if($panel_name=='RASS'){
		$sql = mysqli_query($con,"select $paramater from rass where ZONE='".$zone."'");
	}
    if($panel_name=='rass_cloud'){
		$sql = mysqli_query($con,"select $paramater from rass_cloud where ZONE='".$zone."'");
	}
	if($panel_name=='rass_cloudnew'){
		$sql = mysqli_query($con,"select $paramater from rass_cloudnew where ZONE='".$zone."'");
	}
	if($panel_name=='rass_sbi'){
		$sql = mysqli_query($con,"select $paramater from rass_sbi where ZONE='".$zone."'");
	}
	if($panel_name=='SEC'){
		$sql = mysqli_query($con,"select $paramater from securico where ZONE='".$zone."'");
	}
	if($panel_name=='securico_gx4816'){
		$sql = mysqli_query($con,"select $paramater from securico_gx4816 where ZONE='".$zone."'");
	}
	if($panel_name=='sec_sbi'){
		$sql = mysqli_query($con,"select $paramater from sec_sbi where ZONE='".$zone."'");
	}
	if($panel_name=='Raxx'){
		$sql = mysqli_query($con,"select $paramater from raxx where ZONE='".$zone."'");
	}
	if($panel_name=='SMART -I'){
		$sql = mysqli_query($con,"select $paramater from smarti where ZONE='".$zone."'");
	}
	if($panel_name=='SMART-IN'){
		$sql = mysqli_query($con,"select $paramater from smartinew where ZONE='".$zone."'");
	}
	if($panel_name=='rass_boi'){
		$sql = mysqli_query($con,"select $paramater from rass_boi where ZONE='".$zone."'");
	}
	
	
	if($sql==''){ return '-';}else{
	$sql_result = mysqli_fetch_assoc($sql);
  //  CloseCon($con);
	return $sql_result[$paramater];
	}
}

?>
<?php 
$client = $_POST['client'];
$userid = $_POST['user_id'];
$con = OpenCon();
$usersql = mysqli_query($con,"select cust_id,bank_id from loginusers where id='".$userid."'");
	$userdata = mysqli_fetch_assoc($usersql);
	$_bank_ids = $userdata['bank_id'];
    $banks = explode(",",$_bank_ids);
	$_bank_name = [];
	for($i=0;$i<count($banks);$i++){
	$_bank = explode("_",$banks[$i]);
	if($_bank[0]==$client){
	   array_push($_bank_name,$_bank[1]);
	}
	} 
	   
   $_bank_name=json_encode($_bank_name);
	$_bank_name=str_replace( array('[',']','"') , ''  , $_bank_name);
	$bankarr=explode(',',$_bank_name);
	$_bank_name = "'" . implode ( "', '", $bankarr )."'";

   $bank = "";
   $atmid = "";
if(isset($_POST['bank'])){
$bank = $_POST['bank'];
}
if(isset($_POST['atmid'])){
$atmid = $_POST['atmid'];
}

$atmidarray = [];
$aisitesql = mysqli_query($con,"select ATMCode from ai_alerts group by ATMCode");
	while($aisitesql_result = mysqli_fetch_assoc($aisitesql)){
		$atmidarray[] = ltrim($aisitesql_result['ATMCode']);
		
	}
	$atmidarray=json_encode($atmidarray);
	$atmidarray=str_replace( array('[',']','"') , ''  , $atmidarray);
	$arr=explode(',',$atmidarray);
	$atmidarray = "'" . implode ( "', '", $arr )."'";

if($atmid!=''){
	$sql = mysqli_query($con,"select NewPanelID from sites where atmid='".$atmid."' and live='Y'");
}else{
	if($bank!=''){
	  $sql = mysqli_query($con,"select NewPanelID from sites where Customer='".$client."' and Bank='".$bank."' and live='Y'");
	}else{
		$sql = mysqli_query($con,"select NewPanelID from sites where Customer='".$client."' and Bank IN (".$_bank_name.") and live='Y'");
	}
	
}
    
    $newatmidarray = [];
	while($newsitesql_result = mysqli_fetch_assoc($sql)){
		$newatmidarray[] = $newsitesql_result['NewPanelID'];
		
	}
	$newatmidarray=json_encode($newatmidarray);
	$newatmidarray=str_replace( array('[',']','"') , ''  , $newatmidarray);
	$newarr=explode(',',$newatmidarray);
	$newatmidarray = "'" . implode ( "', '", $newarr )."'";
	
	$testsql = "SELECT * FROM alerts WHERE panelid IN (".$newatmidarray.") ORDER BY id desc LIMIT 10";
    $sql = mysqli_query($con,$testsql);  

$res_data = [];
if(mysqli_num_rows($sql)){
	while($sql_result = mysqli_fetch_assoc($sql)){
		$id = $sql_result['id'];
		$panelid =$sql_result['panelid'];
		$zone = $sql_result['zone'];
		$datetime = $sql_result['createtime'];
		
		$atm_sql = mysqli_query($con,"SELECT ATMID FROM `sites` where NewPanelID='".$panelid."'");
		$atm_sql_result = mysqli_fetch_assoc($atm_sql);
		$atmid = $atm_sql_result['ATMID'];
		
		$alert_name = get_sensor_name($zone,$panelid,$con);
		$_data = [];	
		$_data['id'] = $id; 
		$_data['atmid'] = $atmid;
		$_data['datetime'] = $datetime;
		$_data['alert_name'] = $alert_name;
		array_push($res_data,$_data);
    }
}

if(count($res_data)>0){
	$array = array(['Code'=>200,'res_data'=>$res_data]);
}else{
	$array = array(['Code'=>201]);
}


CloseCon($con);
echo json_encode($array);
?>


