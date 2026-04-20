// JavaScript Document
$(document).ready(function(){
    
    
    
      localStorage.addon_menuid='';
      $(".counter_portion_view_btn").removeClass("focussed");
      $(".counter_portion_view_btn:first").addClass("focussed");

		
		/*************************************** Popup function starts *************************************************  */
	$('.takeaway_popup_button').click( function(event) { //alert('hula');
		
            
                $(".counter_portion_view_btn").addClass("focussed");
                event.stopImmediatePropagation();
		  var selval   =  $(this).attr("menuid");
                  var food= $('.online_order_box_act').attr('food_val');
               
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
               
               
                  
               var dataString = 'set=check_food_partner_ta&menuid='+selval+"&food="+food;
		//alert(dataString);		
                                $.ajax({
				type: "POST",
				url: "load_takeaway.php",
				data: dataString,
				success: function(data1) {
					data1=$.trim(data1);
					if(data1=="yes")
					{
 
			 $('.menu_sub_item').removeClass('take_item_active');  
			 $(this).find('div').addClass('take_item_active');
			 
			  
                          
				  var request = $.ajax({
					url: "takeaway_popup.php",
					method: "POST",
					data: {menu:selval,typesub:'Add',food:food },
					dataType: "html"
				  });
				   
				  request.done(function( msg ) {//alert(msg);
                                       $(".confrmation_overlay").css("display","block");
		  $('.bottom_edit_cc_popup').css("display","block"); 
                                      
					$( ".bottom_edit_cc_popup" ).html( msg );
					//$('.countergenerate').css("display","block");
                                        var rate = $('.add_popup_active_btn').attr('rate')
                                         $('#load_portionrate').text(rate);
				  });
				  
				  data = null;
					msg=null;
				  request.onreadystatechange = null;
				  request.abort = null;
				  request = null;
                                     }else{
                                         $('.online_pop_show').show();
    $('#load_partners').html('NO MENU RATE FOR SELECTED ONLINE PARTNER ');
     $('.clear_all_ok_ta_online').hide();
     $('.exit_online').css('display','inline-block');
                                     }
                                    }
                                });
		  });
	$(".td-close").click(function(){
			 $('.eachitem_counter').removeClass('takeaway_contant_tr_active');
                        event.stopImmediatePropagation();
                        var focus_on=$('#be_search_focus').val();
                
                        $(".olddiv").removeClass("new_overlay"); 
                        $(".confrmation_overlay").css("display","none");
                        $('.bottom_edit_cc_popup').css("display","none"); 
                        if(focus_on=='search'){
                        $('#'+focus_on).focus();
                        }
                        else{
                            $('#codesrch_c').focus();
                        }
		});
	/***************************************  Popup function starts *************************************************  */
	/*************************************** portion click starts *************************************************  */
	$('.take_away_popup_left_portion_contant').click( function(event) { //alert('0h');
		event.stopImmediatePropagation();
		var itemsact = $('.add_popup_active_btn');	
		var actlenght=(itemsact.length);
		var items = $('.take_away_popup_left_portion_contant');	
		var itemlenght=(items.length);
                
                var rate = $(this).attr('rate');
                $('#load_portionrate').text(rate);
		if($(this).hasClass('add_popup_active_btn'))
		{
                    
			if(actlenght!=itemlenght)
			{
			$(this).removeClass('add_popup_active_btn');
			}
			
		}else
		{
			$('.take_away_popup_left_portion_contant').removeClass('add_popup_active_btn');
			$(this).addClass('add_popup_active_btn');	
		}
			
                        
                        var stk= $('.add_popup_active_btn').attr("stock");
                    
                      $('#stockshow').html(stk);    
                        
                        
                        
			});
                        
                        
        $('#manlrate123').click(function(){
            
            $(".enter-qty-act").removeClass("focussed");
            $('.weight-field').removeClass("focussed");
            $('.looseweight').removeClass('enter-qty-act');
            $('.addonqty').removeClass("focussed");
            localStorage.addon_menuid='';
            $('#manlrate123').addClass("focussed");  
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
           $('#manlrate123').removeClass("focussed");
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
          $('#stockshow').html(stock_num);

        });
            
        $('.looseweight').click(function(){
           
                $('.enter-qty').removeClass('enter-qty-act');
                $('.enter-qty').removeClass('focussed');
                $('.addonqty').removeClass("focussed");
                localStorage.addon_menuid='';
                $('#manlrate123').removeClass("focussed");
                $('.looseweight').addClass('enter-qty-act');
                $('.weight-field').addClass('focussed');
                $('.weight-field').focus();
                var weight_field_id=$('.weight-field').attr('id');
                //alert(weight_field_id);
                //$('#'+weight_field_id).addClass('focussed');
        });
        
        
        $('.addonqty').click(function(){
        // $('.enter-qty').removeClass('enter-qty-act');
        $('.enter-qty').removeClass('focussed');
        $('.addonqty').removeClass("focussed");
        $('#manlrate123').removeClass("focussed");
        
        $(this).addClass('focussed');
        var qtyid=$(this).attr('id').split('_');
        var addon_menuid=$.trim(qtyid[1]);
        localStorage.addon_menuid=addon_menuid;
        $('#addon_menuid').val(addon_menuid);
        
    }); 
                        
	/***************************************  portion click starts *************************************************  */
	
	/*************************************** qty click starts *************************************************  */
	 $('.caclulator_btn').click( function(event) {
         
	var id_str   =  $(this).attr("title");
	var id_arr	  =	 id_str.split("_");
	var selval       =  id_arr[1];
        if(localStorage.addon_menuid==''){     
        var portion_or_unit=$('#portion-or-unit').val();
        var packet_or_loose=$('#packet-or-loose').val();
        var stockonoff=$('#stockonoff').val();
        var oldqtynew=$('#menuqty').val(); 
        //alert(oldqtynew);
        if($('#manlrate123').hasClass("focussed")){
            var strg=$("#manlrate123").val() + 1;
        }
        else if($('.weight-field').hasClass("focussed")){
            var strg=$('.weight-field').text() + 1;
            var port_id=$(".weight-field").attr('id');
            var portion_id1=port_id.split('_');
            var port_id2=portion_id1[1];
        }
        else if($('.enter-qty-act').hasClass("focussed")){
            
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
	}else if(strg.length<0)
	{ //alert("negative");
            if($('#manlrate123').hasClass("focussed")){
                //alert("fadbghhb");
                if($('#manlrate123').val()=="0"){
                    var tot=selval; 
		}
                else if($('#manlrate123').val()=="")
                {
                   
                    var tot="0.";
                }
                else
		{
                  if(selval=="." && !tot.includes("."))
                    {
                    var tot=$('#manlrate123').val();
		    }
                    else{
                        var tot=$('#manlrate123').val() + selval;
                    }
		}
                $('#manlrate123').focus();
                $('#manlrate123').val(tot);
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
		
            if($('#manlrate123').val()==""||$('#manlrate123').val()=='0'){
                if($(".enter-qty-act").val()=="0")
                {
                  var totl=parseFloat(rt);  
                }else{
                    var totl=parseFloat(rt) * parseFloat($(".enter-qty-act").val());
             }
           
             } else
             {
                var totl= parseFloat($('#manlrate123').val())*parseFloat($(".enter-qty-act").val());
             }
            $("#load_portionrate").html(totl.toFixed(decimal));
            //$.post("load_div.php", {qtyval:tot,set:'quantityset'});	
	}
	else
	{  
           if(portion_or_unit=='Portion'){
               if($('#manlrate123').hasClass("focussed")){
                //alert($('#rate_value').val());
                if($('#manlrate123').val()=="0"){
                   
                    var tot="0"+selval; 
		}
                else if(($('#manlrate123').val()=="") && (selval==".") )
                {
                   
                    var tot="0.";
                }
                else
		{   if(selval==".")
                    {
                    var tot=$('#manlrate123').val()+".";
                    
		    }
                    else{
                        //var tot=$('#manlrate123').val() + selval;
                         if (window.getSelection) {
                   if(window.getSelection()!=''){
                      var tot=selval;
                   }else{
                     var tot=$('#manlrate123').val() + selval; 
                   }
                   }else{ 
                      var tot=$('#manlrate123').val() + selval;
                  }
                        
                    }
                }
                $('#manlrate123').focus();
                $('#manlrate123').val(tot);
                var totl= parseFloat($('#manlrate123').val())*parseFloat($(".enter-qty-act").val());
            }  
               else if($('.enter-qty-act').hasClass("focussed")){
                
                if(selval!="."){
                    
                if($(".enter-qty-act").val()=="0"){
                    var tot=selval; 
		}else
		{
                    var tot=$(".enter-qty-act").val() + selval;
		}
                
                if(localStorage.edit_ta=='N'){
                       $(".enter-qty-act").val('');
                       $(".enter-qty-act").val(selval);
                      var tot=selval;
                       localStorage.edit_ta='Y';
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
                        //alert(oldqtynew);
                        if(oldqtynew==0){
                            if(newqty.length==1){
                                var stock_in_total=$('#stockshow').text();
                            }
                            else if(newqty.length==2){
                                var stock_in_total=parseFloat(newqty[0])+parseFloat($('#stockshow').text());
                            }
                            else if(newqty.length==3){
                                var prevqty=newqty[0]+newqty[1];
                                var stock_in_total=parseFloat(prevqty)+parseFloat($('#stockshow').text());
                            }
                        }
                        else{
                            var stock_in_total=$('#stock_number_'+port_id2).attr('stock');
                        }
                        //alert(stock_in_total);
                        if(parseFloat(newqty)<=parseFloat(stock_in_total)){
                            $('#stockshow').text(parseFloat(stock_in_total-newqty));
                        }
                        else{
                            $('#stockshow').text(0);
                            $(".loaderrpop").css("display","block"); 
                            //$(".loaderrpop").addClass("popup_validate");
                            $(".loaderrpop").text('Only '+stock_in_total+' in Stock');
                            $('.loaderrpop').delay(2000).fadeOut('slow');
                        }
                    }
            } 
               var rt       =  $('#portionrate_'+port_id2).text().replace(',','');
            
            if($('#manlrate123').val()==""||$('#manlrate123').val()=='0'){
                if($('#load_portionrate').text()=="0")
                {
                  var totl=parseFloat(rt);  
                }else{
            var totl=parseFloat(rt) * parseFloat($(".enter-qty-act").val());
             }
         } else
             {
                var totl= parseFloat($('#manlrate123').val())*parseFloat($(".enter-qty-act").val());
             }  
                
            $("#load_portionrate").html(totl.toFixed(decimal));
            }
            else if(portion_or_unit=='Unit'){
                if(packet_or_loose=='Packet'){
                   if($('#manlrate123').hasClass("focussed")){
                    //alert($('#rate_value').val());
                    if($('#manlrate123').val()=="0"){
                   
                        var tot="0"+selval; 
                    }
                    else if(($('#manlrate123').val()=="") && (selval==".") )
                    {
                   
                        var tot="0.";
                    }
                    else
                    {   
                        if(selval=="."){
                            var tot=$('#manlrate123').val()+".";
                    
                        }
                        else{
                            //var tot=$('#manlrate123').val() + selval;
                            
                            if (window.getSelection) {
                   if(window.getSelection()!=''){
                      var tot=selval;
                   }else{
                     var tot=$('#manlrate123').val() + selval; 
                   }
                   }else{ 
                      var tot=$('#manlrate123').val() + selval;
                  }
                        }
                    }
                    
                    $('#manlrate123').focus();
                    $('#manlrate123').val(tot);
                    var totl= parseFloat($('#manlrate123').val())*parseFloat($(".enter-qty-act").val());
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
                
                if(localStorage.edit_ta=='N'){
                       $(".enter-qty-act").val('');
                       $(".enter-qty-act").val(selval);
                      var tot=selval;
                       localStorage.edit_ta='Y';
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
                    var stock_in_total=$('#stockshow').text();
                }
                else if(newqty.length==2){
                    var stock_in_total=parseFloat(newqty[0])+parseFloat($('#stockshow').text());
                }
                else if(newqty.length==3){
                    var prevqty=newqty[0]+newqty[1];
                    var stock_in_total=parseFloat(prevqty)+parseFloat($('#stockshow').text());
                }
            }
            else{
                var stock_in_total=$('#unit_stock_number-'+port_id2).attr('stock');
            }
            if(parseFloat(newqty)<=parseFloat(stock_in_total)){
                $('#stockshow').text(parseFloat(stock_in_total-newqty));
            }
            else{
                $('#stockshow').text(0);
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
                    
                    
                     if($('#manlrate123').hasClass("focussed")){
                    //alert($('#rate_value').val());
                    if($('#manlrate123').val()=="0"){
                   
                        var tot="0"+selval; 
                    }
                    else if(($('#manlrate123').val()=="") && (selval==".") )
                    {
                   
                        var tot="0.";
                    }
                    else
                    {   
                        if(selval=="."){
                            var tot=$('#manlrate123').val()+".";
                    
                        }
                        else{
                            //var tot=$('#manlrate123').val() + selval;
                            if (window.getSelection) {
                   if(window.getSelection()!=''){
                      var tot=selval;
                   }else{
                     var tot=$('#manlrate123').val() + selval; 
                   }
                   }else{ 
                      var tot=$('#manlrate123').val() + selval;
                  }
                        }
                    }
                    $('#manlrate123').focus();
                    $('#manlrate123').val(tot);
                    var totl= parseFloat($('#manlrate123').val())*parseFloat($(".enter-qty-act").val());
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
                
                if(localStorage.edit_ta=='N'){
                       $(".enter-qty-act").val('');
                       $(".enter-qty-act").val(selval);
                      var tot=selval;
                       localStorage.edit_ta='Y';
                }
                $(".enter-qty-act").val(tot);
            }
            }
            
                    var looserate=$('#load_looserate').text().split('=');
                    var rt       =  looserate[1].replace(',','');
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
                $(".loaderrpop").text("Check the Quantity");
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
                //alert(rthh);
              
               if($('#manlrate123').hasClass("focussed")){
                   
                      $('#manlrate123').val('');
                      
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
                $('#stockshow').html(stock_num);
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
                $('#stockshow').html(stock_num);
                if(packet_or_loose=='Loose'){
                    var stock_num=$('#baseunit_stock_number_'+portionid1).attr('stock');
                //alert(stock_num);
                $('#stockshow').html(stock_num);
                }
                else{
                    var stock_num=$('#stock_number_'+portionid1).attr('stock');
                //alert(stock_num);
                $('#stockshow').html(stock_num);
                }
            }
       
        }
        }   
               
                if(portion_or_unit=='Portion')
                {    
                    
                    $(".enter-qty-act").val('');
                    $(".enter-qty-act").focus();
                    if($('#manlrate123').hasClass("focussed")){
                    $('#manlrate123').val('');
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
                    if($('#manlrate123').hasClass("focussed")){
                         
                    $('#manlrate123').val('');
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
                                
    $("span[contenteditable]").on("keydown", function (e) {
    if (e.key === "Enter") {
        e.preventDefault();

        var text = $(this).text().trim();
        
        if($('.weight-field').text()>0){
          $('.tasale_addnew').click();
        } 
        
    }
    });                         
     /********************  qty click starts *****************  */
        
    /********** qty click starts *********************  */

    $('.tasale_addnew').click( function(event) { 
            
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
         
        var dataString1 = 'set=check_plus_cart_stock&menuid='+mn+"&qty="+qty_stk+"&weight="+wgt_stk+"&mode=ta&type=popup&mode_in="+mode_in;
        // alert(dataString1);
	var request=  $.ajax({
	type: "POST",
	url: "load_index.php",
	data: dataString1,
	success: function(data) { 
            
           // alert(data);
            
            $(".enter-qty-act").val(qt_old);  
            
            if($.trim(data)=='OK'){
            
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
        }
        else if($('#manlrate123').hasClass("focussed")){
            
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
           
        
            var serialno=$('#serialno').val();
         
            event.stopImmediatePropagation();
              var focus_on=$('#be_search_focus').val();
              if(focus_on=='search'){
                            $('#'+focus_on).focus();
                        }
                        else{
                            $('#codesrch_c').focus();
                        }
            var qty='';
           
           
            var stk2= parseFloat($('#stockshow').text());
            
            var qty5=$('.enter-qty-act').val();
            
            if(qty5==''){
                
                qty5=0;
            }
         
            var stockonoff=$('#stockonoff').val();
          
 if(stockonoff=="Y") {     
                
                
           if(parseFloat(stock_num)>=parseFloat(qty5)){
               
                var typesub=$('#typesub').val();
                
		var menuid   =  $('#idofmenu').val(); 
		
		var rate='';
                var order_from = 'TA';
                var manualrate_val=$('#manualrate').val();
                var preferncetext=$('.prefrtext').val();
                
                if(portion_or_unit=='Portion'){
                    
			var rate=$('#portionrate_'+portionid1).text().replace(',','');
                        var qty=$('.enter-qty-act').val();
                        var por=portionid1;
                        
                        if(manualrate_val=='Y'){
                            
                               var rate=$('#manlrate123').val();
                            
                        }
                        else{
                                var rate=$('#portionrate_'+portionid1).text().replace(',','');
                        }
                    }
                    else if(portion_or_unit=='Unit'){
                    
                    if(packet_or_loose=='Packet'){
                        
                                var qty=$('.enter-qty-act').val();
                                var unitweight=$('#unitweight-'+portion_id1).text();
                                var unitid=portion_id2[1];
                                
                        if(manualrate_val=='Y'){
                            
                            var rate=$('#manlrate123').val();
                            
                        }
                        else{
                                var rate=$('#unitrate-'+portion_id1).text().replace(',','');
                            }
                            }    
                    else if(packet_or_loose=='Loose'){
                                
                                var qty=$('#baseunitqty_'+portionid1).val();
                                var baseunitweight=$('#baseunitweight_'+portionid1).text();
                                var baseunitid=portionid1;
                                var looserate=$('#load_looserate').text().split('=');
                                
                        if(manualrate_val=='Y'){
                                     
                                 var rate=$('#manlrate123').val();
                            
                        }
                        else{
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
                            $(".loaderrpop").text('Check Quantity');
                            $('.loaderrpop').delay(2000).fadeOut('slow');
                        }
                        else if(packet_or_loose=="Loose" &&  (baseunitweight==0 || baseunitweight=="")){
                            
                            $(".loaderrpop").css("display","block"); 
                            $(".loaderrpop").addClass("popup_validate");
                            $(".loaderrpop").text("Add Weight");
                            $('.loaderrpop').delay(2000).fadeOut('slow');
                        }
                        
                        else{
                                $('.tasale_addnew').css('pointer-events','none');
                                
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
                                
                                 ////pref manual///
                                
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
                                var food= $('.online_order_box_act').attr('food_val');
				dataString = 'value=menusubmission&menuid='+menuid+"&portion="+por+"&rate="+rate+"&qty="+qty+
                                "&preferncetext="+preferncetext+"&mode="+ typesub+"&order_from="+order_from+"&ratetype="+portion_or_unit+
                                "&unittype="+packet_or_loose+"&unitweight="+unitweight+"&baseunitweight="+baseunitweight+"&unitid="+unitid+
                                "&baseunitid="+baseunitid+"&serialno="+serialno+"&addon="+addon1+"&food="+food+"&pref_ids="+pref_ids+"&manualrate_val="+
                                manualrate_val;
				
                                $.ajax({
				type: "POST",
				url: "load_takeaway.php",
				data: dataString,
				success: function(data) {
					data=$.trim(data);
					if(data=="ok")
					{
						$('.enter-qty-act').val('0');
						
						$("#searchb").focus();
                                                $('.ta_errormsg').css("display",'block');
			                        $('.ta_errormsg').text("ITEM ADDED...");
			                        $('.ta_errormsg').delay(1500).fadeOut('slow');
                                                $('#searchb').val('');
						$('.enter-qty').val('');
						
                                                $(".olddiv").removeClass("new_overlay"); 
                                                $(".confrmation_overlay").css("display","none");
                                                $('.bottom_edit_cc_popup').css("display","none"); 
						
						var dataString1;
						dataString1 = 'value=orderlistload';
						var request=  $.ajax({
						type: "POST",
						url: "load_takeaway.php",
						data: dataString1,
						success: function(data) {
                                                    
								$('#ta_orderlist').html(data);//alert(typesub);
								if(typesub=="Edit")
								{
								
								}
								var coutrgen=$('#counter_gen').val();
								var coutrstafgen=$('#counter_staff_gen').val();
								if(coutrgen=='Y' && coutrstafgen=='Y')
								{
								$('.genonly').css("display","block");
								}
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
        else{ 
            
        if(stk2!=0){
                        
                var popup_addrate1="Only "+stk2+" In Stock";
        }
        else{
            
              var popup_addrate1="Out of Stock";   
          
        }
				$(".loaderrpop").css("display","block"); 
				
			 	$(".loaderrpop").text(popup_addrate1);
				$('.loaderrpop').delay(2000).fadeOut('slow');
            
        }
    }
    else{ 
                
                var typesub=$('#typesub').val();
		var menuid   =  $('#idofmenu').val(); 
		
		var rate='';
                var order_from = 'TA';
                var manualrate_val=$('#manualrate').val();
                var preferncetext=$('.prefrtext').val();
                
                if(portion_or_unit=='Portion'){
                    
			var rate=$('#portionrate_'+portionid1).text().replace(',','');
                        var qty=$('.enter-qty-act').val();
                        var por=portionid1;
                        
                        if(manualrate_val=='Y'){
                                var rate=$('#manlrate123').val();
                            
                        }
                        else{
                               var rate=$('#portionrate_'+portionid1).text().replace(',','');
                        }
                        
                    }
                        else if(portion_or_unit=='Unit'){
                            
                            if(packet_or_loose=='Packet'){
                                
                                var qty=$('.enter-qty-act').val();
                                var unitweight=$('#unitweight-'+portion_id1).text();
                                var unitid=portion_id2[1];
                                
                        if(manualrate_val=='Y'){
                                     
                                    var rate=$('#manlrate123').val();
                            
                        }else{
                                   var rate=$('#unitrate-'+portion_id1).text().replace(',','');
                        }
                            
                            }    
                            else if(packet_or_loose=='Loose'){
                               
                                var qty=$('#baseunitqty_'+portionid1).val();
                                var baseunitweight=$('#baseunitweight_'+portionid1).text();
                                var baseunitid=portionid1;
                                var looserate=$('#load_looserate').text().split('=');
                                if(manualrate_val=='Y'){
                                  var rate=$('#manlrate123').val();
                            
                                 }
                        else{
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
                                $('.tasale_addnew').css('pointer-events','none');
                                var addon=new Array();
                                
                                if($('.addo_each_menu_div').is(':visible')) {
                                    
                                   $(".addo_each_menu_div").each(function() {
                                       var addon_menuid=$(this).find('.addonmenu').attr('id').split('_');
                                       var addon_menurate=parseFloat($(this).find('#addonrate_'+$.trim(addon_menuid[1])).text().replace(',',''));
                                       var addon_menuqty=$(this).find('#addonqty_'+$.trim(addon_menuid[1])).val();
                                       var addon_menu_slno=$(this).find('.addonmenu').attr('addon_slo');
    
                                       if(addon_menuqty>0){
                                         addon.push({
                                            'menu_id'   :$.trim(addon_menuid[1]),
                                            'menu_rate' :addon_menurate,
                                            'menu_qty'  :addon_menuqty,
                                            'menu_slno' :addon_menu_slno
                                          });
                                      }
                                    });
                                 var addon1=JSON.stringify(addon);
                                
                                }
                                
                                
                                 ////pref manual
                                
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
                                
                                var food= $('.online_order_box_act').attr('food_val');
                                 
				dataString = 'value=menusubmission&menuid='+menuid+"&portion="+por+"&rate="+rate+"&qty="+qty+
                                "&preferncetext="+preferncetext+"&mode="+ typesub+"&order_from="+order_from+"&ratetype="+portion_or_unit+
                                "&unittype="+packet_or_loose+"&unitweight="+unitweight+"&baseunitweight="+baseunitweight+"&unitid="+unitid+
                                "&baseunitid="+baseunitid+"&serialno="+serialno+"&addon="+addon1+"&food="+food+"&pref_ids="+pref_ids+"&manualrate_val="+
                                manualrate_val;
				
                                $.ajax({
				type: "POST",
				url: "load_takeaway.php",
				data: dataString,
				success: function(data) {
					data=$.trim(data);
					if(data=="ok")
					{
                                            
						$('.enter-qty-act').val('0');
						
                                                $('.ta_errormsg').css("display",'block');
			                        $('.ta_errormsg').text("ITEM ADDED");
			                        $('.ta_errormsg').delay(1500).fadeOut('slow');
                                                
                                                $('#searchb').val('');
                                                $("#searchb").focus();
						
                                                $(".olddiv").removeClass("new_overlay"); 
                                                 $(".confrmation_overlay").css("display","none");
                                                $('.bottom_edit_cc_popup').css("display","none"); 
						
						var dataString1;
						dataString1 = 'value=orderlistload';
						var request=  $.ajax({
						type: "POST",
						url: "load_takeaway.php",
						data: dataString1,
						success: function(data) {
								$('#ta_orderlist').html(data);
								if(typesub=="Edit")
								{
								
								}
								var coutrgen=$('#counter_gen').val();
								var coutrstafgen=$('#counter_staff_gen').val();
								if(coutrgen=='Y' && coutrstafgen=='Y')
								{
								$('.genonly').css("display","block");
								}
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
		}else{
                    
                        $('.alert_error_new_all').show();
                        
                        $('.alert_error_new_all').css('z-index', '999999');
                        
                        $('.alert_error_new_all').text('NO STOCK IN INVENTORY');
                       
                        $('.alert_error_new_all').delay(1000).fadeOut('slow');  
              
                  }
                          
  }
  }); 
  
  });
  
  /************  qty click starts ****************  */
        
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
         
            if($('#manualrate').val()=='Y'){
               
               if($('#rate_value').val()!=''){
                  //alert('2');
                 portion_rate=$('#rate_value').val();
            }
            else{
               // alert('3');
                portion_rate=0;
            }
            }
            else if($('#manualrate').val()=='N'){
               // alert('4')
                 portion_rate=$('#portionrate_'+prtnid).text().replace(',','');
            }
           
          
            var total_rate=parseFloat(quantity)*parseFloat(portion_rate);
            
            if(quantity!="" && quantity>0){
            $('#load_portionrate').text((total_rate).toFixed(decimal));
        }else{
            $('#load_portionrate').text((0).toFixed(decimal)); 
        }
        }