<!DOCTYPE html>
<html lang="en">
<?php session_start();
     if(!isset($_SESSION['username'])){  ?>
	        <script>
				window.location.href="../../login.php";
			</script>
<?php	 }
        $user_id = $_SESSION['userid'];
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
		  //echo '<pre>';print_r($atmidlistarr);echo '</pre>';
	  }
	  function ftpRecursiveFileListing($ftpConnection, $path) {
			static $allFiles = array();
			$contents = ftp_nlist($ftpConnection, $path);

			foreach($contents as $currentFile) {
				// assuming its a folder if there's no dot in the name
				if (strpos($currentFile, '.') === false) {
					ftpRecursiveFileListing($ftpConnection, $currentFile);
				}
				$allFiles[$path][] = substr($currentFile, strlen($path) + 1);
			}
			return $allFiles;
		}
		
		function tempdir() {
			$tempfile=tempnam(sys_get_temp_dir(),'');
			// tempnam creates file on disk
			if (file_exists($tempfile)) { unlink($tempfile); }
			mkdir($tempfile);
			if (is_dir($tempfile)) { return $tempfile; }
		}
		
		function ftp_copy($conn_distant , $pathftp , $pathftpimg ,$img){ 
		       // $temp_fol = tempdir();
			   $dir = __DIR__.'/temp/';
				# See if directory exists, create if not
				if(!is_dir($dir))
					mkdir($dir,0755,true);
				$d_drive = "D:\FTP_VIDEO";
				if(!is_dir($d_drive))
				   mkdir($d_drive,0755,true);
			   $parent_dest = $d_drive.$pathftpimg;
			   $destination = $d_drive.$pathftpimg.'/'.$img;
			   if(ftp_get($conn_distant, $dir.'/'.$img, $pathftp.'/'.$img ,FTP_BINARY)){ 
			        $src = $dir.'/'.$img;
					if (!is_dir($parent_dest)) {
					  mkdir(dirname($destination ), 0777, true);
					}
					
					if( !copy($src, $destination) ) { 
						return false; 
					} 
					else { 
						unlink($dir.'/'.$img) ;
					} 
					/*if(ftp_put($conn_distant, $pathftpimg.'/'.$img ,TEMPFOLDER.$img , FTP_BINARY)){ 
							unlink(TEMPFOLDER.$img) ;                                              
					} else{                                
							return false; 
						}  */

				}else{ 
						return false ; 
				} 
				return true ; 
		}

   
	if(isset($_POST['Client'])){
		$post_client = $_POST['Client'];
		 $_bank_name = "";
		 $_bank_name_array = [];
		if($_SESSION['bankname']!=''){ echo $_SESSION['bankname'];
			$banks = explode(",",$_SESSION['bankname']);
		  
		   for($i=0;$i<count($banks);$i++){
			   $_bank = explode("_",$banks[$i]);
			   if($_bank[0]==$post_client){
				   array_push($_bank_name_array,$_bank[1]);
			   }
		   } 
			$_bank_name=json_encode($_bank_name_array);
			$_bank_name=str_replace( array('[',']','"') , ''  , $_bank_name);
			$bankarr=explode(',',$_bank_name);
			$_bank_name = "'" . implode ( "', '", $bankarr )."'";
			
		}
		if($_bank_name!=""){
		$sitesbank_sql = "select Bank from sites where Customer='".$post_client."' AND Bank IN (".$_bank_name.") AND live='Y' group by Bank";
		}else{
			$sitesbank_sql = "select Bank from sites where Customer='".$post_client."' AND live='Y' group by Bank";
		}
		//echo $sitesbank_sql;
		$postbanklist = mysqli_query($con,$sitesbank_sql);
		
		$_circle_name = "";
		$_circle_name_array = array();
		if($_SESSION['circlename']!=''){
		    $assign_circle = explode(",",$_SESSION['circlename']);
		    $_circle_name = [];
			for($i=0;$i<count($assign_circle);$i++){
			   $_circle = explode("_",$assign_circle[$i]);
			   array_push($_circle_name,$_circle[1]);
			} 
			//$_circle_name = $_circle_name_array;
			$_circle_name=json_encode($_circle_name);
			$_circle_name=str_replace( array('[',']','"') , ''  , $_circle_name);
			$circlearr=explode(',',$_circle_name);
			$_circle_name = "'" . implode ( "', '", $circlearr )."'";
		}
		$_pst_bnk = $_POST['Bank'];
		if($_circle_name!=""){
			
			$sitesbankcircle_sql = "select Circle from site_circle where Bank='".$_pst_bnk."' AND Circle IN (".$_circle_name.") group by Circle";
		    
		}else{
			$sitesbankcircle_sql = "select Circle from site_circle where Bank='".$_pst_bnk."' group by Circle";
		}
		$postbankcirclelist = mysqli_query($con,$sitesbankcircle_sql);
	}
	
