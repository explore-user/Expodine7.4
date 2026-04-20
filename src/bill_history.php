<?php
header('Content-Type: text/html; charset=utf-8');
include('includes/session.php');  

include("database.class.php"); 
$database = new Database();
include('includes/master_settings.php');
require_once("includes/title_settings.php");

include("api_multiplelanguage_link.php");
$floorid=  trim(json_encode($_SESSION['floorid']),'""');
$other_lang=  trim(json_encode($_SESSION['main_language']),'""');

 
     $sql_bilhis7 = "select bm_billno,bm_paymode  from tbl_tablebillmaster "
     . " WHERE bm_dayclosedate='" . $_SESSION['date'] . "' AND bm_status = 'Regenerating' limit 5 ";
     $sql_bilhistory7 = $database->mysqlQuery($sql_bilhis7);
     $num_bilhistory7 = $database->mysqlNumRows($sql_bilhistory7);
     if ($num_bilhistory7) {
     while ($result_bilhistory7 = $database->mysqlFetchArray($sql_bilhistory7)) {
         
        if($result_bilhistory7['bm_paymode']!='' && $result_bilhistory7['bm_paymode']!=NULL){
             
             $sql_ds = $database->mysqlQuery("update tbl_tablebillmaster set bm_status='Closed' where "
             . " bm_dayclosedate='".$_SESSION['date']."' and bm_billno='".$result_bilhistory7['bm_billno']."' ");  
             
       }
         
     } }

        
if(isset($_REQUEST['setmultinew16'])&&($_REQUEST['setmultinew16']=="multicardnew16")){
    
      $multibilledit16=     $_REQUEST['multibillnew16'];
      $_SESSION['billcardbh']=$multibilledit16;
    
 } 
            
            
  if(isset($_REQUEST['setdel'])&&($_REQUEST['setdel']=="delcar")){
      
             $multibilldel=     $_REQUEST['bilcard'];
             $multislnodel=     $_REQUEST['slnocard'];
          
        $query321=$database->mysqlQuery(" DELETE FROM tbl_bill_card_payments WHERE (mc_billno='$multibilldel' or mc_billno='temp_".$multibilldel."') "
        . "  and mc_slno='$multislnodel'");    
             
 }
 
        
  if(isset($_REQUEST['sethistory'])&&($_REQUEST['sethistory']=="delhistory")){
      
             $multibilldelhistory=     $_REQUEST['bilcardhistory'];
        
             $queryhistory=$database->mysqlQuery("  DELETE FROM tbl_bill_card_payments WHERE (mc_billno = 'temp_".$multibilldelhistory."' or "
             . " mc_billno = '".$multibilldelhistory."')");  
             
   }      

 

if (!isset($_SESSION['timeopen'])) {
    
    header("location:index.php?msg=1");
}


$date_given = explode("-", $_SESSION['date']);
$days_in_month = cal_days_in_month(CAL_GREGORIAN, $date_given[1], $date_given[0]);
$month_set = $date_given[1]; 
$year_set = $date_given[0];
$day_set = $date_given[2]; 

$today = $day_set . "-" . $month_set . "-" . $year_set;


