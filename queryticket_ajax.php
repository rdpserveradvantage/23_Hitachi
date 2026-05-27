<?php include('config.php'); ?>
<?php 

function getsitedetail($paramater,$panelid){
	global $con;

	$sql = mysqli_query($con,"select $paramater from sites where NewPanelID='".$panelid."'");
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
$panelid = getPanelIDByAtmid($atmid);

$start = $_GET['start'];
$end = $_GET['end'];

$sql = mysqli_query($con,"select * from alerts where panelid ='".$panelid."' AND CAST(createtime AS DATE)>='".$start."' 
                          AND CAST(createtime AS DATE)<='".$end."' ORDER BY id DESC limit 50");  

?>

<div class="table-responsive">
                    <table id="order-listing" class="table">
                      <thead>
                        <tr>
                            <th>ID</th> 
                            <th>Location</th>
                            <th>Alert Type</th>
                            <th>Start DateTime</th>
                            <th>Status DateTime</th>
                            <th>DVRIP</th>
                            <th>Remark</th>
                            <th>Ticket ID</th>
                            <th>Action</th>
							<th>Closed By</th>                           
                        </tr>
                      </thead>
                      <tbody>
					    <?php 
                        $count = 1 ; 
						  if(mysqli_num_rows($sql)>0){
							  while($sql_result = mysqli_fetch_assoc($sql)){ ?>
							   <tr>
							    <td><?php echo $sql_result['id'];?></td> <td><?php echo getsitedetail('SiteAddress',$panelid);?></td>
                                <td><?php echo $sql_result['alerttype'];?></td><td><?php echo $sql_result['closedtime'];?></td><td></td>
								<td><?php echo getsitedetail('DVRIP',$panelid);?></td><td><?php echo $sql_result['comment'];?></td><td></td>
                                <td></td><td><?php echo $sql_result['closedBy'];?></td>
								</tr>
								
						<?php }
						  }
						?>
                      </tbody>
                    </table>
                  </div>

                  

