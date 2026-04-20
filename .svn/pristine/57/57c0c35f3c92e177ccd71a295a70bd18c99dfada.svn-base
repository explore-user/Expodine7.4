<?php
header('Content-Type: text/html; charset=utf-8');
include('includes/session.php');  // Check session
//session_start();
include("database.class.php"); // DB Connection class
$database = new Database();
$localhost=mysqli_connect(HOST_NAME, USER_NAME, PASSWORD,DATABASE_NAME);

include("api_multiplelanguage_link.php");

if (!isset($_SESSION['timeopen'])) {
    header("location:index.php?msg=1");
}

error_reporting(0);


unset($_SESSION['order_id']);
unset($_SESSION['preferenceselectvalue']);
unset($_SESSION['preferencetextvalue']);
unset($_SESSION['quantityvalue']);
unset($_SESSION['portionvalue']);
unset($_SESSION['ajaxtableid']);
unset($_SESSION['ajaxtablename']);
unset($_SESSION['ajaxtablesel']);
unset($_SESSION['ajaxprefsel']);
unset($_SESSION['orderby']);
unset($_SESSION['orderbyvalue']);
$orderid = "TEMP*" . $database->getEpoch();
$_SESSION['order_id'] = $orderid;

$floorid="";
if($_SESSION['floorid'] == 'all'){
   
    unset($_SESSION['floorid']);
    unset($_SESSION['florids']);
}

$floorid=  trim(json_encode($_SESSION['floorid']),'""');

$other_lang=  trim(json_encode($_SESSION['main_language']),'""');


