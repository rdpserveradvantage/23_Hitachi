<!DOCTYPE html>
<html lang="en">
    <?php include('head.php');?>
	<style>
		.bt{
				border-top: 1px solid #1e1f33;
		  }
		  .br
		  {
				border-right: 1px solid #282844;
		  }
		   div.card-body {
		
			overflow-x: scroll;
		}
	</style>
	<style>
		.menu-icon
		{
			width: 33px;
			margin-right: 7%;
		}
	</style>
                            
    <?php include('top-navbar.php');?>
            <div class="container-fluid page-body-wrapper">
                
                <?php include('navbar.php');?>
                <!-- partial -->
				
				<?php 
                  //  include('panel_health_data.php');
                 ?>
				 <?php 
				 $con = OpenCon();
				 $id=$_GET['id'];
				 $sql=mysqli_query($con,"select * from sites where SN='".$id."'");
				 $sql_result=mysqli_fetch_assoc($sql);

				 $SN= $sql_result['SN'];
				 $ATMID= $sql_result['ATMID'];
				 $ATMID_2= $sql_result['ATMID_2'];
				 $ATMID_3= $sql_result['ATMID_3'];
				 $ATMID_4= $sql_result['ATMID_4'];

				 $ATMShortName= $sql_result['ATMShortName'];
				 $siteAddress= $sql_result['SiteAddress'];
				 $Customer= $sql_result['Customer'];
				 $Bank= $sql_result['Bank'];
				//  echo $Bank;die;
				 $TrackerNo= $sql_result['TrackerNo'];
				 $Zone = $sql_result['Zone'];
				 $City= $sql_result['City'];
				 $State= $sql_result['State'];
				 $Panel_Make = $sql_result['Panel_Make'];
				 $OldPanel = $sql_result['OldPanelID'];
				 $NewPanel = $sql_result['NewPanelID'];
				 $DVRIP = $sql_result['DVRIP'];
				 $PanelIP = $sql_result['PanelIP'];
				 $DVRName = $sql_result['DVRName'];
				 $DVR_Model_num = $sql_result['DVR_Model_num'];
				 $Router_Model_num = $sql_result['Router_Model_num'];
				 $Phase = $sql_result['Phase'];
				 $Status= $sql_result['Status'];
				 $UserName=$sql_result['UserName'];
				 $Password=$sql_result['Password'];
				//  $mailreceive_dt=$sql_result['mailreceive_dt'];

				 $live = $sql_result['live'];
				 $eng_name = $sql_result['eng_name'];
				 $site_remark = $sql_result['site_remark'];
				 $RouterIp = $sql_result['RouterIp'];

				 ?>
					

                <div class="main-panel">
                    <div class="content-wrapper">
                        <div class="page-header">
																							
							<h3 class="page-title">
							  Update Site
							</h3>
							
						  </div>
								<div class="col-12 grid-margin">
									<div class="card">
										<div class="card-body">
										  
										  <form class="form-sample" id="forms" action="updatesite_process.php" method="POST" enctype="multipart/form-data" onsubmit="return finalval()">
										  <input type="hidden" name="SN" value="<?php echo $_GET['id']; ?>" >
											<div class="row">
											 
											  <div class="col-md-4">
												<div class="form-group row">
												  <label class="col-sm-3 col-form-label">Status</label>
												  <div class="col-sm-9">
													<select class="form-control" name="Status" id="Status">
														<option value="E-Surveillance - CSS">E-Surveillance - CSS </option>
													</select>
												  </div>
												</div>
											  </div>
											  <div class="col-md-4">
												<div class="form-group row">
												  <label class="col-sm-3 col-form-label">Phase</label>
												  <div class="col-sm-9">
													<select name="Phase" id="Phase"  class="form-control">
													  <option>Phase 1</option>
													  <option>Phase 2</option>
														<option>Phase 3</option>
													  <option>Phase 4</option>
														<option>Phase 5</option>
													  <option>Phase 6</option>
														<option>Phase 7</option>
													  <option>Phase 8</option>
														<option>Phase 9</option>
													  <option>Phase 10</option>
													</select>
												  </div>
												</div>
											  </div>
											  <div class="col-md-4">
												<div class="form-group row">
												  <label class="col-sm-3 col-form-label">Router IP</label>
												  <div class="col-sm-9">
													<input type="text" class="form-control" name="RouterIp" id="RouterIp" value="<?=$RouterIp?>"/>
												  </div>
												</div>
											  </div>
											</div>  
											<div class="row">
											 <div class="col-md-4">
												<div class="form-group row">
												  <label class="col-sm-3 col-form-label">Client</label>
												  <div class="col-sm-9">
													<select class="form-control" name="Customer" id="Customer">
														<?php 
														    $cust="select name from customer";
														    $runcust=mysqli_query($con,$cust);
															if(mysqli_num_rows($runcust))
															{
														        while($rowcust = mysqli_fetch_array($runcust))
													            {
														             if($Customer==$rowcust['name']){ 		   
														?>
														<option value="<?php echo $rowcust['name'];?>" <?php if($Customer==$rowcust['name']){ echo 'selected';}?>><?php echo $rowcust['name']; ?></option>
															   
														   <?php } } } ?>
													</select>
												  </div>
												</div>
											  </div>
											
											  <div class="col-md-4">
												<div class="form-group row">
												  <label class="col-sm-3 col-form-label">Bank</label>
												  <div class="col-sm-9">
													<select class="form-control" name="Bank" id="Bank" readonly>
													  
														<?php 
														 $bank="select name from bank";
														 
																 $runbank=mysqli_query($con,$bank);
																 if(mysqli_num_rows($runbank)){
														 while($rowbank = mysqli_fetch_array($runbank))
													   {  
														  if($Bank==$rowbank['name']){ 
														 ?>
														<option value="<?php echo $rowbank['name'];?>" <?php if($Bank==$rowbank['name']){ echo 'selected';}?> > <?php echo $rowbank['name']; ?>
														</option>
															   <br/>
														  <?php } } } ?>
													</select>
												  </div>
												</div>
											  </div> 
											  <div class="col-md-4">
												<div class="form-group row">
												  <label class="col-sm-3 col-form-label">ATMID</label>
												  <div class="col-sm-9">
													<input type="text" class="form-control" value="<?=$ATMID?>" name="ATMID" id="ATMID" onblur="checkpanel()">
												  </div>
												</div>
											  </div>
											</div>
										    
											<div class="row">
											  <div class="col-md-4">
												<div class="form-group row">
												  <label class="col-sm-3 col-form-label">ATMID_2</label>
												  <div class="col-sm-9">
													<input type="text" class="form-control" value="<?=$ATMID_2?>" name="ATMID_2" id="ATMID_2" />
												  </div>
												</div>
											  </div>
											  <div class="col-md-4">
												<div class="form-group row">
												  <label class="col-sm-3 col-form-label">ATMID_3</label>
												  <div class="col-sm-9">
													<input type="text" class="form-control"  name="ATMID_3" id="ATMID_3" value="<?=$ATMID_3?>" />
												  </div>
												</div>
											  </div>
											  <div class="col-md-4">
												<div class="form-group row">
												  <label class="col-sm-3 col-form-label">ATMID_4</label>
												  <div class="col-sm-9">
													<input type="text" class="form-control" name="ATMID_4" id="ATMID_4" value="<?=$ATMID_4?>" />
												  </div>
												</div>
											  </div>
											</div>
											<div class="row">
											  
											  <div class="col-md-4">
												<div class="form-group row">
												  <label class="col-sm-3 col-form-label">Tracker No</label>
												  <div class="col-sm-9">
													<input type="text" class="form-control" name="TrackerNo" id="TrackerNo" value="<?=$TrackerNo?>" />
												  </div>
												</div>
											  </div> 
											
											  <div class="col-md-8">
												<div class="form-group row">
												  <label class="col-sm-3 col-form-label">ATM ShortName</label>
												  <div class="col-sm-9">
													<input type="text" class="form-control" value="<?=$ATMShortName?>" name="ATMShortName" id="ATMShortName" value=""/>
												  </div>
												</div>
											  </div>
											</div>
											<div class="row">
											  <div class="col-md-12">
												<div class="form-group row">
												  <label class="col-sm-3 col-form-label">Site Address</label>
												  <div class="col-sm-9">
													<input type="text" class="form-control" name="SiteAddress" id="SiteAddress" value="<?=$siteAddress?>"/>
												  </div>
												</div>
											  </div>
											</div>
											<div class="row">
											  <div class="col-md-4">
												<div class="form-group row">
												  <label class="col-sm-3 col-form-label">State</label>
												  <div class="col-sm-9">
													<input type="text" class="form-control" name="State" id="State" value="<?=$State?>"/>
												  </div>
												</div>
											  </div>
											  <div class="col-md-4">
												<div class="form-group row">
												  <label class="col-sm-3 col-form-label">City</label>
												  <div class="col-sm-9">
													<input type="text" class="form-control" name="City" id="City" value="<?=$City?>"/>
												  </div>
												</div>
											  </div>
											
											  <div class="col-md-4">
												<div class="form-group row">
												  <label class="col-sm-3 col-form-label">Zone</label>
												  <div class="col-sm-9">
													<select class="form-control"  name="Zone" id="Zone">
													  <option value="East" <?php if($Zone=='East'){echo 'selected';}?>>East</option>
													  <option value="West" <?php if($Zone=='West'){echo 'selected';}?>>West</option>
													  <option value="North" <?php if($Zone=='North'){echo 'selected';}?>>North</option>
													  <option value="South" <?php if($Zone=='South'){echo 'selected';}?>>South</option>
													</select>
												  </div>
												</div>
											  </div>
											</div>
											<div class="row">
											  
											  <div class="col-md-4">
												<div class="form-group row">
												  <label class="col-sm-3 col-form-label">Panel Make</label>
												  <div class="col-sm-9">
													<select class="form-control"  name="Panel_Make" id="Panel_Make" >
													  <option value="">Select</option>
														<?php 
         $panel="select distinct(Panel_Make) from sites";
         
				 $runpanel=mysqli_query($con,$panel);
				 if(mysqli_num_rows($runpanel)){
         while($rowpanel = mysqli_fetch_array($runpanel))
	   {  ?>
		<option value="<?php echo $rowpanel['Panel_Make'];?>" <?php if($Panel_Make==$rowpanel['Panel_Make']){echo 'selected';}?>><?php echo $rowpanel['Panel_Make']; ?></option>
               
      <?php } } ?>
														
													</select>
												  </div>
												</div>
											  </div>
											
											  <div class="col-md-4">
												<div class="form-group row">
												  <label class="col-sm-3 col-form-label">Old Panel ID</label>
												  <div class="col-sm-9">
													<input type="text" class="form-control" name="OldPanelID" id="OldPanelID" value="<?=$OldPanel?>"/>
												  </div>
												</div>
											  </div>

