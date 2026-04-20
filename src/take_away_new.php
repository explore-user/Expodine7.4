<?php

//include('includes/session.php');		// Check session
session_start();
include("database.class.php"); // DB Connection class
$database	= new Database();
include('includes/master_settings.php');
if(!isset($_SESSION['timeopen']) ){ header("location:index.php?msg=1"); }
if(!isset($_SESSION['ta_order_id']))
{
$orderid="TEMP*".$database->getEpoch();
$_SESSION['ta_order_id']=$orderid;
}

?>
<!DOCTYPE HTML>
<html><head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title> Take Away</title>
<link rel="shortcut icon" href="img/favicon.ico">
<link href="css/bootstrap-cerulean.min.css" rel="stylesheet" />
<link href="css/order_new.css" rel="stylesheet" type="text/css">
<link href="css/take_away_new.css" rel="stylesheet" type="text/css">
<!--<link href="css/whitebg/take_away.css" rel="stylesheet" type="text/css">-->

<!--  multiple select drop down starts -->
<link rel="stylesheet" href="css/bootstrap-3.3.2.min.css" type="text/css">
<link rel="stylesheet" href="css/bootstrap-multiselect.css" type="text/css">
<!--js File Attachement-->


<script src="js/jquery-1.10.2.min.js"></script>


<!--<script type="text/javascript" src="js/bootstrap-3.3.2.min.js"></script>-->
<!--<script type="text/javascript" src="js/bootstrap-multiselect.js"></script>
<script type="text/javascript">
$(document).ready(function() {
	$('#example-onDropdownHidden').multiselect({
		onDropdownHidden: function(event) {
			//alert($('#example-onDropdownHidden').val());
		}
	});
	
});
</script>-->

<!--  multiple select drop down ends -->
<!--ESC Key press starts-->
    <script type="text/javascript">
	$(document).ready(function() 
	{
		document.onkeydown = function(evt) {
			evt = evt || window.event;
			if (evt.keyCode == 13) {
			if( $(".disountenterpopup").css('display') == 'block') {
				$('.closedisount').click();	
				}	
			}
			
			
			if (evt.keyCode == 27) {
				
				
				$('.close_btn_validate').click();
				
				$('.new_alert_cc').css('display','none');
				$('.confirm_detail_con_pop').css('display','none');
				window.location="take_away.php";
				
			}
		};
		//*menu poup*//
		$(".menu_sub_item").click(function(){
                   // alert('hu');
			$(".confrmation_overlay").css("display","block");
			$(".bottom_edit_cc_popup").css("display","block");
		});
		$(".close_btn_takeaway_pop").click(function(){
                 
                 
			$(".confrmation_overlay").css("display","none");
			$(".bottom_edit_cc_popup").css("display","none");
                        
			 
		});
		//**End**//
		//*Home Delivery poup*//
		$(".home_delevery_popup_btn").click(function(){
                   
			$(".home_delevery_address_popup").css("display","block");
			$(".confrmation_overlay").css("display","block");
		});
		$("#address_popup_close").click(function(){
			$(".home_delevery_address_popup").css("display","none");
			$(".confrmation_overlay").css("display","none");
		});
		//**End**//
		//*Delivery Settlement poup*//
		$(".settle_popup_btn").click(function(){
                  
			$(".home_delevery_address_popup").css("display","none");
			$(".settle_popup_in_take_away").css("display","block");
			$(".confrmation_overlay").css("display","block");
		});
		$("#payment_close").click(function(){
			$(".home_delevery_address_popup").css("display","none");
			$(".settle_popup_in_take_away").css("display","none");
			$(".confrmation_overlay").css("display","none");
		});
		
		//**End**//
		//*Delivery Settlement poup*//
		$("#payment_pend_pop_btn").click(function(){
			$(".payment_pend_popup").css("display","block");
			$(".confrmation_overlay").css("display","block");
		});
		$("#payment_pend_close").click(function(){
			$(".payment_pend_popup").css("display","none");
			$(".confrmation_overlay").css("display","none");
                         
                        
		});
		
		//**End**//
		$(".paymnet_pop_mode_chnge").click(function(){
			$(".paymnet_pop_mode_chnge").css("display","none");
			$(".paymnet_pop_mode_chnge_1").css("display","block");
		});
		$(".paymnet_pop_mode_chnge_1").click(function(){
			$(".paymnet_pop_mode_chnge").css("display","block");
			$(".paymnet_pop_mode_chnge_1").css("display","none");
		});
		
	});
	</script>
      <!--ESC Key press ends-->

<style>
.ui-autocomplete{z-index:999999 !important;max-height: 400px;    height: auto; overflow: scroll;}
.new_right_drop{margin-top:-8px;}
.tka_sum_btn_cc{ padding: 1% 1.2%;}
.order_list_cont{background-color:rgba(0, 12, 25, 0.56);margin-top:5px;}
.top_site_map_cc{background-color: rgba(30, 46, 62, 0.62);}
</style>
<!--<script type="text/javascript" src="js/jquery-ui-1.8.2.custom.min.js"></script> -->
<script type="text/javascript" src="js/jquery-ui-1.10.4.js"></script> 

	<script type="text/javascript"> 
		jQuery(document).ready(function(){
			$('#search').autocomplete({source:'load_takeaway.php?value=search', minLength:1});
			$('#codesrch').autocomplete({source:'load_takeaway.php?value=code_search', minLength:1});
			//$('#ta_name').autocomplete({source:'load_takeaway.php?value=searchname', minLength:1});
			 $( "#ta_name" ).autocomplete({
				minLength: 0,
				source:"load_takeaway.php?value=searchname",
				focus: function( event, ui ) {
				  $( "#ta_name" ).val( ui.item.label );
				  return false;
				},
				select: function( event, ui ) {
				  $( "#ta_name" ).val( ui.item.label );
				  $( "#ta_mobile" ).val( ui.item.phn );
				  $( "#ta_orderaddress" ).val( ui.item.addr );
				  $( "#ta_landmark" ).val( ui.item.lndm );
				  $( "#ta_area" ).val( ui.item.are );
				  $( "#ta_address" ).val( ui.item.peraddr );
                                   $( "#ta_gst" ).val( ui.item.gst );
				  return false;
				}
			  });
			  $( "#ta_mobile" ).autocomplete({
				minLength: 0,
				source:"load_takeaway.php?value=searchmobile",
				focus: function( event, ui ) {
				  $( "#ta_mobile" ).val( ui.item.label );
				  return false;
				},
				select: function( event, ui ) {
				  $( "#ta_name" ).val( ui.item.name );
				  $( "#ta_mobile" ).val( ui.item.phn );
				  $( "#ta_orderaddress" ).val( ui.item.addr );
				  $( "#ta_landmark" ).val( ui.item.lndm );
				  $( "#ta_area" ).val( ui.item.are );
				  $( "#ta_address" ).val( ui.item.peraddr );
                                   $( "#ta_gst" ).val( ui.item.gst );
				  return false;
				}
			  });
		});
		
	</script>
    <link rel="stylesheet" href="css/jquery-ui-1.8.2.custom.css" /> 


</head>

<body>
<?php
$sql_menulist= "Select tbl_portionmaster.pm_portionshortcode as portion,tbl_menumaster.mr_itemshortcode as menu,tbl_takeaway_billdetails.tab_qty as qty ,tbl_takeaway_billdetails.tab_menuid as menuid,tbl_takeaway_billdetails.tab_slno as slno From tbl_takeaway_billdetails Inner Join tbl_menumaster On tbl_takeaway_billdetails.tab_menuid = tbl_menumaster.mr_menuid Inner Join tbl_portionmaster On tbl_takeaway_billdetails.tab_portion = tbl_portionmaster.pm_id Where tbl_takeaway_billdetails.tab_billno = '".$_SESSION['ta_order_id']."' order by tbl_takeaway_billdetails.tab_slno ";
$sql_menus  =  $database->mysqlQuery($sql_menulist); 
$num_menus  = $database->mysqlNumRows($sql_menus);
if($num_menus){
	$_SESSION['submitbutst']="1";
	echo '<script type="text/javascript">';
	echo '$(document).ready(function(){';
	echo '$(".ta_submit_orders").removeClass("sub_btn_disble")';
	echo '});';
	echo '</script>';
	
}else
{	$_SESSION['submitbutst']="0";
	echo '<script type="text/javascript">';
	echo '$(document).ready(function(){';
	echo '$(".ta_submit_orders").addClass("sub_btn_disble")';
	echo '});';
	echo '</script>';
}

