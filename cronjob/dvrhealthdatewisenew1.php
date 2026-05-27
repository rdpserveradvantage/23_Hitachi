<?php  include('db_connection.php'); $con = OpenCon();
      date_default_timezone_set('Asia/Kolkata');
	  $query_date = date('Y-m-d');
	  $start = date('Y-m-01', strtotime($query_date));
	  $start = '2022-03-01';
	  $month = date('m');
	  
	  $month = (int)$month; $month = 3;
	  $year = date('Y');
		// Last day of the month.
		$end = date('Y-m-t', strtotime($query_date));
		$end = '2022-03-31';
		//$month_date = '2022-03-25';
		$created_at = date('Y-m-d H:i:s');
	  $sql = mysqli_query($con,"select SN,DVRIP,ATMID,SiteAddress from sites where live='Y' AND SN NOT IN (SELECT SN from dvr_health_site_datewise) limit 0,49");
	  if(mysqli_num_rows($sql)){
		while($sitesql_result = mysqli_fetch_assoc($sql)){
			$SN = $sitesql_result['SN']; $siteaddress = $sitesql_result['SiteAddress'];$ip = $sitesql_result['DVRIP'];
			        $data_array = array();
				    for($i=1;$i<=31;$i++){ 
						if($i<9){
							$dd = "0".$i;
						}else{
							$dd = $i;
						}
						$_query_date = $year."-".$month."-".$dd;
						$testsql = "SELECT id FROM network_history WHERE site_id ='".$SN."' AND CAST(rectime AS DATE)='".$_query_date."' 
									   AND status='OK' AND device='D'"; 
						
						$dvrhis_query = mysqli_query($con,$testsql); 
						$dvr_online_count = 0;
						$dvr_offline_count = 0;
						$total_online_percent = 0;
						$total_offline_percent = 0;
						$totaldvrconnect = mysqli_num_rows($dvrhis_query);   
								if (!$dvrhis_query || mysqli_num_rows($dvrhis_query) == 0){ 
								
								}else{
								   $dvr_online_count = 1;
								}		
						$data_arr = array();
                        $data_arr[$i]= $dvr_online_count;
                        array_push($data_array,$data_arr);						
					}   
                    $month_date_details ="";					
					if(count($data_array)>0){
						$month_date_details = json_encode($data_array);
					}	
					$checkmonthsql = mysqli_query($con,"select id from dvr_health_site_datewise where SN='".$SN."' and month='".$month."' and year='".$month."'");
					if (!$checkmonthsql || mysqli_num_rows($checkmonthsql) == 0){
					//if(mysqli_num_rows($checkmonthsql)==0){ 					
						
						$set_sql = "INSERT INTO `dvr_health_site_datewise`( `SN`, `month_date_details`, `month`, `year`, `created_at`) VALUES ('".$SN."','".$month_date_details."','".$month."','".$year."','".$created_at."') ";
						$set_result = mysqli_query($con,$set_sql); 
					}else{
						$monthsqlres = mysqli_fetch_assoc($checkmonthsql);
						$id = $monthsqlres['id'];
						$updatesql= " UPDATE `dvr_health_site_datewise` SET `month_date_details`='".$month_date_details."' where `id`='".$id."'";

						$month_result = mysqli_query($con,$updatesql);
					}
				          					
		}
		echo "Data Inserted Successfully";
	  }else{
		  echo 'All Data inserted Successfully';
	  }
	  CloseCon($con);
      /*
	  
	  for($i=1;$i<=31;$i++){
      if($month<10){
							$mon = "0".$month;
						}else{
							$mon = $month;
						}
						$query_date = $year."-".$mon."-01";
						//$query_date = '2010-02-04';

						// First day of the month.
						$start = date('Y-m-01', strtotime($query_date));

						// Last day of the month.
						$end = date('Y-m-t', strtotime($query_date));	  */