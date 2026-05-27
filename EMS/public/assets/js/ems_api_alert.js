function onloadalert()
{
     var refresh_cookies =   sessionStorage.getItem("refresh_token");
     var access_cookies =  sessionStorage.getItem("access_token");
     var org_cookies =   sessionStorage.getItem("org_id");
    var group_id =   sessionStorage.getItem("group_id");

     // var access_cookies = $('#access_token').val();   

    if (refresh_cookies === null || access_cookies ==='' || org_cookies === null || group_id === null ) {
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
    getalertlist();
}

function getalertlist() {
     var access_token = $("#access_token").val();
     var org_id = $("#org_id").val();
     
     var settings = {
         "url": "https://timer.lightingmanager.in/rule/getall?org_id="+org_id,
         "method": "GET",
         "timeout": 0,
         "headers": {
             "access_token": access_token
         },
     };
     $.ajax(settings).done(function(response) { debugger;
         console.log(response);
         if (response.statusCode == 200) {
            //  var count = response.result.count;
             var res = response.result;
   var alert_table = "";
  for (var i = 0; i < res.length; i++) {
      
    //   var bdg="<span class="text-primary"> </span>";
    var flag= res[i].default;
                     
    var op = '';
    if (flag===true){ op = "<span class='badge badge-primary'>default</span>"; }
    //   var cb="<span> <input class='checkbox' value='' disabled> </span>";
    
    var btn1= res[i].severity;
    var bt1='';
    if (btn1===1){ bt1 = "<label title='"+ res[i].label_1 +"' class='text-dark'>Medium</label>"; }else 
    {
        bt1 = "<label title='"+ res[i].label_1 +"' class='text-dark'>High</label>";
    }
    alert_table += "<tr>";


    alert_table += "<td>"+ res[i].name +"</td>";
    alert_table += "<td>"+ op +"</td>";
     alert_table += "<td>"+ bt1 +"</td>";
     alert_table += "</tr>";
  
  }
  //   console.log(table_html);
              $("#panelalertList").html(alert_table);
            //   $("#table_foot").html(table_foot);
  }
     });
 }




function getalertlist1()
{
     debugger;
            var org_id= $('#org_id').val();
           
           var access_token= $("#access_token").val();
          var group_id=  $("#group_id").val(); 
            
            
    var settings = {
  "url": "https://timer.lightingmanager.in/reports/getalerts",
  "method": "POST",
  "timeout": 0,
  "headers": {
    "access_token": access_token,
    "Content-Type": "application/json"
  },
  "data": JSON.stringify({
    "end_date": 1630837840,
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
    "group_id": group_id,
    "order": 1,
    "pageno": 1,
    "mac_id": [],
    "org_id": org_id,
    "report_type": "preview",
    "status": "all",
    "time": "detected_at",
    "user_role": "Admin",
    "start_date": 1630175400
  }),
};

$.ajax(settings).done(function (response) { debugger;
  console.log(response);
  if (response.statusCode == 200) {
             var count = response.result.totalcount;
             var res = response.result.logs;
   var alert_table = "";
  for (var i = 0; i < res.length; i++) {
     alert_table += "<tr>";
     alert_table += "<td></td>";
     alert_table += "<td>"+ res[i].sr_no +"</td>";
     alert_table += "<td>"+ res[i].description +"</td>";
     alert_table += "<td>"+ res[i].severity +"</td>";
     alert_table += "<tr>";
  
  }
  //   console.log(table_html);
              $("#panelalertList").html(alert_table);
            //   $("#table_foot").html(table_foot);
  }
});
}
