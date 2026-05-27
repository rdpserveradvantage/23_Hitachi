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

$atmidarray = [];$mysqli_query="";
$aisitesql = mysqli_query($con,"select ATMCode from ai_alerts group by ATMCode");
	while($aisitesql_result = mysqli_fetch_assoc($aisitesql)){
		$atmidarray[] = ltrim($aisitesql_result['ATMCode']);
	}
	if(count($atmidarray)>0){
		$atmidarray=json_encode($atmidarray);
		$atmidarray=str_replace( array('[',']','"') , ''  , $atmidarray);
		$arr=explode(',',$atmidarray);
		$atmidarray = "'" . implode ( "', '", $arr )."'";
	}

	if($atmid!=''){
		$sql = mysqli_query($con,"select * from sites where ATMID='".$atmid."' and live='Y'");
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
		 
		}else{  //$mysqli_query = "select * from sites where Customer='".$client."' and Bank IN (".$_bank_name.") and live='Y' and ATMID IN (".$atmidarray.")";
			$sql = mysqli_query($con,"select * from sites where Customer='".$client."' and Bank IN (".$_bank_name.") and live='Y' and ATMID IN (".$atmidarray.")");
		}
		
	}
    $count = 1 ; 
	$_data = [];
	$code = 201;
	
    if(mysqli_num_rows($sql)>0){
	    $key = 1;
		while($sql_result = mysqli_fetch_assoc($sql)){
			//echo '<pre>';print_r($sql_result);echo '</pre>';
            $atm_id = $sql_result['ATMID'];$str='';$createdatetime='-';
		    $ai_alert_sql = mysqli_query($con,"select File_loc,createtime,alerttype,sendip from ai_alerts where ATMCode like '%".$atm_id."%' ORDER BY id desc LIMIT 1"); 
			$src = "";$path="";$camerastatus ="not working";
			
	        if(mysqli_num_rows($ai_alert_sql)>0){
                $sql_resultneo = mysqli_fetch_assoc($ai_alert_sql);
			    $str = $sql_resultneo['File_loc'];
				$createdatetime = $sql_resultneo['createtime'];	
				$sendip = $sql_resultneo['sendip'];	
                
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
					//if($elapsedhr>0){$not=$not+1;}
					$min = $elapsedmin;
					if($not>0){
						$src = "";
						$camerastatus ="not working";
					}else{
						if($elapsedhr<=24){
							$camerastatus ="working";
						    $AlertType = $sql_resultneo['alerttype'];
                            $Customer = $sql_result['Customer'];$Bank = $sql_result['Bank'];$SiteAddress=$sql_result['SiteAddress']	;
                            $ATMID = $sql_result['ATMID'];$City = $sql_result['City'];$State=$sql_result['State'];$Zone = $sql_result['Zone'];
							$NewPanelID=$sql_result['NewPanelID']	;
                            $live = $sql_result['live'];$Password = $sql_result['Password'];$UserName=$sql_result['UserName'];$DVRName = $sql_result['DVRName'];
							$DVRIP=$sql_result['DVRIP'];$PanelsIP = $sql_result['PanelIP'];$SN = $sql_result['SN'];	
                            
  
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
				}
               
			}
			 $data_arr = [];
					$data_arr['atm_id'] = $sql_result['ATMID'];
					$data_arr['ip'] = $sql_result['DVRIP'];
					$data_arr['state'] = $sql_result['State'];
					$data_arr['camera_status'] = $camerastatus ;
					$data_arr['site_address'] = $sql_result['SiteAddress'];
					$data_arr['createdatetime'] = $createdatetime;
					$data_arr['src'] = $src;
					$data_arr['path'] = $path;
					array_push($_data,$data_arr);				
                $key++; 
				
				
		}
		$code = 200;
	}
//	echo '<pre>';print_r($_data);echo '</pre>';die;
$array = array(['code'=>$code,'res_data'=>$_data,'query'=>$mysqli_query]);
CloseCon($con);
echo json_encode($array);
?>