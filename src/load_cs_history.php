<?php

include('includes/session.php');		// Check session
use Google\Client;
//
//if($_SESSION['db_type']=='' || !isset($_REQUEST['db_type'])){
//    $_SESSION['db_type']='normal';
//}

error_reporting(0);
if(isset($_REQUEST['set_year'] ) && ($_REQUEST['set_year']=="set_normal" )){
   $_SESSION['db_type']='normal';
}

if(isset($_REQUEST['set_year'] ) && ($_REQUEST['set_year']=="set_archive" )){
  $_SESSION['db_type']='archive';
}
   



if($_SESSION["archive_enabled"]=='Y'){ 
if($_SESSION['db_type']=='archive'){
        
     include("database.class.reports.php"); // DB Connection class
    $database	= new Database();  
}else{
     include("database.class.php"); // DB Connection class
     $database	= new Database();  
}
}else{
     include("database.class.php"); // DB Connection class
     $database	= new Database();  
}


include("api_multiplelanguage_link.php");
$other_lang=  trim(json_encode($_SESSION['main_language']),'""');



if(isset($_REQUEST['set_check'] ) && ($_REQUEST['set_check']=="set_check_cancel" )){
    
    
    $_SESSION['status_cancel']=trim($_REQUEST['status']);
    echo  $_SESSION['status_cancel'];
}

if(isset($_REQUEST['set'] ) && ($_REQUEST['set']=="customerdetail" )){
       
       
       $sql_ds_nos12 = "select tab_name,tab_phone,tab_gst from tbl_takeaway_billmaster where tab_billno='".$_REQUEST['cusbillno']."'";
						$sql_ds12 = $database->mysqlQuery($sql_ds_nos12);
						$num_ds12 = $database->mysqlNumRows($sql_ds12);
						if ($num_ds12) {
							
							while ($result_ds1 = $database->mysqlFetchArray($sql_ds12)) {
                                                            
                                                            $cnm=$result_ds1['tab_name'];
                                                             $cph=$result_ds1['tab_phone'];
                                                              $cgt=$result_ds1['tab_gst'];
                                                            
                                                        }
                                                        
                                                        }
                                                       if(($cnm!=$_REQUEST['csname']) || ($cph!=$_REQUEST['csphone']) || ($cgt!=$_REQUEST['csgst']) ){
       $query321=$database->mysqlQuery("  update  tbl_takeaway_billmaster set tab_name='".$_REQUEST['csname']."' ,tab_phone='".$_REQUEST['csphone']."',tab_gst='".$_REQUEST['csgst']."' where tab_billno='".$_REQUEST['cusbillno']."' ");    
         echo 'ok';        
       }  else {
           echo 'sorry';    
       }
             
       
       }



