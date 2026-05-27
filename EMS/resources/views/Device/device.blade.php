@extends('layout.layout')

@section('content')
<!-- <link rel="stylesheet" href="//cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css"> -->
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.0.0/css/buttons.dataTables.min.css">
<script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>


<div class="main-panel" >
        <div class="content-wrapper">
          <div class="page-header">
            <h3 class="page-title">
             Devices
            </h3>
            <nav aria-label="breadcrumb">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Devices</a></li>
                <li class="breadcrumb-item active" aria-current="page">Devices</li>
              </ol>
            </nav>
          </div>
          <div class="card" id="">
            <div class="card-body">
              <h4 class="card-title">Devices</h4>
              <div class="row">
                <div class="col-12" >
                  <div class="table-responsive" id="table-device">
                    <table id="order-listing" class="table">
                      <thead>
                         <tr>
                            
                            <th>#</th>
                            <th>Device Name</th>
                            <th>Serial No.</th>
                            <th>Data</th>
                            <th>Relay 1</th>
                            <th>Relay 2</th>
                            <th>Relay 3</th>
                            <th>Relay 4</th>
                            <th>Relay 5</th>
                            <th>Last Online</th>
                        </tr>
                      </thead>
                      <tbody id="paneldeviceList">
                         
                      </tbody>
                      <tfoot id="table_foot"></tfoot>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
