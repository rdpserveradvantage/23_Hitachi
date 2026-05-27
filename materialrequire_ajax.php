<?php include('config.php'); ?>
<?php 

$atmid = $_GET['atmid'];
$start = $_GET['start'];
$end = $_GET['end'];

//change table
$sql = mysqli_query($con,"select * from sites where ATMID ='".$atmid."'"); //login status='0'-> online
// $sql_result = mysqli_fetch_assoc($sql);
// echo json_encode($sql_result);
?>

                <div class="table-responsive">
                    <table id="order-listing" class="table">
                      <thead>
                        <tr>
                            <!-- 17 Columns -->
							<th>Action</th>
                            <th>Serial No.</th>

                            <th>Date</th>
                            <th>Client</th>

                            <th>SiteID</th>
                            <th>Address</th>

                            <th>State Name</th>
                            <th>City</th>

                            <th>Site</th>
                            <th>Panel ID</th>  

                            <th>ATM ID</th>
                            <th>Remark Reason</th> 

                            <th>Required Date</th>
                            <th>Confirmed By</th>

                            <th>Material Status</th>
                            <th>Docket Number</th>

                            <th>Dispatch Date</th>
                            <th>Dispatch To</th>
                            
                            <th>Site Status</th>
                            
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
                            <td></td>
                         
                            <td></td>
                            <td></td>

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

