<!DOCTYPE html>
<html lang="en">
    <?php include('head.php');?>
    
    <style>
    .table thead th, .jsgrid .jsgrid-table thead th {
    border-top: 0;
    border-bottom-width: 1px;
    font-weight: bold;
    font-size: .9rem;
    padding: 0.4375rem;
}
        .bt{
                border-top: 1px solid #1e1f33;
          }
          .br
          {
                border-right: 1px solid #282844;
          }
          #accordion div.card-body {
        /*  margin:4px, 4px;
            padding:4px;
            background-color: green;
            width: 500px;  */
            height: 210px;
            overflow-x: hidden;
            overflow-y: scroll;
            text-align:justify;
        }
    </style>
    <style>
        .menu-icon
        {
            width: 33px;
            margin-right: 7%;
        }
    </style>
     <?php include('top-navbar.php');?>
            <!-- partial -->
            <div class="container-fluid page-body-wrapper">
                <!-- partial:partials/_settings-panel.html -->
                <!-- partial -->
                <!-- partial:partials/_sidebar.html -->
                <?php include('navbar.php');?>
                <!-- partial -->
                <div class="main-panel">
                    <div class="content-wrapper">
                    
                        <div class="col-12 grid-margin"> 
                         
                        </div> 
                        <!-- Dashboard Wighets -->
                        
                                                <?php 
$con = OpenCon() ; 

$date = date('Y-m-d'); 
function get_dvr_status($atmid){
    global $con;

    $sql = mysqli_query($con,"select * from dvr_health where atmid='".$atmid."'");
    $sql_result = mysqli_fetch_assoc($sql);
    $login_status = $sql_result['login_status'];
    
    if($login_status==0){

        if(is_null($login_status)){
            $status = 'NULL';
        }else{
            $status = 'Working';    
        }

    }else if($login_status==1){
        $status = 'Not Working';
    }
    return $status ; 
}

function date_difference($datetime){
    $datetime1 = date_create($datetime); 
    $datetime2 = date_create(date('d-m-Y'));   
    $interval = date_diff($datetime1, $datetime2); 
    return $interval->format(' %R%a days');
}

function get_panel_status($atmid){
    global $con;

    $sql = mysqli_query($con,"select * from panel_health where atmid='".$atmid."'");
    $sql_result = mysqli_fetch_assoc($sql);
    $panel_status = $sql_result['status'] ;


    if($panel_status==0){
        if(is_null($panel_status)){
            $status = 'NULL';
        }else{
            $status = 'Working';
        }
    }else if($panel_status==1){
        $status = 'Not working';
    }
    return $status ; 
}



// if(isset($_SESSION['login_user']) && isset($_SESSION['id']))


    ?>
        
        <!-- DataTables -->
        <link href="plugins/datatables/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css" />
        <link href="plugins/datatables/buttons.bootstrap4.min.css" rel="stylesheet" type="text/css" />
        
         <!-- Spinkit css -->
        <link href="plugins/spinkit/spinkit.css" rel="stylesheet" />

<!-- ajax -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    
    <script type="text/javascript" src="https://cdn.datatables.net/1.10.22/js/dataTables.bootstrap4.min.js"></script>


<style type="text/css">
    .dt-buttons a{
            border: 1px solid;
    padding: 4px;
    margin: auto 5px;
    }
    .paginate_button{
        margin: auto 5px;
    }
</style>




<script type="text/javascript">
    function a(strPage,perpg,urlPage){
     // alert("hii")
          var Atmid=document.getElementById("Atmid").value;
          $('#spinner').show();  // show the loading message.
          perp=perpg;

var Page="";
if(strPage!="")
{
Page=strPage;
}
     
             
         $.ajax({               
            type:'POST',    
            url:urlPage,
            data:'Page='+Page+'&perpg='+perp+'&Atmid='+Atmid,
            success: function(msg){
               $('#spinner').hide(); // hide the loading message
               document.getElementById("datatable-buttons").innerHTML=msg;
               callfn();
           }
        });
}

</script>
        <body>
            

        <div class="wrapper">
            <div class="container-fluid">
               <div class="row">
                    <div class="col-12">
                        <div class="card-box">
                            <h4 class="header-title">Cloud Network Report</h4>

                            <div class="text-center mt-4 mb-4">
                                <div class="row">
                                    <div class="col-md-6 col-xl-3">
                                        <div class="card-box bg-primary widget-flat border-primary text-white" style="padding-left: 4px;padding-bottom: 0px;">

                                            <h>DVR Ping Status</h> 


                                            <h3 class="m-b-10">

<?php 

