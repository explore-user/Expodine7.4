<?php
session_start();
include("database.class.php"); // DB Connection class
$database = new Database();
use Google\Client;

if(isset($_REQUEST['action']) && $_REQUEST['action']=='billamount'){
    
    $menu_list=array();
    $sql_tbl  =  $database->mysqlQuery("select tbm.bm_tips_given,tbm.bm_discountvalue,tbm.bm_subtotal_final,tbm.bm_finaltotal "
    . " FROM tbl_tablebillmaster tbm where tbm.bm_dayclosedate ='".$_SESSION['date']."' and tbm.bm_billno='".$_REQUEST['billno']."' limit 1 ");
    $num_tbl  = $database->mysqlNumRows($sql_tbl);
    if($num_tbl){
	while($row_tbl  = $database->mysqlFetchArray($sql_tbl)) {
            $menu_list['DISCOUNT']=number_format($row_tbl['bm_discountvalue'],$_SESSION['be_decimal']);
            $menu_list['SUBTOTAL'] = number_format($row_tbl['bm_subtotal_final'],$_SESSION['be_decimal']);
            $menu_list['FINAL'] = number_format($row_tbl['bm_finaltotal'],$_SESSION['be_decimal']);
            $menu_list['TIP'] = number_format($row_tbl['bm_tips_given'],$_SESSION['be_decimal']);
        }
        
    }
    
   
    $sql_tax  =  $database->mysqlQuery("select bem.bem_taxid ,bem.bem_total_value, bem.bem_label FROM tbl_tablebill_extra_tax_master bem "
    . " where bem.bem_dayclose ='".$_SESSION['date']."' and  bem.bem_billno='".$_REQUEST['billno']."' group by bem.bem_taxid limit 10");
    $num_tax  = $database->mysqlNumRows($sql_tax);
    if($num_tax){
	while($row_tax  = $database->mysqlFetchArray($sql_tax)) {
            $menu_list['TAX'][$row_tax['bem_label']]['AMOUNT']=number_format($row_tax['bem_total_value'],$_SESSION['be_decimal']);
            $menu_list['TAX'][$row_tax['bem_label']]['ID']=$row_tax['bem_taxid'];
        }
        
    }
    
    $sql_tbl_ds  =  $database->mysqlQuery("select sum(bd_discount) as disc,bd_qty FROM tbl_tablebilldetails where "
    . " bd_dayclose_in ='".$_SESSION['date']."' and bd_billno='".$_REQUEST['billno']."' limit 50 ");
    $num_tbl_ds  = $database->mysqlNumRows($sql_tbl_ds);
    if($num_tbl_ds){
	while($row_tbl_ds  = $database->mysqlFetchArray($sql_tbl_ds)) {
            $menu_list['DISCOUNT_ITEM']=number_format(($row_tbl_ds['disc']*$row_tbl_ds['bd_qty']),$_SESSION['be_decimal']);
           
        }
        
    }
    
   echo json_encode($menu_list); 
}
else if(isset($_REQUEST['action']) && $_REQUEST['action']=='billitems_select'){
    
    $menu_list=array();
    $menu_details=array();
    $kotlist=array();
    
    //--------------- TABLE NO,SUBTOTAL,FINAL --------------//   
    
    $sql_tbl  =  $database->mysqlQuery("select tbm.bm_tableno,tbm.bm_subtotal_final,tbm.bm_finaltotal FROM tbl_tablebillmaster tbm where tbm.bm_dayclosedate ='".$_SESSION['date']."' and tbm.bm_billno='".$_REQUEST['billno']."'");
    $num_tbl  = $database->mysqlNumRows($sql_tbl);
    if($num_tbl){
	while($row_tbl  = $database->mysqlFetchArray($sql_tbl)) {
            $menu_list['TABLE']=$row_tbl['bm_tableno'];
            $menu_list['SUBTOTAL'] = number_format($row_tbl['bm_subtotal_final'],$_SESSION['be_decimal']);;
            $menu_list['FINAL'] = number_format($row_tbl['bm_finaltotal'],$_SESSION['be_decimal']);
        }
        
    }
    //------------------------ TABLE NO,SUBTOTAL,FINAL ENDS---------------------------------------------//   
    
    //------------------------ KOT NO ---------------------------------------------//   
    $sql_kot  =  $database->mysqlQuery("select distinct(tor.ter_kotno) as kotno from tbl_tableorder tor  where tor.ter_dayclosedate ='".$_SESSION['date']."' and tor.ter_billnumber = '".$_REQUEST['billno']."' ");
    //echo "select tor.ter_kotno from tbl_tableorder tor  where tor.ter_billnumber = '".$_REQUEST['billno']."' group by tor.ter_orderno";
    $num_kot  = $database->mysqlNumRows($sql_kot);
    if($num_kot){
        while($row_kot  = $database->mysqlFetchArray($sql_kot)){
            
            $kotlist[]=$row_kot['kotno'];
        }
        $menu_list['KOT'] = implode(',',$kotlist);
    }
    //------------------------ KOT NO ENDS ---------------------------------------------//      
    
    //------------------------ MENU DETAILS ---------------------------------------------//   
    $combo_entry_count=array();
    
    $sql_combo_list  =  $database->mysqlQuery("select distinct(cbd.cbd_count_combo_ordering) as cbd_count_combo_ordering, cbd.cbd_combo_pack_rate, cbd.cbd_combo_total_rate, cbd.cbd_combo_qty, cn.cn_name,cp.cp_pack_name   FROM tbl_combo_bill_details cbd
                                                left join tbl_combo_name cn on cn.cn_id=cbd.cbd_combo_id
                                                left join tbl_combo_packs cp on cp.cp_id=cbd.cbd_combo_pack_id
                                                where cbd.cbd_billno='".$_REQUEST['billno']."' order by cbd.cbd_count_combo_ordering asc "); 
    $num_combo_list  = $database->mysqlNumRows($sql_combo_list);
    if($num_combo_list){
        while($result_combo_list  = $database->mysqlFetchArray($sql_combo_list)) 
        {    
            $combo_menu_array=array();
            if(!in_array($result_combo_list['cbd_count_combo_ordering'],$combo_entry_count)){
                
                $combo_entry_count[]=$result_combo_list['cbd_count_combo_ordering'];
                //$total=$total+$result_combo_list['cod_combo_total_rate'];
                //$combo_qty=$combo_qty+$result_combo_list['cbd_combo_qty'];                 
                $sql_combomenu_list  =  $database->mysqlQuery("select mm.mr_menuname  FROM tbl_combo_bill_details cbd
                                    left join tbl_menumaster mm on mm.mr_menuid=cbd.cbd_menu_id
                                    where cbd.cbd_count_combo_ordering='".$result_combo_list['cbd_count_combo_ordering']."' and cbd.cbd_billno='".$_REQUEST['billno']."'");
                                    $num_combomenu_list  = $database->mysqlNumRows($sql_combomenu_list);
                                    if($num_combomenu_list){$combo_pack='';$combo_menu_array=array();
                                        while($result_combomenu_list  = $database->mysqlFetchArray($sql_combomenu_list)){
                                            $combo_menu_array[]=$result_combomenu_list['mr_menuname'];
                                            if(!in_array($result_combo_list['cn_name'].' '.$result_combo_list['cp_pack_name'],$menu_details)){
                                                
                                                $combo_pack=$result_combo_list['cn_name'].' '.$result_combo_list['cp_pack_name'];
                                                $menu_details[$result_combo_list['cn_name'].' '.$result_combo_list['cp_pack_name']]['ITEM']=$combo_pack;
                                                $menu_details[$result_combo_list['cn_name'].' '.$result_combo_list['cp_pack_name']]['QTY']=$result_combo_list['cbd_combo_qty'];
                                                $menu_details[$result_combo_list['cn_name'].' '.$result_combo_list['cp_pack_name']]['RATE']=number_format($result_combo_list['cbd_combo_pack_rate'],$_SESSION['be_decimal']);
                                                $menu_details[$result_combo_list['cn_name'].' '.$result_combo_list['cp_pack_name']]['TOTAL']=number_format($result_combo_list['cbd_combo_total_rate'],$_SESSION['be_decimal']);
                                                $menu_details[$result_combo_list['cn_name'].' '.$result_combo_list['cp_pack_name']]['ADDON']='';
                                           $menu_details[$result_combo_list['cn_name'].' '.$result_combo_list['cp_pack_name']]['PORTION']='';
                                                }
                                            $menu_details[$combo_pack]['COMBO_PACK_MENUS']=implode(',',array_unique($combo_menu_array));
                                            $menu_list['MENUS'] = $menu_details;
                                        }
            }                       }
        }
    }
    
    $sql_listall  =  $database->mysqlQuery("SELECT pm.pm_portionshortcode,td.bd_billslno,td.bd_bill_addon_slno,td.bd_menuid,td.bd_qty as bd_qty,bd_rate,td.bd_amount as bd_amount,mn.mr_menuname,mn.mr_menuid from tbl_tablebilldetails as td LEFT JOIN tbl_menumaster as mn ON td.bd_menuid=mn.mr_menuid LEFT JOIN tbl_portionmaster as pm ON td.bd_portion=pm.pm_id WHERE td.bd_billno='".$_REQUEST['billno']."' AND bd_cancelled='N' AND bd_qty>0 group by bd_billslno order by td.bd_billslno "); 
    //echo "SELECT td.bd_bill_addon_slno,td.bd_menuid,td.bd_qty as bd_qty,bd_rate,td.bd_amount as bd_amount,mn.mr_menuname,mn.mr_menuid from tbl_tablebilldetails as td LEFT JOIN tbl_menumaster as mn ON td.bd_menuid=mn.mr_menuid LEFT JOIN tbl_portionmaster as pm ON td.bd_portion=pm.pm_id WHERE td.bd_billno='".$_REQUEST['billno']."' AND bd_cancelled='N' AND bd_qty>0 group by bd_billslno order by td.bd_billslno ";
    $num_listall  = $database->mysqlNumRows($sql_listall);
    if($num_listall){
        while($row_listall  = $database->mysqlFetchArray($sql_listall)) 
        {  
            $billsettle_menuid= trim(json_encode($row_listall['bd_menuid']),'""');
            $billsettle_menuname=$row_listall['mr_menuname'];
            
            if($_SESSION['main_language']!='english'){
                $sql_arabmenu=$database->mysqlQuery("SELECT lm_menu_name FROM tbl_language_menu_master left join tbl_languages on ls_id=lm_language_id WHERE lm_menu_id='".$row_listall['mr_menuid']."' and ls_language='".$_SESSION['main_language']."'");
                $num_arabmenu = $database->mysqlNumRows($sql_arabmenu);
                $result_arabmenu = $database->mysqlFetchArray($sql_arabmenu);
                $billsettle_menuname=$result_arabmenu['lm_menu_name'];
            }
            $menu_details[$row_listall['bd_billslno']]['ITEM']=$billsettle_menuname;
            $menu_details[$row_listall['bd_billslno']]['QTY']=$row_listall['bd_qty'];
            $menu_details[$row_listall['bd_billslno']]['PORTION']=$row_listall['pm_portionshortcode'];
            $menu_details[$row_listall['bd_billslno']]['RATE']=number_format($row_listall['bd_rate'],$_SESSION['be_decimal']);
            $menu_details[$row_listall['bd_billslno']]['TOTAL']=number_format($row_listall['bd_amount'],$_SESSION['be_decimal']);
            $menu_details[$row_listall['bd_billslno']]['COMBO_PACK_MENUS']='';
            if($row_listall['bd_bill_addon_slno']!=''){
                $menu_details[$row_listall['bd_billslno']]['ADDON']='(AD)';  
            }else{
                  $menu_details[$row_listall['bd_billslno']]['ADDON']='';
            }
            $menu_list['MENUS'] = $menu_details;
        }
    }    
    //------------------------ MENU DETAILS ENDS ---------------------------------------------//      
    
    echo json_encode($menu_list);
}
else if(isset($_REQUEST['action']) && $_REQUEST['action']=='bill_settle'){
    
    $settlement_details=json_decode($_REQUEST['settlement_details']);
    
    
    if($settlement_details->coupon_amount >0){
        
        $date= date('Y-m-d H:i:s');
        $queryupdate=$database->mysqlQuery("update tbl_loyalty_group_details set tgp_code_active='N',"
        . " tgp_billno='".$settlement_details->settlement_bill."',tgp_coupon_amount='".$settlement_details->coupon_amount."',"
        . " tgp_bill_date_time='".$date."',tgp_bill_amount='".$settlement_details->bill_final_amount_new."' "
        . " where tgp_groupcode='".$settlement_details->coupon_code."' ");     
  
   }
     
    
    if($settlement_details->credit_settle == "Y" || $settlement_details->compliemntary_settle == "Y" ){
        
       $date_py= date('Y-m-d H:i:s');
       $insertion['tp_datetime'] 		=  mysqli_real_escape_string($database->DatabaseLink,trim($date_py));
       $insertion['tp_login'] 		=  mysqli_real_escape_string($database->DatabaseLink,trim($_SESSION['expodine_id']));
       $insertion['tp_auth_staff'] 		=  mysqli_real_escape_string($database->DatabaseLink,trim($_REQUEST['auth_staff']));
       
        if($settlement_details->compliemntary_settle == "Y"){
          $insertion['tp_pay_type'] 		=  mysqli_real_escape_string($database->DatabaseLink,trim("complimentary"));
        }else if($settlement_details->credit_settle == "Y"){
          $insertion['tp_pay_type'] 	=  mysqli_real_escape_string($database->DatabaseLink,trim("credit_person"));
        }
        
        $insertion['tp_billno'] 	=  mysqli_real_escape_string($database->DatabaseLink,trim($settlement_details->settlement_bill));
        
        $sql=$database->check_duplicate_entry('tbl_payment_auth_log',$insertion);
        if($sql!=1)
	{
	$insertid  =  $database->insert('tbl_payment_auth_log',$insertion);
        }
        
    }
    
      
    $creditdeatils='';
    if($settlement_details->settlement_mode=="credit_person"){
        $room='';
        $creditdeatils=$settlement_details->credit_master_id;
        
        if($settlement_details->credit_type==4 ||$settlement_details->credit_type==3){
            $creditdeatils=0;
            $database->mysqlQuery("SET @guestname			= " . "'" . $settlement_details->guest_name . "'");
            $database->mysqlQuery("SET @guestphone			= " . "'" . $settlement_details->guest_number . "'");
            $database->mysqlQuery("SET @branchid			= " .                          1);
            $database->mysqlQuery("SET @credittype			= " . "'" . $settlement_details->credit_type . "'");
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
           
            else if($settlement_details->credit_type==1){
              $room  =$settlement_details->room;   
            }
             
    }
    
    
    
    try {
	
        $database->mysqlQuery("SET @billno			= " . "'" . $settlement_details->settlement_bill . "'");
        $database->mysqlQuery("SET @branchid			= " .                   1                            );
        $database->mysqlQuery("SET @paymodeid			= " . "'" . $settlement_details->settlement_mode_id . "'");
        $database->mysqlQuery("SET @amountpaid			= " . "'" . $settlement_details->amount_paid . "'");
        $database->mysqlQuery("SET @upi_amount			= " . "'" . $settlement_details->upi_amount . "'");
        $database->mysqlQuery("SET @upi_txn_id			= " . "'" . $settlement_details->upi_txn_id . "'");
        $database->mysqlQuery("SET @transactionamount           = " . "'" . $settlement_details->transaction_amount . "'");
        $database->mysqlQuery("SET @card_bank			= " . "'" . $settlement_details->bank . "'");
        $database->mysqlQuery("SET @complementary		= " . "'" . $settlement_details->compliemntary_settle . "'");
        $database->mysqlQuery("SET @remark			= " . "'" . $settlement_details->complimentary_remak . "'");
        $database->mysqlQuery("SET @voucherid			= " . "'" . $settlement_details->voucher_id . "'");
        $database->mysqlQuery("SET @couponcompany		= " . "'" . $settlement_details->coupon_company . "'");
        $database->mysqlQuery("SET @couponamt			= " . "'" . $settlement_details->coupon_amount . "'");
        $database->mysqlQuery("SET @chequeno			= " . "'" . $settlement_details->cheque_no . "'");
        $database->mysqlQuery("SET @chequebankname 		= " . "'" . $settlement_details->cheque_bank_name . "'");
        $database->mysqlQuery("SET @chequeamount		= " . "'" . $settlement_details->cheque_amount . "'");
        $database->mysqlQuery("SET @credit			= " . "'" . $settlement_details->credit_settle . "'");
        $database->mysqlQuery("SET @creditmasterid		= " . "'" . $creditdeatils . "'");
        $database->mysqlQuery("SET @creditamount		= " . "'" . $settlement_details->credit_amount . "'");
        $database->mysqlQuery("SET @balanceamt                  = " . "'" . $settlement_details->balance_amount . "'");
        $database->mysqlQuery("SET @complementary_staff		= " . "'" . $settlement_details->complementary_mgnt_staff . "'");
        $database->mysqlQuery("SET @auth_secretkey		= " . "'" . $settlement_details->complementary_mgnt_secretkey . "'");
        $database->mysqlQuery("SET @auth_staffid		= " . "'" . $settlement_details->complementary_mgnt_staffid . "'");
        $database->mysqlQuery("SET @auth_loginid		= " . "'" . $_SESSION['expodine_id'] . "'");
        $database->mysqlQuery("SET @payment_login		= " . "'" . $_SESSION['expodine_id'] . "'");
        $database->mysqlQuery("SET @credit_remark		= " . "'" . $settlement_details->credit_remark . "'");
        $database->mysqlQuery("SET @guest_name                  = " . "'" . $settlement_details->guest_name . "'");
        $database->mysqlQuery("SET @guest_number		= " . "'" . $settlement_details->guest_number . "'");
		
	$message='';
	$sq=$database->mysqlQuery("CALL proc_billpayment(@billno,@branchid,@paymodeid,@amountpaid,@upi_amount,@upi_txn_id,@transactionamount,@card_bank,@complementary,@remark,@voucherid,@couponcompany,@couponamt,@chequeno,@chequebankname ,@chequeamount,@credit,@creditmasterid,@creditamount,@balanceamt,@complementary_staff,@auth_secretkey,@auth_staffid,@auth_loginid,@payment_login,@credit_remark,@message)") or $database->throw_ex(mysqli_error($database->DatabaseLink));
	$rs = $database->mysqlQuery( 'SELECT @message AS message' );
	while($row = mysqli_fetch_array($rs)){
		$s= $row['message'];
	}
	$returnmsg=$s;
        
        
        
        if($returnmsg=='Payment succesfully processed'){
            
           $tip = $database->mysqlQuery(" UPDATE `tbl_tablebillmaster` SET `bm_tips_given`='".$settlement_details->tip_amount."',`bm_tips_mode`='".$settlement_details->tip_mode."' WHERE bm_dayclosedate='".$_SESSION['date']."' and bm_billno='".$settlement_details->settlement_bill."' "); 
       
           
           $del_table_order_split = $database->mysqlQuery(" Delete from tbl_tabledetails where ts_billnumber='".$settlement_details->settlement_bill."' ");
           
        }        
        
        
        
        
        if($settlement_details->settlement_mode=="credit_person" && $returnmsg=='Payment succesfully processed' && $settlement_details->credit_type==1){
            
            $queryupdate=$database->mysqlQuery("update tbl_credit_details set cd_settled='Y',cd_dateofsettle=now() where cd_billno='".$settlement_details->settlement_bill."' ");
               
                    $curl = curl_init();
                    curl_setopt_array($curl, array(
                    CURLOPT_URL => $_SESSION['be_expolitelink']."/expodineroomservice",
                    CURLOPT_RETURNTRANSFER => true,
                    CURLOPT_ENCODING => "",
                    CURLOPT_MAXREDIRS => 10,
                    CURLOPT_TIMEOUT => 30,
                    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                    CURLOPT_CUSTOMREQUEST => "POST",
                    CURLOPT_POSTFIELDS => "{\"room_no\": \"$room\",\"amount\":\"$settlement_details->credit_amount\" ,\"billno\": \"$settlement_details->settlement_bill\"}",
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
        
        
        
        $qr_order='';           
         $sql_listall5  =  $database->mysqlQuery("SELECT bm_qr_orderno from tbl_tablebillmaster  WHERE bm_dayclosedate='".$_SESSION['date']."'  and bm_billno='".$settlement_details->settlement_bill."' limit 1   "); 
	$num_listall5  = $database->mysqlNumRows($sql_listall5);
	if($num_listall5){  $default_loy='Y';
	while($row_listall5  = $database->mysqlFetchArray($sql_listall5)) 
	 {	
            $qr_order=$row_listall5['bm_qr_orderno'];
        }
        }    
        
        
        if($_SESSION['cloud_enable_sync']=='Y' && $_SESSION['table_view_in']=='Y'){
            
         
           $localhost1=mysqli_connect(HOST_NAME_CLOUD, USER_NAME_CLOUD, PASSWORD_CLOUD,DATABASE_NAME_QR); 
           
            $sql_gen88 =  mysqli_query($localhost1,"delete from tbl_tabledetails where "
            . " ts_billnumber='".$settlement_details->settlement_bill."' and branchid='".$_SESSION['firebase_id']."'  "); 
            
            
           
        }
        
        
        
        
        if($qr_order!=''){
            
           $date=date('Y-m-d H:i:s');
           $localhost1=mysqli_connect(HOST_NAME_CLOUD, USER_NAME_CLOUD, PASSWORD_CLOUD,DATABASE_NAME_QR); 
   
         $sql_gen =  mysqli_query($localhost1,"Update tbl_qr_order_details set tq_localy_delivered='Y' ,tq_deliverd_time='$date' "
         . " where tq_branch='".$_SESSION['firebase_id']."' and tq_order_no='$qr_order' ");  
               
          $sql_gen =  mysqli_query($localhost1,"select tc.tu_name,tc.tu_number from tbl_qr_order_details td "
          . " left join tbl_qr_user_detail tc on td.tq_user = tc.tu_number   where td.tq_localy_ready='Y' "
          . " and td.tq_cancelled!='Y' AND td.tq_branch='".$_SESSION['firebase_id']."' and td.tq_order_no='".$qr_order."' limit 1"); 
       
		$num_gen  = mysqli_num_rows($sql_gen);
		if($num_gen)
		{
		while($result_cat_s_tc  = mysqli_fetch_array($sql_gen)) 
		{
                                    
          $sql_listall5  =  $database->mysqlQuery("update tbl_tablebillmaster set bm_cname='".$result_cat_s_tc['tu_name']."',bm_cnumber='".$result_cat_s_tc['tu_number']."' "
          . "  WHERE bm_dayclosedate='".$_SESSION['date']."'  and bm_billno='".$settlement_details->settlement_bill."'    ");                      
                    
          }
          }
         
               
        }          
        
        
        
        ///inv start///   
        if($_SESSION['s_inventory_staff_add']=='Y' && $_SESSION['be_inv_sales_stock_reduce']=='Y'){
       
         $sql_login_invstore  =  $database->mysqlQuery("update tbl_tablebilldetails set bd_staff_store='".$_SESSION['ser_store_inv']."' where bd_billno='".$settlement_details->settlement_bill."'   "); 
	
            
        $weight='';
        $sql_login_inv  =  $database->mysqlQuery("select * from tbl_tablebilldetails  where bd_billno='".$settlement_details->settlement_bill."'  limit 100 "); 
	$num_login_inv   = $database->mysqlNumRows($sql_login_inv);
	if($num_login_inv){ 
	while($result_inv = $database->mysqlFetchArray($sql_login_inv)) 
        { 
          
            
       ////product wise//
            
       $sql_listall  =  $database->mysqlQuery("select * from tbl_production where tp_product='".$result_inv['bd_menuid']."' and tp_store='".$_SESSION['ser_store_inv']."' "); 
       $num_listall  = $database->mysqlNumRows($sql_listall);
       if($num_listall){
        
            
        if($result_inv['bd_rate_type']=='Portion' || $result_inv['bd_base_unit_id']=='3' || $result_inv['bd_unit_id']=='5'){
            
        $fnct_menu2 = $database->mysqlQuery("update tbl_store_stock set ts_qty=(ts_qty-'".$result_inv['bd_qty']."') , ts_total=(ts_unit_price*ts_qty),ts_average= (ts_total/ts_qty)  where ts_product='".$result_inv['bd_menuid']."' and ts_store='".$_SESSION['ser_store_inv']."'  ");
       
        }else{
                 
        if($result_inv['bd_unit_type']=='Packet' && ($result_inv['bd_unit_id']=='3' || $result_inv['bd_unit_id']=='2')){ 
                 
        $fnct_menu2 = $database->mysqlQuery("update tbl_store_stock set ts_qty=(ts_qty-'".$result_inv['bd_qty']."'),ts_total=(ts_unit_price*ts_qty) ,ts_average= (ts_total/ts_qty) where ts_weight='".$result_inv['bd_unit_weight']."' and  ts_product='".$result_inv['bd_menuid']."' and ts_store='".$_SESSION['ser_store_inv']."' ");           
       
        }else{
                 
        $weight=($result_inv['bd_qty']*$result_inv['bd_unit_weight']);     
                  
        $fnct_menu2 = $database->mysqlQuery("update tbl_store_stock set ts_weight=(ts_weight-'".$weight."'),ts_total=(ts_unit_price*ts_weight) ,ts_average= (ts_total/ts_weight) where ts_product='".$result_inv['bd_menuid']."' and ts_store='".$_SESSION['ser_store_inv']."' ");           
        
        }
        
       }
       
       }else{
           
        ////recipee wise///
           
        if($result_inv['bd_portion']!=''){
            $sql_login_f =  $database->mysqlQuery("select * from tbl_menu_ingredient_detail where tmi_menuid='".$result_inv['bd_menuid']."' and tmi_store='".$_SESSION['ser_store_inv']."' and tmi_portion='".$result_inv['bd_portion']."' and tmi_di='Y' "); 
      
            }else{
                $sql_login_f =  $database->mysqlQuery("select * from tbl_menu_ingredient_detail where tmi_menuid='".$result_inv['bd_menuid']."' and tmi_store='".$_SESSION['ser_store_inv']."' and tmi_di='Y'  ");   
        }
        
        $num_login_f   = $database->mysqlNumRows($sql_login_f);
	if($num_login_f){ 
	while($result_login_f  = $database->mysqlFetchArray($sql_login_f)) 
        { 
            
            $qty_inv=$result_inv['bd_qty']*($result_login_f['tmi_ing_qty']/$result_login_f['tmi_yield']);
            
            $wgt_inv=$result_inv['bd_qty']*($result_login_f['tmi_weight']/$result_login_f['tmi_yield']);
             
            
             if($result_login_f['tmi_ing_unit']=='Single' || $result_login_f['tmi_ing_unit']=='Nos' ){
            
        $fnct_menu2 = $database->mysqlQuery("update tbl_store_stock set ts_qty=(ts_qty-'".$qty_inv."') , ts_total=(ts_unit_price*ts_qty),ts_average= (ts_total/ts_qty)  where ts_product='".$result_login_f['tmi_ing_menuid']."' and ts_store='".$_SESSION['ser_store_inv']."'  ");
       
        }else{
                 
        if($result_login_f['tmi_rate_type']=='Packet' && ($result_login_f['tmi_ing_unit']=='KG' || $result_login_f['tmi_ing_unit']=='LTR')){ 
                 
        $fnct_menu2 = $database->mysqlQuery("update tbl_store_stock set ts_qty=(ts_qty-'".$qty_inv."'),ts_total=(ts_unit_price*ts_qty) ,ts_average= (ts_total/ts_qty) where   ts_product='".$result_login_f['tmi_ing_menuid']."' and ts_store='".$_SESSION['ser_store_inv']."'  ");           
       
        }else{
                  
        $fnct_menu2 = $database->mysqlQuery("update tbl_store_stock set ts_weight=(ts_weight-'".$wgt_inv."'),ts_total=(ts_unit_price*ts_weight) ,ts_average= (ts_total/ts_weight) where ts_product='".$result_login_f['tmi_ing_menuid']."' and ts_store='".$_SESSION['ser_store_inv']."'  ");           
        
        }
        
       }
            
          
        } }else{
            
            
        ////normal wise////
            
            
        if($result_inv['bd_rate_type']=='Portion' || $result_inv['bd_base_unit_id']=='3' || $result_inv['bd_unit_id']=='5'){
            
        $fnct_menu2 = $database->mysqlQuery("update tbl_store_stock set ts_qty=(ts_qty-'".$result_inv['bd_qty']."') , ts_total=(ts_unit_price*ts_qty),ts_average= (ts_total/ts_qty)  where ts_product='".$result_inv['bd_menuid']."' and ts_store='".$_SESSION['ser_store_inv']."'  ");
       
        }else{
                 
        if($result_inv['bd_unit_type']=='Packet' && ($result_inv['bd_unit_id']=='3' || $result_inv['bd_unit_id']=='2')){ 
                 
        $fnct_menu2 = $database->mysqlQuery("update tbl_store_stock set ts_qty=(ts_qty-'".$result_inv['bd_qty']."'),ts_total=(ts_unit_price*ts_qty) ,ts_average= (ts_total/ts_qty) where ts_weight='".$result_inv['bd_unit_weight']."' and  ts_product='".$result_inv['bd_menuid']."' and ts_store='".$_SESSION['ser_store_inv']."' ");           
       
        }else{
                 
        $weight=($result_inv['bd_qty']*$result_inv['bd_unit_weight']);     
                  
        $fnct_menu2 = $database->mysqlQuery("update tbl_store_stock set ts_weight=(ts_weight-'".$weight."'),ts_total=(ts_unit_price*ts_weight) ,ts_average= (ts_total/ts_weight) where ts_product='".$result_inv['bd_menuid']."' and ts_store='".$_SESSION['ser_store_inv']."' ");           
        
        } } }
        
       }
       
       
       
       ////foodcost entry///
        $food_cost_menu=0;
        $sql_login_cost  =  $database->mysqlQuery("select sum(tfc_total) as cost from tbl_food_cost where tfc_menu='".$result_inv['bd_menuid']."' and tfc_di='Y' group by tfc_menu,date(tfc_date) order by tfc_date asc  "); 
	$num_login_cost    = $database->mysqlNumRows($sql_login_cost );
	if($num_login_cost ){ 
	while($result_login_cost   = $database->mysqlFetchArray($sql_login_cost)) 
        { 
          $food_cost_menu=($result_inv['bd_qty']*$result_login_cost['cost']);
        }}
       
        $sql_login_inv_cost  =  $database->mysqlQuery("update tbl_tablebilldetails set bd_cost='$food_cost_menu' where bd_billno='$settlement_details->settlement_bill' and bd_menuid='".$result_inv['bd_menuid']."' "); 
       
       ////foodcost end///
       
       
         
   }}
          
   ///inv end///  
       
   }      
        
        
        
        ///Firebse Notification/////
   
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
        
        $insertion['lob_billno']=  mysqli_real_escape_string($database->DatabaseLink,trim($settlement_details->settlement_bill));
          
        $insertion['lob_point_add']= mysqli_real_escape_string($database->DatabaseLink,trim(0));
      
        $insertion['lob_point_redeem']= mysqli_real_escape_string($database->DatabaseLink,trim(0));
       
        $insertion['lob_redeem_amount']= mysqli_real_escape_string($database->DatabaseLink,trim(0));
        
        $insertion['lob_bill_amount']= mysqli_real_escape_string($database->DatabaseLink,trim($settlement_details->bill_final_amount_new));
      
        $insertion['lob_date']= mysqli_real_escape_string($database->DatabaseLink,trim($date));
       
        $insertion['lob_loyalty_customer']= mysqli_real_escape_string($database->DatabaseLink,trim($result_login_fire22['ly_id']));
     
        $insertion['lob_mode']= mysqli_real_escape_string($database->DatabaseLink,trim($mode));
      
      $sql=$database->check_duplicate_entry('tbl_loyalty_pointadd_bill',$insertion);
      if($sql!=1)
	{
          
	$insertid      =  $database->insert('tbl_loyalty_pointadd_bill',$insertion);
        
        } 
        
        
        } }else{
           
           $loy_qry14 = $database->mysqlQuery("INSERT INTO `tbl_loyalty_reg`(`ly_firstname`,`ly_mobileno`) VALUES ('".$_REQUEST['name_sms_new']."','".$_REQUEST['num_sms_new']."')");
         
        $sql_login_fire22  =  $database->mysqlQuery("select ly_id from tbl_loyalty_reg where ly_mobileno='".$_REQUEST['num_sms_new']."' limit 1 "); 
	$num_login_fire22   = $database->mysqlNumRows($sql_login_fire22);
	if($num_login_fire22){ 
           while($result_login_fire22  = $database->mysqlFetchArray($sql_login_fire22)) 
           { 
               
        $date= date('Y-m-d H:i:s');   $mode="CS";  
        
        $insertion['lob_billno']=  mysqli_real_escape_string($database->DatabaseLink,trim($settlement_details->settlement_bill));
          
        $insertion['lob_point_add']= mysqli_real_escape_string($database->DatabaseLink,trim(0));
      
        $insertion['lob_point_redeem']= mysqli_real_escape_string($database->DatabaseLink,trim(0));
       
        $insertion['lob_redeem_amount']= mysqli_real_escape_string($database->DatabaseLink,trim(0));
        
        $insertion['lob_bill_amount']= mysqli_real_escape_string($database->DatabaseLink,trim($settlement_details->bill_final_amount_new));
      
        $insertion['lob_date']= mysqli_real_escape_string($database->DatabaseLink,trim($date));
       
        $insertion['lob_loyalty_customer']= mysqli_real_escape_string($database->DatabaseLink,trim($result_login_fire22['ly_id']));
     
        $insertion['lob_mode']= mysqli_real_escape_string($database->DatabaseLink,trim($mode));
      
      $sql=$database->check_duplicate_entry('tbl_loyalty_pointadd_bill',$insertion);
      if($sql!=1)
	{
	$insertid              			=  $database->insert('tbl_loyalty_pointadd_bill',$insertion);
        } 
           
             
         }
        }
                 
      }
  }   
        
        
        
        
    if($_REQUEST['sms_bill_settle']=='Y' ){     
          
     $customer='';  $number='';    
     $loy_qry1 = $database->mysqlQuery("select lr.ly_firstname,lr.ly_mobileno from tbl_loyalty_pointadd_bill lb"
     . " left join tbl_loyalty_reg lr on lr.ly_id=lb.lob_loyalty_customer where lb.lob_billno='".$settlement_details->settlement_bill."'");
   
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

   $conv=$settlement_details->settlement_bill.','.$_SESSION['firebase_id'];
    
    $conv1 = base64_encode( openssl_encrypt( $conv, $encrypt_method, $key, 0, $iv ) );
   ////encode_end////
     
         
    //  $message= " * Here is your ebill of Rs.".$settlement_details->bill_final_amount_new."."
          //    . "Click: https://ebill.expodine.com/ebill.php?b_id=$conv1 ";
       
       $var2= "http://expodinereports.com/ebill/ebill.php?b_id=$conv1";    
      
      //  $message= $customer."*".$_SESSION['s_branchname'];
      
        $message= $customer."*".$var2; 
             
       if($number !=''){
           
          $var1=$_SESSION['s_branchname'];      
       // $print=$database->dynamic_sms_api($number,$message);
        
       if($_SESSION['ebill_link']=='Y'){    
          
      $data = file_get_contents("https://bhashsms.com/api/sendmsg.php?user=ExploreITBW&pass=123456&sender=BUZWAP&phone=$number"
     . "&text=bill_new2&priority=wa&"
     . "stype=normal&Params=$var1,$var2");
           
      }else{
             
     $data = file_get_contents("https://bhashsms.com/api/sendmsg.php?user=ExploreITBW&pass=123456&sender=BUZWAP&phone=$number"
     . "&text=bill_thankyou123&priority=wa&"
     . "stype=normal&Params=$var1"); 
     
     }
      
      
           
       }
        
     }
        
        
        
     if($_SESSION['cloud_enable_sync']=='Y' && $_SESSION['firebase_on']=='Y' && ( ($settlement_details->credit_settle == "Y" && $firebase_report_status_credit=='Y') || ($settlement_details->compliemntary_settle=='Y' && $firebase_report_status_comp=='Y') )){
         
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
            $title1=''; $data_body='';
          if($settlement_details->credit_settle == "Y" ){
              
              $title1=$_SESSION['s_branchname']." : CREDIT BILL ";
              
              $data_body=" CREDIT BILL \nBill No:  $settlement_details->settlement_bill  \nDate:$date_nw_nw \nCredit Amount :$settlement_details->credit_amount  \nAuthorization Staff:$staff_pay1 \nBill Amount : $settlement_details->bill_final_amount_new  ";
              
          }else if($settlement_details->compliemntary_settle == "Y" ){   
               $title1=$_SESSION['s_branchname']." :  COMPLIMENTARY BILL ";
             $data_body=" COMPLIMENTARY BILL \nBill No:  $settlement_details->settlement_bill  \nDate:$date_nw_nw \nAuthorization Staff:$staff_pay1 \nBill Amount : $settlement_details->bill_final_amount_new  ";
          }
            
    ///pushing msg///
    $branch_id_fire=$_SESSION['firebase_id'];
    
    require 'vendor/autoload.php';
    
    $client = new Client();
    $client->setAuthConfig('service_google.json'); // Replace with your file path
    $client->addScope('https://www.googleapis.com/auth/firebase.messaging');
    $accessToken = $client->fetchAccessTokenWithAssertion()['access_token'];

   $url = "https://fcm.googleapis.com/v1/projects/ed-reports-b5f94/messages:send";
   $body = $data_body;
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
   // echo $response;
    
    
//    $url = "https://fcm.googleapis.com/fcm/send";
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
    //var_dump($result);
      }
        }
        
        
        
        
        
    }
    catch (Exception $e) {
            $returnmsg= 'Caught exception: '.  $e;
            $file = 'log.txt';
            $content = date("l F d-m-Y h:i:s A")." ".$returnmsg.PHP_EOL;
            file_put_contents($file, $content, FILE_APPEND | LOCK_EX);
            echo $returnmsg; exit();
    }
}
else if(isset($_REQUEST['action']) && $_REQUEST['action']=="loadcreditypes") 
{
	$credittype=$_REQUEST['credittype'];
	$xmltype='';
	$pref='';
	
                    
        if($credittype=='2' || $credittype=='1'){ ?>
                <span class="room_no_txt labelname"></span>
                <span class="room_text_box_cc">
              <select  class="staff_menu_select" name="selectcreditdetails" id="selectcreditdetails">
               <option value=""><?=$_SESSION['payment_pending_select_roomname']?></option>
				<?php
                    //`tbl_credit_details`(`cd_id`, `cd_typeid`, `cd_name`, `cd_active`)
					if($credittype=="1")
					{$xmltype='roommaster';$pref="rm_";
                                            
                                        $curl = curl_init();
                                                curl_setopt_array($curl, array(
                                                CURLOPT_URL => $_SESSION['be_expolitelink']."/occupiedrooms",
                                                CURLOPT_RETURNTRANSFER => true,
                                                CURLOPT_ENCODING => "",
                                                CURLOPT_MAXREDIRS => 10,
                                                CURLOPT_TIMEOUT => 30,
                                                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                                                CURLOPT_CUSTOMREQUEST => "GET",
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
                                                $result=json_decode($response,true);
                                            }
                                            $room_numbers=implode(',',$result['data']);
                                            //echo $room_numbers;
                                            $sql_roomnumber  =  $database->mysqlQuery("update tbl_credit_master cm,tbl_roommaster rm  set cm.crd_active ='N'  where rm.rm_roomid=cm.crd_roomid   and cm.crd_type='1' ");
                                            //echo "update tbl_credit_master cm,tbl_roommaster rm  set cm.crd_active ='N'  where rm.rm_roomid=cm.crd_roomid   and cm.crd_type='1' ";
                                            $sql_roomnumber1  =  $database->mysqlQuery("update tbl_credit_master cm,tbl_roommaster rm  set cm.crd_active ='Y'  where rm.rm_roomid=cm.crd_roomid  and rm.rm_roomno  IN ($room_numbers) and cm.crd_type='1' ");
                                            //echo "update tbl_credit_master cm,tbl_roommaster rm  set cm.crd_active ='Y'  where rm.rm_roomid=cm.crd_roomid  and rm.rm_roomno  IN ($room_numbers) and cm.crd_type='1' ";
                                            $sql_ds_nos="select cm.crd_id as id,rm.rm_roomno as names,rm.rm_roomid as main_id from tbl_credit_master as cm LEFT JOIN tbl_roommaster as rm ON cm.crd_roomid=rm.rm_roomid where cm.crd_type='".$credittype."' AND cm.crd_branchid='".$_SESSION['branchofid']."' AND cm.crd_active='Y' AND rm.rm_status='Y' ORDER BY rm_roomid ASC ";
                                            //echo "select cm.crd_id as id,rm.rm_roomno as names,rm.rm_roomid as main_id from tbl_credit_master as cm LEFT JOIN tbl_roommaster as rm ON cm.crd_roomid=rm.rm_roomid where cm.crd_type='".$credittype."' AND cm.crd_branchid='".$_SESSION['branchofid']."' AND cm.crd_active='Y' AND rm.rm_status='Y' ORDER BY cm.crd_id DESC";
                                             
                                            }else if($credittype=="2")
					{$xmltype='staffmaster_first';
                 $sql_ds_nos="select cm.crd_id as id,sm.ser_firstname as names,sm.ser_staffid as main_id from tbl_credit_master as cm  LEFT JOIN tbl_staffmaster as sm ON cm.crd_staffid=sm.ser_staffid where cm.crd_type='".$credittype."' AND cm.crd_branchid='".$_SESSION['branchofid']."' AND cm.crd_active='Y' AND  sm.ser_employeestatus='Active' ORDER BY cm.crd_id  DESC";
					}
//                                        else if($credittype=="3")
//					{$xmltype='corporate';
//                 $sql_ds_nos="select cm.crd_id as id,cp.ct_corporatename as names,cp.ct_corporatecode as main_id  from tbl_credit_master as cm  LEFT JOIN tbl_corporatemaster as cp ON cm.crd_corporateid=cp.ct_corporatecode where cm.crd_type='".$credittype."' AND cm.crd_branchid='".$_SESSION['branchofid']."' AND cm.crd_active='Y' ORDER BY cm.crd_id  DESC";
//					}
                $sql_ds  =  $database->mysqlQuery($sql_ds_nos); 
                $num_ds = $database->mysqlNumRows($sql_ds);
                if($num_ds){ 
                 while($result_ds = $database->mysqlFetchArray($sql_ds)) 
                        {//$result_ds['names']
                            if($credittype=="2"){
//                                if($credittype=="2"){
//                                    $staffid=trim(json_encode($result_ds['main_id']),'""');
//                                    $fpstaff=fopen($apilink."/src/main_menu_display.php?set=staff_ordertake&staffid=$staffid&dat=$other_lang","r");
//                                    $response_staff['messages'] = stream_get_contents($fpstaff);
//                                    //var_dump($response_staff['messages']);
//                                    $resu_staff= json_decode($response_staff['messages'],true);
//                                    //var_dump($resu_staff['staff_id'][0]);
//                                    $staff_count=count($resu_staff['staff_id']);
//                                    //echo $saff_count;
                                   
                                                        
                  ?>    
            
             <option value="<?=$result_ds['id']?>" ><?php echo $result_ds['names']; ?></option>
            
                 
             <?php } else { ?>
             <option value="<?=$result_ds['id']?>" ><?php echo $result_ds['names']; ?></option>?>
                <?php }}}  ?>                            
              </select>
              </span>
          <?php }
          else if($credittype=="3" ||$credittype=="4") {?>  
                
                
                   
                   
                    
                     <?php if($credittype=="4"){?>
                
                 <span style="width: 40%;" class="room_no_txt labelname">Name</span>
                    <span class="room_text_box_cc" style="">
                        
                        <input type="text" Placeholder="Enter Name"  class="staff_menu_select" name="selectcreditdetailsname" id="selectcreditdetailsname" onclick=" return name_search_click();"  onchange=" return name_search(this.value)" onkeyup=" return name_search(this.value)"  onkeydown="return suggession_select(event)"autocomplete="off">
                        <div id="suggession_name" style="display: none "></div>
                    
                    </span>
                    <?php } ?>
                    
                    
                    
                     <?php if($credittype=="3"){?>
                     <span style="width: 40%" class="room_no_txt labelname"></span>
                      <span class="room_text_box_cc">
                    <select name="selectcreditdetailsname" id="selectcreditdetailsname"  class="staff_menu_select">
                        <?php
                        $sql_login  =  $database->mysqlQuery("select ct.ct_corporatename from tbl_corporatemaster ct left join tbl_credit_master cm on cm.crd_corporateid=ct.ct_corporatecode  where ct.ct_status='Y' and cm.crd_active='Y' "); 
	            $num_login   = $database->mysqlNumRows($sql_login);
	 
	           if($num_login){
		  while($result_login  = $database->mysqlFetchArray($sql_login)) 
			{
                        ?>
                        <option value="<?=$result_login['ct_corporatename']?>"><?=$result_login['ct_corporatename']?></option>
                        <?php }}?>
                    </select>
                         <?php } ?>
                    
                    </span>
                    
                    
                    <?php if($credittype=="4"){?>
                
                     <span class="room_no_txt labelname1" style="font-size: 12px">Number-Name-Id</span>
                    <span class="room_text_box_cc">
                        <input type="text" Placeholder="Enter Number Or Name Or Id"  class="staff_menu_select" name="selectcreditdetailsnumber" onkeypress="return numdot7(event);" id="selectcreditdetailsnumber"  onclick=" return number_search(this.value)" onchange=" return number_search(this.value)" onkeyup=" return number_search(this.value)" maxlength="12" autocomplete="off">
                   <div id="suggession_number"></div>
                    </span>
                    
          
          <?php } }?>
          <?php if(isset($_REQUEST['setamt12'])&&($_REQUEST['setamt']=="amt")){ 
              echo $_REQUEST['totalamt']; 
              
          } ?>
          
            <span class="room_no_txt "><?=$_SESSION['payment_pending_creditamount']?></span>
            <span class="room_text_box_cc">
                
                <input   placeholder="Enter Credit Amount" class="tax_textbox transa_txt " id="amount_credit" name="amount_credit" value=" "  readonly="readonly">
                <?php if($_SESSION['s_default_company']	=='Z'){ ?>
                <strong id="check_del_div" style="margin-left: 5px;margin-top: 5px;float:right; color: darkred;display:block;border: solid 1px;border-radius: 3px"> &nbsp; ONLINE ORDER &nbsp; </strong>
                <?php } ?> 
            </span>
            
           
              
         
   
    <?php
}
else if(isset($_REQUEST['action']) && $_REQUEST['action']=="last_card_insert"){
    
     
          
    $card_details=json_decode($_REQUEST['card_details']);
    
     if($card_details->last_adding_card_amount>0){
    
    
    if(isset($_REQUEST['add_multicard'])){
        $insertion['mc_billno']   = mysqli_real_escape_string($database->DatabaseLink,trim("temp_".$card_details->settlement_bill));
    }else{
        $insertion['mc_billno']   = mysqli_real_escape_string($database->DatabaseLink,trim($card_details->settlement_bill));
    }
    
    if($card_details->last_adding_card_type!=''){
        $insertion['mc_cardtype']   = mysqli_real_escape_string($database->DatabaseLink,trim($card_details->last_adding_card_type));
    }
    
    $insertion['mc_cardamount'] = mysqli_real_escape_string($database->DatabaseLink,trim($card_details->last_adding_card_amount));
    
    if($card_details->last_adding_card_type!=''){
        $insertion['mc_carnumber']  = mysqli_real_escape_string($database->DatabaseLink,trim($card_details->last_adding_card_number));
    }
    
      if($card_details->last_adding_bank_type!=''){
               $insertion['mc_to_bank']= mysqli_real_escape_string($database->DatabaseLink,trim($card_details->last_adding_bank_type));
       }else{
               $insertion['mc_to_bank']= mysqli_real_escape_string($database->DatabaseLink,trim($card_details->bankdefault));  
      }
    
     $sql=$database->check_duplicate_entry('tbl_bill_card_payments',$insertion);
     if($sql!=1)
     {
                
        $insertid  =  $database->insert('tbl_bill_card_payments',$insertion); 
             
  
    
   $card_array=array();
   $card_array1=array();
   
   if(isset($_REQUEST['add_multicard'])){
       
   $sql_card = mysqli_query($localhost,"SELECT bm_name,mc_to_bank,`mc_billno`,`mc_slno`, `mc_cardtype`,`mc_cardamount`,`mc_carnumber`,cm.crd_name FROM "
   . " `tbl_bill_card_payments` left join tbl_cardmaster cm on cm.crd_id=mc_cardtype left join tbl_bankmaster bm on bm.bm_id=mc_to_bank "
   . "  WHERE `mc_billno`='temp_".$card_details->settlement_bill."' order by mc_slno desc LIMIT 0,1 ");
        $num_card = mysqli_num_rows($sql_card);
        if ($num_card) {$i=0;
            while ($result_card =mysqli_fetch_array($sql_card)) {
                
                $card_array1['SLNO']=$result_card['mc_slno'];
                $card_array1['CARD_TYPE']=$result_card['crd_name'];
                $card_array1['CARD_NUMBER']=$result_card['mc_carnumber'];
                $card_array1['CARD_AMOUNT']=$result_card['mc_cardamount'];
                $card_array1['BANK_TYPE']=$result_card['bm_name'];
                $card_array['DETAILS'][]=$card_array1;
            }
        }
        
        $sql_card_sum = mysqli_query($localhost,"SELECT sum(`mc_cardamount`) as sum FROM `tbl_bill_card_payments`  WHERE `mc_billno`='temp_".$card_details->settlement_bill."' ");
        $num_card_sum = mysqli_num_rows($sql_card_sum);
        if ($num_card_sum) { $i=0;
            while ($result_card_sum =mysqli_fetch_array($sql_card_sum)) {
                
                $card_array['CARD_SUM']=$result_card_sum['sum'];
            }
        }
        
        echo json_encode($card_array);
        
   }
   } 
   
}
}

if(isset($_REQUEST['action']) && $_REQUEST['action']=='load_added_cards'){
    
    $card_array=array();
    $card_array1=array();
    $card_sum=0;
    $sql_card = mysqli_query($localhost,"SELECT bm_name,mc_to_bank,`mc_billno`, `mc_slno`, `mc_cardtype`, `mc_cardamount`, `mc_carnumber`, cm.crd_name FROM"
            . " `tbl_bill_card_payments` left join tbl_cardmaster cm on cm.crd_id=mc_cardtype left join tbl_bankmaster bm on bm.bm_id=mc_to_bank WHERE `mc_billno`='".$_REQUEST['billno']."' "
            . " order by mc_slno desc  ");
    $num_card = mysqli_num_rows($sql_card);
    if ($num_card) {$i=0;
        while ($result_card =mysqli_fetch_array($sql_card)) {
            
            $card_sum=$card_sum+$result_card['mc_cardamount'];
            $card_array1['SLNO']=$result_card['mc_slno'];
            $card_array1['CARD_TYPE']=$result_card['crd_name'];
            $card_array1['CARD_NUMBER']=$result_card['mc_carnumber'];
            $card_array1['CARD_AMOUNT']=$result_card['mc_cardamount'];
            $card_array1['BANK_TYPE']=$result_card['bm_name'];
            $card_array['DETAILS'][]=$card_array1;
        }
        
        $card_array['CARD_SUM']=$card_sum;
    }
    
    echo json_encode($card_array);
    
}
if(isset($_REQUEST['action']) && $_REQUEST['action']=='card_delete'){
    
    $card_array=array();
    $sql_carddelete = mysqli_query($localhost,"DELETE FROM `tbl_bill_card_payments` WHERE `mc_billno`='".$_REQUEST['billno']."' and `mc_slno`='".$_REQUEST['card_slno']."'  ");
    $sql_card_sum = mysqli_query($localhost,"SELECT sum(`mc_cardamount`) as sum FROM `tbl_bill_card_payments`  WHERE `mc_billno`='".$_REQUEST['billno']."' ");
    $num_card_sum = mysqli_num_rows($sql_card_sum);
    if ($num_card_sum) {$i=0;
        while ($result_card_sum =mysqli_fetch_array($sql_card_sum)) {
            
            $card_array['CARD_SUM']=$result_card_sum['sum'];
            
        }
    }
    
    echo json_encode($card_array);
}
if(isset($_REQUEST['action']) && $_REQUEST['action']=='currency_conversion_rate'){
    
    $selected_currency=$_REQUEST['selected_currency'];
    $currency_rate=0;
    $sql_currency_rate = mysqli_query($localhost,"select ccr.cc_conversion_rate FROM tbl_currency_conv_rate ccr where ccr.cc_base_currency='".$_SESSION['base_currency_id']."' and ccr.cc_currency='".$selected_currency."'");
    $num_currency_rate = mysqli_num_rows($sql_currency_rate);
    if ($num_currency_rate) { $i=0;
    
        $row_currency_rate  = $database->mysqlFetchArray($sql_currency_rate);
        $currency_rate=$row_currency_rate['cc_conversion_rate'];
    }
    
    echo $currency_rate;
}

?>

