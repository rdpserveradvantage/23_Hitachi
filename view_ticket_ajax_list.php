<?php include('db_connection.php'); $con = OpenCon();
      session_start();
	  $_user_id = $_SESSION['access'];
?>
<?php 
$client = $_GET['client'];
$banks = explode(",",$_SESSION['bankname']);
       $_bank_name = [];
       for($i=0;$i<count($banks);$i++){
		   $_bank = explode("_",$banks[$i]);
		   if($_bank[0]==$client){
			   array_push($_bank_name,$_bank[1]);
		   }
	   } 
	    $_bank_name=json_encode($_bank_name);
		$_bank_name=str_replace( array('[',']','"') , ''  , $_bank_name);
		$bankarr=explode(',',$_bank_name);
		$_bank_name = "'" . implode ( "', '", $bankarr )."'";
		
		$_circle_name = "";
		$_circle_name_array = array();
		if($_SESSION['circlename']!=''){
		    $assign_circle = explode(",",$_SESSION['circlename']);
		    $_circle_name = [];
			for($i=0;$i<count($assign_circle);$i++){
			   $_circle = explode("_",$assign_circle[$i]);
			   array_push($_circle_name,$_circle[1]);
			} 
			//$_circle_name = $_circle_name_array;
			$_circle_name=json_encode($_circle_name);
			$_circle_name=str_replace( array('[',']','"') , ''  , $_circle_name);
			$circlearr=explode(',',$_circle_name);
			$_circle_name = "'" . implode ( "', '", $circlearr )."'";

			$site_circlesql = mysqli_query($con,"select ATMID from site_circle where Circle IN (".$_circle_name.")");	
			while($site_circlesql_result = mysqli_fetch_assoc($site_circlesql)){
					$_circle_name_array[] = $site_circlesql_result['ATMID'];
					
				}		
		}

   $bank = "";
   $atmid = "";$circle = "";
if(isset($_GET['bank'])){
    $bank = $_GET['bank'];
    $site_banksql = mysqli_query($con,"select ATMID from sites where Bank ='".$bank."'");	
	while($site_banksql_result = mysqli_fetch_assoc($site_banksql)){
			$_bank_name_array[] = $site_banksql_result['ATMID'];
	}
    $_bank_name_array=json_encode($_bank_name_array);
	$_bank_name_array=str_replace( array('[',']','"') , ''  , $_bank_name_array);
	$bank_namearr=explode(',',$_bank_name_array);
	$_bank_name_array = "'" . implode ( "', '", $bank_namearr )."'";	
}else{
	$site_banksql = mysqli_query($con,"select ATMID from sites where Bank IN (".$_bank_name.")");	
	while($site_banksql_result = mysqli_fetch_assoc($site_banksql)){
			$_bank_name_array[] = $site_banksql_result['ATMID'];
	}
    $_bank_name_array=json_encode($_bank_name_array);
	$_bank_name_array=str_replace( array('[',']','"') , ''  , $_bank_name_array);
	$bank_namearr=explode(',',$_bank_name_array);
	$_bank_name_array = "'" . implode ( "', '", $bank_namearr )."'";	
}
if(isset($_GET['atmid'])){
$atmid = $_GET['atmid'];
}
if(isset($_GET['circle'])){
$circle = $_GET['circle'];
}

if($atmid!=''){
        $sql = mysqli_query($con,"select * from ticket_raise where atmid='".$atmid."'");
}else{
	if($bank!=''){
	    if($circle!=''){
				$circlesql = mysqli_query($con,"select ATMID from site_circle where Circle='".$circle."'");
				while($circlesql_result = mysqli_fetch_assoc($circlesql)){
					$circleatmidarray[] = $circlesql_result['ATMID'];
					
				}
				$circleatmidarray=json_encode($circleatmidarray);
				$circleatmidarray=str_replace( array('[',']','"') , ''  , $circleatmidarray);
				$circlearr=explode(',',$circleatmidarray);
				$circleatmidarray = "'" . implode ( "', '", $circlearr )."'";
				$sql = mysqli_query($con,"select * from ticket_raise where client='".$client."' and atmid IN (".$circleatmidarray.")");	
			}else{
		        $sql = mysqli_query($con,"select * from ticket_raise where client='".$client."' and atmid IN (".$_bank_name_array.")");
			}  
    }else{
		$sql = mysqli_query($con,"select * from ticket_raise where client='".$client."' and atmid IN (".$_bank_name_array.")");
	}
}
?>
<div class="table-responsive">
                    <table id="order-listing" class="table">
                      <thead >
                         <tr>
							<th>ATMID</th><th>Location</th>
							<th>Client</th><th>Ticket Status</th>
							<th>Created Date</th><th>Close Date</th>
							<th>Alert Type</th><th>DVR IP</th>
							<th>Alarm Type</th><th>Remarks</th>
							<th>Action</th>
						</tr>
                      </thead>
                      <tbody>
					    <?php  
						   if(mysqli_num_rows($sql)>0){
							 while($sql_result = mysqli_fetch_assoc($sql)){
								$atm_id = $sql_result['atmid'];
								$_view = 0;
								if(count($_circle_name_array)==0){
									$_view = 1;
								}else{
									if(in_array($atm_id,$_circle_name_array)){
									   $_view = 1;
									}
								}
								if($_view == 1){
								   $id = $sql_result['id'];											 
								   if($sql_result['ticket_status']==1){
									   $ticket_status = "Pending";
								   }
								   if($sql_result['ticket_status']==0){
									   $ticket_status = "Close";
								   }
						  ?>
							<tr>
								<td><?php echo $sql_result['atmid'];?></td><td><?php echo $sql_result['location'];?></td>
								<td><?php echo $sql_result['client'];?></td><td><?php echo $ticket_status;?></td>
								<td><?php echo $sql_result['created_date'];?></td><td><?php echo $sql_result['close_date'];?></td>
								<td><?php echo $sql_result['alert_type'];?></td><td><?php echo $sql_result['dvr_ip'];?></td>
								<td><?php echo $sql_result['alarm_type'];?></td><td><?php echo $sql_result['remarks'];?></td>
								<td>
								<?php if($ticket_status=='Pending'){?>
								<button type="button" class="btn btn-primary btn-sm small-modal" data-id="<?php echo $id;?>" data-toggle="modal" data-target="#smallModal">Update<i class="fa fa-play-circle ml-1"></i></button>
								<?php }?>
								<button type="button" class="btn btn-primary btn-sm large-modal" data-id="<?php echo $id;?>" data-toggle="modal" data-target="#largeModal">View Ticket History<i class="fa fa-play-circle ml-1"></i></button>
								</td>
							</tr>
							
								<?php } }} ?> 
					    
                      </tbody>
                    </table>
                  </div>

<?php CloseCon($con);?>