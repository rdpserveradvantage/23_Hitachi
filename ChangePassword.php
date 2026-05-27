<!DOCTYPE html>
<html lang="en">
    <?php 
    include('head.php');
   
    ?>
	<!-- Video.j -->
	<link href="vendors/video-js/video-js.css" rel="stylesheet"/>
	<!-- /Video.j -->
	  
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
    
    <body class="sidebar-dark">
        <div class="container-scroller">
            <!-- partial:partials/_navbar.html -->
            <nav class="navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row default-layout-navbar navbar-dark">
                <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
                    <a class="navbar-brand brand-logo" href="index.html">
                        <img alt="logo" src="media/logo.png"/>
                    </a>
                    <a class="navbar-brand brand-logo-mini" href="index.html">
                        <img alt="logo" src="media/logo.png"/>
                    </a>
                </div>
                <div class="navbar-menu-wrapper d-flex align-items-stretch">
                    <button class="navbar-toggler navbar-toggler align-self-center" data-toggle="minimize" type="button">
                        <span class="fas fa-bars">
                        </span>
                    </button>
                    <ul class="navbar-nav navbar-nav-left">
                        <li class="nav-item nav-search d-none d-md-flex">
                            <div class="nav-link">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">
                                            <i class="fas fa-search">
                                            </i>
                                        </span>
                                    </div>
                                    <input aria-label="Search" class="form-control" placeholder="Search" type="text">
                                    </input>
                                </div>
                            </div>
                        </li>
                    </ul>
                    <ul class="navbar-nav navbar-nav-right">
                        <li class="nav-item d-none d-lg-block">
                            <a class="nav-link" href="#">
                                <i class="fas fa-ellipsis-v">
                                </i>
                            </a>
                        </li>
                    </ul>
                </div>
            </nav>
            <!-- partial -->
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
									<h4 class="card-title" style="color:#fff;">Change Password</h4>
			
								<div class="row">
									<div class="col-md-3">
										<div class="form-group row">
											<label class="col-sm-3 col-form-label" style="color:#fff;">Old Password<br></label>
											<div class="col-sm-9">
                                                <input type="text" id="password" class="form-control">
											</div>
										</div>
									</div>
									<div class="col-md-3">
										<div class="form-group row">
											<label class="col-sm-3 col-form-label" style="color:#fff;">New Password<br></label>
											<div class="col-sm-9">
                                                <input type="text" id="password" class="form-control">
											</div>
										</div>
									</div>
                                    <div class="col-md-3">
										<div class="form-group row">
											<label class="col-sm-3 col-form-label" style="color:#fff;">Confirm Password<br></label>
											<div class="col-sm-9">
												<input type="text" id="password" class="form-control">
											</div>
										</div>
									</div>
									
								</div>
							</div>
							<a href="" class="btn btn-primary" id="Button">Save</a>
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

