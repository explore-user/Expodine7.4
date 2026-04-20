<?php

$msg = "";

$path = dirname(__FILE__)."/db_import/";
$sql_filename="expodine.sql";
session_start();

$_SESSION['execute_btn_chk']=0;
$_SESSION['excel_btn_chk']=0;
$_SESSION['branchname_install']="";
$_SESSION['address_install']="";
$_SESSION['expoversion_install']="";
$_SESSION['androidapkname_install']="";
$_SESSION['androidapkcode_install']="";

	
if ($_SERVER['REQUEST_METHOD'] == 'POST'  )
{if( $_REQUEST['hiddenvalueuser']=="userform"){
	
	
	//$dbname= $_REQUEST['dbname'];
	
	if($_REQUEST['hiddenpermission']=="admin")
	{
		$servername = $_REQUEST['hostname'];
	  $username = $_REQUEST['uname'];
	  $password = $_REQUEST['psw'];
		
	}else
	{		
	  $servername = "localhost";
   	    $username = "root";
    	$password ="";
	}
	
    // Create connection
    $conn = new mysqli($servername, $username, $password);
	
	
	//$conn = new mysqli("localhost", "root", "");
	mysqli_select_db($conn,"mysql");
	//Do not change this*****************************************************
	$sql = "UPDATE mysql.user SET `authentication_string` = '*1659117CCBBF9689F997D4C17957D691D2B40DEF'  where `Host` = 'localhost' and `User` = 'root'";
	//$dbname="3e4r";
    if ($conn->query($sql) === TRUE) {
        $msg= "First Query Executed";
        
    } else {
        $msg= "Error in First Query : " . $conn->error;
    }
	//Do not change this*****************************************************
	$sql1 = "INSERT INTO `user` (`Host`, `User`, `Select_priv`, `Insert_priv`, `Update_priv`, `Delete_priv`, `Create_priv`, `Drop_priv`, `Reload_priv`, `Shutdown_priv`, `Process_priv`, `File_priv`, `Grant_priv`, `References_priv`, `Index_priv`, `Alter_priv`, `Show_db_priv`, `Super_priv`, `Create_tmp_table_priv`, `Lock_tables_priv`, `Execute_priv`, `Repl_slave_priv`, `Repl_client_priv`, `Create_view_priv`, `Show_view_priv`, `Create_routine_priv`, `Alter_routine_priv`, `Create_user_priv`, `Event_priv`, `Trigger_priv`, `Create_tablespace_priv`, `ssl_type`, `ssl_cipher`, `x509_issuer`, `x509_subject`, `max_questions`, `max_updates`, `max_connections`, `max_user_connections`, `plugin`, `authentication_string`, `password_expired`, `password_last_changed`, `password_lifetime`, `account_locked`) VALUES
('%', 'root', 'Y', 'Y', 'Y', 'Y', 'Y', 'Y', 'Y', 'Y', 'Y', 'Y', 'Y', 'Y', 'Y', 'Y', 'Y', 'Y', 'Y', 'Y', 'Y', 'Y', 'Y', 'Y', 'Y', 'Y', 'Y', 'Y', 'Y', 'Y', 'Y', '', '', '', '', 0, 0, 0, 0, 'mysql_native_password', '*1659117CCBBF9689F997D4C17957D691D2B40DEF', 'N', '2018-05-11 06:49:39', NULL, 'N')";


//$dbname="wdef";
    if ($conn->query($sql1) === TRUE) {
		?>
        <div class="loading_popup" style="display:block">
        <div class="loading_popup_headiing" style="color:#F00">Please restart wamp before proceeding to Next step</div>
        
        <div class="loading_popup_area" style="margin-bottom: 8px;">
        <div class="loading_popup_area"><a href="#" class="loading_popup_ok_btn  " id="loading_popup_ok_click">OK</a></div>
        </div>
        </div>
        <div class="loading_popup_overlay" style="display:block"></div>
        <?php
        $msg= "Please restart wamp before proceeding to Next step";
        
    } else {
        $msg= "Error in Second Query: " . $conn->error;
    }
	
}
}
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title> POS Installation</title>

