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

</style>
 
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
                    <li class="nav-item" >
                      <a class="nav-link active" id="home-tab6" data-toggle="tab" href="#home-6" role="tab" aria-controls="home-6" aria-selected="true">Power</a>
                    </li>
                    <li class="nav-item" >
                      <a class="nav-link" id="home-tab7" data-toggle="tab" href="#home-7" role="tab" aria-controls="home-7" aria-selected="true">Voltage</a>
                    </li>
                    <li class="nav-item" >
                      <a class="nav-link" id="home-tab8" data-toggle="tab" href="#home-8" role="tab" aria-controls="home-8" aria-selected="true">Current</a>
                    </li>
                    <li class="nav-item" >
                      <a class="nav-link" id="home-tab9" data-toggle="tab" href="#home-9" role="tab" aria-controls="home-9" aria-selected="true">Power Factor</a>
                    </li>
                    <li class="nav-item" >
                      <a class="nav-link" id="home-tab10" data-toggle="tab" href="#home-10" role="tab" aria-controls="home-10" aria-selected="true">Temperature</a>
                    </li>
                    <li class="nav-item" >
                      <a class="nav-link" id="home-tab11" data-toggle="tab" href="#home-11" role="tab" aria-controls="home-11" aria-selected="true">UPS Status</a>
                    </li>
                    <li class="nav-item" >
                      <a class="nav-link" id="home-tab12" data-toggle="tab" href="#home-12" role="tab" aria-controls="home-12" aria-selected="true">Accessory Current</a>
                    </li>
                  </ul>
                  <div class="tab-content">
                    <div class="tab-pane fade show active" id="home-6" role="tabpanel" aria-labelledby="home-tab6" >
                      <div id="morris-line-1" style="height: 300px; width: 100%;"></div>                   
                    </div>
                    <div class="tab-pane fade" id="home-7" role="tabpanel" aria-labelledby="home-tab7" >
                      <div id="morris-line-2" style="height: 300px; width: 100%;"></div>                   
                    </div>
                    <div class="tab-pane fade" id="home-8" role="tabpanel" aria-labelledby="home-tab8" >
                      <div id="morris-line-3" style="height: 300px; width: 100%;"></div>                   
                    </div>
                    <div class="tab-pane fade" id="home-9" role="tabpanel" aria-labelledby="home-tab9" >
                      <div id="morris-line-4" style="height: 300px; width: 100%;"></div>                   
                    </div>
                    <div class="tab-pane fade" id="home-10" role="tabpanel" aria-labelledby="home-tab10" >
                      <!--<div id="morris-line-5" style="height: 300px; width: 100%;"></div>   -->
                      <canvas id="morris-line-5" width="400" height="400"></canvas>
                    </div>
                    <div class="tab-pane fade" id="home-11" role="tabpanel" aria-labelledby="home-tab11" >
                      <div id="morris-line-6" style="height: 300px; width: 100%;"></div>                   
                    </div>
                    <div class="tab-pane fade" id="home-12" role="tabpanel" aria-labelledby="home-tab12" >
                      <div id="morris-line-7" style="height: 300px; width: 100%;"></div>                   
                    </div>
                  </div>
                </div>
              </div>
            </div>
            </div>
            
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
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <script src="{{url('assets/js/ems_api.js')}}"></script>
        <script>
var ctx = document.getElementById('morris-line-5').getContext('2d');
    var myChart = new Chart(ctx, {
    type: 'line',
    data: {
        labels: ['Red', 'Blue', 'Yellow', 'Green', 'Purple', 'Orange'],
        datasets: [{
            label: ['# of Votes','label'],
            data: [12, 19, 3, 5, 2, 3],
            backgroundColor: [
                'rgba(255, 99, 132, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(255, 206, 86, 0.2)',
                'rgba(75, 192, 192, 0.2)',
                'rgba(153, 102, 255, 0.2)',
                'rgba(255, 159, 64, 0.2)'
            ],
            borderColor: [
                'rgba(255, 99, 132, 1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(75, 192, 192, 1)',
                'rgba(153, 102, 255, 1)',
                'rgba(255, 159, 64, 1)'
            ],
            borderWidth: 1
        }]
    },
    options: {
        scales: {
            y: {
                beginAtZero: true
            }
        }
    }
});

  
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

        // var access_cookies = $('#access_token').val();


        


            $('#org_id').val(org_cookies);            
            $("#refresh_token").val(refresh_cookies);
            $("#access_token").val(access_cookies);

            sessionStorage.setItem("refresh_token",refresh_cookies);
            sessionStorage.setItem("access_token",access_cookies);
            sessionStorage.setItem("org_id",org_cookies);

           
          //   setCookie('refresh_token', refresh_cookies, 3);
          // //  setCookie('access_token', access_cookies, 3);
          //   setCookie('org_id', org_cookies, 3);

            loadbrick();
            energybrick();
            alertbrick();
            offlinebrick();
            energydistributionwidget2();
            energydistributionwidget1();
            energytrendwidget('daily',1);
            getrecentactivities();
            expensebrick();
            getdevicelist();
            mapwidget();
            parameter_graph_widget();
            // apilogin();

    } 
  }
  
  function getEnergyTrend(format,key){
      energytrendwidget(format,key);
  }

