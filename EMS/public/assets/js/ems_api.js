
$( document ).ready(function() { //debugger;;
    DeviceList(); 
    });

    
  var api_url = "https://eazyinfra.utopiatech.in/";
// var api_url = "https://timer.lightingmanager.in/";
 // var time = Math.floor(Date.now() / 1000);alert(time);
 var today = new Date();
 var dd = String(today.getDate()).padStart(2, '0');
 var mm = String(today.getMonth() + 1).padStart(2, '0');
 var yyyy = today.getFullYear();
 today = dd + '-' + mm + '-' + yyyy;
 myDate = today.split("-");
 var newDate = new Date(myDate[2], myDate[1] - 1, myDate[0]);
 var end_date = newDate.getTime();
 var end_date = end_date / 1000;

 function getStartTimeStamp(days) {
     // var days=7; // Days you want to subtract
     var date = new Date();
     var last = new Date(date.getTime() - (days * 24 * 60 * 60 * 1000));
     var day = last.getDate();
     var month = last.getMonth() + 1;
     var year = last.getFullYear();
     lastdate = day + '-' + month + '-' + year;
     myDate = lastdate.split("-");
     var lastDate = new Date(myDate[2], myDate[1] - 1, myDate[0]);
     var start_date = lastDate.getTime();
     start_date = start_date / 1000;
     return start_date;
 }
 
 function gettimestamp(date){
      myDate = date.split("-");
     var lastDate = new Date(myDate[0], myDate[1] - 1, myDate[2]);
     var start_date = lastDate.getTime();
     start_date = start_date / 1000;
     return start_date;
 }
 
 var start_date = getStartTimeStamp(7);
 var yesterdaystart_date = getStartTimeStamp(1);

 function convertEpochToSpecificTimezone(timeEpoch, offset) {
     var d = new Date(timeEpoch);
     var utc = d.getTime() + (d.getTimezoneOffset() * 60000); //This converts to UTC 00:00
     var nd = new Date(utc + (3600000 * offset));
     //  return nd.toLocaleDateString();
     return nd.toLocaleString();
     //  return nd.toUTCString();
 }
 // convertEpochToSpecificTimezone(1495159447834, +3)  
 function apilogin() {
	
	// "email": "ashish@cssindia.in",
    //       "password": "iot@12345"
     var ajaxurl = api_url + "user/login";
     var postdata = JSON.stringify({
          "email": "apiuser@cts.com",
          "password": "api@123"
     });
     var settings = {
         "url": ajaxurl,
         "method": "POST",
         "data": postdata,
         "headers": {
             "Content-Type": "application/json"
         },
     };
     $.ajax(settings).done(function(res, status, request) {
         if (res.statusCode == 200) {
             //console.log(request.getAllResponseHeaders());
             //alert(request.getAllResponseHeaders().refresh_token);
             //var _response = JSON.stringify(request.getAllResponseHeaders());
             var org_id = res.result.orgId;
             var group_id = res.result.group_ids;
             var userId = res.result.userId;
             $('#org_id').val(org_id);
			 $('#group_id').val(group_id);
             $("#refresh_token").val(request.getResponseHeader("refresh_token"));
             $("#access_token").val(request.getResponseHeader("access_token"));
             var refresh_token = request.getResponseHeader("refresh_token");
             var access_token = request.getResponseHeader("access_token");

             // sessionStorage.getItem("SessionName") 

             sessionStorage.setItem("refresh_token",refresh_token);
             sessionStorage.setItem("access_token",access_token);
             sessionStorage.setItem("org_id",org_id);
			 sessionStorage.setItem("group_id",group_id);
             sessionStorage.setItem("userId",userId);
             setpanelvalue(group_id);
             // setCookie('refresh_token', refresh_token, 3);
             // setCookie('access_token', access_token, 3);
             // setCookie('org_id', org_id, 3);


             loadbrick();
             energybrick();
             alertbrick();
             offlinebrick();
             energydistributionwidget2();
             energydistributionwidget1();
             energytrendwidget('daily', 1);
             getrecentactivities();
             expensebrick();
         }
     });
 }

 function apilogin1() {
     var ajaxurl = api_url + "user/login";
     $.ajax({
         type: "POST",
         url: ajaxurl,
         data: {
             email: "ashish@cssindia.in",
             password: "iot@12345"
         },
         headers: {
             "Content-Type": "application/json"
         },
         success: function(res, status, request) {
             if (res.statusCode == 200) {
                 //console.log(request.getAllResponseHeaders());
                 //alert(request.getAllResponseHeaders().refresh_token);
                 //var _response = JSON.stringify(request.getAllResponseHeaders());
                 var org_id = res.result.orgId;
                 var group_id = res.result.group_ids;
                 $('#org_id').val(org_id);
                 $("#refresh_token").val(request.getResponseHeader("refresh_token"));
                 $("#access_token").val(request.getResponseHeader("access_token"));
                 var refresh_token = request.getResponseHeader("refresh_token");
                 var access_token = request.getResponseHeader("access_token");

                 setCookie('refresh_token', refresh_token, 3);
                 setCookie('access_token', access_token, 3);
                 setCookie('org_id', org_id, 3);

                 loadbrick();
                 energybrick();
                 alertbrick();
                 offlinebrick();
                 energydistributionwidget2();
                 energydistributionwidget1();
                 energytrendwidget('daily', 1);
                 getrecentactivities();
                 expensebrick();
             }
         }
     });
 }

 function getaccesstoken() {
     var ajaxurl = api_url + "user/accesstoken";
     // var refresh_token = $("#refresh_token").val();
     var refresh_cookies = sessionStorage.getItem("refresh_token");
     var settings = {
         "url": ajaxurl,
         "method": "POST",
         "headers": {
             "Content-Type": "application/json",
             "refresh_token": refresh_cookies
         },
     };
     $.ajax(settings).done(function(res, status, request) { debugger;
         
         console.log(res);


                 $("#access_token").val(request.getResponseHeader("access_token"));                
                 var access_token = request.getResponseHeader("access_token");
                 sessionStorage.setItem("access_token",access_token);
				 $.ajax({
						url: "http://103.141.218.26:8080/ComfortTechnoNew/api/updateaccesstoken.php", 
						type: "POST",
						data: {access_token:access_token},
						success: (function (result) { debugger;
						   console.log(result);
						   alert(result);
						   onload();
						})
					});

     });
 }
 /* Dashboard */
 function loadbrick() {
     
     var ajaxurl = api_url + "dashboard/getbrickdata";
     var access_token = $("#access_token").val();
     var org_id = $("#org_id").val();
     var group_id = 0;
     /*var paramdata = [{
            "parameter_type": "real",
            "type": 6
        }];
    $.ajax({
        type: "PUT",
        url: ajaxurl,
        data: {data:paramdata,group_id:group_id,org_id:org_id},
        headers: {
            "Content-Type": "application/json",
            "access_token": access_token
            
        },
        success: function(res, status, request) { //debugger;;
           
        }
    }); */
	//"https://timer.lightingmanager.in/dashboard/getbrickdata"
     var settings = {
         "url": ajaxurl,
         "method": "PUT",
         "timeout": 0,
         "headers": {
             "access_token": access_token,
             "Content-Type": "application/json"
         },
         "data": JSON.stringify({
             "data": [{
                 "parameter_type": "real",
                 "type": 6
             }],
             "group_id": "0",
             "org_id": org_id
         }),
     };
     $.ajax(settings).done(function(response) {
         
         // console.log(response);
         if (response.statusCode == 200) {
             var res = response.result;
             var total_load = 0;
             if (res.length > 0) {
                 total_load = res[0].total_load;
                 var unit = res[0].unit;
             }
             $("#load_kw").html(total_load);
         } else {
             if (response.statusCode == 401) {
                 getaccesstoken();
             }
         }
     });
 }

 function energybrick() {
     // start_date = 1630348200;
     // end_date = 1631039399;
     var ajaxurl = api_url + "dashboard/getbrickdata";
     var access_token = $("#access_token").val();
     var org_id = parseInt($("#org_id").val());
     var group_id = 0;
     var settings = {
         "url": ajaxurl,
         "method": "PUT",
         "timeout": 0,
         "headers": {
             "access_token": access_token,
             "Content-Type": "application/json"
         },
         "data": JSON.stringify({
             "org_id": org_id,
             "group_id": "0",
             "data": [{
                 "parameter_type": "real",
                 "start_date": start_date,
                 "end_date": end_date,
                 "type": 3
             }]
         }),
     };
     $.ajax(settings).done(function(response) { debugger;
         console.log(response);
		 if(response.statusCode==200){
         var res = response.result;
         var energy = 0;
         if (res.length > 0) {
             if (res[0].energy != null) {
                 energy = res[0].energy;
             }
             var unit = res[0].unit;
         }
         $("#energy_kw").html(energy);
		 }else {
             if (response.statusCode == 401) {
                 getaccesstoken();
             }
         }
     });
 }

 function alertbrick() {
     var ajaxurl = api_url + "dashboard/getbrickdata";
     var access_token = $("#access_token").val();
     var org_id = $("#org_id").val();
     var group_id = 0;
     var settings = {
         "url": ajaxurl,
         "method": "PUT",
         "timeout": 0,
         "headers": {
             "access_token": access_token,
             "Content-Type": "application/json"
         },
         "data": JSON.stringify({
             "data": [{
                 "type": 7
             }],
             "group_id": "0",
             "org_id": org_id
         }),
     };
     $.ajax(settings).done(function(response) {
         //console.log(response);
		 if(response.statusCode==200){
         var res = response.result;
         var alert = 0;
         if (res.length > 0) {
             if (res[0].count != null) {
                 alert = res[0].count;
             }
         }
         $("#alert_count").html(alert);
		 }else {
             if (response.statusCode == 401) {
                 getaccesstoken();
             }
         }
     });
 }

 function offlinebrick() {
     var ajaxurl = api_url + "dashboard/getbrickdata";
     var access_token = $("#access_token").val();
     var org_id = $("#org_id").val();
     var group_id = 0;
     var settings = {
         "url": ajaxurl,
         "method": "PUT",
         "timeout": 0,
         "headers": {
             "access_token": access_token,
             "Content-Type": "application/json"
         },
         "data": JSON.stringify({
             "data": [{
                 "type": 1
             }],
             "group_id": "0",
             "org_id": org_id
         }),
     };
     $.ajax(settings).done(function(response) {
         // console.log(response);
		 if(response.statusCode==200){
         var res = response.result;
         var offline = 0;
         if (res.length > 0) {
             if (res[0].count != null) {
                 offline = res[0].count;
             }
         }
         $("#offline_count").html(offline);
		 }else {
             if (response.statusCode == 401) {
                 getaccesstoken();
             }
         }
     });
 }

 function expensebrick() {
     var ajaxurl = api_url + "dashboard/getbrickdata";
     var access_token = $("#access_token").val();
     var org_id = parseInt($("#org_id").val());
     var group_id = 0;
     var settings = {
         "url": ajaxurl,
         "method": "PUT",
         "timeout": 0,
         "headers": {
             "access_token": access_token,
             "Content-Type": "application/json"
         },
         "data": JSON.stringify({
             "data": [{
                 "type": 9,
                 "start_date": start_date,
                 "end_date": end_date
             }],
             "group_id": "0",
             "org_id": org_id
         }),
     };
     $.ajax(settings).done(function(response) {
         //console.log(response);
		 if(response.statusCode==200){
         var res = response.result;
         var expense = 0;
         var unit = 'Rs';
         if (res.length > 0) {
             if (res[0].expense != null) {
                 expense = res[0].expense;
                 unit = res[0].unit;
             }
         }
         expense = expense.toFixed(2);
         var unitexpense = unit + ' ' + expense;
         $("#expense").html(unitexpense);
		 }else {
             if (response.statusCode == 401) {
                 getaccesstoken();
             }
         }
     });
 }

 function mapwidget() {
     var access_token = $("#access_token").val();
     var org_id = $("#org_id").val();
     var group_id = 0;
     var ajaxurl = api_url + "location/get?org_id=" + org_id + "&group_id=0";
	 //"https://timer.lightingmanager.in/location/get?org_id=147&group_id=1"
     var settings = {
         "url": ajaxurl,
         "method": "GET",
         "timeout": 0,
         "headers": {
             "access_token": access_token
         },
     };
     $.ajax(settings).done(function(response) { debugger;
         
         console.log("Map Widget");
         console.log(response);
		 if(response.statusCode==200){
         var res = response.result;
         var locations = [];
         for (var i = 0; i < res.length; i++) {
             var location = [];
			 var j = i + 1;
             location.push(res[i].panel_name);
             location.push(res[i].lat);
             location.push(res[i].lng);
             location.push(j);
             locations.push(location);
         }
         /*  var locations = [
                  ['Bondi Beach', -33.890542, 151.274856, 4],
                  ['Coogee Beach', -33.923036, 151.259052, 5],
                  ['Cronulla Beach', -34.028249, 151.157507, 3],
                  ['Manly Beach', -33.80010128657071, 151.28747820854187, 2],
                  ['Maroubra Beach', -33.950198, 151.259302, 1]
                ];  */
         var map = new google.maps.Map(document.getElementById('map'), {
             zoom: 4,
             center: new google.maps.LatLng(res[0].lat, res[0].lng),
             mapTypeId: google.maps.MapTypeId.ROADMAP
         });
         var infowindow = new google.maps.InfoWindow();
         var marker, i;
         for (i = 0; i < locations.length; i++) {
             marker = new google.maps.Marker({
                 position: new google.maps.LatLng(locations[i][1], locations[i][2]),
                 map: map
             });
             google.maps.event.addListener(marker, 'click', (function(marker, i) {
                 return function() {
                     infowindow.setContent(locations[i][0]);
                     infowindow.open(map, marker);
                 }
             })(marker, i));
         }
		 }else {
             if (response.statusCode == 401) {
                 getaccesstoken();
             }
         }
     });
 }

 function getconsumption() {
     var access_token = $("#access_token").val();
     var org_id = $("#org_id").val();
     var group_id = 0;
    // var ajaxurl = api_url + "location/get?org_id=" + org_id + "&group_id=0";
	  var ajaxurl = api_url + "reports/getconsumparams?org_id=" + org_id;
	// "https://timer.lightingmanager.in/reports/getconsumparams?org_id=147"
     var settings = {
         "url": ajaxurl,
         "method": "GET",
         "timeout": 0,
         "headers": {
             "access_token": access_token
         },
     };
     $.ajax(settings).done(function(response) {
         console.log(response);
     });
 }

 function alertwidget() {
     var access_token = $("#access_token").val();
     var org_id = $("#org_id").val();
     var group_id = 0;
	// "https://timer.lightingmanager.in/panel/getstatus"
	var ajaxurl = api_url + "panel/getstatus";
     var settings = {
         "url": ajaxurl,
         "method": "PUT",
         "timeout": 0,
         "headers": {
             "access_token": access_token,
             "Content-Type": "application/json"
         },
         "data": JSON.stringify({
             "group_id": "0",
             "org_id": org_id,
             "period": 1
         }),
     };
     $.ajax(settings).done(function(response) {
         console.log(response);
     });
 }

 function getrecentactivities() {
     var access_token = $("#access_token").val();
     var org_id = parseInt($("#org_id").val());
     var group_id = 0;
	// "https://timer.lightingmanager.in/dashboard/getrecentactivities"
	var ajaxurl = api_url + "dashboard/getrecentactivities";
     var settings = {
         "url": ajaxurl,
         "method": "POST",
         "timeout": 0,
         "headers": {
             "access_token": access_token,
             "Content-Type": "application/json"
         },
         "data": JSON.stringify({
             "group_id": "0",
             "org_id": org_id
         }),
     };
     $.ajax(settings).done(function(response) {
         console.log(response);
		 if(response.statusCode==200){
         var res = response.result;
         var html = "";
         for (var i = 0; i < res.length; i++) {
             if (res[i].action_type == 2) {
                 var timestamp = parseInt(res[i].tm_stamp);
                 var date = convertEpochToSpecificTimezone(timestamp * 1000, +3)
                 // var date = new Date(timestamp*1000);
                 //timestamp = date.getTime();
                 var parameter = res[i].desc.change;
                 var rel = parameter[0].field;
                 var old_val = parameter[0].old_value;
                 var new_val = parameter[0].new_value;
                 html += '<div class="accordion" id="accordion' + i + '" role="tablist">';
                 html += '<div class="card" style="border-bottom:1px solid rgb(227, 227, 227);"><div class="card-header p-2" role="tab" id="heading-' + i + '"><h6 class="mb-1">';
                 html += '<a class="collapsed" data-toggle="collapse" href="#collapse-' + i + '" aria-expanded="false" aria-controls="collapse-' + i + '">' + res[i].user_name + '</a></h6>';
                 html += '<div class="mb-1"><strong style="font-weight: 900;">' + res[i].desc.panel_name + ' scheduling changed</strong><small style="float: right;">' + date + '</small></div></div>';
                 html += '<div id="collapse-' + i + '" class="collapse" role="tabpanel" aria-labelledby="heading-2" data-parent="#accordion' + i + '">';
                 html += '<div class="card-body" style="padding: 0.5rem 0.5rem 0.5rem 0.5rem;"><table class="table-bordered table-striped" width="100%">';
                 html += '<thead><th>parameters</th><th>Old value</th><th>new Value</th></thead>';
                 html += '<tbody><tr><td>' + rel + '</td><td>' + old_val + '</td><td>' + new_val + '</td></tr></tbody></table>';
                 html += '</div></div></div></div>';
             }
         }
         $('#recent_activities').html("");
         $("#recent_activities").html(html);
		 }else {
             if (response.statusCode == 401) {
                 getaccesstoken();
             }
         }
     });
 }
 /*
 var data = {
   labels: ["2013", "2014", "2014", "2015", "2016", "2017"],
   datasets: [{
     label: '# kWh',
     data: [10, 19, 3, 5, 2, 3],
     backgroundColor: [
       'rgba(255, 99, 132, 0.2)',
       'rgba(54, 162, 235, 0.2)',
       'rgba(255, 206, 86, 0.2)',
       'rgba(75, 192, 192, 0.2)',
       'rgba(153, 102, 255, 0.2)',
       'rgba(255, 159, 64, 0.2)'
     ],
     borderColor: [
       'rgba(255,99,132,1)',
       'rgba(54, 162, 235, 1)',
       'rgba(255, 206, 86, 1)',
       'rgba(75, 192, 192, 1)',
       'rgba(153, 102, 255, 1)',
       'rgba(255, 159, 64, 1)'
     ],
     borderWidth: 1,
     fill: false
   }]
 }; */
 var options = {
     scales: {
         yAxes: [{
             ticks: {
                 beginAtZero: true
             }
         }]
     },
     legend: {
         display: false
     },
     elements: {
         point: {
             radius: 0
         }
     }
 };

 function energytrendwidget(format, id_key) {
     var ajaxurl = api_url + "dashboard/getenergygraph";
     var access_token = $("#access_token").val();
     var org_id = parseInt($("#org_id").val());
     var group_id = $('#group_id').val();
     var settings = {
         "url": ajaxurl,
         "method": "PUT",
         "timeout": 0,
         "headers": {
             "access_token": access_token,
             "Content-Type": "application/json"
         },
         "data": JSON.stringify({
             "count": 7,
             "end_date": end_date,
             "format": format,
             "group_id": "0",
             "org_id": org_id,
             "parameter_type": "real"
         }),
     };
     $.ajax(settings).done(function(response) {
         console.log(response);
		 if(response.statusCode==200){
         var res = response.result.data;
         var backgroundColor = ['rgba(255, 99, 132, 0.2)', 'rgba(54, 162, 235, 0.2)', 'rgba(255, 206, 86, 0.2)', 'rgba(75, 192, 192, 0.2)', 'rgba(153, 102, 255, 0.2)', 'rgba(255, 159, 64, 0.2)'];
         var borderColor = ['rgba(255,99,132,1)', 'rgba(54, 162, 235, 1)', 'rgba(255, 206, 86, 1)', 'rgba(75, 192, 192, 1)', 'rgba(153, 102, 255, 1)', 'rgba(255, 159, 64, 1)'];
         var energydata = [];
         var energylevels = [];
         var energylevelsbgcolor = [];
         var energylevelsbordercolor = [];
         for (var i = 0; i < res.length; i++) {
             energydata.push(parseInt(res[i].energy));
             energylevels.push(res[i].date);
             energylevelsbgcolor.push(backgroundColor[i]);
             energylevelsbordercolor.push(borderColor[i]);
         }
         var data = {
             labels: energylevels,
             datasets: [{
                 label: '# kWh',
                 data: energydata,
                 backgroundColor: energylevelsbgcolor,
                 borderColor: energylevelsbordercolor,
                 borderWidth: 1,
                 fill: false
             }]
         };
         if ($("#barChart-" + id_key).length) {
             var barChartCanvas = $("#barChart-" + id_key).get(0).getContext("2d");
             // This will get the first returned node in the jQuery collection.
             var barChart = new Chart(barChartCanvas, {
                 type: 'bar',
                 data: data,
                 options: options
             });
         }
	 }
     });
 }
 var doughnutPieData = {
     datasets: [{
         data: [30, 40, 30],
         backgroundColor: ['rgba(255, 99, 132, 0.5)', 'rgba(54, 162, 235, 0.5)', 'rgba(255, 206, 86, 0.5)', 'rgba(75, 192, 192, 0.5)', 'rgba(153, 102, 255, 0.5)', 'rgba(255, 159, 64, 0.5)'],
         borderColor: ['rgba(255,99,132,1)', 'rgba(54, 162, 235, 1)', 'rgba(255, 206, 86, 1)', 'rgba(75, 192, 192, 1)', 'rgba(153, 102, 255, 1)', 'rgba(255, 159, 64, 1)'],
     }],
     // These labels appear in the legend and in the tooltips when hovering different arcs
     labels: ['Pink', 'Blue', 'Yellow', ]
 };
 var doughnutPieOptions = {
     responsive: true,
     animation: {
         animateScale: true,
         animateRotate: true
     }
 };

 function energydistributionwidget1() { debugger;
     var ajaxurl = api_url + "dashboard/getdoughnutdata";
     var access_token = $("#access_token").val();
     var org_id = parseInt($("#org_id").val());
     var group_id = 0;
     var settings = {
         "url": ajaxurl,
         "method": "PUT",
         "timeout": 0,
         "headers": {
             "access_token": access_token,
             "Content-Type": "application/json"
         },
         "data": JSON.stringify({
             "distribution_type": 1,
             "end_date": end_date,
             "group_id": "0",
             "org_id": org_id,
             "parameter_type": "real",
             "start_date": start_date
         }),
     };
     $.ajax(settings).done(function(response) { debugger;
         console.log(response);
		 if(response.statusCode==200){
         var res = response.result.data;
         var backgroundColor = ['rgba(255, 99, 132, 0.5)', 'rgba(54, 162, 235, 0.5)', 'rgba(255, 206, 86, 0.5)', 'rgba(75, 192, 192, 0.5)', 'rgba(153, 102, 255, 0.5)', 'rgba(255, 159, 64, 0.5)'];
         var borderColor = ['rgba(255,99,132,1)', 'rgba(54, 162, 235, 1)', 'rgba(255, 206, 86, 1)', 'rgba(75, 192, 192, 1)', 'rgba(153, 102, 255, 1)', 'rgba(255, 159, 64, 1)'];
         var energydata = [];
         var energylevels = [];
         var energylevelsbgcolor = [];
         var energylevelsbordercolor = [];
         for (var i = 0; i < res.length; i++) {
             energydata.push(parseInt(res[i].energy));
             energylevels.push(res[i].name);
             energylevelsbgcolor.push(backgroundColor[i]);
             energylevelsbordercolor.push(borderColor[i]);
         }
         doughnutPieData = {
             datasets: [{
                 data: energydata,
                 backgroundColor: energylevelsbgcolor,
                 borderColor: energylevelsbordercolor,
             }],
             // These labels appear in the legend and in the tooltips when hovering different arcs
             labels: energylevels
         };
         if ($("#doughnutChart").length) {
             var doughnutChartCanvas = $("#doughnutChart").get(0).getContext("2d");
             var doughnutChart = new Chart(doughnutChartCanvas, {
                 type: 'doughnut',
                 data: doughnutPieData,
                 options: doughnutPieOptions
             });
         }
	 }
     });
 }
 var dailysales_chart = {
     datasets: [{
         data: [50, 10, 10, 30],
         backgroundColor: ['#392c70', '#04b76b', '#e9e8ef', '#ff5e6d'],
         borderWidth: 0
     }],
     // These labels appear in the legend and in the tooltips when hovering different arcs
     labels: ['Mail order sales', 'Instore sales', 'Download sales', 'Sales return']
 };

 function energydistributionwidget2() {
     var ajaxurl = api_url + "dashboard/getdoughnutdata";
     var access_token = $("#access_token").val();
     var org_id = parseInt($("#org_id").val());
     var group_id = 0;
     var settings = {
         "url": ajaxurl,
         "method": "PUT",
         "timeout": 0,
         "headers": {
             "access_token": access_token,
             "Content-Type": "application/json"
         },
         "data": JSON.stringify({
             "distribution_type": 0,
             "end_date": end_date,
             "group_id": "0",
             "org_id": org_id,
             "parameter_type": "real",
             "start_date": start_date
         }),
     };
     $.ajax(settings).done(function(response) { debugger;
         console.log(response);
		 if(response.statusCode==200){
         var res = response.result.data;
         var bgcolor = ['#392c70', '#04b76b', '#e9e8ef', '#ff5e6d'];
         var energydata = [];
         var energylevels = [];
         var energylevelsbgcolor = [];
         for (var i = 0; i < res.length; i++) {
             energydata.push(parseInt(res[i].energy));
             energylevels.push(res[i].name);
             energylevelsbgcolor.push(bgcolor[i]);
         }
         dailysales_chart = {
             datasets: [{
                 data: energydata,
                 backgroundColor: energylevelsbgcolor,
                 borderWidth: 0
             }],
             // These labels appear in the legend and in the tooltips when hovering different arcs
             labels: energylevels
         };
         if ($("#daily-sales-chart").length) {
             var dailySalesChartData = dailysales_chart;
             var dailySalesChartOptions = {
                 responsive: true,
                 maintainAspectRatio: true,
                 animation: {
                     animateScale: true,
                     animateRotate: true
                 },
                 legend: {
                     display: false
                 },
                 legendCallback: function(chart) {
                     var text = [];
                     text.push('<ul class="legend' + chart.id + '">');
                     for (var i = 0; i < chart.data.datasets[0].data.length; i++) {
                         text.push('<li><span class="legend-label" style="background-color:' + chart.data.datasets[0].backgroundColor[i] + '"></span>');
                         if (chart.data.labels[i]) {
                             text.push(chart.data.labels[i]);
                         }
                         text.push('</li>');
                     }
                     text.push('</ul>');
                     return text.join("");
                 },
                 cutoutPercentage: 70
             };
             var dailySalesChartCanvas = $("#daily-sales-chart").get(0).getContext("2d");
             var dailySalesChart = new Chart(dailySalesChartCanvas, {
                 type: 'doughnut',
                 data: dailySalesChartData,
                 options: dailySalesChartOptions
             });
             document.getElementById('daily-sales-chart-legend').innerHTML = dailySalesChart.generateLegend();
         }
	    }else{
			//document.getElementById('daily-sales-chart-legend').innerHTML = "No Data Found";
		}
     });
 }
