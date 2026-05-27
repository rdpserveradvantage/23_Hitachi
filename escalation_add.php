<!DOCTYPE html>
<html lang="en">
    <?php include('head.php');
	 include('config.php');
	?>
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
                <?php include('navbar.php');?>
                <!-- partial -->
				
				
				 
                <div class="main-panel">
                    <div class="content-wrapper">
                        <div class="page-header">
																							
							<h3 class="page-title">
							  Add New Escalation
							</h3>
							
						  </div>
								<div class="col-12 grid-margin">
									<div class="card">
										<div class="card-body">
										  
										  <form class="form-sample" id="forms" action="add_escalation.php" method="POST" enctype="multipart/form-data" >
											
											<div class="row">
											 
											  <div class="col-md-4">
												<div class="form-group row">
												  <label class="col-sm-4 col-form-label">Bank</label>
												  <div class="col-sm-8">
													<select id="Bank" class="form-control" onchange="onchangeatmid()">
														  <?php echo getBanks();?>
													</select>
												  </div>
												</div>
											  </div>
											  <div class="col-md-4">
												<div class="form-group row">
													<label class="col-sm-4 col-form-label">Select Atm<br></label>
														<div class="col-sm-8">
															<select name="AtmID" id="AtmID"  class="form-control" >
																<option value="">Select</option>
																							
															</select>
														</div>
												</div>
											  </div>  
											  <div class="col-md-4">
												<div class="form-group row">
												  <label class="col-sm-4 col-form-label">Type</label>
												  <div class="col-sm-8">
													<select name="type" id="type" class="form-control">
                                                    <option value="two_way">two way</option>
                                                    <option value="bank">bank</option>
                                                    <option value="hk">hk</option>
                                                    <option value="ra">ra</option>
                                                    <option value="service">service</option>
                                                    <option value="police">police</option>

													</select>
												  </div>
												</div>
											  </div>
											 
											</div>  
											<div class="row">
											  <div class="col-md-4">
												<div class="form-group row">
												  <label class="col-sm-4 col-form-label">Name</label>
												  <div class="col-sm-8">
													<input type="text" class="form-control" name="name" id="name" value="-" />
												  </div>
												</div>
											  </div>
											 <div class="col-md-4">
												<div class="form-group row">
												  <label class="col-sm-4 col-form-label">Designation</label>
												  <div class="col-sm-8">
                                                  <input type="text" class="form-control" name="designation" id="designation" value="-" />

												  </div>
												</div>
											  </div>
											
											  <div class="col-md-4">
												<div class="form-group row">
												  <label class="col-sm-4 col-form-label">Mobile</label>
												  <div class="col-sm-8">
                                                  <input type="number" class="form-control" name="mobile" id="mobile" value="-" />

												  </div>
												</div>
											  </div> 
											  
											</div>
										    
											<div class="row">
											  <div class="col-md-4">
												<div class="form-group row">
												  <label class="col-sm-4 col-form-label">Landline</label>
												  <div class="col-sm-8">
													<input type="number" class="form-control" name="landline" id="landline" value="-" >
												  </div>
												</div>
											  </div>
											  <div class="col-md-4">
												<div class="form-group row">
												  <label class="col-sm-4 col-form-label">Email</label>
												  <div class="col-sm-8">
													<input type="text" class="form-control" name="email" id="email" value="-"/>
												  </div>
												</div>
											  </div>
											  <div class="col-md-4">
												<div class="form-group row">
												  <label class="col-sm-4 col-form-label">Priority</label>
												  <div class="col-sm-8">
                                                  <select name="priority" id="priority" class="form-control">
                                                    <option value="1">1</option>
                                                    <option value="2">2</option>
                                                    <option value="3">3</option>
                                                    
													</select>												  
                                                </div>
												</div>
											  </div>
											  
											</div>
											<div class="row">
											   
											  <div class="col-md-4">
												<div class="form-group row">
												  <label class="col-sm-4 col-form-label">Duration</label>
												  <div class="col-sm-8">
													<input type="text" class="form-control" name="duration" id="duration" value="-" />
												  </div>
												</div>
											  </div> 
											
											  <div class="col-md-4">
												<div class="form-group row">
												  <label class="col-sm-4 col-form-label">Repeat Interval</label>
												  <div class="col-sm-8">
													<input type="text" class="form-control" name="repeat_interval" id="repeatinterval" value=""/>
												  </div>
												</div>
											  </div>
											  
											</div>
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
        <script>
		   function onchangeatmid() {
				var bank = $("#Bank").val();
				$.ajax({
					type: "GET",
					url: "getMasterData.php", 
					data: {bank:bank},
					dataType: "html",
					success: (function (result) {
						$("#AtmID").html('');
						$("#AtmID").html(result);
					})
				})
			}
		</script>
    </body>
</html>
