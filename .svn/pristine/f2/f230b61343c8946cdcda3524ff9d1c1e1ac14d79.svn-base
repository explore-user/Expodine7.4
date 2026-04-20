

<?php
error_reporting(0);
session_start();
include("..\..\src\database.class.php"); // DB Connection class
include('..\..\src\email\km_smtp_class.php');
 require_once('..\..\src\Mailer/PHPMailerAutoload.php');
$database	= new Database(); 


   $sql_sms =  $database->mysqlQuery("Select * from tbl_generalsettings "); 
		  $num_sms  = $database->mysqlNumRows($sql_sms);
		  if($num_sms)
		  {
		         while($result_sms  = $database->mysqlFetchArray($sql_sms)) 
					{
					         $be_sms_username			=$result_sms['be_sms_username'];
						 $be_sms_apipassword		        =$result_sms['be_sms_apipassword'];
						 $be_sms_senderid			=$result_sms['be_sms_senderid'];
					         $be_sms_domainid			=$result_sms['be_sms_domainid'];
                                                 $be_sms_priority			=$result_sms['be_sms_priority'];
                                                 $be_sms_method			        =$result_sms['be_sms_method'];
                                                 $be_mail_server			=$result_sms['be_mail_server'];
						 $be_mail_port				=$result_sms['be_mail_port'];
						 $be_mail_emailid			=$result_sms['be_mail_emailid'];
						 $be_mail_password			=$result_sms['be_mail_password'];
						 $be_mail_secure			=$result_sms['be_mail_secure'];
						 $be_mail_from			        =$result_sms['be_mail_from'];
                                                
                                        }
		  }
   