?>
<div class="olddiv1 "></div>
<div class="container-fluid no-padding">
   <?php include"includes/topbar_takeaway.php"; ?>
      <div class="middle_container">
      <div class="top_site_map_cc " style="display:none;">
       <?php if(in_array("table_selection", $_SESSION['menuarray'])) { ?>  
      		<a title="Table Selection" href="table_selection.php"><div style="top:0" class="qiuck_table_ico"><img src="img/table-icon.png"></div></a>
            <?php } ?>
            	<ul style="padding: 3px 0 0 50px;">
					<!--<li><a href="index.php" ><span class="home_icon"></span>\</a></li>-->
					<li><a href="take_away.php">Take Away - Home Delivery</a></li>
				</ul>
                <span class="top_al_search_name ta_errormsg" style="width:50%;  margin-left:0;  color: #F70E0E;text-align: center;"></span>
                
            </div>
            <div class="ta_diableforedit"></div><!-- ta_diableforedit takeaway_disable-->
            <input type="hidden" name="hidprinter" id="hidprinter" value="<?=$_SESSION['s_printst']?>" >
      	<div class="left_contant_container">
        	
        	<div class="take_left_main_list_cc">
            	<div class="top_head">Main Category</div>
                   <div class="take_left_main_list">
                    <?php
					 $sql_cat  =  $database->mysqlQuery("select distinct(mr.mr_maincatid) as catid from tbl_menumaster as mr LEFT JOIN tbl_menumaincategory as my ON mr.mr_maincatid=my.mmy_maincategoryid where mr.mr_active='Y'  order by my.mmy_displayorder"); 
					$num_cat   = $database->mysqlNumRows($sql_cat);
					if($num_cat){$j=0;
					while($result_cat  = $database->mysqlFetchArray($sql_cat)) 
						{
						$j++;
						if($j==1){ $_SESSION['sel_cat_id']=$result_cat['catid']; }
						$menucat=$database->show_category_ful_details($result_cat['catid']);
						if($menucat['mmy_maincategoryname']!="")
						{	
					?>
                    <a catid="catid_<?=$result_cat['catid']?>" class="ta_categorysel">
                        <div class="main_category_list <?php if($j==1){ ?> main_category_list_act<?php } ?>"><?=$menucat['mmy_maincategoryname']?></div>
                    </a>
                    <?php } } } ?> 
                    <input type="hidden" name="ta_catname"  id="ta_catname" value="<?=$_SESSION['sel_cat_id']?>" >
                   
               </div><!--take_left_main_list--> 
            </div><!--take_left_main_list_cc-->
            
           <div class="tkw_sub_items_cc" >
           		<div class="top_head">
                	<div class="takeaway_head_search_span">Search by</div>
                    <div class="top_al_search_cc take_search" style="width:20%;">
                    <span style="width: 30%;float: left;font-size: 16px;text-align:left">Code</span>
                    <span style="width: 70%;float: left;"><input style="width: 100%;" class="search" placeholder="Code " type="text" id="codesrch" name="codesrch" onKeyPress="validateSearch('C')" onKeyDown="validateSearch('C')" onKeyUp="validateSearch('C')" onChange="validateSearch('C')" onBlur="validateSearch('C')"></span>
                </div>
                    <div class="top_al_search_cc take_search" style="width:60%">
                    <span style="width: 16%;float: left;text-align: left;font-size: 16px;">Name</span>
                    <span style="float: left;width: 84%;"><input class="search" placeholder="Search " name="search" id="search" type="text" onKeyPress="validateSearch('N')" onKeyDown="validateSearch('N')" onKeyUp="validateSearch('N')" onChange="validateSearch('N')" onBlur="validateSearch('N')" style="float: left;width: 100%;margin-right: 0;"></span>
                </div>
                   
                	
                </div><!--top_head-->
                 <input type="hidden" name="bchid" id="bchid" value="<?=$_SESSION['branchofid']?>">
                      <input type="hidden" name="ordrid" id="ordrid" value="<?=$_SESSION['ta_order_id']?>">  
               <div class="menu_item_contain" id="ta_loadmenuitems">
               
               		<div class="sub_category_cc_take_away">
                    	<div values="all" class="subcategory_items">All</div>
                    </div>
                
               <?php
				 $curdate=date("Y-m-d");
				// $sql_menulist= "select * from tbl_menumaster as mr LEFT JOIN tbl_menumaincategory as mc ON mr.mr_maincatid=mc.mmy_maincategoryid  LEFT JOIN tbl_menustock ON tbl_menustock.mk_menuid=mr.mr_menuid	WHERE mc.mmy_active='Y' and mr.mr_active='Y' and  mr.mr_maincatid='".$_SESSION['sel_cat_id']."' and tbl_menustock.`mk_stock`='Y' and tbl_menustock.mk_date='".$curdate."'  order by mr_subcatid ";
				$sql_menulist= "select * from tbl_menumaster as mr LEFT JOIN tbl_menumaincategory as mc ON mr.mr_maincatid=mc.mmy_maincategoryid LEFT JOIN tbl_menustock ON tbl_menustock.mk_menuid=mr.mr_menuid  WHERE mc.mmy_active='Y' and mr.mr_active='Y' and  mr.mr_maincatid='".$_SESSION['sel_cat_id']."' and tbl_menustock.mk_date='".$_SESSION['date']."'  order by mr_subcatid ";
				$sql_menus  =  $database->mysqlQuery($sql_menulist); 
				$num_menus  = $database->mysqlNumRows($sql_menus);
				if($num_menus){
					while($result_menus  = $database->mysqlFetchArray($sql_menus)) 
						{
							if($result_menus['mr_dailystock']=='Y')
							{
								$stock=$database->show_manage_stock($result_menus['mr_menuid']);
								$stockstatus=$stock['mk_stock'];
							}else
							{
								$stockstatus='Y';
							}
				?>
               		<a menuid="<?=$result_menus['mr_menuid']?>" class="ta_menuitem "><div class="menu_sub_item <?php if($stockstatus=="N"){?>tka_btn_disable <?php } ?>"><?=$result_menus['mr_menuname']?><span class="item_round"></span> </div></a>
                     <?php  }} else
					 {
						 echo "<span style='color: #F00E0E;margin-left: 43%;'> Nothing to display </span>";
					 } ?> 
                       
               </div> <!--menu_item_contain-->
               
               <!-- *********************************** portion qty preference  starts**********************************************  --> 
             <div class="bottom_edit_cc_popup " id="ta_loadbottomcontent-1" style="display:none"> <!-- id="ta_loadbottomcontent"-->
             	<div class="take_away_popup_head">Menu Name
                	<div class="counter_menu_popup_head_close close_btn_takeaway_pop"><img src="img/cancel_bill.png"></div>
                </div>
               
                <div class="take_away_popup_contant">
                	<div class="take_away_popup_left_portion_cc">
                      <div class="take_away_popup_left_portion_head">Portion <span>90</span></div>
                     <div class="keys">
                        <div style="margin-top:0" class="take_away_popup_left_portion_contant">Single</div>
                        <div class="take_away_popup_left_portion_contant add_popup_active_btn">Full</div>
                        <div class="take_away_popup_left_portion_contant">Quarter</div>
                        </div>
                    </div>
                    <div style="margin-left:1%;" class="take_away_popup_left_portion_cc">
                     <div class="take_away_popup_left_portion_head">Quantity</div>
                    	<div class="keys">
                            <span class="caclulator_btn ">1</span>
                            <span class="caclulator_btn">2</span>
                            <span class="caclulator_btn">3</span>
                            <span class="caclulator_btn add_popup_active_btn">4</span>
                            <span class="caclulator_btn">5</span>
                            <span class="caclulator_btn">6</span>
                            <span class="caclulator_btn">7</span>
                            <span class="caclulator_btn">8</span>
                            <span class="caclulator_btn">9</span>
                            <span class="caclulator_btn keys_span_act">0</span>
                            <span class="caclulator_btn">-</span>
                            <span class="caclulator_btn">Clear</span>
                        </div>
                    </div>
                    <div class="take_away_bottom_btn_rate_cc">
                    <div class="listiing_select_cc">
                        <div class="rate_typ_text_cc">Rate -</div>
                         <div class="rate_typ_textox_cc">
                            <input type="text" class="rate_typ_textox" placeholder="Rate" ></div>
                         </div>
                         <div class="pop_custom_prference_cc">
                            <textarea placeholder="Manual Preference" class="counter_pref_text_area prefrtext"></textarea>
                        </div>
                    </div>
                    
                    <div class="pop_prference_cc">
                         	<select class="counter_new_drop_1">
                            	<option>Select</option>
                                <option>Select-1</option>
                            </select>
                          <a id="ta_addnewtakeaway" href="#" class="counter_pref_right_btn close_btn_takeaway_pop">Submit</a>
                    </div>
                    
                </div><!--take_away_popup_contant-->
                
                
                	
             </div><!--bottom_edit_cc-->  
             
             <!-- *********************************** portion qty preference  stops**********************************************  -->  
             
             
              
           </div><!--tkw_sub_items_cc-->
            
        </div><!--left_contant_container-->
        
        <div class="right_order_inform right_calc_cc">
        	<div class="right_main_cc">
             	<div class="top_head">
                	<div class="right_top_action_btn">
                    	<div class="counter_list_action_btn" id="ta_edititems"><img height="32px" src="img/edit_dishitem.png"></div>
                        <div class="counter_list_action_btn" id="ta_deleteitems" style="line-height: 34px;"><img height="26px" src="img/delete-icon1.png"></div>
                    </div>
                    <div style="right:0;width:45px;" class="right_top_action_btn">
                       <div style="line-height: 53px;" class="counter_list_action_btn"><input class="count_check_all" type="checkbox" value=""></div>
                    </div>
                Order Details</div>
                 <div class="counter_right_payment_button_cc">
                           <a href="#"><div class="counter_right_payment_button home_delevery_popup_btn  take"  name="ts_take" id="ts_take">Take Away </div></a>
                           <a href="#"><div class="counter_right_payment_button home_delevery_popup_btn home_dlvry_cont" name="ts_homed" id="ts_homed">Home Delivery</div></a>
                           <a href="#" id="submitbuttonstatus"><div class="counter_right_payment_button" settype="Y">Print</div></a>
                         </div><!-- class="settle_btn"-->
            	<div class="take_away_order_list_cc">
                	<div class="counter_main_orderd_detail_head" >
                        	<table width="100%" border="0">
                             <thead>
                              <tr>
                                <th width="12%">Sl No</th>
                                <th width="45%">Menu Item</th>
                                <th style="text-align:right" width="10%">Qty</th>
                                <th width="20%">Amount</th>
                              </tr>
                              </thead>
                            </table>
                        </div>
                        <div class="counter_main_orderd_detail_contant " id="ta_orderlist">
                       
                           <?php
				$total=0;
                                $icount1='0';
				 $sql_menulist= "Select tbl_portionmaster.pm_portionshortcode as portion,tbl_menumaster.mr_itemshortcode as menu,tbl_takeaway_billdetails.tab_qty as qty ,tbl_takeaway_billdetails.tab_menuid as menuid,tbl_takeaway_billdetails.tab_slno as slno,tbl_takeaway_billdetails.tab_amount,tbl_takeaway_billdetails.tab_preferencetext,tbl_takeaway_billdetails.tab_rate From tbl_takeaway_billdetails Inner Join tbl_menumaster On tbl_takeaway_billdetails.tab_menuid = tbl_menumaster.mr_menuid Inner Join tbl_portionmaster On tbl_takeaway_billdetails.tab_portion = tbl_portionmaster.pm_id Where tbl_takeaway_billdetails.tab_billno = '".$_SESSION['ta_order_id']."' order by tbl_takeaway_billdetails.tab_slno ";
				$sql_menus  =  $database->mysqlQuery($sql_menulist); 
				$num_menus  = $database->mysqlNumRows($sql_menus);
				if($num_menus){$_SESSION['submitbutst']="1";
					while($result_menus  = $database->mysqlFetchArray($sql_menus)) 
						{$total+=$result_menus['tab_amount'];
				?>
                
                	 <table width="100%" border="0">
                             <tbody>
                                <tr > <!--takeaway_contant_tr_active-->
                                <td width="12%"><?=$result_menus['slno']?></td>
                                <td><?=$result_menus['menu']?> <?=$result_menus['portion']?>
                                <span class="counter_right_pref" colspan="4"><p><?=$result_menus['tab_preferencetext']?></p></span>
                                </td>
                                <td width="10%"><?=$result_menus['qty']?></td>
                                <td width="20%"><?=$result_menus['tab_rate']?></td>
                              </tr>
                           </tbody>
                           </table>
                      
               
               
                <?php 
                $icount1++;
                }  
				echo '<script type="text/javascript">';
		echo '$(document).ready(function(){';
		echo '$(".tal_viewtotal").text(('.$total.').toFixed('.$_SESSION["be_decimal"].'))';
		echo '});';
		echo '</script>';
				
				 }else{  $_SESSION['submitbutst']="0";} 
                                 
                                 echo '<script type="text/javascript">';
		echo '$(document).ready(function(){';
		echo '$(".total_itemcount1").text('.$icount1.')';
		echo '});';
		echo '</script>';
                                 
                                 ?>
                            
                        </div>
                        
                        <div class="counter_right_total">
                    	<div class="tottal_rate_contain" style="color:#fff;font-size: 16px;text-align:right">
                            <span style="  margin-left: 2%;float: left;">Items:</span><span style=" margin-left: 2%;float: left;" class="total_itemcount1">0</span>
                        	Sub Total  = <span class="tal_viewtotal">0.00</span ><span></span></div>
                        
                    </div><!--counter_right_total-->
                    
                </div><!--take_away_order_list_cc-->
                
            </div><!--right_main_cc---> 
        </div><!---right_order_inform-->
        
        <div style="width:100%;" class="bottom_view_quicklist">
        	
            <div style="height: 14vh;" class="order_list_cont">
            
            	<div class="take_away_bottom_btn">
                	<div class="take_away_bottom_btn_img"><span style="line-height:70px" class="time_sp" id="time"></div>
                    <div class="take_away_bottom_btn_text">&nbsp;</div>
                </div><!--take_away_bottom_btn-->
            	<div class="take_away_bottom_btn">
                	<a href="take_away_kot.php"><div class="take_away_bottom_btn_img"><img src="img/take_away_btm_icon.png"></div>
                    <div class="take_away_bottom_btn_text">KOT</div></a>
                </div><!--take_away_bottom_btn-->
                <div class="take_away_bottom_btn">
                	<a href="payments_ta_cs.php"><div class="take_away_bottom_btn_img"><img src="img/take_away_btm_icon_1.png"></div>
                    <div class="take_away_bottom_btn_text">Bill</div></a>
                </div><!--take_away_bottom_btn-->
                <div class="take_away_bottom_btn">
                	<a href="take_away_list.php"><div class="take_away_bottom_btn_img"><img src="img/take_away_btm_icon_2.png"></div>
                    <div class="take_away_bottom_btn_text">Staff Assign</div></a>
                </div><!--take_away_bottom_btn-->
                <div class="take_away_bottom_btn">
                	<a href="take_away_staff.php"><div class="take_away_bottom_btn_img"><img src="img/take_away_btm_icon_3.png"></div>
                    <div class="take_away_bottom_btn_text">Staff Bill</div></a>
                </div><!--take_away_bottom_btn-->
                <div class="take_away_bottom_btn">
                	<a href="ta_bill_history.php"><div class="take_away_bottom_btn_img"><img src="img/take_away_btm_icon_4.png"></div>
                    <div class="take_away_bottom_btn_text">Bill History</div></a>
                </div><!--take_away_bottom_btn-->
                <div class="take_away_bottom_btn">
                	<a href="total_ta_bill_history.php"><div class="take_away_bottom_btn_img"><img src="img/take_away_btm_icon_5.png"></div>
                    <div class="take_away_bottom_btn_text">Total Bill History</div></a>
                </div><!--take_away_bottom_btn-->
                <div class="take_away_bottom_btn">
                	<a href="ta_customer_history.php"><div class="take_away_bottom_btn_img"><img src="img/take_away_btm_icon_6.png"></div>
                    <div class="take_away_bottom_btn_text">Customer History</div></a>
                </div><!--take_away_bottom_btn-->
                 <div class="take_away_bottom_btn">
                	<a id="payment_pend_pop_btn" href="#"><div class="take_away_bottom_btn_img"><img src="img/take_away_btm_icon_7.png"></div>
                    <div class="take_away_bottom_btn_text">Payment Pending</div></a>
                </div><!--take_away_bottom_btn-->
                
            </div><!---order_list_cont--->
        </div><!--bottom_view_quicklist-->
        
      </div><!--middle_container-->          
