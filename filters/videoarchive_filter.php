<div class="card"> 
    <div class="card-body">
    <div class="col-12 grid-margin">
		
		<div class="row">
			<div class="col-md-3">
				<div class="form-group">
					<label for="client">Select Client</label>
						
						<select name="Client" id="Client" class="form-control form-control-sm col-sm-9" onchange="onchangebank()">
							<option value="">Select</option> 
							<?php if($_SESSION['client']=='All'){ ?>
										
							<?php echo getClients(); }
							   else{ 
							   $clients = explode(",",$_SESSION['client']);
							   for($i=0;$i<count($clients);$i++){ echo $clients[$i];?>
							   <option value="<?php echo $clients[$i];?>" <?php if(isset($_POST['Client'])){if($_POST['Client']==$clients[$i]){ echo 'selected';}}?>><?php echo $clients[$i];?></option> 
							   <?php }  }?>
						</select>
				</div>
			</div>
			
			<div class="col-md-3">
				<div class="form-group">
					<label for="bank">Select Bank</label>
						<select name="Bank" id="Bank" class="form-control form-control-sm col-sm-9" onchange="onchangecircle()">
								<option value="">Select</option>  
                            <?php if(isset($_POST['Client'])){ if(mysqli_num_rows($postbanklist)>0) {while($_postbank_list=mysqli_fetch_assoc($postbanklist)){ $client_bank = $_postbank_list['Bank'];?>   
                               <option value="<?php echo $client_bank;?>" <?php if(isset($_POST['Bank'])){if($_POST['Bank']==$client_bank){ echo 'selected';}}?>><?php echo $client_bank;?></option>
                            <?php } }}?>							
						</select>
				</div>
			</div>
			
			<div class="col-md-3">
			  <div class="form-group">
				<label for="Circle">Select Circle</label>
				<select name="Circle" id="Circle" class="form-control form-control-sm col-sm-9" onchange="onchangeatmid()">
					<option value="">All Circle</option>   
						<?php if(isset($_POST['Client'])){ if(mysqli_num_rows($postbankcirclelist)>0) {while($_postbankcirclelist=mysqli_fetch_assoc($postbankcirclelist)){ $client_bank_circle = $_postbankcirclelist['Circle'];?>   
                               <option value="<?php echo $client_bank_circle;?>" <?php if(isset($_POST['Circle'])){if($_POST['Circle']==$client_bank_circle){ echo 'selected';}}?>><?php echo $client_bank_circle;?></option>
                            <?php } }}?>	
				</select>
			  </div>
			</div>
			<div class="col-md-3">
				<div class="form-group">
					<label for="atmid">Select Atm</label>
						<select name="AtmID" id="AtmID" class="form-control form-control-sm col-sm-9">
								<option value="">Select</option>
															
							</select>
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
</div>
<br>         
                  
