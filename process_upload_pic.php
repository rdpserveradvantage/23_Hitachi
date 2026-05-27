<html>
    <head>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js" integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>        
    </head>
    <body>
        

<?php
session_start();
include('db_connection.php');
$con = OpenCon();
function compressImage($source,$destination,$quality){
    // getimagesize
    $imgInfo = getimagesize($source);
    $mime = $imgInfo['mime'];
    
    //Create new image from file
    switch($mime){
        case 'image/jpeg':
            $image = imagecreatefromjpeg($source);
            break;
        case 'image/png':
            $image = imagecreatefrompng($source);
            break;
        case 'image/gif':
            $image = imagecreatefromgif($source);
            break;
        default :
            $image = imagecreatefromjpeg($source);
           
    }
    // save image
    imagejpeg($image,$destination,$quality);
    
    return $destination;
}

$atmid = $_POST['atmid'];

$datetime = date('Y-m-d h:i:s');

$totalrow = $_POST['totalrow'];     

//echo '<pre>';print_r($_FILES);echo '</pre>';die;

foreach($_FILES as $k => $v){
    $name = $k ;
    $target_dir = "atmuploadimage/".$atmid.'/';
        if (!file_exists($target_dir)) {
            mkdir($target_dir, 0777, true);
        }
	for($i=0;$i<$totalrow;$i++){	
		$target_file = $target_dir . basename($_FILES[$name]["name"][$i]);    
		$imageTmp = $_FILES[$name]["tmp_name"][$i];
		$compressedImage = compressImage($imageTmp,$target_file,60);
		if($compressedImage){
			$compressedImageSize = filesize($compressedImage);
		//} 
	   //  if (move_uploaded_file($_FILES[$name]["tmp_name"], $target_file)) {
			if ($compressedImageSize) {
			echo "The file  has been uploaded.";
			$link = $target_dir. htmlspecialchars( basename( $_FILES[$name]["name"][$i])) ; 
			$sql = "insert into atm_upload_images(atmid,link,created_at) values('".$atmid."','".$link."','".$datetime."')" ; 
			mysqli_query($con,$sql);
			$err = 0;
			} else {
			echo "Sorry, there was an error uploading your file.";
			$err = 1;
			}
		echo '<br>';
		}
	}
}
CloseCon($con);
if($err==0){
?>
 <script>
       swal("Great!", "Image Uploaded Successfully !", "success");

           setTimeout(function(){ 
               window.location.href="viewsitenew.php";
           }, 3000);

       </script> 
<?php }else{ ?>	   
 <script>
       swal("Something Wrong", "Sorry, there was an error uploading your file !", "error");
           swal('error','','Login Error');
           setTimeout(function(){ 
		     window.location.href="viewsitenew.php";
             // window.history.back();
           }, 3000);

       </script>

<?php }?>
 
</body>
</html>