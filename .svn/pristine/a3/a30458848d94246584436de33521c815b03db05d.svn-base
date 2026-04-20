<?php
//include('includes/session.php');		// Check session
session_start();
error_reporting(0);
include("database.class.php"); // DB Connection class
$database	= new Database();
require_once 'excel_reader.php'; 
require_once 'Classes/PHPExcel/IOFactory.php';
$_SESSION['pagid']=4;

 $localhost1=mysqli_connect(HOST_NAME_CLOUD, USER_NAME_CLOUD, PASSWORD_CLOUD,DATABASE_NAME_QR);
 
 
 
 if(isset($_REQUEST['value'])&&($_REQUEST['value']=="unsync_all_data_local")){
      
 $querylang1=$database->mysqlQuery("update tbl_takeaway_billmaster set cloud_sync='N' where cloud_sync='Y' ");
 $querylang1=$database->mysqlQuery("update tbl_takeaway_billdetails set cloud_sync='N' where cloud_sync='Y' ");
 $querylang1=$database->mysqlQuery("update tbl_takeaway_bill_extra_tax_details set cloud_sync='N' where cloud_sync='Y' ");
 $querylang1=$database->mysqlQuery("update tbl_takeaway_bill_extra_tax_master set cloud_sync='N' where cloud_sync='Y' ");
 $querylang1=$database->mysqlQuery("update tbl_tablebillmaster set cloud_sync='N' where cloud_sync='Y' ");
 $querylang1=$database->mysqlQuery("update tbl_tablebilldetails set cloud_sync='N' where cloud_sync='Y' ");
 $querylang1=$database->mysqlQuery("update tbl_tablebill_extra_tax_details set cloud_sync='N' where cloud_sync='Y' ");
 $querylang1=$database->mysqlQuery("update tbl_tablebill_extra_tax_master set cloud_sync='N' where cloud_sync='Y' ");   
 $querylang1=$database->mysqlQuery("update tbl_tableorder set cloud_sync='N' where cloud_sync='Y' ");   
      
      
 $querylang1=$database->mysqlQuery(" update tbl_appmachinedetails set cloud_sync='N' where cloud_sync='Y' ");
 $querylang1=$database->mysqlQuery(" update tbl_credit_details set cloud_sync='N' where cloud_sync='Y' ");
 $querylang1=$database->mysqlQuery("update tbl_accounthead set cloud_sync='N' where cloud_sync='Y' ");
 $querylang1=$database->mysqlQuery("update tbl_bankmaster set cloud_sync='N' where cloud_sync='Y' ");
 $querylang1=$database->mysqlQuery("update tbl_base_unit_master set cloud_sync='N' where cloud_sync='Y' ");
 $querylang1=$database->mysqlQuery("update tbl_bankmaster set cloud_sync='N' where cloud_sync='Y' ");
 $querylang1=$database->mysqlQuery("update tbl_bill_card_payments set cloud_sync='N' where cloud_sync='Y' ");
 $querylang1=$database->mysqlQuery("update tbl_bankmaster set cloud_sync='N' where cloud_sync='Y' ");
 
 $querylang1=$database->mysqlQuery("update tbl_cancellation_reasons set cloud_sync='N' where cloud_sync='Y' ");
 $querylang1=$database->mysqlQuery("update tbl_cardmaster set cloud_sync='N' where cloud_sync='Y' ");
 $querylang1=$database->mysqlQuery("update tbl_combo_bill_details set cloud_sync='N' where cloud_sync='Y' ");
 $querylang1=$database->mysqlQuery("update tbl_combo_bill_details_ta set cloud_sync='N' where cloud_sync='Y' ");
 $querylang1=$database->mysqlQuery("update tbl_combo_stock set cloud_sync='N' where cloud_sync='Y' ");
 $querylang1=$database->mysqlQuery("update tbl_complementory_reasons set cloud_sync='N' where cloud_sync='Y' ");
 $querylang1=$database->mysqlQuery("update tbl_corporatemaster set cloud_sync='N' where cloud_sync='Y' ");
 $querylang1=$database->mysqlQuery("update tbl_couponcompany set cloud_sync='N' where cloud_sync='Y' ");
 $querylang1=$database->mysqlQuery("update tbl_credit_details set cloud_sync='N' where cloud_sync='Y' ");
 $querylang1=$database->mysqlQuery("update tbl_credit_details_payment set cloud_sync='N' where cloud_sync='Y' ");
 $querylang1=$database->mysqlQuery("update tbl_credit_master set cloud_sync='N' where cloud_sync='Y' ");
 $querylang1=$database->mysqlQuery("update tbl_credit_types set cloud_sync='N' where cloud_sync='Y' ");
 $querylang1=$database->mysqlQuery("update tbl_currency_conv_rate set cloud_sync='N' where cloud_sync='Y' ");
 $querylang1=$database->mysqlQuery("update tbl_currency_master set cloud_sync='N' where cloud_sync='Y' ");
 $querylang1=$database->mysqlQuery("update tbl_dayclose set cloud_sync='N' where cloud_sync='Y' ");
 $querylang1=$database->mysqlQuery("update tbl_delivery_status set cloud_sync='N' where cloud_sync='Y' ");
 $querylang1=$database->mysqlQuery("update tbl_denomination_master set cloud_sync='N' where cloud_sync='Y' ");
 $querylang1=$database->mysqlQuery("update tbl_departmentmaster set cloud_sync='N' where cloud_sync='Y' ");
 $querylang1=$database->mysqlQuery("update tbl_designationmaster set cloud_sync='N' where cloud_sync='Y' ");
 $querylang1=$database->mysqlQuery("update tbl_discountmaster set cloud_sync='N' where cloud_sync='Y' ");
 $querylang1=$database->mysqlQuery("update tbl_expodine_machines set cloud_sync='N' where cloud_sync='Y' ");
 $querylang1=$database->mysqlQuery("update tbl_extra_tax_master set cloud_sync='N' where cloud_sync='Y' ");
 $querylang1=$database->mysqlQuery("update tbl_feedbackmaster set cloud_sync='N' where cloud_sync='Y' ");
 $querylang1=$database->mysqlQuery("update tbl_feedbackrating set cloud_sync='N' where cloud_sync='Y' ");
 $querylang1=$database->mysqlQuery("update tbl_feedbackratingcount set cloud_sync='N' where cloud_sync='Y' ");
 $querylang1=$database->mysqlQuery("update tbl_floor_tax set cloud_sync='N' where cloud_sync='Y' ");
 $querylang1=$database->mysqlQuery("update tbl_floormaster set cloud_sync='N' where cloud_sync='Y' ");
 $querylang1=$database->mysqlQuery("update tbl_function_details set cloud_sync='N' where cloud_sync='Y' ");
 $querylang1=$database->mysqlQuery("update tbl_function_details_menu set cloud_sync='N' where cloud_sync='Y' ");
 $querylang1=$database->mysqlQuery("update tbl_function_extra_costs set cloud_sync='N' where cloud_sync='Y' ");
 $querylang1=$database->mysqlQuery("update tbl_function_invoice set cloud_sync='N' where cloud_sync='Y' ");
 $querylang1=$database->mysqlQuery("update tbl_function_invoice_extras set cloud_sync='N' where cloud_sync='Y' ");
 $querylang1=$database->mysqlQuery("update tbl_function_type set cloud_sync='N' where cloud_sync='Y' ");
 $querylang1=$database->mysqlQuery("update tbl_function_venue set cloud_sync='N' where cloud_sync='Y' ");
 $querylang1=$database->mysqlQuery("update tbl_ingredientmaster set cloud_sync='N' where cloud_sync='Y' ");
 $querylang1=$database->mysqlQuery("update tbl_kot_cancellation set cloud_sync='N' where cloud_sync='Y' ");
 $querylang1=$database->mysqlQuery("update tbl_kotcountermaster set cloud_sync='N' where cloud_sync='Y' ");
 $querylang1=$database->mysqlQuery("update tbl_kotmaster set cloud_sync='N' where cloud_sync='Y' ");
 $querylang1=$database->mysqlQuery("update tbl_logindetails  set cloud_sync='N' where cloud_sync='Y' ");
 $querylang1=$database->mysqlQuery("update tbl_loyalty_campaign set cloud_sync='N' where cloud_sync='Y' ");
 $querylang1=$database->mysqlQuery("update tbl_loyalty_discount set cloud_sync='N' where cloud_sync='Y' ");
 $querylang1=$database->mysqlQuery("update tbl_loyalty_levels set cloud_sync='N' where cloud_sync='Y' ");
 $querylang1=$database->mysqlQuery("update tbl_loyalty_point_transfers set cloud_sync='N' where cloud_sync='Y' ");
 $querylang1=$database->mysqlQuery("update tbl_loyalty_pointadd_bill  set cloud_sync='N' where cloud_sync='Y' ");
 $querylang1=$database->mysqlQuery("update tbl_loyalty_pointrule set cloud_sync='N' where cloud_sync='Y' ");
 $querylang1=$database->mysqlQuery("update tbl_loyalty_redeem_rule set cloud_sync='N' where cloud_sync='Y' ");
 $querylang1=$database->mysqlQuery("update tbl_loyalty_reg set cloud_sync='N' where cloud_sync='Y' ");
 $querylang1=$database->mysqlQuery("update tbl_loyalty_rules set cloud_sync='N' where cloud_sync='Y' ");
 $querylang1=$database->mysqlQuery("update tbl_loyalty_rules_type set cloud_sync='N' where cloud_sync='Y' ");
 $querylang1=$database->mysqlQuery("update tbl_loyalty_sendto set cloud_sync='N' where cloud_sync='Y' ");
 $querylang1=$database->mysqlQuery("update tbl_loyalty_sms_source set cloud_sync='N' where cloud_sync='Y' ");
 $querylang1=$database->mysqlQuery("update tbl_loyalty_voucher set cloud_sync='N' where cloud_sync='Y' ");
 $querylang1=$database->mysqlQuery("update tbl_menu_addons set cloud_sync='N' where cloud_sync='Y' ");
 $querylang1=$database->mysqlQuery("update tbl_menu_discount set cloud_sync='N' where cloud_sync='Y' ");
 $querylang1=$database->mysqlQuery("update tbl_menu_tax_master set cloud_sync='N' where cloud_sync='Y' ");
 $querylang1=$database->mysqlQuery("update tbl_menumaincategory set cloud_sync='N' where cloud_sync='Y' ");
 $querylang1=$database->mysqlQuery("update tbl_menumaster set cloud_sync='N' where cloud_sync='Y' ");
 $querylang1=$database->mysqlQuery("update tbl_menurate_counter set cloud_sync='N' where cloud_sync='Y' ");
 $querylang1=$database->mysqlQuery("update tbl_menurate_roomservice set cloud_sync='N' where cloud_sync='Y' ");
 $querylang1=$database->mysqlQuery("update tbl_menuratemaster set cloud_sync='N' where cloud_sync='Y' ");
 $querylang1=$database->mysqlQuery("update tbl_menuratetakeaway set cloud_sync='N' where cloud_sync='Y' ");
 $querylang1=$database->mysqlQuery("update tbl_menustock set cloud_sync='N' where cloud_sync='Y' ");
 $querylang1=$database->mysqlQuery("update tbl_menusubcategory set cloud_sync='N' where cloud_sync='Y' ");
 $querylang1=$database->mysqlQuery("update tbl_online_billdetails set cloud_sync='N' where cloud_sync='Y' ");
 $querylang1=$database->mysqlQuery("update tbl_online_billmaster set cloud_sync='N' where cloud_sync='Y' ");
 $querylang1=$database->mysqlQuery("update tbl_order_addon set cloud_sync='N' where cloud_sync='Y' ");
 $querylang1=$database->mysqlQuery("update tbl_order_addon_changes set cloud_sync='N' where cloud_sync='Y' ");
 $querylang1=$database->mysqlQuery("update tbl_paymentmode  set cloud_sync='N' where cloud_sync='Y' ");
 $querylang1=$database->mysqlQuery("update tbl_portionmaster set cloud_sync='N' where cloud_sync='Y' ");
 $querylang1=$database->mysqlQuery("update tbl_preferencemaster set  cloud_sync='N' where cloud_sync='Y' ");
 $querylang1=$database->mysqlQuery("update tbl_regenerate_reasons set cloud_sync='N' where cloud_sync='Y' ");
 $querylang1=$database->mysqlQuery("update tbl_regenrate_log set cloud_sync='N' where cloud_sync='Y' ");
 $querylang1=$database->mysqlQuery("update tbl_roommaster set cloud_sync='N' where cloud_sync='Y' ");
 $querylang1=$database->mysqlQuery("update tbl_shift_close_denomination set cloud_sync='N' where cloud_sync='Y' ");
 $querylang1=$database->mysqlQuery("update tbl_shift_details set cloud_sync='N' where cloud_sync='Y' ");
 $querylang1=$database->mysqlQuery("update tbl_shift_open_denomination set cloud_sync='N' where cloud_sync='Y' ");
 $querylang1=$database->mysqlQuery("update tbl_staffmaster set cloud_sync='N' where cloud_sync='Y' ");
 $querylang1=$database->mysqlQuery("update tbl_tablebill_paymentchange set cloud_sync='N' where cloud_sync='Y' ");
 $querylang1=$database->mysqlQuery("update tbl_tablemaster set cloud_sync='N' where cloud_sync='Y' ");
 $querylang1=$database->mysqlQuery("update tbl_tableorder set cloud_sync='N' where cloud_sync='Y' ");
 $querylang1=$database->mysqlQuery("update tbl_tableorder_changes set cloud_sync='N' where cloud_sync='Y' ");
 $querylang1=$database->mysqlQuery("update tbl_takeaway_cancel_items set cloud_sync='N' where cloud_sync='Y' ");
 $querylang1=$database->mysqlQuery("update tbl_takeaway_customer set cloud_sync='N' where cloud_sync='Y' ");
 $querylang1=$database->mysqlQuery("update tbl_unit_master set cloud_sync='N' where cloud_sync='Y' ");
 $querylang1=$database->mysqlQuery("update tbl_unit_master_combination set cloud_sync='N' where cloud_sync='Y' ");
 $querylang1=$database->mysqlQuery("update tbl_version set cloud_sync='N' where cloud_sync='Y' ");
 $querylang1=$database->mysqlQuery("update tbl_version_log set cloud_sync='N' where cloud_sync='Y' ");
 $querylang1=$database->mysqlQuery("update tbl_voucherhead set cloud_sync='N' where cloud_sync='Y' ");
 $querylang1=$database->mysqlQuery("update tbl_voucherpayment set cloud_sync='N' where cloud_sync='Y' ");
 $querylang1=$database->mysqlQuery("update tbl_combo_menu_labels set cloud_sync='N' where cloud_sync='Y' ");
 $querylang1=$database->mysqlQuery("update tbl_combo_name set cloud_sync='N' where cloud_sync='Y' ");
 
 
 $querylang1=$database->mysqlQuery("update tbl_combo_ordering_details set cloud_sync='N' where cloud_sync='Y' ");
 $querylang1=$database->mysqlQuery("update tbl_combo_packs set cloud_sync='N' where cloud_sync='Y' ");
 $querylang1=$database->mysqlQuery("update tbl_combo_pack_menus set cloud_sync='N' where cloud_sync='Y' ");
 $querylang1=$database->mysqlQuery("update tbl_combo_pack_rates set cloud_sync='N' where cloud_sync='Y' ");
 $querylang1=$database->mysqlQuery("update tbl_combo_type set cloud_sync='N' where cloud_sync='Y' ");
 $querylang1=$database->mysqlQuery("update tbl_departmentmaster set cloud_sync='N' where cloud_sync='Y' ");
 $querylang1=$database->mysqlQuery("update tbl_denomination_master set cloud_sync='N' where cloud_sync='Y' ");
 $querylang1=$database->mysqlQuery("update tbl_login_restrict_logs set cloud_sync='N' where cloud_sync='Y' ");
 $querylang1=$database->mysqlQuery("update tbl_loyalty_campaign_group set cloud_sync='N' where cloud_sync='Y' ");
 $querylang1=$database->mysqlQuery("update tbl_loyalty_group_details set cloud_sync='N' where cloud_sync='Y' ");
 $querylang1=$database->mysqlQuery("update tbl_menuratetakeaway set cloud_sync='N' where cloud_sync='Y' ");
 $querylang1=$database->mysqlQuery("update tbl_shift_card_detail_close set cloud_sync='N' where cloud_sync='Y' ");
 $querylang1=$database->mysqlQuery("update tbl_shift_card_detail_open set cloud_sync='N' where cloud_sync='Y' ");
 $querylang1=$database->mysqlQuery("update tbl_tablebill_split set cloud_sync='N' where cloud_sync='Y' ");
 $querylang1=$database->mysqlQuery("update tbl_online_order set cloud_sync='N' where cloud_sync='Y' ");
 $querylang1=$database->mysqlQuery("update tbl_expense_voucher set cloud_sync='N' where cloud_sync='Y' ");
 $querylang1=$database->mysqlQuery("update tbl_supplier_voucher set cloud_sync='N' where cloud_sync='Y' ");
 $querylang1=$database->mysqlQuery("update tbl_employee_voucher set cloud_sync='N' where cloud_sync='Y' ");
 $querylang1=$database->mysqlQuery("update tbl_ledger_master set cloud_sync='N' where cloud_sync='Y' ");
       
     $sql_login  =  $database->mysqlQuery("update tbl_requisition set cloud_sync='N' where cloud_sync='Y' ");
     $sql_login  =  $database->mysqlQuery("update tbl_purchase_order set cloud_sync='N' where cloud_sync='Y'");
     $sql_login  =  $database->mysqlQuery("update tbl_grn_order set cloud_sync='N' where cloud_sync='Y'");
     $sql_login  =  $database->mysqlQuery("update tbl_store_stock set cloud_sync='N' where cloud_sync='Y'");
     $sql_login  =  $database->mysqlQuery("update tbl_store_transfer set cloud_sync='N' where cloud_sync='Y'");
     $sql_login  =  $database->mysqlQuery("update tbl_physical_stock set cloud_sync='N' where cloud_sync='Y'");
     $sql_login  =  $database->mysqlQuery("update tbl_purchase_return set cloud_sync='N' where cloud_sync='Y'");
     $sql_login  =  $database->mysqlQuery("update tbl_grn_summary set cloud_sync='N' where cloud_sync='Y'");
     $sql_login  =  $database->mysqlQuery("update tbl_consumption set cloud_sync='N' where cloud_sync='Y'");
     $sql_login  =  $database->mysqlQuery("update tbl_inv_settings set cloud_sync='N' where cloud_sync='Y'");
     $sql_login  =  $database->mysqlQuery("update tbl_stock_details set cloud_sync='N' where cloud_sync='Y'");
     $sql_login  =  $database->mysqlQuery("update tbl_wastage set cloud_sync='N' where cloud_sync='Y'");
     $sql_login  =  $database->mysqlQuery("update tbl_production set cloud_sync='N' where cloud_sync='Y'");
     $sql_login  =  $database->mysqlQuery("update tbl_menu_ingredient_detail set cloud_sync='N' where cloud_sync='Y'"); 
     $sql_login  =  $database->mysqlQuery("update tbl_product_conversion set cloud_sync='N' where cloud_sync='Y'");   
       
  }
 

    if(isset($_REQUEST['value'])&&($_REQUEST['value']=="table_add")){
    
       if($_REQUEST['sts']=='N'){
             $querylang1=$database->mysqlQuery("update tbl_br_cloud_tables set status='Y' where table_name='".$_REQUEST['tbl']."' "); 
            
       }else{
           
           $querylang1=$database->mysqlQuery("update tbl_br_cloud_tables set status='N' where table_name='".$_REQUEST['tbl']."' ");  
        
       }        
    }
    
      
    if(isset($_REQUEST['value'])&&($_REQUEST['value']=="table_add_bymode")){
    
       
       if($_REQUEST['mode']=='Sync'){
             $querylang1=$database->mysqlQuery("update tbl_br_cloud_tables set status='Y' where table_name!='tbl_br_cloud_tables' and table_name!='tbl_version' and table_name!='tbl_version_log' "); 
            
       }else{
           $querylang1=$database->mysqlQuery("update tbl_br_cloud_tables set status='N'  ");  
           
       }
             
             
    }
    
     $qr_branch='';

            $sql_login_dc  =  $database->mysqlQuery("select bsc_cloud_branchid from  tbl_branch_settings_cloud  "); 
            $num_cat_s_dc  = $database->mysqlNumRows($sql_login_dc);
            if($num_cat_s_dc){
             while($result_cat_s_tc  = $database->mysqlFetchArray($sql_login_dc)) 
               {

                         $qr_branch=$result_cat_s_tc['bsc_cloud_branchid'];

             }
            }

