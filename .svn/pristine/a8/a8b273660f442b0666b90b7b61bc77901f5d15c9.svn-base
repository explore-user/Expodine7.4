<?php

session_start();
  include("../database.class.php");
$database	= new Database();
//error_reporting(0);

$db_urban=''; $apikey_urban=''; $urban_url='';
 $sql_login_dc  =  $database->mysqlQuery("select be_urban_api_url,be_urban_api_key,be_store_id,be_store_db from tbl_branchmaster "); 
 $num_cat_s_dc  = $database->mysqlNumRows($sql_login_dc);
 if($num_cat_s_dc){
  while($result_cat_s_tc  = $database->mysqlFetchArray($sql_login_dc)) 
	  {
      
              $db_urban=$result_cat_s_tc['be_store_db'];
              
              $apikey_urban=$result_cat_s_tc['be_urban_api_key'];
              $urban_url=$result_cat_s_tc['be_urban_api_url'];
              
         }  }


  $localhost1=mysqli_connect(HOST_NAME_CLOUD, USER_NAME_CLOUD, PASSWORD_CLOUD,DATABASE_NAME_URBAN);      
        
if(isset($_REQUEST['set']) && $_REQUEST['set']=='add_order_urban'){ 
    
 $date=date('Y-m-d H:i:s'); 

 $sql_gen =  mysqli_query($localhost1,"Update tbl_order_details set td_order_local_accepted='Y' ,td_local_ackwnowledge_time='$date',td_local_status_update_time='$date', td_local_status='Acknowledged' where td_store_id='".$_REQUEST['store_id']."' and td_order_id='".$_REQUEST['order_id']."' ");  
   
         $url = $urban_url.'/external/api/v1/orders/'.$_REQUEST['order_id'].'/status/';  
     
         $data = array(
      'new_status' => 'Acknowledged',
      'message' => 'The order has been accepted by the restaurant',
     
  );
    
  $arrayToSend = json_encode($data);
    
  
  $headers = array(
       'Content-Type: application/json',
        "Authorization: $apikey_urban"
        );

  
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST,"PUT");
    curl_setopt($ch, CURLOPT_POSTFIELDS, $arrayToSend);
    curl_setopt($ch, CURLOPT_HTTPHEADER,$headers);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);  
   
    $response = curl_exec($ch);
    
    if ($response === FALSE) {
    die('FCM Send Error: ' . curl_error($ch));
    
    }
    curl_close($ch);
    
    
    
                              $orderid="TEMP*".$database->getEpoch();
                              $_SESSION['ta_order_id']=$orderid;
                              $i=0; 
  
                              $menu_id=0;   
                              $portion='1';
                              $food=1;
                              $slno=0;  
                              $qty=0;
                              $rate='1';
                              $mode='Add';
                              $orderfrom='TA';
                              $ratetype='Portion';
                              $unittype='';
                              $pref_text='OnlineOrder';
                
                              $unit_id=0;
                              $base_unit_id=0;
                              $unit_weight=0; 
                              
 $sql_login_dc1  =  $database->mysqlQuery("select tol_id from tbl_online_order where tol_urban_name='".$_REQUEST['channel']."' "); 
 $num_cat_s_dc1  = $database->mysqlNumRows($sql_login_dc1);
 if($num_cat_s_dc1){
  while($result_cat_s_tc1  = $database->mysqlFetchArray($sql_login_dc1)) 
	  {
      
        $food=$result_cat_s_tc1['tol_id'];
  }
  }            
               
  
   $sql_login_dc15  =  $database->mysqlQuery("select tab_urban_order_id from tbl_takeaway_billmaster where tab_urban_order_id='".$_REQUEST['order_id']."' "); 
 $num_cat_s_dc15  = $database->mysqlNumRows($sql_login_dc15);
 if($num_cat_s_dc15){
  
 ///////order exist check////
              
   }else{
       
      
       $sql_gen5 =  mysqli_query($localhost1,"select tm_portion,tm_menu_id,tm_qty,tm_option_price,tm_option,tm_price from tbl_order_item_details where  tm_order_id='".$_REQUEST['order_id']."' "); 
      
		  $num_gen  = mysqli_num_rows($sql_gen5);
		  if($num_gen)
		  {
				while($result_cat_s_tc  = mysqli_fetch_array($sql_gen5)) 
			{
                                   
                                 
//  $sql_login_dc1  =  $database->mysqlQuery("select pm_id from tbl_portionmaster where pm_portionname='".$result_cat_s_tc['tm_portion']."'  "); 
// $num_cat_s_dc1  = $database->mysqlNumRows($sql_login_dc1);
// if($num_cat_s_dc1){
//  while($result_cat_s_tc5  = $database->mysqlFetchArray($sql_login_dc1)) 
//	  {
//      
//        $portion=$result_cat_s_tc5['pm_id'];
//  }
//  }      
             
                              $menu_id=$result_cat_s_tc['tm_menu_id'];   
                              //$portion=$result_cat_s_tc['tm_option'];
                             
                              $slno=$i++;  
                              $qty=$result_cat_s_tc['tm_qty'];
                              //$rate=$result_cat_s_tc['tm_option_price'];
                              $mode='Add';
                              $orderfrom='TA';
                              $ratetype='Portion';
                              $unittype='';
                              $pref_text='OnlineOrder';
                
                              $unit_id=0;
                              $base_unit_id=0;
                              $unit_weight=0; 
                              
                   //  if($result_cat_s_tc['tm_option']==''){
                          $portion='1'; 
                          $rate=$result_cat_s_tc['tm_price']; 
                   // }
                              
                 
     
	$database->mysqlQuery("SET @preferencetext 	= " . "'" . mysqli_real_escape_string($database->DatabaseLink,$pref_text) . "'");
	$database->mysqlQuery("SET @temp_billno                 = " . "'" . mysqli_real_escape_string($database->DatabaseLink,$orderid) . "'");
	$database->mysqlQuery("SET @menuid 			= " . "'" . mysqli_real_escape_string($database->DatabaseLink,$menu_id) . "'");
	$database->mysqlQuery("SET @portion 			= " . "'" . mysqli_real_escape_string($database->DatabaseLink,$portion) . "'");
	$database->mysqlQuery("SET @qty 			= " . "'" . mysqli_real_escape_string($database->DatabaseLink,$qty) . "'");
	
	$database->mysqlQuery("SET @rate 			= " . "'" . mysqli_real_escape_string($database->DatabaseLink,$rate) . "'");
	$database->mysqlQuery("SET @branchid 			= " . "'" . mysqli_real_escape_string($database->DatabaseLink,$_SESSION['branchofid']) . "'");
	$database->mysqlQuery("SET @mode 			= " . "'" . mysqli_real_escape_string($database->DatabaseLink,$mode) . "'");
	$database->mysqlQuery("SET @order_from 			= " . "'" . mysqli_real_escape_string($database->DatabaseLink,$orderfrom) . "'");
	$database->mysqlQuery("SET @rate_type 			= " . "'" . mysqli_real_escape_string($database->DatabaseLink,$ratetype) . "'");
        $database->mysqlQuery("SET @unit_type 			= " . "'" . mysqli_real_escape_string($database->DatabaseLink,$unittype) . "'");
        $database->mysqlQuery("SET @unit_id 			= " . "'" . mysqli_real_escape_string($database->DatabaseLink,$unit_id) . "'");
        $database->mysqlQuery("SET @base_unit_id 		= " . "'" . mysqli_real_escape_string($database->DatabaseLink,$base_unit_id) . "'");
        $database->mysqlQuery("SET @unit_weight 		= " . "'" . mysqli_real_escape_string($database->DatabaseLink,$unit_weight) . "'");
	$database->mysqlQuery("SET @serailno                    = " . "'" . mysqli_real_escape_string($database->DatabaseLink,$slno) . "'");
        $database->mysqlQuery("SET @dish_type                    = " . "'" . mysqli_real_escape_string($database->DatabaseLink,'') . "'");
        $database->mysqlQuery("SET @food                         = " . "'" . mysqli_real_escape_string($database->DatabaseLink,$food) . "'");
        $sq=$database->mysqlQuery("CALL  proc_temptakeaway(@temp_billno,@menuid,@rate_type,@portion,@unit_type,@unit_weight,@unit_id,@base_unit_id,@qty,@preferencetext,@rate,@branchid,@mode,@order_from,@serailno,@dish_type,@food)");

                  } }
      
         
         $sql_login_dc  =  $database->mysqlQuery(" update tbl_takeaway_billmaster set tab_urban_partner_order_no='".$_REQUEST['agg']."' , tab_urban_partner='".$_REQUEST['channel']."' , tab_urban_order_id='".$_REQUEST['order_id']."', tab_food_partner='".$food."'   where `tab_billno`='".$orderid."' and ( tab_status='Kot_Generated'  or tab_status='Generated' or tab_status='Processing'  )  ");
         $sql_login_dc  =  $database->mysqlQuery(" update tbl_takeaway_billdetails set tab_urban_order_id='".$_REQUEST['order_id']."', tab_food_partner_id='".$food."' , tab_bill_addon_slno=NULL  where `tab_billno`='".$orderid."' and ( tab_status='Kot_Generated'  or tab_status='Generated' or tab_status='Processing' ) "); 
            
         
 
 
 $sql_gen5 =  mysqli_query($localhost1,"select * from tbl_order_charge_tax where tct_order_id='".$_REQUEST['order_id']."' "); 
      
		  $num_gen5  = mysqli_num_rows($sql_gen5);
		  if($num_gen5)
		  {
				while($result_cat_s_tc5  = mysqli_fetch_array($sql_gen5)) 
			{
                                    
                                    
        $insertion['txc_order_id']=  mysqli_real_escape_string($database->DatabaseLink,trim($result_cat_s_tc5['tct_order_id']));
    
        $insertion['tcx_title']= mysqli_real_escape_string($database->DatabaseLink,trim($result_cat_s_tc5['tct_title']));
      
        $insertion['tcx_value']= mysqli_real_escape_string($database->DatabaseLink,trim($result_cat_s_tc5['tct_value']));
	
        $insertion['tcx_type']= mysqli_real_escape_string($database->DatabaseLink,trim($result_cat_s_tc5['tct_type']));
        
         $insertion['tcx_date']= mysqli_real_escape_string($database->DatabaseLink,trim($date));
        
	
    $sql=$database->check_duplicate_entry('tbl_urban_charge_tax',$insertion);
    if($sql!=1)
	{
	$insertid      =  $database->insert('tbl_urban_charge_tax',$insertion); 
        
        }
        
     
        
        }}
         
   }
 
   


        
 }
  if(isset($_REQUEST['set']) && $_REQUEST['set']=='reorder_bill'){ 
      
      
       $sql_gen =  mysqli_query($localhost1,"update tbl_order_details set td_order_local_accepted='N' where  td_order_id='".$_REQUEST['order_id']."' "); 
      
         $sql_login_dc  =  $database->mysqlQuery(" delete from tbl_takeaway_billmaster   where `tab_urban_order_id`='".$_REQUEST['order_id']."' ");
      
  }
  
