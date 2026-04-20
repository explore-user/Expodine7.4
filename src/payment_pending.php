<?php
header('Content-Type: text/html; charset=utf-8');
include('includes/session.php');  // Check session
//session_start();
include("database.class.php"); // DB Connection class
$database = new Database();
require_once("includes/title_settings.php");
include('includes/master_settings.php');
include('includes/menu_settings.php');
include("api_multiplelanguage_link.php");
$floorid=  trim(json_encode($_SESSION['floorid']),'""');
$other_lang=  trim(json_encode($_SESSION['main_language']),'""');
$from_page='';



if(isset($_REQUEST['billedno'])){
    $billedno=$_REQUEST['billedno'];
}
if(isset($_REQUEST['from_page'])){
    $from_page=$_REQUEST['from_page'];
}
 
if ( !isset($_SESSION['iddofcurrency']) ) {
    
    $_SESSION['iddofcurrency'] = 1;
} else {



 if(isset($_REQUEST['set'])&&($_REQUEST['set']=="cat1")){
                  $iddcur=trim($_REQUEST['idofcur']); 
           $_SESSION['iddofcurrency']=$iddcur;
           echo $_SESSION['iddofcurrency'];    
                                     }
}





if ( !isset($_SESSION['iddofcurrency1']) ) {
    
    $_SESSION['iddofcurrency1'] = 1;
} else {

 if(isset($_REQUEST['set1'])&&($_REQUEST['set1']=="cat11")){
                  $iddcur1=trim($_REQUEST['idofcur1']); 
           $_SESSION['iddofcurrency1']=$iddcur1;
                 
                                     }
}

        
            if(isset($_REQUEST['setmultinew16'])&&($_REQUEST['setmultinew16']=="multicardnew16")){
               $multibilledit16=     $_REQUEST['multibillnew16'];
               $_SESSION['billcard16']=$multibilledit16;
               
             
            } 
            
            
             if(isset($_REQUEST['setdel'])&&($_REQUEST['setdel']=="delcar")){
             $multibilldel=      'temp_'.$_REQUEST['bilcard'];
             $multislnodel=     $_REQUEST['slnocard'];
          
           
             $query321=$database->mysqlQuery("  DELETE FROM tbl_bill_card_payments WHERE mc_billno='$multibilldel' and mc_slno='$multislnodel' ");    
             
            }
 
            
            
    if(isset($_REQUEST['sethistory'])&&($_REQUEST['sethistory']=="delhistory")){
             $multibilldelhistory=     $_REQUEST['bilcardhistory'];
        
             $queryhistory=$database->mysqlQuery("  DELETE FROM tbl_bill_card_payments WHERE (mc_billno = 'temp_".$multibilldelhistory."' or mc_billno = '".$multibilldelhistory."')");  
           
            }           
            
 
       
 
 
if (!isset($_SESSION['timeopen'])) {
    header("location:index.php?msg=1");
}
unset($_SESSION['set_billnotosplit']);

if (isset($_SESSION['bilsplitorderfinal'])) {
    $bills = $_SESSION['bilsplitorderfinal'];
    foreach ($bills as $number => $value) {//$value=tbl_temp_tablebillmaster  bm_temp_billno 
        //tbl_temp_tablebilldetails  bd_temp_billno
        //$sql_table_sel  =  $database->mysqlQuery("DELETE FROM tbl_tablebilldetails WHERE bd_billno='".$value."'");
// $sql_table_sel  =  $database->mysqlQuery("DELETE FROM tbl_temp_tablebillmaster WHERE bm_temp_billno='".$value."'");
// $sql_table_sel  =  $database->mysqlQuery("DELETE FROM tbl_temp_tablebilldetails WHERE bd_temp_billno='".$value."'");
    }
    unset($_SESSION['bilsplitorderfinal']);
    unset($_SESSION['finalbills']);
}
error_reporting(0);
 
