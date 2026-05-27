<?php 
	$ip = $_POST['ip']; 
							
	$imgsrc = $ip."_1.jpg";
	$local_path = "D:/testsnaps/".$imgsrc;

	$image = file_get_contents($local_path);
	if($image){
		$image_codes = base64_encode($image);
	}else{
		$local_path = "D:/testsnaps/no_feed.jpg";
		$image = file_get_contents($local_path);
		$image_codes = base64_encode($image);
	}
?>
	
<image src="data:image/jpg;charset=utf-8;base64,<?php echo $image_codes; ?>" />
