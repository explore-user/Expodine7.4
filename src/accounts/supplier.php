<?php
//include('includes/session.php');		
session_start();
include("../database.class.php"); 
$database	= new Database();

?>
<!doctype html>
<html ng-app="website">
<head>
<meta charset="utf-8">
<title>Supplier</title>
<meta name="description" content="">
<link href="../images/favicon.png" rel="shortcut icon">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
<link rel="shortcut icon" href="img/favicon.ico">
<link rel="stylesheet" href="../master_style/themify-icons.css" type="text/css" /><!-- Icons -->
<link href="../css/menu_master_style.css" rel="stylesheet">
<link id="bs-css" href="../css/bootstrap-cerulean.min.css" rel="stylesheet">
<link rel="stylesheet" href="../master_style/website.css" type="text/css">
<link rel="stylesheet" href="../master_style/responsive.css" type="text/css" /><!-- Responsive -->	
<link rel="stylesheet" href="../css/normal.css" type="text/css" /><!-- Responsive -->
<link rel="stylesheet" href="../master_style/demo.css">	
<link rel="stylesheet" href="../master_style/table_style.css">	
<link rel="stylesheet" type="text/css" href="../master_style/default.css" />
<link rel="stylesheet" type="text/css" href="../master_style/component.css" />
<link rel="stylesheet" type="text/css" href="../master_style/popup/default.css" />
<link rel="stylesheet" type="text/css" href="../master_style/popup/component.css" />
<link href="../master_style/app.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" type="text/css" media="screen" href="../css/als_demo.css" />
<link rel="stylesheet" href="../css/style_date.css">
<link href="../loyalty/assets/plugins/bootstrap-datepicker/css/bootstrap-datepicker.min.css" rel="stylesheet">

 
<script src="../js/jquery-1.10.2.min.js"></script>
<script src="../master_style/js/modernizr.custom.js"></script>
<style>#ascrail2002{z-index: 9999999999999999999 !important;left:2px !important } 
.ui-autocomplete{z-index:999999 !important;}.upload_view_img{bottom: 42px;float: right;height: 66px;position: relative;}
    .table_report thead th{height:25px;}.tablesorter tbody{height: 79vh !important;}
    .alert_popup_sec_cc{width:100%;height:100%;position:absolute;left:0;background-color:rgba(0,0,0,0.5) !important;top:0;z-index:999}
    .alert_popup{width:310px;height:140px;position:absolute;left:0;right:0;top:0;bottom:0;margin:auto;background-color:#fff;border-radius:10px}
    .alert_popup_contant{width:100%;height:auto;float:left;padding:10px;color:#242424;font-size:22px;text-align:center;padding-top:30px;}
    .alert_popup_contant_btn{width:100px;height:32px;display:inline-block;margin-top:30px;background-color:#c41515;color:#fff;line-height:35px;font-size:14px;opacity:0.8}
    .alert_popup_contant_btn.yes{background-color:#0d9613;margin-left:10px}
    .alert_popup_contant_btn:hover{opacity:1}
    .row_active_vendor{background-color: lightpink}
   
</style>

<script type="text/javascript" src="../js/jquery-ui-1.8.2.custom.min.js"></script> 
<script src="../js/jquery-1.10.2.js"></script>

<style>
.new_overlay{
	 width:100%;
	 height:100%;
	 background-color:rgba(0,0,0,0.8);
	 position:fixed;
	 z-index:999;
	 height: 100%;
	
	 }
.tablesorter tbody{min-height:460px;height: 70vh;}	
.contant_table_cc{height:auto;} 
.md-content button{width: 120px;padding: 0;height: 33px;margin: 3px 2px;}	
.form-control{height: 32px;padding: 0 12px;} 
.form_name_cc{height: 33px;line-height: 17px;width: 40%;text-align: left;}
.first_form_contain{padding:0.3%;}
.md-content h3{margin-bottom:10px;}
.form_textbox_cc {width:59%;}
.md-content .first_form_contain {margin-bottom: 6px;}
.tablesorter td{min-width:130px;}
.tablesorter th{min-width:130px;max-width:inherit !important;}
/*.tablesorter tr{display:block;}*/
.tablesorter tbody{overflow:visible !important}
.md-trigger_vouc img{width:23px;}

.add_printer_drop{height:41px}
 /*pagination */
 .pagination>li>a, .pagination>li>span{
color: #000;/* box-shadow: 0px 0px 5px #ccc; */background-color:/* #FFEFDD*/rgba(245, 178, 27, 0.20);border: 1px solid #C1C1C1;font-weight: bold;}
.pagination>li>a:hover,.pagination>li>span:hover,.pagination>li>a:focus,.pagination>li>span:focus,.pagination>li>.active{background-color:bisque}

.pagination{margin:0;margin:5px 5px 5px 0;float:right}
.pagination > li > a, .pagination > li > span {padding: 6px 16px;color: #000000;background-color: rgba(222, 184, 135, 0.42);border: 1px solid rgba(175, 137, 88, 0.69)}
.pagination>.active>a, .pagination>.active>span, .pagination>.active>a:hover, .pagination>.active>span:hover, .pagination>.active>a:focus, .pagination>.active>span:focus{background-color:#A0522D;border-color: #A0522D;color:#fff;}
.pagination> li > a:hover{background-color:#A0522D;border-color: #A0522D;color:#fff;}
#container{background-color:rgb(237, 237, 237) !important}
.ledger_head_sec{background:#fff; width:100%; height:auto; margin:0 0 5px 1px;padding-right:4px; border:1px #e5e5e5 solid;float:left;padding:10px;}.ledger_head{width:100%;height:auto;float:left;margin-top:0px;margin-bottom:5px;}
.acc_add_box{padding-right: 5px;padding-left: 0px;margin-bottom:5px;width:15%;float:left}
.ledger_list_sec{width:100%;height:auto;float:left;padding:8px;background-color:#fff;margin-bottom:15px;border:1px #e5e5e5 solid;}
.ledger_list_scr{width:100%;height:auto;float:left;height:65vh;float:left;margin-top:5px;}
.ledger_list_scr table{width:100%;height:auto;float:left}
.ledger_list_scr table td{border: solid 1px #DAD4D4;color: #333; text-align: center; font-size: 14px; height: 31px; vertical-align: middle;
font-family: 'CALIBRI_0';}
.ledger_list_scr table thead{background-color:#333}.ledger_list_scr table thead td{color:#fff}
.printer_add_text_boxes_cc input{width:100% !important}
.printer_add_text_boxes_cc .bar{width:100%}
.printer_add_popup .md-content > .div{display:inline-block;width:100%;padding:10px;}
.printer_add_text_boxes_cc .group{width:100%;margin-left:0;}
.printer_add_text_boxes_cc input:focus ~ label, input:valid ~ label{    color: #414141;}
.md-show .md-overlay { opacity: 1;display: block;}
.printer_add_text_boxes_cc .group{margin-bottom:20px}
.type_vend{
        position: absolute;
    height: 63%;
    width: 100px;
    top: -13%;
    left: -27px;
    pointer-events: none;
    opacity: 0.5;

}
.acc_table_scroll tbody {height: 56vh;}
</style>

<link rel="stylesheet" href="../css/jquery-ui.css">
<script src="../js/jquery-ui.js"></script>
<link rel="stylesheet" href="../css/style_date.css">

</head>
<body>
     <input type="hidden" value="<?=$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']?>" id="url_check" >
     <input type="hidden" value="<?=$_SESSION['be_decimal']?>" id='decimal' >
<div class="olddiv "></div> 
<div id="blr" class="container nopaddding">
 <?php  include "includes/topbar_master.php"; ?>
 <?php include "includes/left_menu_account.php"; ?>
<div class="mian">
	<div class="view-container">
		<div style=" top: 58px;"  id="container">
			<div class="breadcrumbs">
				<ul>
					<li><a href="../index.php" style="cursor:pointer"><i class="ti-home"></i></a>/</li>
					<li><a style="cursor:pointer">Accounts</a></li>                    
				</ul>
            </div><!-- breadcrumbs -->
            <div>                                          
           </div>
                        
            <div class="col-md-12">                        
                      <div style="margin-bottom:0;background: #fff;" class="cc_new">
                        <div style="border: 0 !important " id="lista1" class="als-container">
                               <h3 style="float: left;margin-top: 10px;margin-left: 10px;font-weight: bold">SUPPLIER</h3>       
                        <div style="width: 120px;float: right;top: 3px;height: 33px;margin: 8px 10px;" class="search_btn_member_invoice filte_new_box_btn">
                           <a class="md-trigger" data-modal="modal-17" style="background-color:#314b6b;margin:0;line-height: 32px;" onclick="return pop_on();" href="#">ADD SUPPLIER</a>                        
                        </div>

                        <div style="width: 120px;float: right;top: 3px;height: 33px;margin: 8px 10px;" class="search_btn_member_invoice filte_new_box_btn"><a style="margin-top:0;background-color: #ffa500;color: #242424;line-height: 32px;font-weight:bold" href="voucher_view.php">SUPPLIER VOUCHERS </a>  
                        </div>
                               
                        <div style="width: 120px;float: right;top: 3px;height: 33px;margin: 8px 10px;" class="search_btn_member_invoice filte_new_box_btn"><a style="margin-top:0;background-color: #737400;color: #242424;line-height: 32px;font-weight:bold" href="../inventory/index.php">INVENTORY </a>  
                        </div>  

                      </div>
                    </div>
           </div>
                          
                <div class="content-sec">
                	<div style="  padding: 2px;margin-top:10px;" class="col-lg-12 col-md-12 main_cc">                    
                        <div class="col-md-12" style="padding:0 5px;">
                            <div class="ledger_head_sec" style="">  

                                <div class="acc_add_box" style="width:20%;">
                                    <label style="margin: 0;">Name</label>
                                    <input type="text" class="form-control filte_new_box" id="search_name" onkeyup="search_vendor();" name="" placeholder="Name">
                                </div>

                                <div class="acc_add_box" style="width:20%;">
                                    <label style="margin: 0;">Phone Number</label>
                                    <input type="text" class="form-control filte_new_box" id="search_number" onkeypress="return numdot(event);" onkeyup="search_vendor();" name="" placeholder="Number">
                                </div>
                                
                                 <div style="width: 100px;margin-top: 20px !important;height: 30px;margin: 8px 10px" class="search_btn_member_invoice filte_new_box_btn">
                                     <a  id="same_page" style="background-color:darkred;margin:0;line-height: 32px;"  href="supplier.php">REFRESH</a>
                                 </div>

                            <div class="ledger_list_sec" style="position:relative">

                                <div class="ledger_list_scr">
                                    <table class="acc_table_scroll" >
                                        <thead>
                                            <tr>
                                                <td style="min-width:50px; max-width:50px;">SL</td>
                                                <td style="min-width:50px; max-width:50px;">Action</td>
                                                <td style="min-width:150px; max-width:150px;">Supplier Name</td>
                                                <td style="min-width:100px; max-width:100px;">Entry Date</td>
                                                <td style="min-width:70px; max-width:70px;">Supplier ID</td>                                              
                                                <td style="min-width:100px; max-width:100px;">Type</td>
                                                <td style="min-width:100px; max-width:100px;">Number</td>
                                                <td style="min-width:100px; max-width:100px;">Voucher</td>
                                                <td style="min-width:150px; max-width:150px;">Address</td>
                                                <td style="min-width:100px; max-width:100px;">Balance</td>                                            
                                            </tr>
                                        </thead>
                                        <tbody id="load_vendor_data">
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                     
                    </div><!--main_cc-->
                </div><!--main content-sec-->
		</div>
	</div>
</div>
</div><!--container-->

<div  class="md-modal md-effect-16 printer_add_popup voucher_div" id="modal-18" style="top:0;width:100%;height:100%">
			<div style="width:800px;top:3%;margin:auto;left:0;right:0" class="md-content">
                            <h3  style="margin-bottom:0"> ADD SUPPLIER VOUCHER </h3>
                            <div onclick="return close_voucher();"  style="background-color:transparent;top: 3px;"  class="md-close close_staff_pop"><img src="img/close_ico.png"></div>
				
                <div class="div">
                        <div class="col-lg-12 col-md-12 no-padding printer_add_text_boxes_cc add_supplier_cnt" style="margin-bottom:5px;">                        
                        <div class="col-md-4">
                            <div class="group" id="prn_div">   
                                <input readonly type="text" style="font-weight:bold;color: #af0000;text-transform: uppercase" value=" " id="vendor_id"  >   
                                <span  style="color:darkred" class="type_vend"></span>
                            <span style="color:darkred" class="bar"></span>
                            <label style="color:darkred" > </label>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="group" id="prn_div">   
                                <input type="text"  class="v_date" id="date_voucher"  >   
                            <span class="highlight"></span>
                            <span class="bar"></span>
                            <label id="lab_grp">Date</label>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="group" id="prn_div">   
                                <input readonly type="text" id="v_address_vc"  >   
                            <span class="highlight"></span>
                            <span class="bar"></span>
                            <label id="lab_grp"></label>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="group" id="prn_div">   
                            <input type="text" id="v_invoice"  >   
                            <span class="highlight"></span>
                            <span class="bar"></span>
                            <label id="lab_grp">Invoice No</label>
                            </div>
                        </div>
                            
                        <div class="col-md-4">
                            <div class="group" id="prn_div">                                                                                                 
                            <input type="text" id="v_invoice_amount" onkeyup="return valid_paid();"  maxlength="10" onkeypress="return numdot(this,event);">                                 
                            <span class="highlight"></span>
                            <span class="bar"></span>
                            <label id="lab_grp">Invoice Amount</label>
                            </div>
                        </div>
                            
                            <div class="col-md-4" style="display:none">
                            <div class="group" id="prn_div">      
                                <select class="add_printer_drop" id="v_tax_type" onchange="tax_changer()"> 
                                    <option value="nonvat">NON VAT</option>
                                    <option value="vat">VAT </option>
                                </select>
                            </div>
                            </div>
                                                                                 
                            <div class="col-md-4" style="display:none">
                            <div class="group" id="prn_div">  
                                                                                              
                            <input placeholder="Tax" readonly type="text" id="v_tax_amount" value=""  onkeypress="return numdot(this,event);">                                 
                            <span class="highlight"></span>
                            <span class="bar"></span>
                            <label id="lab_grp" class="tax_view_lab" ></label>
                            </div>
                        </div>
                                                    
                            <div class="col-md-4" style="display:none">
                            <div class="group" id="prn_div">  
                                                               
                            <input placeholder="Subtotal" readonly type="text" id="v_subtotal_amount" value=""  onkeypress="return numdot(this,event);">                                  
                            <span class="highlight"></span>
                            <span class="bar"></span>
                            <label id="lab_grp" class="tax_view_lab"></label>
                            </div>
                        </div>
                                        
                            <div class="col-md-4">
                            <div class="group" id="prn_div">   
                                <input type="text" id="v_dis_amount"  maxlength="10" onkeypress="return numdot(this,event);" >   
                            <span class="highlight"></span>
                            <span class="bar"></span>
                            <label id="lab_grp">Discount Amount</label>
                            </div>
                            </div>
                            
                        <div class="col-md-4">
                            <div class="group" id="prn_div">      
                                <select class="add_printer_drop" id="v_from" onchange="check_ledger_balance();" > 
                                    <option value="">Select</option>
                                    <?php 
                                         $sql_kotlist  =  $database->mysqlQuery("SELECT tlm_id,tlm_ledger_name from tbl_ledger_master tl left join tbl_ledger_group tg on tl.tlm_group=tg.tlg_id where (tg.tlg_name='Cash in Hand' OR tg.tlg_name='Bank Accounts')  "); 
					$num_kotlist  = $database->mysqlNumRows($sql_kotlist);
					if($num_kotlist){
						  while($result_kotlist  = $database->mysqlFetchArray($sql_kotlist)) 
							  { ?>
                            <option value="<?=$result_kotlist['tlm_id'] ?> "><?=$result_kotlist['tlm_ledger_name'] ?> </option>
                             <?php 
                             }
                            } ?>
                                </select>
                                <label style="top:-5px;color: #414141;font-size: 14px" id="lab_grp">From ACC</label>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="group" id="prn_div">   
                                <input type="text" id="v_paid_amount" value="0" maxlength="10" onkeyup="return valid_paid();" onkeypress="return numdot(this,event);" >   
                            <span class="highlight"></span>
                            <span class="bar"></span>
                            <label id="lab_grp" class="paid_div_cc">Paid Amount</label>
                            </div>
                        </div>
                            
                            <div class="col-md-4">
                            <div class="group" id="prn_div">   
                                <input type="text" id="v_credit_amount" maxlength="10" readonly >   
                            <span class="highlight"></span>
                            <span class="bar"></span>
                            <label id="lab_grp"  style="margin-bottom: 56px;margin-top: -15px;font-size: 14px;color: #414141;"> Credit Amount</label>
                            </div>
                        </div> 
                                                                                   
                        <div class="col-md-4">
                            <div class="group" id="prn_div">   
                            <input type="text" id="v_trn_detail"  >   
                            <span class="highlight"></span>
                            <span class="bar"></span>
                            <label id="lab_grp">Transaction Details</label>
                            </div>
                        </div>
                                                       
                            <div class="col-md-4">
                            <div class="group" id="prn_div">      
                                <select class="add_printer_drop" id="v_purchase_type"> 
                                    <option value="">Select</option>
                                     <option value="Stock">Stock Purchase</option>
                                     <option value="Normal">Normal Purchase</option>                                   
                                </select>
                                <label style="top:-5px;color: #414141;font-size: 14px" id="lab_grp">Purchase Type</label>
                            </div>
                        </div>
                            
                        <div class="col-md-12">
                            <div class="group" id="prn_div">   
                            <input type="text" id="v_remarks"  >   
                            <span class="highlight"></span>
                            <span class="bar"></span>
                            <label id="lab_grp">Particulars</label>
                            </div>
                        </div>
                        <a onclick="return  add_supllier_voucher();" href="#"><button style="position:relative;top:2px;float:right;right:5px;height: 42px;" class="md-save">SUBMIT</button></a>
                        </div>
                </div>
    </div>
</div>

<div  class="md-modal md-effect-16 printer_add_popup vendor_pop" id="modal-17" style="top:0;width:100%;height:100%">
            <div style="width:800px;top:3%;margin:auto;left:0;right:0" class="md-content">
            <div class="alert_popup_sec_cc confirm_open_bal" style="display:none">
                    <div class="alert_popup">
                            <div class="alert_popup_contant">
                                Confirm Opening Balance as 0 ?<br>
                                <a id="no_open" href="#"><div class="alert_popup_contant_btn no">NO</div></a>
                                <a id="yes_open" href="#"><div class="alert_popup_contant_btn yes">YES</div></a>
                            </div>
                    </div>                            
            </div>
            
                            <h3 id="head_pop"  style="margin-bottom:0"> ADD SUPPLIER </h3>
                                <div onclick="close_vendor_pop();" style="background-color:transparent;top: 3px;"  class="md-close close_staff_pop"><img src="img/close_ico.png"></div>
				
                <div class="div">
                    <div class="col-lg-12 col-md-12 no-padding printer_add_text_boxes_cc add_supplier_cnt" style="margin-bottom:5px;">
                     <div class="col-md-12"><strong style="color:#c73f15;margin-bottom:10px;float:left">Basic Information</strong></div> 
                     <div class="col-md-4">
                         <div class="group" id="prn_div">   
                             <input autofocus type="text" id="v_name"  >   
                          <span class="highlight"></span>
                          <span class="bar"></span>
                          <label id="lab_grp">Supplier Name <span style="color:red">*</span></label>
                        </div>
                    </div>
                    <div class="col-md-8">
                        <div class="group" id="prn_div">   
                           <input type="text" id="v_address"  >   
                          <span class="highlight"></span>
                          <span class="bar"></span>
                          <label id="lab_grp">Address <span style="color:red">*</span></label>
                        </div>
                    </div>
                     <div class="col-md-3">
                        <div class="group" id="prn_div">   
                        <select class="add_printer_drop" id="v_city"> 
                            <option value='' >Select</option>  
                            <?php 
                            $sql_kotlist  =  $database->mysqlQuery("SELECT cy_cityid,cy_countryname,se_statename,cy_countryid,cy_stateid,cy_cityname from tbl_city tc left join tbl_country tco on tco.cy_countyid=tc.cy_countryid left join tbl_state ts on ts.se_stateid=tc.cy_stateid  "); 
					$num_kotlist  = $database->mysqlNumRows($sql_kotlist);
					if($num_kotlist){
						  while($result_kotlist  = $database->mysqlFetchArray($sql_kotlist)) 
							  {   ?>
                             <option value="<?=$result_kotlist['cy_cityid']?>"  country_name='<?=$result_kotlist['cy_countryname']?>' state_name='<?=$result_kotlist['se_statename']?>'   country_id='<?=$result_kotlist['cy_countryid']?>' state_id='<?=$result_kotlist['cy_stateid']?>'   >  <?=$result_kotlist['cy_cityname']?></option>
                                        <?php }} ?>                            
                          </select>
                          <label style="top:-5px;color: #414141;font-size: 14px" id="lab_grp">City</label>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="group" id="prn_div">                              
                          <input placeholder="State" readonly type="text" id="v_state"  >   
                          <span class="highlight"></span>
                          <span class="bar"></span>
                          <label id="lab_grp"></label>                           
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="group" id="prn_div">   
                            <input placeholder="Country" readonly type="text" id="v_country"  >   
                          <span class="highlight"></span>
                          <span class="bar"></span>
                          <label id="lab_grp"></label>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="group" id="prn_div">   
                            <input maxlength="11" type="text" id="v_number" onkeypress="return numdot(event)"  >   
                          <span class="highlight"></span>
                          <span class="bar"></span>
                          <label id="lab_grp">Contact No</label>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="group" id="prn_div">   
                           <input type="text" id="v_mail"  >   
                          <span class="highlight"></span>
                          <span class="bar"></span>
                          <label id="lab_grp">Email</label>
                        </div>
                    </div>
                                     
                    <div class="col-md-3">
                        <div class="group" id="prn_div">   
                            <input type="text" id="v_open_bal" onkeypress="return numdot(event)" maxlength="10" >   
                          <span class="highlight"></span>
                          <span class="bar"></span>
                          <label class="opbal_div" id="lab_grp">Opening Balance</label>
                        </div>
                    </div>
                                          
                     <div class="col-md-3">
                        <div class="group" id="prn_div">   
                        <select class="add_printer_drop" id="v_type_entry"> 
                            <option value="" >Select</option>
                            <option value='Credit' >Credit Entry</option>  
                           <option value='Normal' >Normal Entry</option>  
                        </select>
                        <label style="top:-5px;color: #414141;font-size: 14px" id="lab_grp">Entry Type</label>
                        </div>
                     </div>

                    <div class="col-md-12"><strong style="color:#c73f15;margin-bottom:13px;float:left">Statutory Details</strong></div>                    
                    <div class="col-md-3">
                        <div class="group" id="prn_div">   
                           <input type="text" id="v_st_tin"  >   
                          <span class="highlight"></span>
                          <span class="bar"></span>
                          <label id="lab_grp">Sales Tax Reg - Tin No</label>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="group" id="prn_div">   
                            <input maxlength="15" type="text" id="v_st_gst"  >   
                          <span class="highlight"></span>
                          <span class="bar"></span>
                          <label id="lab_grp">GST No/ Trn No</label>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="group" id="prn_div">   
                            <input type="text" id="v_st_servicetax_no" maxlength="15"  >   
                          <span class="highlight"></span>
                          <span class="bar"></span>
                          <label id="lab_grp">Service Tax Reg No</label>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="group" id="prn_div">   
                            <input maxlength="10" type="text" id="v_st_pan"  >   
                          <span class="highlight"></span>
                          <span class="bar"></span>
                          <label id="lab_grp">Pan</label>
                        </div>
                    </div>

                    <div class="col-md-12"><strong style="color:#c73f15;margin-bottom:13px;float:left">Bank Details</strong></div>

                    <div class="col-md-3">
                        <div class="group" id="prn_div">   
                           <input type="text" id="v_bnk_name"  >   
                          <span class="highlight"></span>
                          <span class="bar"></span>
                          <label id="lab_grp">Bank Name</label>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="group" id="prn_div">   
                           <input type="text" id="v_bnk_branch"  >   
                          <span class="highlight"></span>
                          <span class="bar"></span>
                          <label id="lab_grp">Branch</label>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="group" id="prn_div">   
                            <input type="text" id="v_bnk_accno" maxlength="16" onkeypress="return numdot(event)">   
                          <span class="highlight"></span>
                          <span class="bar"></span>
                          <label id="lab_grp">Account No</label>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="group" id="prn_div">   
                            <input type="text" id="v_bnk_ifsc" maxlength="11" >   
                          <span class="highlight"></span>
                          <span class="bar"></span>
                          <label id="lab_grp">IFSC Code</label>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="group" id="prn_div">   
                         
                            <select class="add_printer_drop" id="v_bnk_modepay"> 
                            <option value='' >Payment Mode</option> 
                            <option value='Cash' > Cash</option> 
                            <option value='Card' > Card</option> 
                            <option value='Cheque' >Cheque</option> 
                            <option value='Upi' >Upi </option>                                                            
                            </select>                                                   
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="group" id="prn_div">   
                           <input type="text" id="v_bnk_credit_period"  onkeypress="return numdot(event)">   
                          <span class="highlight"></span>
                          <span class="bar"></span>
                          <label id="lab_grp">Credit Period Days</label>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="group" id="prn_div">   
                           <input type="text" id="v_bnk_favour"  >   
                          <span class="highlight"></span>
                          <span class="bar"></span>
                          <label id="lab_grp">In favour of</label>
                        </div>
                    </div>

                    <div class="col-md-12"><strong style="color:#c73f15;margin-bottom:13px;float:left">Concerned Person Details</strong></div>
                    <div class="col-md-3">
                        <div class="group" id="prn_div">   
                           <input type="text" id="v_con_name"  >   
                          <span class="highlight"></span>
                          <span class="bar"></span>
                          <label id="lab_grp">Name</label>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="group" id="prn_div">                          
                          <input type="text" id="v_con_desg"  >   
                          <span class="highlight"></span>
                          <span class="bar"></span>
                          <label id="lab_grp">Designation</label>                           
                        </div>
                        
                    </div>

                    <div class="col-md-3">
                        <div class="group" id="prn_div">   
                            <input type="text" id="v_con_number" maxlength="10" onkeypress="return numdot(event)" >   
                          <span class="highlight"></span>
                          <span class="bar"></span>
                          <label id="lab_grp">Mobile No</label>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="group" id="prn_div">   
                           <input type="text" id="v_con_mail"  >   
                          <span class="highlight"></span>
                          <span class="bar"></span>
                          <label id="lab_grp">Email</label>
                        </div>
                    </div>
                    
                    </div>
                      
         <a id="add_btn"  onclick="return submit_vendor();" href="#"><button style="position:relative;top:2px;float:right;right:5px;height: 42px;" class="md-save">SUBMIT</button></a>
         <a id="upd_btn" style="display:none" onclick="return update_vendor();" href="#"><button style="position:relative;top:2px;float:right;right:5px;height: 42px;" class="md-save">UPDATE</button></a>
                </div>                      
            </div>
</div>       
  <div class="md-overlay"></div>       

<strong class="alert_error_popup" style="display: none" id="error_pop"> </strong>
<script src="../master_style/js/classie.js"></script>
<script src="../master_style/js/modalEffects.js"></script>
<script src="../bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<script src="../js/jquery.cookie.js"></script>
<script src="../loyalty/assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>
<script type="text/javascript" src="../js/jquery.tablesorter.js"></script>
<script type="text/javascript" id="js">
</script>

<script type="text/javascript">
    //calender//
$(document).ready(function () 
{         
    search_vendor();       
    var url_check=$('#url_check').val();
    var new_id=url_check.split('load_sup=');
   
   if(new_id[1]=='sup_inv'){
     $('#modal-17').addClass('md-show');
     }
     
         $( "#date_voucher").datepicker({
               changeMonth: true,
               changeYear: true,
               format: 'yyyy-mm-dd',
                endDate: '+0d',
               autoclose: true
           });
  // $('#date_voucher').datepicker('setStartDate', new Date());        
       $('#no_open').click(function(){
           $('.confirm_open_bal').hide();
           $('#v_open_bal').focus();
       });
       
       $('#yes_open').click(function(){
        $('.confirm_open_bal').hide();
       
   var v_name=$('#v_name').val();
   var v_address=$('#v_address').val();
   var v_city=$('#v_city').val();
   var v_state=$('#v_state').attr('state_id_set');
   var v_country=$('#v_country').attr('country_id_set');
   var v_mail=$('#v_mail').val();
   var v_open_bal=0;
   var v_number=$('#v_number').val();
   var v_st_tin=$('#v_st_tin').val();
   var v_st_gst=$('#v_st_gst').val();
   var v_st_servicetax_no=$('#v_st_servicetax_no').val();
   var v_st_pan=$('#v_st_pan').val();
   var v_bnk_name=$('#v_bnk_name').val();
   var v_bnk_branch=$('#v_bnk_branch').val();
   var v_bnk_accno=$('#v_bnk_accno').val();
   var v_bnk_ifsc=$('#v_bnk_ifsc').val();
   var v_bnk_modepay=$('#v_bnk_modepay').val();
   var v_bnk_credit_period=$('#v_bnk_credit_period').val();
   var v_bnk_favour=$('#v_bnk_favour').val();
   var v_con_name=$('#v_con_name').val();
   var v_con_desg=$('#v_con_desg').val();
   var v_con_number=$('#v_con_number').val();
   var v_con_mail=$('#v_con_mail').val();
   var v_type_entry=$('#v_type_entry').val();                   
   
        var data_v="set=add_vendor&v_name="+v_name+"&v_address="+v_address+"&v_city="+v_city+"&v_state="+v_state+"&v_country="+v_country+"&v_mail="+v_mail+
          "&v_open_bal="+v_open_bal+"&v_number="+v_number+"&v_st_tin="+v_st_tin+"&v_st_gst="+v_st_gst+"&v_st_servicetax_no="+v_st_servicetax_no+
          "&v_st_pan="+v_st_pan+"&v_bnk_name="+v_bnk_name+"&v_bnk_branch="+v_bnk_branch+"&v_bnk_accno="+v_bnk_accno+"&v_bnk_ifsc="+v_bnk_ifsc+
          "&v_bnk_modepay="+v_bnk_modepay+"&v_bnk_credit_period="+v_bnk_credit_period+"&v_bnk_favour="+v_bnk_favour+"&v_con_name="+v_con_name+
          "&v_con_desg="+v_con_desg+"&v_con_number="+v_con_number+"&v_con_mail="+v_con_mail+"&v_type_entry="+v_type_entry;
        
        $.ajax({
			type: "POST",
			url: "load_accounts_data.php",
			data: data_v,
			success: function(msg)
			{
                         $('#error_pop_v').show();
                         $('#error_pop_v').css('background-color', '#549056');
                         $('#error_pop_v').text('ADDED SUCCESSFULLY');
                         $('#error_pop_v').delay(2000).fadeOut('slow');
                         $('.vendor_pop').removeClass('md-show');
                         setTimeout(function(){
                            search_vendor(); 
                        //   window.location.href='supplier.php';                           
                        }, 500);                                                     
                        }
                    });
            });
             
     $('#v_city').change(function()
     {
        var city=$(this).val();
        var country_id=$('option:selected', this).attr('country_id');
        var state_id= $('option:selected', this).attr('state_id');                 
        var country_name=$('option:selected', this).attr('country_name');         
        var state_name= $('option:selected', this).attr('state_name');

          $('#v_state').val(state_name);         
          $('#v_country').val(country_name);
          $('#v_state').attr( 'state_id_set',state_id);
          $('#v_country').attr( 'country_id_set',country_id)
     });           
                
        });  
        
        

    function pop_on(){
        $("#v_name").val('');
        $("#v_address").val('');
        $("#v_city").val('');
        $("#v_state").val('');
        $("#v_country").val('');
        $("#v_number").val('');
        $("#v_mail").val('');
        $("#v_open_bal").val('');
        $("#v_type_entry").val('');
        $("#v_st_tin").val('');
        $("#v_st_gst").val('');
        $("#v_st_servicetax_no").val('');
        $("#v_st_pan").val('');
        $("#v_bnk_name").val('');
        $("#v_bnk_branch").val('');
        $("#v_bnk_accno").val('');
        $("#v_bnk_ifsc").val('');
        $("#v_bnk_modepay").val('');
        $("#v_bnk_credit_period").val('');
        $("#v_bnk_favour").val('');
        $("#v_con_name").val('');
        $("#v_con_desg").val('');
        $("#v_con_number").val('');
        $("#v_con_mail").val('');

        $('#v_open_bal').prop('readonly', false);
        $('.opbal_div').text('Opening Balance');

        $('#v_type_entry').prop('disabled',false);

        $('#upd_btn').hide();
        $('#add_btn').show();
        $('#head_pop').text('ADD SUPPLIER');

        }
        
    $('#v_invoice_amount').keyup(function(event) 
    {     
        $('#v_tax_type').val('nonvat'); 
        $('#v_tax_amount').val('');      
        
        var type=$('#vendor_id').attr('vendor_typ_set');   
        $('.tax_view_lab').hide();
        $('#v_subtotal_amount').val($('#v_invoice_amount').val());
        
       if(type=='Normal')
       {
           var inv=$('#v_invoice_amount').val();             
           $('.paid_div_cc').hide();
           $('#v_paid_amount').prop("readonly", true);
           $('#v_paid_amount').val(inv);   
           $('#v_credit_amount').val('0');              
       }       
    });
    
    function tax_changer()
    {
       var decimal=$('#decimal').val();
       var v_tax_type=$('#v_tax_type').val(); 
       var inv_amt=parseFloat($('#v_invoice_amount').val());
       if(v_tax_type=='nonvat')
       {
           $('#v_subtotal_amount').val(inv_amt);
           $('#v_tax_amount').val('');          
           $('.tax_view_lab').hide();
       }
       else{
           var tax=(inv_amt/1.05);          
            if(inv_amt>'0'){
            $('.tax_view_lab').hide();                 
            $('#v_subtotal_amount').val(tax.toFixed(decimal));           
            $('#v_tax_amount').val((inv_amt-tax).toFixed(decimal));
         }
       }   
    }
    
    
    function numdot(item,evt) 
    {
    evt = (evt) ? evt : window.event;
    var charCode = (evt.which) ? evt.which : evt.keyCode;
    if (charCode==46)
    {
        var regex = new RegExp(/\./g)
        var count = $(item).val().match(regex).length;
        if (count > 1)
        {
            return false;
        }
    }
    if (charCode > 31 && (charCode < 48 || charCode > 57)) {
        return false;
    }
    return true;
    }
    
    function check_ledger_balance()
    {
    var v_from=$('#v_from').val();
    var data_v="set=check_ledger_balance&ledger="+v_from;
    $.ajax({
			type: "POST",
			url: "load_accounts_data.php",
			data: data_v,
			success: function(msg)
			{                        
        if($.trim(msg)!='ok')
        {                   
         $('#v_from').val('');                      
         $('#error_pop_v').show();
         $('#error_pop_v').text('NO BALANCE IN LEDGER');
         $('#v_from').focus();
         $('#error_pop_v').delay(2000).fadeOut('slow');
        } 
            }
    });       
    }
    
    
function submit_vendor()
{    
   var v_name=$('#v_name').val();
   var v_address=$('#v_address').val();
   var v_city=$('#v_city').val();
   var v_state=$('#v_state').attr('state_id_set');
   var v_country=$('#v_country').attr('country_id_set');
   var v_mail=$('#v_mail').val();
   var v_open_bal=$('#v_open_bal').val();
   var v_number=$('#v_number').val();
   var v_st_tin=$('#v_st_tin').val();
   var v_st_gst=$('#v_st_gst').val();
   var v_st_servicetax_no=$('#v_st_servicetax_no').val();
   var v_st_pan=$('#v_st_pan').val();
   var v_bnk_name=$('#v_bnk_name').val();
   var v_bnk_branch=$('#v_bnk_branch').val();
   var v_bnk_accno=$('#v_bnk_accno').val();
   var v_bnk_ifsc=$('#v_bnk_ifsc').val();
   var v_bnk_modepay=$('#v_bnk_modepay').val();
   var v_bnk_credit_period=$('#v_bnk_credit_period').val();
   var v_bnk_favour=$('#v_bnk_favour').val();
   var v_con_name=$('#v_con_name').val();
   var v_con_desg=$('#v_con_desg').val();
   var v_con_number=$('#v_con_number').val();
   var v_con_mail=$('#v_con_mail').val();
   var v_type_entry=$('#v_type_entry').val();                   
   
    if(v_name!='' && v_address!=''){
        
     if(v_mail!=''){    
    var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
  if(!regex.test(v_mail)) {  
    $('#error_pop_v').show();
    $('#error_pop_v').text('ENTER VALID EMAIL ID');
    $('#v_mail').focus();
    $('#error_pop_v').delay(2000).fadeOut('slow');
    exit;
   }  
     }   

    if(v_st_gst!='')
    {
    var alphanumers = /^[a-zA-Z0-9 ]+$/;
    if(!alphanumers.test(v_st_gst))
    {
    $('#error_pop_v').show();
    $('#error_pop_v').text('ENTER VALID GST NUMBER');
    $('#v_st_gst').focus();
    $('#error_pop_v').delay(2000).fadeOut('slow');
    exit;
    } 
    }
        
    if(v_st_pan!='')
    {           
    var alphanumers = /^[a-zA-Z0-9 ]+$/;
    if(!alphanumers.test(v_st_pan))
    {
    $('#error_pop_v').show();
    $('#error_pop_v').text('ENTER VALID PAN NUMBER');
    $('#v_st_pan').focus();
    $('#error_pop_v').delay(2000).fadeOut('slow');
    exit;
    } 
    }
        
    if(v_st_servicetax_no!='')
    {
    var alphanumers = /^[a-zA-Z0-9 ]+$/;
    if(!alphanumers.test(v_st_servicetax_no))
    {
    $('#error_pop_v').show();
    $('#error_pop_v').text('ENTER VALID SERVICE TAX REG NUMBER');
    $('#v_st_servicetax_no').focus();
    $('#error_pop_v').delay(2000).fadeOut('slow');
    exit;
    } 
    }
        
    if(v_bnk_accno!='')
    {           
    var alphanumers = /^[0-9]+$/;
    if(!alphanumers.test(v_bnk_accno))
    {
    $('#error_pop_v').show();
    $('#error_pop_v').text('ENTER VALID BANK ACC NUMBER');
    $('#v_bnk_accno').focus();
    $('#error_pop_v').delay(2000).fadeOut('slow');
    exit;
    } 
    }
               
    if(v_bnk_ifsc!='')
    {            
    var alphanumers = /^[a-zA-Z0-9 ]+$/;
    if(!alphanumers.test(v_bnk_ifsc))
    {
    $('#error_pop_v').show();
    $('#error_pop_v').text('ENTER VALID BANK IFSC CODE');
    $('#v_bnk_ifsc').focus();
    $('#error_pop_v').delay(2000).fadeOut('slow');
    exit;
    } 
    }
        
    if(v_con_mail!='')
    {    
    var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
    if(!regex.test(v_con_mail)) {  
    $('#error_pop_v').show();
    $('#error_pop_v').text('ENTER VALID EMAIL ID');
    $('#v_con_mail').focus();
    $('#error_pop_v').delay(2000).fadeOut('slow');
    exit;
    }  
    }  
    
    if(v_type_entry==''){
        $('#error_pop_v').show();
        $('#error_pop_v').text('SELECT ENTRY TYPE');
        $('#v_type_entry').focus();
        $('#error_pop_v').delay(2000).fadeOut('slow');
        exit;
         }
        
        if(v_open_bal=='')
        {
        $('.confirm_open_bal').show();
        exit;
         }
        
        var data_v="set=add_vendor&v_name="+v_name+"&v_address="+v_address+"&v_city="+v_city+"&v_state="+v_state+"&v_country="+v_country+"&v_mail="+v_mail+
          "&v_open_bal="+v_open_bal+"&v_number="+v_number+"&v_st_tin="+v_st_tin+"&v_st_gst="+v_st_gst+"&v_st_servicetax_no="+v_st_servicetax_no+
          "&v_st_pan="+v_st_pan+"&v_bnk_name="+v_bnk_name+"&v_bnk_branch="+v_bnk_branch+"&v_bnk_accno="+v_bnk_accno+"&v_bnk_ifsc="+v_bnk_ifsc+
          "&v_bnk_modepay="+v_bnk_modepay+"&v_bnk_credit_period="+v_bnk_credit_period+"&v_bnk_favour="+v_bnk_favour+"&v_con_name="+v_con_name+
          "&v_con_desg="+v_con_desg+"&v_con_number="+v_con_number+"&v_con_mail="+v_con_mail+"&v_type_entry="+v_type_entry;
        
        $.ajax({
			type: "POST",
			url: "load_accounts_data.php",
			data: data_v,
			success: function(msg)
			{
                         $('#error_pop_v').show();
                         $('#error_pop_v').css('background-color', '#549056');
                         $('#error_pop_v').text('ADDED SUCCESSFULLY');
                         $('#error_pop_v').delay(2000).fadeOut('slow');
                         $('.vendor_pop').removeClass('md-show');
                         search_vendor(); 
                        //  setTimeout(function(){                           
                        //   // window.location.href='supplier.php';
                        //   search_vendor(); 
                        // }, 500);                                                          
                        }
                    });
        
    }else{
        
        $('#error_pop_v').show();

          if(v_address==''){             
               $('#error_pop_v').text('ENTER ADDRESS');
               $('#v_address').focus();
          }
           if(v_name==''){
        $('#error_pop_v').text('ENTER SUPPLIER NAME');
        $('#v_name').focus();
         }

         
          
        $('#error_pop_v').delay(2000).fadeOut('slow');
    }
}

function search_vendor()
{
    var v_name=$('#search_name').val();
    var v_num=$('#search_number').val();
    var data_v="set=search_vendor&v_name="+v_name+"&v_num="+v_num;
    $.ajax({
			type: "POST",
			url: "load_accounts_data.php",
			data: data_v,
			success: function(msg)
			{                           
                        $('#load_vendor_data').html(msg);
                             
                        }
                    });      
}

function show_voucher(v_id,v_name,v_typ,vadd)
{
    $('.voucher_div').addClass('md-show');
    $('#vendor_id').val(v_name);
    $('#vendor_id').attr('vendor_id_set',v_id);
    $('#vendor_id').attr('vendor_typ_set',v_typ);
    $('#v_address_vc').val(vadd);
    $('.type_vend').text(v_typ);
    $("#date_voucher").val('');
    $("#v_invoice").val('');
    $("#v_invoice_amount").val('');
    $("#v_dis_amount").val('');
    $("#v_from").val('');
    $("#v_paid_amount").val('');
    $("#v_credit_amount").val('');
    $("#v_trn_detail").val('');
    $("#v_purchase_type").val('Normal');
    $("#v_remarks").val('');
}

function close_voucher()
{
    $('.voucher_div').removeClass('md-show');
   //window.location.href='supplier.php';
   search_vendor(); 
}
function close_vendor_pop(){
    $('.voucher_div').removeClass('md-show');
   //window.location.href='supplier.php';
   search_vendor();    
}

function edit_vendor(vid){
    $('#head_pop').text('UPDATE SUPPLIER');
    $('.vendor_pop').addClass('md-show');
    $('#upd_btn').attr('update_id',vid);
    $('#upd_btn').show();
    $('#add_btn').hide();
    $('#v_open_bal').prop('readonly', true);
    $('.opbal_div').text('');
    $('#v_type_entry').prop('disabled', 'disabled');
    
    $.ajax({
			type: "POST",
			url: "load_accounts_data.php",
			data: "set=edit_vendor&edit_id="+vid,
			success: function(msg)
			{   
                var ed1=$.trim(msg);
                var ed=ed1.split('*');
                 
  $('#v_name').val(ed[0]);
  $('#v_address').val(ed[1]);
  $('#v_mail').val(ed[2]);
  $('#v_number').val(ed[3]);
  $('#v_open_bal').val(ed[4]);
  $('#v_st_tin').val(ed[5]);
  $('#v_st_gst').val(ed[6]);
  $('#v_st_servicetax_no').val(ed[7]);
  $('#v_st_pan').val(ed[8]);
  $('#v_bnk_name').val(ed[9]);
  $('#v_bnk_branch').val(ed[10]);
  $('#v_bnk_accno').val(ed[11]);
  $('#v_bnk_ifsc').val(ed[12]);
  $('#v_bnk_modepay').val(ed[13]);
  $('#v_bnk_credit_period').val(ed[14]);
  $('#v_bnk_favour').val(ed[15]);
  $('#v_con_name').val(ed[16]);
  $('#v_con_desg').val(ed[17]);
  $('#v_con_number').val(ed[18]);
  $('#v_con_mail').val(ed[19]);                             
  $('#v_city').val(ed[20]);
  $('#v_state').attr('state_id_set',ed[21]);
  $('#v_country').attr('country_id_set',ed[22]); 
  $('#v_type_entry').val(ed[23]);       
  $('#v_state').val(ed[24]);
  $('#v_country').val(ed[25]);                      
    }
        });    
}

function update_vendor()
{
   var v_name=$('#v_name').val();
   var v_address=$('#v_address').val();
   var v_city=$('#v_city').val();
   var v_state=$('#v_state').attr('state_id_set');
   var v_country=$('#v_country').attr('country_id_set');
   var v_mail=$('#v_mail').val();
   var v_open_bal=$('#v_open_bal').val();
   var v_number=$('#v_number').val();
   var v_st_tin=$('#v_st_tin').val();
   var v_st_gst=$('#v_st_gst').val();
   var v_st_servicetax_no=$('#v_st_servicetax_no').val();
   var v_st_pan=$('#v_st_pan').val();
   var v_bnk_name=$('#v_bnk_name').val();
   var v_bnk_branch=$('#v_bnk_branch').val();
   var v_bnk_accno=$('#v_bnk_accno').val();
   var v_bnk_ifsc=$('#v_bnk_ifsc').val();
   var v_bnk_modepay=$('#v_bnk_modepay').val();
   var v_bnk_credit_period=$('#v_bnk_credit_period').val();
   var v_bnk_favour=$('#v_bnk_favour').val();
   var v_con_name=$('#v_con_name').val();
   var v_con_desg=$('#v_con_desg').val();
   var v_con_number=$('#v_con_number').val();
   var v_con_mail=$('#v_con_mail').val();
   var v_id= $('#upd_btn').attr('update_id');                  
    var v_type_entry=$('#v_type_entry').val();
   
    if(v_name!='' && v_address!='')
    {
    
    if(v_mail!=''){    
    var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
    if(!regex.test(v_mail)) {  
    $('#error_pop_v').show();
    $('#error_pop_v').text('ENTER VALID EMAIL ID');
    $('#v_mail').focus();
    exit;
    }  
     }  
     if(v_type_entry==''){
        $('#error_pop_v').show();
        $('#error_pop_v').text('SELECT ENTRY TYPE');
        $('#v_type_entry').focus();
        $('#error_pop_v').delay(2000).fadeOut('slow');
        exit;
         } 
     
        var data_v="set=update_vendor&v_name="+v_name+"&v_address="+v_address+"&v_city="+v_city+"&v_state="+v_state+"&v_country="+v_country+"&v_mail="+v_mail+
          "&v_open_bal="+v_open_bal+"&v_number="+v_number+"&v_st_tin="+v_st_tin+"&v_st_gst="+v_st_gst+"&v_st_servicetax_no="+v_st_servicetax_no+
          "&v_st_pan="+v_st_pan+"&v_bnk_name="+v_bnk_name+"&v_bnk_branch="+v_bnk_branch+"&v_bnk_accno="+v_bnk_accno+"&v_bnk_ifsc="+v_bnk_ifsc+
          "&v_bnk_modepay="+v_bnk_modepay+"&v_bnk_credit_period="+v_bnk_credit_period+"&v_bnk_favour="+v_bnk_favour+"&v_con_name="+v_con_name+
          "&v_con_desg="+v_con_desg+"&v_con_number="+v_con_number+"&v_con_mail="+v_con_mail+"&v_id="+v_id+"&v_type_entry="+v_type_entry;
        
        $.ajax({
			type: "POST",
			url: "load_accounts_data.php",
			data: data_v,
			success: function(msg)
			{
                         $('#error_pop_v').show();
                         $('#error_pop_v').css('background-color', '#549056');
                         $('#error_pop_v').text('UPDATED SUCCESSFULLY');
                         $('#error_pop_v').delay(2000).fadeOut('slow');
                         $('.vendor_pop').removeClass('md-show'); 
                         setTimeout(function(){
                             
                          // window.location.href='supplier.php';
                          search_vendor(); 
                        }, 500);                                                         
                        }
                    });
 
    }else{
        
        $('#error_pop_v').show();
          if(v_address==''){              
               $('#error_pop_v').text('ENTER ADDRESS');
               $('#v_address').focus();
          }
           if(v_name==''){
        $('#error_pop_v').text('ENTER SUPPLIER NAME');
        $('#v_name').focus();
         }
          
        $('#error_pop_v').delay(2000).fadeOut('slow');
    }
}

function add_supllier_voucher(){
    
   var v_invoice_amount=$('#v_invoice_amount').val();
   var vendor_id=$('#vendor_id').attr('vendor_id_set');
   var v_date=$('.v_date').val();
   var v_address=$('#v_address_vc').val();
   var v_invoice=$('#v_invoice').val();
   var v_invoice_amount=$('#v_invoice_amount').val();
   var v_from=$('#v_from').val();
   var v_paid_amount=$('#v_paid_amount').val();
   var v_trn_detail=$('#v_trn_detail').val();
   var v_remarks=$('#v_remarks').val();
   var vendor_typ=$('#vendor_id').attr('vendor_typ_set');   
   var v_purchase_type=$('#v_purchase_type').val();
   var v_credit_amount=$('#v_credit_amount').val();
   var v_dis=$('#v_dis_amount').val();
   var v_tax=$('#v_tax_amount').val();
   var v_subtotal=$('#v_subtotal_amount').val();
    
    if(v_invoice_amount!='' && v_date!='' &&  v_paid_amount!='' && v_remarks!='')
    {
        if(v_from =='' && v_paid_amount >0 )
        {
        $('#error_pop_v').show();
        $('#error_pop_v').text('SELECT FROM ACC');
        $('#v_from').focus(); 
        $('#error_pop_v').delay(2000).fadeOut('slow');
        exit;     
        }
        if(vendor_typ=='Normal')
        {
            if(parseFloat(v_paid_amount) != parseFloat(v_invoice_amount))
            {
                $('#error_pop_v').show();                   
                $('#error_pop_v').text('PAID AMOUNT IS NOT EQUAL TO INVOICE AMOUNT');
                $('#v_paid_amount').focus(); 
                $('#error_pop_v').delay(2000).fadeOut('slow');
               exit;
            }           
        }
       
        var data_v1= "set=check_invoice&invoice="+v_invoice+"&vendor="+vendor_id
        $.ajax({
			type: "POST",
			url: "load_accounts_data.php",
			data: data_v1,
			success: function(msg1)
			{
            if($.trim(msg1)!='no' || v_invoice=='')
            {               
                $('#error_pop_v').show();
                $('#error_pop_v').css('background-color', '#549056');
                $('#error_pop_v').text('ADDING...');
                        
        var data_v="set=add_vendor_voucher&vendor_id="+vendor_id+"&v_address="+v_address+"&v_date="+v_date+"&v_invoice_amount="+v_invoice_amount+"&v_from="+v_from+"&v_paid_amount="+v_paid_amount+
          "&v_trn_detail="+v_trn_detail+"&v_remarks="+v_remarks+"&v_invoice="+v_invoice+"&vendor_typ="+vendor_typ+"&v_credit_amount="+v_credit_amount+"&v_dis="+v_dis+"&v_purchase_type="+v_purchase_type+"&v_subtotal="+v_subtotal+"&v_tax="+v_tax;
                 
        $.ajax({
			type: "POST",
			url: "load_accounts_data.php",
			data: data_v,
			success: function(msg)
			{
                $('#error_pop_v').show();
                $('#error_pop_v').css('background-color', '#549056');
                $('#error_pop_v').text('ADDED SUCCESSFULLY');
                $('#error_pop_v').delay(2000).fadeOut('slow');
                      

                $('.voucher_div').removeClass('md-show'); 
                search_vendor(); 
               
                $.ajax({
                type: "POST",
                url: "load_ledger.php",
                data: "set=open_ledger_daywise&date="+v_date,
                success: function(msg1)
                {
                                     
                $.ajax({
                type: "POST",
                url: "load_ledger.php",
                data: "set=close_ledger_daywise&date="+v_date,
                success: function(msg)
                {
                    ///search_vendor();                  
                }
                });    
                }
                });                                                                                                          
            }
                });
                    
            }
            else{
                $('#error_pop_v').show();
                $('#error_pop_v').text('INVOICE NO ALREADY EXIST FOR VENDOR');
                $('#v_invoice').focus();
                $('#error_pop_v').delay(2000).fadeOut('slow');
               exit;            
                }
            }
                });
        
        
        
    }else{
        
        $('#error_pop_v').show();
        
         if(v_paid_amount==''){
              
               $('#error_pop_v').text('ENTER PAID AMOUNT');
               $('#v_paid_amount').focus();
          }        
        
          if(v_invoice_amount==''){
              
               $('#error_pop_v').text('ENTER INVOICE AMOUNT');
               $('#v_invoice_amount').focus();
          }
          
          
          if(v_remarks==''){
              
               $('#error_pop_v').text('ENTER PARTICULARS');
               $('#v_remarks').focus();
          }
          
           if(v_date==''){
              
               $('#error_pop_v').text('SELECT DATE');
               $('.v_date').focus();
          }
          
        $('#error_pop_v').delay(2000).fadeOut('slow');
    }
}

function valid_paid(){
    
     var decimal=$('#decimal').val();
    
     var v_invoice_amount=parseFloat($('#v_invoice_amount').val());
 
   var v_paid_amount=parseFloat($('#v_paid_amount').val());

   if(v_paid_amount> v_invoice_amount){
       $('#v_paid_amount').val('');
        $('#error_pop_v').show();
        $('#v_credit_amount').val('');
        
               $('#error_pop_v').text(' INVALID PAID AMOUNT ');
               $('#v_paid_amount').focus();
               $('#error_pop_v').delay(2000).fadeOut('slow');
   }else{
    if(v_paid_amount && v_invoice_amount)
    {
           var credit_amt=(v_invoice_amount-v_paid_amount).toFixed(decimal);
    }
    else{
        var credit_amt=v_invoice_amount;
    }
    
       $('#v_credit_amount').val(credit_amt);
   }
 
   if(v_invoice_amount=='' || v_invoice_amount=='0' || isNaN(v_invoice_amount)){
        $('#v_paid_amount').val('');
        $('#v_credit_amount').val('');
        $('#error_pop_v').show();
        $('#error_pop_v').text(' ENTER INVOICE AMOUNT FIRST ');
        // $('#v_invoice_amount').focus();
        $('#error_pop_v').delay(2000).fadeOut('slow');
   } 
}


</script>
<div style="position:fixed;width:auto;right: 20px;bottom:20px;z-index:99999;background-color: #f00;color: white;padding: 10px 20px;display: none;font-size: 15px" id="error_pop_v"> </div>
</body>
</html>
