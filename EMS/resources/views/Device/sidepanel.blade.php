@extends('layout.layout')

@section('content')
<div class="col-md-6 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Configure</h4>

                  <ul class="nav nav-pills nav-pills-success" id="pills-tab" role="tablist">
                    <li class="nav-item">
                      <a class="nav-link active" id="pills-devices-tab" data-toggle="pill" href="#pills-devices" role="tab" aria-controls="pills-home" aria-selected="true">Devices</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" id="pills-alerts-tab" data-toggle="pill" href="#pills-alerts" role="tab" aria-controls="pills-alerts" aria-selected="false">Alerts</a>
                    </li>
                  </ul>

                  <div class="tab-content" id="pills-tabContent">
				  <!-- 1 start -->
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
                      <!-- <input type="timezone" id="timezone" class="form-control" id="exampleInputPassword1" placeholder="Password"> -->
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
					<!-- 1 end -->
					<!-- 2 start -->
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
					
                    <div class="form-group">
                    <label for="relay5">Alert Rules</label>
                    <div class="card">
                    <div class="card-body">
                    <div class="list-wrapper">
						<ul class="d-flex flex-column todo-list">
						    <li>
							    <div class="form-check">
								    <label class="form-check-label">
									    <input class="checkbox" type="checkbox">
                                        Device Connectivity unavailable for 4 hours during Operational hours 
								    </label>
							    </div>
                            </li>
                            <li>
							<div class="form-check">
								<label class="form-check-label">
									<input class="checkbox" type="checkbox">
                                    Input Supply unavailable for 5 mins during Operational hours 
								</label>
							</div>
                        </li>
                        <li>
							<div class="form-check">
								<label class="form-check-label">
									<input class="checkbox" type="checkbox">
                                    Load is Above 10 % of Calibration in All R,Y,B phase for 3 mins during Non-Operational hours 
								</label>
							</div>
                        </li>
                        <li>
							<div class="form-check">
								<label class="form-check-label">
									<input class="checkbox" type="checkbox">
                                    Load is Above 10 % of Calibration in Any R,Y,B phase for 60 mins during Operational hours 
								</label>
							</div>
                        </li>
                        <li>
							<div class="form-check">
								<label class="form-check-label">
									<input class="checkbox" type="checkbox">
                                    Load is Below 10 % of Calibration in Any R,Y,B phase for 60 mins during Operational hours 
								</label>
							</div>
                        </li>
                        <li>
							<div class="form-check">
								<label class="form-check-label">
									<input class="checkbox" type="checkbox">
                                    Load is Below 80 % of Calibration in Any R,Y,B phase for 15 mins during Operational hours 
								</label>
							</div>
                        </li>
                        <li>
							<div class="form-check">
								<label class="form-check-label">
									<input class="checkbox" type="checkbox">
                                    Power Factor is Below 0.9 in Any R,Y,B phase for 60 mins during Operational hours 
								</label>
							</div>
                        </li>
                        <li>
							<div class="form-check">
								<label class="form-check-label">
									<input class="checkbox" type="checkbox">
                                    Relay On in Instant Mode for 60 mins during Entire day 
								</label>
							</div>
                        </li>
                        <li>
							<div class="form-check">
								<label class="form-check-label">
									<input class="checkbox" type="checkbox">
                                    Relay On/Off Events  during Entire day  
								</label>
							</div>
                        </li>
                        <li>
							<div class="form-check">
								<label class="form-check-label">
									<input class="checkbox" type="checkbox">
                                    Voltage is Above 300 V in Any R,Y,B phase for 3 mins during Operational hours  
								</label>
							</div>
                        </li>
                        <li>
							<div class="form-check">
								<label class="form-check-label">
									<input class="checkbox" type="checkbox">
                                    Voltage is Below 190 V in Any R,Y,B phase for 3 mins during Operational hours 
								</label>
							</div>
                        </li>
                        <li>
							<div class="form-check">
								<label class="form-check-label">
									<input class="checkbox" type="checkbox">
                                    Voltage is Equal to 0 V in Any R,Y,B phase for 3 mins during Operational hours  
								</label>
							</div>
                        </li>
                        <li>
							<div class="form-check">
								<label class="form-check-label">
									<input class="checkbox" type="checkbox">
                                    Active Energy is Above 10  kWh  
								</label>
							</div>
                        </li>
                        <li>
							<div class="form-check">
								<label class="form-check-label">
									<input class="checkbox" type="checkbox">
                                    Current is Above 5 % of Calibration in Only Y phase for 5 mins during Operational hours 								</label>
							</div>
                        </li>
                        <li>
							<div class="form-check">
								<label class="form-check-label">
									<input class="checkbox" type="checkbox">
                                    Device Connectivity unavailable for 3 mins during Entire day 								</label>
							</div>
                        </li>
                        <li>
							<div class="form-check">
								<label class="form-check-label">
									<input class="checkbox" type="checkbox">
                                    Door is Open for 3 mins during Entire day 	
                            </div>
                        </li>
                        <li>
							<div class="form-check">
								<label class="form-check-label">
									<input class="checkbox" type="checkbox">
                                    Earth Voltage is Above 7 V for 3 mins during Entire day 	
                            </div>
                        </li>
                        <li>
							<div class="form-check">
								<label class="form-check-label">
									<input class="checkbox" type="checkbox">
                                    Earth Voltage is Below 3 V for 3 mins during Entire day 	
                            </div>
                        </li>
                        <li>
							<div class="form-check">
								<label class="form-check-label">
									<input class="checkbox" type="checkbox">
                                    Temperature is Above 20 ℃ for 3 mins during Entire day 	
                            </div>
                        </li>
                        <li>
							<div class="form-check">
								<label class="form-check-label">
									<input class="checkbox" type="checkbox">
                                    Voltage is Above 180 V in Any R,Y,B phase for 3 mins during Entire day 	
                            </div>
                        </li>
                        <li>
							<div class="form-check">
								<label class="form-check-label">
									<input class="checkbox" type="checkbox">
                                    Voltage is Above 250 V in Any R,Y,B phase for 3 mins during Entire day 
                            </div>
                        </li>
						</ul>
                    </div>
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


@stop