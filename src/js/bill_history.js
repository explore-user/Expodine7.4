// JavaScript Document
$(document).ready(function(){
    
    
    $(document).on('keypress',function(e) {
    if(e.which == 13) {
       
       if($('#paidamount').val() > 0 || $('#transcationid').val() > 0){
          
           $('.closetranscationshis').click();
       }
       
       
       
    }
});
    
	/***************************************** Auto Load  starts ******************************************************************  */
	 /*setInterval(function() {
		 
		  var billno       =  $('.bill_history_active').attr("billno");
		  if(billno=='')
		  {
			  billno='';
		  }
		  $.post("load_bill_history.php", {billno:billno,set:'billwholeload'},
				  function(data)
				  {
				  	data=$.trim(data);
				  	$('#billlisttotal').html(data);
				  });
				  
		 }, 6000);*/ 
		 
	/***************************************Auto Load  ends ******************************************************************  */
	
	/*****************************************  bill each click starts ******************************************************************  */
 	$('.bill_history_number').click(function () { 
            
             
             
            var billdate=$(this).attr("billdate");
          
            var user=$(this).attr("user");
             var cur_date=  $(this).attr("cur_date");
        
          
            if(billdate!=cur_date && user!='Super Admin'){
              
                $('#cancelbill').hide();
            }else{
               
                $('#cancelbill').show();
            }
             
            
		 $("#bill").show();
		 $('#billdetailsset2').empty();
		 $("#settlement").hide();

				$('.bill_history_number').removeClass("bill_history_active");
				$(this).addClass("bill_history_active");
				var billno       =  $(this).attr("billno");
                                
                                var sts       =  $(this).attr("cancelkey");
                                
                                $('#a4_view').attr("billno",billno);
                                $('#a4_view').attr("sts",sts);
                                
                                
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
//				  
				  $('.tax_textbox').find('option:first').attr('selected', 'selected'); 
				  $(".cash_cc").show();
                                      $(".credit_cc").hide();
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

			//}
	 
	 }); 

   /*************************************** bill each click ends ******************************************************************  */
      
    /**************** cancel ok click starts ************  */
    
    
    
    $('#go_bill_cancel').click(function (event) {
         
         event.stopImmediatePropagation();
    
         var billno=  $('#add_stock_pop').attr('billno');
    
           var data1234="set=check_otp_bill_cancel&billno="+billno;
           $.ajax({
            type: "POST",
            url: "load_index.php",
            data: data1234,
            success: function(data) {
                
             if($('#code_change').val()==$.trim(data)){
             
                   var billno       =  $('#hidbilnotosave').val();
                    var slno       =  $('#hidslnotosave').val();
                    var mode       = $('#his_mode').val();
              
      $('#add_stock_pop').hide();
      $('#add_stock_pop').attr('billno',' ');
                              
       $('#code_change').val('');
       $('#code_change').focus();
       
       
       
                var billhistorymsg4 = ($("#billhistorymsg4").val());
		var billno       =  $('.bill_history_active').attr("billno");
		var slno       =  $('#hidslnotosave').val();
               
		var reasontext       =  $('#reasontext').val();
		var secretkey       =  $('#secretkey').val();
		var stafflist       =  $('#stafflist').val();
		
                               
			 $.post("load_bill_history.php", {billno:billno,slno:slno,reasontext:reasontext,secretkey:secretkey,stafflist:stafflist,set:'set_cancel'},
			  function(data)
			  {
                              
                          $('#billlisttotal').load( "load_bill_history.php?set=billwholeload");
			  var hidbill_cancelled=$("#hidbill_cancelled").val();
			  data=$.trim(data);
			  $(".loaderror").css("display","block");
			  $(".loaderror").addClass("billgenration_validate");
			  $(".loaderror").text(hidbill_cancelled);
			  $(".loaderror").delay(2000).fadeOut('slow');
			  
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
                                            
						$('#hidbilnotosave').val('');
						$('#hidslnotosave').val('');
						$('#reasontext').val('');
						$('#secretkey').val('');
       
       
       
       
       
             }else{
                 
                    alert('INVALID OTP'); 
                  $('#code_change').val('');
                  $('#code_change').focus();
                 
             }
    
            }
        });
    
    });
    
    
   $('.closeok').click(function () {
       
       
       event.stopImmediatePropagation();
       
       var otp_bill_cancel=$('#otp_bill_cancel').val();
       var billno       =  $('.bill_history_active').attr("billno");
       var staff= $('#otp_login').val();
       
      $('.closeoneclass').css('display','none');
	$('.confrmation_overlay').css('display','none');
      
      $('#add_stock_pop').show();
      $('#add_stock_pop').attr('billno',billno);
                              
      $('#code_change').val('');
      $('#code_change').focus();
      
      if(otp_bill_cancel=='Y'){
           
                        $.post("load_index.php", {billno:billno,staff:staff,set:'otp_bill_cancel'},
			  function(data)
			  {
                           
                          });
           
        }else{
       
    $('#add_stock_pop').hide();
       $('#add_stock_pop').attr('billno','');
       
       document.getElementById('reasontext').value = '';
	document.getElementById('stafflist').value = 'null';
        document.getElementById('secretkey').value = '';
        
		$('.closeoneclass').css('display','none');
		$('.confrmation_overlay').css('display','none');
		var canauth=$('#hiddauthcancel').val();
               
                if(canauth=="Y"){
                    
                var auth =$('#authorise_with_code').val();
                
                if(auth!='Y'){
                    $('.closeoneclass3').css('display','block');
                    $('.confrmation_overlay').css('display','block');
                    
                }else{
                     
                    $('.kotcancel_reason_popup_new').css('display','block');
                    $('.confrmation_overlay').css('display','block');
                     $('#pin').focus();
                }
            }else{
                
                var billhistorymsg4 = ($("#billhistorymsg4").val());
		var billno       =  $('.bill_history_active').attr("billno");
		var slno       =  $('#hidslnotosave').val();
               
		var reasontext       =  $('#reasontext').val();
		var secretkey       =  $('#secretkey').val();
		var stafflist       =  $('#stafflist').val();
		
                               
			 $.post("load_bill_history.php", {billno:billno,slno:slno,reasontext:reasontext,secretkey:secretkey,stafflist:stafflist,set:'set_cancel'},
			  function(data)
			  {
                              
                          $('#billlisttotal').load( "load_bill_history.php?set=billwholeload");
			  var hidbill_cancelled=$("#hidbill_cancelled").val();
			  data=$.trim(data);
			  $(".loaderror").css("display","block");
			  $(".loaderror").addClass("billgenration_validate");
			  $(".loaderror").text(hidbill_cancelled);
			  $(".loaderror").delay(2000).fadeOut('slow');
			  
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
                                            
						$('#hidbilnotosave').val('');
						$('#hidslnotosave').val('');
						$('#reasontext').val('');
						$('#secretkey').val('');
                        }
		
		
		var billno       =  $('.bill_history_active').attr("billno");
		//var slno       =  $(this).attr("slno");	 
		$('#hidbilnotosave').val(billno);
		$('#hidslnotosave').val('');
		document.getElementById('reasontext').value = '';
                $("#reasontext_div").removeClass("has-error");
		
	
   }
        
	});
        
        
	 /*************************************** cancel ok click ends ******************************************************************  */
	
	  /*************************************** cancel close click starts ******************************************************************  */
   $('.closecancel').click(function () {
       
		$('.closeoneclass').css('display','none');
		$('.confrmation_overlay').css('display','none');
	
  });
  
	 /**************** cancel close click ends ********************  */
         
	  /***************  cancel regen permision starts ***********  */
          
   $('.closeregnpopup').click(function () {
       
		$('.loadauthdetails').css('display','none');
		$('.confrmation_overlay').css('display','none');
	 
   });
   
	 /*************  cancel regen permision ends ********************  */
         
	 /************  close starts ********************  */
          
  $("#payemntmode_sel").change(function () {
             
                   
   var aat = ($(this).val());
   
   if (aat == "1") { 
                        
                        
                        $("#transcationid").val("");
                        $("#transbal").val("");
                        $("#paidamount").val("");
                        $("#balanceamout").val("");
                              
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
                        $('.submittranscations_whole').css("display", "none");
                          $(".comp_cc").hide();  
                           $('.credit_type').css("display", "none");
       }
       
       if (aat == "2") {
                   
             var multibillnew16=$('.bill_history_active').attr("billno");
                 
             var datastringnewmultinew16="setmultinew16=multicardnew16&multibillnew16="+multibillnew16;
    
        $.ajax({
        type: "POST",
        url: "bill_history.php",
        data: datastringnewmultinew16,
        success: function(data)
        {
        
            $(".trrefresh").load(location.href + " .trrefresh");
            
            $("#transcationid").focus();
            var g1=$('#grandtotal').html();
            var tr= $("#transcationid").val();
           
           
              
        }
        
    });
            
                        $("#paidamount").val("");
                        $("#balanceamout").val("");
                        $("#transcationid").val("");
                        $("#transbal").val("");
                        $("#cheqamount").val("");
                        $("#cheqbal").val("");
                        
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
                        $('.submittranscations_whole').css("display", "none");
                        $(".comp_cc").hide();  
                         $('.credit_type').css("display", "none");
                     
                        
                        
       }
       
       if (aat == "6") {
               
               
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
                        $('.closetranscations').css("display", "none");
                          
                        $('.credit_type').css("display", "block");
                        $('.paid_amount_cc_credit').css("display", "block");
                        $('.closetranscations_whole').css("display", "block");
                        
                      $(".comp_cc").hide();  
                      $("#paidamount_credit").val("0");    
                    
                         
       } 
       
       if (aat == "7") {
               
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
                        $('.closetranscations').css("display", "none");
                          
                        $('.credit_type').css("display", "none");
                        $('.paid_amount_cc_credit').css("display", "none");
                        $('.closetranscations_whole').css("display", "block");
                        
                       $(".comp_cc").show();  
           }   
            
                    
  });
 
 
  $('#selectcreditypes').change(function () {	
            
            var pd1=$('#paidamount_credit').val();
            var gr1=$('#grandtotal').text();
            var sm1=gr1-pd1;
            
			 var credittype=$(this).val();
                         
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
         
          
           var grnd=$('#grand_total').text();
           $('#amount_credit').val(grnd); 
          
          
	  });
  });          
               
    
    
  $('.closetranscationshis').click(function () {
         
                document.getElementById('reasontext_chng').value = '';
                document.getElementById('stafflist_chnge').value = 'null';
                document.getElementById('secretkey_chng').value = '';
                
                var billhistorymsg3 = ($("#billhistorymsg3").val());
		
		var payemntmode_sel =$('#payemntmode_sel').val();
		var authchnage =$('#authchnage').val();
                var billamount=$('#grand_total').text();
                billamount=billamount.replace(",","");
                var billno       =  $('.bill_history_active').attr("billno");
              
		if(payemntmode_sel!='')
		{  
                    
                  var paidamt1=$('#paidamount').val().replace(",","");
                  var balce1=$('#balanceamout').val().replace(",",""); 
                  var transamount1=$('#transcationid').val().replace(",","");
                  var transbal1=$('#transbal').val().replace(",","");

           var comp_remarks=$('#comp_remarks').val();

        if( (paidamt1!="" && (balce1==0 || balce1!="")) || (transamount1!="" && (transbal1==0 || transbal1!=""|| balce1==""|| paidamt1=="")) || payemntmode_sel=='7' ||  payemntmode_sel=='6' )
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
				 	"set"		: "paymentchangesettle",
					"type"		: selct,
					"billno" 	: billno,
					"paid"		: paidamt,
					"bal" 		: balce,
					"check_chn"	:"no"
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

			  }
			  //alert(data_ch);
				  
		  }else  if(selct=="2")
		  {     
			  var transamount=$('#transcationid').val().replace(",","");
                          var bank= $('#bankdetails').val();
                          var transbalance=$('#transbal').val().replace(",","");
                          var bank= $('#bankdetails').val();
                          var paidamt= $('#paidamount').val().replace(",","");
                          var balce=$('#balanceamout').val().replace(",","");
                        
                            if(bank=='' || bank==null)
				{
                                    var hidenterbankdt= $('#hidenterbankdt').val();
                                    $(".payment_pend_right_cash_error").css("display","block");
                                    $(".payment_pend_right_cash_error").addClass("popup_validate");
                                    $(".payment_pend_right_cash_error").text(hidenterbankdt);
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
			 
			  if(transamount!="" && bank!='')
			   {
					
					
					var transbal=transbalance;
                                        
					if(transbal==0 && (balce==0 || balce==''))
					{  
					    data_ch = {
							 "set"		: "paymentchangesettle",
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
							  "set"		: "paymentchangesettle",
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
							  "set"		: "paymentchangesettle",
							  "type"		: selct,
							  "billno" 	:billno,
							  "trans" :transamount,
							  "bank" :bank,
							  "paid": paidamt,
							  "bal" : balce,
							  "transbal":transbal,
							  "check_chn"	:"no"
							};
					}else if((transbal<0) && balce==0)
						  {
							   data_ch = {
							  "set"		: "paymentchangesettle",
							  "type"		: selct,
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
                                 
		  }else if(selct=="6")
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
								  "set"				: "paymentchangesettle",
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
                          
                          
                          
                          
					  
		}
                else if(selct=="7")
	          {       
                     
                          var comp_remarks=$('#comp_remarks').val();
                          
			
			  if(comp_remarks!="")
			  { 
                               
                      
                                  data_ch = {
				 	"set"		: "paymentchangesettle",
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
                                     url: "payment_pending.php",
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
               
		 if( (parseFloat(paidamt1)>=parseFloat(billamount)) || (parseFloat(totalpaid)>=parseFloat(billamount)) || parseFloat(transamount1)==parseFloat(billamount) || (comp_remarks!='' &&  comp_remarks!=undefined) || (amount_credit>0 &&  amount_credit!=undefined) )
                 {
                     
                     
		         var  data = $(this).serialize() + "&" + $.param(data_ch); 
			 $.ajax({
					type: "POST",
					url: "load_bill_history.php",
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
                                                          
					                        //location.reload();
					 
								var billno       =  $('.bill_history_active').attr("billno");
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
                                                                
                                                                billSearch();
                                                                
						
                                                  
                                                   setTimeout(function(){
                                                    $('tr[billno="' + billno + '"]').addClass('bill_history_active');
                                                   }, 1000);
                                                  
                                                
						}
						});
					

		  
		   
             }else{
                 
                        $(".payment_pend_right_cash_error").css("display","block");
			$(".payment_pend_right_cash_error").addClass("popup_validate");
			$(".payment_pend_right_cash_error").text("Insufficient Amount");
			$('.payment_pend_right_cash_error').delay(2000).fadeOut('slow');
             }
             }else{
                        
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
  
  
	
	  
	/**********  payment change starts *****************************  */
        
        
  $(".changesetledetils").click(function () {
                  
                    $('#rprntmode').val('chng');
                    $('#reasontext').hide();
                    $('#rsntxt').css('display','none');
                    $('#authcodersn').css('display','none');
                    var cancel_key=$('.bill_history_active').attr("cancelkey");
                    var paymod = $('#bill_paymode').val(); 
                    
                    if(cancel_key!="Cancelled" && (paymod == 1 || paymod == 2 ||  paymod == 6  ||  paymod == 7 ) ){
                    
                        var rprnt_auth = $('#reprint_with_permission').val();
                        if(rprnt_auth == 'Y'){
                      
                            var auth =$('#authorise_with_code').val();
                          
                            if(auth!='Y'){
                                
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
                    
                    }else{
                               
                                $('.kotcancel_reason_popup_new').css('display','block');
                                $('.confrmation_overlay').css('display','block');
                                $('#pin').focus();
                    }
                            
                    }else{
                        
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
                        }

                            $('#payemntmode_sel').val('1');
                     
                    }else
                    {
                        $(".loaderror").css("display", "block");
                        $(".loaderror").addClass("billgenration_validate");
                        $(".loaderror").text("Change Not Possible");
                        $(".loaderror").delay(2000).fadeOut('slow');
                    }

                });
                
 $('.authcahngepayment').click(function () {
	
	var paymentmode_chge	=$('#paymentmode_chge').val();
	var amountpaid_chge		=$('#amountpaid_chge').val();//alert(amountpaid_chge)
	var balance_chge		=$('#balance_chge').val();
	var original_chge		=$('#original_chge').val();
	var bilno_chge			=$('#bilno_chge').val();
	
	 var selct			=paymentmode_chge;
	 
	 
	 var reasontext       =  $('#reasontext_chng').val();
	 var secretkey        =  $('#secretkey_chng').val();
	 var stafflist        =  $('#stafflist_chnge').val();
		
		
		 $.post("load_bill_history.php", {secretkey:secretkey,stafflist:stafflist,set:'secretkeycheck'},
		 function(data)
		 {
                                            
					data=$.trim(data);
					if(data=="ok")
					{  
	 var data_ch='';
	 var stafflist        =  $('#stafflist_chnge').val();
	 if(selct=="1")
		  {
			  var paid=amountpaid_chge;
			  var bal=balance_chge;
			  if(paid==0)
			  {
				  var hidenteramout= $('#hidenteramout').val();
				  $(".payment_pend_right_cash_error").css("display","block");
				  $(".payment_pend_right_cash_error").addClass("popup_validate");
				  $(".payment_pend_right_cash_error").text(hidenteramout);
				  $('.payment_pend_right_cash_error').delay(2000).fadeOut('slow');
			  }else
			  {
                              
                                 var stafflist        =  $('#stafflist_chnge').val();
			          data_ch = {
				 	"set"		: "paymentchangesettle",
					"type"		: selct,
					"billno" 	: bilno_chge,
					"paid"		: paid,
					"bal" 		: balance_chge,
					"secret"	: secretkey,
					"stafflist" : stafflist,
					"reasontext": reasontext
				  };
			  }
			 
				  
		  }else  if(selct=="2")
		  {
			  var trans=$('#transamt_chge').val();
			  var bankdetails=$('#bankname_chge').val();
			  
			 
			  if(trans!="" && bankdetails!='')
			   {
					var paid=amountpaid_chge;
					var bal=balance_chge;
					var transbal=$('#transbal_chge').val();
					var stafflist        =  $('#stafflist_chnge').val();//alert(stafflist);
					if(transbal=='0.00' && bal=='0')
					{
					    data_ch = {
							 "set"		: "paymentchangesettle",
							  "type"		: selct,
							  "billno" 	: bilno_chge,
							  "trans" :trans,
							  "bank" :bankdetails,
							  "paid": paid,
							  "bal" : bal,
							  "transbal":transbal,
					"secret"	: secretkey,
					"stafflist" : stafflist,
					"reasontext": reasontext
							};
					}else if(transbal!='0.00' && bal!='0')
					{
						 data_ch = {
							  "set"		: "paymentchangesettle",
							  "type"		: selct,
							  "billno" 	:bilno_chge,
							  "trans" :trans,
							  "bank" :bankdetails,
							  "paid": paid,
							  "bal" : bal,
							  "transbal":transbal,
					"secret"	: secretkey,
					"stafflist" : stafflist,
					"reasontext": reasontext
							};
					}else if((transbal<'0') && bal=='0')
						  {
							   data_ch = {
							  "set"		: "paymentchangesettle",
							  "type"		: selct,
							  "billno" 	: bilno_chge,
							  "trans" :trans,
							  "bank" :bankdetails,
							  "paid": paid,
							  "bal" : bal,
							  "transbal":transbal,
							  "secret"	: secretkey,
							  "stafflist" : stafflist,
							  "reasontext": reasontext
							};
						  }
					else
					{
					var hidinsufamout= $('#hidinsufamout').val();
						 $(".payment_pend_right_cash_error").css("display","block");
						 $(".payment_pend_right_cash_error").addClass("popup_validate");
						 $(".payment_pend_right_cash_error").text(hidinsufamout);
						 $('.payment_pend_right_cash_error').delay(2000).fadeOut('slow');
					}
				 }else
				 {var hidentertranstndt= $('#hidentertranstndt').val();
					 $(".payment_pend_right_cash_error").css("display","block");
					 $(".payment_pend_right_cash_error").addClass("popup_validate");
				     $(".payment_pend_right_cash_error").text(hidentertranstndt);
				     $('.payment_pend_right_cash_error').delay(2000).fadeOut('slow');
				 }
		  }
		  
		  
		  
		  
		   var  data = $(this).serialize() + "&" + $.param(data_ch);//alert(data);
			 $.ajax({
					type: "POST",
					url: "load_bill_history.php",
					data: data,
					success: function(msg)
					{//alert(msg)
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
					
					 
								var billno       =  $('.bill_history_active').attr("billno");//alert(billno)
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
					}else
					{
						var tp='';
						var stafflist       = $("#stafflist_chnge").find('option:selected').attr('cancelkey');//alert(stafflist);
						var psd=$("#hidenterpaswd").val();
						var otp=$("#hidenterotp").val();
						var err=$("#hiderrormg").val();
						if(stafflist=='Y')
						{
							tp=otp;
						}else
						{
							tp=psd;
						}//alert(tp);
						$("#deatilserror_2").css("display","block");
						$("#deatilserror_2").text(tp+" "+err +"!!");
						$("#deatilserror_2").delay(2000).fadeOut('slow');
					}
					});
	 
	 
	 });
	 /***************************************  payment change ends ******************************************************************  */
	 
	  /***************************************  staff starts ******************************************************************  */
   $('#stafflist_chnge').change(function () { 
		var stafflist       = $("#stafflist_chnge").find('option:selected').attr('cancelkey');//alert(stafflist);
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
	 
	 
	 $('.sendotp_chg').click(function () {
	
	//alert("h");
		var stafflist       =  $('#stafflist_chnge').val();//alert(stafflist);
		stafflist=$.trim(stafflist);
		var hidotpsend_msg=$("#hidotpsend_msg").val();
		$.post("load_bill_history.php", {stafflist:stafflist,set:'sendotp'},
			function(data)
			{
			data=$.trim(data);
			
			$("#deatilserror_2").css("display","block");
			$("#deatilserror_2").text(hidotpsend_msg);
			$("#deatilserror_2").delay(2000).fadeOut('slow');
			
			});
	 
	 
	 });
         
    
}); 
$(document).keyup(function(e){
     e.preventDefault();
    if (e.keyCode == 27) {
        
        if($('.kotcancel_reason_popup_new:visible').length == 1)
            {   
                 $('.kotcancel_reason_popup_new').css("display","none");
                $(".confrmation_overlay").css("display","none");
            } 
        if($('.closeoneclass:visible').length == 1)
            {   
                $('.closeoneclass').css("display","none");
                $(".confrmation_overlay").css("display","none");
            }     
    }
}); 

	function unique(list) {
    var result = [];
    $.each(list, function(i, e) {
        if ($.inArray(e, result) == -1) result.push(e);
    });
    return result;
}


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
					var hidincrtcoupamt= $('#hidincrtcoupamt').val();
				 $(".payment_pend_right_cash_error").css("display","block");
				 $(".payment_pend_right_cash_error").addClass("popup_validate");
			 	 $(".payment_pend_right_cash_error").text(hidincrtcoupamt);
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
			{var hidincrtchqamt= $('#hidincrtchqamt').val();
				 $(".payment_pend_right_cash_error").css("display","block");
				 $(".payment_pend_right_cash_error").addClass("popup_validate");
			 	$(".payment_pend_right_cash_error").text(hidincrtchqamt);
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
			var tt=0;
			var gd=parseFloat( $('#grand_total').text().replace(',',''));
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
				
			document.getElementById("transbal").value=tt.toFixed(2);
			if(tt==0)
			{
				$("#paidamount").val('0');
				$("#balanceamout").val('0');
                               
			}
			}
   
		}
	/*****************************************  calculation ends ******************************************************************  */
	
	/*****************************************  balance calc starts ******************************************************************  */
	function enterbalance()
	  {     
             
                var decimal= $('#decimal').val();
	  	var paid=$('#paidamount').val();//alert(paid)
		var grand       =  $('#grand_total').text().replace(',',''); //alert($('.tax_textbox').val());
		// var grand=$('#grandtotal').text();
                
                
               
		if($('.pay_method_check').val()==1)
		 {  
		 	var bal=(parseFloat(paid.replace(/,/g, "")) -  parseFloat(grand.replace(/,/g, ""))).toFixed(decimal);
                        
		 }else if($('.pay_method_check').val()==2)
		 {
		 	if($('#transbal').val()!="")
			 {
			  	 var subt=$('#transbal').val();
			     	 var bal=(parseFloat(paid.replace(/,/g, "")) -  parseFloat(subt.replace(/,/g, ""))).toFixed(decimal);
				 
			 }
		 } 
		
          
		 if(bal<0)
			 {
				
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
	  
	  function enterbalance_credit()
	  {
	  	var paid=$('#paidamount_credit').val();
		  var letterNumber = /^[0-9]+$/; 
		  var bal; 
		 if(($('#paidamount_credit').val().match(letterNumber)))
		  {
			   var grand=$('#grand_total').text().replace(',','');
			    bal=parseFloat(grand.replace(/,/g, "")) -  parseFloat(paid.replace(/,/g, ""));
			  
		  }
		  
		   //var balamt=	$('#balanceamout_credit').val();
		  
		  
		
		 if(bal<=0)
			 {
				
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
          
          
               
        function numonly(evt)
     {
         evt = (evt) ? evt : window.event;
         var charCode = (evt.which) ? evt.which : evt.keyCode;
         if (charCode > 31 && charCode > 43 && (charCode < 48 || charCode > 57)) {

             return false;

         }
         return true;
     }
            
            
            
    function submitcustomer(){

         var bilcus = $('#bilcus').val();

         var csname=$('#csname').val();
          var csphone=$('#csphone').val();
           var csgst=$('#csgst').val();

       var datastringcus="set=customerdetail&cusbillno="+bilcus+"&csphone="+csphone+"&csname="+csname+"&csgst="+csgst;

   $.ajax({
    type: "POST",
    url: "load_bill_history.php",
    data: datastringcus,
    success: function(data)
    {

 var d=data.split('<');
 var d2=d[0].trim();
//alert(d2);
        if(d2=='ok'){
     alert("Customer details updated");
          }
    }

});


}

    function add_tip(){
        
        var tip_amount=0;
        var tip_mode='C';
        if($('#tip_feild').val()!='' && $('#tip_feild').val()>0){
            tip_amount=$('#tip_feild').val();
            tip_mode=$('#tip_pay_mode').val();
        }
        var billno       =  $('.bill_history_active').attr("billno");
        var data_tip="set=add_tip&tip_amount="+tip_amount+"&billno="+billno+"&tip_mode="+tip_mode;
        $.ajax({
            type: "POST",
            url: "load_bill_history.php",
            data: data_tip,
            success: function(data_return)
            {   
                $('#kotcancel_reason_popup_new_proceed_btn').removeClass('tip_click');
                $('.kotcancel_reason_popup_new').css('display','none');
                $('.confrmation_overlay').css('display','none');
                $('#tip_feild').val($.trim(data_return));
            }
        });
    }
    
    function charlimit(evt,value)
    {   
        evt = (evt) ? evt : window.event;
        var charCode = (evt.which) ? evt.which : evt.keyCode;

        if ((charCode<48 ||charCode>57) && charCode!=46)
        {
            return false;
        }else if(charCode==46 && value.includes('.')){
           return false; 
        }
        else if(value.length>13){
            return false;
        }
        return true;
    }
	/*****************************************  balance calc ends ******************************************************************  */