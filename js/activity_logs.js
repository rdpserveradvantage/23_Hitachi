function onload()
{
   // get_ai_ticket();
}
function getTicketDetails() {
	get_view();
}
$("#AtmID").change(function(){ debugger;
//	get_Detail();
//	get_view();
})
$("#Bank").change(function(){ debugger;
	//get_Detail();
	//get_view();
})
$("#Client").change(function(){ debugger;
	
})


		function get_view()
		{
			debugger;
		   // var footage_type = $("#footage_type").val();
			var start= $("#start").val(); 
            var end= $("#end").val();
			$("#start_date").val(start);
	        $("#start_end").val(end);
			
			$('#ticketview_tbody').html('');
			$("#load").show();
			$.ajax({
				url: "activity_logs_ajax.php", 
				type: "GET",
				data: {start_date:start,end_date:end},
				dataType: "html", 
				success: (function (result) { debugger;
				   console.log(result);
				   $("#load").hide();
				   var title = "( From : "+start+ " To : "+end+" )";
				   $('#order-listing').dataTable().fnClearTable();

					
					$('#ticketview_tbody').html(result); 
					
					
					//$('#order-listing').DataTable().ajax.reload(); 
						
					//    $('#order-listing').dataTable().fnDestroy();
					$('#order-listing').DataTable(
						{
						//	"order": [[ 0, "desc" ]]
                            dom: 'Bfrtip',
							buttons: [
								 // 'excelHtml5'
								 {
									extend: 'excelHtml5',
									messageTop: title
								},
							]
						}
					);
					 $("#load").hide();
				})
			});
		}



