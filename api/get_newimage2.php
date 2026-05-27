<?php include('config.php');
//$path ="C:\Users\css.WIN-IFIBER012\Desktop\Server_socket\New_Record";
$date = $_REQUEST['date'];
$file = str_replace("./","",$date);


$path = "D:/python_codes/Server_socket/$file";
$path = str_replace("/","\\\\",$path);
										$imgData = base64_encode(file_get_contents($path)); 
                                $imgsrc = 'data: '.mime_content_type($path).';base64,'.$imgData; 
		 ?>

<img src="<?php echo $imgsrc;  ?>" alt="" style="width: 755px; height: 600px;object-fit: contain;">
<?php

 ?>

