<?php
session_start();

include("database.class.php");       // DB Connection class
$database	= new Database();
  $id = $_GET['id'];
  
  $sqlstaffname=$database->mysqlQuery("SELECT ser_designation,ser_firstname from tbl_staffmaster where ser_staffid='".$id."'");
  $num_staffname   = $database->mysqlNumRows($sqlstaffname);
  $result_staffname  = $database->mysqlFetchArray($sqlstaffname);
  
  $staffname=$result_staffname['ser_firstname'];
  $desgn=$result_staffname['ser_designation'];
  
  
  $sqlstaffname=$database->mysqlQuery("SELECT ser_designation,ser_firstname from tbl_staffmaster where ser_staffid='".$id."'");
  $num_staffname   = $database->mysqlNumRows($sqlstaffname);
  $result_staffname  = $database->mysqlFetchArray($sqlstaffname);
  
  $staffname=$result_staffname['ser_firstname'];
  $desgn=$result_staffname['ser_designation'];
  
  
  $sql_login  =  $database->mysqlQuery("select tap_staff_id from tbl_app_permissions  Where tap_staff_id='$id'"); 

  $num_login   = $database->mysqlNumRows($sql_login);

   if(!$num_login){
  
  $query5= $database->mysqlQuery("insert into tbl_app_permissions(tap_staff_id,tap_staffname) values ('$id','$staffname') "); 
  
  }
  
  
if($_SERVER['REQUEST_METHOD']=='POST' )
{                                                                                          
          $query5= $database->mysqlQuery("update tbl_staffmaster set ser_cancelpermission='".$_REQUEST['cancelpermission']."',"
          . " ser_bill_cancel_permission='".$_REQUEST['billcancelpermission']."',"
          . " ser_discountpermission='".$_REQUEST['discpermission']."',ser_compl_mgmt='".$_REQUEST['complmgnt']."',"
          . " ser_discount_manual='".$_REQUEST['manualdisc']."',"
          . " ser_stockchng_permission='".$_REQUEST['stockchngpermission']."',ser_cancelwithkey='".$_REQUEST['cancelwithkey']."',ser_kot_cancel_permission='".$_REQUEST['kotcancel']."',"
          . " ser_counter_enable_generate='".$_REQUEST['counterenable']."',ser_counter_enable_hold='".$_REQUEST['counterhold']."',ser_shift_permission='".$_REQUEST['shiftopen']."',"
          . " ser_permit_cash_drawer_open='".$_REQUEST['cashdrawer1']."',ser_release_login='".$_REQUEST['releaselogin']."',ser_bill_regen_per='".$_REQUEST['regenerate_staff']."',"
          . " ser_bill_reprint_per='".$_REQUEST['bill_reprint_staff']."',ser_kot_reprint_per='".$_REQUEST['kot_reprint_staff']."',ser_bill_settle_change_per='".$_REQUEST['change_staff']."',"
          . " ser_order_split_permission='".$_REQUEST['order_split']."',ser_dayclose_permission='".$_REQUEST['dayclose_permission_st']."',ser_tip_edit_permission='".$_REQUEST['tip_edit_permission']."',"
          . " ser_dayclose_revert_permission='".$_REQUEST['dayclose_revert']."',ser_bill_reset='".$_REQUEST['bill_reset']."',ser_credit_view='".$_REQUEST['credit_view']."',"
          . " ser_comp_view='".$_REQUEST['comp_view']."',ser_credit_permission='".$_REQUEST['credit_perm']."',ser_comp_permission='".$_REQUEST['comp_perm']."',"
          . " ser_bill_print_permission='".$_REQUEST['bill_print_perm']."',"
          . " ser_bill_settle_permission='".$_REQUEST['bill_settle_perm']."',ser_change_table_permission='".$_REQUEST['table_change']."', "
          . " ser_advance_pay_permission='".$_REQUEST['adv_permision']."', "
          . " ser_counter_settle_permission='".$_REQUEST['counter_settle_permision']."',ser_com_item='".$_REQUEST['comp_item']."',"
          . " ser_force_close='".$_REQUEST['shiftclose']."' ,  "
          . " ser_discount_after='".$_REQUEST['disc_after_settle']."',ser_all_shift_closer='".$_REQUEST['shift_all_settle']."' ,ser_online_order='".$_REQUEST['online_order_permision']."',"
          . " ser_physical_stock_permission='".$_REQUEST['phy_stock']."' ,ser_wastage_entry='".$_REQUEST['wastage']."',"
          . " ser_stock_entry='".$_REQUEST['stock_entry']."',`ser_req`='".$_REQUEST['requisition']."',"
          . " `ser_po`='".$_REQUEST['po']."',`ser_rps`='".$_REQUEST['rps']."',`ser_store_transfer`='".$_REQUEST['store_transfer']."',`ser_return_history`='".$_REQUEST['return_history']."',"
          . " `ser_inventory_reports`='".$_REQUEST['reports']."',`ser_purchase_return`='".$_REQUEST['purchase_return']."',"
          . " `ser_consumption`='".$_REQUEST['consumption']."' ,`ser_store_stock`='".$_REQUEST['store_stock']."' ,"
          . " `ser_dashboard`='".$_REQUEST['dashboard']."' ,`ser_recipe`='".$_REQUEST['recipe']."',`ser_production`='".$_REQUEST['production']."' ,ser_central_kitchen='".$_REQUEST['central_kitchen']."' ,"
          . " ser_central_accept='".$_REQUEST['central_kitchen_accept']."' ,ser_item_discount_manual='".$_REQUEST['item_discount_manual']."',ser_indent='".$_REQUEST['indent']."',"
          . " ser_menu_unit_edit='".$_REQUEST['menu_unit_edit']."', ser_delete_menu='".$_REQUEST['delete_menu']."',ser_indent_accept='".$_REQUEST['indent_accept']."',"
          . " ser_approve_cancel_inv='".$_REQUEST['rps_approve_cancel']."',ser_direct_transfer='".$_REQUEST['direct_transfer']."',"
          . " ser_direct_transfer_accept='".$_REQUEST['direct_transfer_accept']."',ser_normal_transfer_accept='".$_REQUEST['store_transfer_accept']."' where ser_staffid='$id'"); 
  
  
  $query6= $database->mysqlQuery("update tbl_logindetails set ls_applogin='".$_REQUEST['applogin']."',ls_restrict_login='".$_REQUEST['loginrestrict']."'  where ls_staffid='$id'"); 

  
  
  
  $query566= $database->mysqlQuery("update tbl_app_permissions set tap_app_login='".$_REQUEST['tap_app_login']."' , "
 . " `tap_dinein_module`='".$_REQUEST['tap_dinein_module']."',`tap_tahd_module`='".$_REQUEST['tap_tahd_module']."',"
 . " `tap_cs_module`='".$_REQUEST['tap_cs_module']."' , "
 . " `tap_item_cancel`='".$_REQUEST['tap_item_cancel']."', `tap_bill_cancel`='".$_REQUEST['tap_bill_cancel']."' ,"
 . "  tap_table_change='".$_REQUEST['tap_table_change']."',`tap_bill_reprint`='".$_REQUEST['tap_bill_reprint']."' ,"
 . " tap_settle_dinein='".$_REQUEST['tap_settle_dinein']."', tap_settle_ta_hd='".$_REQUEST['tap_settle_ta_hd']."' ,"
 . " tap_settle_cs='".$_REQUEST['tap_settle_cs']."', tap_shift='".$_REQUEST['tap_shift']."',tap_discount='".$_REQUEST['tap_discount']."' ,"
 . " tap_regenerate='".$_REQUEST['tap_regenerate']."',tap_complimentary='".$_REQUEST['tap_complimentary']."',tap_tip='".$_REQUEST['tap_tip']."' ,"
 . " tap_hold='".$_REQUEST['tap_hold']."',tap_all_settle='".$_REQUEST['tap_all_settle']."' where tap_staff_id='$id' "); 
  
  
 $sql_general_sync =  $database->mysqlQuery("update  tbl_staffmaster set ser_app_change='Y' ");
 
  
}
?>
 


<!doctype html>
<html ng-app="website">
<head>
<meta charset="utf-8">
<title>Permissions</title>
<meta name="description" content="">
<link href="images/favicon.png" rel="shortcut icon">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
<link rel="shortcut icon" href="img/favicon.ico">
<link rel="stylesheet" href="master_style/themify-icons.css" type="text/css" /><!-- Icons -->
<link href="css/menu_master_style.css" rel="stylesheet">
<link id="bs-css" href="css/bootstrap-cerulean.min.css" rel="stylesheet">
<link rel="stylesheet" href="master_style/website.css" type="text/css">
<link rel="stylesheet" href="master_style/responsive.css" type="text/css" /><!-- Responsive -->	
<link rel="stylesheet" href="css/normal.css" type="text/css" /><!-- Responsive -->
<link rel="stylesheet" href="master_style/demo.css">	
<link rel="stylesheet" href="master_style/table_style.css">	
<link rel="stylesheet" type="text/css" href="master_style/default.css" />
<link rel="stylesheet" type="text/css" href="master_style/component.css" />
<link rel="stylesheet" type="text/css" href="master_style/popup/default.css" />
<link rel="stylesheet" type="text/css" href="master_style/popup/component.css" />
 <link href="master_style/app.css" rel="stylesheet" type="text/css">
 <link rel="stylesheet" type="text/css" media="screen" href="css/als_demo.css" />
 <script src="js/jquery-2.1.3.min.js"></script><!--jquery-1.10.2.min-->
