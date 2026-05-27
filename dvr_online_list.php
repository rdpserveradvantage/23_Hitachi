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

$con = OpenCon();

if($atmid!=''){
	$sql = mysqli_query($con,"select NewPanelID,ATMID,SiteAddress from sites where atmid='".$atmid."' and live='Y'");
	
}else{
	if($bank!=''){
	  $sql = mysqli_query($con,"select NewPanelID,ATMID,SiteAddress from sites where Customer='".$client."' and Bank='".$bank."' and live='Y'");
	}else{
		$sql = mysqli_query($con,"select NewPanelID,ATMID,SiteAddress from sites where Customer='".$client."' and Bank IN (".$_bank_name.") and live='Y'");
	}
	/*
	while($sitesql_result = mysqli_fetch_assoc($sql)){
		$atmidarray[] = $sitesql_result['NewPanelID'];
		
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
													  <th>Resolved</th>
													  <th>UnResolved</th>
													</tr>
												  </thead>
												  <tbody>
												  <?php 
												     if(mysqli_num_rows($sql)){
															while($sitesql_result = mysqli_fetch_assoc($sql)){
																$panelid = $sitesql_result['NewPanelID'];
																$siteaddress = $sitesql_result['SiteAddress'];
																$alerts_sql = "SELECT id,status,sendtoclient FROM alerts WHERE panelid ='".$panelid."'"; 
																
																/*$testsql = "SELECT * FROM dvrcommunicationdetails_test WHERE DVRIP ='".$dvrip."' AND CAST(DVRConnectDatetime AS DATE)>='".$start."' 
                                                                           AND CAST(DVRConnectDatetime AS DATE)<='".$end."'"; */
																$dvrhis_query = mysqli_query($con,$alerts_sql); 
																$alert_resolved_count = 0;
																$alert_unresolved_count = 0;
                                                                $totaldvrconnect = mysqli_num_rows($dvrhis_query);   
																if(mysqli_num_rows($dvrhis_query)>0){
																	while($dvr_sql_result = mysqli_fetch_assoc($dvrhis_query)){
																		$status = $dvr_sql_result['status'];
																		$sendtoclient = $dvr_sql_result['sendtoclient'];
																		if (!empty($status)) {
																			
																			if ($status=='C' && $sendtoclient=='S') { 
																			   $alert_resolved_count = $alert_resolved_count + 1;
																			}
																			if ($status=='O' && $sendtoclient=='S') { 
																			   $alert_unresolved_count = $alert_unresolved_count + 1;
																			}
																		}
																		
																		
																	}
																	
																}
																
													    ?>		
													<tr>
													  <td><?php echo $siteaddress;?></td>
													  <td class="pr-0 text-right"><div class="badge badge-pill badge-success"><?php echo $alert_resolved_count;?></div></td>
													  <td class="pr-0 text-right"><div class="badge badge-pill badge-danger"><?php echo $alert_unresolved_count;?></div></td>
													  
													  
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


