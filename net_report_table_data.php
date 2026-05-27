<?php session_start();include('db_connection.php'); $con = OpenCon();
date_default_timezone_set('Asia/Kolkata');
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
			if($hour<=24){
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

//$client = $_GET['client'];
$client = "Hitachi";

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
			if(count($_circle_name_array)>0){
				$_circle_name_array1=json_encode($_circle_name_array);
				$_circle_name_array1=str_replace( array('[',']','"') , ''  , $_circle_name_array1);
				$circlearr_atm=explode(',',$_circle_name_array1);
				$_circle_name_array1 = "'" . implode ( "', '", $circlearr_atm )."'";
			}	
		}

 $bank = "";$circle="";
   $atmid = "";
if(isset($_GET['bank'])){
$bank = $_GET['bank'];
}
if(isset($_GET['atmid'])){
$atmid = $_GET['atmid'];
}
if(isset($_GET['circle'])){
$circle = $_GET['circle'];
}

$bank = "PNB";
if($atmid!=''){
	$query = "select s.ATMID,s.SN,s.SiteAddress,s.DVRIP,s.PanelIP,s.RouterIp,s.ATMID_2,nr.router,nr.dvr,nr.panel from network_report nr,sites s WHERE nr.SN=s.SN AND s.live='Y' AND s.ATMID='".$atmid."'";
	
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
				$query = "select s.ATMID,s.SN,s.SiteAddress,s.DVRIP,s.PanelIP,s.RouterIp,s.ATMID_2,nr.router,nr.dvr,nr.panel from network_report nr,sites s WHERE nr.SN=s.SN AND s.Customer='".$client."' and s.Bank='".$bank."' and s.ATMID IN (".$circleatmidarray.") and s.live='Y'";
				$sql = mysqli_query($con,$query);	
			}else{
				$query = "select s.ATMID,s.SN,s.SiteAddress,s.DVRIP,s.PanelIP,s.RouterIp,s.ATMID_2,nr.router,nr.dvr,nr.panel from network_report nr,sites s WHERE nr.SN=s.SN AND s.Customer='".$client."' and s.Bank='".$bank."' and s.live='Y'";
		        
			} 
	  
	}else{
		if($client=='All'){
			$query = "select s.ATMID,s.SN,s.SiteAddress,s.DVRIP,s.PanelIP,s.RouterIp,s.ATMID_2,nr.router,nr.dvr,nr.panel from network_report nr,sites s WHERE nr.SN=s.SN AND s.live='Y'";
		    
		}else{
			$query = "select s.ATMID,s.SN,s.SiteAddress,s.DVRIP,s.PanelIP,s.RouterIp,s.ATMID_2,nr.router,nr.dvr,nr.panel from network_report nr,sites s WHERE nr.SN=s.SN AND s.Customer='".$client."' and s.Bank IN (".$_bank_name.") and s.live='Y'";
		    
	    }
	}
	
}
//echo $query;die;
$sql = mysqli_query($con,$query);	
    $code=201;$_data = [];
    $count = 0; 
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
				$atm_id = $sql_result['ATMID'];$atm_id_2 = $sql_result['ATMID_2'];
				$dvrip = $sql_result['DVRIP'];
				$panelip = $sql_result['PanelIP'];
				$routerip = $sql_result['RouterIp'];
				$sn = $sql_result['SN'];
				//$aisql = mysqli_query($con,"select router,dvr,panel from network_report where SN ='".$sn."'"); 
				//if(mysqli_num_rows($aisql)>0){
					$count++;
				//	$aisql_result = mysqli_fetch_assoc($aisql);
					$routerlast_communication = $sql_result['router'];
					$dvrlast_communication = $sql_result['dvr'];
					$panellast_communication = $sql_result['panel'];
					$datetime1 = new DateTime();
					$dvr_status = 0;
					$router_status = 0;
					$panel_status = 0;
					
					if(!is_null($routerlast_communication)){
						$router_status = lastcommunicationdiff($datetime1,$routerlast_communication);
						
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
					}else{
						$routerlast_communication = '-';
						$dvrlast_communication = '-';
						$panellast_communication = '-';
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
					if($router_status>0){$router_status_line="Online";}else{$router_status_line="Offline";}
					if($dvr_status>0){$dvr_status_line="Online";}else{$dvr_status_line="Offline";}
					if($panel_status>0){$panel_status_line="Online";}else{$panel_status_line="Offline";}
					$data_arr = [];
					$data_arr['sr_no'] = $count;
					$data_arr['atm_id'] = $atm_id;
					$data_arr['atm_id_2'] = $atm_id_2;
					$data_arr['site_address'] = $site_address;
					$data_arr['router_status'] = $router_status_line;
					$data_arr['routerip'] = $routerip;
					$data_arr['routerlast_communication'] = $routerlast_communication;
					$data_arr['routeronlinepercent'] = $routeronlinepercent;
					$data_arr['dvr_status'] = $dvr_status_line;
					$data_arr['dvrip'] = $dvrip;
					$data_arr['dvrlast_communication'] = $dvrlast_communication;
					$data_arr['dvronlinepercent'] = $dvronlinepercent;
					$data_arr['panel_status'] = $panel_status_line;
					$data_arr['panelip'] = $panelip;
					$data_arr['panellast_communication'] = $panellast_communication;
					$data_arr['panelonlinepercent'] = $panelonlinepercent;
					
					array_push($_data,$data_arr);	
				//}
		    }
		}
	}
	if(count($_data)>0){
		  $code=200;
	}
	$array = array(['code'=>$code,'res_data'=>$_data]);
	CloseCon($con);
	echo json_encode(utf8ize($array));
  
?>
