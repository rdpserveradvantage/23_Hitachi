<!DOCTYPE html>
<html lang="en">
    <?php 
    include('head_liveView.php');
	$url = "http://" . $_SERVER['SERVER_NAME'] ;
    $url = rtrim($url,"/");
	
   ?>
   
   
	
	<style>
	    iframe {
		  border: 2px solid grey;
		}
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
			/*overflow-x: hidden;
			overflow-y: scroll; */
			text-align:justify;
		}
	</style>
	<style>
		.menu-icon
		{
			width: 33px;
			margin-right: 7%;
		}
		.videoplay_msg{
			display:none;
		}
		#camera1 { width: 100% !important;padding-left:0px !important;padding-right:0px !important;}
		#camera2 { width: 100% !important;padding-left:0px !important;padding-right:0px !important;}
		#camera3 { width: 100% !important;padding-left:0px !important;padding-right:0px !important;}
		#camera4 { width: 100% !important;padding-left:0px !important;padding-right:0px !important;}
		
		#camera1 iframe{ width: 446px;padding-left:0px !important;padding-right:0px !important;}
		#camera2 iframe{ width: 446px;padding-left:0px !important;padding-right:0px !important;}
		#camera3 iframe{ width: 446px;padding-left:0px !important;padding-right:0px !important;}
		#camera4 iframe{ width: 446px;padding-left:0px !important;padding-right:0px !important;}
		
		#camera1 iframe img{ width: 428px !important;height:265px !important;}
		#camera2 iframe img{ width: 428px !important;height:265px !important;}
		#camera3 iframe img{ width: 428px !important;height:265px !important;}
		#camera4 iframe img{ width: 428px !important;height:265px !important;}
		
		
@media (min-width: 768px){
.col-md-5 {
    flex: 0 0 41.66667%;
    max-width: 35.66667%; !important;
}
}

@media screen and (max-width:900px) {
    .card-body {
        height: auto   OR  0px !important;
        padding-bottom: 0px;
    }

	
	
#camera1 iframe{
height: 310px;
}
#stopCamera1{
padding-right: 0px;
}
#camera2 iframe{
height: 310px;
}
#stopCamera2{
padding-right: 0px;
}
#camera3 iframe{
height: 310px;
}
#stopCamera3{
padding-right: 0px;
}
#camera4 iframe{
height: 310px;
}
#stopCamera4{
padding-right: 0px;
}
}

@media only screen and (max-width: 480px) {
  #camera1 iframe{
	height: 220px !important;
	width: 285px !important;
	
  }
  #camera1 {
	  height: 220px !important;
	
  }
  
  #camera2 iframe{
	height: 220px !important;
	width: 285px !important;
	
  }
  #camera2 {
	  height: 220px !important;
	
  }
  
  #camera3 iframe{
	height: 220px !important;
	width: 285px !important;
	
  }
  #camera3 {
	  height: 220px !important;
	
  }
  
  #camera4 iframe{
	height: 220px !important;
	width: 285px !important;
	
  }
  #camera4 {
	  height: 220px !important;
	
  }
}
		
	</style>
	
	<style>
	    .card {
  /* Optional styling for the card */
  border: 1px solid #ddd;
  border-radius: 5px;
  overflow: hidden;
}

.card-body {
  padding: 15px;
}

.iframe-container {
  position: relative;
  width: 100%;
  padding-top: 56.25%; /* 16:9 Aspect Ratio */
  height: 0;
  overflow: hidden;
}

