<?php session_start();include('db_connection.php');$con = OpenCon(); ?>
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
   $atmid = "";
if(isset($_GET['bank'])){
$bank = $_GET['bank'];
}
if(isset($_GET['atmid'])){
$atmid = $_GET['atmid'];
}
if(isset($_GET['circle'])){
$circle = $_GET['circle'];
}
$user = $_GET['user'];
$status = $_GET['Status'];
$con = OpenCon();
//$status = "all";

if($atmid!=''){
	if($status=='all'){
$sql = mysqli_query($con,"select * from theft_ticket_raise where atmid='".$atmid."' order by id desc"); 		
	}else{
//$sql = mysqli_query($con,"select * from footage_request where atmid='".$atmid."' and status='".$status."' order by id desc"); 
	}

}else{
	if($bank!=''){
		if($circle!=''){
				$circlesql = mysqli_query($con,"select ATMID from site_circle where Circle='".$circle."'");
				$circleatmidarray = [];
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
		//array_push($atmidarray,(string)$atmid);
		$_is_atmid = $sitesql_result['ATMID'];
		if(count($_circle_name_array)==0){
			$atmidarray[] = $_is_atmid;
		}else{
			if(in_array($_is_atmid,$_circle_name_array)){
			   $atmidarray[] = $_is_atmid;
			}
		}
	}
	$atmidarray=json_encode($atmidarray);
	$atmidarray=str_replace( array('[',']','"') , ''  , $atmidarray);
	$arr=explode(',',$atmidarray);
	$atmidarray = "'" . implode ( "', '", $arr )."'";
	if($status=='all'){
		$onlinetestsql = "SELECT * FROM theft_ticket_raise WHERE atmid IN (".$atmidarray.") order by id desc";
	}else{
	  //  $onlinetestsql = "SELECT * FROM footage_request WHERE atmid IN (".$atmidarray.") and status='".$status."' order by id desc";
	}
    $sql = mysqli_query($con,$onlinetestsql);
}

?>


<div class="table-responsive">
                    <table id="order-listing" class="table">
                      <thead>
                        <tr>
						    <th>ID</th>
							<th>ATMID</th>
							<th>Incident</th>
							<th>Incident Date</th>
							<th>Remarks</th>
							<th>View PDF</th>
							<?php if($user=='comfort'){  ?>
							<th>Upload PDF</th>
							<?php } ?>				
													  
						</tr>
                      </thead>
                      <tbody>
					    <?php 
                        $count = 1 ; 
						if(!$sql || mysqli_num_rows($sql)==0){
							
						}else{
						 
							  while($sql_result = mysqli_fetch_assoc($sql)){
                                $_status = $sql_result['status'];
								$_id = $sql_result['id'];
								$_pdf = $sql_result['file'];
                        ?>
							   <tr>
							        <td><?php echo $_id;?></td>
							        <td><?php echo $sql_result['atmid'];?></td>
								    <td><?php echo $sql_result['incident'];?></td>
									<td><?php echo $sql_result['incident_date'];?></td>
								    <td><?php echo $sql_result['remarks'];?></td>
								    <td>
									<?php if($_pdf!=""){?><a class="btn btn-info" target="_blank" href="<?php echo $_pdf;?>">View PDF</a><?php }else{ echo 'PDF Not Uploaded';} ?>
									</td>
									<?php if($user=='comfort'){  ?>
								    <td>
									<?php if($_pdf ==""){ ?> <a class="btn btn-info" href="update_theft_history.php?id=<?php echo $_id;?>">Upload PDF</a> <?php  }?>
									</td>
									<?php } ?>
                  
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

