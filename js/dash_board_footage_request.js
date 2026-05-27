var table = $('#example').DataTable();
function onload()
{
   // get_ai_ticket();
}

$("#show_detail").click(function(){ 
	getPanel_Detail();
	//get_ticketview();
	get_footage_list();
})

        function getPanel_Detail(){
	        var Client = $("#Client").val();
			var Bank = $("#Bank").val();
			var AtmID = $("#AtmID").val();
			var Circle = $("#Circle").val();
			//AtmID = "P1DCHY03";
			if(Client==''){
				swal("Oops!", "Bank Must Required !", "error");
				return false;
			}
			/*if(AtmID==''){
				swal("Oops!", "AtmID Must Required !", "error");
				return false;
			}*/
			
			//url: "dash_board_footage_request_ftp_video.php", 
			
			$("#load").show();
			$.ajax({
				url: "dash_board_footage_request_ajax.php", 
				type: "POST",
				data: {client:Client,bank:Bank,atmid:AtmID,circle:Circle},
				success: (function (result) { 
				  // $("#load").hide();
				   debugger;
				
				   console.log(result);
				   var obj = JSON.parse(result);
				   if(obj[0].code==200){
					   var total_request = obj[0].total_request;
					   $("#total_request").html(total_request);
					   var atm_not_found = obj[0].atm_not_found;
					   $("#atm_not_found").html(atm_not_found);
					   var video_found_count = obj[0].video_found_count;
					   $("#video_found_count").html(video_found_count);
					   var video_notfound_count = obj[0].video_notfound_count;
					   $("#video_notfound_count").html(video_notfound_count);
					   /*
					   var data = obj[0].res_data; console.log(data);
					   var count = 1;
					   if(data.length>0){
						   var tbody = "<tbody>";
						   for(i=0;i<data.length;i++){
							  
							   tbody += '<tr><td>'+count+'</td><td>'+data[i].atm_id+'</td><td>'+data[i].status+'</td><td></td></tr>';
						     count++;
						   }
						   tbody += '</tbody>';
						   var thead = '<thead><tr><th>S.N</th><th>ATM-ID</th><th>Status</th><th> Files</th></tr></thead>';
							
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
							
					   }  */
				   }
				})
		    });
		}  
		
		
function get_footage_list()
{
	//var Status= $("#status").val();
	var Status = "all";
	var Client= $("#Client").val(); 
	var Bank= $("#Bank").val(); 
   var AtmID= $("#AtmID").val(); 
   var Circle = $('#Circle').val();
   $('#footagerequest_tbody').html('');
  // $("#load").show();
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
							//var x = document.getElementById("footagerequest_download");
							//x.style.display = "block";
                        })
                    });
}   

function ready_to_download(atmid,Search_date,From_timePicker,To_timePicker,id) {
	var id = id;
	$("#load").show();
	$.ajax({
		type: "POST",
		url: "http://103.141.218.26:8080/ComfortTechnoNew/ffmpeg/bin/ready_to_footage_req_download.php", 
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
		url: "http://103.141.218.26:8080/ComfortTechnoNew/ffmpeg/bin/ready_to_download_fr.php", 
		data: {To_timePicker:To_timePicker,From_timePicker:From_timePicker,Search_date:Search_date,atmid:atmid},
		success: (function (result) {
			$("#load").hide();
			debugger;
			var res = JSON.parse(result);
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

		