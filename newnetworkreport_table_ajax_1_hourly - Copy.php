<?php session_start();include('db_connection.php'); $con = OpenCon();
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

			$site_circlesql = mysqli_query($con,"select ATMID from site_circle where Circle IN (".$_circle_name.")");	
			while($site_circlesql_result = mysqli_fetch_assoc($site_circlesql)){
					$_circle_name_array[] = $site_circlesql_result['ATMID'];
					
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

$list=array();$list1=array();
$month = 2;
$year = 2023;

for($d=1; $d<=31; $d++)
{
    $time=mktime(12, 0, 0, $month, $d, $year);          
    if (date('m', $time)==$month){       
        $list[]=date('Y-m-d-D', $time);
		$list1[]=date('Y-m-d', $time);
	}
}


$bank = "PNB"; $circle= "Pathankot";
//$net_qry = "SELECT GROUP_CONCAT(concat(c.device,'_',c.cnt)) AS device_count,c.site_id FROM (SELECT device,COUNT(device) AS cnt,site_id FROM `network_history` WHERE status='OK' AND rectime >= SUBDATE( NOW(), INTERVAL 3 HOUR) GROUP BY device,site_id) c GROUP BY c.site_id";
//$net_qry = "select COUNT(*) AS status_count,device,status from network_history where site_id ='".$sn."' AND status='OK' AND CAST(rectime AS DATE)='".$today."' GROUP by device";
if($atmid!=''){
	$sql = "select ATMID,SN,SiteAddress,DVRIP,PanelIP,RouterIp,ATMID_2 from sites where atmid='".$atmid."' and live='Y'";
	/*$sql_qry = "select s.ATMID,s.SN,s.SiteAddress,s.DVRIP,s.PanelIP,s.RouterIp,s.ATMID_2,n.device_count
                 from sites s left join (".$net_qry.") n ON s.SN=n.site_id where s.ATMID='".$atmid."' and s.live='Y'"; */
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
				$sql_qry = "select s.ATMID,s.SN,s.SiteAddress,s.DVRIP,s.PanelIP,s.RouterIp,s.ATMID_2,s.ATMID_3,s.live_date,s.Zone,s.State,sc.Circle from sites s left join site_circle sc ON s.ATMID = sc.ATMID where s.Customer='".$client."' and s.Bank='".$bank."' and s.ATMID IN (".$circleatmidarray.") and s.live='Y'";	
			   /* $sql_qry = "select s.ATMID,s.SN,s.SiteAddress,s.DVRIP,s.PanelIP,s.RouterIp,s.ATMID_2,n.device_count
                 from sites s left join (".$net_qry.") n ON s.SN=n.site_id where s.Customer='".$client."' and s.Bank='".$bank."' and s.ATMID IN (".$circleatmidarray.") and s.live='Y'";
			    */
			}else{
				$sql_qry = "select ATMID,SN,SiteAddress,DVRIP,PanelIP,RouterIp,ATMID_2,ATMID_3,live_date,Zone,State from sites where Customer='".$client."' and Bank='".$bank."' and live='Y'";	
		        /* $sql_qry = "select s.ATMID,s.SN,s.SiteAddress,s.DVRIP,s.PanelIP,s.RouterIp,s.ATMID_2,n.device_count
                 from sites s left join (".$net_qry.") n ON s.SN=n.site_id where s.Customer='".$client."' and s.Bank='".$bank."' and s.live='Y'"; */
			} 
	  
	}else{
		if($client=='All'){
			/*$sql_qry = "select s.ATMID,s.SN,s.SiteAddress,s.DVRIP,s.PanelIP,s.RouterIp,s.ATMID_2,n.device_count
                 from sites s left join (".$net_qry.") n ON s.SN=n.site_id where s.live='Y'"; */
		   $sql_qry = "select ATMID,SN,SiteAddress,DVRIP,PanelIP,RouterIp,ATMID_2,ATMID_3,live_date,Zone,State from sites where live='Y'";	
		}else{
		/*	$sql_qry = "select s.ATMID,s.SN,s.SiteAddress,s.DVRIP,s.PanelIP,s.RouterIp,s.ATMID_2,n.device_count
                 from sites s left join (".$net_qry.") n ON s.SN=n.site_id where s.Customer='".$client."' and s.Bank IN (".$_bank_name.") and s.live='Y'"; */
		   $sql_qry = "select ATMID,SN,SiteAddress,DVRIP,PanelIP,RouterIp,ATMID_2,ATMID_3,live_date,Zone,State from sites where Customer='".$client."' and Bank IN (".$_bank_name.") and live='Y'";
	    }
	}
	
}
//echo $sql_qry;die;

 $sql = mysqli_query($con,$sql_qry); 
