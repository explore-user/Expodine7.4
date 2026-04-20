// JavaScript Document
$(document).ready(function(){

	/*************************************  floor selection starts **********************************************************  */
	$('#typesele').change(function (event) {	
	event.stopImmediatePropagation(); 
			  var modeval=	$(this).val();
			  $('#billdetails').load("load_paymentpending.php?set=loadbilldetails_total");
			 $('.paymentclose').css("display","none");
			 $('.paid_amount_cc').css("display","none");
			  $('#loadtotalrate').text('');
			  $('#grandtotal').text('');  
			  $('.closetranscations').css("display","none");
			 $('.closetranscations_whole').css("display","none");
			 
			 $('#coupbal').val("");
			 $('#vouchbal').val("");
			 $('#coupamount').val(""); 
			 $('#vouchid').val("");
			 $('#vocamount').val(""); 
			  $('#paidamount').val("0");
			   $('#balanceamout').val("0");
			   $('#cheqamount').val("");
			  $('#cheqname').val("");
			  $('#cheqbank').val("");
			  $('#cheqbal').val("");
			   
			   
			   
			   $(".cash_cc").hide();
                    $(".credit_cc").hide();
					$(".credit_cc_normal").hide();
                    $(".coupon_cc").hide();
					$(".voucher_cc").hide();
					$(".cheque_cc").hide();
					$(".auto1").hide();
					$(".auto").hide();
					
			 
			
			 $('#load_billfullist').html('<img src="img/ajax-loaders/ajax-loader-6.gif" />');
			  $.post("load_payments_ta_cs.php", {modeval:modeval,set:'loadta_billdetails'},
				  function(data)
				  {
				  $('#load_billfullist').html(data);
				   $('.loadallhead').load("load_payments_ta_cs.php?set=loadtablehead");		  
				  });
	});
			  
	/***************************************  floor selection ends **********************************************************  */
	/*************************************  verify starts **********************************************************  */
	
	 $('.settlethetables').click(function (event) {
          
		 event.stopImmediatePropagation(); 
		if($('.clickeachrowpaymnt_ta').hasClass('tr_bill_gen_active') )
		{
		 var selected_activities =$('.tr_bill_gen_active');
			 var billno = new Array(); 
			 // var tableid = new Array();
			  // var prefid = new Array();
			 selected_activities.each(function(){
			  var id_str       =  $(this).attr("billno");
				  if(id_str!='undefined' && id_str!='' && id_str!=null){
					  billno.push(id_str);
				  }
			/* var table       =  $(this).attr("table_id");
				  if(table!='undefined' && table!='' && table!=null){
					  tableid.push(table);
				  }
		     var pf       =  $(this).attr("pref");
				  if(pf!='undefined' && pf!='' && pf!=null){
					  prefid.push(pf);
				  }*/	  
			}); 
			$('#billdetails').load("load_payments_ta_cs.php?set=loadbilldetails_total&billno="+billno);	
			
			$('.paid_amount_cc_credit').css("display","none");
			$('#completext').val('');	    
			$('#paidamount').val('');
			$('#paidamount').focus();
			$('#balanceamout').val('');
			$('#paidamount_credit').val('');
			$('#balanceamout_credit').val('');
			
			
			$('#transcationid').val('');
			$('#transbal').val('');
			$('#bankdetails').find('option:first').attr('selected', 'selected');
			$('#payemntmode_sel').find('option:first').attr('selected', 'selected');
			$('#menu05').find('option:first').attr('selected', 'selected');
			$('#coupamount').val('');
			$('#coupbal').val('');
			$('.closetranscations').css("display","block");
			$('.credit_cc_normal').css("display","none");
			
			$('.paymentclose').css("display","block");
			$('.paid_amount_cc').css("display","block");
			//$('#payemntmode_sel').find('option:first').attr('selected', 'selected');
			var dataString; 
						  dataString = 'set=checkcashdrawersettings';
						   $.ajax({
						  type: "POST",
						  url: "load_payment_ta_cs.php",
						  data: dataString,
						  success: function(data4) {
							  data4=data4.trim();
							  if(data4=="Y")
							  {
								var dataString; 
									  dataString = 'set=drawer_open';
									   $.ajax({
									  type: "POST",
									  url: "cashdrawer_details.php",
									  data: dataString,
									  success: function(data3) {//alert("ok");
										  data3=data3.trim();//alert(data3);
										  /*if(data2=="ok")
										  {
											
									  
										  }*/
										  
										  }
									  });
						  
							  }
							  
							  }
						  });
		 var dataString; 
			dataString = 'set=drawer_open';
			$.ajax({
                            type: "POST",
                            url: "cashdrawer_details.php",
                            data: dataString,
                            success: function(data3) {//alert("ok");
                                data3=data3.trim();
                            }
			});
		}else
		{var selbil=$('#hidselbiltopr').val();
			$(".error_feed").css("display","block");
			$(".error_feed").addClass("billgenration_validate");
			$(".error_feed").text(selbil);
			$(".error_feed").delay(2000).fadeOut('slow');
		}
                
	});
			  
	/***************************************  verify ends **********************************************************  */
	
	/*************************************  reprint starts **********************************************************  */
	
	 $('.repreintthetables_ta').click(function (event) {//alert("h");
		if($('.clickeachrowpaymnt_ta').hasClass('tr_bill_gen_active') )
		{
		 var selected_activities =$('.tr_bill_gen_active');
			 var billno = new Array();
			 var kotid=new Array(); 
			 // var tableid = new Array();
			  // var prefid = new Array();
			 selected_activities.each(function(){
			  var id_str       =  $(this).attr("billno");
				  if(id_str!='undefined' && id_str!='' && id_str!=null){
					  billno.push(id_str);
				  }
			 var kot       =  $(this).attr("kotno");
				  if(kot!='undefined' && kot!='' && kot!=null){
					  kotid.push(kot);
				  }
		       
			}); 
			var paymentmsg2=$('#paymentmsg2').val();
			
			var dataString; 
		  dataString = 'value=ta_billprint&bypass=y&bilno='+billno;
		   $.ajax({
		  type: "POST",
		  url: "print_details_kot.php",
		  data: dataString,
		  success: function(data2) {//alert("b");
			  data2=data2.trim();
			 $(".error_feed").css("display","block");
			$(".error_feed").addClass("billgenration_validate");
			$(".error_feed").text(paymentmsg2);
			$(".error_feed").delay(2000).fadeOut('slow');
				  }
			  });
			
			/*var dataString;
		dataString = 'value=ta_kotprint&bilno='+billno+'&kotno='+kotid;
					 $.ajax({
					type: "POST",
					url: "print_details_kot.php",
					data: dataString,
					success: function(data) {
						 var dataString; 
								  dataString = 'value=console_ta&bilno='+billno+'&kotno='+kotid;
							   $.ajax({
							  type: "POST",
							  url: "print_details_kot.php",
							  data: dataString,
							  success: function(data1) {
							  }
							  });
						
						$(".error_feed").css("display","block");
			$(".error_feed").addClass("billgenration_validate");
			$(".error_feed").text(paymentmsg2);
			$(".error_feed").delay(2000).fadeOut('slow');
						}
					});	*/
		
	  return false;
			
			
	
	}else
		{var selbil=$('#hidselbiltopr').val();
			$(".error_feed").css("display","block");
			$(".error_feed").addClass("billgenration_validate");
			$(".error_feed").text(selbil);
			$(".error_feed").delay(2000).fadeOut('slow');
		}
	});
	/*************************************  reprint ends **********************************************************  */
	/*****************************************  voucher starts ******************************************************************  */
	 $('#vouchid').change(function () {
		  var vcid="";
		  vcid=($('#vouchid').val());
		   $.post("load_bill.php", {vcid:vcid,set:'voucherchek'},
			function(data)
			{
			data=$.trim(data);
			if(data=="sorry")
			{var voucher_not=$("#hidvoucher_not").val();
				$(".payment_pend_right_cash_error").css("display","block");
				$(".payment_pend_right_cash_error").addClass("popup_validate");
				$(".payment_pend_right_cash_error").text(voucher_not);
				$('.payment_pend_right_cash_error').delay(2000).fadeOut('slow');
				
			}else 
			{var voucher_ok=$("#hidvoucher_ok").val();
				$(".payment_pend_right_cash_error").css("display","block");
				$(".payment_pend_right_cash_error").addClass("popup_validate");
				$(".payment_pend_right_cash_error").text(voucher_ok);
				$('.payment_pend_right_cash_error').delay(2000).fadeOut('slow');
				//$(".popup_validate").css("color","green");
				var vv=parseFloat(data);
				$('#vocamount').val(vv);
				var grand=$('#grandtotal').text();
				 var bal=parseFloat(grand.replace(/,/g, "")) -  parseFloat(data.replace(/,/g, ""));
				 $('#vouchbal').val(bal.toFixed(2));
			}
			});
		});
	/*****************************************  voucher ends ******************************************************************  */
	/****************************************  balance change submit  starts ******************************************************************  */
	 $('#balanceamout').keypress(function () {
		if(event.keyCode == 13)//////alt+Enter(popup submit regeratebill)///////
                {
                   $('.closetranscations').click();
                }
	});
                 
	/*****************************************  balance change submit ends ******************************************************************  */
	
	
	 /*****************************************  close bill starts ******************************************************************  */
	 $('.closetranscations').click(function () {
           
		
		
		var payemntmode_sel =$('#payemntmode_sel').val();//alert(payemntmode_sel);
                
		if(payemntmode_sel!='')
		{
		
		  var pd=$('#paidamount').val();
		  
		  var selct=$('#payemntmode_sel').val();
		  
		  
		   var selected_activities =$('.tr_bill_gen_active');
		   var billno = new Array(); 
			var tableid = new Array();
			 var prefid = new Array();
		   selected_activities.each(function(){
			var id_str       =  $(this).attr("billno");
				if(id_str!='undefined' && id_str!='' && id_str!=null){
					billno.push(id_str);
				}
		  }); 
		  billno=unique(billno)
		  $.post("load_paymentpending.php", {bilno:billno[0],set:'setbillnotopay'},
		  function(data)
		  {
		  data=$.trim(data);
		 
		  });
		  var typenam=$("#payemntmode_sel").find('option:selected').attr('idval');
		  if(pd!="")
		  {// && IsNumeric(pd)
			 // if(isFloat(pd) || (selct=="credit" && (pd==0 || pd>0)))
			 if(isFloat(pd))
						{ 
		  if(selct=="cash")
		  {
            
			  var paid=$('#paidamount').val();
			  var bal=$('#balanceamout').val();
			  
			   var grand=$('#grandtotal').text();
			  
			var paidamtt=  parseFloat(paid.replace(/,/g, ""));
				  var grandam=parseFloat(grand.replace(/,/g, ""));
			  if(paid==0 )
			  {
			  var entremt=$("#hidentramt").val();
				  $(".payment_pend_right_cash_error").css("display","block");
				  $(".payment_pend_right_cash_error").addClass("popup_validate");
				  $(".payment_pend_right_cash_error").text(entremt);
				  $('.payment_pend_right_cash_error').delay(2000).fadeOut('slow');
			  }
			  
			  else if(paidamtt < grandam )
			  {
				   var insufamt=$("#hidinsufamt").val();
				  
				   $(".payment_pend_right_cash_error").css("display","block");
				  $(".payment_pend_right_cash_error").addClass("popup_validate");
				  $(".payment_pend_right_cash_error").text(insufamt);
				  $('.payment_pend_right_cash_error').delay(2000).fadeOut('slow');
				  
				  
				  
			  }
			  
			  
			  
			  
			 
			  else
			  {
			 var data = {
				 	"set"		: "bill_settle_ta",
					"type"		: selct,
					"billno" 	: billno[0],
					"typenam"	: typenam,
					"paid"		: paid,
					"bal" 		: bal
				  };
			  }
				  
		  }else  if(selct=="credit")
		  {
			  var trans=$('#transcationid').val();
			  var bankdetails=$('#bankdetails').val();
			  var grand=$('#grandtotal').text();
			   
			    var paid=$('#paidamount').val();
			
			   var transbal=$('#transbal').val();
			
				
				  
				  

/*var c = (transbal > paid) ?transbal: paid;
	alert(c);*/			  
				var transbalam=  parseFloat(transbal.replace(/,/g, ""));
				  var paidam=parseFloat(paid.replace(/,/g, ""));
				  
				  /*var c = (transbalam > paidam) ?transbalam: paidam;
				  
			 alert(c);*///alert(trans + grand)
			 if(trans!=grand && paidam<transbalam )
			 {
			   /* if(paidam<transbalam )
			  {*/
			  var insufamt=$("#hidinsufamt").val();
				    $(".payment_pend_right_cash_error").css("display","block");
				  $(".payment_pend_right_cash_error").addClass("popup_validate");
				  $(".payment_pend_right_cash_error").text(insufamt);
				  $('.payment_pend_right_cash_error').delay(2000).fadeOut('slow');
			  //}
			  
			 }else
			  {
                              
                              
                              
			   if(trans<=grand)
			  {
			  if(trans!="" && bankdetails!='')
			   {
					var paid=$('#paidamount').val();
					var bal=$('#balanceamout').val();
					var transbal=$('#transbal').val();
					if(transbal=='0.00' && bal=='0')
					{
					   var data = {
							 "set"		: "bill_settle_ta",
							  "type"		: selct,
							  "billno" 	: billno[0],
							  "typenam"	: typenam,
							  "trans" :trans,
							  "bank" :bankdetails,
							  "paid": paid,
							  "bal" : bal
							};
					}else if(transbal!='0.00' && bal!='0')
					{
						var data = {
							  "set"		: "bill_settle_ta",
							  "type"		: selct,
							  "billno" 	: billno[0],
							  "typenam"	: typenam,
							  "trans" :trans,
							  "bank" :bankdetails,
							  "paid": paid,
							  "bal" : bal
							};
					}else if((transbal<'0') && bal=='0')
						  {
							  var data = {
							  "set"		: "bill_settle_ta",
							  "type"		: selct,
							  "billno" 	: billno[0],
							  "typenam"	: typenam,
							  "trans" :trans,
							  "bank" :bankdetails,
							  "paid": paid,
							  "bal" : bal
							};
						  }
					else
					{
						 var insufamt=$("#hidinsufamt").val();
						 $(".payment_pend_right_cash_error").css("display","block");
						 $(".payment_pend_right_cash_error").addClass("popup_validate");
						 $(".payment_pend_right_cash_error").text(insufamt);
						 $('.payment_pend_right_cash_error').delay(2000).fadeOut('slow');
					}
				 }else
				 {
				 var entertrnsdt=$("#hidentertrnsdt").val();
					 $(".payment_pend_right_cash_error").css("display","block");
					 $(".payment_pend_right_cash_error").addClass("popup_validate");
				     $(".payment_pend_right_cash_error").text(entertrnsdt);
				     $('.payment_pend_right_cash_error').delay(2000).fadeOut('slow');
				 }
			  }else
			  {
			  var chktrnsdt=$("#hidchktrnsdt").val();
				  $(".payment_pend_right_cash_error").css("display","block");
					 $(".payment_pend_right_cash_error").addClass("popup_validate");
				     $(".payment_pend_right_cash_error").text(chktrnsdt);
				     $('.payment_pend_right_cash_error').delay(2000).fadeOut('slow');
			  }
			  
			  
		  }
		  
		  
		  
		  
		  
		  }else if(selct=="coupon")
		  {
			  var coup=$('#menu05').val();
			  if(coup!="")
			   {
					var coupamnt=$('#coupamount').val();
					if(coupamnt!="")
			   		{
						  var coupbal=$('#coupbal').val();
						  var paid=$('#paidamount').val();
						  var bal=$('#balanceamout').val();
						  var coupbalam=  parseFloat(coupbal.replace(/,/g, ""));
				  var paidamts=parseFloat(paid.replace(/,/g, ""));
				  
						  if(coupbalam >paidamts )
						  
						  
						  {var insufamt=$("#hidinsufamt").val();
							     $(".payment_pend_right_cash_error").css("display","block");
							   $(".payment_pend_right_cash_error").addClass("popup_validate");
							   $(".payment_pend_right_cash_error").text(insufamt);
							   $('.payment_pend_right_cash_error').delay(2000).fadeOut('slow');
							  
						  }
					else
					{
						
						  if(coupbal=='0.00' && bal=='0')
						  {
								var data = {
									  "set"		: "bill_settle_ta",
									  "type"		: selct,
									  "billno" 	: billno[0],
									  "typenam"	: typenam,
									  "coup" :coup,
									  "coupamnt": coupamnt,
									  "coupbal" : coupbal,
									  "paid": paid,
									  "bal" : bal
									};
						  }else if(coupbal!='0.00' && bal!='0')
						  {
							   var data = {
									  "set"		: "bill_settle_ta",
									  "type"		: selct,
									  "billno" 	: billno[0],
									  "typenam"	: typenam,
									  "coup" :coup,
									  "coupamnt": coupamnt,
									  "coupbal" : coupbal,
									  "paid": paid,
									  "bal" : bal
									};
						  }else if((coupbal<'0') && bal=='0')
						  {
							   var data = {
									  "set"		: "bill_settle_ta",
									  "type"		: selct,
									  "billno" 	: billno[0],
									  "typenam"	: typenam,
									  "coup" :coup,
									  "coupamnt": coupamnt,
									  "coupbal" : coupbal,
									  "paid": paid,
									  "bal" : bal
									};
						  }
						  
						  
				
						
					else
						  {var insufamt=$("#hidinsufamt").val();
							   $(".payment_pend_right_cash_error").css("display","block");
							   $(".payment_pend_right_cash_error").addClass("popup_validate");
							   $(".payment_pend_right_cash_error").text(insufamt);
							   $('.payment_pend_right_cash_error').delay(2000).fadeOut('slow');
						  }
					}
					
			   }else
					   {var entremt=$("#hidentramt").val();
						   $(".payment_pend_right_cash_error").css("display","block");
						    $(".payment_pend_right_cash_error").addClass("popup_validate");
			 				$(".payment_pend_right_cash_error").text(entremt);
							$('.payment_pend_right_cash_error').delay(2000).fadeOut('slow');
					   }
			 
			 
			 
			   }else
			   {
			   var selectcoup=$("#hidselectcoup").val();
				   $(".payment_pend_right_cash_error").css("display","block");
				   $(".payment_pend_right_cash_error").addClass("popup_validate");
			 		$(".payment_pend_right_cash_error").text(selectcoup);
					$('.payment_pend_right_cash_error').delay(2000).fadeOut('slow');
			   }
		  }else if(selct=="voucher")
		  {
			  var vouchid=$('#vouchid').val();
			  if(vouchid!="")
			   		{
						var vocamount=$('#vocamount').val();
						 var vouchbal=$('#vouchbal').val();
						 var paid=$('#paidamount').val();
						var bal=$('#balanceamout').val();
						
						  var voucherbalanc=  parseFloat(vouchbal.replace(/,/g, ""));
				           var voucherpaid=parseFloat(paid.replace(/,/g, ""));
						
						
						if(voucherbalanc >voucherpaid )
						{
							var insufamt=$("#hidinsufamt").val();
							  $(".payment_pend_right_cash_error").css("display","block");
							   $(".payment_pend_right_cash_error").addClass("popup_validate");
							   $(".payment_pend_right_cash_error").text(insufamt);
							   $('.payment_pend_right_cash_error').delay(2000).fadeOut('slow');
							
						}
						else
						{
							
							
							
						
						
						
						 if(vouchbal=='0.00' && bal=='0')
						  {
							  var data = {
							  "set"		: "bill_settle_ta",
							  "type"		: selct,
							  "billno" 	: billno[0],
							  "typenam"	: typenam,
							  "vouchid" :vouchid,
							  "vocamount": vocamount,
							  "vouchbal" : vouchbal,
							  "paid": paid,
							  "bal" : bal
							};
						  }else if((vouchbal!='0.00') && bal!='0')
						  {
							  
							  var data = {
							 "set"		: "bill_settle_ta",
							  "type"		: selct,
							  "billno" 	: billno[0],
							  "typenam"	: typenam,
							  "vouchid" :vouchid,
							  "vocamount": vocamount,
							  "vouchbal" : vouchbal,
							  "paid": paid,
							  "bal" : bal
							};
						  }else if((vouchbal<'0') && bal=='0')
						  {
							   var data = {
							  "set"		: "bill_settle_ta",
							  "type"		: selct,
							  "billno" 	: billno[0],
							  "typenam"	: typenam,
							  "vouchid" :vouchid,
							  "vocamount": vocamount,
							  "vouchbal" : vouchbal,
							  "paid": paid,
							  "bal" : bal
							};
						  }
						  else
						  {var insufamt=$("#hidinsufamt").val();
							   $(".payment_pend_right_cash_error").css("display","block");
							   $(".payment_pend_right_cash_error").addClass("popup_validate");
							   $(".payment_pend_right_cash_error").text(insufamt);
							   $('.payment_pend_right_cash_error').delay(2000).fadeOut('slow');
						  }	
							
							
				   }
				   
					}
				   
				else
			   {
			   var entervoucher=$("#hidentervoucher").val();
				   $(".payment_pend_right_cash_error").css("display","block");
				   $(".payment_pend_right_cash_error").addClass("popup_validate");
			 		$(".payment_pend_right_cash_error").text(entervoucher);
					$('.payment_pend_right_cash_error').delay(2000).fadeOut('slow');
			   }	  
			  
		  }else if(selct=="cheque")
		  {
			 
			   var cheqbank=$('#cheqbank').val();
			   var cheqname=$('#cheqname').val();
			   var cheqamt=$('#cheqamount').val();
			    var cheqbal=$('#cheqbal').val();
			   if(cheqname!="")
			   {
					if(cheqbank!="")
			   		{
						if(cheqamt!="")
			   			{
							var paid=$('#paidamount').val();
							var bal=$('#balanceamout').val();
							var cheqbalanc=  parseFloat(cheqbal.replace(/,/g, ""));
				           var chequepaid=parseFloat(paid.replace(/,/g, ""));
						   
						   if(cheqbalanc > chequepaid)
						   {var insufamt=$("#hidinsufamt").val();
							      $(".payment_pend_right_cash_error").css("display","block");
							   $(".payment_pend_right_cash_error").addClass("popup_validate");
							   $(".payment_pend_right_cash_error").text(insufamt);
							   $('.payment_pend_right_cash_error').delay(2000).fadeOut('slow');
						   }
							
							
							
						else
						{	
							
							
							
							
							if(cheqbal=='0.00' && bal=='0')
						  {
							  var data = {
								  "set"		: "bill_settle_ta",
								  "type"		: selct,
								  "billno" 	: billno[0],
								  "typenam"	: typenam,
								  "cheqbank" :cheqbank,
								  "cheqname": cheqname,
								  "cheqamt": cheqamt,
								  "paid": paid,
								  "bal" : bal
								};
						  }else if((cheqbal!='0.00') && bal!='0')
						  {
							  
							  var data = {
								  "set"		: "bill_settle_ta",
								  "type"		: selct,
								  "billno" 	: billno[0],
								  "typenam"	: typenam,
								  "cheqbank" :cheqbank,
								  "cheqname": cheqname,
								  "cheqamt": cheqamt,
								  "paid": paid,
								  "bal" : bal
								};
						  }else if((cheqbal<'0') && bal=='0')
						  {
							   var data = {
								  "set"		: "bill_settle_ta",
								  "type"		: selct,
								  "billno" 	: billno[0],
								  "typenam"	: typenam,
								  "cheqbank" :cheqbank,
								  "cheqname": cheqname,
								  "cheqamt": cheqamt,
								  "paid": paid,
								  "bal" : bal
								};
						  }
						  else
						  {var insufamt=$("#hidinsufamt").val();
							   $(".payment_pend_right_cash_error").css("display","block");
							   $(".payment_pend_right_cash_error").addClass("popup_validate");
							   $(".payment_pend_right_cash_error").text(insufamt);
							   $('.payment_pend_right_cash_error').delay(2000).fadeOut('slow');
						  }	
							
						}
							
							
						}else
						{ 
						var enterchequeamt=$("#hidenterchequeamt").val();
							$(".payment_pend_right_cash_error").css("display","block");
							$(".payment_pend_right_cash_error").addClass("popup_validate");
							$(".payment_pend_right_cash_error").text(enterchequeamt);
							$('.payment_pend_right_cash_error').delay(2000).fadeOut('slow');
						}
					}else
					 {var enterbankname=$("#hidenterbankname").val();
						 $(".payment_pend_right_cash_error").css("display","block");
						 $(".payment_pend_right_cash_error").addClass("popup_validate");
			 			$(".payment_pend_right_cash_error").text(enterbankname);
						$('.payment_pend_right_cash_error').delay(2000).fadeOut('slow');
					 }
			   }else
			   { 
			   var enterchecknumber=$("#hidenterchecknumber").val();
				   $(".payment_pend_right_cash_error").css("display","block");
				    $(".payment_pend_right_cash_error").addClass("popup_validate");
			 		$(".payment_pend_right_cash_error").text(enterchecknumber);
					$('.payment_pend_right_cash_error').delay(2000).fadeOut('slow');
			   }
		   
			  
			  
			  }
		 
		else
		{var entremt=$("#hidentramt").val();
			$(".payment_pend_right_cash_error").css("display","block");
			$(".payment_pend_right_cash_error").addClass("popup_validate");
			$(".payment_pend_right_cash_error").text(entremt);
			$('.payment_pend_right_cash_error').delay(2000).fadeOut('slow');
		}
		
		}else
		{
			
			var incrt_amt=$("#hidincrt_amt").val();
			$(".payment_pend_right_cash_error").css("display","block");
			$(".payment_pend_right_cash_error").addClass("popup_validate");
			$(".payment_pend_right_cash_error").text(incrt_amt);
			$('.payment_pend_right_cash_error').delay(2000).fadeOut('slow');
			
		}
		  }else
		{
			var entremt=$("#hidentramt").val();
			$(".payment_pend_right_cash_error").css("display","block");
			$(".payment_pend_right_cash_error").addClass("popup_validate");
			$(".payment_pend_right_cash_error").text(entremt);
			$('.payment_pend_right_cash_error').delay(2000).fadeOut('slow');
			
		}
		  
		     data = $(this).serialize() + "&" + $.param(data);//alert(data);
			 $.ajax({
					type: "POST",
					url: "load_payments_ta_cs.php",
					data: data,
					success: function(msg)
					{
						var modeval=	$('#typesele').val();
						$.post("load_payments_ta_cs.php", {modeval:modeval,set:'loadta_billdetails'},
				  function(data1)
				  {
				  $('#load_billfullist').html(data1);
				   $('.loadallhead').load("load_payments_ta_cs.php?set=loadtablehead");	
				   
				  var dataString; 
						  dataString = 'set=checkcashdrawersettings';
						   $.ajax({
						  type: "POST",
						  url: "load_payment_ta_cs.php",
						  data: dataString,
						  success: function(data4) {
							  data4=data4.trim();
							  if(data4=="N")
							  {
								var dataString; 
									  dataString = 'set=drawer_open';
									   $.ajax({
									  type: "POST",
									  url: "cashdrawer_details.php",
									  data: dataString,
									  success: function(data3) {//alert("ok");
										  data3=data3.trim();//alert(data3);
										  /*if(data2=="ok")
										  {
											
									  
										  }*/
										  
										  }
									  });
						  
							  }
							  
							  }
						  });
				  //});
				  
						/* var flr_id=	$('#areachnage').val();	
						 $.post("load_paymentpending.php", {floorid:flr_id,bilno:billno[0],set:'loadbilldetails'},
						function(data)
						{
						data=$.trim(data);
						$('#load_billfullist').html(data);	*/
						
								$('#billdetails').empty();				  
							 // $('#billdetails').load("load_paymentpending.php?set=loadbilldetails_total");
							  $('.paymentclose').css("display","none");
							  $('.paid_amount_cc').css("display","none");
							  
							  $(".cash_cc").hide();
							  $(".credit_cc_normal").hide();
							  $(".credit_cc").hide();
							  $(".coupon_cc").hide();
							  $(".voucher_cc").hide();
							  $(".cheque_cc").hide();
							  $(".auto1").hide();
							  $(".auto").hide();
							  
							  $('#grandtotal').text('');	
							  $('#grandtotal_sec').text('');	
							  $('#grandtotal_sec_sub').text('');	
							  
							  $('#coupbal').val("");
							  $('#vouchbal').val("");
							  $('#coupamount').val(""); 
							  $('#vouchid').val("");
							  $('#vocamount').val(""); 
							  $('#paidamount').val("0");
							  $('#balanceamout').val("0");
							  $('#cheqamount').val("");
							  $('#cheqname').val("");
							  $('#cheqbank').val("");
							  $('#cheqbal').val("");
							  
							  $('.closetranscations').css("display","none");
							  $('.paid_amount_cc_credit').css("display","none");
							  
							  $(".payment_pend_right_cash_error").css("display","block");
							  $(".payment_pend_right_cash_error").addClass("popup_validate");
							  $(".payment_pend_right_cash_error").text(msg);
							  $('.payment_pend_right_cash_error').delay(2000).fadeOut('slow');
							  
							  
							  $(".error_feed").css("display","block");
							  $(".error_feed").addClass("popup_validate");
							  $(".error_feed").text(msg);
							  $('.error_feed').delay(2000).fadeOut('slow'); 
						
						//});	
						
                                                                                  var dataString; 
                                                                                
										 dataString = 'value=ta_kotprint&gensettle=Y&bilno12='+billno[0];
                                                                          
										   $.ajax({
										  type: "POST",
										  url: "print_details_kot.php",
										  data: dataString,
										  success: function(data1) { 
										   var dataString; 
											  dataString = 'value=console_ta&gensettle=Y';
										   $.ajax({
										  type: "POST",
										  url: "print_details_kot.php",
										  data: dataString,
										  success: function(data2) {
											  
							                            window.location="payments_ta_cs.php";
										  }
										  });
										   }
										  });
                                                
                                                
                                                
                                                
                                                
                                                
                                                
						 			  
					 
						});
						
		  
						
					}
				});
		}else
		{var sel_paytype=$("#hidsel_paytype").val();
			$(".payment_pend_right_cash_error").css("display","block");
			$(".payment_pend_right_cash_error").addClass("popup_validate");
			$(".payment_pend_right_cash_error").text(sel_paytype);
			$('.payment_pend_right_cash_error').delay(2000).fadeOut('slow');
		}
		});
	/*****************************************  close bill ends ******************************************************************  */
        //-------------------settl on popup start
        
        //--------------------
	/*************************************  verify starts **********************************************************  */
	
	 $('.closetranscations_whole').click(function (event) {
		
		var paymentmsg1 = ($("#paymentmsg1").val());
                var paymentmsg3 = ($("#paymentmsg3").val());
			var selct=$('#payemntmode_sel').val();
			
			var selected_activities =$('.tr_bill_gen_active');
			var billno = new Array(); 
			var tableid = new Array();
			var prefid = new Array();
			selected_activities.each(function(){
			var id_str       =  $(this).attr("billno");
				if(id_str!='undefined' && id_str!='' && id_str!=null){
				  billno.push(id_str);
				}
			}); 
			billno=unique(billno)
			var data;
			 var typenam=$("#payemntmode_sel").find('option:selected').attr('idval');
		
			 if(selct=="credit_person") 
			  {   var balanceamout_credit=$('#balanceamout_credit').val();
                              if(balanceamout_credit!=0){
					  var creditype=$('#selectcreditypes').val();
					  var creditdeatils=$('#selectcreditdetails').val();
					  var paidamount_credit=$('#paidamount_credit').val();
					  var amount_credit=$('#amount_credit').val();
					  //var balanceamout_credit=$('#balanceamout_credit').val();
					  if(creditype!='')
					  {
						  if(creditdeatils!='')
						  {
							   data = {
								  "set"					: "bill_settle_ta",
								  "type"				: selct,
								  "billno" 				: billno[0],
								  "typenam"				: typenam,
								  "creditype"			: creditype,
								  "creditdeatils"		: creditdeatils,
								  "paidamount_credit"	: paidamount_credit,
								  "amount_credit"		: amount_credit,
								  "bal"					: 0
								};
							  
						  }else
						  {
						  var sel_option=$("#hidsel_option").val();
							  var labelname=$("#selectcreditypes").find('option:selected').attr('label');
							  $(".payment_pend_right_cash_error").css("display","block");
							  $(".payment_pend_right_cash_error").addClass("popup_validate");
							  $(".payment_pend_right_cash_error").text(sel_option +labelname);
							  $('.payment_pend_right_cash_error').delay(2000).fadeOut('slow');
						  }
					  }else
					  {var sel_credttype=$("#hidsel_credttype").val();
						  $(".payment_pend_right_cash_error").css("display","block");
						  $(".payment_pend_right_cash_error").addClass("popup_validate");
						  $(".payment_pend_right_cash_error").text(sel_credttype);
						  $('.payment_pend_right_cash_error').delay(2000).fadeOut('slow');
					  }
							
						
                              }else{
                                  
                                  alert('Credit not Possible !');
                              }		
			  }else if(selct=="complimentary")
				{
		  			var comp=$('#completext').val();//alert(comp)
					if(comp!='')
					  {
						   data = {
								  "set"			: "bill_settle_ta",
								  "type"		: selct,
								  "billno" 		: billno[0],
								  "typenam"		: typenam,
								  "comp"		: comp
								};
						  
					  }else
					  {
						  $(".payment_pend_right_cash_error").css("display","block");
						  $(".payment_pend_right_cash_error").addClass("popup_validate");
						  $(".payment_pend_right_cash_error").text(paymentmsg1);
						  $('.payment_pend_right_cash_error').delay(2000).fadeOut('slow');
					  }
	   
			
				}else if(selct=="comp_management")
				{
		  			
					var auth=$('#hidcompmangauth').val();
				
					 var comp=$('#completext_mng').val();
					var staff=$('#selectstafcomp').val();
					if(auth=="Y")
					{
						if(staff!='')
							{
								if(comp!='')
								{
									$('.loadcompauth').css('display','block');
									$('.confrmation_overlay').css('display','block');
								}else
								{var add_compli_rem=$("#hidadd_compli_rem").val();
									$(".payment_pend_right_cash_error").css("display","block");
									$(".payment_pend_right_cash_error").addClass("popup_validate");
									$(".payment_pend_right_cash_error").text(add_compli_rem);
									$('.payment_pend_right_cash_error').delay(2000).fadeOut('slow');
								}
							}else
							{
								$(".payment_pend_right_cash_error").css("display","block");
								$(".payment_pend_right_cash_error").addClass("popup_validate");
								$(".payment_pend_right_cash_error").text(paymentmsg3);
								$('.payment_pend_right_cash_error').delay(2000).fadeOut('slow');
							}
						
					}else
					{
						 
						  if(comp!='')
							{
								 data = {
										"set"			: "bill_settle_ta",
										"type"		: selct,
										"billno" 		: billno[0],
										"typenam"		: typenam,
										"comp"		: comp,
										"staff" :staff
									  };
									
								
							}else
							{var add_compli_rem=$("#hidadd_compli_rem").val();
								$(".payment_pend_right_cash_error").css("display","block");
								$(".payment_pend_right_cash_error").addClass("popup_validate");
								$(".payment_pend_right_cash_error").text(add_compli_rem);
								$('.payment_pend_right_cash_error').delay(2000).fadeOut('slow');
							}
					}
	   
			
				}
			
			
			
			
			 data = $(this).serialize() + "&" + $.param(data);
			 $.ajax({
					type: "POST",
					url: "load_payments_ta_cs.php",
					data: data,
					success: function(msg)
					{//alert(msg);
					
					var modeval=	$('#typesele').val();
						$.post("load_payments_ta_cs.php", {modeval:modeval,set:'loadta_billdetails'},
				  function(data1)
				  {
				  $('#load_billfullist').html(data1);
				   $('.loadallhead').load("load_payments_ta_cs.php?set=loadtablehead");	
				   
						/* var flr_id=	$('#areachnage').val();	
						 $.post("load_paymentpending.php", {floorid:flr_id,bilno:billno[0],set:'loadbilldetails'},
						function(data)
						{
							data=$.trim(data);
							$('#load_billfullist').html(data);*/	
							/* $.post("print_details.php", {bilno:billno[0],set:'billprint'},
							function(data)
							{
							  data=$.trim(data);
							  //alert(data);
							  $(".error_feed").css("display","block");
							  $(".error_feed").addClass("billgenration_validate");
							  $(".error_feed").text("Bill Re-printed");
							  $(".error_feed").delay(2000).fadeOut('slow');*/
							  
							  $('#billdetails').empty();
							  $('.paymentclose').css("display","none");
							  $('.paid_amount_cc').css("display","none");
							  $(".complimentrary_management").hide();
							  $('#selectstafcomp').find('option:first').attr('selected', 'selected');
							  $('#completext_mng').val("");
							  $(".cash_cc").hide();
							  $(".credit_cc_normal").hide();
							  $(".credit_cc").hide();
							  $(".coupon_cc").hide();
							  $(".voucher_cc").hide();
							  $(".cheque_cc").hide();
							  $(".auto1").hide();
							  $(".auto").hide();
							  
							  $('#grandtotal').text('');
							  $('#grandtotal_sec_sub').text('');	
							  
							  $('#coupbal').val("");
							  $('#vouchbal').val("");
							  $('#coupamount').val(""); 
							  $('#vouchid').val("");
							  $('#vocamount').val(""); 
							  $('#paidamount').val("0");
							  $('#balanceamout').val("0");
							  $('#cheqamount').val("");
							  $('#cheqname').val("");
							  $('#cheqbank').val("");
							  $('#cheqbal').val("");
							  
							  $('.paid_amount_cc_credit').css("display","none");
							  
							  $(".payment_pend_right_cash_error").css("display","block");
							  $(".payment_pend_right_cash_error").addClass("popup_validate");
							  $(".payment_pend_right_cash_error").text(msg);
							  $('.payment_pend_right_cash_error').delay(2000).fadeOut('slow');
							
							//});
						});
					}
				});
	
	
		});
	/*****************************************  close bill ends ******************************************************************  */
	 /***************************************  staff starts ******************************************************************  */
   $('#stafflist').change(function () {
		var stafflist       = $("#stafflist").find('option:selected').attr('cancelkey');//alert(stafflist);
		//alert(stafflist)
		var psd=$("#hidenterpaswd").val();
		var otp=$("#hidenterotp").val();
		if(stafflist=='Y')
		{
			$(' #typeentery ').text(otp);
			$(' .btn_index_popup_send ').css('display','block');
			$(' .btn_index_popup_send a').css('display','block');
		}else
		{
			$(' #typeentery ').text(psd);
			$(' .btn_index_popup_send').css('display','none');
			$(' .btn_index_popup_send a').css('display','block');
		}
		/*$.post("load_bill_history.php", {stafflist:stafflist,set:'sendotp'},
			function(data)
			{
			data=$.trim(data);
			//alert(data);
			});*/
	 
	 
	 });
	 /***************************************  staff ends ******************************************************************  */
	 
	  /***************************************  staff comp starts ******************************************************************  */
   $('#stafflist_comp').change(function () {
		var stafflist       = $("#stafflist_comp").find('option:selected').attr('cancelkey');//alert(stafflist);
		//alert(stafflist)
		var psd=$("#hidenterpaswd").val();
		var otp=$("#hidenterotp").val();
		if(stafflist=='Y')
		{
			$(' #typeentery ').text(otp);
			$(' .btn_index_popup_send ').css('display','block');
			$(' .btn_index_popup_send a').css('display','block');
		}else
		{
			$(' #typeentery ').text(psd);
			$(' .btn_index_popup_send').css('display','none');
			$(' .btn_index_popup_send a').css('display','block');
		}
		/*$.post("load_bill_history.php", {stafflist:stafflist,set:'sendotp'},
			function(data)
			{
			data=$.trim(data);
			//alert(data);
			});*/
	 
	 
	 });
	 /***************************************  staff ends ******************************************************************  */
	 /***************************************  auto refresh starts **********************************************************  */
	 setInterval(function() { 
	 
	
	 var modeval=	$('#typesele').val();
	  
	  var selected_activities =$('.tr_bill_gen_active');
	   var billno = new Array(); 
		var tableid = new Array();
		 var prefid = new Array();
	   selected_activities.each(function(){
		var id_str       =  $(this).attr("billno");
			if(id_str!='undefined' && id_str!='' && id_str!=null){
				billno.push(id_str);
			}
	  }); 
	  billno=unique(billno)




	//var modeval=	$('#typesele').val();
	$.post("load_payments_ta_cs.php", {modeval:modeval,bilno:billno[0],set:'loadta_billdetails'},
				  function(data)
				  {
                                      //alert(data);
				  $('#load_billfullist').html(data);
				   $('.loadallhead').load("load_payments_ta_cs.php?set=loadtablehead");		  
				  });
				  			
  
	 
	  }, 6000); 
	/***************************************  auto refresh ends **********************************************************  */
	 
	  /***************************************  ok  comp permision starts ****************************************************************  */
   $('.submitloadcompauth').click(function () {//alert("j");
		
		//var reasontext       =  $('#reasontext').val();
		var secretkey        =  $('#secretkey_comp').val();
		var stafflist        =  $('#stafflist_comp').val();
		//alert(secretkey+stafflist)
		 $.post("load_bill_history.php", {secretkey:secretkey,stafflist:stafflist,set:'secretkeycheck'},
					function(data)
					{
					data=$.trim(data);//alert(data);
					if(data=="ok")
					{  
						  var selected_activities =$('.tr_bill_gen_active');
						   var billno = new Array(); 
							var tableid = new Array();
							 var prefid = new Array();
						   selected_activities.each(function(){
							var id_str       =  $(this).attr("billno");
								if(id_str!='undefined' && id_str!='' && id_str!=null){
									billno.push(id_str);
								}
						  }); 
						  billno=unique(billno)
						  var stafflist        =  $('#stafflist_comp').val();
						 // alert(stafflist)
						   var comp=$('#completext_mng').val();
							var staff=$('#selectstafcomp').val();
							var selct=$('#payemntmode_sel').val();
							
							selected_activities.each(function(){
							var id_str       =  $(this).attr("billno");
								if(id_str!='undefined' && id_str!='' && id_str!=null){
								  billno.push(id_str);
								}
							}); 
							billno=unique(billno)
							var data;
							 var typenam=$("#payemntmode_sel").find('option:selected').attr('idval');
  
								data = {
										"set"			: "bill_settle_ta",
										"type"		: selct,
										"billno" 		: billno[0],
										"typenam"		: typenam,
										"comp"		: comp,
										"staff"		: staff,
										//"reasontext":reasontext,
										"secretkey":secretkey,
										"stafflist":stafflist
									  };
									  
									  
									   data = $(this).serialize() + "&" + $.param(data);//alert(data)
									 $.ajax({
											type: "POST",
											url: "load_payments_ta_cs.php",
											data: data,
											success: function(msg)
											{//alert(msg);
												var modeval=	$('#typesele').val();
													$.post("load_payments_ta_cs.php", {modeval:modeval,set:'loadta_billdetails'},
											  function(data1)
											  {
											  $('#load_billfullist').html(data1);
											   $('.loadallhead').load("load_payments_ta_cs.php?set=loadtablehead");		
				   
													$('#billdetails').empty();
													$('.paymentclose').css("display","none");
													$('.paid_amount_cc').css("display","none");
													 
													$(".cash_cc").hide();
													$(".complimentrary_management").hide();
													$(".credit_cc_normal").hide();
													$(".credit_cc").hide();
													$(".coupon_cc").hide();
													$(".voucher_cc").hide();
													$(".cheque_cc").hide();
													$(".auto1").hide();
													$(".auto").hide();
													
													$('#grandtotal').text('');
													$('#grandtotal_sec_sub').text('');
													
													$('#selectstafcomp').find('option:first').attr('selected', 'selected');
													$('#completext_mng').val("");
													$('#coupbal').val("");
												   $('#vouchbal').val("");
												   $('#coupamount').val(""); 
												   $('#vouchid').val("");
												   $('#vocamount').val(""); 
													$('#paidamount').val("0");
													 $('#balanceamout').val("0");
													 $('#cheqamount').val("");
													$('#cheqname').val("");
													$('#cheqbank').val("");
													$('#cheqbal').val("");
													
													$('.paid_amount_cc_credit').css("display","none");
													
													$('.loadcompauth').css("display","none");
													$('.confrmation_overlay').css("display","none");
													
													
													$(".payment_pend_right_cash_error").css("display","block");
													$(".payment_pend_right_cash_error").addClass("popup_validate");
													$(".payment_pend_right_cash_error").text(msg);
													$('.payment_pend_right_cash_error').delay(2000).fadeOut('slow');
												});
											}
										});
									  
						  
						   
					}else
					{
						var tp='';
						var stafflist       = $("#stafflist").find('option:selected').attr('cancelkey');//alert(stafflist);
						var psd=$("#hidenterpaswd").val();
						var otp=$("#hidenterotp").val();
						var err=$("#hiderrormg").val();
						if(stafflist=='Y')
						{
							tp=otp;
						}else
						{
							tp=psd;
						}
						$("#deatilserror").css("display","block");
						$("#deatilserror").text(tp+" "+ err+"!!");
						$("#deatilserror").delay(2000).fadeOut('slow');
						
					}
				 }); 
		
		
		
		
	 
	 
	 });
	 /***************************************  ok  comp permision ends ******************************************************************  */
	 
	 
	 
	 /******************************  cancel comp permision starts ******************************************************************  */
     $('.closeloadcompauth').click(function () {//alert("j");
		$('.loadcompauth').css('display','none');
		$('.confrmation_overlay').css('display','none');
	 
	 });
	 /***************************************  cancel comp permision ends **************************************************************  */
	
	/*************************************  credit types starts **********************************************************  */
	$('#selectcreditypes').change(function () {	 
			  var credittype=	$(this).val();//alert(credittype)
			 $('.credtitypeloads').html('<img src="img/ajax-loaders/ajax-loader-6.gif" />');
			 var labelname=$("#selectcreditypes").find('option:selected').attr('label');
			 
			
			 
			  $.post("load_paymentpending.php", {credittype:credittype,set:'loadcreditypes'},
				  function(data)
				  {
				  $('.credtitypeloads').html(data);	
				  $('.labelname').html(labelname);	
				  
				   var balamt=	$('#balanceamout_credit').val();
				   if(balamt!='0.00' &&  balamt!='0' &&  balamt!='')
				   {
					   $('#amount_credit').val(balamt);
					   
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
				  
				    
				  });
	});
			  
	/***************************************  credit types ends **********************************************************  */
	});
	
	
	function unique(list) {
    var result = [];
    $.each(list, function(i, e) {
        if ($.inArray(e, result) == -1) result.push(e);
    });
    return result;
}


/*****************************************  calculation starts ******************************************************************  */
function IsNumeric(strString)
{
  var strValidChars = "0123456789. ";
  var strChar;
  var blnResult = true;
  if (strString.length == 0) {return false;}
 var a= strString.length;
  if(strString.length<10 || strString.length>13 )
  {
	
   return false;
  }

  for (i = 0; i < strString.length && blnResult == true; i++)
     {
     strChar = strString.charAt(i);
     if (strValidChars.indexOf(strChar) == -1)
        {
       	blnResult = false;
        }
     }
  return blnResult;
  
}
	function calculatetotal()
		{
			var vals=0;
			vals=parseFloat($('#finalamt').text()) - parseFloat($('#canclamt').val());
			$('#rightamout').text(vals.toFixed(2));
			var servt=0;
			servt=parseFloat(vals) * parseFloat($('#servicetaxorg').text() / 100);
			$('#servicetax').text(servt.toFixed(2));
			var vat=0;
			vat=parseFloat(vals) * parseFloat($('#vatorg').text() / 100);
			$('#vat').text(vat.toFixed(2));
			var serch=0;
			serch=parseFloat(vals) * parseFloat($('#servicechrgorg').text() / 100);
			$('#servicechrg').text(serch.toFixed(2));
			if($('#discval').val()!="")
			{
			var disc=parseFloat($('#discval').val().replace(/,/g, ""));
			if(disc=="")
			{
				disc=0;
			}
			}else
			{
				disc=0;
			}
			var tot=(parseFloat(vals) + parseFloat(servt) + parseFloat(vat) + parseFloat(serch) )  ;
			if(disc!="")
			{
			 tot= parseFloat(tot) - parseFloat(disc);
			}
			$('#grandtotal').text(tot.toFixed(2));
		}
		function discunt()
		{
			var tt=0;
			var gd=parseFloat($('#grandtotal').text().replace(/,/g, ""));
			var dc=parseFloat($('#discval').val().replace(/,/g, ""));
			tt = parseFloat(gd -  dc); 
			
			document.getElementById("grandtotal").innerHTML=tt.toFixed(2);
			
		}
		function couponamountchange()
		{
			var tt=0;
			var gd=parseFloat($('#grandtotal').text().replace(/,/g, ""));
			var dc=parseFloat($('#coupamount').val().replace(/,/g, ""));
			tt = parseFloat(gd -  dc); 
			if(tt<0)
			{var incrt_coupamt=$("#hidincrt_coupamt").val();
				 $(".payment_pend_right_cash_error").css("display","block");
				 $(".payment_pend_right_cash_error").addClass("popup_validate");
			 	 $(".payment_pend_right_cash_error").text(incrt_coupamt);
				 $('.payment_pend_right_cash_error').delay(2000).fadeOut('slow');
			}else
			{
			document.getElementById("coupbal").value=tt.toFixed(2);
			}
		}
		function cheqamountchange()
		{
			var tt=0;
			var gd=parseFloat($('#grandtotal').text().replace(/,/g, ""));
			var dc=parseFloat($('#cheqamount').val().replace(/,/g, ""));
			tt = parseFloat(gd -  dc); 
			if(tt<0)
			{var incrt_cheqamt=$("#hidincrt_cheqamt").val();
				 $(".payment_pend_right_cash_error").css("display","block");
				 $(".payment_pend_right_cash_error").addClass("popup_validate");
			 	$(".payment_pend_right_cash_error").text(incrt_cheqamt);
				$('.payment_pend_right_cash_error').delay(2000).fadeOut('slow');
			}else
			{
			document.getElementById("cheqbal").value=tt.toFixed(2);
			var bl=tt.toFixed(2);
			$('#paidamount').focus();
			if(bl=='0.00')
			{
				$('#paidamount').val('0');
				$('#balanceamout').val('0');
				$('#balanceamout').focus();
			}
			
			}
		}
		function transamountchange()
		{
                    
                    
                    
                    $('#paidamount').val('');
                      $('#balanceamout').val('');
			var tt=0;
			var gd=parseFloat($('#grandtotal').text().replace(/,/g, ""));
			var dc=parseFloat($('#transcationid').val().replace(/,/g, ""));
			tt = parseFloat(gd -  dc); 
                        
                        
                        if(dc>gd){
                           
                            $('#transcationid').val('');
                            $('#transbal').val('');
                        }
			if(tt<0)
			{
				 //$(".payment_pend_right_cash_error").css("display","block");
				 //$(".payment_pend_right_cash_error").addClass("popup_validate");
			 	//$(".payment_pend_right_cash_error").text("Incorrect Transcation Amount");
				//$('.payment_pend_right_cash_error').delay(2000).fadeOut('slow');
				
				$("#paidamount").val('');
				$("#balanceamout").val('');
				$('#balanceamout').focus();
			}else
			{
				
			document.getElementById("transbal").value=tt.toFixed(2);
			if(tt==0)
			{
				$("#paidamount").val('0');
				$("#balanceamout").val('0');
				$('#balanceamout').focus();
			}
			}
		}
	/*****************************************  calculation ends ******************************************************************  */
	
	/*****************************************  balance calc starts ******************************************************************  */
	function enterbalance()
	  {
	  	var paid=$('#paidamount').val();
		 var grand=$('#grandtotal').text();
		 if($('#transbal').val()!="")
		 {
			 var subt=$('#transbal').val();
			 var bal=parseFloat(paid.replace(/,/g, "")) -  parseFloat(subt.replace(/,/g, ""));
			 
		 }else if($('#coupbal').val()!="")
		 {
			 var subt=$('#coupbal').val();
			 var bal=parseFloat(paid.replace(/,/g, "")) -  parseFloat(subt.replace(/,/g, ""));
			 
		 }else if($('#vouchbal').val()!="")
		 {
			 var subt=$('#vouchbal').val();
			 var bal=parseFloat(paid.replace(/,/g, "")) -  parseFloat(subt.replace(/,/g, ""));
		 }else if($('#cheqbal').val()!="")
		 {
			 var subt=$('#cheqbal').val();
			 var bal=parseFloat(paid.replace(/,/g, "")) -  parseFloat(subt.replace(/,/g, ""));
		 }else 
		 {
		 	var bal=parseFloat(paid.replace(/,/g, "")) -  parseFloat(grand.replace(/,/g, ""));
		 }
		 if(bal<0)
			 {var insufamt=$("#hidinsufamt").val();
				 $(".payment_pend_right_cash_error").css("display","block");
				 $(".payment_pend_right_cash_error").addClass("popup_validate");
			 	$(".payment_pend_right_cash_error").text(insufamt);
				$('.payment_pend_right_cash_error').delay(2000).fadeOut('slow');
				$('#balanceamout').val('');
				//$('#balanceamout').focus();
				
			 }else
			 {
					$('#balanceamout').val(bal.toFixed(2));
					$('#balanceamout').focus();
			 }
		  
	  }
	  
	  function enterbalance_credit()
	  {
	  	var paid=$('#paidamount_credit').val();
		  var letterNumber = /^[0-9 .]+$/; 
                  
                  
		  var bal; 
		 if(($('#paidamount_credit').val().match(letterNumber)))
		  {
			   var grand=$('#grandtotal').text();
			    bal=parseFloat(grand.replace(/,/g, "")) -  parseFloat(paid.replace(/,/g, ""));
			  
		  }
		  
		   //var balamt=	$('#balanceamout_credit').val();
		  
		  
		
		 if(bal<=0)
			 {
				 //$(".error_feed").css("display","block");
				 //$(".error_feed").addClass("popup_validate");
			 	//$(".error_feed").text("Insufficient Amount");
				//$('.error_feed').delay(2000).fadeOut('slow');
				/*var grand=$('#grandtotal').text();
			   var  balv=parseFloat(paid.replace(/,/g, "")) -  parseFloat(grand.replace(/,/g, ""));*/
				
				
				$('#balanceamout_credit').val('0');
				$('#amount_credit').val('0');
				//$('#balanceretu_credit').val(balv);
				
			 }else
			 {
				  if(bal!='0.00' &&  bal!='0' &&  bal!='')
				 {
					 $('#amount_credit').val(bal.toFixed(2));
				 }else
				 {
					 if(bal=='0' && $('#paidamount_credit').val()!='0')
					 {
						 $('#amount_credit').val('0'); 
					 }else
					 {
						 
					 var grnd=$('#grandtotal').text();
					$('#amount_credit').val(grnd.toFixed(2)); 
					 }
				 }
		   
					$('#balanceamout_credit').val(bal.toFixed(2));
			 }
		  
	  }
	/*****************************************  balance calc ends ******************************************************************  */
	
	
	
	
	function isFloat(n) {
return parseFloat(n.match(/^-?\d*(\.\d+)?$/))>=0;
}