<link href="css/bootstrap.css" rel="stylesheet">
<link href="css/style.css" rel="stylesheet">
<link href="css/responsive.css" rel="stylesheet">
<style>.form-group { margin-bottom: 25px ;}</style>
 <script src="../js/jquery-1.10.2.min.js"></script>     
</head>

<body>

<div class="main_header_wrapper">
   
      <div class="container-fluid">
      <div class="container">
      
       
      <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 top_phno_container">
       <div class="navbar-brand_main"><img src="images/logo.png"></div>
      
        	
         </div>
        <!-- Brand and toggle get grouped for better mobile display -->
 </div>
 
 </div>
 </div>
         
        
         <div class="container">
        <div class="row">
        
        <div class="col-lg-12 keyftur_head_first" style="color:#f5351b;font-size:21px; margin:0px 0px 0px 0px;">
Pre-Installation Check</div>
        
         <div class="col-lg-12 keyftur_head" style="color:#525252;font-size:33px; margin:0px 0px 20px 0px;">
<span>Database Creation - STEP 1</span>
            <a  class="button_bottom" id="btn_usersql" role="button" onclick="#" style="margin-left:15px;width: 160px;background-color:#ca2d2d !important;position:absolute;right:0 ;top: 15px;">Add root user</a>
            </div>
            
            

        <div class="main_container">
        
        
            
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" style=" height:auto;margin-top:20px;">
            	
               		<form name="frm_step1" id="frm_step1" method="post" action="index.php">
            			
                        
                      
                          
                            
                          
                             
                         
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 form-group">
                           <div class="main_name_container">Database Name*</div>
                            <input style="height: 40px;" type="text" class="form-control" placeholder="Database Name *" name="dbname">
                            <div class="field_erro_txt" id ="er_dbname"></div>
                            </div>
                        <?php if(isset($_REQUEST['permission'])){ ?>    
                         <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 form-group">
                           <div class="main_name_container">Hostname<?php if(isset($_REQUEST['permission'])){ ?> * <?php } ?> <!--(for Database Server)--></div>
                            <input style="height: 40px;" type="text" class="form-control" placeholder="Hostname <?php if(isset($_REQUEST['permission'])){ ?> * <?php } ?>" name="hostname">
                             <div class="field_erro_txt" id ="er_hostname"></div>
                            </div>
                            
                            
                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 form-group">
                           <div class="main_name_container">Username<?php if(isset($_REQUEST['permission'])){ ?> * <?php } ?></div>
                            <input style="height: 40px;" type="text" class="form-control" placeholder="Username <?php if(isset($_REQUEST['permission'])){ ?> * <?php } ?>" name="uname">
                           <div class="field_erro_txt" id ="er_uname"></div>
                           </div>
                            
                            
                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 form-group">
                           <div class="main_name_container">Password<?php if(isset($_REQUEST['permission'])){ ?> * <?php } ?></div>
                            <input style="height: 40px;" type="text" class="form-control" placeholder="Password <?php if(isset($_REQUEST['permission'])){ ?> * <?php } ?>" name="psw">
                            <div class="field_erro_txt" id ="er_psw"></div>
                            </div>
                           <?php } ?> 
                     
                          
                            
                              <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 form-group">
                           <div class="main_name_container">Attempt Installation</div>
                           	 
                              <a  class="button_bottom" role="" onclick="" id="btn_install" name="btn_install" >Install Database</a>
                              <a  class="button_bottom"  role="button" onclick="#" id="btn_proceed" style="margin-left:15px;width: 160px;background-color:#ca2d2d !important;">SKIP & PROCEED </a>
                              
                               <span class="install_main_error"><label><?= ($msg!="")? $msg :"" ?></label> </span>
                            </div>
                           
                          <input type="text" style="display:none" id="hiddenvalueuser" name="hiddenvalueuser">
 <input type="text" style="display:none" id="hiddenpermission" name="hiddenpermission" <?php if(isset($_REQUEST['permission'])){ ?> value="admin" <?php } ?> >
                     
                        
                     </form>  
                 
                     
                        </div>

                        </div>
  </div></div>
 
  
 
  <div class="container-fluid" style="background:#262626; min-height:55px;text-align:center;position:fixed;bottom:0px;width:100%;">
          <div class="container foot_last">
        Explore IT Solutions. All Rights Reserved. Privacy Policy | Terms of Use
         </div>
     </div>

