<?php
  $path='/var/www/html/w3d/odm_project/'.$_GET['name'].'/odm_texturing';
  $files=scandir($path);
  foreach($files as $v){
    echo "<a href='http://202.31.147.197:7680/w3d/download.php?file=".$_GET['name']."/odm_texturing/".$v."'>$v</a><br>\n";
  }


?>