</div>






<div class="home_delevery_address_popup">
	<div style="padding-right:30px;" class="home_delevery_address_popup_head">Pleas Fill Your Address
    <div id="address_popup_close" style="right: 3px;top: -8px;" class="counter_menu_popup_head_close"><img src="img/cancel_bill.png"></div>
    </div>
	<div class="home_delevery_address_popup_contant">
    	<!--<div style="height:40px;" class="right_con_inform_cc">
                    <div class="cont_detail_box"></div>
                </div>--><!--right_con_inform_cc-->
                
                <!--<div class="right_con_inform_cc">
                	<div class="cont_detail_name">Code</div>
                    <div class="cont_detail_box"><input class="cont_typ_bx" placeholder="Code" name="code" type="text"></div>
                </div>--><!--right_con_inform_cc-->
                <div class="right_con_inform_cc" style="width:60%">
                	<div class="cont_detail_name" style="width:22%">Mobile<span style="color:#F00;display:none;float:right" class="enmobile">*</span></div>
                    <div class="cont_detail_box"><input class="cont_typ_bx" placeholder="mobile" type="text" name="ta_mobile"  id="ta_mobile"></div>
                </div><!--right_con_inform_cc-->
                 <div class="right_con_inform_cc" style="width:37.5%;margin-left:1%">
                	<div class="cont_detail_name" style="width:100%">Customer Id<span style="color:#F00;display:none;float:right" class="enmobile">*</span></div>
                    <div class="cont_detail_box"><input class="cont_typ_bx" placeholder="ID" type="text"></div>
                </div><!--right_con_inform_cc-->
                 <div class="right_con_inform_cc">
                	<div class="cont_detail_name" style="width:19%">Name<span style="color:#F00;display:none;float:right" class="enmobile">*</span></div>
                    <div class="cont_detail_box"><input class="cont_typ_bx " placeholder="Name" name="ta_name" id="ta_name" type="text" onKeyPress="searchname()" onKeyDown="searchname()" onKeyUp="searchname()" onChange="searchname()" onBlur="searchname()"></div>
                    <input type="hidden" name="hid_namv" id="hid_namv" >
                </div><!--right_con_inform_cc-->
                 <div style="height:120px" class="right_con_inform_cc">
                	<div style="height: 30px;line-height: 30px;text-align: center;margin-left: 2%;" id="permnt_add" class="cont_detail_name address_1 act_clr">Permanent Address</div>
                    <div style="height: 30px;line-height: 30px;text-align: center;margin-bottom:5px;" id="order_add" class="cont_detail_name address_1">Delivery Address</div> 
                    <div style="height:130px" class="cont_detail_box permnt_add"><textarea style="height:80px;margin-top:3px;" class="cont_typ_bx" placeholder="Permanent Address" name="ta_address"  id="ta_address" type="text"></textarea></div>
                    <div style="height:140px;display:none;" class="right_con_inform_cc order_add">
                    <div class="cont_detail_box">
                    <!--<a style="cursor:pointer" onClick="cpyaddress();">Copy</a>-->
                    <textarea style="height:80px;" class="cont_typ_bx" placeholder="Delivery Address" name="ta_orderaddress"  id="ta_orderaddress" type="text"></textarea></div>
                </div><!--right_con_inform_cc-->
                </div><!--right_con_inform_cc-->
                
                <div class="right_con_inform_cc">
                	<div class="cont_detail_name" style="width:28%">Landmark<span style="color:#F00; display:none;float:right" class="enlandmrk">*</span></div>
                    <div class="cont_detail_box"><input class="cont_typ_bx" placeholder="Landmark"  type="text"  name="ta_landmark"  id="ta_landmark"></div>
                </div><!--right_con_inform_cc-->
                <div class="right_con_inform_cc">
                	<div class="cont_detail_name">Area</div>
                    <div class="cont_detail_box"><input class="cont_typ_bx" placeholder="Area"  type="text"  name="ta_area"  id="ta_area"><!--<select class="cont_typ_bx" placeholder="Area" name="ta_area"  id="ta_area"><option>--Select Area--</option></select>--></div>
                </div><!--right_con_inform_cc-->
               <input type="hidden" name="genset" id="genset" value="Y">
                
                <div class="bottom_btn_cc">
                		<a href="#"><div class="counter_right_payment_button ta_submit_orders" settype="Y">Submit</div></a>
                        <a href="#"><div class="counter_right_payment_button skip settle_popup_btn">Skip</div></a>
                </div><!--bottom_btn_cc-->
    </div>
