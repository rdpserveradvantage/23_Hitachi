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
			overflow-y: scroll;*/
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
                        
<div class="col-12 grid-margin">
<h3 class="card-title">Locations</h3>
              <div class="card">
                <div class="card-body">
                  
                 
                        <?php include('filters/sitehealth_filter.php');?>
						<div class="card">
							<div class="card-body">
							  
							  <div class="map-container">
								<div id="map-with-marker" class="google-map">
									
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
		<script src="js/client_bank_circle_atmid.js"></script>
        <script src="js/dashboard.js"></script>
        <script src="vendors/video-js/video.min.js"></script>
		<script src="js/select2.js"></script>
         <script>
		 
		    function initMap(lat,lng,atmid,atmshortname) { console.log(lat); console.log(lng);
			      if(lat==undefined){
					  lat = 28.616318966813253;
				  }
				  if(lng==undefined){
					  lng = 77.20948395138142;
				  }
				  if(atmid==undefined){
					  atmid = "-";
				  }else{
					  atmid = "ATMID : "+atmid;
				  }
				  if(atmshortname==undefined){
					  atmshortname = "-";
				  }
				  const uluru = { lat: lat, lng: lng };
				  const map = new google.maps.Map(document.getElementById("map-with-marker"), {
					zoom: 14,
					center: uluru,
				  });
				  const contentString =
					'<div id="content">' +
					'<div id="siteNotice">' +
					"</div>" +
					'<h3 id="firstHeading" class="firstHeading">'+atmid+'</h3>' +
					'<div id="bodyContent">' +
					"<p><b>"+atmshortname+"</b></p>" +
					"</div>" +
					"</div>";
				  const infowindow = new google.maps.InfoWindow({
					content: contentString,
				  });
				  const marker = new google.maps.Marker({
					position: uluru,
					map,
					title: atmid,
				  });

				  marker.addListener("click", () => {
					infowindow.open({
					  anchor: marker,
					  map,
					  shouldFocus: false,
					});
				  });
				}
		 
		    function set_Location(atmid){ debugger;
			    var client = $("#Client").val();
			    var bank = $("#Bank").val();
				var AtmID = $("#AtmID").val();
				if(AtmID==''){
					swal("Oops!", "AtmID Must Required !", "error");
					return false;
				}
				$.ajax({
					url: "location_ajax.php", 
					type: "POST",
					data: {atmid:AtmID,bank:bank,client:client},
					success: (function (result) { debugger;
						console.log(result);
						var objt = JSON.parse(result); 
						if(objt.code==200){
							var obj = objt.res;
							var lat = obj.latitude;
							var lng = obj.longitude;
							var atmid = obj.atmid;
							var atmshortname = obj.atmshortname;
							lat = parseFloat(lat);
							lng = parseFloat(lng);
							initMap(lat,lng,atmid,atmshortname);						
						}						
					})
			    });
		    }
		 
		    function set_Location_1(atmid){ debugger;
				var AtmID = $("#AtmID").val();
				if(AtmID==''){
					swal("Oops!", "AtmID Must Required !", "error");
					return false;
				}
				$.ajax({
					url: "location_ajax.php", 
					type: "POST",
					data: {atmid:AtmID},
					success: (function (result) { debugger;
						console.log(result);
						var objt = JSON.parse(result); 
						if(objt.code==200){
							var obj = objt.res;
							var lat = obj.latitude;
							var lng = obj.longitude;
							var title = "ATMID : B1009500";
							var url_link = 'http://maps.google.com/maps?q='+lat+','+lng+'&z=15&output=embed';
						//	var url_link ='https://maps.google.com/maps?width=100%25&amp;height=600&amp;hl=en&amp;q=Malet%20St,%20London%20WC1E%207HU,%20United%20Kingdom+(Your%20Business%20Name)&amp;t=&amp;z=14&amp;ie=UTF8&amp;iwloc=B&amp;output=embed';
							var src = '<iframe src="'+url_link+'" height="750" width="100%" frameborder="0" scrolling="no" marginheight="0" marginwidth="0"></iframe>';
							$("#map-with-marker").html(src);   		

                                    //  <div style="width: 100%"><iframe width="100%" height="600"  src=""></iframe></div>							
						}						
					})
			    });
		    }
			
		    $("#show_detail").click(function(){
				var atmid = $('#AtmID').val();
				/*if(atmid=='P3ENMM09'){
					var src = '<iframe src="http://maps.google.com/maps?q=18.9968965,72.8116118&z=16&output=embed" height="750" width="950" style="width:100%;"></iframe>';
                   $("#map-with-marker").html(src);   
                     				   
				}*/
				set_Location(atmid);
				
				
			});
		   
			</script>
		    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCYJLYaSvIyWhvHv4Jxu2z5vbXM_Ys0nck&callback=initMap&v=weekly&channel=2"
      async
    ></script>
    </body>
</html>


