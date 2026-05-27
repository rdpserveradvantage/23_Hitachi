<?php session_start();include('db_connection.php'); 
date_default_timezone_set('Asia/Kolkata');
function getPanelName($panelid,$con){
//	global $con;
//	$con = OpenCon();
	$sql = mysqli_query($con,"select Panel_Make from sites where NewPanelID='".$panelid."'");
	$sql_result = mysqli_fetch_assoc($sql);
//	CloseCon($con);
	return $sql_result['Panel_Make'];
}
 
function get_sensor_name($zone,$panelid,$con,$alarm)
{
   // global $con;
	//$con = OpenCon();
	$panel_name = getPanelName($panelid,$con);
	$paramater = 'SensorName';
	$sql = "";
	$_change = 0;
	if($panel_name=='comfort'){
		if(substr($alarm, -1)=='R' || substr($alarm, -1)=='N'){
			$_change = 1;
			$remain_char = substr($alarm, 0,-1);
		    $sql = mysqli_query($con,"select $paramater from comfort where ZONE='".$zone."' AND SCODE LIKE '".$remain_char."%'");	
		}else{
		   $sql = mysqli_query($con,"select $paramater from comfort where ZONE='".$zone."' AND SCODE='".$alarm."'");
		}
	}
	if($panel_name=='rass_boi'){
		if(substr($alarm, -1)=='R'){
			$_change = 1;
			$remain_char = substr($alarm, 0,-1);
		    $sql = mysqli_query($con,"select $paramater from rass_boi where ZONE='".$zone."' AND SCODE LIKE '".$remain_char."%'");	
		}else{
		   $sql = mysqli_query($con,"select $paramater from rass_boi where ZONE='".$zone."' AND SCODE='".$alarm."'");
		}
	}
	if($panel_name=='rass_pnb'){
		if(substr($alarm, -1)=='R'){
			$_change = 1;
			$remain_char = substr($alarm, 0,-1);
		    $sql = mysqli_query($con,"select $paramater from rass_pnb where ZONE='".$zone."' AND SCODE LIKE '".$remain_char."%'");	
		}else{
		   $sql = mysqli_query($con,"select $paramater from rass_pnb where ZONE='".$zone."' AND SCODE='".$alarm."'");
		}
	}
	if($panel_name=='smarti_boi'){
		if(substr($alarm, -1)=='R'){
			$_change = 1;
			$remain_char = substr($alarm, 0,-1);
		    $sql = mysqli_query($con,"select $paramater from smarti_boi where ZONE='".$zone."' AND SCODE LIKE '".$remain_char."%'");	
		}else{
		   $sql = mysqli_query($con,"select $paramater from smarti_boi where ZONE='".$zone."' AND SCODE='".$alarm."'");
		}
	}
	if($panel_name=='smarti_pnb'){
		if(substr($alarm, -1)=='R'){
			$_change = 1;
			$remain_char = substr($alarm, 0,-1);
		    $sql = mysqli_query($con,"select $paramater from smarti_pnb where ZONE='".$zone."' AND SCODE LIKE '".$remain_char."%'");	
		}else{
		   $sql = mysqli_query($con,"select $paramater from smarti_pnb where ZONE='".$zone."' AND SCODE='".$alarm."'");
		}
	}
    if($panel_name=='RASS'){
		$sql = mysqli_query($con,"select $paramater from rass where ZONE='".$zone."' AND status=0");
	}
    if($panel_name=='rass_cloud'){
		$sql = mysqli_query($con,"select $paramater from rass_cloud where ZONE='".$zone."' AND status=0");
	}
	if($panel_name=='rass_cloudnew'){
		$sql = mysqli_query($con,"select $paramater from rass_cloudnew where ZONE='".$zone."' AND status=0");
	}
	if($panel_name=='rass_sbi'){
		$sql = mysqli_query($con,"select $paramater from rass_sbi where ZONE='".$zone."' AND status=0");
	}
	if($panel_name=='SEC'){
		$sql = mysqli_query($con,"select $paramater from securico where ZONE='".$zone."' AND status=0");
	}
	if($panel_name=='securico_gx4816'){
		$sql = mysqli_query($con,"select $paramater from securico_gx4816 where ZONE='".$zone."' AND status=0");
	}
	if($panel_name=='sec_sbi'){
		$sql = mysqli_query($con,"select $paramater from sec_sbi where ZONE='".$zone."' AND status=0");
	}
	if($panel_name=='Raxx'){
		$sql = mysqli_query($con,"select $paramater from raxx where ZONE='".$zone."' AND status=0");
	}
	if($panel_name=='SMART -I'){
		$sql = mysqli_query($con,"select $paramater from smarti where ZONE='".$zone."' AND status=0");
	}
	if($panel_name=='SMART-IN'){
		$sql = mysqli_query($con,"select $paramater from smartinew where ZONE='".$zone."' AND status=0");
	}
	if($sql==""){
		$return = "";
	}else{
		if(mysqli_num_rows($sql)>0){
	        $sql_result = mysqli_fetch_assoc($sql);
	        if($_change == 1){
				if($panel_name=='comfort'){
		            if(substr($alarm, -1)=='R' || substr($alarm, -1)=='N'){
						$return = $sql_result[$paramater]." Restoral";
					}
				}
				else{	
				   if(substr($alarm, -1)=='R'){
					$return = $sql_result[$paramater]." Restoral";
				   }
				}
				
		    } else{
		        $return = $sql_result[$paramater];
			}
		}else{
			$return = "";
		}
		
	}
	return $return;
  //  CloseCon($con);
	
 //  return $panel_name;
}
?>
<?php 
function lastcommunicationdiff($datetime1,$datetime2){
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
			if($hour<=2){
				$return = 1;
			}else{
				$return = 0;
			}
		}
				
		return $return;	   
  }
