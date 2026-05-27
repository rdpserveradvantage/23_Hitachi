<?php include('db_connection.php'); 
date_default_timezone_set('Asia/Kolkata');
  function datetimediff($datetime){
	    $datetime1 = new DateTime();
		$datetime2 = new DateTime($datetime);
		$interval = $datetime1->diff($datetime2);
		//$elapsed = $interval->format('%y years %m months %a days %h hours %i minutes %s seconds');
		$elapsed = $interval->format('%i');
		return $elapsed;
  }
  function lastcommunicationdiff($datetime2){
	    date_default_timezone_set('Asia/Kolkata');
		$datetime1 = new DateTime();
	    $datetime2 = new DateTime($datetime2);
		$interval = $datetime1->diff($datetime2);
		
		$elapsedyear = $interval->format('%y');
		$elapsedmon = $interval->format('%m');
		$elapsed_day = $interval->format('%a');
		$elapsedhr = $interval->format('%h');
		$elapsedmin = $interval->format('%i');
		$not = 0;
		if($elapsedyear>0){$not=$not+1;}
		if($elapsedmon>0){$not=$not+1;}
		if($elapsed_day>0){$not=$not+1;}
		//if($elapsedhr>0){$not=$not+1;}
		$min = $elapsedmin;
		$hour = $elapsedhr;
		if($not>0){
			$return = 0;
		}else{
			if($hour<=24){
				$return = 1;
			}else{
				$return = 0;
			}
		}
				
		return $return;	   
  }
?>
<?php 
    $client = $_POST['client'];
    $userid = $_POST['user_id'];
  
  //  $client = 'Hitachi';
//	$userid = 24;
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
    $atmid = "";$circle="";
	if(isset($_POST['bank'])){
	  $bank = $_POST['bank'];
	}
	if(isset($_POST['atmid'])){
	  $atmid = $_POST['atmid'];
	}
	if(isset($_POST['circle'])){
	  $circle = $_POST['circle'];
	}
/*
	if($atmid!=''){
		$onlinesql = mysqli_query($con,"select * from dvr_health where atmid='".$atmid."' and login_status='0'"); 
		$offlinesql = mysqli_query($con,"select * from dvr_health where atmid='".$atmid."' and login_status='1'"); 
		
		$panelonlinesql = mysqli_query($con,"select * from panel_health where atmid='".$atmid."' and status='0'"); 
		$panelofflinesql = mysqli_query($con,"select * from panel_health where atmid='".$atmid."' and status='1'"); 
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
						$sitesql = mysqli_query($con,"select ATMID from sites where Customer='".$client."' and Bank='".$bank."' and ATMID IN (".$circleatmidarray.") and live='Y'");
				}else{ 
					$sitesql = mysqli_query($con,"select ATMID from sites where Customer='".$client."' and Bank='".$bank."' and live='Y'");	
				} 
			 
			}else{ 
				$sitesql = mysqli_query($con,"select ATMID from sites where Customer='".$client."' and Bank IN (".$_bank_name.") and live='Y'");
			}
	
	//$atmidarray = [];
	if(mysqli_num_rows($sitesql)>0){
		while($sitesql_result = mysqli_fetch_assoc($sitesql)){
			$atmidarray[] = $sitesql_result['ATMID'];
			//array_push($atmidarray,(string)$atmid);
		}
		$atmidarray=json_encode($atmidarray);
		$atmidarray=str_replace( array('[',']','"') , ''  , $atmidarray);
		$arr=explode(',',$atmidarray);
		$atmidarray = "'" . implode ( "', '", $arr )."'";
	}else{
		$atmidarray = "";
	}
	
	$onlinetestsql = "SELECT * FROM dvr_health WHERE atmid IN (".$atmidarray.") and login_status='0'";
    $onlinesql = mysqli_query($con,$onlinetestsql);
	
	$offlinetestsql = "SELECT * FROM dvr_health WHERE atmid IN (".$atmidarray.") and login_status='1'";
    $offlinesql = mysqli_query($con,$offlinetestsql);
	
	//$panelonlinetestsql = "SELECT * FROM panel_health WHERE atmid IN (".$atmidarray.") and login_status='0'";
    //$onlinesql = mysqli_query($con,$panelonlinetestsql);
	$panelonlinesql = mysqli_query($con,"select * from panel_health where atmid IN (".$atmidarray.") and status='0'"); 
    $panelofflinesql = mysqli_query($con,"select * from panel_health where atmid IN (".$atmidarray.") and status='1'"); 
}



//$onlinesql = mysqli_query($con,"select * from dvr_health where atmid='".$atmid."' and login_status='0'"); 
//$offlinesql = mysqli_query($con,"select * from dvr_health where atmid='".$atmid."' and login_status='1'"); 



$dvr_online_count = mysqli_num_rows($onlinesql);
$dvr_offline_count = mysqli_num_rows($offlinesql);
$panel_online_count = mysqli_num_rows($panelonlinesql);
$panel_offline_count = mysqli_num_rows($panelofflinesql);

*/