?>

<!doctype html>
<html ng-app="website">
<head>
<meta charset="utf-8">
<title>Cloud</title>
<meta name="description" content="">
<link href="images/favicon.png" rel="shortcut icon">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
<link rel="shortcut icon" href="img/favicon.ico">
<link rel="stylesheet" href="css/default.css">
<link rel="stylesheet" href="css/default.date.css">
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
 <script src="js/jquery-1.10.2.min.js"></script>
<script src="master_style/js/modernizr.custom.js"></script>
<style>#ascrail2002{z-index: 9999999999999999999 !important;left:2px !important }
aside { width: 238px !important}
.min-nav aside {width: 60px !important;}
.ui-autocomplete{z-index:999999 !important;}
.tablesorter tbody{min-height:420px;}
.contant_table_cc{
	  height: 65vh;
  min-height:460px;
	}
.searchlist{
	width: 96% !important;background: #f2f2f2  !important; position: absolute !important;top: 55px;z-index: 9999;padding-left: 1%;max-height:350px;overflow:auto}
</style>
<style>
.new_overlay{
	 width:100%;
	 height:100%;
	 background-color:rgba(0,0,0,0.8);
	 position:fixed;
	 z-index:999;
	 height: 100%;
	 }
#left_table_scr_cc {
    width: 100%;
        min-height: 330px;
    height: 84vh;}
	.main_banquet_contant_head{background-color:#fff}
	.responstable th, .responstable td{padding:5px;}
	.main_banquet_form_name{padding-top:0}
	.main_banquet_form_textbox_input{height:33px;border: solid 1px #ccc;}
	.menut_add_bq_btn{font-size:15px;height:34px;line-height:34px;margin-top:21px}
	::-webkit-scrollbar{height:20px;}
	.bnq_dtail_table td{
	line-height:25px !important;
	font-size:14px !important;
	color:#333;
	padding:5px;
	border:solid 1px #ccc;
	text-align:center;
	min-width:inherit !important;
	}
.bnq_dtail_table th{
	line-height:25px !important;
	font-size:14px !important;
	color:#333;
	padding:5px;
	border:solid 1px #ccc;
	text-align:center;
	min-width:inherit !important;
	background-color:#000;
	color:#fff;
	border:0;
	font-family:Arial, Helvetica, sans-serif
	}
.banq_inv_right_table td{
	line-height:17px;
	font-size:13px;
	color:#333;
	padding:3px;
	border:solid 1px #ccc;
	text-align:center;
	min-width:inherit;
	}
.main_banquet_contant table td{min-height:40px !important;}
.banq_inv_right_table th{
	line-height:17px;
	font-size:13px;
	color:#333;
	padding:3px;
	border:solid 1px #ccc;
	text-align:center;
	min-width:inherit;
	background-color: #b25c03;
	color:#fff;
	border:0;
	}
	.main_banquet_contant_left_main .main_banquet_form_box{margin-bottom:15px;}
	.main_banquet_form_box{margin-bottom:7px}
	.als-item a{padding: 0 10px;}
        .disablegenerate
        {
            pointer-events: none;
            opacity: 0.4;
            cursor:none;

        }
        .als-wrapper{
         overflow-y: hidden;
         margin: 0px auto;
        height: 50px;
        white-space: nowrap;
        }
        #lista1 .als-item{    display: inline-block;float: none; height: 30px;}
        .als-wrapper::-webkit-scrollbar {
            height: 14px;
        }
        .als-container{border-bottom: 3px solid #191919 !important;}

.Switcher {
  position: relative;
  display: flex;
  border-radius: 5em;
  box-shadow: inset 0 0 0 1px;
  overflow: hidden;
  cursor: pointer;
  -webkit-animation: r-n .5s;
          animation: r-n .5s;
  -webkit-user-select: none;
     -moz-user-select: none;
      -ms-user-select: none;
          user-select: none;
  font-size: 3vmin;
  will-change: transform;
}
.Switcher__checkbox:checked + .Switcher {
  -webkit-animation-name: r-p;
          animation-name: r-p;
}
@-webkit-keyframes r-p {
  50% {
    -webkit-transform: rotateY(45deg);
            transform: rotateY(45deg);
  }
}
@keyframes r-p {
  50% {
    -webkit-transform: rotateY(45deg);
            transform: rotateY(45deg);
  }
}
@-webkit-keyframes r-n {
  50% {
    -webkit-transform: rotateY(-45deg);
            transform: rotateY(-45deg);
  }
}
@keyframes r-n {
  50% {
    -webkit-transform: rotateY(-45deg);
            transform: rotateY(-45deg);
  }
}
.Switcher::before {
  content: '';
  position: absolute;
  top: 0;
  left: 0;
  bottom: 0;
  width: 200%;
  border-radius: inherit;
  -webkit-transform: translateX(-75%);
          transform: translateX(-75%);
  transition: -webkit-transform .5s ease-in-out;
  transition: transform .5s ease-in-out;
  transition: transform .5s ease-in-out, -webkit-transform .5s ease-in-out;
}
.Switcher__checkbox:checked + .Switcher::before {
  -webkit-transform: translateX(25%);
          transform: translateX(25%);
}

.Switcher__trigger {
  position: relative;
  z-index: 1;
    font-size: 16px;
  padding: 15px 50px;
  background-color: #fff;
  color: #333;
}
.Switcher__trigger::after {
  content: attr(data-value);
}
.Switcher__trigger::before { 
  content: attr(data-value);
  position: absolute;

  transition: opacity .3s;

  
}
.Switcher__checkbox:checked + .Switcher .Switcher__trigger::before {
 
}
.Switcher__trigger:nth-of-type(1)::before {
 
}
.Switcher__trigger:nth-of-type(2)::before {
 
}

.sr-only {
  position: absolute;
  width: 1px;
  height: 1px;
  padding: 0;
  margin: -1px;
  overflow: hidden;
  clip: rect(0, 0, 0, 0);
  border: 0;
}

.box {
  display: flex;
  flex: 1;
  justify-content: center;
  align-items: center;
  flex-wrap: wrap;
  overflow: hidden;
  -webkit-perspective: 750px;
          perspective: 750px;
}

*,
*::before,
*::after {
  box-sizing: border-box;
}

html {
  height: 100%;
}

body {
  display: flex;
  flex-direction: column;
  min-height: 100%;
  margin: 0;
  line-height: 1.4;
  color: #fff;
  background-color: #00a8ff;
}

.intro {
  width: 90%;
  max-width: 50rem;
  padding-top: .5em;
  padding-bottom: 1rem;
  margin: 0 auto 1em;
  font-size: calc(1rem + 2vmin);
  text-transform: capitalize;
  text-align: center;
  font-family: serif;
}
.intro small {
  display: block;
  text-align: right;
  opacity: .5;
  font-style: italic;
  text-transform: none;
  border-top: 1px dashed rgba(255, 255, 255, 0.75);
}

.info {
  margin: 0;
  padding: 1em;
  font-size: .9em;
  font-style: italic;
  font-family: serif;
  text-align: right;
  opacity: .75;
}
.info a {
  color: inherit;
}
    .top_timely_contant_sec input {
    display: none;
}
    .printer_add_text_boxes_cc input:focus ~ label, input:valid ~ label{top: 0;    color: #8a8a8a;}
    .act_tml_clr{   background-color: #890000;  color: #fff;}
   
</style>

 <style>
    .alert_error_popup_all_in_one{
	width: 280px;
	height: 85px;
	position: fixed;
	right: 0px;
        left:0px;
	bottom: 0px;
        top:0px;
        margin: auto;
        
	background-color: #ff0000;
	text-align: center;
	padding: 20px 40px;
	padding-top: 20px;
	z-index: 99999;
	color: #fff;
	font-size: 12px;;
	border-radius: 5px;
	font-family: sans-serif;
}
.alert_error_popup_all_in_one:before{
    width: 100%;
    height: 100%;
    position: fixed;
    left: 0px;
    top: 0px;
    background-color: rgb(0,0,0,0.4);
    content: '';
    z-index: -2;
}
</style>


</head>
<body>
  <strong id="alert_error_popup_all_in_one" class="alert_error_popup_all_in_one" style="display: block"> CONNECTING TO LIVE CLOUD SERVER FOR FETCHING DATA</strong>  
    
<div class="olddiv "></div> 
<div id="blr" class="container nopaddding">
 <?php//  include "includes/topbar_master.php"; ?>
 <?php //include "includes/left_menu.php"; ?>
<div class="mian">
	<div class="view-container">
		<div  id="container" style=" left: -7px;top: 63px;width: auto;top: -8px !important;">
			<div class="breadcrumbs">
				<ul>
					<li><a href="index.php" style="cursor:pointer"><i class="ti-home"></i></a>/</li>
					<li><a style="cursor:pointer"> </a></li>
            		
				</ul>
			</div><!-- breadcrumbs -->
                <div class="content-sec">
                
                	<div class="mlt_language_contant_cc">
                    
                    	<div style="  border: 1px #B6B6B6 solid;" class="cc_new">
                       	<div id="lista1" class="als-container">
                            <div class="als-viewport" style="width:120% !important">
                                
                                <ul class="als-wrapper">
                                      
                                    <li class="als-item"><a   style="border-radius: 10px;background-color: darkred " href="troubleshoot.php" class="new_tab_btn"> Back </a></li>
                                 
                                    
                                    <a style="cursor: pointer;font-weight: bold;color: green;border:solid 1px;padding: 5px; top:6px; left:120px; position: absolute;border-radius: 5px" value="" onclick="tables_active('Sync')" > Check All </a>  <br>
                                
                                    <a style="cursor: pointer;font-weight: bold;color: red;border: solid 1px;padding: 5px; top:6px; left: 215px; position:absolute;border-radius: 5px" type="checkbox" value="" onclick="tables_active('Unsync')" > Uncheck All  </a> 
                                    
                                    <a onclick="unsync_all_data_local()"  style="cursor: pointer;font-weight: bold;color: #207a9d;border: solid 1px;padding: 5px; top:6px; left: 325px; position:absolute;border-radius: 5px" > Unsync Local DB </a> 
                                 
                                    <a style="cursor: pointer;font-weight: bold;color: #a51212;border: solid 1px;padding: 5px; top:6px; left: 457px; position:absolute;border-radius: 5px;font-size: 10px" type="checkbox" > Note : Table names marked in red color should be synced as mandatory  </a> 
                                    
                                    <a style="cursor: pointer;font-weight: bold;color: #a51212;border: solid 1px;padding: 5px; top:6px; left: 771px; position:absolute;border-radius: 5px;font-size: 10px" type="checkbox" >BRANCH ID : <?=$qr_branch?>  </a> 
                                    
                                    <a style="cursor: pointer;font-weight: bold;color:  #207a9d;border: solid 1px;padding: 5px; top:6px; left: 900px; position:absolute;border-radius: 5px;" type="checkbox"  type="checkbox" href="http://localhost:8021/Dropbox/expodine_service/api/cloud_sync" target="_blank"> Cloud Sync</a> 
                                    
                                </ul>
             
                              </div>
                        </div>
                   </div>
                         
                        	<div class="main_banquet_contant" style="padding-top:0">
                            		<div id="left_table_scr_cc">
                                    
                                        <div class="top_timely_toggle_sec">
                                            <div class="box">
                                                
<!--                                              <input class="Switcher__checkbox sr-only" id="io" type="checkbox" />-->
                                              <label class="Switcher" for="io">
                                                 
                                              </label>
                                            </div>
                                        </div>
                                        
                                        <div class="top_timely_contant_sec_cc">
                                            <span style="width:100%;height: auto;left:0;    position: absolute;"><strong style="color:darkred;width: 100%;font-size: 15px;" id="show_msg"></strong></span>
                                          
                                            <div id="time_view" class="top_timely_contant_sec" style="display:block;margin-top: -50px;margin-left: 7%;">
                                                
                                                <div class="timely_selct_box_cc" >
                                                    
                                                <?php
                                                  
                                                
                        $time_in=  array();    $sts=array();                     
                       $sql_sms_show1  =  $database->mysqlQuery("select * from tbl_br_cloud_tables order by id  "); 
                    $num_sms_show1  = $database->mysqlNumRows($sql_sms_show1);
                    if($num_sms_show1){
                        while($result_sms_show1  = $database->mysqlFetchArray($sql_sms_show1)) 
                        {
                          $time_in[]= $result_sms_show1['table_name']; 
                          $sts[]= $result_sms_show1['status']; 
                        }
                    }
                    
                     
                          $local_count=0;   $live_count=0;       
                          
                for($t=1;$t<count($time_in);$t++) {
                                         
                   $sql_sms_show1  =  $database->mysqlQuery("select count(*) as local_count from $time_in[$t] "); 
                   $num_sms_show1  = $database->mysqlNumRows($sql_sms_show1);
                    if($num_sms_show1){
                        while($result_sms_show13  = $database->mysqlFetchArray($sql_sms_show1)) 
                        {
                          $local_count= $result_sms_show13['local_count']; 
                          
                        }
                    }                   
                                                    
                      
            $qr_branch='';

            $sql_login_dc  =  $database->mysqlQuery("select bsc_cloud_branchid from  tbl_branch_settings_cloud  "); 
            $num_cat_s_dc  = $database->mysqlNumRows($sql_login_dc);
            if($num_cat_s_dc){
             while($result_cat_s_tc  = $database->mysqlFetchArray($sql_login_dc)) 
               {

                         $qr_branch=$result_cat_s_tc['bsc_cloud_branchid'];

             }
             }


                 
             
                  $sql_gen1 =  mysqli_query($localhost1,"select count(*) as live_count from $time_in[$t] where branchid='$qr_branch'   "); 
      
		  $num_gen1  = mysqli_num_rows($sql_gen1);
		  if($num_gen1)
		  {
				while($result_cat_s_tc1  = mysqli_fetch_array($sql_gen1)) 
		     {
                              $live_count= $result_cat_s_tc1['live_count']; 
                           
                           
                  } }
                                                    
                  ?> 
                                                   
                                               <div  class="timely_selct_box" <?php if($time_in[$t]!='tbl_br_cloud_tables' && $time_in[$t]!='tbl_version' && $time_in[$t]!='tbl_version_log'){ ?> style="width:250px;margin-top: 9px" <?php }else{ ?> style="width:250px;margin-top: 9px;pointer-events: none;opacity: 0.4; "  <?php } ?> >
                                                    <input id="chkt<?=$t?>" onclick="return time_in('<?=$sts[$t]?>','<?=$time_in[$t]?>');"  <?php if($sts[$t]=='Y'){ ?> checked  <?php } ?>  value="<?=$time_in[$t]?>" type="checkbox" />
                                                  
                                                    <label style="font-size:70%; font-weight: bold;text-overflow:hidden; <?php if($time_in[$t]=='tbl_menumaster' || $time_in[$t]=='tbl_menumaincategory' || $time_in[$t]=='tbl_menumaincategory' || $time_in[$t]=='tbl_menuratetakeaway' || $time_in[$t]=='tbl_menuratemaster' || $time_in[$t]=='tbl_menurate_counter' || $time_in[$t]=='tbl_online_order' || $time_in[$t]=='tbl_floormaster'  || $time_in[$t]=='tbl_portionmaster'    ){ ?> color:darkred  <?php } ?>" for="chkt<?=$t?>" >  <?=$t.'. '.$time_in[$t]?> </label>
                                                    
                                                    <label style="font-size:10px;font-weight: bold;color: black;margin-left: 12px;" > Local Rows : <?=$local_count?> | </label>
                                                    
                                                    <label style="font-size:60%;font-weight: bold;color: black" > Live Rows : <?=$live_count?></label>
                                                    
                                                    
                                                    <label style="font-size:60%;font-weight: bold;color: black" >
                                                        
                                                        <?php if($local_count==$live_count || $local_count <=$live_count ){ ?>
                                                        <img     style="width: 50%;margin-left: 110%;" src="img/check_mark.png">
                                                        <?php }else{ ?>
                                                        <img style="width: 50%;margin-left: 110%;" src="img/red_tick.png">
                                                        <?php } ?>
                                                    </label>
                                                    
                                               </div>
                                                   <?php } ?>
                                                    
                                                    
                                                    
                                                    
                <?php
                /////////////billmaster/////
                
                
                $local_count_billmaster=0;
                
                $local_count_billmaster_di=0;
                
                $live_count_billmaster=0;
                
                $local_count_billmaster_ta=0;
                
                 $sql_sms_show1  =  $database->mysqlQuery("select count(*) as local_count_di from tbl_tablebillmaster "); 
                   $num_sms_show1  = $database->mysqlNumRows($sql_sms_show1);
                    if($num_sms_show1){
                        while($result_sms_show135  = $database->mysqlFetchArray($sql_sms_show1)) 
                        {
                          $local_count_billmaster_di= $result_sms_show135['local_count_di']; 
                          
                        }
                    }        
                
                    
                     $sql_sms_show1  =  $database->mysqlQuery("select count(*) as local_count_ta from tbl_takeaway_billmaster "); 
                   $num_sms_show1  = $database->mysqlNumRows($sql_sms_show1);
                    if($num_sms_show1){
                        while($result_sms_show1356  = $database->mysqlFetchArray($sql_sms_show1)) 
                        {
                          $local_count_billmaster_ta= $result_sms_show1356['local_count_ta']; 
                          
                        }
                    }    
                
                $local_count_billmaster=$local_count_billmaster_di+$local_count_billmaster_ta;
                
                
                                                    
               $sql_gen1 =  mysqli_query($localhost1,"select count(*) as live_count_billmaster from tbl_billmaster where branchid='$qr_branch'   "); 
      
		  $num_gen1  = mysqli_num_rows($sql_gen1);
		  if($num_gen1)
		  {
				while($result_cat_s_tc12  = mysqli_fetch_array($sql_gen1)) 
		     {
                              $live_count_billmaster= $result_cat_s_tc12['live_count_billmaster']; 
                           
                           
                  } }
                  
                  
               ?>
                                                    
                                                    
                                                    <br>    <div  class="timely_selct_box" style="width:250px;margin-top: 9px;height: 50%;text-align: left;padding-left: 5px">
                                                 
                                                    <label style="font-size:90%;font-weight: bold;color: black" > Bill Master </label> <br> 
                                                    
                                                    
                                                    
                                                    <label style="font-size:80%;font-weight: bold" > Local Rows DI : <?=$local_count_billmaster_di?></label>  <br> 
                                                    
                                                     <label style="font-size:80%;font-weight: bold" > Local Rows TA : <?=$local_count_billmaster_ta?></label>  <br> 
                                                     
                                                     <label style="font-size:80%;font-weight: bold" > Total Local Rows  : <?=$local_count_billmaster?></label>  <br> 
                                                    
                                                    <label style="font-size:80%;font-weight: bold;color: darkred" > Live Rows : <?=$live_count_billmaster?></label>
                                                    
                                                      <label style="font-size:60%;font-weight: bold;color: black" >
                                                        
                                                        <?php if($local_count_billmaster==$live_count_billmaster || $local_count_billmaster <=$live_count_billmaster){ ?>
                                                        <img     style="width: 45%;margin-left: 110%;" src="img/check_mark.png">
                                                        <?php }else{ ?>
                                                        <img style="width: 45%;margin-left: 110%;" src="img/red_tick.png">
                                                        <?php } ?>
                                                    </label>
                                                    
                                                    
                                                </div>  
                                                    
                                                    
                                                 <?php
                                                 
                                                    ////////////////billdetails////// 
                  
                  
                  
                    $local_count_billdetails=0;
                
                $local_count_billdetails_di=0;
                
                $live_count_billdetails=0;
                
                $local_count_billdetails_ta=0;
                
                 $sql_sms_show1  =  $database->mysqlQuery("select count(*) as local_count_di from tbl_tablebilldetails "); 
                   $num_sms_show1  = $database->mysqlNumRows($sql_sms_show1);
                    if($num_sms_show1){
                        while($result_sms_show1359  = $database->mysqlFetchArray($sql_sms_show1)) 
                        {
                          $local_count_billdetails_di= $result_sms_show1359['local_count_di']; 
                          
                        }
                    }        
                
                  
                     $sql_sms_show1  =  $database->mysqlQuery("select count(*) as local_count_ta from tbl_takeaway_billdetails "); 
                   $num_sms_show1  = $database->mysqlNumRows($sql_sms_show1);
                    if($num_sms_show1){
                        while($result_sms_show13567  = $database->mysqlFetchArray($sql_sms_show1)) 
                        {
                          $local_count_billdetails_ta= $result_sms_show13567['local_count_ta']; 
                          
                        }
                    }    
                
                $local_count_billdetails=$local_count_billdetails_di+$local_count_billdetails_ta;
                
                
                                                    
               $sql_gen1 =  mysqli_query($localhost1,"select count(*) as live_count_billdetail from tbl_billdetails where branchid='$qr_branch'   "); 
      
		  $num_gen1  = mysqli_num_rows($sql_gen1);
		  if($num_gen1)
		  {
				while($result_cat_s_tc125  = mysqli_fetch_array($sql_gen1)) 
		     {
                              $live_count_billdetails= $result_cat_s_tc125['live_count_billdetail']; 
                           
                           
                  } }
                  
                  
                  
                  
                                                    
                  ?> 
                                             
                                                 <br>  <div  class="timely_selct_box" style="width:250px;margin-top: 9px;height: 50%;text-align: left;padding-left: 5px">
                                                 
                                                  <label style="font-size:90%;font-weight: bold;color: black"> Bill Details </label> <br> 
                                                  
                                                   <label style="font-size:80%;font-weight: bold" > Local Rows DI : <?=$local_count_billdetails_di?></label> <br> 
                                                   
                                                    <label style="font-size:80%;font-weight: bold" > Local Rows TA : <?=$local_count_billdetails_ta?></label> <br> 
                                                   
                                                    <label style="font-size:80%;font-weight: bold" > Total Local Rows : <?=$local_count_billdetails?></label> <br> 
                                                    
                                                    <label style="font-size:80%;font-weight: bold;color: darkred" > Live Rows : <?=$live_count_billdetails?></label>
                                                    
                                                     <label style="font-size:60%;font-weight: bold;color: black" >
                                                        
                                                        <?php if($local_count_billdetails==$live_count_billdetails || $local_count_billdetails<=$live_count_billdetails){ ?>
                                                        <img     style="width: 45%;margin-left: 110%;" src="img/check_mark.png">
                                                        <?php }else{ ?>
                                                        <img style="width: 45%;margin-left: 110%;" src="img/red_tick.png">
                                                        <?php } ?>
                                                    </label>
                                                    
                                                    
                                                </div>       
                                                    
                                                    
                                                </div>  
                                                
                                            </div>  
                                        </div> 
                                        
                                    </div>

                            </div>

                            
                        </div>
                    </div>
		</div>
	</div>
</div>
</div>



<div class="md-overlay"></div>
<script src="master_style/js/classie.js"></script>
<script src="master_style/js/modalEffects.js"></script>
<script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<script src="js/jquery.cookie.js"></script>

<script>

    
 $(document).ready(function(){
    
   $('.alert_error_popup_all_in_one').hide();                  
    
 });

function tables_active(mode){
    
     var confirm1=confirm("Confirm "+mode+" ?");
    if(confirm1===true){
                              $('.alert_error_popup_all_in_one').show();
                                    
                        $('.alert_error_popup_all_in_one').text('PLEASE WAIT');
                        
     
                     $.ajax({
			type: "POST",
			url: "cloud_br_tables.php",
			data: "value=table_add_bymode&mode="+mode,
			success: function(msg)
			{     
                             location.reload();
               
                        }
                       });
    
        }
    
    
}

    function time_in(sts,tbl){
      
  
                        $.ajax({
			type: "POST",
			url: "cloud_br_tables.php",
			data: "value=table_add&tbl="+tbl+"&sts="+sts,
			success: function(msg)
			{           
                         $("#show_msg").show();
               var error_show=$('#show_msg');
	      // error_show.text('UPDATED');	
	       $("#show_msg").delay(1000).fadeOut('slow');
               
               
               location.reload();
               
                        }
                       });
       
           
    }
    
    
    
    function unsync_all_data_local(){
         var confirm1=confirm("Confirm ?");
    if(confirm1===true){
         $('.alert_error_popup_all_in_one').show();
                                    
                        $('.alert_error_popup_all_in_one').text('CLOUD SYNC CHANGE TO NO IN ALL TABLES IN LOCAL');
                        $.ajax({
			type: "POST",
			url: "cloud_br_tables.php",
			data: "value=unsync_all_data_local",
			success: function(msg)
			{        
                            
                            $(".alert_error_popup_all_in_one").delay(1000).fadeOut('slow');
                            
                        }
                        
                       });
                       }
        
    }

</script>


</body>
</html>