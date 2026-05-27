<?php session_start();include('db_connection.php');
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
$banks = explode(",",$_SESSION['bankname']);
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
if(isset($_POST['circle'])){
$circle = $_POST['circle'];
}
$con = OpenCon();
$dvronline_count = 0;
$dvroffline_count = 0;
$panelonline_count = 0;
$paneloffline_count = 0;
if($atmid!=''){
	$dvrsql = mysqli_query($con,"select login_status from dvr_health where atmid='".$atmid."'"); 
	if(mysqli_num_rows($dvrsql)>0){
		$dvr_res = mysqli_fetch_assoc($dvrsql);
		if($dvr_res['login_status']=='0'){
			$dvronline_count = $dvronline_count + 1;
		}
		if($dvr_res['login_status']=='1'){
			$dvroffline_count = $dvroffline_count + 1;
		}
	}
	
	$panelsql = mysqli_query($con,"select status from panel_health where atmid='".$atmid."'"); 
	if(mysqli_num_rows($panelsql)>0){
		$panel_res = mysqli_fetch_assoc($panelsql);
		if($panel_res['status']=='0'){
			$panelonline_count = $panelonline_count + 1;
		}
		if($panel_res['status']=='1'){
			$paneloffline_count = $paneloffline_count + 1;
		}
	}
	
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
	}else{
		$atmidarray = [];
	}
	$atmidarray=json_encode($atmidarray);
	$atmidarray=str_replace( array('[',']','"') , ''  , $atmidarray);
	$arr=explode(',',$atmidarray);
	$atmidarray = "'" . implode ( "', '", $arr )."'";
	
	
	$onlinetestsql = "SELECT id FROM dvr_health WHERE atmid IN (".$atmidarray.") and login_status='0'";
    $onlinesql = mysqli_query($con,$onlinetestsql);
	
	$offlinetestsql = "SELECT id FROM dvr_health WHERE atmid IN (".$atmidarray.") and login_status='1'";
    $offlinesql = mysqli_query($con,$offlinetestsql);
	
	//$panelonlinetestsql = "SELECT * FROM panel_health WHERE atmid IN (".$atmidarray.") and login_status='0'";
    //$onlinesql = mysqli_query($con,$panelonlinetestsql);
	$panelonlinesql = mysqli_query($con,"select atmid from panel_health where atmid IN (".$atmidarray.") and status='0'"); 
    $panelofflinesql = mysqli_query($con,"select atmid from panel_health where atmid IN (".$atmidarray.") and status='1'"); 
	
	$dvrsql = mysqli_query($con,"select login_status from dvr_health where atmid IN (".$atmidarray.")"); 
	if(mysqli_num_rows($dvrsql)>0){
		while($dvr_res = mysqli_fetch_assoc($dvrsql)){
			if($dvr_res['login_status']=='0'){
				$dvronline_count = $dvronline_count + 1;
			}
			if($dvr_res['login_status']=='1'){
				$dvroffline_count = $dvroffline_count + 1;
			}
		}
	}
	
	$panelsql = mysqli_query($con,"select status from panel_health where atmid IN (".$atmidarray.")"); 
	if(mysqli_num_rows($panelsql)>0){
		while($panel_res = mysqli_fetch_assoc($panelsql)){
			if($panel_res['status']=='0'){
				$panelonline_count = $panelonline_count + 1;
			}
			if($panel_res['status']=='1'){
				$paneloffline_count = $paneloffline_count + 1;
			}
		}
	}
	
}

