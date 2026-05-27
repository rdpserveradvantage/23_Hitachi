<div class="card">
    <div class="col-12 grid-margin">
		    
			<div class="row">
			    <div class="col-md-3">
					<div class="form-group row">
						<label class="col-sm-6 col-form-label">Select Client<br></label>
							<div class="col-sm-8">
								<select name="client" id="Client" class="form-control" onchange="onchangebank()">
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
									<option value="">Select</option>   
								</select>
							</div>
					</div>
				</div>
				<div class="col-md-3">
					<div class="form-group row">
						<label class="col-sm-6 col-form-label">Select Atm<br></label>
							<div class="col-sm-8">
								<select name="atmid" id="AtmID" class="form-control js-example-basic-single w-100">
									<option value="">All Site</option>
																
								</select>
							</div>
					</div>
				</div>
				<div class="col-md-3">
					<div class="form-group row">
					    <label class="col-sm-6 col-form-label" >Select Portal</label>
					        <div class="col-sm-9">
					            <select name="portal" id="portal" class="form-control" >
					                <option value="all">All</option>
					                <option value="active">Ticket Active</option>
					                <option value="closed">Ticket Closed</option>
	            				</select>
					        </div>
					</div>
				</div>
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
				
					<!--
					<div class="col-sm-6 grid-margin"><br> <br>
					<div class="form-group row" >
					<div class="form-check col md-1">
					<label class="form-check-label" >
					<input type="radio" class="form-check-input"  name="optionsRadios" id="optionsRadios1" value="">
					   All
					</label>
					</div>
					
					<div class="form-check col md-1">
					<label class="form-check-label" >
					<input type="radio" class="form-check-input" name="optionsRadios" id="optionsRadios1" value="">
					Ticket Active
					</label>
					</div> 
					<div class="form-check col md-1">
					<label class="form-check-label" >
					<input type="radio" class="form-check-input" name="optionsRadios" id="optionsRadios1" value="">
					Ticket Closed
					</label>
					</div>
					<div class="form-check col md-1">
					<label class="form-check-label" >
					<input type="radio" class="form-check-input" name="optionsRadios" id="optionsRadios1" value="">
					Notification
					</label>
					</div>
					<div class="form-check col md-1">
					<label class="form-check-label" >
					<input type="radio" class="form-check-input" name="optionsRadios" id="optionsRadios1" value="">
					Restore
					</label>
					</div>

					</div>          
					</div>  -->
					
					</div>
					<div class="row">
					    <div class="col-sm-3">
						   <button class="btn btn-primary" id="Button" onclick="getTicketDetails()">Show</button>
						</div>
					</div>
				
					</div>
</div><br>