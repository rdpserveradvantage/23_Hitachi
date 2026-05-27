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
    $dataarray = $_POST['atm_id_list'];
	$purpose = $_POST['purpose'];
	//echo '<pre>';print_r($dataarray);echo '</pre>';
	if($purpose=='list'){
		$type = $_POST['type'];
	}
	$site_list_array = array();
	if(count($dataarray)>0){
			$dataarray=json_encode($dataarray);
			$dataarray=str_replace( array('[',']','"') , ''  , $dataarray);
			$atmarr=explode(',',$dataarray);
			$dataarray = "'" . implode ( "', '", $atmarr )."'";
			$sitesql="select SN from sites where ATMID IN (".$dataarray.")";
			
			$sql = mysqli_query($con,"select SN,ATMID,SiteAddress from sites where live='Y' AND ATMID IN (".$dataarray.")");	
			$dvr_online_count = 0;
			$dvr_offline_count = 0;
			$code = 201;
			if(mysqli_num_rows($sql)){
				while($sql_result = mysqli_fetch_assoc($sql)){
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
	}else{
		$code = 201;
	}

if($code==200){
	if($purpose=='count'){
		$array = array(['Code'=>200,'online_count'=>$dvr_online_count,'offline_count'=>$dvr_offline_count]);
	}else{
	   $array = array(['Code'=>200,'site_list'=>$site_list_array]);
	}
}else{
	$array = array(['Code'=>201]);
}


CloseCon($con);
echo json_encode($array);
?>