//$onlinesql = mysqli_query($con,"select * from dvr_health where atmid='".$atmid."' and login_status='0'"); 
//$offlinesql = mysqli_query($con,"select * from dvr_health where atmid='".$atmid."' and login_status='1'"); 


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
		if($client=='All'){
		$sql = mysqli_query($con,"select ATMID,SN,SiteAddress,DVRIP,PanelIP,RouterIp from sites where live='Y'");	
		}else{
		$sql = mysqli_query($con,"select ATMID,SN,SiteAddress,DVRIP,PanelIP,RouterIp from sites where Customer='".$client."' and Bank IN (".$_bank_name.") and live='Y'");
		}
	}
	/*$atmidarray = [];
	while($sitesql_result = mysqli_fetch_assoc($sitesql)){
		$atmidarray[] = $sitesql_result['ATMID'];
		
	}
	$atmidarray=json_encode($atmidarray);
	$atmidarray=str_replace( array('[',']','"') , ''  , $atmidarray);
	$arr=explode(',',$atmidarray);
	$atmidarray = "'" . implode ( "', '", $arr )."'";
	
	$testsql = "SELECT * FROM sites WHERE ATMID IN (".$atmidarray.")";
    $sql = mysqli_query($con,$testsql); */
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


//$camera_working_count = 0;
//$camera_notworking_count = 0;
//$hdd_fail_count = 0;
if(mysqli_num_rows($sql)){
	while($sql_result = mysqli_fetch_assoc($sql)){
		$site_address = $sql_result['SiteAddress'];
		$atm_id = $sql_result['ATMID'];
		$dvrip = $sql_result['DVRIP'];
		$panelip = $sql_result['PanelIP'];
		$routerip = $sql_result['RouterIp'];
		$sn = $sql_result['SN'];
		$aisql = mysqli_query($con,"select router,dvr,panel from network_report where SN ='".$sn."'"); 
		if(mysqli_num_rows($aisql)>0){
			$aisql_result = mysqli_fetch_assoc($aisql);
			$routerlast_communication = $aisql_result['router'];
			$dvrlast_communication = $aisql_result['dvr'];
			$panellast_communication = $aisql_result['panel'];
			$datetime1 = new DateTime();
			$dvr_status = 0;
			$router_status = 0;
			$panel_status = 0;
			if(!is_null($dvrlast_communication)){
				$dvr_status = lastcommunicationdiff($dvrlast_communication);
				if($dvr_status>0){
				$dvr_online_count = $dvr_online_count + 1;
				}else{
				$dvr_offline_count = $dvr_offline_count + 1;	
				}
			}else{
				$dvrlast_communication = '-';
				$dvr_offline_count = $dvr_offline_count + 1;
			}
			if(!is_null($panellast_communication)){
				$panel_status = lastcommunicationdiff($panellast_communication);
				if($panel_status>0){
				$panel_online_count = $panel_online_count + 1;
				}else{
				$panel_offline_count = $panel_offline_count + 1;	
				}
			}else{
				$panellast_communication = '-';
				$panel_offline_count = $panel_offline_count + 1;
			}
			if(!is_null($routerlast_communication)){
				$router_status = lastcommunicationdiff($routerlast_communication);
				if($router_status>0){
				$router_online_count = $router_online_count + 1;
				}else{
				$router_offline_count = $router_offline_count + 1;	
				}
			}else{
				if($dvr_status>0){
					if($panel_status>0){
						  $datetime_1 = strtotime($panellast_communication);
						  $datetime_2 = strtotime($dvrlast_communication);
						  if($datetime_1>$datetime_2){
							$routerlast_communication = $panellast_communication; 
						  }else{
							$routerlast_communication = $dvrlast_communication;  
						  }
					}else{
						$routerlast_communication = $dvrlast_communication;
					}
					$router_online_count = $router_online_count + 1;
				}else{
					if($panel_status>0){
						$routerlast_communication = $panellast_communication;
						$router_online_count = $router_online_count + 1;
					}else{
						$routerlast_communication = '-';
						$router_offline_count = $router_offline_count + 1;
					}
				}
			}
				
			
		}
	}
}


CloseCon($con);

echo $dvr_online_count."_".$dvr_offline_count."_".$panelonline_count."_".$paneloffline_count;
?>


