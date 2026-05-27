<?php session_start();include('db_connection.php'); $con = OpenCon();
date_default_timezone_set('Asia/Kolkata');
$today = date('Y-m-d');
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
$client = "Hitachi";
//$client = $_GET['client'];
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
//$atmid = "N8308000";
$atmid = "N8309600";
$net_qry = "SELECT GROUP_CONCAT(concat(c.device,'_',c.cnt)) AS device_count,c.site_id FROM (SELECT device,COUNT(device) AS cnt,site_id FROM `network_history` WHERE status='OK' AND CAST(rectime AS DATE)='".$today."' GROUP BY device,site_id) c GROUP BY c.site_id";
//$net_qry = "select COUNT(*) AS status_count,device,status from network_history where site_id ='".$sn."' AND status='OK' AND CAST(rectime AS DATE)='".$today."' GROUP by device";
if($atmid!=''){
	//$sql = "select ATMID,SN,SiteAddress,DVRIP,PanelIP,RouterIp,ATMID_2 from sites where atmid='".$atmid."' and live='Y'";
	$sql_qry = "select s.ATMID,s.SN,s.SiteAddress,s.DVRIP,s.PanelIP,s.RouterIp,s.ATMID_2,n.device_count
                 from sites s left join (".$net_qry.") n ON s.SN=n.site_id where s.ATMID='".$atmid."' and s.live='Y'";
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
				//$sql_qry = "select ATMID,SN,SiteAddress,DVRIP,PanelIP,RouterIp,ATMID_2 from sites where Customer='".$client."' and Bank='".$bank."' and ATMID IN (".$circleatmidarray.") and live='Y'";	
			    $sql_qry = "select s.ATMID,s.SN,s.SiteAddress,s.DVRIP,s.PanelIP,s.RouterIp,s.ATMID_2,n.device_count
                 from sites s left join (".$net_qry.") n ON s.SN=n.site_id where s.Customer='".$client."' and s.Bank='".$bank."' and s.ATMID IN (".$circleatmidarray.") and s.live='Y'";
			}else{
		         $sql_qry = "select s.ATMID,s.SN,s.SiteAddress,s.DVRIP,s.PanelIP,s.RouterIp,s.ATMID_2,n.device_count
                 from sites s left join (".$net_qry.") n ON s.SN=n.site_id where s.Customer='".$client."' and s.Bank='".$bank."' and s.live='Y'";
			} 
	  
	}else{
		if($client=='All'){
			$sql_qry = "select s.ATMID,s.SN,s.SiteAddress,s.DVRIP,s.PanelIP,s.RouterIp,s.ATMID_2,n.device_count
                 from sites s left join (".$net_qry.") n ON s.SN=n.site_id where s.live='Y'";
		  // $sql_qry = "select ATMID,SN,SiteAddress,DVRIP,PanelIP,RouterIp,ATMID_2 from sites where live='Y'";	
		}else{
			$sql_qry = "select s.ATMID,s.SN,s.SiteAddress,s.DVRIP,s.PanelIP,s.RouterIp,s.ATMID_2,n.device_count
                 from sites s left join (".$net_qry.") n ON s.SN=n.site_id where s.Customer='".$client."' and s.Bank IN (".$_bank_name.") and s.live='Y'";
		 //  $sql_qry = "select ATMID,SN,SiteAddress,DVRIP,PanelIP,RouterIp,ATMID_2 from sites where Customer='".$client."' and Bank IN (".$_bank_name.") and live='Y'";
	    }
	}
	
}
//echo $sql_qry;die;

 $sql = mysqli_query($con,$sql_qry); 
