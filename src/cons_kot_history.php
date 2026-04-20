<?php
header('Content-Type: text/html; charset=utf-8');
include('includes/session.php');		// Check session
//session_start();
include("database.class.php"); // DB Connection class
$database	= new Database();
include('includes/master_settings.php');
require_once("includes/title_settings.php");
//require_once("includes/menu_settings.php");
if(!isset($_SESSION['timeopen']) ){ header("location:index.php?msg=1"); }
//$_SESSION['date']='2015-12-11';
$date_given=explode("-",$_SESSION['date']);	
$days_in_month=cal_days_in_month(CAL_GREGORIAN,$date_given[1],$date_given[0]);
 $month_set=$date_given[1];//date('m');//date("M", strtotime(date('m')));
 $year_set=$date_given[0];//=date("Y");
 $day_set=$date_given[2];//date("d");

$today=$day_set."-".$month_set."-".$year_set;
?>
<!DOCTYPE HTML>
<html><head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Cons Kot History</title>
<link rel="shortcut icon" href="img/favicon.ico">
<link href="css/bootstrap-cerulean.min.css" rel="stylesheet" />
<link href="css/order_new.css" rel="stylesheet" type="text/css">
<link href="css/bill_history.css" rel="stylesheet" type="text/css">
<script src="js/jquery-1.10.2.min.js"></script> 

