<?php include('../../functions.php');

include("../../header.php");
error_reporting(0);
date_default_timezone_set("Asia/Calcutta"); 
$current_datetime = date('Y-m-d H:i:s');

$now   = time();



if( $_REQUEST['type']=='Hickvision'){

$path = 'D:\FTP_DATA\share' ;
$files = scandir($path);
foreach ($files as $key => $value) {

    $allinfo = explode('_', $value);
    
    $atm = $allinfo[0];
        if(strlen($atm)>5){
            $all_atm[]=$atm;
            }
    }
}else if($_REQUEST['type']=='CPPlus'){

$path = 'D:\FTP_DATA\CPCLOUD' ;
$files = scandir($path);
foreach ($files as $key => $value) {

    $allinfo = explode('_', $value);
    
    $atm = $allinfo[0];
        if(strlen($atm)>5){
            $all_atm[]=$atm;
            }
    }



}


    include("../../config.php");
    //include('../../header.php');
    include('../../script.php');
    
    ?>
        <!-- DataTables -->
        <link href="../../plugins/datatables/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css" />
        <link href="../../plugins/datatables/buttons.bootstrap4.min.css" rel="stylesheet" type="text/css" />
        
         <!-- Spinkit css -->
        <link href="../../plugins/spinkit/spinkit.css" rel="stylesheet" />

        <!-- App css -->
        <link href="../../assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="../../assets/css/icons.css" rel="stylesheet" type="text/css" />
        <link href="../../assets/css/style.css" rel="stylesheet" type="text/css" />


        <script src="../../assets/js/modernizr.min.js"></script>

            <!-- Plugins css -->
        <link href="../../plugins/bootstrap-timepicker/bootstrap-timepicker.min.css" rel="stylesheet">
        <link href="../../plugins/bootstrap-colorpicker/css/bootstrap-colorpicker.min.css" rel="stylesheet">
        <link href="../../plugins/bootstrap-datepicker/css/bootstrap-datepicker.min.css" rel="stylesheet">
        <link href="../../plugins/clockpicker/css/bootstrap-clockpicker.min.css" rel="stylesheet">
        <link href="../../plugins/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet">
 <!-- Spinkit css -->

        <script src="../../assets/js/modernizr.min.js"></script>





        
<!-- ajax -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>



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

<!DOCTYPE html>
<html>
<head>
  <title></title>
  <!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

<!-- Optional theme -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
        <!-- DataTables -->
        <link href="../../plugins/datatables/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css" />
        <link href="../../plugins/datatables/buttons.bootstrap4.min.css" rel="stylesheet" type="text/css" />
        
         <!-- Spinkit css -->
        <link href="../../plugins/spinkit/spinkit.css" rel="stylesheet" />

        <!-- App css -->
        <link href="../../assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="../../assets/css/icons.css" rel="stylesheet" type="text/css" />
        <link href="../../assets/css/style.css" rel="stylesheet" type="text/css" />


        <script src="../../assets/js/modernizr.min.js"></script>
        
<!-- ajax -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    

