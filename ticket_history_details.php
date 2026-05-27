<?php 
include('config.php');

$id = $_GET['id'];
$sql = mysqli_query($con,"select * from ticket_raise_history where ticket_raise_id='".$id."'");
?>

							<div class="row">
								<div class="col-12">
								  <div class="table-responsive">
									<table id="order-listing" class="table">
									  <thead>
										<tr>
											<th>Created Date</th><th>Close Date</th>
											<th>Created By</th><th>Remarks</th>
											
										</tr>
									  </thead>
									  <tbody>
									  <?php  
									   if(mysqli_num_rows($sql)>0){
									     while($sql_result = mysqli_fetch_assoc($sql)){
                                           $id = $sql_result['id'];											 
									       if($sql_result['ticket_status']==1){
											   $ticket_status = "Active";
										   }
										   if($sql_result['ticket_status']==0){
											   $ticket_status = "Close";
										   }
									  ?>
										<tr>
											<td><?php echo $sql_result['created_date'];?></td><td><?php echo $sql_result['close_date'];?></td>
											<td><?php echo $sql_result['created_by'];?></td><td><?php echo $sql_result['remarks'];?></td>
											
										</tr>
										
									   <?php }} ?>
									  </tbody>
									</table>
								  </div>
								</div>
							 </div>
							
