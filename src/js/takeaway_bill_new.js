$(document).ready(function(){
	$('#selectcreditypes').change(function () {	
			  var credittype=	$(this).val();//alert(credittype)
			  if(credittype!='')
			  {
				  
			 $('.credtitypeloads').html('<img src="img/ajax-loaders/ajax-loader-6.gif" />');
			 var labelname=$("#selectcreditypes").find('option:selected').attr('label');
				  $.post("load_takeaway.php", {credittype:credittype,value:'loadcreditypes'},
				  function(data)
				  {
					 //alert(data);
				  $('#crtype_div').show();	  
				  $('#credit_staff_val').html(data);	
				  $('#labelcr_type').html(labelname);	
				  
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
						 
					 var grnd=$('#ta_loadtakbillamount').text();
					$('#amount_credit').val(grnd); 
					 }
					  
				   }
				  
				    
				  });
			  }
	});	
	
$('#ta_staffclose').click(function (event) {
			var selct=$('#ta_payemntmode').val();
			var selected_activities =$('.tr_bill_gen_active');
		//	alert('d');
			var billno = new Array(); 
			var tableid = new Array();
			var prefid = new Array();
			var stafbill =$('.order_detail_active').find('.staf_code').text();
			var linkname=$('#deltval').val();
			//alert(linkname);

             if(stafbill=="")
		     {
			stafbill=$('#ta_loadtakbill').text();
		    }
			var data;
			 var typenam=$("#ta_payemntmode").find('option:selected').attr('idval');

			 if(typenam=="6") 
			  { 
					  var creditype=$('#selectcreditypes').val();
					  var creditdeatils=$('#selectcreditdetails').val();
					  var paidamount_credit=$('#paidamount_credit').val();
					  var amount_credit=$('#amount_credit').val();
					  var balanceamout_credit=$('#balanceamout_credit').val();
					//  alert(amount_credit);
					 
					  if(creditype!='')
					  {
						  if(creditdeatils!='')
						  {
							   data = {
								  "set"					: "bill",
				  	              "type"                : typenam,
								  "billno" 				: stafbill,
								  "creditype"			: creditype,
								  "creditdeatils"		: creditdeatils,
								  "paidamount_credit"	: paidamount_credit,
								  "amount_credit"		: amount_credit,
								  "bal"					: balanceamout_credit
								};
							  
						  }else
						  {
							  var labelname=$("#selectcreditypes").find('option:selected').attr('label');
							  $(".loaderror").css("display","block");
							  $(".loaderror").addClass("popup_validate");
							  $(".loaderror").text("Select "+labelname);
							  $('.loaderror').delay(2000).fadeOut('slow');
						  }
					  }else
					  {
						  $(".loaderror").css("display","block");
						  $(".loaderror").addClass("popup_validate");
						  $(".loaderror").text("Select credit Types");
						  $('.loaderror').delay(2000).fadeOut('slow');
					  }
							
						
					
			  }else if(typenam=="7")
				{
		  			var comp=$('#completext').val();//alert(comp)
					if(comp!='')
					  {
						   data = {
								  "set"			: "bill",
								  "type"		: typenam,
								  "billno" 		: stafbill,
								  "comp"		: comp
								};
						  
					  }else
					  {
						  $(".loaderror").css("display","block");
						  $(".loaderror").addClass("popup_validate");
						  $(".loaderror").text("Add Complimentary Remarks");
						  $('.loaderror').delay(2000).fadeOut('slow');
					  }
	   
			
				}else if(typenam=="8")
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
								{
									$(".loaderror").css("display","block");
									$(".loaderror").addClass("popup_validate");
									$(".loaderror").text("Add Complimentary Remarks");
									$('.loaderror').delay(2000).fadeOut('slow');
								}
							}else
							{
								$(".loaderror").css("display","block");
								$(".loaderror").addClass("popup_validate");
								$(".loaderror").text("Select Staff");
								$('.loaderror').delay(2000).fadeOut('slow');
							}
						
					}else
					{
						 
						  if(comp!='')
							{
								 data = {
										"set"			: "bill",
										"type"		    : typenam,
										"billno" 		: stafbill,
										"comp"		    : comp,
										"staff"         :staff
									  };
									
								
							}else
							{
								$(".loaderror").css("display","block");
								$(".loaderror").addClass("popup_validate");
								$(".loaderror").text("Add Complimentary Remarks");
								$('.loaderror').delay(2000).fadeOut('slow');
							}
					}
	   
			
				}
			
			
			
			
			 data = $(this).serialize() + "&" + $.param(data);
			$.ajax({
					type: "POST",
					url: "load_takeaway.php",
			        data: "value=ta_billsubmit"+data+"&linkname="+linkname,
			  	    success: function(msg)
					{
						//alert('ok');
						 $('.new_alert_cc').css('display','block');
				         $('.confirm_detail_con_pop').css('display','block');
				         $('.confirm_detail_con_pop').html(msg);
				         $('.new_alert_cc').delay(2000).fadeOut('slow');
				         // window.location=linkname;
				        setTimeout(function(){window.location =linkname}, 1000);
					}
				});
	
	
		});
});

	
	function enterbalance_credit()
	  { 
	  	var paid=$('#paidamount_credit').val();
		  var letterNumber = /^[0-9]+$/; 
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
	  
	  