?>
<!DOCTYPE HTML>
<html><head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>DI Bill History</title>
        <link rel="shortcut icon" href="img/favicon.ico">
        <link href="css/bootstrap-cerulean.min.css" rel="stylesheet" />
        <link href="css/order_new.css" rel="stylesheet" type="text/css">
        <link href="css/bill_history.css" rel="stylesheet" type="text/css">
        <script src="js/jquery-1.10.2.min.js"></script> 
        <script src="js/bill_history.js"></script>
        <script src="js/bill_reprint.js"></script>
        <script src="js/bill_cancel.js"></script>
         <script src="js/bill_eachcancelhistory.js"></script>
        <script src="js/numpad.js"></script>
        <!--ESC Key press starts-->
        <link rel="stylesheet" href="css/jquery-ui.css">
        <script src="js/jquery-ui.js"></script>
        <link rel="stylesheet" href="css/style_date.css">
        
 <script>
 $(document).ready(function () {
       
                $("#datepicker").datepicker({
                    changeMonth: true,
                    changeYear: true,
                    maxDate: "+0D "
                });
         
  if($('#bill_history_all').val()!='' && $('#bill_history_all').val()!='undefined' && $('#bill_history_all').val()!=undefined){
      
      var billno=$('#bill_history_all').val();
      
                         ////////////multi bill hsitory load/////
                        $.post("load_bill_history.php", {billno:billno,set:'billdetailsset1'},
				  function(data)
				  {
				  	data=$.trim(data);
				  	$('#detailsset1').html(data);
				  });
			  
			
                          
			  $.post("load_bill_history.php", {billno:billno,set:'billdetailsset2'},
						function(data)
						{
						  data=$.trim(data);
						  $('#billdetailsset2').html(data);
						});

  }


  });
        </script>
        <style>
            body{font-family:inherit}
            .left_contant_container {height: 80vh;padding-top:0}	
            .tax_table td{  padding-left: 12px;text-align: left;}
            .tax_textbox {width: 100%;}
            .discount_text_cc{text-align:center}
            .updatestock{
                width: 40px;
                height: 37px;
                float: right;
                background-image: url(img/update.png);
                background-repeat: no-repeat;
                background-position: center;
                position:absolute;
                cursor:pointer;
                right: 0px;
                top: 20px;
                margin-right: 83%;
                margin-top: -16px;
            }
            .billgenration_validate{width:35%;}
            .top_site_map_cc{height: 39px;}
			
            .left_bill_history_contain{background-color:#FFFBEA}
            .bill_history_details_table td{color:#000;border: solid 1px #ccc !important;}
            .bill_number_head{background-color: #AB2426;}
            .bill_history_center_bill{background-color:#fff}
            .bill_history_right_detail{background-color:#fff}
            .bill_his_order_detail_head td{    background-color: #333;;border: solid 1px #ccc;}
            .bil_his_dish_name, .bil_his_sl_no{color:#000;border: solid 1px #ccc;border-top: 0;padding: 1% 0;height:30px;line-height: 22px;}
            .bill_history_close_btn{background-color: rgba(247, 146, 146, 0.5);}
            .bill_history_orderd_cont{margin:0;min-height: 200px;height:35vh;}
            .bill_story_center_top_txt{width:auto;height: auto;line-height: inherit;display: inline-block;text-align: left;padding-left:5px;    color: #929292}
            .bill_story_center_txt{width:95%;height:30px;line-height:30px;padding-left:5px;/*border:solid 1px #ccc;*/display: inline-block;text-align: left;margin-bottom:5px;border-radius: 3px;/*background: #FFF7EB;*/font-size: 16px;}
            .none_border_table td{border:none;padding-top:0px;}
            .right_bill_history_detail{height:30px;margin-bottom:0}
            .bill_story_center_txt{height: 25px;line-height: 16px;}
            .bill_his_buton_cc, .bill_cancel_btn{text-align:center;padding-left: 0;border: solid 1px #ccc;}
            .bill_cancel_btn{margin-right:2%;padding-top:0px;background-position: 10px 48%;width: 28%;position:relative;display:inline-block;float: none;}
            .bill_story_center_txt{overflow:hidden;margin-bottom:1px;}
            .bill_history_details_table {min-height: 420px;height: 73vh;}
			.take_staff_view_cont_bottom_contain{height:36px;}
			.bill_his_textbox{background: #f1f1f1; border: 0; border-bottom: solid 1px #ccc;height: 4.5vh}
			#detailsset1{min-height: 373px;height: 64vh;overflow: auto;}
			.bill_histor_tax_sec{width: 100%;height: auto;float: left;}
			.bill_histor_tax_sec_box{width:25%;height: auto;float: left;border: solid 1px #ccc;border-top: 0;}
			address strong{font-family: 'CALIBRIB_0';}
			address {margin-bottom: 3px;}
			/*.bill_history_center_bill .panel-default td{padding: 3px 0;}*/
			.bill_history_center_bill .panel-default{box-shadow: none;margin-bottom: 0}
			.bill_story_center_top_txt{color: #525151;position: relative}
			.bill_history_center_bill .panel-default td{padding: 3px;}
            .combo_tbl_lst{width: 100%; font-size: 11px;  color: #6d0a21;  line-height: 11px !important;
                            display: inline-block;}  
            .input_tip_textbox{width: 70%;height: 30px;float: right;border: solid 1px #ccc;border-radius:5px;padding-left: 5px }
            .input_tip_btn{width:30%;float: right;}
            .input_tip_btn .history-sub-btn{margin-top: 1px;float: right}
            .confrmation_overlay_proce{
	width:100%;
	height:100%;
	position:fixed;
	z-index:999;
	background-color:rgba(0,0,0,0.8);
	top:0;
	text-align:center;
	line-height: 40;
		}
.confrmation_overlay_proce img{width:100px;height:100px;}
        </style>
        <script>
            $(function () {

                /*************************************** cancel close click starts ******************************************************************  */
                $('.update_billdetails').click(function () {
                   
                    //checkday checkmonth checkyear
                    // var dateset=$('#checkyear').val() +"-"+ $('#checkmonth').val() +"-"+ $('#checkday').val();
                    // var dt=$('#datepicker').val();
                    //var res = dt.split("-");
                    //var dateset=res[2] +"-"+ res[1] +"-"+ res[0] ;
                    $('#datepicker').val($('#datehid').val());
                    var billno = $('.bill_history_active').attr("billno");
                    if (billno == '')
                    {
                        billno = '';
                    }
                    $.post("load_bill_history.php", {billno: billno, set: 'billwholeload'},
                            function (data)
                            {
                                data = $.trim(data);
                                $('#billlisttotal').html(data);
                              location.reload();
                            });

                });
                /*************************************** cancel close click ends ******************************************************************  */
            });
            
            
            
        </script> 

        <script type="text/javascript">
            $(document).ready(function () {


                $(".credit_cc").hide();
                $(".coupon_cc").hide();
                $(".voucher_cc").hide();
                $(".cheque_cc").hide();
                $('.closetranscations').css("display", "block");
                $('.closetranscations_whole').css("display", "none");
                
                
                
   $(".tax_textbox").change(function () {
                   
                 
    var aat = ($(this).val());
                
    if (aat == "1") {
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
        $("#paidamount").val("");
        $("#balanceamout").val("");
        
        
   }
                    
    ///card payment ///                
                    
    if (aat == "2") {

        $('.refdiv_card').html('');
        var multibillnew16=$('.bill_history_active').attr("billno");
                
        var datast="set=change_bank_card&billno="+multibillnew16+"&mode=DI";
    
        $.ajax({
        type: "POST",
        url: "load_index.php",
        data: datast,
        success: function(data)
        {
            var bank=$.trim(data);
       
            if(bank!='' && bank>0 && bank!='null' && bank!=null){ 
                
              $("#bankdetails").val(bank);
              
            }else{
               
             $("#bankdetails").val($("#bankdetails option:first").val());  
             
           }
     
      
        }
       });
           
                
        var datastringnewmultinew16="setmultinew16=multicardnew16&multibillnew16="+multibillnew16;
    
       $.ajax({
        type: "POST",
        url: "bill_history.php",
        data: datastringnewmultinew16,
        success: function(data)
        {
           
        $(".trrefresh").load(location.href + " .trrefresh");
        $(".trrefresh1").load(location.href + " .trrefresh1");
      
        }
    });
    
         
         var datastring = "billnoview_history="+multibillnew16;

                 $.ajax({
                 type: "POST",
                 url: "load_div.php",
                 data: datastring,
                 success: function (data)
                 { 
                     
                     var arr = data.split("+");
                     var a=JSON.parse(arr[0]);
                     var b=JSON.parse(arr[1]);
                     var c=JSON.parse(arr[2]);
                     var decimal=$('#decimal').val();
                    
                     $("#multicardtype").val('');
                     $("#multi_cardamount").val('');
                     $("#card_1").val('');
                     $("#multibanktype").val($("#multibanktype option:first").val());   
                 
                     $.each(a, function(i, record) {
                         
                         if($.trim(record.mc_carnumber)==''){
                                var cardnum='';
                            }
                            else{
                                 var cardnum=record.mc_carnumber;
                            }
                           
              var amount=parseFloat(record.mc_cardamount).toFixed(decimal);
              
              if($('.cardadder').find('#del_card' + record.mc_slno).length === 0) {
                  
              $(".cardadder").append("<div class='card_detail_popup_list refdiv_card' id='card_detail_popup_list"+record.mc_slno+"'  style='margin-bottom:3px'> <div class='card_detail_popup_type' style='width:30%;margin-right:1%;display:none'>"+
              "<select class='card_type_dropdwn cardselect' id='multicardtype"+record.mc_slno+"' onclick='return selectdefault();'> <option value='' > Select Card</option>"+
              b+ "</select>"+
              "</div>"+  
              "  <div class='card_detail_popup_type' style='width: 33%;'>"+
              "<input class='card_popup_digits cardno' type='text' id='card_1"+record.mc_slno+"' value='" + cardnum + "' name='card_1"+record.mc_slno+"'  onkeypress='return numonly()' onclick='return pincard()' onchange='return pincard()' maxlength='4' autocomplete='off'>"+
              "</div>"+
              "<div class='card_detail_popup_type' style='width:18%;margin-left:1%'>"+
              "<input type='text' class='card_type_dropdwn amountall' id='multi_cardamount"+record.mc_slno+"' value='" + amount + "' name='multi_cardamount"+record.mc_slno+"' onkeypress='return isNumberKey()' onkeyup='return cardsum()' onclick='return cardsum()' onchange='return cardsum()' autocomplete='off'>"+
              " </div>"+
              
              " <div class='card_detail_popup_type' style='width:30%;margin-right:1%'>"+
              "<select class='card_type_dropdwn bankselect_new' id='multibanktype"+record.mc_slno+"' onclick=''> <option value='' > Bank</option>"+
              c+ "</select>"+
              "</div>"+  
              "<div style='margin-top:0px;width: 12%;height: 34px;margin-top: -1px;float: right' id='del_card"+record.mc_slno+"' name='del_card"+record.mc_slno+"' class='menut_add_bq_btn' onclick='return deletecard("+record.mc_slno+");'><img width='23px' src='img/cancel-icon.png'></div>"+
              "</div>"        
              
              );
                                
              }
              
                         $("#multibanktype"+record.mc_slno).val(record.mc_to_bank);
                         $("#multibanktype"+record.mc_slno).prop('disabled',true);
                         $("#multicardtype"+record.mc_slno).val(record.mc_cardtype);
                         $("#multicardtype"+record.mc_slno).prop('disabled',true);
                         $("#card_1"+record.mc_slno).prop('disabled',true);
                         $("#multi_cardamount"+record.mc_slno).prop('disabled',true);
          
        
                     });
                
                 } 
                    
                 
  });
    
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
                        $("#paidamount").val("0");
                        $("#balanceamout").val("0");
                        $('#multi_cardamount').focus();  
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
                        $(".cash_cc").hide();
                        $(".credit_cc").hide();
                        $(".credit_cc_normal").hide();
                        $(".coupon_cc").hide();
                        $(".voucher_cc").hide();
                        $(".cheque_cc").hide();
                        $(".auto1").hide();
                        $(".auto").show();
                        $(".complimentrary_management").hide();
                        $('.paid_amount_cc').css("display", "none");
                        $('.paid_amount_cc_credit').css("display", "block");
                        $('.closetranscations').css("display", "none");
                        $('.closetranscations_whole').css("display", "block");
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
                
                
                
            $("#pinbh").keyup(function(event) {
         
            if (event.keyCode == 13) {
                if($("#pinbh").is(':focus')){
                   
               $('#kotcancel_reason_popup_new_proceed_btnbh_cs').click();
               if( $("#pinbh").val()!=''){
               $("#pinbh").blur();
           }
               
                }
              
              } 
        });
        
         $("#pin").keyup(function(event) {
         
            if (event.keyCode == 13) {
                if($("#pin").is(':focus')){
                   
               $('#kotcancel_reason_popup_new_proceed_btn').click();
               if( $("#pin").val()!=''){
               $("#pin").blur();
           }
               
                }
              
              } 
        });
                
                
                
   $('#kotcancel_reason_popup_new_proceed_btn').click(function () { 
            
               var pin =  $('#pin').val();
              
              // pin=  pin.replace(/[^0-9]/g, ''); 
              
              
               if(pin !=''){
                   
                $.post("load_bill_history.php", {pin:pin,type:'authpincheck',set:'pincheck',action:''},
		function(data)
		{  
                    
                    data=$.trim(data);
                    if(data!="NO")
                    {   
                        
                        var spl=data.split('*');
                          
                        var rprntmode = $('#rprntmode').val();
                        
      if(rprntmode=='rprnt'){
                         
      if(spl[1]=='reprint:Y'){ 
                            
                                 
                            var hidbilprint= $('#hidbilprint').val();
                            var billno       =  $('.bill_history_active').attr("billno");
                            
                            var dataString_log ='set_log_reprint_bill=log_reprint_bill&billno_reprint='+billno;
                            
                            $.ajax({
                            type: "POST",
                            url: "printercheck_1.php",
                            data: dataString_log,
                            success: function(data) {

                            }
                            });
                            
                           
                              $.post("print_details.php", {bilno:billno,bill_reprint:'Y',set:'billprint'},
                              function(data)
                              {
                                  
                              data=$.trim(data);
                             
                              $(".loaderror").css("display","block");
                              $(".loaderror").addClass("billgenration_validate");
                              $(".loaderror").text(hidbilprint);
                              $(".loaderror").delay(2000).fadeOut('slow');
                              });
                              
                              
                              $.post("load_bill_history.php", {billno:billno,set:'billdetailsset1'},
                                      function(data)
                                      {
                                            data=$.trim(data);
                                            $('#detailsset1').html(data);
                                      });
                                 
                            $('.closeoneclass2').css('display','none');
                            $('.kotcancel_reason_popup_new').css('display','none');
                            $('.confrmation_overlay').css('display','none');
                            $('#pin').val('');

                }else{
                    
                        $("#pin_error").css("display","block");
			$("#pin_error").text("No Permission !");
			$("#pin_error").delay(2000).fadeOut('slow');
                        $("#pin").val('');
                }
  }
  else if(rprntmode=='chng'){
                               
  if(spl[3]=='change:Y'){ 
                            
                            $("#bill").hide();
                            $("#settlement").show();
                            $('.tax_textbox').find('option:first').attr('selected', 'selected');

                            $('#paymentmode_chge').val('');
                            $('#amountpaid_chge').val('');
                            $('#balance_chge').val('');
                            $('#original_chge').val('');
                            $('#bilno_chge').val('');
                            $('#reasontext_chng').val('');
                            $('#secretkey_chng').val('');
                            $('#stafflist_chnge').val('');
                            $('#transamt_chge').val('');
                            $('#bankname_chge').val('');
                            $('#transbal_chge').val('');
                            $('#paidamount').val();
                            $('#paidamount').val('');
                            $('#transcationid').val('');
                            $('#transbal').val('');
                            $('#paidamount').val('');
                            $('#balanceamout').val('');

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
                            
                            
                    $('.closeoneclass2').css('display','none');
                    $('.kotcancel_reason_popup_new').css('display','none');
                    $('.confrmation_overlay').css('display','none');
                    $('#pin').val(''); 
                            
                   }
                   else{
                       
                        $("#pin_error").css("display","block");
			$("#pin_error").text("No Permission !");
			$("#pin_error").delay(2000).fadeOut('slow');
                        $("#pin").val('');
                   }
   }
   else{
                       
                       
   if($('#kotcancel_reason_popup_new_proceed_btn').hasClass('tip_click')){
                       
                                
                   if(spl[10]=='tip_edit:Y'){
                                
                                    add_tip();
                   }
                   else{
                                    $("#pin_error").css("display","block");
                                    $("#pin_error").text("NO PERMISSION!");
                                    $("#pin_error").delay(2000).fadeOut('slow');
                                    $("#pin").val('');
                    }
                    }else{   
                        
                        
                    if(spl[5]=='billcancel:Y'){
                               
                    $('.closeoneclass2').css('display','none');
                    $('.kotcancel_reason_popup_new').css('display','none');
                    $('.confrmation_overlay').css('display','none');
                    $('#pin').val(''); 
                    
                         var billno       =  $('#hidbilnotosave').val();
                         
                        var slno             =  $('#hidslnotosave').val();
                        var reasontext       =  $('.kotcancel_reason_popup_new_textbox_input').val();
                        var secretkey       =  '';
                        var stafflist       = spl[0];
                       
                       
                     
			 $.post("load_bill_history.php", {billno:billno,slno:slno,reasontext:reasontext,secretkey:secretkey,stafflist:stafflist,set:'set_cancel'},
			  function(data)
			  { //alert(data);
                              
                         $('#billlisttotal').load( "load_bill_history.php?set=billwholeload");
			  var hidbill_cancelled=$("#hidbill_cancelled").val();
			  data=$.trim(data);
			  $(".loaderror").css("display","block");
			  $(".loaderror").addClass("billgenration_validate");
			  $(".loaderror").text(hidbill_cancelled);
			  $(".loaderror").delay(2000).fadeOut('slow');
			  location.reload();

                          
                          
                          
			  $.post("load_bill_history.php", {billno:billno,set:'billdetailsset1'},
				  function(data)
				  {
				  	data=$.trim(data);
				  	$('#detailsset1').html(data);
				  });
			  
			  });
                          
			  $.post("load_bill_history.php", {billno:billno,set:'billdetailsset2'},
						function(data)
						{
						  data=$.trim(data);
						  $('#billdetailsset2').html(data);
						});
                                                
                                                
               
                        }
                                else{
                                    $("#pin_error").css("display","block");
                                    $("#pin_error").text("NO PERMISSION!");
                                    $("#pin_error").delay(2000).fadeOut('slow');
                                    $("#pin").val('');
                                      $("#pin").focus();
                                }
                            }
                        
                        
                    }
                   // $('.closeoneclass2').css('display','none');
                   // $('.kotcancel_reason_popup_new').css('display','none');
                   // $('.confrmation_overlay').css('display','none');
                   // $('#pin').val('');
                    //location.reload();
                    
                    }else{
                        $("#pin_error").css("display","block");
			$("#pin_error").text("CODE NOT REGISTERED!");
			$("#pin_error").delay(2000).fadeOut('slow');
                        $("#pin").val('');
                         $("#pin").focus();
                    }
                });
                
            }else{
                $("#pin_error").css("display","block");
		$("#pin_error").text("ENTER PIN!");
		$("#pin_error").delay(2000).fadeOut('slow');
                $("#pin").val('');
                  $("#pin").focus();
            }
            
            
     });
          
          
          
          
});










    </script> 
    </head>

    <body>
        
    <input type="hidden" id="bill_history_all" value="<?=$_REQUEST['bilno']?>">    
        
        
   <input type="hidden" id="otp_bill_cancel" value="<?=$_SESSION['otp_bill_cancel']?>">
   <input type="hidden" id="otp_login" value="<?=$_SESSION['expodine_id']?>">
   <input type="hidden" id="whatsapp_api_bill" value="<?=$_SESSION['s_sms_bill']?>">
        
        
        <input type="hidden" name="focusedtext1" id="focusedtext1" />
        <input type="hidden" name="decimal" id="decimal" value="<?=$_SESSION['be_decimal']?>">
        <div class="olddiv1 "></div>
        <div class="container-fluid no-padding">
            
        <?php include"includes/topbar.php"; ?>
            
            <div class="middle_container">
                <div style="width:100%" class="top_site_map_cc ">
                    

        <?php include"includes/new_right_menu.php"; ?> 
                    
                    <div class="bill_history_head" style="font-size: 14px ">Dine In <?= $_SESSION['bill_history_billhistory'] ?></div>

                    <a href="<?php if (isset($_SESSION['timeopen']) && !isset($_SESSION['timeclose'])) { ?>table_selection.php  <?php } else { ?>#<?php } ?>"><div class="bill_his_back_btn"><?= $_SESSION['bill_history_backbutton'] ?></div></a>
                    
                        
                    <a href="<?php if (isset($_SESSION['timeopen']) && !isset($_SESSION['timeclose'])) { ?>ta_bill_history.php  <?php } else { ?>#<?php } ?>"><div style="background-image: none;background-color: darkred;color: white;margin-left: 5px " class="bill_his_back_btn">TA BILL HISTOY</div></a>
                    <a href="<?php if (isset($_SESSION['timeopen']) && !isset($_SESSION['timeclose'])) { ?>cs_bill_history.php  <?php } else { ?>#<?php } ?>"><div style="background-image: none;background-color: darkred;color: white;margin-left: 5px " class="bill_his_back_btn">CS BILL HISTOY</div></a>

                    <?php if(isset($_REQUEST['bilno'])) { ?>
                  <a href="total_ta_bill_history.php "><div style="margin-left:10px" class="bill_his_back_btn"> History</div></a>
                  <?php } ?>
                    
                    
                    <div class="top_al_search_cc loaderror" ></div>
                    
                </div>


                <div style="min-height:480px;width:100%" class="left_contant_container">

                    <div class="left_bill_history_contain" style="width:25%">
                        <div class="bill_number_head" style="height:auto;position:relative">
                            <div style="float:left;">
                                <?php
                                $datev = explode("-", $_SESSION['date']);
                                $sesdate = $datev[2] . "-" . $datev[1] . "-" . $datev[0];
                                ?>
                                <input type="hidden" name="datehid" id="datehid" value="<?= $sesdate ?>">
                                <span class="bill_his_fil_nam">Search Date</span>
                                <input type="hidden" name="authchnage" id="authchnage" value="<?= $_SESSION['s_auth_paymentchange'] ?>">
                                <input value="<?= $today ?>" type="text" id="datepicker" name="datepicker" style="color:#333;width:44%;float: left;height: 26px;margin: 4px 0 0 7px;line-height: 27px;border-radius: 4px;border: 0;padding-left: 3px;"onclick="return datefull();"  readonly onChange="datechange()">

                            </div>
                            <input type="hidden" id="dinein" value="D">
                            <a class="updatestock update_billdetails" style="display:block; margin: -23px 0px 0 0;"></a>
                            
                                <div class="bill_history_flt_cc">
                                    
    <select id="arc_year"  style="color:#333;width:20%;float: left;height: 26px;margin: 2px 0 0 1%;line-height: 27px;border-radius: 4px;border: 0;padding-left: 3px;" >
                                 	
    <option value="" >Type  <?php echo $_SESSION['db_type']; ?></option>     
      
    <option value="normal"  <?php if($_SESSION['db_type']=="normal"){ ?> selected="selected" <?php } ?> >Normal Year</option>          
     
    <?php if($_SESSION["archive_enabled"]=='Y'){ ?>
     <option value="archive"  <?php if($_SESSION['db_type']=="archive"){ ?> selected="selected" <?php } ?>  >Archieved Year</option>              
    <?php } ?>                 
                                        
    </select>  
                                    
                                <span style="width:20%;white-space:nowrap;padding-left: 0px;text-align: center" class="bill_his_fil_nam"></span>
                                 <select id="finyear"  style="color:#333;width:23%;float: left;height: 26px;margin: 2px 0 0 1%;line-height: 27px;border-radius: 4px;border: 0;padding-left: 3px;" >
                                 	
                                <?php
                                $sql_login_yr =  $database->mysqlQuery("select ys_fin_year,ys_fin_year_current from tbl_yearsettings"); 
				$num_login_yr   = $database->mysqlNumRows($sql_login_yr);
				if($num_login_yr){
					while($result_login_yr  = $database->mysqlFetchArray($sql_login_yr)) 
					  {
                                            $finyear=$result_login_yr['ys_fin_year'];
                                            $selfinyear=$result_login_yr['ys_fin_year_current'];
                                            
					  ?>
                                                            
        <option value="<?=$finyear?>" <?php if($selfinyear=="Y"){ ?> selected="selected" <?php } ?>><?=$finyear?></option>
                     
      <?php } } ?>
                                         
  </select>
                                
                                
         
                                
     <input placeholder="Billno" readonly onclick="this.removeAttribute('readonly');"  type="text" name="billsearch1" id="billsearch1" onKeyPress="billSearch()" onKeyDown="billSearch()" onKeyUp="billSearch()" style="color:#333;width:25%;float: left;height: 26px;margin: 2px 0 0 1%;line-height: 27px;border-radius: 4px;border: 0;padding-left: 3px;" >
    
               
     <select onchange="billSearch()" style="color:#333;width:25%;float: left;height: 26px;margin: 2px 0 0 1%;line-height: 27px;border-radius: 4px;border: 0;padding-left: 3px;"  id="paymode_search"  >
                                 	
     <option value="" >ALL</option>     
      
     <?php
      
        $sql_listall  =  $database->mysqlQuery("SELECT pym_id,pym_name from  tbl_paymentmode where pym_active='Y'  "); 
	$num_listall  = $database->mysqlNumRows($sql_listall);
	if($num_listall){ $i=1;
	 while($row_listall  = $database->mysqlFetchArray($sql_listall)) 
	 {
         ?>
   
     <option value="<?=$row_listall['pym_id']?>" ><?=$row_listall['pym_name']?></option>     
       
     <?php } } ?>
   
   </select>    
     
     
    </div>
     </div>
                            
                        <div class="bill_history_details_table" >  
                            <table style="width:100%">
                                <tr>
                                    <th width="15%"><?= $_SESSION['bill_history_slno'] ?></th>
                                    <th width="40%"><?= $_SESSION['bill_history_billno'] ?></th>
                                    <th width="25%">Status</th>
                                     <th width="25%">Type</th>
                                </tr>
                            </table>  
                            <div id="billlisttotal">
                                <table width="100%" class=" " border="0"> <!----bill_history_active--->
                                    <?php
                                   
                                    $sql_bilhis = "select bm_paymode,bm_bill_is_split,bm_billno,bm_status,bm_dayclosedate  from tbl_tablebillmaster "
                                    . " WHERE bm_dayclosedate='" . $_SESSION['date'] . "' AND bm_status != '' ORDER BY bm_billdate,bm_billtime"
                                    . " DESC";
                                    $sql_bilhistory = $database->mysqlQuery($sql_bilhis);
                                    $num_bilhistory = $database->mysqlNumRows($sql_bilhistory);
                                    if ($num_bilhistory) {
                                        $i = 1;
                                        while ($result_bilhistory = $database->mysqlFetchArray($sql_bilhistory)) {
                                            
                                               $cur_date= $_SESSION['date'];
                                            ?>
                                    
                                            <tr class="bill_history_number <?php if ($result_bilhistory['bm_status'] == 'Cancelled') { ?> bill_history_cancel <?php } ?> <?php if($result_bilhistory['bm_billno']==$_REQUEST['bilno']){ ?> bill_history_active <?php } ?>" cur_date="<?=$cur_date?>" billdate="<?= $result_bilhistory['bm_dayclosedate'] ?>" user="<?= $_SESSION['designtnname']?>" billno="<?= $result_bilhistory['bm_billno'] ?>"   cancelkey="<?= $result_bilhistory['bm_status'] ?>"  split_check="<?=$result_bilhistory['bm_bill_is_split']?>"   >
                                                <td width="15%"><strong><?= $i++ ?></strong></td>
                                                <td width="40%"><?= $result_bilhistory['bm_billno'] ?></td>
                                                
                                                <?php if($result_bilhistory['bm_status']=='Closed'){ ?>
                                                <td style="padding:2px"  width="25%">
                                                    <span class="closed_1">
                                                    <?=$result_bilhistory['bm_status']?>
                                                    </span>      
                                                        
                                                </td>
                                                <?php }else{ ?>
                                                  <td width="25%"><?= $result_bilhistory['bm_status'] ?></td>
                                                <?php } ?>
                                                
        <?php
        
        $paymode='';
        $sql_listall  =  $database->mysqlQuery("SELECT pym_id,pym_name from tbl_paymentmode where pym_id='". $result_bilhistory['bm_paymode']."' "); 
	$num_listall  = $database->mysqlNumRows($sql_listall);
	if($num_listall){ 
	 while($row_listall  = $database->mysqlFetchArray($sql_listall)) 
	 {
             if($row_listall['pym_name']=='Credit / Debit'){
                  $paymode='Card';
             }else if($row_listall['pym_name']=='Complimentary'){
                 $paymode='Complimentary';   
             }else if($row_listall['pym_name']=='Credit Types'){
                 $paymode='Credit';     
             }else{
                 $paymode=$row_listall['pym_name']; 
             }
            
       
        } } ?>
                                                
                        <td width="25%"> <?= $paymode ?></td>
                                                                 
                        </tr>
                        
                        <?php } } ?>

                        </table> 
                        </div>
                        </div>

                    </div>

                    <div class="bill_history_center_bill" style="position:relative;">
                        
                        <div class="bill_number_head">
                                    
                            <span style="margin-left: -130px;"> <?= $_SESSION['bill_history_order_details'] ?> </span>         
                        
                        <div class="col-xs-1 no-padding"  style="width:20%" >
                            <a href="#" id="a4_view"  onclick="return a4_view();"><span style="margin-top:3px;height: 24px;margin-left: 3px;background-color: #205a58"  class="history-sub-btn">A4 | PDF</span></a>
		        </div>
                            
                        <div class="col-xs-1 no-padding"  style="width:20%" >
                            <a href="#" id="whatsapp_view"  onclick="return whatsapp_view();"><span style="margin-top:3px;height: 24px;margin-left: 3px;background-color: #205a58"  class="history-sub-btn">SHARE</span></a>
		        </div>    
                        
                        </div>

                        <div class="settle_ment_change_history" id="detailsset1" >
                      
                        </div><!--settle_ment_change_history-->	
                        
    
    
    
    <div class="container">
    <div class="bill_his_buton_cc" style="left: 0">
        
                                    <?php
                            
                                    $sql_bihis_reprint = "select ser_bill_reprint_per,ser_bill_settle_change_per,ser_bill_cancel_permission FROM "
                                    . " tbl_staffmaster  left join tbl_logindetails on ls_staffid = ser_staffid where "
                                    . " ls_username='".$_SESSION['expodine_id']."'";
                                    $sql_bihis_reprint = $database->mysqlQuery($sql_bihis_reprint);
                                    $num_bihis_reprint = $database->mysqlNumRows($sql_bihis_reprint);
                                    if ($num_bihis_reprint) {
                                       
                                        $result_bihis_reprint = $database->mysqlFetchArray($sql_bihis_reprint);
                                        $reprint_per=$result_bihis_reprint['ser_bill_reprint_per'];
                                        $paymode_change_per=$result_bihis_reprint['ser_bill_settle_change_per'];
                                        $bill_cancel_per=$result_bihis_reprint['ser_bill_cancel_permission'];
                                    }
                                    
                                    if($paymode_change_per == "Y" ){ ?>
        
                                        <div style="right:2%;background-image: none" class="bill_cancel_btn changesetledetils" ><a href="#">Payment Change</a></div>
                                    <?php  } 
                                    
                                    if($reprint_per == "Y" ){ ?>
                                        
                                        <div  style="right:12px;" class="bill_cancel_btn" id="reprintbill"><a href="#">Bill <?= $_SESSION['bill_history_reprintbutton'] ?></a></div>
                                    <?php } 
                                    
                                    if($bill_cancel_per == "Y" ){ ?>
                                        
                                        <div style="right:2%;background-image:url(img/cancel_bill.png);" class="bill_cancel_btn" id="cancelbill"><a href="#">Bill <?= $_SESSION['bill_history_cancelbutton']?></a></div>
                                    <?php } ?>
                     
                        </div>
                    </div>
 

                    </div>

                    <div id="bill" class="bill_history_right_detail" style="width:31.5%">
                        
                    </div>


                    <div id="settlement" class="bill_history_right_detail" style="display:none;position:relative;width: 31.5%">

                        <div class="bill_number_head"><?= $_SESSION['bill_history_change_settlement'] ?> <div style="background-color:transparent;text-align: right;height:25px;margin-top:-4px;" class="pay_change_button close_settle"><img src="img/close_ico.png"></div></div>

                        <div class="bill_history_details_table" >

                            <div class="take_staff_view_cont_cc">
                                <div class="payment_pend_right_cash_head" >
                                    <div  style="display:none"class="payment_pend_right_cash_head_txt"><?= $_SESSION['bill_history_cash_settle'] ?></div>
                                    <div class="payment_pend_right_cash_error"></div>
                                </div>

                                <div style="border-bottom:1px #ccc solid;height:48px;margin-top:0;" class="discount_text_box paymentclose">
                                    <table class="tax_table" width="100%" border="0" cellspacing="5">
                                        <tbody>
                                            <tr>
                                                <td width="45%"><?= $_SESSION['bill_history_select_payment'] ?></td>
                                                <td width="5%">:</td>
                                                <td width="50%">
                                                    <select style="width:100%;" class="discount_text_box tax_textbox pay_method_check"  id="payemntmode_sel">
                                                       
                                                        <?php
                                                        $sql_ds_nos = "select * from tbl_paymentmode WHERE pym_changesettled_view='Y'";
                                                        $sql_ds = $database->mysqlQuery($sql_ds_nos);
                                                        $num_ds = $database->mysqlNumRows($sql_ds);
                                                        if ($num_ds) {
                                                            $i = 1;
                                                            while ($result_ds = $database->mysqlFetchArray($sql_ds)) {
                                                                ?>
                                                        
                <option  value="<?= $result_ds['pym_id'] ?>" idval="<?= $result_ds['pym_id'] ?>" <?php if ($i == 1) { ?> selected <?php } ?> ><?= $result_ds['pym_name']//$result_ds['pym_name'] ?></option>
            
                <?php $i++; } } ?>
                                            </select>
                                            </td>
                                            </tr>

                                    </tbody>
                                    </table>
                                </div><!--discount_tax_textbox-->
                                <div class="credit_cc_normal" style="display: none;">
                                    <div class="discount_text_cc crd_head"><?= $_SESSION['bill_history_cardtitle'] ?></div>
                                    <table class="tax_table" width="100%" border="0" cellspacing="5">
                                        <tbody>
                                            <tr>
                                                <td width="35%" style="display: none;"><?= $_SESSION['bill_history_change_trans_bank'] ?></td>
                                                <td width="5%" style="display: none;">:</td>
                                                <td width="50%" style="display: none;"><div class="discount_text_box paymod_text_box">
                                                        <select id="bankdetails" class=" discount_text_box tax_textbox">
                                                            
                                                            <?php
                                                            $sql_ds_nos = "select * from tbl_bankmaster where bm_active='Y' ";
                                                            $sql_ds = $database->mysqlQuery($sql_ds_nos);
                                                            $num_ds = $database->mysqlNumRows($sql_ds);
                                                            if ($num_ds) {
                                                                while ($result_ds = $database->mysqlFetchArray($sql_ds)) {
                                                                    ?>    
                                                                 <option value="<?= $result_ds['bm_id'] ?>"><?= $result_ds['bm_name']//$result_ds['bm_name'] ?></option>
                                                                <?php }
                                                            } 
                                                            
                                                            
                                                        $sql_loginon  =  $database->mysqlQuery("select * from tbl_branchmaster"); 
                                                        $num_loginon  = $database->mysqlNumRows($sql_loginon);
                                                        if($num_loginon){
                                                           while($result_loginon  = $database->mysqlFetchArray($sql_loginon)) 
                                                         {

                                                               $multion=$result_loginon['be_multicard'];
                                                        } }  
                                                            
                                                            
                                           ?>
                                           </select>
                                           </div></td>
                                           </tr>
                                            
                                              
                                             <div class="card_detail_popup_contant cardadder" style="padding: 1px;" id="cardadderid">
                                    <div class="card_detail_popup_list_head">
                                        <div class="card_detail_popup_type" style="width:30%;margin-right:1%;display: none">
                                            <div class="card_detail_popup_type_text">Card Type</div>
                                         </div>  
                                         <div class="card_detail_popup_type" style="width:33%">
                                            <div class="card_detail_popup_type_text"> Card Last 4 Digits</div>
                                          </div> 
                                          <div class="card_detail_popup_type" style="width:18%;margin-left:1%">
                                            <div class="card_detail_popup_type_text">Amount</div>
                                         </div> 
                                         <div class="card_detail_popup_type" style="width:18%;margin-left:1%">
                                            <div class="card_detail_popup_type_text">To Bank</div>
                                         </div> 
                                            
                                    </div>
                                   <div id="newref">
                                    <div class="card_detail_popup_list" style="margin-bottom:3px"  id="card_detail_popup_list">
                                        <div class="card_detail_popup_type" style="width:30%;margin-right:1%;display: none">
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
                                            <input type="text" class="card_type_dropdwn amountall" id="multi_cardamount" value="" name="multi_cardamount" onkeypress="return enter_plus(event);" onkeyup="return cardsum()" onclick="return cardsum()" onchange="return cardsum()" autocomplete="off">
                                        </div>
                                       
                                        <div class="card_detail_popup_type" style="width:30%;margin-right:1%;">
                                            <select class="card_type_dropdwn bankselect_new" id="multibanktype" >
                                        
                                                  <?php
                                                $sql_rsn1 = "select * from tbl_bankmaster where bm_active = 'Y'";
                                                $sql_rsns1 = $database->mysqlQuery($sql_rsn1);
                                                $num_rsns1 = $database->mysqlNumRows($sql_rsns1);
                                                if ($num_rsns1) {
                                                    while ($result_rsns1 = $database->mysqlFetchArray($sql_rsns1)) {
                                                            ?>
                                                 
                                                      <option value="<?= $result_rsns1['bm_id']?>"><?= $result_rsns1['bm_name']?></option>
                                                                     <?php  }}?>
                                             </select>
                                        </div>
                                        
<!--                                        <div style="margin-top:0px;width: 12%;height: 34px;margin-top: -1px;float: right"  class="menut_add_bq_btn " onclick="return del();">-</div>-->
                                        
                                    </div>
                               </div>     
                          <input type="hidden" value="" id="countload">
                               
                <div style="margin-top:0px;width: 12%;height: 34px;margin-top: -40px;float: right" class="menut_add_bq_btn plusbtn" onclick="return plus();">+</div>     
                        
                                </div>
                                                <tr>
                                                <td width="35%"><?= $_SESSION['bill_history_change_trans_amount'] ?></td>
                                                <td width="5%">:</td>
                                                <td width="50%"> <div class="discount_text_box paymod_text_box trrefresh">
                                                        
                                                        
                                                        <?php
                                                   $sql_rsnrate4 = "select sum(mc_cardamount) as totamount from tbl_bill_card_payments where (mc_billno = 'temp_".$_SESSION['billcardbh']."' or mc_billno = '".$_SESSION['billcardbh']."')   ";
                                           //echo "select sum(mc_cardamount) as totamount from tbl_bill_card_payments where mc_billno = '".$_SESSION['billcard16bhd']."'";
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
                                                  
                                                    
                                                    
                                                     $sql_rsnrate74 = " select bm_finaltotal from tbl_tablebillmaster where bm_billno = '".$_SESSION['billcardbh']."'";
                                           //echo "select sum(mc_cardamount) as totamount from tbl_bill_card_payments where mc_billno = '".$_SESSION['billcard16bhd']."'";
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
                                                        
                                                        
                                                        
                                                        <input  placeholder="<?= $_SESSION['bill_history_placeholder_trans_amount'] ?>" class="tax_textbox transa_txt" value="<?=number_format($totalcardbill4,$_SESSION['be_decimal'])?>" name="transcationid" id="transcationid" onkeyup="transebalnce()" onchange="transebalnce()"  onclick="transebalnce()"  onfocus="transebalnce()"   readonly  >
                                                    </div></td>
                                            </tr>
                                            <tr>
                                                <td width="45%"><?= $_SESSION['bill_history_balancetopay'] ?></td>
                                                <td width="5%">:</td>
                                                <td width="50%"><div class="discount_text_box paymod_text_box trrefresh1">

                                                        <input  placeholder="<?= $_SESSION['bill_history_placeholder_balance'] ?>" value="<?=$totalcardbill74?>" class="tax_textbox transa_txt" name="transbal" id="transbal" readonly>
                                                    </div></td>
                                            </tr>
                                          
                                        </tbody></table> 	
                                </div><!--credit_cc_normal-->

                                <div class="coupon_cc" style="display: none;">
                                    <div class="discount_text_cc crd_head">Coupons</div>
                                    <table class="tax_table" width="100%" border="0" cellspacing="5">
                                        <tbody><tr>
                                                <td width="45%">Coupon Name</td>
                                                <td width="5%">:</td>
                                                <td width="50%"><div class="discount_text_box paymod_text_box">
                                                        <select id="menu05" class="discount_text_box tax_textbox">
                                                            <option value="">Coupon Name</option>

                                                            <?php
                                                            //`tbl_couponcompany`(`cy_companyname`, `cy_active`, `cy_startdate`)
                                                            $sql_ds_nos = "select * from tbl_couponcompany where cy_active='Yes' and cy_startdate <= '" . $_SESSION['date'] . "' ";
                                                            $sql_ds = $database->mysqlQuery($sql_ds_nos);
                                                            $num_ds = $database->mysqlNumRows($sql_ds);
                                                            if ($num_ds) {
                                                                while ($result_ds = $database->mysqlFetchArray($sql_ds)) {
                                                                    ?>    

                                                                    <option value="<?= $result_ds['cy_companyname'] ?>"><?= $result_ds['cy_companyname'] ?></option>

    <?php }
} ?>
                                                        </select>
                                                    </div></td>
                                            </tr>
                                            <tr>
                                                <td width="45%">Coupon Amount</td>
                                                <td width="5%">:</td>
                                                <td width="50%"><div class="discount_text_box paymod_text_box">
                                                        <input  placeholder="Enter Coupon Amount" class="tax_textbox transa_txt" name="coupamount" id="coupamount" onChange="couponamountchange()">
                                                    </div></td> 
                                            </tr>
                                            <tr>
                                                <td width="45%">Balance to Pay</td>
                                                <td width="5%">:</td>
                                                <td width="50%"><div class="discount_text_box paymod_text_box">
                                                        <input  placeholder="Balance" class="tax_textbox transa_txt" name="coupbal" id="coupbal" readonly>
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
                                                        <input  placeholder="Enter Voucher ID" class="tax_textbox transa_txt" name="vouchid" id="vouchid" >
                                                    </div></td>
                                            </tr>
                                            <tr>
                                                <td width="45%">Voucher Amount</td>
                                                <td width="5%">:</td>
                                                <td width="50%"><div class="discount_text_box paymod_text_box">
                                                        <input  placeholder="Voucher Amount" class="tax_textbox transa_txt" name="vocamount" id="vocamount" readonly >
                                                    </div></td> 
                                            </tr>
                                            <tr>
                                                <td width="45%">Balance to Pay</td>
                                                <td width="5%">:</td>
                                                <td width="50%"><div class="discount_text_box paymod_text_box">
                                                        <input  placeholder="Balance" class="tax_textbox transa_txt" name="vouchbal" id="vouchbal" readonly>
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
                                                        <input  placeholder="Enter Cheque No" class="tax_textbox transa_txt"  name="cheqname" id="cheqname">
                                                    </div></td>
                                            </tr>
                                            <tr>
                                                <td width="45%">Bank Name</td>
                                                <td width="5%">:</td>
                                                <td width="50%"><div class="discount_text_box paymod_text_box">
                                                        <input  placeholder="Enter Bank Name" class="tax_textbox transa_txt" name="cheqbank" id="cheqbank">
                                                    </div></td>
                                            </tr>
                                            <tr>
                                                <td width="45%">Amount</td>
                                                <td width="5%">:</td>
                                                <td width="50%"><div class="discount_text_box paymod_text_box">
                                                        <input  placeholder="Enter Cheque Amount" class="tax_textbox transa_txt" name="cheqamount" id="cheqamount" onChange="cheqamountchange()">
                                                    </div></td>
                                            </tr>
                                            <tr>
                                                <td width="45%">Balance to Pay</td>
                                                <td width="5%">:</td>
                                                <td width="50%"><div class="discount_text_box paymod_text_box">
                                                        <input  placeholder="Balance" class="tax_textbox transa_txt" name="cheqbal" id="cheqbal" readonly>
                                                    </div></td>
                                            </tr>
                                        </tbody></table> 	
                                </div><!--cheque_cc-->


                                <!--credit_ccc-->


                                <div style="display:none" class="complimentrary_cc auto1" >
                                    <div class="discount_text_cc crd_head">Complimentary</div>
                                    <textarea placeholder="Enter Complimentary"  class="room_textarea" name="completext" id="completext"></textarea>
                                </div><!--complimentrary_cc-->


                                <div style="display:none" class="complimentrary_management " >
                                    <div class="discount_text_cc crd_head">Complimentary Management</div>


                                    <div class="crd_select_head_cc">
                                        <span style="width: 20%" class="room_no_txt">Staff :</span>
                                        <span style="width: 78%;float: left" class="room_text_box_cc">
                                            <select  class="staff_menu_select" name="selectstafcomp" id="selectstafcomp">
                                                <option value="">Select</option>
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




                                    <textarea placeholder="Enter Complimentary"  class="room_textarea" name="completext_mng" id="completext_mng"></textarea>
                                </div><!--complimentrary_cc-->

                                <!--<div style="display:none;" class="complimentrary_cc auto1" >-->



                                <div class="paid_amount_cc" style="display:block">
                                    <!--<div class="discount_text_cc crd_head">Cash</div>-->
                                    <table class="tax_table" width="100%" border="0" cellspacing="5">
                                        <tbody>
                                            <tr>
                                                <td width="45%"><?= $_SESSION['bill_history_change_ammountpaid'] ?></td>
                                                <td width="5%">:</td>
                                                <td width="50%"><div class="discount_text_box paymod_text_box">
                                                        <input style="width:100%;border: solid 1px #ccc;border-radius: 4px;height:30px"  placeholder="<?= $_SESSION['bill_history_placeholder_enter_paidamount'] ?>" class=" transa_txt" id="paidamount" name="paidamount" onkeyup="enterbalance();" onChange="enterbalance()" value="0" autocomplete="off">
                                                    </div></td>
                                            </tr>
                                            <tr>
                                                <td width="45%"><?= $_SESSION['bill_history_change_balanceamount'] ?></td>
                                                <td width="5%">:</td>
                                                <td width="50%"><div class="discount_text_box paymod_text_box">
                                                        <input  placeholder="<?= $_SESSION['bill_history_placeholder_balance_amount'] ?>" class="tax_textbox transa_txt" id="balanceamout" name="balanceamout" value="0" readonly>
                                                    </div></td>
                                            </tr>
                                        </tbody>
                                    </table> 

                                </div><!--paid_amount_cc-->

                                <div class="paid_amount_cc_credit" style="display: none;">
                                      
                                       <div class="selecting_payment_cc" >
                                        <div class="selecting_payment_one">
                                            <div class="lable_counter_paymnet_cc counter_right_lable"><?=$_SESSION['payment_pending_credit_amount']?></div>
                                            <!--<input placeholder="Paid Amoun" class="tax_textbox transa_txt counter_text_box">-->
                                            <input  placeholder="<?=$_SESSION['payment_pending_palceholder_credit_enteramount']?>" class="tax_textbox transa_txt counter_text_box" id="paidamount_credit" name="paidamount_credit" maxlength="12" onChange="enterbalance_credit()"  onfocus="enterbalance_credit(event)"  onclick="enterbalance_credit(event)"  onkeyup="enterbalance_credit(event)" value="">
                                        </div>
                                     </div><!--selecting_payment_cc-->
                                      <div class="selecting_payment_cc" style="display: none;" >
                                        <div class="selecting_payment_one" style="margin-bottom:5px;">
                                            <div class="lable_counter_paymnet_cc counter_right_lable"><?=$_SESSION['payment_pending_credit_balance']?></div>
                                           <!-- <input placeholder="Balance" class="tax_textbox transa_txt counter_text_box">-->
                                            <input  placeholder="<?=$_SESSION['payment_pending_palceholder_creditbalance_amount']?>" class="tax_textbox transa_txt counter_text_box" id="balanceamout_credit" name="balanceamout_credit" value="" readonly>
                                        </div>
                                     </div><!--selecting_payment_cc-->
                                  
                                  </div><!--paid_amount_cc_credit-->
                                  
                                         <div class="credit_type" style="display: none;">
                                             <div class="discount_text_cc crd_head" style="display:none"><?=$_SESSION['payment_pending_credit_title']?></div>
                                        <div class="selecting_payment_cc">
                                        <div class="selecting_payment_one">
                                            <div class="lable_counter_paymnet_cc counter_right_lable">Select Type</div>
                                           
                                                 <select  class="staff_menu_select counter_text_box tax_textbox" name="selectcreditypes" id="selectcreditypes" >
                                            <option value=""><?=$_SESSION['payment_pending_credit_selectlist']?></option>
                                        <?php
                                       
                                        $sql_ds_nos = "select * from tbl_credit_types where ct_active='Y' ";
                                        $sql_ds = $database->mysqlQuery($sql_ds_nos);
                                        $num_ds = $database->mysqlNumRows($sql_ds);
                                        if ($num_ds) {
                                            while ($result_ds = $database->mysqlFetchArray($sql_ds)) {
                                                ?>    

                                       <option  value="<?= $result_ds['ct_creditid'] ?>" label="<?=$result_ds['ct_labels']?>"><?=$result_ds['ct_credit_type']// $result_ds['ct_credit_type'] ?></option>

                                                <?php }
                                            } ?>                            
                                        </select>
                                        </div>
                                     </div>
                                     
                                      <div class="crd_select_head_cc credtitypeloads" id="crtype_div">
                                      
                                      </div>
                                      
                                      <textarea  style="display:none" class="credit_remarks_cc" id="credit_remark_cs" name="credit_remark_cs" placeholder="Remarks"></textarea>
                                		
                                </div>
                                  
                                  
                                 <div class="comp_cc" style="display: none;">
                                      
                                       <div class="selecting_payment_cc">
                                        <div class="selecting_payment_one">
                                            <div class="lable_counter_paymnet_cc counter_right_lable">Complimentary Remarks</div>
                                           
                                            <input  placeholder="Remarks" class="tax_textbox transa_txt counter_text_box" id="comp_remarks" name="comp_remarks" value="">
                                        </div>
                                     </div><!--selecting_payment_cc-->
                                     
                                  
                                  </div> 
                                  
                                  
                                  
                            </div><!--bill_history_details_table-->

                        </div><!--bill_history_right_detail-->

                        <div class="take_staff_view_cont_bottom_contain">
                            <a href="#" class="closetranscationshis" style="display: block;"><div class="bill_print_btn">Submit</div></a>
                        </div>    	


                    </div><!--left_contant_container-->



                </div>



            </div><!--middle_container-->          
        </div><!--container_fluide-->

  

        <!----dock----> 
<?php //include "includes/top_main_menu.php";  ?>
        <!----dock----> 


        <!-- ************************************************* manage popup starts  ************************************************** -->
        <div style="position:fixed;width:100%;left:30%;top:7%;z-index:99999;" class="mynewpopupload1"  ></div>
        <!-- ************************************************* manage popup ends  ******************************************************* -->  

        <div style="display:none;height: auto;bottom: auto;top: 30%;width:350px;" class="index_popup_1 closeoneclass">
            <h3 class="sm_pop_head"><?=$_SESSION['bill_history_popup_message']?></h3>
            <div class="index_popup_contant"><?=$_SESSION['bill_history_popup_cancelbill_error']?></div>
            <div style="height:40px;" class="index_popup_contant">
                <div  style="width: 20%;"  class="btn_index_popup"><a href="#" class="closeok"><?=$_SESSION['bill_history_popup_yesbutton']?></a></div>
                <div  style="width: 20%;" class="btn_index_popup"><a href="#" class="closecancel"><?=$_SESSION['bill_history_popup_nobutton']?></a></div>
            </div>
        </div><!--index_popup_2-->
        <input type="hidden" name="hiddauthcancel" id="hiddauthcancel" value="<?=$_SESSION['be_bill_cancel_auth']?>" >
        <input type="hidden" name="hidbilnotosave" id="hidbilnotosave">
        <input type="hidden" name="hidslnotosave" id="hidslnotosave">
        <input type="hidden" name="reprint_with_permission" id="reprint_with_permission" value="<?=$_SESSION['s_reprint_with_permission']?>" />
        <input type="hidden" name="authorise_with_code" id="authorise_with_code" value="<?=$_SESSION['s_auth_paymentchange']?>" />
        <input type="hidden" name="rprntmode" id="rprntmode" value="">
        <div style="display:none;height: auto;bottom: auto;top: 30%;width:350px;"class="index_popup_1 closeoneclass2">
            <h3 class="sm_pop_head"><?=$_SESSION['bill_history_popup_message']?></h3>
            <div class="index_popup_contant"><?=$_SESSION['bill_history_popup_cancelitem_error']?></div><!--index_popup_contant textcontent-->
            <div style="height:40px;" class="index_popup_contant">
                <div style="width: 20%;" class="btn_index_popup"><a href="#" class="closeoksubmit"><?=$_SESSION['bill_history_popup_yesbutton']?></a></div>
                <div style="width: 20%;" class="btn_index_popup"><a href="#" class="closecancel2"><?=$_SESSION['bill_history_popup_nobutton']?></a></div>
            </div>      
        </div><!--index_popup_2-->
<?php include 'includes/authcode_popup_bill hist.php'; ?>
        <div style="display:none;height: auto;bottom: auto;top: 30%;width:500px;" class="index_popup_2 closeoneclass3">
            <div class="index_popup_contant textcontent"><h3 class="sm_pop_head"><?=$_SESSION['bill_history_popup_cancellation']?>
                    <div style="width: 35%;height: 30px;float: right;"><span style="color:#F00;font-size:15px; text-align:center !important;display:none" id="deatilserror"></span></div>
                </h3></div>

            <div class="index_popup_contant contenttext" style="display:inline-block;margin-left:5%;text-align:left;width:100%;height:auto">
                <span style="line-height: 40px;width:26%;float:left" id="rsntxt"><?=$_SESSION['bill_history_popup_reason']?></span><div style="background-color: #fff !important;width: 60%;height:auto;    margin-bottom: 15px;" id="reasontext_div" class="btn_index_popup"><input type="text" class="popup_conform_his" style="" name="reasontext" id="reasontext"></div><br>
                <span style="line-height: 40px;width:26%;float:left"><?=$_SESSION['bill_history_popup_staffname']?></span><div style="background-color: #fff !important;width: 60%;height:auto;" class="btn_index_popup" >
                    <select style="float: left;width: 51%;" class="popup_conform_his"  id="stafflist" name="stafflist" >
                        <option value="null" default><?=$_SESSION['bill_history_popup_select_staff']?></option>
                        <?php
                        $sql_login = $database->mysqlQuery("select * from tbl_staffmaster WHERE ser_cancelpermission='Y' AND ser_employeestatus='Active'");
                        $num_login = $database->mysqlNumRows($sql_login);
                        if ($num_login) {
                            while ($result_login = $database->mysqlFetchArray($sql_login)) {
                                
                                //$staffid=  trim(json_encode($result_login['ser_staffid']),'""');
                                $stfname = $result_login['ser_firstname'] . " " . $result_login['ser_lastname'];
//                                $fpstaff=fopen($apilink."/src/main_menu_display.php?set=staff_ordertake&staffid=$staffid&dat=$other_lang","r");
//                                //echo $apilink."/src/main_menu_display.php?set=staff_ordertake&dat=$other_lang";
//                                $response_staff['messages'] = stream_get_contents($fpstaff);
//                                var_dump($response_staff['messages']);
//                                $resu_staff= json_decode($response_staff['messages'],true);
//                                //var_dump($resu_staff['staff_id'][0]);
//                                $staff_count=count($resu_staff['staff_id']);
                                
                                ?>
                                <option class="popup_conform_his" value="<?= $result_login['ser_staffid'] ?>" cancelkey="<?= $result_login['ser_cancelwithkey'] ?>"><?=$stfname// $result_login['ser_firstname'] ?></option>
    <?php }
} ?>	
                    </select>
                    <div style="margin-top:0px !important;" class="btn_index_popup_send otp_gent_btn"><a href="#" class="sendotp"><?=$_SESSION['bill_history_popup_send_otpbutton']?></a></div>

                </div><br>
                <span style="line-height: 40px;width:26%;float:left"><?=$_SESSION['bill_history_popup_enter_password']?> <span id="typeentery"> </span></span><div style="background-color: #fff !important;width: 60%;" class="btn_index_popup"><input class="popup_conform_his" style="float: left;" type="password" name="secretkey" id="secretkey"></div>
            </div>   
            <div class="index_popup_contant" style="margin-top:-6px;height: 40px;">
                <div style="width: 95px;" class="btn_index_popup"><a href="#" class="closeok2"><?=$_SESSION['bill_history_popup_submitbutton']?></a></div>
                <div style="width: 95px;" class="btn_index_popup"><a href="#" class="closecancel2"><?=$_SESSION['bill_history_popup_cancel']?></a></div>
            </div>      
        </div><!--index_popup_2-->

        <div style="display:none;height: auto;bottom: auto;top: 30%;width:500px;" class="index_popup_2 loadauthdetails">
            <div class="index_popup_contant textcontent"><h3 class="sm_pop_head"><?=$_SESSION['payment_pending_pop_authori']?>
                    <div style="width: 35%;height: 30px;float: right;"><span style="color:#F00;font-size:15px; text-align:center !important;display:none" id="deatilserror_2"></span></div>
                </h3></div>

            <div class="index_popup_contant contenttext" style="display:inline-block;margin-left:5%;text-align:left;width:100%;height:auto">
                <span style="line-height: 40px;width:26%;float:left"><?=$_SESSION['bill_history_popup_reason']?></span><div style="background-color: #fff !important;width: 60%;height:auto;    margin-bottom: 15px;" class="btn_index_popup"><input type="text" class="popup_conform_his" style="" name="reasontext_chng" id="reasontext_chng"></div><br>
                <span style="line-height: 40px;width:26%;float:left"><?=$_SESSION['bill_history_popup_staffname']?></span><div style="background-color: #fff !important;width: 60%;height:auto;" class="btn_index_popup" >
                    <select style="float: left;width: 51%;" class="popup_conform_his"  id="stafflist_chnge" name="stafflist_chnge" >
                        <option value="null" default><?=$_SESSION['bill_history_popup_select_staff']?></option>
                        <?php
                        $sql_login = $database->mysqlQuery("select * from tbl_staffmaster WHERE ser_cancelpermission='Y' AND ser_employeestatus='Active'");
                        $num_login = $database->mysqlNumRows($sql_login);
                        if ($num_login) {
                            while ($result_login = $database->mysqlFetchArray($sql_login)) {
                                ?>
                                <option class="popup_conform_his" value="<?= $result_login['ser_staffid'] ?>" cancelkey="<?= $result_login['ser_cancelwithkey'] ?>"><?= $result_login['ser_firstname'].' '.$result_login['ser_lastname']// $result_login['ser_firstname'] ?></option>
    <?php }
} ?>	
                    </select>
                    <div style="margin-top:0px !important;" class="btn_index_popup_send otp_gent_btn"><a href="#" class="sendotp_chg"><?=$_SESSION['bill_history_popup_send_otpbutton']?></a></div>

                </div><br>
                <span style="line-height: 40px;width:26%;float:left"><?=$_SESSION['bill_history_popup_enter_password']?> <span id="typeentery"> </span></span><div style="background-color: #fff !important;width: 60%;" class="btn_index_popup"><input class="popup_conform_his" style="float: left;" type="password" name="secretkey_chng" id="secretkey_chng"></div>
            </div>   
            <div class="index_popup_contant" style="margin-top:-6px;height: 40px;">
                <div style="width: 95px;" class="btn_index_popup"><a href="#" class="authcahngepayment"><?=$_SESSION['bill_history_popup_submitbutton']?></a></div>
                <div style="width: 95px;" class="btn_index_popup"><a href="#" class="closeregnpopup"><?=$_SESSION['bill_history_popup_cancel']?></a></div>
            </div>      
        </div> 

        <div style="display:none" class="confrmation_overlay"></div>






    <div class="main_logout_popup_cc common_popup_all" style="display:none">
        <div class="main_logout_popup">
                <div>
                <h1 class="logout_contant_txt" style="margin-bottom: 30px;font-size: 18px !important;">CONFIRM REPLACE ?</h1>
                
                <div class="btn_logout_yes_no" style="background-color: #fff;  border: solid 2px #AB2426;  position: relative;  top: 2px;"><a onclick="$('.common_popup_all').hide();" style="color:#AB2426 !important" href="#" class="">NO</a></div>
                <div class="btn_logout_yes_no"><a onclick="return replace_bill_item_click();" href="#" class="">YES</a></div>
            </div>
       </div>
     </div>









<input type="hidden" name="hidenterpaswd" id="hidenterpaswd" value="<?=$_SESSION['completed_order_popup_password']?>">
<input type="hidden" name="hidenterotp" id="hidenterotp" value="<?=$_SESSION['completed_order_popup_otp']?>">
<input type="hidden" name="hiderrormg" id="hiderrormg" value="<?=$_SESSION['completed_order_error_error_mg']?>">
<input type="hidden" name="hidenterbankdt" id="hidenterbankdt" value="<?=$_SESSION['bill_history_enter_bankdt']?>">
<input type="hidden" name="hidenteramout" id="hidenteramout" value="<?=$_SESSION['payment_pending_enteramount']?>">
<input type="hidden" name="hidentertranstndt" id="hidentertranstndt" value="<?=$_SESSION['payment_pending_entertransdt']?>">
<input type="hidden" name="hideselpaytype" id="hideselpaytype" value="<?=$_SESSION['payment_pending_sel_paytype']?>">
<input type="hidden" name="hidinsufamout" id="hidinsufamout" value="<?=$_SESSION['payment_pending_insufamount']?>">
<input type="hidden" name="hidincrtamout" id="hidincrtamout" value="<?=$_SESSION['payment_pending_incrt_amt']?>">
<input type="hidden" name="hidincrtchqamt" id="hidincrtchqamt" value="<?=$_SESSION['payment_pending_incrt_cheqamt']?>">
<input type="hidden" name="hidincrtcoupamt" id="hidincrtcoupamt" value="<?=$_SESSION['payment_pending_incrt_coupamt']?>">
<input type="hidden" name="hidbilprint" id="hidbilprint" value="<?=$_SESSION['completed_order_bilprint']?>">
<input type="hidden" name="hidnothngtoprint" id="hidnothngtoprint" value="<?=$_SESSION['bill_history_nothngtoprint']?>">
<input type="hidden" name="hidotpsend_msg" id="hidotpsend_msg" value="<?=$_SESSION['bill_history_otpsend_msg']?>">
<input type="hidden" name="hidbill_cancelled" id="hidbill_cancelled" value="<?=$_SESSION['bill_history_bill_cancelled']?>">
<input type="hidden" name="hidbillpayment_change" id="hidbillpayment_change" value="<?=$_SESSION['procedures_proc_billpayment_change']?>">

        <style>
		
            .confrmation_overlay{
                width:100%;
                height:100%;
                position:fixed;
                z-index:999;
                background-color:rgba(0,0,0,0.8);
                top:0;
            }
            .index_popup_1{
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
            .index_popup_contant{
                width:100%;
                height:30px;
                float:left;
                text-align:center;
                line-height:40px;
                font-size: 16px;
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

            .btn_index_popup_send{
                width:15%;
                display:inline-block;
                height:25px;
                line-height:25px;
                background-color: #FF2306;
                text-align:center;
                margin-right:1%;
                border-radius:5px;
                transition:all 0.2s ease;
                display:none;
                margin-top: 38px;
                margin-left: 121px;
            }
            .btn_index_popup_send a{
                color:#fff !important;
                font-size:15px;	
                text-decoration:none;
                display:none;
            }		
            .btn_index_popup_send:hover{background-color:#333;}	
            .btn_index_popup_send a:hover{color:#fff;}



     </style>
     <script>
         
     $(document).ready(function () {
                 
    var billhistorymsg1 = ($("#billhistorymsg1").val());

    $('.sendotp').click(function () {


                    var stafflist = $('#stafflist').val();
                    stafflist = $.trim(stafflist);
                    $.post("load_bill_history.php", {stafflist: stafflist, set: 'sendotp'},
                            function (data)
                            {
                                data = $.trim(data);

                            });

      });




  $("#arc_year").change(function () { 
      
      
          if( $("#arc_year").val()=='archive'){  
              
             $.post("load_bill_history.php", {set_year: 'set_archive'},
                            function (data)
                            {
                                 location.reload();
                            });  
         }else{
             
             $.post("load_bill_history.php", {set_year: 'set_normal'},
                 function (data)
                  { 
                       location.reload();
                  });  
       }
   });

                
                
                
                
                $(".close_settle").click(function () {
                    $("#bill").show();
                    $("#settlement").hide();

                });



$('.pay_settle_btn').click( function(event) {
             
                 
                 
                   // alert('hh');
		event.stopImmediatePropagation();
                
		var focused=$('#focusedtext1').val();
                var calval=($(this).text());
                
                
               var focusedsplit=focused.substring(0,6);
               
             // alert(focused);
              if(focusedsplit=="countc"){
                  
                 $('#countcard').val("");
               
              
              }else if(focusedsplit=="card_1"){
                 
                   var t=$('#card_1').val();
                  
                  var len= $('#'+focused).val().length;
                 // alert(len);
                 
                  if(len>3){
                      
                  
                   if(calval!="Clear"){     
                 calval="";
               
                   }else{
                       calval="Clear";
                      
                   }
                   }
                  
                              }
                      
                if(focused)
                //alert(focused);
                //alert(calval);
		
		var org=$('#'+focused).val();
			if(calval>=0)
			{
				if(org==0)
				{
					 $('#'+focused).val(org+calval);
				}else if(org>0)
				{
					$('#'+focused).val(org+calval);
				  
				}else if(org<0)
				{
					$('#'+focused).val(org+calval);
				}
                                else if(org==".")
				{
					$('#'+focused).val("0"+org+calval);
                                       
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




            });
            
            
     function number_search(number) {
    
    $('#focusedtext').val('selectcreditdetailsnumber');
     var credit_type=$('#selectcreditypes').val();
 
    $("#suggession_name").html('');
    
 
    
    if(number.length>1){
       if($("#suggession_number").html()!=''){
          
  
      }
      
         $("#suggession_number").show();
      
      
        var data_number='';
        var data_name='';
        var data1="set=guestnumber_search&number="+number+"&name=&credit_type="+credit_type;;
        $.ajax({
        type: "POST",
        url: "load_paymentpending.php",
        data: data1,
        success: function(data)
        { 
           
        $("#suggession_number").html('');
            
            data1=JSON.parse(data);
           var data_number=data1.mobile;
           var data_name=data1.name;
         
        for(var i=0;i<data_number.length;i++)
                {
                   $("#suggession_number").append('<div id="'+data_name[i]+'"  onclick="return number_select(this.id,'+data_number[i]+')">'+data_number[i]+' - '+data_name[i]+'</div>') ;
                     
                }
        }
         
        });
       
    }else{
        
            $("#suggession_number").html('');
            $("#suggession_name").html('');
            $("#suggession_number").hide();
    }
}


function number_select(name,number){
    
    $('#selectcreditdetailsnumber').val(number);
    $('#selectcreditdetailsname').val(name);
    $("#suggession_number").html('');
    
}   
            
            
            
      function billSearch(){
          
         var date1=$("#datepicker").val();
          
         var date=date1.split('-');
          
         var new_date=date[2]+'-'+date[1]+'-'+date[0]
          
         var billno=$("#billsearch1").val();
         var fin=$("#finyear").val();
         var dine=$("#dinein").val();
        
         var plusall=fin;
         var go='D'+plusall+'-'+billno;
        
         var paymode=$("#paymode_search").val(); 
          
                if(billno=="")
                {
                    billno="null";
                }

  
             $.ajax({
		type: "POST",
		url: "load_bill_history.php",
		data: "value=searchbill&billno="+billno+"&date="+new_date+"&paymode="+paymode,
		success: function(msg)
		{
			$('#billlisttotal').html(msg);
		}
	}); 
        
   if(event.keyCode==46){
            
  // $('#billsearch1').val("");
   
   $('#datepicker').val($('#datehid').val());
                    var billno = $('.bill_history_active').attr("billno");
                    if (billno == '')
                    {
                        billno = '';
                    }
                    $.post("load_bill_history.php", {billno: billno, set: 'billwholeload',paymode:paymode},
                            function (data)
                            {
                                data = $.trim(data);
                                $('#billlisttotal').html(data);
                            });
  }
  
   if (event.keyCode == 8) {
       
       // $('#billsearch1').val("");
         $('#datepicker').val($('#datehid').val());
                    var billno = $('.bill_history_active').attr("billno");
                    if (billno == '')
                    {
                        billno = '';
                    }
                    $.post("load_bill_history.php", {billno: billno, set: 'billwholeload',paymode:paymode},
                            function (data)
                            {
                                data = $.trim(data);
                                $('#billlisttotal').html(data);
                            });
   }
  
  
      }      
       
 function paidbalance()
  {   
            var decimal= $('#decimal').val();
           
            var transamount=$('#transcationid').val();
           
            if(transamount==""){
            var paidamt=$('#paidamount').val();
            var billamount=$('.totalamt').text();
            billamount=billamount.replace(",","");
            //alert(billamount);
            
             var blnce=(paidamt-billamount);
             //alert(blnce);
             if(blnce>=0){
             $('#balanceamout').val(blnce.toFixed(decimal));
         }
        }
        else{
            var paidamt=$('#paidamount').val().replace(",","");
            var billamount=$('.totalamt').text().replace(",","");
            var transblnce=$('#transbal').val().replace(",","");
            billamount=billamount.replace(",","");
           
//            alert(billamount);
//             alert(transamount);
//              alert(paidamt);
//              alert(transcash_paidbalnce);
            
             var blnce=paidamt-transblnce;
             //alert(blnce);
             if(blnce>=0){
             $('#balanceamout').val(blnce.toFixed(decimal));
         }
            
        }
        }
        
     function transebalnce(){
         
          var decimal= $('#decimal').val();
          var billamount=$('.totalamt').text().replace(',','');
          billamount=billamount.replace(",","");
          var transamount=$('#transcationid').val().replace(',','');
          
         //alert(transamount);
         
         if(parseFloat(transamount)>parseFloat(billamount))
         {  
             
             $(".payment_pend_right_cash_error").css("display","block");
             $(".payment_pend_right_cash_error").addClass("popup_validate");
             $(".payment_pend_right_cash_error").text("Enter Correct Amount");
             $('.payment_pend_right_cash_error').delay(2000).fadeOut('slow');
             
             $('#transcationid').val("");
             $('#transbal').val("");  
             return false;
         }
         else{
             
             var transblnce=billamount-transamount;
             $('#transbal').val(transblnce.toFixed(decimal));
         }
     }                     
            
            

 

function card(a){
 
       $('#'+a).toggleClass('card_active');
       
        
   }
    


function settlepopupcommoncs(){
  window.location.href="counter_sales.php?setcscommon=settlecspopup";  
}


function numonly(evt)
    {
        evt = (evt) ? evt : window.event;
        var charCode = (evt.which) ? evt.which : evt.keyCode;
        if (charCode > 31 && (charCode < 48 || charCode > 57)) {

            return false;

        }
//        if (evt.keyCode == 13) {
//                   
//             $('.submitcard').click();
//              }
        return true;
    }



function isNumberKey(evt)
       { 
          var charCode = (evt.which) ? evt.which : event.keyCode
          if (charCode != 46 && charCode > 31 
            && (charCode < 48 || charCode > 57))
             return false;
//  if (charCode == 13) {
//                   
//             $('.submitcard').click();
//              }
          return true;
       }

function selectdefault(p){
    
  //$('#card_1'+p).focus();
 // $('#multicardtype'+p).focus();
}

function enter_plus(evt)
  {
    
        if(evt.keyCode == 13 ) {
         
           $(".plusbtn").click();     
       
              }
        return true;
 }



$(".plusbtn").click(function()
        {    
            
            
            $(".plusbtn").css('pointer-events','none');
            
            //$("#newref").load(location.href + " #newref");
            var gtt= parseFloat($('#grand_total').text().replace(',',''));
          
            var tran=parseFloat($('#transcationid').val().replace(",",""));
            var camount_his = parseFloat($('#multi_cardamount').val().replace(",",""));
            
            var  tot= camount_his+tran;
            
          if(tot==gtt){
              
              $('#balanceamout').val('0');
              $('#paidamount').val('0');
             //$('#paidamount').focus();
              
          }
         
      
            if(camount_his!="" && tot<=gtt ){ 
                
            var ctype =  $("#multicardtype").val();
            var camount_his = $('#multi_cardamount').val();
            var cnumber = $("#card_1").val();
             var billno=$('.bill_history_active').attr("billno");
                
               var btype = $("#multibanktype").val();   
                
             var datastring = "ctype="+ctype+"&camount="+camount_his+"&cnumber="+cnumber+"&billno="+billno+"&btype="+btype;
            

                 $.ajax({
                 type: "POST",
                 url: "load_div.php",
                 data: datastring,
                 success: function (data)
                 { 
                    var arr = data.split("+");
                     var a=JSON.parse(arr[0]);
                     var b=JSON.parse(arr[1]);
                     var c=JSON.parse(arr[2]);
                     
                     var decimal=$('#decimal').val();
                        
                     $("#multicardtype").val('');
                     $("#multi_cardamount").val('');
                     $("#card_1").val('');
                     
                      $("#multibanktype").val($("#multibanktype option:first").val());   
                    
                     $.each(a, function(i, record) {
                        
                   var amount=parseFloat(record.mc_cardamount).toFixed(decimal);
                   if($.trim(record.mc_carnumber)==''){
                                var cardnum='';
                            }
                            else{
                                 var cardnum=record.mc_carnumber;
                            }
                 
                 
              if($('.cardadder').find('#del_card' + record.mc_slno).length === 0) {
              $(".cardadder").append("<div class='card_detail_popup_list refdiv_card' id='card_detail_popup_list"+record.mc_slno+"'  style='margin-bottom:3px'> <div class='card_detail_popup_type' style='width:30%;margin-right:1%;display:none'>"+
              "<select class='card_type_dropdwn cardselect' id='multicardtype"+record.mc_slno+"' onclick='return selectdefault();'> <option value='' > Select Card</option>"+
              b+ "</select>"+
              "</div>"+  
              "  <div class='card_detail_popup_type' style='width: 33%;'>"+
              "<input class='card_popup_digits cardno' type='text' id='card_1"+record.mc_slno+"' value='" + cardnum + "' name='card_1"+record.mc_slno+"'  onkeypress='return numonly("+record.mc_slno+")' onclick='return pincard("+record.mc_slno+")' onchange='return pincard("+record.mc_slno+")' maxlength='4' autocomplete='off'>"+
              "</div>"+
              "<div class='card_detail_popup_type' style='width:18%;margin-left:1%'>"+
              "<input type='text' class='card_type_dropdwn amountall' id='multi_cardamount"+record.mc_slno+"' value='" + amount + "' name='multi_cardamount"+record.mc_slno+"' onkeypress='return numonly()' onkeyup='return cardsum("+record.mc_slno+")' onclick='return cardsum("+record.mc_slno+")' onchange='return cardsum("+record.mc_slno+")' autocomplete='off'>"+
              " </div>"+
              
               " <div class='card_detail_popup_type' style='width:30%;margin-right:1%'>"+
              "<select class='card_type_dropdwn bankselect_new' id='multibanktype"+record.mc_slno+"' onclick=''> <option value='' > Bank</option>"+
              c+ "</select>"+
              "</div>"+  
              
              "<div style='margin-top:0px;width: 12%;height: 34px;margin-top: -1px;float: right' id='del_card"+record.mc_slno+"' name='del_card"+record.mc_slno+"' class='menut_add_bq_btn' onclick='return deletecard("+record.mc_slno+");'><img width='23px' src='img/cancel-icon.png'></div>"+
              "</div>"        
              
                    );
                                 
                         }
                         
                           $("#multibanktype"+record.mc_slno).val(record.mc_to_bank);
                           $("#multibanktype"+record.mc_slno).prop('disabled',true);
                           $("#multicardtype"+record.mc_slno).val(record.mc_cardtype);
                           $("#multicardtype"+record.mc_slno).prop('disabled',true);
                           $("#card_1"+record.mc_slno).prop('disabled',true);
                           $("#multi_cardamount"+record.mc_slno).prop('disabled',true);
                         
                     });
                     $(".plusbtn").css('pointer-events','inherit');
                 }
                 });
                 
        var multibillnew16=$('.bill_history_active').attr("billno");
        var datastringnewmultinew16="setmultinew16=multicardnew16&multibillnew16="+multibillnew16;
    
        $.ajax({
        type: "POST",
        url: "bill_history.php",
        data: datastringnewmultinew16,
        success: function(data)
        {
        
        $(".trrefresh1").load(location.href + " .trrefresh1");
        $(".trrefresh").load(location.href + " .trrefresh");
       
        }
    });
             $('.closetranscationshis').click();      
            }else{ 
                 
                $(".payment_pend_right_cash_error").css("display","block");
		$(".payment_pend_right_cash_error").addClass("popup_validate");
		$(".payment_pend_right_cash_error").text("Check Amount");
		$('.payment_pend_right_cash_error').delay(2000).fadeOut('slow');
                $(".plusbtn").css('pointer-events','inherit');
            }
          
              $('#balanceamout').val('0');
              $('#paidamount').val('0');
              
            
              
        });




function pincard(r){
$('#focusedtext1').val('card_1');
}

function cardsum(r){
$('#focusedtext1').val('multi_cardamount');
}

function isNumberKey(evt)
       {  
          var charCode = (evt.which) ? evt.which : event.keyCode
         // alert(charCode);
          if (charCode != 46 && charCode > 31 
            && (charCode < 48 || charCode > 57))
             return false;

          return true;
       }

function deletecard(e){
    var check = confirm("Are you sure you want to Delete?");
	if(check==true)
	{
    var bil=$('.bill_history_active').attr("billno");

    $('#card_detail_popup_list'+e).hide();
   var datastringnewcard="setdel=delcar&bilcard="+bil+"&slnocard="+e;

 //alert(datastringnewcard);
       $.ajax({
        type: "POST",
        url: "bill_history.php",
        data: datastringnewcard,
        success: function(data)
        {      
           // alert(data);
           var multibillnew16=$('.bill_history_active').attr("billno");
        var datastringnewmultinew16="setmultinew16=multicardnew16&multibillnew16="+multibillnew16;
    
       $.ajax({
        type: "POST",
        url: "bill_history.php",
        data: datastringnewmultinew16,
        success: function(data)
        {  
          
           $(".trrefresh1").load(location.href + " .trrefresh1");
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
     
    }
 
}

function datechange()
            {
                var dt = $('#datepicker').val();
                var res = dt.split("-");
                var dateset = res[2] + "-" + res[1] + "-" + res[0];
                var billno = $('.bill_history_active').attr("billno");
                if (billno == '')
                {
                    billno = '';
                }
                   $.post("load_bill_history.php", {billno: billno, datefield: dateset, set: 'billwholeload'},
                        function (data)
                        {
                            
                       data = $.trim(data);
                       $('#billlisttotal').html(data);
                        $('#paymode_search').val('');
                                         
                       
              });
            }


 
    
    function delete_bill_item_normal(bil,sl,sts){
       if(sts=='Closed'){
        var check = confirm("Are you sure you want to Delete Item ?");
	if(check==true)
	{
         var dat="set=check_day_close&billno="+bil;
         $.ajax({
         type: "POST",
         url: "load_bill_history.php",
         data: dat,
         success: function(data)
         {  
            
          var date_ok_no=$.trim(data);
            
            if(date_ok_no=='Yes'){
                
                
        var dat2="set=check_item_number&billno="+bil;
         $.ajax({
         type: "POST",
         url: "load_bill_history.php",
         data: dat2,
         success: function(data2)
         {  
            
          var date_ok=$.trim(data2);
            
            if(date_ok=='Yes'){
                
                
                
                 var dat22="set=check_paymode&billno="+bil;
         $.ajax({
         type: "POST",
         url: "load_bill_history.php",
         data: dat22,
         success: function(data22)
         {  
            
          var date_ok22=$.trim(data22);
            
            if(date_ok22=='Yes'){
                
         var dat1="set=delete_item_bill&billno="+bil+"&slno="+sl;
         $.ajax({
         type: "POST",
         url: "load_bill_history.php",
         data: dat1,
         success: function(data)
         {  
             setTimeout(function(){
                               $('.confrmation_overlay_proce').css('display','block');
		             $('.confrmation_overlay_proce').html('<img src="img/ajax-loaders/ajax-loader.gif" />');
                
                           $('.confrmation_overlay_proce').fadeOut(2500);
                        
		     
                        
                         }, 100);
             
             
             $.post("load_bill_history.php", {billno:bil,set:'billdetailsset1'},
				  function(data)
				  {
				  	data=$.trim(data);
				  	$('#detailsset1').html(data);
				  });
             
         }
          });    
          
          
          }else{
          //alert('Payment Other Than Cash Cannot Be Deleted');  
          $('.alert_error_popup_all_in_one').show();
                        $('.alert_error_popup_all_in_one').text('Payment Other Than Cash Cannot Be Deleted');
                        $('.alert_error_popup_all_in_one').delay(1000).fadeOut('slow');
        }
        
        
        }
    });
          
                
                
             }else{
          //alert('Bill With One Item Cannot Be Deleted');  
          $('.alert_error_popup_all_in_one').show();
                        $('.alert_error_popup_all_in_one').text('Bill With One Item Cannot Be Deleted');
                        $('.alert_error_popup_all_in_one').delay(1000).fadeOut('slow');
        }
        
        
        }
    });
            
            
            
            
            
        }else{
          //alert('Day is not Closed ');  
          $('.alert_error_popup_all_in_one').show();
                        $('.alert_error_popup_all_in_one').text('Day is not Closed');
                        $('.alert_error_popup_all_in_one').delay(1000).fadeOut('slow');
        }
        
        
        }
    });
         
        }
    }else{
        //alert('Bill Status Is Not Closed');
         $('.alert_error_popup_all_in_one').show();
                        $('.alert_error_popup_all_in_one').text('Bill Status Is Not Closed');
                        $('.alert_error_popup_all_in_one').delay(1000).fadeOut('slow');
    }
    }
    
    
    
    function replace_bill_item(bil,sl,sts){
     $('.common_popup_all').show();
    $('.common_popup_all').attr('billno',bil);
    $('.common_popup_all').attr('bill_slno',sl);
    $('.common_popup_all').attr('status',sts);
    }
    
     function replace_bill_item_click(){
         
         var bil=$('.common_popup_all').attr('billno');
         var sl=$('.common_popup_all').attr('bill_slno');
         var sts=$('.common_popup_all').attr('status');
    
       if(sts=='Closed'){
     
         var dat="set=check_day_close&billno="+bil;
         $.ajax({
         type: "POST",
         url: "load_bill_history.php",
         data: dat,
         success: function(data)
         {  
            
          var date_ok_no=$.trim(data);
            
            if(date_ok_no=='Yes'){
                
                 var dat22="set=check_paymode&billno="+bil;
         $.ajax({
         type: "POST",
         url: "load_bill_history.php",
         data: dat22,
         success: function(data22)
         {  
            
          var date_ok22=$.trim(data22);
            
            if(date_ok22=='Yes'){
                
         var dat1="set=replace_item_bill&billno="+bil+"&slno="+sl;
         $.ajax({
         type: "POST",
         url: "load_bill_history.php",
         data: dat1,
         success: function(data)
         {  $('.common_popup_all').hide();
          
                        $('.alert_error_popup_all_in_one').show();
                        $('.alert_error_popup_all_in_one').text('REPLICATED');
                        $('.alert_error_popup_all_in_one').delay(500).fadeOut('slow');
                        
                       
             $.post("load_bill_history.php", {billno:bil,set:'billdetailsset1'},
				  function(data)
				  {
				  	data=$.trim(data);
				  	$('#detailsset1').html(data);
				  });
             
         }
          });    
          
          
          }else{
         
          $('.alert_error_popup_all_in_one').show();
                        $('.alert_error_popup_all_in_one').text('Payment Other Than Cash Cannot Be Replaced');
                        $('.alert_error_popup_all_in_one').delay(1000).fadeOut('slow');
        }
        
        
        }
    });
             
        }else{
         
          $('.alert_error_popup_all_in_one').show();
                        $('.alert_error_popup_all_in_one').text('Day is not Closed');
                        $('.alert_error_popup_all_in_one').delay(1000).fadeOut('slow');
        }
        
        
        }
    });
         
    }else{
       
         $('.alert_error_popup_all_in_one').show();
                        $('.alert_error_popup_all_in_one').text('Bill Status Is Not Closed');
                        $('.alert_error_popup_all_in_one').delay(1000).fadeOut('slow');
    }
    }
    
    
    function a4_view(){
        
       var bill= $('#a4_view').attr("billno");
       var sts=  $('#a4_view').attr("sts");
        
       if(sts=='Closed'){
           
          if(bill!='' && bill!='undefined' && bill!=undefined ){
      
          var num=$('#csphone').val(); 
        
        
          window.open('a4_bill_view.php?set=bill_view_di&billno='+bill+"&mode=DINE-IN&num="+num, '_blank');
          
            $.post("test2.php", {set:'test_api_service_fast'},function(data){  });   
          
          }else{
                        $('.alert_error_popup_all_in_one').show();
                        $('.alert_error_popup_all_in_one').text('SELECT BILL');
                        $('.alert_error_popup_all_in_one').delay(1000).fadeOut('slow');
              
        }
        
         }else{
                        $('.alert_error_popup_all_in_one').show();
                        $('.alert_error_popup_all_in_one').text('BILL NOT SETTLED');
                        $('.alert_error_popup_all_in_one').delay(1000).fadeOut('slow');
              
        }
        
        
    }
    
    
     function whatsapp_view(){
        
       var bill= $('#a4_view').attr("billno");
         var sts=  $('#a4_view').attr("sts"); 
         
         var num=$('#csphone').val(); 
       
        if(sts=='Closed'){
       
          if(bill!='' && bill!='undefined' && bill!=undefined ){
              
                        $('.alert_error_popup_all_in_one').show();
                        $('.alert_error_popup_all_in_one').text('BILL IS SHARED IN WHATSAPP');
                        $('.alert_error_popup_all_in_one').delay(4000).fadeOut('slow');
                        
         var dat1="set=share_ebill&billno="+bill+"&mode=DI";
         $.ajax({
         type: "POST",
         url: "a4_bill_view.php",
         data: dat1,
         success: function(data)
         { 
             
              var aa=$.trim(data).split('##');
                
              $.post("test2.php", {set:'test_api_service_fast'},function(data){  });   
             
              if($('#whatsapp_api_bill').val()=='N'){
                  
                  
                 window.open('https://wa.me/'+num+'?text=This Is Your Ebill. Click Here '+aa[1], '_blank'); 
                 
              }
             
         }
         });
         
          }else{
                        $('.alert_error_popup_all_in_one').show();
                        $('.alert_error_popup_all_in_one').text('SELECT BILL');
                        $('.alert_error_popup_all_in_one').delay(1000).fadeOut('slow');
              
        }
        
        }else{
                        $('.alert_error_popup_all_in_one').show();
                        $('.alert_error_popup_all_in_one').text('BILL NOT SETTLED');
                        $('.alert_error_popup_all_in_one').delay(1000).fadeOut('slow');
              
        }
    }
    
    
        </script>

        
       <!--       ///bill reprint  popup dinein net fail//             -->
    <div style="display:none;height: 160px;" class="index_popup_1  kotconfirmpopup_reprint_hisory">
        <span id="kotfailmsg_reprint_history" style="text-align: center;width: 100%;float: left ;padding-top: 7px;"></span>
 	<div class="index_popup_contant">Are you sure you want continue without Bill Re-Print ?</div>
       <div class="index_popup_contant">
    	<div class="btn_index_popup"><a href="#" class="confirmkotok_reprint_history">Yes</a></div>
        <div class="btn_index_popup"><a href="#" class="confirmkotclose_reprint_history">No</a></div>
    </div>
 </div> 
        
       <div style="display:none" class="confrmation_overlay_proce"></div>  
        
        
        <input type="hidden" name="paymentmode_chge" id="paymentmode_chge" >
        <input type="hidden" name="amountpaid_chge" id="amountpaid_chge" >
        <input type="hidden" name="balance_chge" id="balance_chge" > 
        <input type="hidden" name="original_chge" id="original_chge" > 
        <input type="hidden" name="bilno_chge" id="bilno_chge" >  
        <input type="hidden" name="bankname_chge" id="bankname_chge" > 
        <input type="hidden" name="transamt_chge" id="transamt_chge" > 
        <input type="hidden" name="transbal_chge" id="transbal_chge" >  
        <input type="hidden" name="billhistory" id="billhistorymsg1" value="<?= $_SESSION['bill_history_error_chagebill'] ?>">
        <input type="hidden" name="billhistory" id="billhistorymsg2" value="<?= $_SESSION['bill_history_error_chagebill'] ?>">
        <input type="hidden" name="billhistory" id="billhistorymsg3" value="<?= $_SESSION['bill_history_error_insufficient_amount'] ?>">
        <input type="hidden" name="billhistory" id="billhistorymsg4" value="<?= $_SESSION['bill_history_error_otp_error'] ?>"!!>
        <script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
        <!-- library for cookie management -->
        <script src="js/jquery.cookie.js"></script> 
        
        
      <style>
.stck_add_btn{width: 20px; height: 20px; display: inline-block;background-color: #738a77; border-radius: 50%; color: #fff !important; margin-left: 5px;}
.stok_add_popup_sec{width:100%;height:100%;position:fixed;left:0;top:0;z-index:8;background-color:rgba(0,0,0,0.9)}
.stok_add_popup{width:250px;height:150px;position:absolute;left:0;right:0;top:20%;background-color:#fff;margin:auto;border-radius:10px;}
.stok_add_popup_hd{width:100%;height:auto;float:left;font-size:18px;color:#242424;text-align:center;padding:20px 0;position:relative}
.stok_add_popup_cnt{width:100%;height:auto;float:left;padding:10px;}
.stock_add_txtbx{width:60%;height:35px;float:left;border:solid 1px #ccc;padding-left:10px}
.stock_add_btn{width:38%;float:right;height:35px;text-align:center;line-height:35px;background-color:#738a77;color:#fff;border-radius:5px;}
.stok_add_popup_cls{width:20px;height:20px;position:absolute;right:5px;top:5px}
 </style>
      
    <div class="stok_add_popup_sec" style="display:none" id="add_stock_pop">    
    <div class="stok_add_popup">
        <div class="stok_add_popup_hd">  
        <a href="#" onclick="$('#add_stock_pop').hide();"><div class="stok_add_popup_cls">
                <img width="100%" src="img/black_cross.png" alt=""></div></a></div>
        <div class="stok_add_popup_cnt" id="cus_div" style="display:block">
            <span style="font-size:10px;font-weight: bold;color: darkred">  ENTER OTP PROVIDED BY OUTLET OWNER ? </span> 
            <input  maxlength="10" type="password" class="stock_add_txtbx" id="code_change" placeholder="ENTER OTP ">
            <a id="go_bill_cancel" onclick="go_bill_cancel();" href="#"><div class="stock_add_btn">GO</div></a>
            
        </div>
        
    </div>
   </div>   
        
        
    </body>

</html>