//error_reporting(0);
date_default_timezone_set("Asia/Calcutta"); 
$current_datetime = date('Y-m-d H:i:s');

$now   = time();

$ftp_conn = OpenFTPCon();
$ftp_pasv = ftp_pasv($ftp_conn,true);

$file_list = ftp_nlist($ftp_conn, ".");
	//echo '<pre>';print_r($file_list);echo '</pre>';die;
	$today_date = date('Y-m-d');
	/*
	$atm_present_array = array();
	for($i=0;$i<count($file_list);$i++){
		if($file_list[$i]=='./AI_Feed'){
		    $file_list_share = ftp_nlist($ftp_conn, "./AI_Feed");
			echo '<pre>';print_r($file_list_share);echo '</pre>';die;
		    for($j=0;$j<count($file_list_share);$j++){
				$atm = explode('/',$file_list_share[$j]); 
				for($p=0;$p<count($atmidlistarr);$p++){
				   if($atm[2]==$atmidlistarr[$p]){
					   $atm_present_array[]=$atm;
					}
				}
		    }	  
		}
	} */

$ftp_conn_local = OpenComfortFTPLocalCon();
$ftp_pasv_local = ftp_pasv($ftp_conn_local,true);
 
$ftp_conn_1 = OpenFTPCon();
//$ftp_conn_1 = OpenFTPCon();
$ftp_pasv_1 = ftp_pasv($ftp_conn_1,true);
 
$file_list = ftp_nlist($ftp_conn_1, ".");
//$buff = ftp_rawlist($ftp_conn, '/');
//$atmfile_list_share1 = ftp_nlist($ftp_conn,"AI_Feed/N4410900/2022_11_10/13"); 
$atmfile_list_share = ftp_nlist($ftp_conn_local,"AI_Feed/B1005900"); 
echo '<pre>';print_r($atmfile_list_share);echo '</pre>';
$atmfile_list_share1 = ftp_nlist($ftp_conn_local,"AI_Feed/B1005900/2023_02_15");  
echo '<pre>';print_r($atmfile_list_share1);echo '</pre>';die;
//$atmfile_list_share1 = ftp_nlist($ftp_conn,"AI_Feed"); 
$today = date('Y-m-d');
$date = strtotime($today.' -4 months');
$four_month_date = date('Y-m-d',$date);
$new_four_month_date = str_replace("-","_",$four_month_date);
$file_explode = explode('-',$four_month_date);
$count = 0;
if(count($file_explode)>0){
	for($p=0;$p<count($file_explode);$p++)
	   $count = $count + $file_explode[$p];
}
//echo $four_month_date.'&';
//echo $count;die;
$start_folder = $new_four_month_date;
echo '<pre>';print_r($atmfile_list_share1);echo '</pre>';
for($i=0;$i<count($atmfile_list_share1);$i++){
	$filepath_explode = explode('/',$atmfile_list_share1[$i]);
	if($filepath_explode[2]!='desktop.ini'){
		$datefile_explode = explode('_',$filepath_explode[2]);
		$date_count = 0;
		if(count($datefile_explode)>0){
			for($b=0;$p<count($datefile_explode);$b++)
			   $date_count = $date_count + $datefile_explode[$b];
		}
		if($count==$date_count){
			$start_folder = $new_four_month_date;
		}else{
			if($count<$date_count){  
			  $start_folder = $filepath_explode[2];
			}
		}
	}
}
//echo $start_folder;die;
	$_time_folder = "AI_Feed/N7386900/".$start_folder;
	//echo $_time_folder;die;
	$mainfile_list_share = ftp_nlist($ftp_conn,$_time_folder); 
	echo '<pre>';print_r($mainfile_list_share);echo '</pre>';
	$last_folder_arr = array();
	if(count($mainfile_list_share)>0){
		for($z=0;$z<count($mainfile_list_share);$z++){
			$folderfilepath_explode = explode('/',$mainfile_list_share[$z]);
			if(count($folderfilepath_explode)==4){
			   array_push($last_folder_arr,$folderfilepath_explode[3]);
			}
		}
	}
	
	$max_folder = min($last_folder_arr);
	$_thisfolder_strt = (int)$max_folder;
	$_thisfolder_end = $_thisfolder_strt + 1;
		if($_thisfolder_strt>11){
		   $strt_time = $_thisfolder_strt." PM";
		}else{
		   $strt_time = $_thisfolder_strt." AM";
		}
		if($_thisfolder_end>11){
		   $end_time = $_thisfolder_end." PM";
		}else{
		   $end_time = $_thisfolder_end." AM";
		}
	$sentence = $strt_time." - ".$end_time ; 
	$createdatetime = $start_folder.', '.$sentence;
	echo $createdatetime;die;
	
