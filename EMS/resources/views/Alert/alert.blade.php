@extends('layout.layout')

@section('content')
<!-- <link rel="stylesheet" href="//cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css"> -->
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.0.0/css/buttons.dataTables.min.css">
<script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>


<div class="main-panel" >
        <div class="content-wrapper">
          
          <div class="card" id="">
            <div class="card-body">
              <h4 class="card-title">Alert</h4>
              <!--<button type="button" class="btn btn-outline-secondary btn-icon btn-sm" style="float:right" data-toggle="modal" data-target="#exampleModal2">-->
              <!--      <i class="fas fa-plus text-dark"></i>-->
              <!--  </button>-->
               
              <div class="row">
                <div class="col-12">
                  <div class="table-responsive">
                    <table id="order-listing" class="table">
                      <thead>
                         <tr>
                          
                            <th>Name</th>
                            <th></th>
                            <th>Severity</th>
                            
                            
                            
                        </tr>
                      </thead>
                      <tbody id="panelalertList">
                        
                      </tbody>
                       <!--<tfoot id="table_foot"></tfoot>-->
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
                          <h5 class="modal-title" id="exampleModalLabel">Editn Alerts</h5>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        <div class="modal-body">

                        <form class="forms-sample">
                     <div class="form-group">
                      <label for="energy"><b>Condition</b></label>
                    <p>
                      Send Alert if <b>Device Connectivity</b> unavailable for</p>
                        <select id="energy" class="form-control">
                             <option value="all">3 mins</option>
                             <option value="ashish">5 mins</option>
                             <option value="api">10 mins</option>
                             <option value="all">15 mins</option>
                             <option value="ashish">30 mins</option>
                             <option value="api">60 mins</option>
                             <option value="all">2 hours</option>
                             <option value="ashish">4 hours</option>
                             <option value="api">8 hours</option>
                             <option value="all">12 hours</option>
                             <option value="ashish">24 hours</option>
                             
                        </select>

                        <p>during</p>
                        <select id="energy" class="form-control">
                             <option value="all">Entire Day</option>
                             <option value="ashish">Operational</option>
                             <option value="api">Non-Operational</option>
                             <option value="api">Specific Time</option>
                        </select>
                    </div>
                    </form>
                    
                    <form class="forms-sample">
                     <div class="form-group">
                      <label for="energy">Severity</label>
                      <br>
                        <select id="energy" class="form-control">
                             <option value="all">High</option>
                             <option value="ashish">Medium</option>
                             <option value="api">Low</option>
                             
                        </select>
                    </div>
                    </form>
                    <br>
                    <div class="form-group">
                      <label for="notify">Notification Message</label>
                      <input type="textarea" class="form-control" id="notify" placeholder="Message Here">
                    </div>
                    <br>
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-warning" data-reset="modal">Reset</button>
                          <button type="button" class="btn btn-success">Submit</button>
                          <button type="button" class="btn btn-light" data-dismiss="modal">Cancel</button>
                        </div>
                      </div>
                    </div>
</div>
<div class="modal fade" id="exampleModal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog " role="document">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title" id="exampleModalLabel">Editn Alerts</h5>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        <div class="modal-body">

                        <form class="forms-sample">
                     <div class="form-group">
                      <label for="energy"><b>Condition</b></label>
                    <p>
                    Send Alert if 
                      <select id="energy" class="form-control">
                             <option id="voltage"value="voltage">Voltage</option>
                             <option id="current" value="current">Current</option>
                             <option value="api">Power Factor</option>
                             <option value="all">Active Energy</option>
                             <option value="ashish">Load</option>
                             <option value="api">Frequency</option>
                             <option value="all">Temperature</option>
                             <option value="ashish">Humidity</option>
                             <option value="api">Earth Voltage</option>
                             <option value="all">Input Supply</option>
                             <option value="ashish">Device Connectivity</option>
                             <option value="all">Relay On in Instant </option>
                             <option value="ashish">Relay On/Off Events</option>
                             <option value="ashish">Door</option>
                        </select>
                        <select id="voltage" class="form-control">
                             <option id="above" value="above">Is Above</option>
                             <option id="below" value="below">Is Below</option>
                             <option value="equal">Is Equal Too</option>
                             <option value="DnA">Data not available</option>
                        </select>
                        <select id="above" class="form-control">
                             <input type="number" class="form-control" id="value">V
                        </select>

                        <select id="energy" class="form-control">
                             <option value="all">3 mins</option>
                             <option value="ashish">5 mins</option>
                             <option value="api">10 mins</option>
                             <option value="all">15 mins</option>
                             <option value="ashish">30 mins</option>
                             <option value="api">60 mins</option>
                             <option value="all">2 hours</option>
                             <option value="ashish">4 hours</option>
                             <option value="api">8 hours</option>
                             <option value="all">12 hours</option>
                             <option value="ashish">24 hours</option>
                             
                        </select>
                        
                        <p>during</p>
                        <select id="energy" class="form-control">
                             <option value="all">Entire Day</option>
                             <option value="ashish">Operational</option>
                             <option value="api">Non-Operational</option>
                             <option value="api">Specific Time</option>
                        </select>
                    </div>
                    </form>
                    
                    <form class="forms-sample">
                     <div class="form-group">
                      <label for="energy">Severity</label>
                      <br>
                        <select id="energy" class="form-control">
                             <option value="all">High</option>
                             <option value="ashish">Medium</option>
                             <option value="api">Low</option>
                             
                        </select>
                    </div>
                    </form>
                    <br>
                    <div class="form-group">
                      <label for="notify">Notification Message</label>
                      <input type="textarea" class="form-control" id="notify" placeholder="Message Here">
                    </div>
                    <br>
                        </div>
                        <div class="modal-footer">
                          <button type="reset" class="btn btn-warning" data-remove="modal">Reset</button>
                          <button type="button" class="btn btn-success">Submit</button>
                          <button type="button" class="btn btn-light" data-dismiss="modal">Cancel</button>
                        </div>
                      </div>
                    </div>
</div>

<script src="{{url('assets/js/ems_api.js')}}"></script>
  <script src="{{url('assets/js/ems_api_alert.js')}}"></script>
  
  <script>
      $( document ).ready(function() { //debugger;;
    onloadalert(); 
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

