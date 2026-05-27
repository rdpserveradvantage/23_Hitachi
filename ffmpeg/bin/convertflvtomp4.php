<?php
function execInBackground($cmd) { 
    if (substr(php_uname(), 0, 7) == "Windows"){ 
        pclose(popen("start /B ". $cmd, "r"));  
    } 
    else { 
        exec($cmd . " > /dev/null &");   
    } 
}
//header("Content-Type: video/x-flv");
//execInBackground('ffmpeg -i newinput.flv -ab 96k -b 700k -ar 44100 -s 640x480 -acodec mp3 newoutput.mp4');

execInBackground('ffmpeg -i newinput.flv -vcodec copy newoutput.mp4');

?>