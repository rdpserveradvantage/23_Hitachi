<?php //include('config.php'); ?>
<?php session_start();include('db_connection.php'); ?>
<?php 
date_default_timezone_set('Asia/Kolkata');

$client = $_GET['client'];
	   
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
		
$bank = $_GET['bank'];
$atmid = $_GET['atmid'];
$month = $_GET['month'];
$year = $_GET['year'];
$query_date = $year."-".$month."-01";
//$query_date = '2010-02-04';

// First day of the month.
$start = date('Y-m-01', strtotime($query_date));

// Last day of the month.
$end = date('Y-m-t', strtotime($query_date));

$con = OpenCon();

if($atmid!=''){
	$sql = mysqli_query($con,"select SN,DVRIP,ATMID,SiteAddress from sites where atmid='".$atmid."' and live='Y'");
	
}else{
	if($bank!=''){
	  $sql = mysqli_query($con,"select SN,DVRIP,ATMID,SiteAddress from sites where Customer='".$client."' and Bank='".$bank."' and live='Y'");
	}else{
		$sql = mysqli_query($con,"select SN,DVRIP,ATMID,SiteAddress from sites where Customer='".$client."' and Bank IN (".$_bank_name.") and live='Y'");
	}
	/*
	while($sitesql_result = mysqli_fetch_assoc($sitesql)){
		$atmidarray[] = $sitesql_result['DVRIP'];
		
	}
	$atmidarray=json_encode($atmidarray);
	$atmidarray=str_replace( array('[',']','"') , ''  , $atmidarray);
	$arr=explode(',',$atmidarray);
	$atmidarray = "'" . implode ( "', '", $arr )."'";
	
	$testsql = "SELECT * FROM dvrcommunicationdetails_test WHERE DVRIP IN (".$atmidarray.")";
    $sql = mysqli_query($con,$sitesql); */
} 
?>

                                            
												<table class="table" id="order-listing" >
												  <thead>
													<tr>
													  <th style="width:65%;">Site Name</th>
													  <th>Online %</th>
													  
													</tr>
												  </thead>
												  <tbody>
												  <?php 
												     if(mysqli_num_rows($sql)){
															while($sitesql_result = mysqli_fetch_assoc($sql)){
																$SN = $sitesql_result['SN'];
																$dvrip = $sitesql_result['DVRIP'];
																$siteaddress = $sitesql_result['SiteAddress'];
																/*
																$testsql = "SELECT count(ip) as total FROM dvr_history WHERE ip ='".$dvrip."' AND CAST(cdate AS DATE)>='".$start."' 
                                                                           AND CAST(cdate AS DATE)<='".$end."' AND last_communication IS NOT NULL AND cdate IS NOT NULL"; 
																		   
																$testnotsql = "SELECT count(ip) as total_not FROM dvr_history WHERE ip ='".$dvrip."' AND CAST(cdate AS DATE)>='".$start."' 
                                                                           AND CAST(cdate AS DATE)<='".$end."' AND last_communication IS NOT NULL AND cdate IS NOT NULL AND cdate!=last_communication"; 

                                                                $dvrhis_total = mysqli_query($con,$testsql); 
                                                                $dvrhis_notequal = mysqli_query($con,$testnotsql); 
																$dvr_offline_count = 0;
                                                                if(mysqli_num_rows($dvrhis_total)>0){  
                                                                $dvr_sql_result_total = mysqli_fetch_assoc($dvrhis_total);
																$totaldvrconnect = $dvr_sql_result_total['total'];
																}
																if(mysqli_num_rows($dvrhis_notequal)>0){ 
                                                                $dvr_sql_result_notequal = mysqli_fetch_assoc($dvrhis_notequal);
																$dvr_offline_count = $dvr_sql_result_notequal['total_not'];	
																}
																$dvr_online_count = 0;
																$total_online_percent = 0;
                                                                
                                                                if($totaldvrconnect>0){	
                                                                $dvr_online_count =  $totaldvrconnect - $dvr_offline_count;	
																$number = ($dvr_online_count/$totaldvrconnect)*100;
																	$total_online_percent = number_format((float)$number, 2, '.', '');
																}
                                                                	*/															
																
																$testsql = "SELECT cdate,last_communication FROM dvr_history WHERE ip ='".$dvrip."' AND CAST(cdate AS DATE)>='".$start."' 
                                                                           AND CAST(cdate AS DATE)<='".$end."' AND last_communication IS NOT NULL AND cdate IS NOT NULL"; 
																
																$dvrhis_query = mysqli_query($con,$testsql); 
																$dvr_online_count = 0;
																$dvr_offline_count = 0;
																$total_online_percent = 0;
																$total_offline_percent = 0;
                                                                $totaldvrconnect = mysqli_num_rows($dvrhis_query);   
																if(mysqli_num_rows($dvrhis_query)>0){
																	while($dvr_sql_result = mysqli_fetch_assoc($dvrhis_query)){
																		$connect_time = $dvr_sql_result['cdate'];
																		$last_com_time = $dvr_sql_result['last_communication'];
																		if (!empty($connect_time) && !empty($last_com_time)) {
																			$d1 = new DateTime($connect_time);
																			$d2 = new DateTime($last_com_time);
																			if ($d1 == $d2) { 
																			   $dvr_online_count = $dvr_online_count + 1;
																			}else{
																			   $dvr_offline_count = $dvr_offline_count + 1;
																			}
																		}
																		
																		
																	}
																	$number = ($dvr_online_count/$totaldvrconnect)*100;
																	$dvr_offline_count = $totaldvrconnect - $dvr_online_count;
																	$offnumber = ($dvr_offline_count/$totaldvrconnect)*100;
																	$total_online_percent = number_format((float)$number, 2, '.', '');
																	$total_offline_percent = number_format((float)$offnumber, 2, '.', '');
																}
																/*
																$created_at = date('Y-m-d H:i:s');
																$set_sql = "INSERT INTO `dvr_health_site_monthwise`( `SN`, `month`, `year`, `online_status_count`, `offline_status_count`, `online_percent`, `offline_percent`, `site_address`, `created_at`) VALUES ('".$SN."','".$month."','".$year."','".$dvr_online_count."','".$dvr_offline_count."','".$total_online_percent."','".$total_offline_percent."','".$siteaddress."','".$created_at."') ";
                                                                $set_result = mysqli_query($con,$set_sql);
																
																*/
																if($total_online_percent<90){
																	$progress_color = "bg-danger";
																}else{
																	$progress_color = "bg-success";
																}
																if($total_online_percent==0 || $total_online_percent==0.00){
																	$widthpercent = 100;
																}else{
																	$widthpercent = $total_online_percent;
																}
													    ?>		
													<tr>
													  <td><?php echo $siteaddress;?></td>
													  <td>
														  <div class="progress progress-lg mt-2">
														  <div class="progress-bar <?php echo $progress_color;?>" role="progressbar" style="width: <?php echo $widthpercent;?>%" aria-valuenow="<?php echo $total_online_percent;?>" aria-valuemin="0" aria-valuemax="100"><?php echo $total_online_percent;?>%</div>
														  </div>
													  </td>
													  
													</tr>
													<?php	
														    }
														}
													  
													  ?>
													
												  </tbody>
												</table>
											  
										 
<?php



CloseCon($con);

?>


