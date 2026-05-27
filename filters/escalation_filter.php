<div class="card">                        

<div class="col-12 grid-margin">
                                <br>
                  <form class="form-sample">
                    
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
										<select name="AtmID" id="AtmID"  class="form-control js-example-basic-single w-100"  >
											<option value="">Select</option>
																		
										</select>
									</div>
							</div>
						</div> 
                    <div class="col-md-3">
						<div class="form-group row">
						    <label class="col-sm-6 col-form-label">Select Type</label>
							<div class="col-sm-9">
							    <select name="type" id="type"  class="form-control">
								    <option value="all">All</option>
									<option value="two_way">Two way</option>
									<option value="bank">Bank</option>
									<option value="hk">HK</option>
									<option value="ra">RA</option>
									<option value="service">Service</option>
									<option value="police">Police</option>
																		
								</select>
							</div>
						</div>
					</div>
                    
                    </div>
					<!--<a href="" class="btn btn-primary" style="height: 40px; padding: 10px 34px; " id="Button">Show</a> -->
                    <a href="escalation_add.php" class="btn btn-primary" style="height: 40px; padding: 10px 34px; " id="Button">New</a>
                  </form>
                </div>
</div><br>              
                    