</div><!---home_delevery_address_popup--->

<div class="settle_popup_in_take_away">
	<div class="settle_popup_in_take_away_head">Bill Details -</div>
    <div style="margin:0;text-align:left" class="discount_text_cc">Payment Details</div>
    <div class="settle_popup_in_take_away_contant_cc">
    	<div class="settle_popup_in_take_away_mode_sel_btn_cc">
        	<div id="cash" class="pop_payment_mode_sel_btn  mode_sel_btn_act ">Cash</div>
            <div id="credit" class="pop_payment_mode_sel_btn ">Credit / Debit Card</div>
            <div id="complimentary" class="pop_payment_mode_sel_btn ">Complimentary</div>
        </div>
        <div class="sec_pop_div_right">
                       
                           <div class="credit_cc_normal" style="display: none;">
                           <div class="discount_text_cc crd_head"></div>
                               <div class="selecting_payment_cc">
                                    <div class="selecting_payment_one">
                                        <div class="lable_counter_paymnet_cc counter_right_lable">Transaction Bank</div>
                                       <!-- <select id="bankdetails" class=" discount_text_box tax_textbox counter_text_box">
                                             <option value="">Bank Name</option>
                                             <option value="1">Axis Bank</option>
                                             <option value="2">SBI</option>
                                         </select>-->
                                         <select id="bankdetails" class=" discount_text_box tax_textbox counter_text_box">
                                                 <option value="">Bank Name</option>
                                                 <option value="1">Federal Bank</option>
                                          </select>
                                    </div>
                               </div><!--selecting_payment_cc-->
                               
                               <div class="selecting_payment_cc">
                                    <div class="selecting_payment_one">
                                        <div class="lable_counter_paymnet_cc counter_right_lable">Transaction Amount</div>
                                        <input type="hidden" name="pending" id="paymentmsg1" value="Add Complimentary Remarks">
                                                    <input type="hidden" name="pending" id="paymentmsg2" value="Bill Re-Printed">
                                                  <input type="hidden" name="pending" id="paymentmsg3" value="Select Staff">
                                                    <input placeholder="Enter Transaction Amount" class="tax_textbox transa_txt counter_text_box" name="transcationid" id="transcationid" onchange="transamountchange()" onkeypress="transamountchange(event)">
                                        <!--<input placeholder="Amount" class="tax_textbox transa_txt counter_text_box">-->
                                    </div>
                               </div><!--selecting_payment_cc-->
                               <!--<div class="selecting_payment_cc">
                                    <div class="selecting_payment_one">
                                        <div class="lable_counter_paymnet_cc counter_right_lable">Card No</div>
                                        <input placeholder="Card No" class="tax_textbox transa_txt counter_text_box">
                                    </div>
                               </div>--><!--selecting_payment_cc-->
                               <div class="selecting_payment_cc">
                                    <div class="selecting_payment_one">
                                        <div class="lable_counter_paymnet_cc counter_right_lable">Balance to pay</div>
                                        <!--<input placeholder="Balance" class="tax_textbox transa_txt counter_text_box">-->
                                         <input placeholder="Balance" class="tax_textbox transa_txt counter_text_box" name="transbal" id="transbal" readonly="">
                                    </div>
                               </div><!--selecting_payment_cc-->
                               
                           </div><!--credit_cc_normal-->
                           
                            <div class="coupon_cc" style="display: none;">
                            	 <div class="discount_text_cc crd_head">Coupons</div>
                                 <div class="selecting_payment_cc">
                                    <div class="selecting_payment_one">
                                        <div class="lable_counter_paymnet_cc counter_right_lable">Coupon Name</div>
                                       <!-- <select class="tax_textbox counter_text_box">
                                        <option value="">Select Coupon</option>
                                        </select>-->
                                         <select id="menu05" class="discount_text_box tax_textbox counter_text_box">
                                                        <option value="">Coupon Name</option>

                                                    </select>
                                    </div>
                              	 </div><!--selecting_payment_cc-->
                                 <div class="selecting_payment_cc">
                                    <div class="selecting_payment_one">
                                        <div class="lable_counter_paymnet_cc counter_right_lable">Coupon Amount</div>
                                        <!--<input placeholder="Coupon Amount" class="tax_textbox transa_txt counter_text_box">-->
                                        <input placeholder="Enter Coupon Amount" class="tax_textbox transa_txt counter_text_box" name="coupamount" id="coupamount" onchange="couponamountchange()" onkeypress="couponamountchange(event)">
                                    </div>
                              	 </div><!--selecting_payment_cc-->
                                 <div class="selecting_payment_cc">
                                    <div class="selecting_payment_one">
                                        <div class="lable_counter_paymnet_cc counter_right_lable">Balance to pay</div>
                                        <!--<input placeholder="Balance" class="tax_textbox transa_txt counter_text_box">-->
                                        <input placeholder="Balance" class="tax_textbox transa_txt counter_text_box" name="coupbal" id="coupbal" readonly="">
                                    </div>
                              	 </div><!--selecting_payment_cc-->
                                 
                            </div><!--coupon_cc-->  
                            
                            <div class="voucher_cc" style="display: none;">
                            	 <div class="discount_text_cc crd_head">Voucher</div>
                                 <div class="selecting_payment_cc">
                                    <div class="selecting_payment_one">
                                        <div class="lable_counter_paymnet_cc counter_right_lable">Voucher ID</div>
                                        <!--<input placeholder="Voucher ID" class="tax_textbox transa_txt counter_text_box">-->
                                        <input placeholder="Enter Voucher ID" class="tax_textbox transa_txt counter_text_box" name="vouchid" id="vouchid">
                                    </div>
                              	 </div><!--selecting_payment_cc-->
                                 <div class="selecting_payment_cc">
                                    <div class="selecting_payment_one">
                                        <div class="lable_counter_paymnet_cc counter_right_lable">Voucher Amount</div>
                                         <input placeholder="Voucher Amount" class="tax_textbox transa_txt counter_text_box" name="vocamount" id="vocamount" readonly="">
                                       <!-- <input placeholder="Voucher Amount" class="tax_textbox transa_txt counter_text_box">-->
                                    </div>
                              	 </div><!--selecting_payment_cc-->
                                  <div class="selecting_payment_cc">
                                    <div class="selecting_payment_one">
                                        <div class="lable_counter_paymnet_cc counter_right_lable">Balance to pay</div>
                                        <!--<input placeholder="Balance" class="tax_textbox transa_txt counter_text_box">-->
                                        <input placeholder="Balance" class="tax_textbox transa_txt counter_text_box" name="vouchbal" id="vouchbal" readonly="">
                                    </div>
                              	 </div><!--selecting_payment_cc-->
                                 
                            </div><!--voucher_cc-->  
                            
                             <div class="cheque_cc" style="display: none;">
                             		<div class="discount_text_cc crd_head">Cheque</div>
                                    <div class="selecting_payment_cc">
                                    <div class="selecting_payment_one">
                                        <div class="lable_counter_paymnet_cc counter_right_lable">Cheque No</div>
                                        <input placeholder="Enter Cheque No" class="tax_textbox transa_txt counter_text_box" name="cheqname" id="cheqname">
                                        <!--<input placeholder="Cheque No" class="tax_textbox transa_txt counter_text_box">-->
                                    </div>
                              	 </div><!--selecting_payment_cc-->
                                 <div class="selecting_payment_cc">
                                    <div class="selecting_payment_one">
                                        <div class="lable_counter_paymnet_cc counter_right_lable">Bank Name</div>
                                         <input placeholder="Enter Bank Name" class="tax_textbox transa_txt counter_text_box" name="cheqbank" id="cheqbank">
                                        <!--<input placeholder="Bank Name" class="tax_textbox transa_txt counter_text_box">-->
                                    </div>
                              	 </div><!--selecting_payment_cc-->
                                 <div class="selecting_payment_cc">
                                    <div class="selecting_payment_one">
                                        <div class="lable_counter_paymnet_cc counter_right_lable">Amount</div>
                                        <input placeholder="Enter Cheque Amount" class="tax_textbox transa_txt counter_text_box" name="cheqamount" id="cheqamount" onchange="cheqamountchange()" onkeypress="cheqamountchange(event)">
                                        <!--<input placeholder="Amount" class="tax_textbox transa_txt counter_text_box">-->
                                    </div>
                              	 </div><!--selecting_payment_cc-->
                                 <div class="selecting_payment_cc">
                                    <div class="selecting_payment_one">
                                        <div class="lable_counter_paymnet_cc counter_right_lable">Balance to pay</div>
                                        <input placeholder="Balance" class="tax_textbox transa_txt counter_text_box" name="cheqbal" id="cheqbal" readonly="">
                                        <!--<input placeholder="Balance" class="tax_textbox transa_txt counter_text_box">-->
                                    </div>
                              	 </div><!--selecting_payment_cc-->

                                </div><!--cheque_cc-->  
                                
                                  <div class="paid_amount_cc_credit" style="display: none;">
                                       <div class="selecting_payment_cc">
                                        <div class="selecting_payment_one">
                                            <div class="lable_counter_paymnet_cc counter_right_lable">Amount Paid</div>
                                            <!--<input placeholder="Paid Amoun" class="tax_textbox transa_txt counter_text_box">-->
                                            <input placeholder="Enter Paid Amount" class="tax_textbox transa_txt counter_text_box" id="paidamount_credit" name="paidamount_credit" onchange="enterbalance_credit()" onkeypress="enterbalance_credit(event)" value="0">
                                        </div>
                                     </div><!--selecting_payment_cc-->
                                      <div class="selecting_payment_cc">
                                        <div class="selecting_payment_one">
                                            <div class="lable_counter_paymnet_cc counter_right_lable">Balance Amount</div>
                                           <!-- <input placeholder="Balance" class="tax_textbox transa_txt counter_text_box">-->
                                            <input placeholder="Enter Balance Amount" class="tax_textbox transa_txt counter_text_box" id="balanceamout_credit" name="balanceamout_credit" value="0" readonly="">
                                        </div>
                                     </div><!--selecting_payment_cc-->
                                  
                                  </div><!--paid_amount_cc_credit-->
                                  
                                  <div class="credit_type" style="display: none;">
                            			<div class="discount_text_cc crd_head">Credit Type</div>
                                        <div class="selecting_payment_cc">
                                        <div class="selecting_payment_one">
                                            <div class="lable_counter_paymnet_cc counter_right_lable">Select</div>
                                                 <select class="staff_menu_select counter_text_box" name="selectcreditypes" id="selectcreditypes">
                                                    <option value="">Select</option>
                                               		<option value="2" label="Staff name">By Staff</option>
                                               		<option value="3" label="Company Name">By Company</option>
                                               		<option value="4" label="Guest Name">By Guest</option>
                                                </select>
                                        </div>
                                     </div><!--selecting_payment_cc-->
                                     
                                     
                                		
                                </div><!--credit_type-->
                                
                                <div style="display:none" class="complimentrary_cc">
                                 	<div class="discount_text_cc crd_head">Complimentary</div>
                                      <!--<textarea style="height:80px;color:#000;margin-left: 5px;width: 96%;" placeholder="Enter Complimentary" class="tax_textbox" id="completext"></textarea>-->
                                      <textarea placeholder="Enter Complimentary" class="room_textarea tax_textbox" name="completext" id="completext" style="height:80px;color:#000;margin-left: 5px;width: 96%;"></textarea>
                            </div><!--complimentrary_cc-->
                            
                            <div class="paid_amount_cc">
                            
                                  <div class="selecting_payment_cc">
                                    <div class="selecting_payment_one">
                                        <div class="lable_counter_paymnet_cc counter_right_lable">Paid Amount</div>
                                        <!--<input placeholder="Paid Amount" class="tax_textbox transa_txt counter_text_box">-->
                                        <input placeholder="Enter Balance Amount" class="tax_textbox transa_txt counter_text_box" id="paidamount" name="paidamount" onchange="enterbalance(event)" onkeypress="enterbalance(event)" onkeydown="enterbalance(event)" onclick="enterbalance(event)" value="0">
                                    </div>
                                 </div><!--selecting_payment_cc-->
                                 <div class="selecting_payment_cc">
                                    <div class="selecting_payment_one">
                                        <div class="lable_counter_paymnet_cc counter_right_lable">Balance Amount</div>
                                        <!--<input placeholder="Balance Amount" class="tax_textbox transa_txt counter_text_box">-->
                                         <input placeholder="Enter Paid Amount" class="tax_textbox transa_txt counter_text_box" id="balanceamout" name="balanceamout" value="0" readonly="">
                                    </div>
                                 </div><!--selecting_payment_cc-->
                                 
                            </div><!--paid_amount_cc-->
                            
                            </div>
                      <div style="width:100%;float:left;">
                             <div class="popup_bottom_tax_detail" style="width:50%;padding-right: 3%;">
                            	<div style="width:100%" class="lable_counter_paymnet_cc counter_right_lable">Discount :<span id="totaldisc">0.00</span></div>
                                   <!-- <div style="width:100%" class="lable_counter_paymnet_cc counter_right_lable">VAT :<span >32</span></div>
                                    
                                    <div style="width:100%" class="lable_counter_paymnet_cc counter_right_lable" >Sub Total  = <span>13</span><span></span></div>-->
                                </div>
                                 <div class="popup_bottom_tax_detail" style="width:50%;float:right;padding-right: 3%;">
                                    <div style="width:100%" class="lable_counter_paymnet_cc counter_right_lable">Service Tax :<span id="servtax">5.50</span></div>
                                    <div style="width:100%" class="lable_counter_paymnet_cc counter_right_lable">VAT :<span id="vats">6.60</span></div>
                                    
                                    <div style="    width: 100%;display: block;font-size: 22px;text-align: right;padding-top: 8px;" class="lable_counter_paymnet_cc counter_right_lable"><strong>Sub Total  = <span id="final">110.00</span><span></span></strong></div>
                                </div>
                            </div>
                            
                            <div class="right_bottom_button_cc">
                                <div style="width:30%;float:right;" class="tka_sum_btn_cc">
                                    <a class="tka_submit_buton submittranscations" style="cursor:pointer">Settle</a>
                                </div>
                                <div id="payment_close" class="bottom_btn_cc settle_print_btn" style="width:auto;"><a href="#"><div style="" class="counter_right_payment_button skip settle_popup_btn">Print Bill</div></a></div>
                               
                                <!--<div style="width:30%;float:left;" class="tka_sum_btn_cc">
                                    <a class="tka_submit_buton settle_popup_close" style="cursor:pointer" href="#">Close</a>
                                </div>-->
                                
                           </div>
    </div><!--settle_popup_in_take_away_contant_cc-->
