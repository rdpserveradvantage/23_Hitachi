<?php  include('db_connection.php'); $con = OpenCon();
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
	  $month = '09';
	  $end_day = 30;$diff=0;$total_updated = 0;
	  $sql = mysqli_query($con,"select SN,id,live_date from dvr_health_site_monthwise_hour_new where month='9' AND live_date!='0000-00-00' AND is_checked=0 LIMIT 300");
	  if(mysqli_num_rows($sql)){
		while($sitesql_result = mysqli_fetch_assoc($sql)){
			$id = $sitesql_result['id'];
			$SN = $sitesql_result['SN'];
			$atm_created = $sitesql_result['live_date'];
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
			$total_dwn_day = 0;
			if($run_query==1){
				$j = $j - 1;
				$_month_tot_day = $end_day - $j;
				$_total_down_array = array();
				$total_dwn_day = $_month_tot_day;
				//echo $total_dwn_day;die;
				$_net_his = "SELECT CAST(rectime AS DATE) AS up_day FROM `network_historynew` WHERE site_id ='".$SN."' AND device='D' AND status='OK' AND CAST(rectime AS DATE)>='".$start."' AND CAST(rectime AS DATE)<='".$end."' GROUP BY CAST(rectime AS DATE),status";
				$_net_his_res_query = mysqli_query($con,$_net_his); 
				if (!$_net_his_res_query || mysqli_num_rows($_net_his_res_query) == 0){
                    					
					$data_array = array();
					$data_array['down_rectime'] = 'Full Down';
					$data_array['up_rectime'] = 'No Up';
					$data_array['diff_hours'] = $total_dwn_day * 24;
					array_push($_total_down_array,$data_array);	
				}else{
					$_up_day = mysqli_num_rows($_net_his_res_query);
					$total_dwn_day = $_month_tot_day - $_up_day;
					while($_net_his_res = mysqli_fetch_assoc($_net_his_res_query)){
						$data_array = array();
						$data_array['down_rectime'] = '-';
						$data_array['up_rectime'] = $_net_his_res['up_day'];
						$data_array['diff_hours'] = 24;
						array_push($_total_down_array,$data_array);		
					}
				}
			
				//echo $SN."-".$total_dwn_day."</br>";
				if($total_dwn_day==0){
					
				}else{
					$total_dwn_hour = $total_dwn_day * 24;
					$_total_down_array = json_encode($_total_down_array);
					$updatesql= " UPDATE `dvr_health_site_monthwise_hour_new` SET `total_down_time`='".$total_dwn_hour."',`down_time_history`='".$_total_down_array."' where `id`='".$id."'";
					$month_result = mysqli_query($con,$updatesql);
					$diff = $diff + 1;
				}
			}
			$checkupdatesql= " UPDATE `dvr_health_site_monthwise_hour_new` SET `is_checked`='1' where `id`='".$id."'";
			$check_result = mysqli_query($con,$checkupdatesql);
		}
	  }
	  CloseCon($con);
	  echo $diff;
     