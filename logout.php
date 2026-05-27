<?php
 session_start();
 
 include('db_connection.php') ; 
 $con = OpenCon();
 
 date_default_timezone_set("Asia/Calcutta"); 
 $current_datetime = date('Y-m-d H:i:s');
 
        $userid = $_SESSION['userid'];
		
		$set_sql = "INSERT INTO `user_activity_logs`( `user_id`,`activity_description`, `created_at`,`site_url`) VALUES ('".$userid."','logout','".$current_datetime."','Hitachi') ";
		$set_result = mysqli_query($con,$set_sql); 
		
		CloseCon($con);

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Log Out</title>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js" integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>        
</head>
<body>
    <?php
	
	session_destroy();
	?>
</body>
<script>
 swal("", "Logout Successfully !", "success");
                  setTimeout(function(){ 
               window.location.href="login.php";
           }, 3000);  
</script>  
</html>
        

