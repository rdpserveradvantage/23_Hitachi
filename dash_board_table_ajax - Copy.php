<?php session_start();include('db_connection.php');  ?>
<?php 
 date_default_timezone_set('Asia/Kolkata');
  function datetimediff($datetime){
	    $datetime1 = new DateTime();
		$datetime2 = new DateTime($datetime);
		$interval = $datetime1->diff($datetime2);
		//$elapsed = $interval->format('%y years %m months %a days %h hours %i minutes %s seconds');
		$elapsed = $interval->format('%i');
		return $elapsed;
  }
  
function getsitedetail($paramater,$panelid){
	global $con;

	$sql = mysqli_query($con,"select $paramater from sites where NewPanelID='".$panelid."'");
	$sql_result = mysqli_fetch_assoc($sql);
	return $sql_result[$paramater];
}
 
function get_sensor_name($zone,$panelid)
{
    global $con;
    $sql = mysqli_query($con,"select * from sites where NewPanelID like '%".$panelid."%' "); 
    $sql_resultneo = mysqli_fetch_assoc($sql);
    if($sql_resultneo['Panel_Make']=='rass_cloud'){
      $getsql = mysqli_query($con,"select * from rass_cloud where zone = '".$zone."' "); 
      $sql_result = mysqli_fetch_assoc($getsql);
      return $sql_result['SensorName']; 

    }
}

