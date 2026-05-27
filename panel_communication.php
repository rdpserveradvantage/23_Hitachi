<!DOCTYPE html>
<html lang="en">
    <?php 
    include('head.php');
    
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
					     <div class="col-12 grid-margin">
                         <h3 class="card-title">Panel Communication</h3> 
                          <?php include('filters/panel_dashboard_filter.php');?>
						</div>  
                         
						  <?php //include('panel/panel_communication_details.php');?>
						   <?php include('panel/panel_communication_table.php');?>
						  
                    </div>
                 </div>
            </div>
                    <?php include('footer.php');?>
        </div>
            
        <script src="vendors/js/vendor.bundle.base.js"></script>
        <script src="vendors/js/vendor.bundle.addons.js"></script>
		
		

<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
	<!-- <script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script> -->
	<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
	<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
	
		
<script>
                    $(function() {

                        var start = moment().subtract(30, 'days');
                        var end = moment();

            function cb(start, end) {
                $('#reportrange span').html(start.format('MMM DD,YYYY') + ' - ' + end.format('MMM DD,YYYY'));
                $("#start").val(start.format('YYYY-MM-DD'));
                $("#end").val(end.format('YYYY-MM-DD'));
                get_ticketview();
            }

            $('#reportrange').daterangepicker({
                startDate: start,
                endDate: end,
                "showDropdowns": true,
                "autoApply": true,
                 maxDate: new Date(),
                ranges: {
                   'Today': [moment(), moment()],
                //   'Yesterday': [moment().subtract(1, 'days'), moment()],
                   'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                   'Last 7 Days': [moment().subtract(7, 'days'), moment()],
                   'Last 30 Days': [moment().subtract(30, 'days'), moment()],
                 //  'This Month': [moment().startOf('month'), moment().endOf('month')],
                 //  'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
                }



            }, cb);

            cb(start, end);


        });
</script>

        
        <script src="js/off-canvas.js"></script>
        <script src="js/hoverable-collapse.js"></script>
        <script src="js/misc.js"></script>
        <script src="js/settings.js"></script>
        <script src="js/todolist.js"></script>
        <script src="js/dashboard.js"></script>
		<script src="js/ai_sites_client_bank_circle_atmid.js"></script>
		<script src="js/data-table.js"></script>
		<script src="js/data-table2.js"></script>
        <script src="vendors/video-js/video.min.js"></script>
        <script src="js/select2.js"></script>
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
			get_ticketview();
		}
		
		function getPanelDetail(){
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
					var username = obj.Username;
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
					
					$('#CurrentIP').val('');
					$('#CurrentIP').val(routerip);
					if(current_status=='Y'){
						$('#panel_status').css('display','block');
						
					}
				})
			})
		}
		
		function get_ticketview()
		{ debugger;
		   var Atmid= $("#AtmID").val(); 
		   var start= $("#start").val(); 
		   var end= $("#end").val(); 
		   
			if(Atmid=='')
			{
				//swal("Oops!", "AtmID Must Required !", "error");
				return false;
			}
			$.ajax({
				url: "panel_communication_ajax.php", 
				type: "GET",
				data: {atmid:Atmid,start:start,end:end},
				dataType: "html", 
				success: (function (result) { debugger;
				   console.log(result);
				 
				   $('#order-listing').dataTable().fnClearTable();

					$('#ticketview_tbody').html('');
					$('#ticketview_tbody').html(result); 
					
					
					//$('#order-listing').DataTable().ajax.reload(); 
						
					//    $('#order-listing').dataTable().fnDestroy();
					$('#order-listing').DataTable();
				})
			});
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
	};
	
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


