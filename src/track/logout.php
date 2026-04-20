<?php

include("DB/database.class.php"); // DB Connection class
$database	= new Database();

session_start();

session_unset();
session_destroy();
function clearBrowserCache() { 
    header("Pragma: no-cache"); 
    header("Cache: no-cache"); 
    header("Cache-Control: no-cache, must-revalidate"); 
    //header("Expires: Mon, 9 Jul 1995 05:00:00 GMT"); 
} 
clearBrowserCache(); 
clearstatcache();
header('location:login.php');

  $loy_qry34 = $database->mysqlQuery("update tbl_track_l set l_logged_status='N' ");
?>