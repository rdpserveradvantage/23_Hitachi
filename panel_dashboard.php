<!DOCTYPE html>
<html lang="en">
    <?php 
    include('head.php');
   // include('config.php');
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
                         <h3 class="card-title">Dashboard As on Date : <?php echo date('d/m/Y');?></h3> 
                          <?php  include('filters/panel_dashboard_filter.php');?>
						</div>  
						  <?php // include('panel/panel_dashboard_details.php');?>
						  <?php //include('panel/sensor_alarm_dvr_status.php');?>
						  <?php //include('panel/sensor_remote_panel_status.php');?> 
						  <?php // include('panel/panel_escalation_matrix.php');?>
						  <?php include('panel/dvr_sensor_alarm_status.php');?>
                    </div>
                 </div>
            </div>
                    <?php include('footer.php');?>
        </div>
            
        <script src="vendors/js/vendor.bundle.base.js"></script>
        <script src="vendors/js/vendor.bundle.addons.js"></script>
        
        <script src="js/off-canvas.js"></script>
        <script src="js/hoverable-collapse.js"></script>
        <script src="js/misc.js"></script>
        <script src="js/settings.js"></script>
        <script src="js/todolist.js"></script>
		<script src="js/ai_sites_client_bank_circle_atmid.js"></script>
        <script src="js/dashboard.js"></script>
		<script src="js/data-table.js"></script>
		<script src="js/data-table2.js"></script>
		<script src="js/data-table3.js"></script>
        <script src="js/select2.js"></script>
        
<script>

function soundOn(value){
    
   $.ajax({
           type:'POST',    
           url:'sound_ON.php',
           data:'value='+value,
           success: function(msg){
          //alert(msg);
          if(msg==1){
              
              swal ("Sound ON");
              document.getElementById("shw").innerHTML="Action(Sound ON)";
              Action();
          }
          else if(msg==2){
              swal ("AC1 ON");
             document.getElementById("shw").innerHTML="Action(AC1 ON)";
             Action();
          }
           else if(msg==3){
              swal ("AC2 ON");
             document.getElementById("shw").innerHTML="Action(AC2 ON)";
             Action();
          }
           else if(msg==4){
              swal ("ATM ON");
              document.getElementById("shw").innerHTML="Action(ATM ON)";
              Action();
          }
           else if(msg==5){
              swal ("LIGHT ON");
               document.getElementById("shw").innerHTML="Action(LIGHT ON)";
               Action();
          }
          
           else if(msg==6){
              swal ("SHUTTER OPEN");
               document.getElementById("shw").innerHTML="Action(SHUTTER OPEN)";
               Action();
          }
           
		   else if(msg==7){
              swal ("START TALK");
               document.getElementById("shw").innerHTML="Action(START TALK)";
               Action();
          }
		  
		  else if(msg==8){
              swal ("ARM");
               document.getElementById("shw").innerHTML="Action(ARM)";
               Action();
          }
           
          else{
              swal("error");
          }

      } })
       
   }
   
   
