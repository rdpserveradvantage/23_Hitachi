<?php session_start();
error_reporting(0);
function get_dvr_status($atmid){
    global $conn;

    $sql = mysqli_query($conn,"select * from dvr_health where atmid='".$atmid."'");
    $sql_result = mysqli_fetch_assoc($sql);

    if($sql_result['login_status']==0){
        return 'Working';
    }
    if($sql_result['login_status']==1){
        return 'Not Working';

    }
}

function date_difference($datetime){
    $datetime1 = date_create($datetime); 
    $datetime2 = date_create(date('d-m-Y'));   
    $interval = date_diff($datetime1, $datetime2); 
    return $interval->format(' %R%a days');
}

function get_panel_status($atmid){
    global $conn;

    $sql = mysqli_query($conn,"select * from panel_health where atmid='".$atmid."'");
    $sql_result = mysqli_fetch_assoc($sql);

    if($sql_result['status']==0){
        return 'Working';
    }
    if($sql_result['status']==1){
        return 'Not Working';

    }
}
if(isset($_SESSION['login_user']) && isset($_SESSION['id']))
{
    include("config.php");
    include('header.php');
    include('script.php');
/*  $abc_count="select count(*) from panel_health";
$abc="select * from panel_health";
$qrys=mysqli_query($conn,$abc);*/
    ?>
                <!-- DataTables -->
        <link href="../plugins/datatables/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css" />
        <link href="../plugins/datatables/buttons.bootstrap4.min.css" rel="stylesheet" type="text/css" />
        
         <!-- Spinkit css -->
        <link href="../plugins/spinkit/spinkit.css" rel="stylesheet" />

        <!-- App css -->
        <link href="assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="assets/css/icons.css" rel="stylesheet" type="text/css" />
        <link href="assets/css/style.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" type="text/css" href="custome_assets/datatable.css">
                              

        <script src="assets/js/modernizr.min.js"></script>
        
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

        <body onload="a('','','network_process.php')">
            <?php include('menu.php');?>

        <div class="wrapper">
            <div class="container-fluid">

                <!-- Page-Title -->
                <div class="row">
                    <div class="col-sm-12">
                        <div class="page-title-box">
                            <div class="btn-group float-right">
                                <ol class="breadcrumb hide-phone p-0 m-0">
                                    <li class="breadcrumb-item"><a href="#">Health report</a></li>
                                    <li class="breadcrumb-item"><a href="DVRHealthStatus.php">DVR HEALTH </a></li>
                                    
                                </ol>
                            </div>
                            <h4 class="page-title">DVR</h4>
                        </div>
                    </div>
                </div>
                <!-- end page title end breadcrumb -->

                <div class="row">
                    <div class="col-12">
                        <div class="card-box">
                            <h4 class="header-title">DVR Health Status</h4>

                            <div class="text-center mt-4 mb-4">
                                <div class="row">
                                    <div class="col-md-6 col-xl-3">
                                        <div class="card-box widget-flat border-custom bg-custom text-white" style="padding-bottom: 0px;padding-top: 9px;">
                                            <i class="fi-tag" style="pointer-events: none; cursor: default;">DVR</i>
                                            
                                            <h4 class="m-b-10">Total Sites </h4> 
                                            <h3>
                                            <?php
                                            
                                             $add="";                     
if($_SESSION['permission']!="" && $_SESSION['designation']=="2"){
    
    $Id=$_SESSION['permission'];
    $perm=array();
    
    $IDsplit=explode(',',$Id);
    
    
    foreach($IDsplit as  $element){
        $perm[]=$element;
    }
    $per= "'".implode("','",$perm)."'";
    
   
   $add=" and atmid IN (select ATMID from sites where CTS_LocalBranch IN($per) and live='Y')";
}

if($_SESSION['designation']=="4"){
    
    
   $add=" and atmid IN (select ATMID from sites where Customer='Hitachi' and live='Y')";
}

                                            
                                            $Q1="select count(*) as totalDVR from sites where live='Y'";
                                            if($_SESSION['permission']!="" && $_SESSION['designation']=="2"){$Q1.= $add;}
											if($_SESSION['designation']=="4"){$Q1.= $add;}
                                            $qrydvr=mysqli_query($conn,$Q1);
                                            $fetchDvrQry=mysqli_fetch_array($qrydvr);
                                            echo $fetchDvrQry['totalDVR'];
                                            ?></h3>



                                       
                                         <div>  <p class="text-uppercase m-b-5 font-13 font-600"><a href="DVR_POPup.php?id=1" style="color:white" target="_blank">Connected</a>  / <a href="DVR_POPup.php?id=0" style="color:white" target="_blank"> Not Connected </a></p>
</div>
                                        </div> 
                                    </div>
                                    <div class="col-md-6 col-xl-3">
                                        <div class="card-box bg-primary widget-flat border-primary text-white" style="padding-left: 4px;padding-bottom: 0px;">
                                            <i class="fi-archive" style="pointer-events: none; cursor: default;">HDD</i>
                                            <h>DVR Ping Status</h> 


                                            <h3 class="m-b-10">

                                                <?php 
$dvrping_stmt = "SELECT a.ATMID as ATMID,a.bank as Bank,a.dvrip as DVRIP,b.dvr as DVR_datetime,a.routerip as RouterIp,b.router as router_datetime,a.panelip as PanelIP,b.panel as panel_datetime FROM `sites` a,network_report b WHERE a.sn=b.id and a.live='Y'";												
if($_SESSION['designation']=="4"){
   $dvrping_stmt .= " and a.Customer='Hitachi'";
} 
$dvr_sql = mysqli_query($conn,$dvrping_stmt);
$total_rows = mysqli_num_rows($dvr_sql);
$today = date('Y-m-d');

$dvrping_stmt1 = "SELECT a.ATMID as ATMID,a.bank as Bank,a.dvrip as DVRIP,b.dvr as DVR_datetime,a.routerip as RouterIp,b.router as router_datetime,a.panelip as PanelIP,b.panel as panel_datetime FROM `sites` a,network_report b where a.sn=b.id and a.live='Y' and b.dvr > '".$today."'";
if($_SESSION['designation']=="4"){
   $dvrping_stmt1 .= " and a.Customer='Hitachi'";
} 
$dvr_sql1 = mysqli_query($conn,$dvrping_stmt1);
$today_dvr = mysqli_num_rows($dvr_sql1);


$remaining_dvr = $total_rows - $today_dvr ; 

echo $today_dvr .' / ' . $remaining_dvr;






                                                ?> 


                                            </h3>







                                            <p class="text-uppercase m-b-5 font-13 font-600">
                                                Working / Not Working
                                            </p>
                                        </div>
                                    </div>

                                <?php if($_SESSION['designation']!="4"){ ?>

                                    <div class="col-md-6 col-xl-3">
                                        <div class="card-box widget-flat border-success bg-success text-white" style="padding-bottom: 0px;">
                                            <i class="fi-help" style="pointer-events: none; cursor: default;">DVR</i>
                                            <h>Router Ping Status</h>
                                            <h3 class="m-b-10">

                                                <?php
$routerping_stmt = "SELECT a.ATMID as ATMID,a.bank as Bank,a.dvrip as DVRIP,b.dvr as DVR_datetime,a.routerip as RouterIp,b.router as router_datetime,a.panelip as PanelIP,b.panel as panel_datetime FROM `sites` a,network_report b where a.sn=b.id and a.live='Y' and b.router > '".$today."'";												
if($_SESSION['designation']=="4"){
   $routerping_stmt .= " and a.Customer='Hitachi'";
} 
$dvr_sql2 = mysqli_query($conn,$routerping_stmt);
$today_router = mysqli_num_rows($dvr_sql2);


$remaining_router = $total_rows - $today_router ; 

echo $today_router .' / ' . $remaining_router;

?>

                                            </h3>

                                            <p class="text-uppercase m-b-5 font-13 font-600"  >
                                                Working / Not Working
                                            </p>
                                        </div>
                                    </div>
									
								<?php } ?>
									
                                    <div class="col-md-6 col-xl-3">
                                        <div class="card-box bg-danger widget-flat border-danger text-white" style="padding-bottom: 0px;">
                                            <i class="fi-delete" style="pointer-events: none; cursor: default;">Camera</i>
                                            <h>Panel Ping Status</h>
                                            <h3 class="m-b-10">

<?php
$panelping_stmt = "SELECT a.ATMID as ATMID,a.bank as Bank,a.dvrip as DVRIP,b.dvr as DVR_datetime,a.routerip as RouterIp,b.router as router_datetime,a.panelip as PanelIP,b.panel as panel_datetime FROM `sites` a,network_report b where a.sn=b.id and a.live='Y' and b.panel > '".$today."'";
if($_SESSION['designation']=="4"){
   $panelping_stmt .= " and a.Customer='Hitachi'";
} 
$dvr_sql3 = mysqli_query($conn,$panelping_stmt);
$today_panel = mysqli_num_rows($dvr_sql3);


$remaining_panel = $total_rows - $today_panel ; 

echo $today_panel .' / ' . $remaining_panel;

?>

                                            </h3>
                                            <p class="text-uppercase m-b-5 font-13 font-600"> 
                                                Working / Not Working
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>



          




<div align="center" style="display:none"><input type="text" id="Atmid" name="Atmid" placeholder="Search Atm-ID"  /><input type="button" value="search" onClick="a('','50')" /></div>

                      <!--     <div class="sk-fading-circle" id="spinner">
                                <div class="sk-circle1 sk-circle"></div>
                                <div class="sk-circle2 sk-circle"></div>
                                <div class="sk-circle3 sk-circle"></div>
                                <div class="sk-circle4 sk-circle"></div>
                                <div class="sk-circle5 sk-circle"></div>
                                <div class="sk-circle6 sk-circle"></div>
                                <div class="sk-circle7 sk-circle"></div>
                                <div class="sk-circle8 sk-circle"></div>
                                <div class="sk-circle9 sk-circle"></div>
                                <div class="sk-circle10 sk-circle"></div>
                                <div class="sk-circle11 sk-circle"></div>
                                <div class="sk-circle12 sk-circle"></div>
                            </div> -->
<div class="data" style="overflow: auto;">
    

    
  <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                                 
                                    <thead>
                                        <th>SR No. </th>
                                        <th>ATMID</th>
                                        <th>Bank</th>
                                        <th>DVRIP</th>
                                        <th>DVR_datetime</th>
                                        <th>Days</th>
                                        <th>DVR Login Status</th>
                                        <th>RouterIp</th>
                                        <th>router_datetime</th>  
                                        <th>Days</th>                                      
                                        <th>PanelIP</th>
                                        <th>panel_datetime</th>
                                        <th>Days</th>
                                        <th>Panel Login Status</th>
                                        <th>Site Address</th>
                                        <th>City</th>
                                        <th>State</th>
                                        <th>Panel Make</th>
                                        <th>DVR Name</th>
                                    </thead>
                                    <tbody>
                                          <?php 
$net_count = 1 ; 
                            $net_stmt = "SELECT a.DVRName as DVRName, a.ATMID as ATMID,a.SiteAddress as SiteAddress , a.City as city , a.State as State, a.Panel_Make as Panel_Make,a.bank as Bank,a.dvrip as DVRIP,b.dvr as DVR_datetime,a.routerip as RouterIp,b.router as router_datetime,a.panelip as PanelIP,b.panel as panel_datetime FROM `sites` a,network_report b WHERE a.sn=b.id and a.live='Y'";
							if($_SESSION['designation']=="4"){
							   $net_stmt .= " and a.Customer='Hitachi'";
							} 
                            $net_sql = mysqli_query($conn,$net_stmt);
                            while ($net_sql_result = mysqli_fetch_assoc($net_sql)) { 

$DVR_datetime  = $net_sql_result['DVR_datetime'];
$DVR_datetime = strtotime($DVR_datetime);
$DVR_datetime = date('d-m-Y',$DVR_datetime);


$router_datetime  = $net_sql_result['router_datetime'];
$router_datetime = strtotime($router_datetime);
$router_datetime = date('d-m-Y',$router_datetime);



$panel_datetime  = $net_sql_result['panel_datetime'];
$panel_datetime = strtotime($panel_datetime);
$panel_datetime = date('d-m-Y',$panel_datetime);





                                ?>
                          


                                        <tr>
                                            <td><?php echo $net_count ; ?></td>
                                            <td>
                                                <?php echo $net_sql_result['ATMID'];?>
                                            </td>
                                            <td>
                                                <?php echo $net_sql_result['Bank'];?>
                                            </td>
                                            <td>
                                                <?php echo $net_sql_result['DVRIP'];?>
                                            </td>
                                            <td>
                                                <?php echo $DVR_datetime ;?>
                                            </td>
                                            <td>
                                                <?php 
                                                if($net_sql_result['DVR_datetime']!='0000-00-00 00:00:00'){

                                                echo date_difference($DVR_datetime);                                                }
                                                else{
                                                    echo 'No';
                                                }
                                                 ?>
                                            </td>
                                            <td>
                                                <?php echo get_dvr_status($net_sql_result['ATMID']); ?>
                                            </td>
                                            <td>
                                                <?php echo $net_sql_result['RouterIp'];?>
                                            </td>
                                            <td>
                                                <?php if($net_sql_result['router_datetime']=='0000-00-00 00:00:00'){
                                                            echo $net_sql_result['router_datetime'];
                                                }else{
                                                    echo $router_datetime;
                                                }
                                                    ;?>
                                            </td>

                                            <td>
                                                <?php 
                                                if($net_sql_result['router_datetime']!='0000-00-00 00:00:00'){

                                                echo date_difference($router_datetime);                                                }
                                                else{
                                                    echo 'No';
                                                }
                                                 ?>
                                            </td>
                                            <td>
                                                <?php echo $net_sql_result['PanelIP'];?>
                                            </td>
                                            <td>
                                                <?php if($net_sql_result['panel_datetime']=='0000-00-00 00:00:00'){
                                                            echo $net_sql_result['panel_datetime'];
                                                }else{
                                                    echo $panel_datetime;
                                                }
                                                    ;?>
                                            </td>
                                             <td>
                                                <?php 
                                                if($net_sql_result['panel_datetime']!='0000-00-00 00:00:00'){

                                                echo date_difference($panel_datetime);   }
                                                else{
                                                    echo 'No';
                                                }
                                                 ?>
                                            </td>
                                            <td>
                                                <?php echo get_panel_status($net_sql_result['ATMID']); ?>
                                                
                                            </td>
                                            <td>
                                                <?php echo $net_sql_result['SiteAddress']; ?>
                                                
                                            </td>
                                            <td>
                                                <?php echo $net_sql_result['city']; ?>
                                                
                                            </td>
                                            <td>
                                                <?php echo $net_sql_result['State']; ?>
                                                
                                            </td>
                                            <td>
                                                <?php echo $net_sql_result['Panel_Make']; ?>
                                                
                                            </td>
                                            <td>
                                                <?php echo $net_sql_result['DVRName']; ?>
                                            </td>
                                            
                                        </tr>


                            <?php $net_count++; }                          ?>
                          

                                    </tbody>
                                    


                                </table>
</div>
  
                        </div>
                    </div><!-- end col -->
                </div>
                <!-- end row -->

            </div> <!-- end container -->
        </div>
        <!-- end wrapper -->


         <?php include('footer.php'); ?>

        <!-- jQuery  -->
        <script src="assets/js/jquery.min.js"></script>
        <script src="assets/js/bootstrap.bundle.min.js"></script>
        <script src="assets/js/waves.js"></script>
        <script src="assets/js/jquery.slimscroll.js"></script>


        <!-- Required datatable js -->
     <!--    <script src="../plugins/datatables/jquery.dataTables.min.js"></script>
      -->
         <!-- <script src="../plugins/datatables/dataTables.bootstrap4.min.js"></script> -->
        <!-- Buttons examples -->
<!--         <script src="../plugins/datatables/dataTables.buttons.min.js"></script>
        <script src="../plugins/datatables/buttons.bootstrap4.min.js"></script>
        <script src="../plugins/datatables/jszip.min.js"></script>
        <script src="../plugins/datatables/pdfmake.min.js"></script>
        <script src="../plugins/datatables/vfs_fonts.js"></script>
        <script src="../plugins/datatables/buttons.html5.min.js"></script>
        <script src="../plugins/datatables/buttons.print.min.js"></script> -->

  <!-- Counter Up  -->
        <script src="../plugins/waypoints/lib/jquery.waypoints.min.js"></script>
        <script src="../plugins/counterup/jquery.counterup.min.js"></script>

 <!-- App js -->
        <script src="assets/js/jquery.core.js"></script>
        <script src="assets/js/jquery.app.js"></script>


 <script src="custome_assets/jquery.dataTables.js"></script>
    <script src="custome_assets/skin/bootstrap/js/dataTables.bootstrap.js"></script>
    <script src="custome_assets/extensions/export/dataTables.buttons.min.js"></script>
    <script src="custome_assets/extensions/export/buttons.flash.min.js"></script>
    <script src="custome_assets/extensions/export/jszip.min.js"></script>
    <script src="custome_assets/extensions/export/pdfmake.min.js"></script>
    <script src="custome_assets/extensions/export/vfs_fonts.js"></script>
    <script src="custome_assets/extensions/export/buttons.html5.min.js"></script>
    <script src="custome_assets/extensions/export/buttons.print.min.js"></script>

    <!-- Custom Js -->
    <!-- <script src="../js/admin.js"></script> -->
    <script src="custome_assets/jquery-datatable.js"></script>

            
   <!--    <script type="text/javascript">

               function callfn(){
                   
                //Buttons examples
                var table = $('#datatable-buttons').DataTable({
                    lengthChange: false, 
                    scrollX: true,
                    buttons: ['copy', 'excel']
                  
                });

               table.buttons().container()
                .appendTo('#datatable-buttons_wrapper .col-md-6:eq(0)');
              
               
               }
        </script> -->
       
    </body>
</html><?php
}else
{ 
 header("location: index.php");
}
?>
