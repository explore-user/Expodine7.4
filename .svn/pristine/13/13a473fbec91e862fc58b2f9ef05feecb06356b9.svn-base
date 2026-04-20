<?php

session_start();
include("database.class.php");
$database	= new Database(); 
use Google\Client;
include("api_multiplelanguage_link.php");
$other_lang=  trim(json_encode($_SESSION['main_language']),'""');
error_reporting(0);
if($_REQUEST['set']=='loadtablehead')
 {
  ?>

     <table class="billgenration_new_table" width="100%" border="0">
        <thead>
                <tr>
              
                <th width="20%" class="sortbybill" style="cursor:pointer"><?=$_SESSION['payment_pending_billno']?></th>
             
                <?php if ($_SESSION['typeoofpayemnt'] == 'ALL') { ?> <th width="10%"><?=$_SESSION['completed_order_mode_select']?></th> <?php } ?>
                <th width="25%"><?=$_SESSION['payment_pending_time']?></th>
                <th width="15%"><?=$_SESSION['payment_pending_table_amount']?></th>

                
              </tr>
        </thead>
       </table>

 <?php
     
 }else if(isset($_REQUEST['set']) && $_REQUEST['set']=='loadta_billdetails')
 {  

      $_SESSION['typeoofpayemnt']=$_REQUEST['modeval'];
	  
		  
 ?>
 
 <script type="text/javascript" src="js/payments_ta_cs_select.js"></script>  
 							
                           
                          <table class="billgenration_new_table_content" width="100%" border="0">  
                           <tbody>
         <?php
 
	if (isset($_SESSION['typeoofpayemnt'])) {
   
	 if($_REQUEST['modeval']=='CS'){
             
            $sql_table_sel_query= "Select distinct(tb.tab_billno),tb.tab_time,tb.tab_hdcustomerid ,ts.tac_customername,ts.tac_contactno,tb.tab_status,tb.tab_kotno, tb.tab_mode,tb.tab_netamt From tbl_takeaway_billmaster as tb LEFT JOIN tbl_takeaway_customer ts ON ts.tac_customerid=tb.tab_hdcustomerid Where tb.tab_dayclosedate ='".$_SESSION['date']."' and tb.tab_payment_settled='N' And tb.tab_mode = 'CS' and  tb.tab_billno NOT LIKE 'HOLD%' and tb.tab_billno NOT LIKE 'TEMP%' order by tb.tab_time DESC";
         }else if($_REQUEST['modeval']=='TA'){
             
            $sql_table_sel_query= "Select distinct(tb.tab_billno),tb.tab_time,tb.tab_hdcustomerid ,ts.tac_customername,ts.tac_contactno,tb.tab_status,tb.tab_kotno, tb.tab_mode,tb.tab_netamt From tbl_takeaway_billmaster as tb LEFT JOIN tbl_takeaway_customer ts ON ts.tac_customerid=tb.tab_hdcustomerid Where tb.tab_dayclosedate ='".$_SESSION['date']."' and tb.tab_payment_settled='N' And tb.tab_mode != 'CS' and  tb.tab_billno NOT LIKE 'HOLD%' and tb.tab_billno NOT LIKE 'TEMP%' order by tb.tab_time DESC";
         }
				
    
	$sql_table_sel = $database->mysqlQuery($sql_table_sel_query);
			 $num_table  = $database->mysqlNumRows($sql_table_sel);
		  if($num_table){
				while($result_table_sel  = $database->mysqlFetchArray($sql_table_sel)) 
					{
						
					?>
                               
                     <tr class="clickeachrowpaymnt_ta <?php if(isset($_REQUEST['bilno'])){if($_REQUEST['bilno']==$result_table_sel['tab_billno']) { ?> tr_bill_gen_active  <?php }} ?>" billno="<?= $result_table_sel['tab_billno'] ?>"  kotno="<?=$result_table_sel['tab_kotno']?>" >
                                                        <td width="20%"><strong><?= $result_table_sel['tab_billno'] ?></strong></td>
                                                       <?php if ($_SESSION['typeoofpayemnt'] == 'ALL') { ?> <td width="10%"><?=$result_table_sel['tab_mode']?></td> <?php } ?>
                                                        <td width="25%"> <?= date("h:i:s", strtotime($result_table_sel['tab_time'])) ?></td>

                                                        <td width="15%"><?= number_format($result_table_sel['tab_netamt'],$_SESSION['be_decimal']) ?>/-</td>
                                                    </tr>

 
                                
                                
                    <?php }}else { ?>
                                                    
                   <tr>
                   <td style="color:#F00"><?=$_SESSION['credit_settlement_error_record_display']?></td>
                   </tr>
                   
                   <?php }} ?>
                 
                 </tbody>
                 </table>
                            
                           
 <?php
 }else  if(isset($_REQUEST['set'])&& $_REQUEST['set']=='loadbilldetails_total')
 {
	 if(isset($_REQUEST['billno']))
	 {
	 $bilno=($_REQUEST['billno']);
	 $exp_bilno=array_unique(explode(",",$bilno));
	 }
	 
	  
	?>
 
                            <table  class="billgenration_new_table" width="100%" border="0" cellspacing="5">
                            <thead>
                                  <tr>
                                    <th width="10%"><?=$_SESSION['payment_pending_slno']?></th>
                                    <th width="40%"><?=$_SESSION['payment_pending_menuitem']?></th>
                                    <th width="10%"><?=$_SESSION['payment_pending_qty']?></th>
                                    <th width="15%"><?=$_SESSION['payment_pending_rate']?></th>
                                    <th width="22%"><?=$_SESSION['payment_pending_order_amount']?></th>
                                  </tr>
                              </thead>
                              <tbody >
                              <?php
							  if(isset($_REQUEST['billno']))
							  {
							  $total=0;
							  foreach( $exp_bilno as $number => $value){ 
							  
							  ?>
                              <tr>
                                   <td class="table_dtail_multisel" colspan="5"><?=$_SESSION['payment_pending_billno']?> - <?=$value?></td>
                              </tr>
                             
                             
                               <?php  
				 $sql_listall  =  $database->mysqlQuery("Select tbl_takeaway_billdetails.tab_qty,tbl_takeaway_billdetails.tab_preferencetext,tbl_takeaway_billdetails.tab_slno,tbl_menumaster.mr_menuid,tbl_menumaster.mr_menuname,tbl_portionmaster.pm_portionshortcode,tbl_takeaway_billdetails.tab_status,tbl_takeaway_billdetails.tab_amount,tbl_takeaway_billdetails.tab_rate From tbl_menumaster Inner Join tbl_takeaway_billdetails On tbl_takeaway_billdetails.tab_menuid = tbl_menumaster.mr_menuid Inner Join tbl_portionmaster On tbl_portionmaster.pm_id =tbl_takeaway_billdetails.tab_portion Inner Join tbl_takeaway_billmaster ON tbl_takeaway_billdetails.tab_billno=tbl_takeaway_billmaster.tab_billno Where tbl_takeaway_billdetails.tab_billno = '".$value."' AND (tbl_takeaway_billdetails.tab_status='Packed' || tbl_takeaway_billmaster.tab_payment_settled = 'N')  order by tab_slno ASC"); 
					$num_listall  = $database->mysqlNumRows($sql_listall);
					if($num_listall){
                                            while($row_listall  = $database->mysqlFetchArray($sql_listall)) 
                                                {
                                                      $ordermenu_id=trim(json_encode($row_listall['mr_menuid']),'""');
                                                      $settlement_menuidta=$row_listall['mr_menuid'];
                                                      $settlement_menuta=$row_listall['mr_menuname'];
                                                      
                                                      if($_SESSION['main_language']!='english'){
                
                                                        $sql_arabmenu=$database->mysqlQuery("SELECT lm_menu_name FROM tbl_language_menu_master left join tbl_languages on ls_id=lm_language_id WHERE lm_menu_id='".$settlement_menuidta."' and ls_language='".$_SESSION['main_language']."'");

                                                      
                                                        $num_arabmenu = $database->mysqlNumRows($sql_arabmenu);
                                                        $result_arabmenu = $database->mysqlFetchArray($sql_arabmenu);
                                                        $settlement_menuta=$result_arabmenu['lm_menu_name'];
                                                        
                                                        }
                                                      
                                                     
								 
                                                      
                                                      $total=$total + $row_listall['tab_amount'];
								  ?>
                                  <tr>
                                    <td width="10%"><?=$row_listall['tab_slno'] ?></td>
                                    <td width="40%"><?=$settlement_menuta//$row_listall['mr_menuname'] ?></td>
                                    <td width="10%"><?=$row_listall['tab_qty'] ?></td>
                                    <td width="15%"><?=$row_listall['tab_rate'] ?></td>
                                    <td width="22%"><?=number_format($row_listall['tab_amount'],$_SESSION['be_decimal']) ?></td>
                                  </tr>
                                 
                                  <?php } } ?>
                             <?php }  }?>      
                                  </tbody>
                              </table>
                              
                              
                              
                              
                                                         <?php  
							   
							  if(isset($_REQUEST['billno']))
							  {
							         $total_am =0;
								 $total_sub =0;
								 $total_disc =0;
								 $total_sv=0;
								 $total_va=0;
							  foreach( $exp_bilno as $number => $value){ 
							   
							   
							
				        $sql_listall  =  $database->mysqlQuery("SELECT tab_subtotal as subtot,tab_netamt as total,"
                                                . "  tab_discountvalue as disct,tab_servicecharge as srch,tab_vat as vt from tbl_takeaway_billmaster "
                                                . "  WHERE tab_billno='".$value."'  "); 
					$num_listall  = $database->mysqlNumRows($sql_listall);
					if($num_listall){
						  while($row_listall  = $database->mysqlFetchArray($sql_listall)) 
							  {
								 $total_am=$total_am + $row_listall['total'];
								 $total_sub=$total_sub + $row_listall['subtot'];
								 $total_disc=$total_disc + $row_listall['disct'];
								
								$total_sv=$total_sv+$row_listall['srch'];
								$total_va=$total_va+$row_listall['vt'];
                                 
                                    }
                                    }
									?>
									   <script>
							  //$(document).ready(function(){ 
									$('#grandtotal').html((<?=$total_am?>).toFixed(<?=$_SESSION['be_decimal']?>));
                                                                        $('#grandtotal_sec').html((<?=$total_am?>).toFixed(<?=$_SESSION['be_decimal']?>));
									$('#grandtotal_sec_sub').html((<?=$total_sub?>).toFixed(<?=$_SESSION['be_decimal']?>));
									$('#grandtotal_disc').html((<?=$total_disc?>).toFixed(<?=$_SESSION['be_decimal']?>));
									$('#servchrge_new').html((<?=$total_sv?>).toFixed(<?=$_SESSION['be_decimal']?>));
									$('#vat_new').html((<?=$total_va?>).toFixed(<?=$_SESSION['be_decimal']?>));
							  //});
							  </script>
                                                          
							  <?php }}
									
									else
									{
										$total_am =0;
										$total_sub =0;
										$total_disc =0;
										$total_sv=0;
										$total_va=0;
										?>
                                      <script>
							  //$(document).ready(function(){
									$('#grandtotal').html((<?=$total_am?>).toFixed(<?=$_SESSION['be_decimal']?>));
									$('#grandtotal_sec').html((<?=$total_am?>).toFixed(<?=$_SESSION['be_decimal']?>));
									$('#grandtotal_sec_sub').html((<?=$total_sub?>).toFixed(<?=$_SESSION['be_decimal']?>));
									$('#grandtotal_disc').html(<?=$total_disc?>).toFixed(<?=$_SESSION['be_decimal']?>));
									$('#servchrge_new').html((<?=$total_sv?>).toFixed(<?=$_SESSION['be_decimal']?>));
									$('#vat_new').html((<?=$total_va?>).toFixed(<?=$_SESSION['be_decimal']?>));
							  //});
							  </script>
			     <?php }  ?>
                            
