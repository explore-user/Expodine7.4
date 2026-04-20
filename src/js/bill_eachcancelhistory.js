// JavaScript Document
$(document).ready(function(){
 /***************************************  ok click starts ******************************************************************  */
   $('.closeok2').click(function () {
       
    
    
       if($("#reasontext").val()=="")
				{
                                     var rprntmode = $('#rprntmode').val();
                                    
                                if(rprntmode==''){
					$("#reasontext_div").addClass("has-error");
						  $("#deatilserror").text("Enter Reason");
                                                  alert("Enter Reason");
                       
						  return false;
                                              }
				}
                var billhistorymsg4 = ($("#billhistorymsg4").val());
		var billno       =  $('#hidbilnotosave').val();
		var slno       =  $('#hidslnotosave').val();

		var reasontext       =  $('#reasontext').val();
		var secretkey       =  $('#secretkey').val();
		var stafflist       =  $('#stafflist').val();
		$(' #typeentery ').text('');
		// alert(billno+slno+reasontext+secretkey)
		
		if(slno=='')
		{
                    
                    
                     
                  
                    
                    
                   
			
			$.post("load_bill_history.php", {secretkey:secretkey,stafflist:stafflist,set:'secretkeycheck'},
			function(data)
			{
			data=$.trim(data);
			if(data=="ok")
			{
                            var rprntmode = $('#rprntmode').val();
                            if(rprntmode=='rprnt'){
                                $('#reasontext').hide();
                                var hidbilprint= $('#hidbilprint').val();
                            var billno       =  $('.bill_history_active').attr("billno");
                            $.post("print_details.php", {bilno:billno,set:'billprint'},
                              function(data)
                              {
                              data=$.trim(data);
                              $(".loaderror").css("display","block");
                              $(".loaderror").addClass("billgenration_validate");
                              $(".loaderror").text(hidbilprint);
                              $(".loaderror").delay(2000).fadeOut('slow');
                              });
                              $.post("load_bill_history.php", {billno:billno,set:'billdetailsset1'},
                                      function(data)
                                      {
                                            data=$.trim(data);
                                            $('#detailsset1').html(data);
                                      });
                            }else if(rprntmode=='chng'){
                               
                                
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
                            else{
                                var billno       =  $('#hidbilnotosave').val();
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
			  
                          
//       var datastringnewcard="sethistory=delhistory&bilcardhistory="+billno;
//  
//                                    $.ajax({
//                                     type: "POST",
//                                     url: "payment_pending.php",
//                                     data: datastringnewcard,
//                                     success: function(data)
//                                     { 
//
//                                     }
//                                 });
    
//     $.post("smsvoid.php", {set:'smsvoid',billno1:billno},
//				  function(data)
//				  {
//				  	//alert(data);
//				  });
                          
                          
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
                        $('.closeoneclass2').css('display','none');
			$('.closeoneclass3').css('display','none');
			$('.confrmation_overlay').css('display','none');
			}else
			{
                            //alert(billhistorymsg4);
			 		$("#deatilserror").css("display","block");
				  // $("#deatilserror").addClass("billgenration_validate");
			 		$("#deatilserror").text('INVALID USER!');
					$("#deatilserror").delay(2000).fadeOut('slow');
			}
			});
		}else
		{
		
		$.post("load_bill_history.php", {secretkey:secretkey,stafflist:stafflist,set:'secretkeycheck'},
			function(data)
			{
			data=$.trim(data);
			if(data=="ok")
			{//alert("bill="+billno+"slno="+slno+"reason="+reasontext+"secret="+secretkey+"staff="+stafflist);
				var stafflist       =  $('#stafflist').val();
		//alert(data+"sec");
				  $.post("load_bill_history.php", {billno:billno,slno:slno,reasontext:reasontext,secretkey:secretkey,stafflist:stafflist,set:'cancelbilleditem'},
				  function(data)
				  {
				  data=$.trim(data);
				  if(data=="ok")
				  {//alert(data+"canc");
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
						$('.closeoneclass2').css('display','none');
						$('.closeoneclass3').css('display','none');
						$('.confrmation_overlay').css('display','none');
						$('#hidbilnotosave').val('');
						$('#hidslnotosave').val('');
						$('#reasontext').val('');
						$('#secretkey').val('');
		  
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
				  // $("#deatilserror").addClass("billgenration_validate");
			 		$("#deatilserror").text(tp+" "+err +"!!");
					
			 		//$("#deatilserror").css("display","block");
				  // $("#deatilserror").addClass("billgenration_validate");
			 		//$("#deatilserror").text("OTP Error!!");
					$("#deatilserror").delay(2000).fadeOut('slow');
			}
			});
		}
	
  
	});
	 /***************************************  ok click ends ******************************************************************  */
	 
	  /***************************************  ok click starts ******************************************************************  */
  /* $('.sendotp').click(function () {
		var stafflist       =  $('#stafflist').val();//alert(stafflist);
		stafflist=$.trim(stafflist);
		$.post("load_bill_history.php", {stafflist:stafflist,set:'sendotp'},
			function(data)
			{
			data=$.trim(data);
			//alert(data);
			});
	 
	 
	 });*/
	 /***************************************  ok click ends ******************************************************************  */
	 
	  /***************************************  ok click starts ******************************************************************  */
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
	 /***************************************  ok click ends ******************************************************************  */

}); 