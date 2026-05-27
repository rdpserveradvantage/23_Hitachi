<?php 
include('db_connection.php');
$con = OpenCon();
$id = $_POST['id'];
$sql = mysqli_query($con,"select * from ticket_raise_history where ticket_raise_id='".$id."'");
$res_data = [];
   if(mysqli_num_rows($sql)>0){
	 while($sql_result = mysqli_fetch_assoc($sql)){
	   $id = $sql_result['id'];											 
	   if($sql_result['ticket_status']==1){
		   $ticket_status = "Active";
	   }
	   if($sql_result['ticket_status']==0){
		   $ticket_status = "Close";
	   }
	   $_newarr = array();

		$_newarr['created_date'] = $sql_result['created_date'];
		$_newarr['close_date'] = $sql_result['close_date'];
		$_newarr['created_by'] = $sql_result['created_by'];
		$_newarr['remarks'] = $sql_result['remarks'];
		
		array_push($res_data,$_newarr);
   }} 
   
   if(count($res_data)>0){
	$array = array(['Code'=>200,'res_data'=>$res_data]);
}else{
	$array = array(['Code'=>201]);
}


CloseCon($con);
echo json_encode($array);
   
   ?>
									 