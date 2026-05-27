<?php //include('config.php'); ?>
<?php session_start();include('db_connection.php');$con = OpenCon();
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
	
	$_circle_name = "";
	$_circle_name_array = array();
	if($_SESSION['circlename']!=''){
	   $assign_circle = explode(",",$_SESSION['circlename']);
	   $_circle_name = [];
        for($i=0;$i<count($assign_circle);$i++){
		   $_circle = explode("_",$assign_circle[$i]);
		   array_push($_circle_name,$_circle[1]);
		} 
		//$_circle_name = $_circle_name_array;
	    $_circle_name=json_encode($_circle_name);
		$_circle_name=str_replace( array('[',']','"') , ''  , $_circle_name);
		$circlearr=explode(',',$_circle_name);
		$_circle_name = "'" . implode ( "', '", $circlearr )."'";

        $site_circlesql = mysqli_query($con,"select ATMID from site_circle where Circle IN (".$_circle_name.")");	
        while($site_circlesql_result = mysqli_fetch_assoc($site_circlesql)){
				$_circle_name_array[] = $site_circlesql_result['ATMID'];
				
			}		
	}
		
$bank = $_POST['bank'];
$atmid = $_POST['atmid'];
$circle = $_POST['circle'];

$circleatmidarray = [];
if($atmid!=''){
	$sql = mysqli_query($con,"select * from dvr_health where atmid='".$atmid."' and live='Y'");
}else{
	if($bank!=''){
		if($circle!=''){
			$circlesql = mysqli_query($con,"select ATMID from site_circle where Circle='".$circle."'");
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
	$atmidarray = "";
	while($sitesql_result = mysqli_fetch_assoc($sitesql)){
		$_is_atmid = $sitesql_result['ATMID'];
		if(count($_circle_name_array)==0){
			$atmidarray[] = $_is_atmid;
		}else{
			if(in_array($_is_atmid,$_circle_name_array)){
			   $atmidarray[] = $_is_atmid;
			}
		}
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
$cam1_cnt = 0;$cam2_cnt = 0;$cam3_cnt = 0;$cam4_cnt = 0;
$camera_working_count = 0;
$camera_notworking_count = 0;
$hdd_fail_count = 0;
if(mysqli_num_rows($sql)){
	while($sql_result = mysqli_fetch_assoc($sql)){
		$camera4_not = "0";
		$dvratmid = $sql_result['atmid'];
		$persitesql = mysqli_query($con,"select Customer,Bank from sites where ATMID='".$dvratmid."'");
		if(mysqli_num_rows($persitesql)>0){
			$checksql_result = mysqli_fetch_assoc($persitesql);
		    $_customer = $checksql_result['Customer'];
		    $_bank = $checksql_result['Bank'];
			if($_customer=='Hitachi' && $_bank=='BOI'){
				$camera4_not = "1";
			}
		}
	/*	if($sql_result['login_status']=='0'){
			if($sql_result['status']=='1'){
			   $dvr_online_count = $dvr_online_count + 1;
			}else{
				$dvr_offline_count = $dvr_offline_count + 1;
			}
		}else{
			$dvr_offline_count = $dvr_offline_count + 1;
		}  */
		
		if($sql_result['login_status']=='0'){
			$dvr_online_count = $dvr_online_count + 1;
		}
		if($sql_result['login_status']=='1'){
			$dvr_offline_count = $dvr_offline_count + 1;
		} 
		
		if($sql_result['login_status']=='0'){
			if(strtoupper($sql_result['cam1'])=='WORKING'){
				$cam1_cnt = $cam1_cnt + 1;
				$camera_working_count = $camera_working_count + 1;
			}else{
				$camera_notworking_count = $camera_notworking_count + 1;
			}
			
			if(strtoupper($sql_result['cam2'])=='WORKING'){
				$cam2_cnt = $cam2_cnt + 1;
				$camera_working_count = $camera_working_count + 1;
			}else{
				$camera_notworking_count = $camera_notworking_count + 1;
			}
			
			if(strtoupper($sql_result['cam3'])=='WORKING'){
				$cam3_cnt = $cam3_cnt + 1;
				$camera_working_count = $camera_working_count + 1;
			}else{
				$camera_notworking_count = $camera_notworking_count + 1;
			}
			
			
			if($camera4_not == "0"){
				if(strtoupper($sql_result['cam4'])=='WORKING'){
					$cam4_cnt = $cam4_cnt + 1;
					$camera_working_count = $camera_working_count + 1;
				}else{
					$camera_notworking_count = $camera_notworking_count + 1;
				}
			}
		}
		
		if(strtoupper($sql_result['hdd'])=='OK'){ }else{
			if(empty($sql_result['hdd'])){
				
			}else{
			   $hdd_fail_count = $hdd_fail_count + 1;
			}
		} 
		/*
		if($sql_result['status']==1){ 
		   if($sql_result['login_status']==1){ 
		      $hdd_fail_count = $hdd_fail_count + 1;
		   }
		} */
	}
}

$totaldvr = $dvr_online_count + $dvr_offline_count;
$total_online_percent = 0;
$total_offline_percent = 0;
if($totaldvr>0){
$dvr_online_percent = ($dvr_online_count/$totaldvr)*100;
$total_online_percent = number_format((float)$dvr_online_percent, 2, '.', '');

$dvr_offline_percent = ($dvr_offline_count/$totaldvr)*100;
$total_offline_percent = number_format((float)$dvr_offline_percent, 2, '.', '');
}
$circleatmidarray = [];
if($atmid!=''){
	$sql = mysqli_query($con,"select ATMID,SN,SiteAddress,DVRIP,PanelIP,RouterIp from sites where atmid='".$atmid."' and live='Y'");
}else{
	if($bank!=''){
		if($circle!=''){
			$circlesql = mysqli_query($con,"select ATMID from site_circle where Circle='".$circle."'");
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
		$atm_id = $sql_result['ATMID'];
		$_view = 0;
		if(count($_circle_name_array)==0){
			$_view = 1;
		}else{
			if(in_array($atm_id,$_circle_name_array)){
			   $_view = 1;
			}
		}
		if($_view == 1){
				$site_address = $sql_result['SiteAddress'];
				
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
					
					if(!is_null($routerlast_communication)){
						$router_status = lastcommunicationdiff($routerlast_communication);
						if($router_status>0){
							$router_online_count = $router_online_count + 1;
						}else{
							$router_offline_count = $router_offline_count + 1;	
						}
					}else{
							$routerlast_communication = '-';
							$router_offline_count = $router_offline_count + 1;
					}
					
					if($router_status>0){
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
					}else{
						$dvrlast_communication = '-';
						$dvr_offline_count = $dvr_offline_count + 1;
						$panellast_communication = '-';
						$panel_offline_count = $panel_offline_count + 1;
					}
					
					/*
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
					}  */
						
					
				}
		}
	}
}

$totaldvr = $dvr_online_count + $dvr_offline_count;
$total_online_percent = 0;
$total_offline_percent = 0;
if($totaldvr>0){
$dvr_online_percent = ($dvr_online_count/$totaldvr)*100;
$total_online_percent = number_format((float)$dvr_online_percent, 2, '.', '');

$dvr_offline_percent = ($dvr_offline_count/$totaldvr)*100;
$total_offline_percent = number_format((float)$dvr_offline_percent, 2, '.', '');
}




$array = array(['dvr_online_count'=>$dvr_online_count,'dvr_offline_count'=>$dvr_offline_count,
                 'camera_working_count'=>$camera_working_count,'camera_notworking_count'=>$camera_notworking_count,
				 'hdd_fail_count'=>$hdd_fail_count,'total_online_percent'=>$total_online_percent,'total_offline_percent'=>$total_offline_percent,
				 'camera1'=>$cam1_cnt,'camera2'=>$cam2_cnt,'camera3'=>$cam3_cnt,'camera4'=>$cam4_cnt]);
CloseCon($con);
echo json_encode($array);
?>


