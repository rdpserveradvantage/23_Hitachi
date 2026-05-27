<?php //include('config.php'); ?>
<?php include('db_connection.php'); ?>
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

$dvrstatus = $_POST['status'];
if($dvrstatus==0){
	$_status = 1;
}
$con = OpenCon();

if($atmid!=''){
	$sql = mysqli_query($con,"select * from dvr_health where atmid='".$atmid."'");
}else{
	if($bank!=''){
	    $sitesql = mysqli_query($con,"select ATMID from sites where Customer='".$client."' and Bank='".$bank."' and live='Y'");
	}else{
		$sitesql = mysqli_query($con,"select ATMID from sites where Customer='".$client."' and Bank IN (".$_bank_name.") and live='Y'");
	}
	//$atmidarray = [];
	while($sitesql_result = mysqli_fetch_assoc($sitesql)){
		$atmidarray[] = $sitesql_result['ATMID'];
		//array_push($atmidarray,(string)$atmid);
	}
	$atmidarray=json_encode($atmidarray);
	$atmidarray=str_replace( array('[',']','"') , ''  , $atmidarray);
	$arr=explode(',',$atmidarray);
	$atmidarray = "'" . implode ( "', '", $arr )."'";
	
	$testsql = "SELECT * FROM dvr_health WHERE atmid IN (".$atmidarray.")";
    $sql = mysqli_query($con,$testsql);
}
$dvr_online_count = 0;
$dvr_offline_count = 0;

$camera_working_count = 0;
$camera_notworking_count = 0;
$hdd_fail_count = 0;
?>

       
<?php
$_data = [];
if(mysqli_num_rows($sql)){
	while($sql_result = mysqli_fetch_assoc($sql)){
		$_atm_id = $sql_result['atmid'];
		$sites_sql = mysqli_query($con,"select NewPanelID,ATMID,SiteAddress from sites where atmid='".$_atm_id."' and live='Y'");
		$sitesql_result = mysqli_fetch_assoc($sites_sql);
		$siteaddress = $sitesql_result['SiteAddress'];
		$last_communication = $sql_result['last_communication'];
		$cdate = $sql_result['cdate'];
		$data_arr = [];
		$data_arr['site_address'] = $siteaddress;
		$data_arr['last_communication'] = $last_communication;
		$data_arr['atm_id'] = $_atm_id;
		
		$login_status = $sql_result['login_status'];
		$_status = $sql_result['status'];
		$_view = 0;
		if($dvrstatus==$login_status){
			$_view = 1;
			
		}
		if($dvrstatus==$login_status){
			$_view = 1;
		}
		
		if($_view==1){
		array_push($_data,$data_arr);
		}
		/*
		if($sql_result['login_status']=='0'){
			$dvr_online_count = $dvr_online_count + 1;
		}else{
			$dvr_offline_count = $dvr_offline_count + 1;
		}
		
		if(strtoupper($sql_result['cam1'])=='WORKING'){
			$camera_working_count = $camera_working_count + 1;
		}else{
			$camera_notworking_count = $camera_notworking_count + 1;
		}
		
		if(strtoupper($sql_result['cam2'])=='WORKING'){
			$camera_working_count = $camera_working_count + 1;
		}else{
			$camera_notworking_count = $camera_notworking_count + 1;
		}
		
		if(strtoupper($sql_result['cam3'])=='WORKING'){
			$camera_working_count = $camera_working_count + 1;
		}else{
			$camera_notworking_count = $camera_notworking_count + 1;
		}
		
		if(strtoupper($sql_result['cam4'])=='WORKING'){
			$camera_working_count = $camera_working_count + 1;
		}else{
			$camera_notworking_count = $camera_notworking_count + 1;
		}
		
				
		if($sql_result['status']==1){ 
		   if($sql_result['login_status']==1){ 
		      $hdd_fail_count = $hdd_fail_count + 1;
		   }
		} */
		
			}
					}
			
$array = array(['res_data'=>$_data]);
CloseCon($con);
echo json_encode($array);
?>


