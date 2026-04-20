<?php
include('includes/session.php');		// Check session
include("database.class.php"); // DB Connection class
$database	= new Database();
include('includes/master_settings.php');
if(!isset($_SESSION['timeopen']) ){ header("location:index.php?msg=1"); }
?>
<!DOCTYPE HTML>
<html><head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title> Take Away - Staff Assign</title>
<link rel="shortcut icon" href="img/favicon.ico">
<link href="css/bootstrap-cerulean.min.css" rel="stylesheet" />
<link id="main-css" href="css/accord/accordion.css" rel="stylesheet"/>
<link id="main-css" href="css/accord/font-awesome.css" rel="stylesheet"/>
<link href="css/order_new.css" rel="stylesheet" type="text/css">
<link href="css/take_away.css" rel="stylesheet" type="text/css">
<link href="css/take_away_new.css" rel="stylesheet" type="text/css">
<script src="js/jquery-1.10.2.min.js"></script> 
<script src="mn/js/modernizr.custom.js"></script>

<script src="js/staff_assign_detail.js"></script>
<script src="js/takeaway_.js"></script>
  
     <script>
 var len = $('script[src="js/takeaway_.js"]').length;
 if (len === 0) {
    $.getScript('js/takeaway_.js');
}
</script>
 

<script src="js/foodcosting_main.js"></script>