<!-- modal start-->
<div class="modal fade" id="logmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog " role="document">
        <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title" id="exampleModalLabel">Configure</h5>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
            <div class="modal-body">
                <div class="modal demo-modal">
                    <div class="modal-dialog">
                      <div class="modal-content">
                       
                        <div class="modal-body">
                      
                  <ul class="nav nav-pills nav-pills-success" id="pills-tab" role="tablist">
                    <li class="nav-item">
                      <a class="nav-link active" id="pills-devices-tab" data-toggle="pill" href="#pills-devices" role="tab" aria-controls="pills-home" aria-selected="true">Devices</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" id="pills-alerts-tab" data-toggle="pill" href="#pills-alerts" role="tab" aria-controls="pills-alerts" aria-selected="false">Alerts</a>
                    </li>
                  </ul>

                  <div class="tab-content" id="pills-tabContent">
				  
            <div class="tab-pane fade show active" id="pills-devices" role="tabpanel" aria-labelledby="pills-devices-tab">
                <form class="forms-sample">
					<div class="form-group">
                      <label for="exampleInputUsername1">Device name</label>
                      <input type="text" class="form-control" id="exampleInputUsername1" placeholder="Username">
                    </div>
					
                    <div class="form-group">
                      <label for="exampleInputEmail1">Zone</label>
                      <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Email">
                    </div>
					
                    <div class="form-group">
                      <label for="exampleInputPassword1">Timezone</label>
                        <select id="timezone" class="form-control">
                             <option value="Etc/GMT+12">(GMT-12:00) International Date Line West</option>
                             <option value="Pacific/Midway">(GMT-11:00) Midway Island, Samoa</option>
                             <option value="Pacific/Honolulu">(GMT-10:00) Hawaii</option>
                             <option value="US/Alaska">(GMT-09:00) Alaska</option>
                             <option value="America/Los_Angeles">(GMT-08:00) Pacific Time (US & Canada)</option>
                             <option value="America/Tijuana">(GMT-08:00) Tijuana, Baja California</option>
                             <option value="US/Arizona">(GMT-07:00) Arizona</option>
                             <option value="America/Chihuahua">(GMT-07:00) Chihuahua, La Paz, Mazatlan</option>
                             <option value="US/Mountain">(GMT-07:00) Mountain Time (US & Canada)</option>
                             <option value="America/Managua">(GMT-06:00) Central America</option>
                             <option value="US/Central">(GMT-06:00) Central Time (US & Canada)</option>
                             <option value="America/Mexico_City">(GMT-06:00) Guadalajara, Mexico City, Monterrey</option>
                             <option value="Canada/Saskatchewan">(GMT-06:00) Saskatchewan</option>
                             <option value="America/Bogota">(GMT-05:00) Bogota, Lima, Quito, Rio Branco</option>
                             <option value="US/Eastern">(GMT-05:00) Eastern Time (US & Canada)</option>
                             <option value="US/East-Indiana">(GMT-05:00) Indiana (East)</option>
                             <option value="Canada/Atlantic">(GMT-04:00) Atlantic Time (Canada)</option>
                             <option value="America/Caracas">(GMT-04:00) Caracas, La Paz</option>
                             <option value="America/Manaus">(GMT-04:00) Manaus</option>
                             <option value="America/Santiago">(GMT-04:00) Santiago</option>
                             <option value="Canada/Newfoundland">(GMT-03:30) Newfoundland</option>
                             <option value="America/Sao_Paulo">(GMT-03:00) Brasilia</option>
                             <option value="America/Argentina/Buenos_Aires">(GMT-03:00) Buenos Aires, Georgetown</option>
                             <option value="America/Godthab">(GMT-03:00) Greenland</option>
                             <option value="America/Montevideo">(GMT-03:00) Montevideo</option>
                             <option value="America/Noronha">(GMT-02:00) Mid-Atlantic</option>
                             <option value="Atlantic/Cape_Verde">(GMT-01:00) Cape Verde Is.</option>
                             <option value="Atlantic/Azores">(GMT-01:00) Azores</option>
                             <option value="Africa/Casablanca">(GMT+00:00) Casablanca, Monrovia, Reykjavik</option>
                             <option value="Etc/Greenwich">(GMT+00:00) Greenwich Mean Time : Dublin, Edinburgh, Lisbon, London</option>
                             <option value="Europe/Amsterdam">(GMT+01:00) Amsterdam, Berlin, Bern, Rome, Stockholm, Vienna</option>
                             <option value="Europe/Belgrade">(GMT+01:00) Belgrade, Bratislava, Budapest, Ljubljana, Prague</option>
                             <option value="Europe/Brussels">(GMT+01:00) Brussels, Copenhagen, Madrid, Paris</option>
                             <option value="Europe/Sarajevo">(GMT+01:00) Sarajevo, Skopje, Warsaw, Zagreb</option>
                             <option value="Africa/Lagos">(GMT+01:00) West Central Africa</option>
                             <option value="Asia/Amman">(GMT+02:00) Amman</option>
                             <option value="Europe/Athens">(GMT+02:00) Athens, Bucharest, Istanbul</option>
                             <option value="Asia/Beirut">(GMT+02:00) Beirut</option>
                             <option value="Africa/Cairo">(GMT+02:00) Cairo</option>
                             <option value="Africa/Harare">(GMT+02:00) Harare, Pretoria</option>
                             <option value="Europe/Helsinki">(GMT+02:00) Helsinki, Kyiv, Riga, Sofia, Tallinn, Vilnius</option>
                             <option value="Asia/Jerusalem">(GMT+02:00) Jerusalem</option>
                             <option value="Europe/Minsk">(GMT+02:00) Minsk</option>
                             <option value="Africa/Windhoek">(GMT+02:00) Windhoek</option>
                             <option value="Asia/Kuwait">(GMT+03:00) Kuwait, Riyadh, Baghdad</option>
                             <option value="Europe/Moscow">(GMT+03:00) Moscow, St. Petersburg, Volgograd</option>
                             <option value="Africa/Nairobi">(GMT+03:00) Nairobi</option>
                             <option value="Asia/Tbilisi">(GMT+03:00) Tbilisi</option>
                             <option value="Asia/Tehran">(GMT+03:30) Tehran</option>
                             <option value="Asia/Muscat">(GMT+04:00) Abu Dhabi, Muscat</option>
                             <option value="Asia/Baku">(GMT+04:00) Baku</option>
                             <option value="Asia/Yerevan">(GMT+04:00) Yerevan</option>
                             <option value="Asia/Kabul">(GMT+04:30) Kabul</option>
                             <option value="Asia/Yekaterinburg">(GMT+05:00) Yekaterinburg</option>
                             <option value="Asia/Karachi">(GMT+05:00) Islamabad, Karachi, Tashkent</option>
                             <option value="Asia/Calcutta">(GMT+05:30) Chennai, Kolkata, Mumbai, New Delhi</option>
                             <option value="Asia/Calcutta">(GMT+05:30) Sri Jayawardenapura</option>
                             <option value="Asia/Katmandu">(GMT+05:45) Kathmandu</option>
                             <option value="Asia/Almaty">(GMT+06:00) Almaty, Novosibirsk</option>
                             <option value="Asia/Dhaka">(GMT+06:00) Astana, Dhaka</option>
                             <option value="Asia/Rangoon">(GMT+06:30) Yangon (Rangoon)</option>
                             <option value="Asia/Bangkok">(GMT+07:00) Bangkok, Hanoi, Jakarta</option>
                             <option value="Asia/Krasnoyarsk">(GMT+07:00) Krasnoyarsk</option>
                             <option value="Asia/Hong_Kong">(GMT+08:00) Beijing, Chongqing, Hong Kong, Urumqi</option>
                             <option value="Asia/Kuala_Lumpur">(GMT+08:00) Kuala Lumpur, Singapore</option>
                             <option value="Asia/Irkutsk">(GMT+08:00) Irkutsk, Ulaan Bataar</option>
                             <option value="Australia/Perth">(GMT+08:00) Perth</option>
                             <option value="Asia/Taipei">(GMT+08:00) Taipei</option>
                             <option value="Asia/Tokyo">(GMT+09:00) Osaka, Sapporo, Tokyo</option>
                             <option value="Asia/Seoul">(GMT+09:00) Seoul</option>
                             <option value="Asia/Yakutsk">(GMT+09:00) Yakutsk</option>
                             <option value="Australia/Adelaide">(GMT+09:30) Adelaide</option>
                             <option value="Australia/Darwin">(GMT+09:30) Darwin</option>
                             <option value="Australia/Brisbane">(GMT+10:00) Brisbane</option>
                             <option value="Australia/Canberra">(GMT+10:00) Canberra, Melbourne, Sydney</option>
                             <option value="Australia/Hobart">(GMT+10:00) Hobart</option>
                             <option value="Pacific/Guam">(GMT+10:00) Guam, Port Moresby</option>
                             <option value="Asia/Vladivostok">(GMT+10:00) Vladivostok</option>
                             <option value="Asia/Magadan">(GMT+11:00) Magadan, Solomon Is., New Caledonia</option>
                             <option value="Pacific/Auckland">(GMT+12:00) Auckland, Wellington</option>
                             <option value="Pacific/Fiji">(GMT+12:00) Fiji, Kamchatka, Marshall Is.</option>
                             <option value="Pacific/Tongatapu">(GMT+13:00) Nuku'alofa</option>
                        </select>
                    </div>
					
                    <div class="form-group">
                      <label for="exampleInputConfirmPassword1">Latitude</label>
                      <input type="text" class="form-control" id="exampleInputConfirmPassword1" placeholder="Password">
                    </div>
					
                    <div class="form-group">
                      <label for="exampleInputPassword1">Longitude</label>
                      <input type="text" class="form-control" id="exampleInputPassword1" placeholder="Password">
                    </div>
					
                    <div class="form-group">
                      <label for="exampleInputPassword1">Device Label</label>
                      <input type="text" class="form-control" id="exampleInputPassword1" placeholder="Password">
                    </div>
					
                    <div class="form-group">
                      <label for="exampleInputPassword1">Phase Type</label>
                      <div class="form-check">
                            <label class="form-check-label">
                            <input type="radio" class="form-check-input" name="optionsRadios" id="optionsRadios1" value="">
                              Single Phase
                            </label>
                          </div>
                          <div class="form-check">
                            <label class="form-check-label">
                            <input type="radio" class="form-check-input" name="optionsRadios" id="optionsRadios1" value="">
                              Three Phase
                            </label>
                          </div>
                    </div>
					
                    <div class="form-group">
                      <label for="exampleInputPassword1">Relay 1 Name</label>
                      <input type="text" class="form-control" id="exampleInputPassword1" placeholder="Password">
                    </div>
					
                    <div class="form-group">
                      <label for="exampleInputPassword1">Relay 2 Name</label>
                      <input type="text" class="form-control" id="exampleInputPassword1" placeholder="Password">
                    </div>
					
                    <div class="form-group">
                      <label for="exampleInputPassword1">Relay 3 Name</label>
                      <input type="text" class="form-control" id="exampleInputPassword1" placeholder="Password">
                    </div>
					
                    <div class="form-group">
                      <label for="exampleInputPassword1">Relay 4 Name</label>
                      <input type="text" class="form-control" id="exampleInputPassword1" placeholder="Password">
                    </div>
					
                    <div class="form-group">
                      <label for="Relay 5 Name">Relay 5 Name</label>
                      <input type="text" class="form-control" id="exampleInputPassword1" placeholder="Password">
                    </div>
					
                </form>
            </div>
					
            <div class="tab-pane fade" id="pills-alerts" role="tabpanel" aria-labelledby="pills-alerts-tab">
                <form class="forms-sample">
                               					
                    <div class="form-group">
                      <label for="EnergyBaseline">Energy Baseline</label>
                      <input type="number" class="form-control" id="EnergyBaseline">
                    </div>
					
                    <div class="form-group">
                      <label for="alertcalibration">Alert Calibration</label> <br>
                      <button type="submit" class="btn btn-outline-dark btn-fw">Calibrate</button>
                    </div>

                </form>
                    
            </div>
 
              </div>
 
          
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
<!--modal end-->