function getAIAlertsByAtmid($atmid,$parameter){
	global $con;
    $sql = mysqli_query($con,"select $parameter from ai_alerts where ATMCode like '%".$atmid."%' ORDER BY id desc LIMIT 1"); 
	if(mysqli_num_rows($sql)>0){
        $sql_resultneo = mysqli_fetch_assoc($sql);
	    return $sql_resultneo[$parameter];
	}else{
		return "";
	}
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
if(isset($_GET['circle'])){
$circle = $_GET['circle'];
}
$con = OpenCon();

$atmidarray = [];
$aisitesql = mysqli_query($con,"select ATMCode from ai_alerts group by ATMCode");
	while($aisitesql_result = mysqli_fetch_assoc($aisitesql)){
		$atmidarray[] = ltrim($aisitesql_result['ATMCode']);
		
	}
	$atmidarray=json_encode($atmidarray);
	$atmidarray=str_replace( array('[',']','"') , ''  , $atmidarray);
	$arr=explode(',',$atmidarray);
	$atmidarray = "'" . implode ( "', '", $arr )."'";

if($atmid!=''){
	$sql = mysqli_query($con,"select * from sites where atmid='".$atmid."' and live='Y'");
}else{
	if($bank!=''){
		if($circle!=''){
				$circlesql = mysqli_query($con,"select ATMID from site_circle where Circle='".$circle."' AND ATMID IN (".$atmidarray.")");
				$circleatmidarray = [];
				while($circlesql_result = mysqli_fetch_assoc($circlesql)){
					$circleatmidarray[] = $circlesql_result['ATMID'];
					
				}
				$circleatmidarray=json_encode($circleatmidarray);
				$circleatmidarray=str_replace( array('[',']','"') , ''  , $circleatmidarray);
				$circlearr=explode(',',$circleatmidarray);
				$circleatmidarray = "'" . implode ( "', '", $circlearr )."'";
				$sql = mysqli_query($con,"select * from sites where Customer='".$client."' and Bank='".$bank."' and ATMID IN (".$circleatmidarray.") and live='Y'");	
			}else{
		         $sql = mysqli_query($con,"select * from sites where Customer='".$client."' and Bank='".$bank."' and live='Y' and ATMID IN (".$atmidarray.")");
			} 
	 
	}else{
		$sql = mysqli_query($con,"select * from sites where Customer='".$client."' and Bank IN (".$_bank_name.") and live='Y' and ATMID IN (".$atmidarray.")");
	}
	/*$atmidarray = [];
	while($sitesql_result = mysqli_fetch_assoc($sitesql)){
		$atmidarray[] = $sitesql_result['ATMCode'];
		
	}
	$atmidarray=json_encode($atmidarray);
	$atmidarray=str_replace( array('[',']','"') , ''  , $atmidarray);
	$arr=explode(',',$atmidarray);
	$atmidarray = "'" . implode ( "', '", $arr )."'";
	
	$testsql = "SELECT * FROM sites WHERE ATMID IN (".$atmidarray.")";
    $sql = mysqli_query($con,$testsql); */
}

?>
<div class="table-responsive">
                    <table id="order-listing" class="table">
                      <thead >
                        <tr>
						    <th>S.N</th>
							<th>ATM-ID</th>
							<th>Alert Name</th>
							<th>IP</th>
							<th>State</th>
							<th>Camera1</th>
							<th>Address</th>
							<th>Last Communication</th>
							<th>Last File Uploaded</th>                          
                        </tr>
                      </thead>
                      <tbody>
					    <?php 
                        $count = 1 ; 
						  if(mysqli_num_rows($sql)>0){
							  $key = 1;
							  while($sql_result = mysqli_fetch_assoc($sql)){
                  $atm_id = $sql_result['ATMID'];$str='';$createdatetime='-';
				  $ai_alert_sql = mysqli_query($con,"select File_loc,createtime,alerttype,sendip from ai_alerts where ATMCode like '%".$atm_id."%' ORDER BY id desc LIMIT 1"); 
	              if(mysqli_num_rows($ai_alert_sql)>0){
                      $sql_resultneo = mysqli_fetch_assoc($ai_alert_sql);
					  $str = $sql_resultneo['File_loc'];
					  $createdatetime = $sql_resultneo['createtime'];	
				      $sendip = $sql_resultneo['sendip'];	
                  
								$src = "";
								if($str!=''){
									//$files = explode("/",$str);
									$files = str_replace('./Record','',$str);
									//$file = $files[2];
									$file = str_replace('/','\\',$files);
									$path = "D:\\python_codes\\Server_socket\\Record\\$file";
									if(file_exists($path)){
										$imgData = base64_encode(file_get_contents($path)); 
										$src = 'data: '.mime_content_type($path).';base64,'.$imgData; 
									}
								}
							
						if($src==""){
							$camerastatus ="not working";
						}else{
							$datetime1 = new DateTime();
							$datetime2 = new DateTime($createdatetime);
							$interval = $datetime1->diff($datetime2);
							$elapsedyear = $interval->format('%y');
							$elapsedmon = $interval->format('%m');
							$elapsed_day = $interval->format('%a');
							$elapsedhr = $interval->format('%h');
							$elapsedmin = $interval->format('%i');
							$not = 0;
							if($elapsedyear>0){$not=$not+1;}
							if($elapsedmon>0){$not=$not+1;}
							if($elapsed_day>0){$not=$not+1;}
						//	if($elapsedhr>0){$not=$not+1;}
							$min = $elapsedmin;
							if($not>0){
								$src = "";
								$camerastatus ="not working";
							}else{
								if($elapsedhr<=24){
									$camerastatus ="working";
								    $AlertType = $sql_resultneo['alerttype'];
                 $Customer = $sql_result['Customer'];$Bank = $sql_result['Bank'];$SiteAddress=$sql_result['SiteAddress']	;
$ATMID = $sql_result['ATMID'];$City = $sql_result['City'];$State=$sql_result['State'];$Zone = $sql_result['Zone'];$NewPanelID=$sql_result['NewPanelID']	;
$live = $sql_result['live'];$Password = $sql_result['Password'];$UserName=$sql_result['UserName'];$DVRName = $sql_result['DVRName'];$DVRIP=$sql_result['DVRIP'];
$PanelsIP = $sql_result['PanelIP'];$SN = $sql_result['SN'];		
                           			

                $ai_site_sql = mysqli_query($con,"select * from ai_sites where SN='".$SN."'"); 
	            if(mysqli_num_rows($ai_site_sql)==0){
									
				$insert_sql="insert into ai_sites(Project,Customer,Bank,ATMID,Location,SiteAddress,City,State,Zone,NewPanelID,DVRIP,DVRName,UserName,Password,live,rtsp_stream,pie_username,pie_pwd,PanelIP,AlertType,SN)
                             values('','".$Customer."','".$Bank."','".$ATMID."','".$SiteAddress."','".$SiteAddress."','".$City."','".$State."','".$Zone."','".$NewPanelID."','".$DVRIP."','".$DVRName."','".$UserName."','".$Password."','".$live."','','','','".$PanelsIP."','".$AlertType."','".$SN."')";

$result=mysqli_query($con,$insert_sql) ;  
				}
									
								}else{
									$src = "";
								    $camerastatus ="not working";
								}
							}
							/*
							$min = datetimediff($createdatetime);
					
							if($min<=30){
								$camerastatus ="working";
							}else{
								$src = "";
								$camerastatus ="not working";
							} */
							
						}		
                  ?>
							   <tr>
							    <td><?php echo $key;?></td>
                  <td><?php echo $sql_result['ATMID'];?></td><td><?php echo $sql_resultneo['alerttype'];?></td>
				  <td><?php echo $sendip;?></td>
                  <td><?php echo $sql_result['State'];?></td>
                  <td><?php echo $camerastatus;?></td>
                  <td><?php echo $sql_result['SiteAddress'];?></td>
                  <td><?php echo $createdatetime;?></td>
				  <td>
				    <?php if($src==""){ echo '--';}else{?>
				  <button type="button" class="btn btn-primary btn-sm large-modal" data-check="<?php echo $path;?>" data-id="<?php echo $src;?>" data-toggle="modal" data-target="#largeModal">View<i class="fa fa-eye ml-1"></i></button></td>
					<?php }?>
					</td>
								</tr>
								
						<?php $key++; }
						  }}
						?>
                      </tbody>
                    </table>
                  </div>

<?php CloseCon($con);?>