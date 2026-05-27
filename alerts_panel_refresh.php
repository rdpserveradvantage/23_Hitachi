<?php include('config.php'); ?>
<?php 
		$panelid = $_POST['panelid'];

		$sites_sql = mysqli_query($con,"SELECT * FROM `sites` WHERE `NewPanelID`= '".$panelid."' ORDER BY `SN` DESC limit 10");
		if(mysqli_num_rows($sites_sql)>0){
		$sites_sql_result = mysqli_fetch_assoc($sites_sql);
		$panelmake = $sites_sql_result['Panel_Make'];
        $i=0;
		$alerts_sql = mysqli_query($con,"SELECT * FROM `alerts` WHERE `alarm` ='BA' AND `panelid`='".$panelid."' ORDER BY `id` DESC limit 50");
		while($alerts_sql_result = mysqli_fetch_assoc($alerts_sql)){ 
			$id = $alerts_sql_result['id'];
			$panelid =$alerts_sql_result['panelid'];
			$zone = $alerts_sql_result['zone'];
			$openat = $alerts_sql_result['createtime'];

			$atm_sql = mysqli_query($con,"SELECT * FROM `sites` where NewPanelID='".$panelid."'");
			$atm_sql_result = mysqli_fetch_assoc($atm_sql);
			$atmid = $atm_sql_result['ATMID'];
			$panelip = $atm_sql_result['PanelIP'];
			$siteaddress = $atm_sql_result['SiteAddress'];
			
			if($panelmake=='RASS'){
				$rass_sql = mysqli_query($con,"SELECT * FROM `rass` where ZONE='".$zone."'");
			}
			if($panelmake=='rass_cloud'){
				$rass_sql = mysqli_query($con,"SELECT * FROM `rass_cloud` where ZONE='".$zone."'");
			}
			if($panelmake=='SMART-IN'){
				$rass_sql = mysqli_query($con,"SELECT * FROM `smarti` where ZONE='".$zone."'");
			} 				
            if($panelmake=='rass_cloudnew'){
				$rass_sql = mysqli_query($con,"SELECT * FROM `rass_cloudnew` where ZONE='".$zone."'");
			} 	 			
			
			$sensorname = "";
			if(mysqli_num_rows($rass_sql)>0){
				$rass_sql_result = mysqli_fetch_assoc($rass_sql);
			    $sensorname = $rass_sql_result['SensorName'];
			}

			?>
		<tr class="bg-danger">
			<td style="font-size:10px">
				<?php echo $panelip;?>
			</td>
			<td style="font-size:10px">
				<?php echo $siteaddress;?>
			</td>
			<td style="font-size:10px">
				<?php echo $sensorname;?>
			</td>
		</tr>
		<?php } }?>