function getsitedetail($paramater,$panelid,$con){
	//global $con;

	$sql = mysqli_query($con,"select $paramater from sites where NewPanelID='".$panelid."'");
	$sql_result = mysqli_fetch_assoc($sql);
	return $sql_result[$paramater];
}
 

function getPanelIDByAtmid($atmid,$con){
	//global $con;
    $sql = mysqli_query($con,"select * from sites where ATMID like '%".$atmid."%' "); 
    $sql_resultneo = mysqli_fetch_assoc($sql);
	return $sql_resultneo['NewPanelID'];
}

// initilize all variable
	$params = $columns = $totalRecords = $data = array();

	$params = $_REQUEST;

	//define index of column
	$columns = array( 
		0 =>'ATMID',
		1 =>'site_address', 
		2 => 'router_status',
		3 => 'routerip',
		4 =>'routerlast_communication', 
		5 => 'routeronlinepercent',
		6 => 'dvr_status',
		7 =>'dvrip', 
		8 => 'dvrlast_communication',
		9 => 'dvronlinepercent',
		10 =>'panel_status', 
		11 => 'panelip',
	    12 => 'panellast_communication',
		13 => 'panelonlinepercent'
	);

	$where = $sqlTot = $sqlRec = "";

	// check search value exist
	if( !empty($params['search']['value']) ) {   
		$where .=" WHERE ";
		$where .=" ( employee_name LIKE '".$params['search']['value']."%' ";    
		$where .=" OR employee_salary LIKE '".$params['search']['value']."%' ";

		$where .=" OR employee_age LIKE '".$params['search']['value']."%' )";
	}

	// getting total number records without any search
	$client = $params['client'];
$banks = explode(",",$_SESSION['bankname']);
       $_bank_name = [];
       for($i=0;$i<count($banks);$i++){
		   $_bank = explode("_",$banks[$i]);
		   if($client=='All'){
			    array_push($_bank_name,$_bank[1]);
		   }else{
			   if($_bank[0]==$client){
				   array_push($_bank_name,$_bank[1]);
			   }
		   }
	   } 
	    $_bank_name=json_encode($_bank_name);
		$_bank_name=str_replace( array('[',']','"') , ''  , $_bank_name);
		$bankarr=explode(',',$_bank_name);
		$_bank_name = "'" . implode ( "', '", $bankarr )."'";

 $bank = "";
   $atmid = "";