</div><!-----settle_popup_in_take_away----->


<div class="payment_pend_popup">
	<div class="payment_pend_popup_head">Payment pending<div id="payment_pend_close" style="right: 3px;top: -8px;" class="counter_menu_popup_head_close"><img src="img/cancel_bill.png"></div></div>
    <div class="payment_pend_popup_contant">
        <div style="margin:0;width:40%;border-right:1px #c1c1c1  solid;border-bottom: 1px #c1c1c1 solid;" class="discount_text_cc">Bill Details</div>
        <div style="margin:0;width:60%;border-bottom: 1px #c1c1c1 solid;" class="discount_text_cc">Order Details</div>
    	<div class="payment_pend_popup_left_cc">
    			<div class="payment_pend_bill_cc">
                	<div class="payment_pend_bill_no">BB125498</div>
                    <div class="payment_pend_bill_mode_cc"><div class="payment_pend_bill_mode">T</div></div>
                </div>
                <div class="payment_pend_bill_cc">
                	<div class="payment_pend_bill_no">BB125499</div>
                    <div class="payment_pend_bill_mode_cc"><div class="payment_pend_bill_mode">H</div></div>
                </div>
        </div>
        <div class="payment_pend_popup_right_cc">
        	<div class="payment_pending_mode_cc">
            	<div class="payment_pending_mode_name"><strong>Change To</strong></div>
                <div class="payment_pending_mode_select">
                	<div class="paymnet_pop_mode_chnge">Take Away</div>
                    <div class="paymnet_pop_mode_chnge_1">Home Delivery</div>
                </div>
                <div class="payment_pending_pop_total">
                	<strong>Total : <span>1202</span></strong>
                </div>
            </div>
        	<div class="payment_pend_popup_right_tbl_cc">
    		<table class="payment_pend_popup_right_tbl" width="100%" border="0">
            	<thead>
                  <tr>
                    <th scope="col">Name</th>
                    <th scope="col">Rate</th>
                    <th scope="col">Action</th>
                  </tr>
                  </thead>
                  <tbody>
                  <tr>
                    <td>HOT AND SOUR CHICKEN...</td>
                    <td>150</td>
                    <td><a href="#"><img src="img/delete_btn_2.png"></a></td>
                  </tr>
                  <tr>
                    <td>HOT AND SOUR CHICKEN...</td>
                    <td>150</td>
                    <td><a href="#"><img src="img/delete_btn_2.png"></a></td>
                  </tr>
                  <tr>
                   <td>HOT AND SOUR CHICKEN...</td>
                    <td>150</td>
                    <td><a href="#"><img src="img/delete_btn_2.png"></a></td>
                  </tr>
                  </tbody>
                </table>
               </div> 
			<div class="payment_pending_botm_btn_cc">
            	<a href="#"><div class="payment_pending_botm_btn">Settle</div></a>
                <a href="#"><div class="payment_pending_botm_btn">Add/Edit</div></a>
                <!--<a href="#"><div class="payment_pending_botm_btn">Cancel</div></a>-->
            </div>
        </div>    
    </div><!--payment_pend_popup_contant-->
    
    
