// JavaScript Document

$(document).ready(function(){
	
 $('#creditypeslist').change(function () {
             
		var creditype=$("#creditypeslist").val();
		var labelname=$("#creditypeslist").find('option:selected').attr('label'); 
                
		 $.post("load_credit.php", {type:creditype,set:'loadtablehead'},
			function(data)
			{   
				data=$.trim(data);
				$('#loadtablecredithead').html(data)
				$('.loadtype').html(labelname);	
				
				$.post("load_credit.php", {type:creditype,set:'loadcreditdetails'},
				function(datas)
				{
				datas=$.trim(datas);
				$('.loadcreditwholelist').html(datas)
				$('.viewpayment').css("display","none")
				 
				}); 
			 
			});
			
			
  });
			  
	/***************************************  credit type change ends **********************************************************  */
	
	
	 /***************************************  auto refresh starts **********************************************************  */
//	 setInterval(function() { 
//	
//	 var creditype=$("#creditypeslist").val();
//	 var id_str       =  $('.tr_bill_gen_active').attr("crdit");
//	 
//	var labelname=$("#creditypeslist").find('option:selected').attr('label'); 
//			$.post("load_credit.php", {type:creditype,sel:id_str,set:'loadcreditdetails'},
//			function(datas)
//			{
//			datas=$.trim(datas);
//			$('.loadcreditwholelist').html(datas)
//			 
//			}); 
//	 
//	  }, 6000); 
          
 /**********  auto refresh ends *********  */
 
	
        /**********  thermal print *********  */
        
        
   $('.closetranscations5').click(function () { 
          
                var creditmsg1 = ($("#creditmsg1").val());
                var creditmsg2 = ($("#creditmsg2").val());
                var creditmsg3 = ($("#creditmsg3").val());
		var payemntmode_sel =$('#payemntmode_sel').val();
		
                var credino = $('.loadpay').attr("credino");
                
		if(payemntmode_sel!='')
		{
		
                        var pd=$('.loadpay').text();
                        var selct=$('#payemntmode_sel').val();
                        var pd1=$('#paidamount').val();
		  
		        var ids=new Array();  var rts=new Array(); 
			var selected_activities =$("[name='selectbills[]']:checked");
                        
			selected_activities.each(function(){
                            
			  var id_str       =  $(this).attr("bilnos");
                          
                          
			  if(id_str!='undefined' && id_str!='' && id_str!=null){
				ids.push(id_str);
			  }
                          
                          var rate_str       =  $(this).attr("rate");
                          
                          
			  if(rate_str!='undefined' && rate_str!='' && rate_str!=null && rate_str>0){
				rts.push(rate_str);
			  }
     
				
			});
               
		  var typenam=$("#payemntmode_sel").find('option:selected').attr('idval');
                  
                  var trans5=$('#transcationid').val();
                   
		  if(pd1!="" || trans5!='' )
		  {  
                    
		  if(selct=="cash")
		  {
			 var paid=parseFloat($('#paidamount').val());
			 var bal=parseFloat($('#balanceamout').val());
                         var  pd2=parseFloat($('.loadpay').text());
                        
			 if(paid==0 || paid=='')
			  {
  
                              $('.alert_error_popup_all_in_one').show();
                                    
                              $('.alert_error_popup_all_in_one').text('ENTER AMOUNT');
                              $('.alert_error_popup_all_in_one').delay(1000).fadeOut('slow');
                          }

                           else
			  {
                              
                             
                         
                        if( (ids.length>1 && bal>=0) || ids.length==1){
                                
                                          
                        var paid_partial= parseFloat($('.paid_crd_partail').html());	
				
			var bal_partial=    parseFloat($('.bal_pay_crd').html());        
                        
                        var  tot_partial=parseFloat($('.loadpay').text());
                                
                        
			      var data = {
				 	"set"		: "credit_settle_print_partial",
					"type"		: selct,
					"credino"       : credino,
					"billno" 	: ids,
					"typenam"	: typenam,
					"paid"		: paid,
					"bal" 		: bal,
                                        "paid_partial" 	: paid_partial,
                                        "bal_partial" 	: bal_partial,
                                        "tot_partial" 	: tot_partial,
                                        "rates" 	: rts,
                                         "bill"         : pd,
                                         "mode"         :selct,
                                         "id"           :ids
				  };
                        
                    }else{
                             $('.alert_error_popup_all_in_one').hide(); 
                             
                             setTimeout(function () {   
                                 
                              $('.alert_error_popup_all_in_one').show();
                              $('.alert_error_popup_all_in_one').text('INSUFFICIENT AMOUNT ');
                              $('.alert_error_popup_all_in_one').delay(1000).fadeOut('slow');
                              $('#paidamount').focus();
                              
                            }, 1000);    
                        
                   }
                           
                           
		   }
				  
		  }else  if(selct=="credit")
		  {  
                      
                      
			  var trans=$('#transcationid').val();
			  var bankdetails=$('#bankdetails').val();
			  if(trans!="")
			   {
					var paid=parseFloat($('#paidamount').val());
					var bal=parseFloat($('#balanceamout').val());
					var transbal=parseFloat($('#transbal').val());
                                        
                                        
                        var paid_partial= parseFloat($('.paid_crd_partail').html());	
				
			var bal_partial=    parseFloat($('.bal_pay_crd').html());        
                        
                        var  tot_partial=parseFloat($('.loadpay').text());
                                        
                        if( (ids.length>1 && transbal==0) || ids.length==1){
                           
                                        
					if(transbal==0 && bal==0)
					{ 
                                            
					   var data = {
							 "set"		: "credit_settle_print_partial",
							  "type"	: selct,
							  "credino"     :credino,
							  "billno" 	: ids,
							  "typenam"	: typenam,
							  "trans" :trans,
							  "bank" :bankdetails,
							  "paid": paid,
							  "bal" : bal,
                                                          "paid_partial" 	: paid_partial,
                                                            "bal_partial" 	: bal_partial,
                                                            "tot_partial" 	: tot_partial,
                                                            "rates" 	    : rts,
                                                             "bill"         : pd,
                                                             "mode"         :selct,
                                                             "id"           :ids
							};
                                                      
                                             
                                               
					}
                                       // else if(transbal>0 && bal>=0)
					else if(transbal>=0 ){
                                           
						var data = {
							  "set"		 : "credit_settle_print_partial",
							  "type"	 : selct,
							  "credino"      :credino,
							  "billno" 	 : ids,
							  "typenam"	 : typenam,
							  "trans"        : trans,
							  "bank"         : bankdetails,
							  "paid"         : paid,
							  "bal"          : bal,
                                                          "paid_partial" : paid_partial,
                                                          "bal_partial"  : bal_partial,
                                                          "tot_partial"  : tot_partial,
                                                          "rates" 	 : rts,
                                                          "bill"         : pd,
                                                          "mode"         :selct,
                                                          "id"           :ids
							};
                                                   
                                                        
                                          
                                               
					}
                                        else if((transbal<0) && bal==0)
						  { 
                                                     
							  var data = {
							  "set"		: "credit_settle_print_partial",
							  "type"	: selct,
							  "credino"     :credino,
							  "billno" 	: ids,
							  "typenam"	: typenam,
							  "trans" :trans,
							  "bank" :bankdetails,
							  "paid": paid,
							  "bal" : bal,
                                                          "paid_partial" 	: paid_partial,
                                        "bal_partial" 	: bal_partial,
                                        "tot_partial" 	: tot_partial,
                                        "rates" 	: rts,
                                         "bill"         : pd,
                                         "mode"         :selct,
                                         "id"           :ids
							};
                                 
			}
			else
			{
                    
                                $('.alert_error_popup_all_in_one').show();

                                $('.alert_error_popup_all_in_one').text('INSUFFICIENT');
                                $('.alert_error_popup_all_in_one').delay(1000).fadeOut('slow');
                                $('#paidamount').focus();
                        
			}
                        
                        
                        }else{
                                     
                                    $('.alert_error_popup_all_in_one').hide();
                                    
                                   
                                    
                     setTimeout(function () {     
                          $('.alert_error_popup_all_in_one').show();
                                    
                         $('.alert_error_popup_all_in_one').text('INSUFFICIENT AMOUNT ');
                         $('.alert_error_popup_all_in_one').delay(1000).fadeOut('slow');
                         $('#transcationid').focus();
                        
                    }, 1000);   
                                    
                                    
                                    
			}
                        
                        
                        
			}else{
                                     
                                    $('.alert_error_popup_all_in_one').show();
                                    
                                    $('.alert_error_popup_all_in_one').text('DETAILS');
                                    $('.alert_error_popup_all_in_one').delay(1000).fadeOut('slow');
                                     $('#transcationid').focus();
                                    
			}
                        
		 }else
		 {
			$(".error_feed").css("display","block");
			$(".error_feed").addClass("popup_validate");
			$(".error_feed").text("Enter Amount");
			$('.error_feed').delay(2000).fadeOut('slow');
		 }
                
		}else{
			
                       $('.alert_error_popup_all_in_one').show();
                       $('.alert_error_popup_all_in_one').text('ENTER AMOUNT');
                       $('.alert_error_popup_all_in_one').delay(1000).fadeOut('slow');
		       $('#paidamount').focus();
		}
		  
                  
                  
                  
                 if(pd1>0 || trans>0)
		 {  
                              $('.alert_error_popup_all_in_one').show();
                              $('.alert_error_popup_all_in_one').text('SETTLING');
                              $('.alert_error_popup_all_in_one').delay(10000).fadeOut('slow');
                              
                 }else{
                     
                       $('.alert_error_popup_all_in_one').show();
                       $('.alert_error_popup_all_in_one').text('ENTER AMOUNT');
                       $('.alert_error_popup_all_in_one').delay(1000).fadeOut('slow');
                     
                 }
                 
                 
		         data = $(this).serialize() + "&" + $.param(data);
            
			 $.ajax({
					type: "POST",
					url: "load_credit.php",
					data: data,
					success: function(msg)
					{
                                        
                                       //  alert(msg);
						var creditype=$("#creditypeslist").find('option:selected').val();
						
						$.post("load_credit.php", {type:creditype,set:'loadcreditdetails'},
							function(datas)
							{
                                                              
							  datas=$.trim(datas);
							  $('.loadcreditwholelist').html(datas)
							  $('.viewpayment').css("display","none")
							   
							});
                                                          
						$('#payemntmode_sel').find('option:first').attr('selected', 'selected');	  
					  
						$.post("load_credit.php", {id:credino,set:'loadbilldetails'},
						function(datas)
						{
                                                    
						datas=$.trim(datas);
						$('.loadeachcreditbildetails').html(datas)
						$('.viewpayment').css("display","none");
						 
						}); 
						
						
						$('.loadpay').html('');
						$(".cash_cc").hide();
						$(".credit_cc_normal").hide();
						$(".credit_cc").hide();
						$(".coupon_cc").hide();
						$(".voucher_cc").hide();
						$(".cheque_cc").hide();
						$(".auto1").hide();
						$(".auto").hide();
						
						$('.grandtotal').text('');	
						
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
						  
                                                  
                                             setTimeout(function () {    
		                                window.location.href='credit.php';
					     }, 1500);   
                                                
					}
                                        
				});
		}else
		{
			$(".error_feed").css("display","block");
			$(".error_feed").addClass("popup_validate");
			$(".error_feed").text(creditmsg1);
			$('.error_feed').delay(2000).fadeOut('slow');
                        
                        $('.alert_error_popup_all_in_one').show();
                        $('.alert_error_popup_all_in_one').text('SELECT TYPE');
                        $('.alert_error_popup_all_in_one').delay(1000).fadeOut('slow');
		}
                
  });     
        
        
        
   $('.closetranscations1').click(function () { 
          
                var creditmsg1 = ($("#creditmsg1").val());
                var creditmsg2 = ($("#creditmsg2").val());
                var creditmsg3 = ($("#creditmsg3").val());
		var payemntmode_sel =$('#payemntmode_sel').val();
		
                var credino = $('.loadpay').attr("credino");
                
		if(payemntmode_sel!='')
		{
		
                        var pd=$('.loadpay').text();
                        var selct=$('#payemntmode_sel').val();
                        var pd1=$('#paidamount').val();
		  
		        var ids=new Array();  var rts=new Array(); 
			var selected_activities =$("[name='selectbills[]']:checked");
                        
			selected_activities.each(function(){
                            
			  var id_str       =  $(this).attr("bilnos");
                          
                          
			  if(id_str!='undefined' && id_str!='' && id_str!=null){
				ids.push(id_str);
			  }
                          
                          var rate_str       =  $(this).attr("rate");
                          
                          
			  if(rate_str!='undefined' && rate_str!='' && rate_str!=null && rate_str>0){
				rts.push(rate_str);
			  }
     
				
			});
               
		  var typenam=$("#payemntmode_sel").find('option:selected').attr('idval');
                  
                  var trans5=$('#transcationid').val();
                   
		  if(pd1!="" || trans5!='' )
		  {  
                    
		  if(selct=="cash")
		  {
			 var paid=parseFloat($('#paidamount').val());
			 var bal=parseFloat($('#balanceamout').val());
                         var  pd2=parseFloat($('.loadpay').text());
                        
			 if(paid==0 || paid=='')
			  {
  
                              $('.alert_error_popup_all_in_one').show();
                                    
                              $('.alert_error_popup_all_in_one').text('ENTER AMOUNT');
                              $('.alert_error_popup_all_in_one').delay(1000).fadeOut('slow');
                          }
//			 else if(paid<pd2){
//                             
//                               $('.alert_error_popup_all_in_one').show();
//
//                               $('.alert_error_popup_all_in_one').text('ENTER VALID AMOUNT');
//                               $('.alert_error_popup_all_in_one').delay(1000).fadeOut('slow');
//                        
//                      }
                      else
			  {
                              
                             
                          
                        if( (ids.length>1 && bal==0) || ids.length==1){
                                
                                          
                        var paid_partial= parseFloat($('.paid_crd_partail').html());	
				
			var bal_partial=    parseFloat($('.bal_pay_crd').html());        
                        
                        var  tot_partial=parseFloat($('.loadpay').text());
                                
                        
			      var data = {
				 	"set"		: "credit_settle_print",
					"type"		: selct,
					"credino"       : credino,
					"billno" 	: ids,
					"typenam"	: typenam,
					"paid"		: paid,
					"bal" 		: bal,
                                        "paid_partial" 	: paid_partial,
                                        "bal_partial" 	: bal_partial,
                                        "tot_partial" 	: tot_partial,
                                        "rates" 	: rts,
                                         "bill"         : pd,
                                         "mode"         :selct,
                                         "id"           :ids
				  };
                        
                    }else{
                             $('.alert_error_popup_all_in_one').hide(); 
                             
                             setTimeout(function () {   
                                 
                              $('.alert_error_popup_all_in_one').show();
                              $('.alert_error_popup_all_in_one').text('INSUFFICIENT AMOUNT ');
                              $('.alert_error_popup_all_in_one').delay(1000).fadeOut('slow');
                              $('#paidamount').focus();
                              
                            }, 1000);    
                        
                   }
                           
                           
		   }
				  
		  }else  if(selct=="credit")
		  {  
                      
                      
			  var trans=$('#transcationid').val();
			  var bankdetails=$('#bankdetails').val();
			  if(trans!="")
			   {
					var paid=parseFloat($('#paidamount').val());
					var bal=parseFloat($('#balanceamout').val());
					var transbal=parseFloat($('#transbal').val());
                                        
                                        
                        var paid_partial= parseFloat($('.paid_crd_partail').html());	
				
			var bal_partial=    parseFloat($('.bal_pay_crd').html());        
                        
                        var  tot_partial=parseFloat($('.loadpay').text());
                                        
                       if( (ids.length>1 && transbal==0) || ids.length==1){
                           
                                        
					if(transbal==0 && bal==0)
					{ 
                                            
					   var data = {
							 "set"		: "credit_settle_print",
							  "type"		: selct,
							  "credino"   :credino,
							  "billno" 	: ids,
							  "typenam"	: typenam,
							  "trans" :trans,
							  "bank" :bankdetails,
							  "paid": paid,
							  "bal" : bal,
                                                          "paid_partial" 	: paid_partial,
                                        "bal_partial" 	: bal_partial,
                                        "tot_partial" 	: tot_partial,
                                        "rates" 	: rts,
                                         "bill"         : pd,
                                         "mode"         :selct,
                                         "id"           :ids
							};
                                                      
                                             
                                               
					}
                                       // else if(transbal>0 && bal>=0)
					else if(transbal>=0 ){
                                           
						var data = {
							  "set"		: "credit_settle_print",
							  "type"		: selct,
							  "credino"   :credino,
							  "billno" 	: ids,
							  "typenam"	: typenam,
							  "trans" :trans,
							  "bank" :bankdetails,
							  "paid": paid,
							  "bal" : bal,
                                                          "paid_partial" 	: paid_partial,
                                        "bal_partial" 	: bal_partial,
                                        "tot_partial" 	: tot_partial,
                                        "rates" 	: rts,
                                         "bill"         : pd,
                                         "mode"         :selct,
                                         "id"           :ids
							};
                                                   
                                                        
                                          
                                               
					}
                                        else if((transbal<0) && bal==0)
						  { 
                                                     
							  var data = {
							  "set"		: "credit_settle_print",
							  "type"	: selct,
							  "credino"     :credino,
							  "billno" 	: ids,
							  "typenam"	: typenam,
							  "trans" :trans,
							  "bank" :bankdetails,
							  "paid": paid,
							  "bal" : bal,
                                                          "paid_partial" 	: paid_partial,
                                        "bal_partial" 	: bal_partial,
                                        "tot_partial" 	: tot_partial,
                                        "rates" 	: rts,
                                         "bill"         : pd,
                                         "mode"         :selct,
                                         "id"           :ids
							};
                                 
			}
			else
			{
                    
                                $('.alert_error_popup_all_in_one').show();

                                $('.alert_error_popup_all_in_one').text('INSUFFICIENT');
                                $('.alert_error_popup_all_in_one').delay(1000).fadeOut('slow');
                                $('#paidamount').focus();
                        
			}
                        
                        
                        }else{
                                     
                                    $('.alert_error_popup_all_in_one').hide();
                                    
                                   
                                    
                     setTimeout(function () {     
                          $('.alert_error_popup_all_in_one').show();
                                    
                         $('.alert_error_popup_all_in_one').text('INSUFFICIENT AMOUNT ');
                         $('.alert_error_popup_all_in_one').delay(1000).fadeOut('slow');
                         $('#transcationid').focus();
                        
                    }, 1000);   
                                    
                                    
                                    
			}
                        
                        
                        
			}else{
                                     
                                    $('.alert_error_popup_all_in_one').show();
                                    
                                    $('.alert_error_popup_all_in_one').text('DETAILS');
                                    $('.alert_error_popup_all_in_one').delay(1000).fadeOut('slow');
                                     $('#transcationid').focus();
                                    
			}
                        
		 }else
		 {
			$(".error_feed").css("display","block");
			$(".error_feed").addClass("popup_validate");
			$(".error_feed").text("Enter Amount");
			$('.error_feed').delay(2000).fadeOut('slow');
		 }
                
		}else{
			
                       $('.alert_error_popup_all_in_one').show();
                       $('.alert_error_popup_all_in_one').text('ENTER AMOUNT');
                       $('.alert_error_popup_all_in_one').delay(1000).fadeOut('slow');
		       $('#paidamount').focus();
		}
		  
                  
                  
                  
                 if(pd1>0 || trans>0)
		 {  
                              $('.alert_error_popup_all_in_one').show();
                              $('.alert_error_popup_all_in_one').text('SETTLING');
                              $('.alert_error_popup_all_in_one').delay(10000).fadeOut('slow');
                              
                 }else{
                     
                       $('.alert_error_popup_all_in_one').show();
                       $('.alert_error_popup_all_in_one').text('ENTER AMOUNT');
                       $('.alert_error_popup_all_in_one').delay(1000).fadeOut('slow');
                     
                 }
                 
                 
		         data = $(this).serialize() + "&" + $.param(data);
            
			 $.ajax({
					type: "POST",
					url: "load_credit.php",
					data: data,
					success: function(msg)
					{
                                        
                                         
						var creditype=$("#creditypeslist").find('option:selected').val();
						
						$.post("load_credit.php", {type:creditype,set:'loadcreditdetails'},
							function(datas)
							{
                                                              
							  datas=$.trim(datas);
							  $('.loadcreditwholelist').html(datas)
							  $('.viewpayment').css("display","none")
							   
							});
                                                          
						$('#payemntmode_sel').find('option:first').attr('selected', 'selected');	  
					  
						$.post("load_credit.php", {id:credino,set:'loadbilldetails'},
						function(datas)
						{
                                                    
						datas=$.trim(datas);
						$('.loadeachcreditbildetails').html(datas)
						$('.viewpayment').css("display","none");
						 
						}); 
						
						
						$('.loadpay').html('');
						$(".cash_cc").hide();
						$(".credit_cc_normal").hide();
						$(".credit_cc").hide();
						$(".coupon_cc").hide();
						$(".voucher_cc").hide();
						$(".cheque_cc").hide();
						$(".auto1").hide();
						$(".auto").hide();
						
						$('.grandtotal').text('');	
						
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
						  
                                                  
                                             setTimeout(function () {    
		                                window.location.href='credit.php';
					     }, 1500);   
                                                
					}
                                        
				});
		}else
		{
			$(".error_feed").css("display","block");
			$(".error_feed").addClass("popup_validate");
			$(".error_feed").text(creditmsg1);
			$('.error_feed').delay(2000).fadeOut('slow');
                        
                        $('.alert_error_popup_all_in_one').show();
                        $('.alert_error_popup_all_in_one').text('SELECT TYPE');
                        $('.alert_error_popup_all_in_one').delay(1000).fadeOut('slow');
		}
                
  });
        
        
	 
  $('.closetranscations2').click(function () { 
          
                var creditmsg1 = ($("#creditmsg1").val());
                var creditmsg2 = ($("#creditmsg2").val());
                var creditmsg3 = ($("#creditmsg3").val());
		var payemntmode_sel =$('#payemntmode_sel').val();
		
                
                var credino = $('.loadpay').attr("credino");
                
		if(payemntmode_sel!='')
		{
		
                        var pd=$('.loadpay').text();
                        var selct=$('#payemntmode_sel').val();
                        var pd1=$('#paidamount').val();
		  
		        var ids=new Array();  var rts=new Array(); 
			var selected_activities =$("[name='selectbills[]']:checked");
			selected_activities.each(function(){
                            
			  var id_str       =  $(this).attr("bilnos");
                          
			  if(id_str!='undefined' && id_str!='' && id_str!=null){
				ids.push(id_str);
			  }
                          
                          var rate_str       =  $(this).attr("rate");
                          
			  if(rate_str!='undefined' && rate_str!='' && rate_str!=null && rate_str>0){
				rts.push(rate_str);
			  }
     	
			});
               
		    var typenam=$("#payemntmode_sel").find('option:selected').attr('idval');
                  
                    var trans5=$('#transcationid').val();
                    
		   if(pd1!="" || trans5!='' )
		  {  
                    
		     if(selct=="cash")
		     {
			 var paid=parseFloat($('#paidamount').val());
			 var bal=parseFloat($('#balanceamout').val());
                         var  pd2=parseFloat($('.loadpay').text());
                        
			 if(paid==0 || paid=='')
			  {
  
                              $('.alert_error_popup_all_in_one').show();
                                    
                              $('.alert_error_popup_all_in_one').text('ENTER AMOUNT');
                              $('.alert_error_popup_all_in_one').delay(1000).fadeOut('slow');
                          }
//			 else if(paid<pd2){
//                             
//                               $('.alert_error_popup_all_in_one').show();
//
//                               $('.alert_error_popup_all_in_one').text('ENTER VALID AMOUNT');
//                               $('.alert_error_popup_all_in_one').delay(1000).fadeOut('slow');
//                        
//                      }
                      else
			  {
                             
                          
                            if( (ids.length>1 && bal==0) || ids.length==1){
                             
			      var data = {
				 	"set"		: "credit_settle",
					"type"		: selct,
					"credino"       : credino,
					"billno" 	: ids,
					"typenam"	: typenam,
					"paid"		: paid,
					"bal" 		: bal
				  };
                                  
                                  
                        var paid_partial= parseFloat($('.paid_crd_partail').html());	
				
			var bal_partial=    parseFloat($('.bal_pay_crd').html());        
                        
                        var  tot_partial=parseFloat($('.loadpay').text());
                                     
                           setTimeout(function () {
                            
                            window.open("load_printcredit.php?id="+ids+"&bill="+pd+"&credino="+credino+"&paid="+paid+"&bal="+bal+"&mode="+selct
                            +"&paid_partial="+paid_partial+"&bad_partial="+bal_partial+"&tot_partial="+tot_partial+"&rates="+rts);  
                    
                           }, 1000);    
                           
                           
                                }else{
                             $('.alert_error_popup_all_in_one').hide();     
                         setTimeout(function () {     
                        $('.alert_error_popup_all_in_one').show();
                                    
                        $('.alert_error_popup_all_in_one').text('INSUFFICIENT AMOUNT ');
                        $('.alert_error_popup_all_in_one').delay(1000).fadeOut('slow');
                        $('#paidamount').focus();
                          }, 1000);    
                        
                                }
                           
                           
			  }
				  
		  }
                  else  if(selct=="credit")
		  {  
                      
                      
			  var trans=$('#transcationid').val();
			  var bankdetails=$('#bankdetails').val();
			  if(trans!="")
			   {
					var paid=parseFloat($('#paidamount').val());
					var bal=parseFloat($('#balanceamout').val());
					var transbal=parseFloat($('#transbal').val());
                                        
                                        
                        var paid_partial= parseFloat($('.paid_crd_partail').html());	
				
			var bal_partial=    parseFloat($('.bal_pay_crd').html());        
                        
                        var  tot_partial=parseFloat($('.loadpay').text());
                                        
                       if( (ids.length>1 && transbal==0) || ids.length==1){
                           
                                        
					if(transbal==0 && bal==0)
					{ 
                                            
					   var data = {
							 "set"		: "credit_settle",
							  "type"		: selct,
							  "credino"   :credino,
							  "billno" 	: ids,
							  "typenam"	: typenam,
							  "trans" :trans,
							  "bank" :bankdetails,
							  "paid": paid,
							  "bal" : bal
							};
                                                      
                                                            
                                                              
                               
                                                            
                                 setTimeout(function () { 
                                     
                                            window.open("load_printcredit.php?id="+ids+"&bill="+pd+"&credino="+credino+"&paid="+paid+"&bal="+bal
                                            +"&mode="+selct+"&trans="+trans+"&bank="+bankdetails +"&paid_partial="+paid_partial
                                            +"&bad_partial="+bal_partial+"&tot_partial="+tot_partial+"&rates="+rts); 
                                    
                                }, 1000);  
                                               
					}
                                       // else if(transbal>0 && bal>=0)
					else if(transbal>=0 ){
                                           
						var data = {
							  "set"		: "credit_settle",
							  "type"		: selct,
							  "credino"   :credino,
							  "billno" 	: ids,
							  "typenam"	: typenam,
							  "trans" :trans,
							  "bank" :bankdetails,
							  "paid": paid,
							  "bal" : bal
							};
                                                   
                                                        
                                          setTimeout(function () {
                                              
                                            window.open("load_printcredit.php?id="+ids+"&bill="+pd+"&credino="+credino+"&paid="+paid+"&bal="+bal
                                            +"&mode="+selct+"&trans="+trans+"&bank="+bankdetails+"&paid_partial="+paid_partial
                                            +"&bad_partial="+bal_partial+"&tot_partial="+tot_partial+"&rates="+rts); 
                                    
                                           }, 1000);    
                                               
					}
                                        else if((transbal<0) && bal==0)
						  { 
                                                     
							  var data = {
							  "set"		: "credit_settle",
							  "type"	: selct,
							  "credino"     :credino,
							  "billno" 	: ids,
							  "typenam"	: typenam,
							  "trans" :trans,
							  "bank" :bankdetails,
							  "paid": paid,
							  "bal" : bal
							};
                                                        
                                                        
                                setTimeout(function () {
                                            
                                window.open("load_printcredit.php?id="+ids+"&bill="+pd+"&credino="+credino+"&paid="+paid+"&bal="+bal+"&mode="+selct
                                +"&trans="+trans+"&bank="+bankdetails+"&paid_partial="+paid_partial
                                +"&bad_partial="+bal_partial+"&tot_partial="+tot_partial+"&rates="+rts); 
                                                 
                                 }, 1000);     
                                 
                                 
                                 
                                 
                                 
                                 
			}
			else
			{
                    
                        $('.alert_error_popup_all_in_one').show();
                                    
                        $('.alert_error_popup_all_in_one').text('INSUFFICIENT');
                        $('.alert_error_popup_all_in_one').delay(1000).fadeOut('slow');
                        $('#paidamount').focus();
			}
                        
                        
                        }else{
                                     
                                    $('.alert_error_popup_all_in_one').hide();
                                    
                                   
                                    
                                   setTimeout(function () {     
                        $('.alert_error_popup_all_in_one').show();
                                    
                        $('.alert_error_popup_all_in_one').text('INSUFFICIENT AMOUNT ');
                        $('.alert_error_popup_all_in_one').delay(1000).fadeOut('slow');
                        $('#transcationid').focus();
                        
                          }, 1000);   
                                    
                                    
                                    
			}
                        
                        
                        
			}else{
                                     
                                    $('.alert_error_popup_all_in_one').show();
                                    
                                    $('.alert_error_popup_all_in_one').text('DETAILS');
                                    $('.alert_error_popup_all_in_one').delay(1000).fadeOut('slow');

                                    $('#transcationid').focus();
                                    
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
						  if(coupbal==0 && bal==0)
						  {
								var data = {
									  "set"		: "credit_settle",
									  "type"		: selct,
									  "credino"   :credino,
									  "billno" 	: ids,
									  "typenam"	: typenam,
									  "coup" :coup,
									  "coupamnt": coupamnt,
									  "coupbal" : coupbal,
									  "paid": paid,
									  "bal" : bal
									};
						  }else if(coupbal!=0 && bal!=0)
						  {
							   var data = {
									  "set"		: "credit_settle",
									  "type"		: selct,
									  "credino"   :credino,
									  "billno" 	: ids,
									  "typenam"	: typenam,
									  "coup" :coup,
									  "coupamnt": coupamnt,
									  "coupbal" : coupbal,
									  "paid": paid,
									  "bal" : bal
									};
						  }else if((coupbal<0) && bal==0)
						  {
							   var data = {
									  "set"		: "credit_settle",
									  "type"		: selct,
									  "credino"   :credino,
									  "billno" 	: ids,
									  "typenam"	: typenam,
									  "coup" :coup,
									  "coupamnt": coupamnt,
									  "coupbal" : coupbal,
									  "paid": paid,
									  "bal" : bal
									};
						  }
						  else
						  {
							   $(".error_feed").css("display","block");
							   $(".error_feed").addClass("popup_validate");
							   $(".error_feed").text("Insufficient Amount");
							   $('.error_feed').delay(2000).fadeOut('slow');
						  }
					}else
					   {
						        $(".error_feed").css("display","block");
						        $(".error_feed").addClass("popup_validate");
			 				$(".error_feed").text("Enter Amount");
							$('.error_feed').delay(2000).fadeOut('slow');
					   }
			   }else
			   {
				        $(".error_feed").css("display","block");
				        $(".error_feed").addClass("popup_validate");
			 		$(".error_feed").text("Select Coupon");
					$('.error_feed').delay(2000).fadeOut('slow');
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
						
						 if(vouchbal==0 && bal==0)
						  {
							  var data = {
							  "set"		: "credit_settle",
							  "type"		: selct,
							  "credino"   :credino,
							  "billno" 	: ids,
							  "typenam"	: typenam,
							  "vouchid" :vouchid,
							  "vocamount": vocamount,
							  "vouchbal" : vouchbal,
							  "paid": paid,
							  "bal" : bal
							};
						  }else if((vouchbal!=0) && bal!=0)
						  {
							  
							  var data = {
							 "set"		: "credit_settle",
							  "type"		: selct,
							  "credino"   :credino,
							  "billno" 	: ids,
							  "typenam"	: typenam,
							  "vouchid" :vouchid,
							  "vocamount": vocamount,
							  "vouchbal" : vouchbal,
							  "paid": paid,
							  "bal" : bal
							};
						  }else if((vouchbal<0) && bal==0)
						  {
							   var data = {
							  "set"		: "credit_settle",
							  "type"		: selct,
							  "credino"   :credino,
							  "billno" 	: ids,
							  "typenam"	: typenam,
							  "vouchid" :vouchid,
							  "vocamount": vocamount,
							  "vouchbal" : vouchbal,
							  "paid": paid,
							  "bal" : bal
							};
						  }
						  else
						  {
							   $(".error_feed").css("display","block");
							   $(".error_feed").addClass("popup_validate");
							   $(".error_feed").text("Insufficient");
							   $('.error_feed').delay(2000).fadeOut('slow');
						  }	
							
							
				   }
				else
			   {
				        $(".error_feed").css("display","block");
				        $(".error_feed").addClass("popup_validate");
			 		$(".error_feed").text("Enter Voucher");
					$('.error_feed').delay(2000).fadeOut('slow');
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
							
							
							if(cheqbal==0 && bal==0)
						  {
							  var data = {
								  "set"		: "credit_settle",
								  "type"		: selct,
								  "credino"   :credino,
								  "billno" 	: ids,
								  "typenam"	: typenam,
								  "cheqbank" :cheqbank,
								  "cheqname": cheqname,
								  "cheqamt": cheqamt,
								  "paid": paid,
								  "bal" : bal
								};
						  }else if((cheqbal!=0) && bal!=0)
						  {
							  
							  var data = {
								  "set"		: "credit_settle",
								  "type"		: selct,
								  "credino"   :credino,
								  "billno" 	: ids,
								  "typenam"	: typenam,
								  "cheqbank" :cheqbank,
								  "cheqname": cheqname,
								  "cheqamt": cheqamt,
								  "paid": paid,
								  "bal" : bal
								};
						  }else if((cheqbal<0) && bal==0)
						  {
							   var data = {
								  "set"		: "credit_settle",
								  "type"		: selct,
								  "credino"   :credino,
								  "billno" 	: ids,
								  "typenam"	: typenam,
								  "cheqbank" :cheqbank,
								  "cheqname": cheqname,
								  "cheqamt": cheqamt,
								  "paid": paid,
								  "bal" : bal
								};
						  }
						  else
						  {
							   $(".error_feed").css("display","block");
							   $(".error_feed").addClass("popup_validate");
							   $(".error_feed").text("Insufficient");
							   $('.error_feed').delay(2000).fadeOut('slow');
						  }	
							
							
							
						}else
						{
							$(".error_feed").css("display","block");
							$(".error_feed").addClass("popup_validate");
							$(".error_feed").text("Enter Cheque");
							$('.error_feed').delay(2000).fadeOut('slow');
						}
					}else
					 {
						$(".error_feed").css("display","block");
						$(".error_feed").addClass("popup_validate");
			 			$(".error_feed").text("Select Bank");
						$('.error_feed').delay(2000).fadeOut('slow');
					 }
			   }else
			   {
				        $(".error_feed").css("display","block");
				        $(".error_feed").addClass("popup_validate");
			 		$(".error_feed").text("Enter Number");
					$('.error_feed').delay(2000).fadeOut('slow');
			   }
		  }
		 
		else
		{
			$(".error_feed").css("display","block");
			$(".error_feed").addClass("popup_validate");
			$(".error_feed").text("Enter Amount");
			$('.error_feed').delay(2000).fadeOut('slow');
		}
                
		}else{
			
                       $('.alert_error_popup_all_in_one').show();
                       $('.alert_error_popup_all_in_one').text('ENTER AMOUNT');
                       $('.alert_error_popup_all_in_one').delay(1000).fadeOut('slow');
		       $('#paidamount').focus();
		}
		  
                    if(pd1>0 ||  trans>0)
		  {  
                              $('.alert_error_popup_all_in_one').show();
                                    
                              $('.alert_error_popup_all_in_one').text('SETTLING');
                              $('.alert_error_popup_all_in_one').delay(10000).fadeOut('slow');
                              
                 }else{
                       $('.alert_error_popup_all_in_one').show();
                       $('.alert_error_popup_all_in_one').text('ENTER AMOUNT');
                       $('.alert_error_popup_all_in_one').delay(1000).fadeOut('slow');
                     
                     
                 }
                 
                 
                 
                  
		         data = $(this).serialize() + "&" + $.param(data);
                    
			 $.ajax({
					type: "POST",
					url: "load_credit.php",
					data: data,
					success: function(msg)
					{
                                            
                                             
                                          
                                            
                                            
						var creditype=$("#creditypeslist").find('option:selected').val();
						
						$.post("load_credit.php", {type:creditype,set:'loadcreditdetails'},
							  function(datas)
							  {
                                                              
							  datas=$.trim(datas);
							  $('.loadcreditwholelist').html(datas)
							  $('.viewpayment').css("display","none")
							   
							  });
                                                          
						$('#payemntmode_sel').find('option:first').attr('selected', 'selected');	  
					  
						$.post("load_credit.php", {id:credino,set:'loadbilldetails'},
						function(datas)
						{
						datas=$.trim(datas);
						$('.loadeachcreditbildetails').html(datas)
						$('.viewpayment').css("display","none");
						 
						}); 
						
						
						$('.loadpay').html('');
						$(".cash_cc").hide();
						$(".credit_cc_normal").hide();
						$(".credit_cc").hide();
						$(".coupon_cc").hide();
						$(".voucher_cc").hide();
						$(".cheque_cc").hide();
						$(".auto1").hide();
						$(".auto").hide();
						
						 $('.grandtotal').text('');	
						
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
						  
						
						
					  $(".error_feed").css("display","block");
					  $(".error_feed").addClass("popup_validate");
					  $(".error_feed").text(creditmsg3);
					  $('.error_feed').delay(2000).fadeOut('slow');
						
                                             setTimeout(function () {    
		                              window.location.href='credit.php';
					     }, 3000);   
                                                
					}
                                        
				});
		}else
		{
			$(".error_feed").css("display","block");
			$(".error_feed").addClass("popup_validate");
			$(".error_feed").text(creditmsg1);
			$('.error_feed').delay(2000).fadeOut('slow');
                        
                        $('.alert_error_popup_all_in_one').show();
                        $('.alert_error_popup_all_in_one').text('SELECT TYPE');
                        $('.alert_error_popup_all_in_one').delay(1000).fadeOut('slow');
		}
		});
                
	/***********  close bill ends ******************  */
	
}); 

