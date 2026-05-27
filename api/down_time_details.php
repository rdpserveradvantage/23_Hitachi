<?php include('db_connection.php'); 
$con = OpenCon();
//$path ="C:\Users\css.WIN-IFIBER012\Desktop\Server_socket\New_Record";
$id = $_REQUEST['id'];
$sql = mysqli_query($con,"select down_time_history from dvr_health_site_monthwise where id='".$id."'");
$_data = array();
$count = 0; 
 if(mysqli_num_rows($sql)){
	 
	$sql_result = mysqli_fetch_assoc($sql);
	$down_time_history = json_decode($sql_result['down_time_history']);
	foreach($down_time_history as $down){
			$count = $count + 1; 
			$number = $down->diff_hours;
			$total_dwn_time = number_format((float)$number, 2, '.', '');
			$down_rectime = $down->down_rectime;
			$up_rectime = $down->up_rectime;
			$_data_arr = array();
			$_data_arr['total_dwn_time'] = $total_dwn_time;
			$_data_arr['down_rectime'] = $down_rectime;
			$_data_arr['up_rectime'] = $up_rectime;
			array_push($_data,$_data_arr);
  }
 }
$array = array(['res_data'=>$_data]);					
CloseCon($con);
echo json_encode($array);