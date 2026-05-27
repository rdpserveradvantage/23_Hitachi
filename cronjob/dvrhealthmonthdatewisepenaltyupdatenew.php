<?php  include('db_connection.php'); $con = OpenCon();
    function lastcommunicationdiff($datetime1,$datetime2){
	    date_default_timezone_set('Asia/Kolkata');
		$datetime1 = new DateTime($datetime1);
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

      date_default_timezone_set('Asia/Kolkata');
	  $query_date = date('Y-m-d');
	  $start = date('Y-m-01', strtotime($query_date));
	  $month = date('m');
	  
	  $month = (int)$month;
	  $year = date('Y');
		// Last day of the month.
		$end = date('Y-m-t', strtotime($query_date));
	  $start = '2022-09-01';
      $end = '2022-09-30';	  
	  $month = '09'; $total_updated = 0; $end_day = 30;
	  $sql = mysqli_query($con,"select SN,id,live_date from dvr_health_site_monthwise_new where live_date!='0000-00-00' AND month='9' AND year='2022' AND is_checked=0 LIMIT 300");
	  if(mysqli_num_rows($sql)){
		while($sitesql_result = mysqli_fetch_assoc($sql)){
			$id = $sitesql_result['id'];
			$SN = $sitesql_result['SN'];
			$atm_created = $sitesql_result['live_date'];
			//echo strtotime($atm_created)."-".strtotime($start);die;
			if(strtotime($atm_created)<=strtotime($start)){
				$j = 1;
				$run_query = 1;
			}else{
				if(strtotime($atm_created)<=strtotime($end)){ 
					$atm_explode = explode("-",$atm_created);
					$j = $atm_explode[2];
					$run_query = 1;
				}else{
					$run_query = 0;
				}
			}
			
			if($run_query==1){
				     
					if($j<9){
						$dd = "0".$j;
					}else{
						$dd = $j;
					}
					
					$j = $j - 1;
				    $_month_tot_day = $end_day - $j;
			        
			        $rec_date = $year."-".$month."-".$dd;
			        $testsql = "SELECT status,rectime,CAST(rectime AS DATE) AS Rec_Date FROM network_historynew WHERE site_id ='".$SN."' AND CAST(rectime AS DATE)>='".$rec_date."' 
								   AND CAST(rectime AS DATE)<='".$end."' AND device='D' ORDER BY id ASC"; 
			    // echo $testsql."</br>";die;
						$dvrhis_query = mysqli_query($con,$testsql); 
					
						$dvr_online_count = 0;
						$dvr_offline_count = 0;
						$total_online_percent = 0;
						$total_offline_percent = 0;
						$previous_rectime = "";$previous_status = "";$diff=0;$counting = 0;
						$_total_down_array = array();
					if (!$dvrhis_query || mysqli_num_rows($dvrhis_query) == 0){
						   $diffhours = $_month_tot_day * 24;
						   $diff = $diff + $diffhours;
						   $data_array = array();
						   $data_array['down_rectime'] = $rec_date;
						   $data_array['up_rectime'] = 'Till '.$end;
						   $data_array['diff_hours'] = $diffhours;
						   array_push($_total_down_array,$data_array);
					}else{
						$tot_key = 0;
						$totaldvrconnect = mysqli_num_rows($dvrhis_query);   
						if(mysqli_num_rows($dvrhis_query)>0){
							while($dvr_sql_result = mysqli_fetch_assoc($dvrhis_query)){
								$tot_key = $tot_key + 1;
								$dvr_status = $dvr_sql_result['status'];
								$dvr_rectime = $dvr_sql_result['rectime'];
								$dvr_recdate = $dvr_sql_result['Rec_Date'];
								if($tot_key==1){
									if($rec_date==$dvr_recdate){
										
									}else{
										$previous_rectime = $rec_date." 00:00:00";
										$previous_status = "NC";
									}
								}
								
								if (!empty($dvr_status)) {
									if($previous_status==""){
										$previous_status = $dvr_status;
										$previous_rectime = $dvr_rectime;
									}
									if ($dvr_status == 'OK') { 
									   if($previous_status=='NC'){ 
										   $d1 = strtotime($previous_rectime);
											$d2 = strtotime($dvr_rectime);
											$totalSecondsDiff = abs($d1-$d2); 
											$diffhours = $totalSecondsDiff/60/60;
										  // $diff = lastcommunicationdiff($dvr_rectime,$previous_rectime);
										   $diff = $diff + $diffhours;
										   $data_array = array();
										   $data_array['down_rectime'] = $previous_rectime;
										   $data_array['up_rectime'] = $dvr_rectime;
										   $data_array['diff_hours'] = $diffhours;
										   array_push($_total_down_array,$data_array);
									   }
										   $previous_status = $dvr_status;
								           $previous_rectime = $dvr_rectime;
									   
									}else{
									    if($previous_status=='OK'){ 
										   $previous_status = $dvr_status;
								           $previous_rectime = $dvr_rectime;
									   }
									}
									
								}
								//echo $previous_rectime."--".$previous_status;die;
								if($totaldvrconnect==$tot_key){
									if($previous_status=='NC'){ 
										   $d1 = strtotime($previous_rectime);
										   $d2 = strtotime($dvr_rectime);
										   $totalSecondsDiff = abs($d1-$d2); 
										   $diffhours = $totalSecondsDiff/60/60;
										  // $diff = lastcommunicationdiff($dvr_rectime,$previous_rectime);
										   $diff = $diff + $diffhours;
										   $data_array = array();
										   $data_array['down_rectime'] = $previous_rectime;
										   $data_array['up_rectime'] = $dvr_rectime;
										   $data_array['diff_hours'] = $diffhours;
										   array_push($_total_down_array,$data_array);
									}
								}
								
							}
							/*
							$number = ($dvr_online_count/$totaldvrconnect)*100;
							
							$offnumber = ($dvr_offline_count/$totaldvrconnect)*100;
							$total_online_percent = number_format((float)$number, 2, '.', '');
							$total_offline_percent = number_format((float)$offnumber, 2, '.', ''); */
						}
		            }
			
					if($diff==0){
						
					}else{
						$_total_down_array = json_encode($_total_down_array);
						$updatesql= " UPDATE `dvr_health_site_monthwise_new` SET `total_down_time`='".$diff."',`down_time_history`='".$_total_down_array."' where `id`='".$id."'";
						$month_result = mysqli_query($con,$updatesql);
						$total_updated = $total_updated + 1;
					}
			}
			$checkupdatesql= " UPDATE `dvr_health_site_monthwise_new` SET `is_checked`='1' where `id`='".$id."'";
			$check_result = mysqli_query($con,$checkupdatesql);
			
		}
	  }
	  CloseCon($con);
	  echo $total_updated;
     