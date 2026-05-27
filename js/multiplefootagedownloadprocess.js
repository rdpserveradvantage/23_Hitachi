$("#show_detail").click(function(){ 
	get_footage_list();
})

function get_footage_list()
{
	var Status= $("#status").val();
	
   $('#footagerequest_tbody').html('');
   
	$("#load").show();
    $.ajax({
        				url: "multiple_footage_download_ajax_list.php", 
        				type: "GET",
        				data: {Status:Status},
						dataType: "html", 
        				success: (function (result) { debugger;
        				   console.log(result);
                            $('#order-listing').dataTable().fnClearTable();
                            $('#footagerequest_tbody').html('');
                            $('#footagerequest_tbody').html(result);
                            $('#order-listing').DataTable(
							{
							   "order": [[ 0, "asc" ]]
							}
							);
							$("#load").hide();
                        })
                    });
}   

