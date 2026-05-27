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

                    
        </div>
		<div class="row">	
		    <div class="col-md-3">
						<div class="form-group">
							<label for="Status">Select Status</label>
								<select name="status" id="status" class="form-control" >
										<option value="all">All</option>
										<option value="0">Request Pending</option>
										<option value="1">Request Processing</option>
										<option value="2">Request Closed</option>
									</select>
								
						</div>
			</div>

			<div class="col-md-3">
			    <div class="form-group">
							<label for="button"></label><br>
			         <button class="btn btn-primary" id="show_detail" >Show</button>
				</div>	 
			</div>
			<!--<a href="" class="btn btn-primary" id="Button">Clear</a>-->
			
		</div>
    </div>
	</div>
</div>
<br>         
                  
