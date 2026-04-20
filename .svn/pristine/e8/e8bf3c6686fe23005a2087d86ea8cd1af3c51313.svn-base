// JavaScript Document

$(document).ready(function(){
	
	/*****************************************  close click starts ******************************************************************  */
	$('.tabs').chrometab();
	$('.close').click(function(){//tab-pane active
		var ids=new Array();
		  var selected_activities =$('#table_menu .active');
		  selected_activities.each(function(){
		var id_str   =  $(this).attr("ord");
		var id_arr	  =	 id_str.split("_");
		var selval       =  id_arr[1];
		 if(selval!='undefined' && selval!='' && selval!=null){
			  ids.push(selval);
		  }
		  });
		 
		  var leg=0;
		  leg=ids.length;
		if(leg>=2)
		{
				  $('#table_menu li').filter('[ord="or_'+ids[0]+'"]').remove();
				  var selected_activities =$('#table_menu li');
					var ids = new Array();
					var prefs = new Array();
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
				  });
				  $.post("load_bill.php", {set:'loadwholelist'},
				  function(data)
				  {
				  data=$.trim(data);
				  $('#acc_1').html(data);
				  });
		}else
		{
			 $(this).closest(".active").remove();
			 $('#table_menu li').filter('[ord="or_'+ids[0]+'"]').remove();
			 var selected_activities =$('#table_menu li');
					var ids = new Array();
					var prefs = new Array();
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
				  		
										
				  });
				  $.post("load_bill.php", {set:'loadwholelist'},
				  function(data)
				  {
				  data=$.trim(data);
				  $('#acc_1').html(data);
				  });
		}
		 $.post("load_bill.php", {set:'loadwholelist'},
				  function(data)
				  {
				  data=$.trim(data);
				  $('#acc_1').html(data);
				  });
		 var selected_activities =$('#table_menu li');
					var ids = new Array();
					var prefs = new Array();
					selected_activities.each(function(){
						var id_str       =  $(this).attr("name");
						var id_arr	     =	id_str.split("_");
						var selval       =  id_arr[1];
							if(selval!='undefined' && selval!='' && selval!=null){
								ids.push(selval);
							}
					});
		var l=ids.length;
		if(ids==0)
		{
			$('.tab-content').empty();
		}
		$(".tab-pane").closest().addClass("active"); 
	});
	/***************************************  close click ends ******************************************************************  */
	
	/*****************************************  Dropdown starts ******************************************************************  */
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
				$('#menu1').fancySelect().on('change', function() {
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
	/***************************************  Dropdown ends ******************************************************************  */
	
	/*****************************************  cancel starts ******************************************************************  */
	$('.a_demo_four').click(function () {
			  if ($(this).hasClass('a_demo_four_active'))
			  {
							var pref_str   =  $(this).attr("qty");
								var pref_arr	  =	 pref_str.split("_");
								var prefval       =  pref_arr[1];
								
								var id_str1   =  $(this).attr("slno");
								var id_arr1	  =	 id_str1.split("_");
								var selval1       =  id_arr1[1];
								
								var pref_str2   =  $(this).attr("menu");
								var pref_arr2	  =	 pref_str2.split("_");
								var prefval2       =  pref_arr2[1];
								
								var pref_str3   =  $(this).attr("kot");
								var pref_arr3	  =	 pref_str3.split("_");
								var prefval3       =  pref_arr3[1];
						  
							 $.post("load_bill.php", {st:"enable",menu:prefval2,sln:selval1,kot:prefval3,qty:prefval,set:'cancelstatussingle'},
							  function(data)
							  {
							  data=$.trim(data);
							  
							  });
							
							  
				  			$(this).removeClass('a_demo_four_active'); 
				   			$(this).parent().parent().removeClass('cancel_clr');
							  
							  $.post("load_bill.php", {set:'loadwholelist'},
						function(data)
						{
						data=$.trim(data);
						 $('#acc_1').html(data);
						 
						});
			  }else
			  {
								var pref_str   =  $(this).attr("qty");
								var pref_arr	  =	 pref_str.split("_");
								var prefval       =  pref_arr[1];
								
								var id_str1   =  $(this).attr("slno");
								var id_arr1	  =	 id_str1.split("_");
								var selval1       =  id_arr1[1];
								
								var pref_str2   =  $(this).attr("menu");
								var pref_arr2	  =	 pref_str2.split("_");
								var prefval2       =  pref_arr2[1];
								
								var pref_str3   =  $(this).attr("kot");
								var pref_arr3	  =	 pref_str3.split("_");
								var prefval3       =  pref_arr3[1];
						  
							 $.post("load_bill.php", {st:"cancel",menu:prefval2,sln:selval1,kot:prefval3,qty:prefval,set:'cancelstatussingle'},
							  function(data)
							  {
							  data=$.trim(data);
							  
							  });
				  			$(this).addClass('a_demo_four_active');
							$(this).parent().parent().addClass('cancel_clr');
							//$('.a_demo_four').filter('[ordno="or_'+selval+'"]').addClass('a_demo_active');
							 $.post("load_bill.php", {set:'loadwholelist'},
						function(data)
						{
						data=$.trim(data);
						 $('#acc_1').html(data);
						 
						});
			  }
			
			  //kot slno menu rate qty
			   var id_strs   =  $('#table_menu .active').attr("name");
					var id_arrs	  =	 id_strs.split("_");
					var selvals       =  id_arrs[1];
			  
			   var selected_activities =$('.a_demo_four_active');
				  var rt = 0;
				  var qt =0;
				  var tot=0;
				  
				  var menu=new Array();
				  var qty=new Array();
				  var slno=new Array();
				  var kot=new Array();
				  var kots=new Array();
				  var menuus=new Array();
				  var order=new Array();
				  var orders="";
				  
			  selected_activities.each(function(){
					var id_str   =  $(this).attr("rate");
					var id_arr	  =	 id_str.split("_");
					var selval       =  id_arr[1];
				  var pref_str   =  $(this).attr("qty");
					var pref_arr	  =	 pref_str.split("_");
					var prefval       =  pref_arr[1];
				  if(prefval!='undefined' && prefval!='' && prefval!=null){
					  qty.push(prefval);
				  }
				  var pref_str4   =  $(this).attr("kot");
					var pref_arr4	  =	 pref_str4.split("_");
					var prefval4       =  pref_arr4[1];
					
					var pref_str5   =  $(this).attr("menu");
					var pref_arr5	  =	 pref_str5.split("_");
					var prefval5       =  pref_arr5[1];
				  if(prefval4!='undefined' && prefval4!='' && prefval4!=null){
					  var i=0,j=0;
					  i=jQuery.inArray( prefval4, kots );
					  j=jQuery.inArray( prefval5, menuus );
					  if( j==(-1))
					  {
					  tot= parseFloat(tot) +  ( parseFloat(selval) * parseFloat(prefval));
					  }
					  kots.push(prefval4);
					   menuus.push(prefval5);
				  }
				  });
				  $('#totalcancelrate').val(tot);
				  selected_activities.each(function(){
					   var id_str1   =  $(this).attr("slno");
					var id_arr1	  =	 id_str1.split("_");
					var selval1       =  id_arr1[1];
				  if(selval1!='undefined' && selval1!='' && selval1!=null){
					  slno.push(selval1);
				  }
				  var pref_str2   =  $(this).attr("menu");
					var pref_arr2	  =	 pref_str2.split("_");
					var prefval2       =  pref_arr2[1];
				  if(prefval2!='undefined' && prefval2!='' && prefval2!=null){
					  menu.push(prefval2);
				  }
				  
				   var pref_str3   =  $(this).attr("kot");
					var pref_arr3	  =	 pref_str3.split("_");
					var prefval3       =  pref_arr3[1];
				  if(prefval3!='undefined' && prefval3!='' && prefval3!=null){
					  kot.push(prefval3);
				  }
				  
				  });
				 if(menu!="")
				 {
						 $.post("load_bill.php", {set:'loadwholelist'},
						function(data)
						{
						data=$.trim(data);
						 $('#acc_1').html(data);
						 $('#table_menu li').removeClass('active');
						 $('.tab-pane').removeClass('active');
						  $('.tab-pane').filter('[nam="nam_'+selvals+'"]').addClass('active');
						 $('#table_menu li').filter('[name="nam_'+selvals+'"]').addClass('active');
						});
				  
				 }
				else
				 {
 					$.post("load_bill.php", {set:'loadwholelist'},
						function(data)
						{
						data=$.trim(data);
						 $('#acc_1').html(data);
						 
						});
				  
				 }
		});
	/***************************************  cancel ends ******************************************************************  */
	
	/*****************************************  proceed starts ******************************************************************  */
	 $('.prcdbillbtn').click(function () {
		// alert("h");
					  
					 var selected_activities =$('#table_menu li');
					 var order=new Array();
					 var tabnm=new Array();
					 var prf=new Array();
					  var totnam=new Array();
					 var finalorder=new Array();
					  selected_activities.each(function(){
						  var pref_str4   =  $(this).attr("ord");
						  var pref_arr4	  =	 pref_str4.split("_");
						  var prefval4       =  pref_arr4[1];
						   if(prefval4!='undefined' && prefval4!='' && prefval4!=null){
								order.push(prefval4);
							}
							
							var name_str4   =  $(this).attr("name");
						  var name_arr4	  =	 name_str4.split("_");
						  var nameval4       =  name_arr4[1];
						   if(nameval4!='undefined' && nameval4!='' && nameval4!=null){
								tabnm.push(nameval4);
							}
							
							var prefss_str4   =  $(this).attr("pref");
						  var prefss_arr4	  =	 prefss_str4.split("_");
						  var prefssval4       =  prefss_arr4[1];
						   if(prefssval4!='undefined' && prefssval4!='' && prefssval4!=null){
								prf.push(prefssval4);
							}
							var tot_str4   =  $(this).attr("total_name");
						 // var tot_arr4	  =	 tot_str4.split("_");
						 // var totval4       =  tot_arr4[1];
						   if(tot_str4!='undefined' && tot_str4!='' && tot_str4!=null){
								totnam.push(tot_str4);
							}
							
							
							
						});
						
						var cunt=order.length;
						
						if(cunt>1)
						{
						finalorder = getDistinctArray(order);
						}else
						{
							finalorder = (order);
						}
						var cancelamt=$('#totalcancelrate').val();
						var branch="ck";
						//alert(finalorder)
						 $.post("load_bill.php", {finalorder:finalorder,cancelamt:cancelamt,branch:branch,tabno:tabnm,pref:prf,totname:totnam,set:'proceedbilling'},
						function(data)
						{
						data=$.trim(data);
						//alert(data);
						if(data.indexOf("exception") == -1){
								$('#hidchk').val("billno");
								if(data=="Error..In Bill Generatation")
								  {
									  var hidbillgenerate_error=$('#hidbillgenerate_error').val();
									  $('#bill_scr').html(hidbillgenerate_error);
								  }else if(data=="Orders pending to be served")
								  {
									  var hidbillgenerate_pend=$('#hidbillgenerate_pend').val();
									  $('#bill_scr').html(hidbillgenerate_pend);
								  }else if(data=="Bill generated sucessfully")
								  {
									  var hidbillgenerate_bill=$('#hidbillgenerate_bill').val();
									  $('#bill_scr').html(hidbillgenerate_bill);
								  }
								//window.location="print_details.php?set=billprint";
								var hidbillclose_null=$('#hidbillclose_null').val();
								var proc_billgenerate_split=$('#proc_billgenerate_split').val();
								$.post("print_details.php", {set:'billprint'},
								function(data)
								{
								//data=$.trim(data);
								//var data2='';
								   $.post("load_bill.php", {set:'closedirectfuncion'},
									function(data2)
									{
										
									data2=$.trim(data2);
									//alert(data2);
					  				if(data2.indexOf("exception") == -1)
										{
											window.location="bill_generation_screen1.php";
											$(".a_demo_four").css("display", "none");
					  						$(".prcdbillbtn").css("display", "none");
					 						 $(".gotfirstprev").css("display", "none");
										}else
										{alert(data2);}
									
									});	
									
								});
								
						}else
						{
							alert(data)
							$(".a_demo_four").css("display", "block");
					  		$(".prcdbillbtn").css("display", "block");
					  		$(".gotfirstprev").css("display", "block");
						}
						  
						});
						//
						/* $.post("load_bill.php", {set:'billingtotalrate'},
						function(data)
						{
						data=$.trim(data);
						
						$('#totalrate').html(data);
						  
						});
						$.post("load_bill.php", {set:'loadwholelist'},
						function(data)
						{
						data=$.trim(data);
						$('#acc_1').html(data);
						});*/
 		});
	/***************************************  proceed ends ******************************************************************  */
	
	/*****************************************  Proceed to next starts ******************************************************************  */
	  $('.procdtonext').click(function () {
			  var s=$('#hidchk').val();
			  if(s=="")
			  {
				  $('.prcdbillbtn').addClass('blink_me_alert');
				  
				  setTimeout(function() {
					  if($('.prcdbillbtn').hasClass("blink_me_alert"))
					  {
					   $('.prcdbillbtn').removeClass("blink_me_alert");
					  }
				   }, 3000);
				  //$('.prcdbillbtn').delay(2000).removeClass('blink_me_alert');
			  }else
			  {
				  window.location="bill_generation_screen3.php";
			  }

  });
	/***************************************  Proceed to next ends ******************************************************************  */
	
	/*****************************************  Dropdown starts ******************************************************************  */
	
	/***************************************  Dropdown ends ******************************************************************  */
	 function getDistinctArray(arr) {
						var compareArray = new Array();
						if (arr.length > 1) {
							for (i = 0;i < arr.length;i++) {
								if (compareArray.indexOf(arr[i]) == -1) {
									compareArray.push(arr[i]);
								}
							}
						}
						return compareArray;
					}
}); 

