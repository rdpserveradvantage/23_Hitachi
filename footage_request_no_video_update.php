<?php   include('db_connection.php');
        $con = OpenCon();
        $total_get = 0;
        if(isset($_GET["id"])){
		        $id = $_GET["id"];
				$total_get = $total_get + 1;
        	}
		if($total_get==1 && $id>0){
			$footage_avail = 'No';
	        $update_query = "UPDATE footage_request SET footage_avail='".$footage_avail."',is_checked=1,is_available=1 WHERE id='".$id."'";
			$result=mysqli_query($con,$update_query);
			if($result==1){
				echo 'Footage Not Available Status Updated Successfully';
			}
		}
		CloseCon($con);
        ?>