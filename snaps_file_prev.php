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
	 ?>
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
							  <h4 class="card-title" >DVR SNAPS:</h4>
                        
                            <div class="row">
                                     <?php  
                                     $dt=$_GET['dt'];
                                     $t=$_GET['t'];
                                     $myDirectory=opendir("E:\\photos\\$dt\\$t");
                                         
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
                                        $path = "E:\\photos\\$dt\\$t\\$file";
										$imgData = base64_encode(file_get_contents($path)); 
                                $src = 'data: '.mime_content_type($path).';base64,'.$imgData; 
                                       // $path=$directory."/".$dt."/".$t."/".$file;  
                             // echo $path;die;	
                                     $realpath = realpath($file); 
echo $realpath;									 
                                      ?>
                                 <div class="col-lg-3 col-xl-2">
                                 
                                  <div class="file-man-box"  >
                                        
                                        <div class="file-img-box">
										
                                  <?php echo '<a href="'.$path.'" target="_blank" data-toggle="modal" 
                data-target="#exampleModal" class="open-AddBookDialog" data-id="'.$src.'"><img style="width:150px;height:150px" src="'.$src.'" alt="icon"></a>' ?>
                                              
                                        </div>
                                         <a href="<?php echo $src;?>"  title="image Download" class="file-download" download="<?php echo $file;?>"><i class="fa fa-download"></i> </a>
                                        <div class="file-man-title" title="Video File">
                                            <?php echo $file;?>
                                            
                                        </div>
                                    </div>
                                </div>
                                
          
          <?php   }   
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
		<!--Bootstrap modal -->
        <div class="modal-lg fade" 
             id="exampleModal"
             tabindex="-1" 
             role="dialog"
             aria-labelledby="exampleModalLabel" 
             aria-hidden="true">
            <div class="modal-dialog modal-lg" 
                 role="document">
                <div class="modal-content">
                    <!-- Modal heading -->
                    <div class="modal-header">
                        <h5 class="modal-title" 
                            id="exampleModalLabel">
                          Image
                      </h5>
                        <button type="button" 
                                class="close"
                                data-dismiss="modal" 
                                aria-label="Close">
                            <span aria-hidden="true">
                              ×
                          </span>
                        </button>
                    </div>
  
                    <!-- Modal body with image -->
                    <div class="modal-body">
                        <img id="img_src" src=""  />
                    </div>
                </div>
            </div>
        </div>
		 <script src="vendors/js/vendor.bundle.base.js">
        </script>
        <script src="vendors/js/vendor.bundle.addons.js">
        </script>

		<script>
		  $(document).on("click", ".open-AddBookDialog", function () {
     var src = $(this).data('id');
     $(".modal-body #img_src").prop('src',src );
     
});
		</script>

 </body>
</html>
   