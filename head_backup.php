<?php session_start();
    function isLoginSessionExpired() {
		$login_session_duration = 10; 
		$current_time = time(); 
		if(isset($_SESSION['loggedin_time']) and isset($_SESSION["user_id"])){  
			if(((time() - $_SESSION['loggedin_time']) > $login_session_duration)){ 
				return true; 
			} 
		}
		return false;
	}
    if(!isset($_SESSION['login_time_stamp'])){
		session_unset();
			session_destroy(); ?>
			
	        <script>
				window.location.href="login.php";
			</script>
	 <?php	
	}else{
        if (time() - $_SESSION["login_time_stamp"] > 900) {
			session_unset();
			session_destroy(); ?>
			
	        <script>
				window.location.href="login.php";
			</script>
	 <?php	} 
	 }
	 
   /* if (empty($_SERVER['HTTPS']) || $_SERVER['HTTPS'] === "off") {
		$location = 'https://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
		header('HTTP/1.1 301 Moved Permanently');
		header('Location: ' . $location);
		exit;
	} */

include("db_connection.php");
?>
<head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
            <meta content="width=device-width, initial-scale=1, shrink-to-fit=no" name="viewport">
                <title>
                    Comfort Techno Services Pvt Ltd - <?=$_SESSION['username']?>
                </title>
                <!-- plugins:css -->
                <link href="vendors/iconfonts/font-awesome/css/all.min.css" rel="stylesheet">
                    <link href="vendors/css/vendor.bundle.base.css" rel="stylesheet">
                        <link href="vendors/css/vendor.bundle.addons.css" rel="stylesheet">
                            <!-- endinject -->
                            <!-- plugin css for this page -->
                            <!-- End plugin css for this page -->
                            <!-- inject:css -->
							<link rel="stylesheet" href="vendors/lightgallery/css/lightgallery.css">
                            <link href="css/style.css" rel="stylesheet">
                                <!-- endinject -->
                               <!-- <link href="media/comfort.ico" rel="shortcut icon"/>-->
                                <link rel="shortcut icon" href="images/favicon.png">
                            </link>
                        </link>
                    </link>
                </link>
				<style>
				.content-wrapper{padding: 5.5rem 1.7rem !important;}
				</style>
				<!--<link href="sweetalert/sweetalert.css" rel="stylesheet">-->
                <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js" integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>      
            </meta>
        </meta>
    </head>