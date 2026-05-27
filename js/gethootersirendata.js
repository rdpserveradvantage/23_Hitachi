
$("#show_detail").click(function(){ debugger;
	get_view();
})

function get_view()
{
	var Client = $("#Client").val();
	var Bank = $("#Bank").val();
	var AtmID = $("#AtmID").val();
	var Circle = $('#Circle').val();
	if(Client==''){
		swal("Oops!", "Bank Must Required !", "error");
		return false;
	}
	$('#ticketview_tbody').html('');
	$("#load").show();
	$.ajax({
		url: "gethootersirendata_table_ajax.php", 
		type: "GET",
		data: {client:Client,bank:Bank,atmid:AtmID,circle:Circle},
		dataType: "html", 
		success: (function (result) { debugger;
		   console.log(result);
		 
		   $('#order-listing').dataTable().fnClearTable();

			
			$('#ticketview_tbody').html(result); 
			
			
			//$('#order-listing').DataTable().ajax.reload(); 
				
			//    $('#order-listing').dataTable().fnDestroy();
			$('#order-listing').DataTable(
				{
				//	"order": [[ 0, "desc" ]]
					dom: 'Bfrtip',
					buttons: [
						  'excelHtml5'
					]
				}
			);
			 $("#load").hide();
		})
	});
}



