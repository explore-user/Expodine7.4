// JavaScript Document
$(document).ready(function(){
	/***************************************** cancel eachitem  starts ******************************************************************  */
	$('.canceleachitem').click(function () {
		
		$('.closeoneclass2').css('display','block');
		$('.confrmation_overlay').css('display','block');
		$('.closeoneclass2 .textcontent').html('Are you Sure you Want to Cancel This Item?');
		var billno       =  $(this).attr("billno");
		var slno       =  $(this).attr("slno");	 
		$('#hidbilnotosave').val(billno);
		$('#hidslnotosave').val(slno);
		
		
	   	}); 
 /*************************************** cancel each item ends ******************************************************************  */
 
 /*************************************** cancel close click starts ******************************************************************  */
   $('.closecancel2').click(function () {
       
		$('.closeoneclass2').css('display','none');
		$('.closeoneclass3').css('display','none');
		$('.confrmation_overlay').css('display','none');
		$('#hidbilnotosave').val('');
		$('#hidslnotosave').val('');
		$(' #typeentery ').text('');
	
	});
	 /*************************************** cancel close click ends ******************************************************************  */
	 
	 /*************************************** cancel close click starts ******************************************************************  */
         
         
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
              
              
              
                    if(mode!='CS'){
                        
                    $.post("load_ta_history.php", {billno:billno,reasontext:'',secretkey:'',stafflist:'',value:'set_cancel_ta'},
			  function(data)
			  {
			  data=$.trim(data);
                       
			  if(data=="ok")
			  {
                                $(".loaderror").css("display","block");
                                $(".loaderror").addClass("billgenration_validate");
                                $(".loaderror").text("Item Canceled");
                                $(".loaderror").delay(2000).fadeOut('slow');
                                $('.closeoneclass2').css('display','none');
                                
                                $('.closeoneclass2').css('display','none');
				$('.closeoneclass3').css('display','none');
				$('.confrmation_overlay').css('display','none');
				$('#hidbilnotosave').val('');
				$('#hidslnotosave').val('');
				$(' #typeentery ').text('');
				$('#reasontext').val('');
				$('#secretkey').val('');
					
                                        
                              var dataString = 'value=load_ta_bildetails&billno=' + billno;
                              var request= $.ajax({
                              type: "POST",
                              url: "load_ta_history.php",
                              data: dataString,
                              success: function(data) {
                                       $('#billdetailsset2').html(data);

                                       var dataString1 = 'value=load_ta_settlement&billno=' + billno;
                                            var request1= $.ajax({
                                                      type: "POST",
                                                      url: "load_ta_history.php",
                                                      data: dataString1,
                                                      success: function(data1) {

                                                               $('.settlementdetails').html(data1);


                                                               var dataString2 = 'value=load_ta_bildetls&billno=' + billno;
                                                               var request2= $.ajax({
                                                                            type: "POST",
                                                                            url: "load_ta_history.php",
                                                                            data: dataString2,
                                                                            success: function(data2) {

                                                                                     $('#detailsset1_ta').html(data2);


                                                                                     $.post("load_ta_history.php", {billno:billno,value:'billwholeload_ta'},
                                                                                      function(data)
                                                                                      {
                                                                                            data=$.trim(data);
                                                                                            $('#ta_billlisttotal').html(data);
                                                                                      });

                                                                            }
                                                                     });

                                                      }
                                               });
                                               }
                                           });  
                                          }
                                  });
                        }
                    else{
                        
                        
                          $.post("load_cs_history.php", {billno:billno,reasontext:'',secretkey:'',stafflist:'',value:'set_cancel_ta'},
			  function(data)
			  {
			  data=$.trim(data);
			  if(data=="ok")
			  {
                                $(".loaderror").css("display","block");
                                $(".loaderror").addClass("billgenration_validate");
                                $(".loaderror").text("Item Canceled");
                                $(".loaderror").delay(2000).fadeOut('slow');
			  
                          
                                $('.closeoneclass2').css('display','none');
                                $('.closeoneclass3').css('display','none');
                                $('.confrmation_overlay').css('display','none');
                                $('#hidbilnotosave').val('');
                                $('#hidslnotosave').val('');
                                $(' #typeentery ').text('');
                                $('#reasontext').val('');
                                $('#secretkey').val('');
					
					
                                var dataString = 'value=load_ta_bildetails&billno=' + billno;
                                
                                var request= $.ajax({
                                    type: "POST",
                                    url: "load_cs_history.php",
                                    data: dataString,
                                    success: function(data) {
                                        
                                        $('#billdetailsset2').html(data);
                                        
                                        var request1= $.ajax({
                                            type: "POST",
                                            url: "load_cs_history.php",
                                            data: dataString1,
                                            success: function(data1) {

                                                $('.settlementdetails').html(data1);
                                                var dataString2 = 'value=load_ta_bildetls&billno=' + billno;
                                                var request2= $.ajax({
                                                    type: "POST",
                                                    url: "load_cs_history.php",
                                                    data: dataString2,
                                                    success: function(data2) {
                                                        
                                                        $('#detailsset1_ta').html(data2);
                                                        
                                                        $.post("load_cs_history.php", {billno:billno,value:'billwholeload_ta',mode:'CS'},
                                                        function(data){
                                                            
                                                            data=$.trim(data);
                                                            $('#ta_billlisttotal').html(data);
                                                        });
                                                    }
                                                });
                                            }
                                        });
                                    }
				});  
                                
                                $('.closeoneclass2').css('display','none');
                                $('.kotcancel_reason_popup_new').css('display','none');
                                $('.confrmation_overlay').css('display','none');
                                $('#pin').val('');
                                
                            }
			});
                    }
                
             }else{
            
                  alert('INVALID OTP'); 
                  $('#code_change').val('');
                  $('#code_change').focus();
             }
        
         }
        });
    
    
    });     
         
         
   $('.closeoksubmit').click(function (event) {
       
       event.stopImmediatePropagation();
       
       var otp_bill_cancel=$('#otp_bill_cancel').val();
       var billno       =  $('#hidbilnotosave').val();
       var staff= $('#otp_login').val();
       
      $('.closeoneclass2').css('display','none');
      $('.closeoneclass3').css('display','none');
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
                    
                    var billno       =  $('#hidbilnotosave').val();
                    var slno       =  $('#hidslnotosave').val();
                    var mode       = $('#his_mode').val();
                    
                    if(mode!='CS'){
                        
                    $.post("load_ta_history.php", {billno:billno,reasontext:'',secretkey:'',stafflist:'',value:'set_cancel_ta'},
			  function(data)
			  {
			  data=$.trim(data);
                       
			  if(data=="ok")
			  {
                                $(".loaderror").css("display","block");
                                $(".loaderror").addClass("billgenration_validate");
                                $(".loaderror").text("Item Canceled");
                                $(".loaderror").delay(2000).fadeOut('slow');
                                $('.closeoneclass2').css('display','none');
                                
                                $('.closeoneclass2').css('display','none');
				$('.closeoneclass3').css('display','none');
				$('.confrmation_overlay').css('display','none');
				$('#hidbilnotosave').val('');
				$('#hidslnotosave').val('');
				$(' #typeentery ').text('');
				$('#reasontext').val('');
				$('#secretkey').val('');
					
                                        
                              var dataString = 'value=load_ta_bildetails&billno=' + billno;
                              var request= $.ajax({
                              type: "POST",
                              url: "load_ta_history.php",
                              data: dataString,
                              success: function(data) {
                                       $('#billdetailsset2').html(data);

                                       var dataString1 = 'value=load_ta_settlement&billno=' + billno;
                                            var request1= $.ajax({
                                                      type: "POST",
                                                      url: "load_ta_history.php",
                                                      data: dataString1,
                                                      success: function(data1) {

                                                               $('.settlementdetails').html(data1);


                                                               var dataString2 = 'value=load_ta_bildetls&billno=' + billno;
                                                               var request2= $.ajax({
                                                                            type: "POST",
                                                                            url: "load_ta_history.php",
                                                                            data: dataString2,
                                                                            success: function(data2) {

                                                                                     $('#detailsset1_ta').html(data2);


                                                                                     $.post("load_ta_history.php", {billno:billno,value:'billwholeload_ta'},
                                                                                      function(data)
                                                                                      {
                                                                                            data=$.trim(data);
                                                                                            $('#ta_billlisttotal').html(data);
                                                                                      });

                                                                            }
                                                                     });

                                                      }
                                               });
                                               }
                                           });  
                                          }
                                  });
                        }
                    else{
                        
                          $.post("load_cs_history.php", {billno:billno,reasontext:'',secretkey:'',stafflist:'',value:'set_cancel_ta'},
			  function(data)
			  {
			  data=$.trim(data);//alert(data);
			  if(data=="ok")
			  {
                                $(".loaderror").css("display","block");
                                $(".loaderror").addClass("billgenration_validate");
                                $(".loaderror").text("Item Canceled");
                                $(".loaderror").delay(2000).fadeOut('slow');
			  
                          
                                $('.closeoneclass2').css('display','none');
                                $('.closeoneclass3').css('display','none');
                                $('.confrmation_overlay').css('display','none');
                                $('#hidbilnotosave').val('');
                                $('#hidslnotosave').val('');
                                $(' #typeentery ').text('');
                                $('#reasontext').val('');
                                $('#secretkey').val('');
					
					
                                var dataString = 'value=load_ta_bildetails&billno=' + billno;
                                var request= $.ajax({
                                    type: "POST",
                                    url: "load_cs_history.php",
                                    data: dataString,
                                    success: function(data) {
                                        $('#billdetailsset2').html(data);
                                        var request1= $.ajax({
                                            type: "POST",
                                            url: "load_cs_history.php",
                                            data: dataString1,
                                            success: function(data1) {

                                                $('.settlementdetails').html(data1);
                                                var dataString2 = 'value=load_ta_bildetls&billno=' + billno;
                                                var request2= $.ajax({
                                                    type: "POST",
                                                    url: "load_cs_history.php",
                                                    data: dataString2,
                                                    success: function(data2) {
                                                        $('#detailsset1_ta').html(data2);
                                                        $.post("load_cs_history.php", {billno:billno,value:'billwholeload_ta',mode:'CS'},
                                                        function(data){
                                                            data=$.trim(data);
                                                            $('#ta_billlisttotal').html(data);
                                                        });
                                                    }
                                                });
                                            }
                                        });
                                    }
				});  
                                $('.closeoneclass2').css('display','none');
                                $('.kotcancel_reason_popup_new').css('display','none');
                                $('.confrmation_overlay').css('display','none');
                                $('#pin').val('');
                            }
			});
                    }
                }
                
       }
                
                
            });
	 /*************************************** cancel close click ends ******************************************************************  */
 
 
 
 
 
  /*************************************** cancel each item by qty starts ***********************************************************  */
 	
	  $(".tr_clone_add").bind('change',function() {
		  
		   if($(this).val()!=0)
		  {//mnv qty
			  var $tr    = $(this).closest('.tr_clone');
			  var $clone = $tr.clone();
			  var valtotext_org   = $tr.attr('qtyval');
			  var slno   = $tr.attr('slno');
			  var canceldtext=($clone.find(':text').val());
			  var final=parseInt(valtotext_org) -  parseInt(canceldtext);
			
			if(final>=0) 
			  { //alert(canceldtext)
				  $(this).parent().parent().clone().appendTo('.locate'+slno+':first');
				  $tr.find(':text').val(final);
				  $(".tr_clone_add1"+slno).val(final);
				  $(this).parent().parent().attr('qtyval',final);
				  $(this).parent().parent().siblings('.slmyno').text('');
			  }else
			  {//alert("sorry");
			  }
			 //$('.right_bill_history_detail:last').clone().appendTo('#tt:last'); 
			   	// && final<valtotext_org 
			  /*if(final>=0) 
			  {
				  
				  var portchange=($tr.attr("portionval"))
				  var menuchange=($tr.attr("menuval"))
				  var kotchange=($tr.attr("kotval"))
				  var ordchange=($tr.attr("ordval"))
				  var rate=($tr.attr("rateval"))
				   var uq=(menuchange+portchange+kotchange+ordchange)
				  var orgval=($("input[id='" + uq + "']").val());
				  if(final<=orgval)
				  {
						$tr.removeAttr('qtyval');
						$tr.attr('qtyval',final);
						$tr.after($clone);
						$clone.find(':text').val($(this).val());
						$clone.find('td:first').text('');
						$clone.css('background','#FEC7B4');
						$clone.addClass('cancel_clr');
						$clone.find('a').addClass('a_demo_four_active');
						$clone.find(':text').prop('disabled', true);
						var qtychange=($(this).val())
						var qtyc	  =	 qtychange.split("-");
						$(this).val(final);
						//alert(final)
						var totc=parseFloat(rate) *  parseFloat(qtyc[1]);
						if($('#totalcancelrate').val()!="" || $('#totalcancelrate').val()!="0")
						{
						var fn=parseFloat($('#totalcancelrate').val()) + parseFloat(totc);
						}else
						{
							var fn= parseFloat(totc);
						}
						 $('#totalcancelrate').val(fn);
						 
					    $.post("load_bill.php", {menuchange:menuchange,portchange:portchange,kotchange:kotchange,ordchange:ordchange,qtychange:final,set:'cancelupdationbill'},
						function(data)
						{
						data=$.trim(data);
						//alert(data);
						$('#dfr').html(data);
						});
				  }else
				  {
					  $tr.find(':text').val(valtotext_org);
				  }
			  }
			  else
			  {
				  $tr.find(':text').val(valtotext_org);
			  }*/
		  }else
		  {//alert("gg");
		  }
		
	  });
	  /*************************************** cancel eachitem by qty ends *****************************************************  */
	  /***************************************  ok click starts *********************************************  */
   $('#stafflist').change(function () {
		var stafflist       = $("#stafflist").find('option:selected').attr('cancelkey');//alert(stafflist);
		//alert(stafflist)
		if(stafflist=='Y')
		{
			$(' #typeentery ').text('OTP');
			$(' .btn_index_popup_send ').css('display','block');
			$(' .btn_index_popup_send a').css('display','block');
		}else
		{
			$(' #typeentery ').text('Password');
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
	 
	  /***************************************  cancel bill click starts ********************************************************  */
   $('.cancel_billta_history').click(function () {
       $('#billhistory_mode').val($(this).attr('mode'));
	   $('.closeoneclass2').css('display','block');
		$('.confrmation_overlay').css('display','block');
		$('.closeoneclass2 .msgclass').html('');
		$('.closeoneclass2 .msgclass').html('Are you Sure you Want to Cancel This Bill?');
	 var billno  =  $(this).attr('bilno');//alert(billno)
	 $('#hidbilnotosave').val(billno);
	 $('#rprntmode').val('');
	 });
	 /***************************************  cancel bill click ends ******************************************************************  */
	  /***************************************  ok click starts ******************************************************************  */
          
          
          
          
   ////////////////------bill cancel ta cs-----//////////
          
   $('#kotcancel_reason_popup_new_proceed_btn').click(function (event) { 
              
              
             event.stopImmediatePropagation();
             
              var pin =  $('#pin').val();
              
               //pin=  pin.replace(/[^0-9]/g, ''); 
              
              
              var url='';
              
              if(pin !=''){
                  
                   if($('#cancel_billta_history').attr('mode')=='TA'){
                       
                      url="load_takeaway.php";
                  }else{
                      url="load_counter_sales.php";
                  }
              $.post(url, {pin:pin,value:'authpincheck',set:'pincheck'},
		function(data)
		{
                    data=$.trim(data);
                   
                    if(data!="NO")
                    {   
                        var spl=data.split('*');
                        
                        var rprntmode = $('#rprntmode').val();
                        
                        
                        if(rprntmode=='rprnt'){
                            
                        if(spl[1]=='reprint:Y'){ 
                               
                                
                        var bil= $('.bill_history_active').attr('billno');
                            
			    var dataString_log ='set_log_reprint_bill=log_reprint_bill&billno_reprint='+bil;
                            $.ajax({
                            type: "POST",
                            url: "printercheck_1.php",
                            data: dataString_log,
                            success: function(data) {

                            }
                            });
                            
			        var dataString; 
				dataString = 'value=ta_billprint&bypass=y&bilno='+bil+"&reprintok=Y";
				$.ajax({
				type: "POST",
				url: "print_details_kot.php",
				data: dataString,
				success: function(data2) {
					data2=data2.trim();
					if(data2=="ok")
					{
					  
				
					}
					
					}
				});
                                
                                
                $('.closeoneclass2').css('display','none');
                $('.kotcancel_reason_popup_new').css('display','none');
                $('.confrmation_overlay').css('display','none');
                $('#pin').val('');
                
                }else{
                    
                $("#pin_error").css("display","block");
		$("#pin_error").text("No  Permission!");
		$("#pin_error").delay(2000).fadeOut('slow');
                $("#pin").val('');
                
                }
                
                }else{
                        
                        
                        var billno       =  $('#hidbilnotosave').val();
                        var slno       =  $('#hidslnotosave').val();

                        var reasontext       =  $('#authcodersn').val();
                        var secretkey       =  '';
                        var stafflist       = spl[0];
                        
                      	var mode       = $('#his_mode').val();
                        
                if(mode!='CS'){
                            
                        if($('#kotcancel_reason_popup_new_proceed_btn').hasClass('tip_click')){
                                
                if(spl[8]=='tip_edit:Y'){
                                
                        add_tip('TA');
                        
                }else{
                    
                                    $("#pin_error").css("display","block");
                                    $("#pin_error").text("NO PERMISSION!");
                                    $("#pin_error").delay(2000).fadeOut('slow');
                                    $("#pin").val('');
                                    $("#pin").focus();
                }
                        
                }else{
                            
                if(spl[5]=='billcancel:Y'){ 
                                
                                
                $('.closeoneclass3').css('display','none');   
                $('.closeoneclass2').css('display','none');
                $('.kotcancel_reason_popup_new').css('display','none');
                $('.confrmation_overlay').css('display','none');
                $('#pin').val('');
                
                
			 $.post("load_ta_history.php", {billno:billno,reasontext:reasontext,secretkey:secretkey,stafflist:stafflist,value:'set_cancel_ta'},
			  function(data)
			  {
			  data=$.trim(data);
                         
                          var dt=data.split('{');
                      
			  if(dt[0]=="ok")
			  {
                              
					        $(".loaderror").css("display","block");
			  			$(".loaderror").addClass("billgenration_validate");
			  			$(".loaderror").text("Bill Cancelled");
			  			$(".loaderror").delay(2000).fadeOut('slow');
			  
                                                $('.closeoneclass2').css('display','none');
                                                $('.kotcancel_reason_popup_new').css('display','none');
                                                $('.confrmation_overlay').css('display','none');
                                                $('#pin').val('');
                          
                          
					        $('.closeoneclass2').css('display','none');
						$('.closeoneclass3').css('display','none');
						$('.confrmation_overlay').css('display','none');
						$('#hidbilnotosave').val('');
						$('#hidslnotosave').val('');
						$(' #typeentery ').text('');
						$('#reasontext').val('');
						$('#secretkey').val('');
				
						var dataString = 'value=load_ta_bildetails&billno=' + billno;
						var request= $.ajax({
							  type: "POST",
							  url: "load_ta_history.php",
							  data: dataString,
							  success: function(data) {
                                                              
								   $('#billdetailsset2').html(data);
								   
								   var dataString1 = 'value=load_ta_settlement&billno=' + billno;
								   var request1= $.ajax({
								   type: "POST",
								   url: "load_ta_history.php",
								   data: dataString1,
								   success: function(data1) {
											  
								   $('.settlementdetails').html(data1);
											   
											   
									var dataString2 = 'value=load_ta_bildetls&billno=' + billno;
									var request2= $.ajax({
									type: "POST",
									url: "load_ta_history.php",
									data: dataString2,
									success: function(data2) {
														
									$('#detailsset1_ta').html(data2);
														 
														 
									$.post("load_ta_history.php", {billno:billno,value:'billwholeload_ta'},
									function(data)
									{
									    data=$.trim(data);
									    $('#ta_billlisttotal').html(data);
                                                                            
									});
														
									} });
											  
									} });
								  
						    }
						   });  
				  }
			
			  });
			 
		
		
                
                
                }
                else{
                                
                $("#pin_error").css("display","block");
		$("#pin_error").text("No  Permission");
		$("#pin_error").delay(2000).fadeOut('slow');
                $("#pin").val('');
                
                }
                }    
                }else{
                           
                     
                        if($('#kotcancel_reason_popup_new_proceed_btn').hasClass('tip_click')){
                                
                                if(spl[8]=='tip_edit:Y'){
                                
                                    add_tip('CS');
                                }
                                else{
                                    $("#pin_error").css("display","block");
                                    $("#pin_error").text("NO PERMISSION!");
                                    $("#pin_error").delay(2000).fadeOut('slow');
                                    $("#pin").val('');
                                      $("#pin").focus();
                                }
                        }else{
                            
                        if(spl[5]=='billcancel:Y'){
                            
                           $('.closeoneclass2').css('display','none');
			   $('.closeoneclass3').css('display','none');
                           $('.kotcancel_reason_popup_new').css('display','none');
                           $('.confrmation_overlay').css('display','none');
                           $('#pin').val('');
                          
			
			 $.post("load_cs_history.php", {billno:billno,reasontext:reasontext,secretkey:secretkey,stafflist:stafflist,value:'set_cancel_ta'},
			  function(data)
			  {
			  data=$.trim(data);
                          
                          var dt=data.split('{');
                          
			  if(dt[0]=="ok")
			  {
                              
                              
                              
					        $(".loaderror").css("display","block");
			  			$(".loaderror").addClass("billgenration_validate");
			  			$(".loaderror").text("Bill Cancelled");
			  			$(".loaderror").delay(2000).fadeOut('slow');
			  
//                           var datastringnewcard="sethistory=delhistory&bilcardhistory="+billno;
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
//                          $.post("smsvoid_cs.php", {set:'smsvoidcs',billno1:billno},
//				  function(data)
//				  {
//				  	//alert(data);
//				  });
                          
                          
                          
					        $('.closeoneclass2').css('display','none');
					 	$('.closeoneclass3').css('display','none');
						$('.confrmation_overlay').css('display','none');
						$('#hidbilnotosave').val('');
						$('#hidslnotosave').val('');
						$(' #typeentery ').text('');
						$('#reasontext').val('');
						$('#secretkey').val('');
					
					        //var billno   =  $(this).attr("billno");//alert(billno);
						var dataString = 'value=load_ta_bildetails&billno=' + billno;
						var request= $.ajax({
							  type: "POST",
							  url: "load_cs_history.php",
							  data: dataString,
							  success: function(data) {
								   $('#billdetailsset2').html(data);
								   
								   var dataString1 = 'value=load_ta_settlement&billno=' + billno;
									var request1= $.ajax({
										  type: "POST",
										  url: "load_cs_history.php",
										  data: dataString1,
										  success: function(data1) {
											  
											   $('.settlementdetails').html(data1);
											   
											   
											   var dataString2 = 'value=load_ta_bildetls&billno=' + billno;
											   var request2= $.ajax({
													type: "POST",
													url: "load_cs_history.php",
													data: dataString2,
													success: function(data2) {
														
														 $('#detailsset1_ta').html(data2);
														 
														 
														 $.post("load_cs_history.php", {billno:billno,value:'billwholeload_ta',mode:'CS'},
														  function(data)
														  {
															data=$.trim(data);
															$('#ta_billlisttotal').html(data);
														  });
														
													}
												 });
											  
										  }
									   });
								   
								   
								   
								   
								  
							  }
						   });  
                                                   
                $('.closeoneclass2').css('display','none');
                $('.kotcancel_reason_popup_new').css('display','none');
                $('.confrmation_overlay').css('display','none');
                $('#pin').val('');
                                                  
		}
			
			  
		});
			 
                }
                else{
                    
                $("#pin_error").css("display","block");
		$("#pin_error").text("No Permission");
		$("#pin_error").delay(2000).fadeOut('slow');
                $("#pin").val('');
                $("#pin").focus();
                 
                } 
                        }    
		
                    }
                }
                
                
                 
                    }else{
                        
                        $("#pin_error").css("display","block");
			$("#pin_error").text("CODE NOT REGISTERED");
			$("#pin_error").delay(2000).fadeOut('slow');
                        $("#pin").val('');
                        $("#pin").focus();
                    }
                });
                
            }else{
                $("#pin_error").css("display","block");
		$("#pin_error").text("ENTER PIN");
		$("#pin_error").delay(2000).fadeOut('slow');
                $("#pin").val('');
                $("#pin").focus();
            }
            
            
   });
          
  //-------------end----////////
          
          
          
   $('.closeok2').click(function (event) {
     
                event.stopImmediatePropagation();
		var billno       =  $('#hidbilnotosave').val();
		var slno       =  $('#hidslnotosave').val();

		var reasontext       =  $('#reasontext').val();
		var secretkey       =  $('#secretkey').val();
		var stafflist       =  $('#stafflist').val();
		$(' #typeentery ').text('');
		// alert(billno+slno+reasontext+secretkey)
		
		if(slno=='')
		{
			var stafflist       =  $('#stafflist').val();
			$.post("take_away_.php", {secretkey:secretkey,stafflist:stafflist,set:'secretkeycheck'},
			function(data)
			{
                            var data1=data.split("<");
                            data=$.trim(data1[0]);
			data=$.trim(data);
			if(data=="ok")
			{
                            //alert(rprntmode);
                            var rprntmode = $('#rprntmode').val();
                            
                            if(rprntmode=='rprnt'){
                                
                                $('.closeoneclass2').css('display','none');
						$('.closeoneclass3').css('display','none');
						$('.confrmation_overlay').css('display','none');
                                
                                 var bil= $('.bill_history_active').attr('billno');
			 
			 var dataString; 
				dataString = 'value=ta_billprint&bypass=y&bilno='+bil+"&reprintok=Y";
				 $.ajax({
				type: "POST",
				url: "print_details_kot.php",
				data: dataString,
				success: function(data2) {
					data2=data2.trim();
					if(data2=="ok")
					{
					  
				
					}
					
					}
				});
                            }else {
			var stafflist       =  $('#stafflist').val();//alert(billno+slno+reasontext+secretkey+stafflist)
			 $.post("load_ta_history.php", {billno:billno,reasontext:reasontext,secretkey:secretkey,stafflist:stafflist,value:'set_cancel_ta'},
			  function(data)
			  {
			  data=$.trim(data);//alert(data);
			  if(data=="ok")
			  {
					   $(".loaderror").css("display","block");
			  			$(".loaderror").addClass("billgenration_validate");
			  			$(".loaderror").text("Item Canceled");
			  			$(".loaderror").delay(2000).fadeOut('slow');
			  
					  $('.closeoneclass2').css('display','none');
						$('.closeoneclass3').css('display','none');
						$('.confrmation_overlay').css('display','none');
						$('#hidbilnotosave').val('');
						$('#hidslnotosave').val('');
						$(' #typeentery ').text('');
						$('#reasontext').val('');
						$('#secretkey').val('');
					
//                                          var datastringnewcard="sethistory=delhistory&bilcardhistory="+billno;
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
//                                          $.post("smsvoid_ta.php", {set:'smsvoidta',billno1:billno},
//				  function(data)
//				  {
//				  	//alert(data);
//				  });
                                        
                                        
                                        
					//var billno   =  $(this).attr("billno");//alert(billno);
						var dataString = 'value=load_ta_bildetails&billno=' + billno;
						var request= $.ajax({
							  type: "POST",
							  url: "load_ta_history.php",
							  data: dataString,
							  success: function(data) {
								   $('#billdetailsset2').html(data);
								   
								   var dataString1 = 'value=load_ta_settlement&billno=' + billno;
									var request1= $.ajax({
										  type: "POST",
										  url: "load_ta_history.php",
										  data: dataString1,
										  success: function(data1) {
											  
											   $('.settlementdetails').html(data1);
											   
											   
											   var dataString2 = 'value=load_ta_bildetls&billno=' + billno;
											   var request2= $.ajax({
													type: "POST",
													url: "load_ta_history.php",
													data: dataString2,
													success: function(data2) {
														
														 $('#detailsset1_ta').html(data2);
														 
														 
														 $.post("load_ta_history.php", {billno:billno,value:'billwholeload_ta'},
														  function(data)
														  {
															data=$.trim(data);
															$('#ta_billlisttotal').html(data);
														  });
														
													}
												 });
											  
										  }
									   });
								   
								   
								   
								   
								  
							  }
						   });  
				  }
			
			  
			  });
			 
		
                        }
			}else
			{
			 		$("#deatilserror").css("display","block");
				  // $("#deatilserror").addClass("billgenration_validate");
			 		$("#deatilserror").text("OTP Error!!");
					$("#deatilserror").delay(2000).fadeOut('slow');
			}
			});
		}else
		{
		
		$.post("take_away_.php", {secretkey:secretkey,stafflist:stafflist,set:'secretkeycheck'},
			function(data)
			{
                            var data1=data.split("<");
                            data=$.trim(data1[0]);
			data=$.trim(data);//alert(data);
			if(data=="ok")
			{
                            
				var stafflist       =  $('#stafflist').val();
		//alert(data+"sec");
		//alert("bill="+billno+"slno="+slno+"reason="+reasontext+"secret="+secretkey+"staff="+stafflist);
				  $.post("load_ta_history.php", {billno:billno,slno:slno,reasontext:reasontext,secretkey:secretkey,stafflist:stafflist,value:'set_cancel_ta'},
				  function(data)
				  {
				  data=$.trim(data);//alert(data);
				  if(data=="ok")
				  {
					   $(".loaderror").css("display","block");
			  			$(".loaderror").addClass("billgenration_validate");
			  			$(".loaderror").text("Item Canceled");
			  			$(".loaderror").delay(2000).fadeOut('slow');
			  
					  $('.closeoneclass2').css('display','none');
						$('.closeoneclass3').css('display','none');
						$('.confrmation_overlay').css('display','none');
						$('#hidbilnotosave').val('');
						$('#hidslnotosave').val('');
						$(' #typeentery ').text('');
						$('#reasontext').val('');
						$('#secretkey').val('');
					
					//var billno   =  $(this).attr("billno");//alert(billno);
						var dataString = 'value=load_ta_bildetails&billno=' + billno;
						var request= $.ajax({
							  type: "POST",
							  url: "load_ta_history.php",
							  data: dataString,
							  success: function(data) {
								   $('#billdetailsset2').html(data);
								   
								   var dataString1 = 'value=load_ta_settlement&billno=' + billno;
									var request1= $.ajax({
										  type: "POST",
										  url: "load_ta_history.php",
										  data: dataString1,
										  success: function(data1) {
											  
											   $('.settlementdetails').html(data1);
											   
											   
											   var dataString2 = 'value=load_ta_bildetls&billno=' + billno;
											   var request2= $.ajax({
													type: "POST",
													url: "load_ta_history.php",
													data: dataString2,
													success: function(data2) {
														
														 $('#detailsset1_ta').html(data2);
														 
														 $.post("load_ta_history.php", {billno:billno,value:'billwholeload_ta'},
														  function(data)
														  {
															data=$.trim(data);
															$('#ta_billlisttotal').html(data);
														  });
														
													}
												 });
											  
										  }
									   });
								   
								   
								   
								   
								  
							  }
						   });  
				  }
				  });
			
			}else
			{
				var tp='';
				var stafflist       = $("#stafflist").find('option:selected').attr('cancelkey');//alert(stafflist);
				if(stafflist=='Y')
				{
					tp='OTP';
				}else
				{
					tp='Password';
				}
				$("#deatilserror").css("display","block");
				  // $("#deatilserror").addClass("billgenration_validate");
			 		$("#deatilserror").text(tp+" Error!!");
					
			 		//$("#deatilserror").css("display","block");
				  // $("#deatilserror").addClass("billgenration_validate");
			 		//$("#deatilserror").text("OTP Error!!");
					$("#deatilserror").delay(2000).fadeOut('slow');
			}
			});
		}
	
	});
           $('.closeokcs').click(function (event) {
             
        event.stopImmediatePropagation();
		var billno       =  $('#hidbilnotosave').val();
		var slno       =  $('#hidslnotosave').val();

		var reasontext       =  $('#reasontext').val();
		var secretkey       =  $('#secretkey').val();
		var stafflist       =  $('#stafflist').val();
		$(' #typeentery ').text('');
		// alert(billno+slno+reasontext+secretkey)
		
		if(slno=='')
		{
			var stafflist       =  $('#stafflist').val();
			$.post("counter_sales.php", {secretkey:secretkey,stafflist:stafflist,set:'secretkeycheck'},
			function(data)
			{ //alert(data);
                            var data1=data.split("key_");
                             data1=data1[1].split("<");
                             data=data1[0].trim(" ");
                            //alert(data);
                            
			if(data=="ok")
			{  
                            
                            var rprntmode = $('#rprntmode').val();
                            if(rprntmode=='rprnt'){
                                
                                $('.closeoneclass2').css('display','none');
						$('.closeoneclass3').css('display','none');
						$('.confrmation_overlay').css('display','none');
                                
                                 var bil= $('.bill_history_active').attr('billno');
			 
			 var dataString; 
				dataString = 'value=ta_billprint&bypass=y&bilno='+bil;
				 $.ajax({
				type: "POST",
				url: "print_details_kot.php",
				data: dataString,
				success: function(data2) {
					data2=data2.trim();
					if(data2=="ok")
					{
					  
				
					}
					
					}
				});
                            }else{
                            
			var stafflist       =  $('#stafflist').val();//alert(billno+slno+reasontext+secretkey+stafflist)
			 $.post("load_cs_history.php", {billno:billno,reasontext:reasontext,secretkey:secretkey,stafflist:stafflist,value:'set_cancel_ta'},
			  function(data)
			  {
			  data=$.trim(data);//alert(data);
			  if(data=="ok")
			  {
					   $(".loaderror").css("display","block");
			  			$(".loaderror").addClass("billgenration_validate");
			  			$(".loaderror").text("Item Canceled");
			  			$(".loaderror").delay(2000).fadeOut('slow');
			  
                          
                          
//                            var datastringnewcard="sethistory=delhistory&bilcardhistory="+billno;
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
                          
//                                  $.post("smsvoid_cs.php", {set:'smsvoidcs',billno1:billno},
//				  function(data)
//				  {
//				  	//alert(data);
//				  });
                          
                          
                          
					  $('.closeoneclass2').css('display','none');
						$('.closeoneclass3').css('display','none');
						$('.confrmation_overlay').css('display','none');
						$('#hidbilnotosave').val('');
						$('#hidslnotosave').val('');
						$(' #typeentery ').text('');
						$('#reasontext').val('');
						$('#secretkey').val('');
					
					//var billno   =  $(this).attr("billno");//alert(billno);
						var dataString = 'value=load_ta_bildetails&billno=' + billno;
						var request= $.ajax({
							  type: "POST",
							  url: "load_cs_history.php",
							  data: dataString,
							  success: function(data) {
								   $('#billdetailsset2').html(data);
								   
								   var dataString1 = 'value=load_ta_settlement&billno=' + billno;
									var request1= $.ajax({
										  type: "POST",
										  url: "load_cs_history.php",
										  data: dataString1,
										  success: function(data1) {
											  
											   $('.settlementdetails').html(data1);
											   
											   
											   var dataString2 = 'value=load_ta_bildetls&billno=' + billno;
											   var request2= $.ajax({
													type: "POST",
													url: "load_cs_history.php",
													data: dataString2,
													success: function(data2) {
														
														 $('#detailsset1_ta').html(data2);
														 
														 
														 $.post("load_cs_history.php", {billno:billno,value:'billwholeload_ta',mode:'CS'},
														  function(data)
														  {
															data=$.trim(data);
															$('#ta_billlisttotal').html(data);
														  });
														
													}
												 });
											  
										  }
									   });
								   
								   
								   
								   
								  
							  }
						   });  
				  }
			
			  
			  });
			 
		
                        }
			}else
			{
			 		$("#deatilserror").css("display","block");
				  // $("#deatilserror").addClass("billgenration_validate");
			 		$("#deatilserror").text("OTP Error!!");
					$("#deatilserror").delay(2000).fadeOut('slow');
			}
			});
		}else
		{
		
		$.post("counter_sales.php", {secretkey:secretkey,stafflist:stafflist,set:'secretkeycheck'},
			function(data)
			{
                            var data1=data.split("<");
                            data=$.trim(data1[0]);
			data=$.trim(data);//alert(data);
			if(data=="ok")
			{
				var stafflist       =  $('#stafflist').val();
		//alert(data+"sec");
		//alert("bill="+billno+"slno="+slno+"reason="+reasontext+"secret="+secretkey+"staff="+stafflist);
				  $.post("load_cs_history.php", {billno:billno,slno:slno,reasontext:reasontext,secretkey:secretkey,stafflist:stafflist,value:'set_cancel_ta'},
				  function(data)
				  {
				  data=$.trim(data);//alert(data);
				  if(data=="ok")
				  {
					   $(".loaderror").css("display","block");
			  			$(".loaderror").addClass("billgenration_validate");
			  			$(".loaderror").text("Item Canceled");
			  			$(".loaderror").delay(2000).fadeOut('slow');
			  
					  $('.closeoneclass2').css('display','none');
						$('.closeoneclass3').css('display','none');
						$('.confrmation_overlay').css('display','none');
						$('#hidbilnotosave').val('');
						$('#hidslnotosave').val('');
						$(' #typeentery ').text('');
						$('#reasontext').val('');
						$('#secretkey').val('');
					
					//var billno   =  $(this).attr("billno");//alert(billno);
						var dataString = 'value=load_ta_bildetails&billno=' + billno;
						var request= $.ajax({
							  type: "POST",
							  url: "load_cs_history.php",
							  data: dataString,
							  success: function(data) {
								   $('#billdetailsset2').html(data);
								   
								   var dataString1 = 'value=load_ta_settlement&billno=' + billno;
									var request1= $.ajax({
										  type: "POST",
										  url: "load_cs_history.php",
										  data: dataString1,
										  success: function(data1) {
											  
											   $('.settlementdetails').html(data1);
											   
											   
											   var dataString2 = 'value=load_ta_bildetls&billno=' + billno;
											   var request2= $.ajax({
													type: "POST",
													url: "load_cs_history.php",
													data: dataString2,
													success: function(data2) {
														
														 $('#detailsset1_ta').html(data2);
														 
														 $.post("load_cs_history.php", {billno:billno,value:'billwholeload_ta',mode:'CS'},
														  function(data)
														  {
															data=$.trim(data);
															$('#ta_billlisttotal').html(data);
														  });
														
													}
												 });
											  
										  }
									   });
								   
								   
								   
								   
								  
							  }
						   });  
				  }
				  });
			
			}else
			{
				var tp='';
				var stafflist       = $("#stafflist").find('option:selected').attr('cancelkey');//alert(stafflist);
				if(stafflist=='Y')
				{
					tp='OTP';
				}else
				{
					tp='Password';
				}
				$("#deatilserror").css("display","block");
				  // $("#deatilserror").addClass("billgenration_validate");
			 		$("#deatilserror").text(tp+" Error!!");
					
			 		//$("#deatilserror").css("display","block");
				  // $("#deatilserror").addClass("billgenration_validate");
			 		//$("#deatilserror").text("OTP Error!!");
					$("#deatilserror").delay(2000).fadeOut('slow');
			}
			});
		}
	
	});
	 /***************************************  ok click ends ******************************************************************  */
         
         
     $('.confirmkotok_ta_reprint').unbind().click(function () {
          $('.kotconfirmpopup_ta_reprint').css('display','none');   
                    $(".confrmation_overlay").css("display","none");
                    
                    
                   $('#rprntmode').val('rprnt');
                    $('#reasontext').hide();
                    $('#rsntxt').css('display','none');
                    $('#authcodersn').css('display','none');
		 if($('.ta_bill_history').hasClass('bill_history_active'))
		  {
                        var rprnt_auth = $('#reprint_with_permission').val();
                        if(rprnt_auth == 'Y'){
                           // alert('perm');
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
                      
			 var bil= $('.bill_history_active').attr('billno');
			 
			 var dataString; 
				dataString = 'value=ta_billprint&bypass=y&bilno='+bil+"&reprintok=Y";
				 $.ajax({
				type: "POST",
				url: "print_details_kot.php",
				data: dataString,
				success: function(data2) {
					data2=data2.trim();
					if(data2=="ok")
					{
					  
				
					}
					
					}
				});
                            }
		  }else
		  {
			  $(".loaderror").css("display","block");
			  $(".loaderror").addClass("billgenration_validate");
			  $(".loaderror").text("Nothing to reprint");
			  $(".loaderror").delay(2000).fadeOut('slow');
		  }
     });  
        
      $('.confirmkotclose_ta_reprint').click(function () {
         
         $('.kotconfirmpopup_ta_reprint').css('display','none');   
                    $(".confrmation_overlay").css("display","none");
     });  
         
         
	 $('#reprintbill_ta').click(function () {
            $('#pin').val('');
             $('#billhistory_mode').val($(this).attr('mode'));
             var TA_bill_print = "TA_bill_print";
                //------------
                $.post("printercheck_1.php", {type:TA_bill_print},

                function(data)
                { 
                data=$.trim(data); 
                
                if(data!=0){
                    
                   // $('.disountenterpopup').css('display','none');  
                      $('.kotconfirmpopup_ta_reprint').css('display','block');   
                    $(".confrmation_overlay").css("display","block");
               var data1="Takeaway -"+data;
               
                $('#kotfailmsg_ta_reprint').html(data1);
                    
                  }else  {
             
		
                   $('#rprntmode').val('rprnt');
                    $('#reasontext').hide();
                    $('#rsntxt').css('display','none');
                    $('#authcodersn').css('display','none');
		 if($('.ta_bill_history').hasClass('bill_history_active'))
		  {
                        var rprnt_auth = $('#reprint_with_permission').val();
                        if(rprnt_auth == 'Y'){
                           // alert('perm');
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
                      
			 var bil= $('.bill_history_active').attr('billno');
			 
                         
                         var dataString_log ='set_log_reprint_bill=log_reprint_bill&billno_reprint='+bil;
                            $.ajax({
                            type: "POST",
                            url: "printercheck_1.php",
                            data: dataString_log,
                            success: function(data) {

                            }
                            });
                         
                         
                         
                         
			 var dataString; 
				dataString = 'value=ta_billprint&bypass=y&bilno='+bil+"&reprintok=Y";
				 $.ajax({
				type: "POST",
				url: "print_details_kot.php",
				data: dataString,
				success: function(data2) {
					data2=data2.trim();
					if(data2=="ok")
					{
					  
				
					}
					
					}
				});
                            }
		  }else
		  {
			  $(".loaderror").css("display","block");
			  $(".loaderror").addClass("billgenration_validate");
			  $(".loaderror").text("Nothing to reprint");
			  $(".loaderror").delay(2000).fadeOut('slow');
		  }
              }
          });
	});	 
   
}); 



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
        url: "load_cs_history.php",
        data: datastringcus,
        success: function(data)
        {
            
     var d=data.split('<');
     var d2=d[0].trim();
  //alert(d2);
            if(d2=='ok'){
          alert("Customer details updated");
         // $("#ta_billlisttotal").load("cs_bill_history.php" + " #ta_billlisttotal");
           $('.update_billdetails').click();
              }
        }
        
    });
               
               
            }
  function add_tip(mode){
        
        var tip_amount=0;
        var tip_mode='C';
        if($('#tip_feild').val()!='' && $('#tip_feild').val()>0){
            tip_amount=$('#tip_feild').val();
            tip_mode=$('#tip_pay_mode').val();
            
        }
        var url='';
        if(mode=='TA'){
            url="load_ta_history.php";
        }else if(mode=='CS'){
            url="load_cs_history.php";
        }
        var billno       =  $('.bill_history_active').attr('billno');
        
        var data_tip="set=add_tip&tip_amount="+tip_amount+"&billno="+billno+"&tip_mode="+tip_mode;
        $.ajax({
            type: "POST",
            url: "load_ta_history.php",
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