<?php include('db_connection.php'); ?>
<?php 
function getPanelName($panelid,$con){
//	global $con;
//	$con = OpenCon();
	$sql = mysqli_query($con,"select Panel_Make from sites where NewPanelID='".$panelid."'");
	$sql_result = mysqli_fetch_assoc($sql);
//	CloseCon($con);
	return $sql_result['Panel_Make'];
}
 
function get_sensor_name($zone,$panel_name,$con,$alarm)
{
   // global $con;
	//$con = OpenCon();
	//$panel_name = getPanelName($panelid,$con);
	$paramater = 'SensorName';
	$sql = "";
	$_change = 0;
	if($panel_name=='comfort'){
		if(substr($alarm, -1)=='R' || substr($alarm, -1)=='N'){
			$_change = 1;
			$remain_char = substr($alarm, 0,-1);
		    $sql = mysqli_query($con,"select $paramater from comfort where ZONE='".$zone."' AND SCODE LIKE '".$remain_char."%'");	
		}else{
		   $sql = mysqli_query($con,"select $paramater from comfort where ZONE='".$zone."' AND SCODE='".$alarm."'");
		}
	}
	if($panel_name=='rass_boi'){
		if(substr($alarm, -1)=='R'){
			$_change = 1;
			$remain_char = substr($alarm, 0,-1);
		    $sql = mysqli_query($con,"select $paramater from rass_boi where ZONE='".$zone."' AND SCODE LIKE '".$remain_char."%'");	
		}else{
		   $sql = mysqli_query($con,"select $paramater from rass_boi where ZONE='".$zone."' AND SCODE='".$alarm."'");
		}
	}
	if($panel_name=='rass_pnb'){
		if(substr($alarm, -1)=='R'){
			$_change = 1;
			$remain_char = substr($alarm, 0,-1);
		    $sql = mysqli_query($con,"select $paramater from rass_pnb where ZONE='".$zone."' AND SCODE LIKE '".$remain_char."%'");	
		}else{
		   $sql = mysqli_query($con,"select $paramater from rass_pnb where ZONE='".$zone."' AND SCODE='".$alarm."'");
		}
	}
	if($panel_name=='smarti_boi'){
		if(substr($alarm, -1)=='R'){
			$_change = 1;
			$remain_char = substr($alarm, 0,-1);
		    $sql = mysqli_query($con,"select $paramater from smarti_boi where ZONE='".$zone."' AND SCODE LIKE '".$remain_char."%'");	
		}else{
		   $sql = mysqli_query($con,"select $paramater from smarti_boi where ZONE='".$zone."' AND SCODE='".$alarm."'");
		}
	}
	if($panel_name=='smarti_pnb'){
		if(substr($alarm, -1)=='R'){
			$_change = 1;
			$remain_char = substr($alarm, 0,-1);
		    $sql = mysqli_query($con,"select $paramater from smarti_pnb where ZONE='".$zone."' AND SCODE LIKE '".$remain_char."%'");	
		}else{
		   $sql = mysqli_query($con,"select $paramater from smarti_pnb where ZONE='".$zone."' AND SCODE='".$alarm."'");
		}
	}
    if($panel_name=='RASS'){
		$sql = mysqli_query($con,"select $paramater from rass where ZONE='".$zone."' AND status=0");
	}
    if($panel_name=='rass_cloud'){
		$sql = mysqli_query($con,"select $paramater from rass_cloud where ZONE='".$zone."' AND status=0");
	}
	if($panel_name=='rass_cloudnew'){
		$sql = mysqli_query($con,"select $paramater from rass_cloudnew where ZONE='".$zone."' AND status=0");
	}
	if($panel_name=='rass_sbi'){
		$sql = mysqli_query($con,"select $paramater from rass_sbi where ZONE='".$zone."' AND status=0");
	}
	if($panel_name=='SEC'){
		$sql = mysqli_query($con,"select $paramater from securico where ZONE='".$zone."' AND status=0");
	}
	if($panel_name=='securico_gx4816'){
		$sql = mysqli_query($con,"select $paramater from securico_gx4816 where ZONE='".$zone."' AND status=0");
	}
	if($panel_name=='sec_sbi'){
		$sql = mysqli_query($con,"select $paramater from sec_sbi where ZONE='".$zone."' AND status=0");
	}
	if($panel_name=='Raxx'){
		$sql = mysqli_query($con,"select $paramater from raxx where ZONE='".$zone."' AND status=0");
	}
	if($panel_name=='SMART -I'){
		$sql = mysqli_query($con,"select $paramater from smarti where ZONE='".$zone."' AND status=0");
	}
	if($panel_name=='SMART-IN'){
		$sql = mysqli_query($con,"select $paramater from smartinew where ZONE='".$zone."' AND status=0");
	}
	if($sql==""){
		$return = "";
	}else{
		if(mysqli_num_rows($sql)>0){
	        $sql_result = mysqli_fetch_assoc($sql);
	        if($_change == 1){
				if($panel_name=='comfort'){
		            if(substr($alarm, -1)=='R' || substr($alarm, -1)=='N'){
						$return = $sql_result[$paramater]." Restoral";
					}
				}
				else{	
				   if(substr($alarm, -1)=='R'){
					$return = $sql_result[$paramater]." Restoral";
				   }
				}
				
		    } else{
		        $return = $sql_result[$paramater];
			}
		}else{
			$return = "";
		}
		
	}
	return $return;
  //  CloseCon($con);
	
 //  return $panel_name;
}
function endsWith($haystack, $needle)
{
    $length = strlen($needle);

    return $length === 0 || 
    (substr($haystack, -$length) === $needle);
}
function getsitedetail($paramater,$atmid,$con){
	//global $con;

	$sql = mysqli_query($con,"select $paramater from sites where ATMID='".$atmid."'");
	$sql_result = mysqli_fetch_assoc($sql);
	return $sql_result[$paramater];
}
$client = $_GET['client'];
$bank = $_GET['bank'];
$atmid = $_GET['atmid'];
$start = $_GET['start'];
$end = $_GET['end'];
$portal = $_GET['portal'];
$con = OpenCon();