//$atmfile_list_share = ftp_nlist($ftp_conn_local,"AI_Feed/N4410900/2022_11_14/20");
//$atmfile_list_share = ftp_nlist($ftp_conn_local,"AI_Feed/N7386900/2022_09_05/21"); 
echo '<pre>';print_r($atmfile_list_share);echo '</pre>';die;
$today_date = date('Y-m-d');
for($i=0;$i<count($file_list);$i++){
    if($file_list[$i]=='AI_Feed'){
	    $file_list_share = ftp_nlist($ftp_conn_1, "AI_Feed");
	    for($j=0;$j<count($file_list_share);$j++){
		    $atm = $file_list_share[$j]; 
			for($p=0;$p<count($atmidlistarr);$p++){
			    if($atm==$atmidlistarr[$p]){
				    $all_atm[]=$atm;
				}
			}
        }	  
    }
}
$dt_arr = [];
for($i=0;$i<100;$i++){
	$j = $i + 1;
	$dt = date('Y-m-d', strtotime('today - '.$j.' days'));
	$dt = str_replace("-","_",$dt);
	array_push($dt_arr,$dt);
}
$_actual_atm = [];
$_actual_circle = [];
$cnt = 0;
//echo '<pre>';print_r($dt_arr);echo '</pre>';die;
$circleatmidarray=json_encode($all_atm);
				$circleatmidarray=str_replace( array('[',']','"') , ''  , $circleatmidarray);
				$circlearr=explode(',',$circleatmidarray);
				$circleatmidarray = "'" . implode ( "', '", $circlearr )."'";
				$sql = mysqli_query($con,"select ATMID,SN,SiteAddress,DVRIP,PanelIP,RouterIp from sites where Customer='Hitachi' AND Bank='PNB' AND ATMID IN (".$circleatmidarray.") and live='Y'");
		while($res = mysqli_fetch_assoc($sql)){
			$chatmid = $res['ATMID']; 
			$ch_atm_file = "AI_Feed/".$chatmid;
			$file_list_atm_date = ftp_nlist($ftp_conn_1, $ch_atm_file);
			if(count($file_list_atm_date)>0){
				for($z=0;$z<count($file_list_atm_date);$z++){
				    	if(in_array($file_list_atm_date[$z],$dt_arr)){
							$cnt = $cnt + 1;
						}
				}
				if($cnt>=90){
					$circle_sql_query = mysqli_query($con,"select Circle from site_circle where ATMID='".$chatmid."'");
                    $circle_assoc = mysqli_fetch_assoc($circle_sql_query);
                    $circle_name = $circle_assoc['Circle'];
					if(in_array($circle_name,$_actual_circle)){
						
					}else{
						array_push($_actual_circle,$circle_name);
                    $act_atm_circle = $circle_name." : ".$chatmid; 					
					array_push($_actual_atm,$act_atm_circle);
					}
				}
			}else{
				
			}
			
			if(count($_actual_atm)==5){
				
				echo '<pre>';print_r($_actual_atm);echo '</pre>';die;
			}
			//echo '<pre>';print_r($file_list_atm_date);echo '</pre>';die;
		}
		
	 	

//$file = "AI_Feed/D2142120/2022_04_24/14/2022-04-24_14_06_06.avi";

