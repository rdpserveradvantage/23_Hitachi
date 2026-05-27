<?php session_start();include('db_connection.php'); 
function getPanelName($panelid,$con){
	$sql = mysqli_query($con,"select Panel_Make from sites where NewPanelID='".$panelid."'");
	$sql_result = mysqli_fetch_assoc($sql);
    return $sql_result['Panel_Make'];
}
 
function get_sensor_name($zone,$panelid,$con,$alarm)
{
    $panel_name = getPanelName($panelid,$con);
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
		$sql = mysqli_query($con,"select $paramater from rass where ZONE='".$zone."' AND SCODE='".$alarm."'");
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
  
}
?>
<?php 

function getsitedetail($paramater,$panelid,$con){
	$sql = mysqli_query($con,"select $paramater from sites where NewPanelID='".$panelid."'");
	$sql_result = mysqli_fetch_assoc($sql);
	return $sql_result[$paramater];
}
 

function getPanelIDByAtmid($atmid,$con){
	$sql = mysqli_query($con,"select * from sites where ATMID like '%".$atmid."%' "); 
    $sql_resultneo = mysqli_fetch_assoc($sql);
	return $sql_resultneo['NewPanelID'];
}

$client = $_GET['client'];
$banks = explode(",",$_SESSION['bankname']);
       $_bank_name = [];
       for($i=0;$i<count($banks);$i++){
		   $_bank = explode("_",$banks[$i]);
		   if($_bank[0]==$client){
			   array_push($_bank_name,$_bank[1]);
		   }
	   } 
	    $_bank_name=json_encode($_bank_name);
		$_bank_name=str_replace( array('[',']','"') , ''  , $_bank_name);
		$bankarr=explode(',',$_bank_name);
		$_bank_name = "'" . implode ( "', '", $bankarr )."'";

 $bank = "";
   $atmid = "";
if(isset($_GET['bank'])){
$bank = $_GET['bank'];
}
if(isset($_GET['atmid'])){
$atmid = $_GET['atmid'];
}
$con = OpenCon();

if($atmid!=''){
	$sitesql = mysqli_query($con,"select NewPanelID from sites where atmid='".$atmid."' and live='Y'");
}else{
	if($bank!=''){
	  $sitesql = mysqli_query($con,"select NewPanelID from sites where Customer='".$client."' and Bank='".$bank."' and live='Y'");
	}else{
		$sitesql = mysqli_query($con,"select NewPanelID from sites where Customer='".$client."' and Bank IN (".$_bank_name.") and live='Y'");
	}
	
}

    $atmidarray = [];
	if(mysqli_num_rows($sitesql)>0){
		while($sitesql_result = mysqli_fetch_assoc($sitesql)){
			$atmidarray[] = $sitesql_result['NewPanelID'];
			
		}
	}
	$atmidarray=json_encode($atmidarray);
	$atmidarray=str_replace( array('[',']','"') , ''  , $atmidarray);
	$arr=explode(',',$atmidarray);
	$atmidarray = "'" . implode ( "', '", $arr )."'";
	
	

//$panelid = getPanelIDByAtmid($atmid,$con);

$start = $_GET['start'];
$end = $_GET['end'];
$portal = $_GET['portal'];


