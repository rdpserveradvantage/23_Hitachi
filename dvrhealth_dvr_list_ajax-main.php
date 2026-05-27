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
		
$bank = $_GET['bank'];
$atmid = $_GET['atmid'];
$dvrstatus = $_GET['status'];
if($dvrstatus==0){
	//$_status = 1;
}
$con = OpenCon();

if($atmid!=''){   // and login_status='".$dvrstatus."'
	$sql = mysqli_query($con,"select * from dvr_health where atmid='".$atmid."'");
}else{
	if($bank!=''){
	    $sitesql = mysqli_query($con,"select ATMID from sites where Customer='".$client."' and Bank='".$bank."' and live='Y'");
	}else{
		$sitesql = mysqli_query($con,"select ATMID from sites where Customer='".$client."' and Bank IN (".$_bank_name.") and live='Y'");
	}
	//$atmidarray = [];
	while($sitesql_result = mysqli_fetch_assoc($sitesql)){
		$atmidarray[] = $sitesql_result['ATMID'];
		//array_push($atmidarray,(string)$atmid);
	}
	$atmidarray=json_encode($atmidarray);
	$atmidarray=str_replace( array('[',']','"') , ''  , $atmidarray);
	$arr=explode(',',$atmidarray);
	$atmidarray = "'" . implode ( "', '", $arr )."'";
	
	$testsql = "SELECT * FROM dvr_health WHERE atmid IN (".$atmidarray.")";
    $sql = mysqli_query($con,$testsql);
}
$dvr_online_count = 0;
$dvr_offline_count = 0;

$camera_working_count = 0;
$camera_notworking_count = 0;
$hdd_fail_count = 0;
?>

        <table class="table table-striped" id="order-listing" >
		  <thead>
			<tr>
			  <th style="width:65%;">Site Name</th>
			  <th>ATMID</th>
			  <th>Last Communication</th>
			  <th>Last Scanned</th>
			</tr>
		  </thead>
		  <tbody>
<?php
if(mysqli_num_rows($sql)){
	while($sql_result = mysqli_fetch_assoc($sql)){
		$_atm_id = $sql_result['atmid'];
		$sites_sql = mysqli_query($con,"select NewPanelID,ATMID,SiteAddress from sites where atmid='".$_atm_id."' and live='Y'");
		$sitesql_result = mysqli_fetch_assoc($sites_sql);
		$siteaddress = $sitesql_result['SiteAddress'];
		$last_communication = $sql_result['last_communication'];
		$cdate = $sql_result['cdate'];
		
		$login_status = $sql_result['login_status'];
		$_status = $sql_result['status'];
		$_view = 0;
		if($dvrstatus==$login_status){
			$_view = 1;
		}
		
		
		if($_view==1){
		
		?>
	            <tr>
				  <td><?php echo $siteaddress;?></td><td><?php echo $_atm_id;?></td>
				  <td class="pr-0 text-right"><div class="badge badge-pill badge-success"><?php echo $last_communication;?></div></td>
				  <td class="pr-0 text-right"><div class="badge badge-pill badge-danger"><?php echo $cdate;?></div></td>
				  
				  
				</tr>
		<?php	}
						}
					}
				  
				  ?>
				
			  </tbody>
			</table>
<?php
CloseCon($con);

?>


