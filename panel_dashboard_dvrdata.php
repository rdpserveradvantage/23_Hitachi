<?php //include('config.php'); ?>
<?php include('db_connection.php'); ?>
<?php 


$client = $_POST['client'];
$atmid = $_POST['atmid'];
$con = OpenCon();
$sql = mysqli_query($con,"select * from dvr_health where atmid='".$atmid."'");
$sql_result = mysqli_fetch_assoc($sql);
CloseCon($con);
echo json_encode($sql_result);
?>


