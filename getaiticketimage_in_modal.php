<?php include('db_connection.php'); 
$con = OpenCon();

//$path ="C:\Users\css.WIN-IFIBER012\Desktop\Server_socket\New_Record";
$ticket_id = $_REQUEST['date'];
$sql = mysqli_query($con,"select File_loc from ai_alerts where id='".$ticket_id."'");
if(mysqli_num_rows($sql)>0){
	$sql_result = mysqli_fetch_assoc($sql);
	$file = $sql_result['File_loc'];
//$path = str_replace("./","",$date);
$src = 'data: jpeg;base64,'.$file; 
}else{
	$src="";
}
CloseCon($con);
		 ?>

<img src="<?php echo $src;  ?>" alt="" style="object-fit: contain;">


