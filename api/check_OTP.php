<?php 
include('db_connection.php'); 
$con = OpenCon(); 
date_default_timezone_set('Asia/Kolkata');
$user_id = $_POST['user_id'];
$date = date('Y-m-d H:i:s');
$otp=$_POST['otp']; 

$qr = mysqli_query($con,"SELECT id,otp_attempt,created_at,user_otp FROM login_user_otp where user_id='".$user_id."' and status=0 order by id desc limit 1");
$qrfetch=mysqli_fetch_array($qr);
$nrws=mysqli_num_rows($qr);
//echo $nrws;

if($nrws >0){
	$_id = $qrfetch['id'];
	$otp_attempt = $qrfetch['otp_attempt'];
	$user_otp = $qrfetch['user_otp'];
	if($otp_attempt>3){
		  $update_query = "UPDATE login_user_otp SET status='1' WHERE id='".$_id."'";
          $result=mysqli_query($con,$update_query);
		  $msg = "You have crossed 3 attempt. So try after sometime.";
		  $data=['Code'=> 201,'msg'=>$msg]; 
	}else{
	  if($user_otp==$otp){
		  $mydate= $qrfetch['created_at'];
		  $theDiff="";
		  //echo $mydate;//2014-06-06 21:35:55
		  $datetime1 = date_create($date);
		  $datetime2 = date_create($mydate);
		  $interval = date_diff($datetime1, $datetime2);
		  //echo $interval->format('%s Seconds %i Minutes %h Hours %d days %m Months %y Year    Ago')."<br>";
		  $min=$interval->format('%i');
		  $sec=$interval->format('%s');
		  $hour=$interval->format('%h');
		  $mon=$interval->format('%m');
		  $day=$interval->format('%d');
		  $year=$interval->format('%y');
		   
		   if($min<1){
			   $msg = "Submitted Successfully.";
	           $data=['Code'=> 200,'msg'=>$msg]; 
		   }else{
			   $msg = "OTP Expired.";
			   $data=['Code'=> 202,'msg'=>$msg];
		   }
		   $update_query = "UPDATE login_user_otp SET status='1' WHERE id='".$_id."'";
           $result=mysqli_query($con,$update_query);
	  }else{
		  $otp_attempt = $otp_attempt + 1;
		  $update_query = "UPDATE login_user_otp SET otp_attempt='".$otp_attempt."' WHERE id='".$_id."'";
          $result=mysqli_query($con,$update_query);
		  $msg = "Wrong OTP.";
	      $data=['Code'=> 203,'msg'=>$msg]; 
	  }
	}
}else{
	$msg = "No OTP Found";
	$data=['Code'=> 204,'msg'=>$msg]; 
	
}

CloseCon($con);
	
echo json_encode($data); 

?>

