<?php  include('db_connection.php'); $con = OpenCon();
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
	  $end_day = 30;
	  $sql = mysqli_query($con,"select SN,id,live_date from dvr_health_site_monthwise_hour where month='4' AND live_date!='0000-00-00' AND SN='4033'");
	  if(mysqli_num_rows($sql)){
		while($sitesql_result = mysqli_fetch_assoc($sql)){
			$id = $sitesql_result['id'];
			$SN = $sitesql_result['SN'];
			$atm_created = $sitesql_result['live_date'];
			if(strtotime($atm_created)<=strtotime($start)){
				$j = 1;
			}else{
				$atm_explode = explode("-",$atm_created);
				$j = $atm_explode[2];
			}
			
			$diff=0;$_total_down_array = array();
			for($i=$j;$i<=$end_day;$i++){
				if($i<9){
					$dd = "0".$i;
				}else{
					$dd = $i;
				}
				$rec_date = $year."-".$month."-".$dd;
			    $testsql = "SELECT status,CAST(rectime AS DATE) as recdatetime FROM network_history1 WHERE site_id ='".$SN."' AND CAST(rectime AS DATE)='".$rec_date."' AND device='D' AND status='OK'"; 
				
				$dvrhis_query = mysqli_query($con,$testsql); 
               // echo $rec_date."=".mysqli_num_rows($dvrhis_query)."</br>";				
				$dvr_online_status = 0;
				if (!$dvrhis_query || mysqli_num_rows($dvrhis_query) == 0){ 
						$diff = $diff + 24;		
                        $data_array = array();
					    $data_array['down_rectime'] = $rec_date;
					    $data_array['up_rectime'] = $rec_date;
					    $data_array['diff_hours'] = 24;
					    array_push($_total_down_array,$data_array);						
				}else{ 
					$dvr_online_status = 1;
				}
			}	
			if($diff==0){
				
			}else{
				$_total_down_array = json_encode($_total_down_array);
				$updatesql= " UPDATE `dvr_health_site_monthwise_hour` SET `total_down_time`='".$diff."',`down_time_history`='".$_total_down_array."' where `id`='".$id."'";
				$month_result = mysqli_query($con,$updatesql);
			}
		}
	  }
	  CloseCon($con);
     