</div><!-----payment_pend_popup--------->


<!-- ************************************************* manage popup starts  ************************************************** -->

<div style="position:fixed;width:100%;left:30%;top:7%;z-index:99999;" class="mynewpopupload1"  ></div>
<!-- ************************************************* manage popup ends  ******************************************************* -->    
<div class="del_contain_pop" id="ta_confirm">
	<div class="delete_con_pop">Are u sure u want to delete? <a style="cursor:pointer" ck="ok" class="ts_status">OK</a> &nbsp; <a  style="cursor:pointer" ck="cancel" class="ts_status">Cancel</a> </div>
</div> 


<div class="new_alert_cc" >
	<div class="confirm_detail_con_pop"></div> 
    
</div> 
<div style="display:none;height: auto;bottom: auto;top: 30%;width:350px;" class="index_popup_1 disountenterpopup">
 	<div style="height:auto" class="index_popup_contant">
            <h3 class="sm_pop_head">Enter Discount </h3>
            
   		<span class="contenttext"  style="display: inline-block;margin: 10px 0 0 0;padding-left:6%;text-align: left;width: 100%;">
        <p style="display:inline-block;margin-bottom: 5px;">Type</p>
        	<!--<input type="text" class="form-control" name="disountamount" id="disountamount" style="width: 20%;margin-top: -37px;margin-left: 284px;  border: 1px solid #847D7D;">-->
            <select  class="form-control" name="disountamount_drop" id="disountamount_drop" style="width:82%;border: 1px solid #C1C1C1;display:inline-block;height:33px;padding:0px;margin-left:4%">
              <option value="none">none</option>
              <?php
			  $sql_listall_dsc  =  $database->mysqlQuery("SELECT * from tbl_discountmaster where ds_status!='Non Active'"); 
			  $num_listall_dsc  = $database->mysqlNumRows($sql_listall_dsc);
			  if($num_listall_dsc){
					while($row_listall_dsc  = $database->mysqlFetchArray($sql_listall_dsc)) 
						{
			?>
             <option value="<?=$row_listall_dsc['ds_discountid']?>" ><?=$row_listall_dsc['ds_discountname']?></option>
            <?php } } ?>
          </select>&nbsp; <!--<span style="margin: 0 10px;" class="or_round_sp">OR </span>-->
          <div class="discount_offer_or_cc">
          Manual <input type="text" class="form-control" name="disountamount" id="disountamount" style="width:53%;border: 1px solid #C1C1C1;display:inline-block;height:33px;padding:0px;padding-left:2px;margin-right: 10px;" value="0"> 
          <label style="display:inline;font-weight:normal">
               <span style="top: 0px;" class="percen_radio">
                 <input type="radio" class="typesel" name="typesel" id="P"  value="P"<?php if($_SESSION['s_discpountypeoption']=="P") { ?> checked <?php } ?>>%
               </span> 
           </label>
          <label style="display:inline;font-weight:normal">
             <span style="top: 17px;" class="percen_radio"> 
             	<input type="radio" class="typesel"  name="typesel" id="V"  value="V"<?php if($_SESSION['s_discpountypeoption']=="V") { ?> checked <?php } ?>>Value
             </span> 
         </label>
            
        </span>
        </div>
        
    </div>
    <div class="index_popup_contant" style="margin-top: 4px;">
    	<div style="width:25%" class="btn_index_popup"><a href="#" class="closedisount">Submit</a></div>
        <div style="width:25%" class="btn_index_popup"><a href="#" class="canceldisount">Cancel</a></div>
    </div>
 </div>
<!---->
 <div style="display:none" class="confrmation_overlay"></div>
 <style>
 .confrmation_overlay{
	width:100%;
	height:100%;
	position:fixed;
	z-index:999;
	background-color:rgba(0,0,0,0.8);
	top:0;
		}
.index_popup_contant{
	width:100%;
	height:30px;
	float:left;
	text-align:center;
	line-height:40px;
	font-size: 16px;
	}			
