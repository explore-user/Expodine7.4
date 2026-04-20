// JavaScript Document
$(document).ready(function(){
	/*************************************** Take away staff selection starts ************************************************* */ 
	$('#ta_staffsubmit').click(function (e) {
		
		var selct=($('#ta_payemntmode').val());
		 var typenam=$("#ta_payemntmode").find('option:selected').attr('idval');
		 var pd=$('#paidamount').val();
		 var linkname=$('#deltval').val();
		 //alert(selct + pd);
		var stafbill =$('.order_detail_active').find('.staf_code').text();
		if(stafbill=="")
		{
			stafbill=$('#ta_loadtakbill').text();
		}
		  if(pd!="")
		  {
			if(isFloat(pd))
						{  
		  if(typenam=="1")
		  {
			  var paid=$('#paidamount').val();
			  var bal=$('#balanceamout').val();
			 var data = {
				 	"set": "bill",
					"type": typenam,
					"bilno":stafbill,
					"paid": paid,
					"bal" : bal
				  };
				  
		  }else  if(typenam=="2")
		  {
			   var bankid=$('#bankdetails').val();
			  var paid=$('#paidamount').val();
			  var bal=$('#balanceamout').val();
			  var trans=$('#transcationid').val();
			 var data = {
				 	"set": "bill",
					"type": typenam,
					"bilno":stafbill,
					"bank":bankid,
					"trans" :trans,
					"paid": paid,
					"bal" : bal
				  };
		  }else if(typenam=="3")
		  {
			  var coup=$('#coupnsel').val();
			  if(coup!="")
			   {
					var coupamnt=$('#coupamount').val();
					if(coupamnt!="")
			   		{
						  var coupbal=$('#coupbal').val();
						  var paid=$('#paidamount').val();
						  var bal=$('#balanceamout').val();
						  var data = {
								"set": "bill",
								"type": typenam,
								"coup" :coup,
								"bilno":stafbill,
								"coupamnt": coupamnt,
								"coupbal" : coupbal,
								"paid": paid,
								"bal" : bal
							  };
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
		  }else if(typenam=="4")
		  {
			  var vouchid=$('#vouchid').val();
			  if(vouchid!="")
			   		{
			  var vocamount=$('#vocamount').val();
			   var vouchbal=$('#vouchbal').val();
			   var paid=$('#paidamount').val();
			  var bal=$('#balanceamout').val();
			  var data = {
					"set": "bill",
					"type": typenam,
					"vouchid" :vouchid,
					"vocamount": vocamount,
					"bilno":stafbill,
					"vouchbal" : vouchbal,
					"paid": paid,
					"bal" : bal
				  };
				   }
				else
			   {
				   $(".loaderror").css("display","block");
				   $(".loaderror").addClass("popup_validate");
			 		$(".loaderror").text("Enter Voucher");
					$('.loaderror').delay(2000).fadeOut('slow');
			   }	  
			  
		  }else if(typenam=="5")
		  {
			   var cheqbank=$('#cheqbank').val();
			   var cheqname=$('#cheqname').val();
			   var cheqamt=$('#cheqamount').val();
			   if(cheqname!="")
			   {
					if(cheqbank!="")
			   		{
						if(cheqamt!="")
			   			{
							var paid=$('#paidamount').val();
							var bal=$('#balanceamout').val();
							 var data = {
								  "set": "bill",
								  "type": typenam,
								  "cheqbank" :cheqbank,
								  "cheqname": cheqname,
								  "bilno":stafbill,
								  "cheqamt": cheqamt,
								  "paid": paid,
								  "bal" : bal
								};
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
			  $(".loaderror").css("display","block");
			$(".loaderror").addClass("popup_validate");
			$(".loaderror").text("Enter Correct Amount");
			$('.loaderror').delay(2000).fadeOut('slow');
		  }}else
		  {
			  $(".loaderror").css("display","block");
			$(".loaderror").addClass("popup_validate");
			$(".loaderror").text("Enter Amount");
			$('.loaderror').delay(2000).fadeOut('slow');
		  }
		  
	   data = $(this).serialize() + "&" + $.param(data);
	   //alert(data);
	   $.ajax({
			  type: "POST",
			  url: "load_takeaway.php",
			  data: "value=ta_billsubmit"+data+"&linkname="+linkname,
			  success: function(msg)
			  {
			  $('.loaderror').css('display','block');
			  $('.loaderror').html('Closed');
			  $('.loaderror').delay(2000).fadeOut('slow');
				 //$('.new_alert_cc').css('display','block');
				 //$('.confirm_detail_con_pop').css('display','block');
				 //$('.confirm_detail_con_pop').html(msg);
				 //$('.new_alert_cc').delay(2000).fadeOut('slow');
				// window.location=linkname;
				 setTimeout(function(){window.location =linkname}, 1000);
				 
			  }
		  });
		
		
		return false;
  	});
	/***************************************  Take away staff selection  ends *************************************************  */
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
				var grand=$('.ta_totalcashtopay').text();
				 if(grand=="")
				  {
					  grand=$('#ta_loadtakbillamount').text();
				  }
				 var bal=parseFloat(grand.replace(/,/g, "")) -  parseFloat(data.replace(/,/g, ""));
				 $('#vouchbal').val(bal.toFixed(2));
				 if(bal<0)
				 {
					  $('#paidamount').val('0.00');
			  		$('#balanceamout').val('0.00');
				 }
			}
			});
		});
	/*****************************************  voucher ends ******************************************************************  */
	
	});
	/*****************************************  balance calc starts ******************************************************************  */
	function enterbalance()
	  {
		 
	  	var paid=$('#paidamount').val();
		 var grand=$('.ta_totalcashtopay').text();
		 if(grand=="")
		{
			grand=$('#ta_loadtakbillamount').text();
		}
		 //alert("h");
		 var mode=$('#ta_payemntmode').val();
		 if(mode=="cash")
		 {
			 var bal=parseFloat(paid.replace(/,/g, "")) -  parseFloat(grand.replace(/,/g, ""));
		 }else if(mode=="credit")
		 {
		   if($('#transbal').val()!="")
		   {
			   var subt=$('#transbal').val();
			   var bal=parseFloat(paid.replace(/,/g, "")) -  parseFloat(subt.replace(/,/g, ""));
			   
		   }
		 }else if(mode=="coupon")
		 {
		   if($('#coupbal').val()!="")
		   {
			   var subt=$('#coupbal').val();
			   var bal=parseFloat(paid.replace(/,/g, "")) -  parseFloat(subt.replace(/,/g, ""));
			   
		   }
		 }
		 else if(mode=="voucher")
		 {
		   if($('#vouchbal').val()!="")
		   {
			   var subt=$('#vouchbal').val();
			   var bal=parseFloat(paid.replace(/,/g, "")) -  parseFloat(subt.replace(/,/g, ""));
			   
		   }
		 }
		 else if(mode=="cheque")
		 {
		   if($('#cheqbal').val()!="")
		   {
			   var subt=$('#cheqbal').val();
			   var bal=parseFloat(paid.replace(/,/g, "")) -  parseFloat(subt.replace(/,/g, ""));
			   
		   }
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
					$('#balanceamout').focus();
					
			 }
		  
	  }
	/*****************************************  balance calc ends ******************************************************************  */
	
	function transamountchange()
		{
			var tt=0;
			var gd=parseFloat($('.ta_totalcashtopay').text().replace(/,/g, ""));
			//alert("dasdas"+gd+"dfgdfg");
			 if(isNaN(gd))
			{
			gd=$('#ta_loadtakbillamount').text();
			}
			
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
			$("#paidamount").focus();
			}
		}
		function submitform()
		{
			$('#ta_staffsubmit').click();
		}
		function totamountfocus()
		{
			$('#paidamount').focus();
		}
		function couponamountchange()
		{
			var tt=0;
			var gd=parseFloat($('.ta_totalcashtopay').text().replace(/,/g, ""));
			if(isNaN(gd))
			{
			gd=$('#ta_loadtakbillamount').text();
			}
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
			var gd=parseFloat($('.ta_totalcashtopay').text().replace(/,/g, ""));
			if(isNaN(gd))
			{
			gd=$('#ta_loadtakbillamount').text();
			}
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
			$('#paidamount').focus();
			}
		}
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
function isFloat(n) {
return parseFloat(n.match(/^-?\d*(\.\d+)?$/))>0;
}

