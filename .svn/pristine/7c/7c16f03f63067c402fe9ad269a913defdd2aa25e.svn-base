 <?php 
 
session_start();
include("../database.class.php");
$database	= new Database();
//error_reporting(0);
$store_urban=''; $db_urban='';
 

if(isset($_REQUEST['channel'])){
    
    
 $dt_order=date('Y-m-d');

 $string='';   
    
if($_REQUEST['channel']!=''){
    
    $string.=" td.td_channel='".$_REQUEST['channel']."' and ";
    
}


$addr=''; $addr1='';

$localhost1=mysqli_connect(HOST_NAME_CLOUD, USER_NAME_CLOUD, PASSWORD_CLOUD,DATABASE_NAME_URBAN);

//echo "select td.td_order_id,td.td_local_status,tp.tp_platform_id,td.td_channel,td.td_date,td.td_order_local_accepted,tc.tor_line1,tc.tor_line2,tc.tor_customer,tc.tor_phone,tc.tor_city,td.td_payable_amount,td.td_store_id,tc.tor_landmark,tc.tor_sublocality,tc.tor_tag from tbl_order_details td left join tbl_order_relay_platform tp on tp.tp_order_id=td.td_order_id left join tbl_order_relay_customer tc on td.td_order_id = tc.tor_order_no   where date(td.td_date)='$dt_order' and $string (td.td_webhook_status is NULL or td.td_webhook_status='Acknowledged' or  td.td_webhook_status='Placed') order by td.td_date desc " ;
 $sql_gen =  mysqli_query($localhost1,"select td.td_order_id,td.td_local_status,tp.tp_platform_id,td.td_channel,td.td_date,td.td_order_local_accepted,tc.tor_line1,tc.tor_line2,tc.tor_customer,tc.tor_phone,tc.tor_city,td.td_payable_amount,td.td_store_id,tc.tor_landmark,tc.tor_sublocality,tc.tor_tag from tbl_order_details td left join tbl_order_relay_platform tp on tp.tp_order_id=td.td_order_id left join tbl_order_relay_customer tc on td.td_order_id = tc.tor_order_no   where date(td.td_date)='$dt_order' and $string (td.td_webhook_status is NULL or td.td_webhook_status='Acknowledged' or  td.td_webhook_status='Placed') order by td.td_date desc "); 
       
		  $num_gen  = mysqli_num_rows($sql_gen);
		  if($num_gen)
		  {
				while($result_cat_s_tc  = mysqli_fetch_array($sql_gen)) 
			{
                                    
                                  $addr1=trim($result_cat_s_tc['tor_line1'].' '.$result_cat_s_tc['tor_line2']);
                                    
                                    $addr= preg_replace("/[^A-Za-z0-9 ]/", '', $addr1);

 
    
    
     $bill_ta=''; $kot_ta='';
  $sql_login_dc  =  $database->mysqlQuery("select tab_billno,tab_kotno from  tbl_takeaway_billmaster where tab_urban_order_id='".$result_cat_s_tc['td_order_id']."' "); 
  $num_cat_s_dc  = $database->mysqlNumRows($sql_login_dc);
  if($num_cat_s_dc){
  while($result_cat_s_tc3  = $database->mysqlFetchArray($sql_login_dc)) 
   {
     
     $bill_ta=$result_cat_s_tc3['tab_billno'];
      $kot_ta=$result_cat_s_tc3['tab_kotno'];
    }
  }



$start = strtotime($result_cat_s_tc['td_date']);
$end = strtotime(date('Y-m-d H:i:s'));
$mins = ($end - $start) / 60;

$dt=date('Y-m-d H:i:s');

            ?>
          
                <div  class="take-away-quee-box  " id="order_box_<?=$result_cat_s_tc['td_order_id']?>" style="height:175px">       
                            
                    <div   class="take-away-quee-box-head" title="<?=$result_cat_s_tc['td_order_id']?>"> 
                        <strong style="float:left;margin-right: 150px"> <?=$result_cat_s_tc['td_channel']?> 
                            
                           <?php if( (strpos($bill_ta, 'TEMP') !== false || $bill_ta=='') && $result_cat_s_tc['td_order_local_accepted']=="Y"){ ?>
                            <span onclick="reorder_bill('<?=$result_cat_s_tc['td_order_id']?>','<?=$result_cat_s_tc['td_store_id']?>')" title="REORDER THE BILL" style="width: 10%;position: absolute;top: 6px;right: 9px "> <img style="width:20px;border: solid 1px;border-radius: 5px;" src="../img/refresh.png"> </span>
                           <?php } ?>
                        </strong>
                      <div class="take-away-quee-box-time"><span>#<?=$result_cat_s_tc['tp_platform_id']?></span></div>
                      
                    
                    </div>
                
                
                   <div class="take-away-quee-box-time"><img src="img/cst.png" alt=""> : <span> <?=$result_cat_s_tc['tor_customer']?></span></div>
                    <div class="take-away-quee-box-time"><img src="img/phn.png" alt=""> : <span> <?=$result_cat_s_tc['tor_phone']?></span></div>
                     <div class="take-away-quee-box-time"><img src="img/loc.png" alt=""> : <span> <?=$result_cat_s_tc['tor_city']?></span></div>
                     
                      <div class="take-away-quee-box-time"><img src="img/amt.png" alt=""> : <span> <?=number_format($result_cat_s_tc['td_payable_amount'],$_SESSION['be_decimal'])?></span></div>
                      <div class="take-away-quee-box-time" style="color: darkred;font-weight: bold"><img src="img/loc.png" alt=""> : <span> <?=$result_cat_s_tc['td_date']?></span></div>
      <div  class="online_acpt_btn_new" id="confirm_msg_<?=$result_cat_s_tc['td_order_id']?>"  style="width:100% !important;background-color: #63745d ;padding: 5px;float: left;color: white;margin-top: 20px;float-right:50px;cursor: pointer;display: none ">CONFIRMED</div>            
                   
                     
      
      
                    <?php  if( $result_cat_s_tc['td_order_local_accepted']=="N" && $mins < 15  && $bill_ta=='' ){   ?>
                          
                     <div id="accept_btn_<?=$result_cat_s_tc['td_order_id']?>" class="online_acpt_btn_new" onclick="confirm_order('<?=$result_cat_s_tc['td_order_id']?>','<?=$result_cat_s_tc['td_store_id']?>','<?=$result_cat_s_tc['td_channel']?>','<?=preg_replace("/[^A-Za-z0-9 ]/", '', $result_cat_s_tc['tor_customer'])?>',' <?=$result_cat_s_tc['tor_phone']?>','<?=$addr?>','<?=preg_replace("/[^A-Za-z0-9 ]/", '', $result_cat_s_tc['tor_landmark'])?>','<?=preg_replace("/[^A-Za-z0-9 ]/", '', $result_cat_s_tc['tor_sublocality'])?>','<?=$result_cat_s_tc['tor_tag']?>','<?=$result_cat_s_tc['tp_platform_id']?>' );"  style="background-color: #659465 ;padding: 5px;float: left;color: white;margin-top: 20px;float-right:50px;cursor: pointer ">Accept  </div> 
                   <?php  }  ?>
                   
                   
                  
                     
                     
                       <?php if($result_cat_s_tc['td_order_local_accepted']=="N" &&  $mins < 15 && $bill_ta=='' ){   ?>
                     
                       <div  class="online_acpt_btn_new" id="cancel_btn_<?=$result_cat_s_tc['td_order_id']?>" onclick="cancel_order_status('<?=$result_cat_s_tc['td_order_id']?>','<?=$result_cat_s_tc['td_store_id']?>','<?=$result_cat_s_tc['td_channel']?>' );"  style="background-color: red ;padding: 5px;float: left;color: white;margin-top: 20px;float-right:50px;cursor: pointer ">CANCEL</div>  
                     
                     
                       <?php  }  ?>
                      
                      
                     
                      
                      
                      <?php if($result_cat_s_tc['td_order_local_accepted']=="Y"  && $result_cat_s_tc['td_local_status']!="Food Ready"  ){   ?>
                            
                     <div  class="online_acpt_btn_new ready_ok_sts" id="confirm_btn_<?=$result_cat_s_tc['td_order_id']?>" onclick="ready_order_urban('<?=$result_cat_s_tc['td_order_id']?>','<?=$result_cat_s_tc['td_store_id']?>' );"  style="width:100% !important;background-color: darkred ;padding: 5px;float: left;color: white;margin-top: 20px;float-right:50px;cursor: pointer ">READY</div>  
                     
                      <?php  }else{ ?>
                     
                     <?php  if($result_cat_s_tc['td_order_local_accepted']=="Y"  ){ ?>
                     
                     <div  class="online_acpt_btn_new ready_sts"   style="width:100% !important;background-color: darkolivegreen ;padding: 5px;float: left;color: white;margin-top: 20px;float-right:50px;cursor: pointer ">ORDER READY</div>            
                     
                         <?php  } ?>
                     
                       <?php  } ?>
                       
                      <?php  if($mins >15 && $result_cat_s_tc['td_order_local_accepted']=='N' ){
                        ?> <div  class="online_acpt_btn_new"   style="width:100% !important;background-color: red ;padding: 5px;float: left;color: white;margin-top: 20px;float-right:50px;cursor: pointer">ORDER TIMEOUT</div>             <?php
                      }
                       
                       ?>
                   
                        
                      
                         
                         
                           
                             
                        <div   class="take-away-quee-box-head" > 
                       
                        <?php if($result_cat_s_tc['td_order_local_accepted']=="Y"){   ?>
                      <span title="<?=$kot_ta?>" style="float:right;margin-right: 110px;background-color: #995656;width: 20% !important;border-radius: 2px;box-shadow: black;color: white " class="odr_item_view_btn " onclick="print_urban_kot('<?=$kot_ta?>','<?=$bill_ta?>');">KOT</span>
                      <span title="<?=$bill_ta?>" style="float:right;margin-right: 65px;background-color: #995656;width: 20% !important;border-radius: 2px;box-shadow: black;color: white" class="odr_item_view_btn" onclick="print_urban_bill('<?=$bill_ta?>');">BILL</span>
                   <?php } ?> 
                      
                      <span class="odr_item_view_btn" style="background-color: #995656;width: 20% !important;border-radius: 2px;box-shadow: black;color: white;margin-right: 5px;" onclick="load_urban_items('<?=$result_cat_s_tc['td_order_id']?>','<?=$result_cat_s_tc['td_store_id']?>');">INFO</span>
                   
                    </div>
                       
                       
                       
                       
                 </div>
            
<?php

  if($mins>15 && $result_cat_s_tc['td_order_local_accepted']=='N' ){
    
       $sql_gen55 =  mysqli_query($localhost1,"insert into tbl_timeout_orders(tto_order_id,tto_timeout_datetime)values('".$result_cat_s_tc['td_order_id']."','$dt') "); 
             
   }



 } }else{
    ?>
    
<span style="margin-left: 0%;padding-top: 30%;color: red;font-weight: bold;margin-top: 0px" > NO ORDERS FOUND</span> 
    
    <?php
}

}     

?>

         
            
         