.index_popup_reg{
		width:35%;
	height:80px;
	position:absolute;
	margin:auto;
	background-color:#fff;
	border-radius:5px;
	box-shadow:0 0 5px #ccc;
	right:0;
	left:0;
	top:0;
	bottom:0;
	z-index:9999;
	overflow:hidden;
}
 .index_popup_1{
	width:35%;
	height:180px;
	position:absolute;
	margin:auto;
	background-color:#fff;
	border-radius:5px;
	box-shadow:0 0 5px #ccc;
	right:0;
	left:0;
	top:0;
	bottom:0;
	z-index:9999;
	overflow:hidden;
	}
.index_popup_contant{
	width:100%;
	height:40px;
	float:left;
	text-align:center;
	line-height:40px;
	font-size: 16px;
	}
.index_popup_confrm{
		width:35%;
	height:80px;
	position:absolute;
	margin:auto;
	background-color:#fff;
	border-radius:5px;
	box-shadow:0 0 5px #ccc;
	right:0;
	left:0;
	top:0;
	bottom:0;
	z-index:9999;
	overflow:hidden;
}
.index_popup_2{
	width:35%;
	height:270px;
	position:absolute;
	margin:auto;
	background-color:#fff;
	border-radius:5px;
	box-shadow:0 0 5px #ccc;
	right:0;
	left:0;
	top:0;
	bottom:0;
	z-index:9999;
	overflow:hidden;
	}			
.btn_index_popup{
	width:15%;
	display:inline-block;
	height:25px;
	line-height:25px;
	background-color: #FF2306;
	text-align:center;
	margin-right:1%;
	border-radius:5px;
	transition:all 0.2s ease;
	}
.btn_index_popup a{
	color:#fff !important;
	font-size:15px;	
	text-decoration:none;
	display:block;
	}		
