<?php
include('includes/session.php');		// Check session
include("database.class.php"); // DB Connection class
$database	= new Database();

$_SESSION['pagid']=44;

?>
<!doctype html>
<html ng-app="website">
<head>
<meta charset="utf-8">
<title>Advance</title>
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
 
 
 
<link rel="stylesheet" type="text/css" href="css/calculator.css">
 <link href="css/bootstrap-cerulean.min.css" rel="stylesheet" />
 
 <script src="js/jquery-1.10.2.min.js"></script>
<script src="master_style/js/modernizr.custom.js"></script>
<style>#ascrail2002{z-index: 9999999999999999999 !important;left:2px !important }
aside { width: 238px !important}
.min-nav aside {width: 60px !important;}
.ui-autocomplete{z-index:999999 !important;}
.table_report{min-width:1040px}
.table_report thead th{padding-left:10px !important;}
.table_report thead td{padding-left:10px !important;}
.table_report td{text-align:left !important;padding-left:10px !important;}
.table_report td.feedbackdisplay{text-align:center !important;}
.confrmation_overlay_proce{
	width:100%;
	height:100%;
	position:fixed;
	z-index:9999;
	background-color:rgba(0,0,0,0.8);
	top:0;
	text-align:center;
	line-height: 40;
		}
.confrmation_overlay_proce img{width:100px;height:100px;}
.color_date{background-color: lightgray}
.left_frm_section{width:40%;float:left;}
.form_name_cc{text-align:left;width: 100%; height: auto;}
.form_textbox_cc{text-align:left;width: 100%; height: auto;}
.right_mn_section{width: 58%;float:right;height: 320px; overflow: auto;}
.first_form_contain{padding:2px;}
.add_menu_row{width:100%;height:auto;float:left;border:solid 1px #e5e5e5;padding:3px;}
.menu_add_btn{width:100%;height:29px;float:left;background-color:#02af47;text-align:center;line-height:24px;font-size:30px;margin-top:20px;    border-radius: 5px;}




</style>
<script type="text/javascript" src="js/jquery-ui-1.8.2.custom.min.js"></script> 
	<script type="text/javascript"> 
		jQuery(document).ready(function(){//portionams shtcds portionams_p shtcds_p
			$('#feedbackqstn').autocomplete({source:'autocomplete/find_keywords.php?type=feedbackqstn_q', minLength:1});
			$('#activesrch').autocomplete({source:'autocomplete/find_keywords.php?type=feedbackstatus_s', minLength:1});
		});
	</script>
    <link rel="stylesheet" href="css/jquery-ui-1.8.2.custom.css" />
<script>
$(document).ready(function(){
	
	
});
</script>
<style>
.new_overlay{
	 width:100%;
	 height:100%;
	 background-color:rgba(0,0,0,0.8);
	 position:fixed;
	 z-index:999;
	 height: 100%;
	 }
         
 .disable_split_box{
	width: 100%;
	height: 100%;
	position: absolute;
	left:0;
        top:0;
	background-color: rgba(0, 0, 0, 0.2);
	z-index: 99999;
}  
.confrmation_overlay_auth{
	width:100%;
	height:100%;
	position:fixed;
	z-index:99999;
	background-color:rgba(0,0,0,0.8);
	top:0;
		}   
                .disablegenerate { pointer-events: none; opacity: 0.4; cursor:none;}
</style>
</head>
<body>
    
     <div style="display:none" class="confrmation_overlay_auth"></div>
    
     <input type="hidden" name="decimal" id="decimal" value="<?=$_SESSION['be_decimal']?>">
    
     <input type="hidden" id="menu_add_id">
     <div style="display:none" class="confrmation_overlay_proce"></div>  
    
        <div class="olddiv "></div> 
        <div id="blr" class="container nopaddding">
         <?php  include "includes/topbar_master.php"; ?>
         <?php include "includes/left_menu.php"; ?>
        <div class="mian">
	<div class="view-container">
		<div style=" top: 58px;"  id="container">
			<div class="breadcrumbs">
				<ul>
					<li><a href="index.php" style="cursor:pointer"><i class="ti-home"></i></a>/</li>
					<li><a style="cursor:pointer">Advance</a></li>
           
                               <div class="load_error_adv"> </div>
			
				</ul>
            
			</div>
           
                <div class="content-sec">
                
                	<div style="  padding: 2px;" class="col-lg-12 col-md-12 main_cc">

                       <div class="cc_new_main">

                   
                   <div style="background:#fff; width:100%; height:auto; margin:0 0 5px 1px;padding-right:4px; border:1px #B6B6B6  solid;float:left;padding-bottom: 7px">
                        
                             <div class="form-group" style=" margin-top: 5px; margin-left:5px;width:99% !important;">
                                  <strong class="form-control filte_new_box" style="font-size:20px;color: #A91400;display:  none">ADVANCE PAYMENT</strong>
                                  
                                <a href="#"  style="text-align: center;float:left;width:17%;margin-left: 0%;background-color: #A91400;
                                 margin-top: 5px; text-decoration: none; border-radius: 5px;color: white" class="form-control filte_new_box" >ADVANCE PAYMENT </a>
                                 
                                  
                           <div>
                               <br>
                             
                            
                               <br>
                               
                               <span style="float: left;position: relative;width:7%;margin-right: 5px ">
                               <input autocomplete="off" onchange="search_change();" style="" type="text" class="form-control filte_new_box" id="entry_date_sr"  placeholder="Entry From" >
                                </span>
                               
                               
                               <span style="float: left;position: relative;width:7%;margin-right: 5px ">
                               <input autocomplete="off" onchange="search_change();" style="" type="text" class="form-control filte_new_box" id="entry_date_sr1"  placeholder="Entry To" >
                                </span>
                               
                               
                                <span style="float: left;position: relative;width:7%;margin-right: 5px ">
                               <input autocomplete="off" onchange="search_change();" style="" type="text" class="form-control filte_new_box" id="date_from"  placeholder="Del From" >
                                </span>
                               
                               <span style="float: left;position: relative;width:7%;margin-right: 5px">
                               <input autocomplete="off" onchange="search_change();"   style="" type="text" class="form-control filte_new_box" id="date_to" placeholder="Del To">
                               </span>
                               
                               <span style="float: left;position: relative;width:9%;margin-right: 5px ">
                                <input autocomplete="off" onkeyup="search_change();"   style="background-color: white;cursor: text" type="text" class="form-control filte_new_box" id="search_name" placeholder=" Name-Number" onclick="this.removeAttribute('readonly');"  readonly  >
                                </span>
                                
                               <span style="float: left;position: relative;width:7%;margin-right: 5px;display: none">
                                   <input autocomplete="off" onkeyup="search_change();"   style="cursor: pointer;background-color: white;display: block;cursor: text " type="text" onclick="this.removeAttribute('readonly');"  readonly  class="form-control filte_new_box" id="search_num" placeholder="Number">
                               </span>
                               
                               <span style="float: left;position: relative;width:7%;margin-right: 5px;display: none">
                                <select onchange="search_change();"   style="cursor: pointer;"  class="form-control filte_new_box" id="search_status" >
                                    <option value=""> Status</option>
                                    <option value="Approved">Approved</option>
                                    <option value="Cancelled">Cancelled</option>
                                </select>
                               </span>
                               
                               
                               <span style="float: left;position: relative;width:8%;margin-left: 135px;display: none">
                                <select onchange="search_change1();"   style="cursor: pointer;"  class="form-control filte_new_box" id="search_type_excel1" >
                                 
                                    <option value="customer">Customer Wise</option>
                                    <option value="item">Item Wise</option>
                                </select>
                               </span>
                               
                               
                                 <a href="advance_pay_bill.php"  style="text-align: center;float:left;width:7%;margin-left: 2%;background-color: #A91400;border-radius: 5px;color: white" class="form-control filte_new_box" id="search_item" >RESET </a>
                              
                                 <span style="float: left;position: relative;width:11%;margin-left: 10px">
                                <select onchange="search_change1();"   style="cursor: pointer;"  class="form-control filte_new_box" id="search_type_excel" >
                                 
                                    <option value="customer">Excel Customer Wise</option>
                                    <option value="item">Excel Item Wise</option>
                                </select>
                               </span>
                                 
                                 
                            </div>
                                  <div class=" filte_new_box_btn" style="width:90px;float:right;margin-top: 0px" onclick="add_pop();">
                             <a style="color:#fff;margin-top:0" href="#" class="md-trigger" > ADD PAYMENT </a> 
                             
                                  </div>
                                  
                                   <div class=" filte_new_box_btn" style="width:80px;float:right;margin-top: 0px;margin-right: 10px">
                                       <a  style="background-color: #5c829a;color:#fff;margin-top: 0" href="load_advance_reminder.php"> REMINDERS </a> 
                             
                                  </div>
                                  
                                  
                                  
                                  
                                  <div class=" filte_new_box_btn" style="width:80px;float:right;margin-top: 0px;margin-right: 10px">
                                      <a onclick="excel_download();" style="background-color: #14354a;color:#fff;margin-top: 0" href="#"> EXCEL </a> 
                             
                                  </div>
                                   
                        </div>
                    	
                    </div>
                   
                   <div class="col-md-12 add_btn_cc_2">
                      <div class="btn_cc_2">
                         
                      </div>  
                   </div>
                   <div class="col-md-12 contant_table_cc" id="listall_adv">
                     
                   </div>
                     
                    </div>
                </div>
		</div>
	</div>
</div>
</div>
</div>
 <div class="md-modal md-effect-16" id="modal-17" style="width:auto;top: 8%;">
     <div style="width: 900px" class="md-content">
         <h2 style="background-color: #A91400;color: white;margin-top:0 ">ADVANCE PAYMENT</h2>
				<div>
                    <div class="col-lg-12 col-md-12 no-padding">
                            
                        <div style="height: 20px ">
                             <strong  id="load_error" style="color:#F00;" ></strong> 
                        </div>   
                       
                        <div class="left_frm_section" style="position: relative ">
                            <div class="left_side_view"></div>
                               <div class="first_form_contain">
                             	<div class="form_name_cc">NAME * </div>
                               	 <div class="form_textbox_cc" id="feedback_div">
                                     <input onkeyup="name_search1()" type="text" class="form-control " id="name" autofocus="autofocus" autocomplete="off"  ></div>
                                     
                              <div id="name_load1" class="customer_list_autoload" style="display:none;width: 96%; top: 52px;">
                              <ul>
                               <li onclick="return name_click1();" style="cursor: pointer"> </li>
                             </ul>
                             </div>
                                     
                               </div>
                               
                                <div class="first_form_contain">
                             	<div class="form_name_cc">NUMBER * </div>
                               	 <div class="form_textbox_cc" id="feedback_div">
                                     <input onkeyup="num_search1()" onkeypress="return numdot(event)" maxlength="15" type="text" class="form-control " id="number"  autocomplete="off"  ></div>
                              <div  id="num_load1" class="customer_list_autoload" style="display:none;width: 96%; top: 106px;">
                              <ul>
                               <li onclick="return name_click1();" style="cursor: pointer"> </li>
                             </ul>
                             </div>
                                </div>
                            
                              <div class="first_form_contain">
                             	<div class="form_name_cc">ADDRESS/MAIL </div>
                               	 <div class="form_textbox_cc" id="feedback_div">
                                     <input type="text" class="form-control " id="mail"  autocomplete="off"  ></div>
                               </div>
                            
                        
                           
                           
                                 <div class="first_form_contain">
                             	<div class="form_name_cc">NOTE/REMARKS  </div>
                               	 <div class="form_textbox_cc" id="feedback_div">
                                     <input type="text" class="form-control " id="note_delivery"   autocomplete="off" ></div>
                               </div>
                               
                               <div class="first_form_contain">
                             	<div class="form_name_cc">DELIVERY DATE * </div>
                               	 <div class="form_textbox_cc" id="feedback_div">
                                     <input type="text" class="form-control " readonly style="cursor: pointer ;margin-bottom: 35px" id="date_delivery"  autocomplete="off"   ></div>
                               </div>
                              
                               
                           
                               
                    </div>

                        <div class="right_mn_section append_div_main" style="position:relative;height: 285px">
               <div class="right_side_view disable_split_box" ></div> 
                        <div class="add_menu_row " id="second_div_main">
                                <div style="width:46%;position:relative" class="first_form_contain"  >
                             	<div class="form_name_cc">ITEM NAME : </span></div>
                                <div class="form_textbox_cc" id="feedback_div">
                                <input onclick="return search_name_show(event);" onfocus="return search_name_show(event);"  onkeyup="return search_name_show(event);"  type="text" class="form-control " id="item"  autocomplete="off" ></div>
                                <div id="name_load" class="customer_list_autoload" style="display:none;width: 96%; top: 52px;">
                              <ul>
                               <li onclick="return name_click();" style="cursor: pointer"> </li>
                             </ul>
                             </div>
                                </div>
                            
                            <div style="width:13%;position:relative" class="first_form_contain"  >
                             	<div class="form_name_cc">Weight </span></div>
                                <div class="form_textbox_cc" id="feedback_div">
                                    <input value="0"  type="text" class="form-control " id="weight" onkeyup="calc_rate();" onkeypress="return numdot_dot(this,event);" autocomplete="off" ></div>
                                
                                </div>
                            
                            
                        
                               <div style="width:10%;" class="first_form_contain">
                             	<div class="form_name_cc">Qty  </span></div>
                               	 <div   class="form_textbox_cc" id="feedback_div">
                                     <input  type="text" onkeyup="calc_rate();"  onkeypress="return numdot_dot(this,event);" maxlength="7" class="form-control " id="item_qty"  autocomplete="off" >
                                   
<!--                                     <select style="width:56%;float: right;display: none" id="qty_type" class="form-control ">
                                         <option value="single">SINGLE</option>
                                         <option value="kg">KG</option>
                                          <option value="litre">LITRE</option>
                                     </select>-->
                                     </div>
                               </div>
                              
                               <div style="width:12%" class="first_form_contain">
                             	<div class="form_name_cc">Rate  </span></div>
                               	 <div class="form_textbox_cc" id="feedback_div">
                                     <input maxlength="7" type="text" class="form-control " onkeypress="return numdot_dot(this,event);"  onkeyup="calc_rate();" id="item_rate"  autocomplete="off" ></div>
                               </div>
                              
                              <div style="width:12%" class="first_form_contain">
                             	<div class="form_name_cc">Total  </span></div>
                               	 <div class="form_textbox_cc" id="feedback_div">
                                     <input type="text" class="form-control " id="item_total" readonly autocomplete="off" ></div>
                               </div>
                              
                               <div style="width:6%" class="first_form_contain">
                                   <a class="plusbtn" style="color:#fff" href="#"><div class="menu_add_btn">+</div></a>
                                </div>
                            
                               <div class="first_form_contain">
                             	<!-- <div class="form_name_cc">DESCRIPTION : </span></div> -->
                               	 <div class="form_textbox_cc" id="feedback_div">
                                     <input type="text"  maxlength="100" class="form-control " id="item_des" placeholder="Note"  autocomplete="off" >
                                 </div>
                               </div>
                         </div><!--add_menu_row-->

                    </div>
  
                    </div>
                                    
                                   
                                    
                        <div style="width:100%;display:flex;align-items:center;justify-content:space-evenly"   >         
                           
<span style="white-space: nowrap;">
						   
                       <a style="color: white;" id="first_pay" href="#" onClick="return submit_add();" tabindex="3"><button class="md-save"> PROCEED </button></a>
                       
                       <a  id="final_pay" style="display:none;color: white;margin-left: -65px;"  href="#" onClick="return submit_add_final();" tabindex="3"><button class="md-save"> SUBMIT </button></a>
                        
                       &nbsp; &nbsp;
                       
                       <a style="color: white" onclick="close_add();" href="#"><button  tabindex="4"> EXIT </button></a>
                        &nbsp; &nbsp; 
                        
                        
                        
                         <a id="edit_first" style="color: white;display: none" onclick="edit_add();" href="#"><button  tabindex="4"> EDIT </button></a>
       </span>           
           <?php
           $tax_value=0;   $tax_unit='';          
           $tax_in = $database->mysqlQuery("SELECT * FROM tbl_extra_tax_master where amc_active='Y' and amc_enable_cs='Y' and amc_item_tax!='Y' ");
                                            $num_tx = $database->mysqlNumRows($tax_in);
                                            if ($num_tx) {
                                                while ($tx_in = $database->mysqlFetchArray($tax_in)) {
                                                    
                                                    $tax_value=$tax_value+$tx_in['amc_value'];
                                                    $tax_unit=$tx_in['amc_unit'];
                                                    
            }
            }
            
            
                    $tax_in1 = $database->mysqlQuery("SELECT amc_value,amc_unit FROM tbl_extra_tax_master te left join tbl_menu_tax_master "
                    . " tem on tem.mtm_tax_id=te.amc_id where te.amc_active='Y' and te.amc_enable_cs='Y' and te.amc_item_tax='Y' "
                    . " and tem.mtm_menuid=''  ");
                                          $num_tx1 = $database->mysqlNumRows($tax_in1);
                                          if($num_tx1) {
                                             while ($tx_in1 = $database->mysqlFetchArray($tax_in1)) {
                                                    
                                                    $tax_value1=$tx_in1['amc_value'];
                                                    $tax_unit1=$tx_in1['amc_unit'];
                                                      
                                        }
                                    }
            
                                                
                    ?>
					

					
					 <div class="first_form_contain" style="width:auto" >
                             	<div class="form_name_cc">MODE OF PAY  </span></div>
                                <div class="form_textbox_cc" id="feedback_div" style="width:100px">
                                  
                                    <input onkeyup="check_paid()" style="width:95px" placeholder="PAID AMOUNT" maxlength="10" value="0" onkeypress="return numdot_dot(this,event);" type="text" class="form-control " id="amount"  tabindex="1"  autocomplete="off"  >
                                </div> 
                                
                                <div class="form_textbox_cc" id="feedback_div" style="width:95px"> 
                                
                                     <select  class="form-control " id="mode_of_pay" style="width:85px">
                                         <option value="CASH">CASH</option>
                                         <option value="CARD">CARD/UPI</option>
                                         <option value="CREDIT">CREDIT</option>
                                         <option value="COMPLIMENTARY">COMPLIMENTARY</option>
                                     </select>
                                     
                                    </div>
                                
                                   <div class="form_textbox_cc" id="feedback_div" style="width:125px">   
                                    <select  class="form-control " id="bank" style="display:none">
                                         <option value="">SELECT BANK</option>
                                        <?php
                                        
                                        $sql_ds_nos = "select * from tbl_bankmaster where bm_active='Y' ";
                                        $sql_ds = $database->mysqlQuery($sql_ds_nos);
                                        $num_ds = $database->mysqlNumRows($sql_ds);
                                        if ($num_ds) {
                                        while ($result_ds = $database->mysqlFetchArray($sql_ds)) {
                                        ?>    
                                        <option value="<?= $result_ds['bm_id']?>"><?= $result_ds['bm_name']?></option>
                                        <?php } }  ?>
                                     </select>
                                    
                                     
                                    </div>
                                
                               </div>   
					
					</div>
                       
                       
                         <div style="padding-bottom: 30px;    margin-top: 10px; ">
                      <strong style="color:black;float: right">Total:  <span id="total_adv_item">0</span></strong> 
                        
                      <strong tax_value="<?=$tax_value?>" tax_unit="<?=$tax_unit?>" id="tax_details" style="color:black;float: right;margin-right: 10px;">Tax:  <span id="taxtotal_adv_item">0</span></strong>
                        
                      <strong style="color:black;float: right;    margin-right: 10px;">Sub Total:  <span id="subtotal_adv_item">0</span></strong> 
                      
                      </div> 
                      
		      </div>
         
                </div>
		</div>
<div class="md-overlay"></div><!-- the overlay element -->


<div class="menu_list_added_popup_cc" style="display:none" id="menu_detail_popup">
    <div class="menu_list_added_popup">
        <div class="menu_list_added_popup_head">ITEM DETAILS</div>
        <div class="menu_listcontant_tble_sec" id="load_menu_data">

        

        </div>
        <div class="col-lg-12 col-md-12 text-center pop_ftr_btn_sec">
            <a onclick="close_view_pop();" href="#"><button tabindex="4" style="color:white"> CLOSE </button></a>
        </div>
    </div> 
</div>

<!--/////////authorization popup//////-->

<div class="payment_auth_pop" style="display:none">
    <input type="hidden" name="focusedtext" id="focusedtext" />
 <div class="kotcancel_reason_popup_new_left_cc">
     <div class="kotcancel_reason_popup_new_head head_change" style="color:darkred">EDIT AUTHORIZATION</div>
    <div class="kotcancel_reason_popup_new_textbox_contant">
   
    	
        <div style="width: 100%;float: left;height: 20px;line-height: 10px;text-align: center"><strong id="pin_error" style="color:red;text-transform: uppercase"></strong></div>
        <div class="kotcancel_reason_popup_new_textbox_cc" style="margin-bottom:10px;">
            <input type="password" class="kotcancel_reason_popup_new_textbox_input" placeholder="CODE" id="pin_pay" onkeypress="return numdot(event)" autofocus maxlength="4" autocomplete="off" />
        </div>
    </div>
    <div class="kotcancel_reason_popup_new_textbox_btn_cc">
        <a href="#"><div class="kotcancel_reason_popup_new_textbox_btn pin_close_auth" id="kotcancel_reason_popup_new_cancel_btn">EXIT</div></a>
    	<a href="#"><div class="kotcancel_reason_popup_new_textbox_btn kotcscancel pin_pay_auth" id="kotcancel_reason_popup_new_proceed_btn_cs11">PROCEED</div></a>
    </div> 
  </div>
    
  <div class="kotcancel_reason_popup_new_right_cc">
      <div class="keys settle_key" style="margin-top:0">
            <span class="calculator_settle_auth">1</span>
            <span class="calculator_settle_auth">2</span>
            <span class="calculator_settle_auth">3</span>
             <span class="calculator_settle_back_auth">.</span>
            <span class="calculator_settle_auth">4</span>
            <span class="calculator_settle_auth">5</span>
            <span class="calculator_settle_auth">6</span>
             <span class="calculator_settle_auth">Clear</span>
            <span class="calculator_settle_auth">7</span>
            <span class="calculator_settle_auth">8</span>
            <span class="calculator_settle_auth">9</span>
            <span class="calculator_settle_auth">0</span>
        </div>
  </div>
</div>


<script src="master_style/js/classie.js"></script>
<script src="master_style/js/modalEffects.js"></script>
<script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<script src="js/jquery.cookie.js"></script>


<script type="text/javascript">
    
    function add_pop(){
        
          $('#modal-17').addClass('md-show');
          $("#name").focus();
    }
    
    
     function excel_download(){
        
        var sts= $('#search_status').val(); 
        var fromdt=  $('#date_from').val();
        var todt=  $('#date_to').val();
        var name=  $('#search_name').val();
        var number=  $('#search_num').val();
        var entry=$('#entry_date_sr').val();  
        var entry1=$('#entry_date_sr1').val();  
        var type=$('#search_type_excel').val();  
        
          window.location.href='load_advance_pay.php?value=excel_download&fromdt='+fromdt+'&todt='+todt+'&name='+name+'&number='+number+
          "&sts="+sts+"&entry="+entry+"&type="+type+"&entry1="+entry1;
    
     }
    
    
    function check_paid(){
        
         var paid=$('#amount').val();
         
          var tot=$('#total_adv_item').text(); 
         
         if(parseFloat(paid)<=parseFloat(tot)){
         
         if(parseFloat(tot)==parseFloat(paid)){
             
             
             $('#mode_of_pay').val('CASH');
             $('#bank').hide();
             $('#bank').val('');
             
         }else{
             
             $('#mode_of_pay').val('CREDIT');
             $('#bank').hide();
             $('#bank').val('');
            
             
         }
         
         }else{
             
      $('#mode_of_pay').val('CASH');   
      $('#load_error').show();
      $('#load_error').text('PAID AMOUNT CANT BE GREATER THAN TOTAL AMOUNT');
      $('#load_error').delay(1000).fadeOut('slow');
      $('#amount').val('');    
      
       $('#bank').hide();
           $('#bank').val('');
             
         }
        
    }
    
    function check_paid_ready(){
        
        if($("#amount").prop('disabled') == true)
       {
 
        $('#show_error_msg').show(); 
        $('#show_error_msg').text('Paid amount cant be edited if payments have been done more than one time  '); 
         $('#show_error_msg').delay('2000').fadeOut('slow');
         }
          
    }
    
    
    function close_view_pop(){
        $('#menu_detail_popup').hide();
    }
    
    
    function edit_order(id){
        
        $('.payment_auth_pop').show();
         $('.confrmation_overlay_auth').show();
         $('#pin_pay').val('');
         $('#pin_pay').focus();
         
         
          $(".pin_pay_auth").attr("edit_id", id);
    }
    
    
     function approve_cancel(id,sts,bill){
         
         var confirm1=confirm("CONFIRM ORDER CANCELLATION ?");
         if(confirm1===true){
         $.ajax({
			type: "POST",
			url: "load_advance_pay.php",
			data: "value=status_change&id_load="+id+"&status="+sts+"&billno="+bill,
			success: function(msg)
			{ 
                            
                                    location.reload();
                        }
                    });
        
        }
    }
    
    
    function view_order(mi){
        $('#menu_detail_popup').show();
        
        
         $.ajax({
			type: "POST",
			url: "load_advance_pay.php",
			data: "value=load_menu_details&id_load="+mi,
			success: function(msg)
			{ 
                            
                                      $('#load_menu_data').html(msg)
                        }
                    });
        
        
    }
    
    
    
    
    function calc_rate(){
        
          var decimal=$('#decimal').val();
        
          var rt=$('#item_rate').val();
          var qty=$('#item_qty').val();
          
           var weight=$('#weight').val();
    
         if(qty>0){
         var tot=rt*qty;
          }
          
          
          if(weight>0){
             var tot=rt*weight;
          } 
          
         $('#item_total').val(tot.toFixed(decimal));
    
          if(qty=='' || weight==''){
              $('#item_total').val(rt);
          } 
          
    }
    
    
    function name_search1(e){
    
     
     var name=$('#name').val();
     
      var number=$('#number').val();
 
     var data="set=searchname&name="+name+"&number="+number;
        $.ajax({
        type: "POST",
        url: "load_advance_pay.php",
        data: data,
        success: function(data)
        { 
             $('#name_load1').show();
         
             $('#name_load1').html(data);
           
        }
    });      
       
       
      if(name==''){
          
            $('#name').attr('loy_id','');   

            $('#number').val('');     
            
            $("#name").val('');

     }
     
     if(localStorage.name_length1 !=$('#name').val().length && localStorage.name_length1 >0){
        
            $("#name").val('');
          
            localStorage.name_length1='0';
       
            $('#name').attr('loy_id','');   

            $('#number').val('');     

     }
        
        
}
    
    
    function num_search1(e){
    
     
      var name=$('#name').val();
     
      var number=$('#number').val();
 
      var data="set=searchname&name="+name+"&number="+number;
        $.ajax({
        type: "POST",
        url: "load_advance_pay.php",
        data: data,
        success: function(data)
        { 
             $('#num_load1').show();
         
             $('#num_load1').html(data);
           
        }
    });      
       
       
      if(number==''){
          
            $('#name').attr('loy_id','');   

            $('#number').val('');     
            
            $("#name").val('');

     }
     
     if(localStorage.name_length1 !=$('#name').val().length && localStorage.name_length1 >0){
        
            $("#name").val('');
          
            localStorage.name_length1='0';
       
            $('#name').attr('loy_id','');   

            $('#number').val('');     

     }
        
        
}
    
    function search_name_show(e){
    
     
     var name=$('#item').val();
 
     var data="set=searchname_menu&name="+name;
        $.ajax({
        type: "POST",
        url: "load_advance_pay.php",
        data: data,
        success: function(data)
        { 
             $('#name_load').show();
         
           $('#name_load').html(data);
           
        }
    });      
       
       
      if(name==''){
          
            $('#item').attr('mid','');   

            $('#item_rate').val('');     

            $('#item_qty').val('');   

            $('#weight').val('');   

            $('#item_total').val('');   
        
     }
     
     if(localStorage.name_length !=$('#item').val().length && localStorage.name_length >0){
        
            $("#item").val('');
          
            localStorage.name_length='0';
       
            $('#item').attr('mid','');   

            $('#item_rate').val('');     

            $('#item_qty').val('');   

            $('#weight').val('');   

            $('#item_total').val(''); 
          
     }
        
        
}




function  name_click1(n,mid,num){
 
     $('#name').val(n);
     $('#name').attr('loy_id',mid);
     $('#number').val(num);
     $('#name_load1').hide();
    $('#num_load1').hide();
    localStorage.name_length1= $("#name").val().length;
      
 }



function  name_click(n,mid,r,rt,p,b,u){
 
     $('#item').val(n);
     $('#item').attr('mid',mid);
     $('#item_rate').val(r);
     $('#name_load').hide();
     $('#item_total').val(r);
     
    localStorage.name_length= $("#item").val().length;
     
     $('#item_rate').prop('disabled',true);
     
     if(rt=='Portion'){
         
         $('#item_qty').val('1');
         $('#weight').val('0');
         $('#item_qty').prop('disabled',false);
         $('#weight').prop('disabled',true);
       
       }else{
         
          $('#item_qty').val('1');
          $('#weight').val('1.00');
           
          $('#weight').prop('disabled',false);
          //$('#item_qty').prop('disabled',true);
     }
     
     
      
 }
    
    
    
    function reprint(id){
        
        
        var check = confirm("RE-PRINT RECEIPT ?");
	if(check==true)
	{
            
             var Bill_print = "Advance_pay";
          $.post("printercheck_1.php", {type:Bill_print},
                                               
            function(data)
            { 
            data=$.trim(data); 
       
            if(data =='')
            {    
            
            
        setTimeout(function(){
                               $('.confrmation_overlay_proce').css('display','block');
		             $('.confrmation_overlay_proce').html('<img src="img/ajax-loaders/ajax-loader.gif" />');
                
                           $('.confrmation_overlay_proce').fadeOut(1000);
                        
                         }, 1000);
        $.ajax({
			type: "POST",
			url: "load_advance_pay.php",
			data: "value=reprint_advance&id_reprint="+id,
			success: function(msg)
			{ 
                            
              
                        }
                    });
                    
                    
              }else{
         alert('Printer Not Available ')    
         location.reload();
        }
     });       
                    
                    
                    }
    }
    
    
    
    
    function search_change(){
   
     var from=$('#date_from').val();
       var to=$('#date_to').val();
       
       var name=$('#search_name').val();
       var num=$('#search_num').val();
       
       
        var sts=$('#search_status').val();
   
   
          var entry=$('#entry_date_sr').val();    
          
          var entry1=$('#entry_date_sr1').val();  
          
                     $.ajax({
			type: "POST",
			url: "load_advance_pay.php",
			data: "value=search_date_adv&to_date="+to+"&from_date="+from+"&name="+name+"&num="+num+"&sts="+sts+"&entry="+entry+"&entry1="+entry1,
			success: function(msg)
			{
                            $('#listall_adv').html(msg);
                            
                           // $('.name_show').addClass('color_date');
                            
                        }
                    });
                
    
    
    }
    
    
   
      function numdot(e) {     
   
            var charCode;
            
            if (e.keyCode > 0) {
                charCode = e.which || e.keyCode;
            }
            else if (typeof (e.charCode) != "undefined") {
                charCode = e.which || e.keyCode;
            }
            if (charCode == 43)
                return true
            if (charCode > 31 && (charCode < 48 || charCode > 57))
                 
                return false;
            return true;
          
        }
    
    
     function numdot_dot(item,evt) {
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
    
    
 function submit_add_final()
 {
       
       var loy_id=$('#name').attr('loy_id');
       
          var tot=$('#total_adv_item').text();
         
          var sub=$('#subtotal_adv_item').text();
         
          var tax=$('#taxtotal_adv_item').text();
       
          var paid=$('#amount').val();
   
          var print_id=$('#menu_add_id').val();
          
          var mode=$('#mode_of_pay').val();
          
          var bank=$('#bank').val();
          
         
          
         
                      $.ajax({
			type: "POST",
			url: "load_advance_pay.php",
			data: "value=print_paper_check&print_id="+print_id,
			success: function(msg)
			{ 
                            
                           if($.trim(msg)!='NO'){
                               
                           if(parseFloat(paid)<=parseFloat(tot)){
                            
                             if(mode=='CARD' && bank==''){   

                                    $('#load_error').show();
                                    $('#load_error').text('SELECT BANK ');
                                    $('#load_error').delay(1000).fadeOut('slow');                       
                                    exit;   
                             } 
                            
                            
                         if( ((parseFloat(paid) <= parseFloat(tot)) && mode=='CREDIT') || ((parseFloat(paid) == parseFloat(tot)) && mode!='CREDIT') ){    
                            
                         $('#final_pay').addClass('disablegenerate');      
                               
                        // alert(tot); alert(sub); alert(tax); alert(paid);
                        
	                $.ajax({
                        type: "POST",
			url: "load_advance_pay.php",
			data: "value=print_paper&print_id="+print_id+"&tot="+tot+"&sub="+sub+"&tax="+tax+"&paid="+paid+"&bank="+bank+"&mode="+mode,
			success: function(msg1)
			{ 
                            
                        $.ajax({
			type: "POST",
			url: "load_advance_pay.php",
			data: "set=bill_cs&ref_id="+print_id+"&loy_id="+loy_id,
			success: function(msg1)
			{ 
                            
                           
                             setTimeout(function(){
		              location.reload();
                             }, 500);
                            
                             }
                    });  
                            
                            
                        }
                    });
                    
                    
                     }else{
                    
       $('#load_error').show();
       $('#load_error').text('ENTER VALID AMOUNT');
      $('#load_error').delay(1000).fadeOut('slow');
                    
                     }
                    
                    
                     }else{
                    
       $('#load_error').show();
       $('#load_error').text('PAID AMOUNT CANT BE GREATER THAN TOTAL AMOUNT');
      $('#load_error').delay(1000).fadeOut('slow');
                    
                     }
               
                     }else{
                    
       $('#load_error').show();
       $('#load_error').text('PLEASE ADD MENU');
      $('#load_error').delay(1000).fadeOut('slow');
                    
                     }
              }
             });
  }
 
 
 
function submit_add()
{
    
    var type_id= $("#first_pay").attr("update_id");
  
    
    if(type_id!='' && type_id!='null' && type_id!=undefined){
        
       var method_type='update';
        
    }else{
        
        var method_type='add';
       
    }
    
  
	var name=$("#name").val();
        var number=$("#number").val();
        var amount=$("#amount").val();
        var mode=$("#mode_of_pay").val();
        var date=$("#date_delivery").val();
        var note=$("#note_delivery").val();
        
        var item=$("#item").val();
        var qty=$('#item_qty').val();
        var item_des=$('#item_des').val();
        var item_rate=$('#item_rate').val();
        var item_total=$('#item_total').val();
        var item_type=$('#qty_type').val();
        
        var mail=$('#mail').val();
        var bank=$('#bank').val();
         
        var name_len=name.length;
        
        if(name!='' && name_len>2  && number!='' && amount!=''  && date!='' && ((mode=='CARD' && bank!='') || mode!='CARD') ){
        
	  $.ajax({
			type: "POST",
			url: "load_advance_pay.php",
			data: "value=add_advance&name="+name+"&number="+number+"&amount="+amount+"&mode="+mode+"&date="+date+"&note="+note+
                        "&method_type="+method_type+"&type_id="+type_id+"&bank="+bank+"&mail="+mail+"&delivery=0",
			success: function(msg)
			{ 
                           
                            $('#final_pay').show();
                            $('#first_pay').hide();
                            $('#edit_first').show();
                            $('#menu_add_id').val($.trim(msg));
                            
                            $('.left_side_view').addClass('disable_split_box');
                            $('.right_side_view').removeClass('disable_split_box');
                            
                            
                             if($("#total_adv_item").text()>0){
                      
                                $('.right_side_view').addClass('disable_split_box');
                            }else{

                                 $('.right_side_view').removeClass('disable_split_box');
                              }
                            
                
			}
		});
  }else{
      
       $('#load_error').show();
       
       
         if(mode=='CARD' && bank==''){
             
         $('#load_error').text('SELECT BANK');
      
         }
        
       
       
         if(date==''){
       $('#load_error').text('SELECT DELIVERY DATE ');
      
        }
        
        
         if(amount==''){
       $('#load_error').text('ENTER ADVANCE AMOUNT');
        $("#amount").focus();
        }
        
        
          if(number==''){
       $('#load_error').text('ENTER CUSTOMER NUMBER');
        $("#number").focus();
        }
        
         if(name_len<3){
       $('#load_error').text('ENTER VALID NAME');
       $("#name").focus();
        }
        
        if(name==''){
       $('#load_error').text('ENTER CUSTOMER NAME');
       $("#name").focus();
        }
        
        $('#load_error').delay(1000).fadeOut('slow');
  }
  
}



function edit_add(){

 var type_id= $("#first_pay").attr("update_id");
 
 if(type_id!='' && type_id!='null' && type_id!=undefined){
        
       var method_type='update';
        
    }else{
        
        var method_type='add';
       
    }
    
    
    
  $.ajax({
			type: "POST",
			url: "load_advance_pay.php",
			data: "value=edit_all&method_type="+method_type+"&type_id="+type_id,
			success: function(msg)
			{ 
                           $("#first_pay").attr("update_id",$.trim(msg));
                            $('#final_pay').hide();
                            $('#first_pay').show();
                          $('#edit_first').hide();
                          
                            
                            $('.left_side_view').removeClass('disable_split_box');
                             $('.right_side_view').addClass('disable_split_box');
                
			}
		});
 
 
}

function deletecard(e,tot){
    
       var decimal=$('#decimal').val();

        var check = confirm("Delete Item ? ");
	if(check==true)
	{
            
       $('#second_div_main'+e).hide();
       var datastringnewcard="value=delcar&id="+e;
        $.ajax({
        type: "POST",
        url: "load_advance_pay.php",
        data: datastringnewcard,
        success: function(data)
        {      
            $('#second_div_main'+e).remove();
            
            
                    var tot_all=parseFloat($("#subtotal_adv_item").text());
               
               
                    var tax_value = $("#tax_details").attr('tax_value');
                  
                    var tax_unit = $("#tax_details").attr('tax_unit');
                  
                    var adv_tot=(tot_all-tot);
                    
                    var tax_tot=(adv_tot*tax_value)/100;
                    
                    
                    $("#subtotal_adv_item").text((tot_all-tot).toFixed(decimal));
                    
                    $("#taxtotal_adv_item").text(tax_tot.toFixed(decimal));
                    
                    $("#total_adv_item").text((tax_tot+adv_tot).toFixed(decimal));
              
              
              $('#amount').val((tax_tot+adv_tot).toFixed(decimal));
              
            
            
        }
    });
    }
}



function close_add(){
     var type_id= $("#first_pay").attr("update_id");
     
     if(type_id!='' && type_id!='null' && type_id!=undefined){
         location.reload();
     }else{
     
     var del_id=$('#menu_add_id').val();
     
     var datastringnewcard="value=delete_all&id="+del_id;
        $.ajax({
        type: "POST",
        url: "load_advance_pay.php",
        data: datastringnewcard,
        success: function(data)
        {      
            location.reload();
        }
    });
    }
    }
    
</script>


<link rel="stylesheet" href="css/jquery-ui.css">
  <script src="js/jquery-ui.js"></script>
  <link rel="stylesheet" href="css/style_date.css">
  <link href="loyalty/assets/plugins/bootstrap-datepicker/css/bootstrap-datepicker.min.css" rel="stylesheet">
<script type="text/javascript" src="js/jquery.tablesorter.js"></script>
<script src="loyalty/assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>
<script type="text/javascript">
    
    
$(document).ready(function() {

    var ctrlKeyDown = false;
       $(document).on("keydown", keydown);
       
       function keydown(e) { 

    if ((e.which || e.keyCode) == 116 || ((e.which || e.keyCode) == 82 && ctrlKeyDown)) {
        // Pressing F5 or Ctrl+R
        e.preventDefault();
    } else if ((e.which || e.keyCode) == 17) {
        // Pressing  only Ctrl
        ctrlKeyDown = true;
    }
};

    
   $(".pin_close_auth").click(function()
        {    
          $('.payment_auth_pop').hide();
         $('.confrmation_overlay_auth').hide();  
         $('#pin_pay').val('');
        });  
    
    
    
    $(".plusbtn").click(function()
     {    
          
           var item_multi   =  $('#item').val();
           var rate_multi   =  $('#item_rate').val();
           var tot_multi    =  $('#item_total').val(); 
           var qty_multi    =  $('#item_qty').val(); 
           var des_multi    =  $('#item_des').val(); 
           var type_multi    =  $('#qty_type').val(); 
           var weight    =  $('#weight').val(); 
          
           var menu_add_id=$('#menu_add_id').val();
          
           var item_id   =  $('#item').attr('mid');
           
           var datastring = "rate_multi="+rate_multi+"&item_multi="+item_multi+"&qty_multi="+qty_multi+"&tot_multi="+tot_multi+"&des_multi="+des_multi+"&type_multi="+type_multi+"&menu_add_id="+menu_add_id+"&weight="+weight+"&item_id="+item_id;
            
           if(rate_multi>0 && item_multi!=''   && qty_multi!='' && item_id!='' && item_id!='undefined' && item_id!=undefined){
                  
                  
                 $.ajax({
                 type: "POST",
                 url: "load_advance_pay.php",
                 data: datastring,
                 success: function (data)
                 { 
                 
                    var a=JSON.parse(data);
                   
                     var decimal=$('#decimal').val();
                        
                     $("#item_rate").val('');
                     $("#item").val('');
                     $("#item_des").val('');
                     $("#item_total").val('');
                     $("#item_qty").val('');
                     $("#qty_type").val('single');
                     $("#weight").val('');
                  
                    var adv_tot=0;
                   
                     $.each(a, function(i, record) {
                        
                   var amount=parseFloat(record.tmd_rate).toFixed(decimal);
                   var tot=parseFloat(record.tmd_total).toFixed(decimal);
                   var item=record.tmd_menu;
                   var  qty=record.tmd_qty;
                   var  type=record.tmd_type;
                   
                    if(record.tmd_description!='' && record.tmd_description!='null' && record.tmd_description!=null){ 
                         var desc=record.tmd_description;
                    }else{
                       var desc='';
                    }
                  
                 
                   if(record.tmd_weight!='' && record.tmd_weight!='null' && record.tmd_weight!=null){ 
                      var  weight=record.tmd_weight;
                    }else{
                       var  weight='';
                   }
                  
                  
                  
                    var tax_value = $("#tax_details").attr('tax_value');
                  
                    var tax_unit = $("#tax_details").attr('tax_unit');
                  
                    adv_tot=parseFloat(adv_tot)+parseFloat(tot);
                    
                    var tax_tot=(adv_tot*tax_value)/100;
                    
                    
                    $("#subtotal_adv_item").text(adv_tot.toFixed(decimal));
                    
                    $("#taxtotal_adv_item").text(tax_tot.toFixed(decimal));
                    
                    $("#total_adv_item").text((tax_tot+adv_tot).toFixed(decimal));
                    
                    
                     $('#amount').val((tax_tot+adv_tot).toFixed(decimal));
                    
                 
              if($('.append_div_main').find('#del_card' + record.tmd_id).length === 0) {
                  
              $(".append_div_main").append("<div class='add_menu_row' id='second_div_main"+record.tmd_id+"'>"+
                             "<div style='width:46%;position:relative' class='first_form_contain'    >"+
                                "<div class='form_textbox_cc' id='feedback_div'>"+
                                "<input readonly onclick='return search_name_show(event);'    value='" + item + "' onfocus='return search_name_show(event);'  onkeyup='return search_name_show(event);'  type='text' class='form-control ' id='item"+record.tmd_id+"'  autocomplete='off'></div>"+
                               " </div>"+
                              "<div style='width:13%;position:relative' class='first_form_contain'  >"+
                             	"<div class='form_name_cc'></span></div>"+
                               " <div class='form_textbox_cc' id='feedback_div'>"+
                                "<input readonly  value='" + weight + "' type='text' class='form-control ' id='weight"+record.tmd_id+"' autocomplete='off' ></div>"+
                                
                               " </div>"+
                        
                              " <div style='width:10%;' class='first_form_contain'>"+
                              " <div   class='form_textbox_cc' id='feedback_div'>"+
                              " <input readonly  type='text' value='" + qty + "' onkeypress='return numdot_dot(this,event);' maxlength='7' class='form-control ' id='item_qty"+record.tmd_id+"'  autocomplete='off' >"+
                                   
                                    // "<select disabled='true' style='width:56%;float: right' id='qty_type"+record.tmd_id+"' class='form-control'>"+
                                     //   " <option value='" + type + "'>"+ type +"</option>"+
                                         
                                    //" </select>"+
                                     "</div>"+
                               "</div>"+
                            " <div style='width:12%' class='first_form_contain'>"+
                            "<div class='form_textbox_cc' id='feedback_div'>"+
                           " <input maxlength='7' readonly type='text' class='form-control ' value='" + amount + "' id='item_rate"+record.tmd_id+"'  autocomplete='off' ></div>"+
                           " </div>"+
                           " <div style='width:12%' class='first_form_contain'>"+
                           " <div class='form_textbox_cc' id='feedback_div'>"+
                           " <input type='text' readonly class='form-control ' id='item_total"+record.tmd_id+"' value='" + tot + "'  autocomplete='off' > </div>"+
                          " </div>"+
                          "<div style='margin-top:0px;width: 6%;height: 30px;line-height: 26px;margin-top: 2px;float: left' id='del_card"+record.tmd_id+"' name='del_card"+record.tmd_id+"' class='menut_add_bq_btn' onclick='return deletecard("+record.tmd_id+","+tot+");'><img width='20px' src='img/cancel-icon.png'></div>"+
                          " <div class='first_form_contain'>"+
                          " <div class='form_textbox_cc' id='feedback_div'>"+
                          " <input type='text' readonly  maxlength='100' class='form-control ' value='" + desc + "' id='item_des"+record.tmd_id+"' placeholder='Note'  autocomplete='off' ></div>"+
                          " </div>"+ 
                          " </div>"
                        
              
                       );
                                 
                       }
                          
                     });
                     
                     
                  }
                 
                 });
                   
                }else{
                   
        $('#load_error').show();
       
        
         
        if(rate_multi=='' || rate_multi=='0' || rate_multi<='0'){
          $('#load_error').text('ENTER RATE');
          $("#item_rate").focus();
        }
        
        if(qty_multi==''){
          $('#load_error').text('ENTER QTY');
          $("#item_qty").focus();
        }
        
         if(item_multi<3){
        
           $('#load_error').text('ENTER ITEM');
            $("#item").focus();
         }
         
         if(item_id=='' || item_id=='undefined' || item_id==undefined){
         
          $('#load_error').text('ENTER VALID ITEM');
          $("#item").focus();
         }
       
        $('#load_error').delay(1000).fadeOut('slow');
                  
        }
        });
    
    ///////// load default list  ////////
    
                        var to='';
                        var from='';
                        var name='';
                        var num='';
       
                     $.ajax({
			type: "POST",
			url: "load_advance_pay.php",
			data: "value=search_date_adv&to_date="+to+"&from_date="+from+"&name="+name+"&num="+num+"&sts=&entry=&entry1=",
			success: function(msg)
			{ 
                            $('#listall_adv').html(msg);
                        }
                    });
                    
   
   $("#listall").tablesorter();
   
   
   
  $('#mode_of_pay').change(function(){
    
    if($('#mode_of_pay').val()=='CARD'){
        
          $('#bank').show();
          
    }else{
            
          $('#bank').hide();
          
          
          $('#bank').val('');
          
    }
    
    if($('#mode_of_pay').val()=='CREDIT'){
        
          var paid=$('#amount').val();
         
          var tot=$('#total_adv_item').text(); 
         
         if(parseFloat(paid)==parseFloat(tot)){
             
             $('#amount').val('');
      $('#load_error').show();
      $('#load_error').text('PAID AMOUNT & TOTAL AMOUNT CANT BE SAME IN CREDIT PAY');
      $('#load_error').delay(2000).fadeOut('slow');
      $('#amount').focus();  
      
         }
    }
    
     if($('#mode_of_pay').val()!='CREDIT'){
         
         $('#amount').val($('#total_adv_item').text());
         
         $('#amount').addClass('disablegenerate');
         
     }else{
         
          $('#amount').val('');
         
         $('#amount').removeClass('disablegenerate');
     }
    
    
      
   });
   
   
   $( "#date_to").datepicker({
               changeMonth: true,
               changeYear: true,
               format: 'yyyy-mm-dd',
               autoclose: true
           });
   
    $( "#date_from").datepicker({
               changeMonth: true,
               changeYear: true,
               format: 'yyyy-mm-dd',
               autoclose: true
           });
   
   $( "#date_delivery").datepicker({
               changeMonth: true,
               changeYear: true,
               format: 'yyyy-mm-dd',
               todayHighlight: true,
               autoclose: true
                 
           });
           
           $( "#entry_date_sr").datepicker({
               changeMonth: true,
               changeYear: true,
               format: 'yyyy-mm-dd',
               todayHighlight: true,
               autoclose: true
                 
           });
           
           $( "#entry_date_sr1").datepicker({
               changeMonth: true,
               changeYear: true,
               format: 'yyyy-mm-dd',
               todayHighlight: true,
               autoclose: true
                 
           });
           
           
           
   $('#date_delivery').datepicker('setStartDate', new Date());
   
   $('.calculator_settle_auth').click( function(event) {
          
		event.stopImmediatePropagation();
                $('#focusedtext').val('pin_pay');
		var focused=$('#focusedtext').val();
                var calval=($(this).text());
		var org=$('#'+focused).val();
			if(calval>=0)
			{
                            if(org.length < 4){
				if(org==0)
				{
					 $('#'+focused).val(calval);
				}else if(org>0)
				{
					$('#'+focused).val(org+calval);
				  
				}else if(org<0)
				{
					$('#'+focused).val(org+calval);
				}
                            }
			}else if(calval=="Clear")
			{
				$('#'+focused).val("");
			}else if(calval==".")
			{
				$('#'+focused).val(org+".");
			}
			$('#'+focused).change();
		$('#'+focused).focus();
	
	});
   
   
   
   $(".pin_pay_auth").unbind().click(function(event){
        
                event.stopImmediatePropagation();
                var pin =  $('#pin_pay').val();
                
                if(pin!=''){
            
                $.post("load_advance_pay.php", {pin:pin,value:'authpincheck'},
                            function(data){
                            data=$.trim(data);
                                
                       if(data=="Y"){
                           
                            var id_num_check=$('.pin_pay_auth').attr('edit_id');
                            $.post("load_advance_pay.php", {id_num_check:id_num_check,value:'check_payment_count'},
                            function(data5){
                            data5=$.trim(data5);
                                
                         if(data5>1){
                             
                             $('#amount').prop('disabled',true);
                        }else{
                             $('#amount').prop('disabled',false);
                        }
                        });
                           
        $('.payment_auth_pop').hide();
        $('.confrmation_overlay_auth').hide();  
        
        $('#modal-17').addClass('md-show');
        
        var id=$('.pin_pay_auth').attr('edit_id');
      
        $("#first_pay").attr("update_id", id);
       
        var datastring1='value=edit_pop_name&edit_id='+id;              
                                 
                 $.ajax({
                 type: "POST",
                 url: "load_advance_pay.php",
                 data: datastring1,
                 success: function (data)
                 { 
                   var detail1=$.trim(data);
                   var detail=detail1.split('*');
                   
      $("#name").val(detail[0]);
      $("#number").val(detail[1]);
      $("#amount").val(detail[2]);
      $("#mode_of_pay").val(detail[5]);
      $("#date_delivery").val(detail[4]);
      $("#note_delivery").val(detail[3]);
     
     
      if(detail[5]=='CARD'){
          
      $("#bank").val(detail[6]);
      $("#bank").show();  
      
      }else{
          
         $("#bank").val('');  
         $("#bank").hide();   
         
      }
  
  
      $("#mail").val(detail[7]); 
      
      $('#amount').prop('disabled',true);
        
      $('#mode_of_pay').prop('disabled',true);
      
      
      $('#name').prop('disabled',true);
      
      
      $('#number').prop('disabled',true);
      
      
                 }
                });
               
       
                 var datastring='value=edit_pop&edit_id='+id;              
                                 
                 $.ajax({
                 type: "POST",
                 url: "load_advance_pay.php",
                 data: datastring,
                 success: function (data)
                 { 
                 
                    var a=JSON.parse(data);
                   
                     var decimal=$('#decimal').val();
                        
                     $("#item_rate").val('');
                     $("#item").val('');
                     $("#item_des").val('');
                     $("#item_total").val('');
                     $("#item_qty").val('');
                     $("#qty_type").val('single');
                      $("#weight").val('');
                    
                   var adv_tot=0;
                     $.each(a, function(i, record) {
                        
                   var amount=parseFloat(record.tmd_rate).toFixed(decimal);
                   var tot=parseFloat(record.tmd_total).toFixed(decimal);
                   var item=record.tmd_menu;
                   var  qty=record.tmd_qty;
                   var  type=record.tmd_type;
                  if(record.tmd_description!='' && record.tmd_description!='null' && record.tmd_description!=null){ 
                   var desc=record.tmd_description;
                  }else{
                       var desc='';
                  }
                 
                  if(record.tmd_weight!='' && record.tmd_weight!='null' && record.tmd_weight!=null){ 
                   var  weight=record.tmd_weight;
                  }else{
                       var  weight='';
                  }
                 
                 
                     var tax_value = $("#tax_details").attr('tax_value');
                  
                    var tax_unit = $("#tax_details").attr('tax_unit');
                  
                    adv_tot=parseFloat(adv_tot)+parseFloat(tot);
                    
                    var tax_tot=(adv_tot*tax_value)/100;
                    
                    
                    $("#subtotal_adv_item").text(adv_tot.toFixed(decimal));
                    
                    $("#taxtotal_adv_item").text(tax_tot.toFixed(decimal));
                    
                    $("#total_adv_item").text((tax_tot+adv_tot).toFixed(decimal));
                 
                 
                   // $('#amount').val((tax_tot+adv_tot).toFixed(decimal));
                  
                   if($("#total_adv_item").text()>0){
                      
                       $('.right_side_view').addClass('disable_split_box');
                   }else{
                       
                        $('.right_side_view').removeClass('disable_split_box');
                     }
                  
                  
                  
                 
                 if($('#mode_of_pay').val()!='CREDIT'){
         
                    //$('#amount').val($('#total_adv_item').text());

                    $('#amount').addClass('disablegenerate');

                 }else{

                    // $('#amount').val($('#total_adv_item').text());

                    $('#amount').removeClass('disablegenerate');
                 }
                 
                 
                 
              if($('.append_div_main').find('#del_card' + record.tmd_id).length === 0) {
              $(".append_div_main").append("<div class='add_menu_row' id='second_div_main"+record.tmd_id+"'>"+
                             "<div style='width:46%;position:relative' class='first_form_contain'    >"+
                                "<div class='form_textbox_cc' id='feedback_div'>"+
                                "<input readonly onclick='return search_name_show(event);'    value='" + item + "' onfocus='return search_name_show(event);'  onkeyup='return search_name_show(event);'  type='text' class='form-control ' id='item"+record.tmd_id+"'  autocomplete='off'></div>"+
                               " </div>"+
                        
                                "<div style='width:13%;position:relative' class='first_form_contain'  >"+
                             	"<div class='form_name_cc'></span></div>"+
                               " <div class='form_textbox_cc' id='feedback_div'>"+
                                "<input readonly value='" + weight + "' type='text' class='form-control ' id='weight"+record.tmd_id+"' autocomplete='off' ></div>"+
                                
                               " </div>"+
                        
                        
                        
                        
                              " <div style='width:10%;' class='first_form_contain'>"+
                              " <div   class='form_textbox_cc' id='feedback_div'>"+
                              " <input readonly type='text' value='" + qty + "' onkeypress='return numdot_dot(this,event);' maxlength='7' class='form-control ' id='item_qty"+record.tmd_id+"'  autocomplete='off' >"+
                                   
                                    // "<select disabled='true' style='width:56%;float: right' id='qty_type"+record.tmd_id+"' class='form-control'>"+
                                     //   " <option value='" + type + "'>"+ type +"</option>"+
                                         
                                    //" </select>"+
                                     "</div>"+
                               "</div>"+
                            " <div style='width:12%' class='first_form_contain'>"+
                            "<div class='form_textbox_cc' id='feedback_div'>"+
                           " <input maxlength='7' readonly type='text' class='form-control ' value='" + amount + "' id='item_rate"+record.tmd_id+"'  autocomplete='off' ></div>"+
                           " </div>"+
                           " <div style='width:12%' class='first_form_contain'>"+
                           " <div class='form_textbox_cc' id='feedback_div'>"+
                           " <input type='text' readonly class='form-control ' id='item_total"+record.tmd_id+"' value='" + tot + "'  autocomplete='off' > </div>"+
                          " </div>"+
                          "<div style='margin-top:0px;width: 5%;height: 30px;line-height: 26px;margin-top: 2px;float: left' id='del_card"+record.tmd_id+"' name='del_card"+record.tmd_id+"' class='menut_add_bq_btn' onclick='return deletecard("+record.tmd_id+","+tot+");'><img width='20px' src='img/cancel-icon.png'></div>"+
                          " <div class='first_form_contain'>"+
                          " <div class='form_textbox_cc' id='feedback_div'>"+
                          " <input type='text' readonly  maxlength='100' class='form-control ' value='" + desc + "' id='item_des"+record.tmd_id+"' placeholder='Note'  autocomplete='off' ></div>"+
                          " </div>"+ 
                          " </div>"
                        
              
                    );
                                 
                         }
                         

                         
                     });
                     
                     
                 }
                 
                 });    
                                 
                                 
                                 
                                 
                                }else{
                                    
                        $("#pin_error").css("display","block");
			$("#pin_error").text("NO PERMISSION ");
			$("#pin_error").delay(1500).fadeOut('slow');
                        $("#pin_pay").focus(); 
                        
                                }
                                
                                
                            });
                        }else{
                            
                         $("#pin_error").css("display","block");
			$("#pin_error").text("ENTER YOUR PIN ");
			$("#pin_error").delay(1500).fadeOut('slow');
                        $("#pin_pay").focus();                   
                      }
                        
                        
                        
                    });
                    
                    
    $('#pin_pay').keypress(function(ev){
             if(ev.keyCode == 13){
             ev.stopImmediatePropagation();
             $('.pin_pay_auth').trigger('click');
            }
   });
   
}); 
</script>

<div style="position:fixed;width:100%;left:30%;top:0%;z-index:99999;" class="mynewpopupload"  ></div>
</body>
</html>