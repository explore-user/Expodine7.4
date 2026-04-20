// JavaScript Document
$(document).ready(function(){

	/*************************************  floor selection starts **********************************************************  */
	$('#areachnage').change(function () {	 
            
             $('#grandtotal_sec').text('0');  
                        $('#grandtotal_sec_sub').text('0');  
            
			  var flr_id=	$(this).val();
			  $('#billdetails').load("load_paymentpending.php?set=loadbilldetails_total");
			 $('.paymentclose').css("display","none");
			 $('.paid_amount_cc').css("display","none");
			  $('#loadtotalrate').text('');
			  $('#grandtotal').text('');  
			  $('.closetranscations').css("display","none");
			 $('.submittranscations_whole').css("display","none");
			 
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
			  $.post("load_paymentpending.php", {floorid:flr_id,set:'loadbilldetails'},
				  function(data)
				  {
				  $('#load_billfullist').html(data);
				   $('.loadallhead').load("load_paymentpending.php?set=loadtablehead");		  
				  });
	});
			  
	/***************************************  floor selection ends **********************************************************  */
	
	/*************************************  credit types starts **********************************************************  */
	$('#selectcreditypes').change(function () {	
            
            var pd1=$('#paidamount_credit').val();
            var gr1=$('#grandtotal').text();
            var sm1=gr1-pd1;
            
            
           
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
				  
				    
				  });
	});
			  
	/***************************************  credit types ends **********************************************************  */
	
	
	
	/*************************************  verify starts **********************************************************  */
        
        
        
        
         $('#settle_check').click(function (event) {
            if($('.head_change').text()=="Settle Authorization"){
                
                var pin= $('#pin_pay').val();
                if(pin !=''){
                $.post("load_div.php", {set:'pincheck',pin:pin,type:'authpincheck'},
                function(data)
                {
                    
                        if($.trim(data)!='NO'){
                    var check=$.trim(data).split('*');
                 
                    if(check[11]=="billsettle:Y"){
                         $('.settle_back_view').hide();
                             var crd_permission=$('#credit_view_per').val();
              var comp_permission=$('#comp_view_per').val();
      if(crd_permission=="N"){
      $('#credit_person').hide();
        }
     if(comp_permission=="N"){
      $('#complimentary').hide();
       }
             
            $('#paidamount').val('');
            $('#coupname').val('');
            $('#coupamount').val('');
            $('#coupbal').val('');
            $('#balanceamout').val('');
                    
        var sel22=$('#curshow').val();
         
        var sel=$('#bscur').val();
     
        var datastringnew22="set=cat1&idofcur="+sel;
      
        $.ajax({
        type: "POST",
        url: "payment_pending.php",
        data: datastringnew22,
        success: function(data)
        {
     
        }
        
        });
     
        var datastringnew13="set1=cat11&idofcur1="+sel;
       
        $.ajax({
        type: "POST",
        url: "payment_pending.php",
        data: datastringnew13,
        success: function(data)
        {
        
        }
        
        });
        
            if(sel22=="Y"){
                 $('#focusedtext1').val('curpaid'); 
            
         }else {
             $('#focusedtext1').val('paidamount'); 
         }

             if($('#billedno').val()!=''){
                 
               $('#settleingbilno').text($('#billedno').val());
                } else{
                     
                $('#settleingbilno').text($('#bill').val());
                }
           
		if($('.clickeachrowpaymnt').hasClass('tr_bill_gen_active') )
		{
                    
                    $('.counter_settle_popup').css("display","block");
                    $('.confrmation_overlay').css("display","block");
                    $('.submittranscations').removeClass("disable");

                    
                         var selected_activities =$('.tr_bill_gen_active');
			 var billno = new Array(); 
			
			  selected_activities.each(function(){
			  var id_str       =  $('.settlethetables').attr("billno");
		          if(id_str!='undefined' && id_str!='' && id_str!=null){
			  billno.push(id_str);
			  }
			  
			}); 
                       
                         var selected_activities =$('.tr_bill_gen_active');
			 var bill_amount = new Array(); 
			
			  selected_activities.each(function(){
			  var id_amt       =  $('.settlethetables').attr("final_total");
		          if(id_amt!='undefined' && id_amt!='' && id_amt!=null){
			  bill_amount.push(id_amt);
			  }
			  
			}); 
                    
			var data_pole = 'set_pole=pole_display_all&pole_bill='+billno+"&pole_amount="+bill_amount+"&display=show";
			$.ajax({
			type: "POST",
			url: "index.php",
			data: data_pole,
			success: function(data5) {
			
			}
			});
                       
			$('.paymentclose').css("display","block");
			$('.paid_amount_cc').css("display","block");
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
			
			$('#cash').click();
			
					  var dataString; 
							dataString = 'set=drawer_open';
							 $.ajax({
							type: "POST",
							url: "cashdrawer_details.php",
							data: dataString,
							success: function(data3) {
								data3=data3.trim();
							
								
								}
							       });
				
					
	 $('#loyalty_btn').click();	
}
else
{
var selbil=$('#hidselbiltopr').val();
$(".error_feed").css("display","block");
$(".error_feed").addClass("billgenration_validate");
$(".error_feed").text(selbil);
$(".error_feed").delay(2000).fadeOut('slow');
}
                        
                    }else{  
                        $('#pin_error_split').css("display",'block');
                         $('#pin_error_split').text('No Permission');
                       $('#pin_error_split').delay(2000).fadeOut('slow');
                       $('#pin_pay').val('');
                         $('#pin_pay').focus();
                   }
             }else{ 
                  $('#pin_error_split').css("display",'block');
                         $('#pin_error_split').text('Code Not Registered');
                       $('#pin_error_split').delay(2000).fadeOut('slow');
                       $('#pin_pay').val('');
                         $('#pin_pay').focus();
             }
         });
     }else{ 
     $('#pin_error_split').css("display",'block');
                         $('#pin_error_split').text('Enter Pin');
                       $('#pin_error_split').delay(2000).fadeOut('slow');
                       $('#pin_pay').val('');
                          $('#pin_pay').focus();
                 }
 }
         });
        
        
        
        
        
	
