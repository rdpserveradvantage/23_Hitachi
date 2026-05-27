<!DOCTYPE html>
<html lang="en">
<?php session_start();
     if(!$_SESSION['username']){  ?>
	        <script>
				window.location.href="login.php";
			</script>
<?php	 }
        
?>
<head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
            <meta content="width=device-width, initial-scale=1, shrink-to-fit=no" name="viewport">
                <title>
                    Comfort Techno Services Pvt Ltd
                </title>
                <!-- plugins:css -->
                <link href="../../vendors/iconfonts/font-awesome/css/all.min.css" rel="stylesheet">
                    <link href="../../vendors/css/vendor.bundle.base.css" rel="stylesheet">
                        <link href="../../vendors/css/vendor.bundle.addons.css" rel="stylesheet">
                            <!-- endinject -->
                            <!-- plugin css for this page -->
                            <!-- End plugin css for this page -->
                            <!-- inject:css -->
							<link rel="stylesheet" href="../../vendors/lightgallery/css/lightgallery.css">
                            <link href="../../css/style.css" rel="stylesheet">
                                <!-- endinject -->
                               <!-- <link href="media/comfort.ico" rel="shortcut icon"/>-->
                                <link rel="shortcut icon" href="../../images/favicon.png">
                            </link>
                        </link>
                    </link>
                </link>
				 <!-- Plugins css -->
				<link href="../../plugins/bootstrap-timepicker/bootstrap-timepicker.min.css" rel="stylesheet">
				<link href="../../plugins/bootstrap-colorpicker/css/bootstrap-colorpicker.min.css" rel="stylesheet">
				<link href="../../plugins/bootstrap-datepicker/css/bootstrap-datepicker.min.css" rel="stylesheet">
				<link href="../../plugins/clockpicker/css/bootstrap-clockpicker.min.css" rel="stylesheet">
				<link href="../../plugins/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet">
				<!--<link href="sweetalert/sweetalert.css" rel="stylesheet">-->
                <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js" integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>      
            </meta>
        </meta>
    </head>
<?php 
      include('../../db_connection.php');
	  if(isset($_SESSION['client'])){
		//  echo $_SESSION['client'];
		  $clients = explode(",",$_SESSION['client']);
		  $clientarray=json_encode($clients); 
		  $clientarray=str_replace( array('[',']','"') , ''  , $clientarray);
		  $arr=explode(',',$clientarray);
		  $clientarray = "'" . implode ( "', '", $arr )."'";
		  $con = OpenCon();
	      $sites_sql = "select ATMID from sites where Customer IN (".$clientarray.")";
		  
		  $atmidlist = mysqli_query($con,$sites_sql);
		  $atmidlistarr = array();
		  if(mysqli_num_rows($atmidlist)>0){
			  while($atmid_data=mysqli_fetch_assoc($atmidlist)){
				 $clientatmid = $atmid_data['ATMID']; 
				 array_push($atmidlistarr,$clientatmid);
			  }
		  }
		 // echo '<pre>';print_r($atmidlistarr);echo '</pre>';
	  }
   // include('../../config.php');
    // include('../../functions.php');
error_reporting(0);
date_default_timezone_set("Asia/Calcutta"); 
$current_datetime = date('Y-m-d H:i:s');

$now   = time();



// $path = 'D:\FTP_DATA\share' ;
$path = 'E:\FTP_DATA\HIKVISION\share';

$files = scandir($path);


foreach ($files as $key => $value) {

    $allinfo = explode('_', $value);
    
    $atm = $allinfo[0];
        if(strlen($atm)>5){
				for($p=0;$p<count($atmidlistarr);$p++){
				//	echo $atm."_".$atmidlistarr[$p];
					if($atm==$atmidlistarr[$p]){
				  $all_atm[]=$atm;
					}
				}
            }
    }

   // echo '<pre>';print_r($all_atm);echo '</pre>';
    
    ?>
       

