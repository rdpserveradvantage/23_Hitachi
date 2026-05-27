<div class="card"> 
    <div class="col-12 grid-margin">
		
		<div class="row">
			<div class="col-md-3">
				<div class="form-group row">
					<label class="col-sm-6 col-form-label">Select Client<br></label>
						<div class="col-sm-8">
							<select name="Client" id="Client" class="form-control" onchange="onchangebank()">
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
			</div>
			<div class="col-md-3">
				<div class="form-group row">
					<label class="col-sm-6 col-form-label">Select Bank<br></label>
						<div class="col-sm-8">
							<select name="Bank" id="Bank" class="form-control" onchange="onchangecircle()">
								<option value="">Select</option>   
							</select>
						</div>
				</div>
			</div>
			<div class="col-md-3">
				<div class="form-group row">
					<label class="col-sm-6 col-form-label">Select Circle<br></label>
						<div class="col-sm-8">
							<select name="Circle" id="Circle" class="form-control" onchange="onchangeatmid()">
								<option value="">All Circle</option>   
							</select>
						</div>
				</div>
			</div>
			<div class="col-md-3">
				<div class="form-group row">
					<label class="col-sm-6 col-form-label">Select Atm<br></label>
						<div class="col-sm-8">
							<select name="AtmID" id="AtmID" class="form-control js-example-basic-single w-100">
								<option value="">All Site</option>
															
							</select>
						</div>
				</div>
			</div> 
             <?php $currentyear = date('Y');$currentmonth = date('m');?>
            <div class="col-md-3">
				<div class="form-group row">
					<label class="col-sm-6 col-form-label">Select Month<br></label>
						<div class="col-sm-8">
							<select class="form-control" id="month" name="month">
							  <option value="0">Select Month</option>
							  <option value="1" <?php if($currentmonth=='1'){echo 'selected';}?>>Jan</option>
							 <!-- <option value="2" <?php if($currentmonth=='2'){echo 'selected';}?>>Feb</option> 
							  <option value="3" <?php if($currentmonth=='3'){echo 'selected';}?>>Mar</option>
							  <option value="4" <?php if($currentmonth=='4'){echo 'selected';}?>>Apr</option>
							  <option value="5" <?php if($currentmonth=='5'){echo 'selected';}?>>May</option>
							  <option value="6" <?php if($currentmonth=='6'){echo 'selected';}?>>June</option>
							  <option value="7" <?php if($currentmonth=='7'){echo 'selected';}?>>July</option>
							  <option value="8" <?php if($currentmonth=='8'){echo 'selected';}?>>Aug</option>
							  <option value="9" <?php if($currentmonth=='9'){echo 'selected';}?>>Sept</option>
							  <option value="10" <?php if($currentmonth=='10'){echo 'selected';}?>>Oct</option>
							  <option value="11" <?php if($currentmonth=='11'){echo 'selected';}?>>Nov</option>
							  <option value="12" <?php if($currentmonth=='12'){echo 'selected';}?>>Dec</option> -->

						  </select>
						</div>
				</div>
			</div> 
            
            <div class="col-md-3">
				<div class="form-group row">
					<label class="col-sm-6 col-form-label">Select Year<br></label>
						<div class="col-sm-8">
							 <select class="form-control" id="year" name="year">
								  <option value="0">Select Year</option>
							  
							  <option value="2023" <?php if($currentyear=='2023'){echo 'selected';}?>>2023</option>
							  <!--<option value="2024" <?php if($currentyear=='2024'){echo 'selected';}?>>2024</option>
							  <option value="2025" <?php if($currentyear=='2025'){echo 'selected';}?>>2025</option> -->
							  </select>
						</div>
				</div>
			</div>  			

            <div class="col-sm-3">
			   <div>
			      <label class="col-sm-6 col-form-label"><br></label>
				  <div class="col-sm-3">
			      <button class="btn btn-primary" id="show_detail" onclick="getTicketDetails()">Show</button>
				  </div>
			   </div>
			</div>  			

                    <!-- <div class="col-md-4">
						<div class="form-group row">
						    <label class="col-sm-4 col-form-label">Select Client<br></label>
							<div class="col-sm-9">
							    <select name="AtmID" id="AtmID"  class="form-control">
								    <option value="B1088910">PNB</option>
									<option value="MN000206">HITACHI</option>
									
								</select>
							</div>
						</div>
					</div> -->
        </div>
    </div>
</div>
<br>         
                  
