<?php
include('includes/session.php');		// Check session
include("database.class.php"); // DB Connection class
$database	= new Database(); 		// Create a new instance
include("api_multiplelanguage_link.php");
$other_lang=  trim(json_encode($_SESSION['main_language']),'""');

if(isset($_REQUEST['value']) &&  $_REQUEST['value']=='load_staff'){ 
   
    ?>

<script src="js/staff_assign_detail.js"></script>

<script type="text/javascript">
$(function() {
	$( "#accordion" ).accordion({
		collapsible: true,
		active: false
	});
});
</script>

 <div id="accordion" class="accordion">
     
<?php


    $string = '';
    if($_REQUEST['staff'] != ''){
        $string.= "AND sm.ser_firstname LIKE '".$_REQUEST['staff']."%'";
    }
    
    $ct=1;
    $sql_staff  =  $database->mysqlQuery("SELECT sm.ser_staffid,tbm.tab_billno, tbm.tab_assignedto, sm.ser_firstname,sm.ser_lastname, 
    tbm.tab_esttime, now() as cur1, tbm.tab_assignedtime, (tbm.tab_esttime -interval 5 MINUTE) AS minusest2 
    FROM tbl_takeaway_billmaster tbm
    
    INNER JOIN tbl_staffmaster sm ON tbm.tab_assignedto = sm.ser_staffid
    WHERE tbm.tab_mode = 'HD' AND tbm.tab_delivery_status !='' 
    AND tbm.tab_dayclosedate = '".$_SESSION['dateopen']."' $string 
    GROUP BY sm.ser_firstname
    ORDER BY tbm.tab_time ASC"); 
    
    $num_staff  = $database->mysqlNumRows($sql_staff);
   
    if($num_staff){
         while($result_staff  = $database->mysqlFetchArray($sql_staff)){
             
            if ($result_staff['cur1'] > $result_staff['tab_esttime']) {
                    $stsorder1="delay_cc";
             
            }
             else if( $result_staff['cur1'] >$result_staff['minusest2']){
                    $stsorder1="near_end_cc";
            }
            
            else{
                   $stsorder1="";
            }
            
          
           
            $sql_order  =  $database->mysqlQuery("SELECT tbm.tab_billno, tbm.tab_assignedto, sm.ser_firstname,sm.ser_lastname, tc.tac_contactno
            FROM tbl_takeaway_billmaster tbm
            INNER JOIN tbl_staffmaster sm ON tbm.tab_assignedto = sm.ser_staffid
            INNER JOIN tbl_takeaway_customer tc ON tc.tac_customerid = tbm.tab_hdcustomerid 
            WHERE tbm.tab_mode = 'HD' AND tbm.tab_delivery_status != ''
            AND tbm.tab_assignedto = '".$result_staff['tab_assignedto']."'
            AND tbm.tab_dayclosedate = '".$_SESSION['dateopen']."' 
            ORDER BY tbm.tab_time ASC"); 
            $num_order  = $database->mysqlNumRows($sql_order);

            $staffid=$result_staff['ser_staffid'];
            
            $staffasign_name=$result_staff['ser_firstname'].' '.$result_staff['ser_lastname'];
        
            
    $billcount=0;        
    $sql_staff1  =  $database->mysqlQuery("Select count(tab_billno) as count from tbl_takeaway_billmaster where "
    . " tab_dayclosedate = '".$_SESSION['dateopen']."' and tab_assignedto='".$result_staff['tab_assignedto']."' "
    . " and tab_status!='Cancelled' and tab_delivery_status!='' "); 
     $num_staff1  = $database->mysqlNumRows($sql_staff1);
     if($num_staff1){
         while($result_staff1  = $database->mysqlFetchArray($sql_staff1)){
             
             $billcount=$result_staff1['count'];
             
         }
         }
          
?>
     <div class="accordion-item" id="<?=$result_staff['tab_assignedto']?>" >
         
         <div style="position: relative;margin-top: 10px"  class="accordion-header <?=$stsorder1?>">
             <div class="staff_asign_tab_contant_count" style="background-color: white;color: black "><?=$ct++?></div>
             <span title=" <?=$staffasign_name?>" style="font-size:10px">  <?=substr($staffasign_name,0,15)?></span> 
             
             
                    <span style="display:none" onclick="deliver_all_new_btn('<?=$result_staff['tab_assignedto']?>')"  style="border-radius: 8px;border: 1px solid;font-size: 10px;position: absolute;right: 145px;top: 7px;width: 60px;height: 25px;text-align: center;display: flex;justify-content: center;align-items: center;font-size: 9px ">Deliver All </span>     
                   
                    <span style="display:none" onclick="settle_all_new_btn('<?=$result_staff['tab_assignedto']?>')"  style="border-radius: 3px;background-color: white;color: darkred;border: 1px solid;font-size: 10px;position: absolute;right: 80px;top: 7px;width: 60px;height: 25px;text-align: center;display: flex;justify-content: center;align-items: center;font-size: 9px ">Settle All</span>     
                   
                    
                   
                        
                    <select class="zoom-div" onchange="select_all_in_one('<?=$result_staff['tab_assignedto']?>')"  onclick="select_all_in_one('<?=$result_staff['tab_assignedto']?>')"  id="type_del_all_<?=$result_staff['tab_assignedto']?>" 
                            style="width: 74px !important;color: black;border-radius: 8px;border: 1px solid;font-size: 10px;position: absolute;right: 125px;top: 7px;
                                 width: 60px;height: 25px;font-weight: bold;text-align: center;display: flex;justify-content: center;align-items: center;font-size: 9px ">
                             <option value="">Select Type</option>
                             <option disabled value="">------------------------------------------------</option>
                              <option value="D">DELIVER ALL</option>
                              <option value="S">SETTLE ALL</option>
                              <option value="DS">DELIVER & SETTLE ALL</option>
                         </select>  
                     
                       
                   
                     <span  onclick="submit_all_in_one('<?=$result_staff['tab_assignedto']?>')"  style="border-radius: 3px;background-color: white;
                            color: black;border: 1px solid;font-size: 10px;position: absolute;right: 75px;top: 7px;width: 45px;height: 25px;
                            text-align: center;display: flex;justify-content: center;align-items: center;font-size: 9px ">SUBMIT</span>     
                   
                    
                    <span class="accordion-item-arrow"></span>  
                   
                    <span style="float:right;font-size: 9px">  Bills : <?=$billcount?> &nbsp;&nbsp;</span>
                    
        </div>
         
         
         

         
                <div class="accordion-content" id="cntnt_<?=$result_staff['tab_assignedto']?>" >
                    
                    <div class="right_menu_accord_cc ">
                    <?php $tot_pend=0;
                    $sql_staffbill  =  $database->mysqlQuery("SELECT tbm.tab_netamt,tbm.tab_billno, tbm.tab_assignedto, 
                    sm.ser_firstname, tc.tac_contactno, tbm.tab_esttime, now() as cur, tbm.tab_assignedtime, tc.tac_customername,
                    (tbm.tab_esttime -interval 5 MINUTE) AS minusest1 ,tbm.tab_delivery_status,tbm.tab_status,tc.tac_address
                    FROM tbl_takeaway_billmaster tbm
                    INNER JOIN tbl_staffmaster sm ON tbm.tab_assignedto = sm.ser_staffid
                    INNER JOIN tbl_takeaway_customer tc ON tc.tac_customerid = tbm.tab_hdcustomerid 
                    WHERE tbm.tab_mode = 'HD' 
                    and tbm.tab_delivery_status!=''
                    AND tbm.tab_assignedto = '".$result_staff['tab_assignedto']."'
                    AND tbm.tab_dayclosedate = '".$_SESSION['dateopen']."' and tbm.tab_status!='Cancelled'
                    ORDER BY tbm.tab_time ASC"); 
                    $num_staffbill  = $database->mysqlNumRows($sql_staffbill);
                    
                    if($num_staffbill){
                        ?>
                        
                        <div class="staff_asign_tab_open_contant_bill_cc " style="pointer-events: none;height: 24px " >
                           
                            <div  style="width:28%;font-size: 9x !important;" class="staff_asign_tab_open_contant_bill"> <input id="check_all_del" name="check_all_del" class="check_all_del" stf="<?=$result_staff['tab_assignedto']?>" style="pointer-events:auto " type="checkbox" > &nbsp;  &nbsp; Bill No</div>
                            <div  style="width:20%;font-size: 9px;font-weight: bold" class="staff_asign_tab_open_contant_bill">Customer</div>
                            <div style="width:18%;font-size: 9px;font-weight: bold" class="staff_asign_tab_open_contant_bill">Amount</div>
                             
                            <div  style="width:17%;font-size: 10px;font-weight: bold" class="staff_asign_tab_open_contant_bill">Delivery Status</div>
                             
                            <div  style="width:17%;font-size: 10px;font-weight: bold" class="staff_asign_tab_open_contant_bill">Bill Status</div>
                             
                        </div>
                        
                    <?php
                    while($result_staffbill  = $database->mysqlFetchArray($sql_staffbill)){
                       
                        $tot_pend=$tot_pend+$result_staffbill['tab_netamt'];
                        
                        
                        if($result_staffbill['cur'] > $result_staffbill['tab_esttime']) {
                                      $stsorder="delay_cc";

                        }
                         else if( $result_staffbill['cur'] >$result_staffbill['minusest1']){
                                    $stsorder="near_end_cc";
                        }

                        else{
                                    $stsorder="";
                        }
            
            ?>
                        
                        <div onclick="hgt('<?=$result_staffbill['tab_billno']?>')" class="hgt_cls hgt_cls_<?=$result_staffbill['tab_billno']?> staff_asign_tab_open_contant_bill_cc <?=$stsorder?>" billno="<?=$result_staffbill['tab_billno']?>" billnobystaff="<?=$result_staffbill['tab_billno']?>" id="<?=$result_staffbill['tab_billno']?>">
                           
                            <div  style="width:28%;font-size: 9px" class="staff_asign_tab_open_contant_bill"><input id="check_all_del2" name="check_all_del2" class="check_all_del2_<?=$result_staff['tab_assignedto']?>" type="checkbox" bill_one="<?=$result_staffbill['tab_billno']?>" > &nbsp; &nbsp; <?=$result_staffbill['tab_billno']?></div>
                            <div title="Name: <?=$result_staffbill['tac_customername']?> | Number : <?=$result_staffbill['tac_contactno']?> | Address : <?=$result_staffbill['tac_address']?>" style="width:20%;font-size: 9px" class="staff_asign_tab_open_contant_bill"><?=$result_staffbill['tac_contactno']?> &nbsp;<i class="fa fa-info-circle "></i></div>
                             <div style="width:18%;font-size: 9px" class="staff_asign_tab_open_contant_bill"><?=$result_staffbill['tab_netamt']?></div>
                             
                             <?php if($result_staffbill['tab_delivery_status']!='D'){  ?> 
                             <div title="Deliver The Bill" onclick="deliver_one('<?=$result_staffbill['tab_billno']?>','<?=$result_staffbill['tac_contactno']?>','<?=$result_staffbill['tac_customername']?>');"  style="width:17%" class="staff_asign_tab_open_contant_bill"><img style="color:white;width:60%;height: 65%" src="img/qr_delivery.png"></div>
                             <?php }else{  ?>
                             
                             <div  style="width:17%;font-size: 10px;background-color: #5a9159" class="staff_asign_tab_open_contant_bill">Delivered</div>
                             
                              <?php } ?>
                             
                             
                              <?php if($result_staffbill['tab_status']=='Closed' ||  $result_staffbill['tab_status']=='Settled' ){  ?> 
                             
                              <div  style="width:17%;font-size: 10px;background-color: #5a9159;color: white" class="staff_asign_tab_open_contant_bill"><?=$result_staffbill['tab_status']?></div>
                             
                             
                            
                             <?php }else{  ?>
                              <div title="Settle The Bill" onclick="settle_one('<?=$result_staffbill['tab_billno']?>');" style="width:17%" class="staff_asign_tab_open_contant_bill"><img style="width:35px" src="img/settle.png "></div>
                       
                            
                              <?php } ?>
                             
                             
                        </div>
                        
            <?php } } ?>
                        
                        <div  class="staff_asign_tab_open_contant_bill_cc" style="pointer-events: none " >
                            <div  class="staff_asign_tab_open_contant_bill" style="font-weight: bold;width: 100%;font-size: 11px ">TOTAL : <?=number_format($tot_pend,$_SESSION['be_decimal'])?></div>
                          
                        </div>    
                        
                        
                    </div><!--right_menu_accord_cc-->
                </div>
            </div>
     
     <?php  } } ?>
     
    </div>
    <input type="hidden" value="<?=$_REQUEST['billno']?>" id="billnobystaff">
    <input type="hidden" value="<?=$_REQUEST['staff']?>" id="staffname">
    
    <?php 
    
    $staffid = '';
    if(isset($_REQUEST['staffid'])){
        $staffid = $_REQUEST['staffid'];
    }
    ?>
    <input type="hidden" value="<?=$staffid?>" id="staffid">
    
<?php
}
else if( isset($_REQUEST['value']) && $_REQUEST['value']=='load_order'){
?>
    
    <script src="js/staff_assign_detail.js"></script>
    
    <div class="staff_asign_tab_open_contant_bill_cc staff_asign_tab_open_contant_bill_head" >
        <div   class="staff_asign_tab_open_contant_bill">Bill No</div>
        <div  class="staff_asign_tab_open_contant_bill">Mobile No</div>
    </div>
    
    <?php
    $string = '';
    if($_REQUEST['billno_search'] != ''){
        $string .= "AND tbm.tab_billno LIKE '".$_REQUEST['billno_search']."%'";
    }elseif($_REQUEST['contactno']!= ''){
        $string .= "AND tc.tac_contactno LIKE '".$_REQUEST['contactno']."%'";
    }
    
    $sql_order  =  $database->mysqlQuery("SELECT tbm.tab_billno, tbm.tab_assignedto, sm.ser_firstname, tc.tac_contactno, tbm.tab_esttime, now() as cur, tbm.tab_assignedtime, (tbm.tab_esttime -interval 5 MINUTE) AS minusest 
    FROM tbl_takeaway_billmaster tbm
    INNER JOIN tbl_staffmaster sm ON tbm.tab_assignedto = sm.ser_staffid
    INNER JOIN tbl_takeaway_customer tc ON tc.tac_customerid = tbm.tab_hdcustomerid 
    WHERE tbm.tab_mode = 'HD' AND tbm.tab_delivery_status = 'P' $string
    AND tbm.tab_dayclosedate = '".$_SESSION['dateopen']."' 
    ORDER BY tbm.tab_time ASC"); 
    
    
    $num_order  = $database->mysqlNumRows($sql_order);
    $billcnt = 0;
    if($num_order){
        while($result_order  = $database->mysqlFetchArray($sql_order)){
          
            if ($result_order['cur'] > $result_order['tab_esttime']) {
                
               $sts="delay_cc";
            
            }
             else if( $result_order['cur'] >$result_order['minusest']){
                 
                $sts="near_end_cc";
             }
      
            else{
               
                $sts="";
            }
    ?>
            <div  class="staff_asign_tab_open_contant_bill_cc <?=$sts?>" id="<?=$result_order['tab_billno']?>" billno="<?=$result_order['tab_billno']?>" billnobyorder="<?=$result_order['tab_billno']?>">
                <div   class="staff_asign_tab_open_contant_bill "><?=$result_order['tab_billno']?></div>
            <div  class="staff_asign_tab_open_contant_bill"><?=$result_order['tac_contactno']?></div>
            </div>
    <?php
    }}
    ?>
    <input type="hidden" value="<?=$_REQUEST['billno']?>" id="billno"> 
    <input type="hidden" value="<?=$_REQUEST['billno_search']?>" id="billno_search"> 
    <input type="hidden" value="<?=$_REQUEST['contactno']?>" id="contactno_search"> 
    
<?php
} else if(  isset($_REQUEST['value']) && $_REQUEST['value']=='order_details'){
    
    if(isset($_REQUEST['billno']))
        
    $billno = $_REQUEST['billno'];
    
    $sql_order_details  =  $database->mysqlQuery("SELECT sm.ser_firstname,sm.ser_lastname,sm.ser_staffid, sm.ser_mobileno, tb.tab_esttime, tb.tab_date, tb.tab_time, tc.tac_customerid, 
    tc.tac_customername, tc.tac_contactno, tc.tac_address, tc.tac_landmark, tc.tac_area, tc.tac_remarks, 
    tb.tab_total, tb.tab_delivery_status, tb.tab_payment_settled, 
    TIMESTAMPDIFF(MINUTE,tab_assignedtime,NOW()) AS timeleft,
    TIMESTAMPDIFF(MINUTE,tab_assignedtime,tab_esttime) AS alottedtime,
    tb.tab_delivery_status
    FROM tbl_takeaway_billmaster tb
    INNER JOIN tbl_staffmaster sm ON tb.tab_assignedto = sm.ser_staffid
    INNER JOIN tbl_takeaway_customer tc ON tb.tab_hdcustomerid = tc.tac_customerid 
    WHERE tb.tab_billno = '$billno'"); 
    $num_order_details  = $database->mysqlNumRows($sql_order_details);
    
    $_SESSION['billno'] = $billno;
    
    if($num_order_details)
        
    $result_order_details  = $database->mysqlFetchArray($sql_order_details);
    

    $staffname_orderdetails=$result_order_details['ser_firstname'].' '.$result_order_details['ser_lastname'];
    ?>
    
    
                     	<div class="staff_ass_detail_center_staff_detail_cc">
                        	<div class="staff_detail_name_cc">Staff Name <span>:</span></div>
                            <div class="staff_detail_name_detail_cc"><?= $staffname_orderdetails ?></div>
                            <div class="staff_detail_name_cc">Mobile No <span>:</span></div>
                            <div class="staff_detail_name_detail_cc"><?= $result_order_details['ser_mobileno'] ?></div>
                            <div style="width:30%;" class="staff_detail_name_cc">Assigned <span>:</span></div>
                            <div style="width:25%;" class="staff_detail_name_detail_cc"><strong><?=$result_order_details['timeleft']?> min ago</strong></div>
                            <div style="width:29%;text-align:right" class="staff_detail_name_cc">Time Alotted &nbsp;<span>:</span></div>
                            <div style="width:15%;" class="staff_detail_name_detail_cc"><strong> <?=$result_order_details['alottedtime']?> min</strong></div>
                        </div><!--staff_ass_detail_center_staff_detail_cc-->
                        
                        <div class="staff_ass_center_address_detail_cc" style="background-color:#fff;margin-bottom:5px;">
                        	<div class="staff_ass_center_address_detail_head">ADDRESS 
                            	<span style="float: right;font-size: 14px;padding-right: 5px;">Time : <?= date('h:i A', strtotime($result_order_details['tab_time'])) ?></span>
                            </div>
                            <div class="staff_ass_centr_address">
                            	 <strong>Customer ID <span>:</span></strong> <span><strong><?=$result_order_details['tac_customerid']?></strong></span>
                            </div>
                            <div class="staff_ass_centr_address">
                            	 <strong>Name <span>:</span></strong> <span><strong style="width:100%"> <?=$result_order_details['tac_customername']?></strong></span>
                            </div>
                            <div class="staff_ass_centr_address">
                            	 <strong>Number  <span>:</span></strong> <span><?=$result_order_details['tac_contactno']?></span>
                            </div>
                            <div class="staff_ass_centr_address">
                            	 <strong>Address <span>:</span></strong> 
                                 	<span><?=$result_order_details['tac_address']?><br>
                                    <?=$result_order_details['tac_landmark']?> &nbsp;&nbsp;&nbsp; <?=$result_order_details['tac_area']?><br>
									</span>
                            </div>
                            <div class="staff_ass_centr_address">
                            	 <strong>Notes  <span>:</span></strong> <span><strong style="width:100%"><?=$result_order_details['tac_remarks']?></strong></span>
                            </div>
                        </div><!--staff_ass_center_address_detail_cc-->
                        
                        <div class="staff_ass_center_order_detail_cc">
                        	<div class="staff_ass_left_detail_head">
                            	<table class="" width="100%" border="0" cellspacing="5">
                                    <thead>
                                        <tr>
                                            <th width="10%">Sl</th>
                                            <th width="40%">Item</th>
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
                                            <?php
                                            
                                            
                                             
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
                                                {  $slno++;
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
                                            
                                            $slno1=0; $bill_del='';$tot=0;
                                            $sql_order_item  =  $database->mysqlQuery("SELECT tb.tab_billno,tm.mr_menuid,tm.mr_menuname, tb.tab_qty, tb.tab_rate, tb.tab_amount
                                            FROM tbl_takeaway_billdetails tb
                                            INNER JOIN tbl_menumaster tm ON tb.tab_menuid = tm.mr_menuid
                                            WHERE tb.tab_billno = '$billno' and tb.tab_count_combo_ordering IS NULL "); 
                                            $num_order_item  = $database->mysqlNumRows($sql_order_item);

                                            if($num_order_item)
                                                $qty = 0;
                                                while($result_order_item  = $database->mysqlFetchArray($sql_order_item)){  $slno1++;
                                                  $qty = $qty +$result_order_item['tab_qty'];
                                                  $ordermenu_id=$result_order_item['mr_menuid'];
                                                  $ordermenu_name=$result_order_item['mr_menuname'];
                                                  $bill_del=$result_order_item['tab_billno'];
                                                  $tot=$tot+$result_order_item['tab_amount'];
                                                  
                                                  if($_SESSION['main_language']!='english'){
                
                                                        $sql_arabmenu=$database->mysqlQuery("SELECT lm_menu_name FROM tbl_language_menu_master left join tbl_languages on ls_id=lm_language_id WHERE lm_menu_id='".$ordermenu_id."' and ls_language='".$_SESSION['main_language']."'");

                                                        $num_arabmenu = $database->mysqlNumRows($sql_arabmenu);
                                                        $result_arabmenu = $database->mysqlFetchArray($sql_arabmenu);
                                                        $ordermenu_name=$result_arabmenu['lm_menu_name'];
                                                       
                                                     
                                                        }

                                                
                                            ?>
                                            <tr>
                                                <td width="10%"><?=$slno1?></td>
                                                <td width="40%"><?=$ordermenu_name?></td>
                                                <td width="10%"><?=$result_order_item['tab_qty']?></td>
                                                <td width="15%"><?=$result_order_item['tab_rate']?></td>
                                                <td width="22%"><?=$result_order_item['tab_amount']?></td>
                                             </tr>
                                                <?php } ?>
                                             
                                             <tr>
                                                <td width="10%">Total</td>
                                                <td width="40%"></td>
                                                <td width="10%"></td>
                                                <td width="15%"></td>
                                                <td width="22%"><?=$tot?></td>
                                             </tr>
                                             
                                             
                                         
                                    </tbody>
                                </table>
                            </div>
                        </div><!--staff_ass_center_order_detail_cc-->
                        <div class="staff_ass_detail_bottom_cc" style="bottom: 19px;">
                     	<div class="staff_assign_center_total_cc">
                        	<div style="margin-right:1%;font-size: 12px" class="assign_homedlv_total staff_assign_center_total_cc"> Total (inc Tax) : <?=$result_order_details['tab_total']?></div>
                                
                                <div onclick="reprint_del_bill('<?=$bill_del?>')" style="padding: 4px;margin-top: 6px;line-height: 19px;left: 47%;right: auto;font-size: 12px;cursor: pointer;border: solid 1px;border-radius: 5px;" class="assign_homedlv_total staff_assign_center_total_cc">REPRINT</div>
                               
                            <div style="left:5px;right:auto;font-size: 12px" class="assign_homedlv_total staff_assign_center_total_cc"> Items : <?=$slno1?></div>
                        </div>
                     </div><!--staff_ass_detail_bottom_cc-->
                     <input type="hidden" value="<?=$result_order_details['tab_payment_settled']?>" id="payment_status"/>
                     <input type="hidden" value="<?=$result_order_details['tab_total']?>" id="hdnamount_payable"/>
                     <input type="hidden" value="<?=$result_order_details['tab_delivery_status']?>" id="hdndelivery_status"/>
                        
                        
    <?php
}else if( isset($_REQUEST['value']) && $_REQUEST['value']=='bottom_report'){
    
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
    
    $sql_pndgpay = $database->mysqlQuery("SELECT count(tab_delivery_status) cnt_pndgpay
    FROM tbl_takeaway_billmaster
    WHERE tab_mode = 'HD' AND tab_payment_settled = 'N' AND tab_status != 'Cancelled'  AND tab_dayclosedate = '".$_SESSION['dateopen']."'");
    $result_pndgpay  = $database->mysqlFetchArray($sql_pndgpay);
    
    $sql_stld = $database->mysqlQuery("SELECT count(tab_delivery_status) cnt_stld
    FROM tbl_takeaway_billmaster
    WHERE tab_mode = 'HD' AND tab_payment_settled = 'Y' AND tab_dayclosedate = '".$_SESSION['dateopen']."'");
    $result_stld  = $database->mysqlFetchArray($sql_stld);
    
    $sql_cncld = $database->mysqlQuery("SELECT count(tab_status) cnt_cncld
    FROM tbl_takeaway_billmaster
    WHERE tab_mode = 'HD' AND tab_status = 'Cancelled' AND tab_dayclosedate = '".$_SESSION['dateopen']."'");
    $result_cncld  = $database->mysqlFetchArray($sql_cncld);
    ?>
    <div class="staff_ass_detail_report " style="background-color: #ff7600;">
        <span><?= $result_bill['cnt_bill'] ?></span>
        <span class="staff_report">Bills</span>
    </div><!--staff_ass_detail_report-->
    <div class="staff_ass_detail_report " style="background-color: #ffaf6a;">
        <span><?= $result_dlvr['cnt_dlvr'] ?></span>
        <span class="staff_report">Delivered</span>
    </div><!--staff_ass_detail_report-->
    <div class="staff_ass_detail_report " style="background-color: #f9c191;">
        <span><?= $result_pendg['cnt_pndg'] ?></span>
        <span class="staff_report">Pending</span>
    </div><!--staff_ass_detail_report-->
    <div class="staff_ass_detail_report " style="background-color: #ffad30;">
        <span><?=$result_pndgpay['cnt_pndgpay'] ?></span>
        <span class="staff_report">Pending Pay</span>
    </div><!--staff_ass_detail_report-->
    <div class="staff_ass_detail_report " style="background-color: #ffce83;">
        <span><?= $result_stld['cnt_stld'] ?></span>
        <span class="staff_report">Settled</span>
    </div><!--staff_ass_detail_report-->
    <div class="staff_ass_detail_report " style="background-color: #ffe597;">
        <span><?= $result_cncld['cnt_cncld'] ?></span>
        <span class="staff_report">Cancelled</span>
    </div><!--staff_ass_detail_report-->
    
    <?php
}
else if( isset($_REQUEST['value']) && $_REQUEST['value']=='deliver_all_by_staff'){
    
    $sql_timealot  =  $database->mysqlQuery("UPDATE tbl_takeaway_billmaster
    SET tab_delivery_status = 'D'
    WHERE (tab_delivery_status = 'P' or tab_delivery_status = 'A') AND tab_assignedto = '".$_REQUEST['staff']."' ");
    
}
else if( isset($_REQUEST['value']) && $_REQUEST['value']=='deliver_all_by_one'){
    
    $sql_timealot  =  $database->mysqlQuery("UPDATE tbl_takeaway_billmaster
    SET tab_delivery_status = 'D'
    WHERE (tab_delivery_status = 'P' or tab_delivery_status = 'A') AND tab_billno = '".$_REQUEST['bill']."' ");
    
    
    
    
}
else if( isset($_REQUEST['value']) && $_REQUEST['value']=='settle_all_by_staff'){
    
    $date=date('Y-m-d H:i:s');
    $sql_timealot  =  $database->mysqlQuery("UPDATE tbl_takeaway_billmaster 
    SET tab_delivery_status = 'D' ,tab_paymode='1',tab_amountpaid=tab_netamt,tab_settlement_login='".$_SESSION['expodine_id']."',tab_status='Closed',
    tab_settlement_time='$date',tab_payment_settled='Y' WHERE  tab_assignedto = '".$_REQUEST['staff']."' and tab_status!='Cancelled' ");
    
}
else if( isset($_REQUEST['value']) && $_REQUEST['value']=='settle_all_by_mode'){
    
    $date=date('Y-m-d H:i:s');
    
       $bill=explode(',',$_REQUEST['bills']);
      
       
       for($i=0;$i<count($bill);$i++){
    
    
    if($_REQUEST['type']=='D'){
    
    $sql_timealot  =  $database->mysqlQuery("UPDATE tbl_takeaway_billmaster
    SET tab_delivery_status = 'D'
    WHERE (tab_delivery_status = 'P' or tab_delivery_status = 'A') AND tab_assignedto = '".$_REQUEST['staff']."'  AND tab_billno = '".$bill[$i]."' ");
    
    }
    
    
     if($_REQUEST['type']=='S'){
    
    $sql_timealot  =  $database->mysqlQuery("UPDATE tbl_takeaway_billmaster 
    SET tab_paymode='1',tab_amountpaid=tab_netamt,tab_settlement_login='".$_SESSION['expodine_id']."',tab_status='Closed',
    tab_settlement_time='$date',tab_payment_settled='Y' WHERE  tab_assignedto = '".$_REQUEST['staff']."' and "
    . " tab_status!='Cancelled' AND tab_billno = '".$bill[$i]."' ");
    
    }
    
    
     if($_REQUEST['type']=='DS'){
    
    $sql_timealot  =  $database->mysqlQuery("UPDATE tbl_takeaway_billmaster 
    SET tab_delivery_status = 'D' ,tab_paymode='1',tab_amountpaid=tab_netamt,tab_settlement_login='".$_SESSION['expodine_id']."',tab_status='Closed',
    tab_settlement_time='$date',tab_payment_settled='Y' WHERE  tab_assignedto = '".$_REQUEST['staff']."' and tab_status!='Cancelled'"
    . "  AND tab_billno = '".$bill[$i]."'");
    
    }
    
       }
    
}

else if( isset($_REQUEST['value']) && $_REQUEST['value']=='settle_all_by_one'){
    
    $date=date('Y-m-d H:i:s');
    
    $sql_timealot  =  $database->mysqlQuery("UPDATE tbl_takeaway_billmaster 
    SET tab_delivery_status = 'D' ,tab_paymode='1',tab_amountpaid=tab_netamt,tab_settlement_login='".$_SESSION['expodine_id']."',tab_status='Closed',
    tab_settlement_time='$date',tab_payment_settled='Y' WHERE  tab_billno = '".$_REQUEST['bill']."' ");
    
     
    
    
}

?>