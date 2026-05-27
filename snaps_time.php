<!DOCTYPE html>
<html lang="en">
    <?php 
    include('head.php');
   // include('config.php');
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
     <?php include('top-navbar.php');?>
            <div class="container-fluid page-body-wrapper">
                <!-- partial:partials/_settings-panel.html -->
                <!-- partial -->
                <!-- partial:partials/_sidebar.html -->
                <?php include('navbar.php');?>
                <!-- partial -->
                <div class="main-panel">
                    <div class="content-wrapper">
                        <h3 class="card-title" >Snaps Manager</h3>
                        <div class="card">
							<div class="card-body">
							  <h4 class="card-title" >SNAPS:</h4>
							  
                            <div class="row">
                                     <?php  
                                     $dt=$_GET['dt'];
									 $atmid = $_GET['aid'];
                                     $myDirectory=opendir("D:\\python_codes\\Server_socket\\House_Keeping\\ $atmid\\$dt");
                                     // Gets each entry
									 while(false !== ($entryName=readdir($myDirectory))) {
										  $dirArray[]=$entryName;
										  }
								     natcasesort($dirArray);
								    foreach ($dirArray as $file) {
								        if($file!="." && $file!=".."){
									        if($file!="DVRWorkDirectory" ){
                                      ?>
                                 <div class="col-lg-3 col-xl-2">
                                     <?php 
                                     
										$filecount = 0;
										$fi = new FilesystemIterator("D:\\python_codes\\Server_socket\\House_Keeping\\ $atmid\\$dt\\$file", FilesystemIterator::SKIP_DOTS);
										$filecount = iterator_count($fi);

										?>

                                 <a href="snaps_file.php?dt=<?php echo $dt;?>&t=<?php echo $file;?>&aid=<?php echo $atmid;?>" title="Click ME">  <div class="file-man-box">
                                    <p>Total : <?php echo $filecount; ?></p>                                        
                                        <div class="file-img-box">
                                            <img src="https://img.icons8.com/plasticine/100/000000/shared-folder.png">
                                        </div>
                                        
                                        <div class="file-man-title" title="Date" >
                                            <?php echo $file;?>
                                            
                                        </div>
                                    </div></a>
                                    <a href="downloadall.php?dt=<?php echo $dt;?>&t=<?php echo $file;?>"  title="image Download" class="file-download"><i class="fa fa-download"></i> </a>
                                </div>
          
          
          <?php  }}   
          }
         // echo print_r($dirArray);
        ?>
                                
                                
                                
                                

                                
                            </div>

                         
							</div> <!-- end container -->
						</div>
						<!-- end wrapper -->
                    </div>
                    <?php include('footer.php');?>
                </div>
               </div>
        </div>
        <script src="vendors/js/vendor.bundle.base.js">
        </script>
        <script src="vendors/js/vendor.bundle.addons.js">
        </script>


 </body>
</html>