<!--
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
.tr_bill_gen_active	{
	    background-color: #930;
	}
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
.top_site_map_cc{height: 35px;}
.left_bill_history_contain{width: 52%;position:relative}
.bill_history_right_detail {width: 47%;}
.updatestock{top: 12px;margin-right: 78%;}
.bill_history_orderd_cont{margin-top:0;width: 100%;min-height: 370px;height: 73vh;}
.kot_history_right_table{width:100%;height:auto;float:left;}
.kot_history_right_table td{height: 25px;border: solid 1px rgba(255,255,255,0.1);color: #fff;font-size: 14px;}
.bill_history_details_table {min-height: inherit;height: auto;}
.bill_history_details_table_scroll{width:100%;float:left; min-height: 470px;height: 71vh;overflow:auto}
.combo_tbl_lst{width: 100%; font-size: 11px;  color: #6d0a21;  line-height: 11px !important;
	display: inline-block;}
	.filter_con_his_dv{float:left;padding-left:5px;margin-bottom:5px;}
	.filter_con_his_dv .cons_his_txt{width:100%;float:left;text-align:left;font-size:13px;height: 20px; line-height: 20px;}
	.filter_con_his_dv input{width:98%;float:left;height:28px;border:0;border-radius:3px;padding-left:10px;color:#333}
	.filter_con_his_dv select{width:98%;float:left;height:28px;border:0;border-radius:3px;padding-left:10px;color:#333}
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
</style>
<script>
$(function() {
   
    
    $('#printkot').css("display","none");
    
    
    $(".kot_history_number_di").click(function(){ 
	var kotno       =  $(this).attr("kotno");
	var status       =  $(this).attr("status");
	var dateval= $('#datepicker').val();
	var res = dateval.split("-");
	var dateset=res[2] +"-"+ res[1] +"-"+ res[0] ;
	 $('.kot_history_number').removeClass('tr_bill_gen_active');
	  $(this).addClass('tr_bill_gen_active');
	 var request = $.ajax({
			type: "POST",
			url: "load_kothistory.php",
			data: "value=loadkotdetails&dateval="+dateset+"&kotno="+kotno,
			success: function(msg)
			{
			
				$('#loadkotdeatils').html(msg);
                                
                                $('#printkot').css("display","block");
                                

			   
			}
		});
                
	 	data=null;
		response=null;
		request.onreadystatechange = null;
		request.abort = null;
		request = null;
	 
	
		});		
    
    
    
    
    
    

 $(".kot_history_number_ta_hd_cs").click(function(){ 
	var billno       =  $(this).attr("billno");
	var status       =  $(this).attr("status");
	var dateval= $('#datepicker').val();
	var res = dateval.split("-");
	var dateset=res[2] +"-"+ res[1] +"-"+ res[0] ;
	 $('.kot_history_number').removeClass('tr_bill_gen_active');
	  $(this).addClass('tr_bill_gen_active');
	 var request = $.ajax({
			type: "POST",
			url: "load_takothistory.php",
			data: "value=loadkotdetails&dateval="+dateset+"&billno="+billno,
			success: function(msg)
			{
			
				$('#loadkotdeatils').html(msg);
				
				
				$('#printkot').css("display","block");
				
			   
			}
		});  
	 	data=null;
		response=null;
		request.onreadystatechange = null;
		request.abort = null;
		request = null;
	 
	
		});	
                
            
            
     $("#kotcancel_reason_popup_new_cancel_btnbh_cs").click(function(){ 
        
         $('.kotcancel_reason_popup_reprint_cs').css('display','none');
                    $('.confrmation_overlay').css('display','none');
                    $('#pinbh').val('');  
        
    });       
            
            
            
 
 $("#printkot").click(function(){ 
        
         $('.kotcancel_reason_popup_reprint_cs').css('display','block');
                    $('.confrmation_overlay').css('display','block');
                    $('#pinbh').val('');  
                     $("#pinbh").focus();
                     
                 $('#mode_set').val('di');       
                     
        
    });
        
        
    $("#kotcancel_reason_popup_new_proceed_btnbh_cs").click(function(){     
            
            
            var pin =  $('#pinbh').val();
              
              if(pin !=''){
                  
                  
          var mode=$('#mode_set').val();      
                  
                  if(mode=='di'){
                  
              $.post("load_div.php", {pin:pin,type:'authpincheck',set:'pincheck'},
		function(data)
		{
                   
                    data=$.trim(data);
                    if(data!="NO")
                    {
            
            var staff_sl=data.split('*');
                  
                   if(staff_sl[14]=='kot_reprint:Y'){
            
            $('.kotcancel_reason_popup_reprint_cs').css('display','none');
                    $('.confrmation_overlay').css('display','none');
                    $('#pinbh').val('');  
            
			var kotno  = $(".tr_bill_gen_active").attr("kotno");
                      
			 $.post("print_details.php", {kot:kotno,set:'kotprint',check:'kotmissed'},
			  function(data1)
			  {
			  data1=$.trim(data1);
			  $(".loaderror").css("display","block");
		  $(".loaderror").addClass("popup_validate");
		  $(".loaderror").text('KOT PRINTED');
		  $('.loaderror').delay(1500).fadeOut('slow');
			  //alert(data1)
			  });
                          
                          
                   var kotno  = $(".tr_bill_gen_active").attr("kotno");
			 $.post("print_details.php", {kot:kotno,set:'console',check:'kotmissed'},
			  function(data1)
			  {
			  data1=$.trim(data1);
			  $(".loaderror").css("display","block");
		  $(".loaderror").addClass("popup_validate");
		  $(".loaderror").text('KOT PRINTED');
		  $('.loaderror').delay(1500).fadeOut('slow');
			  //alert(data1)
			  }); 
                          
            
            
                       }else{
                        $("#pin_errorbh").css("display","block");
			$("#pin_errorbh").text("NO PERMISSION");
			$("#pin_errorbh").delay(2000).fadeOut('slow');
                        $("#pinbh").val('');
                         $("#pinbh").focus();
                    }
            
            
            
                       }else{
                        $("#pin_errorbh").css("display","block");
			$("#pin_errorbh").text(" CODE ERROR ");
			$("#pin_errorbh").delay(2000).fadeOut('slow');
                        $("#pinbh").val('');
                         $("#pinbh").focus();
                    }
                }); 
                
                
            }else{
                
                
                 $.post("load_takeaway.php", {pin:pin,value:'authpincheck',set:'pincheck'},
		function(data)
		{
                    data=$.trim(data); 
                    if(data!="NO")
                    {
               
                  var staff_sl=data.split('*');
                 
                if($.trim(staff_sl[12])=='kot_reprint:Y'){
                    
                 var bill=$('#kotcancel_reason_popup_new_proceed_btnbh_cs').attr('billnum');
                 var kot=$('#kotcancel_reason_popup_new_proceed_btnbh_cs').attr('kotno');
                
                var  dataString = 'value=ta_kot_reprint&bilno_rep='+bill+'&kotno_rep='+kot;
           
					 $.ajax({
					type: "POST",
					url: "print_details_kot.php",
					data: dataString,
					success: function(data) {
                                            
                                            
                                           
						var dataString; 
						dataString = 'value=console_ta&bilno='+bill+'&kotno='+kot;
							   $.ajax({
							  type: "POST",
							  url: "print_details_kot.php",
							  data: dataString,
							  success: function(data2) {
							  }
							  });
						
						$("#status_error").show();
                                        $('#status_error').html('KOT PRINTED');
                                        $("#status_error").delay(1500).fadeOut('slow');
					
						}
					});
                      $('.kotcancel_reason_popup_reprint_cs').css('display','none');
                    $('.confrmation_overlay').css('display','none');
                    $('#pinbh').val('');  
                       
                       
            }else{
                $("#pin_errorbh").css("display","block");
			$("#pin_errorbh").text("NO PERMISSION");
			$("#pin_errorbh").delay(2000).fadeOut('slow');
                        $("#pinbh").val('');
                         $("#pinbh").focus();
            }
                
        
                }else{
                        $("#pin_errorbh").css("display","block");
			$("#pin_errorbh").text("CODE ERROR");
			$("#pin_errorbh").delay(2000).fadeOut('slow');
                        $("#pinbh").val('');
                         $("#pinbh").focus();
                    }
    });
                
                
            }
                
                
                
                
                
                          
                   }else{
                $("#pin_errorbh").css("display","block");
		$("#pin_errorbh").text("ENTER CODE");
		$("#pin_errorbh").delay(2000).fadeOut('slow');
                $("#pinbh").val('');
                $("#pinbh").focus();
            }        
                          
                  
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
 
});
function datechange()
{
     $('.confrmation_overlay_proce').css('display','block');
     $('.confrmation_overlay_proce').html('<img src="img/ajax-loaders/ajax-loader.gif" />');
                             
                             
    var mode=$('#mode').val();
    
    $('#tot_kot').hide();
    
    if(mode=='ALL'){
         $('#kotlisttotal').show();
        $('#kotlisttotal_ta').show();
         $('#kotlisttotal_cs').show();
         
         
        //di////
        var dt=$('#datepicker').val();
	  var res = dt.split("-");
	  var dateset=res[2] +"-"+ res[1] +"-"+ res[0] ;
	  
		 var kotno= null;
	 var bilno= null;
	 var statuss= null;
	 var bilsts= null;
	 
	$('#statuss').find('option:first').attr('selected', 'selected');
	$('#bilsts').find('option:first').attr('selected', 'selected');
	 
	  var request = $.ajax({
			type: "POST",
			url: "load_kothistory.php",
			data: "value=searchkothistory&dateval="+dateset+"&kotno="+kotno+"&bilno="+bilno+"&statuss="+statuss+"&bilsts="+bilsts,
			success: function(msg)
			{
			//alert(msg);
				$('#kotlisttotal').html(msg);
				$('#loadkotdeatils').empty();
			    $('.confrmation_overlay_proce').css('display','none');
			}
		});  
	 data=null;
		response=null;
		request.onreadystatechange = null;
		request.abort = null;
		request = null;
		
		var dateval= $('#datehid').val();
		var res = dateval.split("-");
		var dateset=res[2] +"-"+ res[1] +"-"+ res[0] ;
	
		var dt= $('#datepicker').val();
		if(dt!=dateset)
		{
			$('#printkot').css("display","none");
		}else
		{
			if($('#printerstatus').val()=="Y")
			{
					$('#printkot').css("display","block");
			}
		}
        
        
        ///ta_hd//
         var dt=$('#datepicker').val();
	  var res = dt.split("-");
	  var dateset=res[2] +"-"+ res[1] +"-"+ res[0] ;
	  
		 var kotno= null;
	 var bilno= null;
	 var statuss= null;
	 var bilsts= null;
	 
	$('#statuss').find('option:first').attr('selected', 'selected');
	$('#bilsts').find('option:first').attr('selected', 'selected');
	 
	  var request = $.ajax({
			type: "POST",
			url: "load_takothistory.php",
			
                        
                        data: "value=searchkothistory&dateval="+dateset+"&kotno="+kotno+"&bilno="+bilno+"&statuss="+statuss+"&mode=TA",
			success: function(msg)
			{
			
				$('#kotlisttotal_ta').html(msg);
				$('#loadkotdeatils').empty();
			    $('.confrmation_overlay_proce').css('display','none');
			}
		});  
	 data=null;
		response=null;
		request.onreadystatechange = null;
		request.abort = null;
		request = null;
		
		var dateval= $('#datehid').val();
		var res = dateval.split("-");
		var dateset=res[2] +"-"+ res[1] +"-"+ res[0] ;
	
		var dt= $('#datepicker').val();
		if(dt!=dateset)
		{
			$('#printkot').css("display","none");
		}else
		{
			if($('#printerstatus').val()=="Y")
			{
					//$('#printkot').css("display","block");
			}
		}
         ////cs///
         
         
        
         var dt=$('#datepicker').val();
	  var res = dt.split("-");
	  var dateset=res[2] +"-"+ res[1] +"-"+ res[0] ;
	  
	 var kotno= null;
	 var bilno= null;
	 var statuss= null;
	 var bilsts= null;
	 
	$('#statuss').find('option:first').attr('selected', 'selected');
	$('#bilsts').find('option:first').attr('selected', 'selected');
	 
	  var request = $.ajax({
			type: "POST",
			
                        url: "load_takothistory.php",
			data: "value=searchkothistory&dateval="+dateset+"&kotno="+kotno+"&bilno="+bilno+"&statuss="+statuss+"&mode=CS",
			success: function(msg)
			{
			
				$('#kotlisttotal_cs').html(msg);
				$('#loadkotdeatils').empty();
			    $('.confrmation_overlay_proce').css('display','none');
			}
		});  
	 data=null;
		response=null;
		request.onreadystatechange = null;
		request.abort = null;
		request = null;
		
		var dateval= $('#datehid').val();
		var res = dateval.split("-");
		var dateset=res[2] +"-"+ res[1] +"-"+ res[0] ;
	
		var dt= $('#datepicker').val();
		if(dt!=dateset)
		{
			$('#printkot').css("display","none");
		}else
		{
			if($('#printerstatus').val()=="Y")
			{
					//$('#printkot').css("display","block");
			}
		}
    }
    
    
    
    
    
    
    
    if(mode=='DI'){
         $('#kotlisttotal').show();
        $('#kotlisttotal_ta').hide();
         $('#kotlisttotal_cs').hide();
        
	 var dt=$('#datepicker').val();
	  var res = dt.split("-");
	  var dateset=res[2] +"-"+ res[1] +"-"+ res[0] ;
	  
		 var kotno= null;
	 var bilno= null;
	 var statuss= null;
	 var bilsts= null;
	 
	$('#statuss').find('option:first').attr('selected', 'selected');
	$('#bilsts').find('option:first').attr('selected', 'selected');
	 
	  var request = $.ajax({
			type: "POST",
			url: "load_kothistory.php",
			data: "value=searchkothistory&dateval="+dateset+"&kotno="+kotno+"&bilno="+bilno+"&statuss="+statuss+"&bilsts="+bilsts,
			success: function(msg)
			{
			//alert(msg);
				$('#kotlisttotal').html(msg);
				$('#loadkotdeatils').empty();
			    $('.confrmation_overlay_proce').css('display','none');
			}
		});  
	 data=null;
		response=null;
		request.onreadystatechange = null;
		request.abort = null;
		request = null;
		
		var dateval= $('#datehid').val();
		var res = dateval.split("-");
		var dateset=res[2] +"-"+ res[1] +"-"+ res[0] ;
	
		var dt= $('#datepicker').val();
		if(dt!=dateset)
		{
			$('#printkot').css("display","none");
		}else
		{
			if($('#printerstatus').val()=="Y")
			{
					$('#printkot').css("display","block");
			}
		}
                
        }  
         
         
     /////ta_hd//////
      if(mode=='TA'){
        
        $('#kotlisttotal').hide();
         $('#kotlisttotal_cs').hide();
      $('#kotlisttotal_ta').show();
     var dt=$('#datepicker').val();
	  var res = dt.split("-");
	  var dateset=res[2] +"-"+ res[1] +"-"+ res[0] ;
	  
		 var kotno= null;
	 var bilno= null;
	 var statuss= null;
	 var bilsts= null;
	 
	$('#statuss').find('option:first').attr('selected', 'selected');
	$('#bilsts').find('option:first').attr('selected', 'selected');
	 
	  var request = $.ajax({
			type: "POST",
			url: "load_takothistory.php",
			
                        
                        data: "value=searchkothistory&dateval="+dateset+"&kotno="+kotno+"&bilno="+bilno+"&statuss="+statuss+"&mode=TA",
			success: function(msg)
			{
			
				$('#kotlisttotal_ta').html(msg);
				$('#loadkotdeatils').empty();
			    $('.confrmation_overlay_proce').css('display','none');
			}
		});  
	 data=null;
		response=null;
		request.onreadystatechange = null;
		request.abort = null;
		request = null;
		
		var dateval= $('#datehid').val();
		var res = dateval.split("-");
		var dateset=res[2] +"-"+ res[1] +"-"+ res[0] ;
	
		var dt= $('#datepicker').val();
		if(dt!=dateset)
		{
			$('#printkot').css("display","none");
		}else
		{
			if($('#printerstatus').val()=="Y")
			{
					//$('#printkot').css("display","block");
			}
		}
         
         
        }
         
            //////counter_sale////
        if(mode=='CS'){
        
        $('#kotlisttotal').hide();
         $('#kotlisttotal_ta').hide();
          $('#kotlisttotal_cs').show();
         
        var dt=$('#datepicker').val();
	  var res = dt.split("-");
	  var dateset=res[2] +"-"+ res[1] +"-"+ res[0] ;
	  
	 var kotno= null;
	 var bilno= null;
	 var statuss= null;
	 var bilsts= null;
	 
	$('#statuss').find('option:first').attr('selected', 'selected');
	$('#bilsts').find('option:first').attr('selected', 'selected');
	 
	  var request = $.ajax({
			type: "POST",
			
                        url: "load_takothistory.php",
			data: "value=searchkothistory&dateval="+dateset+"&kotno="+kotno+"&bilno="+bilno+"&statuss="+statuss+"&mode=CS",
			success: function(msg)
			{
			
				$('#kotlisttotal_cs').html(msg);
				$('#loadkotdeatils').empty();
			    $('.confrmation_overlay_proce').css('display','none');
			}
		});  
	 data=null;
		response=null;
		request.onreadystatechange = null;
		request.abort = null;
		request = null;
		
		var dateval= $('#datehid').val();
		var res = dateval.split("-");
		var dateset=res[2] +"-"+ res[1] +"-"+ res[0] ;
	
		var dt= $('#datepicker').val();
		if(dt!=dateset)
		{
			$('#printkot').css("display","none");
		}else
		{
			if($('#printerstatus').val()=="Y")
			{
					//$('#printkot').css("display","block");
			}
		}
        
        }
}



function ta_reprint_kot(bill,kot){
   
     $('#kotcancel_reason_popup_new_proceed_btnbh_cs').attr('billnum',bill);
     $('#kotcancel_reason_popup_new_proceed_btnbh_cs').attr('kotno',kot);
     
        $('.kotcancel_reason_popup_reprint_cs').css('display','block');
                    $('.confrmation_overlay').css('display','block');
                    $('#pinbh').val('');  
                     $("#pinbh").focus();
                     
                 $('#mode_set').val('ta');       
             
}



function searchkot_history()
{
    
     $('#tot_kot').hide();
    var mode=$('#mode').val();
    
    
     if(mode=='ALL'){
        
         ///di////
         var dateval= $('#datepicker').val();
	var res = dateval.split("-");
	var dateset=res[2] +"-"+ res[1] +"-"+ res[0] ;
	 
	 var kotno= $('#kotno').val();
	 var bilno= $('#bilno').val();
	 var statuss= null;
	 var bilsts= null;
	 
	 if(kotno=="")
	 {
		 kotno=null;
	 }
	 if(bilno=="")
	 {
		 bilno=null;
	 }
	 if(statuss=="null")
	 {
		 statuss=null;
	 }
	 if(bilsts=="null")
	 {
		 bilsts=null;
	 }
	 
         
        
         
	  var request = $.ajax({
			type: "POST",
			url: "load_kothistory.php",
			data: "value=searchkothistory&dateval="+dateset+"&kotno="+kotno+"&bilno="+bilno+"&statuss="+statuss+"&bilsts="+bilsts,
			success: function(msg)
			{ 
                            
                            var dt=msg.split('dinedata');
                            
                           var check=dt[1].split('tested');
                           
                          
                            
                            
                            if($.trim(check[0])=='ok'){
			        $('#kotlisttotal').show();
				$('#kotlisttotal').html(msg);
                            }else{
                                $('#kotlisttotal').hide();
				$('#kotlisttotal').html('');
                            }
                                
				$('#loadkotdeatils').empty();
			   
			}
		});  
                
                
                
                
	 data=null;
		response=null;
		request.onreadystatechange = null;
		request.abort = null;
		request = null;
                
                
                
                
                //ta_hd_cs////
                
                
        $('#printkot').css("display","none");
        
        
        var dateval= $('#datepicker').val();
	var res = dateval.split("-");
	var dateset=res[2] +"-"+ res[1] +"-"+ res[0] ;
	 
	 var kotno= $('#kotno').val();
	 var bilno= $('#bilno').val();
	 var statuss= $('#statuss').val();
	 //var bilsts= $('#bilsts').val();
	 
	 if(kotno=="")
	 {
		 kotno=null;
	 }
	 if(bilno=="")
	 {
		 bilno=null;
	 }
	 if(statuss=="null")
	 {
		 statuss=null;
	 }
//	 if(bilsts=="null")
//	 {
//		 bilsts=null;
//	 }
	 
	  var request = $.ajax({
			type: "POST",
			url: "load_takothistory.php",
			data: "value=searchkothistory&dateval="+dateset+"&kotno="+kotno+"&bilno="+bilno+"&statuss="+statuss+"&mode=TA",
			success: function(msg)
			{
			
				
				$('#loadkotdeatils').empty();
                              
                              
			   
                           var dt=msg.split('dinedata');
                            
                           var check=dt[1].split('tested');
                           
                          
                            if($.trim(check[0])=='ok'){
			        $('#kotlisttotal_ta').show();
                                $('#kotlisttotal_ta').html(msg);
                            }else{
                                 $('#kotlisttotal_ta').hide();
                                $('#kotlisttotal_ta').html('');
                            }
                           
                           
                           
			}
		});  
	 data=null;
		response=null;
		request.onreadystatechange = null;
		request.abort = null;
		request = null;
                
         
         
         ///countersale////
         
         
         
         $('#printkot').css("display","none");
        
        
        var dateval= $('#datepicker').val();
	var res = dateval.split("-");
	var dateset=res[2] +"-"+ res[1] +"-"+ res[0] ;
	 
	 var kotno= $('#kotno').val();
	 var bilno= $('#bilno').val();
	 var statuss= $('#statuss').val();
	 //var bilsts= $('#bilsts').val();
	 
	 if(kotno=="")
	 {
		 kotno=null;
	 }
	 if(bilno=="")
	 {
		 bilno=null;
	 }
	 if(statuss=="null")
	 {
		 statuss=null;
	 }
//	 if(bilsts=="null")
//	 {
//		 bilsts=null;
//	 }
	 
	  var request = $.ajax({
			type: "POST",
			url: "load_takothistory.php",
			data: "value=searchkothistory&dateval="+dateset+"&kotno="+kotno+"&bilno="+bilno+"&statuss="+statuss+"&mode=CS",
			success: function(msg)
			{
			
				
				$('#loadkotdeatils').empty();
                               
                                 
                                 
                            var dt=msg.split('dinedata');
                            
                           var check=dt[1].split('tested');
                           
                          
                            if($.trim(check[0])=='ok'){
			        $('#kotlisttotal_cs').show();
                                $('#kotlisttotal_cs').html(msg);
                            }else{
                                  $('#kotlisttotal_cs').hide();
                                $('#kotlisttotal_cs').html('');
                            }
			   
                           
                           
			}
		});  
	 data=null;
		response=null;
		request.onreadystatechange = null;
		request.abort = null;
		request = null;
                
         
         
         
         
         
         
     }
    
    
    
    
    if(mode=='DI'){
	var dateval= $('#datepicker').val();
	var res = dateval.split("-");
	var dateset=res[2] +"-"+ res[1] +"-"+ res[0] ;
	 
	 var kotno= $('#kotno').val();
	 var bilno= $('#bilno').val();
	 var statuss= null;
	 var bilsts= null;
	 
	 if(kotno=="")
	 {
		 kotno=null;
	 }
	 if(bilno=="")
	 {
		 bilno=null;
	 }
	 if(statuss=="null")
	 {
		 statuss=null;
	 }
	 if(bilsts=="null")
	 {
		 bilsts=null;
	 }
	 
         
        
         
	  var request = $.ajax({
			type: "POST",
			url: "load_kothistory.php",
			data: "value=searchkothistory&dateval="+dateset+"&kotno="+kotno+"&bilno="+bilno+"&statuss="+statuss+"&bilsts="+bilsts,
			success: function(msg)
			{ //alert(msg);
			        $('#kotlisttotal').show();
				$('#kotlisttotal').html(msg);
                                
                                $('#kotlisttotal_ta').hide();
                                $('#kotlisttotal_cs').hide();
                                
				$('#loadkotdeatils').empty();
			   
			}
		});  
                
                
                
                
	 data=null;
		response=null;
		request.onreadystatechange = null;
		request.abort = null;
		request = null;
	 
    }
    
    
    if(mode=='TA' || mode=='CS'){
        
        
        $('#printkot').css("display","none");
        
        
        var dateval= $('#datepicker').val();
	var res = dateval.split("-");
	var dateset=res[2] +"-"+ res[1] +"-"+ res[0] ;
	 
	 var kotno= $('#kotno').val();
	 var bilno= $('#bilno').val();
	 var statuss= $('#statuss').val();
	 //var bilsts= $('#bilsts').val();
	 
	 if(kotno=="")
	 {
		 kotno=null;
	 }
	 if(bilno=="")
	 {
		 bilno=null;
	 }
	 if(statuss=="null")
	 {
		 statuss=null;
	 }
//	 if(bilsts=="null")
//	 {
//		 bilsts=null;
//	 }
	 
	  var request = $.ajax({
			type: "POST",
			url: "load_takothistory.php",
			data: "value=searchkothistory&dateval="+dateset+"&kotno="+kotno+"&bilno="+bilno+"&statuss="+statuss+"&mode="+mode,
			success: function(msg)
			{
			
				
				$('#loadkotdeatils').empty();
                                if(mode=='TA'){
                                $('#kotlisttotal_ta').show();
                                $('#kotlisttotal_ta').html(msg);
                                
                                $('#kotlisttotal_cs').hide();
                              
                                
                            }
                            
                            if(mode=='CS'){
                                  $('#kotlisttotal_cs').show();
                                $('#kotlisttotal_cs').html(msg);
                                  $('#kotlisttotal_ta').hide();
                            }
                                $('#kotlisttotal').hide();
			   
			}
		});  
	 data=null;
		response=null;
		request.onreadystatechange = null;
		request.abort = null;
		request = null;
    }
    
    
    
    
	 
}
</script> 
</head>

<body style="background: rgb(28, 37, 45) !important;">
    
    <div style="display:none" class="confrmation_overlay_proce"></div> 
    
    <div class="kotcancel_reason_popup_new kotcancel_reason_popup_reprint_cs" style="display:none">
    <input type="hidden" name="focusedtext" id="focusedtext" />
    
     <input type="hidden" name="mode_set" id="mode_set" />
     
 <div class="kotcancel_reason_popup_new_left_cc">
     <div class="kotcancel_reason_popup_new_head" style="color:gray;font-weight: bold"> KOT RE-PRINT AUTHORIZATION </div>
    <div class="kotcancel_reason_popup_new_textbox_contant">
    
        <div style="width: 100%;float: left;height: 20px;line-height: 10px;text-align: center"><span id="pin_errorbh" style="color:darkred;"></span></div>
        <div class="kotcancel_reason_popup_new_textbox_cc" style="margin-bottom:10px;">
            <input style="width:80%;float:left" type="password" class="kotcancel_reason_popup_new_textbox_input" placeholder="CODE" id="pinbh" onkeypress="pincheck(this.val)" autofocus="true" maxlength="4"/>
            <span style="height: 47px;" class="login_back_btn calculator_settle_back">&nbsp;</span>
        </div>
    </div>
    <div class="kotcancel_reason_popup_new_textbox_btn_cc">
        <a  href="#"><div style="background-color:darkred; " class="kotcancel_reason_popup_new_textbox_btn" id="kotcancel_reason_popup_new_cancel_btnbh_cs">EXIT</div></a>
    	<a href="#"><div style="background-color:darkred; " class="kotcancel_reason_popup_new_textbox_btn" id="kotcancel_reason_popup_new_proceed_btnbh_cs">GO</div></a>
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
  </div>
</div>
    
    
    
    
    
<div class="olddiv1 "></div>
<div class="container-fluid no-padding">
     <?php include"includes/topbar.php"; ?>
      <div class="middle_container">
      <div style="width:100%" class="top_site_map_cc ">
            	<!--<ul>
					<li><a href="bill_generation_screen1.php" title=""><span class="home_icon"></span>\</a></li>
					<li><a title="">Bill History</a></li>
				</ul>-->
                <!--<a href="payment_pending.php"><div class="bill_his_back_btn">Back</div></a>-->
               	
                 <?php include"includes/new_right_menu.php"; ?> 
                <div style="width:30% !important" class="bill_history_head">CONSOLIDATED KOT HISTORY </div>
                
                <a href="index.php"><div style="background-color: #845252; margin-left: 0.25%;" class="bill_his_back_btn"><?=$_SESSION['kot_history_back_button']?></div></a>
                 
                

                <div class="top_al_search_cc loaderror" ></div>
               <!-- <div class="top_al_search_cc">
                	 <span style="width: 80%;float: right;"><input class="search" placeholder="Search Code" name="search" type="text"></span>
                </div>-->
            </div>
                      
            
      		<div style="  min-height:480px;width:100%; margin-left: 3px;" class="left_contant_container">
            	
                <div class="left_bill_history_contain">
                    <div class="bill_number_head" style="height:auto">
					<div class="filter_con_his_dv" style="float:left;    width: 20%;">
					<span class="cons_his_txt">Date</span>
                    <?php
                    
					$datev=explode("-",$_SESSION['date']);
					$sesdate=$datev[2]."-".$datev[1]."-".$datev[0];
					?>
                    <input type="hidden" name="datehid" id="datehid" value="<?=$sesdate?>">
                    <input autocomplete="off" value="<?=$today?>" type="text" id="datepicker" name="datepicker" style="" readonly onChange="datechange()">
                   
                    
                  </div>
                            
					 <div class="filter_con_his_dv" style="float:left;    width: 20%;">
					 <span class="cons_his_txt">Mode : </span>
                       <select id="mode" style="" onchange="searchkot_history()">
                            
                           
                           <option value="DI">DI</option>
                           <option value="TA">TA-HD</option>
                          
                           <option value="CS">CS</option>
                           <option style="display:none" value="ALL">ALL</option>
                       </select>
                    
                  </div>       
                            
                            
                            
				   <div class="filter_con_his_dv" style="float:left;    width: 20%;">
				   	<span class="cons_his_txt"><?=$_SESSION['kot_history_kot']?> No :</span>
                       <input   type="text" id="kotno" name="kotno" style="" onkeyup="searchkot_history()">
                   
                    
                  </div>
				   <div class="filter_con_his_dv" style="float:left;    width: 35%;">
				   <span class="cons_his_txt"><?=$_SESSION['kot_history_bill']?> No :</span>
                   <input  type="text" id="bilno" name="bilno" style="" onkeyup="searchkot_history()">
                   
                    
                  </div>
                 
                   
                  
                   
                    
                    </div>
                    	<div class="kot_his_order_detail_head">
                        <table width="100%" class=" " border="0"> <!----bill_history_active--->
                        <thead>
                        <th  width="10%" style="color:#FFF;text-align:center;"> <?=$_SESSION['kot_history_slno']?></th>
                        <th  width="15%" style="color:#FFF;text-align:center;"> Time </th>
                        <th  width="15%" style="color:#FFF;text-align:center;"> <?=$_SESSION['kot_history_kot']?> </th>
                        <th  width="15%" style="color:#FFF;text-align:center;"> <?=$_SESSION['kot_history_bill_no']?> </th>
                        <th  width="10%" style="color:#FFF;text-align:center;"> <?=$_SESSION['kot_history_printed']?> </th>
                        <th  width="10%" style="color:#FFF;text-align:center;"> <?=$_SESSION['kot_history_status']?> </th>
                        </thead>
                        </table>
                        </div>
						<div class="bill_history_details_table_scroll">
                      <div class="bill_history_details_table" id="kotlisttotal">
                        
                          <span style="background-color: white;font-weight: bold;float: left;width: 100%;height: 30px">   DINE IN  
                              <?php
         $sql_bilhis="select distinct(ter_kotno),ter_status,ter_billnumber,ter_entrytime from tbl_tableorder WHERE ter_dayclosedate='".$_SESSION['date']."' AND ter_kotno<>'0' group by ter_kotno ORDER BY LPAD(lower(ter_kotno), 10,0) DESC";
                                                // echo "select distinct(ter_kotno),ter_status,ter_billnumber from tbl_tableorder WHERE $string AND ter_kotno<>'0' group by ter_kotno ORDER BY LPAD(lower(ter_kotno), 10,0) DESC";
						$sql_bilhistory  =  $database->mysqlQuery($sql_bilhis); 
						 $num_bilhistory  = $database->mysqlNumRows($sql_bilhistory);
						if($num_bilhistory)
						{$c=0; 
                                                while($result_bilhistory  = $database->mysqlFetchArray($sql_bilhistory)) { 
                                                    $c++;
                                                }} 
                                                ?>
          <strong style="float: right;margin-right: 5px;color: darkred"> KOT : <?=  $c?>      </strong>
          
         
      </span>     
                        
                		<table width="100%" class=" " border="0"> <!----bill_history_active--->
                       
                        <tbody>
                        <?php
						// `tbl_tableorder`(`ter_orderno`, `ter_slno`, `ter_branchid`, `ter_menuid`, `ter_portion`, `ter_rate`, `ter_qty`, `ter_status`, `ter_preference`, `ter_preferencetext`, `ter_orderfrom`, `ter_entrydate`, `ter_entrytime`, `ter_entryuser`, `ter_esttime`, `ter_staff`, `ter_type`, `ter_kotno`, `ter_billnumber`, `ter_feedbackrating`, `ter_feedbackremarks`, `ter_feedbackenter`, `ter_dayclosedate`, `ter_floorid`, `ter_cancel`) 
						// $sql_bilhis="select distinct(ter_kotno),ter_status,ter_billnumber ,ter_entrytime from tbl_tableorder WHERE ter_dayclosedate='".$_SESSION['date']."' AND ter_kotno<>'0' ORDER BY ter_dayclosedate,ter_entrytime DESC";
						 $sql_bilhis="select distinct(ter_kotno),ter_status,ter_billnumber,ter_entrytime from tbl_tableorder WHERE ter_dayclosedate='".$_SESSION['date']."' AND ter_kotno<>'0' group by ter_kotno ORDER BY LPAD(lower(ter_kotno), 10,0) DESC";
						 //echo "select distinct(ter_kotno),ter_status,ter_billnumber,ter_entrytime from tbl_tableorder WHERE ter_dayclosedate='".$_SESSION['date']."' AND ter_kotno<>'0' group by ter_kotno ORDER BY LPAD(lower(ter_kotno), 10,0) DESC";
                                                 $sql_bilhistory  =  $database->mysqlQuery($sql_bilhis); 
						$num_bilhistory  = $database->mysqlNumRows($sql_bilhistory);
						if($num_bilhistory)
						{$i=1;
							while($result_bilhistory  = $database->mysqlFetchArray($sql_bilhistory)) 
								{$name='';$status='';
									if(is_null($result_bilhistory['ter_billnumber']))
									{
										$name="Not Generated";
									}else
									{
										$name=$result_bilhistory['ter_billnumber'];
									}
									$print=$database->show_kotmaster_list($result_bilhistory['ter_kotno']);
									$sts='';
									if($print['kr_print']=='Y')
									{
										$sts=$_SESSION['kot_history_print_yes'];
									}else {
										$sts=$_SESSION['kot_history_print_no'];
									}
									
									if($result_bilhistory['ter_status']=="Closed")
									{$status=$_SESSION['status_msg_closed'];
									}else 
									if($result_bilhistory['ter_status']=="Cancelled")
									{$status=$_SESSION['status_msg_cancelled'];
									}else 
									if($result_bilhistory['ter_status']=="Billed")
									{$status=$_SESSION['status_msg_billed'];
									}
									?>
                          <tr class="kot_history_number kot_history_number_di <?php if($result_bilhistory['ter_status']=='N'){ ?> bill_history_cancel <?php } ?>" kotno="<?=$result_bilhistory['ter_kotno']?>" style="cursor:pointer" status="<?=$result_bilhistory['ter_status']?>" >
                            <td width="10%"><strong><?=$i++?></strong></td>
                            <td width="15%"><?=date("h:i:s",strtotime($result_bilhistory['ter_entrytime']))?></td>
                            <td width="15%"><strong><?=$result_bilhistory['ter_kotno']?></strong></td>
                            <td width="15%"><?=$name?></td>
                             <td width="10%"><?=$sts?></td>
                             <td width="10%"><?=$status?></td>
                           </tr>
                           <?php } } ?>
                           </tbody>
                         </table> 
              </div><!--bill_history_details_table---> 
                   
              
<!--              /////ta-hd/////-->
              
<div class="bill_history_details_table" id="kotlisttotal_ta" style="display:none">   
                    
                 <span style="background-color: white;font-weight: bold;float: left;width: 100%;height: 30px"> TAKEAWAY - HOME DELIVERY  
                     <?php
						
						 $sql_bilhis="select distinct(tab_kotno),tab_status,tab_billno,tab_time from tbl_takeaway_billmaster WHERE tab_dayclosedate='".$_SESSION['date']."'AND tab_mode!='CS' AND tab_kotno<>'0' ORDER BY LPAD(lower(tab_kotno), 10,0) DESC";
						//echo "select distinct(tab_kotno),tab_status,tab_billno from tbl_takeaway_billmaster WHERE $string AND tab_kotno<>'0' ORDER BY LPAD(lower(tab_kotno), 10,0) DESC";
                                                 $sql_bilhistory  =  $database->mysqlQuery($sql_bilhis); 
						 $num_bilhistory  = $database->mysqlNumRows($sql_bilhistory);
						if($num_bilhistory)
						{$c1=0;
							while($result_bilhistory  = $database->mysqlFetchArray($sql_bilhistory)) 
								{ $c1++;
                                                            
                                                            
                                                        }
                                                        }
     ?>
     <strong style="float: right;margin-right: 5px;color: darkred"> KOT : <?=$c1?>      </strong>
     </span>   
                		<table width="100%" class=" " border="0"> <!----bill_history_active--->
                       
                        <tbody>
                        <?php
                           
                        
                        
                        
						// `tbl_tableorder`(`ter_orderno`, `ter_slno`, `ter_branchid`, `ter_menuid`, `ter_portion`, `ter_rate`, `ter_qty`, `ter_status`, `ter_preference`, `ter_preferencetext`, `ter_orderfrom`, `ter_entrydate`, `ter_entrytime`, `ter_entryuser`, `ter_esttime`, `ter_staff`, `ter_type`, `ter_kotno`, `ter_billnumber`, `ter_feedbackrating`, `ter_feedbackremarks`, `ter_feedbackenter`, `ter_dayclosedate`, `ter_floorid`, `ter_cancel`) 
						// $sql_bilhis="select distinct(ter_kotno),ter_status,ter_billnumber ,ter_entrytime from tbl_tableorder WHERE ter_dayclosedate='".$_SESSION['date']."' AND ter_kotno<>'0' ORDER BY ter_dayclosedate,ter_entrytime DESC";
						 $sql_bilhis="select distinct(tab_kotno),tab_status,tab_billno,tab_time from tbl_takeaway_billmaster WHERE tab_dayclosedate='".$_SESSION['date']."'AND tab_mode!='CS' AND tab_kotno<>'0' ORDER BY LPAD(lower(tab_kotno), 10,0) DESC";
						//echo "select distinct(tab_kotno),tab_status,tab_billno from tbl_takeaway_billmaster WHERE tab_dayclosedate='".$_SESSION['date']."'AND tab_mode!='CS' AND tab_kotno<>'0' ORDER BY LPAD(lower(tab_kotno), 10,0) DESC";
                                                 $sql_bilhistory  =  $database->mysqlQuery($sql_bilhis); 
						$num_bilhistory  = $database->mysqlNumRows($sql_bilhistory);
						if($num_bilhistory)
						{$i=1;
							while($result_bilhistory  = $database->mysqlFetchArray($sql_bilhistory)) 
								{$name='';$status='';
                                                                        $status=$result_bilhistory['tab_status'];
									if(is_null($result_bilhistory['tab_billno']))
									{
										$name="Not Generated";
									}else
									{
										$name=$result_bilhistory['tab_billno'];
									}
									$print=$database->show_kotmaster_list($result_bilhistory['tab_kotno']);
									$sts='';
									if($print['kr_print']=='Y')
									{
										$sts=$_SESSION['kot_history_print_yes'];
									}else {
										$sts=$_SESSION['kot_history_print_no'];
									}
									
//									if($result_bilhistory['tab_status']=="Closed")
//									{$status=$_SESSION['status_msg_closed'];
//									}else 
//									if($result_bilhistory['tab_status']=="Cancelled")
//									{$status=$_SESSION['status_msg_cancelled'];
//									}else 
//									if($result_bilhistory['tab_status']=="Billed")
//									{$status=$_SESSION['status_msg_billed'];
//									}
									?>
                          <tr class="kot_history_number kot_history_number_ta_hd_cs"  billno="<?=$result_bilhistory['tab_billno']?>" kotno="<?=$result_bilhistory['tab_kotno']?>" style="cursor:pointer" status="<?=$result_bilhistory['tab_status']?>" >
                            <td width="10%"><strong><?=$i++?></strong></td>
                            <td width="15%"><?=date("h:i:s",strtotime($result_bilhistory['tab_time']))?></td>
                            <td width="15%"><strong><?=$result_bilhistory['tab_kotno']?></strong></td>
                            <td width="15%"><?=$name?></td>
                             <td width="10%"><?=$sts?></td>
                             <td width="10%"><?=$status?></td>
                           </tr>
                           <?php } } ?>
                           
                        <input type="hidden" value="<?=$kot_reprint_staff?>" id="reprint_per" >
                         <input type="hidden" value="<?=$kot_reprint_pin?>" id="reprint_code" >
                        
                           </tbody>
                         </table> 
              </div>
              

<!--/////cs///////-->
              
              
              
      <div class="bill_history_details_table" id="kotlisttotal_cs" style="display:none">    
          
          <span style="background-color: white;font-weight: bold;float: left;width: 100%;height: 30px"> COUNTER SALE 
               <?php
						
						 $sql_bilhis="select distinct(tab_kotno),tab_status,tab_billno,tab_time from tbl_takeaway_billmaster WHERE tab_dayclosedate='".$_SESSION['date']."'AND tab_mode='CS' AND tab_kotno<>'0' ORDER BY LPAD(lower(tab_kotno), 10,0) DESC";
						//echo "select distinct(tab_kotno),tab_status,tab_billno from tbl_takeaway_billmaster WHERE $string AND tab_kotno<>'0' ORDER BY LPAD(lower(tab_kotno), 10,0) DESC";
                                                 $sql_bilhistory  =  $database->mysqlQuery($sql_bilhis); 
						 $num_bilhistory  = $database->mysqlNumRows($sql_bilhistory);
						if($num_bilhistory)
						{$c12=0;
							while($result_bilhistory  = $database->mysqlFetchArray($sql_bilhistory)) 
								{ $c12++;
                                                            
                                                            
                                                        }
                                                        }
     ?>
     <strong style="float: right;margin-right: 5px;color: darkred"> KOT : <?=$c12?>      </strong>
     </span>   
                		<table width="100%" class=" " border="0"> <!----bill_history_active--->
                       
                        <tbody>
                        <?php
                        
                        
                        
                        
                        
						// `tbl_tableorder`(`ter_orderno`, `ter_slno`, `ter_branchid`, `ter_menuid`, `ter_portion`, `ter_rate`, `ter_qty`, `ter_status`, `ter_preference`, `ter_preferencetext`, `ter_orderfrom`, `ter_entrydate`, `ter_entrytime`, `ter_entryuser`, `ter_esttime`, `ter_staff`, `ter_type`, `ter_kotno`, `ter_billnumber`, `ter_feedbackrating`, `ter_feedbackremarks`, `ter_feedbackenter`, `ter_dayclosedate`, `ter_floorid`, `ter_cancel`) 
						// $sql_bilhis="select distinct(ter_kotno),ter_status,ter_billnumber ,ter_entrytime from tbl_tableorder WHERE ter_dayclosedate='".$_SESSION['date']."' AND ter_kotno<>'0' ORDER BY ter_dayclosedate,ter_entrytime DESC";
						 $sql_bilhis="select distinct(tab_kotno),tab_status,tab_billno,tab_time from tbl_takeaway_billmaster WHERE tab_dayclosedate='".$_SESSION['date']."'AND tab_mode='CS' AND tab_kotno<>'0' ORDER BY LPAD(lower(tab_kotno), 10,0) DESC";
						//echo "select distinct(tab_kotno),tab_status,tab_billno from tbl_takeaway_billmaster WHERE tab_dayclosedate='".$_SESSION['date']."'AND tab_mode='CS' AND tab_kotno<>'0' ORDER BY LPAD(lower(tab_kotno), 10,0) DESC";
                                                 $sql_bilhistory  =  $database->mysqlQuery($sql_bilhis); 
						$num_bilhistory  = $database->mysqlNumRows($sql_bilhistory);
						if($num_bilhistory)
						{$i=1;
							while($result_bilhistory  = $database->mysqlFetchArray($sql_bilhistory)) 
								{$name='';$status='';
                                                                 $status=$result_bilhistory['tab_status'];
									if(is_null($result_bilhistory['tab_billno']))
									{
										$name="Not Generated";
									}else
									{
										$name=$result_bilhistory['tab_billno'];
									}
									$print=$database->show_kotmaster_list($result_bilhistory['tab_kotno']);
									$sts='';
									if($print['kr_print']=='Y')
									{
										$sts=$_SESSION['kot_history_print_yes'];
									}else {
										$sts=$_SESSION['kot_history_print_no'];
									}
									
//									if($result_bilhistory['tab_status']=="Closed")
//									{$status=$_SESSION['status_msg_closed'];
//									}else 
//									if($result_bilhistory['tab_status']=="Cancelled")
//									{$status=$_SESSION['status_msg_cancelled'];
//									}else 
//									if($result_bilhistory['tab_status']=="Billed")
//									{$status=$_SESSION['status_msg_billed'];
//									}
									?>
                          <tr class="kot_history_number kot_history_number_ta_hd_cs" billno="<?=$result_bilhistory['tab_billno']?>" kotno="<?=$result_bilhistory['tab_kotno']?>" style="cursor:pointer" status="<?=$result_bilhistory['tab_status']?>" >
                            <td width="10%"><strong><?=$i++?></strong></td>
                            <td width="15%"><?=date("h:i:s",strtotime($result_bilhistory['tab_time']))?></td>
                            <td width="15%"><strong><?=$result_bilhistory['tab_kotno']?></strong></td>
                            <td width="15%"><?=$name?></td>
                             <td width="10%"><?=$sts?></td>
                             <td width="10%"><?=$status?></td>
                           </tr>
                           <?php } } ?>
                             <input type="hidden" value="<?=$kot_reprint_staff?>" id="reprint_per" >
                               <input type="hidden" value="<?=$kot_reprint_pin?>" id="reprint_code" >
                               
                           </tbody>
                         </table> 
        
              </div>    
               
              
              </div>
    <Strong id='tot_kot' style="color:white;float: right;margin-right: 10px;color: whitesmoke;margin-top: 8px">  TOTAL KOT : <?=$c+$c1+$c12?> </Strong>




                </div>
                
                
                
      <div class="bill_history_right_detail">
                	
          <div class="bill_number_head">ITEM DETAILS &nbsp;&nbsp;<span style="color:red"> : CAN'T REPRINT PREVIOUS DAY'S KOT </span>
                        
                        
          </div>
                      		
                            
                 
                        
          <div style="height: auto;max-height: 400px;min-height: auto " class="bill_history_orderd_cont" id="loadkotdeatils">
           
         
                        
          </div>
                    
              <div  class="bill_his_buton_cc" style="display:block;width: 240px;float: right;position: static;border:0">
                  
                 <?php   if($_SESSION['date']==date('Y-m-d')) { ?>
                  <div style="position: static;float:right;    background-color: #993300;margin-top: 10px;height:35px;display: none;background-image: none;font-weight: bold " class="bill_cancel_btn" id="printkot"><a href="#"></a>RE-PRINT</div>
                      
                 <?php }?>
                  
                  
                      <?php if($_SESSION['s_printst']=="Y" && $_SESSION['s_kotrefresh']=='Y') { ?>
                        <div style="position: static;right:2%;left:inherit;background-image:url(img/update.png)" class="bill_cancel_btn" id="refreshkot"><a href="#"><?=$_SESSION['kot_history_refresh']?></a></div>
                        <?php }?>
                    </div><!--bill_his_buton_cc-->
                    
                </div><!--bill_history_right_detail-->
                
            </div><!--left_contant_container-->
            
      <input type="hidden" name="printerstatus"  id="printerstatus"  value="<?=$_SESSION['s_printst']?>">
      <input type="hidden" name="hidkotprinted"  id="hidkotprinted"  value="<?=$_SESSION['kot_history_kot_printed']?>">  
        
      </div><!--middle_container-->          
      </div><!--container_fluide-->


        <!----dock----> 
        <?php //include "includes/top_main_menu.php";?>
        <!----dock----> 


    <!-- ************** manage popup starts *************** -->
    
     <div style="position:fixed;width:100%;left:30%;top:7%;z-index:99999;" class="mynewpopupload1"  ></div>
    
    <!--******************* manage popup ends **************** -->  

 <div style="display:none;height: auto;bottom: auto;top: 30%;width:350px;" class="index_popup_1 closeoneclass">
  <h3 class="sm_pop_head">Message</h3>
 	<div class="index_popup_contant">Are you sure you want to cancel this Bill?</div>
    <div style="height:40px;" class="index_popup_contant">
    	<div  style="width: 20%;"  class="btn_index_popup"><a href="#" class="closeok">Yes</a></div>
        <div  style="width: 20%;" class="btn_index_popup"><a href="#" class="closecancel">No</a></div>
    </div>
 </div>
 
 
 <div style="display:none" class="confrmation_overlay"></div>
 
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

 <script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
 <!-- library for cookie management -->
 <script src="js/jquery.cookie.js"></script> 
</body>

</html>