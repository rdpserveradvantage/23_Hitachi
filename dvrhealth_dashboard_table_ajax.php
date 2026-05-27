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
$circle = $_GET['circle'];
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
	$sql = mysqli_query($con,"select s.SN,s.DVRIP,s.ATMID,s.SiteAddress,d.online_percent,d.offline_percent from sites s,dvr_health_site_monthwise d where s.SN=d.SN and d.month='".$month."' and d.year='".$year."' and s.atmid='".$atmid."' and s.live='Y' order by d.online_percent desc");
	
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
		    $sql = mysqli_query($con,"select s.SN,s.DVRIP,s.ATMID,s.SiteAddress,d.online_percent,d.offline_percent from sites s,dvr_health_site_monthwise d where s.SN=d.SN and d.month='".$month."' and d.year='".$year."' and s.Customer='".$client."' and s.Bank='".$bank."' and s.ATMID IN (".$circleatmidarray.") and s.live='Y' order by d.online_percent desc");	
		}else{
	  $sql = mysqli_query($con,"select s.SN,s.DVRIP,s.ATMID,s.SiteAddress,d.online_percent,d.offline_percent from sites s,dvr_health_site_monthwise d where s.SN=d.SN and d.month='".$month."' and d.year='".$year."' and s.Customer='".$client."' and s.Bank='".$bank."' and s.live='Y' order by d.online_percent desc");
		}
	 
	}else{
		$sql = mysqli_query($con,"select s.SN,s.DVRIP,s.ATMID,s.SiteAddress,d.online_percent,d.offline_percent from sites s,dvr_health_site_monthwise d where s.SN=d.SN and d.month='".$month."' and d.year='".$year."' and s.Customer='".$client."' and s.Bank IN (".$_bank_name.") and s.live='Y' order by d.online_percent desc");
	}
	
} 
?>

                                            
												<table class="table" id="order-listing" >
												  <thead>
													<tr>
													  <th>ATMID</th>
													  <th style="width:65%;">Site Name</th>
													  <th>Online %</th>
													  
													</tr>
												  </thead>
												  <tbody>
												  <?php 
												     if(mysqli_num_rows($sql)){
															while($sitesql_result = mysqli_fetch_assoc($sql)){
																$ATMID = $sitesql_result['ATMID'];
																$SN = $sitesql_result['SN'];
																$dvrip = $sitesql_result['DVRIP'];
																$siteaddress = $sitesql_result['SiteAddress'];
																
                                                               	$online_percent = $sitesql_result['online_percent'];
																$offline_percent = $sitesql_result['offline_percent'];
																$total_online_percent = $online_percent;
																
																if($total_online_percent<50){
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
													  <td><?php echo $ATMID;?></td> 
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


