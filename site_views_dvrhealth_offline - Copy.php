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

   $bank = "";
   $atmid = "";
if(isset($_GET['bank'])){
$bank = $_GET['bank'];
}
if(isset($_GET['atmid'])){
$atmid = $_GET['atmid'];
}
$con = OpenCon();

if($atmid!=''){
$sql = mysqli_query($con,"select status,atmid,last_communication,ip,cdate from dvr_health where atmid='".$atmid."' and login_status='1'"); 
}else{
	if($bank!=''){
	  $sitesql = mysqli_query($con,"select ATMID from sites where Customer='".$client."' and Bank='".$bank."' and live='Y'");
	}else{
		$sitesql = mysqli_query($con,"select ATMID from sites where Customer='".$client."' and Bank IN (".$_bank_name.") and live='Y'");
	}
	if(mysqli_num_rows($sitesql)){
	while($sitesql_result = mysqli_fetch_assoc($sitesql)){
		$atmidarray[] = $sitesql_result['ATMID'];
		//array_push($atmidarray,(string)$atmid);
	}
	}else{
		$atmidarray=[];
	}
	$atmidarray=json_encode($atmidarray);
	$atmidarray=str_replace( array('[',']','"') , ''  , $atmidarray);
	$arr=explode(',',$atmidarray);
	$atmidarray = "'" . implode ( "', '", $arr )."'";
	
	$offlinetestsql = "SELECT status,atmid,last_communication,ip,cdate FROM dvr_health WHERE atmid IN (".$atmidarray.") and login_status='1'";
    $sql = mysqli_query($con,$offlinetestsql);
}

?>


<div class="table-responsive">
                    <table id="order-listing2" class="table">
                      <thead>
                        <tr>
							<th>Sno.</th>
							<th>Site Name</th>
							<th>ATMID</th>
							<th>DVR IP</th>
							<th>DVR Status</th>
							<th>Last DVR Communication</th>
							<th>Duration</th>
							<th>Panel Status</th>
							<th>Last Panel Communication</th>
							<th>HDD Status</th>
													  
						</tr>
                      </thead>
                      <tbody>
					    <?php 
                        $count = 0 ; 
						  if(mysqli_num_rows($sql)>0){
							  while($sql_result = mysqli_fetch_assoc($sql)){ $count = $count + 1;
							       $hddstatus = 'InActive';
								   $hddclass = 'badge badge-pill badge-danger';
                                 if($sql_result['status']==1){
									 $hddstatus = 'Active';
									 $hddclass = 'badge badge-pill badge-success';
								 }
								 $site_atmid = $sql_result['atmid'];
								 $sitesqlres = mysqli_query($con,"select SiteAddress from sites where ATMID='".$site_atmid."' and live='Y'"); 
								 $site_sql_result = mysqli_fetch_assoc($sitesqlres);
								 $siteaddress = $site_sql_result['SiteAddress'];
								 
								 $panelsql = mysqli_query($con,"select status,date from panel_health where atmid='".$site_atmid."'"); 
								 $panel_status = '-';$panel_comm_date = '-';
								 if(mysqli_num_rows($panelsql)>0){
								 $panel_sql_result = mysqli_fetch_assoc($panelsql);
								 $panel_status = $panel_sql_result['status'];
								 $panel_comm_date = $panel_sql_result['date'];
								 }
								 $panelstatus = '-';$panelclass='';
								 if($panel_status==0){
									 $panelstatus = 'Online';
									 $panelclass = 'badge badge-pill badge-success';
								 }
								 if($panel_status==1){
									 $panelstatus = 'Offline';
									 $panelclass = 'badge badge-pill badge-danger';
								 }
								 
								     $datetime1 = $sql_result['cdate'];
									 $datetime2 = $sql_result['last_communication'];
									 $duration = "";
									 if(!is_null($datetime1) && !is_null($datetime2)){
									    $datetime1 = new DateTime($datetime1);
										$datetime2 = new DateTime($datetime2);
										$interval = $datetime1->diff($datetime2);
										
										$elapsedyear = $interval->format('%y');
										$elapsedmon = $interval->format('%m');
										$elapsed_day = $interval->format('%a');
										$elapsedhr = $interval->format('%h');
										$elapsedmin = $interval->format('%i');
										if($elapsedyear>0){
											$duration = $elapsedyear." year ";
										}
										if($elapsedmon>0){
											$duration = $duration.$elapsedmon." months ";
										}
										if($elapsed_day>0){
											$duration = $duration.$elapsed_day." days ";
										}
										if($elapsedhr>0){
											$duration = $duration.$elapsedhr." hours ";
										}
										if($elapsedmin>0){
											$duration = $duration.$elapsedmin." minutes ";
										}
										
									 }
							  ?>
							   <tr>
							    <td><?php echo $count;?></td>
                                <td><?php echo $siteaddress;?></td>  <td><?php echo $site_atmid;?></td>
								<td><?php echo $sql_result['ip'];?></td>
                                <td class="pr-0 text-right"><div class="badge badge-pill badge-danger"><?php echo 'Offline';?></div></td>
								<td><?php echo $sql_result['last_communication'];?></td>
								<td><?php echo $duration;?></td>
								<td><div class="<?php echo $panelclass;?>"><?php echo $panelstatus;?></div></td>
								<td><?php echo $panel_comm_date;?></td>
								<td><div class="<?php echo $hddclass;?>"><?php echo $hddstatus;?></div></td>
								</tr>
								
						<?php }
						  }
						?>
                      </tbody>
                    </table>
                  </div>

<?php
CloseCon($con);

?>

