
		  <div class="card">
			<div class="card-body">
			    <div class="col-12 grid-margin">
					<div class="row">
					    <div class="col-md-3">
						  <div class="form-group">
							<label for="Client">Select Client</label>  
							<select name="Client" id="Client" class="form-control form-control-sm col-sm-9" onchange="onchangebank()">
								<option value="">Select</option> 
								<?php if($_SESSION['client']=='All'){?>
											
								<?php echo getClients(); }
								   else{ 
								   $clients = explode(",",$_SESSION['client']);
								   for($i=0;$i<count($clients);$i++){ echo $clients[$i];?>
								   <option value="<?php echo $clients[$i];?>"><?php echo $clients[$i];?></option> 
								   <?php }  }?>
							</select>
						  </div>
						</div>
						<div class="col-md-3">
						  <div class="form-group">
							<label for="Bank">Select Bank</label>
							<select name="Bank" id="Bank" class="form-control form-control-sm col-sm-9" onchange="onchangecircle()">
							    <option value="">Select</option>   
							</select>
						  </div>
						</div>
						<div class="col-md-3">
						  <div class="form-group">
							<label for="Circle">Select Circle</label>
							<select name="Circle" id="Circle" class="form-control form-control-sm col-sm-9" onchange="onchangeatmid()">
							    <option value="">All Circle</option>   
							</select>
						  </div>
						</div>
						<div class="col-md-3">
						  <div class="form-group">
							<label for="AtmID">Select AtmID</label>
							<select name="AtmID" id="AtmID" class="form-control form-control-sm col-sm-9 js-example-basic-single w-100" >
							    <option value="">All Site</option>   
							</select>
						  </div>
						</div>
						 
						<!--<div class="col-md-4">
							<div class="form-group row">
								<label class="col-sm-4 col-form-label">Select Site<br></label>
								<div class="col-sm-8">
									<select name="SiteName" id="SiteName"  class="form-control">
										<option value="">Select</option>
																			
									</select>
								</div>
							</div>
						</div>-->
				    </div>
				    <div class="row">
					    <div class="col-md-9">
						  <div class="form-group">
							<label for="Address">Site Address</label>
							<input type="text" id="siteAddress" class="form-control form-control-sm col-sm-9" readonly>	
						  </div>
						</div>
					</div>
					<div class="row">	
					    <div class="col-sm-3">
						   <button class="btn btn-primary" id="Button" onclick="getPanelDetails()">Show</button>
						</div>
						<!--<a href="" class="btn btn-primary" id="Button">Clear</a>-->
						
				    </div>
				</div>
			</div>
		   </div><br>
		  
		
              

