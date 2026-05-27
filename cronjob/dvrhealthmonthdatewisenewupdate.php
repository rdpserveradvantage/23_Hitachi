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
	  $start = '2022-04-01';
      $end = '2022-04-30';	  
	  $month = 4;
	  $sql = mysqli_query($con,"select SN,id from dvr_health_site_monthwise where offline_percent=0 AND online_percent=0 AND month='4' AND year='2022'");
	  if(mysqli_num_rows($sql)){
		while($sitesql_result = mysqli_fetch_assoc($sql)){
			$id = $sitesql_result['id'];
			$SN = $sitesql_result['SN'];
			$testsql = "SELECT status,rectime FROM network_history1 WHERE site_id ='".$SN."' AND CAST(rectime AS DATE)>='".$start."' 
								   AND CAST(rectime AS DATE)<='".$end."' AND device='D' ORDER BY id ASC"; 
			
						$dvrhis_query = mysqli_query($con,$testsql); 
					
						$dvr_online_count = 0;
						$dvr_offline_count = 0;
						$total_online_percent = 0;
						$total_offline_percent = 0;
						$previous_rectime = "";$previous_status = "";$diff=0;$counting = 0;
						$_total_down_array = array();
					if (!$dvrhis_query || mysqli_num_rows($dvrhis_query) == 0){
						
					}else{
						$tot_key = 0;
						$totaldvrconnect = mysqli_num_rows($dvrhis_query);   
						if(mysqli_num_rows($dvrhis_query)>0){
							while($dvr_sql_result = mysqli_fetch_assoc($dvrhis_query)){
								$tot_key = $tot_key + 1;
								$dvr_status = $dvr_sql_result['status'];
								$dvr_rectime = $dvr_sql_result['rectime'];
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
					$_total_down_array = json_encode($_total_down_array);
					$updatesql= " UPDATE `dvr_health_site_monthwise` SET `total_down_time`='".$diff."',`down_time_history`='".$_total_down_array."' where `id`='".$id."'";
                    $month_result = mysqli_query($con,$updatesql);
		}
	  }
	  CloseCon($con);
     