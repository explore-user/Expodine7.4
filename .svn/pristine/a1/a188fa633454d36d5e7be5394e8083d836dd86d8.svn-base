<?php

include('includes/session.php');		// Check session
//session_start();
include("database.class.php"); // DB Connection class
$database	= new Database();
include('includes/master_settings.php');
if(!isset($_SESSION['timeopen']) ){ header("location:index.php?msg=1"); }
if(!isset($_SESSION['order_id']))
{
$orderid="TEMP*".$database->getEpoch();
$_SESSION['order_id']=$orderid;
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
<link href="css/take_away.css" rel="stylesheet" type="text/css">
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
	});
	</script>
      <!--ESC Key press ends-->

<style>
.ui-autocomplete{z-index:999999 !important;max-height: 400px;    height: auto; overflow: scroll;}
.new_right_drop{margin-top:-8px;}
.tka_sum_btn_cc{ padding: 1% 1.2%;}
.order_list_cont{background-color: rgba(30, 46, 62, 0.65);}
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
$sql_menulist= "Select tbl_portionmaster.pm_portionshortcode as portion,tbl_menumaster.mr_itemshortcode as menu,tbl_takeaway_billdetails.tab_qty as qty ,tbl_takeaway_billdetails.tab_menuid as menuid,tbl_takeaway_billdetails.tab_slno as slno From tbl_takeaway_billdetails Inner Join tbl_menumaster On tbl_takeaway_billdetails.tab_menuid = tbl_menumaster.mr_menuid Inner Join tbl_portionmaster On tbl_takeaway_billdetails.tab_portion = tbl_portionmaster.pm_id Where tbl_takeaway_billdetails.tab_billno = '".$_SESSION['order_id']."' order by tbl_takeaway_billdetails.tab_slno ";
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
      <div class="top_site_map_cc ">
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
                    <div class="top_al_search_cc take_search" style="width:40%">
                    <span style="width: 16%;float: left;text-align: left;font-size: 16px;">Name</span>
                    <span style="float: left;width: 84%;"><input class="search" placeholder="Search " name="search" id="search" type="text" onKeyPress="validateSearch('N')" onKeyDown="validateSearch('N')" onKeyUp="validateSearch('N')" onChange="validateSearch('N')" onBlur="validateSearch('N')" style="float: left;width: 100%;margin-right: 0;"></span>
                </div>
                   
                	<div class="top_al_search_cc" style="width: 25%;">
                    	<select style="margin: 1.0% 0 !important;width: 97%;" class="sub_item_drop ta_subcatchange" id="ta_loadsubcat">
                        	 <?php
							   $_SESSION['sel_sub_id']=NULL;
							  $sql_sub  =  $database->mysqlQuery("select distinct(mr_subcatid) as subid from tbl_menumaster where mr_active='Y' and mr_maincatid='".$_SESSION['sel_cat_id']."' and mr_subcatid IS NOT NULL order by mr_maincatid"); 
							 echo  $num_sub  = $database->mysqlNumRows($sql_sub);
                                                         echo "select distinct(mr_subcatid) as subid from tbl_menumaster where mr_active='Y' and mr_maincatid='".$_SESSION['sel_cat_id']."' and mr_subcatid IS NOT NULL order by mr_maincatid";
							  if($num_sub){$k=0;$k++;
							  ?>
                               <option value="all" <?php if($k==1){ ?>  selected <?php } ?>>All</option>
                              <?php
								  while($result_sub  = $database->mysqlFetchArray($sql_sub)) 
									  { $k++;
									  if($result_sub['subid']!=""){
										  $menusub=$database->show_subcategory_ful_details($result_sub['subid']);
			   					?>  
							  <option value="<?=$menusub['msy_subcategoryid']?>"><?=$menusub['msy_subcategoryname']?></option>
							  <?php }  } } else {?>
                              <option value=""  selected >No Sub Category</option>
                              <?php } ?> 
                        </select>
                    </div>
                </div><!--top_head-->
                 <input type="hidden" name="bchid" id="bchid" value="<?=$_SESSION['branchofid']?>">
                      <input type="hidden" name="ordrid" id="ordrid" value="<?=$_SESSION['order_id']?>">  
               <div class="menu_item_contain" id="ta_loadmenuitems">
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
             <div class="bottom_edit_cc " id="ta_loadbottomcontent">
             	
             </div><!--bottom_edit_cc-->  
             
             <!-- *********************************** portion qty preference  stops**********************************************  -->  
             
             
              
           </div><!--tkw_sub_items_cc-->
            
        </div><!--left_contant_container-->
        
        <div class="right_order_inform right_calc_cc">
        	<div class="right_main_cc">
             	<div class="top_head">Contact Details</div>
                <div style="height:40px;" class="right_con_inform_cc">
                	<div style="" class="cont_detail_name home_dlvry_cont">
                    Home Delivery  &nbsp;<input class="home_dry_chk home"  name="ts_homed" id="ts_homed" type="checkbox" value="">
                   <span style="margin-left:2%"> Take Away  &nbsp;<input class="home_dry_chk take"  name="ts_take" id="ts_take" type="checkbox" value=""></span>
                    </div>
                    <div class="cont_detail_box"></div>
                </div><!--right_con_inform_cc-->
                
                <!--<div class="right_con_inform_cc">
                	<div class="cont_detail_name">Code</div>
                    <div class="cont_detail_box"><input class="cont_typ_bx" placeholder="Code" name="code" type="text"></div>
                </div>--><!--right_con_inform_cc-->
                <div class="right_con_inform_cc">
                	<div class="cont_detail_name" style="width:22%">Mobile<span style="color:#F00;display:none;float:right" class="enmobile">*</span></div>
                    <div class="cont_detail_box"><input class="cont_typ_bx" placeholder="mobile" type="text" name="ta_mobile"  id="ta_mobile"></div>
                </div><!--right_con_inform_cc-->
                 <div class="right_con_inform_cc">
                	<div class="cont_detail_name" style="width:19%">Name<span style="color:#F00;display:none;float:right" class="enmobile">*</span></div>
                    <div class="cont_detail_box"><input class="cont_typ_bx " placeholder="Name" name="ta_name" id="ta_name" type="text" onKeyPress="searchname()" onKeyDown="searchname()" onKeyUp="searchname()" onChange="searchname()" onBlur="searchname()"></div>
                    <input type="hidden" name="hid_namv" id="hid_namv" >
                </div><!--right_con_inform_cc-->
                 <div style="height:120px" class="right_con_inform_cc">
                	<div id="permnt_add" class="cont_detail_name address_1 act_clr">Permanent Address</div>
                    <div id="order_add" class="cont_detail_name address_1">Order Address</div> 
                    <div class="cont_detail_box permnt_add"><textarea style="height:100px;margin-top:3px;" class="cont_typ_bx" placeholder="Permanent Address" name="ta_address"  id="ta_address" type="text"></textarea></div>
                    <div style="height:120px;display:none;" class="right_con_inform_cc order_add">
                    <div class="cont_detail_box">
                    <!--<a style="cursor:pointer" onClick="cpyaddress();">Copy</a>-->
                    <textarea style="height:100px;" class="cont_typ_bx" placeholder="Order Address" name="ta_orderaddress"  id="ta_orderaddress" type="text"></textarea></div>
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
                <div style="width:50%" class="tka_sum_btn_cc" id=""><a class="tka_submit_buton ta_submit_orders"  style="cursor:pointer" settype="N">Generate</a></div>
                <div style="width:50%" class="tka_sum_btn_cc " id="submitbuttonstatus"><a class="tka_submit_buton ta_submit_orders" settype="Y"  style="cursor:pointer" >Print</a></div>
                <div class="tka_sum_btn_cc"><a class="tka_submit_buton" href="take_away_kot.php">View Order</a></div>

                
            </div><!--right_main_cc---> 
        </div><!---right_order_inform-->
        
        <div style="width:100%;" class="bottom_view_quicklist">
        	<div class="botom_orderlist_head">
            	<div  class="ta_listtotalrate" >Total Rs : <span class="tal_viewtotal"></span> </div>
            	Order List
                <div class="ta_shownofoitem" style="text-transform:none"></div>
            	<div class="order_list_showing_delete" id="ta_deleteitems"><img  src="img/delete-icon1.png"></div>
                <div class="order_list_showing_delete" id="ta_edititems" style="display:none;right:35px"><img style="height:30px" src="img/edit_dishitem.png"></div>
            </div>
            <div class="order_list_cont" id="ta_orderlist">
            	
                <!--<div class="item_ordered_list ordered_selected">
                	<div class="order_list_item_bg"><img src="img/orderd_list.png">
                    	<div class="ordered_list_name">CB</div>
                     </div>
                      <div class="ordered_item_potion">H</div>
                        <div class="ordered_item_quantity">12</div>
                </div>-->
                <?php
				$total=0;
				 $sql_menulist= "Select tbl_portionmaster.pm_portionshortcode as portion,tbl_menumaster.mr_itemshortcode as menu,tbl_takeaway_billdetails.tab_qty as qty ,tbl_takeaway_billdetails.tab_menuid as menuid,tbl_takeaway_billdetails.tab_slno as slno,tbl_takeaway_billdetails.tab_amount,tbl_takeaway_billdetails.tab_preferencetext,tbl_takeaway_billdetails.tab_rate From tbl_takeaway_billdetails Inner Join tbl_menumaster On tbl_takeaway_billdetails.tab_menuid = tbl_menumaster.mr_menuid Inner Join tbl_portionmaster On tbl_takeaway_billdetails.tab_portion = tbl_portionmaster.pm_id Where tbl_takeaway_billdetails.tab_billno = '".$_SESSION['order_id']."' order by tbl_takeaway_billdetails.tab_slno ";
				$sql_menus  =  $database->mysqlQuery($sql_menulist); 
				$num_menus  = $database->mysqlNumRows($sql_menus);
				if($num_menus){$_SESSION['submitbutst']="1";
					while($result_menus  = $database->mysqlFetchArray($sql_menus)) 
						{$total+=$result_menus['tab_amount'];
				?>
                <div class="item_ordered_list" menuid="<?=$result_menus['menuid']?>" slno="<?=$result_menus['slno']?>">
                	<div class="order_list_item_bg"><img src="img/orderd_list.png">
                    	<div class="ordered_list_name"><?=$result_menus['menu']?></div>
                    </div>
                      <div class="ordered_item_potion"><?=$result_menus['portion']?></div>
                      <div class="ordered_item_quantity"><?=$result_menus['qty']?></div>
                      <div class="ordered_item_pref" style="display:none"><?=$result_menus['tab_preferencetext']?></div>
                      <div class="ordered_item_rate" style="display:none"><?=$result_menus['tab_rate']?></div>
                      
                </div>
               
                <?php }  
				echo '<script type="text/javascript">';
		echo '$(document).ready(function(){';
		echo '$(".tal_viewtotal").text(('.$total.').toFixed('.$_SESSION["be_decimal"].'))';
		echo '});';
		echo '</script>';
				
				 }else{  $_SESSION['submitbutst']="0";} ?>
                
                
                
            </div><!---order_list_cont--->
        </div><!--bottom_view_quicklist-->
        
      </div><!--middle_container-->          
</div>
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




 <!----dock----> 
  <?php /*?> <?php include "includes/top_main_menu.php"; ?><?php */?>
 <!----dock----> 
 
 
 <script src="js/takeaway.js"></script>

<script src="js/takeaway_menusel.js"></script>
<script src="js/takeaway_del.js"></script>
 <script src="js/takeaway_each.js"></script>

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
 <style>
 .right_drop_menu {    bottom: inherit !important;}
 </style>   
    
    
    
 


</body>
</html>
