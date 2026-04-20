<?php
include('includes/session.php');		// Check session
//session_start();
include("database.class.php"); // DB Connection class
$database	= new Database(); 		// Create a new instance
//require_once("includes/title_settings.php");
include('includes/master_settings.php');
//include('includes/menu_settings.php');
include("api_multiplelanguage_link.php");
use Google\Client;
$other_lang=  trim(json_encode($_SESSION['main_language']),'""');
$opendate=  trim(json_encode($_SESSION['date']),'""');
$listimage=  trim(json_encode($_SESSION['s_listimage']),'""');
//echo $listimage ;
$floorid= "";
if($_REQUEST['set']=='loadtablehead')
 {
	 ?>
     <!--<script type="text/javascript" src="js/bill_paymentscreen_sort.js"></script>
      <script>
 var len = $('script[src="js/bill_paymentscreen_sort.js"]').length;
 if (len === 0) {
    $.getScript('js/bill_paymentscreen_sort.js');
}
</script>-->
     <table class="billgenration_new_table" width="100%" border="0">
        <thead>
                <tr>
               <!-- <th width="10%" class="sortbybill" style="cursor:pointer">Bill No</th>
                <th width="20%">Table No</th>
                <?php //if($_SESSION['floorid']=='all'){?> <th width="20%">Floor</th> <?php //} ?>
                <th width="25%">Time</th>
                <th width="15%">Amount</th>-->
                
                 <th width="20%" class="sortbybill" style="cursor:pointer"><?=$_SESSION['payment_pending_billno']?></th>
               <!-- <th width="20%"><?$_SESSION['payment_pending_tableno']?></th>-->
<?php if ($_SESSION['typeoofpayemnt'] == 'ALL') { ?> <th width="10%"><?=$_SESSION['completed_order_mode_select']?></th> <?php } ?>
                <th width="25%"><?=$_SESSION['payment_pending_time']?></th>
                <th width="15%"><?=$_SESSION['payment_pending_table_amount']?></th>

                
              </tr>
        </thead>
       </table>
     <?php
 }else if(isset($_REQUEST['set'])&& $_REQUEST['set']=='loadta_billdetails')
 { 
?>

<div style="height: 383px;overflow: auto;">   
    
    <?php
   $_SESSION['typeoofpayemnt']=$_REQUEST['modeval'];
	  
 ?>
 
 <script type="text/javascript" src="js/payments_ta_cs_select.js"></script> 
 <script type="text/javascript" src="js/payments_takeaway.js"></script> 
                  
 <?php
 
                    $staff='';
                    
                    if($_SESSION['ser_all_shift_closer']=='N'){
                    if($_SESSION['shift_permission']=='Y'){
                    $sql_desg_nos13="select sd_open_staff from tbl_shift_details where sd_day='".$_SESSION['date']."' and sd_open_staff='".$_SESSION['login_dayopen_staffid']."' and sd_close IS NULL";
                        $sql_desg13  =  $database->mysqlQuery($sql_desg_nos13);
			$num_desg13  = $database->mysqlNumRows($sql_desg13);
			if($num_desg13){
			  $staff=" and tb.tab_loginid='".$_SESSION['expodine_id']."'  ";
                        }else{
                            $staff='';
                        }
                       }
                    }
 $ct=1;
	if (isset($_SESSION['typeoofpayemnt'])) {
      
	if ($_SESSION['typeoofpayemnt'] == "ALL") {
        $sql_table_sel_query= "Select distinct(tb.tab_billno),tb.tab_loy_id,tb.tbl_takeaway_printed,tb.tab_time,tb.tab_bill_print,tb.tab_bill_ref,"
                . " tb.tab_hdcustomerid ,ts.tac_customername,ts.tac_contactno,tb.tab_status,tb.tab_kotno, tb.tab_mode,tb.tab_netamt,tb.tab_total,"
                . " tb.tab_subtotal_final,ts.tac_contactno,tb.tab_food_partner From tbl_takeaway_billmaster as tb LEFT JOIN tbl_takeaway_customer"
                . " ts ON ts.tac_customerid=tb.tab_hdcustomerid Where tb.tab_dayclosedate ='".$_SESSION['date']."' and tb.tab_status != 'Cancelled'"
                . "  And ((tb.tab_mode='HD' AND tb.tab_payment_settled = 'N')  OR (tb.tab_mode='TA' AND tb.tab_payment_settled = 'N' And "
                . " tb.tab_kotno != '')) and tb.tab_status != 'Cancelled' AND tb.tab_billno  NOT LIKE 'TEMP%' $staff order by "
                . " tb.tab_date,tb.tab_time DESC limit 250";
 
       } else {
           
       if($_SESSION['typeoofpayemnt']=="TA")
	   {
           
       $sql_table_sel_query= "Select distinct(tb.tab_billno),tb.tab_loy_id,tb.tbl_takeaway_printed,tb.tab_time,tb.tab_bill_print,tb.tab_bill_ref,"
               . " tb.tab_hdcustomerid ,ts.tac_customername,ts.tac_contactno,tb.tab_status,tb.tab_kotno, tb.tab_mode,tb.tab_netamt,tb.tab_total,"
               . " tb.tab_subtotal_final,tb.tab_food_partner From tbl_takeaway_billmaster as tb LEFT JOIN tbl_takeaway_customer ts ON "
               . " ts.tac_customerid=tb.tab_hdcustomerid Where tb.tab_dayclosedate ='".$_SESSION['date']."' And tb.tab_kotno != '' And"
               . " (tb.tab_payment_settled = 'N') And (tb.tab_mode='".$_SESSION['typeoofpayemnt']."') and tb.tab_status != 'Cancelled' AND"
               . "  tb.tab_billno  NOT LIKE 'TEMP%' $staff order by tb.tab_date,tb.tab_time DESC limit 250 ";
      
	}else if($_SESSION['typeoofpayemnt']=="HD")
	{
		$sql_table_sel_query= "Select distinct(tb.tab_billno),tb.tab_loy_id,tb.tbl_takeaway_printed,tb.tab_time,tb.tab_bill_print,"
                        . " tb.tab_bill_ref,tb.tab_hdcustomerid ,ts.tac_customername,ts.tac_contactno,tb.tab_status,tb.tab_kotno, tb.tab_mode,"
                        . " tb.tab_netamt,tb.tab_total,tb.tab_subtotal_final,tb.tab_food_partner From tbl_takeaway_billmaster as tb LEFT JOIN"
                        . " tbl_takeaway_customer ts ON ts.tac_customerid=tb.tab_hdcustomerid Where tb.tab_dayclosedate ='".$_SESSION['date']."' "
                        . "  And (tb.tab_payment_settled = 'N') And (tb.tab_mode='".$_SESSION['typeoofpayemnt']."') and tb.tab_status != 'Cancelled' "
                        . " AND tb.tab_billno  NOT LIKE 'TEMP%' $staff  order by tb.tab_date,tb.tab_time DESC limit 250";
           
	}
				
    }
    
        $partner_on='';  $count=0;
	$sql_table_sel = $database->mysqlQuery($sql_table_sel_query);
			 $num_table  = $database->mysqlNumRows($sql_table_sel);
		  if($num_table){
				while($result_table_sel  = $database->mysqlFetchArray($sql_table_sel)) 
					{
                                    $count=$ct++;
                                    
   $sql_table_sel34  = $database->mysqlQuery("SELECT tol_name from tbl_online_order  WHERE tol_id='".$result_table_sel['tab_food_partner']."' ");

  $num_table34  = $database->mysqlNumRows($sql_table_sel34);
  if($num_table34)
   {
	  while($row4 = mysqli_fetch_array($sql_table_sel34))
		{
              
               $partner_on=$row4['tol_name'];
               
          }
          }
         					
   ?>
             
 <div <?php if($result_table_sel["tab_bill_print"]=="Y"){ ?>  ondblclick="double_click_settle('<?=$result_table_sel["tab_billno"]?>')"  style="background-color:lightseagreen" total="<?=number_format($result_table_sel["tab_netamt"],$_SESSION['be_decimal'])?>"  <?php } else { ?>  style="background-color:lightgreen"   <?php  } ?>class="payment_pend_bill_cc high_class<?=$result_table_sel["tab_billno"]?>" mode="<?= $result_table_sel["tab_mode"] ?>" loy_id="<?= $result_table_sel['tab_loy_id'] ?>" total="<?=number_format($result_table_sel["tab_subtotal_final"],$_SESSION['be_decimal'])?>" bill="<?=$result_table_sel["tab_billno"]?>" status_billed="<?=$result_table_sel["tab_bill_print"]?>" id="<?=$result_table_sel["tab_billno"]?>" custid="<?=$result_table_sel["tab_hdcustomerid"]?>" ph="<?=$result_table_sel["tac_contactno"]?>">
     <div class="payment_pend_bill_no"> &nbsp; <?="[".$result_table_sel["tab_bill_ref"]."] " ?>  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  <?=$result_table_sel["tab_billno"]?>
     
         <span style="cursor:pointer;border: solid 1px;border-radius: 3px;padding: 3px;margin-left: 5px;display: none" onclick="regen_ta_cs('<?=$result_table_sel["tab_billno"]?>');"> Reg </span> &nbsp; 
        
     </div>
                  
      
     <div class="payment_pend_bill_mode_cc">
        
         <div  style="color:#000000;margin-top: 8px;text-transform: uppercase;font-size: 8.5px;font-weight: bold;border:solid 1px;border-radius: 4px;margin-right: 2px; "><?=  substr($partner_on, 0,8)?></div>
     
     </div>
     </div>
 
                              
                                
     <?php } ?>
 </div>   
            &nbsp;&nbsp;&nbsp;     <strong style="padding: 5px;padding-left: 40px;position: absolute;bottom: 2px;left: 0px;width: 100%;background-color: #a9a9a9;">BILLS : <?=$count?></strong>         
          
     <?php    }else { 
				   ?>
                   <input type="hidden" value="<?=$result_table_sel["tab_billno"]?>" id="billta" >
                   <tr>
                   <td style="color:#F00"><?=$_SESSION['credit_settlement_error_record_display']?></td>
                   </tr>
                 
	  <?php }} ?>
                 
                
                            
                           
 <?php
 }
 else if($_REQUEST['set']=='addhold'){
	
	$database->mysqlQuery("SET @billno	 	= " . "'" . mysqli_real_escape_string($database->DatabaseLink,$_SESSION['ta_order_id']) . "'");
	$database->mysqlQuery("SET @branchid 			= " . "'" . mysqli_real_escape_string($database->DatabaseLink,$_SESSION['branchofid']) . "'");
	$hold_billno='';
	$hold_message='';
	$sq=$database->mysqlQuery("CALL  proc_hold_order(@billno,@branchid,@hold_billno,@hold_message)");
	if($sq)
	{
		echo "ok";
	}
	  
        
        $bills[]=array();
        
        $sql_qry111 = $database->mysqlQuery("select tab_billno from tbl_takeaway_billmaster where tab_dayclosedate = '".$_SESSION['date']."' and tab_on_hold='Y' and (tab_mode='TA' or tab_mode='HD')  ");
        
            $num_rows111 = $database->mysqlNumRows($sql_qry111);
              if($num_rows111){
              while($result_row111 = $database->mysqlFetchArray($sql_qry111)){
                   $bills[]=$result_row111['tab_billno'];
	      
              }}
              
              for($m=1;$m<count($bills);$m++){
                  
                $sql_qry111 = $database->mysqlQuery("insert into tbl_hold_data(th_hold_id,th_date,th_mode)values('".$bills[$m]."','".$_SESSION['date']."','TA')");
                  
              }
        
         $sql_qry111 = $database->mysqlQuery("update tbl_loyalty_reg set ly_default='N' where ly_module='TA' ");     
              
              
  }
 else if ($_REQUEST['set']=="loadta_billitems"){
     ?>
                   <script type="text/javascript" src="js/payments_takeaway.js"></script> 
                  
         <?php
     $billno = $_REQUEST['billno'];
     $_SESSION['billno'] = $billno;
     $print_by='';
     $online_by='';
     
         
     
     
     
     $sql_bm = "SELECT tab_delivery_status
     FROM tbl_takeaway_billmaster
     WHERE tab_dayclosedate ='".$_SESSION['date']."' and  tab_delivery_status != 'NA' AND tab_billno = '$billno'";
     $sql_bm_sel = $database->mysqlQuery($sql_bm);
     $num_rows_bm  = $database->mysqlNumRows($sql_bm_sel);
     $btn_dsbl = '';
     $msg = '';
     if($num_rows_bm){
        
         $result_bm  = $database->mysqlFetchArray($sql_bm_sel);
         if($result_bm['tab_delivery_status']=='P'){
            $btn_dsbl = 'pay_pend_pop_qty_btn_disable';
            $msg = 'Out for Delivery';
         }elseif ($result_bm['tab_delivery_status']=='A') {
            $btn_dsbl = 'pay_pend_pop_qty_btn_disable';
            $msg = 'Already assigned';
        }
        
        $delivery_status=$result_bm['tab_delivery_status'];
     }
    ?>
            <table class="payment_pend_popup_right_tbl" width="100%" border="0">
                <thead>
                  <tr>
                    <th width="50%" scope="col">Item</th>
                    <th width="13%" scope="col">Rate</th>
                    <th scope="col">Quantity</th>
                  </tr>
                </thead> 
                <tbody>
    <?php
    $slno = 0;
    $p=0;
    $allqty=0;
    $sql_combo=" select  cbd.cbd_id, cbd.cbd_count_combo_ordering, cbd.cbd_billno, cbd.cbd_combo_id, cbd.cbd_combo_pack_id, cbd.cbd_slno, cbd.cbd_combo_qty, cbd.cbd_combo_pack_rate, cbd.cbd_combo_total_rate, cbd.cbd_menu_id, cbd.cbd_menu_qty, cbd.cbd_combo_preference, cbd.cbd_entry_date, cbd.cbd_dayclosedate, cbd.cbd_order_status, cbd.cloud_sync, 
                cbd.cbd_kot_no, cbd.cbd_cancel, cn.cn_name ,cn.cn_stock_check, cp.cp_pack_name
                FROM tbl_combo_bill_details_ta cbd
                left join tbl_combo_name cn on cn.cn_id=cbd.cbd_combo_id
                left join tbl_combo_packs cp on cp.cp_id=cbd.cbd_combo_pack_id
                where cbd.cbd_billno='".$billno."' group by cbd.cbd_count_combo_ordering order by cbd.cbd_count_combo_ordering asc";
    $sql_combo_sel = $database->mysqlQuery($sql_combo);
    $num_combo_rows  = $database->mysqlNumRows($sql_combo_sel);
    if($num_combo_rows){
        while($result_combo  = $database->mysqlFetchArray($sql_combo_sel)) 
	{$p++;
        $allqty=$allqty+$result_combo['cbd_combo_qty'];
        ?>
            <tr>
                <td><?=strtoupper($result_combo['cn_name'].' '.$result_combo['cp_pack_name'])?></td>
                <td id="amnt_<?=$result_combo['cbd_count_combo_ordering']?>"><?=number_format($result_combo['cbd_combo_total_rate'],$_SESSION['be_decimal'])?></td>
                <td>
                    
                    <?php if($delivery_status=='NA' || $delivery_status==''){ ?>
                    
                       <span class="kot_cancel_value_btn" onclick="minus_kot('<?=$result_combo['cbd_count_combo_ordering']?>','combo')" >-</span> 
                  
                     <?php } ?>
                    
                    <input type="text"  value="<?=$result_combo['cbd_combo_qty']?>"  class="payment_pending_pop_quantity_txt_box cnclqty combo_menu" id="txt_combo_<?=$result_combo['cbd_count_combo_ordering']?>" stock_check="<?=$result_combo['cn_stock_check']?>" readonly>   
                    
                    <?php if($delivery_status=='NA' || $delivery_status==''){ ?>
                    
                        <span style="float:right " class="kot_cancel_value_btn" onclick="plus_kot(<?=$result_combo['cbd_count_combo_ordering'].','.$result_combo['cbd_combo_qty']?>,'combo')">+</span>  
                  
                    <?php } ?>
                        
                        
                </td>
            </tr> 
        <?php          
        }
    }    
      
    $sql="Select tbd.tab_bill_addon_slno,tbm.tab_netamt,tbd.tab_qty,tbd.tab_preferencetext,tbd.tab_slno,mm.mr_menuid,mm.mr_menuname,tbd.tab_rate_type, tbd.tab_unit_type,tbd.tab_unit_weight,
            pm.pm_portionshortcode,  um.u_name, bum.bu_name , tbd.tab_status,tbd.tab_amount,tbd.tab_rate 
            From  tbl_takeaway_billdetails tbd 
            left Join tbl_takeaway_billmaster tbm ON tbd.tab_billno=tbm.tab_billno
            left Join tbl_menumaster mm On tbd.tab_menuid = mm.mr_menuid 
            left Join tbl_portionmaster pm On pm.pm_id =tbd.tab_portion 
            left join tbl_unit_master um  on um.u_id= tbd.tab_unit_id
            left join tbl_base_unit_master bum  on bum.bu_id =tbd.tab_base_unit_id
            Where tbm.tab_dayclosedate ='".$_SESSION['date']."' and tbd.tab_billno = '".$billno."' AND (tbm.tab_payment_settled = 'N') and tbd.tab_count_combo_ordering IS NULL and tbd.tab_status!='Cancelled' order by tab_slno ASC " ;
          
    $sql_sel = $database->mysqlQuery($sql);
    $num_rows  = $database->mysqlNumRows($sql_sel);
    ?>
                   
    <?php
    if($num_rows){
        
    	while($result  = $database->mysqlFetchArray($sql_sel)) 
	{   $p++;
            $settle_menuidta=$result['mr_menuid'];
            $settle_menuta=$result['mr_menuname'];
           
            $qty=$result['tab_qty'];
            $sl=$result['tab_slno'];
            
            if($_SESSION['main_language']!='english'){
            $sql_arabmenu=$database->mysqlQuery("SELECT lm_menu_name FROM tbl_language_menu_master left join tbl_languages on ls_id=lm_language_id WHERE lm_menu_id='".$settle_menuidta."' and ls_language='".$_SESSION['main_language']."'");
            //echo " SELECT mm_name FROM tbl_language_menu_sub left join tbl_languages on ls_id=mm_lang_id WHERE mm_sub_category_id='".$result_subcat['subid']."' and ls_language='".$dat."'";
            $num_arabmenu = $database->mysqlNumRows($sql_arabmenu);
            $result_arabmenu = $database->mysqlFetchArray($sql_arabmenu);
            $settle_menuta=$result_arabmenu['lm_menu_name'];
            // $catid['name'][] = $catname;
            //echo $catname;
            }
//            $fp_takeaway_menu=fopen($apilink."/src/takeaway_api.php?set=takeaway_menuname&menuid=$ordermenu_id&subid=&maincat=&mainlang=$other_lang&dateopen=&listimage=&floorid=","r");
//            $response_takeaway_menu['messages'] = stream_get_contents($fp_takeaway_menu);
//            //var_dump($response_takeaway_menu);
//            $resu_takeaway_menu= json_decode($response_takeaway_menu['messages'],true);
//            $takeaway_menu_count=count($resu_takeaway_menu['menuid']);
            
          $slno++;   
     ?>
                     
                  
                  <tr>
                      <td><?php if($result['tab_bill_addon_slno']!=''){ ?> <span style="color: red">(AD)</span> <?php } ?><?=$settle_menuta?> <?php if($result['tab_rate_type']=='Portion') { echo '('.$result['pm_portionshortcode'].')';} else{ if($result['tab_unit_type']=='Packet'){ echo '('. number_format($result['tab_unit_weight'],$_SESSION['be_decimal']).' '.$result['u_name'] .')';  } else if($result['tab_unit_type']=='Loose'){ echo '('. number_format($result['tab_unit_weight'],$_SESSION['be_decimal']).' '.$result['bu_name'].')'; } }?></td>
                    <td id="amnt_<?=$slno?>"><?=number_format($result['tab_amount'],$_SESSION['be_decimal'])?></td>
                    <td>
<!--                        <div class="payment_pending_pop_quantity_btn <?//=$btn_dsbl?>" id="minus_<?//=$slno?>"onclick="chg_item_cnt_dcr(<?//=$slno?>)" style="display:none">-</div>-->
                        
                        
                        <?php if($delivery_status=='NA' || $delivery_status==''){ ?>
                        <span class="kot_cancel_value_btn" onclick="minus_kot('<?=$sl?>','')" >-</span> 
                        <?php } ?>
                        
                        <input type="text"  value="<?=$result['tab_qty']?>"  class="payment_pending_pop_quantity_txt_box cnclqty" id="txt_<?=$sl?>" readonly>   
                       
       <?php if($delivery_status=='NA' || $delivery_status==''){ ?>
                        <span style="float:right " class="kot_cancel_value_btn" onclick="plus_kot(<?=$sl.','.$qty?>,'')">+</span>  
                          <?php } ?> 
<!--                     


<div style="float:right;display:none" class="payment_pending_pop_quantity_btn <?//=$btn_dsbl?>" id="plus_<?//=$slno?>" onclick="chg_item_cnt_inc(<?//=$slno?>)">+</div>-->
                  </td>
                  </tr>
                  <input type="hidden"  value="<?=$result['tab_qty']?>" id="hdn_qty_item_<?=$slno?>" >
                  <input type="hidden"  value="<?=$result['tab_amount']?>" id="hdn_amnt_item_<?=$slno?>" >
                    
                   
     <?php
     
     
      $slall.=$sl.",";
      $allqty = $allqty + $qty;
      
        }
        
      
        
        
        $sql_table_sel3  = $database->mysqlQuery("SELECT tab_kotno,tab_bill_print,tab_loginid,tol_name from tbl_takeaway_billmaster tb left join tbl_online_order to1 on to1.tol_id=tb.tab_food_partner  WHERE tab_billno='$billno' ");

      $num_table3  = $database->mysqlNumRows($sql_table_sel3);
      if($num_table3)
      {
	  while($row = mysqli_fetch_array($sql_table_sel3))
		{
              
               $billprint_status=$row['tab_bill_print'];
                $print_by=  substr($row['tab_loginid'],0,5);
                $online_by=$row['tol_name'];
                $kot=$row['tab_kotno'];
                
          }
          }
     
     $del_boy_new='';
     $sql_table_sel34  = $database->mysqlQuery("SELECT to1.ser_firstname from tbl_takeaway_billmaster tb left join tbl_staffmaster to1 on to1.ser_staffid=tb.tab_assignedto  WHERE tab_billno='$billno' ");

  $num_table34  = $database->mysqlNumRows($sql_table_sel34);
  if($num_table34)
   {
	  while($row4 = mysqli_fetch_array($sql_table_sel34))
		{
              
               $del_boy_new=$row4['ser_firstname'];
               
          }
          }
        
        
        ?>
                 
                                    
                  
                  
                  <input type="hidden"  value="<?=$slno?>" id="hdn_cnt_item">
                  
                  </tbody>
                  <script>
                      var msg = $('#order_msg').val();
                        $("#msg").text(msg);
                        $('#printed_by_ta').text('PRINT : <?=$print_by?> | <?=$kot?>');
                        $('#online_by_ta').text('<?=$online_by?>');
                         $('#del_boy_new').text('<?=$del_boy_new?>');
                        
                  </script>
                      <?php
        }?>
                  <input type="hidden" id="hiddenslno" value="<?=$slall?>" > 
                    <input type="hidden" id="totqty" value="<?=$allqty?>"/>
                     <input type="hidden"  value="<?=$billprint_status?>" id="billprintstatus">
                     <input type="hidden"  value="<?=$msg?>" id="order_msg">
        <?php
        if($p==0){?>
                   
                  
           <thead>
               <tr>
                 <td  colspan="3"></td>
               </tr>
                  <tr>
                      <th  scope="col" colspan="3">SELECT ANY BILL</th>
                    
                  </tr>
                  </thead>  
                
        <?php }?>
                  </table>     
                  <?php
        
        }
