<?php 
include('config.php');
include('db_connection.php'); 

function startsWith ($string, $startString){
    $len = strlen($startString);
    return (substr($string, 0, $len) === $startString);
}

function getPanelName($atmid){
	global $con;
	//$con = OpenCon();
	$sql = mysqli_query($con,"select Panel_Make from sites where ATMID='".$atmid."'");
	$sql_result = mysqli_fetch_assoc($sql);
	//CloseCon($con);
	return $sql_result['Panel_Make'];
}


function getrass($zone,$atmid){
	global $con;
	//$con = OpenCon();
	$panel_name = getPanelName($atmid,$con);
	 $sql = "";
	 $paramater = 'SensorName';
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
}

function getrassstatus($paramater,$atmid){
	global $con;
  //  $con = OpenCon();
	$sql = mysqli_query($con,"select $paramater from panel_health where atmid='".$atmid."'");
	$sql_result = mysqli_fetch_assoc($sql);
	//CloseCon($con);
	return $sql_result[$paramater];
}



$atmid = $_GET['atmid'];
//$con = OpenCon();
$sql = mysqli_query($con,"select * from panel_health where atmid='".$atmid."' and status=0");
if(mysqli_num_rows($sql)>0){
$sql_result = mysqli_fetch_assoc($sql);
?>

							<div class="row">
								<div class="col-12">
								 
											<?php $countclass = 0;
											$count = 1 ; 
											
											foreach($sql_result as $key=>$value){
												if(startsWith ($key, 'zon')){ 
												    preg_match_all('!\d+!', $key, $matches);
															$intkey = $matches[0][0];
															if($intkey < 10 ){
																$intkey = '00'.$intkey ;
															}else if($intkey < 100){
																$intkey = '0'.$intkey ;
															}
												?>
												<?php 
												  $class = "";
												if(getrassstatus($key,$atmid,$con)=='0'){ $class = "class='badge badge-success badge-pill mb-2'" ; }
																elseif(getrassstatus($key,$atmid)=='1'){ $class= 'class="badge badge-danger badge-pill mb-2"'; }
																elseif(getrassstatus($key,$atmid)=='2'){ $class= 'class="badge badge-warning badge-pill mb-2"'; }
																elseif(getrassstatus($key,$atmid)=='9'){ $class= 'class="badge badge-info badge-pill mb-2"' ; }
														        else{ $class= 'class="badge badge-primary badge-pill mb-2"' ; }
															?>
													    <?php if($class!=""){ $countclass++;?>
													    <button <?php echo $class;?>><?php echo getrass($intkey,$atmid); ?></button>
														<?php }?>
														
													
											<?php $count++;	}
											}
											if($countclass==0){echo 'No Alerts Found';}


											 ?>
										
								</div>
							  </div>
							
<?php }else{ ?>
	                        <div class="row">
								<div class="col-12">
								    No Data Found
								</div>
							</div>	
<?php }

CloseCon($con);?>