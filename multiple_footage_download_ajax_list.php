<?php session_start();include('db_connection.php'); ?>
<?php 
$con = OpenCon();

$status = $_GET['Status'];


	if($status=='all'){
$sql = mysqli_query($con,"select * from multiple_footage_download order by id desc"); 		
	}else{
$sql = mysqli_query($con,"select * from multiple_footage_download where status='".$status."' order by id desc"); 
	}

?>


<div class="table-responsive">
                    <table id="order-listing" class="table">
                      <thead>
                        <tr>
							<th>S.No.</th>
							<th>IP</th>
							<th>Cam No.</th>
							<th>From</th>
							<th>To</th>
							<th>PC No.</th>
							<th>Status</th>
							<th>Created Date</th>
							<th>Updated Date</th>
							<th>Created By</th>
													  
						</tr>
                      </thead>
                      <tbody>
					    <?php 
                        $count = 1 ; 
						  if(mysqli_num_rows($sql)>0){
							  while($sql_result = mysqli_fetch_assoc($sql)){
                                $_status = $sql_result['status'];
								if($_status==2){
									$current_status = "Completed";
								}
								if($_status==0){
									$current_status = "Pending";
								}
								if($_status==1){
									$current_status = "Processing";
								}
								$_id = $sql_result['created_by'];
								$usersql = mysqli_query($con,"select name from loginusers where id = '".$_id."'");
                                $user_result = mysqli_fetch_row($usersql);
								$created_user = $user_result[0];
                        ?>
							   <tr>
							        <td><?php echo $count;?></td>
								    <td><?php echo $sql_result['ip'];?></td>
								    <td><?php echo $sql_result['cam_no'];?></td>
								    <td><?php echo $sql_result['from_datetime'];?></td>
								    <td><?php echo $sql_result['to_datetime'];?></td>
								    <td><?php echo $sql_result['pc_no'];?></td>
								    <td><?php echo $current_status;?></td>
								    <td><?php echo $sql_result['created_at'];?></td>
								    <td><?php echo $sql_result['updated_at'];?></td>
								    <td><?php echo $created_user;?></td>
								    
								</tr>
								
						<?php $count++; }
						  }
						?>
                      </tbody>
                    </table>
                  </div>

<?php
CloseCon($con);

?>

