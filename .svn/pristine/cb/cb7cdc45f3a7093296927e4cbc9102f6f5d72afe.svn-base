// JavaScript Document

$(document).ready(function(){
    
    
    
   var  dataString1 = 'set=set_print_option_ta&print_option=Y' ;
                      
		$.ajax({
		type: "POST",
		url: "load_index.php",
		data: dataString1,
		success: function(data) {
                    
                }
                });
    
  $("#dis_pin").keyup(function(event) {
         
            if (event.keyCode == 13) {
                if($("#dis_pin").is(':focus')){
                   
               $('#dis_auth_proceed1').click();
               $("#dis_pin").blur();
               
                }
              
              } 
        });
    
    
    
    
  $('#close_dis').click(function (event) {
  
       if( $('.payment_pend_popup').css('display') == 'block') {
           window.location.href = "take_away_.php?settacommon=settletapopup";	
       }else{
           window.location.href="take_away_.php";
       }
        
    });
    
    
    
  $('#dis_auth_proceed1').click(function (event) {
       
              event.stopImmediatePropagation();
            
              var pin =  $('#dis_pin').val();
            
              if(pin !=''){
              $.post("load_takeaway.php", {pin:pin,value:'authpincheck',set:'pincheck'},
		function(data)
		{ 
                   
                 data=$.trim(data);
                  
                  var staff_sl=data.split('*');
                  var staff=staff_sl[0];
                 
                    if(data!="NO")
                    { 
                       
                        if(staff_sl[6]=='dis_auth:Y'){
                            
                        $('.auothorize_popup').css('display','none');
                       
                         if(staff_sl[7]=='dis_manual:Y'){
                         $('.manual_permission_ta').css('display','block');
                          }
                        $('#new_proceed_loyalty_div').hide();
                        $('#dis_pin').val('');
                        $('#ly_id').focus();
                        
                          $('#disountamount').val('');
                         $('#disountamount_drop').val('');
                         $('#load_discount_data').text('');
                        $("#disountamount").prop("readonly", false);  
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
			$("#dis_error").text("ENTER YOUR PERSONAL PIN");
			$("#dis_error").delay(2000).fadeOut('slow');
                       // documet.getElementById('dis_pin').focus();
                        $("#dis_pin").focus();
                        
                         
            }
        
   });
    
    
    
      $('.pay_settle_btn').click( function(event) {
      
	event.stopImmediatePropagation();
        
	var focused=$('#focusedtext').val();
                
	var calval=($(this).text());
		
	var org=$('#'+focused).val();
                
			if(calval>=0)
			{   
                            if(org.length<12){
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

	/*************************************** category selection  starts *************************************************  */
       	
    
$('.ta_categorysel').click(function (event) { //alert("hgdfh");
		//e.preventDefault();
		event.stopImmediatePropagation();
		$('#ta_loadbottomcontent').empty();
		$('#searchb').val('');
	  $(".ta_categorysel>div").removeClass("main_category_list_act");
      $(this).find("div").addClass('main_category_list_act'); 
	  var id_str   =  $(this).attr("catid");
	  var id_arr	  =	 id_str.split("_");
	  var cat_id       = id_arr[1];
	  $('#ta_catname').val(cat_id);
	  var dataString = 'value=subcatselection&category=' + cat_id;
	 var request=  $.ajax({
		type: "POST",
		url: "load_takeaway.php",
		data: dataString,
		success: function(data) {
                    //alert(data);
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
			url: "load_takeaway.php",
			data: dataString,
			success: function(data) {
				 $('#ta_loadmenuitems').html(data);
				 $('#ta_loadmenuitems').css("text-align","left");
				 $('#ta_loadmenuitems').css("display","inherit");
                                   $('#searchb').focus();  
			}
	 	 });
		 data = null;
		 dataString = null;
		request.onreadystatechange = null;
		request.abort = null;
		request = null;	
	  return false;
	
  });
	/***************************************  category selection  ends *************************************************  */
	//--------------------------
       
	$('.subcategory_items').click(function (event) { 
		event.stopImmediatePropagation();
		$('#ta_loadmenuitems').empty();
		$('#ta_loadbottomcontent').empty();
		$('#searchb').val('');
		var subcategory=$(this).attr('values');//alert(subcategory)
		var categoryid=$('#ta_catname').val();
		$('.subcategory_items').removeClass('take_away_ubcategory_act');
		$(this).addClass('take_away_ubcategory_act');
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
			url: "load_takeaway.php",
			data: dataString,
			success: function(data) {
					$('#ta_loadmenuitems').html(data);
					$('#ta_loadmenuitems').css("text-align","left");
					$('#ta_loadmenuitems').css("display","inherit");
                                        $('#searchb').focus();  
				}
	  		});
			 data = null;
		 dataString = null;
		request.onreadystatechange = null;
		request.abort = null;
		request = null;
		 return false;
	});	
        //----------------------------
	$('.edititems').click(function (event) {//alert("ff");
	if($(this).hasClass('right_act_edit_dsbl'))
		{
		}else
		{
			
		event.stopImmediatePropagation();
		  var selval   =  $('.takeaway_contant_tr_active').attr('menuid');
		  var actqty   =  $('.takeaway_contant_tr_active').attr('actqty');
		  var portname   =  $('.takeaway_contant_tr_active').attr('portionname');
		  var prefname   =  $('.takeaway_contant_tr_active').attr('pref');
                  var rate = $('.takeaway_contant_tr_active').attr('rate');
//		  $('.counter_menu_popup_overlay').css("display","block"); 
//		  $('.counter_menu_popup').css("display","block"); 
                  $(".confrmation_overlay").css("display","block");
		  $('.bottom_edit_cc_popup').css("display","block"); 
			  $(".olddiv").addClass("new_overlay");
			 $('.menu_sub_item').removeClass('take_item_active');  
			 $(this).find('div').addClass('take_item_active');
			 
			  
				  var request = $.ajax({
					url: "takeaway_popup.php",
					method: "POST",
					data: {menu:selval,typesub:'Edit',actqty:actqty,portname:portname,prefname:prefname,manualrate:rate },
					dataType: "html"
				  });
				   
				  request.done(function( msg ) {//alert(msg);
					$( ".bottom_edit_cc_popup" ).html( msg );
					
					
				  });
				  
				  data = null;
					msg=null;
				  request.onreadystatechange = null;
				  request.abort = null;
				  request = null;
                                  
                                 
		}               //$('.edititems').addClass('right_act_edit_dsbl');
                //takeaway_contant_tr_active
	
	});
        /*************************************** Delete button click starts *************************************************  */
	$('#ta_deleteitems').click(function (e) {
		
		if($(this).hasClass('right_act_delete_dsbl'))
		{
			
		}else
		{	
			if($('.eachitem_counter').hasClass('takeaway_contant_tr_active'))
			{
				$('#ta_confirm').css('display','block');
			//$('#ta_deleteitems').css('margin-top','-27px')
			}else
			{
			 $('.ta_errormsg').css("display",'block');
			  $('.ta_errormsg').text("Nothing to delete...");
			  $('.ta_errormsg').delay(2000).fadeOut('slow');
			}
		}
		return false;
	});
  
	/***************************************  Delete button click  ends *************************************************  */


	/*************************************** Sub category selection  starts *************************************************  */
	$('.ta_submit_order').click(function (e) { // old function
		//ta_name ta_address ta_landmark ta_area ta_mobile ts_homed

		var name=$('#ta_name').val();
		var address=$('#ta_address').val();
		var ordaddress=$('#ta_orderaddress').val();
		var landmark=$('#ta_landmark').val();
		var area=$('#ta_area').val();
		var mobile=$('#ta_mobile').val();
                var gst=$('#ta_gst').val();
		var homed;
		if($("#ts_homed").is(':checked'))
			homed="HD";  // checked
		else
		{
			if($("#ts_take").is(':checked'))
			homed="TA"; 
			else
			homed="CS";
		}
		
		
			$('.disountenterpopup').css('display','block');
			$('.confrmation_overlay').css('display','block');
		
			if(homed=="TA" || homed=="CS")
			{
				
			if($("#ta_mobile").val()!='')
				{
						
					if(IsNumeric($("#ta_mobile").val()))
						{
							
							return true;
						}
						else
						{
							$('#ta_mobile').addClass('textbox_alert');
					
							$('#ta_mobile').focus();
							return false;
						}
				}
				
					$('#ta_mobile').removeClass('textbox_alert');
					$('#ta_name').removeClass('textbox_alert');
					$('#ta_landmark').removeClass('textbox_alert');
					var dataString;
					dataString = 'value=submitvalues&name=' + name +'&address=' + address +'&orderaddr='+ ordaddress +'&landmark=' + landmark +'&area=' + area +'&mobile=' + mobile +'&homed=' + homed+'&gst='+gst;//alert(dataString)

					
					 $.ajax({
					type: "POST",
					url: "load_takeaway.php",
					data: dataString,
					success: function(data) {
						
						
						
						if($('#hidprinter').val()=="Y")
						{	
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
									data2=data2.trim();
									if(data2=="ok")
									{
									
									}
									
									}
								});	
								
								}
							});	
							$('.new_alert_cc').css('display','block');
							$('.confirm_detail_con_pop').css('display','block');
							$('.confirm_detail_con_pop').html(data);
						}else {
						$('.new_alert_cc').css('display','block');
							$('.confirm_detail_con_pop').css('display','block');
							$('.confirm_detail_con_pop').html(data);
						}
						
						}
					});
				
			}else if(homed=="HD")
			{
				if(landmark=="")
				{
					$('#ta_landmark').addClass('textbox_alert');
					$('#ta_mobile').removeClass('textbox_alert');
					$('#ta_name').removeClass('textbox_alert');
					$('#ta_landmark').focus();
				}else
				{
					$('#ta_mobile').removeClass('textbox_alert');
					$('#ta_name').removeClass('textbox_alert');
					$('#ta_landmark').removeClass('textbox_alert');
					var dataString;
				
					dataString = 'value=submitvalues&name=' + name +'&address=' + address +'&orderaddr='+ ordaddress +'&landmark=' + landmark +'&area=' + area +'&mobile=' + mobile +'&homed=' + homed+'&gst='+gst;

					 $.ajax({
					type: "POST",
					url: "load_takeaway.php",
					data: dataString,
					success: function(data) {
						
						
						if($('#hidprinter').val()=="Y")
						{	
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
								  
								  
								  dataString = 'value=ta_billhdprint&bypass=y';
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
							  $('.new_alert_cc').css('display','block');
							$('.confirm_detail_con_pop').css('display','block');
							$('.confirm_detail_con_pop').html(data);	
						}else
						{
						
						$('.new_alert_cc').css('display','block');
							$('.confirm_detail_con_pop').css('display','block');
							$('.confirm_detail_con_pop').html(data);
						}
						}
					});
				}
			}
			$('.eachitem_counter').removeClass('takeaway_contant_tr_active');
		//}
		return false;
	});	
	/*************************************** Sub category selection  ends *************************************************  */
	
	/*************************************** Home delvry chk box click  starts *************************************************  */
	$('.home').click(function (e) {//.home_dry_chk
	$('.take').attr('checked', false);
		if($("#ts_homed").is(':checked'))
		{
			$('.enlandmrk').css('display','block');
			$('.enname').css('display','block');
			$('.enmobile').css('display','block');
		}
		else
		{
			$('.enlandmrk').css('display','none');
			$('#ta_landmark').removeClass('textbox_alert');
			$('.enname').css('display','none');
			$('#ta_name').removeClass('textbox_alert');
			$('.enmobile').css('display','none');
			$('#ta_mobile').removeClass('textbox_alert');
		}
		
		
		
		
	});	
        
        
        
        $('#clear_all_def_data').click(function (e) {
            
            $('#ta_mobile').val('');
              $('#ta_id').val('');
              $('#ta_name').val('');
	      $('#ta_address').val('');
              $('#ta_orderaddress').val('');
	      $('#ta_landmark').val('');
              $('#ta_area').val('');
              $('#ta_remarks').val('');
	      $('#ta_gst').val('');
              $('#ta_mobile').focus();
              $('#ta_ref_new').val('');
               $('#hd_charge_new').val('');
              $("#hd_boy").val($("#hd_boy option:first").val()); 
               
        var datastri_del="phone_order_del=phone_order_del_ok";
        $.ajax({
        type: "POST",
        url: "take_away_.php",
        data: datastri_del,
        success: function(data)
        { 
        }
        });
               
        });
	/*************************************** Home delvry chk box click  ends *************************************************  */
	
	/*************************************** Take away chk box click  starts *************************************************  */
        
        shortcut.add("Ctrl+C",function() {
       
       var ta_check = $('.total_itemcount1').text(); 
     
       if(ta_check > 0){ 
            localStorage.coming_fromta='direct_flow';
          //$('.take').click();
           $('#quick_bill_ta_hd').click();
       }

     });
        
        
        
        
	$('.take').click(function (event) {
            
               // e.stopImmediatePropagation();
            
		$('#ta_mobile').focus();
                 
                if($('.total_itemcount1').text() > 0 ){
                    $('.order_before').hide();
                   
                if($('#kot_generate_tahd').val()=='Y'){
                       $('#genkot').show();
                }
                  
                       $('.ta_submit_orders').show();
                       $('.settle_direct_ta').show();
                   
                       $('.no_print_in').show(); 
              }else{
                      $('.order_before').show();
                      $('#genkot').hide();
                      $('.ta_submit_orders').hide();
                      $('.settle_direct_ta').hide();
                      $('.no_print_in').hide(); 
                  
              }
       setTimeout(function () {
           
              
        var datastringnewta1="value=load_customer_def";
       
        $.ajax({
        type: "POST",
        url: "load_takeaway.php",
        data: datastringnewta1,
        success: function(data)
        {
       
            var dt=$.trim(data).split('*');
            
            if(dt[2]!='' || dt[1]!=''){
                
              $('#ta_mobile').val(dt[2]);
              $('#ta_id').val(dt[9]);
              $('#ta_name').val(dt[1]);
	      $('#ta_address').val(dt[7]);
              $('#ta_orderaddress').val(dt[3]);
	      $('#ta_landmark').val(dt[4]);
              $('#ta_area').val(dt[5]);
              $('#ta_remarks').val(dt[6]);
	      $('#ta_gst').val(dt[8]);
              $('#ta_ref_new').val(dt[11]);
              
        }else{
            
              $('#ta_mobile').val('');
              $('#ta_id').val('');
              $('#ta_name').val('');
	      $('#ta_address').val('');
              $('#ta_orderaddress').val('');
	      $('#ta_landmark').val('');
              $('#ta_area').val('');
              $('#ta_remarks').val('');
	      $('#ta_gst').val('');
              $('#ta_ref_new').val('');
              $('#hd_charge_new').val('');
        }
              
        }
    });
            
        }, 500);    
            
		$('.home').attr('checked', false);
                
		if($("#ts_take").is(':checked'))
		{
			$('.enlandmrk').css('display','none');
			$('#ta_landmark').removeClass('textbox_alert');
			$('.enname').css('display','none');
			$('#ta_name').removeClass('textbox_alert');
			$('.enmobile').css('display','none');
			$('#ta_mobile').removeClass('textbox_alert');
		}
		else
		{
			$('.enlandmrk').css('display','none');
			$('#ta_landmark').removeClass('textbox_alert');
			$('.enname').css('display','none');
			$('#ta_name').removeClass('textbox_alert');
			$('.enmobile').css('display','none');
			$('#ta_mobile').removeClass('textbox_alert');
		}
		
		
	});	
        
	/*************************************** Take away chk box click  ends *************************************************  */
	

	
	/********************* Take away submit *************************/
        
        
  $('.confirmkot_ta_bill').click(function (event) {
            
             event.stopImmediatePropagation();
             $('.disountenterpopup').css('display','none');
              
             $('.kotconfirmpopup_ta_bill').css('display','none');   
          
             $(".confrmation_overlay").css("display","none");
               
             var msg=$('#kotfailmsg_ta_bill').html();
          
             var dataString_log ='set_log=kotconfirmbylogin&failmsg='+msg;
             $.ajax({
             type: "POST",
             url: "menu_order.php",
             data: dataString_log,
             success: function(data) {
             
             }
             });
             
             var subt=$('.tal_viewtotal').text();
             if(subt){
                 
                $('#subtotal_d1').text(subt);
                $('#subtotal_l1').text(subt);
            } 
               
                var id_ta=$('.ta_submit_orders').attr('id');
         
		$('#ta_name').removeClass('textbox_alert');
		$('#ta_landmark').removeClass('textbox_alert');
		$('#ta_mobile').removeClass('textbox_alert');
		var typeset= $(this).attr('settype');
		$('#genset').val(typeset);
                var mobile=$('#ta_mobile').val();
                var custid=$('#ta_id').val();
                var name=$('#ta_name').val();
		var address=$('#ta_address').val();
                var orderaddress=$('#ta_orderaddress').val();
		var landmark=$('#ta_landmark').val();
		var area=$('#ta_area').val();
                var remarks=$('#ta_remarks').val();
		var billno = $('.payment_pend_bill_cc_act').attr('bill');
		var homed;
                var disc=$('#counter_discount_popup').val()
                var gst=$('#ta_gst').val();
                var staffwithdiscountta1=$('#staffwithdiscountta').val();
                var staffdiscount_manual=$('#staffwithdiscount-manual').val();
                
                if($(this).hasClass("payment_pend_enable")){
                    homed = "HD";
                }else{
                      homed=$('.mode').attr('mode');  
                } 
                    
                  if(homed=="HD")
			{ 
                            if(mobile=="")
		        {
				$('#ta_mobile').addClass('textbox_alert');
				$('#ta_mobile').focus();
				return false;	
				}
	
			}else if(homed=="TA")
			{
                            
                        }   
                
                
                
                if($(this).hasClass("payment_pend_enable")){
                    
                        
                        if($("#ta_mobile").val()!='')
				{
                                    
				if(IsNumeric($("#ta_mobile").val()))
						{
                                                        $(".home_delevery_address_popup").css("display","none");
                                                        $(".confrmation_overlay").css("display","none");
                                                        $(".confrmation_overlay_1").css("display","none");
                                                        //alert("hi");
                                                        $.post("load_payments_takeaway.php", {billno:billno,mode:homed,set:'loadta_chgmode',mobile:mobile,name:name,gst:gst,custid:custid,address:address,orderaddress:orderaddress,landmark:landmark,area:area,remarks:remarks},
                                                        function(data)
                                                        {
                                                            
                                                        });
                                                        
                                                        $(".confrmation_overlay").css("display","block");
                                                        $(".payment_pend_popup").css("display","block");
                                                        var modeval="ALL";
                                                        
                                                        $.post("load_payments_takeaway.php", {modeval:modeval,set:'loadta_billdetails'},
                                                            function(data)
                                                            {
                                                                $('.payment_pend_popup_left_cc').html(data);
                                                                $("#"+billno+"").addClass("payment_pend_bill_cc_act");
                                                            });
						}
						else
						{
							$('#ta_mobile').addClass('textbox_alert');
							$('#ta_mobile').focus();
							return false;
						}	
				}
                        
                }else{
                
		
		

                        if(mobile!='')
				{
                                    
				if(IsNumeric(mobile))
						{
                                                    
                                                        var loyalty_status=$('#loyalty_status').val();
            
                                                        $(".home_delevery_address_popup").css("display","none");
                                                        $(".confrmation_overlay").css("display","none");
                                                        
                                                        if(disc=="Y"){
                                                            
                                                            $('.auothorize_popup').show();
                                                            $('#dis_pin').focus();
                                                            $('.confrmation_overlay').css('display','block');
                                                            $('.disountenterpopup').css('display','block');
                                                            $(".discount_click").click();
                                                            $('#disountamount').focus();
                                                              $('.closedisount').css('display','block');
                                                              if(id_ta=="skip"){
                                                                  
                                                                $('.closedisount').addClass(id_ta);
                                                              }
                                                                return true;
                                                              }else if(loyalty_status=="Y"){
         
                                                  $('.loyalty_main_popup').css('display','block'); 
                                                  
                                                    if(disc!="Y"){
                                                        $(".loyalty_click").click();
                                                         $(".confrmation_overlay").css("display","block");
                                                    }
          
                                                              }
                                                                 else{
                                                         
                                                                if(id_ta=="skip"){
                                                                        $('.closedisount').addClass(id_ta);
                                                                }
                                                                        $(".closedisount").trigger("click");
                                                                }
						}
						else
						{
                                                    

							$('#ta_mobile').addClass('textbox_alert');
							$('#ta_mobile').focus();
							return false;
						}
                                              
				}
				else
				{
                                    var loyalty_status=$('#loyalty_status').val();
                                    $(".home_delevery_address_popup").css("display","none");
                                    $(".confrmation_overlay").css("display","none");
                                    if(disc=="Y"){
                                        
                                           $('.auothorize_popup').show();
                                           $('#dis_pin').focus();
                                           $(".discount_click").click();
                                           $('#disountamount').focus();
                                           
                                        $('.disountenterpopup').css('display','block');
                                        $('.confrmation_overlay').css('display','block');
                                        
                                            if(id_ta=="skip"){
                                              $('.closedisount').addClass(id_ta);
                                            }
                                            }else if(loyalty_status=="Y"){
         
                                                  $('.loyalty_main_popup').css('display','block'); 
                                                  
                                                    if(disc!="Y"){
                                                        
                                                         $(".loyalty_click").click();
                                                         $(".confrmation_overlay").css("display","block");
                                                    }
          
                                                              }
                                            
                                         else{
                                         if(id_ta=="skip"){
                                             
                                                $('.closedisount').addClass(id_ta);
                                        }
                                        $(".closedisount").trigger("click");
                                    }
				}
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
        
                            
                             
                            
        });
        
         $('.confirmkot_ta_no_bill').click(function () {
             
                 $('.home_delevery_address_popup').css('display','none');  
                 $('.kotconfirmpopup_ta_bill').css('display','none');   
          
                $(".confrmation_overlay").css("display","none");
                $('.disountenterpopup').css('display','none');  
        });
      
    
     $('#new_proceed_loyalty').click(function (event) {
         
          if( $('.payment_pend_popup').css('display') == 'block') {

         event.stopImmediatePropagation();
             
         $('.closedisount').addClass('bill-print-new-procedure');
         $(".closedisount").trigger("click");
    
          }else{
               $('.closedisount').addClass("skip");
          $(".closedisount").trigger("click");
          }
          
   });
 
    
    $('.settle_direct_ta').click(function (e) {
            
             localStorage.coming_fromta='direct_flow';
             e.stopImmediatePropagation();
             var KOT_print = "TA_KOT_consol_print";
               
                $.post("printercheck_1.php", {type:KOT_print},

                function(data)
                { 
                 
                data=$.trim(data); 
                $('.disountenterpopup').css('display','none');  
                
               if(data !=0){
                     var homed;
                     var mobile=$('#ta_mobile').val();
               if($(this).hasClass("payment_pend_enable")){
                     homed = "HD";
               }else{
                     homed=$('.mode').attr('mode');  
               } 
               
               if((homed=='HD' && mobile!="") || homed=='TA' ){
                 
                $('.disountenterpopup').css('display','none');  
                $('.kotconfirmpopup_ta_bill').css("display","block");
                $(".confrmation_overlay").css("display","block");
                $('.home_delevery_address_popup').css('display','none'); 
                
               $('#kotfailmsg_ta_bill').html(data);
               
                }else{
                    $('#ta_mobile').addClass('textbox_alert');
		    $('#ta_mobile').focus();
                }


                }else  {
            
             
            var subt=$('.tal_viewtotal').text();
             if(subt){
             $('#subtotal_d1').text(subt);
              $('#subtotal_l1').text(subt);
               } 
             
             
                var id_ta=$('.ta_submit_orders').attr('id');
          
		$('.disountenterpopup').css('display','none');  
                 
		$('#ta_name').removeClass('textbox_alert');
		$('#ta_landmark').removeClass('textbox_alert');
		$('#ta_mobile').removeClass('textbox_alert');
		var typeset= $(this).attr('settype');
		$('#genset').val(typeset);
                var mobile=$('#ta_mobile').val();
                var custid=$('#ta_id').val();
                var name=$('#ta_name').val();
		var address=$('#ta_address').val();
                var orderaddress=$('#ta_orderaddress').val();
		var landmark=$('#ta_landmark').val();
		var area=$('#ta_area').val();
                var remarks=$('#ta_remarks').val();
		var billno = $('.payment_pend_bill_cc_act').attr('bill');
		var homed;
                var disc=$('#counter_discount_popup').val()
                var gst=$('#ta_gst').val();
                var staffwithdiscountta1=$('#staffwithdiscountta').val();
                var staffdiscount_manual=$('#staffwithdiscount-manual').val();
          
                if($(this).hasClass("payment_pend_enable")){
                    homed = "HD";
                }else{
                    homed=$('.mode').attr('mode');  
                } 
                     
                if(homed=="HD")
			{ 
                            if(mobile=="")
		        {
				$('#ta_mobile').addClass('textbox_alert');
				$('#ta_mobile').focus();
				return false;	
				}
				
				
		}else if(homed=="TA")
			{

                        }   
                
                if($('.ta_submit_orders').hasClass("payment_pend_enable")){
                    
                        
                        if($("#ta_mobile").val()!='')
				{
			if(IsNumeric($("#ta_mobile").val()))
			{
                        $(".home_delevery_address_popup").css("display","none");
                        $(".confrmation_overlay").css("display","none");
                        $(".confrmation_overlay_1").css("display","none");
                     
                        $.post("load_payments_takeaway.php", {billno:billno,mode:homed,set:'loadta_chgmode',mobile:mobile,name:name,gst:gst,custid:custid,address:address,orderaddress:orderaddress,landmark:landmark,area:area,remarks:remarks},
                        function(data)
                        {

                        });
                       
                        $(".confrmation_overlay").css("display","block");
                        $(".payment_pend_popup").css("display","block");
                        var modeval="ALL";
                        
                        $.post("load_payments_takeaway.php", {modeval:modeval,set:'loadta_billdetails'},
                            function(data)
                            {
                                $('.payment_pend_popup_left_cc').html(data);
                                $("#"+billno+"").addClass("payment_pend_bill_cc_act");
                            });
			}
			else
			{
			 $('#ta_mobile').addClass('textbox_alert');
			 $('#ta_mobile').focus();
			 return false;
			}	
			}
                        
                }else{
   
                if(mobile!='')
		{ 
		if(IsNumeric(mobile))
		{
                                                    
                 $(".home_delevery_address_popup").css("display","none");
                 $(".confrmation_overlay").css("display","none");
                 
             if(id_ta=="skip"){
                $('.closedisount').addClass(id_ta);
             }
                $(".closedisount").trigger("click");
             
        }
        else
        {

        $('#ta_mobile').addClass('textbox_alert');
        $('#ta_mobile').focus();
        return false;
        }
                                                
	}
	else
	{ 
                                    
          
           $(".home_delevery_address_popup").css("display","none");
           $(".confrmation_overlay").css("display","none");
                              
                   if(id_ta=="skip"){
                       $('.closedisount').addClass(id_ta);
                   }
                       $(".closedisount").trigger("click");
                   }
          
         }
                                
                            
        }                
                            
        });  
       
	});	
        
$('.ta_submit_orders').click(function (e) {
            
            localStorage.coming_fromta='direct_flow';
             e.stopImmediatePropagation();
             var KOT_print = "TA_KOT_consol_print";
               
                $.post("printercheck_1.php", {type:KOT_print},

                function(data)
                { 
                data=$.trim(data); 
                $('.disountenterpopup').css('display','none');  
                
               if(data !=0){
                     var homed;
                     var mobile=$('#ta_mobile').val();
               if($(this).hasClass("payment_pend_enable")){
                     homed = "HD";
               }else{
                     homed=$('.mode').attr('mode');  
               } 
               
               if((homed=='HD' && mobile!="") | homed=='TA' ){
                 
                $('.disountenterpopup').css('display','none');  
                $('.kotconfirmpopup_ta_bill').css("display","block");
                $(".confrmation_overlay").css("display","block");
                $('.home_delevery_address_popup').css('display','none'); 
                
               $('#kotfailmsg_ta_bill').html(data);
               
                }else{
                    $('#ta_mobile').addClass('textbox_alert');
		    $('#ta_mobile').focus();
                }


                }else  {
            
             
            var subt=$('.tal_viewtotal').text();
             if(subt){
             $('#subtotal_d1').text(subt);
              $('#subtotal_l1').text(subt);
               } 
             
             
                 var id_ta=$('.ta_submit_orders').attr('id');
          
		$('.disountenterpopup').css('display','none');  
                 
		$('#ta_name').removeClass('textbox_alert');
		$('#ta_landmark').removeClass('textbox_alert');
		$('#ta_mobile').removeClass('textbox_alert');
		var typeset= $(this).attr('settype');
		$('#genset').val(typeset);
                var mobile=$('#ta_mobile').val();
                var custid=$('#ta_id').val();
                var name=$('#ta_name').val();
		var address=$('#ta_address').val();
                var orderaddress=$('#ta_orderaddress').val();
		var landmark=$('#ta_landmark').val();
		var area=$('#ta_area').val();
                var remarks=$('#ta_remarks').val();
		var billno = $('.payment_pend_bill_cc_act').attr('bill');
		var homed;
                var disc=$('#counter_discount_popup').val()
               var gst=$('#ta_gst').val();
                var staffwithdiscountta1=$('#staffwithdiscountta').val();
                var staffdiscount_manual=$('#staffwithdiscount-manual').val();
          
                if($(this).hasClass("payment_pend_enable")){
                    homed = "HD";
                }else{
                    homed=$('.mode').attr('mode');  
                } 
                     
                if(homed=="HD")
			{ 
                            if(mobile=="")
		        {
				$('#ta_mobile').addClass('textbox_alert');
				$('#ta_mobile').focus();
				return false;	
				}
				
				
		}else if(homed=="TA")
			{

                        }   
                
                
                
                if($('.ta_submit_orders').hasClass("payment_pend_enable")){
                    
                        
                        if($("#ta_mobile").val()!='')
				{
			if(IsNumeric($("#ta_mobile").val()))
			{
                        $(".home_delevery_address_popup").css("display","none");
                        $(".confrmation_overlay").css("display","none");
                        $(".confrmation_overlay_1").css("display","none");
                     
                        $.post("load_payments_takeaway.php", {billno:billno,mode:homed,set:'loadta_chgmode',mobile:mobile,name:name,gst:gst,custid:custid,address:address,orderaddress:orderaddress,landmark:landmark,area:area,remarks:remarks},
                        function(data)
                        {

                        });
                       
                        $(".confrmation_overlay").css("display","block");
                        $(".payment_pend_popup").css("display","block");
                        var modeval="ALL";
                        
                        $.post("load_payments_takeaway.php", {modeval:modeval,set:'loadta_billdetails'},
                            function(data)
                            {
                                $('.payment_pend_popup_left_cc').html(data);
                                $("#"+billno+"").addClass("payment_pend_bill_cc_act");
                            });
			}
			else
			{
			$('#ta_mobile').addClass('textbox_alert');
			$('#ta_mobile').focus();
			return false;
			}	
			}
                        
                }else{
   
                if(mobile!='')
		{ 
		if(IsNumeric(mobile))
		{
                 var loyalty_status=$('#loyalty_status').val();
            
                                                    
                                                    
                 $(".home_delevery_address_popup").css("display","none");
                 $(".confrmation_overlay").css("display","none");
                 if(disc=="Y"){ 
                      $('.auothorize_popup').show();
                $('#dis_pin').focus();
                 $('.confrmation_overlay').css('display','block');
                 $('.disountenterpopup').css('display','block');
                 $(".discount_click").click();
                 $('#disountamount').focus();
                 $('.closedisount').css('display','block');
                 if(id_ta=="skip"){
                 $('.closedisount').addClass(id_ta);
                 }
                 return true;
                 }else if(loyalty_status=="Y"){

            $('.loyalty_main_popup').css('display','block'); 

            if(disc!="Y"){
                $(".loyalty_click").click();
                 $(".confrmation_overlay").css("display","block");
            }

            }
             else{

             if(id_ta=="skip"){
             $('.closedisount').addClass(id_ta);
             }
             $(".closedisount").trigger("click");
             }
        }
        else
        {

        $('#ta_mobile').addClass('textbox_alert');
        $('#ta_mobile').focus();
        return false;
        }
                                                
	}
	else
	{ 
                                    
            var loyalty_status=$('#loyalty_status').val();
           $(".home_delevery_address_popup").css("display","none");
           $(".confrmation_overlay").css("display","none");
           if(disc=="Y"){
                $('.auothorize_popup').show();
                $('#dis_pin').focus();
                $(".discount_click").click();
                     $('#disountamount').focus();
               $('.disountenterpopup').css('display','block');
               $('.confrmation_overlay').css('display','block');
                 if(id_ta=="skip"){
                   $('.closedisount').addClass(id_ta);
                   }
                   }else if(loyalty_status=="Y"){

                         $('.loyalty_main_popup').css('display','block'); 

                           if(disc!="Y"){
                               $(".loyalty_click").click();
                                $(".confrmation_overlay").css("display","block");
                           }

                                     }

                 else{
                                               
                    if(id_ta=="skip"){
                       $('.closedisount').addClass(id_ta);
                           }
                       $(".closedisount").trigger("click");
                  }
           }
       }
                                
                            
        }                
                            
        });  
       
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
        
        
    $(".no_print_in").click(function(){
        
     $('.submittranscations').addClass('disablegenerate');
     
               var  dataString1 = 'set=set_print_option_ta&print_option=N' ;
            
		$.ajax({
		type: "POST",
		url: "load_index.php",
		data: dataString1,
		success: function(data) {
                    
                   if($('#hd_boy:visible').length == 0)
                   {
                       
                     var mode='TA';
                   
                    }else{
                          
                        var mode='HD';
                   }
                   
                   
                   if( (mode=='HD' && $('#ta_mobile').val()!='') || mode=='TA' ){
                       
                   
                    $('.closedisount').removeClass('bill-print-new-procedure');
                    $('.closedisount').addClass('skip');

                    $('.mode').attr('mode',mode); 
                    $('.closedisount').click();	
                    
                    $('.home_delevery_address_popup').hide();
                    
                   }else{
                     
                       $('#ta_mobile').focus();         
                   }
                    
       
                }
                });
                   
       setTimeout(function(){                                         
           $('.submittranscations').removeClass('disablegenerate');    
       }, 2000); 
                
   
    }); 
        
        
   ////ta bill closedisount real////

  $('.closedisount').click(function (e) {
     
                
          var crd_view= $('#credit_view_per').val();
          
          var comp_view= $('#comp_view_per').val();
           
          if(crd_view=="N"){
              
               $('#credit_person').hide();
          }
           
          if(comp_view=="N"){
              
               $('#complimentary').hide();
          }
  
         e.stopImmediatePropagation();
       
        $('.closedisount').unbind('click');
         
        var decimal=$('#decimal').val();
        
	var genset=$('#genset').val();
        var name=$('#ta_name').val();
        var kotgen=$('#kotgen').attr('genkot');
        var generatedbillno=$('.payment_pend_bill_cc_act'). attr('bill');
        
        if($('#ly_number').val()!=""){
                                             
        var loyalty_id=$('#ly_id').val();
            
        if( $('.payment_pend_popup').css('display') == 'block') {
            
            var loyalty_billamount_old=$('#tot_org_bill').val();
            var loyalty_billamount=loyalty_billamount_old.replace(',','');
            var loyalty_billamount1=$('#total').text();
            
        }else{
            
             loyalty_billamount=$('#tot_org').val();
              
             loyalty_billamount1=$('.tal_viewtotal').text();
        }
            
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
     
                $('.loyalty_main_popup').css('display','none'); 
      
		var address=$('#ta_address').val();
		var ordaddress=$('#ta_orderaddress').val();
		var landmark=$('#ta_landmark').val();
		var area=$('#ta_area').val();
                var remarks=$('#ta_remarks').val();
		var mobile=$('#ta_mobile').val();
		var homed=$('.mode').attr('mode'); 
		var discount_unit=$("input[name='typesel']:checked").val();
                var discount_of=$("#disountamount").val();
		var discount='Y';
                var hd_boy=$("#hd_boy").val();
                var ref_new=$('#ta_ref_new').val();
                 var hd_charge_new=$('#hd_charge_new').val();
                
		var discountid=$("#disountamount_drop").val();
             
                var gst=$('#ta_gst').val();
                
                if(discountid)
                {
                        discountid=$("#disountamount_drop").val();
                        discount_unit='';
                        discount_of=0;
                }
                else {
                    
                        discountid='';
                       
                    if(discount_of==''){
                           
                        discount_of=0;
                        discount_unit='';
                        discount='N';
                    }
                    
                    else if(!discount_of){
                        
                        discount_of=0;
                        discount_unit='';
                        discount='N';
                    }
                   
                }
          
            if(discountid=='' && discount_of==0)
		{
                        discount='N';
                        discountid='';
                        discount_unit='';
                        discount_of=0;
		}


	if( (((discount_unit=="P" && discount_of<=100) || (discount_unit=="V") || discountid !='') && discount=='Y') || discount=='N')
	{
		
                        $('.disountenterpopup').css('display','none');
                        
			var dataString;
                        
			if($('.closedisount').hasClass('bill-print-new-procedure')){
                          
                            dataString = 'value=billprint_only&discount_of='+ discount_of + '&discount=' + discount + ' &discount_unit='+discount_unit+
                                    '&discountid='+discountid+'&generatedbillno='+generatedbillno+"&id_loy="+loyalty_id+"&point_add="+tot_point+
                                    "&point_redeem="+loyalty_pointredeem+"&billamount="+loyalty_billamount+"&redeemamount="+loyalty_redeemamount+
                                    "&new_bill_amt="+loyalty_billamount1+"&loy_number="+loy_number+"&loy_name="+loy_name;
                          
				
				        $.ajax({
					type: "POST",
					url: "load_takeaway.php",
					data: dataString,
					success: function(data) {
                                        
                                            var datanew=data.trim();
                                     
                                            if(datanew=='Discount applied succefully!'){
                                               
                                            var dataString; 

                                            dataString = 'value=ta_billprint&bypass=y&homed='+homed+'&bilno='+generatedbillno;
                                            
                                             $.ajax({
                                                type: "POST",
						url: "print_details_kot.php",
						data: dataString,
						success:function(data2) {
                                                    
                                                      data2=data2.trim();
                                                    
                                                      $('.closedisount').removeClass('bill-print-new-procedure');	
                                                      
						      window.location.href = "take_away_.php?settacommon=settletapopup";	  
                                                 
                                                  }
                                                
                                                 });
                                            
                                        }
                                       
                                    }
                                    });
                                        
                                        
                                        
        }else{
                                
                                
        var id_of_order=$('#order_id_first').val();
                          
	dataString = 'value=submitvalues_ta&name=' + name +'&address=' + address +'&orderaddr='+ ordaddress +'&landmark=' + landmark 
        +'&area=' + area +'&remarks='+remarks+'&mobile=' + mobile +'&homed=' + homed + '&discount_of='+ discount_of + '&discount=' +
        discount + ' &discount_unit='+discount_unit+ '&discountid='+discountid+'&gst='+gst+"&id_loy="+loyalty_id+"&point_add="+tot_point
        +"&point_redeem="+loyalty_pointredeem+"&billamount="+loyalty_billamount+"&redeemamount="+loyalty_redeemamount+"&new_bill_amt="+
        loyalty_billamount1+"&loy_number="+loy_number+"&loy_name="+loy_name+"&id_of_order="+id_of_order+"&hd_boy="+hd_boy+
        "&ref_new="+ref_new+"&hd_charge_new="+hd_charge_new;
	//alert(dataString);		
				        $.ajax({
					type: "POST",
					url: "load_takeaway.php",
					data: dataString,
					success: function(data) {
                                      
                                             
                        var str2 = "nokotfound";
                         
                        if($.trim(data).indexOf(str2) != -1){
                            
                        alert('COUNTERS CONFLICT / ERROR .PLEASE REORDER');
                          
                        var ordrid_ro=$('#ordrid').val();
                          
                        var ord=$('#ordrid').val();     
                        var dataString = 'set=temp_move&ord='+ordrid_ro;
			var request=  $.ajax({
			type: "POST",
			url: "load_index.php",
			data: dataString,
			success: function(data){
                            
                            window.location.href='take_away_.php';
      
                         }
                        });
                        
                      }else{
                          
                                        var dataString88;
                                        dataString88 = 'set=reconfigure_bill_missvalue_ta&bill=';
                                        $.ajax({
                                        type: "POST",
                                        url: "load_index.php",
                                        data: dataString88,
                                        success: function(data1) {
                                            
                                         }
                                        });
                                        
                                        
                                        
                           if($('.closedisount').attr('from_btn')=='kot_gen'){
                               
                               var tmt='0';
                               
                           }else{
                               
                               var tmt='0';
                           }
                           
                           localStorage.coming_fromta='direct_flow';
                                            
                                                         var bsth_kot_before_tahd=$('#bsth_kot_before_tahd').val();
                                                           
                                                         if(bsth_kot_before_tahd=='Y'){
                                                             
                                                          setTimeout(function(){                                         
        
                                                          var dataString = 'value=ta_kotprint';
							  $.ajax({
							  type: "POST",
							  url: "print_details_kot.php",
							  data: dataString,
							  success: function(data1){
                                                              
                                                             
							  var dataString; 
							  dataString = 'value=console_ta';
							  $.ajax({
							  type: "POST",
							  url: "print_details_kot.php",
							  data: dataString,
							  success: function(data2) {
                                                            
							  }
							  });
                                                          
                                                          }
					                  });
                                                          
                                                          
                                                            }, tmt);  
                                                          
                                                         }     
                                                           
                                                           
                                                           
							if($('.closedisount').hasClass('skip') ){
                                                            
                                                            var bill_before_tahd_new=$('#bill_before_tahd_new').val();
                                                           
                                                            if(bill_before_tahd_new=='Y'){
                                                                
                                                                 // setTimeout(function(){     
                                                                 
								  var dataString; 
								  dataString = 'value=ta_billprint&bypass=y&homed='+homed;
                                                           
								  $.ajax({
								  type: "POST",
								  url: "print_details_kot.php",
								  data: dataString,
								  success: function(data2) { 
                                                                    
								   data2=data2.trim();
									  if(data2=="ok")
									  {
									     // $('.closedisount').removeClass('skip');	 
								  
									  }
									  
								   }
								  });	
                                                                  
                                                             //   }, 1500);    
                                                                  
                                                           }
                                                               
                                                }
                                            
                                            
                                             $("#cash").click();
                                            
                                             $(".confrmation_overlay").css("display","block");
                                            
                                             if($('.closedisount').attr('from_btn')=='kot_gen'){
                                                
                                                $(".settle_popup_in_take_away").css("display","none");
                                                
                                             }else{
                                                
                                                 $(".settle_popup_in_take_away").css("display","block");
                                             }
                                            
                                                $('#ta_orderlist').empty();
                                                
                                                dataString = 'value=getbill_amt';
                                             
                                                $.ajax({
                                                type: "POST",
                                                url: "load_takeaway.php",
                                                data: dataString,
                                                success: function(datax) { 
                                                    
                                                 datax=datax.trim();
                                                 
                                                var det=datax.split(",");
                                                
                                              if($('.closedisount').hasClass('skip')){
                                                  
                                                $('.new_print_loading_bill').hide();
                                                $(".settle_popup_in_take_away").css("display","block");
                                                $(".confrmation_overlay").css("display","block");
                                               
                                                $('#billdetails').text(det[0]);
                                               
                                                $('#transbal').val('');
                                                
                                                var loy_on=$('#loyalty_settle_on').val();
                                        
                                               if( $('#cus_num_def').text()!=''){
                                                   
                                                 $('#num_sms_new').val($('#cus_num_def').text());
                                                 $('#name_sms_new').val($('#cus_name_def').text());
                                                    
                                                 $('#num_sms_new').prop('disabled',true);
                                                 $('#name_sms_new').prop('disabled',true);
                                               } 
                                               
                                                var check_online_credit= $(".cur_order").attr('cur_online_credit');

                                                var check_online_credit_id= $(".cur_order").attr('cur_online_id');
                             
                           
                                            if(check_online_credit=='Y'){

                                                        $('#credit_person').click();

                                                        $('#selectcreditypes').attr("style", "pointer-events: none;");
                                            }else{
                                                        $('#cash').click();
                                            }    
						
                                            $('#paidamount').val(parseFloat(det[1]).toFixed(decimal).replace(",",''));
                                            $('#balanceamout').val('0.000');     
                                            $('#paidamount').select() ;
           
                                               if(det[3]=="")
						{
                                                    det[3]=0;
						}
                                                if(det[1]=="")
						{
                                                    det[1]=0;
						}
                                                
                                            if(det[9]>0){
                                                      $('#dis_item_new').text(det[9]);
                                            }else{
                                                      var tt_new=0;
                                                      $('#dis_item_new').text(tt_new.toFixed(decimal));  
                                            }
                                            
                                                $('#billdetails').text(det[0]);
                                                $('#grand_org').val(parseFloat(det[1]).toFixed(decimal));
						$('#final').text(parseFloat(det[3]).toFixed(decimal));
						$('#grandtotal').text(parseFloat(det[1]).toFixed(decimal));
                                              
                                                $('#tip_amount').val(det[6]);
                                                
                                             if(parseFloat(det[2])>0){
                                                 
                                              var  dataString77 = 'set=discount_bill_format&billno='+det[0]+"&mode=TA";
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
                                                        
                                                }
                                                });
                                                
                                              }else{
                                                       $('#dis_details_new').text('')  ;
                                              }
                                                
                                                
						if(det[2]=="")
						{
                                                    det[2]=0;
						}
                                                
						$('#totaldisc').text(parseFloat(det[2]).toFixed(decimal));
                                                var taxnames=det[4].split('<>');
                                                var taxvalues=det[5].split('<>');
                                               
                                                if(taxnames!=''){
                                                for(var j=0;j<taxnames.length;j++){
                                                                                 
                                                    $("#taxdetails_div").append('<div style="width:100%; " class="lable_counter_paymnet_cc counter_right_lable" id='+taxnames[j]+'>'+taxnames[j]+':<span >'+parseFloat(taxvalues[j]).toFixed(decimal)+'</span></div>') ;
                                                }
                                                }
                                                
                                                
                                                }
                                
                   if($('#pole_on').val()=='Y'){              
                       
                        var data_pole = 'set_pole=pole_display_all&pole_bill='+det[0]+"&pole_amount="+det[1]+"&display=show";
			$.ajax({
			type: "POST",
			url: "index.php",
			data: data_pole,
			success: function(data5) {
			
			}
			});
                    }                       
                                                
                    }  });

                                                
                     $(".total_itemcount1").text('0');
                     $(".final_show").text('0');
                     $(".tal_viewtotal").text('0');
                     $(".tax_show").text('0');
                     $("#dis_pin").val('');
                     $("#disountamount").val('');
                    
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
                                                
                                                if($('.closedisount').hasClass('skip') ){  
                                                    
                                                }else{
                                                    
                                                    $('#ta_loadmenuitems').html('<img src="img/ajax-loaders/ajax-loader.gif" height="70px" style="margin:auto"  />');  
                                                       setTimeout(function(){                                         
                                                    location.reload();
                                                  }, 1500); 
                                                }
					  
                                        }
                                            
					}
						    
				    });
                                    }
                                   
		 }else
		 { 
                         alert("Invalid Discount Percentage");
			 $("#disountamount").css("border","1px solid #F00");
		 }     
   			
 });
        
      
    
 $('#dis_auth_proceed_without_discount_ta').click(function (event) {
     
            event.stopImmediatePropagation();
            $('.auothorize_popup').hide();
            $('.loyalty_main_popup').hide();
            $('.closedisount').click(); 
  });
	
        
 $('.canceldisount').click(function (e) {
     
		$("#disountamount").css("border","1px solid #847D7D");
		$("#disountamount").val('0');
		$('#disountamount_drop').find('option:first').attr('selected', 'selected');
		$('.disountenterpopup').css('display','none');
		
                if($('.canceldisount').hasClass('back-to-payment-pending')){
                   
                    $('.canceldisount').removeClass('back-to-payment-pending');
                    $('.confrmation_overlay').css('display','block');
                    window.location.href = "take_away_.php?settacommon=settletapopup";
            }else{
                
             $('.confrmation_overlay').css('display','none');
             if($('.payment_pend_popup').css('display') == 'none') {
                   
                 window.location.href = "take_away_.php";
             }
             
            }
            
                   $('.loyalty_main_popup').css('display','none');
                   $('#clear_btn_click').click();
                   $('#loy_error').text('');
                   $('#new_proceed_loyalty_div').hide();
                  
                  if( $('.payment_pend_popup').css('display') == 'block') {
                       $('.confrmation_overlay').css('display','block');
                  }   
                      
                  $(".confrmation_overlay_2").css("display","none");
                   
  });
        
        
        
  $('.calculator_settle_set').click( function(event) {
        
             event.stopImmediatePropagation();
                
             $('#focusedtext_set').val('pin_set'); 
           
	     var focused=$('#focusedtext_set').val();
                
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
          $.post("load_takeaway.php", {pin:pin_set,value:'authpincheck',set:'pincheck'},
                            function(data){
                                data=$.trim(data);
                                if(data!="NO"){
                                var spl=data.split('*');
                            
                if(spl[13]=='bill_settle:Y'){
                    
                $('.cs_settle_auth_pop').hide();
                $('.confrmation_overlay_settle_auth').hide(); 
                                    
                                    
                var settlebill1=$('#settlebill').val();
                var drct="drct";
		var payemntmode_sel =$('.mode_sel_btn_act').attr('id');
                var tip_amount=0;
                var tip_mode='C';
                if($('#tip_amount').val()!='' && $('#tip_amount').val()>0){
                    tip_amount=$('#tip_amount').val();
                    tip_mode=$('#tip_pay_mode').val();
                }
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
		  
                  var billno = $("#hidbillno").val();
                  if($('#submitbutton_billno').val()!=billno){
                      $('#submitbutton_billno').val(billno);
                      $('#submitbutton_presscount').val(0);
                  }
                 
                  
		  var typenam=$('.mode_sel_btn_act').attr('idval');
                  //alert(typenam);
		  if(pd!="")
		  {
			 if(isFloat(pd))
						{ 
                                                   
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
                                   exit;
			  }
			  
			  else if(paidamtt < grandam )
			  {
				   var insufamt=$("#hidinsufamt").val();
				  
				   $(".payment_pend_right_cash_error").css("display","block");
				  $(".payment_pend_right_cash_error").addClass("popup_validate");
				  $(".payment_pend_right_cash_error").text(insufamt);
				  $('.payment_pend_right_cash_error').delay(2000).fadeOut('slow');
				  
				   exit;
				  
			  }
			  
			  else
			  {
			 var data = {
				 	"set"		: "bill_settle_ta",
					"type"		: selct,
					"billno" 	: billno,
					"typenam"	: '1',
					"paid"		: paid,
					"bal" 		: bal,
                                        "stl" 		: drct
				  };
			  }
				  
		  }
                  else  if(selct=="credit")
		  { 
                         var grand_nw=$('#grandtotal').text();
                        var multi_cardamount_nw=$('#multi_cardamount').val(); 
                         
                        //alert(multi_cardamount_nw);
                        // alert(grand_nw);
                        
                        if(multi_cardamount_nw!=grand_nw){
                        
                            
                            
                          var tran=$('#transcationid').val();
			  var trans=parseFloat(tran.replace(',',''));
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
			   exit;
			 }else
			  {
                              
                              
			   if(parseFloat(trans)<=parseFloat(grand))
			  {
                              
                          
			  if(trans>0 && (bankdetails!='' && bankdetails!=null))
			   { 
					var paid=$('#paidamount').val();
					var bal=$('#balanceamout').val();
					var transbal=$('#transbal').val();
					if((transbal=='0.00' || transbal=='0.000' )&& bal=='0')
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
						 var insufamt=$("#hidinsufamt").val();
						 $(".payment_pend_right_cash_error").css("display","block");
						 $(".payment_pend_right_cash_error").addClass("popup_validate");
						 $(".payment_pend_right_cash_error").text(insufamt);
						 $('.payment_pend_right_cash_error').delay(1000).fadeOut('slow');
                                                  exit;
					}
				 }else
				 {
				 var entertrnsdt=$("#hidentertrnsdt").val();
					 $(".payment_pend_right_cash_error").css("display","block");
					 $(".payment_pend_right_cash_error").addClass("popup_validate");
				     $(".payment_pend_right_cash_error").text(entertrnsdt);
				     $('.payment_pend_right_cash_error').delay(2000).fadeOut('slow');
                                    exit;
				 }
			  }else
			  {
			  var chktrnsdt=$("#hidchktrnsdt").val();
				  $(".payment_pend_right_cash_error").css("display","block");
					 $(".payment_pend_right_cash_error").addClass("popup_validate");
				     $(".payment_pend_right_cash_error").text(chktrnsdt);
				     $('.payment_pend_right_cash_error').delay(2000).fadeOut('slow');
                                      exit;
			  }
			  
			  
		  }
                  
                  }else{
                       var multi_cardamount_nw1=$('#multi_cardamount').val(); 
                      var tran_nw=$('#transcationid').val();
			  var trans_nw=parseFloat(tran_nw.replace(',',''));
			  var bankdetails_nw=$('#bankdetails').val();
			 
			   var paid_nw=$('#paidamount').val();
			var bal_nw=$('#balanceamout').val();
			   var transbal_nw=$('#transbal').val();
                           
                      var data = {
							  "set"		: "bill_settle_ta",
							  "type"		: selct,
							  "billno" 	: billno,
							  "typenam"	: "2",
							  "trans" :multi_cardamount_nw1,
							  "bank" :bankdetails_nw,
							  "paid": paid_nw,
							  "bal" : bal_nw,
                                                          "stl" : drct
							};
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
                                                  
                                                  
						  var coupbalam=  parseFloat(coupbal.replace(/,/g, ""));
				  var paidamts=parseFloat(paid.replace(/,/g, ""));
				  
						  if(coupbalam >paidamts )
						  
						  
						  {       var insufamt=$("#hidinsufamt").val();
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
								  "typenam"	: typenam,
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
								  "typenam"	: typenam,
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
								  "typenam"	: typenam,
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
			   }else
			   { 
			   var enterchecknumber=$("#hidenterchecknumber").val();
				   $(".payment_pend_right_cash_error").css("display","block");
				    $(".payment_pend_right_cash_error").addClass("popup_validate");
			 		$(".payment_pend_right_cash_error").text(enterchecknumber);
					$('.payment_pend_right_cash_error').delay(2000).fadeOut('slow');
			   }
		   
			  
			  
			  }else if(selct=="complimentary")
				{
		  			var comp=$('#completext').val();//alert(comp)
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
	   
			
				}else if(selct=="credit_person"){
                                    
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
                                            exit;
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
                                          var credit_remarks_ta=$('#credit_remarks_ta').val();
                                          var room='';
					  //alert(credit_remarks_ta);
					  if(creditype!='')
					  { //alert(amount_credit);
						 if(((creditype=='2'||creditype=='1') && creditdeatils!='') || ((creditype=='3'||creditype=='4') && guestname!=''))
						  {     
                                                        if(creditype=='1'){
                                                            room=$("#selectcreditdetails option:selected").text();
                                                        }
							   data = {
								  "set"					: "bill_settle_ta",
								  "type"				: selct,
								  "typenam"				: "6",
								  "creditype"			: creditype,
								  "creditdeatils"		: creditdeatils,
								  "paidamount_credit"	: paidamount_credit,
								  "amount_credit"		: amount_credit,
								  "bal"				: 0,
				                                   "stl" 		: drct,
                                                                   "credit_remarks_ta"        :credit_remarks_ta,
                                                                   "guestnumber"                 :guestnumber,
                                                                  "guestname"                 :guestname,
                                                                  "room"                      :room 
								};
							  
						  }else
						  {if(creditype=='4'|| creditype=='3'){
                                                          var sel_option='Enter Name ';
                                                        }
                                                        else{
                                                            var sel_option="select option !";
							  var labelname=$("#selectcreditypes").find('option:selected').attr('label');
							  $(".payment_pend_right_cash_error").css("display","block");
							  $(".payment_pend_right_cash_error").addClass("popup_validate");
							  $(".payment_pend_right_cash_error").text(sel_option +labelname);
							  $('.payment_pend_right_cash_error').delay(2000).fadeOut('slow');
                                                           exit;
						  }}
					  }else
					  {    
                                              
                                                  var sel_credttype="select type !";
						  $(".payment_pend_right_cash_error").css("display","block");
						  $(".payment_pend_right_cash_error").addClass("popup_validate");
						  $(".payment_pend_right_cash_error").text(sel_credttype);
						  $('.payment_pend_right_cash_error').delay(2000).fadeOut('slow');
                                                   exit;
					  }
                                }else{
                                    alert("Credit not possible");
                                }
                                }
		else
		{             var entremt=$("#hidentramt").val();
			$(".payment_pend_right_cash_error").css("display","block");
			$(".payment_pend_right_cash_error").addClass("popup_validate");
			$(".payment_pend_right_cash_error").text(entremt);
			$('.payment_pend_right_cash_error').delay(2000).fadeOut('slow');
                         exit;
		}
		
		}else
		{
			
			var incrt_amt=$("#hidincrt_amt").val();
			$(".payment_pend_right_cash_error").css("display","block");
			$(".payment_pend_right_cash_error").addClass("popup_validate");
			$(".payment_pend_right_cash_error").text(incrt_amt);
			$('.payment_pend_right_cash_error').delay(2000).fadeOut('slow');
			
                         exit;
		}
		  }else
		{
                    
//                if(pd=='' && $('#completext').val()==''){
//			var entremt=$("#hidentramt").val();
//			$(".payment_pend_right_cash_error").css("display","block");
//			$(".payment_pend_right_cash_error").addClass("popup_validate");
//			$(".payment_pend_right_cash_error").text(entremt);
//			$('.payment_pend_right_cash_error').delay(2000).fadeOut('slow');
//                     
//                  }
                  
                  
                    var typenam=$('.mode_sel_btn_act').attr('idval');
               
                          var comp=$('#completext').val();
                        if(comp=='' && typenam=='7'){
                            $(".payment_pend_right_cash_error").css("display","block");
			$(".payment_pend_right_cash_error").addClass("popup_validate");
			$(".payment_pend_right_cash_error").text('Enter remarks');
			$('.payment_pend_right_cash_error').delay(2000).fadeOut('slow');
                         exit;
                        }else if(pd=='' && typenam !='7'){
                            var entremt=$("#hidentramt").val();
			$(".payment_pend_right_cash_error").css("display","block");
			$(".payment_pend_right_cash_error").addClass("popup_validate");
			$(".payment_pend_right_cash_error").text(entremt);
			$('.payment_pend_right_cash_error').delay(2000).fadeOut('slow');
                         exit;
                        }
                  
                  
                  
                        var comp=$('#completext').val();//alert(comp)
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
			
		}
                
                var coupon_code=$('#coupon_code').val();
                var bill_final_amount=$('#grandtotal').text();
                var bill_final_amount_new= bill_final_amount.replace(',','');
		   var auth=$('#code_comp_credit').val();
                   
                    if($("#sms_bill_settle").is(':checked'))
		{
			var sms_bill_settle='Y';
		}
		else
		{
		     var sms_bill_settle='N';
		}     
                   
                   
                   
		     data = $(this).serialize() + "&" + $.param(data)+"&tip_amount="+tip_amount+"&tip_mode="+tip_mode+"&auth_staff="+auth+"&coupon_code="+coupon_code+"&bill_final_amount_new="+bill_final_amount_new+"&sms_bill_settle="+sms_bill_settle; //alert(data);
			
                                            $.ajax({
					type: "POST",
					url: "load_payments_ta_cs.php",
					data: data,
					success: function(msg)
					{  
                                           $('#shift_check').val($.trim(msg));
                                           
                                            if($.trim(msg)=="Please open the shift for the current login"){
                                                
                                                $(".payment_pend_right_cash_error").css("display","block");
							  $(".payment_pend_right_cash_error").addClass("popup_validate");
							  $(".payment_pend_right_cash_error").text("Please Open Shift For Current Login");
							  $('.payment_pend_right_cash_error').delay(3000).fadeOut('slow');
                                                
                                             }else{
                                           
                                           
                                            $('#submitbutton_presscount').val(parseFloat($('#submitbutton_presscount').val())+1);
                                                if($('#submitbutton_presscount').val()==1){
                                                 
                                               
								var dataString; 
									  dataString = 'set=drawer_open_after_settlement_ta';
									   $.ajax({
									  type: "POST",
									  url: "cashdrawer_details.php",
									  data: dataString,
									  success: function(data3) {//alert("ok");
										  data3=data3.trim();//alert(data3);
										 
										  }
									  });
						  
							
				  //});
				  
						
						
								$('#billdetails').empty();				  
							 // $('#billdetails').load("load_paymentpending.php?set=loadbilldetails_total");
							  $('.paymentclose').css("display","none");
							  //$('.paid_amount_cc').css("display","none");
							   $('#sms_bill_settle').prop('checked',false);
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
						
						//});	var dataString; 
                                                if(settlebill1=='Y'){
								  dataString = 'value=ta_billprint&bypass=y&homed=TA';
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

                                                      //  $(".payment_pend_popup").css("display","block");
                                                        //$(".confrmation_overlay").css("display","block");
                                                   
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
                                                   //
                              }else{
                 
						window.location ='take_away_.php';
                                            }
					}
                                    }
                                    }
				});
                                
                                
                        var data_pole = "set_pole=pole_display_all&display=thankyou";
			$.ajax({
			type: "POST",
			url: "index.php",
			data: data_pole,
			success: function(data5) {
                            
			if(localStorage.coming_fromta=='direct_flow'){
                            if($('#shift_check').val()!="Please open the shift for the current login"){
                                window.location.href = "take_away_.php";
                            }
                        }
                        else{
                            
                              if($('#shift_check').val()!="Please open the shift for the current login"){
                            window.location.href = "take_away_.php?settacommon=settletapopup"; 
                            }  
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
                                    
                                    
                                }else{
          $("#pin_error_set").css("display","block");
                                    $("#pin_error_set").text("NO PERMISSION");
                                    $("#pin_error_set").delay(2000).fadeOut('slow');
                                    $("#pin_set").val('');
                                    $("#pin_set").focus();
     }
                                    
                                }else{
          $("#pin_error_set").css("display","block");
                                    $("#pin_error_set").text("CODE NOT REDGISTERED");
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
 
 
 
//----------------payment settle button starts real-----------------///


 $('.submittranscations').click(function (event) {
     
     
          $(".payment_pend_right_cash_error").css("display","block");
	  $(".payment_pend_right_cash_error").addClass("popup_validate");
	  $(".payment_pend_right_cash_error").text('BILL SETTLING');
	  $('.payment_pend_right_cash_error').delay(3500).fadeOut('slow');
                  
           event.stopImmediatePropagation(); 
              
           var bill_settle_auth=$('#bill_settle_auth_ta').val();
           
           if(bill_settle_auth !='N'){
               
                $('.cs_settle_auth_pop').show();
                $('.confrmation_overlay_settle_auth').show();
                $("#pin_set").val('');
                $("#pin_set").focus();
                
            }else{
		
                var settlebill1=$('#settlebill').val();
                var drct="drct";
		var payemntmode_sel =$('.mode_sel_btn_act').attr('id');
                var tip_amount=0;
                var tip_mode='C';
                
                if($('#tip_amount').val()!='' && $('#tip_amount').val()>0){
                    tip_amount=$('#tip_amount').val();
                    tip_mode=$('#tip_pay_mode').val();
                }
                
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
                      
                       }
                        else{
                           pd=$('#coupamount').val();
                        }
                    }
                
                else{
                        var pd=$('#paidamount').val();
                }
                
                
                
		  var selct=$('.mode_sel_btn_act').attr('id');
		  
                  var billno = $("#hidbillno").val();
                  
                  if($('#submitbutton_billno').val()!=billno){
                      
                      $('#submitbutton_billno').val(billno);
                      $('#submitbutton_presscount').val(0);
                  }
                 
		  var typenam=$('.mode_sel_btn_act').attr('idval');
               
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
					"typenam"	: '1',
					"paid"		: paid,
					"bal" 		: bal,
                                        "stl" 		: drct
				  };
			  }
				  
		  }else if(selct=="credit")
		  { 
                        var grand_nw=$('#grandtotal').text();
                        var multi_cardamount_nw=$('#multi_cardamount').val(); 
                         
                        if(multi_cardamount_nw!=grand_nw){
                        
                            
                          var tran=$('#transcationid').val();
			  var trans=parseFloat(tran.replace(',',''));
			  var bankdetails=$('#bankdetails').val();
			  var grand=$('#grandtotal').text();
			   
			  var paid=$('#paidamount').val();
			
			  var transbal=$('#transbal').val();
			
			  
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
                              
                              
			   if(parseFloat(trans)<=parseFloat(grand))
			  {
                              
                          
			  if(trans>0 && (bankdetails!='' && bankdetails!=null))
			   { 
					var paid=$('#paidamount').val();
					var bal=$('#balanceamout').val();
					var transbal=$('#transbal').val();
                                        
					if((transbal=='0.00' || transbal=='0.000' )&& bal=='0')
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
						 var insufamt=$("#hidinsufamt").val();
						 $(".payment_pend_right_cash_error").css("display","block");
						 $(".payment_pend_right_cash_error").addClass("popup_validate");
						 $(".payment_pend_right_cash_error").text(insufamt);
						 $('.payment_pend_right_cash_error').delay(1000).fadeOut('slow');
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
                      
                      
                       if((transbal=='0.00' || transbal=='0.000' ) && bal=='0')
			{
                            
                        
                        var multi_cardamount_nw1=$('#multi_cardamount').val(); 
                        var tran_nw=$('#transcationid').val();
			var trans_nw=parseFloat(tran_nw.replace(',',''));
			var bankdetails_nw=$('#bankdetails').val();
			 
			var paid_nw=$('#paidamount').val();
			var bal_nw=$('#balanceamout').val();
			var transbal_nw=$('#transbal').val();
                           
                      var data = {
							  "set"		: "bill_settle_ta",
							  "type"	: selct,
							  "billno" 	: billno,
							  "typenam"	: "2",
							  "trans" :multi_cardamount_nw1,
							  "bank" :bankdetails_nw,
							  "paid": paid_nw,
							  "bal" : bal_nw,
                                                          "stl" : drct
							};
                  
                  
                 }else{
                     
                     
                                     var multi_amt=parseFloat($('#multi_cardamount').val());   
                                     
                                     var grand_new_1=parseFloat($('#grandtotal').text());
                                   
                                    if(multi_amt==grand_new_1){
                                        
                                                 var multibanktype=$('#multibanktype').val();
                                        
                                                 var ctype =  $("#multicardtype").val();
                                                 var camount = $('#multi_cardamount').val();
                                                 var cnumber = $("#card_1").val();
                                                 var billno=$('#billdetails').html(); 

                                                 var bankdefault =  $("#bankdetails").val();   

                                                 var datastring = "ctype="+ctype+"&camount="+camount+"&cnumber="+cnumber+"&billno="+billno
                                                 +"&btype="+multibanktype+"&bankdefault="+bankdefault+"&full_settle=Y";


                                                     $.ajax({
                                                     type: "POST",
                                                     url: "take_away_.php",
                                                     data: datastring,
                                                     success: function (data)
                                                     {  


                                                     }
                                                     });                     

                                        
		                                          
			 
                                                          var data = {
                                                              
							 "set"		: "bill_settle_ta",
							  "type"	: selct,
							  "billno" 	: billno,
							  "typenam"	: "2",
							  "trans" : multi_amt,
							  "bank" : multibanktype,
							  "paid": '0',
							  "bal" : '0',
                                                          "stl" : drct
							};
                                                        
                                                       
                                        
                                    }else{  
                     
                     
                                     $(".payment_pend_right_cash_error").css("display","block");
			             $(".payment_pend_right_cash_error").addClass("popup_validate");
				     $(".payment_pend_right_cash_error").text('ADD CARD AMOUNT');
				     $('.payment_pend_right_cash_error').delay(2000).fadeOut('slow');
                                     $('.submittranscations').removeClass('disablegenerate');
                                     
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
                                                  
                                                  
						  var coupbalam=  parseFloat(coupbal.replace(/,/g, ""));
				                  var paidamts=parseFloat(paid.replace(/,/g, ""));
				  
						  if(coupbalam >paidamts )
						  
						  
						  {       var insufamt=$("#hidinsufamt").val();
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
						   {
                                                           var insufamt=$("#hidinsufamt").val();
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
								  "typenam"	: typenam,
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
								  "typenam"	: typenam,
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
								  "typenam"	: typenam,
								  "cheqbank" :cheqbank,
								  "cheqname": cheqname,
								  "cheqamt": cheqamt,
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
					 {
                                                var enterbankname=$("#hidenterbankname").val();
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
					  {
                                              var paymentmsg1 = ($("#paymentmsg1").val());
						  $(".payment_pend_right_cash_error").css("display","block");
						  $(".payment_pend_right_cash_error").addClass("popup_validate");
						  $(".payment_pend_right_cash_error").text('ENTER REMARKS');
						  $('.payment_pend_right_cash_error').delay(2000).fadeOut('slow');
                                                 
					  }
	   
			
				}else if(selct=="credit_person"){
                                    
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
                                        
                                        
					  var paidamount_credit=$('#paidamount_credit').val();
					  var amount_credit=$('#amount_credit').val();
                                          var credit_remarks_ta=$('#credit_remarks_ta').val();
                                          var room='';
					
					  if(creditype!='')
					  {  
						 if(((creditype=='2'||creditype=='1') && creditdeatils!='') || ((creditype=='3'||creditype=='4')  && guestname!='') )
						  { 
                                                      
                                                        if(creditype=='1'){
                                                            room=$("#selectcreditdetails option:selected").text();
                                                        }
                                                        
                                                      
                                                       
							   data = {
								  "set"					: "bill_settle_ta",
								  "type"				: selct,
								  "typenam"				: "6",
								  "creditype"			: creditype,
								  "creditdeatils"		: creditdeatils,
								  "paidamount_credit"	: paidamount_credit,
								  "amount_credit"		: amount_credit,
								  "bal"				: 0,
				                                   "stl" 		: drct,
                                                                   "credit_remarks_ta"        :credit_remarks_ta,
                                                                   "guestnumber"                 :guestnumber,
                                                                  "guestname"                 :guestname,
                                                                  "room"                      :room 
								};
                                                        
						  }else
						  {
                                                      
                                                      if(creditype=='4'|| creditype=='3'){
                                                          var sel_option='Enter Name ';
                                                          
                                                          $(".payment_pend_right_cash_error").css("display","block");
							  $(".payment_pend_right_cash_error").addClass("popup_validate");
							  $(".payment_pend_right_cash_error").text('Enter Name');
							  $('.payment_pend_right_cash_error').delay(2000).fadeOut('slow');
                                                        }
                                                        
                                                        else{
                                                            var sel_option="select option !";
							  var labelname=$("#selectcreditypes").find('option:selected').attr('label');
							  $(".payment_pend_right_cash_error").css("display","block");
							  $(".payment_pend_right_cash_error").addClass("popup_validate");
							  $(".payment_pend_right_cash_error").text(sel_option +labelname);
							  $('.payment_pend_right_cash_error').delay(2000).fadeOut('slow');
						  }}
					  }else
					  {    
                                              
                                                  var sel_credttype="select type !";
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
		{       var entremt=$("#hidentramt").val();
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
                    
                 if(selct!="complimentary")
		 {
			var entremt=$("#hidentramt").val();
			$(".payment_pend_right_cash_error").css("display","block");
			$(".payment_pend_right_cash_error").addClass("popup_validate");
			$(".payment_pend_right_cash_error").text(entremt);
			$('.payment_pend_right_cash_error').delay(2000).fadeOut('slow');
                 }else{ 
                        
                        var comp=$('#completext').val();//alert(comp)
			if(comp!='')
			{
						   data = {
								  "set"		: "bill_settle_ta",
                                                                 
								  "type"		: selct,
								  "typenam"		: "7",
								  "comp"		: comp,
                                                                  "stl" 		: drct
								};
						  
			}else{
                            
                        $(".payment_pend_right_cash_error").css("display","block");
			$(".payment_pend_right_cash_error").addClass("popup_validate");
			$(".payment_pend_right_cash_error").text('ENTER REMARKS');
			$('.payment_pend_right_cash_error').delay(2000).fadeOut('slow');
                       }
			
                 }    
                        
		}
                
                var coupon_code=$('#coupon_code').val();
                var bill_final_amount=$('#grandtotal').text();
                var bill_final_amount_new= bill_final_amount.replace(',','');
		var auth=$('#code_comp_credit').val();
                   
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
                   
              
        $('.submittranscations').addClass('disablegenerate');
                   
       setTimeout(function(){                                         
           $('.submittranscations').removeClass('disablegenerate');    
       }, 5000);  
                       
		     data = $(this).serialize() + "&" + $.param(data)+"&tip_amount="+tip_amount+"&tip_mode="+tip_mode+"&auth_staff="+auth+"&coupon_code="+coupon_code+"&bill_final_amount_new="+bill_final_amount_new+"&sms_bill_settle="+sms_bill_settle+"&num_sms_new="+num_sms_new+"&name_sms_new="+name_sms_new; //alert(data);
		//alert(data);    
                       $.ajax({
					type: "POST",
					url: "load_payments_ta_cs.php",
					data: data,
					success: function(msg)
					{  
                                          //  alert(msg);
                                           
                                            
                                           $('#shift_check').val($.trim(msg));
                                           
                                           if($.trim(msg)=="Please open the shift for the current login"){
                                                
                                                          $(".payment_pend_right_cash_error").css("display","block");
							  $(".payment_pend_right_cash_error").addClass("popup_validate");
							  $(".payment_pend_right_cash_error").text("Please Open Shift For Current Login");
							  $('.payment_pend_right_cash_error').delay(3000).fadeOut('slow');
                                                
                                           }else{
                                               
                                            
                                              
                                             $('#num_sms_new').val(''); 
                                             $('#name_sms_new').val(''); 
                                             $("#cash").click();
                                           
                                             $('#submitbutton_presscount').val(parseFloat($('#submitbutton_presscount').val())+1);
                                            
                                                if($('#submitbutton_presscount').val()==1){
                                                 
                                                $(".settle_popup_in_take_away").css("display","none");
                                                $(".confrmation_overlay").css("display","none");
                                             		  $('#sms_bill_settle').prop('checked',false);
							  $('.paymentclose').css("display","none");
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
						
                                        var bilfinal1=$('#billdetails').text();        
				        var bsth_kot_after_tahd=$('#bsth_kot_after_tahd').val();
                                        
                                        if(bsth_kot_after_tahd=='Y'){   
                                            
                                        var KOT_print = "TA_KOT_consol_print";
                
                                        $.post("printercheck_1.php", {type:KOT_print},

                                        function(data)
                                        { 

                                        data=$.trim(data); 
                                       
                                        if(data!=0){  
                                   
                                           alert('***WARNING : ' +data);
                                            
                                        }else{
                                            
                                            
                                            
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
                                        
                                        
                                        }
                                        }); 
                                        
                                       }
                                                    
                                                    
                                                
                                                
                                                if(settlebill1=='Y'){
                                                  
								  dataString = 'value=ta_billprint&bypass=y&homed=TA';
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
                                                
                                                                          var dataString; 
									  dataString = 'set=drawer_open_after_settlement_ta';
									  $.ajax({
									  type: "POST",
									  url: "cashdrawer_details.php",
									  data: dataString,
									  success: function(data3) {
                                                                              
										  data3=data3.trim();
										 
									   }
									  });
						 			  
					 

						
                                                if($("#settle_btn").hasClass("enable")){
                                                    
                                                                  
                                                      $(".settle_popup_in_take_away").css("display","none");


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
                                                        
                                                        $( ".paymnet_pop_mode_chnge" ).addClass( "mode_chg" );
                                                        $( ".paymnet_pop_mode_chnge_1" ).removeClass( "mode_chg" );
                                                        $(".paymnet_pop_mode_chnge").css("display","block");
                                                        $(".paymnet_pop_mode_chnge_1").css("display","none");

                                                   
                                                    $('.new_print_loading_bill_settle').show();
                                                   
                                                    $('.payment_pend_popup_left_cc').html('<img src="img/ajax-loaders/ajax-loader-6.gif" />');
                                                    
                                                    $.post("load_payments_takeaway.php", {modeval:modeval,set:'loadta_billdetails'},
                                                        function(data)
                                                        {
                                                            $('.payment_pend_popup_left_cc').html(data);
//                                                          $(".payment_pending_botm_btn ").removeClass("enable")
                                                        });
                                                        
                                                        $.post("load_payments_takeaway.php", {billno:"",set:'loadta_billitems'},
                                                        function(data)
                                                        {
                                                            $('.payment_pend_popup_right_tbl').html(data);
                                                             $("#total").text("0.00");
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
                              }else{
                                   
    $(".final_show").text('0.00');
    $(".tax_show").text('0.00');
    $("#tot_org").text('0.00');
    $(".total_itemcount1").text('0.00');
    $(".tal_viewtotal").text('0.00');
    $("#dis_pin").val('');
    $("#disountamount").val('');
    
     if( $('.cancel_reorder').css('display') == 'block') {
		window.location ='take_away_.php';
                                                
     }
                                $(".settle_popup_in_take_away").css("display","none");
                                $(".confrmation_overlay").css("display","none");
                                $('#taxdetails_div').html("");           
                                $('#submitbutton_presscount').val(0);
                                $('.new_print_loading_bill_settle').hide();
                                $('#searchb').focus();  
                  }
    }
                      
        setTimeout(function(){                                         
          $('.submittranscations').removeClass('disablegenerate');    
       }, 5000); 
        
        
         var  dataString1 = 'set=set_print_option_ta&print_option=Y' ;
            
		$.ajax({
		type: "POST",
		url: "load_index.php",
		data: dataString1,
		success: function(data) {
                    
                    
                }
            });
            
            
      ///live cloud sync on settle //                                  
       var cloud_api_on=$('#cloud_api_on').val();
  
       
       ///live cloud sync on settle ends//        
       
       
        ///lukado setup///
        var bil_lukado=$('#billdetails').text();
        setTimeout(function(){
            
          // $.post("lukado.php", {set:'lukado_bill',mode:'TA',billno:bil_lukado},function(data){  });
        
         }, 1800); 
          ///lukado setup end///
       
        $('#billdetails').empty();	
                                   
        }
        }
});
                                
                        var data_pole = "set_pole=pole_display_all&display=thankyou";
			$.ajax({
			type: "POST",
			url: "index.php",
			data: data_pole,
			success: function(data5) {
                            
			if(localStorage.coming_fromta=='direct_flow'){
                            
                            if($('#shift_check').val()!="Please open the shift for the current login"){
                                
                                 $(".settle_popup_in_take_away").css("display","none");
                                 $(".confrmation_overlay").css("display","none");
                                
                                 if( $('.cancel_reorder').css('display') == 'block') {
                                     window.location.href = "take_away_.php";
                                 }
                               
                                 $('#taxdetails_div').html("");    
                               
                                $('.new_print_loading_bill_settle').hide();
                                $('#submitbutton_presscount').val(0);
                                
    $(".final_show").text('0.00');
    $(".tax_show").text('0.00');
    $("#tot_org").text('0.00');
    $(".total_itemcount1").text('0.00');
    $(".tal_viewtotal").text('0.00');
    $("#dis_pin").val('');
    $("#disountamount").val('');
    $('#searchb').focus();  
                            }
                        }
                        else{
                            
                            if($('#shift_check').val()!="Please open the shift for the current login"){
                                
                              window.location.href = "take_away_.php?settacommon=settletapopup"; 
                           
                            $('#taxdetails_div').html("");    
                           
                            $(".confrmation_overlay").css("display","block");
                            $('.new_print_loading_bill_settle').hide();
                           
                            $('#submitbutton_presscount').val(0);
                           
                            $('#searchb').focus();  
                            
                            }  
                        }
                      
                         
			}
			}); 
                        
                        
         $("#customer_set_data2").css("display","block");
         $("#customer_set_data3").css("display","none");
          
         $("#customer_set_data1").css("display","none");
         $("#customer_set_data4").css("display","none");
        
         $("#customer_set_data5").css("display","block");
         $("#customer_set_data6").css("display","none");            
                        
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
		{ 
                        var sel_paytype=$("#hidsel_paytype").val();
			$(".payment_pend_right_cash_error").css("display","block");
			$(".payment_pend_right_cash_error").addClass("popup_validate");
			$(".payment_pend_right_cash_error").text(sel_paytype);
			$('.payment_pend_right_cash_error').delay(2000).fadeOut('slow');
		}
                 
            }
                 $('#searchb').focus();  
  });
                
//-----------------payment settle ends---------------///



$('.confirmkot_ta_no').click(function () {
      $('.kotconfirmpopup_ta').css('display','none');   
          
      $(".confrmation_overlay").css("display","none");  
});


$('.confirmkot_ta').click(function (event) {
   
     event.stopImmediatePropagation();
     $('.new_print_loading_bill').css('display','block');
      
     $('.kotconfirmpopup_ta').css('display','none');   
          
     $(".confrmation_overlay").css("display","none");  
    
         
       var msg=$('#kotfailmsg_ta').html();
          
             var dataString_log ='set_log=kotconfirmbylogin&failmsg='+msg;
             $.ajax({
             type: "POST",
             url: "menu_order.php",
             data: dataString_log,
             success: function(data) {
             
             }
             });
    
        var mobile=$('#ta_mobile').val();
        var name=$('#ta_name').val();
        var landmark=$('#ta_landmark').val();
        
        var id_ta=$('.settle_popup_btn').attr('id');
       
     
        var mode=$('.mode').attr('mode');
        var mobile=$('#ta_mobile').val();
        var name=$('#ta_name').val();
        var landmark=$('#ta_landmark').val();
     
          var staffwithdiscountta1=$('#staffwithdiscountta').val();
	var itemsact = $('.eachitem_counter');	
	var actlenght=(itemsact.length);
	if(actlenght>=1)
	{
            var disc=$('#counter_discount_popup').val();
            $('.settypeval').val($('.home_delevery_popup_btn').attr('setpay'));
           
                        if(mode=="HD")
			{ 
                            if(mobile==""){
				$('#ta_mobile').addClass('textbox_alert');
				$('#ta_mobile').focus();
				return false;	
                            }

                            else{
                                if(id_ta=="skip" && disc=="Y" && staffwithdiscountta1=="Y"){ 
                                    $(".home_delevery_address_popup").css("display","none");
                                    $('.disountenterpopup').css('display','block');
                                    $('.confrmation_overlay').css('display','block');
                                    
                                    if(id_ta=="skip"){
                                  $('.closedisount').addClass(id_ta);
                                  }
                                  else{
                                      $('.closedisount').removeClass('skip');
                                  }
                                }else{
                                   
                                    $(".home_delevery_address_popup").css("display","none");
                                    if(id_ta=="skip"){
                                        $('.closedisount').addClass(id_ta);
                                    }else{
                                        $('.closedisount').removeClass('skip');
                                    }
                                        $(".closedisount").trigger("click");
                                }
                            }
                        }
                        else if(mode=='TA'){
            
                                if(id_ta=="skip" && disc=="Y" && staffwithdiscountta1=="Y")
                                { 
                                    $(".home_delevery_address_popup").css("display","none");
                                    $('.disountenterpopup').css('display','block');
                                    $('.confrmation_overlay').css('display','block');
                                    if(id_ta=="skip"){
                                        $('.closedisount').addClass(id_ta);
                                    }
                                    else{
                                        $('.closedisount').removeClass('skip');
                                    }
                                }else
                                { 
                                    $(".home_delevery_address_popup").css("display","none");
                                    if(id_ta=="skip"){
                                      $('.closedisount').addClass(id_ta);
                                    }
                                    else{
                                        $('.closedisount').removeClass('skip');
                                    }
                                    $(".closedisount").trigger("click");
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

   $('.settle_popup_btn').click(function (event) {
          
          
	event.stopImmediatePropagation();
        var mode=$('.mode').attr('mode');
        var mobile=$('#ta_mobile').val();
        var name=$('#ta_name').val();
        var landmark=$('#ta_landmark').val();
        var KOT_print = "TA_KOT_consol_print";
               
                $.post("printercheck_1.php", {type:KOT_print},

                function(data)
                { 
                data=$.trim(data); 
               
                if(data !=''){
                    
                  var mode=$('.mode').attr('mode');
                  var mobile=$('#ta_mobile').val();
              
                if((mode=='HD' && mobile!="") || mode=='TA' ){
                             
                $('.home_delevery_address_popup').css('display','none');  
                $('.kotconfirmpopup_ta').css('display','block');   
                $('.disountenterpopup').css('display','none');
                $(".confrmation_overlay").css("display","block");
                $('#kotfailmsg_ta').html(data);
                
                }else{
                    $('#ta_mobile').addClass('textbox_alert');
		    $('#ta_mobile').focus();
                }

                }else  {
                    
        $('.closedisount').attr('from_btn','kot_gen');

        var id_ta=$(this).attr('id');
     
        var mode=$('.mode').attr('mode');
        var mobile=$('#ta_mobile').val();
        var name=$('#ta_name').val();
        var landmark=$('#ta_landmark').val();
     
        var staffwithdiscountta1=$('#staffwithdiscountta').val();
	var itemsact = $('.eachitem_counter');	
        var itemsact1 =$('.combo_added_sec');
        var actlenght=(parseFloat(itemsact.length)+parseFloat(itemsact1.length));//alert(actlenght);
	if(actlenght>=1)
	{
            var disc=$('#counter_discount_popup').val();
            $('.settypeval').val($('.home_delevery_popup_btn').attr('setpay'));
            
                        if(mode=="HD")
			{ 
                            if(mobile==""){
				$('#ta_mobile').addClass('textbox_alert');
				$('#ta_mobile').focus();
				return false;	
                            }

                            else{
                                if(id_ta=="skip" && disc=="Y" && staffwithdiscountta1=="Y"){ 
                                    $(".home_delevery_address_popup").css("display","none");
                                    $('.disountenterpopup').css('display','block');
                                    $('.confrmation_overlay').css('display','block');
                                    
                                    if(id_ta=="skip"){
                                  $('.closedisount').addClass(id_ta);
                                  }
                                  else{
                                      $('.closedisount').removeClass('skip');
                                  }
                                }else{
                                    
                                    $(".home_delevery_address_popup").css("display","none");
                                    if(id_ta=="skip"){
                                        $('.closedisount').addClass(id_ta);
                                    }else{
                                        $('.closedisount').removeClass('skip');
                                    }
                                        $(".closedisount").trigger("click");
                                }
                            }
                        }
                        else if(mode=='TA'){ 
            
                                if(id_ta=="skip" && disc=="Y" && staffwithdiscountta1=="Y")
                                { 
                                    $(".home_delevery_address_popup").css("display","none");
                                    $('.disountenterpopup').css('display','block');
                                    $('.confrmation_overlay').css('display','block');
                                    if(id_ta=="skip"){
                                        $('.closedisount').addClass(id_ta);
                                    }
                                    else{
                                        $('.closedisount').removeClass('skip');
                                    }
                                }else
                                { 
                                    $(".home_delevery_address_popup").css("display","none");
                                    if(id_ta=="skip"){
                                      $('.closedisount').addClass(id_ta);
                                    }
                                    else{
                                        $('.closedisount').removeClass('skip');
                                    }
                                    
                                    $(".closedisount").trigger("click");
                                    
                                }
                            }
        }else
	{
		$('.ta_errormsg').css("display",'block');
                $('.ta_errormsg').text("Nothing to generate");
                $('.ta_errormsg').delay(2000).fadeOut('slow');
	}
        

		return true;
            }  });
	});
        
    //------------ payment popup detailes ends-----------//
      
    $(".printbill").click(function(e){
            
        e.stopImmediatePropagation();
	var genset=$('#genset').val();
        var name=$('#ta_name').val();
		var address=$('#ta_address').val();
		var ordaddress=$('#ta_orderaddress').val();
		var landmark=$('#ta_landmark').val();
		var area=$('#ta_area').val();
		var mobile=$('#ta_mobile').val();
		var homed=$('.mode').attr('mode'); 
		var discount_of=$("#disountamount").val();
		var discount_unit=$("input[name='typesel']:checked").val();
		var discountid=$("#disountamount_drop").val();
		var discount_of=$("#disountamount").val();
		if(discountid=='none' && discount_of=='0')
		{
			var discount='N';
		}
		else
		{
			var discount='Y';
		}
		if(discountid!='none')
		{
			discount_of=='0';
		}
				
		
		 $('.disountenterpopup').css('display','none');
			var dataString;
			
			dataString = 'value=printbefor_confirm&name=' + name +'&address=' + address +'&orderaddr='+ ordaddress +'&landmark=' + landmark +'&area=' + area +'&mobile=' + mobile +'&homed=' + homed + '&discount_of='+ discount_of + '&discount=' + discount + ' &discount_unit='+discount_unit+ ' &discountid='+discountid;
			//alert(dataString);	
				
				 $.ajax({
					type: "POST",
					url: "load_takeaway.php",
					data: dataString,
					success: function(data) {
						
                                                dataString = 'value=getbill_amt';
                                                $.ajax({
                                                    type: "POST",
                                                    url: "load_takeaway.php",
                                                    data: dataString,
                                                    success: function(datax) {
//                                                  
                                                }
                                                });
                                               
						if($('#hidprinter').val()=="Y" && genset=="Y")
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
								  
								 
							  
							 
						}
						
						
						}
					});
			
	});
        
        
  $('.ta_holdorder').click(function (event) {
            
          var cs_check=$('.total_itemcount1').text();
     
          if(cs_check>0){
          
           event.stopImmediatePropagation();
			$("#confirmhold").css("display","block");
			$(".confrmation_overlay").css("display","block");
          
            }else{
                
                        $('.alert_error_popup_all_in_one').show();
                        $('.alert_error_popup_all_in_one').text('No items to hold');
                        $('.alert_error_popup_all_in_one').delay(1000).fadeOut('slow');   
            }
           

	});
        
        
   $('.confirmholdccl').click(function (event) {
       
	                event.stopImmediatePropagation();
        
			$("#confirmhold").css("display","none");
			$(".confrmation_overlay").css("display","none");
   });
        
   $('.confirmholdok').click(function (event) {
       
		event.stopImmediatePropagation();
				var request = $.ajax({
					url: "load_payments_takeaway.php",
					method: "POST",
					data: {set:'addhold'},
					dataType: "html"
				  });
				   
				  request.done(function( msg ) {
					
					window.location="take_away_.php";
					
				  });
				  
				  data = null;
					msg=null;
				  request.onreadystatechange = null;
				  request.abort = null;
				  request = null;
	});
        
        
    $('.calculator_settle').click( function(event) {
 
		event.stopImmediatePropagation();
		var focused=$('#focusedtext').val();
		var calval=($(this).text());
		
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
				}else if(org==".")
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
        
 $('.calculator_settle1').click( function(event) {
  
		event.stopImmediatePropagation();
		var focused=$('#focusedtext').val();
		var calval=($(this).text());
	
        
        if(calval==2000 || calval==500 || calval==200 || calval==100 || calval==50 || calval==20 || calval==10  || calval==1000  ){
                  $('#'+focused).val("");
               }
        
        
              var focusedsplit=focused.substring(0,6);
               
            
              if(focusedsplit=="countc"){
                  
                 $('#countcard').val("");
               
              
              }else if(focusedsplit=="card_1"){
                 
                   var t=$('#card_1').val();
                  
                  var len= $('#'+focused).val().length;
                
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
        
  $('input').click( function(event) {
		
				var redo=$(this).attr('readonly');
				if(redo!="readonly")
				{
		var fcsed=$(this).attr('id');
		$('#focusedtext').val(fcsed);
				}
			
	
});

    ////*******COMBO STARTS *************************///
    
    
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
                url: "load_takeaway.php",
                data: dataString,
                success: function(data) {
                    
                     var food= $('.online_order_box_act').attr('food_val');
          
                   $('.take_left_main_list').html(data);
                   var combo_name_id=$('.combo_name_selection_click').attr('combo_name_id');
                   //alert(combo_name_id);
                   var dataString = 'value=load_combo_menus&combo_name_id='+combo_name_id+"&food="+food;
                    $.ajax({
                        type: "POST",
                        url: "load_takeaway.php",
                        data: dataString,
                        success: function(data1) {
                            
                           $('#ta_loadmenuitems').html(data1);     
                        }
                    });
                }
            });
        });
        
        
  $('#back_to_maincategory').click(function(){
         // location.reload();  
          
          window.location.href='take_away_.php';
      
        
   });
        
  $('.combo_name_selection_click').click(function(){ 
            
            var food= $('.online_order_box_act').attr('food_val');
          
            $('.main_category_list').removeClass('main_category_list_act');
            $(this).find('.main_category_list').addClass('main_category_list_act');
          
            var combo_name_id=$(this).attr('combo_name_id');

            var dataString = 'value=load_combo_menus&combo_name_id='+combo_name_id+"&food="+food;
                $.ajax({
                    type: "POST",
                    url: "load_takeaway.php",
                    data: dataString,
                    success: function(data) {
                       $('#ta_loadmenuitems').html(data);     
                    }
                });
        });
        
        
   $('.preference_table').click(function () {
             
                if($(this).find('.combo_menu_div') && sessionStorage.clickdisable!=1 ){
                   var status=$(this).find('.combo_menu_div').attr('status');
                   var id=$(this).find('.combo_menu_div').attr('id');
                   var parent_div_id=$(this).attr('id');
                   var sts=status.trim();
                   var combo_pack_id=$(this).find('.combo_menu_div').attr('combo_pack_id');
                   var combo_pack_qty=$(this).find('.combo_menu_div').attr('combo_pack_qty');
                   var combo_preference;
                    var food= $('.online_order_box_act').attr('food_val');
                   localStorage.cod_count_combo_ordering=$(this).find('.combo_menu_div').attr('cod_count_combo_ordering');
                   var dataString = 'set=load_combo_ordering_popup_for_edit&combo_pack_id='+combo_pack_id+"&combo_pack_qty="+combo_pack_qty+"&food="+food;
                        $.ajax({
                            type: "POST",
                            url: "combo_ordering_popup_ta.php",
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
                              
                                $('#combo_qty_select').val(combo_pack_qty);
                                $('#combo_qty_select').focus();
                            }
                        });
                }
            });
        
        
    ////*********************COMBO ENDS ***********///    
});

$(document).keyup(function(e){
    
     e.preventDefault();
    if (e.keyCode == 27) {
        if($('#ta_loadbottomcontent-1:visible').length == 1)
            {   
                $(".confrmation_overlay").css("display","none");
                $(".new_overlay").css("display","none");
                $('#ta_loadbottomcontent-1').css("display","none");
                
                 $('#searchb').focus();
            }
        if($('#confirmhold:visible').length == 1)
            {  
                $("#confirmhold").css("display","none");
                $(".confrmation_overlay").css("display","none");
            }
        if($('.payment_pend_popup:visible').length == 1 && $('.kotcancel_reason_popup_new:visible').length == 0)
            {  
                $(".payment_pend_popup").css("display","none");
                $(".confrmation_overlay").css("display","none");
            }
        if($('.kotcancel_reason_popup_new:visible').length == 1)
            {  
                $(".kotcancel_reason_popup_new").css("display","none");
                $("#payment_newcancel_confirm_overlay").css("display","none");
            }
        
        if($('.confirm_detail_con_pop:visible').length == 1)
            {
                $('.close_btn_validate').click();
		$('.new_alert_cc').css('display','none');
		$('.confirm_detail_con_pop').css('display','none');
		window.location="take_away_.php";
            }
        if($('.home_delevery_address_popup:visible').length == 1)
            {  
                $(".home_delevery_address_popup").css("display","none");
                $(".confrmation_overlay").css("display","none");
            }    
        if($('.kotconfirmpopup_ta_bill:visible').length == 1)
            {  
                $(".kotconfirmpopup_ta_bill").css("display","none");
                $(".confrmation_overlay").css("display","none");
            }
        if($('.kotconfirmpopup_ta:visible').length == 1)
            {  
                $(".kotconfirmpopup_ta").css("display","none");
                $(".confrmation_overlay").css("display","none");
            }
        if($('.kotconfirmpopup_ta_lastbill:visible').length == 1)
            {  
                $(".kotconfirmpopup_ta_lastbill").css("display","none");
                $("#payment_newcancel_confirm_overlay").css("display","none");
                
            }    
            
            
            if($('.settle_popup_in_take_away:visible').length == 1)
            {  
                
                 $(".settle_popup_in_take_away").css("display","none");
                 $(".confrmation_overlay").css("display","none");
                 $('#searchb').val('');  
                 $('#searchb').focus();  
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
    
        var food= $('.online_order_box_act').attr('food_val');
        localStorage.cod_count_combo_ordering='';
       
        var dataString = 'set=load_combo_ordering_popup&combo_pack_id='+combo_pack_id+"&food="+food;
        
        $.ajax({
            type: "POST",
            url: "combo_ordering_popup_ta.php",
            data: dataString,
            success: function(data) {
                $("#combo_ordering_popup").css('display','block');
                $("#combo_ordering_popup").html(data);     
            }
        });
        
    };


function IsNumeric(strString)
{
    
  var strValidChars = "0123456789-+(). ";
  var strChar;
  var blnResult = true;
  if (strString.length == 0) {return false;}
  var a= strString.length;
  if(strString.length>30 )
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

function enterbalance(e)
  {

 
                $('#focusedtext').val('paidamount');
	  	var paid=$('#paidamount').val();
              
		var grand=$('#grandtotal').text();
                var decimal=$('#decimal').val();
                
                  if(paid=="" || paid=="undefined" || paid=='0'){
                      
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
                  }
                
                
                
		 if($('#transbal').val()!="")
		 { //alert('2');
			 var subt=$('#transbal').val();
			 var bal=parseFloat(paid.replace(/,/g, "")) -  parseFloat(subt.replace(/,/g, ""));
			 
		 }
                 else if($('#coupbal').val()!="")
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
		 }
		 else 
		 { 
		 	var bal=parseFloat(paid.replace(/,/g, "")) -  parseFloat(grand.replace(/,/g, ""));
		 }
                 
		 if(parseFloat(bal)<0 ||isNaN(bal))
			 {
                             var insufamt=$("#hidinsufamt").val();
                             $('#balanceamout').val("");
				 $(".payment_pend_right_cash_error").css("display","block");
				 $(".payment_pend_right_cash_error").addClass("popup_validate");
			 	$(".payment_pend_right_cash_error").text(insufamt);
				$('.payment_pend_right_cash_error').delay(2000).fadeOut('slow');
		  
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
          
          function transamountchange(e)
		{  
                 
                    $('#transcationid').focus();
                   $('#paidamount').val('');
                   $('#currencyta').val('');
                   $('#balanceamout').val('');
                  
			var tt=0;
                        var decimal=$('#decimal').val();
			var gd=parseFloat($('#grandtotal').text().replace(/,/g, ""));
			var dc=parseFloat($('#transcationid').val().replace(/,/g, ""));
			tt = parseFloat(gd -  dc);
                        
                        if(dc==gd){
                            
                             $('#selecta').attr("disabled", true);
                      $('#currencyta').attr("disabled", true);
                        }else
                        {
                            $('#selecta').attr("disabled", false);  
                             $('#currencyta').attr("disabled", false);
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
				
			document.getElementById("transbal").value=tt.toFixed(decimal);
			if(tt==0)
			{
				$("#paidamount").val('0');
				$("#balanceamout").val('0');
				//$('#balanceamout').focus();
			}
			}
		//}
                if(event.keyCode == 13)
              {
                
                
                                 $('.submittranscations').click();
              }  
		}

function enterbalance_credit(e)
	  { 
		
	  	var paid=$('#paidamount_credit').val();
                var grand=$('#grandtotal').text();
		var letterNumber = /^[0-9 .]+$/; 
                  
                  
                   var decimal=$('#decimal').val();
                   
                      if(parseFloat(paid)>grand){
                         
                                 $('#paidamount_credit').val("");
				 $(".payment_pend_right_cash_error").css("display","block");
				 $(".payment_pend_right_cash_error").addClass("popup_validate");
			 	 $(".payment_pend_right_cash_error").text('INVALID AMOUNT');
				 $('.payment_pend_right_cash_error').delay(2000).fadeOut('slow');
                          
                      }
                   
                   
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
		
		  
 }

function couponamountchange(e)
		{ 
			var tt=0;
			var gd=parseFloat($('#grandtotal').text().replace(/,/g, ""));
			var dc=parseFloat($('#coupamount').val().replace(/,/g, ""));
                        var decimal=$('#decimal').val();
                       
			tt = parseFloat(gd -  dc); 
                        
                        
                         if(dc=="" || dc=="undefined" || dc=='0'){
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
                  }
                        
                        
                        
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
                
                
      function delete_ta_item(m,s) {
          
          
     var notchk =  $('.comp_bill:checkbox:not(":checked")').length;
     
     var chk=$('.comp_bill:checkbox:checked').length;
     
     var chk_single=$("#comp_bill_"+m+'_'+s+':checkbox:checked').length;
     
    var notchk_single=$("#comp_bill_"+m+'_'+s+':checkbox:not(":checked")').length; 
 
   if(notchk>1  || $('.comp_bill').length==0 || chk_single==1 ||  (notchk_single==1 && chk==0)  ){  
          
          
          
          sessionStorage.clickdisable=1;
           $('#checkid_ta').val('delete_item');
			  //alert(menu);
			  var dataString;
			  dataString = 'value=deleteitemstake&menuid=' + m +'&sln=' + s;
			  var request=  $.ajax({
			type: "POST",
			url: "load_takeaway.php",
			data: dataString,
			success: function(data) {
				
				$('#ta_confirm').css('display','none');
				
				}
	  		});
				var dataString1;
						dataString1 = 'value=orderlistload';
						var request1=  $.ajax({
						type: "POST",
						url: "load_takeaway.php",
						data: dataString1,
						success: function(data1) {
								$('#ta_orderlist').html(data1);
								
								$(".delitems").addClass("right_act_delete_dsbl");
                                                                $(".edititems").addClass("right_act_edit_dsbl");
                                                                sessionStorage.clickdisable=0;
								
							}
						});
						$.ajaxSetup({cache: false});
						dataString1=null;
						data1 = null;
						request1.onreadystatechange = null;
						request1.abort = null;
						request1 = null;
				
								var itemsact = $('.eachitem_counter');	
								var actlenght=(itemsact.length);//alert(actlenght);
								if(actlenght>=1)
								{
									$('.countergenerate').css("display","block");
								}else
								{
									$('.countergenerate').css("display","none");
								}
			  $('.ta_errormsg').css("display",'block');
			  $('.ta_errormsg').text("DELETED");
			  $('.ta_errormsg').delay(2000).fadeOut('slow');
			  
			  $('#searchb').focus();
				
			 data = null;
		 dataString = null;
		request.onreadystatechange = null;
		request.abort = null;
		request = null;
		 return false;
          
           }else{
              
          //   $("#comp_bill_"+m+'_'+s).attr('checked',false);
                 
               
             alert('ONE ITEM SHOULD BE THERE FOR BILL PRINT WITH RATE ')
     }
          
          
      }          
                
                
     function regen_ta_cs(bill){
      
     var dataString = 'set=regen_ta_cs&bill='+bill;
	 var request=  $.ajax({
		type: "POST",
		url: "load_takeaway.php",
		data: dataString,
		success: function(data) {
                  
	  window.location.href='take_away_.php';
		}
	  });    
      
      
  }                   
                
                

$('#selectcreditypes').change(function () {
			  var credittype=	$(this).val();
			 $('.credtitypeloads').html('<img src="img/ajax-loaders/ajax-loader-6.gif" />');
			 var labelname=$("#selectcreditypes").find('option:selected').attr('label');
			 
			  $.post("load_takeaway.php", {credittype:credittype,value:'loadcreditypes'},
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
				  
				    
				  });
	});
        
                
$('.order_before').click(function(){
    
                var homed = $('#mode_set').val();
                var mobile=$('#ta_mobile').val();
                var custid=$('#ta_id').val();
                var name=$('#ta_name').val();
		var address=$('#ta_address').val();
                var orderaddress=$('#ta_orderaddress').val();
		var landmark=$('#ta_landmark').val();
		var area=$('#ta_area').val();
                var remarks=$('#ta_remarks').val();
		var gst=$('#ta_gst').val();
                var del_boy=$('#hd_boy').val();
                var ref_no=$('#ta_ref_new').val();
               
                var phone_order=$('#ta_mobile').attr('phone_order'); 
    
         $('#ta_cus_name_new').text(name);
             
         $('#ta_cus_num_new').text(mobile);
           
        if((mobile!='' && homed=='HD') || homed=='TA'){ 
             
        var dataString = 'value=order_before&mobile='+mobile+"&name="+name+"&address="+address+"&orderaddress="+orderaddress+"&landmark="+landmark
        +"&area="+area+"&remarks="+remarks+"&gst="+gst+"&custid="+custid+"&del_boy="+del_boy+"&ref_no="+ref_no+"&phone_order="+phone_order;
	
        var request=  $.ajax({
		type: "POST",
		url: "load_takeaway.php",
		data: dataString,
		success: function(data) { 
                  
	   $(".home_delevery_address_popup").css("display","none");
           $(".confrmation_overlay").css("display","none");
           $('#set_phone_order').val('N');
           location.reload();
           
	  }
	  });    
               }else{
                   
                    $('#ta_mobile').addClass('textbox_alert');
		    $('#ta_mobile').focus();
                    
               }
                
});

