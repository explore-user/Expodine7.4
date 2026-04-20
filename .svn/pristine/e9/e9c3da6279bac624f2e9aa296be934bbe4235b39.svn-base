<?php
error_reporting(0);
include('includes/session.php');		// Check session
//session_start();
include("database.class.php"); // DB Connection class
$database	= new Database();
include("api_multiplelanguage_link.php");
$other_lang=  trim(json_encode($_SESSION['main_language']),'""');
//include('includes/master_settings.php');

 if(!isset($_SESSION['timeopen']) ){ header("location:index.php?msg=1"); }
 $date_given=explode("-",$_SESSION['date']);	
 $days_in_month=cal_days_in_month(CAL_GREGORIAN,$date_given[1],$date_given[0]);
 $month_set=$date_given[1];//date('m');//date("M", strtotime(date('m')));
 $year_set=$date_given[0];//=date("Y");
 $day_set=$date_given[2];//date("d");

$today=$day_set."-".$month_set."-".$year_set;

    


   if(isset($_REQUEST['billnoview'])){
     
            $row2=array();
            $opt=array();
            $multibill=$_REQUEST['billnoview'];
             
            $opt2=array();
      
	
         $fnct_menu = $database->mysqlQuery("select * from tbl_bill_card_payments where (mc_billno='".$multibill."' or mc_billno='temp_".$multibill."') ");
       
        $num_fdtl = $database->mysqlNumRows($fnct_menu);
        if ($num_fdtl > 0) {
              while ($result_fnctvenue = $database->mysqlFetchArray($fnct_menu))
              {
                      $row2[]=$result_fnctvenue;
                  }
        }
        
                                           $option="";
                                           $sql_rsn1 = "select * from tbl_cardmaster where crd_active = 'Y'";
                                                $sql_rsns1 = $database->mysqlQuery($sql_rsn1);
                                                $num_rsns1 = $database->mysqlNumRows($sql_rsns1);
                                                if ($num_rsns1) {
                                             while ($result_rsns1 = $database->mysqlFetchArray($sql_rsns1)) {
                                                      
                                                 
                                $option .=      " <option value='".$result_rsns1['crd_id']."'> ".$result_rsns1['crd_name']." </option>";
                                                       }}
                                $opt[]=$option;
                                
                                
                                
                    $option2="";
                    $sql_rsn1 = "select * from tbl_bankmaster ";
                    $sql_rsns1 = $database->mysqlQuery($sql_rsn1);
                    $num_rsns1 = $database->mysqlNumRows($sql_rsns1);
                    if ($num_rsns1) {
                     while ($result_rsns1 = $database->mysqlFetchArray($sql_rsns1)) {
                    
                         $option2 .=      " <option value='".$result_rsns1['bm_id']."'> ".$result_rsns1['bm_name']." </option>";
                     }}
                     
                    $opt2[]=$option2;   
   
                 
  if($row2!="" && $opt!=""){
          echo json_encode($row2).'+'.json_encode($opt).'+'.json_encode($opt2).'+';
  }
   }

 

 if(isset($_REQUEST['camount'])){
     
            $row2=array();
            $opt=array();  $opt2=array();
            $multibill=     'temp_'.$_REQUEST['billno'];
            $multicardnum= $_REQUEST['cnumber'];
            $multicardtype=$_REQUEST['ctype'];
            $multicardamount=$_REQUEST['camount'];
    
            $insertion['mc_billno']=  mysqli_real_escape_string($database->DatabaseLink,trim($multibill));
            
        if($multicardtype!=""){
          $insertion['mc_cardtype']= mysqli_real_escape_string($database->DatabaseLink,trim($multicardtype));
         }
             
          $insertion['mc_to_bank']=  mysqli_real_escape_string($database->DatabaseLink,trim($_REQUEST['btype']));     
             
        $insertion['mc_cardamount']= mysqli_real_escape_string($database->DatabaseLink,trim($multicardamount));
        if($multicardnum!=""){
	$insertion['mc_carnumber']= mysqli_real_escape_string($database->DatabaseLink,trim($multicardnum));
        }
	
       $sql=$database->check_duplicate_entry('tbl_bill_card_payments',$insertion);
       if($sql!=1)
	{
	   $insertid              			=  $database->insert('tbl_bill_card_payments',$insertion);   
           
         $fnct_menu = $database->mysqlQuery("select * from tbl_bill_card_payments where mc_billno='".$multibill."'");
         $num_fdtl = $database->mysqlNumRows($fnct_menu);
        if ($num_fdtl > 0) {
              while ($result_fnctvenue = $database->mysqlFetchArray($fnct_menu))
              {
                      $row2[]=$result_fnctvenue;
                  }
        }
        
                                            $option="";
                                           $sql_rsn1 = "select * from tbl_cardmaster where crd_active = 'Y'";
                                                $sql_rsns1 = $database->mysqlQuery($sql_rsn1);
                                                $num_rsns1 = $database->mysqlNumRows($sql_rsns1);
                                                if ($num_rsns1) {
                                             while ($result_rsns1 = $database->mysqlFetchArray($sql_rsns1)) {
                                                      
                                                 
                                $option .=      " <option value='".$result_rsns1['crd_id']."'> ".$result_rsns1['crd_name']." </option>";
                                                       }}
                                $opt[]=$option;
                                
                                 $option2="";
                    $sql_rsn1 = "select * from tbl_bankmaster ";
                    $sql_rsns1 = $database->mysqlQuery($sql_rsn1);
                    $num_rsns1 = $database->mysqlNumRows($sql_rsns1);
                    if ($num_rsns1) {
                     while ($result_rsns1 = $database->mysqlFetchArray($sql_rsns1)) {
                    
                         $option2 .=      " <option value='".$result_rsns1['bm_id']."'> ".$result_rsns1['bm_name']." </option>";
                     }}
                     
                    $opt2[]=$option2;   
                                
                                
   
                 }
 
          echo json_encode($row2).'+'.json_encode($opt).'+'.json_encode($opt2).'+';
   }

  
  if(isset($_REQUEST['setmultinew16'])&&($_REQUEST['setmultinew16']=="multicardnew16")){
               $multibilledit16=     $_REQUEST['multibillnew16'];
               $_SESSION['billcardbhta']=$multibilledit16;
               
             
   } 
            
            
   if(isset($_REQUEST['setdel'])&&($_REQUEST['setdel']=="delcar")){
       
           $multibilldel=    $_REQUEST['bilcard'];
           $multislnodel=     $_REQUEST['slnocard'];
          
           $query321=$database->mysqlQuery("  DELETE FROM tbl_bill_card_payments WHERE (mc_billno='$multibilldel' or mc_billno='temp_".$multibilldel."') and mc_slno='$multislnodel' ");    
             
   }
 
    
            
   if(isset($_REQUEST['sethistory'])&&($_REQUEST['sethistory']=="delhistory")){
       
             $multibilldelhistory=     $_REQUEST['bilcardhistory'];
         
             $queryhistory=$database->mysqlQuery("  DELETE FROM tbl_bill_card_payments WHERE (mc_billno='$multibilldelhistory' or mc_billno = 'temp_".$multibilldelhistory."') ");    
             
   }      
 
?>
<!DOCTYPE HTML>
<html><head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title> TA-HD Bill History</title>
<link rel="shortcut icon" href="img/favicon.ico">
<link href="css/bootstrap-cerulean.min.css" rel="stylesheet" />
<link href="css/order_new.css" rel="stylesheet" type="text/css">
<link href="css/bill_history.css" rel="stylesheet" type="text/css">
<link href="css/take_away_bill_history.css" rel="stylesheet" type="text/css">

<script src="js/jquery-1.10.2.min.js"></script> 
<script src="js/takeaway_hist.js"></script>
<script src="js/numpad.js"></script>
<!--<script src="js/bill_history.js"></script>
<script src="js/bill_reprint.js"></script>
<script src="js/bill_cancel.js"></script>
<script src="js/bill_eachcancelhistory.js"></script>-->
<!--ESC Key press starts-->
  <link rel="stylesheet" href="css/jquery-ui.css">
  <script src="js/jquery-ui.js"></script>
  <link rel="stylesheet" href="css/style_date.css">
 <script>
 $(document).ready(function() {
  $("#datepicker").datepicker({
      changeMonth: true,
      changeYear: true,
	  maxDate: "+0D "
    });
   

 });
 </script>
<style>
body{font-family:inherit}
.left_contant_container {height: 80vh;padding-top:0}	
.tax_table td{  padding-left: 12px;text-align: left;}
.tax_textbox {width: 100%;}
.discount_text_cc{text-align:center}
.bill_number_head .updatestock{
	width: 40px;
    height: 37px;
    float: right;
    background-image: url(img/update.png);
    background-repeat: no-repeat;
    background-position: center;
	position:absolute;
	cursor:pointer;
    left: 110px;
	top: 20px;
    margin-top: -16px;
	}
.billgenration_validate{width:35%;}
.top_site_map_cc{height: 35px;}

