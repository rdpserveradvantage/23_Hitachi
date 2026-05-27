<?php   
    include('db_connection.php'); 
	$con = OpenCon(); 
	date_default_timezone_set('Asia/Kolkata');
	$created_at = date('Y-m-d H:i:s');
	$oldpwd = $_POST['inputOldPassword'];
	$pwd = $_POST['inputPassword'];
	
	$user_id = $_POST['user_id'];
	$code = 0;
	$is_change = 0;
    $user_sql = "SELECT * FROM loginusers WHERE id = '".$user_id."'";
	$usersql = mysqli_query($con,$user_sql);
	if(mysqli_num_rows($usersql)>0){
	   $usersql_result = mysqli_fetch_assoc($usersql);
	   $is_change = $usersql_result['is_change_pwd'];
	   $current_pwd = $usersql_result['pwd'];
	   if($is_change==0){
		   if($current_pwd==$oldpwd){
			   $code = 0;
		   }else{
			  $code = 202; 
			  $msg = "Old Password not match with records. So unable to change password";
		   }
	   }else{
		   if(md5($oldpwd)==$current_pwd){
			  $code = 0; 
		   }else{
			  $code = 202; 
              $msg = "Old Password not match with records. So unable to change password";			  
		   }
	   }
	}else{
		$code = 201;
		$msg = "User not exists. So unable to change password";
	}
	
	if($code == 0){
		//$new_pwd = md5($pwd);
		$new_pwd = $pwd;
		$is_change = $is_change + 1;
		$update_query = "UPDATE loginusers SET pwd='".$new_pwd."',is_change_pwd='".$is_change."' WHERE id='".$user_id."'";
		$result=mysqli_query($con,$update_query);
		if($result==1){
			$code = 200;
			$msg = "Password has been changed successfully";
			$insert_sql="insert into change_password_details(user_id,pwd,old_pwd,created_at) values('".$user_id."','".$pwd."','".$oldpwd."','".$created_at."')";
			$insertresult=mysqli_query($con,$insert_sql) ;  
		}
	}
	
	
$array = array(['code'=>$code,'msg'=>$msg]);

CloseCon($con);
echo json_encode($array);
//echo json_encode($array);
?>