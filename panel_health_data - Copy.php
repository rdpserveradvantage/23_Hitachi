<?php include('db_connection.php');?>
<?php 

function startsWith ($string, $startString){
    $len = strlen($startString);
    return (substr($string, 0, $len) === $startString);
}

function getPanelName($atmid){
	//global $con;
	$con = OpenCon();
	$sql = mysqli_query($con,"select Panel_Make from sites where ATMID='".$atmid."'");
	$sql_result = mysqli_fetch_assoc($sql);
	CloseCon($con);
	return $sql_result['Panel_Make'];
}

function getrass($zone,$paramater,$atmid){
	//global $con;
	$con = OpenCon();
	$panel_name = getPanelName($atmid);
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
	}
	if(mysqli_num_rows($sql)>0){
	   $sql_result = mysqli_fetch_assoc($sql);
	   $return_data = $sql_result[$paramater];
	}else{
		$return_data = '-';
	}
    CloseCon($con);
	return $return_data;
}
/*
function getrass($zone){
	global $con;

	$sql = mysqli_query($con,"select * from rass_cloudnew where ZONE='".$zone."'");
	$sql_result = mysqli_fetch_assoc($sql);

	return $sql_result['SensorName'];
}
*/
function getrassstatus($paramater,$atmid){
	//global $con;
    $con = OpenCon();
	$sql = mysqli_query($con,"select $paramater from panel_health where atmid='".$atmid."'");
	if(mysqli_num_rows($sql)>0){
	   $sql_result = mysqli_fetch_assoc($sql);
	   $return_data = $sql_result[$paramater];
	}else{
		$return_data = "";
	}
	CloseCon($con);
	return $return_data;
}
$client = $_GET['client'];
$bank = $_GET['bank'];
$atmid = $_GET['atmid'];
$con = OpenCon();
if($atmid!=''){
	$sql = mysqli_query($con,"select * from panel_health where atmid='".$atmid."'");
}else{
	$sitesql = mysqli_query($con,"select ATMID from sites where Customer='".$client."' and Bank='".$bank."'");
	//$atmidarray = [];
	while($sitesql_result = mysqli_fetch_assoc($sitesql)){
		$atmidarray[] = $sitesql_result['ATMID'];
		//array_push($atmidarray,(string)$atmid);
	}
	$atmidarray=json_encode($atmidarray);
	$atmidarray=str_replace( array('[',']','"') , ''  , $atmidarray);
	$arr=explode(',',$atmidarray);
	$atmidarray = "'" . implode ( "', '", $arr )."'";
	//echo '<pre>';print_r($atmidarray);echo '</pre>';
	//$atmidarray = implode(",",$atmidarray);
	//echo $atmidarray;
	//$testsql = "SELECT * FROM panel_health WHERE atmid IN (".implode(',',$atmidarray).")";
	/*$testsql = "SELECT * FROM panel_health WHERE atmid IN ('" 
     . implode("','", array_map('mysqli_real_escape_string', $atmidarray)) 
     . "')"; */
	//echo $testsql;
	$testsql = "SELECT * FROM panel_health WHERE atmid IN (".$atmidarray.")";
    $sql = mysqli_query($con,$testsql);
}
$sql_result = mysqli_fetch_assoc($sql);

?>

                                <div class="table-responsive">
									<table id="order-listing" class="table">
									  <thead>
										<tr>
											<th>ATMID</th><th>Action</th>
											<?php
											$count = 1 ; 
											$zonheading = [];
											//echo '<pre>';print_r($sql_result);echo '';die;
											 foreach($sql_result as $key=>$value){
												if(startsWith ($key, 'zon')){ 
												     $zonheading[] = $key;
															preg_match_all('!\d+!', $key, $matches);
															$intkey = $matches[0][0];
															if($intkey < 10 ){
																$intkey = '00'.$intkey ;
															}else if($intkey < 100){
																$intkey = '0'.$intkey ;
															}
															//echo $intkey."</br>";
															//if($intkey!='997' || $intkey!='998'){
													?>
													 <th id="thid<?php echo $count;?>"><?php echo $key; ?></th>
													 
												<?php	$count++; } 
											}


											 ?>
										</tr>
									  </thead>
									  <tbody>
									  <?php if(mysqli_num_rows($sql)>0){ 
									           while($atm_sql_result = mysqli_fetch_array($sql)){
												   $atmid = $atm_sql_result['atmid'];
									  ?>
										<tr>
											<td><?php echo $atmid;?></td><td><a href="add_ticket.php?alarmtype=0&atmid=<?php echo $atmid;?>" target="_blank">Ticket Raise</a></td>
											<?php 
											$count = 1 ; 
											for($i=0;$i<count($zonheading);$i++){
												$key = $zonheading[$i];
											//foreach($sql_result as $key=>$value){
												if(startsWith ($key, 'zon')){
                                                    preg_match_all('!\d+!', $key, $matches);
															$intkey = $matches[0][0];
															if($intkey < 10 ){
																$intkey = '00'.$intkey ;
															}else if($intkey < 100){
																$intkey = '0'.$intkey ;
															}
													?>
													 <td id="tdid<?php echo $count;?>">
														<p style="text-align:center;"><?php echo getrass($intkey,'SensorName',$atmid); ?></p>
														<p 
														<?php
														   if($atm_sql_result[$key]=='0'){ echo "class='paneltime green'" ; }
															elseif($atm_sql_result[$key]=='1'){ echo 'class="paneltime red"'; }
															elseif($atm_sql_result[$key]=='2'){ echo 'class="paneltime white"'; }
															elseif($atm_sql_result[$key]=='9'){ echo 'class="paneltime orchid"' ; }
															else{ echo 'class="paneltime "' ;} ?>
														 >
														 <?php echo $atm_sql_result[$key];?>
															<?php //echo getrassstatus($key,$atmid); ?></p>
													 </td>
											<?php $count++;	}
											}
											?>
										</tr>
									  <?php }}?>
									  </tbody>
									</table>
								  </div>

<?php CloseCon($con);?>
