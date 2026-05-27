<?php include('config.php'); ?>
<?php 
$atmid = $_GET['atmid'];
$type = $_GET['type'];
if($type=='all'){
$sql=mysqli_query($con,"select * from escalation_matrix where atmid='".$atmid."'" );
}else{
	$sql=mysqli_query($con,"select * from escalation_matrix where atmid='".$atmid."' and type='".$type."'" );
}
?>
<div class="table-responsive">
                    <table id="order-listing" class="table">
                    <thead>

                        <tr>
                            
                           <!-- <th>Action</th> -->
                            <th>ID</th>
                            <th>Type</th>
                            <th>Name</th>
                            <th>Designation</th>
                            <th>Mobile</th>
                            <th>Landline</th>
                            <th>Email</th>
                            <th>Escalation Email</th>
                            <th>Priority</th> 
                            <th>Duration</th>                            
                            <th>RrepeatInterval</th>                             

                        </tr>
                    </thead>
                    <tbody >
    <?php  
        if(mysqli_num_rows($sql)>0)
        { while($sql_result = mysqli_fetch_assoc($sql)){ 
            ?>
            <tr>
            <!-- <td> <a href="" class="btn btn-primary" id="Button">Edit</a> </td> -->
            <!--<td></td>-->
            <td><?php echo $sql_result['atmid'];?></td>
            <td><?php echo $sql_result['type'];?></td>
            <td><?php echo $sql_result['name'];?></td>
            <td><?php echo $sql_result['designation'];?></td>
            <td><?php echo $sql_result['mobile'];?></td>
            <td><?php echo $sql_result['telephone'];?></td>
            <td><?php echo $sql_result['email'];?></td>
            <td><?php echo $sql_result['email'];?></td>
            <td><?php echo $sql_result['priority'];?></td>
            <td><?php echo $sql_result['once_interval'];?></td>
            <td><?php echo $sql_result['repeat_interval'];?></td>
            </tr>
    <?php }
        }
    ?>
	</tbody>
                    </table>
                    </div>
