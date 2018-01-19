<?php
  $name=$_GET['name'];
  $path='/var/www/html/w3d/odm_project';

  $files=scandir($path);
  foreach($files as $v)if($v==$name)return;

  umask(0);
  mkdir($path."/".$name,0777);
  mkdir($path."/".$name."/images",0777);


?>
