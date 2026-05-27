<?php include('db_connection.php'); $con = OpenCon();
date_default_timezone_set('Asia/Kolkata');
$today = date('Y-m-d');
$created_at = date('Y-m-d H:i:s');
$created_date = date('Y-m-d');

$split_created_at = explode(' ',$created_at);
$split_time = explode(":", $split_created_at[1]);
$nowtime_hour = $split_time[0];

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

	$client = "Hitachi";
    $bank = "PNB";
	
	$yesterday = date('Y-m-d',strtotime("-1 days"));
	$lastmonth = date('Y-m-d',strtotime("-30 days"));
	
	$check_sql_qry = "select s.live,s.Customer,s.Bank,s.ATMID,s.SN,s.SiteAddress,s.DVRIP,s.PanelIP,s.RouterIp,s.ATMID_2
                 from sites s where s.Customer='".$client."' and s.Bank='".$bank."' and s.live='Y' AND s.SN NOT IN (SELECT SN from network_report_list)";
	$check_sql = mysqli_query($con,$check_sql_qry); 
	if(mysqli_num_rows($check_sql)){
		while($sql_result = mysqli_fetch_assoc($check_sql)){
			$customer = $sql_result['Customer'];
			$bank = $sql_result['Bank'];
			$atm_id = $sql_result['ATMID'];
			$live = $sql_result['live'];
			
			$dvr_online_count = 0;
			$dvr_offline_count = 0;
			$router_online_count = 0;
			$router_offline_count = 0;
			$panel_online_count = 0;
			$panel_offline_count = 0;
			
			$router_status_total = 0;
			$router_status_online = 0;
			$dvr_status_total = 0;
			$dvr_status_online = 0;
			$panel_status_total = 0;
			$panel_status_online = 0;
			$dvronlinepercent = 0;
			$routeronlinepercent = 0;
			$panelonlinepercent = 0;
			
			$site_address = $sql_result['SiteAddress'];
			$atm_id = $sql_result['ATMID'];$atm_id_2 = $sql_result['ATMID_2'];
			$dvrip = $sql_result['DVRIP'];
			$panelip = $sql_result['PanelIP'];
			$routerip = $sql_result['RouterIp'];
			$sn = $sql_result['SN'];
			//$device_count = $sql_result['device_count'];
			//$sn=3466;
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
					//echo $routerlast_communication;
					if(!is_null($routerlast_communication)){
						$router_status = lastcommunicationdiff($datetime1,$routerlast_communication);
						//echo $router_status;die;
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
							$dvr_status = lastcommunicationdiff($datetime1,$dvrlast_communication);
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
							$panel_status = lastcommunicationdiff($datetime1,$panellast_communication);
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
					
				
					
				$insert_sql = "insert into network_report_list (SN,Customer,Bank,ATMID,SiteAddress,router_status,router_ip,router_lastcommunication,router_online_count,router_tot_count,router_online_percent,dvr_status,dvr_ip,dvr_lastcommunication,dvr_online_count,dvr_tot_count,dvr_online_percent,panel_status,panel_ip,panel_lastcommunication,panel_online_count,panel_tot_count,panel_online_percent,created_at,last_action_date,live)
							  values('".$sn."','".$customer."','".$bank."','".$atm_id."','".$site_address."','".$router_status."','".$routerip."','".$routerlast_communication."','".$router_status_online."','".$router_status_total."','".$routeronlinepercent."','".$dvr_status."','".$dvrip."','".$dvrlast_communication."','".$dvr_status_online."','".$dvr_status_total."','".$dvronlinepercent."','".$panel_status."','".$panelip."','".$panellast_communication."','".$panel_status_online."','".$panel_status_total."','".$panelonlinepercent."','".$created_at."','".$today."','".$live."')";
				//echo $insert_sql;die;
				$result=mysqli_query($con,$insert_sql) ;
		    }
		}
	}
	/*
	$yesterday = date('Y-m-d',strtotime("-1 days"));
	$chk_net_qry = mysqli_query($con,"SELECT * from network_report_list WHERE last_action_date<='".$yesterday."'");
	if(mysqli_num_rows($chk_net_qry)>0){
		$chk_net_qry = mysqli_query($con,"UPDATE network_report_list SET today_tot_hit=0,last_action_date='".$today."' WHERE last_action_date<='".$yesterday."'");
	}
	*/
	$net_qry = "SELECT * from network_report_list WHERE last_action_date='".$today."' AND today_tot_hit<'".$nowtime_hour."' limit 700";
    $sql_qry = "select s.live,s.Customer,s.Bank,s.ATMID,s.SN,s.SiteAddress,s.DVRIP,s.PanelIP,s.RouterIp,s.ATMID_2
                 from sites s join (".$net_qry.") n ON s.SN=n.SN where s.Customer='".$client."' and s.Bank='".$bank."' and s.live='Y'";
   // echo $sql_qry;die;
	$sql = mysqli_query($con,$sql_qry); 

	$count = 0; 
	 if(mysqli_num_rows($sql)){
		while($sql_result = mysqli_fetch_assoc($sql)){
			$customer = $sql_result['Customer'];
			$bank = $sql_result['Bank'];
			$atm_id = $sql_result['ATMID'];
			$live = $sql_result['live'];
			$_view = 1;
			if($_view == 1){
				
				$dvr_online_count = 0;
				$dvr_offline_count = 0;
				$router_online_count = 0;
				$router_offline_count = 0;
				$panel_online_count = 0;
				$panel_offline_count = 0;
				
				$router_status_total = 0;
				$router_status_online = 0;
				$dvr_status_total = 0;
				$dvr_status_online = 0;
				$panel_status_total = 0;
				$panel_status_online = 0;
				$dvronlinepercent = 0;
				$routeronlinepercent = 0;
				$panelonlinepercent = 0;
				
				$site_address = $sql_result['SiteAddress'];
				$atm_id = $sql_result['ATMID'];$atm_id_2 = $sql_result['ATMID_2'];
				$dvrip = $sql_result['DVRIP'];
				$panelip = $sql_result['PanelIP'];
				$routerip = $sql_result['RouterIp'];
				$sn = $sql_result['SN'];
				//$device_count = $sql_result['device_count'];
				//$sn=3466;
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
						//echo $routerlast_communication;
						if(!is_null($routerlast_communication)){
							$router_status = lastcommunicationdiff($datetime1,$routerlast_communication);
							//echo $router_status;die;
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
								$dvr_status = lastcommunicationdiff($datetime1,$dvrlast_communication);
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
								$panel_status = lastcommunicationdiff($datetime1,$panellast_communication);
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
							$is_networksql = 0;   
						}else{
							$net_rep_list = mysqli_fetch_assoc($check_network_report_list);
							$today_hit_time = $net_rep_list['today_tot_hit'];
							if($today_hit_time<$nowtime_hour){
								$tb_id = $net_rep_list['id'];
								$tb_last_action_date = $net_rep_list['last_action_date'];
								$router_status_total = $net_rep_list['router_tot_count'];
								$router_status_online = $net_rep_list['router_online_count'];
								$dvr_status_total = $net_rep_list['dvr_tot_count'];
								$dvr_status_online = $net_rep_list['dvr_online_count'];
								$panel_status_total = $net_rep_list['panel_tot_count'];
								$panel_status_online = $net_rep_list['panel_online_count'];
								$will_update = 1;
								$is_networksql = 1;
							}
						}	
						
						if($is_networksql==1) {	

							$networksql = mysqli_query($con,"select device,status from network_history where site_id ='".$sn."' AND CAST(rectime AS DATE)>='".$lastmonth."' AND CAST(rectime AS DATE)<='".$today."'"); 											
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
								/*
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
								*/
							}else{
								if($routerlast_communication!='0000-00-00 00:00:00'){
									
									$dvr_status_online = 100;$dvr_status_total=100;
									$panel_status_online = 100;$panel_status_total=100;
									$router_status_online = 100;$router_status_total=100;
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
								}
							}
						}
						
						if($check_network_report_list_cnt==0){
			               /*
							if($panellast_communication=='0000-00-00 00:00:00'){
								$panellast_communication='';
							}
							
							if($dvrlast_communication=='0000-00-00 00:00:00'){
								$dvrlast_communication='';
							}
							
							$insert_sql = "insert into network_report_list (SN,Customer,Bank,ATMID,SiteAddress,router_status,router_ip,router_lastcommunication,router_online_count,router_tot_count,router_online_percent,dvr_status,dvr_ip,dvr_lastcommunication,dvr_online_count,dvr_tot_count,dvr_online_percent,panel_status,panel_ip,panel_lastcommunication,panel_online_count,panel_tot_count,panel_online_percent,created_at,last_action_date,is_update,today_tot_hit)
										  values('".$sn."','".$atm_id."','".$site_address."','".$router_status."','".$routerip."','".$routerlast_communication."','".$router_status_online."','".$router_status_total."','".$routeronlinepercent."','".$dvr_status."','".$dvrip."','".$dvrlast_communication."','".$dvr_status_online."','".$dvr_status_total."','".$dvronlinepercent."','".$panel_status."','".$panelip."','".$panellast_communication."','".$panel_status_online."','".$panel_status_total."','".$panelonlinepercent."','".$created_at."','".$yesterday."','1','".$nowtime_hour."')";
							
							$result=mysqli_query($con,$insert_sql) ;
							*/
						}else{
							
							if($will_update==1){
								$updatesql = "update network_report_list SET SN='".$sn."',ATMID='".$atm_id."',SiteAddress='".$site_address."',router_status='".$router_status."',router_ip='".$routerip."',router_lastcommunication='".$routerlast_communication."',router_online_count='".$router_status_online."',router_tot_count='".$router_status_total."',router_online_percent='".$routeronlinepercent."',
											  dvr_status='".$dvr_status."',dvr_ip='".$dvrip."',dvr_lastcommunication='".$dvrlast_communication."',dvr_online_count='".$dvr_status_online."',dvr_tot_count='".$dvr_status_total."',dvr_online_percent='".$dvronlinepercent."',
											  panel_status='".$panel_status."',panel_ip='".$panelip."',panel_lastcommunication='".$panellast_communication."',panel_online_count='".$panel_status_online."',panel_tot_count='".$panel_status_total."',panel_online_percent='".$panelonlinepercent."',last_action_date='".$today."',`is_update`='1', `today_tot_hit`='".$nowtime_hour."' where id='".$tb_id."'";
								//echo $updatesql;die;
								$result=mysqli_query($con,$updatesql) ;
							}
						}
			}
		  }
	   }
	 }
	  CloseCon($con);
	?>
                      
