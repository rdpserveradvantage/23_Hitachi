 @extends('layout.layout')

 @section('content')
 
 <style>
  .nav-tabs .nav-link {
    background: #f6f8fa;
    color: #000000;
    border-radius: 0;
    border: 1px solid #e0e0ef;
    padding: 0.15rem 1.3rem;
}
.loading {
    display: block;
    /*visibility: visible;*/
    /*position: absolute;*/
    z-index: 999;
    
    /*width: 200px;*/
    height: 200px;
    /*background-color:white;*/
    /*vertical-align:bottom;*/
    /*padding-top: 20%;*/
    /*filter: alpha(opacity=75);*/
    /*opacity: 0.75;*/
    /*font-size:large;*/
    /*color:blue;*/
    /*font-style:italic;*/
    /*font-weight:400;*/
    background-image: url("{{url('assets/images/loader.gif')}}");
    background-repeat: no-repeat;
    background-position: center;
}

</style>
 <link href="https://cdn.syncfusion.com/17.4.0.46/js/web/flat-azure/ej.web.all.min.css" rel="stylesheet" />
 <script type="text/javascript" src="https://cdn.syncfusion.com/17.4.0.46/js/web/ej.web.all.min.js"></script>
 <!-- partial MAIN  -->
 <div class="main-panel">

        <div class="content-wrapper">
          <div class="page-header">
            <h3 class="page-title">
              Dashboard
            </h3>
            <input type="hidden" id="refresh_token">
            <input type="hidden" id="access_token">
            <input type="hidden" id="org_id">
          </div>
         <!-- <div class="row grid-margin">
            <div class="col-12">
              <div class="card card-statistics">
                <div class="card-body">
                  <div class="d-flex flex-column flex-md-row align-items-center justify-content-between">
                      <div class="statistics-item">
                        <p>
                          <i class="icon-sm fa fa-upload mr-2"></i>
                          Offline Device
                        </p>
                        <h2 ></h2>
                        <label class="badge badge-outline-success badge-pill" id="offline_percent">2.7% increase</label>
                      </div>
                      <div class="statistics-item">
                        <p>
                          <i class="icon-sm fas fa-hourglass-half mr-2"></i>
                          Load kW
                        </p>
                        <h2 ></h2>
                        <label class="badge badge-outline-danger badge-pill" id="load_percent">30% decrease</label>
                      </div>
                      <div class="statistics-item">
                        <p>
                          <i class="icon-sm fas fa-bolt mr-2"></i>
                          Energy kWh
                        </p>
                        <h2 ></h2>
                        <label class="badge badge-outline-success badge-pill" id="energy_percent">12% increase</label>
                      </div>
                      <div class="statistics-item">
                        <p>
                          <i class="icon-sm fas fa-exclamation-triangle mr-2"></i>
                        Alerts
                        </p>
                        <h2 ></h2>
                        <label class="badge badge-outline-success badge-pill" id="alert_percent">57% increase</label>
                      </div>
                      
                  </div>
                </div>
              </div>
            </div>
          </div>  -->
          
           
           <div class="row">
                <div class="col-md-3 grid-margin">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title mb-0">Offline Device</h4><!--<i class="fa fa-info" title="The Total Offline Devices in selected Zone"></i>-->
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="d-inline-block pt-3">
                                    <div class="d-md-flex">
                                        <h3 class="mb-0" id="offline_count"></h3>
                                        
                                    </div>
                                    <small class="text-gray"></small>
                                </div>
                                <div class="d-inline-block">
                                    <i class="fas fa-upload text-info icon-lg"></i>                                    
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 grid-margin">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title mb-0">Load kW</h4>
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="d-inline-block pt-3">
                                    <div class="d-md-flex">
                                        <h3 class="mb-0" id="load_kw"></h3>
                                        
                                    </div>
                                    <small class="text-gray"></small>
                                </div>
                                <div class="d-inline-block">
                                    <i class="fas fa-hourglass-half text-info icon-lg"></i>                                    
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 grid-margin">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title mb-0">Energy kWh</h4>
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="d-inline-block pt-3">
                                    <div class="d-md-flex">
                                        <h3 class="mb-0" id="energy_kw"></h3>
                                        
                                    </div>
                                    <small class="text-gray"></small>
                                </div>
                                <div class="d-inline-block">
                                    <i class="fas fa-bolt text-danger icon-lg"></i>                                    
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 grid-margin">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title mb-0">Alerts</h4>
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="d-inline-block pt-3">
                                    <div class="d-md-flex">
                                        <h3 class="mb-0" id="alert_count"></h3>
                                        
                                    </div>
                                    <small class="text-gray"></small>
                                </div>
                                <div class="d-inline-block">
                                    <i class="fas fa-exclamation-triangle text-danger icon-lg"></i>                                    
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div> 

          <div class="row">
            <div class="col-md-6 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">
                    <i class="fas fa-gift"></i>
                    Google Map
                  </h4>
                 
                    <div id="map"style=" height: 400px;"></div> 
                  
                                   
                </div>
              </div>
            </div>
            <div class="col-md-6 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">
                    <i class="fas fa-chart-line"></i>
                    Alert
                  </h4>
                  <p style="text-align:center;">No Data Found</p>
                  <!--<h2 class="mb-5">56000 <span class="text-muted h4 font-weight-normal">Sales</span></h2>
                  <canvas id="sales-chart"></canvas> -->
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-6 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">
                    <i class="fas fa-chart-line"></i>
                    Energy Trend
                  </h4>
                  
                        <div class="card" >
                        
                          <ul class="nav nav-tabs" role="tablist">
                            <li class="nav-item" onclick="getEnergyTrend('daily',1)">
                              <a class="nav-link active" id="home-tab1" data-toggle="tab" href="#home-1" role="tab" aria-controls="home-1" aria-selected="true">Daily</a>
                            </li>
                            <li class="nav-item" onclick="getEnergyTrend('weekly',2)">
                              <a class="nav-link" id="home-tab2" data-toggle="tab" href="#home-2" role="tab" aria-controls="home-2" aria-selected="false">Weekly</a>
                            </li>
                            <li class="nav-item" onclick="getEnergyTrend('monthly',3)">
                              <a class="nav-link" id="home-tab3" data-toggle="tab" href="#home-3" role="tab" aria-controls="home-3" aria-selected="false">Monthly</a>
                            </li>
                            <li class="nav-item" onclick="getEnergyTrend('quarterly',4)">
                              <a class="nav-link" id="home-tab4" data-toggle="tab" href="#home-4" role="tab" aria-controls="home-4" aria-selected="false">Quarterly</a>
                            </li>
                            <li class="nav-item" onclick="getEnergyTrend('yearly',5)">
                              <a class="nav-link" id="home-tab5" data-toggle="tab" href="#home-5" role="tab" aria-controls="home-5" aria-selected="false">Yearly</a>
                            </li>
                          </ul>
                          <div class="tab-content">
                            <div class="tab-pane fade show active" id="home-1" role="tabpanel" aria-labelledby="home-tab1" >
                                  <canvas id="barChart-1"></canvas>
                            </div>
                            <div class="tab-pane fade" id="home-2" role="tabpanel" aria-labelledby="home-tab2" >
                                  <canvas id="barChart-2"></canvas>
                            </div>
                            <div class="tab-pane fade" id="home-3" role="tabpanel" aria-labelledby="home-tab3">
                                <canvas id="barChart-3"></canvas>
                            </div>
                            <div class="tab-pane fade" id="home-4" role="tabpanel" aria-labelledby="home-tab4">
                                   <canvas id="barChart-4"></canvas>
                            </div>
                            <div class="tab-pane fade" id="home-5" role="tabpanel" aria-labelledby="home-tab5">
                                  <canvas id="barChart-5"></canvas>
                            </div>
                          </div>
                        
                      </div>
                  
                 <!-- <canvas id="barChart"></canvas>-->
                </div>
              </div>
            </div>
          

             <div class="col-md-6 grid-margin stretch-card">
              <div class="card">
                <div class="card-body d-flex flex-column">
                  <h4 class="card-title">
                    <i class="fas fa-tachometer-alt"></i>
                    Energy Distribution
                  </h4>
                  <p class="card-description">Last 7 Days</p>
                  <div class="flex-grow-1 d-flex flex-column justify-content-between">
                    <canvas id="daily-sales-chart" class="mt-3 mb-3 mb-md-0"></canvas>
                    <div id="daily-sales-chart-legend" class="daily-sales-chart-legend pt-4 border-top"></div>
                  </div>
                </div>
              </div>
            </div>
            </div>
            <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">
                    <i class="fas fa-chart-line"></i>
                    Electrical Parameters
                  </h4>
                  <div class="card" >
                
                  <ul class="nav nav-tabs" role="tablist">
                    <li class="nav-item" onclick="getElectricalParameter(1)">
                      <a class="nav-link active" id="home-tab6" data-toggle="tab" href="#home-6" role="tab" aria-controls="home-6" aria-selected="true">Power</a>
                    </li>
                    <li class="nav-item" onclick="getElectricalParameter(2)">
                      <a class="nav-link" id="home-tab7" data-toggle="tab" href="#home-7" role="tab" aria-controls="home-7" aria-selected="true">Voltage</a>
                    </li>
                    <li class="nav-item" onclick="getElectricalParameter(3)">
                      <a class="nav-link" id="home-tab8" data-toggle="tab" href="#home-8" role="tab" aria-controls="home-8" aria-selected="true">Current</a>
                    </li>
                    <li class="nav-item" onclick="getElectricalParameter(4)">
                      <a class="nav-link" id="home-tab9" data-toggle="tab" href="#home-9" role="tab" aria-controls="home-9" aria-selected="true">Power Factor</a>
                    </li>
                    <li class="nav-item" onclick="getElectricalParameter(5)">
                      <a class="nav-link" id="home-tab10" data-toggle="tab" href="#home-10" role="tab" aria-controls="home-10" aria-selected="true">Temperature</a>
                    </li>
                    <li class="nav-item" onclick="getElectricalParameter(9)">
                      <a class="nav-link" id="home-tab11" data-toggle="tab" href="#home-11" role="tab" aria-controls="home-11" aria-selected="true">UPS Status</a>
                    </li>
                    <li class="nav-item" onclick="getElectricalParameter(12)">
                      <a class="nav-link" id="home-tab12" data-toggle="tab" href="#home-12" role="tab" aria-controls="home-12" aria-selected="true">Accessory Current</a>
                    </li>
                  </ul>
                  <div class="tab-content">
                    <div class="tab-pane fade show active" id="home-6" role="tabpanel" aria-labelledby="home-tab6" >
                         <div id="chartcon1" style="width:100%;height:100%"></div>
	                </div>
                    <div class="tab-pane fade" id="home-7" role="tabpanel" aria-labelledby="home-tab7" >
                         <div id="chartcon2" style="width:100%;"></div>
                    </div>
                    <div class="tab-pane fade" id="home-8" role="tabpanel" aria-labelledby="home-tab8" >
                          <div id="chartcon3" style="width:100%;"></div>        
                    </div>
                    <div class="tab-pane fade" id="home-9" role="tabpanel" aria-labelledby="home-tab9" >
                          <div id="chartcon4" style="width:100%;"></div>       
                    </div>
                    <div class="tab-pane fade" id="home-10" role="tabpanel" aria-labelledby="home-tab10" >
                         <div id="chartcon5" style="width:100%;"></div>
                    </div>
                    <div class="tab-pane fade" id="home-11" role="tabpanel" aria-labelledby="home-tab11" >
                           <div id="chartcon9" style="width:100%;"></div>
                    </div>
                    <div class="tab-pane fade" id="home-12" role="tabpanel" aria-labelledby="home-tab12" >
                           <div id="chartcon12" style="width:100%;"></div>       
                    </div>
                  </div>
                </div>
              </div>
            </div>
            </div>
          <!--
            <div class="col-md-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Electrical Parameters</h4>
                  <p class="card-description">Horizontal bootstrap tab</p>
                  <ul class="nav nav-tabs" role="tablist">
                    
                    <li class="nav-item">
                      <a class="nav-link" id="new-tab" data-toggle="tab" href="#newtab-1" role="tab" aria-controls="newtab-1" aria-selected="false">Profile</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile-1" role="tab" aria-controls="profile-1" aria-selected="false">Profile</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link active show" id="contact-tab" data-toggle="tab" href="#contact-1" role="tab" aria-controls="contact-1" aria-selected="true">Contact</a>
                    </li>
                  </ul>
                  <div class="tab-content">
                    
                    <div class="tab-pane fade" id="newtab-1" role="tabpanel" aria-labelledby="new-tab">
                      <div id="chartcon" style="width:100%;"></div>
                    </div>
                    <div class="tab-pane fade" id="profile-1" role="tabpanel" aria-labelledby="profile-tab">
                      <div id="container" style="width:100%;"></div> 
                    </div>
                    <div class="tab-pane fade active show" id="contact-1" role="tabpanel" aria-labelledby="contact-tab">
                     <div id="container1" style="width:100%;"></div>
                    </div>
                  </div>
                </div>
              </div>
            </div>  -->
            
            <div class="col-md-6 grid-margin grid-margin-md-0 stretch-card">
                     <div class="card">
                <div class="card-body" style="max-height: 600px;overflow: scroll;">
                  <h4 class="card-title">Recent Activities</h4>
                  <div class="mt-4" id="recent_activities">
                    <div class="accordion" id="accordion" role="tablist">

                     <!-- <div class="card" >
                        <div class="card-header p-2" role="tab" id="heading-2">
                          <h6 class="mb-1">
                            <a class="collapsed" data-toggle="collapse" href="#collapse-2" aria-expanded="false" aria-controls="collapse-2">
                              User Name
                            </a>
                          </h6>
                          <div class="mb-1">
                              <strong style="font-weight: 900;">ATM ID : B1088910</strong><small style="float: right;">06 julay 2021 2:20 pm</small>
                           
                          </div>

                        </div>
                        <div id="collapse-2" class="collapse" role="tabpanel" aria-labelledby="heading-2" data-parent="#accordion">
                          <div class="card-body" style="padding: 0.5rem 0.5rem 0.5rem 0.5rem;">
                            <table class="table-bordered table-striped" width="100%">
                                <thead>
                                    <th>parameters</th>
                                    <th>Old value</th>
                                    <th>new Value</th>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Lobby AC Mode</td>
                                        <td>Instant</td>
                                        <td>Interval</td>
                                    </tr>
                                </tbody>
                            </table>
                          </div>
                        </div>
                      </div> -->
                      
                    </div>
                    
                    
                    
                  </div>
                </div>
              </div>
                </div>
            <div class="col-md-6 grid-margin stretch-card">
              <div class="card">
                <div class="card-body d-flex flex-column">
                  <h4 class="card-title">
                    <i class="fas fa-tachometer-alt"></i>
                    Energy Distribution
                  </h4>
                  <p class="card-description">Last 7 Days</p>
                  <div class="flex-grow-1 d-flex flex-column justify-content-between">
                    <canvas id="doughnutChart" class="mt-3 mb-3 mb-md-0"></canvas>
                    <div id="doughnutChart" class="doughnutChart pt-4 border-top"></div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          
            <div class="row" style="margin-top: 1.25rem;">
                <div class="col-md-3 grid-margin">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title mb-0">Expense</h4>
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="d-inline-block pt-3">
                                    <div class="d-md-flex">
                                        <h3 class="mb-0" id="expense"></h3>
                                        
                                    </div>
                                    <small class="text-gray"></small>
                                </div>
                                <div class="d-inline-block">
                                    <i class="fas fa-rupee-sign text-success icon-lg"></i>                                    
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>    
          
        </div>
        <!-- content-wrapper ends -->
        
        
        <script>

  function onload(){ debugger;

    // var refresh_cookies = getCookie('refresh_token');
    // var access_cookies = getCookie('access_token');
    // var org_cookies = getCookie('org_id');

     var refresh_cookies =   sessionStorage.getItem("refresh_token");
     var access_cookies =  sessionStorage.getItem("access_token");
     var org_cookies =   sessionStorage.getItem("org_id");

     // var access_cookies = $('#access_token').val();   

    if (refresh_cookies == null || access_cookies == '' || org_cookies == null ) {
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
       var group_cookies =   sessionStorage.getItem("group_id");
        // var access_cookies = $('#access_token').val();
           $('#group_id').val(group_cookies);
            $('#org_id').val(org_cookies);            
            $("#refresh_token").val(refresh_cookies);
            $("#access_token").val(access_cookies);

            sessionStorage.setItem("refresh_token",refresh_cookies);
            sessionStorage.setItem("access_token",access_cookies);
            sessionStorage.setItem("org_id",org_cookies);
			sessionStorage.setItem("group_id",group_cookies);
           // setpanelvalue(group_cookies);
           
          //   setCookie('refresh_token', refresh_cookies, 3);
          // //  setCookie('access_token', access_cookies, 3);
          //   setCookie('org_id', org_cookies, 3);

            loadbrick();
            energybrick();
            alertbrick();
            offlinebrick();
            parameter_graph_widget(1);
            energydistributionwidget2();
            energydistributionwidget1();
            energytrendwidget('daily',1);
            getrecentactivities();
            expensebrick();
         //   getdevicelist();
            mapwidget();
           
            // apilogin();

    } 
  }
  
  function getEnergyTrend(format,key){
      energytrendwidget(format,key);
  }
   
   function getElectricalParameter(key){
       parameter_graph_widget(key);
   }
   
</script>

 <script src="https://maps.google.com/maps/api/js?key=AIzaSyCYJLYaSvIyWhvHv4Jxu2z5vbXM_Ys0nck&sensor=false&callback=initMap"" type="text/javascript" async></script>

 <script type="text/javascript">
   function initMap(){
    var locations = [
       ['Default', 28.616318966813253, 77.20948395138142, 1]
    ];

    var map = new google.maps.Map(document.getElementById('map'), {
      zoom: 10,
      center: new google.maps.LatLng(28.616318966813253, 77.20948395138142),
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
   }
  </script>

  <script>
    
    $( document ).ready(function() { debugger;
      onload();
     
    });

  </script>
  
	
        
        @stop