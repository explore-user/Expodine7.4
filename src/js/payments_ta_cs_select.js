// JavaScript Document
$(document).ready(function(){
	
	
	/*************************************  floor selection starts **********************************************************  */
	
	 $('.clickeachrowpaymnt_ta').click(function () {
		 
	//alert("f");
		 /*if($(this).hasClass('tr_bill_gen_active'))
		 {
			 $('#billdetails').load("load_paymentpending.php?set=loadbilldetails_total");
			 $('.paymentclose').css("display","none");
			 $('.paid_amount_cc').css("display","none");	
			var id_str       =  $(this).attr("billno");
			$('.clickeachrowpaymnt').filter('[billno="'+id_str+'"]').removeClass('tr_bill_gen_active');
		 }else
		 {
			 $('#billdetails').load("load_paymentpending.php?set=loadbilldetails_total");
			 $('.paymentclose').css("display","none");	
			 $('.paid_amount_cc').css("display","none");
			  var id_str       =  $(this).attr("billno");
			  $('.clickeachrowpaymnt').removeClass('tr_bill_gen_active');
			  
			  $('.clickeachrowpaymnt').filter('[billno="'+id_str+'"]').addClass('tr_bill_gen_active');
						
		 }*/
		 if($(this).hasClass('tr_bill_gen_active'))
		 {
			 $('#billdetails').load("load_payments_ta_cs.php?set=loadbilldetails_total");
			 //$('#payemntmode_sel').find('option:first').attr('selected', 'selected');
			 $('#payemntmode_sel option').first().prop('selected', true);
			 $('.paymentclose').css("display","none");
			 $('.paid_amount_cc').css("display","none");
			 $('.paid_amount_cc_credit').css("display","none");
			// $('#paidamount_credit').css("display","none");
			 // $('#balanceamout_credit').css("display","none");	
			//var id_str       =  $(this).attr("billno");
			//$('.clickeachrowpaymnt').filter('[billno="'+id_str+'"]').removeClass('tr_bill_gen_active');
			$(".cash_cc").hide();
			$(".credit_cc_normal").hide();
			$(".credit_cc").hide();
			$(".coupon_cc").hide();
			$(".voucher_cc").hide();
			$(".cheque_cc").hide();
			$(".auto1").hide();
			$(".auto").hide();
			$('#amount_credit').val('');
			$('#selectcreditypes').find('option:first').attr('selected', 'selected');
			$('#selectcreditdetails').find('option:first').attr('selected', 'selected');
			//$('#payemntmode_sel').find('option:first').attr('selected', 'selected');
		 }else
		 {
			 $('#billdetails').load("load_payments_ta_cs.php?set=loadbilldetails_total");
			// $('#payemntmode_sel').find('option:first').attr('selected', 'selected');
			$('#payemntmode_sel option').first().prop('selected', true);
			 $('.paymentclose').css("display","none");	
			 $('.paid_amount_cc').css("display","none");
			 $('.paid_amount_cc_credit').css("display","none");
			  var id_str       =  $(this).attr("billno");
			  $('.clickeachrowpaymnt_ta').removeClass('tr_bill_gen_active');//alert(id_str);
			  $('.clickeachrowpaymnt_ta').filter('[billno="'+id_str+'"]').addClass('tr_bill_gen_active');
			  
			   var regn       =  $(this).attr("regen");
			   if(regn=='N')
			   {
				   $('.regenratethetables').css("display","none");	
				    $('.bilsplitthetables').css("display","none");	
			   }else
			   {
				   $('.regenratethetables').css("display","block");	
				   if($('#namesplitview').val()=="Y")
				   {
				    $('.bilsplitthetables').css("display","block");	
				   }
			   }
			  $(".cash_cc").hide();
			  $(".credit_cc_normal").hide();
			  $(".credit_cc").hide();
			  $(".coupon_cc").hide();
			  $(".voucher_cc").hide();
			  $(".cheque_cc").hide();
			  $(".auto1").hide();
			  $(".auto").hide();
			  $('#amount_credit').val('');
			  $('#selectcreditypes').find('option:first').attr('selected', 'selected');
			$('#selectcreditdetails').find('option:first').attr('selected', 'selected');
			
			 // $('#paidamount_credit').css("display","none");
			 // $('#balanceamout_credit').css("display","none");
						
		 }
		
	    
	});
			  
	/***************************************  floor selection ends **********************************************************  */
	
	
	
	}); 