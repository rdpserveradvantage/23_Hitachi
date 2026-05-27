<?php //include('config.php'); ?>
<?php session_start();include('db_connection.php'); ?>
<?php 
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
		
date_default_timezone_set('Asia/Kolkata');


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
	$sql = mysqli_query($con,"select DVRIP,ATMID,SiteAddress from sites where atmid='".$atmid."' and live='Y'");
	$sitesql_result = mysqli_fetch_assoc($sql);
	$dvrip = $sitesql_result['DVRIP'];
}else{
	if($bank!=''){
	  $sql = mysqli_query($con,"select DVRIP,ATMID,SiteAddress from sites where Customer='".$client."' and Bank='".$bank."' and live='Y'");
	}else{
		$sql = mysqli_query($con,"select DVRIP,ATMID,SiteAddress from sites where Customer='".$client."' and Bank IN (".$_bank_name.") and live='Y'");
	}
	
	while($sitesql_result = mysqli_fetch_assoc($sql)){
		$atmidarray[] = $sitesql_result['DVRIP'];
		
	}
	$atmidarray=json_encode($atmidarray);
	$atmidarray=str_replace( array('[',']','"') , ''  , $atmidarray);
	$arr=explode(',',$atmidarray);
	$atmidarray = "'" . implode ( "', '", $arr )."'";
	/*
	$testsql = "SELECT * FROM dvrcommunicationdetails_test WHERE DVRIP IN (".$atmidarray.")";
    $sql = mysqli_query($con,$sitesql); */
}
 
?>
    <table class="table table-bordered" width="100%">
                                      <thead>
                                          <th>Panel Status</th>
										  <?php 
										    $_dvr_online = array();
											$_status_online = array();
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
												    $testsql = "SELECT cdate,last_communication FROM dvr_history WHERE ip ='".$dvrip."' AND CAST(cdate AS DATE)>='".$start."' 
                                                                           AND CAST(cdate AS DATE)<='".$end."' AND last_communication IS NOT NULL AND cdate IS NOT NULL"; 
													}else{
														$testsql = "SELECT cdate,last_communication FROM dvr_history WHERE ip IN (".$atmidarray.") AND CAST(cdate AS DATE)>='".$start."' 
                                                                           AND CAST(cdate AS DATE)<='".$end."' AND last_communication IS NOT NULL AND cdate IS NOT NULL"; 
													}
																
													$dvrhis_query = mysqli_query($con,$testsql); 
													$dvr_online_count = 0;
													$total_online_percent = 0;
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
																}
															}
															
															
														}
														$number = ($dvr_online_count/$totaldvrconnect)*100;
														$total_online_percent = number_format((float)$number, 2, '.', '');
													}
													$_dvr_online[$i-1] = $dvr_online_count;
													$_status_online[$i-1] = $total_online_percent; 
											?>
												<th><?php echo $i;?></th>
										  <?php	}
										  ?>
                                          
                                      </thead>
                                     <tbody>
                                        <tr>
                                            <td class="text-success"><b>Online</b></td>
											<?php for($i=1;$i<=31;$i++){
												    
												?>
											     <td><?php echo $_dvr_online[$i-1];?></td>
											<?php }?>
                                            
                                        </tr>
                                        <tr>
                                           <td>Status (%)</td> 
                                            <?php for($i=1;$i<=31;$i++){
												    
												?>
											     <td><?php echo $_status_online[$i-1];?></td>
											<?php }?>
                                        </tr>
                                        </tbody>
                                  </table>
                                            
											  
										 
<?php

CloseCon($con);

?>