.btn_index_popup:hover{background-color:#333;}	
.btn_index_popup a:hover{color:#fff;}
.dropdown-menu{bottom: 35px !important;}
.qty_box_cc{height:auto !important; overflow:visible !important}
	</style>


 
 
 <script src="js/takeaway.js"></script>

<script src="js/takeaway_menusel.js"></script>
<script src="js/takeaway_del.js"></script>

<script type="text/javascript"> 
		function validateSearch(type)
		{
			var menuname;
			if(type=="N")
			{
				menuname=($('#search').val());
			}else
			{
				menuname=($('#codesrch').val());
			}
			
			var dataString;//alert(menuname);
			dataString = 'value=menusearch&menuname='+menuname;
			$.ajax({
			type: "POST",
			url: "load_takeaway.php",
			data: dataString,
			success: function(data) {
				data=$.trim(data);
				if(data!="sorry")
				{
					var id_arr	  =	 data.split(",");
					var menuid       =  id_arr[0];
					var catid       =  id_arr[1];
					var subcatid       =  id_arr[2];//alert(subcatid);
					$(".ta_categorysel>div").removeClass("main_category_list_act");
					 $('.ta_categorysel').filter('[catid="catid_'+catid+'"]').find('div').addClass('main_category_list_act');
					 var datastring1;
					 if(subcatid!="")
					 {
					  datastring1 = 'value=subcatselection&category=' + catid +'&subcategory=' + subcatid;
					 }else
					 {
						  datastring1 = 'value=subcatselection&category=' + catid;
					 }
					 $('#ta_catname').val(catid);
					  $.ajax({
						type: "POST",
						url: "load_takeaway.php",
						data: datastring1,
						success: function(data) {
						 $('#ta_loadsubcat').html(data);
						 var subcategory=$('.ta_subcatchange').val();
						 var datastring2;
						 if(subcategory!="all")
							{
								datastring2 = 'value=menuselection&category=' + catid +'&menuid=' + menuid +'&subcategory=' + subcatid;
							}else
							{
								 datastring2 = 'value=menuselection&category=' + catid +'&menuid=' + menuid;
							}//alert(dataString)
						   $('#ta_loadmenuitems').html('<img src="img/ajax-loaders/ajax-loader.gif" height="70px" style="margin:auto"  />');
						   $('#ta_loadmenuitems').css("vertical-align","middle");
						   $('#ta_loadmenuitems').css("display","flex");
							 $.ajax({
								type: "POST",
								url: "load_takeaway.php",
								data: datastring2,
								success: function(data) {//alert(data);
										$('#ta_loadmenuitems').html(data);
										$('#ta_loadmenuitems').css("text-align","left");
										$('#ta_loadmenuitems').css("display","inherit");
										var bchid=$('#bchid').val();
										var dataString_new = 'value=menubottom&menuid=' + menuid +"&bchid="+bchid;
										$('#ta_loadbottomcontent').html('<img src="img/ajax-loaders/ajax-loader.gif" height="70px" style="margin:auto"  />');
									   $('#ta_loadbottomcontent').css("vertical-align","middle");
									   $('#ta_loadbottomcontent').css("display","flex");
										 $.ajax({
											type: "POST",
											url: "load_takeaway.php",
											data: dataString_new,
											success: function(data) {
													$('#ta_loadbottomcontent').html(data);
                                                                                                        $('#ta_loadbottomcontent').css("text-align","left");
													$('#ta_loadbottomcontent').css("display","inherit");
                                                                                                         $('#search').val("");
                                                                                                          $('#codesrch').val("");
												}
											});
										
										
									}
								});
						 
						 
						 
						}
					  });
					
				}
					//$('#ta_orderlist').html(data);
				}
	  		});
		}

	</script>
 <script type="text/javascript">
 function cpyaddress()
 {
	 var praddress = $("#ta_address").val();
	 $("#ta_orderaddress").val(praddress);
 }
 </script>   

<script>
$("#permnt_add").click(function(){
    $(".permnt_add").css("display","block");
	$(".order_add").css("display","none");
	$("#permnt_add").addClass("act_clr");
	$("#order_add").removeClass("act_clr");
	
});

$("#order_add").click(function(){
    $(".order_add").css("display","block");
	 $(".permnt_add").css("display","none");
	 $("#permnt_add").removeClass("act_clr");
	 $("#order_add").addClass("act_clr");
});




</script>

 <script>
function checkTime(i) {
    if (i < 10) {
        i = "0" + i;
    }
    return i;
}

function startTime() {
	
    var today = new Date();
    var h = today.getHours();
    var m = today.getMinutes();
    var s = today.getSeconds();
    // add a zero in front of numbers<10
    m = checkTime(m);
    s = checkTime(s);
    document.getElementById('time').innerHTML = h + ":" + m + ":" + s;
	
    t = setTimeout(function () {
        startTime()
    }, 500);
}
startTime();
</script>

<script type="text/javascript">

		$(".credit_cc").hide();
		$(".coupon_cc").hide();
		$(".voucher_cc").hide();
		$(".cheque_cc").hide();
		  
		
		$("#cash").click(function(){
			$(".pop_payment_mode_sel_btn").removeClass('mode_sel_btn_act');
		$(this).addClass('mode_sel_btn_act');
			$(".cash_cc").show(500);
                    $(".credit_cc").hide(500);
					$(".credit_cc_normal").hide(500);
                    $(".coupon_cc").hide(500);
					$(".voucher_cc").hide(500);
					$(".cheque_cc").hide(500);
					$('.paid_amount_cc').show(500);
					$('.paid_amount_cc_credit').hide(500);
					$('#ta_staffsubmit').show();
					$('#ta_staffclose').hide();
					$(".credit_type").hide(500);
					$(".complimentrary_management").hide(500);
					$(".complimentrary_cc").hide(500);
		});
		$("#credit").click(function(){
			$(".pop_payment_mode_sel_btn").removeClass('mode_sel_btn_act');
		$(this).addClass('mode_sel_btn_act');
			$(".cash_cc").hide(500);
					$(".credit_cc_normal").show(500);
                    $(".credit_cc").hide(500);
                    $(".coupon_cc").hide(500);
					$(".voucher_cc").hide(500);
					$(".cheque_cc").hide(500);
					$(".complimentrary_management").hide(500);
				    $(".complimentrary_cc").hide(500);
			     	$(".credit_type").hide(500);
					$('.paid_amount_cc').show(500);
					$('.paid_amount_cc_credit').hide(500);
					$('#ta_staffsubmit').show();
					$('#ta_staffclose').hide();
		});
		$("#coupon").click(function(){
			$(".pop_payment_mode_sel_btn").removeClass('mode_sel_btn_act');
		$(this).addClass('mode_sel_btn_act');
			$(".cash_cc").hide(500);
                    $(".credit_cc").hide(500);
					$(".credit_cc_normal").hide(500);
                    $(".coupon_cc").show(500);
					$(".voucher_cc").hide(500);
					$(".cheque_cc").hide(500);
					$(".complimentrary_management").hide(500);
				$(".complimentrary_cc").hide(500);
				$(".credit_type").hide(500);
				$('.paid_amount_cc').show(500);
					$('.paid_amount_cc_credit').hide(500);
					$('#ta_staffsubmit').show();
					$('#ta_staffclose').hide();
					
		});
		$("#voucher").click(function(){
			$(".pop_payment_mode_sel_btn").removeClass('mode_sel_btn_act');
		$(this).addClass('mode_sel_btn_act');
			$(".cash_cc").hide(500);
                    $(".credit_cc").hide(500);
					$(".credit_cc_normal").hide(500);
                    $(".coupon_cc").hide(500);
					$(".complimentrary_management").hide(500);
					$(".complimentrary_cc").hide(500);
					$(".credit_type").hide(500);
					$(".voucher_cc").show(500);
					$(".cheque_cc").hide(500);
					$('.paid_amount_cc').show(500);
					$('.paid_amount_cc_credit').hide(500);
					$('#ta_staffsubmit').show();
					$('#ta_staffclose').hide();
		});
		$("#cheque").click(function(){
			$(".pop_payment_mode_sel_btn").removeClass('mode_sel_btn_act');
		$(this).addClass('mode_sel_btn_act');
			$(".cash_cc").hide(500);
                    $(".credit_cc").hide(500);
					$(".credit_cc_normal").hide(500);
                    $(".coupon_cc").hide(500);
					$(".voucher_cc").hide(500);
					$(".complimentrary_management").hide(500);
				$(".complimentrary_cc").hide(500);
				$(".credit_type").hide(500);
					$(".cheque_cc").show(500);
					$('.paid_amount_cc').show(500);
					$('.paid_amount_cc_credit').hide(500);
					$('#ta_staffsubmit').show();
					$('#ta_staffclose').hide();
		});
		$("#credit_person").click(function(){
			$(".pop_payment_mode_sel_btn").removeClass('mode_sel_btn_act');
		$(this).addClass('mode_sel_btn_act');
			$(".cash_cc").hide(500);
                    $(".credit_cc").hide(500);
					$(".credit_cc_normal").hide(500);
                    $(".coupon_cc").hide(500);
					$(".voucher_cc").hide(500);
					$(".cheque_cc").hide(500);
					$(".complimentrary_management").hide(500);
					$(".complimentrary_cc").hide(500);
					$(".credit_type").show(500);
					$('.paid_amount_cc').hide(500);
					$('.paid_amount_cc_credit').show(500);
	        		$('#ta_staffsubmit').hide();
					$('#ta_staffclose').show();
		});
		$("#complimentary").click(function(){
			$(".pop_payment_mode_sel_btn").removeClass('mode_sel_btn_act');
		$(this).addClass('mode_sel_btn_act');
			$(".cash_cc").hide(500);
                  $(".cash_cc").hide(500);
                    $(".credit_cc").hide(500);
					$(".credit_cc_normal").hide(500);
                    $(".coupon_cc").hide(500);
					$(".voucher_cc").hide(500);
					$(".cheque_cc").hide(500);
					$(".credit_type").hide(500);
					$(".complimentrary_management").hide(500);
					$(".complimentrary_cc").show(500);
					$('.paid_amount_cc').hide(500);
					$('.paid_amount_cc_credit').hide(500);
	        		$('#ta_staffsubmit').hide();
					$('#ta_staffclose').show();
		});
		
		
		
        /*$("select").change(function(){
            $( "select option:selected").each(function(){
				if($(this).attr("value")=="cash"){
					$(".cash_cc").show(500);
                    $(".credit_cc").hide(500);
					$(".credit_cc_normal").hide(500);
                    $(".coupon_cc").hide(500);
					$(".voucher_cc").hide(500);
					$(".cheque_cc").hide(500);
					$('.paid_amount_cc').show(500);
					$('.paid_amount_cc_credit').hide(500);
					$('#ta_staffsubmit').show();
					$('#ta_staffclose').hide();
                }
                if($(this).attr("value")=="credit"){
					
					$(".cash_cc").hide(500);
					$(".credit_cc_normal").show(500);
                    $(".credit_cc").hide(500);
                    $(".coupon_cc").hide(500);
					$(".voucher_cc").hide(500);
					$(".cheque_cc").hide(500);
					$(".complimentrary_management").hide(500);
				    $(".complimentrary_cc").hide(500);
			     	$(".credit_type").hide(500);
					$('.paid_amount_cc').show(500);
					$('.paid_amount_cc_credit').hide(500);
					$('#ta_staffsubmit').show();
					$('#ta_staffclose').hide();

					$("#transcationid").focus();
                }
              if($(this).attr("value")=="coupon"){
				  $(".cash_cc").hide(500);
                    $(".credit_cc").hide(500);
					$(".credit_cc_normal").hide(500);
                    $(".coupon_cc").show(500);
					$(".voucher_cc").hide(500);
					$(".cheque_cc").hide(500);
					$(".complimentrary_management").hide(500);
				$(".complimentrary_cc").hide(500);
				$(".credit_type").hide(500);
				$('.paid_amount_cc').show(500);
					$('.paid_amount_cc_credit').hide(500);
						$('#ta_staffsubmit').show();
					$('#ta_staffclose').hide();

                }
				if($(this).attr("value")=="voucher"){
					$(".cash_cc").hide(500);
                    $(".credit_cc").hide(500);
					$(".credit_cc_normal").hide(500);
                    $(".coupon_cc").hide(500);
					$(".complimentrary_management").hide(500);
				$(".complimentrary_cc").hide(500);
				$(".credit_type").hide(500);
					$(".voucher_cc").show(500);
					$(".cheque_cc").hide(500);
					$('.paid_amount_cc').show(500);
					$('.paid_amount_cc_credit').hide(500);
							$('#ta_staffsubmit').show();
					$('#ta_staffclose').hide();
           }
				if($(this).attr("value")=="cheque"){
					$(".cash_cc").hide(500);
                    $(".credit_cc").hide(500);
					$(".credit_cc_normal").hide(500);
                    $(".coupon_cc").hide(500);
					$(".voucher_cc").hide(500);
					$(".complimentrary_management").hide(500);
				$(".complimentrary_cc").hide(500);
				$(".credit_type").hide(500);
					$(".cheque_cc").show(500);
					$('.paid_amount_cc').show(500);
					$('.paid_amount_cc_credit').hide(500);
					$('#ta_staffsubmit').show();
					$('#ta_staffclose').hide();
       }
				
				if($(this).attr("value")=="credit_person"){
					$(".cash_cc").hide(500);
                    $(".credit_cc").hide(500);
					$(".credit_cc_normal").hide(500);
                    $(".coupon_cc").hide(500);
					$(".voucher_cc").hide(500);
					$(".cheque_cc").hide(500);
					$(".complimentrary_management").hide(500);
					$(".complimentrary_cc").hide(500);
					$(".credit_type").show(500);
					$('.paid_amount_cc').hide(500);
					$('.paid_amount_cc_credit').show(500);
	        		$('#ta_staffsubmit').hide();
					$('#ta_staffclose').show();

                }
				if($(this).attr("value")=="complimentary"){
					$(".cash_cc").hide(500);
                    $(".credit_cc").hide(500);
					$(".credit_cc_normal").hide(500);
                    $(".coupon_cc").hide(500);
					$(".voucher_cc").hide(500);
					$(".cheque_cc").hide(500);
					$(".credit_type").hide(500);
					$(".complimentrary_management").hide(500);
					$(".complimentrary_cc").show(500);
					$('.paid_amount_cc').hide(500);
					$('.paid_amount_cc_credit').hide(500);
	        		$('#ta_staffsubmit').hide();
					$('#ta_staffclose').show();

                }
				if($(this).attr("value")=="comp_management"){
					$(".cash_cc").hide(500);
                    $(".credit_cc").hide(500);
					$(".credit_cc_normal").hide(500);
                    $(".coupon_cc").hide(500);
					$(".voucher_cc").hide(500);
					$(".cheque_cc").hide(500);
					$(".credit_type").hide(500);
					$(".complimentrary_cc").hide(500);
					$(".complimentrary_management").show(500);
					$('.paid_amount_cc').hide(500);
					$('.paid_amount_cc_credit').hide(500);
	        		$('#ta_staffsubmit').hide();
					$('#ta_staffclose').show();

                }
				
				
            });
        }).change();*/
	
	

	/***************************************  credit types ends **********************************************************  */
       </script> 



 <style>
 .right_drop_menu {    bottom: inherit !important;}
 .logout_drop{bottom: inherit !important;}
 </style>   
    
    
    
 


</body>
</html>
