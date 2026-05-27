<?php //include('config.php'); ?>
<?php session_start();include('db_connection.php'); ?>
<?php 
						date_default_timezone_set('Asia/Kolkata');

						$client = $_POST['client'];
	   
       $banks = explode(",",$_SESSION['bankname']);
       $_bank_name = [];
       for($i=0;$i<count($banks);$i++){
		   $_bank = explode("_",$banks[$i]);
		   if($_bank[0]==$client){
			   array_push($_bank_name,$_bank[1]);
		   }
	   } 
	    $_bank_name=json_encode($_bank_name);
		$_bank_name=str_replace( array('[',']','"') , ''  , $_bank_name);
		$bankarr=explode(',',$_bank_name);
		$_bank_name = "'" . implode ( "', '", $bankarr )."'";
		
						$bank = $_POST['bank'];
						$atmid = $_POST['atmid'];
						$month = $_POST['month'];
						$year = $_POST['year'];
						$circle = $_POST['circle'];
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
						$end = date('Y-m-t', strtotime($query_date));

						$con = OpenCon();

						if($atmid!=''){
							$sql = mysqli_query($con,"select SN,DVRIP,ATMID,SiteAddress from sites where atmid='".$atmid."' and live='Y'");
							$sitesql_result = mysqli_fetch_assoc($sql);
							$dvrip = $sitesql_result['SN'];
						}else{
							if($bank!=''){
								if($circle!=''){
									$circlesql = mysqli_query($con,"select ATMID from site_circle where Circle='".$circle."'");
									while($circlesql_result = mysqli_fetch_assoc($circlesql)){
										$circleatmidarray[] = $circlesql_result['ATMID'];
										
									}
									$circleatmidarray=json_encode($circleatmidarray);
									$circleatmidarray=str_replace( array('[',']','"') , ''  , $circleatmidarray);
									$circlearr=explode(',',$circleatmidarray);
									$circleatmidarray = "'" . implode ( "', '", $circlearr )."'";
									$sql = mysqli_query($con,"select ATMID,SN,SiteAddress,DVRIP,PanelIP,RouterIp from sites where Customer='".$client."' and Bank='".$bank."' and ATMID IN (".$circleatmidarray.") and live='Y'");	
								}else{
							  $sql = mysqli_query($con,"select ATMID,SN,SiteAddress,DVRIP,PanelIP,RouterIp from sites where Customer='".$client."' and Bank='".$bank."' and live='Y'");
								}
							  
							}else{
								$sql = mysqli_query($con,"select SN,DVRIP,ATMID,SiteAddress from sites where Customer='".$client."' and Bank IN (".$_bank_name.") and live='Y'");
							}
							if(mysqli_num_rows($sql)>0){
							while($sitesql_result = mysqli_fetch_assoc($sql)){
								if(!is_null($sitesql_result['SN'])){
									if($sitesql_result['SN']!=''){
									  $atmidarray[] = $sitesql_result['SN'];
									}
								}
							}
							}else{
								$atmidarray = [];
							}
							$atmidarray=json_encode($atmidarray);
							$atmidarray=str_replace( array('[',']','"') , ''  , $atmidarray);
							$arr=explode(',',$atmidarray);
							$atmidarray = "'" . implode ( "', '", $arr )."'";
							/*
							$testsql = "SELECT * FROM dvrcommunicationdetails_test WHERE DVRIP IN (".$atmidarray.")";
							$sql = mysqli_query($con,$sitesql); */
						}
                    $main_actual_arr = [];
						for($i=1;$i<=31;$i++){
								if($i<9){
									$dd = "0".$i;
								}else{
									$dd = $i;
								}
								$query_date = $year."-".$month."-".$dd;
								
								// First day of the month.
								$start = $query_date;

								// Last day of the month.
								$end = $query_date;
								if($atmid!=''){ 
								    $testsql = "SELECT online_status_count,offline_status_count,online_percent FROM dvr_health_site_datewise WHERE SN ='".$dvrip."' AND month_date='".$query_date."'"; 
								}else{
									$testsql = "SELECT online_status_count,offline_status_count,online_percent FROM dvr_health_site_datewise WHERE SN IN (".$atmidarray.") AND month_date='".$query_date."'"; 
								}
											
								$dvrhis_query = mysqli_query($con,$testsql); 
								$dvr_online_count = 0;
								$dvr_offline_count = 0;
								$total_online_percent = 0;
								$totaldvrconnect = mysqli_num_rows($dvrhis_query);   
								if(mysqli_num_rows($dvrhis_query)>0){
									$unique_dvrip = array();
									while($dvr_sql_result = mysqli_fetch_assoc($dvrhis_query)){
										$dvr_online_count = $dvr_online_count + $dvr_sql_result['online_status_count'];
										$dvr_offline_count = $dvr_offline_count + $dvr_sql_result['offline_status_count'];
									}
									$totaldvrconnect = $dvr_online_count + $dvr_offline_count;
									$number = ($dvr_online_count/$totaldvrconnect)*100;
									$total_online_percent = number_format((float)$number, 2, '.', '');
								}
								$j = $i - 1;
							$dvronlinearray[$j] = $dvr_online_count;
							$dvrofflinearray[$j] = $dvr_offline_count;
							$_status_online_percent[$j] = $total_online_percent; 
							$actual_arr['y'] = strval($i);
							$actual_arr['a'] = $dvr_online_count;	
							$actual_arr['b'] = $dvr_offline_count;	
                            $main_actual_arr[$j] = $actual_arr; 							
						}
											
										
$array = array(['dvr_online_count'=>$dvronlinearray,'dvr_offline_count'=>$dvrofflinearray,'resdata'=>$main_actual_arr,'online_percent'=>$_status_online_percent,'test_sql'=>$testsql]);
CloseCon($con);
echo json_encode($array);
?>


