<?php //include('config.php'); ?>
<?php include('db_connection.php'); ?>
<?php 
function utf8ize($d) {
    if (is_array($d)) {
        foreach ($d as $k => $v) {
            $d[$k] = utf8ize($v);
        }
    } else if (is_string ($d)) {
        return utf8_encode($d);
    }
    return $d;
}
date_default_timezone_set('Asia/Kolkata');

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
   $atmid = "";$circle = "";
if(isset($_POST['bank'])){
$bank = $_POST['bank'];
}
if(isset($_POST['circle'])){
$circle = $_POST['circle'];
}
if(isset($_POST['atmid'])){
$atmid = $_POST['atmid'];
}


if($atmid!=''){
	$sql = mysqli_query($con,"select NewPanelID,ATMID,SiteAddress from sites where atmid='".$atmid."' and live='Y'");
	
}else{
	if($bank!=''){
		if($circle!=''){
					$circlesql = mysqli_query($con,"select ATMID from site_circle where Circle='".$circle."'");
					$circleatmidarray = [];
					while($circlesql_result = mysqli_fetch_assoc($circlesql)){
						$circleatmidarray[] = $circlesql_result['ATMID'];
						
					}
					$circleatmidarray=json_encode($circleatmidarray);
					$circleatmidarray=str_replace( array('[',']','"') , ''  , $circleatmidarray);
					$circlearr=explode(',',$circleatmidarray);
					$circleatmidarray = "'" . implode ( "', '", $circlearr )."'";
					$sql = mysqli_query($con,"select NewPanelID,ATMID,SiteAddress from sites where Customer='".$client."' and Bank='".$bank."' and ATMID IN (".$circleatmidarray.") and live='Y'");
		     }else{ 
			     $sql = mysqli_query($con,"select NewPanelID,ATMID,SiteAddress from sites where Customer='".$client."' and Bank='".$bank."' and live='Y'");
			} 
	  
	}else{
		$sql = mysqli_query($con,"select NewPanelID,ATMID,SiteAddress from sites where Customer='".$client."' and Bank IN (".$_bank_name.") and live='Y'");
	}
	/*
	while($sitesql_result = mysqli_fetch_assoc($sql)){
		$atmidarray[] = $sitesql_result['NewPanelID'];
		
	}
	$atmidarray=json_encode($atmidarray);
	$atmidarray=str_replace( array('[',']','"') , ''  , $atmidarray);
	$arr=explode(',',$atmidarray);
	$atmidarray = "'" . implode ( "', '", $arr )."'";
	
	$testsql = "SELECT * FROM dvrcommunicationdetails_test WHERE DVRIP IN (".$atmidarray.")";
    $sql = mysqli_query($con,$sitesql); */
} 

$_data = [];
 if(mysqli_num_rows($sql)){
		while($sitesql_result = mysqli_fetch_assoc($sql)){
			$panelid = $sitesql_result['NewPanelID'];
			$siteaddress = $sitesql_result['SiteAddress'];
			$alerts_sql = "SELECT id,status,sendtoclient FROM alerts WHERE panelid ='".$panelid."' AND sendtoclient='S' AND (status='C' OR status='O') ORDER BY id DESC"; 
			
			/*$testsql = "SELECT * FROM dvrcommunicationdetails_test WHERE DVRIP ='".$dvrip."' AND CAST(DVRConnectDatetime AS DATE)>='".$start."' 
					   AND CAST(DVRConnectDatetime AS DATE)<='".$end."'"; */
			$dvrhis_query = mysqli_query($con,$alerts_sql); 
			$alert_resolved_count = 0;
			$alert_unresolved_count = 0;
			$totaldvrconnect = mysqli_num_rows($dvrhis_query);   
			if(mysqli_num_rows($dvrhis_query)>0){
				while($dvr_sql_result = mysqli_fetch_assoc($dvrhis_query)){
					$status = $dvr_sql_result['status'];
					$sendtoclient = $dvr_sql_result['sendtoclient'];
					if (!empty($status)) {
						
						if ($status=='C' && $sendtoclient=='S') { 
						   $alert_resolved_count = $alert_resolved_count + 1;
						}
						if ($status=='O' && $sendtoclient=='S') { 
						   $alert_unresolved_count = $alert_unresolved_count + 1;
						}
					}
					
					
				}
				
				$data_arr = [];
				$data_arr['site_address'] = $siteaddress;
				$data_arr['alert_resolved_count'] = $alert_resolved_count;
				$data_arr['alert_unresolved_count'] = $alert_unresolved_count;
				if(count($_data)<10){
				array_push($_data,$data_arr);
				}
				
			}
			
			
																
													   	
		}
	}
  
$array = array(['res_data'=>$_data]);
CloseCon($con);
//echo json_encode($array);
echo json_encode(utf8ize($array));
?>