?>
<div class="table-responsive">
                    <table id="order-listing" class="table">
                      <thead >
                        <tr>
						    <th>S.N</th>
							<th>ATM-ID</th><th>ATM-ID 2</th>
							<th>Site Address</th>
							<th>Router</th>
							<th>Router IP</th>
							<th>Router Last Communication</th>
							<th>Till Router Online %</th>
							<th>DVR</th>
							<th>DVR IP</th>
							<th>DVR Last Communication</th>
							<th>Till DVR Online %</th>
							<th>Panel</th>
							<th>Panel IP</th>
							<th>Panel Last Communication</th>
							<th>Till Panel Online %</th>                         
                        </tr>
                      </thead>
                      <tbody>
					    <?php $yesterday = date('Y-m-d',strtotime("-1 days"));
						
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
									$device_count = $sql_result['device_count'];
									$aisql = mysqli_query($con,"select router,dvr,panel from network_report where SN ='".$sn."'"); 
									//echo mysqli_num_rows($aisql);die;
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
										
										if(!is_null($routerlast_communication)){
											$router_status = lastcommunicationdiff($datetime1,$routerlast_communication);
											
											if(!is_null($dvrlast_communication)){
												$dvr_status = lastcommunicationdiff($datetime1,$dvrlast_communication);
											}else{
												$dvrlast_communication = '';
											}
											if(!is_null($panellast_communication)){
												$panel_status = lastcommunicationdiff($datetime1,$panellast_communication);
												
											}else{
												$panellast_communication = '';
												
											}
										}else{
											$routerlast_communication = '';
											$dvrlast_communication = '';
											$panellast_communication = '';
										}
										
										$router_status_total = 0;
										$router_status_online = 0;
										$dvr_status_total = 0;
										$dvr_status_online = 0;
										$panel_status_total = 0;
										$panel_status_online = 0;
										$dvronlinepercent = 0;
										$routeronlinepercent = 0;
										$panelonlinepercent = 0;
										
										$will_update = 0;
										$is_networksql = 0;
										
										$check_network_report_list = mysqli_query($con,"select * from network_report_list where SN='".$sn."'");
										$check_network_report_list_cnt = 1;
										if(mysqli_num_rows($check_network_report_list)==0){ 
											$check_network_report_list_cnt = 0;
											$networksql = mysqli_query($con,"select device,status from network_history where site_id ='".$sn."' AND CAST(rectime AS DATE)<='".$yesterday."'"); 
											$is_networksql = 1;   
										}else{
											$net_rep_list = mysqli_fetch_assoc($check_network_report_list);
											$tb_id = $net_rep_list['id'];
											$tb_last_action_date = $net_rep_list['last_action_date'];
											$router_status_total = $net_rep_list['router_tot_count'];
											$router_status_online = $net_rep_list['router_online_count'];
											$dvr_status_total = $net_rep_list['dvr_tot_count'];
											$dvr_status_online = $net_rep_list['dvr_online_count'];
											$panel_status_total = $net_rep_list['panel_tot_count'];
											$panel_status_online = $net_rep_list['panel_online_count'];
											if($tb_last_action_date==$yesterday){
											   //echo mysqli_num_rows($networksql);
											   $will_update = 1;
											}else{ 
											   $networksql = mysqli_query($con,"select device,status from network_history where site_id ='".$sn."' AND CAST(rectime AS DATE)>'".$tb_last_action_date."' AND CAST(rectime AS DATE)<='".$yesterday."'"); 
											   $will_update = 1;
											   $is_networksql = 1;
											}
											//echo 'else';
										}	
                                        
                                        // echo $is_networksql;die;
                                        if($is_networksql==1) {										 
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
									    }
									
									if($dvr_status_total>0){
										$dvronlinepercent = ($dvr_status_online/$dvr_status_total)*100;
										$dvronlinepercent = number_format((float)$dvronlinepercent, 2, '.', '');
									}
									if($panel_status_total>0){
										$panelonlinepercent = ($panel_status_online/$panel_status_total)*100;
										$panelonlinepercent = number_format((float)$panelonlinepercent, 2, '.', '');
									}
									if($router_status_total>0){
										$routeronlinepercent = ($router_status_online/$router_status_total)*100;
										$routeronlinepercent = number_format((float)$routeronlinepercent, 2, '.', '');
									}
									if($router_status==0){
										$dvr_status = 0;
										$panel_status = 0;	
									}	
									if($routerlast_communication=='0000-00-00 00:00:00'){
										$routerlast_communication='';
										$panellast_communication='';
										$dvrlast_communication='';
									}
									//echo $dvr_status;die; $dvr_status_total
									
									if($router_status_total==0){
										$router_status = 0;
									}else{
										$router_status = 1;
									}
									if($dvr_status_total==0){
										$dvr_status = 0;
									}else{
										$dvr_status = 1;
									}
									if($panel_status_total==0){
										$panel_status = 0;
									}else{
										$panel_status = 1;
									}	 
								    $created_at = date('Y-m-d H:i:s');
								    $created_date = date('Y-m-d');
									
							        if($check_network_report_list_cnt==0){
								
										if($panellast_communication=='0000-00-00 00:00:00'){
											$panellast_communication='';
										}
										
										if($dvrlast_communication=='0000-00-00 00:00:00'){
											$dvrlast_communication='';
										}
										
										$insert_sql = "insert into network_report_list (SN,ATMID,SiteAddress,router_status,router_ip,router_lastcommunication,router_online_count,router_tot_count,router_online_percent,dvr_status,dvr_ip,dvr_lastcommunication,dvr_online_count,dvr_tot_count,dvr_online_percent,panel_status,panel_ip,panel_lastcommunication,panel_online_count,panel_tot_count,panel_online_percent,created_at,last_action_date)
													  values('".$sn."','".$atm_id."','".$site_address."','".$router_status."','".$routerip."','".$routerlast_communication."','".$router_status_online."','".$router_status_total."','".$routeronlinepercent."','".$dvr_status."','".$dvrip."','".$dvrlast_communication."','".$dvr_status_online."','".$dvr_status_total."','".$dvronlinepercent."','".$panel_status."','".$panelip."','".$panellast_communication."','".$panel_status_online."','".$panel_status_total."','".$panelonlinepercent."','".$created_at."','".$yesterday."')";
										
										$result=mysqli_query($con,$insert_sql) ;
									}else{
										//$net_rep_list = mysqli_fetch_assoc($check_network_report_list);
										//$tb_id = $net_rep_list['id'];
										if($will_update==1){
											$updatesql = "update network_report_list SET SN='".$sn."',ATMID='".$atm_id."',SiteAddress='".$site_address."',router_status='".$router_status."',router_ip='".$routerip."',router_lastcommunication='".$routerlast_communication."',router_online_count='".$router_status_online."',router_tot_count='".$router_status_total."',router_online_percent='".$routeronlinepercent."',
														  dvr_status='".$dvr_status."',dvr_ip='".$dvrip."',dvr_lastcommunication='".$dvrlast_communication."',dvr_online_count='".$dvr_status_online."',dvr_tot_count='".$dvr_status_total."',dvr_online_percent='".$dvronlinepercent."',
														  panel_status='".$panel_status."',panel_ip='".$panelip."',panel_lastcommunication='".$panellast_communication."',panel_online_count='".$panel_status_online."',panel_tot_count='".$panel_status_total."',panel_online_percent='".$panelonlinepercent."',last_action_date='".$yesterday."' where id='".$tb_id."'";
											//echo $updatesql;die;
											$result=mysqli_query($con,$updatesql) ;
										}
									}	
									if(is_null($device_count)){
										
									}else{
										$comma_separator = explode(",",$device_count);
										
										for($i=0;$i<count($comma_separator);$i++){
											$_separator = explode("_",$comma_separator[$i]);
											if($_separator[0]=='D'){
												$dvr_status_online = $dvr_status_online + $_separator[1];
											    $dvr_status_total = $dvr_status_total + $_separator[1];
											}elseif($_separator[0]=='P'){
												$panel_status_online = $panel_status_online + $_separator[1];
											    $panel_status_total = $panel_status_total + $_separator[1];
											}else{
												$router_status_online = $router_status_online + $_separator[1];
											    $router_status_total = $router_status_total + $_separator[1];
											}
										}
										
									}
									//echo $will_update;die;
									
									//$net_qry = "select COUNT(*) AS status_count,device,status from network_history where site_id ='".$sn."' AND status='OK' AND CAST(rectime AS DATE)='".$today."' GROUP by device";
                                    
								   /*$networksql = mysqli_query($con,"select device,status from network_history where site_id ='".$sn."' AND CAST(rectime AS DATE)='".$today."'"); 
											         
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
									}  */	
									
									if($dvr_status_total>0){
										$dvronlinepercent = ($dvr_status_online/$dvr_status_total)*100;
										$dvronlinepercent = number_format((float)$dvronlinepercent, 2, '.', '');
									}
									if($panel_status_total>0){
										$panelonlinepercent = ($panel_status_online/$panel_status_total)*100;
										$panelonlinepercent = number_format((float)$panelonlinepercent, 2, '.', '');
									}
									if($router_status_total>0){
										$routeronlinepercent = ($router_status_online/$router_status_total)*100;
										$routeronlinepercent = number_format((float)$routeronlinepercent, 2, '.', '');
									} 						
									
					  ?>
							   <tr>
							   <td><?php echo $count;?></td>
							    <td><?php echo $atm_id;?></td><td><?php echo $atm_id_2;?></td>
								<td><?php echo $site_address;?></td>
                  <td><?php if($router_status==1){ echo 'Online';}else{ echo 'Offline';}?></td>
				  <td><?php echo $routerip;?></td>
				  <td><?php echo $routerlast_communication;?></td>
				  <td><?php echo $routeronlinepercent;?></td>
                  <td><?php if($dvr_status==1){ echo 'Online';}else{ echo 'Offline';}?></td>
                  <td><?php echo $dvrip;;?></td>
				  <td><?php echo $dvrlast_communication;?></td>
				  <td><?php echo $dvronlinepercent;?></td>
                  <td><?php if($panel_status==1){ echo 'Online';}else{ echo 'Offline';}?></td>
                  <td><?php echo $panelip;;?></td>
				  <td><?php echo $panellast_communication;?></td>
				  <td><?php echo $panelonlinepercent;?></td>
                  
								</tr>
								
						<?php   }
							  }
						   }
						 }
						  CloseCon($con);
						?>
                      </tbody>
                    </table>
                  </div>

