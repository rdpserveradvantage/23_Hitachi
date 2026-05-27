<?php session_start();
include('db_connection.php') ; 
 $con = OpenCon();
?>
<html>
    <head>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js" integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>        
    </head>
    <body>
        


<?php

date_default_timezone_set("Asia/Calcutta"); 
		$current_datetime = date('Y-m-d H:i:s');

$uname = $con->real_escape_string($_REQUEST['username']);
$password = $con->real_escape_string($_REQUEST['password']);

if($uname!='' && $password!=''){
   
    // echo "select * from login2 where username = '".$uname."' and password='".$password."'" ; 
    $sql = mysqli_query($con,"select * from loginusers where uname = '".$uname."' and pwd='".$password."'");
    $result = mysqli_num_rows($sql);
    if($result>0){
        $sql_result = mysqli_fetch_assoc($sql);
		$userid = $sql_result['id'];
		
		$set_sql = "INSERT INTO `user_activity_logs`( `user_id`,`activity_description`, `created_at`,`site_url`) VALUES ('".$userid."','login','".$current_datetime."','Hitachi') ";
		$set_result = mysqli_query($con,$set_sql);
		
		CloseCon($con); 
		$_SESSION['auth']=1;
        $_SESSION['username']=$sql_result['name'];
        $_SESSION['designation']=$sql_result['designation'];
        $_SESSION['userid'] = $sql_result['id'];
        
		
		$_SESSION['client'] = $sql_result['cust_id'];
		$_SESSION['bankname'] = $sql_result['bank_id'];
		$_SESSION['zonalname'] = $sql_result['zonal'];
		$_SESSION['circlename'] = $sql_result['circle_id'];
        $_SESSION['access']=0 ;
        if($uname == 'admin@gmail.com'){
            $_SESSION['access']=1 ;
        }
		$_SESSION["login_time_stamp"] = time();
         ?>
      <script>
	   
       swal("Great!", "Login Successfully !", "success");

           setTimeout(function(){ 
               window.location.href="home_dashboard.php";
           }, 3000);

       </script> 
        
    <?php }else{ CloseCon($con); ?>
       <script>
       swal("Oops", "Login Error !", "error");
           swal('Login error','Oops','error');
           setTimeout(function(){ 
              window.history.back();
           }, 3000);

       </script>
<?php }

    
    
}
else{ CloseCon($con); ?>
       <script>
       swal("Oops", "Please Put Username and Password  !", "error");
           swal('Error','Oops','Login Error');
           setTimeout(function(){ 
              window.history.back();
           }, 3000);

       </script>
<?php }

?>
    </body>
</html>