<?php 
    
 }else if($_REQUEST['set']=="bill_settle_ta")
{  
     
     
        $tip_amount=0;
        $tip_mode='C';
        $guest_number='';
        $guest_name='';

        if(isset($_REQUEST['stl'])&& $_REQUEST['stl']=="drct"){
            $billno = $_SESSION['billno'];
        }else{
           $billno	=$_REQUEST['billno'];

        }
     
	$creditype			=NULL;
	$typenam			=$_REQUEST['typenam'];
        
	$credit				='N';
	$amountpaid=0;
	$bal=0;
	$creditdeatils		=NULL;
	$paidamount_credit	=0;
	$amount_credit		=0;
        $credit_remark_ta	=NULL;
	
	$transactionamount	=0;
	$card_bank			=0;
	$complmtry			='N';
	$remark				=NULL;
	$voucherid			=NULL;
	$couponcompany		=NULL;
	$couponamt			=0;
	$chequeno			=NULL;
	$chequebankname		=NULL;
	$chequeamount		=0;
	$staff=NULL;
	
	$secretkey=NULL;
	$stafflist=NULL;
        $upi_amount=0;
        $upi_txn_id=NULL;
        
	if($_REQUEST['type']=="credit_person")
	{ 
            
                $credit_remark_ta       =$_REQUEST['credit_remarks_ta'];
		$creditype		=$_REQUEST['creditype'];
		$creditdeatils		=$_REQUEST['creditdeatils'];
		$paidamount_credit	=$_REQUEST['paidamount_credit'];
		$amountpaid             =$_REQUEST['paidamount_credit'];
		$amount_credit		=$_REQUEST['amount_credit'];
		
                $credit			='Y';
		$bal          		=$_REQUEST['bal'];
                $guest_number          	=$_REQUEST['guestnumber'];
                $guest_name          	=$_REQUEST['guestname'];
                
                if($creditype=='4' ||$creditype=='3'){
                    
                $creditdeatils='';
                   
                $database->mysqlQuery("SET @guestname			= " . "'" . $guest_name . "'");
		$database->mysqlQuery("SET @guestphone			= " . "'" . $guest_number . "'");
                $database->mysqlQuery("SET @branchid			= " . "'" . $_SESSION['branchofid'] . "'");
		 $database->mysqlQuery("SET @credittype			= " . "'" . $creditype . "'");
                $message='';
		$guest=$database->mysqlQuery("CALL proc_credit_entry(@guestname,@guestphone,@branchid,@credittype,@message)") or $database->throw_ex(mysqli_error($database->DatabaseLink));
		$guest_id='';
                $guest1 = $database->mysqlQuery( 'SELECT @message AS message' );
		while($row = mysqli_fetch_array($guest1))
		{
		$guest_id= $row['message'];
		}
                $creditdeatils=$guest_id;
                
                $loy_upd = $database->mysqlQuery(" UPDATE tbl_loyalty_reg SET ly_loy_login='".$_SESSION['login_staff_id_expodine']."',ly_loy_dayclose='".$_SESSION['date']."' where ly_id=LAST_INSERT_ID() ");
                
                
                
                }
                else if($creditype=='1'){
                    $room  =$_REQUEST['room'];   
                }
		
	   }else if($_REQUEST['type']=="complimentary")
	   {
            
		$remark=$_REQUEST['comp'];
		$complmtry='Y';
		
	    }else if($_REQUEST['type']=="comp_management")
	   {
		$remark=$_REQUEST['comp'];
		
		$staff=$_REQUEST['staff'];
		
		
		if(isset($_REQUEST['secretkey']))
		{
		
		$secretkey=$_REQUEST['secretkey'];
		$stafflist=$_REQUEST['stafflist'];
		}
		else
		{
			$secretkey=NULL;
			$stafflist=NULL;
		}
		
		
	}else if($_REQUEST['type']=="cash")
	{
		$amountpaid=$_REQUEST['paid'];
		$bal          		=$_REQUEST['bal'];
		
	}else if($_REQUEST['type']=="credit")
	{
		$transactionamount =$_REQUEST['trans'];
		$card_bank =$_REQUEST['bank'];
		$amountpaid=$_REQUEST['paid'];
		$bal          		=$_REQUEST['bal'];
							 
	}else if($_REQUEST['type']=="coupon")
	{
		$couponcompany=$_REQUEST['coup'];
		$couponamt=$_REQUEST['coupamnt'];
		$amountpaid=$_REQUEST['paid'];
		$bal          		=$_REQUEST['bal'];
		
		
	}else if($_REQUEST['type']=="voucher")
	{
		$voucherid=$_REQUEST['vouchid'];
		$amountpaid=$_REQUEST['paid'];
		$bal          		=$_REQUEST['bal'];
		
	}else if($_REQUEST['type']=="cheque")
	{
		$chequeno			=$_REQUEST['cheqname'];
		$chequebankname		=$_REQUEST['cheqbank'];
		$chequeamount		=$_REQUEST['cheqamt'];
		$bal          		=$_REQUEST['bal'];
		
		
	}
        else if($_REQUEST['type']=="upi")
	{
		$upi_amount=$_REQUEST['upi_amount'];
                $upi_txn_id=$_REQUEST['upi_txn_id'];
		
	}
        
        
	$md=1;
	$sql_listall  =  $database->mysqlQuery("Select * FROM tbl_takeaway_billmaster  Where tab_billno = '".$billno."' AND (tab_mode = 'CS')");
	$num_listall  = $database->mysqlNumRows($sql_listall);
	if($num_listall){
		$md++; 
	}
        $tip_amount=$_REQUEST['tip_amount'];
        $tip_mode=$_REQUEST['tip_mode'];
	
	
        
         if($_SESSION['staff_assign_bypass_hd']=='Y'){ 
             $sql_loy=$database->mysqlQuery("update tbl_takeaway_billmaster set tab_delivery_status='D'  where tab_billno='".$billno."'");
        }
        
        
        
        if($couponamt >0){
            
        $date= date('Y-m-d H:i:s');
        $queryupdate=$database->mysqlQuery("update tbl_loyalty_group_details set tgp_code_active='N', "
        . " tgp_billno='".$billno."',tgp_coupon_amount='".$couponamt."',tgp_bill_date_time='".$date."', "
        . " tgp_bill_amount='".$_REQUEST['bill_final_amount_new']."' where tgp_groupcode='".$_REQUEST['coupon_code']."' ");     
       }
     
        
        
        
        
	
        if($credit == "Y" || $complmtry == "Y" ){
            
       $date_py= date('Y-m-d H:i:s');
       $insertion['tp_datetime'] 		=  mysqli_real_escape_string($database->DatabaseLink,trim($date_py));
       $insertion['tp_login'] 		        =  mysqli_real_escape_string($database->DatabaseLink,trim($_SESSION['expodine_id']));
       $insertion['tp_auth_staff'] 		=  mysqli_real_escape_string($database->DatabaseLink,trim($_REQUEST['auth_staff']));
       
        if($complmtry == "Y"){
          $insertion['tp_pay_type'] 		=  mysqli_real_escape_string($database->DatabaseLink,trim("complimentary"));
        }else if($credit == "Y"){
          $insertion['tp_pay_type'] 	=  mysqli_real_escape_string($database->DatabaseLink,trim("credit_person"));
        }
        
        $insertion['tp_billno'] 	=  mysqli_real_escape_string($database->DatabaseLink,trim($billno));
        $sql=$database->check_duplicate_entry('tbl_payment_auth_log',$insertion);
        if($sql!=1)
	{
	$insertid  =  $database->insert('tbl_payment_auth_log',$insertion);
        }
    }
        
        
        
	  $returnmsg=''; 
	  try {
   
		
		$database->mysqlQuery("SET @billno				= " . "'" . $billno . "'");
		$database->mysqlQuery("SET @branchid			= " . "'" . $_SESSION['branchofid'] . "'");
		$database->mysqlQuery("SET @paymodeid			= " . "'" . $typenam . "'");
		$database->mysqlQuery("SET @amountpaid			= " . "'" . $amountpaid . "'");
		$database->mysqlQuery("SET @upi_amount			= " . "'" . $upi_amount . "'");
                $database->mysqlQuery("SET @upi_txn_id			= " . "'" . $upi_txn_id . "'");
                $database->mysqlQuery("SET @transactionamount	= " . "'" . $transactionamount . "'");
		$database->mysqlQuery("SET @card_bank			= " . "'" . $card_bank . "'");
		$database->mysqlQuery("SET @complementary		= " . "'" . $complmtry . "'");
		$database->mysqlQuery("SET @remark				= " . "'" . $remark . "'");
		$database->mysqlQuery("SET @voucherid			= " . "'" . $voucherid . "'");
		$database->mysqlQuery("SET @couponcompany		= " . "'" . $couponcompany . "'");
		$database->mysqlQuery("SET @couponamt			= " . "'" . $couponamt . "'");
		$database->mysqlQuery("SET @chequeno			= " . "'" . $chequeno . "'");
		$database->mysqlQuery("SET @chequebankname 		= " . "'" . $chequebankname . "'");
		$database->mysqlQuery("SET @chequeamount		= " . "'" . $chequeamount . "'");
		$database->mysqlQuery("SET @credit				= " . "'" . $credit . "'");
		$database->mysqlQuery("SET @creditmasterid		= " . "'" . $creditdeatils . "'");
		$database->mysqlQuery("SET @creditamount		= " . "'" . $amount_credit . "'");
		$database->mysqlQuery("SET @balanceamt		= " . "'" . $bal . "'");
		
		$database->mysqlQuery("SET @complementary_staff		= " . "'" . $staff . "'");
		$database->mysqlQuery("SET @auth_secretkey		= " . "'" . $secretkey . "'");
		$database->mysqlQuery("SET @auth_staffid		= " . "'" . $stafflist . "'");
		$database->mysqlQuery("SET @auth_loginid		= " . "'" . $_SESSION['expodine_id'] . "'");
                $database->mysqlQuery("SET @payment_login		= " . "'" . $_SESSION['expodine_id'] . "'");
		$database->mysqlQuery("SET @credit_remark_ta		= " . "'" . $credit_remark_ta . "'");
		$message='';
		$database->mysqlQuery("SET @order_confirming_staff = " . "'".$_SESSION['login_dayopen_staffid']."'");
		if($md=="2")
		{
			$kotno='';
			$database->mysqlQuery("SET @mode		= " . "'CS'");
			$sq=$database->mysqlQuery("CALL proc_gencounter_billsettle_kot(@billno,@branchid,@paymodeid,@amountpaid,@upi_amount,@upi_txn_id,@transactionamount,@card_bank,@complementary,@remark,@voucherid,@couponcompany,@couponamt,@chequeno,@chequebankname ,@chequeamount,@credit,@creditmasterid,@creditamount,@balanceamt,@complementary_staff,@mode,@payment_login,@kotno,@order_confirming_staff,@message)") or $database->throw_ex(mysqli_error($database->DatabaseLink));
			$rs = $database->mysqlQuery( 'SELECT @message AS message,@kotno AS kotno' );
			while($row = mysqli_fetch_array($rs))
			{
			$s= $row['message'];
			$_SESSION['printkotno']=$row['kotno'];
			}
			$returnmsg=$s;
			$_SESSION['printkotbillno']=$_SESSION['billno'];
			echo $returnmsg;
		}else
		{
		$sq=$database->mysqlQuery("CALL proc_ta_billpayment(@billno,@branchid,@paymodeid,@amountpaid,@upi_amount,@upi_txn_id,@transactionamount,@card_bank,@complementary,@remark,@voucherid,@couponcompany,@couponamt,@chequeno,@chequebankname ,@chequeamount,@credit,@creditmasterid,@creditamount,@balanceamt,@complementary_staff,@payment_login,@credit_remark_ta,@message)") or $database->throw_ex(mysqli_error($database->DatabaseLink));
	
		$rs = $database->mysqlQuery( 'SELECT @message AS message' );
		while($row = mysqli_fetch_array($rs))
		{
		$s= $row['message'];
		}
		$returnmsg=$s;
                if($returnmsg=='Payment succesfully processed'){
                    $tip = $database->mysqlQuery(" UPDATE `tbl_takeaway_billmaster` SET `tab_tips_given`='".$tip_amount."',`tab_tips_mode`='".$tip_mode."' WHERE tab_billno='".$billno."' "); 
                }
                
                
                if($_REQUEST['type']=="credit_person" && trim($returnmsg)=='Payment succesfully processed' && $creditype==1){
                    
                   $queryupdate=$database->mysqlQuery("update tbl_credit_details set cd_settled='Y',cd_dateofsettle=now() where cd_billno='".$billno."' ");
               
                    $curl = curl_init();
                    curl_setopt_array($curl, array(
                    CURLOPT_URL => $_SESSION['be_expolitelink']."/expodineroomservice",
                    CURLOPT_RETURNTRANSFER => true,
                    CURLOPT_ENCODING => "",
                    CURLOPT_MAXREDIRS => 10,
                    CURLOPT_TIMEOUT => 30,
                    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                    CURLOPT_CUSTOMREQUEST => "POST",
                    CURLOPT_POSTFIELDS => "{\"room_no\": \"$room\",\"amount\":\"$amount_credit\" ,\"billno\": \"$billno\"}",
                    CURLOPT_HTTPHEADER => array(
                        "accept: application/json",
                        "cache-control: no-cache",
                        "content-type: application/json"
                        
                    ),
                ));
                    
                    $response = curl_exec($curl);
                    $err = curl_error($curl);
                    curl_close($curl);
                    if ($err) {
                        echo "cURL Error #:" . $err;
                    } else {
                        echo $response;
                    }
                }
		echo $returnmsg;
		}
                
                 
       ///inv start///          
       if($_SESSION['s_inventory_staff_add']=='Y' && $_SESSION['be_inv_sales_stock_reduce']=='Y'){
           
        $sql_login_invstore  =  $database->mysqlQuery("update tbl_takeaway_billdetails set tab_staff_store='".$_SESSION['ser_store_inv']."'   where tab_dayclose_in='".$_SESSION['date']."' and tab_billno='$billno' ");    
              
        $weight='';
       
        $sql_login_inv  =  $database->mysqlQuery("select * from tbl_takeaway_billdetails  where tab_dayclose_in='".$_SESSION['date']."' and tab_billno='$billno'  limit 100 "); 
	$num_login_inv   = $database->mysqlNumRows($sql_login_inv);
	if($num_login_inv){ 
	while($result_inv = $database->mysqlFetchArray($sql_login_inv)) 
        { 
          
           
            
       ////product wise//
       $sql_listall  =  $database->mysqlQuery("select * from tbl_production where tp_product='".$result_inv['tab_menuid']."' and tp_store='".$_SESSION['ser_store_inv']."' "); 
       $num_listall  = $database->mysqlNumRows($sql_listall);
       if($num_listall){
           
            if($result_inv['tab_rate_type']=='Portion' || $result_inv['tab_base_unit_id']=='3' || $result_inv['tab_unit_id']=='5'){
                
                $fnct_menu2 = $database->mysqlQuery("update tbl_store_stock set ts_qty=(ts_qty-'".$result_inv['tab_qty']."') , ts_total=(ts_unit_price*ts_qty),ts_average= (ts_total/ts_qty)  where ts_product='".$result_inv['tab_menuid']."' and ts_store='".$_SESSION['ser_store_inv']."'  ");
      
              }else{
                  
                  
               if($result_inv['tab_unit_type']=='Packet' && ($result_inv['tab_unit_id']=='3' || $result_inv['tab_unit_id']=='2')){      
                  
                $fnct_menu2 = $database->mysqlQuery("update tbl_store_stock set ts_qty=(ts_qty-'".$result_inv['tab_qty']."'),ts_total=(ts_unit_price*ts_qty) ,ts_average= (ts_total/ts_qty) where ts_weight='".$result_inv['tab_unit_weight']."' and  ts_product='".$result_inv['tab_menuid']."' and ts_store='".$_SESSION['ser_store_inv']."' ");           
       
             }else{    
                  
                 $weight=($result_inv['tab_qty']*$result_inv['tab_unit_weight']);     
                  
                $fnct_menu2 = $database->mysqlQuery("update tbl_store_stock set ts_weight=(ts_weight-'".$weight."'),ts_total=(ts_unit_price*ts_weight) ,ts_average= (ts_total/ts_weight) where ts_product='".$result_inv['tab_menuid']."' and ts_store='".$_SESSION['ser_store_inv']."' ");           
       
             }
        
            }
          
        }else{
            
            
            
             $st_tahd='';
             if($billno[0]=='T'){
               $st_tahd=" and tmi_ta='Y' ";
             }else if($billno[0]=='H'){
               $st_tahd=" and tmi_hd='Y' ";
             }
            
            
            ///recipe wise///
             
            if($result_inv['tab_portion']!=''){
              $sql_login_f =  $database->mysqlQuery("select * from tbl_menu_ingredient_detail where tmi_menuid='".$result_inv['tab_menuid']."' and tmi_store='".$_SESSION['ser_store_inv']."' and tmi_portion='".$result_inv['tab_portion']."' $st_tahd "); 
            }else{
                
              $sql_login_f =  $database->mysqlQuery("select * from tbl_menu_ingredient_detail where tmi_menuid='".$result_inv['tab_menuid']."' and tmi_store='".$_SESSION['ser_store_inv']."' $st_tahd ");     
            }
            
            $num_login_f   = $database->mysqlNumRows($sql_login_f);
	    if($num_login_f){ 
	    while($result_login_f  = $database->mysqlFetchArray($sql_login_f)) 
            { 
           
            
            $qty_inv=$result_inv['tab_qty']*($result_login_f['tmi_ing_qty']/$result_login_f['tmi_yield']);
            
            $wgt_inv=$result_inv['tab_qty']*($result_login_f['tmi_weight']/$result_login_f['tmi_yield']);
             
            
        if($result_login_f['tmi_ing_unit']=='Single' || $result_login_f['tmi_ing_unit']=='Nos' ){
            
        $fnct_menu2 = $database->mysqlQuery("update tbl_store_stock set ts_qty=(ts_qty-'".$qty_inv."') , ts_total=(ts_unit_price*ts_qty),ts_average= (ts_total/ts_qty)  where ts_product='".$result_login_f['tmi_ing_menuid']."' and ts_store='".$_SESSION['ser_store_inv']."'  ");
       
        }else{
                 
        if($result_login_f['tmi_rate_type']=='Packet' && ($result_login_f['tmi_ing_unit']=='KG' || $result_login_f['tmi_ing_unit']=='LTR')){ 
                 
        $fnct_menu2 = $database->mysqlQuery("update tbl_store_stock set ts_qty=(ts_qty-'".$qty_inv."'),ts_total=(ts_unit_price*ts_qty) ,ts_average= (ts_total/ts_qty) where   ts_product='".$result_login_f['tmi_ing_menuid']."' and ts_store='".$_SESSION['ser_store_inv']."'  ");           
       
        }else{
                  
        $fnct_menu2 = $database->mysqlQuery("update tbl_store_stock set ts_weight=(ts_weight-'".$wgt_inv."'),ts_total=(ts_unit_price*ts_weight) ,ts_average= (ts_total/ts_weight) where ts_product='".$result_login_f['tmi_ing_menuid']."' and ts_store='".$_SESSION['ser_store_inv']."'  ");           
        
        }
        
        }
           
        }}else{
            
            ///normalwise///
            
            if($result_inv['tab_rate_type']=='Portion' || $result_inv['tab_base_unit_id']=='3' || $result_inv['tab_unit_id']=='5'){
                
                $fnct_menu2 = $database->mysqlQuery("update tbl_store_stock set ts_qty=(ts_qty-'".$result_inv['tab_qty']."') , ts_total=(ts_unit_price*ts_qty),ts_average= (ts_total/ts_qty)  where ts_product='".$result_inv['tab_menuid']."' and ts_store='".$_SESSION['ser_store_inv']."'  ");
      
            }else{
                  
                  
            if($result_inv['tab_unit_type']=='Packet' && ($result_inv['tab_unit_id']=='3' || $result_inv['tab_unit_id']=='2')){      
                  
                $fnct_menu2 = $database->mysqlQuery("update tbl_store_stock set ts_qty=(ts_qty-'".$result_inv['tab_qty']."'),ts_total=(ts_unit_price*ts_qty) ,ts_average= (ts_total/ts_qty) where ts_weight='".$result_inv['tab_unit_weight']."' and  ts_product='".$result_inv['tab_menuid']."' and ts_store='".$_SESSION['ser_store_inv']."' ");           
       
            }else{    
                  
                $weight=($result_inv['tab_qty']*$result_inv['tab_unit_weight']);     
                  
                $fnct_menu2 = $database->mysqlQuery("update tbl_store_stock set ts_weight=(ts_weight-'".$weight."'),ts_total=(ts_unit_price*ts_weight) ,ts_average= (ts_total/ts_weight) where ts_product='".$result_inv['tab_menuid']."' and ts_store='".$_SESSION['ser_store_inv']."' ");           
       
            } } }
            
            
        }
          
          
        ////foodcost entry///
        
             $st_tahd='';
             if($billno[0]=='T'){
             $st_tahd.=" and tfc_ta='Y' ";
             }else if($billno[0]=='H'){
               $st_tahd.=" and tfc_hd='Y' ";
             }
        
        
        $food_cost_menu=0;
        $sql_login_cost  =  $database->mysqlQuery("select sum(tfc_total) as cost from tbl_food_cost where tfc_menu='".$result_inv['tab_menuid']."' $st_tahd group by tfc_menu,date(tfc_date) order by tfc_date asc  "); 
	$num_login_cost    = $database->mysqlNumRows($sql_login_cost );
	if($num_login_cost ){ 
	while($result_login_cost   = $database->mysqlFetchArray($sql_login_cost)) 
        { 
          $food_cost_menu=($result_inv['tab_qty']*$result_login_cost['cost']);
        }}
       
        $sql_login_inv_cost  =  $database->mysqlQuery("update tbl_takeaway_billdetails set tab_cost='$food_cost_menu' where tab_dayclose_in='".$_SESSION['date']."' and tab_billno='$billno' and tab_menuid='".$result_inv['tab_menuid']."' "); 
       
       ////foodcost end///
        
             
        }}
       }    
       
    ///inv end///   
       
       
     
       
                
        $qr_order='';       
        $sql_login_fire1  =  $database->mysqlQuery("Select tab_food_partner,tab_qr_order_id,tab_assignedto FROM tbl_takeaway_billmaster  Where tab_dayclosedate ='".$_SESSION['date']."' and tab_billno = '".$billno."'   "); 
	$num_login_fire1   = $database->mysqlNumRows($sql_login_fire1);
	if($num_login_fire1){ 
	while($result_login_fire1  = $database->mysqlFetchArray($sql_login_fire1)) 
        { 
            
            
         if($result_login_fire1['tab_assignedto']!=''){   
             
          $sql_timealot  =  $database->mysqlQuery("UPDATE tbl_takeaway_billmaster set tab_delivery_status = 'P'  
          WHERE tab_dayclosedate='".$_SESSION['date']."' and tab_billno = '$billno' "); 
         }
            
        $qr_order=$result_login_fire1['tab_qr_order_id'];
            
        $sql_login_fire2  =  $database->mysqlQuery("Select tol_discount FROM tbl_online_order  Where tol_id = '".$result_login_fire1['tab_food_partner']."' "); 
	$num_login_fire2   = $database->mysqlNumRows($sql_login_fire2);
	if($num_login_fire2){ 
	while($result_login_fire2  = $database->mysqlFetchArray($sql_login_fire2)) 
        { 
          $discount_online_partner=$result_login_fire2['tol_discount'];
          
          
          $food_update = $database->mysqlQuery(" UPDATE `tbl_takeaway_billmaster` SET tab_food_partner_discount=(tab_netamt*$discount_online_partner/100) ,tab_food_partner_total=(tab_netamt-tab_food_partner_discount) WHERE tab_billno='".$billno."' "); 
             
        }}
             
        }}
                
             
        
        if($qr_order!=''){
            
           $date=date('Y-m-d H:i:s');
           $localhost1=mysqli_connect(HOST_NAME_CLOUD, USER_NAME_CLOUD, PASSWORD_CLOUD,DATABASE_NAME_QR); 
           
         $sql_gen =  mysqli_query($localhost1,"Update tbl_qr_order_details set tq_localy_delivered='Y' ,tq_deliverd_time='$date' "
                 . " where tq_branch='".$_SESSION['firebase_id']."' and tq_order_no='$qr_order' ");  
               
        }             
                
                
                
        $sql_login_fire  =  $database->mysqlQuery("select tf_active from tbl_firebase_notification_report where tf_report_head='Complimentary Settle' "); 
	$num_login_fire   = $database->mysqlNumRows($sql_login_fire);
	if($num_login_fire){ 
	while($result_login_fire  = $database->mysqlFetchArray($sql_login_fire)) 
        { 
            $firebase_report_status_comp=$result_login_fire['tf_active'];
        }}
        
        
        $sql_login_fire2  =  $database->mysqlQuery("select tf_active from tbl_firebase_notification_report where tf_report_head='Credit Settle' "); 
	$num_login_fire2   = $database->mysqlNumRows($sql_login_fire2);
	if($num_login_fire2){ 
	while($result_login_fire2  = $database->mysqlFetchArray($sql_login_fire2)) 
        { 
            $firebase_report_status_credit=$result_login_fire2['tf_active'];
        }}     
                
                
      if($_REQUEST['num_sms_new']!=''){
               
        $sql_login_fire22  =  $database->mysqlQuery("select ly_id from tbl_loyalty_reg where ly_mobileno='".$_REQUEST['num_sms_new']."' limit 1 "); 
	$num_login_fire22   = $database->mysqlNumRows($sql_login_fire22);
	if($num_login_fire22){ 
         while($result_login_fire22  = $database->mysqlFetchArray($sql_login_fire22)) 
         {   
             
        $date= date('Y-m-d H:i:s');   $mode="CS";  
        
        $insertion['lob_billno']=  mysqli_real_escape_string($database->DatabaseLink,trim($billno));
          
        $insertion['lob_point_add']= mysqli_real_escape_string($database->DatabaseLink,trim(0));
      
        $insertion['lob_point_redeem']= mysqli_real_escape_string($database->DatabaseLink,trim(0));
       
        $insertion['lob_redeem_amount']= mysqli_real_escape_string($database->DatabaseLink,trim(0));
        
        $insertion['lob_bill_amount']= mysqli_real_escape_string($database->DatabaseLink,trim($_REQUEST['bill_final_amount_new']));
      
        $insertion['lob_date']= mysqli_real_escape_string($database->DatabaseLink,trim($date));
       
        $insertion['lob_loyalty_customer']= mysqli_real_escape_string($database->DatabaseLink,trim($result_login_fire22['ly_id']));
     
        $insertion['lob_mode']= mysqli_real_escape_string($database->DatabaseLink,trim($mode));
      
      $sql=$database->check_duplicate_entry('tbl_loyalty_pointadd_bill',$insertion);
      if($sql!=1)
	{
	$insertid              			=  $database->insert('tbl_loyalty_pointadd_bill',$insertion);
        } 
        
        
                    
        } }else{
           
            
        $loy_qry14 = $database->mysqlQuery("INSERT INTO `tbl_loyalty_reg`(`ly_firstname`,`ly_mobileno`) VALUES ('".$_REQUEST['name_sms_new']."','".$_REQUEST['num_sms_new']."')");
             
        $sql_login_fire22  =  $database->mysqlQuery("select ly_id from tbl_loyalty_reg where ly_mobileno='".$_REQUEST['num_sms_new']."' limit 1 "); 
	$num_login_fire22   = $database->mysqlNumRows($sql_login_fire22);
	if($num_login_fire22){ 
        while($result_login_fire22  = $database->mysqlFetchArray($sql_login_fire22)) 
         {    
            
        $date= date('Y-m-d H:i:s');   $mode="CS";  
        
        $insertion['lob_billno']=  mysqli_real_escape_string($database->DatabaseLink,trim($billno));
          
        $insertion['lob_point_add']= mysqli_real_escape_string($database->DatabaseLink,trim(0));
      
        $insertion['lob_point_redeem']= mysqli_real_escape_string($database->DatabaseLink,trim(0));
       
        $insertion['lob_redeem_amount']= mysqli_real_escape_string($database->DatabaseLink,trim(0));
        
        $insertion['lob_bill_amount']= mysqli_real_escape_string($database->DatabaseLink,trim($_REQUEST['bill_final_amount_new']));
      
        $insertion['lob_date']= mysqli_real_escape_string($database->DatabaseLink,trim($date));
       
        $insertion['lob_loyalty_customer']= mysqli_real_escape_string($database->DatabaseLink,trim($result_login_fire22['ly_id']));
     
        $insertion['lob_mode']= mysqli_real_escape_string($database->DatabaseLink,trim($mode));
      
        $sql=$database->check_duplicate_entry('tbl_loyalty_pointadd_bill',$insertion);
        if($sql!=1)
	{
	    $insertid       =  $database->insert('tbl_loyalty_pointadd_bill',$insertion);
        } 
           
             
         }
        }
                 
      }
  }   
        
       
    if($_REQUEST['sms_bill_settle']=='Y' ){     
          
     $customer='';  $number='';    
     $loy_qry1 = $database->mysqlQuery("select lr.ly_firstname,lr.ly_mobileno from tbl_loyalty_pointadd_bill lb"
     . " left join tbl_loyalty_reg lr on lr.ly_id=lb.lob_loyalty_customer where lb.lob_billno='".$billno."'");
   
     $num_loy = $database->mysqlNumRows($loy_qry1);
     if($num_loy)
     {
         while($loyalty_listing = $database->mysqlFetchArray($loy_qry1))
         {
              $customer=$loyalty_listing['ly_firstname'];
              $number=$loyalty_listing['ly_mobileno'];
             
     }}
     
     
     ///encode///
    $secret_key = 'my_simple_secret_key';
    $secret_iv = 'my_simple_secret_iv';

    $conv1 = false;
    
    $encrypt_method = "AES-256-CBC";
    $key = hash( 'sha256', $secret_key );
    $iv = substr( hash( 'sha256', $secret_iv ), 0, 16 );

    $conv=$billno.','.$_SESSION['firebase_id'];
    
    $conv1 = base64_encode( openssl_encrypt( $conv, $encrypt_method, $key, 0, $iv ) );
    ////encode_end////
     
      //$message= " * Here is your ebill of Rs.".$_REQUEST['bill_final_amount_new']."."
      //   . "Click: https://ebill.expodine.com/ebill.php?b_id=$conv1 ";
    
      $var2= "http://expodinereports.com/ebill/ebill.php?b_id=$conv1"; 
      // $message= $customer."*".$_SESSION['s_branchname'];
      
      $message= $customer."*".$var2;
   
    if($number !=''){      
        //$print=$database->dynamic_sms_api($number,$message);
        
    $var1=$_SESSION['s_branchname'];    
         ///whatsapp bill///
     
    
    if($_SESSION['ebill_link']=='Y'){
        
     $data = file_get_contents("https://bhashsms.com/api/sendmsg.php?user=ExploreITBW&pass=123456&sender=BUZWAP&phone=$number"
     . "&text=bill_new2&priority=wa&"
     . "stype=normal&Params=$var1,$var2");
     
     }else{
             
     $data = file_get_contents("https://bhashsms.com/api/sendmsg.php?user=ExploreITBW&pass=123456&sender=BUZWAP&phone=$number"
     . "&text=bill_thankyou123&priority=wa&"
     . "stype=normal&Params=$var1"); 
     
     }
  
        if (strpos($data, 'S.') !== false){
           
          $msg5 = 'MESSAGE SENT';
        
        }else{
          
          $msg5 = 'ERROR';
          
        }
        
        
    }
        
     }
        
        
        
        
        if($_SESSION['cloud_enable_sync']=='Y' && $_SESSION['firebase_on']=='Y' && ( ($credit=="Y" && $firebase_report_status_credit=='Y') || ($complmtry=="Y" && $firebase_report_status_comp=='Y') )){
         
         $staff_pay='';
         $sql_table_sel3  = $database->mysqlQuery("SELECT * from tbl_staffmaster  WHERE  ser_staffid ='".$_REQUEST['auth_staff']."' "); 
         $num_table3  = $database->mysqlNumRows($sql_table_sel3);
         if($num_table3)
          {
	    while($row = mysqli_fetch_array($sql_table_sel3))
		{
		
                   $staff_pay= $row['ser_firstname'];
                
		}
           }
         
           
         if($staff_pay!=''){
                $staff_pay1=$staff_pay;
         }else{
                $staff_pay1=' No Authorization ';
         }
         
        $date_nw_nw=date('Y-m-d H:i:s');
        $a="8.8.8.8";
        exec("ping -n 1 -w 1 ".$a, $output, $result);
        if($result==0)
        {
            
          $amt_fire=$_REQUEST['bill_final_amount_new'];
            
          if($credit == "Y" ){
              
              $title1=$_SESSION['s_branchname']." :  CREDIT BILL ";
              
              $data_body=" CREDIT BILL \nBill No: $billno  \nDate:$date_nw_nw \nCredit Amount :$amount_credit \nAuthorization staff:$staff_pay1 \nBill Amount : $amt_fire  ";
              
          }else if($complmtry == "Y" ){   
              
               $title1=$_SESSION['s_branchname']." :  COMPLIMENTARY BILL ";
               $data_body=" COMPLIMENTARY BILL \nBill No: $billno  \nDate:$date_nw_nw \nAuthorization Staff:$staff_pay1 \nBill Amount : $amt_fire  ";
          }
            
    ///pushing msg///
    $branch_id_fire=$_SESSION['firebase_id'];
    
    require 'vendor/autoload.php';
    
    $client = new Client();
    $client->setAuthConfig('service_google.json'); // Replace with your file path
    $client->addScope('https://www.googleapis.com/auth/firebase.messaging');
    $accessToken = $client->fetchAccessTokenWithAssertion()['access_token'];
    $body = $data_body;
   $url = "https://fcm.googleapis.com/v1/projects/ed-reports-b5f94/messages:send";
    $projectId = 'ed-reports-b5f94'; 
 
     $data = [
    'message' => [
       "topic"=> $branch_id_fire,
        'notification' => [
            'title' => $title1,
            'body' => $body
        ],
        'data' => [
            'key1' => 'value1',
            'key2' => 'value2'
        ],
         "android" =>[
      "ttl"=> "3600s" , // TTL in seconds (1 hour)
       "priority"=> "HIGH"     
    ],
        'apns' => [
        "headers"=>[
        "apns-expiration" => "2" ,// TTL for iOS
         "apns-priority"=> "10"         
      ],
            'payload' => [
                'aps' => [
                    'sound' => 'default', // Notification sound for iOS
                ],
            ],
        ],
    ]
   ];

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        'Authorization: Bearer ' . $accessToken,
        'Content-Type: application/json'
    ]);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
    $response = curl_exec($ch);
    if(curl_errno($ch)) {
        echo 'Error:' . curl_error($ch);
    } else {
        echo 'Response: ' . $response;
    }
    curl_close($ch);
    
    
   // $url = "https://fcm.googleapis.com/fcm/send";
//   //$token ='dFCy-onTEvQ:APA91bGXAQobatT-sbeLk3QTFdh-Zf10Z7dzmUIO99GHDjkrmwWwvzA7poh5dbAv55B7KrFKAQtpDwkJgo9lgwxFUC0W_RrnI1ohd7c-IJJfuCTeSSdhyKowMEKwOYZk5met5QhnCx0T';
//    $serverKey = 'AIzaSyD3zn_tP2RqeVSMsEFMJnrcZk5AuNGru-M';
//    $title = $title1;
//    
//    $body = $data_body;
//    $notification = array('title' =>$title , 'body' => $body, 'sound' => 'default', 'badge' => '1', 'click_action' =>'notification');
//    $arrayToSend = array('to' => "/topics/$branch_id_fire" , 'notification' => $notification,'priority'=>'high');
//    $json = json_encode($arrayToSend);
//    $headers = array();
//    $headers[] = 'Content-Type: application/json';
//    $headers[] = 'Authorization: key='. $serverKey;
//    $ch = curl_init();
//    curl_setopt($ch, CURLOPT_URL, $url);
//    curl_setopt($ch, CURLOPT_CUSTOMREQUEST,"POST");
//    curl_setopt($ch, CURLOPT_POSTFIELDS, $json);
//    curl_setopt($ch, CURLOPT_HTTPHEADER,$headers);
//    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
//    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);  
//    //Send the request
//    $response = curl_exec($ch);
//    //Close request
//    if ($response === FALSE) {
//    die('FCM Send Error: ' . curl_error($ch));
//    }
//    curl_close($ch);
    
    //to database storage of msg//
    $data_to_firebase=urlencode($body);
    $url = $_SESSION['firebase_url']."api/post_notification?branhcid=$branch_id_fire&notification=$data_to_firebase";
    $headers = array();
    $headers[] = 'Content-Type: application/json';
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_HTTPHEADER,$headers);
    curl_setopt($ch,CURLOPT_USERAGENT,"Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.8.1.13) Gecko/20080311 Firefox/2.0.0.13");
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $result = curl_exec($ch);
    curl_close($ch);
   
      }
        }
                
                
	  } catch (Exception $e) {
		  $returnmsg= 'Caught exception: '.  $e;
		  $file = 'log.txt';
		  $content = date("l F d-m-Y h:i:s A")." ".$returnmsg.PHP_EOL;
		  file_put_contents($file, $content, FILE_APPEND | LOCK_EX);
		  echo $returnmsg; exit();
	  }
	
	

}
else if($_REQUEST['set']=="checkcashdrawersettings") 
{
	if($_SESSION['s_cash_drawer_settle_btn']=='Y')
	{
		echo "Y";
	}else
	{
		echo "N";
	}
	
}