<style>
body{font-family:inherit;background-image: url(img/take_away_bg.jpg) !important;}
.left_contant_container {height: auto;padding-bottom:0}
.tax_table td{  padding-left: 12px;text-align: left;}
/*.tax_textbox {width: 100%;}*/
.discount_text_cc{text-align:center}
.new_right_drop{margin-top:-8px;}
.discount_text_box{height:30px;line-height:24px;}
.top_container{background-color: rgb(4, 29, 51);}
.top_site_map_cc{background-color: rgb(0, 28, 53);}
.take_staff_view_head{background-color: rgb(35, 89, 115);margin-bottom: 0px;border: solid 1px #fff;height:auto}
.cont_staf_view_list{background-color: rgb(16, 51, 68);}
.take_staff_view_cont_cc{background-color: #e2e2e2;height: 325px;min-height: 80vh;padding-top:0px;padding-bottom: 40px;}
.take_staff_view_cc{margin-top: 3px;margin-bottom:0;position:relative}.staf_view_list_hd{line-height:40px;}
 .confrmation_overlay{width:100%;height:100%;position:fixed;z-index:999;background-color:rgba(0,0,0,0.8);top:0;}
.accordion-item.active .accordion-header{background-color:#a59f9f !important;}
.accordion-item:last-child .accordion-header{border:1px #ccc solid}
.staff_ass_centr_address{margin-top:2px;}.staff_ass_center_order_detail_cc{height: 32vh;min-height: 205px;}
.staff_ass_centr_address span{width:68%;}.staff_ass_centr_address strong{width:30%;}
.accordion-content{float: left;width: 100%}
.staff_asign_tab_open_contant_bill_head {    pointer-events: none;}
.highlight{background-color: red }
.zoom-div {
  transition: transform 0.5s ease;
  cursor: pointer;
}

.zoom-div:hover {
  transform: scale(1.15);
}
</style>

</head>

<body>
    
     <input type="hidden"  id="br_del" value="<?=$_SESSION['s_branchname']?>">
    
     <input type="hidden" name="decimal" id="decimal" value="<?=$_SESSION['be_decimal']?>">
     <div class="container-fluid no-padding">
     <?php include"includes/topbar_takeaway.php"; ?>

      <div class="middle_container" style="overflow: hidden ">
      <div style="width:100%" class="top_site_map_cc ">
          <a href="take_away_.php"><div class="backto_table_select" style="float:left;width: 130px;margin-left: 14px;">
                     <div class="backtable_ico"></div>
                     <div style="width: 100px;" class="tableselect_text">TAKEAWAY</div>
           
              </div></a>
          
          
       <?php   if($_SESSION['staff_assign_bypass_hd']=='N'){   ?>
          <a href="take_away_staff_assign.php"><div class="backto_table_select" style="margin-left: 18px;float:left;width: 130px;background-color: lightseagreen">
                    
                     <div style="width: 100px;color: black" class="tableselect_text">STAFF ASSIGN </div>
                     
         </div>
          </a>
          
          <?php } ?>
                             
           
         <a href="ta_bill_history.php"><div class="backto_table_select" style="color: white;margin-left: 18px;float:left;width: 100px;background-color: rgb(35, 89, 115)">
                    
                     <div style="width: 100px;color: white" class="tableselect_text">BILL HISTORY</div>
                     
         </div>
         </a>
          
                             
                             
            	<ul>
					
				</ul>
                <div class="top_al_search_cc loaderror" ></div>
            </div>
            
      		<div style="  min-height:auto;width:100%;height: 85vh" class="left_contant_container">
            
                <div class="take_staff_view_cc">
                	<div class="take_staff_view_head" style="background-color: #bdced5;">
                    		<ul class="tabs">
                                <li style="border-right:2px #bdced5 solid;" class="tab-link staff_detail_left_tab current" data-tab="tab-1">Staff</li>
                                <li class="tab-link staff_detail_left_tab" data-tab="tab-2">Order</li>
                            </ul>
                            
                         <div class="take_staff_view_cont_cc" style="min-height: 79.8vh;">
                         
                            <div id="tab-1" class="tab-content current">
                            
                            	<div class="staffwise_filter_cc">
                                	<div class="staffwise_filter_name">Name</div>
                                    <div class="staffwise_filter_textbox">
                                        <input placeholder="Enter Staff Name" type="text" id="staff_search_txt" onkeyup="search_staff_name()">
                                    </div>
                                </div><!--staffwise_filter_cc-->
                                
                                <div   class="staff_asign_tab_contant_cc" id="load_on_staff_tab">
                                
                                
                                 
                                
                                
                                
                                
                                
                                </div><!--staff_asign_tab_contant_cc-->
                                
                        	</div><!--tab-1-->
                        	<div id="tab-2" class="tab-content">
                            	<div class="staffwise_filter_cc">
                                	<div class="staff_filter_half_cc">
                                            <div  class="staffwise_filter_name">Bill No</div>
                                        <div class="staffwise_filter_textbox">
                                            <input placeholder="Enter Bill No." type="text" id="search_billno" onkeyup="search_bill_no()">
                                        </div>
                                    </div>
                                    <div class="staff_filter_half_cc">
                                        <div class="staffwise_filter_name">Mob No</div>
                                        <div class="staffwise_filter_textbox">
                                            <input placeholder="Enter Mob. No." type="text" id="search_contact_no" onkeyup="search_contact_no()">
                                        </div>
                                    </div>
                                </div><!--staffwise_filter_cc-->
                            			
                                <div class="staff_asign_tab_contant_cc" id="load_on_order_tab">
                                        		
                                           </div>     
                        	</div><!--tab-2-->
                     
                     
                     
                     	
                        
                        </div><!--take_staff_view_cont_cc-->
                        
                        
                    </div><!--take_staff_view_head-->
                    
                    <div class="staff_ass_detail_bottom_cc" style="bottom: 20px;">
                        		<div class="left_inform_cc delay_cc"></div>
                                <div class="left_inform_text ">Delayed</div>
                                <div class="left_inform_cc near_end_cc"></div>
                                <div class="left_inform_text ">Nearing Delivery</div>
                                <div class="left_inform_cc " style="background-color: darkred;width: 15px;height: 15px;
                                  float: left;    margin: 2%;    margin-top: 2.5%; "></div>
    
                              <div class="left_inform_text">No Time</div>
    
                        </div><!--staff_ass_detail_bottom_cc-->
                </div><!--take_staff_view_cc-->
                
                
                
                
                <div class="take_staff_view_cc" >
                    <input type="hidden" value="" id="hdnbillno"/>
                	<div class="take_staff_view_head">
<!--                    	<div style="background-color:#235973" class="staf_view_hd_num"></div>-->
<div style="width:100%" class="staf_view_list_hd">BILL  : <span  id="hdnbillno1"></span></div>
                        
                    </div><!--take_staff_view_head-->
                    <div class="take_staff_view_cont_cc" id="order_details">
                       
                     </div><!--take_staff_view_cont_cc-->
                     
                     
                    
                </div><!--take_staff_view_cc-->
                  
                  
                  
                  
                  <div class="take_staff_view_cc" >
                	<div class="take_staff_view_head">
                    	<div style="  background-color:#235973;" class="staf_view_hd_num"></div>
                        <div class="staf_view_list_hd">Payment</div>
                    </div><!--take_staff_view_head-->
                     <div class="take_staff_view_cont_cc" style="background-color:#fff">
                     	<div class="staff_assdetail_right_contant_bg">
                            
                             <div class="staff_assdetail_right_contant_cc">
                                <div class="staff_assdetail_right_contant_left_name">Amount <span>:</span></div>
                                <div class="staff_assdetail_right_contant_left_name_detail"><div class="staff_assign_center_total_cc" id="amount_payable">0.00</div></div>
                            </div><!--staff_assdetail_right_contant_cc-->
                            <div class="staff_assdetail_right_contant_cc">
                                <div class="staff_assdetail_right_contant_left_name">Payment Status <span>:</span></div>
                                <div class="staff_assdetail_right_contant_left_name_detail">
                                	<a href="#"><div class="staff_assdetail_right_contant_pay_btn" id="staff_detail_settle_pop">Pay</div></a>
                                        <span style="color: green"  id="status_label"><b>SETTLED</b></span>
                                </div>
                            </div><!--staff_assdetail_right_contant_cc-->
                             <div class="staff_assdetail_right_contant_cc">
                                <div class="staff_assdetail_right_contant_left_name">Delivery Status  <span>:</span></div>
                                <div class="staff_assdetail_right_contant_left_name_detail">
                                    <select class="staff_ass_detail_right_stauts_drop" id="drop_status" style="text-transform: uppercase ">
                                        <?php
                                        $sql_del_status = $database->mysqlQuery("select ds_id, ds_name, ds_short_code FROM tbl_delivery_status");
                                        $num_del_status = $database->mysqlNumRows($sql_del_status);
                                        if($num_del_status){
                                            echo '<option value="P">Not Delivered</option>';
                                         while($result_del_status  = $database->mysqlFetchArray($sql_del_status)){
                                             echo '<option value="'.$result_del_status["ds_short_code"].'">'.$result_del_status["ds_name"].'</option>';
                                         }
                                        }
                                 
                                                                                                               
                
                                        ?>
                                            
                                            
                                        <!--<option>Rejected by Customer</option>
                                        <option>Customer not Available</option>
                                        <option>Damaged Item</option>-->
                                    </select>
                                </div>
                                
                                <div class="staff_ass_detail_bottom_cc staff_right_update_btn">
                                    <a href="#"><div class="staff_assdetail_right_contant_btm_update_btn" id="btn_update">Update Status</div></a>
                                </div><!--staff_ass_detail_bottom_cc-->
                                
                                <div class="staff_ass_detail_report_cc" id="load_bottom_report" style="bottom:14px">
                               			
                                       
                                        
                               </div><!--staff_ass_detail_report_cc--> 
                               
                            </div><!--staff_assdetail_right_contant_cc-->
                        </div><!--staff_assdetail_right_contant_bg-->
                     </div><!--take_staff_view_cont_cc-->
                    <!--take_staff_view_cont_cc-->
                                                            
                </div><!--take_staff_view_cc-->
            	                              
                            </div><!--left_contant_container-->
                    
              </div><!--middle_container-->          
</div><!--container_fluide-->

<div class="settle_popup_in_take_away">
    <div class="settle_popup_in_take_away_head">Bill Details -<span id="billdetails"></span></div>
    <div style="margin:0;text-align:left" class="discount_text_cc">Payment Details<div class="payment_pend_right_cash_error"></div></div>
 
        <div class="settle_popup_in_take_away_contant_cc">
    	<div class="settle_popup_in_take_away_mode_sel_btn_cc">
<!--        	<div id="cash" class="pop_payment_mode_sel_btn  mode_sel_btn_act ">Cash</div>
            <div id="credit" class="pop_payment_mode_sel_btn ">Credit / Debit Card</div>
            <div id="complimentary" class="pop_payment_mode_sel_btn ">Complimentary</div>-->
            
            
             <?php
						$sql_ds_nos12 = "select * from tbl_paymentmode WHERE pym_active='Y' and pym_takeaway_view='Y'";
						$sql_ds12 = $database->mysqlQuery($sql_ds_nos12);
						$num_ds12 = $database->mysqlNumRows($sql_ds12);
						if ($num_ds12) {
							$i2 = 1;
							while ($result_ds1 = $database->mysqlFetchArray($sql_ds12)) {
								
       					 ?>
                             
                       <div id="<?= $result_ds1['pym_code'] ?>" idval="<?= $result_ds1['pym_id'] ?>" class="pop_payment_mode_sel_btn  <?php if ($i2 == 1) { ?> mode_sel_btn_act <?php } ?>"><?= $result_ds1['pym_name']//$result_ds['pym_name'] ?></div>
                       
                        <?php $i2++;
								
							  }
						  } ?>
            
            
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
                                                                                          
                                               <?php
									$sql_ds_nos="select * from tbl_bankmaster where bm_active='Y' ";
									$sql_ds  =  $database->mysqlQuery($sql_ds_nos); 
									$num_ds = $database->mysqlNumRows($sql_ds);
									if($num_ds){ 
									 while($result_ds = $database->mysqlFetchArray($sql_ds)) 
											{
										?>    
                                       <option value="<?=$result_ds['bm_id']?>"><?=$result_ds['bm_name']?></option>
                                      <?php } } ?>
                                                 
                                          </select>
                                    </div>
                               </div>
                         
                        
                           <!--selecting_payment_cc-->
                               
                               <div class="selecting_payment_cc">
                                    <div class="selecting_payment_one">
                                        <div class="lable_counter_paymnet_cc counter_right_lable">Transaction Amount</div>
                                        <input type="hidden" name="pending" id="paymentmsg1" value="Add Complimentary Remarks">
                                                    <input type="hidden" name="pending" id="paymentmsg2" value="Bill Re-Printed">
                                                  <input type="hidden" name="pending" id="paymentmsg3" value="Select Staff">
                                                    <input placeholder="Enter Transaction Amount" class="tax_textbox transa_txt counter_text_box" name="transcationid" id="transcationid" onchange="transamountchange()" onkeyup="transamountchange(event)">
                                        <!--<input placeholder="Amount" class="tax_textbox transa_txt counter_text_box">-->
                                    </div>
                               </div>
                              
                               <!--selecting_payment_cc-->
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
                                        <input placeholder="Enter Coupon Amount" class="tax_textbox transa_txt counter_text_box" name="coupamount" id="coupamount" onchange="couponamountchange()" onkeyup="couponamountchange(event)">
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
                                        <input placeholder="Enter Cheque Amount" class="tax_textbox transa_txt counter_text_box" name="cheqamount" id="cheqamount" onchange="cheqamountchange()" onkeyup="cheqamountchange(event)">
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
                                            <input placeholder="Enter Paid Amount" class="tax_textbox transa_txt counter_text_box" id="paidamount_credit" name="paidamount_credit" onchange="enterbalance_credit()" onkeyup="enterbalance_credit(event)" value="">
                                        </div>
                                     </div><!--selecting_payment_cc-->
                                      <div class="selecting_payment_cc">
                                        <div class="selecting_payment_one">
                                            <div class="lable_counter_paymnet_cc counter_right_lable">Balance Amount</div>
                                           <!-- <input placeholder="Balance" class="tax_textbox transa_txt counter_text_box">-->
                                            <input placeholder="Enter Balance Amount" class="tax_textbox transa_txt counter_text_box" id="balanceamout_credit" name="balanceamout_credit" value="" readonly="">
                                        </div>
                                     </div><!--selecting_payment_cc-->
                                  
                                  </div><!--paid_amount_cc_credit-->
                                  
                                  <div class="credit_type" style="display: none;">
                            			<div class="discount_text_cc crd_head">Credit Type</div>
                                        <div class="selecting_payment_cc">
                                        <div class="selecting_payment_one">
                                            <div class="lable_counter_paymnet_cc counter_right_lable">Select</div>
                                                 <select class="staff_menu_select counter_text_box" name="selectcreditypes" id="selectcreditypes">
                                                               <option value=""><?=$_SESSION['payment_pending_credit_selectlist']?></option>
                    <?php
                    //`tbl_credit_types`(`ct_creditid`, `ct_credit_type`, `ct_active`)
                    $sql_ds_nos = "select * from tbl_credit_types where ct_active='Y' ";
                    $sql_ds = $database->mysqlQuery($sql_ds_nos);
                    $num_ds = $database->mysqlNumRows($sql_ds);
                    if ($num_ds) {
                        while ($result_ds = $database->mysqlFetchArray($sql_ds)) {
                            ?>    

                                       <option value="<?= $result_ds['ct_creditid'] ?>" label="<?=$result_ds['ct_labels'] ?>"><?=$result_ds['ct_credit_type']// $result_ds['ct_credit_type'] ?></option>

                                                <?php }
                                            } ?> 
                                                </select>
                                        </div>
                                     </div><!--selecting_payment_cc-->
                                     
               <input type="hidden" name="focusedtext" id="focusedtext" >                       
                                		
                                
                                
                                <div class="crd_select_head_cc credtitypeloads" id="crtype_div">
                                    
                                </div>
                                    <textarea class="credit_remarks_cc" id="credit_remark_hd" name="credit_remark_hd" placeholder="Remarks"></textarea>
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
                                        <input placeholder="Enter Balance Amount" class="tax_textbox transa_txt counter_text_box" id="paidamount" name="paidamount" onchange="enterbalance(event)"  onkeyup="enterbalance(event)" onclick="enterbalance(event)" value="">
                                    </div>
                                 </div><!--selecting_payment_cc-->
                                 <div class="selecting_payment_cc">
                                    <div class="selecting_payment_one">
                                        <div class="lable_counter_paymnet_cc counter_right_lable">Balance Amount</div>
                                        <!--<input placeholder="Balance Amount" class="tax_textbox transa_txt counter_text_box">-->
                                         <input placeholder="Enter Paid Amount" class="tax_textbox transa_txt counter_text_box" id="balanceamout" name="balanceamout" value="" readonly="">
                                    </div>
                                 </div><!--selecting_payment_cc-->
                                 
                            </div><!--paid_amount_cc-->
                            
                            </div>
              <div style="width:100%;float:left;">
                                <div class="popup_bottom_tax_detail" id="taxdetails_div" style="width:50%;padding-right: 3%;float: left">
                                    
                                 </div>
                                 <div class="popup_bottom_tax_detail" style="width:50%;float:right;padding-right: 3%;">
                                    
                                    <div style="width:100%" class="lable_counter_paymnet_cc counter_right_lable">Discount :<span id="totaldisc"></span></div>
                                    <div style="width:100%" class="lable_counter_paymnet_cc counter_right_lable"><strong>Sub Total :<span id="final"></span><span></span></strong></div>
                                </div>
                            </div>
                            <div style="width:100%;display:block;font-size:22px;text-align: right;padding-top:8px;padding-right: 3%;" class="lable_counter_paymnet_cc counter_right_lable"><strong>Total :<span id="grandtotal"></span></strong></div>
                            
                            <div class="right_bottom_button_cc">
                                <div style="width:30%;float:right;" class="tka_sum_btn_cc">
                                    <a class="tka_submit_buton submittranscations" id='payment_settle' style="cursor:pointer">Settle</a>
                                </div>
                                <div id="payment_close" class="bottom_btn_cc settle_print_btn" style="width:auto;"><a href="#" class="skip_on_settle"><div style="" class="counter_right_payment_button" id="skip_text">Close</div></a></div>
                               
                                <!--<div style="width:30%;float:left;" class="tka_sum_btn_cc">
                                    <a class="tka_submit_buton settle_popup_close" style="cursor:pointer" href="#">Close</a>
                                </div>-->
                                
                           </div>
                            <div class="counter_settle_popup_right_calc_cc" <?php if($_SESSION['counter_default_settle_touchpad']=="Y") { ?> style="display:block" <?php } ?>>
                       
                       		<div class="counter_pop_left_portion" style="height:auto">
<!--            calculator-->
                            <div class="keys settle_key">
                                <span class="calculator_settle">1</span>
                                <span class="calculator_settle">2</span>
                                <span class="calculator_settle">3</span>
                                <span class="calculator_settle">4</span>
                                <span class="calculator_settle">5</span>
                                <span class="calculator_settle">6</span>
                                <span class="calculator_settle">7</span>
                                <span class="calculator_settle">8</span>
                                <span class="calculator_settle">9</span>
                                <span class="calculator_settle">0</span>
                                <span class="calculator_settle">.</span>
                                <span class="calculator_settle">Clear</span>
                                <!--<span class="calculator_settle">Enter</span>-->
                            </div>
            	
           				 </div>
                       
                       </div>
                             
    </div><!--settle_popup_in_take_away_contant_cc-->
</div>

<!-----settle_popup_in_take_away----->

<div style="display:none;" class="confrmation_overlay"></div>



 
 
 

<script src="js/jquery-1.10.2.min.js"></script> 
<script type="text/javascript" src="js/accordion.js"></script>
<script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<script src="js/jquery.cookie.js"></script> 


<script>
$(document).ready(function(){
    
    
    $(document).on('change', '#check_all_del', function () {
              // alert('rrt');
      $('.check_all_del').not(this).prop('checked', false);
      
             var stf=$(this).attr('stf');

             if ($(this).is(':checked')) {
                
                $('[class^="check_all_del2_"]').prop('checked', false);
                
                 $('.check_all_del2_'+stf).prop('checked', true);
            } else {
                 $('.check_all_del2_'+stf).prop('checked', false);
            }
            
     });

    
     
    
       //LOAD STAFF//
    
        var staffid = "";
        var dataString = 'value=load_staff&staff='+staffid+'&billno='+billno ;
        $.ajax({
            type: "POST",
            url: "load_staff_assign_detail.php",
            data: dataString,
            success: function(data) {
                $('#load_on_staff_tab').html(data);

            }
        });

        //---------///
       //LOAD ORDER///
        var billno = "";
        var billno_search = '';
        var contactno = '';
        var dataString = 'value=load_order&billno='+billno+'&billno_search='+billno_search+'&contactno='+contactno ;
        $.ajax({
            type: "POST",
            url: "load_staff_assign_detail.php",
            data: dataString,
            success: function(data) {
                $('#load_on_order_tab').html(data);

            }
        });

        //---------
        
        $('#staff_detail_settle_pop').hide();
        $('#status_label').hide();
        $('#btn_update').hide();
   
   var auto_refresh = setInterval(
    function ()
    { 
        //LOAD STAFF
        var name = $('#staffname').val();
        var billno = $('.staff_asign_tab_open_contant_bill_cc_act').attr("billnobystaff");
        var staffid = $('.active').attr('id');
        var dataString = 'value=load_staff&staff='+name+'&billno='+billno+'&staffid='+staffid ;
        $.ajax({
            type: "POST",
            url: "load_staff_assign_detail.php",
            data: dataString,
            success: function(data) {
                
                $('#load_on_staff_tab').html(data);
                var bill = $('#billnobystaff').val();
               
                    var stfid = $('#staffid').val();
                    $('#'+stfid+'').addClass('active');
                    var billno1 = $('#billnobystaff').val();
                    //$('#'+billno1+'').addClass('staff_asign_tab_open_contant_bill_cc_act');
                    $('[billnobystaff='+billno1+']').addClass('staff_asign_tab_open_contant_bill_cc_act');
                    $('#cntnt_'+stfid+'').css("display","block");
            }
        });

        //---------
         //LOAD ORDER
        var billno_search = $('#billno_search').val();
        var contactno = $('#contactno_search').val();
        var billno = $('.staff_asign_tab_open_contant_bill_cc_act').attr("billnobyorder");
        var dataString = 'value=load_order&billno='+billno+'&billno_search='+billno_search+'&contactno='+contactno ;
        $.ajax({
            type: "POST",
            url: "load_staff_assign_detail.php",
            data: dataString,
            success: function(data) {
                $('#load_on_order_tab').html(data);
                var bill = $('#billno').val();
                $('[billnobyorder='+bill+']').addClass('staff_asign_tab_open_contant_bill_cc_act');
               
            }
        });

        //---------
    }, 10000000000); // refresh every 20000 milliseconds
    
        //BOTTOM REPORT
        
        var dataString = 'value=bottom_report';
        $.ajax({
            type: "POST",
            url: "load_staff_assign_detail.php",
            data: dataString,
            success: function(data) {
                $('#load_bottom_report').html(data);

            }
        });

    ///---------///
        
    var auto_refresh = setInterval(
    function ()
    {
        //BOTTOM REPORT
        
        var dataString = 'value=bottom_report';
        $.ajax({
            type: "POST",
            url: "load_staff_assign_detail.php",
            data: dataString,
            success: function(data) {
                $('#load_bottom_report').html(data);

            }
        });

        //---------
    }, 15000000000); // refresh every 20000 milliseconds
    
    
	$('ul.tabs li').click(function(){
		var tab_id = $(this).attr('data-tab');

		$('ul.tabs li').removeClass('current');
		$('.tab-content').removeClass('current');

		$(this).addClass('current');
		$("#"+tab_id).addClass('current');
	});
	

	$('#payment_close').click(function(){
		$(".settle_popup_in_take_away").css("display","none");
		$(".confrmation_overlay").css("display","none");
	});
	
	
});

function reprint_del_bill(bill){
    
    var check = confirm("CONFIRM PRINT ?");
	if(check==true)
	{
            
            
		var dataString = "set=reprint_ta_new&homed=HD&billno="+bill;
                
		$.ajax({
		type: "POST",
		url: "print_details.php",
		data: dataString,
		success: function(data2) {
                 
                }
            });
            
           
       }     
    
    
}



function hgt(bill){
    
    
   $('.hgt_cls').css('border','');
   
   $('.hgt_cls_'+bill).css('border','solid 3px grey');
   
  // $('.hgt_cls').addClass('zoom-div'); 
  
    
}

function select_all_in_one(staff){ 
    
    setTimeout(function () {
        $('#cntnt_'+staff+'').css("display","block");
    }, 250);
     
}

function submit_all_in_one(staff){
    
    setTimeout(function () {
       $('#cntnt_'+staff+'').css("display","block");
    }, 250);
    
    var type=$("#type_del_all_"+staff).val();
    
    
     
    var all_id=new Array();
    $('.check_all_del2_'+staff).each(function(){
       
    if($(this).prop('checked') == true){
   
    var all=$(this).attr('bill_one');
    
    all_id.push(all);
   
    }
   
    });
       
    var allid=all_id.join(','); 
    
    
     if(type!=''){
         
      if(allid!=''){    
         
    
    if(type=='D'){
        
       var confirm1=confirm("CONFIRM DELIVER ALL THE BILLS SELECTED ? ");
    
    }else if(type=='S'){
        
      var confirm1=confirm("CONFIRM SETTLE ALL THE BILLS SELECTED IN CASH ? ");   
        
    }else{
        
      var confirm1=confirm("CONFIRM DELIVER ALL & SETTLE ALL THE BILLS SELECTED IN CASH ? ");  
        
    }
   

    if(confirm1===true){
        
         var datastring = "value=settle_all_by_mode&staff="+staff+"&bills="+allid+"&type="+type;
          
         $.ajax({
            type: "POST",
            url: "load_staff_assign_detail.php",
           
            data: datastring,
            success: function (data)
            { 
               location.reload();
            }
        });
    }
    
    }else{
            
             $('.alert_error_popup_all_in_one').show();                                  
             $('.alert_error_popup_all_in_one').text('SELECT BILLS');
             $('.alert_error_popup_all_in_one').delay(1000).fadeOut('slow');       
            
    }
    
    
     }else{
         
         
             $('.alert_error_popup_all_in_one').show();                                  
             $('.alert_error_popup_all_in_one').text('SELECT TYPE');
             $('.alert_error_popup_all_in_one').delay(1000).fadeOut('slow');  
     }
}



function settle_all_new_btn(staff){
    
    var confirm1=confirm("CONFIRM ALL BILL SETTLEMENT AS CASH METHOD?");
    if(confirm1===true){
         var datastring = "value=settle_all_by_staff&staff="+staff;
          
        $.ajax({
            type: "POST",
            url: "load_staff_assign_detail.php",
           
            data: datastring,
            success: function (data)
            { 
             location.reload();
            }
        });
    }
    
}


function settle_one(bill){
    
    var confirm1=confirm("CONFIRM ORDER DELIVERED & BILL SETTLEMENT AS CASH METHOD ?");
    if(confirm1===true){
         var datastring = "value=settle_all_by_one&bill="+bill;
          
        $.ajax({
            type: "POST",
            url: "load_staff_assign_detail.php",
           
            data: datastring,
            success: function (data)
            { 
                location.reload();
            }
        });
    }
    
}



    function deliver_one(bill,num,name){

        var confirm1=confirm("CONFIRM ORDER DELIVERY ?");
        if(confirm1===true){
             var datastring = "value=deliver_all_by_one&bill="+bill;

             var br_del=$('#br_del').val();
                
            var url="https://wa.me/"+num+"?text= Hi "+name+" , Your order ("+bill+") has been delivered .Thankyou for Ordering from "+br_del+".";  

                 $.ajax({
                type: "POST",
                url: "load_staff_assign_detail.php",

                data: datastring,
                success: function (data)
                { 
                     // window.open(url, '_blank'); 

                      location.reload();

                }
            });
        }

    }


function deliver_all_new_btn(staff){
    
    var confirm1=confirm("CONFIRM ALL DELIVERY ?");
    if(confirm1===true){
         var datastring = "value=deliver_all_by_staff&staff="+staff;
          
        $.ajax({
            type: "POST",
            url: "load_staff_assign_detail.php",
           
            data: datastring,
            success: function (data)
            { 
             location.reload();
            }
        });
    }
    
}

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
                                        $("#transcationid").val("");
                                        $("#transbal").val("");
                                                 $("#paidamount").val("");
                                        $("#balanceamout").val("");
                                        $('#selectcreditdetails').hide();
                                         $('#amount_credit').hide();
                                          $('.room_no_txt').hide();
                                        
                                        
                                        
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
                                                $("#paidamount").val("");
                                        $("#balanceamout").val("");
                                         $("#transcationid").val("");
                                        $("#transbal").val("");
                                        $('#selectcreditdetails').hide();
                                         $('#amount_credit').hide();
                                          $('.room_no_txt').hide();
                                        
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
                                        $('#cheqamount').val('');
                                         $('#cheqbal').val('');
                                         $("#paidamount").val("");
                                        $("#balanceamout").val("");
                                        $('#selectcreditdetails').hide();
                                         $('#amount_credit').hide();
                                          $('.room_no_txt').hide();
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
                                        $('#paidamount_credit').val('');
                                         $('#paidamount_credit').focus();
                                          $('#balanceamout_credit').val('');
                                          $("#paidamount").val("");
                                        $("#balanceamout").val("");
                                        $('#selectcreditdetails').hide();
                                         $('#amount_credit').hide();
                                          $('.room_no_txt').hide();
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
                                        $('#completext').val('');
                                        $('#completext').focus();
                                        $('#selectcreditdetails').hide();
                                         $('#amount_credit').hide();
                                          $('.room_no_txt').hide();
		});
                
		
          
	/***************************************  credit types ends **********************************************************  */
       </script> 


</body>
</html>