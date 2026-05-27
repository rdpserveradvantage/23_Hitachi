<?php include('db_connection.php');
      $dt = $_POST['dt']; 
	  $footage_type = $_POST['footage_type'];					
      $con = OpenCon();
				 
    $getimagesql = "SELECT * FROM `footage_details_available_start_zip_test` WHERE footage_status=0 AND dt='".$dt."' AND footage_type='".$footage_type."'"; 
    //echo $getimagesql;
    $getimagesdata = mysqli_query($con,$getimagesql);
    echo mysqli_num_rows($getimagesdata);
?>