if(isset($_REQUEST['set']) && $_REQUEST['set']=='list_urban_order'){ 
    $total=0;
  $date=date('Y-m-d'); 

       $sql_gen =  mysqli_query($localhost1,"select tm_title,tm_total,tm_portion,tm_qty,tm_price,tm_total from tbl_order_item_details where date(tm_date)='$date' and  tm_order_id='".$_REQUEST['order_id']."' "); 
      
		  $num_gen  = mysqli_num_rows($sql_gen);
		  if($num_gen)
		  {
				while($result_cat_s_tc  = mysqli_fetch_array($sql_gen)) 
			{
                           $total=$total+  $result_cat_s_tc['tm_total'];       
                            ?>
                                <tr>
				<td><?=$result_cat_s_tc['tm_title']?>  <?=$result_cat_s_tc['tm_portion']?></td>
				<td><?=$result_cat_s_tc['tm_qty']?></td>
                                <td><?= number_format($result_cat_s_tc['tm_price'],$_SESSION['be_decimal'])?></td>
                               <td><?= number_format($result_cat_s_tc['tm_total'],$_SESSION['be_decimal'])?></td>
				</tr> 
                              <?php      
                      }
                     }
                     ?>
                     <tr>
			   <td>Total</td>
			   <td></td>
                             <td></td>
                            <td><?=number_format($total,$_SESSION['be_decimal'])?></td>
			    </tr> 
                            
                       <?php      
                          $sql_gen =  mysqli_query($localhost1,"select  td_coupon,td_instruction,tp_option,td_delivery_boy_name,td_delivery_boy_name,td_delivery_boy_phone,td_discount,td_total_external_discount, tor_city,tor_landmark,tor_sublocality,td_local_ackwnowledge_time,td_local_status_update_time,td_rider_update_time,td_order_id,td_order_type,tp_del_type,td_channel,tor_customer,tor_phone,td_total_taxes,td_total_charges,td_order_total,tp_platform_id from  tbl_order_details td left join tbl_order_relay_customer tdc on tdc.tor_order_no=td.td_order_id left join tbl_order_payment_details tpd on tpd.tp_order_id=td.td_order_id left join tbl_order_relay_platform tp on tp.tp_order_id=td.td_order_id  where date(td.td_date)='$date' and  td.td_order_id='".$_REQUEST['order_id']."' "); 
      
		  $num_gen  = mysqli_num_rows($sql_gen);
		  if($num_gen)
		  {
				while($result_cat_s_tc  = mysqli_fetch_array($sql_gen)) 
			{
                               ?> 
                            
                             <?php  if($result_cat_s_tc['td_total_taxes']>0){ ?>
                            <tr>
                                <td>Tax Amount  : <?php echo $result_cat_s_tc['td_total_taxes']; ?> </td> 
                                
                            </tr>
                             <?php } ?>
                            
                            <?php  if($result_cat_s_tc['td_total_charges']>0){ ?>
                             <tr>
                                <td>Charges  : <?php echo $result_cat_s_tc['td_total_charges']; ?> </td> 
                                
                            </tr>
                              <?php } ?>
                            
                            
                            <tr>
                                <td>Order Total  : <?php echo $result_cat_s_tc['td_order_total']; ?> </td> 
                                
                            </tr>
                            
                            <tr>
                                <td> Aggregator Order ID : <?php echo $result_cat_s_tc['tp_platform_id']; ?>  </td> 
                               
                            </tr>
                            
                            <tr>
                                <td> Urban ID: <?php echo $result_cat_s_tc['td_order_id']; ?>  </td> 
                               
                            </tr>
                           
                             <tr>
                                <td> Order Type: <?php echo $result_cat_s_tc['td_order_type']; ?>  </td> 
                               
                            </tr>
                            
                            <tr>
                                <td> Delivery Type: <?php echo $result_cat_s_tc['tp_del_type']; ?>  </td> 
                               
                            </tr>
                            
                            <tr>
                                <td> Channel: <?php echo $result_cat_s_tc['td_channel']; ?>  </td> 
                               
                            </tr>
                            
                            
                            <tr>
                                <td> Customer Name: <?php echo $result_cat_s_tc['tor_customer']; ?>  </td> 
                               
                            </tr>
                            
                            
                            <tr>
                                <td> Customer Phone: <?php echo $result_cat_s_tc['tor_phone']; ?>  </td> 
                               
                            </tr>
                           
                            <tr>
                                <td> Customer Address: <?php echo $result_cat_s_tc['tor_city'].','.$result_cat_s_tc['tor_landmark'].','.$result_cat_s_tc['tor_sublocality']; ?>  </td> 
                               
                            </tr>
                            
                             <?php  if($result_cat_s_tc['td_local_ackwnowledge_time']!=''){ ?>
                            <tr>
                                
                                <td> Order Confirmed  Time : <?php echo $result_cat_s_tc['td_local_ackwnowledge_time']; ?>  </td> 
                               
                            </tr>
                            <?php } ?>
                            
                            
                            
                            
                          <?php  if($result_cat_s_tc['td_local_status_update_time']!=''){ ?>
                            <tr>
                                
                                <td> Food Ready Time : <?php echo $result_cat_s_tc['td_local_status_update_time']; ?>  </td> 
                               
                            </tr>
                            <?php } ?>
                            
                            
                            
                             <?php  if($result_cat_s_tc['td_rider_update_time']!=''){ ?>
                            <tr> <td> Delivery Time : <?php echo $result_cat_s_tc['td_rider_update_time']; ?>  </td> </tr>
                               <?php } ?>
                                     
                            
                            
                            <?php  if($result_cat_s_tc['td_instruction']!=''){ ?>
                            <tr> <td> Instructions : <?php echo $result_cat_s_tc['td_instruction']; ?>  </td> </tr>
                            <?php } ?>
                            
                            <?php  if($result_cat_s_tc['tp_option']!=''){ ?>
                            <tr> <td> Payment Type : <?php echo $result_cat_s_tc['tp_option']; ?>  </td> </tr>
                            <?php } ?>
                            
                            <?php  if($result_cat_s_tc['td_delivery_boy_name']!=''){ ?>
                            <tr> <td> Rider Name : <?php echo $result_cat_s_tc['td_delivery_boy_name']; ?>  </td> </tr>
                            <?php } ?>
                            
                            <?php  if($result_cat_s_tc['td_delivery_boy_phone']!=''){ ?>
                            <tr> <td> Rider Number  : <?php echo $result_cat_s_tc['td_delivery_boy_phone']; ?>  </td> </tr>
                            <?php } ?>
                            
                             <?php  if($result_cat_s_tc['td_discount']>0 || $result_cat_s_tc['td_total_external_discount']>0 ){ ?>
                            <tr> <td> Merchant Sponsored Discount : <?php echo number_format($result_cat_s_tc['td_discount']-$result_cat_s_tc['td_total_external_discount'],$_SESSION['be_decimal']) ?>  </td> </tr>
                            <?php } ?>
                            
                          
                            
                             <?php  if($result_cat_s_tc['td_order_total']>0 ){ ?>
                            <tr> <td> Merchant Receivable Amount From Aggregators : <?php echo number_format($result_cat_s_tc['td_order_total']+$result_cat_s_tc['td_total_external_discount'],$_SESSION['be_decimal']) ?>  </td> </tr>
                            <?php } ?>
                            
                            
                             <?php  if($result_cat_s_tc['td_discount']>0 ){ ?>
                            <tr> <td> Discount : <?php echo number_format($result_cat_s_tc['td_discount'],$_SESSION['be_decimal']) ?> 
                                </td> 
                            
                            </tr>
                            <?php } ?>
                            
                            <?php  if($result_cat_s_tc['td_coupon'] !='' ){ ?>
                            <tr> <td> Coupon : <?php echo $result_cat_s_tc['td_coupon']; ?>  </td> </tr>
                            <?php } ?>
                            
     <?php
      } }  
                            
                            
                    
              
}
if(isset($_REQUEST['set']) && $_REQUEST['set']=='cancel_order_urban'){
    
    $date=date('Y-m-d H:i:s');
    $sql_gen =  mysqli_query($localhost1,"Update tbl_order_details set td_order_local_accepted='Y' ,td_sync_pos='Y',td_local_status_update_time='$date', td_local_status='Cancelled' where td_store_id='".$_REQUEST['store_id']."' and td_order_id='".$_REQUEST['order_id']."' ");  
   
         $url = $urban_url.'/external/api/v1/orders/'.$_REQUEST['order_id'].'/status/';  
     
      $cancel_rsn=$_REQUEST['cancel_reason'];
     
         
   $arrayToSend='{
	"new_status": "Cancelled",
	"message": "'.$cancel_rsn.'"
           }';
   
   
   
   

    $headers = array();
    $headers[] = 'Content-Type: application/json';
    $headers[] = "Authorization: $apikey_urban";
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST,"PUT");
    curl_setopt($ch, CURLOPT_POSTFIELDS, $arrayToSend);
    curl_setopt($ch, CURLOPT_HTTPHEADER,$headers);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);  
   
    $response = curl_exec($ch);
    
    if ($response === FALSE) {
    die('FCM Send Error: ' . curl_error($ch));
    }
    curl_close($ch);
    
    
}
if(isset($_REQUEST['set']) && $_REQUEST['set']=='ready_order_urban'){
    
    $date=date('Y-m-d H:i:s');
    
    $sql_gen =  mysqli_query($localhost1,"Update tbl_order_details set td_order_local_accepted='Y' ,td_sync_pos='Y',td_local_status_update_time='$date', td_local_status='Food Ready' where td_store_id='".$_REQUEST['store_id']."' and td_order_id='".$_REQUEST['order_id']."' ");  
   
         $url = $urban_url.'/external/api/v1/orders/'.$_REQUEST['order_id'].'/status/';  
    
    $data = array(
      'new_status' => 'Food Ready',
      'message' => 'Dispatched',
     
  );
    
  $arrayToSend = json_encode($data);
    
  
  $headers = array(
       'Content-Type: application/json',
        "Authorization: $apikey_urban"
        );
   
   
   
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST,"PUT");
    curl_setopt($ch, CURLOPT_POSTFIELDS, $arrayToSend);
    curl_setopt($ch, CURLOPT_HTTPHEADER,$headers);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);  
   
    $response = curl_exec($ch);
    
    if ($response === FALSE) {
    die('FCM Send Error: ' . curl_error($ch));
    }
    curl_close($ch);
    echo $response;
    
}
if(isset($_REQUEST['set']) && $_REQUEST['set']=='load_order_search'){
    
    
    //error_reporting(0);
   $string='';
   
   if($_REQUEST['order_id']!=''){
      $string.=" and  tbl_order_details.td_order_id like '%".$_REQUEST['order_id']."%' ";
   }else{
          $string.=" ";
   }
   
   
    if($_REQUEST['agg_id_search']!=''){
      $string.=" and  tbl_order_relay_platform.tp_platform_id like '%".$_REQUEST['agg_id_search']."%' ";
    }else{
          $string.=" ";
    }
   
   
    if($_REQUEST['date']!=''){
        $string.=" and  date(tbl_order_details.td_date)='".$_REQUEST['date']."' ";
   }else{
          $string.=" ";
   }
  
    if($_REQUEST['channel']!=''){
        $string.=" and  tbl_order_details.td_channel='".$_REQUEST['channel']."' ";
   }else{
          $string.=" ";
   }
   
   
   
   if($_REQUEST['status']!='Delivered'){
       
    if($_REQUEST['status']!='' && $_REQUEST['status']!='not_accept' ){
        $string.=" and  tbl_order_details.td_local_status='".$_REQUEST['status']."' ";
   }else if($_REQUEST['status']=='not_accept'){
       
          $string.=" and  tbl_order_details.td_webhook_status  is null or tbl_order_details.td_webhook_status='' or tbl_order_details.td_webhook_status='Placed' ";
   }else{
        $string.=" ";
   }
   
   
   }else{
       
        if($_REQUEST['status']!=''){
        $string.=" and  tbl_order_details.td_rider_status='".$_REQUEST['status']."' ";
   }else{
          $string.=" ";
   }
       
   }
   
   
    $i=1;
  // echo "select tbl_order_relay_platform.tp_platform_id,tbl_order_details.td_order_id,tbl_order_details.td_channel,tbl_order_details.td_date,tbl_order_details.td_webhook_status,tbl_order_details.td_local_status,tbl_order_details.td_webhook_status,tbl_order_details.td_rider_status from tbl_order_details left join tbl_order_relay_platform on tbl_order_relay_platform.tp_order_id=tbl_order_details.td_order_id where date(tbl_order_details.td_date)!='' $string order by tbl_order_details.td_date asc";
 $sql_gen =  mysqli_query($localhost1,"select tbl_order_details.td_payable_amount,tbl_order_relay_platform.tp_platform_id,tbl_order_details.td_order_id,tbl_order_details.td_channel,"
         . " tbl_order_details.td_date,tbl_order_details.td_webhook_status,tbl_order_details.td_local_status,tbl_order_details.td_webhook_status,"
         . " tbl_order_details.td_rider_status from tbl_order_details left join tbl_order_relay_platform on "
         . " tbl_order_relay_platform.tp_order_id=tbl_order_details.td_order_id where tbl_order_details.td_order_id!='' $string order by "
         . " tbl_order_details.td_date asc"); 
       
		  $num_gen  = mysqli_num_rows($sql_gen);
		  if($num_gen)
		  { 
				while($result_cat_s_tc  = mysqli_fetch_array($sql_gen)) 
			{
                             ?>
                            <tr>
                                                <td style="width:5%"><?=$i++?></td>
                                                <td style="width:10%"><?=$result_cat_s_tc['tp_platform_id']?></td>
                                                <td onclick="order_detail_view('<?=$result_cat_s_tc['td_order_id']?>');"   style="width:10%;cursor: pointer;"><a style="font-weight: bold;color:darkred;border: solid 1px;padding: 3px"><?=$result_cat_s_tc['td_order_id']?></a></td>
                                                <td style="width:10%"><?=$result_cat_s_tc['td_channel']?></td>
                                                <td style="width:15%" ><?=$result_cat_s_tc['td_date']?></td>
                                                 <td style="width:15%" ><?=$result_cat_s_tc['td_payable_amount']?></td>
                                                <td  style="width:15%"><?=$result_cat_s_tc['td_webhook_status']?></td>
                                                <td  style="width:15%"><?=$result_cat_s_tc['td_local_status']?></td>
                                                
                                                
                                                <?php if($result_cat_s_tc['td_webhook_status']=='Dispatched'){ ?>
                                                
                                                <td  style="width:10%" >DISPATCHED</td>
                                                <?php }else if($result_cat_s_tc['td_webhook_status']=='Completed'){ ?>
                                                
                                                <td  style="width:10%" >COMPLETED</td>
                                                <?php }else{ ?>
                                                <td  style="width:10%" >NOT DISPATCHED</td>
                                                   <?php } ?>
                                                
                                                <td  style="width:15%" ><?=$result_cat_s_tc['td_rider_status']?></td>
                                                
                                            </tr>
                            
                            
                            <?php
                                    
                                }
                                }else{
                                    
                                    ?>
                                            
                                             <tr>
                                                <td style="width:5%"></td>
                                                <td style="width:20%"></td>
                                                 <td style="width:20%"></td>
                                                <td style="width:20%;font-weight:bold;color: darkred" >NO DATA</td>
                                                <td  style="width:20%"></td>
                                                <td  style="width:20%" ></td>
                                                 <td  style="width:20%" ></td>
                                                  <td  style="width:20%" ></td>
                                                   <td  style="width:20%" ></td>
                                                    <td  style="width:20%" ></td>
                                            </tr>        
                                 <?php
                                }
}
if(isset($_REQUEST['set']) && $_REQUEST['set']=='load_order_today'){
$date=date('Y-m-d');

 $total=0; $confirm=0; $cancel=0; $del=0;$accept=0; $pend=0; $dispatch=0; $assign=0;
 $sql_gen =  mysqli_query($localhost1,"select td_local_status,td_rider_status,td_webhook_status from tbl_order_details where date(td_date)='$date' "); 
       
		  $num_gen  = mysqli_num_rows($sql_gen);
		  if($num_gen)
		  { 
				while($result_cat_s_tc  = mysqli_fetch_array($sql_gen)) 
			{
                            $total++;
                            
                           if($result_cat_s_tc['td_local_status']=='Food Ready'){
                               $confirm++;
                           }         
                                    
                                    
                           if($result_cat_s_tc['td_local_status']=='Cancelled' || $result_cat_s_tc['td_webhook_status']=='Cancelled'  ){
                               $cancel++;
                           }  
                           
                           
                           if($result_cat_s_tc['td_rider_status']=='Delivered'){
                               $del++;
                           }  
                           
                             if($result_cat_s_tc['td_local_status']=='Acknowledged'){
                               $accept++;
                           }  
                           
                           if($result_cat_s_tc['td_local_status']=='' &&  $result_cat_s_tc['td_webhook_status']!='Cancelled'){
                               $pend++;
                           }  
                           
                           
                            if($result_cat_s_tc['td_webhook_status']=='Dispatched'){
                               $dispatch++;
                           }  
                           
                           if($result_cat_s_tc['td_rider_status']=='Assigned'){
                               $assign++;
                           }  
                           
                           
                           
                                }
                                }
                                
                              
            echo   $total.'*'.$pend.'*'.$cancel.'*'.$confirm.'*'.$accept.'*'.$pend.'*'.$dispatch.'*'.$assign.'*'.$del;                  
}
?>