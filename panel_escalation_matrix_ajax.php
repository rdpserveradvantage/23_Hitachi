<?php 
//include('config.php');
include('db_connection.php'); 
$con = OpenCon();
$atmid = $_GET['atmid'];
$type = $_GET['type'];
if($type==1){
	$sql = mysqli_query($con,"select * from escalation_matrix where type='two_way' and atmid='".$atmid."'");
}
if($type==2){
	$sql = mysqli_query($con,"select * from escalation_matrix where type='bank' and atmid='".$atmid."'");
}
if($type==3){
	$sql = mysqli_query($con,"select * from escalation_matrix where type='hk' and atmid='".$atmid."'");
}
if($type==4){
	$sql = mysqli_query($con,"select * from escalation_matrix where type='service' and atmid='".$atmid."'");
}
if($type==5){
	$sql = mysqli_query($con,"select * from escalation_matrix where type='ra' and atmid='".$atmid."'");
}
if($type==6){
	$sql = mysqli_query($con,"select * from escalation_matrix where type='police' and atmid='".$atmid."'");
}

?>
<div class="row">
			<div class="col-12">
			  <div class="table-responsive">
				<table id="order-listing3" class="table order-listing3">
				  <thead>
					<tr>
						<th>SrNo</th><th>Name</th><th>Designation</th>
						<th>Telephone</th><th>Mobile</th><th>Email</th>
						<th>Priority</th><th>Interval</th><th>Repeat Interval</th>
					</tr>
				  </thead>
				  <tbody>
				         <?php  
									   if(mysqli_num_rows($sql)>0){
										   $cnt = 0;
									     while($sql_result = mysqli_fetch_assoc($sql)){
											 $cnt = $cnt + 1;
                                           
									  ?>
										<tr>
											<td><?php echo $cnt;?></td><td><?php echo $sql_result['name'];?></td><td><?php echo $sql_result['designation'];?></td>
											<td><?php echo $sql_result['telephone'];?></td><td><?php echo $sql_result['mobile'];?></td><td><?php echo $sql_result['email'];?></td>
											<td><?php echo $sql_result['priority'];?></td><td><?php echo $sql_result['once_interval'];?></td><td><?php echo $sql_result['repeat_interval'];?></td>
										</tr>
										
									   <?php }} ?>
				  </tbody>
				</table>
			  </div>
			</div>
		  </div>
	<?php CloseCon($con);?>						
							
