<?php include('db_connection.php');
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
    $con = OpenCon();
    $atmdataarray = $_POST['atm_id_list'];
	$purpose = $_POST['purpose'];
	if($purpose=='list'){
		$type = $_POST['type'];
	}
	$site_list_array = array();
	$cam_data_arr= array();
	if(count($atmdataarray)>0){
			$dataarray=json_encode($atmdataarray);
			$dataarray=str_replace( array('[',']','"') , ''  , $dataarray);
			$atmarr=explode(',',$dataarray);
			$dataarray = "'" . implode ( "', '", $atmarr )."'";
			$sitesql="select SN from sites where ATMID IN (".$dataarray.")";
			
			$sql = mysqli_query($con,"select SN,ATMID,SiteAddress from sites where live='Y' AND ATMID IN (".$dataarray.")");
            $total_site_count = 0;			
			$dvr_online_count = 0;
			$dvr_offline_count = 0;
			$code = 201;
			if(mysqli_num_rows($sql)){
				while($sql_result = mysqli_fetch_assoc($sql)){
					$total_site_count = $total_site_count + 1;
					$atmid = $sql_result['ATMID'];
					$siteaddress = $sql_result['SiteAddress'];
					$sn = $sql_result['SN'];
					$aisql = mysqli_query($con,"select router,dvr,panel from network_report_comfort where SN ='".$sn."'"); 
					if(mysqli_num_rows($aisql)>0){
						$aisql_result = mysqli_fetch_assoc($aisql);
						$routerlast_communication = $aisql_result['router'];
						$dvrlast_communication = $aisql_result['dvr'];
						$panellast_communication = $aisql_result['panel'];
						$datetime1 = new DateTime();
						$dvr_status = 0;
						$router_status = 0;
						$panel_status = 0;
						$is_online = 'offline';
						if(!is_null($dvrlast_communication)){
							$dvr_status = lastcommunicationdiff($dvrlast_communication);
							if($dvr_status>0){
							$dvr_online_count = $dvr_online_count + 1;
							$is_online = 'online';
							}else{
							$dvr_offline_count = $dvr_offline_count + 1;	
							}
						}else{
							$dvrlast_communication = '-';
							$dvr_offline_count = $dvr_offline_count + 1;
						}
						if($purpose=='list'){
							if($type=="all"){
								$newdata_array = array();
								$newdata_array['atmid'] = $atmid;
								$newdata_array['siteaddress'] = $siteaddress;
								$newdata_array['is_online'] = $is_online;
								array_push($site_list_array,$newdata_array);
							}else{
								if($type==$is_online){
									$newdata_array = array();
									$newdata_array['atmid'] = $atmid;
									$newdata_array['siteaddress'] = $siteaddress;
									$newdata_array['is_online'] = $is_online;
									array_push($site_list_array,$newdata_array);
								}
							}
						}
					}
				
				}
				$code = 200;
			}
			
		$Q4="select count(*) as totalError from dvr_health_comfort where hdd='error' AND atmid IN (".$dataarray.")";
		$errorqry=mysqli_query($con,$Q4);
		$fetcherrorQry=mysqli_fetch_array($errorqry);
        $error_count = $fetcherrorQry['totalError'];                                    
                                            
		$Q5="select count(*) as totalNotExist from dvr_health_comfort where (hdd='notexist' or hdd='Not Exist') AND atmid IN (".$dataarray.") ";
		$notexistqry=mysqli_query($con,$Q5);
		$fetchNotExistQry=mysqli_fetch_array($notexistqry);
		$totalnotexist = $fetchNotExistQry['totalNotExist'];
		
		$Q6="select count(*) as totalSmartFailed from dvr_health_comfort where hdd='smartFailed' AND atmid IN (".$dataarray.")";
		$smartFailedqry=mysqli_query($con,$Q6);
		$fetchsmartFailedQry=mysqli_fetch_array($smartFailedqry);
		$totalSmartFailed = $fetchsmartFailedQry['totalSmartFailed'];
		
		$Q61="select count(*) as totalAbNormal from dvr_health_comfort where hdd='abnormal' AND atmid IN (".$dataarray.")";
		$abnormalqry=mysqli_query($con,$Q61);
		$fetchabNormalQry=mysqli_fetch_array($abnormalqry);
		$totalAbNormal = $fetchabNormalQry['totalAbNormal'];
		
		$Q62="select count(*) as totalNoDisk from dvr_health_comfort where (hdd='No Disk' or hdd='No disk/idle') AND atmid IN (".$dataarray.")";
		$noDiskqry=mysqli_query($con,$Q62);
		$fetchnoDiskQry=mysqli_fetch_array($noDiskqry);
		$totalNoDisk = $fetchnoDiskQry['totalNoDisk'];
		
		
		$Q7="select count(*) as totalUnformatted from dvr_health_comfort where hdd='unformatted' AND atmid IN (".$dataarray.")";
		$unformattedqry=mysqli_query($con,$Q7);
		$fetchunformattedQry=mysqli_fetch_array($unformattedqry);
		$totalUnformatted = $fetchunformattedQry['totalUnformatted'];
		
		$Q9="select count(*) as totalCam1Notworking from dvr_health_comfort where cam1='not working' AND atmid IN (".$dataarray.")";
		$Notworkingqry1=mysqli_query($con,$Q9);
		$fetchNotworkingQry1=mysqli_fetch_assoc($Notworkingqry1);
		$totalCam1Notworking = $fetchNotworkingQry1['totalCam1Notworking'];
		
		$Q91="select * from dvr_health_comfort where cam1='not working' AND atmid IN (".$dataarray.")";
		$_Notworkingqry1=mysqli_query($con,$Q91);
		while($_fetchNotworkingQry1=mysqli_fetch_assoc($_Notworkingqry1)){
			$_not = array();
			$_not['atmid'] = $_fetchNotworkingQry1['atmid'];
			$_not['cam1'] = $_fetchNotworkingQry1['cam1'];
			array_push($cam_data_arr,$_not);
		}
		
	}else{
		$code = 201;
	}
	
	
   
$_arr_explode = explode(',',$dataarray);
$arr_atm_count =  count($_arr_explode);  

if($code==200){
	if($purpose=='count'){
		$array = array(['Code'=>200,'online_count'=>$dvr_online_count,'offline_count'=>$dvr_offline_count,'totalAbNormal'=>$totalAbNormal,'totalNoDisk'=>$totalNoDisk,'total_site_count'=>$total_site_count,
		                'error_count'=>$error_count,'notexist'=>$totalnotexist,'smartFailed'=>$totalSmartFailed,'totalUnformatted'=>$totalUnformatted,'totalCam1NotWorking'=>$totalCam1Notworking,'atm_arr'=>$Q91]);
	}else{
	   $array = array(['Code'=>200,'site_list'=>$site_list_array,'atm_arr'=>$arr_atm_count]);
	}
}else{
	$array = array(['Code'=>201,'atm_arr'=>$arr_atm_count]);
}


CloseCon($con);
echo json_encode($array);
?>