//////////// bill cancel starts/////////////

                 $sql_sms22 =  $database->mysqlQuery("Select * from tbl_branchmaster "); 
		  $num_sms22  = $database->mysqlNumRows($sql_sms22);
		  if($num_sms22)
		  {
		         while($result_sms22  = $database->mysqlFetchArray($sql_sms22)) 
					{
                             
                              $smsvoid1                                =$result_sms22['be_sms_void'];
                              $emailvoid1                               =$result_sms22['be_email_void'];
                             
                             
                                        }
                                        
                         }
    
                         
                       
                        if($smsvoid1=="Y"){    
                            
                            
                   $sql_sms22bill =  $database->mysqlQuery("Select bc_billno  from tbl_billcancel_log where bc_sms_status='N' "); 
		  $num_sms22bill  = $database->mysqlNumRows($sql_sms22bill);
		  if($num_sms22bill)
		  {
		         while($result_sms22bill  = $database->mysqlFetchArray($sql_sms22bill)) 
					{
                  
                  
                                $billnosms=$result_sms22bill['bc_billno'];
    

  
  
    
   

 

                  
                  
                $sql_sms12 =  $database->mysqlQuery("Select * from tbl_branchmaster "); 
		  $num_sms12  = $database->mysqlNumRows($sql_sms12);
		  if($num_sms12)
		  {
		         while($result_sms12  = $database->mysqlFetchArray($sql_sms12)) 
					{
                             
                                                 $allnum                                =$result_sms12['be_sms_list'];
                                                 $allmail                               =$result_sms12['be_reportemail_list'];
                             
                             
                                        }
                                        
                         }  
                  
                  $sql_sms121 =  $database->mysqlQuery("Select * from tbl_billcancel_log where  bc_billno='".$billnosms."'"); 
		  $num_sms121  = $database->mysqlNumRows($sql_sms121);
		  if($num_sms121)
		  {
		         while($result_sms121  = $database->mysqlFetchArray($sql_sms121)) 
					{
                             
                                                   $datadetail                                =$result_sms121['bc_details'];
                                                                                
                             
                             
                                        }
                                        
                         }
                  
                  //echo $allnum;
               
$domain=$be_sms_domainid;
$username=$be_sms_username;
$api_password=$be_sms_apipassword;
 

    $sms_list=$allnum;

  
 $smstext="*Bill Cancellation Details*  - $datadetail";
 $sender =$be_sms_senderid;              
  $route=$be_sms_priority;
   $smstype = $be_sms_method; 
    $message=urlencode($smstext);
//$parameters="username=$username&api_password=$api_password&sender=$sender&to=$sms_list&message=$message&priority=$priority";

  $parameters="username=$username&api_password=$api_password&sender=$sender&to=$sms_list&priority=$route&message=$message";
 $fp = fopen("http://$domain/pushsms.php?$parameters", "r");
   
  $response['messages'] = stream_get_contents($fp);
             $res=explode("Trackid",$response['messages']);
             $res1=explode("alert_",$res[0]);
             $dl=trim($res1[1]);
             
   $b1=fopen("http://$domain/fetchdlr.php?username=$username&msgid=$dl","r");
    $response12['messages'] = stream_get_contents($b1);
    $resu1=explode("Dlr Status: ",$response12['messages']);
    
    echo  $resu1[1];
                if($resu1[1]=="Sent" ||  $resu1[1]=='Delivered'){
                $sql_smssent_updation  =  $database->mysqlQuery("Update tbl_billcancel_log set bc_sms_status='Y',bc_sms_time=NOW() where bc_billno='".$billnosms."'");
                
                }
                fpassthru($fp);
		fclose($fp);
                        }
 
  
  
                                        }
                  }
                  
                  
  ///sms ends////          
                  
                  
                  
              ///email starts////    
                 if($emailvoid1=="Y"){  
                     
                  $sql_sms22billemail =  $database->mysqlQuery("Select bc_billno  from tbl_billcancel_log where bc_email_status='N' "); 
		  $num_sms22billemail  = $database->mysqlNumRows($sql_sms22billemail);
		  if($num_sms22billemail)
		  {
		         while($result_sms22billemail  = $database->mysqlFetchArray($sql_sms22billemail)) 
					{
                  
                  
                                $billnoemail=$result_sms22billemail['bc_billno'];
                  
                  
                  
                   
                         
                        
                
                         $sql_sms1211 =  $database->mysqlQuery("Select * from tbl_billcancel_log where  bc_billno='".$billnoemail."'"); 
                        
		  $num_sms1211  = $database->mysqlNumRows($sql_sms1211);
		  if($num_sms1211)
		  {
		         while($result_sms1211  = $database->mysqlFetchArray($sql_sms1211)) 
					{
                             
                                                   $datadetail1                                =$result_sms1211['bc_details'];
                                                                                
                             
                             
                                        }
                                        
                         }
                         
                             
                $sql_sms124 =  $database->mysqlQuery("Select * from tbl_branchmaster "); 
		  $num_sms124  = $database->mysqlNumRows($sql_sms124);
		  if($num_sms124)
		  {
		         while($result_sms124  = $database->mysqlFetchArray($sql_sms124)) 
					{
                             
                              $allnum4                                =$result_sms124['be_sms_list'];
                              $allmail4                               =$result_sms124['be_reportemail_list'];
                             
                             
                                        }
                                        
                         }
                 $bno1=$billnoemail;  
                 
             		
		$string1="* Bill Cancellation Details *

.$datadetail1 

";    
                 
                 
                 
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
       
         $from_name="Expodine";      
        $mail->Host = $be_mail_server;
        $mail->SMTPAuth = true;
        $mail->Username = $be_mail_emailid;
        $mail->Password = $be_mail_password;
        $mail->Port = $be_mail_port;
        $mail->SetFrom($be_mail_from,$from_name);
        $mail->Subject = "EXPODINE - ".$branchname ;
        $mail->Body = $string1;
         
        
        $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

        
        $emls=explode(",",$allmail4);
		  $ctem=count($emls);
		  if($ctem==0)
		  {
		  		 $mail->AddAddress($allmail4);
		  }else
		  {
			  for($k=0;$k<$ctem;$k++)
			  {
				 
                                   $mail->AddAddress($emls[$k]);
			  }
		  }   
        
        if (!$mail->send()) {
            echo 'Message could not be sent.';
            echo 'Mailer Error: ' . $mail->ErrorInfo;
        } else {
          echo 'Message sent.';
           $sql_emailsent_updation  =  $database->mysqlQuery("Update tbl_billcancel_log set bc_email_status='Y',bc_email_time=NOW() where bc_billno='".$billnoemail."'");
        }
         
                 
                 

                                            
	
                     }
  
 



                                        }
                  }





