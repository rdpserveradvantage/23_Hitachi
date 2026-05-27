<?php include('db_connection.php'); 
      session_start();
	  $_user_id = $_SESSION['access'];
?>
<?php 
$client = $_GET['client'];
$bank = $_GET['bank'];
$atmid = $_GET['atmid'];
$con = OpenCon();
if($atmid!=''){
$sql = mysqli_query($con,"select * from dvronline where ATMID='".$atmid."' and Bank='".$bank."'");
}else{
$sql = mysqli_query($con,"select * from dvronline where customer='".$client."' and Bank='".$bank."'");	
}
?>
<div class="table-responsive">
                    <table id="order-listing" class="table">
                      <thead >
                         <tr>
						   <?php if($_user_id==1){?>
                            <!--<th>Action</th>-->
						   <?php }?>	
							<th>ATMID</th>
							<th>Site Address</th>
                            <th>Location</th>
							<th>State</th>
                            <th>IP Address</th>
                            <th>Rourt ID</th>
                            <th>Live Date</th>
							<th>UserName</th>
                            <th>Password</th>
                            <th>Status</th>
                            <th>DVR Name</th>
                            <th>Customer</th>
                            <th>Bank</th>
                            <th>Action</th>
                        </tr>
                      </thead>
                      <tbody>
					    <?php 
                        $i=1;
						if(mysqli_num_rows($sql)>0){
                      while($sql_result=mysqli_fetch_assoc($sql)) {
                      ?>
                            <tr>
							    <?php if($_user_id==1){?>
                                <!--<td> <a href="updatesite.php?id=<?=$sql_result['id']?>" class="btn btn-primary" id="Button">Edit</a> </td>-->
								<?php }?>
								<td><?php echo $sql_result['ATMID'] ?></td>
                                <td><?php echo $sql_result['Address'] ?></td>
                                <td><?php echo $sql_result['Location'] ?></td>
                                <td><?php echo $sql_result['State'] ?></td>
								<td><?php echo $sql_result['IPAddress'] ?></td>
								<td><?php echo $sql_result['Rourt ID'] ?></td>
                                <td><?php echo $sql_result['Live Date'] ?></td>
                                <td><?php echo $sql_result['UserName'] ?></td>
                                <td><?php echo $sql_result['Password'] ?></td>
                                <td><?php echo $sql_result['Status'] ?></td>
                                <td><?php echo $sql_result['dvrname'] ?></td>
                                <td><?php echo $sql_result['customer'] ?></td>
                                <td><?php echo $sql_result['Bank'] ?></td>
                                <td><a href="upload_atm_pic.php?atmid=<?php echo $sql_result['ATMID'] ?>"></a></td>

                            </tr>
						<?php $i++; } }?>
                      </tbody>
                    </table>
                  </div>

<?php CloseCon($con);?>