<?php include('db_connection.php'); ?>
<?php 
$con = OpenCon();
$sql = mysqli_query($con,"select * from sub_menu where status=1");
$sql_result = mysqli_fetch_assoc($sql);
CloseCon($con);
echo json_encode($sql_result);
?>


