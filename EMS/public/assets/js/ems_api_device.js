function onloaddevice()
{
     var refresh_cookies =   sessionStorage.getItem("refresh_token");
     var access_cookies =  sessionStorage.getItem("access_token");
     var org_cookies =   sessionStorage.getItem("org_id");
     var group_id =   sessionStorage.getItem("group_id");

     // var access_cookies = $('#access_token').val();   

    if (refresh_cookies === null || access_cookies ==='' || org_cookies === null || group_id === null ) {
        debugger;
        console.log('Start Session');

        if(refresh_cookies!=='' && access_cookies === '' )
        {
          getaccesstoken();
        }
        else
        {
          apilogin();
        }
    }
    else
    {
       debugger;
       console.log('Old Session');
        
       var refresh_cookies =   sessionStorage.getItem("refresh_token");
       var access_cookies =  sessionStorage.getItem("access_token");
       var org_cookies =   sessionStorage.getItem("org_id");

            sessionStorage.setItem("refresh_token",refresh_cookies);
            sessionStorage.setItem("access_token",access_cookies);
            sessionStorage.setItem("org_id",org_cookies);
            sessionStorage.setItem("group_id",group_id);


            $('#org_id').val(org_cookies);
            $("#refresh_token").val(refresh_cookies);
            $("#access_token").val(access_cookies);
            $("#group_id").val(group_id);
            

    }
    
    getdevicedetails();
}

