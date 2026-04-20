// JavaScript Document

$(document).ready(function(){
	
	/*****************************************  Reset pend starts ******************************************************************  */
	  $('#resetall').click(function () {  
	  $('#searchbill').val("");  
	  $('#kot_scroll').load('load_bill.php?set=loadtables');
	 		 $('#kot_scroll_pend').load('load_bill.php?set=loadtables_pend');
	  });
	/***************************************  Reset pend ends ******************************************************************  */ 
	
	/***************************************  search bill starts ******************************************************************  */
	$('#searchbill').change(function () {    
    	var sr=($(this).val());
		$('#kot_scroll_pend').load('load_bill.php?set=loadtables_pendSearch&sr='+sr);
     });
	 
	$('#gotosearch').change(function () {    
    	var sr=($(this).val());
		$('#kot_scroll_pend').load('load_bill.php?set=loadtables_pendSearch&sr='+sr);
     });
	/***************************************  search bill ends ******************************************************************  */  

	/***************************************  Change type starts ******************************************************************  */
	 $('.completed_order_tab_btn').click(function () {
		  if ($(this).hasClass('completed_order_tab_active'))
			  {		
			  		$('.completed_order_tab_btn').removeClass('completed_order_tab_active') 
				 	$(this).removeClass('completed_order_tab_active') 
			  }else
			  {
				  	$('.completed_order_tab_btn').removeClass('completed_order_tab_active') 
				   $(this).addClass('completed_order_tab_active') 
				   var id_str       =  $('.completed_order_tab_active').attr("types");
		  			var id_arr	     =	id_str.split("_");
		  			var selval       =  id_arr[1];
					//alert()
					if(selval=="completdorder")
					{
						$('#verfiyenable').css("display","block");
						$('#kot_scroll').css("display","block");
						$('#kot_scroll_pend').css("display","none");
						$('.search_name_box_main').css("display","none");
						$('.procdtobillpend').css("display","none");
						$('.proceed_bill_btn').css("display","block");
					    $('.proceed_bill_btn_reprint').css("display","none");
						$('.proceed_bill_btn_wopayment').css("display","none");
						$('.proceed_bill_btn_regenerate').css("display","none");
						
						  $.post("load_bill.php", {set:'tableselectionauto_clear'},
						  function(data)
						  {
						  data=$.trim(data);
							
						  });
						 
						   $('#kot_scroll').load('load_bill.php?set=loadtables');
	  					   var srch=$('#searchbill').val();
						  if(srch!="")
						  {
						 		$('#kot_scroll_pend').load('load_bill.php?set=loadtables_pendSearch&sr='+srch);
						  }else
						  {
						  		$('#kot_scroll_pend').load('load_bill.php?set=loadtables_pend');
						  }
						$('#kot_scroll_pend .container_buttons p a').removeClass('a_demo_active');
						if($('#kot_scroll').find('a').hasClass('a_demo_three'))
						{
							$('.proceed_bill_btn').css("display","block");
							$('.proceed_bill_btn_reprint').css("display","none");
							$('#verfiyenable').css("display","block");
							
						}else
						{
							$('.proceed_bill_btn').css("display","none");
							$('.proceed_bill_btn_reprint').css("display","block");
							$('#verfiyenable').css("display","none");
						}
			  
					}else  if(selval=="paymentpend")
					{
						
						$('#kot_scroll').css("display","none");
						$('#verfiyenable').css("display","none");
						$('#kot_scroll_pend').css("display","block");
						$('.search_name_box_main').css("display","block");
						$('.proceed_bill_btn').css("display","none");
						$('.procdtobillpend').css("display","block");
						$('.proceed_bill_btn_reprint').css("display","block");
						$('.proceed_bill_btn_regenerate').css("display","block");
						if($('#wopay').val()=="Y")
						{
							$('.proceed_bill_btn_wopayment').css("display","block");
						}else
						{
							$('.proceed_bill_btn_wopayment').css("display","none");
						}
						
						$.post("load_bill.php", {set:'tableselectionauto_clear'});
						 $('#kot_scroll').load('load_bill.php?set=loadtables');
						 var srch=$('#searchbill').val();
						  if(srch!="")
						  {
						 		$('#kot_scroll_pend').load('load_bill.php?set=loadtables_pendSearch&sr='+srch);
						  }else
						  {
						 		 $('#kot_scroll_pend').load('load_bill.php?set=loadtables_pend');
						  }
						$('#kot_scroll .container_buttons p a').removeClass('a_demo_active');
						
						if($('#kot_scroll_pend').find('a').hasClass('a_demo_three'))
						{
							$('.procdtobillpend').css("display","block");
						}else
						{
							$('.procdtobillpend').css("display","none");
							
						}
							
					}
			  }
		  
 
			  });
	/***************************************  Change type ends ******************************************************************  */
	
	/***************************************  print page starts ******************************************************************  */
	 $('#proceedtobillfromfirst').click(function () {
		 var printwithdiscount=$('#printwithdiscount').val();
		 var printwithloyality=$('#printwithloyality').val();
		 $("#loyalityid").val('');
		 if(printwithloyality=='N')
		 {
			 if(printwithdiscount=='N')
			 {
			 // printwithloyality==N starts
			if ($('.container_buttons p a').hasClass('a_demo_active'))
			  {
					var selected_activities =$('.a_demo_active');
					var ids = new Array();
					var prefs = new Array();
					var ords=new Array();
					 var totnam=new Array();
					selected_activities.each(function(){
						var id_str       =  $(this).attr("name");
						var id_arr	     =	id_str.split("_");
						var selval       =  id_arr[1];
							if(selval!='undefined' && selval!='' && selval!=null){
								ids.push(selval);
							}
						var pref_str      =  $(this).attr("pref");
						var pref_arr	  =	 pref_str.split("_");
						var prefval       =  pref_arr[1];
							if(prefval!='undefined' && prefval!='' && prefval!=null){
								prefs.push(prefval);
							}
							var ord_str      =  $(this).attr("ordno");
						var ord_arr	  =	 ord_str.split("_");
						var ordval       =  ord_arr[1];
							if(ordval!='undefined' && ordval!='' && ordval!=null){
								ords.push(ordval);
							}
							var tot_str4   =  $(this).attr("total_name");
						   if(tot_str4!='undefined' && tot_str4!='' && tot_str4!=null){
								totnam.push(tot_str4);
							}
					});
					var id_str       =  $('.completed_order_tab_active').attr("types");
							var id_arr	     =	id_str.split("_");
							var selval       =  id_arr[1];
				  if(selval=="completdorder")
					{	
					$.post("load_bill.php", {tableid:ids,prefx:prefs,totname:totnam,ord:ords,set:'tableselectiontonextpage_first'},
						  function(data)
						  {
						  data=$.trim(data);
						  //alert(data);
						  if(data=='')
						  {
						   $.post("print_details.php", {set:'billprint'},
						  function(data)
						  {
						  data=$.trim(data);
						  //alert(data);
						   $(".loaderrorbill").css("display","block");
				   $(".loaderrorbill").addClass("billgenration_validate");
			 		$(".loaderrorbill").text("Bill Printed");
					$(".loaderrorbill").delay(2000).fadeOut('slow');
						  
						  
						  $('#kot_scroll').load('load_bill.php?set=loadtables');
						  });	
						  }else
						  {
							  alert(data);
						  }
							//window.location="bill_generation_screen1.php";
				 	 });
				  			
					}else  if(selval=="paymentpend")
					{
						 var id_str   =  $('.a_demo_active').attr("bilno");
					var id_arr	  =	 id_str.split("_");
					var bln       =  id_arr[1];
					
						 $.post("load_bill.php", {bilno:bln,set:'pendbillsessionset'},
						function(data)
						{
						data=$.trim(data);
						window.location="bill_generation_screen3.php";
						});
						
					}
				
				
			  }else
			  {
				  $(".loaderrorbill").css("display","block");
				   $(".loaderrorbill").addClass("billgenration_validate");
			 		$(".loaderrorbill").text("Select tables to Proceed");
					$(".loaderrorbill").delay(2000).fadeOut('slow');
			  }
			  
			   if($('.completed_order_tab_btn').hasClass('completed_order_tab_active') )
			   {
				   var id_str       =  $('.completed_order_tab_active').attr("types");
					var id_arr	     =	id_str.split("_");
					var selval       =  id_arr[1];
					if(selval=="completdorder")
					{
						if($('#kot_scroll').find('a').hasClass('a_demo_three'))
						{
							$('.proceed_bill_btn').css("display","block");
							$('.proceed_bill_btn_reprint').css("display","none");
							$('#verfiyenable').css("display","block");
						}else
						{
							$('.proceed_bill_btn').css("display","none");
							$('.proceed_bill_btn_reprint').css("display","block");
							$('#verfiyenable').css("display","none");
						}
					}else  if(selval=="paymentpend")
					{
						if($('#kot_scroll_pend').find('a').hasClass('a_demo_three'))
						{
							
							$('.procdtobillpend').css("display","block");
						}else
						{
							$('.procdtobillpend').css("display","none");
						}
					}
			   }
			   
			   // printwithloyality==N ends
			 }else
			 {
				 if ($('.container_buttons p a').hasClass('a_demo_active'))
				  {
					$('.disountenterpopup').css('display','block');
					$('.confrmation_overlay').css('display','block');
				  }else
				  {
					  $(".loaderrorbill").css("display","block");
					  $(".loaderrorbill").addClass("billgenration_validate");
					  $(".loaderrorbill").text("Select tables to Proceed");
					  $(".loaderrorbill").delay(2000).fadeOut('slow');
				  }
			 }
		 }else
		 {
			 if ($('.container_buttons p a').hasClass('a_demo_active'))
			  {
				$('.registerpopup').css('display','block');
				$('.confrmation_overlay').css('display','block');
			  }else
			  {
				  $(".loaderrorbill").css("display","block");
				  $(".loaderrorbill").addClass("billgenration_validate");
			 	  $(".loaderrorbill").text("Select tables to Proceed");
				  $(".loaderrorbill").delay(2000).fadeOut('slow');
			  }
		 }
			  
	});
	/***************************************  proceed to 3rd page ends ******************************************************************  */
	
	/***************************************  verify to 2nd page starts ******************************************************************  */
	 $('#clickverifyto2nd').click(function () {
			if ($('.container_buttons p a').hasClass('a_demo_active'))
			  {
					var selected_activities =$('.a_demo_active');
					var ids = new Array();
					var prefs = new Array();
					var ords = new Array();
					selected_activities.each(function(){
						var id_str       =  $(this).attr("name");
						var id_arr	     =	id_str.split("_");
						var selval       =  id_arr[1];
							if(selval!='undefined' && selval!='' && selval!=null){
								ids.push(selval);
							}
						var pref_str      =  $(this).attr("pref");
						var pref_arr	  =	 pref_str.split("_");
						var prefval       =  pref_arr[1];
							if(prefval!='undefined' && prefval!='' && prefval!=null){
								prefs.push(prefval);
							}
					});
				$.post("load_bill.php", {tableid:ids,prefx:prefs,set:'tableselectiontonextpage'},
				  function(data)
				  {
				  data=$.trim(data);
				  	window.location="bill_generation_screen2.php";
				  });
				
			  }else
			  {
					 $(".loaderrorbill").addClass("billgenration_validate");
			 		$(".loaderrorbill").text("Select tables to Proceed");
					$(".loaderrorbill").delay(2000).fadeOut('slow');
			  }
  			});
	/***************************************  verify to 2nd page ends ******************************************************************  */
 
	
	/***************************************  floor selection starts ******************************************************************  */
	/*$('.sidebar-group-menu li:first').find("a").addClass('active'); 
		 $('.sidebar-group-menu li').click(function () {
			 $('body').click();
			  $('.right_over_scroll').empty();
			  $(".sidebar-group-menu>li>a.active").removeClass("active");
			   $(this).find("a").addClass('active'); 
			  var id_str   =  $(this).attr("id");
			  var id_arr	  =	 id_str.split("_");
			  var flr_id       = id_arr[1];
			  var selval       = "- " + id_arr[1];
			  var tit_str   =  $(this).find("a").attr("title");
			  $('#flrno').html(tit_str);	
			  $('#load_tables').html('<img src="img/ajax-loaders/ajax-loader-6.gif" />');
			
			  $.post("load_bill.php", {floorid:flr_id,set:'loadtables'},
				  function(data)
				  {
				  data=$.trim(data);
									  
				  $('#kot_scroll').html(data);
										
				  });
	 });*/
	// $('.sidebar-group-menu li:first').find("a").addClass('active'); 
		 $('.bill_floor_select_btn').click(function () {
			  $('.right_over_scroll').empty();
			  $(".bill_floor_select_btn").removeClass("bill_floor_select_btn_act");
			   $(this).addClass('bill_floor_select_btn_act'); 
			  var id_str   =  $(this).attr("id");
			  var id_arr	  =	 id_str.split("_");
			  var flr_id       = id_arr[1];
			  var selval       = "- " + id_arr[1];
			  var tit_str   =  $(this).attr("title");
			  $('#flrno').html(tit_str);	
			  $('#load_tables').html('<img src="img/ajax-loaders/ajax-loader-6.gif" />');
			
			  $.post("load_bill.php", {floorid:flr_id,set:'loadtables'},
				  function(data)
				  {
				  data=$.trim(data);
									  
				  //$('#kot_scroll').html(data);
				  $('#kot_scroll').load('load_bill.php?set=loadtables');
				  $('#kot_scroll_pend').load('load_bill.php?set=loadtables_pend');
										
				  });
	 });
	/***************************************  floor selection ends ******************************************************************  */
	/***************************************  autorefresh starts ******************************************************************  */
	 setInterval(function() { 
            
	 var selected_activities =$('.a_demo_active');
			var ids = new Array();
		   var prefs = new Array();
		selected_activities.each(function(){
			  var id_str   =  $(this).attr("name");
			  var id_arr	  =	 id_str.split("_");
			  var selval       =  id_arr[1];
			if(selval!='undefined' && selval!='' && selval!=null){
				ids.push(selval);
			}
			var pref_str   =  $(this).attr("pref");
			  var pref_arr	  =	 pref_str.split("_");
			  var prefval       =  pref_arr[1];
			if(prefval!='undefined' && prefval!='' && prefval!=null){
				prefs.push(prefval);
			}
			});
			$.post("load_bill.php", {tableid:ids,prefx:prefs,set:'tableselectionauto'},
			function(data)
			{
			data=$.trim(data);
			  
			});
	  $('#kot_scroll').load('load_bill.php?set=loadtables');
	 
	   if($('.completed_order_tab_btn').hasClass('completed_order_tab_active') )
	   {
		   var id_str       =  $('.completed_order_tab_active').attr("types");
			var id_arr	     =	id_str.split("_");
			var selval       =  id_arr[1];
			if(selval=="completdorder")
			{
				if($('#kot_scroll').find('a').hasClass('a_demo_three'))
				{
					$('.proceed_bill_btn').css("display","block");
					$('.proceed_bill_btn_reprint').css("display","none");
					$('#verfiyenable').css("display","block");
				}else
				{
					$('.proceed_bill_btn').css("display","none");
					$('.proceed_bill_btn_reprint').css("display","block");
					$('#verfiyenable').css("display","none");
				}
			}else  if(selval=="paymentpend")
			{
				if($('#kot_scroll_pend').find('a').hasClass('a_demo_three'))
				{
					$('.procdtobillpend').css("display","block");
				}else
				{
					$('.procdtobillpend').css("display","none");
				}
			}
	   }
	    var srch=$('#searchbill').val();
	  if(srch!="")
	  {
	 $('#kot_scroll_pend').load('load_bill.php?set=loadtables_pendSearch&sr='+srch);
	  }else
	  {
  
	  $('#kot_scroll_pend').load('load_bill.php?set=loadtables_pend');
	  }
	   
	   
	   
	   }, 6000); 
	/***************************************  autorefresh ends ******************************************************************  */
	/***************************************  dropdown starts ******************************************************************  */
	$('#menu').fancySelect().on('change', function() {
		  newSection = $('#' + $(this).val())

		  if (newSection.hasClass('current')) {
			  return;
		  }

		  $('section').removeClass('current');
		  newSection.addClass('current');

		  $('section:not(.current)').fadeOut(300, function() {
			  newSection.fadeIn(300);
		  });
	});
				
	/***************************************  dropdown ends ******************************************************************  */
	
	/***************************************  proceed to 3rd page starts ******************************************************************  */
	 $('.procdtobillpend').click(function () {
			if ($('.container_buttons p a').hasClass('a_demo_active'))
			  {
					var selected_activities =$('.a_demo_active');
					var ids = new Array();
					var prefs = new Array();
					var ords=new Array();
					 var totnam=new Array();
					selected_activities.each(function(){
						var id_str       =  $(this).attr("name");
						var id_arr	     =	id_str.split("_");
						var selval       =  id_arr[1];
							if(selval!='undefined' && selval!='' && selval!=null){
								ids.push(selval);
							}
						var pref_str      =  $(this).attr("pref");
						var pref_arr	  =	 pref_str.split("_");
						var prefval       =  pref_arr[1];
							if(prefval!='undefined' && prefval!='' && prefval!=null){
								prefs.push(prefval);
							}
							var ord_str      =  $(this).attr("ordno");
						var ord_arr	  =	 ord_str.split("_");
						var ordval       =  ord_arr[1];
							if(ordval!='undefined' && ordval!='' && ordval!=null){
								ords.push(ordval);
							}
							var tot_str4   =  $(this).attr("total_name");
						   if(tot_str4!='undefined' && tot_str4!='' && tot_str4!=null){
								totnam.push(tot_str4);
							}
					});
					var id_str       =  $('.completed_order_tab_active').attr("types");
							var id_arr	     =	id_str.split("_");
							var selval       =  id_arr[1];
				  if(selval=="completdorder")
					{	
					$.post("load_bill.php", {tableid:ids,prefx:prefs,totname:totnam,ord:ords,set:'tableselectiontonextpage_first'},
						  function(data)
						  {
						  data=$.trim(data);
						  	
							//window.location="bill_generation_screen1.php";
				 	 });
				  			
					}else  if(selval=="paymentpend")
					{
						 var id_str   =  $('.a_demo_active').attr("bilno");
					var id_arr	  =	 id_str.split("_");
					var bln       =  id_arr[1];
					
						 $.post("load_bill.php", {bilno:bln,set:'pendbillsessionset'},
						function(data)
						{
						data=$.trim(data);
						window.location="bill_generation_screen3.php";
						});
						
					}
				
				
			  }else
			  {
				  $(".loaderrorbill").css("display","block");
				   $(".loaderrorbill").addClass("billgenration_validate");
			 		$(".loaderrorbill").text("Select tables to Proceed");
					$(".loaderrorbill").delay(2000).fadeOut('slow');
			  }
			  });
	/***************************************  proceed to 3rd page ends ******************************************************************  */
	
	/***************************************  reprint page starts ******************************************************************  */
	 $('.proceed_bill_btn_reprint').click(function () {
		 if ($('.container_buttons p a').hasClass('a_demo_active'))
			  {
		  var id_str   =  $('.a_demo_active').attr("bilno");
		  var id_arr	  =	 id_str.split("_");
		  var bln       =  id_arr[1];
		  //alert(bln)
		  $.post("print_details.php", {bilno:bln,set:'billprint'},
						function(data)
						{
						data=$.trim(data);
						//alert(data);
						$(".loaderrorbill").css("display","block");
						$(".loaderrorbill").addClass("billgenration_validate");
			 		$(".loaderrorbill").text("Bill Re-printed");
					$(".loaderrorbill").delay(2000).fadeOut('slow');
						
						});	
			  /* $.post("load_bill.php", {bilno:bln,set:'pendbillsessionset'},
			  function(data)
			  {
			  data=$.trim(data);
			  window.location="bill_generation_screen3.php";
			  });*/
			   }else
			  {
				  $(".loaderrorbill").css("display","block");
				   $(".loaderrorbill").addClass("billgenration_validate");
			 		$(".loaderrorbill").text("Select tables to Proceed");
					$(".loaderrorbill").delay(2000).fadeOut('slow');
			  }
		 
		 });
	/***************************************  reprint page ends ******************************************************************  */
	
	/***************************************  Close Direct starts ******************************************************************  */
	 $('.proceed_bill_btn_close').click(function () {
		if ($('.container_buttons p a').hasClass('a_demo_active'))
			  {
					var selected_activities =$('.a_demo_active');
					var ids = new Array();
					var prefs = new Array();
					var ords=new Array();
					 var totnam=new Array();
					selected_activities.each(function(){
						var id_str       =  $(this).attr("name");
						var id_arr	     =	id_str.split("_");
						var selval       =  id_arr[1];
							if(selval!='undefined' && selval!='' && selval!=null){
								ids.push(selval);
							}
						var pref_str      =  $(this).attr("pref");
						var pref_arr	  =	 pref_str.split("_");
						var prefval       =  pref_arr[1];
							if(prefval!='undefined' && prefval!='' && prefval!=null){
								prefs.push(prefval);
							}
							var ord_str      =  $(this).attr("ordno");
						var ord_arr	  =	 ord_str.split("_");
						var ordval       =  ord_arr[1];
							if(ordval!='undefined' && ordval!='' && ordval!=null){
								ords.push(ordval);
							}
							var tot_str4   =  $(this).attr("total_name");
						   if(tot_str4!='undefined' && tot_str4!='' && tot_str4!=null){
								totnam.push(tot_str4);
							}
					});
					var id_str       =  $('.completed_order_tab_active').attr("types");
							var id_arr	     =	id_str.split("_");
							var selval       =  id_arr[1];
				  if(selval=="completdorder")
					{	
					$.post("load_bill.php", {tableid:ids,prefx:prefs,totname:totnam,ord:ords,set:'tableselectiontonextpage_first'},
						  function(data)
						  {
						  data=$.trim(data);
						 //alert(data)
						  if(data.indexOf("exception") == -1)
										{
						  //if(data!='sorry')
						  //{
							  var hidbillclose_null=$('#hidbillclose_null').val();
								var proc_billgenerate_split=$('#proc_billgenerate_split').val();
							  $.post("print_details.php", {set:'billprint'},
							  function(data1)
							  {
							  data1=$.trim(data1);
						  
									 $.post("load_bill.php", {set:'closedirectfuncion'},
									  function(data2)
									  {
									  data2=$.trim(data2);
						 				//alert(data2)
						 				if(data2.indexOf("exception") == -1)
										{
										   $(".loaderrorbill").css("display","block");
										   $(".loaderrorbill").addClass("billgenration_validate");
											if(data2==hidbillclose_null)
												{
												$(".loaderrorbill").text(hidbillclose_null);
												}else if(data2==proc_billgenerate_split)
												{
													$(".loaderrorbill").text(proc_billgenerate_split);
												}
											$(".loaderrorbill").delay(2000).fadeOut('slow');
										}else
										{
											alert(data2)
										}
									  
									  });	
									  
									  });	
						//}
						  	
							//window.location="bill_generation_screen1.php";
							
						  }else
						  {
							   alert(data)
						  }
				 	 });
				  			
					}
				
				
			  }else
			  {
				  $(".loaderrorbill").css("display","block");
				   $(".loaderrorbill").addClass("billgenration_validate");
			 		$(".loaderrorbill").text("Select tables to Proceed");
					$(".loaderrorbill").delay(2000).fadeOut('slow');
			  }
			  
			  
			  
			   var selected_activities =$('.a_demo_active');
			var ids = new Array();
		   var prefs = new Array();
		selected_activities.each(function(){
			  var id_str   =  $(this).attr("name");
			  var id_arr	  =	 id_str.split("_");
			  var selval       =  id_arr[1];
			if(selval!='undefined' && selval!='' && selval!=null){
				ids.push(selval);
			}
			var pref_str   =  $(this).attr("pref");
			  var pref_arr	  =	 pref_str.split("_");
			  var prefval       =  pref_arr[1];
			if(prefval!='undefined' && prefval!='' && prefval!=null){
				prefs.push(prefval);
			}
			});
			$.post("load_bill.php", {tableid:ids,prefx:prefs,set:'tableselectionauto'},
			function(data)
			{
			data=$.trim(data);
			  
			});
	  $('#kot_scroll').load('load_bill.php?set=loadtables');
	 
	   if($('.completed_order_tab_btn').hasClass('completed_order_tab_active') )
	   {
		   var id_str       =  $('.completed_order_tab_active').attr("types");
			var id_arr	     =	id_str.split("_");
			var selval       =  id_arr[1];
			if(selval=="completdorder")
			{
				if($('#kot_scroll').find('a').hasClass('a_demo_three'))
				{
					$('.proceed_bill_btn').css("display","block");
					$('.proceed_bill_btn_reprint').css("display","none");
					$('#verfiyenable').css("display","block");
				}else
				{
					$('.proceed_bill_btn').css("display","none");
					$('.proceed_bill_btn_reprint').css("display","block");
					$('#verfiyenable').css("display","none");
				}
			}else  if(selval=="paymentpend")
			{
				if($('#kot_scroll_pend').find('a').hasClass('a_demo_three'))
				{
					$('.procdtobillpend').css("display","block");
				}else
				{
					$('.procdtobillpend').css("display","none");
				}
			}
	   }
	    var srch=$('#searchbill').val();
	  if(srch!="")
	  {
	 $('#kot_scroll_pend').load('load_bill.php?set=loadtables_pendSearch&sr='+srch);
	  }else
	  {
  
	  $('#kot_scroll_pend').load('load_bill.php?set=loadtables_pend');
	  }
	   
			  
			  
		 
		 });
	/***************************************  Close Direct ends ******************************************************************  */
	
	/*************************************** disount click starts *********************************************************  */  
	  $('#closediscount').click(function () {
		  if ($('.container_buttons p a').hasClass('a_demo_active'))
			  {
				$('.disountenterpopup').css('display','block');
				$('.confrmation_overlay').css('display','block');
			  }else
			  {
				  $(".loaderrorbill").css("display","block");
				  $(".loaderrorbill").addClass("billgenration_validate");
			 	  $(".loaderrorbill").text("Select tables to Proceed");
				  $(".loaderrorbill").delay(2000).fadeOut('slow');
			  }
		}); 
	  
	  /*************************************** disount click ends ***********************************************************  */
	  
	   /*************************************** disount cancel click starts ******************************************************  */  
	  $('.canceldisount').click(function () {
		$('.disountenterpopup').css('display','none');
		$('.loyalitypopup').css('display','none');
		$('.registerpopup').css('display','none');
		$('.confrmation_overlay').css('display','none');
		}); 
	  
	  /*************************************** disount cancel click ends *********************************************************  */
	  
	   /*************************************** loyality cancel click starts ******************************************************  */  
	  $('.loyalitycancel').click(function () {
		$('.disountenterpopup').css('display','none');
		$('.loyalitypopup').css('display','none');
		$('.registerpopup').css('display','none');
		$('.confrmation_overlay').css('display','none');
		}); 
	  
	  /*************************************** loyality cancel click ends *********************************************************  */
	  
	  
	  /*************************************** disount click starts *********************************************************  */  
	  $('.loyalityok').click(function () {
		  if ($('.container_buttons p a').hasClass('a_demo_active'))
			  {
			  		$('#loyalityid').val('');
				  var phone=$('#loyalitymob').val();
				  var name=$('#loyalityname').val();
				  
				  if(phone!='')
				  {
					   $.post("load_bill.php", {phone:phone,set:'checkloyalitydetailsbill'},
							function(data2)
							{
								data2=$.trim(data2);
								if(data2=="sorry")
								{
								  $(".error_loyal").css("display","block");
								  //$(".error_loyal").addClass("billgenration_validate");
								  $(".error_loyal").text(data2);
								  $(".error_loyal").delay(2000).fadeOut('slow');
								}else 
								{
									$('#loyalityid').val(data2);
									$('.disountenterpopup').css('display','block');
									$('.loyalitypopup').css('display','none');
									$('.registerpopup').css('display','none');
									$('.confrmation_overlay').css('display','block');
								}
									
							
							});	
				  }else if(name!='')
				  {
					  $.post("load_bill.php", {name:name,set:'checkloyalitydetailsbill'},
							function(data2)
							{
								data2=$.trim(data2);
								if(data2=="sorry")
								{
								  $(".error_loyal").css("display","block");
								  //$(".error_loyal").addClass("billgenration_validate");
								  $(".error_loyal").text(data2);
								  $(".error_loyal").delay(2000).fadeOut('slow');
								}else 
								{
									$('#loyalityid').val(data2);
									$('.disountenterpopup').css('display','block');
									$('.loyalitypopup').css('display','none');
									$('.registerpopup').css('display','none');
									$('.confrmation_overlay').css('display','block');
								}
									
							
							});	
				  }
				  
			   
			  }else
			  {
				  $(".loaderrorbill").css("display","block");
				  $(".loaderrorbill").addClass("billgenration_validate");
			 	  $(".loaderrorbill").text("Select tables to Proceed");
				  $(".loaderrorbill").delay(2000).fadeOut('slow');
			  }
		}); 
	  
	  /*************************************** disount click ends ***********************************************************  */
	  
	  
	  /*************************************** disount click starts *********************************************************  */  
	  $('.registeredok').click(function () {
		  if ($('.container_buttons p a').hasClass('a_demo_active'))
			  {
				  $('#loyalitymob').val('');
				  $('#loyalityname').val('');
				$('.loyalitypopup').css('display','block');
				$('.registerpopup').css('display','none');
				$('.confrmation_overlay').css('display','block');
			  }else
			  {
				  $(".loaderrorbill").css("display","block");
				  $(".loaderrorbill").addClass("billgenration_validate");
			 	  $(".loaderrorbill").text("Select tables to Proceed");
				  $(".loaderrorbill").delay(2000).fadeOut('slow');
			  }
		}); 
	  
	  /*************************************** disount click ends ***********************************************************  */
	  
	   /*************************************** registered no starts *********************************************************  */  
	  $('.registeredcancel').click(function () {
		  if ($('.container_buttons p a').hasClass('a_demo_active'))
			  {
				  $('.disountenterpopup').css('display','block');
				$('.loyalitypopup').css('display','none');
				$('.registerpopup').css('display','none');
				$('.confrmation_overlay').css('display','block');
			  }else
			  {
				  $(".loaderrorbill").css("display","block");
				  $(".loaderrorbill").addClass("billgenration_validate");
			 	  $(".loaderrorbill").text("Select tables to Proceed");
				  $(".loaderrorbill").delay(2000).fadeOut('slow');
			  }
		}); 
	  
	  /*************************************** disount click ends ***********************************************************  */
	  
	  /*************************************** disount close click starts ******************************************************  */  
	  $('.closedisount').click(function () {
	   var discamtdrop=$("#disountamount_drop").val();
	   var discamt=$("#disountamount").val();
	  var loyalityid=$("#loyalityid").val();
	  if(loyalityid=='')
	  {
		 loyalityid=0; 
	  }
	   if(discamtdrop!="none")
	   {
		   $('.disountenterpopup').css('display','none');
		  $('.confrmation_overlay').css('display','none');
		  $("#disountamount").css("border","1px solid #847D7D");
		  $("#disountamount").val('0');
		  $('#disountamount_drop').find('option:first').attr('selected', 'selected');
		   var selected_activities =$('.a_demo_active');
			var ids = new Array();
			var prefs = new Array();
			var ords=new Array();
			 var totnam=new Array();
			selected_activities.each(function(){
				var id_str       =  $(this).attr("name");
				var id_arr	     =	id_str.split("_");
				var selval       =  id_arr[1];
					if(selval!='undefined' && selval!='' && selval!=null){
						ids.push(selval);
					}
				var pref_str      =  $(this).attr("pref");
				var pref_arr	  =	 pref_str.split("_");
				var prefval       =  pref_arr[1];
					if(prefval!='undefined' && prefval!='' && prefval!=null){
						prefs.push(prefval);
					}
				var ord_str      =  $(this).attr("ordno");
				var ord_arr	  =	 ord_str.split("_");
				var ordval       =  ord_arr[1];
					if(ordval!='undefined' && ordval!='' && ordval!=null){
						ords.push(ordval);
					}
					var tot_str4   =  $(this).attr("total_name");
						   if(tot_str4!='undefined' && tot_str4!='' && tot_str4!=null){
								totnam.push(tot_str4);
							}
			});
			var hidbillclose_null=$('#hidbillclose_null').val();
								var proc_billgenerate_split=$('#proc_billgenerate_split').val();
			$.post("load_bill.php", {tableid:ids,prefx:prefs,ord:ords,totname:totnam,discount:discamtdrop,loyalityid:loyalityid,type:"drop",set:'tableselectiontonextpage_first'},
						  function(data)
						  {
						  data=$.trim(data);
						  $.post("print_details.php", {set:'billprint'},
						  function(data1)
						  {
						  data1=$.trim(data1);
						  if(data.indexOf("exception") == -1)
							{
						   $.post("load_bill.php", {set:'closedirectfuncion'},
							function(data2)
							{
								data2=$.trim(data2);
								
								if(data2.indexOf("exception") == -1)
										{
										   $(".loaderrorbill").css("display","block");
										  $(".loaderrorbill").addClass("billgenration_validate");
										  if(data2==hidbillclose_null)
												{
												$(".loaderrorbill").text(hidbillclose_null);
												}else if(data2==proc_billgenerate_split)
												{
													$(".loaderrorbill").text(proc_billgenerate_split);
												}
										  $(".loaderrorbill").delay(2000).fadeOut('slow');
										}else
										{
											alert(data2)
										}
										
								
							
							});	
						  }else {
							alert(data);  
						  }
						 });	
				 	 });
			
			
	   }else
	   {// text box discount
	     var disctype=$("input[name='typesel']:checked").val();//$(".typesel").val();
		 if((disctype=="P" && discamt<=100) || (disctype=="V"))
		 {
		   if(discamt!="")
		  {
				$('.disountenterpopup').css('display','none');
				$('.confrmation_overlay').css('display','none');
				$("#disountamount").css("border","1px solid #847D7D");
				$("#disountamount").val('0');
				$('#disountamount_drop').find('option:first').attr('selected', 'selected');
				 var selected_activities =$('.a_demo_active');
				  var ids = new Array();
				  var prefs = new Array();
				  var ords=new Array();
				   var totnam=new Array();
				  selected_activities.each(function(){
					  var id_str       =  $(this).attr("name");
					  var id_arr	     =	id_str.split("_");
					  var selval       =  id_arr[1];
						  if(selval!='undefined' && selval!='' && selval!=null){
							  ids.push(selval);
						  }
					  var pref_str      =  $(this).attr("pref");
					  var pref_arr	  =	 pref_str.split("_");
					  var prefval       =  pref_arr[1];
						  if(prefval!='undefined' && prefval!='' && prefval!=null){
							  prefs.push(prefval);
						  }
					  var ord_str      =  $(this).attr("ordno");
					  var ord_arr	  =	 ord_str.split("_");
					  var ordval       =  ord_arr[1];
						  if(ordval!='undefined' && ordval!='' && ordval!=null){
							  ords.push(ordval);
						  }
						  var tot_str4   =  $(this).attr("total_name");
						   if(tot_str4!='undefined' && tot_str4!='' && tot_str4!=null){
								totnam.push(tot_str4);
							}
				  });
				var hidbillclose_null=$('#hidbillclose_null').val();
								var proc_billgenerate_split=$('#proc_billgenerate_split').val();
					$.post("load_bill.php", {tableid:ids,prefx:prefs,totname:totnam,ord:ords,discount:discamt,loyalityid:loyalityid,type:"text",disctype:disctype,set:'tableselectiontonextpage_first'},
						  function(data)
						  {
						  data=$.trim(data);
						  $.post("print_details.php", {set:'billprint'},
						  function(data1)
						  {
						  data1=$.trim(data1);
						  if(data.indexOf("exception") == -1)
							{			
						   $.post("load_bill.php", {set:'closedirectfuncion'},
							function(data2)
							{
								data2=$.trim(data2);
								
								if(data2.indexOf("exception") == -1)
										{
											$(".loaderrorbill").css("display","block");
											$(".loaderrorbill").addClass("billgenration_validate");
											if(data2==hidbillclose_null)
												{
												$(".loaderrorbill").text(hidbillclose_null);
												}else if(data2==proc_billgenerate_split)
												{
													$(".loaderrorbill").text(proc_billgenerate_split);
												}
											$(".loaderrorbill").delay(2000).fadeOut('slow');
										}else {
											alert(data2)
										}
								
							
							});	
						  }else
						  {alert(data);
						  }
							
						 });	
				 	 });
				
				
				
		  }else
		  {
			  $("#disountamount").css("border","1px solid #F00");
		  }
		 }else
		 {
			 $("#disountamount").css("border","1px solid #F00");
		 }
	   }
		}); 
	  
	  /*************************************** disount close click ends *********************************************************  */
	  
	  /*************************************** W/O payment Close Direct starts *************************************************  */
	 $('.proceed_bill_btn_wopayment').click(function () {
		 if ($('.container_buttons p a').hasClass('a_demo_active'))
			  {
		  var id_str   =  $('.a_demo_active').attr("bilno");
		  var id_arr	  =	 id_str.split("_");
		  var bln       =  id_arr[1];
		 //alert(bln)
		 var hidbillclose_null=$('#hidbillclose_null').val();
								var proc_billgenerate_split=$('#proc_billgenerate_split').val();
		  $.post("load_bill.php", {bilno:bln,setmode:'WP',set:'closedirectfuncion'},
							function(data2)
							{
								data2=$.trim(data2);
								
								if(data2.indexOf("exception") == -1)
										{
											$(".loaderrorbill").css("display","block");
											$(".loaderrorbill").addClass("billgenration_validate");
											$(".loaderrorbill").text(data2);
											$(".loaderrorbill").delay(2000).fadeOut('slow');
										}else {
											alert(data2)
										}
								
							
							});	
			  
			   }else
			  {
				  $(".loaderrorbill").css("display","block");
				   $(".loaderrorbill").addClass("billgenration_validate");
			 		$(".loaderrorbill").text("Select tables to Proceed");
					$(".loaderrorbill").delay(2000).fadeOut('slow');
			  }});
	/*************************************** W/O payment Close Direct ends ********************************************************  */
	
	/*************************************** W/O payment Close Direct starts *************************************************  */
	 $('.proceed_bill_btn_regenerate').click(function () {
		 if ($('.container_buttons p a').hasClass('a_demo_active'))
			  {
		  var id_str   =  $('.a_demo_active').attr("bilno");
		  var id_arr	  =	 id_str.split("_");
		  var bln       =  id_arr[1];
		// alert(bln)
		  $.post("load_bill.php", {bilno:bln,set:'billregenerate'},
							function(data2)
							{
								data2=$.trim(data2);
								//alert(data2)
								if(data2.indexOf("exception") == -1)
										{
											$(".loaderrorbill").css("display","block");
											$(".loaderrorbill").addClass("billgenration_validate");
											$(".loaderrorbill").text(data2);
											$(".loaderrorbill").delay(2000).fadeOut('slow');
										}else {
											alert(data2)
										}
								
							
							});	
			  
			   }else
			  {
				  $(".loaderrorbill").css("display","block");
				   $(".loaderrorbill").addClass("billgenration_validate");
			 		$(".loaderrorbill").text("Select tables to Proceed");
					$(".loaderrorbill").delay(2000).fadeOut('slow');
			  }});
	/*************************************** W/O payment Close Direct ends ********************************************************  */
	
}); 