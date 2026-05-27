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
 $sql = mysqli_query($con,"select * from loginusers where uname = '".$uname."' and pwd='".$password."'");
 $sql_result = mysqli_num_rows($sql);

if($sql_result>0){
    $get_sql_result = mysqli_fetch_assoc($sql);
	$id = $get_sql_result['id'];
	if($mac_id!=''){
		mysqli_query($con,"update loginusers set mac_id='".$mac_id."' where id = '".$id."'");
	}
    
    $name = $get_sql_result['name'];
    $uname  = $get_sql_result['uname'];
    $permission = $get_sql_result['permission'];
    $data=['Code'=> 200,'userid'=>$id,'name'=>$name,'uname'=>$uname,'permission'=>$permission];
    CloseCon($con);
    echo json_encode($data);
        
}
else{
	CloseCon($con);
	$data=['Code'=> 201];
    echo json_encode($data);
}
?>