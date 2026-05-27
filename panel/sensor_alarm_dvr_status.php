<div class="row">
   <div class="col-md-6 grid-margin stretch-card">
      <div class="card">
		<div class="card-body">
		  <h4 class="card-title">DVR Details</h4>
		     <div class="row">
			    <div class="col-md-4">
				  <div class="form-group">
					<label>DVR IP</label>
					<input type="text" class="form-control form-control-sm" id="DVRIP" readonly placeholder="DVRIP" aria-label="DVRIP">
				  </div>
				</div>  
				<!--<div class="col-md-4">
				  <div class="form-group">
					<label>DVR Model</label>
					<input type="text" class="form-control form-control-sm" id="DVRModel" readonly placeholder="DVRModel" aria-label="DVRModel">
				  </div>
				</div>--> 
				<div class="col-md-4">
				  <div class="form-group">
					<label>DVR Username</label>
					<input type="text" class="form-control form-control-sm" id="DVRUsername" readonly placeholder="DVRUsername" aria-label="DVRUsername">
				  </div>
				</div> 
			</div>
			<div class="row">
			    <div class="col-md-4">
				  <div class="form-group">
					<label>DVR Password</label>
					
					 <input class="form-control form-control-sm" type="password" id="DVRpwd" readonly placeholder="DVRPassword" aria-label="DVRPassword">
					  <div class="input-group-addon">
						<a onclick="myFunction()"><i class="fa fa-eye-slash" aria-hidden="true"></i></a>
					  </div>
													
				  </div>
				</div>  
				<div class="col-md-6">
				  <div class="form-group">
					<label>DVR Status</label>
					<br>
					<div class="badge badge-success" id="dvr_status" style="display:none;">DVR Login successfully</div>
					<div class="badge badge-danger" id="dvrlogin_status" style="display:none;">DVR Login Unsuccessfully</div>
				  </div>
				</div> 
			</div>
			<div class="row">
			    <div class="col-md-6">
				    <button type="button" class="btn btn-primary" onclick="getPanelDetails()">Get Panel Status<i class="fa fa-refresh ml-1"></i></button>
				</div>
				<div class="col-md-6">
				   <!-- <button type="button" class="btn btn-primary btn-sm large-modal" data-id="" data-toggle="modal" data-target="#largeModal">Live View<i class="fa fa-eye ml-1"></i></button>-->
				</div>
			</div>
		 
		</div>
	  </div>
   </div>
   <div class="col-md-6 grid-margin stretch-card">
       <div class="card">
			<div class="card-body">
				 <h4 class="card-title">DVR Status</h4>  
				  <div class="row">
					<div class="col-md-4">
					   Total Space
					</div>
					<div class="col-md-4">
					   Free Space
					</div>
					<div class="col-md-4">
					   Used Space
					</div>
				  </div>	
				  <div class="row">
					<div class="col-md-4" id="total_space" style="color: green;">
					   0
					</div>
					<div class="col-md-4" id="free_space" style="color: green;">
					   0
					</div>
					<div class="col-md-4" id="used_space" style="color: green;">
					   0
					</div>
				  </div>
				  <br>
				  <div class="row">
					<div class="col-12">
					  <div class="table-responsive">
						<table id="order-listing2" class="table">
						  <thead>
							<tr>
								<th>Cam.No.</th><th>Oldest Recording</th>
								<th>Latest Recording</th><th>Days</th>
								
							</tr>
						  </thead>
						  <tbody id="dvr_recording_list">
						 
						  </tbody>
						</table>
					  </div>
					</div>
				  </div>
			</div>
		</div>
   </div>
</div>