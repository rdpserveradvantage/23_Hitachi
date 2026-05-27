<?php  include('db_connection.php'); $con = OpenCon();
    	  
	   $total_updated = 0;
	   // SELECT id,receivedtime FROM `ai_alerts` WHERE CAST(createtime AS DATE)='2022-05-30' AND DATE_FORMAT(createtime, '%k')<='16' AND status='O'
	  $sql = mysqli_query($con,"SELECT id,receivedtime FROM `ai_alerts` WHERE status='O'");
	  if(mysqli_num_rows($sql)){
		while($sitesql_result = mysqli_fetch_assoc($sql)){
			$id = $sitesql_result['id'];
			$receivedtime = $sitesql_result['receivedtime'];
			
            $updatesql= " UPDATE `ai_alerts` SET `closedtime`='".$receivedtime."',`status`='C',`comment`='No Issue found after video verification',`closedBy`='sandip' where `id`='".$id."'";
			$month_result = mysqli_query($con,$updatesql);
			if($month_result==1){
			$total_updated = $total_updated + 1;
			}
			
		}
	  }
	  CloseCon($con);
	  echo $total_updated;
     