<div class="modal fade bd-example-modal-lg" id="exampleModal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title" id="exampleModalLabel">Data</h5>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
            <div class="modal-body">
                <div class="modal demo-modal">
                    <div class="modal-dialog modal-lg">
                      <div class="modal-content">
                       
                       

                  <ul class="nav nav-pills nav-pills-success" id="pills-tab" role="tablist">
                    <li class="nav-item">
                      <a class="nav-link active" id="pills-electricty-tab" data-toggle="pill" href="#pills-electricity" role="tab" aria-controls="pills-sensor" aria-selected="true">Electricity Lights</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" id="pills-sensor-tab" data-toggle="pill" href="#pills-sensor" role="tab" aria-controls="pills-sensor" aria-selected="false">Sensor</a>
                    </li>
                    
                  </ul>

                  <div class="tab-content" id="pills-tabContent">
				  <!-- 1 start -->
            <div class="tab-pane fade show active" id="pills-electricity" role="tabpanel" aria-labelledby="pills-electricity-tab">
                <form class="forms-sample">
                <div class="col-lg-12 grid-margin stretch-card">
              
                <div class="card-body" id="paneldevicelist">
                  <div class="table-responsive">
                    <table class="table table">
                      <thead>
                        <tr>
                          <th>
                            Parameter
                          </th>
                          <th>
                            R phase
                          </th>
                          <th>
                            Y phase
                          </th>
                          <th>
                            B phase
                          </th>
                          
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                          <th>
                            Voltage(V)
                          </th>
                          <td>
                          <input type="number" class="form-control" id="r_v" readonly>
                          </td>
                          <td>
                          <input type="number" class="form-control" id="y_v" readonly>

                          </td>
                          <td>
                          <input type="number" class="form-control" id="b_v" readonly>
                          </td>
                          
                        </tr>

                        <tr>
                        <th>
                            Current(A)
                          </th>
                          <td>
                          <input type="number" class="form-control" id="r_real_kw" readonly>
                          </td>
                          <td>
                          <input type="number" class="form-control" id="y_real_kw" readonly>

                          </td>
                          <td>
                          <input type="number" class="form-control" id="b_real_kw" readonly>
                          </td>
                          
                        </tr>
                        <tr>
                        <th>
                            Load(W)
                          </th>
                          <td>
                          <input type="number" class="form-control" id="r_real_kwh" readonly>
                          </td>
                          <td>
                          <input type="number" class="form-control" id="y_real_kwh" readonly>

                          </td>
                          <td>
                          <input type="number" class="form-control" id="b_real_kwh" readonly>
                          </td>
                          
                        </tr>
                        <tr>
                        <th>
                            PF
                          </th>
                          <td>
                          <input type="number" class="form-control" id="r_pf" readonly>
                          </td>
                          <td>
                          <input type="number" class="form-control" id="y_pf" readonly>
                          </td>
                          <td>
                          <input type="number" class="form-control" id="b_pf" readonly>
                          </td>
                          
                        </tr>
                        <tr>
                        <th>
                            Frequency(Hz)
                          </th>
                          <td>
                          <input type="number" class="form-control" id="fr" readonly>
                          </td>
                                                  
                        </tr>
                        <tr>
                        <th>
                            Energy(kWh)
                          </th>
                          <td>
                          <input type="number" class="form-control" id="real_kwh" readonly>
                          </td>
                                                    
                        </tr>
                        <tr>
                        <th>
                            Door Status(V)
                          </th>
                          <td>
                          <input type="text" class="form-control" readonly id="input_status">
                          </td>
                                                   
                        </tr>
                        <tr>
                        <th>
                            UPS Voltage
                          </th>
                          <td>
                          <input type="text" class="form-control" id="ups_status" readonly>
                          </td>
                                                    
                        </tr>
                        <tr>
                        <th>
                            Time
                          </th>
                          <td>
                          <input type="text" readonly class="form-control" id="tm_stamp">
                          </td>
                                                    
                        </tr>
                      </tbody>
                    </table>
                  
                </div>
              </div>
            </div>
                </form>
            </div>
					<!-- 1 end -->
					<!-- 2 start -->
                    <div class="tab-pane fade" id="pills-sensor" role="tabpanel" aria-labelledby="pills-sensor-tab">
                     <form class="forms-sample">
                               					
                     <div class="col-lg-12 grid-margin stretch-card">
                <div class="card-body">
                  <div class="table-responsive">
                    <table class="table table-bordered">
                      <thead>
                        <tr>
                          <th>
                            Parameter
                          </th>
                          <th>
                            Values
                          </th>
                          
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                          <th>
                            Temperature(°C)
                          </th>
                          <td>
                          <input type="text" class="form-control" id="temp" readonly>

                          </td>
                                                  
                        </tr>

                        <tr>
                        <th>
                            Humidity(%)
                          </th>
                          <td>
                          <input type="text" class="form-control" id="hum" readonly>
                          </td>
                          
                        </tr>
                        <tr>
                        <th>
                            Earth Voltage(V)
                          </th>
                          <td>
                            <input type="text" class="form-control" id="e_v" readonly>
                          </td>
                        </tr>
                        
                        <tr>
                        <th>
                            Accessory Current(A)
                          </th>
                          <td>
                            <input type="text" class="form-control" id="acc_c" readonly>
                          </td>
                        </tr>
                      </tbody>
                    </table>
                </div>
              </div>
            </div>
                    
					
                    </form>
                    
                    </div>
                    <!-- 2 end -->
                    
                  </div>
                
              </div>
