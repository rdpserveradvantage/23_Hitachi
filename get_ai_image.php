<?php include('db_connection.php'); 
$src="";

//$path ="C:\Users\css.WIN-IFIBER012\Desktop\Server_socket\New_Record";
if(isset($_POST['submit'])){ echo '1';
	$con = OpenCon();
$ticket_id = $_REQUEST['id'];
$sql = mysqli_query($con,"select File_loc from ai_alerts_alive where id='".$ticket_id."'");
if(mysqli_num_rows($sql)>0){
	$sql_result = mysqli_fetch_assoc($sql);
	$file = $sql_result['File_loc'];
//$path = str_replace("./","",$date);
$src = 'data: jpeg;base64,'.$file; 
}else{
	$src="";
}
CloseCon($con);
}
		 ?>
		 <form action="<?php echo $_SERVER["PHP_SELF"];?>" method="post">
		 <input type="text" name="id">
		 <input type="submit" name="submit" value="submit">
		 </form>
		 <?php if($src!=""){?>
<a href="<?php echo $src;  ?>" download>
<img src="<?php echo $src;  ?>" alt="" style="object-fit: contain;"></a>
		 <?php } ?>


