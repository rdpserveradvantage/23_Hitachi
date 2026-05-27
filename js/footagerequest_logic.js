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

function test(){
	 var Client= $("#Client").val(); 
	 var Bank= $("#Bank").val(); 
	 var AtmID= $("#AtmID").val(); 
    // AtmID = "P1DCHY03";
	  $.ajax({
				url: "api/dvrdashboard_alerts_ajax.php", 
				type: "POST",
				data: {atmid:AtmID,client:Client,bank:Bank,user_id:24},
				success: (function (result) { debugger;
				   var res = JSON.parse(result);
					console.log(res);
				})
			});
}


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
        				url: "footage_request_ajax_list_logic_test.php", 
        				type: "GET",
        				data: {atmid:AtmID,client:Client,bank:Bank,Status:Status,user:user,circle:Circle},
						dataType: "html", 
        				success: (function (result) { debugger;
        				   console.log(result);
                            $('#order-listing').dataTable().fnClearTable();
                            $('#footagerequest_tbody').html('');
                            $('#footagerequest_tbody').html(result);
                           /* $('#order-listing').DataTable(
							{
							   "order": [[ 0, "desc" ]]
							} */
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
							var x = document.getElementById("footagerequest_download");
							x.style.display = "block";
                        })
                    });
}   

function ready_to_download(atmid,Search_date,From_timePicker,To_timePicker,id) {
	// url: "http://103.141.218.26:8080/ComfortTechnoNew/ffmpeg/bin/ready_to_footage_req_download.php",
	var id = id;
	$("#load").show();
	$.ajax({
		type: "POST",
		url: "https://103.141.218.26/ComfortTechnoNew/ffmpeg/bin/ready_to_footage_req_download.php", 
		data: {To_timePicker:To_timePicker,From_timePicker:From_timePicker,Search_date:Search_date,atmid:atmid},
		success: (function (result) {
			debugger;
			var res = JSON.parse(result);
			if(res[0].Code==200){
				var footage_avail = res[0].footage_avail;
				if(footage_avail=='Yes'){
					ready_to_merge(atmid,Search_date,From_timePicker,To_timePicker,id);
				}
			}
			
		})
	})
}

function ready_to_merge(atmid,Search_date,From_timePicker,To_timePicker,id) {
	var id = id;
	$.ajax({
		type: "POST",
		url: "https://103.141.218.26/ComfortTechnoNew/ffmpeg/bin/ready_to_download_fr.php", 
		data: {To_timePicker:To_timePicker,From_timePicker:From_timePicker,Search_date:Search_date,atmid:atmid},
		success: (function (result) {
			$("#load").hide();
			debugger;
			var res = JSON.parse(result);
			if(res[0].Code==201){
			console.log(res.ch);
			}
			if(res[0].Code==200){
				var downld = res[0].download_link;
				$('#ready_to_download_'+id).html('<a href="'+downld+'" download>Download Merge Video</a>');
			}
			/*var dt = res[0].res_data;
			var html ="<option value=''>All Site</option>";
			for(var i=0;i<dt.length;i++){
				html +="<option value='"+dt[i]+"'>"+dt[i]+"</option>";
			}
			*/
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
