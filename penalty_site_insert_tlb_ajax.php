<?php include('db_connection.php'); 
      $con = OpenCon();
      date_default_timezone_set('Asia/Kolkata');
	  $query_date = date('Y-m-d');
	  $start = date('Y-m-01', strtotime($query_date));
	  $month = date('m');
	  
	  $month = (int)$month;
	  $year = date('Y');
		// Last day of the month.
	  $end = date('Y-m-t', strtotime($query_date));
	  $start = '2022-03-01';
      $end = '2022-03-31';	  
	  $month = $_POST['month'];
	  $con = OpenCon();
	 // $sql = mysqli_query($con,"select SN,DVRIP,ATMID,SiteAddress from sites where live='Y'");
	 $sql = mysqli_query($con,"SELECT * FROM `dvr_health_site_monthwise_new` ORDER BY `id` DESC LIMIT 1");
	 
	 if(mysqli_num_rows($sql)){
		 $sql_result = mysqli_fetch_assoc($sql);
		 $last_month = $sql_result['month'];
		 $next_month = $last_month + 1;
		 
	 }
	 $month_name =  date("F", strtotime(date("Y") ."-". $next_month ."-01"));
	 //$month_array = array
	 $total_update = 0; $total_site = 0; $total_update_hr = 0;
	    $created_at = date('Y-m-d H:i:s');
		$site_sql = mysqli_query($con,"select SN,DVRIP,ATMID,SiteAddress,live_date from sites where live='Y'");
		if(mysqli_num_rows($site_sql)){
			$total_site = mysqli_num_rows($site_sql);
			while($fetch=mysqli_fetch_assoc($site_sql)){
				$siteaddress = $fetch['SiteAddress'];
				$SN = $fetch['SN'];
				$live_date = $fetch['live_date']; 
				if(mysqli_num_rows($sql)){
					$set_sql = "INSERT INTO `dvr_health_site_monthwise_new`( `SN`, `month`, `year`, `online_status_count`, `offline_status_count`, `online_percent`, `offline_percent`, `site_address`, `total_down_time`, `created_at`, `live_date`) VALUES ('".$SN."','".$month."','".$year."','0','0','0','0','".$siteaddress."','0','".$created_at."','".$live_date."') ";
					$set_result = mysqli_query($con,$set_sql);  
					if($set_result==1){
						$total_update = $total_update + 1;
					}
					
					$sethr_sql = "INSERT INTO `dvr_health_site_monthwise_hour_new`( `SN`, `month`, `year`, `online_status_count`, `offline_status_count`, `online_percent`, `offline_percent`, `site_address`, `total_down_time`, `created_at`, `live_date`) VALUES ('".$SN."','".$month."','".$year."','0','0','0','0','".$siteaddress."','0','".$created_at."','".$live_date."') ";
					$sethr_result = mysqli_query($con,$sethr_sql);  
					if($sethr_result==1){
						$total_update_hr = $total_update_hr + 1;
					}
				}		
			}	
		}	
      if($total_site==$total_update){
		  $msg = "Successfully Set in Penalty";
	  }else{
		  $msg = "Something Missing";
	  }		
	  $array = array(['code'=>200,'msg'=>$msg,'total_site'=>$total_site,'total_update'=>$total_update,'total_update_hr'=>$total_update_hr]);
	  CloseCon($con);
	  echo json_encode($array);
     ?>
	