if(isset($params['bank'])){
$bank = $params['bank'];
}
if(isset($params['atmid'])){
$atmid = $params['atmid'];
}
$con = OpenCon();

if($atmid!=''){
	//$sql = mysqli_query($con,"select ATMID,SN,SiteAddress,DVRIP,PanelIP,RouterIp from sites where atmid='".$atmid."' and live='Y'");
	$sql = "select ATMID,SN,SiteAddress,DVRIP,PanelIP,RouterIp from sites where atmid='".$atmid."' and live='Y'";
}else{
	if($bank!=''){
	 // $sql = mysqli_query($con,"select ATMID,SN,SiteAddress,DVRIP,PanelIP,RouterIp from sites where Customer='".$client."' and Bank='".$bank."' and live='Y'");
	 $sql = "select ATMID,SN,SiteAddress,DVRIP,PanelIP,RouterIp from sites where Customer='".$client."' and Bank='".$bank."' and live='Y'";
	}else{
		if($client=='All'){
		//$sql = mysqli_query($con,"select ATMID,SN,SiteAddress,DVRIP,PanelIP,RouterIp from sites where live='Y'");	
		$sql = "select ATMID,SN,SiteAddress,DVRIP,PanelIP,RouterIp from sites where live='Y'";	
		}else{
		//$sql = mysqli_query($con,"select ATMID,SN,SiteAddress,DVRIP,PanelIP,RouterIp from sites where Customer='".$client."' and Bank IN (".$_bank_name.") and live='Y'");
		$sql = "select ATMID,SN,SiteAddress,DVRIP,PanelIP,RouterIp from sites where Customer='".$client."' and Bank IN (".$_bank_name.") and live='Y'";
	    }
	}
	
}

//$sql = "SELECT * FROM `employee` ";
	$sqlTot .= $sql;
	$sqlRec .= $sql;
	//concatenate search sql if value exist
	if(isset($where) && $where != '') {

		$sqlTot .= $where;
		$sqlRec .= $where;
	}


 	$sqlRec .=  " ORDER BY ". $columns[$params['order'][0]['column']]."   ".$params['order'][0]['dir']."  LIMIT ".$params['start']." ,".$params['length']." ";

	$queryTot = mysqli_query($con, $sqlTot) or die("database error:". mysqli_error($con));


	$totalRecords = mysqli_num_rows($queryTot);

	$queryRecords = mysqli_query($con, $sqlRec) or die($sqlRec);

  
