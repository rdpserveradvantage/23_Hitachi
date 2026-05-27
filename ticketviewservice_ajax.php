<?php include('config.php'); ?>
<?php 

function getsitedetail($paramater,$newpanelid){
	global $con;

	$sql = mysqli_query($con,"select $paramater from sites where NewPanelID='".$newpanelid."'");
	$sql_result = mysqli_fetch_assoc($sql);
	return $sql_result[$paramater];
}

function get_PanelidByAtmid($atmid)
{
  global $con;
  $sql = mysqli_query($con,"select * from sites where NewPanelID like '%".$newpanelid."%' "); 
	$sql_result = mysqli_fetch_assoc($sql);
  $getatmid = mysqli_fetch_assoc($sql_result);
  return $getatmid['ATMID']; 
}

function getPanelIDByAtmid($atmid){
	global $con;
    $sql = mysqli_query($con,"select * from sites where ATMID like '%".$atmid."%' "); 
    $sql_resultneo = mysqli_fetch_assoc($sql);
	return $sql_resultneo['NewPanelID'];
}

$atmid = $_GET['atmid'];
$newpanelid = getPanelIDByAtmid($atmid);

$start = $_GET['start'];
$end = $_GET['end'];

$sql = mysqli_query($con,"select * from alerts where panelid ='".$newpanelid."' AND CAST(createtime AS DATE)>='".$start."' 
                          AND CAST(createtime AS DATE)<='".$end."' ORDER BY id DESC limit 50");  

?>

<div class="table-responsive">
                    <table id="order-listing" class="table">
                      <thead>
                        <tr >
                            <th>ID</th> 
                            <th>Location</th>
                            <th>Alert Type</th>
                            <th>Ticket DateTime</th>
                            <th>Closure DateTime</th>
                            <th>DVRIP</th>
                            <th>Alarm Status</th>
                            <th>Remark</th>
                            <th>Update Remark</th>
                                                      
                        </tr>
                      </thead>
                      <tbody>
					    <?php 
                        $count = 1 ; 
						  if(mysqli_num_rows($sql)>0){
							    while($sql_result = mysqli_fetch_assoc($sql)){ 
                //     $str = $sql_result['File_loc'];
                //     $src = "";
								//   if($str!=''){
								// 	    //$files = explode("/",$str);
                //       $files = str_replace('./Record','',$str);
                //       //$file = $files[2];
                //       $file = str_replace('/','\\',$files);
                //       $path = "D:\\python_codes\\Server_socket\\Record\\$file";
								// 	if(file_exists($path)){
								// 		$imgData = base64_encode(file_get_contents($path)); 
								// 		$src = 'data: '.mime_content_type($path).';base64,'.$imgData; 
								// 	}
								// }
							  //     	$_status = 'Closed';
								//       if($sql_result['status']=='O'){
								// 	    $_status = 'Active';
								//   }
                ?>

							   <tr>
							    <td><?php echo $sql_result['id'];?></td>
                  <td><?php echo getsitedetail('SiteAddress',$newpanelid);?></td>
                  <td><?php echo $sql_result['alerttype'];?></td>
                  <td><?php echo $sql_result['createtime'];?></td>
                  <td><?php echo $sql_result['closedtime'];?></td>
							  	<td><?php echo getsitedetail('DVRIP',$newpanelid);?></td>
                  <td><?php echo $sql_result['AlertUserStatus'];?></td>
                  <td><?php echo $sql_result['comment'];?></td>
                  <td></td>
                  <!-- <td><button type="button" class="btn btn-primary btn-sm large-modal" data-check="<?php echo $path;?>" data-id="<?php echo $src;?>" data-toggle="modal" data-target="#largeModal">Update<i class="fa fa-eye ml-1"></i></button></td>  -->
								</tr>
								
						<?php }
						  }
						?>
                      </tbody>
                    </table>
                  </div>

                  

