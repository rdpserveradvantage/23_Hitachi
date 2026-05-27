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
						
						<?php include('filters/snaps_filter.php');?>
						
                        <div class="card">
							<div class="card-body">
							  <h4 class="card-title" >SNAPS:</h4>
							  
							   <!-- <div class="row">
									<div class="col-md-2"> 
										<div class="form-group">
											<label>Date</label>
											<div>
												<div class="input-group">
													<input type="text" class="form-control" placeholder="mm/dd/yyyy"  id="S_date" name="S_date" >
													<div class="input-group-append">
														<span class="input-group-text"><i class="mdi mdi-calendar"></i></span>
													</div>
												</div>
											</div>
										</div>
									</div>
                               
                                    <div class="col-md-2"> 
                                        <input type="button"  value="Search" onclick="searchfile()" style="margin-top: 33px;">
                                    </div>
                                </div>  -->

                                <div class="row">
                                    <div class="col-12">
                        
                                        <div class="sk-fading-circle" id="spinner" style="display:none">
											<div class="sk-circle1 sk-circle"></div>
											<div class="sk-circle2 sk-circle"></div>
											<div class="sk-circle3 sk-circle"></div>
											<div class="sk-circle4 sk-circle"></div>
											<div class="sk-circle5 sk-circle"></div>
											<div class="sk-circle6 sk-circle"></div>
											<div class="sk-circle7 sk-circle"></div>
											<div class="sk-circle8 sk-circle"></div>
											<div class="sk-circle9 sk-circle"></div>
											<div class="sk-circle10 sk-circle"></div>
											<div class="sk-circle11 sk-circle"></div>
											<div class="sk-circle12 sk-circle"></div>
										</div>

                                        <div class="row" id="hd2"></div>


										<div class="row" id="snaps_details">
												 
									    </div>

                           

									</div><!-- end col -->
								</div>
								<!-- end row -->

							</div> <!-- end container -->
						</div>
						<!-- end wrapper -->
                    </div>
                    <?php include('footer.php');?>
                </div>
               </div>
        </div>
        <script src="vendors/js/vendor.bundle.base.js"></script>
        <script src="vendors/js/vendor.bundle.addons.js"></script>
		<script src="js/snaps.js"></script>
		<script src="js/select2.js"></script>
<script>
    
    function searchfile(){

     var S_date= document.getElementById("S_date").value;
     
     
     if(S_date==""){
         alert("Please Select Date"); 
     }
    else{
     
     $('#spinner').show();
     
      $.ajax({
           type:'POST',
          url:'searchSnapfile.php',
          data:"S_date="+S_date,
          success:function(msg){
             // alert(msg); 
             $('#spinner').hide(); 
              document.getElementById("hd2").innerHTML=msg;
             $("#hd1").hide();
          }
      })
      
     }
    }

</script>
      

<script>
jQuery(document).ready(function () {

   // Date Picker
   jQuery('#S_date').datepicker({
        autoclose: true,
        todayHighlight: true
    });


 
});

</script>

 </body>
</html>