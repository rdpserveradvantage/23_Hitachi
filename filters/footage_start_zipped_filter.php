<div class="card"> 
    <div class="col-12 grid-margin">
		
		<div class="row">
			<!--<input type="hidden" id="Client" name="Client" value="Hitachi">
		    <input type="hidden" id="Bank" name="Bank" value="PNB"> -->
			
           <!--
            <div class="col-md-6">
				<div class="form-group row">
					<label class="col-sm-6 col-form-label">Select Footage Type<br></label>
						<div class="col-sm-8">
							 <select class="form-control" id="footage_type" name="footage_type">
							    <option value="All">All</option>
							    <option value="24Hrs" <?php //if($currentyear=='2023'){echo 'selected';}?>>24Hrs</option>
							    <option value="Rejected" <?php //if($currentyear=='2024'){echo 'selected';}?>>Rejected</option>
							    <option value="Dispute" <?php //if($currentyear=='2025'){echo 'selected';}?>>Dispute</option>
							  </select>
						</div>
				</div>
			</div>  -->			
           
			<div class="col-md-6">
				<div class="form-group row">
					<label class="col-sm-6 col-form-label" >Select From & To</label>
						<div class="col-sm-9">
							<div id="reportrange" class="form-control"   data-cancel-class="btn-light"  style="float:right;">
								<i class="fa fa-calendar"></i>&nbsp;
								<span id="selectedValue"></span> 
							</div>

							<input type="hidden" id="start" name="start" value="<?php echo date('Y-m-d');?>">
							<input type="hidden" id="end" name="end" value="<?php echo date('Y-m-d');?>">
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

                   
        </div>
    </div>
</div>
<br>         
                  
