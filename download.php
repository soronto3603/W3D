<?php
$filename = $_GET['file'];
$reail_filename = urldecode($filename);
$file_dir = "/var/www/html/w3d/odm_project/".$filename;

header('Content-Type: application/x-octetstream');
header('Content-Length: '.filesize($file_dir));
header('Content-Disposition: attachment; filename='.$reail_filename);
header('Content-Transfer-Encoding: binary');

$fp = fopen($file_dir, "r");
fpassthru($fp);
fclose($fp);

?>
