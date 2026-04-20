<?php 

include("..\database.class.php"); 
$database	= new Database();
include ('dumper.php');

error_reporting(E_ALL & ~E_DEPRECATED);

 if(isset($_REQUEST['set_backup']) && ($_REQUEST['set_backup']=="backup_dayclose")){
  
        $db_name=DATABASE_NAME;
    
        $db_name1=DATABASE_NAME_REPORT; 
    
 function delete_older_than($dir, $max_age) {
      
    $list = array();
    $limit = time() - $max_age;
    $dir = realpath($dir);
    
    if (!is_dir($dir)) {
      return;
    }
    $dh = opendir($dir);
    if ($dh === false) {
      return;
    }
    while (($file = readdir($dh)) !== false) {
      $file = $dir . '/' . $file;
      if (!is_file($file)) {
        continue;
    }
    if (filemtime($file) < $limit) {
        $list[] = $file;
        unlink($file);
    }
    }

    closedir($dh);
    return $list;
  
 }
 
 
 
    $locationdb16='..\..\util\Dayclose_DB_Backup';
    if(!is_dir($locationdb16)){
        mkdir($locationdb16, 0777);   
    }
    
    //archivedbtables//

    $bckname1='\backup_arc'.date("Y-m-d").'.sql';//
    
    $locationdb1='..\..\util\Dayclose_DB_Backup\Archieve_tables';
    if(!is_dir($locationdb1)){
        mkdir($locationdb1, 0777);   
    }

    
    $files = scandir($locationdb1);

    $num_files = count($files)-2;
    
    if($num_files>4){
        
     //  $deleted1 = delete_older_than($locationdb1, 3600*24*5);
        
        
        $files3 = glob($locationdb1 . "/*");
      usort($files3, function($a, $b) {
        return filemtime($b) - filemtime($a);
    });
    foreach (array_slice($files3, 5) as $oldFile) {
        if (is_file($oldFile)) {
            unlink($oldFile);
        }
    }
       
    }
    
    
    ///fulldb///
    
    $locationdb3='..\..\util\Dayclose_DB_Backup\Full_db_normal';
    if(!is_dir($locationdb3)){
        mkdir($locationdb3, 0777);   
    }
    
   $files1 = scandir($locationdb3);

   $num_files1 = count($files1)-2;
   
   if($num_files1>4){ 
       
     //$deleted22 = delete_older_than($locationdb3, 3600*24*5);
     
     $files6 = glob($locationdb3 . "/*");
    usort($files6, function($a, $b) {
        return filemtime($b) - filemtime($a);
    });
    foreach (array_slice($files6, 5) as $oldFile6) {
        if (is_file($oldFile6)) {
            unlink($oldFile6);
        }
    }
     
   }
   
   
        $locationdb="C:\backup_new";
        $sql_db  =  $database->mysqlQuery("select be_dbbackuplocation  from tbl_branchmaster"); 
        $num_db   = $database->mysqlNumRows($sql_db);
        if($num_db){
            $result_dbloc  = $database->mysqlFetchArray($sql_db);
            
            $locationdb= $result_dbloc['be_dbbackuplocation'];										  
        }
        
   
          ///table repair if error////
          $tables = array(
                "tbl_printer_function_log",
                "tbl_reprint_details",
                "tbl_general_settings_log"
           );

            foreach($tables as $table_name){

                $sql_check = $database->mysqlQuery("CHECK TABLE $table_name");

                $error_found = false;

                while($row = $database->mysqlFetchArray($sql_check)){
                    if($row['Msg_text'] != 'OK'){
                        $error_found = true;
                        //echo "Error : ".$row['Msg_text']."<br>";
                    }
                }
                
                if($error_found){
                    $sql_repair = $database->mysqlQuery("REPAIR TABLE $table_name");
                    while($row = $database->mysqlFetchArray($sql_repair)){
                       // echo $row['Msg_text']."<br>";
                    }
                }
            }
        //repair end////
        
        
        
        
        if(!is_dir($locationdb)){

           mkdir($locationdb , 0777,TRUE);   

        }
       

        $files2 = scandir($locationdb);

        $num_files2 = count($files2)-2;

        if($num_files2>10){ 

           $deleted23 = delete_older_than($locationdb, 3600*24*10);

        }
   
   
}
try
{
	
 ///////////////////////////////////// ARCHIEVE DB TABLES ONLY /////////////////////////////////////
        
        $world_dumper = Shuttle_Dumper::create(array(
		'host' => HOST_NAME,
		'username' => USER_NAME,
		'password' => PASSWORD,
		'db_name' => $db_name1,
	));
       
	$world_dumper->dump($locationdb1.$bckname1.'.gz');
        
         if(is_dir($locationdb)){
           $world_dumper->dump($locationdb.$bckname1.'.gz');
         }

/////////////////////////////////////APACHE FULL DB/////////////////////////////////////
       
    $my_sql_loc1="C:\Program Files\MySQL\MySQL Server 5.7";
    
    if (file_exists($my_sql_loc1)) {   
        
    $filename3 = $locationdb3."\backup_" . date("Y-m-d") . ".sql";
    
    $command = '"C:\Program Files\MySQL\MySQL Server 5.7\bin\mysqldump.exe" '.DATABASE_NAME ." -u".USER_NAME ." -p".PASSWORD." -h".HOST_NAME ." --single-transaction  --routines=true --triggers=true > $filename3";
    passthru($command);

    }
    
    $my_sql_loc="C:\MySQL\bin";
    
    if (file_exists($my_sql_loc)) {
    
    $filename3 = $locationdb3."\backup_" . date("Y-m-d") . ".sql";
    
    $command = '"C:\MySQL\bin\mysqldump.exe" '.DATABASE_NAME ." -u".USER_NAME ." -p".PASSWORD." -h".HOST_NAME ." --single-transaction  --routines=true --triggers=true > $filename3";
    passthru($command);

    }
    
    
    ///to D drive or other  manual db backup ////
    
    if(is_dir($locationdb)){
        
    $manual_location = $locationdb."\backup_" . date("Y-m-d") . ".sql";   
    $my_sql_loc1="C:\Program Files\MySQL\MySQL Server 5.7";
    
    if (file_exists($my_sql_loc1)) {
      $command5 = '"C:\Program Files\MySQL\MySQL Server 5.7\bin\mysqldump.exe" '.DATABASE_NAME ." -u".USER_NAME ." -p".PASSWORD." -h".HOST_NAME ." --single-transaction  --routines=true --triggers=true > $manual_location";
      passthru($command5);
    }
    
    $my_sql_loc="C:\MySQL\bin";
    if (file_exists($my_sql_loc)) {
      $command5 = '"C:\MySQL\bin\mysqldump.exe" '.DATABASE_NAME ." -u".USER_NAME ." -p".PASSWORD." -h".HOST_NAME ." --single-transaction  --routines=true --triggers=true > $manual_location";
      passthru($command5);
    }
    
    
    }
    
    
   echo 'Backup';
   //////////////////////////MAIL --- BACKUP NOT DONE////////////////////
    
   require_once('../Mailer/PHPMailerAutoload.php');
   
   
  $path="..\..\util\Dayclose_DB_Backup\Full_db_normal";

//    $total_size = 0;
//    $files = scandir($path);
//
//    foreach($files as $t) {
//      if (is_dir(rtrim($path, '/') . '/' . $t)) {
//        if ($t<>"." && $t<>"..") {
//            
//            $size = foldersize(rtrim($path, '/') . '/' . $t);
//            $total_size += $size;
//        }
//      } else {
//          
//        $size = filesize(rtrim($path, '/') . '/' . $t);
//        $total_size += $size;
//      }
//    }
//   $dbsize_exp= number_format( ($total_size/ (1024 * 1024)),2);
   
   $location_in_date='..\..\util\Dayclose_DB_Backup\Full_db_normal';
    
   $files15 = scandir($location_in_date);

   $num_files15 = count($files15)-2;
    
    
    if($num_files15<2){
       
     $dc_date=date("Y-m-d");
   
     $allmail=''; $branchname='';
   
   
                    $sale_date='';          
                    $sql_desg_nos1="select dc_day from tbl_dayclose where dc_timeclose IS NULL order by dc_id desc limit 1 ";
                    $sql_desg1  =  $database->mysqlQuery($sql_desg_nos1);
                    $num_desg1  = $database->mysqlNumRows($sql_desg1);
                    if($num_desg1){
                    while($result_desg1  = $database->mysqlFetchArray($sql_desg1)) 
                    {

                        $sale_date =$result_desg1['dc_day'];

                    }}
   
   
                  $sql_sms1 =  $database->mysqlQuery("Select be_reportemail_list , be_branchname from tbl_branchmaster"); 
		  $num_sms1  = $database->mysqlNumRows($sql_sms1);
		  if($num_sms1)
		  {
		        while($result_sms1  = $database->mysqlFetchArray($sql_sms1)) 
			{
                                 
                            $branchname=$result_sms1['be_branchname'];
                        }
                  } 
                  
                  $msg_temp= "OUTLET : $branchname <br> SALE DATE : ".$sale_date ."<br> IGNORE IF NEW OULTLET OPENED IN LAST 2 DAYS. " ;         
                   
	          $sql_general = $database->mysqlQuery("Select * from tbl_generalsettings"); 
		  $num_general  = $database-> mysqlNumRows($sql_general);
		  if($num_general)
		  {
				while($result_general  =$database->mysqlFetchArray($sql_general)) 
					{
						 $be_mail_server			=$result_general['be_mail_server'];
						 $be_mail_port				=$result_general['be_mail_port'];
						 $be_mail_emailid			=$result_general['be_mail_emailid'];
						 $be_mail_password			=$result_general['be_mail_password'];
						 $be_mail_secure			=$result_general['be_mail_secure'];
						 $be_mail_from			        =$result_general['be_mail_from'];
					}
		  }
               
        $mail = new PHPMailer();
        $mail->isSMTP();
        $mail->CharSet = "UTF-8";
        $mail->SMTPSecure = $be_mail_secure;
        $mail->SMTPOptions = array(
            'ssl' => array(
                'verify_peer' => false,
                'verify_peer_name' => false,
                'allow_self_signed' => true
            )
        );        
        
        $allmail='support@exploreitsolutions.com';
       
        $from_name="Expodine";      
        $mail->Host = $be_mail_server;
        $mail->SMTPAuth = true;
        $mail->Username = $be_mail_emailid;
        $mail->Password = $be_mail_password;
        $mail->Port = $be_mail_port;
        $mail->SetFrom($be_mail_from,$from_name);
        $mail->Subject = $branchname. " :  DB BACKUP NOT DONE ON DATE : ".$sale_date;
        $mail->Body = $msg_temp;
        $mail->addBCC('support@exploreitsolutions.com,qa@exploreitsolutions.com,tester@exploreitsolutions.com');
        $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

        $emls=explode(",",$allmail);
		  $ctem=count($emls);
		  if($ctem==0)
		  {
		          $mail->AddAddress($allmail);
		  }else
		  {
			for($k=0;$k<$ctem;$k++)
			 {
			    $mail->AddAddress($emls[$k]);
			 }
		  }
                  
            $mail->send();
         
            $to = 'support@exploreitsolutions.com,qa@exploreitsolutions.com,tester@exploreitsolutions.com';
            $subject = $branchname. " :  DB BACKUP NOT DONE ON DATE : ".$sale_date;
            $message = ' NO DATABASE BACKUP '.$msg_temp; 

            $headers = "From: <from@gmail.com>";
            
            mail($to,$subject,$message, $headers);
           
    }
  
} 
catch(Shuttle_Exception $e) {
    
   echo "Couldn't dump database: " . $e->getMessage();
}