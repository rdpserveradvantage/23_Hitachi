<?php


$allimg = [];
    $dt=$_GET['dt'];
     $t=$_GET['t'];
     $myDirectory=opendir("E:\\photos\\$dt\\$t");
         
      while(false !== ($entryName=readdir($myDirectory))) {
      $dirArray[]=$entryName; 
      }
      
       natcasesort($dirArray);
        $i=0;
        foreach ($dirArray as $file) {
        if($file!="." && $file!=".."){
            $i++;
            $path="E:\\photos\\$dt\\$t\\$file";
            $allimg[] = $path;
            }   
}


$zipname = $dt.'-'.$t.'-file.zip';
$zip = new ZipArchive;
$zip->open($zipname, ZipArchive::CREATE);
foreach ($allimg as $file) {
  $zip->addFile($file);
}
$zip->close();
        



header('Content-Type: application/zip');
header('Content-disposition: attachment; filename='.$zipname);
header('Content-Length: ' . filesize($zipname));

ob_clean();
flush();
readfile($zipname);
unlink($zipname);

        ?>