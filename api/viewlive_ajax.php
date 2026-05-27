<?php include('db_connection.php'); ?>
<?php 
$client = $_POST['client'];
$bank = $_POST['bank'];
$atmid = $_POST['atmid'];
$con = OpenCon();
$sql = mysqli_query($con,"select * from dvronline where customer='".$client."' and ATMID='".$atmid."' and Bank='".$bank."' and Status='Y'");
$sql_result = mysqli_fetch_assoc($sql);
CloseCon($con);
echo json_encode($sql_result);
?>