</div>
 
          
                        </div>
                        <div class="modal-footer">
                         <!-- <button type="button" class="btn btn-warning" data-redo="modal">Reset</button>
                          <button type="button" class="btn btn-success">Submit</button>
                          <button type="button" class="btn btn-light" data-dismiss="modal">Cancel</button> -->
                        </div>
                      </div>
                    </div>
		
	</div>
</div>

  <script src="{{url('assets/js/ems_api.js')}}"></script>
  <script src="{{url('assets/js/ems_api_device.js')}}"></script>
  
  <script>
      $( document ).ready(function() { //debugger;;
    onloaddevice(); 
    });
  </script>

<!-- <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.4.1/css/buttons.dataTables.min.css">
<script type="text/javascript" language="javascript" src="https://cdn.datatables.net/buttons/1.4.1/js/dataTables.buttons.min.js"></script>
<script type="text/javascript" language="javascript" src="https://cdn.datatables.net/buttons/1.4.1/js/buttons.flash.min.js"></script>
<script type="text/javascript" language="javascript" src="https://cdn.datatables.net/buttons/1.4.1/js/buttons.html5.min.js"></script>
<script type="text/javascript" language="javascript" src="https://cdn.datatables.net/buttons/1.4.1/js/buttons.print.min.js"></script>
 -->

 

 <script type="text/javascript" language="javascript" src="https://cdn.datatables.net/buttons/1.4.1/js/dataTables.buttons.min.js"></script>
<script type="text/javascript" language="javascript" src="https://cdn.datatables.net/buttons/1.4.1/js/buttons.flash.min.js"></script>
<script type="text/javascript" language="javascript" src="https://cdn.datatables.net/buttons/1.4.1/js/buttons.html5.min.js"></script>
<script type="text/javascript" language="javascript" src="https://cdn.datatables.net/buttons/1.4.1/js/buttons.print.min.js"></script>
<script type="text/javascript" language="javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script type="text/javascript" language="javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script type="text/javascript" language="javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>

  <script>
$(document).ready(function() {
        $('#order-listing').DataTable( {
            dom: 'Bfrtip',
            buttons: [
    'copyHtml5', 'excelHtml5', 'pdfHtml5', 'csvHtml5'
  ],
            'columnDefs': [
         {
            'targets': 0,
            'checkboxes': {
               'selectRow': true
            }
         }
      ],
      'select': {
         'style': 'multi'
      },
      'order': [[1, 'asc']]
        } );
    } );
      </script>
      
            
@stop

