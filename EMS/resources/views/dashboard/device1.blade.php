@extends('layout.layout')

@section('content')

<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/2.0.0/css/buttons.dataTables.min.css">


<div class="main-panel" >
        <div class="content-wrapper">
          <div class="page-header">
            <h3 class="page-title">
              Data table
            </h3>
            <nav aria-label="breadcrumb">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Tables</a></li>
                <li class="breadcrumb-item active" aria-current="page">Data table</li>
              </ol>
            </nav>
          </div>
          <div class="card" id="">
            <div class="card-body">
              <h4 class="card-title">Data table</h4>
              <div class="row">
                <div class="col-12">
                  <div class="table-responsive">
                    <table id="order-listing" class="table">
                      <thead>
                        <tr>
                            <th>#</th>
                            <th>Device Name</th>
                            <th>Serial No.</th>
                            <th>Settings</th>
                            <th>Schedule</th>
                            <th>Data</th>
                            <th>Relay 1</th>
                            <th>Relay 2</th>
                            <th>Relay 3</th>
                            <th>Relay 4</th>
                            <th>Relay 5</th>
                            <th>Last Online</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                            <td>1</td>
                            <td>2012/08/03</td>
                            <td>Edinburgh</td>
                            <td>New York</td>
                            <td>$1500</td>
                            <td>$3200</td>
                            <td>
                              <label class="badge badge-success">On</label>
                            </td>
                            <td>
                              <button class="btn btn-secondary">Off</button>
                            </td>
                            <td>
                              <label class="btn btn-secondary">Off</label>
                            </td>
                            <td>
                              <label class="btn btn-secondary">Off</label>
                            </td>
                            <td>
                              <label class="badge badge-success">On</label>
                            </td>
                            <td>Online</td>
                        </tr>
                        <tr>
                            <td>2</td>
                            <td>2015/04/01</td>
                            <td>Doe</td>
                            <td>Brazil</td>
                            <td>$4500</td>
                            <td>$7500</td>
                            <td>
                              <label class="badge badge-success">On</label>
                            </td>
                            <td>
                              <button class="btn btn-secondary">Off</button>
                            </td>
                            <td>
                              <label class="btn btn-secondary">Off</label>
                            </td>
                            <td>
                              <label class="btn btn-secondary">Off</label>
                            </td>
                            <td>
                              <label class="badge badge-success">On</label>
                            </td>
                            <td>Online</td>
                        </tr>
                        <tr>
                            <td>3</td>
                            <td>2010/11/21</td>
                            <td>Sam</td>
                            <td>Tokyo</td>
                            <td>$2100</td>
                            <td>$6300</td>
                            <td>
                              <label class="badge badge-success">On</label>
                            </td>
                            <td>
                              <button class="btn btn-secondary">Off</button>
                            </td>
                            <td>
                              <label class="btn btn-secondary">Off</label>
                            </td>
                            <td>
                              <label class="btn btn-secondary">Off</label>
                            </td>
                            <td>
                              <label class="badge badge-success">On</label>
                            </td>
                            <td>Online</td>
                        </tr>
                        <tr>
                            <td>4</td>
                            <td>2016/01/12</td>
                            <td>Sam</td>
                            <td>Tokyo</td>
                            <td>$2100</td>
                            <td>$6300</td>
                            <td>
                              <label class="badge badge-success">On</label>
                            </td>
                            <td>
                              <button class="btn btn-secondary">Off</button>
                            </td>
                            <td>
                              <label class="btn btn-secondary">Off</label>
                            </td>
                            <td>
                              <label class="btn btn-secondary">Off</label>
                            </td>
                            <td>
                              <label class="badge badge-success">On</label>
                            </td>
                            <td>Online</td>
                        </tr>
                        <tr>
                            <td>5</td>
                            <td>2017/12/28</td>
                            <td>Sam</td>
                            <td>Tokyo</td>
                            <td>$2100</td>
                            <td>$6300</td>
                            <td>
                              <label class="badge badge-success">On</label>
                            </td>
                            <td>
                              <button class="btn btn-secondary">Off</button>
                            </td>
                            <td>
                              <label class="btn btn-secondary">Off</label>
                            </td>
                            <td>
                              <label class="btn btn-secondary">Off</label>
                            </td>
                            <td>
                              <label class="badge badge-success">On</label>
                            </td>
                            <td>Online</td>
                        </tr>
                        <tr>
                            <td>6</td>
                            <td>2000/10/30</td>
                            <td>Sam</td>
                            <td>Tokyo</td>
                            <td>$2100</td>
                            <td>$6300</td>
                            <td>
                              <label class="badge badge-success">On</label>
                            </td>
                            <td>
                              <button class="btn btn-secondary">Off</button>
                            </td>
                            <td>
                              <label class="btn btn-secondary">Off</label>
                            </td>
                            <td>
                              <label class="btn btn-secondary">Off</label>
                            </td>
                            <td>
                              <label class="badge badge-success">On</label>
                            </td>
                            <td>Online</td>
                        </tr>
                        <tr>
                            <td>7</td>
                            <td>2011/03/11</td>
                            <td>Cris</td>
                            <td>Tokyo</td>
                            <td>$2100</td>
                            <td>$6300</td>
                            <td>
                              <label class="badge badge-success">On</label>
                            </td>
                            <td>
                              <button class="btn btn-secondary">Off</button>
                            </td>
                            <td>
                              <label class="btn btn-secondary">Off</label>
                            </td>
                            <td>
                              <label class="btn btn-secondary">Off</label>
                            </td>
                            <td>
                              <label class="badge badge-success">On</label>
                            </td>
                            <td>Online</td>
                        </tr>
                        <tr>
                            <td>8</td>
                            <td>2015/06/25</td>
                            <td>Tim</td>
                            <td>Italy</td>
                            <td>$6300</td>
                            <td>$2100</td>
                            <td>
                              <label class="badge badge-success">On</label>
                            </td>
                            <td>
                              <button class="btn btn-secondary">Off</button>
                            </td>
                            <td>
                              <label class="btn btn-secondary">Off</label>
                            </td>
                            <td>
                              <label class="btn btn-secondary">Off</label>
                            </td>
                            <td>
                              <label class="badge badge-success">On</label>
                            </td>
                            <td>Online</td>
                        </tr>
                        <tr>
                            <td>9</td>
                            <td>2016/11/12</td>
                            <td>John</td>
                            <td>Tokyo</td>
                            <td>$2100</td>
                            <td>$6300</td>
                            <td>
                              <label class="badge badge-success">On</label>
                            </td>
                            <td>
                              <button class="btn btn-secondary">Off</button>
                            </td>
                            <td>
                              <label class="btn btn-secondary">Off</label>
                            </td>
                            <td>
                              <label class="btn btn-secondary">Off</label>
                            </td>
                            <td>
                              <label class="badge badge-success">On</label>
                            </td>
                            <td>Online</td>
                        </tr>
                        <tr>
                            <td>10</td>
                            <td>2003/12/26</td>
                            <td>Tom</td>
                            <td>Germany</td>
                            <td>$1100</td>
                            <td>$2300</td>
                            <td>
                              <label class="badge badge-success">On</label>
                            </td>
                            <td>
                              <button class="btn btn-secondary">Off</button>
                            </td>
                            <td>
                              <label class="btn btn-secondary">Off</label>
                            </td>
                            <td>
                              <label class="btn btn-secondary">Off</label>
                            </td>
                            <td>
                              <label class="badge badge-success">On</label>
                            </td>
                            <td>Online</td>
                        </tr>
                        <tr>
                            <td>11</td>
                            <td>2003/12/26</td>
                            <td>Tom</td>
                            <td>Germany</td>
                            <td>$1100</td>
                            <td>$2300</td>
                            <td>
                              <label class="badge badge-success">On</label>
                            </td>
                            <td>
                              <button class="btn btn-secondary">Off</button>
                            </td>
                            <td>
                              <label class="btn btn-secondary">Off</label>
                            </td>
                            <td>
                              <label class="btn btn-secondary">Off</label>
                            </td>
                            <td>
                              <label class="badge badge-success">On</label>
                            </td>
                            <td>Online</td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>


  <script>
$(document).ready(function() {
        $('#order-listing').DataTable( {
            dom: 'Bfrtip',
            buttons: [
                'copyHtml5',
                'excelHtml5',
                'csvHtml5',
                'pdfHtml5'
            ]
        } );
    } );
      </script>
      <script src="https://cdn.datatables.net/buttons/2.0.0/js/buttons.html5.min.js"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
      <script src="https://cdn.datatables.net/1.11.1/js/jquery.dataTables.min.js"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
      <script src="https://cdn.datatables.net/buttons/2.0.0/js/dataTables.buttons.min.js"></script>
            
@stop