function soundOff(value){
   $.ajax({
           type:'POST',    
           url:'sound_Off.php',
           data:'value='+value,
           success: function(msg){
          //alert(msg);
          if(msg==1){
              
              swal ("Sound Off");
              document.getElementById("shw").innerHTML="Action(Sound Off)";
              Action();
          }
          else if(msg==2){
              swal ("AC1 Off");
              document.getElementById("shw").innerHTML="Action(AC1 Off)";
              Action();
          }
           else if(msg==3){
              swal ("AC2 Off");
              document.getElementById("shw").innerHTML="Action(AC2 Off)";
              Action();
          }
           else if(msg==4){
              swal ("ATM Off");
              document.getElementById("shw").innerHTML="Action(ATM Off)";
              Action();
          }
           else if(msg==5){
              swal ("LIGHT Off");
              document.getElementById("shw").innerHTML="Action(LIGHT Off)";
              Action();
          }/*
           else if(msg==6){
              swal ("LC2 Off")
              document.getElementById("shw").innerHTML="Action(LC2 Off)";
          }*/
           else if(msg==6){
              swal ("SHUTTER CLOSE");
              document.getElementById("shw").innerHTML="Action(SHUTTER CLOSE)";
              Action();
           }  
              else if(msg==7){
              swal ("SHUTTER STOP");
              document.getElementById("shw").innerHTML="Action(SHUTTER STOP)";
              Action();
          }
		  else if(msg==8){
              swal ("STOP TALK");
              document.getElementById("shw").innerHTML="Action(STOP TALK)";
              Action();
          }
          
           else if(msg==9){
              swal ("DISARM");
              document.getElementById("shw").innerHTML="Action(DISARM)";
              Action();
          }
		  
          else{
              swal("error");
          }

      } })
      Action();
   }
   
   

 function autoRun(){
     
    $.ajax({
           type:'POST',    
           url:'autoRunfun.php',
           data:'',

           success: function(msg){
          //alert(msg);
           var str_array = msg.split(',');

for(var i = 0; i < str_array.length; i++) {
   // Trim the excess whitespace.
   str_array[i] = str_array[i].replace(/^\s*/, "").replace(/\s*$/, "");
  // alert(str_array[i]);
   
   
   document.getElementById(str_array[i]).className = "sensorRed";
   
   
}

      } })
      
     LastAction();
      Action();
   }
   
   function LastAction(){
       
       $.ajax({
           type:'post',
           url:'Action.php',
           data:'',
           success: function(msg){
              // alert(msg)
               document.getElementById('shw').innerHTML="Action("+ msg + ")";
           }
           
       })
       
   }
   function Action(){
       
       $.ajax({
           type:'post',
           url:'ActionBtn.php',
           data:'',
           success: function(msg){
              // alert(msg)
                 var arr=msg.split("@#");
                 var i=0;
                 var data="";
                 for(i==0;i<6;i++){
                if(arr[i]==1){
                    data="ON";
                }
                else{
                    data="OFF";
                }
               document.getElementById('shw'+i).innerHTML=data;
               if(data=="ON")
              document.getElementById('shw'+i).style.color = 'red';
           }
           }
       })
       
   }
   
   
 </script>
		<script>
		function myFunction() {
		  var x = document.getElementById("DVRpwd");
		  if (x.type === "password") {
			x.type = "text";
		  } else {
			x.type = "password";
		  }
		}
		function getPanelDetails(){
			getPanelDetail();
			getPanel_Detail();
			alarm_status_panel();
			getEscalationDetail(1);
			zone_status_panel();
		}
		function alarm_status_panel() {
			var Client = $("#Client").val();
			var Bank = $("#Bank").val();
			var AtmID = $("#AtmID").val();
			$("#sensor_alarm_status").html('');
			if(Bank==''){
				swal("Oops!", "Bank Must Required !", "error");
				return false;
			}
			if(AtmID==''){
				swal("Oops!", "AtmID Must Required !", "error");
				return false;
			}
			if(AtmID!=''){
				$.ajax({
					type: "GET",
					url: "panel_dashboard_sensor_alarm.php", 
					dataType: "html", 
					data:{atmid:AtmID,client:Client,bank:Bank},
					success: (function (result) { debugger;
						// $("#div1").html(result);
						$('#order-listing').dataTable().fnClearTable();
						$("#sensor_alarm_status").html('');
						$("#sensor_alarm_status").html(result);
						//$('#order-listing').DataTable().ajax.reload(); 
						    
                        //    $('#order-listing').dataTable().fnDestroy();
                        $('#order-listing').DataTable();
					})
				});
			}
		}
		function getEscalationDetail(type){
			var atmid = $("#AtmID").val();
			if(atmid!=''){
				$.ajax({
					type: "GET",
					url: "panel_escalation_matrix_ajax.php?atmid="+atmid+"&type="+type, 
					dataType: "html", 
					success: (function (result) { debugger;
						// $("#div1").html(result);
						//$("#zone_status_panel").html(result);
						//$('.order-listing3').dataTable().fnClearTable();
						if(type==1){
							$('#pills-health').html('');
							$('#pills-health').html(result);
						}
						if(type==2){
							$('#pills-career').html('');
							$('#pills-career').html(result);
						}
						if(type==3){
							$('#pills-music').html('');
							$('#pills-music').html(result);
						}
						if(type==4){
							$('#pills-vibes').html('');
							$('#pills-vibes').html(result);
						}
						if(type==5){
							$('#pills-energy').html('');
							$('#pills-energy').html(result);
						}
						if(type==6){
							$('#pills-police').html('');
							$('#pills-police').html(result);
						}
						//$('.order-listing3').DataTable();
					})
				});
			}
		}
		function getPanel_Detail(){
			var Client = $("#Client").val();
			var AtmID = $("#AtmID").val();
			$('#dvr_recording_list').html('');
			$('#total_space').html('');
		    $('#free_space').html('');
		    $('#used_space').html('');
			$('#dvr_status').css('display','none');
			$('#dvrlogin_status').css('display','none');
			if(Client==''){
				swal("Oops!", "Client Must Required !", "error");
				return false;
			}
			if(AtmID==''){
				swal("Oops!", "AtmID Must Required !", "error");
				return false;
			}
			$.ajax({
				url: "panel_dashboard_dvrdata.php", 
				type: "POST",
				data: {client:Client,atmid:AtmID},
				success: (function (result) { debugger;
				   console.log(result);
				   var obj = JSON.parse(result);
				   var login_status = obj.login_status;
				   var Capacity = obj.capacity;
				   var FreeSpace = obj.freespace;
				   var recording_from = obj.recording_from;
				   var recording_to = obj.last_communication;
				 //  var recording_to = obj.recording_to;
				   if(recording_from!=''){
					  recording_from = recording_from.replace("T", " ");
					  recording_from = recording_from.replace("Z", " ");
				   }
				   if(recording_to!=''){
					  recording_to = recording_to.replace("T", " ");
					  recording_to = recording_to.replace("Z", " ");
					  
				   }
				   
				   if(login_status==0){
					   $('#dvr_status').css('display','block');
					   $('#dvrlogin_status').css('display','none');
				   }else{
					   $('#dvr_status').css('display','none');
					   $('#dvrlogin_status').css('display','block');
				   }
				   
				 //  recording_to = "2021-03-13 12:00:00";
				   if(Capacity!='' && FreeSpace!=''){
					   Capacity = Capacity/1024;
					   FreeSpace = FreeSpace/1024;
					   var UsedSpace = Capacity - FreeSpace;
					   $('#total_space').html('');
					   $('#free_space').html('');
					   $('#used_space').html('');
					   Capacity = Capacity.toFixed(2);
					   Capacity = Capacity+" GB";
					   FreeSpace = FreeSpace.toFixed(2);
					   FreeSpace = FreeSpace+" GB";
					   UsedSpace = UsedSpace.toFixed(2);
					   UsedSpace = UsedSpace+" GB";
					   $('#total_space').html(Capacity);
					   $('#free_space').html(FreeSpace);
					   $('#used_space').html(UsedSpace);
				   }
				   
				   if(recording_from!='' && recording_to!=''){
					    var date1 = new Date(recording_from);
						var date2 = new Date(recording_to);
						  
						// To calculate the time difference of two dates
						var Difference_In_Time = date2.getTime() - date1.getTime();
						  
						// To calculate the no. of days between two dates
						var Difference_In_Days = Difference_In_Time / (1000 * 3600 * 24);
						Difference_In_Days = parseInt(Difference_In_Days);
				   }
				   
				   var html = "<tr>";
				   html += "<td>1</td><td>"+recording_from+"</td><td>"+recording_to+"</td><td>"+Difference_In_Days+"</td></tr>";
				   html += "<tr><td>2</td><td>"+recording_from+"</td><td>"+recording_to+"</td><td>"+Difference_In_Days+"</td></tr>";
				   html += "<tr><td>3</td><td>"+recording_from+"</td><td>"+recording_to+"</td><td>"+Difference_In_Days+"</td></tr>";
				   html += "<tr><td>4</td><td>"+recording_from+"</td><td>"+recording_to+"</td><td>"+Difference_In_Days+"</td>";
				   html += '</tr>';
				   $('#dvr_recording_list').html('');
				   $('#dvr_recording_list').html(html);
				   
				})
		    });
		}
		function getPanelDetail(){
			var Bank = $("#Bank").val();
			var AtmID = $("#AtmID").val();
			$('#siteAddress').val('');
			$('#PanelMake').val('');
			$('#PanelId').val('');
			$('#PanelIP').val('');
			$('#DVRIP').val('');
			$('#DVRUsername').val('');
			$('#DVRpwd').val('');
			$('#DVRModel').val('');
			$('#CurrentIP').val('');
			$('#panel_status').css('display','none');
			
			if(Bank==''){
				swal("Oops!", "Bank Must Required !", "error");
				return false;
			}
			if(AtmID==''){
				swal("Oops!", "AtmID Must Required !", "error");
				return false;
			}
			$.ajax({
				url: "panel_dashboard_data.php", 
				type: "POST",
				data: {bank:Bank,atmid:AtmID},
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
					$('#siteAddress').val('');
					$('#siteAddress').val(siteaddress);
					$('#PanelMake').val('');
					$('#PanelMake').val(panel_make);
					$('#PanelId').val('');
					$('#PanelId').val(panel_id);
					$('#PanelIP').val('');
					$('#PanelIP').val(panel_ip);
					$('#DVRIP').val('');
					$('#DVRIP').val(dvrip);
					$('#DVRUsername').val('');
					$('#DVRUsername').val(username);
					$('#DVRpwd').val('');
					$('#DVRpwd').val(password); 
					$('#DVRModel').val('');
					$('#DVRModel').val(dvr_model);
					$('#CurrentIP').val('');
					$('#CurrentIP').val(routerip);
					if(current_status=='Y'){
						$('#panel_status').css('display','block');
						//$('#dvr_status').css('display','block');
					}
				})
			})
		}
		
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
	}
	/*
	function onchangeatmid() {
				var bank = $("#Bank").val();
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
		function onchangebank() { 
				var client = $("#Client").val();
				$.ajax({
					type: "GET",
					url: "getMasterData.php", 
					data: {client:client},
					dataType: "html",
					success: (function (result) {
						$("#Bank").html('');
						$("#Bank").html(result);
					})
				})
			}	
	*/
	function zone_status_panel() {
		var atmid = $("#AtmID").val();
		$("#zone_status_panel").html('');
		if(atmid!=''){
			$.ajax({
				type: "GET",
				url: "panel_dashboard_zone_status.php?atmid="+atmid, 
				dataType: "html", 
				success: (function (result) { debugger;
					// $("#div1").html(result);
					$("#zone_status_panel").html('');
					$("#zone_status_panel").html(result);
					
				})
			});
		}
	}
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

<!-- Modal starts -->
                  
                  <div class="modal fade" id="largeModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg" role="document">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title" id="exampleModalLabel">Live View</h5>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        <div class="modal-body" id="result_status">
                           <h6>Ticket Details</h6>
							  <div class="card">
								<div class="card-block" id="result_status" style=" overflow: auto;">
								  
								</div>
							</div>
                        </div>
                        
                      </div>
                    </div>
                  </div>
                  <!-- Modal Ends -->
				  
		<script>
             $(document).on("click", ".large-modal", function () { debugger;
					 var Id = $(this).data('id');
					  $.ajax({    
						type: "GET",
						url: "ticket_history_details.php?id="+Id,             
						dataType: "html",   //expect html to be returned                
						success: function(response){            debugger;         
							$(".modal-body #result_status").html(response); 
							//alert(response);
						}
					 });
				});
        </script>		
				  
    </body>
</html>


