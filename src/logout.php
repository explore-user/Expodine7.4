<?php

 session_start();

unset ($_SESSION['expodine_id']);
$logoutlink=$_SESSION['s_mainlink'];
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
header('location:login.php?msg=2');

?>