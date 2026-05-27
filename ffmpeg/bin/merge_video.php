<?php include('../../functions.php');

include("../../header.php");


    include("../../config.php");
    //include('header.php');
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




<!DOCTYPE html>
<html>
<head>
  <title></title>

<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
        <!-- DataTables -->
        <link href="../../plugins/datatables/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css" />
        <link href="../../plugins/datatables/buttons.bootstrap4.min.css" rel="stylesheet" type="text/css" />
        
         <!-- Spinkit css -->
        <link href="../../plugins/spinkit/spinkit.css" rel="stylesheet" />

        <!-- App css -->
 <!--        <link href="../../assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="../../assets/css/icons.css" rel="stylesheet" type="text/css" />
        <link href="../../assets/css/style.css" rel="stylesheet" type="text/css" />
 -->

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



<?php
 
// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);



function execInBackground($cmd) { 
    if (substr(php_uname(), 0, 7) == "Windows"){ 
        pclose(popen("start /B ". $cmd, "r"));  
    } 
    else { 
        exec($cmd . " > /dev/null &");   
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



$video_file = $_POST['videos'];
$video_name = $_POST['video_name'];

foreach ($video_file as $key => $value) {


  $source = $value; 
        $filename1 = basename($value);
 $destination = 'merge_video/'.$filename1;
  copy($source, $destination) ; 

}


  
if (isset($_POST["submit"]))
{
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
echo '<br>';   
echo '<br>';   


echo '<br>';   
?>




<div class="row">
    <div class="col-sm-4">
<h3><?php echo 'Merging '.$vid. ' Videos' ;?></h3>
            <p><a href="output.mp4" download>Download Merge Video</a></p>

            <p><a href="#" id="back">Go Back</a></p>

    </div>
    <div class="col-sm-8">
        
<video width="100%" style="border: 1px solid #02c0ce;" poster="http://103.72.141.218:8080/comfort/ffmpeg/bin/output.mp4" controls="controls" preload="none">
      <!-- MP4 for Safari, IE9, iPhone, iPad, Android, and Windows Phone 7 -->
      <source type="video/mp4" src="http://103.72.141.218:8080/comfort/ffmpeg/bin/output.mp4" />
      <!-- WebM/VP8 for Firefox4, Opera, and Chrome -->
      <source type="video/webm" src="http://103.72.141.218:8080/comfort/ffmpeg/bin/output.mp4" />
       <!-- M4V for Apple -->
      <source type="video/mp4" src="http://103.72.141.218:8080/comfort/ffmpeg/bin/output.mp4" />
      <!-- Ogg/Vorbis for older Firefox and Opera versions -->
      <source type="video/ogg" src="http://103.72.141.218:8080/comfort/ffmpeg/bin/output.mp4" />
      <!-- Flash fallback for non-HTML5 browsers without JavaScript -->
      <object width="100%" height="400" type="application/x-shockwave-flash" data="flashmediaelement.swf">
          <param name="movie" value="flashmediaelement.swf" />
          <param name="flashvars" value="controls=true&file=http://103.72.141.218:8080/comfort/ffmpeg/bin/output.mp4" />
          <!-- Image as a last resort -->
          <img src="assets/img/myVideo.jpg" width="320" height="240" title="No video playback capabilities" />
      </object>
  </video>

    </div>
</div>





<script>
    $("#back").on('click',function(){
        window.history.back();
    })
</script>



                    </div>
                </div>
                <!-- end page title end breadcrumb -->


            </div>
        </div>




      <script src="../../plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>



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

       



        <!-- plugin js -->
        <!--<script src="../../plugins/moment/moment.js"></script>-->
        <script src="../../plugins/bootstrap-timepicker/bootstrap-timepicker.js"></script>
       <script src="../../plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js"></script>
       <script src="../../plugins/clockpicker/js/bootstrap-clockpicker.min.js"></script>
        <!--   <script src="../../plugins/bootstrap-daterangepicker/daterangepicker.js"></script>-->
      <script src="../../plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>

      




      

        <!-- App js -->
        <script src="../../assets/js/jquery.core.js"></script>
        <script src="../../assets/js/jquery.app.js"></script>
