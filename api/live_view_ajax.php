<?php include('db_connection.php'); ?>
<?php 
$client = $_POST['client'];
$bank = $_POST['bank'];
$atmid = $_POST['atmid'];
$con = OpenCon();
$sql = mysqli_query($con,"select * from sites where Customer='".$client."' and ATMID='".$atmid."' and Bank='".$bank."' and live='Y'");
$sql_result = mysqli_fetch_assoc($sql);
$sql_result['cam1'] = "Lobby Camera";
$sql_result['cam2'] = "Backroom Camera";
$sql_result['cam3'] = "Outdoor Camera";
$sql_result['cam4'] = "Lobby IP Camera";
CloseCon($con);
echo json_encode($sql_result);
?>