//echo '<pre>';print_r($all_atm);echo '</pre>';die;
// $path = 'D:\FTP_DATA\share' ;
/*
$path = 'E:\FTP_DATA\HIKVISION\share';

$files = scandir($path);


    foreach ($files as $key => $value) {
        $allinfo = explode('_', $value);
        $atm = $allinfo[0];
        if(strlen($atm)>5){
				for($p=0;$p<count($atmidlistarr);$p++){
				    if($atm==$atmidlistarr[$p]){
				  $all_atm[]=$atm;
					}
				}
            }
    } */

   // echo '<pre>';print_r($all_atm);echo '</pre>';
    
    ?>
       

<?php 
date_default_timezone_set("Asia/Calcutta"); 
$current_datetime = date('Y-m-d H:i:s');
/*
$now   = time();
$path = 'Videos/';
$files = scandir($path);  */
$now   = time();

if(isset($_POST['atmid'])){
  $atmid = $_POST['atmid'];
  $post_date = $_POST['S_date'];
  $post_date = date('Y-m-d',strtotime($post_date));

  $_SESSION['post_d'] = $post_date; 
  $_SESSION['atmid'] = $atmid;
}





if(isset($_SESSION['post_d']) ){
    $post_date  = $_SESSION['post_d']; 
    //$atmid = $_SESSION['atmid']  ;
  } 


if(isset($_POST['From_timePicker']) && isset($_POST['To_timePicker'])){
$from_time = $_POST['From_timePicker'];
$to_time = $_POST['To_timePicker'];

 $from_time = str_replace(':', '', $from_time).'00';
 $to_time = str_replace(':', '', $to_time).'00';


 $new_post_date = str_replace('-', '', $post_date);


  $new_from  =  $new_post_date .'_'. $from_time ; 
  $new_to  =  $new_post_date .'_'. $to_time ; 

}
// return ; 
 ?>
<style>
		.menu-icon
		{
			width: 33px;
			margin-right: 7%;
		}
		.show{display:block;}
		.hide{display:none;}
	</style>
        
<!-- ajax -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    

