
        function get_Detail(){ debugger;
	        
			$("#load").show();
			$('#ticketview_tbody').html('');
			$.ajax({
				url: "https://cssmumbai.sarmicrosystems.com/css/dash/esir/api/get_fsr_images.php", 
				type: "POST",
				success: (function (result) { 
				   debugger;
				    $("#load").hide();
				   console.log(result);
				   //var obj = JSON.parse(result);
				   var html = "";
				   if(result[0].Code==200){
					    
					   var objArr = result[0].res_data;
					   var table_html = '<div class="table-responsive"><table id="order-listing" class="table"><thead><tr><th>S.N</th><th>ATM</th><th>FSR Copy Image</th></tr></thead><tbody>';
					   for(i=0;i<objArr.length;i++){
						   var j = i + 1;
						   html += '<tr><td>'+j+'</td><td>'+objArr[i].atmid+'</td><td>'+objArr[i].link+'</td></tr>';
					   }
					   if(html!=''){
						   table_html += html;
					   }
					   table_html += '</tbody></table></div>';
					    $('#order-listing').dataTable().fnClearTable();

                       $('#ticketview_tbody').html('');
					   $('#ticketview_tbody').html(table_html);
					   $('#order-listing').DataTable(
							{
								// "order": [[ 0, "asc" ]]
								    dom: 'Bfrtip',
									buttons: [
										  'excelHtml5'
									]
							}
						);
				   }
				   /*
				   var dvr_online_count = obj[0].dvr_online_count;
				   if(dvr_online_count>0){
					   var dvr_online_counthtml = '<a target="_blank" href="networkreport_details.php?client='+Client+'&bank='+Bank+'&circle='+Circle+'&atmid='+AtmID+'&status=0&device=D">'+dvr_online_count+'</a>';
					   $("#dvr_online_count").html(dvr_online_counthtml);
				   }else{
				      $("#dvr_online_count").html(dvr_online_count);
				   }
				   */
				   
				   
				})
		    });
		}  
		
		function get_view()
		{
		    var Client = $("#Client").val();
			var Bank = $("#Bank").val();
			var AtmID = $("#AtmID").val();
			var Circle = $('#Circle').val();
			var month = $("#month").val();
			var year = $('#year').val();
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
				url: "newnetworkreport_table_ajax_1_hourly_withpenaltycheck.php", 
				type: "GET",
				data: {client:Client,bank:Bank,atmid:AtmID,circle:Circle,month:month,year:year},
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



