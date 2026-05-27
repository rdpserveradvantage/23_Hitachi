<?php 
$video_file = $_POST['video_file'];


$source = $video_file; 
$destination = 'copy_video/video.mp4'; 
  
copy($source, $destination) ;



?>

