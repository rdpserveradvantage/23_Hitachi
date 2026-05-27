<?php
include("db_connection.php");
//include($_SERVER['DOCUMENT_ROOT'].'/quiztest/api/functions.php');
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

//$json = json_decode($_POST);
//$uname = $json->uname;
//$password = $json->password;
$userid = $_POST['user_id'];

$con = OpenCon();
 $sql = mysqli_query($con,"select mac_id from loginusers where id = '".$userid."'");
 $sql_result = mysqli_num_rows($sql);

if($sql_result>0){
    $get_sql_result = mysqli_fetch_assoc($sql);
	$mac_id = $get_sql_result['mac_id'];
	
    $data=['Code'=> 200,'mac_id'=>$mac_id];
    CloseCon($con);
    echo json_encode($data);
        
}
else{
	CloseCon($con);
	$data=['Code'=> 201];
    echo json_encode($data);
}
?>