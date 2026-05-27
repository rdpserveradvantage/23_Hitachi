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
                <?php include('navbar.php');
				 $con = OpenCon();
				?>
                <!-- partial -->
				
								 
                <div class="main-panel">
                    <div class="content-wrapper">
                        <div class="page-header">
																							
							<h3 class="page-title">
							  Add New Site
							</h3>
							
						  </div>
								<div class="col-12 grid-margin">
									<div class="card">
										<div class="card-body">
										  
										  <form class="form-sample" id="forms" action="addsite_process.php" method="POST" enctype="multipart/form-data" onsubmit="return finalval()">
											
											<div class="row">
											 
											  <div class="col-md-4">
												<div class="form-group row">
												  <label class="col-sm-3 col-form-label">Status</label>
												  <div class="col-sm-9">
													<select class="form-control" name="Status" id="Status" required>
														<option value="E-Surveillance - CSS">E-Surveillance - CSS </option>
													</select>
												  </div>
												</div>
											  </div>
											  <div class="col-md-4">
												<div class="form-group row">
												  <label class="col-sm-3 col-form-label">Phase</label>
												  <div class="col-sm-9">
													<select name="Phase" id="Phase" class="form-control" required>
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
												  <label class="col-sm-3 col-form-label">Router Ip</label>
												  <div class="col-sm-9">
													<input type="text" class="form-control" name="RouterIp" id="RouterIp" value="-" />
												  </div>
												</div>
											  </div>
											</div>  
											<div class="row">
											 <div class="col-md-4">
												<div class="form-group row">
												  <label class="col-sm-3 col-form-label">Client</label>
												  <div class="col-sm-9">
													<select class="form-control" name="Customer" id="Customer" required>
														<option value="">Select </option>
														<?php 
														 $cust="select name from customer";
														 	 
														 $runcust=mysqli_query($con,$cust);
														 if(mysqli_num_rows($runcust))
														 {
															 while($rowcust = mysqli_fetch_array($runcust))
														   {  ?>
															<option value="<?php echo $rowcust['name'];?>"><?php echo $rowcust['name']; ?></option>
																   
														<?php } } ?>
													</select>
												  </div>
												</div>
											  </div>
											
											  <div class="col-md-4">
												<div class="form-group row">
												  <label class="col-sm-3 col-form-label">Bank</label>
												  <div class="col-sm-9">
													<select class="form-control" name="Bank" id="Bank" required>
													  <option value="">Select</option>
														<?php 
         $bank="select name from bank";
         
				 $runbank=mysqli_query($con,$bank);
				 if(mysqli_num_rows($runbank)){
         while($rowbank = mysqli_fetch_array($runbank))
	   {  ?>
		<option value="<?php echo $rowbank['name'];?>"/><?php echo $rowbank['name']; ?>
		</option>
               <br/>
      <?php } } ?>
													</select>
												  </div>
												</div>
											  </div> 
											  <div class="col-md-4">
												<div class="form-group row">
												  <label class="col-sm-3 col-form-label">ATMID</label>
												  <div class="col-sm-9">
													<input type="text" class="form-control" name="ATMID" id="ATMID" onblur="checkpanel()" required>
												  </div>
												</div>
											  </div>
											</div>
										    
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
											</div>
											<div class="row">
											  
											  <div class="col-md-4">
												<div class="form-group row">
												  <label class="col-sm-3 col-form-label">Tracker No</label>
												  <div class="col-sm-9">
													<input type="text" class="form-control" name="TrackerNo" id="TrackerNo" value="-" />
												  </div>
												</div>
											  </div> 
											
											  <div class="col-md-4">
												<div class="form-group row">
												  <label class="col-sm-3 col-form-label">ATM ShortName</label>
												  <div class="col-sm-9">
													<input type="text" class="form-control" name="ATMShortName" id="ATMShortName" value=""/>
												  </div>
												</div>
											  </div>
											  <div class="col-md-4">
												<div class="form-group row">
												  <label class="col-sm-3 col-form-label">Site Address</label>
												  <div class="col-sm-9">
													<input type="text" class="form-control" name="SiteAddress" id="SiteAddress" value=""/>
												  </div>
												</div>
											  </div>
											</div>
											<div class="row">
											  <div class="col-md-4">
												<div class="form-group row">
												  <label class="col-sm-3 col-form-label">State</label>
												  <div class="col-sm-9">
													<select class="form-control" name="State" onchange="getcity(this.value)" id="State" required>
													  <option value="">Select</option>
														<?php 
																$panel="select * from all_states";
																
																		$runpanel=mysqli_query($con,$panel);
																		if(mysqli_num_rows($runpanel)){
																while($rowpanel = mysqli_fetch_array($runpanel))
															{  ?>
																<option value="<?php echo $rowpanel['state_code'];?>"><?php echo $rowpanel['state_name']; ?></option>
																	
															<?php } } ?>
														
													</select>
												  </div>
												</div>
											  </div>
											  <div class="col-md-4">
												<div class="form-group row">
												  <label class="col-sm-3 col-form-label">City</label>
												  <div class="col-sm-9">
													<select class="form-control" name="city" id="clientshow_tbody" required>
													  
													</select>
												  </div>
												</div>
											  </div>
											
											  <div class="col-md-4">
												<div class="form-group row">
												  <label class="col-sm-3 col-form-label">Zone</label>
												  <div class="col-sm-9">
													<select class="form-control"  name="Zone" id="Zone" required>
													  <option>East</option>
													  <option>West</option>
													  <option>North</option>
													  <option>South</option>
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
													<select class="form-control" name="Panel_Make" id="Panel_Make" required>
													  <option value="">Select</option>
														<?php 
         $panel="select distinct(Panel_Make) from sites";
         
				 $runpanel=mysqli_query($con,$panel);
				 if(mysqli_num_rows($runpanel)){
         while($rowpanel = mysqli_fetch_array($runpanel))
	   {  ?>
		<option value="<?php echo $rowpanel['Panel_Make'];?>"><?php echo $rowpanel['Panel_Make']; ?></option>
               
      <?php } } ?>
														
													</select>
												  </div>
												</div>
											  </div>
											
											  <div class="col-md-4">
												<div class="form-group row">
												  <label class="col-sm-3 col-form-label">Old Panel ID</label>
												  <div class="col-sm-9">
													<input type="text" class="form-control" name="OldPanelID" id="OldPanelID" value=""/>
												  </div>
												</div>
											  </div>

										      <?php 
												$max="select max(SN) from sites";
												$runmax=mysqli_query($con,$max);
												$maxfetch=mysqli_fetch_array($runmax);

												$max2="select NewPanelID  from sites where SN='".$maxfetch[0]."'";
												// echo $maxfetch[0]; die;
												$runmax2=mysqli_query($con,$max2);
												$maxfetch2=mysqli_fetch_array($runmax2);
												$np=$maxfetch2[0]+=1;

												?>

											  <div class="col-md-4">
												<div class="form-group row">
												  <label class="col-sm-3 col-form-label">New Panel ID</label>
												  <div class="col-sm-9">
													<input type="text" class="form-control" name="NewPanelID" id="NewPanelID" value="<?php echo "0".$np?>"/>
												  </div>
												</div>
											  </div>
											</div>
											<div class="row">
											  
											  <div class="col-md-4">
												<div class="form-group row">
												  <label class="col-sm-3 col-form-label">DVR IP </label>
												  <div class="col-sm-9">
													<input type="text" class="form-control" name="DVRIP" id="DVRIP" onblur="checkip()"/>
												  </div>
												</div>
											  </div>
											
											  <div class="col-md-4">
												<div class="form-group row">
												  <label class="col-sm-3 col-form-label">Panel IP</label>
												  <div class="col-sm-9">
													<input type="text" class="form-control" name="PanelsIP" id="PanelsIP" onblur="checkPanIP()"/>
												  </div>
												</div>
											  </div>
											  <div class="col-md-4">
												<div class="form-group row">
												  <label class="col-sm-3 col-form-label">DVR Name </label>
												  <div class="col-sm-9">
													<select class="form-control" name="DVRName" id="DVRName" required>
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
											  </div>
											</div>
											<div class="row">
											  
											  <div class="col-md-4">
												<div class="form-group row">
												  <label class="col-sm-3 col-form-label">DVR Model Number</label>
												  <div class="col-sm-9">
													<input type="text" class="form-control" name="DVR_Model_num" id="DVR_Model_num" required> 
												  </div>
												</div>
											  </div>
											
											  <div class="col-md-4">
												<div class="form-group row">
												  <label class="col-sm-3 col-form-label">Router Model Number</label>
												  <div class="col-sm-9">
													<input type="text" class="form-control" name="Router_Model_num" id="Router_Model_num" required>
												  </div>
												</div>
											  </div>
											  <div class="col-md-4">
												<div class="form-group row">
												  <label class="col-sm-3 col-form-label">User Name</label>
												  <div class="col-sm-9">
													<input type="text" class="form-control" name="UserName" id="UserName" value="" >
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
													<input type="text" class="form-control" name="engname" id="engname" required /> 
												  </div>
												</div>
											  </div>
											  <div class="col-md-4">
												<div class="form-group row">
												  <label class="col-sm-3 col-form-label">Live</label>
												  <div class="col-sm-9">
													<select class="form-control" name="live" id="live" required>
														<option value="Y">YES</option>
     												<option value="N">NO</option>
     												<option value="P">Pending</option>
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
													<textarea rows="4" cols="25" id="Remark" name="Remark" class="form-control"></textarea>
												  </div>
												</div>
											  </div>
											
											  <div class="col-md-4">
													<div class="form-group row">
												  	<label class="col-sm-3 col-form-label">Mail Recieve Date</label>
												  	<div class="col-sm-9">
															<input type="date" name="dates" id="dates" class="form-control" required />
												  	</div>
													</div>
											  </div>
												

											</div>
											 <?php CloseCon($con); ?>
											<button type="submit" name="sub"  class="btn btn-primary mr-2" style="float:right">Submit</button>
										  </form>
										</div>
									  </div>
									</div>

                </div>
                    
                    <?php include('footer.php');?>
                </div>
            </div>
        </div>
        <script src="vendors/js/vendor.bundle.base.js">
        </script>
        <script src="vendors/js/vendor.bundle.addons.js">
        </script>
		<script>
			
			function getcity(value)
			{
				$.ajax({
						url:"getMasterData.php",
						type:'GET',
						data:{code:value},
						datatype:"json",
						success:function(result){ debugger
							console.log(result);
							var result = jQuery.parseJSON(result);
							$('#clientshow_tbody').html('');
							$('#clientshow_tbody').html(result);
							// alert(result);
						}
						})
			}
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
