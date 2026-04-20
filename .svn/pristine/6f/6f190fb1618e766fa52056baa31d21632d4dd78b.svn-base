// JavaScript Document

$(document).ready(function(){

    /*********** Confirm starts ********************  */
        
    $(".waiter_select_btn").click(function(){
            
            $(".waiter_select_btn").removeClass('waiter_select_btn_act');
            $(this).addClass('waiter_select_btn_act');
            
    });
        
        
    $(".confirmallfdetails").click(function(){
        
        
         $('.confirmallfdetails').addClass('disablegenerate') ;
        
         setTimeout(function(){
             
          $('.confirmallfdetails').removeClass('disablegenerate') ;
                     
         },5000);
        
        
           
            var dis_status = $('#waiter_display').val();
           
            if(dis_status == 'Y'){
                $(".waiter_select_popup").css("display","block");
                $(".confrmation_overlay").css("display","block");
             }else if(dis_status == 'N'){
                $("#waiter_popup_ok_btn").trigger('click');
             }
             
            
    });
        
        
        
 $("#waiter_popup_ok_btn").click(function(){ 
     
            var floor=$('#floor_id').val();
            var order=$('#order_id').val();
            var order_confirming_staff=$('#steward_id').val();
            var staffid =  $(".waiter_select_btn_act").attr('staff_id');
               
            $(".confrmation_overlay").css("display","none");
            $(".waiter_select_popup").css("display","none");
            
            $(".printer_issue_popup").css("display","block");
	    $(".olddiv").addClass("new_overlay");
            
            var KOT_print = "KOT_print";
            
            $.post("printercheck_1.php", {type:KOT_print,floor:floor,order:order},
                                               
            function(data)
            { 
                
            data=$.trim(data); 
          
            $(".olddiv").removeClass("new_overlay");
            if(data !=0)
            { 
                                            
              $('.kotconfirmpopup').css('display','block');   
              $('#kotfailmsg').html(data);
              $(".confrmation_overlay").css("display","block");
                                                        
            }else{
            
            var ordermsg1 = ($("#ordermsg1").val());
           
	    if($('.preference_table').find('div').hasClass('menu_order_delet_btn') || $('.preference_table').find('div').hasClass('combo_order_delet_btn'))
	    {
                   
			var backto=$('#orderconfirm_bktotablesel').val();
                        
			$.post("itemedit.php", {set:'confirm',waiter:staffid,order_confirming_staff:order_confirming_staff},
					function(data)
					{
                                          
					data=$.trim(data);
                                        
                                       
                                        var str2 = "KOT-";
                                        
                                        if(data.indexOf(str2) != -1){
                                            
                                            var chk='YES';
                                        }else{
                                             var chk='NO'; 
                                        }
                                        
                                        
					if(data=='' || chk=='YES')
					{  	
                                                      
					if(backto=="Y")
					{
                                            
                                        $('.loyalty_cs_pop_overlay').show();
                                        
                                                    
                                        $.post("print_details.php",  {set:'kotprint'},
					function(data)
					{     
                                            
                                        $.post("print_details.php", {set:'console'});  
                                           
                                        window.location="table_selection.php";  
                                            
                                        }); 
                                         				
					}else
					{
                                            
					$('.ordelist_table').load('viewitems.php');
                                                                 
                                        $.post("print_details.php",  {set:'kotprint'},
					function(data)
					{     
                                            
                                           $.post("print_details.php", {set:'console'});  
                                             
                                        });    
                                          					 
					}
							
                                        $('.ordelist_table').load('viewitems.php');
							     
					}else
					{
					   alert(data);
					}
						
					});
					
					
	  }
	  else if($('.preference_table').find('div').hasClass('menu_order_confirm_btn') || $('.preference_table').find('div').hasClass('menu_order_confirm_yellow_btn'))
	  {
		  	 $(".loaderror").css("display","block");
		         $(".loaderror").addClass("popup_validate");
			 $(".loaderror").text(ordermsg1);
			 $('.loaderror').delay(2000).fadeOut('slow');
	  }
	  else  if(!$('.preference_table').find('div').hasClass('menu_order_confirm_btn') || !$('.preference_table').find('div').hasClass('menu_order_confirm_yellow_btn') || !$('.preference_table').find('div').hasClass('menu_order_delet_btn')||!$('.preference_table').find('div').hasClass('combo_order_delet_btn'))
	  {                 
		  	 $(".loaderror").css("display","block");
			 $(".loaderror").addClass("popup_validate");
			 $(".loaderror").text("CART IS EMPTY");
			 $('.loaderror').delay(2000).fadeOut('slow');
	  }
	 
        } 
        });
        	
});	

      /************  Confirm ends ***********  */
	
        
        
        
      $('.confirmkotclose').click(function(){
          
               $('.kotconfirmpopup').css('display','none');    
               $(".confrmation_overlay").css("display","none");
     });  
        
        
    
        
 $('.confirmkotok').click(function(){
    
                                      
               var staffid =  $(".waiter_select_btn_act").attr('staff_id');
               var order_confirming_staff=$('#steward_id').val();          
               $(".confrmation_overlay").css("display","none");
               $(".waiter_select_popup").css("display","none");
            
             // $(".printer_issue_popup").css("display","block");
	    //$(".olddiv").addClass("new_overlay");
            
         var ordermsg1 = ($("#ordermsg1").val());
           
	 if($('.preference_table').find('div').hasClass('menu_order_delet_btn') ||$('.preference_table').find('div').hasClass('combo_order_delet_btn'))
	 {
			var backto=$('#orderconfirm_bktotablesel').val();
			$.post("itemedit.php", {set:'confirm',waiter:staffid,order_confirming_staff:order_confirming_staff},
					function(data)
					{    
						data=$.trim(data);
                                                
                                               var str2 = "KOT-";
                                        
                                        if(data.indexOf(str2) != -1){
                                            
                                            var chk='YES';
                                        }else{
                                             var chk='NO'; 
                                        }
                                        
                                        
					if(data=='' || chk=='YES')
					{  	
							 $('.ordelist_table').load('viewitems.php');
                                                         
							  $.post("print_details.php", {set:'kotprint'});
                                                          
							  $.post("print_details.php", {set:'console'});
							   	
							  //if(data=="0")
							 // {
                                                          
								 if(backto=="Y")
								 {
									 $.post("load_div.php", {set:'chekenablestatus'},
									  function(data)
									  {
									      data=$.trim(data);
									
									      window.location.href="table_selection.php";
									  });
									 
								
								 }else
								 {
									 
									  $('.ordelist_table').load('viewitems.php');
									
								 }
							 // }
						  }else
						  {
							  alert(data);
						  }
						
	});
					
					
	}
	else if($('.preference_table').find('div').hasClass('menu_order_confirm_btn') || $('.preference_table').find('div').hasClass('menu_order_confirm_yellow_btn'))
	{
		  	 $(".loaderror").css("display","block");
		     $(".loaderror").addClass("popup_validate");
			 $(".loaderror").text(ordermsg1);
			 $('.loaderror').delay(2000).fadeOut('slow');
	  }
	  else  if(!$('.preference_table').find('div').hasClass('menu_order_confirm_btn') || !$('.preference_table').find('div').hasClass('menu_order_confirm_yellow_btn') || !$('.preference_table').find('div').hasClass('menu_order_delet_btn')|| !$('.preference_table').find('div').hasClass('combo_order_delet_btn'))
	  {
		  	 $(".loaderror").css("display","block");
			 $(".loaderror").addClass("popup_validate");
			 $(".loaderror").text("Nothing to confirm");
			 $('.loaderror').delay(2000).fadeOut('slow');
	  }
             
           $('.kotconfirmpopup').css('display','none');    
           $(".confrmation_overlay").css("display","none");
           
            var msg=$('#kotfailmsg').html();
          
             var dataString_log ='set_log=kotconfirmbylogin&failmsg='+msg;
             $.ajax({
             type: "POST",
             url: "menu_order.php",
             data: dataString_log,
             success: function(data) {
             
             }
             });
  });    
        
        
});

