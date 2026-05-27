<?php
include("db_connection.php");
//include($_SERVER['DOCUMENT_ROOT'].'/quiztest/api/functions.php');
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

//$json = json_decode($_POST);
//$uname = $json->uname;
//$password = $json->password;
$uname = $_POST['uname'];
$password =$_POST['password'];
$mac_id = "";
if(isset($_POST['mac_id'])){
$mac_id =$_POST['mac_id'];
}
$con = OpenCon();
$usersql = mysqli_query($con,"select * from loginusers where uname = '".$uname."'");
$usersql_result = mysqli_num_rows($usersql);
if($usersql_result>0){
	$userget_sql_result = mysqli_fetch_assoc($usersql);
	$is_change_pwd = $userget_sql_result['is_change_pwd'];
	if($is_change_pwd==0){
		$sql = mysqli_query($con,"select * from loginusers where uname = '".$uname."' and pwd='".$password."'");
        $sql_result = mysqli_num_rows($sql);
	}else{
		$md_pwd = md5($password);
		$sql = mysqli_query($con,"select * from loginusers where uname = '".$uname."' and pwd='".$md_pwd."'");
        $sql_result = mysqli_num_rows($sql);
	}
	if($sql_result>0){
		$get_sql_result = mysqli_fetch_assoc($sql);
		$id = $get_sql_result['id'];
		if($mac_id!=''){
			mysqli_query($con,"update loginusers set mac_id='".$mac_id."' where id = '".$id."'");
		}
		
		$name = $get_sql_result['name'];
		$uname  = $get_sql_result['uname'];
		$permission = $get_sql_result['permission'];
		$data=['Code'=> 200,'userid'=>$id,'name'=>$name,'uname'=>$uname,'permission'=>$permission,'is_change_pwd'=>$is_change_pwd];
		
			
	}
	else{
		$data=['Code'=> 201,'msg'=>'Incorrect Username or Password'];
	}
}else{
	   $data=['Code'=> 202,'msg'=>'Username does not exist'];
}

    CloseCon($con);
	
	echo json_encode($data); 


?>