<script src="master_style/js/modernizr.custom.js"></script>
<style>
.container{background-color:transparent;}
aside { width: 238px !important}
.min-nav aside {width: 60px !important;}
.ui-autocomplete{z-index:999999 !important;}
.contant_table_cc{height: 74vh;min-height: 474px;}
.md-content > div{overflow:auto}
.form_name_cc{font-size:13px;height:30px;line-height:30px;}
.first_form_contain{padding: 0.5%;margin-bottom: 0px;}
.md-modal{width:70%;min-width:800px;}
.md-content > div{max-height:550px;overflow:auto;padding-bottom:60px;}
.md-modal .form-control{ height: 33px;padding: 5px 12px;}
.popup_add_table tr:nth-child(even) {background: #E0E0E0;}
.popup_add_table td {height: 38px;font-size: 14px;border:solid 1px #ccc;}
.md-content .form_name_cc{text-align:left;line-height:22px;min-height:30px;height:auto}
.new{width:27px;height:27px;float:right}
.new-cl{height:auto !important;}
.toggle-menu{display:none}
#container{overflow:auto}
    .inherit_btn{float: left;margin-left: 5px;}
    .permission_top_btn{border-bottom: 3px solid #c11d00;background-color: #e83616;border-radius: 6px;}
    .change_permission_popup {width: 350px;height: 120px;margin: auto;position: fixed;left: 0;right: 0;top: 20%;background-color: #fff;z-index: 9999999;display: none;}.change_permission_popup h3 {
    margin: 0;padding: 0.4em;text-align: center;font-size:16px;font-weight: 300;opacity: 0.8;    background: rgba(0,0,0,0.2);border-bottom: 1px #9A9898 solid;border-radius: 3px 3px 0 0;color: #000;}.change_permission_content {width: 100%;height: auto;float: left;padding: 2%;}.edit_menu_label_permission {width: 100%;height: auto;float: left;margin-bottom: 10px;}.edit_menu_label_permission .label_main_member_edit {width: 15% !important;line-height: 25px !important;    font-family: 'Arimo';font-size: 14px;color: #333;padding-left: 5px;padding-top: 4px;float: left;}.edit_menu_label_permission .form-control_main {display: block;width: 83%;
    float: left;height: 34px;padding: 6px 12px;border-radius: 5px;font-size: 14px;line-height: 1.42857143;color: #555;background-color: #fff;background-image: none;border: 1px solid #ccc;}
    .change_permission_popup_btn {width: 100%;height: 40px;float: left;text-align: center;margin-top: -2px;}.pop_btn_new_1 { width: 100px !important; height: 30px !important;display: inline-block;margin: auto;    background-color: #891500;color: #fff;text-align: center;line-height: 30px !important;font-size: 14px;
    border-radius: 5px;margin: 1%;cursor: pointer;transition: all 0.2s ease;}.change_permission_overlay{background-color: rgba(0,0,0,0.8);position: fixed;width: 100%;
    height: 100%;top: 0;left: 0;z-index: 999999;display: none;}
    .md-overlay{z-index:1}
.md-modal{z-index: 2}
.new_overlay{z-index:2 !important}
.md-content{z-index: 3 !important}
.change_permission_popup{z-index:3 !important}
.change_permission_overlay{z-index: 3 !important}

.change_permission_popup1 {width: 350px;height: 120px;margin: auto;position: fixed;left: 0;right: 0;top: 20%;background-color: #fff;z-index: 9999999;display: none;}.change_permission_popup1 h3 {
    margin: 0;padding: 0.4em;text-align: center;font-size:16px;font-weight: 300;opacity: 0.8;    background: rgba(0,0,0,0.2);border-bottom: 1px #9A9898 solid;border-radius: 3px 3px 0 0;color: #000;}.change_permission_content {width: 100%;height: auto;float: left;padding: 2%;}.edit_menu_label_permission {width: 100%;height: auto;float: left;margin-bottom: 10px;}.edit_menu_label_permission .label_main_member_edit {width: 15% !important;line-height: 25px !important;    font-family: 'Arimo';font-size: 14px;color: #333;padding-left: 5px;padding-top: 4px;float: left;}.edit_menu_label_permission .form-control_main {display: block;width: 83%;
    float: left;height: 34px;padding: 6px 12px;border-radius: 5px;font-size: 14px;line-height: 1.42857143;color: #555;background-color: #fff;background-image: none;border: 1px solid #ccc;}
    
.change_permission_popup1{z-index:3 !important}
</style>

</head>
<body style="overflow:auto">
    
    <input type="hidden" value="<?=$id?>" id="staff_id_inherit" >
    
    
<div class="olddiv "></div> 
<div class="container nopaddding">
 <?php  include "includes/topbar_master.php"; ?>
 <?php /*?><?php include "includes/left_menu.php"; ?><?php */?>
<div class="mian">
	<div class="view-container">
		<div style=" top: 58px;left:0;width:100%;background-color: rgb(181, 181, 181);"  id="container">
			<!--<div class="breadcrumbs">
				<ul>
					<li><a href="admin_home.php" style="cursor:pointer"><i class="ti-home"></i></a>/</li>
					<li><a style="cursor:pointer">Branch Master</a></li>
				</ul>
			</div>--><!-- breadcrumbs -->
            
            
                <div class="content-sec">
                
               
                
    <div style="padding: 2px;" class="col-lg-12 col-md-12 main_cc">
    <div class="branch_master_main_container" style="overflow:visible;">
    <a  href="#" onclick="returntostaff('<?=$id?>');"><div style="width: auto;border-radius: 0  ;color: black;font-weight: bold;z-index:1;background-color: #6bbfbb;padding-right: 10px;border-radius: 5px" class="permision_top_back_btn"><img src="img/back_btn.png"> STAFF MASTER</div></a>
   
   <div class="new_branch_main_setings_head permission_main_head" >
        
    <span style="text-transform: uppercase;font-weight: bold;color: darkred "><?= $staffname?> 
      
    <?php if($id=='1'){ ?> 
                                   
    <span style="float: right;font-size: 10px;font-weight: bold;margin-right: 6px;
    text-decoration: underline;cursor: pointer;" onclick="no_sync()"> APP NO SYNC FROM LOCAL</span> 
    
    <?php } ?>
                                   
    </span> 
                            	
    </div> 
                           
                             	<form role="form" action="permissions.php?id=<?=$id?>"  method="post" id="permissionset"  name="permission_new">
                                <div class="permission_content_cc">
                                	<div class="permission_left_div" style="margin-left:0">
                                        
                                    	<div class="permission_left_div_head" style="font-size:15px">
                                            
                                            <?php if($id!='1'){ ?>
                                            
                                            <a style=""  href="#">
                                                
                                            <div style="background-color:#e4aea4;color:black;width: 50px" class="permission_top_btn inherit_btn inherit_btn_click" mode="Staff_Permission">Inherit</div>
                                            
                                            </a>
                                             
                                            <?php } ?>
                                            
                                            GENERAL PERMISSION
                                        	<a href="#"><div class="permission_top_btn permi_edit1">Edit</div></a>
                                		<a href="#"><div style="display:none;width: 45px;" class="permission_top_btn permi_save1">Save</div></a>
                                                <a href="#"><div style="display:none" class="permission_top_btn permi_cancel">Cancel</div></a>
                                        </div>
                                            <?php 
                                            $chk_all='';
                                            $kotcancel='';$cancelpermission='';$billcancelpermission='';$discountpermission='';$complpermission='';$manualdiscount='';$stockchange='';$cancelwithkey='';$applogin='';$counterenable='';$cashdrawer1='';$counterhold='';$shiftopen='';$loginrestrict='';$order_split='';$dc_per='';
                                            $sql_login  =  $database->mysqlQuery("select * from tbl_staffmaster ts left join tbl_logindetails tl on tl.ls_staffid=ts.ser_staffid "
                                            . " Where ser_staffid='$id'"); 

                                          $num_login   = $database->mysqlNumRows($sql_login);

                                          if($num_login){
                                                  while($result_login  = $database->mysqlFetchArray($sql_login)) 
			                       {
//                                                
                                                   $chk_all= $result_login['ser_inv_check_all'];
                                                      
                                                if($result_login['ser_cancelpermission']=="Y")
                                                    {

                                                            $cancelpermission="Yes";
                                                    }else 
                                                    {
                                                            $cancelpermission="No";
                                                    }
                                                if($result_login['ser_bill_cancel_permission']=="Y")
                                                    {

                                                            $billcancelpermission="Yes";
                                                    }else 
                                                    {
                                                            $billcancelpermission="No";
                                                    }    
                                                    
                                                    
                                                    if($result_login['ser_discountpermission']=="Y")
                                                    {

                                                            $discountpermission="Yes";
                                                    }else 
                                                    {
                                                            $discountpermission="No";
                                                    }
                                                     if($result_login['ser_compl_mgmt']=="Y")
                                                    {

                                                            $complpermission="Yes";
                                                    }else 
                                                    {
                                                            $complpermission="No";
                                                    }
                                                    if($result_login['ser_discount_manual']=="Y")
                                                    {

                                                            $manualdiscount="Yes";
                                                    }else 
                                                    {
                                                            $manualdiscount="No";
                                                    }
                                                      if($result_login['ser_stockchng_permission']=="Y")
                                                    {

                                                            $stockchange="Yes";
                                                    }else 
                                                    {
                                                            $stockchange="No";
                                                    }
                                                    if($result_login['ser_cancelwithkey']=="Y")
                                                    {

                                                            $cancelwithkey="Yes";
                                                    }else 
                                                    {
                                                            $cancelwithkey="No";
                                                    }
                                                    if($result_login['ser_kot_cancel_permission']=="Y")
                                                    {

                                                            $kotcancel="Yes";
                                                    }else 
                                                    {
                                                            $kotcancel="No";
                                                    }
                                                    
                                                    if($result_login['ser_counter_enable_generate']=="Y")
                                                    {

                                                            $counterenable="Yes";
                                                    }else 
                                                    {
                                                            $counterenable="No";
                                                    }
                                                    
                                                    if($result_login['ser_counter_enable_hold']=="Y")
                                                    {

                                                            $counterhold="Yes";
                                                    }else 
                                                    {
                                                            $counterhold="No";
                                                    }
                                                    
                                                    if($result_login['ser_permit_cash_drawer_open']=="Y")
                                                    {

                                                            $cashdrawer1="Yes";
                                                    }else 
                                                    {
                                                            $cashdrawer1="No";
                                                    }
                                                    if($result_login['ser_dayclose_permission']=="Y")
                                                    {

                                                            $daycloseopen="Yes";
                                                    }else 
                                                    {
                                                            $daycloseopen="No";
                                                    }
                                                    if($result_login['ser_shift_permission']=="Y")
                                                    {

                                                            $shiftopen="Yes";
                                                    }else 
                                                    {
                                                            $shiftopen="No";
                                                    }
                                                    if($result_login['ls_restrict_login']=="Y")
                                                    {

                                                            $loginrestrict="Yes";
                                                    }else 
                                                    {
                                                            $loginrestrict="No";
                                                    }
                                                     if($result_login['ser_release_login']=="Y")
                                                    {

                                                            $releaselogin="Yes";
                                                    }else 
                                                    {
                                                            $releaselogin="No";
                                                    }
                                                    if($result_login['ser_bill_regen_per']=="Y")
                                                    {

                                                            $regenerate_staff  ="Yes";
                                                    }else 
                                                    {
                                                            $regenerate_staff  ="No";
                                                    }
                                                    if($result_login['ser_bill_reprint_per']=="Y")
                                                    {

                                                            $bill_reprint_staff="Yes";
                                                    }else 
                                                    {
                                                            $bill_reprint_staff="No";
                                                    }
                                                    if($result_login['ser_kot_reprint_per']=="Y")
                                                    {

                                                            $kot_reprint_staff="Yes";
                                                    }else 
                                                    {
                                                            $kot_reprint_staff="No";
                                                    }
                                                    if($result_login['ser_bill_settle_change_per']=="Y")
                                                    {

                                                            $change_staff="Yes";
                                                    }else 
                                                    {
                                                            $change_staff="No";
                                                    }
                                                    if($result_login['ser_order_split_permission']=="Y")
                                                    {

                                                            $order_split="Yes";
                                                    }else 
                                                    {
                                                            $order_split="No";
                                                    }
                                                    if($result_login['ser_dayclose_permission']=="Y")
                                                    {

                                                            $dc_per="Yes";
                                                    }else 
                                                    {
                                                            $dc_per="No";
                                                    }
                                                    if($result_login['ser_tip_edit_permission']=="Y")
                                                    {

                                                            $tip_edit_permission="Yes";
                                                    }else 
                                                    {
                                                            $tip_edit_permission="No";
                                                    }
                                                    if($result_login['ser_dayclose_revert_permission']=="Y")
                                                    {

                                                            $dayclose_revert="Yes";
                                                    }else 
                                                    {
                                                            $dayclose_revert="No";
                                                    }
                                                    
                                                    
                                                    if($result_login['ser_bill_reset']=="Y")
                                                    {

                                                            $bill_reset="Yes";
                                                    }else 
                                                    {
                                                            $bill_reset="No";
                                                    }
                                                    
                                                    if($result_login['ser_credit_view']=="Y")
                                                    {

                                                            $credit_view="Yes";
                                                    }else 
                                                    {
                                                            $credit_view="No";
                                                    }
                                                    
                                                     if($result_login['ser_comp_view']=="Y")
                                                    {

                                                            $comp_view="Yes";
                                                    }else 
                                                    {
                                                            $comp_view="No";
                                                    }
                                                    
                                                    if($result_login['ser_credit_permission']=="Y")
                                                    {

                                                            $credit_permission="Yes";
                                                    }else 
                                                    {
                                                            $credit_permission="No";
                                                    }
                                                    
                                                    if($result_login['ser_comp_permission']=="Y")
                                                    {

                                                            $comp_permission="Yes";
                                                    }else 
                                                    {
                                                            $comp_permission="No";
                                                    }
                                                    
                                                    if($result_login['ser_bill_print_permission']=="Y")
                                                    {

                                                            $bill_permission_pin="Yes";
                                                    }else 
                                                    {
                                                            $bill_permission_pin="No";
                                                    }
                                                    if($result_login['ser_bill_settle_permission']=="Y")
                                                    {

                                                            $bill_settle_permission_pin="Yes";
                                                    }else 
                                                    {
                                                            $bill_settle_permission_pin="No";
                                                    }
                                                   
                                                    if($result_login['ser_change_table_permission']=="Y")
                                                    {

                                                            $table_change="Yes";
                                                    }else 
                                                    {
                                                            $table_change="No";
                                                    }
                                                    if($result_login['ser_advance_pay_permission']=="Y")
                                                    {

                                                            $adv_permision="Yes";
                                                    }else 
                                                    {
                                                            $adv_permision="No";
                                                    }
                                                    if($result_login['ser_counter_settle_permission']=="Y")
                                                    {

                                                            $counter_settle_permision="Yes";
                                                    }else 
                                                    {
                                                            $counter_settle_permision="No";
                                                    }
                                                    
                                                    if($result_login['ser_online_order']=="Y")
                                                    {

                                                            $online_order_permision="Yes";
                                                    }else 
                                                    {
                                                            $online_order_permision="No";
                                                    }
                                                    
                                                    if($result_login['ser_physical_stock_permission']=="Y")
                                                    {

                                                            $phy="Yes";
                                                    }else 
                                                    {
                                                            $phy="No";
                                                    }
                                                    
                                                    if($result_login['ser_wastage_entry']=="Y")
                                                    {

                                                            $wastage="Yes";
                                                    }else 
                                                    {
                                                            $wastage="No";
                                                    }
                                                    
                                                    if($result_login['ser_stock_entry']=="Y")
                                                    {

                                                            $stock_entry="Yes";
                                                    }else 
                                                    {
                                                            $stock_entry="No";
                                                    }
                                                    
                                                     
                                                    if($result_login['ser_req']=="Y")
                                                    {

                                                            $requisition="Yes";
                                                    }else 
                                                    {
                                                            $requisition="No";
                                                    }
                                                    
                                                     if($result_login['ser_po']=="Y")
                                                    {

                                                            $po="Yes";
                                                    }else 
                                                    {
                                                            $po="No";
                                                    }
                                                    

                                                     if($result_login['ser_rps']=="Y")
                                                    {

                                                            $rps="Yes";
                                                    }else 
                                                    {
                                                            $rps="No";
                                                    }


                                                   if($result_login['ser_store_transfer']=="Y")
                                                    {

                                                            $store_transfer="Yes";
                                                    }else 
                                                    {
                                                            $store_transfer="No";
                                                    }

                                                   if($result_login['ser_return_history']=="Y")
                                                    {

                                                            $return_history="Yes";
                                                    }else 
                                                    {
                                                            $return_history="No";
                                                    }
                                                    
                                                  if($result_login['ser_inventory_reports']=="Y")
                                                    {

                                                            $reports="Yes";
                                                    }else 
                                                    {
                                                            $reports="No";
                                                    }

                                                    if($result_login['ser_purchase_return']=="Y")
                                                    {

                                                            $purchase_return="Yes";
                                                    }else 
                                                    {
                                                            $purchase_return="No";
                                                    }
                                                    
                                                    if($result_login['ser_consumption']=="Y")
                                                    {

                                                            $consumption="Yes";
                                                    }else 
                                                    {
                                                            $consumption="No";
                                                    }

                                                 
                                                    
                                                     if($result_login['ser_store_stock']=="Y")
                                                    {

                                                            $store_stock="Yes";
                                                    }else 
                                                    {
                                                            $store_stock="No";
                                                    }
                                                    
                                                    if($result_login['ser_dashboard']=="Y")
                                                    {

                                                            $dashboard="Yes";
                                                    }else 
                                                    {
                                                            $dashboard="No";
                                                    }
                                                    
                                                     if($result_login['ser_recipe']=="Y")
                                                    {

                                                            $recipe="Yes";
                                                    }else 
                                                    {
                                                            $recipe="No";
                                                    }
                                                    
                                                     if($result_login['ser_production']=="Y")
                                                    {

                                                            $production="Yes";
                                                    }else 
                                                    {
                                                            $production="No";
                                                    }
                                                    
                                                     if($result_login['ser_central_kitchen']=="Y")
                                                    {

                                                            $central_kitchen="Yes";
                                                    }else 
                                                    {
                                                            $central_kitchen="No";
                                                    }
                                                    
                                                     if($result_login['ser_central_accept']=="Y")
                                                    {

                                                            $central_kitchen_accept="Yes";
                                                    }else 
                                                    {
                                                            $central_kitchen_accept="No";
                                                    }
                                                    
                                                     if($result_login['ser_com_item']=="Y")
                                                    {

                                                            $comp_item="Yes";
                                                    }else 
                                                    {
                                                            $comp_item="No";
                                                    }
                                                    
                                                     if($result_login['ser_force_close']=="Y")
                                                    {

                                                            $shiftcose="Yes";
                                                    }else 
                                                    {
                                                            $shiftcose="No";
                                                    }
                                                    
                                                    if($result_login['ser_discount_after']=="Y")
                                                    {

                                                            $disc_after_settle="Yes";
                                                    }else 
                                                    {
                                                            $disc_after_settle="No";
                                                    }
                                                    
                                                    if($result_login['ser_all_shift_closer']=="Y")
                                                    {

                                                            $shift_all_settle="Yes";
                                                    }else 
                                                    {
                                                            $shift_all_settle="No";
                                                    }
                                                    
                                                    
                                                    if($result_login['ser_item_discount_manual']=="Y")
                                                    {

                                                            $item_discount_manual="Yes";
                                                    }else 
                                                    {
                                                            $item_discount_manual="No";
                                                    }
                                                    
                                                     if($result_login['ser_indent']=="Y")
                                                    {

                                                            $indent="Yes";
                                                    }else 
                                                    {
                                                            $indent="No";
                                                    }
                                                    
                                                     if($result_login['ser_delete_menu']=="Y")
                                                    {

                                                            $ser_delete_menu="Yes";
                                                    }else 
                                                    {
                                                            $ser_delete_menu="No";
                                                    }
                                                    
                                                     if($result_login['ser_menu_unit_edit']=="Y")
                                                    {

                                                            $ser_menu_unit_edit="Yes";
                                                    }else 
                                                    {
                                                            $ser_menu_unit_edit="No";
                                                    }
                                                    
                                                    
                                                     if($result_login['ser_approve_cancel_inv']=="Y")
                                                    {

                                                            $rps_approve_cancel="Yes";
                                                    }else 
                                                    {
                                                            $rps_approve_cancel="No";
                                                    }
                                                    
                                                    
                                                      if($result_login['ser_direct_transfer']=="Y")
                                                    {

                                                            $direct_transfer="Yes";
                                                    }else 
                                                    {
                                                            $direct_transfer="No";
                                                    }
                                                    
                                                    
                                                    if($result_login['ser_indent_accept']=="Y")
                                                    {

                                                           $indent_accept="Yes";
                                                    }else 
                                                    {
                                                            $indent_accept="No";
                                                    }
                                                    
                                                    
                                                    
                                                    if($result_login['ser_direct_transfer_accept']=="Y")
                                                    {

                                                            $direct_transfer_accept="Yes";
                                                    }else 
                                                    {
                                                            $direct_transfer_accept="No";
                                                    }
                                                    
                                                    
                                                     if($result_login['ser_normal_transfer_accept']=="Y")
                                                    {

                                                            $store_transfer_accept="Yes";
                                                    }else 
                                                    {
                                                            $store_transfer_accept="No";
                                                    }
                                                    
                                                    
                                                      if($result_login['ser_enable_type']=="Y")
                                                    {

                                                            $ser_enable_type="Yes";
                                                    }else 
                                                    {
                                                            $ser_enable_type="No";
                                                    }
                                                    
                                                    
                                                    
                                                  }
                                                 } 
                                                 
                                          $username='';   
                                          $sql_login  =  $database->mysqlQuery("select * from tbl_logindetails Where ls_staffid='$id'"); 

                                          $num_login   = $database->mysqlNumRows($sql_login);

                                          if($num_login){
                                          while($result_login  = $database->mysqlFetchArray($sql_login)) 
			                  {
//                                                
                                                if($result_login['ls_applogin']=="Y")
                                                    {

                                                            $applogin="Yes";
                                                    }else 
                                                    {
                                                            $applogin="No";
                                                    }
                                                    
                                                    
                                                $username=$result_login['ls_username'];
                                                
                                                
                                                if($username!=''){
                                                $_SESSION['stfidsess']=$username;
                                                }else{
                                                  $_SESSION['stfidsess']='';   
                                                }
                                                
                                        }} ?>
                                            
                             <!--   <form role="form" action="permissions.php?id=<?=$id?>"  method="post" id="permissionset"  name="permission_new">-->
                                            
                                        <div class="permission_contant_cc staff_permission_view1">
                                     
                                        	<div class="permision_main_contant_cc">
                                            	<div class="permision_main_contant_name">Item Cancel Permission</div>
                                                <span style="float:left;line-height:30px;">:</span>
                                                <div class="permision_main_contant">
                                                    <?=$cancelpermission?>
                                                </div>
                                            </div>
                                            <div class="permision_main_contant_cc">
                                            	<div class="permision_main_contant_name">Bill Cancel Permission</div>
                                                <span style="float:left;line-height:30px;">:</span>
                                                <div class="permision_main_contant">
                                                    <?=$billcancelpermission?>
                                                </div>
                                            </div>
                                            <div class="permision_main_contant_cc">
                                            	<div class="permision_main_contant_name">Discount Permission</div>
                                                <span style="float:left;line-height:30px;">:</span>
                                                 <div class="permision_main_contant">
                                                	<?=$discountpermission?>
                                                </div>
                                            </div>
                                            <div class="permision_main_contant_cc">
                                            	<div class="permision_main_contant_name">Complementary Management</div>
                                                <span style="float:left;line-height:30px;">:</span>
                                                <div class="permision_main_contant">
                                                	<?=$complpermission?>
                                                </div>
                                            </div>
                                            <div class="permision_main_contant_cc">
                                            	<div class="permision_main_contant_name">Manual Discount</div>
                                                <span style="float:left;line-height:30px;">:</span>
                                                 <div class="permision_main_contant">
                                                	<?=$manualdiscount?>
                                                </div>
                                            </div>
                                            <div class="permision_main_contant_cc">
                                            	<div class="permision_main_contant_name">Stock Change</div>
                                                <span style="float:left;line-height:30px;">:</span>
                                                 <div class="permision_main_contant">
                                                	<?=$stockchange?>
                                                </div>
                                            </div>
                                            
                                             <div class="permision_main_contant_cc">
                                            	<div class="permision_main_contant_name">Cancel With Key</div>
                                                <span style="float:left;line-height:30px;">:</span>
                                                 <div class="permision_main_contant">
                                                	<?=$cancelwithkey?>
                                                </div>
                                            </div>
                                            <div class="permision_main_contant_cc">
                                            	<div class="permision_main_contant_name">KOT Cancellation Button</div>
                                                <span style="float:left;line-height:30px;">:</span>
                                                 <div class="permision_main_contant">
                                                	<?=$kotcancel?>
                                                </div>
                                            </div>

                                            <div class="permision_main_contant_cc">
                                            	<div class="permision_main_contant_name">App Login</div>
                                                <span style="float:left;line-height:30px;">:</span>
                                                 <div class="permision_main_contant">
                                                	<?=$applogin?>
                                                </div>
                                            </div>
                                            
                                            
                                            <div class="permision_main_contant_cc">
                                            	<div class="permision_main_contant_name">Counter enable generate</div>
                                                <span style="float:left;line-height:30px;">:</span>
                                                 <div class="permision_main_contant">
                                                	<?=$counterenable?>
                                                </div>
                                            </div>
                                            
                                            
                                            <div class="permision_main_contant_cc">
                                            	<div class="permision_main_contant_name">Enable Hold</div>
                                                <span style="float:left;line-height:30px;">:</span>
                                                 <div class="permision_main_contant">
                                                	<?=$counterhold?>
                                                </div>
                                            </div>
                                            
                                            <div class="permision_main_contant_cc">
                                            	<div class="permision_main_contant_name">Cash  Drawer Open</div>
                                                <span style="float:left;line-height:30px;">:</span>
                                                 <div class="permision_main_contant">
                                                	<?=$cashdrawer1?>
                                                </div>
                                            </div>
                                             
                                             <div class="permision_main_contant_cc">
                                            	<div class="permision_main_contant_name">Shift Open</div>
                                                <span style="float:left;line-height:30px;">:</span>
                                                 <div class="permision_main_contant">
                                                	<?=$shiftopen?>
                                                </div>
                                            </div>
                                             <div class="permision_main_contant_cc">
                                            	<div class="permision_main_contant_name">Login Restrict</div>
                                                <span style="float:left;line-height:30px;">:</span>
                                                 <div class="permision_main_contant">
                                                	<?=$loginrestrict?>
                                                </div>
                                            </div>
                                            
                                            <div class="permision_main_contant_cc">
                                            	<div class="permision_main_contant_name">Release Login</div>
                                                <span style="float:left;line-height:30px;">:</span>
                                                 <div class="permision_main_contant">
                                                	<?=$releaselogin?>
                                                </div>
                                            </div>
                                            
                                             <div class="permision_main_contant_cc">
                                            	<div class="permision_main_contant_name">Enable Regenerate</div>
                                                <span style="float:left;line-height:30px;">:</span>
                                                 <div class="permision_main_contant">
                                                	<?=$regenerate_staff?>
                                                </div>
                                            </div>
                                            
                                             <div class="permision_main_contant_cc">
                                            	<div class="permision_main_contant_name">Enable Bill Reprint</div>
                                                <span style="float:left;line-height:30px;">:</span>
                                                 <div class="permision_main_contant">
                                                	<?=$bill_reprint_staff?>
                                                </div>
                                            </div>
                                            
                                             <div class="permision_main_contant_cc">
                                            	<div class="permision_main_contant_name">Enable Kot Reprint</div>
                                                <span style="float:left;line-height:30px;">:</span>
                                                 <div class="permision_main_contant">
                                                	<?=$kot_reprint_staff?>
                                                </div>
                                            </div>
                                            
                                             <div class="permision_main_contant_cc">
                                            	<div class="permision_main_contant_name">Enable Payment Change </div>
                                                <span style="float:left;line-height:30px;">:</span>
                                                 <div class="permision_main_contant">
                                                	<?=$change_staff?>
                                                </div>
                                            </div>
                                             <div class="permision_main_contant_cc">
                                            	<div class="permision_main_contant_name">Order Split </div>
                                                <span style="float:left;line-height:30px;">:</span>
                                                 <div class="permision_main_contant">
                                                	<?=$order_split?>
                                                </div>
                                            </div>
                                            <div class="permision_main_contant_cc">
                                            	<div class="permision_main_contant_name">Dayclose Permission </div>
                                                <span style="float:left;line-height:30px;">:</span>
                                                 <div class="permision_main_contant">
                                                	<?=$dc_per?>
                                                </div>
                                            </div>
                                            <div class="permision_main_contant_cc">
                                            	<div class="permision_main_contant_name">Tip Edit Permission </div>
                                                <span style="float:left;line-height:30px;">:</span>
                                                 <div class="permision_main_contant">
                                                	<?=$tip_edit_permission?>
                                                </div>
                                            </div>
                                             <div class="permision_main_contant_cc">
                                            	<div class="permision_main_contant_name">Dayclose Revert Permission </div>
                                                <span style="float:left;line-height:30px;">:</span>
                                                 <div class="permision_main_contant">
                                                	<?=$dayclose_revert?>
                                                </div>
                                            </div>
                                            <div class="permision_main_contant_cc">
                                            	<div class="permision_main_contant_name">Bill Reset Permission </div>
                                                <span style="float:left;line-height:30px;">:</span>
                                                 <div class="permision_main_contant">
                                                	<?=$bill_reset?>
                                                </div>
                                            </div>
                                            <div class="permision_main_contant_cc">
                                            	<div class="permision_main_contant_name">Credit View </div>
                                                <span style="float:left;line-height:30px;">:</span>
                                                 <div class="permision_main_contant">
                                                	<?=$credit_view?>
                                                </div>
                                            </div>
                                            <div class="permision_main_contant_cc">
                                            	<div class="permision_main_contant_name">Complimentary View  </div>
                                                <span style="float:left;line-height:30px;">:</span>
                                                 <div class="permision_main_contant">
                                                	<?=$comp_view?>
                                                </div>
                                            </div>
                                            <div class="permision_main_contant_cc">
                                            	<div class="permision_main_contant_name">Credit Settlement Permission </div>
                                                <span style="float:left;line-height:30px;">:</span>
                                                 <div class="permision_main_contant">
                                                	<?=$credit_permission?>
                                                </div>
                                            </div>
                                            <div class="permision_main_contant_cc">
                                            	<div class="permision_main_contant_name">Complimentary Settlement Permission </div>
                                                <span style="float:left;line-height:30px;">:</span>
                                                 <div class="permision_main_contant">
                                                	<?=$comp_permission?>
                                                </div>
                                            </div>
                                            <div class="permision_main_contant_cc">
                                            	<div class="permision_main_contant_name">Bill Print Permission </div>
                                                <span style="float:left;line-height:30px;">:</span>
                                                 <div class="permision_main_contant">
                                                	<?=$bill_permission_pin?>
                                                </div>
                                            </div>
                                            <div class="permision_main_contant_cc">
                                            	<div class="permision_main_contant_name">Bill Settle Permission </div>
                                                <span style="float:left;line-height:30px;">:</span>
                                                 <div class="permision_main_contant">
                                                	<?=$bill_settle_permission_pin?>
                                                </div>
                                            </div>
                                            
                                           
                                            
                                             <div class="permision_main_contant_cc">
                                            	<div class="permision_main_contant_name">Table Change Permission </div>
                                                <span style="float:left;line-height:30px;">:</span>
                                                 <div class="permision_main_contant">
                                                	<?=$table_change?>
                                                </div>
                                            </div>
                                            
                                             <div class="permision_main_contant_cc">
                                            	<div class="permision_main_contant_name">Advance Pay Edit Permission </div>
                                                <span style="float:left;line-height:30px;">:</span>
                                                 <div class="permision_main_contant">
                                                	<?=$adv_permision?>
                                                </div>
                                            </div>
                                            <div class="permision_main_contant_cc">
                                            	<div class="permision_main_contant_name">Counter Settle Permission </div>
                                                <span style="float:left;line-height:30px;">:</span>
                                                 <div class="permision_main_contant">
                                                	<?=$counter_settle_permision?>
                                                </div>
                                            </div>
                                            
                                             <div class="permision_main_contant_cc">
                                            	<div class="permision_main_contant_name">Online Order Permission </div>
                                                <span style="float:left;line-height:30px;">:</span>
                                                 <div class="permision_main_contant">
                                                	<?=$online_order_permision?>
                                                </div>
                                            </div>
                                            
                                            <div class="permision_main_contant_cc">
                                            	<div class="permision_main_contant_name">Complimentory Item Permission </div>
                                                <span style="float:left;line-height:30px;">:</span>
                                                 <div class="permision_main_contant">
                                                	<?=$comp_item?>
                                                </div>
                                            </div>
                                            
                                             <div class="permision_main_contant_cc">
                                            	<div class="permision_main_contant_name">Shift Force Close</div>
                                                <span style="float:left;line-height:30px;">:</span>
                                                 <div class="permision_main_contant">
                                                	<?=$shiftcose?>
                                                </div>
                                            </div>
                                            
                                            <div class="permision_main_contant_cc">
                                            	<div class="permision_main_contant_name">Discount At Settle</div>
                                                <span style="float:left;line-height:30px;">:</span>
                                                 <div class="permision_main_contant">
                                                	<?=$disc_after_settle?>
                                                </div>
                                            </div>
                                            
                                            <div class="permision_main_contant_cc">
                                            	<div class="permision_main_contant_name">All Shift Settle </div>
                                                <span style="float:left;line-height:30px;">:</span>
                                                 <div class="permision_main_contant">
                                                	<?=$shift_all_settle?>
                                                </div>
                                            </div>
                                            
                                            <div class="permision_main_contant_cc">
                                            	<div class="permision_main_contant_name">Item Discount Manual</div>
                                                <span style="float:left;line-height:30px;">:</span>
                                                 <div class="permision_main_contant">
                                                	<?=$item_discount_manual?>
                                                </div>
                                            </div>
                                            
                                            <div class="permision_main_contant_cc">
                                            	<div class="permision_main_contant_name"> Item Delete Permission</div>
                                                <span style="float:left;line-height:30px;">:</span>
                                                 <div class="permision_main_contant">
                                                	<?=$ser_delete_menu?>
                                                </div>
                                            </div>
                                            
                                             <div class="permision_main_contant_cc">
                                            	<div class="permision_main_contant_name"> Item Unit Edit Permission</div>
                                                <span style="float:left;line-height:30px;">:</span>
                                                 <div class="permision_main_contant">
                                                	<?=$ser_menu_unit_edit?>
                                                </div>
                                            </div>
                                            
                                            
                                            
                                            <div class="permision_main_contant_cc" style="background-color: #e99e9e ">
                                                <div class="permision_main_contant_name">INVENTORY PERMISSIONS <input <?php if($chk_all=='Y'){ ?> checked <?php } ?> id="inv_check_all" onclick="all_inv_permission('<?=$id?>')" style="margin-top:0px;margin-left: 10px;cursor: pointer" type="checkbox" > </div>
                                                <span style="float:left;line-height:30px;"></span>
                                                 <div class="permision_main_contant">
                                                	
                                                </div>
                                            </div>
                                            
                                            <div class="permision_main_contant_cc">
                                            	<div class="permision_main_contant_name">Physical Stock Entry Permission </div>
                                                <span style="float:left;line-height:30px;">:</span>
                                                 <div class="permision_main_contant">
                                                	<?=$phy?>
                                                </div>
                                            </div>
                                            
                                            <div class="permision_main_contant_cc">
                                            	<div class="permision_main_contant_name">Wastage Entry Permission </div>
                                                <span style="float:left;line-height:30px;">:</span>
                                                 <div class="permision_main_contant">
                                                	<?=$wastage?>
                                                </div>
                                            </div>
                                            
                                            <div class="permision_main_contant_cc">
                                            	<div class="permision_main_contant_name">Stock Entry </div>
                                                <span style="float:left;line-height:30px;">:</span>
                                                 <div class="permision_main_contant">
                                                	<?=$stock_entry?>
                                                </div>
                                            </div>
                                            
                                            
                                             <div class="permision_main_contant_cc">
                                            	<div class="permision_main_contant_name">RPS History </div>
                                                <span style="float:left;line-height:30px;">:</span>
                                                 <div class="permision_main_contant">
                                                	<?=$rps?>
                                                </div>
                                            </div>
                                            
                                            
                                             <div class="permision_main_contant_cc">
                                            	<div class="permision_main_contant_name">Store Transfer </div>
                                                <span style="float:left;line-height:30px;">:</span>
                                                 <div class="permision_main_contant">
                                                	<?=$store_transfer?>
                                                </div>
                                            </div>
                                            
                                             <div class="permision_main_contant_cc">
                                            	<div class="permision_main_contant_name">Return History </div>
                                                <span style="float:left;line-height:30px;">:</span>
                                                 <div class="permision_main_contant">
                                                	<?=$return_history?>
                                                </div>
                                            </div>
                                            
                                             <div class="permision_main_contant_cc">
                                            	<div class="permision_main_contant_name">Reports </div>
                                                <span style="float:left;line-height:30px;">:</span>
                                                 <div class="permision_main_contant">
                                                	<?=$reports?>
                                                </div>
                                            </div>
                                            
                                             <div class="permision_main_contant_cc">
                                            	<div class="permision_main_contant_name">Purchase Return </div>
                                                <span style="float:left;line-height:30px;">:</span>
                                                 <div class="permision_main_contant">
                                                	<?=$purchase_return?>
                                                </div>
                                            </div>
                                            
                                            
                                            <div class="permision_main_contant_cc">
                                            	<div class="permision_main_contant_name">Requisition </div>
                                                <span style="float:left;line-height:30px;">:</span>
                                                 <div class="permision_main_contant">
                                                	<?=$requisition?>
                                                </div>
                                            </div>
                                            
                                            <div class="permision_main_contant_cc">
                                            	<div class="permision_main_contant_name">Purchase Order </div>
                                                <span style="float:left;line-height:30px;">:</span>
                                                 <div class="permision_main_contant">
                                                	<?=$po?>
                                                </div>
                                            </div>
                                            
                                            <div class="permision_main_contant_cc">
                                            	<div class="permision_main_contant_name">Consumption </div>
                                                <span style="float:left;line-height:30px;">:</span>
                                                 <div class="permision_main_contant">
                                                	<?=$consumption?>
                                                </div>
                                            </div>
                                            
                                            
                                            
                                            <div class="permision_main_contant_cc">
                                            	<div class="permision_main_contant_name">Store Stock  </div>
                                                <span style="float:left;line-height:30px;">:</span>
                                                 <div class="permision_main_contant">
                                                	<?=$store_stock?>
                                                </div>
                                            </div>
                                            
                                            <div class="permision_main_contant_cc" style="display:none">
                                            	<div class="permision_main_contant_name">Dashboard View </div>
                                                <span style="float:left;line-height:30px;">:</span>
                                                 <div class="permision_main_contant">
                                                	<?=$dashboard?>
                                                </div>
                                            </div>
                                            
                                            
                                             <div class="permision_main_contant_cc">
                                            	<div class="permision_main_contant_name">Recipe  </div>
                                                <span style="float:left;line-height:30px;">:</span>
                                                 <div class="permision_main_contant">
                                                	<?=$recipe?>
                                                </div>
                                            </div>
                                            
                                             <div class="permision_main_contant_cc">
                                            	<div class="permision_main_contant_name">Production  </div>
                                                <span style="float:left;line-height:30px;">:</span>
                                                 <div class="permision_main_contant">
                                                	<?=$production?>
                                                </div>
                                            </div>
                                            
                                             <div class="permision_main_contant_cc">
                                            	<div class="permision_main_contant_name">Central Kitchen</div>
                                                <span style="float:left;line-height:30px;">:</span>
                                                 <div class="permision_main_contant">
                                                	<?=$central_kitchen?>
                                                </div>
                                            </div>
                                            
                                             <div class="permision_main_contant_cc">
                                            	<div class="permision_main_contant_name">Central Kitchen Accept</div>
                                                <span style="float:left;line-height:30px;">:</span>
                                                 <div class="permision_main_contant">
                                                	<?=$central_kitchen_accept?>
                                                </div>
                                            </div>
                                            
                                            <div class="permision_main_contant_cc">
                                            	<div class="permision_main_contant_name">Requisition Indent Transfer</div>
                                                <span style="float:left;line-height:30px;">:</span>
                                                 <div class="permision_main_contant">
                                                	<?=$indent?>
                                                </div>
                                            </div>
                                            
                                           <div class="permision_main_contant_cc">
                                            	<div class="permision_main_contant_name"> Indent Accept</div>
                                                <span style="float:left;line-height:30px;">:</span>
                                                 <div class="permision_main_contant">
                                                	<?=$indent_accept?>
                                                </div>
                                            </div>
                                            
                                            <div class="permision_main_contant_cc">
                                            	<div class="permision_main_contant_name">RPS Approve-Cancel</div>
                                                <span style="float:left;line-height:30px;">:</span>
                                                 <div class="permision_main_contant">
                                                	<?=$rps_approve_cancel?>
                                                </div>
                                            </div>
                                            
                                            <div class="permision_main_contant_cc">
                                            	<div class="permision_main_contant_name">Direct Transfer</div>
                                                <span style="float:left;line-height:30px;">:</span>
                                                 <div class="permision_main_contant">
                                                	<?=$direct_transfer?>
                                                </div>
                                            </div>
                                            
                                             <div class="permision_main_contant_cc">
                                            	<div class="permision_main_contant_name">Direct Transfer Accept</div>
                                                <span style="float:left;line-height:30px;">:</span>
                                                 <div class="permision_main_contant">
                                                	<?=$direct_transfer_accept?>
                                                </div>
                                            </div>
                                            
                                            <div class="permision_main_contant_cc">
                                            	<div class="permision_main_contant_name">Store Transfer Accept</div>
                                                <span style="float:left;line-height:30px;">:</span>
                                                 <div class="permision_main_contant">
                                                	<?=$store_transfer_accept?>
                                                </div>
                                            </div>
                                            
                                            
                                        </div>
                                        
                                        <div class="permission_contant_cc staff_permission_edit1" style="display:none">
                                            
                                            <div   class="module_cat_head ">
                                                 <span><input onclick="general_enable_all('<?=$id?>')" type="checkbox" class="check_box_main general_enable_all" <?php if($ser_enable_type=="Yes"){ ?> checked="checked" <?php } ?>></span>
                                             <span style="font-size:15px;padding-left:5px">Enable All</span>
                                            </div>
                                            
                                        	<div class="permision_main_contant_cc">
                                            	<div class="permision_main_contant_name">Item Cancel Permission</div>
                                                <div class="permision_main_contant_dropdown">
                                                        <select class="form-control add_new_dropdown" name="cancelpermission">
                                                            <option value="Y" <?php if($cancelpermission =="Yes") echo "selected";?>>Yes</option>
                                                            <option value="N" <?php if($cancelpermission =="No") echo "selected";?>>No</option>
                                                        </select> 
                                                </div>
                                            </div>
                                            
                                                              	<div class="permision_main_contant_cc">
                                            	<div class="permision_main_contant_name">Bill Cancel Permission</div>
                                                <div class="permision_main_contant_dropdown">
                                                        <select class="form-control add_new_dropdown" name="billcancelpermission">
                                                            <option value="Y" <?php if($billcancelpermission =="Yes") echo "selected";?>>Yes</option>
                                                            <option value="N" <?php if($billcancelpermission =="No") echo "selected";?>>No</option>
                                                        </select> 
                                                </div>
                                            </div>
                                            <div class="permision_main_contant_cc">
                                            	<div class="permision_main_contant_name">Discount Permission</div>
                                                <div class="permision_main_contant_dropdown">
                                                        <select class="form-control add_new_dropdown" name="discpermission">
                                                            <option value="Y" <?php if($discountpermission =="Yes") echo "selected";?>>Yes</option>
                                                            <option value="N" <?php if($discountpermission =="No") echo "selected";?>>No</option>
                                                        </select>
                                                </div>
                                            </div>
                                            <div class="permision_main_contant_cc">
                                            	<div class="permision_main_contant_name">Complementary Management</div>
                                                <div class="permision_main_contant_dropdown">
                                                     <select class="form-control add_new_dropdown" name="complmgnt">
                                                        <option value="Y" <?php if($complpermission =="Yes") echo "selected";?>>Yes</option>
                                                        <option value="N" <?php if($complpermission =="No") echo "selected";?>>No</option>
                                                     </select>
                                                </div>
                                            </div>
                                            <div class="permision_main_contant_cc">
                                            	<div class="permision_main_contant_name">Manual Discount</div>
                                                <div class="permision_main_contant_dropdown">
                                                     <select class="form-control add_new_dropdown" name="manualdisc">
                                                       <option value="Y" <?php if($manualdiscount =="Yes") echo "selected";?>>Yes</option>
                                                       <option value="N" <?php if($manualdiscount =="No") echo "selected";?>>No</option>
                                                     </select>
                                                </div>
                                            </div>
                                            <div class="permision_main_contant_cc">
                                            	<div class="permision_main_contant_name">Stock Change</div>
                                                <div class="permision_main_contant_dropdown">
                                                     <select class="form-control add_new_dropdown" name="stockchngpermission">
                                                       <option value="Y" <?php if($stockchange =="Yes") echo "selected";?>>Yes</option>
                                                       <option value="N" <?php if($stockchange =="No") echo "selected";?>>No</option>
                                                     </select>
                                                </div>
                                            </div>
                                            <div class="permision_main_contant_cc">
                                            	<div class="permision_main_contant_name">Cancel With Key</div>
                                                <div class="permision_main_contant_dropdown">
                                                     <select class="form-control add_new_dropdown" name="cancelwithkey">
                                                       <option value="Y" <?php if($cancelwithkey =="Yes") echo "selected";?>>Yes</option>
                                                       <option value="N" <?php if($cancelwithkey =="No") echo "selected";?>>No</option>
                                                     </select>
                                                </div>
                                            </div>
                                            <div class="permision_main_contant_cc">
                                            	<div class="permision_main_contant_name">KOT Cancellation Button</div>
                                                <div class="permision_main_contant_dropdown">
                                                     <select class="form-control add_new_dropdown" name="kotcancel">
                                                       <option value="Y" <?php if($kotcancel =="Yes") echo "selected";?>>Yes</option>
                                                       <option value="N" <?php if($kotcancel =="No") echo "selected";?>>No</option>
                                                     </select>
                                                </div>
                                            </div>
                                            <div class="permision_main_contant_cc">
                                            	<div class="permision_main_contant_name">App Login</div>
                                                <div class="permision_main_contant_dropdown">
                                                     <select class="form-control add_new_dropdown" name="applogin">
                                                       <option value="Y" <?php if($applogin =="Yes") echo "selected";?>>Yes</option>
                                                       <option value="N" <?php if($applogin =="No") echo "selected";?>>No</option>
                                                     </select>
                                                </div>
                                            </div>
                                            
                                            <div class="permision_main_contant_cc">
                                            	<div class="permision_main_contant_name">Counter Enable generate</div>
                                                <div class="permision_main_contant_dropdown">
                                                     <select class="form-control add_new_dropdown" name="counterenable">
                                                       <option value="Y" <?php if($counterenable =="Yes") echo "selected";?>>Yes</option>
                                                       <option value="N" <?php if($counterenable =="No") echo "selected";?>>No</option>
                                                     </select>
                                                </div>
                                            </div>
                                            
                                            <div class="permision_main_contant_cc">
                                            	<div class="permision_main_contant_name">Enable Hold</div>
                                                <div class="permision_main_contant_dropdown">
                                                     <select class="form-control add_new_dropdown" name="counterhold">
                                                       <option value="Y" <?php if($counterhold =="Yes") echo "selected";?>>Yes</option>
                                                       <option value="N" <?php if($counterhold =="No") echo "selected";?>>No</option>
                                                     </select>
                                                </div>
                                            </div>
                                            
                                            <div class="permision_main_contant_cc">
                                            	<div class="permision_main_contant_name">Cash Drawer Open</div>
                                                <div class="permision_main_contant_dropdown">
                                                     <select class="form-control add_new_dropdown" name="cashdrawer1">
                                                       <option value="Y" <?php if($cashdrawer1 =="Yes") echo "selected";?>>Yes</option>
                                                       <option value="N" <?php if($cashdrawer1 =="No") echo "selected";?>>No</option>
                                                     </select>
                                                </div>
                                            </div>
                                            
                                            <div class="permision_main_contant_cc" <?php if($desgn==7){ ?> style="pointer-events: none;opacity: 0.5;"  <?php } ?>  >
                                            	<div class="permision_main_contant_name">Shift open</div>
                                                <div class="permision_main_contant_dropdown">
                                                     <select class="form-control add_new_dropdown" name="shiftopen">
                                                       <option value="Y" <?php if($shiftopen =="Yes") echo "selected";?>>Yes</option>
                                                       <option value="N" <?php if($shiftopen =="No") echo "selected";?>>No</option>
                                                     </select>
                                                </div>
                                            </div>
                                            
                                            <div class="permision_main_contant_cc">
                                            	<div class="permision_main_contant_name">Login Restrict</div>
                                                <div class="permision_main_contant_dropdown">
                                                     <select class="form-control add_new_dropdown" name="loginrestrict">
                                                       <option value="Y" <?php if($loginrestrict =="Yes") echo "selected";?>>Yes</option>
                                                       <option value="N" <?php if($loginrestrict =="No") echo "selected";?>>No</option>
                                                     </select>
                                                </div>
                                            </div>
                                            
                                            <div class="permision_main_contant_cc">
                                            	<div class="permision_main_contant_name">Release  Login</div>
                                                <div class="permision_main_contant_dropdown">
                                                     <select class="form-control add_new_dropdown" name="releaselogin">
                                                       <option value="Y" <?php if($releaselogin =="Yes") echo "selected";?>>Yes</option>
                                                       <option value="N" <?php if($releaselogin =="No") echo "selected";?>>No</option>
                                                     </select>
                                                </div>
                                            </div>
                                            
                                             <div class="permision_main_contant_cc">
                                            	<div class="permision_main_contant_name">Enable Regenerate</div>
                                                <div class="permision_main_contant_dropdown">
                                                     <select class="form-control add_new_dropdown" name="regenerate_staff">
                                                       <option value="Y" <?php if($regenerate_staff   =="Yes") echo "selected";?>>Yes</option>
                                                       <option value="N" <?php if($regenerate_staff   =="No") echo "selected";?>>No</option>
                                                     </select>
                                                </div>
                                            </div>
                                            
                                             <div class="permision_main_contant_cc">
                                            	<div class="permision_main_contant_name">Enable  Bill Reprint</div>
                                                <div class="permision_main_contant_dropdown">
                                                     <select class="form-control add_new_dropdown" name="bill_reprint_staff">
                                                       <option value="Y" <?php if($bill_reprint_staff =="Yes") echo "selected";?>>Yes</option>
                                                       <option value="N" <?php if($bill_reprint_staff =="No") echo "selected";?>>No</option>
                                                     </select>
                                                </div>
                                            </div>
                                            
                                             <div class="permision_main_contant_cc">
                                            	<div class="permision_main_contant_name">Enable  Kot Reprint</div>
                                                <div class="permision_main_contant_dropdown">
                                                     <select class="form-control add_new_dropdown" name="kot_reprint_staff">
                                                       <option value="Y" <?php if($kot_reprint_staff =="Yes") echo "selected";?>>Yes</option>
                                                       <option value="N" <?php if($kot_reprint_staff =="No") echo "selected";?>>No</option>
                                                     </select>
                                                </div>
                                            </div>
                                            
                                             <div class="permision_main_contant_cc">
                                            	<div class="permision_main_contant_name">Enable Payment Change</div>
                                                <div class="permision_main_contant_dropdown">
                                                     <select class="form-control add_new_dropdown" name="change_staff">
                                                       <option value="Y" <?php if($change_staff =="Yes") echo "selected";?>>Yes</option>
                                                       <option value="N" <?php if($change_staff =="No") echo "selected";?>>No</option>
                                                     </select>
                                                </div>
                                            </div>
                                            <div class="permision_main_contant_cc">
                                            	<div class="permision_main_contant_name"> Order Split</div>
                                                <div class="permision_main_contant_dropdown">
                                                     <select class="form-control add_new_dropdown" name="order_split">
                                                       <option value="Y" <?php if($order_split =="Yes") echo "selected";?>>Yes</option>
                                                       <option value="N" <?php if($order_split =="No") echo "selected";?>>No</option>
                                                     </select>
                                                </div>
                                            </div>
                                            <div class="permision_main_contant_cc">
                                            	<div class="permision_main_contant_name"> Dayclose Permission</div>
                                                <div class="permision_main_contant_dropdown">
                                                     <select class="form-control add_new_dropdown" name="dayclose_permission_st">
                                                       <option value="Y" <?php if($dc_per =="Yes") echo "selected";?>>Yes</option>
                                                       <option value="N" <?php if($dc_per =="No") echo "selected";?>>No</option>
                                                     </select>
                                                </div>
                                            </div>
                                            <div class="permision_main_contant_cc">
                                            	<div class="permision_main_contant_name"> Tip Edit Permission</div>
                                                <div class="permision_main_contant_dropdown">
                                                     <select class="form-control add_new_dropdown" name="tip_edit_permission">
                                                       <option value="Y" <?php if($tip_edit_permission =="Yes") echo "selected";?>>Yes</option>
                                                       <option value="N" <?php if($tip_edit_permission =="No") echo "selected";?>>No</option>
                                                     </select>
                                                </div>
                                            </div>
                                            
                                            <div class="permision_main_contant_cc">
                                            	<div class="permision_main_contant_name">Dayclose Revert Permission</div>
                                                <div class="permision_main_contant_dropdown">
                                                     <select class="form-control add_new_dropdown" name="dayclose_revert">
                                                       <option value="Y" <?php if($dayclose_revert =="Yes") echo "selected";?>>Yes</option>
                                                       <option value="N" <?php if($dayclose_revert =="No") echo "selected";?>>No</option>
                                                     </select>
                                                </div>
                                            </div>
                                            
                                            
                                            <div class="permision_main_contant_cc">
                                            	<div class="permision_main_contant_name">Bill Reset</div>
                                                <div class="permision_main_contant_dropdown">
                                                     <select class="form-control add_new_dropdown" name="bill_reset">
                                                       <option value="Y" <?php if($bill_reset =="Yes") echo "selected";?>>Yes</option>
                                                       <option value="N" <?php if($bill_reset =="No") echo "selected";?>>No</option>
                                                     </select>
                                                </div>
                                            </div>
                                            <div class="permision_main_contant_cc">
                                            	<div class="permision_main_contant_name">Credit View</div>
                                                <div class="permision_main_contant_dropdown">
                                                     <select class="form-control add_new_dropdown" name="credit_view">
                                                       <option value="Y" <?php if($credit_view =="Yes") echo "selected";?>>Yes</option>
                                                       <option value="N" <?php if($credit_view =="No") echo "selected";?>>No</option>
                                                     </select>
                                                </div>
                                            </div>
                                            
                                            <div class="permision_main_contant_cc">
                                            	<div class="permision_main_contant_name">Complimentary View</div>
                                                <div class="permision_main_contant_dropdown">
                                                     <select class="form-control add_new_dropdown" name="comp_view">
                                                       <option value="Y" <?php if($comp_view =="Yes") echo "selected";?>>Yes</option>
                                                       <option value="N" <?php if($comp_view =="No") echo "selected";?>>No</option>
                                                     </select>
                                                </div>
                                            </div>
                                            
                                             <div class="permision_main_contant_cc">
                                            	<div class="permision_main_contant_name">Credit Settlement Permission</div>
                                                <div class="permision_main_contant_dropdown">
                                                     <select class="form-control add_new_dropdown" name="credit_perm">
                                                       <option value="Y" <?php if($credit_permission =="Yes") echo "selected";?>>Yes</option>
                                                       <option value="N" <?php if($credit_permission =="No") echo "selected";?>>No</option>
                                                     </select>
                                                </div>
                                            </div>
                                            <div class="permision_main_contant_cc">
                                            	<div class="permision_main_contant_name">Complimentary Settlement Permission</div>
                                                <div class="permision_main_contant_dropdown">
                                                     <select class="form-control add_new_dropdown" name="comp_perm">
                                                       <option value="Y" <?php if($comp_permission =="Yes") echo "selected";?>>Yes</option>
                                                       <option value="N" <?php if($comp_permission =="No") echo "selected";?>>No</option>
                                                     </select>
                                                </div>
                                            </div>
                                            
                                             <div class="permision_main_contant_cc">
                                            	<div class="permision_main_contant_name">Bill Print Permission</div>
                                                <div class="permision_main_contant_dropdown">
                                                     <select class="form-control add_new_dropdown" name="bill_print_perm">
                                                       <option value="Y" <?php if($bill_permission_pin =="Yes") echo "selected";?>>Yes</option>
                                                       <option value="N" <?php if($bill_permission_pin =="No") echo "selected";?>>No</option>
                                                     </select>
                                                </div>
                                            </div>
                                            <div class="permision_main_contant_cc">
                                            	<div class="permision_main_contant_name">Bill Settle Permission</div>
                                                <div class="permision_main_contant_dropdown">
                                                     <select class="form-control add_new_dropdown" name="bill_settle_perm">
                                                       <option value="Y" <?php if($bill_settle_permission_pin =="Yes") echo "selected";?>>Yes</option>
                                                       <option value="N" <?php if($bill_settle_permission_pin =="No") echo "selected";?>>No</option>
                                                     </select>
                                                </div>
                                            </div>
                                            
                                           
                                            
                                            <div class="permision_main_contant_cc">
                                            	<div class="permision_main_contant_name">Table Change Permission</div>
                                                <div class="permision_main_contant_dropdown">
                                                     <select class="form-control add_new_dropdown" name="table_change">
                                                       <option value="Y" <?php if($table_change =="Yes") echo "selected";?>>Yes</option>
                                                       <option value="N" <?php if($table_change =="No") echo "selected";?>>No</option>
                                                     </select>
                                                </div>
                                            </div>
                                            
                                            <div class="permision_main_contant_cc">
                                            	<div class="permision_main_contant_name">Advance Pay Edit Permission</div>
                                                <div class="permision_main_contant_dropdown">
                                                     <select class="form-control add_new_dropdown" name="adv_permision">
                                                       <option value="Y" <?php if($adv_permision =="Yes") echo "selected";?>>Yes</option>
                                                       <option value="N" <?php if($adv_permision =="No") echo "selected";?>>No</option>
                                                     </select>
                                                </div>
                                            </div>
                                            
                                             
                                            <div class="permision_main_contant_cc">
                                            	<div class="permision_main_contant_name">Counter Settle Permission</div>
                                                <div class="permision_main_contant_dropdown">
                                                     <select class="form-control add_new_dropdown" name="counter_settle_permision">
                                                       <option value="Y" <?php if($counter_settle_permision =="Yes") echo "selected";?>>Yes</option>
                                                       <option value="N" <?php if($counter_settle_permision =="No") echo "selected";?>>No</option>
                                                     </select>
                                                </div>
                                            </div>
                                            
                                            <div class="permision_main_contant_cc">
                                            	<div class="permision_main_contant_name">Online Order Permission</div>
                                                <div class="permision_main_contant_dropdown">
                                                     <select class="form-control add_new_dropdown" name="online_order_permision">
                                                       <option value="Y" <?php if($online_order_permision =="Yes") echo "selected";?>>Yes</option>
                                                       <option value="N" <?php if($online_order_permision =="No") echo "selected";?>>No</option>
                                                     </select>
                                                </div>
                                            </div>
                                            
                                            
                                            <div class="permision_main_contant_cc">
                                            	<div class="permision_main_contant_name">Complimentary Item Permission</div>
                                                <div class="permision_main_contant_dropdown">
                                                     <select class="form-control add_new_dropdown" name="comp_item">
                                                       <option value="Y" <?php if($comp_item =="Yes") echo "selected";?>>Yes</option>
                                                       <option value="N" <?php if($comp_item =="No") echo "selected";?>>No</option>
                                                     </select>
                                                </div>
                                            </div>
                                            
                                             <div class="permision_main_contant_cc">
                                            	<div class="permision_main_contant_name">Shift Force Close</div>
                                                <div class="permision_main_contant_dropdown">
                                                     <select class="form-control add_new_dropdown" name="shiftclose">
                                                       <option value="Y" <?php if($shiftcose =="Yes") echo "selected";?>>Yes</option>
                                                       <option value="N" <?php if($shiftcose =="No") echo "selected";?>>No</option>
                                                     </select>
                                                </div>
                                            </div>
                                            
                                            
                                            <div class="permision_main_contant_cc">
                                            	<div class="permision_main_contant_name">Discount At Settle</div>
                                                <div class="permision_main_contant_dropdown">
                                                     <select class="form-control add_new_dropdown" name="disc_after_settle">
                                                       <option value="Y" <?php if($disc_after_settle =="Yes") echo "selected";?>>Yes</option>
                                                       <option value="N" <?php if($disc_after_settle =="No") echo "selected";?>>No</option>
                                                     </select>
                                                </div>
                                            </div>
                                            
                                            <div class="permision_main_contant_cc">
                                            	<div class="permision_main_contant_name">All Shift Settle</div>
                                                <div class="permision_main_contant_dropdown">
                                                     <select class="form-control add_new_dropdown" name="shift_all_settle">
                                                       <option value="Y" <?php if($shift_all_settle =="Yes") echo "selected";?>>Yes</option>
                                                       <option value="N" <?php if($shift_all_settle =="No") echo "selected";?>>No</option>
                                                     </select>
                                                </div>
                                            </div>
                                            
                                            
                                             <div class="permision_main_contant_cc">
                                            	<div class="permision_main_contant_name">Item Discount Manual</div>
                                                <div class="permision_main_contant_dropdown">
                                                     <select class="form-control add_new_dropdown" name="item_discount_manual">
                                                       <option value="Y" <?php if($item_discount_manual =="Yes") echo "selected";?>>Yes</option>
                                                       <option value="N" <?php if($item_discount_manual =="No") echo "selected";?>>No</option>
                                                     </select>
                                                </div>
                                            </div>
                                            
                                            
                                             <div class="permision_main_contant_cc">
                                            	<div class="permision_main_contant_name">Item Delete Permission</div>
                                                <div class="permision_main_contant_dropdown">
                                                     <select class="form-control add_new_dropdown" name="delete_menu">
                                                       <option value="Y" <?php if($ser_delete_menu =="Yes") echo "selected";?>>Yes</option>
                                                       <option value="N" <?php if($ser_delete_menu =="No") echo "selected";?>>No</option>
                                                     </select>
                                                </div>
                                            </div>
                                            
                                             <div class="permision_main_contant_cc">
                                            	<div class="permision_main_contant_name">Item Unit Edit Permission</div>
                                                <div class="permision_main_contant_dropdown">
                                                     <select class="form-control add_new_dropdown" name="menu_unit_edit">
                                                       <option value="Y" <?php if($ser_menu_unit_edit =="Yes") echo "selected";?>>Yes</option>
                                                       <option value="N" <?php if($ser_menu_unit_edit =="No") echo "selected";?>>No</option>
                                                     </select>
                                                </div>
                                            </div>
                                            
                                            
                                            
                                             <div class="permision_main_contant_cc"  style="background-color: #e99e9e ">
                                            	<div class="permision_main_contant_name">INVENTORY PERMISSIONS </div>
                                                <div class="permision_main_contant_dropdown">
                                                    
                                                </div>
                                            </div>
                                            
                                            <div class="permision_main_contant_cc">
                                            	<div class="permision_main_contant_name">Physical Stock Entry Permission</div>
                                                <div class="permision_main_contant_dropdown">
                                                     <select class="form-control add_new_dropdown" name="phy_stock">
                                                       <option value="Y" <?php if($phy =="Yes") echo "selected";?>>Yes</option>
                                                       <option value="N" <?php if($phy =="No") echo "selected";?>>No</option>
                                                     </select>
                                                </div>
                                            </div>
                                            
                                            <div class="permision_main_contant_cc">
                                            	<div class="permision_main_contant_name">Wastage Entry Permission</div>
                                                <div class="permision_main_contant_dropdown">
                                                     <select class="form-control add_new_dropdown" name="wastage">
                                                       <option value="Y" <?php if($wastage =="Yes") echo "selected";?>>Yes</option>
                                                       <option value="N" <?php if($wastage =="No") echo "selected";?>>No</option>
                                                     </select>
                                                </div>
                                            </div>
                                            
                                            
                                            
                                            <div class="permision_main_contant_cc">
                                            	<div class="permision_main_contant_name">Stock Entry </div>
                                                <div class="permision_main_contant_dropdown">
                                                     <select class="form-control add_new_dropdown" name="stock_entry">
                                                       <option value="Y" <?php if($stock_entry =="Yes") echo "selected";?>>Yes</option>
                                                       <option value="N" <?php if($stock_entry =="No") echo "selected";?>>No</option>
                                                     </select>
                                                </div>
                                            </div>
                                            
                                            <div class="permision_main_contant_cc">
                                            	<div class="permision_main_contant_name">RPS History</div>
                                                <div class="permision_main_contant_dropdown">
                                                     <select class="form-control add_new_dropdown" name="rps">
                                                       <option value="Y" <?php if($rps =="Yes") echo "selected";?>>Yes</option>
                                                       <option value="N" <?php if($rps =="No") echo "selected";?>>No</option>
                                                     </select>
                                                </div>
                                            </div>
                                            
                                            <div class="permision_main_contant_cc">
                                            	<div class="permision_main_contant_name">Store Transfer</div>
                                                <div class="permision_main_contant_dropdown">
                                                     <select class="form-control add_new_dropdown" name="store_transfer">
                                                       <option value="Y" <?php if($store_transfer =="Yes") echo "selected";?>>Yes</option>
                                                       <option value="N" <?php if($store_transfer =="No") echo "selected";?>>No</option>
                                                     </select>
                                                </div>
                                            </div>
                                            
                                             <div class="permision_main_contant_cc">
                                            	<div class="permision_main_contant_name">Return History</div>
                                                <div class="permision_main_contant_dropdown">
                                                     <select class="form-control add_new_dropdown" name="return_history">
                                                       <option value="Y" <?php if($return_history =="Yes") echo "selected";?>>Yes</option>
                                                       <option value="N" <?php if($return_history =="No") echo "selected";?>>No</option>
                                                     </select>
                                                </div>
                                            </div>
                                            
                                            <div class="permision_main_contant_cc">
                                            	<div class="permision_main_contant_name">Reports</div>
                                                <div class="permision_main_contant_dropdown">
                                                     <select class="form-control add_new_dropdown" name="reports">
                                                       <option value="Y" <?php if($reports =="Yes") echo "selected";?>>Yes</option>
                                                       <option value="N" <?php if($reports =="No") echo "selected";?>>No</option>
                                                     </select>
                                                </div>
                                            </div>
                                            
                                            <div class="permision_main_contant_cc">
                                            	<div class="permision_main_contant_name">Purchase Return</div>
                                                <div class="permision_main_contant_dropdown">
                                                     <select class="form-control add_new_dropdown" name="purchase_return">
                                                       <option value="Y" <?php if($purchase_return =="Yes") echo "selected";?>>Yes</option>
                                                       <option value="N" <?php if($purchase_return =="No") echo "selected";?>>No</option>
                                                     </select>
                                                </div>
                                            </div>
                                            
                                            
                                            <div class="permision_main_contant_cc">
                                            	<div class="permision_main_contant_name">Requisition</div>
                                                <div class="permision_main_contant_dropdown">
                                                     <select class="form-control add_new_dropdown" name="requisition">
                                                       <option value="Y" <?php if($requisition =="Yes") echo "selected";?>>Yes</option>
                                                       <option value="N" <?php if($requisition =="No") echo "selected";?>>No</option>
                                                     </select>
                                                </div>
                                            </div>
                                            
                                            
                                            <div class="permision_main_contant_cc">
                                            	<div class="permision_main_contant_name">Purchase Order</div>
                                                <div class="permision_main_contant_dropdown">
                                                     <select class="form-control add_new_dropdown" name="po">
                                                       <option value="Y" <?php if($po =="Yes") echo "selected";?>>Yes</option>
                                                       <option value="N" <?php if($po =="No") echo "selected";?>>No</option>
                                                     </select>
                                                </div>
                                            </div>
                                            
                                            <div class="permision_main_contant_cc">
                                            	<div class="permision_main_contant_name">Consumption</div>
                                                <div class="permision_main_contant_dropdown">
                                                     <select class="form-control add_new_dropdown" name="consumption">
                                                       <option value="Y" <?php if($consumption =="Yes") echo "selected";?>>Yes</option>
                                                       <option value="N" <?php if($consumption =="No") echo "selected";?>>No</option>
                                                     </select>
                                                </div>
                                            </div>
                                            
                                            
                                            <div class="permision_main_contant_cc">
                                            	<div class="permision_main_contant_name">Store Stock</div>
                                                <div class="permision_main_contant_dropdown">
                                                     <select class="form-control add_new_dropdown" name="store_stock">
                                                       <option value="Y" <?php if($store_stock =="Yes") echo "selected";?>>Yes</option>
                                                       <option value="N" <?php if($store_stock =="No") echo "selected";?>>No</option>
                                                     </select>
                                                </div>
                                            </div>
                                            
                                            <div class="permision_main_contant_cc" style="display:none">
                                            	<div class="permision_main_contant_name">Dashboard View</div>
                                                <div class="permision_main_contant_dropdown">
                                                     <select class="form-control add_new_dropdown" name="dashboard">
                                                       <option value="Y" <?php if($dashboard =="Yes") echo "selected";?>>Yes</option>
                                                       <option value="N" <?php if($dashboard =="No") echo "selected";?>>No</option>
                                                     </select>
                                                </div>
                                            </div>
                                            
                                            
                                            <div class="permision_main_contant_cc">
                                            	<div class="permision_main_contant_name">Recipe</div>
                                                <div class="permision_main_contant_dropdown">
                                                     <select class="form-control add_new_dropdown" name="recipe">
                                                       <option value="Y" <?php if($recipe =="Yes") echo "selected";?>>Yes</option>
                                                       <option value="N" <?php if($recipe =="No") echo "selected";?>>No</option>
                                                     </select>
                                                </div>
                                            </div>
                                            
                                            
                                            <div class="permision_main_contant_cc">
                                            	<div class="permision_main_contant_name">Production</div>
                                                <div class="permision_main_contant_dropdown">
                                                     <select class="form-control add_new_dropdown" name="production">
                                                       <option value="Y" <?php if($production =="Yes") echo "selected";?>>Yes</option>
                                                       <option value="N" <?php if($production =="No") echo "selected";?>>No</option>
                                                     </select>
                                                </div>
                                            </div>
                                            
                                            
                                            <div class="permision_main_contant_cc">
                                            	<div class="permision_main_contant_name">Central Kitchen</div>
                                                <div class="permision_main_contant_dropdown">
                                                     <select class="form-control add_new_dropdown" name="central_kitchen">
                                                       <option value="Y" <?php if($central_kitchen =="Yes") echo "selected";?>>Yes</option>
                                                       <option value="N" <?php if($central_kitchen =="No") echo "selected";?>>No</option>
                                                     </select>
                                                </div>
                                            </div>
                                            
                                             <div class="permision_main_contant_cc">
                                            	<div class="permision_main_contant_name">Central Kitchen Accept</div>
                                                <div class="permision_main_contant_dropdown">
                                                     <select class="form-control add_new_dropdown" name="central_kitchen_accept">
                                                       <option value="Y" <?php if($central_kitchen_accept =="Yes") echo "selected";?>>Yes</option>
                                                       <option value="N" <?php if($central_kitchen_accept =="No") echo "selected";?>>No</option>
                                                     </select>
                                                </div>
                                            </div>
                                            
                                            <div class="permision_main_contant_cc">
                                            	<div class="permision_main_contant_name">Requisition Indent Transfer</div>
                                                <div class="permision_main_contant_dropdown">
                                                     <select class="form-control add_new_dropdown" name="indent">
                                                       <option value="Y" <?php if( $indent =="Yes") echo "selected";?>>Yes</option>
                                                       <option value="N" <?php if( $indent =="No") echo "selected";?>>No</option>
                                                     </select>
                                                </div>
                                            </div>
                                            
                                            
                                            <div class="permision_main_contant_cc">
                                            	<div class="permision_main_contant_name"> Indent Accept</div>
                                                <div class="permision_main_contant_dropdown">
                                                     <select class="form-control add_new_dropdown" name="indent_accept">
                                                       <option value="Y" <?php if($indent_accept =="Yes") echo "selected";?>>Yes</option>
                                                       <option value="N" <?php if($indent_accept =="No") echo "selected";?>>No</option>
                                                     </select>
                                                </div>
                                            </div>
                                            
                                            <div class="permision_main_contant_cc">
                                            	<div class="permision_main_contant_name">RPS Approve-Cancel </div>
                                                <div class="permision_main_contant_dropdown">
                                                     <select class="form-control add_new_dropdown" name="rps_approve_cancel">
                                                       <option value="Y" <?php if( $rps_approve_cancel =="Yes") echo "selected";?>>Yes</option>
                                                       <option value="N" <?php if( $rps_approve_cancel =="No") echo "selected";?>>No</option>
                                                     </select>
                                                </div>
                                            </div>
                                            
                                            
                                            <div class="permision_main_contant_cc">
                                            	<div class="permision_main_contant_name">Direct Transfer</div>
                                                <div class="permision_main_contant_dropdown">
                                                     <select class="form-control add_new_dropdown" name="direct_transfer">
                                                       <option value="Y" <?php if( $direct_transfer =="Yes") echo "selected";?>>Yes</option>
                                                       <option value="N" <?php if( $direct_transfer =="No") echo "selected";?>>No</option>
                                                     </select>
                                                </div>
                                            </div>
                                            
                                            
                                             <div class="permision_main_contant_cc">
                                            	<div class="permision_main_contant_name">Direct Transfer Accept</div>
                                                <div class="permision_main_contant_dropdown">
                                                     <select class="form-control add_new_dropdown" name="direct_transfer_accept">
                                                       <option value="Y" <?php if( $direct_transfer_accept =="Yes") echo "selected";?>>Yes</option>
                                                       <option value="N" <?php if( $direct_transfer_accept =="No") echo "selected";?>>No</option>
                                                     </select>
                                                </div>
                                            </div>
                                            
                                            
                                            <div class="permision_main_contant_cc">
                                            	<div class="permision_main_contant_name">Store Transfer Accept</div>
                                                <div class="permision_main_contant_dropdown">
                                                     <select class="form-control add_new_dropdown" name="store_transfer_accept">
                                                       <option value="Y" <?php if($store_transfer_accept =="Yes") echo "selected";?>>Yes</option>
                                                       <option value="N" <?php if($store_transfer_accept =="No")  echo "selected";?>>No</option>
                                                     </select>
                                                </div>
                                            </div>
                                            
                                           
                                        </div>
                                            
                                            
                                            
                                            
                                           
<!--                                        </form>-->
                                    </div>
                                    
                                    
                                    
                                    <div class="permission_left_div" style="margin-left:2px">
                                        
                                    	<div class="permission_left_div_head" style="font-size:15px" >
                                            
                                            <?php if($id!='1'){ ?>
                                            <a style=""  href="#"><div style="background-color:#e4aea4;color:black;width: 50px" class="permission_top_btn inherit_btn inherit_btn_click1">Inherit</div></a>
                                             
                                            <?php } ?>
                                           APP PERMISSIONS 
                                        	<a href="#"><div class="permission_top_btn permi_edit11">Edit</div></a>
                                		<a href="#"><div style="display:none;width: 45px" class="permission_top_btn permi_save11">Save</div></a>
                                                <a href="#"><div style="display:none" class="permission_top_btn permi_cancel1">Cancel</div></a>
                                        </div>
                                            
                                          <?php 
                                               
                                          $username='';   
                                          $sql_login  =  $database->mysqlQuery("select * from tbl_app_permissions  Where tap_staff_id='$id'"); 

                                          $num_login   = $database->mysqlNumRows($sql_login);

                                          if($num_login){
                                                  while($result_login  = $database->mysqlFetchArray($sql_login)) 
			                       {
//                                 
                                                if($result_login['tap_app_login']=="Y")
                                                    {

                                                            $applogin="Yes";
                                                    }else 
                                                    {
                                                            $applogin="No";
                                                    }
                                                    
                                                    if($result_login['tap_enable_type']=="Y")
                                                    {

                                                            $tap_enable_type="Yes";
                                                    }else 
                                                    {
                                                            $tap_enable_type="No";
                                                    }
                                                    
                                                    
                                                    
                                                     if($result_login['tap_dinein_module']=="Y")
                                                    {     $tap_dinein_module="Yes";
                                                    }else 
                                                    {      $tap_dinein_module="No";
                                                    }
                                                    
                                                    
                                                    if($result_login['tap_tahd_module']=="Y")
                                                    {   $tap_tahd_module="Yes";
                                                    }else 
                                                    {      $tap_tahd_module="No";
                                                    }
                                                    
                                                    
                                                    if($result_login['tap_cs_module']=="Y")
                                                    {   $tap_cs_module="Yes";
                                                    }else 
                                                    {      $tap_cs_module="No";
                                                    }
                                                    
                                                    
                                                    if($result_login['tap_item_cancel']=="Y")
                                                    {    $tap_item_cancel="Yes";
                                                    }else 
                                                    {     $tap_item_cancel="No";
                                                    }
                                                    
                                                    
                                                    if($result_login['tap_bill_cancel']=="Y")
                                                    {     $tap_bill_cancel="Yes";
                                                    }else 
                                                    {    $tap_bill_cancel="No";
                                                    }
                                                    
                                                    
                                                    if($result_login['tap_table_change']=="Y")
                                                    {     $tap_table_change="Yes";
                                                    }else 
                                                    {    $tap_table_change="No";
                                                    }
                                                    
                                                    if($result_login['tap_bill_reprint']=="Y")
                                                    {     $tap_bill_reprint="Yes";
                                                    }else 
                                                    {    $tap_bill_reprint="No";
                                                    }
                                                    
                                                     if($result_login['tap_settle_dinein']=="Y")
                                                    {     $tap_settle_dinein="Yes";
                                                    }else 
                                                    {    $tap_settle_dinein="No";
                                                    }
                                                    
                                                     if($result_login['tap_settle_ta_hd']=="Y")
                                                    {     $tap_settle_ta_hd="Yes";
                                                    }else 
                                                    {    $tap_settle_ta_hd="No";
                                                    }
                                                    
                                                    if($result_login['tap_settle_cs']=="Y")
                                                    {     $tap_settle_cs="Yes";
                                                    }else 
                                                    {    $tap_settle_cs="No";
                                                    }
                                                    
                                                    if($result_login['tap_shift']=="Y")
                                                    {     $tap_shift="Yes";
                                                    }else 
                                                    {    $tap_shift="No";
                                                    }
                                                    
                                           
                                                    if($result_login['tap_discount']=="Y")
                                                    {     $tap_discount="Yes";
                                                    }else 
                                                    {    $tap_discount="No";
                                                    }
                                                    
                                                     if($result_login['tap_regenerate']=="Y")
                                                    {     $tap_regenerate="Yes";
                                                    }else 
                                                    {     $tap_regenerate="No";
                                                    }
                                                    
                                                    if($result_login['tap_complimentary']=="Y")
                                                    {     $tap_complimentary="Yes";
                                                    }else 
                                                    {    $tap_complimentary="No";
                                                    }
                                                    
                                                    
                                                     if($result_login['tap_tip']=="Y")
                                                    {     $tap_tip="Yes";
                                                    }else 
                                                    {     $tap_tip="No";
                                                    }
                                                    
                                                    if($result_login['tap_hold']=="Y")
                                                    {     $tap_hold="Yes";
                                                    }else 
                                                    {    $tap_hold="No";
                                                    }
                                                
                                                    
                                                     if($result_login['tap_all_settle']=="Y")
                                                    {     $tap_all_settle="Yes";
                                                    }else 
                                                    {    $tap_all_settle="No";
                                                    }
                                                    
                                                    
                                                    
                                                 } } ?>

                                        <div class="permission_contant_cc staff_permission_view11">
                                     
                                            
                                            
                                            <div class="permision_main_contant_cc">
                                            	<div class="permision_main_contant_name">APP LOGIN PERMISSION </div>
                                                <span style="float:left;line-height:30px;">:</span>
                                                 <div class="permision_main_contant">
                                                	<?=$applogin?>
                                                </div>
                                            </div>
                                            
                                            
                                            <div class="permision_main_contant_cc">
                                            	<div class="permision_main_contant_name">DINE-IN MODULE PERMISSION </div>
                                                <span style="float:left;line-height:30px;">:</span>
                                                 <div class="permision_main_contant">
                                                	<?=$tap_dinein_module?>
                                                </div>
                                            </div>
                                            
                                            
                                            <div class="permision_main_contant_cc">
                                            	<div class="permision_main_contant_name">TA-HD MODULE PERMISSION </div>
                                                <span style="float:left;line-height:30px;">:</span>
                                                 <div class="permision_main_contant">
                                                	<?=$tap_tahd_module?>
                                                </div>
                                            </div>
                                            
                                            
                                            <div class="permision_main_contant_cc">
                                            	<div class="permision_main_contant_name">CS MODULE PERMISSION </div>
                                                <span style="float:left;line-height:30px;">:</span>
                                                 <div class="permision_main_contant">
                                                	<?=$tap_cs_module?>
                                                </div>
                                            </div>
                                            
                                            
                                            <div class="permision_main_contant_cc">
                                            	<div class="permision_main_contant_name">ITEM CANCEL PERMISSION </div>
                                                <span style="float:left;line-height:30px;">:</span>
                                                 <div class="permision_main_contant">
                                                	<?=$tap_item_cancel?>
                                                </div>
                                            </div>
                                            
                                            
                                            <div class="permision_main_contant_cc">
                                            	<div class="permision_main_contant_name">BILL CANCEL PERMISSION </div>
                                                <span style="float:left;line-height:30px;">:</span>
                                                 <div class="permision_main_contant">
                                                	<?=$tap_bill_cancel?>
                                                </div>
                                            </div>
                                            
                                            
                                            <div class="permision_main_contant_cc">
                                            	<div class="permision_main_contant_name">TABLE CHANGE </div>
                                                <span style="float:left;line-height:30px;">:</span>
                                                 <div class="permision_main_contant">
                                                	<?=$tap_table_change?>
                                                </div>
                                            </div>
                                            
                                            
                                            <div class="permision_main_contant_cc">
                                            	<div class="permision_main_contant_name">BILL REPRINT </div>
                                                <span style="float:left;line-height:30px;">:</span>
                                                 <div class="permision_main_contant">
                                                	<?=$tap_bill_reprint?>
                                                </div>
                                            </div>
                                            
                                            
                                            <div class="permision_main_contant_cc">
                                            	<div class="permision_main_contant_name">SETTLE DINE-IN  </div>
                                                <span style="float:left;line-height:30px;">:</span>
                                                 <div class="permision_main_contant">
                                                	<?=$tap_settle_dinein?>
                                                </div>
                                            </div>
                                            
                                            <div class="permision_main_contant_cc">
                                            	<div class="permision_main_contant_name">SETTLE TA-HD </div>
                                                <span style="float:left;line-height:30px;">:</span>
                                                 <div class="permision_main_contant">
                                                	<?=$tap_settle_ta_hd?>
                                                </div>
                                            </div>
                                            
                                            <div class="permision_main_contant_cc">
                                            	<div class="permision_main_contant_name">SETTLE CS </div>
                                                <span style="float:left;line-height:30px;">:</span>
                                                 <div class="permision_main_contant">
                                                	<?=$tap_settle_cs?>
                                                </div>
                                            </div>
                                            
                                              <div class="permision_main_contant_cc">
                                            	<div class="permision_main_contant_name">SHIFT OPEN </div>
                                                <span style="float:left;line-height:30px;">:</span>
                                                 <div class="permision_main_contant">
                                                	<?=$tap_shift?>
                                                </div>
                                            </div>
                                            
                                            <div class="permision_main_contant_cc">
                                            	<div class="permision_main_contant_name">DISCOUNT PERMISSION</div>
                                                <span style="float:left;line-height:30px;">:</span>
                                                 <div class="permision_main_contant">
                                                	<?=$tap_discount?>
                                                </div>
                                            </div>
                                
                                            <div class="permision_main_contant_cc">
                                            	<div class="permision_main_contant_name">REGENERATE PERMISSION</div>
                                                <span style="float:left;line-height:30px;">:</span>
                                                 <div class="permision_main_contant">
                                                	<?=$tap_regenerate?>
                                                </div>
                                            </div>
                                            
                                             <div class="permision_main_contant_cc">
                                            	<div class="permision_main_contant_name">COMPLIMENTARY PERMISSION</div>
                                                <span style="float:left;line-height:30px;">:</span>
                                                 <div class="permision_main_contant">
                                                	<?=$tap_complimentary?>
                                                </div>
                                            </div>
                                            
                                            <div class="permision_main_contant_cc">
                                            	<div class="permision_main_contant_name">TIP PERMISSION</div>
                                                <span style="float:left;line-height:30px;">:</span>
                                                 <div class="permision_main_contant">
                                                	<?=$tap_tip?>
                                                </div>
                                            </div>
                                            
                                            <div class="permision_main_contant_cc">
                                            	<div class="permision_main_contant_name">HOLD PERMISSION</div>
                                                <span style="float:left;line-height:30px;">:</span>
                                                 <div class="permision_main_contant">
                                                	<?=$tap_hold?>
                                                </div>
                                            </div>
                                            
                                            
                                             <div class="permision_main_contant_cc">
                                            	<div class="permision_main_contant_name">All SETTLE</div>
                                                <span style="float:left;line-height:30px;">:</span>
                                                 <div class="permision_main_contant">
                                                	<?=$tap_all_settle?>
                                                </div>
                                            </div>
                                            
                                            
                                            
                                        </div>
                                        
                                        
                                            
                                            
                                            
                                            
                                            
                                             <!--   ///edit/////-->
                                            
                                            
                                            <div class="permission_contant_cc staff_permission_edit11" style="display:none">
                                                  
                                             <div   class="module_cat_head ">
                                                 <span><input onclick="app_enable_all('<?=$id?>')" type="checkbox" class="check_box_main app_enable_all" <?php if($tap_enable_type=="Yes"){ ?> checked="checked" <?php } ?>></span>
                                             <span style="font-size:15px;padding-left:5px">Enable All</span>
                                            </div>
                                                
                                                
                                            
                                            <div class="permision_main_contant_cc edit_div">
                                            	<div class="permision_main_contant_name">APP LOGIN PERMISSION</div>
                                                <div class="permision_main_contant_dropdown">
                                                     <select class="form-control add_new_dropdown" name="tap_app_login">
                                                       <option value="Y" <?php if($applogin =="Yes") echo "selected";?>>Yes</option>
                                                       <option value="N" <?php if($applogin =="No") echo "selected";?>>No</option>
                                                     </select>
                                               </div>
                                            </div>
                                            
                                                
                                               <div class="permision_main_contant_cc edit_div">
                                            	<div class="permision_main_contant_name">DINE-IN MODULE PERMISSION</div>
                                                <div class="permision_main_contant_dropdown">
                                                     <select class="form-control add_new_dropdown" name="tap_dinein_module">
                                                       <option value="Y" <?php if($tap_dinein_module =="Yes") echo "selected";?>>Yes</option>
                                                       <option value="N" <?php if($tap_dinein_module =="No") echo "selected";?>>No</option>
                                                     </select>
                                               </div>
                                            </div>
                                                
                                                
                                                  <div class="permision_main_contant_cc edit_div">
                                            	<div class="permision_main_contant_name">TA-HD MODULE PERMISSION</div>
                                                <div class="permision_main_contant_dropdown">
                                                     <select class="form-control add_new_dropdown" name="tap_tahd_module">
                                                       <option value="Y" <?php if($tap_tahd_module =="Yes") echo "selected";?>>Yes</option>
                                                       <option value="N" <?php if($tap_tahd_module =="No") echo "selected";?>>No</option>
                                                     </select>
                                               </div>
                                            </div>
                                                
                                                  <div class="permision_main_contant_cc edit_div">
                                            	<div class="permision_main_contant_name">CS MODULE PERMISSION</div>
                                                <div class="permision_main_contant_dropdown">
                                                     <select class="form-control add_new_dropdown" name="tap_cs_module">
                                                       <option value="Y" <?php if($tap_cs_module =="Yes") echo "selected";?>>Yes</option>
                                                       <option value="N" <?php if($tap_cs_module =="No") echo "selected";?>>No</option>
                                                     </select>
                                               </div>
                                            </div>
                                                
                                                  <div class="permision_main_contant_cc edit_div">
                                            	<div class="permision_main_contant_name">ITEM CANCEL PERMISSION</div>
                                                <div class="permision_main_contant_dropdown">
                                                     <select class="form-control add_new_dropdown" name="tap_item_cancel">
                                                       <option value="Y" <?php if($tap_item_cancel =="Yes") echo "selected";?>>Yes</option>
                                                       <option value="N" <?php if($tap_item_cancel =="No") echo "selected";?>>No</option>
                                                     </select>
                                               </div>
                                            </div>
                                                
                                                  <div class="permision_main_contant_cc edit_div">
                                            	<div class="permision_main_contant_name">BILL CANCEL PERMISSION</div>
                                                <div class="permision_main_contant_dropdown">
                                                     <select class="form-control add_new_dropdown" name="tap_bill_cancel">
                                                       <option value="Y" <?php if($tap_bill_cancel =="Yes") echo "selected";?>>Yes</option>
                                                       <option value="N" <?php if($tap_bill_cancel =="No") echo "selected";?>>No</option>
                                                     </select>
                                               </div>
                                            </div>
                                                
                                                
                                            <div class="permision_main_contant_cc edit_div">
                                            	<div class="permision_main_contant_name">TABLE CHANGE</div>
                                                <div class="permision_main_contant_dropdown">
                                                     <select class="form-control add_new_dropdown" name="tap_table_change">
                                                       <option value="Y" <?php if($tap_table_change =="Yes") echo "selected";?>>Yes</option>
                                                       <option value="N" <?php if($tap_table_change =="No") echo "selected";?>>No</option>
                                                     </select>
                                               </div>
                                            </div>
                                                
                                              
                                                <div class="permision_main_contant_cc edit_div">
                                            	<div class="permision_main_contant_name">BILL REPRINT CHANGE</div>
                                                <div class="permision_main_contant_dropdown">
                                                     <select class="form-control add_new_dropdown" name="tap_bill_reprint">
                                                       <option value="Y" <?php if($tap_bill_reprint =="Yes") echo "selected";?>>Yes</option>
                                                       <option value="N" <?php if($tap_bill_reprint =="No") echo "selected";?>>No</option>
                                                     </select>
                                               </div>
                                            </div>
                                                
                                                <div class="permision_main_contant_cc edit_div">
                                            	<div class="permision_main_contant_name">SETTLE DINE-IN</div>
                                                <div class="permision_main_contant_dropdown">
                                                     <select class="form-control add_new_dropdown" name="tap_settle_dinein">
                                                       <option value="Y" <?php if($tap_settle_dinein =="Yes") echo "selected";?>>Yes</option>
                                                       <option value="N" <?php if($tap_settle_dinein =="No") echo "selected";?>>No</option>
                                                     </select>
                                               </div>
                                            </div>
                                                
                                                <div class="permision_main_contant_cc edit_div">
                                            	<div class="permision_main_contant_name">SETTLE TA-HD</div>
                                                <div class="permision_main_contant_dropdown">
                                                     <select class="form-control add_new_dropdown" name="tap_settle_ta_hd">
                                                       <option value="Y" <?php if($tap_settle_ta_hd =="Yes") echo "selected";?>>Yes</option>
                                                       <option value="N" <?php if($tap_settle_ta_hd =="No") echo "selected";?>>No</option>
                                                     </select>
                                               </div>
                                            </div>
                                                
                                                <div class="permision_main_contant_cc edit_div">
                                            	<div class="permision_main_contant_name">SETTLE CS </div>
                                                <div class="permision_main_contant_dropdown">
                                                     <select class="form-control add_new_dropdown" name="tap_settle_cs">
                                                       <option value="Y" <?php if($tap_settle_cs =="Yes") echo "selected";?>>Yes</option>
                                                       <option value="N" <?php if($tap_settle_cs =="No") echo "selected";?>>No</option>
                                                     </select>
                                               </div>
                                            </div>
                                                
                                                
                                                <div class="permision_main_contant_cc edit_div">
                                            	<div class="permision_main_contant_name">SHIFT OPEN</div>
                                                <div class="permision_main_contant_dropdown">
                                                     <select class="form-control add_new_dropdown" name="tap_shift">
                                                       <option value="Y" <?php if($tap_shift =="Yes") echo "selected";?>>Yes</option>
                                                       <option value="N" <?php if($tap_shift =="No") echo "selected";?>>No</option>
                                                     </select>
                                               </div>
                                            </div>
                                                
                                                
                                            <div class="permision_main_contant_cc edit_div">
                                            	<div class="permision_main_contant_name">DISCOUNT PERMISSION</div>
                                                <div class="permision_main_contant_dropdown">
                                                     <select class="form-control add_new_dropdown" name="tap_discount">
                                                       <option value="Y" <?php if($tap_discount =="Yes") echo "selected";?>>Yes</option>
                                                       <option value="N" <?php if($tap_discount =="No") echo "selected";?>>No</option>
                                                     </select>
                                               </div>
                                            </div>
                                                
                                            <div class="permision_main_contant_cc edit_div">
                                            	<div class="permision_main_contant_name">REGENERATE PERMISSION</div>
                                                <div class="permision_main_contant_dropdown">
                                                     <select class="form-control add_new_dropdown" name="tap_regenerate">
                                                       <option value="Y" <?php if($tap_regenerate =="Yes") echo "selected";?>>Yes</option>
                                                       <option value="N" <?php if($tap_regenerate =="No") echo "selected";?>>No</option>
                                                     </select>
                                               </div>
                                            </div>
                                                
                                                <div class="permision_main_contant_cc edit_div">
                                            	<div class="permision_main_contant_name">COMPLIMENTARY PERMISSION</div>
                                                <div class="permision_main_contant_dropdown">
                                                     <select class="form-control add_new_dropdown" name="tap_complimentary">
                                                       <option value="Y" <?php if($tap_complimentary =="Yes") echo "selected";?>>Yes</option>
                                                       <option value="N" <?php if($tap_complimentary =="No") echo "selected";?>>No</option>
                                                     </select>
                                               </div>
                                            </div>
                                                
                                                <div class="permision_main_contant_cc edit_div">
                                            	<div class="permision_main_contant_name">TIP PERMISSION</div>
                                                <div class="permision_main_contant_dropdown">
                                                     <select class="form-control add_new_dropdown" name="tap_tip">
                                                       <option value="Y" <?php if($tap_tip =="Yes") echo "selected";?>>Yes</option>
                                                       <option value="N" <?php if($tap_tip =="No") echo "selected";?>>No</option>
                                                     </select>
                                               </div>
                                            </div>
                                                
                                                <div class="permision_main_contant_cc edit_div">
                                            	<div class="permision_main_contant_name">HOLD PERMISSION</div>
                                                <div class="permision_main_contant_dropdown">
                                                     <select class="form-control add_new_dropdown" name="tap_hold">
                                                       <option value="Y" <?php if($tap_hold =="Yes") echo "selected";?>>Yes</option>
                                                       <option value="N" <?php if($tap_hold =="No") echo "selected";?>>No</option>
                                                     </select>
                                               </div>
                                            </div>
                                                
                                                
                                             <div class="permision_main_contant_cc edit_div">
                                            	<div class="permision_main_contant_name">ALL SETTLE</div>
                                                <div class="permision_main_contant_dropdown">
                                                     <select class="form-control add_new_dropdown" name="tap_all_settle">
                                                       <option value="Y" <?php if($tap_all_settle =="Yes") echo "selected";?>>Yes</option>
                                                       <option value="N" <?php if($tap_all_settle =="No") echo "selected";?>>No</option>
                                                     </select>
                                               </div>
                                            </div>   
                                                
                                            
                                           
                                        </div>
                   
                           
                                    </div>
                                    
                                    
                                    
                                    
                                    <div class="permission_left_div">
                                        <div style="font-size:15px" class="permission_left_div_head">MODULE PERMISSION 
                                            
                                           <?php if($id!='1'){ ?>
                                            <a style=""  href="#">
                                                <div style="background-color:#e4aea4;color:black;width: 50px" class="permission_top_btn inherit_btn inherit_btn_click" mode="User_Permission">
                                                    Inherit
                                                </div>
                                            </a>
                                             
                                            <?php } ?>  
                                            
                                           <a href="#"><div class="permission_top_btn permi_edit2">Edit</div></a>
                                           <a href="#"><div style="display:none;width: 45px" class="permission_top_btn permi_save2">Save</div></a>
                                           <a href="#"><div style="display:none" class="permission_top_btn permi_cancel2">Cancel</div></a>
                                        </div>
                     
                                        <div class="permission_contant_cc staff_permission_view2">
                                            <?php
                                            $module='';$modulest='';
//                                            $userpermission='';$name='';$merid='';
                $sql_mainmod  =  $database->mysqlQuery("select * from tbl_modulemaster order by mer_modulename asc"); 
                  $num_mainmod   = $database->mysqlNumRows($sql_mainmod);
                  if($num_mainmod){
                                                                  while($result_mainmod  = $database->mysqlFetchArray($sql_mainmod)) 
                                                                        {
                                                                                ?>
                       <?php 
                                                                                $module=$database->show_usermodule_ful_details($result_mainmod['mer_moduleid'],$_SESSION['stfidsess']); 
                                                                                $modulest=$module['um_access'];
                                                                                $moduleid=$result_mainmod['mer_moduleid'];

                                                                                if($result_mainmod['mer_modulename']!="Admin Home"){
                 ?>

                                        <div class="module_cat_head1 topic<?=$result_mainmod['mer_moduleid']?>">                                                           	
                                            <?php

                                            
                                $sql_login  =  $database->mysqlQuery("select * from tbl_usermodules Where um_username='".$_SESSION['stfidsess']."'"); 
	                        $num_login   = $database->mysqlNumRows($sql_login);
                                $data_item = array();
                                $data_subitem=array();
                                if($num_login){
		                while($result_login  = $database->mysqlFetchArray($sql_login)) 
			       {
                                $userpermission=  $result_login['um_access']; 
                                $data_item[] = $result_login['um_moduleid'];
                                $data_subitem[] = $result_login['um_submoduleid'];
                              }                             
                            } 
                            $merid = null;
                            $moduleid1 = $data_item ;
                            foreach( $moduleid1 as $val)
                            {
                              if($val == $moduleid)
                                { 
                                    if(isset($merid))
                                        {    if($merid == $val)
                                             $merid=$val;
                                        }
                                    else
                                        { 
                                             $merid=$val;
                                        }
                                }
                            }
                            
                           
                                       ?>
                                            <div class="permision_main_contant_cc" style="background-color: #cd3636;color: white;margin-top: -10px; ">
                                                <div  style="text-transform: uppercase " class="permision_main_contant_name"><?=$result_mainmod['mer_modulename']?></div>
                                                <span style="float:left;line-height:30px;">:</span>
                                               <div class="permision_main_contant" style="color: white ">
                                                   
                                                <?php
//                                                echo $_SESSION['stfidsess'];
//                                                echo $merid;
//                                                echo $moduleid;
                                               
                                                   if($moduleid == $merid)
                                                        {?>

                                                             Yes
                                                       <?php }else 
                                                        {?>
                                                             No
                                                       <?php } ?>
                                                	
                                                   
                                                </div>
                                            </div>
                                                                           
<!--                                                                    <span><?=$result_mainmod['mer_modulename']?></span>-->
                                                                </div><!--mod_cat_head-->
                                                                <?php } ?>
                                             <div class="subtopic">
                                             <ul class="inputs-list<?=$result_mainmod['mer_moduleid']?>">
                                                <?php
                                               $submoduleid='';$merid1='';$moduleid2='';$val='';
				          $sql_submod  =  $database->mysqlQuery("select * from tbl_modulesubmaster where mser_moduleid='".$result_mainmod['mer_moduleid']."' "); 
                                          $num_submod   = $database->mysqlNumRows($sql_submod);
                                          if($num_submod){
											  while($result_submod  = $database->mysqlFetchArray($sql_submod)) 
												{
													$submodule=$database->show_usersubmodule_ful_details($result_mainmod['mer_moduleid'],$_SESSION['stfidsess'],$result_submod['mser_submoduleid']);
													$submodulest=$submodule['um_access'];
													$filter=explode(" ",$result_submod['mser_subname']);
                                                                                                         $submoduleid=$result_submod['mser_submoduleid'];
                                                                                                        $merid1 = null;
                                                                                                        $moduleid2 = $data_subitem ;
                                                                                                        foreach( $moduleid2 as $val)
                                                                                                        {
                                                                                                          if($val == $submoduleid)
                                                                                                            { 
                                                                                                                if(isset($merid1))
                                                                                                                    {    if($merid1 == $val)
                                                                                                                         $merid1=$val;
                                                                                                                    }
                                                                                                                else
                                                                                                                    { 
                                                                                                                         $merid1=$val;
                                                                                                                    }
                                                                                                            }
                                                                                                        }    
                                                                                                        
													if($filter[0]!="Load"){
													if($result_submod['mser_subname']!="Default"){
                                         ?>                
                                                               <li class="module_sub_category1">
                                                                                       <div class="permision_main_contant_cc">
                                            	<div class="permision_main_contant_name"><?=$result_submod['mser_subname']?></div>
                                                <span style="float:left;line-height:30px;">:</span>
                                               <div class="permision_main_contant">
                                                   <?php
//                                                echo $_SESSION['stfidsess'];
//                                                echo $merid1;
//                                                echo $moduleid;
                                                   //echo $_REQUEST['mainmodule'];
                                                   
                                                   if($submoduleid == $merid1)
                                                        {?>

                                                            Yes
                                                       <?php }else 
                                                        {?>
                                                             No
                                                       <?php } ?>
                                            </div>
<!--                                                                	<input type="checkbox" class="check_box_main permisn_sub" <?php if($submodulest!=""){ ?> checked <?php } ?> value="<?=$result_submod['mser_submoduleid']?>"  name="permisn_sub[]" >
                                                                    <span><?=$result_submod['mser_subname']?></span>-->
                                                               <!-- module_sub_category-->
                                                                </li>
                                                <?php  }}
                                                
                                               
} } ?> 
                                                </ul> 
                                                 </div>
                                                                 
                                                            
                                                                       <?php } }
//if($_SERVER['REQUEST_METHOD']=='POST' )
//{  
//    
//    if($_REQUEST['mainmodule'] !="") {
//        $mainmodule=implode($_REQUEST['mainmodule'],",");
//     $sql  =  $database->mysqlQuery("DELETE FROM tbl_usermodules WHERE `um_username` = '".$_SESSION['stfidsess']."' and um_moduleid = '".$_REQUEST['mainmodule']."'");   
//    }
//
//}
                                                
                                                                        ?>

                                        </div>
                                                            <!--checkbox start -->
                                        <div class="permission_contant_cc staff_permission_edit2" style="display:none">
                                            <div class="permision_main_contant_cc">
                                                <div class="module_check_box_cc" style="background-color:#fff;">
                                                        	<div class="main_text_cc" id="loadfulldata">
                                                            <input type="hidden" value="<?=$_SESSION['stfidsess'] ?>" name="stf" id="stf" >
                                                            <input type="hidden" value="insert" name="set" id="set" >
                                                            <div   class="module_cat_head ">
                                                                	<span><input type="checkbox" class="check_box_main checkallchek" <?php if($modulest!=""){ ?> checked="checked" <?php } ?>></span>
                                                                    <span style="font-size:15px;padding-left:5px">Check All</span>
<!--                                                                   <span style="font-size: 21px;width: 50%;display: inline-block;text-align: right;"> <?=$_SESSION['stfidsess'] ?></span>-->
                                                                </div>
                                                            
                                                            
                                                            
                                                            <?php
															//echo $_SESSION['stfidsess'];
										//`tbl_usermodules`(`um_username`, `um_moduleid`, `um_submoduleid`, `um_access`)
										//`tbl_modulemaster`(`mer_moduleid`, `mer_modulename`, `mer_modulelink`)
										//`tbl_modulesubmaster`(`mser_submoduleid`, `mser_moduleid`, `mser_subname`, `mser_submodulelink`)
                                         $sql_mainmod  =  $database->mysqlQuery("select * from tbl_modulemaster order by mer_modulename asc"); 
                                          $num_mainmod   = $database->mysqlNumRows($sql_mainmod);
                                          if($num_mainmod){
											  while($result_mainmod  = $database->mysqlFetchArray($sql_mainmod)) 
												{
													?>
<script type="text/javascript">
$(document).ready(function () {

    $(".topic<?=$result_mainmod['mer_moduleid']?>").click(function(){
     
      var is_checked=$(this).is(":checked");



        //$(".inputs-list<?=$result_mainmod['mer_moduleid']?> > li > input[type='checkbox']").prop("checked",is_checked);
        
        
		
    });
    $(".inputs-list<?=$result_mainmod['mer_moduleid']?> > li > input[type='checkbox']").click(function() {
     //  alert("kk");  
      var  is_checked=$(this).is(":checked");
        
        if($(".inputs-list<?=$result_mainmod['mer_moduleid']?> > li > input[type='checkbox']:checked").length == 0)
			{
			   $(".topic<?=$result_mainmod['mer_moduleid']?> input[type='checkbox']").prop("checked",false); 
			}else
			{
				$(".topic<?=$result_mainmod['mer_moduleid']?> input[type='checkbox']").prop("checked",true);
			   
			}
    });
    
    
   $('#multi_check_<?=$result_mainmod['mer_moduleid']?>').click(function(){ 
    

    if($("#multi_check_<?=$result_mainmod['mer_moduleid']?>").prop('checked') == true){ 
         
      $('.permisn_sub1_<?=$result_mainmod['mer_moduleid']?>').each(function(){
         
        $(this).prop('checked',true);     
        
   });
     
   }else{  
       
        $('.permisn_sub1_<?=$result_mainmod['mer_moduleid']?>').each(function(){
            
        $(this).prop('checked',false);
       
        });
   
   }
     
    
});
    
    
    
    
});

</script>

                                                    <?php 
													$module=$database->show_usermodule_ful_details($result_mainmod['mer_moduleid'],$_SESSION['stfidsess']); 
													$modulest=$module['um_access'];
													if($result_mainmod['mer_modulename']!="Admin Home"){
                                         ?>
                                       
                                                            	<div style="background-color: #cd3636;color: white !important" class="module_cat_head topic<?=$result_mainmod['mer_moduleid']?>">
                                                                	<span>
                                                                    <?php 
																	
									if($result_mainmod['mer_modulename']!="Home Page"){ ?> 
                                                                    	<input id="multi_check_<?=$result_mainmod['mer_moduleid']?>" type="checkbox" class="check_box_main permisn " <?php if($modulest!=""){ ?> checked="checked" <?php } ?> value="<?=$result_mainmod['mer_moduleid']?>"  name="permisn[]"  >
                                                                     <?php }else { ?>
                                                                     <input id="multi_check_<?=$result_mainmod['mer_moduleid']?>" type="checkbox" class="check_box_main permisn "  checked  value="<?=$result_mainmod['mer_moduleid']?>"  name="permisn[]"  >
                                                                     <?php } ?>
                                                                    </span>
                                                                    <span ><?=$result_mainmod['mer_modulename']?></span>
                                                                </div><!--mod_cat_head-->
                                                                <?php } ?>
                                             <div class="subtopic">
                                             <ul class="inputs-list<?=$result_mainmod['mer_moduleid']?>">
                                                <?php
										   $sql_submod  =  $database->mysqlQuery("select * from tbl_modulesubmaster where mser_moduleid='".$result_mainmod['mer_moduleid']."' "); 
                                          $num_submod   = $database->mysqlNumRows($sql_submod);
                                          if($num_submod){
											  while($result_submod  = $database->mysqlFetchArray($sql_submod)) 
												{
													$submodule=$database->show_usersubmodule_ful_details($result_mainmod['mer_moduleid'],$_SESSION['stfidsess'],$result_submod['mser_submoduleid']);
													$submodulest=$submodule['um_access'];
													$filter=explode(" ",$result_submod['mser_subname']);
													if($filter[0]!="Load"){
													if($result_submod['mser_subname']!="Default"){
                                         ?>                
                                                               <li class="module_sub_category">
                                                                
                                                                	<input type="checkbox" class="check_box_main permisn_sub permisn_sub1_<?=$result_mainmod['mer_moduleid']?>" <?php if($submodulest!=""){ ?> checked <?php } ?> value="<?=$result_submod['mser_submoduleid']?>"  name="permisn_sub[]" >
                                                                    <span><?=$result_submod['mser_subname']?></span>
                                                                <!--module_sub_category-->
                                                                </li>
                                                <?php  }}} } ?> 
                                                </ul> 
                                                 </div>
                                                            
                                                           <?php } } ?>     
                                                           
                                                           
                                                           
                                                           
                                                           
                                                               
                                                                
                                                            </div><!--main_text_cc-->
                                                        </div><!--module_check_box_cc-->
                                        
                                        </div>
                                        </div>
                                    </div>  
                                
                            
                            
                            
                            
                            
                            
                       </div>
                       
                </div><!--main content-sec-->
		</div>
	</div>
</div>
</div><!--container-->
</div>
    
 <div class="change_permission_overlay" style="display: none;"></div>   
   
 
 <div class="change_permission_popup1" style="display: none;">
 	<h3>Inherit App Permissions</h3>
    <div class="change_permission_content">
    
    	<div class="edit_menu_label_permission">
           <div class="label_main_member_edit">From</div>
      <select class="form-control_main" placeholder="User Name" id="staff_from1" name="staff_from1">
		  <option value="">Select App User</option>
         <?php
		   $sql_login  =  $database->mysqlQuery("select * from tbl_staffmaster Where ser_employeestatus='Active' "); 

                                          $num_login   = $database->mysqlNumRows($sql_login);

                                          if($num_login){
                                                  while($result_login  = $database->mysqlFetchArray($sql_login)) 
			                       {
                                                      ?>
                                                  <option value="<?=$result_login['ser_staffid']?>"> <?= $result_login['ser_firstname']?> </option>     
                                                      <?php
                                                  }
                                                  }
                                                  ?>
	</select>
         </div><!---edit_menu_label-->
    
           <div class="change_permission_popup_btn">
         		<a href="#"><div class="pop_btn_new_1 inherit_ok_bt" id="inherit_staff1" onclick="validate_permisn()">OK</div></a>
                <a href="#"><div class="pop_btn_new_1" id="canc1">Cancel</div></a>
         </div>
         
    </div><!--change_popup_content-->
 </div>
 
 
 
<div class="change_permission_popup" style="display: none;">
    <h3>Inherit  Permissions [ <span id="user_mode"></span> ] </h3>
    <div class="change_permission_content">
    
    	<div class="edit_menu_label_permission">
           <div class="label_main_member_edit">From</div>
      <select class="form-control_main" placeholder="User Name" id="staff_from" name="staff_from">
		  <option value="">Select User</option>
         <?php
		   $sql_login  =  $database->mysqlQuery("select * from tbl_staffmaster Where ser_employeestatus='Active' "); 

                                          $num_login   = $database->mysqlNumRows($sql_login);

                                          if($num_login){
                                                  while($result_login  = $database->mysqlFetchArray($sql_login)) 
			                       {
                                                      ?>
                                                  <option value="<?=$result_login['ser_staffid']?>"> <?= $result_login['ser_firstname']?> </option>     
                                                      <?php
                                                  }
                                                  }
                                                  ?>
	</select>
         </div><!---edit_menu_label-->
    
           <div class="change_permission_popup_btn">
         		<a href="#"><div class="pop_btn_new_1 inherit_ok_bt" id="inherit_staff" onclick="validate_permisn()">OK</div></a>
                <a href="#"><div class="pop_btn_new_1" id="canc">Cancel</div></a>
         </div>
         
    </div><!--change_popup_content-->
 </div>
 


<script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<script src="js/jquery.cookie.js"></script>

<script>
     $(document).ready(function() {
         
     $(".permi_edit11").click(function(){
         
        $(".permi_edit11").css("display","none");
	$(".permi_save11").css("display","block");
        $(".permi_cancel1").css("display","block");
        
	$(".staff_permission_edit11").css("display","block");
	$(".staff_permission_view11").css("display","none");
});

$(".permi_save11").click(function(){
    $(".permi_edit11").css("display","block");
	$(".permi_save11").css("display","none");
	$(".staff_permission_edit11").css("display","none");
	$(".staff_permission_view11").css("display","block");
        document.permission_new.submit();
});    
         
       
  $(".permi_cancel").click(function(){
    
       location.reload();
});       
   
     $(".permi_cancel1").click(function(){
    
       location.reload();
});  
   
   
   
     $(".permi_cancel2").click(function(){
    
       location.reload();
});  
         
$(".permi_edit1").click(function(){
    
        $(".permi_edit1").css("display","none");
        $(".permi_cancel").css("display","block");
        $(".permi_save1").css("display","block");
	$(".staff_permission_edit1").css("display","block");
	$(".staff_permission_view1").css("display","none");
});


$(".permi_save1").click(function(){
    $(".permi_edit1").css("display","block");
	$(".permi_save1").css("display","none");
	$(".staff_permission_edit1").css("display","none");
	$(".staff_permission_view1").css("display","block");
        document.permission_new.submit();
});


$(".permi_edit2").click(function(){
    
        $(".permi_edit2").css("display","none");
	$(".permi_save2").css("display","block");
        $(".permi_cancel2").css("display","block");
	$(".staff_permission_edit2").css("display","block");
	$(".staff_permission_view2").css("display","none");
});

$(".permi_save2").click(function(){
    $(".permi_edit2").css("display","block");
	$(".permi_save2").css("display","none");
	$(".staff_permission_edit2").css("display","none");
	$(".staff_permission_view2").css("display","block");
        document.permission_new.submit();
         var data = $("form").serialize(); 
//alert(data);
                $.ajax({
                    url: "load_permission.php", // link of your "whatever" php
                    type: "POST",
                    async: true,
                    cache: false,
                    data: data, // all data will be passed here
                    success: function(data){ 
                        
                       // alert(data) // The data that is echoed from the ajax.php
                    }
                });
        
});
$(".permi_edit3").click(function(){
    $(".permi_edit3").css("display","none");
	$(".permi_save3").css("display","block");
	$(".staff_permission_edit3").css("display","block");
	$(".staff_permission_view3").css("display","none");
});

$(".permi_save3").click(function(){
    $(".permi_edit3").css("display","block");
	$(".permi_save3").css("display","none");
	$(".staff_permission_edit3").css("display","none");
	$(".staff_permission_view3").css("display","block");
        document.permission_new.submit();
});


$('.checkallchek').click(function(event) { 
    
        if(this.checked) { // check select status
            $('.permisn').each(function() { //loop through each checkbox
                this.checked = true;  //select all checkboxes with class "checkbox1"               
            });
            
			 $('.permisn_sub').each(function() { //loop through each checkbox
                this.checked = true;  //select all checkboxes with class "checkbox1"               
            });
            
        }else{
            $('.permisn').each(function() { //loop through each checkbox
                this.checked = false; //deselect all checkboxes with class "checkbox1"                       
            });  
			 $('.permisn_sub').each(function() { //loop through each checkbox
                this.checked = false;  //select all checkboxes with class "checkbox1"               
            });       
        }
      });
     });
    
    
    
    
    
    $(".inherit_btn_click").click(function(){
        
        $(".change_permission_overlay").show();
        $(".change_permission_popup").show();
        
        
        var mode=$(this).attr('mode');
      
         $(".change_permission_popup").attr('mode',mode);
        
        $("#user_mode").text(mode);
        
       var staff= $("#staff_id_inherit").val(); 
       
        var data = "set=load_inherit&staff="+staff+"&mode="+mode; 
  
                    $.ajax({
                    url: "load_permission.php", 
                    type: "POST",
                    async: true,
                    cache: false,
                    data: data, 
                    success: function(data){ 
                        
                        $('#staff_from').val($.trim(data));
                        
                    }
                });
        
        
    });
    
    
    $("#canc").click(function(){
        $(".change_permission_overlay").hide();
        $(".change_permission_popup").hide();
    });
   
   
   
  $("#inherit_staff").click(function(){
       
    var main_staff_id= $("#staff_id_inherit").val();
    var from_staff = $("#staff_from").val();
    
     var mode= $(".change_permission_popup").attr('mode');
    
    
    if(from_staff!=''){
        
                    var data = "set_staff=staff_inherit&from="+from_staff+"&to="+main_staff_id+"&mode="+mode; 
   
                    $.ajax({
                    url: "load_permission.php", 
                    type: "POST",
                    async: true,
                    cache: false,
                    data: data, 
                    success: function(data){ 
                        
                       
                       $('.alert_error_popup_all_in_one').show();
                         
                       if(mode=='Staff_Permission'){
                           
                          $('.alert_error_popup_all_in_one').text('Staff Permissions Inherited');
                          
                       }else{
                           
                           $('.alert_error_popup_all_in_one').text('User Permissions Inherited');
                       }
                       
                        $('.alert_error_popup_all_in_one').delay(1000).fadeOut('slow');
                        
                        setInterval(function () {
                           location.reload();
                        }, 1000);
                       
                       
                    }
                });
                
            }else{
                        $('.alert_error_popup_all_in_one').show();
                        $('.alert_error_popup_all_in_one').text('Select User');
                        $('.alert_error_popup_all_in_one').delay(1000).fadeOut('slow');
              
            }
            
            
   
    });
    
    
    
     $(".inherit_btn_click1").click(function(){
         
        $(".change_permission_overlay").show();
        $(".change_permission_popup1").show();
        
        
         var staff= $("#staff_id_inherit").val(); 
       
        var data = "set=load_inherit&staff="+staff+"&mode=app"; 
  
                    $.ajax({
                    url: "load_permission.php", 
                    type: "POST",
                    async: true,
                    cache: false,
                    data: data, 
                    success: function(data){ 
                        
                        $('#staff_from1').val($.trim(data));
                        
                    }
                });
        
        
    });
    
    
    $("#canc1").click(function(){
        $(".change_permission_overlay").hide();
        $(".change_permission_popup1").hide();
    });
   
   
   
  $("#inherit_staff1").click(function(){
       
    var main_staff_id= $("#staff_id_inherit").val();
    var from_staff = $("#staff_from1").val();
    if(from_staff!=''){
    var data = "set_staff_app=staff_inherit_app&from="+from_staff+"&to="+main_staff_id; 
   
                $.ajax({
                    url: "load_permission.php", 
                    type: "POST",
                    async: true,
                    cache: false,
                    data: data, 
                    success: function(data){ 
                        
                       
                        $('.alert_error_popup_all_in_one').show();
                        $('.alert_error_popup_all_in_one').text('App Permissions Inherited');
                        $('.alert_error_popup_all_in_one').delay(1000).fadeOut('slow');
                        
              setInterval(function () {
                   location.reload();
              }, 500);
                       
                }
                });
                
            }else{
                $('.alert_error_popup_all_in_one').show();
                                    
                        $('.alert_error_popup_all_in_one').text('Select App User');
                        $('.alert_error_popup_all_in_one').delay(1000).fadeOut('slow');
               
            }
   
    });
    
    
    
    
    function returntostaff(id){
        
      window.location='staff_master.php?staff_id='+id;
    }
    
    function general_enable_all(st){
        
          var check = confirm("CHANGE GENERAL PERMISSIONS ?");
	if(check==true)
	{
    
       if($(".general_enable_all").prop('checked') == true){
            var chk='yes';
        }else{
             var chk='no';
        }
        
                var dataString2 = 'set=set_all_general_permission&staff='+st+'&chk='+chk;
		//alert(dataString2);	
                            $.ajax({
				type: "POST",
				url: "load_index.php",
				data: dataString2,
				success: function(data2) {
                     
                     window.location.href='permissions.php?id='+st;
                          
                 }
            });
    
    
    
          }else{
              location.reload();
         }
        
        
    }
    
    
    
    
    function app_enable_all(st){
        
        var check = confirm("CHANGE APP PERMISSIONS ?");
	if(check==true)
	{
    
       if($(".app_enable_all").prop('checked') == true){
            var chk='yes';
        }else{
             var chk='no';
        }
        
                var dataString2 = 'set=set_all_app_permission&staff='+st+'&chk='+chk;
		//alert(dataString2);	
                            $.ajax({
				type: "POST",
				url: "load_index.php",
				data: dataString2,
				success: function(data2) {
                     
                     window.location.href='permissions.php?id='+st;
                          
                 }
            });
    
    
    
          }else{
              location.reload();
         }
    
    }
    
    
    
    function all_inv_permission(st){
        
        var check = confirm("CHANGE INVENTORY SETTINGS ?");
	if(check==true)
	{
    
       if($("#inv_check_all").prop('checked') == true){
            var chk='yes';
        }else{
             var chk='no';
        }
        
                var dataString2 = 'set=set_inv_permission&staff='+st+'&chk='+chk;
			
                            $.ajax({
				type: "POST",
				url: "load_index.php",
				data: dataString2,
				success: function(data2) {
                     
                     window.location.href='permissions.php?id='+st;
                          
                 }
    });
    
    
    
          }else{
              location.reload();
         }
    
    }
    
    
    function no_sync(){
        
       
                var dataString2 = 'set=no_sync_app';
			
                            $.ajax({
				type: "POST",
				url: "load_index.php",
				data: dataString2,
				success: function(data2) {
                     
                    $('.alert_error_popup_all_in_one').show();
                                    
                        $('.alert_error_popup_all_in_one').text('NO DATA SYNC FROM LOCAL POS TO MOBILE APP ');
                        $('.alert_error_popup_all_in_one').delay(1000).fadeOut('slow');
                        
                          
                 }
                });
    
    }
</script>

</body>
</html>