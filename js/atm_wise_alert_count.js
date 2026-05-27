var table = $('#example').DataTable();
get_ai_ticket();
function getTicketDetails()
{
	get_ai_ticket();
   // get_ai_ticket();
}

function get_ai_ticket()
{
    $("#load").show();
	
	$.ajax({
			url: "atm_wise_alert_view_ajax.php", 
			type: "POST",
			//data: {client:Client,bank:Bank,atmid:AtmCode,circle:Circle,month:month,year:year},
			success: (function (result) { debugger;
				console.log(result);
				$("#load").hide();
				var obj = JSON.parse(result);
				
				if(obj[0].code==200){
				   var data = obj[0].res_data; 
				   var count = 1;
				   if(data.length>0){
					    var tbody = "<tbody>";
					    for(i=0;i<data.length;i++){
						   tbody += '<tr><td>'+data[i].atm_id+'</td><td>'+data[i].panel_name+'</td><td>'+data[i].dvr_name+'</td><td>'+data[i].alert_count+'</td></tr>';
						   count++;
					    }
					   tbody += '</tbody>';
					   var thead = '<thead><tr><th>ATMID</th><th>Panel Name</th><th>DVR Name</th><th>Total Alert Count</th></tr></thead>';
					   
						var total_html = thead + tbody;
						table.destroy();
						$('#example').html(total_html);
						table = $('#example').DataTable(
							{
								dom: 'Bfrtip',
								  buttons: [
									  'excelHtml5'
								  ]
							}
						);
						
				   }
				}
			  
				
			   
			})
		});
	
   
}   


function get_ai_ticket_1()
{
   var Client= $("#Client").val();
   var Bank= $("#Bank").val();   
   var Circle= $("#Circle").val();   
   var AtmCode= $("#AtmID").val(); 
   var month= $("#month").val(); 
   var year= $("#year").val(); 
   
  
  if(Client==''){
	  swal("Client must required");
	  return false;
  }
  $("#load").show();
    $.ajax({
        				url: "esurveillance_penalty_ajax.php", 
        				type: "POST",
        				data: {client:Client,bank:Bank,atmid:AtmCode,circle:Circle,month:month,year:year},
						success: (function (result) { debugger;
        				    console.log(result);
							$("#load").hide();
                            var obj = JSON.parse(result);
						    if(obj[0].code==200){
							   var data = obj[0].res_data; 
							   var count = 1;
							   if(data.length>0){
								   var tbody = "<tbody>";
								   for(i=0;i<data.length;i++){
									  var src = "";
									   if(data[i].src==''){
										   
									   }else{
										   var path = data[i].path;
										   src = '<button type="button" class="btn btn-primary btn-sm large-modal" data-id="'+data[i].id+'" data-toggle="modal" data-target="#largeModal">View<i class="fa fa-eye ml-1"></i></button>';
									   }
									   tbody += '<tr><td>'+data[i].id+'</td><td>'+data[i].site_address+'</td><td>'+data[i].atm_id+'</td><td>'+data[i].month+'</td><td>'+data[i].year+'</td><td>'+data[i].total_down_time+'</td><td>'+data[i].penalty_amt+'</td><td>'+src+'</td></tr>';
									 count++;
								   }
								   tbody += '</tbody>';
								   var thead = '<thead><tr><th>ID</th><th>Location</th><th>ATMID</th><th>Month</th><th>Year</th><th>Total Down Time</th><th>Total Penalty Amount</th><th> Action </th></tr></thead>';
								   
									var total_html = thead + tbody;
									table.destroy();
									$('#example').html(total_html);
									table = $('#example').DataTable(
										{
											dom: 'Bfrtip',
											  buttons: [
												  'excelHtml5'
											  ]
										}
									);
									
							   }
						    }
                          
							
                           
                        })
                    });
}   

