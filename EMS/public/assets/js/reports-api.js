/* Reports */
 function getConsumptionParameter() {
     var ajaxurl = api_url + "dashboard/getParameterGraph";
     var access_token = $("#access_token").val();
     var org_id = parseInt($("#org_id").val());
     var group_id = 0;
     var settings = {
         "url": "https://timer.lightingmanager.in/reports/getconsumparams?org_id=147",
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

 function getEnergyConsumption() {
    
     var ajaxurl = api_url + "reports/getconsumption";
     var access_token = $("#access_token").val();
     var org_id = parseInt($("#org_id").val());
     var group_id = $('#group_id').val();
     var mac_id = [];
     if (group_id) {
         var macid = $('#mac_id').val();
         mac_id.push(macid);
     }
     
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

 function getAlert() {
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
             "group_id": "1",
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
     $.ajax(settings).done(function(response) {
         console.log(response);
     });
 }