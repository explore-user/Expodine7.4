// JavaScript Document
$(document).ready(function(){
    
    
    var  dataString1 = 'set=set_print_option&print_option=Y' ;
                      
		$.ajax({
		type: "POST",
		url: "load_index.php",
		data: dataString1,
		success: function(data) {
                    
                }
                });
                
         
  $('#print_checker').click(function (e) {
         
           if ($("#print_checker").is(":checked")) {
                   var print_option='Y';
           }else{
                   print_option='N';
           }
           
                var  dataString1 = 'set=set_print_option&print_option='+print_option ;
                $.ajax({
		type: "POST",
		url: "load_index.php",
		data: dataString1,
		success: function(data) {
                }
                });
         
  });  
    
    
 $("#dis_pin").keyup(function(event) {
         
           
                if($('#dis_pin').val()!=''){
                    
                    
                 if (event.keyCode == 13) {    
                
                if($("#dis_pin").is(':focus')){
                   
               $('#dis_auth_proceed').click();
               
                $("#dis_pin").blur();
               
                }
                
                }
         
         
            }else{      
                
                        $("#dis_error").css("display","block");
			$("#dis_error").text("ENTER YOUR PERSONAL PIN ");
			$("#dis_error").delay(2000).fadeOut('slow');
                       
                         $("#dis_pin").val('');
                        $("#dis_pin").off('blur');
                         setTimeout(function () {
                            $("#dis_pin").focus();
                        }, 1000)
                        
                          
            }
 });
        
        
 $('#dis_auth_proceed').click(function (event) {
       
              event.stopImmediatePropagation();
            
              var pin =  $('#dis_pin').val();
            
              if(pin !=''){
              $.post("load_counter_sales.php", {pin:pin,value:'authpincheck',set:'pincheck'},
		function(data)
		{ 
                   
                  data=$.trim(data);
                  
                  var staff_sl=data.split('*');
                  var staff=staff_sl[0];
                  
               
                    if(data!="NO")
                    { 
                        if(staff_sl[6]=='dis_auth:Y'){
                            
                          if(staff_sl[7]=='dis_manual:Y'){
                                 
                             $('.manual_permission_cs').css('display','block');
                          }
                          
                        var disc=$('#counter_discount_popup').val();
      
                        if(disc=="Y")
                        {      
                           $('.disountenterpopup').css('display','block');
                        } 
                        
                        $('.auothorize_popup').css('display','none');
                        $('#new_proceed_loyalty_div').hide();
                        $('#dis_pin').val('');
                        $('#ly_id').focus();
                        
                        
                        }else{
                            
                        $("#dis_error").css("display","block");
			$("#dis_error").text("NO PERMISSION TO APPLY DISCOUNT");
			$("#dis_error").delay(2000).fadeOut('slow');
                        $("#dis_pin").val('');
                        $("#dis_pin").off('blur');
                        $("#dis_pin").focus();
                        
                       }		
                    }
                    else{
                        
                        $("#dis_error").css("display","block");
			$("#dis_error").text("ENTER A VALID PIN");
			$("#dis_error").delay(2500).fadeOut('slow');
                        $("#dis_pin").val('');
                        $("#dis_pin").off('blur');
                        $("#dis_pin").focus();
                    }
                });
            }
            else{      
                
                        $("#dis_error").css("display","block");
			$("#dis_error").text("ENTER YOUR PERSONAL PIN ");
			$("#dis_error").delay(2000).fadeOut('slow');
                       
                         $("#dis_pin").val('');
                        $("#dis_pin").off('blur');
                         setTimeout(function () {
                            $("#dis_pin").focus();
                        }, 1000)
                        
                          
            }
       
   });
   
    
 $('.pay_settle_btn').click( function(event) {
         
	event.stopImmediatePropagation();
        
	var focused=$('#focusedtext').val();
                
	var calval=($(this).text());
		
	var org=$('#'+focused).val();
               
        if($('.auothorize_popup').css('display') == 'block')
        {
            var ct=4;
        }else{
            ct=12;
        }
        
			if(calval>=0)
			{   
                            if(org.length<ct){
				if(org==0)
				{
					 $('#'+focused).val(org+calval);
				}else if(parseFloat(org)>0)
				{ 
					$('#'+focused).val(org+calval);
				  
				}else if(org<0)
				{
					$('#'+focused).val(org+calval);
				}
                                else if(org=='.')
				{
					$('#'+focused).val("0"+org+calval);
				}
                            }
//                            
			}else if(calval=="Clear")
			{
				$('#'+focused).val("");
			}else if(calval=="." )
			{
				$('#'+focused).val(org+".");
			}
                        
			$('#'+focused).change();
		         $('#'+focused).focus();
		
	});             
    
   $("#pin").keyup(function(event) {
         
            if (event.keyCode == 13) {
                if($("#pin").is(':focus')){
                   
               $('#kotcancel_reason_popup_new_proceed_btn_cs').click();
                $("#pin").blur();
               
                }
              
            }
   });
       
       
 /********* category selection  starts ********  */
        
 $('.ta_categorysel').click(function (event) {
		
		event.stopImmediatePropagation();
		$('#ta_loadbottomcontent').empty();
		$('#search').val('');
	  $(".ta_categorysel>div").removeClass("main_category_list_act");
          $(this).find("div").addClass('main_category_list_act'); 
	  var id_str   =  $(this).attr("catid");
	  var id_arr	  =	 id_str.split("_");
	  var cat_id       = id_arr[1];
	  $('#ta_catname').val(cat_id);
          
	  var dataString = 'value=subcatselection&category=' + cat_id;
	  var request=  $.ajax({
		type: "POST",
		url: "load_counter_sales.php",
		data: dataString,
		success: function(data) {
		 $('#ta_loadsubcat').html(data);
		}
	  });
	   data = null;
	   dataString = null;
	   $('#ta_loadmenuitems').html('<img src="img/ajax-loaders/ajax-loader.gif" height="70px" style="margin:auto"  />');
	   $('#ta_loadmenuitems').css("vertical-align","middle");
	   $('#ta_loadmenuitems').css("display","flex");
	   dataString = 'value=menuselection&category=' + cat_id;
	   var request= $.ajax({
			type: "POST",
			url: "load_counter_sales.php",
			data: dataString,
			success: function(data) {
				 $('#ta_loadmenuitems').html(data);
				 $('#ta_loadmenuitems').css("text-align","left");
				 $('#ta_loadmenuitems').css("display","inherit");
			}
	 	 });
		 data = null;
		 dataString = null;
		request.onreadystatechange = null;
		request.abort = null;
		request = null;	
	        return false;
	
  });
	/*****************  category selection  ends *************************  */
	
	
	/*********** Sub category selection  starts ************  */
        
 $('.ta_subcatchange').click(function (event) {
            
		event.stopImmediatePropagation();
		$('#ta_loadmenuitems').empty();
		$('#ta_loadbottomcontent').empty();
		$('#search').val('');
		var subcategory=$(this).attr('values');
		var categoryid=$('#ta_catname').val();
		$('.ta_subcatchange').removeClass('subctselected');
		$(this).addClass('subctselected');
		subcategory=subcategory.trim();
		var dataString;
		if(subcategory!="all")
		{
		    dataString = 'value=menuselection&category=' + categoryid +'&subcategory=' + subcategory;
		}else
		{
			 dataString = 'value=menuselection&category=' + categoryid;
		}
	   $('#ta_loadmenuitems').html('<img src="img/ajax-loaders/ajax-loader.gif" height="70px" style="margin:auto"  />');
	   $('#ta_loadmenuitems').css("vertical-align","middle");
	   $('#ta_loadmenuitems').css("display","flex");
		var request=  $.ajax({
			type: "POST",
			url: "load_counter_sales.php",
			data: dataString,
			success: function(data) {
					$('#ta_loadmenuitems').html(data);
					$('#ta_loadmenuitems').css("text-align","left");
					$('#ta_loadmenuitems').css("display","inherit");
				}
	  		});
			 data = null;
		 dataString = null;
		request.onreadystatechange = null;
		request.abort = null;
		request = null;
		 return false;
	});	
	/***************** Sub category selection  ends *********************  */
        
        
        
	/*************************************** Sub category selection  starts *************************************************  */

 $('.edititems').click(function (event) {
            
	if($(this).hasClass('right_act_edit_dsbl'))
		{
                    
		}else
		{
			
		event.stopImmediatePropagation();
		  var selval   =  $('.active_couter_list').attr('menuid');
		  var actqty   =  $('.active_couter_list').attr('actqty');
		  var portname   =  $('.active_couter_list').attr('portionname');
		  var prefname   =  $('.active_couter_list').attr('pref'); 
                   var rate1 = $('.active_couter_list').attr('rate');
                  
		  $('.counter_menu_popup_overlay').css("display","block"); 
		  $('.counter_menu_popup').css("display","block"); 
			 $('.menu_sub_item').removeClass('take_item_active');  
			 $(this).find('div').addClass('take_item_active');
			 
			  
				  var request = $.ajax({
					url: "counter_popup.php",
					method: "POST",
					data: {menu:selval,typesub:'Edit',actqty:actqty,portname:portname,prefname:prefname,manualrate:rate1 },
					dataType: "html"
				  });
				   
				  request.done(function( msg ) {
					$( ".counter_menu_popup" ).html( msg );
					
					
				  });
				  
				  data = null;
					msg=null;
				  request.onreadystatechange = null;
				  request.abort = null;
				  request = null;
		}
	
	});	
	/******************* Sub category selection  ends ************************  */
        
        
        
	/********************** Delete button click starts *******************  */
        
  $('#ta_deleteitems').click(function (e) {
		
		if($(this).hasClass('right_act_delete_dsbl'))
		{
			
		}else
		{	
			if($('.eachitem_counter').hasClass('active_couter_list'))
			{
			   $('#ta_confirm').css('display','block');
			
			}else
			{
			  $('.ta_errormsg').css("display",'block');
			  $('.ta_errormsg').text("Nothing to delete...");
			  $('.ta_errormsg').delay(2000).fadeOut('slow');
			}
		}
		return false;
	});
        
	/***************  Delete button click  ends ****************  */
	
	
        
	/********************* counter submit starts ************************************************************************/
        
  $('#new_proceed_loyalty').click(function (event) { 
           
       event.stopImmediatePropagation(); 
       
       $('#new_proceed_loyalty_div').hide();
         
       var sel=$('#bscur').val();
       var cur_on=$('#curshowfocus').val();
       if(cur_on=="Y"){
       var datastringnew22="set5=cat5&idofcur5="+sel;
      
       $.ajax({
        type: "POST",
        url: "counter_sales.php",
        data: datastringnew22,
        success: function(data)
        {
           
     $("#divall").load(location.href + " #divall");
   
        }  }); }       
       
        var decimal = $('#decimal').val();
        var itemsact = $('.eachitem_counter');	
	var actlenght=(itemsact.length);
	if(actlenght>=1)
	{
            
		var settle=$('#counter_bill_before_settle').val();
		var discount_unit='';
		var discount_of='';
		var discountid='none';
		var discount='';
		var dataString;
		var typvl=$('.settypeval').val();
                
                var csname=$('#cs_name').val();
                var csphone=$('#cs_phone').val();
                var csgst=$('#cs_gst').val();
                var tablenocs=$('#table_cs').val();
                var pax=$('#cspax').val();
              
              
           if($('#ly_number').val()!=""){
                                             
            var loyalty_id=$('#ly_id').val();
            var loyalty_billamount=$('#tot_org').val();
            var loyalty_billamount1=$('.tal_viewtotal').text();
            var lp_add=$('#point_rule_add').val();
            var lp_amt=$('#point_rule_add').attr('amt_add');
            var tot_point= (loyalty_billamount1/lp_amt)*lp_add;
            var loyalty_pointredeem=$('#redeem_point_total').text();
            var loyalty_redeemamount=$('#redeem_amount_total').text();
            var loy_number=$('#ly_number').val();
            var loy_name=$('#ly_name').val();
                    
            }else{
                  loyalty_pointredeem=0;
                  tot_point=0;
                  loyalty_redeemamount=0;
                  loyalty_billamount=0;
            }
              
              
              
		  if(typvl=="Y")
		   {  
			dataString = 'value=gensettle_first&discount_of='+ discount_of + '&discount=' + discount + '&discount_unit='+discount_unit+ '&discountid='+discountid+"&csname="+csname+"&csphone="+csphone+"&csgst="+csgst+"&table_cs="+tablenocs+"&pax="+pax+"&id_loy="+loyalty_id+"&point_add="+tot_point+"&point_redeem="+loyalty_pointredeem+"&billamount="+loyalty_billamount+"&redeemamount="+loyalty_redeemamount+"&new_bill_amt="+loyalty_billamount1+"&loy_number="+loy_number+"&loy_name="+loy_name;
			
                                $.ajax({
					type: "POST",
					url: "load_counter_sales.php",
					data: dataString,
					success: function(data) {
						data=$.trim(data); 
                                               
						
					if(settle=="Y")
					{
						var dataString; 
								  dataString = 'value=ta_billprint&bypass=y';
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
							var det=data.split(",");
                                                        
                                                  var dataStringbillno; 
						 dataStringbillno = 'value=bilnoreturn';
						 $.ajax({
						type: "POST",
						url: "load_counter_sales.php",
						data: dataStringbillno,
						success: function(data) {
							data=data.trim();
							$('#settleingbilno').text(data);
							}
						});
                                                
						$(".counter_settle_popup").css("display","block");
						$(".counter_menu_popup_overlay").css("display","block");
						$('#focusedtext').val('paidamount');
						$('#paidamount').focus();
                                                $('#paidamount').select(); 
                                         
                                                
                                $('#paidamount').val(det[1]);
                         $('#balanceamout').val('0');
                        $('#paidamount').focus();
                        $('#paidamount').select();                
                                                
                                                
                              $(".loyalty_main_popup").css("display","none");                    
                        
                          if($('#pole_on').val()=='Y'){                          
                        var data_pole = 'set_pole=pole_display_all&pole_bill='+det[5]+"&pole_amount="+det[1]+"&display=show";
			$.ajax({
			type: "POST",
			url: "index.php",
			data: data_pole,
			success: function(data5) {
			
			}
			});
                    }                      
                                                var dataString; 
                                                    dataString = 'set=drawer_cs_open_settlepopup';
                                                    $.ajax({
                                                        type: "POST",
                                                        url: "cashdrawer_details.php",
                                                        data: dataString,
                                                        success: function(data3) {//alert("ok");
                                                            data3=data3.trim();
                                                        }
                                                    });
                                                   $('#transbal').val('');                                                                                                                                             $('#paidamount').select();
						   var selfocs=$('#curshow').val();
                                                                                                      
                                                   
                                                   var  taxnames=det[3].split('<>');
                                                   var  taxvalues=det[4].split('<>');
                                                if(taxnames!=''){
                                                for(var j=0;j<taxnames.length;j++){
                                                    $("#taxdetails_div").append('<div style="width:100%; " class="lable_counter_paymnet_cc counter_right_lable" id='+taxnames[j]+'>'+taxnames[j]+':<span >'+parseFloat(taxvalues[j]).toFixed(decimal)+'</span></div>') ;
                                                }
                                            }
                                                  $('#grand_org').val(parseFloat(det[1]).toFixed(decimal));
                                                $('#final').text(parseFloat(det[0]).toFixed(decimal));
						$('#grandtotal').text(parseFloat(det[1]).toFixed(decimal));//alert(det[3])
                                                //$('#billdetails').text(parseInt(det[5]).toFixed(decimal));
						
						$('#totaldisc').text(parseFloat(det[2]).toFixed(decimal));
                                                
                                                	
					}else
					{
						var det=data.split(",");		
						$(".counter_settle_popup").css("display","block");
						$(".counter_menu_popup_overlay").css("display","block");
						$('#paidamount').focus();$('#paidamount').select();
                                                 $('#transbal').val('');
                       
                         if($('#pole_on').val()=='Y'){                           
                       var data_pole = 'set_pole=pole_display_all&pole_bill='+det[5]+"&pole_amount="+det[1]+"&display=show";
			$.ajax({
			type: "POST",
			url: "index.php",
			data: data_pole,
			success: function(data5) {
			
			}
			});   
                    }                     
						var selfocs=$('#curshow').val();
                                                var  taxnames=det[3].split('<>');
                                                   var  taxvalues=det[4].split('<>');
                                                if(taxnames!=''){
                                                for(var j=0;j<taxnames.length;j++){
                                                    $("#taxdetails_div").append('<div style="width:100%; " class="lable_counter_paymnet_cc counter_right_lable" id='+taxnames[j]+'>'+taxnames[j]+':<span >'+parseFloat(taxvalues[j]).toFixed(decimal)+'</span></div>') ;
                                                }
                                            }
                                                 $('#grand_org').val(parseFloat(det[1]).toFixed(decimal));
                                                $('#final').text(parseFloat(det[0]).toFixed(decimal));
						$('#grandtotal').text(parseFloat(det[1]).toFixed(decimal));//alert(det[3])
                                                $('#totaldisc').text(parseFloat(det[2]).toFixed(decimal));
                                                
                                                   var dataStringbillno; 
						 dataStringbillno = 'value=bilnoreturn';
						 $.ajax({
						type: "POST",
						url: "load_counter_sales.php",
						data: dataStringbillno,
						success: function(data) {
							data=data.trim();
							$('#settleingbilno').text(data);
							}
						});
                                              
					}
						 
						var dataString; 
						dataString = 'set=drawer_cs_open_settlepopup';
						$.ajax({
                                                    type: "POST",
                                                    url: "cashdrawer_details.php",
                                                    data: dataString,
                                                    success: function(data3) {
                                                        data3=data3.trim();
                                                    }
						});	  
                                            }
					});
		}else
		  { 
                        var csname=$('#cs_name').val();
                        var csphone=$('#cs_phone').val();
                        var csgst=$('#cs_gst').val();
			
			dataString = 'value=gencounter&discount_of='+ discount_of + '&discount=' + discount + '&discount_unit='+discount_unit+ '&discountid='+discountid+"&csname="+csname+"&csphone="+csphone+"&csgst="+csgst;
			
				 $.ajax({
					type: "POST",
					url: "load_counter_sales.php",
					data: dataString,
					success: function(data) {
						 
							  dataString = 'value=ta_kotprint';
							  $.ajax({
							  type: "POST",
							  url: "print_details_kot.php",
							  data: dataString,
							  success: function(data1) {
								  
								  
							var dataString; 
							dataString = 'value=console_ta';
							  $.ajax({
							  type: "POST",
							  url: "print_details_kot.php",
							  data: dataString,
							  success: function(data1) {
							  }
							  });
								  
								  var dataString; 
								  dataString = 'value=ta_billprint&bypass=y';
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
							  });
							   $('.confrmation_overlay').css('display','none');
							window.location ='counter_sales.php'
							
						}
					});
					
		}
		
	}else
	{
		$('.ta_errormsg').css("display",'block');
			  $('.ta_errormsg').text("Nothing to generate...");
			  $('.ta_errormsg').delay(2000).fadeOut('slow');
	}
		return true;
                
                
        $('#customer_set_data5').hide();   
        $('.total_itemcount2').text('0');
        $('.tal_viewtotal').text('0');
        $('.final_show').text('0');
        $('.tax_show').text('0'); 
        $('#table_cs').val(''); 
        $('#cspax').val(''); 
        $('.listorderditems').empty();  
       
         $('#dis_pin').val('');
         $('#disountamount').val('');
         $('.countergenerate').show();
         $('.settle_direct').show();
         
   });
        
        
        
  $('.confirmkotok_cs_bill').click(function (event) {
      
            $('.kotconfirmpopup_cs_bill').hide();
            $('.confrmation_overlay').hide();
	
            $('.kotconfirmpopup_cs_bill').css('display','none');   
            $(".confrmation_overlay").css("display","none");
                    
            $('.settypeval').val($('.countergenerate').attr('setpay'));
                
            var msg=$('#kotfailmsg_cs_bill').html();
          
             var dataString_log ='set_log=kotconfirmbylogin&failmsg='+msg;
             $.ajax({
             type: "POST",
             url: "menu_order.php",
             data: dataString_log,
             success: function(data) {
             
             }
             });
             
            
                    
        var sel=$('#bscur').val();
        var cur_on=$('#curshowfocus').val();
       if(cur_on=="Y"){
           
       var datastringnew22="set5=cat5&idofcur5="+sel;
      
       $.ajax({
        type: "POST",
        url: "counter_sales.php",
        data: datastringnew22,
        success: function(data)
        {
         
        }
        
    });
           
       } 
       
       event.stopImmediatePropagation(); 
        
       var subt=$('.tal_viewtotal').text();
             if(subt){
                $('#subtotal_d1').text(subt);
                $('#subtotal_l1').text(subt);
             } 
      
        var decimal = $('#decimal').val();
        
	var itemsact = $('.eachitem_counter');	
	var itemsact1 = $('.preference_table');	
	var actlenght=(parseFloat(itemsact.length)+parseFloat(itemsact1.length) );
	if(actlenght>=1)
	{
            var staffwithdiscountcs=$('#staffwithdiscountcs').val();
            var disc=$('#counter_discount_popup').val();
	
        
      var loyalty_status=$('#loyalty_status').val();
      
	if(disc=="Y")
	{        $('.auothorize_popup').show();
                $('#dis_pin').focus();
                $(".discount_click").click();
                $('#disountamount').focus();
		$('.disountenterpopup').css('display','block');
		$('.confrmation_overlay').css('display','block');
	}else  if(loyalty_status=="Y"){
            
         $('.loyalty_main_popup').css('display','block'); 
         
         if(disc!="Y" ){
             $(".confrmation_overlay").css("display","block");
        
             $(".loyalty_click").click();
         }
          
        }else
	{
		var settle=$('#counter_bill_before_settle').val();
		var discount_unit='';
		var discount_of='';
		var discountid='none';
		var discount='';
		var dataString;
		var typvl=$('.settypeval').val();
                
                var csname=$('#cs_name').val();
                var csphone=$('#cs_phone').val();
                var csgst=$('#cs_gst').val();
                var tablenocs=$('#table_cs').val();
                var pax=$('#cspax').val();
               
		if(typvl=="Y")
		{ 
			dataString = 'value=gensettle_first&discount_of='+ discount_of + '&discount=' + discount + '&discount_unit='+discount_unit+ '&discountid='+discountid+"&csname="+csname+"&csphone="+csphone+"&csgst="+csgst+"&table_cs="+tablenocs+"&pax="+pax;//alert(dataString);
			$.ajax({
					type: "POST",
					url: "load_counter_sales.php",
					data: dataString,
					success: function(data) {
						data=$.trim(data);
						
					if(settle=="Y")
					{
						var dataString; 
								  dataString = 'value=ta_billprint&bypass=y';
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
							var det=data.split(",");
                                                        
                                                  var dataStringbillno; 
						 dataStringbillno = 'value=bilnoreturn';
						 $.ajax({
						type: "POST",
						url: "load_counter_sales.php",
						data: dataStringbillno,
						success: function(data) {
							data=data.trim();
							$('#settleingbilno').text(data);
							}
						});
                                                
						$(".counter_settle_popup").css("display","block");
						$(".counter_menu_popup_overlay").css("display","block");
                                                $('#focusedtext').val('paidamount');
                                                $('#cash').click();
						
                                                   $('#transbal').val('');                                                                                                                                             $('#paidamount').select();
						   var selfocs=$('#curshow').val();
                     
						var  taxnames=det[3].split('<>');
                                                var  taxvalues=det[4].split('<>');
                                                
                                                if(taxnames!=''){
                                                for(var j=0;j<taxnames.length;j++){
                                                    $("#taxdetails_div").append('<div style="width:100%; " class="lable_counter_paymnet_cc counter_right_lable" id='+taxnames[j]+'>'+taxnames[j]+':<span >'+parseFloat(taxvalues[j]).toFixed(decimal)+'</span></div>') ;
                                                }
                                            }
                                                
                                                $('#final').text(parseFloat(det[0]).toFixed(decimal));
						$('#grandtotal').text(parseFloat(det[1]).toFixed(decimal));
                                               
						$('#totaldisc').text(parseFloat(det[2]).toFixed(decimal));
                                                
                                                	
					}
                                        
                                        else
					{
						var det=data.split(",");		
						$(".counter_settle_popup").css("display","block");
						$(".counter_menu_popup_overlay").css("display","block");
						
                                                $('#focusedtext').val('paidamount');
                                                $('#cash').click();
                                                 $('#transbal').val(''); 
						   var selfocs=$('#curshow').val();
                     
						var  taxnames=det[3].split('<>');
                                                   var  taxvalues=det[4].split('<>');
                                                if(taxnames!=''){
                                                for(var j=0;j<taxnames.length;j++){
                                                    $("#taxdetails_div").append('<div style="width:100%; " class="lable_counter_paymnet_cc counter_right_lable" id='+taxnames[j]+'>'+taxnames[j]+':<span >'+parseFloat(taxvalues[j]).toFixed(decimal)+'</span></div>') ;
                                                }
                                            }
                                                
                                                $('#final').text(parseFloat(det[0]).toFixed(decimal));
						$('#grandtotal').text(parseFloat(det[1]).toFixed(decimal));
                                               
						$('#totaldisc').text(parseFloat(det[2]).toFixed(decimal));
                                                 var dataStringbillno; 
						 dataStringbillno = 'value=bilnoreturn';
						 $.ajax({
						type: "POST",
						url: "load_counter_sales.php",
						data: dataStringbillno,
						success: function(data) {
							data=data.trim();
							$('#settleingbilno').text(data);
							}
						});
                                                
                                                
                                                
		
		
					}
							 
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
							 
							
						}
					});
		}else
		{ 
                    
		var csname=$('#cs_name').val();
                var csphone=$('#cs_phone').val();
                var csgst=$('#cs_gst').val();
			
			dataString = 'value=gencounter&discount_of='+ discount_of + '&discount=' + discount + '&discount_unit='+discount_unit+ '&discountid='+discountid+"&csname="+csname+"&csphone="+csphone+"&csgst="+csgst;
			
				 $.ajax({
					type: "POST",
					url: "load_counter_sales.php",
					data: dataString,
					success: function(data) {
						 
						
							  dataString = 'value=ta_kotprint';
							  $.ajax({
							  type: "POST",
							  url: "print_details_kot.php",
							  data: dataString,
							  success: function(data1) {
								  
								  
							var dataString; 
							dataString = 'value=console_ta';
							   $.ajax({
							  type: "POST",
							  url: "print_details_kot.php",
							  data: dataString,
							  success: function(data1) {
							  }
							  });
								  
								  var dataString; 
								  dataString = 'value=ta_billprint&bypass=y';
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
							  });
							   $('.confrmation_overlay').css('display','none');
							window.location ='counter_sales.php'
							
						}
					});
					
		}
		
		
	}
	}else
	{
		$('.ta_errormsg').css("display",'block');
			  $('.ta_errormsg').text("Nothing to generate...");
			  $('.ta_errormsg').delay(2000).fadeOut('slow');
	}
		return true;
            
        });
        
        
        
  $('.confirmkotclose_cs_bill').click(function () {
      
                $('.kotconfirmpopup_cs_bill').css('display','none');   
                $(".confrmation_overlay").css("display","none");
                $('.gensettl').css('display','block');
  });
        
        
  
        
        
 $('.countergenerate').click(function (event) { 
        
         localStorage.coming_from='direct_flow';
         event.stopImmediatePropagation(); 
         
            var typvl_ch=$(this).attr('setpay');  
         
         
         $('.settypeval').val($(this).attr('setpay'));
         var cs_kotandbill_print = "cs_kotandbill_print";
              
                $.post("printercheck_1.php", {type:cs_kotandbill_print},

                function(data)
                { 
                data=$.trim(data); 
                
                if(data!=0){
                    
                  
                   $('.kotconfirmpopup_cs_bill').css('display','block');   
                   $(".confrmation_overlay").css("display","block");
                   var data1="Countersale -"+data;
                   $('#kotfailmsg_cs_bill').html(data1);
                    
                  }else  {
                      
              var subt=$('.tal_viewtotal').text();
             if(subt){
             $('#subtotal_d1').text(subt);
              $('#subtotal_l1').text(subt);
             } 
           
       var sel=$('#bscur').val();
       var cur_on=$('#curshowfocus').val();
       if(cur_on=="Y"){
       var datastringnew22="set5=cat5&idofcur5="+sel;
      
       $.ajax({
        type: "POST",
        url: "counter_sales.php",
        data: datastringnew22,
        success: function(data)
        {
           
     $("#divall").load(location.href + " #divall");
   
        
        }
        
    });
           
       }       
       
        var decimal = $('#decimal').val();
    
	var itemsact = $('.eachitem_counter');
        var itemsact1 = $('.preference_table');	
	var actlenght=(parseFloat(itemsact.length)+parseFloat(itemsact1.length) );
	if(actlenght>=1)
	{       
            $('.countergenerate').hide();
            $('.settle_direct').css("display","none");
            var staffwithdiscountcs=$('#staffwithdiscountcs').val();
            var disc=$('#counter_discount_popup').val();
      
        var loyalty_status=$('#loyalty_status').val();
        
        if(typvl_ch=='N'){
            disc='N';
            loyalty_status='N';
        }
        
        
        if(disc=="Y")
       {  
           
                $('.auothorize_popup').show();
                $('#dis_pin').focus();
                $(".discount_click").click();
                $('#disountamount').focus();
		$('.disountenterpopup').css('display','block');
		$('.confrmation_overlay').css('display','block');
                
	}else  if(loyalty_status=="Y"){
            
         $('.loyalty_main_popup').css('display','block'); 
         if(disc!="Y" ){
         $(".confrmation_overlay").css("display","block");
        
             $(".loyalty_click").click();
         }
          
        }else
	{
		var settle=$('#counter_bill_before_settle').val();
		var discount_unit='';
		var discount_of='';
		var discountid='none';
		var discount='';
		var dataString;
		var typvl=$('.settypeval').val();
                
                var csname=$('#cs_name').val();
                var csphone=$('#cs_phone').val();
                var csgst=$('#cs_gst').val();
                var tablenocs=$('#table_cs').val();
                var pax=$('#cspax').val();
              
            
		  if(typvl=="Y")
		   {  
			dataString = 'value=gensettle_first&discount_of='+ discount_of + '&discount=' + discount + '&discount_unit='+discount_unit+ '&discountid='+discountid+"&csname="+csname+"&csphone="+csphone+"&csgst="+csgst+"&table_cs="+tablenocs+"&pax="+pax;
				
                                $.ajax({
					type: "POST",
					url: "load_counter_sales.php",
					data: dataString,
					success: function(data) {
						data=$.trim(data); 
                                               
                                               var det_bil=data.split(",");
                                                        
                                                        
                                              var kot_before_settle=$('#kot_before_settle').val();
                                              
                                             
                                                        
                                        if(kot_before_settle=='Y'){
                                                           
                                        var dataString;
                                        dataString = 'value=cs_kotprint_first&bill_cs='+det_bil[5];
                                       
                                         $.ajax({
                                        type: "POST",
                                        url: "print_details_kot.php",
                                        data: dataString,
                                        success: function(data1) {
                                            
                                            
                                         }
                                    });
                                                 var dataString; 
                                                dataString = 'value=cs_console_kotprint_first&bill_cs='+det_bil[5];
                                         $.ajax({
                                        type: "POST",
                                        url: "print_details_kot.php",
                                        data: dataString,
                                        success: function(data2) {
                                        }
                                        });
                                      
                                         }    
                                                
                                                
					if(settle=="Y")
					{
						var dataString; 
								  dataString = 'value=ta_billprint&bypass=y';
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
							var det=data.split(",");
                                                        
                                                  var dataStringbillno; 
						 dataStringbillno = 'value=bilnoreturn';
						 $.ajax({
						type: "POST",
						url: "load_counter_sales.php",
						data: dataStringbillno,
						success: function(data) {
							data=data.trim();
							$('#settleingbilno').text(data);
							}
						});
                                                
						$(".counter_settle_popup").css("display","block");
						$(".counter_menu_popup_overlay").css("display","block");
						$('#focusedtext').val('paidamount');
						$('#paidamount').focus();
                                                $('#paidamount').select(); 
                                                
                                                
                                           
                         if($('#pole_on').val()=='Y'){                           
                        var data_pole = 'set_pole=pole_display_all&pole_bill='+det[5]+"&pole_amount="+det[1]+"&display=show";
			$.ajax({
			type: "POST",
			url: "index.php",
			data: data_pole,
			success: function(data5) {
			
			}
			});
                    }                      
                                                
                                                var dataString; 
                                                    dataString = 'set=drawer_cs_open_settlepopup';
                                                    $.ajax({
                                                        type: "POST",
                                                        url: "cashdrawer_details.php",
                                                        data: dataString,
                                                        success: function(data3) {//alert("ok");
                                                            data3=data3.trim();
                                                        }
                                                    });
                                                   $('#transbal').val('');                                                                                                                                             $('#paidamount').select();
						   var selfocs=$('#curshow').val();
                                                                                                      
                                                   
                                                   var  taxnames=det[3].split('<>');
                                                   var  taxvalues=det[4].split('<>');
                                                if(taxnames!=''){
                                                for(var j=0;j<taxnames.length;j++){
                                                    $("#taxdetails_div").append('<div style="width:100%; " class="lable_counter_paymnet_cc counter_right_lable" id='+taxnames[j]+'>'+taxnames[j]+':<span >'+parseFloat(taxvalues[j]).toFixed(decimal)+'</span></div>') ;
                                                }
                                            }
                                                  $('#grand_org').val(parseFloat(det[1]).toFixed(decimal));
                                                $('#final').text(parseFloat(det[0]).toFixed(decimal));
						$('#grandtotal').text(parseFloat(det[1]).toFixed(decimal));
                                                
						$('#totaldisc').text(parseFloat(det[2]).toFixed(decimal));
                                                $('#tip_amount').val(det[6]);
                                                	
					}else
					{
						var det=data.split(",");		
						$(".counter_settle_popup").css("display","block");
						$(".counter_menu_popup_overlay").css("display","block");
						$('#paidamount').focus();$('#paidamount').select();
                                                 $('#transbal').val('');
                       
                         if($('#pole_on').val()=='Y'){                           
                       var data_pole = 'set_pole=pole_display_all&pole_bill='+det[5]+"&pole_amount="+det[1]+"&display=show";
			$.ajax({
			type: "POST",
			url: "index.php",
			data: data_pole,
			success: function(data5) {
			
			}
			});   
                    }                      
                                                 
                                                 
                                                 
                                                 
						var selfocs=$('#curshow').val();
                                                var  taxnames=det[3].split('<>');
                                                   var  taxvalues=det[4].split('<>');
                                                if(taxnames!=''){
                                                for(var j=0;j<taxnames.length;j++){
                                                    $("#taxdetails_div").append('<div style="width:100%; " class="lable_counter_paymnet_cc counter_right_lable" id='+taxnames[j]+'>'+taxnames[j]+':<span >'+parseFloat(taxvalues[j]).toFixed(decimal)+'</span></div>') ;
                                                }
                                            }
                                                 $('#grand_org').val(parseFloat(det[1]).toFixed(decimal));
                                                $('#final').text(parseFloat(det[0]).toFixed(decimal));
						$('#grandtotal').text(parseFloat(det[1]).toFixed(decimal));//alert(det[3])
                                                $('#totaldisc').text(parseFloat(det[2]).toFixed(decimal));
                                                $('#tip_amount').val(det[6]);
                                                   var dataStringbillno; 
						 dataStringbillno = 'value=bilnoreturn';
						 $.ajax({
						type: "POST",
						url: "load_counter_sales.php",
						data: dataStringbillno,
						success: function(data) {
							data=data.trim();
							$('#settleingbilno').text(data);
							}
						});
                                              
					}
						 
						var dataString; 
						dataString = 'set=drawer_cs_open_settlepopup';
						$.ajax({
                                                    type: "POST",
                                                    url: "cashdrawer_details.php",
                                                    data: dataString,
                                                    success: function(data3) {
                                                        data3=data3.trim();
                                                    }
						});	  
                                            }
					});
		}else
		  { 
                      
		var csname=$('#cs_name').val();
                var csphone=$('#cs_phone').val();
                var csgst=$('#cs_gst').val();
			
			dataString = 'value=gencounter&discount_of='+ discount_of + '&discount=' + discount + '&discount_unit='+discount_unit+ '&discountid='+discountid+"&csname="+csname+"&csphone="+csphone+"&csgst="+csgst;
					
				 $.ajax({
					type: "POST",
					url: "load_counter_sales.php",
					data: dataString,
					success: function(data) {
						
							  dataString = 'value=ta_kotprint';
							   $.ajax({
							  type: "POST",
							  url: "print_details_kot.php",
							  data: dataString,
							  success: function(data1) {
								  
								  
								   var dataString; 
								  dataString = 'value=console_ta';
							   $.ajax({
							  type: "POST",
							  url: "print_details_kot.php",
							  data: dataString,
							  success: function(data1) {
							  }
							  });
								  
								  var dataString; 
								  dataString = 'value=ta_billprint&bypass=y';
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
							  });
							   $('.confrmation_overlay').css('display','none');
							window.location ='counter_sales.php'
							
						}
					});
					
		}
			
	}
        
           
         
         
	}else
	{
		          $('.ta_errormsg').css("display",'block');
			  $('.ta_errormsg').text("CART IS EMPTY");
			  $('.ta_errormsg').delay(2000).fadeOut('slow');
	}
		return true;
            }
        });
        
	});	
        
        
        
    $('.settle_direct').click(function (event) { 
        
         event.stopImmediatePropagation(); 
         
        if( $('.cancel_reorder').css('display') == 'block') {
            
            var reg='Y';
        }else{
            var reg='N';
            
        }
        
	var dataString = 'set=check_reorder_item&mode=cs&reg='+reg;
    
	$.ajax({
	type: "POST",
	url: "load_index.php",
	data: dataString,
	success: function(data2) { 
	data2=data2.trim(); 
        
        var logid=$('#logid').val();  
        
        
	if(data2=="ok" || logid=='admin')
	{
        
         localStorage.coming_from='direct_flow';
         
         var typvl_ch=$(this).attr('setpay');  
         
         $('.settypeval').val($(this).attr('setpay'));
         
                var cs_kotandbill_print = "cs_kotandbill_print";
              
              var kot_before_settle=$('#kot_before_settle').val();
              
              
                $.post("printercheck_1.php", {type:cs_kotandbill_print},

                function(data)
                { 
                    
                data=$.trim(data); 
                
                if(data!=0 && kot_before_settle=='Y'){
                   
                   $('.kotconfirmpopup_cs_bill').css('display','block');   
                   $(".confrmation_overlay").css("display","block");
                   var data1="Countersale : "+data;
                   $('#kotfailmsg_cs_bill').html(data1);
                    
             }else{
                      
             var subt=$('.tal_viewtotal').text();
             
             if(subt){
                 
               $('#subtotal_d1').text(subt);
               $('#subtotal_l1').text(subt);
             } 
           
       var sel=$('#bscur').val();
       var cur_on=$('#curshowfocus').val();
       
       if(cur_on=="Y"){
           
       var datastringnew22="set5=cat5&idofcur5="+sel;
      
       $.ajax({
        type: "POST",
        url: "counter_sales.php",
        data: datastringnew22,
        success: function(data)
        {
           
          $("#divall").load(location.href + " #divall");
   
        }
        
        });
           
       }       
       
	var itemsact = $('.eachitem_counter');
        var itemsact1 = $('.preference_table');	
	var actlenght=(parseFloat(itemsact.length)+parseFloat(itemsact1.length) );
	if(actlenght>=1)
	{   
            
            $('.countergenerate').hide();
            $('.settle_direct').css("display","none");
            $(".closedisount").click();
              
	}else
	{
		$('.ta_errormsg').css("display",'block');
		$('.ta_errormsg').text("CART IS EMPTY");
		$('.ta_errormsg').delay(2000).fadeOut('slow');
	}
		return true;
        }
        });
        
        
        
            }else{
               
                  alert('NO NEW ITEMS IN CART . PLEASE EXIT REORDER');
                
                
            }
         }
        
        });
        
        
        
  });	    
        
     
/******************  counter submit  ends *************  */


 $(".closepaypop").click(function(){
     
      $('.counter_sl_payment_hist_pop').hide();
      $('.counter_menu_popup_overlay').hide();
     
       window.location.href = "counter_sales.php";
   
   });

  
    $(".no_print_in").click(function(){
        
      $('.submittranscations').addClass('disablegenerate');
      
      if($('.total_itemcount2').text() > 0 ){
     
      var  dataString1 = 'set=set_print_option&print_option=N' ;
                      
		$.ajax({
		type: "POST",
		url: "load_index.php",
		data: dataString1,
		success: function(data) {
                    
                 
                    $('.closedisount').click();
                    $('.closedisount').off('click');
                     
                 }
                });
                
            }else{
                
       $('.alert_error_popup_all_in_one').show();
                       
       $('.alert_error_popup_all_in_one').text('CART IS EMPTY');
       $('.alert_error_popup_all_in_one').delay(2000).fadeOut('slow'); 
            } 
               
       setTimeout(function(){                                         
           $('.submittranscations').removeClass('disablegenerate');    
       }, 2000); 
            
   
     }); 
   
   
    
  ////cs bill closedisount real////  
    
 $('.closedisount').click(function (event) {
     
     
        var crd_view= $('#credit_view_per').val();
        var comp_view= $('#comp_view_per').val();
        
        if(crd_view=="N"){
            $('#credit_person').hide();
        }
        
        if(comp_view=="N"){
            $('#complimentary').hide();
        }
    
        event.stopImmediatePropagation();
        
	var settype=$('.settypeval').val();
        var decimal= $('#decimal').val();
        
         if($('#ly_number').val()!=""){
                                             
            var loyalty_id=$('#ly_id').val();
            var loyalty_billamount=$('#tot_org').val();
            var loyalty_billamount1=$('.tal_viewtotal').text();
            var lp_add=$('#point_rule_add').val();
            var lp_amt=$('#point_rule_add').attr('amt_add');
            var tot_point= (loyalty_billamount1/lp_amt)*lp_add;
            var loyalty_pointredeem=$('#redeem_point_total').text();
            var loyalty_redeemamount=$('#redeem_amount_total').text();
            var loy_number=$('#ly_number').val();
            var loy_name=$('#ly_name').val();
                    
         }else{
           loyalty_pointredeem=0;
           tot_point=0;
           loyalty_redeemamount=0;
           loyalty_billamount=0;
         }
        
		var homed;
		homed="CS";  
		
		var discount_unit;
                var discount_of;
		
                if(!$('#disountamount').is(':visible'))
                {
                   discount_unit='';
                   discount_of='';
                   
                }else{
		 discount_unit=$("input[name='typesel']:checked").val();
                  discount_of=$("#disountamount").val();
                }
              
		var discountid=$("#disountamount_drop").val();
		
		var staffwithdiscountmanual=$("#staffwithdiscountmanual").val();
		
                if(discountid=='none' && discount_of=='')
		{
			var discount='N';
                        discount_unit='';
                        discount_of='';
		}
		else
		{
                    var discount='Y';
                    if(discountid!='none')
                        {
                            discount_of='';
                        }
                        
                        if(discountid=='none')
                        {
                            discount_unit=discount_unit;
                        }
		}
		
                $(".loyalty_main_popup").css("display","none"); 

                if((discount_unit=="P" && discount_of<100) || (discount_unit=="V" && discount_of<parseFloat($('.tal_viewtotal').text().replace(',',''))) || discount_unit=='')
		 {
                     
		if(discount_of>=0)
		 {
                     
		 $('.disountenterpopup').css('display','none');
               
               
	        if(settype=="N")
	        {
                           
                var csname=$('#cs_name').val();
                var csphone=$('#cs_phone').val();
                var csgst=$('#cs_gst').val(); 
                            
			var dataString;
			dataString = 'value=gencounter&discount_of='+ discount_of + '&discount=' + discount + '&discount_unit='+discount_unit+
                                '&discountid='+discountid+"&csname="+csname+"&csphone="+csphone+"&csgst="+csgst;
			
				       $.ajax({
					type: "POST",
					url: "load_counter_sales.php",
					data: dataString,
					success: function(data) {
						           
                                        var dataString;
                                        dataString = 'value=ta_kotprint';
                                         $.ajax({
                                        type: "POST",
                                        url: "print_details_kot.php",
                                        data: dataString,
                                        success: function(data1) {
                                            
                                         var dataString; 
                                         dataString = 'value=console_ta';
                                         $.ajax({
                                        type: "POST",
                                        url: "print_details_kot.php",
                                        data: dataString,
                                        success: function(data2) {
                                        }
                                        });
								  
                                        var dataString; 
                                        dataString = 'value=ta_billprint&bypass=y';
                                        $.ajax({
                                        type: "POST",
                                        url: "print_details_kot.php",
                                        data: dataString,
                                        success: function(data2) {
                                        
                                         }
                                        });	

                                        }
					});
		$('.confrmation_overlay').css('display','none');
                window.location ='counter_sales.php'
							  
		}
		});
                                         
		}else{
                                           
                        var csname=$('#cs_name').val();
                        var csphone=$('#cs_phone').val();
                        var csgst=$('#cs_gst').val();
                        var tablenocs=$('#table_cs').val();
                        var pax=$('#cspax').val();
                           
                        $('.alert_error_popup_all_in_one').show();
                        $('.alert_error_popup_all_in_one').text('BILLING');
                                
                        dataString = 'value=gensettle_first&discount_of='+ discount_of + '&discount=' + discount + '&discount_unit='+discount_unit+
                        '&discountid='+discountid+"&csname="+csname+"&csphone="+csphone+"&csgst="+csgst+"&table_cs="+tablenocs+"&pax="+pax+
                        "&id_loy="+loyalty_id+"&point_add="+tot_point+"&point_redeem="+loyalty_pointredeem+"&billamount="+loyalty_billamount+
                        "&redeemamount="+loyalty_redeemamount+"&new_bill_amt="+loyalty_billamount1+"&loy_number="+loy_number+
                        "&loy_name="+loy_name;
                       
                                        $.ajax({
					type: "POST",
					url: "load_counter_sales.php",
					data: dataString,
					success: function(data) { 
                                            
                        $('.alert_error_popup_all_in_one').delay(3000).fadeOut('slow'); 
                        $('.alert_error_popup_all_in_one').hide();   
                                        
			data=$.trim(data);
                        var det=data.split(",");
                                         
                       
                        if(det[5]=='undefined' || det[5]==undefined || det[5]=='NaN' || det[5]=='' || det[5]=='NULL'){
                               
                          $('.alert_error_popup_all_in_one').show();
                          $('.alert_error_popup_all_in_one').css('height','110px');
                          $('.alert_error_popup_all_in_one').text('');
                          
                          $(".alert_error_popup_all_in_one").append("<div style='font-size:8px'>COUNTER RUSH REORDERING AUTOMATED</div> "+
                          "<br> <a style='position: absolute;top: 83px;right:83px;color:white;border:solid 1px;padding:2px;font-size:9px' "+
                          " href='counter_sales.php'>CANCEL ORDER</a>  "); 
                         
                        var ord=$('#ordrid').val();   
                         
                        var dataString = 'set=temp_move&ord='+ord+"&mode=CS";
			var request=  $.ajax({
			type: "POST",
			url: "load_index.php",
			data: dataString,
			success: function(data){
                            
                      setTimeout(function (){
                        
                       $('.alert_error_popup_all_in_one').show();
                      
                       window.location.href = "dont_delete.php?set_reorder=go";
                          
                      }, 2000); 
                                             
                        
                      } 
                      });
                     
                    
                   }else{              
                       
                       
                                        var dataString88;
                                        dataString88 = 'set=reconfigure_bill_missvalue&bill='+det[5];
                                        $.ajax({
                                        type: "POST",
                                        url: "load_index.php",
                                        data: dataString88,
                                        success: function(data1) {
                                             
                                         }
                                        });
                                          
                                        $(".counter_settle_popup").css("display","block");
					$(".counter_menu_popup_overlay").css("display","block");
                                        $("#cash").click();
                                        $('.listorderditems').empty();    
                                        $('#settleingbilno').text(det[5]);        
                                              
                                        $(".counter_settle_popup").css("display","block");
					$(".counter_menu_popup_overlay").css("display","block");
                                        
                                        $("#cash").click();
                                        $('.listorderditems').empty();    
                                        $('#settleingbilno').text(det[5]);   
                                          
                                       if(det[7]>0){
                                                $('#dis_item_new').text(det[7]);     
                                        }else{
                                                var tt_new=0;
                                                $('#dis_item_new').text(tt_new.toFixed(decimal));  
                                       }
                                      
                                               if( $('#num_loaded').text()!=''){
                                                     $('#num_sms_new').val($('#num_loaded').text());
                                                     $('#name_sms_new').val($('#name_loaded').text());
                                                     $('#num_sms_new').prop('disabled',true);
                                                     $('#name_sms_new').prop('disabled',true);
                                                } 
                                                
                                                         
                                          
                                              
				var settle=$('#counter_bill_before_settle').val();
                                 
				if(settle=="Y")
				 {
                                    
                                             
//                                                                  var dataString; 
//								  dataString = 'value=ta_billprint&bypass=y&bilno='+det[5];
//								  $.ajax({
//								  type: "POST",
//								  url: "../../test_for_print/print_details_kot.php",
//								  data: dataString,
//								  success: function(data2) { 
//									  
//									  
//									  }
//								  });             
                                                
						                 var dataString; 
								  dataString = 'value=ta_billprint&bypass=y&bilno='+det[5];
								  $.ajax({
								  type: "POST",
								  url: "print_details_kot.php",
								  data: dataString,
								  success: function(data2) { 
									  
									  
									  }
								  });
                                                              
                                                                  
            
                                                             
				   var det=data.split(",");
                                                       
                                    var on=$('#curshowfocus').val();
                                   if(on=="Y"){
                                       $('#currencyinput').focus();  
                                   }else{
                                       $('#paidamount').focus();
                                       $('#paidamount').select();
                                       $('#focusedtext').val('paidamount');
                                   }
                                   

                                                $('#paidamount').val(parseFloat(det[1]).toFixed(decimal).replace(",",''));
                                                $('#balanceamout').val('0.000');
                                                $('#paidamount').select() ; 
                                
                                                $("cations").removeClass("disable");
						var selfocs=$('#curshow').val();
                                                $('#grand_org').val(parseFloat(det[1]).toFixed(decimal));
						$('#final').text(parseFloat(det[0]).toFixed(decimal));
						$('#grandtotal').text(parseFloat(det[1]).toFixed(decimal));
						if(det[4]=="")
						{det[4]="0.00";
						}
						$('#totaldisc').text(parseFloat(det[2]).toFixed(decimal));
                                                
                                                var dataString; 
						dataString = 'value=bilnoreturn';
						 $.ajax({
						type: "POST",
						url: "load_counter_sales.php",
						data: dataString,
						success: function(data2) {
							data2=data2.trim();
							$('#settleingbilno').text(data2);
							}
						});
						  
                                                
                                                
                                            if(parseFloat(det[2])>0){
                                                
                                                    var  dataString77 = 'set=discount_bill_format&billno='+det[5]+"&mode=CS";
                                                    $.ajax({
                                                        type: "POST",
                                                        url: "load_index.php",
                                                        data: dataString77,
                                                        success: function(data3) {
                                                     
                                                var dis_ld= data3.trim().split(","); 


                                                if(dis_ld[2]!=''){
                                                    
                                                       $('#dis_details_new').text(dis_ld[0]+' '+dis_ld[2]+' : '+dis_ld[1]);
                                                 }else{
                                                     
                                                       $('#dis_details_new').text('')  ;
                                                 }
                                                        
                                                 }
                                                 
                                                });
                                                
                                            }else{
                                                
                                                 $('#dis_details_new').text('')  ;
                                            }
                                                
                                                $('#tip_amount').val(det[6]);
                                                var taxnames=det[3].split('<>');
                                                var taxvalues=det[4].split('<>');
                                                if(taxnames!=''){
                                                for(var j=0;j<taxnames.length;j++){
                                                    $("#taxdetails_div").append('<div style="width:100%; " class="lable_counter_paymnet_cc counter_right_lable" id='+taxnames[j]+'>'+taxnames[j]+':<span >'+parseFloat(taxvalues[j]).toFixed(decimal)+'</span></div>') ;
                                                }
                                                }
                                                
						
                                             
					}else
					{
						var det=data.split(",");		
						$(".counter_settle_popup").css("display","block");
						$(".counter_menu_popup_overlay").css("display","block");
						
                                     
                                                var on=$('#curshowfocus').val();
                                                if(on=="Y"){
                                                    $('#currencyinput').focus();  
                                                }else{
                                                    $('#paidamount').focus();
                                                    $('#paidamount').select();
                                                    $('#focusedtext').val('paidamount');
                                                }
                                
                                                var dataString; 
						dataString = 'value=bilnoreturn';
						$.ajax({
						type: "POST",
						url: "load_counter_sales.php",
						data: dataString,
						success: function(data2) {
                                                    
							data2=data2.trim();
							$('#settleingbilno').text(data2);
                                                        
							}
						});
                                
                                
                                                $('#paidamount').val(parseFloat(det[1]).toFixed(decimal).replace(",",''));
                                                $('#balanceamout').val('0.000');
                                                $('#paidamount').select() ; 
                                
						var selfocs=$('#curshow').val();
                                                $('#grand_org').val(parseFloat(det[1]).toFixed(decimal));
						$('#final').text(parseFloat(det[0]).toFixed(decimal));
						$('#grandtotal').text(parseFloat(det[1]).toFixed(decimal));
                                                
						if(det[4]=="")
						{
                                                    det[4]="0.00";
						}
                                                
						$('#totaldisc').text(parseFloat(det[2]).toFixed(decimal));
                                                
                                                
                                                 if(det[9]!='' && det[9]!=undefined){
                                                     
                                                  $('#dis_details_new').text(det[7]+' ['+det[9]+' : '+det[8]+']');
                                                }else{
                                                    
                                                  $('#dis_details_new').text('')  ;
                                                }
                                                
                                                
                                                
                                                var taxnames=det[3].split('<>');
                                                var taxvalues=det[4].split('<>');
                                                if(taxnames!=''){
                                                    
                                                for(var j=0;j<taxnames.length;j++){
                                                    
                                                    $("#taxdetails_div").append('<div style="width:100%; " class="lable_counter_paymnet_cc counter_right_lable" id='+taxnames[j]+'>'+taxnames[j]+':<span >'+parseFloat(taxvalues[j]).toFixed(decimal)+'</span></div>') ;
                                                }
                                                }
						
		
					    }
					
                                        
                                        
                                         var kot_before_settle=$('#kot_before_settle').val();
                                                 
                                         if(kot_before_settle=='Y'){ 
                                             
//                                             var dataString;
//                                        dataString = 'value=cs_kotprint_first&bill_cs='+det[5];
//                                        $.ajax({
//                                        type: "POST",
//                                        url: "../../test_for_print/print_details_kot.php",
//                                        data: dataString,
//                                        success: function(data1) {
//                                            
//                                         }
//                                        });
//                                        
//                                         var dataString; 
//                                         dataString = 'value=cs_console_kotprint_first&bill_cs='+det[5];
//                                         $.ajax({
//                                        type: "POST",
//                                        url: "../../test_for_print/print_details_kot.php",
//                                        data: dataString,
//                                        success: function(data2) {
//                                            
//                                            
//                                        }
//                                        });
                                             
                                                           
                                        var dataString;
                                        dataString = 'value=cs_kotprint_first&bill_cs='+det[5];
                                        $.ajax({
                                        type: "POST",
                                        url: "print_details_kot.php",
                                        data: dataString,
                                        success: function(data1) {
                                            
                                         }
                                        });
                                        
                                         var dataString; 
                                         dataString = 'value=cs_console_kotprint_first&bill_cs='+det[5];
                                         $.ajax({
                                        type: "POST",
                                        url: "print_details_kot.php",
                                        data: dataString,
                                        success: function(data2) {
                                            
                                            
                                        }
                                        });
                                               
                                       
                                       } 
                                        
                                        
                                        
                                                    ////cashdrawer open////
                                                    var dataString; 
                                                    dataString = 'set=drawer_cs_open_settlepopup';
                                                    $.ajax({
                                                        type: "POST",
                                                        url: "cashdrawer_details.php",
                                                        data: dataString,
                                                        success: function(data3) {
                                                            data3=data3.trim();
                                                        }
                                                    }); 
                                            

                                                } 
                                            
			  }
			});
                        
					
		   }
                   }else{
		           $("#disountamount").css("border","1px solid #F00");
		    }
		   }else
		   {       alert("Invalid Discount ");
			   $("#disountamount").css("border","1px solid #F00");
		   }
                   
            $('.total_itemcount2').text('0');
            $('.tal_viewtotal').text('0');
            $('.final_show').text('0');
            $('.tax_show').text('0'); 
            $('#table_cs').val(''); 
            $('#dis_pin').val('');
            $('#disountamount').val('');
            $('#cspax').val(''); 
            
            
          setTimeout(function () {
              
           $('.countergenerate').css("display","block");
           $('.settle_direct').css("display","block");
           
         }, 2000); 
         
     		                      
});
	



 $('#dis_auth_proceed_without_discount').click(function (event) {
     
            event.stopImmediatePropagation();
            $('.closedisount').click(); 
            $('.auothorize_popup').hide();
            $('.loyalty_main_popup').hide();
  });  
  
    
$('.canceldisount').click(function (e) {

      location.reload();
 });
	
	/****************  voucher starts ************************  */
        
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
                
	/***********  voucher ends ********************  */
	
	
        
	/*************  credit types starts *******************  */
        
$('#selectcreditypes').change(function () {
    
		var credittype=	$(this).val();
                      
                    
                         
                         
			 $('.credtitypeloads').html('<img src="img/ajax-loaders/ajax-loader-6.gif" />');
			 var labelname=$("#selectcreditypes").find('option:selected').attr('label');
			 
			  $.post("load_counter_sales.php", {credittype:credittype,value:'loadcreditypes'},
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
				  
                                  
                 if(credittype=='4') {
                    
                     $('.crd_cls').css('margin-left','0px')
                 }else{
                     
                      $('.crd_cls').css('margin-left','0px')
                 }       
                     
                                  
                                  $("#selectcreditdetailsname").focus();
				    
                                    
                                    
                                    
                                    
				  });
                          
                                  
                                  
	});
			  
	/***************************************  credit types ends **********************************************************  */


$('.confirmkotclose_cs_submit').click(function () {
    
     $('.kotconfirmpopup_cs_submit').css('display','none');   
     $(".confrmation_overlay").css("display","none");
     window.location.href = "counter_sales.php?setcscommon=settlecspopup"; 
     
});

 $('.confirmkotok_cs_submit').click(function (event) {
    
        $('.kotconfirmpopup_cs_submit').css('display','none');   
        $(".confrmation_overlay").css("display","none");
                  
         event.stopImmediatePropagation();
                    
        var settlebill1=$('#settlebill').val();
        var tip_amount=0;
        var tip_mode='C';
        
        if($('#tip_amount').val()!='' && $('#tip_amount').val()>0){
            tip_amount=$('#tip_amount').val();
            tip_mode=$('#tip_pay_mode').val();
        }
        
	var tamode='';
	if($(".takechk").is(':checked'))
            tamode='TA' 
            else
            tamode='CS'
	
		var payemntmode_sel =$('.mode_sel_btn_act').attr('id');
	
		if(payemntmode_sel!='')
		{
		 if(payemntmode_sel=='credit_person'){
                   var pd= $('#paidamount_credit').val();
                }
                else if(payemntmode_sel=='coupon'){
                      if(parseFloat($('#grandtotal').text())!=parseFloat($('#coupamount').val())){
                      var pd=$('#balanceamout').val();
                      entremt="Insufficient Amount";
                        }
                        else{
                            pd=$('#coupamount').val();
                        }
                    }
                else{
                    var pd=$('#paidamount').val();
                }
		  
		  
		  var selct=$('.mode_sel_btn_act').attr('id');//$('#payemntmode_sel').val();
		  
		  var typenam=$(".mode_sel_btn_act").attr('idval');//alert(typenam);
                 
		  if(pd!="")
		  {
                      
		    if(isFloat(pd))
		    { 
		    if(selct=="cash")
		    {
			  var paid=$('#paidamount').val();
			  var bal=$('#balanceamout').val();
			  var grand=$('#grandtotal').text();
			  var paidamtt=  parseFloat(paid.replace(/,/g, ""));
			var grandam=parseFloat(grand.replace(/,/g, ""));
			  if(bal==0)
			  {
				 bal= parseFloat(paidamtt) - parseFloat(grandam);
				 bal.toFixed(2);
			  }
			
			if(bal<0)
			{
				 var insufamt=$("#hidinsufamt").val();
				  
				   $(".payment_pend_right_cash_error").css("display","block");
				  $(".payment_pend_right_cash_error").addClass("popup_validate");
				  $(".payment_pend_right_cash_error").text(insufamt);
				  $('.payment_pend_right_cash_error').delay(2000).fadeOut('slow');
				  return false;
			}else
			{
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
				 	"value"		: "counter_settlebill",
					"type"		: selct,
					"typenam"	: typenam,
					"paid"		: paid,
					"bal" 		: bal,
					"mode"      :tamode
				  };
			  }
			}
				  
		  }
                    else  if(selct=="credit")
		    {
			  var trans=parseFloat($('#transcationid').val());
			  var bankdetails=$('#bankdetails').val();
			  var grand=parseFloat($('#grandtotal').text());
			   
			    var paid=($('#paidamount').val());
			
			   var transbal=($('#transbal').val());
		  
				var transbalam=  parseFloat(transbal.replace(/,/g, ""));
				  var paidam=parseFloat(paid.replace(/,/g, ""));
				
			 if(trans!=grand && paidam<transbalam )
			 {
			  
			  var insufamt=$("#hidinsufamt").val();
				    $(".payment_pend_right_cash_error").css("display","block");
				  $(".payment_pend_right_cash_error").addClass("popup_validate");
				  $(".payment_pend_right_cash_error").text(insufamt);
				  $('.payment_pend_right_cash_error').delay(2000).fadeOut('slow');
			 
			  
			 }else
			  {
			   if(trans<=grand)
			  {
			  if(trans!="" && bankdetails!='')
			   {
					var paid=$('#paidamount').val();
					var bal=$('#balanceamout').val();
					var transbal=$('#transbal').val();
					if((transbal=='0.00' || transbal=='0.000'  )&& bal=='0')
					{
					   var data = {
							 "value"		: "counter_settlebill",
							  "type"		: selct,
							  "typenam"	: typenam,
							  "trans" :trans,
							  "bank" :bankdetails,
							  "paid": paid,
							  "bal" : bal,
								"mode"      :tamode
							};
					}else if(transbal!='0.00' && bal!='0')
					{
						var data = {
							  "value"		: "counter_settlebill",
							  "type"		: selct,
							  "typenam"	: typenam,
							  "trans" :trans,
							  "bank" :bankdetails,
							  "paid": paid,
							  "bal" : bal,
					"mode"      :tamode
							};
					}else if((transbal<'0') && bal=='0')
						  {
							  var data = {
							  "value"		: "counter_settlebill",
							  "type"		: selct,
							  "typenam"	: typenam,
							  "trans" :trans,
							  "bank" :bankdetails,
							  "paid": paid,
							  "bal" : bal,
					"mode"      :tamode
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
		  
		  }
                    else if(selct=="coupon")
                    {
			  var coup=$('#coupname').val();
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
									  "value"		: "counter_settlebill",
									  "type"		: selct,
									  "typenam"	: typenam,
									  "coup" :coup,
									  "coupamnt": coupamnt,
									  "coupbal" : coupbal,
									  "paid": paid,
									  "bal" : bal,
					"mode"      :tamode
									};
						  }else if(coupbal!='0.00' && bal!='0')
						  {
							   var data = {
									  "value"		: "counter_settlebill",
									  "type"		: selct,
									  "typenam"	: typenam,
									  "coup" :coup,
									  "coupamnt": coupamnt,
									  "coupbal" : coupbal,
									  "paid": paid,
									  "bal" : bal,
					"mode"      :tamode
									};
						  }else if((coupbal<'0') && bal=='0')
						  {
							   var data = {
									  "value"		: "counter_settlebill",
									  "type"		: selct,
									  "typenam"	: typenam,
									  "coup" :coup,
									  "coupamnt": coupamnt,
									  "coupbal" : coupbal,
									  "paid": paid,
									  "bal" : bal,
					"mode"      :tamode
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
							  "value"		: "counter_settlebill",
							  "type"		: selct,
							  "typenam"	: typenam,
							  "vouchid" :vouchid,
							  "vocamount": vocamount,
							  "vouchbal" : vouchbal,
							  "paid": paid,
							  "bal" : bal,
					"mode"      :tamode
							};
						  }else if((vouchbal!='0.00') && bal!='0')
						  {
							  
							  var data = {
							 "value"		: "counter_settlebill",
							  "type"		: selct,
							  "typenam"	: typenam,
							  "vouchid" :vouchid,
							  "vocamount": vocamount,
							  "vouchbal" : vouchbal,
							  "paid": paid,
							  "bal" : bal,
					"mode"      :tamode
							};
						  }else if((vouchbal<'0') && bal=='0')
						  {
							   var data = {
							  "value"		: "counter_settlebill",
							  "type"		: selct,
							  "typenam"	: typenam,
							  "vouchid" :vouchid,
							  "vocamount": vocamount,
							  "vouchbal" : vouchbal,
							  "paid": paid,
							  "bal" : bal,
					"mode"      :tamode
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
								  "value"		: "counter_settlebill",
								  "type"		: selct,
								  "typenam"	: typenam,
								  "cheqbank" :cheqbank,
								  "cheqname": cheqname,
								  "cheqamt": cheqamt,
								  "paid": paid,
								  "bal" : bal,
					"mode"      :tamode
								};
						  }else if((cheqbal!='0.00') && bal!='0')
						  {
							  
							  var data = {
								  "value"		: "counter_settlebill",
								  "type"		: selct,
								  "typenam"	: typenam,
								  "cheqbank" :cheqbank,
								  "cheqname": cheqname,
								  "cheqamt": cheqamt,
								  "paid": paid,
								  "bal" : bal,
					"mode"      :tamode
								};
						  }else if((cheqbal<'0') && bal=='0')
						  {
							   var data = {
								  "value"		: "counter_settlebill",
								  "type"		: selct,
								  "typenam"	: typenam,
								  "cheqbank" :cheqbank,
								  "cheqname": cheqname,
								  "cheqamt": cheqamt,
								  "paid": paid,
								  "bal" : bal,
					"mode"      :tamode
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
                    else if(selct=="complimentary")
                    {
		  			var comp=$('#completext').val();
                                
					if(comp!='')
					  {
						   data = {
								  "value"			: "counter_settlebill",
								  "type"		: selct,
								  "typenam"		: typenam,
								  "comp"		: comp,
					"mode"      :tamode
								};
						  
					  }else
					  {var paymentmsg1 = ($("#paymentmsg1").val());
						  $(".payment_pend_right_cash_error").css("display","block");
						  $(".payment_pend_right_cash_error").addClass("popup_validate");
						  $(".payment_pend_right_cash_error").text(paymentmsg1);
						  $('.payment_pend_right_cash_error').delay(2000).fadeOut('slow');
					  }
	   
			
				}
                    else  if(selct=="credit_person") 
                    { 
                               var balanceamout_credit=$('#balanceamout_credit').val();
                                    if(balanceamout_credit!="0"){
					  var creditype=$('#selectcreditypes').val();
					  var creditdeatils=$('#selectcreditdetails').val();
                                          if(creditype==3 || creditype==4){
                                              creditdeatils='';guestnumber='';
                                              if(creditype==4){
                                                  
                                              var guestnumber=$('#selectcreditdetailsnumber').val();
                                        }
                                            var guestname=$('#selectcreditdetailsname').val();
                                        }
                                        else{
                                            var creditdeatils=$('#selectcreditdetails').val();
                                            var guestnumber='';
                                            var guestname='';
                                        }
					  var paidamount_credit=$('#paidamount_credit').val();
					  var amount_credit=$('#amount_credit').val();
					 var credit_remark_cs=$('#credit_remark_cs').val();
                                         //alert(credit_remark_cs);
					  if(creditype!='')
					  {
						   if((creditype=='2' && creditdeatils!='') || ((creditype=='3'||creditype=='4') && guestname!=''))
						  {
							   data = {
								  "value"					: "counter_settlebill",
								  "type"				: selct,
								  "typenam"				: typenam,
								  "creditype"			: creditype,
								  "creditdeatils"		: creditdeatils,
								  "paidamount_credit"	: paidamount_credit,
								  "amount_credit"		: amount_credit,
								  "bal"					: 0,
					                          "mode"                            :tamode,
                                                                  "credit_remark_cs"                :credit_remark_cs,
                                                                  "guestnumber"                 :guestnumber,
                                                                  "guestname"                 :guestname
								};
							  
						  }else
						  {
                                                      if(creditype=='4'|| creditype=='3'){
                                                          var sel_option='Enter Name ';
                                                        }
                                                        else{
						  var sel_option="Select Option !";
							  var labelname=$("#selectcreditypes").find('option:selected').attr('label');
							  $(".payment_pend_right_cash_error").css("display","block");
							  $(".payment_pend_right_cash_error").addClass("popup_validate");
							  $(".payment_pend_right_cash_error").text(sel_option +labelname);
							  $('.payment_pend_right_cash_error').delay(2000).fadeOut('slow');
						  }
                                              }
					  }else
					  {var sel_credttype="Select type !";
						  $(".payment_pend_right_cash_error").css("display","block");
						  $(".payment_pend_right_cash_error").addClass("popup_validate");
						  $(".payment_pend_right_cash_error").text(sel_credttype);
						  $('.payment_pend_right_cash_error').delay(2000).fadeOut('slow');
					  }
							
						
                                    }else{
                    alert("Credit not possible..! ");
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
			
			var incrt_amt=$("#hidincrt_amt").val();
			$(".payment_pend_right_cash_error").css("display","block");
			$(".payment_pend_right_cash_error").addClass("popup_validate");
                        $(".payment_pend_right_cash_error").text(incrt_amt);
                        $('.payment_pend_right_cash_error').delay(2000).fadeOut('slow');
			
		}
		  }else
		{
                   
                    $('.counter_settle_popup').show();
                    
			var entremt=$("#hidentramt").val();
			$(".payment_pend_right_cash_error").css("display","block");
			$(".payment_pend_right_cash_error").addClass("popup_validate");
			$(".payment_pend_right_cash_error").text(entremt);
			$('.payment_pend_right_cash_error').delay(2000).fadeOut('slow');
                                   var comp=$('#completext').val();
                                
					if(comp!='')
					  {
						   data = {
								  "value"			: "counter_settlebill",
								  "type"		: selct,
								  "typenam"		: typenam,
								  "comp"		: comp,
					"mode"      :tamode
								};
                                            
                                                                var sel_paytype=$("#hidsel_paytype").val();
                                                                $(".payment_pend_right_cash_error").css("display","block");
                                                                $(".payment_pend_right_cash_error").addClass("popup_validate");
                                                                $(".payment_pend_right_cash_error").text("Payment Successfully Processed");
                                                                $('.payment_pend_right_cash_error').delay(2000).fadeOut('slow');
                    }
			
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
                
                
                
		 data = $(this).serialize() + "&" + $.param(data)+"&tip_amount="+tip_amount+"&tip_mode="+tip_mode+"&auth_staff="+auth+"&coupon_code="+coupon_code+"&bill_final_amount_new="+bill_final_amount_new+"&sms_bill_settle="+sms_bill_settle;//alert(data);
		  
		  var bilfinal=$('.submitbill').val();
                
		  if(bilfinal!='')
		  {
			  data = data + '&billno=' +bilfinal;
				
		  }
		    
			 $.ajax({
					type: "POST",
					url: "load_counter_sales.php",
					data: data,
					success: function(msg)
					{ 
											 						
						window.location.href = "counter_sales.php";  
                                                 
						var settle=$('#counter_bill_before_settle').val();//alert(settle)
						if(settle=="Y")
						{
                                                                              if($('.submittranscations').hasClass("disable"))
                                                                              {
                                                                                  
                                                                              }
                                                                              else{
                                                                                  
										 var dataString; 
                                                                                 var bilfinal1=$('#settleingbilno').text();
                                                                                 
										 //dataString = 'value=ta_kotprint&gensettle=Y&bilno12='+bilfinal1;
                                                                           
//										   $.ajax({
//										  type: "POST",
//										  url: "print_details_kot.php",
//										  data: dataString,
//										  success: function(data1) {
//                                                                                      
//										   var dataString; 
//											  dataString = 'value=console_ta&gensettle=Y';
//										   $.ajax({
//										  type: "POST",
//										  url: "print_details_kot.php",
//										  data: dataString,
//										  success: function(data2) {
                                                                                      
							  $(".counter_settle_popup").css("display","none");
							  $(".counter_menu_popup_overlay").css("display","none");
							  window.location.href = "counter_sales.php?setcscommon=settlecspopup";  
                                                          
										//  }
										  //});
                                                                                  
										//  }
										 // });
                                                                                  
								  
                                                                                        if(settlebill1=='Y'){
                                                                                                    
//											  var dataString; 
//											  dataString = 'value=ta_billprint&bypass=y&gensettle=Y';
//											   $.ajax({
//											  type: "POST",
//											  url: "print_details_kot.php",
//											  data: dataString,
//											  success: function(data2) { 
												  
                                                                                                  
												    $(".counter_settle_popup").css("display","none");
                                                                                                    $(".counter_menu_popup_overlay").css("display","none");
                                                                                                    window.location.href = "counter_sales.php?setcscommon=settlecspopup";  
												   
												//	  }
												 // });
                                                                                              }
                                                                                              
                                                                                              $('.submittranscations').addClass("disable");
						 
								 	
								  
								 
                                            }}else
				            {                                 if($('.submittranscations').hasClass("disable"))
                                                                              {
                                                                                  
                                                                              }
                                                                              else{
                                                                                  
//										 var dataString; 
//										 dataString = 'value=ta_kotprint&gensettle=Y';
//										   $.ajax({
//										  type: "POST",
//										  url: "print_details_kot.php",
//										  data: dataString,
//										  success: function(data1) {  
//                                                                                      
//												 var dataString; 
//												 dataString = 'value=console_ta&gensettle=Y';
//                                                                                                        
//												 $.ajax({
//												type: "POST",
//												url: "print_details_kot.php",
//												data: dataString,
//												success: function(data2) {
//												}
//												});
//                                                                                                
//                                                                                                    
//											  var dataString; 
//											  dataString = 'value=ta_billprint&bypass=y&gensettle=Y';
//											   $.ajax({
//											  type: "POST",
//											  url: "print_details_kot.php",
//											  data: dataString,
//											  success: function(data2) {
                                                                                              
												  
												  $(".counter_settle_popup").css("display","none");
							                                          $(".counter_menu_popup_overlay").css("display","none");
							                                          window.location.href = "counter_sales.php?setcscommon=settlecspopup";  
                                                                                                  
												  
													  
													//  }
												  //});
                                                                                              
											/// }
										 // });
							$('.submittranscations').addClass("disable");
						}
                                            }
						
						
					}
				});
		}else
		{     
                        var sel_paytype=$("#hidsel_paytype").val();
			$(".payment_pend_right_cash_error").css("display","block");
			$(".payment_pend_right_cash_error").addClass("popup_validate");
			$(".payment_pend_right_cash_error").text(sel_paytype);
			$('.payment_pend_right_cash_error').delay(2000).fadeOut('slow');
		} 
                    
                    
                    
    
});



 $('.pin_close_settle_auth').click(function (event) {
     
     $('.cs_settle_auth_pop').hide();
     $('.confrmation_overlay_settle_auth').hide();   
              
 });
 
 
  $('#pin_set').keypress(function(ev){
      
             if(ev.keyCode == 13){
             ev.stopImmediatePropagation();
             $('.cs_settle_auth').trigger('click');
            }
   });
 
 
 
 $('.cs_settle_auth').click(function (event) {
     
     var pin_set=$('#pin_set').val();
     if(pin_set!=''){
     
     
      $.post("load_counter_sales.php", {pin:pin_set,value:'authpincheck',set:'pincheck'},
                            function(data){
                                data=$.trim(data);
                                if(data!="NO"){
                                    
                                var spl=data.split('*');
                            
                                if(spl[11]=='bill_settle:Y'){
                                    
                                
     $('.cs_settle_auth_pop').hide();
         $('.confrmation_overlay_settle_auth').hide();   
     var TA_KOT_consol_print = "TA_KOT_consol_print";
               
                $.post("printercheck_1.php", {type:TA_KOT_consol_print},

                function(data)
                { 
                data=$.trim(data); 
                
                if(data!=''){
                    
                    $(".counter_settle_popup").css("display","none");
                      $('.kotconfirmpopup_cs_submit').css('display','block');   
                    $(".confrmation_overlay").css("display","block");
                   
                      
               var data1="Countersale -"+data;
               
                $('#kotfailmsg_cs_submit').html(data1);
                    
                  }else  {
                     
        var settlebill1=$('#settlebill').val();
        var tip_amount=0;
        var tip_mode='C';
        if($('#tip_amount').val()!='' && $('#tip_amount').val()>0){
            tip_amount=$('#tip_amount').val();
            tip_mode=$('#tip_pay_mode').val();
        }
	var tamode='';
	if($(".takechk").is(':checked'))
        tamode='TA'
        else
        tamode='CS'
	
		var payemntmode_sel =$('.mode_sel_btn_act').attr('id');//alert(payemntmode_sel)
	
		if(payemntmode_sel!='')
		{
		 if(payemntmode_sel=='credit_person'){
                   var pd= $('#paidamount_credit').val();
                }
                else if(payemntmode_sel=='coupon'){
                      if(parseFloat($('#grandtotal').text())!=parseFloat($('#coupamount').val())){
                      var pd=$('#balanceamout').val();
                      entremt="Insufficient Amount";
                        }
                        else{
                            pd=$('#coupamount').val();
                        }
                    }
                else{
                    var pd=$('#paidamount').val();
                }
		  
		  var selct=$('.mode_sel_btn_act').attr('id');
		  
		  var typenam=$(".mode_sel_btn_act").attr('idval');
                  
   var l = pd.length; 
    var lastChar = pd.substring(l-1, l); 
    if (lastChar == ".") { 
            var result = pd.substring(0, l-1);
    }
    else { 
            var result = pd;
    }
             
		  if(result!="")
		  {  
                      
			 if(isFloat(result))
			{  
		    if(selct=="cash")
		    {
			  var paid=$('#paidamount').val();
			  var bal=$('#balanceamout').val();
			  var grand=$('#grandtotal').text();
			  var paidamtt=  parseFloat(paid.replace(/,/g, ""));
			var grandam=parseFloat(grand.replace(/,/g, ""));
			  if(bal==0)
			  {
				 bal= parseFloat(paidamtt) - parseFloat(grandam);
				 bal.toFixed(2);
			  }
			
			 
			if(bal<0)
			{
				 var insufamt=$("#hidinsufamt").val();
				  
				   $(".payment_pend_right_cash_error").css("display","block");
				  $(".payment_pend_right_cash_error").addClass("popup_validate");
				  $(".payment_pend_right_cash_error").text(insufamt);
				  $('.payment_pend_right_cash_error').delay(2000).fadeOut('slow');
				  return false;
			}else
			{
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
				 	"value"		: "counter_settlebill",
					"type"		: selct,
					"typenam"	: typenam,
					"paid"		: paid,
					"bal" 		: bal,
					"mode"      :tamode
				  };
                                  values_submit(data);
			  }
			}
				  
		  }
                    else  if(selct=="credit")
		    {
                        
                        var grand_nw=$('#grandtotal').text();
                       // var multi_cardamount_nw=$('#multi_cardamount').val(); 
                         var multi_cardamount_nw1=$('#multi_cardamount1').val(); 
                    
                        
                        if( multi_cardamount_nw1!=grand_nw){
                        
			  var trans=parseFloat($('#transcationid').val().replace(',',''));
			  var bankdetails=$('#bankdetails').val();
			  var grand=parseFloat($('#grandtotal').text());
			   
			    var paid=($('#paidamount').val());
			
			   var transbal=($('#transbal').val());
			
		  
				var transbalam=  parseFloat(transbal.replace(/,/g, ""));
				  var paidam=parseFloat(paid.replace(/,/g, ""));
				  
				 
			 if(trans!=grand && paidam<transbalam )
			 {
			   
			  var insufamt=$("#hidinsufamt").val();
				    $(".payment_pend_right_cash_error").css("display","block");
				  $(".payment_pend_right_cash_error").addClass("popup_validate");
				  $(".payment_pend_right_cash_error").text(insufamt);
				  $('.payment_pend_right_cash_error').delay(2000).fadeOut('slow');
			 
			  
			 }else
			  {
                              
			  if(trans<=grand)
			  {
                              
			  if(trans>0 && (bankdetails!='' && bankdetails!=null))
			   {
					var paid=$('#paidamount').val();
					var bal=$('#balanceamout').val();
					var transbal=$('#transbal').val();
					if((transbal=='0.00' || transbal=='0.000'  )&& bal=='0')
					{
					   var data = {
							 "value"		: "counter_settlebill",
							  "type"		: selct,
							  "typenam"	: typenam,
							  "trans" :trans,
							  "bank" :bankdetails,
							  "paid": paid,
							  "bal" : bal,
								"mode"      :tamode
							};
                                            values_submit(data);            
					}else if(transbal!='0.00' && bal!='0')
					{
						var data = {
							  "value"		: "counter_settlebill",
							  "type"		: selct,
							  "typenam"	: typenam,
							  "trans" :trans,
							  "bank" :bankdetails,
							  "paid": paid,
							  "bal" : bal,
                                                          "mode"      :tamode
							};
                                                values_submit(data);        
					}else if((transbal<'0') && bal=='0')
						  {
							  var data = {
							  "value"		: "counter_settlebill",
							  "type"		: selct,
							  "typenam"	: typenam,
							  "trans" :trans,
							  "bank" :bankdetails,
							  "paid": paid,
							  "bal" : bal,
                                                          "mode"      :tamode
							};
                                                        values_submit(data);
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
		 
                 }else{
                       var multi_cardamount_nw11=$('#multi_cardamount1').val(); 
                      var tran_nw=$('#transcationid').val();
			  var trans_nw=parseFloat(tran_nw.replace(',',''));
			  var bankdetails_nw=$('#bankdetails').val();
			 
			   var paid_nw=$('#paidamount').val();
			var bal_nw=$('#balanceamout').val();
			   var transbal_nw=$('#transbal').val();
                        
                 var data = {
							  "value"		: "counter_settlebill",
							  "type"		: selct,
							  "typenam"	: typenam,
							  "trans" :multi_cardamount_nw11,
							  "bank" :bankdetails_nw,
							  "paid": paid_nw,
							  "bal" : bal_nw,
                                                          "mode"      :tamode
							};
                                                        values_submit(data);
                 
                 
                                        }
                 
		  }
                    else if(selct=="coupon")
                    {
			  var coup=$('#coupname').val();
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
									  "value"		: "counter_settlebill",
									  "type"		: selct,
									  "typenam"	: typenam,
									  "coup" :coup,
									  "coupamnt": coupamnt,
									  "coupbal" : coupbal,
									  "paid": paid,
									  "bal" : bal,
                                                                          "mode"      :tamode
									};
                                                                        values_submit(data);
						  }else if(coupbal!='0.00' && bal!='0')
						  {
							   var data = {
									  "value"		: "counter_settlebill",
									  "type"		: selct,
									  "typenam"	: typenam,
									  "coup" :coup,
									  "coupamnt": coupamnt,
									  "coupbal" : coupbal,
									  "paid": paid,
									  "bal" : bal,
					"mode"      :tamode
									};
                                                                        values_submit(data);
						  }else if((coupbal<'0') && bal=='0')
						  {
							   var data = {
									  "value"		: "counter_settlebill",
									  "type"		: selct,
									  "typenam"	: typenam,
									  "coup" :coup,
									  "coupamnt": coupamnt,
									  "coupbal" : coupbal,
									  "paid": paid,
									  "bal" : bal,
					"mode"      :tamode
									};
                                                        values_submit(data);
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
							  "value"		: "counter_settlebill",
							  "type"		: selct,
							  "typenam"	: typenam,
							  "vouchid" :vouchid,
							  "vocamount": vocamount,
							  "vouchbal" : vouchbal,
							  "paid": paid,
							  "bal" : bal,
					"mode"      :tamode
							};
                                                        values_submit(data);
						  }else if((vouchbal!='0.00') && bal!='0')
						  {
							  
							  var data = {
							 "value"		: "counter_settlebill",
							  "type"		: selct,
							  "typenam"	: typenam,
							  "vouchid" :vouchid,
							  "vocamount": vocamount,
							  "vouchbal" : vouchbal,
							  "paid": paid,
							  "bal" : bal,
					"mode"      :tamode
							};
                                                        values_submit(data);
						  }else if((vouchbal<'0') && bal=='0')
						  {
							   var data = {
							  "value"		: "counter_settlebill",
							  "type"		: selct,
							  "typenam"	: typenam,
							  "vouchid" :vouchid,
							  "vocamount": vocamount,
							  "vouchbal" : vouchbal,
							  "paid": paid,
							  "bal" : bal,
					"mode"      :tamode
							};
                                                        values_submit(data);
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
								  "value"		: "counter_settlebill",
								  "type"		: selct,
								  "typenam"	: typenam,
								  "cheqbank" :cheqbank,
								  "cheqname": cheqname,
								  "cheqamt": cheqamt,
								  "paid": paid,
								  "bal" : bal,
					"mode"      :tamode
								};
                                                                values_submit(data);
						  }else if((cheqbal!='0.00') && bal!='0')
						  {
							  
							  var data = {
								  "value"		: "counter_settlebill",
								  "type"		: selct,
								  "typenam"	: typenam,
								  "cheqbank" :cheqbank,
								  "cheqname": cheqname,
								  "cheqamt": cheqamt,
								  "paid": paid,
								  "bal" : bal,
					"mode"      :tamode
								};
                                                                values_submit(data);
						  }else if((cheqbal<'0') && bal=='0')
						  {
							   var data = {
								  "value"		: "counter_settlebill",
								  "type"		: selct,
								  "typenam"	: typenam,
								  "cheqbank" :cheqbank,
								  "cheqname": cheqname,
								  "cheqamt": cheqamt,
								  "paid": paid,
								  "bal" : bal,
					"mode"      :tamode
								};
                                                                values_submit(data);
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
                    else if(selct=="complimentary")
                    {
		  			var comp=$('#completext').val();
                                
					if(comp!='')
					  {
						   data = {
								  "value"			: "counter_settlebill",
								  "type"		: selct,
								  "typenam"		: typenam,
								  "comp"		: comp,
					"mode"      :tamode
								};
                                                                values_submit(data);
						  
					  }else
					  {var paymentmsg1 = ($("#paymentmsg1").val());
						  $(".payment_pend_right_cash_error").css("display","block");
						  $(".payment_pend_right_cash_error").addClass("popup_validate");
						  $(".payment_pend_right_cash_error").text(paymentmsg1);
						  $('.payment_pend_right_cash_error').delay(2000).fadeOut('slow');
					  }
	   
			
				}
                    else  if(selct=="credit_person") 
                    { 
                                    var balanceamout_credit=$('#balanceamout_credit').val();
                               
                                    if(balanceamout_credit>0 || balanceamout_credit==''){
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
					  var paidamount_credit=$('#paidamount_credit').val();
					  var amount_credit=$('#amount_credit').val();
					 var credit_remark_cs=$('#credit_remark_cs').val();
                                         var room='';
                                         //alert(credit_remark_cs);
					  if(creditype!='')
					  {
						   if(((creditype=='2'||creditype=='1') && creditdeatils!='') || ((creditype=='3'||creditype=='4') && guestname!=''))
						  {     
                                                        if(creditype=='1'){
                                                            room=$("#selectcreditdetails option:selected").text();
                                                        }
                                                          
							   data = {
								  "value"					: "counter_settlebill",
								  "type"				: selct,
								  "typenam"				: typenam,
								  "creditype"			: creditype,
								  "creditdeatils"		: creditdeatils,
								  "paidamount_credit"	: paidamount_credit,
								  "amount_credit"		: amount_credit,
								  "bal"					: 0,
					                          "mode"                            :tamode,
                                                                  "credit_remark_cs"                :credit_remark_cs,
                                                                  "guestnumber"                 :guestnumber,
                                                                  "guestname"                 :guestname,
                                                                   "room"                      :room 
                                                            };
                                                            values_submit(data);
							  
						  }else
						  {
                                                      if(creditype=='4'|| creditype=='3'){
                                                          var sel_option='Enter Name ';
                                                        }
                                                        else{
						  var sel_option="Select Option !";
							  var labelname=$("#selectcreditypes").find('option:selected').attr('label');
							  $(".payment_pend_right_cash_error").css("display","block");
							  $(".payment_pend_right_cash_error").addClass("popup_validate");
							  $(".payment_pend_right_cash_error").text(sel_option +labelname);
							  $('.payment_pend_right_cash_error').delay(2000).fadeOut('slow');
						  }
                                              }
					  }else
					  {var sel_credttype="Select type !";
						  $(".payment_pend_right_cash_error").css("display","block");
						  $(".payment_pend_right_cash_error").addClass("popup_validate");
						  $(".payment_pend_right_cash_error").text(sel_credttype);
						  $('.payment_pend_right_cash_error').delay(2000).fadeOut('slow');
					  }
						
                                    }else{
                    alert("Credit not possible..! ");
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
			
			var incrt_amt=$("#hidincrt_amt").val();
			$(".payment_pend_right_cash_error").css("display","block");
			$(".payment_pend_right_cash_error").addClass("popup_validate");
                        $(".payment_pend_right_cash_error").text(incrt_amt);
                        $('.payment_pend_right_cash_error').delay(2000).fadeOut('slow');
			
		}
		  }else
		{
                   
			
                    var payemntmode_sel =$('.mode_sel_btn_act').attr('id');
                  
                          var comp=$('#completext').val();
                        if(comp=='' && payemntmode_sel=='complimentary'){
                            $(".payment_pend_right_cash_error").css("display","block");
			$(".payment_pend_right_cash_error").addClass("popup_validate");
			$(".payment_pend_right_cash_error").text('Enter remarks');
			$('.payment_pend_right_cash_error').delay(2000).fadeOut('slow');
                        
                        }else{
                            var entremt=$("#hidentramt").val();
			$(".payment_pend_right_cash_error").css("display","block");
			$(".payment_pend_right_cash_error").addClass("popup_validate");
			$(".payment_pend_right_cash_error").text(entremt);
			$('.payment_pend_right_cash_error').delay(2000).fadeOut('slow');
                        }
                        
                                 //  var comp=$('#completext').val();
                                
					if(comp!='')
					  {
						   data = {
								  "value"		: "counter_settlebill",
								  "type"		: selct,
								  "typenam"		: typenam,
								  "comp"		: comp,
					"mode"      :tamode
								};
                                                                values_submit(data);
                                                                var sel_paytype=$("#hidsel_paytype").val();
                                                                $(".payment_pend_right_cash_error").css("display","block");
                                                                $(".payment_pend_right_cash_error").addClass("popup_validate");
                                                                $(".payment_pend_right_cash_error").text("Payment Successfully Processed");
                                                                $('.payment_pend_right_cash_error').delay(2000).fadeOut('slow');
                    }
			
		}
                
		 function values_submit(data){
                     
                     if($('#code_comp_credit').val()!='' && $('#code_comp_credit').val()!='undefined'){
                     var auth=$('#code_comp_credit').val();
                     
                     }else{
                          var auth=spl[12];
                     }
                     
                     
                     
                 var kot_after_settle=$('#kot_after_settle').val();    
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
                
		 data = $(this).serialize() + "&" + $.param(data)+"&tip_amount="+tip_amount+"&tip_mode="+tip_mode+"&auth_staff="+auth+"&coupon_code="+coupon_code+"&bill_final_amount_new="+bill_final_amount_new+"&sms_bill_settle="+sms_bill_settle;//alert(data);
                 
		  if(data=='&'){
                      data='';
                  }
                   if(data!=''){
		  var bilfinal=$('.submitbill').val();
                  
		  if(bilfinal!='')
		  {
			  data = data + '&billno=' +bilfinal;
				
		      }
                      
                      if(bilfinal!=""){
                          var billmiss=$('.submitbill').val(); 
                      }else{
                            billmiss=$('#settleingbilno').text();
                      }
                     
                              
                     
                       if(localStorage.double_click_avoid!=$.trim($('#settleingbilno').text())){
                           var click_no=1;
                       }else{
                           var click_no=2;
                       }
                       
                     
                       if(click_no==1){
                           
                           localStorage.double_click_avoid=$.trim($('#settleingbilno').text());
			 $.ajax({
					type: "POST",
					url: "load_counter_sales.php",
					data: data,
					success: function(msg)
					{   
                                            if($.trim(msg)=="Please open the shift for the current login"){
                                                
                                                              $(".payment_pend_right_cash_error").css("display","block");
							  $(".payment_pend_right_cash_error").addClass("popup_validate");
							  $(".payment_pend_right_cash_error").text("Please Open Shift For Current Login");
							  $('.payment_pend_right_cash_error').delay(3000).fadeOut('slow');
                                                          localStorage.double_click_avoid='';
                                                
                                             }else{
                                            
                                            var settle=$('#counter_bill_before_settle').val();//alert(settle)
						if(settle=="Y")
						 {
                                                                              if($('.submittranscations').hasClass("disable"))
                                                                              {
                                                                              }
                                                                              else{
										var dataString; 
                                                                                var bilfinal1=$('#settleingbilno').text();
                                                                                 if(kot_after_settle=='Y'){
										 dataString = 'value=ta_kotprint&gensettle=Y&bilno12='+bilfinal1;
                                                                             }
										   $.ajax({
										  type: "POST",
										  url: "print_details_kot.php",
										  data: dataString,
										  success: function(data1) { //alert(data1);
                                                                                      
                                                                                      var kot=$.trim(data1);
                                                                                      
										   var dataString; 
                                                                                    if(kot_after_settle=='Y'){
											  dataString = 'value=console_ta&gensettle=Y&bilno='+bilfinal1+'&kotno='+kot;
                                                                                      }
                                                                                        //alert(dataString) ;
										   $.ajax({
										  type: "POST",
										  url: "print_details_kot.php",
										  data: dataString,
										  success: function(data2) {
                                                                                     
                                                                                    $(".counter_settle_popup").css("display","none");
                                                                                    $(".counter_menu_popup_overlay").css("display","none");
                                                                                    var dataString; 
                                                                                    dataString = 'set=drawer_cs_open_after_settlement';
                                                                                    $.ajax({
                                                                                        type: "POST",
                                                                                        url: "cashdrawer_details.php",
                                                                                        data: dataString,
                                                                                        success: function(data3) {
                                                                                            data3=data3.trim();
                                                                                            if(localStorage.coming_from=='direct_flow'){
                                                                                              window.location.href = "counter_sales.php";
                                                                                          }
                                                                                          else{
                                                                                             window.location.href = "counter_sales.php?setcscommon=settlecspopup"; 
                                                                                          }
                                                                                        }
                                                                                    });
                                                         
										  }
										  });
										   }
										  });
                                                                                  
						   	
                                                      
                          if($('#pole_on').val()=='Y'){                                
                         var data_pole = "set_pole=pole_display_all&display=thankyou";
			$.ajax({
			type: "POST",
			url: "index.php",
			data: data_pole,
			success: function(data5) {
			
			}
			});
                    }                              
                                                      
                                                                                        if(settlebill1=='Y'){
                                                                                                    
												var dataString; 
											  dataString = 'value=ta_billprint&bypass=y&gensettle=Y&bilno='+bilfinal1;
											   $.ajax({
											  type: "POST",
											  url: "print_details_kot.php",
											  data: dataString,
											  success: function(data2) {//alert("b");
												  data2=data2.trim();
												  $(".counter_settle_popup").css("display","none");
                                                                                                    $(".counter_menu_popup_overlay").css("display","none");
                                                                                                   if(localStorage.coming_from=='direct_flow'){
                                                                                                        window.location.href = "counter_sales.php";
                                                                                                    }
                                                                                                    else{
                                                                                                       window.location.href = "counter_sales.php?setcscommon=settlecspopup"; 
                                                                                                    }
												   if(data2=="ok")
													  {
														
												  
													  }
													  
													  }
												  });
                                                                                              }
                                                    $('.submittranscations').addClass("disable");
						 	 
                                                    }}else
						     {      if($('.submittranscations').hasClass("disable"))
                                                                              {
                                                                              }
                                                                              else{
                                                                                  var bilfinal1=$('#settleingbilno').text();
										var dataString; 
                                                                                 if(kot_after_settle=='Y'){
										 dataString = 'value=ta_kotprint&gensettle=Y&bilno12='+bilfinal1;
                                                                             }  
                                                                                $.ajax({
										  type: "POST",
										  url: "print_details_kot.php",
										  data: dataString,
										  success: function(data1) {  //alert(data);
                                                                                      var kot=$.trim(data1);
												 var dataString; 
                                                                                                  if(kot_after_settle=='Y'){
													dataString = 'value=console_ta&gensettle=Y&bilno='+bilfinal1+'&kotno='+kot;
                                                                                                    }
												 $.ajax({
												type: "POST",
												url: "print_details_kot.php",
												data: dataString,
												success: function(data2) {
												}
												});
                                                                                                 
											  var dataString; 
                                                                                           if(settlebill1=='Y'){
											  dataString = 'value=ta_billprint&bypass=y&gensettle=Y&bilno='+bilfinal1;
                                                                                      }
											   $.ajax({
											  type: "POST",
											  url: "print_details_kot.php",
											  data: dataString,
											  success: function(data2) {//alert("b");
												  data2=data2.trim();
												  $(".counter_settle_popup").css("display","none");
							                                    $(".counter_menu_popup_overlay").css("display","none");
                                                                                    if(localStorage.coming_from=='direct_flow'){
                                                                                        window.location.href = "counter_sales.php";
                                                                                    }
                                                                                    else{
                                                                                       window.location.href = "counter_sales.php?setcscommon=settlecspopup"; 
                                                                                    }
												   if(data2=="ok")
													  {
														
												  
													  }
													  
													  }
												  });
                                                                                              
											 }
										  });
                                                var dataString; 
						dataString = 'set=drawer_cs_open_after_settlement';
						$.ajax({
                                                    type: "POST",
                                                    url: "cashdrawer_details.php",
                                                    data: dataString,
                                                    success: function(data3) {
                                                        data3=data3.trim();
                                                    }
						});	
                                                
                                                
                          if($('#pole_on').val()=='Y'){                          
                         var data_pole = "set_pole=pole_display_all&display=thankyou";
			$.ajax({
			type: "POST",
			url: "index.php",
			data: data_pole,
			success: function(data5) {
			
			}
			});
                    }
                        
                                                                                  
						$('.submittranscations').addClass("disable");
						}
                                            }
                                        }	
					}
				});
                                
                            }
                            } }
		}else
		{       var sel_paytype=$("#hidsel_paytype").val();
			$(".payment_pend_right_cash_error").css("display","block");
			$(".payment_pend_right_cash_error").addClass("popup_validate");
			$(".payment_pend_right_cash_error").text(sel_paytype);
			$('.payment_pend_right_cash_error').delay(2000).fadeOut('slow');
		}
		
        }
	});
        
        }else{
         $("#pin_error_set").css("display","block");
                                    $("#pin_error_set").text("NO PERMISSION");
                                    $("#pin_error_set").delay(2000).fadeOut('slow');
                                    $("#pin_set").val('');
                                    $("#pin_set").focus();
         }
        
        }else{
         $("#pin_error_set").css("display","block");
                                    $("#pin_error_set").text("CODE NOT REGISTERED");
                                    $("#pin_error_set").delay(2000).fadeOut('slow');
                                    $("#pin_set").val('');
                                    $("#pin_set").focus();
    }
                            });
        
    }else{
         $("#pin_error_set").css("display","block");
                                    $("#pin_error_set").text("ENTER PIN");
                                    $("#pin_error_set").delay(2000).fadeOut('slow');
                                    $("#pin_set").val('');
                                    $("#pin_set").focus();
    }
 });
 

/////////cs settle button click real////

 $('.submittranscations').click(function (event) {
     
     $('.submittranscations').addClass("disablegenerate");      
     
              setTimeout(function(){
              
                   $('.submittranscations').removeClass("disablegenerate");      
        
               }, 5000);
           
                $(".payment_pend_right_cash_error").css("display","block");
		$(".payment_pend_right_cash_error").addClass("popup_validate");
		$(".payment_pend_right_cash_error").text("BILL SETTLING");
		$('.payment_pend_right_cash_error').delay(3500).fadeOut('slow');
                
	   event.stopImmediatePropagation();
           
           var bill_settle_auth=$('#bill_settle_auth').val();
           
           if(bill_settle_auth !='N'){
               
               
               $('.cs_settle_auth_pop').show();
               
               $('.confrmation_overlay_settle_auth').show();
               
               $("#pin_set").val('');
                
               setTimeout(function(){
              
                  $("#pin_set").focus();
        
               }, 1000); 
              
                
                
           }else{
           
         
                var TA_KOT_consol_print = "cs_kotandbill_print";
             
                $.post("printercheck_1.php", {type:TA_KOT_consol_print},

                function(data)
                { 
                    
                data=$.trim(data); 
                
                if(data!=''){
                    
                    $(".counter_settle_popup").css("display","none");
                    $('.kotconfirmpopup_cs_submit').css('display','block');   
                    $(".confrmation_overlay").css("display","block");
                   
                      
                    var data1="Countersale : "+data;
               
                    $('#kotfailmsg_cs_submit').html(data1);
                    
               }else  {
                     
        var settlebill1=$('#settlebill').val();
        var tip_amount=0;
        var tip_mode='C';
        
        if($('#tip_amount').val()!='' && $('#tip_amount').val()>0){
            tip_amount=$('#tip_amount').val();
            tip_mode=$('#tip_pay_mode').val();
        }
        
	var tamode='';
	if($(".takechk").is(':checked'))
        tamode='TA' 
        else
        tamode='CS'
	
		var payemntmode_sel =$('.mode_sel_btn_act').attr('id');
	
		if(payemntmode_sel!='')
		{
                    
                    
                    
                                        var creditype1=$('#selectcreditypes').val();
                                        var guestnumber1=$('#selectcreditdetailsnumber').val();
                                        var dataString66 = 'set=check_user_credit&number='+guestnumber1;
                                        
									  $.ajax({
									  type: "POST",
									  url: "load_index.php",
									  data: dataString66,
									  success: function(datal) {
                                                           
                if(($.trim(datal)=='ok' && creditype1=='4') || creditype1!='4' || payemntmode_sel!='credit_person' ){ 
                    
                    
                    
                    
		 if(payemntmode_sel=='credit_person'){
                     
                   var pd= $('#paidamount_credit').val();
                   
                }else if(payemntmode_sel=='coupon'){
                    
                      if(parseFloat($('#grandtotal').text())!=parseFloat($('#coupamount').val())){
                          
                      var pd=$('#balanceamout').val();
                      entremt="Insufficient Amount";
                      
                      }else{
                          
                            pd=$('#coupamount').val();
                    }
                    }else{
                        
                    var pd=$('#paidamount').val();
                }
		  
		  var selct=$('.mode_sel_btn_act').attr('id');
		  
		  var typenam=$(".mode_sel_btn_act").attr('idval');
                 
                     var l = pd.length; 
                     
                     var lastChar = pd.substring(l-1, l); 
                     if (lastChar == ".") { 
                             var result = pd.substring(0, l-1);
                     }
                     else { 
                             var result = pd;
                     }
             
             
		    if(result!="")
		    {  
                      
		    if(isFloat(result))
		    { 
                        
		    if(selct=="cash")
		    {
			  var paid=$('#paidamount').val();
			  var bal=$('#balanceamout').val();
			  var grand=$('#grandtotal').text();
			  var paidamtt=  parseFloat(paid.replace(/,/g, ""));
			  var grandam=parseFloat(grand.replace(/,/g, ""));
                        
                         
                        
			  if(bal==0)
			  {
				 bal= parseFloat(paidamtt) - parseFloat(grandam);
				 bal.toFixed(2);
			  }
			
			
			if(bal<0)
			{
				  var insufamt=$("#hidinsufamt").val();
				  
				  $(".payment_pend_right_cash_error").css("display","block");
				  $(".payment_pend_right_cash_error").addClass("popup_validate");
				  $(".payment_pend_right_cash_error").text(insufamt);
				  $('.payment_pend_right_cash_error').delay(2000).fadeOut('slow');
				  return false;
			}else
			{
                            
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
				 	"value"		: "counter_settlebill",
					"type"		: selct,
					"typenam"	: typenam,
					"paid"		: paid,
					"bal" 		: bal,
					"mode"      :tamode
				  };
                                  values_submit(data);
			  }
			}
				  
		    }
                    else  if(selct=="credit")
		    {
                        
                         var grand_nw=$('#grandtotal').text();
                     
                         var multi_cardamount_nw1=$('#multi_cardamount').val(); 
                    
                         if(multi_cardamount_nw1!=grand_nw){
                        
			   var trans=parseFloat($('#transcationid').val().replace(',',''));
			   var bankdetails=$('#bankdetails').val();
			   var grand=parseFloat($('#grandtotal').text());
			   var paid=($('#paidamount').val());
			   var transbal=($('#transbal').val());
			   var transbalam=  parseFloat(transbal.replace(/,/g, ""));
			   var paidam=parseFloat(paid.replace(/,/g, ""));
				  
				 
			 if(trans!=grand && paidam<transbalam )
			 { 
			          var insufamt=$("#hidinsufamt").val();
				  $(".payment_pend_right_cash_error").css("display","block");
				  $(".payment_pend_right_cash_error").addClass("popup_validate");
				  $(".payment_pend_right_cash_error").text(insufamt);
				  $('.payment_pend_right_cash_error').delay(2000).fadeOut('slow');
			 
			 }else
			 {
                              
			  if(trans<=grand)
			  {
                             
			  if(trans>0 && (bankdetails!='' && bankdetails!=null))
			   {
					var paid=$('#paidamount').val();
					var bal=$('#balanceamout').val();
					var transbal=$('#transbal').val();
                                      
					if((transbal=='0.00' || transbal=='0.000' ) && bal=='0')
					{
					   var data = {
							 "value"    : "counter_settlebill",
							  "type"    : selct,
							  "typenam" : typenam,
							  "trans" :trans,
							  "bank" :bankdetails,
							  "paid": paid,
							  "bal" : bal,
							  "mode"      :tamode
                                                          
					  };
                                                        
                                         values_submit(data);   
                                            
					}else if(transbal!='0.00' && bal!='0')
					{
						var data = {
							  "value"		: "counter_settlebill",
							  "type"		: selct,
							  "typenam"	: typenam,
							  "trans" :trans,
							  "bank" :bankdetails,
							  "paid": paid,
							  "bal" : bal,
                                                          "mode"      :tamode
							};
                                                        
                                          values_submit(data);   
                                                
					}else if((transbal<'0') && bal=='0')
					 {
							  var data = {
							  "value"		: "counter_settlebill",
							  "type"		: selct,
							  "typenam"	: typenam,
							  "trans" :trans,
							  "bank" :bankdetails,
							  "paid": paid,
							  "bal" : bal,
                                                          "mode"      :tamode
							};
                                                        
                                                        values_submit(data);
                                          
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
                                         
                                         if(trans<=0){
				         $(".payment_pend_right_cash_error").text('INSUFFICIENT AMOUNT');
                                         }else{
                                             
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
		 
                 }else{ 
                     
                        if((transbal=='0.00' || transbal=='0.000' ) && bal=='0')
			{
                     
                        var multi_cardamount_nw11=$('#multi_cardamount').val(); 
                        var tran_nw=$('#transcationid').val();
		        var trans_nw=parseFloat(tran_nw.replace(',',''));
		        var bankdetails_nw=$('#bankdetails').val();
			 
			var paid_nw=$('#paidamount').val();
			var bal_nw=$('#balanceamout').val();
			var transbal_nw=$('#transbal').val();
                     
                          var data = {
							  "value"		: "counter_settlebill",
							  "type"		: selct,
							  "typenam"	: typenam,
							  "trans" :multi_cardamount_nw11,
							  "bank" :bankdetails_nw,
							  "paid": paid_nw,
							  "bal" : bal_nw,
                                                          "mode"      :tamode
							};
                                                        values_submit(data);
                 
                 
                                    }else{
                                            
                                     var multi_amt=parseFloat($('#multi_cardamount').val());   
                                     
                                     var grand_new_1=parseFloat($('#grandtotal').text());
                                     
                                    if(multi_amt==grand_new_1){
                                        
                                                 var multibanktype=$('#multibanktype').val();
                                        
                                                 var ctype =  $("#multicardtype").val();
                                                 var camount = $('#multi_cardamount').val();
                                                 var cnumber = $("#card_1").val();
                                                 var billno=$('#settleingbilno').html(); 

                                               

                                                 var bankdefault =  $("#bankdetails").val();   

                                                 var datastring = "ctype="+ctype+"&camount="+camount+"&cnumber="+cnumber+"&billno="+billno
                                                 +"&btype="+multibanktype+"&bankdefault="+bankdefault+"&full_settle=Y";

                                                     $.ajax({
                                                     type: "POST",
                                                     url: "counter_sales.php",
                                                     data: datastring,
                                                     success: function (data)
                                                     {  


                                                     }
                                                 });                     

                                        
		                                          
			 
                                                          var data = {
                                                              
							  "value"     : "counter_settlebill",
							  "type"      : selct,
							  "typenam"   : typenam,
							  "trans"     : multi_amt,
							  "bank"      : multibanktype,
							  "paid"      : '0',
							  "bal"       : '0',
                                                          "mode"      :tamode
							};
                                                        
                                                        values_submit(data);
                                        
                                    }else{                                                                  
                                            
				     $(".payment_pend_right_cash_error").css("display","block");
			             $(".payment_pend_right_cash_error").addClass("popup_validate");
				     $(".payment_pend_right_cash_error").text('ADD CARD AMOUNT ');
				     $('.payment_pend_right_cash_error').delay(2000).fadeOut('slow');
                                     
                                    }
                                     
                                     
                                     }
                                        
                  }
                 
		  }
                  else if(selct=="coupon")
                  {
			  var coup=$('#coupname').val();
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
						  
						  
						  {
                                                           var insufamt=$("#hidinsufamt").val();
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
									  "value"		: "counter_settlebill",
									  "type"		: selct,
									  "typenam"	: typenam,
									  "coup" :coup,
									  "coupamnt": coupamnt,
									  "coupbal" : coupbal,
									  "paid": paid,
									  "bal" : bal,
                                                                          "mode"      :tamode
									};
                                                                        values_submit(data);
						  }else if(coupbal!='0.00' && bal!='0')
						  {
							   var data = {
									  "value"		: "counter_settlebill",
									  "type"		: selct,
									  "typenam"	: typenam,
									  "coup" :coup,
									  "coupamnt": coupamnt,
									  "coupbal" : coupbal,
									  "paid": paid,
									  "bal" : bal,
					"mode"      :tamode
									};
                                                                        values_submit(data);
						  }else if((coupbal<'0') && bal=='0')
						  {
							   var data = {
									  "value"		: "counter_settlebill",
									  "type"		: selct,
									  "typenam"	: typenam,
									  "coup" :coup,
									  "coupamnt": coupamnt,
									  "coupbal" : coupbal,
									  "paid": paid,
									  "bal" : bal,
					"mode"      :tamode
									};
                                                        values_submit(data);
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
					
			   }else
					   {
                                                     var entremt=$("#hidentramt").val();
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
		    }
                    else if(selct=="complimentary")
                    {
		  			var comp=$('#completext').val();
                                
					if(comp!='')
					  {
						   data = {
								  "value"			: "counter_settlebill",
								  "type"		: selct,
								  "typenam"		: typenam,
								  "comp"		: comp,
					"mode"      :tamode
								};
                                                                values_submit(data);
						  
					  }else
					  {
                                                  var paymentmsg1 = ($("#paymentmsg1").val());
						  $(".payment_pend_right_cash_error").css("display","block");
						  $(".payment_pend_right_cash_error").addClass("popup_validate");
						  $(".payment_pend_right_cash_error").text(paymentmsg1);
						  $('.payment_pend_right_cash_error').delay(2000).fadeOut('slow');
					  }
	   
			
				}
                    else  if(selct=="credit_person") 
                    { 
                                    var balanceamout_credit=$('#balanceamout_credit').val();
                               
                                    if(balanceamout_credit>0 || balanceamout_credit==''){
                                        
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
                                        
					  var paidamount_credit=$('#paidamount_credit').val();
					  var amount_credit=$('#amount_credit').val();
					  var credit_remark_cs=$('#credit_remark_cs').val();
                                          var room='';
                                        
					  if(creditype!='')
					  {
						   if(((creditype=='2'|| creditype=='1') && creditdeatils!='') || ((creditype=='3'|| creditype=='4') && guestname!=''))
						  {     
                                                        if(creditype=='1'){
                                                              room=$("#selectcreditdetails option:selected").text();
                                                        }
                                                          
							   data = {
                                                               
								  "value"			: "counter_settlebill",
								  "type"			: selct,
								  "typenam"			: typenam,
								  "creditype"			: creditype,
								  "creditdeatils"		: creditdeatils,
								  "paidamount_credit"	        : paidamount_credit,
								  "amount_credit"		: amount_credit,
								  "bal"				: 0,
					                          "mode"                        :tamode,
                                                                  "credit_remark_cs"            :credit_remark_cs,
                                                                  "guestnumber"                 :guestnumber,
                                                                  "guestname"                   :guestname,
                                                                   "room"                       :room 
                                                            };
                                                            
                                                            values_submit(data);
                                                            
							  
						  }else
						  {
                                                      if(creditype=='4'|| creditype=='3'){
                                                          var sel_option='Enter Name ';
                                                        }
                                                        else{
                                                            
						          var sel_option="Select Option !";
							  var labelname=$("#selectcreditypes").find('option:selected').attr('label');
							  $(".payment_pend_right_cash_error").css("display","block");
							  $(".payment_pend_right_cash_error").addClass("popup_validate");
							  $(".payment_pend_right_cash_error").text(sel_option +labelname);
							  $('.payment_pend_right_cash_error').delay(2000).fadeOut('slow');
						  }
                                              }
					  }else
					  {
                                                  var sel_credttype="Select type !";
						  $(".payment_pend_right_cash_error").css("display","block");
						  $(".payment_pend_right_cash_error").addClass("popup_validate");
						  $(".payment_pend_right_cash_error").text(sel_credttype);
						  $('.payment_pend_right_cash_error').delay(2000).fadeOut('slow');
					  }
						
                                    }else{
                                                 alert("Credit not possible..! ");
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
			
			var incrt_amt=$("#hidincrt_amt").val();
			$(".payment_pend_right_cash_error").css("display","block");
			$(".payment_pend_right_cash_error").addClass("popup_validate");
                        $(".payment_pend_right_cash_error").text(incrt_amt);
                        $('.payment_pend_right_cash_error').delay(2000).fadeOut('slow');
			
		}
		}else
		{
                      if(selct!="complimentary"){
                          
			var entremt=$("#hidentramt").val();
			$(".payment_pend_right_cash_error").css("display","block");
			$(".payment_pend_right_cash_error").addClass("popup_validate");
			$(".payment_pend_right_cash_error").text(entremt);
			$('.payment_pend_right_cash_error').delay(2000).fadeOut('slow');
                        
                       }
                       
                       if(selct=="complimentary"){  
                       
                    var comp=$('#completext').val();
                                
		    if(comp!='')
		    {
						               data = {
								  "value"		: "counter_settlebill",
								  "type"		: selct,
								  "typenam"		: typenam,
								  "comp"		: comp,
					                          "mode"      :tamode
								};
                                                                
                                                                values_submit(data);
                                                                
                                                                var sel_paytype=$("#hidsel_paytype").val();
                                                                $(".payment_pend_right_cash_error").css("display","block");
                                                                $(".payment_pend_right_cash_error").addClass("popup_validate");
                                                                $(".payment_pend_right_cash_error").text("Payment Successfull");
                                                                $('.payment_pend_right_cash_error').delay(2000).fadeOut('slow');
                                                                
                    }else{
                        $(".payment_pend_right_cash_error").css("display","block");
			$(".payment_pend_right_cash_error").addClass("popup_validate");
			$(".payment_pend_right_cash_error").text('ENTER REMARKS');
			$('.payment_pend_right_cash_error').delay(2000).fadeOut('slow');
                    }
                    
                       }
			
   }
                
   function values_submit(data){ 
                     
                
                     
               var auth=$('#code_comp_credit').val();
               var kot_after_settle=$('#kot_after_settle').val();    
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
                
                
                var num_sms_new=$('#num_sms_new').val(); 
                var name_sms_new=$('#name_sms_new').val(); 
                
                  $('.submittranscations').addClass("disablegenerate");
                
		 data = $(this).serialize() + "&" + $.param(data)+"&tip_amount="+tip_amount+"&tip_mode="+tip_mode+"&auth_staff="+auth+
                         "&coupon_code="+coupon_code+"&bill_final_amount_new="+bill_final_amount_new+"&sms_bill_settle="+sms_bill_settle+
                         "&num_sms_new="+num_sms_new+"&name_sms_new="+name_sms_new;//alert(data);
               
                  //alert(data);
                 
		  if(data=='&'){
                      data='';
                  }
                  
                if(data!=''){
		      var bilfinal=$('.submitbill').val();
                  
		  if(bilfinal!='')
		  {
		      data = data + '&billno=' +bilfinal;
				
		  }
                      
                 if(bilfinal!=""){
                     var billmiss=$('.submitbill').val(); 
                 }else{
                     billmiss=$('#settleingbilno').text();
                 }
                     
                              
                     
                 if(localStorage.double_click_avoid!=$.trim($('#settleingbilno').text())){
                      var click_no=1;
                 }else{
                      var click_no=2;
                 }
                       
                     
               if(click_no==1){
                           
                localStorage.double_click_avoid=$.trim($('#settleingbilno').text());
                           
                $(".payment_pend_right_cash_error").css("display","block");
		$(".payment_pend_right_cash_error").addClass("popup_validate");
		$(".payment_pend_right_cash_error").text("BILL SETTLING...");
		$('.payment_pend_right_cash_error').delay(5000).fadeOut('slow');
                
                    // alert(data);    
			                $.ajax({
					type: "POST",
					url: "load_counter_sales.php",
					data: data,
					success: function(msg)
					{
                                            if($.trim(msg)=="Please open the shift for the current login"){
                                                
                                                
                                                          $(".payment_pend_right_cash_error").css("display","block");
							  $(".payment_pend_right_cash_error").addClass("popup_validate");
							  $(".payment_pend_right_cash_error").text("Please Open Shift For Current Login");
							  $('.payment_pend_right_cash_error').delay(3000).fadeOut('slow');
                                                          localStorage.double_click_avoid='';
                                                
                                                 $('.submittranscations').removeClass("disablegenerate");
                                                
                                            }else{
                                                
                                               $('#taxdetails_div').text('');  
                                               $('#search').focus();  
                                               $(".counter_settle_popup").css("display","none");
                                               $(".counter_menu_popup_overlay").css("display","none");
                                               $(".confrmation_overlay").css("display","none");
                                               $("#cash").click();
                                               $('#num_sms_new').val(''); 
                                               $('#name_sms_new').val(''); 
                                               $('#search').focus();  
                                               $(".payment_pend_right_cash_error").css("display","block");
					       $(".payment_pend_right_cash_error").addClass("popup_validate");
					       $(".payment_pend_right_cash_error").text("Payment Successfull");
					       $('.payment_pend_right_cash_error').delay(3000).fadeOut('slow');
                                               $('#ly_number').val('');  
                                               $('#sms_bill_settle').prop('checked',false);
                                               
                                            $(".loyalty_main_popup").css("display","none"); 
                                                 
                                            var settle=$('#counter_bill_before_settle').val();
                                            $(".submittranscations").removeClass("disable");
                                      

                                                        if($('.submittranscations').hasClass("disable"))
                                                        {
                                                           
                                                        }else{
                                                            
							var dataString; 
                                                        var bilfinal1=$('#settleingbilno').text();
                                                                         
                                                                        
                                        if(kot_after_settle=='Y'){
                                                                              
                                                                              
                                        var dataString;
                                        dataString = 'value=cs_kotprint_first&bill_cs='+bilfinal1;
                                        $.ajax({
                                        type: "POST",
                                        url: "print_details_kot.php",
                                        data: dataString,
                                        success: function(data1) {
                                             
                                         }
                                        });
                                        
                                         var dataString; 
                                         dataString = 'value=cs_console_kotprint_first&bill_cs='+bilfinal1;
                                         $.ajax({
                                        type: "POST",
                                        url: "print_details_kot.php",
                                        data: dataString,
                                        success: function(data2) {
                                        }
                                        });
                                                                              
                                                                              
                                                                                
									 
                                                                           
                                                                            setTimeout(function(){
                                                                                
                                                                                
                                                                                
                                                                                 //  dataString = 'value=ta_kotprint&gensettle=Y&bilno12='+bilfinal1;
                                                                                
//										  $.ajax({
//										  type: "POST",
//										  url: "print_details_kot.php",
//										  data: dataString,
//										  success: function(data1) { 
//                                                                                      
//                                                                                var kot=$.trim(data1);
//                                                                                   
//										var  dataStringcs = 'value=console_ta&gensettle=Y&bilno='+bilfinal1+'&kotno='+kot;
//                                                                                
//										  $.ajax({
//										  type: "POST",
//										  url: "print_details_kot.php",
//										  data: dataStringcs,
//										  success: function(data2) {
//                                                                                     
//                                                                                      $(".counter_settle_popup").css("display","none");
//                                                                                      $(".counter_menu_popup_overlay").css("display","none");
//                                                                                    
//                                                                                      $(".counter_settle_popup").css("display","none");
//                                                                                      $(".counter_menu_popup_overlay").css("display","none");
//                                                                                      $(".confrmation_overlay").css("display","none");
//                                                                                            
//                                                                                    
//                                                                                      if(localStorage.coming_from=='direct_flow'){
//                                                                                                
//                                                                                      if( $('.cancel_reorder').css('display') == 'block') {  
//                                                                                          
//                                                                                         window.location.href = "counter_sales.php";
//                                                                                      }
//                                                                                            
//                                                                                         $(".counter_settle_popup").css("display","none");
//			                                                                 $(".counter_menu_popup_overlay").css("display","none");
//			                                                                 $(".confrmation_overlay").css("display","none");
//                                                                                       }
//                                                                                       else{
//                                                                                           
//                                                                                          window.location.href = "counter_sales.php?setcscommon=settlecspopup"; 
//                                                                                       }
//                                                                                       
//										  } });
//										  
//                                                                                  
//										  } });
                                                                              
										}, 1500);
                                                                                
                                                                                
                                                                            }else{
                                                                                
                                                                               if(localStorage.coming_from=='direct_flow'){
                                                                                                
                                                                                      if( $('.cancel_reorder').css('display') == 'block') {  
                                                                                          
                                                                                         window.location.href = "counter_sales.php";
                                                                                      }
                                                                                            
                                                                                         $(".counter_settle_popup").css("display","none");
			                                                                 $(".counter_menu_popup_overlay").css("display","none");
			                                                                 $(".confrmation_overlay").css("display","none");
                                                                                       }
                                                                                       else{
                                                                                           
                                                                                          window.location.href = "counter_sales.php?setcscommon=settlecspopup"; 
                                                                                       } 
                                                                            }
                                                                                
                                                                                
                                                                                   $(".counter_settle_popup").css("display","none");
                                                                                   $(".counter_menu_popup_overlay").css("display","none"); 
                                                                                
                                                                                    var dataStringcdw; 
                                                                                    dataStringcdw = 'set=drawer_cs_open_after_settlement';
                                                                                    $.ajax({
                                                                                       type: "POST",
                                                                                       url: "cashdrawer_details.php",
                                                                                       data: dataStringcdw,
                                                                                       success: function(data3) {
                                                                                         
                                                                                         
                                                                                      } });    
                                                                                
                                                                            if($('#pole_on').val()=='Y'){  
                                                                                
                                                                                       var data_pole = "set_pole=pole_display_all&display=thankyou";
                                                                                       $.ajax({
                                                                                       type: "POST",
                                                                                       url: "index.php",
                                                                                       data: data_pole,
                                                                                       success: function(data5) {

                                                                                       }
                                                                                       });
                                                      
                                                                            }
                                                    
                                                   
                                                                            if(settlebill1=='Y'){
                                                                                                    
											  var dataString; 
											  dataString = 'value=ta_billprint&bypass=y&gensettle=Y&bilno='+bilfinal1;
                                                                                       
											  $.ajax({
											  type: "POST",
											  url: "print_details_kot.php",
											  data: dataString,
											  success: function(data2) {
                                                                                              
												data2=data2.trim(); 
												$(".counter_settle_popup").css("display","none");
                                                                                                $(".counter_menu_popup_overlay").css("display","none");
                                                                                                $('#search').focus();
                                                                                                
                                                                                              if(localStorage.coming_from=='direct_flow'){
                                                                                               if( $('.cancel_reorder').css('display') == 'block') {  
                                                                                                   window.location.href = "counter_sales.php";
                                                                                                }
                                                                                                       
                                                                                                $(".counter_settle_popup").css("display","none");
			                                                                        $(".counter_menu_popup_overlay").css("display","none");
			                                                                        $(".confrmation_overlay").css("display","none");
                                                                                               }
                                                                                               else{
                                                                                                 window.location.href = "counter_sales.php?setcscommon=settlecspopup"; 
                                                                                               }
                                                                                               
												
													  
											        } });
												 
                                                                                              }else{
                                                                                                  
                                                                                                  if(localStorage.coming_from=='direct_flow'){
                                                                                                 if( $('.cancel_reorder').css('display') == 'block') {  
                                                                                                   window.location.href = "counter_sales.php";
                                                                                                }
                                                                                                       
                                                                                                $(".counter_settle_popup").css("display","none");
			                                                                        $(".counter_menu_popup_overlay").css("display","none");
			                                                                        $(".confrmation_overlay").css("display","none");
                                                                                               }
                                                                                               else{
                                                                                                 window.location.href = "counter_sales.php?setcscommon=settlecspopup"; 
                                                                                               }
                                                                                               
                                                                                              }
                                                                                              
                                                                                              
                                                                                              
                                                                                              
        $('.submittranscations').addClass("disable");
						 	 
        }
             
                        
       setTimeout(function(){                                         
         $('.submittranscations').removeClass('disablegenerate');    
       }, 3000);                                    
                                                
            
                var  dataString1 = 'set=set_print_option&print_option=Y' ;
                      
		$.ajax({
		type: "POST",
		url: "load_index.php",
		data: dataString1,
		success: function(data) {
                   
                }
                });                                   
                                                
                
        ///lukado setup///
        var bil_lukado=$('#settleingbilno').text();
        setTimeout(function(){
              
        //   $.post("lukado.php", {set:'lukado_bill',mode:'CS',billno:bil_lukado},function(data){ });
        
         }, 1800); 
         
                                     
                                            
                                            
                            }
                                        
			     } });
				
                                
                            }
               } }
                         
           $("#customer_set_data2").css("display","block");
           $("#customer_set_data3").css("display","none");
          
           $("#customer_set_data1").css("display","none");
           $("#customer_set_data4").css("display","none");
        
           $("#customer_set_data5").css("display","block");
                          
           }else{
                                               
                                             
                    $('#selectcreditdetailsname').val('');
                    $('#selectcreditdetailsnumber').val('');
                                           
                    $(".payment_pend_right_cash_error").css("display","block");
		    $(".payment_pend_right_cash_error").addClass("popup_validate");
		    $(".payment_pend_right_cash_error").text("CUSTOMER INVALID");
		    $('.payment_pend_right_cash_error').delay(2000).fadeOut('slow');
                                           
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
		
        }
	});
        
           }
           
          
    if($('#be_search_focus_cs').val()=='search'){
        $('#search').focus();
    }
    else if($('#be_search_focus_cs').val()=='search_code'){
    
     $('#search').focus();
    }else{
   
    $('#search').focus();
    }
           
    $('#customer_set_data5').show();
    $('#customer_set_data5').hide();   
    $('.total_itemcount2').text('0');
    $('.tal_viewtotal').text('0');
    $('.final_show').text('0');
    $('.tax_show').text('0'); 
    $('#dis_pin').val('');
    $('#table_cs').val(''); 
    $('#cspax').val(''); 
    $('#disountamount').val('');
    $('.listorderditems').empty();  
    $('.countergenerate').show();
    $('.settle_direct').show();    
   // $('#taxdetails_div').text('');
    $('#search').focus();
    
 });
 
	/*************** settle ends ***************  */
        
        
 $('#kotcancel_reason_popup_new_cancel_btnbh_cs').click(function(event){
        $('.kotcancel_reason_popup_reprint_cs').hide(); 
        $('.confrmation_overlay_kot').hide();
        
});
        
        
       $('.calculator_settle2').click( function(event) {
           
           event.stopImmediatePropagation();
           
           
         if ($('.kotcancel_reason_popup_reprint_cs').css('display') == 'block') {
             
                $('#focusedtext').val('pinbh');
         }else{
                $('#focusedtext').val('pin_reg');
         }
          
		
             
		var focused=$('#focusedtext').val();
               
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
        
        
      $('#pinbh').keypress(function(ev){
             if(ev.keyCode == 13){
             ev.stopImmediatePropagation();
             $('#kotcancel_reason_popup_new_proceed_btnbh_cs').trigger('click');
            }
   });  
        
        
        $('#kotcancel_reason_popup_new_proceed_btnbh_cs').click(function(event){
            event.stopImmediatePropagation();
            
            
            event.stopImmediatePropagation();
        
        var pin=$("#pinbh").val();
        
        if(pin !=''){
                  
              $.post("load_takeaway.php", {pin:pin,value:'authpincheck',set:'pincheck'},
		function(data)
		{ //alert(data);
                    data=$.trim(data);
                    if(data!="NO")
                    {
                        
                        var spl=data.split('*');
                        
                             if(spl[1]=='reprint:Y'){   
            
            $('.kotcancel_reason_popup_reprint_cs').hide();
                   $('.confrmation_overlay_kot').hide();
             var homed='CS';        
                
                var bill_no=$('.payment_hol_act').attr('billno');
                
                 var dataString; 
		dataString = 'set=reprint_ta_new&homed='+homed+"&billno="+bill_no;
                //alert(dataString);
		$.ajax({
		type: "POST",
		url: "print_details.php",
		data: dataString,
		success: function(data2) {
                  //alert(data2);  
                  
                }
            });
            
            
             }else{
                         $("#pin_errorbh").css("display","block");
			$("#pin_errorbh").text(" NO Permission");
			$("#pin_errorbh").delay(2000).fadeOut('slow');
                        $("#pinbh").val('');
                         $("#pinbh").focus();
                    }
                    }else{
                        $("#pin_errorbh").css("display","block");
			$("#pin_errorbh").text("CODE NOT REGISTERED");
			$("#pin_errorbh").delay(2000).fadeOut('slow');
                        $("#pinbh").val('');
                         $("#pinbh").focus();
                    }
                });
                
                
            }else{
                $("#pin_errorbh").css("display","block");
		$("#pin_errorbh").text("ENTER PIN");
		$("#pin_errorbh").delay(2000).fadeOut('slow');
                $("#pinbh").val('');
                  $("#pinbh").focus();

            }
            
            
            
        });
        
        
         
    
    
    $('#reg_new_btn').click(function(event){
        event.stopImmediatePropagation();
        
        var bill_check=$('.payment_hol_act').attr('billno');
        
        
        if(bill_check!='' && bill_check!='undefined' && bill_check!=undefined){
            
             var datastringnew223="set=check_reorder_settle&bill_check="+bill_check;
      
        $.ajax({
        type: "POST",
        url: "load_counter_sales.php",
        data: datastringnew223,
        success: function(data3)
        { 
         if($.trim(data3)!='yes'){
             
         
         var bill_no=$('.payment_hol_act').attr('billno');
         var loy_id=$('.payment_hol_act').attr('loy_id');
                    var dataString; 
		dataString = "set=regen_ta_cs&bill="+bill_no+"&loy_id="+loy_id;
               // alert(dataString);
		$.ajax({
		type: "POST",
		url: "load_counter_sales.php",
		data: dataString,
		success: function(data2) {
                 
                 
                 window.location.href='counter_sales.php';
                 
                  
                }
            });
        }else{
                                                           $('.alert_error_popup_all_in_one').show();
                        $('.alert_error_popup_all_in_one').text('CLEAR CART OF REORDER');
                        $('.alert_error_popup_all_in_one').delay(1000).fadeOut('slow');
                        
                                                        }
                                                    
                                                    }
                                                });
        //$('.kotcancel_reason_popup_regen_cs').show();
        
       //$('.confrmation_overlay_kot').show();
       // $("#pin_reg").val('');
       // $("#pin_reg").focus();
       
        }else{
            $('.alert_error_popup_all_in_one').show();
                        $('.alert_error_popup_all_in_one').text('SELECT BILL');
                        $('.alert_error_popup_all_in_one').delay(1000).fadeOut('slow');
            
        }
       
       
    });
     
     
   $('#reg_cancel').click(function(event){  
     
     $('.kotcancel_reason_popup_regen_cs').hide();
        
       $('.confrmation_overlay_kot').hide();
        $("#pin_reg").val('');
        $("#pinbh").focus();
        
      });
               
        
        $('#reg_proceed').click(function(event){  
            
            
        event.stopImmediatePropagation();
        
        var pin=$("#pin_reg").val();
        
        if(pin !=''){
                  
              $.post("load_counter_sales.php", {pin:pin,value:'authpincheck',set:'pincheck'},
		function(data)
		{ //alert(data);
                    data=$.trim(data);
                    if(data!="NO")
                    {
                        
                        var spl=data.split('*');
                        //alert(spl[2]);
                             if(spl[2]=='regen:Y'){     
        
                    $('.confrmation_overlay_kot').hide();
                   $('.kotcancel_reason_popup_regen_cs').hide();
        
           
          var bill_no=$('.payment_hol_act').attr('billno');
                    var dataString; 
		dataString = "set=regen_ta_cs&bill="+bill_no;
               // alert(dataString);
		$.ajax({
		type: "POST",
		url: "load_counter_sales.php",
		data: dataString,
		success: function(data2) {
                 
                 
                 window.location.href='counter_sales.php';
                 
                  
                }
            });
    
            
            
            
            
            }else{
                         $("#pin_error_reg").css("display","block");
			$("#pin_error_reg").text(" NO Permission");
			$("#pin_error_reg").delay(2000).fadeOut('slow');
                        $("#pin_reg").val('');
                         $("#pin_reg").focus();
                    }
                    }else{
                        $("#pin_error_reg").css("display","block");
			$("#pin_error_reg").text("CODE NOT REGISTERED");
			$("#pin_error_reg").delay(2000).fadeOut('slow');
                        $("#pin_reg").val('');
                         $("#pin_reg").focus();
                    }
                });
                
                
            }else{
                $("#pin_error_reg").css("display","block");
		$("#pin_error_reg").text("ENTER PIN");
		$("#pin_error_reg").delay(2000).fadeOut('slow');
                $("#pin_reg").val('');
                  $("#pin_reg").focus();

            }
            
            
            
            
        });
        
        
        $('#cs_reprint_new').click( function(event) {//alert('h');
            
             $('.kotcancel_reason_popup_reprint_cs').show();
           
		event.stopImmediatePropagation();
                 $('.confrmation_overlay_kot').show();
           
                   $("#pinbh").val('');
                 $("#pinbh").focus();
        });
        
        
        
	$('.paymenteachnew').click( function(event) {//alert('h');
            
            
           
		event.stopImmediatePropagation();
                
                $('#kot_cancel_cs').show();
                 $('#cs_reprint_new').show();
                
		if($(this).hasClass('payment_hol_act'))
		{
			$(this).removeClass('payment_hol_act')
                         
                        
		}else
		{
			$('.paymenteachnew').removeClass('payment_hol_act')
			$(this).addClass('payment_hol_act');
			var bilno=$(this).attr('billno');//alert(bilno);
			 
			var dataString;
			dataString = 'value=loadpaymentdetails&billid=' + bilno;
	  		var request= $.ajax({
			type: "POST",
			url: "load_counter_sales.php",
			data: dataString,
			success: function(data) {
				 $('.loadpaymetdetls').html(data);
			}
	 	 });
		 data = null;
		 dataString = null;
		request.onreadystatechange = null;
		request.abort = null;
		request = null;	
	  return false;
			
		}
		
	});
        
        
        $('.pin_close_auth').click( function(){
            
            $('.payment_auth_pop').hide();
             $('.confrmation_overlay_auth').hide();
            
            $('#pin_pay').val('');
            $('#cash').click();
        });
        
        $('#pin_pay').keypress(function(ev){
             if(ev.keyCode == 13){
             ev.stopImmediatePropagation();
             $('.pin_pay_auth').trigger('click');
            }
   });
   
   $('#pin_reg').keypress(function(ev){
             if(ev.keyCode == 13){
             ev.stopImmediatePropagation();
             $('#reg_proceed').trigger('click');
            }
   });
   
   $(".pin_pay_auth").unbind().click(function(event){
        
      event.stopImmediatePropagation();
      var pin =  $('#pin_pay').val();
       if(pin!=''){
            
             if( $('.complimentrary_cc').css('display') == 'block'){
                $.post("load_counter_sales.php", {pin:pin,value:'authpincheck',set:'pincheck'},
                            function(data){
                                data=$.trim(data);
                                if(data!="NO"){
                                var spl=data.split('*');
                                 
                                if(spl[10]=='comp:Y'){
                                
                       $('#code_comp_credit').val(spl[11]);             
              $('.payment_auth_pop').hide();
                     $('.confrmation_overlay_auth').hide();
                   
                    
                     $('#loyaltydiv').hide();
                 $('#countersel').attr("disabled", false);  
                             $('#currencyinput').attr("disabled", false);
			$(".pop_payment_mode_sel_btn").removeClass('mode_sel_btn_act');
		$('#complimentary').addClass('mode_sel_btn_act');
			$(".cash_cc").hide(500);
                  $(".cash_cc").hide(500);
                  $(".upi_cc").hide(500);
                    $(".credit_cc").hide(500);
					$(".credit_cc_normal").hide(500);
                    $(".coupon_cc").hide(500);
					$(".voucher_cc").hide(500);
					$(".cheque_cc").hide(500);
					$(".credit_type").hide(500);
					$(".complimentrary_management").hide(500);
					$(".complimentrary_cc").show(500);
					$('.paid_amount_cc').hide(500);
					$('.paid_amount_cc_credit').hide(500);
	        		$('#ta_staffsubmit').hide();
					$('#ta_staffclose').show();
                                        
                                         $("#paidamount").val("");
                                          $("#balanceamout").val("");
                                           $("#transcationid").val("");
                                            $("#transbal").val("");
                                           $("#cheqamount").val("");
                                          $("#cheqbal").val("");
                                           $("#currencyinput").val("");
                                              $("#completext").val("");
                                              $("#completext").focus();
                                    }else{
                                        $("#pin_error_split").css("display","block");
					$("#pin_error_split").text("No Permission");
					$("#pin_error_split").delay(2000).fadeOut('slow');
                                        $("#pin_pay").val('');
                                        $("#pin_pay").focus();
                                    }    
                                }else{
                                    $("#pin_error_split").css("display","block");
                                    $("#pin_error_split").text("CODE IS NOT REGISTERED");
                                    $("#pin_error_split").delay(2000).fadeOut('slow');
                                    $("#pin_pay").val('');
                                    $("#pin_pay").focus();
						
				}
                            });
                 
             }else  if( $('.paid_amount_cc_credit').css('display') == 'block'){
               $.post("load_counter_sales.php", {pin:pin,value:'authpincheck',set:'pincheck'},
                            function(data){
                            data=$.trim(data);
                            if(data!="NO"){
                            var spl=data.split('*');
                          
                            if(spl[9]=='credit:Y'){
            $('#code_comp_credit').val(spl[11]);    
             $('.payment_auth_pop').hide();
                     $('.confrmation_overlay_auth').hide();
                   
                   
                     
                   $('#loyaltydiv').hide();
                    $('#countersel').attr("disabled", false);  
                             $('#currencyinput').attr("disabled", false);
			$(".pop_payment_mode_sel_btn").removeClass('mode_sel_btn_act');
		$('#credit_person').addClass('mode_sel_btn_act');
			$(".cash_cc").hide(500);
                        $(".upi_cc").hide(500);
                    $(".credit_cc").hide(500);
					$(".credit_cc_normal").hide(500);
                    $(".coupon_cc").hide(500);
					$(".voucher_cc").hide(500);
					$(".cheque_cc").hide(500);
					$(".complimentrary_management").hide(500);
					$(".complimentrary_cc").hide(500);
					$(".credit_type").show(500);
					$('.paid_amount_cc').hide(500);
					$('.paid_amount_cc_credit').show(500);
	        		$('#ta_staffsubmit').hide();
					$('#ta_staffclose').show();
                                         $("#paidamount").val("");
                                          $("#balanceamout").val("");
                                           $("#transcationid").val("");
                                            $("#transbal").val("");
                                           $("#cheqamount").val("");
                                          $("#cheqbal").val("");
                                           $("#currencyinput").val("");
                                              $("#completext").val("");
                                              
                                              $("#paidamount_credit").val("");
                                           $("#balanceamout_credit").val("");
                                             $("#amount_credit").val("");
                                                $("#selectcreditypes").val("");
                                                $("#selectcreditdetails").val("");
                                                
                                      var on=$('#curshowfocus').val();
                                      
                                     if(on=="Y"){
                                       
                                          
                                           $("#paidamount_credit").val('0');
                                           $('#focusedtext').val('currencyinput1');
                                           $('#cs_currency_credit').show();
                                            $("#currencyinput1").focus();
                                            $('#paidamount_credit').prop('disabled',true);
                                      }else{
                                           $("#paidamount_credit").val('0');
                                           $("#paidamount_credit").focus();
                                           $('#focusedtext').val('paidamount_credit');
                                            $('#cs_currency_credit').hide();
                                             $('#paidamount_credit').prop('disabled',false);
                                      }
            
                                    }else{
                                        $("#pin_error_split").css("display","block");
					$("#pin_error_split").text("No Permission");
					$("#pin_error_split").delay(2000).fadeOut('slow');
                                        $("#pin_pay").val('');
                                        $("#pin_pay").focus();
                                    }    
                                }else{
                                    $("#pin_error_split").css("display","block");
                                    $("#pin_error_split").text("CODE IS NOT REGISTERED");
                                    $("#pin_error_split").delay(2000).fadeOut('slow');
                                    $("#pin_pay").val('');
                                    $("#pin_pay").focus();
						
				}
                            });
            
             }
            
        
    
                 }else{
                        $("#pin_error_split").css("display","block");
			$("#pin_error_split").text("ENTER YOUR PIN ");
			$("#pin_error_split").delay(2000).fadeOut('slow');
                        $("#pin_pay").focus();
                 }
  
  
    });
   
   $('.calculator_settle_set').click( function(event) {
        
		event.stopImmediatePropagation();
                
             
             $('#focusedtext_set').val('pin_set'); 
           
               
		var focused=$('#focusedtext_set').val();
                //alert(focused);
                 
		var calval=($(this).text());
		
                
                    var org='';          
                    if($('#'+focused).val()!='' && $('#'+focused).val()!=0){            
                        org=$('#'+focused).val();
                    }
                
			if(calval>=0)
			{
                             if(org.length < 4){
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
   
   $('.calculator_settle_auth').click( function(event) {
        
		event.stopImmediatePropagation();
                
              if( $('.complimentrary_cc').css('display') == 'block'){
                   
         $('#focusedtext').val('pin_pay'); 
            }
              else if( $('.head_change').text() == 'Credit Authorization'){
         
             $('#focusedtext').val('pin_pay'); 
           }
               
		var focused=$('#focusedtext').val();
                //alert(focused);
                 
		var calval=($(this).text());
		
             
              if(calval==2000 || calval==500 || calval==200 || calval==100 || calval==50 || calval==20 || calval==10  || calval==1000  ){
                  $('#'+focused).val("");
               }
        
                   var focusedsplit=focused.substring(0,6);
               
             // alert(focused);
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
                
                
                    var org='';          
                    if($('#'+focused).val()!='' && $('#'+focused).val()!=0){            
                        org=$('#'+focused).val();
                    }
                
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
   
   
   
	
	$('.calculator_settle').click( function(event) { 
        
		event.stopImmediatePropagation();
                
           if($('.kotcancel_reason_popup_new').css('display') == 'block')
                { 
                 $('#focusedtext').val('pin');
                 
               } 
               
		var focused=$('#focusedtext').val();
                //alert(focused);
                 
		var calval=($(this).text());
		
             
              if(calval==2000 || calval==500 || calval==200 || calval==100 || calval==50 || calval==20 || calval==10  || calval==1000  ){
                  $('#'+focused).val("");
               }
        
             
             
                   var focusedsplit=focused.substring(0,6);
               
             // alert(focused);
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
                
                
                
                
                
                    var org='';          
                    if($('#'+focused).val()!='' && $('#'+focused).val()!=0){            
                        org=$('#'+focused).val();
                    }
                
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
                
                
		
		  if($('.discount_after_cc:visible').length == 1){ 
               var typ=$('#dis_after_type').val();
               var dis=$('#dis_after_manual').val();
                       
                         var bill_final_amount=$('#grandtotal').text().replace(',','');
                         
                        if( (dis>=100 && typ=='P') || (typ=='V' && dis>=parseFloat(bill_final_amount ) )){
                          $('#dis_after_manual').val('');
                        }
                        
            }  
                       
                
                
		
	});
        
        $('.confirmkotok_cs').click( function(event) {
            
            var msg=$('#kotfailmsg_cs').html();
          
          
             var dataString_log ='set_log=kotconfirmbylogin&failmsg='+msg;
             $.ajax({
             type: "POST",
             url: "menu_order.php",
             data: dataString_log,
             success: function(data) {
             
             }
             });
            
             $('.kotconfirmpopup_cs').css('display','none');   
                    $(".confrmation_overlay").css("display","none");
                var shw=$('#curshowfocus').val();
             
                         if(shw=="Y"){
                       $('#paidamount').prop('disabled',true);
                        
    
            
             var selfocs=$('#curshow').val();
           var sel=$('#bscur').val();
     
        
           var datastringnew22="set5=cat5&idofcur5="+sel;
      
       $.ajax({
        type: "POST",
        url: "counter_sales.php",
        data: datastringnew22,
        success: function(data)
        {
            //$('#hid').val(data);
       //alert(data);
     $("#divall").load(location.href + " #divall");
   
       
        }
        
    });
                         }else{
                              //$('#paidamount').val('');  
                               
                          $('#paidamount').focus();   
                          enterbalance();
                            $('.payment_pend_right_cash_error ').html('');  
                         }      
            var decimal=$("#decimal").val();
            //alert(decimal);
		event.stopImmediatePropagation();
	if($('.paymenteachnew').hasClass('payment_hol_act'))
		{
			$('.submitbill').val($('.payment_hol_act').attr('billno'));
			var subt=$('.payment_hol_act').attr('subt');
			var servt=$('.payment_hol_act').attr('servt');
			var vat=$('.payment_hol_act').attr('vat');
			var amount=$('.payment_hol_act').attr('amount');
			var totaldisc=$('.payment_hol_act').attr('disc');//subt servt vat amount
			//$('#paidamount').focus();
			
		$('#settleingbilno').text($('.submitbill').val());
		$('#final').text(parseFloat(subt).toFixed(decimal));
		$('#servtax').text(parseFloat(servt).toFixed(decimal));
		$('#vats').text(parseFloat(vat).toFixed(decimal));
		$('#grandtotal').text(parseFloat(amount).toFixed(decimal));
		if(totaldisc=="")
		{totaldisc="0.00";
		}
		$('#totaldisc').text(parseFloat(totaldisc).toFixed(decimal));
			$(".counter_sl_payment_hist_pop").css("display","none");
			$(".counter_settle_popup").css("display","block");
                        $('#transbal').val('');
			$(".counter_menu_popup_overlay").css("display","block");
			$('#paidamount').focus();
                        $('#paidamount').select();
                        
                     
                    
			var dataString; 
									  dataString = 'set=drawer_open';
									   $.ajax({
									  type: "POST",
									  url: "cashdrawer_details.php",
									  data: dataString,
									  success: function(data3) {//alert("ok3");
										  data3=data3.trim();//alert(data3);
										  /*if(data2=="ok")
										  {
											
									  
										  }*/
										  
										  }
									  });
		}else
		{
		$(".errorpaymentpop").css("display","block");
			//$(".errorpaymentpop").addClass("popup_validate");
			$(".errorpaymentpop").text("Sorry");
			$('.errorpaymentpop').delay(2000).fadeOut('slow');
		}
        });
        
         $('.confirmkotclose_cs').click( function(event) {
             $('.kotconfirmpopup_cs').css('display','none');   
                    $(".confrmation_overlay").css("display","none");
                       
                    
        });
        
$('.paysubmitbut').click( function(event) {
            
            
        var bill_check=$('.payment_hol_act').attr('billno');
            
        var datastringnew223="set=check_reorder_settle&bill_check="+bill_check;
      
        $.ajax({
        type: "POST",
        url: "load_counter_sales.php",
        data: datastringnew223,
        success: function(data3)
        {
            
       if($.trim(data3)!='yes'){
            
       var crd_view= $('#credit_view_per').val();
       var comp_view= $('#comp_view_per').val();
       if(crd_view=="N"){
        $('#credit_person').hide();
       }
       
       if(comp_view=="N"){
        $('#complimentary').hide();
       }
            
         
        var shw=$('#curshowfocus').val();
        if(shw=="Y"){
            
             $('#paidamount').prop('disabled',true);
             var selfocs=$('#curshow').val();
             var sel=$('#bscur').val();
             var datastringnew22="set5=cat5&idofcur5="+sel;
      
        $.ajax({
        type: "POST",
        url: "counter_sales.php",
        data: datastringnew22,
        success: function(data)
        {
          
        }  });
        
      
        }else{
        $('#paidamount').focus();   
        //enterbalance();
        $('.payment_pend_right_cash_error ').html('');  
        }      
        var decimal=$("#decimal").val();
       
	event.stopImmediatePropagation();
	if($('.paymenteachnew').hasClass('payment_hol_act'))
		{
			$('.submitbill').val($('.payment_hol_act').attr('billno'));
			var subt=$('.payment_hol_act').attr('subt');
			var amount=$('.payment_hol_act').attr('amount');
                        var tip_amount=$('.payment_hol_act').attr('tips');
                        var tip_mode=$('#tip_pay_mode').val();
			var totaldisc=$('.payment_hol_act').attr('disc');//subt servt vat amount
			var taxnames=$('.payment_hol_act').attr('tax_name').split('<>');
                        var taxvalues=$('.payment_hol_act').attr('tax_value').split('<>');
                        
			var bill_no=$('.submitbill').val();
                        var tot_final=parseFloat(amount).toFixed(decimal);
                        
                        
                        if(totaldisc>0){
                                                    var dataString77 = 'set=discount_bill_format&billno='+bill_no+"&mode=CS";
                                                    $.ajax({
                                                        type: "POST",
                                                        url: "load_index.php",
                                                        data: dataString77,
                                                        success: function(data3) {
                                                     
                                                        var dis_ld= data3.trim().split(","); 
                                                        
                                                      if(dis_ld[2]!=''){
                                                        $('#dis_details_new').text(dis_ld[0]+' ['+dis_ld[2]+' : '+dis_ld[1]+']');
                                                      }else{
                                                        $('#dis_details_new').text('')  ;
                                                      }
                                                        
                                                    } });
                                                
                        }else{
                          $('#dis_details_new').text('');
                        }
                        
                        
                $('#paidamount').val(parseFloat(amount).toFixed(decimal).replace(",",''));
                $('#balanceamout').val('0.000');
                $('#paidamount').select() ;
                $('#grand_org').val(parseFloat(amount).toFixed(decimal));
		$('#settleingbilno').text($('.submitbill').val());
		$('#final').text(parseFloat(subt).toFixed(decimal));
		$('#grandtotal').text(parseFloat(amount).toFixed(decimal));
                $('#tip_amount').val(parseFloat(tip_amount).toFixed(decimal));
                
                if(taxnames!=''){
                for(var j=0;j<taxnames.length;j++){
                   
                    $("#taxdetails_div").append('<div style="width:100%; " class="lable_counter_paymnet_cc counter_right_lable" id='+taxnames[j]+'>'+taxnames[j]+':<span >'+parseFloat(taxvalues[j]).toFixed(decimal)+'</span></div>') ;
                 }
                }
		if(totaldisc=="")
		{totaldisc="0.00";
		}
		$('#totaldisc').text(parseFloat(totaldisc).toFixed(decimal));
		$(".counter_sl_payment_hist_pop").css("display","none");
		$(".counter_settle_popup").css("display","block");
                $('#transbal').val('');
		$(".counter_menu_popup_overlay").css("display","block");
		$('#paidamount').focus();
                $('#paidamount').select();
                $("#loyalty_btn").click();   
                        
                        
                        
            var dataString_log5 ='set=check_discount_after&billno='+bill_no;
       
            $.ajax({
            type: "POST",
            url: "load_counter_sales.php",
            data: dataString_log5,
            success: function(billamount5) {
                
                var ds=$.trim(billamount5).split('*');
              
                if(ds[0]=='yes'){
                    
                    $('#discount_after_bill_btn').hide();
                }else{
                     $('#discount_after_bill_btn').show();
               }
               
               if(ds[1]>0){
               $('#dis_item_new').text(parseFloat(ds[1]).toFixed(decimal));
           }else{
               var tt_new=0;
               $('#dis_item_new').text(tt_new.toFixed(decimal));  
           }
                
            }
        });             
                        
                        
                        
                        var data_pole = 'set_pole=pole_display_all&pole_bill='+bill_no+"&pole_amount="+tot_final+"&display=show";
			$.ajax({
			type: "POST",
			url: "index.php",
			data: data_pole,
			success: function(data5) {
			
			}
			});
                        
			var dataString; 
			dataString = 'set=drawer_cs_open_settlepopup';
			$.ajax({
			type: "POST",
			url: "cashdrawer_details.php",
			data: dataString,
			success: function(data3) {
			data3=data3.trim();
			}
			});
                        
		}else
		{
		$(".errorpaymentpop").css("display","block");
			
		$(".errorpaymentpop").text("No Bill");
		$('.errorpaymentpop').delay(2000).fadeOut('slow');
		}
	
        
        }else
	{
	  $('.alert_error_popup_all_in_one').show();
          $('.alert_error_popup_all_in_one').text('CLEAR CART OF REORDER');
          $('.alert_error_popup_all_in_one').delay(1000).fadeOut('slow');
	}
        }
        
        
        });
        
        });
        
        
  $('input').click( function(event) {
            
		//event.stopImmediatePropagation();
		//if (event.keyCode != 13) {
			// if(!$(this).hasAttr('readonly')) {
				var redo=$(this).attr('readonly');
				if(redo!="readonly")
				{
		var fcsed1=$(this).attr('id');
		$('#focusedtext').val(fcsed1);
				}
			// }
		//}
	
});

	
$('.confirmholdok').click(function (event) {
		event.stopImmediatePropagation();
				var request = $.ajax({
					url: "load_counter_sales.php",
					method: "POST",
					data: {value:'addhold'},
					dataType: "html"
				  });
				   
				  request.done(function( msg ) {
					
					window.location="counter_sales.php";
					
				  });
				  
				  data = null;
					msg=null;
				  request.onreadystatechange = null;
				  request.abort = null;
				  request = null;
	});	
	
	$('.confirmholdccl').click(function (event) {
	event.stopImmediatePropagation();
			$("#confirmhold").css("display","none");
			$(".confrmation_overlay").css("display","none");
	});	
	$('.holdorders').click(function (event) {
            
              var cs_check=$('.total_itemcount2').text();
     
      if(cs_check>0){
	if($('tr').hasClass('eachitem_counter') || $('.preference_table'))
		{
			event.stopImmediatePropagation();
			$("#confirmhold").css("display","block");
			$(".confrmation_overlay").css("display","block");
			
			
			/*var request = $.ajax({
					url: "load_counter_sales.php",
					method: "POST",
					data: {value:'addhold'},
					dataType: "html"
				  });
				   
				  request.done(function( msg ) {
					
					window.location="counter_sales.php";
					
				  });
				  
				  data = null;
					msg=null;
				  request.onreadystatechange = null;
				  request.abort = null;
				  request = null;*/
			
			
		}else
		{
		 $('.ta_errormsg').css("display",'block');
			  $('.ta_errormsg').text("Nothing to Hold...");
			  $('.ta_errormsg').delay(2000).fadeOut('slow');
		}
                
                
                }else{
            
        //alert('No items to Delete')
         $('.alert_error_popup_all_in_one').show();
                                    
                        $('.alert_error_popup_all_in_one').text('No items to hold');
                        $('.alert_error_popup_all_in_one').delay(1000).fadeOut('slow'); 
      }
	});
        
    ////******************************COMBO STARTS ***************************************///
        $('#combo_display_click').click(function(){
            $('#combo_display_click').hide();
            $('#back_to_maincategory').show();
            $('.main_category_list').removeClass('main_category_list_act');
            $('.take_left_main_list').empty();
            $('#top_head').text('Combo List');
            $('#ta_loadmenuitems').empty();
            $('#ta_loadsubcat').empty();
            var dataString = 'value=load_combos';
            $.ajax({
                type: "POST",
                url: "load_counter_sales.php",
                data: dataString,
                success: function(data) {
                    
                   $('.take_left_main_list').html(data);
                   var combo_name_id=$('.combo_name_selection_click').attr('combo_name_id');
                   //alert(combo_name_id);
                   var dataString = 'value=load_combo_menus&combo_name_id='+combo_name_id;
                    $.ajax({
                        type: "POST",
                        url: "load_counter_sales.php",
                        data: dataString,
                        success: function(data1) {
                            
                           $('#ta_loadmenuitems').html(data1);     
                        }
                    });
                }
            });
        });
        
        $('#back_to_maincategory').click(function(){
          location.reload();  
        });
        
        $('.combo_name_selection_click').click(function(){
            
            $('.main_category_list').removeClass('main_category_list_act');
            $(this).find('.main_category_list').addClass('main_category_list_act');
            //$('#load_menuitems').empty();
            var combo_name_id=$(this).attr('combo_name_id');

            var dataString = 'value=load_combo_menus&combo_name_id='+combo_name_id;
                $.ajax({
                    type: "POST",
                    url: "load_counter_sales.php",
                    data: dataString,
                    success: function(data) {
                       $('#ta_loadmenuitems').html(data);     
                    }
                });
        });
         $('.preference_table').click(function () {
             
                if($(this).find('.combo_menu_div') && sessionStorage.clickdisable_cs!=1){
                   var status=$(this).find('.combo_menu_div').attr('status');
                   var id=$(this).find('.combo_menu_div').attr('id');
                   var parent_div_id=$(this).attr('id');
                   var sts=status.trim();
                   var combo_pack_id=$(this).find('.combo_menu_div').attr('combo_pack_id');
                   var combo_pack_qty=$(this).find('.combo_menu_div').attr('combo_pack_qty');
                   var combo_preference;
                   localStorage.cod_count_combo_ordering=$(this).find('.combo_menu_div').attr('cod_count_combo_ordering');
                   var dataString = 'set=load_combo_ordering_popup_for_edit&combo_pack_id='+combo_pack_id+"&combo_pack_qty="+combo_pack_qty;
                        $.ajax({
                            type: "POST",
                            url: "combo_ordering_popup_cs.php",
                            data: dataString,
                            success: function(data) {
                                $("#combo_ordering_popup").css('display','block');
                                $("#combo_ordering_popup").html(data);
                                $('.qty_minus_btn').hide();
                                $('.qty_plus_btn').hide();
                                $('.option_checkboxes').prop('disabled',true);
                                $('.option_checkboxes').prop('checked',false);
                                 $('.option_menu_qty_display').val(0);
                                $('.cart_menu_list[id1='+parent_div_id+']').each(function(){
                                    var menuid=$(this).attr('menuid');
                                    var menuqty=$(this).attr('menuqty');
                                    var menutype=$(this).attr('menu_type');
                                    
                                    combo_preference=$('.cart_menu_preference[id1='+parent_div_id+']').text();
                                    
                                    if($('.menu_selection_check[value1='+menuid+']')){
                                        $('.menu_selection_check[value1='+menuid+']').prop('checked',true);
                                        $('.menu_qty_display[value1='+menuid+']').val(menuqty);
                                        
                                    }
                                    if(menutype=='Option'){
                                       if($('.option_checkboxes[value1='+menuid+']')){
                                        $('.option_checkboxes[value1='+menuid+']').prop('checked',true);
                                        $('.option_menu_qty_display[value1='+menuid+']').val(menuqty);
                                        
                                        } 
                                    }
                                    
                                });
                                
                                $('#manual_preference').val(combo_preference);
                                localStorage.combo_preference=$.trim(combo_preference,',');
//                                
                                $('#combo_qty_select').val(combo_pack_qty);
                                $('#combo_qty_select').focus();
                            }
                        });
                }
            });
        
        
    ////******************************COMBO ENDS ***************************************///      
        
      
        
        
        
        
		});
$(document).keyup(function(e){
    if (e.keyCode == 27) {
        
        
 if($('.loyalty_main_popup').css('display') == 'block')
{  
     $('.closedisount').click(); 
     $('.auothorize_popup').hide();
     $('.loyalty_main_popup').hide();
}
        
        
        
  if($('.counter_menu_popup:visible').length == 1)
    {  
                $(".counter_menu_popup_overlay").css("display","none");
                $(".new_overlay").css("display","none");
                $('.counter_menu_popup').css("display","none");
                var focus_on=$('#be_search_focus_cs').val();
                          if(focus_on=='search'){
                          $('#'+focus_on).focus();
                          }
                          else if(focus_on=='search_code'){
                          //$('#codesrch_c').focus();
                            $('#search').focus();
                          }else{
                       //   $('#search_barcode').focus();
                            $('#search').focus();
                          }
 }
 
 if($('#confirmhold:visible').length == 1)
  {  
                $("#confirmhold").hide();
                $(".confrmation_overlay").css("display","none");
  }
  
  if($('.kotconfirmpopup_cs_bill:visible').length == 1)
  {  
                $(".kotconfirmpopup_cs_bill").css("display","none");
                $(".confrmation_overlay").css("display","none");
                $(".countergenerate").css("display","block");
                $('.settle_direct').css("display","block");
  }
            
  if($('.kotconfirmpopup_cs_submit:visible').length == 1)
  {  
                $(".kotconfirmpopup_cs_submit").css("display","none");
                $(".counter_menu_popup_overlay").css("display","none");
                $(".confrmation_overlay").css("display","none");
                window.location.href = "counter_sales.php?setcscommon=settlecspopup";  
                
  }
  
  if($('.counter_settle_popup:visible').length == 1)
  { 
                $(".counter_settle_popup").css("display","none");
                $(".confrmation_overlay").css("display","none");
                window.location.href = "counter_sales.php?setcscommon=settlecspopup";  
  }
  
  if($('.counter_sl_payment_hist_pop:visible').length == 1)
  {  
                $(".counter_sl_payment_hist_pop").css("display","none");
                $(".counter_menu_popup_overlay").css("display","none");
  }  
  
 if($('.kotcancel_reason_popup_new:visible').length == 1)
 {  
                $(".kotcancel_reason_popup_new").css("display","none");
                $("#counter_menu_popup_overlay").css("display","none");
                 window.location.href = "counter_sales.php?setcscommon=settlecspopup";
  }
            
            
  }
    
  if(e.keyCode==13){
        
    if($('#multi_cardamount').hasClass('focused')){
            
            if(parseFloat($('#transbal').val())==0){
                $('.submittranscations').click();
            }
    }
    
 }
    
    
});		


 function load_combo_ordering_popup(combo_pack_id) {
        
        localStorage.cod_count_combo_ordering='';
       
        var dataString = 'set=load_combo_ordering_popup&combo_pack_id='+combo_pack_id;
        $.ajax({
            type: "POST",
            url: "combo_ordering_popup_cs.php",
            data: dataString,
            success: function(data) {
                $("#combo_ordering_popup").css('display','block');
                $("#combo_ordering_popup").html(data);     
            }
        });
        
    };
                
                
                
function calculatetotal()
 {
			var vals=0;
                        var decimal=$('#decimal').val();
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
			$('#grandtotal').text(tot.toFixed(decimal));
 }
 
  function discunt()
	{
			var tt=0;
			var gd=parseFloat($('#grandtotal').text().replace(/,/g, ""));
			var dc=parseFloat($('#discval').val().replace(/,/g, ""));
			tt = parseFloat(gd -  dc); 
			
			document.getElementById("grandtotal").innerHTML=tt.toFixed(2);
			
 }
 
 function couponamountchange(e)
 { 
			var tt=0;
			var gd=parseFloat($('#grandtotal').text().replace(/,/g, ""));
			var dc=parseFloat($('#coupamount').val().replace(/,/g, ""));
                        var decimal=$('#decimal').val();
                        
                        
                    
                
                if($('#pole_on').val()=='Y'){             
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
                  
     }
                  
                        //alert(gd);
                        //alert(dc);
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
                  
                   
                
                if($('#pole_on').val()=='Y'){ 
                  var data_pole = 'set_pole_paid=pole_display_paid&paid='+paid_display+"&balance="+bal_display+"&mode=coupon";
			$.ajax({
			type: "POST",
			url: "index.php",
			data: data_pole,
			success: function(data5) {
			
			}
			});
                    }     
                        
			}else
			{
			document.getElementById("coupbal").value=tt.toFixed(decimal);
                        
                         var paid_display=dc.toFixed(decimal);
                        var bal_display=tt.toFixed(decimal);
                        
                         if($('#pole_on').val()=='Y'){ 
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
  }
                
   function comp_text(){
       
       var com=$('#completext').val();
      if($('#pole_on').val()=='Y'){ 
        var data_pole = 'set_pole_paid=pole_display_paid&paid='+com+"&mode=complimentary";
			$.ajax({
			type: "POST",
			url: "index.php",
			data: data_pole,
			success: function(data5) {
			
			}
			});
                    }            
   }  
                
 function cheqamountchange(e)
	{//if(e.keyCode === 13){
                      $('#focusedtext').val('cheqamount');
                      
                      
                      
			 $('#currencyinput').val('');
                    $('#paidamount').val('');
                    $('#balanceamout').val('');
                    
			var tt=0;
			var gd=parseFloat($('#grandtotal').text().replace(/,/g, ""));
			var dc=parseFloat($('#cheqamount').val().replace(/,/g, ""));
			tt = parseFloat(gd -  dc); 
                        
                         if(dc==gd){
                           
                             $('#countersel').attr("disabled", true);
                      $('#currencyinput').attr("disabled", true);
                        }else
                        {
                            $('#countersel').attr("disabled", false);  
                             $('#currencyinput').attr("disabled", false);
                        }
                        
                        
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
			//$('#paidamount').focus();
                        //$('#paidamount').select();
                        
			var paid_display=dc.toFixed(decimal);
                        var bal_display=tt.toFixed(decimal);
                        
                         if($('#pole_on').val()=='Y'){ 
                        var data_pole = 'set_pole_paid=pole_display_paid&paid='+paid_display+"&balance="+bal_display+"&mode=cheque";
			$.ajax({
			type: "POST",
			url: "index.php",
			data: data_pole,
			success: function(data5) {
			
			}
			});
                        
                        }
         
			if(bl=='0.00')
			{
				$('#paidamount').val('0');
				$('#balanceamout').val('0');
				//$('#balanceamout').focus();
			}
			
			}
		//}
 }
 
 function transamountchange(e)
  {  
                    
                       $('#focusedtext').val('transcationid');
                    $('#currencyinput').val('');
                    $('#paidamount').val('');
                    $('#balanceamout').val('');
                    
                    //if(e.keyCode === 13){
			var tt=0;
			var gd=parseFloat($('#grandtotal').text().replace(/,/g, ""));
			var dc=parseFloat($('#transcationid').val().replace(/,/g, ""));
			tt = parseFloat(gd -  dc);
                        if(dc==gd){
                           
                             $('#countersel').attr("disabled", true);
                      $('#currencyinput').attr("disabled", true);
                        }else
                        {
                            $('#countersel').attr("disabled", false);  
                             $('#currencyinput').attr("disabled", false);
                        }
			if(tt<0)
			{
				 $(".payment_pend_right_cash_error").css("display","block");
				 $(".payment_pend_right_cash_error").addClass("popup_validate");
			 	$(".payment_pend_right_cash_error").text("Incorrect Transcation Amount");
				$('.payment_pend_right_cash_error').delay(2000).fadeOut('slow');
				
				$("#paidamount").val('0');
				$("#balanceamout").val('0');
				$("#transbal").val('');
                                $("#transcationid").val('');
				//$('#balanceamout').focus();
			}else
			{
				
			document.getElementById("transbal").value=tt.toFixed(2);
			if(tt==0)
			{
				$("#paidamount").val('0');
				$("#balanceamout").val('0');
				//$('#balanceamout').focus();
			}
			}
		//}
  }
	/*****************************************  calculation ends ******************************************************************  */
	
	/*****************************************  balance calc starts ******************************************************************  */
  function enterbalance(e)
                     {
//		   if(e.keyCode === 13){

  $('#focusedtext').val('paidamount');
	  	var paid=$('#paidamount').val();
		 var grand=$('#grandtotal').text();
                 var decimal=$('#decimal').val();
                 
                 
                  if($('#pole_on').val()=='Y'){ 
                     if(paid=="" || paid=="undefined" || paid==0){
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
              }
                 
		 if($('#transbal').val()!="" && $('.credit_cc_normal').css('display') != 'none')
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
			 {var insufamt=$("#hidinsufamt").val();
                             $('#balanceamout').val("");
				 $(".payment_pend_right_cash_error").css("display","block");
				 $(".payment_pend_right_cash_error").addClass("popup_validate");
			 	$(".payment_pend_right_cash_error").text(insufamt);
				$('.payment_pend_right_cash_error').delay(2000).fadeOut('slow');
				//$('#balanceamout').val('');
				//$('#balanceamout').focus();
                  var paid_display=0;
                  var bal_display=0;
                   if($('#pole_on').val()=='Y'){ 
                  var data_pole = 'set_pole_paid=pole_display_paid&paid='+paid_display+"&balance="+bal_display+"&mode=cash";
			$.ajax({
			type: "POST",
			url: "index.php",
			data: data_pole,
			success: function(data5) {
			
			}
			});
                    }	
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
                          if($('#pole_on').val()=='Y'){                
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
//                     }
  }
	  
          
   function numdot(e) {     
   
            var charCode;
            if (e.keyCode > 0) {
                charCode = e.which || e.keyCode;
            }
            else if (typeof (e.charCode) != "undefined") {
                charCode = e.which || e.keyCode;
            }
            if (charCode == 43)
                return true
            if (charCode > 31 && (charCode < 48 || charCode > 57))
                 
                return false;
            return true;
          
   } 
          
          
   function enterbalance_credit(e)
     {
                   // if(e.keyCode === 13){
                   $('#focusedtext').val('paidamount_credit');
                  var paid=$('#paidamount_credit').val();
                   var grand=$('#grandtotal').text();
                    var letterNumber = /^[0-9 .]+$/; 


   if(parseFloat(paid)>grand){
       $('#paidamount_credit').val('');
       $('#amount_credit').val(grand);
       $(".payment_pend_right_cash_error").css("display","block");
				$(".payment_pend_right_cash_error").addClass("popup_validate");
				$(".payment_pend_right_cash_error").text('INVALID AMOUNT');
				$('.payment_pend_right_cash_error').delay(2000).fadeOut('slow');
       
   }


                      var decimal=$('#decimal').val();
                    if(parseFloat(paid)>grand){

                      var paid_display=parseFloat(paid).toFixed(decimal);
                          var bal_display=0;           
                            if($('#pole_on').val()=='Y'){ 
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




                    var bal; 
                   if(($('#paidamount_credit').val().match(letterNumber)))
                    {
                             var grand=$('#grandtotal').text();
                              bal=parseFloat(grand.replace(/,/g, "")) -  parseFloat(paid.replace(/,/g, ""));

                    }

                     //var balamt=	$('#balanceamout_credit').val();
                    if(paid==grand){
                       $('#balanceamout_credit').val('0');
                    }


                   if(bal<=0)
                           {
                             
                                  $('#balanceamout_credit').val('0');
                                  $('#amount_credit').val('0');
                                  

                           }else
                           {
                                    if(bal!='0.00' &&  bal!='0' &&  bal!='')
                                   {
                                           $('#amount_credit').val(bal.toFixed(decimal));
                                   }else
                                   {
                                           if(bal=='0' && $('#paidamount_credit').val()!='0')
                                           {
                                                   $('#amount_credit').val('0'); 
                                           }else
                                           {

                                           var grnd=$('#grandtotal').text();
                                          $('#amount_credit').val(grnd.toFixed(decimal)); 
                                           }
                                   }

                                          $('#balanceamout_credit').val(bal.toFixed(decimal));

                                          var decimal=$('#decimal').val();
                           var paid_display=parseFloat(paid).toFixed(decimal);
                          var bal_display=parseFloat(bal).toFixed(decimal);           
 if($('#pole_on').val()=='Y'){ 
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
                    //}

   }
	/*****************************************  balance calc ends ******************************************************************  */
	
function isFloat(n) {
     return parseFloat(n.match(/^-?\d*(\.\d+)?$/))>=0;
  }


  ///delete of cs item//
  function delete_cs_item(m,s) {
      
    var notchk =  $('.comp_bill:checkbox:not(":checked")').length;
     
     var chk=$('.comp_bill:checkbox:checked').length;
     
     var chk_single=$("#comp_bill_"+m+'_'+s+':checkbox:checked').length;
     
    var notchk_single=$("#comp_bill_"+m+'_'+s+':checkbox:not(":checked")').length; 
 
   if(notchk>1  || $('.comp_bill').length==0 || chk_single==1 ||  (notchk_single==1 && chk==0)  ){  
      
       sessionStorage.clickdisable_cs=1;
       $('#checkid').val('delete_item');
    
       $('.counter_menu_popup').hide();
       $('.counter_menu_popup').css("display","none");  
       $('.counter_menu_popup_overlay').css("display","none"); 
		
			  var dataString;
			  dataString = 'value=menudelete&menuid=' + m +'&sln=' + s;
                         
			  var request=  $.ajax({
                                type: "POST",
                                url: "load_counter_sales.php",
                                data: dataString,
                                success: function(data) {
				
				$('#ta_confirm').css('display','none');
				
				}
	  		});
				var dataString1;
						dataString1 = 'value=loaditemsorderd';
						var request1=  $.ajax({
						type: "POST",
						url: "load_counter_sales.php",
						data: dataString1,
						success: function(data1) {
								$('.listorderditems').html(data1);
								sessionStorage.clickdisable_cs=0;
								
								
							}
						});
						$.ajaxSetup({cache: false});
						dataString1=null;
						data1 = null;
						request1.onreadystatechange = null;
						request1.abort = null;
						request1 = null;
				
								var itemsact = $('.eachitem_counter');	
								var actlenght=(itemsact.length);
								if(actlenght>=0)
								{
									$('.countergenerate').css("display","block");
                                                                        $('.settle_direct').css("display","block");
								}else
								{
									$('.countergenerate').css("display","none");
                                                                        $('.settle_direct').css("display","none");
								}
				$('.ta_errormsg').css("display",'block');
                                $('.ta_errormsg').text("DELETED");
                                $('.ta_errormsg').delay(1500).fadeOut('slow');
                              $('#search').val('');    
			   $('#search').focus();
				
			 data = null;
		 dataString = null;
		request.onreadystatechange = null;
		request.abort = null;
		request = null;
		 return false;
                 
               
             var focus_on=$('#be_search_focus_cs').val();
                
                         if(focus_on=='search'){
                             
                        $('#'+focus_on).focus();
                        }
                        else if(focus_on=='search_code'){
                            //$('#codesrch_c').focus();
                              $('#search').focus();
                        }else{
                              //$('#search_barcode').focus();
                                $('#search').focus();
                        }
                        
                        $('#search_barcode').val('');
                        $('#codesrch_c').val('');
                      
               
  }else{
              
             //$("#comp_bill_"+m+'_'+s).attr('checked',false);
                 
               
             alert('ONE ITEM SHOULD BE THERE FOR BILL PRINT WITH RATE ');
             
             
            
     }
                
       }
       
  function regen_ta_cs(bill){
      
     var dataString = 'set=regen_ta_cs&bill='+bill;
	 var request=  $.ajax({
		type: "POST",
		url: "load_counter_sales.php",
		data: dataString,
		success: function(data) {
                  
	  window.location.href='counter_sales.php';
		}
	  });    
      
      
  }           
       
   function plus_kot(sl,qty,menutype){
           
            if(menutype==''){
                if($("#txt_"+sl).val()<qty){
                    $("#txt_"+sl).val(parseInt($("#txt_"+sl).val())+1);

                }
            }
            else if(menutype=='combo'){
                if($("#txt_combo_"+sl).val()<qty){
                    $("#txt_combo_"+sl).val(parseInt($("#txt_combo_"+sl).val())+1);

                }
            }
   }
   
   function minus_kot(sl,menutype){
       
            if(menutype==''){
                if($("#txt_"+sl).val()>0){
                    $("#txt_"+sl).val(parseInt($("#txt_"+sl).val())-1);

                }
            }
            else if(menutype=='combo'){
                if($("#txt_combo_"+sl).val()>0){
                    $("#txt_combo_"+sl).val(parseInt($("#txt_combo_"+sl).val())-1);

                }
            }
   }
        
      $('#go_item_cancel').click(function (event) {
         
         event.stopImmediatePropagation();
    
         var billno=  $('#otp_pop').attr('billno');
    
           var data1234="set=check_otp_item_cancel&billno="+billno;
           $.ajax({
            type: "POST",
            url: "load_index.php",
            data: data1234,
            success: function(data) {
                
             if($('#code_otp').val()==$.trim(data)){
                 
                 
                  $('#otp_pop').hide();
      $('#otp_pop').attr('billno',' ');
                              
       $('#code_otp').val('');
       
       $('#code_otp').focus();
             
                         $('.alert_error_popup_all_in_one').show();
                         $('.alert_error_popup_all_in_one').text('ITEM CANCELLED');
                         $('.alert_error_popup_all_in_one').delay(2000).fadeOut('slow');
                        
                        
                                var hidsl=$('#hiddenslno').val(); 
                                var billno = $('#hid_billno').val();
                                var billitem = $('.payment_pending_pop_quantity_txt_box');
                                var qty = '';
                                var combo_name=new Array();
                                var combo_count='';
                                var stock_check='';
                                var quantity = new Array();
                                var combo_name_string='';
                                billitem.each(function(){
                                    if($(this).hasClass('combo_menu')){
                                        combo_count=$(this).attr('id').split('txt_combo_');
                                        stock_check=$(this).attr('stock_check');
                                        
                                        combo_name.push({
                                            combo_qty:$(this).val(),
                                            combo_count:combo_count[1],
                                            stock_check:stock_check

                                        });
                                        
                                     combo_name_string=JSON.stringify(combo_name);  
                                     
                                    }else{
                                        
                                        qty   =  $(this).val();
                                        
                                      if(qty!='undefined' && qty!='' && qty!=null){
                                          quantity.push(qty);
                                      }
                                  }
                                  });
                                  
                                                        var dataString;
                                                        var datamsg;
                                                        dataString = 'value=cancel_cs_itemqty&itemslno='+hidsl+'&itemqty='+quantity+'&billno='+billno+
                                                        "&reason=&staff=&combo_name="+combo_name_string;
                                                       
                                                        $.ajax({
                                                                type: "POST",
                                                                url: "load_counter_sales.php",
                                                                data: dataString,
                                                                success: function(data) {
                                                                   datamsg = data.trim();
                                                                   
                                                                    window.location.href = "counter_sales.php?setcscommon=settlecspopup";  
                                                                    
                                                            }
                                                            });
              
     
       
       
                }else{
                    
                     alert('INVALID OTP');
                     
                       $('#code_otp').val('');
       
                        $('#code_otp').focus();   
                        
                }
                
            }
            
          });
          
      });
        
   $('#kot_cancel_cs').click(function(event){
    
                        event.stopImmediatePropagation();
          
                        var totqty = 0;
                        
                        $('.cnclqty').each(function(){
                              totqty += Number($(this).val());
                        });
                     
                        var totqty2 = $('#totqty').val();
                          
                        
                        if(totqty==totqty2){
                          
                        $('.alert_error_popup_all_in_one').show();
                        $('.alert_error_popup_all_in_one').text('Quantity Not Changed');
                        $('.alert_error_popup_all_in_one').delay(1000).fadeOut('slow');
                        
                        }else{
                            
                           if($('#otp_item_cancel').val()=='Y'){ 
                               
                               
                               $('#otp_pop').show();
                               
                               $('#code_otp').val('');
                               
                               $('#code_otp').focus();
                               
                           var billno = $('#hid_billno').val();
                           var staff= $('#otp_login').val();
                           
                            $('#otp_pop').attr('billno',billno);
                            
                          $.post("load_index.php", {billno:billno,staff:staff,set:'otp_item_cancel'},
			  function(data)
			  {
                           
                          });
                               
                               
                           }else{
                            
                            
                            if($('#hidcancelsecret').val()=="Y"){
                                
                                $('.kotcancel_reason_popup_new').css('display','block');
                                $(".counter_sl_payment_hist_pop").css("display","none");
                                $("#pin").focus();
                                
                           }else{
                               
                                var hidsl=$('#hiddenslno').val(); 
                                var billno = $('#hid_billno').val();
                                var billitem = $('.payment_pending_pop_quantity_txt_box');
                                var qty = '';
                                var combo_name=new Array();
                                var combo_count='';
                                var stock_check='';
                                var quantity = new Array();
                                var combo_name_string='';
                                billitem.each(function(){
                                    if($(this).hasClass('combo_menu')){
                                        combo_count=$(this).attr('id').split('txt_combo_');
                                        stock_check=$(this).attr('stock_check');
                                        
                                        combo_name.push({
                                            combo_qty:$(this).val(),
                                            combo_count:combo_count[1],
                                            stock_check:stock_check

                                        });
                                        
                                     combo_name_string=JSON.stringify(combo_name);  
                                     
                                    }else{
                                        
                                        qty   =  $(this).val();
                                        
                                      if(qty!='undefined' && qty!='' && qty!=null){
                                          quantity.push(qty);
                                      }
                                  }
                                  });
                                  
                                                        var dataString;
                                                        var datamsg;
                                                        dataString = 'value=cancel_cs_itemqty&itemslno='+hidsl+'&itemqty='+quantity+'&billno='+billno+
                                                        "&reason=&staff=&combo_name="+combo_name_string;
                                                       
                                                        $.ajax({
                                                                type: "POST",
                                                                url: "load_counter_sales.php",
                                                                data: dataString,
                                                                success: function(data) {
                                                                   datamsg = data.trim();
                                                                   
                                                                    window.location.href = "counter_sales.php?setcscommon=settlecspopup";  
                                                                    
                                                            }
                                                            });
  
                           }

        }
        
        
        }
});




$('.pin_close').click(function(event){
    
    	 window.location.href = "counter_sales.php?setcscommon=settlecspopup"; 
         
});


$('#kotcancel_reason_popup_new_proceed_btn_cs').click(function (event) {
    
     
             event.stopImmediatePropagation();
            
              var pin =  $('#pin').val();
              var hidsl=$('#hiddenslno').val(); 
              
              if(pin !=''){
              $.post("load_counter_sales.php", {pin:pin,value:'authpincheck',set:'pincheck'},
		function(data)
		{ 
                    data=$.trim(data);
                  
                  var staff_sl=data.split('*');
                  var staff=staff_sl[0];
                 
                    if(data!="NO")
                    { 
                       if(staff_sl[4]=='kotcancel:Y'){
                        $('.kotcancel_reason_popup_new').css('display','none');
                        $(".confrmation_overlay").css("display","none");
                        $('#pin').val('');
                       
                        var billno = $('#hid_billno').val();
                        var billitem = $('.payment_pending_pop_quantity_txt_box');
                        var qty = '';
                        var combo_name=new Array();
                        var combo_count='';
                        var stock_check='';
                        var quantity = new Array();
                        var combo_name_string='';
                        billitem.each(function(){
                            if($(this).hasClass('combo_menu')){
                                combo_count=$(this).attr('id').split('txt_combo_');
                                stock_check=$(this).attr('stock_check');
                                
                                combo_name.push({
                                    combo_qty:$(this).val(),
                                    combo_count:combo_count[1],
                                    stock_check:stock_check
                                    
                                });
                             combo_name_string=JSON.stringify(combo_name);  
                            }
                            else{
                                qty   =  $(this).val();
                              if(qty!='undefined' && qty!='' && qty!=null){
                                  quantity.push(qty);
                              }
                          }
                           });
                           
                         
                                                 var secretkey ='';
                                                var reasontext = $('#authcodersn').val();
                                                var staff1=($('#stafflist').val())
                                                var type = $('#stafflist').find('option:selected').attr("cancelkey");
                                                
//                                               
						var dataString;
                                                var datamsg;
                                    		dataString = 'value=cancel_cs_itemqty&itemslno='+hidsl+'&itemqty='+quantity+'&billno='+billno+"&reason="+reasontext+"&staff="+staff+"&combo_name="+combo_name_string;
                                               
                                    		$.ajax({
                                                        type: "POST",
                                                        url: "load_counter_sales.php",
                                    			data: dataString,
                                    			success: function(data) {
                                                           datamsg = data.trim();
                                                            
                                                            window.location.href = "counter_sales.php?setcscommon=settlecspopup";  
                                                            }
                                                    });
                                                           
                       }else{
                           $("#pin_error").css("display","block");
			$("#pin_error").text("No Permission");
			$("#pin_error").delay(2000).fadeOut('slow');
                        $("#pin").val('');
                        $("#pin").off('blur');
                        $("#pin").focus();
                       }		
                    }
                    else{
                        
                        $("#pin_error").css("display","block");
			$("#pin_error").text("CODE NOT REGISTERED");
			$("#pin_error").delay(2000).fadeOut('slow');
                        $("#pin").val('');
                        $("#pin").off('blur');
                        $("#pin").focus();
                    }
                });
            }
            else{      
                
                        $("#pin_error").css("display","block");
			$("#pin_error").text("ENTER PIN");
			$("#pin_error").delay(2000).fadeOut('slow');
                       $("#pin").focus();
                         
            }
       
             });
             
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
             
   
  