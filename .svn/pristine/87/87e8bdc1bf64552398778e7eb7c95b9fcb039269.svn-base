// JavaScript Document
$(document).ready(function(){
    

    /*********** Popup function starts ***********************  */

	$('#load_menuitems').on("click",".md-trigger1",function(event) { 
            
	        event.stopImmediatePropagation();
                var mainlang=$('#mainlanguage').val();
            
                var dateopen=$('#dayopendate').val();
                
		var id_str   =  $(this).attr("title");
	        var id_arr	  =	 id_str.split("_");
		var selval       =  id_arr[1]; 
                 
                var id_str   =  $(".category_selection>li>a.left_main_menu_items_focus").attr("title");
                var id_arr	  =	 id_str.split("_");
                var cat_id       = id_arr[1];
                
                 
                 //alert(cat_id); 
                 var id_str   =  $("#load_subcat>li>a.left_mn_menu_odr_focus").attr("title");
           
		  $('.mynewpopupload').css("display","block"); 
		  $(".olddiv").addClass("new_overlay");
		  $(".portion_view_btn").addClass("focussed"); 
                  
                  
                  var typ_pop= $(this).attr('typ_pop');   
                  
                  setTimeout(function(){
		              
                  if(typ_pop=='Loose'){
                      
                       $('.enter-qty-act').val('1');
                       $('.looseweight').addClass('enter-qty-act');
                       $('.weight-field').addClass('focussed');
                       $(".enter-qty-act").removeClass("focussed");
                       $(".counter_portion_view_btn ").removeClass("enter-qty-act");
                       $('.weight-field').text('1');
                       
                       setTimeout(function () {
                           
                        var span = document.querySelector(".weight-field");
                        var range = document.createRange();
                        range.selectNodeContents(span);
                        range.collapse(false); // cursor to end
                        var sel = window.getSelection();
                        sel.removeAllRanges();
                        sel.addRange(range);
                        span.focus();
                        
                      }, 500);
                        
                  }
                  
                  if(typ_pop=='Packet'){
                        $('.enter-qty-act').val('1');
                  }
                  
                 }, 500);
                  
                       
                 var request = $.ajax({
					url: "load_popupmenu.php",
					method: "POST",
					data: {menu:selval},
					//dataType: "html"
                                        success:function( msg ) {
                                            //alert(msg);
					$( ".mynewpopupload" ).html( msg );}
				  });
                  
//                          request.done(function( msg ) {
//					$( ".mynewpopupload" ).html( msg );
//				  });
                          
                          
                          
                          
				  data = null;
                                  msg=null;
				  request.onreadystatechange = null;
				  request.abort = null;
				  request = null;
 
		  });
		  $('.md-close').click( function(event) {  
		  event.stopImmediatePropagation();	
			  $(".olddiv").removeClass("new_overlay"); 
			  $('.mynewpopupload').empty();
			  $('.mynewpopupload').css("display","none");
		});
	/***************************************  Popup function starts *************************************************  */
	

        
		});
                
                


