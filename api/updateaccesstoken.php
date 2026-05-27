<?php include('db_connection.php'); ?>
<?php 
$access_token = $_POST['access_token'];

$con = OpenCon();
$sql = mysqli_query($con,"update ems_login_access set access_token='".$access_token."' where id=1");
CloseCon($con);
echo $sql;
?>


