<?php include('db_connection.php'); ?>
<?php 

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

if($atmid!=''){
	
}else{
	if($bank!=''){
	  $sql = mysqli_query($con,"select DVRIP,ATMID,SiteAddress from sites where Customer='".$client."' and Bank='".$bank."' and live='Y'");
	}else{
		$sql = mysqli_query($con,"select DVRIP,ATMID,SiteAddress from sites where Customer='".$client."' and live='Y'");
	}
	
	while($sitesql_result = mysqli_fetch_assoc($sql)){
		//$atmidarray[] = $sitesql_result['ATMID'];
		$word = $sitesql_result['ATMID'];
		$atmidarray[] = "ATMCode LIKE '%".$word."%'";
	}
	
	$atmidorquery = implode(" OR ", $atmidarray);
	
   /*	$atmidarray=json_encode($atmidarray);
	$atmidarray=str_replace( array('[',']','"') , ''  , $atmidarray);
	$arr=explode(',',$atmidarray);
	$atmidarray = "'" . implode ( "', '", $arr )."'"; */
	
}

if($portal=="all"){
	if($atmid!=''){ 
$sql = mysqli_query($con,"select * from ai_alerts where ATMCode like '%".$atmid."%' AND CAST(createtime AS DATE)>='".$start."' 
                          AND CAST(createtime AS DATE)<='".$end."' ORDER BY id DESC"); 
	}else{
	$sql = mysqli_query($con,"select * from ai_alerts where ".$atmidorquery." AND CAST(createtime AS DATE)>='".$start."' 
                          AND CAST(createtime AS DATE)<='".$end."' ORDER BY id DESC");	
	}
	$_sqlquery = "select * from ai_alerts where ".$atmidorquery." AND CAST(createtime AS DATE)>='".$start."' 
                          AND CAST(createtime AS DATE)<='".$end."' ORDER BY id DESC";
}else{
	if($portal=="active"){
		if($atmid!=''){ 
		$sql = mysqli_query($con,"select * from ai_alerts where ATMCode like '%".$atmid."%' AND CAST(createtime AS DATE)>='".$start."' 
                          AND CAST(createtime AS DATE)<='".$end."' AND status='O' ORDER BY id DESC"); 
		}else{
		$sql = mysqli_query($con,"select * from ai_alerts where ".$atmidorquery." AND CAST(createtime AS DATE)>='".$start."' 
                          AND CAST(createtime AS DATE)<='".$end."' AND status='O' ORDER BY id DESC"); 	
		}
	}else{
		if($atmid!=''){
		$sql = mysqli_query($con,"select * from ai_alerts where ATMCode like '%".$atmid."%' AND CAST(createtime AS DATE)>='".$start."' 
                          AND CAST(createtime AS DATE)<='".$end."' AND status='C' ORDER BY id DESC"); 
		}else{
		$sql = mysqli_query($con,"select * from ai_alerts where ".$atmidorquery." AND CAST(createtime AS DATE)>='".$start."' 
                          AND CAST(createtime AS DATE)<='".$end."' AND status='C' ORDER BY id DESC"); 	
		}
	}
}
echo $_sqlquery;
//echo json_encode($sql_result);
?>

                <div class="table-responsive">
                    <table id="order-listing" class="table">
                      <thead>
                     
                        <tr>
                            
							<th>ID</th>
                            <th>Location</th>
                            <th>Branch Code</th>
                            <th>Alert Type</th>
                            <th>Ticket DateTime</th>
                            <th>Closure DateTime</th>
                            <th>DVR IP</th>
                            <th>Alarm Status</th>
                            <th>Remark</th>
                            <th>Ticket ID</th> 
                            <th> Action </th>                           
                        </tr>
                      </thead>
                      <tbody>
					    <?php  
                       
                        $count = 1 ; 
						  if(mysqli_num_rows($sql)>0){
							  while($sql_result = mysqli_fetch_assoc($sql)){ 
							    $str = $sql_result['File_loc'];
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
								$_status = 'Closed';
								if($sql_result['status']=='O'){
									$_status = 'Active';
								}
							  ?>
							   <tr>
							    <td><?php echo $sql_result['id'];?></td><td><?php echo getsitedetail('SiteAddress',$atmid,$con);?></td><td></td>
                                <td><?php echo $sql_result['alerttype'];?></td><td><?php echo $sql_result['createtime'];?></td><td></td>
								<td><?php echo getsitedetail('DVRIP',$atmid,$con);?></td><td><?php echo $_status;?></td><td></td><td><?php echo $sql_result['id'];?></td>
                                <td><button type="button" class="btn btn-primary btn-sm large-modal" data-check="<?php echo $path;?>" data-id="<?php echo $src;?>" data-toggle="modal" data-target="#largeModal">View<i class="fa fa-eye ml-1"></i></button></td> 
								</tr>
								
						<?php }
						  }
						?>
                      </tbody>
                    </table>
                  </div>

<?php CloseCon($con); ?>
