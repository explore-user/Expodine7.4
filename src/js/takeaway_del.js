// JavaScript Document
$(document).ready(function(){
	/*************************************** delete close starts *************************************************  */
	
		$('.ts_status').click(function (e) {
				$('#ta_confirm').css('display','none');
                               $('#cs__clearall_confirm_ta').css('display','none');
			});
		/*************************************** delete close ends ************************************************  */
	/*************************************** delete ok starts *************************************************  */
        
  $('.clear_all_ta').click(function () {
      
      var cs_check=$('.total_itemcount1').text();
     
      if(cs_check>0){
              $('#cs__clearall_confirm_ta').css('display','block');            
      }else{
       
        $('.alert_error_popup_all_in_one').show();
        $('.alert_error_popup_all_in_one').text('No Items To Delete');
        $('.alert_error_popup_all_in_one').delay(1000).fadeOut('slow'); 
          
      }
});

$('.clear_all_ok_ta_online').click(function () {
    
  $('.alert_error_popup_all_in_one').show();
   $('.alert_error_popup_all_in_one').text('CLEARING DATA');
    
   $('.online_pop_show').hide();
    
			var  dataString = 'value=menudelete_clear_ta';
			  var request=  $.ajax({
			type: "POST",
			url: "load_takeaway.php",
			data: dataString,
			success: function(data) {
                            
                           $('.ts_statusok').click();
                        }
                      });
        $('#cs__clearall_confirm_ta').css('display','none');                 
        $('.ta_errormsg').show();
        $('.ta_errormsg').html('Deleted');
      
       window.location.href='take_away_.php';	                              
                                         
});
        
$('.clear_all_ok_ta').click(function () {
    
     $('.alert_error_popup_all_in_one').show();
     $('.alert_error_popup_all_in_one').text('CLEARING DATA');
   
			var  dataString = 'value=menudelete_clear_ta';
			var request=  $.ajax({
			type: "POST",
			url: "load_takeaway.php",
			data: dataString,
			success: function(data) {
                            
                         $('.ts_statusok').click();
                       }
                    });
       $('#cs__clearall_confirm_ta').css('display','none');                 
       $('.ta_errormsg').show();
       $('.ta_errormsg').html('Deleted');
             
      window.location.href='take_away_.php';	                              
                                         
});




	
  $('.ts_statusok').click(function (e) {
      
		 var selected_activities =$('.takeaway_contant_tr_active');
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
			dataString = 'value=deleteitemstake&menuid=' + menu +'&sln=' + sl;
			var request=  $.ajax({
			type: "POST",
			url: "load_takeaway.php",
			data: dataString,
			success: function(data) {
				
				$('#ta_confirm').css('display','none');
				
				
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
			  $('.ta_errormsg').text("Deleted...");
			  $('.ta_errormsg').delay(2000).fadeOut('slow');
			  
			  
				}
	  		});
                        
		data = null;
                
		dataString = null;
		request.onreadystatechange = null;
		request.abort = null;
		request = null;
		return false;
			  
		
});
                
/******** delete ok ends ********************  */
	
});