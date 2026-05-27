<?php include('db_connection.php'); ?>
<?php 
$query = "SELECT dvr_health.id,dvr_health.ip as ip,sites.DVRIP as dvrip FROM dvr_health INNER JOIN sites ON dvr_health.atmid = sites.ATMID AND sites.live='y' AND dvr_health.ip != sites.DVRIP";
$con = OpenCon();
$sql = mysqli_query($con,$query); 

						if(mysqli_num_rows($sql)>0){
							  while($sql_result = mysqli_fetch_assoc($sql)){ 
							    $ip = $sql_result['ip'];
								$dvrip = $sql_result['dvrip'];
								$id = $sql_result['id'];
								//echo $id."   ";
								$updatequery = "UPDATE dvr_health SET ip = '".$dvrip."' where id='".$id."'";
								$updatesql = mysqli_query($con,$updatequery);
						     }
						}
							   CloseCon($con); ?>
