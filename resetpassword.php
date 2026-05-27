<!DOCTYPE html>
<html lang="en">
    <?php 
    include('head.php');
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
		/*	margin:4px, 4px;
			padding:4px;
			background-color: green;
			width: 500px;  
			height: 210px; */
			overflow-x: hidden;
			overflow-y: scroll;
			text-align:justify;
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
                <!-- partial:partials/_settings-panel.html -->
                <!-- partial -->
                <!-- partial:partials/_sidebar.html -->
                <?php include('navbar.php');?>
                <!-- partial -->
                <div class="main-panel">
                    <div class="content-wrapper">
                    
						<div class="card">
							<div class="card-body">
									<h4 class="card-title" style="color:#fff;">Reset Password</h4>
			
								<div class="row">
									<div class="col-md-3">
										<div class="form-group row">
											<label class="col-sm-3 col-form-label" style="color:#fff;">Select Client<br></label>
											<div class="col-sm-9">
												<select name="Phase" id="Phase"  class="form-control">
													<option>PNB</option>
													<option>HITACHI</option>
												</select>
											</div>
										</div>
									</div>
									<div class="col-md-3">
										<div class="form-group row">
											<label class="col-sm-3 col-form-label" style="color:#fff;">Select User<br></label>
											<div class="col-sm-9">
												<select name="Phase" id="Phase"  class="form-control">
													<option>Select</option>
													<option>Admin</option>
												</select>
											</div>
										</div>
									</div>
									
								</div>
							</div>
							<a href="" class="btn btn-primary" id="Button">Reset</a>
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
        <script src="js/data-table.js">
        </script>
        <script src="vendors/video-js/video.min.js">
        </script>

    </body>
</html>

