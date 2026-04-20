// JavaScript Document
$(document).ready(function(){
    
    localStorage.addon_menuid='';
        $(".counter_portion_view_btn").removeClass("focussed");
        $(".counter_portion_view_btn:first").addClass("focussed");


 $(".counter_menu_popup_head_close").click(function(){
            
            
             $('.menu_sub_item1').removeClass('take_item_active');  
                        var focus_on=$('#be_search_focus').val();
                         
			$(".counter_menu_popup").css("display","none");
			$(".counter_menu_popup_overlay").css("display","none");
                         if(focus_on=='search'){
                             
                        $('#'+focus_on).focus();
                        }
                        else if(focus_on=='search_code'){
                            $('#codesrch_c').focus();
                        }else{
                              $('#search_barcode').focus();
                        }
                        $('.eachitem_counter').removeClass('active_couter_list');
                         $('#search_barcode').val('');
                        $('#codesrch_c').val('');
                  $('#'+focus_on).val('');
 });
                
	/*************************************** Popup function starts *************************************************  */
	$('.counter_popup_button').click( function(event) { 
		
                  event.stopImmediatePropagation();
		  var selval   =  $(this).attr("menuid");
                  
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
                    
			 $('.menu_sub_item').removeClass('take_item_active');  
			 $(this).find('div').addClass('take_item_active');
			 
			  
				  var request = $.ajax({
					url: "counter_popup.php",
					method: "POST",
					data: {menu:selval,typesub:'Add' },
					dataType: "html"
				  });
				   
				  request.done(function( msg ) {
                                      
                                        $('.counter_menu_popup_overlay').css("display","block"); 
		                        $('.counter_menu_popup').css("display","block"); 
					$( ".counter_menu_popup" ).html(msg);
					//$('.countergenerate').css("display","block");
                                        var rate = $('.counter_pop_portion_act').attr('rate')
                                        $('#load_portionrate').text(rate);
                                        
                                        
                                        
                                        
                                        
				  });
				  
				  data = null;
				  msg=null;
				  request.onreadystatechange = null;
				  request.abort = null;
				  request = null;
   
    });
                  
                  
    $('.md-close').click( function(event) { 
            
            
		  event.stopImmediatePropagation();
                  var focus_on=$('#be_search_focus').val();
			  $(".olddiv").removeClass("new_overlay"); 
			  $('.mynewpopupload').empty();
			  $('.mynewpopupload').css("display","none");
                          if(focus_on=='search'){
                             
                        $('#'+focus_on).focus();
                        }
                        else if(focus_on=='search_code'){
                            $('#codesrch_c').focus();
                        }else{
                              $('#search_barcode').focus();
                        }
	});
                
                
    $('.counter_pop_portion').click( function(event) {  
                     
                     var rate = $(this).attr('rate');
                     $('#load_portionrate').text(rate);
    });
                
	/***************************************  Popup function starts *************************************************  */
	/*************************************** portion click starts *************************************************  */
        
	$('.counter_pop_portion').click( function(event) {// alert('h');
		event.stopImmediatePropagation();
		var itemsact = $('.counter_pop_portion_act');	
		var actlenght=(itemsact.length);
		var items = $('.counter_pop_portion');	
		var itemlenght=(items.length);
		if($(this).hasClass('counter_pop_portion_act'))
		{
			if(actlenght!=itemlenght)
			{
			$(this).removeClass('counter_pop_portion_act');
			}
			
		}else
		{
			$('.counter_pop_portion').removeClass('counter_pop_portion_act');
			$(this).addClass('counter_pop_portion_act');	
		}
			
                        
                     var stk= $('.counter_pop_portion_act').attr("stock");
                    
                      $('#stockshow').html(stk);     
                        
                        
  });
                        
    $('#mnlentrycs').click(function(){
              
           $(".enter-qty-act").removeClass("focussed");
            $('.weight-field').removeClass("focussed");
            $('.looseweight').removeClass('enter-qty-act');
            $('#mnlentrycs').addClass("focussed");
            $('.addonqty').removeClass("focussed");
            localStorage.addon_menuid='';
              
    });   
        
    $('.counter_portion_view_btn').click(function(){
           
           var portion_or_unit=$('#portion-or-unit').val();
           var packet_or_loose=$('#packet-or-loose').val();
           //$('.enter-qty').val('');
           $('.enter-qty').removeClass('enter-qty-act');
           $('.enter-qty').removeClass('focussed');
           $('.addonqty').removeClass("focussed");
           localStorage.addon_menuid='';
           $('.looseweight').removeClass('enter-qty-act');
           $('#mnlentrycs').removeClass("focussed");
           $('.weight-field').removeClass("focussed");
          var id=$(this).attr('id');
          //alert(id);
          $('#'+id).addClass('enter-qty-act');
          $('#'+id).addClass('focussed');
          $('.enter-qty').val('');
          $('.enter-qty-act').val(0);
          $('.enter-qty-act').select();
            if(portion_or_unit=='Portion'){
                var portion_id1=id.split('_');
                var selval=portion_id1[1];
                var stock_num=$('#stock_number_'+selval).attr('stock');
            }
            else if(portion_or_unit=='Unit'){
                            
                if(packet_or_loose=='Packet'){
                    var portion_id1=id.split('-');
                    var selval=portion_id1[1];
                    //alert(selval);
                    var stock_num=$('#unit_stock_number-'+selval).attr('stock');
                    $//.post("load_div.php", {portionval:'',unitval:selval,baseunit:'',set:'portionset'});     
                }    
                
            }
          $('#stockshowcs').html(stock_num);

        });
            
        $('.looseweight').click(function(){
           
           $('.enter-qty').removeClass('enter-qty-act');
           $('.enter-qty').removeClass('focussed');
           $('.addonqty').removeClass("focussed");
           localStorage.addon_menuid='';
           $('#mnlentrycs').removeClass("focussed");
           $('.looseweight').addClass('enter-qty-act');
           $('.weight-field').addClass('focussed');
           $('.weight-field').focus();
           var weight_field_id=$('.weight-field').attr('id');
           //alert(weight_field_id);
           //$('#'+weight_field_id).addClass('focussed');
           
       }) ;                
        $('.addonqty').click(function(){
        // $('.enter-qty').removeClass('enter-qty-act');
         $('.enter-qty').removeClass('focussed');
         $('.addonqty').removeClass("focussed");
         $('#mnlentrycs').removeClass("focussed");

         $(this).addClass('focussed');
         var qtyid=$(this).attr('id').split('_');
         var addon_menuid=$.trim(qtyid[1]);
         localStorage.addon_menuid=addon_menuid;
         $('#addon_menuid').val(addon_menuid);

        });                 
                        
                        
	/***************************************  portion click starts *************************************************  */
	
	/*************************************** qty click starts *************************************************  */
	$('.caclulator_btn').click(function (){
		//alert("h");
              
        var decimal=$("#decimal").val();
	var id_str   =  $(this).attr("title");
	var id_arr	  =	 id_str.split("_");
	var selval       =  id_arr[1];
        //alert(selval);
        if(localStorage.addon_menuid==''){ 
         var portion_or_unit=$('#portion-or-unit').val();
         var packet_or_loose=$('#packet-or-loose').val();
         var stockonoff=$('#stockonoff').val();
         var oldqtynew=$('#menuqty').val(); 
         //alert(oldqtynew);
        if($('#mnlentrycs').hasClass("focussed")){
            var strg=$("#mnlentrycs").val() + 1;
        }
        else if($('.weight-field').hasClass("focussed")){
            var strg=$('.weight-field').text() + 1;
            var port_id=$(".weight-field").attr('id');
            var portion_id1=port_id.split('_');
            var port_id2=portion_id1[1];
        }
        else if($('.enter-qty-act').hasClass("focussed")){
            //alert("dgfaskg");
            if(packet_or_loose=='Packet'){
                var strg=$(".enter-qty-act").val() + 1;
                var port_id=$(".enter-qty-act").attr('id');
              var port_id=$(".enter-qty-act").attr('id'); 
              var portion_id1=port_id.split('_');
              var portion_id1=portion_id1[1];
              var portion_id2=port_id.split('-');
              var port_id2=portion_id2[1];
           }
           else{
            var strg=$(".enter-qty-act").val() + 1;
            var port_id=$(".enter-qty-act").attr('id');
            var portion_id1=port_id.split('_');
            var port_id2=portion_id1[1];
            }
        
        }
       
        var decimal=$("#decimal").val();
        
	if(strg.length>3 && ($('.enter-qty-act').hasClass("focussed")))
	{   
//            if($('.portion_view_btn').hasClass("focussed")){
            $(".loaderrpop").css("display","block");
            $(".loaderrpop").addClass("popup_validate");
            $(".loaderrpop").text("Check Quantity");
            $('.loaderrpop').delay(2000).fadeOut('slow');
            $(".enter-qty-act").val(selval); 
           // }
	}
        else if(strg.length<0)
	{ //alert("negative");
            if($('#mnlentrycs').hasClass("focussed")){
                //alert("fadbghhb");
                if($('#mnlentrycs').val()=="0"){
                    var tot=selval; 
		}
                else if($('#mnlentrycs').val()=="")
                {
                   
                    var tot="0.";
                }
                else
		{
                  if(selval=="." && !tot.includes("."))
                    {
                    var tot=$('#mnlentrycs').val();
		    }
                    else{
                        var tot=$('#mnlentrycs').val() + selval;
                    }
		}
                $('#mnlentrycs').focus();
                $('#mnlentrycs').val(tot);
            }
            if($('.enter-qty-act').hasClass("focussed")){
                if(selval!="."){
                if($(".enter-qty-act").val()==0){
                    var tot=selval; 
		}else
		{
                    var tot=$(".enter-qty-act").val() + selval;
		}
                //$('#load_portionrate').text((tot).toFixed(decimal));
                $(".enter-qty-act").text(tot);
            }
            
        }
		//$(".position_mn_cc_focus>.portion_view_btn").text(tot);
            //var id_rate   =  parseFloat($('#portionrate_'+port_id2).text());
           // var id_rates	  =	 id_rate.split("_");
            var rt       =  $('#portionrate_'+port_id2).text().replace(',','');
		
            if($('#mnlentrycs').val()==""||$('#mnlentrycs').val()=='0'){
                if($(".enter-qty-act").val()=="0")
                {
                  var totl=parseFloat(rt);  
                }else{
                    var totl=parseFloat(rt) * parseFloat($(".enter-qty-act").val());
             }
           
             } else
             {
                var totl= parseFloat($('#mnlentrycs').val())*parseFloat($(".enter-qty-act").val());
             }
            $("#load_portionrate").html(totl.toFixed(decimal));
            $.post("load_div.php", {qtyval:tot,set:'quantityset'});	
	}
	else
	{  
           if(portion_or_unit=='Portion'){
               if($('#mnlentrycs').hasClass("focussed")){
                //alert($('#rate_value').val());
                if($('#mnlentrycs').val()=="0"){
                   
                    var tot="0"+selval; 
		}
                else if(($('#mnlentrycs').val()=="") && (selval==".") )
                {
                   
                    var tot="0.";
                }
                else
		{   if(selval==".")
                    {
                    var tot=$('#mnlentrycs').val()+".";
                    
		    }
                    else{
                     //  var tot=$('#mnlentrycs').val() + selval;   
                 
                   if (window.getSelection) {
                   if(window.getSelection()!=''){
                      var tot=selval;
                   }else{
                     var tot=$('#mnlentrycs').val() + selval; 
                   }
                   }else{ 
                      var tot=$('#mnlentrycs').val() + selval;
                  }
                  
                    
                  }
                    
                }
                $('#mnlentrycs').focus();
                $('#mnlentrycs').val(tot);
                var totl= parseFloat($('#mnlentrycs').val())*parseFloat($(".enter-qty-act").val());
            }  
               else if($('.enter-qty-act').hasClass("focussed")){
                
                if(selval!="."){
                    
                if($(".enter-qty-act").val()=="0"){
                    var tot=selval; 
		}else
		{
                    var tot=$(".enter-qty-act").val() + selval;
		}
                
               if(localStorage.edit_cs=='N'){
                       $(".enter-qty-act").val('');
                       $(".enter-qty-act").val(selval);
                      var tot=selval;
                       localStorage.edit_cs='Y';
                }
                $('#load_portionrate').text(tot);
                $(".enter-qty-act").val(tot);
            }
                    if(stockonoff=='Y'){
                        
                        var newqty=$(".enter-qty-act").val();
                        //alert(newqty);
                        //alert(oldqtynew);
                        
                        if(newqty==''){
                            newqty=0;
                        }
                        if(oldqtynew==0){
                            if(newqty.length==1){
                                var stock_in_total=$('#stockshowcs').text();
                            }
                            else if(newqty.length==2){
                                var stock_in_total=parseFloat(newqty[0])+parseFloat($('#stockshowcs').text());
                            }
                            else if(newqty.length==3){
                                var prevqty=newqty[0]+newqty[1];
                                var stock_in_total=parseFloat(prevqty)+parseFloat($('#stockshowcs').text());
                            }
                        }
                        else{
                            var stock_in_total=$('#stock_number_'+port_id2).attr('stock');
                        }
                        if(parseFloat(newqty)<=parseFloat(stock_in_total)){
                            $('#stockshowcs').text(parseFloat(stock_in_total-newqty));
                        }
                        else{
                            $('#stockshowcs').text(0);
                            $(".loaderrpop").css("display","block"); 
                            //$(".loaderrpop").addClass("popup_validate");
                            $(".loaderrpop").text('Only '+stock_in_total+' in Stock');
                            $('.loaderrpop').delay(2000).fadeOut('slow');
                        }
                    }
            } 
               var rt       =  $('#portionrate_'+port_id2).text().replace(',','');
            
            if($('#mnlentrycs').val()==""||$('#mnlentrycs').val()=='0'){
                if($('#load_portionrate').text()=="0")
                {
                  var totl=parseFloat(rt);  
                }else{
            var totl=parseFloat(rt) * parseFloat($(".enter-qty-act").val());
             }
         } else
             {
                var totl= parseFloat($('#mnlentrycs').val())*parseFloat($(".enter-qty-act").val());
             }  
                
            $("#load_portionrate").html(totl.toFixed(decimal));
            }
            else if(portion_or_unit=='Unit'){
                if(packet_or_loose=='Packet'){
                    if($('#mnlentrycs').hasClass("focussed")){
                    //alert($('#rate_value').val());
                    if($('#mnlentrycs').val()=="0"){
                   
                        var tot="0"+selval; 
                    }
                    else if(($('#mnlentrycs').val()=="") && (selval==".") )
                    {
                   
                        var tot="0.";
                    }
                    else
                    {   
                        if(selval=="."){
                            var tot=$('#mnlentrycs').val()+".";
                    
                        }
                        else{
                            //var tot=$('#mnlentrycs').val() + selval;
                            
                    if (window.getSelection) {
                   if(window.getSelection()!=''){
                      var tot=selval;
                   }else{
                     var tot=$('#mnlentrycs').val() + selval; 
                   }
                   }else{ 
                      var tot=$('#mnlentrycs').val() + selval;
                  }
                            
                        }
                    }
                    $('#mnlentrycs').focus();
                    $('#mnlentrycs').val(tot);
                    var totl= parseFloat($('#mnlentrycs').val())*parseFloat($(".enter-qty-act").val());
                } 
                else if($('.enter-qty-act').hasClass("focussed")){
                
                if(selval!="."){
                    
                if($(".enter-qty-act").val()=="0"){
                    var tot=selval; 
		}else
		{
                    var tot=$(".enter-qty-act").val() + selval;
		}
                //$('#load_portionrate').text(tot);
                
                if(localStorage.edit_cs=='N'){
                       $(".enter-qty-act").val('');
                       $(".enter-qty-act").val(selval);
                      var tot=selval;
                       localStorage.edit_cs='Y';
                }
                
                $(".enter-qty-act").val(tot);
            }
            if(stockonoff=='Y'){
                
                var newqty=$(".enter-qty-act").val();
                //alert(newqty);
                //alert(oldqtynew);
                if(newqty==''){
                    newqty=0;
                }
                if(oldqtynew==0){
                    if(newqty.length==1){
                    var stock_in_total=$('#stockshowcs').text();
                }
                else if(newqty.length==2){
                    var stock_in_total=parseFloat(newqty[0])+parseFloat($('#stockshowcs').text());
                }
                else if(newqty.length==3){
                    var prevqty=newqty[0]+newqty[1];
                    var stock_in_total=parseFloat(prevqty)+parseFloat($('#stockshowcs').text());
                }
            }
            else{
                var stock_in_total=$('#unit_stock_number-'+port_id2).attr('stock');
            }
            if(parseFloat(newqty)<=parseFloat(stock_in_total)){
                $('#stockshowcs').text(parseFloat(stock_in_total-newqty));
            }
            else{
                $('#stockshowcs').text(0);
                $(".loaderrpop").css("display","block"); 
                //$(".loaderrpop").addClass("popup_validate");
                $(".loaderrpop").text('Only '+stock_in_total+' in Stock');
                $('.loaderrpop').delay(2000).fadeOut('slow');
            }
        }
            } 
                var rt       =  $('#unitrate-'+port_id2).text().replace(',','');
                //alert(port_id2);
                //alert(rt);
                var totl=parseFloat(rt) * parseFloat($(".enter-qty-act").val());
                    $('#load_packetrate').text((totl).toFixed(decimal));
                }
                else if(packet_or_loose=='Loose'){
                    
                   
                   
                    if($('#mnlentrycs').hasClass("focussed")){
                    //alert($('#rate_value').val());
                    if($('#mnlentrycs').val()=="0"){
                   
                        var tot="0"+selval; 
                    }
                    else if(($('#mnlentrycs').val()=="") && (selval==".") )
                    {
                   
                        var tot="0.";
                    }
                    else
                    {   
                        if(selval=="."){
                            var tot=$('#mnlentrycs').val()+".";
                    
                        }
                        else{
                           // var tot=$('#mnlentrycs').val() + selval;
                           
                            if (window.getSelection) {
                   if(window.getSelection()!=''){
                      var tot=selval;
                   }else{
                     var tot=$('#mnlentrycs').val() + selval; 
                   }
                   }else{ 
                      var tot=$('#mnlentrycs').val() + selval;
                  }
                        }
                    }
                    $('#mnlentrycs').focus();
                    $('#mnlentrycs').val(tot);
                    var totl= parseFloat($('#mnlentrycs').val())*parseFloat($(".enter-qty-act").val());
                } 
                    
                    
                    
                    
                    if($('.weight-field').hasClass("focussed")){
                
                if($('.weight-field').text().includes('.')){
                    //alert('1');
                   var weightvalue=$('.weight-field').text().split('.');
                   //alert(weightvalue[1].length);
                   //alert($('.baseunitweight').text());
                   if(weightvalue[1].length<3){
                   if(selval=="."){
                       tot=$('.weight-field').text();
                   }
                   else{
                       tot=$('.weight-field').text() + selval;
                   }
                    }
                    else{
                        tot=$('.weight-field').text();
                    }
                }
                else{
                  if($('.weight-field').text().length<4){  
                if($('.weight-field').text()=="0"){
                   
                    var tot="0"+selval; 
		}
                else if(($('.weight-field').text()=="") && (selval=="."))
                {   
                   var tot="0.";
                    
                }
                else{
                        var tot=$('.weight-field').text() + selval;
                    }
                }
                else
		{   if(selval==".")
                    {
                    var tot=$('.weight-field').text()+".";
                    
		    }
                    else{
                        
                        var tot=$('.weight-field').text();
                    }
                    
                }
                
                //var totl= parseFloat($('#rate_value').val())*parseFloat($(".enter-qty-act").val());
            }
           //$('.weight-field').focus();
                $('.weight-field').text(tot);
             }
                if($('.enter-qty-act').hasClass("focussed")){
                
                if(selval!="."){
                    
                if($(".enter-qty-act").val()=="0"){
                    var tot=selval; 
		}else
		{
                    var tot=$(".enter-qty-act").val() + selval;
		}
                //$('#load_portionrate').text(tot);
                
                if(localStorage.edit_cs=='N'){
                       $(".enter-qty-act").val('');
                       $(".enter-qty-act").val(selval);
                      var tot=selval;
                       localStorage.edit_cs='Y';
                }
                
                
                $(".enter-qty-act").val(tot);
            }
            }
            
                    var looserate=$('#load_looserate').text().split('=');
                    var rt       =  parseFloat(looserate[1].replace(',',''));
                    //alert(rt);
                    var looseqty=$('.weight-field').text();
                    if(looseqty==''){
                        looseqty=1;
                    }
                    //alert(rt);
                    //alert($('#baseunitqty_'+port_id2).val());
                    //alert(looseqty);
                    var totl=parseFloat(rt) * parseFloat($('#baseunitqty_'+port_id2).val())* parseFloat(looseqty);
                    //alert(totl);
                    $('#baseunitrate_'+port_id2).text((totl).toFixed(decimal));
                    
                    
                }
                
            }
            
            //$.post("load_div.php", {qtyval:tot,set:'quantityset'});	
	}
        }
        else{
            if($("#addonqty_"+localStorage.addon_menuid).val().length<=2){
            if(selval!="."){
                    
                if($("#addonqty_"+localStorage.addon_menuid).val()==""){
                var tot=selval; 
                }else
                {
                    var tot=$("#addonqty_"+localStorage.addon_menuid).val() + selval;
                }
                $("#addonqty_"+localStorage.addon_menuid).val(tot)
                var addon_menutotal=parseFloat(tot)*parseFloat($("#addonrate_"+localStorage.addon_menuid).text());
                $("#addontotal_"+localStorage.addon_menuid).text(addon_menutotal.toFixed(decimal));
                
            }
            }
            else{
                $(".loaderrpop").css("display","block");
                $(".loaderrpop").addClass("popup_validate");
                $(".loaderrpop").text("Check Quantity");
                $('.loaderrpop').delay(2000).fadeOut('slow');
            }
        }
    });
        $('#clear_calc').click(function () {
            if(localStorage.addon_menuid==''){
            var portion_or_unit=$('#portion-or-unit').val();
            var packet_or_loose=$('#packet-or-loose').val();
                  var decimal=$("#decimal").val();   
                    
		var s=0;
                var rthh=$('#ratehid').val();
            
                if($('#mnlentrycs').hasClass("focussed")){
                        $('#mnlentrycs').val('');
               }else{
              
              if($('.enter-qty-act').hasClass("focussed")){
                  
           if(packet_or_loose=='Packet'){
                var port_id=$(".enter-qty-act").attr('id'); 
                var portion_id1=port_id.split('-');
                var portion_id1=portion_id1[1];
                var portion_id2=port_id.split('_');
                var stockonoff=$('#stockonoff').val();
                if(stockonoff=="Y")  {  
          
                var stock_num=$('#unit_stock_number-'+portion_id1).attr('stock');
                //alert(stock_num);
                $('#stockshowcs').html(stock_num);
            }
           }
           else{
                var port_id=$(".enter-qty-act").attr('id');
                var portion_id1=port_id.split('_');
                var portionid1=portion_id1[1];
                var stockonoff=$('#stockonoff').val();
                if(stockonoff=="Y")  {  
          
                var stock_num=$('#stock_number_'+portionid1).attr('stock');
                //alert(stock_num);
                $('#stockshowcs').html(stock_num);
                if(packet_or_loose=='Loose'){
                    var stock_num=$('#baseunit_stock_number_'+portionid1).attr('stock');
                //alert(stock_num);
                $('#stockshowcs').html(stock_num);
                }
                else{
                    var stock_num=$('#stock_number_'+portionid1).attr('stock');
                //alert(stock_num);
                $('#stockshowcs').html(stock_num);
                }
            }
       
        }
        }   
               
                if(portion_or_unit=='Portion')
                {    
                    
                    $(".enter-qty-act").val('');
                    $(".enter-qty-act").focus();
                    if($('#mnlentrycs').hasClass("focussed")){
                    $('#mnlentrycs').val('');
                    }
                     $("#load_portionrate").text((0).toFixed(decimal));
                }
                if(portion_or_unit=='Unit' && packet_or_loose=='Loose' )
                {
                    var looserate=$('#load_looserate').text().split('=');
                    var rt       =  parseFloat(looserate[1]);
                    
                    $('.weight-field').text('');
                    $(".enter-qty").val('');
                    $('.baseunitrate').text((rt).toFixed(decimal));
                }
                else if(portion_or_unit=='Unit' && packet_or_loose=='Packet' )
                {
                    $(".enter-qty-act").val('');
                    $(".enter-qty-act").focus();
                    if($('#mnlentrycs').hasClass("focussed")){
                         
                    $('#mnlentrycs').val('');
                    }
                    $('#load_packetrate').text((0).toFixed(decimal));
                }
            }
            
            }
            else{
               $("#addonqty_"+localStorage.addon_menuid).val('');
               $("#addontotal_"+localStorage.addon_menuid).text(''); 
            }    
            
            
            
	});
       
        
/*************************************** qty click starts *************************************************  */
  $("span[contenteditable]").on("keydown", function (e) {
    if (e.key === "Enter") {
        e.preventDefault();

        var text = $(this).text().trim();
        
        if($('.weight-field').text()>0){
          $('.countersale_addnew').click();
        } 
        
    }
    });     


  $('.countersale_addnew').click( function(event) {
      
        var mn  =  $('#idofmenu').val(); 
        
        var p_l=$('#packet-or-loose').val();
        
        if(p_l=='Loose'){
         
           var qty_stk=$('#baseunitqty_1').val();
         
           var wgt_stk1=$('#baseunitweight_1').text();
         
        }else{
         
           var qty_stk=$('.enter-qty-act').val();
          
           var wgt_stk1=$('#unitweight-1').text();
          
        }
        
        var wgt_stk=(wgt_stk1*qty_stk);
         
        var mode_in=$('#typesub').val();
        
        
        var qt_old=$(".enter-qty-act").val(); 
         
        var dataString1 = 'set=check_plus_cart_stock&menuid='+mn+"&qty="+qty_stk+"&weight="+wgt_stk+"&mode=cs&type=popup&mode_in="+mode_in;
        
	var request=  $.ajax({
	type: "POST",
	url: "load_index.php",
	data: dataString1,
	success: function(data) { 
          
          $(".enter-qty-act").val(qt_old); 
          
           // alert(data);
            
            if($.trim(data)=='OK'){ 
       
      
            var serialno=$('#serialno').val();
            var portion_or_unit='';
            var packet_or_loose='';
            var unitweight='';
            var baseunitweight='';
            var unitid='';
            var baseunitid='';
            var portion_or_unit=$('#portion-or-unit').val();
            var packet_or_loose=$('#packet-or-loose').val();
            var preferncetext='';
            var por='';
            
        if($('.weight-field').hasClass("focussed")){
            
            var port_id=$(".weight-field").attr('id');
            var portion_id1=port_id.split('_');
            var portionid1=portion_id1[1];
            
        }else if($('#mnlentrycs').hasClass("focussed")){
            
           if(packet_or_loose=='Packet'){
               
              var port_id=$(".enter-qty-act").attr('id'); 
              var portion_id1=port_id.split('-');
              var portion_id1=portion_id1[1];
              var portion_id2=port_id.split('_');
              var stock_num=$('#unit_stock_number-'+portion_id1).attr('stock');
           }
           else{
               
            var port_id=$(".enter-qty-act").attr('id');
            var portion_id1=port_id.split('_');
            var portionid1=portion_id1[1];
            if(portion_or_unit=='Portion'){
                
                var stock_num=$('#stock_number_'+portionid1).attr('stock');
            }
            }
            
        }
        else {
            
           if(packet_or_loose=='Packet'){
               
              var port_id=$(".enter-qty-act").attr('id'); 
              var portion_id1=port_id.split('-');
              var portion_id1=portion_id1[1];
              var portion_id2=port_id.split('_');
              var stock_num=$('#unit_stock_number-'+portion_id1).attr('stock');
           }
           else{
               
            var port_id=$(".enter-qty-act").attr('id');
            var portion_id1=port_id.split('_');
            var portionid1=portion_id1[1];
            if(portion_or_unit=='Portion'){
                
                var stock_num=$('#stock_number_'+portionid1).attr('stock');
                
            }
            }
            
        }
         
        
        
            var focus_on=$('#be_search_focus').val();
            
            if(focus_on=='search'){
                
                $('#'+focus_on).focus();
                $('#codesrch_c').val('');
                $('#'+focus_on).val('');
                $('#search_barcode').val('');
            }
            else if(focus_on=='search_code'){
                
                $('#codesrch_c').focus();
                $('#codesrch_c').val('');
                $('#'+focus_on).val('');
                $('#search_barcode').val('');
            } 
            else{
                
                $('#search_barcode').focus();
                $('#codesrch_c').val('');
                $('#'+focus_on).val('');
            }
            
            
           
            var stk2= parseFloat($('#stockshowcs').text());
            
            var qty5=$('.enter-qty-act').val();
            if(qty5==''){
                
                qty5=0;
            }
            
            var stockonoff=$('#stockonoff').val();
            
            
              ///daily stock check////////      
           
            if(stockonoff=="Y"){    
                
                
            if(parseFloat(stock_num)>=parseFloat(qty5)){
                
                var typesub=$('#typesub').val();
		var menuid   =  $('#idofmenu').val(); 
		var portion=$('.counter_pop_portion_act').attr("title");
		var rate='';
                var order_from = 'CS';
                var manualrate_val=$('#manualrate').val();
                var preferncetext=$('.prefrtext').val();
                
                
                if(portion_or_unit=='Portion'){
                    
			var rate=$('#portionrate_'+portionid1).text().replace(',','');
                        var qty=$('.enter-qty-act').val();
                        var por=portionid1;
                       
                        if(manualrate_val=='Y'){
                            var rate=$('#mnlentrycs').val();
                            
                        }
                        else{
                            var rate=$('#portionrate_'+portionid1).text().replace(',','');
                        }
                        
                        
                }else if(portion_or_unit=='Unit'){
                    
                    
                if(packet_or_loose=='Packet'){
                        
                        
                                var qty=$('.enter-qty-act').val();
                                var unitweight=$('#unitweight-'+portion_id1).text();
                                var unitid=portion_id2[1];
                                
                        if(manualrate_val=='Y'){
                                     
                                var rate=$('#mnlentrycs').val();
                            
                        }else{
                                var rate=$('#unitrate-'+portion_id1).text().replace(',','');
                        }  
                                
                    }else if(packet_or_loose=='Loose'){
                               
                                var qty=$('#baseunitqty_'+portionid1).val();
                                var baseunitweight=$('#baseunitweight_'+portionid1).text();
                                var baseunitid=portionid1;
                                var looserate=$('#load_looserate').text().split('=');
                                
                        if(manualrate_val=='Y'){
                            
                               var rate=$('#mnlentrycs').val();
                            
                        }else{
                                var rate  =  parseFloat(looserate[1].replace(',',''))*parseFloat(baseunitweight);
                            }
                    }
                }
                
                        if(rate <=0  || rate <=0||rate=='')
			{   
                            $(".loaderrpop").css("display","block"); 
                            $(".loaderrpop").addClass("popup_validate");
                            $(".loaderrpop").text('Add rate..');
                            $('.loaderrpop').delay(2000).fadeOut('slow');
                        }
                        else if(qty<=0 || qty==''){
                            
                            $(".loaderrpop").css("display","block"); 
                            $(".loaderrpop").addClass("popup_validate");
                            $(".loaderrpop").text('Add quantity..');
                            $('.loaderrpop').delay(2000).fadeOut('slow');
                        }
                        else if(packet_or_loose=="Loose" &&  (baseunitweight==0 || baseunitweight=="")){
                            
                            $(".loaderrpop").css("display","block"); 
                            $(".loaderrpop").addClass("popup_validate");
                            $(".loaderrpop").text("Add Weight");
                            $('.loaderrpop').delay(2000).fadeOut('slow');
                        }
                        else{    
                            
                            
                            $('.countersale_addnew').css('pointer-events','none');
                            
                            var addon=new Array();
                                if($('.addo_each_menu_div').is(':visible')) {
                                   $(".addo_each_menu_div").each(function() {
                                       var addon_menuid=$(this).find('.addonmenu').attr('id').split('_');
                                       var addon_menurate=parseFloat($(this).find('#addonrate_'+$.trim(addon_menuid[1])).text().replace(',',''));
                                       var addon_menuqty=$(this).find('#addonqty_'+$.trim(addon_menuid[1])).val();
                                       var addon_menu_slno=$(this).find('.addonmenu').attr('addon_slo');                                   

                                       if(addon_menuqty>0){
                                         addon.push({
                                            'menu_id':$.trim(addon_menuid[1]),
                                            'menu_rate':addon_menurate,
                                            'menu_qty':addon_menuqty,
                                            'menu_slno' :addon_menu_slno
                                          });
                                      }
                                    });
                                    
                                 var addon1=JSON.stringify(addon);

                                }
                                
                                
                                ////pref manual/////
                                
                                var pref_manual_multi=new Array();
                                
                                if($('#load_manual_pref').is(':visible')) {
                                    
                                $(".manual_pref_qty").each(function() {
                                       
                                        var pref_id=$(this).attr('prefs');
                                      
                                       var pref_qty=$(this).val();
                                       
                                       var pref_name=$(this).attr('prefname');
                                              
                                       if(pref_qty>=0){
                                           
                                         pref_manual_multi.push({
                                            'pref_id':pref_id,
                                            
                                            'pref_qty':pref_qty,
                                           
                                            'pref_name':pref_name
                                           
                                          });
                                      }
                                    });
                                    
                                 var pref_ids=JSON.stringify(pref_manual_multi);

                                }
                                ///end///
                               if (/,/.test(rate)) {
                                    
                                  rate = rate.replace(',','');
                                  
                                }else{
                                    
                                  rate = rate;  
                                    
                                }
                                
				var dataString;
				dataString = 'value=menusubmission&menuid='+menuid+"&portion="+por+"&rate="+rate+"&qty="+qty+"&preferncetext="+
                                        preferncetext+"&mode="+ typesub+"&order_from="+order_from+"&ratetype="+portion_or_unit+"&unittype="+
                                        packet_or_loose+"&unitweight="+unitweight+"&baseunitweight="+baseunitweight+"&unitid="+unitid+
                                        "&baseunitid="+baseunitid+"&serialno="+serialno+"&addon="+addon1+"&pref_ids="+pref_ids+"&manualrate_val="+
                                        manualrate_val;
				//alert(dataString);
                                $.ajax({
				type: "POST",
				url: "load_counter_sales.php",
				data: dataString,
				success: function(data) {
                                    
					data=$.trim(data);
                                        
					if(data=="ok")
					{
						$('.enter-qty-act').val('0');
						
						$('.ta_errormsg').css("display",'block');
                                                $('.ta_errormsg').text("ITEM ADDED");
                                                $('.ta_errormsg').delay(1500).fadeOut('slow');
                                                $('.counter_portion_view_btn').text('');
                                                $('.enter-qty').val('');
						$('#search').val('');
						$('.counter_menu_popup_overlay').css("display","none"); 
		  				$('.counter_menu_popup').css("display","none"); 
						
						var dataString1;
						dataString1 = 'value=loaditemsorderd';
						var request=  $.ajax({
						type: "POST",
						url: "load_counter_sales.php",
						data: dataString1,
						success: function(data) {
                                                    
								$('.listorderditems').html(data);
								if(typesub=="Edit")
								{
								//$('tbody').find("[menuid='"+menuid+"']").addClass('active_couter_list');
								}
                                                                
								var coutrgen=$('#counter_gen').val();
								var coutrstafgen=$('#counter_staff_gen').val();
                                                                
								if(coutrgen=='Y' && coutrstafgen=='Y')
								{
								//$('.genonly').css("display","block");
								}
                                                                
                                                                $('.genonly').css("display","block");
								$('.gensettl').css("display","block");
								var coutrhld=$('#counter_hold').val();
								var coutrstafhld=$('#counter_staff_hold').val();
                                                                
								if(coutrhld=='Y' && coutrstafhld=='Y')
								{
								 $('.holdorders').css("display","block");
								}
								 
								
							}
						});
						$.ajaxSetup({cache: false});
						dataString1=null;
						data = null;
						request.onreadystatechange = null;
						request.abort = null;
						request = null;
						
						
						
					}
					
					}
				});
                            }
                        
			
                        
                        var focus_on=$('#be_search_focus').val();
                        
                         if(focus_on=='search'){
                             
                        $('#'+focus_on).focus();
                        }
                        else if(focus_on=='search_code'){
                            $('#codesrch_c').focus();
                        }else{
                              $('#search_barcode').focus();
                        }
                }
                else{
                    
                if(stk2!=0){
                    
                         var popup_addrate1="Only "+stk2+" In Stock";
                
                }else{
                    
                         var popup_addrate1="Out of Stock";   
                
                }
				$(".loaderrpop").css("display","block"); 
				$(".loaderrpop").text(popup_addrate1);
				$('.loaderrpop').delay(2000).fadeOut('slow');
            }
            
        }else{
            
            
            var typesub=$('#typesub').val();
            
            var menuid   =  $('#idofmenu').val(); 
            
            var rate='';
            var order_from = 'CS';
            var manualrate_val=$('#manualrate').val();
            var preferncetext=$('.prefrtext').val();
            
            if(portion_or_unit=='Portion'){
                
			var rate=$('#portionrate_'+portionid1).text().replace(',','');
                        var qty=$('.enter-qty-act').val();
                        var por=portionid1;
                        
                        if(manualrate_val=='Y'){
                            
                               var rate=$('#mnlentrycs').val();
                            
                        }
                        else{
                               var rate=$('#portionrate_'+portionid1).text().replace(',','');
                        }
                        
                    }else if(portion_or_unit=='Unit'){
                        
                        
                     if(packet_or_loose=='Packet'){
                         
                                var qty=$('.enter-qty-act').val();
                                var unitweight=$('#unitweight-'+portion_id1).text();
                                var unitid=portion_id2[1];
                                
                        if(manualrate_val=='Y'){
                            
                                var rate=$('#mnlentrycs').val();
                            
                         }else{
                             
                                var rate=$('#unitrate-'+portion_id1).text().replace(',','');
                        }
                        
                }else if(packet_or_loose=='Loose'){
                    
                                
                                var qty=$('#baseunitqty_'+portionid1).val();
                                var baseunitweight=$('#baseunitweight_'+portionid1).text();
                                var baseunitid=portionid1;
                                var looserate=$('#load_looserate').text().split('=');
                                
                        if(manualrate_val=='Y'){
                            
                            var rate=$('#mnlentrycs').val();
                            
                        }else{
                            
                                var rate       =  parseFloat(looserate[1].replace(',',''))*parseFloat(baseunitweight);
                        }
                }
            }
                
                        if(rate <=0  || rate <=0||rate=='')
			{   
                            $(".loaderrpop").css("display","block"); 
                            $(".loaderrpop").addClass("popup_validate");
                            $(".loaderrpop").text('Add rate..');
                            $('.loaderrpop').delay(2000).fadeOut('slow');
                        }
                        else if(qty<=0 || qty==''){
                            
                            $(".loaderrpop").css("display","block"); 
                            $(".loaderrpop").addClass("popup_validate");
                            $(".loaderrpop").text('Add quantity..');
                            $('.loaderrpop').delay(2000).fadeOut('slow');
                            $('.enter-qty-act').focus();
                        }
                        else if(packet_or_loose=="Loose" &&  (baseunitweight==0 || baseunitweight=="")){
                            
                            $(".loaderrpop").css("display","block"); 
                            $(".loaderrpop").addClass("popup_validate");
                            $(".loaderrpop").text("Add Weight");
                            $('.loaderrpop').delay(2000).fadeOut('slow');
                             $('.enter-qty-act').focus();
                        }
            
                        else{       
                            
                            
                             $('.countersale_addnew').css('pointer-events','none');
                             var addon=new Array();
                                if($('.addo_each_menu_div').is(':visible')) {
                                   $(".addo_each_menu_div").each(function() {
                                       var addon_menuid=$(this).find('.addonmenu').attr('id').split('_');
                                       var addon_menurate=parseFloat($(this).find('#addonrate_'+$.trim(addon_menuid[1])).text().replace(',',''));
                                       var addon_menuqty=$(this).find('#addonqty_'+$.trim(addon_menuid[1])).val();
                                       var addon_menu_slno=$(this).find('.addonmenu').attr('addon_slo');                                  

                                       if(addon_menuqty>0){
                                         addon.push({
                                            'menu_id':$.trim(addon_menuid[1]),
                                            'menu_rate':addon_menurate,
                                            'menu_qty':addon_menuqty,
                                            'menu_slno' :addon_menu_slno
                                          });
                                      }
                                    });
                                 var addon1=JSON.stringify(addon);

                                }
                                
                                  ////pref manual/////
                                
                                var pref_manual_multi=new Array();
                                
                                if($('#load_manual_pref').is(':visible')) {
                                    
                                   $(".manual_pref_qty").each(function() {
                                       
                                       
                                       var pref_id=$(this).attr('prefs');
                                      
                                       var pref_qty=$(this).val();
                                                
                                       var pref_name=$(this).attr('prefname');
                                              
                                       if(pref_qty>=0){
                                           
                                         pref_manual_multi.push({
                                            'pref_id':pref_id,
                                            
                                            'pref_qty':pref_qty,
                                           
                                            'pref_name':pref_name
                                           
                                          });
                                      }
                                      
                                    });
                                    
                                 var pref_ids=JSON.stringify(pref_manual_multi);

                                }
                                
                                ///end///
                                if (/,/.test(rate)) {
                                    
                                  rate = rate.replace(',','');
                                  
                                }else{
                                    
                                  rate = rate;  
                                    
                                }
                               
				var dataString;
				dataString = 'value=menusubmission&menuid='+menuid+"&portion="+por+"&rate="+rate+"&qty="+qty+"&preferncetext="+
                                        preferncetext+"&mode="+ typesub+"&order_from="+order_from+"&ratetype="+portion_or_unit+"&unittype="+
                                        packet_or_loose+"&unitweight="+unitweight+"&baseunitweight="+baseunitweight+"&unitid="+unitid+
                                        "&baseunitid="+baseunitid+"&serialno="+serialno+"&addon="+addon1+"&pref_ids="+pref_ids+"&manualrate_val="+
                                manualrate_val;
				//alert(dataString);
                                $.ajax({
				type: "POST",
				url: "load_counter_sales.php",
				data: dataString,
				success: function(data) { 
					data=$.trim(data);
					if(data=="ok")
					{
                                           
                                            
                                                $('.menu_sub_item1').removeClass('take_item_active');  
                                             
						$('.enter-qty-act').val('0');
						
						$('.ta_errormsg').css("display",'block');
                                                $('.ta_errormsg').text("ITEM ADDED");
                                                $('.ta_errormsg').delay(1500).fadeOut('slow');
                                                $('.counter_portion_view_btn').text('');
						$('#search').val('');
						$('.counter_menu_popup_overlay').css("display","none"); 
		  				$('.counter_menu_popup').css("display","none"); 
						
						var dataString1;
						dataString1 = 'value=loaditemsorderd';
						var request=  $.ajax({
						type: "POST",
						url: "load_counter_sales.php",
						data: dataString1,
						success: function(data) {
                                                    
								$('.listorderditems').html(data);
                                                                
								if(typesub=="Edit")
								{
								
								}
								var coutrgen=$('#counter_gen').val();
								var coutrstafgen=$('#counter_staff_gen').val();
								if(coutrgen=='Y' && coutrstafgen=='Y')
								{
								
								}
                                                                $('.genonly').css("display","block");
								$('.gensettl').css("display","block");
								var coutrhld=$('#counter_hold').val();
								var coutrstafhld=$('#counter_staff_hold').val();
								if(coutrhld=='Y' && coutrstafhld=='Y')
								{
								$('.holdorders').css("display","block");
								}
								 
								
							}
						});
						$.ajaxSetup({cache: false});
						dataString1=null;
						data = null;
						request.onreadystatechange = null;
						request.abort = null;
						request = null;
						
					}
						
					}
				});
                            }
                        }
		
                
                
                if($('.enter-qty')>0){
                    
                         var focus_on=$('#be_search_focus').val();
                         
                         if(focus_on=='search'){
                             
                           $('#'+focus_on).focus();
                        }
                        else if(focus_on=='search_code'){
                               $('#codesrch_c').focus();
                        }else{
                               $('#search_barcode').focus();
                        }
                    
            }
 
 
   }else{
                        $('.alert_error_popup_all_in_one').show();
                        
                        $('.alert_error_popup_all_in_one').css('z-index', '9999999');
                        
                        $('.alert_error_popup_all_in_one').text('NO STOCK IN INVENTORY');
                       
                        $('.alert_error_popup_all_in_one').delay(1000).fadeOut('slow');  
            
  }
                          
  }
  }); 
 
 
		
 });
                
	/*******************  qty click starts ********************  */
        
});
		
