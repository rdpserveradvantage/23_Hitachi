<?php //include('config.php'); ?>
<?php include('db_connection.php'); ?>
<?php 

$bank = $_POST['bank'];
$atmid = $_POST['atmid'];

$con = OpenCon();

$sql = mysqli_query($con,"select * from sites where ATMID='".$atmid."' and Bank='".$bank."'");
$sql_result = mysqli_fetch_assoc($sql);

CloseCon($con);

echo json_encode($sql_result);
?>