if($portal=="all"){
    /*$sql = mysqli_query($con,"select zone,alarm,panelid,createtime,closedtime,comment,id,closedBy from alerts where panelid IN (".$atmidarray.") AND CAST(createtime AS DATE)>='".$start."' 
                          AND CAST(createtime AS DATE)<='".$end."' ORDER BY id DESC");  */
	$sql = mysqli_query($con,"SELECT  a.Customer,a.Bank,a.ATMID,a.ATMShortName,a.SiteAddress,a.DVRIP,a.Panel_make,a.zone as zon,a.City,a.State,b.id,b.panelid,
	b.createtime,b.receivedtime,b.comment,b.zone,b.alarm,b.closedBy,b.closedtime FROM sites a,`alerts` b WHERE a.NewPanelID=b.panelid AND a.live='Y' AND
	b.panelid IN (".$atmidarray.") AND CAST(b.createtime AS DATE)>='".$start."' AND CAST(b.createtime AS DATE)<='".$end."' ORDER BY b.id DESC");					  
}else{
	if($portal=="active"){
	   /*	$sql = mysqli_query($con,"select zone,alarm,panelid,createtime,closedtime,comment,id,closedBy from alerts where panelid IN (".$atmidarray.") AND CAST(createtime AS DATE)>='".$start."' 
                          AND CAST(createtime AS DATE)<='".$end."' AND status='O' ORDER BY id DESC"); */
		$sql = mysqli_query($con,"SELECT  a.Customer,a.Bank,a.ATMID,a.ATMShortName,a.SiteAddress,a.DVRIP,a.Panel_make,a.zone as zon,a.City,a.State,b.id,b.panelid,
	b.createtime,b.receivedtime,b.comment,b.zone,b.alarm,b.closedBy,b.closedtime FROM sites a,`alerts` b WHERE a.NewPanelID=b.panelid AND a.live='Y' AND
	b.panelid IN (".$atmidarray.") AND CAST(b.createtime AS DATE)>='".$start."' AND CAST(b.createtime AS DATE)<='".$end."' AND b.status='O' ORDER BY b.id DESC");						  
	}else{
	/*	$sql = mysqli_query($con,"select zone,alarm,panelid,createtime,closedtime,comment,id,closedBy from alerts where panelid IN (".$atmidarray.") AND CAST(createtime AS DATE)>='".$start."' 
                          AND CAST(createtime AS DATE)<='".$end."' AND status='C' ORDER BY id DESC");  */
		$sql = mysqli_query($con,"SELECT  a.Customer,a.Bank,a.ATMID,a.ATMShortName,a.SiteAddress,a.DVRIP,a.Panel_make,a.zone as zon,a.City,a.State,b.id,b.panelid,
	b.createtime,b.receivedtime,b.comment,b.zone,b.alarm,b.closedBy,b.closedtime FROM sites a,`alerts` b WHERE a.NewPanelID=b.panelid AND a.live='Y' AND
	b.panelid IN (".$atmidarray.") AND CAST(b.createtime AS DATE)>='".$start."' AND CAST(b.createtime AS DATE)<='".$end."' AND b.status='C' ORDER BY b.id DESC");					  
	}
}

//$sql = mysqli_query($con,"select * from alerts where panelid ='".$panelid."' GROUP BY id limit 50"); 
//$sql_result = mysqli_fetch_assoc($sql);
// echo json_encode($sql_result);
?>
<div class="table-responsive">
                    <table id="order-listing" class="table">
                      <thead >
                        <tr>
						    <th>ATM ID</th>
							<th>Alert Type</th>
							<th>Panel ID</th>
                            <th>Location</th>
							<th>Address</th>
							<th>State</th>
							<th>City</th>
                            <th>Branch Code</th>
                           
							<th>Alarm Status</th>
							<th>Zone Status</th>
                            <th>Ticket DateTime</th>
                            <th>Closure DateTime</th>
							<th>Duration (HH:MM)</th>
                            <th>DVR IP</th> 
                            <th>Remark</th>
                            <th>Ticket ID</th> 
                            <th>Closed By User</th>                           
                        </tr>
                      </thead>
                      <tbody>
					    <?php 
                        $count = 1 ; 
						  if(mysqli_num_rows($sql)>0){
							  while($sql_result = mysqli_fetch_assoc($sql)){
                  $zone = $sql_result['zone'];
				  $alarm = $sql_result['alarm'];
                   $panelid = $sql_result['panelid'];
				   $_site_atmid = $sql_result['ATMShortName'];
				  // $_site_atmid = getsitedetail('ATMShortName',$panelid,$con);
				   $createdatetime = $sql_result['createtime'];
				   $closedatetime = $sql_result['closedtime'];
				   $duration = "";
				   if($createdatetime!='' && $closedatetime!=''){
				    $datetime1 = new DateTime($closedatetime);
					$datetime2 = new DateTime($createdatetime);
					$interval = $datetime1->diff($datetime2);
					
					$elapsedyear = $interval->format('%y');
					$elapsedmon = $interval->format('%m');
					$elapsed_day = $interval->format('%a');
					$elapsedhr = $interval->format('%h');
					$elapsedmin = $interval->format('%i');
					$elapsedsec = $interval->format('%s');
					if($elapsedhr<10){
						$elapsedhr = "0".$elapsedhr;
					}
					if($elapsedmin<10){
						$elapsedmin = "0".$elapsedmin;
					}
					$duration = $elapsedhr.":".$elapsedmin;
				   }
                  ?>
							   <tr>
							    <td><?php echo $sql_result['ATMID']; //echo getsitedetail('ATMID',$panelid,$con);?></td>
								 <td><?php echo get_sensor_name($zone,$panelid,$con,$alarm);?></td>
								<td><?php echo $panelid;?></td>
                  <td><?php echo $_site_atmid;?></td>
				  <td><?php echo $sql_result['SiteAddress']; //echo getsitedetail('SiteAddress',$panelid,$con);?></td>
				  <td><?php echo $sql_result['State']; //echo getsitedetail('State',$panelid,$con);?></td>
				  <td><?php echo $sql_result['City']; //echo getsitedetail('City',$panelid,$con);?></td>
                  <td><?php echo $_site_atmid;?></td>
                 
				  <td><?php echo $sql_result['alarm'];?></td>
				  <td><?php echo $zone;?></td>
                  <td><?php echo $createdatetime;?></td>
                  <td><?php echo $closedatetime;?></td>
				  <td><?php echo $duration;?></td>
			      <td><?php echo $sql_result['SiteAddress']; //echo getsitedetail('DVRIP',$panelid,$con);?></td>
                  <td><?php echo $sql_result['comment'];?></td>
                  <td><?php echo $sql_result['id'];?></td>
                  <td><?php echo $sql_result['closedBy'];?></td>
                  
								</tr>
								
						<?php }
						  }
						  CloseCon($con);
						?>
                      </tbody>
                    </table>
                  </div>

