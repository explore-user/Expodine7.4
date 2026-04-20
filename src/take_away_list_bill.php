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
<link rel="stylesheet" type="text/css" href="css/master_pop_default.css" />
<link rel="stylesheet" type="text/css" href="css/master_pop_component.css" />
<!--<link href="css/whitebg/take_away.css" rel="stylesheet" type="text/css">-->
<script src="js/jquery-1.10.2.min.js"></script>


<!--ESC Key press starts-->
    <script type="text/javascript">
	$(document).ready(function() 
	{
		document.onkeydown = function(evt) {
			evt = evt || window.event;
			if (evt.keyCode == 27) {//esc key press
				//$('.close_btn_validate').click();
				$('.new_alert_cc').css('display','none');
			}
		};
		
	});
	
	</script>
 <!--ESC Key press ends-->
 
  <script>
	$(document).ready(function(event) 
	{
	  $(document).keydown(function (e) 
	  {
		if (e.keyCode == 16) 
		{
			
		}
	  });
	});
   </script>   

<style>
body{font-family:inherit}
.md-content h3{font-size: 1.4em;}.md-content button{font-size:0.8em;}
.md-content{background: #E4E4E4;}
.left_contant_container {height: 84vh}	
.take_oder_right_detail{height: 360px;}
.take_pop_order_item{margin: 0.2%;}
.new_right_drop{margin-top:-8px;}
.take_away_kot_bottom_inform_cc, .take_kot_top_site_map_cc, .take_kot_left_contant_container{height: 40px;width:80%;}
</style>

</head>

<body>
<div class="olddiv1 "></div>
<div class="container-fluid no-padding">
    <?php include"includes/topbar_takeaway.php"; ?>
     <input type="hidden" name="hidcompmangauth" id="hidcompmangauth" value="<?=$_SESSION['s_compl_manage_auth']?>">

      <div class="middle_container">
      <div class="top_site_map_cc ">
            	<ul>
					<!--<li><a href="index.php" title=""><span class="home_icon"></span>\</a></li>-->
					<li><a title="">Take Away Billing</a></li>
				</ul>
                
                
                <div class="top_al_search_cc">
                	<!--<span class="top_al_search_name"> </span>-->
                    <span><input class="search" placeholder="Search Bill No" name="search"  id="search" type="text"></span>
                </div>
                 <span class="loaderror load_new_error" style="width:50%;  margin-left:0%;  color: #F70E0E;"></span>
            </div>
      		<div style="  min-height: 557px;overflow:auto" class="left_contant_container">
            	<div id="ta_listallorders_list_bill">
                 <?php
				$curdate=date("Y-m-d");
				$sql_menulist= "Select distinct(tb.tab_billno),tb.tab_time,tb.tab_hdcustomerid ,ts.tac_customername,ts.tac_contactno,tb.tab_status,tb.tab_kotno, tb.tab_mode,tb.tab_netamt From tbl_takeaway_billmaster as tb LEFT JOIN tbl_takeaway_customer ts ON ts.tac_customerid=tb.tab_hdcustomerid Where tb.tab_dayclosedate ='".$_SESSION['date']."' And tb.tab_kotno != '' And (tb.tab_status='Packed') And (tb.tab_mode='CS' OR tb.tab_mode='TA')   order by tb.tab_time DESC ";
				
			  //$sql_menulist= "Select distinct(tab_billno),tab_time,tab_customermobile,tab_customername,tab_hdcustomerid ,tab_status,tab_kotno,tab_netamt,tab_mode From tbl_takeaway_billmaster  Where tab_dayclosedate ='".$_SESSION['date']."' And tab_kotno != '' And tab_status='Packed' And tab_hdcustomerid IS NULL  order by tab_time DESC ";
				$sql_menus  =  $database->mysqlQuery($sql_menulist); 
				$num_menus  = $database->mysqlNumRows($sql_menus);
				if($num_menus){
					while($result_menus  = $database->mysqlFetchArray($sql_menus)) 
						{// 
							?>
         <div class="take_kot_detail_cc">                    
            	<div class="take_away_list_cc takeawayeachclick  <?php  if(($result_menus['tab_mode'])=="CS"){ ?> countersales <?php } ?>" bilno="<?=$result_menus['tab_billno']?>" kotno="<?=$result_menus['tab_kotno']?>" cutomerid="<?=$result_menus['tab_hdcustomerid']?>"    netamount="<?=$result_menus['tab_netamt']?>"><!--take_active-->
                    <!--<div class="take_order_item_name"><img src="img/printer.png"></div>--><!--take_order_item_name-->
                	<div class="take_list_oder_num"><?=$result_menus['tab_billno']?></div>
                    <div class="take_oder_odred_name"><span>Customer</span> :<?=$result_menus['tac_customername']?></div>
                    <div class="take_oder_odred_name"><span>Mobile No</span> : <?=$result_menus['tac_contactno']?></div>
                     <div class="take_oder_odred_name"><span>Time</span> : <?=date("h:i:s a",strtotime($result_menus['tab_time'])) ?></div>
                     <div class="take_oder_odred_name"><span>Status</span> : <?=$result_menus['tab_status'] ?></div>
                </div><!--take_away_list_cc-->
         <a class="print_kot ta_printbilleach" > <div class="take_order_item_name"><img src="img/printer.png"></div></a>
        </div>        
                <?php }}else
		 {
			 echo "<span style='color: #F00E0E;'> Nothing to display </span>";
		 }  ?>
         
         
         
                    
                </div><!--take_away_list_cc-->
                <div class="take_away_bottom_inform_cc take_away_kot_bottom_inform_cc">
               		<!--<div class="take_away_bottom_inform">
                    	<div class="tka_inform_color"></div>
                        <div class="tka_inform_text">Home Delivery</div>
                    </div>-->
                    <div class="take_away_bottom_inform">
                    	<div style="background-color:#fff" class="tka_inform_color"></div>
                        <div class="tka_inform_text">Take Away</div>
                    </div>
                    <div class="take_away_bottom_inform">
                    	<div style="background-color:#993" class="tka_inform_color"></div>
                        <div class="tka_inform_text">Counter Sales</div>
                    </div>
               </div>
            </div><!--left_contant_container-->
        <span id="ta_loadtakkotl" style="display:none"></span>
        <div class="right_order_inform right_calc_cc take_detail_right_cc">
        	<div style="min-height:615px;" class="right_main_cc">
            	<div class="top_head">Bill Payment</div>
                <div class="take_oder_right_detail" id="ta_listpayemnt" style="display:none;height:64vh;min-height:420px;">
                	<div class="take_oder_odred_name"><span>Order No </span>  <span id="ta_loadtakbill"></span></div>
                    <div class="take_oder_odred_name"><span>Total Amount </span>  <span id="ta_loadtakbillamount"></span></div>
                	<div class="discount_text_box">
                        <select style="width: 100%;background:#FFF;color:#000;" class="discount_text_box tax_textbox" id="ta_payemntmode">
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
                        <input type="hidden" name="deltval" id="deltval" value="take_away_list_bill.php">
                       </div>
                        <div class="cash_cc">
                            <div class="discount_text_cc crd_head">Cash</div>
                            </div>
                        
                        	<div class="credit_cc_normal">
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
                                        <input placeholder="Amount" class="tax_textbox transa_txt" name="transcationid" id="transcationid" onChange="transamountchange()" style="color:#000">
                                    </div></td>
                              </tr>
                              <tr>
                                <td width="45%">Balance to Pay</td>
                                <td width="5%">:</td>
                                <td width="50%"><div class="discount_text_box paymod_text_box">
                                        <input placeholder="Balance" class="tax_textbox transa_txt" name="transbal" id="transbal" style="color:#000">
                                    </div></td>
                              	</tr>
                             </tbody></table> 	
                            </div><!--credit_cc-->
                            <div class="coupon_cc">
                            	 <div class="discount_text_cc crd_head">Coupons</div>
                            	<table class="tax_table" width="100%" border="0" cellspacing="5">
                             	 <tbody><tr>
                                <td width="45%">Coupon Name</td>
                                <td width="5%">:</td>
                                <td width="50%"><div class="discount_text_box paymod_text_box">
                                        <select class="tax_textbox" name="coupnsel" id="coupnsel" style="color:#000">
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
                                        <input placeholder="Coupon Amount" class="tax_textbox transa_txt" name="coupamount" id="coupamount" onChange="couponamountchange()" onkeypress="if(event.keyCode=='13')return totamountfocus()" style="color:#000">
                                    </div></td> 
                              	</tr>
                                <tr>
                                <td width="45%">Balance to Pay</td>
                                <td width="5%">:</td>
                                <td width="50%"><div class="discount_text_box paymod_text_box">
                                        <input placeholder="Balance" class="tax_textbox transa_txt" name="coupbal" id="coupbal" style="color:#000">
                                    </div></td>
                              	</tr>
                             </tbody></table> 
                            </div><!--coupon_cc-->
                            <div class="voucher_cc">
                            	 <div class="discount_text_cc crd_head">Voucher</div>
                            	<table class="tax_table" width="100%" border="0" cellspacing="5">
                              <tbody><tr>
                                <td width="45%">Voucher ID</td>
                                <td width="5%">:</td>
                                <td width="50%"><div class="discount_text_box paymod_text_box">
                                 <input placeholder="Voucher ID" class="tax_textbox transa_txt" name="vouchid" id="vouchid" style="color:#000">
                                    </div></td>
                              </tr>
                              <tr>
                                <td width="45%">Voucher Amount</td>
                                <td width="5%">:</td>
                                <td width="50%"><div class="discount_text_box paymod_text_box">
                                        <input placeholder="Voucher Amount" class="tax_textbox transa_txt" style="color:#000" name="vocamount" id="vocamount" readonly >
                                    </div></td> 
                              	</tr>
                              <tr>
                                <td width="45%">Balance to Pay</td>
                                <td width="5%">:</td>
                                <td width="50%"><div class="discount_text_box paymod_text_box">
                                        <input placeholder="Balance" class="tax_textbox transa_txt" name="vouchbal" id="vouchbal" style="color:#000">
                                    </div></td>
                              	</tr>
                             </tbody></table>
                            </div><!--voucher_cc-->
                            <div class="cheque_cc">
                             <div class="discount_text_cc crd_head">Cheque</div>
                            	<table class="tax_table" width="100%" border="0" cellspacing="5">
                              <tbody><tr>
                                <td width="45%">Cheque No</td>
                                <td width="5%">:</td>
                                <td width="50%"><div class="discount_text_box paymod_text_box">
                                        <input placeholder="Cheque No" class="tax_textbox transa_txt" name="cheqname" id="cheqname" style="color:#000">
                                    </div></td>
                              </tr>
                               <tr>
                                <td width="45%">Bank Name</td>
                                <td width="5%">:</td>
                                <td width="50%"><div class="discount_text_box paymod_text_box">
                                        <input placeholder="Bank Name" class="tax_textbox transa_txt" name="cheqbank" id="cheqbank" style="color:#000">
                                    </div></td>
                              </tr>
                              <tr>
                                <td width="45%">Amount</td>
                                <td width="5%">:</td>
                                <td width="50%"><div class="discount_text_box paymod_text_box">
                                        <input placeholder="Cheque Amount" class="tax_textbox transa_txt" name="cheqamount" id="cheqamount" onChange="cheqamountchange()" style="color:#000">
                                    </div></td>
                              </tr>
                               <tr>
                                <td width="45%">Balance to Pay</td>
                                <td width="5%">:</td>
                                <td width="50%"><div class="discount_text_box paymod_text_box">
                                        <input placeholder="Balance" class="tax_textbox transa_txt" name="cheqbal" id="cheqbal" style="color:#000">
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
                        	</div>
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
                            
                            
                        <div class="paid_amount_cc">
                    		<table class="tax_table" width="100%" border="0" cellspacing="5">
                             	 <tbody>
                                     <tr>
                                    <td width="45%">Paid Amount</td>
                                    <td width="5%">:</td>
                                    <td width="50%"><div class="discount_text_box paymod_text_box">
                                            <input placeholder="Paid Amount" class="tax_textbox transa_txt" name="paidamount" id="paidamount" onChange="enterbalance()" onkeypress="if(event.keyCode=='13')return enterbalance()" style="color:#000">
                                        </div></td>
                                    </tr>
                                     <tr>
                                    <td width="45%">Balance Amount</td>
                                    <td width="5%">:</td>
                                    <td width="50%"><div class="discount_text_box paymod_text_box">
                                            <input placeholder="Balance Amount" class="tax_textbox transa_txt" name="balanceamout" id="balanceamout" onkeypress="if(event.keyCode=='13')return submitform()"  style="color:#000">
                                        </div></td>
                                    </tr>
                            	 </tbody>
                             </table> 
                    	</div><!--paid_amount_cc-->
                      </div><!--pament_selected_show_cc-->
                     
                     	<div style="border-bottom: 0px ;height:96px; display:none" class="take_right_inform_cc order_items_contain" id="ta_divview">
                        <div class="top_head" style="display:none" id="ta_orl">Order item List</div>
                        	<div class="take_pop_show_btn" style="display:none" id="ta_vieword"><a  class="md-trigger_taload " href="#">+ View Orders</a></div>
                        </div><!--take_right_inform_cc-->
                        <div class="take_botom_button" style="display:none" id="ta_divsub">
                        <a href="#" id="ta_staffsubmit" style="display:none;padding-right:0;"> Submit </a>
                        <a class="" style="cursor:pointer;display:none;padding-right:0;" id="ta_staffclose"> Close </a>

                        </div>
                </div><!--take_oder_right_detail-->
            </div><!--right_main_cc--->
            
            
               
        </div><!---right_order_inform-->
        
        
        
      </div><!--middle_container-->          
</div>



              
<div class="md-overlay"></div><!-- the overlay element -->
<!-- ************************************************* manage popup starts  ************************************************** -->
<div style="position:fixed;width:100%;left:30%;top:7%;z-index:99999;" class="mynewpopupload1"  ></div>
<!-- ************************************************* manage popup ends  ******************************************************* -->  
<div class="new_alert_cc" >
	<div class="confirm_detail_con_pop"></div> 
    
</div> 

<!----dock----> 
   <?php //include "includes/top_main_menu.php"; ?>
 <!----dock----> 

<script src="js/takeaway_bill.js"></script>
<script src="js/takeaway_print.js"></script>
<script src="js/takeawaylist_each.js"></script>
<script src="js/takeaway_biilsubmn.js"></script>
<script src="js/master_classie.js"></script>
<script src="js/master_modalEffects.js"></script>
 <script src="js/takeaway_bill_new.js"></script>

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