if($atmid!=''){
	$sql = mysqli_query($con,"select ATMID,SN,SiteAddress,DVRIP,PanelIP,RouterIp from sites where atmid='".$atmid."' and live='Y'");
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
				$sql = mysqli_query($con,"select ATMID,SN,SiteAddress,DVRIP,PanelIP,RouterIp from sites where Customer='".$client."' and Bank='".$bank."' and ATMID IN (".$circleatmidarray.") and live='Y'");
		}else{ 
			$sql = mysqli_query($con,"select ATMID,SN,SiteAddress,DVRIP,PanelIP,RouterIp from sites where Customer='".$client."' and Bank='".$bank."' and live='Y'");	
		} 
	  
	}else{
		$sql = mysqli_query($con,"select ATMID,SN,SiteAddress,DVRIP,PanelIP,RouterIp from sites where Customer='".$client."' and Bank IN (".$_bank_name.") and live='Y'");
	}
	
}
$dvr_online_count = 0;
$dvr_offline_count = 0;
$router_online_count = 0;
$router_offline_count = 0;
$panel_online_count = 0;
$panel_offline_count = 0;

$today = date("Y-m-d H:i");
$_datetime = explode(" ",$today);
$current_date = $_datetime[0];
$current_time = explode(":",$_datetime[1]);
$hh = $current_time[0];
$mm = $current_time[1];


$camera_working_count = 0;
$camera_notworking_count = 0;
$hdd_fail_count = 0;
if(mysqli_num_rows($sql)){
	while($sql_result = mysqli_fetch_assoc($sql)){
		$site_address = $sql_result['SiteAddress'];
		$atm_id = $sql_result['ATMID'];
		$dvrip = $sql_result['DVRIP'];
		$panelip = $sql_result['PanelIP'];
		$routerip = $sql_result['RouterIp'];
		$sn = $sql_result['SN'];
		$aisql = mysqli_query($con,"select * from network_report_list where SN ='".$sn."'"); 
		if(mysqli_num_rows($aisql)>0){
			$aisql_result = mysqli_fetch_assoc($aisql);
			$tb_router_status = $aisql_result['router_status'];
			$tb_dvr_status = $aisql_result['dvr_status'];
			$tb_panel_status = $aisql_result['panel_status'];
			
			if($tb_dvr_status=='1'){
				$dvr_online_count = $dvr_online_count + 1;
			}else{
				$dvr_offline_count = $dvr_offline_count + 1;
			}
			
			if($tb_panel_status=='1'){
				$panel_online_count = $panel_online_count + 1;
			}else{
				$panel_offline_count = $panel_offline_count + 1;
			}
			
		}
	}
}

$array = array(['dvr_online_count'=>$dvr_online_count,'dvr_offline_count'=>$dvr_offline_count,'panel_online_count'=>$panel_online_count,
'panel_offline_count'=>$panel_offline_count]);
CloseCon($con);
echo json_encode($array);

?>


