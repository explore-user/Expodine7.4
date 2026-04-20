<?php

//error_reporting(0);
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


//////////item---- cancellation----- starts/////////////


$sql_smskot =  $database->mysqlQuery("Select * from tbl_branchmaster "); 
		  $num_smskot  = $database->mysqlNumRows($sql_smskot);
		  if($num_smskot)
		  {
		         while($result_smskot  = $database->mysqlFetchArray($sql_smskot)) 
					{
                             
                              $smsvoidkot                               =$result_smskot['be_sms_void'];
                              $emailvoidkot                               =$result_smskot['be_email_void'];
                             
                             
                                        }
                                        
                                   }
                        
                         
 if($smsvoidkot=="Y"){
                     
                     
                     $sql_smskotnew =  $database->mysqlQuery("Select ch_kot_cancel_id,ch_orderslno from tbl_tableorder_changes where ch_sms='N' "); 
		  $num_smskotnew  = $database->mysqlNumRows($sql_smskotnew);
		  if($num_smskotnew)
		  {
		         while($result_smskotnew  = $database->mysqlFetchArray($sql_smskotnew)) 
					{
     
                                                $kotnew=$result_smskotnew['ch_kot_cancel_id'];
                                                   $slno=$result_smskotnew['ch_orderslno'];
  
  

                               
                  
                $sql_sms12kot =  $database->mysqlQuery("Select * from tbl_branchmaster "); 
		  $num_sms12kot  = $database->mysqlNumRows($sql_sms12kot);
		  if($num_sms12kot)
		  {
		         while($result_sms12kot  = $database->mysqlFetchArray($sql_sms12kot)) 
					{
                             
                                                 $allnumkot                                =$result_sms12kot['be_sms_list'];
                                                 $allmailkot                               =$result_sms12kot['be_reportemail_list'];
                             
                             
                                        }
                                        
                         }  
                         
                        // echo $slno;         

    for($i=0;$i<count($slno);$i++){      
        
        
         $sql_qry = $database->mysqlQuery("select * from tbl_tableorder 
        where ter_orderno = '".$_SESSION['order_id']."' and ter_slno = $slno[$i] order by ter_slno asc");
         
        $num_rows  = $database->mysqlNumRows($sql_qry);
        if($num_rows){
            $result_row  = $database->mysqlFetchArray($sql_qry);
        
                  $sql_sms121kot =  $database->mysqlQuery("Select toc.ch_entrydate,ts.ser_firstname,toc.ch_cancelledby_careof,tm.mr_menuname,toc.ch_cancelled_qty,toc.ch_orderno,tbl.ter_menuid  from tbl_tableorder_changes toc left join tbl_tableorder tbl on tbl.ter_orderno=toc.ch_orderno and tbl.ter_slno=toc.ch_orderslno left join tbl_menumaster tm on tm.mr_menuid=tbl.ter_menuid  left join tbl_staffmaster ts on ts.ser_staffid=toc.ch_cancelledby_careof  where  ch_kot_cancel_id='".$kotnew."' and ch_orderno='".$_SESSION['order_id']."'and ch_orderslno='$slno[$i]'  " ); 
                   //echo "Select toc.ch_entrydate,ts.ser_firstname,toc.ch_cancelledby_careof,tm.mr_menuname,toc.ch_cancelled_qty,toc.ch_orderno,tbl.ter_menuid  from tbl_tableorder_changes toc left join tbl_tableorder tbl on tbl.ter_orderno=toc.ch_orderno and tbl.ter_slno=toc.ch_orderslno left join tbl_menumaster tm on tm.mr_menuid=tbl.ter_menuid  left join tbl_staffmaster ts on ts.ser_staffid=toc.ch_cancelledby_careof  where  ch_kot_cancel_id='".$kotnew."' and ch_orderno='".$_SESSION['order_id']."'and ch_orderslno='$slno[$i]'  ";
                  
                  $num_sms121kot  = $database->mysqlNumRows($sql_sms121kot);
		  if($num_sms121kot)
		  {
		         while($result_sms121kot  = $database->mysqlFetchArray($sql_sms121kot)) 
					{
                             
                                                  
                                       $datadetailkotqty.=$result_sms121kot['ch_cancelled_qty'].",";                                          
                                        $ord                                         =$result_sms121kot['ch_orderno'];  
                                        $menu.=$result_sms121kot['mr_menuname'].","; 
                                         $staff          =$result_sms121kot['ser_firstname'];
                                          $time          =$result_sms121kot['ch_entrydate'];
                                       
                                           
                                          
                                        }
                                        
                         }
 } 
 
    }
}
                  }
                  
                  
     $mn2=  rtrim($menu, ",");    
             $mn3= explode(",", $mn2);
             
            $qt2=  rtrim($datadetailkotqty, ",");    
             $qt3= explode(",", $qt2);
             
             
for($f1=0;$f1<count($mn3);$f1++){
    $datasms.="( Item : ". $mn3[$f1]." | Qty : ".$qt3[$f1].") * ";              
}              
 $od=$ord;
 $stf=$staff;
 $tim=$time;
 $detail11="Order no :".$od .",      Cancelled by :".$stf." , Time :".$tim;

 //echo $datasms;
                

 if($ord!=""){
 
$domain=$be_sms_domainid;
$username=$be_sms_username;
$api_password=$be_sms_apipassword;
 

    $sms_list=$allnumkot;
    

  
 $smstext="*Item Cancellation Details*       $detail11      $datasms";
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
                if($resu1[1]=="Sent" || $resu1[1]=='Delivered'){
               $sql_smssentkot_updation  =  $database->mysqlQuery("Update tbl_tableorder_changes set ch_sms='Y',ch_sms_time=NOW() where ch_kot_cancel_id='$kotnew'");
                
                }
                fpassthru($fp);
		fclose($fp);
                       
                
                
 }   
                
                
                                        
                  }
    //sms item end//                         
          
                  
                  
                  
                  
                  
                  
                  
                  
       //email item///
                
                  
         if($emailvoidkot=="Y"){    
             
             
        $sql_smskotnewemail =  $database->mysqlQuery("Select ch_kot_cancel_id,ch_orderslno from tbl_tableorder_changes where ch_email='N'  "); 
		  $num_smskotnewemail  = $database->mysqlNumRows($sql_smskotnewemail);
		 
                 
                  if($num_smskotnewemail)
		  {    
		         while($result_smskotnewemail  = $database->mysqlFetchArray($sql_smskotnewemail)) 
					{
     
                                                $kotnewemail=$result_smskotnewemail['ch_kot_cancel_id'];
                                                   $slnoemail=$result_smskotnewemail['ch_orderslno'] ;          
                  
                  
                  
                  
                                                 
                         
      
       
                    
                    
     
    for($j=0;$j<count($slnoemail);$j++){      
        
        
         $sql_qryemail = $database->mysqlQuery("select * from tbl_tableorder 
        where ter_orderno = '".$_SESSION['order_id']."' and ter_slno = $slnoemail[$j] order by ter_slno asc");
        $num_rowsemail  = $database->mysqlNumRows($sql_qryemail);
        if($num_rowsemail){
            $result_rowemail  = $database->mysqlFetchArray($sql_qryemail);
        
                  $sql_sms121kotemail =  $database->mysqlQuery("Select toc.ch_entrydate,ts.ser_firstname,toc.ch_cancelledby_careof,tm.mr_menuname,toc.ch_cancelled_qty,toc.ch_orderno,tbl.ter_menuid  from tbl_tableorder_changes toc left join tbl_tableorder tbl on tbl.ter_orderno=toc.ch_orderno and tbl.ter_slno=toc.ch_orderslno left join tbl_menumaster tm on tm.mr_menuid=tbl.ter_menuid  left join tbl_staffmaster ts on ts.ser_staffid=toc.ch_cancelledby_careof  where  ch_kot_cancel_id='".$kotnewemail."' and ch_orderno='".$_SESSION['order_id']."'and ch_orderslno='$slnoemail[$j]'  " ); 
                 // echo "Select toc.ch_entrydate,ts.ser_firstname,toc.ch_cancelledby_careof,tm.mr_menuname,toc.ch_cancelled_qty,toc.ch_orderno,tbl.ter_menuid  from tbl_tableorder_changes toc left join tbl_tableorder tbl on tbl.ter_orderno=toc.ch_orderno and tbl.ter_slno=toc.ch_orderslno left join tbl_menumaster tm on tm.mr_menuid=tbl.ter_menuid  left join tbl_staffmaster ts on ts.ser_staffid=toc.ch_cancelledby_careof  where  ch_kot_cancel_id='".$kotnewemail."' and ch_orderno='".$_SESSION['order_id']."'and ch_orderslno='$slnoemail[$j]'  ";  
                  
                  $num_sms121kotemail  = $database->mysqlNumRows($sql_sms121kotemail);
		  if($num_sms121kotemail)
		  {
		         while($result_sms121kotemail  = $database->mysqlFetchArray($sql_sms121kotemail)) 
					{
                             
                                                  
                                       $datadetailkotqtyemail.=$result_sms121kotemail['ch_cancelled_qty'].",";                                          
                                        $ordemail                                        =$result_sms121kotemail['ch_orderno'];  
                                        $menuemail.=                              $result_sms121kotemail['mr_menuname'].","; 
                                         $staffemail                                        =$result_sms121kotemail['ser_firstname'];
                                          $timeemail                                         =$result_sms121kotemail['ch_entrydate'];
                                       
                                           
                                          
                                        }
                                        
                         }
 } 
                  }
                  
                   }
                   
                 }
                 
             $mn=  rtrim($menuemail, ",");    
             $mn1= explode(",", $mn);
             
            $qt=  rtrim($datadetailkotqtyemail, ",");    
             $qt1= explode(",", $qt);
             
             
for($f=0;$f<count($mn1);$f++){
    $datasmsemail.="( Item : ". $mn1[$f]." | Qty : ".$qt1[$f].") * "; 
   
                // $datasmsemail.= $mn1[$f]."----".$qt1[$f];
}
 $odemail=$ordemail;
 $stfemail=$staffemail;
 $timemail=$timeemail;
 $detail11email="Order no :".$odemail .",      Cancelled by :".$stfemail." , Time :".$timemail;

 
               
     if($ordemail!=""){                        
                             
                $sql_sms124item =  $database->mysqlQuery("Select * from tbl_branchmaster "); 
		  $num_sms124item  = $database->mysqlNumRows($sql_sms124item);
		  if($num_sms124item)
		  {
		         while($result_sms124item  = $database->mysqlFetchArray($sql_sms124item)) 
					{
                             
                              $allnum4item                                =$result_sms124item['be_sms_list'];
                              $allmail4item                               =$result_sms124item['be_reportemail_list'];
                             
                             
                                        }
                                        
                         }
                 
       		
		$string1="* Item Cancellation Details  *

.$detail11email  $datasmsemail

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
        $mail->Subject = "EXPODINE - ".$branchname;
        $mail->Body = $string1;
          
        
        $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

        
        $emls=explode(",",$allmail4item);
		  $ctem=count($emls);
		  if($ctem==0)
		  {
		  		 $mail->AddAddress($allmail4item);
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
            $sql_smssentkot_updation  =  $database->mysqlQuery("Update tbl_tableorder_changes set ch_email='Y',ch_email_time=NOW() where ch_kot_cancel_id='$kotnewemail' ");
        }
                  
                     
                         

                                            
    }
                     }
                
                     
    
                  
                //end item//
     ?>
 

           
       

