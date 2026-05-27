<?php include('config.php'); 
    $panel_sql = mysqli_query($con,"SELECT * FROM `alerts` WHERE `alarm` ='BA' GROUP BY `panelid` ORDER BY `id` DESC limit 10");
    $sno = 0;
	$atmid_arr = array();
	while($panel_sql_result = mysqli_fetch_assoc($panel_sql)){ 
		$sno++;

		$panelid = $panel_sql_result['panelid'];

		$sites_sql = mysqli_query($con,"SELECT ATMID FROM `sites` WHERE `NewPanelID`= '".$panelid."' ORDER BY `SN` DESC limit 10");
		if(mysqli_num_rows($sites_sql)>0){   
            $sites_sql_result = mysqli_fetch_assoc($sites_sql);
			$atmid = $sites_sql_result['ATMID'];
			$joindata = $atmid."_".$panelid;
			array_push($atmid_arr,$joindata);
		}
	}
    echo json_encode(["atmid"=>$atmid_arr]);	

?>