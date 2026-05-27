<?php include('db_connection.php'); 
$con = OpenCon();

//$path ="C:\Users\css.WIN-IFIBER012\Desktop\Server_socket\New_Record";
$id = $_REQUEST['id'];

$sql = mysqli_query($con,"select down_time_history from dvr_health_site_monthwise_hour where id='".$id."'");

		 ?>

<div class="table-responsive">
                    <table id="order-listing" class="table">
                      <thead >
                        <tr>
						    <th>S.N</th>
							<th>Down Time</th>
							<th>UpTime</th>
							<th>Total Down Time</th>
							                        
                        </tr>
                      </thead>
                      <tbody>
					    <?php 
                        $count = 0; 
						 if(mysqli_num_rows($sql)){
							 
							$sql_result = mysqli_fetch_assoc($sql);
							$down_time_history = json_decode($sql_result['down_time_history']);
							//echo '<pre>';print_r($down_time_history);echo '</pre>';die;
							//for($i=0;$i<count($down_time_history);$i++){
								foreach($down_time_history as $down){
									$count = $count + 1; 
									$number = $down->diff_hours;
                                    $total_dwn_time = number_format((float)$number, 2, '.', '');
                        ?>
                                <tr>
							   <td><?php echo $count;?></td>
							   <td><?php echo $down->down_rectime;?></td><td><?php echo $down->up_rectime;?></td><td><?php echo $total_dwn_time;?></td>
                        <?php    }
						 }

CloseCon($con); ?>
</tbody>
                    </table>
                  </div>