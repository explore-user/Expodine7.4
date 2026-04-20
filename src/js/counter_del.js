// JavaScript Document
$(document).ready(function(){
	/*************************************** delete close starts *************************************************  */
	
		$('.ts_status').click(function (e) {
				$('#ta_confirm').css('display','none');
                                  $('#cs__clearall_confirm').css('display','none');   
			});
		/*************************************** delete close ends ************************************************  */
	/*************************************** delete ok starts *************************************************  */


$('.clear_all_cs').click(function () {
     
      var cs_check=$('.total_itemcount2').text();
     
      if(cs_check>0){
         $('#cs__clearall_confirm').css('display','block');     
      }else{
            
                        //alert('No items to Delete')
                        $('.alert_error_popup_all_in_one').show();
                        $('.alert_error_popup_all_in_one').text('No Items To Delete');
                        $('.alert_error_popup_all_in_one').delay(1000).fadeOut('slow'); 
      }
   
});



$('.clear_all_ok').click(function () {
   
    $('.alert_error_popup_all_in_one').show();
    $('.alert_error_popup_all_in_one').text('CLEARING DATA');
                     
                        
			var  dataString = 'value=menudelete_clear';
			var request=  $.ajax({
			type: "POST",
			url: "load_counter_sales.php",
			data: dataString,
			success: function(data) {
                                                var dataString1;
						dataString1 = 'value=loaditemsorderd';
						var request1=  $.ajax({
						type: "POST",
						url: "load_counter_sales.php",
						data: dataString1,
						success: function(data1) {
						 $('.listorderditems').html(data1);
								
						}
						});
                                                
                                  $('.ts_statusok').click();
                 }
               });
  $('#cs__clearall_confirm').css('display','none');     
  
        
});


	
	$('.ts_statusok').click(function (e) {
            
		  var selected_activities =$('.active_couter_list');
		  var menu = new Array();
		  var sl = new Array();
		  selected_activities.each(function(){
				  var menuid   =  $(this).attr("menuid");
				  if(menuid!='undefined' && menuid!='' && menuid!=null){
					  menu.push(menuid);
				  }
				  var slno   =  $(this).attr("sln");
				  if(slno!='undefined' && slno!='' && slno!=null){
					  sl.push(slno);
				  }
			  });
                          
			  
			var dataString;
			dataString = 'value=menudelete&menuid=' + menu +'&sln=' + sl;
			var request=  $.ajax({
			type: "POST",
			url: "load_counter_sales.php",
			data: dataString,
			success: function(data) {
				
				$('#ta_confirm').css('display','none');
				
				                var dataString1;
						dataString1 = 'value=loaditemsorderd';
						var request1=  $.ajax({
						type: "POST",
						url: "load_counter_sales.php",
						data: dataString1,
						success: function(data1) {
						 $('.listorderditems').html(data1);
								
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
								if(actlenght>=1)
								{
									$('.countergenerate').css("display","block");
                                                                        $('.settle_direct').css("display","block");
								}else
								{
									$('.countergenerate').css("display","none");
                                                                        $('.settle_direct').css("display","none");
								}
			   $('.ta_errormsg').css("display",'block');
			  $('.ta_errormsg').text("Deleted");
			  $('.ta_errormsg').delay(2000).fadeOut('slow');
                          
                          location.reload();
			  var focus_on=$('#be_search_focus_cs').val();
                          if(focus_on=='search'){
                          $('#'+focus_on).focus();
                          }
                          else if(focus_on=='search_code'){
                          $('#codesrch_c').focus();
                          }else{
                          $('#search_barcode').focus();
                          }
                          $('#search_barcode').val('');
                          $('#codesrch_c').val('');
                          $('#search').val('');
			  
				}
	  		});
                        
		data = null;
		dataString = null;
		request.onreadystatechange = null;
		request.abort = null;
		request = null;
	        return false;
	        
});
	/*************** delete ok ends ************  */
	
});