// JavaScript Document
$(document).ready(function(){

/*************************************** Sub category selection starts *************************************************  */
	$('#load_subcat').on("click","li",function () { 
            
                var mainlang=$('#mainlanguage').val();
                var dateopen=$('#dayopendate').val();
                var listimage=$('#listimage').val();
                var floorid=$('#floorid').val();
                var apilink=$('#menuapilink').val();
              
		$('#portion_value').empty();
		$('#calc_value').empty();
		$('#pref_add').css( "display", "none" );
		$(".prefrence_submit_buton_cc").show();
		$('#portion_load').empty();
		$('#quantity_val').empty();
                
                var id_str   =  $(".category_selection>li>a.left_main_menu_items_focus").attr("title");
                var id_arr	  =	 id_str.split("_");
                var cat_id       = id_arr[1];
               
                
                
		$("#load_subcat>li.category-menu-active").removeClass("category-menu-active");
              
                var sb1=$(this).attr("title");  
                
                var sb11	  =	 sb1.split("_");
                var sb111       = sb11[1];
            
                if(sb111!='all'){
		$('#subcat_new_'+sb111).addClass('category-menu-active'); 
              
                 }else{
                     $('#allsubcat_new_all').addClass('category-menu-active'); 
                 }
               
                
		var id_str   =  $("#load_subcat>li.category-menu-active").attr("title");
               
		var id_arr	  =	 id_str.split("_");
		var sub_id       = id_arr[1];
                
                
               
		$('#load_menuitems').html('<img src="img/ajax-loaders/ajax-loader.gif" height="150px" style="margin:auto"/>');
		
		$('#load_menuitems').css("text-align","center");
		$('#load_menuitems').css("vertical-align","middle");
		$('#load_menuitems').css("display","flex");
                

                        
                        var request =$.ajax({
			type: "POST",
                        crossDomain : true,
                        async : false,
			url: "load_div.php",
			data: {"subid":sub_id,set:'subcategory'},
			success: function(response){

                             response=$.trim(response);
				$('#load_menuitems').css("text-align","left");
				$('#load_menuitems').css("display","inherit");
                                $('#load_menuitems').html(response);
                                
                                } 
                        
                    
		});
                        
                        
                        
                        
                        
     });
     
     
//     $('#load_subcat li').click(function () {
//		$('#portion_value').empty();
//		$('#calc_value').empty();
//		$('#pref_add').css( "display", "none" );
//		$(".prefrence_submit_buton_cc").show();
//		$('#portion_load').empty();
//		$('#quantity_val').empty();
//		$("#load_subcat>li>a.left_mn_menu_odr_focus").removeClass("left_mn_menu_odr_focus");
//		$(this).find("a").addClass('left_mn_menu_odr_focus'); 
//		var id_str   =  $("#load_subcat>li>a.left_mn_menu_odr_focus").attr("title");
//		var id_arr	  =	 id_str.split("_");
//		var sub_id       = id_arr[1];
//		$('#load_menuitems').html('<img src="img/ajax-loaders/ajax-loader.gif" height="150px" style="margin:auto"/>');
//		//$('#load_subcat').html(' <div class="loader3">Loading...</div>');
//		$('#load_menuitems').css("text-align","center");
//		$('#load_menuitems').css("vertical-align","middle");
//		$('#load_menuitems').css("display","flex");
//		$.post("load_div.php", {subid:sub_id,set:'subcategory'},
//			function(data)
//			{
//				data=$.trim(data);
//				$('#load_menuitems').css("text-align","left");
//				$('#load_menuitems').css("display","inherit");
//			    $('#load_menuitems').html(data);
//								  
//			});
//     });
//     
//     
     
	/***************************************  Sub category selection starts *************************************************  */
	
        //***************************************
        	$('#load_subcattakeaway li').click(function () {
                    //alert("ello");
		$('#portion_value').empty();
		$('#calc_value').empty();
		$('#pref_add').css( "display", "none" );
		$(".prefrence_submit_buton_cc").show();
		$('#portion_load').empty();
		$('#quantity_val').empty();
		$("#load_subcat>li>a.left_mn_menu_odr_focus").removeClass("left_mn_menu_odr_focus");
		$(this).find("a").addClass('left_mn_menu_odr_focus'); 
		var id_str   =  $("#load_subcat>li>a.left_mn_menu_odr_focus").attr("title");
		var id_arr	  =	 id_str.split("_");
		var sub_id       = id_arr[1];
		$('#load_menuitems').html('<img src="img/ajax-loaders/ajax-loader.gif" height="150px" style="margin:auto"/>');
		//$('#load_subcat').html(' <div class="loader3">Loading...</div>');
		$('#load_menuitems').css("text-align","center");
		$('#load_menuitems').css("vertical-align","middle");
		$('#load_menuitems').css("display","flex");
		$.post("load_div.php", {subid:sub_id,set:'subcategory'},
			function(data)
			{
				data=$.trim(data);
				$('#load_menuitems').css("text-align","left");
				$('#load_menuitems').css("display","inherit");
			    $('#load_menuitems').html(data);
								  
			});
     });
        //****************************************
	});
        

