<?php include('db_connection.php'); ?>
<?php 

$con = OpenCon();
$sql = mysqli_query($con,"select * from panel_health_api_response where atmid=''");
if(mysqli_num_rows($sql)>0){
	while($sqlresult = mysqli_fetch_assoc($sql)){
		$panel_name = $sqlresult['panel_name'];
		$id = $sqlresult['id'];
		$split = explode('_',$panel_name);
		$atm_id = $split[0];
		//echo $atm_id;die;
		$updatesql = mysqli_query($con,"update panel_health_api_response set atmid='".$atm_id."' where id='".$id."'");
	}
}

CloseCon($con);
//echo $sql;
?>


