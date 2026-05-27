<?php include ('config.php');
$S_date1=$_POST['S_date'];
$S_date2=date("Y-m-d", strtotime($S_date1));





?>

                    <div class="col-12">
                        <div class="card-box">
                         <h4 class="header-title m-b-30">SNAPS</h4>

                            <div class="row">
                                     
                                     
                                             
                                                    
                                     <?php  
                                          $myDirectory=opendir("E:\\photos\\2021_08_31\\9\\$S_date2");
                                                   // Gets each entry
                                                  while(false !== ($entryName=readdir($myDirectory))) {
                                                  $dirArray[]=$entryName;
                                                  }
                                        natcasesort($dirArray);
                                        
                                        foreach ($dirArray as $file) {
                                           if($file!="." && $file!=".."){
                                           if($file!="DVRWorkDirectory" ){
                                       ?>
                                 <div class="col-lg-3 col-xl-2">
                                 <a href="snaps_file.php?dt=<?php echo $S_date2;?>&t=<?php echo $file;?>" title="Click ME">  <div class="file-man-box">
                                        
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
                          </div>                       
                          </div>