<div class="loading_popup" style="display:none">
    	<!--<div class="language_close_btn"></div>-->
    	 <div class="loading_popup_headiing">Expodine</div>
          <div class="loading_popup_headiing_text">DataBase Importing....</div>
        <div class="loading_popup_area" style="margin-bottom: 8px;">
        	<img src="images/processing.gif">
         </div>
        <div class="loading_popup_headiing_text" style="margin-top: 8px;">Please wait....</div>
        <div class="loading_popup_area" style="margin-bottom: 8px;">
         <!--<div id="load_details_msg" ></div>-->
        <?php
		if ($_SERVER['REQUEST_METHOD'] == 'POST'){
		
			
			session_start();
			
    if($_REQUEST['dbname']!="" ){//&& $_REQUEST['hostname']!="" && $_REQUEST['uname']!=""
		
        if(is_dir($path)&& file_exists($path.$sql_filename)){
    //."/expodine_4.0.6/src/install/db_import"
    $dbname= $_REQUEST['dbname'];
	
	if($_REQUEST['hiddenpermission']=="admin")
	{
		$servername = $_REQUEST['hostname'];
	  $username = $_REQUEST['uname'];
	  $password = $_REQUEST['psw'];
		
	}else
	{		
	  $servername = "localhost";
   	    $username = "root";
    	$password ="explore@4123";
	}
	$_SESSION['install_username']=$username;
	$_SESSION['install_password']=$password;
	$_SESSION['install_hostname']=$servername;
	$_SESSION['install_dbname']=$dbname;
	
    // Create connection
    $conn = new mysqli($servername, $username, $password);
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    } 
    // Create database
    if ($conn->select_db($dbname) === false) {
    // Create db
		  $sql = "CREATE DATABASE IF NOT EXISTS $dbname DEFAULT CHARACTER SET utf8 DEFAULT COLLATE utf8_unicode_ci";
		  if ($conn->query($sql) === TRUE) {
			  echo $msg= "Database created successfully";
			  mysqli_select_db($conn,$dbname);
		  } else {
			 echo  $msg= "Error creating database: " . $conn->error;
		  }
		  
	}else
	{
		mysqli_select_db($conn,$dbname);
		$ct=mysqli_query($conn,"show tables");
		$num_flor  = mysqli_num_rows($ct);
		$ns=floor($num_flor);
		if($ns!=0){
			echo   $msg= "Database already exists";
			  echo '<script type="text/javascript">';
			 echo 'window.location.href="step-second.php";';
			 echo '</script>';
			 echo '<noscript>';
			 echo '<meta http-equiv="refresh" content="0;url=step-second.php" />';
			 echo '</noscript>'; exit;
			 
			  
		  } else {
			 echo  $msg= "need to create tables";
		  }
		
		
		 /*else {
			  $msg= "Error creating database: " . $conn->error;
		  }*/
		
	}
    //---------------
     $msg="Processing...Please wait";
     $sql_contents = file_get_contents($path.$sql_filename);
     $sql_contents = explode(";", $sql_contents);
     
/*$path = $_SERVER['DOCUMENT_ROOT'];
$sql_filename = '/expodine_4.0.6/src/install/db_import/expodine.sql';*/	 
//$dir = $path.'/expodine_4.0.6/src/install/db_import/';
$filename = 'expodine.sql';//"backup" . date("YmdHis") . ".sql.gz";

//importing database starts

//start=1&fn=expodine.sql&foffset=0&totalqueries=0

$db_server   = $servername;
$db_name     = $dbname;
$db_username = $username;
$db_password = $password; 
$db_connection_charset = 'utf8';


// OPTIONAL SETTINGS 

//$filename           = '';     // Specify the dump filename to suppress the file selection dialog
$ajax               = true;   // AJAX mode: import will be done without refreshing the website
$linespersession    = 100000;   // Lines to be executed per one import session
$delaypersession    = 0;      // You can specify a sleep time in milliseconds after each session
                              // Works only if JavaScript is activated. Use to reduce server overrun

// CSV related settings (only if you use a CSV dump)

$csv_insert_table   = '';     // Destination table for CSV files
$csv_preempty_table = false;  // true: delete all entries from table specified in $csv_insert_table before processing
$csv_delimiter      = ',';    // Field delimiter in CSV file
$csv_add_quotes     = true;   // If your CSV data already have quotes around each field set it to false
$csv_add_slashes    = true;   // If your CSV data already have slashes in front of ' and " set it to false

// Allowed comment markers: lines starting with these strings will be ignored by BigDump

$comment[]='#';                       // Standard comment lines are dropped by default
$comment[]='-- ';
$comment[]='DELIMITER';               // Ignore DELIMITER switch as it's not a valid SQL statement
// $comment[]='---';                  // Uncomment this line if using proprietary dump created by outdated mysqldump
// $comment[]='CREATE DATABASE';      // Uncomment this line if your dump contains create database queries in order to ignore them
$comment[]='/*!';                     // Or add your own string to leave out other proprietary things


$delimiter = ';';

// String quotes character

$string_quotes = '\'';                  // Change to '"' if your dump file uses double qoutes for strings

// How many lines may be considered to be one query (except text lines)

$max_query_lines = 100000;

// Where to put the upload files into (default: bigdump folder)

$upload_dir = dirname(__FILE__)."/db_import/";

if ($ajax)
  ob_start();

define ('VERSION','0.36b');
define ('DATA_CHUNK_LENGTH',16384);  // How many chars are read per time
define ('TESTMODE',false);           // Set to true to process the file without actually accessing the database
define ('BIGDUMP_DIR',dirname(__FILE__));
define ('PLUGIN_DIR',BIGDUMP_DIR.'/plugins/');

header("Expires: Mon, 1 Dec 3000 01:00:00 GMT");
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
header("Cache-Control: no-store, no-cache, must-revalidate");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");

@ini_set('auto_detect_line_endings', true);
@set_time_limit(0);

if (function_exists("date_default_timezone_set") && function_exists("date_default_timezone_get"))
  @date_default_timezone_set(@date_default_timezone_get());

$error = false;
$file  = false;



$curfilename=$filename;

if (preg_match("/\.gz$/i",$curfilename)) 
    $gzipmode=true;
  else
    $gzipmode=false;
	
	
 if ((!$gzipmode && !$file=@fopen($upload_dir.'/'.$curfilename,"r")) || ($gzipmode && !$file=@gzopen($upload_dir.'/'.$curfilename,"r")))
  { echo ("<p class=\"error\">Can't open ".$curfilename." for import</p>\n");
    echo ("<p>Please, check that your dump file name contains only alphanumerical characters, and rename it accordingly, for example: $curfilename.".
           "<br>Or, specify \$filename in bigdump.php with the full filename. ".
           "<br>Or, you have to upload the $curfilename to the server first.</p>\n");
    $error=true;
  }

// Get the file size (can't do it fast on gzipped files, no idea how)

  else if ((!$gzipmode && @fseek($file, 0, SEEK_END)==0) || ($gzipmode && @gzseek($file, 0)==0))
  { if (!$gzipmode) $filesize = ftell($file);
    else $filesize = gztell($file);                   // Always zero, ignore
  }
  else
  { echo ("<p class=\"error\">I can't seek into $curfilename</p>\n");
    $error=true;
  }

// Stop if csv file is used, but $csv_insert_table is not set

  if (!$error && ($csv_insert_table == "") && (preg_match("/(\.csv)$/i",$curfilename)))
  { echo ("<p class=\"error\">You have to specify \$csv_insert_table when using a CSV file. </p>\n");
    $error=true;
  }
  
  //*****************************start
  

// Check start and foffset are numeric values

  //$error=true;
  	$start_r   = floor("1");
    $foffset_r= floor("0");
 


  


// Set the current delimiter if defined

 /* if (isset($_REQUEST["delimiter"]))
    $delimiter = $_REQUEST["delimiter"];*/

// Empty CSV table if requested

  if (!$error && $start_r==1 && $csv_insert_table != "" && $csv_preempty_table)
  { 
    $query = "DELETE FROM `$csv_insert_table`";
    if (!TESTMODE && !$conn->query(trim($query)))
    { echo ("<p class=\"error\">Error when deleting entries from $csv_insert_table.</p>\n");
      echo ("<p>Query: ".trim(nl2br(htmlentities($query)))."</p>\n");
      echo ("<p>MySQL: ".$conn->error."</p>\n");
      $error=true;
    }
  }
  
// Print start message

  if (!$error)
  { //skin_open();
    if (TESTMODE) 
      echo ("<p class=\"centr\">TEST MODE ENABLED</p>\n");
    echo ("<p class=\"centr\">Processing file: <b>".$curfilename."</b></p>\n");
    echo ("<p class=\"smlcentr\">Starting from line: ".$start_r."</p>\n");	
   // skin_close();
  }

// Check $foffset_r upon $filesize (can't do it on gzipped files)

  if (!$error && !$gzipmode && $foffset_r>$filesize)
  { echo ("<p class=\"error\">UNEXPECTED: Can't set file pointer behind the end of file</p>\n");
    $error=true;
  }

// Set file pointer to $foffset_r

  if (!$error && ((!$gzipmode && fseek($file, $foffset_r)!=0) || ($gzipmode && gzseek($file, $foffset_r)!=0)))
  { echo ("<p class=\"error\">UNEXPECTED: Can't set file pointer to offset: ".$foffset_r."</p>\n");
    $error=true;
  }

// Start processing queries from $file

  if (!$error)
  { $query="";
    $queries=0;
    $totalqueries=0;
    $linenumber=$start_r;
    $querylines=0;
    $inparents=false;

// Stay processing as long as the $linespersession is not reached or the query is still incomplete

    while ($linenumber<$start_r+$linespersession || $query!="")
    {

// Read the whole next line

      $dumpline = "";
      while (!feof($file) && substr ($dumpline, -1) != "\n" && substr ($dumpline, -1) != "\r")
      { if (!$gzipmode)
          $dumpline .= fgets($file, DATA_CHUNK_LENGTH);
        else
          $dumpline .= gzgets($file, DATA_CHUNK_LENGTH);
      }
      if ($dumpline==="") break;

// Remove UTF8 Byte Order Mark at the file beginning if any

      if ($foffset_r==0)
        $dumpline=preg_replace('|^\xEF\xBB\xBF|','',$dumpline);

// Create an SQL query from CSV line

      if (($csv_insert_table != "") && (preg_match("/(\.csv)$/i",$curfilename)))
      {
        if ($csv_add_slashes)
          $dumpline = addslashes($dumpline);
        $dumpline = explode($csv_delimiter,$dumpline);
        if ($csv_add_quotes)
          $dumpline = "'".implode("','",$dumpline)."'";
        else
          $dumpline = implode(",",$dumpline);
        $dumpline = 'INSERT INTO '.$csv_insert_table.' VALUES ('.$dumpline.');';
      }

// Handle DOS and Mac encoded linebreaks (I don't know if it really works on Win32 or Mac Servers)

      $dumpline=str_replace("\r\n", "\n", $dumpline);
      $dumpline=str_replace("\r", "\n", $dumpline);
            
// DIAGNOSTIC
// echo ("<p>Line $linenumber: $dumpline</p>\n");

// Recognize delimiter statement

      if (!$inparents && strpos ($dumpline, "DELIMITER ") === 0)
        $delimiter = str_replace ("DELIMITER ","",trim($dumpline));

// Skip comments and blank lines only if NOT in parents

      if (!$inparents)
      { $skipline=false;
        reset($comment);
        foreach ($comment as $comment_value)
        { 

// DIAGNOSTIC
//          echo ($comment_value);
          if (trim($dumpline)=="" || strpos (trim($dumpline), $comment_value) === 0)
          { $skipline=true;
            break;
          }
        }
        if ($skipline)
        { $linenumber++;

// DIAGNOSTIC
// echo ("<p>Comment line skipped</p>\n");

          continue;
        }
      }

// Remove double back-slashes from the dumpline prior to count the quotes ('\\' can only be within strings)
      
      $dumpline_deslashed = str_replace ("\\\\","",$dumpline);

// Count ' and \' (or " and \") in the dumpline to avoid query break within a text field ending by $delimiter

      $parents=substr_count ($dumpline_deslashed, $string_quotes)-substr_count ($dumpline_deslashed, "\\$string_quotes");
      if ($parents % 2 != 0)
        $inparents=!$inparents;

// Add the line to query

      $query .= $dumpline;

// Don't count the line if in parents (text fields may include unlimited linebreaks)
      
      if (!$inparents)
        $querylines++;
      
// Stop if query contains more lines as defined by $max_query_lines

      if ($querylines>$max_query_lines)
      {
        echo ("<p class=\"error\">Stopped at the line $linenumber. </p>");
        echo ("<p>At this place the current query includes more than ".$max_query_lines." dump lines. That can happen if your dump file was ");
        echo ("created by some tool which doesn't place a semicolon followed by a linebreak at the end of each query, or if your dump contains ");
        
        echo ("for more infos. Ask for our support services ");
        echo ("in order to handle dump files containing extended inserts.</p>\n");
        $error=true;
        break;
      }

// Execute query if end of query detected ($delimiter as last character) AND NOT in parents

// DIAGNOSTIC
// echo ("<p>Regex: ".'/'.preg_quote($delimiter).'$/'."</p>\n");
// echo ("<p>In Parents: ".($inparents?"true":"false")."</p>\n");
// echo ("<p>Line: $dumpline</p>\n");

      if ((preg_match('/'.preg_quote($delimiter,'/').'$/',trim($dumpline)) || $delimiter=='') && !$inparents)
      { 

// Cut off delimiter of the end of the query

        $query = substr(trim($query),0,-1*strlen($delimiter));

// DIAGNOSTIC
// echo ("<p>Query: ".trim(nl2br(htmlentities($query)))."</p>\n");

        if (!TESTMODE && !$conn->query($query))
        { echo ("<p class=\"error\">Error at the line $linenumber: ". trim($dumpline)."</p>\n");
          echo ("<p>Query: ".trim(nl2br(htmlentities($query)))."</p>\n");
          echo ("<p>MySQL: ".$conn->error."</p>\n");
          $error=true;
          break;
        }
        $totalqueries++;
        $queries++;
        $query="";
        $querylines=0;
      }
      $linenumber++;
    }
  }

// Get the current file position

  if (!$error)
  { if (!$gzipmode) 
      $foffset = ftell($file);
    else
      $foffset = gztell($file);
    if (!$foffset)
    { echo ("<p class=\"error\">UNEXPECTED: Can't read the file pointer offset</p>\n");
      $error=true;
    }
  }

// Print statistics

//skin_open();

// echo ("<p class=\"centr\"><b>Statistics</b></p>\n");

  if (!$error)
  { 
    $lines_this   = $linenumber-$start_r;
    $lines_done   = $linenumber-1;
    $lines_togo   = ' ? ';
    $lines_tota   = ' ? ';
    
    $queries_this = $queries;
    $queries_done = $totalqueries;
    $queries_togo = ' ? ';
    $queries_tota = ' ? ';

    $bytes_this   = $foffset-$foffset_r;
    $bytes_done   = $foffset;
    $kbytes_this  = round($bytes_this/1024,2);
    $kbytes_done  = round($bytes_done/1024,2);
    $mbytes_this  = round($kbytes_this/1024,2);
    $mbytes_done  = round($kbytes_done/1024,2);
   
    if (!$gzipmode)
    {
      $bytes_togo  = $filesize-$foffset;
      $bytes_tota  = $filesize;
      $kbytes_togo = round($bytes_togo/1024,2);
      $kbytes_tota = round($bytes_tota/1024,2);
      $mbytes_togo = round($kbytes_togo/1024,2);
      $mbytes_tota = round($kbytes_tota/1024,2);
      
      $pct_this   = ceil($bytes_this/$filesize*100);
      $pct_done   = ceil($foffset/$filesize*100);
      $pct_togo   = 100 - $pct_done;
      $pct_tota   = 100;

      if ($bytes_togo==0) 
      { $lines_togo   = '0'; 
        $lines_tota   = $linenumber-1; 
        $queries_togo = '0'; 
        $queries_tota = $totalqueries; 
      }

      $pct_bar    = "<div style=\"height:15px;width:$pct_done%;background-color:#000080;margin:0px;\"></div>";
    }
    else
    {
      $bytes_togo  = ' ? ';
      $bytes_tota  = ' ? ';
      $kbytes_togo = ' ? ';
      $kbytes_tota = ' ? ';
      $mbytes_togo = ' ? ';
      $mbytes_tota = ' ? ';
      
      $pct_this    = ' ? ';
      $pct_done    = ' ? ';
      $pct_togo    = ' ? ';
      $pct_tota    = 100;
      $pct_bar     = str_replace(' ','&nbsp;','<tt>[         Not available for gzipped files          ]</tt>');
    }
    
    ?>
    <center>
    <table width=\"520\" border=\"1\" cellpadding=\"3\" cellspacing=\"1\">
    
    <tr><th class=\"bg4\">%</th><td class=\"bg3\"><?=$pct_this?></td><td class=\"bg3\"><?=$pct_done?></td><td class=\"bg3\"><?=$pct_togo?></td><td class=\"bg3\"><?=$pct_tota?></td></tr>
    <tr><th class=\"bg4\">% bar</th><td class=\"bgpctbar\" colspan=\"4\"><?=$pct_bar?></td></tr>
    </table>
    </center>
    <?php

// Finish message and restart the script
/*echo "hai";
echo ("test");*/
    if ($linenumber<$start_r+$linespersession)
    { echo ("<p class=\"successcentr\">Congratulations: End of file reached, assuming OK</p>\n");
     
      $error=true; // This is a semi-error telling the script is finished
    }
    else
    { if ($delaypersession!=0)
        echo ("<p class=\"centr\">Now I'm <b>waiting $delaypersession milliseconds</b> before starting next session...</p>\n");
     /* if (!$ajax) 
        echo ("<script language=\"JavaScript\" type=\"text/javascript\">window.setTimeout('location.href=\"".$_SERVER["PHP_SELF"]."?start=$linenumber&fn=".urlencode($curfilename)."&foffset=$foffset&totalqueries=$totalqueries&delimiter=".urlencode($delimiter)."\";',500+$delaypersession);</script>\n");

      echo ("<noscript>\n");
      echo ("<p class=\"centr\"><a href=\"".$_SERVER["PHP_SELF"]."?start=$linenumber&amp;fn=".urlencode($curfilename)."&amp;foffset=$foffset&amp;totalqueries=$totalqueries&amp;delimiter=".urlencode($delimiter)."\">Continue from the line $linenumber</a> (Enable JavaScript to do it automatically)</p>\n");
      echo ("</noscript>\n");*/
   
      echo ("<p class=\"centr\">Press <b><a href=\"".$_SERVER["PHP_SELF"]."\">STOP</a></b> to abort the import <b>OR WAIT!</b></p>\n");
    }
  }
  else 
    echo ("<p class=\"error\">Stopped on error</p>\n");







  
  
  //*******************************ends

//importing database ends

		
    $conn->close();
	echo '<script type="text/javascript">';
			 echo 'window.location.href="step-second.php";';
			 echo '</script>';
			 echo '<noscript>';
			 echo '<meta http-equiv="refresh" content="0;url=step-second.php" />';
			 echo '</noscript>'; exit;
			 
	//header("Location: step-second.php");
    }else{
        $msg ="Database file not found";
    }
    }
    else{
        $msg ="DB creation failed";
    }
  
    //-----------------
}
		?>
        </div>
