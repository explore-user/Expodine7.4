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
<title> Take Away</title>
<link rel="shortcut icon" href="img/favicon.ico">
<link href="css/bootstrap-cerulean.min.css" rel="stylesheet" />
<link href="css/order_new.css" rel="stylesheet" type="text/css">
<link href="css/take_away.css" rel="stylesheet" type="text/css">
<script src="js/jquery-1.10.2.min.js"></script> 
<script src="mn/js/modernizr.custom.js"></script>

<!--ESC Key press starts-->
    <script type="text/javascript">
	$(document).ready(function() 
	{
		document.onkeydown = function(evt) {
			evt = evt || window.event;
			if (evt.keyCode == 27) {//esc key press
				$('.close_btn_validate').click();
			}
		};
		
	});
	
	</script>
      <!--ESC Key press ends-->
      
      <script>
//function isKeyPressed(event) {
	$(document).ready(function(event) 
	{
    $(document).keydown(function (e) {
    if (e.keyCode == 16) {// shift key press to select staff names
       // alert(e.which + " or Shift was pressed");
	   if($('.ta_staffeachselect').hasClass("staf_view_act"))
	   {
		 var tot=($('#hidtot').val()) - 1;
		 var tab=$('.staf_view_act').attr('tabindex');
		 tab++;
		 if(tab>tot) tab=1;
		 $('.ta_staffeachselect').filter("[tabindex="+tab+"]").click();
		 $('#ta_listorderdetails').empty();
		$('.ta_totalcash').empty();
		$('.ta_totalcashtopay').empty();
		$('#ta_bildeatils').css("display",'none');
		$('#ta_submitbutton').css("display",'none');
	   }else
	   {
			$('.ta_staffeachselect').filter("[tabindex='1']").click();
			$('#ta_listorderdetails').empty();
			$('.ta_totalcash').empty();
			$('.ta_totalcashtopay').empty();
			$('#ta_bildeatils').css("display",'none');
			$('#ta_submitbutton').css("display",'none');
	   }
    }
	if (e.keyCode == 39) {//right arrow press to chnage the order lists
       // alert(e.which + " or Shift was pressed");
	   if($('.ta_stafeachitemselection').hasClass("order_detail_active"))
	   {
		 var tot=($('#hidtot2').val()) - 1;
		 var tab=$('.order_detail_active').attr('tabsel');
		 tab++;
		 if(tab>tot) tab=1;
		 $('.ta_stafeachitemselection').filter("[tabsel="+tab+"]").click();
	   }else
	   {
			$('.ta_stafeachitemselection').filter("[tabsel='1']").click();
	   }
    }
	if (e.keyCode == 38) {//up arrow press to chnage the mode of payment
	$('#ta_payemntmode').focus();
	
	
	}
	
	});
	});
//}
</script>
 <script src="js/takeaway_bill_new.js"></script>

<style>
body{font-family:inherit;background-image: url(img/take_away_bg.jpg) !important;}
.left_contant_container {height: 84vh}	
.tax_table td{  padding-left: 12px;text-align: left;}
.tax_textbox {width: 100%;}
.discount_text_cc{text-align:center}
.new_right_drop{margin-top:-8px;}
.discount_text_box{height:30px;line-height:24px;}
.top_container{background-color: rgb(4, 29, 51);}
.top_site_map_cc{background-color: rgb(0, 28, 53);}
.take_staff_view_head{background-color: rgb(35, 89, 115);}
.cont_staf_view_list{background-color: rgb(16, 51, 68);}
.take_staff_view_cont_cc{background-color: rgba(6, 24, 39, 0.69);}
</style>

</head>