if($_REQUEST['value']=="searchtahistory")
{

	$string='';
	
	
	if(($_REQUEST['billno']!="null"))
	{
		$string.=" AND  tb.tab_billno LIKE '%".$_REQUEST['billno']."%'";
	}
	if(($_REQUEST['name']!="null"))
	{
		$string.=" AND  ts.tac_customername LIKE '%".$_REQUEST['name']."%'";
	}
	if(($_REQUEST['nos']!="null"))
	{
		$string.=" AND  ts.tac_contactno LIKE '%".$_REQUEST['nos']."%'";
	}
        
	if(($_REQUEST['statuss']!="null"))
	{
		$string.=" AND  tb.tab_status LIKE '%".$_REQUEST['statuss']."%'";
	}
        
        if(($_REQUEST['paymode']!="null"))
	{
		$string.=" AND  tb.tab_paymode = '".$_REQUEST['paymode']."'";
	}
	?>
    <script src="js/takeaway_hist.js"></script>
   <table class="new_fnt" width="100%"  border="0"> <!----bill_history_active--->
	<?php
	$sql_bilhis= "Select tb.tab_paymode,tb.tab_billno,tb.tab_dayclosedate, ts.tac_customername,ts.tac_contactno,tb.tab_status  From tbl_takeaway_billmaster as tb LEFT JOIN tbl_takeaway_customer ts ON ts.tac_customerid=tb.tab_hdcustomerid Where tb.tab_mode='CS' and tb.tab_dayclosedate ='".$_REQUEST['date']."' AND tb.tab_billno not like 'Temp%' AND tb.tab_billno not like 'HOLD%' $string  ORDER BY    tb.tab_date,tb.tab_time DESC ";
    //$sql_bilhis="select tab_billno,	tab_customername,tab_status,tab_customermobile,tab_status  from tbl_takeaway_billmaster WHERE 	tab_dayclosedate='".$_SESSION['date']."' $string  ORDER BY 	tab_date,tab_time DESC";
    $sql_bilhistory  =  $database->mysqlQuery($sql_bilhis); 
    $num_bilhistory  = $database->mysqlNumRows($sql_bilhistory);
    if($num_bilhistory)
    {$i=1;
        while($result_bilhistory  = $database->mysqlFetchArray($sql_bilhistory)) 
            { $cur_date= $_SESSION['date'];
                ?><!--bill_history_number-->
      <tr class="ta_bill_history <?php if($result_bilhistory['tab_status']=='Cancelled'){ ?> bill_history_cancel <?php } ?>" cur_date="<?=$cur_date?>" billdate="<?= $result_bilhistory['tab_dayclosedate'] ?>" user="<?= $_SESSION['designtnname']?>" billno="<?=$result_bilhistory['tab_billno']?>" cancelstatus="<?=$result_bilhistory['tab_status']?>" >
        <td width="8%"><strong><?=$i++?></strong></td>
        <td width="27%"><?=$database->highlightkeyword($result_bilhistory['tab_billno'],$_REQUEST['billno'])?></td>
         <td width="31%"><?=$database->highlightkeyword($result_bilhistory['tac_customername'],$_REQUEST['name'])?></td>
         <td width="20%"><?=$database->highlightkeyword($result_bilhistory['tac_contactno'],$_REQUEST['nos'])?></td>
         <td width="14%" style="font-size: 8px;font-weight: bold"  ><span  class="<?php if($result_bilhistory['tab_status']=='Closed') { ?> closed_1 <?php } else if($result_bilhistory['tab_status']=='Packed') { ?> packed_clr <?php } else if($result_bilhistory['tab_status']=='Generated') { ?> genrate_clr<?php }  else if($result_bilhistory['tab_status']=='KOT_Generated') { ?> kot_genrated_clr<?php } else if($result_bilhistory['tab_status']=='Assigned') { ?> assigned_clr<?php } ?>"><?=$database->highlightkeyword($result_bilhistory['tab_status'],$_REQUEST['statuss'])?></span></td>
     
      <?php    
        $paymode='';   
        $sql_listall2  =  $database->mysqlQuery("SELECT pym_name from  tbl_paymentmode where pym_id='".$result_bilhistory['tab_paymode']."' limit 1 "); 
	$num_listall2  = $database->mysqlNumRows($sql_listall2);
	if($num_listall2){ 
	 while($row_listall2  = $database->mysqlFetchArray($sql_listall2)) 
	 {
            if($row_listall2['pym_name']=='Credit / Debit'){
           $paymode='Card';
             }else if($row_listall2['pym_name']=='Complimentary'){
               $paymode='Comp';   
             }else if($row_listall2['pym_name']=='Credit Types'){
               $paymode='Credit';     
             }else{
                $paymode=$row_listall2['pym_name']; 
             }
            
            
            
        }}
         ?>
                          
                <td width="14%" style="font-size: 8px;font-weight: bold"><?=$paymode?></td> 
      
      </tr>
       <?php } }else { ?>
       <td colspan="4" style="font-weight:bold">No records to display</td>
       <?php } ?>
       
     </table> 
    <?php
	
}else if($_REQUEST['value']=="load_ta_bildetails")
{
	
	$billno=$_REQUEST['billno'];
	$total=0;
        $p=0;
	$sql_combo=" select  cbd.cbd_combo_preference,cbd.cbd_id, cbd.cbd_count_combo_ordering, cbd.cbd_billno, cbd.cbd_combo_id, cbd.cbd_combo_pack_id, cbd.cbd_slno, cbd.cbd_combo_qty, cbd.cbd_combo_pack_rate, cbd.cbd_combo_total_rate, cbd.cbd_menu_id, cbd.cbd_menu_qty, cbd.cbd_combo_preference, cbd.cbd_entry_date, cbd.cbd_dayclosedate, cbd.cbd_order_status, cbd.cloud_sync, 
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


                <div style="height:auto" class="right_bill_history_detail tr_clone" qtyval="<?=$result_combo['cbd_combo_qty']?>"  name="tr_clone">
                     <input type="hidden" value="<?=$result_combo['cbd_combo_qty']?>">
                        <div style="width: 5%;"  class="bil_his_sl_no slmyno">
                        <?php if($row_listall['cbd_cancel']=='N' &&  $_SESSION['s_canceleachinhistory']=="Y" ){ ?>
                                    <a  width="10%" class="canceleachitem bill_history_close_btn" billno="<?=$billno ?>"  style="cursor:pointer">X</a>
                            <?php } ?>

                                <?=$p?>
                        </div>
                     <div class="bil_his_dish_name" style="width: 40%;overflow: hidden"><?=strtoupper($result_combo['cn_name'].' '.$result_combo['cp_pack_name'])?></div>
                        <div style="width: 18%;font-size: 12px;line-height: 11px;" class="bil_his_sl_no">COMBO</div>
                        <div style="width: 9%;" class="bil_his_sl_no"><?=$result_combo['cbd_combo_qty']?> </div>
                        <div  width="12%" class="bil_his_sl_no"><?=number_format($result_combo['cbd_combo_pack_rate'],$_SESSION['be_decimal'])?> 
                                                    <span style="color:#F00"></span>
                        </div>
                        <div style="width:14%" class="bil_his_sl_no"> .
                                                 
                        </div>
                         <?php if($result_combo['cbd_combo_preference']!=''){ ?> 
                    <div  style="width: 100%;text-align: left;padding: 2px;height: auto;text-transform: lowercase" class="bil_his_sl_no">
                        
                        PREF: <?=rtrim($result_combo['cbd_combo_preference'],',')?>
                        
                    </div> 
                    <?php } ?>
                        

                    </div>
                    <div class="locate"></div>

            <?php          
            }
        }
	
        
        $sts_cs='';
     $sql_listall2  =  $database->mysqlQuery("SELECT tab_status from tbl_takeaway_billmaster WHERE tab_billno='".$billno."' "); 
	$num_listall2  = $database->mysqlNumRows($sql_listall2);
	if($num_listall2){
		  while($row_listall2  = $database->mysqlFetchArray($sql_listall2)) 
			  {
                      
                      $sts_cs=$row_listall2['tab_status'];
                  }
                  }
        
                  
           $sql_listall  =  $database->mysqlQuery("SELECT *,mn.mr_menuid,mr_menuname  from tbl_takeaway_billdetails as bd LEFT JOIN tbl_menumaster as mn 	ON bd.tab_menuid=mn.mr_menuid LEFT JOIN tbl_portionmaster as pm ON bd.tab_portion=pm.pm_id left join tbl_unit_master um on um.u_id=bd.tab_unit_id left join tbl_base_unit_master bum on bum.bu_id=bd.tab_base_unit_id WHERE bd.tab_billno='".$billno."' and tab_count_combo_ordering IS NULL order by bd.tab_slno "); 
	$num_listall  = $database->mysqlNumRows($sql_listall);
	if($num_listall){$item_count_replace=0;
		  while($row_listall  = $database->mysqlFetchArray($sql_listall)) 
			  {  $item_count_replace++;
        }}
                  
        
	 $sql_listall  =  $database->mysqlQuery("SELECT *,mn.mr_menuid,mr_menuname  from tbl_takeaway_billdetails as bd LEFT JOIN tbl_menumaster as mn 	ON bd.tab_menuid=mn.mr_menuid LEFT JOIN tbl_portionmaster as pm ON bd.tab_portion=pm.pm_id left join tbl_unit_master um on um.u_id=bd.tab_unit_id left join tbl_base_unit_master bum on bum.bu_id=bd.tab_base_unit_id WHERE bd.tab_billno='".$billno."' and tab_count_combo_ordering IS NULL order by bd.tab_slno "); 
	$num_listall  = $database->mysqlNumRows($sql_listall);
	if($num_listall){$i=1;
		  while($row_listall  = $database->mysqlFetchArray($sql_listall)) 
			  {  $p++;

                                    $billhistory_menuidcs=$row_listall['mr_menuid'];
                                    $billhistory_menucs=$row_listall['mr_menuname'];
                                    if($row_listall['tab_rate_type']=='Portion'){
                                                $billhis_portion_ta=$row_listall['pm_portionname'];
                                                }
                                    else if($row_listall['tab_rate_type']=='Unit'){
                                    if($row_listall['tab_unit_type']=='Packet'){
                                        $billhis_portion_ta=$row_listall['tab_unit_type'].' : '.number_format($row_listall['tab_unit_weight'],$_SESSION['be_decimal']).' '.$row_listall['u_name'];
                                    }
                                    else if($row_listall['tab_unit_type']=='Loose'){
                                        $billhis_portion_ta=$row_listall['tab_unit_type'].' : '.number_format($row_listall['tab_unit_weight'],$_SESSION['be_decimal']).' '.$row_listall['bu_name'];
                                    }
                                }
                                  
                                  if($_SESSION['main_language']!='english'){
                                      
                                    $sql_arabmenu=$database->mysqlQuery("SELECT lm_menu_name FROM tbl_language_menu_master left join tbl_languages on ls_id=lm_language_id WHERE lm_menu_id='".$billhistory_menuidcs."' and ls_language='".$_SESSION['main_language']."'");
                                    
                                                        //echo " SELECT mm_name FROM tbl_language_menu_sub left join tbl_languages on ls_id=mm_lang_id WHERE mm_sub_category_id='".$result_subcat['subid']."' and ls_language='".$dat."'";
                                    $num_arabmenu = $database->mysqlNumRows($sql_arabmenu);
                                    $result_arabmenu = $database->mysqlFetchArray($sql_arabmenu);
                                    $billhistory_menucs=$result_arabmenu['lm_menu_name'];
                                    // $catid['name'][] = $catname;
                                    //echo $catname;
                                    }

				 $total=$total + $row_listall['tab_amount'];
                                 $dyn='';
                                  if($row_listall['tab_dynamic_rate']=='Y'){
                                               $dyn=' [Dyn]';
                                          }
                                 
				 ?>
                 
                    <div style="height:auto" class="right_bill_history_detail tr_clone" qtyval="<?=$row_listall['tab_qty'] ?>" slno="<?=$row_listall['tab_slno'] ?>" name="tr_clone">
                 <input type="hidden" value="<?=$row_listall['tab_qty'] ?>" class="tr_clone_add1<?=$row_listall['tab_slno'] ?>">
                    <div  style="width: 5%;" class="bil_his_sl_no slmyno">
                    <?php if($row_listall['tab_cancelled']=='N' &&  $_SESSION['s_canceleachinhistory']=="Y" ){ ?>
                    		<a class="canceleachitem bill_history_close_btn" billno="<?=$billno ?>" slno="<?=$row_listall['tab_slno'] ?>" style="cursor:pointer">X</a>
                        <?php } ?>
                    
                    	<!--<a style="background-color:transparent;top: -2px; position: relative;" class="bill_history_close_btn"><img src="img/black_cross.png"></a>-->
						<?=$p?>
                    </div>
                    <div class="bil_his_dish_name" style="width:40%;"><?php if($row_listall['tab_bill_addon_slno']!=''){ ?> <span style="color: red">(AD)</span> <?php } ?><?=$billhistory_menucs ?></div>
                    <div style="width: 18%;font-size: 12px;" class="bil_his_sl_no"><?=$billhis_portion_ta.$dyn ?></div>
                    <div style="width: 9%;" class="bil_his_sl_no">
                    	<?php //if($row_listall['bd_cancelled']=='N'){ ?>
						
                       <!-- <input type="text" value="<?=$row_listall['bd_qty'] ?>" style="width: 38px;text-align: center; color:#000;    height: 23px;" class="tr_clone_add" >-->
                        <?php //}else{ 
                        echo $row_listall['tab_qty']; 
                         //} ?>
                    </div>
                    <div style="width: 12%;" class="bil_his_sl_no"><?=number_format($row_listall['tab_rate'],$_SESSION['be_decimal'])?>
						<span style="color:#F00"> <?php //if($row_listall['bd_cancelled']=='Y')echo "*"; ?></span>
                    </div>
                    
                    
                     <?php if($_SESSION['bill_edit']=='Y'){ ?>
                     <div  style="width: 16%;" class="bil_his_sl_no">
                         
                        <a onclick="return delete_bill_item_normal('<?=$billno?>','<?=$row_listall['tab_slno'] ?>','<?=$sts_cs?>');" href="#" style="margin:2px 0 0 2px" class="tab_edt_btn"><img src="img/red_cross.png" style="width:33%;height: auto" ></a>
                 
                     <?php if($item_count_replace==1){ ?>
                        <a onclick="return replace_bill_item('<?=$billno?>','<?=$row_listall['tab_slno'] ?>','<?=$sts_cs?>');" href="#" style="margin:2px 0 0 2px" class="tab_edt_btn"><img style="width:33%;height: auto" src="img/refresh.png"></a>
                    <?php } ?>
                     
                     </div>
                     <?php } ?>
                    
                    <?php if($row_listall['tab_preferencetext']!=''){ ?> 
                    <div  style="width: 100%;text-align: left;padding: 2px;height: auto;" class="bil_his_sl_no">
                        
                      * PREF : <?=rtrim($row_listall['tab_preferencetext'],',')?>
                        
                    </div> 
                    <?php } ?>
                    
                    
                    
                </div><!--right_bill_history_detail-->
                <div class="locate<?=$row_listall['tab_slno'] ?>"></div>
                
                 <?php
			  }
	}if($p==0)
	{
		echo "Nothing to display";

	}
	
	?>
     <script src="js/bill_ta_historycanceleach.js"></script>
   
    
    <?php

	
}
else if($_REQUEST['value']=="load_ta_settlement")
{ 
$paymode='';
$bm_amountpaid='';
$bm_amountbalace='';
$bm_transactionamount='';
$bm_couponcompany='';
$bm_couponamt='';
$bm_vouchername='';
$bm_vouchercost='';
$bm_chequeno='';
$bm_chequebankname='';
$bm_chequebankamount='';
$bm_name='';
$payid='';
$cancel='';
//`tbl_takeaway_billmaster`(`tab_billno`, `tab_date`, `tab_time`, `tab_branchid`, `tab_subtotal`, `tab_servicecharge`, `tab_netamt`, `tab_kotno`, `tab_hd`, `tab_customername`, `tab_customermobile`, `tab_hdcustomerid`, `tab_status`, `tab_assignedto`, `tab_esttime`, `tab_assignedtime`, `tab_paymode`, `tab_cancelamount`, `tab_discountid`, `tab_corporatecode`, `tab_discountvalue`, `tab_vat`, `tab_complimentary`, `tab_complimentaryremark`, `tab_amountpaid`, `tab_amountbalace`, `tab_transactionamount`, `tab_voucherid`, `tab_couponcompany`, `tab_couponamt`, `tab_chequeno`, `tab_chequebankname`, `tab_chequebankamount`, `tab_dayclosedate`, `tbl_takeaway_printed`, `tbl_takeaway_print_time`)
	$sql_billhis="select *  from tbl_takeaway_billmaster as bm LEFT JOIN  tbl_paymentmode as pm ON bm.tab_paymode=pm.pym_id LEFT JOIN"
                . " tbl_bankmaster as bk ON bk.bm_id=bm.tab_transcbank  WHERE bm.tab_billno='".$_REQUEST['billno']."'";
	$sql_billhistory  =  $database->mysqlQuery($sql_billhis); 
	$num_billhistory  = $database->mysqlNumRows($sql_billhistory);
	if($num_billhistory)
	{
		while($result_billhistory  = $database->mysqlFetchArray($sql_billhistory)) 
			{
				$paymode=$result_billhistory['pym_name'];
				$payid=$result_billhistory['tab_paymode'];
				if( $paymode=="Cash")
				{
				$bm_amountpaid=$result_billhistory['tab_amountpaid'];
				$bm_amountbalace=$result_billhistory['tab_amountbalace'];
				}else if( $paymode=="Credit / Debit")
				{
					$bm_amountpaid=$result_billhistory['tab_amountpaid'];
					$bm_amountbalace=$result_billhistory['tab_amountbalace'];
					$bm_transactionamount=$result_billhistory['tab_transactionamount'];
					//$bm_name=$result_billhistory['bm_name'];
					
				}
				else if( $paymode=="Coupons")
				{
					$bm_amountpaid=$result_billhistory['tab_amountpaid'];
					$bm_amountbalace=$result_billhistory['tab_amountbalace'];
					$bm_couponcompany=$result_billhistory['tab_couponcompany'];
					$bm_couponamt=$result_billhistory['tab_couponamt'];
					
				}else if( $paymode=="Voucher")
				{
					$bm_amountpaid=$result_billhistory['tab_amountpaid'];
					$bm_amountbalace=$result_billhistory['tab_amountbalace'];
					$bm_vouchername=$result_billhistory['vr_vouchername'];
					$bm_vouchercost=$result_billhistory['vr_vouchercost'];
					
				} else if( $paymode=="Cheque")
				{
					$bm_amountpaid=$result_billhistory['tab_amountpaid'];
					$bm_amountbalace=$result_billhistory['tab_amountbalace'];
					$bm_chequeno=$result_billhistory['tab_chequeno'];
					$bm_chequebankname=$result_billhistory['tab_chequebankname'];
					$bm_chequebankamount=$result_billhistory['tab_chequebankamount'];
					
				} 
                                 else if( $paymode=="Credit Types")
				{
					$bm_amountpaid=$result_billhistory['tab_amountpaid'];
					
					
				} 
                                
                                
                                
				$total=$result_billhistory['tab_netamt'];
				$cancel=$result_billhistory['tab_cancelled'];
				
			}
	}
        
        
        
        
         $sql_branch1 =  mysqli_query($localhost,"Select bm.bm_name from tbl_bankmaster bm left join tbl_bill_card_payments "
                . " bc on bc.mc_to_bank=bm.bm_id  where  mc_billno='".$_REQUEST['billno']."' group by bc.mc_to_bank "); 
		  $num_branch1  = mysqli_num_rows($sql_branch1);
		  if($num_branch1)
		  {
				while($result_branch1  = mysqli_fetch_array($sql_branch1)) 
					{
						 $bm_name.= $result_branch1['bm_name'].',';
					}
		  }
        
        
        
        $sql_login_stf  =  $database->mysqlQuery("select * from tbl_staffmaster where ser_staffid='".$_SESSION['loginempid_id']."' "); 
	               $num_login_stf   = $database->mysqlNumRows($sql_login_stf);
	               if($num_login_stf){
		          while($result_login_stf  = $database->mysqlFetchArray($sql_login_stf)) 
		        {
                              
                                



                              $regenerate_staff=$result_login_stf['ser_bill_regen_per'];
                              $bill_reprint_staff=$result_login_stf['ser_bill_reprint_per'];
                              $kot_reprint_staff=$result_login_stf['ser_kot_reprint_per'];
                              $change_staff=$result_login_stf['ser_bill_settle_change_per'];
                       } }   
        
        
?>
 			 <?php
                                          
                        ?>		  
 			<table width="100%" class="none_border_table final_net"  tot="<?=$total?>" style="border-bottom:1px #ccc solid;">
                         <tr>
                            <td width="18%"><strong>Payment Mode</strong></td>
                            <td width="35%" class="paymentids" payid="<?=$payid ?>"><?=$paymode?></td>
                         </tr> 
                        
                         </table>
                         <table width="100%" class="none_border_table" style="border-bottom:1px #ccc solid;">
                         
                          <tr>
                            <td width="18%"><strong>Amount</strong></td>
                            <td width="35%" class="totalamt" amttot="<?= $total?>"><?=number_format($total,$_SESSION['be_decimal'])?></td>
                         </tr> 
                         </table>
                      <div class="settle_ment_detail_paid_cc">     
                         <table width="100%" class="none_border_table" border="0">
                             
                            <?php  if( $paymode=="Credit Types")
				{ ?> 
                             
                          <tr>
                            <td width="33%"><span class="bill_story_center_top_txt">Credit Amount : </span>
                            <span class="bill_story_center_txt"><?=number_format(($total-$bm_amountpaid),$_SESSION['be_decimal'])?>/-</span>
                            </td>
                             <td width="33%"><span class="bill_story_center_top_txt"></span>
                            <span class="bill_story_center_txt"></span>
                            </td>
                          </tr>   
                               <?php } ?> 
                              
                             
                             
                        <tr>
                            <td width="33%"><span class="bill_story_center_top_txt">Amount Paid:</span>
                            <span class="bill_story_center_txt"><?=number_format($bm_amountpaid,$_SESSION['be_decimal'])?>/-</span>
                            </td>
                             <td width="33%"><span class="bill_story_center_top_txt">Balance Amount:</span>
                            <span class="bill_story_center_txt"><?=number_format($bm_amountbalace,$_SESSION['be_decimal'])?>/-</span>
                            </td>
                          </tr>
                         <?php if( $paymode=="Credit / Debit")
							{ ?> 
                          <tr>
                            <td width="33%"><span class="bill_story_center_top_txt">Transaction Amount:</span>
                            <span class="bill_story_center_txt"><?=number_format($bm_transactionamount,$_SESSION['be_decimal'])?>/-</span>
                            </td>
                             <td width="33%"><span class="bill_story_center_top_txt">Transaction Bank:</span>
                            <span class="bill_story_center_txt"> <?=substr($bm_name,0,-1)?> </span>                            
                            </td>
                          </tr>
                     <?php } ?> 
                      <?php if( $paymode=="Coupons")
							{ ?> 
                          <tr>
                            <td width="33%"><span class="bill_story_center_top_txt">Coupon Name:</span>
                            <span class="bill_story_center_txt"><?=$bm_couponcompany?></span>
                            </td>
                             <td width="33%"><span class="bill_story_center_top_txt">Coupon Amount:</span>
                            <span class="bill_story_center_txt"><?=number_format($bm_couponamt,$_SESSION['be_decimal'])?></span>                            
                            </td>
                          </tr>
                     <?php } ?>    
                    
                     <?php if( $paymode=="Voucher")
							{ ?> 
                          <tr>
                            <td width="33%"><span class="bill_story_center_top_txt">Voucher Name:</span>
                            <span class="bill_story_center_txt"><?=$bm_vouchername?></span>
                            </td>
                             <td width="33%"><span class="bill_story_center_top_txt">Voucher Cost:</span>
                            <span class="bill_story_center_txt"><?=number_format($bm_vouchercost,$_SESSION['be_decimal'])?></span>                            
                            </td>
                          </tr>
                     <?php } ?> 
                    
                     <?php if( $paymode=="Cheque")
							{ ?> 
                          <tr>
                            <td width="33%"><span class="bill_story_center_top_txt">Cheque No:</span>
                            <span class="bill_story_center_txt"><?=$bm_chequeno?>/-</span>
                            </td>
                             <td width="33%"><span class="bill_story_center_top_txt">Bank Name:</span>
                            <span class="bill_story_center_txt"><?=$bm_chequebankname?></span>                            
                            </td>
                            </tr>
                             <tr>
                            <td width="33%"><span class="bill_story_center_top_txt">Cheque Amount:</span>
                            <span class="bill_story_center_txt"><?=number_format($bm_chequebankamount,$_SESSION['be_decimal'])?></span>                            
                            </td>
                          </tr>
                     <?php } ?>     
                        </table>  
                        <?php if($cancel=="N") { ?>
                        <div class="bill_his_buton_cc" style="padding-bottom:5px;height:auto;">
                            
                            
                          
                        <div style="top:1px" class="bill_cancel_btn" mode="CS" id="reprintbill_ta">
                            <a href="#">Reprint</a>
                        </div>
                         
                        <?php
                          $sql_cncl  =  $database->mysqlQuery("select sm.ser_bill_cancel_permission FROM tbl_logindetails ld
                                                left join tbl_staffmaster sm on sm.ser_staffid = ld.ls_staffid
                                                where ld.ls_username = '".$_SESSION['expodine_id']."'"); 
                                                $num_stf   = $database->mysqlNumRows($sql_cncl);
                                                if($num_stf)
                                                {
                                                    $result_stf  = $database->mysqlFetchArray($sql_cncl);
                                                    $billpermss=$result_stf['ser_bill_cancel_permission'];
                                                }
                         if($_SESSION['status_cancel']=='show' ){ 
                        
                        ?>
                            
                            
                        
                        <a  class="cancel_billta_history" id="cancel_billta_history" mode="CS" bilno="<?=$_REQUEST['billno']?>" >Cancel</a>
                        <?php } } ?>
                        </div>
                      
            		</div>
                    <script src="js/bill_ta_historycanceleach.js"></script>
<?php
} else if($_REQUEST['value']=="load_ta_bildetls")
{
	
	$billno=$_REQUEST['billno'];
	//`tbl_takeaway_billmaster`(`tab_billno`, `tab_date`, `tab_time`, `tab_branchid`, `tab_subtotal`, `tab_servicecharge`, `tab_netamt`, `tab_kotno`, `tab_hd`, `tab_customername`, `tab_customermobile`, `tab_hdcustomerid`, `tab_status`, `tab_assignedto`, `tab_esttime`, `tab_assignedtime`, `tab_paymode`, `tab_cancelamount`, `tab_discountid`, `tab_corporatecode`, `tab_discountvalue`, `tab_vat`, `tab_complimentary`, `tab_complimentaryremark`, `tab_amountpaid`, `tab_amountbalace`, `tab_transcbank`, `tab_transactionamount`, `tab_voucherid`, `tab_couponcompany`, `tab_couponamt`, `tab_chequeno`, `tab_chequebankname`, `tab_chequebankamount`, `tab_dayclosedate`, `tbl_takeaway_printed`, `tbl_takeaway_print_time`, `tab_mode`)
	$bm_billno='';
	$bm_dayclosedate='';
	$bm_billtime='';
	$bm_finaltotal='';
	$bm_serv='0';
	$bm_billprinted='';
	$bm_lastprintime='';
	$bm_status='';
	$bm_name='';
	$bm_mode='';
	$bm_totpax=0;
	$bm_esttime='';
	$bm_customername ='';
	$bm_customermobile ='';
	$bm_address='';
	$bm_landmark='';	
	$bm_area='';
	$disc_bill=0; $disc_value=0;				
	$mode=''; $bm_gen=''; $ref_pax=''; $adv='';
	//$sql_bilhis= "Select tb.tab_billno, ts.tac_customername,ts.tac_contactno,tb.tab_status  From tbl_takeaway_billmaster as tb LEFT JOIN tbl_takeaway_customer ts ON ts.tac_customerid=tb.tab_hdcustomerid Where tb.tab_dayclosedate ='".$_SESSION['date']."' ORDER BY   tb.tab_date,tb.tab_time DESC ";
	 $sql_billhis="select *  from tbl_takeaway_billmaster as bm  LEFT JOIN tbl_staffmaster as sm ON sm.ser_staffid=bm.tab_assignedto LEFT JOIN "
         . " tbl_takeaway_customer as ts ON ts.tac_customerid=bm.tab_hdcustomerid WHERE bm.tab_billno='".$billno."'";
	$sql_billhistory  =  $database->mysqlQuery($sql_billhis); 
	$num_billhistory  = $database->mysqlNumRows($sql_billhistory);
	if($num_billhistory)
	{
		while($result_billhistory  = $database->mysqlFetchArray($sql_billhistory)) 
			{
				$bm_billno=$result_billhistory['tab_billno'];
				//$bm_dayclosedate=$result_billhistory['bm_dayclosedate'];
				$bm_billtime=$result_billhistory['tab_time'];
                                $bm_kotno=$result_billhistory['tab_kotno'];
				$bm_finaltotal=$result_billhistory['tab_netamt'];
				$bm_serv=$result_billhistory['tab_customer_display_status'];
				$bm_billprinted=$result_billhistory['tbl_takeaway_printed'];
				$bm_lastprintime=$result_billhistory['tbl_takeaway_print_time'];
				$bm_status=$result_billhistory['tab_status'];
                                $ta_dayclose_pin=$result_billhistory['tab_dayclosedate'];
				 $bm_name=$result_billhistory['ser_firstname'];
				$bm_esttime=$result_billhistory['tab_esttime'];
				$bm_mode=$result_billhistory['tab_mode'];
                                $bm_printed_by=$result_billhistory['tab_bill_printed_by'];
				if($bm_mode=="HD") $mode="Home Delivery";
				else if($bm_mode=="CS") $mode="CS";
				else if($bm_mode=="TA") $mode="Take Away";
				//$bm_totpax=$result_billhistory['bm_totalpax'];
				$bm_subtotal=$result_billhistory['tab_subtotal'];
				$bm_dayclosedate=$database->convert_date($result_billhistory['tab_dayclosedate']);
				
                                $bm_gen=$result_billhistory['tab_loginid'];
				
				$cust=$database->show_customer_list($result_billhistory['tab_hdcustomerid']);
				
				$bm_customername =$cust['tac_customername'];
				$bm_customermobile =$cust['tac_contactno'];
				$bm_address=$result_billhistory['tac_address'];
				$bm_landmark=$result_billhistory['tac_landmark'];	
				$bm_area=$result_billhistory['tac_area'];
                                $tips_given=number_format(str_replace(',','',$result_billhistory['tab_tips_given']),$_SESSION['be_decimal']);
				$tab_lukado_response=$result_billhistory['tab_lukado_response'];  
				$ref_pax=$result_billhistory['tab_no_pax'];
				
                                $disc_bill=$result_billhistory['tab_discountvalue'];
                                $disc_value=$result_billhistory['tab_discount_label'];
                                
                                
                                if($result_billhistory['tab_adv_orderno']!=''){
                                    
                                    $adv='[ADV-'.$result_billhistory['tab_adv_orderno'].']';
                                }
                                
			}
	}
	?>
  
    <table width="100%" class="none_border_table" border="0">
      <tr>
        <td width="50%" colspan="2"><strong class="bill_story_center_top_txt">Bill No:</strong>
        <span class="bill_story_center_txt" style="color:#AB2426"><strong><strong><?=$bm_billno?></strong></strong></span>
        </td>
         <td width="50%"  ><strong class="bill_story_center_top_txt">Date:</strong>
        <span class="bill_story_center_txt" ><?=$bm_dayclosedate?></span>
        </td>
      </tr>  
    <tr>
    <tr>
         <td width="33%"><span class="bill_story_center_top_txt">Time:</span>
        <span class="bill_story_center_txt"><?=$bm_billtime?></span>
        </td>
        <td width="33%"><span  class="bill_story_center_top_txt">Type:</span>
        <span class="bill_story_center_txt"><?=$mode?> &nbsp; <?=$adv?></span>
        </td>
         <td width="33%"><span class="bill_story_center_top_txt"><strong>Status:</strong></span>
        <span class="bill_story_center_txt"><strong><?=$bm_status?></strong></span>
        </td>
      </tr>
       <tr>
        <td width="33%"><span class="bill_story_center_top_txt">Sub total</span>
        <span class="bill_story_center_txt" style="color:#AB2426"><?=number_format($bm_subtotal,$_SESSION['be_decimal'])?></span>
        </td>
        <td width="33%"><span class="bill_story_center_top_txt">Customer Status:</span>
        <span class="bill_story_center_txt"><?=$bm_serv?></span>
        </td>
         <td width="33%"><span class="bill_story_center_top_txt"><strong>Net Amount:</strong></span>
        <span class="bill_story_center_txt"><strong><?=number_format($bm_finaltotal,$_SESSION['be_decimal'])?></strong></span>
        </td>
      </tr>
      <tr>
         <td width="33%"><span class="bill_story_center_top_txt">Bill Printed:</span>
        <span class="bill_story_center_txt"><?php if($bm_billprinted=='Y'){ echo 'Yes';} else{ echo 'No'; }?></span>
        </td>
        <td width="33%"><span  class="bill_story_center_top_txt">Last Printed Time:</span>
        <span class="bill_story_center_txt"><?=$bm_lastprintime?></span>
        </td>
       <td width="33%"><span  class="bill_story_center_top_txt">Bill Printed by:</span>
        <span class="bill_story_center_txt"><?=$bm_printed_by?></span>
        </td>
        
      </tr>
      </tr> 
      <?php if($bm_name!='') { ?>
      <tr>
        <td width="33%"><span class="bill_story_center_top_txt">Assigned to:</span>
        <span class="bill_story_center_txt"><?=$bm_name?></span>
        </td>
         <td width="33%"><span class="bill_story_center_top_txt">Estimated Time:</span>
        <span class="bill_story_center_txt"><?=$bm_esttime?></span>
        </td>
       
      </tr>
      <?php } ?>
       <tr>
        <td width="33%"><span class="bill_story_center_top_txt">Customer Name</span>
        <span class="bill_story_center_txt" style="color:#AB2426"><?=$bm_customername?></span>
        </td>
        <td width="33%"><span class="bill_story_center_top_txt">Customer Mobile:</span>
        <span class="bill_story_center_txt"><?=$bm_customermobile?></span>
        </td>
         <td width="33%"><span class="bill_story_center_top_txt">Address:</span>
        <span class="bill_story_center_txt"><?=$bm_address?></span>
        </td>
      </tr>
       <tr>
        <td width="33%"><span class="bill_story_center_top_txt">LandMark</span>
        <span class="bill_story_center_txt" style="color:#AB2426"><?=$bm_landmark?></span>
        </td>
        <td width="33%"><span class="bill_story_center_top_txt">Area:</span>
        <span class="bill_story_center_txt"><?=$bm_area?></span>
        </td>
        <td width="33%"><span class="bill_story_center_top_txt">KOT NO:</span>
        <span class="bill_story_center_txt"><?=$bm_kotno?></span>
        </td>
        </tr>
        
        <tr>
        <td width="33%"><span class="bill_story_center_top_txt">Bill Generated By</span>
        <span class="bill_story_center_txt" style="color:#AB2426"><?=$bm_gen?></span>
        </td>
        
        <td width="33%"><span class="bill_story_center_top_txt">No Ref/Pax</span>
        <span class="bill_story_center_txt" style="color:#AB2426"><?=$ref_pax?></span>
        </td>
        
        
        <?php if($tab_lukado_response!='' && $tab_lukado_response!='NULL'){ 
                                    
                                  if (strpos($tab_lukado_response,'success') !== false) { 
                                    ?>
         <td width="33%"><span class="bill_story_center_top_txt">Lukado</span>
                              <span class="bill_story_center_txt" style="color:#AB2426">Success</span>
                                 </td>
                                  <?php }else{ ?>
                              <td width="33%"><span class="bill_story_center_top_txt">Lukado</span>   
                               <span class="bill_story_center_txt" style="color:#AB2426">Error</span>
                                 </td>
        <?php } } ?>
        
        </tr>
        
      		<td colspan="3">
            <table width="100%">
        	<tbody>
                    
                 <?php
              $sql_billhis45="select tab_name,tab_phone,tab_gst from tbl_takeaway_billmaster where tab_billno='".$billno."'";
	$sql_billhistory45 =  $database->mysqlQuery($sql_billhis45); 
	$num_billhistory45 = $database->mysqlNumRows($sql_billhistory45);
	if($num_billhistory45)
	{
		while($result_billhistory45  = $database->mysqlFetchArray($sql_billhistory45)) 
			{
                    
                    $bmname=$result_billhistory45['tab_name'];
                      $bmphone=$result_billhistory45['tab_phone'];
                        $bmgst=$result_billhistory45['tab_gst'];
                            
                    
                        }
                        
                }
              ?>      
                    
                    
                    
            <tr>
                <td width="30%">
                    <span class="bill_story_center_top_txt">Customer Name:</span>
                     <input type="hidden" id="bilcus" value="<?=$billno?>" />
                    <input type="text" class="bill_story_center_txt" id="csname"  value="<?=$bmname?>"/>
                </td>
                <td width="30%">
                    <span class="bill_story_center_top_txt">Number:</span>
                    <input type="text" class="bill_story_center_txt" id="csphone"  onkeypress="return numonly();"  value="<?=$bmphone?>" />
                </td>
                <td width="30%">
                    <span class="bill_story_center_top_txt">GST/TRN/VAT</span>
                    <input type="text" class="bill_story_center_txt"id="csgst"  value="<?=$bmgst?>" />
                </td>
                 <td width="10%">
                    <a href="#"  onclick="return submitcustomer();" ><span class="history-sub-btn"><img src="img/attendence_mn_ico.png" /></span></a>
                </td>
              </tr>
              </tbody>
              </table>  
        </tr>
         
      </tr>
     </table>
                    <div class="bill_histor_tax_sec">
       <?php 
        $sql_billhis_tax="select bem.tbe_total_value, bem.tbe_label  FROM tbl_takeaway_bill_extra_tax_master bem where bem.tbe_billno='".$billno."'";
	$sql_billhistory_tax =  $database->mysqlQuery($sql_billhis_tax); 
	$num_billhistory_tax = $database->mysqlNumRows($sql_billhistory_tax);
	if($num_billhistory_tax)
	{
		while($result_billhistory_tax  = $database->mysqlFetchArray($sql_billhistory_tax)) 
			{?>
  	  
   	  <div class="bill_histor_tax_sec_box">
	    <span  class="bill_story_center_top_txt"><?=$result_billhistory_tax['tbe_label']?></span>
	    <span style="width: 98%;height:auto" class="bill_story_center_txt"><strong><?=number_format($result_billhistory_tax['tbe_total_value'],$_SESSION['be_decimal'])?></strong></span>
	  </div> 
        <?php }} ?>
   </div>
                    
                    
       <?php if($disc_bill>0){ ?>  
                    
        <div class="bill_histor_tax_sec_box" style="width:45%">
	    <span  class="bill_story_center_top_txt">Discount <?=$disc_value?></span>
	    <span style="width: 98%;height:auto" class="bill_story_center_txt"><strong><?=number_format($disc_bill,$_SESSION['be_decimal'])?></strong></span>
	</div>  
                    
        <?php } ?>           
                                
                    
                    
                    
    <div class="bill_histor_tax_sec_box">
        <span class="text_tip"><strong>**Tip</strong></span>
	<a href="#"  class="<?php if(($bm_status!='Cancelled') && ($ta_dayclose_pin==$_SESSION['date'])) { ?> tip_add_button <?php } ?> input_tip_btn"><span class="history-sub-btn">ADD TIP</span></a><input class="input_tip_textbox" type="text" onkeypress="return charlimit(event,this.value)" value="<?=$tips_given?>" id="tip_feild" <?php if( ($bm_status=='Cancelled' ) || ($ta_dayclose_pin!=$_SESSION['date'])  ) { ?> readonly <?php } ?> style="width: 28%;float: right">
        <select class="tax_textbox transa_txt counter_text_box" id="tip_pay_mode" style="width: 22%;float: right;margin-right: 5px">
            <option value="C">CASH</option>
            <option value="D">CARD</option>
        </select>
    </div>
    <script>
     $('.tip_add_button').click(function (){
            $('.kotcancel_reason_popup_new').css('display','block');
            $('.confrmation_overlay').css('display','block');
            $('#authcodersn').css('display','none');
            $('#kotcancel_reason_popup_new_proceed_btn').addClass('tip_click');
            $('#pin').val('');
            $('#pin').focus();
             $('#rprntmode').val('');
    });
     
    </script>
   
  
     
    
    <?php
	
	

}else if($_REQUEST['value']=="loadtahistory_date")
{//billno="+billno+"&name="+name+"&nos="+nos+"&statuss="+statuss,

	$string='';
	
	
	/*if(($_REQUEST['billno']!="null"))
	{
		$string.=" AND  tab_billno LIKE '%".$_REQUEST['billno']."%'";
	}
	if(($_REQUEST['name']!="null"))
	{
		$string.=" AND  tab_customername LIKE '%".$_REQUEST['name']."%'";
	}
	if(($_REQUEST['nos']!="null"))
	{
		$string.=" AND  tab_customermobile LIKE '%".$_REQUEST['nos']."%'";
	}
	if(($_REQUEST['statuss']!="null"))
	{
		$string.=" AND  tab_status LIKE '%".$_REQUEST['statuss']."%'";
	}*/
	?>
    <script src="js/takeaway_hist.js"></script>
   <table class="new_fnt" width="100%"  border="0"> <!----bill_history_active--->
	<?php
  //  $sql_bilhis="select tab_billno,	tab_customername,tab_status,tab_customermobile,tab_status  from tbl_takeaway_billmaster WHERE 	tab_dayclosedate='".$_REQUEST['datefield']."'   ORDER BY 	tab_date,tab_time DESC";
  $sql_bilhis= "Select tb.tab_paymode, tb.tab_billno,tb.tab_dayclosedate, ts.tac_customername,ts.tac_contactno,tb.tab_status  From tbl_takeaway_billmaster as tb LEFT JOIN tbl_takeaway_customer ts ON ts.tac_customerid=tb.tab_hdcustomerid Where tb.tab_dayclosedate ='".$_REQUEST['datefield']."' and tab_mode='CS' AND tb.tab_billno not like 'Temp%' AND tb.tab_billno not like 'HOLD%' ORDER BY   tb.tab_date,tb.tab_time DESC ";
    $sql_bilhistory  =  $database->mysqlQuery($sql_bilhis); 
    $num_bilhistory  = $database->mysqlNumRows($sql_bilhistory);
    if($num_bilhistory)
    {$i=1;
        while($result_bilhistory  = $database->mysqlFetchArray($sql_bilhistory)) 
            { $cur_date= $_SESSION['date'];
                ?><!--bill_history_number-->
      <tr class="ta_bill_history <?php if($result_bilhistory['tab_billno']==$_REQUEST['billno']){ ?> bill_history_active <?php } ?> <?php if($result_bilhistory['tab_billno']==$_REQUEST['bilno']){ ?> bill_history_active <?php } ?>" cur_date="<?=$cur_date?>" billdate="<?= $result_bilhistory['tab_dayclosedate'] ?>" user="<?= $_SESSION['designtnname']?>" billno="<?=$result_bilhistory['tab_billno']?>"  cancelstatus="<?=$result_bilhistory['tab_status']?>" >
        <td width="6%"><strong><?=$i++?></strong></td>
        <td width="27%"><?=$result_bilhistory['tab_billno']?></td>
         <td width="30%"><?=$result_bilhistory['tac_customername']?></td>
         <td width="20%"><?=$result_bilhistory['tac_contactno']?></td>
         <td width="17%"  ><span  class="<?php if($result_bilhistory['tab_status']=='Delivered') { ?> deliverd_1 <?php } else if($result_bilhistory['tab_status']=='Closed') { ?> closed_1 <?php } else if($result_bilhistory['tab_status']=='Packed') { ?> packed_clr <?php } else if($result_bilhistory['tab_status']=='Generated') { ?> genrate_clr<?php }  else if($result_bilhistory['tab_status']=='KOT_Generated') { ?> kot_genrated_clr<?php } else if($result_bilhistory['tab_status']=='Assigned') { ?> assigned_clr<?php } ?>"><?=$result_bilhistory['tab_status']?></span></td>
      
      <?php    
        $paymode='';   
        $sql_listall2  =  $database->mysqlQuery("SELECT pym_name from  tbl_paymentmode where pym_id='".$result_bilhistory['tab_paymode']."' limit 1 "); 
	$num_listall2  = $database->mysqlNumRows($sql_listall2);
	if($num_listall2){ 
	 while($row_listall2  = $database->mysqlFetchArray($sql_listall2)) 
	 {
             if($row_listall2['pym_name']=='Credit / Debit'){
           $paymode='Card';
             }else if($row_listall2['pym_name']=='Complimentary'){
               $paymode='Comp';   
             }else if($row_listall2['pym_name']=='Credit Types'){
               $paymode='Credit';     
             }else{
                $paymode=$row_listall2['pym_name']; 
             }
            
            
            
        }}
         ?>
                          
                <td width="14%" style="font-size: 8px;font-weight: bold"><?=$paymode?></td>       
      
      
      </tr>
       <?php } }else { ?>
       <td colspan="4" style="font-weight:bold">No Records To Display</td>
       <?php } ?>
       
     </table> 
    <?php
	
}else if($_REQUEST['value']=="billwholeload_ta")
{

	$string='';
        if(isset($_REQUEST['mode'])){
	$mode = " AND tab_mode='CS'";
        }else{
            $mode = " AND tab_mode!='CS'";
        }
//	$mode = " AND tab_mode!='CS'";
	?>
    <script src="js/takeaway_hist.js"></script>
   <table class="new_fnt" width="100%"  border="0"> <!----bill_history_active--->
	<?php
   // $sql_bilhis="select tab_billno,	tab_customername,tab_status,tab_customermobile,tab_status  from tbl_takeaway_billmaster WHERE 	tab_dayclosedate='".$_SESSION['date']."'   ORDER BY 	tab_date,tab_time DESC";
 //  $sql_bilhis= "Select tb.tab_billno, ts.tac_customername,ts.tac_contactno,tb.tab_status  From tbl_takeaway_billmaster as tb LEFT JOIN tbl_takeaway_customer ts ON ts.tac_customerid=tb.tab_hdcustomerid Where tb.tab_dayclosedate ='".$_SESSION['date']."' ORDER BY   tb.tab_date,tb.tab_time DESC ";
 $sql_bilhis= "Select tb.tab_paymode,tb.tab_billno,tb.tab_dayclosedate,tb.tab_name,tb.tab_phone, ts.tac_customername,ts.tac_contactno,tb.tab_status  From tbl_takeaway_billmaster as tb LEFT JOIN tbl_takeaway_customer ts ON ts.tac_customerid=tb.tab_hdcustomerid Where tb.tab_dayclosedate ='".$_SESSION['date']."'$mode AND tb.tab_billno not like 'Temp%' AND tb.tab_billno not like 'HOLD%' ORDER BY   tb.tab_date,tb.tab_time DESC ";
    $sql_bilhistory  =  $database->mysqlQuery($sql_bilhis); 
    $num_bilhistory  = $database->mysqlNumRows($sql_bilhistory);
    if($num_bilhistory)
    {$i=1;
        while($result_bilhistory  = $database->mysqlFetchArray($sql_bilhistory)) 
            { $cur_date= $_SESSION['date'];
                ?><!--bill_history_number-->
      <tr class="ta_bill_history <?php if($result_bilhistory['tab_status']=='Cancelled'){ ?> bill_history_cancel <?php } ?> <?php if($result_bilhistory['tab_billno']==$_REQUEST['billno']){ ?> bill_history_active <?php } ?> <?php if($result_bilhistory['tab_billno']==$_REQUEST['bilno']){ ?> bill_history_active <?php } ?>" cur_date="<?=$cur_date?>" billdate="<?= $result_bilhistory['tab_dayclosedate'] ?>" user="<?= $_SESSION['designtnname']?>"  billno="<?=$result_bilhistory['tab_billno']?>" cancelstatus="<?=$result_bilhistory['tab_status']?>">
        <td width="8%"><strong><?=$i++?></strong></td>
        <td width="27%"><!--<a href="ta_bill_history.php?bilno=<?=$result_bilhistory['tab_billno']?>">--><?=$result_bilhistory['tab_billno']?><!--</a>--></td>
         <td width="31%"><?=$result_bilhistory['tab_name']?></td>
         <td width="20%"><?=$result_bilhistory['tab_phone']?></td>
         <td width="14%"   ><span  class="<?php if($result_bilhistory['tab_status']=='Delivered') { ?> deliverd_1 <?php } else if($result_bilhistory['tab_status']=='Closed') { ?> closed_1 <?php } else if($result_bilhistory['tab_status']=='Packed') { ?> packed_clr <?php } else if($result_bilhistory['tab_status']=='Generated') { ?> genrate_clr<?php }  else if($result_bilhistory['tab_status']=='KOT_Generated') { ?> kot_genrated_clr<?php } else if($result_bilhistory['tab_status']=='Assigned') { ?> assigned_clr<?php } ?>"><?=$result_bilhistory['tab_status']?></span></td>
       <?php    
        $paymode='';   
        $sql_listall2  =  $database->mysqlQuery("SELECT pym_name from  tbl_paymentmode where pym_id='".$result_bilhistory['tab_paymode']."' limit 1 "); 
	$num_listall2  = $database->mysqlNumRows($sql_listall2);
	if($num_listall2){ 
	 while($row_listall2  = $database->mysqlFetchArray($sql_listall2)) 
	 {
             $paymode=$row_listall2['pym_name'];
            
            
            
        }}
         ?>
                          
                <td width="14%" style="font-size: 8px;font-weight: bold"><?=$paymode?></td> 
      
      </tr><a href="ta_bill_history.php?bilno=<?=$result_bilhistory['tab_billno']?>">
       <?php } }else { ?>
       <td colspan="4" style="font-weight:bold">No records to display</td>
       <?php } ?>
       
     </table> 
    <?php
	
}else if($_REQUEST['value']=="set_cancel_ta")
{
        ///cs bill cancel//
	$billno=$_REQUEST['billno'];
	$slno='';
        $credit_amount= 0;
        $credit_id= '';
	if(isset($_REQUEST['slno']))
	{
            
	$slno=$_REQUEST['slno']; 
	$sql_listall  =  $database->mysqlQuery("Update tbl_takeaway_billdetails set tab_cancelled='Y',tab_status='Cancelled' Where tab_billno='".$billno."' AND tab_slno='".$slno."'");
	
        
        }else
	{
		$sql_listall  =  $database->mysqlQuery("Update tbl_takeaway_billdetails set tab_cancelled='Y',tab_status='Cancelled' Where tab_billno='".$billno."' ");
		$sql_listall  =  $database->mysqlQuery("Update tbl_takeaway_billmaster set tab_cancelled='Y',tab_status='Cancelled' Where tab_billno='".$billno."' ");
	}
        
	$sql_listall  = $database->mysqlQuery("SELECT  cd_amount, cd_masterid FROM tbl_credit_details WHERE  cd_billno='".$billno."'"); 
        $num_listall  = $database->mysqlNumRows($sql_listall);
        if($num_listall)
        {
                while($row = mysqli_fetch_array($sql_listall))
                      {
                      $credit_amount= $row['cd_amount'];
                      $credit_id= $row['cd_masterid'];
                      }
                      
            $sql_listall  = $database->mysqlQuery("update tbl_credit_master set crd_totalamount= crd_totalamount-$credit_amount where crd_id='".$credit_id."' ");         
        }
        
	$sql_listall  =  $database->mysqlQuery("delete from tbl_credit_details  where  cd_billno='".$billno."' ");
	 
	$reasontext=mysqli_real_escape_string($database->DatabaseLink,trim($_REQUEST['reasontext']));
	date_default_timezone_set('Asia/Kolkata');
        $dateexp=date("Y-m-d H:i:s");
	$sql_table_sel3  = $database->mysqlQuery("SELECT * from tbl_staffmaster  WHERE  ser_staffid ='".$_REQUEST['stafflist']."' AND  ser_employeestatus='Active'"); $rrt='';
        $num_table3  = $database->mysqlNumRows($sql_table_sel3);
        if($num_table3)
        {
                while($row = mysqli_fetch_array($sql_table_sel3))
                      {
                      $rrt= $row['ser_cancelwithkey'];
                       $staff_cancel= $row['ser_firstname'];
                      }
        }
        
        if($rrt=="Y")
                {  
                        $result= "yes";
                        $sql=$database->mysqlQuery("UPDATE tbl_secretkeymaster SET `sr_expiredtime`='".$dateexp."' WHERE (sr_key='".$_REQUEST['secretkey']."' )  AND (`sr_expiredtime`='0000-00-00 00:00:00' OR sr_expiredtime IS NULL)");
          }else
          {
                        $result= "no";
                        $sql=$database->mysqlQuery("UPDATE tbl_secretkeymaster SET `sr_expiredtime`='".$dateexp."' WHERE (sr_password='".md5($_REQUEST['secretkey'])."')  AND (`sr_expiredtime`='0000-00-00 00:00:00' OR sr_expiredtime IS NULL)");
          }
	
	
	$sql='';
	if(isset($_REQUEST['slno']))
	{
	$sql=$database->mysqlQuery("UPDATE tbl_takeaway_billdetails SET tab_cancelled='Y',tab_status='Cancelled',`tab_cancelledby_careof`='".$_REQUEST['stafflist']."', `tab_cancelledreason`='".$reasontext."', `tab_cancelledtime`='".$dateexp."',  `tab_cancelledlogin`='".$_SESSION['expodine_id']."' WHERE tab_billno='".$billno."' AND tab_slno='".$slno."' ");
	
	}else
	{
	$sql=$database->mysqlQuery("UPDATE tbl_takeaway_billdetails SET tab_cancelled='Y',tab_status='Cancelled',`tab_cancelledby_careof`='".$_REQUEST['stafflist']."', `tab_cancelledreason`='".$reasontext."', `tab_cancelledtime`='".$dateexp."', `tab_cancelledlogin`='".$_SESSION['expodine_id']."' WHERE tab_billno='".$billno."' ");	
	$sql=$database->mysqlQuery("UPDATE  tbl_takeaway_billmaster SET tab_cancelled='Y',tab_status='Cancelled',`tab_cancelledby_careof`='".$_REQUEST['stafflist']."', `tab_cancelledreason`='".$reasontext."', `tab_cancelledtime`='".$dateexp."', `tab_cancelledlogin`='".$_SESSION['expodine_id']."' WHERE tab_billno='".$billno."'  ");
	}
	if($sql)
	echo  "ok";
	else
	echo "sorry";
	
        
      ////////stockupdate//////
     $sql_table_sel3114  = $database->mysqlQuery("SELECT tab_menuid,tab_portion,tab_qty from tbl_takeaway_billdetails  WHERE  tab_billno ='".$billno."' ");
     $num_table3114  = $database->mysqlNumRows($sql_table_sel3114);
     if($num_table3114)
     {
	  while($row114 = mysqli_fetch_array($sql_table_sel3114))
		{
              
              $qty_update= $database->mysqlQuery( "UPDATE tbl_menustock SET "
              . " mk_stock_number=mk_stock_number+'".$row114['tab_qty']."' "
              . " where mk_menuid= '".$row114['tab_menuid']."' "
              . " and mk_portion= '".$row114['tab_portion']."' and mk_open_stock_date='".$_SESSION['date']."' and  mk_opening_stock >0 ");
      
           
	}
     } 
     
     ////stockend///////   
        
     $customer="";
     $point_add=0;
     $point_redeem=0;
     $sql_sms1211 =  $database->mysqlQuery("Select * from tbl_loyalty_pointadd_bill where  lob_billno='".$billno."'"); 
		  $num_sms1211  = $database->mysqlNumRows($sql_sms1211);
		  if($num_sms1211)
		  {
		      while($result_sms1211  = $database->mysqlFetchArray($sql_sms1211)) 
			{
                                $customer =$result_sms1211['lob_loyalty_customer'];
                                $point_add =$result_sms1211['lob_point_add'];
                                $point_redeem =$result_sms1211['lob_point_redeem'];
                              
                        } }
                                      
      if($point_redeem>0 || $point_add>0){
          
      $sql_loy=$database->mysqlQuery("UPDATE tbl_loyalty_reg SET ly_points=(ly_points+'".$point_redeem."')-'".$point_add."' ,ly_totalvisit=ly_totalvisit-1 WHERE ly_id='".$customer."' ");
      $sql_loy1=$database->mysqlQuery("UPDATE tbl_takeaway_billmaster  SET tab_redeem_amount='0' where tab_billno='".$billno."' ");
      $sql_loy_del=$database->mysqlQuery("Delete from tbl_loyalty_pointadd_bill where lob_billno ='".$billno."' ");       
    
     }
            
  $bill_tot_cancel=0;     
  $sql_table_sel311  = $database->mysqlQuery("SELECT * from tbl_takeaway_billmaster  WHERE  tab_billno ='".$billno."' ");
  $num_table311  = $database->mysqlNumRows($sql_table_sel311);
  if($num_table311)
  {
	  while($row11 = mysqli_fetch_array($sql_table_sel311))
		{
		$bill_tot_cancel= $row11['tab_netamt'];
		}
  }    
  
  $reasontext_cancel='';
  $sql_sms121 =  $database->mysqlQuery("Select * from tbl_cancellation_reasons where  cr_id=$reasontext"); 
		  $num_sms121  = $database->mysqlNumRows($sql_sms121);
		  if($num_sms121)
		  {
		         while($result_sms121  = $database->mysqlFetchArray($sql_sms121)) 
					{
                                          $reasontext_cancel                                =$result_sms121['cr_reason'];
                                      } }
  
        $dt= date("Y-m-d h:i:s");  
        $dt1=date("Y-m-d");
        $detail=" Bill no:$billno \n Cancelled by: $staff_cancel \n Cancelled time:$dt \n Cancelled reason:$reasontext_cancel \n Bill amount:$bill_tot_cancel ";
        
     $date_nw_nw=date('Y-m-d H:i:s');
        
     $sql12=$database->mysqlQuery("INSERT INTO tbl_billcancel_log(bc_billno,bc_date, bc_details, bc_datetime, bc_sms_time, bc_email_time) VALUES ('$billno','$dt1','$detail','$dt','$date_nw_nw','$date_nw_nw')");  
        
     
   ///inv start///   
       
   if($_SESSION['s_inventory_staff_add']=='Y' && $_SESSION['be_inv_sales_stock_reduce']=='Y'){
      
        $weight='';
        $sql_login_inv  =  $database->mysqlQuery("select * from tbl_takeaway_billdetails  where tab_billno='$billno' and tab_status='Cancelled' "); 
	$num_login_inv   = $database->mysqlNumRows($sql_login_inv);
	if($num_login_inv){ 
	while($result_inv = $database->mysqlFetchArray($sql_login_inv)) 
        { 
            
            
        ////product wise//
            
        $sql_listall  =  $database->mysqlQuery("select * from tbl_production where tp_product='".$result_inv['tab_menuid']."' and tp_store='".$_SESSION['ser_store_inv']."' "); 
        $num_listall  = $database->mysqlNumRows($sql_listall);
        if($num_listall){
          
            if($result_inv['tab_rate_type']=='Portion' || $result_inv['tab_base_unit_id']=='3' || $result_inv['tab_unit_id']=='5'){
                
                $fnct_menu2 = $database->mysqlQuery("update tbl_store_stock set ts_qty=(ts_qty+'".$result_inv['tab_qty']."') , ts_total=(ts_unit_price*ts_qty),ts_average= (ts_total/ts_qty)  where ts_product='".$result_inv['tab_menuid']."' and ts_store='".$_SESSION['ser_store_inv']."'  ");
      
              }else{
                  
               if($result_inv['tab_unit_type']=='Packet' && ($result_inv['tab_unit_id']=='3' || $result_inv['tab_unit_id']=='2')){      
                  
               $fnct_menu2 = $database->mysqlQuery("update tbl_store_stock set ts_qty=(ts_qty+'".$result_inv['tab_qty']."'),ts_total=(ts_unit_price*ts_qty) ,ts_average= (ts_total/ts_qty) where ts_weight='".$result_inv['tab_unit_weight']."' and  ts_product='".$result_inv['tab_menuid']."' and ts_store='".$_SESSION['ser_store_inv']."' ");           
        
           }else{
                  
                  
              $weight=($result_inv['tab_qty']*$result_inv['tab_unit_weight']);     
                  
              $fnct_menu2 = $database->mysqlQuery("update tbl_store_stock set ts_weight=(ts_weight+'".$weight."'),ts_total=(ts_unit_price*ts_weight) ,ts_average= (ts_total/ts_weight) where ts_product='".$result_inv['tab_menuid']."' and ts_store='".$_SESSION['ser_store_inv']."' ");           
           }
            
            
          }
          
          
        }else{
            
        ///recipe wise///
            
       if($result_inv['tab_portion']!=''){
           $sql_login_f =  $database->mysqlQuery("select * from tbl_menu_ingredient_detail where tmi_menuid='".$result_inv['tab_menuid']."' and tmi_store='".$_SESSION['ser_store_inv']."' and tmi_portion='".$result_inv['tab_portion']."' and tmi_cs='Y' "); 
       }else{
           $sql_login_f =  $database->mysqlQuery("select * from tbl_menu_ingredient_detail where tmi_menuid='".$result_inv['tab_menuid']."' and tmi_store='".$_SESSION['ser_store_inv']."' and tmi_cs='Y'  ");        
       }
              
        $num_login_f   = $database->mysqlNumRows($sql_login_f);
	if($num_login_f){ 
	while($result_login_f  = $database->mysqlFetchArray($sql_login_f)) 
        { 
           
            
            $qty_inv=$result_inv['tab_qty']*($result_login_f['tmi_ing_qty']/$result_login_f['tmi_yield']);
            
            $wgt_inv=$result_inv['tab_qty']*($result_login_f['tmi_weight']/$result_login_f['tmi_yield']);
             
            
        if($result_login_f['tmi_ing_unit']=='Single' || $result_login_f['tmi_ing_unit']=='Nos' ){
            
          $fnct_menu2 = $database->mysqlQuery("update tbl_store_stock set ts_qty=(ts_qty+'".$qty_inv."') , ts_total=(ts_unit_price*ts_qty),ts_average= (ts_total/ts_qty)  where ts_product='".$result_login_f['tmi_ing_menuid']."' and ts_store='".$_SESSION['ser_store_inv']."'  ");
       
        }else{
                 
        if($result_login_f['tmi_rate_type']=='Packet' && ($result_login_f['tmi_ing_unit']=='KG' || $result_login_f['tmi_ing_unit']=='LTR')){ 
                 
          $fnct_menu2 = $database->mysqlQuery("update tbl_store_stock set ts_qty=(ts_qty+'".$qty_inv."'),ts_total=(ts_unit_price*ts_qty) ,ts_average= (ts_total/ts_qty) where   ts_product='".$result_login_f['tmi_ing_menuid']."' and ts_store='".$_SESSION['ser_store_inv']."'  ");           
       
        }else{
                  
          $fnct_menu2 = $database->mysqlQuery("update tbl_store_stock set ts_weight=(ts_weight+'".$wgt_inv."'),ts_total=(ts_unit_price*ts_weight) ,ts_average= (ts_total/ts_weight) where ts_product='".$result_login_f['tmi_ing_menuid']."' and ts_store='".$_SESSION['ser_store_inv']."'  ");           
        
        }
        
       }
            
            
        }}else{
            
            ///normalwise///
            
            if($result_inv['tab_rate_type']=='Portion' || $result_inv['tab_base_unit_id']=='3' || $result_inv['tab_unit_id']=='5'){
                
              $fnct_menu2 = $database->mysqlQuery("update tbl_store_stock set ts_qty=(ts_qty+'".$result_inv['tab_qty']."') , ts_total=(ts_unit_price*ts_qty),ts_average= (ts_total/ts_qty)  where ts_product='".$result_inv['tab_menuid']."' and ts_store='".$_SESSION['ser_store_inv']."'  ");
      
            }else{
                  
            if($result_inv['tab_unit_type']=='Packet' && ($result_inv['tab_unit_id']=='3' || $result_inv['tab_unit_id']=='2')){      
                  
               $fnct_menu2 = $database->mysqlQuery("update tbl_store_stock set ts_qty=(ts_qty+'".$result_inv['tab_qty']."'),ts_total=(ts_unit_price*ts_qty) ,ts_average= (ts_total/ts_qty) where ts_weight='".$result_inv['tab_unit_weight']."' and  ts_product='".$result_inv['tab_menuid']."' and ts_store='".$_SESSION['ser_store_inv']."' ");           
        
           }else{
                  
                  
            $weight=($result_inv['tab_qty']*$result_inv['tab_unit_weight']);     
                  
            $fnct_menu2 = $database->mysqlQuery("update tbl_store_stock set ts_weight=(ts_weight+'".$weight."'),ts_total=(ts_unit_price*ts_weight) ,ts_average= (ts_total/ts_weight) where ts_product='".$result_inv['tab_menuid']."' and ts_store='".$_SESSION['ser_store_inv']."' ");           
           
            } } }
            
        }
          
             
   }}
          
  }
  
 ///inv end///        
     
     $sql_login_fire2  =  $database->mysqlQuery("select tf_active from tbl_firebase_notification_report where tf_report_head='Bill Cancel' "); 
	$num_login_fire2   = $database->mysqlNumRows($sql_login_fire2);
	if($num_login_fire2){ 
	while($result_login_fire2  = $database->mysqlFetchArray($sql_login_fire2)) 
        { 
          $firebase_report_status=$result_login_fire2['tf_active'];
        }}
     
     
  if($_SESSION['cloud_enable_sync']=='Y' && $_SESSION['firebase_on']=='Y' && $firebase_report_status=="Y"){
          
        $a="8.8.8.8";
        exec("ping -n 1 -w 1 ".$a, $output, $result);
        if($result==0)
        {
            
    ///pushing msg///
    $branch_id_fire=$_SESSION['firebase_id'];
    
    require 'vendor/autoload.php';
    
    $client = new Client();
    $client->setAuthConfig('service_google.json'); // Replace with your file path
    $client->addScope('https://www.googleapis.com/auth/firebase.messaging');
    $accessToken = $client->fetchAccessTokenWithAssertion()['access_token'];

   $url = "https://fcm.googleapis.com/v1/projects/ed-reports-b5f94/messages:send";
   $body = " Bill No: $billno \nBill Cancelled by: $staff_cancel \nCancelled time:$dt \nCancelled Reason:$reasontext_cancel \nBill Amount: $bill_tot_cancel ";
   $projectId = 'ed-reports-b5f94'; 
 
     $data = [
    'message' => [
       "topic"=> $branch_id_fire,
        'notification' => [
            'title' => $_SESSION['s_branchname'].'  - BILL CANCELLED',
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
      //  echo 'Error:' . curl_error($ch);
    } else {
      //  echo 'Response: ' . $response;
    }
    curl_close($ch);
    
    
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
else if(isset($_REQUEST['set']) &&  $_REQUEST['set']=="add_tip"){
    $tip_amount=0;
    $tip = $database->mysqlQuery(" UPDATE `tbl_takeaway_billmaster` SET `tab_tips_given`='".$_REQUEST['tip_amount']."',`tab_tips_mode`='".$_REQUEST['tip_mode']."' WHERE tab_billno='".$_REQUEST['billno']."' "); 
    $sql_tipamount  = $database->mysqlQuery("SELECT tab_tips_given from tbl_takeaway_billmaster  WHERE tab_billno='".$_REQUEST['billno']."'"); 
    $num_tipamount  = $database->mysqlNumRows($sql_tipamount);
    if($num_tipamount)
    {
        $row_tipamount = mysqli_fetch_array($sql_tipamount);
        $tip_amount= number_format(str_replace(',', '',$row_tipamount['tab_tips_given']),$_SESSION['be_decimal']);
    }
    echo $tip_amount;
}

else  if(isset($_REQUEST['set']) && $_REQUEST['set']=="check_day_close") {
    $dayclose_bil='';
   $sql_billhis="select tab_dayclosedate  from tbl_takeaway_billmaster WHERE tab_billno='".$_REQUEST['billno']."'";
	$sql_billhistory  =  $database->mysqlQuery($sql_billhis); 
	$num_billhistory  = $database->mysqlNumRows($sql_billhistory);
	if($num_billhistory)
	{
		while($result_billhistory  = $database->mysqlFetchArray($sql_billhistory)) 
			{
                    
                    $dayclose_bil=$result_billhistory['tab_dayclosedate'];
                }
                }  
    
                
                
    $sql_billhis1="select dc_dateclose  from tbl_dayclose WHERE dc_day='".$dayclose_bil."'";
	$sql_billhistory1  =  $database->mysqlQuery($sql_billhis1); 
	$num_billhistory1  = $database->mysqlNumRows($sql_billhistory1);
	if($num_billhistory1)
	{
		while($result_billhistory1  = $database->mysqlFetchArray($sql_billhistory1)) 
			{
                    
                    if($result_billhistory1['dc_dateclose']!=''){
                        echo 'Yes';
                    }else{
                        echo 'No';
                    }
                  
                    
                }
                }
    
}

else  if(isset($_REQUEST['set']) && $_REQUEST['set']=="delete_item_bill") {
    
     $del = $database->mysqlQuery(" Delete from  tbl_takeaway_billdetails  WHERE tab_billno='".$_REQUEST['billno']."' and tab_slno='".$_REQUEST['slno']."' "); 
    
            $dis_of=0;
            $ds_id=0;
            $ds_unit='P';
            $redeem=0;  
          
        $database->mysqlQuery("SET @temp_billno	 	= " . "'" . mysqli_real_escape_string($database->DatabaseLink,$_REQUEST['billno']) . "'");
	$database->mysqlQuery("SET @branchid 			= " . "'" . mysqli_real_escape_string($database->DatabaseLink,$_SESSION['branchofid']) . "'");
	$database->mysqlQuery("SET @discount_of 			= " . "'" . mysqli_real_escape_string($database->DatabaseLink,$dis_of) . "'");
	$database->mysqlQuery("SET @discount_unit 			= " . "'" . mysqli_real_escape_string($database->DatabaseLink,$ds_unit) . "'");
        $database->mysqlQuery("SET @loginid 			= " . "'" . mysqli_real_escape_string($database->DatabaseLink,$_SESSION['expodine_id']) . "'");	
	$database->mysqlQuery("SET @discountid 			= " . "'" . mysqli_real_escape_string($database->DatabaseLink,$ds_id) . "'");
        $database->mysqlQuery("SET @redeem 			= " . "'" . mysqli_real_escape_string($database->DatabaseLink,$redeem) . "'");
     
     $sq=$database->mysqlQuery("CALL  proc_ta_discount(@temp_billno,@branchid,@discount_of,@discount_unit,@discountid,@loginid,@redeem,@message)");
        $rs = $database->mysqlQuery( 'SELECT @message as message' );
	$msg='';
	while($row = mysqli_fetch_array($rs))
	{
	$msg= $row['message'];
	}
     
}
else  if(isset($_REQUEST['set']) && $_REQUEST['set']=="check_item_number") {
    $count=0;
     $sql_billhis1="select count(tab_menuid) as itemcount  from tbl_takeaway_billdetails WHERE tab_billno='".$_REQUEST['billno']."'";
	$sql_billhistory1  =  $database->mysqlQuery($sql_billhis1); 
	$num_billhistory1  = $database->mysqlNumRows($sql_billhistory1);
	if($num_billhistory1)
	{
		while($result_billhistory1  = $database->mysqlFetchArray($sql_billhistory1)) 
			{
                    
                    $count=$result_billhistory1['itemcount'];
                    
                    if($count>1){
                        echo 'Yes';
                    }else{
                         echo 'No';
                    }
                    
                    
                }
                }
    
    
    
    
}

else  if(isset($_REQUEST['set']) && $_REQUEST['set']=="check_paymode") {
    
     $mode='';
     $sql_billhis1="select tab_paymode  from tbl_takeaway_billmaster WHERE tab_billno='".$_REQUEST['billno']."'";
	$sql_billhistory1  =  $database->mysqlQuery($sql_billhis1); 
	$num_billhistory1  = $database->mysqlNumRows($sql_billhistory1);
	if($num_billhistory1)
	{
		while($result_billhistory1  = $database->mysqlFetchArray($sql_billhistory1)) 
			{
                    
                    $mode=$result_billhistory1['tab_paymode'];
                    
                    if($mode=='1'){
                        echo 'Yes';
                    }else{
                         echo 'No';
                    }
                    
                    
                }
                }
    
    
    
    
}
else  if(isset($_REQUEST['set']) && $_REQUEST['set']=="replace_item_bill") {
    
    
    $sql_billhis1="select mr_menuid,mta_rate  from tbl_menumaster left join tbl_menuratetakeaway on mta_menuid=mr_menuid WHERE mr_replacer='Y' limit 0,1 ";
	$sql_billhistory1  =  $database->mysqlQuery($sql_billhis1); 
	$num_billhistory1  = $database->mysqlNumRows($sql_billhistory1);
	if($num_billhistory1)
	{
		while($result_billhistory1  = $database->mysqlFetchArray($sql_billhistory1)) 
			{
                    
                    $menuid=$result_billhistory1['mr_menuid'];
                    $menu_rate=$result_billhistory1['mta_rate'];
                    
                }
                }
    
    
    
     $del = $database->mysqlQuery(" update  tbl_takeaway_billdetails set tab_menuid='".$menuid."',tab_rate_type='Portion',tab_portion='1',tab_org_rate='".$menu_rate."',tab_qty='1',tab_discount='0',tab_rate='".$menu_rate."',tab_amount='".$menu_rate."'  WHERE tab_billno='".$_REQUEST['billno']."' and tab_slno='".$_REQUEST['slno']."' "); 
    
     
            $dis_of=0;
            $ds_id=0;
            $ds_unit='P';
            $redeem=0;  
          
        $database->mysqlQuery("SET @temp_billno	 	= " . "'" . mysqli_real_escape_string($database->DatabaseLink,$_REQUEST['billno']) . "'");
	$database->mysqlQuery("SET @branchid 			= " . "'" . mysqli_real_escape_string($database->DatabaseLink,$_SESSION['branchofid']) . "'");
	$database->mysqlQuery("SET @discount_of 			= " . "'" . mysqli_real_escape_string($database->DatabaseLink,$dis_of) . "'");
	$database->mysqlQuery("SET @discount_unit 			= " . "'" . mysqli_real_escape_string($database->DatabaseLink,$ds_unit) . "'");
        $database->mysqlQuery("SET @loginid 			= " . "'" . mysqli_real_escape_string($database->DatabaseLink,$_SESSION['expodine_id']) . "'");	
	$database->mysqlQuery("SET @discountid 			= " . "'" . mysqli_real_escape_string($database->DatabaseLink,$ds_id) . "'");
        $database->mysqlQuery("SET @redeem 			= " . "'" . mysqli_real_escape_string($database->DatabaseLink,$redeem) . "'");
     
     $sq=$database->mysqlQuery("CALL  proc_ta_discount(@temp_billno,@branchid,@discount_of,@discount_unit,@discountid,@loginid,@redeem,@message)");
        $rs = $database->mysqlQuery( 'SELECT @message as message' );
	$msg='';
	while($row = mysqli_fetch_array($rs))
	{
	$msg= $row['message'];
	}
    
}else if (isset($_REQUEST['set']) && $_REQUEST['set'] == "loadcreditypes") {
    
    
    $credittype = $_REQUEST['credittype'];
    $xmltype = '';
    $pref = '';


    if ($credittype == '2' || $credittype == '1') {  ?>
        
        <span class="room_no_txt labelname"></span>
        <span class="room_text_box_cc">
            <select  style="margin-top: 7px;width: 103px;margin-left: -21px;" class="staff_menu_select" name="selectcreditdetails" id="selectcreditdetails">
            <option value=""><?= $_SESSION['payment_pending_select_roomname'] ?></option>
        <?php
       
        if ($credittype == "1") {
            
            $xmltype = 'roommaster';
            $pref = "rm_";

            $curl = curl_init();
            curl_setopt_array($curl, array(
                CURLOPT_URL => $_SESSION['be_expolitelink'] . "/occupiedrooms",
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
                $result = json_decode($response, true);
            }
            $room_numbers = implode(',', $result['data']);
           
            $sql_roomnumber = $database->mysqlQuery("update tbl_credit_master cm,tbl_roommaster rm  set cm.crd_active ='N'  where rm.rm_roomid=cm.crd_roomid   and cm.crd_type='1' ");
            
            $sql_roomnumber1 = $database->mysqlQuery("update tbl_credit_master cm,tbl_roommaster rm  set cm.crd_active ='Y'  where rm.rm_roomid=cm.crd_roomid  and rm.rm_roomno  IN ($room_numbers) and cm.crd_type='1' ");
           
             $sql_ds_nos = "select cm.crd_id as id,rm.rm_roomno as names,rm.rm_roomid as main_id from tbl_credit_master as cm LEFT JOIN tbl_roommaster as rm ON cm.crd_roomid=rm.rm_roomid where cm.crd_type='" . $credittype . "' AND cm.crd_branchid='" . $_SESSION['branchofid'] . "' AND cm.crd_active='Y' AND rm.rm_status='Y' ORDER BY rm_roomid ASC ";
          
            } else if ($credittype == "2") {
         
            $xmltype = 'staffmaster_first';
            $sql_ds_nos = "select cm.crd_id as id,sm.ser_firstname as names,sm.ser_staffid as main_id from tbl_credit_master as cm  LEFT JOIN tbl_staffmaster as sm ON cm.crd_staffid=sm.ser_staffid where cm.crd_type='" . $credittype . "' AND cm.crd_branchid='" . $_SESSION['branchofid'] . "' AND cm.crd_active='Y' AND  sm.ser_employeestatus='Active' ORDER BY cm.crd_id  DESC";
        }
				}
        $sql_ds = $database->mysqlQuery($sql_ds_nos);
        $num_ds = $database->mysqlNumRows($sql_ds);
        if ($num_ds) {
            while ($result_ds = $database->mysqlFetchArray($sql_ds)) {
                
                if ($credittype == "2") {

                    ?>    

                <option value="<?= $result_ds['id'] ?>" ><?php echo $result_ds['names']; ?></option>

                <?php }else { ?>
                            
                <option value="<?= $result_ds['id'] ?>" ><?php echo $result_ds['names']; ?></option>?>
                            
                <?php } } ?>   
                            
            </select>
            </span>
        
            <?php } else if ($credittype == "3" || $credittype == "4") { ?>  

            <?php if ($credittype == "4") { ?>
        
            <span style="width: 40%;" class="room_no_txt labelname">Name</span>
            <span class="room_text_box_cc" style="display: none">

                <input type="text" Placeholder="Enter Name"  class="staff_menu_select" name="selectcreditdetailsname" id="selectcreditdetailsname" onclick=" return name_search_click();"  onchange=" return name_search(this.value)" onkeyup=" return name_search(this.value)"  onkeydown="return suggession_select(event)"autocomplete="off">
                <div id="suggession_name" ></div>
            </span>

                <?php } ?>

                <?php if ($credittype == "3") { ?>

            <span style="width: 40%" class="room_no_txt labelname">Name</span>
            <span class="room_text_box_cc">

                <select style="margin-top: 7px;width: 103px;margin-left: -117px;" name="selectcreditdetailsname" id="selectcreditdetailsname"  class="staff_menu_select">
                    <?php
                    $sql_login = $database->mysqlQuery("select ct.ct_corporatename from tbl_corporatemaster ct left join tbl_credit_master cm on cm.crd_corporateid=ct.ct_corporatecode  where ct.ct_status='Y' and cm.crd_active='Y' ");
                    $num_login = $database->mysqlNumRows($sql_login);

                    if ($num_login) {
                        while ($result_login = $database->mysqlFetchArray($sql_login)) {
                            ?>
                            <option value="<?= $result_login['ct_corporatename'] ?>"><?= $result_login['ct_corporatename'] ?></option>
                        <?php } } ?>
                </select>
                <?php } ?>

            </span>
                <?php if ($credittype == "4") { ?>

            <span class="room_no_txt labelname1"></span>
            <span class="room_text_box_cc" style="    margin-top: -25px;">
                <input style="margin-top: -2px;margin-left: -108px;width: 111px;" type="text" Placeholder="Number-Name-ID"  class="staff_menu_select" name="selectcreditdetailsnumber" onkeypress="return numdot7(event);" id="selectcreditdetailsnumber"  onclick=" return number_search(this.value)" onchange=" return number_search(this.value)" onkeyup=" return number_search(this.value)" maxlength="12" autocomplete="off">
                <div id="suggession_number" style="display: none "></div>
            </span>


        <?php } } ?>
            
        <?php
        
            if (isset($_REQUEST['setamt12']) && ($_REQUEST['setamt'] == "amt")) {
                 echo $_REQUEST['totalamt'];
            }
       ?>

    <span class="room_no_txt "> <?= $_SESSION['payment_pending_creditamount'] ?> </span>
    <span class="room_text_box_cc">
            <?php
            $sq_lang45 = $database->mysqlQuery("select be_base_currency,be_show_currency from  tbl_branchmaster");
            $nm_lang45 = $database->mysqlNumRows($sq_lang45);
            if ($nm_lang45) {
                while ($result_lang45 = $database->mysqlFetchArray($sq_lang45)) {
                    $currency = $result_lang45['be_base_currency'];
                    $showcurrency1 = $result_lang45['be_show_currency'];
                }
            }
            
     if ($showcurrency1 == "Y") {
                ?>
            <input style="width: 40%;margin-top: 2px"  placeholder="Credit Amount" class="tax_textbox transa_txt " id="amount_credit1" name="amount_credit1" value="<?= $_SESSION['hidvv'] ?>"  readonly="readonly">
            <?php } else { ?>
            <input  style="width: 40%;margin-top: 2px" placeholder="Credit Amount" class="tax_textbox transa_txt " id="amount_credit" name="amount_credit" value=" "  readonly="readonly">

     <?php } ?>

    <?php if ($_SESSION['s_default_company'] == 'Z') { ?>
            <strong id="check_del_div" style="margin-left: 5px;margin-top: 5px;float:right; color: darkred;display:block;border: solid 1px;border-radius: 3px"> &nbsp; ONLINE ORDER &nbsp; </strong>
    <?php } ?> 
    </span>





    <?php
}
?>