else if($_REQUEST['set']=="loadta_chgmode") {
     require_once("printer_functions.php");
        $printpage=new PrinterCommonSettings();
    $billno = $_REQUEST["billno"];
    $mode = $_REQUEST["mode"];
    $custid = $_REQUEST["custid"];
    
    $name = $_REQUEST["name"];
    $mobile = $_REQUEST["mobile"];
    $address = $_REQUEST["address"];
    $orderaddress = $_REQUEST["orderaddress"];
    $landmark = $_REQUEST["landmark"];
    $area = $_REQUEST["area"];
    $remarks = $_REQUEST["remarks"];
    $branchid = $_SESSION['branchofid'];
    $gst= $_REQUEST["gst"];
    
    if($mode=="HD"){
       
        $sql = "select * from tbl_takeaway_customer where tac_customerid = '$custid'";
        $sql_result = $database->mysqlQuery($sql);
        $num_rows  = $database->mysqlNumRows($sql_result);
        if($num_rows<1){
            $sql = "insert into tbl_takeaway_customer ( tac_customerid,tac_customername,tac_contactno,tac_address,tac_landmark,tac_area,tac_remarks,tac_per_address,tac_branchid,tac_entrydate,tac_gst )
            values ('$custid','$name','$mobile','$orderaddress','$landmark','$area','$remarks','$address','$branchid',NOW(),'$gst')";
            $sql_result = $database->mysqlQuery($sql);
            
        }else{
            
            $database->mysqlQuery("UPDATE tbl_takeaway_customer set tac_customername = '$name', tac_address = '$orderaddress', tac_landmark = '$landmark', tac_area = '$area', tac_remarks = '$remarks', tac_per_address = '$address',tac_gst='$gst' where  tac_customerid = '$custid'");
        }
       
        
        
       $database->mysqlQuery("update tbl_takeaway_billmaster set tab_mode = '$mode',tab_name='$name',tab_phone='$mobile',tab_gst='$gst', tab_delivery_status = 'NA', tab_hdcustomerid = '$custid' where tab_billno = '$billno'");
        
        $database->mysqlQuery("UPDATE tbl_takeaway_billmaster b, tbl_branch_settings_ta_hd t SET b.tab_delivery_charge = t.bsth_delivery_charge , b.tab_netamt = b.tab_netamt + t.bsth_delivery_charge where b.tab_billno = '$billno'");
     
      //  echo "UPDATE tbl_takeaway_billmaster b, tbl_branch_settings_ta_hd t SET b.tab_delivery_charge = t.bsth_delivery_charge , b.tab_netamt = b.tab_netamt + t.bsth_delivery_charge where b.tab_billno = '$billno'";
       
        $sql = "select tab_bill_print from tbl_takeaway_billmaster where  tab_billno = '$billno'";
        $sql_result = $database->mysqlQuery($sql);
        $num_rows  = $database->mysqlNumRows($sql_result);
        if($num_rows){
            while($result  = $database->mysqlFetchArray($sql_result)) {
                
       $bill_printed_chk=$result['tab_bill_print'];
            }
        }
        
        if($bill_printed_chk=='Y' && $_SESSION['s_printst']=='Y'){
        $printpage->print_bill_ta($billno,$mode,$_SESSION['branchofid'],"web",$_SESSION['billip'],$_SESSION['hosttype'],$rp='Y');
        
        }
    }else{
        
     $database->mysqlQuery("update tbl_takeaway_billmaster set tab_mode = '$mode',tab_name='$name',tab_phone='$mobile',tab_gst='$gst' where tab_billno = '$billno'");
        
         $database->mysqlQuery("UPDATE tbl_takeaway_billmaster b, tbl_branch_settings_ta_hd t SET b.tab_delivery_charge = 0 , b.tab_netamt = b.tab_netamt - t.bsth_delivery_charge where b.tab_billno = '$billno'");
       // echo "UPDATE tbl_takeaway_billmaster b, tbl_branch_settings_ta_hd t SET b.tab_delivery_charge = 0 , b.tab_netamt = b.tab_netamt - t.bsth_delivery_charge where b.tab_billno = '$billno'";
      
         $sql = "select tab_bill_print from tbl_takeaway_billmaster where  tab_billno = '$billno'";
        $sql_result = $database->mysqlQuery($sql);
        $num_rows  = $database->mysqlNumRows($sql_result);
        if($num_rows){
            while($result  = $database->mysqlFetchArray($sql_result)) {
                
       $bill_printed_chk=$result['tab_bill_print'];
            }
        }
        
        if($bill_printed_chk=='Y' && $_SESSION['s_printst']=='Y'){
        $printpage->print_bill_ta($billno,$mode,$_SESSION['branchofid'],"web",$_SESSION['billip'],$_SESSION['hosttype'],$rp='Y');
        
        }
    }
    
    $sql_result = $database->mysqlQuery($sql);
    $database->mysqlQuery("update  tbl_branchmaster set be_takeawaycustcount = be_takeawaycustcount+1 where be_branchid = '".$_SESSION['branchofid']."'");
    
   

    if($sql_result = $database->mysqlQuery($sql)){
        echo "ok";
    }
    
       $cst_new_id='';
           $sql = "select tac_customerid from tbl_takeaway_customer where trim(tac_contactno) = '$mobile'";
        $sql_result = $database->mysqlQuery($sql);
        $num_rows  = $database->mysqlNumRows($sql_result);
        if($num_rows){ 
         while($result  = $database->mysqlFetchArray($sql_result)){
             $cst_new_id=$result['tac_customerid'];
         }
             
        }
           
      $database->mysqlQuery("update tbl_takeaway_billmaster set tab_hdcustomerid='$cst_new_id' where tab_billno = '$billno'");      
            
            
}
else if($_REQUEST['set']=="getadrs") {
    $cusid= $_REQUEST['cusid'];
    if($cusid!=""){
    $sql ="select  tac_contactno, tac_customerid, tac_customername,tac_per_address, tac_address, tac_landmark, tac_area, tac_remarks  
    from tbl_takeaway_customer
    where tac_customerid = '$cusid'";
    $sql_sel = $database->mysqlQuery($sql);
    $num_rows  = $database->mysqlNumRows($sql_sel);
    if($num_rows){
        $result  = $database->mysqlFetchArray($sql_sel);
        echo $result[0].','.$result[1].','.$result[2].','.$result[3].','.$result[4].','.$result[5].','.$result[6].','.$result[7];
    }
    }else{
        $sql = "select be_branchprefix, be_takeawaycustcount from tbl_branchmaster 
        where be_branchid = ".$_SESSION['branchofid'];
        $sql_sel = $database->mysqlQuery($sql);
        $num_rows  = $database->mysqlNumRows($sql_sel);
        if($num_rows){
            $result  = $database->mysqlFetchArray($sql_sel);
            $cnt = $result[1]+1;
            $newid = $result[0]."#C".$cnt;
            echo ",$newid,,,,,,";
        }
    }
    
}else if($_REQUEST['set']=="menusubmission_pending_pay") 
{
    
     $billno = $_REQUEST['billno'];
     $_SESSION['billno'] = $billno;
     $_SESSION['cancel_billno'] = $billno;
     $_SESSION['printkotbillno'] = $billno;
     $slno = 0;
     $flag = 0;
     
     $qty = $_REQUEST['qty'];
     $quantity = explode(',',$qty);
     $sql="SELECT tb.tab_preferencetext,tb.tab_menuid, tb.tab_portion, tb.tab_qty, tb.tab_rate, tbm.tab_status,tbm.tab_mode, tbm.tab_total, tbm.tab_hdcustomerid, tbm.tab_kotno  
        FROM tbl_takeaway_billmaster tbm
        INNER JOIN tbl_takeaway_billdetails tb ON tbm.tab_billno = tb.tab_billno
        WHERE tb.tab_billno = '$billno'
        ORDER BY tb.tab_menuid ASC" ;
    $sql_sel = $database->mysqlQuery($sql);
    $num_rows  = $database->mysqlNumRows($sql_sel);
    if($num_rows){
        while($res_sel  = $database->mysqlFetchArray($sql_sel)){
            $_SESSION['cancel_kot_no'] = $res_sel['tab_kotno'];
            $totalamnt = $res_sel['tab_total'];
            $customerid = $res_sel['tab_hdcustomerid'];
            $orderfrom = $res_sel['tab_mode'];
            $mode = 'Add';
            if($res_sel['tab_preferencetext']=="")
            {
                    $pref_text=NULL;
                    $database->mysqlQuery("SET @preferencetext 	= " . "" . mysqli_real_escape_string($database->DatabaseLink,$pref_text) . "");
            }else
            {
                    $pref_text=$res_sel['tab_preferencetext'];
                    $database->mysqlQuery("SET @preferencetext 	= " . "'" . mysqli_real_escape_string($database->DatabaseLink,$pref_text) . "'");
            }
            $database->mysqlQuery("SET @temp_billno	 	= " . "'" . mysqli_real_escape_string($database->DatabaseLink,$_SESSION['ta_order_id']) . "'");
            $database->mysqlQuery("SET @menuid 			= " . "'" . mysqli_real_escape_string($database->DatabaseLink,$res_sel['tab_menuid']) . "'");
            $database->mysqlQuery("SET @portion 			= " . "'" . mysqli_real_escape_string($database->DatabaseLink,$res_sel['tab_portion']) . "'");
            $database->mysqlQuery("SET @qty 				= " . "'" . mysqli_real_escape_string($database->DatabaseLink,$quantity[$slno]) . "'");
            $database->mysqlQuery("SET @rate 				= " . "'" . mysqli_real_escape_string($database->DatabaseLink,$res_sel['tab_rate']) . "'");
            $database->mysqlQuery("SET @branchid 			= " . "'" . mysqli_real_escape_string($database->DatabaseLink,$_SESSION['branchofid']) . "'");
            $database->mysqlQuery("SET @mode 			= " . "'" . mysqli_real_escape_string($database->DatabaseLink,$mode) . "'");
            $database->mysqlQuery("SET @order_from 			= " . "'" . mysqli_real_escape_string($database->DatabaseLink,$res_sel['tab_mode']) . "'");

            $sq=$database->mysqlQuery("CALL  proc_temptakeaway(@temp_billno,@menuid,@portion,@qty,@preferencetext,@rate,@branchid,@mode,@order_from)");
//            if($sq)
//            {
//                    echo "ok";
//            }
            if($quantity[$slno] == 0){
                $database->mysqlQuery("DELETE FROM `tbl_takeaway_billdetails` 
                WHERE tab_billno = '".$_SESSION['ta_order_id']."' AND tab_menuid = '".$res_sel['tab_menuid']."' ");
            }else{
                $flag = 1;
            }
            
            $slno ++;
        }
        if($flag==1){
            //------------------
            $database->mysqlQuery("SET @temp_billno	 	= " . "'" . mysqli_real_escape_string($database->DatabaseLink,$_SESSION['ta_order_id']) . "'");
            $new_billno="";
            $database->mysqlQuery("SET @branchid 			= " . "'" . mysqli_real_escape_string($database->DatabaseLink,$_SESSION['branchofid']) . "'");
            $database->mysqlQuery("SET @bmode 			= " . "'" . mysqli_real_escape_string($database->DatabaseLink,$orderfrom) . "'");
            $database->mysqlQuery("SET @customer 				= " . "'" . mysqli_real_escape_string($database->DatabaseLink,'') . "'");
            $database->mysqlQuery("SET @contactno 		= " . "" . mysqli_real_escape_string($database->DatabaseLink,'') . "");
            $database->mysqlQuery("SET @permanent_address 	= " . "'" . mysqli_real_escape_string($database->DatabaseLink,'') . "'");
            $database->mysqlQuery("SET @order_address 	= " . "'" . mysqli_real_escape_string($database->DatabaseLink,'') . "'");
            $database->mysqlQuery("SET @landmark 				= " . "'" . mysqli_real_escape_string($database->DatabaseLink,'') . "'");
            $database->mysqlQuery("SET @area 			= " . "'" . mysqli_real_escape_string($database->DatabaseLink,'') . "'");
            $database->mysqlQuery("SET @remarks 			= " . "'" . mysqli_real_escape_string($database->DatabaseLink,'') . "'");
            $database->mysqlQuery("SET @discount_of 			= " . "'" . mysqli_real_escape_string($database->DatabaseLink,'') . "'");
            $database->mysqlQuery("SET @discount_unit 			= " . "'" . mysqli_real_escape_string($database->DatabaseLink,'') . "'");
            $database->mysqlQuery("SET @discount 			= " . "'" . mysqli_real_escape_string($database->DatabaseLink,'N') . "'");
            $database->mysqlQuery("SET @loginid 			= " . "'" . mysqli_real_escape_string($database->DatabaseLink,$_SESSION['expodine_id']) . "'");	

            $kotno="";
            $sq=$database->mysqlQuery("CALL  proc_gentakeaway(@temp_billno,@branchid,@bmode,@customer,@contactno,@permanent_address,@order_address,@landmark,@area,@remarks,@discount_of,@discount_unit,@discount,@discountid,@loginid,@new_billno,@kotno)");
            $rs = $database->mysqlQuery( 'SELECT @new_billno AS billnumber,@kotno as kotno' );
            $billnos="";$kotnos="";
            while($row = mysqli_fetch_array($rs))
            {
            $billnos= $row['billnumber'];
            $kotnos= $row['kotno'];
            }
            $orderid="TEMP*".$database->getEpoch();
            $_SESSION['ta_order_id']=$orderid;
            $_SESSION['printkotbillno']=$billnos;
            $_SESSION['printkotno']=$kotnos;
            $_SESSION['billno']=$billnos;
            $m='';
            
            echo 'ok';
            //------------------
        }else{
            $database->mysqlQuery("DELETE FROM tbl_takeaway_billmaster WHERE tab_billno LIKE 'TEMP%'");
            echo 'no';
        }
        if($_REQUEST['type']=='N'){
            $secretkey = md5($_REQUEST['secretkey']);
        }else{
            $secretkey = $_REQUEST['secretkey'];
        }
        
        $database->mysqlQuery("update tbl_takeaway_billmaster 
        set tab_status = 'Cancelled', tab_cancelamount = '$totalamnt' , tab_cancelledby_careof= '".$_REQUEST['stafflist']."', tab_cancelledreason = '".$_REQUEST['reasontext']."',
        tab_cancelledsecretkey = '$secretkey', tab_cancelledlogin = '".$_SESSION['expodine_id']."', tab_cancelled = 'Y', tab_cancelledtime = CURDATE() 
        where tab_billno = '$billno' and tab_branchid = '".$_SESSION['branchofid']."'");
        
        $database->mysqlQuery("update tbl_takeaway_billmaster set tab_hdcustomerid = '$customerid' 
        where tab_billno = '".$_SESSION['billno']."'");
        
        $database->mysqlQuery("update tbl_takeaway_billdetails 
        set tab_status = 'Cancelled', tab_cancelled = 'Y', tab_cancelledtime = CURDATE(), tab_cancelledby_careof = '".$_REQUEST['stafflist']."', 
        tab_cancelledreason = '".$_REQUEST['reasontext']."', tab_cancelledsecretkey = '$secretkey', tab_cancelledlogin = '".$_SESSION['expodine_id']."'
        where tab_billno = '$billno'");
	 
        
    }
}else if($_REQUEST['set']=="secretkeycheck") 
{
	
    $result="";
    $sql_table_sel3  = $database->mysqlQuery("SELECT * from tbl_staffmaster  WHERE  ser_staffid ='".$_REQUEST['stafflist']."' AND  ser_employeestatus='Active'"); 
      $rrt='';
      $num_table3  = $database->mysqlNumRows($sql_table_sel3);
      if($num_table3)
      {
              while($row = mysqli_fetch_array($sql_table_sel3))
                    {
                    $rrt= $row['ser_cancelwithkey'];
                    }
      }
            if($rrt=="Y")
            {  
                    $result= "yes";
      }else
      {
                    $result= "no";
      }

    if($result== "yes")
    {
            if($_REQUEST['secretkey']!='')
            {
               $sql_table_sel3  = $database->mysqlQuery("SELECT * from tbl_secretkeymaster  WHERE sr_staffid='".$_REQUEST['stafflist']."' and sr_key='".$_REQUEST['secretkey']."' AND  (sr_expiredtime ='0000-00-00 00:00:00' OR  sr_expiredtime IS NULL) AND sr_defaultkey='Y'"); 
                    $num_table3  = $database->mysqlNumRows($sql_table_sel3);
                    if($num_table3)
                    {
                              echo "ok";
                    }else
                    {
                              echo "sorry";
                    }
            }else
            {
                     echo "sorry";
            }
    }else
    {
            if($_REQUEST['secretkey']!='')
            {
               $sql_table_sel3  = $database->mysqlQuery("SELECT * from tbl_logindetails  WHERE ls_staffid='".$_REQUEST['stafflist']."' and ls_password='".md5($_REQUEST['secretkey'])."'");
                    $num_table3  = $database->mysqlNumRows($sql_table_sel3);
                    if($num_table3)
                    {
                              echo "ok";
                    }else
                    {
                              echo "sorry";
                    }
            }else
            {
                    echo "sorry";
            }
    }
 
}else if($_REQUEST['set']=="sendotp") 
{
		$result="";

   $sql_table_sel3  = $database->mysqlQuery("SELECT * from tbl_staffmaster  WHERE  ser_staffid ='".$_REQUEST['stafflist']."' AND  ser_employeestatus='Active'"); $rrt='';
   $num_table3  = $database->mysqlNumRows($sql_table_sel3);
  if($num_table3)
  {
	  while($row = $database->mysqlFetchArray($sql_table_sel3))
		{
		$rrt= trim($row['ser_cancelwithkey']);
		}
  }
	if($rrt=="Y")
	{  
		$result= "yes";
		//$sql=$database->mysqlQuery("UPDATE tbl_secretkeymaster SET `sr_expiredtime`='".$dateexp."' WHERE (sr_key='".$_REQUEST['secretkey']."' )  AND (`sr_expiredtime`='0000-00-00 00:00:00' OR sr_expiredtime IS NULL)");
  }else
  {
	  	$result= "no";
		//$sql=$database->mysqlQuery("UPDATE tbl_secretkeymaster SET `sr_expiredtime`='".$dateexp."' WHERE (sr_password='".md5($_REQUEST['secretkey'])."')  AND (`sr_expiredtime`='0000-00-00 00:00:00' OR sr_expiredtime IS NULL)");
  }$srt='';
	try {
		
		if($rrt== "Y")
		{
			$database->mysqlQuery("SET @staffid = " . "'" . $_REQUEST['stafflist'] . "'");
			$secretkey='';
			$sq=$database->mysqlQuery("CALL proc_gensecretkey(@staffid,@secretkey)") or $database->throw_ex(mysqli_error($database->DatabaseLink));
			$rs = $database->mysqlQuery( 'SELECT @secretkey AS secretkey' );
			while($row = mysqli_fetch_array($rs))
			{
			 $srt= $row['secretkey'];
	
			}
			
			
			
			
			
		// $srt;
		
		//echo $srt."==";
		
		//sms sending starts
		$mobileno='';
		$sql_stff  =  $database->mysqlQuery("SELECT * FROM tbl_staffmaster WHERE ser_staffid='".$_REQUEST['stafflist']."' AND  ser_employeestatus='Active'"); 
		while($result_stff  = $database->mysqlFetchArray($sql_stff)) 
		{
			$mobileno=$result_stff['ser_mobileno'];
		}
		
		
		$phonelist= $mobileno;
		//$smstext= "Please note your OTP - ".$srt; 
		$smstext="OTP for Bill Alteration request is  ".$srt.". Please enter this to verify the identity.";
		$be_sms_username		="";
		$be_sms_apipassword	="";
		$be_sms_senderid		="";
		  $sql_general =  $database->mysqlQuery("Select * from tbl_generalsettings "); 
		  $num_general  = $database->mysqlNumRows($sql_general);
		  if($num_general)
		  {//`tbl_generalsettings`(`be_id`, `be_mail_server`, `be_mail_port`, `be_mail_emailid`, `be_mail_password`, `be_mail_secure`, `be_sms_username`, `be_sms_apipassword`, `be_sms_senderid`)
				while($result_general  = $database->mysqlFetchArray($sql_general)) 
					{
						
						 $be_sms_username			=$result_general['be_sms_username'];
						 $be_sms_apipassword		=$result_general['be_sms_apipassword'];
						 $be_sms_senderid			=$result_general['be_sms_senderid'];
					         $be_sms_domainid			=$result_general['be_sms_domainid'];
                                                 $be_sms_priority			=$result_general['be_sms_priority'];
                                                 $be_sms_method			        =$result_general['be_sms_method'];
                                                 
                                        }
		  }
		
		
		//http://www.webqua.net/pushsms.php?username=exploreit&api_password=f8386edkhhzkcsaqt&sender=websms&to=9895366444&message=thank%20you%20for%20contacting%20us&priority=11
		$username=$be_sms_username;
		$api_password=$be_sms_apipassword;
		$sender=$be_sms_senderid;
		$domain=$be_sms_domainid;
                $priority=$be_sms_priority;
                $smstype = $be_sms_method; 

		$username=urlencode($username);
		$sender=urlencode($sender);
		$message=urlencode($smstext);
		$domain=urlencode($domain);
                $route=urlencode($priority);                                                                                                                                                                                                                                                                                                                                                                                           
		
                
                 $parameters="username=$username&api_password=$api_password&sender=$sender&to=$phonelist&priority=$route&message=$message";
                
		if($method=="POST")
		{
			$opts = array(
			  'http'=>array(
				'method'=>"$method",
				'content' => "$parameters",
				'header'=>"Accept-language: en\r\n" .
						  "Cookie: foo=bar\r\n"
			  )
			);
	
			$context = stream_context_create($opts);
			
			
	
		
		}
		else
		{
			$fp = fopen("http://$domain/pushsms.php?$parameters", "r");
		}
	
		$response = stream_get_contents($fp);
		fpassthru($fp);
		fclose($fp);
	
		
	
		
		//sms sending ends
		}else
		{
			$sqq=substr(floor( 1000 + ( rand( ) *8999 )),0,4);
			$sql_i=$database->mysqlQuery("INSERT INTO `tbl_secretkeymaster`( `sr_staffid`, `sr_password`,sr_key, `sr_generatedtime`, `sr_defaultkey`) VALUES ('".$_REQUEST['stafflist']."','".md5($_REQUEST['secretkey'])."','".$sqq."','".date("Y-m-d H:i:s")."','N')");
		}
		
		//echo $rrt."dd".$srt;
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
else if(isset($_REQUEST['set']) && $_REQUEST['set']=="check_urban_reorder"){
    
    $sql_table_sel3  = $database->mysqlQuery("SELECT tab_qr_order_id from tbl_takeaway_billmaster  WHERE  tab_billno ='".$_REQUEST['billno']."' "); 
      $rrt='';
      $num_table3  = $database->mysqlNumRows($sql_table_sel3);
      if($num_table3)
      {
              while($row = mysqli_fetch_array($sql_table_sel3))
                    {
                  
                  if($row['tab_qr_order_id']!=''){
                     echo 'ok'; 
                  }else{
                      echo 'no';
                  }
                  
              }
              }
    
}

else if(isset($_REQUEST['set']) && $_REQUEST['set']=="cancel_ta_itemqty"){
    
   
    $billno= $_REQUEST['billno'];
    $itemslno = $_REQUEST['itemslno'];
    $itemqty = $_REQUEST['itemqty'];
    $reason = $_REQUEST['reason'];
    $slno = explode(',',$itemslno);
    $qty = explode(',',$itemqty);
    $reason=$_REQUEST['reason'];
    $staff=$_REQUEST['staff'];
    $login=$_SESSION['expodine_id'];
    $cancel_date_time=  date("Y-m-d H:i:s");
    
   if($_REQUEST['reason']!=""){
         
      $reason= $_REQUEST['reason'];
      
   }else{
      $reason=0; 
   }
   
    $combo_name=json_decode($_REQUEST['combo_name']);
    $mode="TA";
    $database->mysqlQuery("SET @branchid = " . "'" . $_SESSION['branchofid'] . "'");
    $database->mysqlQuery("SET @temp_id = " . "'" . $billno . "'");
    $database->mysqlQuery("SET @mode = " . "'" . $mode . "'");
    $sq=$database->mysqlQuery("CALL proc_kot_cancel(@branchid,@temp_id,@mode,@cancel_id)");
    $rs = $database->mysqlQuery("SELECT @cancel_id AS cancel_id");
    $row = $database->mysqlFetchArray($rs);
    $cancel_id= $row['cancel_id'];
   
    if(!empty($combo_name)){
        
        for($p=0;$p<count($combo_name);$p++){
            
            $combo_qty=$combo_name[$p]->combo_qty;
            $combo_count=$combo_name[$p]->combo_count;
            $combo_cancel_reason=$combo_name[$p]->reason;
            $stock_check=$combo_name[$p]->stock_check;
            
            $sql_combo_menu_qty_select=$database->mysqlQuery("select cbd_kot_no,cbd_combo_pack_id,cbd_combo_pack_rate,cbd_combo_qty,cbd_menu_qty,cbd_menu_id,cbd_menu_qty FROM tbl_combo_bill_details_ta where cbd_count_combo_ordering='".$combo_count."' and cbd_billno='".$billno."'");
           
            $num_combo_menu_qty_select  = $database->mysqlNumRows($sql_combo_menu_qty_select);
            if($num_combo_menu_qty_select){$ii=0;
                while($result_combo_menu_qty_select  = $database->mysqlFetchArray($sql_combo_menu_qty_select)){
                    
                    $kot_no=$result_combo_menu_qty_select['cbd_kot_no'];
                    
                    if($combo_qty < $result_combo_menu_qty_select['cbd_combo_qty']){
                        
                        $ii++;
                        $diff_combo_qty=$result_combo_menu_qty_select['cbd_combo_qty']-$combo_qty;
                        $new_total_menu_qty=$combo_qty*$result_combo_menu_qty_select['cbd_menu_qty'];
                        
                        if($ii==1){
                            $sql_combo_update =  $database->mysqlQuery(" update tbl_takeaway_billmaster set tab_subtotal= tab_subtotal+( select '".($result_combo_menu_qty_select['cbd_combo_pack_rate']*$combo_qty)."'-cbd.cbd_combo_total_rate  FROM tbl_combo_bill_details_ta cbd where cbd.cbd_count_combo_ordering='".$combo_count."' and cbd.cbd_billno='".$billno."' LIMIT 1) WHERE tab_billno='".$billno."' ");
                           if($stock_check=='Y'){
                            $sql_combo_stock_update =  $database->mysqlQuery(" UPDATE `tbl_combo_stock` SET `cs_stock_number`=cs_stock_number+'".$diff_combo_qty."' ,`cs_last_updated`=NOW() WHERE `cs_pack_id`='".$result_combo_menu_qty_select['cbd_combo_pack_id']."' ");
                           } 
                        
                        }
                     
                        $sql_combo_menu_qty_update=$database->mysqlQuery("update tbl_combo_bill_details_ta set cbd_combo_qty= '".$combo_qty."',cbd_combo_total_rate= cbd_combo_pack_rate*'".$combo_qty."' where cbd_count_combo_ordering='".$combo_count."' and cbd_menu_id='".$result_combo_menu_qty_select['cbd_menu_id']."' and cbd_billno='".$billno."' ");
                        $sql_combo_billdetails_select=$database->mysqlQuery("select tab_slno,tab_qty FROM tbl_takeaway_billdetails where tab_billno='".$billno."' and tab_count_combo_ordering='".$combo_count."' and tab_menuid='".$result_combo_menu_qty_select['cbd_menu_id']."'");
                       
                        $num_combo_billdetails_select  = $database->mysqlNumRows($sql_combo_billdetails_select);
                        
                        if($num_combo_billdetails_select){$i=1;
                            $result_combo_billdetails_select  = $database->mysqlFetchArray($sql_combo_billdetails_select);
                            
                            $new_combo_menu_qty_cancelled=$result_combo_billdetails_select['tab_qty']-$new_total_menu_qty;    
                          
                            $combo_billdetails_update=$database->mysqlQuery("update tbl_takeaway_billdetails set tab_qty='".$new_total_menu_qty."',tab_cancelled = 'N'  where tab_billno='".$billno."' and tab_slno='".$result_combo_billdetails_select['tab_slno']."' ");
                             
                            if($new_total_menu_qty==0){
                                $sql_combo_menu_qty_update=$database->mysqlQuery("update tbl_combo_bill_details_ta set cbd_cancel= 'Y' where cbd_count_combo_ordering='".$combo_count."' and cbd_menu_id='".$result_combo_menu_qty_select['cbd_menu_id']."' and cbd_billno='".$billno."' ");
                                $combo_billdetails_update1=$database->mysqlQuery("update tbl_takeaway_billdetails set  tab_status='Cancelled',tab_cancelled = 'Y'  where tab_billno='".$billno."' and tab_slno='".$result_combo_billdetails_select['tab_slno']."' ");
                            }
                            
                            $insertion['tc_mode'] =$mode; 
                            $insertion['tc_dayclosedate'] =$_SESSION['date']; 
                            $insertion['tc_cancel_kotno'] =$kot_no;                   
                            $insertion['tc_cancel_id'] = $cancel_id;                
                            $insertion['tc_billno'] = $billno;
                            $insertion['tc_bill_slno'] = $result_combo_billdetails_select['tab_slno'];
                            $insertion['tc_cancel_qty'] = $new_combo_menu_qty_cancelled;
                            $insertion['tc_cancelled_by'] =$staff;
                            $insertion['tc_cancelled_login'] =$login;
                            $insertion['tc_cancelled_time'] =$cancel_date_time;
                            $insertion['tc_reason'] =$reason;
                            $insertion['tc_combo_pack_cancelled_qty']=$diff_combo_qty;
                            $insertid = $database->insert('tbl_takeaway_cancel_items', $insertion);  
                        }    
                    }
                }
            }    
        }
    }
    
    
    
    $sl_array=  array();
    for($i=0;$i<count($slno);$i++){
            if($qty[$i]!=""){
                
            $new_qty=0;    
         
            
            
             $sql_qry1 = $database->mysqlQuery("select tab_kotno from tbl_takeaway_billmaster 
             where tab_billno = '".$billno."'");
        
            $num_rows1 = $database->mysqlNumRows($sql_qry1);
            if($num_rows1){
            $result_row1 = $database->mysqlFetchArray($sql_qry1);

            $kot_no=$result_row1['tab_kotno'];
            }

            
            
        $sql_qry = $database->mysqlQuery("select * from tbl_takeaway_billdetails 
        where tab_billno = '".$billno."' and tab_slno = $slno[$i] order by tab_slno asc");
        
        $num_rows = $database->mysqlNumRows($sql_qry);
        if($num_rows){
        $result_row = $database->mysqlFetchArray($sql_qry);
        
        if($result_row['tab_qty'] != $qty[$i]){

             $sl_array[]=$slno[$i];
  
     
                    $database->mysqlQuery("update tbl_takeaway_billdetails set tab_qty = $qty[$i],tab_amount = $qty[$i]*tab_rate
                    where tab_billno = '".$billno."' and tab_slno = $slno[$i] and tab_status!='Cancelled'");
                   
                    
               
                  if( $qty[$i]==0){
                      
                    $database->mysqlQuery("update tbl_takeaway_billdetails set tab_status='Cancelled',tab_cancelled='Y'
                    where tab_billno = '".$billno."' and tab_slno = $slno[$i]");
                    
                    $database->mysqlQuery("update tbl_takeaway_billdetails set tab_qty='0',tab_amount='0',tab_status='Cancelled',tab_cancelled='Y'
                    where tab_billno = '".$billno."' and tab_bill_addon_slno = '".$slno[$i]."'");
                  }   
                    
        
                    
         $new_qty=$result_row['tab_qty']- $qty[$i];   
     
          ////////stockupdate//////
       
          $sql_qry111 = $database->mysqlQuery("select tab_menuid,tab_portion from tbl_takeaway_billdetails 
          where tab_billno = '".$billno."' and  tab_slno = '".$slno[$i]."' ");
        
            $num_rows111 = $database->mysqlNumRows($sql_qry111);
              if($num_rows111){
              while($result_row111 = $database->mysqlFetchArray($sql_qry111)){
      
              $qty_update= $database->mysqlQuery( "UPDATE tbl_menustock SET "
              . " mk_stock_number=mk_stock_number+'".$new_qty."' "
              . " where mk_menuid= '".$result_row111['tab_menuid']."' "
              . " and mk_portion= '".$result_row111['tab_portion']."' and mk_open_stock_date='".$_SESSION['date']."' and mk_opening_stock >0 ");
      
           }
           
          }
         ////stockend///////
     
     if($billno[0]=="T"){
              $mode="TA"; 
          }else if($billno[0]=="H"){
              $mode="HD";    
          }else if($billno[0]=="C"){
              $mode="CS";
          }
     
     
    $insertion['tc_mode'] =$mode; 
    $insertion['tc_dayclosedate'] =$_SESSION['date']; 
    $insertion['tc_cancel_kotno'] =$kot_no;                   
    $insertion['tc_cancel_id'] = $cancel_id;                
    $insertion['tc_billno'] = $billno;
    $insertion['tc_bill_slno'] = $slno[$i];
    $insertion['tc_cancel_qty'] = $new_qty;
    $insertion['tc_cancelled_by'] =$staff;
    $insertion['tc_cancelled_login'] =$login;
    $insertion['tc_cancelled_time'] =$cancel_date_time;
    $insertion['tc_reason'] =$reason;
     
    $insertid = $database->insert('tbl_takeaway_cancel_items', $insertion);    
    //echo $insertid;
          
             }
                   
      
}
}
               
  }
    
     
     
          if($billno[0]=="T"){
               $homed="TA"; 
          }else if($billno[0]=="H"){
               $homed="HD";    
          }
          
  	$database->mysqlQuery("SET @billno	 	      = " . "'" . mysqli_real_escape_string($database->DatabaseLink,$billno) . "'");
	$database->mysqlQuery("SET @branchid 			= " . "'" . mysqli_real_escape_string($database->DatabaseLink,$_SESSION['branchofid']) . "'");
	$database->mysqlQuery("SET @bmode 			= " . "'" . mysqli_real_escape_string($database->DatabaseLink,$homed) . "'");
	
	$kotno="";
	$sq=$database->mysqlQuery("CALL  proc_ta_kot_cancel(@billno,@branchid,@bmode,@MESSAGE)");
	$rp="";
        
        
        require_once("printer_functions.php");
        $printpage=new PrinterCommonSettings();
        
         if($_SESSION['s_printst']=='Y'){
              
         $printpage->print_kot_cancel_ta($cancel_id,$_SESSION['date'],"web",$_SESSION['branchofid'],$sl_array);
         
         
         $printpage->print_kot_cancel_ta_consolidated($cancel_id,$_SESSION['date'],"web",$_SESSION['branchofid']);
          
          }
          
          
          
           $sql_qry11 = $database->mysqlQuery("select tab_bill_print,tab_netamt from tbl_takeaway_billmaster 
           where tab_billno = '".$billno."'");

           $num_rows11 = $database->mysqlNumRows($sql_qry11);
           if($num_rows11){
             while($result_row11 = $database->mysqlFetchArray($sql_qry11)){

                         $billprinted = $result_row11['tab_bill_print'];

                         $net_amount=$result_row11['tab_netamt'];
                   }
           }
          
          
         if($billprinted=='Y' && $net_amount>0){
             
          if($_SESSION['s_printst']=='Y'){
                    
            $printpage->print_bill_ta($billno,$homed,$_SESSION['branchofid'],"web",$_SESSION['billip'],$_SESSION['hosttype'],$rp);
         
           }
        }
     
     
     
        $sql_login_fire2  =  $database->mysqlQuery("select tf_active from tbl_firebase_notification_report where tf_report_head='Item Cancel' "); 
	$num_login_fire2   = $database->mysqlNumRows($sql_login_fire2);
	if($num_login_fire2){ 
	while($result_login_fire2  = $database->mysqlFetchArray($sql_login_fire2)) 
        { 
            $firebase_report_status=$result_login_fire2['tf_active'];
        }}
     
     
      if($_SESSION['cloud_enable_sync']=='Y' && $_SESSION['firebase_on']=='Y' && $firebase_report_status=="Y"){
          
        $data_body='';
        $localhost=mysqli_connect(HOST_NAME, USER_NAME, PASSWORD,DATABASE_NAME);
        
       
            
                 $sql_items="select tcrr.cr_reason, toc.tc_cancel_kotno, toc.tc_cancelled_by,um.u_name,bum.bu_name,tor.tab_bill_addon_slno,
                 tor.tab_count_combo_ordering,tor.tab_unit_type,tor.tab_unit_weight,tor.tab_rate_type,tor.tab_unit_id,tor.tab_base_unit_id,
                 tor.tab_menuid, mm.mr_menuname, mm.mr_menuid,kcm.kr_kotname, toc.tc_cancel_qty, pm.pm_viewinkot, pm.pm_portionname,
                 toc.tc_combo_pack_cancelled_qty
                 FROM tbl_takeaway_cancel_items toc 
                 left join tbl_cancellation_reasons tcrr on tcrr.cr_id=toc.tc_reason
                 left join tbl_takeaway_billdetails tor on toc.tc_billno = tor.tab_billno and toc.tc_bill_slno = tor.tab_slno
                 left join tbl_menumaster mm on tor.tab_menuid = mm.mr_menuid
                 left join tbl_portionmaster pm on tor.tab_portion = pm.pm_id left join tbl_unit_master um on um.u_id=tor.tab_unit_id left join
                 tbl_base_unit_master bum on bum.bu_id=tor.tab_base_unit_id
                 left join tbl_kotcountermaster as kcm on mm.mr_kotcounter = kcm.kr_kotcode
                 where toc.tc_cancel_id = '$cancel_id' and toc.tc_dayclosedate='".$_SESSION['date']."'   order by tab_count_combo_ordering asc ";        
                                                                                
                                                                       
    $sql_items  =  mysqli_query($localhost,$sql_items); 
    $num_items  = mysqli_num_rows($sql_items);
    if($num_items){
                                                                            
    $old = '';
    $oldno = '';
    $combo_ordering_count=array();
    $combo_pack_rate=0;
    $combo_menu_qty=0;
    $combo_qty=0;
    while($result_items  = mysqli_fetch_array($sql_items)) 
    {
                                                                                
                                                                             
    $reason_staff='';
    $sql_gen1 =  mysqli_query($localhost,"select ser_firstname from tbl_staffmaster where ser_staffid='". $result_items['tc_cancelled_by']."'"); 
    $num_gen1  = mysqli_num_rows($sql_gen1);
    if($num_gen1)
    {
    while($result_invoice63  = mysqli_fetch_array($sql_gen1)) 
    {
      $reason_staff=$result_invoice63['ser_firstname'];
    }
    } 
                                                                                
                                                                                
                                                                                
    $addon_menu='';
    $menu='';
    if($result_items['tab_bill_addon_slno']!=''){
        $addon_menu="**AD** " ;
        $menu.=$addon_menu." ";
    }
                                                                                
    if($result_items['tab_count_combo_ordering']){
                                        

    $sql_combo_heading  =  mysqli_query($localhost,"select  cn.cn_name,cp.cp_pack_name,cbd.cbd_combo_qty,cbd.cbd_menu_qty,cbd.cbd_combo_pack_rate FROM 
    tbl_combo_bill_details_ta cbd 
    left join tbl_combo_name cn on cn.cn_id=cbd.cbd_combo_id
    left join tbl_combo_packs cp on cp.cp_id=cbd.cbd_combo_pack_id
    where cbd.cbd_count_combo_ordering='".$result_items['tab_count_combo_ordering']."' and"
    . " cbd.cbd_menu_id='".$result_items['mr_menuid']."'  and cbd.cbd_count_combo_ordering IS NOT  NULL"); 
    $num_combo_heading  = mysqli_num_rows($sql_combo_heading);
    if($num_combo_heading)
    {
        $result_combo_heading  = mysqli_fetch_array($sql_combo_heading);
        $combo_pack_rate=$result_combo_heading['cbd_combo_pack_rate'];
        $combo_menu_qty=$result_combo_heading['cbd_menu_qty'];
        $combo_qty=$result_combo_heading['cbd_combo_qty'];
        $combo_name = $result_combo_heading['cn_name'].'-'. $result_combo_heading['cp_pack_name'].'(Qty:'.$result_items['tc_combo_pack_cancelled_qty'].')- '.number_format(($combo_pack_rate*$result_items['tc_combo_pack_cancelled_qty']),$decimal);
    }
    }
                                                                            
    if($result_items['tab_count_combo_ordering'] && !in_array($result_items['tab_count_combo_ordering'],$combo_ordering_count)){
                                                                                    
    $combo_ordering_count[]=$result_items['tab_count_combo_ordering'];
    $qtys=$combo_pack_rate*$combo_qty;
                                                                                           
                                                                                           
    $data_body.=' \n';
    $data_body.=$combo_name;
    $data_body.=' \n'; 
                                                                                            
    }
    else{
     $combo_name='';
     $qtys=0;
    }
                                                                                
                                                                                $ct++;
                                                                                $kotcounter = $result_items['kr_kotname'];

                                                                                if($kotcounter != $old){
                                                                                  
                                                                                    $oldno = '';
                                                                                    $old = $result_items['kr_kotname'];
                                                                                  
                                                                                    $kotname = '* '.$kotcounter;
                                                                                    $stln = strlen($kotname);
                                                                                    $a=0;
                                                                                    $spc = 46 - $stln;
                                                                                    for($a=0;$a<$spc;$a++){  
                                                                                       
                                                                                    }

                                                                                  
                                                                                  $data_body.=' '.$kotname;
                                                                                   
                                                                                }else{
                                                                                    $old = $result_items['kr_kotname'];
                                                                                }

                                                                                $kotno = $result_items['tc_cancel_kotno'];
                                                                                
                                                                                if($kotno != $oldno){
                                                                                    
                                                                                    $oldno = $result_items['tc_cancel_kotno'];
                                                                                   
                                                                                    $kotnumber = ''.$kotno;
                                                                                    $stln = strlen($kotnumber);
                                                                                    $a=0;
                                                                                    $spc = 44 - $stln;
                                                                                    for($a=0;$a<$spc;$a++){  
                                                                                       
                                                                                    }

                                                                                  
                                                                                $data_body.=' [ '.$kotnumber.' ] \n';
                                                                                 
                                                                                }else{
                                                                                    $oldno = $result_items['tc_cancel_kotno'];
                                                                                }
                                                                                
                                                                                
                                                                       if($result_items['pm_viewinkot']=="Y"){
                                                                                $pr='('.$result_items['pm_portionname'].')';
                                                                       }else
                                                                       {
                                                                           
                                                                         $pr="";
                                                                       }
                                                                             
                                                                              
                                                                                $menu_details='';
                                                                                $menu.= $result_items['tc_cancel_qty'].' - '.$result_items['mr_menuname'];
                                                                                
                                                                               $rsn_cr='Reason : '.$result_items['cr_reason'];
                                                                                
                                                                                if($result_items['tab_unit_id']!="")
                                                                                    {
                                                                                    
                                                                                    $menu_details="(".$result_items['tab_unit_type'].":".number_format($result_items['tab_unit_weight'],$decimal)." ".$result_items['u_name'].')'; 
                                                                                    
                                                                                    
                                                                                    }
                                                                                    else if($result_items['tab_base_unit_id']!=""){
                                                                                        
                                                                                    $menu_details="(".$result_items['tab_unit_type'].":".number_format($result_items['tab_unit_weight'],$decimal)." ".$result_items['bu_name'].')';  
                                                                                   
                                                                                    }
                                                                                    
                                                                                    
                                                                                $stln = strlen($menu);
                                                                                $a=0;
                                                                                $spc = 44 - $stln;
                                                                                
                                                                                for($a=0;$a<$spc;$a++){  
                                                                                   
                                                                                   
                                                                                }
                                                                              	   
                                                                             
                                                                              
								            $data_body.=$menu.' \n';
                                                                              
                                                                            if($pr!=''){
                                                                                 $data_body.=$pr.' \n';  
                                                                             }
                                                                              
                                                                             if($menu_details!=''){
                                                                                  $data_body.=$menu_details.' \n';
                                                                             }
                                                                               
                                                                             if($rsn_cr!=''){
                                                                             
                                                                                $data_body.=''.$rsn_cr.' \n';
                                                                                
                                                                             }
                                                                               
                                                                                $data_body.=' \n';
//                                                                               
                                                                            }
                                                                            
                                                                       $date_new=date('Y-m-d h:i:s');
                                                                       $data_body.='KOT Cancelled by : '.$reason_staff.' \n'; 
                                                                       $data_body.='Cancelled Time : '.$date_new.' \n'; 
                                                                    
                                                                       if($billno!=''){
                                                                            $data_body.='Bill No : '.$billno.' \n'; 
                                                                       }
                                                                           $data_body.='MODE - TA-HD' ;    
                                                                        }
      
                                                                        
                                                                        
        $a="8.8.8.8";
        exec("ping -n 1 -w 1 ".$a, $output, $result);
        if($result==0)
        {                                                                 
                                                                        
    ///pushing msg///
    $branch_id_fire=$_SESSION['firebase_id'];
    
    
    
    $url = "https://fcm.googleapis.com/fcm/send";
   
     $body = $data_body;
     require 'vendor/autoload.php';
    
    $client = new Client();
    $client->setAuthConfig('service_google.json'); // Replace with your file path
    $client->addScope('https://www.googleapis.com/auth/firebase.messaging');
    $accessToken = $client->fetchAccessTokenWithAssertion()['access_token'];
   
   $url = "https://fcm.googleapis.com/v1/projects/ed-reports-b5f94/messages:send";
   $projectId = 'ed-reports-b5f94'; 
 
     $data = [
    'message' => [
       "topic"=> $branch_id_fire,
        'notification' => [
            'title' => $_SESSION['s_branchname']."  - TA-HD ITEM CANCELLED",
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
    
    
    
//    $serverKey = 'AIzaSyD3zn_tP2RqeVSMsEFMJnrcZk5AuNGru-M';
//    $title = $_SESSION['s_branchname']."  - TA-HD ITEM CANCELLED";
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
//    
//    $response = curl_exec($ch);
//   
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
       
}
else if(isset($_REQUEST['set'])&& $_REQUEST['set']=='load_billdetails_online')
{ 
  
 ?>
 <script type="text/javascript" src="js/payments_ta_cs_select.js"></script> 
 <script type="text/javascript" src="js/payments_takeaway.js"></script> 
                    
 <?php
 
  $partner_name='';
  $sql_login_fire2  =  $database->mysqlQuery("select ct_corporatename from tbl_corporatemaster where ct_online_id='".$_REQUEST['partner']."' "); 
	$num_login_fire2   = $database->mysqlNumRows($sql_login_fire2);
	if($num_login_fire2){ 
	while($result_login_fire2  = $database->mysqlFetchArray($sql_login_fire2)) 
        { 
          $partner_name=$result_login_fire2['ct_corporatename'];
        }}
 
 
        $sql_table_sel_query= "Select distinct(tb.tab_billno),tb.tbl_takeaway_printed,tb.tab_time,tb.tab_bill_print,tb.tab_bill_ref,tb.tab_hdcustomerid ,ts.tac_customername,ts.tac_contactno,tb.tab_status,tb.tab_kotno, tb.tab_mode,tb.tab_netamt,tb.tab_total,tb.tab_subtotal_final,ts.tac_contactno,tb.tab_regen_status From tbl_takeaway_billmaster as tb LEFT JOIN tbl_takeaway_customer ts ON ts.tac_customerid=tb.tab_hdcustomerid Where tb.tab_dayclosedate ='".$_SESSION['date']."' and tb.tab_status != 'Cancelled'  And ((tb.tab_mode='HD' AND tb.tab_payment_settled = 'N')  OR (tb.tab_mode='TA' AND tb.tab_payment_settled = 'N' And tb.tab_kotno != '')) and tb.tab_status != 'Cancelled' AND tb.tab_billno  NOT LIKE 'TEMP%' and tb.tab_food_partner='".$_REQUEST['partner']."'  order by tb.tab_date,tb.tab_time DESC ";

	$sql_table_sel = $database->mysqlQuery($sql_table_sel_query);
			 $num_table  = $database->mysqlNumRows($sql_table_sel);
		  if($num_table){
				while($result_table_sel  = $database->mysqlFetchArray($sql_table_sel)) 
					{
                                    
					?>
 
       <input type="hidden" value="<?=$partner_name?>" id="bill_partner">  
       
       <div <?php if($result_table_sel["tab_bill_print"]=="Y"){ ?> ondblclick="double_click_settle('<?=$result_table_sel["tab_billno"]?>')" style="background-color:lightseagreen" total="<?=number_format($result_table_sel["tab_netamt"],$_SESSION['be_decimal'])?>"  <?php } else { ?>  style="background-color:lightgreen"   <?php  } ?>class="payment_pend_bill_cc high_class<?=$result_table_sel["tab_billno"]?>" mode="<?= $result_table_sel["tab_mode"] ?>" total="<?=number_format($result_table_sel["tab_subtotal_final"],$_SESSION['be_decimal'])?>" bill="<?=$result_table_sel["tab_billno"]?>" id="<?=$result_table_sel["tab_billno"]?>" status_billed="<?=$result_table_sel["tab_bill_print"]?>" >
  
       <div style="margin-left:10px" class="payment_pend_bill_no"> 
           
           
      <?php if($result_table_sel["tab_bill_print"]=="Y" && $result_table_sel["tab_regen_status"]!="Y"){ ?>   <input style="margin-left:8px" type="checkbox" id="all_credit_bill" name="all_credit_bill[]" class="all_credit_settle"  billno_credit="<?=$result_table_sel["tab_billno"]?>"  billamount_credit="<?=$result_table_sel["tab_netamt"]?>" >   <?php } ?>  
      
      &nbsp; <?="[".$result_table_sel["tab_bill_ref"]."] " ?>  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  <?=$result_table_sel["tab_billno"]?>
     
     </div>
        
           
     <div class="payment_pend_bill_mode_cc">
         
         <div style="display:none" class="payment_pend_bill_mode"><?=(($result_table_sel["tab_mode"]=="TA")? "T" : "H")?></div>
             
     </div>
                </div>
                
      <?php }}else { ?>
 
       <input type="hidden" value="<?=$result_table_sel["tab_billno"]?>" id="billta" >
                   <tr>
                   <td style="color:darkred">NO BILLS TO SETTLE</td>
                   </tr>
      <?php } ?>
                 
                          
 <?php
 }
 else if(isset($_REQUEST['set'])&& $_REQUEST['set']=='check_amount_online_all')
{ 
     
     
    $tot=0;
    for($i=0;$i<count($_REQUEST['billno']);$i++){
  
        $sql_table_sel_query= "Select  tab_netamt From tbl_takeaway_billmaster Where tab_billno='".$_REQUEST['billno'][$i]."'   ";

	$sql_table_sel = $database->mysqlQuery($sql_table_sel_query);
			 $num_table  = $database->mysqlNumRows($sql_table_sel);
		  if($num_table){
				while($result_table_sel  = $database->mysqlFetchArray($sql_table_sel)) 
				{
                                    
                                    $tot=$tot+$result_table_sel['tab_netamt'];
                                }
                                }
                                
  }             
     
  echo $tot;
  
 }