.iframe-container iframe {
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  border: 0;
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
                        
<div class="col-12 grid-margin">
<h3 class="card-title">Live View</h3>
             <!-- 
			<div class="card">
			  <div class="card-body">
				<div class="iframe-container">
				  <iframe id="iframe_resp" src="" frameborder="0" allowfullscreen></iframe>
				</div>
			  </div>
			</div>  -->
			  
              <div class="card">
                <div class="card-body">
                    <input type="hidden" id="url_link" value="<?php echo $url;?>">
                 
                    <?php include('filters/liveview_filter.php');?>
					
					       <h6 style="color:red;">Please note: Click Refresh Button manually after watching any site live view <button class="btn btn-primary" id="show_detail"><a href="live_view.php">Refresh</a>	</button></h6> 
						    
					            <div class="row">
								   <!-- <div class="sortblock col-md-1 form-group"></div>  -->
                                    <div class="sortblock col-md-6 form-group">
									    <h6 class="videoplay_msg" id="stop_camera1">Video will stop automatically after <span id="progressBar1"></span> seconds</h6> 
                                        <input type="hidden" id="camurl_1">
										
										<div class="card form-group">
										    
                                            <div class="card-header" id="cameraheading-1" role="tab">
                                                Lobby Camera 
												<span class="videoplay_msg" alt="Play ON" style="cursor:pointer;color:#0099CC;float:right;" id="startCamera1" onclick="startCamera(1)">
												
												</span>
												<span id="stopCamera1" class="videoplay_msg" alt="Play STOP" style="cursor:pointer;color:red;float:right;padding-right:10px;" onclick="stopCamera(1)">
												
												</span>
											</div>
											
                                            <div class="card-body" id="camera1" style="height: 327px;padding-top:0px;">
											    <div class="video-container" id="video-container1" style="height: 265px;padding-top:0px;background-color:#27367f;display:none;">
												  <!--  <iframe id="iframe1" src="" title="description" style="height: 265px;width: 428px;" scrolling="no"></iframe> -->
												</div>
											     
                                            </div>
                                        </div>
                                    </div>
									<!-- <div class="sortblock col-md-1 form-group"></div> --> 
                                    <div class="sortblock col-md-6 form-group">
									    <h6 class="videoplay_msg" id="stop_camera2">Video will stop automatically after <span id="progressBar2"></span> seconds</h6> 
                                        <input type="hidden" id="camurl_2">
										<div class="card">
                                            <div class="card-header" id="cameraheading-2" role="tab">
                                                Backroom Camera
												<span class="videoplay_msg" alt="Play ON" style="cursor:pointer;color:#0099CC;float:right;" id="startCamera2" onclick="startCamera(2)">
												
												</span>
												<span id="stopCamera2" class="videoplay_msg" alt="Play STOP" style="cursor:pointer;color:red;float:right;padding-right:10px;" onclick="stopCamera(2)">
												 
												</span>
                                            </div>
                                            <div class="card-body" id="camera2" style="height:327px;padding-top:0px;">
											   <!-- <div class="video-container" id="camera2" style="height:250px;width:360px;">
                                    
                                                 </div> -->
                                                
                                            </div>
                                        </div>
                                    </div>
									
                                    
                                </div>
								
								<div class="row">
								    <!-- <div class="sortblock col-md-1 form-group"></div> -->
                                    <div class="sortblock col-md-6 form-group">
									    <h6 class="videoplay_msg" id="stop_camera3">Video will stop automatically after <span id="progressBar3"></span> seconds</h6> 
                                        <input type="hidden" id="camurl_3">
										<div class="card form-group">
                                            <div class="card-header" id="cameraheading-3" role="tab">
                                                Outdoor Camera
												<span class="videoplay_msg" alt="Play ON" style="cursor:pointer;color:#0099CC;float:right;" id="startCamera3" onclick="startCamera(3)">
												 
												</span>
												<span id="stopCamera3" class="videoplay_msg" alt="Play STOP" style="cursor:pointer;color:red;float:right;padding-right:10px;" onclick="stopCamera(3)">
												
												</span>
                                            </div>
                                            <div class="card-body" id="camera3" style="height:327px;padding-top:0px;">
											    <!-- <div class="video-container" id="camera3" style="height:250px;width:360px;">
                                    
                                                 </div> -->
                                                <!--<video class="video-js" controls="" data-setup="{}" height="auto" id="my-video" poster="" preload="auto" width="auto">
                                                    <source src="http://103.141.218.26:5020/?name=1" type="application/x-mpegURL">
                                                    </source>
                                                    <source src="media/sample.mp4" type="video/webm">
                                                    </source>
                                                </video>-->
                                            </div>
                                        </div>
                                    </div>
									<!-- <div class="sortblock col-md-1 form-group"></div> -->
                                    <div class="sortblock col-md-6 form-group">
									    <h6 class="videoplay_msg" id="stop_camera4">Video will stop automatically after <span id="progressBar4"></span> seconds</h6> 
                                        <input type="hidden" id="camurl_4">
										<div class="card">
                                            <div class="card-header" id="cameraheading-4" role="tab">
                                                Pinhole Camera
												<span class="videoplay_msg" alt="Play ON" style="cursor:pointer;color:#0099CC;float:right;" id="startCamera4" onclick="startCamera(4)">
												
												</span>
												<span id="stopCamera4" class="videoplay_msg" alt="Play STOP" style="cursor:pointer;color:red;float:right;padding-right:10px;" onclick="stopCamera(4)">
												
												</span>
                                            </div>
                                            <div class="card-body" id="camera4" style="height:327px;padding-top:0px;">
											   <!-- <div class="video-container" id="camera4" style="height:250px;width:360px;">
                                    
                                                 </div> -->
                                                
                                            </div>
                                        </div>
                                    </div>
									
                                    
                                </div>
					
					
                    </div>
                   </div>
                 
                </div>
              </div>
</div>
                    </div>
                    <?php include('footer.php');?>
                </div>
            </div>
        </div>
        <script src="vendors/js/vendor.bundle.base.js"></script>
        <script src="vendors/js/vendor.bundle.addons.js"></script>
        <script src="js/off-canvas.js"></script>
        <script src="js/hoverable-collapse.js"></script>
        <script src="js/misc.js"></script>
        <script src="js/settings.js"></script>
        <script src="js/todolist.js"></script>
		<!-- <script src="js/live_view_client_bank_circle_atmid.js"></script> -->
		<script src="js/client_bank_circle_atmid.js"></script>
        <script src="js/dashboard.js"></script>
		<script src="js/select2.js"></script>
        <script src="vendors/video-js/video.min.js">
        </script>

        <!-- <script>
            if(isset($_POST['submit']))
            {
                    header("Location: updatesite.php");
            }
        </script> -->
        <script>
		/*
		$('#startCamera1').click(function(){
			var cam = $('#camurl_1').val();
			startCamera(1,cam);
			setStopInterval(1);
			$("#stop_camera1").css("display","block");
			$("#stopCamera1").css("display","block");
			$("#stop_camera1").css("display","block");
		}); */
		
	$('#iframe1').on('load', function(){ alert('hi');
      document.getElementById("camera1").html = "";
    });
		
		function startCamera(id){
			var cam = $('#camurl_'+id).val();
			$("#camera"+id).html('');
			$("#camera"+id).html('<iframe src="'+ cam + '" title="description" style="height: 265px;width: 428px;display:block;" scrolling="no"></iframe>');
			setStopInterval(id);
			$("#stop_camera"+id).css("display","block");
			$("#stopCamera"+id).css("display","block");
			$("#stop_camera"+id).css("display","block");
		}
		function stopCamera(id){
			$("#camera"+id).html('');
			$("#stop_camera"+id).css("display","none");
			if(id==1){
			timeleft_1 = 0;
			clearInterval(downloadTimer_1);
			$("#progressBar"+id).html(timeleft_1) ;
			}
			if(id==2){
			timeleft_2 = 0;
			clearInterval(downloadTimer_2);
			$("#progressBar"+id).html(timeleft_2) ;
			}
			if(id==3){
			timeleft_3 = 0;
			clearInterval(downloadTimer_3);
			$("#progressBar"+id).html(timeleft_3) ;
			}
			if(id==4){
			timeleft_4 = 0;
			clearInterval(downloadTimer_4);
			$("#progressBar"+id).html(timeleft_4) ;
			}
		}
		var timeleft_1 = 120;
		var downloadTimer_1 = "";
		var timeleft_2 = 120;
		var downloadTimer_2 = "";
		var timeleft_3 = 120;
		var downloadTimer_3 = "";
		var timeleft_4 = 120;
		var downloadTimer_4 = "";
		
		function set_StopInterval(id){ debugger;
			if(id==1){
				if(timeleft_1>0){
					   clearInterval(downloadTimer_1);
					   timeleft_1 = 120;
					
				}
				downloadTimer_1 = setInterval(function(){
					  if(timeleft_1 <= 0){
						clearInterval(downloadTimer_1);
					  }

					  timeleft_1 -= 1;
					  if(timeleft_1==0){
						stopCamera(id);
					  }
					   if(timeleft_1>=0){
					   $("#progressBar"+id).html(timeleft_1) ;
					   }
					  console.log(timeleft_1);
					}, 1000);
			}
			
		}
		//sub-frame-error-details
		function setStopInterval(id){
			if(id==1){
				timeleft_1 = 120;
				downloadTimer_1 = setInterval(function(){
					  if(timeleft_1 <= 0){
						clearInterval(downloadTimer_1);
					  }

					  timeleft_1 -= 1;
					  
					  if(timeleft_1==0){
						stopCamera(id);
					  }
					   if(timeleft_1>=0){
					   $("#progressBar"+id).html(timeleft_1) ;
					   }
					  console.log(timeleft_1);
					}, 1000);
			}
			if(id==2){
				timeleft_2 = 120;
				downloadTimer_2 = setInterval(function(){
					  if(timeleft_2 <= 0){
						clearInterval(downloadTimer_2);
					  }

					  timeleft_2 -= 1;
					  
					  if(timeleft_2==0){
						stopCamera(id);
					  }
					   if(timeleft_2>=0){
					   $("#progressBar"+id).html(timeleft_2) ;
					   }
					  console.log(timeleft_2);
					}, 1000);
			}
			if(id==3){
				timeleft_3 = 120;
				downloadTimer_3 = setInterval(function(){
					  if(timeleft_3 <= 0){
						clearInterval(downloadTimer_3);
					  }

					  timeleft_3 -= 1;
					  
					  if(timeleft_3==0){
						stopCamera(id);
					  }
					   if(timeleft_3>=0){
					   $("#progressBar"+id).html(timeleft_3) ;
					   }
					  console.log(timeleft_3);
					}, 1000);
			}
			if(id==4){
				timeleft_4 = 120;
				downloadTimer_4 = setInterval(function(){
					  if(timeleft_4 <= 0){
						clearInterval(downloadTimer_4);
					  }

					  timeleft_4 -= 1;
					  
					  if(timeleft_4==0){
						stopCamera(id);
					  }
					   if(timeleft_4>=0){
					   $("#progressBar"+id).html(timeleft_4) ;
					   }
					  console.log(timeleft_4);
					}, 1000);
			}
		}
		$("#show_detail").click(function(){
			var atmid = $('#AtmID').val();
			if(atmid==''){
				swal("Oops!", "AtmID Must Required !", "error");
				return false;
			}
			//setcamera(atmid);
			set_Camera(atmid);
		});
		
		function set_Camera(atmid){
			var Client = $("#Client").val();
			var Bank = $("#Bank").val();
			var AtmID = $("#AtmID").val();
			if(Bank==''){
				swal("Oops!", "Bank Must Required !", "error");
				return false;
			}
			if(AtmID==''){
				swal("Oops!", "AtmID Must Required !", "error");
				return false;
			}
			var url_link = $('#url_link').val();
			$.ajax({
				url: "live_view_ajax.php", 
				type: "POST",
				data: {bank:Bank,atmid:AtmID,client:Client},
				success: (function (result) { debugger;
				    console.log(result);
				    var obj = JSON.parse(result);
				    
					var dvrip = obj[0].dvrip;
					
					var dvr_model = obj[0].dvr_model;
					var dvr_model_1 = obj[0].cam1;
					var dvr_model_2 = obj[0].cam2;
					var dvr_model_3 = obj[0].cam3;
					var dvr_model_4 = obj[0].cam4;
					
					var uname = obj[0].uname;
					var pwd = obj[0].pwd;
					var username_1 = obj[0].username1;
					var username_2 = obj[0].username2;
					var username_3 = obj[0].username3;
					var username_4 = obj[0].username4;
					
					var password_1 = obj[0].password1;
					var password_2 = obj[0].password2;
					var password_3 = obj[0].password3;
					var password_4 = obj[0].password4;
					
					var port = obj[0].port;
					var port_1 = obj[0].port1;
					var port_2 = obj[0].port2;
					var port_3 = obj[0].port3;
					var port_4 = obj[0].port4;
					
					//var routerip = obj[0].RouterIP;
					//var current_status = obj.live;
					var port = "554";
					var cam_type = ""
					if(dvr_model=='uniview'){
						cam_type = "nvr";
					}
					else if(dvr_model=='Hikvision_Nvr'){
						cam_type = "nvr";
					}
					else{
						cam_type = "dvr";
					}
					var cam_type_1 = "";var cam_type_2 = "";var cam_type_3 = "";var cam_type_4 = "";
					if(dvr_model_1=='uniview'){
						cam_type_1 = "nvr";
					}
					else if(dvr_model_1=='Hikvision_Nvr'){
						cam_type_1 = "nvr";
					}
					else{
						cam_type_1 = "dvr";
					}
					if(dvr_model_2=='uniview'){
						cam_type_2 = "nvr";
					}
					else if(dvr_model_2=='Hikvision_Nvr'){
						cam_type_2 = "nvr";
					}
					else{
						cam_type_2 = "dvr";
					}
					if(dvr_model_3=='uniview'){
						cam_type_3 = "nvr";
					}
					else if(dvr_model_3=='Hikvision_Nvr'){
						cam_type_3 = "nvr";
					}
					else{
						cam_type_3 = "dvr";
					}
					if(dvr_model_4=='uniview'){
						cam_type_4 = "nvr";
					}
					else if(dvr_model_4=='Hikvision_Nvr'){
						cam_type_4 = "nvr";
					}
					else{
						cam_type_4 = "dvr";
					}
					
					
					if(url_link=='http://192.168.100.23'){
						
					}else{
						url_link = "http://103.141.218.26";
					}
					
					var ips = ["10.109.64.25", "10.109.64.23", "10.109.64.21", "10.109.64.24","172.55.20.136","10.109.64.27","10.185.181.126","172.55.23.252","10.109.64.18","10.137.0.60","10.109.64.20"];
                    var is_rtsp_1 = 0;var is_rtsp_2 = 0;var is_rtsp_3 = 0;var is_rtsp_4 = 0;
					if(ips.includes(dvrip)){
						is_rtsp_1 = 1;
						is_rtsp_2 = 1;
						is_rtsp_3 = 1;
						is_rtsp_4 = 1;
					}
					
					var agra_ips = ['172.55.21.213',
					                '172.55.29.124',
									'10.109.11.86',
									'172.51.9.195',
									'172.51.14.240',
									'172.55.21.211',
									'172.51.9.139',
									'172.55.26.113',
									'172.55.26.231',
									'172.51.14.145',
									'172.51.14.194',
									'172.55.19.188',
									'172.55.27.10',
									'172.55.27.125',
									'172.55.27.66',
									'172.55.24.214',
									'172.55.24.109',
									'172.55.28.192',
									'172.55.28.157',
									'172.55.29.182',
									'172.55.28.167',
									'172.55.29.185',
									'172.55.29.187',
									'172.55.29.193',
									'10.185.182.55',
									'172.55.29.169',
									'172.55.29.134',
									'172.55.29.137',
									'172.55.28.68',
									'172.55.29.86',
									'172.55.28.245',
									'172.55.28.236',
									'172.55.29.42',
									'172.55.29.51',
									'172.55.29.164',
									'172.55.29.64',
									'172.55.29.124',
									'172.55.29.61',
									'172.55.29.41',
									'172.55.21.160',
									'172.55.28.106',
									'172.55.28.109',
									'172.55.23.98',
									'172.55.29.154',
									'172.55.19.148',
									'172.55.19.118',
									'172.55.23.88',
									'172.55.29.122',
									'172.55.19.135',
									'172.55.28.15',
									'172.55.28.73',
									'172.55.19.193',
									'172.55.29.93',
									'172.55.22.221',
									'10.248.0.77',
									'10.185.183.19',
									'172.55.20.226',
									'172.55.18.28',
									'172.55.18.44',
									'172.55.20.211',
									'10.185.181.226',
									'172.55.18.126',
									'172.55.30.150',
									'10.185.183.18',
									'10.248.0.236',
									'10.248.0.237',
									'172.55.28.157',
									'172.55.28.236',
									'172.55.29.124',
									'172.55.23.124',
									'10.109.9.160',
									'10.109.9.15'];
						var is_agra_site = 0;			
						    if(agra_ips.includes(dvrip)){
								is_agra_site = 1;
								
							}			
					
					if(dvr_model_1=='CPPLUS_INDIGO' || dvr_model_1=='CPPLUS'){
						is_rtsp_1 = 1;
					}
					if(dvr_model_2=='CPPLUS_INDIGO' || dvr_model_2=='CPPLUS'){
						is_rtsp_2 = 1;
					}
					if(dvr_model_3=='CPPLUS_INDIGO' || dvr_model_3=='CPPLUS'){
						is_rtsp_3 = 1;
					}
					if(dvr_model_4=='CPPLUS_INDIGO' || dvr_model_4=='CPPLUS'){
						is_rtsp_4 = 1;
					}
					
					if(is_rtsp_1==1){
						var cam1 = url_link+":5026/?name="+username_1+"-"+password_1+"-"+dvrip+"-"+port_1+"-"+dvr_model_1+"-"+cam_type_1+"-1";
						
					}else{
					
						var cam1 = url_link+":5040/?name="+username_1+"-"+password_1+"-"+dvrip+"-"+port_1+"-"+dvr_model_1+"-"+cam_type_1+"-1";
						
					}
					
					if(is_rtsp_2==1){
						var cam2 = url_link+":5027/?name="+username_2+"-"+password_2+"-"+dvrip+"-"+port_2+"-"+dvr_model_2+"-"+cam_type_2+"-2";
						
					}else{
					
						var cam2 = url_link+":5041/?name="+username_2+"-"+password_2+"-"+dvrip+"-"+port_2+"-"+dvr_model_2+"-"+cam_type_2+"-2";
						
					}
					
					if(is_rtsp_3==1){
						var cam3 = url_link+":5028/?name="+username_3+"-"+password_3+"-"+dvrip+"-"+port_3+"-"+dvr_model_3+"-"+cam_type_3+"-3";
						
					}else{
					    var cam3 = url_link+":5042/?name="+username_3+"-"+password_3+"-"+dvrip+"-"+port_3+"-"+dvr_model_3+"-"+cam_type_3+"-3";
						
					}
					
					if(is_rtsp_4==1){
						var cam4 = url_link+":5029/?name="+username_4+"-"+password_4+"-"+dvrip+"-"+port_4+"-"+dvr_model_4+"-"+cam_type_4+"-4";
					}else{
					    var cam4 = url_link+":5043/?name="+username_4+"-"+password_4+"-"+dvrip+"-"+port_4+"-"+dvr_model_4+"-"+cam_type_4+"-4";
					}
					
					if(is_agra_site==1){
						var cam1 = url_link+":5026/?name="+uname+"-"+pwd+"-"+dvrip+"-"+port+"-"+dvr_model+"-"+cam_type+"-1";
						var cam2 = url_link+":5027/?name="+uname+"-"+pwd+"-"+dvrip+"-"+port+"-"+dvr_model+"-"+cam_type+"-2";
						var cam3 = url_link+":5028/?name="+uname+"-"+pwd+"-"+dvrip+"-"+port+"-"+dvr_model+"-"+cam_type+"-3";
						var cam4 = url_link+":5029/?name="+uname+"-"+pwd+"-"+dvrip+"-"+port+"-"+dvr_model+"-"+cam_type+"-4";
					}
					
				  console.log("cam1 :"+cam1);
				  console.log("cam2 :"+cam2);
				  console.log("cam3 :"+cam3);
				  console.log("cam4 :"+cam4);
				  
				  $("#iframe_resp").attr('src',cam1);
				  
				//  $("#camera1").attr('src',cam1);
				  $("#camera1").html('<iframe id="iframe1" src="'+ cam1 + '" title="description" style="height: 327px;width: 430px;" scrolling="no"></iframe>'); 
				  $("#camera2").html('<iframe id="iframe2" src="'+ cam2 + '" title="description" style="height: 327px;width: 430px;" scrolling="no"></iframe>');
				  $("#camera3").html('<iframe id="iframe3" src="'+ cam3 + '" title="description" style="height: 327px;width: 430px;" scrolling="no"></iframe>');
				  $("#camera4").html('<iframe id="iframe4" src="'+ cam4 + '" title="description" style="height: 327px;width: 430px;" scrolling="no"></iframe>');
				 
				  $("#camurl_1").val(cam1);
				  $("#camurl_2").val(cam2);
				  $("#camurl_3").val(cam3);
				  $("#camurl_4").val(cam4);
				  
				  $("#video-container1").css("display", "block");
				 // document.getElementById("video-container1").style.display = "block";
				 // setStopInterval(1);
				// set_StopInterval(1);
				 /* $("#stop_camera1").css('display','block');
				  $('#startCamera1').css('display','block');
				  $('#stopCamera1').css('display','block');
				  $('#startCamera2').css('display','block');
				  $('#stopCamera2').css('display','block');
				  $('#startCamera3').css('display','block');
				  $('#stopCamera3').css('display','block');
				  $('#startCamera4').css('display','block');
				  $('#stopCamera4').css('display','block'); */
				   
				})
		    });
		}
		
		    function setcamera(atmid){
				if(atmid=='P3ENMM09'){
				  var cam1 = "http://103.141.218.26:5020/?name=1";
				  $("#camera1").html('<iframe src="'+ cam1 + '" title="description" style="height: 350px;width: 100%;"></iframe>');
				 
				  $("#camera").html('<option value="">Select Camera</option><option value="http://103.141.218.26:5020/?name=2">Camera 2</option><option value="http://103.141.218.26:5020/?name=3">Camera 3</option><option value="http://103.141.218.26:5020/?name=4">Camera 4</option>');
				  $("#camurl_1").val("http://103.141.218.26:5020/?name=1");
				  $("#camurl_2").val("http://103.141.218.26:5020/?name=2");
				  $("#camurl_3").val("http://103.141.218.26:5020/?name=3");
				  $("#camurl_4").val("http://103.141.218.26:5020/?name=4");
				  setStopInterval(1);
				  $("#stop_camera1").css('display','block');
				  $('#startCamera1').css('display','block');
				  $('#stopCamera1').css('display','block');
				  $('#startCamera2').css('display','block');
				  $('#stopCamera2').css('display','block');
				  $('#startCamera3').css('display','block');
				  $('#stopCamera3').css('display','block');
				  $('#startCamera4').css('display','block');
				  $('#stopCamera4').css('display','block');
				}
			}
			
			function setextracamera(id,cam){
				$("#camera"+id).html('');
				$("#camera"+id).html('<iframe src="'+ cam + '" title="description" style="height: 350px;width: 100%;"></iframe>');
			}
			$("#camera").change(function(){ 
				var cam = $("#camera").val();
				
				var cam_heading= $("#camera option:selected").text();
				
				var arr = cam_heading.split(' ');
				var id = arr[1];
				$('#cameraheading-'+id).html('');
				$('#cameraheading-'+id).html(cam_heading);
				$("#camera"+id).html('');
				$("#camera"+id).html('<iframe src="'+ cam + '" title="description" style="height: 350px;width: 100%;"></iframe>');
				
			});
		
	
            function chngeSort(Value)
            {

                if (Value==4) 
                {

                $(".sortblock").addClass('col-md-'+Value);
                $('.sortblock').removeClass('col-md-6');
                $('.sortblock').removeClass('col-md-12');

                $("#sort"+Value).addClass('text-muted');
                $("#sort"+Value).removeClass('text-white');

                $('#sort6').removeClass('text-muted');
                $("#sort6").addClass('text-white');
                $('#sort12').removeClass('text-muted');
                $("#sort12").addClass('text-white');


                
                } 

                if (Value==6) 
                {
                     $(".sortblock").addClass('col-md-'+Value);
                $('.sortblock').removeClass('col-md-4');
                $('.sortblock').removeClass('col-md-12');

                 $("#sort"+Value).addClass('text-muted');
                $("#sort"+Value).removeClass('text-white');

                $('#sort4').removeClass('text-muted');
                $("#sort4").addClass('text-white');
                $('#sort12').removeClass('text-muted');
                $("#sort12").addClass('text-white');

                } 

                if (Value==12) 
                {
                       $(".sortblock").addClass('col-md-'+Value);
                $('.sortblock').removeClass('col-md-4');
                $('.sortblock').removeClass('col-md-6');

                $("#sort"+Value).addClass('text-muted');
                $("#sort"+Value).removeClass('text-white');

                $('#sort4').removeClass('text-muted');
                $("#sort4").addClass('text-white');
                $('#sort6').removeClass('text-muted');
                $("#sort6").addClass('text-white');
                }

                
            }
        </script>
		<script>
    function dashboard_panel() {
		$.ajax({
			url: "dashboard_panel.php", 
			success: (function (result) {
				// $("#div1").html(result);
				$("#accordion").html(result);
				atm_panel();
			})
		})
	};
	
	function alerts_panel(panelid) {
		$.ajax({
			type: "POST",
			url: "alerts_panel.php", 
			data: {panelid:panelid},
			success: (function (result) {
				// $("#div1").html(result);
				$("#"+panelid).html(result);
			})
		})
	};
	
	function alerts_panel_refresh(panelid) {
		$.ajax({
			type: "POST",
			url: "alerts_panel_refresh.php", 
			data: {panelid:panelid},
			success: (function (result) {
				// $("#div1").html(result);
				$("#"+panelid).html(result);
			})
		})
	};
	
	function search_panel(panelid) {
		$.ajax({
			type: "POST",
			url: "search_dashboard_panel.php", 
			data: {panelid:panelid},
			success: (function (result) { debugger;
				// $("#div1").html(result);
				$("#accordion").html(result);
				alerts_panel(panelid);
			})
		})
	};
	var countload = 0;
	var atmid_array = [];
	function atm_panel() { debugger;
		$.ajax({
			url: "atm_panel.php", 
			dataType: "json",
			success: (function (result) { 
			    var res = result.atmid;
				if(res.length>atmid_array.length){
					dashboard_panel();
					var data = '<option value="" data-id="all">Select Atm ID</option>';
					for(var i=0;i<res.length;i++){
						var arrdata = res[i].split("_");
						
					  data += '<option value="'+arrdata[0]+'" data-id="'+arrdata[1]+'">'+arrdata[0]+'</option>';
					  if(!atmid_array.includes(arrdata[0])){
						atmid_array.push(arrdata[0]);
						var j = i+1;
						
					  }
					  if(countload==0){
					   alerts_panel(arrdata[1]);
					   countload=1;
				      }else{
					   alerts_panel_refresh(arrdata[1]);	
                      }					   
					}
				   $("#atmid").html(data);
				}else{
					for(var i=0;i<res.length;i++){
						var arrdata = res[i].split("_");
						if(countload==0){
						   alerts_panel(arrdata[1]);
						   countload=1;
						  }else{
						   alerts_panel_refresh(arrdata[1]);	
						  }	
					}
				}
			    var res2 = JSON.stringify(result);
			    
			  // addatm(j,'AZX1233');
				//$("#accordion").html(result);
			})
		})
	};
	function addatm(j,atmid){
		var html = '<div class="card"><div class="card-header" id="heading-'+j+'" role="tab">';
		html += '<h6 class="mb-0"><a aria-controls="collapse-'+j+'" aria-expanded="false" class="collapsed" data-toggle="collapse" href="#collapse-'+j+'">';
		html += j+". "+atmid;
		html += '</a></h6></div>';
	    html += '<div aria-labelledby="heading-'+j+'" class="collapse" data-parent="#accordion" id="collapse-'+j+'" role="tabpanel">';
		html += '<div class="card-body"></div></div>';
		$("#accordion").append(html);
	}

	//dashboard_panel(); // To output when the page loads
	//atm_panel();
	//setInterval(atm_panel, (10000)); // x * 1000 to get it in seconds


   $("#atmid").on("change",function(){
	   var panelid = $(this).children('option:selected').data("id");
	  // alert(panelid);
	  if(panelid=="all"){
		  window.location = "index.php";
	  }
	   search_panel(panelid);
   })

</script>

<?php 


function status($status)
{
    $sql=mysqli_query($con,"select * from sites where status='".$status."'");
    $sql_result = mysqli_fetch_assoc($sql);

    return sql_result['sites'];

}

?>
    </body>
</html>


