<?php  include('db_connection.php'); $con = OpenCon();
      date_default_timezone_set('Asia/Kolkata');
	  $query_date = date('Y-m-d');
	  $start = date('Y-m-01', strtotime($query_date));
	  $month = date('m');
	  
	  $month = (int)$month;
	  $year = date('Y');
		// Last day of the month.
		$end = date('Y-m-t', strtotime($query_date));
		//echo $start."--".$end;die;
	  $sql = mysqli_query($con,"select SN,DVRIP,ATMID,SiteAddress from sites where live='Y'");
	  if(mysqli_num_rows($sql)){
		while($sitesql_result = mysqli_fetch_assoc($sql)){
			$SN = $sitesql_result['SN']; $siteaddress = $sitesql_result['SiteAddress'];$ip = $sitesql_result['DVRIP'];
			$testsql = "SELECT status FROM network_history WHERE site_id ='".$SN."' AND CAST(rectime AS DATE)>='".$start."' 
								   AND CAST(rectime AS DATE)<='".$end."' AND device='D'"; 
			
						$dvrhis_query = mysqli_query($con,$testsql); 
						$dvr_online_count = 0;
						$dvr_offline_count = 0;
						$total_online_percent = 0;
						$total_offline_percent = 0;
					if (!$dvrhis_query || mysqli_num_rows($dvrhis_query) == 0){
						
					}else{
						$totaldvrconnect = mysqli_num_rows($dvrhis_query);   
						if(mysqli_num_rows($dvrhis_query)>0){
							while($dvr_sql_result = mysqli_fetch_assoc($dvrhis_query)){
								$dvr_status = $dvr_sql_result['status'];
								if (!empty($dvr_status)) {
									if ($dvr_status == 'OK') { 
									   $dvr_online_count = $dvr_online_count + 1;
									}else{
									   $dvr_offline_count = $dvr_offline_count + 1;
									}
								}
								else{
									$dvr_offline_count = $dvr_offline_count + 1;
								}
								
							}
							//$totaldvrconnect = $totaldvrconnect + $dvr_online_count + $dvr_offline_count;
							$number = ($dvr_online_count/$totaldvrconnect)*100;
							//$dvr_offline_count = $totaldvrconnect - $dvr_online_count;
							$offnumber = ($dvr_offline_count/$totaldvrconnect)*100;
							$total_online_percent = number_format((float)$number, 2, '.', '');
							$total_offline_percent = number_format((float)$offnumber, 2, '.', '');
						}
		            }
					$checkmonthsql = mysqli_query($con,"select id from dvr_health_site_monthwise where SN='".$SN."' and month='".$month."' and year='".$year."'");
					if (!$checkmonthsql || mysqli_num_rows($checkmonthsql) == 0){
                   // if(mysqli_num_rows($checkmonthsql)==0){ 					
						$created_at = date('Y-m-d H:i:s');
						$set_sql = "INSERT INTO `dvr_health_site_monthwise`( `SN`, `month`, `year`, `online_status_count`, `offline_status_count`, `online_percent`, `offline_percent`, `site_address`, `created_at`) VALUES ('".$SN."','".$month."','".$year."','".$dvr_online_count."','".$dvr_offline_count."','".$total_online_percent."','".$total_offline_percent."','".$siteaddress."','".$created_at."') ";
						$set_result = mysqli_query($con,$set_sql); 
					}else{
						$monthsqlres = mysqli_fetch_assoc($checkmonthsql);
						$id = $monthsqlres['id'];
						$updatesql= " UPDATE `dvr_health_site_monthwise` SET `online_status_count`='".$dvr_online_count."',`offline_status_count`='".$dvr_offline_count."',`online_percent`='".$total_online_percent."',`offline_percent`='".$total_offline_percent."' where `id`='".$id."'";

                        $month_result = mysqli_query($con,$updatesql);
					}
		}
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