</script>

 <script src="https://maps.google.com/maps/api/js?sensor=false" 
          type="text/javascript"></script>

 <script type="text/javascript">
    var locations = [
      ['Bondi Beach', -33.890542, 151.274856, 4],
      ['Coogee Beach', -33.923036, 151.259052, 5],
      ['Cronulla Beach', -34.028249, 151.157507, 3],
      ['Manly Beach', -33.80010128657071, 151.28747820854187, 2],
      ['Maroubra Beach', -33.950198, 151.259302, 1]
    ];

    var map = new google.maps.Map(document.getElementById('map'), {
      zoom: 10,
      center: new google.maps.LatLng(-33.92, 151.25),
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
  </script>

  <script>
    var morrisLine;
    
    
      
    $( document ).ready(function() { debugger;
     
      
      morrisLine = Morris.Line({
        element: 'morris-line-3',
        xkey: 'y',
        ykeys: ['a', 'b','c','d'],
        labels: ['R', 'B','Y','Total'],
        xLabelAngle: 60,
        parseTime: false,
        resize: true,
        lineColors: ['#63CF72', '#F36368', '#76C1FA', '#FABA66','#3f51b5','#00bcd4']
      });
       onload();
  /*
    Morris.Line({
      element: 'morris-line-1',
      lineColors: ['#63CF72', '#F36368', '#76C1FA', '#FABA66','#3f51b5','#00bcd4'],
      data: [{
          y: '1',
          a: 100,
          b: 150,
          c: 90
        },
        {
          y: '2',
          a: 75,
          b: 65,
          c: 90
        },
        {
          y: '3',
          a: 50,
          b: 40,
          c: 90
        },
        {
          y: '4',
          a: 75,
          b: 65,
          c: 90
        },
        {
          y: '5',
          a: 50,
          b: 40,
          c: 90
        },
        {
          y: '6',
          a: 75,
          b: 65,
          c: 90
        },
        {
          y: '7',
          a: 100,
          b: 90,
          c: 90
        },
        {
          y: '8',
          a: 50,
          b: 40,
          c: 90
        },
        {
          y: '9',
          a: 75,
          b: 65,
          c: 90
        },
        {
          y: '10',
          a: 100,
          b: 90,
          c: 90
        },
        {
          y: '11',
          a: 50,
          b: 40,
          c: 90
        },
        {
          y: '12',
          a: 75,
          b: 65,
          c: 90
        },
        {
          y: '13',
          a: 100,
          b: 90,
          c: 90
        },
        {
          y: '14',
          a: 50,
          b: 40,
          c: 90
        },
        {
          y: '15',
          a: 75,
          b: 65,
          c: 90
        },
        {
          y: '16',
          a: 100,
          b: 90,
          c: 90
        },
        {
          y: '17',
          a: 50,
          b: 40,
          c: 90
        },
        {
          y: '18',
          a: 75,
          b: 65,
          c: 90
        },
        {
          y: '19',
          a: 100,
          b: 90,
          c: 90
        },
        {
          y: '20',
          a: 50,
          b: 40,
          c: 90
        },
        {
          y: '21',
          a: 75,
          b: 65,
          c: 90
        },
        {
          y: '22',
          a: 100,
          b: 90,
          c: 90
        },
        {
          y: '23',
          a: 50,
          b: 40,
          c: 90
        },
        {
          y: '24',
          a: 75,
          b: 65,
          c: 90
        },
        {
          y: '25',
          a: 100,
          b: 90,
          c: 90
        },
        {
          y: '26',
          a: 50,
          b: 40,
          c: 90
        },
        {
          y: '27',
          a: 75,
          b: 65,
          c: 90
        },
        {
          y: '28',
          a: 100,
          b: 90,
          c: 90
        },
        {
          y: '29',
          a: 50,
          b: 40,
          c: 90
        },
        {
          y: '30',
          a: 75,
          b: 65,
          c: 90
        },
        {
          y: '31',
          a: 100,
          b: 90,
          c: 90
        },
        {
          y: '32',
          a: 100,
          b: 90,
          c: 90
        },
        {
          y: '33',
          a: 100,
          b: 90,
          c: 90
        },
        {
          y: '34',
          a: 100,
          b: 90,
          c: 90
        },
        {
          y: '35',
          a: 100,
          b: 90,
          c: 90
        },
        {
          y: '36',
          a: 100,
          b: 90,
          c: 90
        },
        {
          y: '37',
          a: 100,
          b: 90,
          c: 90
        },
        {
          y: '38',
          a: 100,
          b: 90,
          c: 90
        },
        {
          y: '39',
          a: 100,
          b: 90,
          c: 90
        },
        {
          y: '40',
          a: 100,
          b: 90,
          c: 90
        },
        {
          y: '41',
          a: 100,
          b: 90,
          c: 90
        },
        {
          y: '50',
          a: 100,
          b: 90,
          c: 90 
        }
      ],
      xkey: 'y',
      ykeys: ['a', 'b','c'],
      labels: ['Series A', 'Series B','Series C']
    });  
    */
    
    Morris.Line({
      element: 'morris-line-2',
      lineColors: ['#63CF72', '#F36368', '#76C1FA', '#FABA66','#3f51b5','#00bcd4'],
      data: [{
          y: '1',
          a: 100,
          b: 150,
          c: 90
        },
        {
          y: '2',
          a: 75,
          b: 65,
          c: 90
        },
        {
          y: '3',
          a: 50,
          b: 40,
          c: 90
        },
        {
          y: '4',
          a: 75,
          b: 65,
          c: 90
        },
        {
          y: '5',
          a: 50,
          b: 40,
          c: 90
        },
        {
          y: '6',
          a: 75,
          b: 65,
          c: 90
        },
        {
          y: '7',
          a: 100,
          b: 90,
          c: 90
        },
        {
          y: '8',
          a: 50,
          b: 40,
          c: 90
        },
        {
          y: '9',
          a: 75,
          b: 65,
          c: 90
        },
        {
          y: '10',
          a: 100,
          b: 90,
          c: 90
        },
        {
          y: '11',
          a: 50,
          b: 40,
          c: 90
        },
        {
          y: '12',
          a: 75,
          b: 65,
          c: 90
        },
        {
          y: '13',
          a: 100,
          b: 90,
          c: 90
        },
        {
          y: '14',
          a: 50,
          b: 40,
          c: 90
        },
        {
          y: '15',
          a: 75,
          b: 65,
          c: 90
        },
        {
          y: '16',
          a: 100,
          b: 90,
          c: 90
        },
        {
          y: '17',
          a: 50,
          b: 40,
          c: 90
        },
        {
          y: '18',
          a: 75,
          b: 65,
          c: 90
        },
        {
          y: '19',
          a: 100,
          b: 90,
          c: 90
        },
        {
          y: '20',
          a: 50,
          b: 40,
          c: 90
        },
        {
          y: '21',
          a: 75,
          b: 65,
          c: 90
        },
        {
          y: '22',
          a: 100,
          b: 90,
          c: 90
        },
        {
          y: '23',
          a: 50,
          b: 40,
          c: 90
        },
        {
          y: '24',
          a: 75,
          b: 65,
          c: 90
        },
        {
          y: '25',
          a: 100,
          b: 90,
          c: 90
        },
        {
          y: '26',
          a: 50,
          b: 40,
          c: 90
        },
        {
          y: '27',
          a: 75,
          b: 65,
          c: 90
        },
        {
          y: '28',
          a: 100,
          b: 90,
          c: 90
        },
        {
          y: '29',
          a: 50,
          b: 40,
          c: 90
        },
        {
          y: '30',
          a: 75,
          b: 65,
          c: 90
        },
        {
          y: '31',
          a: 100,
          b: 90,
          c: 90
        },
        {
          y: '32',
          a: 100,
          b: 90,
          c: 90
        },
        {
          y: '33',
          a: 100,
          b: 90,
          c: 90
        },
        {
          y: '34',
          a: 100,
          b: 90,
          c: 90
        },
        {
          y: '35',
          a: 100,
          b: 90,
          c: 90
        },
        {
          y: '36',
          a: 100,
          b: 90,
          c: 90
        },
        {
          y: '37',
          a: 100,
          b: 90,
          c: 90
        },
        {
          y: '38',
          a: 100,
          b: 90,
          c: 90
        },
        {
          y: '39',
          a: 100,
          b: 90,
          c: 90
        },
        {
          y: '40',
          a: 100,
          b: 90,
          c: 90
        },
        {
          y: '41',
          a: 100,
          b: 90,
          c: 90
        }
      ],
      xkey: 'y',
      ykeys: ['a', 'b','c'],
      labels: ['Series A', 'Series B','Series C'],
      resize: true
    });  
    
  });

  </script>
        @stop