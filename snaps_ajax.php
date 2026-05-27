<?php  
        $_atmid = $_GET['atmid']; 
		$myDirectory=opendir("D:\\python_codes\\Server_socket\\House_Keeping\\ $_atmid");
							   // Gets each entry
							  while($entryName=readdir($myDirectory)) {
							  $dirArray[]=$entryName;
							  }
					natcasesort($dirArray);
					
					foreach ($dirArray as $file) {
					   if($file!="." && $file!=".."){
							if($file!="DVRWorkDirectory" ){
				   ?>
			 <div class="col-lg-3 col-xl-2">
			 <a href="snaps_time.php?dt=<?php echo $file;?>&aid=<?php echo $_atmid;?>" title="Click ME">  <div class="file-man-box">
					
					<div class="file-img-box">
						<img src="https://img.icons8.com/plasticine/100/000000/shared-folder.png">
					</div>
					
					<div class="file-man-title" title="Date" >
						<?php echo $file;?>
						
					</div>
				</div></a>
			</div>


					  <?php  }}   
					  }
					 // echo print_r($dirArray);
					?>