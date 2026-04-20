<?php 

include("database.class.reports.php");  
$database	= new Database();
    
$folder = '..\util\Dayclose_emails/';

$file_url = $folder."Reports-".$database->convert_date($_REQUEST['datemail']).'.txt';

if (file_exists($file_url)) {
    
    
    
    
header('Content-Type: text/plain');  
header("Content-Transfer-Encoding: utf-8");   
header("Content-disposition: attachment; filename=\"" . basename($file_url) . "\"");   
readfile($file_url);


}else {
    echo "The file Reports-".$database->convert_date($_REQUEST['datemail']).".txt does not exist. ";
    echo " You will be redirected in 3 seconds...";
    header("refresh:3; url=dayclosedetails.php");
    
}

     
 ?>