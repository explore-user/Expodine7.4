<!--<script src="js/jquery-1.10.2.min.js"></script>-->
<script type="text/javascript" src="js/shortcut.js"></script> 
<script type="text/javascript"> 
		$(document).ready(function(){
                    
                    
                   
                    
			shortcut.add("Ctrl+Shift+H",function() {
			window.location="index.php";
			});	
			shortcut.add("Ctrl+O",function() {
				window.location="table_selection.php";
			});
			shortcut.add("Ctrl+K",function() {
				window.location="kot_checklist.php";
			});	
//			shortcut.add("Ctrl+G",function() {
//				window.location="completed_order.php";
//			});
			shortcut.add("Ctrl+S",function() {
				window.location="payment_pending.php";
			});	
			shortcut.add("Ctrl+B",function() {
				window.location="bill_history.php";
			});	
			shortcut.add("Ctrl+H",function() {
				window.location="kot_history.php";
			});		
			
//			shortcut.add("Alt+O",function() {
//				window.location="take_away.php";
//			});
			shortcut.add("Alt+K",function() {
				window.location="take_away_kot.php";
			});	
			shortcut.add("Alt+S",function() {
				window.location="payments_ta_cs.php?mode=TA";
			});	
			shortcut.add("Alt+B",function() {
				window.location="ta_bill_history.php";
			});	
			shortcut.add("Alt+L",function() {
				window.location="total_ta_bill_history.php";
			});
			
			shortcut.add("Alt+A",function() {
				window.location="take_away_list.php";
			});
//			shortcut.add("Alt+H",function() {
//				window.location="take_away_staff.php";
//			});	
			
			shortcut.add("Ctrl+Shift+C",function() {
				window.location="counter_sales.php";
			});
			shortcut.add("Ctrl+Shift+S",function() {
				window.location="payments_ta_cs.php?mode=CS ";
			});	
			shortcut.add("Ctrl+Shift+B",function() {
				window.location="cs_bill_history.php";
			});	
			
			shortcut.add("Ctrl+Shift+G",function() {
				window.location="branch_settings.php";
			});
			shortcut.add("Ctrl+Shift+M",function() {
				window.location="category_master.php";
			});	
			shortcut.add("Ctrl+Shift+R",function() {
				window.location="report.php";
			});
				
			
			shortcut.add("Ctrl+Shift+K",function() {
				window.location="kod_screen.php";
			});	
			shortcut.add("Ctrl+Shift+I",function() {
				window.location="packingcounter.php";
			});	
			shortcut.add("Ctrl+Shift+L",function() {
				window.location="loyalty/registration.php";
			});	
//			shortcut.add("Ctrl+Shift+M",function() {
//				window.location="main_report.php";
//			});
			shortcut.add("Ctrl+Shift+E",function() {
				window.location="credit.php";
			});	
			shortcut.add("Ctrl+Shift+V",function() {
				window.location="expense_voucher.php";
			});
                        shortcut.add("Ctrl+L",function() {
				window.location="loyalty/index.php";
			});
                        shortcut.add("Ctrl+Shift+A",function() {
				window.location="analytics.php";
			});
                        shortcut.add("Ctrl+Shift+B",function() {
				window.location="banquet_list.php";
			});
                        shortcut.add("Ctrl+M",function() {
				window.location="menu.php";
			});
                        shortcut.add("Alt+Shift+P",function() {
				window.location="printer_master.php";
			});
                        
                          shortcut.add("Ctrl+Shift+O",function() {
				$('#takorder').click();
			});
                        
                        shortcut.add("Ctrl+P",function() {
                            
                          
                            if($('.print-bill-in-tableselection-popup-cc:visible').length == 1){
                               
                                    $('#print_bill_from_tablesel').click(); 
                                $('.buttons_tab_active_2').removeClass("table_select");
                                
                            }else{
                                
                              
                               $(".print-table-btn").click();   
//                               // $('.print-bill-in-tableselection-popup').hide();
//                                
                              var $ct_print=0;  
                                
                             setTimeout(function () {
                            $ct_print++;
                            
                             if($ct_print==1){
                      $('#print_bill_from_tablesel').click(); 
                      $('.print-bill-in-tableselection-popup-cc').css('display','none');
                              }
                               
                         }, 100); 
                         
                         
                         
                     
                            }
                        });
                        
                         shortcut.add("Alt+Shift+G",function() {
				 $('.billedclic').click();
			});
                        
                        
                         shortcut.add("Alt+Shift+D",function() {
				window.location.href="table_selection.php"; 
			});
                        
                         shortcut.add("Alt+Shift+C",function() {
				window.location.href="counter_sales.php"; 
			});
                        
                         shortcut.add("Alt+Shift+T",function() {
				window.location.href="take_away_.php"; 
			});
                        
                        
                        
                        shortcut.add("Alt+C",function() {
                             var check_order= $('.total_itemcount1').text();
   
                             if(check_order>0){
                            //alert('CLEAR CART TO CHANGE');
				 $('.online_pop_show').show();
    $('#load_partners').html('CLEAR THE ITEMS IN CART TO SWITCH ONLINE PARTNER');
     $('.clear_all_ok_ta_online').show();
     $('.exit_online').css('display','inline-block');
                             }else{
                                 var dataString = 'set=change_online_by_key';
				   $.ajax({
				  type: "POST",
				  url: "load_takeaway.php",
				  data: dataString,
				  success: function(data3) {
					window.location.href="take_away_.php";
					  }
				 });
                             }
			});
                        
                        
 /**********************************cash drawer open starts******************************************/
 			shortcut.add("Alt+Q",function() {
				
				
				 var dataString = 'set=drawer_open';
				   $.ajax({
				  type: "POST",
				  url: "cashdrawer_details.php",
				  data: dataString,
				  success: function(data3) {
					  data3=data3.trim();
					 
					  
					  }
				  });	
                                  
                                  
                                
				var  dataString1 = 'set=drawer_open_on_settle';
				   $.ajax({
				  type: "POST",
				  url: "cashdrawer_details.php",
				  data: dataString1,
				  success: function(data3) {
					
					  }
				  });	
                                  
                                  
                                  //ta///
                                  
                                 
				 var dataString2 = 'set=drawer_ta_open_settlepopup';
				   $.ajax({
				  type: "POST",
				  url: "cashdrawer_details.php",
				  data: dataString2,
				  success: function(data3) {
					
					  }
				  });	
                                  
                                 
				var  dataString3 = 'set=drawer_open_after_settlement_ta';
				   $.ajax({
				  type: "POST",
				  url: "cashdrawer_details.php",
				  data: dataString3,
				  success: function(data3) {
					
					  }
				  });	
                                  
                                  ///cs////
                                  
                                  
                                  
                                
				var  dataString4 = 'set=drawer_cs_open_settlepopup';
				   $.ajax({
				  type: "POST",
				  url: "cashdrawer_details.php",
				  data: dataString4,
				  success: function(data3) {
					
					  }
				  });	
                                  
                                  
				 var dataString5 = 'set=drawer_cs_open_after_settlement';
				   $.ajax({
				  type: "POST",
				  url: "cashdrawer_details.php",
				  data: dataString5,
				  success: function(data3) {
					
					  }
				  });	
                                  
			});
 
 

				
				
			
  /**********************************cash drawer open ends******************************************/
		
   //////////////////////////////////////Confirm Oder Start///////////////////////////////////////////////////
   
   shortcut.add("Ctrl+C",function() {
       
       var cs_check= $('.total_itemcount2').text();
       var di_check= $('.total_itemcount').text();
       var ta_check = $('.total_itemcount1').text(); 
     
  
       if(cs_check > 0){
           // $(".countergenerate").click(); 
           $('.alert_error_popup_all_in_one').show();
                                    
                        $('.alert_error_popup_all_in_one').text('BILLING');
                        $('.alert_error_popup_all_in_one').delay(1500).fadeOut('slow');  
           
          $(".settle_direct").click();  
           
       }else if(di_check > 0){
      
       $(".confirmallfdetails").click();
       
       }else if(ta_check > 0){
           $('.home_delevery_address_popup').hide();
        //  $('.take').click();
           $('#quick_bill_ta_hd').click();
       }
       
       
//        document.getElementById("confirmallfdetails").click();

    
                });
    
    
     
    //////////////////////////////////Confirm order end/////////////////////////////////////
    
    /////////////////////////////////backto start//////////////////////////////////////////
        shortcut.add("Ctrl+Z",function() { 
           
//        document.getElementById("backtotablesel").click();  
        if($('.preference_table').find('div').hasClass('menu_order_confirm_btn') || $('.preference_table').find('div').hasClass('menu_order_confirm_yellow_btn') || $('.preference_table').find('div').hasClass('menu_order_delet_btn'))
		 {
			 $.post("load_div.php", {set:'backto'},
			function(data)
			{
			data=$.trim(data);
			//alert(data);
			window.location="table_selection.php";
			});
		 }else
		 {
			 
			$.post("load_div.php", {set:'chkresrvd'},
			function(data)
			{
			data=$.trim(data);//alert(data);
			window.location="table_selection.php";
			});	
		 }
   
                });
                
        /////////////////////////Print complete order////////////////////        
//           shortcut.add("Shift+P",function(event) { 
//               event.stopImmediatePropagation();
//               $('#printcompletedorder').trigger('click');
              // alert('hu');
                //document.getElementById("printcompletedorder").click();  
//        var compordermsg1 = ($("#compordermsg1").val());
//		 if($('.clickeachrowcompld').hasClass('tr_bill_gen_active') )
//		{
//			
//			if($('#printconfirmation').val()=="Y")
//			{
//				
//				  $('.confrimprint').css('display','block');
//				  $('.confrmation_overlay').css('display','block');
//			}else
//			{
//			
//				   var printwithdiscount=$('#printwithdiscount').val();
//				
//			
//				   var printwithloyality=$('#printwithloyality').val();
//				 var staffwithdiscount=$('#staffwithdiscount').val();
//				
//				   $("#loyalityid").val('');
//				   if(printwithloyality=='N')
//				   {
//					   if(printwithdiscount=='Y' && staffwithdiscount =='Y' )
//					   {
//						 if($('.clickeachrowcompld').hasClass('tr_bill_gen_active') )
//							{
//								
//							  $('.disountenterpopup').css('display','block');
//							  $('.confrmation_overlay').css('display','block');
//							}else
//							{
//								$(".error_feed").css("display","block");
//								$(".error_feed").addClass("billgenration_validate");
//								$(".error_feed").text(compordermsg1);
//								$(".error_feed").delay(2000).fadeOut('slow');
//							}
//						   
//						   }
//						else 
//					   {
//						   if($('.clickeachrowcompld').hasClass('tr_bill_gen_active') )
//							{
//								var bilpt=$('#bilprintmsg').val();
//								   var selected_activities =$('.tr_bill_gen_active');
//								   var ordno = new Array(); 
//								   var tablename=new Array();
//								   selected_activities.each(function(){
//									var id_str       =  $(this).attr("ordno");
//										if(id_str!='undefined' && id_str!='' && id_str!=null){
//											ordno.push(id_str);
//										}
//										 var tablename_str       =  $(this).attr("tablename");
//										if(tablename_str!='undefined' && tablename_str!='' && tablename_str!=null){
//											tablename.push(tablename_str);
//										}
//							  
//								  });
//								  ordno=unique(ordno) 
//								  
//								  $.post("load_completedorder.php", {tabname:tablename,ord:ordno,set:'proceedbill'},
//										
//                                                                        function(data)
//										{
//										data=$.trim(data);
//										//alert(data);
//                                                                                window.location="completed_order.php";
//										if(data.indexOf("exception") == -1)
//										{
//										 $.post("print_details.php", {set:'billprint'},
//										function(data2)
//										{
//										data2=$.trim(data2);
//										window.location="completed_order.php";
//										
//										
//										var flr_id=	$('#co_areachnage').val();
//											// $('#load_listcompletedorders').html('<img src="img/ajax-loaders/ajax-loader-6.gif" />');
//											  $.post("load_completedorder.php", {floorid:flr_id,set:'loadbilldetails_co'},
//											  function(data1)
//											  {
//											  $('#load_listcompletedorders').html(data1);
//											  $('#listheadsection').load("load_completedorder.php?set=loadlisthead_co");	
//											  $('#listwholedetailslist').empty();
//												$('.loadproceedbutton').css("display","none");
//												$('#totalrate').text('');
//                                                                                                window.location="completed_order.php";
//											  });
//										
//										
//										 $(".error_feed").css("display","block");
//										 $(".error_feed").addClass("billgenration_validate");
//										 
//										 if(data=="Error..In Bill Generatation")
//								  {
//									  var hidbillgenerate_error=$('#hidbillgenerate_error').val();
//									   $(".error_feed").text(hidbillgenerate_error);
//								  }else if(data=="Orders pending to be served")
//								  {
//									  var hidbillgenerate_pend=$('#hidbillgenerate_pend').val();
//									   $(".error_feed").text(hidbillgenerate_pend);
//								  }else if(data=="Bill generated sucessfully")
//								  {
//									  var hidbillgenerate_bill=$('#hidbillgenerate_bill').val();
//									   $(".error_feed").text(hidbillgenerate_bill);
//								  }
//										 
//										 
//										// $(".error_feed").text(bilpt);
//										 $(".error_feed").delay(2000).fadeOut('slow');
//										});	
//										}else
//										{
//											alert(data);
//										}
//								   });
//							}else
//							{
//								$(".error_feed").css("display","block");
//								$(".error_feed").addClass("billgenration_validate");
//								$(".error_feed").text(compordermsg1);
//								$(".error_feed").delay(2000).fadeOut('slow');
//							}
//						
//						 /*  if($('.clickeachrowcompld').hasClass('tr_bill_gen_active') )
//							{
//								
//							  $('.disountenterpopup').css('display','block');
//							  $('.confrmation_overlay').css('display','block');
//							}else
//							{
//								$(".error_feed").css("display","block");
//								$(".error_feed").addClass("billgenration_validate");
//								$(".error_feed").text("Select tables to Proceed");
//								$(".error_feed").delay(2000).fadeOut('slow');
//							}*/
//					   }
//				   }else
//				   {
//					   if($('.clickeachrowcompld').hasClass('tr_bill_gen_active') )
//						  {
//						  $('.registerpopup').css('display','block');
//						  $('.confrmation_overlay').css('display','block');
//						}else
//						{
//							$(".error_feed").css("display","block");
//							$(".error_feed").addClass("billgenration_validate");
//							$(".error_feed").text(compordermsg1);
//							$(".error_feed").delay(2000).fadeOut('slow');
//						}
//				   }
//			}
//		 }else
//		{
//			$(".error_feed").css("display","block");
//			$(".error_feed").addClass("billgenration_validate");
//			$(".error_feed").text(compordermsg1);
//			$(".error_feed").delay(2000).fadeOut('slow');
//		}         
                
//                });
               
               
               
               

//               shortcut.add("Enter",function() { 
//               document.getElementByClassName("canceleachitems").click();
//		  if($('#hidcancelsecret').val()=="Y")
//		  {
//			$('.loadcanceldetails').css('display','block');
//			$('.confrimcancel').css('display','none');
//			$('.confrimenable').css('display','none');
//			$('.confrimeachcancel').css('display','none');
//			$('.confrmation_overlay').css('display','block');
//		        window.location="completed_order.php";
//		  }else
//		  {
//			$('.loadcanceldetails').css('display','none');
//			$('.confrimcancel').css('display','none');
//			$('.confrimenable').css('display','none');
//			$('.confrimeachcancel').css('display','none');
//			$('.confrmation_overlay').css('display','none');  
//                	$('.submitcancelation').click();
//                         window.location="completed_order.php";
//		  }
//		  
//		     
//	 }); 
               
               
               
               
               
                
     ///////////////////////////discont Print complete order start//////////////////
//             shortcut.add("Ctrl+D",function() {  
//             // document.getElementById("closedisount").click();
//       
//	   var discamtdrop=$("#disountamount_drop").val();
//	   var discamt=$("#disountamount").val();
//	  var loyalityid=$("#loyalityid").val();
//	  var staffwithdiscountmanual=$("#staffwithdiscountmanual").val();
//	  if(loyalityid=='')
//	  {
//		 loyalityid=0; 
//	  }
//	  if(staffwithdiscountmanual=="N" )
//	  {
//		  discamt=0;
//		 // disctype="V";
//	  }
//	   if(discamtdrop!="none")
//	   {//alert("notdisc");
//		  $('.disountenterpopup').css('display','none');
//		  $('.confrmation_overlay').css('display','none');
//		  $("#disountamount").css("border","1px solid #847D7D");
//		  $("#disountamount").val('0');
//		  $('#disountamount_drop').find('option:first').attr('selected', 'selected');
//		  var selected_activities =$('.tr_bill_gen_active');
//						 var ordno = new Array(); 
//						 var tabname= new Array();
//						 var pref= new Array();
//						 var tablename=new Array();
//						 selected_activities.each(function(){
//						  var id_str       =  $(this).attr("ordno");
//							  if(id_str!='undefined' && id_str!='' && id_str!=null){
//								  ordno.push(id_str);
//							  }
//						 var tabname_str       =  $(this).attr("tabname");
//							  if(tabname_str!='undefined' && tabname_str!='' && tabname_str!=null){
//								  tabname.push(id_str);
//							  }	  
//					 	var pref_str       =  $(this).attr("pref");
//							  if(pref_str!='undefined' && pref_str!='' && pref_str!=null){
//								  pref.push(pref_str);
//							  }
//							  var tablename_str       =  $(this).attr("tablename");
//							  if(tablename_str!='undefined' && tablename_str!='' && tablename_str!=null){
//								  tablename.push(tablename_str);
//							  }
//							  
//							  
//						});
//						ordno=unique(ordno) 
//						//alert(ordno)	
//						$.post("load_completedorder.php", {tabname:tablename,tableid:tabname,prefx:pref,discount:discamtdrop,loyalityid:loyalityid,type:"drop",ord:ordno,set:'proceedbill'},
//						  function(data)
//						  {
//						  data=$.trim(data);
//                                                   window.location="completed_order.php";
//						  $.post("print_details.php", {set:'billprint'},
//						  function(data1)
//						  {
//						  data1=$.trim(data1);//alert(data)
//                                                  window.location="completed_order.php";
//						  if(data.indexOf("exception") == -1)
//							{
//								
//								if($('#discstatus').val()=="Y")
//								{
//								
//							var hidbillclose_null=$('#hidbillclose_null').val();
//								var proc_billgenerate_split=$('#proc_billgenerate_split').val();	
//						   $.post("load_bill.php", {set:'closedirectfuncion'},
//							function(data2)
//							{
//								data2=$.trim(data2);
//								window.location="completed_order.php";
//								if(data2.indexOf("exception") == -1)
//										{
//											 var flr_id=	$('#co_areachnage').val();
//											// $('#load_listcompletedorders').html('<img src="img/ajax-loaders/ajax-loader-6.gif" />');
//											  $.post("load_completedorder.php", {floorid:flr_id,set:'loadbilldetails_co'},
//											  function(data)
//											  {
//											  $('#load_listcompletedorders').html(data);
//											  $('#listheadsection').load("load_completedorder.php?set=loadlisthead_co");	
//											  $('#listwholedetailslist').empty();
//												$('.loadproceedbutton').css("display","none");
//                                                                                                window.location="completed_order.php";
//											  });
//											//alert(data2);  
//										   $(".error_feed").css("display","block");
//										  $(".error_feed").addClass("billgenration_validate");
//										  if(data2=="Bill Number is Null")
//												{
//												$(".error_feed").text(hidbillclose_null);
//												}else if(data2=="Bill Closed without Payment")
//												{
//													$(".error_feed").text(proc_billgenerate_split);
//												}
//										  $(".error_feed").delay(2000).fadeOut('slow');
//										  $('#discstatus').val('');
//										}else
//										{
//											alert(data2)
//										}
//										
//								
//							
//							});	
//								}else
//								{
//									 var flr_id=	$('#co_areachnage').val();
//											// $('#load_listcompletedorders').html('<img src="img/ajax-loaders/ajax-loader-6.gif" />');
//											  $.post("load_completedorder.php", {floorid:flr_id,set:'loadbilldetails_co'},
//											  function(data)
//											  {
//											  $('#load_listcompletedorders').html(data);
//											  $('#listheadsection').load("load_completedorder.php?set=loadlisthead_co");	
//											  $('#listwholedetailslist').empty();
//												$('.loadproceedbutton').css("display","none");	
//                                                                                                 window.location="completed_order.php";
//											  });
//										//alert(data);	  
//										   $(".error_feed").css("display","block");
//										  $(".error_feed").addClass("billgenration_validate");
//										  $(".error_feed").text(data);
//										  $(".error_feed").delay(2000).fadeOut('slow');
//										  $('#discstatus').val('');
//								}
//						  }else {
//							alert(data);  
//						  }
//						 });	
//				 	 });
//			
//			
//	   }else  
//	   {// text box discount
//	  // alert("jj");
//	  //alert("disc");
//	  var disctype;
//	   if(staffwithdiscountmanual=="N" )
//	  {
//		 // discamt=0;
//		  disctype="V";
//	  }else
//	  {
//	      disctype=$("input[name='typesel']:checked").val();//alert(disctype)
//	  }//alert(disctype) ; alert(discamt)
//		 if((disctype=="P" && discamt<=100) || (disctype=="V"))
//		 {
//		   if(discamt>=0)
//		  {//alert("j");
//				$('.disountenterpopup').css('display','none');
//				$('.confrmation_overlay').css('display','none');
//				//("#disountamount").css("border","1px solid #847D7D");
//				//$("#disountamount").val('0');
//				//$('#disountamount_drop').find('option:first').attr('selected', 'selected');
//				 var selected_activities =$('.tr_bill_gen_active');
//						 var ordno = new Array(); 
//						 var tabname= new Array();
//						 var pref= new Array();
//						 var tablename=new Array();
//						 selected_activities.each(function(){
//						  var id_str       =  $(this).attr("ordno");
//							  if(id_str!='undefined' && id_str!='' && id_str!=null){
//								  ordno.push(id_str);
//							  }
//						 var tabname_str       =  $(this).attr("tabname");
//							  if(tabname_str!='undefined' && tabname_str!='' && tabname_str!=null){
//								  tabname.push(id_str);
//							  }	  
//					 	var pref_str       =  $(this).attr("pref");
//							  if(pref_str!='undefined' && pref_str!='' && pref_str!=null){
//								  pref.push(pref_str);
//							  }
//							  var tablename_str       =  $(this).attr("tablename");
//							  if(tablename_str!='undefined' && tablename_str!='' && tablename_str!=null){
//								  tablename.push(tablename_str);
//							  }
//							  
//							  
//						});
//						ordno=unique(ordno) 
//						//alert("tabname="+tablename +" tabname="+ tabname + " pref=" + pref +" discamt=" +discamt +" loyalityid="+loyalityid + " disctype="+disctype +" ordno="+ordno );
//						var hidbillclose_null=$('#hidbillclose_null').val();
//								var proc_billgenerate_split=$('#proc_billgenerate_split').val();
//						//alert(tabname+pref)	
//						$.post("load_completedorder.php", {tabname:tablename,tableid:tabname,prefx:pref,discount:discamt,loyalityid:loyalityid,type:"text",disctype:disctype,ord:ordno,set:'proceedbill'},
//						  function(data)
//						  {
//						  data=$.trim(data);
//                                                  window.location="completed_order.php";
//						  $.post("print_details.php", {set:'billprint'},
//						  function(data1)
//						  {
//						  data1=$.trim(data1);//alert(data);
//                                                  window.location="completed_order.php";
//						  if(data.indexOf("exception") == -1)
//							{
//								
//								if($('#discstatus').val()=="Y")
//								{		
//						   $.post("load_bill.php", {set:'closedirectfuncion'},
//							function(data2)
//							{
//								data2=$.trim(data2);
//								window.location="completed_order.php";
//								if(data2.indexOf("exception") == -1)
//										{
//											
//											 var flr_id=	$('#co_areachnage').val();
//											// $('#load_listcompletedorders').html('<img src="img/ajax-loaders/ajax-loader-6.gif" />');
//											  $.post("load_completedorder.php", {floorid:flr_id,set:'loadbilldetails_co'},
//											  function(data)
//											  {
//											  $('#load_listcompletedorders').html(data);
//											  $('#listheadsection').load("load_completedorder.php?set=loadlisthead_co");	
//											  $('#listwholedetailslist').empty();
//												$('.loadproceedbutton').css("display","none");	
//                                                                                                window.location="completed_order.php";
//											  });
//											
//											//alert(data2);
//											$('#discstatus').val('');
//											$(".error_feed").css("display","block");
//											$(".error_feed").addClass("billgenration_validate");
//											if(data2==hidbillclose_null)
//												{
//												$(".error_feed").text(hidbillclose_null);
//												}else if(data2==proc_billgenerate_split)
//												{
//													$(".error_feed").text(proc_billgenerate_split);
//												}
//											$(".error_feed").delay(2000).fadeOut('slow');
//										}else {
//											alert(data2)
//										}
//								
//							
//							});	
//							
//								}else
//								{
//									 var flr_id=	$('#co_areachnage').val();
//											// $('#load_listcompletedorders').html('<img src="img/ajax-loaders/ajax-loader-6.gif" />');
//											  $.post("load_completedorder.php", {floorid:flr_id,set:'loadbilldetails_co'},
//											  function(data)
//											  {
//											  $('#load_listcompletedorders').html(data);
//											  $('#listheadsection').load("load_completedorder.php?set=loadlisthead_co");	
//											  $('#listwholedetailslist').empty();
//												$('.loadproceedbutton').css("display","none");	
//                                                                                                window.location="completed_order.php";
//											  });
//											
//											$('#discstatus').val('');
//											//alert(data);
//											$(".error_feed").css("display","block");
//											$(".error_feed").addClass("billgenration_validate");
//											$(".error_feed").text(data);
//											$(".error_feed").delay(2000).fadeOut('slow');
//								}
//						  }else
//						  {alert(data);
//						  }
//							
//						 });	
//				 	 });
//				
//				
//				
//		  }else
//		  {//alert("h");
//			  $("#disountamount").css("border","1px solid #F00");
//		  }
//		 }else
//		 {
//			 $("#disountamount").css("border","1px solid #F00");
//		 }
//	   }
//		}); 
                
                
          
 
       ////////////////////////////////////////  discount Print End/////////////////////////////////       

$(document).keyup(function(event)
{
    
    //////print_esc_cs//
    
 if(event.keyCode == 27)////Escape)/////
{ 
    
     var cs_check= $('.total_itemcount2').text();
       var di_check= $('.total_itemcount').text();
       var ta_check = $('.total_itemcount1').text(); 
       
     var check_cs = $(location).attr('pathname').includes("counter_sales.php");
     var check_ta = $(location).attr('pathname').includes("take_away_.php");
   
     
     var grt_cs=$('#grandtotal').text();
     
  if($('.loyalty_main_popup').css('display') == 'block'){

         var pop_cs='yes';
     }else{
     var pop_cs='no';
       }
       
       
     if(check_cs==true && cs_check > 0 && pop_cs=='yes' ){
       $('#dis_auth_proceed_without_discount').click();
     } 
     
     if($('.loyalty_main_popup').css('display') == 'block'){

         var pop_ta='yes';
     }else{
     var pop_ta='no';
       }
       
        if($('.settle_popup_in_take_away').css('display') == 'block'){

         var pop_ta_settle='yes';
     }else{
     var pop_ta_settle='no';
       }
       
       
     var   home_mode=$('.mode').attr('mode');  
     var mobile=$('#ta_mobile').val();
     
     if(check_ta==true && ta_check > 0 && pop_ta=='no' && pop_ta_settle=='no' ){
     
    
    if((home_mode=='HD' && mobile!="") || home_mode=='TA' ){
     // $('.ta_submit_orders').click();
      
       $('.settle_direct_ta').click();
      
                }else{
                   // alert('Enter Number for Proceeding');
                    //$('.home_delevery_address_popup').show();
                   //  $('.confrmation_overlay').show();
                    // $('#ta_mobile').focus();
                    
                }
     }
     
     
     if(check_ta==true && ta_check > 0 && pop_ta=='yes' ){
      $('#dis_auth_proceed_without_discount_ta').click(); 
     
     }
     
     
     
}
    
    
    
    
    
///////////////menu order Page //////////////////////
if(event.altKey && event.keyCode == 13) ///////Alt+Enter(submit popup)///////
{
event.preventDefault();

$(".submit_all").click();
}
if(event.shiftKey && event.keyCode == 32)//////Shift+space(Preference focus)///////
{
$(".pref_dopdown").focus();
}

/////////popup rate////////
if(event.altKey && event.keyCode == 82)//////alt+R(Rate focus)///////
{
$(".rate_typ_textox").focus();
}
////////popup end//////







//
/////////////////////////takeorder start/////////////////////
if(event.altKey && event.keyCode == 88)//////alt+X(takeorder)///////
{
$("#takorder").click();
}
if(event.keyCode == 17 && event.keyCode == 13)//////Enter(Table Select)///////
{
   
$(".line_higt_table_summ:first()").click();
}
if (event.keyCode == 13){
    $('#take_order_staff_sel_popup_textbox_btn').click();
   
}
//if(event.keyCode == 39)//////rightarrow(Table Select)///////
//{
//  $(".line_higt_table_summ:eq(1)").click();
//}

//if(event.keyCode == 37)//////leftarrow(Table Select)///////
//{ 
//$(".line_higt_table_summ:eq(-1)").click();
//}

if(event.shiftKey && event.keyCode == 67)//////shift+C(Combine table)///////
{
$(".tablecamp").click();
}
if(event.shiftKey && event.keyCode == 88)//////shift+X(Remove Combine table)///////
{
$(".tablecamp1").click();
}


if (event.keyCode == 39) {        
$(".table_select").closest('li').nextAll(':has(.line_higt_table_summ):first').find('.line_higt_table_summ').click();
 }
 if (event.keyCode == 37) {      
 $(".table_select").closest('li').prevAll('li:has(a.line_higt_table_summ)').find('a').click();   
 }

// // Down key
//        if (e.keyCode == 40) {      
//            $(".table_select").closest('li.buttons').next().find('a.line_higt_table_summ').click();   
//        }
//        
//        // Up key
//        if (e.keyCode == 38) {      
//            $(".table_select").closest('li.buttons').prev().find('a.line_higt_table_summ').click();   
//        }

/////////////////////////takeorder end/////////////




///////////////Complete order Page start//////////////////////
//if(event.keyCode == 27)//////Escape(cancel discount completeorder)///////
//{
//$(".canceldisount").click();
//}
if(event.shiftKey && event.keyCode == 86)//////shift+v(verify completeorder)///////
{
$(".verifycompletedorder").click();
}
if(event.shiftKey && event.keyCode == 80)//////shift+p(verify print completeorder)///////
{
$(".proceedbillbutton").click();
}
if(event.altKey && event.keyCode == 38)//////Space(select first )///////
{
$( ".clickeachrowcompld:first" ).click();
}
if(event.shiftKey && event.keyCode == 67)//////shift+C(Combine table)///////
{
$(".camp").click();
}
if(event.shiftKey && event.keyCode == 88)//////shift+X(Remove Combine table)///////
{
$(".camp1").click();
}

 //Down key
 if(event.keyCode == 40) {
 $(".tr_bill_gen_active").closest('tr.clickeachrowcompld').next().find('td').click();   
  }
        
        // Up key
if (event.keyCode == 38) {      
 $(".tr_bill_gen_active").closest('tr.clickeachrowcompld').prev().find('td').click();   
}
if(event.shiftKey && event.keyCode == 70)//////shift+f(floor select completeorder)///////
{
$(".tax_textbox").focus();
}
if(event.altKey && event.keyCode == 78)//////alt+n(Verify No)///////
{
$(".closepopup_noeach").click();
}

if(event.altKey && event.keyCode == 89)//////alt+y(Verify Yes)///////
{
$(".canceleachitems").click();
}

//if(event.keyCode == 13)//////Enter(Verify Submit)///////
//{
//$(".submitcancelation").click();
//}

//if(event.keyCode == 27)//////Escape(Verify cancel)///////
//{
//$(".closepopup").click();
//}

///////////////Complete order Page end////////////////////////









///////////////payment Pending Page start//////////////////////
if(event.altKey && event.keyCode == 88)//////alt+x(settle payment)///////
{
$(".settlethetables").click();
}
if(event.altKey && event.keyCode == 90)//////alt+z(Regenerate payment)///////
{
$(".regenratethetables").click();
}
if(event.altKey && event.keyCode == 13)//////alt+Enter(popup submit regeratebill)///////
{
$(".submitregncancelation").click();
}
//if(event.keyCode == 27)//////Escape(popup cancel regeratebill)///////
//{
//$(".closeregnpopup").click();
//}
if(event.altKey && event.keyCode == 86)//////alt+v(Reprint paymentbill)///////
{
$(".repreintthetables").click();
}
if(event.altKey && event.keyCode == 78)//////alt+n(billsplit button)///////
{
$(".bilsplitthetables").click();
}

if(event.altKey && event.keyCode == 38)//////alt+up(Select First row payment pending)///////
{
$( ".clickeachrowpaymnt:first" ).click();
}
// Down key
 if(event.keyCode == 40) {
 $(".tr_bill_gen_active").closest('tr.clickeachrowpaymnt').next().find('td').click();   
 }
        
 // Up key
 if (event.keyCode == 38) {      
 $(".tr_bill_gen_active").closest('tr.clickeachrowpaymnt').prev().find('td').click();   
  }

}); 
 
//  shortcut.add("CTRL+1", function() {
//   $(".c1").click();   
//  });
 $(document).keyup(function(event)
{
//    if(event.keyCode == 48)//////alt+0(0)///////
//{
//$(".c0").click();
//}
if(event.keyCode == 96)//////numpad0(0)///////
{
$(".c0").click();
}
//if(event.keyCode == 49)//////alt+1(1)///////
//{
//$(".c1").click();
//}
if(event.keyCode == 97)//////numpad1(1)///////
{
$(".c1").click();
}
//if(event.keyCode == 50)//////alt+2(2)///////
//{
//$(".c2").click();
//}
if(event.keyCode == 98)//////numpad2(2)///////
{
$(".c2").click();
}
//if(event.keyCode == 51)//////alt+3(3)///////
//{
//$(".c3").click();
//}
if(event.keyCode == 99)//////numpad3(3)///////
{
$(".c3").click();
}
//if(event.keyCode == 52)//////alt+4(4)///////
//{
//$(".c4").click();
//}
if(event.keyCode == 100)//////numpad4(4)///////
{
$(".c4").click();
}
//if(event.keyCode == 53)//////alt+5(5)///////
//{
//$(".c5").click();
//}
if(event.keyCode == 101)//////numpad5(5)///////
{
$(".c5").click();
}
//if(event.keyCode == 54)//////alt+6(6)///////
//{
//$(".c6").click();
//}
if(event.keyCode == 102)//////numpad6(6)///////
{
$(".c6").click();
}
//if(event.keyCode == 55)//////alt+7(7)///////
//{
//$(".c7").click();
//}
if(event.keyCode == 103)//////numpad7(7)///////
{
$(".c7").click();
}
//if(event.keyCode == 56)//////alt+8(8)///////
//{
//$(".c8").click();
//}
if(event.keyCode == 104)//////numpad8(8)///////
{
$(".c8").click();
}
//if(event.keyCode == 57)//////alt+9(9)///////
//{
//$(".c9").click();
//}
if(event.keyCode == 105)//////numpad9(9)///////
{
$(".c9").click();
}
//if(event.keyCode == 110)//////decimal point(clear)///////
//{
//$(".clear").click();
//}
 shortcut.add("Ctrl+M",function() { 
     $(".pref_text_area").focus();
 });
    });   
 
//////////payment Pending Page end//////////////////////
});

   shortcut.add("Alt+P",function() {
       var check_cs = $(location).attr('pathname').includes("counter_sales.php");
     var check_ta = $(location).attr('pathname').includes("take_away_.php");
     
     if(check_cs==true ){
      window.location.href="counter_sales.php?setcscommon=settlecspopup";
      
      }else if(check_ta==true){
          
      window.location.href = "take_away_.php?settacommon=settletapopup";
      }else{
          window.location.href = "payment_pending.php";
      }
    
   });
    
 	
</script> 
    