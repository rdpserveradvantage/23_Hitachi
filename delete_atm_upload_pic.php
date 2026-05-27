<?php
session_start();
include('db_connection.php');
$con = OpenCon();


 $deleteids_arr = array();

   if(isset($_POST['deleteids_arr'])){
      $deleteids_arr = $_POST['deleteids_arr'];
   }
   foreach($deleteids_arr as $deleteid){
	   $atm_sql = mysqli_query($con,"select link from atm_upload_images where id='".$deleteid."'");
	   $_del_data = mysqli_fetch_row($atm_sql);
	   $link = $_del_data[0];
	    $_del = mysqli_query($con,"DELETE FROM atm_upload_images WHERE id=".$deleteid);
		if($_del){
		   
		   $path = $_SERVER['DOCUMENT_ROOT'].'/ComfortTechnoNew/'.$link;
		   unlink($path);
		}
   }

   echo 1;
   exit;
   ?>
