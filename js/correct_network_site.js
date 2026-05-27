function onload()
{
  //  get_ticketview();
}
/*
$("#portal").change(function(){ debugger;
	get_ticketview();
});
$("#AtmID").change(function(){

    get_ticketview();
}); */
$("#show_detail").click(function(){ 
	get_ticketview();
})
function get_ticketview()
{
	var Client= $("#Client").val();
   var Atmid= $("#AtmID").val(); 
      var Bank= $("#Bank").val(); 
	  var Circle = $('#Circle').val();
    if(Bank=='')
    {
    	//swal("Oops!", "AtmID Must Required !", "error");
    	return false;
    }
	if(Client=='')
    {
    	//swal("Oops!", "AtmID Must Required !", "error");
    	return false;
    }
	$("#load").show();
    $.ajax({
        url: "correct_network_site_ajax_list.php", 
        type: "GET",
        data: {atmid:Atmid,bank:Bank,client:Client,circle:Circle},
        dataType: "html", 
        success: (function (result) { debugger;
           console.log(result);
         /*  var obj = JSON.parse(result);
           var atmcode = obj.ATMCode;
            var aid = obj.aid;
            var datetime = obj.DateTime;
           aiticketview = "<tr> <td>" +atmcode+ "</td> <td></td> <td></td> <td></td>  <td> " +datetime+ " </td> <td></td> <td></td> <td> </td> <td> </td> <td> "+aid+" </td> <td> </td> </tr>";
            */
           $('#order-listing').dataTable().fnClearTable();

            $('#ticketview_tbody').html('');
            $('#ticketview_tbody').html(result); 
            
            
            //$('#order-listing').DataTable().ajax.reload(); 
                
            //    $('#order-listing').dataTable().fnDestroy();
            $('#order-listing').DataTable(
			    {
					"order": [[ 0, "desc" ]],
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
