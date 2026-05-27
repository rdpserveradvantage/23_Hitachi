var table = $('#example').DataTable();
function onload()
{
   // get_ai_ticket();
}

$("#show_detail").click(function(){ 
	getPanel_Detail();
	//get_ticketview();
	
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
			$("#load").show();
			$.ajax({
				url: "dash_board_table_ajax_ftp_video_past.php", 
				type: "POST",
				data: {client:Client,bank:Bank,atmid:AtmID,circle:Circle},
				success: (function (result) { 
				   $("#load").hide();
				   debugger;
				
				   console.log(result);
				   var obj = JSON.parse(result);
				   if(obj[0].code==200){
					 /*  var totalsites_count = obj[0].tot_sites;
					   $("#totalsites_count").html(totalsites_count);
					   var camera_working_count = obj[0].camera_working_count;
					   $("#camera_working_count").html(camera_working_count);
					   var camera_notworking_count = obj[0].camera_notworking_count;
					   $("#camera_notworking_count").html(camera_notworking_count);
					   */
					   var data = obj[0].res_data; console.log(data);
					   var count = 1;
					   if(data.length>0){
						   var tbody = "<tbody>";
						   for(i=0;i<data.length;i++){
							  
							   tbody += '<tr><td>'+count+'</td><td>'+data[i].atm_id+'</td><td>'+data[i].start_created_date+'</td><td>'+data[i].createdatetime+'</td><td>'+data[i].file_name+'</td></tr>';
						     count++;
						   }
						   tbody += '</tbody>';
						   var thead = '<thead><tr><th>S.N</th><th>ATM-ID</th><th>First Uploaded Date Time</th><th>Last Uploaded Date Time</th><th>Filename</th> </tr></thead>';
							
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
		