<style type="text/css">
  .pagination a {
    margin: auto 10px ;
    </style>
</style>
<style>
      #load{
    /*display: none;*/
    width: 100%;
    height: 100%;
    position:fixed;
    z-index:9999;
   /* background:url("image/Circle.svg") no-repeat center center rgba(0,0,0,0.25) */
}
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
			<div id="load" style="display:none;">
			   <!-- <div class="loader-demo-box">
                        <div class="circle-loader"></div>
                      </div>  -->
					  <div class="loader-demo-box">
				<div class="loading">
					<p>Please wait</p>
					<span><i></i><i></i><i></i></span>
				</div>	 
                       </div>     				
			</div>
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
                        
			                            </div>   		
						<div class="col-12 grid-margin">
						   <h3 class="card-title">Videos (If search for today's video then select time 1 hour before from now.)</h3>
                            <div class="card">
                                <div class="card-body">
								   
                <!-- Page-Title -->
                                    <form method="POST" action="pagination_ftp.php">
									     <?php include('../../filters/videoarchive_filter.php'); ?>
                                        <div class="row">
                                            <div class="col-md-2">  
												<div class="form-group">
													<label>Select ATM ID </label>
													   <input type="hidden" id="selected_atm_id" value="" >
													   <input class="form-control" type="text" id="atmid" value="<?php if(isset($_POST['atmid'])){ echo $_POST['atmid']; }?>" name="atmid" required readonly>
													   <select class="form-control" id="atm_id"  style="display:none;">
                                                            <option value="">Select</option>   
															<?php 
															foreach ($all_atm as $atm_key => $atm_value) { ?>
																<?php //if($atm_value=='P3ENMM09' || $atm_value=='HITACHI-Demo' || $atm_value=='TESTDEMO'){?>
																<?php //if (in_array($atm_value, $atmidlistarr)){ ?>
																<option value="<?php echo $atm_value ;  ?>" <?php if(isset($_POST['atmid'])){if($_POST['atmid']==$atm_value){ echo ' selected'; }} ?>><?php echo $atm_value ;  ?></option>
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
																<input type="text" class="form-control" placeholder="mm/dd/yyyy" id="S_date" name="S_date" value="<?php if(isset($_POST['S_date'])){ echo $_POST['S_date']; }?>" required>
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
													<input type="text" class="form-control" id="From_timePicker" name="From_timePicker" value="<?php if(isset($_POST['From_timePicker'])){ echo $_POST['From_timePicker']; } else{ echo '00:00'; } ?>">
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
															<input type="text" class="form-control" id="To_timePicker" name="To_timePicker" value="<?php if(isset($_POST['To_timePicker'])){ echo $_POST['To_timePicker']; } else{ echo '00:00'; } ?>">
															<div class="input-group-append">
																<span class="input-group-text"><i class="mdi mdi-clock"></i></span>
															</div>
														</div>
												</div>
											</div>              
											<div class="col-md-4"> 
										        <input id="video_submit" type="submit" name="submit" value="Search" class="btn btn-primary <?php if(isset($_POST['submit'])){ echo 'hide'; } ?>"  style="margin-top: 30px;">
										       <input id="merge_submit" type="submit" name="merge" value="Merge" class="btn btn-danger <?php if(isset($_POST['submit'])){ echo 'show'; }else{ echo 'hide';} ?>"  style="margin-top: 30px;">
										        <a href="http://103.141.218.26:8080/ComfortTechnoNew/ffmpeg/bin/pagination_ftp.php" class="btn btn-info" style="margin-top: 30px;">Back</a>
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
	 $path = 'AI_Feed';
	//$path = 'E:\FTP_DATA\HIKVISION\share';
	$checkimage_dir = $path .'/'.$atm.'/'.$custdate;
    $checkfiles = ftp_nlist($ftp_conn_local, $checkimage_dir);
	
	$limit = 10; 
	$adjacents = 3;
	$targetpage = '../../pagination_ftp.php';
	$allImages = [];
//echo 'From : '.$custfrom;echo '</br>';echo 'To:'.$custto;echo '</br>';

?>

<form action="merge_video.php" method="POST">
<!-- <input type="submit" name="submit" value="Merge">     -->
<div class="row">
<?php   $count = 0 ; 
$custfrom = (int)$custfrom;
 $custto = (int)$custto;
for ($i=$custfrom; $i <= $custto ; $i++) { 
  $z = $custfrom;
//$i = number_format($i); 
$i = strval($i);
$j = $i;
//if($count>0){
if($i<10){
	$j = '0'.$j;
}
if($z<10){
	$z = '0'.$z;
}
//}
//echo $count."_".$j;
    $fromimage_dir = $path .'/'.$atmid.'/'.$custdate.'/'.$j; 
	
	if(is_array($checkfiles)){
		
		if(in_array($j,$checkfiles)){
			$files = ftp_nlist($ftp_conn_local, $fromimage_dir);
			$whichftp = 1;
		}else{
			$files = ftp_nlist($ftp_conn_1, $fromimage_dir);
			$whichftp = 2;
		}
	}else{
		$files = ftp_nlist($ftp_conn_1, $fromimage_dir);
		$whichftp = 2;
	}
    //echo $fromimage_dir;
   // $files = scandir($fromimage_dir);
   // $files = ftp_nlist($ftp_conn_1, $fromimage_dir);
	//echo '<pre>';print_r($files);echo '</pre>';
    if($files){
      // echo '<pre>';print_r($files);echo '</pre>';die; 
       
        foreach($files as $f=>$v){
            if($v!='desktop.ini'){			
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
						$srcpathftp = $path .'/'.$atmid.'/'.$custdate.'/'.$z;
						$destpathftpimg = '/'.$atmid.'/'.$custdate.'/'.$z;
					//	if ( ftp_get( $ftp_conn, $destpathftpimg, $srcpathftp, FTP_BINARY ) ) 
    
					/*	if (ftp_put($ftp_conn, $v, $v, FTP_ASCII))
						  {
						  echo "Successfully uploaded";
						  }
						else
						  {
						  echo "Error uploading";
						  } */
						if($whichftp == 1){
							ftp_copy($ftp_conn_local , $srcpathftp , $destpathftpimg ,$v);
						}else{
							ftp_copy($ftp_conn_1 , $srcpathftp , $destpathftpimg ,$v);
						}
						$dest_path = "D:/FTP_VIDEO".$destpathftpimg."/".$v;
						$dest_path = str_replace("/","\\\\",$dest_path);
						$view_video_filepath = base64_encode($dest_path);
						$view_video_dwnldpath = base64_encode($custvar);
						?>

					  <a href="video_avi.php?file=<?php echo $view_video_filepath; ?>&downloadfile=<?php echo $view_video_dwnldpath;?>" target="_blank">View</a>
					  <a href="http://103.141.218.26:5007/?name=<?php echo $dest_path; ?>" target="_blank">
						  <p style="height: 200px; border: 1px solid; padding: 10px; position:relative;background:#17a2b8;color: white;">
							  <span style="width: 100%;text-align: center; width: 100%;position: absolute; top: 35%;    font-size: 40px;">Play</span>
						  </p>
					  </a>
					  <input type="hidden" value="<?php echo $fromimage_dir .'/' .$v; ?>" name="videos[]">        
					  <input type="hidden" name="video_name[]" value="<?php echo $v;  ?>">
					  <p style="word-wrap: break-word;">
					  
					  <a href="download_ftp_data.php?file=<?php echo urlencode($custvar);?>"><?php //echo htmlspecialchars($custvar); ?>Ready To Download</a>
					 </br>
					  <?php echo $v; ?>
							  </p>
						</div>
					<?php 
					$count++;
					}
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
	$to_min = explode(":",$custto);
	$custto = strstr($custto , ':', true);
	
	

	$atm = $_POST['atmid'];
	$path = 'D:\FTP_VIDEO';

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
		
		$files = "";
        if(file_exists($fromimage_dir)) 
          $files = scandir($fromimage_dir);
		
		if($files){
		    foreach($files as $f=>$v){
				if($v!='.' && $v!='..'){
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
						if(strlen($v) > 5){ 
						  $_count++;

						  $video_file[] = $fromimage_dir .'/' .$v;         
						}
			  
					}
				}
		    }
	  }
	  $custfrom++;
	}

	//echo '<pre>';print_r($video_file);echo '</pre>';
	// To Delete previous videos  before next merge
	/*
	$dir = __DIR__.'/temp/';
				
				if(!is_dir($dir))
					mkdir($dir,0755,true);
				$d_drive = "D:\FTP_VIDEO";
				if(!is_dir($d_drive))
				   mkdir($d_drive,0755,true);
			   $parent_dest = $d_drive.$pathftpimg;
			   $destination = $d_drive.$pathftpimg.'/'.$img;
			   if(ftp_get($conn_distant, $dir.'/'.$img, $pathftp.'/'.$img ,FTP_BINARY)){ 
			        $src = $dir.'/'.$img;
					if (!is_dir($parent_dest)) {
					  mkdir(dirname($destination ), 0777, true);
					}
					
					if( !copy($src, $destination) ) { 
						return false; 
					} */
	$folder_path = __DIR__."/ftp_video/".$user_id."/merge_video";
	$_folder_video_path = "ftp_video/".$user_id."/merge_video";
	if(!is_dir($folder_path))
		mkdir($folder_path,0755,true);
	
	if(!is_dir($_folder_video_path))
		mkdir($_folder_video_path,0755,true);
	   
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
		$destination = $folder_path.'/'.$filename1;
		if (!is_dir($folder_path)) {
					  mkdir(dirname($destination ), 0777, true);
					}
		
		copy($source, $destination) ; 
	}


	 
	$content = "";
	$vid=0;


	foreach($video_file as $file) {   
		if(is_file($file)) {
			$filename = basename($file);
			  $content .= "file " . $_folder_video_path . '/'.$filename . "\n";   
	  ++$vid;
		}
	}

    $file_listing = "mylist-".$user_id.".txt";
    file_put_contents($file_listing, $content);
	//file_put_contents("ftpvideolist.txt", $content);

    $output_video_file = "ftp_video_".$user_id.".mp4";
    //$output_merge_folder = $folder_path."/output.mp4";
	if(is_file($output_video_file)) {
    unlink($output_video_file);
	}
	
	$command = 'ffmpeg -f concat -i '.$file_listing.' -c copy '.$output_video_file;
	//echo $command;die;
	//$command = 'ffmpeg -f concat -i ftpvideolist.txt -c copy ftp_video.mp4';
    execInBackground($command);  
	//execInBackground('ffmpeg -i input_filename.avi -c:v mpeg4 output_filename.mp4');
	?>



<div class="row">
    <div class="col-sm-4">
<h3><?php echo 'Merging '.$vid. ' Videos' ;?></h3>
            <p id="download_merge_video" style="display:none;"><a href="<?php echo $output_video_file;?>" download>Download Merge Video</a></p>

    </div>
    <div class="col-sm-8">

    		<div id="video-container">
			   </div>

    </div>
</div>




<?php  } 
//ffmpeg -i video.avi -c:v mpeg4 video.mp4
 // $cmd_convert = 'ffmpeg -i input_filename.avi -c:v mpeg4 output_filename.mp4';
 //execInBackground('ffmpeg -i input_filename.avi -c:v mpeg4 output_filename.mp4');
?>
                 <!-- <video controls autoplay width="100%" height="100%"><source src="http://103.141.218.26:8080/ComfortTechnoNew/ffmpeg/bin/ftp_video_24.mp4" type="video/mp4"> Your browser does not support HTML video.</video>
			-->
			
			   <!-- <video width="450"
                       height="250"
                       controls
                       preload="auto">
                    <source src=
"output_filename.mp4"
                       type="video/mp4">
                    
                </video> -->
 
                 </div>
              </div>
            </div>
        </div>
     </div>


    <?php //include('../../footer.php');?>
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

        <script src="../../js/select2.js"></script>





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
    var cust_video = '<video controls autoplay width="100%" height="100%"></video>';
	//var cust_video = '<video id="video" width="100%" style="border: 1px solid #02c0ce;" poster="http://103.141.218.26:8080/ComfortTechnoNew/ffmpeg/bin/output.mp4" controls="controls" preload="none"><source type="video/mp4" src="http://103.141.218.26:8080/ComfortTechnoNew/ffmpeg/bin/output.mp4" /><source type="video/webm" src="http://103.141.218.26:8080/ComfortTechnoNew/ffmpeg/bin/output.mp4" /><source type="video/mp4" src="http://103.141.218.26:8080/ComfortTechnoNew/ffmpeg/bin/output.mp4" /><source type="video/ogg" src="http://103.141.218.26:8080/ComfortTechnoNew/ffmpeg/bin/output.mp4" /><object width="100%" height="400" type="application/x-shockwave-flash" data="flashmediaelement.swf"><param name="movie" value="flashmediaelement.swf" /><param name="flashvars" value="controls=true&file=http://103.141.218.26:8080/ComfortTechnoNew/ffmpeg/bin/output.mp4" /><img src="../../assets/images/my4.jpg" width="320" height="240" title="No video playback capabilities" /></object></video>';

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
         var arr_video = video_file.split("/");
		 var down_atmid = arr_video[1];
		 var date_video_arr = arr_video[4].split(".");
		 var date_video = date_video_arr[0];
		 var video_name_dwnld = down_atmid+"_"+date_video;
        $( this ).after('<p id="readyd" ><a id= "download" href = "http://103.141.218.26:8080/ComfortTechnoNew/copy_video/video.mp4" download = "'+video_name_dwnld+'">download</a></p>');
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

$("#video_submit").click(function(){
	/*
	$(':input[type="submit"]').prop('disabled', true);
     $('input[type="text"]').keyup(function() {
        if($(this).val() != '') {
           $(':input[type="submit"]').prop('disabled', false);
        }
     });*/
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

function onchangecircle() { 
		var bank = $("#Bank").val();
		//$("#online_percent_table_load").show();
		$("#Circle").html('');
		$("#Circle").html('<option value="">All Circle</option>');
		$("#AtmID").html('');
		$("#AtmID").html('<option value="">All Site</option>');
		if(bank=='PNB'){
			
			
			$.ajax({
				type: "GET",
				url: "../../getMasterData.php", 
				data: {bankcircle:bank},
				dataType: "html",
				success: (function (result) { debugger;
					$("#Circle").html('');
					$("#Circle").html(result);
				//	getPanel_Detail();
					
				})
			})
		}
		onchange_atmid();
	}	
	function onchange_atmid() { debugger;
		var bank = $("#Bank").val();
		var client = $("#Client").val();
		$("#AtmID").html('');
		$("#AtmID").html('<option value="">All Site</option>');
		$.ajax({
			type: "GET",
			url: "../../getMasterData.php", 
			data: {videobank:bank,videoclient:client},
			dataType: "html",
			success: (function (result) { debugger;
				$("#AtmID").html('');
				$("#AtmID").html(result);
				//$("#load").show();
			//	getPanel_Detail();
	           
			})
		})
	}
	
function onchangeatmid() {
	var bank = $("#Bank").val();
	var circle = $("#Circle").val();
	$.ajax({
		type: "GET",
		url: "../../getMasterData.php", 
		data: {videocirclebankname:bank,videocirclename:circle},
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

               