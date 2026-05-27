<div class="card"> 
    <div class="col-12 grid-margin">
		
		<div class="row">
			<div class="col-md-3">
				<div class="form-group row">
					<label class="col-sm-6 col-form-label">Select Client<br></label>
						<div class="col-sm-8">
							<select name="Client" id="Client" class="form-control" onchange="onchangebank()">
								<option value="">Select</option> 
								<?php if($_SESSION['access']=='1'){?>
								<option value="All">All</option> 
								<?php }?>
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
							<select name="Bank" id="Bank" class="form-control" onchange="onchangeatmid()">
								<option value="">Select</option>   
							</select>
						</div>
				</div>
			</div>
			<div class="col-md-3">
				<div class="form-group row">
					<label class="col-sm-6 col-form-label">Select Atm<br></label>
						<div class="col-sm-8">
							<select name="AtmID" id="AtmID" class="form-control js-example-basic-single w-100">
								<option value="">Select</option>
															
							</select>
						</div>
				</div>
			</div>  

            <div class="col-sm-3">
			   <div>
			      <label class="col-sm-6 col-form-label"><br></label>
				  <div class="col-sm-3">
			      <button class="btn btn-primary" id="show" >Show</button>
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
                  
