$("#AtmID").change(function(){
	//get_footage_list();
});
$("#Bank").change(function(){
	//get_footage_list();
});
$("#Client").change(function(){
	//get_footage_list();
});

$("#show_detail").click(function(){ 
	get_footage_list();
})
$("#footagerequest_download").hide();
function get_footage_list()
{
	var Status= $("#status").val();
	var Client= $("#Client").val(); 
	var Bank= $("#Bank").val(); 
   var AtmID= $("#AtmID").val(); 
   var Circle = $('#Circle').val();
   $('#footagerequest_tbody').html('');
   $("#load").show();
 //  AtmID = "P1DCHY03";
   var user = "bank";
   if(Client=='')
    {
    	//swal("Oops!", "AtmID Must Required !", "error");
    	return false;
    }
    $.ajax({
        				url: "footage_request_ajax_list_1.php", 
        				type: "GET",
        				data: {atmid:AtmID,client:Client,bank:Bank,Status:Status,user:user,circle:Circle},
						dataType: "html", 
        				success: (function (result) { debugger;
        				   console.log(result);
                            $('#order-listing').dataTable().fnClearTable();
                            $('#footagerequest_tbody').html('');
                            $('#footagerequest_tbody').html(result);
                            $('#order-listing').DataTable(
							{
							   "order": [[ 0, "desc" ]],
							  // dom: 'Bfrtip',
								//  buttons: [
							//		  'excelHtml5'
								//  ]
							}
							);
							$("#load").hide();
							var x = document.getElementById("footagerequest_download");
							x.style.display = "block";
                        })
                    });
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
