<!DOCTYPE html>
<html lang="en">
   
   <div class="container-fluid page-body-wrapper">
                
                <div class="main-panel">
                    <div class="content-wrapper">
                        
<div class="col-12 grid-margin">
<h3 class="card-title">Live View</h3>
              <div class="card">
                <div class="card-body">
                   
					            <div class="row">
                                    <div class="sortblock col-md-6 form-group">
									    <h6 class="videoplay_msg" id="stop_camera1">Video will stop automatically after <span id="progressBar1"></span> seconds</h6> 
                                        <input type="hidden" id="camurl_1">
										<div class="card form-group">
										    
                                            <div class="card-header" id="cameraheading-1" role="tab">
                                                Camera 1 
												<span class="videoplay_msg" alt="Play ON" style="cursor:pointer;color:#0099CC;float:right;" id="startCamera1" onclick="startCamera(1)">
												<i class="fa fa-play fa-lg" ></i>Play  
												</span>
												<span id="stopCamera1" class="videoplay_msg" alt="Play STOP" style="cursor:pointer;color:red;float:right;padding-right:10px;" onclick="stopCamera(1)">
												<i class="fa fa-stop fa-lg" ></i>Stop  
												</span>
											</div>
											
                                            <div class="card-body">
											     <div class="video-container" id="camera1" style="background: black;max-height:40vh;">
                                    
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
                    </div>
                    
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
		img_panel();
	    setInterval(img_panel, (3000)); // x * 1000 to get it in seconds

		function img_panel() {
			var ip = "172.55.20.123";
			$.ajax({
				type: "POST",
				url: "img_panel_refresh.php", 
				data: {ip:ip},
				success: (function (result) {
					// $("#div1").html(result);
					console.log(result);
					$("#camera1").html(result);
				})
			})
		};
		function startCamera(id){
			var cam = $('#camurl_'+id).val();
			$("#camera"+id).html('');
			$("#camera"+id).html('<iframe src="'+ cam + '" title="description" style="height: 40vh;width: 100%;"></iframe>');
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
				    var siteaddress = obj.SiteAddress;
					var panel_make = obj.Panel_Make;
					var panel_ip = obj.PanelIP;
					var panel_id = obj.NewPanelID;
					var dvrip = obj.DVRIP;
					var dvr_model = obj.DVRName;
					var username = obj.UserName;
					var password = obj.Password;
					var routerip = obj.RouterIP;
					var current_status = obj.live;
					var port = "554";
					var cam_type = ""
					if(dvr_model=='uniview'){
						cam_type = "nvr";
					}else{
						cam_type = "dvr";
					}
					if(url_link=='http://192.168.100.23'){
						
					}else{
						url_link = "http://103.141.218.26";
					}
					
					var cam1 = url_link+":5022/?name="+username+"-"+password+"-"+dvrip+"-"+port+"-"+dvr_model+"-"+cam_type+"-1";
					var cam2 = url_link+":5022/?name="+username+"-"+password+"-"+dvrip+"-"+port+"-"+dvr_model+"-"+cam_type+"-2";
					var cam3 = url_link+":5022/?name="+username+"-"+password+"-"+dvrip+"-"+port+"-"+dvr_model+"-"+cam_type+"-3";
					var cam4 = url_link+":5022/?name="+username+"-"+password+"-"+dvrip+"-"+port+"-"+dvr_model+"-"+cam_type+"-4";
					
				//	http://103.141.218.26:5022/?name=admin-admin123-172.55.26.250-554-uniview-nvr-1
				  /*  var cam1 = "http://103.141.218.26:5022/?name="+username+"-"+password+"-"+dvrip+"-"+port+"-"+dvr_model+"-"+cam_type+"-1";
					var cam2 = "http://103.141.218.26:5022/?name="+username+"-"+password+"-"+dvrip+"-"+port+"-"+dvr_model+"-"+cam_type+"-2";
					var cam3 = "http://103.141.218.26:5022/?name="+username+"-"+password+"-"+dvrip+"-"+port+"-"+dvr_model+"-"+cam_type+"-3";
					var cam4 = "http://103.141.218.26:5022/?name="+username+"-"+password+"-"+dvrip+"-"+port+"-"+dvr_model+"-"+cam_type+"-4"; */
				  console.log(cam1);
				  $("#camera1").html('<iframe src="'+ cam1 + '" title="description" style="height: 40vh;width: 100%;"></iframe>');
				 
				//  $("#camera").html('<option value="">Select Camera</option><option value="http://103.141.218.26:5020/?name=2">Camera 2</option><option value="http://103.141.218.26:5020/?name=3">Camera 3</option><option value="http://103.141.218.26:5020/?name=4">Camera 4</option>');
				  $("#camurl_1").val(cam1);
				  $("#camurl_2").val(cam2);
				  $("#camurl_3").val(cam3);
				  $("#camurl_4").val(cam4);
				 // setStopInterval(1);
				 set_StopInterval(1);
				  $("#stop_camera1").css('display','block');
				  $('#startCamera1').css('display','block');
				  $('#stopCamera1').css('display','block');
				  $('#startCamera2').css('display','block');
				  $('#stopCamera2').css('display','block');
				  $('#startCamera3').css('display','block');
				  $('#stopCamera3').css('display','block');
				  $('#startCamera4').css('display','block');
				  $('#stopCamera4').css('display','block'); 
				   
				})
		    });
		}
		
		    function setcamera(atmid){
				if(atmid=='P3ENMM09'){
				  var cam1 = "http://103.141.218.26:5020/?name=1";
				  $("#camera1").html('<iframe src="'+ cam1 + '" title="description" style="height: 40vh;width: 100%;"></iframe>');
				 
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
				$("#camera"+id).html('<iframe src="'+ cam + '" title="description" style="height: 40vh;width: 100%;"></iframe>');
			}
			$("#camera").change(function(){ 
				var cam = $("#camera").val();
				
				var cam_heading= $("#camera option:selected").text();
				
				var arr = cam_heading.split(' ');
				var id = arr[1];
				$('#cameraheading-'+id).html('');
				$('#cameraheading-'+id).html(cam_heading);
				$("#camera"+id).html('');
				$("#camera"+id).html('<iframe src="'+ cam + '" title="description" style="height: 40vh;width: 100%;"></iframe>');
				
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


