
<?php
include('includes/session.php');		// Check session
include("database.class.php"); // DB Connection class
$database	= new Database(); 
include("api_multiplelanguage_link.php");
$other_lang=  trim(json_encode($_SESSION['main_language']),'""');// Create a new instance

if(isset($_REQUEST['value']) && $_REQUEST['value']=='hdbill'){ 
    ?>

 <script src="js/staff_assign_each_bill.js"></script>
<?php

$bills = $_REQUEST['bills'];

$sql_bill  =  $database->mysqlQuery("SELECT tb.tab_billno,tb.tab_qr_order_id, tb.tab_time, SUM(tbb.tab_qty) AS qty, tc.tac_landmark, tc.tac_customername  
FROM tbl_takeaway_billmaster tb
INNER JOIN tbl_takeaway_customer tc ON tb.tab_hdcustomerid = tc.tac_customerid 
INNER JOIN tbl_takeaway_billdetails tbb ON tb.tab_billno = tbb.tab_billno 
WHERE tb.tab_mode = 'HD' AND tab_delivery_status = 'NA' AND tb.tab_status IN ('Billed','Settled')
 AND tb.tab_dayclosedate = '".$_SESSION['dateopen']."' 
GROUP BY tb.tab_billno
ORDER BY tb.tab_time ASC"); 
$num_bill  = $database->mysqlNumRows($sql_bill);
$billcnt = 0;
if($num_bill){
     while($result_bill  = $database->mysqlFetchArray($sql_bill)){
        $billcnt++; 
         ?>  

<!--       //staff_ass_left_detail_cc_act///-->
 
        <div class="staff_ass_left_detail_cc">
            <div class="staff_ass_left_detail_main_select <?php if($_REQUEST['qr_order']==$result_bill['tab_qr_order_id']){ ?>  <?php } ?>"     billno="<?=$result_bill['tab_billno']?>" id="<?=$result_bill['tab_billno']?>">  
            <div style="width:5%;" class="staff_ass_left_mob"><?=$billcnt?></div>
            <div style="width:18.5%;" class="staff_ass_left_mob"><strong><?=$result_bill['tab_billno']?></strong></div>
             <div style="width:12%;" class="staff_ass_left_mob"><?=$result_bill['tab_qr_order_id']?></div>
            <div style="width:11%;" class="staff_ass_left_mob"><?=date('h:i A', strtotime($result_bill['tab_time']))?></div>
            <div style="width:12%;" class="staff_ass_left_mob"><?=$result_bill['qty']?></div>
            <div style="width:12%;" class="staff_ass_left_mob"><?=$result_bill['tac_landmark']?></div>
            <div style="width:15%;" class="staff_ass_left_mob"><?=$result_bill['tac_customername']?></div>
          </div>  
            <div style="width:10%;" class="staff_ass_left_mob">
                <div  class="staff_assign_detail_view_btn staff_order_detail_pop" billno="<?=$result_bill['tab_billno']?>">DETAILS</div>
            </div>
            
        </div><!--staff_ass_left_detail_cc-->
        
<?PHP
     } ?>
        <input type="hidden" value="<?=$bills?>" id="bills">
        <?php
        
                                   
}else{
    
    echo '<div style="width:100%;" class="staff_ass_left_mob">Order not found!</div>';
}
}
else if ( isset($_REQUEST['value']) && $_REQUEST['value']=='load_popup') {
    ?>
        <script>
             $("#detail_close").click(function(){
                 
                $(".staff_asign__odr_details_pop").css("display","none");
		$(".confrmation_overlay").css("display","none");
                $(".staff_order_detail_pop").removeClass('billno')
	});
        </script>
<?php

$billno = $_REQUEST['billno'];
$sql_bill  =  $database->mysqlQuery("SELECT  tbm.tab_total, tbm.tab_time, tbm.tab_dayclosedate, tbm.tab_hdcustomerid, tc.tac_customername, tc.tac_contactno, tc.tac_address, tc.tac_landmark, tc.tac_area, tc.tac_remarks  
FROM tbl_takeaway_billmaster tbm
LEFT JOIN tbl_takeaway_customer tc ON tc.tac_customerid = tbm.tab_hdcustomerid
LEFT JOIN tbl_takeaway_billdetails tbd ON tbm.tab_billno = tbd.tab_billno
WHERE tbm.tab_billno = '$billno' AND tbm.tab_dayclosedate = '".$_SESSION['dateopen']."'"); 
$num_bill  = $database->mysqlNumRows($sql_bill);

if($num_bill){
     $result_bill  = $database->mysqlFetchArray($sql_bill)
        
        ?>
        <div class="take_staff_view_head">
                    	
                    	<div style="background-color:#235973;float: right;width: 10%;margin-top: -2px;" class="staf_view_hd_num">
                        <a id="detail_close" href="#"><img src="img/close_ico.png"></a></div>
                        <div style="width:70%;" class="staf_view_list_hd">Bill Details (<?=$billno?>)</div>
                        
                    </div><!--take_staff_view_head-->
                    
                  <div class="take_staff_view_cont_cc" id="">
                  
                  <div class="staff_ass_center_address_detail_cc" style="background-color:#fff;margin-bottom:5px;">
                        	<div class="staff_ass_center_address_detail_head">Address
                            	<span style="float: right;font-size: 14px;padding-right: 5px;">Time : <?=date('h:i A', strtotime($result_bill['tab_time']))?></span>
                            </div>
                            <div class="staff_ass_centr_address">
                            	 <strong>Name <span>:</span></strong> <span><strong style="width:100%"> <?= $result_bill['tac_customername'] ?></strong></span>
                            </div>
                            <div class="staff_ass_centr_address">
                            	 <strong>Customer ID <span>:</span></strong> <span><?= $result_bill['tab_hdcustomerid'] ?></span>
                            </div>
                            <div class="staff_ass_centr_address">
                            	 <strong>Mob  <span>:</span></strong> <span><?= $result_bill['tac_contactno'] ?></span>
                            </div>
                            <div class="staff_ass_centr_address">
                            	 <strong>Address <span>:</span></strong> 
                                 	<span><?= $result_bill['tac_address'] ?>,<br>
                                    <?= $result_bill['tac_landmark'].','.$result_bill['tac_area'] ?><br>
									</span>
                            </div>
                            <div class="staff_ass_centr_address">
                            	 <strong>Note  <span>:</span></strong> <span><strong style="width:100%"><?= $result_bill['tac_remarks'] ?></strong></span>
                            </div>
                        </div><!--staff_ass_center_address_detail_cc-->
                  	
                    	<div class="staff_ass_center_order_detail_cc">
                        
                        	<div class="staff_ass_left_detail_head">
                            	<table class="" width="100%" border="0" cellspacing="5">
                                    <thead>
                                        <tr>
                                            <th width="10%">SlNo</th>
                                            <th width="40%">MenuItem</th>
                                            <th width="10%">Qty</th>
                                            <th width="15%">Rate</th>
                                            <th width="22%">Amount</th>
                                        </tr>
                                    </thead>

                                </table>
                            </div>
                            <div class="staff_asign_center_table_detail">
                            	<table style="text-align:center">
                                	<tbody>
                                            <?PHP
                                            $slno = 0;
                                            $qty=0;
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
                                                {$slno++;
                                                $qty=$qty+$result_combo['cbd_combo_qty'];
                                                //$total+=$result_combo['cbd_combo_total_rate'];
                                                ?>
                                                    <tr>
                                                        <td width="10%"><?=$slno?></td>
                                                        <td width="40%"><?=strtoupper($result_combo['cn_name'].' '.$result_combo['cp_pack_name'])?></td>
                                                        <td width="10%"><?= $result_combo['cbd_combo_qty'] ?></td>
                                                        <td width="15%"><?=number_format($result_combo['cbd_combo_pack_rate'],$_SESSION['be_decimal'])?></td>
                                                        <td width="22%"><?=number_format($result_combo['cbd_combo_total_rate'],$_SESSION['be_decimal'])?></td>
                                                    </tr> 
                                                <?php          
                                                }
                                            }
                                            
                                            $sql_item  =  $database->mysqlQuery("SELECT mm.mr_menuname,mm.mr_menuid, tbd.tab_qty, tbd.tab_rate, tbd.tab_amount
                                            FROM tbl_takeaway_billdetails tbd 
                                            Left JOIN tbl_menumaster mm ON mm.mr_menuid = tbd.tab_menuid
                                            WHERE tbd.tab_billno = '$billno' and tbd.tab_count_combo_ordering IS NULL");
                                            $num_item  = $database->mysqlNumRows($sql_item);
                                            if($num_item){
                                                
                                                while($result_item  = $database->mysqlFetchArray($sql_item)){
                                                 $slno++; 
                                                 $ordermenu_id=trim(json_encode($result_item['mr_menuid']),'""');
                                                 $staffasign_menuid=$result_item['mr_menuid'];
                                                 $staffasign_menu=$result_item['mr_menuname'];
                                                 if($_SESSION['main_language']!='english'){
                
                                                $sql_arabmenu=$database->mysqlQuery("SELECT lm_menu_name FROM tbl_language_menu_master left join tbl_languages on ls_id=lm_language_id WHERE lm_menu_id='".$staffasign_menuid."' and ls_language='".$_SESSION['main_language']."'");

                                                //echo " SELECT mm_name FROM tbl_language_menu_sub left join tbl_languages on ls_id=mm_lang_id WHERE mm_sub_category_id='".$result_subcat['subid']."' and ls_language='".$dat."'";
                                                $num_arabmenu = $database->mysqlNumRows($sql_arabmenu);
                                                $result_arabmenu = $database->mysqlFetchArray($sql_arabmenu);
                                                $staffasign_menu=$result_arabmenu['lm_menu_name'];
                                                
                                                }
                                               $qty=$qty+$result_item['tab_qty'];  
                                                 
                                                ?>
                                                <tr>
                                                    <td width="10%"><?=$slno?></td>
                                                    <td width="40%"><?= $staffasign_menu ?></td>
                                                    <td width="10%"><?= $result_item['tab_qty'] ?></td>
                                                    <td width="15%"><?= $result_item['tab_rate'] ?></td>
                                                    <td width="22%"><?= $result_item['tab_amount'] ?></td>
                                                 </tr>
                                         
                                            <?PHP }}if($slno==0){ ?>
                                                 <tr>
                                                    <td width="100%">No Item Found!</td>
                                                    
                                                 </tr>
                                                 <?PHP } ?>
                                    </tbody>
                                </table>
                            </div>
                            
                        </div><!--staff_ass_center_order_detail_cc-->
                        <div style="height: 33px ;line-height: 32px;" class="staff_ass_center_address_detail_head">
                            	<div style="margin-right:1%;" class="assign_homedlv_total">Total = <?= $result_bill['tab_total'] ?></div>
                                <div style="left:5px;" class="assign_homedlv_total">Total Qty = <?= $qty ?></div>
                            </div>
                        
                        
                    </div><!--take_staff_view_cont_cc-->
<?php
     
}
}else if ( isset($_REQUEST['value']) && $_REQUEST['value']=='load_staff') {
    
    $staff = $_REQUEST['staff'];
    
    $sql_staff  =  $database->mysqlQuery("SELECT sm.ser_staffid, sm.ser_firstname,sm.ser_lastname
    FROM tbl_staffmaster sm
    left join tbl_designationmaster as dm on dm.dr_designationid = sm.ser_designation
    WHERE dm.dr_designationname = 'Delivery Boy' and sm.ser_employeestatus='Active' ");
    $num_staff  = $database->mysqlNumRows($sql_staff);
    if($num_staff){
        $slno = 0;
        ?>
        <script src="js/staff_assign.js"></script>  
        <?php
        while($result_staff  = $database->mysqlFetchArray($sql_staff)){
            $assigned_staffname=$result_staff['ser_firstname'].' '.$result_staff['ser_lastname'];
            
            $sql_assign = $database->mysqlQuery("SELECT count(tab_delivery_status) as cnt
            FROM tbl_takeaway_billmaster
            WHERE tab_delivery_status = 'A' AND tab_assignedto = '".$result_staff['ser_staffid']."'AND tab_status!='Cancelled' AND tab_dayclosedate = '".$_SESSION['dateopen']."'");
            $result_assign  = $database->mysqlFetchArray($sql_assign);
            
            $sql_dlvr = $database->mysqlQuery("SELECT count(tab_delivery_status) as cnt_dlvr
            FROM tbl_takeaway_billmaster 
            WHERE tab_delivery_status = 'D' AND tab_assignedto = '".$result_staff['ser_staffid']."' AND tab_dayclosedate = '".$_SESSION['dateopen']."'");
            $result_dlvr  = $database->mysqlFetchArray($sql_dlvr);
            
            $sql_stld = $database->mysqlQuery("SELECT count( tab_payment_settled) as cnt_stld ,sum(tab_netamt) as fin_tot
            FROM tbl_takeaway_billmaster
            WHERE (tab_delivery_status = 'D' || tab_delivery_status='P')  AND tab_payment_settled = 'N' AND tab_assignedto = '".$result_staff['ser_staffid']."' AND tab_dayclosedate = '".$_SESSION['dateopen']."'");
            $result_stld  = $database->mysqlFetchArray($sql_stld);
            
            $chk_del='';
            $sql_pndg = $database->mysqlQuery("SELECT tab_delivery_status
            FROM tbl_takeaway_billmaster
            WHERE tab_assignedto = '".$result_staff['ser_staffid']."' AND tab_dayclosedate = '".$_SESSION['dateopen']."'");
            $num_staff  = $database->mysqlNumRows($sql_pndg);
            if($num_staff){
            while($result_pndg  = $database->mysqlFetchArray($sql_pndg)){
           $chk_del=$result_pndg['tab_delivery_status'];
           
      //  echo $result_pndg['tab_delivery_status'];    
            }}      
?>
                
<!--     <?//= ($chk_del=='P'?'staffasign_box_dsbl':'')?>-->
        
            <div class="staff_sign_right_staff_name_box " staffid="<?=$result_staff['ser_staffid']?>" id="<?=$result_staff['ser_staffid']?>"><?=$assigned_staffname?> 
                <div class="staff_sales_detail_cont">Delivered : <?=$result_dlvr['cnt_dlvr']?></div>
                <div class="staff_sales_detail_cont">Pending Bills : <?=$result_stld['cnt_stld'] ?></div>
                 <div class="staff_sales_detail_cont">Pending Amount : <?=$result_stld['fin_tot'] ?></div>
                <?php if($result_assign['cnt']>0){ ?>
                <div class="staff_sign_right_staff_name_count"><?=$result_assign['cnt']?></div>
                <?php } ?>
            </div>
                            
    
<?PHP
            
    }?>
        <input type="hidden" value="<?=$staff?>" id="staff">
    <?php
                }else{?>
        <span>No Staff for Home Delivery!</span
><?php        
    }
    
    
}else if( isset($_REQUEST['value']) && $_REQUEST['value']=='load_billby_staff'){
    $staffid = $_REQUEST['staffid'];
    $sql_billbystaff  =  $database->mysqlQuery("SELECT tb.tab_billno, tc.tac_landmark
    FROM tbl_takeaway_billmaster tb
    INNER JOIN tbl_takeaway_customer tc ON tb.tab_hdcustomerid = tc.tac_customerid
    WHERE tab_delivery_status = 'A' AND tab_assignedto = '$staffid' AND tb.tab_status!='Cancelled' AND tb.tab_dayclosedate = '".$_SESSION['dateopen']."'");
    $num_billbystaff  = $database->mysqlNumRows($sql_billbystaff);
    if($num_billbystaff){
        ?>
        <script src="js/staff_assign.js"></script> 
        <script src="js/staff_assign_each_bill.js"></script>
        
        <?php
        while($result_billbystaff  = $database->mysqlFetchArray($sql_billbystaff)){
            ?>
             <div class="staff_detail_bill_no">
                <a class="staff_order_detail_pop" href="#" billno="<?=$result_billbystaff['tab_billno']?>"><?=$result_billbystaff['tab_billno']?></a>
                <span class="staff_order_detail_pop" billno="<?=$result_billbystaff['tab_billno']?>"><?=$result_billbystaff['tac_landmark']?></span>
                <div class="staff_detail_bill_cancel" billno="<?=$result_billbystaff['tab_billno']?>" staffid="<?=$staffid?>">
                    
                    <a><img width="100%" src="img/close_ico.png"></a></div>
             </div>
            
            <?php
        }
    }else{?>
        <span>No Assigned Orders!</span>
        <input type="hidden" value="No" id="asgndbill">
<?php
    }
    
    ?>
        
    <?php

    
}else if( isset($_REQUEST['value']) && $_REQUEST['value']=='load_bottom_report'){
    
    $sql_bill = $database->mysqlQuery("SELECT count(tab_delivery_status) cnt_bill
    FROM tbl_takeaway_billmaster
    WHERE tab_mode = 'HD' AND tab_dayclosedate = '".$_SESSION['dateopen']."'");
    $result_bill  = $database->mysqlFetchArray($sql_bill);
    
    $sql_dlvr = $database->mysqlQuery("SELECT count(tab_delivery_status) cnt_dlvr
    FROM tbl_takeaway_billmaster
    WHERE tab_mode = 'HD' AND tab_delivery_status = 'D' AND tab_dayclosedate = '".$_SESSION['dateopen']."'");
    $result_dlvr  = $database->mysqlFetchArray($sql_dlvr);
    
    $sql_pndg = $database->mysqlQuery("SELECT count(tab_delivery_status) cnt_pndg
    FROM tbl_takeaway_billmaster
    WHERE tab_mode = 'HD' AND tab_delivery_status = 'P' AND tab_dayclosedate = '".$_SESSION['dateopen']."'");
    $result_pendg  = $database->mysqlFetchArray($sql_pndg);
    
    $sql_stld = $database->mysqlQuery("SELECT count(tab_delivery_status) cnt_stld
    FROM tbl_takeaway_billmaster
    WHERE tab_mode = 'HD' AND tab_payment_settled = 'Y' AND tab_dayclosedate = '".$_SESSION['dateopen']."'");
    $result_stld  = $database->mysqlFetchArray($sql_stld);
    
    $sql_pndgpay = $database->mysqlQuery("SELECT count(tab_delivery_status) cnt_pndgpay
    FROM tbl_takeaway_billmaster
    WHERE tab_mode = 'HD' AND tab_payment_settled = 'N' AND tab_status != 'Cancelled'  AND tab_dayclosedate = '".$_SESSION['dateopen']."'");
    $result_pndgpay  = $database->mysqlFetchArray($sql_pndgpay);
    
    ?>
                            
                            <div class="staff_left_botom_detail" style="background-color: #d86400;">
                                    <span id="bill"><?= $result_bill['cnt_bill'] ?></span>
                                <span  class="staff_report"> Total Bills</span>
                            </div>
                            <div class="staff_left_botom_detail" style="background-color: #ea8024;">
                                <span><?= $result_dlvr['cnt_dlvr'] ?></span>
                                <span class="staff_report">Delivered</span>
                            </div>
                            <div class="staff_left_botom_detail" style="background-color: #e4a46d;">
                                <span><?= $result_pendg['cnt_pndg'] ?></span>
                                <span class="staff_report">Pending</span>
                            </div>
                            <div class="staff_left_botom_detail" style="background-color: #f3c8a2;">
                                <span><?= $result_stld['cnt_stld'] ?></span>
                                <span class="staff_report">Settled</span>
                            </div>
                            <div class="staff_left_botom_detail" style="background-color: #ffe6d0;">
                                <span><?=$result_pndgpay['cnt_pndgpay'] ?></span>
                                <span class="staff_report">Pending Pay.</span>
                            </div>
        <?php
}

?>
                            
                            
                            
