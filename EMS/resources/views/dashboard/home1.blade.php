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
 
<style>
	#timeToRender {
		position:absolute; 
		top: 10px; 
		font-size: 20px; 
		font-weight: bold; 
		background-color: #d85757;
		padding: 0px 4px;
		color: #ffffff;
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
                  <canvas id="map-with-marker"></canvas>
                  <!-- <div id="map-with-marker" class="map-with-marker"></div>                   -->
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
                      <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home-1" role="tab" aria-controls="home-1" aria-selected="true">Power</a>
                    </li>
                    
                  </ul>
                  <div class="tab-content">
                    <div class="tab-pane fade show active" id="home-1" role="tabpanel" aria-labelledby="home-tab" >
                    <div id="chartContainer" style="height: 300px; width: 100%;"></div>                   
                    </div>


                     <div class="tab-pane fade" id="home-1" role="tabpanel" aria-labelledby="home-tab" >
                     <div id="chartContainer" style="height: 300px; width: 100%;"></div>
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

                      <div class="card" >
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
                      </div>
                      
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
        <script src="{{url('assets/js/ems_api.js')}}"></script>
        <script>

    
  onload();
  function onload(){

    var refresh_cookies = getCookie('refresh_token');
    var access_cookies = getCookie('access_token');
    var org_cookies = getCookie('org_id');
    
   

    if (refresh_cookies == null || access_cookies == null || org_cookies == null ) {
        
      apilogin();
    }
    else
    {
        
        var refresh_cookies = getCookie('refresh_token');
        var access_cookies = getCookie('access_token');
        var org_cookies = getCookie('org_id');

        


            $('#org_id').val(org_cookies);            
            $("#refresh_token").val(refresh_cookies);
            $("#access_token").val(access_cookies);

           
            setCookie('refresh_token', refresh_cookies, 3);
            setCookie('access_token', access_cookies, 3);
            setCookie('org_id', org_cookies, 3);

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
            // apilogin();

    } 
  }
  
  function getEnergyTrend(format,key){
      energytrendwidget(format,key);
  }

</script>
        @stop