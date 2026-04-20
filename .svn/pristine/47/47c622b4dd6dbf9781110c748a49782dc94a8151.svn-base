<?php
//include('../includes/session.php');		// Check session
session_start();
include("../database.class.php"); // DB Connection class
$database	= new Database();
?>

<script src="js/takeaway_holdview.js"></script>
<script src="js/counter_holdview.js"></script>
<div >
	<div class="top_head"><?=$_REQUEST['bilno']?> List
       <div style="margin-top:-4px;margin-right:5px;" class="counter_menu_popup_head_close_holdlist maincloseholdlist"><img src="img/cancel_bill.png"></div>
    </div>
    <div class="hold_data_list_table_cc">
    
    <table width="100%" border="0">
            <thead>
              <tr>
                <th width="20%">Sl No</th>
                <th >Item</th>
                <th  width="30%">Amount</th>
              </tr>
              </thead>
              <tbody>
               <?php
		$total=0;
                $i=1;
                        $sql_combo=" select  cbd.cbd_id, cbd.cbd_count_combo_ordering, cbd.cbd_billno, cbd.cbd_combo_id, cbd.cbd_combo_pack_id, cbd.cbd_slno, cbd.cbd_combo_qty, cbd.cbd_combo_pack_rate, cbd.cbd_combo_total_rate, cbd.cbd_menu_id, cbd.cbd_menu_qty, cbd.cbd_combo_preference, cbd.cbd_entry_date, cbd.cbd_dayclosedate, cbd.cbd_order_status, cbd.cloud_sync, 
                        cbd.cbd_kot_no, cbd.cbd_cancel, cn.cn_name ,cn.cn_stock_check, cp.cp_pack_name
                        FROM tbl_combo_bill_details_ta cbd
                        left join tbl_combo_name cn on cn.cn_id=cbd.cbd_combo_id
                        left join tbl_combo_packs cp on cp.cp_id=cbd.cbd_combo_pack_id
                        where cbd.cbd_billno='".$_REQUEST['bilno']."' group by cbd.cbd_count_combo_ordering order by cbd.cbd_count_combo_ordering asc";
                        $sql_combo_sel = $database->mysqlQuery($sql_combo);
                        $num_combo_rows  = $database->mysqlNumRows($sql_combo_sel);
                        if($num_combo_rows){
                            while($result_combo  = $database->mysqlFetchArray($sql_combo_sel)) 
                            {$i++;
                            $total+=$result_combo['cbd_combo_total_rate'];
                            ?>
                                <tr>
                                    <td width="20%"><?=$i++?></td>
                                    <td><?=strtoupper($result_combo['cn_name'].' '.$result_combo['cp_pack_name'])?></td>
                                    <td id="amnt_<?=$result_combo['cbd_count_combo_ordering']?>"><?=number_format($result_combo['cbd_combo_total_rate'],$_SESSION['be_decimal'])?></td>
                                    
                                </tr> 
                            <?php          
                            }
                        }        

                    $sql_menulist= "Select tbl_portionmaster.pm_portionshortcode as portion,tbl_portionmaster.pm_id as porname,tbl_menumaster.mr_itemshortcode as menu,tbl_takeaway_billdetails.tab_qty as qty ,tbl_takeaway_billdetails.tab_menuid as menuid,tbl_takeaway_billdetails.tab_slno as slno,tbl_takeaway_billdetails.tab_amount,tbl_takeaway_billdetails.tab_preferencetext,tbl_takeaway_billdetails.tab_rate From tbl_takeaway_billdetails left Join tbl_menumaster On tbl_takeaway_billdetails.tab_menuid = tbl_menumaster.mr_menuid left Join tbl_portionmaster On tbl_takeaway_billdetails.tab_portion = tbl_portionmaster.pm_id Where tbl_takeaway_billdetails.tab_billno = '".$_REQUEST['bilno']."' and tbl_takeaway_billdetails.tab_count_combo_ordering IS NULL order by tbl_takeaway_billdetails.tab_slno ";
                    //echo "Select tbl_portionmaster.pm_portionshortcode as portion,tbl_portionmaster.pm_id as porname,tbl_menumaster.mr_itemshortcode as menu,tbl_takeaway_billdetails.tab_qty as qty ,tbl_takeaway_billdetails.tab_menuid as menuid,tbl_takeaway_billdetails.tab_slno as slno,tbl_takeaway_billdetails.tab_amount,tbl_takeaway_billdetails.tab_preferencetext,tbl_takeaway_billdetails.tab_rate From tbl_takeaway_billdetails Inner Join tbl_menumaster On tbl_takeaway_billdetails.tab_menuid = tbl_menumaster.mr_menuid Inner Join tbl_portionmaster On tbl_takeaway_billdetails.tab_portion = tbl_portionmaster.pm_id Where tbl_takeaway_billdetails.tab_billno = '".$_REQUEST['bilno']."' order by tbl_takeaway_billdetails.tab_slno ";
                    $sql_menus  =  $database->mysqlQuery($sql_menulist); 
                   $num_menus  = $database->mysqlNumRows($sql_menus);
                   if($num_menus){
                           while($result_menus  = $database->mysqlFetchArray($sql_menus)) 
                                   {$total+=$result_menus['tab_amount'];
						
				?>
                <tr>
                    <td width="20%"><?=$i++?></td>
                    <td><?=$result_menus['menu']."( ".$result_menus['portion']." )"?></td>
                    <td width="30%"><?=$result_menus['tab_amount']?></td>
                </tr>
                <?php } } ?>
               
                
      </tbody>
    </table>
    </div>
    <input type="hidden" name="hidbilno" class="hidbilno" value="<?=$_REQUEST['bilno']?>" />
    
   <?php
   
 $mode="";
 if(isset($_REQUEST['mode'])) {
     $mode=$_REQUEST['mode'];
 }
   
 
       $reorder='';
                    $sql_menulist= "Select tab_bill_reorder from tbl_takeaway_billmaster where tab_billno='".$_REQUEST['bilno']."' ";
                    //echo "Select tbl_portionmaster.pm_portionshortcode as portion,tbl_portionmaster.pm_id as porname,tbl_menumaster.mr_itemshortcode as menu,tbl_takeaway_billdetails.tab_qty as qty ,tbl_takeaway_billdetails.tab_menuid as menuid,tbl_takeaway_billdetails.tab_slno as slno,tbl_takeaway_billdetails.tab_amount,tbl_takeaway_billdetails.tab_preferencetext,tbl_takeaway_billdetails.tab_rate From tbl_takeaway_billdetails Inner Join tbl_menumaster On tbl_takeaway_billdetails.tab_menuid = tbl_menumaster.mr_menuid Inner Join tbl_portionmaster On tbl_takeaway_billdetails.tab_portion = tbl_portionmaster.pm_id Where tbl_takeaway_billdetails.tab_billno = '".$_REQUEST['bilno']."' order by tbl_takeaway_billdetails.tab_slno ";
                    $sql_menus  =  $database->mysqlQuery($sql_menulist); 
                   $num_menus  = $database->mysqlNumRows($sql_menus);
                   if($num_menus){
                           while($result_menus  = $database->mysqlFetchArray($sql_menus)) 
                                   {
                               
                               
                               $reorder=$result_menus['tab_bill_reorder'];
 
 
                   }}
 
 
   
   
   if($mode=='TA' || $mode=='HD'){ ?>
    <div class="hold_list_bottm_btm">
        
        
        <?php if($reorder==''){ ?>
    <a href="#"><div style="float:right;margin:5px;width: 27%;" class="counter_right_payment_button deletfromholdlist" bilno="<?=$_REQUEST['bilno']?>">Delete</div></a>
        <?php } ?>
    
    	<a href="#"><div style="float:right;margin:5px;width: 27%;" class="counter_right_payment_button addlisttomainlist_ta" bilno="<?=$_REQUEST['bilno']?>">Add to Main</div></a>
    </div>
   <?php } else if($mode=='CS') { ?>
     <div class="hold_list_bottm_btm">
         
           <?php if($reorder==''){ ?>
    <a href="#"><div style="float:right;margin:5px;width: 27%;" class="counter_right_payment_button deletfromholdlist" bilno="<?=$_REQUEST['bilno']?>">Delete</div></a>
    	 <?php } ?>
    
    
    <a href="#"><div style="float:right;margin:5px;width: 27%;" class="counter_right_payment_button addlisttomainlist_cs" bilno="<?=$_REQUEST['bilno']?>">Add to Main</div></a>
    </div>
    <?php } ?>
</div>