<?php $filepath = $_GET["file"];
    $filepath = base64_decode($filepath);
	$dwnldfilepath = $_GET["downloadfile"];
	$custvar = base64_decode($dwnldfilepath);
 ?>
<html>
<head>
  <link href="https://vjs.zencdn.net/7.19.2/video-js.css" rel="stylesheet" />

  <!-- If you'd like to support IE8 (for Video.js versions prior to v7) -->
  <!-- <script src="https://vjs.zencdn.net/ie8/1.1.2/videojs-ie8.min.js"></script> -->
</head>

<body>
   <iframe src="http://103.141.218.26:5007/?name=<?php echo $filepath; ?>" title="description" style="height:85vh;width: 76%;"></iframe>
   <a href="download_ftp_data.php?file=<?php echo urlencode($custvar);?>"><?php //echo htmlspecialchars($custvar); ?>Ready To Download</a>
<!--
  <video
    id="my-video"
    class="video-js"
    controls
    preload="auto"
    width="640"
    height="264"
    poster="MY_VIDEO_POSTER.jpg"
    data-setup="{}"
  >
    <source src="<?php echo $filepath;?>" type="video/avi" />
    
    <p class="vjs-no-js">
      To view this video please enable JavaScript, and consider upgrading to a
      web browser that
      <a href="https://videojs.com/html5-video-support/" target="_blank"
        >supports HTML5 video</a
      >
    </p>
  </video>

  <script src="https://vjs.zencdn.net/7.19.2/video.min.js"></script>-->
</body>
</html>