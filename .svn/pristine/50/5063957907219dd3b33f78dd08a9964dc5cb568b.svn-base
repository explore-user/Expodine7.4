// JavaScript Document
$(document).ready(function(){
	
	/***************************************  table selection starts ******************************************************************  */
	$('.container_buttons p a').on('click',function (event) {
		
		event.stopImmediatePropagation();
			  if ($(this).hasClass('a_demo_active'))
			  {
				   var id_str   =  $(this).attr("ordno");
					var id_arr	  =	 id_str.split("_");
					var ord       =  id_arr[1];
					//$(this).removeClass('a_demo_active'); 
					
					var id_str_or       =  $('.completed_order_tab_active').attr("types");
		  			var id_arr_or	     =	id_str_or.split("_");
		  			var selval_or       =  id_arr_or[1];
					if(selval_or=="completdorder")
					{
						$('.container_buttons p a').filter('[ordno="or_'+ord+'"]').removeClass('a_demo_active');
					}else
					{
						 var id_str   =  $(this).attr("bilno");
						var id_arr	  =	 id_str.split("_");
						var bln       =  id_arr[1];
						$('.container_buttons p a').filter('[bilno="bl_'+bln+'"]').removeClass('a_demo_active');
					}
					loadall();
					 $('#kot_scroll').load('load_bill.php?set=loadtables');
	 				  var srch=$('#searchbill').val();
					  if(srch!="")
					  {
					 $('#kot_scroll_pend').load('load_bill.php?set=loadtables_pendSearch&sr='+srch);
					  }else
					  {
					  $('#kot_scroll_pend').load('load_bill.php?set=loadtables_pend');
					  }
			  }else
			  {
					$(this).addClass('a_demo_active');
					var id_str   =  $(this).attr("ordno");
					var id_arr	  =	 id_str.split("_");
					var ord       =  id_arr[1];
					
					var id_str2       =  $('.completed_order_tab_active').attr("types");
		  			var id_arr2	     =	id_str2.split("_");
		  			var selval       =  id_arr2[1];
					if(selval=="completdorder")
					{
						$('.container_buttons p a').filter('[ordno="or_'+ord+'"]').addClass('a_demo_active');
					}else
					{
						 var id_str1   =  $(this).attr("bilno");
						var id_arr1	  =	 id_str1.split("_");
						var bln       =  id_arr1[1];
						$('.container_buttons p a').removeClass('a_demo_active');
						$('.container_buttons p a').filter('[bilno="bl_'+bln+'"]').addClass('a_demo_active');
					}
					loadall();
					 $('#kot_scroll').load('load_bill.php?set=loadtables');
	  				 var srch=$('#searchbill').val();
						if(srch!="")
						{
					   $('#kot_scroll_pend').load('load_bill.php?set=loadtables_pendSearch&sr='+srch);
						}else
						{
					
						$('#kot_scroll_pend').load('load_bill.php?set=loadtables_pend');
						}
					
			  }
			  function loadall()
			  {
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
			  }
			  

  });
	/***************************************  table selection ends ******************************************************************  */
}); 
