<?php
include('includes/session.php');		// Check session
include("database.class.php"); // DB Connection class
$database	= new Database(); 		// Create a new instance

if($_REQUEST['value']=='staff_assign'){//Assign staff for orders
    $bills = $_REQUEST['bills'];
    $staffid = $_REQUEST['staffid'];
    $bill = array();
    $bill = explode(",",$bills);
    $billlength = sizeof($bill);
    for($i=0;$i<$billlength;$i++){
        $sql_bill  =  $database->mysqlQuery("UPDATE tbl_takeaway_billmaster SET tab_assignedto = '$staffid', tab_delivery_status = 'A' WHERE tab_billno = '$bill[$i]'"); 
    }
    
}elseif($_REQUEST['value']=='del_billby_staff'){//Delete assigned orders from staff
    $billno = $_REQUEST['billno'];
    $staffid = $_REQUEST['staffid'];
    $sql_billbystaff  =  $database->mysqlQuery("UPDATE tbl_takeaway_billmaster
    SET tab_delivery_status = 'NA', tab_assignedto = NULL
    WHERE tab_billno = '$billno' AND tab_assignedto = '$staffid'");
}elseif($_REQUEST['value']=='timealot'){//Alot time for delivery
    $staffid = $_REQUEST['staffid'];
    $alotted_time = $_REQUEST['alotted_time'];
    $datetime = date("Y-m-d h:i:s");
    $sql_timealot  =  $database->mysqlQuery("UPDATE tbl_takeaway_billmaster
    SET tab_delivery_status = 'P', tab_assignedtime = NOW(), tab_esttime = DATE_ADD(NOW(), INTERVAL $alotted_time MINUTE)
    WHERE tab_delivery_status = 'A' AND tab_assignedto = '$staffid'");
    
    
    /////qrupdate////
    
    $qr_branch=''; $qr_db='';
    $sql_login_dc  =  $database->mysqlQuery("select tb.be_qrcode_db,tc.bsc_cloud_branchid from tbl_branchmaster tb left join  tbl_branch_settings_cloud tc on tc.bsc_branchid=tb.be_branchid "); 
$num_cat_s_dc  = $database->mysqlNumRows($sql_login_dc);
if($num_cat_s_dc){
 while($result_cat_s_tc  = $database->mysqlFetchArray($sql_login_dc)) 
	  {
     
     $qr_branch=$result_cat_s_tc['bsc_cloud_branchid'];
      $qr_db=$result_cat_s_tc['be_qrcode_db'];
 }
}

$date=date('Y-m-d H:i:s');

$localhost1=mysqli_connect(HOST_NAME_CLOUD, USER_NAME_CLOUD, PASSWORD_CLOUD,DATABASE_NAME_QR);

 
 
    $delivery_number="select tbm.tab_qr_order_id, tbm.tab_billno AS billno
    FROM tbl_takeaway_billmaster tbm
    left join tbl_takeaway_customer tc on tbm.tab_hdcustomerid = tc.tac_customerid
    left join tbl_staffmaster sm on sm.ser_staffid = tbm.tab_assignedto
    where tbm.tab_assignedto='".$staffid."' and tbm.tab_delivery_status = 'P'";
    
    $q=  $database->mysqlQuery($delivery_number);
    if($q){
        $bill_numsms="";
        $ct="";
        while($row= $database->mysqlFetchArray($q)){
            
            $sql_gen =  mysqli_query($localhost1,"Update tbl_qr_order_details set tq_order_picked='Y' ,tq_order_picked_time='$date' where tq_branch='$qr_branch' and tq_order_no='".$row['tab_qr_order_id']."' ");  
            
            
        }
        }
    
     /////qrupdate end////
    
    
    
    
}elseif ($_REQUEST['value']=='sendsms') {
    
    $staffid = $_REQUEST['staffid'];
    $alotted_time = $_REQUEST['alotted_time'];
      $sql_general =  $database->mysqlQuery("Select * from tbl_generalsettings "); 
        $num_general  = $database->mysqlNumRows($sql_general);
        
        if($num_general)
        {
            while($result_general  = $database->mysqlFetchArray($sql_general)) 
            {
                $be_sms_username=$result_general['be_sms_username'];
                $be_sms_apipassword=$result_general['be_sms_apipassword'];
                $be_sms_senderid=$result_general['be_sms_senderid'];
                $be_sms_domainid=$result_general['be_sms_domainid'];
                $be_sms_priority	=$result_general['be_sms_priority'];
                $be_sms_method  =$result_general['be_sms_method'];                                                                                                                                                             
            }
	}
         
    $delivery_number="select tc.tac_customername ,tc.tac_contactno, sm.ser_firstname, sm.ser_mobileno ,TIMESTAMPDIFF(MINUTE,tbm.tab_assignedtime,tbm.tab_esttime) AS alottedtime ,tbm.tab_billno AS billno
    FROM tbl_takeaway_billmaster tbm
    left join tbl_takeaway_customer tc on tbm.tab_hdcustomerid = tc.tac_customerid
    left join tbl_staffmaster sm on sm.ser_staffid = tbm.tab_assignedto
    where tbm.tab_assignedto='".$staffid."' and tbm.tab_delivery_status = 'P'";
    
    $q=  $database->mysqlQuery($delivery_number);
    if($q){
        $bill_numsms="";
        $ct="";
        while($row= $database->mysqlFetchArray($q)){
            $timesms=$row['alottedtime'];
            $billnumsms=$row['billno'];
            $bill_numsms.="Bill num: ".$row['billno']."\n"."Customer: ".$row['tac_customername']." ".$row['tac_contactno']."\n";
            $sms_list= $row['tac_contactno'] ;
            $smstext="  *".     $_SESSION['s_branchname']."*\n  Dear ".$row['tac_customername'].",\nYour order will be delivered in ".$row['alottedtime']."mins. \n Staff: ".$row['ser_firstname']."\n Contact No:".$row['ser_mobileno']."";
            $sms_list1=  $row['ser_mobileno'];
            $smstype = $be_sms_method; 
            $username=urlencode($be_sms_username);
            $sender=urlencode($be_sms_senderid);
            $message=urlencode($smstext);
            $domain=urlencode($be_sms_domainid);
            $route=urlencode($be_sms_priority);
                                     
           
            $parameters="username=$username&api_password=$api_password&sender=$sender&to=$sms_list&priority=$route&message=$message";
            $fp = fopen("http://$domain/pushsms.php?$parameters", "r");
            
            $response['messages'] = stream_get_contents($fp);
            
            $res1=explode("Trackid",$response['messages']);
             $res11=explode("alert_",$res1[0]);
             $d2=trim($res11[1]);
    
              $b11=fopen("http://$domain/fetchdlr.php?username=$username&msgid=$d2","r");
    $response12['messages'] = stream_get_contents($b11);
    $resu11=explode("Dlr Status: ",$response12['messages']);
            
           
    if($resu11[1]=="Sent" || $resu11[1]=='Delivered'){
              $stcus=$database->mysqlQuery("UPDATE tbl_takeaway_billmaster SET tab_msg_customerstatus='Y' where tab_billno ='".$row['billno']."'");
            }  
              $ct++;
        }
    }
               /// staff sms //
    $smstext1="You have ".$ct++." order to deliver."."\n".$bill_numsms."Time alloted:  ".$timesms."mins";
    $message1=urlencode($smstext1);
  
    $parameters1="username=$username&api_password=$be_sms_apipassword&sender=$sender&to=$sms_list1&priority=$route&message=$message1";
    
    $fp3 = fopen("http://$domain/pushsms.php?$parameters1", "r");
   
     $response['messages'] = stream_get_contents($fp3);
        
             $res=explode("Trackid",$response['messages']);
             $res1=explode("alert_",$res[0]);
             $dl=trim($res1[1]);
    
    $b1=fopen("http://$domain/fetchdlr.php?username=$username&msgid=$dl","r");
    $response12['messages'] = stream_get_contents($b1);
    $resu1=explode("Dlr Status: ",$response12['messages']);
    
    if($resu1[1]=="Sent" || $resu1[1]='Delivered'){
    
        $stcus1=$database->mysqlQuery("UPDATE tbl_takeaway_billmaster SET tab_msg_staffstatus='Y' where tab_billno ='$billnumsms'");
    }       
        
}elseif($_REQUEST['value']=='change_status'){  //Change delivery status
   
    $billno = $_REQUEST['billno'];
    
    $del_status = $_REQUEST['del_status'];
    $sql_timealot  =  $database->mysqlQuery("UPDATE tbl_takeaway_billmaster
    SET tab_delivery_status = '$del_status'
    WHERE (tab_delivery_status = 'P' or tab_delivery_status = 'A') AND tab_billno = '$billno'");
    
   
   if($del_status=='D'){
        /////qrupdate////
    
    $qr_branch=''; $qr_db='';
    $sql_login_dc  =  $database->mysqlQuery("select tb.be_qrcode_db,tc.bsc_cloud_branchid from tbl_branchmaster tb left join "
    . " tbl_branch_settings_cloud tc on tc.bsc_branchid=tb.be_branchid "); 
    $num_cat_s_dc  = $database->mysqlNumRows($sql_login_dc);
    if($num_cat_s_dc){
     while($result_cat_s_tc  = $database->mysqlFetchArray($sql_login_dc)) 
      {

          $qr_branch=$result_cat_s_tc['bsc_cloud_branchid'];
          $qr_db=$result_cat_s_tc['be_qrcode_db'];
     }
     }

    $date=date('Y-m-d H:i:s');
 
    $localhost1=mysqli_connect(HOST_NAME_CLOUD, USER_NAME_CLOUD, PASSWORD_CLOUD,DATABASE_NAME_QR);
 
    $delivery_number="select tab_qr_order_id FROM tbl_takeaway_billmaster where tab_billno='".$billno."' ";
    
    $q=  $database->mysqlQuery($delivery_number);
    if($q){
        $bill_numsms="";
        $ct="";
        while($row= $database->mysqlFetchArray($q)){
            
            $sql_gen =  mysqli_query($localhost1,"Update tbl_qr_order_details set tq_localy_delivered='Y' ,tq_deliverd_time='$date' where tq_branch='$qr_branch' and tq_order_no='".$row['tab_qr_order_id']."' ");  
            
            
        }
        }
    
     /////qrupdate end////
   }
    
     //delivery report sms
      $sql_general =  $database->mysqlQuery("Select * from tbl_generalsettings "); 
        $num_general  = $database->mysqlNumRows($sql_general);
        if($num_general)
        {
               while($result_general  = $database->mysqlFetchArray($sql_general)) 
                  {
                $be_sms_username=$result_general['be_sms_username'];
                $be_sms_apipassword=$result_general['be_sms_apipassword'];
                $be_sms_senderid=$result_general['be_sms_senderid'];
                $be_sms_domainid=$result_general['be_sms_domainid'];
                $be_sms_priority	=$result_general['be_sms_priority'];
                $be_sms_method  =$result_general['be_sms_method'];                                                                                                                                                             
          }
                    }
         $del_sms="select tc.tac_contactno from tbl_takeaway_billmaster
         tbm  left join tbl_takeaway_customer tc on tbm.tab_hdcustomerid = tc.tac_customerid where tab_billno='$billno'";
         $q2=  $database->mysqlQuery($del_sms);
         if($q2){
         while($row2= $database->mysqlFetchArray($q2)){
         if( $del_status =="D"){
              
        $domain=$be_sms_domainid;
        $username=  $be_sms_username;
        $api_password=$be_sms_apipassword;
        $sms_list=$row2['tac_contactno'];
        $smstype=$be_sms_method;  
         $smstext=" *".     $_SESSION['s_branchname']."*\n Your order with Bill num: ".$billno."  has been delivered successfully. Thankyou .Visit again";
        $sender =$be_sms_senderid;              
        $route=$be_sms_priority;
        $message=urlencode($smstext);
       
        $parameters="username=$username&api_password=$api_password&sender=$sender&to=$sms_list&priority=$route&message=$message";
        $fp = fopen("http://$domain/pushsms.php?$parameters", "r");
        
       $response['messages'] = stream_get_contents($fp);
       
       }
       }
       }
}
    
?>