if($portal=="all"){
$abc="SELECT  a.Customer,a.Bank,a.ATMID,a.ATMShortName,a.SiteAddress,a.DVRIP,a.Panel_make,a.zone as zon,a.City,a.State,b.id,b.panelid,b.createtime,b.receivedtime,b.comment,
      b.zone,b.alarm,b.closedBy,b.closedtime,b.sendip FROM sites a,`alerts` b WHERE (a.OldPanelID=b.panelid or a.NewPanelID=b.panelid) and 
	  CAST(b.receivedtime AS DATE)>='".$start."' and CAST(b.receivedtime AS DATE)<='".$end."'";
	if($atmid!=""){
	   $abc.=" and a.ATMID='".$atmid."'";
	}	  
$abc.=" order by b.receivedtime desc limit 15 ";

$sql = mysqli_query($con,$abc);	
/*$sql = mysqli_query($con,"select * from ai_alerts where ATMCode like '%".$atmid."%' AND CAST(createtime AS DATE)>='".$start."' 
                          AND CAST(createtime AS DATE)<='".$end."' ORDER BY id DESC");  */
}else{
	if($portal=="active"){
		$abc="SELECT  a.Customer,a.Bank,a.ATMID,a.ATMShortName,a.SiteAddress,a.DVRIP,a.Panel_make,a.zone as zon,a.City,a.State,b.id,b.panelid,b.createtime,b.receivedtime,b.comment,
			  b.zone,b.alarm,b.closedBy,b.closedtime,b.sendip FROM sites a,`alerts` b WHERE (a.OldPanelID=b.panelid or a.NewPanelID=b.panelid) and 
			  CAST(b.receivedtime AS DATE)>='".$start."' and CAST(b.receivedtime AS DATE)<='".$end."' AND status='O'";
			if($atmid!=""){
			   $abc.=" and a.ATMID='".$atmid."'";
			}	  
		$abc.=" order by b.receivedtime desc limit 15 ";
		$sql = mysqli_query($con,$abc);	
		
	}else{
		$abc="SELECT  a.Customer,a.Bank,a.ATMID,a.ATMShortName,a.SiteAddress,a.DVRIP,a.Panel_make,a.zone as zon,a.City,a.State,b.id,b.panelid,b.createtime,b.receivedtime,b.comment,
			  b.zone,b.alarm,b.closedBy,b.closedtime,b.sendip FROM sites a,`alerts` b WHERE (a.OldPanelID=b.panelid or a.NewPanelID=b.panelid) and 
			  CAST(b.receivedtime AS DATE)>='".$start."' and CAST(b.receivedtime AS DATE)<='".$end."' AND status='C'";
			if($atmid!=""){
			   $abc.=" and a.ATMID='".$atmid."'";
			}	  
		$abc.=" order by b.receivedtime desc limit 15 ";
		$sql = mysqli_query($con,$abc);	
	}
}

