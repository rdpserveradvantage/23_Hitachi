
@extends('layout.layout')

@section('content')

<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
<!-- <script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script> -->
<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/2.0.0/css/buttons.dataTables.min.css">


<style>
  thead #heading th {
          font-size: 0.8rem;
  }
  #datatable-card {
      display:none;
  }
</style>
 <!-- partial -->
      <div class="main-panel">
        <div class="content-wrapper">
          <div class="card">
              <div class="card-body">
                <h4 class="card-title">Configure Report <div style="float:right"><button type="button" class="btn btn-light btn-rounded btn-sm text-right mr-1" data-toggle="modal" data-target="#exampleModal">Energy : Real</button><button type="button" class="btn btn-light btn-rounded btn-sm text-right" data-toggle="modal" data-target="#exampleModal">Interval : Daily</button></div> </h4>
                <div class="row">
                   <div class="col-md-3">

                      <div class="form-group">
                      <!-- <button type="submit" class="btn btn-secondary mb-2">Submit</button>
                      <button type="submit" class="btn btn-secondary mb-2">Submit</button><br> -->
                          <label>Type</label>
                          <select class="form-control w-100">
                            <option value="AL">Consumption</option>
                            <option value="WY">Alert Log</option>
                            <option value="AM">Activity Log</option>
                            <option value="CA">Event Log</option>
                            <option value="RU">Meter Log</option>
                          </select>
                      </div>
                   </div>
                   <div class="col-md-3">
                     <div class="form-group">
                          <label>Device </label>
                           
                                
                          <select class="form-control w-100" id="report-panel_name">
                          </select>
                          <input type="hidden" id="allvar">
                          <input type="hidden" id="selectedvar">
                      </div>
                   </div>
                   <div class="col-md-3">
                     <div class="form-group">
                          <label>Date Range</label>

                    <div id="reportrange" class="form-control"   data-cancel-class="btn-light">
                        <i class="mdi mdi-calendar"></i>&nbsp;
                        <span id="selectedValue"></span> <i class="mdi mdi-menu-down"></i>
                    </div>

                    <input type="hidden" id="start" name="start">
                    <input type="hidden" id="end" name="end">
                      </div>
                   </div>

                 
                   <div class="col-md-3">
                       <button type="button" class="btn  btn-outline-info mt-3" onclick="get_table()">Preview</button>
                      
                      <button class="btn  btn-outline-success mt-3 dropdown-toggle" type="button" id="dropdownMenuSizeButton2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Export
                      </button>
                      <div class="dropdown-menu" aria-labelledby="dropdownMenuSizeButton2" x-placement="top-start" style="position: absolute; transform: translate3d(0px, -12px, 0px); top: 0px; left: 0px; will-change: transform;">                       
                        <!-- <a class="dropdown-item" id="export-pdf" href="#">PDF</a> -->
                        <!-- <a class="dropdown-item" id="export-excel" href="#">Excle</a> -->
                        <a class="dropdown-item" id="export-csv" href="#">CSV</a>                        
                      </div>
                   </div>
                </div>





              </div>
          </div>
        </div>
        <div class="content-wrapper">
          <div class="card" id="datatable-card">
            <div class="card-body">
              <h4 class="card-title">Data table</h4>
              <div class="row">
                <div class="col-12">
                  <div class="table-responsive">
                    <table id="order-listing" class="table display table-bordered" style="width:100%;">
                      <thead>
                        <tr id="heading">
                           
                        </tr>
                      </thead>
                      <tbody id="table_data">
                       
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- Modal Start-->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog " role="document">
        <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title" id="exampleModalLabel">Advance Filters</h5>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
            <div class="modal-body">
                <div class="modal demo-modal">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        
                        <div class="modal-body">
							<form class="forms-sample">
								<div class="form-group">
									<label for="interval">Interval</label>
										<select id="interval" class="form-control">
											<option value="daily">Daily</option>
											<option value="monthly">Monthly</option>
											<option value="yearly">Yearly</option>
										</select>
								</div>
							</form>
							<form class="forms-sample">
								<div class="form-group">
									<label for="energy">Energy Type</label>
									<select id="energy" class="form-control">
										<option value="real">Real(kWh)</option>
										<option value="apparent">Apparent(kVah)</option>
										<option value="reactive">Reactive(kVaRh)</option>
										<option value="rphase">R phase(kWh)</option>
										<option value="bphase">B phase(kWh)</option>
										<option value="yphase">Y phase(kWh)</option>
									</select>
								</div>
							</form>
                        </div>
                         <div class="modal-footer">
                          <button type="button" class="btn btn-warning" data-redo="modal">Reset</button>
                          <button type="button" class="btn btn-success">Submit</button>
                          <button type="button" class="btn btn-light" data-dismiss="modal">Cancel</button>
                        </div>
                      </div>
                    </div>
                </div>
            </div>
   </div>
                </div>
            </div>

                        
						
 <!-- Modal end-->
        <!-- content-wrapper ends -->
        <!-- partial:partials/_footer.html -->
       <!--  <footer class="footer">
          <div class="d-sm-flex justify-content-center justify-content-sm-between">
            <span class="text-muted text-center text-sm-left d-block d-sm-inline-block">Copyright © 2018 <a href="https://www.bootstrapdash.com/" target="_blank">css</a>. All rights reserved.</span>
            <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center">Hand-crafted & made with <i class="far fa-heart text-danger"></i></span>
          </div>
        </footer> -->
        <!-- partial -->
      </div>
      <!-- main-panel ends -->
      <script src="{{url('assets/js/ems_api.js')}}"></script>
    <!--   <script src="https://cdn.datatables.net/buttons/2.0.0/js/buttons.html5.min.js"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
      <script src="https://cdn.datatables.net/1.11.1/js/jquery.dataTables.min.js"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
      <script src="https://cdn.datatables.net/buttons/2.0.0/js/dataTables.buttons.min.js"></script>
      <script src="https://unpkg.com/jspdf-autotable@3.5.20/dist/jspdf.plugin.autotable.js" ></script> -->
      <script>

      debugger;
   //   $('#datatable-card').hide();
      function getHeading(days,end_day){
           var heading = [];
        //  if(days==7){
              var string = Last7Days(days,end_day);
              var array = string.split(',');

              for(var i=array.length-1;i>=0;i--){
                  var date = array[i];
                  var date_arr = date.split('/');
                  var date_val = date_arr[1]+' '+date_arr[0]+','+date_arr[2];
                  heading.push(date_val);
              }
        //  }
          return heading;
      }
      
      function get_Heading(startdate,enddate){
           var heading = [];
        //  if(days==7){
              var string = ListDays(startdate,enddate);
              var array = string.split(',');

              for(var i=array.length-1;i>=0;i--){
                  var date = array[i];
                  var date_arr = date.split('/');
                  var date_val = date_arr[1]+' '+date_arr[0]+','+date_arr[2];
                  heading.push(date_val);
              }
        //  }
          return heading;
      }

      function month_name(month_value){
            var months = new Array(12);
            months[0] = "Jan";
            months[1] = "Feb";
            months[2] = "Mar";
            months[3] = "Apr";
            months[4] = "May";
            months[5] = "Jun";
            months[6] = "Jul";
            months[7] = "Aug";
            months[8] = "Sep";
            months[9] = "Oct";
            months[10] = "Nov";
            months[11] = "Dec";

            return months[month_value];
      }
      function Last7Days (days,end_day) {
          var arr = [];
          for(var n=0;n<=days;n++){
               var d = new Date(end_day);
                d.setDate(d.getDate() - n);

              var datemonthyear = (function(day, month, year) {
                    return [day<10 ? '0'+day : day, month<10 ? '0'+month : month, year].join('/');
                })(d.getDate(), month_name(d.getMonth()), d.getFullYear());
              arr.push(datemonthyear);  
          }
          return arr.join();
          /*  return number_val.split('').map(function(n) { debugger;
                var d = new Date();
                d.setDate(d.getDate() - n);

                return (function(day, month, year) {
                    return [day<10 ? '0'+day : day, month<10 ? '0'+month : month, year].join('/');
                })(d.getDate(), month_name(d.getMonth()), d.getFullYear());
            }).join(',');  */
         }
         
         function ListDays (startdate,enddate) {
          
          var arr = [];
          while (startdate <= enddate) {
               var d = new Date(startdate);
                d.setDate(d.getDate());

              var datemonthyear = (function(day, month, year) {
                    return [day<10 ? '0'+day : day, month<10 ? '0'+month : month, year].join('/');
                })(d.getDate(), month_name(d.getMonth()), d.getFullYear());
              arr.push(datemonthyear);  
              
              startdate = addDays(startdate,1);
          }
          return arr.join();
          
         }
         
    onload();
    



 function onload(){ debugger;

    // var refresh_cookies = getCookie('refresh_token');
    // var access_cookies = getCookie('access_token');
    // var org_cookies = getCookie('org_id');

     var refresh_cookies =   sessionStorage.getItem("refresh_token");
     var access_cookies =  sessionStorage.getItem("access_token");
     var org_cookies =   sessionStorage.getItem("org_id");

     // var access_cookies = $('#access_token').val();   

    if (refresh_cookies === null || access_cookies === '' || org_cookies === null ) {
        debugger;
        console.log('Start Session');

        if(refresh_cookies!='' && access_cookies == '' )
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
       var group_id =   sessionStorage.getItem("group_id");


            sessionStorage.setItem("refresh_token",refresh_cookies);
            sessionStorage.setItem("access_token",access_cookies);
            sessionStorage.setItem("org_id",org_cookies);
            sessionStorage.setItem("group_id",group_id);





            $('#org_id').val(org_cookies);
            $("#refresh_token").val(refresh_cookies);
            $("#access_token").val(access_cookies);
            $("#group_id").val(group_id);
            

    }

    getdevicelist();
    // setPanel();

  }
  
  function getdevicelist() { 
     debugger;
     
     var access_token = $("#access_token").val();
     var org_id = $("#org_id").val();
    
     var group_id = $("#group_id").val();
     
     
    //  alert(group_id);
          
     
    var settings = {
      "async": true,
      "crossDomain": true,
      "url": "https://timer.lightingmanager.in/dashboard/panellist?org_id="+org_id+"&group_id="+group_id,
      "method": "GET",
      "headers": {
        "access_token": access_token,
        "Connection": "keep-alive",
        "cache-control": "no-cache"
      },
     "data": JSON.stringify({
             "org_id": org_id,
             "period": 1,
             "group_id": group_id
         }),
    }

$.ajax(settings).done(function (response) {
  console.log(response);
  if (response.statusCode == 200) {
             var permac = sessionStorage.getItem("mac_id");
             var res = response.result;
             var table_html = "";
             var mac_id = "";
                 table_html +="<select>";
             for (var i = 0; i < res.length; i++) {
                 
                     mac_id+=res[i].mac_id;
                     table_html += "<option value='"+res[i].panel_name+"'>" + res[i].panel_name + "</option>"; 
                 
             }
                 table_html += "</select>";
              console.log(table_html);
              $("#report-panel_name").html(table_html);
              
              $("#mac_id").val(mac_id);
             sessionStorage.setItem("mac_id",mac_id);
             
         }
});
     
    
 }

  
 
  function addDays(currentDate,days){
       var dat = new Date(currentDate)
        dat.setDate(dat.getDate() + days);
        return dat;
  }
  
  function getDates(startDate, stopDate) {
    var dateArray = new Array();
    var currentDate = startDate;
    while (currentDate <= stopDate) {
        dateArray.push( new Date (currentDate) )
        currentDate = addDays(currentDate,1);
    }
    return dateArray;
}

      function get_table(){ debugger;
         // getConsumptionParameter();
         $('#datatable-card').show();
         
        var startdate = $('#start').val();
        var enddate = $('#end').val();
      //  var date_array = getDates(startdate,enddate);
        const date1 = new Date(startdate);
        const date2 = new Date(enddate);
        const diffTime = Math.abs(date2 - date1);
        const diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24)); 
        console.log(diffTime + " milliseconds");
        console.log(diffDays + " days");
        
         var heading_arr = getHeading(diffDays,enddate);
        //  var heading_arr = get_Heading(startdate,enddate);
         var heading_html = "<th style='font-size: 0.8rem;'>S.No</th>";
         heading_html += "<th style='font-size: 0.8rem;'>Device</th>";
         for(var i=0;i<heading_arr.length;i++){
             heading_html += "<th style='font-size: 0.8rem;'>"+heading_arr[i]+"</th>";
         }
         heading_html += "<th style='font-size: 0.8rem;'>Total Consumption</th>";
         $("#heading").html("");
         $("#heading").html(heading_html);
         
        
        // var energyconsump_start_date = getStartTimeStamp(diffDays);
          var energyconsump_start_date = gettimestamp(startdate);
         var energyconsump_end_date = gettimestamp(enddate);
         getEnergy_Consumption(energyconsump_start_date,diffDays,energyconsump_end_date);
      }
      
      function getEnergy_Consumption(startdate, diffDays, energyconsump_end_date){ debugger;
         if(diffDays==1){
             energyconsump_end_date = energyconsump_end_date - 1;
         }
    	  var ajaxurl = api_url+"reports/getconsumption";
    	  var access_token = $("#access_token").val();
    	  var org_id = parseInt($("#org_id").val());
    	  var group_id = $('#group_id').val();
    	  var mac_id = [];
    // 	  if(group_id){
    	      var macid = $('#mac_id').val();
    	      mac_id.push(macid);
    // 	  }
    // 	  var group_id = 0; 
    	  var settings = {
    		  "url": ajaxurl,
    		  "method": "POST",
    		  "timeout": 0,
    		  "headers": {
    			"access_token": access_token,
    			"Content-Type": "application/json"
    		  },
    		  "data": JSON.stringify({
    			"end_date": energyconsump_end_date,
    			"energy_type": "real",
    			"group_id": group_id,
    			"interval": "daily",
    			"mac_id": mac_id,
    			"org_id": org_id,
    			"report_type": "preview",
    			"start_date": startdate
    		  }),
    		};
    
    		$.ajax(settings).done(function (response) { debugger;
    		  console.log(response);
    		  if(response.statusCode==200){
    		      var res = response.result.energy;
    		      var overall_total = response.result.overall_total;
    		      var table_html = "";
    		      var colspan = diffDays + 3;
    		      for(var i=0;i<res.length;i++){
    		          table_html += "<tr>";
    		          table_html += "<td>"+res[i].srno+"</td>";
    		          table_html += "<td>"+res[i].gateway+"</td>";
    		          var energy_count = res[i].energy;
    		          for(var j=0;j<energy_count.length;j++){
    		               table_html += "<td>"+energy_count[j]+"</td>";
    		          }
    		          table_html += "<td>"+res[i].total+"</td>";
    		          table_html += "</tr>";
    		      }
    		      table_html += '<tr><td colspan="'+colspan+'">Total Consumption (kWh)</td><td>'+overall_total+'</td></tr>'
    		      $('#table_data').html(table_html);

              $('#order-listing').DataTable();

    		  }
    		});
      }


      </script>

      <script>
        $(document).ready(function(){
         var start=$("#start").val();
          var end=$("#end").val();
         $("#export-pdf").click(function(){  
         
           $("#order-listing").tableHTMLExport({
            type:'pdf',
            filename:'Export-Report.pdf',
          });
        });

         $("#export-csv").click(function(){  
           $("#order-listing").tableHTMLExport({
            type:'csv',
           filename:"Export-Report.csv",
          });
        });

         
         
      });
      </script> 





<script>
                    $(function() {

                        var start = moment().subtract(30, 'days');
                        var end = moment();

            function cb(start, end) {
                $('#reportrange span').html(start.format('MMM DD,YYYY') + ' - ' + end.format('MMM DD,YYYY'));
                $("#start").val(start.format('YYYY-MM-DD'));
                $("#end").val(end.format('YYYY-MM-DD'));

            }

            $('#reportrange').daterangepicker({
                startDate: start,
                endDate: end,
                "showDropdowns": true,
                "autoApply": true,
                 maxDate: new Date(),
                ranges: {
                   'Today': [moment(), moment()],
                //   'Yesterday': [moment().subtract(1, 'days'), moment()],
                   'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                   'Last 7 Days': [moment().subtract(7, 'days'), moment()],
                   'Last 30 Days': [moment().subtract(30, 'days'), moment()],
                 //  'This Month': [moment().startOf('month'), moment().endOf('month')],
                 //  'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
                }



            }, cb);

            cb(start, end);


        });
</script>









@stop
