<!DOCTYPE html>
<html lang="en">
    <?php 
    include('head.php');
    //include('config.php');
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
			height: 210px;
			overflow-x: hidden;
			overflow-y: scroll;  */
			text-align:justify;
		}
	</style>
	<style>
		.menu-icon
		{
			width: 33px;
			margin-right: 7%;
		}
    th, td {
			white-space: nowrap;
		}
	</style>
     <?php include('top-navbar.php');
	        $dt=$_GET['dt'];
            $t=$_GET['t'];
			$atmid=$_GET['aid'];
	 ?>
            <div class="container-fluid page-body-wrapper">
                <!-- partial:partials/_settings-panel.html -->
                <!-- partial -->
                <!-- partial:partials/_sidebar.html -->
                <?php include('navbar.php');?>
                <!-- partial -->
					<div class="main-panel">
							<div class="content-wrapper">
							  <div class="page-header">
								<h3 class="page-title">
								  DVR Snaps
								</h3>
								<nav aria-label="breadcrumb">
								  <ol class="breadcrumb">
									<li class="breadcrumb-item"><a href="snaps.php">Snaps Manager</a></li> 
									<li class="breadcrumb-item"><a href="snaps_time.php?dt=<?php echo $dt;?>&aid=<?php echo $atmid;?>">Snaps Date</a></li>
									<li class="breadcrumb-item active" aria-current="page">DVR Snaps</li>
								  </ol>
								</nav>
							  </div>
							  <div class="row grid-margin">
								<div class="col-lg-12">
								  <div class="card">
									<div class="card-body">
									  <h4 class="card-title">Snaps</h4>
									  <p class="card-text">
										Click on any image to see clear view and download
									  </p>
									  <div id="lightgallery" class="row lightGallery">
										  <?php  
														 
														 $myDirectory=opendir("D:\\python_codes\\Server_socket\\House_Keeping\\ $atmid\\$dt\\$t");
															 
																	   // Gets each entry
																	  while(false !== ($entryName=readdir($myDirectory))) {
														  $dirArray[]=$entryName; 
														  }
														  
														   natcasesort($dirArray);
															$i=0;
															foreach ($dirArray as $file) {
															if($file!="." && $file!=".."){
															// echo $file;die;
															//echo $ext;
															$i++;
															$path = "D:\\python_codes\\Server_socket\\House_Keeping\\ $atmid\\$dt\\$t\\$file";
															$imgData = base64_encode(file_get_contents($path)); 
													$src = 'data: '.mime_content_type($path).';base64,'.$imgData; 
														   // $path=$directory."/".$dt."/".$t."/".$file;  
												 // echo $path;die;										
														  ?>
										<a href="<?php echo $src;?>" class="image-tile"><img src="<?php echo $src;?>" alt="image small"></a>
										<?php   }   
											  }
											 // echo print_r($dirArray);


											?>
										</div>
									</div>
								  </div>
								</div>
							  </div>
							  <!--<div class="row grid-margin">
								<div class="col-lg-12">
								  <div class="card px-3">
									<div class="card-body">
									  <h4 class="card-title">Without Thumbnails</h4>
									  <div id="lightgallery-without-thumb" class="row lightGallery">
										<a href="../../images/samples/1280x768/9.jpg" class="image-tile"><img src="../../images/samples/300x300/9.jpg" alt="image small"></a>
										<a href="../../images/samples/1280x768/10.jpg" class="image-tile"><img src="../../images/samples/300x300/10.jpg" alt="image small"></a>
										<a href="../../images/samples/1280x768/11.jpg" class="image-tile"><img src="../../images/samples/300x300/11.jpg" alt="image small"></a>
										<a href="../../images/samples/1280x768/12.jpg" class="image-tile"><img src="../../images/samples/300x300/12.jpg" alt="image small"></a>
									  </div>
									</div>
								  </div>
								</div>
							  </div>
							  <div class="row">
								<div class="col-lg-12">
								  <div class="card px-3">
									<div class="card-body">
									  <h4 class="card-title">Video Gallery</h4>
									  <div id="video-gallery" class="row lightGallery">
										<a class="image-tile col-xl-3 col-lg-3 col-md-3 col-md-4 col-6" href="https://www.youtube.com/watch?v=meBbDqAXago">
										  <img src="../../images/lightbox/thumb-v-y-1.jpg" alt="image">
										  <div class="demo-gallery-poster">
											  <img src="../../images/lightbox/play-button.png" alt="image">
										  </div>
										</a>
										<a class="image-tile col-xl-3 col-lg-3 col-md-3 col-md-4 col-6" href="https://www.youtube.com/watch?v=Pq9yPrLWMyU">
										  <img src="../../images/lightbox/thumb-v-y-2.jpg" alt="image">
										  <div class="demo-gallery-poster">
											  <img src="../../images/lightbox/play-button.png" alt="image">
										  </div>
										</a>
										<a class="image-tile col-xl-3 col-lg-3 col-md-3 col-md-4 col-6" href="https://vimeo.com/1084537">
										  <img src="../../images/lightbox/thumb-v-v-1.jpg" alt="image">
										  <div class="demo-gallery-poster">
											  <img src="../../images/lightbox/play-button.png" alt="image">
										  </div>
										</a>
										<a class="image-tile col-xl-3 col-lg-3 col-md-3 col-md-4 col-6" href="https://vimeo.com/35451452">
										  <img src="../../images/lightbox/thumb-v-v-2.jpg" alt="image">
										  <div class="demo-gallery-poster">
											  <img src="../../images/lightbox/play-button.png" alt="image">
										  </div>
										</a>
									  </div>
									</div>
								  </div>
								</div>
							  </div>-->
							</div>
							<!-- content-wrapper ends -->
						   
						  <?php include('footer.php');?>
                </div>
               </div>
        </div>
		<script src="vendors/js/vendor.bundle.base.js">
        </script>
        <script src="vendors/js/vendor.bundle.addons.js">
        </script>
		<script src="vendors/lightgallery/js/lightgallery-all.min.js"></script>
		  <!-- end plugin js for this page -->
		  <!-- inject:js -->
		  <script src="js/off-canvas.js"></script>
		  <script src="js/hoverable-collapse.js"></script>
		  <script src="js/misc.js"></script>
		  <script src="js/settings.js"></script>
		  <script src="js/todolist.js"></script>
		  <!-- endinject -->
		  <!-- Custom js for this page-->
		  <script src="js/light-gallery.js"></script>
 </body>
</html>