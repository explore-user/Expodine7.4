<?php
include("database.class.php"); 
$database	= new Database();
session_start();

          $store_name=''; $api_key='';  $api_key_url=''; $storeid=''; $lukado_on='N';
 
          $sql_login5  =  $database->mysqlQuery("select be_branchname,be_lukado_api,be_lukado_key,be_lukado_store_id,be_lukado_on from tbl_branchmaster"); 
	  $num_login5   = $database->mysqlNumRows($sql_login5);
	  if($num_login5){
		  while($result_login5  = $database->mysqlFetchArray($sql_login5)) 
			{ 
                      
                      $store_name='"'.$result_login5['be_branchname'].'"';
                      
                      $api_key=$result_login5['be_lukado_key'];
 
                      $api_key_url=$result_login5['be_lukado_api'];
                      
                      $storeid='"'.$result_login5['be_lukado_store_id'].'"';
                      
                      $lukado_on=$result_login5['be_lukado_on'];
                  }
                  }
 
 
 if(isset($_REQUEST['set']) && $_REQUEST['set']=="lukado_bill"){
     
     $bill=$_REQUEST['billno'];
      
     if($lukado_on=='Y'){
         
       
      $customer=''; $phone=''; $time=''; $netamt=0; $final=0;  $disc=0; $tax=0; $mode='Cash';
      $sql_bill  =  $database->mysqlQuery("select tab_transcbank,tab_name,tab_phone,tab_date,tab_time,tab_discountvalue,tab_subtotal,tab_netamt,tab_taxable_amount,tab_paymode  from   tbl_takeaway_billmaster where tab_dayclosedate='".$_SESSION['date']."' and tab_billno='$bill'   "); 
	  $num_login   = $database->mysqlNumRows($sql_bill);
	  if($num_login){
		  while($result_login  = $database->mysqlFetchArray($sql_bill)) 
			{ 
                           $customer='"'.$result_login['tab_name'].'"';
                           $phone=$result_login['tab_phone'];
                           $time='"'.$result_login['tab_date'].' '.$result_login['tab_time'].'"'; 
                           
                           $netamt=$result_login['tab_subtotal']; 
                           $final=$result_login['tab_netamt']; 
                           $disc=$result_login['tab_discountvalue']; 
                           $tax=($result_login['tab_netamt']-$result_login['tab_taxable_amount']); 
                           
                           if($result_login['tab_paymode']=='1'){
                               $mode='cash';
                           }else if($result_login['tab_paymode']=='2'){
                               $mode='card';
                               
          $sql_bill_pay  =  $database->mysqlQuery("select bm_lukado from tbl_bankmaster where bm_id='".$result_login['tab_transcbank']."' and bm_lukado='Y'"); 
	  $num_login_pay   = $database->mysqlNumRows($sql_bill_pay);
	  if($num_login_pay){
              
		    $mode='oduPay';
                  }
                               
                           }
                           else{
                               $mode='other';
                           }
                           
                  }
                  }
           
          $item=''; $qty=0; $rate=0; $price=0;  $item_detail=''; $item_detail1='';
          $sql_billi  =  $database->mysqlQuery("select tm.mr_menuname,tb.tab_qty,tb.tab_rate,tb.tab_amount  from   tbl_takeaway_billdetails tb left join tbl_menumaster tm on tm.mr_menuid=tb.tab_menuid where  tb.tab_billno='$bill'   "); 
	  $num_logini   = $database->mysqlNumRows($sql_billi);
	  if($num_logini){
		  while($result_logini  = $database->mysqlFetchArray($sql_billi)) 
			{ 
                           
                           $item='"'.$result_logini['mr_menuname'].'",'; 
                           $qty=$result_logini['tab_qty'].','; 
                           $rate=$result_logini['tab_rate'].','; 
                           $price=$result_logini['tab_amount']; 
                           
                          $item_detail1.='{ "name":'.$item.'
                          "qty": '.$qty.'
                          "rate": '.$rate.'
                          "price": '.$price.'},';
                  }
                  }         
   $item_detail=substr($item_detail1, 0, -1);             
               
//      $tax_val=''; 
//      $sql_bill  =  $database->mysqlQuery("select tbe_label,tbe_total_value  from  tbl_takeaway_bill_extra_tax_master where tbe_billno='$bill' "); 
//	  $num_login   = $database->mysqlNumRows($sql_bill);
//	  if($num_login){
//		  while($result_login  = $database->mysqlFetchArray($sql_bill)) 
//			{ 
//                           $tax_val.='"'.$result_login['tbe_label'].'":'.$result_login['tbe_total_value'].',';
//                   } }
                        
 
   ///bill  api ta hd cs//////               
  if($phone!='' && $phone!='undefined' && $phone!='NULL' && $phone!='null' ){
      
       $a="8.8.8.8";
        exec("ping -n 1 -w 1 ".$a, $output, $result);
        if($result==0)
        { 
         
 
  $arrayToSend ='{
  "invoiceId": "'.$bill.'",
  "store": '.$storeid.',
  "storeName": '.$store_name.',
  "timestamp": '.$time.',
  "customer": '.$customer.',
  "address": "calicut",
  "phone": "'.$phone.'",
  "email": "aaa@gmail.com",
  "items": [
    
     '.$item_detail.'
    
  ],
  "netAmount": '.$netamt.',
  "discount":'.$disc.',
  "tax": '.$tax.',
  "SGST": 0,
  "CGST": 0,
  "totalAmount": '.$final.',
  "override": false    
}';
 
 
   
  
    $headers = array();
    $headers[] = 'Content-Type: application/json';
    $headers[] = "Authorization: Bearer $api_key";
    $headers[] = "User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36";
    $ch = curl_init();
   
    curl_setopt($ch, CURLOPT_URL, $api_key_url);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST,"POST");
    curl_setopt($ch, CURLOPT_POSTFIELDS, $arrayToSend);
    curl_setopt($ch, CURLOPT_HTTPHEADER,$headers);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);  
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_HEADER, 1);
   
     

    $response = curl_exec($ch);
   
     $aa= explode('{', $response);
  
     $resp_bill=$aa[1];
   
    $sql_bill  =  $database->mysqlQuery("update tbl_takeaway_billmaster set tab_lukado_response='$resp_bill' where tab_dayclosedate='".$_SESSION['date']."' and tab_billno='$bill'   ");    
     
    if ($response === FALSE) {
    die('FCM Send Error: ' . curl_error($ch));
    }
    curl_close($ch);
    
    /////payment api ta hd cs///
    
   $arrayToSend1 ='  {
  "invoiceId": "'.$bill.'",
  "isPaymentCompleted": true,
  "receivedAmount": '.$final.',
  "modeOfPayment": "'.$mode.'",
  "override": false
}';

   
    $headers = array();
    $headers[] = 'Content-Type: application/json';
    $headers[] = "Authorization: Bearer $api_key";
    $headers[] = "User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36";
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $api_key_url);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST,"PUT");
    curl_setopt($ch, CURLOPT_POSTFIELDS, $arrayToSend1);
    curl_setopt($ch, CURLOPT_HTTPHEADER,$headers);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);  
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_HEADER, 1);
    
    $response = curl_exec($ch);
    
    $aapay= explode('{', $response);
  
    $resp_bill_pay=$aapay[1];
    //echo $resp_bill_pay;
    $sql_billpay  =  $database->mysqlQuery("update tbl_takeaway_billmaster set tab_lukado_pay_response='$resp_bill_pay' where tab_dayclosedate='".$_SESSION['date']."' and tab_billno='$bill'   ");    
     
    if ($response === FALSE) {
    die('FCM Send Error: ' . curl_error($ch));
    }
    curl_close($ch);
    
    ///end ////
    
    
  
  }else{
     $sql_bill  =  $database->mysqlQuery("update tbl_takeaway_billmaster set tab_lukado_response='NO_INTERNET',tab_lukado_pay_response='NO_INTERNET' where tab_dayclosedate='".$_SESSION['date']."' and tab_billno='$bill'   ");    
       
  }
  
        }
    
  } 
   
}
 
 
 if(isset($_REQUEST['set']) && $_REQUEST['set']=="lukado_bill_dine"){
     
     $bill=$_REQUEST['billno'];
     
     if($lukado_on=='Y'){
         
       
 
      $customer=''; $phone=''; $time=''; $netamt=0; $final=0;  $disc=0; $tax=0; $mode='';
      $sql_bill  =  $database->mysqlQuery("select bm_transcbank,bm_cname,bm_cnumber,bm_billdate,bm_billtime,bm_discountvalue,bm_subtotal,bm_finaltotal,bm_taxable_amount,bm_paymode  from tbl_tablebillmaster where bm_dayclosedate='".$_SESSION['date']."' and bm_billno='$bill'   "); 
	  $num_login   = $database->mysqlNumRows($sql_bill);
	  if($num_login){
		  while($result_login  = $database->mysqlFetchArray($sql_bill)) 
			{ 
                           $customer='"'.$result_login['bm_cname'].'"';
                           $phone=$result_login['bm_cnumber'];
                           $time='"'.$result_login['bm_billdate'].' '.$result_login['bm_billtime'].'"'; 
                           
                           $netamt=$result_login['bm_subtotal']; 
                           $final=$result_login['bm_finaltotal']; 
                           $disc=$result_login['bm_discountvalue']; 
                           $tax=($result_login['bm_finaltotal']-$result_login['bm_taxable_amount']); 
                           
                           
                            if($result_login['bm_paymode']=='1'){
                               $mode='cash';
                           }else if($result_login['bm_paymode']=='2'){
                               $mode='card';
                               
         $sql_bill_pay  =  $database->mysqlQuery("select bm_lukado from tbl_bankmaster where bm_id='".$result_login['bm_transcbank']."' and bm_lukado='Y'"); 
	  $num_login_pay   = $database->mysqlNumRows($sql_bill_pay);
	  if($num_login_pay){
              
		    $mode='oduPay';
                  }
                               
                               
                           }
                           else{
                               $mode='other';
                           }
                  }
                  }
                  
          $item=''; $qty=0; $rate=0; $price=0;  $item_detail=''; $item_detail1='';
          $sql_billi  =  $database->mysqlQuery("select tm.mr_menuname,tb.bd_qty,tb.bd_rate,tb.bd_amount  from   tbl_tablebilldetails tb left join tbl_menumaster tm on tm.mr_menuid=tb.bd_menuid where  tb.bd_billno='$bill'   "); 
	  $num_logini   = $database->mysqlNumRows($sql_billi);
	  if($num_logini){
		  while($result_logini  = $database->mysqlFetchArray($sql_billi)) 
			{ 
                           
                           $item='"'.$result_logini['mr_menuname'].'",'; 
                           $qty=$result_logini['bd_qty'].','; 
                           $rate=$result_logini['bd_rate'].','; 
                           $price=$result_logini['bd_amount']; 
                           
                          $item_detail1.='{ "name":'.$item.'
                          "qty": '.$qty.'
                          "rate": '.$rate.'
                          "price": '.$price.'},';
                  }
                  }         
         $item_detail=substr($item_detail1, 0, -1);           
               
//      $tax_val=''; 
//      $sql_bill  =  $database->mysqlQuery("select bem_label,bem_total_value  from   tbl_tablebill_extra_tax_master where bem_billno='$bill' "); 
//	  $num_login   = $database->mysqlNumRows($sql_bill);
//	  if($num_login){
//		  while($result_login  = $database->mysqlFetchArray($sql_bill)) 
//			{ 
//                           $tax_val.='"'.$result_login['bem_label'].'":'.$result_login['bem_total_value'].',';
//                   } }
                        
 
    if($phone!='' && $phone!='undefined' && $phone!='NULL' && $phone!='null' ){
 
         $a="8.8.8.8";
        exec("ping -n 1 -w 1 ".$a, $output, $result);
        if($result==0)
        {  
        
        
  $arrayToSend ='{
  "invoiceId": "'.$bill.'",
  "store": '.$storeid.',
  "storeName": '.$store_name.',
  "timestamp": '.$time.',
  "customer": '.$customer.',
  "address": "calicut",
  "phone": "'.$phone.'",
  "email": "aaa@gmail.com",
  "items": [
    
       '.$item_detail.'
    
  ],
  "netAmount": '.$netamt.',
  "discount":'.$disc.',
  "tax": '.$tax.',
  "SGST": 0,
  "CGST": 0,
  "totalAmount": '.$final.',
  "override": false    
}';
 
 //echo $arrayToSend;
 
    $headers = array();
    $headers[] = 'Content-Type: application/json';
    $headers[] = "Authorization: Bearer $api_key";
    $headers[] = "User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36";
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $api_key_url);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST,"POST");
    curl_setopt($ch, CURLOPT_POSTFIELDS, $arrayToSend);
    curl_setopt($ch, CURLOPT_HTTPHEADER,$headers);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);  
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_HEADER, 1);
    
    $response = curl_exec($ch);
    
     $aa= explode('{', $response);
 
     $resp_bill=$aa[1];
     
   $sql_bill  =  $database->mysqlQuery("update   tbl_tablebillmaster set bm_lukado_response='$resp_bill' where bm_dayclosedate='".$_SESSION['date']."' and bm_billno='$bill'   ");    
     
    if ($response === FALSE) {
    die('FCM Send Error: ' . curl_error($ch));
    }
    curl_close($ch);
    
    /////payment api ta hd cs///
    
   $arrayToSend1 ='  {
  "invoiceId": "'.$bill.'",
  "isPaymentCompleted": true,
  "receivedAmount": '.$final.',
  "modeOfPayment": "'.$mode.'",
  "override": false
}';

   
    $headers = array();
    $headers[] = 'Content-Type: application/json';
    $headers[] = "Authorization: Bearer $api_key";
     $headers[] = "User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36";
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $api_key_url);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST,"PUT");
    curl_setopt($ch, CURLOPT_POSTFIELDS, $arrayToSend1);
    curl_setopt($ch, CURLOPT_HTTPHEADER,$headers);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);  
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_HEADER, 1);
    
    $response = curl_exec($ch);
    
     $aapay= explode('{', $response);
  
     $resp_bill_pay=$aapay[1];
  // echo $resp_bill_pay;
    $sql_billpay  =  $database->mysqlQuery("update tbl_tablebillmaster set bm_lukado_pay_response='$resp_bill_pay' where bm_dayclosedate='".$_SESSION['date']."' and bm_billno='$bill'   ");    
     
    if ($response === FALSE) {
    die('FCM Send Error: ' . curl_error($ch));
    }
    curl_close($ch);
    
    ///end ////
    
  }else{
     $sql_bill  =  $database->mysqlQuery("update   tbl_tablebillmaster set bm_lukado_response='NO_INTERNET',bm_lukado_pay_response='NO_INTERNET' where bm_dayclosedate='".$_SESSION['date']."' and bm_billno='$bill'   ");    
      
  } 
    }
  
  
  
 } 
   
 }
 if(isset($_REQUEST['set']) && $_REQUEST['set']=="lukado_bill_loop_ta_hd_cs"){
     
      $bill='';
      if($lukado_on=='Y'){
         
        $a="8.8.8.8";
        exec("ping -n 1 -w 1 ".$a, $output, $result);
        if($result==0)
        { 
         
      $customer=''; $phone=''; $time=''; $netamt=0; $final=0;  $disc=0; $tax=0; $mode='Cash';
      $sql_bill  =  $database->mysqlQuery("select tab_transcbank,tab_billno,tab_name,tab_phone,tab_date,tab_time,tab_discountvalue,tab_subtotal,tab_netamt,tab_taxable_amount,tab_paymode  from  tbl_takeaway_billmaster where tab_lukado_response='NO_INTERNET' "); 
	  $num_login   = $database->mysqlNumRows($sql_bill);
	  if($num_login){
		  while($result_login  = $database->mysqlFetchArray($sql_bill)) 
			{ 
                          $bill=$result_login['tab_billno'];
                      
                           $customer='"'.$result_login['tab_name'].'"';
                           $phone=$result_login['tab_phone'];
                           $time='"'.$result_login['tab_date'].' '.$result_login['tab_time'].'"'; 
                           
                           $netamt=$result_login['tab_subtotal']; 
                           $final=$result_login['tab_netamt']; 
                           $disc=$result_login['tab_discountvalue']; 
                           $tax=($result_login['tab_netamt']-$result_login['tab_taxable_amount']); 
                           
                           if($result_login['tab_paymode']=='1'){
                               $mode='cash';
                           }else if($result_login['tab_paymode']=='2'){
                               $mode='card';
                               
                                $sql_bill_pay  =  $database->mysqlQuery("select bm_lukado from tbl_bankmaster where bm_id='".$result_login['tab_transcbank']."' and bm_lukado='Y'"); 
	  $num_login_pay   = $database->mysqlNumRows($sql_bill_pay);
	  if($num_login_pay){
              
		    $mode='oduPay';
                  }
                           }
                           else{
                               $mode='other';
                           }
                           
                  
                  
          $item=''; $qty=0; $rate=0; $price=0;  $item_detail=''; $item_detail1='';
          $sql_billi  =  $database->mysqlQuery("select tm.mr_menuname,tb.tab_qty,tb.tab_rate,tb.tab_amount  from   tbl_takeaway_billdetails tb left join tbl_menumaster tm on tm.mr_menuid=tb.tab_menuid where  tb.tab_billno='$bill'   "); 
	  $num_logini   = $database->mysqlNumRows($sql_billi);
	  if($num_logini){
		  while($result_logini  = $database->mysqlFetchArray($sql_billi)) 
			{ 
                           
                           $item='"'.$result_logini['mr_menuname'].'",'; 
                           $qty=$result_logini['tab_qty'].','; 
                           $rate=$result_logini['tab_rate'].','; 
                           $price=$result_logini['tab_amount']; 
                           
                          $item_detail1.='{ "name":'.$item.'
                          "qty": '.$qty.'
                          "rate": '.$rate.'
                          "price": '.$price.'},';
                  }
                  }         
   $item_detail=substr($item_detail1, 0, -1);             
               
//      $tax_val=''; 
//      $sql_bill  =  $database->mysqlQuery("select tbe_label,tbe_total_value  from  tbl_takeaway_bill_extra_tax_master where tbe_billno='$bill' "); 
//	  $num_login   = $database->mysqlNumRows($sql_bill);
//	  if($num_login){
//		  while($result_login  = $database->mysqlFetchArray($sql_bill)) 
//			{ 
//                           $tax_val.='"'.$result_login['tbe_label'].'":'.$result_login['tbe_total_value'].',';
//                   } }
                        
 
   ///bill  api ta hd cs//////               
  if($phone!='' && $phone!='undefined' && $phone!='NULL' && $phone!='null' ){
 
  $arrayToSend ='{
  "invoiceId": "'.$bill.'",
  "store": '.$storeid.',
  "storeName": '.$store_name.',
  "timestamp": '.$time.',
  "customer": '.$customer.',
  "address": "calicut",
  "phone": "'.$phone.'",
  "email": "aaa@gmail.com",
  "items": [
    
     '.$item_detail.'
    
  ],
  "netAmount": '.$netamt.',
  "discount":'.$disc.',
  "tax": '.$tax.',
  "SGST": 0,
  "CGST": 0,
  "totalAmount": '.$final.',
  "override": false    
}';
 
 
 
    $headers = array();
    $headers[] = 'Content-Type: application/json';
    $headers[] = "Authorization: Bearer $api_key";
     $headers[] = "User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36";
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $api_key_url);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST,"POST");
    curl_setopt($ch, CURLOPT_POSTFIELDS, $arrayToSend);
    curl_setopt($ch, CURLOPT_HTTPHEADER,$headers);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);  
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_HEADER, 1);
    
    $response = curl_exec($ch);
    
     $aa= explode('{', $response);
  
     $resp_bill=$aa[1];
   
    $sql_bill  =  $database->mysqlQuery("update tbl_takeaway_billmaster set tab_lukado_response='$resp_bill' where tab_dayclosedate='".$_SESSION['date']."' and tab_billno='$bill'   ");    
     
    if ($response === FALSE) {
    die('FCM Send Error: ' . curl_error($ch));
    }
    curl_close($ch);
    
    /////payment api ta hd cs///
    
   $arrayToSend1 ='  {
  "invoiceId": "'.$bill.'",
  "isPaymentCompleted": true,
  "receivedAmount": '.$final.',
  "modeOfPayment": "'.$mode.'",
  "override": false
}';

   
    $headers = array();
    $headers[] = 'Content-Type: application/json';
    $headers[] = "Authorization: Bearer $api_key";
     $headers[] = "User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36";
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $api_key_url);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST,"PUT");
    curl_setopt($ch, CURLOPT_POSTFIELDS, $arrayToSend1);
    curl_setopt($ch, CURLOPT_HTTPHEADER,$headers);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);  
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_HEADER, 1);
    
    $response = curl_exec($ch);
    
    $aapay= explode('{', $response);
  
    $resp_bill_pay=$aapay[1];
    //echo $resp_bill_pay;
    $sql_billpay  =  $database->mysqlQuery("update tbl_takeaway_billmaster set tab_lukado_pay_response='$resp_bill_pay' where tab_dayclosedate='".$_SESSION['date']."' and tab_billno='$bill'   ");    
     
    if ($response === FALSE) {
    die('FCM Send Error: ' . curl_error($ch));
    }
    curl_close($ch);
    
    ///end ////
    
          } }
          
  
        }
        
    }
  
    
  } 
     
 }
 if(isset($_REQUEST['set']) && $_REQUEST['set']=="lukado_bill_loop_dine"){
     
     $bill='';
     
     if($lukado_on=='Y'){
         
        $a="8.8.8.8";
        exec("ping -n 1 -w 1 ".$a, $output, $result);
        if($result==0)
        {  
 
      $customer=''; $phone=''; $time=''; $netamt=0; $final=0;  $disc=0; $tax=0; $mode='';
      $sql_bill  =  $database->mysqlQuery("select bm_transcbank,bm_billno,bm_cname,bm_cnumber,bm_billdate,bm_billtime,bm_discountvalue,bm_subtotal,bm_finaltotal,bm_taxable_amount,bm_paymode  from tbl_tablebillmaster where bm_lukado_response='NO_INTERNET'  "); 
	  $num_login   = $database->mysqlNumRows($sql_bill);
	  if($num_login){
		  while($result_login  = $database->mysqlFetchArray($sql_bill)) 
			{ 
                            $bill=$result_login['bm_billno']; 
                           $customer='"'.$result_login['bm_cname'].'"';
                           $phone=$result_login['bm_cnumber'];
                           $time='"'.$result_login['bm_billdate'].' '.$result_login['bm_billtime'].'"'; 
                           
                           $netamt=$result_login['bm_subtotal']; 
                           $final=$result_login['bm_finaltotal']; 
                           $disc=$result_login['bm_discountvalue']; 
                           $tax=($result_login['bm_finaltotal']-$result_login['bm_taxable_amount']); 
                           
                           
                            if($result_login['bm_paymode']=='1'){
                               $mode='cash';
                           }else if($result_login['bm_paymode']=='2'){
                               $mode='card';
                               
         $sql_bill_pay  =  $database->mysqlQuery("select bm_lukado from tbl_bankmaster where bm_id='".$result_login['bm_transcbank']."' and bm_lukado='Y'"); 
	  $num_login_pay   = $database->mysqlNumRows($sql_bill_pay);
	  if($num_login_pay){
              
		    $mode='oduPay';
                  }
                           }
                           else{
                               $mode='other';
                           }
                 
                  
          $item=''; $qty=0; $rate=0; $price=0;  $item_detail=''; $item_detail1='';
          $sql_billi  =  $database->mysqlQuery("select tm.mr_menuname,tb.bd_qty,tb.bd_rate,tb.bd_amount  from   tbl_tablebilldetails tb left join tbl_menumaster tm on tm.mr_menuid=tb.bd_menuid where  tb.bd_billno='$bill'   "); 
	  $num_logini   = $database->mysqlNumRows($sql_billi);
	  if($num_logini){
		  while($result_logini  = $database->mysqlFetchArray($sql_billi)) 
			{ 
                           
                           $item='"'.$result_logini['mr_menuname'].'",'; 
                           $qty=$result_logini['bd_qty'].','; 
                           $rate=$result_logini['bd_rate'].','; 
                           $price=$result_logini['bd_amount']; 
                           
                          $item_detail1.='{ "name":'.$item.'
                          "qty": '.$qty.'
                          "rate": '.$rate.'
                          "price": '.$price.'},';
                  }
                  }         
         $item_detail=substr($item_detail1, 0, -1);           
               
//      $tax_val=''; 
//      $sql_bill  =  $database->mysqlQuery("select bem_label,bem_total_value  from   tbl_tablebill_extra_tax_master where bem_billno='$bill' "); 
//	  $num_login   = $database->mysqlNumRows($sql_bill);
//	  if($num_login){
//		  while($result_login  = $database->mysqlFetchArray($sql_bill)) 
//			{ 
//                           $tax_val.='"'.$result_login['bem_label'].'":'.$result_login['bem_total_value'].',';
//                   } }
                        

    if($phone!='' && $phone!='undefined' && $phone!='NULL' && $phone!='null' ){
 
  $arrayToSend ='{
  "invoiceId": "'.$bill.'",
  "store": '.$storeid.',
  "storeName": '.$store_name.',
  "timestamp": '.$time.',
  "customer": '.$customer.',
  "address": "calicut",
  "phone": "'.$phone.'",
  "email": "aaa@gmail.com",
  "items": [
    
       '.$item_detail.'
    
  ],
  "netAmount": '.$netamt.',
  "discount":'.$disc.',
  "tax": '.$tax.',
  "SGST": 0,
  "CGST": 0,
  "totalAmount": '.$final.',
  "override": false    
}';
 
 //echo $arrayToSend;
 
    $headers = array();
    $headers[] = 'Content-Type: application/json';
    $headers[] = "Authorization: Bearer $api_key";
     $headers[] = "User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36";
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $api_key_url);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST,"POST");
    curl_setopt($ch, CURLOPT_POSTFIELDS, $arrayToSend);
    curl_setopt($ch, CURLOPT_HTTPHEADER,$headers);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);  
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_HEADER, 1);
    
    $response = curl_exec($ch);
    
     $aa= explode('{', $response);
 
     $resp_bill=$aa[1];
     
   $sql_bill  =  $database->mysqlQuery("update   tbl_tablebillmaster set bm_lukado_response='$resp_bill' where bm_dayclosedate='".$_SESSION['date']."' and bm_billno='$bill'   ");    
     
    if ($response === FALSE) {
    die('FCM Send Error: ' . curl_error($ch));
    }
    curl_close($ch);
    
    /////payment api ta hd cs///
    
   $arrayToSend1 ='  {
  "invoiceId": "'.$bill.'",
  "isPaymentCompleted": true,
  "receivedAmount": '.$final.',
  "modeOfPayment": "'.$mode.'",
  "override": false
}';

   
    $headers = array();
    $headers[] = 'Content-Type: application/json';
    $headers[] = "Authorization: Bearer $api_key";
     $headers[] = "User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36";
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $api_key_url);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST,"PUT");
    curl_setopt($ch, CURLOPT_POSTFIELDS, $arrayToSend1);
    curl_setopt($ch, CURLOPT_HTTPHEADER,$headers);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);  
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_HEADER, 1);
    
    $response = curl_exec($ch);
    
     $aapay= explode('{', $response);
  
     $resp_bill_pay=$aapay[1];
  // echo $resp_bill_pay;
    $sql_billpay  =  $database->mysqlQuery("update tbl_tablebillmaster set bm_lukado_pay_response='$resp_bill_pay' where bm_dayclosedate='".$_SESSION['date']."' and bm_billno='$bill'   ");    
     
    if ($response === FALSE) {
    die('FCM Send Error: ' . curl_error($ch));
    }
    curl_close($ch);
    
    ///end ////
    
    }
    
     }
     }
    
  }
    
 } 
   
 }
 ?>