// JavaScript Document
$(document).ready(function(){
	
	/*************************************** category selection  starts *************************************************  */
	$('.eachitem_counter').click(function (e) {
            
            
            var chk=$('.comp_bill:checkbox:checked').length;
                                            if(chk>0 ){ 
                                                var dataString1 = 'value=orderlistload';
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
                                             }
            
	 localStorage.edit_ta='N';
	
        var chknew= $('#checkid_ta').val();
//	if($(this).hasClass('takeaway_contant_tr_active'))
//		{
//			
//			$(this).removeClass('takeaway_contant_tr_active');
//			
//			
//		}else
//		{
//			$(this).addClass('takeaway_contant_tr_active');	
//		}
                
                //$(this).addClass('takeaway_contant_tr_active');
                
                 var selval   =  $(this).attr('menuid');
		  var actqty   =  $(this).attr('actqty');
		  var portname   =  $(this).attr('portionname');
		  var prefname   =  $(this).attr('pref');
                  var rate = $(this).attr('rate');
                   var sln = $(this).attr('sln');
                 
//		  $('.counter_menu_popup_overlay').css("display","block"); 
//		  $('.counter_menu_popup').css("display","block"); 


 if(chknew=="delete_item"){
                  $(".confrmation_overlay").css("display","none");
		  $('.bottom_edit_cc_popup').css("display","none"); 
                    $(".olddiv").removeClass("new_overlay");
              }else{
                  $(".confrmation_overlay").css("display","block");
		  $('.bottom_edit_cc_popup').css("display","block"); 
			  $(".olddiv").addClass("new_overlay");
                          
            }
			 $('.menu_sub_item').removeClass('take_item_active');  
			 $(this).find('div').addClass('take_item_active');
			 
			  var food= $('.online_order_box_act').attr('food_val');
				  var request = $.ajax({
					url: "takeaway_popup.php",
					method: "POST",
					data: {menu:selval,typesub:'Edit',actqty:actqty,portname:portname,prefname:prefname,manualrate:rate,serialno:sln,food:food },
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
                
                
                
                
		var itemsact = $('.takeaway_contant_tr_active');	
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
	/*************************************** Sub category selection  ends *************************************************  */
        
        
        
		});