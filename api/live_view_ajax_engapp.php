<?php include('db_connection.php'); ?>
<?php 

$atmid = $_POST['atmid'];
$con = OpenCon();
$sql = mysqli_query($con,"select * from sites where ATMID='".$atmid."' and live='Y'");
if(mysqli_num_rows($sql)>0){
   $sql_result = mysqli_fetch_assoc($sql);
   $sql_result['cam1'] = "Lobby Camera";
   $sql_result['cam2'] = "Backroom Camera";
   $sql_result['cam3'] = "Outdoor Camera";
   $sql_result['cam4'] = "Lobby IP Camera";
   $array = array(['Code'=>200,'result'=>$sql_result]);
}else{
	$array = array(['Code'=>201]);
}
CloseCon($con);
echo json_encode($array);
?>