/*********  balance calc starts ****************  */
	function enterbalance1()
	  {  
           
	  	  var paid=$('#paidamount').val();
		  var grand=$('.loadpay').text();
		  var selct=$('#payemntmode_sel').val();
                  
		  if(selct=="cash")
		  {
			  var bal=parseFloat(paid.replace(/,/g, "")) -  parseFloat(grand.replace(/,/g, ""));
                          
		  }else if(selct=="credit")
		  {
			 if($('#transbal').val()!="")
			 {
				 var subt=$('#transbal').val();
				 var bal=parseFloat(paid.replace(/,/g, "")) -  parseFloat(subt.replace(/,/g, ""));
				 
			 }
		  }
		
		 if(bal<0)
		{
				 $(".error_feed").css("display","block");
				 $(".error_feed").addClass("popup_validate");
			 	 $(".error_feed").text("Insufficient");
				 $('.error_feed').delay(2000).fadeOut('slow');
				 $('#balanceamout').val('');
				
		}else
		{              var dec=$('#decimal').val();
                           
			$('#balanceamout').val(bal.toFixed(dec));
		}
		  
	  }
          
          
         function enterbalance()
	  {  
              
              
                  var count_checked = $("[name='selectbills[]']:checked").length; 
                
                  var dec=$('#decimal').val();
                 
	  	  var paid=$('#paidamount').val();
                  
                
		  var grand=($('.loadpay').text()-$('.paid_crd_partail').text());
               
          
		  var selct=$('#payemntmode_sel').val();
                  var bal=0;
                  
                  var ids=new Array();
			var ratevl=0;
			var selected_activities =$("[name='selectbills[]']:checked");
			selected_activities.each(function(){
			var id_str   =  $(this).attr("bilnos");
                          
			  if(id_str!='undefined' && id_str!='' && id_str!=null){
					  ids.push(id_str);
				  }
                                  
			 var rate_str       =  $(this).attr("rate");
                                 
			  if(rate_str!='undefined' && rate_str!='' && rate_str!=null){
					
				ratevl=parseFloat(ratevl) +  parseFloat(rate_str);
			}  
                        
			});
                  
                  
		  if(selct=="cash")
		  {
                      
			        var bal=parseFloat(grand)-parseFloat(paid);
                          
                         
		  }else if(selct=="credit")
		  {
			 if($('#transbal').val()!="")
			 {
				 var subt=$('#transbal').val();
				 var bal=parseFloat(paid.replace(/,/g, "")) -  parseFloat(subt.replace(/,/g, ""));
				 
			 }
		  }
		
                
                        var bil=$('.loadpay').attr('billno');
                  
                        bal=Math.abs(bal);
                       
			$('.bal_pay_crd').text(bal.toFixed(dec));
                        
                        var def_paid=  $('.paid_crd_partail').attr('def_paid');	
                      
                       // if(count_checked==1){
                          
                        $('.paid_crd_partail').text(parseFloat(def_paid)+parseFloat(paid));
                        
                       // }else{
                           
                       //  $('.paid_crd_partail').text(0); 
                         
                      // }
                     
                  
                       if(paid=='' ){ 
                            
                        var paymode=$("#payemntmode_sel").val() ; 
                     
                        $.post("load_credit.php", {billno:bil,set:'load_credit_partail',paymode:paymode,ids:ids},
			function(data)
			{ 
				data=$.trim(data);
				
				$('.paid_crd_partail').html(data);	
			
                                if(data>0){ 
                                    
                                 var gr=$('.loadpay').text();    
                                 
			        $('.bal_pay_crd').html((gr-data).toFixed(dec)); 
                                
                                 }else{
                                     
                                    $('.bal_pay_crd').html($('.loadpay').text());    
                                     
                                 }
			});
                        
                       // bal=0;
                        
                        }
             
                      
                       var pd_pr= $('.paid_crd_partail').html();
                       
                       var tot_bill=$('.loadpay').text(); 
                       
                      //if(count_checked==1){  
                          
                        if(pd_pr>parseFloat(tot_bill)){
                            
                        bal=0;
                         
                        $('.alert_error_popup_all_in_one').show();
                                    
                        $('.alert_error_popup_all_in_one').text('INCORRECT AMOUNT ');
                        $('.alert_error_popup_all_in_one').delay(1000).fadeOut('slow');
                        $('#paidamount').val('');
                     
                        var paymode=$("#payemntmode_sel").val() ; 
                     
                        $.post("load_credit.php", {billno:bil,set:'load_credit_partail',paymode:paymode,ids:ids},
			function(data)
			{ 
				data=$.trim(data);
				
				$('.paid_crd_partail').html(data);	
			
                                if(data>0){ 
                                    
                                 var gr=$('.loadpay').text();    
                                 
			        $('.bal_pay_crd').html((gr-data).toFixed(dec)); 
                                
                                 }else{
                                     
                                    var gr=$('.loadpay').text(); 
                                   $('.bal_pay_crd').html(gr);    
                                     
                                 }
			});
                        
                    }    
                      
                     // }else{
                          
                      //  $('.paid_crd_partail').html(paid);
                        
                      //}
            
             
                       $('#balanceamout').val(bal.toFixed(dec)); 
                       
                     //  if(count_checked>1){  
                          
                       if(parseFloat(paid)>parseFloat(tot_bill)){
                               
                        $('.alert_error_popup_all_in_one').show();
                        $('.alert_error_popup_all_in_one').text('INCORRECT AMOUNT ');
                        $('.alert_error_popup_all_in_one').delay(1000).fadeOut('slow');
                        
                        $('#paidamount').val('');
                        $('.paid_crd_partail').html('0'); 
                        $('#balanceamout').val('0');  
                        $('.bal_pay_crd').html('0');    
                               
                       }
                           
                      // }
                       
                        var gr=$('.loadpay').text(); 
                     
                        if(pd_pr==parseFloat(gr)){
                            
                           $('#balanceamout').val('0');  
                           $('.bal_pay_crd').html('0');    
                        } 
                      
		
                         setTimeout(function () {   
                               $('#balanceamout').val(($('.loadpay').text()-$('.paid_crd_partail').text()).toFixed(dec));  
                               $('.bal_pay_crd').text( ($('.loadpay').text()-$('.paid_crd_partail').text()).toFixed(dec));  
                              
                         }, 500);    
                
                
		  
	  } 
          
       function transamountchange()
	  {  
              event.stopImmediatePropagation();
              
                       var ids=new Array();
			var ratevl=0;
			var selected_activities =$("[name='selectbills[]']:checked");
			selected_activities.each(function(){
			var id_str   =  $(this).attr("bilnos");
                          
			  if(id_str!='undefined' && id_str!='' && id_str!=null){
					  ids.push(id_str);
				  }
                                  
			 var rate_str       =  $(this).attr("rate");
                                 
			  if(rate_str!='undefined' && rate_str!='' && rate_str!=null){
					
				ratevl=parseFloat(ratevl) +  parseFloat(rate_str);
			}  
                        
			});
              
                  var count_checked = $("[name='selectbills[]']:checked").length; 
                
                  var dec=$('#decimal').val();
                 
	  	  var paid=$('#transcationid').val();
                  
                
		  var grand=($('.loadpay').text()-$('.paid_crd_partail').text());
               
          
		  var selct=$('#payemntmode_sel').val();
                  var bal=0;
                  
                  
		  if(selct=="cash")
		  {
                      
			        var bal=parseFloat(grand)-parseFloat(paid);
                          
                         
		  }else if(selct=="credit")
		  {
			 if($('#transbal').val()!="")
			 {
				 var subt=$('#transbal').val();
				// var bal=parseFloat(paid.replace(/,/g, "")) -  parseFloat(subt.replace(/,/g, ""));
				// alert(paid); alert(subt);
                                
                                 var bal=parseFloat(grand)-parseFloat(paid);
                                
			 }
		  }
		
                
                        var bil=$('.loadpay').attr('billno');
                  
                        bal=Math.abs(bal);
                       
			$('.bal_pay_crd').text(bal.toFixed(dec));
                        
                        var def_paid=  $('.paid_crd_partail').attr('def_paid');	
                      
                       // if(count_checked==1){
                         // alert(bal);
                         
                         //alert(def_paid); alert(paid);
                        $('.paid_crd_partail').text(parseFloat(def_paid)+parseFloat(paid));
                        
                       // }else{
                           
                        // $('.paid_crd_partail').text(0); 
                         
                      // }
                     
                  
                       if(paid=='' ){ 
                            
                        var paymode=$("#payemntmode_sel").val() ; 
                     
                        $.post("load_credit.php", {billno:bil,set:'load_credit_partail',paymode:paymode,ids:ids},
			function(data)
			{ 
				data=$.trim(data);
				
				$('.paid_crd_partail').html(data);	
			
                                if(data>0){ 
                                    
                                 var gr=$('.loadpay').text();    
                                 
			        $('.bal_pay_crd').html((gr-data).toFixed(dec)); 
                                
                                 }else{
                                     
                                    $('.bal_pay_crd').html($('.loadpay').text());    
                                     
                                 }
			});
                        
                       // bal=0;
                        
                        }
             
                      
                       var pd_pr= $('.paid_crd_partail').html();
                       
                       var tot_bill=$('.loadpay').text(); 
                       
                      //if(count_checked==1){  
                          
                        if(pd_pr>parseFloat(tot_bill)){
                            
                        bal=0;
                         
                        $('.alert_error_popup_all_in_one').show();
                                    
                        $('.alert_error_popup_all_in_one').text('INCORRECT AMOUNT ');
                        $('.alert_error_popup_all_in_one').delay(1000).fadeOut('slow');
                        $('#transcationid').val('');
                     
                        var paymode=$("#payemntmode_sel").val() ; 
                     
                        $.post("load_credit.php", {billno:bil,set:'load_credit_partail',paymode:paymode,ids:ids},
			function(data)
			{ 
				data=$.trim(data);
				
				$('.paid_crd_partail').html(data);	
			
                                if(data>0){ 
                                    
                                 var gr=$('.loadpay').text();    
                                 
			        $('.bal_pay_crd').html((gr-data).toFixed(dec)); 
                                
                                 }else{
                                     
                                    var gr=$('.loadpay').text(); 
                                   $('.bal_pay_crd').html(gr);    
                                     
                                 }
			});
                        
                    }    
                      
                      //}else{
                          
                       // $('.paid_crd_partail').html(paid);
                        
                      //}
            
             
                       $('#transbal').val(bal.toFixed(dec)); 
                       
                      // if(count_checked>1){  
                          
                       if(parseFloat(paid)>parseFloat(tot_bill)){
                               
                        $('.alert_error_popup_all_in_one').show();
                        $('.alert_error_popup_all_in_one').text('INCORRECT AMOUNT ');
                        $('.alert_error_popup_all_in_one').delay(1000).fadeOut('slow');
                        
                        $('#transcationid').val('');
                        $('.paid_crd_partail').html('0'); 
                        $('#transbal').val('0');  
                        $('.bal_pay_crd').html('0');    
                               
                       }
                           
                       //}
                       
                        var gr=$('.loadpay').text(); 
                     
                        if(pd_pr==parseFloat(gr)){
                            
                           $('#transbal').val('0');  
                           $('.bal_pay_crd').html('0');    
                        } 
                      
		
                         setTimeout(function () {   
                             
                               $('#transbal').val(($('.loadpay').text()-$('.paid_crd_partail').text()).toFixed(dec));  
                               $('.bal_pay_crd').text( ($('.loadpay').text()-$('.paid_crd_partail').text()).toFixed(dec));  
                              
                            }, 500);    
                
                
		  
	  }     
          
          function transamountchange2()
	  {  
           
           
                 var dec=$('#decimal').val();
                 
	  	  var paid=$('#transcationid').val();
                  
                  
		  var grand=($('.loadpay').text()-$('.paid_crd_partail').text());
                  
		  var selct=$('#payemntmode_sel').val();
                
		 
				 var subt=$('#transbal').val();
				 var bal=parseFloat(paid) -  parseFloat(grand);
				 
                                 
                        var bil=$('.loadpay').attr('billno');
                  
                        bal=Math.abs(bal);
                        
			$('.bal_pay_crd').text(bal.toFixed(dec));
                        
                     
                        var def_paid=  $('.paid_crd_partail').attr('def_paid');	
                      
                        $('.paid_crd_partail').text(parseFloat(def_paid)+parseFloat(paid));
                        
                     
                    
                        if(paid==''){
                            
                        var paymode=$("#payemntmode_sel").val() ; 
                     
                        $.post("load_credit.php", {billno:bil,set:'load_credit_partail',paymode:paymode},
			function(data)
			{ 
				data=$.trim(data);
				
				$('.paid_crd_partail').html(data);	
			
                                if(data>0){ 
                                    
                                 var gr=$('.loadpay').text();    
                                 
			        $('.bal_pay_crd').html((gr-data).toFixed(dec)); 
                                
                                 }else{
                                     
                                    var gr=$('.loadpay').text(); 
                                   $('.bal_pay_crd').html(gr);    
                                     
                                 }
			});
                        
                        }
                        
                        
                       var pd_pr= $('.paid_crd_partail').html();
                       
                       var tot_bill=$('.loadpay').text(); 
                       
                        if(pd_pr>parseFloat(tot_bill)){
                            
                        
                        bal=0;
                         
                        $('.alert_error_popup_all_in_one').show();
                                    
                        $('.alert_error_popup_all_in_one').text('INCORRECT AMOUNT ');
                        $('.alert_error_popup_all_in_one').delay(1000).fadeOut('slow');
                        $('#transcationid').val('');
                     
                        var paymode=$("#payemntmode_sel").val() ; 
                     
                        $.post("load_credit.php", {billno:bil,set:'load_credit_partail',paymode:paymode},
			function(data)
			{ 
				data=$.trim(data);
				
				$('.paid_crd_partail').html(data);	
			
                                if(data>0){ 
                                    
                                 var gr=$('.loadpay').text();    
                                 
			        $('.bal_pay_crd').html((gr-data).toFixed(dec)); 
                                
                                 }else{
                                     
                                    var gr=$('.loadpay').text(); 
                                   $('.bal_pay_crd').html(gr);    
                                     
                                 }
			});
                        
                    }    
                      
             
                       $('#transbal').val(bal.toFixed(dec)); 
                       
                       var gr=$('.loadpay').text(); 
                       
                     
                        if(pd_pr==parseFloat(gr)){
                            
                           $('#transbal').val('0');  
                           $('.bal_pay_crd').html('0');    
                        } 
                       
		
		  
	  }       
          
	  
  function transamountchange1()
   {
                    
                  
                        $("#paidamount").val('');
		        $("#balanceamout").val('');
                            
			var tt=0;
			var gd=parseFloat($('.loadpay').text().replace(/,/g, ""));
			var dc=parseFloat($('#transcationid').val().replace(/,/g, ""));
                         if(dc>gd){
                             $('#transcationid').val('');
                             $('#transbal').val('');
                         }
			tt = parseFloat(gd -  dc); 
			if(tt<0)
			{
                            


                        $('.alert_error_popup_all_in_one').show();
                                    
                        $('.alert_error_popup_all_in_one').text('INCORRECT CARD AMOUNT ');
                        $('.alert_error_popup_all_in_one').delay(1000).fadeOut('slow');
                        $('#paidamount').focus();
			}else
			{
				 var dec=$('#decimal').val();
			document.getElementById("transbal").value=tt.toFixed(dec);
			if(tt==0)
			{     
				$("#paidamount").val('0');
				$("#balanceamout").val('0');
			}
			}
		}
                
                
    function view_partial(){
        
        
        var bill= $('.loadpay').attr('billno');
        
      
       if($('#view_partial_pays:visible').length == 0)
       {
            $.post("load_credit.php", {billno:bill,set:'load_credit_partail_pays'},
			function(data)
			{ 
                            
                             $('#view_partial_pays').show();
                            
                             $('.confrmation_overlay').show();
                            
                            $('#load_pays_partial').html(data);
                            
                            
                        });
                        
        
           
       }else{

       
                       
                        $('#view_partial_pays').hide();
                            
        $('#load_pays_partial').html('');   
       
       }
    }
    
    
    function close_pop_partial(){
        
        
         $('#view_partial_pays').hide();
                            
                             $('.confrmation_overlay').hide();
                            
                            $('#load_pays_partial').html('');
        
    }
                