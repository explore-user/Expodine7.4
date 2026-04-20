<?php
include("src/DB/config.php");

$file="util/DB_BKP/sql_update.sql";
$wloc=$_SERVER['DOCUMENT_ROOT'];
   $wloc1=explode("www",$wloc);
   $wloc2= str_replace("/","\\", $wloc1[0]);
 if(file_exists($file)){
$res=exec($wloc2.'bin\mysql\mysql5.7.19\bin\mysql -u '.USER_NAME.' -p'.PASSWORD.' '.DATABASE_NAME.' < '.$file, $output,$return_var);
unlink($file);
}  
  else {
   file_put_contents("src/log.txt", date("l F d-m-Y h:i:s A")." Caught exception: Query error/ file empty".PHP_EOL, FILE_APPEND | LOCK_EX);
header("Location:".$_SERVER['REQUEST_URI']."src/");
}
header("Location:".$_SERVER['REQUEST_URI']."src/");
?>