$totaldvrCountsql = mysqli_query($con,"SELECT count(1) as totaldvrCount FROM `dvronline` WHERE `Bank` LIKE 'Axis-WLA' and customer='Hitachi' and Status='Y'");
$totaldvrCountsql_result = mysqli_fetch_assoc($totaldvrCountsql);
$totaldvrCount = $totaldvrCountsql_result['totaldvrCount'];


$network_report_dvronline_sql = mysqli_query($con,"select count(1) as network_report_dvronlinecount from network_report_dvronline where SN in(select id from dvronline where `Bank` LIKE 'Axis-WLA' and customer='Hitachi') and DATE(dvr) ='".$date."' ");
$network_report_dvronline_sql_result = mysqli_fetch_assoc($network_report_dvronline_sql);

$resultcount = $network_report_dvronline_sql_result['network_report_dvronlinecount'];
$remaining_dvr = $totaldvrCount - $resultcount ;
$workingdvr = $totaldvrCount - $remaining_dvr ;  
echo $workingdvr .' / ' . $remaining_dvr;

                                                ?>
                                            </h3>
                                            <p class="text-uppercase m-b-5 font-13 font-600">
                                                Working / Not Working
                                            </p>
                                        </div>
                                    </div>

                                </div>
                            </div>



          
<?php 

$statement = "SELECT a.id,a.ATMID,a.Address,a.State,a.IPAddress,a.`Rourt ID` as router_id  FROM `dvronline` a WHERE 1 and a.Status='Y' and a.customer='Hitachi' and a.bank='Axis-WLA'" ; 
$sql = mysqli_query($con,$statement);
                        ?>    
 
  <table class="table table-bordered table-striped table-hover dataTable js-exportable" id="data_table">
   
                                    <thead>
                                        <th>SR No. </th>
                                        <th>ATMID</th>
                                        <th>Address</th>
                                        <th>State</th>
                                        <th>IPAddress</th>
                                        <th>Router id</th>
                                        <th>DVR</th>
                                    </thead>
                                    <tbody>
                        <?php 

                            $i = 1; 
                            while($sql_result = mysqli_fetch_assoc($sql)){


                            $id = $sql_result['id'];
                            $repo_sql = mysqli_query($con,"select * from network_report_dvronline where SN = '".$id."'");
                            $repo_sql_result = mysqli_fetch_assoc($repo_sql);

                            $dvr = $repo_sql_result['dvr'];
                                           ?> 
                                        <tr>
                                            <td><?php echo $i; ?></td>
                                            <td><?php echo $sql_result['ATMID']; ?></td>
                                            <td><?php echo $sql_result['Address']; ?></td>
                                            <td><?php echo $sql_result['State']; ?></td>
                                            <td><?php echo $sql_result['IPAddress']; ?></td>
                                            <td><?php echo $sql_result['router_id']; ?></td>
                                            <td><?php echo $dvr; 
                                            // if(date('Y-m-d',strtotime($dvr)) == date('Y-m-d') ){
                                            // echo 'today';
                                            // }else{
                                            //     echo 'not today';
                                            // }
                                            ?>
                                            </td>
                                        </tr>
                                        <?php $i++; } ?>
                                    </tbody>
                                </table>
                        <!-- Dashboard Charts -->
                       
                    </div>
                    <!-- content-wrapper ends -->
                    <!-- partial:partials/_footer.html -->
                    <?php include('footer.php');?>
                    <!-- partial -->
                </div>
                <!-- main-panel ends -->
            </div>
            <!-- page-body-wrapper ends -->
        </div>
        <!-- container-scroller -->
        <!-- plugins:js -->
        <script src="vendors/js/vendor.bundle.base.js">
        </script>
        <script src="vendors/js/vendor.bundle.addons.js">
        </script>
        <!-- endinject -->
        <!-- Plugin js for this page-->
        <!-- End plugin js for this page-->
        <!-- inject:js -->
        <script src="js/off-canvas.js">
        </script>
        <script src="js/hoverable-collapse.js">
        </script>
        <script src="js/misc.js">
        </script>
        <script src="js/settings.js">
        </script>
        <script src="js/todolist.js"></script>
        <script src="js/chart.js"></script>
        <!-- endinject -->
        <!-- Custom js for this page-->
        <script src="js/dash_board.js"></script>
        
        <!-- End custom js for this page-->
        

        <script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.0.1/js/dataTables.buttons.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/2.0.1/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.0.1/js/buttons.print.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>


<link href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css" rel="stylesheet">
<link href="https://cdn.datatables.net/buttons/2.0.1/css/buttons.dataTables.min.css" rel="stylesheet">

<script>
    $(document).ready(function() {
        $('#data_table').DataTable({
            dom: 'Bfrtip',
            buttons: [
                'copy',
                'excel',
                'csv',
                'pdf',
            ]
        });
    });
</script>


    
    </body>
</html>




