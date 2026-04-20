// JavaScript Document

$(document).ready(function(){
    
    
    
    $('.staff_asign_tab_open_contant_bill_cc').click(function (event){
        
       event.stopImmediatePropagation();
       $('.staff_asign_tab_open_contant_bill_cc').removeClass('staff_asign_tab_open_contant_bill_cc_act');
       $(this).addClass('staff_asign_tab_open_contant_bill_cc_act');
       $('#hdnbillno').val($(this).attr('billno'));
       $('#hdnbillno1').text($(this).attr('billno'));
     
       //order details
        var billno = $(this).attr('billno');
        
        if(billno!='' && billno!='undefined' && billno!=undefined){
            
        
        var dataString = 'value=order_details&billno='+billno ;
        $.ajax({
            type: "POST",
            url: "load_staff_assign_detail.php",
            data: dataString,
            success: function(data) {
                $('#order_details').html(data);
                
                var status = $('#payment_status').val();
//                alert(status);
                
                if(status == 'Y'){
                    $('#staff_detail_settle_pop').hide();
                     $('#status_label').show();
                }else{
                    $('#staff_detail_settle_pop').show();
                    $('#status_label').hide();
                }
                $('#btn_update').show();
                $('#amount_payable').text($('#hdnamount_payable').val());
                
                var del_status = $('#hdndelivery_status').val();
                //alert(del_status);
                if(del_status == 'D'){
                    $('#drop_status').val('D');
                }else{
                    $('#drop_status').val('P');
                }
                
            }
        });
       //---------------
        }
    });
    
    
    $('#btn_update').click(function (event){
        event.stopImmediatePropagation();
        var billno = $('#hdnbillno').val();
        var del_status = $('#drop_status').val();
        var dataString = 'value=change_status&billno='+billno+'&del_status='+del_status ;
      
        $.ajax({
            type: "POST",
            url: "staff_assign_quaries.php",
            data: dataString,
            success: function(data) {
             
//                $('#order_details').html(data);
                //LOAD STAFF
                var name = '';
                var billno = '';
                var dataString = 'value=load_staff&staff='+name+'&billno='+billno ;
                $.ajax({
                    type: "POST",
                    url: "load_staff_assign_detail.php",
                    data: dataString,
                    success: function(data) {
                        $('#load_on_staff_tab').html(data);
                        var bill = $('#billnobystaff').val();
        //                $(this).find("li").addClass("uid_" + uid);
                    }
                });

                //---------
                 //LOAD ORDER
                var billno_search = '';
                 var contactno = '';
                var billno = '';
                var dataString = 'value=load_order&billno='+billno+'&billno_search='+billno_search+'&contactno='+contactno ;
                $.ajax({
                    type: "POST",
                    url: "load_staff_assign_detail.php",
                    data: dataString,
                    success: function(data) {
                        $('#load_on_order_tab').html(data);
                        var bill = $('#billno').val();
        //                alert(bill);
                        $('#'+bill+'').addClass('staff_asign_tab_open_contant_bill_cc_act');
                    }
                });

               
                    $('#order_details').empty();
                    $('#staff_detail_settle_pop').hide();
                    $('#status_label').hide();
                    $('#btn_update').hide();
                    $('#amount_payable').text('0.00');
                   
               //---------------
            }
        });
        
      
    });
    //pay
    $('#staff_detail_settle_pop').click(function (event){
 
        event.stopImmediatePropagation();
        
       
        
          var decimal=$('#decimal').val();
        dataString = 'value=getbill_amt';
        $.ajax({
        type: "POST",
        url: "load_takeaway.php",
        data: dataString,
        success: function(datax) {
            datax=datax.trim();

                var det=datax.split(",");

    window.location.href="take_away_.php?settacommon=settletapopup&billno_to_pay*"+det[0];

               // $(".settle_popup_in_take_away").css("display","block");
		//$(".confrmation_overlay").css("display","block");
                
//                $('#paidamount').focus();
//                $('#paidamount').select();
//                $('#focusedtext').val('paidamount');
//                $('#billdetails').text(det[0]);
//                 $('#paidamount').select('');
//                $('#final').text(parseFloat(det[3]).toFixed(decimal));
//                $('#grandtotal').text(parseFloat(det[1]).toFixed(decimal));
//            
//                if(det[4]=="")
//                {
//                    det[4]="0.00";
//                }
//               $('#totaldisc').text(parseFloat(det[2]).toFixed(decimal));
//                                                var taxnames=det[4].split('<>');
//                                                var taxvalues=det[5].split('<>');
//                                                if(taxnames!=''){
//                                                for(var j=0;j<taxnames.length;j++){
//                                                                                 
//                                                    $("#taxdetails_div").append('<div style="width:100%; " class="lable_counter_paymnet_cc counter_right_lable" id='+taxnames[j]+'>'+taxnames[j]+':<span >'+taxvalues[j]+'</span></div>') ;
//                                                }
//                                            }
        }
        });
         var dataString; 
			dataString = 'set=drawer_ta_open_settlepopup';
			$.ajax({
                            type: "POST",
                            url: "cashdrawer_details.php",
                            data: dataString,
                            success: function(data3) {
                                data3=data3.trim();
                            }
			});
    });
  
    //----------------------------------------payment settle starts-----------------------------------------------------------------------------------
        $('.submittranscations').click(function (event) {


		event.stopImmediatePropagation();
		//alert("h");
                var drct="drct";
		var payemntmode_sel =$('.mode_sel_btn_act').attr('id');//alert("hi"+payemntmode_sel);
                
		if(payemntmode_sel!='')
		{
		
		 if(payemntmode_sel=='credit_person'){
                var pd = $('#paidamount_credit').val();
             } else if(payemntmode_sel=='complimentary'){
                  var pd= $('#completext');
                }else{
                    var  pd =$('#paidamount').val(); 
                }
		  //alert(pd);
		  var selct=$('.mode_sel_btn_act').attr('id');
		  
		
//		   var selected_activities =$('.tr_bill_gen_active');
//		   var billno = new Array(); 
//			var tableid = new Array();
//			 var prefid = new Array();
//		   selected_activities.each(function(){
//			var id_str       =  $(this).attr("billno");
//				if(id_str!='undefined' && id_str!='' && id_str!=null){
//					billno.push(id_str);
//				}
//		  }); 
//		  billno=unique(billno)
//		  $.post("load_paymentpending.php", {bilno:billno[0],set:'setbillnotopay'},
//		  function(data)
//		  {
//		  data=$.trim(data);
//		 
//		  });
                  var billno = $("#hidbillno").val();
                  //alert("hi"+billno);
                  
		  var typenam=$('.mode_sel_btn_act').attr('idval');
            
                  
		  if(pd!="")
		  {// && IsNumeric(pd)
                      
			 // if(isFloat(pd) || (selct=="credit" && (pd==0 || pd>0)))
			 if(isFloat(pd))
						{ 
                                                    //alert("chk");
		  if(selct=="cash")
		  {
			  var paid=$('#paidamount').val();
			  var bal=$('#balanceamout').val();
			 
			   var grand=$('#grandtotal').text();
			  // alert("chk"+paid);
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
					"billno" 	: billno,
					"typenam"	: "1",
					"paid"		: paid,
					"bal" 		: bal,
                                        "stl" 		: drct
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
							  "billno" 	: billno,
							  "typenam"	: "2",
							  "trans" :trans,
							  "bank" :bankdetails,
							  "paid": paid,
							  "bal" : bal,
                                                          "stl" 		: drct
							};
					}else if(transbal!='0.00' && bal!='0')
					{
						var data = {
							  "set"		: "bill_settle_ta",
							  "type"		: selct,
							  "billno" 	: billno,
							  "typenam"	: "2",
							  "trans" :trans,
							  "bank" :bankdetails,
							  "paid": paid,
							  "bal" : bal,
                                                          "stl" 		: drct
							};
					}else if((transbal<'0') && bal=='0')
						  {
							  var data = {
							  "set"		: "bill_settle_ta",
							  "type"		: selct,
							  "billno" 	: billno,
							  "typenam"	: "2",
							  "trans" :trans,
							  "bank" :bankdetails,
							  "paid": paid,
							  "bal" : bal,
                                                          "stl" 		: drct
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
				 var entertrnsdt="Enter Bank  Details";
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
									  "billno" 	: billno,
									  "typenam"	: typenam,
									  "coup" :coup,
									  "coupamnt": coupamnt,
									  "coupbal" : coupbal,
									  "paid": paid,
									  "bal" : bal,
                                                                          "stl" 		: drct
									};
						  }else if(coupbal!='0.00' && bal!='0')
						  {
							   var data = {
									  "set"		: "bill_settle_ta",
									  "type"		: selct,
									  "billno" 	: billno,
									  "typenam"	: typenam,
									  "coup" :coup,
									  "coupamnt": coupamnt,
									  "coupbal" : coupbal,
									  "paid": paid,
									  "bal" : bal,
                                                                          "stl" 		: drct
									};
						  }else if((coupbal<'0') && bal=='0')
						  {
							   var data = {
									  "set"		: "bill_settle_ta",
									  "type"		: selct,
									  "billno" 	: billno,
									  "typenam"	: typenam,
									  "coup" :coup,
									  "coupamnt": coupamnt,
									  "coupbal" : coupbal,
									  "paid": paid,
									  "bal" : bal,
                                                                          "stl" 		: drct
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
							  "billno" 	: billno,
							  "typenam"	: typenam,
							  "vouchid" :vouchid,
							  "vocamount": vocamount,
							  "vouchbal" : vouchbal,
							  "paid": paid,
							  "bal" : bal,
                                                          "stl" 		: drct
							};
						  }else if((vouchbal!='0.00') && bal!='0')
						  {
							  
							  var data = {
							 "set"		: "bill_settle_ta",
							  "type"		: selct,
							  "billno" 	: billno,
							  "typenam"	: typenam,
							  "vouchid" :vouchid,
							  "vocamount": vocamount,
							  "vouchbal" : vouchbal,
							  "paid": paid,
							  "bal" : bal,
                                                          "stl" 		: drct
							};
						  }else if((vouchbal<'0') && bal=='0')
						  {
							   var data = {
							  "set"		: "bill_settle_ta",
							  "type"		: selct,
							  "billno" 	: billno,
							  "typenam"	: typenam,
							  "vouchid" :vouchid,
							  "vocamount": vocamount,
							  "vouchbal" : vouchbal,
							  "paid": paid,
							  "bal" : bal,
                                                          "stl" 		: drct
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
								  "billno" 	: billno,
								  "typenam"	: "5",
								  "cheqbank" :cheqbank,
								  "cheqname": cheqname,
								  "cheqamt": cheqamt,
								  "paid": paid,
								  "bal" : bal,
                                                                  "stl" 		: drct
								};
						  }else if((cheqbal!='0.00') && bal!='0')
						  {
							  
							  var data = {
								  "set"		: "bill_settle_ta",
								  "type"		: selct,
								  "billno" 	: billno,
								  "typenam"	: "5",
								  "cheqbank" :cheqbank,
								  "cheqname": cheqname,
								  "cheqamt": cheqamt,
								  "paid": paid,
								  "bal" : bal,
                                                                  "stl" 		: drct
								};
						  }else if((cheqbal<'0') && bal=='0')
						  {
							   var data = {
								  "set"		: "bill_settle_ta",
								  "type"		: selct,
								  "billno" 	: billno,
								  "typenam"	: "5",
								  "cheqbank" :cheqbank,
								  "cheqname": cheqname,
								  "cheqamt": cheqamt,
								  "paid": paid,
								  "bal" : bal,
                                                                  "stl" 		: drct
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
			   }
                           else
			   { 
			   var enterchecknumber=$("#hidenterchecknumber").val();
				   $(".payment_pend_right_cash_error").css("display","block");
				    $(".payment_pend_right_cash_error").addClass("popup_validate");
			 		$(".payment_pend_right_cash_error").text(enterchecknumber);
					$('.payment_pend_right_cash_error').delay(2000).fadeOut('slow');
			   }
		   
			  
			  
			  }else if(selct=="complimentary")
				{  
		  			var comp=$('#completext').val();
					if(comp!='')
					  {
						   data = {
								  "set"		: "bill_settle_ta",
                                                                 
								  "type"		: selct,
								  "typenam"		: "7",
								  "comp"		: comp,
                                                                  "stl" 		: drct
								};
						  
					  }else
					  {var paymentmsg1 = ($("#paymentmsg1").val());
						  $(".payment_pend_right_cash_error").css("display","block");
						  $(".payment_pend_right_cash_error").addClass("popup_validate");
						  $(".payment_pend_right_cash_error").text(paymentmsg1);
						  $('.payment_pend_right_cash_error').delay(2000).fadeOut('slow');
					  }
	   
			
				}
                                else if(selct=="credit_person"){
                                    
                                    var balanceamout_credit=$('#balanceamout_credit').val();
                                    if(balanceamout_credit!="0"){
                                    var creditype=$('#selectcreditypes').val();
					  var creditdeatils=$('#selectcreditdetails').val();
					  var paidamount_credit=$('#paidamount_credit').val();
					  var amount_credit=$('#amount_credit').val();
					  var credit_remarks_ta=$('#credit_remark_hd').val();
                                         
					  if(creditype!='')
					  {
						  if(creditdeatils!='')
						  {
							   data = {
								  "set"					: "bill_settle_ta",
								  "type"				: selct,
								  "typenam"				: "6",
								  "creditype"			: creditype,
								  "creditdeatils"		: creditdeatils,
								  "paidamount_credit"	: paidamount_credit,
								  "amount_credit"		: amount_credit,
								  "bal"				: balanceamout_credit,
                                                                  "stl" 		: drct,
                                                                  "credit_remarks_ta"     :credit_remarks_ta
								};
							  
						  }else
						  {
						  var sel_option="Select Option of ";
							  var labelname=$("#selectcreditypes").find('option:selected').attr('label');
							  $(".payment_pend_right_cash_error").css("display","block");
							  $(".payment_pend_right_cash_error").addClass("popup_validate");
							  $(".payment_pend_right_cash_error").text(sel_option +labelname);
							  $('.payment_pend_right_cash_error').delay(2000).fadeOut('slow');
						  }
					  }else
					  {var sel_credttype="Select credit type !"
						  $(".payment_pend_right_cash_error").css("display","block");
						  $(".payment_pend_right_cash_error").addClass("popup_validate");
						  $(".payment_pend_right_cash_error").text(sel_credttype);
						  $('.payment_pend_right_cash_error').delay(2000).fadeOut('slow');
					  }
                                }else{
                                    alert("Credit not possible");
                                }
                                }
                                
		 
		else
		{var entremt="Enter amount"
			$(".payment_pend_right_cash_error").css("display","block");
			$(".payment_pend_right_cash_error").addClass("popup_validate");
			$(".payment_pend_right_cash_error").text(entremt);
			$('.payment_pend_right_cash_error').delay(2000).fadeOut('slow');
		}
		
		}else
		{
			var comp=$('#completext').val();
					if(comp!='')
					  {
						   data = {
								  "set"		: "bill_settle_ta",
                                                                 
								  "type"		: selct,
								  "typenam"		: "7",
								  "comp"		: comp,
                                                                  "stl" 		: drct
								};
                                                            }
			var incrt_amt="Incorrect amount";
			$(".payment_pend_right_cash_error").css("display","block");
			$(".payment_pend_right_cash_error").addClass("popup_validate");
			$(".payment_pend_right_cash_error").text(incrt_amt);
			$('.payment_pend_right_cash_error').delay(2000).fadeOut('slow');
			
		}
		  }else
		{
			var entremt="Enter amount";
			$(".payment_pend_right_cash_error").css("display","block");
			$(".payment_pend_right_cash_error").addClass("popup_validate");
			$(".payment_pend_right_cash_error").text(entremt);
			$('.payment_pend_right_cash_error').delay(2000).fadeOut('slow');
			
		}
		  //data=data+"&setl:drct";
                 // alert(data);
		     data = $(this).serialize() + "&" + $.param(data);//alert(data);
			 $.ajax({
					type: "POST",
					url: "load_payments_ta_cs.php",
					data: data,
					success: function(msg)
					{  
//						var modeval=	$('#typesele').val();
//						$.post("load_payments_ta_cs.php", {modeval:modeval,set:'loadta_billdetails'},
//				  function(data1)
//				  {
//				  $('#load_billfullist').html(data1);
//				   $('.loadallhead').load("load_payments_ta_cs.php?set=loadtablehead");	
				   
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
							  //$('.paid_amount_cc').css("display","none");
							  
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
						
						 			  
					 
//						});
						
                                                if($("#settle_btn").hasClass("enable")){
                                                    $(".settle_popup_in_take_away").css("display","none");
//                                                   // $(".confrmation_overlay").css("display","block");
//                                                    $(".payment_pend_popup").css("display","block");
//                                                    $(".confrmation_overlay_1").css("display","block"); 
                                                     var modeval;
                                                    if($("#payment_pending_all").hasClass('take_away_payment_pend_sort_btn_act')){
                                                        modeval="ALL";
                                                        
                                                         
                                                    }else if($("#payment_pending_ta").hasClass('take_away_payment_pend_sort_btn_act')){
                                                        modeval="TA";
                                                        $("#payment_pending_all").removeClass('take_away_payment_pend_sort_btn_act');
                                                    }if($("#payment_pending_hd").hasClass('take_away_payment_pend_sort_btn_act')){
                                                        modeval="HD";
                                                        $("#payment_pending_all").removeClass('take_away_payment_pend_sort_btn_act');
                                                    }
                                                    //----------payment pending popup---
                                                        //$("#payment_pend_pop_btn").trigger('click');
                                                         $( ".paymnet_pop_mode_chnge" ).addClass( "mode_chg" );
                                                        $( ".paymnet_pop_mode_chnge_1" ).removeClass( "mode_chg" );
                                                        $(".paymnet_pop_mode_chnge").css("display","block");
                                                        $(".paymnet_pop_mode_chnge_1").css("display","none");

                                                        $(".payment_pend_popup").css("display","block");
                                                        $(".confrmation_overlay").css("display","block");
                                                   
                                                    //----------payment pending popup---
                                                   
                                                   
                                                    $('.payment_pend_popup_left_cc').html('<img src="img/ajax-loaders/ajax-loader-6.gif" />');
                                                    $.post("load_payments_takeaway.php", {modeval:modeval,set:'loadta_billdetails'},
                                                        function(data)
                                                        {
                                                            $('.payment_pend_popup_left_cc').html(data);
//                                                            $("#"+billno+"").addClass("payment_pend_bill_cc_act");
                                                            $(".payment_pending_botm_btn ").removeClass("enable")
                                                        });
                                                        
                                                        $.post("load_payments_takeaway.php", {billno:"",set:'loadta_billitems'},
                                                        function(data)
                                                        {
                                                            $('.payment_pend_popup_right_tbl').html(data);
                                                             $("#total").text("0.00");
                                                        });
                                                        
                                                        
                                                   //
                                               }else{
						window.location ='staff_assign_detail.php';
                                            }
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
//-------------------------------------------------payment settle ends-----------------------------------------------------------------

    

});
      
 //staff name search
    function search_staff_name(){
  
        var name = $('#staff_search_txt').val();
           //LOAD STAFF
        var billno = '';
        var dataString = 'value=load_staff&staff='+name+'&billno='+billno ;
        $.ajax({
            type: "POST",
            url: "load_staff_assign_detail.php",
            data: dataString,
            success: function(data) {
                $('#load_on_staff_tab').html(data);
//                var bill = $('#billnobystaff').val();
                
            }
        });

        //---------
    }
    //--------------- 
    //staff name search
    function search_bill_no(){
        $('#search_contact_no').val('');
        var billno_search = $('#search_billno').val();
        var contactno = '';
         //LOAD ORDER
        var billno = $('.staff_asign_tab_open_contant_bill_cc_act').attr('id');
        var dataString = 'value=load_order&billno='+billno+'&billno_search='+billno_search+'&contactno='+contactno ;
        $.ajax({
            type: "POST",
            url: "load_staff_assign_detail.php",
            data: dataString,
            success: function(data) {
                $('#load_on_order_tab').html(data);
                var bill = $('#billno').val();
//                alert(bill);
                $('#'+bill+'').addClass('staff_asign_tab_open_contant_bill_cc_act');
            }
        });

        //---------
    }
    //---------------  
//staff name search
    function search_contact_no(){
        $('#search_billno').val('');
        var contactno = $('#search_contact_no').val();
//        alert(contactno);
        var billno_search = '';
         //LOAD ORDER
        var billno = $('.staff_asign_tab_open_contant_bill_cc_act').attr('id');
        var dataString = 'value=load_order&billno='+billno+'&billno_search='+billno_search+'&contactno='+contactno;
        $.ajax({
            type: "POST",
            url: "load_staff_assign_detail.php",
            data: dataString,
            success: function(data) {
                $('#load_on_order_tab').html(data);
                var bill = $('#billno').val();
//                alert(bill);
                $('#'+bill+'').addClass('staff_asign_tab_open_contant_bill_cc_act');
            }
        });

        //---------
    }
    
    $('#selectcreditypes').change(function () {	 
       
			  var credittype=	$(this).val();//alert(credittype)
			 $('.credtitypeloads').html('<img src="img/ajax-loaders/ajax-loader-6.gif" />');
			 var labelname=$("#selectcreditypes").find('option:selected').attr('label');
			 
			
			// alert(credittype);
			  $.post("load_takeaway.php", {credittype:credittype,value:'loadcreditypes'},
				  function(data)
				  {//alert(data);
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
        function enterbalance_credit(e)
	  { 
		 // if(e.keyCode === 13){
	  	var paid=$('#paidamount_credit').val();
                var grand=$('#grandtotal').text();
		  var letterNumber = /^[0-9 .]+$/; 
		  var bal; 
		 if(($('#paidamount_credit').val().match(letterNumber)))
		  {
			   var grand=$('#grandtotal').text();
			    bal=parseFloat(grand.replace(/,/g, "")) -  parseFloat(paid.replace(/,/g, ""));
			  
		  }
		  
                  if(paid==grand){
                     $('#balanceamout_credit').val('0');
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
					 $('#amount_credit').val(bal.toFixed(3));
				 }else
				 {
					 if(bal=='0' && $('#paidamount_credit').val()!='0')
					 {
						 $('#amount_credit').val('0'); 
					 }
                                         else
					 {
						 
					 var grnd=$('#grandtotal').text();
					$('#amount_credit').val(grnd.toFixed(3)); 
					 }
				 }
		   
					$('#balanceamout_credit').val(bal.toFixed(3));
			 }
		  //}
		  
	  }
    //---------------  
    



