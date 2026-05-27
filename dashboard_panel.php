<?php include('config.php'); ?>
<?php 
$panel_sql = mysqli_query($con,"SELECT * FROM `alerts` WHERE `alarm` ='BA' AND status='O' GROUP BY `panelid` ORDER BY `id` DESC limit 10");
$sno = 0;
while($panel_sql_result = mysqli_fetch_assoc($panel_sql)){ 
$sno++;

$panelid = $panel_sql_result['panelid'];

$sites_sql = mysqli_query($con,"SELECT * FROM `sites` WHERE `NewPanelID`= '".$panelid."' ORDER BY `SN` DESC limit 10");
if(mysqli_num_rows($sites_sql)>0){
        $sites_sql_result = mysqli_fetch_assoc($sites_sql);
        $panelmake = $sites_sql_result['Panel_Make'];

        $alerts_sql = mysqli_query($con,"SELECT * FROM `alerts` WHERE `alarm` ='BA' AND status='O' AND `panelid`='".$panelid."' ORDER BY `id` DESC");
		$alerts_sql_result = mysqli_fetch_assoc($alerts_sql);
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
        $_atmid = $sites_sql_result['ATMID'];
?>
<div class="card">
	<div class="card-header" id="heading-<?php echo $sno;?>" role="tab" onclick="setATMID('<?php echo $panelid;?>','<?php echo $_atmid;?>','<?php echo $sensorname;?>');">
		<h6 class="mb-0">
			<a aria-controls="collapse-<?php echo $panelid;?>" aria-expanded="false" class="collapsed" data-toggle="collapse" href="#collapse-<?php echo $panelid;?>">
				<span><?php echo $sno.". ".$sites_sql_result['ATMID']." - ".$sensorname; ?></span>
			</a>
		</h6>
	</div>
	<div aria-labelledby="heading-<?php echo $panelid;?>" class="collapse" data-parent="#accordion" id="collapse-<?php echo $panelid;?>" role="tabpanel">
		<div class="card-body">
			<table class="table set-table">
				<thead>
					<tr style="background: gray;">
						<th style="font-size:10px">
							Device IP
						</th>
						<th style="font-size:10px">
							Site/Address
						</th>
						<th style="font-size:10px">
							Alert Type
						</th>
					</tr>
					<tbody id="<?php echo $panelid;?>">
						
						
					</tbody>
				</thead>
			</table>
		</div>
	</div>
</div>
<?php }}?>

