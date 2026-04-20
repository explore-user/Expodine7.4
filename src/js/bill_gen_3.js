// JavaScript Document

$(document).ready(function() {
	/*****************************************  dropdown1 starts ******************************************************************  */
	$('#menu').fancySelect().on('change', function() {
			newSection = $('#' + $(this).val())
			if (newSection.hasClass('current')) {
				return;
			}
			$('section').removeClass('current');
			newSection.addClass('current');

			$('section:not(.current)').fadeOut(300, function() {
				newSection.fadeIn(300);
			});
		});
		$('#menu1').fancySelect().on('change',  function() {});
		$('#menu01').fancySelect().on('change', function() {});
		$('#menu02').fancySelect().on('change', function() {});
		$('#menu03').fancySelect().on('change', function() {
			$('#coupbal').val("");
			 $('#vouchbal').val("");
			 $('#coupamount').val(""); 
			 $('#vouchid').val("");
			 $('#vocamount').val(""); 
			  $('#paidamount').val("0");
			   $('#balanceamout').val("0");
			
			});
		$('#menu04').fancySelect().on('change', function() {});
		$('#menu05').fancySelect().on('change', function() {});
	/*****************************************  dropdown1 ends ******************************************************************  */
	
	/*****************************************  dropdown2 starts ******************************************************************  */
	$(".credit_cc").hide();
		$(".coupon_cc").hide();
		$(".voucher_cc").hide();
		$(".cheque_cc").hide();
		$(".combinationsel").hide();
        $("select").change(function(){
            $( "select option:selected").each(function(){
				if($(this).attr("value")=="cash"){
					$(".cash_cc").show(500);
                    $(".credit_cc").hide(500);
					$(".credit_cc_normal").hide(500);
                    $(".coupon_cc").hide(500);
					$(".voucher_cc").hide(500);
					$(".cheque_cc").hide(500);
					$(".combinationsel").hide(500);
                }
                if($(this).attr("value")=="credit"){
					$(".cash_cc").hide(500);
					$(".credit_cc_normal").show(500);
                    $(".credit_cc").hide(500);
                    $(".coupon_cc").hide(500);
					$(".voucher_cc").hide(500);
					$(".cheque_cc").hide(500);
					$(".combinationsel").hide(500);
                }
              if($(this).attr("value")=="coupon"){
				  $(".cash_cc").hide(500);
                    $(".credit_cc").hide(500);
					$(".credit_cc_normal").hide(500);
                    $(".coupon_cc").show(500);
					$(".voucher_cc").hide(500);
					$(".cheque_cc").hide(500);
					$(".combinationsel").hide(500);
                }
				if($(this).attr("value")=="voucher"){
					$(".cash_cc").hide(500);
                    $(".credit_cc").hide(500);
					$(".credit_cc_normal").hide(500);
                    $(".coupon_cc").hide(500);
					$(".voucher_cc").show(500);
					$(".cheque_cc").hide(500);
					$(".combinationsel").hide(500);
                }
				if($(this).attr("value")=="cheque"){
					$(".cash_cc").hide(500);
                    $(".credit_cc").hide(500);
					$(".credit_cc_normal").hide(500);
                    $(".coupon_cc").hide(500);
					$(".voucher_cc").hide(500);
					$(".cheque_cc").show(500);
					$(".combinationsel").hide(500);
                }
				if($(this).attr("value")=="comb"){
					$('.combined').prop("checked", false);
					$(".cash_cc").hide(500);
                    $(".credit_cc").hide(500);
					$(".credit_cc_normal").hide(500);
                    $(".coupon_cc").hide(500);
					$(".voucher_cc").hide(500);
					$(".cheque_cc").hide(500);
					$(".combinationsel").show(500);
                }
            });
        }).change();
	/*****************************************  dropdown2 ends ******************************************************************  */
	
	/*****************************************  dropdown3 starts ******************************************************************  */
	 $("#menu").change(function(){
					var type=$('#menu').val();
					var old=$('#discval').val();
					if(old=="")
					{
						old=0;
					}else
					{
						old=parseFloat($('#discval').val().replace(/,/g, ""));
					}
					var gd=parseFloat($('#grandtotal').text().replace(/,/g, ""));
					var tot=parseFloat($('#rightamout').text().replace(/,/g, ""));
					$.post("load_bill.php", {total:tot,type:type,set:'setcorporate'},
					  function(data)
					  {
					  data=$.trim(data);
					  $('#discval').val(data);
					  var v=(parseFloat(gd) - parseFloat(data) ) - parseFloat(old);
					  $('#grandtotal').text(v.toFixed(2));
					  });
	 });
	 $("#menu1").change(function(){
		 
		 //"EX-DS-1"
		 if($("#menu1").val()==$("#corpsess").val())
				{
					$('#corpdisc').css("display","block");
					/*var old=$('#discval').val();
					if(old=="")
					{
						old=0;
					}else
					{
						old=parseFloat($('#discval').val().replace(/,/g, ""));
						var gd=parseFloat($('#grandtotal').text().replace(/,/g, ""));
						var v=(parseFloat(gd)) - parseFloat(old);
						$('#grandtotal').text(v.toFixed(2));
					}*/
					var tot=parseFloat($('#rightamout').text().replace(/,/g, ""));
					var srt=parseFloat($('#servicetax').text().replace(/,/g, ""));
					var vt=parseFloat($('#vat').text().replace(/,/g, ""));
					var srch=parseFloat($('#servicechrg').text().replace(/,/g, ""));
					var tt=( parseFloat(srt) + parseFloat(vt)  + parseFloat(srch));
					var v=( parseFloat(tot) + parseFloat(tt) );
					$('#grandtotal').text(v.toFixed(2));
					$('#discval').val("0.00");
				}else if($("#menu1").val()=="none")
				{
					$('#corpdisc').css("display","none");
					var tot=parseFloat($('#rightamout').text().replace(/,/g, ""));
					var srt=parseFloat($('#servicetax').text().replace(/,/g, ""));
					var vt=parseFloat($('#vat').text().replace(/,/g, ""));
					var srch=parseFloat($('#servicechrg').text().replace(/,/g, ""));
					var tt=( parseFloat(srt) + parseFloat(vt)  + parseFloat(srch));
					var v=( parseFloat(tot) + parseFloat(tt) );
					$('#grandtotal').text(v.toFixed(2));
					$('#discval').val("0.00");
				}else
				{
					var type=$("#menu1").val();
					/*var old=$('#discval').val();
					
					if(old=="")
					{
						old=0;
					}else
					{
						old=parseFloat($('#discval').val().replace(/,/g, ""));
					}*///servicetax  vat servicechrg
					//var gd=parseFloat($('#grandtotal').text().replace(/,/g, ""));
					$('#corpdisc').css("display","none");
					var tot=parseFloat($('#rightamout').text().replace(/,/g, ""));
					var srt=parseFloat($('#servicetax').text().replace(/,/g, ""));
					var vt=parseFloat($('#vat').text().replace(/,/g, ""));
					var srch=parseFloat($('#servicechrg').text().replace(/,/g, ""));
					var tt=( parseFloat(srt) + parseFloat(vt)  + parseFloat(srch));
					
					 $.post("load_bill.php", {total:tot,type:type,set:'setnoncorporate'},
					  function(data)
					  {
					  data=$.trim(data);
					 // alert(data);
					  $('#discval').val(data);
					  var v=( parseFloat(tot) + parseFloat(tt) ) - parseFloat(data);
					  
					  $('#grandtotal').text(v.toFixed(2));
					  
					  });
				}
		});
	/*****************************************  dropdown3 ends ******************************************************************  */
	
	/*****************************************  Tabs starts ******************************************************************  */
	$('#tabwrap').basicTabs();
	/*****************************************  Tabs ends ******************************************************************  */
	
	/*****************************************  Radio button starts ******************************************************************  */
	$(".auto").hide();
	$(".auto1").hide();
	$('#RadioGroup1_0').change(function(){
			if (this.checked) {
				$('.auto').hide('slow');
				$(".auto1").hide('slow');
				$('.closest').css('display','none');
			}                 
		});
	$('#RadioGroup1_1').change(function(){
			if (this.checked) {
				$('.auto').show('fast');
				$(".auto1").hide('fast');
				$('.closest').css('display','block');
			}                 
		});
	$('#RadioGroup1_2').change(function(){
			if (this.checked) {
				$('.auto1').show('fast');
				$(".auto").hide('fast');
				$('.closest').css('display','block');
			}                 
		});	
	/*****************************************  Radio button ends ******************************************************************  */
	
	
	
	/*****************************************  print bill starts ******************************************************************  */
	 $('#printwholebill').click(function () {
	var credit="",compl="";
	 if($('#RadioGroup1_0').is(':checked')) 
	 { 
		 credit=""; 
		 compl="";
			var tot=parseFloat($('#grandtotal').text().replace(/,/g, ""));

			var ccl=parseFloat($('#canclamt').val().replace(/,/g, ""));
			
			if($('#menu1').val()!="" && $('#menu1').val()!="none")
			{
				var dscid=$('#menu1').val();
			}else
			{
				var dscid="";
			}
			
			if($('#menu').val()!="")
			{
				var dscid_corp=$('#menu').val();
			}else
			{
				var dscid_corp="";
			}
			
			if($('#discval').val()!="")
			{
				var dsc=$('#discval').val();
			}else
			{
				var dsc=0;
			}
			
			var final=$('#finalamt').text();
			var srvt=$('#servicetax').text();
			var vat=$('#vat').text();
			var srvc=$('#servicechrg').text();
			if($('#menu1').val()!="" && $('#menu1').val()!="none")
			{
				if($('#menu').val()!="" )
				{
					 $.post("load_bill.php", {type:"none",grandtotal:tot,cancel:ccl,discountid:dscid,discount_corp:dscid_corp,discount:dsc,servicetx:srvt,vat:vat,servicechrg:srvc,final:final,set:'creditinsert'},
					function(data)
					{
					data=$.trim(data);
					if(data=="ok")
					{
						/*$.post("print_details.php", {set:'billprint'},
						function(data)
						{
						data=$.trim(data);
						$('.gotoprev').css("display","none");
						$('#disable').addClass("bill_disable_cc");
						$('#disable1').addClass("bill_disable_cc");
						$('#enableclose').css("display","block");
						$('.service_tax_print_btn').css("display","none");
						//alert("Bill printed");
						//window.location="bill_generation_screen1.php";
						});*/	
						
						
						
					}else
					{
						//alert(data);
					}
					});
				}else
				{//alert("3");
					 $.post("load_bill.php", {type:"none",grandtotal:tot,cancel:ccl,discountid:dscid,discount:dsc,servicetx:srvt,vat:vat,servicechrg:srvc,final:final,set:'creditinsert'},
					function(data)
					{
					data=$.trim(data);
					if(data=="ok")
					{
						/*$.post("print_details.php", {set:'billprint'},
						function(data)
						{
						data=$.trim(data);
						$('.gotoprev').css("display","none");
						$('#disable').addClass("bill_disable_cc");
						$('#disable1').addClass("bill_disable_cc");
						$('#enableclose').css("display","block");
						$('.service_tax_print_btn').css("display","none");
						//window.location="bill_generation_screen1.php";
						});	*/
						
						//alert("Bill printed");
						

						
					}
					});
				}
			}else
			{
				   $.post("load_bill.php", {type:"none",grandtotal:tot,cancel:ccl,servicetx:srvt,vat:vat,servicechrg:srvc,final:final,set:'creditinsert'},
				  function(data)
				  {
				  data=$.trim(data);
				  if(data=="ok")
				  {
					  /*$.post("print_details.php", {set:'billprint'},
						function(data)
						{
						data=$.trim(data);
						$('.gotoprev').css("display","none");
						$('#disable').addClass("bill_disable_cc");
						$('#disable1').addClass("bill_disable_cc");
						$('#enableclose').css("display","block");
						$('.service_tax_print_btn').css("display","none");
						//window.location="bill_generation_screen1.php";
						});*/	
						
						//alert("Bill printed");
				  }
				  });
			}
		 
		 
		 
	 }else if($('#RadioGroup1_1').is(':checked')) 
	  { 
	  	
		 var selected_activities =$('.kot_bill_genration_btn_head>.current');
		 var prefval4="";
		 var typval="";
		  selected_activities.each(function(){
			  var pref_str4   =  $(this).attr("name");
			  var pref_arr4	  =	 pref_str4.split("_");
			   prefval4       =  pref_arr4[1];
			   
			});
			if(prefval4=="room")
			{
				typval=($('#menu02').val());
			}
			else if(prefval4=="staff")
			{
				typval=($('#menu01').val());
			}
	  	    compl="";
			var tot=$('#grandtotal').text();
			var ccl=$('#canclamt').val();
			
			if($('#menu1').val()!="" && $('#menu1').val()!="none")
			{
				var dscid=$('#menu1').val();
			}else
			{
				var dscid="";
			}
			
			if($('#menu').val()!="")
			{
				var dscid_corp=$('#menu').val();
			}else
			{
				var dscid_corp="";
			}
			if($('#discval').val()!="")
			{
				var dsc=$('#discval').val();
			}else
			{
				var dsc=0;
			}
			
			var final=$('#finalamt').text();
			var srvt=$('#servicetax').text();
			var vat=$('#vat').text();
			var srvc=$('#servicechrg').text();
			if($('#menu1').val()!="" && $('#menu1').val()!="none")
			{
				if($('#menu').val()!="")
				{
					 $.post("load_bill.php", {type:prefval4,typeva:typval,grandtotal:tot,cancel:ccl,discountid:dscid,discount_corp:dscid_corp,discount:dsc,servicetx:srvt,vat:vat,servicechrg:srvc,final:final,set:'creditinsert'},
					function(data)
					{
					data=$.trim(data);
					if(data=="ok")
					{
						/*$.post("print_details.php", {set:'billprint'},
						function(data)
						{
						data=$.trim(data);
						$('.gotoprev').css("display","none");
						$('#disable').addClass("bill_disable_cc");
						$('#disable1').addClass("bill_disable_cc");
						$('#enableclose').css("display","block");
						$('.service_tax_print_btn').css("display","none");
						//alert("Bill printed");
						
						});	*/
						
						window.location="bill_generation_screen1.php";
						
					}
					});
				}else
				{
					 $.post("load_bill.php", {type:prefval4,typeva:typval,grandtotal:tot,cancel:ccl,discountid:dscid,discount:dsc,servicetx:srvt,vat:vat,servicechrg:srvc,final:final,set:'creditinsert'},
					function(data)
					{
					data=$.trim(data);
					if(data=="ok")
					{
						/*$.post("print_details.php", {set:'billprint'},
						function(data)
						{
						data=$.trim(data);
						$('.gotoprev').css("display","none");
						$('#disable').addClass("bill_disable_cc");
						$('#disable1').addClass("bill_disable_cc");
						$('#enableclose').css("display","block");
						$('.service_tax_print_btn').css("display","none");
						//alert("Bill printed");
						
						});	*/
						window.location="bill_generation_screen1.php";
						
					}
					});
				}
			}else
			{
				 $.post("load_bill.php", {type:prefval4,typeva:typval,grandtotal:tot,cancel:ccl,servicetx:srvt,vat:vat,servicechrg:srvc,final:final,set:'creditinsert'},
				function(data)
				{
				data=$.trim(data);
				if(data=="ok")
				{
					/*$.post("print_details.php", {set:'billprint'},
						function(data)
						{
						data=$.trim(data);
						$('.gotoprev').css("display","none");
						$('#disable').addClass("bill_disable_cc");
						$('#disable1').addClass("bill_disable_cc");
						$('#enableclose').css("display","block");
						$('.service_tax_print_btn').css("display","none");
						//alert("Bill printed");
						
						});*/	
						window.location="bill_generation_screen1.php";
						
				}
				});
			}
			
	  }else if($('#RadioGroup1_2').is(':checked')) 
	   { 
	   	  credit=""; 
		  var comp=$('#completext').val();
		  var tot=$('#grandtotal').text();
			var ccl=$('#canclamt').val();
			
			if($('#menu1').val()!="" && $('#menu1').val()!="none")
			{
				var dscid=$('#menu1').val();
			}else
			{
				var dscid="";
			}
			
			if($('#menu').val()!="")
			{
				var dscid_corp=$('#menu').val();
			}else
			{
				var dscid_corp="";
			}
			
			if($('#discval').val()!="")
			{
				var dsc=$('#discval').val();
			}else
			{
				var dsc=0;
			}
			
			
			var srvt=$('#servicetax').text();
			var vat=$('#vat').text();
			var srvc=$('#servicechrg').text();
			var final=$('#finalamt').text();
			if($('#menu1').val()!="" && $('#menu1').val()!="none")
			{
				if($('#menu').val()!="")
				{
					  $.post("load_bill.php", {cmpval:comp,grandtotal:tot,cancel:ccl,discountid:dscid,discount:dsc,discount_corp:dscid_corp,servicetx:srvt,vat:vat,servicechrg:srvc,final:final,set:'complemtyinsert'},
						function(data)
						{
						data=$.trim(data);
						if(data=="ok")
						{
							/*$.post("print_details.php", {set:'billprint'},
						function(data)
						{
						data=$.trim(data);
						$('.gotoprev').css("display","none");
						$('#disable').addClass("bill_disable_cc");
						$('#disable1').addClass("bill_disable_cc");
						$('#enableclose').css("display","block");
						$('.service_tax_print_btn').css("display","none");
						//alert("Bill printed");
						
						});*/
						window.location="bill_generation_screen1.php";	
						
						}
						});
				}else
				{
					  $.post("load_bill.php", {cmpval:comp,grandtotal:tot,cancel:ccl,discountid:dscid,discount:dsc,servicetx:srvt,vat:vat,servicechrg:srvc,final:final,set:'complemtyinsert'},
						function(data)
						{
						data=$.trim(data);
						if(data=="ok")
						{
							/*$.post("print_details.php", {set:'billprint'},
						function(data)
						{
						data=$.trim(data);
						$('.gotoprev').css("display","none");
						$('#disable').addClass("bill_disable_cc");
						$('#disable1').addClass("bill_disable_cc");
						$('#enableclose').css("display","block");
						$('.service_tax_print_btn').css("display","none");
						//alert("Bill printed");
						
						});	*/
						window.location="bill_generation_screen1.php";
						
						}
						});
				}
			}else
			{
					$.post("load_bill.php", {cmpval:comp,grandtotal:tot,cancel:ccl,servicetx:srvt,vat:vat,servicechrg:srvc,final:final,set:'complemtyinsert'},
					function(data)
					{
					data=$.trim(data);
					if(data=="ok")
					{
						/*$.post("print_details.php", {set:'billprint'},
						function(data)
						{
						data=$.trim(data);
						$('.gotoprev').css("display","none");
						$('#disable').addClass("bill_disable_cc");
						$('#disable1').addClass("bill_disable_cc");
						$('#enableclose').css("display","block");
						$('.service_tax_print_btn').css("display","none");
						//alert("Bill printed");
						
						});*/	
						window.location="bill_generation_screen1.php";
						
					}
					});

			}
	   
	   }
		  
		});
	/*****************************************  print bill ends ******************************************************************  */
	
	
	
	
	
	/*****************************************  voucher starts ******************************************************************  */
	 $('#vouchid').change(function () {
		  var vcid="";
		  vcid=($('#vouchid').val());
		   $.post("load_bill.php", {vcid:vcid,set:'voucherchek'},
			function(data)
			{
			data=$.trim(data);
			if(data=="sorry")
			{
				$(".loaderror").css("display","block");
				$(".loaderror").addClass("popup_validate");
				$(".loaderror").text("This voucher does not exist");
				$('.loaderror').delay(2000).fadeOut('slow');
				
			}else 
			{
				$(".loaderror").css("display","block");
				$(".loaderror").addClass("popup_validate");
				$(".loaderror").text("Voucher applied successfully");
				$('.loaderror').delay(2000).fadeOut('slow');
				$(".popup_validate").css("color","green");
				var vv=parseFloat(data);
				$('#vocamount').val(vv);
				var grand=$('#grandtotal').text();
				 var bal=parseFloat(grand.replace(/,/g, "")) -  parseFloat(data.replace(/,/g, ""));
				 $('#vouchbal').val(bal.toFixed(2));
			}
			});
		});
	/*****************************************  voucher ends ******************************************************************  */
	
	/*****************************************  Combinede Radio clicked starts ***************************************************  */
	$(".combined").click(function() {
		  if($(this).is(':checked'))
		  {
			  var arr =0;
			   $('.combined:checked').each(function () {
				   arr++;
			   });
			  if(arr>2)
			  {
				 $(".loaderror").css("display","block");
				 $(".loaderror").addClass("popup_validate");
				 $(".loaderror").text("Not able to select more than 2");
				 $('.loaderror').delay(2000).fadeOut('slow');
			     $(this).prop("checked", false);
				
			  }else
			  {
				   var typ=($(this).val());
				   $("."+typ+"_cc").show(500);
			  }
		  }else
		  {
			  var typ=($(this).val());
			  $("."+typ+"_cc").hide(500);
		  }
	});
	/*****************************************  Combinede Radio clicked ends ***************************************************  */
	
	 /*****************************************  close bill starts ******************************************************************  */
	 $('.closetranscations').click(function () {
		
		  var pd=$('#paidamount').val();
		  var selct=$('#menu03').val();
		  
		  if(pd!="")
		  {
		  if(selct=="cash")
		  {
			  var paid=$('#paidamount').val();
			  var bal=$('#balanceamout').val();
			  if(paid==0)
			  {
				  $(".loaderror").css("display","block");
				  $(".loaderror").addClass("popup_validate");
				  $(".loaderror").text("Enter Amount");
				  $('.loaderror').delay(2000).fadeOut('slow');
			  }else
			  {
			 var data = {
				 	"set": "bill",
					"type": "cash",
					"paid": paid,
					"bal" : bal
				  };
			  }
				  
		  }else  if(selct=="credit")
		  {
			  var trans=$('#transcationid').val();
			  var bankdetails=$('#bankdetails').val();
			  if(trans!="")
			   {
					var paid=$('#paidamount').val();
					var bal=$('#balanceamout').val();
					var transbal=$('#transbal').val();
					if(transbal=='0.00' && bal=='0')
					{
					   var data = {
							  "set": "bill",
							  "type": "credit",
							  "trans" :trans,
							  "bank" :bankdetails,
							  "paid": paid,
							  "bal" : bal
							};
					}else if(transbal!='0.00' && bal!='0')
					{
						var data = {
							  "set": "bill",
							  "type": "credit",
							  "trans" :trans,
							  "bank" :bankdetails,
							  "paid": paid,
							  "bal" : bal
							};
					}else if((transbal<'0') && bal=='0')
						  {
							  var data = {
							  "set": "bill",
							  "type": "credit",
							  "trans" :trans,
							  "bank" :bankdetails,
							  "paid": paid,
							  "bal" : bal
							};
						  }
					else
					{
						 $(".loaderror").css("display","block");
						 $(".loaderror").addClass("popup_validate");
						 $(".loaderror").text("Insufficient Amount");
						 $('.loaderror').delay(2000).fadeOut('slow');
					}
				 }else
				 {
					 $(".loaderror").css("display","block");
					 $(".loaderror").addClass("popup_validate");
				     $(".loaderror").text("Enter Transcation Details");
				     $('.loaderror').delay(2000).fadeOut('slow');
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
						  if(coupbal=='0.00' && bal=='0')
						  {
								var data = {
									  "set": "bill",
									  "type": "coupon",
									  "coup" :coup,
									  "coupamnt": coupamnt,
									  "coupbal" : coupbal,
									  "paid": paid,
									  "bal" : bal
									};
						  }else if(coupbal!='0.00' && bal!='0')
						  {
							   var data = {
									  "set": "bill",
									  "type": "coupon",
									  "coup" :coup,
									  "coupamnt": coupamnt,
									  "coupbal" : coupbal,
									  "paid": paid,
									  "bal" : bal
									};
						  }else if((coupbal<'0') && bal=='0')
						  {
							   var data = {
									  "set": "bill",
									  "type": "coupon",
									  "coup" :coup,
									  "coupamnt": coupamnt,
									  "coupbal" : coupbal,
									  "paid": paid,
									  "bal" : bal
									};
						  }
						  else
						  {
							   $(".loaderror").css("display","block");
							   $(".loaderror").addClass("popup_validate");
							   $(".loaderror").text("Insufficient Amount");
							   $('.loaderror').delay(2000).fadeOut('slow');
						  }
					}else
					   {
						   $(".loaderror").css("display","block");
						    $(".loaderror").addClass("popup_validate");
			 				$(".loaderror").text("Enter Amount");
							$('.loaderror').delay(2000).fadeOut('slow');
					   }
			   }else
			   {
				   $(".loaderror").css("display","block");
				   $(".loaderror").addClass("popup_validate");
			 		$(".loaderror").text("Select Coupon");
					$('.loaderror').delay(2000).fadeOut('slow');
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
						
						 if(vouchbal=='0.00' && bal=='0')
						  {
							  var data = {
							  "set": "bill",
							  "type": "voucher",
							  "vouchid" :vouchid,
							  "vocamount": vocamount,
							  "vouchbal" : vouchbal,
							  "paid": paid,
							  "bal" : bal
							};
						  }else if((vouchbal!='0.00') && bal!='0')
						  {
							  
							  var data = {
							  "set": "bill",
							  "type": "voucher",
							  "vouchid" :vouchid,
							  "vocamount": vocamount,
							  "vouchbal" : vouchbal,
							  "paid": paid,
							  "bal" : bal
							};
						  }else if((vouchbal<'0') && bal=='0')
						  {
							   var data = {
							  "set": "bill",
							  "type": "voucher",
							  "vouchid" :vouchid,
							  "vocamount": vocamount,
							  "vouchbal" : vouchbal,
							  "paid": paid,
							  "bal" : bal
							};
						  }
						  else
						  {
							   $(".loaderror").css("display","block");
							   $(".loaderror").addClass("popup_validate");
							   $(".loaderror").text("Insufficient Amount");
							   $('.loaderror').delay(2000).fadeOut('slow');
						  }	
							
							
				   }
				else
			   {
				   $(".loaderror").css("display","block");
				   $(".loaderror").addClass("popup_validate");
			 		$(".loaderror").text("Enter Voucher");
					$('.loaderror').delay(2000).fadeOut('slow');
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
							
							
							if(cheqbal=='0.00' && bal=='0')
						  {
							  var data = {
								  "set": "bill",
								  "type": "cheque",
								  "cheqbank" :cheqbank,
								  "cheqname": cheqname,
								  "cheqamt": cheqamt,
								  "paid": paid,
								  "bal" : bal
								};
						  }else if((cheqbal!='0.00') && bal!='0')
						  {
							  
							  var data = {
								  "set": "bill",
								  "type": "cheque",
								  "cheqbank" :cheqbank,
								  "cheqname": cheqname,
								  "cheqamt": cheqamt,
								  "paid": paid,
								  "bal" : bal
								};
						  }else if((cheqbal<'0') && bal=='0')
						  {
							   var data = {
								  "set": "bill",
								  "type": "cheque",
								  "cheqbank" :cheqbank,
								  "cheqname": cheqname,
								  "cheqamt": cheqamt,
								  "paid": paid,
								  "bal" : bal
								};
						  }
						  else
						  {
							   $(".loaderror").css("display","block");
							   $(".loaderror").addClass("popup_validate");
							   $(".loaderror").text("Insufficient Amount");
							   $('.loaderror').delay(2000).fadeOut('slow');
						  }	
							
							
							
						}else
						{
							$(".loaderror").css("display","block");
							$(".loaderror").addClass("popup_validate");
							$(".loaderror").text("Enter Cheque Amount");
							$('.loaderror').delay(2000).fadeOut('slow');
						}
					}else
					 {
						 $(".loaderror").css("display","block");
						 $(".loaderror").addClass("popup_validate");
			 			$(".loaderror").text("Enter Bank Name");
						$('.loaderror').delay(2000).fadeOut('slow');
					 }
			   }else
			   {
				   $(".loaderror").css("display","block");
				    $(".loaderror").addClass("popup_validate");
			 		$(".loaderror").text("Enter Check Number");
					$('.loaderror').delay(2000).fadeOut('slow');
			   }
		  }
		else if(selct=="comb")
		{
			var ids=new Array();
			$('.combined:checked').each(function () {
				    if(selval!='undefined' && selval!='' && selval!=null){
					  ids.push($('.combined').val());
				  }
			   });
			   alert(ids);
			
		}else
		{
			$(".loaderror").css("display","block");
			$(".loaderror").addClass("popup_validate");
			$(".loaderror").text("Enter Amount");
			$('.loaderror').delay(2000).fadeOut('slow');
		}
		  }else
		{
			/*var bal;
			if(selct=="cash")
			{
			 bal=$('#balanceamout').val();
			}else  if(selct=="credit")
			{
			 bal=$('#balanceamout').val();
			}else if(selct=="coupon")
			{
			  bal=$('#balanceamout').val();
			}else if(selct=="voucher")
			{
			  bal=$('#balanceamout').val();
			}else if(selct=="cheque")
			{
			 bal=$('#balanceamout').val();
			}
			if(bal=='0.00')
			{*/
			$(".loaderror").css("display","block");
			$(".loaderror").addClass("popup_validate");
			$(".loaderror").text("Enter Amount");
			$('.loaderror').delay(2000).fadeOut('slow');
			//}
		}
		  
		     data = $(this).serialize() + "&" + $.param(data);
			 $.ajax({
					type: "POST",
					url: "load_bill.php",
					data: "page=1"+data,
					success: function(msg)
					{
						window.location="bill_generation_screen1.php?pend=selected";
					}
				});
		});
	/*****************************************  close bill ends ******************************************************************  */
		   

	});
	
	/*****************************************  calculation starts ******************************************************************  */
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
			{
				 $(".loaderror").css("display","block");
				 $(".loaderror").addClass("popup_validate");
			 	 $(".loaderror").text("Incorrect Coupon Amount");
				 $('.loaderror').delay(2000).fadeOut('slow');
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
			{
				 $(".loaderror").css("display","block");
				 $(".loaderror").addClass("popup_validate");
			 	$(".loaderror").text("Incorrect Cheque Amount");
				$('.loaderror').delay(2000).fadeOut('slow');
			}else
			{
			document.getElementById("cheqbal").value=tt.toFixed(2);
			}
		}
		function transamountchange()
		{
			var tt=0;
			var gd=parseFloat($('#grandtotal').text().replace(/,/g, ""));
			var dc=parseFloat($('#transcationid').val().replace(/,/g, ""));
			tt = parseFloat(gd -  dc); 
			if(tt<0)
			{
				 $(".loaderror").css("display","block");
				 $(".loaderror").addClass("popup_validate");
			 	$(".loaderror").text("Incorrect Transcation Amount");
				$('.loaderror').delay(2000).fadeOut('slow');
			}else
			{
			document.getElementById("transbal").value=tt.toFixed(2);
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
			 {
				 $(".loaderror").css("display","block");
				 $(".loaderror").addClass("popup_validate");
			 	$(".loaderror").text("Insufficient Amount");
				$('.loaderror').delay(2000).fadeOut('slow');
				$('#balanceamout').val('');
				
			 }else
			 {
					$('#balanceamout').val(bal.toFixed(2));
			 }
		  
	  }
	/*****************************************  balance calc ends ******************************************************************  */