<style type="text/css">
  .pagination a {
    margin: auto 10px ;
    </style>
</style>
</head>
        <body>
            <?php include('menu.php');?>

                                <div class="wrapper">
            <div class="container-fluid">

                <!-- Page-Title -->
                                <!-- Page-Title -->
                <div class="row">
                    <div class="col-sm-12">
                        <div class="page-title-box">
                            <div class="btn-group float-right">
                                <ol class="breadcrumb hide-phone p-0 m-0">
                                    <li class="breadcrumb-item" active><a href="../../../../ATM_Data.php">ATM File Manager</a></li>
                                    
                                </ol>
                            </div>
                            <h4 class="page-title">ATM File Manager</h4>
                     
       
                               <div class="card-box">
                            

  <form method="POST" action="video.php?type=<?php echo $_REQUEST['type']; ?>">
      
       <div class="row">

       			<div class="col-sm-2">
                    <label>Select Type </label>
       				<select name="" id="" class="form-control" onchange="this.options[this.selectedIndex].value && (window.location = this.options[this.selectedIndex].value);">
       					<option value="">Select</option>
       					<option value="?type=Hickvision" <?php if($_REQUEST['type']=='Hickvision'){ echo 'selected';} ?>>Hickvision</option>
       					<option value="?type=CPPlus" <?php if($_REQUEST['type']=='CPPlus'){ echo 'selected';} ?>>CPPlus</option>
       				</select>
       			</div>



       	<div class="col-md-2">  
                    <div class="form-group">
                        <label>Select ATM ID </label>
                           <select class="form-control" name="atmid" id="atmid">

                                <?php 
                                foreach ($all_atm as $atm_key => $atm_value) { ?>
    
                                    <option value="<?php echo $atm_value ;  ?>" <?php if($_POST['atmid']==$atm_value){ echo ' selected'; } ?>><?php echo $atm_value ;  ?></option>

                                <?php } ?>
                           </select>
                    </div>
                </div>


              <div class="col-md-2"> 
                           <div class="form-group">
                                    <label>Date</label>
                                    <div>
                                        <div class="input-group">
                                            <input type="text" class="form-control" placeholder="mm/dd/yyyy" id="S_date" name="S_date" value="<?php if($_POST['S_date']){ echo $_POST['S_date']; }?>" autocomplete="off" required>
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
                                <div class="input-group clockpicker" data-placement="top" data-align="top" data-autoclose="true">
                                    <input type="text" class="form-control" id="From_timePicker" name="From_timePicker" autocomplete="off" value="<?php if($_POST['From_timePicker']){ echo $_POST['From_timePicker']; } else{ echo '00:00'; } ?>">
                                    <div class="input-group-append">
                                        <span class="input-group-text"><i class="mdi mdi-clock"></i></span>
                                    </div>
                                </div>
                                </div>
                                </div>


                                <div class="col-md-2">     
                                      
                                      
                                            <div class="form-group">
                                             <label>To Time</label>
                                            <div class="input-group clockpicker" data-placement="top" data-align="top" data-autoclose="true">
                                                <input type="text" class="form-control" id="To_timePicker" name="To_timePicker" value="<?php if($_POST['To_timePicker']){ echo $_POST['To_timePicker']; } else{ echo '00:00'; } ?>" autocomplete="off">
                                                <div class="input-group-append">
                                                    <span class="input-group-text"><i class="mdi mdi-clock"></i></span>
                                                </div>
                                            </div>
                                          </div>
                                      
                                      
                                        
                                    </div>              
                <div class="col-md-2">  
			<input type="submit" name="submit" value="Search" class="btn btn-primary"  style="margin-top: 33px;">
			<input type="submit" name="merge" value="Merge" class="btn btn-danger"  style="margin-top: 33px;">
                </div>
      </div>

  </form>

                        </div>




        
                        </div>
                    </div>
                </div>
                <!-- end page title end breadcrumb -->


            </div>
        </div>


<div class="container-fluid">
    

    

<?php
if(isset($_POST['submit'])){


$custto = $_POST['To_timePicker'];
$custfrom = $_POST['From_timePicker'];

if( $_REQUEST['type']=='Hickvision'){

$custdate = str_replace('-','_',$post_date);
$custfrom = strstr($custfrom, ':', true);
$custto = strstr($custto , ':', true);
$path = 'D:\FTP_DATA\share';


?>

<form action="merge_video.php" method="POST">
<!-- <input type="submit" name="submit" value="Merge">     -->
<div class="row">
<?php  
for ($i=$custfrom; $i <= $custto ; $i++) { 
  
$i = number_format($i);
      $fromimage_dir = $path .'/'.$atmid.'/'.$custdate.'/'.$i;
    
    $files = scandir($fromimage_dir);

    if($files){

        $count = 0 ; 
        foreach($files as $f=>$v){
            if(strlen($v) > 5){ ?>
            <div class="col-md-3" >
                <?php  $custvar = $atmid.'/'.$custdate.'/'.$custfrom .'/'.$v; 

                ?>

                



              <a href="http://103.72.141.218:5007/?name=<?php echo $custvar; ?>" target="_blank">
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
            <?php }
            $count++;
        }    
    }
$custfrom++ ; 

}
?>
</div>
</form>



</div>

<h1>Total <?php echo $count;  ?></h1>


<?php }

elseif( $_REQUEST['type']=='CPPlus'){


 $custdate = $post_date;
$custfrom = strstr($custfrom, ':', true);
$custto = strstr($custto , ':', true);
$path = 'D:\FTP_DATA\CPCLOUD' ;

?>

<form action="merge_video1.php" method="POST">
<!-- <input type="submit" name="submit" value="Merge">     -->
<div class="row">
<?php  
for ($i=$custfrom; $i <= $custto ; $i++) { 
  
$i = number_format($i);
 $fromimage_dir = $path .'/'.$atmid.'/'.$custdate.'/001/dav/'.$i;
    echo '<br>';
    $files = scandir($fromimage_dir);

    if($files){

        $count = 0 ; 
        foreach($files as $f=>$v){
            if(strlen($v) > 5){ ?>
            <div class="col-md-3" >
                <?php  $custvar = $atmid.'/'.$custdate.'/'.$custfrom .'/'.$v; 

                ?>

                



              <a href="http://103.72.141.218:5007/?name=<?php echo $custvar; ?>" target="_blank">
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
            <?php }
            $count++;
        }    
    }
$custfrom++ ; 

}
?>
</div>
</form>

<?php


}

 } ?>





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

if( $_REQUEST['type']=='Hickvision'){
$custdate = str_replace('-','_',$post_date);
$custfrom = strstr($custfrom, ':', true);
$custto = strstr($custto , ':', true);

$atm = $_POST['atmid'];
$path = 'D:\FTP_DATA\share';


for ($i=$custfrom; $i <= $custto ; $i++) { 

$i = number_format($i);
      $fromimage_dir = $path .'/'.$atmid.'/'.$custdate.'/'.$i;

    $files = scandir($fromimage_dir);

    if($files){

        $count = 0 ; 
        foreach($files as $f=>$v){
            if(strlen($v) > 5){ 
              $video_file[] = $fromimage_dir .'/' .$v;         
          }
      }
  }
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
    execInBackground('ffmpeg -f concat -i mylist.txt -c copy output.mp4');  
}









else if( $_REQUEST['type']=='CPPlus'){



$custdate = $post_date;
$custfrom = strstr($custfrom, ':', true);
$custto = strstr($custto , ':', true);

$atm = $_POST['atmid'];
$path = 'D:\FTP_DATA\CPCLOUD' ;



for ($i=$custfrom; $i <= $custto ; $i++) { 

$i = number_format($i);
      // $fromimage_dir = $path .'/'.$atmid.'/'.$custdate.'/'.$i;
 $fromimage_dir = $path .'/'.$atmid.'/'.$custdate.'/001/dav/'.$i;
    $files = scandir($fromimage_dir);


    if($files){

        $count = 0 ; 
        foreach($files as $f=>$v){
			 $ext = pathinfo($v, PATHINFO_EXTENSION);
            if(strlen($v) > 5 && $ext=='dav_'){ 
              $video_file[] = $fromimage_dir .'/' .$v;         
          }
      }
  }
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

    unlink('output.dav_');
    execInBackground('ffmpeg -f concat -i mylist.txt -c copy output.dav_');  
}


?>






<div class="row">
    <div class="col-sm-4">
<h3><?php echo 'Merging '.$vid. ' Videos' ;?></h3>
            <p><a href="output.mp4" download>Download Merge Video</a></p>

    </div>
    <div class="col-sm-8">

    		<div id="video-container"></div>

    </div>
</div>




<?php  } ?>

















<script>
	$("#video-container").html('<h2>Waiting to Merge Videos <span id="progressBar"></span></h2>');

var timeleft = 11;
var downloadTimer = setInterval(function(){
  if(timeleft <= 0){
    clearInterval(downloadTimer);
  }

  timeleft -= 1;

   $("#progressBar").html(timeleft) ;
  console.log(timeleft);
}, 1000);






setTimeout(function(){

	var cust_video = '<video id="video" width="100%" style="border: 1px solid #02c0ce;" poster="http://103.72.141.218:8080/ComfortNew/ffmpeg/bin/output.mp4" controls="controls" preload="none"><source type="video/mp4" src="http://103.72.141.218:8080/ComfortNew/ffmpeg/bin/output.mp4" /><source type="video/webm" src="http://103.72.141.218:8080/ComfortNew/ffmpeg/bin/output.mp4" /><source type="video/mp4" src="http://103.72.141.218:8080/ComfortNew/ffmpeg/bin/output.mp4" /><source type="video/ogg" src="http://103.72.141.218:8080/ComfortNew/ffmpeg/bin/output.mp4" /><object width="100%" height="400" type="application/x-shockwave-flash" data="flashmediaelement.swf"><param name="movie" value="flashmediaelement.swf" /><param name="flashvars" value="controls=true&file=http://103.72.141.218:8080/ComfortNew/ffmpeg/bin/output.mp4" /><img src="assets/img/myVideo.jpg" width="320" height="240" title="No video playback capabilities" /></object></video>';

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

        $( this ).after('<p id="readyd" ><a id= "download" href = "http://103.72.141.218:8080/comfort/copy_video/video.mp4" download = "download">download</a></p>');
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


        <!-- jQuery  -->
        <script src="../../assets/js/jquery.min.js"></script>
        <script src="../../assets/js/bootstrap.bundle.min.js"></script>
        <script src="../../assets/js/waves.js"></script>
        <script src="../../assets/js/jquery.slimscroll.js"></script>

        <!-- App js -->
        <script src="../../assets/js/jquery.core.js"></script>
        <script src="../../assets/js/jquery.app.js"></script>

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


      

        <!-- App js -->
        <script src="../../assets/js/jquery.core.js"></script>
        <script src="../../assets/js/jquery.app.js"></script>







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