//echo json_encode($sql_result);
?>

                <div class="table-responsive">
                    <table id="order-listing" class="table">
                      <thead>
                     
                        <tr>
                            <th>Client Name</th>
							<th>Incident Number</th>
							<th>Region</th>
							<th>ATMID</th>
							<th>Address</th>
							<th>City</th>
							<th>State</th>
							<th>zone</th>
							<th>Alarm</th>
							<th>Incident Category</th>
							<th>Alarm Message</th>
							<th>Incident Date Time</th>
							<th>Alarm Received Date Time</th>
							<th> Close Date Time</th>
							<th>DVRIP</th>
							<th>Panel_make</th>
							<th>panelid</th>
						    <th>Bank</th>
							<th>Reactive</th>
							<th>Send Ip</th>
						    <th>Closed By</th>
							<th>Closed Date</th>
							<th>Remark</th>                           
                        </tr>
                      </thead>
                      <tbody>
					    <?php  
                       
                        $count = 1 ; 
						  if(mysqli_num_rows($sql)>0){
							while($row = mysqli_fetch_array($sql)){ 
							    $dtconvt=$row["receivedtime"];
								$timestamp = strtotime($dtconvt);
								$newDate = date('d-F-Y', $timestamp); 
								$zone = $row["zone"];
								$alarm = $row["alarm"];
								$panel_make = $row["Panel_make"];
								$desc = get_sensor_name($zone,$panel_make,$con,$alarm);
								
							  ?>
							   <tr>
							        <td><?php echo $row["Customer"];?></td>
									<td><?php echo $row["id"];?></td>
									<td><?php echo $row["zon"];?></td>
									<td><?php echo $row["ATMID"];?></td>
                                    <td><?php echo $row["SiteAddress"];?></td>
                                    <td><?php echo $row["City"];?></td>
		                            <td><?php echo $row["State"];?></td>
			                        <td><?php echo $row["zone"];?></td>
			                        <td><?php echo $row["alarm"];?></td>
									<td><?php echo $desc;?></td>
									<td><?php echo $desc;?></td>
									<td><?php echo $row["createtime"];?></td>
									<td><?php echo $row["receivedtime"];?></td>
									<td><?php echo $newDate;?></td>
									<td><?php echo $row["DVRIP"];?></td>
									<td><?php echo $row["Panel_make"];?></td>	
									<td><?php echo $row["panelid"];?></td>
									<td><?php echo $row["Bank"];?></td>
									<td><?php if(endsWith($row["alarm"], "R"))echo 'Non-Reactive';else echo 'Reactive';?></td>
                                    <td><?php echo $row["sendip"];?></td>
                                    <td><?php echo $row["closedBy"];?></td>
                                    <td><?php echo $row["closedtime"];?></td>
	                                <td><?php echo $row["closedtime"].'*'.$row["comment"].'*'.$row["closedBy"];?></td>
								</tr>
								
						<?php }
						  }
						?>
                      </tbody>
                    </table>
                  </div>

<?php CloseCon($con); ?>