.left_bill_history_contain{background-color:#FFFBEA}
.bill_history_details_table td{color:#000;border: solid 1px #ccc;}
.bill_number_head{background-color: #AB2426;}
.bill_history_center_bill{background-color:#fff}
.bill_history_right_detail{background-color:#fff}
.bill_his_order_detail_head td{    background-color: #333;;border: solid 1px #ccc;}
.bil_his_dish_name, .bil_his_sl_no{color:#000;border: solid 1px #ccc;border-top: 0;padding: 1% 0;height:30px;line-height: 22px;}
.bill_history_close_btn{background-color: rgba(247, 146, 146, 0.5);}
.bill_history_orderd_cont{margin:0;min-height: 200px;height:35vh;}
.bill_story_center_top_txt{width:100%;height:20px;line-height:15px;display: inline-block;text-align: left;padding-left:5px}
.bill_story_center_txt{width:95%;height:30px;line-height:30px;padding-left:5px;border:solid 1px #ccc;display: inline-block;text-align: left;margin-bottom:5px;border-radius: 3px;background: #FFF7EB;}
.none_border_table td{border:none;padding-top:0px;}
.right_bill_history_detail{height:30px;margin-bottom:0}
.bill_story_center_txt{height: 26px;line-height: 26px;}
.bill_his_buton_cc, .bill_cancel_btn{text-align:center;padding-left: 0;border: solid 1px #ccc;}
.bill_cancel_btn{margin-right:2%;padding-top:0px;background-position: 10px 48%;width: 30%;position:relative;display:inline-block;float: none;}
.bill_story_center_txt{overflow:hidden;margin-bottom:1px;}
.bill_history_details_table {min-height: 445px;}
.top_site_map_cc  .new_right_drop{display:none}
.new_right_drop{margin-top:-8px;}
.settle_ment_detail_paid_cc{height: 180px;min-height:32vh;position:relative;}
.bill_histor_tax_sec_box{width: 100%;height: auto;float: left;}
.input_tip_btn{width: 25%;float: right;margin-left: 5px;margin-top: 0}
.input_tip_btn .history-sub-btn{margin-top: 1px}
.input_tip_textbox { width: 50%; height: 30px; float: right; border: solid 1px #ccc; border-radius: 5px;
padding-left: 5px;}
.text_tip{width: auto;float:left;font-size: 15px;color: #666;padding-top: 5px}

[data-tooltip] {
  position: relative;
  z-index: 2;
  cursor: pointer;
}

/* Hide the tooltip content by default */
[data-tooltip]:before,
[data-tooltip]:after {
  visibility: hidden;
  -ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=0)";
/*  filter: progid: DXImageTransform.Microsoft.Alpha(Opacity=0);*/
  opacity: 0;
  pointer-events: none;
}

/* Position tooltip above the element */
[data-tooltip]:before {
  position: absolute;
  bottom: 70%;
  left: 38px;
  margin-bottom: 15px;
  margin-left: -80px;
  padding: 7px;
  width: 160px;
  -webkit-border-radius: 3px;
  -moz-border-radius: 3px;
  border-radius: 3px;
  background-color: #000;
  background-color: hsla(0, 0%, 20%, 0.9);
  color: #fff;
  content: attr(data-tooltip);
  text-align: center;
  font-size: 14px;
  line-height: 1.2;
}

/* Triangle hack to make tooltip look like a speech bubble */
[data-tooltip]:after {
  position: absolute;
  bottom: 92%;
  left: 50%;
  margin-left: -5px;
  width: 0;
  border-top: 5px solid #000;
  border-top: 5px solid hsla(0, 0%, 20%, 0.9);
  border-right: 5px solid transparent;
  border-left: 5px solid transparent;
  content: " ";
  font-size: 0;
  line-height: 0;
}

/* Show tooltip content on hover */
[data-tooltip]:hover:before,
[data-tooltip]:hover:after {
  visibility: visible;
  -ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=100)";
/*  filter: progid: DXImageTransform.Microsoft.Alpha(Opacity=100);*/
  opacity: 1;
}
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
$(function() {

 /*************************************** cancel close click starts ******************************************************************  */
   $('.update_billdetails').click(function () {
       
	  //checkday checkmonth checkyear
	  // var dateset=$('#checkyear').val() +"-"+ $('#checkmonth').val() +"-"+ $('#checkday').val();
	 // var dt=$('#datepicker').val();
	  //var res = dt.split("-");
	  //var dateset=res[2] +"-"+ res[1] +"-"+ res[0] ;
	  $('#datepicker').val($('#datehid').val());
		 var billno       =  $('.bill_history_active').attr("billno");
		  if(billno=='')
		  {
			  billno='';
		  }
		  $.post("load_ta_history.php", {billno:billno,value:'billwholeload_ta'},
				  function(data)
				  {
				  	data=$.trim(data);
				  	$('#ta_billlisttotal').html(data);
				  });
	
	});
	 /*************************************** cancel close click ends ******************************************************************  */
});
function datechange()
{
	 var dt=$('#datepicker').val();
	  var res = dt.split("-");
	  var dateset=res[2] +"-"+ res[1] +"-"+ res[0] ;
		 var billno       =  $('.bill_history_active').attr("billno");
		  if(billno=='')
		  {
			  billno='';
		  }
		  $.post("load_ta_history.php", {billno:billno,datefield:dateset,value:'loadtahistory_date'},
				  function(data)
				  {
				  	data=$.trim(data);
				  	$('#ta_billlisttotal').html(data);
                                        
                                          $('#paymode_search').val('');
                                          $('#search_mode_new').val('');
                                          $('#search_partner_new').val('');
                                         
                                        
				  });
}
</script> 

<script type="text/javascript">
$(document).ready(function(){
    
$(document).on('keypress',function(e) {
    if(e.which == 13) {
       
       if($('#paidamount').val() > 0 || $('#transcationid').val() > 0){
          
           $('.closetranscationshis').click();
       }
       
       
       
    }
});
	
                            $(".credit_cc").hide();
                            $(".coupon_cc").hide();
                            $(".voucher_cc").hide();
                            $(".cheque_cc").hide();
                            $('.closetranscations').css("display","block");
                            $('.closetranscations_whole').css("display","none");
                            
                            
     $('#selectcreditypes').change(function () {	
            
            var pd1=$('#paidamount_credit').val();
            var gr1=$('#grandtotal').text();
            var sm1=gr1-pd1;
            
			 var credittype=$(this).val();
                         
                         
                         
                         
			 $('.credtitypeloads').html('<img src="img/ajax-loaders/ajax-loader-6.gif" />');
                         
			 var labelname=$("#selectcreditypes").find('option:selected').attr('label');
			 
			
			  $.post("load_ta_history.php", {credittype:credittype,set:'loadcreditypes'},
				  function(data)
				  {
                                      
				      $('.credtitypeloads').html(data);	
				      $('.labelname').html(labelname);	
                                  
				 
				   var balamt=	$('#balanceamout_credit').val();
                                   
				   if(balamt!='0.00' &&  balamt!='0' &&  balamt!='')
				   {
					       $('#amount_credit').val(sm1);
					   
				   }else
				   {
					 if(balamt=='0' && $('#paidamount_credit').val()!='0')
					 {
						 $('#amount_credit').val('0'); 
					 }else
					 {	
                                             
                                                  var grnd=$('#grandtotal').text();
                                                  $('#amount_credit').val(grnd); 
					 }
					  
				   }
				  
	  $('.credit_cc_normal').css("display", "none");      
       
          $('.paid_amount_cc').css("display", "none");     
          
          $('.paid_amount_cc_credit').css("display", "block");    
         
          
           var grnd=$('.final_net').attr('tot'); 
           $('#amount_credit').val(grnd); 
         
          
	  });
  });      
        
        
        
   $("#payemntmode_sel").change(function(){
         
   var aat=($(this).val());
                                
   if(aat=="1"){
                                    
					$(".cash_cc").show();
                                        $(".credit_cc").hide();
					$(".credit_cc_normal").hide();
                                        $(".coupon_cc").hide();
					$(".voucher_cc").hide();
					$(".cheque_cc").hide();
					$(".auto1").hide();
					$(".auto").hide();
					$(".complimentrary_management").hide();
					$('.paid_amount_cc').css("display","block");
					$('.paid_amount_cc_credit').css("display","none");
					$('.closetranscations').css("display","block");
					$('.closetranscations_whole').css("display","none");
                                        $("#transcationid").val("");
                                        $("#transbal").val("");
                                        $("#paidamount").val("");
                                        $('.credit_type').css("display","none");
                                        $("#balanceamout").val("");			 
                }
                  
 if(aat=="2"){
                    
        $('.refdiv_card').html('');
        var multibillnew16=$('.bill_history_active').attr("billno");
       
        var datast="set=change_bank_card&billno="+multibillnew16+"&mode=TA_HD_CS";
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
        url: "ta_bill_history.php",
        data: datastringnewmultinew16,
        success: function(data)
        {
          $(".trrefresh").load(location.href + " .trrefresh");
          $(".trrefresh1").load(location.href + " .trrefresh1");
      
        }
        });
    
         
                 var datastring = "billnoview="+multibillnew16;
                 $.ajax({
                 type: "POST",
                 url: "ta_bill_history.php",
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
					$('.paid_amount_cc').css("display","block");
					$('.paid_amount_cc_credit').css("display","none");
					$('.closetranscations').css("display","block");
					$('.closetranscations_whole').css("display","none");
                                        
                                        $("#transcationid").val("");
                                        $("#transbal").val("");
                                        $("#paidamount").val("");
                                        $("#balanceamout").val("");
                                        $('#multi_cardamount').focus();  
                                        $('.credit_type').css("display","none"); 
           
                                        
    }
    
    if(aat=="coupon"){
				        $(".cash_cc").hide();
                                        $(".credit_cc").hide();
					$(".credit_cc_normal").hide();
                                        $(".coupon_cc").show();
					$(".voucher_cc").hide();
					$(".cheque_cc").hide();
					$(".auto1").hide();
					$(".auto").hide();
					$(".complimentrary_management").hide();
					$('.paid_amount_cc').css("display","block");
					$('.paid_amount_cc_credit').css("display","none");
					$('.closetranscations').css("display","block");
					$('.closetranscations_whole').css("display","none");
    }
     if(aat=="voucher"){
     
		    $(".cash_cc").hide();
                    $(".credit_cc").hide();
		    $(".credit_cc_normal").hide();
                    $(".coupon_cc").hide();
					$(".voucher_cc").show();
					$(".cheque_cc").hide();
					$(".auto1").hide();
					$(".auto").hide();
					$(".complimentrary_management").hide();
					$('.paid_amount_cc').css("display","block");
					$('.paid_amount_cc_credit').css("display","none");
					$('.closetranscations').css("display","block");
					$('.closetranscations_whole').css("display","none");
      }
      if(aat=="cheque"){
					$(".cash_cc").hide();
                                        $(".credit_cc").hide();
					$(".credit_cc_normal").hide();
                                        $(".coupon_cc").hide();
					$(".voucher_cc").hide();
					$(".cheque_cc").show();
					$(".auto1").hide();
					$(".auto").hide();
					$(".complimentrary_management").hide();
					$('.paid_amount_cc').css("display","block");
					$('.paid_amount_cc_credit').css("display","none");
					$('.closetranscations').css("display","block");
					$('.closetranscations_whole').css("display","none");
    }
				
   if(aat=="6"){
					$(".cash_cc").hide();
                                        $(".credit_cc").hide();
					$(".credit_cc_normal").hide();
                                        $(".coupon_cc").hide();
					$(".voucher_cc").hide();
					$(".cheque_cc").hide();
					$(".auto1").hide();
					$(".auto").show();
					$(".complimentrary_management").hide();
					$('.paid_amount_cc').css("display","none");
					$('.paid_amount_cc_credit').css("display","block");
					$('.closetranscations').css("display","none");
					$('.closetranscations_whole').css("display","block");
                                        $("#selectcreditypes").val("");
                                        $('.credit_type').css("display","block");
    }
				
	if(aat=="7"){
					$(".cash_cc").hide();
                                        $(".credit_cc").hide();
					$(".credit_cc_normal").hide();
                                        $(".coupon_cc").hide();
					$(".voucher_cc").hide();
					$(".cheque_cc").hide();
					$(".auto").hide();
					$(".auto1").show();
					$(".complimentrary_management").hide();
					$('.paid_amount_cc').css("display","none");
					$('.paid_amount_cc_credit').css("display","none");
					$('.closetranscations').css("display","none");
					$('.closetranscations_whole').css("display","block");
                                         $('.credit_type').css("display","none");
                }
				
    if(aat=="comp_management"){
					$(".cash_cc").hide();
                                        $(".credit_cc").hide();
					$(".credit_cc_normal").hide();
                                        $(".coupon_cc").hide();
					$(".voucher_cc").hide();
					$(".cheque_cc").hide();
					$(".auto").hide();
					$(".auto1").hide();
					$(".complimentrary_management").show();
					$('.paid_amount_cc').css("display","none");
					$('.paid_amount_cc_credit').css("display","none");
					$('.closetranscations').css("display","none");
					$('.closetranscations_whole').css("display","block");
    }
				
           //});
        });
        
        
	});	
	
       </script> 
</head>

<body>
     <div style="display:none" class="confrmation_overlay_proce"></div>  
    <input type="hidden" id="decimal" value="<?=$_SESSION['be_decimal']?>" >
    <input type="hidden" id="focusedtext1" >
<div class="olddiv1 "></div>
<div class="container-fluid no-padding">
     <?php //include"includes/topbar.php"; ?>
      <?php include"includes/topbar_takeaway.php"; ?>
      <div class="middle_container">
      <div style="width:100%" class="top_site_map_cc ">
<input type="hidden" id="whatsapp_api_bill" value="<?=$_SESSION['s_sms_bill']?>">            	
               	
                
          <div class="bill_history_head" style="font-size: 16px ">Takeaway Bill History</div>
                
            <?php ///if(in_array("Take Away", $_SESSION['menumodarray'])){ ?>  
                <a href="<?php if(isset($_SESSION['timeopen']) && !isset($_SESSION['timeclose'])){ ?>take_away_.php  <?php }else {  ?>#<?php } ?>"><div class="bill_his_back_btn">Back</div></a>
                 <?php //} ?> 
                
                 <a href="<?php if (isset($_SESSION['timeopen']) && !isset($_SESSION['timeclose'])) { ?>bill_history.php  <?php } else { ?>#<?php } ?>"><div style="background-image: none;background-color: darkred;color: white;margin-left: 5px " class="bill_his_back_btn">DI BILL HISTOY</div></a>
                        <a href="<?php if (isset($_SESSION['timeopen']) && !isset($_SESSION['timeclose'])) { ?>cs_bill_history.php  <?php } else { ?>#<?php } ?>"><div style="background-image: none;background-color: darkred;color: white;margin-left: 5px " class="bill_his_back_btn">CS BILL HISTOY</div></a>
                
                 
                  <?php if(isset($_REQUEST['bilno'])) { ?>
                  <a href="total_ta_bill_history.php "><div style="margin-left:10px" class="bill_his_back_btn"> History</div></a>
                  <?php } ?>
                

                <div class="top_al_search_cc loaderror" ></div>
              
            </div>
                      
            
      		<div style="min-height:480px;width:100%" class="left_contant_container">
            	
                <div class="left_bill_history_contain">
                	<div class="bill_number_head">
                    <div style="float:left;width:50%;position: relative;">
        <?php
                     
        $sql_table_nos2="select * from tbl_branchmaster ";
        $sql_table2  =  $database->mysqlQuery($sql_table_nos2); 
        $num_table2  = $database->mysqlNumRows($sql_table2);
        if($num_table2){
	while($result_table2  = $database->mysqlFetchArray($sql_table2)) 
		{
            
            $authpaychng=$result_table2['be_auth_paymentchange'];
        }
        }
                    
                    
                    
                    
		$datev=explode("-",$_SESSION['date']);
		$sesdate=$datev[2]."-".$datev[1]."-".$datev[0];
                
	?>
                        
                         
                    <input type="hidden" name="datehid" id="datehid" value="<?=$sesdate?>">
                    <input type="hidden" name="authchnage" id="authchnage" value="<?=$authpaychng?>" > 
                    <input type="hidden" name="authorise_with_code" id="authorise_with_code" value="<?=$_SESSION['be_authorise_with_code']?>" />
                     <input type="hidden" name="hiddauthcancel" id="hiddauthcancel" value="<?=$_SESSION['be_bill_cancel_auth']?>" >
                    <input type="hidden" name="reprint_with_permission" id="reprint_with_permission" value="<?=$_SESSION['s_reprint_with_permission']?>" />
                    <input type="hidden" name="rprntmode" id="rprntmode" value="">
                    <span class="bill_his_fil_nam">Search Date</span>
                    <input value="<?=$today?>" type="text" id="datepicker" name="datepicker" style="color:#333;width: 43%;float: left;height: 26px;margin: 2px 0 0 7px;line-height: 27px;border-radius: 4px;border: 0;padding-left: 3px;font-size:14px" readonly onChange="datechange()">
                    <a class="updatestock update_billdetails" style="display:block;left: inherit;right: 0;top: 12px;"></a>
                  </div>
                    
                    
                    </div>
                      <div class="bill_history_details_table" >  
                      <table  style="width:100%">
                      	<tr>
                        	<th width="5%"><br><br>
			      Sl</th>
                            <th width=35%">
                                
    <select id="arc_year"  style="color:#333;width:31%;float: left;height: 26px;margin: 5px 0 0 -4%;line-height: 27px;border-radius: 4px;border: 0;padding-left: 0px;" >
                                 	
      <option value="" >Type</option>     
      
      <option value="normal"  <?php if($_SESSION['db_type']=="normal"){ ?> selected="selected" <?php } ?>  >Normal Year</option>          
             
        <?php if($_SESSION["archive_enabled"]=='Y'){ ?>
        <option value="archive"  <?php if($_SESSION['db_type']=="archive"){ ?> selected="selected" <?php } ?>  >Archieved Year</option>              
        <?php } ?>                  
                                        
    </select>    
                                
                                
                                
                            <input style="width:70%"  type="text" class="take_away_search_box" placeholder="Bill No" name="search_billno" id="search_billno" onKeyPress="validateSearch()" onKeyDown="validateSearch()" onKeyUp="validateSearch()">
                            Bill No</th>
                            <th width="13%">
                             <input type="text" class="take_away_search_box" placeholder="Name" name="search_name" id="search_name" onKeyPress="validateSearch()" onKeyDown="validateSearch()" onKeyUp="validateSearch()">
                              &nbsp; &nbsp; </th>
                            
                            <th width="15%">
                            <input type="text" class="take_away_search_box" placeholder="Number" name="search_no" id="search_no" onKeyPress="validateSearch()" onKeyDown="validateSearch()" onKeyUp="validateSearch()">
                            <span style="margin-left: -27px"> Name  &nbsp; &nbsp; &nbsp;  &nbsp; &nbsp; &nbsp;   </span>
                            </th>
                            
                            <th width="5%">
                                <input type="text" class="take_away_search_box" placeholder="Status" name="search_status" readonly onclick="this.removeAttribute('readonly');"    id="search_status" onKeyPress="validateSearch()" onKeyDown="validateSearch()" onKeyUp="validateSearch()">
                                <span style="margin-left: 0px">Number   </span></th>
                            <th width="12%">
                                
                                <select class="take_away_search_box" onchange="validateSearch()" id="search_mode_new" >
                                    <option value="">ALL</option>
                                    <option value="TA">TA</option>
                                    <option value="HD">HD</option>
                                </select>
                                &nbsp; &nbsp; &nbsp; &nbsp; 
                            </th>
                            
                            <th width="12%">
                               <select class="take_away_search_box" onchange="validateSearch()" id="search_partner_new" >
                                    <option value="">ALL</option>
                                    <?php
                                    $sql_bilhis1= "Select * from tbl_online_order where tol_status='Y' ";
						$sql_bilhistory  =  $database->mysqlQuery($sql_bilhis1); 
						$num_bilhistory  = $database->mysqlNumRows($sql_bilhistory);
						if($num_bilhistory)
						{$i=1;
							while($result_bilhistory1  = $database->mysqlFetchArray($sql_bilhistory)) 
								{ 
                                                            ?>
                                      <option value="<?=$result_bilhistory1['tol_id']?>"><?=$result_bilhistory1['tol_name']?></option>
                                    <?php
                                                } } 
                                                ?>
                                </select>  
                                
                                <span style="margin-left: -21px">Status  &nbsp; &nbsp; &nbsp; </span>
                            
                            </th>
                            
                            
                            <th width="8%">
                                
        <select class="take_away_search_box" onchange="validateSearch()" id="paymode_search" >
        <option value="">ALL</option>
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
                                
                                
                  <span style="margin-left: 0px">Paymode</span>
                                
                                </th>
                            
                        </tr>
                      </table>  
                          
                      <div id="ta_billlisttotal" class="left_detail_scroll">
                		<table class="new_fnt" width="100%"  border="0"> <!----bill_history_active--->
                        <?php
                                    $billno123="";
                                    if(isset($_REQUEST['bilno'])){
                                        $billno123=$_REQUEST['bilno'];
                                    }
                        
                                    
						$sql_bilhis= "Select tb.tab_paymode,tb.tab_billno,tb.tab_dayclosedate,tb.tab_name,tb.tab_phone, ts.tac_customername,ts.tac_contactno,tb.tab_status  From tbl_takeaway_billmaster as tb LEFT JOIN tbl_takeaway_customer ts ON ts.tac_customerid=tb.tab_hdcustomerid Where tb.tab_dayclosedate ='".$_SESSION['date']."' AND tab_mode <> 'CS' AND tb.tab_billno not like 'Temp%' AND tb.tab_billno not like 'HOLD%' ORDER BY   tb.tab_date,tb.tab_time DESC ";
						//$sql_bilhis="select tab_billno,	tab_customername,tab_status,tab_customermobile,tab_status  from tbl_takeaway_billmaster WHERE 	tab_dayclosedate='".$_SESSION['date']."' ORDER BY 	tab_date,tab_time DESC";
						$sql_bilhistory  =  $database->mysqlQuery($sql_bilhis); 
						$num_bilhistory  = $database->mysqlNumRows($sql_bilhistory);
						if($num_bilhistory)
						{$i=1;
							while($result_bilhistory  = $database->mysqlFetchArray($sql_bilhistory)) 
								{   $cur_date= $_SESSION['date'];
									?><!--bill_history_number-->
                             <tr class="ta_bill_history <?php if($result_bilhistory['tab_status']=='Cancelled'){ ?> bill_history_cancel <?php } ?> <?php if($result_bilhistory['tab_billno']==$billno123){ ?> bill_history_active <?php } ?>" cur_date="<?=$cur_date?>" billdate="<?= $result_bilhistory['tab_dayclosedate'] ?>" user="<?= $_SESSION['designtnname']?>"    billno="<?=$result_bilhistory['tab_billno']?>" id="<?=$result_bilhistory['tab_billno']?>" cancelstatus="<?=$result_bilhistory['tab_status']?>" >
                             <td width="8%"><strong><?=$i++?></strong></td>
                             <td width="27%"><?=$result_bilhistory['tab_billno']?></td>
                             <td width="31%"><?=$result_bilhistory['tab_name']?></td>
                             <td width="20%"><?=$result_bilhistory['tab_phone']?></td><!--Delivered-->
                             <td width="14%" style="font-size: 8px;font-weight: bold"><span  class="<?php if($result_bilhistory['tab_status']=='Delivered') { ?> deliverd_1 <?php } else if($result_bilhistory['tab_status']=='Closed') { ?> closed_1 <?php } else if($result_bilhistory['tab_status']=='Packed') { ?> packed_clr <?php } else if($result_bilhistory['tab_status']=='Generated') { ?> genrate_clr<?php }  else if($result_bilhistory['tab_status']=='KOT_Generated') { ?> kot_genrated_clr<?php } else if($result_bilhistory['tab_status']=='Assigned') { ?> assigned_clr<?php } ?>"><?=$result_bilhistory['tab_status']?></span></td><!--kot_genrated_clr-->
                          
        <?php    
        
        $paymode='';   
        $sql_listall2  =  $database->mysqlQuery("SELECT pym_name from  tbl_paymentmode where pym_id='".$result_bilhistory['tab_paymode']."' limit 1 "); 
	$num_listall2  = $database->mysqlNumRows($sql_listall2);
	if($num_listall2){ 
	 while($row_listall2  = $database->mysqlFetchArray($sql_listall2)) 
	 {
           if($row_listall2['pym_name']=='Credit / Debit'){
                $paymode='Card';
             }else if($row_listall2['pym_name']=='Complimentary'){
               $paymode='Comp';   
             }else if($row_listall2['pym_name']=='Credit Types'){
               $paymode='Credit';     
             }else{
                $paymode=$row_listall2['pym_name']; 
             }
            
            
            
        }}
         ?>
                          
                <td width="14%" style="font-size: 8px;font-weight: bold"><?=$paymode?></td> 
                            
                            </tr>
                           <?php } } ?>
                           
                         </table> 
                         </div>
              </div><!--bill_history_details_table---> 
                   
                </div><!--left_bill_history_contain-->
                
                <div class="bill_history_center_bill" style="position:relative;">
                <div class="bill_number_head">
                    
                    
                    <span style="margin-left: -120px;"> <?= $_SESSION['bill_history_order_details'] ?> </span>         
                        
                        <div class="col-xs-1 no-padding"  style="width:20%" >
                            <a href="#" id="a4_view"  onclick="return a4_view();"><span style="margin-top:3px;height: 24px;margin-left: 3px;background-color: #205a58"  class="history-sub-btn">A4 | PDF</span></a>
		        </div>
                            
                        <div class="col-xs-1 no-padding"  style="width:20%" >
                            <a href="#" id="whatsapp_view"  onclick="return whatsapp_view();"><span style="margin-top:3px;height: 24px;margin-left: 3px;background-color: #205a58"  class="history-sub-btn">SHARE</span></a>
		        </div>    
                
                
                
                </div>
                      
                            <div class="bill_his_order_detail_head">
                                <table style="width:99%" class=" " border="0">
                                  <tr>
                                     <td width="5%">Sl</td>
                                    <td width="38%">Item Name</td>
                                    <td width="18%">Unit</td>
                                    <td width="9%">Qty</td>
                                      <td width="12%">Rate</td>
                                      <td width="15%">Edit</td>
                                      
                                  </tr>
                                </table> 
                            </div>
                 
                        
                     <div class="bill_history_orderd_cont" id="billdetailsset2">
                    	
                        <?php if(isset($_REQUEST['bilno'])) { 
						
						
	
	$billno=$_REQUEST['bilno'];
	$total=0;
	//`tbl_takeaway_billdetails`(`tab_billno`, `tab_slno`, `tab_menuid`, `tab_portion`, `tab_qty`, `tab_preferencetext`, `tab_rate`, `tab_amount`, `tab_status`, `tab_modifieduser`, `tab_packedtime`) 
	//echo "SELECT * from tbl_takeaway_billdetails as bd LEFT JOIN tbl_menumaster as mn 	ON bd.tab_menuid=mn.mr_menuid LEFT JOIN tbl_portionmaster as pm ON bd.tab_portion=pm.pm_id WHERE bd.tab_billno='".$billno."' order by bd.tab_slno";
	 $sql_listall  =  $database->mysqlQuery("SELECT *,mn.mr_menuid,mn.mr_menuname from tbl_takeaway_billdetails as bd LEFT JOIN tbl_menumaster as mn 	ON bd.tab_menuid=mn.mr_menuid LEFT JOIN tbl_portionmaster as pm ON bd.tab_portion=pm.pm_id WHERE bd.tab_billno='".$billno."' order by bd.tab_slno "); 
	$num_listall  = $database->mysqlNumRows($sql_listall);
	if($num_listall){$i=1;
		  while($row_listall  = $database->mysqlFetchArray($sql_listall)) 
			  {
				 $total=$total + $row_listall['tab_amount'];
                                 $tabillhistory_menuname=$row_listall['mr_menuname'];
                                 if($_SESSION['main_language']!='english'){
                
                                $sql_arabmenu=$database->mysqlQuery("SELECT lm_menu_name FROM tbl_language_menu_master left join tbl_languages on ls_id=lm_language_id WHERE lm_menu_id='".$row_listall['mr_menuid']."' and ls_language='".$_SESSION['main_language']."'");

                                //echo " SELECT mm_name FROM tbl_language_menu_sub left join tbl_languages on ls_id=mm_lang_id WHERE mm_sub_category_id='".$result_subcat['subid']."' and ls_language='".$dat."'";
                                $num_arabmenu = $database->mysqlNumRows($sql_arabmenu);
                                $result_arabmenu = $database->mysqlFetchArray($sql_arabmenu);
                                $tabillhistory_menuname=$result_arabmenu['lm_menu_name'];
                                // $catid['name'][] = $catname;
                                //echo $catname;
                                }
//                                 $ordermenu_id=trim(json_encode($row_listall['mr_menuid']),'""');
//                                $fp_takeaway_menu=fopen($apilink."/src/takeaway_api.php?set=takeaway_menuname&menuid=$ordermenu_id&subid=&maincat=&mainlang=$other_lang&dateopen=&listimage=&floorid=","r");
//                                $response_takeaway_menu['messages'] = stream_get_contents($fp_takeaway_menu);
//                                //var_dump($response_takeaway_menu);
//                                $resu_takeaway_menu= json_decode($response_takeaway_menu['messages'],true);
//                                $takeaway_menu_count=count($resu_takeaway_menu['menuid']);
                                 
                                 
				 ?>
                 
                 <div class="right_bill_history_detail tr_clone" qtyval="<?=$row_listall['tab_qty'] ?>" slno="<?=$row_listall['tab_slno'] ?>" name="tr_clone">
                 <input type="hidden" value="<?=$row_listall['tab_qty'] ?>" class="tr_clone_add1<?=$row_listall['tab_slno'] ?>">
                        <div style="width: 12%;"  class="bil_his_sl_no slmyno">
                    <?php if($_SESSION['s_canceleachinhistory']=="Y"){ ?>
                    		<a class="canceleachitem bill_history_close_btn" billno="<?=$billno ?>" slno="<?=$row_listall['tab_slno'] ?>" style="cursor:pointer">X</a>
                        <?php } ?>
                    
                    	<!--<a style="background-color:transparent;top: -2px; position: relative;" class="bill_history_close_btn"><img src="img/black_cross.png"></a>-->
						<?=$i++;?>
                    </div>
                    <div class="bil_his_dish_name" style="width: 45%"><?=$tabillhistory_menuname ?></div>
                    <div style="width: 20%;font-size: 12px;" class="bil_his_sl_no"><?=$row_listall['pm_portionname'] ?></div>
                    <div style="width: 9%;" class="bil_his_sl_no">
                    	<?php //if($row_listall['bd_cancelled']=='N'){ ?>
						
                       <!-- <input type="text" value="<?=$row_listall['bd_qty'] ?>" style="width: 38px;text-align: center; color:#000;    height: 23px;" class="tr_clone_add" >-->
                        <?php //}else{ 
                        echo $row_listall['tab_qty']; 
                         //} ?>
                    </div>
                    <div class="bil_his_sl_no"><?=number_format($row_listall['tab_rate'],$_SESSION['be_decimal']) ?> 
						<span style="color:#F00"> <?php //if($row_listall['bd_cancelled']=='Y')echo "*"; ?></span>
                    </div>
                    
                </div><!--right_bill_history_detail-->
                <div class="locate<?=$row_listall['tab_slno'] ?>"></div>
                
                 <?php
			  }
	}else
	{
		echo "Nothing to display";

	}
	?>
     <script src="js/bill_ta_historycanceleach.js"></script>
   
    
    <?php

							
		}
                
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
                        
                        
                        
                    </div><!--bill_history_orderd_cont-->
                    
                   <!-- <div class="bill_his_buton_cc">
                    	<div class="bill_cancel_btn" id="reprintbill"><a href="#">Reprint</a></div>
                        <div style="right:2%;left:0;background-image:url(img/cancel_bill.png)" class="bill_cancel_btn" id="cancelbill"><a href="#">Cancel</a></div>
                    </div>--><!--bill_his_buton_cc-->
                    
                    
                     <div style="position:relative;background-color:#191919" class="bill_number_head">SETTLEMENT DETAILS
                         
                         
                       
                         <div class="pay_change_button changesetledetils" mode="TA" style="height:26px;line-height: 26px;position: absolute">Change</div>
                    
                         
                       </div>
                       <div class="settle_ment_change_history settlementdetails" style="position:relative;">
                     <?php if(isset($_REQUEST['bilno'])) {
						  
$paymode='';
$bm_amountpaid='';
$bm_amountbalace='';
$bm_transactionamount='';
$bm_couponcompany='';
$bm_couponamt='';
$bm_vouchername='';
$bm_vouchercost='';
$bm_chequeno='';
$bm_chequebankname='';
$bm_chequebankamount='';
$bm_name='';
$payid='';
$total='';
//`tbl_takeaway_billmaster`(`tab_billno`, `tab_date`, `tab_time`, `tab_branchid`, `tab_subtotal`, `tab_servicecharge`, `tab_netamt`, `tab_kotno`, `tab_hd`, `tab_customername`, `tab_customermobile`, `tab_hdcustomerid`, `tab_status`, `tab_assignedto`, `tab_esttime`, `tab_assignedtime`, `tab_paymode`, `tab_cancelamount`, `tab_discountid`, `tab_corporatecode`, `tab_discountvalue`, `tab_vat`, `tab_complimentary`, `tab_complimentaryremark`, `tab_amountpaid`, `tab_amountbalace`, `tab_transactionamount`, `tab_voucherid`, `tab_couponcompany`, `tab_couponamt`, `tab_chequeno`, `tab_chequebankname`, `tab_chequebankamount`, `tab_dayclosedate`, `tbl_takeaway_printed`, `tbl_takeaway_print_time`)
	$sql_billhis="select *  from tbl_takeaway_billmaster as bm LEFT JOIN  tbl_paymentmode as pm ON bm.tab_paymode=pm.pym_id LEFT JOIN tbl_bankmaster as bk ON bk.bm_id=bm.tab_transcbank WHERE bm.tab_billno='".$_REQUEST['bilno']."'";
	//echo "select *  from tbl_takeaway_billmaster as bm LEFT JOIN  tbl_paymentmode as pm ON bm.tab_paymode=pm.pym_id LEFT JOIN tbl_bankmaster as bk ON bk.bm_id=bm.tab_transcbank LEFT JOIN tbl_vouchermaster as vm ON vm.vr_voucherid=bm.tab_voucherid WHERE bm.tab_billno='".$_REQUEST['bilno']."'";
        
        
        $sql_billhistory  =  $database->mysqlQuery($sql_billhis); 
	$num_billhistory  = $database->mysqlNumRows($sql_billhistory);
	if($num_billhistory)
	{
		while($result_billhistory  = $database->mysqlFetchArray($sql_billhistory)) 
			{
				$paymode=$result_billhistory['pym_name'];
				$payid=$result_billhistory['tab_paymode'];
				if( $paymode=="Cash")
				{
				$bm_amountpaid=$result_billhistory['tab_amountpaid'];
				$bm_amountbalace=$result_billhistory['tab_amountbalace'];
				}else if( $paymode=="Credit / Debit")
				{
					$bm_amountpaid=$result_billhistory['tab_amountpaid'];
					$bm_amountbalace=$result_billhistory['tab_amountbalace'];
					$bm_transactionamount=$result_billhistory['tab_transactionamount'];
					$bm_name=$result_billhistory['bm_name'];
					
				}
				else if( $paymode=="Coupons")
				{
					$bm_amountpaid=$result_billhistory['tab_amountpaid'];
					$bm_amountbalace=$result_billhistory['tab_amountbalace'];
					$bm_couponcompany=$result_billhistory['tab_couponcompany'];
					$bm_couponamt=$result_billhistory['tab_couponamt'];
					
				}else if( $paymode=="Voucher")
				{
					$bm_amountpaid=$result_billhistory['tab_amountpaid'];
					$bm_amountbalace=$result_billhistory['tab_amountbalace'];
					$bm_vouchername=$result_billhistory['vr_vouchername'];
					$bm_vouchercost=$result_billhistory['vr_vouchercost'];
					
				} else if( $paymode=="Cheque")
				{
					$bm_amountpaid=$result_billhistory['tab_amountpaid'];
					$bm_amountbalace=$result_billhistory['tab_amountbalace'];
					$bm_chequeno=$result_billhistory['tab_chequeno'];
					$bm_chequebankname=$result_billhistory['tab_chequebankname'];
					$bm_chequebankamount=$result_billhistory['tab_chequebankamount'];
					
				} 
                                
				$total=$result_billhistory['tab_netamt'];
				
			}
	}
?>
 			<table width="100%" class="none_border_table final_net"  tot="<?=$total?>"  style="border-bottom:1px #ccc solid;">
                         <tr>
                            <td width="18%"><strong>Payment Mode</strong></td>
                            <td width="35%" class="paymentids" payid="<?=$payid ?>"><?=$paymode?></td>
                         </tr> 
                        
                         </table>
                         <table width="100%" class="none_border_table" style="border-bottom:1px #ccc solid;">
                         
                          <tr>
                            <td width="18%"><strong>Amount</strong></td>
                            <td width="35%" class="totalamt" amttot="<?= $total?>"><?=$total?></td>
                         </tr> 
                         </table>
                      <div class="settle_ment_detail_paid_cc">     
                         <table width="100%" class="none_border_table" border="0">
                        <tr>
                            <td width="33%"><span class="bill_story_center_top_txt">Amount Paid:</span>
                            <span class="bill_story_center_txt" ><?=$bm_amountpaid?>/-</span>
                            <input type="hidden"  id="amt_ta"  value="<?=$bm_amountpaid?>" >
                            </td>
                             <td width="33%"><span class="bill_story_center_top_txt">Balance Amount:</span>
                            <span class="bill_story_center_txt"><?=$bm_amountbalace?>/-</span>
                            </td>
                          </tr>
                         <?php if( $paymode=="Credit / Debit")
							{ ?> 
                          <tr>
                            <td width="33%"><span class="bill_story_center_top_txt">Transaction Amount:</span>
                            <span class="bill_story_center_txt tr_ta"><?=$bm_transactionamount?>/-</span>
                            </td>
                             <td width="33%"><span class="bill_story_center_top_txt">Transaction Bank:</span>
                            <span class="bill_story_center_txt"><?=$bm_name?></span>                            
                            </td>
                          </tr>
                     <?php } ?> 
                      <?php if( $paymode=="Coupons")
							{ ?> 
                          <tr>
                            <td width="33%"><span class="bill_story_center_top_txt">Coupon Name:</span>
                            <span class="bill_story_center_txt"><?=$bm_couponcompany?></span>
                            </td>
                             <td width="33%"><span class="bill_story_center_top_txt">Coupon Amount:</span>
                            <span class="bill_story_center_txt"><?=$bm_couponamt?></span>                            
                            </td>
                          </tr>
                     <?php } ?>    
                    
                     <?php if( $paymode=="Voucher")
							{ ?> 
                          <tr>
                            <td width="33%"><span class="bill_story_center_top_txt">Voucher Name:</span>
                            <span class="bill_story_center_txt"><?=$bm_vouchername?></span>
                            </td>
                             <td width="33%"><span class="bill_story_center_top_txt">Voucher Cost:</span>
                            <span class="bill_story_center_txt"><?=$bm_vouchercost?></span>                            
                            </td>
                          </tr>
                     <?php } ?> 
                    
                     <?php if( $paymode=="Cheque")
							{ ?> 
                          <tr>
                            <td width="33%"><span class="bill_story_center_top_txt">Cheque No:</span>
                            <span class="bill_story_center_txt"><?=$bm_chequeno?>/-</span>
                            </td>
                             <td width="33%"><span class="bill_story_center_top_txt">Bank Name:</span>
                            <span class="bill_story_center_txt"><?=$bm_chequebankname?></span>                            
                            </td>
                            </tr>
                             <tr>
                            <td width="33%"><span class="bill_story_center_top_txt">Cheque Amount:</span>
                            <span class="bill_story_center_txt"><?=$bm_chequebankamount?></span>                            
                            </td>
                          </tr>
                     <?php } ?>     
                        </table>  
            		</div>
<?php

						 
					 } ?>
                    
                </div><!--settle_ment_change_history-->	
                                        
            	</div><!--bill_history_center_bill-->
                
                <div id="bill" class="bill_history_right_detail">
                	
                   <div class="bill_number_head">Bill Details</div>
                    
                	<div style="padding:1%;" class="bill_history_details_table" id="detailsset1_ta">
                    
                    <?php if(isset($_REQUEST['bilno'])) { 
					
					
	
	$billno=$_REQUEST['bilno'];
	//`tbl_takeaway_billmaster`(`tab_billno`, `tab_date`, `tab_time`, `tab_branchid`, `tab_subtotal`, `tab_servicecharge`, `tab_netamt`, `tab_kotno`, `tab_hd`, `tab_customername`, `tab_customermobile`, `tab_hdcustomerid`, `tab_status`, `tab_assignedto`, `tab_esttime`, `tab_assignedtime`, `tab_paymode`, `tab_cancelamount`, `tab_discountid`, `tab_corporatecode`, `tab_discountvalue`, `tab_vat`, `tab_complimentary`, `tab_complimentaryremark`, `tab_amountpaid`, `tab_amountbalace`, `tab_transcbank`, `tab_transactionamount`, `tab_voucherid`, `tab_couponcompany`, `tab_couponamt`, `tab_chequeno`, `tab_chequebankname`, `tab_chequebankamount`, `tab_dayclosedate`, `tbl_takeaway_printed`, `tbl_takeaway_print_time`, `tab_mode`)
	$bm_billno='';
	$bm_dayclosedate='';
	$bm_billtime='';
	$bm_finaltotal='';
	$bm_serv='';
	$bm_billprinted='';
	$bm_lastprintime='';
	$bm_status='';
	$bm_name='';
	$bm_mode='';
	
	$bm_esttime='';
	$bm_customername ='';
	$bm_customermobile ='';
	$bm_address='';
	$bm_landmark='';	
	$bm_area='';
					
	$mode='';
	 $sql_billhis="select *  from tbl_takeaway_billmaster as bm LEFT JOIN tbl_staffmaster as sm ON sm.ser_staffid=bm.tab_assignedto LEFT JOIN tbl_takeaway_customer as ts ON ts.tac_customerid=bm.tab_hdcustomerid WHERE bm.tab_billno='".$billno."'";
	$sql_billhistory  =  $database->mysqlQuery($sql_billhis); 
	$num_billhistory  = $database->mysqlNumRows($sql_billhistory);
	if($num_billhistory)
	{
		while($result_billhistory  = $database->mysqlFetchArray($sql_billhistory)) 
			{
				$bm_billno=$result_billhistory['tab_billno'];
				//$bm_dayclosedate=$result_billhistory['bm_dayclosedate'];
				$bm_billtime=$result_billhistory['tab_time'];
				$bm_finaltotal=$result_billhistory['tab_netamt'];
				$bm_serv=$result_billhistory['tab_servicecharge'];
				$bm_billprinted=$result_billhistory['tbl_takeaway_printed'];
				$bm_lastprintime=$result_billhistory['tbl_takeaway_print_time'];
				$bm_status=$result_billhistory['tab_status'];
				 $bm_name=$result_billhistory['ser_firstname'];
				$bm_esttime=$result_billhistory['tab_esttime'];
				$bm_mode=$result_billhistory['tab_mode'];
				if($bm_mode=="HD") $mode="Home Delivery";
				else if($bm_mode=="CS") $mode="Counter Sales";
				else if($bm_mode=="TA") $mode="Take Away";
				//$bm_totpax=$result_billhistory['bm_totalpax'];
				$bm_subtotal=$result_billhistory['tab_subtotal'];
				$bm_dayclosedate=$database->convert_date($result_billhistory['tab_dayclosedate']);
				
				$bm_customername =$result_billhistory['tac_customername'];
				$bm_customermobile =$result_billhistory['tac_contactno'];
				$bm_address=$result_billhistory['tac_address'];
				$bm_landmark=$result_billhistory['tac_landmark'];	
				$bm_area=$result_billhistory['tac_area'];
					
			}
	}
	?>
  
    <table width="100%" class="none_border_table" border="0">
      <tr>
        <td width="50%" colspan="2"><strong class="bill_story_center_top_txt">Bill No:</strong>
        <span class="bill_story_center_txt" style="color:#AB2426"><strong><strong><?=$bm_billno?></strong></strong></span>
        </td>
         <td width="50%"  ><strong class="bill_story_center_top_txt">Date:</strong>
        <span class="bill_story_center_txt" ><?=$bm_dayclosedate?></span>
        </td>
      </tr>  
    <tr>
    <tr>
         <td width="33%"><span class="bill_story_center_top_txt">Time:</span>
        <span class="bill_story_center_txt"><?=$bm_billtime?></span>
        </td>
        <td width="33%"><span  class="bill_story_center_top_txt">Type:</span>
        <span class="bill_story_center_txt"><?=$mode?></span>
        </td>
         <td width="33%"><span class="bill_story_center_top_txt"><strong>Status:</strong></span>
        <span class="bill_story_center_txt"><strong><?=$bm_status?></strong></span>
        </td>
      </tr>
       <tr>
        <td width="33%"><span class="bill_story_center_top_txt">Sub total</span>
        <span class="bill_story_center_txt" style="color:#AB2426"><?=$bm_subtotal?></span>
        </td>
        <td width="33%"><span class="bill_story_center_top_txt">Service Charge:</span>
        <span class="bill_story_center_txt"><?=$bm_serv?></span>
        </td>
         <td width="33%"><span class="bill_story_center_top_txt"><strong>Net Amount:</strong></span>
        <span class="bill_story_center_txt"><strong><?=$bm_finaltotal?></strong></span>
        </td>
      </tr>
      <tr>
         <td width="33%"><span class="bill_story_center_top_txt">Bill Printed:</span>
        <span class="bill_story_center_txt"><?=$bm_billprinted?></span>
        </td>
        <td width="33%"><span  class="bill_story_center_top_txt">Last Printed Time:</span>
        <span class="bill_story_center_txt"><?=$bm_lastprintime?></span>
        </td>
        
       
      </tr> 
      <?php if($bm_name!='') { ?>
      <tr>
        <td width="33%"><span class="bill_story_center_top_txt">Assigned to:</span>
        <span class="bill_story_center_txt"><?=$bm_name?></span>
        </td>
         <td width="33%"><span class="bill_story_center_top_txt">Estimated Time:</span>
        <span class="bill_story_center_txt"><?=$bm_esttime?></span>
        </td>
       
      </tr>
      <?php } ?>
       <tr>
        <td width="33%"><span class="bill_story_center_top_txt">Customer Name</span>
        <span class="bill_story_center_txt" style="color:#AB2426"><?=$bm_customername?></span>
        </td>
        <td width="33%"><span class="bill_story_center_top_txt">Customer Mobile:</span>
        <span class="bill_story_center_txt"><?=$bm_customermobile?></span>
        </td>
         <td width="33%"><span class="bill_story_center_top_txt">Address:</span>
        <span class="bill_story_center_txt"><?=$bm_address?></span>
        </td>
      </tr>
       <tr>
        <td width="33%"><span class="bill_story_center_top_txt">LandMark</span>
        <span class="bill_story_center_txt" style="color:#AB2426"><?=$bm_landmark?></span>
        </td>
        <td width="33%"><span class="bill_story_center_top_txt">Area:</span>
        <span class="bill_story_center_txt"><?=$bm_area?></span>
        </td>
         
      </tr>
     
      
      
       
     </table>
    
    
   
  
     
    
    <?php
	
	


					
					} ?>
                    
                    	
                    </div><!--bill_history_details_table-->
                    
                </div><!--bill_history_right_detail-->
                
                
                 <div id="settlement" class="bill_history_right_detail" style="display:none;position:relative;">
                	
                   <div class="bill_number_head">Change Settlement <div style="background-color:transparent;text-align: right;height:24px" class="pay_change_button close_settle"><img src="img/close_ico.png"></div></div>
                    
                	<div class="bill_history_details_table" >
                    
                    	<div class="take_staff_view_cont_cc">
                          <div class="payment_pend_right_cash_head">
                              <div class="payment_pend_right_cash_head_txt">Cash Settle</div>
                              <div class="payment_pend_right_cash_error"></div>
                          </div>
                      
                          <div style="border-bottom:1px #ccc solid;height:48px;margin-top:0;" class="discount_text_box paymentclose">
                              <table class="tax_table" width="100%" border="0" cellspacing="5">
                                  <tbody>
                                      <tr>
                                          <td width="45%">Select Payment</td>
                                          <td width="5%">:</td>
                                          <td width="50%">
                                              <select style="width:100%;" class="discount_text_box tax_textbox pay_check_new" id="payemntmode_sel">
                                                  <?php
												  $sql_ds_nos="select * from tbl_paymentmode WHERE pym_changesettled_view='Y'";
												  $sql_ds  =  $database->mysqlQuery($sql_ds_nos); 
												  $num_ds = $database->mysqlNumRows($sql_ds);
												  if($num_ds){ $i=1;
												   while($result_ds = $database->mysqlFetchArray($sql_ds)) 
														  { ?>
														  <option  value="<?=$result_ds['pym_id']?>" idval="<?=$result_ds['pym_id']?>" <?php if($i==1){ ?> selected <?php } ?> ><?=$result_ds['pym_name']?></option>
													  <?php $i++;} }  ?>
                                              </select>
                                          </td>
                                      </tr>
                      
                                  </tbody>
                              </table>
                          </div><!--discount_tax_textbox-->
                          <div class="credit_cc_normal" style="display: none;">
                            <div class="discount_text_cc crd_head">Credit / Debit</div>
                            	<table class="tax_table" width="100%" border="0" cellspacing="5">
                              <tbody>
                              <tr>
                                <td width="35%" style="display: none;">Transaction Bank</td>
                                <td width="5%" style="display: none;">:</td>
                                <td width="50%" style="display: none;"><div class="discount_text_box paymod_text_box">
                                        <select id="bankdetails" class=" discount_text_box ">
                                           
                                     <?php
					$sql_ds_nos="select * from tbl_bankmaster where bm_active='Y' ";
					$sql_ds  =  $database->mysqlQuery($sql_ds_nos); 
					$num_ds = $database->mysqlNumRows($sql_ds);
					if($num_ds){ 
					while($result_ds = $database->mysqlFetchArray($sql_ds)) 
					{
					?>    
                                            
                                        <option value="<?=$result_ds['bm_id']?>"><?=$result_ds['bm_name']?></option>
                                     
                                        <?php } } 
                                      
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
                                            <div class="card_detail_popup_type_text"> Last 4 Digits in Card</div>
                                          </div> 
                                          <div class="card_detail_popup_type" style="width:18%;margin-left:1%">
                                            <div class="card_detail_popup_type_text">Amount</div>
                                         </div> 
                                        
                                         <div class="card_detail_popup_type" style="width:30%;margin-left:1%">
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
                                            <input type="text" class="card_type_dropdwn amountall" id="multi_cardamount" value="" name="multi_cardamount" onkeypress="return enter_plus(event)" onkeyup="return cardsum()" onclick="return cardsum()" onchange="return cardsum()" autocomplete="off">
                                        </div>
                                        
                                        <div class="card_detail_popup_type" style="width:30%;margin-right:1%">
                                            <select class="card_type_dropdwn bankselect_new" id="multibanktype" >
                                        
                                                  <?php
                                                $sql_rsn1 = "select * from tbl_bankmaster where bm_active = 'Y'";
                                                $sql_rsns1 = $database->mysqlQuery($sql_rsn1);
                                                $num_rsns1 = $database->mysqlNumRows($sql_rsns1);
                                                if ($num_rsns1) {
                                                    while ($result_rsns1 = $database->mysqlFetchArray($sql_rsns1)) {
                                                            ?>
                                                 
                                                      <option value="<?= $result_rsns1['bm_id']?>"><?= $result_rsns1['bm_name']?></option>
                                                                     <?php  }} ?>
                                             </select>
                                        </div>
                                        
                                       
<!--                                        <div style="margin-top:0px;width: 12%;height: 34px;margin-top: -1px;float: right"  class="menut_add_bq_btn " onclick="return del();">-</div>-->
                                        
                                    </div>
                               </div>     
                          <input type="hidden" value="" id="countload">
                               
                <div style="margin-top:0px;width: 12%;height: 34px;margin-top: -40px;float: right" class="menut_add_bq_btn plusbtn" onclick="return plus();">+</div>     
                        
                                </div>
                              
                          
                               <tr>
                                   
                                <td width="35%">Transaction Amount</td>
                                <td width="5%">:</td>
                                
                                
                                <td width="50%"><div class="discount_text_box paymod_text_box trrefresh">
                                        
                                        <?php
                                        $totalcardbill4="";
                                                   $sql_rsnrate4 = "select sum(mc_cardamount) as totamount from tbl_bill_card_payments where (mc_billno = 'temp_".$_SESSION['billcardbhta']."' or mc_billno = '".$_SESSION['billcardbhta']."')   ";
                                          //  echo "select sum(mc_cardamount) as totamount from tbl_bill_card_payments where mc_billno = '".$_SESSION['billcard6']."'";
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
                                                  
                                                    
                                                    $totalcardbill74="";
                                                    $sql_rsnrate74 = " select tab_netamt from tbl_takeaway_billmaster where tab_billno = '".$_SESSION['billcardbhta']."'";
                                          //  echo "select sum(mc_cardamount) as totamount from tbl_bill_card_payments where mc_billno = '".$_SESSION['billcard6']."'";
                                           $sql_rsns1rate74 = $database->mysqlQuery($sql_rsnrate74);
                                                $num_rsns1rate74 = $database->mysqlNumRows($sql_rsns1rate74);
                                                if ($num_rsns1rate74) {
                                                    while ($result_rsns1rate74 = $database->mysqlFetchArray($sql_rsns1rate74)) {
                                                        if($result_rsns1rate74['tab_netamt']!=""){
                                                        $totalcardbill74=  number_format($result_rsns1rate74['tab_netamt']-$totalcardbill4,$_SESSION['be_decimal']);
                                                        }else{
                                                            $totalcardbill74="0";
                                                        }
                                                    }
                                                    
                                                    }
                                                    
                                                    
                                                  ?>
                                        
                                        
                                        <input  placeholder="Enter Transaction Amount" class="tax_textbox transa_txt" value="<?=number_format($totalcardbill4,$_SESSION['be_decimal'])?>" name="transcationid" id="transcationid" onChange="transamountchange()" onkeyup="transamountchange()" onfocus="transamountchange()" onchange="transamountchange()"   readonly  >
                                    </div></td>
                              </tr>
                              <tr>
                                <td width="45%">Balance to Pay</td>
                                <td width="5%">:</td>
                                <td width="50%"><div class="discount_text_box paymod_text_box trrefresh1">
                                        
                                         <input  placeholder="Balance" class="tax_textbox transa_txt" name="transbal" id="transbal" value="<?=$totalcardbill74?>" readonly>
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
                            
                            
                            
                            
                             <div style="display:none;margin-top:10px" class="complimentrary_cc auto1" >
                             <div class="discount_text_cc crd_head">Complimentary</div>
                                  <textarea style="margin-top:20px"   placeholder="Enter Remarks"  class="room_textarea" name="completext" id="completext"></textarea>
                            </div><!--complimentrary_cc-->
                            
                            
                            <div style="display:none" class="complimentrary_management " >
                            <div class="discount_text_cc crd_head">Complimentary Management</div>
                            
                            
                            <div class="crd_select_head_cc">
                                      <span style="width: 20%" class="room_no_txt">Staff :</span>
                                      <span style="width: 78%;float: left" class="room_text_box_cc">
                                         <select  class="staff_menu_select" name="selectstafcomp" id="selectstafcomp">
                                          <option value="">Select</option>
                                              <?php
											  
										  $sql_ds_nos="select sm.ser_firstname,sm.ser_staffid  from  tbl_staffmaster as sm  where   sm.ser_employeestatus='Active' AND ser_compl_mgmt='Y'";
										  $sql_ds  =  $database->mysqlQuery($sql_ds_nos); 
										  $num_ds = $database->mysqlNumRows($sql_ds);
										  if($num_ds){ 
										   while($result_ds = $database->mysqlFetchArray($sql_ds)) 
												  {
											?>    
                                        
                                       <option value="<?=$result_ds['ser_staffid']?>" ><?=$result_ds['ser_firstname']?></option>
                                      
                                      <?php } } ?>                            
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
                                    <td width="45%">Cash Payment</td>
                                    <td width="5%">:</td>
                                    <td width="50%"><div class="discount_text_box paymod_text_box">
                                            <input style="width:100%;border: solid 1px #ccc;border-radius: 4px;height:30px"  placeholder="Cash Payment" class=" transa_txt" id="paidamount" name="paidamount" onChange="enterbalance()" onkeypress="return enterbalance()" onkeyup="return enterbalance()" autocomplete="off" value="0">
                                        </div></td>
                                    </tr>
                                     <tr>
                                    <td width="45%">Balance Cash</td>
                                    <td width="5%">:</td>
                                    <td width="50%"><div class="discount_text_box paymod_text_box">
                                             <input  placeholder="Balance Cash" class="tax_textbox transa_txt" id="balanceamout" name="balanceamout" value="0" readonly>
                                        </div></td>
                                    </tr>
                            	 </tbody>
                             </table> 
                             
                    	</div><!--paid_amount_cc-->
                        
                        <div class="paid_amount_cc_credit" style="display:none">
                    		<table class="tax_table" width="100%" border="0" cellspacing="5">
                             	 <tbody>
                                     <tr>
                                    <td width="45%">Amount Paid</td>
                                    <td width="5%">:</td>
                                    <td width="50%"><div class="discount_text_box paymod_text_box">
                                             <input  placeholder="Enter Paid Amonut" class="tax_textbox transa_txt" id="paidamount_credit" name="paidamount_credit" onkeyup="balance_credit()"  value="0">
                                        </div></td>
                                    </tr>
                                     <tr>
                                    <td width="45%" style="display:none">Balance Amount</td>
                                    <td width="5%" style="display:none">:</td>
                                    <td width="50%" style="display:none"><div class="discount_text_box paymod_text_box">
                                             <input  placeholder="Enter Balance Amount" class="tax_textbox transa_txt" id="balanceamout_credit" name="balanceamout_credit" value="0" readonly>
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
                    	
                    </div><!--bill_history_details_table-->
                    
                </div><!--bill_history_right_detail-->
                
               	<div class="take_staff_view_cont_bottom_contain">
                <a href="#" class="closetranscationshis" style="display: block;"><div class="bill_print_btn">Submit</div></a>
               </div>    	
                    
                
            </div><!--left_contant_container-->
            
                 
         
    </div>
        
        
        
      </div><!--middle_container-->          
</div><!--container_fluide-->



 <div class="card_deatail_popup_contaniner">
<div class="card_deatail_popup">
        <div class="card_deatail_popup_head">
            Card Details<span style="color:red;margin-top:-8px " id="loadmsg"></span>
        <div class="counter_menu_popup_head_close close_card_pop"><img src="images/black_cross.png"></div>
        </div>
    
    <div class="card_deatail_popup_contant">
	
        <div><strong> Bill Amount : </strong> <strong id="showgt"></strong>&nbsp; &nbsp; &nbsp; &nbsp;  &nbsp; &nbsp; <strong> Enter No Of Cards : </strong><input type="text" class="card_popup_digits" maxlength="1" name="countcard" id="countcard" value=""  onkeyup="return addrowscard()" onkeydown="return addrowscard()" onkeypress="return addrowscard()" autocomplete="off" onclick="return addrowscard()"   onchange="return addrowscard()"     style="border-radius: 5px;
border: solid 1px #c9090c;margin-top: 1px;width: 40px;float: none;margin-top: 20px; height: 27px; "></div>
        <div class="card_detail_popup_contant">
        	<div class="card_detail_popup_list_head">
            	<div class="card_detail_popup_type" style="width:24%;margin-right:1%">
                	<div class="card_detail_popup_type_text">Card Type</div>
                 </div>  
                 <div class="card_detail_popup_type">
                	<div class="card_detail_popup_type_text"> Last 4 Digits in Card</div>
                  </div> 
                  <div class="card_detail_popup_type" style="width:18%;margin-left:1%">
                	<div class="card_detail_popup_type_text">Amount</div>
                 </div> 
                    
            </div>
          
            
            <div class="refcount">      
            
<!--        //row start///    -->
            <?php
                                           $sql_rsnrate = "select sum(mc_cardamount) as totamount from tbl_bill_card_payments where (mc_billno = 'temp_".$_SESSION['billcard16bh']."' or mc_billno = '".$_SESSION['billcard16bh']."')   ";
                                          //  echo "select sum(mc_cardamount) as totamount from tbl_bill_card_payments where mc_billno = '".$_SESSION['billcard6']."'";
                                           $sql_rsns1rate = $database->mysqlQuery($sql_rsnrate);
                                                $num_rsns1rate = $database->mysqlNumRows($sql_rsns1rate);
                                                if ($num_rsns1rate) {
                                                    while ($result_rsns1rate = $database->mysqlFetchArray($sql_rsns1rate)) {
                                                        if($result_rsns1rate['totamount']!=""){
                                                        $totalcardbill=$result_rsns1rate['totamount'];
                                                        }else{
                                                            $totalcardbill="0";
                                                        }
                                                    }
                                                    
                                                    }
            
            
          $ct=$_SESSION['countofboxbh']; 
         if($ct==""){
             $ct=1;
         }
         for($i=0;$i<$ct;$i++){
          ?>
          
        	<div class="card_detail_popup_list">
            	<div class="card_detail_popup_type" style="width:24%;margin-right:1%">
                    <select class="card_type_dropdwn cardselect" id="multicardtype" onclick="return selectdefault('<?=$i?>');">
                        <option value="" >Select Card</option>
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
                
                <div class="card_detail_popup_type">
                    <input class="card_popup_digits cardno" type="text" id="card_1<?=$i?>"  name="card_1" chk="<?=$i?>"  onkeypress="return numonly()" onclick="return pincard('<?=$i?>')" onchange="return pincard('<?=$i?>')" maxlength="4" autocomplete="off" >
                    
                </div>
                <div class="card_detail_popup_type" style="width:18%;margin-left:1%">
                    <input type="text" class="card_type_dropdwn amountall"  id="multi_cardamount<?=$i?>"  name="multi_cardamount"  onkeyup="return addtotalcard()" onclick="return addtotalcard('<?=$i?>')" onchange="return addtotalcard('<?=$i?>')" autocomplete="off" >
                </div>
<!--                    <div class="counter_menu_popup_head_close close_card_pop12 " id="closeboxes<?//=$i?>" onclick="return closebox('<?=$i?>');" style="margin-top: -7px ;margin-left: 7px;float: left"><img src="images/black_cross.png"></div>-->
<!--                    <div class="card_popup_plus_btn" onclick="return addcard()">+</div>-->
            </div>
                       <input type="hidden" id="countb" value="<?=$i?>" > 
            <?php

          } 
     
     
            ?>
                      
         
           <div class="card_detail_popup_type" style=" width: 86%; margin-left: 0;text-align: right;">
               <strong>Added card amount : </strong> <strong id="totlcardamount"><?=$totalcardbill?>  </strong>
               &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<strong>Total : </strong> <strong id="cardtotalnew">  </strong>
                </div>
            </div>   
<!--         ///row end///   -->
            
            
            
        </div>
       
    
        <div class="card_btm_btn_cc">
            <div class="change_language_btn"><a href="#"  class="change_language_ok_btn submitcard">Submit</a></div>
         </div>
    </div>
    
    <div class="card_number_pad_cc">
        
        <div class="keys settle_key">
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
    </div>
    
     </div>

</div>
 
 
 
 
 
 
 
 
<!-- //edit popup///-->
 





 
<div class="card_deatail_popup_contaniner_delete" style="display:none">
<div class="card_deatail_popup" style="width: 530px;">
	<div class="card_deatail_popup_head">
    	 Card Details
        <div class="counter_menu_popup_head_close close_card_pop_delete"><img src="images/black_cross.png"></div>
        </div>
        <div class="card_detail_popup_contant">
        	<div class="card_detail_popup_list_head">
            	<div class="card_detail_popup_type" style="width:24%;margin-right:1%">
                	<div class="card_detail_popup_type_text">Card Type</div>
                 </div>  
                 <div class="card_detail_popup_type">
                	<div class="card_detail_popup_type_text"> Last 4 Digits in Card</div>
                  </div> 
                  <div class="card_detail_popup_type" style="width:18%;margin-left:1%">
                	<div class="card_detail_popup_type_text">Amount</div>
                 </div> 
            </div>
            
        	
            	
            <div class="deleterefresh">    
                       
                     	 <?php 
                                                $sql_rsn12 = "select tcd.crd_name,tcd.crd_id,tcp.mc_cardamount,tcp.mc_slno,tcp.mc_carnumber,tcp.mc_billno from tbl_bill_card_payments tcp left join tbl_cardmaster tcd on tcd.crd_id=tcp.mc_cardtype where (mc_billno = 'temp_".$_SESSION['billcardbh']."' or mc_billno = '".$_SESSION['billcardbh']."')   ";
                                                $sql_rsns12 = $database->mysqlQuery($sql_rsn12);
                                                $num_rsns12 = $database->mysqlNumRows($sql_rsns12);
                                                if ($num_rsns12) {
                                                    while ($result_rsns12 = $database->mysqlFetchArray($sql_rsns12)) {
                                                        $bilnonew=$result_rsns12['mc_billno'];
                                                        $amountcard=$result_rsns12['mc_cardamount'];
                                                        $slno=$result_rsns12['mc_carnumber'];
                                                        
                                                        
                                                       
                                                       $billslno=$result_rsns12['mc_slno'];
                                                       
                                                        
                                                        ?>
            <div class="card_detail_popup_list<?=$bilnonew?><?=$billslno?>" style="margin-bottom: 8px;float: left;">
                     <div class="card_detail_popup_type" style="width:24%;margin-right:1%">                            
                         <input  class="card_type_dropdwn" id="card_<?= $result_rsns12['crd_id']?>" value="<?= $result_rsns12['crd_name']?>" readonly >
                           </div>                         
                         <div class="card_detail_popup_type">
                             <input type="hidden" value="<?=$bilnonew?>" id="billnonew">
                             <input class="card_popup_digits" type="text" id="card_1_edit" maxlength="4" value="<?=$slno?>" readonly>
                   
                </div>
                       
                <div class="card_detail_popup_type" style="width:18%;margin-left:1%">
                    <input type="text" class="card_type_dropdwn" id="multi_cardamount_edit<?=$billslno?>" value="<?=$amountcard?>" readonly>
                </div>
                    <div class="card_popup_plus_btn" onclick="return deletecard(<?=$billslno?>)">x</div>
                    </div>    
                        
                        
                                                          <?php  }}?>
                        
            </div> 
               
                
               
           
              
            
        </div>
        <div class="card_btm_btn_cc">
            <div class="change_language_btn"><a href="#" class="change_language_ok_btn deletecardetail">Close</a></div>
         </div>
    </div>
</div>
   




<!-- ************************************************* manage popup starts  ************************************************** -->
<div style="position:fixed;width:100%;left:30%;top:7%;z-index:99999;" class="mynewpopupload1"  ></div>
<!-- ************************************************* manage popup ends  ******************************************************* -->  

 <div style="display:none;height: auto;bottom: auto;top: 30%;width:350px;" class="index_popup_1 closeoneclass">
  <h3 class="sm_pop_head">Message</h3>
 	<div class="index_popup_contant">Are you sure you want to cancel this Bill?</div>
    <div style="height:40px;" class="index_popup_contant">
    	<div  style="width: 20%;"  class="btn_index_popup"><a href="#" class="closeok">Yes</a></div>
        <div  style="width: 20%;" class="btn_index_popup"><a href="#" class="closecancel">No</a></div>
    </div>
 </div><!--index_popup_2-->
 
 
  <input type="hidden" id="otp_bill_cancel" value="<?=$_SESSION['otp_bill_cancel']?>">
   <input type="hidden" id="otp_login" value="<?=$_SESSION['expodine_id']?>">
 
 
 <input type="hidden" name="hidbilnotosave" id="hidbilnotosave">
  <input type="hidden" name="hidslnotosave" id="hidslnotosave">
 <div style="display:none;height: auto;bottom: auto;top: 30%;width:350px;"class="index_popup_1 closeoneclass2">
 <h3 class="sm_pop_head">Message</h3>
 	<div class="index_popup_contant msgclass">Are you sure you want to cancel this item?</div><!--index_popup_contant textcontent-->
    <div style="height:40px;" class="index_popup_contant">
    	<div style="width: 20%;" class="btn_index_popup"><a href="#" class="closeoksubmit">Yes</a></div>
        <div style="width: 20%;" class="btn_index_popup"><a href="#" class="closecancel2">No</a></div>
    </div>      
 </div><!--index_popup_2-->
 
  <div style="display:none;height: auto;bottom: auto;top: 30%;width:500px;" class="index_popup_2 closeoneclass3">
 	<div class="index_popup_contant textcontent"><h3 class="sm_pop_head">Cancellation
    <div style="width: 35%;height: 30px;float: right;"><span style="color:#F00;font-size:15px; text-align:center !important;display:none" id="deatilserror"></span></div>
    </h3></div>
    	
    <div class="index_popup_contant contenttext" style="display:inline-block;margin-left:5%;text-align:left;width:100%;height:auto">
        <span style="line-height: 40px;width:26%;float:left" id="rsntxt">Reason</span><div style="background-color: #fff !important;width: 60%;height:auto;    margin-bottom: 15px;" class="btn_index_popup"><input type="text" class="popup_conform_his" style="" name="reasontext" id="reasontext"></div><br>
        <span style="line-height: 40px;width:26%;float:left">Staff name</span><div style="background-color: #fff !important;width: 60%;height:auto;" class="btn_index_popup" >
         <select style="float: left;width: 51%;" class="popup_conform_his"  id="stafflist" name="stafflist" >
           <option value="null" default>Select Staff</option>
           <?php
               $sql_login  =  $database->mysqlQuery("select * from tbl_staffmaster WHERE ser_cancelpermission='Y' AND ser_employeestatus='Active'"); 
                $num_login   = $database->mysqlNumRows($sql_login);
                if($num_login){
                    while($result_login  = $database->mysqlFetchArray($sql_login)) 
                      {
                      ?>
          <option class="popup_conform_his" value="<?=$result_login['ser_staffid']?>" cancelkey="<?=$result_login['ser_cancelwithkey']?>"><?=$result_login['ser_firstname']?></option>
         <?php } } ?>	
          </select>
          <div style="margin-top:0px !important;" class="btn_index_popup_send otp_gent_btn"><a href="#" class="sendotp">Send OTP</a></div>
        
        </div><br>
        <span style="line-height: 40px;width:26%;float:left">Enter <span id="typeentery"> </span></span><div style="background-color: #fff !important;width: 60%;" class="btn_index_popup"><input class="popup_conform_his" style="float: left;" type="password" name="secretkey" id="secretkey"></div>
    </div>   
    <div class="index_popup_contant" style="margin-top:-6px;height: 40px;">
    	<div style="width: 95px;" class="btn_index_popup"><a href="#" class="closeok2">Submit</a></div>
        <div style="width: 95px;" class="btn_index_popup"><a href="#" class="closecancel2">Cancel</a></div>
    </div>      
 </div><!--index_popup_2-->
 <?php include 'includes/authcode_popup_bill hist.php'; ?>
<div style="display:none;height: auto;bottom: auto;top: 30%;width:500px;" class="index_popup_2 loadauthdetails">
 	<div class="index_popup_contant textcontent"><h3 class="sm_pop_head">Authorization
    <div style="width: 35%;height: 30px;float: right;"><span style="color:#F00;font-size:15px; text-align:center !important;display:none" id="deatilserror_2"></span></div>
    </h3></div>
    	
    <div class="index_popup_contant contenttext" style="display:inline-block;margin-left:5%;text-align:left;width:100%;height:auto">
    	<span style="line-height: 40px;width:26%;float:left">Reason</span><div style="background-color: #fff !important;width: 60%;height:auto;    margin-bottom: 15px;" class="btn_index_popup"><input type="text" class="popup_conform_his" style="" name="reasontext_chng" id="reasontext_chng"></div><br>
        <span style="line-height: 40px;width:26%;float:left">Staff name</span><div style="background-color: #fff !important;width: 60%;height:auto;" class="btn_index_popup" >
         <select style="float: left;width: 51%;" class="popup_conform_his"  id="stafflist_chnge" name="stafflist_chnge" >
           <option value="null" default>Select Staff</option>
           <?php
               $sql_login  =  $database->mysqlQuery("select * from tbl_staffmaster WHERE ser_cancelpermission='Y' AND ser_employeestatus='Active'"); 
                $num_login   = $database->mysqlNumRows($sql_login);
                if($num_login){
                    while($result_login  = $database->mysqlFetchArray($sql_login)) 
                      {
                      ?>
          <option class="popup_conform_his" value="<?=$result_login['ser_staffid']?>" cancelkey="<?=$result_login['ser_cancelwithkey']?>"><?=$result_login['ser_firstname']?></option>
         <?php } } ?>	
          </select>
          <div style="margin-top:0px !important;" class="btn_index_popup_send otp_gent_btn"><a href="#" class="sendotp_chg">Send OTP</a></div>
        
        </div><br>
        <span style="line-height: 40px;width:26%;float:left">Enter <span id="typeentery"> </span></span><div style="background-color: #fff !important;width: 60%;" class="btn_index_popup"><input class="popup_conform_his" style="float: left;" type="password" name="secretkey_chng" id="secretkey_chng"></div>
    </div>   
    <div class="index_popup_contant" style="margin-top:-6px;height: 40px;">
    	<div style="width: 95px;" class="btn_index_popup"><a href="#" class="authcahngepayment">Submit</a></div>
        <div style="width: 95px;" class="btn_index_popup"><a href="#" class="closeregnpopup">Cancel</a></div>
    </div>      
 </div>
 
 <div style="display:none" class="confrmation_overlay"></div>
 
 
 
 
 
 <div class="kotcancel_reason_popup_newbh" style="display:none">
    <input type="hidden" name="focusedtext" id="focusedtext" />
 <div class="kotcancel_reason_popup_new_left_cc">
    <div class="kotcancel_reason_popup_new_head"><img class="auth_head_ico" src="img/alert.png" /> Authorisation</div>
    <div class="kotcancel_reason_popup_new_textbox_contant">
    
    	<!--<div class="kotcancel_reason_popup_new_textbox_cc">
            <select class="kotcancel_reason_popup_new_textbox_input">
            	<option>Select Reason</option>
                <option>Reason 1</option>
            </select>
        </div>-->
        <div style="width: 100%;float: left;height: 20px;line-height: 10px;text-align: center"><span id="pin_errorbh" style="color:red;"></span></div>
        <div class="kotcancel_reason_popup_new_textbox_cc" style="margin-bottom:10px;">
            <input style="width:80%;float:left" type="password" class="kotcancel_reason_popup_new_textbox_input" placeholder="CODE" id="pinbh" onkeypress="pincheck(this.val)" autofocus="true" maxlength="4"/>
            <span style="height: 47px;" class="login_back_btn calculator_settle_back11">&nbsp;</span>
        </div>
    </div>
    <div class="kotcancel_reason_popup_new_textbox_btn_cc">
        <a href="#"><div class="kotcancel_reason_popup_new_textbox_btn" id="kotcancel_reason_popup_new_cancel_btnbh">Cancel</div></a>
    	<a href="#"><div class="kotcancel_reason_popup_new_textbox_btn" id="kotcancel_reason_popup_new_proceed_btnbh">Proceed</div></a>
    </div>
  </div><!--kotcancel_reason_popup_new_left_cc-->
  <div class="kotcancel_reason_popup_new_right_cc">
  		<div class="keys settle_key">
            <span class="calculator_settle2">1</span>
            <span class="calculator_settle2">2</span>
            <span class="calculator_settle2">3</span>
             <!--<span class="calculator_settle_back">&nbsp;</span>-->
            <span class="calculator_settle2">4</span>
            <span class="calculator_settle2">5</span>
            <span class="calculator_settle2">6</span>
            <span class="calculator_settle2">7</span>
            <span class="calculator_settle2">8</span>
            <span class="calculator_settle2">9</span>
            <span class="calculator_settle2">0</span>
            <span style="width: 46.2%;max-width: inherit;" class="calculator_settle2">Clear</span>
        </div>
  </div><!--kotcancel_reason_popup_new_right_cc-->
</div> 
 
 
 
 <style>
     .kotcancel_reason_popup_newbh{
	width:370px;
	height:auto;
	position:absolute;
	z-index:99999;
	background-color:#fff;
	left:0;
	right:0;
	margin:auto;
	border-radius:8px;
	top:15%;
	}
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
        
$(document).ready(function(){


    $('.login_back_btn').click( function() {
            
            var str =$('#pinbh').val();
            
            str = str.substring(0, str.length - 1);
            $('#pinbh').val(str);
           
            $('#pin').focus();
            
        }); 
            



$("#arc_year").change(function () {
      
      
          if( $("#arc_year").val()=='archive'){  
              
             $.post("load_ta_history.php", {set_year: 'set_archive'},
                            function (data)
                            {
                                 location.reload();
                            });  
         }else{
             
             $.post("load_ta_history.php", {set_year: 'set_normal'},
                 function (data)
                  {
                       location.reload();
                  });  
       }
   });
   
   
  $('#kotcancel_reason_popup_new_proceed_btnbh').click(function () {
             
              var pin =  $('#pinbh').val();
              var url='';
              if(pin !=''){
                   if($('.changesetledetils').attr('mode')=='TA'){
                      url="load_takeaway.php";
                  }else{
                      url="load_counter_sales.php";
                  }
              $.post(url, {pin:pin,value:'authpincheck',set:'pincheck'},
		function(data)
		{ //alert(data);
                    data=$.trim(data);
                    if(data!="NO")
                    {
                        var spl=data.split('*');
                             if(spl[3]=='change:Y'){     
                                
                           var paymod       =  $('.paymentids').attr("payid");
			  if(paymod==1 || paymod==2)
			  {
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
					$('.paid_amount_cc').css("display","block");
					$('.paid_amount_cc_credit').css("display","none");
					$('.closetranscations').css("display","block");
			  
			  $("#bill").hide();
			  $("#settlement").show();
			  $('.tax_textbox').find('option:first').attr('selected', 'selected'); 
                        } 
                            
                    $('.closeoneclass2').css('display','none');
                    $('.kotcancel_reason_popup_newbh').css('display','none');
                    $('.confrmation_overlay').css('display','none');
                    $('#pinbh').val('');  
                     $("#pinbh").focus();
                  
                  
                  $("#bill").hide();
			  $("#settlement").show();
			  $('.tax_textbox').find('option:first').attr('selected', 'selected'); 
                    }else{
                         $("#pin_errorbh").css("display","block");
			$("#pin_errorbh").text(" NO Permission!");
			$("#pin_errorbh").delay(2000).fadeOut('slow');
                        $("#pinbh").val('');
                         $("#pinbh").focus();
                    }
                    }else{
                        $("#pin_errorbh").css("display","block");
			$("#pin_errorbh").text("CODE NOT REGISTERED!");
			$("#pin_errorbh").delay(2000).fadeOut('slow');
                        $("#pinbh").val('');
                         $("#pinbh").focus();
                    }
                });
                
                
            }else{
                $("#pin_errorbh").css("display","block");
		$("#pin_errorbh").text("ENTER PIN!");
		$("#pin_errorbh").delay(2000).fadeOut('slow');
                $("#pinbh").val('');
                  $("#pinbh").focus();

            }
            
        
          });
          
           






	   $('.sendotp').click(function () {
	
	
		var stafflist       =  $('#stafflist').val();//alert(stafflist);
		stafflist=$.trim(stafflist);
		$.post("load_bill_history.php", {stafflist:stafflist,set:'sendotp'},
			function(data)
			{
			data=$.trim(data);
			
			});
	 
	 
	 });
	 
	 
	
	 
	
		  $(".changesetledetils").click(function(){
                      
                        $('#billhistory_mode').val($(this).attr('mode'));
			  var paychangeauthcode= $('#authchnage').val();
                           var cancel_key=$('.bill_history_active').attr("cancelstatus");
                           
                     if(cancel_key!="Cancelled"){
                         
                            if(paychangeauthcode!='Y'){
                                
                              
				  var paymod       =  $('.paymentids').attr("payid");
                                  
                                        if(paymod==1 || paymod==2 || paymod==6 || paymod==7)
                                        {
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
                                                      $('.paid_amount_cc').css("display","block");
                                                      $('.paid_amount_cc_credit').css("display","none");
                                                      $('.closetranscations').css("display","block");

                                                        $("#bill").hide();
                                                        $("#settlement").show();
                                                        $('.tax_textbox').find('option:first').attr('selected', 'selected'); 
                                            } 
                            }else{
                                
                              var amtta=$('.paymentids').html();
                               
                           if(cancel_key=="Closed" && (amtta=="Credit / Debit" || amtta=="Cash" || amtta=="Complimentary"  || amtta=="Credit Types" )){
                              
                                $('.kotcancel_reason_popup_newbh').css('display','block');
                                $('.confrmation_overlay').css('display','block');
                                $('#pinbh').focus();
                                
                           }else{
                              
                          $('.kotcancel_reason_popup_newbh').css('display','none');
                          $('.confrmation_overlay').css('display','none');
                          $(".loaderror").css("display","block");
			  $(".loaderror").addClass("billgenration_validate");
			  $(".loaderror").text("Change Not Possible");
			  $(".loaderror").delay(2000).fadeOut('slow');
                          
                           }
                           }
                          
			   $('#payemntmode_sel').val('1');
                           
			  }else
			  {
                              
		          $(".loaderror").css("display","block");
			  $(".loaderror").addClass("billgenration_validate");
			  $(".loaderror").text("Change Not Possible");
			  $(".loaderror").delay(2000).fadeOut('slow');
			  
                       }
			  
                          
                          
                          
			});
                        
                        
                        
                        
			 $(".close_settle").click(function(){
			  $("#bill").show();
			  $("#settlement").hide();
			  
			});


 $('#pinbh').keypress(function(ev){
     
        if(ev.keyCode == 13){
            ev.stopImmediatePropagation();
            $('#kotcancel_reason_popup_new_proceed_btnbh').trigger('click');
        }});
        



		
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
        var data1="value=guestnumber_search&number="+number+"&name=&credit_type="+credit_type;;
        $.ajax({
        type: "POST",
        url: "load_takeaway.php",
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
         
         

function balance_credit()
	  {     
              
                var decimal= $('#decimal').val();
             
	  	var paid=parseFloat($('#paidamount_credit').val());
		var grand       =  parseFloat($('.totalamt').attr("amttot"));
		var credit=parseFloat($('#amount_credit').val());
		
		 
                 
                 if(paid<grand && paid<credit){
                     
                     $('#amount_credit').val(grand-paid);
                     
                 }else{
                     $('#paidamount_credit').val('0');
                     $('#amount_credit').val(grand); 
                 }
                  
                  
                  
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
           
            var gtt= parseFloat($('.totalamt').text().replace(',',''));
          
            var tran=$('#transcationid').val().replace(',','');
            var camount = $('#multi_cardamount').val().replace(',','');
            var  tot=parseFloat(camount)+parseFloat(tran);
           
            if(tot==gtt){
                
               $('#balanceamout').val('0');
               $('#paidamount').val('0');
             
            }
         
            if(camount!="" && tot<=gtt ){ 
                
              var ctype =  $("#multicardtype").val();
              var camount = $('#multi_cardamount').val();
              var cnumber = $("#card_1").val();
              var billno=$('.bill_history_active').attr("billno");
              var btype = $("#multibanktype").val();   
                
              var datastring = "ctype="+ctype+"&camount="+camount+"&cnumber="+cnumber+"&billno="+billno+"&btype="+btype;
            
                 $.ajax({
                 type: "POST",
                 url: "ta_bill_history.php",
                 data: datastring,
                 success: function (data)
                 { 
                     var arr = data.split("+");
                     var a=JSON.parse(arr[0]);
                     var b=JSON.parse(arr[1]);
                     var decimal=$('#decimal').val();
                     var c=JSON.parse(arr[2]);
                       
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
                         $("#bankdetails").val($("#bankdetails option:first").val());      
                    });
                     
                    $(".plusbtn").css('pointer-events','inherit'); 
                    
                 }
                 });
                 
        var multibillnew16=$('.bill_history_active').attr("billno");
        var datastringnewmultinew16="setmultinew16=multicardnew16&multibillnew16="+multibillnew16;
    
        $.ajax({
        type: "POST",
        url: "ta_bill_history.php",
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
        url: "ta_bill_history.php",
        data: datastringnewcard,
        success: function(data)
        {      
           var multibillnew16=$('.bill_history_active').attr("billno");
        var datastringnewmultinew16="setmultinew16=multicardnew16&multibillnew16="+multibillnew16;
    
       $.ajax({
        type: "POST",
        url: "ta_bill_history.php",
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







  
function card(a){
 
       $('#'+a).toggleClass('card_active');
       
        
   }
    



//function settlepopupcommoncs(){
//  window.location.href="counter_sales.php?setcscommon=settlecspopup";  
//}


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







	</script>
   
 <input type="hidden" name="paymentmode_chge" id="paymentmode_chge" >
 <input type="hidden" name="amountpaid_chge" id="amountpaid_chge" >
 <input type="hidden" name="balance_chge" id="balance_chge" > 
  <input type="hidden" name="original_chge" id="original_chge" > 
  <input type="hidden" name="bilno_chge" id="bilno_chge" >  
  <input type="hidden" name="bankname_chge" id="bankname_chge" > 
  <input type="hidden" name="transamt_chge" id="transamt_chge" > 
  <input type="hidden" name="transbal_chge" id="transbal_chge" >  
 


 
 <script type="text/javascript">
    
    
    
    
    
    
    
    
     $('#kotcancel_reason_popup_new_cancel_btnbh').click(function(){
         $('.kotcancel_reason_popup_newbh').css('display','none');
           $('.confrmation_overlay').css('display','none');
         // location.reload();
          $(".close_settle").click();
       
     });
     
     
function validateSearch()
{//search_billno search_name search_no search_status



  var billno=$("#search_billno").val();
  if(billno=="")
  {
	  billno="null";
  }
  var name=$("#search_name").val();
  if(name=="")
  {
	  name="null";
  }  
 var nos=$("#search_no").val();
  if(nos=="")
  {
	  nos="null";
  }
  
  var statuss=$("#search_status").val();
  if(statuss=="")
  {
	  statuss="null";
  }
  
   var paymode=$("#paymode_search").val();
  if(paymode=="")
  {
	  paymode="null";
  }
  
   var partner=$("#search_partner_new").val();
  var mode=$("#search_mode_new").val();


var date1=$("#datepicker").val();
          
          var date=date1.split('-');
          
          var new_date=date[2]+'-'+date[1]+'-'+date[0]



  $.ajax({
		type: "POST",
		url: "load_ta_history.php",
		data: "value=searchtahistory&billno="+billno+"&name="+name+"&nos="+nos+"&statuss="+statuss+"&date="+new_date+"&partner="+partner+"&mode="+mode+"&paymode="+paymode,
		success: function(msg)
		{
			$('#ta_billlisttotal').html(msg);
		}
	});  
}




$('.closetranscationshis').click(function () {
         
                document.getElementById('reasontext_chng').value = '';
                document.getElementById('stafflist_chnge').value = 'null';
                document.getElementById('secretkey_chng').value = '';
                
                var billhistorymsg3 = ($("#billhistorymsg3").val());
		
		var payemntmode_sel =$('#payemntmode_sel').val();
		var authchnage =$('#authchnage').val();
                var billamount=$('.totalamt').html();
                billamount=billamount.replace(",","");
                var billno       =  $('.bill_history_active').attr("billno");
                
                var comp_remarks=$('#comp_remarks').val();
             
             
		if(payemntmode_sel!='')
		{   
                    
                  var paidamt1=$('#paidamount').val().replace(",","");
                  var balce1=$('#balanceamout').val().replace(",",""); 
                  var transamount1=$('#transcationid').val().replace(",","");
                  var transbal1=$('#transbal').val().replace(",","");

                if((paidamt1!=""&&(balce1==0||balce1!="")) || (transamount1!="" && (transbal1==0||transbal1!=""||balce1==""||paidamt1==""))  || payemntmode_sel=='7' ||  payemntmode_sel=='6' )
                 {
		  
                 
		  var selct=$('#payemntmode_sel').val();
                  var oldid= $('.paymentids').attr("payid");
		  var newid= $('#payemntmode_sel').val();
		
                  
					   
  var data_ch='';
         
  if(selct=="1")
  {       
                    
                          var paidamt=$('#paidamount').val().replace(",","");
                          var balce=$('#balanceamout').val().replace(",","");  
			  
			  if((paidamt==0) ||(paidamt==""))
			  { 
                                  var hidenteramout= $('#hidenteramout').val();
				  $(".payment_pend_right_cash_error").css("display","block");
				  $(".payment_pend_right_cash_error").addClass("popup_validate");
				  $(".payment_pend_right_cash_error").text(hidenteramout);
				  $('.payment_pend_right_cash_error').delay(2000).fadeOut('slow');
			  }
                          else if(balce==""){
                             
                                  $(".payment_pend_right_cash_error").css("display","block");
				  $(".payment_pend_right_cash_error").addClass("popup_validate");
				  $(".payment_pend_right_cash_error").text("insufficient amount");
				  $('.payment_pend_right_cash_error').delay(2000).fadeOut('slow');
                              
                          }
                          else
			  {
                              
                              
                              
                              
			  data_ch = {
				 	"set"		: "paymentchangesettleta",
					"type"		: selct,
					"billno" 	: billno,
					"paid"		: paidamt,
					"bal" 		: balce,
					"check_chn"	:"no"
				  };
                                 
                                    var datastringnewcard="sethistory=delhistory&bilcardhistory="+billno;
                                    $.ajax({
                                     type: "POST",
                                     url: "load_ta_history.php",
                                     data: datastringnewcard,
                                     success: function(data)
                                     { 
                                               
                                     }
                                     });

			  }
			  //alert(data_ch);
				  
	}else if(selct=="2")
	{     
			  var transamount=$('#transcationid').val().replace(",","");
                         
                          var transbalance=$('#transbal').val().replace(",","");
                          var bank= $('#bankdetails').val();
                          var paidamt= $('#paidamount').val().replace(",","");
                          var balce=$('#balanceamout').val().replace(",","");
                       
                            if(bank=='' || bank==null)
				{
                                    //var hidenterbankdt= $('#hidenterbankdt').val();
                                    $(".payment_pend_right_cash_error").css("display","block");
                                    $(".payment_pend_right_cash_error").addClass("popup_validate");
                                    $(".payment_pend_right_cash_error").text("Enter Bank Name");
                                    $('.payment_pend_right_cash_error').delay(2000).fadeOut('slow');
                                    return false;
				}
                          
			  if(transamount==0){
                           
                                    $(".payment_pend_right_cash_error").css("display","block");
                                    $(".payment_pend_right_cash_error").addClass("popup_validate");
                                    $(".payment_pend_right_cash_error").text("Check transaction amount !");
                                    $('.payment_pend_right_cash_error').delay(2000).fadeOut('slow');
                                    return false;
                          }
			 
			  if( transamount!=""  && bank!='')
			   {
					
					var transbal=transbalance;
                                        
					if((transbal==0 || transbal==0 ) && (balce==0||balce==''))
					{
					    data_ch = {
							 "set"		: "paymentchangesettleta",
							  "type"		: selct,
							  "billno" 	: billno,
							  "trans" :transamount,
							  "bank" :bank,
							  "paid": paidamt,
							  "bal" : balce,
							  "transbal":transbal,
							  "check_chn"	:"no"
							};
					}else if(transbal!=0 && balce!=0)
					{
						 data_ch = {
							  "set"		: "paymentchangesettleta",
							  "type"		: selct,
							  "billno" 	:billno,
							  "trans" :transamount,
							  "bank" :bank,
							  "paid": paidamt,
							  "bal" : balce,
							  "transbal":transbal,
							  "check_chn"	:"no"
							};
					}else if(transbal!=0 && balce==0)
					{
						 data_ch = {
							  "set"		: "paymentchangesettleta",
							  "type"		: selct,
							  "billno" 	:billno,
							  "trans" :transamount,
							  "bank" :bank,
							  "paid": paidamt,
							  "bal" : balce,
							  "transbal":transbal,
							  "check_chn"	:"no"
							};
					}
                                        else if((transbal<0) && balce==0)
						  {
							   data_ch = {
							  "set"		: "paymentchangesettleta",
							  "type"	: selct,
							  "billno" 	: billno,
							  "trans" :transamount,
							  "bank" :bank,
							  "paid": paidamt,
							  "bal" : balce,
							  "transbal":transbal,
							  "check_chn"	:"no"
							};
						  }
					else
					{
						 $(".payment_pend_right_cash_error").css("display","block");
						 $(".payment_pend_right_cash_error").addClass("popup_validate");
						 $(".payment_pend_right_cash_error").text(billhistorymsg3);
						 $('.payment_pend_right_cash_error').delay(2000).fadeOut('slow');
					}
				 }else
				 {
					 var hidentertranstndt= $('#hidentertranstndt').val();
					 $(".payment_pend_right_cash_error").css("display","block");
					 $(".payment_pend_right_cash_error").addClass("popup_validate");
				         $(".payment_pend_right_cash_error").text(hidentertranstndt);
				         $('.payment_pend_right_cash_error').delay(2000).fadeOut('slow');
				 }
		  }
                  else if(selct=="6")
	          {       
                     
                                       var creditype=$('#selectcreditypes').val();
                          
                                       if(creditype==3 || creditype==4){
                                              
                                        creditdeatils='';guestnumber='';
                                              
                                        if(creditype==4){
                                                  
                                              var guestnumber=$('#selectcreditdetailsnumber').val();
                                        }
                                        
                                       
                                         if(creditype==4 && guestnumber==''){
                                             
                                           $(".payment_pend_right_cash_error").css("display","block");
					   $(".payment_pend_right_cash_error").addClass("popup_validate");
					   $(".payment_pend_right_cash_error").text("Enter Name & Number");
					   $('.payment_pend_right_cash_error').delay(2000).fadeOut('slow');
                                           return false;
                                           
                                        }
                                        
                                        var guestname=$('#selectcreditdetailsname').val();
                                            
                                        }
                                        else{
                                            var creditdeatils=$('#selectcreditdetails').val();
                                            var guestnumber='';
                                            var guestname='';
                                        }
                          
                          
                          var amount_credit=$('#amount_credit').val();
                           
                          var paidamount_credit=$('#paidamount_credit').val();
                           
                     
                  if(guestnumber!='' || creditdeatils!=''){
                  
			  if(amount_credit>0)
			  { 
                               
                      
                                  data_ch = {
								  "set"				: "paymentchangesettleta",
								  "type"			: selct,
								  "creditype"			: creditype,
								  "creditdeatils"		: creditdeatils,
								  "paidamount_credit"	        : paidamount_credit,
								  "amount_credit"		: amount_credit,
								  "bal"				: 0,
				                                  "credit_remarks"              :'Pay_change',
                                                                  "guestnumber"                 : guestnumber,
                                                                  "guestname"                   : guestname,
                                                                  "room"                        : '' ,
                                                                  "billno" 	                : billno, 
                                                                  
					    };
                                  
                                  
                                 
                                     var datastringnewcard="sethistory=delhistory&bilcardhistory="+billno;
                                     $.ajax({
                                     type: "POST",
                                     url: "payment_pending.php",
                                     data: datastringnewcard,
                                     success: function(data)
                                     { 
                                       
                                     }
                                     });
                      
			  }else{

                                 
				  $(".payment_pend_right_cash_error").css("display","block");
				  $(".payment_pend_right_cash_error").addClass("popup_validate");
				  $(".payment_pend_right_cash_error").text('ENTER CREDIT AMOUNT');
				  $('.payment_pend_right_cash_error').delay(2000).fadeOut('slow');
                                
                               ///  alert('ENTER CREDIT AMOUNT');
                                    return false;
			  }
                          
                       }else{
                                //  alert('SELECT CREDIT CUSTOMER');
                                 
				  $(".payment_pend_right_cash_error").css("display","block");
				  $(".payment_pend_right_cash_error").addClass("popup_validate");
				  $(".payment_pend_right_cash_error").text('SELECT CREDIT CUSTOMER');
				  $('.payment_pend_right_cash_error').delay(2000).fadeOut('slow');
                               return false;
		    }   
                          
                          
                          
                          
					  
		}else if(selct=="7")
	          {       
                     
                          var comp_remarks=$('#completext').val();
                          
			
			  if(comp_remarks!="")
			  { 
                               
                      
                                  data_ch = {
				 	"set"		: "paymentchangesettleta",
					"type"		: selct,
					"billno" 	: billno,
					"paid"		: '0',
					"bal" 		: '0',
					"check_chn"	: "no",
                                        "comp_remarks"  :comp_remarks
				  };
                                  
                                  
                                 
                                    var datastringnewcard="sethistory=delhistory&bilcardhistory="+billno;
                                     $.ajax({
                                     type: "POST",
                                     url: "load_ta_history.php",
                                     data: datastringnewcard,
                                     success: function(data)
                                     { 
                                               
                                     }
                                     });
                      
                      
                      
                      
			  }
                          else
			  {

                                  var hidenteramout= $('#hidenteramout').val();
				  $(".payment_pend_right_cash_error").css("display","block");
				  $(".payment_pend_right_cash_error").addClass("popup_validate");
				  $(".payment_pend_right_cash_error").text('ENTER REMARKS');
				  $('.payment_pend_right_cash_error').delay(2000).fadeOut('slow');



			  }
					  
		}
                  
		  var totalpaid=parseFloat(transamount1)+parseFloat(paidamt1);
                 
		 if((parseFloat(paidamt1)>=parseFloat(billamount))||(parseFloat(totalpaid)>=parseFloat(billamount))||parseFloat(transamount1)==parseFloat(billamount)  || (comp_remarks!='' &&  comp_remarks!=undefined) || (amount_credit>0 &&  amount_credit!=undefined) )
                 {
		   var  data = $(this).serialize() + "&" + $.param(data_ch);//alert(data);
			 $.ajax({
					type: "POST",
					url: "load_ta_history.php",
					data: data,
					success: function(msg)
					{
							  $('.loadauthdetails').css('display','none');
							  $('.confrmation_overlay').css('display','none');
							  $("#bill").show();
							  $("#settlement").hide(); 
							  $(".cash_cc").show();
							  $(".credit_cc").hide();
							  $(".credit_cc_normal").hide();
							  $(".coupon_cc").hide();
							  $(".voucher_cc").hide();
							  $(".cheque_cc").hide();
							  $(".auto1").hide();
							  $(".auto").hide();
							  $(".complimentrary_management").hide();
							  $('.paid_amount_cc').css("display","block");
							  $('.paid_amount_cc_credit').css("display","none");
							  $('.closetranscations').css("display","block");
							  
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
					
					// location.reload();
								var billno       =  $('.bill_history_active').attr("billno");//alert(billno)
								$.post("load_cs_history.php", {billno:billno,value:'load_ta_bildetls'},
								  function(data)
								  {
									data=$.trim(data);
									$('#detailsset1').html(data);
								  });
								  $.post("load_cs_history.php", {billno:billno,value:'load_ta_bildetails'},
								  function(data)
								  {
									data=$.trim(data);
									$('#billdetailsset2').html(data);
								  });
								  $.post("load_ta_history.php", {billno:billno,value:'load_ta_settlement'},
								  function(data)
								  {
									data=$.trim(data);
									$('.settlementdetails').html(data);
								  });
                                                   validateSearch();                
                                                  setTimeout(function(){
                                                     
                                                    $('tr[billno="' + billno + '"]').addClass('bill_history_active');
                                                   }, 1000);        
                                                                       
                                                                  
                                                                  
						}
						});
				
		  
		   
                 }
                 else{
                     $(".payment_pend_right_cash_error").css("display","block");
			$(".payment_pend_right_cash_error").addClass("popup_validate");
			$(".payment_pend_right_cash_error").text("Insufficient amount");
			$('.payment_pend_right_cash_error').delay(2000).fadeOut('slow');
                 }
             }
            else{
                        
			$(".payment_pend_right_cash_error").css("display","block");
			$(".payment_pend_right_cash_error").addClass("popup_validate");
			$(".payment_pend_right_cash_error").text("Enter Amount");
			$('.payment_pend_right_cash_error').delay(2000).fadeOut('slow');
            }
            }else
		{
			var hideselpaytype= $('#hideselpaytype').val();
			$(".payment_pend_right_cash_error").css("display","block");
			$(".payment_pend_right_cash_error").addClass("popup_validate");
			$(".payment_pend_right_cash_error").text(hideselpaytype);
			$('.payment_pend_right_cash_error').delay(2000).fadeOut('slow');
		}
		
	
	});




     $('.calculator_settle2').click( function(event) {
          
		event.stopImmediatePropagation();
                $('#focusedtext').val('pinbh');
		var focused=$('#focusedtext').val();
               
		var calval=($(this).text());//alert(focused);alert(calval);
		
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


function enterbalance()
	{ 
              var decimal= $('#decimal').val();
             
	  	var paid=$('#paidamount').val();//alert(paid)
		var grand       =  $('.totalamt').attr("amttot");
		
		if($('.pay_check_new').val()=="1")
		 {  
		 	var bal=(parseFloat(paid.replace(/,/g, "")) -  parseFloat(grand.replace(/,/g, ""))).toFixed(decimal);
		 }else if($('.pay_check_new').val()=="2")
		 {
		 	if($('#transbal').val()!="")
			 {   
				 var subt=$('#transbal').val();
                                
				 var bal=(parseFloat(paid.replace(/,/g, "")) -  parseFloat(subt.replace(/,/g, ""))).toFixed(decimal);
				 
			 }
		 }
		 if(bal<0)
			 {//hidenterpaswd hidenterotp hiderrormg hidenterbankdt hidenteramout hidentertranstndt hideselpaytype hidinsufamout hidincrtamout hidincrtchqamt hidincrtcoupamt
					var hidinsufamout= $('#hidinsufamout').val();
				 $(".payment_pend_right_cash_error").css("display","block");
				 $(".payment_pend_right_cash_error").addClass("popup_validate");
			 	$(".payment_pend_right_cash_error").text(hidinsufamout);
				$('.payment_pend_right_cash_error').delay(2000).fadeOut('slow');
				$('#balanceamout').val('');
				//$('#balanceamout').focus();
				
			 }else
			 {
					$('#balanceamout').val(bal);
					//$('#balanceamout').focus();
			 }
		  
	  }


function transamountchange()
		{
			var tt=0;
			var gd=parseFloat( $('.totalamt').attr("amttot"));
			var dc=parseFloat($('#transcationid').val().replace(/,/g, ""));
			tt = parseFloat(gd -  dc); 
			if(tt<0)
			{
				 $(".payment_pend_right_cash_error").css("display","block");
				 $(".payment_pend_right_cash_error").addClass("popup_validate");
			 	$(".payment_pend_right_cash_error").text("Incorrect Transcation Amount");
				$('.payment_pend_right_cash_error').delay(2000).fadeOut('slow');
				
				$("#paidamount").val('0');
				$("#balanceamout").val('0');
			}else
			{
				
			document.getElementById("transbal").value=tt.toFixed(3);
			if(tt==0)
			{
				$("#paidamount").val('0');
				$("#balanceamout").val('0');
                               
			}
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
         url: "load_ta_history.php",
         data: dat,
         success: function(data)
         {  
            
          var date_ok=$.trim(data);
            
            if(date_ok=='Yes'){
                
                
                
                 var dat22="set=check_paymode&billno="+bil;
         $.ajax({
         type: "POST",
         url: "load_ta_history.php",
         data: dat22,
         success: function(data22)
         {  
            
          var date_ok22=$.trim(data22);
            
            if(date_ok22=='Yes'){
                
                
                
                
                
                
         var dat1="set=replace_item_bill&billno="+bil+"&slno="+sl;
         $.ajax({
         type: "POST",
         url: "load_ta_history.php",
         data: dat1,
         success: function(data)
         {  
             
                  $('.common_popup_all').hide();
          
                        $('.alert_error_popup_all_in_one').show();
                        $('.alert_error_popup_all_in_one').text('REPLICATED');
                        $('.alert_error_popup_all_in_one').delay(500).fadeOut('slow');
             
             $.post("load_ta_history.php", {billno:bil,value:'load_ta_bildetails'},
				  function(data)
				  {
				  	data=$.trim(data);
				  	 $('#billdetailsset2').html(data);
				  });
                                  
                                  
                                  
                         var dataString1 = 'value=load_ta_settlement&billno=' + bil;
					$.ajax({
								  type: "POST",
								  url: 'load_ta_history.php',
								  data: dataString1,
								  success: function(data1) {
								
									$('.settlementdetails').html(data1);
									   
									             
                                    }
                              });  
                                  
                                  
                                  
             
         }
          });      
             
             
             }else{
          //alert('Payment Other Than Cash Cannot Be Deleted'); 
          $('.alert_error_popup_all_in_one').show();
                        $('.alert_error_popup_all_in_one').text('Payment Other Than Cash Cannot Be Replaced');
                        $('.alert_error_popup_all_in_one').delay(1000).fadeOut('slow');
        }
        
        
        }
    });
          
               
            
        }else{
         // alert('Day is not Closed ');  
         $('.alert_error_popup_all_in_one').show();
                        $('.alert_error_popup_all_in_one').text('Day is not Closed');
                        $('.alert_error_popup_all_in_one').delay(1000).fadeOut('slow');
        }
        
        
        }
    });
         
        
    }else{
       // alert('Bill Status Is Not Closed');
       $('.alert_error_popup_all_in_one').show();
                        $('.alert_error_popup_all_in_one').text('Bill Status Is Not Closed');
                        $('.alert_error_popup_all_in_one').delay(1000).fadeOut('slow');
    }
    
    }       
    
                
    function delete_bill_item_normal(bil,sl,sts){
       
       if(sts=='Closed'){
        var check = confirm("Are you sure you want to Delete Item ?");
	if(check==true)
	{
         var dat="set=check_day_close&billno="+bil;
         $.ajax({
         type: "POST",
         url: "load_ta_history.php",
         data: dat,
         success: function(data)
         {  
            
          var date_ok=$.trim(data);
            
            if(date_ok=='Yes'){
                
                
                
                
                
                 var dat2="set=check_item_number&billno="+bil;
         $.ajax({
         type: "POST",
         url: "load_ta_history.php",
         data: dat2,
         success: function(data2)
         {  
            
          var date_ok6=$.trim(data2);
            
            if(date_ok6=='Yes'){
                
                
                
                 var dat22="set=check_paymode&billno="+bil;
         $.ajax({
         type: "POST",
         url: "load_ta_history.php",
         data: dat22,
         success: function(data22)
         {  
            
          var date_ok22=$.trim(data22);
            
            if(date_ok22=='Yes'){
                
                
                
                
                
                
         var dat1="set=delete_item_bill&billno="+bil+"&slno="+sl;
         $.ajax({
         type: "POST",
         url: "load_ta_history.php",
         data: dat1,
         success: function(data)
         {  
             
             setTimeout(function(){
                               $('.confrmation_overlay_proce').css('display','block');
		             $('.confrmation_overlay_proce').html('<img src="img/ajax-loaders/ajax-loader.gif" />');
                
                           $('.confrmation_overlay_proce').fadeOut(2500);
                        
		     
                        
                         }, 100);
             
             $.post("load_ta_history.php", {billno:bil,value:'load_ta_bildetails'},
				  function(data)
				  {
				  	data=$.trim(data);
				  	 $('#billdetailsset2').html(data);
				  });
                                  
                                  
                                  
                         var dataString1 = 'value=load_ta_settlement&billno=' + bil;
					$.ajax({
								  type: "POST",
								  url: 'load_ta_history.php',
								  data: dataString1,
								  success: function(data1) {
								
									$('.settlementdetails').html(data1);
									   
									             
                                    }
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
         // alert('Day is not Closed ');  
         $('.alert_error_popup_all_in_one').show();
                        $('.alert_error_popup_all_in_one').text('Day is not Closed');
                        $('.alert_error_popup_all_in_one').delay(1000).fadeOut('slow');
        }
        
        
        }
    });
         
        }
    }else{
       // alert('Bill Status Is Not Closed');
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
        
          window.open('a4_bill_view.php?set=bill_view_ta_hd_cs&billno='+bill+"&mode=TAKEAWAY&num="+num, '_blank');
          
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
                        
         var dat1="set=share_ebill&billno="+bill+"&mode=TA_CS";
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

<div style="display:none;height: 160px;" class="index_popup_1 closeoneclass kotconfirmpopup_ta_reprint">
        <span id="kotfailmsg_ta_reprint" style="text-align: center;width: 100%;float: left ;padding-top: 7px;"></span>
 	<div class="index_popup_contant">Are you sure you want continue without Re Print ?</div>
       <div class="index_popup_contant">
    	<div class="btn_index_popup"><a href="#" class="confirmkotok_ta_reprint">Yes</a></div>
        <div class="btn_index_popup"><a href="#" class="confirmkotclose_ta_reprint">No</a></div>
    </div>
 </div>


<div class="main_logout_popup_cc common_popup_all" style="display:none">
        <div class="main_logout_popup">
                <div>
                <h1 class="logout_contant_txt" style="margin-bottom: 30px;font-size: 18px !important;">CONFIRM REPLACE ?</h1>
                
                <div class="btn_logout_yes_no" style="background-color: #fff;  border: solid 2px #AB2426;  position: relative;  top: 2px;"><a onclick="$('.common_popup_all').hide();" style="color:#AB2426 !important" href="#" class="">NO</a></div>
                <div class="btn_logout_yes_no"><a onclick="return replace_bill_item_click();" href="#" class="">YES</a></div>
            </div>
       </div>
     </div>



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