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
				$net_sql = "SELECT * FROM `network_history` WHERE site_id IN (SELECT SN from sites WHERE Customer='Hitachi' AND Bank='PNB' AND atmid IN (".$circleatmidarray.") AND live='Y') AND device='D' AND status='OK' AND rectime >= SUBDATE( NOW(), INTERVAL 24 HOUR) GROUP BY site_id";
		        $sql = mysqli_query($con, $net_sql);
	
				//$sql = mysqli_query($con,"select * from ticket_raise where client='".$client."' and atmid IN (".$circleatmidarray.")");	
			}else{
				$net_sql = "SELECT * FROM `network_history` WHERE site_id IN (SELECT SN from sites WHERE Customer='Hitachi' AND Bank='PNB' AND atmid IN (".$_bank_name_array.") AND live='Y') AND device='D' AND status='OK' AND rectime >= SUBDATE( NOW(), INTERVAL 24 HOUR) GROUP BY site_id";
		        $sql = mysqli_query($con, $net_sql);
				//$sql = mysqli_query($con,"select * from ticket_raise where client='".$client."' and atmid IN (".$_bank_name_array.")");
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
							<th>Status</th>
						</tr>
                      </thead>
                      <tbody>
					    <?php  
						   if(mysqli_num_rows($sql)>0){
							 while($sql_result = mysqli_fetch_assoc($sql)){
								 $SN = $sql_result['site_id'];
								 $site_sql = mysqli_query($con, "SELECT ATMID,SiteAddress from sites WHERE SN='".$SN."'");
								 $site_sql_result = mysqli_fetch_assoc($site_sql);
								$atm_id = $site_sql_result['ATMID'];
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
								  
						  ?>
							<tr>
								<td><?php echo $site_sql_result['ATMID'];?></td><td><?php echo $site_sql_result['SiteAddress'];?></td>
								<td><?php echo 'Online';?></td>
							</tr>
							
								<?php } }} ?> 
					    
                      </tbody>
                    </table>
                  </div>

<?php CloseCon($con);?>