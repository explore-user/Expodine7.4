<?php
header('Content-Type: text/html; charset=utf-8');
include('includes/session.php');  // Check session
//session_start();
include("database.class.php"); // DB Connection class
$database = new Database();
require_once("includes/title_settings.php");
include('includes/master_settings.php');
include('includes/menu_settings.php');
if (!isset($_SESSION['timeopen'])) {
    header("location:index.php?msg=1");
}

error_reporting(0);
if(isset($_REQUEST['mode']))
{
	$_SESSION['typeoofpayemnt']=$_REQUEST['mode'];
}
if(!isset($_SESSION['typeoofpayemnt']))
{
	$_SESSION['typeoofpayemnt']="ALL";
}
?>
<!DOCTYPE HTML>
<html><head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title> Settle Bill</title>
        <link rel="shortcut icon" href="img/favicon.ico">
        <link href="css/bootstrap-cerulean.min.css" rel="stylesheet" />
        <link href="css/order_new.css" rel="stylesheet" type="text/css">
        <link href="css/take_away.css" rel="stylesheet" type="text/css">
        <link href="css/billgeneration_new.css" rel="stylesheet" type="text/css">
        <script src="js/jquery-1.10.2.min.js"></script> 


<script src="js/payments_ta_cs.js"></script>
<script src="js/payments_ta_cs_select.js"></script>
        <!--<script src="js/bill_paymentscreen_main.js"></script> 
        <script src="js/bill_paymentscreen_select.js"></script>
        <script src="js/bill_paymentscreen_sort.js"></script>-->
        <style>
            body{font-family:inherit}
            .left_contant_container {height: 80vh;padding-bottom:15px;}	
            .tax_table td{  padding-left: 12px;text-align: left;}
            .tax_textbox {width: 100%;}
            .discount_text_cc{text-align:center}
            .take_staff_view_cc{width: 32.5%;margin:0px !important;margin-left:0.6% !important;margin-top: 10px !important;}
            /*#billdetails .billgenration_new_table tbody {min-height: 410px;height: 73vh;}*/
            .tottal_rate_contain {width: auto;min-width: 110px;float: right;height: 40px;line-height: 38px;font-size: 15px;color: #FFF;font-weight:400;margin-right:1%}
            .payment_pend_right_cash_head_txt{width:20%;}
            .payment_pend_right_cash_error{width:78%;text-align:center}
            .tottal_rate_contain {height: 30px;line-height: 30px;padding-right:1%;}
            .billgenration_new_table tbody {min-height: 330px;height:59vh;}
.error_feed{position: absolute; top: -45px;left: 310px;z-index: 99;}
        </style>
        <script type="text/javascript">
            $(document).ready(function () {


                $(".credit_cc").hide();
                $(".coupon_cc").hide();
                $(".voucher_cc").hide();
                $(".cheque_cc").hide();
                $('.closetranscations').css("display", "none");
                $('.closetranscations_whole').css("display", "none");
                $("#payemntmode_sel").change(function () {
                    // $( "#payemntmode option:selected").each(function(){
                    var aat = ($(this).val());
                    if (aat == "cash") {
                        $(".cash_cc").show();
                        $(".credit_cc").hide();
                        $(".credit_cc_normal").hide();
                        $(".coupon_cc").hide();
                        $(".voucher_cc").hide();
                        $(".cheque_cc").hide();
                        $(".auto1").hide();
                        $(".auto").hide();
                        $(".complimentrary_management").hide();
                        $('.paid_amount_cc').css("display", "block");
                        $('.paid_amount_cc_credit').css("display", "none");
                        $('.closetranscations').css("display", "block");
                        $('.closetranscations_whole').css("display", "none");
                                               $("#transcationid").val("");
                                        $("#transbal").val("");
                                                $("#balanceamout").val("");
                                        $("#paidamount").val("");
                                        $("#paidamount_credit").val("");
                                           $("#balanceamout_credit").val("");
                    }
                    if (aat == "credit") {
                              $("#balanceamout").val("");
                                        $("#paidamount").val("");
                                         $("#transcationid").val("");
                                        $("#transbal").val("");
                                          $("#paidamount_credit").val("");
                                           $("#balanceamout_credit").val("");      
                        $(".cash_cc").hide();
                        $(".credit_cc_normal").show();
                        $(".credit_cc").hide();
                        $(".coupon_cc").hide();
                        $(".voucher_cc").hide();
                        $(".cheque_cc").hide();
                        $(".auto1").hide();
                        $(".auto").hide();
                        $(".complimentrary_management").hide();
                        $("#transcationid").focus();
                        $('.paid_amount_cc').css("display", "block");
                        $('.paid_amount_cc_credit').css("display", "none");
                        $('.closetranscations').css("display", "block");
                        $('.closetranscations_whole').css("display", "none");
                    }
                    if (aat == "coupon") {
                        $(".cash_cc").hide();
                        $(".credit_cc").hide();
                        $(".credit_cc_normal").hide();
                        $(".coupon_cc").show();
                        $(".voucher_cc").hide();
                        $(".cheque_cc").hide();
                        $(".auto1").hide();
                        $(".auto").hide();
                        $(".complimentrary_management").hide();
                        $('.paid_amount_cc').css("display", "block");
                        $('.paid_amount_cc_credit').css("display", "none");
                        $('.closetranscations').css("display", "block");
                        $('.closetranscations_whole').css("display", "none");
                    }
                    if (aat == "voucher") {
                        $(".cash_cc").hide();
                        $(".credit_cc").hide();
                        $(".credit_cc_normal").hide();
                        $(".coupon_cc").hide();
                        $(".voucher_cc").show();
                        $(".cheque_cc").hide();
                        $(".auto1").hide();
                        $(".auto").hide();
                        $(".complimentrary_management").hide();
                        $('.paid_amount_cc').css("display", "block");
                        $('.paid_amount_cc_credit').css("display", "none");
                        $('.closetranscations').css("display", "block");
                        $('.closetranscations_whole').css("display", "none");
                    }
                    if (aat == "cheque") {
                         $("#transcationid").val("");
                                        $("#transbal").val("");
                                                $("#balanceamout").val("");
                                        $("#paidamount").val("");
                                        $("#paidamount_credit").val("");
                                           $("#balanceamout_credit").val("");
                        $(".cash_cc").hide();
                        $(".credit_cc").hide();
                        $(".credit_cc_normal").hide();
                        $(".coupon_cc").hide();
                        $(".voucher_cc").hide();
                        $(".cheque_cc").show();
                        $(".auto1").hide();
                        $(".auto").hide();
                        $(".complimentrary_management").hide();
                        $('.paid_amount_cc').css("display", "block");
                        $('.paid_amount_cc_credit').css("display", "none");
                        $('.closetranscations').css("display", "block");
                        $('.closetranscations_whole').css("display", "none");
                    }

                    if (aat == "credit_person") {
                         $("#transcationid").val("");
                                        $("#transbal").val("");
                                                $("#balanceamout").val("");
                                        $("#paidamount").val("");
                                          $("#paidamount_credit").val("");
                                           $("#balanceamout_credit").val("");
                        $(".cash_cc").hide();
                        $(".credit_cc").hide();
                        $(".credit_cc_normal").hide();
                        $(".coupon_cc").hide();
                        $(".voucher_cc").hide();
                        $(".cheque_cc").hide();
                        $(".auto1").hide();
                        $(".auto").show();
                        $('#selectcreditypes option').first().prop('selected', true);
                        $("#amount_credit").val($('#grandtotal').text());
                        $(".complimentrary_management").hide();
                        $('.paid_amount_cc').css("display", "none");
                        $('.paid_amount_cc_credit').css("display", "block");
                        $('.closetranscations').css("display", "none");
                        $('.closetranscations_whole').css("display", "block");
                    }

                    if (aat == "complimentary") {
                         $("#transcationid").val("");
                                        $("#transbal").val("");
                                                $("#balanceamout").val("");
                                        $("#paidamount").val("");
                                        $("#paidamount_credit").val("");
                                           $("#balanceamout_credit").val("");
                                            $("#completext").val("");
                        $(".cash_cc").hide();
                        $(".credit_cc").hide();
                        $(".credit_cc_normal").hide();
                        $(".coupon_cc").hide();
                        $(".voucher_cc").hide();
                        $(".cheque_cc").hide();
                        $(".auto").hide();
                        $(".auto1").show();
                        $(".complimentrary_management").hide();
                        $('.paid_amount_cc').css("display", "none");
                        $('.paid_amount_cc_credit').css("display", "none");
                        $('.closetranscations').css("display", "none");
                        $('.closetranscations_whole').css("display", "block");
                    }

                    if (aat == "comp_management") {
                        $(".cash_cc").hide();
                        $(".credit_cc").hide();
                        $(".credit_cc_normal").hide();
                        $(".coupon_cc").hide();
                        $(".voucher_cc").hide();
                        $(".cheque_cc").hide();
                        $(".auto").hide();
                        $(".auto1").hide();
                        $(".complimentrary_management").show();
                        $('.paid_amount_cc').css("display", "none");
                        $('.paid_amount_cc_credit').css("display", "none");
                        $('.closetranscations').css("display", "none");
                        $('.closetranscations_whole').css("display", "block");
                    }

                    //});
                });
            });










        </script> 


    </head>

    <body>
        <div class="olddiv1 "></div>
        <div class="container-fluid no-padding">

            <?php include "includes/topbar.php"; ?>
            <input type="hidden" name="hidcompmangauth" id="hidcompmangauth" value="<?= $_SESSION['s_compl_manage_auth'] ?>">
            <input type="hidden" name="hidbilgenper" id="hidbilgenper" value="<?= $_SESSION['s_bilregen_with_permission'] ?>">
            <div class="middle_container">
                <div style="width:100%" class="top_site_map_cc ">
                    <?php include"includes/new_right_menu.php"; ?>
                    <?php if(in_array("Payment Pending", $_SESSION['menumodarray'])){ ?>
                    <a title="Home" href="counter_sales.php"><div class="backto_table_select" style="float:left;width: 110px">
                      <div class="backtable_ico"></div>
                      <div style="width:70px;" class="tableselect_text"><?=$_SESSION['home_cs']?></div>
                  </div></a>
                   <a href="payment_pending.php"><div class="dine_in_mn_cc">
                   	<img src="img/dine-ico.png"><div style="font-size:16px;left:40px" class="dine_in_mn_text"><?=$_SESSION['home_headdinein']?></div>
                   </div></a>
                   <?php } ?>
                  
					
                    <div style="width: 24%;" class="billgeneration_head"><?=$_SESSION['payment_pending_paymentpending']?> - <?=$_SESSION['home_headcounter']?></div>
                    <div class="error_feed" style="color:#F00"></div>

                    



                </div>

                <div style="  min-height:480px;width:100%" class="left_contant_container">

                    <div class="take_staff_view_cc">

                        <!--<div class="bill_shadow_left"></div>-->
                        <div class="take_staff_view_head">
                            <div class="bill_head_pin"></div>
                            <div class="staf_view_list_hd"><?=$_SESSION['payment_pending_billdetails']?></div>
                        </div><!--take_staff_view_head-->



                        <div  class="take_staff_view_cont_cc">	<!--style="height:300px;min-height: 68.5vh;"-->
                            <div class="floor_sel_in_table_detail">
                                <div class="floor_area_sel_name"><?=$_SESSION['completed_order_mode_select']?></div>
                                <div class="floor_area_sel_textbx">
                                    <select style="width:100%;" class="discount_text_box tax_textbox" id="typesele" name="typesele">
                                        <!--<option value="TA" <?php //if($_SESSION['typeoofpayemnt']=="TA") { ?>  selected <?php //} ?>>Take Away</option>-->
                                        <option value="CS" <?php if($_SESSION['typeoofpayemnt']=="CS") { ?>  selected <?php } ?>>Counter Sales</option>
                                        <!---<option value="ALL" <?php //if($_SESSION['typeoofpayemnt']=="ALL") { ?>  selected <?php //} ?>>All</option>--->
                                    </select>
                                </div>
                            </div><!--floor_sel_in_table_detail-->

                            <div class="bill_gen_new_table_head loadallhead">
                                <table class="billgenration_new_table " width="100%" border="0" >
                                    <thead>
                                        <tr>
                                            <th width="20%" class="sortbybill" style="cursor:pointer"><?=$_SESSION['payment_pending_billno']?></th>
                                           
<?php if ($_SESSION['typeoofpayemnt'] == 'ALL') { ?> <th width="10%"><?=$_SESSION['completed_order_mode_select']?></th> <?php } ?>
                                            <th width="25%"><?=$_SESSION['payment_pending_time']?></th>
                                            <th width="15%"><?=$_SESSION['payment_pending_table_amount']?></th>

                                        </tr>
                                    </thead>
                                </table>
                            </div><!--bill_gen_new_table_head-->

                            <div id="load_billfullist"  class="billgenration_new_table_content_container">

                                <table class="billgenration_new_table_content" width="100%" border="0">  
                                    <tbody >
<?php
$curdt = date("Y-m-d");

/*if ((isset($_REQUEST['floorid']))) {
    $_SESSION['floorid'] = $_REQUEST['floorid'];
    $_SESSION['florids'] = $_REQUEST['floorid'];
}*/

if (isset($_SESSION['typeoofpayemnt'])) {
   
        $sql_table_sel_query= "Select distinct(tb.tab_billno),tb.tab_time,tb.tab_hdcustomerid ,ts.tac_customername,ts.tac_contactno,tb.tab_status,tb.tab_kotno, tb.tab_mode,tb.tab_netamt From tbl_takeaway_billmaster as tb LEFT JOIN tbl_takeaway_customer ts ON ts.tac_customerid=tb.tab_hdcustomerid Where tb.tab_dayclosedate ='".$_SESSION['date']."' and tb.tab_payment_settled='N' And tb.tab_mode = 'CS' and tb.tab_cancelled='N' and  tb.tab_billno NOT LIKE 'HOLD%' and tb.tab_billno NOT LIKE 'TEMP%' order by tb.tab_time DESC";
				
    
	$sql_table_sel = $database->mysqlQuery($sql_table_sel_query);
    $num_table = $database->mysqlNumRows($sql_table_sel);
    if ($num_table) {
        while ($result_table_sel = $database->mysqlFetchArray($sql_table_sel)) {
			
			
            ?>

                                             <tr class="clickeachrowpaymnt_ta" billno="<?= $result_table_sel['tab_billno'] ?>" kotno="<?=$result_table_sel['tab_kotno']?>" >
                                                        <td width="20%"><strong><?= $result_table_sel['tab_billno'] ?></strong></td>
                                                        <?php if ($_SESSION['typeoofpayemnt'] == 'ALL') { ?> <td width="10%"><?=$result_table_sel['tab_mode']?></td> <?php } ?>
                                                        <td width="25%"> <?= date("h:i:s", strtotime($result_table_sel['tab_time'])) ?></td>

                                                        <td width="15%"><?= number_format($result_table_sel['tab_netamt'],$_SESSION['be_decimal']) ?>/-</td>
                                                    </tr>

                                                <?php }
                                            }else { 
				   ?>
                   <tr>
                   <td style="color:#F00"><?=$_SESSION['credit_settlement_error_record_display']?></td>
                   </tr>
                   <?php
				   }
                                        } ?>

                                    </tbody>

                                </table>
                            </div><!--billgenration_new_table_content_container--->

                            <div class="take_staff_view_cont_bottom_contain">

                                <!--<a href="#" class="verifythetables"><div class="bill_print_btn">Verify</div></a>-->

<?php //if($_SESSION['s_billsplit']=="Y"){  ?>
<?php if (in_array("bill_split", $_SESSION['menufullarray'])) { ?>  
                                    <input type="hidden" name="namesplitview" id="namesplitview" value="Y">
                                   
<?php } else { ?>
                                    <input type="hidden" name="namesplitview" id="namesplitview" value="N">
<?php } ?>

                                <a href="#" class="repreintthetables_ta"><div class="bill_print_btn"><?=$_SESSION['payment_pending_reprintbutton']?></div></a>
                                <a href="#" class="settlethetables"><div class="bill_print_btn"><?=$_SESSION['payment_pending_settlebutton']?></div></a>
                               
                            </div>

                        </div><!--take_staff_view_cont_cc-->
                    </div><!--take_staff_view_cc-->

                    <div class="take_staff_view_cc">
                        <!--<div class="bill_shadow_left"></div>-->
                        <div class="take_staff_view_head">
                            <div class="bill_head_pin"></div>
                            <div class="staf_view_list_hd"><?=$_SESSION['payment_pending_orderdetails']?></div>
                        </div><!--take_staff_view_head-->
                        <div class="take_staff_view_cont_cc">
                            <div id="billdetails" >
                                <table  class="billgenration_new_table" width="100%" border="0" cellspacing="5">
                                    <thead>
                                        <tr>
                                            <th width="10%"><?=$_SESSION['payment_pending_slno']?></th>
                                            <th width="40%"><?=$_SESSION['payment_pending_menuitem']?></th>
                                            <th width="10%"><?=$_SESSION['payment_pending_qty']?></th>
                                            <th width="15%"><?=$_SESSION['payment_pending_rate']?></th>
                                            <th width="22%"><?=$_SESSION['payment_pending_order_amount']?></th>
                                        </tr>
                                    </thead>

                                </table>
                            </div>       

                            <div class="take_staff_view_cont_bottom_contain" style="bottom: 63px;height:28px;">
                            <div class="tottal_rate_contain"  style="color:#000;font-size: 14px;text-align:left;width:40%;float:left;margin-left:1%">Service Charge <span id="servchrge_new"> </span></div>
                                <div class="tottal_rate_contain"  style="color:#000;font-size: 14px;text-align:right"><?=$_SESSION['payment_pending_subtotal']?>   <span id="grandtotal_sec_sub"></span></div>
                            </div>

                            <div class="take_staff_view_cont_bottom_contain" style="bottom: 35px;height:28px;">
                            <div class="tottal_rate_contain"  style="color:#000;font-size: 14px;text-align:left;width:40%;float:left;margin-left:1%">Vat <span id="vat_new"> </span></div>
                                <div class="tottal_rate_contain" style="color:#000;font-size: 14px;text-align:right"><?=$_SESSION['payment_pending_discount']?>   <span id="grandtotal_disc"></span></div>
                            </div> 

                            <div class="take_staff_view_cont_bottom_contain" >
                                <div class="tottal_rate_contain" style="color:#000;font-size: 15px;text-align:right"><strong><?=$_SESSION['payment_pending_finaltotlal']?>   <span id="grandtotal_sec"></span></strong> </div>
                            </div>




                        </div><!--take_staff_view_cc-->

                    </div><!--take_staff_view_cont_cc-->

                    <div style="margin-right: 0;" class="take_staff_view_cc payment_pend_right_cash">
                        <!--<div class="bill_shadow_left"></div>-->
                        <div class="take_staff_view_head">
                            <div class="bill_head_pin"></div>
                            <div class="staf_view_list_hd"><?=$_SESSION['payment_pending_billdetails']?>
                                <div style="line-height:38px" class="tottal_rate_contain"><?=$_SESSION['payment_pending_totalrate']?> = <span id="grandtotal"> </span>/-</div>
                            </div>
                        </div><!--take_staff_view_head-->
                        <div class="take_staff_view_cont_cc">
                            <div class="payment_pend_right_cash_head">
                                <div class="payment_pend_right_cash_head_txt"><?=$_SESSION['payment_pending_cashsettle']?></div>
                                <div class="payment_pend_right_cash_error"></div>
                            </div>

                            <div style="border-bottom:1px #ccc solid;height:48px;margin-top:0;display:none" class="discount_text_box paymentclose">
                                <table class="tax_table" width="100%" border="0" cellspacing="5">
                                    <tr>
                                        <td width="45%"><?=$_SESSION['payment_pending_selectpayment']?></td>
                                        <td width="5%">:</td>
                                        <td width="50%">
                                            <select style="width:100%;" class="discount_text_box tax_textbox" id="payemntmode_sel" name="payemntmode_sel">
                                                <!--<option value="">Select Payment</option>-->
<?php
$sql_ds_nos = "select * from tbl_paymentmode WHERE pym_active='Y' and pym_takeaway_view='Y'";
$sql_ds = $database->mysqlQuery($sql_ds_nos);
$num_ds = $database->mysqlNumRows($sql_ds);
if ($num_ds) {
    $i = 1;
    while ($result_ds = $database->mysqlFetchArray($sql_ds)) {
        ?>
                                                        <option  value="<?= $result_ds['pym_code'] ?>" idval="<?= $result_ds['pym_id'] ?>" <?php if ($i == 1) { ?> selected <?php } ?> ><?= $result_ds['pym_name'] //$_SESSION[$result_ds['pym_id']]['paymentmode']?></option>
                                                        <?php $i++;
                                                    }
                                                } ?>
                                                <!-- <option value="credit_person">Credit Person</option>
                                                   <option value="complimentary">Complimentary</option>  -->  							
                                            </select>
                                        </td>
                                    </tr>

                                </table>

                            </div>
                            <!-- <div class="cash_cc">
                                 <div class="discount_text_cc crd_head">Cash</div>
                                 </div>-->

                            <div class="credit_cc_normal" style="display: none;">
                                <div class="discount_text_cc crd_head"><?=$_SESSION['payment_pending_card_title']?></div>
                                <table class="tax_table" width="100%" border="0" cellspacing="5">
                                    <tbody>
                                        <tr>
                                            <td width="35%"><?=$_SESSION['payment_pending_transactionbank']?></td>
                                            <td width="5%">:</td>
                                            <td width="50%"><div class="discount_text_box paymod_text_box">
                                                    <select id="bankdetails" class=" discount_text_box tax_textbox">
<!--                                                        <option value=""><?//=$_SESSION['payment_pending_card_bankname']?></option>-->
<?php
$sql_ds_nos = "select * from tbl_bankmaster where bm_active='Y' ";
$sql_ds = $database->mysqlQuery($sql_ds_nos);
$num_ds = $database->mysqlNumRows($sql_ds);
if ($num_ds) {
    while ($result_ds = $database->mysqlFetchArray($sql_ds)) {
        ?>    
                                                                <option value="<?= $result_ds['bm_id'] ?>"><?= $result_ds['bm_name']//$result_ds['bm_name'] ?></option>
                                                            <?php }
                                                        } ?>
                                                    </select>
                                                </div></td>
                                        </tr>
                                        <tr>
                                            <td width="35%"><?=$_SESSION['payment_pending_transactionamount']?></td>
                                            <td width="5%">:</td>
                                            <td width="50%"><div class="discount_text_box paymod_text_box">
                                                    <input type="hidden" name="pending" id="paymentmsg1" value="<?=$_SESSION['payment_pending_error_comp_remark']?>">
                                                    <input type="hidden" name="pending" id="paymentmsg2" value="<?=$_SESSION['payment_pending_error_bill_reprint']?>">
                                                  <input type="hidden" name="pending" id="paymentmsg3" value="<?=$_SESSION['payment_pending_error_select_staff']?>">
                                                  <input  placeholder="<?=$_SESSION['payment_pending_palceholder_transaction_amount']?>" class="tax_textbox transa_txt" name="transcationid" id="transcationid" onChange="transamountchange()" onkeyup="transamountchange()"  autocomplete="off">
                                                </div></td>
                                        </tr>
                                        <tr>
                                            <td width="45%"><?=$_SESSION['payment_pending_balancepay']?></td>
                                            <td width="5%">:</td>
                                            <td width="50%"><div class="discount_text_box paymod_text_box">

                                                    <input  placeholder="<?=$_SESSION['payment_pending_palceholder_card_balance']?>" class="tax_textbox transa_txt" name="transbal" id="transbal" readonly>
                                                </div></td>
                                        </tr>
                                    </tbody></table> 	
                            </div><!--credit_cc-->
                            <div class="coupon_cc" style="display: none;">
                                <div class="discount_text_cc crd_head"><?=$_SESSION['payment_pending_coupon_title']?></div>
                                <table class="tax_table" width="100%" border="0" cellspacing="5">
                                    <tbody><tr>
                                            <td width="45%"><?=$_SESSION['payment_pending_coupon_name']?></td>
                                            <td width="5%">:</td>
                                            <td width="50%"><div class="discount_text_box paymod_text_box">
                                                    <select id="menu05" class="discount_text_box tax_textbox">
                                                        <option value=""><?=$_SESSION['payment_pending_coupon_namelist']?></option>

<?php
//`tbl_couponcompany`(`cy_companyname`, `cy_active`, `cy_startdate`)
$sql_ds_nos = "select * from tbl_couponcompany where cy_active='Yes' and cy_startdate <= '" . $_SESSION['date'] . "' ";
$sql_ds = $database->mysqlQuery($sql_ds_nos);
$num_ds = $database->mysqlNumRows($sql_ds);
if ($num_ds) {
    while ($result_ds = $database->mysqlFetchArray($sql_ds)) {
        ?>    

                                                                <option value="<?= $result_ds['cy_companyname'] ?>"><?= $_SESSION[$result_ds['cy_coupid']]['coupon']//$result_ds['cy_companyname'] ?></option>

                                                            <?php }
                                                        } ?>
                                                    </select>
                                                </div></td>
                                        </tr>
                                        <tr>
                                            <td width="45%"><?=$_SESSION['payment_pending_coupon_amount']?></td>
                                            <td width="5%">:</td>
                                            <td width="50%"><div class="discount_text_box paymod_text_box">
                                                    <input  placeholder="<?=$_SESSION['payment_pending_palceholder_coupon_enteramount']?>" class="tax_textbox transa_txt" name="coupamount" id="coupamount" onChange="couponamountchange()">
                                                </div></td> 
                                        </tr>
                                        <tr>
                                            <td width="45%"><?=$_SESSION['payment_pending_coupon_balancepay']?></td>
                                            <td width="5%">:</td>
                                            <td width="50%"><div class="discount_text_box paymod_text_box">
                                                    <input  placeholder="<?=$_SESSION['payment_pending_palceholder_coupon_balance']?>" class="tax_textbox transa_txt" name="coupbal" id="coupbal" readonly>
                                                </div></td>
                                        </tr>
                                    </tbody></table> 
                            </div><!--coupon_cc-->
                            <div class="voucher_cc" style="display: none;">
                                <div class="discount_text_cc crd_head"><?=$_SESSION['payment_pending_voucher_title']?></div>
                                <table class="tax_table" width="100%" border="0" cellspacing="5">
                                    <tbody><tr>
                                            <td width="45%"><?=$_SESSION['payment_pending_voucher_id']?></td>
                                            <td width="5%">:</td>
                                            <td width="50%"><div class="discount_text_box paymod_text_box">
                                                    <input  placeholder="<?=$_SESSION['payment_pending_palceholder_voucher_id']?>" class="tax_textbox transa_txt" name="vouchid" id="vouchid" >
                                                </div></td>
                                        </tr>
                                        <tr>
                                            <td width="45%"><?=$_SESSION['payment_pending_voucher_amount']?></td>
                                            <td width="5%">:</td>
                                            <td width="50%"><div class="discount_text_box paymod_text_box">
                                                    <input  placeholder="<?=$_SESSION['payment_pending_palceholder_voucher_amount']?>" class="tax_textbox transa_txt" name="vocamount" id="vocamount" readonly  autocomplete="off" >
                                                </div></td> 
                                        </tr>
                                        <tr>
                                            <td width="45%"><?=$_SESSION['payment_pending_balancepay']?></td>
                                            <td width="5%">:</td>
                                            <td width="50%"><div class="discount_text_box paymod_text_box">
                                                    <input  placeholder="<?=$_SESSION['payment_pending_palceholder_voucher_balance']?>" class="tax_textbox transa_txt" name="vouchbal" id="vouchbal" readonly>
                                                </div></td>
                                        </tr>
                                    </tbody></table> 
                            </div><!--voucher_cc-->
                            <div class="cheque_cc" style="display: none;">
                                <div class="discount_text_cc crd_head"><?=$_SESSION['payment_pending_cheque_title']?></div>
                                <table class="tax_table" width="100%" border="0" cellspacing="5">
                                    <tbody><tr>
                                            <td width="45%"><?=$_SESSION['payment_pending_cheque_no']?></td>
                                            <td width="5%">:</td>
                                            <td width="50%"><div class="discount_text_box paymod_text_box">
                                                    <input  placeholder="<?=$_SESSION['payment_pending_palceholder_cheque_no']?>" class="tax_textbox transa_txt"  name="cheqname" id="cheqname">
                                                </div></td>
                                        </tr>
                                        <tr>
                                            <td width="45%"><?=$_SESSION['payment_pending_cheque_bankname']?></td>
                                            <td width="5%">:</td>
                                            <td width="50%"><div class="discount_text_box paymod_text_box">
                                                    <input  placeholder="<?=$_SESSION['payment_pending_palceholder_cheque_bankname']?>" class="tax_textbox transa_txt" name="cheqbank" id="cheqbank">
                                                </div></td>
                                        </tr>
                                        <tr>
                                            <td width="45%"><?=$_SESSION['payment_pending_check_amount']?></td>
                                            <td width="5%">:</td>
                                            <td width="50%"><div class="discount_text_box paymod_text_box">
                                                    <input  placeholder="<?=$_SESSION['payment_pending_palceholder_cheque_amount']?>" class="tax_textbox transa_txt" name="cheqamount" id="cheqamount" onChange="cheqamountchange()" onkeyup="cheqamountchange()"  autocomplete="off">
                                                </div></td>
                                        </tr>
                                        <tr>
                                            <td width="45%"><?=$_SESSION['payment_pending_cheque_balancepay']?></td>
                                            <td width="5%">:</td>
                                            <td width="50%"><div class="discount_text_box paymod_text_box">
                                                    <input  placeholder="<?=$_SESSION['payment_pending_palceholder_cheque_balance']?>" class="tax_textbox transa_txt" name="cheqbal" id="cheqbal" readonly>
                                                </div></td>
                                        </tr>
                                    </tbody></table> 	
                            </div><!--cheque_cc-->


                            <!--credit_ccc-->


                            <div style="display:none" class="complimentrary_cc auto1" >
                                <div class="discount_text_cc crd_head"><?=$_SESSION['payment_pending_complementary_title']?></div>
                                <textarea placeholder="<?=$_SESSION['payment_pending_palceholder_enter_complimentary']?>"  class="room_textarea" name="completext" id="completext"></textarea>
                            </div><!--complimentrary_cc-->


                            <div style="display:none" class="complimentrary_management " >
                                <div class="discount_text_cc crd_head"><?=$_SESSION['payment_pending_comp_management']?></div>


                                <div class="crd_select_head_cc">
                                    <span style="width: 20%" class="room_no_txt"><?=$_SESSION['payment_pending_comp_staff']?> :</span>
                                    <span style="width: 78%;float: left" class="room_text_box_cc">
                                        <select  class="staff_menu_select" name="selectstafcomp" id="selectstafcomp">
                                            <option value=""><?=$_SESSION['payment_pending_comp_selectstaff']?></option>
<?php
$sql_ds_nos = "select sm.ser_firstname,sm.ser_staffid  from  tbl_staffmaster as sm  where   sm.ser_employeestatus='Active' AND ser_compl_mgmt='Y'";
$sql_ds = $database->mysqlQuery($sql_ds_nos);
$num_ds = $database->mysqlNumRows($sql_ds);
if ($num_ds) {
    while ($result_ds = $database->mysqlFetchArray($sql_ds)) {
        ?>    

                                                    <option value="<?= $result_ds['ser_staffid'] ?>" ><?= $result_ds['ser_firstname'] ?></option>

                                                <?php }
                                            } ?>                            
                                        </select>
                                    </span>
                                </div>




                                <textarea placeholder="<?=$_SESSION['payment_pending_palceholder_enter_compmanagement']?>"  class="room_textarea" name="completext_mng" id="completext_mng"></textarea>
                            </div><!--complimentrary_cc-->

                            <!--<div style="display:none;" class="complimentrary_cc auto1" >-->



                            <div class="paid_amount_cc" style="display:none">
                                <table class="tax_table" width="100%" border="0" cellspacing="5">
                                    <tbody>
                                        <tr>
                                            <td width="45%"><?=$_SESSION['payment_pending_amount_paid']?></td>
                                            <td width="5%">:</td>
                                            <td width="50%"><div class="discount_text_box paymod_text_box">
                                                    <input  placeholder="<?=$_SESSION['payment_pending_palceholder_balance_amount']?>" class="tax_textbox transa_txt" id="paidamount" name="paidamount" onChange="enterbalance()" onkeyup="enterbalance()" value="0"  autocomplete="off">
                                                </div></td>
                                        </tr>
                                        <tr>
                                            <td width="45%"><?=$_SESSION['payment_pending_balance_amount']?></td>
                                            <td width="5%">:</td>
                                            <td width="50%"><div class="discount_text_box paymod_text_box">
                                                    <input  placeholder="<?=$_SESSION['payment_pending_palceholder_enteramount']?>" class="tax_textbox transa_txt" id="balanceamout" name="balanceamout" value="0" readonly>
                                                </div></td>
                                        </tr>
                                    </tbody>
                                </table> 

                            </div><!--paid_amount_cc-->

                            <div class="paid_amount_cc_credit" style="display:none">
                                <table class="tax_table" width="100%" border="0" cellspacing="5">
                                    <tbody>
                                        <tr>
                                            <td width="45%"><?=$_SESSION['payment_pending_credit_amount']?></td>
                                            <td width="5%">:</td>
                                            <td width="50%"><div class="discount_text_box paymod_text_box">
                                                    <input  placeholder="<?=$_SESSION['payment_pending_palceholder_credit_enteramount']?>" class="tax_textbox transa_txt" id="paidamount_credit" name="paidamount_credit" onChange="enterbalance_credit()"  value="0" autocomplete="off">
                                                </div></td>
                                        </tr>
                                        <tr>
                                            <td width="45%"><?=$_SESSION['payment_pending_credit_balance']?></td>
                                            <td width="5%">:</td>
                                            <td width="50%"><div class="discount_text_box paymod_text_box">
                                                    <input  placeholder="<?=$_SESSION['payment_pending_palceholder_creditbalance_amount']?>" class="tax_textbox transa_txt" id="balanceamout_credit" name="balanceamout_credit" value="0" readonly>
                                                </div></td>
                                        </tr>
                                      <!--  <tr>
                                        <td width="45%">Balance Returned</td>
                                        <td width="5%">:</td>
                                        <td width="50%"><div class="discount_text_box paymod_text_box">
                                                 <input  placeholder="Enter Balance Amount" class="tax_textbox transa_txt" id="balanceretu_credit" name="balanceretu_credit" value="0" readonly>
                                            </div></td>
                                        </tr>-->
                                    </tbody>
                                </table> 

                            </div><!--paid_amount_cc-->



                            <div style="display:none" class=" auto">
                                <div class="discount_text_cc crd_head"><?=$_SESSION['payment_pending_credit_title']?></div>
                                <div class="crd_select_head_cc">
                                    <span style="width: 20%" class="room_no_txt"><?=$_SESSION['payment_pending_credit_select']?> :</span>
                                    <span style="width: 78%;float: left" class="room_text_box_cc">
                                        <select  class="staff_menu_select" name="selectcreditypes" id="selectcreditypes">
                                            <option value=""><?=$_SESSION['payment_pending_credit_selectlist']?></option>
<?php
//`tbl_credit_types`(`ct_creditid`, `ct_credit_type`, `ct_active`)
$sql_ds_nos = "select * from tbl_credit_types where ct_active='Y' ";
$sql_ds = $database->mysqlQuery($sql_ds_nos);
$num_ds = $database->mysqlNumRows($sql_ds);
if ($num_ds) {
    while ($result_ds = $database->mysqlFetchArray($sql_ds)) {
        ?>    

                                       <option value="<?= $result_ds['ct_creditid'] ?>" label="<?=$result_ds['ct_credit_type']// $result_ds['ct_labels'] ?>"><?=$_SESSION[$result_ds['ct_creditid']]['credittypes_type']// $result_ds['ct_credit_type'] ?></option>

                                                <?php }
                                            } ?>                            
                                        </select>
                                    </span>
                                </div>
                                <div class="credit_room_cc credtitypeloads" >
                                          <!--<span class="room_no_txt">Room No :</span>
                                        <span class="room_text_box_cc">
                                          <select  class="staff_menu_select">
                                          <option value="">Room No</option>
                                            <option value="">123</option>                              
                                          </select>
                                        </span>-->
                                </div><!--credit_staff_cc-->


                            </div>


                            <div class="take_staff_view_cont_bottom_contain">

                                <a href="#" class="closetranscations" ><div class="bill_print_btn"><?=$_SESSION['payment_pending_paidbutton']?></div></a>
                                <a href="#" class="closetranscations_whole" style="display:none"><div class="bill_print_btn"><?=$_SESSION['payment_pending_comp_closebutton']?></div></a>
                            </div>
                        </div><!--take_oder_right_detail-->
                        <div class="right_bottom_btn_cc" id="ta_submitbutton" style="display:none">
                            <a class="right_sub_btn" href="#" id="ta_staffsubmit"> Submit </a>
                        </div>
                    </div><!--take_staff_view_cont_cc-->
                </div><!--take_staff_view_cc-->

            </div><!--left_contant_container-->




        </div><!--middle_container-->          
    </div><!--container_fluide-->


<!-- <script src="js/takeaway_staff.js"></script>
  <script src="js/takeaway_biilsubmn.js"></script>-->
<!--   <script src="js/basicTabs-min.js"></script>
        <link rel="stylesheet" href="btn/tabs_cont_2.css">
   
        <script type="text/javascript">
        $(document).ready(function(){
                $('#tabwrap').basicTabs();
        });
        </script> -->

    <script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
    <!-- library for cookie management -->
    <script src="js/jquery.cookie.js"></script> 



    <div style="display:none;height: auto;bottom: auto;top: 30%;width:500px;" class="index_popup_2 loadcanceldetails">
        <div class="index_popup_contant textcontent"><h3 class="sm_pop_head"><?=$_SESSION['payment_pending_pop_authori']?>
                <div style="width: 35%;height: 30px;float: right;"><span style="color:#F00;font-size:15px; text-align:center !important;display:none" id="deatilserror"></span></div>
            </h3></div>

        <div class="index_popup_contant contenttext" style="display:inline-block;margin-left:5%;text-align:left;width:100%;height:auto">
            <span style="line-height: 40px;width:26%;float:left"><?=$_SESSION['payment_pending_pop_reason']?></span><div style="background-color: #fff !important;width: 60%;height:auto;    margin-bottom: 15px;" class="btn_index_popup"><input type="text" class="popup_conform_his" style="" name="reasontext" id="reasontext"></div><br>
            <span style="line-height: 40px;width:26%;float:left"><?=$_SESSION['payment_pending_pop_staffname']?></span><div style="background-color: #fff !important;width: 60%;height:auto;" class="btn_index_popup" >
                <select style="float: left;width: 51%;" class="popup_conform_his"  id="stafflist" name="stafflist" >
                    <option value="null" default><?=$_SESSION['payment_pending_pop_selstaff']?></option>
<?php
$sql_login = $database->mysqlQuery("select * from tbl_staffmaster WHERE ser_cancelpermission='Y' AND ser_employeestatus='Active'");
$num_login = $database->mysqlNumRows($sql_login);
if ($num_login) {
    while ($result_login = $database->mysqlFetchArray($sql_login)) {
        ?>
                            <option class="popup_conform_his" value="<?= $result_login['ser_staffid'] ?>" cancelkey="<?= $result_login['ser_cancelwithkey'] ?>"><?=  $_SESSION[$result_login['ser_staffid']]['staffmaster_first']//$result_login['ser_firstname'] ?></option>
                        <?php }
                    } ?>	
                </select>
                <div style="margin-top:0px !important;" class="btn_index_popup_send otp_gent_btn"><a href="#" class="sendotp"><?=$_SESSION['payment_pending_pop_sendotp']?></a></div>

            </div><br>
            <span style="line-height: 40px;width:26%;float:left"><?=$_SESSION['bill_history_popup_enter_password']?><span id="typeentery"> </span></span><div style="background-color: #fff !important;width: 60%;" class="btn_index_popup"><input class="popup_conform_his" style="float: left;" type="password" name="secretkey" id="secretkey"></div>
        </div>   
        <div class="index_popup_contant" style="margin-top:-6px;height: 40px;">
            <div style="width: 95px;" class="btn_index_popup"><a href="#" class="submitregncancelation"><?=$_SESSION['payment_pending_pop_sumbit']?></a></div>
            <div style="width: 95px;" class="btn_index_popup"><a href="#" class="closeregnpopup"><?=$_SESSION['payment_pending_pop_cancel']?></a></div>
        </div>      
    </div>




    <div style="display:none;height: auto;bottom: auto;top: 30%;width:500px;" class="index_popup_2 loadcompauth">
        <div class="index_popup_contant textcontent"><h3 class="sm_pop_head"><?=$_SESSION['payment_pending_pop_authori']?>
                <div style="width: 35%;height: 30px;float: right;"><span style="color:#F00;font-size:15px; text-align:center !important;display:none" id="deatilserror"></span></div>
            </h3></div>

        <div class="index_popup_contant contenttext" style="display:inline-block;margin-left:5%;text-align:left;width:100%;height:auto">
            <!--<span style="line-height: 40px;width:26%;float:left">Reason</span><div style="background-color: #fff !important;width: 60%;height:auto;    margin-bottom: 15px;" class="btn_index_popup"><input type="text" class="popup_conform_his" style="" name="reasontext" id="reasontext"></div><br>-->
            <span style="line-height: 40px;width:26%;float:left"><?=$_SESSION['payment_pending_pop_staffname']?></span><div style="background-color: #fff !important;width: 60%;height:auto;" class="btn_index_popup" >
                <select style="float: left;width: 51%;" class="popup_conform_his"  id="stafflist_comp" name="stafflist_comp" >
                    <option value="null" default><?=$_SESSION['payment_pending_pop_selstaff']?></option>
<?php
$sql_login = $database->mysqlQuery("select * from tbl_staffmaster WHERE ser_cancelpermission='Y' AND ser_employeestatus='Active'");
$num_login = $database->mysqlNumRows($sql_login);
if ($num_login) {
    while ($result_login = $database->mysqlFetchArray($sql_login)) {
        ?>
                            <option class="popup_conform_his" value="<?= $result_login['ser_staffid'] ?>" cancelkey="<?= $result_login['ser_cancelwithkey'] ?>"><?= $_SESSION[$result_login['ser_staffid']]['staffmaster_first']//$result_login['ser_firstname'] ?></option>
                        <?php }
                    } ?>	
                </select>
                <div style="margin-top:0px !important;" class="btn_index_popup_send otp_gent_btn"><a href="#" class="sendotp"><?=$_SESSION['payment_pending_pop_sendotp']?></a></div>

            </div><br>
            <span style="line-height: 40px;width:26%;float:left"><?=$_SESSION['bill_history_popup_enter_password']?> <span id="typeentery"> </span></span><div style="background-color: #fff !important;width: 60%;" class="btn_index_popup"><input class="popup_conform_his" style="float: left;" type="password" name="secretkey_comp" id="secretkey_comp"></div>
        </div>   
        <div class="index_popup_contant" style="margin-top:-6px;height: 40px;">
            <div style="width: 95px;" class="btn_index_popup"><a href="#" class="submitloadcompauth"><?=$_SESSION['payment_pending_pop_sumbit']?></a></div>
            <div style="width: 95px;" class="btn_index_popup"><a href="#" class="closeloadcompauth"><?=$_SESSION['payment_pending_pop_cancel']?></a></div>
        </div>      
    </div>


    <div style="display:none" class="confrmation_overlay"></div>
<input type="hidden" name="hidregennotpos"  id="hidregennotpos" value="<?=$_SESSION['payment_pending_error_regennot']?>" >
<input type="hidden" name="hidselbiltopr"  id="hidselbiltopr" value="<?=$_SESSION['payment_pending_error_selectbill']?>" >
<input type="hidden" name="hidenterpaswd" id="hidenterpaswd" value="<?=$_SESSION['completed_order_popup_password']?>">
<input type="hidden" name="hidenterotp" id="hidenterotp" value="<?=$_SESSION['completed_order_popup_otp']?>">
<input type="hidden" name="hiderrormg" id="hiderrormg" value="<?=$_SESSION['completed_order_error_error_mg']?>">
<input type="hidden" name="hidentramt" id="hidentramt" value="<?=$_SESSION['payment_pending_enteramount']?>">
<input type="hidden" name="hidinsufamt" id="hidinsufamt" value="<?=$_SESSION['payment_pending_insufamount']?>">
<input type="hidden" name="hidentertrnsdt" id="hidentertrnsdt" value="<?=$_SESSION['payment_pending_entertransdt']?>">
<input type="hidden" name="hidchktrnsdt" id="hidchktrnsdt" value="<?=$_SESSION['payment_pending_chktransdt']?>">
<input type="hidden" name="hidselectcoup" id="hidselectcoup" value="<?=$_SESSION['payment_pending_selectcoupon']?>">
<input type="hidden" name="hidentervoucher" id="hidentervoucher" value="<?=$_SESSION['payment_pending_entervoucher']?>">
<input type="hidden" name="hidenterchequeamt" id="hidenterchequeamt" value="<?=$_SESSION['payment_pending_enterchequeamt']?>">
<input type="hidden" name="hidenterbankname" id="hidenterbankname" value="<?=$_SESSION['payment_pending_enterbankname']?>">
<input type="hidden" name="hidenterchecknumber" id="hidenterchecknumber" value="<?=$_SESSION['payment_pending_enterchecknumber']?>">
<input type="hidden" name="hidincrt_amt" id="hidincrt_amt" value="<?=$_SESSION['payment_pending_incrt_amt']?>">
<input type="hidden" name="hidsel_paytype" id="hidsel_paytype" value="<?=$_SESSION['payment_pending_sel_paytype']?>">
<input type="hidden" name="hidsel_credttype" id="hidsel_credttype" value="<?=$_SESSION['payment_pending_sel_credttype']?>">
<input type="hidden" name="hidadd_compli_rem" id="hidadd_compli_rem" value="<?=$_SESSION['payment_pending_add_compli_rem']?>">
<input type="hidden" name="hidvoucher_not" id="hidvoucher_not" value="<?=$_SESSION['payment_pending_voucher_not']?>">
<input type="hidden" name="hidvoucher_ok" id="hidvoucher_ok" value="<?=$_SESSION['payment_pending_voucher_ok']?>">
<input type="hidden" name="hidincrt_coupamt" id="hidincrt_coupamt" value="<?=$_SESSION['payment_pending_incrt_coupamt']?>">
<input type="hidden" name="hidincrt_cheqamt" id="hidincrt_cheqamt" value="<?=$_SESSION['payment_pending_incrt_cheqamt']?>">
<input type="hidden" name="hidsel_tabls" id="hidsel_tabls" value="<?=$_SESSION['payment_pending_sel_tabls']?>">
<input type="hidden" name="hidsel_option" id="hidsel_option" value="<?=$_SESSION['payment_pending_select_roomname']?>">

<input type="hidden" name="hidproc_regen" id="hidproc_regen" value="<?=$_SESSION['procedures_proc_bill_regenerate']?>">


    <script>

                                                        $('.sendotp').click(function () {//alert("j");


                                                            var stafflist = $('#stafflist').val();//alert(stafflist);
                                                            stafflist = $.trim(stafflist);
                                                            $.post("load_bill_history.php", {stafflist: stafflist, set: 'sendotp'},
                                                                    function (data)
                                                                    {
                                                                        data = $.trim(data);
                                                                        //alert(data);
                                                                    });


                                                        });

    </script>



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

    </style>

</body>

</html>