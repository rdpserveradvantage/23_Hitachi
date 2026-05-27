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
$sql = mysqli_query($con,"select cam1,atmid,last_communication,ip,cdate from clouddvr_health where atmid='".$atmid."' and status='1'"); 

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
	
	$onlinetestsql = "SELECT cam1,atmid,last_communication,ip,cdate FROM clouddvr_health WHERE atmid IN (".$atmidarray.") and status='1'";
    $sql = mysqli_query($con,$onlinetestsql);
}

?>


<div class="table-responsive">
                    <table id="order-listing" class="table">
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
                            if(mysqli_num_rows($sql)>0){
							  $count = 0 ; 
							  while($sql_result = mysqli_fetch_assoc($sql)){
                                    $count = $count + 1;
							        
								 $site_atmid = $sql_result['atmid'];
								 $sitesqlres = mysqli_query($con,"select Address from dvronline where ATMID='".$site_atmid."' and Status='Y'"); 
								 $site_sql_result = mysqli_fetch_assoc($sitesqlres);
								 $siteaddress = $site_sql_result['Address'];
								 
							  ?>
							   <tr>
							    <td><?php echo $count;?></td>
                                <td><?php echo $siteaddress;?></td>  <td><?php echo $site_atmid;?></td>   
								<td><?php echo $sql_result['ip'];?></td>
                                 <td class="pr-0 text-right"><div class="badge badge-pill badge-success"><?php echo 'Online';?></div></td>
								 <td><?php echo $sql_result['cdate'];?></td>
								<td><?php echo $sql_result['last_communication'];?></td>
								<td><div class="badge badge-pill badge-success"><?php echo $sql_result['cam1'];?></div></td>
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

