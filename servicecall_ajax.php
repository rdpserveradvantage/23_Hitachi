<?php include('config.php'); ?>
<?php 

/*
function getsitedetail($paramater,$newpanelid){
	global $con;

	$sql = mysqli_query($con,"select $paramater from sites where NewPanelID='".$newpanelid."'");
	$sql_result = mysqli_fetch_assoc($sql);
	return $sql_result[$paramater];
}

function get_PanelidByAtmid($panelid)
{
  global $con;
  $sql = mysqli_query($con,"select * from sites where ATMID like '%".$atmid."%' "); 
	$sql_result = mysqli_fetch_assoc($sql);
  $getpanelid = mysqli_fetch_assoc($sql_result);
  return $getpanelid['NewPanelID']; 
}
*/
$atmid = $_GET['atmid'];
$start = $_GET['start'];
$end = $_GET['end'];
$sql = mysqli_query($con,"select * from sites where ATMID = '".$atmid."'"); 

?>

<div class="table-responsive">
                    <table id="order-listing" class="table">
                      <thead>
                        <tr>
<!-- 43 columns -->
                            <th>Action</th>  
                            <th>SrNo.</th>

                            <th>Date</th>
                            <th>Client</th>

                            <th>SiteID</th>
                            <th>Address</th>

                            <th>State Name</th>
                            <th>City</th>

                            <th>Site</th>
                            <th>Panel ID</th> 

                            <th>ATM ID</th>
                            <th>ATM ChestDoor</th>

                            <th>ATM HoodDoor</th>
                            <th>ATM Removal</th>

                            <th>Vibrations</th>
                            <th>Thermal Sensor</th>

                            <th>GlassBreak</th>
                            <th>Panic Switch</th>

                            <th>Attendance Switch</th>
                            <th>Motion Sensor</th>

                            <th>CCTV Removal Sensor</th>
                            <th>Back Room Door</th>

                            <th>Shutter Sensor</th>
                            <th>Smoke</th>  

                            <th>EM Lock</th>
                            <th>Keypad</th>

                            <th>Front Door</th>
                            <th>Vault Door</th>

                            <th>Back Door</th>
                            <th>Address</th>

                            <th>Hooter BellBox</th>
                            <th>Mains Fail</th>

                            <th>UPS Fail</th>
                            <th>UPS Battery RemovalSensor</th> 

                            <th>Two Way</th>
                            <th>All CameraStatus</th>

                            <th>HDD Status</th>
                            <th>90 Days Recording</th>

                            <th>Alert Status</th>
                            <th>Pending Remark</th>

                            <th>Tested By</th>
                            <th>Engineer Name</th>

                            <th>Vendor Name</th>
                            
                        </tr>
                      </thead>
                      <tbody>
					    <?php 
                        $count = 1 ; 
						  if(mysqli_num_rows($sql)>0){
							    while($sql_result = mysqli_fetch_assoc($sql)){ 
                
                ?>

						            <tr>
                            <td> </td>
                            <td><?php echo $sql_result['SN'];?></td>

                            <td><?php echo $sql_result['current_dt'];?></td>
                            <td><?php echo $sql_result['Customer'];?></td>

                            <td></td>
                            <td><?php echo $sql_result['SiteAddress'];?></td>

                            <td><?php echo $sql_result['State'];?></td>
                            <td><?php echo $sql_result['City'];?></td>

                            <td><?php echo $sql_result['ATMShortName'];?></td>
                            <td><?php echo $sql_result['NewPanelID'];?></td>

							              <td><?php echo $sql_result['ATMID'];?></td>
                            <td> </td>
                         
                            <td> </td>
                            <td> </td>

                            <td></td>
                            <td></td>

                            <td></td>
                            <td></td>

                            <td></td>            
                            <td></td>

                            <td></td>
                            <td></td>

                            <td></td>
                            <td></td>

                            <td></td>
                            <td></td>

                            <td></td>       
                            <td></td>

                            <td></td>
                            <td></td>

                            <td></td>
                            <td></td>

                            <td></td>       
                            <td></td>

                            <td> </td>
                            <td></td> 

                            <td></td>
                            <td></td>

                            <td></td>
                            <td></td>

                            <td></td>
                            <td><?php echo $sql_result['eng_name'];?></td>

                            <td></td>
                            

						</tr>
								
						<?php }
						  }
						?>
                      </tbody>
                    </table>
                  </div>