?>
<div class="table-responsive">
                    <table id="order-listing" class="table">
                      <thead >
                        <tr>
						    <th>S.N</th><th>ATM</th>
							<th>ATM-ID 1</th><th>ATM-ID 2</th><th>ATM-ID 3</th>
							<th>Site Address</th>
							<th>Circle</th>
							<th>State</th>
							<th>Zone</th>
							<th>Live Date</th>
							<th>Status</th>
							<?php for($i=0;$i<count($list1);$i++){ ?>
						    <th><?php echo $list1[$i];?></th>
						    <?php } ?> 
                            <th>Uptime</th>
                            <th>Downtime</th>
                            <th>Uptime%</th>  							
                        </tr>
                      </thead>
                      <tbody>
					    <?php $yesterday = date('Y-m-d',strtotime("-1 days"));
						      $today = date('Y-m-d');
                        $count = 0; 
						 if(mysqli_num_rows($sql)){
							while($sql_result = mysqli_fetch_assoc($sql)){
								$atm_id = $sql_result['ATMID'];
								$_view = 0;
								if(count($_circle_name_array)==0){
									$_view = 1;
								}else{
									if(in_array($atm_id,$_circle_name_array)){
									   $_view = 1;
									}
								}
								if($_view == 1){
									$site_address = $sql_result['SiteAddress'];
									$atm_id_1= $sql_result['ATMID'];$atm_id_2 = $sql_result['ATMID_2'];$atm_id_3 = $sql_result['ATMID_3'];
									$atm_count = 0;
									if(!is_null($atm_id_1) && $atm_id_1!='' && $atm_id_1!='-'){
										$atm_count = $atm_count + 1;
									}
									if(!is_null($atm_id_2) && $atm_id_2!='' && $atm_id_2!='-'){
										$atm_count = $atm_count + 1;
									}
									if(!is_null($atm_id_3) && $atm_id_3!='' && $atm_id_3!='-'){
										$atm_count = $atm_count + 1;
									}
									/*$_circleqrysql = mysqli_query($con,"select Circle from site_circle where ATMID ='".$atm_id."'"); 
									$_circleName = "";
									if(mysqli_num_rows($_circleqrysql)>0){
										$atmcirclesql_result = mysqli_fetch_assoc($_circleqrysql);
										$_circleName = $atmcirclesql_result['Circle'];
									} */
									
									$_circleName = $sql_result['Circle'];
									$sn = $sql_result['SN'];
									//$device_count = $sql_result['device_count'];
									//$aisql = mysqli_query($con,"select router,dvr,panel from network_report where SN ='".$sn."'"); 
									//if(mysqli_num_rows($aisql)>0){
										$count++;
									//	$aisql_result = mysqli_fetch_assoc($aisql);
									$total_uptime = 0;$total_downtime = 0;
									$tot_cnt = 0;
									?>
									   <tr>
									       <td><?php echo $count;?></td><td><?php echo $atm_count;?>
										   <td><?php echo $atm_id;?></td><td><?php echo $atm_id_2;?></td><td><?php echo $atm_id_3;?></td>
										   <td><?php echo $site_address;?></td><td><?php echo $_circleName;?></td><td><?php echo $sql_result['State'];?></td>
						                   <td><?php echo $sql_result['Zone'];?></td><td><?php echo $sql_result['live_date'];?></td><td></td>
										   <?php for($i=0;$i<count($list1);$i++){ 
										            $mon_date = $list1[$i];
													$net_qry_sql = "SELECT status FROM `network_history` WHERE site_id='".$sn."' AND device='D' AND status='OK' AND CAST(rectime AS DATE)='".$mon_date."'";
													$net_sql_res = mysqli_query($con,$net_qry_sql);
													$total_time = 0;
													$total_net_his = mysqli_num_rows($net_sql_res);
													$net_his_not = 0;
													/*
													if(mysqli_num_rows($net_sql_res)>0){
													   	while($net_his_sql_result = mysqli_fetch_assoc($net_sql_res)){
															$total_net_his = $total_net_his + 1;
															if($net_his_sql_result['status']!='OK'){
																$net_his_not = $net_his_not + 1;
															}
														}
											        } 
													*/
													if($mon_date<=$today){
														$tot_cnt = $tot_cnt + 1;
														if($total_net_his>=8){
															$total_time = 24;
														}else{
															$net_his_not = 8 - $total_net_his;
															$total_time = 24 - $net_his_not;
														}
														/*
														if($net_his_not==0){
															$total_time = 24;
														}else{
															$total_time = 24 - $net_his_not;
														} */
													}
													$total_uptime = $total_uptime + $total_time;
													$total_downtime = $total_downtime + $net_his_not;
										   ?>
										   <td><?php echo $total_time;?></td>
										   <?php } 
										     $total_timemonth = $tot_cnt * 24;
										     $uptimepercent = ($total_uptime * 100)/$total_timemonth;
											 $uptime_percent = number_format((float)$uptimepercent, 2, '.', '');
										   ?>
										   <td><?php echo $total_uptime;?></td>
										   <td><?php echo $total_downtime;?></td>
										   <td><?php echo $uptime_percent."%";?></td>
										</tr>
								
								<?php   //}
									  }
								   }
								 }
								  CloseCon($con);
								?>
                      </tbody>
                    </table>
                  </div>