function IsNumeric_rate(strString)
{
  var strValidChars = "0123456789 .";
  var strChar;
  var blnResult = true;
  if (strString.length == 0) {return false;}
 /*var a= strString.length;
  if(strString.length<10 || strString.length>13 )
  {
	
   return false;
  }
*/
  for (i = 0; i < strString.length && blnResult == true; i++)
     {
     strChar = strString.charAt(i);
     if (strValidChars.indexOf(strChar) == -1)
        {
       	blnResult = false;
        }
     }
  return blnResult;
  
}

function IsNumeric(strString)
{
  var strValidChars = "0123456789 ";
  var strChar;
  var blnResult = true;
  if (strString.length == 0) {return false;}
 /*var a= strString.length;
  if(strString.length<10 || strString.length>13 )
  {
	
   return false;
  }
*/
  for (i = 0; i < strString.length && blnResult == true; i++)
     {
     strChar = strString.charAt(i);
     if (strValidChars.indexOf(strChar) == -1)
        {
       	blnResult = false;
        }
     }
  return blnResult;
  
}

function ratecalculation(prtnid){
  
   var qty_test=$('#portionqty_'+prtnid).val(); 
      var result  = /^[0-9]+$/.test(qty_test);
      if(!result){
       $('#portionqty_'+prtnid).val($.trim($('#portionqty_'+prtnid).val()).slice(0, -1));
      }
  
  
            var decimal=$("#decimal").val();
             var portion_rate='';
            var quantity=$('#portionqty_'+prtnid).val();
          
            if($('#mnlentrycs').attr('manualrate')=='Y'){
               
               if($('#mnlentrycs').val()!=''){
                  
                 portion_rate=$('#mnlentrycs').val();
                }
            else{
              
                portion_rate=0;
                }
            }
            else if($('#mnlentrycs').attr('manualrate')=='N'){
                
                 portion_rate=$('#portionrate_'+prtnid).text().replace(',','');
            }
            
            var total_rate=parseFloat(quantity)*parseFloat(portion_rate);
          
           if(quantity!="" && quantity>0){
            $('#load_portionrate').text((total_rate).toFixed(decimal));
        }else{
            $('#load_portionrate').text((0).toFixed(decimal)); 
        }
            
        }