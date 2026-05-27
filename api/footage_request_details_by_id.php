<?php include('db_connection.php'); ?>
<?php 
$id = $_POST['id'];
$con = OpenCon();
$sql = mysqli_query($con,"select * from footage_request where id='".$id."'"); 
$_resultdata = mysqli_fetch_assoc($sql); 
CloseCon($con);
echo json_encode($_resultdata);
?>


