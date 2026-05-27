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


if($portal=="all"){
	// echo "select * from ai_alerts where ATMCode like '%".$atmid."%' AND alerttype NOT LIKE '%alive%' AND CAST(createtime AS DATE)>='".$start."' 
                        //   AND CAST(createtime AS DATE)<='".$end."' ORDER BY id DESC"; 
$sql = mysqli_query($con,"select * from ai_alerts where ATMCode like '%".$atmid."%' AND alerttype NOT LIKE '%alive%' AND CAST(createtime AS DATE)>='".$start."' 
                          AND CAST(createtime AS DATE)<='".$end."' ORDER BY id DESC"); 
}else{
	if($portal=="active"){
		$sql = mysqli_query($con,"select * from ai_alerts where ATMCode like '%".$atmid."%' AND alerttype NOT LIKE '%alive%' AND CAST(createtime AS DATE)>='".$start."' 
                          AND CAST(createtime AS DATE)<='".$end."' AND status='O' ORDER BY id DESC"); 
	}else{
		$sql = mysqli_query($con,"select * from ai_alerts where ATMCode like '%".$atmid."%' AND alerttype NOT LIKE '%alive%' AND CAST(createtime AS DATE)>='".$start."' 
                          AND CAST(createtime AS DATE)<='".$end."' AND status='C' ORDER BY id DESC"); 
	}
}

// return ; 

//echo json_encode($sql_result);
?>

                <div class="table-responsive">
                    <table id="order-listing" class="table">
                      <thead>
                     
                        <tr>
                            
							<th>Ticket ID</th>
                            <th>Location</th>
                            <th>ATMID</th>
                            <th>Alert Type</th>
                            <th>Ticket DateTime</th>
                            <th>Closure DateTime</th>
                            <th>DVR IP</th>
                            <th>Alarm Status</th>
                            <th>Remark</th>
                            
                            <th> Action </th>                           
                        </tr>
                      </thead>
                      <tbody>
					    <?php  
                       
                        $count = 1 ; 
						  if(mysqli_num_rows($sql)>0){
							  while($sql_result = mysqli_fetch_assoc($sql)){ 
							    $str = $sql_result['File_loc'];
								$_atmid = trim($sql_result['ATMCode']);
								$_dvrip = "-";
								$_siteaddress = "-";
								$sitesql = mysqli_query($con,"select ATMID,DVRIP,SiteAddress from sites where ATMID='".$_atmid."'");
								if(mysqli_num_rows($sitesql)>0){
	                              $sitesql_result = mysqli_fetch_assoc($sitesql);
								  $_siteaddress = $sitesql_result['SiteAddress'];
								  $_dvrip = $sitesql_result['DVRIP'];
								}
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
							    <td><?php echo $sql_result['id'];?></td><td><?php echo $_siteaddress;//echo getsitedetail('SiteAddress',$atmid,$con);?></td><td><?php echo $_atmid;?></td>
                                <td><?php echo $sql_result['alerttype'];?></td><td><?php echo $sql_result['createtime'];?></td><td></td>
								<td><?php echo $_dvrip;//echo getsitedetail('DVRIP',$atmid,$con);?></td><td><?php echo $_status;?></td><td></td>
                                <td><button type="button" class="btn btn-primary btn-sm large-modal" data-check="<?php echo $path;?>" data-id="<?php echo $src;?>" data-toggle="modal" data-target="#largeModal">View<i class="fa fa-eye ml-1"></i></button></td> 
								</tr>
								
						<?php }
						  }
						?>
                      </tbody>
                    </table>
                  </div>

<?php CloseCon($con); ?>
