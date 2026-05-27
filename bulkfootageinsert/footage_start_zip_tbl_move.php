<?php
        include('db_connection.php');$con = OpenCon();
        $mon = 'July';
		
		$check_footage = "SELECT * FROM `footage_details_available` WHERE month='".$mon."'";
		$check_footage_res = mysqli_query($con, $check_footage);
		$cnt = 0;
		if(mysqli_num_rows($check_footage_res)>0){
			while($foot_data = mysqli_fetch_assoc($check_footage_res)){
				
				$dt = $foot_data['dt'];
				$_atmid_imageval = $foot_data['atmid'];
				$footage_type = $foot_data['footage_type'];
				$check_footage_avail = "SELECT * FROM `footage_details_available_start_zip` WHERE month='".$mon."' AND dt='".$dt."' AND atmid='".$_atmid_imageval."' AND footage_type='".$footage_type."'";
		        $check_footage_avail_res = mysqli_query($con, $check_footage_avail);
				if(mysqli_num_rows($check_footage_avail_res)==0){
					$created_at = $foot_data['created_at'];
					$updated_at = $foot_data['updated_at'];
					
					$remarks = "";
					$ftp_server_path = "Footage_Upload/".$footage_type.'/'.$mon.'/'.$dt.'/'.$_atmid_imageval;
					$local_path = $footage_type.'/'.$mon.'/'.$dt.'/'.$_atmid_imageval;
					$local_path = str_replace("/","\\\\",$local_path);
						
					//$local_file_array = json_encode($imagesdata_array);
					$remarks = "";
					$set_sql = "INSERT INTO `footage_details_available_start_zip`( `month`, `dt`,`atmid`, `created_at`, `updated_at`, `created_by`, `footage_type`, `footage_status`, `ftp_server_path`, `local_path`, `remarks`) VALUES ('".$mon."','".$dt."','".$_atmid_imageval."','".$created_at."','".$updated_at."','24','".$footage_type."','1','".$ftp_server_path."','".$local_path."','".$remarks."') ";
					$set_result = mysqli_query($con,$set_sql); 	
					$cnt = $cnt + 1;
				}
			}
			
		}
		
		CloseCon($con);
		echo $cnt;
		
?>
