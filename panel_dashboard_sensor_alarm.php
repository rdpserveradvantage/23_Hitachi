<?php //include('config.php'); ?>
<?php include('db_connection.php'); ?>
<?php 

function startsWith ($string, $startString){
    $len = strlen($startString);
    return (substr($string, 0, $len) === $startString);
}

function getPanelName($atmid,$con){
	//global $con;
	//$con = OpenCon();
	$sql = mysqli_query($con,"select Panel_Make from sites where ATMID='".$atmid."'");
	$sql_result = mysqli_fetch_assoc($sql);
	//CloseCon($con);
	return $sql_result['Panel_Make'];
}

function getrass($zone,$paramater,$atmid,$con){
	//global $con;
	//$con = OpenCon();
	$panel_name = getPanelName($atmid,$con);
	/*
	if($panel_name=='RASS'){
		$sql = mysqli_query($con,"select $paramater from rass where ZONE='".$zone."'");
	}
    if($panel_name=='rass_cloud'){
		$sql = mysqli_query($con,"select $paramater from rass_cloud where ZONE='".$zone."'");
	}
	if($panel_name=='rass_cloudnew'){
		$sql = mysqli_query($con,"select $paramater from rass_cloudnew where ZONE='".$zone."'");
	}
	if($panel_name=='rass_sbi'){
		$sql = mysqli_query($con,"select $paramater from rass_sbi where ZONE='".$zone."'");
	}
	if($panel_name=='SEC'){
		$sql = mysqli_query($con,"select $paramater from securico where ZONE='".$zone."'");
	}
	if($panel_name=='securico_gx4816'){
		$sql = mysqli_query($con,"select $paramater from securico_gx4816 where ZONE='".$zone."'");
	}
	if($panel_name=='sec_sbi'){
		$sql = mysqli_query($con,"select $paramater from sec_sbi where ZONE='".$zone."'");
	}
	if($panel_name=='Raxx'){
		$sql = mysqli_query($con,"select $paramater from raxx where ZONE='".$zone."'");
	}
	if($panel_name=='SMART -I'){
		$sql = mysqli_query($con,"select $paramater from smarti where ZONE='".$zone."'");
	}
	if($panel_name=='SMART-IN'){
		$sql = mysqli_query($con,"select $paramater from smartinew where ZONE='".$zone."'");
	}  */
	                $sql = "";
	                        if($panel_name=='comfort'){
								$sql = mysqli_query($con,"select $paramater from comfort where ZONE='".$zone."'");
							}
							if($panel_name=='rass_boi'){
								$sql = mysqli_query($con,"select $paramater from rass_boi where ZONE='".$zone."'");
							}
							if($panel_name=='rass_pnb'){
								$sql = mysqli_query($con,"select $paramater from rass_pnb where ZONE='".$zone."'");
							}
							if($panel_name=='smarti_boi'){
								$sql = mysqli_query($con,"select $paramater from smarti_boi where ZONE='".$zone."'");
							}
							if($panel_name=='smarti_pnb'){
								$sql = mysqli_query($con,"select $paramater from smarti_pnb where ZONE='".$zone."'");
							}
							if($panel_name=='RASS'){
								$sql = mysqli_query($con,"select $paramater from rass where ZONE='".$zone."' AND status=0");
							}
							if($panel_name=='rass_cloud'){
								$sql = mysqli_query($con,"select $paramater from rass_cloud where ZONE='".$zone."' AND status=0");
							}
							if($panel_name=='rass_cloudnew'){
								$sql = mysqli_query($con,"select $paramater from rass_cloudnew where ZONE='".$zone."' AND status=0");
							}
							if($panel_name=='rass_sbi'){
								$sql = mysqli_query($con,"select $paramater from rass_sbi where ZONE='".$zone."' AND status=0");
							}
							if($panel_name=='SEC'){
								$sql = mysqli_query($con,"select $paramater from securico where ZONE='".$zone."' AND status=0");
							}
							if($panel_name=='securico_gx4816'){
								$sql = mysqli_query($con,"select $paramater from securico_gx4816 where ZONE='".$zone."' AND status=0");
							}
							if($panel_name=='sec_sbi'){
								$sql = mysqli_query($con,"select $paramater from sec_sbi where ZONE='".$zone."' AND status=0");
							}
							if($panel_name=='Raxx'){
								$sql = mysqli_query($con,"select $paramater from raxx where ZONE='".$zone."' AND status=0");
							}
							if($panel_name=='SMART -I'){
								$sql = mysqli_query($con,"select $paramater from smarti where ZONE='".$zone."' AND status=0");
							}
							if($panel_name=='SMART-IN'){
								$sql = mysqli_query($con,"select $paramater from smartinew where ZONE='".$zone."' AND status=0");
							}
	if($sql==""){
		$return = "";
	    return $return;
	}else{						
		if(mysqli_num_rows($sql)>0){						
		
		$sql_result = mysqli_fetch_assoc($sql);
		return $sql_result[$paramater];
		}else{
			$return = "";
			return $return;
		}
	}
  //  CloseCon($con);
	
}
/*
function getrass($zone,$paramater){
	global $con;
	$sql = mysqli_query($con,"select * from rass_cloudnew where ZONE='".$zone."'");
	
	$sql_result = mysqli_fetch_assoc($sql);
  
	return $sql_result[$paramater];
}*/

function getrassstatus($paramater,$con){
	//global $con;
  //  $con = OpenCon();
	$sql = mysqli_query($con,"select $paramater from panel_health where atmid='B1088910'");
	$sql_result = mysqli_fetch_assoc($sql);
//	CloseCon($con);
	return $sql_result[$paramater];
}
$bank = $_GET['bank'];
$client = $_GET['client'];
$atmid = $_GET['atmid'];
$con = OpenCon();
$sites_sql = mysqli_query($con,"select * from sites where ATMID='".$atmid."' and Bank='".$bank."' and Customer='".$client."'");
$sites_sql_result = mysqli_fetch_assoc($sites_sql);
$panelid = $sites_sql_result['NewPanelID'];

$sql = mysqli_query($con,"SELECT * FROM `alerts` WHERE panelid='".$panelid."' GROUP BY alarm ORDER BY id DESC limit 5");
?>

            <div class="table-responsive">
				<table id="order-listing" class="table">
				  <thead>
					<tr>
						<th>SrNo</th><th>Alarm Type</th><th>Alarm Code</th>
						
					</tr>
				  </thead>
				  <tbody>
				      	            <?php  
									   if(mysqli_num_rows($sql)>0){
										   $srno = 0;
									     while($sql_result = mysqli_fetch_assoc($sql)){
											 $srno = $srno + 1;
                                           $zone = $sql_result['zone'];		
                                           $alarm = $sql_result['alarm'];												   
									       
									 ?>
						                <tr>
											<td><?php echo $srno;?></td><td><?php echo getrass($zone,'SensorName',$atmid,$con);?></td><td><?php echo $alarm;?></td>
											
										</tr>
										
									<?php }} ?>			  

				  </tbody>
				</table>
			  </div>

<?php CloseCon($con); ?>
