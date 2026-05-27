<!DOCTYPE html>
<html lang="en">
    <?php include('head.php');?>
		
	<style>
    .table thead th, .jsgrid .jsgrid-table thead th {
    border-top: 0;
    border-bottom-width: 1px;
    font-weight: bold;
    font-size: .9rem;
    padding: 0.4375rem;
}
		.bt{
				border-top: 1px solid #1e1f33;
		  }
		  .br
		  {
				border-right: 1px solid #282844;
		  }
		  #accordion div.card-body {
		/*	margin:4px, 4px;
			padding:4px;
			background-color: green;
			width: 500px;  */
			height: 210px;
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
	<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js" integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>    
     <?php include('top-navbar.php');?>
            <!-- partial -->
            <div class="container-fluid page-body-wrapper">
                <!-- partial:partials/_settings-panel.html -->
                <!-- partial -->
                <!-- partial:partials/_sidebar.html -->
                <?php include('navbar.php');?>
                <!-- partial -->
		
  <div class="main-panel">
        <div class="content-wrapper">
          <div class="page-header">
			 <div class="center">
				<h3 class="page-title" >
					Change Password
				</h3>
			  </div>



            <!-- <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Forms</a></li>
                <li class="breadcrumb-item active" aria-current="page">Form elements</li>
                </ol>
            </nav> -->
          </div>
        
				  <div class="row">
					<div class="col-12 grid-margin">
								 <?php //include('filters/sitehealth_filter.php');
								   // include('filters/add_footagerequest_filter.php');
									
								 ?>
					</div>   
					        <div class="col-md-12 grid-margin stretch-card">
							  <div class="card">
								<div class="card-body">
								  <h4 class="card-title">Change Password</h4>
								  <p class="card-description">
									For Security Purpose
								  </p>
								  
									
									<div class="form-group">
									  <label for="exampleInputPassword1">Old Password</label>
									  <input type="password" class="form-control" id="inputOldPassword" placeholder="Old Password">
									</div>
									<div class="form-group">
									  <label for="exampleInputPassword1">Password</label>
									  <input type="password" class="form-control" id="inputPassword" placeholder="Password">
									</div>
									<div class="form-group">
									  <label for="exampleInputConfirmPassword1">Confirm Password</label>
									  <input type="password" class="form-control" id="inputConfirmPassword" placeholder="Confirm Password">
									</div>
									<button class="btn btn-primary mr-2" id="submitBtn">Submit</button>
									<!--<button type="submit" class="btn btn-primary mr-2">Submit</button>
									<button class="btn btn-light">Cancel</button>-->
								  
								</div>
							  </div>
							</div>

				  </div>
		  
		  
        </div>
		
		
        <!-- content-wrapper ends -->
       <!-- partial:partials/_footer.html -->
                    <?php include('footer.php');?>
                    <!-- partial -->
                </div>
                <!-- main-panel ends -->
			
            </div>
            <!-- page-body-wrapper ends -->
        </div>
        <!-- container-scroller -->
        <!-- plugins:js -->
        <script src="vendors/js/vendor.bundle.base.js">
        </script>
        <script src="vendors/js/vendor.bundle.addons.js">
        </script>
        <!-- endinject -->
        <!-- Plugin js for this page-->
        <!-- End plugin js for this page-->
        <!-- inject:js -->
        <script src="js/off-canvas.js">
        </script>
        <script src="js/hoverable-collapse.js">
        </script>
        <script src="js/misc.js">
        </script>
        <script src="js/settings.js">
        </script>
        <script src="js/todolist.js"></script>
        <!--<script src="js/chart.js"></script>-->
        <!-- endinject -->
        <!-- Custom js for this page-->
        <script src="js/change_password.js"></script>
        
        <!-- video.js -->
        
    </body>
</html>

