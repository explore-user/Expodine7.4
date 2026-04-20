// JavaScript Document
$(document).ready(function(){
	
	/*************************************** category selection  starts *************************************************  */
        
 $('.eachitem_counter').click(function (e) {
     
     
     
	                                    var chk=$('.comp_bill:checkbox:checked').length;
                                            
                                            if(chk>0 ){ 
                                                
                                                var dataString1 = 'value=loaditemsorderd';
						var request=  $.ajax({
						type: "POST",
						url: "load_counter_sales.php",
						data: dataString1,
						success: function(data) {
							$('.listorderditems').html(data);
                                                               
                                                 }
                                                 });
                                             }
        localStorage.edit_cs='N';
        
	var chknew= $('#checkid').val();
        
	if($(this).hasClass('active_couter_list'))
		{
		  $(this).removeClass('active_couter_list');
				
		}else
		{
		  $(this).addClass('active_couter_list');	
		}
                
                
                $(this).addClass('active_couter_list');
		
		  //event.stopImmediatePropagation();
		  var selval   =  $('.active_couter_list').attr('menuid');
		  var actqty   =  $('.active_couter_list').attr('actqty');
		  var portname   =  $('.active_couter_list').attr('portionname');
		  var prefname   =  $('.active_couter_list').attr('pref'); 
                  var rate1 = $('.active_couter_list').attr('rate');
                  var sln = $('.active_couter_list').attr('sln');
                    
              if(chknew=="delete_item"){
                  
		  $('.counter_menu_popup_overlay').css("display","none"); 
		  $('.counter_menu_popup').css("display","none"); 
                  
              }else{
                   
              }
			 $('.menu_sub_item').removeClass('take_item_active');  
			 $('.edititems').find('div').addClass('take_item_active');
			 
			  //alert(selval);
				  var request = $.ajax({
					url: "counter_popup.php",
					method: "POST",
					data: {menu:selval,typesub:'Edit',actqty:actqty,portname:portname,prefname:prefname,manualrate:rate1,serialno:sln },
					dataType: "html"
				  });
				   
				  request.done(function( msg ) {
                                          $('.counter_menu_popup_overlay').css("display","block"); 
		                          $('.counter_menu_popup').css("display","block"); 
					  $( ".counter_menu_popup" ).html( msg );
                                          
					
				  });
				  
				  data = null;
					msg=null;
				  request.onreadystatechange = null;
				  request.abort = null;
				  request = null;
		
                  
	var itemsact = $('.active_couter_list');
        
	var actlenght=(itemsact.length);
	if(actlenght==1)
	{
		$('.edititems').removeClass('right_act_edit_dsbl');
	}else
	{
		$('.edititems').addClass('right_act_edit_dsbl');
	}
	if(actlenght>=1)
	{
		$('.delitems').removeClass('right_act_delete_dsbl');
	}
	else
	{
		$('.delitems').addClass('right_act_delete_dsbl');
	}
        
	var totalleng = $('.eachitem_counter');	
        
	var totalct=(totalleng.length);
	if(totalct==actlenght)
	{
		$("input:checkbox").prop("checked", true);
	}else
	{
		$("input:checkbox").prop("checked", false);
	}
	
         
	});	
	
        
});