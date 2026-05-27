<?php include('config.php'); ?>
<?php 
/*
function getsitedetail($paramater,$newpanelid){
	global $con;

	$sql = mysqli_query($con,"select $paramater from sites where NewPanelID='".$newpanelid."'");
	$sql_result = mysqli_fetch_assoc($sql);
	return $sql_result[$paramater];
}
*/
$atmid = $_GET['atmid'];
$start = $_GET['start'];
$end = $_GET['end'];
//change table
$sql = mysqli_query($con,"select * from sites where ATMID='".$atmid."'"); 
//$sql_result = mysqli_fetch_assoc($sql);
//echo json_encode($sql_result);
?>

			<div class="table-responsive">
                <table id="order-listing" class="table">
                    <thead>
                        <tr>
							<!-- // 63 Columns -->
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
                            <th>HDD Capacity</th>

                            <th>AC Control</th>
                            <th>Signature Lollipop Board Control</th>

                            <th>Alert Status</th>
                            <th>Router Power PanelRelay</th>

                            <th>DVR Framework Updated</th> 
                            <th>Camera Framework Updated</th>

                            <th>DVR NTP IP Updated</th>
                            <th>Router Srno</th>

                            <th>Two Way Number</th>
                            <th>Router SIM ICCID Number</th>

                            <th>Router Name</th>
                            <th>Router Connection Number</th>

                            <th>DVR Name</th>
                            <th>Camera Name</th>   

                            <th>DVR NVR SrNo</th>
                            <th>DVR NVR Model No.</th>

                            <th>Router Network</th>
                            <th>Sim Name</th>

                            <th>Site Status</th>
                            <th>Pending Remarks</th>

                            <th>Tested By</th>
                            <th>Engineer Name </th>

                            <th>Engineer MobileNo.</th>
                            <th>Installation Date</th>

                            <th>IP</th>
                            
                        </tr>
                    </thead>
                    <tbody>
						<?php 

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
                            <td></td>

							<td></td>
                            <td></td>

							<td></td>
                            <td></td>

							<td></td>
							<td><?php echo $sql_result['eng_name'];?></td>

							<td></td>
                            <td></td>

							<td></td>
                            <td></td>
                            <td></td>
						</tr>
								
						<?php }
						  }
						?>
                      </tbody>
                </table>
            </div>