?>

					    <?php 
                        $count = 0; 
						$_data = [];
						 if(mysqli_num_rows($queryRecords)){
							while($sql_result = mysqli_fetch_assoc($queryRecords)){
								$count++;
								$site_address = $sql_result['SiteAddress'];
								$atm_id = $sql_result['ATMID'];
								$dvrip = $sql_result['DVRIP'];
								$panelip = $sql_result['PanelIP'];
								$routerip = $sql_result['RouterIp'];
								$sn = $sql_result['SN'];
								$aisql = mysqli_query($con,"select router,dvr,panel from network_report where SN ='".$sn."'"); 
								if(mysqli_num_rows($aisql)>0){
									$count++;
									$aisql_result = mysqli_fetch_assoc($aisql);
									$routerlast_communication = $aisql_result['router'];
									$dvrlast_communication = $aisql_result['dvr'];
									$panellast_communication = $aisql_result['panel'];
									$datetime1 = new DateTime();
									$dvr_status = 0;
									$router_status = 0;
									$panel_status = 0;
									if(!is_null($dvrlast_communication)){
										$dvr_status = lastcommunicationdiff($datetime1,$dvrlast_communication);
									}else{
										$dvrlast_communication = '-';
									}
									if(!is_null($panellast_communication)){
										$panel_status = lastcommunicationdiff($datetime1,$panellast_communication);
										
									}else{
										$panellast_communication = '-';
										
									}
									
									if(!is_null($routerlast_communication)){
										$router_status = lastcommunicationdiff($datetime1,$routerlast_communication);
										
									}else{
										if($dvrip==$panelip){
											$routerip = $dvrip;
											$router_status = $dvr_status;
											$routerlast_communication = $dvrlast_communication;
										}else{
											if($dvr_status>0){
												if($panel_status>0){
													
												}else{
													$routerlast_communication = $dvrlast_communication;
												}
												$router_status = 1;
											}else{
												if($panel_status>0){
													$routerlast_communication = $panellast_communication;
													$router_status = 1;
												}else{
													$routerlast_communication = '-';
													
												}
											}
										}
									}
								
										
								$networksql = mysqli_query($con,"select device,status from network_history where site_id ='".$sn."'"); 	
								$router_status_total = 0;
								$router_status_online = 0;
								$dvr_status_total = 0;
								$dvr_status_online = 0;
								$panel_status_total = 0;
								$panel_status_online = 0;
								$dvronlinepercent = 0;
								$routeronlinepercent = 0;
								$panelonlinepercent = 0;
								if(mysqli_num_rows($networksql)>0){
									while($network_result = mysqli_fetch_assoc($networksql)){
										if($network_result['device']=='D'){
											$dvr_status_total = $dvr_status_total + 1; 
											if($network_result['status']=='OK'){
												$dvr_status_online = $dvr_status_online + 1;
											}
										}
										if($network_result['device']=='P'){
											$panel_status_total = $panel_status_total + 1; 
											if($network_result['status']=='OK'){
												$panel_status_online = $panel_status_online + 1;
											}
										}
										if($network_result['device']=='R'){
											$router_status_total = $router_status_total + 1; 
											if($network_result['status']=='OK'){
												$router_status_online = $router_status_online + 1;
											}
										}
									}
									
								}
								
								if($dvr_status_total>0){
									$dvronlinepercent = ($dvr_status_online/$dvr_status_total)*100;
                                    $dvronlinepercent = number_format((float)$dvronlinepercent, 2, '.', '');
								}
								if($panel_status_total>0){
									$panelonlinepercent = ($dvr_status_online/$panel_status_total)*100;
                                    $panelonlinepercent = number_format((float)$panelonlinepercent, 2, '.', '');
								}
								if($router_status_total>0){
									$routeronlinepercent = ($router_status_online/$router_status_total)*100;
                                    $routeronlinepercent = number_format((float)$routeronlinepercent, 2, '.', '');
								}
								
								$data_arr = [];
								$data_arr[] = $atm_id;
								$data_arr[] = $site_address;
								if($router_status>0){$router_status_value= 'Online';}else{$router_status_value= 'Offline';}
								$data_arr[] = $router_status_value;
								$data_arr[] = $routerip;
								$data_arr[] = $routerlast_communication;
								$data_arr[] = $routeronlinepercent;
								if($dvr_status>0){$dvr_status_value= 'Online';}else{$dvr_status_value= 'Offline';}
								$data_arr[] = $dvr_status_value;
								$data_arr[] = $dvrip;
								$data_arr[] = $dvrlast_communication;
								$data_arr[] = $dvronlinepercent;
								if($panel_status>0){$panel_status_value= 'Online';}else{$panel_status_value= 'Offline';}
								$data_arr[] = $panel_status_value;
								$data_arr[] = $panelip;
								$data_arr[] = $panellast_communication;
								$data_arr[] = $panelonlinepercent;
								array_push($_data,$data_arr);
								
                  ?>
							   
								
						<?php }
							}
						}

						// $array = array(['res_data'=>$_data]);
								CloseCon($con);
								 $json_data = array(
										"draw"            => intval( $params['draw'] ),   
										"recordsTotal"    => intval( $totalRecords ),  
										"recordsFiltered" => intval($totalRecords),
										"data"            => $_data   // total data array
										);

								echo json_encode($json_data);  // send data as json format
						?>
                     

