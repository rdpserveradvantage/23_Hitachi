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
		    var Client = $("#Client").val();
			var Bank = $("#Bank").val();
			var AtmID = $("#AtmID").val();
			var Circle = $('#Circle').val();
			var month = $("#month").val();
			var year = $('#year').val();
			var start= $("#start").val(); 
            var end= $("#end").val();
			if(Client==''){
				swal("Oops!", "Bank Must Required !", "error");
				return false;
			}
			if(month=='0'){
				swal("Oops!", "Month Must Required !", "error");
				return false;
			}
			if(year=='0'){
				swal("Oops!", "Year Must Required !", "error");
				return false;
			}
			$('#ticketview_tbody').html('');
			$("#load").show();
			$.ajax({
				url: "date_wise_report_ajax.php", 
				type: "GET",
				data: {client:Client,bank:Bank,atmid:AtmID,circle:Circle,month:month,year:year,start_date:start,end_date:end},
				dataType: "html", 
				success: (function (result) { debugger;
				   console.log(result);
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