<?php 
$max="select max(SN) from sites";
$runmax=mysqli_query($con,$max);
$maxfetch=mysqli_fetch_array($runmax);

$max2="select NewPanelID  from sites where SN='".$maxfetch[0]."'";
$runmax2=mysqli_query($con,$max2);
$maxfetch2=mysqli_fetch_array($runmax2);
?>

											  <div class="col-md-4">
												<div class="form-group row">
												  <label class="col-sm-3 col-form-label">New Panel ID</label>
												  <div class="col-sm-9">
													<input type="text" class="form-control" name="NewPanelID" id="NewPanelID" value="<?=$NewPanel?>"/>
												  </div>
												</div>
											  </div>
											</div>
											<div class="row">
											  
											  <div class="col-md-4">
												<div class="form-group row">
												  <label class="col-sm-3 col-form-label">DVR IP </label>
												  <div class="col-sm-9">
													<input type="text" class="form-control" name="DVRIP" id="DVRIP" onblur="checkip()" value="<?=$DVRIP?>" />
												  </div>
												</div>
											  </div>
											
											  <div class="col-md-4">
												<div class="form-group row">
												  <label class="col-sm-3 col-form-label">Panel IP</label>
												  <div class="col-sm-9">
													<input type="text" class="form-control" name="PanelIP" id="PanelIP" onblur="checkPanIP()" value="<?=$PanelIP?>" />
												  </div>
												</div>
											  </div>
											  <div class="col-md-4">
												<div class="form-group row">
												  <label class="col-sm-3 col-form-label">DVR Name </label>
												  <div class="col-sm-9">
													<select class="form-control" name="DVRName" id="DVRName" >
													  <option>Select</option>
														  <?php 
															$dvr="select name from dvr_name";
															$rundvr=mysqli_query($con,$dvr);
															if(mysqli_num_rows($rundvr)){
																while($rowdvr = mysqli_fetch_array($rundvr)) 
														        {  ?>
															<option value="<?php echo $rowdvr['name'];?>" <?php if(strtoupper($rowdvr['name'])==strtoupper($DVRName)){echo 'selected';} ?> ><?php echo $rowdvr['name']; ?></option>
																   
														  <?php } } ?>
													  
													</select>
												  </div>
												</div>
											  </div>
											</div>
											<div class="row">
											  
											  <div class="col-md-6">
												<div class="form-group row">
												  <label class="col-sm-3 col-form-label">DVR Model Number</label>
												  <div class="col-sm-9">
													<input type="text" class="form-control" name="DVR_Model_num" id="DVR_Model_num" value="<?=$DVR_Model_num?>">
												  </div>
												</div>
											  </div>
											
											  <div class="col-md-6">
												<div class="form-group row">
												  <label class="col-sm-3 col-form-label">Router Model Number</label>
												  <div class="col-sm-9">
													<input type="text" class="form-control" name="Router_Model_num" id="Router_Model_num" value="<?=$Router_Model_num?>">
												  </div>
												</div>
											  </div>
											 
											</div>
											<div class="row">
											   <div class="col-md-4">
												<div class="form-group row">
												  <label class="col-sm-3 col-form-label">UserName</label>
												  <div class="col-sm-9">
													<input type="text" class="form-control"  name="UserName" id="UserName" value="admin" readonly>
												  </div>
												</div>
											  </div>
											  <div class="col-md-4">
												<div class="form-group row">
												  <label class="col-sm-3 col-form-label">Password</label>
												  <div class="col-sm-9">
													<input type="text" class="form-control" value="<?=$Password?>" name="Password" maxlength=10 id="Password"/>
												  </div>
												</div>
											  </div>
											
											  <div class="col-md-4">
												<div class="form-group row">
												  <label class="col-sm-3 col-form-label">Engineer Name</label>
												  <div class="col-sm-9">
													<input type="text" class="form-control"  name="eng_name" id="eng_name" value="<?=$eng_name?>" />
												  </div>
												</div>
											  </div>
											  
											</div>
											<div class="row">
											  <div class="col-md-4">
												<div class="form-group row">
												  <label class="col-sm-3 col-form-label">Live</label>
												  <div class="col-sm-9">
													<select class="form-control" value="<?=$live?>" name="live" id="live">
														<option value="Y" <?php if($live=='Y'){echo 'selected';}?>>YES</option>
     												<option value="N" <?php if($live=='N'){echo 'selected';}?>>NO</option>
     												<option value="P" <?php if($live=='P'){echo 'selected';}?>>Pending</option>
													</select>
												  </div>
												</div>
											  </div>
											  <div class="col-md-8">
												<div class="form-group row">
												  <label class="col-sm-3 col-form-label">Site Remark</label>
												  <div class="col-sm-9">
													<textarea rows="4" cols="25" id="site_remark" name="site_remark" class="form-control"><?=$site_remark?></textarea>
												  </div>
												</div>
											  </div>
											</div>
											
											<button type="submit" name="sub"  class="btn btn-primary mr-2" style="float:right">Update</button>
										  </form>
										</div>
									  </div>
									</div>

                </div>
                    <?php CloseCon($con);include('footer.php');?>
                </div>
            </div>
        </div>
        <script src="vendors/js/vendor.bundle.base.js">
        </script>
        <script src="vendors/js/vendor.bundle.addons.js">
        </script>
        <script src="js/off-canvas.js">
        </script>
        <script src="js/hoverable-collapse.js">
        </script>
        <script src="js/misc.js">
        </script>
        <script src="js/settings.js">
        </script>
        <script src="js/todolist.js">
        </script>
        <script src="js/dashboard.js">
        </script>
		<script src="js/data-table.js"></script>
				<script src="js/newsite.js"></script>
 <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

    </body>
</html>