/*
 function parameter_graph_widget() {
     var ajaxurl = api_url + "dashboard/getParameterGraph";
     var access_token = $("#access_token").val();
     var org_id = parseInt($("#org_id").val());
     var group_id = 1;
     var settings = {
         "url": ajaxurl,
         "method": "POST",
         "timeout": 0,
         "headers": {
             "access_token": access_token,
             "Content-Type": "application/json"
         },
         "data": JSON.stringify({
             "end_date": end_date,
             "hours": 24,
             "mac_id": "18000311",
             "org_id": org_id,
             "parameters": [
                 1,
                 2,
                 3,
                 4,
                 5,
                 9,
                 12
             ],
             "start_date": yesterdaystart_date
         }),
     };
     $.ajax(settings).done(function(response) { //debugger;;
         console.log("Parameter");
        
         console.log(response.result.data);
         var res = response.result.data;
         var unit_array = [];
         var ykeys_array = [];
         var labels = [];
         var result_key = 0;
         for (let value of Object.values(res)) {
             result_key++;
            console.log(value);
            unit_array.push(value.unit);
            var value_data = value.data;
            var data = [];
            var data1 = [];
            var data2 = [];
            var data3 = [];
            if(value.unit=='kW' || value.unit=='A'){
                for(var i=0;i<value_data.length;i++){
                    var name = value_data[i].name;
                    labels.push(name);
                    var keys = value_data[i].values;
                   
                    var time = 'y';  
                    // Loop to insert key & value in this object one by one
                    for (var j = 0; j < keys.length; j++) {
                        var value1 = keys[j].y;
                        var value2 = keys[j].x;
                        if(i==0){
                            var obj = {}; 
                            obj['a'] = value1;
                            obj['time'] = value2;
                           data.push(obj);
                        }
                        if(i==1){
                          var obj1 = {}; 
                          if(value1==undefined || value1==null){
                              var bvalue = 0;
                          }else{
                              var bvalue = value1;
                          }
                          obj1['b'] = bvalue;
                          data1.push(obj1);
                        }
                        if(i==2){
                          var obj2 = {};
                          obj2['c'] = value1;
                          data2.push(obj2);
                        }
                        if(i==3){
                          var obj3 = {};    
                          obj3['d'] = value1; 
                          data3.push(obj3);
                        }
                    }
                    //data.push(obj);
                }
            }
            //debugger;;
            var main_data = [];
            if(data.length>0){
                for(var i=0;i<data.length;i++){ //debugger;;
                    var main_obj = {}; 
                    if(data[i].time==undefined || data[i].time==null){
                        main_obj['y'] = "";
                    }else{
                    var timestamp = data[i].time;
                    timestamp = timestamp/1000;
                  //  main_obj['y'] = moment.unix(timestamp).format('MMM DD,YYYY');
                    var yval = i++;
                    main_obj['y'] = yval.toString();
                    }
                    main_obj['a'] = data[i].a;
                    if(data1[i].b==undefined || data1[i].b==null){
                       main_obj['b'] = 0; 
                    }else{
                    main_obj['b'] = parseInt(data1[i].b);
                    }
                     if(data2[i].c==undefined || data2[i].c==null){
                         main_obj['c'] = 0;
                     }else{
                    main_obj['c'] = data2[i].c;
                     }
                      if(data3[i].d==undefined || data3[i].d==null){
                          main_obj['d'] = 0;
                      }else{
                    main_obj['d'] = data3[i].d;
                      }
                      main_data.push(main_obj);
                }
                    
            }
           
            var morrislinekey = 'morris-line-'+result_key;
            if(main_data.length>0){
                console.log(main_data);
                if(result_key==3)
                   morrisLine.setData(main_data);
               Morris.Line({
                          element: morrislinekey,
                          lineColors: ['#63CF72', '#F36368', '#76C1FA', '#FABA66','#3f51b5','#00bcd4'],
                          data: main_data,
                          xkey: 'y',
                          ykeys: ['a', 'b','c','d'],
                          labels: labels,
                          resize: true
                        });  
            }
            // //debugger;;
         }
        
         
     });
 }
*/
function parameter_graph_widget(parameter_type) {
     var ajaxurl = api_url + "dashboard/getParameterGraph";
     var access_token = $("#access_token").val();
     var org_id = parseInt($("#org_id").val());
	 var mac_id = $('#mac_id').val();
     var group_id = 1;
     $("#chartcon"+parameter_type).addClass('loading');
     var settings = {
         "url": ajaxurl,
         "method": "POST",
         "timeout": 0,
         "headers": {
             "access_token": access_token,
             "Content-Type": "application/json"
         },
         "data": JSON.stringify({
             "end_date": end_date,
             "hours": 24,
             "mac_id": mac_id,
             "org_id": org_id,
             "parameters": [
                 parameter_type
             ],
             "start_date": yesterdaystart_date
         }),
     };
     $.ajax(settings).done(function(response) { //debugger;;
         console.log("Parameter");
        
		 if(response.statusCode==200){
         var res = response.result.data;
         var unit_array = [];
         var ykeys_array = [];
         var labels = [];
         var result_key = 0;
         for (let objvalue of Object.values(res)) {
             result_key++;
            console.log(objvalue);
            unit_array.push(objvalue.unit);
            var value_data = objvalue.data;
            var data = [];
            var data1 = [];
            var data2 = [];
            var data3 = [];
            if(parameter_type<5){
                for(var i=0;i<value_data.length;i++){
                    var name = value_data[i].name;
                    labels.push(name);
                    var keys = value_data[i].values;
                    var time = 'y';  
                    for (var j = 0; j < keys.length; j++) {
                        var value2 = keys[j].y;
                        var value1 = keys[j].x;
                       // value1 = value1/1000;
                        if(i==0){
                            var obj = {}; 
                            obj['y'] = value2;
                            obj['x'] = new Date(value1);
                          //  obj['x'] = moment.unix(value1).format('hh:mm');
                           data.push(obj);
                        }
                        if(i==1){
                          var obj1 = {}; 
                          if(value1==undefined || value1==null){
                              var bvalue = 0;
                          }else{
                              var bvalue = value2;
                          }
                          obj1['y'] = bvalue;
                          obj1['x'] = new Date(value1);
                         // obj1['x'] = moment.unix(value1).format('hh:mm');
                          data1.push(obj1);
                        }
                        if(i==2){
                          var obj2 = {};
                          obj2['y'] = value2;
                          obj2['x'] = new Date(value1);
                        //  obj2['x'] = moment.unix(value1).format('hh:mm');
                          data2.push(obj2);
                        }
                        if(objvalue.unit=='kW' || objvalue.unit=='A'){
                            if(i==3){
                              var obj3 = {};    
                              obj3['y'] = value2; 
                              obj3['x'] = new Date(value1);
                            //  obj3['x'] = moment.unix(value1).format('hh:mm');
                              data3.push(obj3);
                            }
                        }
                    }
                }
            }else{
                for(var i=0;i<value_data.length;i++){
                    var name = value_data[i].name;
                    labels.push(name);
                    var keys = value_data[i].values;
                    var time = 'y';  
                    for (var j = 0; j < keys.length; j++) {
                        var value2 = keys[j].y;
                        var value1 = keys[j].x;
                       // value1 = value1/1000;
                        if(i==0){
                            var obj = {}; 
                            obj['y'] = value2;
                            obj['x'] = new Date(value1);
                          //  obj['x'] = moment.unix(value1).format('hh:mm');
                           data.push(obj);
                        }
                    }
                }
            }
            
            //debugger;;
            var main_data = [];
            
            if(data.length>0){
               // var series = [];
                if(parameter_type==1){
                    var titleYAxis = {};
                    titleYAxis['text'] = "Power (kW)";
                    var range = {};
                    range['min'] = 0;
                    range['max'] = 1.6;
                    range['interval'] = 0.2;
                    var series = [ 
                                {
                                    points: data,
                                    name: labels[0],
                                    tooltip :
                                    { 
                                       // visible:true , 
                                        format:"#series.name# : #point.y# kW"
                                    }
                                },                
                                {
                                    points: data1,
                                    name: labels[1],
                                    tooltip :
                                    { 
                                       // visible:true , 
                                        format:"#series.name# : #point.y# kW"
                                    }
                                }, 
                               {
                                    points: data2,
                                    name: labels[2],
                                    tooltip :
                                    { 
                                      //  visible:true , 
                                        format:"#series.name# : #point.y# kW"
                                    }
                                }, 
                                {
                                    points: data3,
                                    name: labels[3],
                                    tooltip :
                                    { 
                                        visible:false , 
                                        format:"#series.name# : #point.y# kW"
                                    }
                                }
                            ];
                }
                if(parameter_type==2){
                    var titleYAxis = {};
                    titleYAxis['text'] = "Voltage (V)";
                    var range = {};
                    range['min'] = 0;
                    range['max'] = 400;
                    range['interval'] = 50;
                    var series = [ 
                                {
                                    points: data,
                                    name: labels[0],
                                    tooltip :
                                    { 
                                       // visible:true , 
                                        format:"R : #point.y# V"
                                    }
                                },                
                                {
                                    points: data1,
                                    name: labels[1],
                                    tooltip :
                                    { 
                                       // visible:true , 
                                        format:"Y : #point.y# V"
                                    }
                                }, 
                               {
                                    points: data2,
                                    name: labels[2],
                                    tooltip :
                                    { 
                                      //  visible:true , 
                                        format:"B : #point.y# V"
                                    }
                                }
                            ];
                }
                if(parameter_type==3){
                    var titleYAxis = {};
                    titleYAxis['text'] = "Current (A)";
                     var range = {};
                    range['min'] = 0;
                    range['max'] = 6;
                    range['interval'] = 1;
                     var series = [ 
                                {
                                    points: data,
                                    name: labels[0],
                                    tooltip :
                                    { 
                                       // visible:true , 
                                        format:"R : #point.y# A"
                                    }
                                },                
                                {
                                    points: data1,
                                    name: labels[1],
                                    tooltip :
                                    { 
                                       // visible:true , 
                                        format:"Y : #point.y# A"
                                    }
                                }, 
                               {
                                    points: data2,
                                    name: labels[2],
                                    tooltip :
                                    { 
                                      //  visible:true , 
                                        format:"B : #point.y# A"
                                    }
                                }, 
                                {
                                    points: data3,
                                    name: labels[3],
                                    tooltip :
                                    { 
                                      //  visible:true , 
                                        format:"Total : #point.y# A"
                                    }
                                }
                            ];
                }
                if(parameter_type==4){
                    var titleYAxis = {};
                    titleYAxis['text'] = "Power Factor (%)";
                     var range = {};
                    range['min'] = 0;
                    range['max'] = 1;
                    range['interval'] = 0.2;
                    var series = [ 
                                {
                                    points: data,
                                    name: labels[0],
                                    tooltip :
                                    { 
                                       // visible:true , 
                                        format:"R : #point.y# %"
                                    }
                                },                
                                {
                                    points: data1,
                                    name: labels[1],
                                    tooltip :
                                    { 
                                       // visible:true , 
                                        format:"Y : #point.y# %"
                                    }
                                }, 
                               {
                                    points: data2,
                                    name: labels[2],
                                    tooltip :
                                    { 
                                      //  visible:true , 
                                        format:"B : #point.y# %"
                                    }
                                }
                            ];
                }
                if(parameter_type==5){
                    var titleYAxis = {};
                    titleYAxis['text'] = "Temperature ( °C )";
                     var range = {};
                    range['min'] = 25.2;
                    range['max'] = 27.2;
                    range['interval'] = 0.5;
                    var series = [ 
                                {
                                    points: data,
                                    name: labels[0],
                                    tooltip :
                                    { 
                                       // visible:true , 
                                        format:"R : #point.y# °C"
                                    }
                                }
                            ];
                }
                if(parameter_type==9){
                    var titleYAxis = {};
                    titleYAxis['text'] = "UPS Status";
                     var range = {};
                    range['min'] = 0;
                    range['max'] = 1;
                    range['interval'] = 0.2;
                     var series = [ 
                                {
                                    points: data,
                                    name: labels[0],
                                    tooltip :
                                    { 
                                       // visible:true , 
                                        format:"UPS : Present"
                                    }
                                }
                            ];
                }
                if(parameter_type==12){
                    var titleYAxis = {};
                    titleYAxis['text'] = "Accessory Current ( A )";
                     var range = {};
                    range['min'] = 0;
                    range['max'] = 0.12;
                    range['interval'] = 0.02;
                     var series = [ 
                                {
                                    points: data,
                                    name: labels[0],
                                    tooltip :
                                    { 
                                       // visible:true , 
                                        format:"Acc. Current : #point.y# A"
                                    }
                                }
                            ];
                }
                var powerval = objvalue.unit;
                //chartconkey++;
                 $("#chartcon"+parameter_type).ejChart(
                        {
                           //  exportSettings: { multipleExport : true },
                            primaryXAxis:
                            {
                                title: { text: "Hours" },
                             //   valueType: 'DateTime',
                              //  labelFormat: 'hm',
                             //   intervalType: "Hours", 
                             //  labelFormat: '{value}',
                              // skeleton: "h",
                               crosshairLabel: { visible: true },
                             //  minimum: new Date(1631557800000),maximum: new Date(1631601000000),
                             //  range: { min: new Date(1631557800000), max: new Date(1631601000000), interval: 2 },
                            },  
                            primaryYAxis:
                            {
                                title: titleYAxis,
                              //  labelFormat: '{value}',
                                majorTickLines:
                                {
                                 //   visible: false
                                },
                                crosshairLabel: { visible: true },
                                range: range,
                              //  axisLine: { visible: false }
                            },    
                            commonSeriesOptions: 
                              {
                                    type: 'line' ,
                                    enableAnimation : true,
                                    marker:
                                    {
                                     //   shape: 'circle',
                                        size:
                                        {
                                            height: 6, width: 6
                                        },
                                    //    visible: true,
                                      //  border :{color: 'yellow', width: 3} 
                                    },
                                    border :{width: 3} 
                              },
                      
                            series: series,
                            crosshair: 
                            {
                                    visible: true,
                                    type: 'trackball',
                                    trackballTooltipSettings: {
                                        mode:"grouping",
                                      //  border : { color :"red" }
                                    }
                            },
                              
                            load:"loadTheme",
                         //   isResponsive: true,
                            title :{text: ''},
                            size: { height: "600" },
                            legend: 
                              { 
                                visible: true,
                              //  shape: 'circle',
                                position: 'Top', 
                                itemStyle: { width: 10, height: 10 } 
                              }               
                        });
                    
            }  
           
         //   var morrislinekey = 'morris-line-'+result_key;
         $("#chartcon"+parameter_type).removeClass('loading');
        
           
         }
	 }
         
     });
 }

 function electrical_parameter_mapping() {
     //var ajaxurl = api_url + "dashboard/getParameterGraph";
     var access_token = $("#access_token").val();
    // var org_id = $("#org_id").val();
	 var org_id = parseInt($("#org_id").val());
     var group_id = 0;
	 var ajaxurl = api_url + "parametergraph/getparams?org_id="+org_id;
     var settings = {
         "url": ajaxurl,
         "method": "GET",
         "timeout": 0,
         "headers": {
             "access_token": access_token
         },
     };
     $.ajax(settings).done(function(response) {
         console.log(response);
     });
 }



 
 function api_login() {
     var ajaxurl = api_url + "user/login";
     var postdata = JSON.stringify({
         "email": "apiuser@cts.com",
         "password": "sep3@2021"
     });
     var settings = {
         "url": ajaxurl,
         "method": "POST",
         "headers": {
             "Content-Type": "application/json"
         },
     };
     $.ajax(settings).done(function(response) {
         
     });
 }

 function setCookie(key, value, expiry) {
     var expires = new Date();
     expires.setTime(expires.getTime() + (expiry * 24 * 60 * 60 * 1000));
     document.cookie = key + '=' + value + ';expires=' + expires.toUTCString();
 }

 function getCookie(key) {
     var keyValue = document.cookie.match('(^|;) ?' + key + '=([^;]*)(;|$)');
     return keyValue ? keyValue[2] : null;
 }

 function eraseCookie(key) {
     var keyValue = getCookie(key);
     setCookie(key, keyValue, '-1');
 }
 /* Reports */
 function getConsumptionParameter() { debugger;
    // var ajaxurl = api_url + "dashboard/getParameterGraph";
     var access_token = $("#access_token").val();
     var org_id = parseInt($("#org_id").val());
     var group_id = 0;
	 var ajaxurl = api_url + "reports/getconsumparams?org_id="+org_id;
     var settings = {
         "url": ajaxurl,
         "method": "GET",
         "timeout": 0,
         "headers": {
             "access_token": access_token
         },
     };
     $.ajax(settings).done(function(response) { debugger;
         console.log(response);
     });
 }

 function getEnergyConsumption() {
    debugger;
     var ajaxurl = api_url + "reports/getconsumption";
     var access_token = $("#access_token").val();
     var org_id = parseInt($("#org_id").val());
     var group_id = $('#group_id').val();
     var mac_id = [];
     if (group_id) {
         var macid = $('#mac_id').val();
         mac_id.push(macid);
     }
     var group_id = 0;
     var settings = {
         "url": ajaxurl,
         "method": "POST",
         "timeout": 0,
         "headers": {
             "access_token": access_token,
             "Content-Type": "application/json"
         },
         "data": JSON.stringify({
             "end_date": end_date,
             "energy_type": "real",
             "group_id": "1",
             "interval": "daily",
             "mac_id": mac_id,
             "org_id": org_id,
             "report_type": "preview",
             "start_date": start_date
         }),
     };
     $.ajax(settings).done(function(response) {
        debugger;
         console.log(response);
         if (response.statusCode == 200) {
             var res = response.result.energy;
             var overall_total = response.result.overall_total;
             var table_html = "";
             for (var i = 0; i < res.length; i++) {
                 table_html += "<tr>";
                 table_html += "<td>" + res[i].srno + "</td>";
                 table_html += "<td>" + res[i].gateway + "</td>";
                 var energy_count = res[i].energy;
                 for (var j = 0; j < energy_count.length; j++) {
                     table_html += "<td>" + energy_count[j] + "</td>";
                 }
                 table_html += "<td>" + res[i].total + "</td>";
                 table_html += "</tr>";
             }
             table_html += '<tr><td colspan="10">Total Consumption (kWh)</td><td>' + overall_total + '</td></tr>'
             $('#table_data').html(table_html);
         }
     });
 }

 function getAlert() { debugger;
     var ajaxurl = api_url + "reports/getalerts";
     var access_token = $("#access_token").val();
     var org_id = parseInt($("#org_id").val());
     var group_id = 0;
     var settings = {
         "url": ajaxurl,
         "method": "POST",
         "timeout": 0,
         "headers": {
             "access_token": access_token,
             "Content-Type": "application/json"
         },
         "data": JSON.stringify({
             "end_date": end_date,
             "alert_type": [
                 0,
                 1,
                 2,
                 3,
                 6,
                 9,
                 13,
                 14,
                 15,
                 10,
                 11,
                 12,
                 17
             ],
             "group_id": "0",
             "order": 1,
             "pageno": 1,
             "mac_id": [],
             "org_id": org_id,
             "report_type": "preview",
             "status": "all",
             "time": "detected_at",
             "user_role": "Admin",
             "start_date": start_date
         }),
     };
     $.ajax(settings).done(function(response) { debugger;
         console.log(response);
     });
 }
 
 
 
 
 function DeviceList()
 { //debugger;;
     
     var access_token = $("#access_token").val();
     var org_id = parseInt($("#org_id").val());
     var group_id = parseInt($("#group_id").val());
     var userId = sessionStorage.getItem("userId");
     
     if(userId==null)
     {
        apilogin(); 
     }
     else
     {
     
        var ajaxurl = api_url + "users/getgroup?org_id="+org_id+"&user_id="+userId; 
		//"https://timer.lightingmanager.in/users/getgroup?org_id="+org_id+"&user_id="+userId

        var settings = {
          "async": true,
          "crossDomain": true,
          "url": ajaxurl,
          "method": "GET",
          "headers": {
            "Connection": "keep-alive",
          }
        }
        
        $.ajax(settings).done(function (response) { debugger;
          console.log(response);
           if (response.statusCode == 200) {
             var pergroup_id = sessionStorage.getItem("group_id");
             var res = response.result;
             var table_html = "";
                 table_html +="<select>";
             for (var i = 0; i < res.length; i++) {
                 if(pergroup_id==res[i].group_id){
                 table_html += "<option value='"+res[i].group_id+"' selected>" + res[i].name + "</option>";
                 }
                 else
                 {
                     table_html += "<option value='"+res[i].group_id+"'>" + res[i].name + "</option>"; 
                 }
             }
                 table_html += "</select>";
              console.log(table_html);
              $("#deviceList").html(table_html);
            
         }
        });
 }
 }
 
 function setpanelvalue(group_id)
 {
     debugger;
      var access_token = $("#access_token").val();
      var org_id = parseInt($("#org_id").val());
      var group_id = parseInt(group_id);
    //  var group_id = sessionStorage.getItem("group_id");
       //"https://.in/dashboard/panellist?org_id="+org_id+"&group_id="+group_id,
     var ajaxurl = api_url + "dashboard/panellist?org_id="+org_id+"&group_id="+group_id;
   
    var settings = {
      "async": true,
      "crossDomain": true,
      "url": ajaxurl,
      "method": "GET",
      "headers": {
        "access_token": access_token,
        "Connection": "keep-alive",
        "cache-control": "no-cache"
      },
    }

$.ajax(settings).done(function (response) { debugger;
  console.log(response);
  if (response.statusCode == 200) {
             var res = response.result;
             console.log(res);
             console.log(res);
              
         var mac_id = res[0].mac_id;
         var panel_name = res[0].panel_name;
         
           sessionStorage.setItem("mac_id",mac_id);
           sessionStorage.setItem("panel_name",panel_name);
           sessionStorage.setItem("group_id",group_id);
         
         $('#mac_id').val(mac_id);
         $('#panel_name').val(panel_name);
         $('#group_id').val(group_id);
       
        //  setPanel();
      //  location.reload();
              
            
         }
});

     
        
 }

 