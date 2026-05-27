<!DOCTYPE html>
<html lang="en">
    <?php include('head.php');?>
	<?php include('config.php')?>
	<style>
		.bt{
				border-top: 1px solid #1e1f33;
		  }
		  .br
		  {
				border-right: 1px solid #282844;
		  }
		   div.card-body {
		/*	margin:4px, 4px;
			padding:4px;
			background-color: green;
			width: 500px; 
			height: 210px;  
			overflow-x: hidden;
			overflow-y: scroll;
			text-align:justify; */
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
                            
    <body class="sidebar-dark">
        <div class="container-scroller">
            <!-- partial:partials/_navbar.html -->
            <nav class="navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row default-layout-navbar navbar-dark">
                <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
                    <a class="navbar-brand brand-logo" href="index.html">
                        <img alt="logo" src="media/logo.png"/>
                    </a>
                    <a class="navbar-brand brand-logo-mini" href="index.html">
                        <img alt="logo" src="media/logo.png"/>
                    </a>
                </div>
                <div class="navbar-menu-wrapper d-flex align-items-stretch">
                    <button class="navbar-toggler navbar-toggler align-self-center" data-toggle="minimize" type="button">
                        <span class="fas fa-bars">
                        </span>
                    </button>
                    <ul class="navbar-nav navbar-nav-left">
                        <li class="nav-item nav-search d-none d-md-flex">
                            <div class="nav-link">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">
                                            <i class="fas fa-search">
                                            </i>
                                        </span>
                                    </div>
                                    <input aria-label="Search" class="form-control" placeholder="Search" type="text">
                                    </input>
                                </div>
                            </div>
                        </li>
                    </ul>
                    <ul class="navbar-nav navbar-nav-right">
                        <li class="nav-item d-none d-lg-block">
                            <a class="nav-link" href="#">
                                <i class="fas fa-ellipsis-v">
                                </i>
                            </a>
                        </li>
                    </ul>
                </div>
            </nav>
            <!-- partial -->
            <div class="container-fluid page-body-wrapper">
                <!-- partial:partials/_settings-panel.html -->
                <!-- partial -->
                <!-- partial:partials/_sidebar.html -->
                <?php include('navbar.php');?>
                <!-- partial -->
				
				<?php 
                    include('panel_health_data.php');
                 ?>
				 <?php 
				 
				 $id=$_GET['id'];
				 $sql=mysqli_query($con,"select * from sites where SN='".$id."'");
				 $sql_result=mysqli_fetch_assoc($sql);

				 $SN= $sql_result['SN'];
				 $ATMID= $sql_result['ATMID'];
				 $ATMShortName= $sql_result['ATMShortName'];
				 $siteAddress= $sql_result['SiteAddress'];
				 $Customer= $sql_result['Customer'];
				 $Bank= $sql_result['Bank'];
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
				 
				 $live = $sql_result['live'];
				 $EngName = $sql_result['eng_name'];
				 $remark = $sql_result['site_remark'];
				 ?>
					

                <div class="main-panel">
                    <div class="content-wrapper">
                        <div class="page-header">
																							
							<h3 class="page-title" style="color:#fff;">
							  Update Site
							</h3>
							
							<!--<nav aria-label="breadcrumb">
							  <ol class="breadcrumb">
								<li class="breadcrumb-item"><a href="#">Tables</a></li>
								<li class="breadcrumb-item active" aria-current="page">Data table</li>
							  </ol>
							</nav>-->
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
		<option value="<?php echo $rowbank['name'];?>" <?php if($Bank==$rowbank['name']){ echo 'selected';}?> /><?php echo $rowbank['name']; ?>
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
										    <!--
											<div class="row">
											  <div class="col-md-4">
												<div class="form-group row">
												  <label class="col-sm-3 col-form-label">ATMID_2</label>
												  <div class="col-sm-9">
													<input type="text" class="form-control" name="ATMID_2" id="ATMID_2" value="-"/>
												  </div>
												</div>
											  </div>
											  <div class="col-md-4">
												<div class="form-group row">
												  <label class="col-sm-3 col-form-label">ATMID_3</label>
												  <div class="col-sm-9">
													<input type="text" class="form-control" name="ATMID_3" id="ATMID_3" value="-" />
												  </div>
												</div>
											  </div>
											  <div class="col-md-4">
												<div class="form-group row">
												  <label class="col-sm-3 col-form-label">ATMID_4</label>
												  <div class="col-sm-9">
													<input type="text" class="form-control" name="ATMID_4" id="ATMID_4" value="-" />
												  </div>
												</div>
											  </div>
											</div>-->
											<div class="row">
											  <!--
											  <div class="col-md-4">
												<div class="form-group row">
												  <label class="col-sm-3 col-form-label">Tracker No</label>
												  <div class="col-sm-9">
													<input type="text" class="form-control" name="TrackerNo" id="TrackerNo" value="-" />
												  </div>
												</div>
											  </div>  -->
											
											  <div class="col-md-12">
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
											<!-- <div class="col-md-4">
												<div class="form-group row">
												  <label class="col-sm-3 col-form-label">City</label>
												  <div class="col-sm-9">
													<select class="form-control" name="City" id="City" >
													  <option value="">Select</option>
														
													</select>
												  </div>
												</div>
											  </div> -->
											
											  <!-- <div class="col-md-4">
												<div class="form-group row">
												  <label class="col-sm-3 col-form-label">State</label>
												  <div class="col-sm-9">
													<select class="form-control" name="State" id="State" onchange="states()" >
													  <option value="">Select</option>
														<?php
															$qry="select state_id,state from state";
         
															$result=mysqli_query($con,$qry);
															if(mysqli_num_rows($result)){
															while($row = mysqli_fetch_array($result))
															{  ?>
												 <option value="<?php echo $row['state_id'];?>"/><?php echo $row['state']; ?></option>
																		
													 <?php } }
														?>
													</select>
												  </div>
												</div>
											  </div> -->
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
													<select class="form-control" name="Panel_Make" id="Panel_Make" >
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
// $np=$maxfetch2[0]+=1;
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
													<input type="text" class="form-control" name="PanelsIP" id="PanelsIP" onblur="checkPanIP()" value="<?=$PanelIP?>" />
												  </div>
												</div>
											  </div>
											  <!-- <div class="col-md-4">
												<div class="form-group row">
												  <label class="col-sm-3 col-form-label">DVR Name </label>
												  <div class="col-sm-9">
													<select class="form-control" name="DVRName" id="DVRName">
													  <option>Select</option>
														<?php 
         $dvr="select name from dvr_name";
         
				 $rundvr=mysqli_query($con,$dvr);
				 if(mysqli_num_rows($rundvr)){
         	while($rowdvr = mysqli_fetch_array($rundvr)) 
	   {  ?>
		<option value="<?php echo $rowdvr['name'];?>"/><?php echo $rowdvr['name']; ?></option>
               
      <?php } } ?>
													  
													</select>
												  </div>
												</div>
											  </div> -->
											</div>
											<div class="row">
											  
											  <div class="col-md-4">
												<div class="form-group row">
												  <label class="col-sm-3 col-form-label">DVR Model Number</label>
												  <div class="col-sm-9">
													<input type="text" class="form-control" name="DVR_Model_num" id="DVR_Model_num" value="<?=$DVR_Model_num?>">
												  </div>
												</div>
											  </div>
											
											  <div class="col-md-4">
												<div class="form-group row">
												  <label class="col-sm-3 col-form-label">Router Model Number</label>
												  <div class="col-sm-9">
													<input type="text" class="form-control" name="Router_Model_num" id="Router_Model_num" value="<?=$Router_Model_num?>">
												  </div>
												</div>
											  </div>
											  <div class="col-md-4">
												<div class="form-group row">
												  <label class="col-sm-3 col-form-label">UserName</label>
												  <div class="col-sm-9">
													<input type="text" class="form-control" name="UserName" id="UserName" value="admin" readonly>
												  </div>
												</div>
											  </div>
											</div>
											<div class="row">
											  
											  <div class="col-md-4">
												<div class="form-group row">
												  <label class="col-sm-3 col-form-label">Password</label>
												  <div class="col-sm-9">
													<input type="text" class="form-control" name="Password" maxlength=10 id="Password"/>
												  </div>
												</div>
											  </div>
											
											  <div class="col-md-4">
												<div class="form-group row">
												  <label class="col-sm-3 col-form-label">Engineer Name</label>
												  <div class="col-sm-9">
													<input type="text" class="form-control" name="engname" id="engname" value="<?=$EngName?>" />
												  </div>
												</div>
											  </div>
											  <div class="col-md-4">
												<div class="form-group row">
												  <label class="col-sm-3 col-form-label">Live</label>
												  <div class="col-sm-9">
													<select class="form-control" name="live" id="live">
														<option value="Y" <?php if($live=='Y'){echo 'selected';}?>>YES</option>
     												<option value="N" <?php if($live=='N'){echo 'selected';}?>>NO</option>
     												<option value="P" <?php if($live=='P'){echo 'selected';}?>>Pending</option>
													</select>
												  </div>
												</div>
											  </div>
											</div>
											<div class="row">
											  
											  <div class="col-md-4">
												<div class="form-group row">
												  <label class="col-sm-3 col-form-label">Remark</label>
												  <div class="col-sm-9">
													<textarea rows="4" cols="25" id="Remark" name="Remark" class="form-control"><?=$remark?></textarea>
												  </div>
												</div>
											  </div>
											
											  <div class="col-md-4">
													<div class="form-group row">
												  	<label class="col-sm-3 col-form-label">Mail Recieve Date</label>
												  	<div class="col-sm-9">
															<input type="date" name="dates" id="dates" class="form-control" />
												  	</div>
													</div>
											  </div>
												<div class="col-md-4">
													<div class="form-group row">
												  	<label class="col-sm-3 col-form-label">GSM Number</label>
												  	<div class="col-sm-9">
															<input type="text" name="GSM" id="GSM" onkeypress="return isNumberKey(event)" maxlength="10" class="form-control" />
												  	</div>
													</div>
											  </div>

											</div>
											<div class="row">
											  
											  <div class="col-md-4">
												<div class="form-group row">
												  <label class="col-sm-3 col-form-label">Choose File</label>
												  <div class="col-sm-9">
													<input type="file" name="email_cpy" id="email_cpy" class="form-control"></textarea>
												  </div>
												</div>
											  </div>
											
											  

											</div>
																						  

											<button type="submit" name="sub"  class="btn btn-primary mr-2" style="float:right">Update</button>
											<!-- <button class="btn btn-light" style="float:right">Cancel</button> -->
										  </form>
										</div>
									  </div>
									</div>

                </div>
                    <!-- content-wrapper ends -->
                    <!-- partial:partials/_footer.html -->
                    <?php include('footer.php');?>
                    <!-- partial -->
                </div>
                <!-- main-panel ends -->
            </div>
            <!-- page-body-wrapper ends -->
        </div>
        <!-- container-scroller -->
        <!-- plugins:js -->
        <script src="vendors/js/vendor.bundle.base.js">
        </script>
        <script src="vendors/js/vendor.bundle.addons.js">
        </script>
        <!-- endinject -->
        <!-- Plugin js for this page-->
        <!-- End plugin js for this page-->
        <!-- inject:js -->
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
        <!-- endinject -->
        <!-- Custom js for this page-->
        <script src="js/dashboard.js">
        </script>
		<script src="js/data-table.js"></script>
        <!-- End custom js for this page-->
				<script src="js/newsite.js"></script>
 <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

    </body>
</html>