function getdevicedetails()
{
    debugger;
     var access_token = $("#access_token").val();
     var org_id = parseInt($("#org_id").val());
     var group_id = parseInt($("#group_id").val());
     var ajaxurl = api_url + "panel/filterlist?org_id="+org_id+"&group_id="+group_id+"&state=All";
       var settings = {
              "async": true,
              "crossDomain": true,
              "url": ajaxurl,
              "method": "GET",
              "headers": {
                "access_token": access_token
              }
            }

        $.ajax(settings).done(function (response) {
          console.log(response);
        //   alert(response);
		//getmeterlog();
		/*
		       
             debugger;
             var count = response.result.count;
             var res = response.result.gwlist;
             var table_html = '<table id="order-listing" class="table"><thead><tr><th>#</th><th>Device Name</th><th>Serial No.</th><th>Data</th><th>Relay 1</th><th>Relay 2</th><th>Relay 3</th><th>Relay 4</th><th>Relay 5</th><th>Last Online</th></tr></thead><tbody id="paneldeviceList">';
			 
             for (var i = 0; i < res.length; i++) {
                     var flag= res[i].cflag;
                     var j = i + 1;
                     var st = '';
                     if (flag==false){ st = "<span class='text-success'>pending</span>"; }
                     
                     var btn1= res[i].r1_phase_status;
                     var btn2= res[i].r2_phase_status;
                     var btn3= res[i].r3_phase_status;
                     var btn4= res[i].r4_phase_status;
                     var btn5= res[i].r5_phase_status;
                     
                     var bt1='';
                     var bt2='';
                     var bt3='';
                     var bt4='';
                     var bt5='';
                     
                     
                     
                     if (btn1===0){ bt1 = "<label title='"+ res[i].label_1 +"' class='badge badge-success'>On</label>"; }else 
                     {
                                        bt1 = "<label title='"+ res[i].label_1 +"' class='badge badge-secondary'>Off</label>";
                     }
                     
                     if (btn2===0){  bt2 = "<label title='"+ res[i].label_2 +"' class='badge badge-success'>On</label>"; }else 
                     {
                                        bt2 = "<label title='"+ res[i].label_2 +"' class='badge badge-secondary'>Off</label>";
                     }
                     
                     if (btn3===0){ bt3 = "<label title='"+ res[i].label_3 +"' class='badge badge-success'>On</label>"; }else 
                     {
                                        bt3 = "<label title='"+ res[i].label_3 +"' class='badge badge-secondary'>Off</label>";
                     }
                     
                     if (btn4===0){  bt4 = "<label title='"+ res[i].label_4 +"' class='badge badge-success'>On</label>"; }else 
                     {
                                        bt4 = "<label title='"+ res[i].label_4 +"' class='badge badge-secondary'>Off</label>";
                     }
                     
                     if (btn5===0){  bt5 = "<label title='"+ res[i].label_5 +"' class='badge badge-success'>On</label>"; }else 
                     {
                                        bt5 = "<label title='"+ res[i].label_5 +"' class='badge badge-secondary'>Off</label>";
                     }
                     
                    
                     
                     
                     
                     table_html += "<tr>"; 
                     table_html += "<td>"+j+"</td>"; 
                     table_html += "<td>" + res[i].panel_name +" "+st+"</td>"; 
                     table_html += "<td>" + res[i].mac_id + "</td>"; 
                     table_html += "<td align='center'><i class='fas fa-plug fa-2x text-dark' style='cursor:pointer;'  onclick='getmeterlog("+res[i].mac_id+")'></i></td>"; 
                     table_html += "<td align='center'>"+bt1+"</td>"; 
                     table_html += "<td align='center'>"+bt2+"</td>"; 
                     table_html += "<td align='center'>"+bt3+"</td>"; 
                     table_html += "<td align='center'>"+bt4+"</td>"; 
                     table_html += "<td align='center'>"+bt5+"</td>"; 
                     table_html += "<td>"+res[i].state+"</td>"; 
                     table_html += "<tr>"; 
                
             }
			 table_html += "</tbody><tfoot id='table_foot'><tr>";
            
                 table_html += "<td></td>"; 
                 table_html += "<td><b class='btn btn-info btn sm'>Total- "+count.total+"</b></td>"; 
                 table_html += "<td><b class='btn btn-info btn sm'>Online- "+count.online_count+"</b></td>"; 
                 table_html += "<td><b class='btn btn-info btn sm'>Offline - "+count.offline_count+"</b></td>"; 
                 table_html += "<td><b class='btn btn-info btn sm'>Alerts - "+count.faulty_count+"</b></td>"; 
                 table_html += "<td><b class='btn btn-info btn sm'>Uncalibrated- "+count.uncalibrated_count+"</b></td>"; 
                 table_html += "<td></td>"; 
                 table_html += "<td></td>"; 
                 table_html += "<td></td>"; 
                 table_html += "<td></td>"; 
                 table_html += "</tr></tfoot></table>"; 
                
               $('#order-listing').dataTable().fnClearTable();
                $('#table-device').html(''); 
					
					$('#table-device').html(table_html); 
					
              $('#order-listing').DataTable();
		*/
          if (response.statusCode == 200) {
              
             debugger;
             var count = response.result.count;
             var res = response.result.gwlist;
             var table_html = "";
             for (var i = 0; i < res.length; i++) {
                     var flag= res[i].cflag;
                     var j = i + 1;
                     var st = '';
                     if (flag==false){ st = "<span class='text-success'>pending</span>"; }
                     
                     var btn1= res[i].r1_phase_status;
                     var btn2= res[i].r2_phase_status;
                     var btn3= res[i].r3_phase_status;
                     var btn4= res[i].r4_phase_status;
                     var btn5= res[i].r5_phase_status;
                     
                     var bt1='';
                     var bt2='';
                     var bt3='';
                     var bt4='';
                     var bt5='';
                     
                     
                     
                     if (btn1===0){ bt1 = "<label title='"+ res[i].label_1 +"' class='badge badge-success'>On</label>"; }else 
                     {
                                        bt1 = "<label title='"+ res[i].label_1 +"' class='badge badge-secondary'>Off</label>";
                     }
                     
                     if (btn2===0){  bt2 = "<label title='"+ res[i].label_2 +"' class='badge badge-success'>On</label>"; }else 
                     {
                                        bt2 = "<label title='"+ res[i].label_2 +"' class='badge badge-secondary'>Off</label>";
                     }
                     
                     if (btn3===0){ bt3 = "<label title='"+ res[i].label_3 +"' class='badge badge-success'>On</label>"; }else 
                     {
                                        bt3 = "<label title='"+ res[i].label_3 +"' class='badge badge-secondary'>Off</label>";
                     }
                     
                     if (btn4===0){  bt4 = "<label title='"+ res[i].label_4 +"' class='badge badge-success'>On</label>"; }else 
                     {
                                        bt4 = "<label title='"+ res[i].label_4 +"' class='badge badge-secondary'>Off</label>";
                     }
                     
                     if (btn5===0){  bt5 = "<label title='"+ res[i].label_5 +"' class='badge badge-success'>On</label>"; }else 
                     {
                                        bt5 = "<label title='"+ res[i].label_5 +"' class='badge badge-secondary'>Off</label>";
                     }
                     
                    
                     
                     
                     
                     table_html += "<tr>"; 
                     table_html += "<td>"+j+"</td>"; 
                     table_html += "<td>" + res[i].panel_name +" "+st+"</td>"; 
                     table_html += "<td>" + res[i].mac_id + "</td>"; 
                     table_html += "<td align='center'><i class='fas fa-plug fa-2x text-dark' style='cursor:pointer;'  onclick='getmeterlog("+res[i].mac_id+")'></i></td>"; 
                     table_html += "<td align='center'>"+bt1+"</td>"; 
                     table_html += "<td align='center'>"+bt2+"</td>"; 
                     table_html += "<td align='center'>"+bt3+"</td>"; 
                     table_html += "<td align='center'>"+bt4+"</td>"; 
                     table_html += "<td align='center'>"+bt5+"</td>"; 
                     table_html += "<td>"+res[i].state+"</td>"; 
                     table_html += "<tr>"; 
                
             }
             var table_foot = "<tr>"; 
                 table_foot += "<td></td>"; 
                 table_foot += "<td><b class='btn btn-info btn sm'>Total- "+count.total+"</b></td>"; 
                 table_foot += "<td><b class='btn btn-info btn sm'>Online- "+count.online_count+"</b></td>"; 
                 table_foot += "<td><b class='btn btn-info btn sm'>Offline - "+count.offline_count+"</b></td>"; 
                 table_foot += "<td><b class='btn btn-info btn sm'>Alerts - "+count.faulty_count+"</b></td>"; 
                 table_foot += "<td><b class='btn btn-info btn sm'>Uncalibrated- "+count.uncalibrated_count+"</b></td>"; 
                 table_foot += "<td></td>"; 
                 table_foot += "<td></td>"; 
                 table_foot += "<td></td>"; 
                 table_foot += "<td></td>"; 
                 table_foot += "</tr>"; 
                
            //   console.log(table_html);
              $("#paneldeviceList").html(table_html);
              $("#table_foot").html(table_foot);
              $('#order-listing').DataTable();
         }
        });
 }
 
 function getmeterlog(mac_id)
 {
	  var access_token = $("#access_token").val();
	  var org_id = parseInt($("#org_id").val());
	 var ajaxurl = api_url + "panelmeterloglist?org_id="+org_id+"&mac_id="+mac_id;
	 
      $("#exampleModal2").modal("show");
    var settings = {
				  "url": ajaxurl,
				  "method": "GET",
				  "timeout": 0,
				  "headers": {
					"access_token": access_token
				  },
				};

				$.ajax(settings).done(function (response) {
				  console.log(response);
				  var res = response.result;
				  $('#y_v').val(res.y_v);
				  $('#r_v').val(res.r_v);
				  $('#b_v').val(res.b_v);
				   $('#y_real_kw').val(res.y_real_kw);
				  $('#r_real_kw').val(res.r_real_kw);
				  $('#b_real_kw').val(res.b_real_kw);
				   $('#y_real_kwh').val(res.y_real_kwh);
				  $('#r_real_kwh').val(res.r_real_kwh);
				  $('#b_real_kwh').val(res.b_real_kwh);
				  $('#y_pf').val(res.y_pf);
				  $('#r_pf').val(res.r_pf);
				  $('#b_pf').val(res.b_pf);
				  $('#fr').val(res.fr);
				  $('#real_kwh').val(res.real_kwh);
				  if(res.ups_status==0){
					  $('#ups_status').val('Present');
				  }else{
					  $('#ups_status').val('Absent');
				  }
				  if(res.input_status==0){
					  $('#input_status').val('Close');
				  }else{
					  $('#input_status').val('Open');
				  }
				  var time_stamp = res.tm_stamp;
				  var ts = new Date(time_stamp*1000);
				  var date = ts.toDateString();
				  var time = ts.toLocaleTimeString();
				  var tm_stamp = date+" "+time;
				  $('#tm_stamp').val(tm_stamp);
				  
				   $('#temp').val(res.temp);
				  $('#hum').val(res.hum);
				  $('#e_v').val(res.e_v);
				  $('#acc_c').val(res.acc_c);
				});
        
 }
 