?>
<!doctype html>
<html ng-app="website">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title> Dine In</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">
        <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
        <link rel="shortcut icon" href="img/favicon.ico">
        <link id="bs-css" href="css/bootstrap-cerulean.min.css" rel="stylesheet">
        <link href="css/tabs_cont_1.css" rel="stylesheet">
        <link rel="stylesheet" href="css/jquery.mCustomScrollbar.css">
        <link href="css/custom.css" rel="stylesheet">
        <link rel="stylesheet" href="css/table_new.css">

        <link rel="stylesheet" href="css/bootstrap-3.3.2.min.css">
        <link rel="stylesheet" href="css/font-awesome/4.2.0/css/font-awesome.min.css">
        <link href="css/sidebar.css" rel="stylesheet">
        <link href="css/sidebar-bootstrap.css" rel="stylesheet">
        <link rel="stylesheet" type="text/css" href="css/styles_drop.css" />
     
        <link href="css/table_selection_1.css" rel="stylesheet" />
        <link href="css/loader.css" rel="stylesheet" />
        <link rel="stylesheet" href="css/jquery-ui-1.8.2.custom.css" /> 
        
        <link href="css/timepicki.css" rel="stylesheet">
        <style>
            .customer_dtl_sec{width: 70%;}
            body{overflow:auto !important;}
            .mCSB_container {overflow: hidden;width:100% !important;}
            #load_tables img{margin:auto;}
			#load_tables{height:auto !important}
            body{/* font-family: 'yu_gothicregular' !important;*/font-size:13px;letter-spacing:0.3px !important;
                  /*background-image:url(../img/bg_02.jpg) !important;  background-size:auto 100% !important;*/
                  background-image:url(img/wood.jpg) !important;
                  background-image:url(img/Dark-Blurred-Blue.jpg) !important;background-repeat:repeat;background-size:100% 100% !important; background-attachment:fixed !important;}
            .navbar-brand{margin-top:-13px !important}
            .take_order_button{    margin-top: 10px !important;}
            #load_tables {float: none;}
            #trigger{display:none !important}
            .navbar-brand{position: relative;left: -19px;}
            .main_floor_text{ height: 40px;}

            .notify_inuse {
                width: 20px !important;
                height: 20px !important;
                position: absolute;
                background-color: #05D500;
                border-radius: 50%;
                right: -5px;
                top: -5px;
            }
            .notify_inuse{background-color:#f00;z-index: 9999999;top: -7px;}
            .table_floor_select_btn{margin-top:0}
			.navbar-default .manage {display: none;}
			.keys span, .top span.clear{
				    max-width: 110px;
    				width: 31%;
				font-size: 19px;
				}
			.keys span:nth-child(3n+3) {margin-right:0}
			.keys div.eval{max-width:110px;
				width:31%;margin-right:0}
			.change_table_btn{width: 9.8%;margin-right: 10px}
			.backto_table_select{margin-right: 7px}
            .cs_loy_pop {
    width: 100%;
    height: 100%;
    background-color: rgba(0,0,0,0.6);
    position: fixed;
    top: 0;
    z-index: 999999999999;}
    .lyt_inp {
    width: 100%;
    float: left;
    height: 30px;
    border: solid 1px #ccc;
    padding-left: 10px;
    font-size: 13px;
}
.dine-input{
    width: 100%;
    margin: 10px 0;
    height: 33px;
    font-size: 13px;
    padding-left: 5px;
    line-height: 33px;
    border-radius: 5px;
    border: solid 1px #777777;
    background-color: #333333;
    color: #fff;
}
.lyt_txtbx_row{
    width: 100%;
    float: left;
    margin-bottom: 10px;
    font-size: 12px;
    font-weight: lighter;
}
.delete_con_pop a{font-size:14px}
			.calculator_table_sum{height: 83vh;min-height: 513px;padding-left: 3%;padding-right: 3%;}
			/*.right_staf_selection_cc {min-height: 600px;height: 84vh !important;}*/
                        .alert_table_bill_prt{ position: absolute;z-index: 999;top: -46px;left:150px;font-size: 14px;color: #f00;}
			.alert_billprnt_pop{font-size: 14px;color: #f00;width: 100%;height: auto;float: left;line-height: 30px;text-align: center}
                        .order-dev{background-color: #e2683c;width: 16px !important;height: 16px !important;border-radius: 50%;text-align: center;display: inline-block;    float: none !important;line-height: 16px;margin-right: 2px;font-weight: bold;font-size: 13px;color:black}
                        @media (max-width:1100px){
	body{padding-bottom: 0 !important}
	}
        .currency_main_div{width: 100%;height: auto;float: left}
        .select_billnum_pop{width: auto;height: auto;display: inline-block;border: 1px #ccc solid;outline: none;padding: 0 0.5%}
       .addon_txt{color: #f00}
       .combo_tbl_lst{width: 100%;font-size: 11px; color: #6d0a21; line-height: 11px !important;
    display: inline-block;}
       .disablegenerate
        {
            pointer-events: none;
            opacity: 0.5;
            cursor:none;

        }
        .confrmation_overlay_proce_load{
	width:100%;
	height:100%;
	position:fixed;
	z-index:9999;
	background-color:rgba(0,0,0,0.8);
	top:0;
	text-align:center;
	line-height: 40;
        display:none;
        }
        .order-split-btn{width: 33.2% !important;background-color: #a04120;    border-bottom: 2px rgb(90, 11, 0) solid;height: 60px;line-height: 13px;}
        .reprint_order_cc .print-button-table-sel{width: 31.5%;height: 60px;line-height: 13px;}
        .reprint_order_cc .print-btn-tbl-ico{width:100%}
        .keys{padding-top:0}
        
.confrmation_overlay_proce_load img{width:140px;height:110px;}
.clear_pending_table{line-height: 42px; width: 140px; height: 41px;/* float: left; */ background-color: #d4992d;
    text-align: center;color: #000;font-weight: bold; position: absolute; left: 68%;bottom: 5px;
    border-radius: 6px; cursor: pointer; font-family: sans-serif;}clear_pending_table:hover{background-color: #dca94c;}
    
    .pop_payment_mode_sel_btn77 {
    width: 100%;
    float: left;
    height: 35px;
    margin-top: 2px;
    background-color: rgb(88 32 33);
    color: rgb(255, 255, 255);
    text-align: center;
    line-height: 35px;
    font-size: 14px;
    cursor: pointer;
    font-family: CALIBRI_0;
    box-shadow: rgb(130, 0, 2) 0px 4px;
    margin-bottom: 7px;
    transition: all 0.2s ease;
}
.edit_pax_sec_rhgt{
    width: 70px;
    position: absolute;
    height: 30px;
    left: 5px;
    background-color: #920b0b;
    text-align: center;
    line-height: 30px;
    color: #fff;
    font-size: 13px;
    border-radius: 32px;
    top: 4px;
}

.editpax_pop_sec {
    position: fixed;
    width: 100%;
    height: 100%;
    background-color: rgba(0,0,0,0.8);
    top: 0;
    left: 0;
    z-index: 999999;
}
.editpax_pop{
    width: 250px;
    float: left;
    height: auto;
    min-height: 50px;
    padding:10px;
    background-color: #ccc;
    border-radius: 5px;
    position: absolute;
    left: 0;
    right: 0;
    top: 20%;
    margin: auto;
    z-index: 99999;
}
.editpax_pop_cnt{
    width:100%;
    height:auto;
    float:left;
}
.editpax_pop_cnt .settle_key{margin-top:0}
.editpax_pop_cnt_input{
    width:100%;
    height:auto;
    float:left;
    padding:10px 13px;
}
.editpax_pop_cnt_input input{
    width:60%;
    height:35px;
    float:left; 
    border:0;
    padding-left:10px;
    font-size:18px;

}
.editpax_pop_cnt_update_btn{
    width:40%;
    height:35px;
    float:left; 
    border:0;
    text-align:center;
    background-color: #d4721c;
    font-size:14px;
    color:#fff;
    line-height:35px;

}
.editpax_pop .keys span, .top span.clear{
    height: 40px;   line-height: 40px;
}
.edt_px_close_sec{
    width:30px;
    height:30px;
    position:absolute;
    right:-10px;
    top:-10px;
    background-color:#fff;
    border-radius:50%;
}
.edt_px_close_sec img{width:95%;position:relative;top:-1px}
.line_higt_table_summ{
	overflow: hidden;
    text-overflow: ellipsis;
    display: inline-block;
}
#overlay {
  position: fixed;
  display: block;
  width: 100%;
  height: 100%;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background-color: rgba(0,0,0,0.5);
  z-index: 9999;
  cursor: pointer;


}
.alert_msg{
    width: 50%;
    height: 450px;
    background-color: #fff;
    margin: 5% 20%;
    text-align: center;
    padding: 20px 1%;

}
.tlb-hd {
    overflow: auto; 
}

.tlb-hd th{
    background-color:#000;
    color:#fff;
    position: sticky; 
    top: 0; 
    z-index: 1;
    vertical-align: initial;
}
.new_size_changer{
    overflow: hidden;
    max-width: 150px;
    font-size: 10px;
}
.tax_1{
    overflow-y: scroll;
    height:75px;
}
.tax_1::-webkit-scrollbar-track {
  box-shadow: inset 0 0 5px #fff; 
  border-radius: 5px;
  width:5px;
  background-color:#fff;
}
.tax_1::-webkit-scrollbar {
  width: 5px;
}
.tax_1::-webkit-scrollbar-thumb {
  background: #fff; 
  border-radius: 5px;
}
.btn_5{
    margin-top:25px;
    margin-right:10px;
}
.ui-autocomplete{z-index:999999 !important;max-height: 400px;    height: auto; overflow: scroll;}
        </style>
        <script src="js/jquery-1.10.2.min.js"></script>
       
       

        <script src="js/jquery-ui-1.11.4.js"></script>
        <script src="js/jquery.nicescroll.min.js"></script>
        <script src="js/dynamic.js"></script>

  <script type="text/javascript">
  $(document).ready(function () {
      
      
      
               ///no print to print code/////
    
                var  dataString1 = 'set=set_print_option_di&print_option=Y' ;
                $.ajax({
		type: "POST",
		url: "load_index.php",
		data: dataString1,
		success: function(data) {
                     
                }
                });
      
      
    //cloud sync api call///   
    
     var cloud_api_on=$('#cloud_api_on').val();
 
    if(cloud_api_on=='Y'){ 
      
     if($('#table_view_in').val()=='Y'){ 
         
      setInterval(function() {
         
         $.post("test2.php", {set:'table_view_live'},function(data){  });
          
      }, 12000);
      
     }
    
    }
   
   
        /////page refresh idle ///

        setInterval(function() {

           window.location.href= window.location.href;

        }, 150000);     

        //// table refresh on orders   /// 
   
       
       setInterval(function () {
       
        $('#load_tables').load('load_div.php?tab=&set=summary');
                  
      }, 2500);


  ///dine in table data loads//
  
    setInterval(function () {
                   
                    $('#load_order_count').load('load_div.php?set=load_order_count&floor_id=');
                 
                    if ($('#stewardsel').val() == "")
                    {
                        $('#stewardsel').load('load_div.php?stafid=&set=staffatt');
                    } else
                    {
                        var stfid = $('#stewardsel').val();
                        
                        $('#stewardsel').load('load_div.php?stafid=' + stfid + '&set=staffatt');
                    }
      }, 3500);

///refresh ends ///

      
   $("#phone_cs").autocomplete({
       
                            minLength: 1,
                            source: "load_index.php?set=search_loyalty_num_method",
                            focus: function (event, ui) { 
                                
                                },
                         
                                 select: function (event, ui) {
                                 
                                $('#firstname_cs').val(ui.item.name);
                                $('#phone_cs').val(ui.item.label);
                                $('#email_cs').val(ui.item.email);
                                $('#gst_loy').val(ui.item.gst);
     
                                $("#firstname_cs").attr("edit_id", ui.item.id);
                                 localStorage.enter_key='no';
                                  return false;
                            }

       });
   
    $("#firstname_cs").autocomplete({
                            minLength: 1,
                            source: "load_index.php?set=search_loyalty_name_method",
                            focus: function (event, ui) {
                            
                            },
                         
                                 select: function (event, ui) {
                                 
                                $('#firstname_cs').val(ui.item.label);
                                $('#phone_cs').val(ui.item.num);
                                $('#email_cs').val(ui.item.email);
                                $('#gst_loy').val(ui.item.gst);					 
				 $("#firstname_cs").attr("edit_id", ui.item.id);
                                 localStorage.enter_key='no';
                                return false;
                            }

  });
      
      
     $( "#multi_cardamount" ).keyup(function() {
          
       var card= parseFloat($('#multi_cardamount').val());
       var gtt= parseFloat($('#grandtotal').html());
        
        if(card==gtt){
             $('.plusbtn').hide();  
             
        }else{
          
          $('.plusbtn').show();  
            
        }
        
        
   });  
      
      
      
 $('.cs_pax').click( function(event) {
         
		event.stopImmediatePropagation();
                $('#focusedtext').val('pax_update_new');
		var focused=$('#focusedtext').val();
               
		var calval=($(this).text());
		
		var org=$('#'+focused).val();
			if(calval>=0)
			{
                            if(org.length < 3){
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
      
  $(".edit_pax_sec_rhgt" ).click(function() { 
           
            $(".editpax_pop_sec").show();
            $('#pax_update_new').focus();
            $('#pax_update_new').val('');
            
            
            var order   =  $('.allready').attr("ordrd");
	    var order_v	  =	 order.split("_");
	    var orderid       =  order_v[1];
            
            $("#pax_update_new").attr('order_id',orderid); 
            
                $.post("load_div.php", {set:'check_pax_add',order:orderid},
                    function(data){
                      
			var datax=$.trim(data);
                        
                        $('#pax_update_new').val(datax);
                        
                    });
            
            
  });
      
      
  $(".edt_px_close_sec" ).click(function() {
           
   location.reload();
           
  });
       
       
       
  $(".discount_apply_after" ).click(function() {
           
             var ds_val= $("#dis_after_manual").val();
             var ds_drop= $("#dis_after_drop").val();
             
             var ds_type='';  
             var discount='';
             var type='';
            
             if(ds_drop!=''){
                 
                ds_type='';  
                discount=$("#dis_after_drop").val();
                type="drop";
                
              }else{
            
               ds_type= $("#dis_after_type").val();
               discount=$("#dis_after_manual").val();
               type="text";
               
              }
             
             
       if(ds_val!=''  || ds_drop!=''){

          var billno=$('#settleingbilno').val();
          var dataString_log ='set=proceed_after_dis&billno='+billno+"&discount="+discount+"&type="+type+"&disctype="+ds_type;
        
                                $.ajax({
                                    type: "POST",
                                    url: "load_completedorder.php",
                                    data: dataString_log,
                                    success: function(data) { 
                                       
                                      $('.billedclic').attr('billedno',billno);       
                                        
                                      $('.billedclic').click();
                                        
                                    }
                                });
        
        
        
        }
         else{
             
            $('.payment_pend_right_cash_error ').css('display','block');
            $('.payment_pend_right_cash_error ').text("ENTER DISCOUNT");
            $('.payment_pend_right_cash_error ').delay(2000).fadeOut('slow'); 
            
        }
           
           
           
  });
      
      
 $( "#dis_after_manual" ).keyup(function() {
     
        var ds1= $("#dis_after_manual").val();
      
        var st=$('#final').text();
        var subt=st.replace(',','');
      
    if(ds1!=''){
        
        $('#dis_after_drop').val(""); 
        $('#dis_after_drop').attr("disabled",true);
        
        if($("#dis_after_type").val()=='P' && parseFloat($("#dis_after_manual").val())>=100){
            
            $( "#dis_after_manual" ).val("");
            
            $('.payment_pend_right_cash_error ').css('display','block');
            $('.payment_pend_right_cash_error ').text("Discount should be less than 100%");
            $('.payment_pend_right_cash_error ').delay(2000).fadeOut('slow');
        }
        else if($("#dis_after_type").val()=='V' && parseFloat($("#dis_after_manual").val())>=parseFloat(subt)){
            
            $( "#dis_after_manual" ).val("");
            $('.payment_pend_right_cash_error ').css('display','block');
            $('.payment_pend_right_cash_error ').text('Discount should be less than Subtotal');
            $('.payment_pend_right_cash_error ').delay(2000).fadeOut('slow');
        }
  }else{
      
      $('#dis_after_drop').removeAttr('disabled');
      
 }
 
 });
      
      

  $('.clickdiableinuse').click(function () {
      
      $('.loaderrorsel').css("display", 'block');
      $('.loaderrorsel').addClass("tableselection_validate");
      $('.loaderrorsel').text("><?= $_SESSION['table_selection_error_sorry'] ?>");
      $('.loaderrorsel').delay(2000).fadeOut('slow');
      
  });
           
               
 $(".pin_proceed").unbind().click(function(event){
     
     
                event.stopImmediatePropagation();
                
                var pin =  $('#pin_split').val();
          
                if(pin !=''){
                
                   if($(this).hasClass('bill_reprtint_from_front')){
                    
                    var flr=$(this).attr('fl_chk');
                    var Bill_reprint = "Bill_reprint";
                    var billno=$('#settleingbilno').val();

                    $.post("printercheck_1.php", {type:Bill_reprint,floor:flr},
                    function(data){ 
                        
                        data=$.trim(data); 
                        if(data !=0)
                        { 
                            $('.kotconfirmpopup_reprint_di').css('display','block');   
                            $('#kotfailmsg_reprint_di').html(data);
                            $(".confrmation_overlay").css("display","block");
                            
                        }else{
                            
                            $.post("load_paymentpending.php", {pin:pin,type:'authpincheck',set:'pincheck'},
                            function(data){
                                
                                data=$.trim(data);
                                if(data!="NO"){
                                    
                                    var spl=data.split('*');
                                    if(spl[1]=='reprint:Y'){ 
                                        
                                           $('#copop').show();
                                           $('.confrmation_overlay_settle').hide();
                                           $('.settle_auth').hide();
                                           
                                        var dataString_log ='set_log_reprint_bill=log_reprint_bill&billno_reprint='+billno;
                                        $.ajax({
                                            type: "POST",
                                            url: "printercheck_1.php",
                                            data: dataString_log,
                                            success: function(data) {

                                            }
                                        });

                                        $.post("print_details.php", {bilno:billno,bill_reprint:'Y',set:'billprint'},
                                        function(data){
                                            
                                            data=$.trim(data);
                                            $(".pin_proceed").removeClass('bill_reprtint_from_front');
                                            $('.kotcancel_reason_popup_new').css('display','none');
                                            $('.confrmation_overlay_reprint').css('display','none');
                                            $('#pin_split').val('');
                                            $(".payment_pend_right_cash_error").css("display","block");
                                            $(".payment_pend_right_cash_error").addClass("popup_validate");
                                            $(".payment_pend_right_cash_error").text('Bill Reprinted');
                                            $('.payment_pend_right_cash_error').delay(2000).fadeOut('slow');

                                        });
                                        
                                    }
                                    else{
                                        
                                           $("#pin_error_split1").css("display","block");
					   $("#pin_error_split1").text("No Permission");
					   $("#pin_error_split1").delay(2000).fadeOut('slow');
                                           $("#pin_split").val('');
                                           $("#pin_split").focus();
                                           $('#copop').hide();
                                           $('.confrmation_overlay_settle').hide();
                                           $('.settle_auth').hide();
                                    }            
                                }
                                else{
                                    
                                        $("#pin_error_split1").css("display","block");
                                        $("#pin_error_split1").text("CODE IS NOT REGISTERED");
                                        $("#pin_error_split1").delay(2000).fadeOut('slow');
                                        $("#pin_split").val('');
                                        $("#pin_split").focus();
                                        $('#copop').hide();
                                        $('.confrmation_overlay_settle').hide();
                                        $('.settle_auth').hide();
						
				}
                            });
                        }    
                    });
                    
                }else if($(this).hasClass('bill_regenerate_from_front')){ 
                    
                   
                    var billno=$('#settleingbilno').val();
                    var reasontext = $('#reasontxt').val();
                    
                    var grandtotal=$('#grandtotal').text();
                    
                    $.post("load_paymentpending.php", {pin:pin,type:'authpincheck',set:'pincheck'},
                    function(data){
                        
                        data=$.trim(data);
                        
                        if(data!="NO"){
                            
                            var spl=data.split('*');
                            
                            if(spl[2]=='regen:Y'){ 
                                
                                  $('#paidamount').val('');  
                                  $('#balanceamout').val('0');
                                  $('.on_view_setlle_dl').hide();
                                  
                                  $('.confrmation_overlay_settle').hide();
                                  $('.settle_auth').hide();
                                             
                                 var dataString_log ='set=regen_split&billno_regen='+billno;
                                 $.ajax({
                                    type: "POST",
                                    url: "load_paymentpending.php",
                                    data: dataString_log,
                                    success: function(data) {
                                        
                                        
                                        var split_permission=$.trim(data);
                                        
                                        if(split_permission=="N"){
                                            
                                            var reasontext = $('#reasontxt').val();
                                          
                                            var stafflist        =  spl[0];
                                            
                                            var hidproc_regen=$('#hidproc_regen').val();
                                            
                                                    $(".pin_proceed").removeClass('bill_regenerate_from_front');
                                                    $('#pin_split').val('');
                                                    $('.kotcancel_reason_popup_new').css('display','none');
                                                    $('.confrmation_overlay_reprint').css('display','none');
                                                    $('.counter_settle_popup_section_cont').hide();
                                            
                                            
                                            $.post("load_paymentpending.php", {reasontext:reasontext,secretkey:'',stafflist:stafflist,grandtotal:grandtotal,bilno:billno,set:'billregenerate'},
                                            function(data2){ 
                                                data2=$.trim(data2);
                                                
                                                if(data2.indexOf("exception") == -1){
                                                    
                                                    
                                                    $(".pin_proceed").removeClass('bill_regenerate_from_front');
                                                    $('#pin_split').val('');
                                                    $('.kotcancel_reason_popup_new').css('display','none');
                                                    $('.confrmation_overlay_reprint').css('display','none');
                                                    $('.counter_settle_popup_section_cont').hide();
                                                    
                                                    $('#alertdiv').css('display','block');
                                                    $('#alertdiv').text(data2);
                                                    $('#alertdiv').delay(2000).fadeOut('slow');
                                                    
                                                 }else{
                                                        alert(data2)
                                                 }
                                                
                                            });
                                            
                                        }else{ 
                                            
                                             $('#copop').hide();
                                             $('.confrmation_overlay_settle').hide();
                                             $('.settle_auth').hide();
                                             $("#pin_error_split2").css("display","block");
                                             $("#pin_error_split2").addClass("billgenration_validate");
                                             $("#pin_error_split2").text("Spliited Bill Can't Be Regenerated");
                                             $("#pin_error_split2").delay(3000).fadeOut('slow');
                                        }
                                    }    
                                });    
                                
                            }else{ 
                                
                                 $('#copop').hide();
                                 $('.confrmation_overlay_settle').hide();
                                 $('.settle_auth').hide();
                                 $("#pin_error_split2").css("display","block");
                                 $("#pin_error_split2").text("No Permission");
                                 $("#pin_error_split2").delay(2000).fadeOut('slow');
                                 $("#pin_split").val('');
                                 $("#pin_split").focus();
                            }
                        }
                        else{   
                            
                            $('#copop').hide();
                            $('.confrmation_overlay_settle').hide();
                            $('.settle_auth').hide();
                            $("#pin_error_split2").css("display","block");
                            $("#pin_error_split2").text("CODE IS NOT REGISTERED");
                            $("#pin_error_split2").delay(2000).fadeOut('slow');
                            $("#pin_split").val('');
                            $("#pin_split").focus();
                            
                        }    
                    });
                    
                }else{  
                    
                    $.post("load_div.php", {pin:pin,type:'authpincheck',set:'pincheck'},
                    function(data)
                    { 
                   
                        data=$.trim(data);
                        var staff_sl=data.split('*');

                        if(data!="NO")
                        { 
                            if($.trim(staff_sl[7])=='ordersplit:Y'){


                                  $(".split_permission").hide();  
                                  $(".confrmation_overlay_new").hide();	
                                  $(".order-split-popup-section").show();
                                  $("#text_bill_split").val('');
                                  $("#text_bill_split").focus();
                                  $("#text_bill_split").attr("placeholder", "No Of Bills").placeholder();


                               }else{
                                   
                               $("#pin_error_split1").css("display","block");
                               $("#pin_error_split1").text("NO PERMISSION FOR ORDER SPLIT ");
                               $("#pin_error_split1").delay(2000).fadeOut('slow');
                               $("#pin_split").val('');
                               $("#pin_split").focus();
                                
                               }
                        }
                        else{
                            
                            
                            
                            $("#pin_error_split1").css("display","block");
                            $("#pin_error_split1").text("CODE IS NOT REGISTERED !");
                            $("#pin_error_split1").delay(2000).fadeOut('slow');
                            
                            $("#pin_split").val('');
                            $("#pin_split").focus();
                        }
                    });
                }
            }else{
                        if( $('.kotcancel_reason_popup_new_head').text()=='BILL REPRINT AUTHORIZATION'){
                            
                          $('#copop').hide();
                          $('.confrmation_overlay_settle').hide();
                          $('.settle_auth').hide();
                          $("#pin_error_split").css("display","block");
			  $("#pin_error_split").text("ENTER CODE");
			  $("#pin_error_split").delay(2000).fadeOut('slow');
                          $("#pin_split").focus();
                          
                    }
                      else  if( $('.kotcancel_reason_popup_new_head').text()=='BILL REGENERATE AUTHORIZATION'){ 
                          
                          $('#copop').hide();
                          $('.confrmation_overlay_settle').hide();
                          $('.settle_auth').hide();
                          $("#pin_error_split1").css("display","block");
			  $("#pin_error_split1").text("ENTER CODE");
			  $("#pin_error_split1").delay(2000).fadeOut('slow');
                          $("#pin_split").focus();
                          
                    }  
                      else{  
                          
                        $('#copop').hide();
                        $('.confrmation_overlay_settle').hide();
                        $('.settle_auth').hide();
                        $("#pin_error_split2").css("display","block");
			$("#pin_error_split2").text("ENTER CODE");
			$("#pin_error_split2").delay(2000).fadeOut('slow');
                        $("#pin_split").focus();
                        
                    }
                         
            }
            
	   });  
           
        
        
  $('.calculator_settle').click(function(event) {
      
     if($('.takeorder_div_password').css('display') == 'block'){
         
         $('#focusedtext_split_calc').val('pin');
         
     }else{
         
         $('#focusedtext_split_calc').val('pin_split'); 
     }
     
     if($('.complimentrary_cc').css('display') == 'block'){
         
         $('#focusedtext_split_calc').val('pin_pay'); 
     }
     
      if( $('.paid_amount_cc_credit').css('display') == 'block'){
            
         $('#focusedtext_split_calc').val('pin_pay'); 
     }
       
       
                event.stopImmediatePropagation();
               
		var focused=$('#focusedtext_split_calc').val();
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
		}
		$('#'+focused).change();
		$('#'+focused).focus();
		
    });
        
         
 });

</script>
<script type="text/javascript">
    
    function pop(div) {
               
          var mode_of_entry=$('#mode_of_entry').val();
         
          if(mode_of_entry=='Card/Pin'){
              
              $('.table_chaange_pop').show();
              $('.confrmation_overlay').show();
              $("#pin_table").val('');
              $("#pin_table").focus();
                
          }else{
              
                document.getElementById(div).style.display = 'block';
                
                var flr=$('.table_floor_select_btn_act').attr('fl_id_change');
            
                 $('#floor_change_val').val(flr);    
                 var data1 = "value=load_change_table_data&flor_id_change="+flr;
                 $.ajax({
                                    type: "POST",
                                    url: "load_div.php",
                                    data: data1,
                                    success: function(data) {
                                        
                                      $('#load_change_table_data').html(data);  
                                      
                                    }
                                   });                                        
                
                
                
            }
  }
            
            
   function hide(div) {
       
      document.getElementById(div).style.display = 'none';
   }
            
            
    //To detect escape button
    document.onkeydown = function (evt) {
                evt = evt || window.event;
                if (evt.keyCode == 27) {
                    hide('popDiv');
                }
   };
          
    
    
   function loc_settle_in(){
 
      window.parent.location="payment_pending.php";
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

 function close_customer_data_pop(){
     
    $('#load_loy_bill_data').hide();
    
    }


 function search_loy_pop_data(){ 
    
        var id_bill=$('#ly_id').val();
     
        var billno_src=$('#bill_loy_srch').val();
        var from_src=$('#from_loy_srch').val();
        var to_src=$('#to_loy_srch').val();
    
       var data2="value=loyalty_list_bill_bill_data&loy_id_list="+id_bill+"&bill_loy="+billno_src+"&from_loy="+from_src+"&to_loy="+to_src;
    
        $.ajax({
        type: "POST",
        url: "loyalty/load_loyalty_list.php",
        data: data2,
        success: function(data2)
        { 
         
        $('#bill_data_loy').html(data2);
         
         
         
        }
    });
}

 function list_loyalty_bill(){
    
    var id_bill=$('#ly_id').val();
    
    var data="value=loy_id_check_module&id_check="+id_bill;
    
        $.ajax({
        type: "POST",
        url: "loyalty/load_loyalty_list.php",
        data: data,
        success: function(data)
        { 
          
       var data_ch=$.trim(data);
   
   
        if(id_bill!='' && data_ch=='Yes'){
        
        $('#load_loy_bill_data').show(); 
        
        var data="value=loyalty_list_bill_general_data&loy_id_list="+id_bill;
    
        $.ajax({
        type: "POST",
        url: "loyalty/load_loyalty_list.php",
        data: data,
        success: function(data)
        { 
         
        $('#general_data_loy').html(data);
         
         
         
        }
  });
    
    
    
        var data1="value=loyalty_list_bill_fav_data&loy_id_list="+id_bill;
    
        $.ajax({
        type: "POST",
        url: "loyalty/load_loyalty_list.php",
        data: data1,
        success: function(data1)
        { 
         
          $('#fav_data_loy').html(data1);
         
        }
    });
    
    
     var data2="value=loyalty_list_bill_bill_data&loy_id_list="+id_bill;
    
        $.ajax({
        type: "POST",
        url: "loyalty/load_loyalty_list.php",
        data: data2,
        success: function(data2)
        { 
         
          $('#bill_data_loy').html(data2);
         
        }
    });
    
    
  }else{
               $("#loy_error").show();
               var error_show=$('#loy_error');
	       error_show.text('Invalid Customer Details');	
	       $("#loy_error").delay(2000).fadeOut('slow'); 
               $('#ly_id').focus();
  }
     }
   });
    
 }
    
    
    
    function dischange_after(){
     
     var ds=$('#dis_after_drop').val();
     
     if(ds!=''){
         
          $("#dis_after_manual").val('');
          $("#dis_after_manual").attr('disabled',true);
          $("#dis_after_type").attr("disabled",true);
          
      }else
      {
           
        $("#dis_after_manual").attr('disabled',false); 
        $("#dis_after_type").removeAttr('disabled');
      }
    }
    
    
    
    function update_pax_order(){
        
         var pax= $("#pax_update_new").val(); 
         
         var upd_order= $("#pax_update_new").attr('order_id'); 
        
         var data2="set=update_pax_order_new&order="+upd_order+"&pax="+pax;
    
        $.ajax({
        type: "POST",
        url: "load_index.php",
        data: data2,
        success: function(data2)
        { 
         
          location.reload();
         
        }
    });
    
       
    }
 </script>
 
  <script src="js/tabl_sel.js"></script>
  <script src="js/load_tabl_sum.js"></script>

</head>
<?php
require_once("includes/title_settings.php");
include('includes/master_settings.php');
include('includes/menu_settings.php');

?>
   <style>.quick_navigation_nav_ico{padding-top: 1px}</style>
   
   
   <style>
    body {
     opacity: 0;
     transition: opacity 0.3s ease-in-out;   /* smoother fade */
    }
    body.loaded {
      opacity: 1;
    }
    </style> 
    
   
   <script type="text/javascript">
    
   $(document).ready(function(){  
     
       window.onload = function() {
        document.body.classList.add("loaded");
       };
   
   });
   
   </script>
   
   
    <body>
            
          <div class="confrmation_overlay_proce_load" id="bill_print_loader_new">
        
          </div>
        
        <?php
        
         $shift_yes='N';
         $sql_table_sel1 = $database->mysqlQuery("select ser_shift_permission from tbl_staffmaster where ser_shift_permission='Y' ");
                         $num_table1 = $database->mysqlNumRows($sql_table_sel1);
                         if ($num_table1) {
                             
                             $shift_yes='Y';
                         }
           ?> 
        
            <input type="hidden" value="<?=$shift_yes?>" id="shift_yes" > 
            
           <input type="hidden" value="<?=$_SESSION['ser_all_shift_closer']?>" id="all_shift_closer" > 
           
           <input type="hidden" value="<?=$_SESSION["archive_enabled"]?>" id="archieve_onoff" >

           <input type="hidden" id="cloud_api_on" value="<?=$_SESSION['cloud_enable_sync']?>" >

            <input value="<?=$_SESSION['s_cash_drawer']?>" id="cash_drawer_on_off" type="hidden">
            <input value="<?=$_SESSION['s_customer_display']?>" id="pole_on" type="hidden">
            <input type="hidden" value="<?=$floorid?>" id='floor_change_hidden' >
            <input type="hidden" value="<?= $_SESSION['s_default_company']?>" id="default_company" >
            
             <input type="hidden" id="code_comp_credit" >
             <input type="hidden" id="auth_val_set" >
             <input type="hidden" value="<?= $_SESSION['di_settle_auth']?>" id="di_settle_auth">
             <input type="hidden" value="<?= $_SESSION['be_staff_sel_mode']?>" id="mode_of_entry">
             <input type="hidden" id="coupon_code" >
             <input type="hidden"  id="decimal" value="<?=$_SESSION['be_decimal']?>">
             <input type="hidden"  id="pax_entry_new" value="<?=$_SESSION['s_persct']?>">        
                    
             <input type="hidden" value="<?=$_SESSION['be_kot_miss_check']?>" id="kot_miss_check" >       
                    
        <a href="loyalty/registration.php"> <div style="display: none" class="register_loyalty_table_selection_btn">
        <img src="img/user-loyalty-icon.png" title="Register">
        
        </div> </a>
                    
        <div id="container">
            
        <?php include "includes/topbar.php"; ?>
        
        </div> 
      
        <div class="main_floor_text col-md-12 nopadding" style="text-align:center"> 
                    
                    
                <?php if(in_array("take_away", $_SESSION['menuarray'])) { ?> 
            
                	<a title="Take Away" href="take_away.php"><div class="qiuck_table_ico"><img src="img/takeaway-ico.png"></div></a>
                        
                <?php } ?>
                        
                        <div style="width: 55px;height: auto;float: left;margin-left:0.5%;" title="TABLE COMBINE">
                            <button class="compaing_table_button tablecamp" id="tablebutton1" style="display:block" onClick="table_enableButton1()" >
                            <img style="width:15px" src="img/master_table_mn_ico.png" alt=""> ++
                         </button>
                        <!-- <?=$_SESSION['combine_table']?> -->
                            <button class="compaing_table_button tablecamp1" id="tablebutton2" style="display:none" onClick="table_enableButton2()"> <img style="width:15px" src="img/master_table_mn_ico.png" alt=""> ++</button>

                        </div>
                        <div class="alert_table_bill_prt" id="alertdiv" style="display:none">
                            
                        </div>
                    <div class="left_table_floor_sel" style="width:74%">
                        <?php
                        
                         $sql_table_sel1 = $database->mysqlQuery("select be_count_on,be_order_split_authorise,be_order_split from tbl_branchmaster");
                         $num_table1 = $database->mysqlNumRows($sql_table_sel1);
                         if ($num_table1) {
                          while ($result_table_sel1 = $database->mysqlFetchArray($sql_table_sel1)) {
                                   $counton= $result_table_sel1['be_count_on'];
                                   $split_authorize=$result_table_sel1['be_order_split_authorise'];
                                   $split_enable=$result_table_sel1['be_order_split'];
                            }
                         }
                           
                            
                            
                        $sql_floor_sel = '';
                        if (!is_null($_SESSION['floorstaff'])) {

                            $sql_floor_sel = $database->mysqlQuery("select * from tbl_floormaster where fr_branchid='" . $_SESSION['branchofid'] . "' AND fr_floorid='" . $_SESSION['floorstaff'] . "'  and fr_status='Active' order by fr_order_display asc");
                        } else {
                            $sql_floor_sel = $database->mysqlQuery("select * from tbl_floormaster where fr_branchid='" . $_SESSION['branchofid'] . "' and fr_status='Active' order by fr_order_display asc");
                        }
                        
                        $num_floor = $database->mysqlNumRows($sql_floor_sel);
                        if ($num_floor) {
                            
                            $i = 0;
                            while ($result_floor_sel = $database->mysqlFetchArray($sql_floor_sel)) {
                                if ($i == 0) {
                                    $first = $result_floor_sel['fr_floorid'];
                                    if (isset($_SESSION['floorid_ser'])) {
                                        if (!isset($_SESSION['floorid'])) {
                                            $_SESSION['floorid'] = $_SESSION['floorid_ser'];
                                            $first = $_SESSION['floorid_ser'];
                                        } else {

                                            $first = $_SESSION['floorid'];
                                        }
                                    } else {
                                        if (!isset($_SESSION['floorid'])) {
                                            $_SESSION['floorid'] = $first;
                                        }
                                   }
                                    
                                  
                             $i++;   
                           }
                                
                           $firstfloor = $result_floor_sel['fr_floorname'];
                           $floor_name=$result_floor_sel['fr_floorname'];
                           $_SESSION['florids'] = $first;
                                                   
                           if($_SESSION['main_language']!='english'){
                
                             $sql_arabfloor=$database->mysqlQuery("SELECT f_floor_name FROM tbl_language_floor left join tbl_languages on ls_id=f_lang_id WHERE f_floor_id='".$result_floor_sel['fr_floorid']."' and ls_language='".$_SESSION['main_language']."'");

                             $num_arabfloor = $database->mysqlNumRows($sql_arabfloor);
                              if($num_arabfloor){
                                while ($result_arabfloor = $database->mysqlFetchArray($sql_arabfloor)){
                                $floor_name=$result_arabfloor['f_floor_name'];

                           }}}
             
                                
                           ?>
                        
                            <div class="table_floor_select_btn <?php if ($_SESSION['floorid'] == $result_floor_sel['fr_floorid']) { ?> table_floor_select_btn_act <?php } ?> " fl_id_change='<?= $result_floor_sel['fr_floorid'] ?>'   id="flr_<?= $result_floor_sel['fr_floorid'] ?>"><a  title="<?= $result_floor_sel['fr_floorname'].' : '.$result_floor_sel['fr_floorid'] ?>" ><?= $floor_name?></a></div>

                           <?php }  } ?>
                            
                              <?php if(in_array('bill_history', $_SESSION['menufullarray'])) { ?>
                              <a title="BILL HISTORY" href="bill_history.php" style="opacity: 0.6;float:right;margin-right: 11px;margin-top: -2px"><img style="background-color:#a5a3a3;border:solid 3px #032621;border-radius: 5px;" src="img/bill-icon.png"></a>
                              <?php } ?>      
                                
                    </div>
                    
                    
                </div>

                <div class="right_goto_billhis_cc">
                  
                </div>

                    <div class="center_cc_btn">   
                    <div  class="left_buton_cc" style="width:78%">
                    <ul id="load_tables" style="cursor:pointer"> 
                    <?php
                            $stfname = "";
                            
                            $database->mysqlQuery("SET @floor='".$_SESSION['floorid']."'");
                           
                            $sql_table_sel=$database->mysqlQuery("CALL proc_table_list(@floor)") or $database->throw_ex(mysqli_error($database->DatabaseLink)); 
                            $num_table = $database->mysqlNumRows($sql_table_sel);
                            if ($num_table) {
                                while ($result_table_sel = $database->mysqlFetchArray($sql_table_sel)) {
                                          
                                            $table_vacantcount=0;
                                            $table_name = '';
                                            $table_id = '';
                                            $table_vacantcount ='';
                                            $table_nextprefix = '';
                                            $total_amount =  0;
                                            $persons_count = 0;
                                            $table_prefix= 0;
                                            $status='';
                                            $stfname1 ='';
                                            $stfname2='';
                                             
                                            $in_access=''; 
                                            $bill_number='';   
                                            $dinetime='';
                                                
                                            $reserved = 0;
                                            $billed = 0;
                                            $pending = 0;
                                            $opened = 0;
                                            $added = 0;
                                            
                                            
                                            
   if($status[0] == "Reserved"){
                           
                          $reserved++;
                          $stfname = "";
                          $reserve_time = $result_table_sel['reservetime'];
                                               
                        ?>
                                                <li class="buttons <?php if ($in_access[0] == 'Y') { ?> clickdiableinuse <?php } ?>">
                                                <a class='buttons_tab_active_3 none_shadow selectstafforedit  <?php if ($in_access[0] == 'Y') { ?> notifydisable <?php } ?> <?php if(in_array($table_id,$_SESSION['ajaxtableid'])){ ?> table_select  <?php } ?>'  ordrd="my_<?= $result_table_sel['orderno'] ?>"  title='Title 2' stvid="stf_<?= $stfname ?>">
                                                 <div class="table_chair_count new_table_chair"><?= $persons_count ?></div>	
                                                       
                                                <input name="" class="table_edt_change table_edt_change_active" value="<?=$_SESSION['table_selection_button_add']?>" type="submit">
                                                <div class="table_order_main">
                                                  <strong class="table_name_active"><?= $table_name . " (" . $result_table_sel['table_prefix'] . ")"?></strong>
                                                  <!--<span class="font_order time_reserved"><?//date("h:i:s",strtotime($result_table_sel1['ts_dineintime'])) //$kotid?></span-->
                                                  <span class="reserved_new"><?= $stfname ?> <?=$_SESSION['table_selection_reserved']?></span>
                                                  <div class="reserved_time "><?= date("h:i A", strtotime($reserve_time)) //$kotid ?></div><!--reserved_over-->

                                                        </div>
                    <?php if ($in_access[0] == 'Y') { ?>
                                                
                      <span class="notify_inuse "></span>
                                                          
                     <?php } ?>
                                                    </a>
                                                    <div class="reserved_close cancelreservation" ordrd="my_<?= $result_table_sel['orderno'] ?>"><img src="img/cancel-icon.png"></div>
                                                </li>
  <?php } 
                                             
                                           if($result_table_sel['orderno']!='') {
                  
                                            $table_vacantcount=0;
                                            $persons_count1=0; 
                                            $order_from= explode(',',$result_table_sel[20]);
                                              
                                              if($order_from[0]=="W"){
                                                  $orderby="P";
                                              }else if($order_from[0]=="A"){
                                                 $orderby="S" ;
                                              }else if($order_from[0]=="E"){
                                                 $orderby="E";   
                                              }
                                            $addon_total=0;
                                            $table_name = explode(',',$result_table_sel[1]);
                                            $table_id = explode(',',$result_table_sel[0]);
                                            $table_vacantcount =explode(',', $result_table_sel[7]);
                                            $table_nextprefix = $result_table_sel[4];
                                            $total_amount =  explode(',',$result_table_sel[14]);
                                            $persons_count = explode(',',$result_table_sel[15]);
                                            $table_prefix= explode(',',$result_table_sel[2]);
                                            $status=explode(',',$result_table_sel[3]);
                                            $stfname1 =explode(',',$result_table_sel[10]);
                                            $stfname2=explode(',',$result_table_sel[11]);
                                            //$pp=$pp.",".$result_table_sel['orderno'];
                                            $in_access=explode(',',$result_table_sel[16]); 
                                            $bill_number=explode(',',$result_table_sel[17]);    
                                            $dinetime=explode(',',$result_table_sel[18]);
                                            
                                            for($v=0;$v<count($persons_count);$v++){
                                               $persons_count1= ($persons_count1+$persons_count[$v]/count($table_id));
                                            }
                                            
                                        $sql_addon_total = mysqli_query($localhost,"select sum(ad_total_rate) as addon_total FROM tbl_order_addon"
                                        . " where ad_orderno='".$result_table_sel['orderno']."' ");
                                        $num_addon_total = $database->mysqlNumRows($sql_addon_total);
                                        if ($num_addon_total) {
                                            while ($result_addon_total = $database->mysqlFetchArray($sql_addon_total)) {
                                                
                                               $addon_total= $result_addon_total['addon_total'];

                                            }
                                        }
                      
                                        
                    $total_amount[0]=$total_amount[0]+ $addon_total; 
                                          
                    if($status[0] == "Billed") {
      
                    $billed++;
                   
                    $sql_billed = mysqli_query($localhost,"SELECT bm_qr_orderno, bm_billno,bm_billtime, bm_finaltotal FROM tbl_tablebillmaster bm
                    left join tbl_tabledetails td on td.ts_billnumber = bm.bm_billno
                    WHERE bm.bm_dayclosedate='".$_SESSION['date']."' and td.ts_orderno = '" . $result_table_sel['orderno'] . "' ");
                    
                    $result_billed = $database->mysqlFetchArray($sql_billed);
                    
                    if($result_billed['bm_qr_orderno']!=""){
                       $qr_in='(QR)';
                    }
                    
                    
                    if($result_billed['bm_finaltotal']!=""){
                        
                        $tot_bill=number_format($result_billed['bm_finaltotal'],$_SESSION['be_decimal']);
                        
                    }else{
                        
                        $tot_bill="Splitted";
                        $spited_billnos=array();
                        $sql_get_spited_billnos = mysqli_query($localhost,"select distinct(bm.bm_billno) as splited_billnos"
                        . "  FROM tbl_tablebillmaster bm where bm.bm_dayclosedate='".$_SESSION['date']."' and "
                        . " bm.bm_orderno LIKE '%".$result_table_sel['orderno']."%' and bm_status='Billed'");
                        $num_spited_billnos     = mysqli_num_rows($sql_get_spited_billnos);
                        if($num_spited_billnos){
                            while($result_get_spited_billnos = $database->mysqlFetchArray($sql_get_spited_billnos)){
                                $spited_billnos[]=$result_get_spited_billnos['splited_billnos'];
                            }
                        }
                    }
                    ?>
                          <li class="buttons <?php if ($in_access[0] == 'Y') { ?> testingd <?php } if(count($table_id)>1){?> combine_active <?php } ?>">
                           <a id="loader_disable<?=$result_billed['bm_billno']?>"  class='buttons_tab_active_4 none_shadow  billedclic  <?php if ($in_access[0] == 'Y') { ?> notifydisable <?php } ?>' billedno="<?php if($tot_bill!='Splitted') { echo $bill_number[0];} else{ echo implode(',',$spited_billnos);} ?>" ordrd="my_<?= $result_table_sel['orderno'] ?>"  tot_new="<?=$tot_bill?>" title='Title 2' stvid="stf_<?= $stfname1[0].' '. $stfname2[0] ?>">
                                                      
                                                        <div class="loader_to_bill" id="loader_to_bill_id<?=$result_billed['bm_billno']?>" style="display:none">  </div>     
                                                        <div class="table_chair_count new_table_chair"><?= $persons_count1  ?></div>
                                                        <input name="" class="table_edt_change table_edt_change_active" value="<?= $status[0] ?>" type="submit">
                                                        <div class="table_order_main">
                                                            <strong class="table_name_active"> <?php for($z=0;$z<count($table_name);$z++){ if($z>0) { echo '+' ;} echo $table_name[$z]. " (" . $table_prefix[$z] . ")"; } ?></strong>
                                                            <span class=""><?= date("h:i:s", strtotime($result_billed['bm_billtime'])) //$kotid ?></span>
                                                           <span class="new_size_changer"> <span class="order-dev"><?=$orderby?></span><?=$stfname1[0].' '.$stfname2[0] ?> <?=$qr_in?></span>
                                                            <div class="table_rate_new">  <?= $tot_bill ?></div>
                                                            <div class="billed_in_table"><?= $status[0] ?></div>
                                                        </div>
                    <?php if ($in_access[0] == 'Y') { ?>
                                   <span class="notify_inuse "></span>
                                                         
                    <?php } ?>
                                                       
  </a>
  </li>
<?php }
 

else if ($status[0] == "Added" ||$status[0]  =="Occupied") { 
                                            
                            $added++;
                                                        
                            $sql_table_sel13 = mysqli_query($localhost,"select tr_timealloted from tbl_tablemaster where tr_tableid='".$table_id[0]."' ");
                            $num_table13 = $database->mysqlNumRows($sql_table_sel13);
                            if ($num_table13) {
                                while ($result_table_sel13 = $database->mysqlFetchArray($sql_table_sel13)) {
                                    
                                   $max_time= $result_table_sel13['tr_timealloted'];
                                    
                                    
                                }
                            }
                            
                            $i=date("h:i:s");
                                                               $a=date("h:i:s",  strtotime($i));
                                                               $b=date("h:i:s", strtotime($dinetime[0]));
                                                               
                                                                 $tabletime123 = date('h:i:s',strtotime("+".$max_time." minutes", strtotime($dinetime[0])));
                                                                 $dteStart = new DateTime($a); 
                                                                    $dteEnd   = new DateTime($b); 
                                                                $f=$dteStart->diff($dteEnd); 
                                                             
                                                                      ?>
                                                
                                                
                                                 <?php if($a>$tabletime123 && $counton=="Y"){ $rt="table_time_out"; }  else{$rt="";} ?>
                                                
                                                
                                                
                                                
                                                
                                                <li class="buttons <?php if ($in_access[0] == 'Y') { ?> testingd clickdiableinuse <?php } if(count($table_id)>1){?> combine_active <?php } ?>">
                                                    <a class=' <?=$rt?> buttons_tab_active dbl_click none_shadow selectstafforedit  <?php if ($in_access[0] == 'Y') { ?> notifydisable <?php } ?> <?php if(in_array($table_name[0]. $table_prefix[0],$_SESSION['ajaxtablename'])){ ?> table_select  allready <?php } ?> ' ordrd="my_<?= $result_table_sel['orderno'] ?>"  title='Title 2' stvid="stf_<?= $stfname ?>" tableno="<?php  for($z=0;$z<count($table_name);$z++){ echo $table_name[$z]. $table_prefix[$z].',';} ?>">
                                                        <div class="table_chair_count new_table_chair"><?= $persons_count1  ?></div>
                                                    
                                                        <input name="" class="table_edt_change table_edt_change_active" value="<?=$_SESSION['table_selection_button_add']?>" type="submit">
                                                        <div class="table_order_main">
                                                            <strong class="table_name_active"><?php for($z=0;$z<count($table_name);$z++){ if($z>0) { echo '+' ;} echo $table_name[$z]. " (" . $table_prefix[$z] . ")"; } ?></strong>
                                                           
                                                            <span class=""><?php if($counton=="N"){ echo $b; }  else{ print $f->format("%H:%I:%S");}?></span>
                                                          <span class="new_size_changer"> <span class="order-dev"><?=$orderby?></span><?=$stfname1[0].' '.$stfname2[0] ?></span>
                                                            <div class="table_rate_new"><?= number_format($total_amount[0],$_SESSION['be_decimal']) ?></div>
                                                        </div>
                    <?php if ($in_access[0] == 'Y') { ?>
                                                            <span class="notify_inuse "></span>
                                                          <!--  <span class="notifydisable"></span>-->
   <?php } ?>
   </a>
   </li>
<?php } 

else if ($status[0] == "Served") {
    
    
    $qr_in4='';
                                        
                    $sql_billed4 = mysqli_query($localhost,"SELECT  ter_qr_order FROM tbl_tableorder 
                   
                    WHERE ter_dayclosedate='".$_SESSION['date']."' and ter_orderno = '" . $result_table_sel['orderno'] . "' ");

                    $result_billed4 = $database->mysqlFetchArray($sql_billed4);
                   
                    if($result_billed4['ter_qr_order']!=""){
                       $qr_in4='[QR]';
                    }
    
    
    
                         $serverd++;
                         $new_order_bill='';             
                                                
                         $new_table_bill='';
                                    
                          $sql_table_sel12 = mysqli_query($localhost,"select tr_floorid,tr_timealloted from tbl_tablemaster where tr_tableid='".$table_id[0]."' ");
                            $num_table12 = $database->mysqlNumRows($sql_table_sel12);
                            if ($num_table12) {
                                while ($result_table_sel12 = $database->mysqlFetchArray($sql_table_sel12)) {
                                   $max_time= $result_table_sel12['tr_timealloted'];
                                   $floor_table_new=$result_table_sel12['tr_floorid'];
                                    
                                    
                                }
                            }
                                  $i=date("h:i:s");
                                                               $a=date("h:i:s",  strtotime($i));
                                                               $b=date("h:i:s", strtotime($dinetime[0]));
                                                               
                                                                 $tabletime123 = date('h:i:s',strtotime("+".$max_time." minutes", strtotime($dinetime[0])));
                                                                 $dteStart = new DateTime($a); 
                                                                 $dteEnd   = new DateTime($b); 
                                                                 $f=$dteStart->diff($dteEnd); 
                                                                 //echo $a.',';
                                                                 //echo $tabletime123.',';
                                                                      ?>               
                                                 
                                                <?php if($a>$tabletime123 && $counton=="Y"){ $rt="table_time_out"; }  else{$rt="";} ?>
                                                
                                                
                                                <li <?php if ($qr_in4!='') { ?> style="opacity: 0.5;pointer-events: none" <?php } ?> class=" buttons <?php if ($in_access[0] == 'Y') { ?> testingd clickdiableinuse <?php } if(count($table_id)>1){?> combine_active <?php } ?>" >
                                                <a  class='<?=$rt?> buttons_tab_active_2 dbl_click none_shadow selectstafforedit print_bill_from_table    <?php if ($in_access[0] == 'Y') { ?> notifydisable <?php } ?> <?php if(in_array($table_name[0]. $table_prefix[0],$_SESSION['ajaxtablename'])){ ?> table_select allready <?php } ?>' ordrd="my_<?= $result_table_sel['orderno'] ?>" title='Title_<?php for($z=0;$z<count($table_id);$z++){ echo $table_id[$z]."'"; } ?>' stvid="stf_<?= $stfname1[0].' '.$stfname2[0] ?>" floor="<?=$_SESSION['floorid']?>" tableno="<?php  for($z=0;$z<count($table_name);$z++){ echo $table_name[$z]. $table_prefix[$z].',';} ?>"  >
                                                <div style="right:35px"  class="table_chair_count new_table_chair"><?= $persons_count1  ?></div>
                                                <input  style="display:none" name="" class="table_edt_change table_edt_change_active" value="<?=$_SESSION['table_selection_button_add']?>" type="submit">
                                                       
                                                         
                                                       <?php for($z=0;$z<count($table_name);$z++){ if($z>0) { $new_table_bill.= ',' ;} $new_table_bill.= $table_name[$z]. "(" . $table_prefix[$z] . "),"; } 
                                                       
                                                       
                                                       $new_order_bill=$result_table_sel['orderno'].',';
                                                       
                                                       ?>
                                                      
                                                      
                                                       <span onclick="print_one_click('<?=str_replace(',,',',',$new_order_bill)?>','<?=str_replace(',,',',',$new_table_bill)?>');" style="display:block; <?php if ($qr_in4!='') { ?> opacity: 0.8;pointer-events:auto <?php } ?>" name="" class="table_edt_change4 table_edt_change_active"></span>
                                                       
                                                       <span onclick="view_one_click('<?=str_replace(',,',',',$new_order_bill)?>','<?=str_replace(',,',',',$new_table_bill)?>');" style="display:block; <?php if ($qr_in4!='') { ?> opacity: 0.8;pointer-events:auto <?php } ?>" name="" class="table_edt_change5 table_edt_change_active"></span>
                                                       
                                                      
                                                        <div class="table_order_main">
                                                            <strong class="table_name_active"><?php for($z=0;$z<count($table_name);$z++){ if($z>0) { echo '+' ;} echo $table_name[$z]. " (" . $table_prefix[$z] . ")"; } ?></strong>
                                                         
                                                              
                                                            <span class=""><?php if($counton=="N"){ echo $b; }  else{ print $f->format("%H:%I:%S");}?></span>
                                                       
                                                          
                                                           <span class="new_size_changer"> <span class="order-dev"><?=$orderby?></span><?=  substr($stfname1[0].' '.$stfname2[0],0,13 )?>  <?=$qr_in4?> </span>
                                                            
                                                            <?php $combine_check='N'; for($z=0;$z<count($table_name);$z++){if($z>0) { $combine_check='Y'; ?>
                                                                
                                                              <?php } }
                                                              
                                                              if($combine_check=='Y'){
                                                              
                                                              ?>  
                                                            
                                                               <span style="float:right;width:20%;height: 10px;margin-top: 2px;margin-right: 23%"><img  style="width:20px" src="img/combine_add.png"></span>
                                                              
                                                                <?php }  ?>   
                                                               
                                                               
                                                               
                                                            <?php
                                           $total_di=$total_amount[0];
                                                   
                                           
                if($_SESSION['uae_tax_enable']=='Y'){
                          
                         
                $total_di=$total_di/(1+($_SESSION['uae_tax_value']/100));
                }   
                
                $total2=0;                                      
                $new_tot1 = mysqli_query($localhost,"SELECT  ter_menuid,ter_total_rate FROM tbl_tableorder 
                WHERE ter_dayclosedate='".$_SESSION['date']."' and ter_orderno = '".$result_table_sel['orderno']."' limit 250");
                                          $num_11 = $database->mysqlNumRows($new_tot1);
                                           if ($num_11) {
                                            while ($new_tot_amt1 = $database->mysqlFetchArray($new_tot1)) {
                                                
                                                                        
              $tax_in1 = mysqli_query($localhost,"SELECT amc_value,amc_unit FROM tbl_extra_tax_master te left join tbl_menu_tax_master "
              . " tem on tem.mtm_tax_id=te.amc_id where te.amc_active='Y'  and te.amc_item_tax='Y' "
              . " and tem.mtm_menuid='".$new_tot_amt1['ter_menuid']."'  ");
              
                                          $num_tx1 = $database->mysqlNumRows($tax_in1);
                                          if($num_tx1) {
                                             while ($tx_in1 = $database->mysqlFetchArray($tax_in1)) {
                                                    
                                                    $tax_value1=$tx_in1['amc_value'];
                                                    $tax_unit1=$tx_in1['amc_unit'];
                                                      
                                                    if($tax_unit1=="P"){
                                                       
                                                        $total2=  $total2+($new_tot_amt1['ter_total_rate']*$tax_value1/100);
                                                            
                                                    }else if($tax_unit1=="V"){
                                                      
                                                        $total2=  $total2+$tax_value1;
                                                       
                                                    } 
                                                    
                                          }}
          }}                              
                                            
                                           
     $minus_tot=0;      
    
     $new_tot = mysqli_query($localhost,"SELECT sum(ter_total_rate) as minus_tot FROM tbl_tableorder 
      WHERE ter_dayclosedate='".$_SESSION['date']."' and ter_orderno = '".$result_table_sel['orderno']."'"
    . "  AND ter_menuid IN(SELECT mr_menuid  FROM  tbl_menumaster WHERE mr_excempt_tax ='Y') limit 250");
                                          $num_1 = $database->mysqlNumRows($new_tot);
                                           if ($num_1) {
                                            while ($new_tot_amt = $database->mysqlFetchArray($new_tot)) {
                                                    
                                                $minus_tot=$new_tot_amt['minus_tot'];
                                             }
                                           }           
                                            
                                            
                   $new_tot_all=($total_di-$minus_tot);                           
                                           
                 
                            $total1=0;   
                            $tax_in = mysqli_query($localhost,"SELECT amc_value,amc_unit FROM tbl_extra_tax_master left join tbl_floor_tax on "
                            . " tbl_floor_tax.ft_tax_id=tbl_extra_tax_master.amc_id where amc_active='Y' "
                            . " and amc_item_tax!='Y'  and ft_floorid='".$_SESSION['floorid']."' ");
                            
                          
                            $num_tx = $database->mysqlNumRows($tax_in);
                            if($num_tx) { 
                                while ($tx_in = $database->mysqlFetchArray($tax_in)) {
                                    
                                    $tax_value=$tx_in['amc_value'];
                                    $tax_unit=$tx_in['amc_unit'];

                                   
                                    if($tax_unit=="P"){

                                          $total1=  $total1+($new_tot_all*$tax_value/100);

                                    }else if($tax_unit=="V"){
                                        $total1=  $total1+$tax_value;
                                    }


                                 }
                                }
                   
                                
                                         $tax_in1_rf = mysqli_query($localhost,"SELECT be_nearest_roundoff_value FROM tbl_branchmaster ");
                                         $num_tx1_rf = $database->mysqlNumRows($tax_in1_rf);
                                         if ($num_tx1_rf) {
                                                while ($tx_in1_rf = $database->mysqlFetchArray($tax_in1_rf)) {
                                                    
                                                      $rof_ta=$tx_in1_rf['be_nearest_roundoff_value'];
                                                }
                                                }
                                                
                                           
                                                if($rof_ta==0){
                                                    
                                                     $tot_tax_in=($total1+$total2);
                                                     $tot_new_in= ($total_di+$total1+$total2);	
                                                   
                                                }else{
                                                    
                                                    $tot_tax_in=($total1+$total2);
                                                    
                                                    $tot_new_in= ($rof_ta*round(($total_di+$total1+$total2)/$rof_ta));	
                                                    
                                                }
                   
                                                 if($_SESSION['incl_bill_format']=='Y'){
                                                 
                                                $tot_new_in=$total_amount[0]; 
                                             }
                                           ?>    
                                                               
                                                               
                                                               
                                                               
                                                               
                                                               
                                                            <div  class="table_rate_new"><?=  number_format($tot_new_in,$_SESSION['be_decimal'])?></div>
                                                        </div>
                                                        <?php if ($in_access[0] == 'Y') { ?>
                                                            <span class="notify_inuse "></span>
                                                           
                                                            <?php } ?>
                                                    </a>
                                                    
                                                      
                                                    
                                                    
                                                    
 </li>
  
<?php } 

else if ($status[0] == "Opened" || $status[0] == "Ready") {
    
                          $opened++;
                                                            
                          $sql_table_sel14 = mysqli_query($localhost,"select tr_timealloted from tbl_tablemaster where tr_tableid='".$tableid[0]."' ");
                            $num_table14 = $database->mysqlNumRows($sql_table_sel14);
                            if ($num_table14) {
                                while ($result_table_sel14 = $database->mysqlFetchArray($sql_table_sel14)) {
                                   $max_time= $result_table_sel14['tr_timealloted'];
                                    
                                    
                                }
                            }
                                  $i=date("h:i:s");
                                                               $a=date("h:i:s",  strtotime($i));
                                                               $b=date("h:i:s", strtotime($dinetime[0]));
                                                               
                                                                 $tabletime123 = date('h:i:s',strtotime("+".$max_time." minutes", strtotime($dinetime[0])));
                                                                 $dteStart = new DateTime($a); 
                                                                 $dteEnd   = new DateTime($b); 
                                                                 $f=$dteStart->diff($dteEnd); 
                                                                 
                                                                      ?> 
                                                
                                                 <?php if($a>$tabletime123 && $counton=="Y"){ $rt="table_time_out"; }  else{$rt="";} ?>
                                                
                                                <li class="buttons <?php if ($in_access[0] == 'Y') { ?> testingd clickdiableinuse <?php } if(count($table_id)>1){?> combine_active <?php } ?>">
                                                    <a class=' <?=$rt?> buttons_tab_active_1 none_shadow selectstafforedit  <?php if ($in_access[0] == 'Y') { ?> notifydisable <?php } ?> <?php if(in_array($table_name[0]. $table_prefix[0],$_SESSION['ajaxtablename'])){ ?> table_select allready <?php } ?>' ordrd="my_<?= $result_table_sel['orderno'] ?>" title='Title 2' stvid="stf_<?= $stfname1[0].' '.$stfname2[0] ?>" tableno="<?php  for($z=0;$z<count($table_name);$z++){ echo $table_name[$z]. $table_prefix[$z].',';} ?>">
                                                        <div class="table_chair_count new_table_chair"><?=  $persons_count1 ?></div>
                                                        <input name="" class="table_edt_change table_edt_change_active" value="<?=$_SESSION['table_selection_button_add']?>" type="submit">
                                                        <div class="table_order_main">
                                                            <strong class="table_name_active"><?php for($z=0;$z<count($table_name);$z++){ if($z>0) { echo '+' ;} echo $table_name[$z]. " (" . $table_prefix[$z] . ")"; } ?></strong>
                                                            
                                                            <span class=""><?php if($counton=="N"){ echo $b; }  else{ print $f->format("%H:%I:%S");}?></span>
                                                          <span class="new_size_changer"> <span class="order-dev"><?=$orderby?></span><?=$stfname1[0].' '.$stfname2[0] ?></span>
                                                            <div class="table_rate_new"><?= number_format($total_amount[0],$_SESSION['be_decimal'])?></div>
                                                        </div>
                    <?php if ($in_access[0] == 'Y') { ?>
                         <span class="notify_inuse "></span>
                       
                    <?php } ?>
                                                    </a>
                                                </li>
                <?php } 
                    
                }
                                                        
                                   
                                    if ($result_table_sel['orderno']=='') {
                                        
                                           $table_name = explode(',',$result_table_sel[1]);
                                           $table_id = explode(',',$result_table_sel[0]);
                                           $table_vacantcount = explode(',',$result_table_sel[6]);
                                           $table_nextprefix = explode(',',$result_table_sel[4]);
                                           $total_amount = explode(',',$result_table_sel[14]);
                                           $persons_count = explode(',',$result_table_sel[15]);
                                           $table_prefix= explode(',',$result_table_sel[2]);
                                           
                                           for($i=0;$i<count($table_id);$i++){
                                        
                                        ?>
                                        <li class="buttons">
                                            <a <?php if($table_name[$i]=='PARCEL') { ?>  style="font-weight: bold ;" <?php } ?>  class="dbl_click line_higt_table_summ "   person_dbl="<?=$table_vacantcount[$i]?>"  title='Title_<?= $table_id[$i] ?>' asval="as_<?= chr($table_nextprefix[$i]) ?>" vcct="vc_<?= $table_vacantcount[$i] ?>" tabnam="tb_<?= $table_name[$i] . " (" . chr($table_nextprefix[$i]) . ")" ?>" tableno="<?=$table_name[$i]. $table_prefix[$i]?>"><div class="table_chair_count" ><?= $table_vacantcount[$i];  ?></div>
                                                <?= $table_name[$i] . " (" .$table_prefix[$i]. ")" ?>
                                            </a>
                                        </li>
                                    <?php
                                           }} }
                            }
                            
                            ?>
                        </ul>

                    </div>  <!--left_buton-cc --css3-validate---> 

                    <div class="right_staf_selection_cc" style="width: 21%;    margin-top: -50px;overflow: hidden">
                        <span style="color:white;display: none">ORDER TAKING STAFF</span>


                        <div class="right_main_head_ist">
						
                            <?php if($_SESSION['be_staff_sel_mode']=='Drop_Down') { ?>
                            
                          <select style="float:right;width: 100%;padding-left:2%;margin-top:0px" id="stewardsel" name="stewardsel" class="table_selection_drop">
                          
                            <?php

                            $sql_staff_sel = mysqli_query($localhost,"SELECT dr_designationid,ser_staffid,ser_firstname,ser_lastname  "
                            . " FROM tbl_staffmaster left Join tbl_designationmaster on dr_designationid=ser_designation "
                            . " where ser_employeestatus ='Active' and dr_takeorder='Y' order by ser_firstname asc");
                           
                            $num_staff = mysqli_num_rows($sql_staff_sel);
                           
                            if ($num_staff) { 
                                while ($result_staff_sel = mysqli_fetch_array($sql_staff_sel)) {
                                            
                                           $staff_name = $result_staff_sel['ser_firstname']."  ".$result_staff_sel['ser_lastname'];
                                           $staff_id = $result_staff_sel['ser_staffid'];
                                           $staff_designation = $result_staff_sel['dr_designationid'];
                                          
                if($_SESSION['main_language']!='english'){
                
                $sql_arabstaff=$database->mysqlQuery("SELECT s_staff_first_name,s_staff_last_name FROM tbl_language_staff left join tbl_languages on ls_id=s_lang_id WHERE s_staff_id='".$result_staff_sel['ser_staffid']."' and ls_language='".$_SESSION['main_language']."'");
                
                $num_arabstaff = $database->mysqlNumRows($sql_arabstaff);
                if($num_arabstaff){
                while ($result_arabstaff = $database->mysqlFetchArray($sql_arabstaff)){
                    
                  $staff_name=$result_arabstaff['s_staff_first_name']."  ".$result_arabstaff['s_staff_last_name'];
              
                }}
                
                }
        
		?>
                
		 <option  value="<?=$staff_id?>" <?php if($_REQUEST['stafid']==$staff_id){ ?> selected="selected" <?php } ?> ><?=$staff_name?></option>
		
               <?php } } ?>
                 
                </select>
                            
                <?php }else{
                                echo $_SESSION['be_staff_sel_mode']." Mode";
                                
                            } ?>
                            
                </div>
                        
      <div class="top_head" style="background-color: rgba(255, 255, 255, 0.1);margin-bottom: 3px; margin-top: 3px;border-radius: 5px;">
      <div class="right_top_action_btn" style="width:46px;    float: left;background-color: #204769a3;margin-right: 2%;">
                                        

                   <?php 
                 
                   //$sql_menulist= "SELECT ly_default FROM  tbl_loyalty_reg  WHERE ly_default='Y' and ly_module='DI' limit 1 ";
                                                $sql_menulist='';
						$sql_menus  =  $database->mysqlQuery($sql_menulist); 
						$num_menus  = $database->mysqlNumRows($sql_menus);
						if(!$num_menus){
                                                    
                                                ?>    
                                        
                           <div class="counter_list_action_btn di_loy_icon" style="line-height: 39px;display: none">
                             <a href="#"  style=""> <img style="" src="img/user-loyalty-icon.png"> </a>
                           </div>
                                        
                            <?php } else {  ?>
                            
                            
                            <div id="customer_set_data4" class="" style="line-height: 34px;">
                                <a  href="#" onclick="return clear_loy_pop();" style=""> <img style="" src="img/close-icon.png"> </a>
                            </div>
                            
                             <?php  } ?>
                            
                            <div id="customer_set_data5" class="" style="line-height: 34px;display: none">
                            <a  href="#" onclick="return show_loy_pop();" style=""> <img style="" src="img/user-loyalty-icon.png"> </a>
                            </div>  
                                        
                                        
                            </div>
                                
                                        
                  <span class="customer_dtl_sec" style="margin-left:5px">
                      <strong>CUSTOMER NAME</strong>
                      <span>NUMBER</span>
                    
                  </span>
                           
                  </div>
                        
                        
                        <div class="calculator_table_sum">
                        <div id="calculator" style="padding:1% !important;">

                                <div class="keys" style="padding-top: 5px;">
                                    
                                    <span>1</span>
                                    <span>2</span>
                                    <span>3</span>
                                    <span>4</span>
                                    <span>5</span>
                                    <span>6</span>
                                    <span>7</span>
                                    <span>8</span>
                                    <span>9</span>
                                    <span>0</span>
                                    <span class="clear">C</span>
                                    <div class="eval"><img src="img/back_ico.png" /></div>
                                </div>
                                
                                
                                <div style="display:none">
                                    <input class="dine-input" type="text" id="front_num" placeholder="Number"> <br>
                                    <input class="dine-input" type="text" id="front_name" placeholder="Number"> <br>
                                    <input class="dine-input" type="text" id="front_remarks" placeholder="Remarks"> 
                                </div>
                                    
                                
                                
                                <div class="top" style="width:100%;position:relative;margin-bottom: -4px;">
                                    <!--<div class="numperson_txt">Number Of Person's</div>-->
                                    <div class="screen" style="display:none"> </div>
                                    <a href="#"><div style="display:none" class="edit_pax_sec_rhgt first_edit_pax"> Edit Pax </div></a>
                                    
                                    <input maxlength="2"  autocomplete="off" style="width:100% !important" onchange="return validate_count_enter();" onkeyup="return validate_count_enter();" onkeypress='validate(event)' type="text" name="personscount" id="personscount" placeholder="<?= $_SESSION['table_selection_placeholder_no_of_persons'] ?>" class="screen" <?php if ($_SESSION['s_persct'] == "N") { ?> value="1" readonly <?php }else { ?>  onclick="this.removeAttribute('readonly');" readonly  <?php } ?> />
                                </div>
                                
                                  <div class="table_error_contain" style="margin-bottom:0px;height:10px;">
                                    <div class="loaderrorsel" style="display:block;width:100%;text-align: center;padding-left: 0px;height: 10px;line-height:20px"></div>
                                </div> 
                                 
                                <div class="full_wdth" style="margin-top:5px;">
                                     <div style="width:100%;height: 20px;" class="no_selected_table_cc selectedtables no_of_selected_table">SELECTED TABLE [0]</div>
                                 </div>
                               
                                <div style="margin-right:0;width:100%;display:none " class="take_order_button primary-clr" id="takorder"><?= $_SESSION['table_selection_takeorder'] ?></div>
                                <input type="hidden" name="table" id="msg1" value="<?= $_SESSION['table_selection_error_selectthetable'] ?>">
                                <input type="hidden" name="table" id="msg2" value="<?= $_SESSION['table_selection_error_selectsteward'] ?>">
                                <input type="hidden" name="table" id="msg3" value="<?= $_SESSION['table_selection_error_personscount'] ?>">
                                <input type="hidden" name="table" id="msg4" value="<?= $_SESSION['table_selection_error_sorry'] ?>">
                                <input type="hidden" name="table" id="msg5" value="<?= $_SESSION['table_selection_error_personscount'] ?>">
                                 <input type="hidden" name="staff_selection_mode" id="staff_selection_mode" value="<?=$_SESSION['be_staff_sel_mode']?>">
                                 <input type="hidden" name="selected_table_for_bill_print" id="selected_table_for_bill_print" value='' >
                                 
                                 
				<div class="reprint_order_cc">
                                 <?php
                                 if($split_enable=="Y"){
                                 ?>
                                 <div class="order-split-btn" id="order_split_btn" style="display: none">
                                 	<div class="print-btn-tbl-ico"><img src="img/order-plit_icon.png"></div>
                                	    <?=$_SESSION['table_order_split']?>
                                 </div>
                                 <?php } ?>
                                    
                                    
                                    
                                     <a href="#"><div style="display: none"  class="print-button-table-sel print-table-btn">
                                        <div class="print-btn-tbl-ico"><img src="img/print_re.png"></div>
                                      <?=$_SESSION['tabe_print_new']?>
                                     </div> </a>
                                    
                                 <?php if($_SESSION['kot_cancel_permission_front']=='Y'){  ?>
                               
                                    
                                    <div class="order-split-btn" id="kot_cancel_front" style="display: none">
                                        <div class="print-btn-tbl-ico"><img src="img/close_ico.png"></div>
                                	   KOT CANCEL
                                    </div>
                                    
                               <?php } ?>
                                    
                               </div>
								
                                 
                                 <div style="display:none">
                                <div style="margin-right: 5%;" class="take_order_button new11 reserve-btn-table" id="reservetable"><?= $_SESSION['table_selection_reservebutton'] ?></div>
                                <div class="time_pick" >
                                   
                                    <div class="time_picker" style="left: -3%;"><input placeholder="<?= $_SESSION['table_selection_placeholder_entertime'] ?>" id="timepicker1" type="text" name="timepicker1"/></div>
                                </div> 
                                </div>
                            </div>
                        </div>
                    </div><!--right_staf_selection_cc-->
                </div> <!--center_cc_btn-->          
            </div> <!--col-md-12-->
        </div><!--container-fluid-->
        <div id="dock-wrapper">
            <div class="dock">
                <div class="dock-front">
                    <div class="table_vacant_cc"  id="load_order_count">
                <?php
                
                $served_count=0; $billed_count=0;
                $added_count=0; $open_count=0; 
                $sql_table_sel14 = mysqli_query($localhost,"SELECT count(ts_status) as ct_sts ,ts_status  from tbl_tabledetails group by ts_status  ");
                            $num_table14 = $database->mysqlNumRows($sql_table_sel14);
                            if ($num_table14) {
                                while ($result_table_sel14 = $database->mysqlFetchArray($sql_table_sel14)) {
                                    
                                    
                                    if($result_table_sel14['ts_status']=='Served'){
                                     $served_count=$result_table_sel14['ct_sts'];
                                    }
                                    if($result_table_sel14['ts_status']=='Added'){
                                     $added_count=$result_table_sel14['ct_sts'];
                                    }
                                    
                                    if($result_table_sel14['ts_status']=='Opened'){
                                     $open_count=$result_table_sel14['ct_sts'];
                                    } 
                                    if($result_table_sel14['ts_status']=='Billed'){
                                     $billed_count=$result_table_sel14['ct_sts'];
                                    } 
                                    
                                    
                  } }  
                    
                ?>
                        
                        
                        <div style="width: 18%;" class="vacant"><div class="vacant_color" style="text-align: center"><?=$added_count?></div> <?= $_SESSION['table_selection_ordered'] ?>  </div><!--vacant-->
                        <div style="width: 22%;" class="vacant"><div class="occu_color" style="text-align: center"><?=$open_count?></div> Pending  </div><!--vacant-->.
                        <div class="vacant"><div class="complt_color" style="text-align: center"><?=$served_count?></div> <?= $_SESSION['table_selection_completed'] ?>  </div>
                        <div style="width: 15%;" class="vacant"><div style="background:#03a4e2;text-align: center" class="complt_color"><?=$billed_count?></div><?=$_SESSION['table_selection_billed']?></div>
                         
                        <div style="width: 15%;" class="vacant"><div style="background:lightcyan;text-align: center;color:black" class="complt_color">0</div>VACCANT</div>
                        <!--<div style="width: 18%;" class="vacant"><div style="background:rgb(255, 161, 24)" class="complt_color"></div><?= $_SESSION['table_selection_reserved'] ?>  </div>-->
                       
                    </div><!--table_vacant_cc-->
	
                    
                     <?php if($_SESSION['ser_change_table_permission']=='Y') { ?> 
                    
                    <a onClick="pop('popDiv')" href="#"><div style="text-transform: uppercase;font-size: 60% " class="change_table_btn"><?= $_SESSION['table_selection_changetablebutton'] ?></div></a>
                
                    <?php } ?>
                    
                    
                    <?php if (in_array("Clear Assigned", $_SESSION['menumodarray'])) { ?>
                    
                    <a href="#" class="clearallassigned"><div style="text-transform: uppercase;font-size: 60% " class="change_table_btn"><?= $_SESSION['table_selection_clearassignedbutton'] ?></div></a>

                    <?php } ?>
                    
                    <?php if ($_SESSION['s_printst'] == "Y" && $_SESSION['s_kotrefresh'] == 'Y') { ?>
                    
                          <a href="#" class="refreshkot"><div class="change_table_btn">Refresh KOT</div></a>

                    <?php } ?>

                </div>
                
            </div>
            
         
            
        </div>
	<input type="hidden" name="hidcaclresermsg" id="hidcaclresermsg" value="<?=$_SESSION['table_selection_error_cancelreserved']?>" >
                
        <input type="hidden" id="split_authorize" value="<?=$split_authorize?>" >        
        <input type="hidden" name="hidcancelnumber" id="hidcancelnumber" >
        <div class="index_popup_1 confirmationpop" style="display:none">
            <div class="index_popup_contant content_pop">Are you Sure you Want Cancel</div>
            <div class="index_popup_contant">
                <div class="btn_index_popup"><a href="#" class="closeok"><?=$_SESSION['table_selection_error_yes_button']?></a></div>
                <div class="btn_index_popup"><a href="#" class="closecancel"><?=$_SESSION['table_selection_error_no_button']?></a></div>
            </div>
        </div>
        
         <div class="order-split-popup-section" style="display: none">
         	<div class="order_split_select_popup">
         		<div class="order_split_select_popup_left_cc">
                            <div class="order_split_select_popup_left_head">SPLIT ORDER <span style="border: solid 1px #6d0a21;border-radius: 3px ;padding: 5px" id="qty_order_split_new" > </span>
         				<a href="#"><div class="split_popup_close"><img src="img/uploadify-cancel.png"></div></a>
         			</div>
         			<div class="order_split_select_contant">
         				<div class="order_split_select_checkbox">
         						<label class="order_split_checkbox order_split_select_text">Normal Split
                                                            <input type="checkbox" class="check_class split_check_class" checked="checked" id="manualcheck" value="manual">
								  <span class="checkmark "></span>
								</label>
        						<label style="margin-left: 20px;" class="order_split_checkbox order_split_select_text">Manual Split
                                                            <input type="checkbox" class="check_class split_check_class"  value="holdsplit" id="holdsplit"  >
								  <span class="checkmark "  ></span>
								</label>
         				</div>
         			</div>
         			
         			<div class="split_popup_sel_contant">
         					<div class="split_popup_sel_texbox_cc">
                                                    <input id="text_bill_split" type="text" maxlength="2" autofocus class="split_popup_sel_texbox_input" onkeypress="return enter_proceed(event);">
         						<div class="split_popup_sel_texbox_input_back"><img src="img/approve_icon.png"></div>
         					</div>
                                    <a href="#" id="proceed_split" ><div class="split_popup_sel_texbox_sub_btn">Proceed</div></a>
         			</div>
         			
         			
                                <span style="color:red;padding: 5px;text-align: center;float: left;width: 100%;font-weight: bold" id="error_split"></span>
         		</div>
         		<div class="split_popup_right_numm_cc">
         			<div class="split_popup_right_num_pad">1</div>
         			<div class="split_popup_right_num_pad">2</div>
         			<div class="split_popup_right_num_pad">3</div>
         			<div class="split_popup_right_num_pad">4</div>
         			<div class="split_popup_right_num_pad">5</div>
         			<div class="split_popup_right_num_pad">6</div>
         			<div class="split_popup_right_num_pad">7</div>
         			<div class="split_popup_right_num_pad">8</div>
         			<div class="split_popup_right_num_pad">9</div>
         			<div class="split_popup_right_num_pad">0</div>
         			<div style="width: 157px;" class="split_popup_right_num_pad"> CLEAR </div>
         		</div>
                     
         	</div>
             
         </div> <!--order-split-popup-section-->


        <div class="index_popup_1 confirmationpop_clear" style="display:none">
            <div class="index_popup_contant content_pop"><?= $_SESSION['table_selection_error_clearassigned'] ?></div>
            <div class="index_popup_contant">
                <div class="btn_index_popup"><a href="#" class="yesclear"><?= $_SESSION['table_selection_error_yes_button'] ?></a></div>
                <div class="btn_index_popup"><a href="#" class="noclear"><?= $_SESSION['table_selection_error_no_button'] ?></a></div>
            </div>
        </div>  
        <!--popup-->

        <div id="popDiv" class="ontop">
            <div id="popup">
                <div class="table_change_pop_head">
                    <span><?= $_SESSION['table_selection_popup_tablechange'] ?></span>

                    <a class="close_pop_tbl_ch" href="#" onClick="hide('popDiv')">X</a>
                </div><!---table_change_pop_head-->
                <div class="pop_full_width_change_table">
                    
                    
                    
                    <div class="popo_table_change_drop_cc">
                        <div class="change_table_drop_down_text"><?= $_SESSION['table_selection_popup_fromtable'] ?></div>
                        <div class="chnage_table_drop" id="loadfromtable">

                            <select class="chnage_table_select" name="fromtable" id="fromtable">
                                <option><?= $_SESSION['table_selection_popup_selecttable'] ?></option>
                             <?php
                             
                               $stfname = "";
                             
                               $sql_table_sel21 = mysqli_query($localhost,"select * from tbl_tablemaster where "
                               . "tr_floorid='" . $_SESSION['floorid'] . "' and  tr_status='Active'  order by tr_displayorder");
                               
                               $num_table21 = mysqli_num_rows($sql_table_sel21);
                            if ($num_table21) {
                                
                                while ($result_table_sel21 = mysqli_fetch_array($sql_table_sel21)) {
                                            
                                           $table_name21 = $result_table_sel21['tr_tableno'];
                                          
                                           $table_id21 = $result_table_sel21['tr_tableid'];
                                           $table_vacantcount = $result_table_sel21['tr_vaccantcount'];
                                           $table_nextprefix = $result_table_sel21['tr_nextprefix_ascii'];
                                             
                                             
                if($_SESSION['main_language']!='english'){
                
                $sql_arabtable=mysqli_query($localhost,"SELECT t_table_name FROM tbl_language_table_master left join tbl_languages"
                . " on ls_id=t_lang_id WHERE t_table_id='".$table_id21."' and ls_language='".$_SESSION['main_language']."'");
                
               
                $num_arabtable = mysqli_num_rows($sql_arabtable);
                 if($num_arabtable){
                    while ($result_arabtable = mysqli_fetch_array($sql_arabtable)){
                          $table_name21=$result_arabtable['t_table_name'];
               
               
                }}}
                            $sql_table_sel1 = mysqli_query($localhost,"select * from tbl_tabledetails where ts_tableid='" . $table_id21 . "' and ts_status<>'Billed'");
                            
                             $num_table1 = mysqli_num_rows($sql_table_sel1);
                             if ($num_table1) {
                             while ($result_table_sel1 = mysqli_fetch_array($sql_table_sel1)) {
                           
                             ?>
                             <option tabid="<?= $table_id21 ?>" prefx="<?= $result_table_sel1['ts_tableidprefix'] ?>"><?=$table_name21 . " (" . $result_table_sel1['ts_tableidprefix'] . ")" ?></option>
                             <?php
                             // }
                             }
                             }
                             
                             }
                             }   
                                ?>
                             
                            </select>
                        </div>
                    </div>
                    
                    
                    <div class="popo_table_change_drop_cc">
                        <div class="change_table_drop_down_text">To Floor</div>
                        <div class="chnage_table_drop" id="loadfromtable">

                       <select title="Floor Change" <?php if($_SESSION['s_floor_table_change']=='N'){ ?> disabled <?php } ?>   class="chnage_table_select" name="fromtable" id="floor_change_val">
                               
                        <?php
                        $sql_table_sel21 = mysqli_query($localhost,"select fr_floorid,fr_floorname from tbl_floormaster where fr_status='Active' ");
                           
                               $num_table21 = mysqli_num_rows($sql_table_sel21);
                        if ($num_table21) {
                                while ($result_table_sel21 = mysqli_fetch_array($sql_table_sel21)) {
                            ?>
                        <option value="<?=$result_table_sel21['fr_floorid']?>"> <?=$result_table_sel21['fr_floorname']?> </option>
                        <?php } } ?>
                             
                        </select>
                        </div>
                        </div>

  
                     <div id="load_change_table_data">  
                     </div>
                    
                    <div class="pop_change_sub_btn_cc">
                        <div class="pop_eror_div_contain"><span id="errorsetcahnge" class="pop_date_change_error" style="display:none; color:#F00"></span></div>
                        <div class="pop_change_sub_btn"><a href="#" class="changetableeach"><?= $_SESSION['table_selection_popup_submitbutton'] ?></a></div>
                        <div class="pop_change_sub_btn"><a href="#" class="changetableeach_cancel"><?= $_SESSION['table_selection_popup_cancelbutton'] ?></a></div>
                  
                    </div>

                </div>

            </div>
        </div>          

<!----**********Staff select popup*******-->

<div class="take_order_staff_sel_popup takeorder_div_password bill_entry settle_auth">
    <input type="hidden" name="focusedtext" id="focusedtext" >
    <input type="hidden" name="focusedtext_split" id="focusedtext_split" >
    <input type="hidden" name="focusedtext_split_calc" id="focusedtext_split_calc" >
  
    <div class="take_order_staff_sel_popup_head"><span id="pop_head"></span><div class="staff_sel_popup_close_n"><img src="img/black_cross.png"></div></div>
    <div style="width: 100%;float: left;height: 10px;line-height: 10px;text-align: center"><span id="pin_error" style="color:red;"></span></div>
    <div class="take_order_staff_sel_popup_textbox_cc">
        
        <input  type="password" placeholder="PIN" value="" class="take_order_staff_sel_popup_textbox" id="pin" autofocus maxlength="4" onkeypress="return numonly(event)" autocomplete="off" style="width:80%"/>
       	<span style="height: 47px;" class="login_back_btn calculator_settle_back">&nbsp;</span>
    </div>
    <div class="take_order_staff_sel_popup_number_pad_cc">
    	<div style="padding:0" class="keys settle_key">
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
            <span style="width: 46.2%;max-width: inherit;" class="calculator_settle">Clear</span>
        </div>
    </div>
    <a href="#" id="takeorder_btn"><div class="take_order_staff_sel_popup_textbox_btn bill_print_auth" id="take_order_staff_sel_popup_textbox_btn">Submit</div></a>
    <a href="#" id="bill_prnt_btn" style="display:none"><div class="take_order_staff_sel_popup_textbox_btn bill_print_auth" id="take_order_staff_sel_popup_textbox_btn">Submit</div></a>
     <a href="#" id="settle_prnt_btn" style="display:none"><div class="take_order_staff_sel_popup_textbox_btn settle_print_auth" id="take_order_staff_sel_popup_textbox_btn">Submit</div></a>
</div><!--take_order_staff_sel_popup-->

<!----***********Staff select popup end************-->
      

<!------------*******Print bill popup*******------------------->
  <?= $orderno?>

<div class="print-bill-in-tableselection-popup-cc" style="display:none" id="dummy">
	
</div><!--print-bill-in-tableselectio-popup-cc-->   


<!-----------*******Print bill popup end**********-------->
       
        <input type="hidden" name="hid_ch_floor_id_selected" id="hid_ch_floor_id_selected" >
        <input type="hidden" name="hid_ch_floor_id" id="hid_ch_floor_id" >
        <input type="hidden" name="hidchangprevid" id="hidchangprevid" >
        <input type="hidden" name="hidchangprevpx" id="hidchangprevpx" >
        <input type="hidden" name="hidchangnewid" id="hidchangnewid" >
        <input type="hidden" name="hidchangnewpx" id="hidchangnewpx" >
        <div class="index_popup_1 confirmationpop_confrm" style="display:none">
            <div class="index_popup_contant content_pop"><?=$_SESSION['table_selection_error_tablechange']?></div>
            <div class="index_popup_contant">
                <div class="btn_index_popup"><a href="#" class="changeok"><?=$_SESSION['table_selection_error_yes_button']?></a></div>
                  <div class="btn_index_popup"><a href="#" class="changecancel"><?=$_SESSION['table_selection_error_no_button']?></a></div>
            </div>
        </div> 
 
<input type="hidden" name="hidproc_tablechange_changed" id="hidproc_tablechange_changed" value="<?=$_SESSION['procedures_proc_tablechange_changed']?>">
<input type="hidden" name="hidproc_tablechange_parcel" id="hidproc_tablechange_parcel" value="<?=$_SESSION['procedures_proc_tablechange_parcel']?>">
        <div  class="confrmation_overlay" style="display:none;z-index: 999"></div>
        <div  class="confrmation_overlay_settle" style="display:none;z-index: 9999999"></div>
         <script>!window.jQuery && document.write(unescape('%3Cscript src="javascript/jquery-1.7.2.min.js"%3E%3C/script%3E'))</script>
        <script src="javascript/demo.js"></script>
        <script src="js/timepicki.js"></script>


<script>
    
$("#floor_change_val").change(function(){
           
              var flr=$(this).val();
            
               var data1 = "value=load_change_table_data&flor_id_change="+flr;
                $.ajax({
                                    type: "POST",
                                    url: "load_div.php",
                                    data: data1,
                                    success: function(data) {
                                      $('#load_change_table_data').html(data);  
                                      }
                                });   
           
  });	
			
                        
  $(".buttons_tab_active_2").click(function(){
		$("#order_split_btn").show();
                 $('#kot_cancel_front').show();
  });
                        
                        
  $("#order_split_btn").click(function(){ 
                         
                if ( $( '.buttons_tab_active_2' ).hasClass( "table_select" ) ) {
                               
                    var auth=$('#split_authorize').val();
                         
                     if(auth=="Y"){   
                               
                                $(".split_permission1").show();  
                                $(".confrmation_overlay_new").show();
                                $('.regen_reason').hide();
                                $(".kotcancel_reason_popup_new_head").text('Order Split Authorization');
                                
                                $("#pin_split").focus();
                                $("#pin_split").val('');
                                  
                                  
                 var ordno=$('.print-table-btn').attr('order');
                
                  var ordno1=ordno.split('_');
                  var ordno11= ordno1[1].split(',');
                  
                  var ordno_array=new Array();
                  for(var i=0;i<ordno11.length;i++){
                     
                 if(ordno11[i]!='' && !ordno_array.includes(ordno11[i]) ){
                     ordno_array.push(ordno11[i]);
                 }
                 }
                      
               var data1 = "set_qty=order_qty&all_order_no="+ordno_array;
    
  
                          var request= $.ajax({
			  type: "POST",
			  dataType: "text",
			  url: "load_div.php", 
			  data: data1,
			  success: function(data) {
                          var data3=$.trim(data);
                        
                            var ctt=data3.split('*');
                             
                           $('#qty_order_split_new').html('QTY - ' +ctt[0]);
                          
                           }
                           });
                                  
                               // $('.pin_proceed').click();
                               
                         }else{
                             
                           
                             
                                $('#qty_order_split_new').html('QTY');
                             
				 $(".order-split-popup-section").show();
                               
                                   $("#text_bill_split").focus();
                                   $("#text_bill_split").val('');
                                   
                                   $("#text_bill_split").attr("placeholder", "No Of Bills").placeholder();
                                  
                                
                                 
                              }
                          }else{
                              
                               $('#alertdiv').show();
                               $('#alertdiv').text('Select Table To Split Order ');
                               $('#alertdiv').delay(2000).fadeOut('slow');
                          }
                              
  });
                        
                        
  $(".split_popup_close").click(function(){
     $(".order-split-popup-section").hide();
     $("#text_bill_split").val('');
 });
			
			
			

 $('#timepicker1').timepicki();

        </script>
     <!-- <script src="javascript/modernizr.custom.34807.js"></script>
      <script> if(!Modernizr.csstransforms3d) document.getElementById('information').style.display = 'block'; </script>-->
     <!-- <script src="table/js/toucheffects.js"></script>-->
      <!--<script src="js/classie.js"></script>-->

        <script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
        <!-- library for cookie management -->
        <script src="js/jquery.cookie.js"></script> 
        <!-- <script src="js/caculator_tabsel.js"></script>-->
        <script>
            
 /*******************  Function to check numeric  starts ***********  */
     function isNumeric(val)
      {
                            var vals = val.trim();
                            var numeric = true;
                            var chars = "0123456789";
                            var len = vals.length;
                            var char = "";
                            for (i = 0; i < len; i++)
                            {
                                char = vals.charAt(i);
                                if (isNaN(char))
                                {
                                    numeric = false;
                                }
                            }
                            return numeric;
      }

                        /************************  Function to check numeric  ends **************************  */

                        /*****************  Onclick calculator key starts **********************  */
                        
                        // Get all the keys from document
                        var keys = document.querySelectorAll('#calculator span');
                        var operators = ['+', '-', 'x', 'ÃƒÆ’Ã†â€™Ãƒâ€ Ã¢â‚¬â„¢ÃƒÆ’Ã¢â‚¬Â ÃƒÂ¢Ã¢â€šÂ¬Ã¢â€žÂ¢ÃƒÆ’Ã†â€™ÃƒÂ¢Ã¢â€šÂ¬Ã…Â¡ÃƒÆ’Ã¢â‚¬Å¡Ãƒâ€šÃ‚Â·'];
                        var decimalAdded = false;

                        // Add onclick event to all the keys and perform operations
                        for (var i = 0; i < keys.length; i++) {
                            keys[i].onclick = function (e) {
                                // Get the input and button values
                                var input = document.querySelector('.screen');
                                var inputVal = input.innerHTML;
                                var btnVal = this.innerHTML;

                                // Now, just append the key values (btnValue) to the input string and finally use javascript's eval function to get the result
                                // If clear key is pressed, erase everything
                              if (btnVal == 'C') { 
                                    input.innerHTML = '';
                                    $('#personscount').val(input.innerHTML);
                                    $('#personscount').focus();
                                    decimalAdded = false;
                                }
                                // if any other key is pressed, just append it
                                else {
                                  
                                    input.innerHTML += btnVal;
                                    
                                  if(input.innerHTML>99){
                                     
                                     input.innerHTML = '';
                                    $('#personscount').val(input.innerHTML);
                                    $('#personscount').focus();
                                    decimalAdded = false;
                                  }else{
                                      
                                    var pax_entry= $('#pax_entry_new').val(); 
                                     
                                    if(pax_entry=='Y'){
                                    $('#personscount').val(input.innerHTML);
                                    $('#personscount').focus();
                                    
                                    }else{
                                        $('#alertdiv').css('display','block');
                                        $('#alertdiv').text('PAX ENTRY DISABLED');
                                        $('#alertdiv').delay(2000).fadeOut('slow');
                                    }
                                }
                                
                                
                                }
                            }
                            
                            
                            

                        }
                        /**************  Onclick calculator key ends ************************  */

 function test()
   {
     //alert('hhh')
    alert(document.getElementById('timepicker1').value);
   }
   
 function validate(evt) {
   var theEvent = evt || window.event;
   var key = theEvent.keyCode || theEvent.which;
   key = String.fromCharCode( key );
   var regex = /[0-9]|\./;
   if( !regex.test(key) ) {
    theEvent.returnValue = false;
    if(theEvent.preventDefault) theEvent.preventDefault();
   }
}


 function numonly(evt)
 {
   evt = (evt) ? evt : window.event;
   var charCode = (evt.which) ? evt.which : evt.keyCode;
   if (charCode > 31 && (charCode < 48 || charCode > 57)) {
       
       return false;
     
   }
   return true;
}


function validate_count_enter(){
    var ps=$('#personscount').val();
   
   if(ps>200){
       $('#personscount').val('');
    }
}
        </script>
 <script type="text/javascript">


		$(".staff_sel_popup_close_n").click( function(){
			$('.take_order_staff_sel_popup').css('display','none');
			$('.confrmation_overlay').css('display','none');
                        $('.confrmation_overlay_settle').css('display','none');
                        $('#pin').val('');
		});
                
</script>   

        
<style>.right_staf_selection_cc {min-height: 600px;height: 89vh !important;}
.print-bill-in-tableselection-popup-cc{z-index: 9999999999;}
.kotcancel_reason_popup_new_right_cc .keys span, .top span.clear{margin: 0 3% 3.5% 0 !important;}
.confrmation_overlay_new{width: 100%;height: 100%;position: fixed;z-index: 9999999;background-color: rgba(0,0,0,0.8);top: 0;}
  .confrmation_overlay_settle{width: 100%;height: 100%;position: fixed;background-color: rgba(0,0,0,0.8);top: 0;} 
  .loader_to_bill{width: 101%;height: 100%;position: absolute;left: 0px; z-index: 9999999;background-color: rgba(0,0,0,0.9);top: 0;color: red;text-align:center;padding-top: 15px;font-weight:bold;font-size: 14px }
</style>


<div class="auth_popup_payment split_permission" style="display:none">
    <input type="hidden" name="focusedtext" id="focusedtext" />
 <div class="kotcancel_reason_popup_new_left_cc">
    <div class="kotcancel_reason_popup_new_head head_change"><img class="auth_head_ico" src="img/alert.png" /></div>
    <div class="kotcancel_reason_popup_new_textbox_contant">
    <div class="kotcancel_reason_popup_new_textbox_cc" id="rsn" style="margin-bottom:10px;">
            
       
    </div>
    	
        <div style="width: 100%;float: left;height: 20px;line-height: 10px;text-align: center">
          
            <span id="pin_error_split" style="color:red;width:100%;float:left;height: auto; line-height: 18px;display: none"></span>
           
        </div>
        <div class="kotcancel_reason_popup_new_textbox_cc" style="margin-bottom:10px;">
            <input type="password" class="kotcancel_reason_popup_new_textbox_input" placeholder="CODE" id="pin_pay" onkeypress="return numonly(event)" autofocus maxlength="4" autocomplete="off"/>
        </div>
    </div>
    <div class="kotcancel_reason_popup_new_textbox_btn_cc">
        <a href="#"><div class="kotcancel_reason_popup_new_textbox_btn pin_close_pay" id="kotcancel_reason_popup_new_cancel_btn">Cancel</div></a>
    	<a href="#"><div class="kotcancel_reason_popup_new_textbox_btn pin_proceed_pay" id="kotcancel_reason_popup_new_proceed_btn_cs">Proceed</div></a>
    </div>
  </div><!--kotcancel_reason_popup_new_left_cc-->
  <div class="kotcancel_reason_popup_new_right_cc">
      <div class="keys settle_key" style="margin-top:0">
            <span class="calculator_settle">1</span>
            <span class="calculator_settle">2</span>
            <span class="calculator_settle">3</span>
             <span class="calculator_settle_back">&nbsp;</span>
            <span class="calculator_settle">4</span>
            <span class="calculator_settle">5</span>
            <span class="calculator_settle">6</span>
             <span class="calculator_settle">Clear</span>
            <span class="calculator_settle">7</span>
            <span class="calculator_settle">8</span>
            <span class="calculator_settle">9</span>
            <span class="calculator_settle">0</span>
        </div>
  </div><!--kotcancel_reason_popup_new_right_cc-->
</div> 

<div class="kotcancel_reason_popup_new table_chaange_pop" style="display:none">
    <input type="hidden" name="focusedtext" id="focusedtext" />
   <div class="kotcancel_reason_popup_new_left_cc">
    <div class="kotcancel_reason_popup_new_head">Table Change Authorization</div>
    <div class="kotcancel_reason_popup_new_textbox_contant">
    <div class="kotcancel_reason_popup_new_textbox_cc" id="rsn" style="margin-bottom:10px;">
            
       
    </div>
    	
        <div style="width: 100%;float: left;height: 20px;line-height: 10px;text-align: center"><span id="pin_error_table" style="color:red;width:100%;float:left;height: auto; line-height: 18px;"></span></div>
        <div class="kotcancel_reason_popup_new_textbox_cc" style="margin-bottom:10px;">
            <input type="password" class="kotcancel_reason_popup_new_textbox_input" placeholder="CODE" id="pin_table" onkeypress="return numonly(event)" autofocus maxlength="4" autocomplete="off"/>
        </div>
    </div>
    <div class="kotcancel_reason_popup_new_textbox_btn_cc">
        <a href="#"><div class="kotcancel_reason_popup_new_textbox_btn table_change_close" id="kotcancel_reason_popup_new_cancel_btn">Cancel</div></a>
    	<a href="#"><div class="kotcancel_reason_popup_new_textbox_btn table_change_go" id="kotcancel_reason_popup_new_proceed_btn_cs">Proceed</div></a>
    </div>
  </div><!--kotcancel_reason_popup_new_left_cc-->
  <div class="kotcancel_reason_popup_new_right_cc">
      <div class="keys settle_key" style="margin-top:0">
            <span class="calculator_settle">1</span>
            <span class="calculator_settle">2</span>
            <span class="calculator_settle">3</span>
             <span class="calculator_settle_back">&nbsp;</span>
            <span class="calculator_settle">4</span>
            <span class="calculator_settle">5</span>
            <span class="calculator_settle">6</span>
             <span class="calculator_settle">Clear</span>
            <span class="calculator_settle">7</span>
            <span class="calculator_settle">8</span>
            <span class="calculator_settle">9</span>
            <span class="calculator_settle">0</span>
        </div>
  </div><!--kotcancel_reason_popup_new_right_cc-->
</div>


<div class="kotcancel_reason_popup_new split_permission split_permission1" style="display:none">
    <input type="hidden" name="focusedtext" id="focusedtext" />
 <div class="kotcancel_reason_popup_new_left_cc">
    <div class="kotcancel_reason_popup_new_head"><img class="auth_head_ico" src="img/alert.png" />ORDER SPLIT AUTHORIZATION</div>
    <div class="kotcancel_reason_popup_new_textbox_contant">
    <div class="kotcancel_reason_popup_new_textbox_cc regen_reason" id="rsn" style="margin-bottom:10px;display: none">
          
            
            <select class="kotcancel_reason_popup_new_textbox_input" id="reasontxt" name="reasontxt" style="width: 99%;float: left;">
<!--                                                 <option value="0">--Select--</option>-->
                <?php 
                                                 
                                                 
                $sql_rsns = mysqli_query($localhost,"select rr_reason from tbl_regenerate_reasons where rr_active = 'Y' ");
                $num_paytypes1 = mysqli_num_rows($sql_rsns);
                if ($num_paytypes1) {
                    while ($result_rsns =mysqli_fetch_array($sql_rsns)) {
                        
                ?>
                                                 
                <option value="<?= $result_rsns['rr_reason']?>"> <?= $result_rsns['rr_reason']?> </option>
                                                   
                <?php  }}?>
                       
                </select>
      
       
    </div>
    	
        <div style="width: 100%;float: left;height: 20px;line-height: 10px;text-align: center">
            <span id="pin_error_split" style="color:red;width:100%;float:left;height: auto; line-height: 18px;display: none"></span>
             <span id="pin_error_split1" style="color:red;width:100%;float:left;height: auto; line-height: 18px;display: none"></span>
            <span id="pin_error_split2" style="color:red;width:100%;float:left;height: auto; line-height: 18px;display: none"></span>
        </div>
        <div class="kotcancel_reason_popup_new_textbox_cc" style="margin-bottom:10px;">
            <input type="password" class="kotcancel_reason_popup_new_textbox_input" placeholder="CODE" id="pin_split" onkeypress="return numonly(event)" autofocus maxlength="4" autocomplete="off"/>
        </div>
    </div>
    <div class="kotcancel_reason_popup_new_textbox_btn_cc">
        <a href="#"><div class="kotcancel_reason_popup_new_textbox_btn pin_close" id="kotcancel_reason_popup_new_cancel_btn">Cancel</div></a>
    	<a href="#"><div class="kotcancel_reason_popup_new_textbox_btn pin_proceed" id="kotcancel_reason_popup_new_proceed_btn_cs">Proceed</div></a>
    </div>
  </div><!--kotcancel_reason_popup_new_left_cc-->
  <div class="kotcancel_reason_popup_new_right_cc">
      <div class="keys settle_key" style="margin-top:0">
            <span class="calculator_settle">1</span>
            <span class="calculator_settle">2</span>
            <span class="calculator_settle">3</span>
             <span class="calculator_settle_back">&nbsp;</span>
            <span class="calculator_settle">4</span>
            <span class="calculator_settle">5</span>
            <span class="calculator_settle">6</span>
             <span class="calculator_settle">Clear</span>
            <span class="calculator_settle">7</span>
            <span class="calculator_settle">8</span>
            <span class="calculator_settle">9</span>
            <span class="calculator_settle">0</span>
        </div>
  </div><!--kotcancel_reason_popup_new_right_cc-->
</div> 

<div class="confrmation_overlay_new" style="display:none"></div>

<div style="display:none" class="confrmation_overlay_proce"></div>

<div class="counter_settle_popup_section_cont" style="display: none;">
    <input type="hidden" name="hidbilgenper" id="hidbilgenper" value="<?= $_SESSION['s_bilregen_with_permission'] ?>">
    <input type="hidden" name="hidbilreprint" id="hidbilreprint" value="<?= $_SESSION['s_reprint_with_permission'] ?>">
    <input type="hidden" name="hidauthorise_with_code" id="hidauthorise_with_code" value="<?=$_SESSION['be_authorise_with_code']?>" />
    <input type="hidden" id="currencyonoff" value="<?=$_SESSION['be_show_currency']?>">
    <input type="hidden" id="base_currency" value="<?=$_SESSION['base_currency']?>"> 
    <input type="hidden" name="settlebill" id="settlebill" value="<?=$_SESSION['be_settle_billprint']?>" />
<div id="copop" class="counter_settle_popup" style="display: block;">
    <div class="confrmation_overlay_reprint"></div>
    <div class="view_items_list_in_settle_sec">
        <div id="billdetails">
   <table class="billgenration_new_table" width="100%" border="0" cellspacing="5">
      <thead style="padding-right:0">
         <tr>
            
            <td style="text-align:center !important" class="table_dtail_multisel" colspan="2"><span class="settle_head_spa" id='table_list_view'></span></td>
            <td class="table_dtail_multisel" id='kot_list_view' colspan="2"></td>
         </tr>
         <tr>
            <th width="10%">SlNo</th>
            <th width="40%">Menus</th>
            <th width="10%">Qty</th>
            <th width="15%">Rate</th>
            <th width="22%">Amount</th>
         </tr>
      </thead>
      <tbody class='table_body'>
         
         
      </tbody>
   </table>
                <div class="take_staff_view_cont_bottom_contain" style="bottom: 54px;height: auto;">
                        
                <div class="tottal_rate_contain" id="grandtotal_sec_sub1" style="color: rgb(0, 0, 0); font-size: 14px; text-align: left; width: 40%; float: left; margin-left: 1%; display: block;"><strong>Sub Total  : <span id="grandtotal_sec_sub">96.600</span></strong></div>
                        
                <div class="tottal_rate_contain" id="grandtotal_sec1" style="color: rgb(0, 0, 0); font-size: 15px; text-align: right; width: 40%; float:right"><strong>Final Total  : <span id="grandtotal_sec">103.604</span></strong> </div>
                            
            </div>
</div>
    </div>
    
   <div class="top_head">Bill Details - 
   <select class="select_billnum_pop" id="settleingbilno">
           
   </select>
   <div style="float:right;margin: 7px 5px 0 0" class="view_items_btn view_item_clc">View Items</div>
   </div>
     <div class="settle_main_pop_contant" style="position:relative">
      <div class="counter_payment_contain" style="position:relative;min-height: 483px;">
         <div class="tottal_rate_contain" style="color:#000;font-size: 16px;text-align:right;width:100%;background:#cdcecf;margin:0;">
            <div class="poup_sub_total" style="width:100%;">
               <span style="float: right;padding-left:5px;white-space: nowrap;width:100%;">
                  <div style="width:100%;    padding-top: 0;text-transform: uppercase" class="payment_pend_right_cash_error"></div>
               </span>
            </div>
            <!-- <div class="calculator_icon_pop"><img src="img/calculator-ico.png"></div> -->
         </div>
        
         <div class="pop_payment_mode_sel_btn_cc">
            <?php 
            $credit_view='';
            $comp_view='';
             $sql_paytypes1 = mysqli_query($localhost,"SELECT ser_credit_view,ser_comp_view FROM tbl_logindetails tl left "
              . "join tbl_staffmaster ts on ts.ser_staffid=tl.ls_staffid  WHERE tl.ls_username='".$_SESSION['expodine_id']."' ");
                $num_paytypes1 = mysqli_num_rows($sql_paytypes1);
                if ($num_paytypes1) {
                    while ($result_paytypes1 =mysqli_fetch_array($sql_paytypes1)) {
                        
                        $credit_view=$result_paytypes1['ser_credit_view'];
                        $comp_view=$result_paytypes1['ser_comp_view'];
                        
                    }
                    }
            
            
             $sql_paytypes = mysqli_query($localhost,"SELECT pym_id,`pym_code`,`pym_name` FROM `tbl_paymentmode` WHERE `pym_active`='Y' ");
              $num_paytypes = mysqli_num_rows($sql_paytypes);
                if ($num_paytypes) {$i=0;
                    while ($result_paytypes =mysqli_fetch_array($sql_paytypes)) {
                        $i++;
                          
            ?>
                <div id="<?=$result_paytypes['pym_code']?>" idval="<?=$result_paytypes['pym_id']?>" class="cash_btn pop_payment_mode_sel_btn <?php if($i==1) { ?> mode_sel_btn_act <?php } ?> ">
               
                  
                     <?php if($result_paytypes['pym_name']=='Credit / Debit'){ ?>
                             
                       Card - Upi
                           
                       <?php }else{ ?>   
                            
                          <?= $result_paytypes['pym_name'] ?>
                            
                        <?php } ?>   
                    
                </div>
        <?php }} ?>
                
                
        <?php if($_SESSION['be_disc_after']=='Y' &&  $_SESSION['ser_discount_after']=='Y'){ ?>
          <div id="discount_after_bill_btn"  class="pop_payment_mode_sel_btn77" >DISCOUNT</div>
        <?php } ?>
              
              
        <input type="hidden" value="<?=$credit_view?>" id="credit_view_per" > 
        <input type="hidden" value="<?=$comp_view?>" id="comp_view_per" > 
            
          
        </div>
          
          
          
          
          
          
         <div class="sec_pop_div_right">
            <div class="credit_cc_normal" style="display: none;">
               <div class="discount_text_cc crd_head" style="display: none;">Credit / Debit Card</div>
               
               <div class="selecting_payment_cc" style="display: none;">
                  <div class="selecting_payment_one">
                     <div class="lable_counter_paymnet_cc counter_right_lable">Transaction Bank</div>
                     <select id="bankdetails" class=" discount_text_box tax_textbox counter_text_box size_compat">
                <?php
                    $sql_bank = mysqli_query($localhost,"SELECT `bm_id`, `bm_name` FROM `tbl_bankmaster` WHERE `bm_active`='Y' ");
                    $num_bank = mysqli_num_rows($sql_bank);
                    if ($num_bank) {$i=0;
                        while ($result_bank =mysqli_fetch_array($sql_bank)) {
                        $i++;
                ?>      
                         <option value="<?=$result_bank['bm_id']?>" ><?=$result_bank['bm_name']?></option>
                <?php } } ?>   
                     </select>
                  </div>
                   
               </div>
               
               
               <!--selecting_payment_cc-->
               <div class="card_detail_popup_contant " style="padding: 1px;" id="cardadderid">
                  <div class="card_detail_popup_list_head">
                   
                      <div class="card_detail_popup_type" style="width:25%;margin-right:1%;display: none">
                        <div class="card_detail_popup_type_text">Customer Card</div>
                     </div>
                     <div class="card_detail_popup_type" style="width:30%;display: none">
                        <div class="card_detail_popup_type_text">Card Last 4 Digits</div>
                     </div>
                     <div class="card_detail_popup_type" style="width:22%;margin-left:1%">
                        <div class="card_detail_popup_type_text">Amount</div>
                     </div>
                      
                       <div class="card_detail_popup_type" style="width:32%;margin-left:24%">
                        <div class="card_detail_popup_type_text">To Bank</div>
                     </div>
                  </div>
                   
                  <div id="newref">
                     <div class="card_detail_popup_list" style="margin-bottom:3px" id="card_detail_popup_list">
                         
                        <div class="card_detail_popup_type" style="width:25%;margin-right:1%;display: none">
                           <select class="card_type_dropdwn cardselect" id="multicardtype" onclick="return selectdefault();">
                              <option value="">Card</option>
                              <?php
                                $sql_card = mysqli_query($localhost,"SELECT `crd_id`, `crd_name` FROM `tbl_cardmaster` WHERE `crd_active`='Y' ");
                                $num_card = mysqli_num_rows($sql_card);
                                if ($num_card) {$i=0;
                                    while ($result_card =mysqli_fetch_array($sql_card)) {
                                    $i++;
                            ?>
                              <option value="<?=$result_card['crd_id']?>"><?=$result_card['crd_name']?></option>
                            <?php
                                }}
                            ?>
                           </select>
                        </div>
                        <div class="card_detail_popup_type" style="width: 30%;display: none">
                           <input class="card_popup_digits cardno" type="text" id="card_1" value="" name="card_1" chk="0" onkeypress="return numonly()" onclick="return pincard()" onchange="return pincard()" maxlength="4" autocomplete="off">
                        </div>
                        <div class="card_detail_popup_type" style="width:45%;margin-left:1%">
                           <input type="text" class="card_type_dropdwn amountall" id="multi_cardamount" value="" name="multi_cardamount" onfocus=" return AddClass(this.id)" onkeypress="return charlimit(event,this.value)" onkeyup="return enterbalance(event,this.id)" maxlength="10" autocomplete="off" autofocus="">
                        </div>
                         
                          <div class="card_detail_popup_type" style="width:38%;margin-right:1%;">
                           <select class="card_type_dropdwn bankselect_new" id="multibanktype" onclick="">
                            
                                    
                                                      
                                <?php
                                $sql_card = mysqli_query($localhost,"select bm_id,bm_name from tbl_bankmaster where bm_active='Y' ");
                                $num_card = mysqli_num_rows($sql_card);
                                if ($num_card) {$i=0;
                                    while ($result_card =mysqli_fetch_array($sql_card)) {
                                    $i++;
                            ?>
                              <option value="<?=$result_card['bm_id']?>"><?=$result_card['bm_name']?></option>
                            <?php
                                }}
                            ?>             
                                                      
                           </select>
                        </div>
                         
                         
                         
                        <!--                                        <div style="margin-top:0px;width: 12%;height: 34px;margin-top: -1px;float: right"  class="menut_add_bq_btn " onclick="return del();">-</div>-->
                     </div>
                  </div>
                  <input type="hidden" value="" id="countload">
                  <div style="display: none;width: 12%;height: 30px;margin-top: -34px;float: right;background-color: rgb(230, 179, 179)" class="menut_add_bq_btn plusbtn" onclick="return AddCard();">+</div>
               </div>
               <div class="cardadder">
                   
               </div>
               <div class="trrefresh">
                   <div class="selecting_payment_cc" style="display:none" >
                     <div class="selecting_payment_one">
                        <div style="font-size: 13px "  class="lable_counter_paymnet_cc counter_right_lable">Transaction Amount</div>
                        <input style="width: 80px;margin-left: -62px;"  placeholder="Enter Transaction Amount" class="tax_textbox transa_txt counter_text_box" name="transcationid" id="transcationid" value="0"  autocomplete="off" readonly>
                     </div>
                  </div>
                  <!--selecting_payment_cc-->
                  <div class="selecting_payment_cc">
                     <div class="selecting_payment_one">
                        <div style="margin-top: 12px;font-size: 13px;margin-left: 0px;" class="lable_counter_paymnet_cc counter_right_lable">Balance To Pay</div>
                        <!--<input placeholder="Balance" class="tax_textbox transa_txt counter_text_box">-->
                        <input style="margin-left: -7px;margin-top: 12px;width: 140px;" placeholder="Balance" class="tax_textbox transa_txt counter_text_box" name="transbal" id="transbal" readonly="" value="">
                     </div>
                  </div>
                  <!--selecting_payment_cc-->
               </div>
               <!--credit_cc_normal-->
            </div>
            <div class="coupon_cc" style="display: none;">
               <div class="discount_text_cc crd_head">Coupons</div>
               <div class="selecting_payment_cc">
                  <div class="selecting_payment_one">
                     <div class="lable_counter_paymnet_cc counter_right_lable">Coupon Code</div>
                     <input placeholder="Enter Coupon Code" class="tax_textbox transa_txt counter_text_box" onkeyup="return coupon_code_redeem(event);" name="coupname" id="coupname">
                  </div>
               </div>
               <!--selecting_payment_cc-->
               <div class="selecting_payment_cc">
                  <div class="selecting_payment_one">
                     <div class="lable_counter_paymnet_cc counter_right_lable">Coupon Amount</div>
                     <!--<input placeholder="Coupon Amount" class="tax_textbox transa_txt counter_text_box">-->
                     <input placeholder="Enter Coupon Amount" class="tax_textbox transa_txt counter_text_box" name="coupamount" id="coupamount" readonly onfocus=" return AddClass(this.id)" onkeypress="return charlimit(event,this.value)"  onkeyUp="return enterbalance(event,this.id)" autocomplete="off">
                  </div>
               </div>
               <!--selecting_payment_cc-->
               <div class="selecting_payment_cc">
                  <div class="selecting_payment_one">
                     <div class="lable_counter_paymnet_cc counter_right_lable">Balance to pay</div>
                     <!--<input placeholder="Balance" class="tax_textbox transa_txt counter_text_box">-->
                     <input placeholder="Balance" class="tax_textbox transa_txt counter_text_box" name="coupbal" id="coupbal" readonly="">
                  </div>
               </div>
               <!--selecting_payment_cc-->
            </div>
            <!--coupon_cc-->  
            <div class="voucher_cc" style="display: none;">
               <div class="discount_text_cc crd_head">Voucher</div>
               <div class="selecting_payment_cc">
                  <div class="selecting_payment_one">
                     <div class="lable_counter_paymnet_cc counter_right_lable">Voucher ID</div>
                     <!--<input placeholder="Voucher ID" class="tax_textbox transa_txt counter_text_box">-->
                     <input placeholder="Enter Voucher ID" class="tax_textbox transa_txt counter_text_box" name="vouchid" id="vouchid">
                  </div>
               </div>
               <!--selecting_payment_cc-->
               <div class="selecting_payment_cc">
                  <div class="selecting_payment_one">
                     <div class="lable_counter_paymnet_cc counter_right_lable">Voucher Amount</div>
                     <input placeholder="Voucher Amount" class="tax_textbox transa_txt counter_text_box" name="vocamount" id="vocamount" onfocus=" return AddClass(this.id)" onkeypress="return charlimit(event,this.value)"  onkeyUp="return enterbalance(event,this.id)"  autocomplete="off">
                     <!-- <input placeholder="Voucher Amount" class="tax_textbox transa_txt counter_text_box">-->
                  </div>
               </div>
               <!--selecting_payment_cc-->
               <div class="selecting_payment_cc">
                  <div class="selecting_payment_one">
                     <div class="lable_counter_paymnet_cc counter_right_lable">Balance to pay</div>
                     <!--<input placeholder="Balance" class="tax_textbox transa_txt counter_text_box">-->
                     <input placeholder="Balance" class="tax_textbox transa_txt counter_text_box" name="vouchbal" id="vouchbal" readonly="">
                  </div>
               </div>
               <!--selecting_payment_cc-->
            </div>
            <!--voucher_cc-->  
            <div class="cheque_cc" style="display: none;">
               <div class="discount_text_cc crd_head">Cheque</div>
               <div class="selecting_payment_cc">
                  <div class="selecting_payment_one">
                     <div class="lable_counter_paymnet_cc counter_right_lable">Cheque No</div>
                     <input placeholder="Enter Cheque No" class="tax_textbox transa_txt counter_text_box" name="cheqname" id="cheqname">
                     <!--<input placeholder="Cheque No" class="tax_textbox transa_txt counter_text_box">-->
                  </div>
               </div>
               <!--selecting_payment_cc-->
               <div class="selecting_payment_cc">
                  <div class="selecting_payment_one">
                     <div class="lable_counter_paymnet_cc counter_right_lable">Bank Name</div>
                     <input placeholder="Enter Bank Name" class="tax_textbox transa_txt counter_text_box" name="cheqbank" id="cheqbank">
                     <!--<input placeholder="Bank Name" class="tax_textbox transa_txt counter_text_box">-->
                  </div>
               </div>
               <!--selecting_payment_cc-->
               <div class="selecting_payment_cc">
                  <div class="selecting_payment_one">
                     <div class="lable_counter_paymnet_cc counter_right_lable">Amount</div>
                     <input placeholder="Enter Cheque Amount" class="tax_textbox transa_txt counter_text_box" value="" name="cheqamount" id="cheqamount" onfocus=" return AddClass(this.id)" onkeypress="return charlimit(event,this.value)" onkeyup="return enterbalance(event,this.id)" autocomplete="off">
                     <!--<input placeholder="Amount" class="tax_textbox transa_txt counter_text_box">-->
                  </div>
               </div>
               <!--selecting_payment_cc-->
               <div class="selecting_payment_cc">
                  <div class="selecting_payment_one">
                     <div class="lable_counter_paymnet_cc counter_right_lable">Balance to pay</div>
                     <input placeholder="Balance" class="tax_textbox transa_txt counter_text_box" name="cheqbal" id="cheqbal" readonly="">
                     <!--<input placeholder="Balance" class="tax_textbox transa_txt counter_text_box">-->
                  </div>
               </div>
               <!--selecting_payment_cc-->
            </div>
            <!--cheque_cc-->  
            <div id="refdivall" class="paid_amount_cc_credit" style="display: none;">
                <div class="currency_main_div credit_crrency_select" style="display: none;">
                   
               <div  class="selecting_payment_cc">
                <div class="selecting_payment_one">
                  <div class="lable_counter_paymnet_cc counter_right_lable">Currency</div>
                  <select  class="tax_textbox transa_txt counter_text_box size_compat currency_selected" id="credit_currency_selected">
                    <?php
                        $sql_currency = mysqli_query($localhost,"SELECT `c_id`, `c_name`, `c_short_code` FROM `tbl_currency_master` WHERE `c_status`='Active' ");
                        $num_currency = mysqli_num_rows($sql_currency);
                        if ($num_currency) {$i=0;
                            while ($result_currency =mysqli_fetch_array($sql_currency)) {
                            $i++;
                    ?>
                      <option value="<?=$result_currency['c_id']?>" shortcode="<?=$result_currency['c_short_code']?>"><?=$result_currency['c_name']?></option>
                    <?php
                        }}
                    ?>
                  </select>
                </div>
               </div>
               
               <div class="selecting_payment_cc">
                     <div class="selecting_payment_one">
                         <div class="lable_counter_paymnet_cc counter_right_lable">Paid Amount<span id="credit_currency_shortcode_dipslay"></span></div>
                          <input placeholder="Paid Amount"  class="tax_textbox transa_txt counter_text_box" id="credit_paid_amount_in_currency" onfocus=" return AddClass(this.id)" onkeypress="return charlimit(event,this.value)"  onkeyUp="return enterbalance(event,this.id)"   value=""  autocomplete="off">
                     </div>
                </div>
                   
               </div>
                
                <div class="selecting_payment_cc">
                  <div class="selecting_payment_one">
                      <div class="lable_counter_paymnet_cc counter_right_lable">Paid Amount<span id="credit_base_currency_shortcode_display" style="display: block;">-<?=$_SESSION['base_currency']?></div>
                     <!--<input placeholder="Paid Amoun" class="tax_textbox transa_txt counter_text_box">-->
                      <input placeholder="Enter Paid Amount" class="tax_textbox transa_txt counter_text_box" id="paidamount_credit" name="paidamount_credit" onclick="return foc_credit_calc();" onkeypress="return charlimit(event,this.value)"  onkeyUp="return enterbalance(event,this.id)" value="0" maxlength="12">
                  </div>
               </div>
               <!--selecting_payment_cc-->
               <!--selecting_payment_cc-->
            </div>
            <!--paid_amount_cc_credit-->
            <div class="credit_type" style="display: none;">
               <div class="discount_text_cc crd_head" style="margin-top:10px;display: none">Credit Type</div>
               <div class="selecting_payment_cc">
                  <div class="selecting_payment_one" style="margin-bottom:7px;padding:0 1.5%;">
                     <!--<div class="lable_counter_paymnet_cc counter_right_lable">Select</div>-->
                     <select class="staff_menu_select counter_text_box" name="selectcreditypes" id="selectcreditypes" onclick="chvalof()">
                        <option id="selchngnew" value="">Select</option>
                        <option value="2" label="Staff name ">By Staff</option>
                        <option value="3" label="Company Name ">By Company</option>
                        <option value="4" label="Guest Name ">By Guest</option>
                     </select>
                  </div>
               </div>
               <!--selecting_payment_cc-->
               <div class="crd_select_head_cc credtitypeloads" id="crtype_div" style="    padding-right: 1.5%;">
               </div>
               <!--crd_select_head_cc-->
               <textarea style="display: none;" class="credit_remarks_cc" id="credit_remark" name="credit_remark" placeholder="Remarks"></textarea>
            </div>
            <!--credit_type-->
            <div style="display: none;" class="complimentrary_cc">
               <div class="discount_text_cc crd_head">Complimentary</div>
               <textarea placeholder="Enter Complimentary" class="room_textarea tax_textbox" name="completext" id="completext" onkeypress="return comp_text();" onchange="return comp_text();" style="height:80px;color:#000;margin-left: 5px;width: 96%;"></textarea>
            </div>
            <!--complimentrary_cc-->
            <div class="upi_cc" style="display: none;">
               <div class="discount_text_cc crd_head">UPI</div>
               <div class="selecting_payment_cc">
                  <div class="selecting_payment_one" style="text-align: center">
                     <!-- <div class="lable_counter_paymnet_cc counter_right_lable">Transaction Status</div>-->
                     <!--                                        <input style="width: 38%" placeholder="Enter Transaction Id" class="tax_textbox transa_txt counter_text_box" name="upitxnid" id="upitxnid" autocomplete="off">-->
                     <a href="#">
                        <div class="upi-sub-btn" id="txnstatuscheck">Click here to check status</div>
                     </a>
                  </div>
               </div>
               <!--selecting_payment_cc-->
               <div class="selecting_payment_cc">
                  <div class="selecting_payment_one">
                     <div class="lable_counter_paymnet_cc counter_right_lable">Upi Transaction Status</div>
                     <!--<input placeholder="Coupon Amount" class="tax_textbox transa_txt counter_text_box">-->
                     <input placeholder="Upi Transaction Status" class="tax_textbox transa_txt counter_text_box" name="upistatus" id="upistatus" autocomplete="off" readonly="">
                  </div>
               </div>
               <!--selecting_payment_cc-->
               <div class="selecting_payment_cc">
                  <div class="selecting_payment_one">
                     <div class="lable_counter_paymnet_cc counter_right_lable">Upi Amount Paid</div>
                     <!--<input placeholder="Coupon Amount" class="tax_textbox transa_txt counter_text_box">-->
                     <input placeholder="Upi Amount" class="tax_textbox transa_txt counter_text_box" name="upiamount" id="upiamount" onchange="upiamountchange(event)" autocomplete="off" readonly="">
                  </div>
               </div>
               <!--selecting_payment_cc-->
               <div class="selecting_payment_cc">
                  <div class="selecting_payment_one">
                     <div class="lable_counter_paymnet_cc counter_right_lable">Upi Transaction Id</div>
                     <!--<input placeholder="Coupon Amount" class="tax_textbox transa_txt counter_text_box">-->
                     <input placeholder="Upi Transaction Id" class="tax_textbox transa_txt counter_text_box" name="upitransactionid" id="upitransactionid" autocomplete="off" readonly="">
                  </div>
               </div>
               <!--selecting_payment_cc-->
               <div class="selecting_payment_cc">
                  <div class="selecting_payment_one">
                     <div class="lable_counter_paymnet_cc counter_right_lable upibalanceamount">Balance Amount To Pay</div>
                     <!--<input placeholder="Coupon Amount" class="tax_textbox transa_txt counter_text_box">-->
                     <input placeholder="Balance Amount To Pay" class="tax_textbox transa_txt counter_text_box" name="upibalanceamount" id="upibalanceamount" autocomplete="off" readonly="">
                  </div>
               </div>
               <!--selecting_payment_cc-->
            </div>
            <!--upi-->  
            
            
            <div class="discount_after_cc" style="display: none;">
               <div class="discount_text_cc crd_head">Discount</div>
               <div class="selecting_payment_cc">
                  <div class="selecting_payment_one">
                     <div class="lable_counter_paymnet_cc counter_right_lable">Discount Type</div>
                  
                     <select  class="tax_textbox transa_txt counter_text_box" id="dis_after_drop" onchange="dischange_after();">
                                            <option value="">Select Discount</option>
                        <?php
                                            
                        $sql_currency8 = mysqli_query($localhost,"SELECT * from tbl_discountmaster where ds_status='Active' and ds_item_discount='N' ");
                        $num_currency8 = mysqli_num_rows($sql_currency8);
                        if ($num_currency8) {
                         
		          while($row_listall_dsc  = $database->mysqlFetchArray($sql_currency8)) 
		        { 
                                            
                                          
                        ?>
                        <option mode_ds="<?=$row_listall_dsc['ds_mode']?>" val_ds="<?=$row_listall_dsc['ds_discountof']?>" value="<?=$row_listall_dsc['ds_discountid']?>" ><?= $row_listall_dsc['ds_discountname']?></option>
                       <?php } } ?>
                       </select>
                     
                  </div>
               </div>
               <!--selecting_payment_cc-->
               <div class="selecting_payment_cc">
                  <div class="selecting_payment_one" style="margin-bottom:10px">
                     <div class="lable_counter_paymnet_cc counter_right_lable">Discount</div>
                     <input style="width:25%;" class="tax_textbox transa_txt counter_text_box" name="dis_after_manual" id="dis_after_manual">
                     <select style="width: 22%; margin-left: 2%;"  class="tax_textbox transa_txt counter_text_box" id="dis_after_type">
                        <option value="P">%</option>
                         <option value="V">Value</option>
                     </select>
                  </div>
               </div>
               <!--selecting_payment_cc-->
               <!-- <div class="selecting_payment_cc">
                  <div class="selecting_payment_one">
                    
                     
                  </div>
               </div> -->
               <!--selecting_payment_cc-->
               
                <div style="float:right;margin: 7px 5px 0 0" class="view_items_btn_dis discount_apply_after">Apply</div>
            </div>
            
            
            <div id="refdiv" class="paid_amount_cc" style="display: block;">
               <input type="hidden" id="convorate" value=""> 
               
               <div class="currency_main_div" style="display: none;">
                   
               <div  class="selecting_payment_cc">
                <div class="selecting_payment_one">
                  <div class="lable_counter_paymnet_cc counter_right_lable">Currency</div>
                  <select  class="tax_textbox transa_txt counter_text_box size_compat currency_selected" id="currency_selected">
                    <?php
                        $sql_currency = mysqli_query($localhost,"SELECT `c_id`, `c_name`, `c_short_code` FROM `tbl_currency_master` WHERE `c_status`='Active' ");
                        $num_currency = mysqli_num_rows($sql_currency);
                        if ($num_currency) {$i=0;
                            while ($result_currency =mysqli_fetch_array($sql_currency)) {
                            $i++;
                    ?>
                      <option value="<?=$result_currency['c_id']?>" shortcode="<?=$result_currency['c_short_code']?>"><?=$result_currency['c_name']?></option>
                    <?php
                        }}
                    ?>
                  </select>
                </div>
               </div>
               
               <div class="selecting_payment_cc">
                     <div class="selecting_payment_one">
                         <div class="lable_counter_paymnet_cc counter_right_lable">Paid Amount<span id="currency_shortcode_dipslay"></span></div>
                          <input placeholder="Paid Amount"  class="tax_textbox transa_txt counter_text_box" id="paid_amount_in_currency" onfocus=" return AddClass(this.id)" onkeypress="return charlimit(event,this.value)"  onkeyUp="return enterbalance(event,this.id)"   value=""  autocomplete="off">
                     </div>
                </div>
                   
               </div>
               
               <div class="selecting_payment_cc">
                  <div class="selecting_payment_one">
                      <div class="lable_counter_paymnet_cc counter_right_lable paid_cls" style="width: 49.5%;">Paid Cash<span id="base_currency_shortcode_display" style="display: block;"> - <?=$_SESSION['base_currency']?></span></div>
                     <!--<input placeholder="Enter Balance Amount" class="tax_textbox transa_txt counter_text_box"  value="0">-->
                     <input placeholder="Cash" class="tax_textbox transa_txt counter_text_box" id="paidamount" name="paidamount" onfocus=" return AddClass(this.id)" onkeypress="return charlimit(event,this.value)"  onkeyUp=" return enterbalance(event,this.id)"  value="" autocomplete="off" maxlength="12">
                  </div>
               </div>
               <div class="selecting_payment_cc bal_cls_div">
                  <div class="selecting_payment_one">
                     <div class="lable_counter_paymnet_cc counter_right_lable bal_cls" style="width: 49.5%;">Balance Cash</div>
                     <!--<input placeholder="Enter Paid Amount" class="tax_textbox transa_txt counter_text_box" value="0" readonly="">-->
                     <input placeholder="Balance Amount" class="tax_textbox transa_txt counter_text_box" id="balanceamout" name="balanceamout" value="" readonly="">
                  </div>
               </div>
               <!--selecting_payment_cc-->
            </div>
            <!--paid_amount_cc-->
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
             
             
             
         <div style="width:100%;float:left;" class="">
            <div class="popup_bottom_tax_detail tax_1" id="taxdetails_div" style="width:56%;padding-right: 3%;">
            </div>
         <div class="popup_bottom_tax_detail" style="width:44%;float:right;padding-right: 3%;">
            <div style="width:100%; " class="lable_counter_paymnet_cc counter_right_lable dis_view1" >Discount:<span id="totaldisc">0.000</span></div>
             <div style="width:100%; " class="lable_counter_paymnet_cc counter_right_lable"><span id="dis_details_new"></span></div>
              <div style="width:100%; " class="lable_counter_paymnet_cc counter_right_lable dis_view2">Item Discount :<span id="dis_item_new"></span></div>
            <div style="width:100%" class="lable_counter_paymnet_cc counter_right_lable"><strong> Sub Total  = <span id="final">0.000</span><span></span></strong></div>
         </div>
      </div>
      <!--div-->
      <div style="" class="lable_counter_paymnet_cc lable_counter_paymnet_cc_1 counter_right_lable">
         <strong>Total :(<?=$_SESSION['base_currency']?>) <span id="grandtotal">0.000</span></strong>
      </div>
   </div>
   <!--counter_payment_contain-->
 
   
   
   <div class="sms_detail_cls" >
                           
                               
                               <div id="number_load_settle" class="customer_list_autoload" style="display:none;top: 518px;width: 31%;left: 10px;height: 90px;">
                              <ul>
                            <li onclick="return number_click_settle();" style="cursor: pointer"></li>
                                </ul>
                               </div>
                               
       
                               <input class=""  style="display: none;width:27%;margin:0 10px;margin-bottom:61px;height: 33px; font-size: 13px;padding-left: 5px;line-height: 33px;border-radius: 5px;border: solid 1px #C7C7C7;" onkeyup="search_number_settle(event);" onclick="this.removeAttribute('readonly');"  readonly autocomplete="off" type="text" onkeypress="number_dot(event)" id="num_sms_new" placeholder="Number">      
                                  
                                <input class="" style="display: none;width:27%;margin:0 10px;margin-bottom:61px;height: 33px; font-size: 13px;padding-left: 5px;line-height: 33px;border-radius: 5px;border: solid 1px #C7C7C7;" onclick="this.removeAttribute('readonly');"  readonly autocomplete="off" type="text" id="name_sms_new" placeholder="Name"> 
                                
                                
                                <input class="" style="display: none;width: 27%;margin: 0 10px;height: 33px; font-size: 13px;padding-left: 5px;line-height: 33px;border-radius: 5px;border: solid 1px #C7C7C7;" type="text" onclick="this.removeAttribute('readonly');"  readonly autocomplete="off" id="remarks_sms_new" placeholder="Remarks"> 
                                   
                           </div>
   
   <div class="right_bottom_button_cc" style="bottom: -96px;">
       
        <?php 
                $sql_permission = mysqli_query($localhost,"SELECT ser_bill_regen_per,ser_bill_reprint_per FROM `tbl_staffmaster` "
                . "left join tbl_logindetails on ls_staffid=ser_staffid where ls_username='".$_SESSION['expodine_id']."' ");
                $num_permission = mysqli_num_rows($sql_permission);
                if ($num_permission) {  $i=0;
                   $result_permission =mysqli_fetch_array($sql_permission);
                   $reprint_permission=$result_permission['ser_bill_reprint_per'];
                   $regenerate_permission=$result_permission['ser_bill_regen_per'];
                }
        
        if($reprint_permission=='Y'){
        ?>
       
       
       <div style="width:25%;float:left;" class="tka_sum_btn_cc">
         <a class="tka_submit_buton settle_popup_close" id='reprint_button' fl_chk='<?=$_SESSION["floorid"]?>' style="cursor:pointer;color: #000;font-size: 15px;
       background-color: #ecd6b8;" href="#">Re-Print</a>
      </div>
       
       <?php }
        if($regenerate_permission=='Y'){
        ?>
       <div style="width:25%;float:left;padding-left: 0;" class="tka_sum_btn_cc">
       <a class="tka_submit_buton settle_popup_close" id='regenerate_button' fl_chk='<?=$_SESSION["floorid"]?>' style="cursor:pointer;color: #000;font-size: 15px;
       background-color: #ecd6b8;" href="#">Re-Generate</a>
      </div>
      <?php } ?>

       
       
        <?php if($_SESSION['s_sms_bill']=="Y") { ?>
        <div style="width:20%;float:left;font-size: 9px" class="tka_sum_btn_cc">
        <input id="sms_bill_settle" type="checkbox" >
         WHATSAPP-SMS BILL
        </div>
        <?php } ?>
       
   <?php if(in_array('payment_pending',$_SESSION['menuarray'])){ ?>
       
       <div style="width:30%;float:right;" class="tka_sum_btn_cc">
         <a class="tka_submit_buton" id="bill_settle_button" style="cursor:pointer;background-color: rgb(253, 0, 0);box-shadow: rgb(200, 0, 5) 0px 4px !important;">SETTLE</a>
      </div>
   <?php } ?>

       
   </div>
   <!--right_bottom_button_cc-->
  
   <div class="counter_settle_popup_right_calc_cc" style="display:block">
      <div class="counter_pop_left_portion" style="height:auto">
          <div class="settle_quick_cash_head" style="margin-bottom:0;padding-top:2px;">&nbsp;
              <a href="#"><div class="print-bill-in-tableselection-popup-cls" id='front_settle_popup_close'><img src="img/red_cross.png"></div></a></div>
            <div class="keys settle_key cr_first_key" style="margin-top:0">
            <span class="pay_settle_btn settle_calc_btn_from_front">1</span>
            <span class="pay_settle_btn settle_calc_btn_from_front">2</span>
            <span class="pay_settle_btn settle_calc_btn_from_front">3</span>
            <span class="pay_settle_btn settle_calc_btn_from_front">4</span>
            <span class="pay_settle_btn settle_calc_btn_from_front">5</span>
            <span class="pay_settle_btn settle_calc_btn_from_front">6</span>
            <span class="pay_settle_btn settle_calc_btn_from_front">7</span>
            <span class="pay_settle_btn settle_calc_btn_from_front">8</span>
            <span class="pay_settle_btn settle_calc_btn_from_front">9</span>
            <span class="pay_settle_btn settle_calc_btn_from_front">0</span>
            <span class="pay_settle_btn settle_calc_btn_from_front">.</span>
            <span class="pay_settle_btn settle_calc_btn_from_front">Clear</span>
            <!--<span class="calculator_settle">Enter</span>-->
    </div>
          
          <div class="keys key_credit" style="margin-top:0;display:none">
            <span class="pay_settle_btn_cr ">1</span>
            <span class="pay_settle_btn_cr ">2</span>
            <span class="pay_settle_btn_cr ">3</span>
            <span class="pay_settle_btn_cr ">4</span>
            <span class="pay_settle_btn_cr ">5</span>
            <span class="pay_settle_btn_cr ">6</span>
            <span class="pay_settle_btn_cr ">7</span>
            <span class="pay_settle_btn_cr ">8</span>
            <span class="pay_settle_btn_cr ">9</span>
            <span class="pay_settle_btn_cr ">0</span>
            <span class="pay_settle_btn_cr ">.</span>
            <span class="pay_settle_btn_cr">Clear</span>
           
         </div>
          
         <div class="settle_quick_cash">
            <div class="settle_quick_cash_head">QUICK CASH</div>
           
     <?php
     $sql_currency = mysqli_query($localhost,"select dm_denomination from tbl_denomination_master where dm_active='Y' order by dm_display_order asc ");
                        $num_currency = mysqli_num_rows($sql_currency);
                        if ($num_currency) {
                         
		        while($result_login5  = $database->mysqlFetchArray($sql_currency)) 
		        {
                            
                        ?>
                           <div class="settle_quick_cash_btn pay_settle_btn settle_calc_btn_from_front quick_cash"><?=$result_login5['dm_denomination']?></div>
                                    
    <?php } } ?>         
            
    </div>
          
          
    </div>
       
   </div>
</div>
<!--right_main_contant_cc-->
</div>
</div>

<div style="display:none;height: 160px;" class="index_popup_1 closeoneclass confirmpopup_reprint_di">
       <span id="failmsg_reprint_di" style="text-align: center;width: 100%;float: left ;padding-top: 7px;"></span>
       <div class="index_popup_contant">Are you sure you want continue without Bill Re-Print ?</div>
       <div class="index_popup_contant">
       <div class="btn_index_popup"><a href="#" class="confirm_ok_reprint_di">Yes</a></div>
       <div class="btn_index_popup"><a href="#" class="confirm_close_reprint_di">No</a></div>
    </div>
 </div>  

<script>  
    
  $('.view_item_clc').on('click', function(e) {
        
      $('.view_items_list_in_settle_sec').toggleClass("on_view_setlle_dl"); //you can list several class names 
      if($('.view_items_list_in_settle_sec').hasClass("on_view_setlle_dl")){
        front_settle_popup_menuload();
        $('.view_items_btn').text('Back');
        $('#bill_settle_button').hide();
      }
      else{
          $('.view_items_btn').text('View Items');
          $('.pop_payment_mode_sel_btn:first').click();
          $('#bill_settle_button').show();
      }
 });
    
    
    
 $('#kot_cancel_front').click(function () { 
     // window.location.href='menu_order.php?check_kot_cancel=kot_cancel_front';
      
       var staff_sel_mode= $('#staff_selection_mode').val();
                   
                      if(staff_sel_mode == 'Drop_Down'){
                                var steward=$('#stewardsel').val();
				var order   =  $('.allready').attr("ordrd");
				var order_v	  =	 order.split("_");
				var orderid       =  order_v[1];
                                $('.selectstafforedit').removeClass('allready');    
                                $('#takorder').removeClass('orderedtable');
                                $('#takorder').css('pointer-events','none');
				window.location="menu_order.php?orderid="+orderid+"&staffid="+steward+"&check_kot_cancel=kot_cancel_front";
                            }
                           else if(staff_sel_mode == 'Card/Pin'){
                                
                              var order   =  $('.allready').attr("ordrd");
  var order_v  = order.split("_");
  var orderid       =  order_v[1];
                               
                                $.post("load_div.php", {value:'kot_cancel_staff',order_id:orderid},
                function(data)
                {
                   
                  var  steward=$.trim(data);
             
var order1   =  $('.allready').attr("ordrd");
var order_v1  = order1.split("_");
var orderid1       =  order_v1[1];
             
               $('.selectstafforedit').removeClass('allready');    
               $('#takorder').removeClass('orderedtable');
               $('#takorder').css('pointer-events','none');
   window.location="menu_order.php?orderid="+orderid1+"&staffid="+steward+"&check_kot_cancel=kot_cancel_front";
             
   });
    }
                                
			
   });
   
    
</script>

 <div id="load_loy_bill_data" class="load_loy_bill_data_cl" style="z-index: 99999999999;height: 700px ">

        <div class="load_loy_bill_data_cl_head">
            CUSTOMER DETAILS  <div onclick="return close_customer_data_pop();" class="load_loy_bill_data_close"><img src="img/uploadify-cancel.png"></div>
        </div>

        <div class="load_loy_bill_data_contant">
          
        <div class="load_loy_bill_data_contant_row">
                <table class="load_loy_bill_data_contant_tbl">
                    <thead>
                        <tr>
                            <th>NAME</th>
                            <th>NUMBER</th>
                            <th>EMAIL</th>
                            <th>JOINED</th>
                            <th>NO OF VISITS</th>
                            <th>TOTAL POINTS</th>
                            <th>AMOUNT SPEND</th>
                        </tr>
                    </thead>
                    <tbody id="general_data_loy">
                        
                    </tbody>
                </table>
            </div>

            <div class="load_loy_bill_data_contant_row">
                <table class="load_loy_bill_data_contant_tbl">
                    <thead>
                        <tr>
                            <th>FAVOURITE 5 ITEMS</th>
                           
                        </tr>
                    </thead>
                    <tbody id="fav_data_loy">
                        
                    </tbody>
                </table>
            </div>

            <div class="load_loy_bill_data_contant_row">
            <div class="card-box table-responsive">
                            
                            <form >
                            
                            <div class="dt-buttons btn-group" style="margin-bottom:8px;width:100%">
                            	
                            
                             <div class="col-sm-3">
                                	<div class="table-filter-text">Bill No</div>
                                        <input type="text" class="list-filter-textbox" placeholder="Bill No" id="bill_loy_srch" onkeyup="search_loy_pop_data();">
                                </div>
                                
                                <div class="col-sm-3">
                                    <div class="table-filter-text">From Date</div>
                                	<div class="table-filter-text"> </div>
                                        <input type="text" class="list-filter-textbox" placeholder="From Date" id="from_loy_srch" onkeyup="search_loy_pop_data();" >
                                </div>
                                
                                <div class="col-sm-3">
                                    <div class="table-filter-text">To Date</div>
                                	<div class="table-filter-text"> </div>
                                        <input type="text" class="list-filter-textbox" placeholder="To Date" id="to_loy_srch" onkeyup="search_loy_pop_data();" >
                                </div>
                                
                            </div>
                             </form>
                            
          <div class="load_loy_bill_data_contant_tbl_scr">  	
           <table class="load_loy_bill_data_contant_tbl">
                    <thead>
                        <tr>
                            <th>BILL NO</th>
                            <th>SUBTOTAL AMOUNT	</th>
                            <th>REDEEM POINT	</th>
                            <th>ADDED POINT	</th>
                            <th>REDEEM AMOUNT	</th>
                            <th>TTL AFTER REDEEM	</th>
                            <th>DATE</th>
                           
                        </tr>
                    </thead>

                                <tbody id="bill_data_loy">

                               </tbody>
                        </table></div></div></div></div></div>

    </body>



    <div class="editpax_pop_sec" style="display:none">
            <div class="editpax_pop">
                <a href="#"><div class="edt_px_close_sec"><img src="img/black_cross.png" alt=""></div></a>
               <div class="editpax_pop_cnt">
                    <div class="editpax_pop_cnt_input">
                        <input type="number" class="" id="pax_update_new" placeholder="PAX" maxlength="3">
                        <a href="#"><div class="editpax_pop_cnt_update_btn" onclick="update_pax_order()">UPDATE</div></a>

                    </div>
                    <div class="key_bord_counter_sel_cc">
								<div class="keys settle_key">
                                <span class="clc_btn_12 cs_pax">1</span>
                                <span class="clc_btn_12 cs_pax">2</span>
                                <span class="clc_btn_12 cs_pax">3</span>
                                <span class="clc_btn_12 cs_pax">4</span>
                                <span class="clc_btn_12 cs_pax">5</span>
                                <span class="clc_btn_12 cs_pax">6</span>
                                <span class="clc_btn_12 cs_pax">7</span>
                                <span class="clc_btn_12 cs_pax">8</span>
                                <span class="clc_btn_12 cs_pax">9</span>
                                
                                <span class="clc_btn_12 cs_pax">0</span>
                                <span style="    max-width: 145px;width: 65%;margin-right: 0;"class="clc_btn_12 cs_pax">Clear</span>
                                <!--<span class="calculator_settle">Enter</span>-->
                            </div>
						</div>
               </div>
            </div>
    </div>


    <div class="cs_loy_pop" id="loyalty_cs_pop" style="display: none;z-index: 999">
     <div class="delete_con_pop" style="left:45px; height:auto;width: 350px;top:20%;background-color:white;color: black !important;border: 0;padding-bottom: 10px ! important ">
         <div class="loyalty_cs_pop_overlay" style="display: none "><img src="img/ajax-loaders/pls_wait.gif"></div>
         Customer Details <br>
         
       <div style="  height: auto; width: 100%;text-align: left;padding: 7px 20px;margin-top: 7px; margin-bottom: 8px; float: left; background-color: #f3f3f3; ">   

           <div class="inp_lyt_hlf_dv">
     <div class="lyt_txtbx_row" style=""><input onkeyup="return search_new_enter(event);" class="lyt_inp" type="number" id="phone_cs" style="float:right" placeholder="Number"></div>
      <div id="num_load_new" class="customer_list_autoload" style="display:none; width: 89%; top: 75px; right: 19px">
       <ul>
       <li onclick="return num_click_new();" style="cursor: pointer"> </li>
        </ul>
        </div>
     
     
     </div>    
           
           
       <div class="inp_lyt_hlf_dv">
           <div class="lyt_txtbx_row" style="width:100%;float: left;;margin-bottom: 10px;font-size:12px">   <input class="lyt_inp" onkeyup="return search_new_enter(event);"  onkeypress="return alpha_name(event)" type="text" id="firstname_cs" style="float:right" placeholder="Name"></div>
     
        <div id="name_load_new" class="customer_list_autoload" style="display:none; width: 89%; top: 115px; right: 19px">
                            <ul>
                               <li onclick="return name_click_new();" style="cursor: pointer"> </li>
                             </ul>
                      </div>
       
       </div>    
  
     
      <div class="inp_lyt_hlf_dv">
      <div class="lyt_txtbx_row" style="width:100%;float: left;margin-bottom: 10px">      <input class="lyt_inp" type="text" id="email_cs" style="float:right" placeholder="Email"></div>
      </div>   
           
            <div class="inp_lyt_hlf_dv">
      <div class="lyt_txtbx_row" style="width:100%;float: left;margin-bottom: 10px">      <input class="lyt_inp" type="text" id="gst_loy" style="float:right" placeholder="TRN/VAT/GST Number/Remarks"></div>
      </div>   
     
          <div class="inp_lyt_hlf_dv sms_mail_div">

        <div style="width:auto;float: left;margin-bottom: 10px"> SMS  -     <input style="position: relative;top: 2px " type="checkbox" id="checkbox_sms"> </div>
         
     
      <div style="width:auto;float: left;margin-bottom: 10px;margin-left:15px"> MAIL  -    <input style="position: relative;top: 2px " type="checkbox" id="checkbox_mail"> </div>
      </div>    
      
     
       </div>
         
       
       <div style="width:100%;float: left;height: 15px; line-height: 0;;right:10px;bottom:10px"><strong id="error_show" style="display:none;color: darkred"></strong></div>
       &nbsp; <a onclick="return close_loy_pop();" style="cursor:pointer;background-color:#666 !important;text-decoration:none;display: none;
    margin-right: 2%;" ck="cancel" class="ts_status">HISTORY</a> 

         <a style="cursor:pointer;background-color:#5f0909 !important;text-decoration:none" onclick="return submit_loy_cs();" class="clear_all_ok">SUBMIT</a> 
           
     &nbsp; <a onclick="return close_loy_pop();" style="cursor:pointer;background-color:#5f0909 !important;text-decoration:none" ck="cancel" class="ts_status">EXIT</a> 

     
      </div>
</div>



<script>
    
 $(".counter_list_action_btn").click(function(){
      $("#loyalty_cs_pop").show();
      $('#phone_cs').focus();
 });
   

function search_new_enter(e){
   
    if(e.keyCode == 13)
     {
        if(localStorage.enter_key=='yes'){  
          submit_loy_cs();
         
        }
        localStorage.enter_key='yes';
    }
     
}


 function alpha_name(e) {
    var k;
    document.all ? k = e.keyCode : k = e.which;
    return ((k > 64 && k < 91) || (k > 96 && k < 123) || k == 8 || k == 32 || (k >= 48 && k <= 57));
  }    
    
    
 function submit_loy_cs(){ 
      event.stopImmediatePropagation();  
      
      var edit_id= $('#firstname_cs').attr('edit_id');
      
      var selected_activities =$('.table_select');
                        var ids = new Array();
                        var asci=new Array();
                        selected_activities.each(function(){
                                      var id_str   =  $(this).attr("title");
                                      var id_arr	  =	 id_str.split("_");
                                      var selval       =  id_arr[1];
                                if(selval!='undefined' && selval!='' && selval!=null){
                                        ids.push(selval);
                                }
       });
       
       
      var current_floor=$('.table_floor_select_btn_act').attr('fl_id_change');
             
      if(edit_id!='' && edit_id!='undefined' && edit_id!=undefined ){
       
          var fname=$('#firstname_cs').val();
                   var lname='';
                   var phone=$('#phone_cs').val();
                   var bday='';
                    var email=$('#email_cs').val();
                   var marital='';
                   var anvy='';
                   var prof='';
                   var gender='';
            var  gst_loy =$('#gst_loy').val(); 
           var  mode_loy ='DI' 
           
           var tables=ids;
                                        
                   var chk_mail='N';
                            
                   var chk_sms='N';
                       
                   var len=$('#phone_cs').val().length;
                    
                 
                 $.ajax({
			type: "POST",
			url: "load_divcheckmenu.php",
			data: "value=mobileadd_loyalty_edit&mid="+phone+"&ly_id="+edit_id,
			success: function(msg)
			{
			msg=$.trim(msg);
				
		if(msg =="sorry")
					{
                                            
		$("#error_show").show();
                var error_show=$('#error_show');
	        error_show.text('Number Already Exists');	
	        $("#error_show").delay(2000).fadeOut('slow');
		$('#phone_cs').focus();	    
		}
		else
		{
                 
                $.ajax({
			type: "POST",
			url: "load_divcheckmenu.php",
			data: "value=mailadd_loyalty_edit&mid="+email+"&ly_id="+edit_id,
			success: function(msg1)
			{
		msg1=$.trim(msg1);
				
		if(msg1 =="sorry" && email!='')
		{
                                            
	       $("#error_show").show();
               var error_show=$('#error_show');
	       error_show.text('Mail Already Exists');	
	       $("#error_show").delay(2000).fadeOut('slow');
	       $('#email_cs').focus();
                
		}
		else
		{
                    
                 var filter = /^([\w-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([\w-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$/;

              if(phone!="" && len>='5' && fname!="") {   
                            
               var data="set_update=update_loyalty&fname1="+fname+"&lname1="+lname+"&email1="+email+"&bday1="+bday+"&phone1="+phone+"&marital1="+marital+"&anvy1="+anvy+"&prof1="+prof+"&chk_mail1="+chk_mail+"&chk_sms1="+chk_sms+"&gender1="+gender+"&gst_loy="+gst_loy+"&ly_id="+edit_id+'&chk_sts1=Active&mode_loy='+mode_loy+"&tables="+tables+"&current_floor="+current_floor;
     
               $("#error_show").show();
               var error_show=$('#error_show');
	       error_show.text('ADDING DATA...');
    
            //$('.loyalty_cs_pop_overlay').show();
    
        $.ajax({
        type: "POST",
        url: "loyalty/registration.php",
        data: data,
        success: function(data)
        {   
            	
            
               $('#gender_cs').val('M');
               $('#firstname_cs').val('');
               $('#lastname_cs').val('');
               $('#phone_cs').val('');
               $('.bday_cs').val('');
               $('#email_cs').val('');
               $('#marital_cs').val('single');
               $('.anniversary_cs').val('');
               $("#profession_cs").val($("#profession_cs option:first").val());
               $('#checkbox_mail').attr('checked', false);
               $('#checkbox_sms').attr('checked', false);
              
               $('.confrmation_overlay_proce_load').css('display','block');
               $('#bill_print_loader_new').html('<img src="img/ajax-loaders/loader_load.gif" />');
                error_show.text(''); 
                setInterval(function () {  
                    $('.loyalty_cs_pop_overlay').hide();
                    $('#loyalty_cs_pop').hide();
                    location.reload();
                }, 500);
        }
    });
    
    
    
    }else{
               $("#error_show").show();
               var error_show=$('#error_show');
	      
               if($('#phone_cs').val()==""){
                    error_show.text('Enter Number');	
	       $("#error_show").delay(2000).fadeOut('slow');
                $('#phone_cs').focus();
               }
               else if($('#firstname_cs').val()==""){
                    error_show.text('Enter Name');	
	       $("#error_show").delay(2000).fadeOut('slow');
                $('#firstname_cs').focus();
               }else if($('#phone_cs').val()!="" && len<5){
                $('#phone_cs').focus(); 
                error_show.text('Enter Valid Number');	
            }
               
    }
    
            
     }
        }
    });
            }
        }
    });
          
        }else{
     
                   var fname=$('#firstname_cs').val();
                   var lname='';
                   var phone=$('#phone_cs').val();
                   var bday='';
                   var email=$('#email_cs').val();
                   var marital='';
                   var anvy='';
                   var prof='';
                   var gender='';
                   var  gst_loy =$('#gst_loy').val(); 
                   var  mode_loy ='DI' 
           
           
                   var chk_mail;
                   if($("#checkbox_mail").is(':checked'))
		    {
                       chk_mail='Y';              
                    }else{
                       chk_mail='N';
                    }
                            
                   var chk_sms;
                   if($("#checkbox_sms").is(':checked'))
		    {
                     chk_sms='Y';              
                      }else{
                       chk_sms='N';
                     }
                            
                    var len=$('#phone_cs').val().length;
                    
                 
                   $.ajax({
			type: "POST",
			url: "load_divcheckmenu.php",
			data: "value=mobileadd_loyalty&mid="+phone,
			success: function(msg)
			{
		msg=$.trim(msg);
				
		if(msg =="sorry")
					{
                                            
		$("#error_show").show();
                var error_show=$('#error_show');
	        error_show.text('Number Already Exists');	
	        $("#error_show").delay(2000).fadeOut('slow');
		$('#phone_cs').focus();
                
		}
		else
		{
                 
                  $.ajax({
			type: "POST",
			url: "load_divcheckmenu.php",
			data: "value=mailadd_loyalty&mid="+email,
			success: function(msg1)
			{
			msg1=$.trim(msg1);
				
			if(msg1 =="sorry" && email!='')
			{
                                            
	        $("#error_show").show();
                var error_show=$('#error_show');
	        error_show.text('Mail Already Exists');	
	        $("#error_show").delay(2000).fadeOut('slow');
		$('#email_cs').focus();	    
		}
		else
		{
                    
                 var filter = /^([\w-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([\w-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$/;

                  if(phone!="" && len>='5' && fname!="") {   
                      
                  var tables=ids;       
                           
             var data="set_add=add_loyalty&fname="+fname+"&lname="+lname+"&email="+email+"&bday="+bday+"&phone="+phone+"&marital="+marital+"&anvy="+anvy+"&prof="+prof+"&chk_mail="+chk_mail+"&chk_sms="+chk_sms+"&gender="+gender+"&gst_loy="+gst_loy+"&mode_loy="+mode_loy+"&tables="+tables+"&current_floor="+current_floor;
     
               $("#error_show").show();
               var error_show=$('#error_show');
	       error_show.text('ADDING DATA...');
    
            //$('.loyalty_cs_pop_overlay').show();
    
        $.ajax({
        type: "POST",
        url: "loyalty/registration.php",
        data: data,
        success: function(data)
        {   
            
            
               $('#gender_cs').val('M');
               $('#firstname_cs').val('');
               $('#lastname_cs').val('');
               $('#phone_cs').val('');
               $('.bday_cs').val('');
               $('#email_cs').val('');
               $('#marital_cs').val('single');
               $('.anniversary_cs').val('');
               $("#profession_cs").val($("#profession_cs option:first").val());
               $('#checkbox_mail').attr('checked', false);
               $('#checkbox_sms').attr('checked', false);
              
              
                 error_show.text(''); 
                 
                 setInterval(function () {  
                     
                  $('.loyalty_cs_pop_overlay').hide();
                  $('#loyalty_cs_pop').hide();
                  // location.reload();
                  
                 }, 500);
                 
        }
    });
    
    
    
    }else{
               $("#error_show").show();
               var error_show=$('#error_show');
	      
               if($('#phone_cs').val()==""){
                    error_show.text('Enter Number');	
	       $("#error_show").delay(2000).fadeOut('slow');
                $('#phone_cs').focus();
               }
               else if($('#firstname_cs').val()==""){
                    error_show.text('Enter Name');	
	       $("#error_show").delay(2000).fadeOut('slow');
                $('#firstname_cs').focus();
               }else if($('#phone_cs').val()!="" && len<5){
                $('#phone_cs').focus(); 
               error_show.text('Enter Valid Number');	
       }
               
    }
    
            
     }
        }
    });
            }
        }
    });
    
        }
        
    }
    
    
    
  function close_loy_pop(){
   $('#loyalty_cs_pop').hide();
        
   $('#firstname_cs').val('');
   
   $('#phone_cs').val('');
     
   $('#email_cs').val('');
    
    $('#gst_loy').val('');
 }
    

    
    
    function edit_loy_data(id,n,p,g,e){
        $('.sms_mail_div').hide();
      
        $('#firstname_cs').val(n);
        $('#phone_cs').val(p);
        $('#email_cs').val(e);
        $('#gst_loy').val(g);
        $('#firstname_cs').attr('edit_id',id);
               
        $('#loyalty_cs_pop').show();
        
    }
    
    
  function view_one_click(orderno_from_tablesel13,tb){
      
      var orderno_from_tablesel=new Array();
      
      $("#print_in_view").attr("order", orderno_from_tablesel13);
      $("#print_in_view").attr("table", tb);
      
     var orderno_from_tablesel1=orderno_from_tablesel13.split(',');
                 
                for(var j=0;j<orderno_from_tablesel1.length;j++){
                    
                    if(orderno_from_tablesel1[j]!="" || orderno_from_tablesel1[j]!='undefined'){
                        orderno_from_tablesel.push(orderno_from_tablesel1[j]);
                    }
                }
    
    var ord_nm=orderno_from_tablesel13;
    
     var ord_nm = orderno_from_tablesel13.slice(-1);
     
   if (ord_nm == ',') {
     orderno_from_tablesel13 = orderno_from_tablesel13.slice(0, -1);
   }
    
    
    var current_floor=$('.table_floor_select_btn_act').attr('fl_id_change');
  
     var data="set=single_click_load&ordno="+orderno_from_tablesel13+"&flooor="+current_floor;
        $.ajax({
        type: "POST",
        url: "load_div.php",
        data: data,
        success: function(data)
        { 
        //  $('.view_click_div').show();
        //   $('#single_item_load').html(data);
           
        }
    });      
    
    
    
 
          var data = "ordno="+orderno_from_tablesel13+"&flooor="+current_floor+"&set=proceedbill";
                   
                 var request= $.ajax({
			  type: "POST",
			  dataType: "text",
			  url: "load_print_bill_view.php", 
			  data: data,
			  success: function(data) {
				  
                                $('.print-bill-in-tableselection-popup-cc').css('display','block');
                                $('.print-bill-in-tableselection-popup-cc').html(data);
                                
                          }
                          
			  
	    });
    
    
     
     
}

 function summary_view(ord){ 
     
  var data = "ordno="+ord+"&flooor=&set=proceedbill_summary";
                   
                 var request= $.ajax({
			  type: "POST",
			  dataType: "text",
			  url: "load_print_bill_view.php", 
			  data: data,
			  success: function(data) {
				  
                                $('.print-bill-in-tableselection-popup-cc').css('display','block');
                                $('.print-bill-in-tableselection-popup-cc').html(data);
                                
                          }
                          
			  
	    });
    
 }

function detail_view(ord){ 
     
  var data = "ordno="+ord+"&flooor=&set=proceedbill";
                   
                 var request= $.ajax({
			  type: "POST",
			  dataType: "text",
			  url: "load_print_bill_view.php", 
			  data: data,
			  success: function(data) {
				  
                                $('.print-bill-in-tableselection-popup-cc').css('display','block');
                                $('.print-bill-in-tableselection-popup-cc').html(data);
                                
                          }
                          
			  
	    });
    
 }


 function close_one_click(){
     
    $('.view_click_div').hide();
    
 }


 function print_on_one_click(){
    
   var orderno_from_tablesel13= $("#print_in_view").attr("order");
   var  tableno_from_tablesel3=  $("#print_in_view").attr("table");
      
      
      
     var confirm1=confirm("CONFIRM BILL PRINT");
    if(confirm1===true){
    
        var current_floor=$('.table_floor_select_btn_act').attr('fl_id_change');
        
          var Bill_print = "Bill_print";
          
          $.post("printercheck_1.php", {type:Bill_print,floor:current_floor},
                                               
            function(data)
            { 
            data=$.trim(data); 
          
            if(data !='')
            { 
                   alert(data)  ;                       
               $('.kotconfirmpopup').css('display','block');   
              $('#kotfailmsg').html(data);
               $(".confrmation_overlay_2nd").css("display","block");                              
                                          
            }
            else{ 
                
               $('.view_click_div').hide();
                
                
                var billname='';
                
                var billnum='';
                
                var billgst='';
              
                var discount_from_drop='';
                var type='';
                var discount_mode='';
                var orderno_from_tablesel=new Array();
                var tableno_from_tablesel1=new Array();
                var discount=0;
               
                
                
                 var orderno_from_tablesel1=orderno_from_tablesel13.split(',');
                 
                for(var j=0;j<orderno_from_tablesel1.length;j++){
                    
                    if(orderno_from_tablesel1[j]!="" || orderno_from_tablesel1[j]!='undefined'){
                        orderno_from_tablesel.push(orderno_from_tablesel1[j]);
                    }
                }
               
              	
               var tableno_from_tablesel=tableno_from_tablesel3.split(',');
               
                for (var p=0;p<tableno_from_tablesel.length;p++){
                    
                    if(tableno_from_tablesel[p].length!=0 && tableno_from_tablesel[p]!='undefined'){
                        
                        tableno_from_tablesel1.push(tableno_from_tablesel[p]);
                    }
                }
           
                                         var redeem_amount=0;
              
                                           var loyalty_id='';
                                           var loyalty_billamount6=0;
                                           var loyalty_billamount=0;
                                           var loyalty_billamount11=0;
                                           var loyalty_billamount1=0;
                                           var lp_add='';
                                           var lp_amt='';
                                           var tot_point=0;
                                           var loyalty_pointredeem=0;
                                           var loyalty_redeemamount=0;
                                           var loy_number='';
                                           var loy_name='';
                                           
                                           
                  //  alert(tableno_from_tablesel1);
                    
                  //  alert(orderno_from_tablesel);
                              
                var data_passing={ tabname:tableno_from_tablesel1,tableid:'',prefx:'',discount:discount,disctype:discount_mode,loyalityid:'',ord:orderno_from_tablesel,billname:billname,billnum:billnum,billgst:billgst,redeem_amount:redeem_amount,id_loy:loyalty_id,point_add:tot_point,point_redeem:loyalty_pointredeem,billamount:loyalty_billamount,redeemamount:loyalty_redeemamount,new_bill_amt:loyalty_billamount1,loy_number:loy_number,loy_name:loy_name,set:'proceedbill' };
             
                
                $.post("load_completedorder.php", data_passing,
                function(data){
                    $('.confrmation_overlay_proce_load').css('display','block');
                    $('#bill_print_loader_new').html('<img src="img/ajax-loaders/loader_print.gif" />');
                    
                     setTimeout(function () {
                         
                    $('.confrmation_overlay_proce_load').css('display','none');
                    $('#bill_print_loader_new').hide();
                    $('#bill_print_loader_new').html('');
                    
                }, 1000);
           
              
                  
                    $.post("load_div.php", {tableid:'',set:'tableselectionauto',tablename:'',qr_ord:''});
                    $.post("print_details.php", {set:'billprint'},
                    function(data1){
                        
                    });
                    
                     $('#takorder').show();
                    
                    $('.button').removeClass('table_select allready')
                    $('#takorder').css('display','none');
                    $('.print-table-btn').css('display','none');
                    $('#order_split_btn').hide();
                     $('.edit_pax_sec_rhgt').hide();
                     $('#kot_cancel_front').hide();
                     $('.di_loy_icon').hide();
                    
                    $(".tablecamp").css("display","block");
                    $(".tablecamp1").css("display","none");
                    
                        var data1=$.trim(data);
                        $('#alertdiv').css('display','block');
                        $('#alertdiv').text(data1);
                        $('#alertdiv').delay(2000).fadeOut('slow');
                    document.getElementById('tablebutton1').disabled  = false;
                    data=$.trim(data);
                  
                });
                
                
                
            }
        });
        }
}



function no_print_bill(){

var  dataString1 = 'set=set_print_option_di&print_option=N' ;
                      
		$.ajax({
		type: "POST",
		url: "load_index.php",
		data: dataString1,
		success: function(data) {
                    
                  print_bill_quick();
                    
                    
                }
                });

}


  function print_bill_quick(){ 

        var orderno_from_tablesel13= $('.bill_quick_div').attr('orderno');  
        var tableno_from_tablesel3=  $('.bill_quick_div').attr('tableno');   
    
        var current_floor=$('.table_floor_select_btn_act').attr('fl_id_change');
        // alert(orderno_from_tablesel13);   alert(tableno_from_tablesel3);    alert(current_floor); 
         
        var Bill_print = "Bill_print";
          
          $.post("printercheck_1.php", {type:Bill_print,floor:current_floor},
                                               
            function(data)
            { 
            data=$.trim(data); 
          
            if(data !='')
            { 
                                      
               view_one_click(orderno_from_tablesel13,tableno_from_tablesel3);
                  
               setTimeout(function () {
                   $('#print_bill_from_tablesel').click();
               }, 500);
           
                  
            }
            else{ 
                
                $('.confrmation_overlay_proce_load').css('display','block');
                $('#bill_print_loader_new').html('<img src="img/ajax-loaders/loader_print.gif" />');
                
               //  var billname='';
                
               // var billnum='';
                
               // var billgst='';
              
                var discount_from_drop='';
                var type='';
                var discount_mode='';
                var orderno_from_tablesel=new Array();
                var tableno_from_tablesel1=new Array();
                var discount=0;
               
                
                var orderno_from_tablesel1=orderno_from_tablesel13.split(',');
                 
                for(var j=0;j<orderno_from_tablesel1.length;j++){
                    
                    if(orderno_from_tablesel1[j]!="" || orderno_from_tablesel1[j]!='undefined'){
                        orderno_from_tablesel.push(orderno_from_tablesel1[j]);
                    }
                }
               
              	
                var tableno_from_tablesel=tableno_from_tablesel3.split(',');
               
                for (var p=0;p<tableno_from_tablesel.length;p++){
                    
                    if(tableno_from_tablesel[p].length!=0 && tableno_from_tablesel[p]!='undefined'){
                        
                        tableno_from_tablesel1.push(tableno_from_tablesel[p]);
                    }
                }
                
                var tb=tableno_from_tablesel1[0].split('(');
               
                $.post("load_div.php", {tableid:tb[0],set:'delete_table_loy',floor_loy:current_floor},
                function(data){
                       
		data=$.trim(data);
                   
                var bill_loy=$.trim(data).split('*');
                
               if(bill_loy[0]!=''){
                   
                   var name_loy=bill_loy[0];
               }else{
                     var name_loy='';
               }
                
               if(bill_loy[1]!=''){
                     var num_loy=bill_loy[1];
               }else{
                     var num_loy='';
               }
               
               if(bill_loy[2]!=''){
                   var gst_loy=bill_loy[2];  
               }else{
                    var gst_loy=''; 
               }
                
                                           var redeem_amount=0;
                                           var loyalty_id='';
                                           var loyalty_billamount6=0;
                                           var loyalty_billamount=0;
                                           var loyalty_billamount11=0;
                                           var loyalty_billamount1=0;
                                           var lp_add='';
                                           var lp_amt='';
                                           var tot_point=0;
                                           var loyalty_pointredeem=0;
                                           var loyalty_redeemamount=0;
                                           var loy_number='';
                                           var loy_name='';
                            
                var data_passing={ tabname:tableno_from_tablesel1,tableid:'',prefx:'',discount:discount,disctype:discount_mode,loyalityid:'',ord:orderno_from_tablesel,billname:name_loy,billnum:num_loy,billgst:gst_loy,redeem_amount:redeem_amount,id_loy:loyalty_id,point_add:tot_point,point_redeem:loyalty_pointredeem,billamount:loyalty_billamount,redeemamount:loyalty_redeemamount,new_bill_amt:loyalty_billamount1,loy_number:loy_number,loy_name:loy_name,set:'proceedbill' };
                
                //alert(JSON.stringify(data_passing));
                
                $.post("load_completedorder.php", data_passing,
                function(data){ 
                  
                 
                $.post("print_details.php", {set:'billprint',ord:orderno_from_tablesel},
                function(data1){
                    
                setTimeout(function () {
               
                var  dataString1 = 'set=set_print_option_di&print_option=Y' ;
                      
		$.ajax({
		type: "POST",
		url: "load_index.php",
		data: dataString1,
		success: function(data) {
                     
                }
                });
                
                }, 2500);
                 
                });
                    
                    
                    $('.confrmation_overlay_proce_load').css('display','block');
                    $('#bill_print_loader_new').html('<img src="img/ajax-loaders/loader_print.gif" />');
                    $('.change_table_btn').removeClass('disablegenerate');   
                     
                   setTimeout(function () {
                      $('.confrmation_overlay_proce_load').css('display','none');
                      $('#bill_print_loader_new').hide();
                      $('#bill_print_loader_new').html('');
                   }, 500);
           
                     $.post("load_div.php", {tableid:'',set:'tableselectionauto',tablename:'',qr_ord:''});
                   
                     $('#takorder').show();
                    
                     $('.button').removeClass('table_select allready')
                     $('#takorder').css('display','none');
                     $('.print-table-btn').css('display','none');
                     $('#order_split_btn').hide();
                     $('.edit_pax_sec_rhgt').hide();
                     $('#kot_cancel_front').hide();
                     $('.di_loy_icon').hide();
                    
                     $(".tablecamp").css("display","block");
                     $(".tablecamp1").css("display","none");
                    
                    var data1=$.trim(data);
                    $('#alertdiv').css('display','block');
                    $('#alertdiv').text(data1);
                    $('#alertdiv').delay(2000).fadeOut('slow');
                    
                    document.getElementById('tablebutton1').disabled  = false;
                    data=$.trim(data);
                  
                });
                
                
               }); 
                 
        }
        
  });
        
  $(".bill_quick_div").css("display","none");

}

  function close_bill_quick(){
    
   $(".bill_quick_div").css("display","none");
   $.post("load_div.php", {tableid:'',set:'tableselectionauto',tablename:'',qr_ord:''});
                      $('.print-table-btn').removeAttr('order');
                      $('.print-table-btn').removeAttr('floor');
                      $('.print_bill_details_from_tablesel').val('');
                       
   $('.change_table_btn').removeClass('disablegenerate');              
}



function print_one_click(orderno_from_tablesel13,tableno_from_tablesel3){
   
    $(".bill_quick_div").css("display","block");
    $('.bill_quick_div').attr('orderno',orderno_from_tablesel13);  
    $('.bill_quick_div').attr('tableno',tableno_from_tablesel3);   
    
    $('.change_table_btn').addClass('disablegenerate');
    
}


 function search_number_settle(e){
    
     var number=$('#num_sms_new').val();
   
     var data="set=searchnumber_settle&number="+number;
        $.ajax({
        type: "POST",
        url: "load_index.php",
        data: data,
        success: function(data)
        {
            
        if(number.length>2){
            
            if($.trim(data)!=''){
           $('#number_load_settle').show();
         
           $('#number_load_settle').html(data);
       }
       }else{
            $('#number_load_settle').hide();
         
           $('#number_load_settle').html('');
        }
           
        }
    });      
       
       
}

 function  number_click_settle(n,i,num){
  
    if($('#num_sms_new').val()!=''){ 
        
     $('#name_sms_new').val(n);
   
     $('#num_sms_new').val(num);
     $('#number_load_settle').hide();
         
     $('#number_load_settle').html('');
     
    }
   
   
     
}


 function clear_loy_pop(phone){
    
     var check = confirm("CLEAR CUSTOMER DETAILS?");
	if(check==true)
	{
    
				var dataString1 = 'set=clear_loy_pop&mode=DI&phone='+phone;
				var request=  $.ajax({
				type: "POST",
				url: "load_index.php",
				data: dataString1,
				success: function(data) {
                                            
                                setInterval(function () {
                                    location.reload();
        
                                }, 500);                    
                                                                
                                                                
              }
           });
      }
    }
</script>


<div id="overlay" class="view_click_div" style="display:none"><div class="alert_msg">
        
  <h2>View Items</h2>
  <div class="col-lg-12" style="overflow-y:scroll; height:300px">

  <table class="table table-striped" >
      <thead class="tlb-hd" >
    <tr>
      <th scope="col" style="text-align:center">Sl</th>
      <th scope="col" style="text-align:center">Item</th>
      <th scope="col" style="text-align:center">Portion</th>
      <th scope="col" style="text-align:center">Qty</th>
      <th scope="col" style="text-align:right">Rate</th>
      <th scope="col" style="text-align:right">Total</th>
    </tr>
  </thead>
  <div>
      
  <tbody id="single_item_load"  >
      
    
  </tbody>
  
 </div>
 </table>

 </div>

  
<button onclick="close_one_click();" type="button" class="btn btn-danger btn_5">Close</button>

<button id="print_in_view" onclick="print_on_one_click();" type="button" class="btn btn-danger btn_5">Print</button>

</div>
</div>


<style>
.new_overlay{
	 width:100%;
	 height:100%;
	 background-color:rgba(0,0,0,0.8);
	 position:fixed;
	 z-index:999;
	 height: 100%;
	 }
         
.quick_pop_printer_sec{width:100%;height:100%;float:left;position:fixed;background-color:rgba(0,0,0,0.7);left:0;top:0;z-index:9999;}   
 .quick_pop_printer{width:310px;height:140px;background-color:#fff;border-radius:8px;overflow:hidden;left:0;right:0;margin:auto;top:0;bottom:0;position:absolute}  
 .quick_pop_printer_head{width:100%;height:auto;float:left;text-align:center;font-size:20px;color:#333;padding:15px 0;font-weight:bold}   
 .quick_pop_printer_content{width:100%;height:auto;float:left;padding:15px;}      
</style>

<div class="quick_pop_printer_sec bill_quick_div" style="display:none">
    <div class="quick_pop_printer">
        <div class="quick_pop_printer_head" > QUICK PRINT BILL  &nbsp;&nbsp;   <img onclick="close_bill_quick();" style="margin-right: -76px;width: 11%;;cursor: pointer" src="img/cancelled-ico.png"> </div>
          
        <div class="quick_pop_printer_content ">
              
            <?php  if(in_array("Completed Order", $_SESSION['menumodarray'])) { ?> 
            
             <div onclick="print_bill_quick();" style="margin-left:1%;width: 39%;display: inline-block;position: absolute;cursor: pointer;background-color: darkred;color:white" class="search_btn_member_invoice filte_new_box_btn btn_index_popup"><span id="submit_quick_print">PRINT</span></div>
               
             <?php if($_SESSION['s_print_option']=='Y' ){ ?>
             <div onclick="no_print_bill();" style="margin-left:1%;width: 39%;display: inline-block;position: absolute;right: 5%;cursor: pointer;background-color: red;color:white" class="search_btn_member_invoice filte_new_box_btn btn_index_popup no_print_in"><span id="submit_quick_close" >NO PRINT</span></div>
             <?php }else{ ?>  
             <div onclick="close_bill_quick();"  style="margin-left:1%;width: 39%;display: inline-block;position: absolute;right: 5%;cursor: pointer;background-color: red;color:white" class="search_btn_member_invoice filte_new_box_btn btn_index_popup "><span id="submit_quick_close" >CLOSE</span></div>
            
            <?php }  }else{ ?>  
             
             <span style="margin-left: 29px;font-weight: bold;color: red;"> NO PERMISSION OF COMPLETED ORDER </span>
             <?php }  ?>  
             
             </div>
      </div>
      <div>
     </div>
</div>



 <style>
.stck_add_btn{width: 20px; height: 20px; display: inline-block;background-color: #738a77; border-radius: 50%; color: #fff !important; margin-left: 5px;}
.stok_add_popup_sec{width:100%;height:100%;position:fixed;left:0;top:0;z-index:9999999999;background-color:rgba(0,0,0,0.9)}
.stok_add_popup{width:250px;height:150px;position:absolute;left:0;right:0;top:20%;background-color:#fff;margin:auto;border-radius:10px;}
.stok_add_popup_hd{width:100%;height:auto;float:left;font-size:18px;color:#242424;text-align:center;padding:20px 0;position:relative}
.stok_add_popup_cnt{width:100%;height:auto;float:left;padding:10px;}
.stock_add_txtbx{width:60%;height:35px;float:left;border:solid 1px #ccc;padding-left:6px}
.stock_add_btn{width:38%;float:right;height:35px;text-align:center;line-height:35px;background-color:#738a77;color:#fff;border-radius:5px;}
.stok_add_popup_cls{width:20px;height:20px;position:absolute;right:5px;top:5px}
 </style>
      
    <div class="stok_add_popup_sec" style="display:none" id="add_stock_pop">  
        
        <div class="stok_add_popup" style="width:300px;height: 160px">
        <div class="stok_add_popup_hd">  
            <strong style="font-size: 13px " id="name_dis_new"></strong> <span style="font-size: 13px "><?=$_SESSION['base_currency']?></span> 
            <a href="#" onclick="$('#add_stock_pop').hide();"><div class="stok_add_popup_cls">
            <img width="100%" src="img/black_cross.png" alt=""></div></a></div>
        
        <div class="stok_add_popup_cnt" id="cus_div">
            <span style="font-size:10px;font-weight: bold;color: darkred">ENTER ITEM DISCOUNT</span>  &nbsp; <br>
            <input style="width:30%;margin-right: 20px;border-radius: 5px;"  maxlength="10" type="text" class="stock_add_txtbx" id="item_dis_val" placeholder="Enter Value"> &nbsp;&nbsp;
            <select style="width:24%;border-radius: 5px;background-color: #e5e5e5"class="stock_add_txtbx" id="item_dis_type">
                <option value="v">Value</option>
                <option value="p">%</option>
            </select>
        <a  onclick="go_dis();" href="#"><div   style="width:30%" class="stock_add_btn">GO</div></a>
            
        </div>
        
    </div>
   </div>



</html>