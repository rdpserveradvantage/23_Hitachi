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
}
if(isset($_GET['atmid'])){
$atmid = $_GET['atmid'];
}
if(isset($_GET['circle'])){
$circle = $_GET['circle'];
}

if($atmid!=''){
        $sql = mysqli_query($con,"select * from sites where ATMID='".$atmid."' and Bank='".$bank."' and live='Y'");
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
				$sql = mysqli_query($con,"select * from sites where Customer='".$client."' and Bank='".$bank."' and ATMID IN (".$circleatmidarray.") and live='Y'");	
			}else{
		        $sql = mysqli_query($con,"select * from sites where Customer='".$client."' and Bank='".$bank."' and live='Y'");
			}  
    }else{
		$sql = mysqli_query($con,"select * from sites where Customer='".$client."' and Bank IN (".$_bank_name.") and live='Y'");
	}
}
?>
<div class="table-responsive">
                    <table id="order-listing" class="table">
                      <thead >
                         <tr>
						   <?php if($_user_id==1){?>
                            <th>Action</th>
							<th>Update Remark</th>
							<th>Upload Images</th>
							 <th>Delete</th>
						   <?php }?>	
						    <th>View Uploaded Images</th>
							
							<th>ATMID</th>
                            <th>ATMID 2</th>
                            <th>ATMID 3</th>
                            <th>ATMID 4</th>
                            <th>Tracker No.</th>
                            <th>ATM ShortName</th>
                            <th>Phase</th>
                            <th>Status</th>
                            <th>Old Panel ID</th>
                            <th>New Panel ID</th>
                            <th>DVR IP</th>
							<?php if($_user_id==1){?>
                           <!-- <th>DVR Name</th>-->
							<?php }?>	
                            <th>Panel IP</th>
                           <!-- <th>DVR Model Number</th>
                            <th>Router Model Number</th> -->
                            <th>Engineer Name</th>
                            <th>Customer</th>
                            <th>Bank</th>
                            <th>Site Address</th>
                            <th>State</th>
                            <th>City</th>
							<th>Zone</th>
                            <!--<th>Panel Make</th>-->
                            <th>Live</th><th>Live Date</th>
                            <th>UserName</th>
                            <th>Password</th>
                            <!--<th>Remark</th>-->
                        </tr>
                      </thead>
                      <tbody>
					    <?php 
                        $i=1;
						if(mysqli_num_rows($sql)>0){
                      while($sql_result=mysqli_fetch_assoc($sql)) {
						$atm_id = $sql_result['ATMID'];
						$_view = 0;
						if(count($_circle_name_array)==0){
							$_view = 1;
						}else{
							if(in_array($atm_id,$_circle_name_array)){
							   $_view = 1;
							}
						}
						if($_view == 1){
						  $uploadimageatmid = $sql_result['ATMID'];
						  $atmuploadimages = mysqli_query($con,"select link from atm_upload_images where atmid='".$uploadimageatmid."'");
						  if (!$atmuploadimages || mysqli_num_rows($atmuploadimages) == 0){$totalimageupload=0;}else{
						  $totalimageupload = mysqli_num_rows($atmuploadimages);
						  }
                      ?>
                            <tr>
							    <?php if($_user_id==1){?>
                                <td> <a target="_blank" href="updatesite.php?id=<?=$sql_result['SN']?>" class="btn <?php if($totalimageupload>0){ echo 'btn-success';}else{ echo 'btn-primary';}?>" id="Button">Edit</a> </td>
								<td> <a target="_blank" href="update_site_remark.php?id=<?=$sql_result['SN']?>" class="btn btn-primary" id="Button">Update Remark</a> </td>
								<td> <a target="_blank" href="upload_atm_pic.php?atmid=<?=$sql_result['ATMID']?>" class="btn <?php if($totalimageupload>0){ echo 'btn-success';}else{ echo 'btn-primary';}?>" id="Button_Upload">Upload</a> </td>
								<td> <?php if($totalimageupload>0){?><a target="_blank" href="viewatmuploadimages.php?atmid=<?=$sql_result['ATMID']?>" class="btn <?php if($totalimageupload>0){ echo 'btn-success';}else{ echo 'btn-primary';}?>" id="Button_Delete">Delete</a> <?php }else{ echo '-';}?> </td>
								<?php }?>
								<td> <?php if($totalimageupload>0){?> <a target="_blank" href="atm_upload_files.php?atmid=<?=$sql_result['ATMID']?>" class="btn <?php if($totalimageupload>0){ echo 'btn-success';}else{ echo 'btn-primary';}?>" id="Button">View</a><?php }else{ echo '-';}?> </td>
								<td><?php echo $sql_result['ATMID'] ?></td>
                                <td><?php echo $sql_result['ATMID_2'] ?></td>
								<td><?php echo $sql_result['ATMID_3'] ?></td>
								<td><?php echo $sql_result['ATMID_4'] ?></td>
								<td><?php echo $sql_result['TrackerNo'] ?></td>
                                <td><?php echo $sql_result['ATMShortName'] ?></td>
                                <td><?php echo $sql_result['Phase'] ?></td>
								<td><?php echo $sql_result['Status'] ?></td>
								<td><?php echo $sql_result['OldPanelID'] ?></td>
                                <td><?php echo $sql_result['NewPanelID'] ?></td>
                                <td><?php echo $sql_result['DVRIP'] ?></td>
								<?php if($_user_id==1){?>
                                <!--<td><?php // echo $sql_result['DVRName'] ?></td>-->
								<?php }?>
                                <td><?php echo $sql_result['PanelIP'] ?></td>
                                <!--<td><?php //echo $sql_result['DVR_Model_num'] ?></td>-->
                                <!--<td><?php //echo $sql_result['Router_Model_num'] ?></td> -->
                                <td><?php echo $sql_result['eng_name'] ?></td>
                                <td><?php echo $sql_result['Customer'] ?></td>
                                <td><?php echo $sql_result['Bank'] ?></td>
                                <td><?php echo $sql_result['SiteAddress'] ?></td>
                                <td><?php echo $sql_result['State'] ?></td>
                                <td><?php echo $sql_result['City'] ?></td>
                                <td><?php echo $sql_result['Zone'] ?></td>
								<!--<td><?php //echo $sql_result['Panel_Make'] ?></td> -->
                                <td><?php echo $sql_result['live'] ?></td><td><?php echo $sql_result['live_date'] ?></td>
                                <td><?php echo $sql_result['UserName'] ?></td>
                                <td><?php echo $sql_result['Password'] ?></td>
                              <!--  <td><?php //echo $sql_result['site_remark'] ?></td> -->


                            </tr>
					  <?php $i++; }} }?>
                      </tbody>
                    </table>
                  </div>

<?php CloseCon($con);?>