?>
<!DOCTYPE HTML>
<html><head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title> Billgeneration</title>
        <link rel="shortcut icon" href="img/favicon.ico">
        <link href="css/bootstrap-cerulean.min.css" rel="stylesheet" />
        <link href="css/order_new.css" rel="stylesheet" type="text/css">
        <link href="css/take_away.css" rel="stylesheet" type="text/css">
         <link href="css/counter_order_new.css" rel="stylesheet" type="text/css">
        <link href="css/billgeneration_new.css" rel="stylesheet" type="text/css">
        <script src="js/jquery-1.10.2.min.js"></script> 

        <script src="js/bill_paymentscreen_main.js"></script> 
        <script src="js/bill_paymentscreen_select.js"></script>
        <script src="js/bill_paymentscreen_sort.js"></script>
        <style>
			#typeentery	{padding-left:5px;}
            body{font-family:inherit}
            .left_contant_container {height: 80vh;padding-bottom:15px;}	
            .tax_table td{  padding-left: 12px;text-align: left;}
            .tax_textbox {width: 100%;}
            .discount_text_cc{text-align:center}
            .take_staff_view_cc{width: 49.5%;margin:0px !important;margin-left:0.6% !important;margin-top: 5px !important;}
            /*#billdetails .billgenration_new_table tbody {min-height: 410px;height: 73vh;}*/
            .tottal_rate_contain {width: auto;min-width: 110px;float: right;height: 40px;line-height: 38px;font-size: 15px;color: #FFF;font-weight:400;margin-right:1%}
            .payment_pend_right_cash_head_txt{width:20%;}
            .payment_pend_right_cash_error{width:78%;text-align:center}
            .tottal_rate_contain {height: 30px;line-height: 30px;padding-right:1%;}
            .billgenration_new_table tbody {min-height: 200px;height: 57vh;}
			.error_feed{position: absolute; top: -45px;left: 310px;z-index: 9999;}
			.billgenration_new_table_content td{height:35px;}
			.billgenration_new_table td{height:37px;    padding-top: 4px;}
			.billgenration_new_table_content_container{height: 69vh;}
			.take_staff_view_cont_bottom_contain{height: 55px;}
			.bill_print_btn{width: 17%;height: 37px;margin-right: 4px;background-color: #F5351B;line-height: 33px;box-shadow: inset 0px 0px 10px #670c00;border-bottom: 4px solid rgba(6, 0, 0, 0.66);text-shadow: 1px 1px 5px #3c3636;margin-top: 9px;background-color:#e02a11;}
			.new_right_drop{position: absolute !important;right: 3px;top: 49px !important;}
			.counter_settle_popup .tax_textbox {width: 49%;}
			#amount_credit{width:100%;}
			#crtype_div .room_text_box_cc{width:49%;}
			.tax_textbox{height:35px;}
			.paid_amount_cc{margin-top:0;}
			.sec_pop_div_right{padding-bottom:7px;}
                        .disablegenerate
        {
            pointer-events: none;
            opacity: 0.4;
            cursor:none;

        }
        .card_active{
            background-color:#28a4c9 !important;
        }
        .pointer         { cursor: pointer; }
        .size_compat option{font-size:20px}
        .card_popup_digits{margin-bottom: 3px}
        .suggession_list{background-color: #ccc;}
        .customer_list_autoload{
    width: 49%;
    height: auto;
    float: left;
    position: absolute;
    top: 40px;
    right: 5px;
    z-index: 999;
    background-color: #fff;
    border: 1px #ccc solid;
    border-top: 0;
	    max-height: 220px;
    overflow: auto;
	
}
.customer_list_autoload ul{margin: 0;padding: 0;}
.customer_list_autoload li{list-style: none;width: 100%;float: left;padding: 5px;}
.customer_list_autoload li:hover{background-color: #f4f4f4}
 .list_select_active{background-color:#ccc}  
 .combo_tbl_lst{width: 100%; font-size: 11px;  color: #6d0a21;  line-height: 11px !important;
    display: inline-block;}
 
 .tip_section{
    width: 375px;
    float: right;
/*
    border-left: 1px solid rgb(204, 204, 204);
    border-bottom: 1px solid rgb(204, 204, 204);
    border-right: 1px solid rgb(204, 204, 204);
*/
    padding-bottom: 3px;   
}
.tip_section .selecting_payment_one {margin-top: 0px; background-color: beige;padding: 3px 0}
.tip_section .counter_right_lable{font-weight: bold}
.counter_settle_popup .tip_section .tax_textbox{  background: transparent;}
.addon_txt{color: #f00}
 
        </style>
        <?php
        
           
        $sql_desg_nos11="select be_min_redeem_point,be_sms_list,be_settle_billprint from tbl_branchmaster";

				$sql_desg11  =  $database->mysqlQuery($sql_desg_nos11);
				$num_desg11  = $database->mysqlNumRows($sql_desg11);
			        $i=1;
                                $printpermission="";
                                $sms_lst="";
				if($num_desg11){
				while($result_desg11  = $database->mysqlFetchArray($sql_desg11)) 
					{
						$min_redeem=$result_desg11['be_min_redeem_point'];					
						$sms_lst=$result_desg11['be_sms_list'];
                                                $printpermission=$result_desg11['be_settle_billprint'];
					}
                                        
                                       
                                        ?>

 <input type="hidden" name="chksms" id="chksms" value="<?=$sms_lst?>" />
 <input type="hidden" name="settlebill" id="settlebill" value="<?=$printpermission?>" />
 <input type="hidden" id="min_redeem" value="<?=$min_redeem?>">

				<?php   } 
                                
                                
          
         $point_rule=1;                        
         $amount_rule=1;                    
        $sql_desg_nos119="select * from tbl_loyalty_redeem_rule";

				$sql_desg119  =  $database->mysqlQuery($sql_desg_nos119);
				$num_desg119  = $database->mysqlNumRows($sql_desg119);
			      
				if($num_desg119){
				while($result_desg119  = $database->mysqlFetchArray($sql_desg119)) 
					{
						$point_rule=$result_desg119['lyr_point'];					
						$amount_rule=$result_desg119['lyr_amount'];
                                              
					}
                                        
                                }
                                
                                $point_rule_add=1; $amount_rule_add=1;
                                $sql_desg_nos1190="select * from tbl_loyalty_pointrule";

				$sql_desg1190  =  $database->mysqlQuery($sql_desg_nos1190);
				$num_desg1190  = $database->mysqlNumRows($sql_desg1190);
			      
				if($num_desg1190){
				while($result_desg1190  = $database->mysqlFetchArray($sql_desg1190)) 
					{
						$point_rule_add=$result_desg1190['lyp_point'];					
						$amount_rule_add=$result_desg1190['lyp_amount'];
                                              
					}
                                        
                                }
                                
                                
                                
                                
                                ?>  
 <input type="hidden" id="point_rule_add" amt_add="<?=$amount_rule_add?>" value="<?=$point_rule_add?>" />
 <input type="hidden" id="point_rule" amt="<?=$amount_rule?>" value="<?=$point_rule?>" />
 
 <input type="hidden" name="billedno" id="billedno" value="<?=$billedno?>" />
 <input type="hidden" name="from_page" id="from_page" value="<?=$from_page?>" />
 
 <input type="hidden" id="shift_permission" value="<?=$_SESSION['shift_permission']?>">  

 <input type="hidden" id="coupon_code" >
<input type="hidden" id="code_comp_credit" >
 <input type="hidden" value="<?= $_SESSION['be_staff_sel_mode']?>" id="mode_of_entry">
        <script type="text/javascript">
            $(document).ready(function () {
               
              if($(".counter_settle_popup").css("display") == "none"){
                    var data_pole = "set_pole=pole_display_all&display=none";
			$.ajax({
			type: "POST",
			url: "index.php",
			data: data_pole,
			success: function(data5) {
			
			}
			});

                 }
 
                $(".credit_cc").hide();
                $(".coupon_cc").hide();
                $(".voucher_cc").hide();
                $(".cheque_cc").hide();
                $('.closetranscations').css("display", "none");
                $('.submittranscations_whole').css("display", "none");
                $("#payemntmode_sel").change(function () {
                    // $( "#payemntmode option:selected").each(function(){
                    var aat = ($(this).val());
                    if (aat == "cash") { 
                        
                        
                         $("#transcationid").val("");
                                       $("#transbal").val("");
                                           $("#paidamount").val("");
                                        $("#balanceamout").val("");
                              
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
                        $('.submittranscations_whole').css("display", "none");

                    }
                    if (aat == "credit") {
                   
                   
                   
                             $("#paidamount").val("");
                                        $("#balanceamout").val("");
                                         $("#transcationid").val("");
                                       $("#transbal").val("");
                                        $("#cheqamount").val("");
                                        $("#cheqbal").val("");
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
                        $('.submittranscations_whole').css("display", "none");
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
                        $('.submittranscations_whole').css("display", "none");
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
                        $('.submittranscations_whole').css("display", "none");
                    }
                    if (aat == "cheque") {
                         $("#transcationid").val("");
                                       $("#transbal").val("");
                                       $("#cheqamount").val("");
                                        $("#cheqbal").val("");
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
                        $('.submittranscations_whole').css("display", "none");
                    }

                    if (aat == "credit_person") {
                      $("#cheqamount").val("");
                                        $("#cheqbal").val("");
                         $("#transcationid").val("");
                                       $("#transbal").val("");
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
                        $('.submittranscations_whole').css("display", "block");
                    }

                    if (aat == "complimentary") {
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
                        $('.submittranscations_whole').css("display", "block");
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
                        $('.submittranscations_whole').css("display", "block");
                    }

                    //});
                });
           
    $('.closetranscations').click(function () {
       

	 var tdate = new Date();
   var dd = tdate.getDate(); //yields day
   var MM = tdate.getMonth(); //yields month
   var yyyy = tdate.getFullYear(); //yields year
   var xxx = dd+ "-"+( MM+1)+ "-" +yyyy;
		var from='a';
		var to=xxx;
         $.ajax({
			  type: "POST",
                          url: "load_sms_report.php",
                          data: "value=sms_list",
                          success: function(data) {
				  data=data.trim();
                                  //alert(data);
//                                 if(data=="Payment successfully Processed"){
                                  if(data==""){
				  var smslist=$('#chksms').val();
                                  $.post("saleslab_sms.php", {type:"summary",hidfr:from,hidto:to,list:smslist},
		              function(data)
		             {
			  	data=$.trim(data);
			
			
		  });   
                                      
                                 }
                              
                        }
                      });
    });

    
    });


        </script> 


    </head>

    <body>
        <div class="olddiv1 "></div>
        <div class="container-fluid no-padding">
            <input type="hidden" name="decimal" id="decimal" value="<?= $_SESSION['be_decimal'] ?>">
            <input type="hidden" value="<?= $_SESSION['s_default_company']?>" id="default_company" >
   <input type="hidden" name="enter_count" id="enter_count">
            <?php include "includes/topbar.php"; ?>
            <input type="hidden" name="hidcompmangauth" id="hidcompmangauth" value="<?= $_SESSION['s_compl_manage_auth'] ?>">
            <input type="hidden" name="hidbilgenper" id="hidbilgenper" value="<?= $_SESSION['s_bilregen_with_permission'] ?>">
            <input type="hidden" name="hidbilreprint" id="hidbilreprint" value="<?= $_SESSION['s_reprint_with_permission'] ?>">
            <input type="hidden" name="hidauthorise_with_code" id="hidauthorise_with_code" value="<?=$_SESSION['be_authorise_with_code']?>" />
            <input type="hidden" name="hidbilsplit_per" id="hidbilsplit_per" value="<?= $_SESSION['s_billsplit_with_permission'] ?>">
            <div class="middle_container">
                <div style="width:100%" class="top_site_map_cc ">
                    <?php include"includes/new_right_menu.php"; ?>
                    <?php if (in_array("table_selection", $_SESSION['menuarray'])) { ?> 
                        <a title="<?=$_SESSION['payment_pending_tableselection']?>" href="<?php if (isset($_SESSION['timeopen']) && !isset($_SESSION['timeclose'])) { ?> table_selection.php <?php } else { ?>#<?php } ?>"><div class="backto_table_select" style="float:left;width: 165px">
                                <div class="backtable_ico"></div>
                                <div style="width: 130px;" class="tableselect_text"><?=$_SESSION['payment_pending_tableselection']?></div>
                            </div></a>
                    <?php } ?>
                    <?php// if(in_array("take_away", $_SESSION['menuarray'])  && (in_array("payments_ta_cs", $_SESSION['menusubarray']))) { ?>
<!--                     <a title="Take Away" href="payments_ta_cs.php?mode=TA"><div class="dine_in_mn_cc">
                   	<img src="img/takeaway-payment-ico.png"><div class="dine_in_mn_text">Take Away</div>-->
<!--                   </div></a>-->
                   <?php //} ?>
                    <?php if(in_array("counter_sales", $_SESSION['menuarray'])  && (in_array("payments_ta_cs", $_SESSION['menusubarray']))) { ?>
                    <a title="Counter Sale" href="#" onclick="settlepopupcommoncs()"><div class="dine_in_mn_cc">
                   	<img src="img/countersale-ico.png"><div style="width: 94px;" class="dine_in_mn_text"><?=$_SESSION['home_headcounter'] ?></div>
                   </div></a>
					<?php } ?>
                     <?php if(in_array("take_away_", $_SESSION['menuarray'])  && (in_array("payments_ta_cs", $_SESSION['menusubarray']))) { ?>
                    <a title="Take Away" href="#" onclick="settlepopupcommonta()"><div class="dine_in_mn_cc">
                   	<img src="img/countersale-ico.png"><div style="width: 94px;" class="dine_in_mn_text">Take Away</div>
                   </div></a>
					<?php } ?>
                    
                    
                    
                    <div class="billgeneration_head"><?=$_SESSION['payment_pending_paymentpending']?></div>
                    <div class="error_feed" style="color:#F00"></div>

                    <?php if (in_array('bill_history', $_SESSION['menufullarray'])) { ?>   
                        <a tabindex="" title="<?=$_SESSION['payment_pending_billhistorybutton']?>" href="<?php if (isset($_SESSION['timeopen']) && !isset($_SESSION['timeclose'])) { ?> bill_history.php <?php } else { ?>#<?php } ?>"> <div class="backto_table_select back_bill_his" >
                                <div class="tableselect_text"><?=$_SESSION['payment_pending_billhistorybutton']?></div>
                                <div style="background-image:url(img/goto_bill_ico.png);" class="backtable_ico"></div>
                            </div></a>
                    <?php } ?>
                    
                    

                    <?php// if ((in_array("Completed Order", $_SESSION['menumodarray']))) { ?>     
<!--                        <a title="<?//=$_SESSION['payment_pending_completedorder']?>" href="<?php //if (isset($_SESSION['timeopen']) && !isset($_SESSION['timeclose'])) { ?> completed_order.php <?php //} else { ?>#<?php //} ?>"><div class="backto_table_select" style="float:right;width: 160px;">
                                <div  class="backtable_ico"></div>
                                <div style="width: 130px;" class="tableselect_text"><?=$_SESSION['payment_pending_completedorder']?></div>
                            </div></a>-->
                    <?php //} ?> 
                    
                    



                </div>

                <div style="  min-height:480px;width:100%" class="left_contant_container">

                    <div class="take_staff_view_cc" style="width:45% !important">

                        <!--<div class="bill_shadow_left"></div>-->
                        <div class="take_staff_view_head">
                            <div class="bill_head_pin"></div>
                            <div class="staf_view_list_hd"><?=$_SESSION['payment_pending_tabledetails']?></div>
                            
                        </div><!--take_staff_view_head-->



                        <div  class="take_staff_view_cont_cc">	<!--style="height:300px;min-height: 68.5vh;"-->
                            <div class="floor_sel_in_table_detail">
                                <div class="floor_area_sel_name"><?=$_SESSION['payment_pending_floorselect']?></div>
                                <div class="floor_area_sel_textbx">
                                    <select style="width:100%;" class="discount_text_box tax_textbox" id="areachnage" name="areachnage">
                                        <option value="" selected=""><?= $_SESSION['payment_pending_select_area'] ?></option>
                                        <?php
                                        //`tbl_floormaster`(`fr_floorid`, `fr_branchid`, `fr_floorname`, `fr_status`)
                                        $sql_floor_sel = '';
                                        if (!is_null($_SESSION['floorstaff'])) {
                                            $sql_floor_sel = $database->mysqlQuery("select * from tbl_floormaster where fr_branchid='" . $_SESSION['branchofid'] . "' AND fr_floorid='" . $_SESSION['floorstaff'] . "'  and fr_status='Active' order by fr_floorid");
                                        } else {
                                            $sql_floor_sel = $database->mysqlQuery("select * from tbl_floormaster where fr_branchid='" . $_SESSION['branchofid'] . "' and fr_status='Active' order by fr_floorid");
                                        }

                                        $num_floor = $database->mysqlNumRows($sql_floor_sel);
                                        if ($num_floor) {
                                            $i = 0;
                                            while ($result_floor_sel = $database->mysqlFetchArray($sql_floor_sel)) {
                                                if ($i == 0) {
                                                    $first = $result_floor_sel['fr_floorid'];
                                                    //$_SESSION['floorid']=$first; 
                                                    if (!isset($_SESSION['floorid'])) {
                                                        $_SESSION['floorid'] = $first;
                                                    }
                                                    $i++;
                                                    $firstfloor = $result_floor_sel['fr_floorname'];
                                                }
                                                    $floor_name=$result_floor_sel['fr_floorname'];
                                                   $_SESSION['florids'] = $first;
                                                   
                                                   if($_SESSION['main_language']!='english'){
                
                                                    $sql_arabfloor=$database->mysqlQuery("SELECT f_floor_name FROM tbl_language_floor left join tbl_languages on ls_id=f_lang_id WHERE f_floor_id='".$result_floor_sel['fr_floorid']."' and ls_language='".$_SESSION['main_language']."'");

                                                    //echo " SELECT f_floor_name FROM tbl_language_floor left join tbl_languages on ls_id=f_lang_id WHERE 	f_floor_id='".$result_floor['fr_floorid']."' and ls_language='".$dat."'";
                                                    $num_arabfloor = $database->mysqlNumRows($sql_arabfloor);
                                                     if($num_arabfloor){
                                                        while ($result_arabfloor = $database->mysqlFetchArray($sql_arabfloor)){
                                                    $floor_name=$result_arabfloor['f_floor_name'];

                                                    }}}
//                                                    $fpfloor=fopen($apilink."/src/main_menu_display.php?set=floors&dat=$other_lang","r");
//                                                    $response_floor['messages'] = stream_get_contents($fpfloor);
//                                                    //echo  $response['messages'];
//                                                    $resu_floor= json_decode($response_floor['messages'],true);
//                                                    //var_dump($resu_floor);
//                                                    $floor_count=count($resu_floor['floor_id']);
//                                                    for($f=0;$f<$floor_count;$f++)
//                                                    {
//                                                        if($result_floor_sel['fr_floorid']==$resu_floor['floor_id'][$f]){
//                                                            $floor_name=$resu_floor['floor_name'][$f];
//                                                        }  
//                                    
//                                                    } 
                                                ?>
                                                <option value="<?= $result_floor_sel['fr_floorid'] ?>" <?php if ($_SESSION['floorid'] == $result_floor_sel['fr_floorid']) { ?> selected <?php } ?>><?= $floor_name ?></option>	
                                            <?php }
                                        } ?> 
                                        <option value="all" <?php if ($_SESSION['floorid'] == 'all') { ?> selected <?php } ?>><?=$_SESSION['completed_order_all_flr']?></option>	
                                    </select>
                                </div>
                            </div><!--floor_sel_in_table_detail-->

                            <div class="bill_gen_new_table_head loadallhead">
                                <table class="billgenration_new_table " width="100%" border="0" >
                                    <thead>
                                        <tr>
                                        	<th width="22%"><?=$_SESSION['payment_pending_tableno']?></th>
                                            <th width="10%" class="sortbybill" style="cursor:pointer"><?=$_SESSION['payment_pending_billno']?></th>
<?php if ($_SESSION['floorid'] == 'all') { ?> <th width="20%"><?=$_SESSION['completed_order_floor_select']?></th> <?php } ?>
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

if ((isset($_REQUEST['floorid']))) {
    $_SESSION['floorid'] = $_REQUEST['floorid'];
    $_SESSION['florids'] = $_REQUEST['floorid'];
    $floorid=  trim(json_encode($_SESSION['floorid']),'""');
}

if (isset($_SESSION['floorid'])) {
    if ($_SESSION['floorid'] == "all") {
        //$sql_table_sel  =  $database->mysqlQuery("SELECT distinct(tm.tr_tableno),ts.ts_tableidprefix,b.bm_finaltotal,ts.ts_dineintime,ts.ts_orderno,fm.fr_floorname,ts.ts_tableid,ts.ts_billnumber FROM tbl_tabledetails as ts  LEFT JOIN tbl_tablebillmaster b ON b.bm_billno = ts.ts_billnumber  LEFT JOIN tbl_tablemaster as tm ON ts.ts_tableid=tm.tr_tableid LEFT JOIN tbl_tableorder as tor ON ts.ts_orderno=tor.ter_orderno LEFT JOIN tbl_floormaster as fm ON fm.fr_floorid=ts.ts_floorid WHERE tm.tr_status='Active'  AND  ((b.bm_status='Billed') AND (b.bm_status<>'Cancelled for Split'))  AND  tor.ter_dayclosedate='2016-02-05'  order by tm.tr_tableno"); 
        //$sql_table_sel  =  $database->mysqlQuery("SELECT distinct(tm.tr_tableno),ts.ts_tableidprefix,b.bm_finaltotal,ts.ts_dineintime,ts.ts_orderno,fm.fr_floorname,ts.ts_tableid,ts.ts_billnumber,b.	bm_can_regenerate FROM tbl_tabledetails as ts  LEFT JOIN tbl_tablebillmaster b ON b.bm_billno = ts.ts_billnumber  LEFT JOIN tbl_tablemaster as tm ON ts.ts_tableid=tm.tr_tableid LEFT JOIN tbl_tableorder as tor ON ts.ts_orderno=tor.ter_orderno LEFT JOIN tbl_floormaster as fm ON fm.fr_floorid=ts.ts_floorid WHERE tm.tr_status='Active'  AND  ((b.bm_status='Billed') AND (b.bm_status<>'Cancelled for Split'))  AND  tor.ter_dayclosedate='".$_SESSION['date']."'  order by tm.tr_tableno"); 
        //AND (b.bm_status<>'Cancelled for Split')
        $sql_table_sel = $database->mysqlQuery("SELECT b.bm_billno,b.bm_finaltotal, b.bm_tableno,b.bm_billtime , f.fr_floorname,b.bm_can_regenerate,f.fr_floorid FROM tbl_tablebillmaster b left join tbl_floormaster f
on b.bm_floorid = f.fr_floorid WHERE ((b.bm_status='Billed') )  AND  b.bm_dayclosedate ='" . $_SESSION['date'] . "' AND b.bm_billno not like '%temp%'   order by b.bm_billtime");
    } else {
        $sql_table_sel = $database->mysqlQuery("SELECT b.bm_billno,b.bm_finaltotal, b.bm_tableno,b.bm_billtime, f.fr_floorname,b.bm_can_regenerate ,f.fr_floorid FROM tbl_tablebillmaster b left join tbl_floormaster f
on b.bm_floorid = f.fr_floorid WHERE ((b.bm_status='Billed') )  AND  b.bm_dayclosedate ='" . $_SESSION['date'] . "' AND f.fr_floorid='" . $_SESSION['floorid'] . "' AND b.bm_billno not like '%temp%'   order by b.bm_billtime");
        //$sql_table_sel  =  $database->mysqlQuery("SELECT distinct(tm.tr_tableno),ts.ts_tableidprefix,b.bm_finaltotal,ts.ts_dineintime,ts.ts_orderno,fm.fr_floorname,ts.ts_tableid,ts.ts_billnumber,b.	bm_can_regenerate FROM tbl_tabledetails as ts  LEFT JOIN tbl_tablebillmaster b ON b.bm_billno = ts.ts_billnumber  LEFT JOIN tbl_tablemaster as tm ON ts.ts_tableid=tm.tr_tableid LEFT JOIN tbl_tableorder as tor ON ts.ts_orderno=tor.ter_orderno LEFT JOIN tbl_floormaster as fm ON fm.fr_floorid=ts.ts_floorid WHERE tm.tr_status='Active' AND ts.ts_floorid='".$_SESSION['floorid']."'  AND ((b.bm_status='Billed') AND (b.bm_status<>'Cancelled for Split')) AND  tor.ter_dayclosedate='".$_SESSION['date']."'  order by tm.tr_tableno"); 
    }
    $num_table = $database->mysqlNumRows($sql_table_sel);
    if ($num_table) {
        while ($result_table_sel = $database->mysqlFetchArray($sql_table_sel)) {
			
            $floor_name="";
            $floor_name=$result_table_sel['fr_floorname'];
            $floor_id_chk=$result_table_sel['fr_floorid'];
//            $fpfloor=fopen($apilink."/src/main_menu_display.php?set=floors&dat=$other_lang","r");
//            //echo $apilink."/src/main_menu_display.php?set=floors&dat=$other_lang";
//            $response_floor['messages'] = stream_get_contents($fpfloor);
//            //echo  $response['messages'];
//            $resu_floor= json_decode($response_floor['messages'],true);
//            //var_dump($resu_floor);
//            //var_dump($result_table_sel['fr_floorid']);
//            $floor_count=count($resu_floor['floor_id']);
//            //echo $floor_count;
//            for($f=0;$f<$floor_count;$f++)
//                {
//                    if($result_table_sel['fr_floorid']==$resu_floor['floor_id'][$f]){
//                    $floor_name=$resu_floor['floor_name'][$f];
//                    //echo $floor_name;
//                    }  
//                }
                        
            $tabn=explode(",",$result_table_sel['bm_tableno']);
            $tablename='';
            $tablename=$result_table_sel['bm_tableno'];
//            foreach($tabn as $key=>$value)
//                {
//		$splitbraces=explode("(",$value);
//		$tabid=$database->show_tableid_retieve($splitbraces[0]);
//		$tableid=$tabid['tr_tableid'];
//                
//                $fptable=fopen($apilink."/src/main_menu_display.php?set=table&floorid=&dat=$other_lang","r");
//                $response_table['messages'] = stream_get_contents($fptable);
//                //var_dump($response_table['messages']);
//                $resu_table= json_decode($response_table['messages'],true);
//                //var_dump($resu_table['table_id'][0]);
//                $table_count=count($resu_table['table_id']);
//                // echo $table_count;
//                for($m=0;$m<$table_count;$m++){
//                if($tableid==$resu_table['table_id'][$m]){
//                $table_name=$resu_table['table_name'][$m]; 
//                //echo $table_name;
//                }
//            }
//            if($tablename=="")
//            {
//                $tablename=$table_name;
//            }else{
//		$tablename=$tablename ." , ".$table_name;
//		}
//            }
            ?>
                            
                                             <tr class="clickeachrowpaymnt"  final_total="<?=number_format($result_table_sel['bm_finaltotal'],$_SESSION['be_decimal'])?>"  billno="<?= $result_table_sel['bm_billno'] ?>"  regen="<?= $result_table_sel['bm_can_regenerate'] ?>" table_id="<?= $result_table_sel['bm_tableno'] ?>"  ><!--table_id="<?= $result_table_sel['ts_tableid'] ?>"<tr class="tr_bill_gen_active"> pref="<?= $result_table_sel['ts_tableidprefix'] ?>"-->
                                             	<td width="20%"> <?= $tablename//$result_table_sel['bm_tableno'] ?></td>
                                                <td width="10%"><strong><?= $result_table_sel['bm_billno'] ?></strong></td>
                                            <?php if ($_SESSION['floorid'] == 'all') { ?> <td width="15%"><?=$floor_name// $result_table_sel['fr_floorname'] ?></td> <?php } ?>
                                                <td width="25%"> <?= date("h:i:s", strtotime($result_table_sel['bm_billtime'])) ?></td>
                                                <td width="15%"><?=number_format($result_table_sel['bm_finaltotal'],$_SESSION['be_decimal'])?>/-</td>
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
                            

                            

                        </div><!--take_staff_view_cont_cc-->
                    </div><!--take_staff_view_cc-->

                    <div class="take_staff_view_cc" style="width: 53.9% !important;margin-left: 0.3% !important;">
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

<!--                            <div class="take_staff_view_cont_bottom_contain" style="bottom: 145px;height:28px;">
                            	<div class="tottal_rate_contain" id="extratax" style="color:#000;font-size: 14px;text-align:left;width:40%;float:left;margin-left:1%;display:none">Extra tax :<span id="extratax1">0.00 </span></div>
                                <div class="tottal_rate_contain"  style="color:#000;font-size: 14px;text-align:right;width:40%;display:none">  <span ></span></div>
                            </div>-->
                            
<!--                            <div class="take_staff_view_cont_bottom_contain" style="bottom: 112px;height:28px;">
                            	<div class="tottal_rate_contain" id="servchrge_new1"  style="color:#000;font-size: 14px;text-align:left;width:40%;float:left;margin-left:1%;display:none"><?=$tx31?>:<span id="servchrge_new"> </span></div>
                                <div class="tottal_rate_contain" id="grandtotal_sec_sub1" style="color:#000;font-size: 14px;text-align:right;width:40%;display:none"><?=$_SESSION['payment_pending_subtotal']?>  : <span id="grandtotal_sec_sub">0.00</span></div>
                            </div>

                            <div class="take_staff_view_cont_bottom_contain" style="bottom: 85px;height:28px;">
                            	<div class="tottal_rate_contain" id="vat_new1" style="color:#000;font-size: 14px;text-align:left;width:40%;float:left;margin-left:1%;display:none"><?=$tx21?>: <span id="vat_new"> </span></div>
                                <div class="tottal_rate_contain" id="grandtotal_disc1" style="color:#000;font-size: 14px;text-align:right;width:40%;display:none"><?=$_SESSION['payment_pending_discount']?>   <span id="grandtotal_disc">0.00</span></div>
                            </div> -->

                            <div class="take_staff_view_cont_bottom_contain" style="bottom: 54px;height: auto; background-color: #fff;">
                            	
                                
                              <div class="tottal_rate_contain" id="printed_by_di_div" style="color:#000;font-size: 15px;text-align:left;width:40%;float: left"><strong>Printed by  : <span id="printed_by_di"></span></strong> </div>       
                              
                                <div class="tottal_rate_contain" id="grandtotal_sec_sub1"  style="color:#000;font-size: 14px;text-align:right;width:40%;float:right;margin-left:1%;display:none"><strong><?=$_SESSION['payment_pending_subtotal']?>  : <span id="grandtotal_sec_sub">0.00</span></strong></div>
                         
                                
                               
                                <div class="tottal_rate_contain" id="grandtotal_sec1" style="color:#000;font-size: 15px;text-align:right;width:40%;display:none"><strong><?=$_SESSION['payment_pending_finaltotlal']?>  : <span id="grandtotal_sec">0.00</span></strong> </div>
                            </div>
                            
                            
                            
                            <div class="take_staff_view_cont_bottom_contain regenarate" style="display:block">

                                <!--<a href="#" class="verifythetables"><div class="bill_print_btn">Verify</div></a>-->
                       <?php
                                $sql_login  =  $database->mysqlQuery("select * from tbl_branchmaster"); 
	               $num_login   = $database->mysqlNumRows($sql_login);
	               if($num_login){
		          while($result_login  = $database->mysqlFetchArray($sql_login)) 
		        {
                              
                              
                              $regenerate=$result_login['be_regenerate_enable'];
                              $reprint=$result_login['be_bill_reprint_enable'];
                              $billsplit=$result_login['be_billsplit'];
                              $multion=$result_login['be_multicard'];
                              $loyalty_on_off=$result_login['be_loyalty_settle'];
                       } }
                       
                       
                               $sql_login_stf  =  $database->mysqlQuery("select * from tbl_staffmaster where ser_staffid='".$_SESSION['loginempid_id']."' "); 
	               $num_login_stf   = $database->mysqlNumRows($sql_login_stf);
	               if($num_login_stf){
		          while($result_login_stf  = $database->mysqlFetchArray($sql_login_stf)) 
		        {
                              
                                



                              $regenerate_staff=$result_login_stf['ser_bill_regen_per'];
                              $bill_reprint_staff=$result_login_stf['ser_bill_reprint_per'];
                              $kot_reprint_staff=$result_login_stf['ser_kot_reprint_per'];
                              $change_staff=$result_login_stf['ser_bill_settle_change_per'];
                       } }
                       
                       
                       
                       ?>
                    <a href="#" class="settlethetables"><div class="bill_print_btn settle_new_btn_gen primary-clr"><?=$_SESSION['payment_pending_settlebutton']?></div></a>   
                    <?php            
                    if($regenerate == "Y" ){?>
                        <a href="#" class="regenratethetables threebtn" mode="Regen"><div class="bill_print_btn"><?=$_SESSION['payment_pending_regeneratebutton']?></div></a>        
                    <?php } if($reprint == "Y" ){?>
                        <a href="#" class="repreintthetables threebtn reprint_new" mode="Reprnt" fl_chk="<?=$_SESSION['floorid']?>"><div class="bill_print_btn"><?=$_SESSION['payment_pending_reprintbutton']?></div></a>
                    <?php } if($billsplit != "Y" && $billsplit != "N" && $billsplit != "" ){
                        if (in_array("bill_split", $_SESSION['menufullarray'])) {?> 
                            <input type="hidden" name="namesplitview" id="namesplitview" value="Y">
                        <?php } else{?>
                            <input type="hidden" name="namesplitview" id="namesplitview" value="N">
                        <?php } ?>
                            <a href="#" style="display:none" class="bilsplitthetables threebtn" mode="Billsplit"><div class="bill_print_btn"><?=$_SESSION['payment_pending_billsplitbutton']?></div></a>  
                    <?php } ?>
                    
                            </div>

                        </div><!--take_staff_view_cc-->

                    </div><!--take_staff_view_cont_cc-->

                    <!--take_staff_view_cont_cc-->
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



    <div style="display:none;height: auto;bottom: auto;top: 30%;width:500px;padding-bottom:10px;" class="index_popup_2 loadcanceldetails">
        <div class="index_popup_contant textcontent"><h3 class="sm_pop_head"><?=$_SESSION['payment_pending_pop_authori']?>
                <div style="width: 35%;height: 30px;float: right;"><span style="color:#F00;font-size:15px; text-align:center !important;display:none" id="deatilserror"></span></div>
            </h3></div>

        <div class="index_popup_contant contenttext" style="display:inline-block;margin-left:5%;text-align:left;width:100%;height:auto">
            <span style="line-height: 40px;width:26%;float:left"><?=$_SESSION['payment_pending_pop_reason']?></span><div style="background-color: #fff !important;width: 60%;height:auto;    margin-bottom: 15px;" class="btn_index_popup"><input type="text" class="popup_conform_his" autofocus style="" name="reasontext" id="reasontext"></div><br>
            <span style="line-height: 40px;width:26%;float:left"><?=$_SESSION['payment_pending_pop_staffname']?></span><div style="background-color: #fff !important;width: 60%;height:auto;" class="btn_index_popup" >
                <select style="float: left;width: 51%;" class="popup_conform_his"  id="stafflist" name="stafflist" >
                    <option value="null" default><?=$_SESSION['payment_pending_pop_selstaff']?></option>
<?php
$sql_login = $database->mysqlQuery("select * from tbl_staffmaster WHERE ser_cancelpermission='Y' AND ser_employeestatus='Active'");
$num_login = $database->mysqlNumRows($sql_login);
if ($num_login) {
    while ($result_login = $database->mysqlFetchArray($sql_login)) {
        
        $staffid=  trim(json_encode($result_login['ser_staffid']),'""');
        $regen_stfname=$result_login['ser_firstname'];
//        //$stfname = $stafflist['ser_firstname'] . " " . $stafflist['ser_lastname'];
//        $fpstaff=fopen($apilink."/src/main_menu_display.php?set=staff_ordertake&staffid=$staffid&dat=$other_lang","r");
//        //echo $apilink."/src/main_menu_display.php?set=staff_ordertake&dat=$other_lang";
//        $response_staff['messages'] = stream_get_contents($fpstaff);
//        //var_dump($response_staff['messages']);
//        $resu_staff= json_decode($response_staff['messages'],true);
//        //var_dump($resu_staff['staff_id'][0]);
//        $staff_count=count($resu_staff['staff_id']);
//        $regen_stfname =$resu_staff['staff_name'][0];
        ?>
                            <option class="popup_conform_his" value="<?= $result_login['ser_staffid'] ?>" cancelkey="<?= $result_login['ser_cancelwithkey'] ?>"><?=  $regen_stfname//$result_login['ser_firstname'] ?></option>
                        <?php }
                    } ?>	
                </select>
                <div style="margin-top:0px !important;" class="btn_index_popup_send otp_gent_btn"><a href="#" class="sendotp"><?=$_SESSION['payment_pending_pop_sendotp']?></a></div>

            </div><br>
            <div style="width:100%;float: left;">
            <span style="line-height: 40px;width:26%;float:left"><?=$_SESSION['bill_history_popup_enter_password']?><span id="typeentery"> </span></span><div style="background-color: #fff !important;width: 40%;" class="btn_index_popup"><input class="popup_conform_his" style="float: left;" type="password" name="secretkey" id="secretkey"></div>
       </div> </div>   
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
    
<!---*******************************************Settle Popup************************************-->
 <input type="hidden" name="focusedtext1" id="focusedtext1" >
<div id="copop" class="counter_settle_popup" style="display: none;">
              <div class="top_head">Bill Details - <span id="settleingbilno"></span>
              </div>
              	<div class="settle_main_pop_contant" style="position:relative">
                	<div class="counter_payment_contain" style="position:relative">
                    
                    <div class="tottal_rate_contain" style="color:#000;font-size: 16px;text-align:right;width:100%;background:#cdcecf;margin:0;">
                   			<div class="poup_sub_total"><span style="float: right;padding-left:5px;    white-space: nowrap">
                           	 <div class="payment_pend_right_cash_error"></div>
                            </span>
                            </div>
                            
                        	 <div class="calculator_icon_pop"><img src="img/calculator-ico.png"></div> 
                            
                            </div>
                            
<!--                            <div style="margin:0;text-align:left" class="discount_text_cc crd_head"><?//=$_SESSION['payment_datails']?></div>-->
                       
                       <div class="pop_payment_mode_sel_btn_cc">
                       
                       <!--<div id="cash" idval="1" class="pop_payment_mode_sel_btn mode_sel_btn_act">Cash</div>
                       <div id="credit" idval="2" class="pop_payment_mode_sel_btn">Credit / Debit Card</div>
                       <div id="complimentary" idval="7" class="pop_payment_mode_sel_btn">Complimentary</div>-->
                      
                       <?php
                       
                       
           $credit_view='';
            $comp_view='';
             $sql_paytypes1 = mysqli_query($localhost,"SELECT ser_credit_view,ser_comp_view FROM tbl_logindetails tl left join tbl_staffmaster ts on ts.ser_staffid=tl.ls_staffid  WHERE tl.ls_username='".$_SESSION['expodine_id']."' ");
                $num_paytypes1 = mysqli_num_rows($sql_paytypes1);
                if ($num_paytypes1) {
                    while ($result_paytypes1 =mysqli_fetch_array($sql_paytypes1)) {
                        
                        $credit_view=$result_paytypes1['ser_credit_view'];
                        $comp_view=$result_paytypes1['ser_comp_view'];
                        
                    }
                    }
            
                       
                       
                       
                       
						$sql_ds_nos = "select * from tbl_paymentmode WHERE pym_active='Y'";
						$sql_ds = $database->mysqlQuery($sql_ds_nos);
						$num_ds = $database->mysqlNumRows($sql_ds);
						if ($num_ds) {
							$i = 1;
							while ($result_ds = $database->mysqlFetchArray($sql_ds)) {
//								if( $result_ds['pym_code']!="credit_person")
//								{
       					 ?>

                          <div id="<?= $result_ds['pym_code'] ?>" idval="<?= $result_ds['pym_id'] ?>" class=" cash_btn pop_payment_mode_sel_btn <?php if ($i == 1) { ?>  <?php } ?>"><?= $result_ds['pym_name'] //$_SESSION[$result_ds['pym_id']]['paymentmode']?></div>
                       
                        <?php $i++;
								//}
							  }
						  }
                                                  
                                                  
                                          ?>
                       
                       </div>
                            
                 <input type="hidden" value="<?=$credit_view?>" id="credit_view_per" > 
                 <input type="hidden" value="<?=$comp_view?>" id="comp_view_per" > 
                 
                       <div class="sec_pop_div_right">
                       
                           
                           <div class="credit_cc_normal" style="display: none;">
                           <div class="discount_text_cc crd_head">Credit / Debit Card</div>
                               <div class="selecting_payment_cc">
                                    <div class="selecting_payment_one">
                                        <div class="lable_counter_paymnet_cc counter_right_lable">Transaction Bank</div>
                                       
                                           <select  id="bankdetails" class=" discount_text_box tax_textbox counter_text_box size_compat">
<!--                                                        <option value=""><?=$_SESSION['payment_pending_card_bankname']?></option>-->
                                                        <?php
                                                        $sql_ds_nos = "select * from tbl_bankmaster where bm_active='Y' ";
                                                        $sql_ds = $database->mysqlQuery($sql_ds_nos);
                                                        $num_ds = $database->mysqlNumRows($sql_ds);
                                                        if ($num_ds) {
                                                            while ($result_ds = $database->mysqlFetchArray($sql_ds)) {
                                                                ?>    
                                                                <option value="<?= $result_ds['bm_id'] ?>"><?=$result_ds['bm_name']//$result_ds['bm_name'] ?></option>
                                                            <?php }
                                                        } ?>
                                                    </select>
                                    </div>
                               </div><!--selecting_payment_cc-->
                              
                               
                               
                               
                               <div class="card_detail_popup_contant cardadder" style="padding: 1px;" id="cardadderid">
                                    <div class="card_detail_popup_list_head">
                                        <div class="card_detail_popup_type" style="width:30%;margin-right:1%">
                                            <div class="card_detail_popup_type_text">Card Type</div>
                                         </div>  
                                         <div class="card_detail_popup_type" style="width:33%">
                                            <div class="card_detail_popup_type_text"> Last 4 Digits in Card</div>
                                          </div> 
                                          <div class="card_detail_popup_type" style="width:18%;margin-left:1%">
                                            <div class="card_detail_popup_type_text">Amount</div>
                                         </div> 
                                            
                                    </div>
                                   <div id="newref">
                                    <div class="card_detail_popup_list" style="margin-bottom:3px"  id="card_detail_popup_list">
                                        <div class="card_detail_popup_type" style="width:30%;margin-right:1%">
                                            <select class="card_type_dropdwn cardselect" id="multicardtype" onclick="return selectdefault();">
                                          <option value="" > Select Card</option>
                                                  <?php
                                                $sql_rsn1 = "select * from tbl_cardmaster where crd_active = 'Y'";
                                                $sql_rsns1 = $database->mysqlQuery($sql_rsn1);
                                                $num_rsns1 = $database->mysqlNumRows($sql_rsns1);
                                                if ($num_rsns1) {
                                                    while ($result_rsns1 = $database->mysqlFetchArray($sql_rsns1)) {
                                                            ?>
                                                 
                                                      <option value="<?= $result_rsns1['crd_id']?>"><?= $result_rsns1['crd_name']?></option>
                                                                     <?php  }}?>
                                             </select>
                                        </div>
                                                  <div class="card_detail_popup_type" style="width: 33%;">
                                            <input class="card_popup_digits cardno" type="text" id="card_1" value="" name="card_1" chk="0" onkeypress="return numonly()" onclick="return pincard()" onchange="return pincard()" maxlength="4" autocomplete="off">
                                            
                                        </div>
                                        <div class="card_detail_popup_type" style="width:18%;margin-left:1%">
                                            <input type="text" class="card_type_dropdwn amountall" id="multi_cardamount" value="" name="multi_cardamount" onkeypress="return enter_plus(event)" onkeyup="return cardsum()" onclick="return cardsum()" onchange="return cardsum()" maxlength="10" autocomplete="off" autofocus >
                                        </div>
                                       
<!--                                        <div style="margin-top:0px;width: 12%;height: 34px;margin-top: -1px;float: right"  class="menut_add_bq_btn " onclick="return del();">-</div>-->
                                        
                                    </div>
                               </div>     
                          <input type="hidden" value="" id="countload">
                               
                <div style="margin-top:0px;width: 12%;height: 34px;margin-top: -40px;float: right" class="menut_add_bq_btn plusbtn" onclick="return plus();">+</div>     
                        
                                </div>
                               
                               
                               
                               
                               
                               
                                <div class="trrefresh">
                               <div class="selecting_payment_cc">
                                    <div class="selecting_payment_one">
                                        <div class="lable_counter_paymnet_cc counter_right_lable">Transaction Amount</div>
                                        <input type="hidden" name="pending" id="paymentmsg1" value="Add Complimentary Remarks">
                                                    <input type="hidden" name="pending" id="paymentmsg2" value="Bill Re-Printed">
                                                  <input type="hidden" name="pending" id="paymentmsg3" value="Select Staff">
                                                 
                                                  <?php
                                                   $sql_rsnrate4 = "select sum(mc_cardamount) as totamount from tbl_bill_card_payments where mc_billno = 'temp_".$_SESSION['billcard16']."'";
                                          // echo "select sum(mc_cardamount) as totamount from tbl_bill_card_payments where mc_billno = 'temp_".$_SESSION['billcard6']."'";
                                           $sql_rsns1rate4 = $database->mysqlQuery($sql_rsnrate4);
                                                $num_rsns1rate4 = $database->mysqlNumRows($sql_rsns1rate4);
                                                if ($num_rsns1rate4) {
                                                    while ($result_rsns1rate4 = $database->mysqlFetchArray($sql_rsns1rate4)) {
                                                        if($result_rsns1rate4['totamount']!=""){
                                                        $totalcardbill4=$result_rsns1rate4['totamount'];
                                                        }else{
                                                            $totalcardbill4="0";
                                                        }
                                                    }
                                                    
                                                    }
                                                  
                                                    
                                                    
                                                     $sql_rsnrate74 = " select bm_finaltotal from tbl_tablebillmaster where bm_billno = '".$_SESSION['billcard16']."'";
                                          //  echo "select sum(mc_cardamount) as totamount from tbl_bill_card_payments where mc_billno = '".$_SESSION['billcard6']."'";
                                           $sql_rsns1rate74 = $database->mysqlQuery($sql_rsnrate74);
                                                $num_rsns1rate74 = $database->mysqlNumRows($sql_rsns1rate74);
                                                if ($num_rsns1rate74) {
                                                    while ($result_rsns1rate74 = $database->mysqlFetchArray($sql_rsns1rate74)) {
                                                        if($result_rsns1rate74['bm_finaltotal']!=""){
                                                        $totalcardbill74=  number_format($result_rsns1rate74['bm_finaltotal']-$totalcardbill4,$_SESSION['be_decimal']);
                                                        }else{
                                                            $totalcardbill74="0";
                                                        }
                                                    }
                                                    
                                                    }
                
                                                    
                                                  ?>
                                                  <input type="hidden" id="hiddentran" value="<?=$totalcardbill4?>" >
                                                  <input placeholder="Enter Transaction Amount" class="tax_textbox transa_txt counter_text_box"  name="transcationid"  id="transcationid" value="<?=number_format($totalcardbill4,$_SESSION['be_decimal'])?>" onkeydown="transamountchange()" onchange="transamountchange(event)" onfocus="transamountchange(event)" onkeypress="transamountchange(event)" onkeyup="transamountchange()" onclick="transamountchange(event)" autocomplete="off" readonly  >
                                        <!--<input placeholder="Amount" class="tax_textbox transa_txt counter_text_box">-->
                                   
                                                    </div>
                               </div><!--selecting_payment_cc-->
                               
                               <div class="selecting_payment_cc">
                                    <div class="selecting_payment_one">
                                        <div class="lable_counter_paymnet_cc counter_right_lable">Balance to pay</div>
                                        <!--<input placeholder="Balance" class="tax_textbox transa_txt counter_text_box">-->
                                        <input placeholder="Balance" class="tax_textbox transa_txt counter_text_box" name="transbal" id="transbal" readonly value="<?=$totalcardbill74?>">
                                    </div>
                               </div><!--selecting_payment_cc-->
                               
                           </div><!--credit_cc_normal-->
                           </div>
                            <div class="coupon_cc" style="display: none;">
                            	 <div class="discount_text_cc crd_head">Coupons</div>
                                 <div class="selecting_payment_cc">
                                    <div class="selecting_payment_one">
                                        <div class="lable_counter_paymnet_cc counter_right_lable">Coupon Code</div>
                                       
                                            <input placeholder="Enter Coupon Code" class="tax_textbox transa_txt counter_text_box" name="coupname" id="coupname" onkeyup="return coupon_code_redeem(event);" >
                                        
                                    </div>
                              	 </div><!--selecting_payment_cc-->
                                 <div class="selecting_payment_cc">
                                    <div class="selecting_payment_one">
                                        <div class="lable_counter_paymnet_cc counter_right_lable">Coupon Amount</div>
                                        <!--<input placeholder="Coupon Amount" class="tax_textbox transa_txt counter_text_box">-->
                                        <input placeholder="Enter Coupon Amount" class="tax_textbox transa_txt counter_text_box" readonly name="coupamount" id="coupamount"  onkeyup="couponamountchange(event)" onchange="couponamountchange(event)" autocomplete="off">
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
                                         <input placeholder="Voucher Amount" class="tax_textbox transa_txt counter_text_box" name="vocamount" id="vocamount" readonly="" autocomplete="off">
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
                                         <input placeholder="Enter Cheque Amount" class="tax_textbox transa_txt counter_text_box" value="" name="cheqamount" id="cheqamount" onkeyup="cheqamountchange()"  onchange="cheqamountchange(event)"  autocomplete="off">
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
                                
                                  <div id="refdivall"  class="paid_amount_cc_credit" style="display: block;">
                                     
                                   <?php
                            $sq_lang451=$database->mysqlQuery("select be_base_currency,be_show_currency from  tbl_branchmaster");
            $nm_lang451= $database->mysqlNumRows($sq_lang451);
            if($nm_lang451){
		while($result_lang451  = $database->mysqlFetchArray($sq_lang451)) 
						  {
                      $currency22                          =$result_lang451['be_base_currency'];
                      $showcurrency22                 =$result_lang451['be_show_currency'];
                                                  }
                }
               ?>
                                      
                 <input type="hidden" id="currencyonoff" value="<?=$showcurrency22?>" > 


               <?php                         

                            $lang1="";
$sql_login11  =  $database->mysqlQuery("select * from tbl_currency_master where c_id='".$_SESSION['iddofcurrency1']."'"); 
				$num_login11   = $database->mysqlNumRows($sql_login11);
				if($num_login11){
					while($result_login11  = $database->mysqlFetchArray($sql_login11)) 
					  {
                                          
                                          $lang1= $result_login11['c_name'];
                                            
                                }
                                        }
                                        
                                                              $lang31="";
$sql_login31  =  $database->mysqlQuery("select * from tbl_currency_master where c_id='".$currency22."'"); 
				$num_login31   = $database->mysqlNumRows($sql_login31);
				if($num_login31){
					while($result_login31  = $database->mysqlFetchArray($sql_login31)) 
					  {
                                          
                                          $lang31= $result_login31['c_short_code'];
                                            
                                }
                                        }
                                       //convooo// 
             
                                
                            ?>
                                      
                                      <?php
                                      if($showcurrency22=="Y"){
                                      ?>
                                      
                                      
                                      <div  class="selecting_payment_one">
                                
                                            <div class="lable_counter_paymnet_cc counter_right_lable">Currency</div>
                                            <!--<input placeholder="Paid Amoun" class="tax_textbox transa_txt counter_text_box">-->
                                            <select id="currencychg1" onclick="hidval1()" onchange="changecurrency1()" class="tax_textbox transa_txt counter_text_box">
                                                	
                                                    <option id="hid1"><?=$lang1?></option>
                                                     <?php
			   $sql_login231  =  $database->mysqlQuery("select * from tbl_currency_master where c_status='Active'"); 
				$num_login231   = $database->mysqlNumRows($sql_login231);
				if($num_login231){
					while($result_login231  = $database->mysqlFetchArray($sql_login231)) 
					  {
                                            $idd11=$result_login231['c_id'];
                                            $sig11=$result_login231['c_name'];
					  ?>
                                                  
              
                <option value="<?=$idd11?>_<?=$sig11?>"><?=$result_login231['c_name']?></option>
               
                   
                   
                      
                                    <?php } } ?>
                
                                                </select>
                                            
                                        </div>
                                      <?php
                                    
                    
                                     $sq_lang461=$database->mysqlQuery("select cc_conversion_rate from  tbl_currency_conv_rate where cc_base_currency='".$currency22."' and cc_currency='".$_SESSION['iddofcurrency1']."'");
            $nm_lang461= $database->mysqlNumRows($sq_lang461);
            if($nm_lang461){
		while($result_lang461 = $database->mysqlFetchArray($sq_lang461)) 
						  {
                      $convo1                           =$result_lang461['cc_conversion_rate'];
                                                  }
                }
                
                                     
                                     ?>
                                     
                                      <input type="hidden" id="convorate1" value="<?=$convo1?>" >
                                      
                                      
                                      
                               <input type="hidden" id="cursign22" name="cursign22">   
                                      <div  class="selecting_payment_one">
                                            <div class="lable_counter_paymnet_cc counter_right_lable">Cash Paid</div>
                                            <!--<input placeholder="Paid Amoun" class="tax_textbox transa_txt counter_text_box">-->
                                            <input placeholder="Enter Paid Amount" class="tax_textbox transa_txt counter_text_box" id="cur1" name="cur1"  onchange="cur1()"  onkeyup="cur1()" onkeydown="cur1()" onkeypress="cur1(event)" value="">
                                            
                                        </div>
                                      <?php } ?>
                                       <div  class="selecting_payment_cc">
                                        <div class="selecting_payment_one">
                                            <div class="lable_counter_paymnet_cc counter_right_lable">Cash Paid -<?=$lang31?></div>
                                            <!--<input placeholder="Paid Amoun" class="tax_textbox transa_txt counter_text_box">-->
                                            <input placeholder="Enter Paid Amount" class="tax_textbox transa_txt counter_text_box" id="paidamount_credit" name="paidamount_credit" onchange="enterbalance_credit(event)" onkeyup="enterbalance_credit()" onclick="enterbalance_credit()" value="0" maxlength="12">
                                            
                                        </div>
                                     </div><!--selecting_payment_cc-->
                                       <?php if($convo1!="") { ?>
                                      <div class="selecting_payment_cc">
                                        <div class="selecting_payment_one" id ='balncamnt'>
                                            <div class="lable_counter_paymnet_cc counter_right_lable">Balance Amount</div>
                                           <!-- <input placeholder="Balance" class="tax_textbox transa_txt counter_text_box">-->
                                            <input placeholder="Enter Balance Amount" class="tax_textbox transa_txt counter_text_box" id="balanceamout_credit" name="balanceamout_credit" value="0" readonly="">
                                            
                                        </div>
                                     </div>
                                       <?php } ?>
                                     <!--selecting_payment_cc-->
                                  
                                  </div><!--paid_amount_cc_credit-->
                                
                                  <div   class="credit_type" style="display: none;">
                            			<div class="discount_text_cc crd_head" style="margin-top:10px;">Credit Type</div>
                                        <div  class="selecting_payment_cc">
                                        <div   class="selecting_payment_one" style="margin-bottom:7px;padding:0 1.5%;">
                                            <!--<div class="lable_counter_paymnet_cc counter_right_lable">Select</div>-->
                                            <select class="staff_menu_select counter_text_box" name="selectcreditypes" id="selectcreditypes" onclick="chvalof()">
                                                    <option id="selchngnew"  value="">Select</option>
                                                    
                                                    <?php 
                                                            $sql_kot  =  $database->mysqlQuery("select * from tbl_credit_types where ct_active='Y'"); 
										  $num_kot   = $database->mysqlNumRows($sql_kot);
										  if($num_kot){
									while($result_kot  = $database->mysqlFetchArray($sql_kot)) 
										{ ?>
                                                   <option value="<?=$result_kot['ct_creditid']?>" label="<?=$result_kot['ct_labels']?> "><?=$result_kot['ct_credit_type']?></option>
                                                                                  <?php }}?>
                                                </select>
                                        </div>
                                     </div><!--selecting_payment_cc-->
                                     
                                   
                                     
                                      <div class="crd_select_head_cc credtitypeloads" id="crtype_div" style="    padding-right: 1.5%;">
                                      
                                      </div><!--crd_select_head_cc-->
                                      
                                      <textarea class="credit_remarks_cc" id="credit_remark" name="credit_remark" placeholder="Remarks"></textarea>
                                		
                                </div><!--credit_type-->
                                
                                <div style="display: none;" class="complimentrary_cc">
                                 	<div class="discount_text_cc crd_head">Complimentary</div>
                                        <textarea placeholder="Enter Complimentary" class="room_textarea tax_textbox" name="completext" id="completext" onkeypress="return comp_text();"  onchange="return comp_text();" style="height:80px;color:#000;margin-left: 5px;width: 96%;"></textarea>
                            </div><!--complimentrary_cc-->
                            
                            <div class="upi_cc" style="display: none;">
                            	 <div class="discount_text_cc crd_head">UPI</div>
                                 <div class="selecting_payment_cc">
                                     <div class="selecting_payment_one" style="text-align: center">
                                       <!-- <div class="lable_counter_paymnet_cc counter_right_lable">Transaction Status</div>-->
                                       
<!--                                        <input style="width: 38%" placeholder="Enter Transaction Id" class="tax_textbox transa_txt counter_text_box" name="upitxnid" id="upitxnid" autocomplete="off">-->
                                        <a href="#"><div class="upi-sub-btn" id="txnstatuscheck">Click here to check status</div></a>
                                    </div>
                              	 </div><!--selecting_payment_cc-->
                                 <div class="selecting_payment_cc">
                                    <div class="selecting_payment_one">
                                        <div class="lable_counter_paymnet_cc counter_right_lable">Upi Transaction Status</div>
                                        <!--<input placeholder="Coupon Amount" class="tax_textbox transa_txt counter_text_box">-->
                                        <input placeholder="Upi Transaction Status" class="tax_textbox transa_txt counter_text_box" name="upistatus" id="upistatus"  autocomplete="off" readonly>
                                    </div>
                              	 </div><!--selecting_payment_cc-->
                                 
                                 
                                 <div class="selecting_payment_cc">
                                    <div class="selecting_payment_one">
                                        <div class="lable_counter_paymnet_cc counter_right_lable">Upi Amount Paid</div>
                                        <!--<input placeholder="Coupon Amount" class="tax_textbox transa_txt counter_text_box">-->
                                        <input placeholder="Upi Amount" class="tax_textbox transa_txt counter_text_box" name="upiamount" id="upiamount"  onchange="upiamountchange(event)" autocomplete="off" readonly>
                                    </div>
                              	 </div><!--selecting_payment_cc-->
                                 <div class="selecting_payment_cc">
                                    <div class="selecting_payment_one">
                                        <div class="lable_counter_paymnet_cc counter_right_lable">Upi Transaction Id</div>
                                        <!--<input placeholder="Coupon Amount" class="tax_textbox transa_txt counter_text_box">-->
                                        <input placeholder="Upi Transaction Id" class="tax_textbox transa_txt counter_text_box" name="upitransactionid" id="upitransactionid"   autocomplete="off" readonly>
                                    </div>
                              	 </div><!--selecting_payment_cc-->
                                 
                                 
                                 
                                 <div class="selecting_payment_cc">
                                    <div class="selecting_payment_one">
                                        <div class="lable_counter_paymnet_cc counter_right_lable upibalanceamount">Balance Amount To Pay</div>
                                        <!--<input placeholder="Coupon Amount" class="tax_textbox transa_txt counter_text_box">-->
                                        <input placeholder="Balance Amount To Pay" class="tax_textbox transa_txt counter_text_box" name="upibalanceamount" id="upibalanceamount"  autocomplete="off" readonly>
                                    </div>
                              	 </div><!--selecting_payment_cc-->
                                 
                                 
                            </div><!--upi-->  
                            
                            
                            <?php
                            $sq_lang45=$database->mysqlQuery("select be_base_currency,be_show_currency from  tbl_branchmaster");
            $nm_lang45= $database->mysqlNumRows($sq_lang45);
            if($nm_lang45){
		while($result_lang45  = $database->mysqlFetchArray($sq_lang45)) 
						  {
                      $currency                           =$result_lang45['be_base_currency'];
                      $showcurrency1                 =$result_lang45['be_show_currency'];
                                                  }
                }
                
                




                            $lang="";
$sql_login  =  $database->mysqlQuery("select * from tbl_currency_master where c_id='".$_SESSION['iddofcurrency']."'"); 
				$num_login   = $database->mysqlNumRows($sql_login);
				if($num_login){
					while($result_login  = $database->mysqlFetchArray($sql_login)) 
					  {
                                          
                                          $lang= $result_login['c_name'];
                                            
                                }
                                        }
                                        
                                        
                                   $lang12="";
$sql_login34  =  $database->mysqlQuery("select * from tbl_currency_master where c_id='".$currency."'"); 
				$num_login34   = $database->mysqlNumRows($sql_login34);
				if($num_login34){
					while($result_login34  = $database->mysqlFetchArray($sql_login34)) 
					  {
                                          
                                          $lang12= $result_login34['c_short_code'];
                                          $nam=   $result_login34['c_name'];
                                }
                                        }        
                                        
                                       //convooo// 
             
                                
                            ?>
                            
                            
                            
                                <?php
                            if($showcurrency1=="Y"){
                            ?>
                           
                                <?php
                            }
                            ?>
                            <div id="refdiv"  class="paid_amount_cc" style="display: block;">
                            <?php
                            if($showcurrency1=="Y"){
                            ?>
                            		<div id="refdivsl"  class="selecting_payment_cc">
                                        <div id="newchng"  class="selecting_payment_one">
                                            <div class="lable_counter_paymnet_cc counter_right_lable">Currency</div>
                                            <select id="currencychg" onclick="hidval()" onchange="changecurrency()" class="tax_textbox transa_txt counter_text_box size_compat">
                                               
                                                    <option id="hid" ><?=$lang?></option>
                                                     <?php
			   $sql_login23  =  $database->mysqlQuery("select * from tbl_currency_master where c_status='Active'"); 
				$num_login23   = $database->mysqlNumRows($sql_login23);
				if($num_login23){
					while($result_login23  = $database->mysqlFetchArray($sql_login23)) 
					  {
                                            $idd1=$result_login23['c_id'];
                                            $sig1=$result_login23['c_name'];
					  ?>
                                                  
              
                <option id="newopt" value="<?=$idd1?>_<?=$sig1?>"><?=$result_login23['c_name']?></option>
               
                   
                   
                      
                                    <?php } } ?>
                
                                                </select>
                                         
                                            <input type="hidden" id="curshow" value="<?=$showcurrency1?>" > 
                                              <input type="hidden" id="cursign2" name="cursign2">   
                                              <input type="hidden" id="dflt22" name="dflt22" value="<?=$nam?>">   
                                               <input type="hidden" id="bscur" name="bscur" value="<?=$currency?>">   
                                        </div>
                                     </div><!--selecting_payment_cc-->
                                     <div  class="selecting_payment_cc">
                                        <div class="selecting_payment_one">
                                            <div class="lable_counter_paymnet_cc counter_right_lable">Amount Paid</div>
                                            <input placeholder="Paid Amount" id="curpaid" onKeyPress="curpaid()"  onchange="curpaid()" onKeyDown="curpaid()" onKeyUp="curpaid()"  class="tax_textbox transa_txt counter_text_box" value="" autofocus="on" autocomplete="off">
                                            
                                        </div>
                                     </div><!--selecting_payment_cc-->
                            
                            <?php } ?>
                                     
                                     <?php
                                    
                    
                                     $sq_lang46=$database->mysqlQuery("select cc_conversion_rate from  tbl_currency_conv_rate where cc_base_currency='".$currency."' and cc_currency='".$_SESSION['iddofcurrency']."'");
            $nm_lang46= $database->mysqlNumRows($sq_lang46);
            if($nm_lang46){
		while($result_lang46  = $database->mysqlFetchArray($sq_lang46)) 
						  {
                      $convo                           =$result_lang46['cc_conversion_rate'];
                                                  }
                }
                
                                     
                                     ?>
                                     
                                  <input type="hidden" id="convorate" value="<?=$convo?>" > 
                                   <?php
                            if($showcurrency1=="Y"){
                            ?>
                                  <div class="selecting_payment_cc">
                                    <div class="selecting_payment_one">
                                        <div class="lable_counter_paymnet_cc counter_right_lable" style="width: 49.5%;">Paid Amount<span>- <?=$lang12?></span></div>
                                        <!--<input placeholder="Enter Balance Amount" class="tax_textbox transa_txt counter_text_box"  value="0">-->
                                        <input placeholder="<?=$_SESSION['cashpaceholder']?>" class="tax_textbox transa_txt counter_text_box" id="paidamount" name="paidamount" onchange="enterbalance(event)" onkeyup="enterbalance(event)"  value="" autocomplete="off" readonly>
                                    </div>
                          
                                 </div><!--selecting_payment_cc-->
                                   <?php } else { ?>
                                 <div class="selecting_payment_cc">
                                    <div class="selecting_payment_one">
                                        <div class="lable_counter_paymnet_cc counter_right_lable" style="width: 49.5%;">Paid Amount</div>
                                        <!--<input placeholder="Enter Balance Amount" class="tax_textbox transa_txt counter_text_box"  value="0">-->
                                        <input placeholder="<?=$_SESSION['cashpaceholder']?>" class="tax_textbox transa_txt counter_text_box" id="paidamount" name="paidamount" onkeypress="number_dot(event)" onchange="enterbalance(event)" onkeyup="enterbalance(event)"  value="" autocomplete="off" maxlength="12" >
                                    </div>
                          
                                 </div>
                                    <?php } ?>
                                 
                                 <div class="selecting_payment_cc">
                                    <div class="selecting_payment_one">
                                        <div class="lable_counter_paymnet_cc counter_right_lable" style="width: 49.5%;">Balance Amount</div>
                                         <!--<input placeholder="Enter Paid Amount" class="tax_textbox transa_txt counter_text_box" value="0" readonly="">-->
                                        <input placeholder="Balance Amount" class="tax_textbox transa_txt counter_text_box" id="balanceamout" name="balanceamout" value="" readonly="">
                                    </div>
                                 </div><!--selecting_payment_cc-->
                                 
                            </div><!--paid_amount_cc-->
                            
                            
                            
                            <?php
                            $sql_login5  =  $database->mysqlQuery("select * from tbl_branchmaster"); 
	               $num_login5   = $database->mysqlNumRows($sql_login5);
	               if($num_login5){
		          while($result_login5  = $database->mysqlFetchArray($sql_login5)) 
		        {
                              
                               $tx1=$result_login5['be_name_tax1'];
                                      $tx2=$result_login5['be_name_tax2'];
                                      $tx3=$result_login5['be_name_tax3'];
                              
                       }}
                       ?>
                            </div>
                        <!---sec-div-->
                        <!--tip div-->
                        <div class="tip_section">
                           <div class="selecting_payment_cc">
                             <div class="selecting_payment_one">
                                <div class="lable_counter_paymnet_cc counter_right_lable" style="width: 30%;">TIP</div>
                                <input placeholder="Tip" class="tax_textbox transa_txt counter_text_box" id="tip_amount" onclick="$('#tip_amount').val('');" onfocus=" return AddClass(this.id)" onkeypress="return charlimit(event,this.value)"  onkeyUp=" return enterbalance(event,this.id)"  value="" autocomplete="off" maxlength="12" style="width: 28%;float: right">
                                <select class="tax_textbox transa_txt counter_text_box" id="tip_pay_mode" style="width: 22%;float: right;margin-right: 5px">
                                    <option value="C">CASH</option>
                                    <option value="D">CARD</option>
                                </select>
                             </div>
                          </div>
                        </div>

                    <!--tip div-->    
                            
                            
                            
                            <div style="width:100%;float:left;">
                             <div class="popup_bottom_tax_detail" id="taxdetails_div" style="width:56%;padding-right: 3%;">
                            	
                                
                            </div>
                             <div class="popup_bottom_tax_detail" style="width:44%;float:right;padding-right: 3%;">
                            	
                                <div style="width:100%; " class="lable_counter_paymnet_cc counter_right_lable">Discount:<span id="totaldisc">0.00</span></div>
                                
                                <div style="width:100%" class="lable_counter_paymnet_cc counter_right_lable"><strong> Sub Total  = <span id="final">0.00</span><span></span></strong></div>
                            
                                
                             </div>
                    
                            </div><!--div-->
                              <div style="" class="lable_counter_paymnet_cc lable_counter_paymnet_cc_1 counter_right_lable">
                                  
                                
                              <strong>Total :(<?=$_SESSION['base_currency']?>) <span id="grandtotal"></span></strong>
                              </div>

                           
                           </div><!--counter_payment_contain-->
                           
                             
                       <div class="right_bottom_button_cc">
                       		<div style="width:30%;float:right;" class="tka_sum_btn_cc">
                            	<a class="tka_submit_buton submittranscations" style="cursor:pointer"><?=$_SESSION['payment_submit']?></a>
                                
                            </div>
                             <?php if($_SESSION['s_sms_bill']=="Y") { ?>
                           <div style="width:30%;float:right;" class="tka_sum_btn_cc">
                                <input id="sms_bill_settle" type="checkbox" >
                                       WHATSAPP-SMS BILL
                            </div>
                            <?php } ?>
                           
                            <div style="width:30%;float:left;" class="tka_sum_btn_cc">
                            	<a class="tka_submit_buton settle_popup_close" style="cursor:pointer" href="#"><?=$_SESSION['payment_close']?></a>
                            </div>
                            
                       </div><!--right_bottom_button_cc-->
                       
                       <div class="counter_settle_popup_right_calc_cc" style="display:block">
                       	
                       
                       		<div class="counter_pop_left_portion" style="height:auto">
                            
                            <div class="keys settle_key" style="margin-top:0">
                                <span class="pay_settle_btn">1</span>
                                <span class="pay_settle_btn">2</span>
                                <span class="pay_settle_btn">3</span>
                                <span class="pay_settle_btn">4</span>
                                <span class="pay_settle_btn">5</span>
                                <span class="pay_settle_btn">6</span>
                                <span class="pay_settle_btn">7</span>
                                <span class="pay_settle_btn">8</span>
                                <span class="pay_settle_btn">9</span>
                                <span class="pay_settle_btn">0</span>
                                <span class="pay_settle_btn">.</span>
                                <span class="pay_settle_btn">Clear</span>
                                <!--<span class="calculator_settle">Enter</span>-->
                            </div>
                                
                                <div class="settle_quick_cash">
                                    <div class="settle_quick_cash_head">QUICK CASH</div>
                                  
                                    
                                              <?php
                            $sql_login5  =  $database->mysqlQuery("select * from tbl_denomination_master where dm_active='Y' order by dm_display_order asc"); 
	               $num_login5   = $database->mysqlNumRows($sql_login5);
	               if($num_login5){
		          while($result_login5  = $database->mysqlFetchArray($sql_login5)) 
		        {
                              ?>
                          
                                    <div class="settle_quick_cash_btn pay_settle_btn"><?=$result_login5['dm_denomination']?></div>
                       <?php } } ?>         
                                    
                                </div>
            	
           				 </div>
                       
                       </div>
                       
                </div><!--right_main_contant_cc-->
              
              </div><!--counter_settle_popup-->

<!---*******************************************End Settle Popup************************************-->
     <!-----------auth popup--------------->
 <div class="kotcancel_reason_popup_new" style="display:none" OnLoad="document.myform.mytextfield.focus();">
    <input type="hidden" name="focusedtext" id="focusedtext" />
 <div class="kotcancel_reason_popup_new_left_cc">
    <div class="kotcancel_reason_popup_new_head"><img class="auth_head_ico" src="img/alert.png" /> Authorisation</div>
    <div class="kotcancel_reason_popup_new_textbox_contant">
    
        <div class="kotcancel_reason_popup_new_textbox_cc" id="rsn" style="margin-bottom:10px;">
            
            <select class="kotcancel_reason_popup_new_textbox_input" id="reasontxt" name="reasontxt" style="width: 99%;float: left;">
<!--                                                 <option value="0">--Select--</option>-->
                                                 <?php 
                                                $sql_rsn = "select * from tbl_regenerate_reasons where rr_active = 'Y'";
                                                $sql_rsns = $database->mysqlQuery($sql_rsn);
                                                $num_rsns = $database->mysqlNumRows($sql_rsns);
                                                if ($num_rsns) {
                                                    while ($result_rsns = $database->mysqlFetchArray($sql_rsns)) {
                                                        ?>
                                                 
                                                         <option value="<?= $result_rsns['rr_reason']?>"><?= $result_rsns['rr_reason']?></option>
                                                   
                                                          <?php  }}?>
                                             </select>
        </div>
        <div style="width: 100%;float: left;height: 10px;line-height: 0px;text-align: center"><span id="pin_error" style="color:red;"></span><span id="pin_success" style="color:green; font-weight: bold; font-size: 18px"></span></div>
        <div class="kotcancel_reason_popup_new_textbox_cc" style="margin-bottom:10px;">
            <input style="width:80%;float:left" type="password" class="kotcancel_reason_popup_new_textbox_input" placeholder="CODE" id="pin" autofocus autocomplete="off" maxlength="4"/>
            <span style="height: 47px;width:20%;" class="login_back_btn calculator_settle_back">&nbsp;</span>
        </div>
    </div>
    <div class="kotcancel_reason_popup_new_textbox_btn_cc">
        <a href="#"><div class="kotcancel_reason_popup_new_textbox_btn" id="kotcancel_reason_popup_new_cancel_btn">Cancel</div></a>
    	<a href="#"><div class="kotcancel_reason_popup_new_textbox_btn" id="kotcancel_reason_popup_new_proceed_btn">Proceed</div></a>
       <!-- <a href="#"><div class="kotcancel_reason_popup_new_textbox_btn" id="kotcancel_reason_popup_new_proceed_reprint_btn">Proceed rpr</div></a>-->
        <!--<a href="#"><div class="kotcancel_reason_popup_new_textbox_btn" id="kotcancel_reason_popup_new_proceed_split_btn">Proceed splt</div></a>-->
        <input type="hidden" value="" id="hdnkotcancel_reason_popup_new_proceed_btn">
        <input type="hidden" value="" id="btn_mode" value="">
    </div>
  </div><!--kotcancel_reason_popup_new_left_cc-->
  <div class="kotcancel_reason_popup_new_right_cc">
      <div style="margin-top: 0" class="keys settle_key">
            <span class="calculator_settle">1</span>
            <span class="calculator_settle">2</span>
            <span class="calculator_settle">3</span>
             <!--<span class="calculator_settle_back">&nbsp;</span>-->
            <span class="calculator_settle">4</span>
            <span class="calculator_settle">5</span>
            <span class="calculator_settle">6</span>
            <span class="calculator_settle">7</span>
            <span class="calculator_settle">8</span>
            <span class="calculator_settle">9</span>
            <span class="calculator_settle">0</span>
           <span style="width: 46.2%;max-width: inherit;" class="calculator_settle">Clear</span>
        </div>
  </div><!--kotcancel_reason_popup_new_right_cc-->
</div> 
 <!-----------auth popup--------------->
 
 
 

 
 

 
 <div class="payment_auth_pop settle_back_view" style="display:none" >
    <input type="hidden" name="focusedtext" id="focusedtext" />
 <div class="kotcancel_reason_popup_new_left_cc">
    <div class="kotcancel_reason_popup_new_head head_change"></div>
    <div class="kotcancel_reason_popup_new_textbox_contant">
    
        <div style="width: 100%;float: left;height: 10px;line-height: 0px;text-align: center"><span id="pin_error_split" style="color:red;"></span><span id="pin_success" style="color:green; font-weight: bold; font-size: 18px"></span></div>
        <div class="kotcancel_reason_popup_new_textbox_cc" style="margin-bottom:10px;">
            <input style="width:80%;float:left" type="password" class="kotcancel_reason_popup_new_textbox_input" placeholder="CODE" id="pin_pay" autofocus="autofocus" maxlength="4"/>
            <span style="height: 47px;width:20%;" class="login_back_btn calculator_settle_back">&nbsp;</span>
        </div>
    </div>
    <div class="kotcancel_reason_popup_new_textbox_btn_cc">
        <a href="#"><div class="kotcancel_reason_popup_new_textbox_btn pop_auth_close" id="kotcancel_reason_popup_new_cancel_btn">Cancel</div></a>
    	<a href="#" id="pay_check"><div class="kotcancel_reason_popup_new_textbox_btn pop_auth_proceed" id="kotcancel_reason_popup_new_proceed_btn">Proceed</div></a>
        <a href="#" id="settle_check" style="display:none"><div class="kotcancel_reason_popup_new_textbox_btn " id="kotcancel_reason_popup_new_proceed_btn">Proceed</div></a>
      
        <input type="hidden" value="" id="hdnkotcancel_reason_popup_new_proceed_btn">
        <input type="hidden" value="" id="btn_mode" value="">
    </div>
  </div><!--kotcancel_reason_popup_new_left_cc-->
  <div class="kotcancel_reason_popup_new_right_cc">
      <div style="margin-top: 0" class="keys settle_key">
            <span class="calculator_settle">1</span>
            <span class="calculator_settle">2</span>
            <span class="calculator_settle">3</span>
             <!--<span class="calculator_settle_back">&nbsp;</span>-->
            <span class="calculator_settle">4</span>
            <span class="calculator_settle">5</span>
            <span class="calculator_settle">6</span>
            <span class="calculator_settle">7</span>
            <span class="calculator_settle">8</span>
            <span class="calculator_settle">9</span>
            <span class="calculator_settle">0</span>
           <span style="width: 46.2%;max-width: inherit;" class="calculator_settle">Clear</span>
        </div>
  </div><!--kotcancel_reason_popup_new_right_cc-->
</div> 
 
 

 <div style="display:none" class="confrmation_overlay_auth"></div>
    <div style="display:none" class="confrmation_overlay"></div>
<input type="hidden" name="hidregennotpos"  id="hidregennotpos" value="<?=$_SESSION['payment_pending_error_regennot']?>" >
<input type="hidden" name="hidbillsplitnotpos"  id="hidbillsplitnotpos" value="<?=$_SESSION['payment_pending_error_billsplit']?>" >
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
        .confrmation_overlay_auth{
            width:100%;
            height:100%;
            position:fixed;
            z-index:99999;
            background-color:rgba(0,0,0,0.8);
            top:0;
        }
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
            height: 35px;
    		line-height: 35px;
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

<script type="text/javascript">
    
    
    

		$(".credit_cc").hide();
		$(".coupon_cc").hide();
		$(".voucher_cc").hide();
		$(".cheque_cc").hide();
		  
		
		$("#cash").click(function(){
                     $('#loyaltydiv').hide();
                    $('#currencychg').attr("disabled", false);  
                             $('#curpaid').attr("disabled", false);
                       $("#amount_credit").val("");
                     $("#amount_credit1").val("");
                     $("#paidamount_credit").val("");
                    $("#completext").val("");
                    $("#transcationid").val("");
                                       $("#transbal").val("");
                                        $("#cheqamount").val("");
                                        $("#cheqbal").val("");
                    $('#paidamount').val("");
                      $('#curpaid').val("");
                      $("#coupamount").val("");
                      $("#coupbal").val("");
                                        $("#coupname").val("");
			$(".pop_payment_mode_sel_btn").removeClass('mode_sel_btn_act');
		$(this).addClass('mode_sel_btn_act');
			$(".cash_cc").show(500);
                        $(".upi_cc").hide(500);
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
                                          var on=$('#curshow').val();
                                         if(on=="Y"){
                                           $("#curpaid").focus();
                                           $('#focusedtext1').val('curpaid');
                                          
                                       }else
                                       {
                                         $('#paidamount').focus();  
                                          $('#focusedtext1').val('paidamount');
                                       }
		});
                
                
                
                
                
                
		$("#credit").click(function(){
                     
                      $('#loyaltydiv').hide();
      $('.refdiv_card').html('');
      
        var multibillnew16=$('#bill').val();  
        var datastringnewmultinew16="setmultinew16=multicardnew16&multibillnew16="+multibillnew16;
    
       $.ajax({
        type: "POST",
        url: "payment_pending.php",
        data: datastringnewmultinew16,
        success: function(data)
        {
        $(".trrefresh").load(location.href + " .trrefresh");
      
        }
    });
    
         
         var datastring = "billnoview="+multibillnew16;

                 $.ajax({
                 type: "POST",
                 url: "load_div.php",
                 data: datastring,
                 success: function (data)
                 { 
                     
                    var arr = data.split("+");
                     var a=JSON.parse(arr[0]);
                     var b=JSON.parse(arr[1]);
                     var decimal=$('#decimal').val();
                       
               if(a!=''){
                 
                
                     $("#multicardtype").val('');
                     $("#multi_cardamount").val('');
                     $("#card_1").val('');
                     var decimal=$('#decimal').val();
                    
                 
                     $.each(a, function(i, record) {
                        
                         var amount=parseFloat(record.mc_cardamount).toFixed(decimal);
                         
                         if($.trim(record.mc_carnumber)==''){
                             
                                var cardnum='';
                            }
                            else{
                                 var cardnum=record.mc_carnumber;
                            }
                            
                         var amount=parseFloat(record.mc_cardamount).toFixed(decimal);
              if($('.cardadder').find('#del_card' + record.mc_slno).length === 0) {
              $(".cardadder").append("<div class='card_detail_popup_list refdiv_card ' id='card_detail_popup_list"+record.mc_slno+"'  style='margin-bottom:3px'> <div class='card_detail_popup_type' style='width:30%;margin-right:1%'>"+
              "<select class='card_type_dropdwn cardselect' id='multicardtype"+record.mc_slno+"' onclick='return selectdefault();'> <option value='' > Select Card</option>"+
              b+ "</select>"+
              "</div>"+  
              "  <div class='card_detail_popup_type' style='width: 33%;'>"+
              "<input class='card_popup_digits cardno' type='text' id='card_1"+record.mc_slno+"' value='" + cardnum + "' name='card_1"+record.mc_slno+"'  onkeypress='return numonly()' onclick='return pincard()' onchange='return pincard()' maxlength='4' autocomplete='off'>"+
              "</div>"+
              "<div class='card_detail_popup_type' style='width:18%;margin-left:1%'>"+
              "<input type='text' class='card_type_dropdwn amountall' id='multi_cardamount"+record.mc_slno+"' value='" + amount + "' name='multi_cardamount"+record.mc_slno+"' onkeypress='return isNumberKey()' onkeyup='return cardsum()' onclick='return cardsum()' onchange='return cardsum()' autocomplete='off'>"+
              " </div>"+
              "<div style='margin-top:0px;width: 12%;height: 34px;margin-top: -1px;float: right' id='del_card"+record.mc_slno+"' name='del_card"+record.mc_slno+"' class='menut_add_bq_btn' onclick='return deletecard("+record.mc_slno+");'><img width='23px' src='img/cancel-icon.png'></div>"+
              "</div>"        
              
                    );
                                
                         }
                         $("#multicardtype"+record.mc_slno).val(record.mc_cardtype);
                         $("#multicardtype"+record.mc_slno).prop('disabled',true);
                         $("#card_1"+record.mc_slno).prop('disabled',true);
                          $("#multi_cardamount"+record.mc_slno).prop('disabled',true);
          
        
                     });
                
                 } else{
                 
                 var mc_amt= $("#grandtotal").text();
                 
                  $("#multi_cardamount").val(mc_amt);
                    $("#transbal").val(0);
                $("#multi_cardamount").focus();    
                  
                 }
                 
                 
                 
                 
                 } 
                 
                 });
              
               
                    $('#currencychg').attr("disabled", false);  
                      $('#curpaid').attr("disabled", false);
                     $("#amount_credit1").val("");
                     $("#paidamount_credit").val("");
                    $("#completext").val("");
                     $("#cheqamount").val("");
                                        $("#cheqbal").val("");
                    $("#transcationid").val("");
                                       $("#transbal").val("");
                   $('#paidamount').val("");
                      $('#curpaid').val("");
			$(".pop_payment_mode_sel_btn").removeClass('mode_sel_btn_act');
		$(this).addClass('mode_sel_btn_act');
			$(".cash_cc").hide(500);
                        $(".upi_cc").hide(500);
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
                                               var on=$('#curshow').val();
                                         if(on=="Y"){
                                         //  $("#transcationid").focus();
                                        //   $('#focusedtext1').val('transcationid');
                                       }else
                                       {
                                       //  $('#transcationid').focus();
                                       //   $('#focusedtext1').val('transcationid');
                                       }
                                        $('#multi_cardamount').focus();
                                        $('#focusedtext1').val('multi_cardamount');
		});
                
                
                
                
                
		     $("#coupon").click(function(){
                       $('#loyaltydiv').hide();
                    $('#currencychg').attr("disabled", false);  
                     $('#curpaid').attr("disabled", false);
                     $("#amount_credit1").val("");
                     $("#paidamount_credit").val("");
                    $("#completext").val("");
                    $('#paidamount').val("");
                    $("#coupamount").val("");
                      $("#coupbal").val("");
                                        $("#coupname").val("");
                      $('#curpaid').val("");
                       $("#balanceamout").val("");
			$(".pop_payment_mode_sel_btn").removeClass('mode_sel_btn_act');
		          $(this).addClass('mode_sel_btn_act');
			$(".cash_cc").hide(500);
                        $(".upi_cc").hide(500);
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
				 $("#coupname").focus();	
		});
		$("#voucher").click(function(){
                      $('#loyaltydiv').hide();
                    $('#currencychg').attr("disabled", false);  
                             $('#curpaid').attr("disabled", false);
                     $("#amount_credit1").val("");
                     $("#paidamount_credit").val("");
                    $("#completext").val("");
                    $('#paidamount').val("");
                      $('#curpaid').val("");
                       $("#balanceamout").val("");
			$(".pop_payment_mode_sel_btn").removeClass('mode_sel_btn_act');
		$(this).addClass('mode_sel_btn_act');
			$(".cash_cc").hide(500);
                        $(".upi_cc").hide(500);
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
                      $('#loyaltydiv').hide();
                    $('#currencychg').attr("disabled", false);  
                             $('#curpaid').attr("disabled", false);
                     $("#cheqbank").val("");
                    $("#cheqname").val("");
                    
                     $("#amount_credit1").val("");
                     $("#paidamount_credit").val("");
                    $("#completext").val("");
                     $("#cheqamount").val("");
                                        $("#cheqbal").val("");
                    $("#transcationid").val("");
                                       $("#transbal").val("");
                    $('#paidamount').val("");
                      $('#curpaid').val("");
                       $("#balanceamout").val("");
			$(".pop_payment_mode_sel_btn").removeClass('mode_sel_btn_act');
		$(this).addClass('mode_sel_btn_act');
			$(".cash_cc").hide(500);
                        $(".upi_cc").hide(500);
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
                                         var on=$('#curshow').val();
                                         if(on=="Y"){
                                           $("#cheqamount").focus();
                                            $('#focusedtext1').val('cheqamount');
                                       }else
                                       {
                                         $('#cheqamount').focus();   
                                          $('#focusedtext1').val('cheqamount');
                                       }
		});
                
                
		$("#credit_person").click(function(){
                    
                   
                     var default_company=$('#default_company').val();
                     
                    if(default_company=='Y'){
                        
                        
             $('#selectcreditypes').val('4');
            $("#selectcreditypes").trigger("change");
            var bill_check= $('#settleingbilno').text();
          
            var chk_bill = 'value=check_company&bill_check='+bill_check;
            $.ajax({
            type: "POST",
            url: "load_div.php",
            data: chk_bill,
            success: function(msg) {
              if($.trim(msg)!='no'){
                  //$('#selectcreditdetailsname').val($.trim(msg));
                  $('#selectcreditdetailsname').val('');
                  
               }else{
                  $('#selectcreditdetailsname').val('Select Company'); 
               }
                
                }
               });
              $('.payment_auth_pop').hide();
              $('.confrmation_overlay_auth').css('display','hide');   
                        
                        
                        
                    
               }else{
                  $('.payment_auth_pop').show();
                      $('.confrmation_overlay_auth').show();
                       $('.head_change').text('Credit Authorization');
                   }         
                       
                       
                       
                        $("#pin_pay").val("");
                       $("#pin_pay").focus();
                       
                   $('#loyaltydiv').hide();
                  $('#cur1').val("");
                    $('#currencychg').attr("disabled", false);  
                             $('#curpaid').attr("disabled", false);
                       $("#amount_credit").val("");
                     $("#amount_credit1").val("");
                    $("#completext").val("");
                    $('#paidamount').val("");
                      $('#curpaid').val("");
                       $("#balanceamout").val("");
                   
                     $("#paidamount_credit").val("");
                     $("#cheqamount").val("");
                                        $("#cheqbal").val("");
                    $("#transcationid").val("");
                                       $("#transbal").val("");
                   $('#cursign').hide(500);
                    $('#cursigntot').hide(500);
                    $('#balncamnt').css('display','none');
			$(".pop_payment_mode_sel_btn").removeClass('mode_sel_btn_act');
		$(this).addClass('mode_sel_btn_act');
                //$('.submittranscations_whole').css("display", "block");
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
                                         var on=$('#curshow').val();
                                         if(on=="Y"){
                                             
                                        $("#cur1").focus();
                                        $('#focusedtext1').val('cur1');
                                        $("#paidamount_credit").val('0');
                                    }else{
                                        
                                        $('#focusedtext1').val('paidamount_credit');
                                      $("#paidamount_credit").focus();
                                      $("#paidamount_credit").val('0');
                                    }
		});
                
                
		$("#complimentary").click(function(){
                   
                    $('.payment_auth_pop').show();
                      $('.confrmation_overlay_auth').show();
                    $('.head_change').text('Complimentary Authorization');
                     $("#pin_pay").val("");
                       $("#pin_pay").focus();
                      $('#loyaltydiv').hide();
                    $('#currencychg').attr("disabled", false);  
                             $('#curpaid').attr("disabled", false);
                       $("#amount_credit1").val("");
                       $("#completext").val("");
                       $("#cheqamount").val("");
                                        $("#cheqbal").val("");
                    $("#transcationid").val("");
                                       $("#transbal").val("");
			$(".pop_payment_mode_sel_btn").removeClass('mode_sel_btn_act');
		$(this).addClass('mode_sel_btn_act');
			$(".cash_cc").hide(500);
                  $(".cash_cc").hide(500);
                    $(".credit_cc").hide(500);
					$(".credit_cc_normal").hide(500);
                    $(".coupon_cc").hide(500);
                    $(".upi_cc").hide(500);
					$(".voucher_cc").hide(500);
					$(".cheque_cc").hide(500);
					$(".credit_type").hide(500);
					$(".complimentrary_management").hide(500);
					$(".complimentrary_cc").show(500);
					$('.paid_amount_cc').hide(500);
					$('.paid_amount_cc_credit').hide(500);
	        		$('#ta_staffsubmit').hide();
					$('#ta_staffclose').show();
                                        $("#completext").focus();
                                         $('#focusedtext1').val('completext');
		});
		
                $("#upi").click(function(){
                      $('#loyaltydiv').hide();
                    $('#currencychg').attr("disabled", false);  
                     $('#curpaid').attr("disabled", false);
                     $("#amount_credit1").val("");
                     $("#paidamount_credit").val("");
                    $("#completext").val("");
                    $('#paidamount').val("");
                    $("#coupamount").val("");
                      $("#coupbal").val("");
                        $("#coupname").val("");
                      $('#curpaid').val("");
                       $("#balanceamout").val("");
                       
                        $('#upistatus').val('');
                        $('#upiamount').val('');
                        $('#upibalanceamount').val('');
                         $('#upitransactionid').val('');  
                        $(".pop_payment_mode_sel_btn").removeClass('mode_sel_btn_act');
		          $(this).addClass('mode_sel_btn_act');
			$(".cash_cc").hide(500);
                    $(".credit_cc").hide(500);
					$(".credit_cc_normal").hide(500);
                    $(".coupon_cc").hide(500);
                    $(".upi_cc").show(500);
                     //$(".upi_cc").hide(500);
					$(".voucher_cc").hide(500);
					$(".cheque_cc").hide(500);
					$(".complimentrary_management").hide(500);
				$(".complimentrary_cc").hide(500);
				$(".credit_type").hide(500);
				$('.paid_amount_cc').hide(500);
                                $('.upibalanceamount').hide(500);
                                $('#upibalanceamount').hide(500);
					$('.paid_amount_cc_credit').hide(500);
					$('#ta_staffsubmit').show();
					$('#ta_staffclose').hide();
		});
		
                $("#txnstatuscheck").click(function(){
                    
                    var billno = $('#bill').val(); 
                    var grand=parseFloat($('#grandtotal').text());
                    //alert(billno);
                    //alert(grand);
                    var transaction_id=$('#upitxnid').val();
                    var data_upipayment_satus="set=upipayment_status&billno="+billno;
                    // alert(datastringnewmultinew);
                     $.ajax({
                      type: "POST",
                      url: "load_paymentpending.php",
                      data: data_upipayment_satus,
                      success: function(data)
                        {
                           alert(data);
                            var rs=JSON.parse(data);
                             $('#upistatus').val(rs.TXN_STATUS);
                             //alert(rs.TXN_STATUS);
                            if(rs.TXN_STATUS=='success'){
                            $('#upiamount').val(rs.TXN_AMOUNT);
                            $('#upitransactionid').val(rs.TXN_ID);
//                            var balance_amount_topay=grand-parseFloat($('#upiamount').val());
//                            //alert(balance_amount_topay);
//                            $('#upibalanceamount').val(balance_amount_topay);
//                            //alert(rs.TXN_STATUS);
                             var upi=rs.TXN_AMOUNT;
                       var data_pole = 'set_pole_paid=pole_display_paid&paid='+upi+"&mode=upi";
			$.ajax({
			type: "POST",
			url: "index.php",
			data: data_pole,
			success: function(data5) {
			
			}
			});

                            }
                            else{
                                $('#upiamount').val('');
                                $('#upitransactionid').val('');
//                                $('#upibalanceamount').val(grand);
                            }
                        }
        
                        });
                    
                    });
		
        
	/***************************************  credit types ends **********************************************************  */
$(".pop_auth_close").unbind().click(function(event){
    
     $('.confrmation_overlay').hide();
     $('.payment_auth_pop').hide();
             $('.confrmation_overlay_auth').hide();
             $('#cash').click();
    });

   $('#pin_pay').keypress(function(ev){
             if(ev.keyCode == 13){
             ev.stopImmediatePropagation();
             
              if($('.head_change').text()!="Settle Authorization"){
             $('.pop_auth_proceed').trigger('click');
              }else{
                   $('#settle_check').click(); 
             
              }
            }
   });

$(".pop_auth_proceed").unbind().click(function(event){
        
        
        if($('.head_change').text()!="Settle Authorization"){
      event.stopImmediatePropagation();
      var pin =  $('#pin_pay').val();
       if(pin!=''){
            
             if( $('.complimentrary_cc').css('display') == 'block'){
                $.post("load_paymentpending.php", {pin:pin,type:'authpincheck',set:'pincheck'},
                            function(data){
                                data=$.trim(data);
                                if(data!="NO"){
                                var spl=data.split('*');
                                if(spl[11]=='comp:Y'){
                                  
             $('#code_comp_credit').val(spl[12]);             
             $('.payment_auth_pop').hide();
             $('.confrmation_overlay_auth').hide();
             $('.head_change').text('');
             $('#loyaltydiv').hide();
             $('#currencychg').attr("disabled", false);  
             $('#curpaid').attr("disabled", false);
             $("#amount_credit1").val("");
             $("#completext").val("");
             $("#cheqamount").val("");
             $("#cheqbal").val("");
             $("#transcationid").val("");
             $("#transbal").val("");
             $(".pop_payment_mode_sel_btn").removeClass('mode_sel_btn_act');
	     $('#complimentary').addClass('mode_sel_btn_act');
	     $(".cash_cc").hide(500);
             $(".cash_cc").hide(500);
             $(".credit_cc").hide(500);
	     $(".credit_cc_normal").hide(500);
             $(".coupon_cc").hide(500);
             $(".upi_cc").hide(500);
	     $(".voucher_cc").hide(500);
					$(".cheque_cc").hide(500);
					$(".credit_type").hide(500);
					$(".complimentrary_management").hide(500);
					$(".complimentrary_cc").show(500);
					$('.paid_amount_cc').hide(500);
					$('.paid_amount_cc_credit').hide(500);
	        		        $('#ta_staffsubmit').hide();
					$('#ta_staffclose').show();
                                        $("#completext").focus();
                                        $('#focusedtext1').val('completext');
                                    }else{
                                        $("#pin_error_split").css("display","block");
					$("#pin_error_split").text("No Permission");
					$("#pin_error_split").delay(2000).fadeOut('slow');
                                        $("#pin_pay").val('');
                                        $("#pin_pay").focus();
                                    }    
                                }else{
                                    $("#pin_error_split").css("display","block");
                                    $("#pin_error_split").text("CODE IS NOT REGISTERED");
                                    $("#pin_error_split").delay(2000).fadeOut('slow');
                                    $("#pin_pay").val('');
                                    $("#pin_pay").focus();
						
				}
                            });
                 
             }else  if( $('.paid_amount_cc_credit').css('display') == 'block'){
                 
               $.post("load_paymentpending.php", {pin:pin,type:'authpincheck',set:'pincheck'},
                            function(data){
                            data=$.trim(data);
                            if(data!="NO"){
                            var spl=data.split('*');
                            if(spl[10]=='credit:Y'){
                                
             $('.payment_auth_pop').hide();
                      $('.confrmation_overlay_auth').hide();
                       $('.head_change').text('Credit Authorization');
                       
                        $("#pin_pay").val("");
                       $("#pin_pay").focus();
                       
                $('#loyaltydiv').hide();
                $('#cur1').val("");
                $('#currencychg').attr("disabled", false);  
                $('#curpaid').attr("disabled", false);
                $("#amount_credit").val("");
                $("#amount_credit1").val("");
                $("#completext").val("");
                $('#paidamount').val("");
                $('#curpaid').val("");
                $("#balanceamout").val("");
                 $("#paidamount_credit").val("");
                $("#cheqamount").val("");
                $("#cheqbal").val("");
                $("#transcationid").val("");
                $("#transbal").val("");
                $('#cursign').hide(500);
                $('#cursigntot').hide(500);
                $('#balncamnt').css('display','none');
		$(".pop_payment_mode_sel_btn").removeClass('mode_sel_btn_act');
		$('#credit_person').addClass('mode_sel_btn_act');
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
                                         var on=$('#curshow').val();
                                         if(on=="Y"){
                                             
                                        $("#cur1").focus();
                                        $('#focusedtext1').val('cur1');
                                        $("#paidamount_credit").val('0');
                                    }else{
                                        
                                        $('#focusedtext1').val('paidamount_credit');
                                      $("#paidamount_credit").focus();
                                      $("#paidamount_credit").val('0');
                                    }
                                    
                                    
                                    
            
                                    }else{
                                        $("#pin_error_split").css("display","block");
					$("#pin_error_split").text("No Permission");
					$("#pin_error_split").delay(2000).fadeOut('slow');
                                        $("#pin_pay").val('');
                                        $("#pin_pay").focus();
                                    }    
                                }else{
                                    $("#pin_error_split").css("display","block");
                                    $("#pin_error_split").text("CODE IS NOT REGISTERED");
                                    $("#pin_error_split").delay(2000).fadeOut('slow');
                                    $("#pin_pay").val('');
                                    $("#pin_pay").focus();
						
				}
                            });
            
             }
            
        
    
                 }else{
                        $("#pin_error_split").css("display","block");
			$("#pin_error_split").text("ENTER YOUR PIN ");
			$("#pin_error_split").delay(2000).fadeOut('slow');
                        $("#pin_pay").focus();
                 }
        }
  
    });








    $('.calculator_icon_pop').click(function() {
   $('.counter_settle_popup_right_calc_cc').toggle();
	});


function changecurrency(){
   var sg=$('#currencychg').val();
   var sg1=sg.split("_");
   $('#cursign').html(sg1[1]);
     $('#cursign2').html(sg1[0]);
    var tt=sg1[0];
    
  
  var datastringnew="set=cat1&idofcur="+tt;
       
       $.ajax({
        type: "POST",
        url: "payment_pending.php",
        data: datastringnew,
        success: function(data)
        {
     
        }
        
    });
      $("#refdiv").load(location.href + " #refdiv");

}

function hidval(){
   
    $('#hid').hide();
   
}


function curpaid(){
    var tran=$('#transcationid').val();
     var chq=$('#cheqname').val();
    var tranbl=$('#transbal').val(); 
     var chbl=$('#cheqbal').val(); 
    var curvalue=$('#curpaid').val();
    var convo=$('#convorate').val();
    var actual=curvalue*convo;
    var grt=$('#grandtotal').html();
    var pd=$('#paidamount').val();
    $('#paidamount').val(actual.toFixed(3));
  
    var tot=actual-grt;
    
    
    if(actual>grt){
    $('#balanceamout').val(tot.toFixed(3));
  
    }
      if(tran==""){
   if(actual=grt){
    $('#balanceamout').val(tot.toFixed(3));
  
    }  
    }  
     
    if(actual==""){
        $('#balanceamout').val("");  
         $('#paidamount').val("");
     }
    
  if(tran!="" && chbl==""){
      var bm=actual-tranbl;
    
        $('#balanceamout').val(bm.toFixed(3));  
  }
  
  if(chbl!=""){
        var chbl23=$('#cheqbal').val(); 
       var pd23=$('#paidamount').val();
     $('#balanceamout').val('');  
     
      var tr1 =pd23-chbl23;
     
        $('#balanceamout').val(tr1.toFixed(3));  
   
  }

       if(tran==""){
if(actual<grt){
    
        $('#balanceamout').val(tot.toFixed(3)); 
      }
       }
 
}
 
 //creditperson//
 
 function hidval1(){
     $('#hid1').hide();
 }

    function changecurrency1(){
       var sg11=$('#currencychg1').val();
   var sg2=sg11.split("_");
   $('#curtpye').html(sg2[1]);
     $('#cursign22').html(sg2[0]);
    var tt1=sg2[0];
    
  
  var datastringnew1="set1=cat11&idofcur1="+tt1;
       
       $.ajax({
        type: "POST",
        url: "payment_pending.php",
        data: datastringnew1,
        success: function(data)
        {
    
        }
        
    });
      $("#refdivall").load(location.href + " #refdivall");
     
    }
    
    function cur1(){
   $("#paidamount_credit").prop('disabled', true);
    var curvalue11=$('#cur1').val();
    var convo11=$('#convorate1').val();
    var actalvalue=curvalue11*convo11;
     var grtall=$('#grandtotal').html();
   $('#paidamount_credit').val(actalvalue.toFixed(3));

 $("#crtype_div").load(location.href + " #crtype_div");

    }

    function chvalof(){

   var ac12=parseFloat($('#paidamount_credit').val());   
     var grtall25=$('#grandtotal').html();
  if(ac12>grtall25){
     
      alert('Credit not possible');
  }
 
  var totall=((grtall25-ac12).toFixed(3));

  var datastringnew2="setamt=amt&totalamt="+totall;
      
       $.ajax({
        type: "POST",
        url: "load_paymentpending.php",
        data: datastringnew2,
        success: function(data)
        {

        }
        
    });

    }

    function card(a){
 
       $('#'+a).toggleClass('card_active');
      }
  
function settlepopupcommoncs(){
  window.location.href="counter_sales.php?setcscommon=settlecspopup";  
}

function settlepopupcommonta(){
   
  
     window.location.href = "take_away_.php?settacommon=settletapopup";

   }

function numonly(evt)
    {
        evt = (evt) ? evt : window.event;
        var charCode = (evt.which) ? evt.which : evt.keyCode;
        if (charCode > 31 && (charCode < 48 || charCode > 57)) {

            return false;

        }
        if (evt.keyCode == 13) {
                   
             $('.submitcard').click();
              }
        return true;
    }


function enter_plus(evt)
  {
    
        if(evt.keyCode == 13 ) {
         
           $(".plusbtn").click();     
       
              }
        return true;
 }


   $(".plusbtn").click( function()
   {  
              
            //event.preventDefault();
            var decimal=$('#decimal').val();
            $(".plusbtn").css('pointer-events','none');
            //  $("#newref").load(location.href + " #newref");
            var gtt=$('#grandtotal').html();
            var tran1=$('#transcationid').val();
            var tran=tran1.replace(',','');
            var camount = $('#multi_cardamount').val();
            var  tot=parseFloat(camount)+parseFloat(tran);
       
          if(tot==gtt){
              
              $('#balanceamout').val('0');
              $('#paidamount').val('0');
            
                //$('#paidamount').focus();
              
          } 
        
            if(camount!="" && tot<=gtt ){ 
                
            var ctype =  $("#multicardtype").val();
            var camount = $('#multi_cardamount').val();
            var cnumber = $("#card_1").val();
             var billno=$('#bill').val(); 
                
             var datastring = "ctype="+ctype+"&camount="+camount+"&cnumber="+cnumber+"&billno="+billno;
            

                 $.ajax({
                 type: "POST",
                 url: "load_div.php",
                 data: datastring,
                 success: function (data)
                 { 
                     
                     var arr = data.split("+");
                     var a=JSON.parse(arr[0]);
                     var b=JSON.parse(arr[1]);
                 
                     $("#multicardtype").val('');
                     $("#multi_cardamount").val('');
                     $("#card_1").val('');
                     
                    var decimal=$('#decimal').val();
                        
                     $.each(a, function(i, record) {
                         
                            if($.trim(record.mc_carnumber)==''){
                                var cardnum='';
                            }
                            else{
                                 var cardnum=record.mc_carnumber;
                            }
                           
                         var amount=parseFloat(record.mc_cardamount).toFixed(decimal);
                         
              if($('.cardadder').find('#del_card' + record.mc_slno).length === 0) {
              $(".cardadder").append("<div class='card_detail_popup_list refdiv_card ' id='card_detail_popup_list"+record.mc_slno+"'  style='margin-bottom:3px'> <div class='card_detail_popup_type' style='width:30%;margin-right:1%'>"+
              "<select class='card_type_dropdwn cardselect' id='multicardtype"+record.mc_slno+"' onclick='return selectdefault();'> <option value='' > Select Card</option>"+
              b+ "</select>"+
              "</div>"+  
              "  <div class='card_detail_popup_type' style='width: 33%;'>"+
              "<input class='card_popup_digits cardno' type='text' id='card_1"+record.mc_slno+"' value='" + cardnum + "' name='card_1"+record.mc_slno+"'  onkeypress='return numonly("+record.mc_slno+")' onclick='return pincard("+record.mc_slno+")' onchange='return pincard("+record.mc_slno+")' maxlength='4' autocomplete='off'>"+
              "</div>"+
              "<div class='card_detail_popup_type' style='width:18%;margin-left:1%'>"+
              "<input type='text' class='card_type_dropdwn amountall' id='multi_cardamount"+record.mc_slno+"' value='" + amount + "' name='multi_cardamount"+record.mc_slno+"' onkeypress='return numonly()' onkeyup='return cardsum("+record.mc_slno+")' onclick='return cardsum("+record.mc_slno+")' onchange='return cardsum("+record.mc_slno+")' autocomplete='off'>"+
              " </div>"+
              "<div style='margin-top:0px;width: 12%;height: 34px;margin-top: -1px;float: right' id='del_card"+record.mc_slno+"' name='del_card"+record.mc_slno+"' class='menut_add_bq_btn' onclick='return deletecard("+record.mc_slno+");'><img width='23px' src='img/cancel-icon.png'></div>"+
              "</div>"        
              
                    );
                                 
                         }
                         
                          $("#multicardtype"+record.mc_slno).val(record.mc_cardtype);
                          $("#multicardtype"+record.mc_slno).prop('disabled',true);
                          $("#card_1"+record.mc_slno).prop('disabled',true);
                          $("#multi_cardamount"+record.mc_slno).prop('disabled',true);
                         
                     });
                     
                          $(".plusbtn").css('pointer-events','inherit');
                 }
                 });
                 
                 
        var multibillnew16=$('#bill').val();  
        var datastringnewmultinew16="setmultinew16=multicardnew16&multibillnew16="+multibillnew16;
    
       $.ajax({
        type: "POST",
        url: "payment_pending.php",
        data: datastringnewmultinew16,
        success: function(data)
        {
        
        $(".trrefresh").load(location.href + " .trrefresh");
       
        
        }
    });
    
    
         var tr=parseFloat($('#transcationid').val());
         if(tr==0){
         tr=(0+ parseFloat(camount)).toFixed(decimal);
         }else{
         tr=(tr+ parseFloat(camount)).toFixed(decimal);
         }
         var tb=(parseFloat(gtt)-tr).toFixed(decimal);
         
                        var data_pole = 'set_pole_paid=pole_display_paid&paid='+tr+"&balance="+tb+"&mode=card";
			$.ajax({
			type: "POST",
			url: "index.php",
			data: data_pole,
			success: function(data5) {
			
			}
			});
                
         
         
            
                 }else{
                 
                $(".payment_pend_right_cash_error").css("display","block");
		$(".payment_pend_right_cash_error").addClass("popup_validate");
		$(".payment_pend_right_cash_error").text("Check Amount");
		$('.payment_pend_right_cash_error').delay(2000).fadeOut('slow');
                $(".plusbtn").css('pointer-events','inherit');
                
                 }
           // $('#paidamount').focus();
            $('#balanceamout').val('0');
              $('#paidamount').val('0');
             $('.submittranscations').click();
        });




function pincard(r){
$('#focusedtext1').val('card_1');
}

function cardsum(r){
$('#focusedtext1').val('multi_cardamount');
}



function deletecard(e){
   
    var check = confirm("Are you sure you want to Delete?");
	if(check==true)
	{
    var bil=$('#bill').val();
 var decimal=$('#decimal').val();
    $('#card_detail_popup_list'+e).hide();
   var datastringnewcard="setdel=delcar&bilcard="+bil+"&slnocard="+e;

 
       $.ajax({
        type: "POST",
        url: "payment_pending.php",
        data: datastringnewcard,
        success: function(data)
        {      
           var multibillnew16=$('#bill').val();  
        var datastringnewmultinew16="setmultinew16=multicardnew16&multibillnew16="+multibillnew16;
    
       $.ajax({
        type: "POST",
        url: "payment_pending.php",
        data: datastringnewmultinew16,
        success: function(data)
        {  
          
           $(".trrefresh").load(location.href + " .trrefresh");
          //$("#card_detail_popup_list"+e).load(location.href + " #card_detail_popup_list"+e);
        $('#card_detail_popup_list'+e).remove();
        $('#balanceamout').val('');
              $('#paidamount').val('');
            //  $('#paidamount').focus();
        }
    });
     
        }
        
    });
    
    var tr1=parseFloat($('#transcationid').val());
    var tr_row=parseFloat($('#multi_cardamount'+e).val());
    var tr_del=(tr1-tr_row).toFixed(decimal);
    var gtt=parseFloat($('#grandtotal').html());
    var tb_del =(gtt-tr_del).toFixed(decimal); 
    if(tr_del==0){
        tb_del=0;
        tr_del=0;
    }
    
    var data_pole = 'set_pole_paid=pole_display_paid&paid='+tr_del+"&balance="+tb_del+"&mode=card";
    $.ajax({
    type: "POST",
    url: "index.php",
    data: data_pole,
    success: function(data5) {
        
        }
	});
     
    }
 
}




function number_search(number) {
    $('#focusedtext1').val('selectcreditdetailsnumber');
     var credit_type=$('#selectcreditypes').val();
     
    $("#suggession_name").html('');
    if(number.length>2){
        
       if($("#suggession_number").html()!=''){
         //alert('1');
   //$('#selectcreditdetailsname').val('');
     }
        var data_number='';
        var data_name='';
        var data1="set=guestnumber_search&number="+number+"&name=&credit_type="+credit_type;;
        $.ajax({
        type: "POST",
        url: "load_paymentpending.php",
        data: data1,
        success: function(data)
        {  $("#suggession_number").html('');
            //alert(data);
            data1=JSON.parse(data);
           var data_number=data1.mobile;
           var data_name=data1.name;
           //alert(data_name);
        for(var i=0;i<data_number.length;i++)
                {
                   $("#suggession_number").append('<div id="'+data_name[i]+'"  onclick="return number_select(this.id,'+data_number[i]+')">'+data_number[i]+'</div>') ;
                     
                }
        }
         
        });
       
    }
}


function number_dot(event){
 if (event.which != 46 && (event.which < 47 || event.which > 59))
    {
        event.preventDefault();
        if ((event.which == 46) && ($(this).indexOf('.') != -1)) {
            event.preventDefault();
        }
    }   
}


function name_search_click() {
     $("#suggession_name").hide();
}


function number_select(name,number){
    //alert(name);
    $('#selectcreditdetailsnumber').val(number);
    $('#selectcreditdetailsname').val(name);
    $("#suggession_number").html('');
    
}

function name_search(name) {
    var credit_type=$('#selectcreditypes').val();
    //alert(credit_type);
      
    $("#suggession_number").html('');
    
    if(name.length>2){
        if($("#suggession_name").html()!=''){
           //alert('2');
   $('#selectcreditdetailsnumber').val('');
      }
        
       if(credit_type=='4'){
           
        var data_number='';
        var data_name='';
        var data1="set=guestnumber_search&number=&name="+name+"&credit_type="+credit_type;
        $.ajax({
        type: "POST",
        url: "load_paymentpending.php",
        data: data1,
        success: function(data)
        {  
            $("#suggession_name").show();
        $("#suggession_name").html('');
            //alert(data);
            data1=JSON.parse(data);
           var data_number=data1.mobile;
           var data_name=data1.name;
           //alert(data_number);
        for(var j=0;j<data_name.length;j++)
                {
                   $("#suggession_name").append('<div class="name_apend" id="'+data_name[j]+'" number="'+data_number[j]+'"  onclick="return name_select(this.id,'+data_number[j]+')">'+data_name[j]+'</div>') ;
                     
                }
        }
    });
    }
    
        else if(credit_type=='3'){
            //alert(name);
            var data_number='';
        var data_name='';
        var data1="set=guestnumber_search&number=&name="+name+"&credit_type="+credit_type;
        $.ajax({
        type: "POST",
        url: "load_paymentpending.php",
        data: data1,
        success: function(data)
        {   $("#suggession_name").show();
            $("#suggession_name").html('');
            //alert(data);
            data1=JSON.parse(data);
           var data_name=data1.name;
           //alert(data_number);
        for(var j=0;j<data_name.length;j++)
                {
                   $("#suggession_name").append('<div class="name_apend" id="'+data_name[j]+'" name="'+data_name[j]+'"  onclick="return name_select(this.id)">'+data_name[j]+'</div>') ;
                     
                }
        }
        });
        
        }
         
        }
       
    }

function name_select(name,number){
    var credit_type=$('#selectcreditypes').val();
    if(credit_type=='4'){
    $('#selectcreditdetailsnumber').val(number);
    $('#selectcreditdetailsname').val(name);
    }
    else if(credit_type=='3'){
        $('#selectcreditdetailsname').val(name);
    }
    $("#suggession_name").html('');
   
    
}



function name_select1(name){
    
      $('#selectcreditdetailsname').val(name);
    $("#suggession_name").html('');
    
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
      function coupon_code_redeem(e){
 
    var decimal=$('#decimal').val();
   var code=$('#coupname').val();
   var data1 ='set=coupon_check&code='+code;
   var total1=$('#grandtotal').text();
  var total=total1.replace(',','');

                                $.ajax({
                                    type: "POST",
                                    url: "load_paymentpending.php",
                                    data: data1,
                                    success: function(data) {
                                        
                                        var code_value1=$.trim(data).split('*');
                                     var code_value = code_value1[0];
                                 var code_active=code_value1[1];
                             if(code_value1[2]=='Y'){
                                 if(code_active=='Y'){
                                     if(code_value!=''){
                                         
                                         
                                     $('.payment_pend_right_cash_error').css("display","block");
                                     $(".payment_pend_right_cash_error").addClass("popup_validate");
                                     $('.payment_pend_right_cash_error').text('Coupon Code Applied Successfully - '+code_value+'%');
                                     $('.payment_pend_right_cash_error') .delay(3000).fadeOut('slow');
                                     
                                        var coup_amt=(total*code_value/100);
                                        var bal=total-coup_amt;
                                        $('#coupamount').val(coup_amt.toFixed(decimal));
                                        $('#coupbal').val(bal.toFixed(decimal));   
                                        $('#paidamount').val('');  
                                        $('#balanceamout').val('0');
                                        
                                        $('#coupon_code').val(code);
                                      }else{
                                          
                                         $('#coupamount').val('');  
                                         $('#coupbal').val(total);  
                                         $('#paidamount').val('');  
                                         $('#balanceamout').val('0');  
                                      }
                                  }else if(code_active=='N'){
                                      $('.payment_pend_right_cash_error').css("display","block");
                                     $(".payment_pend_right_cash_error").addClass("popup_validate");
                                     $('.payment_pend_right_cash_error').text('Coupon Code Already Used');
                                     $('.payment_pend_right_cash_error') .delay(2000).fadeOut('slow');
                                      $('#coupamount').val('');  
                                         $('#coupbal').val(total);  
                                         $('#paidamount').val('');  
                                         $('#balanceamout').val('0');  
                                  }
                              }else{
                                      $('.payment_pend_right_cash_error').css("display","block");
                                     $(".payment_pend_right_cash_error").addClass("popup_validate");
                                     $('.payment_pend_right_cash_error').text('Coupon Does Not Exist');
                                     $('.payment_pend_right_cash_error') .delay(1500).fadeOut('slow');
                                      $('#coupamount').val('');  
                                         $('#coupbal').val(total);  
                                         $('#paidamount').val('');  
                                         $('#balanceamout').val('0');  
                                  }
                              
                             }
                                    
                                });
}  
        
        
        
 </script>
       
</body>

<div style="display:none;height: 160px;" class="index_popup_1 closeoneclass kotconfirmpopup_reprint_di">
        <span id="kotfailmsg_reprint_di" style="text-align: center;width: 100%;float: left ;padding-top: 7px;"></span>
 	<div class="index_popup_contant">Are you sure you want continue without Bill Re-Print ?</div>
       <div class="index_popup_contant">
    	<div class="btn_index_popup"><a href="#" class="confirmkotok_reprint_di">Yes</a></div>
        <div class="btn_index_popup"><a href="#" class="confirmkotclose_reprint_di">No</a></div>
    </div>
 </div>    
</html>