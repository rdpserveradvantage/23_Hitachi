<?php session_start();
include('eazyinfra_functions.php');
date_default_timezone_set('Asia/Kolkata');
$today = date('Y-m-d');

function getPanelName($panelid,$con){
//	global $con;
//	$con = OpenCon();
	$sql = mysqli_query($con,"select Panel_Make from sites where NewPanelID='".$panelid."'");
	$sql_result = mysqli_fetch_assoc($sql);
//	CloseCon($con);
	return $sql_result['Panel_Make'];
}
 
function get_sensor_name($zone,$panelid,$con,$alarm)
{
   // global $con;
	//$con = OpenCon();
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
?>
<?php 
function lastcommunicationdiff($datetime1,$datetime2){
	    $datetime2 = new DateTime($datetime2);
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
		$hour = $elapsedhr;
		if($not>0){
			$return = 0;
		}else{
			if($hour<=24){
				$return = 1;
			}else{
				$return = 0;
			}
		}
				
		return $return;	   
  }
function getsitedetail($paramater,$panelid,$con){
	//global $con;

	$sql = mysqli_query($con,"select $paramater from sites where NewPanelID='".$panelid."'");
	$sql_result = mysqli_fetch_assoc($sql);
	return $sql_result[$paramater];
}
 

function getPanelIDByAtmid($atmid,$con){
	//global $con;
    $sql = mysqli_query($con,"select * from sites where ATMID like '%".$atmid."%' "); 
    $sql_resultneo = mysqli_fetch_assoc($sql);
	return $sql_resultneo['NewPanelID'];
}
$client = "Hitachi";
//$client = $_GET['client'];
$banks = explode(",",$_SESSION['bankname']);
        $_bank_name = [];
        for($i=0;$i<count($banks);$i++){
		    $_bank = explode("_",$banks[$i]);
		    if($client=='All'){
			    array_push($_bank_name,$_bank[1]);
		    }else{
			   if($_bank[0]==$client){
				   array_push($_bank_name,$_bank[1]);
			   }
		    }
	    } 
	    $_bank_name=json_encode($_bank_name);
		$_bank_name=str_replace( array('[',']','"') , ''  , $_bank_name);
		$bankarr=explode(',',$_bank_name);
		$_bank_name = "'" . implode ( "', '", $bankarr )."'";
		
		$_circle_name = "";
		$_circle_name_array = array();
		if($_SESSION['circlename']!=''){
		    $assign_circle = explode(",",$_SESSION['circlename']);
		    $_circle_name = [];
			for($i=0;$i<count($assign_circle);$i++){
			   $_circle = explode("_",$assign_circle[$i]);
			   array_push($_circle_name,$_circle[1]);
			} 
			//$_circle_name = $_circle_name_array;
			$_circle_name=json_encode($_circle_name);
			$_circle_name=str_replace( array('[',']','"') , ''  , $_circle_name);
			$circlearr=explode(',',$_circle_name);
			$_circle_name = "'" . implode ( "', '", $circlearr )."'";

			$site_circlesql = mysqli_query($con,"select s_c.ATMID,s.NewPanelID from site_circle s_c,sites s where s_c.ATMID=s.ATMID AND s_c.Circle IN (".$_circle_name.")");	
			while($site_circlesql_result = mysqli_fetch_assoc($site_circlesql)){
					//$_circle_name_array[] = $site_circlesql_result['ATMID'];
					$_circle_name_array[] = $site_circlesql_result['NewPanelID'];
				}
			if(count($_circle_name_array)>0){
				$_circle_name_array1=json_encode($_circle_name_array);
				$_circle_name_array1=str_replace( array('[',']','"') , ''  , $_circle_name_array1);
				$circlearr_atm=explode(',',$_circle_name_array1);
				$_circle_name_array1 = "'" . implode ( "', '", $circlearr_atm )."'";
			}	
		}

 $bank = "";$circle="";
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

$bank = "PNB";

if($atmid!=''){
	$sql_qry = "select ATMID,SN,SiteAddress,DVRIP,PanelIP,RouterIp,NewPanelID from sites where atmid='".$atmid."' and live='Y'";
}else{
	if($bank!=''){
		if($circle!=''){
				$circlesql = mysqli_query($con,"select ATMID from site_circle where Circle='".$circle."'");
				$circleatmidarray = [];
				while($circlesql_result = mysqli_fetch_assoc($circlesql)){
					$circleatmidarray[] = $circlesql_result['ATMID'];
					
				}
				$circleatmidarray=json_encode($circleatmidarray);
				$circleatmidarray=str_replace( array('[',']','"') , ''  , $circleatmidarray);
				$circlearr=explode(',',$circleatmidarray);
				$circleatmidarray = "'" . implode ( "', '", $circlearr )."'";
				$sql_qry = "select ATMID,SN,SiteAddress,DVRIP,PanelIP,RouterIp,NewPanelID from sites where Customer='".$client."' and Bank='".$bank."' and ATMID IN (".$circleatmidarray.") and live='Y'";	
			}else{
		         $sql_qry = "select ATMID,SN,SiteAddress,DVRIP,PanelIP,RouterIp,NewPanelID
                 from sites where Customer='".$client."' and Bank='".$bank."' and live='Y'";
			} 
	  
	}else{
		if($client=='All'){
		   $sql_qry = "select ATMID,SN,SiteAddress,DVRIP,PanelIP,RouterIp,NewPanelID from sites where live='Y'";	
		}else{
		   $sql_qry = "select ATMID,SN,SiteAddress,DVRIP,PanelIP,RouterIp,NewPanelID from sites where Customer='".$client."' and Bank IN (".$_bank_name.") and live='Y'";
	    }
	}
	
}

$sql_qry_res = mysqli_query($con,$sql_qry);
$panelidarray = [];
$panelidarray1 = [];
$_atmidarray = [];
if(mysqli_num_rows($sql_qry_res)>0){
    while($panelsql_result = mysqli_fetch_assoc($sql_qry_res)){
		$panelidarray[] = $panelsql_result['NewPanelID'];
		$panelidarray1[] = $panelsql_result['NewPanelID'];
		$_atmidarray[] = $panelsql_result['ATMID'];
	}
	$panelidarray=json_encode($panelidarray);
	$panelidarray=str_replace( array('[',']','"') , ''  , $panelidarray);
	$arr_panel=explode(',',$panelidarray);
	$panelidarray = "'" . implode ( "', '", $arr_panel )."'";
}
//echo '<pre>';print_r($panelidarray);echo '</pre>';die;
$getZone_details = json_decode(getZone($org_id,$panelidarray1,$access_token,$con),true);
echo '<pre>';print_r($getZone_details);echo '</pre>';die;
$_view = 0;
if($getZone_details['statusCode']==200){
	$_view = 1;
}else if($getZone_details['statusCode']==401){
	$login_data = userlogin($email,$password,$con);
	if($login_data==1){
		$ems_login_sql = mysqli_query($con,"select email,password,access_token,org_id,refresh_token from eazyinfra_login_access where id=1");
        $ems_login_access = mysqli_fetch_assoc($ems_login_sql);
		$access_token = $ems_login_access['access_token'];
		$org_id = $ems_login_access['org_id'];
		$refresh_token = $ems_login_access['refresh_token'];

		$email=$ems_login_access['email'];
		$password=$ems_login_access['password']; 
		$getZone_details = json_decode(getZone($org_id,$panelidarray1,$access_token,$con),true);
		$_view = 1;
	}else{
		echo 'Something Wrong check login credentials!';
	}
}else{
	echo 'Something Wrong !';
}


 //$sql = mysqli_query($con,$sql_qry); 
?>
<div class="table-responsive">
                    <table id="order-listing" class="table">
                      <thead >
                        <tr>
						    <th>S.N</th>
							<th>ATM-ID</th>
							<th>MAC ID</th>
							<!--<th>Site Address</th>-->
							<th>Panel ID</th>
							<th>Panel Name</th>
							<?php for($i=0;$i<37;$i++){ $j=$i+1;?>
							<th>Zone - <?php echo $j;?></th>
                            <?php } ?>							
                        </tr>
                      </thead>
                      <tbody>
					    <?php //$yesterday = date('Y-m-d',strtotime("-1 days"));
						if($_view==1){
                        $count = 0; 
						 if(count($getZone_details['result'])>0){
							 $zone_res_data = $getZone_details['result'];
							foreach($zone_res_data as $zone_res_value){
								$zone_data_arr = $zone_res_value['zone_config'];
								$mac_id = $zone_res_value['mac_id'];
								$panel_id = $zone_res_value['panel_id'];
								$panel_name = $zone_res_value['panel_name'];
								
								$_view = 0;
								if(count($_circle_name_array)==0){
									$_view = 1;
								}else{
									if(in_array($panel_id,$_circle_name_array)){
									   $_view = 1;
									}
								}
								if($_view == 1){
									
									$sitesql = mysqli_query($con,"select ATMID from sites where NewPanelID ='".$panel_id."'"); 
									if(mysqli_num_rows($sitesql)>0){
										$count++;
									   $sitesql_result = mysqli_fetch_assoc($sitesql); 						
									   $atm_id = $sitesql_result['ATMID'];
									   
					  ?>
							    <tr>
							    <td><?php echo $count;?></td>
							    <td><?php echo $atm_id;?></td>
								<td><?php echo $mac_id;?></td>
								<td><?php echo $panel_id;?></td>
								<td><?php echo $panel_name;?></td>
                                <?php foreach($zone_data_arr as $zone_data){
									if($zone_data['status']=='0'){
										   $_stat = 0;
										   $_st_txt = 'Normal';
										   $_stat_class = 'badge-outline-success';
									   }else{
										   $_stat = 1;
										   $_st_txt = 'Triggered';
										   $_stat_class = 'badge-outline-danger';
									   }
									   if($zone_data['arm_status']=='0'){
										   $_arm_st = 0;
										   $_arm_st_txt = 'Inactive';
										   $_arm_stat_class = 'badge-outline-warning';
									   }else{
										   $_arm_st = 1;
										   $_arm_st_txt = 'Active';
										   $_arm_stat_class = 'badge-outline-success';
									   }
									?>
								<td>
								    <p>
									  status : <span class="<?php echo $_stat_class;?>"><?php echo $_st_txt;?></span>
									  <!--<div class="badge  badge-pill"></div>-->
									</p>
									<p>
									  arm status : <span class="<?php echo $_arm_stat_class;?>"><?php echo $_arm_st_txt;?></span>
									  <!--<div class="badge badge-pill"></div>-->
									</p>
								<p>
								zone_no: <?php echo $zone_data['zone_no'];?> </p>
								<p>type: <?php echo $zone_data['type'];?> </p>
								<p>zone_settings: <?php echo $zone_data['zone_settings'];?> </p>
                                    
								</td>
								
                                <?php }?>
								</tr>
								
						<?php    }
							   }
						    }
						  }
						 }
						  CloseCon($con);
						?>
                      </tbody>
                    </table>
                  </div>

