@extends('layout.layout')

@section('content')
<!-- <link rel="stylesheet" href="//cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css"> -->
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.0.0/css/buttons.dataTables.min.css">
<script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>


<div class="main-panel">
        <div class="content-wrapper">
          
          <div class="card">
            <div class="card-body">
              <h4 class="card-title">User
                <button type="button" class="btn btn-outline-secondary btn-icon btn-sm" style="float:right" data-toggle="modal" data-target="#exampleModal">
                    <i class="fas fa-plus text-dark"></i>                          
                </button>
              </h4>
              <div class="row">
                <div class="col-12">
                  <div class="table-responsive">
                    <table id="order-listing" class="table">
                      <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Role</th>
                            <th>Contact</th>
                            <th>Email</th>
                            <th>Settings</th>
                           
                           
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                            <td>1</td>
                            <td>Ashish D</td>
                            <td>Admin</td>
                            <td>New York</td>
                            <td>$1500</td>
                            <td>
                              <button type="button" class="btn btn-outline-secondary btn-icon btn-sm" data-toggle="modal" data-target="#exampleModal">
                                <i class="fas fa-cog text-dark"></i>                          
                              </button>
                            </td>
                            
                        </tr>
                        <tr>
                            <td>2</td>
                            <td>2015/04/01</td>
                            <td>Doe</td>
                            <td>Brazil</td>
                            <td>$4500</td>
                            <td>
                              <button type="button" class="btn btn-outline-secondary btn-icon btn-sm" data-toggle="modal" data-target="#exampleModal">
                                <i class="fas fa-cog text-dark"></i>                          
                              </button>
                            </td>
                        </tr>
                        <tr>
                            <td>3</td>
                            <td>2010/11/21</td>
                            <td>Sam</td>
                            <td>Tokyo</td>
                            <td>$2100</td>
                            <td>
                              <button type="button" class="btn btn-outline-secondary btn-icon btn-sm" data-toggle="modal" data-target="#exampleModal">
                                <i class="fas fa-cog text-dark"></i>                          
                              </button>
                            </td>
                        </tr>
                        <tr>
                            <td>4</td>
                            <td>2016/01/12</td>
                            <td>Sam</td>
                            <td>Tokyo</td>
                            <td>$2100</td>
                            <td>
                              <button type="button" class="btn btn-outline-secondary btn-icon btn-sm" data-toggle="modal" data-target="#exampleModal">
                                <i class="fas fa-cog text-dark"></i>                          
                              </button>
                            </td>
                        </tr>
                        <tr>
                            <td>5</td>
                            <td>2017/12/28</td>
                            <td>Sam</td>
                            <td>Tokyo</td>
                            <td>$2100</td>
                            <td>
                              <button type="button" class="btn btn-outline-secondary btn-icon btn-sm" data-toggle="modal" data-target="#exampleModal">
                                <i class="fas fa-cog text-dark"></i>                          
                              </button>
                            </td>
                        </tr>
                        <tr>
                            <td>6</td>
                            <td>2000/10/30</td>
                            <td>Sam</td>
                            <td>Tokyo</td>
                            <td>$2100</td>
                            <td>
                              <button type="button" class="btn btn-outline-secondary btn-icon btn-sm" data-toggle="modal" data-target="#exampleModal">
                                <i class="fas fa-cog text-dark"></i>                          
                              </button>
                            </td>
                        </tr>
                        <tr>
                            <td>7</td>
                            <td>2011/03/11</td>
                            <td>Cris</td>
                            <td>Tokyo</td>
                            <td>$2100</td>
                            <td>
                              <button type="button" class="btn btn-outline-secondary btn-icon btn-sm" data-toggle="modal" data-target="#exampleModal">
                                <i class="fas fa-cog text-dark"></i>                          
                              </button>
                            </td>
                        </tr>
                        <tr>
                            <td>8</td>
                            <td>2015/06/25</td>
                            <td>Tim</td>
                            <td>Italy</td>
                            <td>$6300</td>
                            <td>
                              <button type="button" class="btn btn-outline-secondary btn-icon btn-sm" data-toggle="modal" data-target="#exampleModal">
                                <i class="fas fa-cog text-dark"></i>                          
                              </button>
                            </td>
                        </tr>
                        <tr>
                            <td>9</td>
                            <td>2016/11/12</td>
                            <td>John</td>
                            <td>Tokyo</td>
                            <td>$2100</td>
                            <td>
                              <button type="button" class="btn btn-outline-secondary btn-icon btn-sm" data-toggle="modal" data-target="#exampleModal">
                                <i class="fas fa-cog text-dark"></i>                          
                              </button>
                            </td>
                        </tr>
                        <tr>
                            <td>10</td>
                            <td>2003/12/26</td>
                            <td>Tom</td>
                            <td>Germany</td>
                            <td>$1100</td>
                            <td>
                              <button type="button" class="btn btn-outline-secondary btn-icon btn-sm" data-toggle="modal" data-target="#exampleModal">
                                <i class="fas fa-cog text-dark"></i>                          
                              </button>
                            </td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog " role="document">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title" id="exampleModalLabel">Update Users</h5>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        <div class="modal-body">

           
                  <div class="modal demo-modal">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        
                 <ul class="nav nav-pills nav-pills-success" id="pills-tab" role="tablist">
                    <li class="nav-item">
                      <a class="nav-link active" id="pills-userSettings-tab" data-toggle="pill" href="#pills-userSettings" role="tab" aria-controls="pills-userSettings" aria-selected="true">User Settings</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" id="pills-notification-tab" data-toggle="pill" href="#pills-notification" role="tab" aria-controls="pills-notification" aria-selected="false">Notification</a>
                    </li>
                  </ul>

        <div class="tab-content" id="pills-tabContent">
            <div class="tab-pane fade show active" id="pills-userSettings" role="tabpanel" aria-labelledby="pills-userSettings-tab">
                <form class="forms-sample">
					<div class="form-group">
                      <label for="InputUsername"><b>Name</b></label>
                      <input type="text" class="form-control" id="InputUsername" placeholder="Username">
                    </div>
										
                    <div class="form-group">

                        <label for="dial"><b>Dial Code</b></label>
                        <select id="dial" class="form-control">
                         <option data-countryCode="IN" value="91">India (+91)</option>
                            <optgroup label="Other countries">
                            <option data-countryCode="AU" value="61">Australia (+61)</option>
                            <option data-countryCode="BD" value="880">Bangladesh (+880)</option>
                            <option data-countryCode="BT" value="975">Bhutan (+975)</option>
                            <option data-countryCode="BR" value="55">Brazil (+55)</option>
                            <option data-countryCode="CN" value="86">China (+86)</option>
                            <option data-countryCode="FR" value="33">France (+33)</option>
                            <option data-countryCode="DE" value="49">Germany (+49)</option>
                            <option data-countryCode="HK" value="852">Hong Kong (+852)</option>
                            <option data-countryCode="JP" value="81">Japan (+81)</option>
                            <option data-countryCode="MX" value="52">Mexico (+52)</option>
                            <option data-countryCode="NZ" value="64">New Zealand (+64)</option>
                            <option data-countryCode="LK" value="94">Sri Lanka (+94)</option>
                            <option data-countryCode="US" value="1">USA (+1)</option>
							<option value="US/Eastern">(GMT-05:00) Eastern Time (US & Canada)</option>
                            <option data-countryCode="GB" value="44">UK (+44)</option>
							<option value="Canada/Atlantic">(GMT-04:00) Atlantic Time (Canada)</option>
                            <option data-countryCode="AE" value="971">United Arab Emirates (+971)</option>
                            <option data-countryCode="VE" value="58">Venezuela (+58)</option>
                            <option data-countryCode="VN" value="84">Vietnam (+84)</option>
                            <option data-countryCode="ZW" value="263">Zimbabwe (+263)</option>
                           
                        </select>
                        </br>
                        <label for="Phone"><b>Mobile Number</b></label>
                        <input type="number" class="form-control" id="Phone">
                    </div>
					
                    <div class="form-group">
                      <label for="email"><b>Email</b></label>
                      <input type="email" class="form-control" id="email" placeholder="Email">
                    </div>
					
                    <div class="form-group">
                        <label for="dial"><b>User Role</b></label>
                        <select id="dial" class="form-control">
                            <option value="Admin">Admin</option>
                            <option value="User">User</option>
                        </select>
                    </div>
										
                    <div class="form-group">
                      <label for="zone"><b>Zone Access<i class="fa fa-exclamation-circle"></i></b></label>
                        <div class="card">
                            <div class="card-body">
                                <button type="submit" class="btn btn-outline-primary btn-fw" title="Click to remove">All Devices</button>  
                                <button type="submit" class="btn btn-outline-primary btn-fw" title="Click to remove">PNB</button> <br>
                                <button type="submit" class="btn btn-outline-primary btn-fw" title="Click to remove">Indusind</button> <br>                   
                            </div>
                        </div>
					</div>
                </form>
				
            </div>
					
                    <div class="tab-pane fade" id="pills-notification" role="tabpanel" aria-labelledby="pills-notification-tab">
                     <form class="forms-sample">
                   				
                    <div class="form-group">
                        <label for="relay5"><b>Alert Notications <i class="fa fa-exclamation-circle" title="You can select either SMS or Whatsapp Notification"></i></b></label>
                    <div class="card">
                    <div class="card-body">
                    <div class="list-wrapper">
						<ul class="d-flex flex-column todo-list">
						    <li>
							    <div class="form-check">
								    <label class="form-check-label">
									    <input class="checkbox" type="checkbox">
                                            Email
								    </label>
							    </div>
                            </li>
                            <li>
							    <div class="form-check">
								    <label class="form-check-label">
									    <input class="checkbox" type="checkbox">
                                        Mobile App
								    </label>
							    </div>
                            </li>
                            <li>
							    <div class="form-check">
							    	    <label class="form-check-label">
									        <input class="checkbox" type="checkbox">
                                         SMS 
								        </label>
							    </div>
                            </li>
                            <li>
							    <div class="form-check">
								    <label class="form-check-label">
									    <input class="checkbox" type="checkbox"> 
                                            Whatsapp 
								    </label>
                                    <i class="fa fa-exclamation-circle" title="Your registered number will be used for Whatsapp notification"></i>
							    </div>
                            </li>
						</ul>

                    </div>
                    </div>
                    </div>
                    </div>

                    <div class="form-group">
                        <label for="relay5"><b>Summary Mail <i class="fa fa-exclamation-circle" title="You will recieve status of Unsolved faults"></i></b></label>
                    
                    <div class="card-body">
                    <div class="list-wrapper">
						<ul class="d-flex flex-column todo-list">
                        <li>
							    <div class="form-check">
								    <label class="form-check-label">
									    <input class="checkbox" type="checkbox" id="email">
                                            Email 
                                    </label>
							    
                                    <div class="form-group">
                                        <select id="email" class="form-control">
                                            <option value="12">12:00 AM</option>
                                            <option value="01">01:00 AM</option>
                                            <option value="02">02:00 AM</option>
                                            <option value="03">03:00 AM</option>
                                            <option value="04">04:00 AM</option>
                                            <option value="05">05:00 AM</option>
                                            <option value="06">06:00 AM</option>
                                            <option value="07">07:00 AM</option>
                                            <option value="08">08:00 AM</option>
                                            <option value="09">09:00 AM</option>
                                            <option value="10">10:00 AM</option>
                                            <option value="11">11:00 AM</option>
                                            <option value="12">12:00 PM</option>
                                            <option value="01">01:00 PM</option>
                                            <option value="02">02:00 PM</option>
                                            <option value="03">03:00 PM</option>
                                            <option value="04">04:00 PM</option>
                                            <option value="05">05:00 PM</option>
                                            <option value="06">06:00 PM</option>
                                            <option value="07">07:00 PM</option>
                                            <option value="08">08:00 PM</option>
                                            <option value="09">09:00 PM</option>
                                            <option value="10">10:00 PM</option>
                                            <option value="11">11:00 PM</option>
                                        </select>
                                    </div>
                                </div>
                            </li>
                            
                        </ul>
                    <div class="list-wrapper">
						<ul class="d-flex flex-column todo-list">
                            <li>
							    <div class="form-check">
							    	    <label class="form-check-label">
									        <input class="checkbox" type="checkbox">
                                            Alert Duration 
								        </label>
							    </div>
                            </li>
                            <li>
							    <div class="form-check">
								    <label class="form-check-label">
									    <input class="checkbox" type="checkbox" id="current">
                                            Active energy 
                                    </label>
							    
                                    <div class="form-group">
                                        <select id="current" class="form-control" title="Active Energy alert will always be immediate" disabled>
                                            <option value="0">Immediately</option>
                                            
                                        </select>
                                    </div>
                                </div>
                            </li>
						    <li>
							    <div class="form-check">
								    <label class="form-check-label">
									    <input class="checkbox" type="checkbox" id="email">
                                            Email 
                                    </label>
							    
                                    <div class="form-group">
                                        <select id="email" class="form-control">
                                            <option value="12">Immediately</option>
                                            <option value="01">After 30 mins</option>
                                            <option value="02">After 30 mins</option>
                                            <option value="03">After 2 hours</option>
                                            <option value="04">After 2 hours</option>
                                            <option value="05">After 8 hours</option>
                                            <option value="06">After 12 hours</option>
                                            <option value="07">After 24 hours</option>
                                            <option value="08">After 2 days</option>
                                            <option value="09">After 3 days</option>
                                            <option value="10">After 7 days</option>
                                        </select>
                                    </div>
                                </div>
                            </li>
                            
                            <li>
							    <div class="form-check">
								    <label class="form-check-label">
									    <input class="checkbox" type="checkbox" id="current">
                                            Current 
                                    </label>
							    
                                    <div class="form-group">
                                        <select id="current" class="form-control">
                                            <option value="12">Immediately</option>
                                            <option value="01">After 30 mins</option>
                                            <option value="02">After 30 mins</option>
                                            <option value="03">After 2 hours</option>
                                            <option value="04">After 2 hours</option>
                                            <option value="05">After 8 hours</option>
                                            <option value="06">After 12 hours</option>
                                            <option value="07">After 24 hours</option>
                                            <option value="08">After 2 days</option>
                                            <option value="09">After 3 days</option>
                                            <option value="10">After 7 days</option>
                                        </select>
                                    </div>
                                </div>
                            </li>
                            <li>
							    <div class="form-check">
								    <label class="form-check-label">
									    <input class="checkbox" type="checkbox" id="current">
                                            Device Connectivity 
                                    </label>
							    
                                    <div class="form-group">
                                        <select id="current" class="form-control">
                                            <option value="12">Immediately</option>
                                            <option value="01">After 30 mins</option>
                                            <option value="02">After 30 mins</option>
                                            <option value="03">After 2 hours</option>
                                            <option value="04">After 2 hours</option>
                                            <option value="05">After 8 hours</option>
                                            <option value="06">After 12 hours</option>
                                            <option value="07">After 24 hours</option>
                                            <option value="08">After 2 days</option>
                                            <option value="09">After 3 days</option>
                                            <option value="10">After 7 days</option>
                                        </select>
                                    </div>
                                </div>
                            </li>
                            <li>
							    <div class="form-check">
								    <label class="form-check-label">
									    <input class="checkbox" type="checkbox" id="current">
                                            Door 
                                    </label>
							    
                                    <div class="form-group">
                                        <select id="current" class="form-control">
                                            <option value="12">Immediately</option>
                                            <option value="01">After 30 mins</option>
                                            <option value="02">After 30 mins</option>
                                            <option value="03">After 2 hours</option>
                                            <option value="04">After 2 hours</option>
                                            <option value="05">After 8 hours</option>
                                            <option value="06">After 12 hours</option>
                                            <option value="07">After 24 hours</option>
                                            <option value="08">After 2 days</option>
                                            <option value="09">After 3 days</option>
                                            <option value="10">After 7 days</option>
                                        </select>
                                    </div>
                                </div>
                            </li>
                            <li>
							    <div class="form-check">
								    <label class="form-check-label">
									    <input class="checkbox" type="checkbox" id="current">
                                            Earth Voltage 
                                    </label>
							    
                                    <div class="form-group">
                                        <select id="current" class="form-control">
                                            <option value="12">Immediately</option>
                                            <option value="01">After 30 mins</option>
                                            <option value="02">After 30 mins</option>
                                            <option value="03">After 2 hours</option>
                                            <option value="04">After 2 hours</option>
                                            <option value="05">After 8 hours</option>
                                            <option value="06">After 12 hours</option>
                                            <option value="07">After 24 hours</option>
                                            <option value="08">After 2 days</option>
                                            <option value="09">After 3 days</option>
                                            <option value="10">After 7 days</option>
                                        </select>
                                    </div>
                                </div>
                            </li>
                            <li>
							    <div class="form-check">
								    <label class="form-check-label">
									    <input class="checkbox" type="checkbox" id="current">
                                            Frequency  
                                    </label>
							    
                                    <div class="form-group">
                                        <select id="current" class="form-control">
                                            <option value="12">Immediately</option>
                                            <option value="01">After 30 mins</option>
                                            <option value="02">After 30 mins</option>
                                            <option value="03">After 2 hours</option>
                                            <option value="04">After 2 hours</option>
                                            <option value="05">After 8 hours</option>
                                            <option value="06">After 12 hours</option>
                                            <option value="07">After 24 hours</option>
                                            <option value="08">After 2 days</option>
                                            <option value="09">After 3 days</option>
                                            <option value="10">After 7 days</option>
                                        </select>
                                    </div>
                                </div>
                            </li>
                            <li>
							    <div class="form-check">
								    <label class="form-check-label">
									    <input class="checkbox" type="checkbox" id="current">
                                            Humidity 
                                    </label>
							    
                                    <div class="form-group">
                                        <select id="current" class="form-control">
                                            <option value="12">Immediately</option>
                                            <option value="01">After 30 mins</option>
                                            <option value="02">After 30 mins</option>
                                            <option value="03">After 2 hours</option>
                                            <option value="04">After 2 hours</option>
                                            <option value="05">After 8 hours</option>
                                            <option value="06">After 12 hours</option>
                                            <option value="07">After 24 hours</option>
                                            <option value="08">After 2 days</option>
                                            <option value="09">After 3 days</option>
                                            <option value="10">After 7 days</option>
                                        </select>
                                    </div>
                                </div>
                            </li>
                            <li>
							    <div class="form-check">
								    <label class="form-check-label">
									    <input class="checkbox" type="checkbox" id="current">
                                            Input Supply 
                                    </label>
							    
                                    <div class="form-group">
                                        <select id="current" class="form-control">
                                            <option value="12">Immediately</option>
                                            <option value="01">After 30 mins</option>
                                            <option value="02">After 30 mins</option>
                                            <option value="03">After 2 hours</option>
                                            <option value="04">After 2 hours</option>
                                            <option value="05">After 8 hours</option>
                                            <option value="06">After 12 hours</option>
                                            <option value="07">After 24 hours</option>
                                            <option value="08">After 2 days</option>
                                            <option value="09">After 3 days</option>
                                            <option value="10">After 7 days</option>
                                        </select>
                                    </div>
                                </div>
                            </li>
                            <li>
							    <div class="form-check">
								    <label class="form-check-label">
									    <input class="checkbox" type="checkbox" id="current">
                                            Load  
                                    </label>
							    
                                    <div class="form-group">
                                        <select id="current" class="form-control">
                                            <option value="12">Immediately</option>
                                            <option value="01">After 30 mins</option>
                                            <option value="02">After 30 mins</option>
                                            <option value="03">After 2 hours</option>
                                            <option value="04">After 2 hours</option>
                                            <option value="05">After 8 hours</option>
                                            <option value="06">After 12 hours</option>
                                            <option value="07">After 24 hours</option>
                                            <option value="08">After 2 days</option>
                                            <option value="09">After 3 days</option>
                                            <option value="10">After 7 days</option>
                                        </select>
                                    </div>
                                </div>
                            </li>
                            <li>
							    <div class="form-check">
								    <label class="form-check-label">
									    <input class="checkbox" type="checkbox" id="current">
                                            Power Factor 
                                    </label>
							    
                                    <div class="form-group">
                                        <select id="current" class="form-control">
                                            <option value="12">Immediately</option>
                                            <option value="01">After 30 mins</option>
                                            <option value="02">After 30 mins</option>
                                            <option value="03">After 2 hours</option>
                                            <option value="04">After 2 hours</option>
                                            <option value="05">After 8 hours</option>
                                            <option value="06">After 12 hours</option>
                                            <option value="07">After 24 hours</option>
                                            <option value="08">After 2 days</option>
                                            <option value="09">After 3 days</option>
                                            <option value="10">After 7 days</option>
                                        </select>
                                    </div>
                                </div>
                            </li>
                            <li>
							    <div class="form-check">
								    <label class="form-check-label">
									    <input class="checkbox" type="checkbox" id="current">
                                            Relay On in Instant Mode 
                                    </label>
							    
                                    <div class="form-group">
                                        <select id="current" class="form-control">
                                            <option value="12">Immediately</option>
                                            <option value="01">After 30 mins</option>
                                            <option value="02">After 30 mins</option>
                                            <option value="03">After 2 hours</option>
                                            <option value="04">After 2 hours</option>
                                            <option value="05">After 8 hours</option>
                                            <option value="06">After 12 hours</option>
                                            <option value="07">After 24 hours</option>
                                            <option value="08">After 2 days</option>
                                            <option value="09">After 3 days</option>
                                            <option value="10">After 7 days</option>
                                        </select>
                                    </div>
                                </div>
                            </li>
                            <li>
							    <div class="form-check">
								    <label class="form-check-label">
									    <input class="checkbox" type="checkbox" id="current">
                                            Relay On/Off Events 
                                    </label>
							    
                                    <div class="form-group">
                                        <select id="current" class="form-control">
                                            <option value="12">Immediately</option>
                                            <option value="01">After 30 mins</option>
                                            <option value="02">After 30 mins</option>
                                            <option value="03">After 2 hours</option>
                                            <option value="04">After 2 hours</option>
                                            <option value="05">After 8 hours</option>
                                            <option value="06">After 12 hours</option>
                                            <option value="07">After 24 hours</option>
                                            <option value="08">After 2 days</option>
                                            <option value="09">After 3 days</option>
                                            <option value="10">After 7 days</option>
                                        </select>
                                    </div>
                                </div>
                            </li>
                            <li>
							    <div class="form-check">
								    <label class="form-check-label">
									    <input class="checkbox" type="checkbox" id="current">
                                            Temperature 
                                    </label>
							    
                                    <div class="form-group">
                                        <select id="current" class="form-control">
                                            <option value="12">Immediately</option>
                                            <option value="01">After 30 mins</option>
                                            <option value="02">After 30 mins</option>
                                            <option value="03">After 2 hours</option>
                                            <option value="04">After 2 hours</option>
                                            <option value="05">After 8 hours</option>
                                            <option value="06">After 12 hours</option>
                                            <option value="07">After 24 hours</option>
                                            <option value="08">After 2 days</option>
                                            <option value="09">After 3 days</option>
                                            <option value="10">After 7 days</option>
                                        </select>
                                    </div>
                                </div>
                            </li>
                            <li>
							    <div class="form-check">
								    <label class="form-check-label">
									    <input class="checkbox" type="checkbox" id="current">
                                            Voltage 
                                    </label>
                                    <div class="form-group">
                                        <select id="current" class="form-control">
                                            <option value="12">Immediately</option>
                                            <option value="01">After 30 mins</option>
                                            <option value="02">After 30 mins</option>
                                            <option value="03">After 2 hours</option>
                                            <option value="04">After 2 hours</option>
                                            <option value="05">After 8 hours</option>
                                            <option value="06">After 12 hours</option>
                                            <option value="07">After 24 hours</option>
                                            <option value="08">After 2 days</option>
                                            <option value="09">After 3 days</option>
                                            <option value="10">After 7 days</option>
                                        </select>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                    </div>
                    </div>
                    </div>
                    </form>
                    </div>
                    
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
