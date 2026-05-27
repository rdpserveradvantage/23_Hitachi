<!DOCTYPE html>
<html lang="en">
    <?php 
    include('head.php');
	
   // $atmid = $_GET['atmid'];
    ?>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js" integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>  
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
            <!-- partial -->
            <div class="container-fluid page-body-wrapper">
                <!-- partial:partials/_settings-panel.html -->
                <!-- partial -->
                <!-- partial:partials/_sidebar.html -->
                <?php include('navbar.php');?>
                <!-- partial -->
                <div class="main-panel">
                    <div class="content-wrapper">
                        <div class="col-md-6 grid-margin stretch-card">
							  <div class="card">
								<div class="card-body">
								  <h4 class="card-title">Upload FSR Copy Images</h4>
								  <form id="form" method="POST" action="https://cssmumbai.sarmicrosystems.com/css/dash/esir/api/upload_fsr_image.php" enctype="multipart/form-data">
									<div class="row">
										<div class="col-12">
											<div class="form-group row">
											  <label class="col-sm-3 col-form-label">ATMID</label>
											  <div class="col-sm-9">  
											    <select name="atmid" id="AtmID" class="form-control js-example-basic-single w-100" required>
														<option value="">Select</option>
																					
													</select>
												<!--<input type="text" class="form-control" value="<?php //echo $atmid;?>" name="atmid" id="ATMID" readonly> -->
											  </div>
											</div>
										</div>
									</div>
									
									<div class="row">
										<div class="col-12">
											<div class="form-group">
											<label>File upload</label>
											<input type="file" name="image" class="form-control" required>
											</div>
										</div>
									</div>
									
									<!--
									    <div class="row"  id="add_row1">    
                                            <hr>
                    						<br>
                						</div>
                						
                						<div class="col-sm-12">
                						  <div class="col-sm-2">
                                            <input type="button" id="add" class="btn btn-primary" value="Add More +" onclick="addMore()">
                                          </div>
                                         
                                            <br>
                    						<hr>
                    						<br>
                						</div>
								     -->   
										<div  class="col-sm-12">
                						    <input id="submit_btn" type="submit" name="submit" value="submit" class="btn btn-success">
                						</div>
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
        <script src="js/select2.js"></script>
    <script>
	      var num=1;
        function addMore(){
          // $("#add").on('click',function(){ debugger;
            var key = num;
             num++;
            $("#totalrow").val(num); 
            var new_html = 	'<div class="row" id="add_row'+num+'"><div class="col-12"><div class="form-group"><label>File upload</label>';
			new_html += '<input type="file" name="img[]" class="form-control" required>';
			
			new_html += '</div></div></div>';
											
           
            $('#add_row'+key).after(new_html);
            
        //  });
		} 
		onchangeatmid();
		function onchangeatmid() {
				var bank = 'PNB';
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
		
		$(document).ready(function (e) {
			 $("#form").on('submit',(function(e) {
			  e.preventDefault();
			  $.ajax({
					 url: "https://cssmumbai.sarmicrosystems.com/css/dash/esir/api/upload_fsr_image.php",
			   type: "POST",
			   data:  new FormData(this),
			   contentType: false,
					 cache: false,
			   processData:false,
			   beforeSend : function()
			   {
				//$("#preview").fadeOut();
				$("#err").fadeOut();
			   },
			   success: function(data)
				  {
				     if(data[0].Code==200){
						 swal("Great!", "FSR Image Uploaded Successfully !", "success");
                         setTimeout(function(){ 
							   window.location.href="upload_atm_fsr_image.php";
						   }, 3000);
					 }else{
						swal("Error!", "FSR Image Uploaded Successfully !", "error");
					 }
				  },
				 error: function(e) 
				  {
				$("#err").html(e).fadeIn();
				  }          
				});
			 }));
			});
		
	</script>

    </body>
</html>