</div>
<div class="loading_popup_overlay" style="display:none"></div>

</body>
</html>
<script type="text/javascript">

 
 $("#btn_usersql").click(function(){
	 $("#hiddenvalueuser").val("userform");
	 document.frm_step1.submit();
 }); 
	 
    $("#btn_install").click(function(){
         $("#hiddenvalueuser").val("");
		 var dbname="";
		 var username="";
		 var password="";
		 var hostname="";
		 var typelike="";
        if( document.frm_step1.dbname.value == "" )
         {
            //alert( "Please provide your Database name!" );
            document.getElementById('er_dbname').innerHTML="Please provide your Database name!";
            document.frm_step1.dbname.focus() ;
            return false;
            
         }else{
			 dbname=document.frm_step1.dbname.value;
             document.getElementById('er_dbname').innerHTML="";
         }
		 if(document.frm_step1.hiddenpermission.value != "")
		 {typelike="admin";
			   if( document.frm_step1.hostname.value == "" )
			   {
				  //alert( "Please provide your host name!" );
				 document.getElementById('er_hostname').innerHTML="Please provide your host name!";
				 document.frm_step1.hostname.focus() ;
				  return false;
			   }else{
				   hostname=document.frm_step1.hostname.value;
				   document.getElementById('er_hostname').innerHTML="";
			   }
			   if( document.frm_step1.uname.value == "" )
			   {
				  //alert( "Please provide your user name!" );
				  document.getElementById('er_uname').innerHTML="Please provide your user name!";
				  document.frm_step1.uname.focus() ;
				  return false;
			   }else{
				   username=document.frm_step1.uname.value;
					document.getElementById('er_uname').innerHTML="";
			   }
			    if( document.frm_step1.psw.value == "" )
			   {
				  //alert( "Please provide your user name!" );
				  document.getElementById('er_psw').innerHTML="Please provide your Password!";
				  document.frm_step1.psw.focus() ;
				  return false;
			   }else{
				   password=document.frm_step1.psw.value;
					document.getElementById('er_psw').innerHTML="";
			   }
		 }
				 
       $(".loading_popup").css("display","block");
	  $(".loading_popup_overlay").css("display","block");
	  document.frm_step1.submit();

	  
	 /* var dataString = 'set=checkrootuser&dbname='+dbname+'&username='+username+'&password='+password+'&hostname='+hostname+'&typelike='+typelike;
                                                $.ajax({
                                                       type: "POST",
                                                       url: "load_index.php",
                                                       data: dataString,
                                                       success:function(data)
														{ //alert(data);
														  
														 $("#load_details_msg").html(data);
														}
												});*/
	  
	   
        
       
      // alert("The paragraph was clicked.");
      //$("#frm_step1").submit();
});  
 // loading_popup loading_popup_overlay loading_popup_ok_click  
  
   $("#loading_popup_ok_click").click(function(){
	   $(".loading_popup").css("display","none");
	  $(".loading_popup_overlay").css("display","none");
	
 });  
  
 $("#btn_proceed").click(function(){
	  if( document.frm_step1.dbname.value == "" )
         {
            //alert( "Please provide your Database name!" );
            document.getElementById('er_dbname').innerHTML="Please provide your Database name!";
            document.frm_step1.dbname.focus() ;
            return false;
            
         }else{
			 dbname=document.frm_step1.dbname.value;
             document.getElementById('er_dbname').innerHTML="";
			 window.location.href="step-second.php?db=dbname";
         }
	
 }); 
$(document).ready(function(){
  
});
</script>

