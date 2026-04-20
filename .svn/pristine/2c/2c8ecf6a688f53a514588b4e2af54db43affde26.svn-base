 
 <?php 
 include('../includes/session.php');
 include("../database.class.php");
 $database	= new Database();

    $time=''; $payment=''; $payment_sts='';
    
    $mode='';
    if($_REQUEST['mode1']!=''){
        
      $mode=" and tab_mode='".$_REQUEST['mode1']."' ";
      
      
      if($_REQUEST['mode1']=='DI'){
          
    $sql_login_tc  =  $database->mysqlQuery("select bm.bm_customer_display_status as display_status, bm.bm_billno as billno,
    bm.bm_bill_ref as ref,bm.bm_billtime as time,'DI' AS mode,
    bm.bm_finaltotal as total, 
    bm.bm_dayclosedate as dayclosedate ,bm.bm_status as status FROM tbl_tablebillmaster bm 
    where (bm.bm_customer_display_status!='Delivered' or bm.bm_customer_display_status is null)  and bm.bm_dayclosedate='".$_SESSION['date']."' 
    order by bm.bm_billtime asc "); 
          
          
      }else{
          
    $sql_login_tc  =  $database->mysqlQuery("select tab_billno as billno,tab_status as status,tab_time as time,tab_bill_ref as ref,"
            . " tab_customer_display_status as display_status, "
    . " tab_netamt as total from tbl_takeaway_billmaster where  "
    . " tab_dayclosedate='".$_SESSION['date']."' and (tab_customer_display_status!='Delivered' or tab_customer_display_status is null) "
    . " $mode order by tab_time asc "); 
          
      }
      
      
      
    }else{
    
    $sql_login_tc = $database->mysqlQuery ("select x.display_status, x.billno,x.ref,x.time,x.mode,x.total, x.dayclosedate, x.status from ( 
    select bm.bm_customer_display_status as display_status, bm.bm_billno as billno,bm.bm_bill_ref as ref,bm.bm_billtime as time,'DI' AS mode,
    bm.bm_finaltotal as total, 
    bm.bm_dayclosedate as dayclosedate ,bm.bm_status as status FROM tbl_tablebillmaster bm 
    where (bm.bm_customer_display_status!='Delivered' or bm.bm_customer_display_status is null)  and bm.bm_dayclosedate='".$_SESSION['date']."' 
        
    union all
        
    select bm.tab_customer_display_status as display_status,bm.tab_billno as billno,bm.tab_bill_ref as ref,
    bm.tab_time as time ,bm.tab_mode as mode, bm.tab_netamt as total,
    bm.tab_dayclosedate as dayclosedate,bm.tab_status as status FROM tbl_takeaway_billmaster bm 
    where  (tab_customer_display_status!='Delivered' or tab_customer_display_status is null) and bm.tab_dayclosedate='".$_SESSION['date']."'
    )x order by x.time asc "); 
    
    }
    
    $num_cat_s_tc  = $database->mysqlNumRows($sql_login_tc);
    if($num_cat_s_tc){ 
      while($result_cat_s_tc  = $database->mysqlFetchArray($sql_login_tc)) 
              {

                $time=date("g:i a",  strtotime($result_cat_s_tc['time']));

                  if($result_cat_s_tc['status']!="Closed"){
                      
                          $payment='PAYMENT : PENDING' ;
                  }else{
                          $payment='PAYMENT : DONE' ;
                  } 
                  
                  
                  if($result_cat_s_tc['display_status']!="Ready"){
                      
                         $payment_sts='PROCESSING' ;
                  }else{
                      
                         $payment_sts='READY' ;
                  } 
                
     if($result_cat_s_tc['ref']!=""){  ?>

                            
       <div style="width:170px;height:auto;" class="take-away-quee-box" onclick="change_staus('<?=$result_cat_s_tc['billno']?>','<?=$result_cat_s_tc['display_status']?>')">       
                            
                <div <?php if($result_cat_s_tc['display_status']=='Processing' || $result_cat_s_tc['display_status']==''){ ?> 
                style='background-color: #dd7a00' <?php }else{ ?>  style='background-color: #1f7a26' <?php } ?> class="take-away-quee-box-head <?php if($result_cat_s_tc['display_status'] != 'Processing' && $result_cat_s_tc['display_status'] != '') { echo 'readyStatus'; } ?>">
                    
                    <span class="cstDisplayHead" style="font-size: 13px;font-weight: bold;text-transform: uppercase;" > 
                      <img width="20px" class="cst_ready_img" src="../img/tick-white.png">  
                      <img width="20px" class="cst_pending_img" src="../img/pending-white.png">  &nbsp;
                      <?=$payment_sts?>
                    </span>
                     <strong class="orderIdView" style="font-size: 18px">
                      <!-- REF NO :  -->
                      <span><?=$result_cat_s_tc['ref']?></span> </strong>
                     <span style="font-size: 10px;display: none">Final : <?=  number_format($result_cat_s_tc['total'],$_SESSION['be_decimal'])?></span>
                     <span style="font-size: 12px;display: none">Time : <?=$time?></span>
                     <span style="font-size: 15px">Bill No : <?=$result_cat_s_tc['billno']?></span>
                     <span style="font-size: 12px;display: none"> <?=$payment?></span>
                      
                </div>
              
        </div>


  <?php } } }else{ echo 'NO ORDERS FOUND';  }  ?>

         
            
         