else if(isset($_REQUEST['set']) && $_REQUEST['set']=='point_loyalty'){ 
    
          $sql_login  =  $database->mysqlQuery("select ly_points from tbl_loyalty_reg where  ly_id='".$_REQUEST['pointid']."' and ly_status='Active' "); 
	  $num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login){
		  while($result_login  = $database->mysqlFetchArray($sql_login)) 
		  {
                          echo $result_login['ly_points'];
                      
                  }
                  }
}else if(isset($_REQUEST['set']) && $_REQUEST['set']=='search_loyal_id'){ 
    
     $name1='';
     $id_loy=$_REQUEST['id_loyalty'];
   
          $sql_login  =  $database->mysqlQuery("select  ly_id,ly_firstname,ly_mobileno,ly_lastname from tbl_loyalty_reg "
                  . " where ly_id='".$id_loy."'  and ly_status='Active' "); 
	  $num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login){
		  while($result_login  = $database->mysqlFetchArray($sql_login)) 
			{ 
                                $id= $result_login['ly_id'];
                                $name1= $result_login['ly_firstname']. $result_login['ly_lastname'];
				$num= $result_login['ly_mobileno'];
                             ?>

                        <ul>
                        <li class="nav" id="load_name_ul" onclick="return id_click('<?=$name1?>','<?=$id?>','<?=$num?>');" style="cursor: pointer;font-weight: bold;color:darkred" >
                        <?=$id?>    
                        </li>
                        </ul>
<?php
		    
 }
 }
   
	
}
else if(isset($_REQUEST['set']) && $_REQUEST['set']=='searchname'){ 
    
   $name1='';
   $name=$_REQUEST['name'];
   
   if(strlen($_REQUEST['name'])>2){
       
            $sql_login  =  $database->mysqlQuery("select  ly_id,ly_firstname,ly_mobileno,ly_lastname from tbl_loyalty_reg where "
            . " (ly_firstname LIKE '%".$name."%' or ly_lastname LIKE '%".$name."%') and ly_status='Active' "); 
	  $num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login){
		  while($result_login  = $database->mysqlFetchArray($sql_login)) 
			{ 
                                 $id= $result_login['ly_id'];
                                 $name1= $result_login['ly_firstname'].' '.$result_login['ly_lastname'];
				 $num= $result_login['ly_mobileno'];
                                 
                             ?>

                                   <ul>
                                   <li id="load_name_ul" onclick="return name_click('<?=$name1?>','<?=$id?>','<?=$num?>');" style="cursor: pointer;font-weight: bold;color:darkred" >
                                   <?=$name1?>    
                                   </li>
                                   </ul>
<?php
		   
    }
    }
    }
	
}else if(isset($_REQUEST['set']) && $_REQUEST['set']=='searchname_new'){ 
    
     $name1='';
     $name=$_REQUEST['name'];
   
   if(strlen($_REQUEST['name'])>2){
       
          $sql_login  =  $database->mysqlQuery("select  ly_emailid,ly_gst,ly_id,ly_firstname,ly_mobileno,ly_lastname "
          . " from tbl_loyalty_reg where  (ly_firstname LIKE '%".$name."%' or ly_lastname LIKE '%".$name."%') and ly_status='Active' and (ly_default!='Y' or ly_default is NULL) "); 
	  $num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login){
		  while($result_login  = $database->mysqlFetchArray($sql_login)) 
			{ 
                                 $id= $result_login['ly_id'];
                                 $name1= $result_login['ly_firstname'].' '.$result_login['ly_lastname'];
				 $num= $result_login['ly_mobileno'];
                                 $mail= $result_login['ly_emailid'];
                                 
                                 $gst= $result_login['ly_gst'];
                                 
                             ?>

                            <ul>
                            <li id="load_name_ul" onclick="return name_click_new('<?=$name1?>','<?=$id?>','<?=$num?>','<?=$mail?>','<?=$gst?>');" style="cursor: pointer;font-weight: bold;color:darkred" >
                            <?=$name1?>    
                            </li>
                            </ul>
        <?php
		   
        }
        }
   }
	
}
else if(isset($_REQUEST['set']) && $_REQUEST['set']=='searchnum_new'){ 
    
      $num1='';
      $num=$_REQUEST['num'];
   
     if(strlen($num)>2){
          $sql_login  =  $database->mysqlQuery("select  ly_emailid,ly_gst,ly_id,ly_firstname,ly_mobileno,ly_lastname from tbl_loyalty_reg where "
                  . " ly_mobileno LIKE '%".$num."%' and ly_status='Active' and (ly_default!='Y' or ly_default is NULL) "); 
	  $num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login){
		  while($result_login  = $database->mysqlFetchArray($sql_login)) 
			{ 
                                 $id= $result_login['ly_id'];
                                 $name1= $result_login['ly_firstname'].' '.$result_login['ly_lastname'];
				 $num= $result_login['ly_mobileno'];
                                 $mail= $result_login['ly_emailid'];
                                 
                                 $gst= $result_login['ly_gst'];
                                 
                             ?>

                            <ul>
                            <li id="load_name_ul" onclick="return num_click_new('<?=$name1?>','<?=$id?>','<?=$num?>','<?=$mail?>','<?=$gst?>');" style="cursor: pointer;font-weight: bold;color:darkred" >
                            <?=$num?>    
                            </li>
                            </ul>
<?php
		      
    }
    }
    
   }
	
}
else if(isset($_REQUEST['set']) && $_REQUEST['set']=='searchnumber'){ 
    
     $num1='';
     $num=$_REQUEST['number'];
   
   if(strlen($_REQUEST['number'])>2){
       
          $sql_login  =  $database->mysqlQuery("select ly_id,ly_firstname,ly_mobileno,ly_lastname from tbl_loyalty_reg where"
                  . "  ly_mobileno LIKE '%".$num."%' and ly_status='Active' and ly_default!='Y'  "); 
	  $num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login){
		  while($result_login  = $database->mysqlFetchArray($sql_login)) 
			{ 
                                 $id= $result_login['ly_id'];
                                 $name1= $result_login['ly_firstname']. $result_login['ly_lastname'];
				 $num= $result_login['ly_mobileno'];
                             ?>

                                <ul>
                                <li id="load_number_ul" onclick="return number_click('<?=$name1?>','<?=$id?>','<?=$num?>');" style="cursor: pointer;font-weight: bold;color:darkred" >
                                <?=$num?>    
                                </li>
                                </ul>
<?php
		  
                  }
                  }
   }
	
}else if($_REQUEST['set_loyalty_bill_change']=="bill_amount_change"){
    
     $bill_no_l=$_REQUEST['billno'];
     $new_amount= $_REQUEST['new_amount'];
     $sql_loy_nw=$database->mysqlQuery("update  tbl_takeaway_billmaster set tab_netamt='".$new_amount."' where tab_billno='".$bill_no_l."'");    
     
}else if($_REQUEST['set_loyalty_bill_change_old']=="bill_amount_change_old"){
    
    
    $bill_no_l_old=$_REQUEST['billno_old'];
    $new_amount_old= $_REQUEST['new_amount_old'];
    $sql_loy_nw=$database->mysqlQuery("update  tbl_takeaway_billmaster set tab_netamt='".$new_amount_old."' where tab_billno='".$bill_no_l_old."'");    
     
    $_SESSION['ta_order_id']='';
    
    unset($_SESSION['ta_order_id']);
    
}else if($_REQUEST['sethistory']=="delhistory"){
        
             $multibilldelhistory=     $_REQUEST['bilcardhistory'];
        
             $queryhistory=$database->mysqlQuery("  DELETE FROM tbl_bill_card_payments WHERE"
             . " (mc_billno = 'temp_".$multibilldelhistory."' or mc_billno = '".$multibilldelhistory."')");  
           
}  

?>