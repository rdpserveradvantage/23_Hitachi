<?php //include('config.php'); ?>
<?php session_start();include('db_connection.php'); 
      $con = OpenCon();
?>
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
		
		$_circle_name = "";
		$_circle_name_array = array();
		if($_SESSION['circlename']!=''){
		   $assign_circle = explode(",",$_SESSION['circlename']);
		   $_circle_name = [];
			for($i=0;$i<count($assign_circle);$i++){
			   $_circle = explode("_",$assign_circle[$i]);
			   array_push($_circle_name,$_circle[1]);
			} 
			//$_circle_name = $_circle_name_array;
			$_circle_name=json_encode($_circle_name);
			$_circle_name=str_replace( array('[',']','"') , ''  , $_circle_name);
			$circlearr=explode(',',$_circle_name);
			$_circle_name = "'" . implode ( "', '", $circlearr )."'";

			$site_circlesql = mysqli_query($con,"select ATMID from site_circle where Circle IN (".$_circle_name.")");	
			while($site_circlesql_result = mysqli_fetch_assoc($site_circlesql)){
					$_circle_name_array[] = $site_circlesql_result['ATMID'];
					
				}		
		}
		
		
$bank = $_GET['bank'];
$atmid = $_GET['atmid'];
$dvrstatus = $_GET['status'];
$camera_cond = "NOT";
if($dvrstatus=='0'){
	$camera_cond = "WORKING";
}
$circle = "";
if(isset($_GET['circle'])){
$circle = $_GET['circle'];
}
if($dvrstatus=='1'){
	$camera_cond = "NOT";
}


if($atmid!=''){
	$sitesql = mysqli_query($con,"select * from dvr_health where atmid='".$atmid."'");
}else{
	if($bank!=''){
		if($circle!=''){
				$circlesql = mysqli_query($con,"select ATMID from site_circle where Circle='".$circle."'");
				$circleatmidarray = [];
				while($circlesql_result = mysqli_fetch_assoc($circlesql)){
					$circleatmidarray[] = $circlesql_result['ATMID'];
					
				}
				$circleatmidarray=json_encode($circleatmidarray);
				$circleatmidarray=str_replace( array('[',']','"') , ''  , $circleatmidarray);
				$circlearr=explode(',',$circleatmidarray);
				$circleatmidarray = "'" . implode ( "', '", $circlearr )."'";
				$sitesql = mysqli_query($con,"select ATMID from sites where Customer='".$client."' and Bank='".$bank."' and ATMID IN (".$circleatmidarray.") and live='Y'");
		}else{ 
			$sitesql = mysqli_query($con,"select ATMID from sites where Customer='".$client."' and Bank='".$bank."' and live='Y'");	
		} 
	   // $sitesql = mysqli_query($con,"select ATMID from sites where Customer='".$client."' and Bank='".$bank."' and live='Y'");
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
			  <th style="width:65%;">Site Name</th><th>ATMID</th>
			  <th>Camera No.</th>
			  <th>Last Communication</th>
			  <th>Last Scanned</th>
			</tr>
		  </thead>
		  <tbody>
<?php
if(mysqli_num_rows($sql)){
	while($sql_result = mysqli_fetch_assoc($sql)){
		$_atm_id = $sql_result['atmid'];
		$_login_status = $sql_result['login_status'];
		$_is_atmid_exist = 0;
		if($_SESSION['access']==1){
			$_is_atmid_exist = 1;
		}else{
			if (in_array($_atm_id, $_circle_name_array)){
				$_is_atmid_exist = 1;
			}
		}
		if($_is_atmid_exist == 1){
		    if($_login_status=='0'){
				$sites_sql = mysqli_query($con,"select NewPanelID,ATMID,SiteAddress,Customer,Bank from sites where atmid='".$_atm_id."' and live='Y'");
				$sitesql_result = mysqli_fetch_assoc($sites_sql);
				$siteaddress = $sitesql_result['SiteAddress'];
				$last_communication = $sql_result['last_communication'];
				$cdate = $sql_result['cdate'];
				$camera4_not = 0;
				
					$_customer = $sitesql_result['Customer'];
					$cust_bank = $sitesql_result['Bank'];
					if($_customer=='Hitachi' && $cust_bank=='BOI'){
						$camera4_not = 1;
					}
				
				/*
				if($sql_result['login_status']=='0'){
					$dvr_online_count = $dvr_online_count + 1;
				}else{
					$dvr_offline_count = $dvr_offline_count + 1;
				}
				
				if(strtoupper($sql_result['cam1'])=='WORKING'){
					$camera_working_count = $camera_working_count + 1;
				}else{
					$camera_notworking_count = $camera_notworking_count + 1;
				}
				
				if(strtoupper($sql_result['cam2'])=='WORKING'){
					$camera_working_count = $camera_working_count + 1;
				}else{
					$camera_notworking_count = $camera_notworking_count + 1;
				}
				
				if(strtoupper($sql_result['cam3'])=='WORKING'){
					$camera_working_count = $camera_working_count + 1;
				}else{
					$camera_notworking_count = $camera_notworking_count + 1;
				}
				
				if(strtoupper($sql_result['cam4'])=='WORKING'){
					$camera_working_count = $camera_working_count + 1;
				}else{
					$camera_notworking_count = $camera_notworking_count + 1;
				}
				
						
				if($sql_result['status']==1){ 
				   if($sql_result['login_status']==1){ 
					  $hdd_fail_count = $hdd_fail_count + 1;
				   }
				} */
				
				for($i=1;$i<=4;$i++){
					$camera_no = 'cam'.$i;
					$not_add_view = 0;
					if($camera4_not==1 && $i==4){
						$not_add_view = 1;
					}
					
					if(strtoupper($sql_result[$camera_no])=='WORKING' && $dvrstatus=='0'){
						if($not_add_view==0){
						
				?>
						<tr>
						  <td><?php echo $siteaddress;?></td><td><?php echo $_atm_id;?></td>
						  <td><?php echo $i;?></td>
						  <td class="pr-0 text-right"><div class="badge badge-pill badge-success"><?php echo $last_communication;?></div></td>
						  <td class="pr-0 text-right"><div class="badge badge-pill badge-danger"><?php echo $cdate;?></div></td>
						  
						  
						</tr>
					<?php	}}
					
					if(strtoupper($sql_result[$camera_no])!='WORKING' && $dvrstatus=='1'){ 
						if($not_add_view==0 && $_login_status==0){
					?>	
						 <tr>
						  <td><?php echo $siteaddress;?></td><td><?php echo $_atm_id;?></td>
						  <td><?php echo $i;?></td>
						  <td class="pr-0 text-right"><div class="badge badge-pill badge-success"><?php echo $last_communication;?></div></td>
						  <td class="pr-0 text-right"><div class="badge badge-pill badge-danger"><?php echo $cdate;?></div></td>
						  
						  
						</tr> 
				
					<?php } }
				}
			}		
    
	    } 
	}
}
?>
	
  </tbody>
</table>
<?php
CloseCon($con);

?>


