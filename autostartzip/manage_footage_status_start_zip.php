<?php
    include('db_connection.php');

	$con = OpenCon();
    $footage_type = 0;
    $check_footage = "SELECT * FROM `footage_details_available_start_zip` WHERE footage_status='".$footage_type."'";
	$check_footage_res = mysqli_query($con, $check_footage);
	//echo mysqli_num_rows($check_footage_res);
	if(mysqli_num_rows($check_footage_res)==0){
		$updatecheck_footage = "SELECT * FROM `footage_details_available_start_zip` WHERE footage_status='6' order by id DESC limit 1" ;
	    $updatecheck_footage_res = mysqli_query($con, $updatecheck_footage);
		//echo mysqli_num_rows($updatecheck_footage_res);die;
		if(mysqli_num_rows($updatecheck_footage_res)){
		   $fetch_data = mysqli_fetch_assoc($updatecheck_footage_res);
		   $footage_id = $fetch_data['id'];
		   $update_footage_qry = "UPDATE footage_details_available_start_zip SET footage_status=0 where id='".$footage_id."'";
		   $update_foot = mysqli_query($con, $update_footage_qry);
		}
	}
		CloseCon($con);
?>
