// JavaScript Document

$(document).ready(function(){
    
    if($("#check_kot_count").val()>0){
        $("#kot_cancel_pop_btn").show();
    }else{
        $("#kot_cancel_pop_btn").hide();
    }
    
    
    
     localStorage.clickcount=0;
    
	/***************************************  menu category height starts *************************************************  */
	if($('#submenu').innerHeight() <=51)
	  {
		  $('.left_cantainer').addClass('main_div_dyc');
	  }else
	  {
		  if($('.left_cantainer').hasClass('main_div_dyc'))
		  {
			  $('.left_cantainer').removeClass('main_div_dyc')
		  }
	  }
	/***************************************  menu category height ends *************************************************  */
	
	/***************************************  scroller starts *************************************************  */
	document.documentElement.style.overflow = 'hidden';
	var nice = $("html").niceScroll({horizrailenabled:false});  // The document page (body)
	$("#div1").html($("#div1").html()+' '+nice.version);
	/***************************************  scroller starts *************************************************  */
	
	/***************************************  Drop down 1 starts *************************************************  */
	$('.menu').fancySelect().on('change', function() {
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
	/***************************************  Drop down 1 starts *************************************************  */
	
	/***************************************  Drop down 1 starts *************************************************  */
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
	/***************************************  Drop down 1 starts *************************************************  */


 $(".clear_all_di").unbind().click(function(){
     
     var order_all_chk = $('.total_itemcount').text();
   
     if(order_all_chk>0){
        
     var confirm1=confirm("Clear items which aren't confirmed ? ");
     
     if(confirm1===true){
     
     var order_all = $(this).attr("orderno_del_all");
    
                        $.ajax({
			type: "POST",
			url: "itemedit.php",
			data: { order_all : order_all,set_delete_all:'delete_all_di'},
			success: function(response){
                            
                                   $(".loaderror").css("display","block");
				   $(".loaderror").addClass("popup_validate");
				   $(".loaderror").text('Deleted');
                                   $('.loaderror').delay(1500).fadeOut('slow');
				 
				   $('.ordelist_table').css("display","block");
				   $('.ordelist_table').load('viewitems.php');

                    }
                    });
                    
     }     
     }else{
     
                        $('.alert_error_popup_all_in_one').show();
                        $('.alert_error_popup_all_in_one').text('No Items to Delete');
                        $('.alert_error_popup_all_in_one').delay(1000).fadeOut('slow');
    }         
 });





	/*************************************** Delete each  starts *************************************************  */
        
        
        
        
    $(".menu_order_delet_btn").click(function(){
             
             
          var linkId = $(this).attr("id").replace("myid", "");
	  var slno = $(this).attr("p").replace("tab", "");   
          
           var mid = $(this).attr("mid");   
             
     var notchk =  $('.comp_bill:checkbox:not(":checked")').length;
     
     var chk=$('.comp_bill:checkbox:checked').length;
     
     var chk_single=$("#comp_bill_"+mid+'_'+slno+':checkbox:checked').length;
     
     var notchk_single=$("#comp_bill_"+mid+'_'+slno+':checkbox:not(":checked")').length; 
 
 
   
     if(notchk>1  || $('.comp_bill').length==0 || chk_single==1 ||  (notchk_single==1 && chk==0)  ){  
                
                
		 var request =$.ajax({
			type: "POST",
			url: "itemedit.php",
			data: { linkId : linkId,sl:slno,set:'del'},
			success: function(response){
                            
                                  var ordermsg3 = ($("#ordermsg3").val());
                                  $('.ordelist_table').load('viewitems.php');
                             
				  $('.cd-panel').addClass('is-visible');
				  $('#disable').removeClass('disable_cls');
				  $('#disable1').removeClass('disable_cls1');
				  $('#disable2').removeClass('disable_cls');
				  $('#dis_sub').removeClass('disable_style_1');
				  $('#dis_cat').removeClass('disable_style_1');
				  $('#dis_item').removeClass('disable_style_2');
				  $('.ordelist_table').css("display","block");
				 
				  $(".loaderror").css("display","block");
				  $(".loaderror").addClass("popup_validate");
				  $(".loaderror").text(ordermsg3);
				  $('.loaderror').delay(2000).fadeOut('slow');
			}
		});	
		data=null;
		response=null;
		request.onreadystatechange = null;
		request.abort = null;
		request = null;
                
                
            }else{
              
             //$("#comp_bill_"+linkId+'_'+slno).attr('checked',false);
                 
             alert('ONE ITEM SHOULD BE THERE FOR BILL PRINT WITH RATE ');
             
            }  
	});	   
	/***************************************  Delete each  starts *************************************************  */
	
        
	/*************************************** category selection  starts *************************************************  */
        
    $('.category_selection li').click(function (event) {
            
		event.stopImmediatePropagation();
                
                var mainlang=$('#mainlanguage').val();
                var dateopen=$('#dayopendate').val();
                var listimage=$('#listimage').val();
                var floorid=$('#floorid').val();
                var apilink=$('#menuapilink').val();
                
	  $('#load_subcat').empty();
	  $('#load_menuitems').empty();
	  $('#portion_value').empty();
	  $('#calc_value').empty();
	  $('#pref_add').css( "display", "none" );
	  $(".prefrence_submit_buton_cc").show();
	  $('#portion_load').empty();
	  $('#quantity_val').empty();
	  $(".category_selection>li>a.left_main_menu_items_focus").removeClass("left_main_menu_items_focus");
          $(this).find("a").addClass('left_main_menu_items_focus'); 
          
	  var id_str   =  $(".category_selection>li>a.left_main_menu_items_focus").attr("title");
	  var id_arr	  =	 id_str.split("_");
	  var cat_id       = id_arr[1];
          
	  $('#load_subcat').html('<img src="img/ajax-loaders/ajax-loader.gif" height="70px" style="margin:auto"  />');
	  
	  $('#load_subcat').css("vertical-align","middle");
	  $('#load_subcat').css("display","flex");
	
	    var request =$.ajax({
			type: "POST",
                          crossDomain : true,
                        async : false,
			url: "load_div.php",
			data: {catid:cat_id,set:'category'},
			success: function(response){
				
                                response=$.trim(response);

				$('#load_subcat').html(response);

                    }

		});
                
		data = null;
		res=null;
		request.onreadystatechange = null;
		request.abort = null;
		request = null;  
		  
	  $('#load_menuitems').html('<img src="img/ajax-loaders/ajax-loader.gif" height="150px" style="margin:auto" />');
	 
	  $('#load_menuitems').css("text-align","center");
	  $('#load_menuitems').css("vertical-align","middle");
	  $('#load_menuitems').css("display","flex");
	 

                        var request =$.ajax({
			type: "POST",
                         crossDomain : true,
                        async : false,
			url: "load_div.php",
			data: {subid:'',cat_id:cat_id,set:'subcategory'},
			success: function(response){
				
                                response=$.trim(response);
				$('#load_menuitems').css("text-align","left");
				$('#load_menuitems').css("display","inherit");
				$('#load_menuitems').html(response);
                        }
		});


		data = null;
		response=null;
		request.onreadystatechange = null;
		request.abort = null;
		request = null; 	  
  });
	/***************************************  category selection  starts *************************************************  */
	
	
        /***********************************COMBO EDIT CLICK STARTS **************************************************/
            
            $('.combo_added_sec').click(function(){
                
                if(sessionStorage.clickdisable_dine!=1){
                    
                    var status=$(this).find('.menu_order_dishname_cc').attr('status');
                    var id=$(this).find('.menu_order_dishname_cc').attr('id');
                    var parent_div_id=$(this).attr('id');
                    var sts=status.trim();
                    var combo_pack_id=$(this).find('.menu_order_dishname_cc').attr('combo_pack_id');
                    var combo_pack_qty=$(this).find('.menu_order_dishname_cc').attr('combo_pack_qty');
                    var combo_preference;
                    localStorage.cod_count_combo_ordering=$(this).find('.menu_order_dishname_cc').attr('cod_count_combo_ordering');
                    var dataString = 'set=load_combo_ordering_popup_for_edit&combo_pack_id='+combo_pack_id+"&combo_pack_qty="+combo_pack_qty;
                         $.ajax({
                             type: "POST",
                             url: "combo_ordering_popup.php",
                             data: dataString,
                             success: function(data) {
                                 $("#combo_ordering_popup").css('display','block');
                                 $("#combo_ordering_popup").html(data);
                                 $('.qty_minus_btn').hide();
                                 $('.qty_plus_btn').hide();
                                 $('.option_checkboxes').prop('disabled',true);
                                 $('.option_checkboxes').prop('checked',false);
                                  $('.option_menu_qty_display').val(0);
                                 $('.cart_menu_list[id1='+parent_div_id+']').each(function(){
                                     var menuid=$(this).attr('menuid');
                                     var menuqty=$(this).attr('menuqty');
                                     var menutype=$(this).attr('menu_type');

                                     combo_preference=$('.cart_menu_preference[id1='+parent_div_id+']').text();

                                     if($('.menu_selection_check[value1='+menuid+']')){
                                         $('.menu_selection_check[value1='+menuid+']').prop('checked',true);
                                         $('.menu_qty_display[value1='+menuid+']').val(menuqty);

                                     }
                                     if(menutype=='Option'){
                                        if($('.option_checkboxes[value1='+menuid+']')){
                                         $('.option_checkboxes[value1='+menuid+']').prop('checked',true);
                                         $('.option_menu_qty_display[value1='+menuid+']').val(menuqty);

                                         } 
                                     }

                                 });

                                 $('#manual_preference').val(combo_preference);
                                 localStorage.combo_preference=$.trim(combo_preference,',');
    //                                $.each($.trim(combo_preference,',').split(","), function(i,e){
    //                                    //alert(e);
    //                                    $("#combo_preference[value='" + e + "']").prop("selected", true);
    //                                });
                                 $('#combo_qty_select').val(combo_pack_qty);
                                 $('#combo_qty_select').focus();
                             }
                        });
                }     
            });
    /***********************************COMBO EDIT CLICK ENDS **************************************************/
    
    /*************************************** edit click starts *************************************************  */
    
   $('.menu_order_dishname_cc').click(function () {
                
                localStorage.edit_di='N';
            
                if(!$(this).hasClass('combo_menu_div')){
                   
                    var status=$(this).attr('status');
                    var sts=status.trim();

                    var menuid   =  $(this).attr('menu');
                    var slno       =$(this).attr('slno');
                    var pt45=$(this).attr('portion123');

                    var type= "edit";

                   // }
                   if(sts=='Added')
                   { 
                       
                   $('.mynewpopupload').css("display","block"); 
                   $(".olddiv").addClass("new_overlay");
                   var dataString = '';
                   var request=  $.ajax({
                       type: "POST",
                       url: "load_popupmenu.php",
                       data:{menuid:menuid,type:'edit',slno:slno,pt:pt45},
                       success: function(data) {

                        $('.mynewpopupload').html(data);
                       }
                 });	} 
            }
             });
             
             
    $('.md-close').click( function(event) {  
        
		          event.stopImmediatePropagation();	
			  $(".olddiv").removeClass("new_overlay"); 
			  $('.mynewpopupload').empty();
			  $('.mynewpopupload').css("display","none");
    });
       
	/***************************************  edit each starts *************************************************  */
	
	/*************************************** Click ok on edit starts *************************************************  */
	$('.updatealledit').click(function () {	
            
            
		var editmsg=$('#hideditedmsg').val(); 
		var menu   =  $(this).attr("menusid");
		var menuval	  =	 menu.split("_");
		var menuvalue       =  menuval[1];
		var ss   =  $(this).attr("sl");
		var ssl	  =	 ss.split("_");
		var sln       =  ssl[1];
		var qty=$('#qtytextedit'+menuvalue+sln).val();
		var rate=$('#rate_value_edit'+menuvalue+sln).val();//alert(rate)
		if(rate=='')
		  {
			 $(".loaderror").css("display","block");
			$(".loaderror").addClass("popup_validate");
			$(".loaderror").text("Check Rate...");
			$('.loaderror').delay(2000).fadeOut('slow'); 
		  }else
			  {
			  if(qty=="" || qty==0)
			  {
				  $(".loaderror").css("display","block");
				  $(".loaderror").addClass("popup_validate");
				  $(".loaderror").text("Check quantity...");
				  $('.loaderror').delay(2000).fadeOut('slow');
			  }else
			  {	
				  $(this).closest('.preference_table').removeClass('odr_1_active');
				  $('.cd-panel').addClass('is-visible');
				  $('#disable').removeClass('disable_cls');
				  $('#disable1').removeClass('disable_cls1');
				  $('#disable2').removeClass('disable_cls');
				  $('#dis_sub').removeClass('disable_style_1');
				  $('#dis_cat').removeClass('disable_style_1');
				  $('#dis_item').removeClass('disable_style_2');
				  $('#portion_value').empty();
				  $('#calc_value').empty();
				  $('#portion_load').empty();
				  $('#quantity_val').empty();
				  $('.quantity_txt').css("display","block");
				  $('.qtytextedit').css("display","none");
				  $('.viewprefall').css("display","block");
				  $('.editpref').css("display","none");
				  $.post("load_div.php", {qtyval:qty,set:'quantityset'});
				  $.post("load_div.php", {rateval:rate,set:'rateset'});	
				  $.post("load_div.php", {menu:menuvalue,set:'setmenuids'});	
				  var prefv=$('#menu_'+menuvalue+sln).val();
				  var preft=$('#preftext'+menuvalue+sln).val();
				  if(prefv=="")
				  {
					  prefv=0;
				  }
				  if(preft=="")
				  {
					  preft=0;
				  }//alert(prefv+"sdfsd"+preft)
				  //$.post("load_div.php", {selectval:prefv,textval:preft,set:'preferenceset'});	
				  
				  var data = {
						  "set": "preferenceset",
						  "selectval" :prefv,
						  "textval": preft
						};
						data = $(this).serialize() + "&" + $.param(data);
					 var request= $.ajax({
						  type: "POST",
						  dataType: "text",
						  url: "load_div.php", 
						  data: data,
						  success: function(data) {
							 // var res=data.trim();
						 	//alert(res);
							  
						  }
						});
					  
					  	data = null;
						request.onreadystatechange = null;
						request.abort = null;
						request = null;
						
					var data1 = {
						  "action": "edit",
						  "tableid" :document.getElementById("table_id").value,
						  "floorid": document.getElementById("floor_id").value,
						  "stewardid" : document.getElementById("steward_id").value,
						  "orderid": document.getElementById("order_id").value,
						  "branchid" :document.getElementById("branch_id").value,
						  "preftext":preft,
						  "prefvalue" :prefv,
						  "qty":qty,
						  "slno":sln
						};
						data1 = $(this).serialize() + "&" + $.param(data1);//alert(data1)
					var request=	$.ajax({
						  type: "POST",
						  url: "response.php", 
						  data: data1,
						  success: function(datas) {
							 // alert(datas)
							  $('.ordelist_table').css("display","block");
							  $('.ordelist_table').load('viewitems.php');
							  $(".loaderror").css("display","block");
							  $(".loaderror").addClass("popup_validate");
							  $(".loaderror").text(editmsg);
							  $('.loaderror').delay(2000).fadeOut('slow');
						  }
						});
						data = null;
						request.onreadystatechange = null;
						request.abort = null;
						request = null;
			  }
		  }
     });
	/***************************************   Click ok on edit starts *************************************************  */

	/*************************************** Back to table selection starts *************************************************  */
        
	$('#backtotablesel').unbind().click(function () {
            
                 // alert('bcktowww');
             
		 if($('.preference_table').find('div').hasClass('menu_order_confirm_btn') || $('.preference_table').find('div').hasClass('menu_order_confirm_yellow_btn') || $('.preference_table').find('div').hasClass('menu_order_delet_btn'))
		 { 
			 $.post("load_div.php", {set:'backto'},
			function(data)
			{
			data=$.trim(data);
			
			window.location="table_selection.php";
                        
			});
		 }else
		 {
                        
			$.post("load_div.php", {set:'chkresrvd'},
			function(data)
			{
			data=$.trim(data);//alert(data);
			window.location="table_selection.php";
			});	
		 }
                  
 	 });
	/***************************************  Back to table selection starts *************************************************  */
	
	/*************************************** kotno print starts *************************************************  */
        
	 $('.kotnolist').click(function () {
            
           var kot_reprint_staff=$('#kot_reprint_staff').val();
           
           if(kot_reprint_staff == 'Y'){ 
            
		var printmsg=$('#hidprintconfrmmsg').val();
		$('.closeoneclass').css('display','block');
		$('.confrmation_overlay').css('display','block');
		$('.contentmessage').html(printmsg);
		var kotid=($(this).attr("kotid")).trim();
		$('#hidkotid').val(kotid);
                
                 $('.kotconfirmpopup').css('display','none');   
                 $('.kotconfirmpopup_cancel').css('display','none');   
                 // $('#kotfailmsg').html(data);
                 $(".confrmation_overlay").css("display","block");
                 $('.kotconfirmpopup_reprint').css('display','none');   
                 $('.confrmation_overlay').css('display','none');   
		 $('.confrmation_overlay').css('display','block'); 
             }else{
                 
                $(".loaderror").css("display","block");
		$(".loaderror").addClass("popup_validate");
		$(".loaderror").text('No Permission To Reprint');
		$('.loaderror').delay(2000).fadeOut('slow');
             }
 	 });
	/***************************************  kotno print starts *************************************************  */
	
	 /*************************************** kot print ok click starts ******************************************************************  */
         
    $('.confirmkotok_reprint').click(function () {
            
             var msg=$('#kotfailmsg_reprint').html();
          
             var dataString_log ='set_log=kotconfirmbylogin&failmsg='+msg;
             $.ajax({
             type: "POST",
             url: "menu_order.php",
             data: dataString_log,
             success: function(data) {
             
             }
             });
            
            
	        var printmsg=$('#hidprintmsg').val();
		$('.closeoneclass').css('display','none');
		$('.confrmation_overlay').css('display','none');
		var kotid=$('#hidkotid').val();
		 //alert(kotid)
		/*$.post("print_details.php", {kot:kotid,set:'kotprint'},
			function(data)
			{
			data=$.trim(data);
			//alert(data)
			$('.ordelist_table').load('viewitems.php');
			});	*/
			var data1 = {
				"set": "kotprint",
				"kot" :kotid
			  };
			  data1 = $(this).serialize() + "&" + $.param(data1);
			var request=	$.ajax({
				type: "POST",
				url: "print_details.php", 
				data: data1,
				success: function(datas) {
				  
					$('.ordelist_table').css("display","block");
					$('.ordelist_table').load('viewitems.php');
					$(".loaderror").css("display","block");
					$(".loaderror").addClass("popup_validate");
					$(".loaderror").text(printmsg);
					$('.loaderror').delay(2000).fadeOut('slow');
				}
			  });
			  data1 = null;
                          $.post("print_details.php", {set:'console'});
			  datas = null;
			  request.onreadystatechange = null;
			  request.abort = null;
			  request = null;
			
		          $('#hidkotid').val('');
        });
       
         
    $('.confirmkotclose_reprint').click(function () {
        
                  $('.kotconfirmpopup_reprint').css('display','none');   
                  $('.confrmation_overlay').css('display','none');  
                  $('.closeoneclass').css('display','none');
		  $('.confrmation_overlay').css('display','none');
                 
    });
             
         
         
   $('.closeok').click(function (event) {
       
        event.stopImmediatePropagation();
        var floor=$('#floor_id').val();
        var order=$('#order_id').val();
        var kotid=$('#hidkotid').val();
        // alert(floor);
        // alert(order);
        // alert(kotid);
        var KOT_reprint = "kot_reprint";
            
            $.post("printercheck_1.php", {type:KOT_reprint,floor:floor,order:order,kotno:kotid},
                                               
            function(data)
            { 
                
            data=$.trim(data); 
            
            $(".olddiv").removeClass("new_overlay");
            if(data !='')
            { 
                                            
              $('.kotconfirmpopup_reprint').css('display','block');   
              $('#kotfailmsg_reprint').html(data);
              $(".confrmation_overlay").css("display","block");
               
           
   		                                             
            }else{
       
               var kot_no=$('#hidkotid').val();
          
//             var dataString_log ='set_log_reprint=log_reprint&kotno='+kot_no;
//             $.ajax({
//             type: "POST",
//             url: "printercheck_1.php",
//             data: dataString_log,
//             success: function(data) {
//             alert(data);
//             }
//             });
       
       
      
	        var printmsg=$('#hidprintmsg').val();
		$('.closeoneclass').css('display','none');
		$('.confrmation_overlay').css('display','none');
		var kotid=$('#hidkotid').val();
			
			var data1 = {
				"set": "kotprint",
				"kot" :kotid
			  };
			  data1 = $(this).serialize() + "&" + $.param(data1);
			var request=	$.ajax({
				type: "POST",
				url: "print_details.php", 
				data: data1,
				success: function(datas) {
				   // alert(datas)
					$('.ordelist_table').css("display","block");
					$('.ordelist_table').load('viewitems.php');
					$(".loaderror").css("display","block");
					$(".loaderror").addClass("popup_validate");
					$(".loaderror").text(printmsg);
					$('.loaderror').delay(2000).fadeOut('slow');
				}
			  });
			  data1 = null;
                          $.post("print_details.php", {set:'console'});
			  datas = null;
			  request.onreadystatechange = null;
			  request.abort = null;
			  request = null;
			
			
		$('#hidkotid').val('');
            }
        });
	});
	 /*************************************** cancel ok click ends ******************************************************************  */
	
	
	  /*************************************** kot print close click starts ******************************************************************  */
   $('.closecancel').click(function () {
		$('.closeoneclass').css('display','none');
		$('.confrmation_overlay').css('display','none');
		$('#hidkotid').val('');
	
	});
	 /*************************************** cancel close click ends ******************************************************************  */
	
    	
    $('#combo_display_click').click(function(){
        
        $(this).addClass('combo_module_active');
        var floor_id=$('#floor_id').val();
        
        $('#load_subcat').empty();
        $('.category_selection>li>a').removeClass('left_main_menu_items_focus');
        var dataString = 'set=load_combos&floor_id='+floor_id; 
        
        $.ajax({
            type: "POST",
            url: "load_div.php",
            data: dataString,
            success: function(data) { 
               $('#load_subcat').html(data);
               //$('#load_menuitems').empty();
               var combo_name_id=$('.combo_name_selection_click').attr('combo_name_id');
              
               var dataString = 'set=load_combo_menus&combo_name_id='+combo_name_id+"&floor_id="+floor_id;
               
                $.ajax({
                    type: "POST",
                    url: "load_div.php",
                    data: dataString,
                    success: function(data) {
                     
                       $('#load_menuitems').html(data);     
                    }
                });
            }
        });
        
        
       $('.mct').css('display','block');
       $('.cct').css('display','none');
        
       $('#submenu').html('');     
        
    });
    
    
    
     $('.maincat_click').click(function(){
         
       location.reload();
         
     });
    
    
    
    $('.combo_name_selection_click').click(function(){
        
        $('.combo_name_selection_click').removeClass('left_mn_menu_odr_focus');
        $(this).addClass('category-menu-active');
        //$('#load_menuitems').empty();
        var combo_name_id=$(this).attr('combo_name_id');
        var floor_id=$('#floor_id').val();
        
        var dataString = 'set=load_combo_menus&combo_name_id='+combo_name_id+"&floor_id="+floor_id; 
    //    alert(dataString);
        $.ajax({
            type: "POST",
            url: "load_div.php",
            data: dataString,
            success: function(data) {
                $('#load_menuitems').html(data);     
            }
        });
    });
});
$(document).keyup(function(e){
     e.preventDefault();
    if (e.keyCode == 27) {
        if($('.kot_cancel_popup_cc:visible').length == 1)
            {   
                 $('.kot_cancel_popup_cc').css("display","none");
                 $(".olddiv").removeClass("new_overlay");
                //$(".new_overlay").css("display","none");
            }
        if($('.kotcancel_reason_popup_new:visible').length == 1)
            {   
                 $('.kotcancel_reason_popup_new').css("display","none");
                 //$(".olddiv").removeClass("new_overlay");
                 $("#kot_cancel_pop_btn").click();
                //$(".new_overlay").css("display","none");
            }    
            
    } 
});

function load_combo_ordering_popup(combo_pack_id) {
        
        localStorage.cod_count_combo_ordering='';
        //alert(localStorage.cod_count_combo_ordering);
        var dataString = 'set=load_combo_ordering_popup&combo_pack_id='+combo_pack_id;
        $.ajax({
            type: "POST",
            url: "combo_ordering_popup.php",
            data: dataString,
            success: function(data) {
                $("#combo_ordering_popup").css('display','block');
                $("#combo_ordering_popup").html(data);     
            }
        });
        
    };
function combo_pack_delete_from_cart(cod_count_combo_ordering,combo_qty,combo_pack_id,combo_stock_check){
    //alert(order_id);
    //alert(combo_pack_id);
   
    //alert(combo_stock_check);
     sessionStorage.clickdisable_dine=1;
    $('.preferance_table_btn').css('pointer-events', 'none');
    var dataString = 'set=combo_pack_delete_from_cart&cod_count_combo_ordering='+cod_count_combo_ordering+"&combo_qty="+combo_qty+"&combo_pack_id="+combo_pack_id+"&combo_stock_check="+combo_stock_check;
        $.ajax({
            type: "POST",
            url: "load_div.php",
            data: dataString,
            success: function(data) {
                $('.ordelist_table').css("display","block");
                $('.ordelist_table').load('viewitems.php');
                 sessionStorage.clickdisable_dine=0;
                $(".loaderror").css("display", "block");
                $(".loaderror").addClass("popup_validate");
                $(".loaderror").text("Deleted...");
                $('.loaderror').delay(2000).fadeOut('slow');
                return true; 
            }
        });
}    