<?php 
date_default_timezone_set("Asia/Calcutta"); 
$current_datetime = date('Y-m-d H:i:s');

$now   = time();
$path = 'Videos/';
$files = scandir($path);
$now   = time();

if(isset($_POST['atmid'])){
  $atmid = $_POST['atmid'];
  $post_date = $_POST['S_date'];
  $post_date = date('Y-m-d',strtotime($post_date));

  $_SESSION['post_d'] = $post_date; 
  $_SESSION['atmid'] = $atmid;
}





if(!isset($_POST['atmid']) && !isset($_POST['S_date'])){
    $post_date  = $_SESSION['post_d']; 
    $atmid = $_SESSION['atmid']  ;
  } 



$from_time = $_POST['From_timePicker'];
$to_time = $_POST['To_timePicker'];

 $from_time = str_replace(':', '', $from_time).'00';
 $to_time = str_replace(':', '', $to_time).'00';


 $new_post_date = str_replace('-', '', $post_date);


  $new_from  =  $new_post_date .'_'. $from_time ; 
  $new_to  =  $new_post_date .'_'. $to_time ; 


// return ; 
 ?>
<style>
		.menu-icon
		{
			width: 33px;
			margin-right: 7%;
		}
	</style>
        
<!-- ajax -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    

<style type="text/css">
  .pagination a {
    margin: auto 10px ;
    </style>
</style>
<body class="sidebar-light">
        <div class="container-scroller">
            <!-- partial:partials/_navbar.html -->
            <nav class="navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row default-layout-navbar">
                <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
                    <a class="navbar-brand brand-logo" href="../../panel_dashboard.php">
                        <img alt="logo" src="../../media/logo.png"/>
                    </a>
                    <a class="navbar-brand brand-logo-mini" href="index.html">
                        <img alt="logo" src="../../media/logo.png"/>
                    </a>
                </div>
                <div class="navbar-menu-wrapper d-flex align-items-stretch">
                    <button class="navbar-toggler navbar-toggler align-self-center" data-toggle="minimize" type="button">
                        <span class="fas fa-bars">
                        </span>
                    </button>
                    <ul class="navbar-nav navbar-nav-left">
                        <li class="nav-item nav-search d-none d-md-flex">
                            <div class="nav-link">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">
                                            <i class="fas fa-search">
                                            </i>
                                        </span>
                                    </div>
                                    <input aria-label="Search" class="form-control" placeholder="Search" type="text">
                                    </input>
                                </div>
                            </div>
                        </li>
                    </ul>
                    <ul class="navbar-nav navbar-nav-right">
                        <li class="nav-item d-none d-lg-block">
                            <a class="nav-link" href="#">
                                <i class="fas fa-ellipsis-v">
                                </i>
                            </a>
                        </li>
                    </ul>
                </div>
            </nav>
            <!-- partial --> 
   <div class="container-fluid page-body-wrapper">
                <!-- partial:partials/_settings-panel.html -->
                <!-- partial -->
                <!-- partial:partials/_sidebar.html -->
                <?php 
				include('navbar.php');?>
                <!-- partial -->
                <div class="main-panel">
                    <div class="content-wrapper">
										<div class="col-12 grid-margin">
                         <?php include('../../filters/sitehealth_filter.php');?>
			</div>   		
						<div class="col-12 grid-margin">
						   <h3 class="card-title">Videos (If search for today's video then select time 1 hour before from now.)</h3>
                            <div class="card">
                                <div class="card-body">
                <!-- Page-Title -->
                                    <form method="POST" action="pagination1.php">
                                        <div class="row">
                                            <div class="col-md-2">  
												<div class="form-group">
													<label>Select ATM ID </label>
													   <input type="hidden" id="selected_atm_id" value="" >
													   <input class="form-control" type="text" id="atmid" value="<?php if($_POST['atmid']){ echo $_POST['atmid']; }?>" name="atmid" required readonly>
													   <select class="form-control" id="atm_id"  style="display:none;">
                                                            <option value="">Select</option>   
															<?php 
															foreach ($all_atm as $atm_key => $atm_value) { ?>
																<?php //if($atm_value=='P3ENMM09' || $atm_value=='HITACHI-Demo' || $atm_value=='TESTDEMO'){?>
																<?php //if (in_array($atm_value, $atmidlistarr)){ ?>
																<option value="<?php echo $atm_value ;  ?>" <?php if($_POST['atmid']==$atm_value){ echo ' selected'; } ?>><?php echo $atm_value ;  ?></option>
																 <?php // } ?>
															<?php } ?>
													   </select> 
												</div>
											</div>


										    <div class="col-md-2"> 
												   <div class="form-group">
														<label>Date</label>
														<div>
															<div class="input-group">
																<input type="text" class="form-control" placeholder="mm/dd/yyyy" id="S_date" name="S_date" value="<?php if($_POST['S_date']){ echo $_POST['S_date']; }?>" required>
																<div class="input-group-append">
																	<span class="input-group-text"><i class="mdi mdi-calendar"></i></span>
																</div>
															</div>
														</div>
													</div>
											</div>
                 
											<div class="col-md-2"> 
												<div class="form-group">
												<label>From Time</label>
												<div class="input-group clockpicker" data-placement="bottom" data-align="top" data-autoclose="true">
													<input type="text" class="form-control" id="From_timePicker" name="From_timePicker" value="<?php if($_POST['From_timePicker']){ echo $_POST['From_timePicker']; } else{ echo '00:00'; } ?>">
													<div class="input-group-append">
														<span class="input-group-text"><i class="mdi mdi-clock"></i></span>
													</div>
												</div>
											    </div>
											</div>


											<div class="col-md-2">     
											    <div class="form-group">
														 <label>To Time</label>
														<div class="input-group clockpicker" data-placement="bottom" data-align="top" data-autoclose="true">
															<input type="text" class="form-control" id="To_timePicker" name="To_timePicker" value="<?php if($_POST['To_timePicker']){ echo $_POST['To_timePicker']; } else{ echo '00:00'; } ?>">
															<div class="input-group-append">
																<span class="input-group-text"><i class="mdi mdi-clock"></i></span>
															</div>
														</div>
												</div>
											</div>              
											<div class="col-md-4">  
										        <input type="submit" name="submit" value="Search" class="btn btn-primary"  style="margin-top: 30px;">
										        <input type="submit" name="merge" value="Merge" class="btn btn-danger"  style="margin-top: 30px;">
										        <a href="http://103.141.218.26:8080/ComfortTechnoNew/ffmpeg/bin/pagination.php" class="btn btn-info" style="margin-top: 30px;">Back</a>
											</div>
                                        </div>
                                    </form>

                                </div>

<div class="container-fluid">
    

    

<?php
if(isset($_POST['submit'])){


$custto = $_POST['To_timePicker'];
$custfrom = $_POST['From_timePicker'];

$custdate = str_replace('-','_',$post_date);
$custfrom = strstr($custfrom, ':', true);
$from_min = explode(":",$custfrom);
$to_min = explode(":",$custto);
$custto = strstr($custto , ':', true);


$atm = $_POST['atmid'];
// $path = 'D:\FTP_DATA\share';
$path = 'E:\FTP_DATA\HIKVISION\share';
$limit = 10; 
$adjacents = 3;
$targetpage = '../../pagination1.php';
$allImages = [];
//echo $custfrom;echo '</br>';echo $custto;

?>

<form action="merge_video.php" method="POST">
<!-- <input type="submit" name="submit" value="Merge">     -->
<div class="row">
<?php   $count = 0 ; 
for ($i=$custfrom; $i <= $custto ; $i++) { 
  $z = $custfrom;
//$i = number_format($i); 
$i = strval($i);
$j = $i;
if($count>0){
if($i<10){
	$j = '0'.$j;
}
if($z<10){
	$z = '0'.$z;
}
}
      $fromimage_dir = $path .'/'.$atmid.'/'.$custdate.'/'.$j;
    //echo $fromimage_dir;
    $files = scandir($fromimage_dir);
  
    if($files){
        
       
        foreach($files as $f=>$v){
			$files_min = explode("_",$v);
			$pass = 1;
			if($i==strval($custto)){ 
				if($files_min[2]<=$to_min[1]){ 
					$pass = 1;
				}else{ 
					$pass = 0;
				}
			}
			if($pass==1){
				if(strlen($v) > 5){ ?>
				<div class="col-md-3" >
					<?php  $custvar = $path .'/'.$atmid.'/'.$custdate.'/'.$z .'/'.$v; 

					?>

					



				  <a href="http://103.141.218.26:5007/?name=<?php echo $custvar; ?>" target="_blank">
					  <p style="height: 200px; border: 1px solid; padding: 10px; position:relative;background:#17a2b8;color: white;">
						  <span style="width: 100%;text-align: center; width: 100%;position: absolute; top: 35%;    font-size: 40px;">Play</span>
					  </p>
				  </a>
				  <input type="hidden" value="<?php echo $fromimage_dir .'/' .$v; ?>" name="videos[]">        
				  <input type="hidden" name="video_name[]" value="<?php echo $v;  ?>">
				  <p style="word-wrap: break-word;">
				  
				  <a class="download" href="<?php echo $fromimage_dir .'/' .$v; ?>">Ready Download </a>
				  <?php echo $v; ?>
						  </p>
					</div>
				<?php 
				$count++;
				}
			}
        }    
    }
$custfrom++ ; 

}
?>
</div>
</form>


</div>

<h1>Total <?php echo $count;  ?></h1>


<?php  } ?>





<?php 

if(isset($_POST['merge'])){




function execInBackground($cmd) { 
    if (substr(php_uname(), 0, 7) == "Windows"){ 
        pclose(popen("start /B ". $cmd, "r"));  
    } 
    else { 
        exec($cmd . " > /dev/null &");   
    } 
}






$custto = $_POST['To_timePicker'];
$custfrom = $_POST['From_timePicker'];

$custdate = str_replace('-','_',$post_date);
$custfrom = strstr($custfrom, ':', true);
$custto = strstr($custto , ':', true);

$atm = $_POST['atmid'];
$path = 'E:\FTP_DATA\HIKVISION\share';

 $_count = 0 ; 
for ($i=$custfrom; $i <= $custto ; $i++) { 

//$i = number_format($i);
$i = strval($i);
$j = $i;
if($_count>0){
if($i<10){
	$j = '0'.$j;
}
}
      $fromimage_dir = $path .'/'.$atmid.'/'.$custdate.'/'.$j;

    $files = scandir($fromimage_dir);

    if($files){
        $files_min = explode("_",$v);
			$pass = 1;
			if($i==strval($custto)){ 
				if($files_min[2]<=$to_min[1]){ 
					$pass = 1;
				}else{ 
					$pass = 0;
				}
			}
			if($pass==1){  
       
        foreach($files as $f=>$v){
            if(strlen($v) > 5){ 
              $_count++;

              $video_file[] = $fromimage_dir .'/' .$v;         
          }
        }
            }


  }
  $custfrom++;
}

// To Delete previous videos  before next merge
$folder_path = "merge_video";
   
$files = glob($folder_path.'/*'); 
foreach($files as $file) {   
    if(is_file($file)) {
        unlink($file); 
    }
}
// End Delete



foreach ($video_file as $key => $value) {
	$source = $value; 
	$filename1 = basename($value);
	$destination = 'merge_video/'.$filename1;
	copy($source, $destination) ; 
}


 
$content = "";
$vid=0;


foreach($video_file as $file) {   
    if(is_file($file)) {
        $filename = basename($file);
          $content .= "file " . 'merge_video/'.$filename . "\n";   
  ++$vid;
    }
}

    file_put_contents("mylist.txt", $content);

    unlink('output.mp4');
    execInBackground('ffmpeg -f concat -i mylist.txt -c copy output.mp4');  ?>



<div class="row">
    <div class="col-sm-4">
<h3><?php echo 'Merging '.$vid. ' Videos' ;?></h3>
            <p id="download_merge_video" style="display:none;"><a href="output.mp4" download>Download Merge Video</a></p>

    </div>
    <div class="col-sm-8">

    		<div id="video-container">
			
			</div>

    </div>
</div>




<?php  } ?>

 
                 </div>
              </div>
            </div>
        </div>
     </div>


    <?php include('footer.php');?>
     <script src="../../vendors/js/vendor.bundle.base.js">
        </script>
        <script src="../../vendors/js/vendor.bundle.addons.js">
        </script>
        
        <script src="../../js/off-canvas.js">
        </script>
        <script src="../../js/hoverable-collapse.js">
        </script>
        <script src="../../js/misc.js">
        </script>
        <script src="../../js/settings.js">
        </script>
        <script src="../../js/todolist.js">
        </script>







<script>
    $(document).ready(function($) {

	  if (window.history && window.history.pushState) {

		//window.history.pushState('forward', null, './#forward');

		$(window).on('popstate', function() {
		  location.reload(true);
		});

	  }
	});


	$("#video-container").html('<h2>Waiting to Merge Videos <span id="progressBar"></span> seconds.</h2>');

var timeleft = 11;
var downloadTimer = setInterval(function(){
  if(timeleft <= 0){
    clearInterval(downloadTimer);
  }

  timeleft -= 1;
  
  if(timeleft==0){
	  $('#download_merge_video').css('display','block');
  }

   $("#progressBar").html(timeleft) ;
  console.log(timeleft);
}, 1000);






setTimeout(function(){

	var cust_video = '<video id="video" width="100%" style="border: 1px solid #02c0ce;" poster="http://103.141.218.26:8080/ComfortTechnoNew/ffmpeg/bin/output.mp4" controls="controls" preload="none"><source type="video/mp4" src="http://103.141.218.26:8080/ComfortTechnoNew/ffmpeg/bin/output.mp4" /><source type="video/webm" src="http://103.141.218.26:8080/ComfortTechnoNew/ffmpeg/bin/output.mp4" /><source type="video/mp4" src="http://103.141.218.26:8080/ComfortTechnoNew/ffmpeg/bin/output.mp4" /><source type="video/ogg" src="http://103.141.218.26:8080/ComfortTechnoNew/ffmpeg/bin/output.mp4" /><object width="100%" height="400" type="application/x-shockwave-flash" data="flashmediaelement.swf"><param name="movie" value="flashmediaelement.swf" /><param name="flashvars" value="controls=true&file=http://103.141.218.26:8080/ComfortTechnoNew/ffmpeg/bin/output.mp4" /><img src="../../assets/images/my4.jpg" width="320" height="240" title="No video playback capabilities" /></object></video>';

$("#video-container").html(cust_video);

	 },10000);




    $(".download").on('click',function(e){
        $("#readyd").remove();
        var video_file = $(this).attr('href');


$.ajax({
                        type: "POST",
                        url: '../../copy_video.php',
                        data: 'video_file='+video_file,

                        success:function(msg) {
                        }
                    });

        $( this ).after('<p id="readyd" ><a id= "download" href = "http://103.141.218.26:8080/ComfortTechnoNew/copy_video/video.mp4" download = "download">download</a></p>');
        setTimeout(function(){ 
                $("#download").click();
                 },1000);
});
</script>








      <script>
    function searchfile(){

     var S_date= document.getElementById("S_date").value;
     var atmid= document.getElementById("atmid").value;
     
     
     if(S_date=="" || atmid==''){
         alert("Please Select Both Date and ATM"); 
     }
    else{
     
     $('#spinner').show();
     
      $.ajax({
           type:'POST',
          url:'../../search_videos.php',
          data:"S_date="+S_date+'&atmid='+atmid,
          success:function(msg){
             // alert(msg); 
             $('#spinner').hide(); 
              document.getElementById("show_data").innerHTML=msg;
             $("#hd1").hide();
          }
      })
      
     }
    }

</script>

      <script src="../../plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>

<script>
jQuery(document).ready(function () {

   // Date Picker
   jQuery('#S_date').datepicker({
        autoclose: true,
        todayHighlight: true
    });


 
});

</script>



    </body>
</html>

  







        <!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
        <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>-->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<link rel="stylesheet" type="text/css" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/base/jquery-ui.css" />

         <script>
         var atm=[];
    function AutoLoad(){
         $.ajax({
           type:'POST',
          url:'../../GetAtmId.php',
          data:"",
          success:function(msg){
           //   alert(msg);
                var jsr=JSON.parse(msg);
                for(var i=0;i<jsr.length;i++){
                           atm.push(jsr[i]['atm']);
                }
                   test();    
            }
      })
    }
         
       function test(){
  $("#S_atmid").autocomplete({
    source:atm,
    minLength: 1
  });
}

function onchange_atmid() {
	var bank = $("#Bank").val();
	$.ajax({
		type: "GET",
		url: "../../getMasterData.php", 
		data: {bank:bank},
		dataType: "html",
		success: (function (result) {
			$("#AtmID").html('');
			$("#AtmID").html(result);
		})
	})
}
function onchangebank() { 
	var client = $("#Client").val();
	$.ajax({
		type: "GET",
		url: "../../getMasterData.php", 
		data: {client:client},
		dataType: "html",
		success: (function (result) {
			$("#Bank").html('');
			$("#Bank").html(result);
		})
	})
}	

function onchangeatmid() {
	var bank = $("#Bank").val();
	var client = $("#Client").val();
	$.ajax({
		type: "GET",
		url: "../../getMasterData.php", 
		data: {videobank:bank,videoclient:client},
		dataType: "html",
		success: (function (result) {
			$("#AtmID").html('');
			$("#AtmID").html(result);
		})
	})
}

$('#AtmID').change(function(){
	var selectatmid = $('#AtmID').val();
	if($("#atm_id option[value="+selectatmid+"]").length == 0){
		alert('Please select another atmid');
		
	}else{
		$("#atmid").val(selectatmid);
		$("#selected_atm_id").val(selectatmid);
	}
})

</script>


        <!-- jQuery  -->
     <!--   <script src="../../assets/js/jquery.min.js"></script>
        <script src="../../assets/js/bootstrap.bundle.min.js"></script>
        <script src="../../assets/js/waves.js"></script>
        <script src="../../assets/js/jquery.slimscroll.js"></script>-->

        <!-- plugin js -->
        <!--<script src="../../plugins/moment/moment.js"></script>-->
        <script src="../../plugins/bootstrap-timepicker/bootstrap-timepicker.js"></script>
       <script src="../../plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js"></script>
       <script src="../../plugins/clockpicker/js/bootstrap-clockpicker.min.js"></script>
        <!--   <script src="../../plugins/bootstrap-daterangepicker/daterangepicker.js"></script>-->
      <script src="../../plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>

      

<script>
jQuery(document).ready(function () {

   // Date Picker
   jQuery('#S_date').datepicker({
        autoclose: true,
        todayHighlight: true
    });


    //Clock Picker
    $('.clockpicker').clockpicker({
        donetext: 'Done'
    });

 
});

</script>


      






<!-- large modal -->

<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="myModalLabel">Update</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

      </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>

        <!--<button type="button" class="btn btn-primary">Save changes</button>-->
      </div>
    </div>
  </div>
</div>

               