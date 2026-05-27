<?php 
//$path ="C:\Users\css.WIN-IFIBER012\Desktop\Server_socket\New_Record";
$date = $_REQUEST['date'];
//$path = str_replace("./","",$date);

$files = str_replace('./Record','',$date);
					//$file = $files[2];
					$file = str_replace('/','\\',$files);
					$path = "D:\\python_codes\\Server_socket\\Record\\$file";
					if(file_exists($path)){
						$imgData = base64_encode(file_get_contents($path)); 
						$src = 'data: '.mime_content_type($path).';base64,'.$imgData; 
					}
/*
$path = "D:/python_codes/Server_socket/$file";
$path = str_replace("/","\\\\",$path);
										$imgData = base64_encode(file_get_contents($path)); 
                                $imgsrc = 'data: '.mime_content_type($path).';base64,'.$imgData;  */
		 ?>

<img src="<?php echo $src;  ?>" alt="" style="object-fit: contain;">
<?php

 ?>