<body>
<div class="olddiv1 "></div>
<div class="container-fluid no-padding">
     <?php include"includes/topbar_takeaway.php"; ?>
 <input type="hidden" name="hidcompmangauth" id="hidcompmangauth" value="<?=$_SESSION['s_compl_manage_auth']?>">

      <div class="middle_container">
      <div style="width:100%" class="top_site_map_cc ">
            	<ul>
					<!--<li><a href="index.php" title=""><span class="home_icon"></span>\</a></li>-->
					<li><a title="">Staff Listing</a></li>
				</ul>
                <div class="top_al_search_cc loaderror" ></div>
               <!-- <div class="top_al_search_cc">
                	 <span style="width: 80%;float: right;"><input class="search" placeholder="Search Code" name="search" type="text"></span>
                </div>-->
            </div>
      		<div style="  min-height:480px;width:100%" class="left_contant_container">
            	
                <div class="take_staff_view_cc">
                	<div class="take_staff_view_head">
                    	<div style="  background-color:#9B0505" class="staf_view_hd_num">1</div>
                        <div class="staf_view_list_hd">Staff View</div>
                    </div><!--take_staff_view_head-->
                    <div class="take_staff_view_cont_cc">
                    
                     <?php
					  $i=1;
		    $sql_ds_nos="select ser_staffid,ser_firstname,ser_mobileno from tbl_staffmaster where ser_designation='".$_SESSION['desgn_deliveryboy']."' AND  ser_employeestatus='Active'";//EX-DES-18
			$sql_ds  =  $database->mysqlQuery($sql_ds_nos); 
			$num_ds = $database->mysqlNumRows($sql_ds);
			if($num_ds){
			 while($result_ds = $database->mysqlFetchArray($sql_ds)) 
					{ ?>
                    	<div class="cont_staf_view_list ta_staffeachselect" staffid="<?=$result_ds['ser_staffid']?>" tabindex="<?=$i?>">
                        	<div class="staf_view_hd_num"><?=$i++?></div>
                            <div style="width: 85%;" class="staf_name_1">
                            	<span style="max-width: 197px;float: left;"><?=$result_ds['ser_firstname']?></span>
                                <div style="width: 45%;text-align: center;" class="staf_num_detail">Mob : <?=$result_ds['ser_mobileno']?></div> 
                            </div>
                        </div><!--cont_staf_view_list-->
                   <?php } } ?>     
                      
                    <input type="hidden" name="hidtot" id="hidtot" value="<?=$i?>">  
                    <input type="hidden" name="hidtot2" id="hidtot2" >      
                        
                    </div><!--take_staff_view_cont_cc-->
                </div><!--take_staff_view_cc-->
                
                <div class="take_staff_view_cc">
                	<div class="take_staff_view_head">
                    	<div style="  background-color:#9B0505;" class="staf_view_hd_num">2</div>
                        <div class="staf_view_list_hd">Order Details</div>
                    </div><!--take_staff_view_head-->
                  <div class="take_staff_view_cont_cc">
                      <div class="center_staf_detail_cc" id="ta_listorderdetails">
                      
                        
                          
                      </div><!--center_staf_detail_cc--->
                       <div class="bottom_rate_contantant_cc">
                       		<div class="center_bottom_right"><strong>Total Rate : <span class="ta_totalcash"></span>/-</strong></div>
                       </div><!--bottom_rate_contantant_cc-->
                  </div><!--take_staff_view_cc-->
                  </div><!--take_staff_view_cont_cc-->
                
                <div class="take_staff_view_cc">
                	<div class="take_staff_view_head">
                    	<div style="  background-color:#9B0505;" class="staf_view_hd_num">3</div>
                        <div class="staf_view_list_hd">Bill Details</div>
                    </div><!--take_staff_view_head-->
                    <div class="take_staff_view_cont_cc">
                    	<div class="right_top_total_rate">Total Rate : <span class="ta_totalcashtopay" id="ta_loadtakbillamount"></span>/-</div>
                        <div style="height: 455px;min-height: 61.5vh; display:none" class="take_oder_right_detail" id="ta_bildeatils" >
                        
                	<div class="discount_text_box">
                       <table class="tax_table" width="100%" border="0" cellspacing="5">
                       		<tr>
                            	<td width="45%">Select Payment</td>
                                <td width="5%">:</td>
                                <td width="50%">
                                  <select style="width:100%; color:#000" class="discount_text_box tax_textbox" id="ta_payemntmode">
                                  <option value="" selected>Select Payment</option>
                                    <?php
								  $sql_ds_nos="select * from tbl_paymentmode WHERE pym_takeaway_view='Y'";
								  $sql_ds  =  $database->mysqlQuery($sql_ds_nos); 
								  $num_ds = $database->mysqlNumRows($sql_ds);
								  if($num_ds){ $i=1;
								   while($result_ds = $database->mysqlFetchArray($sql_ds)) 
										  { ?>
										  <option  value="<?=$result_ds['pym_code']?>" idval="<?=$result_ds['pym_id']?>" <?php if($i==1){ ?> selected <?php } ?>><?=$result_ds['pym_name']?></option>
									  <?php $i++;} }  ?>
                                  </select>
                                  <input type="hidden" name="deltval" id="deltval" value="take_away_staff.php">
                                </td>
                            </tr>
                       
                       </table>
                         
                       </div>
                        <div class="cash_cc">
                            <div class="discount_text_cc crd_head">Cash</div>
                            </div>
                        
                        	<div class="credit_cc_normal" style="display: none;">
                            <div class="discount_text_cc crd_head">Credit / Debit</div>
                            	<table class="tax_table" width="100%" border="0" cellspacing="5">
                              <tbody>
                               <tr>
                                <td width="35%">Transaction Bank</td>
                                <td width="5%">:</td>
                                <td width="50%"><div class="discount_text_box paymod_text_box">
                                        <select id="bankdetails" class=" discount_text_box tax_textbox" style="color:#000">
                                        <option value="">Bank Name</option>
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
                                    </div></td>
                              </tr>
                              
                              <tr>
                                <td width="35%">Transaction Amount</td>
                                <td width="5%">:</td>
                                <td width="50%"><div class="discount_text_box paymod_text_box">
                                        <input placeholder="Amount" class="tax_textbox transa_txt" name="transcationid" id="transcationid" onChange="transamountchange()" style=" color:#000">
                                    </div></td>
                              </tr>
                              <tr>
                                <td width="45%">Balance to Pay</td>
                                <td width="5%">:</td>
                                <td width="50%"><div class="discount_text_box paymod_text_box">
                                        <input placeholder="Balance" class="tax_textbox transa_txt" name="transbal" id="transbal" style=" color:#000">
                                    </div></td>
                              	</tr>
                             </tbody></table> 	
                            </div><!--credit_cc-->
                            <div class="coupon_cc" style="display: none;">
                            	 <div class="discount_text_cc crd_head">Coupons</div>
                            	<table class="tax_table" width="100%" border="0" cellspacing="5">
                             	 <tbody><tr>
                                <td width="45%">Coupon Name</td>
                                <td width="5%">:</td>
                                <td width="50%"><div class="discount_text_box paymod_text_box">
                                        <select class="tax_textbox" name="coupnsel" id="coupnsel" style=" color:#000">
                                        <option value="">Select Coupon</option>
                                       <?php
									  //`tbl_couponcompany`(`cy_companyname`, `cy_active`, `cy_startdate`)
									  $sql_ds_nos="select * from tbl_couponcompany where cy_active='Yes' and cy_startdate <= '".$_SESSION['date']."' ";
									  $sql_ds  =  $database->mysqlQuery($sql_ds_nos); 
									  $num_ds = $database->mysqlNumRows($sql_ds);
									  if($num_ds){ 
									   while($result_ds = $database->mysqlFetchArray($sql_ds)) 
											  {
										  ?>    
                                       <option value="<?=$result_ds['cy_companyname']?>"><?=$result_ds['cy_companyname']?></option>
                                      
                                      <?php } } ?>

                                        </select>
                                    </div></td>
                              	</tr>
                                 <tr>
                                <td width="45%">Coupon Amount</td>
                                <td width="5%">:</td>
                                <td width="50%"><div class="discount_text_box paymod_text_box">
                                        <input placeholder="Coupon Amount" class="tax_textbox transa_txt" name="coupamount" id="coupamount" onChange="couponamountchange()" onkeypress="if(event.keyCode=='13')return totamountfocus()" style=" color:#000">
                                    </div></td> 
                              	</tr>
                                <tr>
                                <td width="45%">Balance to Pay</td>
                                <td width="5%">:</td>
                                <td width="50%"><div class="discount_text_box paymod_text_box">
                                        <input placeholder="Balance" class="tax_textbox transa_txt" name="coupbal" id="coupbal" style=" color:#000">
                                    </div></td>
                              	</tr>
                             </tbody></table> 
                            </div><!--coupon_cc-->
                            <div class="voucher_cc" style="display: none;">
                            	 <div class="discount_text_cc crd_head">Voucher</div>
                            	<table class="tax_table" width="100%" border="0" cellspacing="5">
                              <tbody><tr>
                                <td width="45%">Voucher ID</td>
                                <td width="5%">:</td>
                                <td width="50%"><div class="discount_text_box paymod_text_box">
                                 <input placeholder="Voucher ID" class="tax_textbox transa_txt" name="vouchid" id="vouchid" style=" color:#000">
                                    </div></td>
                              </tr>
                              <tr>
                                <td width="45%">Voucher Amount</td>
                                <td width="5%">:</td>
                                <td width="50%"><div class="discount_text_box paymod_text_box">
                                        <input placeholder="Voucher Amount" class="tax_textbox transa_txt" name="vocamount" id="vocamount" readonly  style=" color:#000">
                                    </div></td> 
                              	</tr>
                              <tr>
                                <td width="45%">Balance to Pay</td>
                                <td width="5%">:</td>
                                <td width="50%"><div class="discount_text_box paymod_text_box">
                                        <input placeholder="Balance" class="tax_textbox transa_txt" name="vouchbal" id="vouchbal" style=" color:#000">
                                    </div></td>
                              	</tr>
                             </tbody></table> 
                            </div><!--voucher_cc-->
                            
                            <div class="cheque_cc" style="display: none;">
                             <div class="discount_text_cc crd_head">Cheque</div>
                            	<table class="tax_table" width="100%" border="0" cellspacing="5">
                              <tbody><tr>
                                <td width="45%">Cheque No</td>
                                <td width="5%">:</td>
                                <td width="50%"><div class="discount_text_box paymod_text_box">
                                        <input placeholder="Cheque No" class="tax_textbox transa_txt" name="cheqname" id="cheqname" style=" color:#000">
                                    </div></td>
                              </tr>
                               <tr>
                                <td width="45%">Bank Name</td>
                                <td width="5%">:</td>
                                <td width="50%"><div class="discount_text_box paymod_text_box">
                                        <input placeholder="Bank Name" class="tax_textbox transa_txt" name="cheqbank" id="cheqbank" style=" color:#000">
                                    </div></td>
                              </tr>
                              <tr>
                                <td width="45%">Amount</td>
                                <td width="5%">:</td>
                                <td width="50%"><div class="discount_text_box paymod_text_box">
                                        <input placeholder="Cheque Amount" class="tax_textbox transa_txt" name="cheqamount" id="cheqamount" onChange="cheqamountchange()" style=" color:#000">
                                    </div></td>
                              </tr>
                               <tr>
                                <td width="45%">Balance to Pay</td>
                                <td width="5%">:</td>
                                <td width="50%"><div class="discount_text_box paymod_text_box">
                                        <input placeholder="Balance" class="tax_textbox transa_txt" name="cheqbal" id="cheqbal" style=" color:#000">
                                    </div></td>
                              	</tr>
                             </tbody></table> 	
                            </div><!--cheque_cc-->
                            
                            <div class="paid_amount_cc_credit">
                    		<table class="tax_table" width="100%" border="0" cellspacing="5">
                             	 <tbody>
                                     <tr>
                                    <td width="45%">Paid Amount</td>
                                    <td width="5%">:</td>
                                    <td width="50%"><div class="discount_text_box paymod_text_box">
                                            <input placeholder="Paid Amount" class="tax_textbox transa_txt" name="paidamount_credit" id="paidamount_credit" onChange="enterbalance_credit()" onkeypress="if(event.keyCode=='13')return enterbalance()" style=" color:#000">
                                        </div></td>
                                    </tr>
                                     <tr>
                                    <td width="45%">Balance Amount</td>
                                    <td width="5%">:</td>
                                    <td width="50%"><div class="discount_text_box paymod_text_box">
                                            <input placeholder="Balance Amount" class="tax_textbox transa_txt" name="balanceamout_credit" id="balanceamout_credit" onkeypress="if(event.keyCode=='13')return submitform()" style=" color:#000">
                                        </div></td>
                                    </tr>
                            	 </tbody>
                             </table> 
                    	</div>
                            
                            
                            
                            <div class="credit_type" style="display: none;">
                            	<div class="discount_text_cc crd_head">Credit Types</div>
                                	<div class="crd_select_head_cc">
                                    <table class="tax_table" width="100%" border="0" cellspacing="5">
                                      <tbody>
                                      <tr style="border-bottom:1px rgba(204, 204, 204, 0.12) solid">
                                        <td width="45%">Select :</td>
                                        <td width="5%">:</td>
                                        <td width="50%"><div class="discount_text_box paymod_text_box">
                                                 <select class=" tax_textbox"  style="color:#000" name="selectcreditypes" id="selectcreditypes">
                                                  <option value="" selected="selected">Select</option>
                                                  <option value="2" label="Staff name">By Staff</option>
                                                  <option value="3" label="Company Name">By Company</option>
                                                  <option value="4" label="Guest Name">By Guest</option>
                                                </select>
                                            </div></td>
                                           </tr>
                                          </tbody>
                                          </table>
                                          </div> 
                                          <div class="crd_select_head_cc" style="display:none" id="crtype_div">
                                          <table class="tax_table" width="100%" border="0" cellspacing="5">
                                           <tbody>
                                             <tr>
                                             <td width="45%" id="labelcr_type">Staff name :</td>
                                             <td width="5%">:</td>
                                             <td width="50%"><span class="discount_text_box paymod_text_box" id="credit_staff_val">
                                             <select class="tax_textbox " style="color:#000">
                                              <option value="">Select</option>
                                              </select>
                                           </span>
                                           </td>
                                           </tr>
                                            <tr>
                                            <td width="45%">Credit Amount :</td>
                                            <td width="5%">:</td>
                                            <td width="50%"><span class="discount_text_box paymod_text_box">
                                             <input placeholder="Credit Amount" class="tax_textbox transa_txt" readonly="readonly" id="amount_credit" name="amount_credit"  style="color:#000">
                                           </span>
                                           </td>
                                           </tr>
                                           
                                           </tbody>
                                          </table>
                                    
                                      	</div>
                                      <!--<div class="credit_room_cc credtitypeloads">
    
                                        </div>-->
                        	</div><!--credit_staff_cc-->
                            
                            <div style="display:none" class="complimentrary_cc">
                             <div class="discount_text_cc crd_head">Complimentary</div>
                                  <textarea style="height:80px;color:#000" placeholder="Enter Complimentary" class="tax_textbox" id="completext"></textarea>
                            </div><!--complimentrary_cc-->
                            
                            <div style="display:none" class="complimentrary_management">
                            <div class="discount_text_cc crd_head">Complimentary Management</div>
                             <table class="tax_table" width="100%" border="0" cellspacing="5">
                                <tbody>
                                <tr>
                                  <td width="45%">Staff :</td>
                                  <td width="5%">:</td>
                                  <td width="50%"><div class="discount_text_box paymod_text_box">
                                           <select class="tax_textbox"  style="color:#000" id="selectstafcomp">
                                           <option value="">Select</option>
                                               <?php
											  
										  $sql_ds_nos="select sm.ser_firstname,sm.ser_staffid  from  tbl_staffmaster as sm  where sm.ser_employeestatus='Active' AND ser_compl_mgmt='Y'";
										  $sql_ds  =  $database->mysqlQuery($sql_ds_nos); 
										  $num_ds = $database->mysqlNumRows($sql_ds);
										  if($num_ds){ 
										   while($result_ds = $database->mysqlFetchArray($sql_ds)) 
												  {
											?>
                                              
                                       <option value="<?=$result_ds['ser_staffid']?>" ><?=$result_ds['ser_firstname']?></option>
                                      
                                      <?php } } ?>  
                                          </select>
                                      </div></td>
                                     </tr>
                                   <tr>
                                  	<td colspan="3">
                            <textarea style="height:80px;color:#000" placeholder="Enter Complimentary" class="tax_textbox" id="completext_mng"></textarea></td>
                                  </tr>
                                     
                                </tbody>
                                </table>           
                            
                           
                            </div><!--complimentrary_management-->
                            <div class="paid_amount_cc" style="display:none">
                    		<table class="tax_table" width="100%" border="0" cellspacing="5">
                             	 <tbody>
                                     <tr>
                                    <td width="45%">Paid Amount</td>
                                    <td width="5%">:</td>
                                    <td width="50%"><div class="discount_text_box paymod_text_box">
                                            <input placeholder="Paid Amount" class="tax_textbox transa_txt" name="paidamount" id="paidamount" onChange="enterbalance()" onkeypress="if(event.keyCode=='13')return enterbalance()" style=" color:#000">
                                        </div></td>
                                    </tr>
                                     <tr>
                                    <td width="45%">Balance Amount</td>
                                    <td width="5%">:</td>
                                    <td width="50%"><div class="discount_text_box paymod_text_box">
                                            <input placeholder="Balance Amount" class="tax_textbox transa_txt" name="balanceamout" id="balanceamout" onkeypress="if(event.keyCode=='13')return submitform()" style=" color:#000">
                                        </div></td>
                                    </tr>
                            	 </tbody>
                             </table> 
                    	</div>
                       
                        
                        <!--paid_amount_cc-->
                        
                      </div><!--take_oder_right_detail-->
                      <div class="right_bottom_btn_cc" id="ta_submitbutton" >
                      	<a class="right_sub_btn" style="cursor:pointer" id="ta_staffsubmit"> Submit </a>
                         	<a class="right_sub_btn" style="cursor:pointer;display:none" id="ta_staffclose"> Close </a>
                      </div>
                       
                    </div><!--take_staff_view_cont_cc-->
                </div><!--take_staff_view_cc-->
                
            </div><!--left_contant_container-->
    
        
        
        
      </div><!--middle_container-->          
</div><!--container_fluide-->

<!-- ************************************************* manage popup starts  ************************************************** -->
<div style="position:fixed;width:100%;left:30%;top:7%;z-index:99999;" class="mynewpopupload1"  ></div>
<!-- ************************************************* manage popup ends  ******************************************************* -->  
<div class="new_alert_cc" >
	<div class="confirm_detail_con_pop"></div> 
    
</div> 


 <!----dock----> 
   <?php //include "includes/top_main_menu.php"; ?>
 <!----dock----> 

 <script src="js/takeaway_staff.js"></script>
  <script src="js/takeaway_biilsubmn.js"></script>
<script type="text/javascript">
$(document).ready(function(){
$(".credit_cc").hide();
		$(".coupon_cc").hide();
		$(".voucher_cc").hide();
		$(".cheque_cc").show();
        $("select").change(function(){
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
        }).change();
	});	

	/***************************************  credit types ends **********************************************************  */
       </script> 
        
 
 
 
</body>

</html>