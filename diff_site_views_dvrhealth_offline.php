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
$con = OpenComsarmiCon();

if($atmid!=''){
$sql = mysqli_query($con,"select cam1,atmid,last_communication,ip,cdate from clouddvr_health where atmid='".$atmid."' and status='0'"); 
}else{
	if($bank!=''){
	  $sitesql = mysqli_query($con,"select ATMID from dvronline where customer='".$client."' and Bank='".$bank."' and Status='Y'");
	}else{
		$sitesql = mysqli_query($con,"select ATMID from dvronline where customer='".$client."' and Bank IN (".$_bank_name.") and Status='Y'");
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
	
	$offlinetestsql = "SELECT cam1,atmid,last_communication,ip,cdate FROM clouddvr_health WHERE atmid IN (".$atmidarray.") and status='0'";
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
							<th>Communication Date</th>
							<th>Last DVR Communication</th>
							<th>Camera Status</th>
													  
						</tr>
                      </thead>
                      <tbody>
					    <?php 
                        $count = 0 ; 
						  if(mysqli_num_rows($sql)>0){
							  while($sql_result = mysqli_fetch_assoc($sql)){ $count = $count + 1;
							      
								 $site_atmid = $sql_result['atmid'];
								 $sitesqlres = mysqli_query($con,"select Address from dvronline where ATMID='".$site_atmid."' and Status='Y'"); 
								 $site_sql_result = mysqli_fetch_assoc($sitesqlres);
								 $siteaddress = $site_sql_result['Address'];
								 
								 
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
								<td><?php echo $sql_result['cdate'];?></td>
								<td><?php echo $sql_result['last_communication'];?></td>
								<!--<td><?php// echo $duration;?></td>-->
								<td><div class="badge badge-pill badge-danger"><?php echo 'Not working';?></div></td>
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