$('.settlethetables').click(function (event) {
             
             var entry=$('#mode_of_entry').val();
            
    if(entry=="Card/Pin"){
        
          $('#pay_check').hide();
         $('#settle_check').show();
         
        $('.settle_back_view').show();
        $('.confrmation_overlay').show();
        $('.head_change').text('Settle Authorization')
        $('#pin_pay').focus();
        $('#pin_pay').val('');
    }else{
              var crd_permission=$('#credit_view_per').val();
              var comp_permission=$('#comp_view_per').val();
      if(crd_permission=="N"){
      $('#credit_person').hide();
        }
     if(comp_permission=="N"){
      $('#complimentary').hide();
       }
             
            $('#paidamount').val('');
            $('#coupname').val('');
            $('#coupamount').val('');
            $('#coupbal').val('');
            $('#balanceamout').val('');
                    
        var sel22=$('#curshow').val();
         
        var sel=$('#bscur').val();
     
        var datastringnew22="set=cat1&idofcur="+sel;
      
        $.ajax({
        type: "POST",
        url: "payment_pending.php",
        data: datastringnew22,
        success: function(data)
        {
     
        }
        
        });
     
        var datastringnew13="set1=cat11&idofcur1="+sel;
       
        $.ajax({
        type: "POST",
        url: "payment_pending.php",
        data: datastringnew13,
        success: function(data)
        {
        
        }
        
        });
        
            if(sel22=="Y"){
                 $('#focusedtext1').val('curpaid'); 
            
         }else {
             $('#focusedtext1').val('paidamount'); 
         }

             if($('#billedno').val()!=''){
                 
               $('#settleingbilno').text($('#billedno').val());
                } else{
                     
                $('#settleingbilno').text($('#bill').val());
                }
           
		if($('.clickeachrowpaymnt').hasClass('tr_bill_gen_active') )
		{
                    
                    $('.counter_settle_popup').css("display","block");
                    $('.confrmation_overlay').css("display","block");
                    $('.submittranscations').removeClass("disable");

                    
                         var selected_activities =$('.tr_bill_gen_active');
			 var billno = new Array(); 
			
			  selected_activities.each(function(){
			  var id_str       =  $(this).attr("billno");
		          if(id_str!='undefined' && id_str!='' && id_str!=null){
			  billno.push(id_str);
			  }
			  
			}); 
                       
                         var selected_activities =$('.tr_bill_gen_active');
			 var bill_amount = new Array(); 
			
			  selected_activities.each(function(){
			  var id_amt       =  $(this).attr("final_total");
		          if(id_amt!='undefined' && id_amt!='' && id_amt!=null){
			  bill_amount.push(id_amt);
			  }
			  
			}); 
                    
			var data_pole = 'set_pole=pole_display_all&pole_bill='+billno+"&pole_amount="+bill_amount+"&display=show";
			$.ajax({
			type: "POST",
			url: "index.php",
			data: data_pole,
			success: function(data5) {
			
			}
			});
                       
			$('.paymentclose').css("display","block");
			$('.paid_amount_cc').css("display","block");
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
			
			$('#cash').click();
			
					  var dataString; 
							dataString = 'set=drawer_open';
							 $.ajax({
							type: "POST",
							url: "cashdrawer_details.php",
							data: dataString,
							success: function(data3) {
								data3=data3.trim();
							
								
								}
							       });
				
					
	 $('#loyalty_btn').click();	
}
else
{
var selbil=$('#hidselbiltopr').val();
$(".error_feed").css("display","block");
$(".error_feed").addClass("billgenration_validate");
$(".error_feed").text(selbil);
$(".error_feed").delay(2000).fadeOut('slow');
}
         }
});
			  
	/***************************************  verify ends **********************************************************  */
	
   $('.confirmkotok_reprint_di').click(function (event) { 
       $('.kotconfirmpopup_reprint_di').css('display','none');   
             
        $(".confrmation_overlay").css("display","none");
          if($('#hidbilreprint').val()=='Y')
			{
                            if($('#hidauthorise_with_code').val()=='Y'){
                                $('.kotcancel_reason_popup_new').css('display','block');
				$('.confrmation_overlay').css('display','block');
                                $("#rsn").css("display","none"); 
                                $("#pin").focus();
                             
                            }else{
                                $('.loadcanceldetails').css('display','block');
				$('.confrmation_overlay').css('display','block');
                                //alert("Bill reprint autherisation is ON!");
                            }
						  
			}else{
                            
                         //$('#kotcancel_reason_popup_new_proceed_btn').click();
                         
                               
                                               
                                        var paymentmsg2 = ($("#paymentmsg2").val());
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
                                                   //alert(billno[0]);
                                                   //------------
                                                    $.post("print_details.php", {bilno:billno[0],bill_reprint:'Y',set:'billprint'},
                                                                           function(data)
                                                                           {
                                                                           data=$.trim(data);
                                                                           //alert(data);
                                                                           $(".error_feed").css("display","block");
                                                                           $(".error_feed").addClass("billgenration_validate");
                                                                       $(".error_feed").text(paymentmsg2);
                                                                       $(".error_feed").delay(2000).fadeOut('slow');

                                                                           });
                                                     //-----------------    
						
						$('.kotcancel_reason_popup_new').css('display','none');
                                                $('.confrmation_overlay').css('display','none');
                                                $('#pin').val('');
                                            
                        //---------------
			
                     }
        
        
   });  
        
       $('.confirmkotclose_reprint_di').click(function (event) { 
           
        $('.kotconfirmpopup_reprint_di').css('display','none');   
             
               $(".confrmation_overlay").css("display","none");
               location.reload();
     });     
        
	
	/*************************************  re generate starts **********************************************************  */
	$('.threebtn').click(function (event) { 
         
            var mode = $(this).attr('mode');
            $('#btn_mode').val(mode);
            
            if($('.clickeachrowpaymnt').hasClass('tr_bill_gen_active') )
		{
                    if(mode=='Regen'){
                        
			//--------------
                        
                        
			var selected_activities =$('.tr_bill_gen_active');
					 var regen = new Array(); 
					 selected_activities.each(function(){
					  var id_str       =  $(this).attr("regen");
						  if(id_str!='undefined' && id_str!='' && id_str!=null){
							  regen.push(id_str);
						  }
					});
					var uniqueNames = [];
			  for(var i in regen){
				  if(uniqueNames.indexOf(regen[i]) === -1){
					  uniqueNames.push(regen[i]);
				  }
			  } 
			  if(uniqueNames=="Y")
			  {
                             
					  if($('#hidbilgenper').val()=='Y')
					  {
                                              
                                              if($('#hidauthorise_with_code').val()=='Y'){
                                                  $('.kotcancel_reason_popup_new').css('display','block');
						  $('.confrmation_overlay').css('display','block');
                                                  $("#rsn").css("display","block"); 
                                                  $('#pin').focus();
                                                 // alert('ff');
                                              }else{
                                                  $('.loadcanceldetails').css('display','block');
						  $('.confrmation_overlay').css('display','block');
                                              }
						  
					  }else
					  {
                                             // $('#kotcancel_reason_popup_new_proceed_btn').click();
                                              
                                                 
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
                                                
                                                
             var dataString_log ='set=regen_split&billno_regen='+billno;
             $.ajax({
             type: "POST",
             url: "load_paymentpending.php",
             data: dataString_log,
             success: function(data) {
             var split_permission=$.trim(data);
            if(split_permission=="N"){
                     
                                                
						  var stafflist        =  '';
                                                  var reasontext = $('#reasontxt').val();
						 // alert(stafflist)
						 var hidproc_regen=$('#hidproc_regen').val();
						   $.post("load_paymentpending.php", {reasontext:reasontext,secretkey:'',stafflist:stafflist,bilno:billno[0],set:'billregenerate'},
							function(data2)
							{
                                                           
								data2=$.trim(data2);
								if(data2.indexOf("exception") == -1)
										{
                                                                                     $('.kotcancel_reason_popup_new').css('display','none');
                                                                                     $('#pin').val('');
											$('.loadcanceldetails').css('display','none');
						 					$('.confrmation_overlay').css('display','none');	  
											$(".error_feed").css("display","block");
											$(".error_feed").addClass("billgenration_validate");
											$(".error_feed").text(hidproc_regen);
											$(".error_feed").delay(2000).fadeOut('slow');
											
											$('#reasontext').val('');
											$('#secretkey').val('');
											$('#typeentery').text('');
											$('#stafflist').find('option:first').attr('selected', 'selected');
                                                                                                $('#billdetails').load("load_paymentpending.php?set=loadbilldetails_total");
                                                                                                var flr_id=	$('#areachnage').val();				
												$.post("load_paymentpending.php", {floorid:flr_id,set:'loadbilldetails'},
												function(data)
												{
												data=$.trim(data);
												$('#load_billfullist').html(data);		  
												});
											
											
										}else {
											alert(data2)
										}
								
							
							});
             }else{
                $(".error_feed").css("display","block");
					  $(".error_feed").addClass("billgenration_validate");
					  $(".error_feed").text("Spliited Bill Can't Be Regenerated");
					  $(".error_feed").delay(3000).fadeOut('slow');
             }
						  }
                                               });
                                           
					  }
				  }else
				  {
					  var regner=$('#hidregennotpos').val();
					  $(".error_feed").css("display","block");
					  $(".error_feed").addClass("billgenration_validate");
					  $(".error_feed").text(regner);
					  $(".error_feed").delay(2000).fadeOut('slow');
					 
				  }
                       
                 }
                 else if(mode=='Reprnt'){
                     
                    var flr=$('.reprint_new').attr('fl_chk');
                  
                     
                     var Bill_reprint = "Bill_reprint";
            $.post("printercheck_1.php", {type:Bill_reprint,floor:flr},
                                               
            function(data)
            { 
            data=$.trim(data); 
           
            
            if(data !=0)
            { 
                                            
                                            
              $('.kotconfirmpopup_reprint_di').css('display','block');   
              $('#kotfailmsg_reprint_di').html(data);
               $(".confrmation_overlay").css("display","block");
   			                   
                                                      
            }else{
                   
                      if($('#hidbilreprint').val()=='Y')
			{
                            if($('#hidauthorise_with_code').val()=='Y'){
                                $('.kotcancel_reason_popup_new').css('display','block');
				$('.confrmation_overlay').css('display','block');
                                $("#rsn").css("display","none"); 
                                $("#pin").focus();
                            
                            }else{
                                $('.loadcanceldetails').css('display','block');
				$('.confrmation_overlay').css('display','block');
                                //alert("Bill reprint autherisation is ON!");
                            }
						  
			}else{
                            
                         //$('#kotcancel_reason_popup_new_proceed_btn').click();
                         
                               
                                               
                                        var paymentmsg2 = ($("#paymentmsg2").val());
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
                                                   
                                                   
                                                   
          
          
             var dataString_log ='set_log_reprint_bill=log_reprint_bill&billno_reprint='+billno;
             $.ajax({
             type: "POST",
             url: "printercheck_1.php",
             data: dataString_log,
             success: function(data) {
             
             }
             });
                                                   
                                                   
                                                   
                                                   
                                                   //alert(billno[0]);
                                                   //------------
                                                    $.post("print_details.php", {bilno:billno[0],bill_reprint:'Y',set:'billprint'},
                                                                           function(data)
                                                                           {
                                                                           data=$.trim(data);
                                                                           //alert(data);
                                                                           $(".error_feed").css("display","block");
                                                                           $(".error_feed").addClass("billgenration_validate");
                                                                       $(".error_feed").text(paymentmsg2);
                                                                       $(".error_feed").delay(2000).fadeOut('slow');

                                                                           });
                                                     //-----------------    
						
						$('.kotcancel_reason_popup_new').css('display','none');
                                                $('.confrmation_overlay').css('display','none');
                                                $('#pin').val('');
                                            
                        //---------------
			
                     }
                 }
             });
             }
             else if(mode=='Billsplit'){
                 var selected_activities =$('.tr_bill_gen_active');
					 var regen = new Array(); 
					 selected_activities.each(function(){
					  var id_str       =  $(this).attr("regen");
						  if(id_str!='undefined' && id_str!='' && id_str!=null){
							  regen.push(id_str);
						  }
					});
					var uniqueNames = [];
			  for(var i in regen){
				  if(uniqueNames.indexOf(regen[i]) === -1){
					  uniqueNames.push(regen[i]);
				  }
			  } 
			  if(uniqueNames=="Y")
			  {  
                      if($('#hidbilsplit_per').val()=='Y')
			{
                             
                            if($('#hidauthorise_with_code').val()=='Y'){
                                $('.kotcancel_reason_popup_new').css('display','block');
				$('.confrmation_overlay').css('display','block');
                                $("#rsn").css("display","none");
                                $("#pin").focus();
                            }else{
                                $('.loadcanceldetails').css('display','block');
				$('.confrmation_overlay').css('display','block');
                                //alert("Bill reprint autherisation is ON!");
                            }
						  
			}
                        else{
                          
                         //$('#kotcancel_reason_popup_new_proceed_btn').click();
                         
                                                
                                             
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
                                               //alert(billno[0]);

                                                $.post("load_paymentpending.php", {bilno:billno[0],set:'billsplitassign'},
						function(data)
						{
						data=$.trim(data);
						//alert(data);
						window.location="bill_split.php";
						
						});
                        //---------------
			
                     }
                    
                   
                 }
                 else
				  {
					  var billspliterror=$('#hidbillsplitnotpos').val();
					  $(".error_feed").css("display","block");
					  $(".error_feed").addClass("billgenration_validate");
					  $(".error_feed").text(billspliterror);
					  $(".error_feed").delay(2000).fadeOut('slow');
					 
				  }
		}
            }else
		{
                    var selbil=$('#hidselbiltopr').val();
			$(".error_feed").css("display","block");
			$(".error_feed").addClass("billgenration_validate");
			$(".error_feed").text(selbil);
			$(".error_feed").delay(2000).fadeOut('slow');
		}
        });
        
	 $('.regenratethetables1').click(function (event) {
            alert('ff');
		 if($('.clickeachrowpaymnt').hasClass('tr_bill_gen_active') )
		{
			var selected_activities =$('.tr_bill_gen_active');
					 var regen = new Array(); 
					 selected_activities.each(function(){
					  var id_str       =  $(this).attr("regen");
						  if(id_str!='undefined' && id_str!='' && id_str!=null){
							  regen.push(id_str);
						  }
					});
					var uniqueNames = [];
			  for(var i in regen){
				  if(uniqueNames.indexOf(regen[i]) === -1){
					  uniqueNames.push(regen[i]);
				  }
			  } 
			  if(uniqueNames=="Y")
			  {
					  if($('#hidbilgenper').val()=='Y')
					  {
                                              if($('#hidauthorise_with_code').val()=='Y'){
                                                  $('.kotcancel_reason_popup_new').css('display','block');
						  $('.confrmation_overlay').css('display','block');
                                                  
                                              }else{
                                                  $('.loadcanceldetails').css('display','block');
						  $('.confrmation_overlay').css('display','block');
                                              }
						  
					  }else
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
							  
							  var hidproc_regen=$('#hidproc_regen').val();
							   $.post("load_paymentpending.php", {bilno:billno[0],set:'billregenerate'},
								function(data2)
								{
                                                                    $('#billdetails').load("load_paymentpending.php?set=loadbilldetails_total");
									data2=$.trim(data2);
									if(data2.indexOf("exception") == -1)
											{
												$(".error_feed").css("display","block");
												$(".error_feed").addClass("billgenration_validate");
												$(".error_feed").text(hidproc_regen);
												$(".error_feed").delay(2000).fadeOut('slow');
												
												 var flr_id=	$('#areachnage').val();				
												$.post("load_paymentpending.php", {floorid:flr_id,set:'loadbilldetails'},
												function(data)
												{
												data=$.trim(data);
												$('#load_billfullist').html(data);		  
												});
												
												
											}else {
												alert(data2)
											}
									
								
								});	
					  }
				  }else
				  {
					  var regner=$('#hidregennotpos').val();
					  $(".error_feed").css("display","block");
					  $(".error_feed").addClass("billgenration_validate");
					  $(".error_feed").text(regner);
					  $(".error_feed").delay(2000).fadeOut('slow');
					 
				  }	
		}else
		{var selbil=$('#hidselbiltopr').val();
			 $(".error_feed").css("display","block");
			$(".error_feed").addClass("billgenration_validate");
			$(".error_feed").text(selbil);
			$(".error_feed").delay(2000).fadeOut('slow');
			
		}
		 			  
	});
			  
	/***************************************  re generate ends **********************************************************  */
	  //kotcancel_reason_popup_new_cancel_btn
                $("#kotcancel_reason_popup_new_cancel_btn").click(function(){
                        $('#pin').val('');
			$('.confrmation_overlay').css('display','none');
			$(".kotcancel_reason_popup_new").css("display","none");
                        
		});
                
                 $('#pin').keypress(function(ev){
     
            if(ev.keyCode == 13){
                ev.stopImmediatePropagation();
                 
                $('#kotcancel_reason_popup_new_proceed_btn').trigger('click');
                
            }});
        
          jQuery('#pin').keyup(function (e) { 
            this.value = this.value.replace(/[^0-9\.]/g,'');
//            if(!Number(this.value)||($(this).val().length <4)){
//                
////                    $('#pin_error').css("display",'block');
////                    $('#pin_error').text('CODE NOT REGISTERED');
////                    $('#pin_error').delay(2000).fadeOut('slow');
//                    
//               
//            }
        });
        
        //---------------------number pad
        $('.calculator_settle').click( function(event) {
          
           
		event.stopImmediatePropagation();
                $('#focusedtext').val('pin');
                
                if( $('.complimentrary_cc').css('display') == 'block'){
         $('#focusedtext').val('pin_pay'); 
     }
        if( $('.paid_amount_cc_credit').css('display') == 'block'){
         $('#focusedtext').val('pin_pay'); 
     }
                
                
		var focused=$('#focusedtext').val();
               //alert(focused);
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
//                            
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
        
        $('.calculator_settle_back').click( function(event) {
            var str =$('#pin').val();
            str = str.substring(0, str.length - 1);
            $('#pin').val(str);
            input.innerHTML=$('#pin').val();
            $('#pin').focus();
        });
       


                //number pad end
    
//    $('#kotcancel_reason_popup_new_proceed_btn').click(function () {
//	 
//	 });
    
	 /***************************************  ok  regen permision starts ******************************************************************  */
   $('.submitregncancelation').click(function () {//alert("j");
      
		
                var mode = $('#btn_mode').val();
               
                var reasontext       =  $('#reasontext').val();
		var secretkey        =  $('#secretkey').val();
		var stafflist        =  $('#stafflist').val();
		if(reasontext==""){
                    
                    $("#deatilserror").css("display","block");
                    $("#deatilserror").text("Please Fill Reason !!");
                    $("#deatilserror").delay(2000).fadeOut('slow');
                }
                else{
		 $.post("load_bill_history.php", {secretkey:secretkey,stafflist:stafflist,set:'secretkeycheck'},
					function(data)
					{
                                             
					data=$.trim(data);
					if(data=="ok")
					{
                                            //-----
                                            if(mode=='Regen'){
                                             
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
						  var stafflist        =  $('#stafflist').val();
						 // alert(stafflist)
						 var hidproc_regen=$('#hidproc_regen').val();
                                                 //alert(hidproc_regen);
						   $.post("load_paymentpending.php", {reasontext:reasontext,secretkey:secretkey,stafflist:stafflist,bilno:billno[0],set:'billregenerate'},
							function(data2)
							{
                                                           
								data2=$.trim(data2);
								if(data2.indexOf("exception") == -1)
										{
                                                                                     
											$('.loadcanceldetails').css('display','none');
						 					$('.confrmation_overlay').css('display','none');	  
											$(".error_feed").css("display","block");
											$(".error_feed").addClass("billgenration_validate");
											$(".error_feed").text(hidproc_regen);
											$(".error_feed").delay(2000).fadeOut('slow');
											
											$('#reasontext').val('');
											$('#secretkey').val('');
											$('#typeentery').text('');
											$('#stafflist').find('option:first').attr('selected', 'selected');
                                                                                                $('#billdetails').load("load_paymentpending.php?set=loadbilldetails_total");
                                                                                                var flr_id=	$('#areachnage').val();				
												$.post("load_paymentpending.php", {floorid:flr_id,set:'loadbilldetails'},
												function(data)
												{
												data=$.trim(data);
												$('#load_billfullist').html(data);		  
												});
											
											
										}else {
											alert(data2)
										}
								
							
							});
                                             //--------           
                                         } else if(mode=='Reprnt'){
                                             
                                  

                                                           var paymentmsg2 = ($("#paymentmsg2").val());
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
                                                                      //alert(billno[0]);
                                                                      //------------
                                                                       $.post("print_details.php", {bilno:billno[0],set:'billprint'},
                                                                                              function(data)
                                                                                              {
                                                                                              data=$.trim(data);
                                                                                              //alert(data);
                                                                                              $(".error_feed").css("display","block");
                                                                                              $(".error_feed").addClass("billgenration_validate");
                                                                                          $(".error_feed").text(paymentmsg2);
                                                                                          $(".error_feed").delay(2000).fadeOut('slow');

                                                                                              });
                                                                        //-----------------    
                                        $('.loadcanceldetails').css('display','none');
					$('.confrmation_overlay').css('display','none');                                
                                //---------------
         
                                             
                                         }  else if(mode=='Billsplit'){
                                             
                                             
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
                                               //alert(billno[0]);

                                                $.post("load_paymentpending.php", {bilno:billno[0],set:'billsplitassign'},
						function(data)
						{
						data=$.trim(data);
						//alert(data);
						window.location="bill_split.php";
						
						});
                                         } 
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
		
       }
		
		
	 
	 
	 });
	 /***************************************  ok  regen permision ends ******************************************************************  */
	
	 /******************************  cancel regen permision starts ******************************************************************  */
   $('.closeregnpopup').click(function () {//alert("j");
		$('.loadcanceldetails').css('display','none');
		$('.confrmation_overlay').css('display','none');
	 
	 });
	 /***************************************  cancel regen permision ends **************************************************************  */
	 
	 
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
										"set"			: "bill_settle",
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
											url: "load_paymentpending.php",
											data: data,
											success: function(msg)
											{//alert(msg);
												 var flr_id=	$('#areachnage').val();	
												 $.post("load_paymentpending.php", {floorid:flr_id,bilno:billno[0],set:'loadbilldetails'},
												function(data)
												{
													data=$.trim(data);
													$('#load_billfullist').html(data);	
													$('#billdetails').load("load_paymentpending.php?set=loadbilldetails_total");
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

	 
	
	 /***************************************  ok click starts ******************************************************************  */
 
	 /***************************************  ok click ends ******************************************************************  */
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
	
	/*************************************  re generate starts **********************************************************  */
	 $('#kotcancel_reason_popup_new_proceed_btn').click(function (event) { 
         
            var mode = $('#btn_mode').val();
            
             //--------------
             
                                var pin =  $('#pin').val();
                                if(pin !=''){
                                var reasontext = $('#reasontxt').val();
                                $.post("load_paymentpending.php", {pin:pin,type:'authpincheck',set:'pincheck'},
		
					function(data)
					{
                                            
					data=$.trim(data);
					if(data!="NO")
					{
                                            
                                          var spl=data.split('*');
                                        
                                            
                                            if(mode=="Reprnt"){
                                               
                                              if(spl[1]=='reprint:Y'){ 
                                        var paymentmsg2 = ($("#paymentmsg2").val());
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
                                                   //alert(billno[0]);
                                                   //------------
                                                   
                                                   
                        var dataString_log ='set_log_reprint_bill=log_reprint_bill&billno_reprint='+billno;
                            $.ajax({
                            type: "POST",
                            url: "printercheck_1.php",
                            data: dataString_log,
                            success: function(data) {

                            }
                            });
                                                   
                                                   
                                                   
                                                   
                                                    $.post("print_details.php", {bilno:billno[0],bill_reprint:'Y',set:'billprint'},
                                                                           function(data)
                                                                           {
                                                                           data=$.trim(data);
                                                                           //alert(data);
                                                                           $(".error_feed").css("display","block");
                                                                           $(".error_feed").addClass("billgenration_validate");
                                                                       $(".error_feed").text(paymentmsg2);
                                                                       $(".error_feed").delay(2000).fadeOut('slow');

                                                                           });
                                                     //-----------------    
						
						$('.kotcancel_reason_popup_new').css('display','none');
                                                $('.confrmation_overlay').css('display','none');
                                                $('#pin').val('');
                                                $('#pin').focus();
                                                
                                            }else{
                                                $("#pin_success").css("display","none");
                                                $("#pin_error").css("display","block");
						$("#pin_error").text("No  Permission!");
						$("#pin_error").delay(2000).fadeOut('slow');
                                                $("#pin").val('');
                                                $('#pin').focus();
                                            }
                                            }
                                            else if(mode=='Regen'){
                                                
                                                 if(spl[2]=='regen:Y'){
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
                                                  //alert(billno);
						  billno=unique(billno)
                                                  
             var dataString_log ='set=regen_split&billno_regen='+billno;
             $.ajax({
             type: "POST",
             url: "load_paymentpending.php",
             data: dataString_log,
             success: function(data) {
             var split_permission=$.trim(data);
             
            if(split_permission=="N"){
                                                  
                                                  
                                                  //alert(billno[0]);
						  var stafflist        =  spl[0];
					          //alert(stafflist)
						 var hidproc_regen=$('#hidproc_regen').val();
						   $.post("load_paymentpending.php", {reasontext:reasontext,secretkey:'',stafflist:stafflist,bilno:billno[0],set:'billregenerate'},
							function(data2)
							{
                                                           
								data2=$.trim(data2);
								if(data2.indexOf("exception") == -1)
										{
                                                                                     $('.kotcancel_reason_popup_new').css('display','none');
                                                                                     $('#pin').val('');
											$('.loadcanceldetails').css('display','none');
						 					$('.confrmation_overlay').css('display','none');	  
											$(".error_feed").css("display","block");
											$(".error_feed").addClass("billgenration_validate");
											$(".error_feed").text(hidproc_regen);
											$(".error_feed").delay(2000).fadeOut('slow');
											
											$('#reasontext').val('');
											$('#secretkey').val('');
											$('#typeentery').text('');
											$('#stafflist').find('option:first').attr('selected', 'selected');
                                                                                                $('#billdetails').load("load_paymentpending.php?set=loadbilldetails_total");
                                                                                                var flr_id=	$('#areachnage').val();				
												$.post("load_paymentpending.php", {floorid:flr_id,set:'loadbilldetails'},
												function(data)
												{
												data=$.trim(data);
												$('#load_billfullist').html(data);		  
												});
											
											
										}else {
											alert(data2)
										}
								
							
							});
						  }else{
                                                      $("#pin_error").css("display","block");
						$("#pin_error").text("Spliited Bill Can't Be Regenerated");
						$("#pin_error").delay(2000).fadeOut('slow');
                                                $("#pin").val('');
                                                $('#pin').focus();
               
                                                }
						  }
                                               });
						 
                                                }else{
                                                    $("#pin_success").css("display","none");
                                                $("#pin_error").css("display","block");
						$("#pin_error").text("No  Permission!");
						$("#pin_error").delay(2000).fadeOut('slow');
                                                $("#pin").val('');
                                                $('#pin').focus();
                                                }
                                            }
                                            else if(mode='Billsplit'){
                                                
                                             
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
                                               //alert(billno[0]);

                                                $.post("load_paymentpending.php", {bilno:billno[0],set:'billsplitassign'},
						function(data)
						{
						data=$.trim(data);
						//alert(data);
						window.location="bill_split.php";
						
						});
                                            }	
                                           // $("#pin_error").css("display","none");
                                            $("#pin_success").css("display","none");
						$("#pin_success").text("");
						$("#pin_success").delay(2000).fadeOut('slow');
                                                $("#pin").val('');
                                                $('#pin').focus();
					}else
					{
                                        
                                            $("#pin_success").css("display","none");
                                             $("#pin_error").css("display","block");
						$("#pin_error").text("CODE NOT REGISTERED!");
						$("#pin_error").delay(2000).fadeOut('slow');
                                                $("#pin").val('');
                                                $('#pin').focus();
						
					}
				 }); 
		
		
		}else
					{
                                             $("#pin_error").css("display","block");
						$("#pin_error").text("ENTER PIN");
						$("#pin_error").delay(2000).fadeOut('slow');
                                                $("#pin").val('');
                                                $('#pin').focus();
						
					}
		
	 
             //---------------
         
         });
         
        
//	 $('.repreintthetables').click(function (event) {
//             
//		if($('.clickeachrowpaymnt').hasClass('tr_bill_gen_active') )
//		{
//		 
//			//--------------
//                        if($('#hidbilreprint').val()=='Y')
//			{
//                            if($('#hidauthorise_with_code').val()=='Y'){
//                                $('.kotcancel_reason_popup_new').css('display','block');
//				$('.confrmation_overlay').css('display','block');
////                                $('#kotcancel_reason_popup_new_proceed_btn').hide();
////                                $('#kotcancel_reason_popup_new_proceed_reprint_btn').show();
////                                $('#kotcancel_reason_popup_new_proceed_split_btn').hide();
////                                $('#kotcancel_reason_popup_new_proceed_reprint_btn').removeClass('bill_print_btn_disable');
////                                $('#kotcancel_reason_popup_new_proceed_btn').removeClass('bill_print_btn_disable');
////                                $('#kotcancel_reason_popup_new_proceed_split_btn').removeClass('bill_print_btn_disable');
////                                $('#kotcancel_reason_popup_new_proceed_btn').addClass('bill_print_btn_disable');
////                                $('#kotcancel_reason_popup_new_proceed_split_btn').addClass('bill_print_btn_disable');
//                            }else{
////                                $('.loadcanceldetails').css('display','block');
////				$('.confrmation_overlay').css('display','block');
//                                alert("Bill reprint autherisation is ON!");
//                            }
//						  
//			}else{
//                            
//                         $('#kotcancel_reason_popup_new_proceed_reprint_btn').click();
//                        //---------------
//			
//                     }
//		}else
//		{var selbil=$('#hidselbiltopr').val();
//			$(".error_feed").css("display","block");
//			$(".error_feed").addClass("billgenration_validate");
//			$(".error_feed").text(selbil);
//			$(".error_feed").delay(2000).fadeOut('slow');
//		}
//		 			  
//	});
			  
	/***************************************  re generate ends **********************************************************  */
	
	
	
	/*************************************  bill split starts **********************************************************  */
	
	 $('.bilsplitthetables1').click(function (event) {
		if($('.clickeachrowpaymnt').hasClass('tr_bill_gen_active') )
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
			//alert(billno[0]);
			
			 $.post("load_paymentpending.php", {bilno:billno[0],set:'billsplitassign'},
						function(data)
						{
						data=$.trim(data);
						//alert(data);
						window.location="bill_split.php";
						
						});	
		}else
		{var selbil=$('#hidselbiltopr').val();
			$(".error_feed").css("display","block");
			$(".error_feed").addClass("billgenration_validate");
			$(".error_feed").text(selbil);
			$(".error_feed").delay(2000).fadeOut('slow');
		}
		 			  
	});
			  
	/***************************************  bill split ends **********************************************************  */
	
	/***************************************  auto refresh starts **********************************************************  */
	 setInterval(function() { 
	 
	 var flr_id=	$('#areachnage').val();	
	  //alert(flr_id);
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
          //alert(billno[0]);
	  
	  $.post("load_paymentpending.php", {floorid:flr_id,bilno:billno[0],set:'loadbilldetails'},
		  function(data)
		  {
		  data=$.trim(data);
                  //alert(data);
		  $('#load_billfullist').html(data);
                  //alert(data);
		//$('#billdetails').load("load_paymentpending.php?set="+loadbilldeatils);
		  });
  
	 
	  }, 6000); 
	/***************************************  auto refresh ends **********************************************************  */
	
	 /*****************************************  close bill starts ******************************************************************  */
	 $('.submittranscations').click(function (event) {
         
             event.stopImmediatePropagation();
	
	  var settlebill1=$('#settlebill').val();
            //alert (settlebill1);
                var tip_amount=0;
                var tip_mode='C';
                if($('#tip_amount').val()!='' && $('#tip_amount').val()>0){
                    tip_amount=$('#tip_amount').val();
                    tip_mode=$('#tip_pay_mode').val();
                }
		var payemntmode_sel =$('.mode_sel_btn_act').attr('id');//alert(payemntmode_sel)
                var entremt=$("#hidentramt").val();
		if(payemntmode_sel!='')
		{
                    
                    
		  var pd=$('#paidamount').val();
                   
                  if(payemntmode_sel=='coupon'){
                      if(parseFloat($('#grandtotal').text())!=parseFloat($('#coupamount').val())){
                      var pd=$('#balanceamout').val();
                      entremt="Insufficient Amount";
                        }
                        else{
                            pd=$('#coupamount').val();
                        }
                        
                  }
                  else if(payemntmode_sel=='upi'){
                      var upi_status=$('#upistatus').val();
                      var pd=$('#upiamount').val();
                      if(upi_status==''){
                      entremt="Check Upi Status";
                    }
                    else{
                      
                      if(pd==''){
                      entremt="Upi Transaction Not Successful";
                    }
                }
                }
		  var selct=$('.mode_sel_btn_act').attr('id');
		  
		   var selected_activities =$('.tr_bill_gen_active');
		   var billno = $('#bill').val(); 
                   
			var tableid = new Array();
			 var prefid = new Array();
		
		  
//		  $.post("load_paymentpending.php", {bilno:billno,set:'setbillnotopay'},
//		  function(data)
//		  {
//                    data=$.trim(data);
//		  });
		  var typenam=$('.mode_sel_btn_act').attr('id');
                  var typeid =$('.mode_sel_btn_act').attr('idval');
                  
                    if(pd!="")
                    {// && IsNumeric(pd)
			  if(pd.includes('.')){
                              var pd1=pd.split('.');
                              if(pd1[1]==''){
                              pd=pd1[0];
                          }else{
                              pd=pd;
                          }
                          }
                              //alert(pd);
                          
			 if(isFloat(pd))
                            { //alert('hhh');
                               
                        if(selct=="cash")
                        {
			  var paid=$('#paidamount').val();
                          //alert(paid);
                          if(paid.includes('.')){
                              var paid1=paid.split('.');
                              if(paid1[1]==''){
                              paid=paid1[0];
                          }else{
                              paid=paid;
                          }
                          }
                         //alert(paid);
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
				 	"set"		: "bill_settle",
					"type"		: selct,
					"billno" 	: billno,
					"typenam"	: typenam,
					"paid"		: paid,
					"bal" 		: bal,
                                        "typeid"        : typeid,
                                        "tip_amount"    :tip_amount,
                                        "tip_mode"      :tip_mode
				  };
			  }
				  
		  }
                  
                  else  if(selct=="credit")
		  {             
			  var trans=parseFloat($('#transcationid').val().replace(',',''));
                          //alert(trans);
			  var bankdetails=$('#bankdetails').val();
                          
			  var grand=parseFloat($('#grandtotal').text());
			   
			    var paid=$('#paidamount').val();
			
			   var transbal=$('#transbal').val().replace(',','');
                           //alert(transbal);
			
				
			
                       
				  

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
			  {var bal=$('#balanceamout').val();
			 // var s=parseFloat(paid) + parseFloat(trans) ;alert(trans);alert(grand);
			   if(trans<=grand)
			  {  
			  if(trans!="" && ( bankdetails!='' && bankdetails!=null))
			   {    
					var paid=$('#paidamount').val();
					
					var transbal=$('#transbal').val();
                                        
                                   if(transbal=='0.00' && bal=='0')
					{
					   var data = {
							 "set"		: "bill_settle",
							  "type"		: selct,
							  "billno" 	: billno,
							  "typenam"	: typenam,
							  "trans" :trans,
							  "bank" :bankdetails,
							  "paid": paid,
							  "bal" : bal,
                                                          "typeid" :typeid,
                                                          "tip_amount"    :tip_amount,
                                                           "tip_mode"      :tip_mode
							};
					}else if(transbal!='0.00' && bal!='0')
					{
						var data = {
							  "set"		: "bill_settle",
							  "type"		: selct,
							  "billno" 	: billno,
							  "typenam"	: typenam,
							  "trans" :trans,
							  "bank" :bankdetails,
							  "paid": paid,
							  "bal" : bal,
                                                          "typeid" :typeid,
                                                          "tip_amount"    :tip_amount,
                                                           "tip_mode"      :tip_mode
							};
					}else if((transbal<'0') && bal=='0')
						  {
							  var data = {
							  "set"		: "bill_settle",
							  "type"		: selct,
							  "billno" 	: billno,
							  "typenam"	: typenam,
							  "trans" :trans,
							  "bank" :bankdetails,
							  "paid": paid,
							  "bal" : bal,
                                                          "typeid" :typeid,
                                                          "tip_amount"    :tip_amount,
                                                          "tip_mode"      :tip_mode
							};
						  }
					else
					{var data = {
							  "set"		: "bill_settle",
							  "type"		: selct,
							  "billno" 	: billno,
							  "typenam"	: typenam,
							  "trans" :trans,
							  "bank" :bankdetails,
							  "paid": paid,
							  "bal" : bal,
                                                          "typeid" :typeid,
                                                          "tip_amount"    :tip_amount,
                                                          "tip_mode"      :tip_mode
							};
						 var insufamt=$("#hidinsufamt").val();
						 $(".payment_pend_right_cash_error").css("display","block");
						 $(".payment_pend_right_cash_error").addClass("popup_validate");
						 $(".payment_pend_right_cash_error").text('');
						 $('.payment_pend_right_cash_error').delay(1000).fadeOut('slow');
					}
				 }else
				 {  
                                        var entertrnsdt=$("#hidentertrnsdt").val();
                                        $(".payment_pend_right_cash_error").css("display","block");
					 $(".payment_pend_right_cash_error").addClass("popup_validate");
				     
                                        if($.trim(bankdetails)==''){
                                         
                                          $(".popup_validate").text("Add Bank Details");
                                        }
                                     else{
                                        
                                        $(".payment_pend_right_cash_error").text(entertrnsdt); 
                                     }
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
		  
		  
		  
		  
		  
		  }
                  else if(selct=="coupon")
		  {         
                      
                          var grand=$('#grandtotal').text();
                         
			  var coup=$('#coupname').val();
			  if(coup!="")
			   { 
					var coupamnt=$('#coupamount').val();
					if(coupamnt!="")
			   		{           
                                                    
						  var coupbal=$('#coupbal').val();
                                                  if(coupbal==""){
                                                      coupbal='0.00';
                                                  }
						  var paid=$('#paidamount').val();
                                                  if(paid==""){
                                                      paid='0.00';
                                                  }
						  var bal=$('#balanceamout').val();
                                                  if(bal==""){
                                                      bal='0.00';
                                                  }
						  

//                                                  if( parseFloat(coupamnt)>parseFloat(grand))
//                                                  {     alert(coupamnt);
//                                                        alert(grand); 
//                                                        $('#coupamount').val("");
//                                                        $('#coupbal').val("");
//                                                        $(".payment_pend_right_cash_error").css("display","block");
//							$(".payment_pend_right_cash_error").addClass("popup_validate");
//							$(".payment_pend_right_cash_error").text("Incorrect Amount");
//							$('.payment_pend_right_cash_error').delay(2000).fadeOut('slow');
//                                                  }
                                                  
                                                  
                                                  
				  
						  if(parseFloat(coupbal) >parseFloat(paid) )
						  {   
                                                      
                                                            var insufamt=$("#hidinsufamt").val();
							   $(".payment_pend_right_cash_error").css("display","block");
							   $(".payment_pend_right_cash_error").addClass("popup_validate");
							   $(".payment_pend_right_cash_error").text(insufamt);
							   $('.payment_pend_right_cash_error').delay(2000).fadeOut('slow');
							  
						  }
                                                else
                                                {
						
						  if(parseFloat(coupbal)=='0.00' && parseFloat(bal)=='0.00')
						  {
								var data = {
									  "set"		: "bill_settle",
									  "type"		: selct,
									  "billno" 	: billno,
									  "typenam"	: typenam,
									  "coup" :coup,
									  "coupamnt": coupamnt,
									  "coupbal" : coupbal,
									  "paid": paid,
									  "bal" : bal,
                                                                          "typeid"        : typeid,
                                                                          "tip_amount"    :tip_amount,
                                                                           "tip_mode"      :tip_mode
									};
						  }else if(parseFloat(coupbal)!='0.00' && parseFloat(bal)!='0.00')
						  {
							   var data = {
									  "set"		: "bill_settle",
									  "type"		: selct,
									  "billno" 	: billno,
									  "typenam"	: typenam,
									  "coup" :coup,
									  "coupamnt": coupamnt,
									  "coupbal" : coupbal,
									  "paid": paid,
									  "bal" : bal,
                                                                          "typeid"        : typeid,
                                                                          "tip_amount"    :tip_amount,
                                                                           "tip_mode"      :tip_mode
									};
						  }else if((parseFloat(coupbal)>'0.00') && parseFloat(bal)=='0.00')
						  {
							   var data = {
									  "set"		: "bill_settle",
									  "type"		: selct,
									  "billno" 	: billno,
									  "typenam"	: typenam,
									  "coup" :coup,
									  "coupamnt": coupamnt,
									  "coupbal" : coupbal,
									  "paid": paid,
									  "bal" : bal,
                                                                          "typeid"        : typeid,
                                                                          "tip_amount"    :tip_amount,
                                                                           "tip_mode"      :tip_mode
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
					}
					
                                            }
                                            else
					   {      
                                               
                                                    var entremt=$("#hidentramt").val();
						   $(".payment_pend_right_cash_error").css("display","block");
						    $(".payment_pend_right_cash_error").addClass("popup_validate");
			 				$(".payment_pend_right_cash_error").text(entremt);
							$('.payment_pend_right_cash_error').delay(2000).fadeOut('slow');
					   }
			 
			 
			 
			   }
                           else
			   {
			   var selectcoup=$("#hidselectcoup").val();
				   $(".payment_pend_right_cash_error").css("display","block");
				   $(".payment_pend_right_cash_error").addClass("popup_validate");
			 		$(".payment_pend_right_cash_error").text(selectcoup);
					$('.payment_pend_right_cash_error').delay(2000).fadeOut('slow');
			   }
		  }
                  else if(selct=="voucher")
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
							  "set"		: "bill_settle",
							  "type"		: selct,
							  "billno" 	: billno[0],
							  "typenam"	: typenam,
							  "vouchid" :vouchid,
							  "vocamount": vocamount,
							  "vouchbal" : vouchbal,
							  "paid": paid,
							  "bal" : bal,
                                                          "tip_amount"    :tip_amount,
                                                          "tip_mode"      :tip_mode
							};
						  }else if((vouchbal!='0.00') && bal!='0')
						  {
							  
							  var data = {
							 "set"		: "bill_settle",
							  "type"		: selct,
							  "billno" 	: billno[0],
							  "typenam"	: typenam,
							  "vouchid" :vouchid,
							  "vocamount": vocamount,
							  "vouchbal" : vouchbal,
							  "paid": paid,
							  "bal" : bal,
                                                          "tip_amount"    :tip_amount,
                                                           "tip_mode"      :tip_mode
							};
						  }else if((vouchbal<'0') && bal=='0')
						  {
							   var data = {
							  "set"		: "bill_settle",
							  "type"		: selct,
							  "billno" 	: billno[0],
							  "typenam"	: typenam,
							  "vouchid" :vouchid,
							  "vocamount": vocamount,
							  "vouchbal" : vouchbal,
							  "paid": paid,
							  "bal" : bal,
                                                          "tip_amount"    :tip_amount,
                                                           "tip_mode"      :tip_mode
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
			  
		  }
                  else if(selct=="cheque")
                  
		  {//alert("hi");
			 
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
								  "set"		: "bill_settle",
								  "type"		: selct,
								  "billno" 	: billno,
								  "typenam"	: typenam,
								  "cheqbank" :cheqbank,
								  "cheqname": cheqname,
								  "cheqamt": cheqamt,
								  "paid": paid,
								  "bal" : bal,
                                                                  "typeid" :typeid,
                                                                  "tip_amount"    :tip_amount,
                                                                  "tip_mode"      :tip_mode
								};
						  }else if((cheqbal!='0.00') && bal!='0')
						  {
							  
							  var data = {
								  "set"		: "bill_settle",
								  "type"		: selct,
								  "billno" 	: billno,
								  "typenam"	: typenam,
								  "cheqbank" :cheqbank,
								  "cheqname": cheqname,
								  "cheqamt": cheqamt,
								  "paid": paid,
								  "bal" : bal,
                                                                  "typeid" :typeid,
                                                                  "tip_amount"    :tip_amount,
                                                                  "tip_mode"      :tip_mode
								};
						  }else if((cheqbal<'0') && bal=='0')
						  {
							   var data = {
								  "set"		: "bill_settle",
								  "type"		: selct,
								  "billno" 	: billno,
								  "typenam"	: typenam,
								  "cheqbank" :cheqbank,
								  "cheqname": cheqname,
								  "cheqamt": cheqamt,
								  "paid": paid,
								  "bal" : bal,
                                                                  "typeid" :typeid,
                                                                  "tip_amount"    :tip_amount,
                                                                  "tip_mode"      :tip_mode
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
                  
                  else if(selct=="upi")
		  {
			 
			  var upiamount=parseFloat($('#upiamount').val());
                           var upi_txn_id=parseFloat($('#upitransactionid').val());
			  var grand=$('#grandtotal').text();
			  
                          if(upiamount=='')
			  {
                                  var entremt=$("#hidentramt").val();
				  $(".payment_pend_right_cash_error").css("display","block");
				  $(".payment_pend_right_cash_error").addClass("popup_validate");
				  $(".payment_pend_right_cash_error").text(entremt);
				  $('.payment_pend_right_cash_error').delay(2000).fadeOut('slow');
			  }
			  
			  else
			  {
                            var data = {
				 	"set"		: "bill_settle",
					"type"		: selct,
					"billno" 	: billno,
					"typenam"	: typenam,
					"upi_amount"	: upiamount,
                                        "upi_txn_id"	: upi_txn_id,
					"typeid"        : typeid,
                                        "tip_amount"    :tip_amount,
                                        "tip_mode"      :tip_mode
				  };
			  }
				  
		  }       
		 
		else
		{    
                    var entremt=$("#hidentramt").val();
			$(".payment_pend_right_cash_error").css("display","block");
			$(".payment_pend_right_cash_error").addClass("popup_validate");
			$(".payment_pend_right_cash_error").text(entremt);
			$('.payment_pend_right_cash_error').delay(2000).fadeOut('slow');
		}
		
		}else
		{
			//alert('2');
			var incrt_amt=$("#hidincrt_amt").val();
			$(".payment_pend_right_cash_error").css("display","block");
			$(".payment_pend_right_cash_error").addClass("popup_validate");
			$(".payment_pend_right_cash_error").text(incrt_amt);
			$('.payment_pend_right_cash_error').delay(2000).fadeOut('slow');
			
		}
		//window.location.href = "payment_pending.php";
                 
                 } 
                    else if(selct=="complimentary")
                            {
                                    
		  			var comp=$('#completext').val();//alert(comp)
					if(comp!='')
					  {
						   data = {
								  "set"		: "bill_settle",
                                                                  "billno" 	: billno,
								  "type"		: selct,
								  "typenam"		: typenam,
								  "comp"		: comp,
                                                                  "typeid" :typeid,
                                                                  "tip_amount"    :tip_amount,
                                                                  "tip_mode"      :tip_mode
								};
                                                                
                                                               
                                                                
                                                     if((localStorage.shiftlogintime!="" && $('#shift_permission').val()=='Y') || $('#shift_permission').val()=="N")   {        
						 window.location.href = "payment_pending.php";  
                                             }
                                                 
					  }else
					  {var paymentmsg1 = ($("#paymentmsg1").val());
						  $(".payment_pend_right_cash_error").css("display","block");
						  $(".payment_pend_right_cash_error").addClass("popup_validate");
						  $(".payment_pend_right_cash_error").text(paymentmsg1);
						  $('.payment_pend_right_cash_error').delay(2000).fadeOut('slow');
					  }
	  
			
				}
                    else if(selct=="credit_person") 
			  {
                                   
					  var creditype=$('#selectcreditypes').val();
                                          
					  var creditdeatils=$('#selectcreditdetails').val();
                                          if(creditype==3 || creditype==4){
                                              creditdeatils='';guestnumber='';
                                              if(creditype==4){
                                            var guestnumber=$('#selectcreditdetailsnumber').val();
                                        }
                                        
                                        
                                         if(creditype==4 && guestnumber==''){
                                           $(".payment_pend_right_cash_error").css("display","block");
					   $(".payment_pend_right_cash_error").addClass("popup_validate");
					   $(".payment_pend_right_cash_error").text("Enter Number");
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
                                        $("#selectcreditdetails option:selected").text()
                                            
					  var paidamount_credit=$('#paidamount_credit').val();
					  var amount_credit=$('#amount_credit').val();
                                           var amount_credit1=$('#amount_credit1').val();
                                           var credit_remark=$('#credit_remark').val();
                                           var room='';
                                       
					  var balanceamout_credit=$('#balanceamout_credit').val();
                                           
					  if(creditype!='')
					  {
                                            
						  if(((creditype=='2' || creditype=='1') && creditdeatils!='') || ((creditype=='3'||creditype=='4') && guestname!=''))
						  {     if(creditype=='1'){
                                                            room=$("#selectcreditdetails option:selected").text();
                                                        }
                                                      if((amount_credit=="0")&&(amount_credit1="0"))
						  {       
                                                          $(".payment_pend_right_cash_error").css("display","block");
							  $(".payment_pend_right_cash_error").addClass("popup_validate");
							  $(".payment_pend_right_cash_error").text("Invalid Credit Amount");
							  $('.payment_pend_right_cash_error').delay(2000).fadeOut('slow');
						  }
                                                      else{
                                                      
							   data = {
								  "set"					: "bill_settle",
								  "type"				: selct,
								  "billno" 				: billno,
								  "typenam"				: typenam,
								  "creditype"			: creditype,
								  "creditdeatils"		: creditdeatils,
								  "paidamount_credit"	        : paidamount_credit,
								  "amount_credit"		: amount_credit,
								  "bal"				: 0,
                                                                  "typeid"                      :typeid,
                                                                  "credit_remark"               :credit_remark,
                                                                  "guestnumber"                 :guestnumber,
                                                                  "guestname"                 :guestname,
                                                                  "room"                      :room,
                                                                  "tip_amount"                :tip_amount,
                                                                  "tip_mode"                  :tip_mode
                                                                };
                                                        if((localStorage.shiftlogintime!="" && $('#shift_permission').val()=='Y') || $('#shift_permission').val()=="N")   {     
							   window.location.href = "payment_pending.php";
                                                       }   
						  } }else
						  {     
                                                      if(creditype=='4'|| creditype=='3'){
                                                          var sel_option='Enter Name ';
                                                        }
                                                        else{
                                                             var labelname=$("#selectcreditypes").find('option:selected').attr('label');
                                                            var sel_option=$("#hidsel_option").val() + ' '+ labelname ;
                                                           
                                                            }
							  
							  $(".payment_pend_right_cash_error").css("display","block");
							  $(".payment_pend_right_cash_error").addClass("popup_validate");
							  $(".payment_pend_right_cash_error").text(sel_option);
							  $('.payment_pend_right_cash_error').delay(2000).fadeOut('slow');
						  }
                                                
					  }else
					  {var sel_credttype=$("#hidsel_credttype").val();
						  $(".payment_pend_right_cash_error").css("display","block");
						  $(".payment_pend_right_cash_error").addClass("popup_validate");
						  $(".payment_pend_right_cash_error").text(sel_credttype);
						  $('.payment_pend_right_cash_error').delay(2000).fadeOut('slow');
					  }
							
						
				//window.location.href = "payment_pending.php";	
			  }
                      
                          
                  else
		{
			
			$(".payment_pend_right_cash_error").css("display","block");
			$(".payment_pend_right_cash_error").addClass("popup_validate");
			$(".payment_pend_right_cash_error").text(entremt);
			$('.payment_pend_right_cash_error').delay(2000).fadeOut('slow');
			
		}
		     var auth=$('#code_comp_credit').val();
                       var coupon_code=$('#coupon_code').val();
                var bill_final_amount=$('#grandtotal').text();
                var bill_final_amount_new= bill_final_amount.replace(',','');
                
                
                if($("#sms_bill_settle").is(':checked'))
		{
			var sms_bill_settle='Y';
		}
		else
		{
		     var sms_bill_settle='N';
		}     
            
		     data = $(this).serialize() + "&" + $.param(data)+"&auth_staff="+auth+"&coupon_code="+coupon_code+"&bill_final_amount_new="+bill_final_amount_new+"&sms_bill_settle="+sms_bill_settle;
                    
			 $.ajax({
					type: "POST",
					url: "load_paymentpending.php",
					data: data,
					success: function(msg)
					{ 
                                          
                                         $('#shift_check').val($.trim(msg));
                                              if($.trim(msg)=="Please open the shift for the current login"){
                                                
                                                $(".payment_pend_right_cash_error").css("display","block");
							  $(".payment_pend_right_cash_error").addClass("popup_validate");
							  $(".payment_pend_right_cash_error").text("Please Open Shift For Current Login");
							  $('.payment_pend_right_cash_error').delay(3000).fadeOut('slow');
                                                return false;
                                             }else{
                                                  
                                            $('.confrmation_overlay').css("display","none");
                                            $('.counter_settle_popup').css("display","none");
                                        
                        var data_pole = "set_pole=pole_display_all&display=thankyou";
			$.ajax({
			type: "POST",
			url: "index.php",
			data: data_pole,
			success: function(data5) {
			
			}
			});
                                            
						var flr_id=	$('#areachnage').val();	
						$.post("load_paymentpending.php", {floorid:flr_id,bilno:billno,set:'loadbilldetails'},
						function(data)
						{
                                                    
						data=$.trim(data);
						$('#load_billfullist').html(data);
                                               
                                                    
						 
							  $('#billdetails').load("load_paymentpending.php?set=loadbilldetails_total");
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
						
						 			  
					 
						});
                                                if($('.submittranscations').hasClass("disable")){
                                                    
                                                }
                                                else{
						if(settlebill1=='Y'){
                                                        $.post("print_details.php", {set:'billprint',billno:billno});
                                                $('.submittranscations').addClass("disable");    
                                            }
		  
                                                }
                                         
                       var dataString; 
                        dataString = 'set=drawer_open_on_settle';
                         $.ajax({
                        type: "POST",
                        url: "cashdrawer_details.php",
                        data: dataString,
                        success: function(data3) {
                                data3=data3.trim();
                                 if($('#from_page').val()=='table_selection'){
                                    $('#from_page').val('');
                                    window.location.href="table_selection.php";

                                        }
                                }
                        });                 
                       
                                        
                                             }
					}
				});
                                
		}else
		{       var sel_paytype=$("#hidsel_paytype").val();
			$(".payment_pend_right_cash_error").css("display","block");
			$(".payment_pend_right_cash_error").addClass("popup_validate");
			$(".payment_pend_right_cash_error").text(sel_paytype);
			$('.payment_pend_right_cash_error').delay(2000).fadeOut('slow');
		}
                
              
                
		});
                
                
         
         $('.settle_popup_close').click(function() {
           
                $('#from_page').val('');
     var sel=$('#bscur').val();
    var currencyonoff=$('#currencyonoff').val(); 
        if(currencyonoff=="Y"){
            
           var datastringnew22="set=cat1&idofcur="+sel;
      
       $.ajax({
        type: "POST",
        url: "payment_pending.php",
        data: datastringnew22,
        success: function(data)
        {
           
     $("#refdiv").load(location.href + " #refdiv");
     
        }
        
    });
    
    var datastringnew13="set1=cat11&idofcur1="+sel;
       
       $.ajax({
        type: "POST",
        url: "payment_pending.php",
        data: datastringnew13,
        success: function(data)
        {
        
 $("#refdivall").load(location.href + " #refdivall");
 
        }
        
    });
        }
   $('.counter_settle_popup').css("display","none");
   $('.confrmation_overlay').css("display","none");
   
   var data_pole = "set_pole=pole_display_all&display=none";
			$.ajax({
			type: "POST",
			url: "index.php",
			data: data_pole,
			success: function(data5) {
			
			}
			});
                        
                        
                var billno1=$('#settleingbilno').text();
        var gtt=parseFloat($('#grandtotal_sec').text());
       
        
        if(gtt>0){
           var data_loy = "set_loyalty_bill_change_old=bill_amount_change_old&billno_old="+billno1+"&new_amount_old="+gtt;
			
                         $.ajax({
			type: "POST",
			url: "load_paymentpending.php",
			data: data_loy,
			success: function(data55) {
			
                        
			}
			});        
                    }
 });
	/*****************************************  close bill ends ******************************************************************  */
	/*************************************  verify starts **********************************************************  */
	
	 $('.submittranscations_whole').click(function (event) {
		
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
			  { 
					  var creditype=$('#selectcreditypes').val();
					  var creditdeatils=$('#selectcreditdetails').val();
					  var paidamount_credit=$('#paidamount_credit').val();
					  var amount_credit=$('#amount_credit').val();
					  var balanceamout_credit=$('#balanceamout_credit').val();
					  if(creditype!='')
					  {
						  if(creditdeatils!='')
						  {
							   data = {
								  "set"					: "bill_settle",
								  "type"				: selct,
								  "billno" 				: billno[0],
								  "typenam"				: typenam,
								  "creditype"			: creditype,
								  "creditdeatils"		: creditdeatils,
								  "paidamount_credit"	: paidamount_credit,
								  "amount_credit"		: amount_credit,
								  "bal"					: balanceamout_credit
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
							
						
					
			  }else if(selct=="complimentary")
				{
		  			var comp=$('#completext').val();//alert(comp)
					if(comp!='')
					  {
						   data = {
								  "set"			: "bill_settle",
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
										"set"			: "bill_settle",
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
					url: "load_paymentpending.php",
					data: data,
					success: function(msg)
					{//alert(msg);
						 var flr_id=	$('#areachnage').val();	
						 $.post("load_paymentpending.php", {floorid:flr_id,bilno:billno[0],set:'loadbilldetails'},
						function(data)
						{
							data=$.trim(data);
							$('#load_billfullist').html(data);	
							/* $.post("print_details.php", {bilno:billno[0],set:'billprint'},
							function(data)
							{
							  data=$.trim(data);
							  //alert(data);
							  $(".error_feed").css("display","block");
							  $(".error_feed").addClass("billgenration_validate");
							  $(".error_feed").text("Bill Re-printed");
							  $(".error_feed").delay(2000).fadeOut('slow');*/
							  
							  $('#billdetails').load("load_paymentpending.php?set=loadbilldetails_total");
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
                //------------------------------------------------------------
 $('.pay_settle_btn').click( function(event) {
          event.stopImmediatePropagation();

		var focused=$('#focusedtext1').val();
                var calval=($(this).text());
               
               if(calval==2000 || calval==500 || calval==200 || calval==100 || calval==50 || calval==20 || calval==10 || calval==1000  ){
                  $('#'+focused).val("");
               }
               
               
               var focusedsplit=focused.substring(0,6);
               
              if(focusedsplit=="countc"){
                  
                 $('#countcard').val("");
               
              }else if(focusedsplit=="card_1"){
                 
                   var t=$('#card_1').val();
                  
                  var len= $('#'+focused).val().length;
                 // alert(len);
                 
                  if(len>3){
                      
                  
                   if(calval!="Clear"){     
                 calval="";
               
                   }else{
                       calval="Clear";
                      
                   }
                   }
                  
                              }
                      
                if(focused)
                //alert(focused);
                //alert(calval);
		
		var org=$('#'+focused).val();
			if(calval>=0)
			{
				if(org==0)
				{
					 $('#'+focused).val(org+calval);
				}else if(org>0)
				{
					$('#'+focused).val(org+calval);
				  
				}else if(org<0)
				{
					$('#'+focused).val(org+calval);
				}
                                else if(org==".")
				{
					$('#'+focused).val("0"+org+calval);
                                       
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
        
          $('input').click( function(event) {
             
             
		//event.stopImmediatePropagation();
		//if (event.keyCode != 13) {
			// if(!$(this).hasAttr('readonly')) {
				var redo=$(this).attr('readonly');//alert(redo);
				if(redo!="readonly")
				{
		var fcsed=$(this).attr('id');//alert(fcsed);
		$('#focusedtext1').val(fcsed);
				}
			// }
		//}
	
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
	 $('#curpaid').keypress(function () {
           
             
		if(event.keyCode == 13)//////alt+Enter(popup submit regeratebill)///////
                {
                 
                  
                                 $('.submittranscations').click();
                }
		 
		});
	
	
		
	
	}); 

$(document).unbind().keyup(function(e){
     e.preventDefault();
    if (e.keyCode == 27) {
        if($('.counter_settle_popup:visible').length == 1)
            {   
                 $('.counter_settle_popup').css("display","none");
                $(".confrmation_overlay").css("display","none");
            }
        if($('.kotcancel_reason_popup_new:visible').length == 1)
            {   
                 $('.kotcancel_reason_popup_new').css("display","none");
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
                        var decimal=$('#decimal').val();
                        
                        
                  if(dc=="" || dc=="undefined" || dc=='0'){
                  var paid_display=0;
                  var bal_display=0;
                  var data_pole = 'set_pole_paid=pole_display_paid&paid='+paid_display+"&balance="+bal_display+"&mode=coupon";
			$.ajax({
			type: "POST",
			url: "index.php",
			data: data_pole,
			success: function(data5) {
			
			}
			});
                  }
                        
                        //alert("dgmdfs");
			tt = parseFloat(gd -  dc); 
			if(tt<0 ||isNaN(tt))
			{var incrt_coupamt=$("#hidincrt_coupamt").val();
                                    $('#coupamount').val("");
                                    $('#coupbal').val("");
				 $(".payment_pend_right_cash_error").css("display","block");
				 $(".payment_pend_right_cash_error").addClass("popup_validate");
			 	 $(".payment_pend_right_cash_error").text(incrt_coupamt);
				 $('.payment_pend_right_cash_error').delay(2000).fadeOut('slow');
                                 
                 var paid_display=0;
                  var bal_display=0;
                  var data_pole = 'set_pole_paid=pole_display_paid&paid='+paid_display+"&balance="+bal_display+"&mode=coupon";
			$.ajax({
			type: "POST",
			url: "index.php",
			data: data_pole,
			success: function(data5) {
			
			}
			});
                                 
                                 
			}else
			{
			document.getElementById("coupbal").value=tt.toFixed(decimal);
                        
                        var paid_display=dc.toFixed(decimal);
                        var bal_display=tt.toFixed(decimal);;
                        var data_pole = 'set_pole_paid=pole_display_paid&paid='+paid_display+"&balance="+bal_display+"&mode=coupon";
			$.ajax({
			type: "POST",
			url: "index.php",
			data: data_pole,
			success: function(data5) {
			
			}
			});
                        
			}
		}
                
                
function cheqamountchange()
		{    
                        var decimal=$('#decimal').val();
                        $('#paidamount').val('');
                        $('#balanceamout').val('');
                        $('#curpaid').val('');
                        $('#cheqamount').focus();
			var tt=0;
			var gd=parseFloat($('#grandtotal').text().replace(/,/g, ""));
			var dc=parseFloat($('#cheqamount').val().replace(/,/g, ""));
			tt = parseFloat(gd -  dc); 
                        
                 if(dc=="" || dc=="undefined" || dc=='0' || isNaN(dc)){
                                
                  var paid_display=0;
                  var bal_display=0;
                  var data_pole = 'set_pole_paid=pole_display_paid&paid='+paid_display+"&balance="+bal_display+"&mode=cheque";
			$.ajax({
			type: "POST",
			url: "index.php",
			data: data_pole,
			success: function(data5) {
			
			}
			});
                        }
                        
                        if(dc==gd){
                            $('#cheqamount').focus();
                             $('#currencychg').attr("disabled", true);
                        $('#curpaid').attr("disabled", true);
                        }else
                        {
                            $('#currencychg').attr("disabled", false);  
                            $('#curpaid').attr("disabled", false);
                        }
                        
			if(tt<0)
			{
                            var incrt_cheqamt=$("#hidincrt_cheqamt").val();
				$(".payment_pend_right_cash_error").css("display","block");
				$(".payment_pend_right_cash_error").addClass("popup_validate");
			 	$(".payment_pend_right_cash_error").text(incrt_cheqamt);
				$('.payment_pend_right_cash_error').delay(2000).fadeOut('slow');
                                $('#cheqamount').val("");
                                $('#cheqbal').val("");
                       var paid_display=0;
                       var bal_display=0;
                       var data_pole = 'set_pole_paid=pole_display_paid&paid='+paid_display+"&balance="+bal_display+"&mode=cheque";
			$.ajax({
			type: "POST",
			url: "index.php",
			data: data_pole,
			success: function(data5) {
			
			}
			});
                        
			}else
			{
			document.getElementById("cheqbal").value=tt.toFixed(2);
			var bl=tt.toFixed(2);
                        
                  var paid_display=dc.toFixed(decimal);
                  var bal_display=tt.toFixed(decimal);
                  var data_pole = 'set_pole_paid=pole_display_paid&paid='+paid_display+"&balance="+bal_display+"&mode=cheque";
			$.ajax({
			type: "POST",
			url: "index.php",
			data: data_pole,
			success: function(data5) {
			
			}
			});
                       
			if(bl=='0.00')
			{
				$('#paidamount').val('0');
				$('#balanceamout').val('0');
				//$('#balanceamout').focus();
			}
			
			}
		}
                
  function transamountchange()
		{     
       
  
          
                  $('#curpaid').val('');
                    
                    
			var tt=0;
			var gd=parseFloat($('#grandtotal').text().replace(/,/g, ""));
			var dc=parseFloat($('#transcationid').val().replace(/,/g, ""));
			var    tt = parseFloat(gd -  dc); 
                        if(dc==gd){
                           $('#transcationid').focus();
                     $('#currencychg').attr("disabled", true);
                      $('#curpaid').attr("disabled", true);
                 
                    
                      
                        }else
                        {
                            $('#currencychg').attr("disabled", false);  
                             $('#curpaid').attr("disabled", false);
                        }
                        
                       
                        
                        
			if(tt<0)
			{
                            
				 $(".payment_pend_right_cash_error").css("display","block");
				 $(".payment_pend_right_cash_error").addClass("popup_validate");
			 	$(".payment_pend_right_cash_error").text("Incorrect Transcation Amount");
				$('.payment_pend_right_cash_error').delay(2000).fadeOut('slow');
				
				$("#paidamount").val('');
				$("#balanceamout").val('');
				//$('#balanceamout').focus();
                                $('#transcationid').val("");
                                $('#transbal').val("");
			}else
			{
			  var decimal=$('#decimal').val();
			document.getElementById("transbal").value=tt.toFixed(decimal);
                       
                      
			if(tt==0)
			{  
                            
                            //$('#transcationid').val("")
                            $("#paidamount").val('0');
                            $("#balanceamout").val('');
                            //$('#balanceamout').focus();
			}
			}
                        
                     
                       $("#balanceamout").val(''); 
                       // $("#paidamount").val('');  
                     if(event.keyCode == 13)//////alt+Enter(popup submit regeratebill)///////
                {
                 
                  
                                 $('.submittranscations').click();
                }   
                        
		}
	/*****************************************  calculation ends ******************************************************************  */
	
	/*****************************************  balance calc starts ******************************************************************  */
        function enterbalance(e)
	  {
	        var paid=$('#paidamount').val();
                
                 if(paid=="" || paid=="undefined" || paid=='0'){
                  var paid_display=0;
                  var bal_display=0;
                  var data_pole = 'set_pole_paid=pole_display_paid&paid='+paid_display+"&balance="+bal_display+"&mode=cash";
			$.ajax({
			type: "POST",
			url: "index.php",
			data: data_pole,
			success: function(data5) {
			
			}
			});
                  }
                
                var decimal=$('#decimal').val();
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
		 if(parseFloat(bal)<0||isNaN(bal))
			 {  //var insufamt=$("#hidinsufamt").val();
                                $('#balanceamout').val("");
				 $(".payment_pend_right_cash_error").css("display","block");
				 $(".payment_pend_right_cash_error").addClass("popup_validate");
			 	$(".payment_pend_right_cash_error").text('');
				$('.payment_pend_right_cash_error').delay(2000).fadeOut('slow');
				
			 }else
			 { 
					$('#balanceamout').val(bal.toFixed(decimal));
					if(e.keyCode == 13){
						$('#balanceamout').focus();
                                                 e.preventDefault();
					}
                                        $('#balanceamout').keypress(function(ev){
                                        if(ev.keyCode == 13){
                                                ev.stopImmediatePropagation();
                                                $('.submittranscations').click();
                                                
                                        }});
                                    
                                   
                        var paid_display=parseFloat(paid).toFixed(decimal);
                        var bal_display=parseFloat(bal).toFixed(decimal);
                                        
                        var data_pole = 'set_pole_paid=pole_display_paid&paid='+paid_display+"&balance="+bal_display+"&mode=cash";
			$.ajax({
			type: "POST",
			url: "index.php",
			data: data_pole,
			success: function(data5) {
			
			}
			});
	 }
                         

	  }
         
	  
	  function enterbalance_credit()
	  {     
              
               
	  	var paid=$('#paidamount_credit').val();
                
                var decimalcredit=$('#decimal').val();
		  var letterNumber = /^[0-9 .]+$/; 
		var gr1=$('#grandtotal').html();
             
           
              if(parseFloat(paid)>gr1){
                
                    var paid_display=parseFloat(paid).toFixed(decimalcredit);
                        var bal_display=0;           
                                        
                        var data_pole = 'set_pole_paid=pole_display_paid&paid='+paid_display+"&balance="+bal_display+"&mode=credit";
			$.ajax({
			type: "POST",
			url: "index.php",
			data: data_pole,
			success: function(data5) {
			
			}
			}); 
              }
              
              
              
                  var cr=$('#cur1').val();
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
					 $('#amount_credit').val(bal.toFixed(decimalcredit));
				 }else
				 {
					 if(bal=='0' && $('#paidamount_credit').val()!='0')
					 {
						 $('#amount_credit').val(''); 
					 }else
					 {
						 
					 var grnd=$('#grandtotal').text();
					$('#amount_credit').val(grnd.toFixed(decimalcredit)); 
					 }
				 }
		   
					$('#balanceamout_credit').val(bal.toFixed(decimalcredit));
                                        
                        var paid_display=parseFloat(paid).toFixed(decimalcredit);
                        var bal_display=parseFloat(bal).toFixed(decimalcredit);           
                                        
                        var data_pole = 'set_pole_paid=pole_display_paid&paid='+paid_display+"&balance="+bal_display+"&mode=credit";
			$.ajax({
			type: "POST",
			url: "index.php",
			data: data_pole,
			success: function(data5) {
			
			}
			});     
                                        
                                        
                                        
			 }
		  
	  }
          
   function comp_text(){
       
       var com=$('#completext').val();
     
        var data_pole = 'set_pole_paid=pole_display_paid&paid='+com+"&mode=complimentary";
			$.ajax({
			type: "POST",
			url: "index.php",
			data: data_pole,
			success: function(data5) {
			
			}
			});
                    
   }       
	/*****************************************  balance calc ends ******************************************************************  */
	
	
	
	
	function isFloat(n) {
return parseFloat(n.match(/^-?\d*(\.\d+)?$/))>=0;
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