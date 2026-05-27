<?php include('config.php'); ?>
<?php 
// $Loginid = $_GET['loginid'];
$sql=mysqli_query($con,"select * from loginusers " );
//echo json_encode($sql_result);
?>
               
					    <?php  
						  if(mysqli_num_rows($sql)>0)
                            {
							  while($sql_result = mysqli_fetch_assoc($sql)){ 

                                if($sql_result['currentstatus']=='0'){
									$_status = 'Active';
								}
                                else{
                                    $_status = 'Closed';
                            }
							  ?>
							   <tr>
							    <td><?php echo $sql_result['id'];?></td>
                                <td><?php echo $sql_result['name'];?></td>
                                <td><?php echo $_status;?></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td><?php echo $_status;?></td>
								</tr>
						<?php }
						  }
						?>
                     
                   


