<?php session_start();include('db_connection.php'); ?>
<?php 
$con = OpenCon();
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


   $bank = "";$circle = "";
   $atmid = "";
if(isset($_GET['bank'])){
$bank = $_GET['bank'];
}
if(isset($_GET['circle'])){
$circle = $_GET['circle'];
}
if(isset($_GET['atmid'])){
$atmid = $_GET['atmid'];
}
$user = $_GET['user'];
$status = $_GET['Status'];


if($atmid!=''){
	if($status=='all'){
$sql = mysqli_query($con,"select * from footage_request where atmid='".$atmid."' order by id desc"); 		
	}else{
$sql = mysqli_query($con,"select * from footage_request where atmid='".$atmid."' and status='".$status."' order by id desc"); 
	}

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
				$sitesql = mysqli_query($con,"select ATMID from sites where Customer='".$client."' and Bank='".$bank."' and ATMID IN (".$circleatmidarray.") and live='Y'");	
			}else{
		        $sitesql = mysqli_query($con,"select ATMID from sites where Customer='".$client."' and Bank='".$bank."' and live='Y'");
			} 
	  
	}else{
		$sitesql = mysqli_query($con,"select ATMID from sites where Customer='".$client."' and Bank IN (".$_bank_name.") and live='Y'");
	}
	//$atmidarray = [];
	while($sitesql_result = mysqli_fetch_assoc($sitesql)){
		//$atmidarray[] = $sitesql_result['ATMID'];
		$_is_atmid = $sitesql_result['ATMID'];
		if(count($_circle_name_array)==0){
			$atmidarray[] = $_is_atmid;
		}else{
			if(in_array($_is_atmid,$_circle_name_array)){
			   $atmidarray[] = $_is_atmid;
			}
		}
		//array_push($atmidarray,(string)$atmid);
	}
	$atmidarray=json_encode($atmidarray);
	$atmidarray=str_replace( array('[',']','"') , ''  , $atmidarray);
	$arr=explode(',',$atmidarray);
	$atmidarray = "'" . implode ( "', '", $arr )."'";
	if($status=='all'){
		$onlinetestsql = "SELECT * FROM footage_request WHERE atmid IN (".$atmidarray.") order by id desc";
	}else{
	    $onlinetestsql = "SELECT * FROM footage_request WHERE atmid IN (".$atmidarray.") and status='".$status."' order by id desc";
	}
    $sql = mysqli_query($con,$onlinetestsql);
}

?>


<div class="table-responsive">
                    <table id="order-listing" class="table">
                      <thead>
                        <tr>
							<th>ATMID</th>
                            <th>Card No.</th>
                            <th>Date of Transaction</th>
                            <th>Time of Transaction</th>
                            <th>Nature of Transaction</th>
                            <th>Amount of Transaction</th>
                            <th>Transaction No.</th>
                            <th>Complaint No.</th>
                            <th>Complaint Date</th>
                            <th>Claim Date</th> 
                            <th>Action</th> 
													  
						</tr>
                      </thead>
                      <tbody>
					    <?php 
                        $count = 1 ; 
						  if(mysqli_num_rows($sql)>0){
							  while($sql_result = mysqli_fetch_assoc($sql)){
                                $_status = $sql_result['status']; 
								$_id = $sql_result['id'];
                        ?>
							   <tr>
							        <td><?php echo $sql_result['atmid'];?></td>
								    <td><?php echo $sql_result['card_no'];?></td>
								    <td><?php echo $sql_result['date_of_TXN'];?></td>
								    <td><?php echo $sql_result['time_of_TXN'];?></td>
								    <td><?php echo $sql_result['nature_of_TXN'];?></td>
								    <td><?php echo $sql_result['amount_of_TXN'];?></td>
								    <td><?php echo $sql_result['txn_no'];?></td>
								    <td><?php echo $sql_result['complaint_no'];?></td>
								    <td><?php echo $sql_result['complaint_date'];?></td>
								    <td><?php echo $sql_result['claim_date'];?></td>
								    <td>
									<?php if($_status==0){ if($user=='comfort'){ ?> <a class="btn btn-info" href="footage_request_1_edit.php?id=<?php echo $_id;?>">Process</a> <?php } }?>
									<a class="btn btn-info" href="footage_request_details.php?id=<?php echo $_id;?>">View/Update Status</a>
									</td>
                  
								</tr>
								
						<?php }
						  }
						?>
                      </tbody>
                    </table>
                  </div>

<?php
CloseCon($con);

?>

