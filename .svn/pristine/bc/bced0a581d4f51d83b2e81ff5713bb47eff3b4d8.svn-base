// JavaScript Document

$(document).ready(function(){
    
    localStorage.addon_menuid='';
    var stk1= $('.position_mn_cc_focus').attr("stock");
    $('#stockshow1').html(stk1);
    $('#stockshow').html(stk1);
    var portionnamedef="Day";
    
	/*************** Submit each starts ********************  */
        
       $("span[contenteditable]").on("keydown", function (e) {
    if (e.key === "Enter") {
        e.preventDefault();

        var text = $(this).text().trim();
        
        if($('.weight-field').text()>0){
          $('.submit_all').click();
        } 
        
    }
    });   
        
    $('.submit_all').click(function () {
        
        
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
         
        
      var dataString1 = 'set=check_plus_cart_stock&menuid='+mn+"&qty="+qty_stk+"&weight="+wgt_stk+"&mode=cs&type=popup&mode_in=Add";
        
	var request=  $.ajax({
	type: "POST",
	url: "load_index.php",
	data: dataString1,
	success: function(data) { 
            
           // alert(data);
            $(this).attr("menusub",'m_'+mn);
               
            if($.trim(data)=='OK'){
        
        
        var portion_or_unit='';
        var packet_or_loose='';
        var unitweight='';
        var baseunitweight='';
        var unitid='';
        var baseunitid='';
        var portion_or_unit=$('#portion-or-unit').val();
        var packet_or_loose=$('#packet-or-loose').val();
                
        if($('.weight-field').hasClass("focussed")){
            var port_id=$(".weight-field").attr('id');
            var portion_id1=port_id.split('_');
            var portionid1=portion_id1[1];
        }
        else if($('.enter-qty-act').hasClass("focussed")){
            
            if(packet_or_loose=='Packet'){
                
                var port_id=$(".enter-qty-act").attr('id'); 
                var portion_id11=port_id.split('-');
                var portion_id1=portion_id11[1];
               
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
        
        else if($('#rate_value').hasClass("focussed")){
            
            if(packet_or_loose=='Packet'){
                
                var port_id=$(".enter-qty-act").attr('id'); 
                var portion_id11=port_id.split('-');
                var portion_id1=portion_id11[1];
               
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
        
        $('#'+focus_on).focus();
        
        var stk2= parseFloat($('#stockshow').text());
        
        var qty5=$('.enter-qty-act').val();
        
        if(qty5==''){
            
            qty5=0;
        }
        
        var stockonoff=$('#stockonoff').val();
       
        if(stockonoff=="Y"){ 
            
            
            if(parseFloat(stock_num)>=parseFloat(qty5)){
                event.stopImmediatePropagation();
                var manualrate_val=$('#rate_value').attr('manualrate');
                if(portion_or_unit=='Portion'){
                    var rate=$('#portionrate_'+portionid1).text().replace(',','');
                    var qty=$('.enter-qty-act').val();
                    var por=portionid1;
                    //alert(por);
                    if(manualrate_val=='Y'){
                    var rate=$('#rate_value').val();
                    }
                }
                else if(portion_or_unit=='Unit'){
                    if(packet_or_loose=='Packet'){
                        
                        var qty=$('.enter-qty-act').val();
                        
                        var unitweight=$('#unitweight-'+portion_id1).text();
                        var unitid=portion_id2[1];
                        var rate=$('#unitrate-'+portion_id1).text().replace(',','');
                        
                        if(manualrate_val=='Y'){
                    var rate=$('#rate_value').val();
                    }
                    }    
                    else if(packet_or_loose=='Loose'){
                        //alert('dsfd');
                        var qty=$('#baseunitqty_'+portionid1).val();
                        //alert(qty);
                        var baseunitweight=$('#baseunitweight_'+portionid1).text();
                        var baseunitid=portionid1;
                        var looserate=$('#load_looserate').text().split('=');
                        
                        var rate       =  parseFloat(looserate[1].replace(',',''))*parseFloat(baseunitweight);
                        
                        if(manualrate_val=='Y'){
                    var rate=$('#rate_value').val();
                    }
                    }
                }
                if(manualrate_val=='Y'){
                                var rate=$('#rate_value').val();
                }
                if(packet_or_loose=="Loose" &&  (baseunitweight==0 || baseunitweight=="")){
                    $(".loaderrpop").css("display","block"); 
                    $(".loaderrpop").addClass("popup_validate");
                    $(".loaderrpop").text("Add Weight");
                    $('.loaderrpop').delay(2000).fadeOut('slow');
                }
                else{
                    if((manualrate_val=="Y" && rate >0) || manualrate_val=="N"){
                        if(portion_or_unit=='Portion' && (por=="" || por==0)){   alert(por) ;   
                            $(".loaderrpop").css("display","block"); 
                            $(".loaderrpop").addClass("popup_validate");
                            $(".loaderrpop").text("Select "+ portionnamedef +"...");
                            $('.loaderrpop').delay(2000).fadeOut('slow');
                        }
                        else{
                            var qty=$('.enter-qty-act').val();
                            $.post("load_div.php", {qtyval:qty,set:'quantityset'});	
                            $.post("load_div.php", {rateval:rate,set:'rateset'});	
                            if(qty=="" || qty<=0){
                                //alert("ghfd");
                                var selqty=$('#popup_selectqty').val();
                                //alert(selqty);
                                $(".loaderrpop").css("display","block"); 
                                $(".loaderrpop").addClass("popup_validate");
                                $(".loaderrpop").text(selqty);
                                $('.loaderrpop').delay(2000).fadeOut('slow');
                            }
                            else{
                                var id_str   =  $(this).attr("menusub");
                                var id_arr	  =	 id_str.split("_");
                                var menunames       =  id_arr[1];
                                //alert(menunames);
                                $.post("load_div.php", {menu:menunames,set:'setmenuids'})//alert(menunames)
                                var selectvalue=$(".prefdp"+menunames).val();
                                var textvalue=$(".preftext"+menunames).val();
                                if(selectvalue==null){
                                    selectvalue="";
                                }
                                if(textvalue==""){
                                    textvalue="";
                                }
                                var set= "preferenceset";
                                if(selectvalue==""){
                                    var selectval=selectvalue;
                                }
                                else{
                                    var selectval=selectvalue+",";    
                                }
                                var textval=textvalue;
                                var all=selectval.concat(textval);
                                //alert(selectval);
                                data ="set="+set+"&all="+all;
                                //alert(data);
                                var request= $.ajax({
                                    type: "POST",
                                    dataType: "text",
                                    url: "load_div.php", 
                                    data: data,
                                    success: function(data) {
                                        var addon=new Array();
                            if($('.addo_each_menu_div').is(':visible')) {
                               $(".addo_each_menu_div").each(function() {
                                   var addon_menuid=$(this).find('.addonmenu').attr('id').split('_');
                                   var addon_menurate=parseFloat($(this).find('#addonrate_'+$.trim(addon_menuid[1])).text().replace(',',''));
                                   var addon_menuqty=$(this).find('#addonqty_'+$.trim(addon_menuid[1])).val();
//                                   alert(addon_menuid[1]);
//                                   alert(addon_menurate);
//                                   alert(addon_menuqty);
                                   if(addon_menuqty>0){
                                     addon.push({
                                        'menu_id':$.trim(addon_menuid[1]),
                                        'menu_rate':addon_menurate,
                                        'menu_qty':addon_menuqty,
                                      });
                                  }
                                });
                             var addon1=JSON.stringify(addon);
                             
                            }
                                   
                                
                                var data1 = {
                                    "action": 'add',
                                    "tableid" :document.getElementById("table_id").value,
                                    "floorid": document.getElementById("floor_id").value,
                                    "stewardid" : document.getElementById("steward_id").value,
                                    "orderid": document.getElementById("order_id").value,
                                    "branchid" :document.getElementById("branch_id").value,"ratetype"  :portion_or_unit,
                                    "unittype":packet_or_loose,
                                    "unitweight":unitweight,
                                    "baseunitweight":baseunitweight,
                                    "unitid":unitid,
                                    "baseunitid":baseunitid,
                                    "addon":addon1,
                                     "manualrate_val":manualrate_val,
                                     "rate":rate
                                };
                                data1 = $(this).serialize() + "&" + $.param(data1);
                                //alert(data1);
                                var hidtableordernentry_updated = $("#hidtableordernentry_updated").val();
                                var hidtableordernentry_success = $("#hidtableordernentry_success").val();
                                var hidtableordernentry_rate = $("#hidtableordernentry_rate").val();
                                var hidtableordernentry_billed = $("#hidtableordernentry_billed").val();
                                var request=$.ajax({
                                    type: "POST",
                                    dataType: "text",
                                    url: "response.php", 
                                    data: data1,
                                    success: function(data) {
                                        var res=data.trim();//alert(res);
                                        $(".md-close").click();
                                        $("#portion_value").text('');
                                        $('.portion_view_btn').text('');
                                        $('.caclulator_btn').removeClass("caclulator_btn_active");
                                        $('.confirmallfdetails').css("display","block");
                                        $(".loaderror").css("display","block");
                                        $(".loaderror").addClass("popup_validate");
                                          $('#search').val('');
                                        if(res=="Item updated"){
                                            $(".loaderror").text(hidtableordernentry_updated);
                                        }else  if(res=="Item Added Sucessfully"){
                                            $(".loaderror").text(hidtableordernentry_success);
                                        }else if(res=="Item Not added- Rate 0"){
                                            $(".loaderror").text(hidtableordernentry_rate);
                                        }else if(res=="Order Already Billed"){
                                            $(".loaderror").text(hidtableordernentry_billed);
                                        }
                                        $('.loaderror').delay(2000).fadeOut('slow');
                                        $('.ordelist_table').css("display","block");
                                        $('.ordelist_table').load('viewitems.php');
                                        return true;  
                                    }
                                });
                                 }
                                });
                                data = null;
                                data1 = null;
                                request.onreadystatechange = null;
                                request.abort = null;
                                request = null;
                            }
                        }
                    }else{    
                        var popup_addrate=$('#popup_addrate').val();
                        $(".loaderrpop").css("display","block"); 
                        $(".loaderrpop").addClass("popup_validate");
                        $(".loaderrpop").text(popup_addrate);
                        $('.loaderrpop').delay(2000).fadeOut('slow');
                    }
                }
                $('.ordelist_table').css("display","block");
                $('.ordelist_table').load('viewitems.php');
                return true;
            }
            else{ 
                if(stk2!=0){
                    var popup_addrate1="Only "+stk2+" In Stock";
                }
                else{
                    var popup_addrate1="Out of Stock";   
                }                       
                $(".loaderrpop").css("display","block"); 
                //$(".loaderrpop").addClass("popup_validate");
                $(".loaderrpop").text(popup_addrate1);
                $('.loaderrpop').delay(2000).fadeOut('slow');
            }
        }
        else{
            
            event.stopImmediatePropagation();
            
            var manualrate_val=$('#rate_value').attr('manualrate');
           
            if(portion_or_unit=='Portion'){
                
                var rate=$('#portionrate_'+portionid1).text().replace(',','');
                var qty=$('.enter-qty-act').val();
                var por=portionid1;
                
                if(manualrate_val=='Y'){
                    
                    var rate=$('#rate_value').val();
                    
                       rate = rate.replace(/,/g, '');
                }
            }
            else if(portion_or_unit=='Unit'){
                
                if(packet_or_loose=='Packet'){
                    
                    var qty=$('.enter-qty-act').val();
                    var unitweight=$('#unitweight-'+portion_id1).text();
                    var unitid=portion_id2[1];
                   
                    var rate=$('#unitrate-'+portion_id1).text().replace(',','');
                    
                    if(manualrate_val=='Y'){
                        
                    var rate=$('#rate_value').val();
                       rate = rate.replace(/,/g, '');
                    
                    }
                }    
                else if(packet_or_loose=='Loose'){
                    
                    var qty=$('#baseunitqty_'+portionid1).val();
                    var baseunitweight=$('#baseunitweight_'+portionid1).text();
                    var baseunitid=portionid1;
                    var looserate=$('#load_looserate').text().split('=');
                    var rate       =  parseFloat(looserate[1].replace(',',''))*parseFloat(baseunitweight);
                    
                    if(manualrate_val=='Y'){
                        
                     var rate=$('#rate_value').val();
                        rate = rate.replace(/,/g, '');
                    
                    }
                }
            }
            if(packet_or_loose=="Loose" &&  (baseunitweight==0 || baseunitweight=="")){
                
                $(".loaderrpop").css("display","block"); 
                $(".loaderrpop").addClass("popup_validate");
                $(".loaderrpop").text("Add Weight");
                $('.loaderrpop').delay(2000).fadeOut('slow');
                $('.enter-qty-act').focus();
            }
            else{
                if((manualrate_val=="Y" && rate >0) || manualrate_val=="N"){
                    
                    if(portion_or_unit=='Portion' && (por=="" || por==0)){   
                        
                        $(".loaderrpop").css("display","block"); 
                        $(".loaderrpop").addClass("popup_validate");
                        $(".loaderrpop").text("Select "+ portionnamedef +"...");
                        $('.loaderrpop').delay(2000).fadeOut('slow');
                    }
                    else{
                        
                          
                        
                        $.post("load_div.php", {qtyval:qty,set:'quantityset'});	
                        
                        $.post("load_div.php", {rateval:rate,set:'rateset'});
                        
                        if(qty=="" || qty<=0){
                           
                            var selqty=$('#popup_selectqty').val();
                            
                            $(".loaderrpop").css("display","block"); 
                            $(".loaderrpop").addClass("popup_validate");
                            $(".loaderrpop").text(selqty);
                            $('.loaderrpop').delay(2000).fadeOut('slow');
                            $('.enter-qty-act').focus();
                            
                        }else{
                            
                            
                            var id_str   =  $(this).attr("menusub");
                        
                            var id_arr	  =	 id_str.split("_");
                            
                            var menunames       =  id_arr[1];
                            
                            $.post("load_div.php", {menu:menunames,set:'setmenuids'});
                            
                            var selectvalue=$(".prefdp"+menunames).val();
                           
                            var textvalue=$(".preftext"+menunames).val();
                            
                            if(selectvalue==null){
                                
                                selectvalue="";
                            }
                            if(textvalue==""){
                                
                                textvalue="";
                            }
                            
                            var set= "preferenceset";
                            
                            if(selectvalue==""){
                                
                                var selectval=selectvalue;
                            }
                            else{
                                
                                var selectval=selectvalue+",";    
                            }
                            
                            var textval=textvalue;
                            var all=selectval.concat(textval);
                            var data ="set="+set+"&all="+all;
                            
                            
                            var request= $.ajax({
                                type: "POST",
                                dataType: "text",
                                url: "load_div.php", 
                                data: data,
                                success: function(data) {
                                    //alert(data);
                               // }
                            //});
//                            data = null;
//                            request.onreadystatechange = null;
//                            request.abort = null;
//                            request = null;
//                            var checkinsert="";
//                            var data = {
//                                "action": "check",
//                                "tableid" :document.getElementById("table_id").value,
//                                "floorid": document.getElementById("floor_id").value,
//                                "stewardid" : document.getElementById("steward_id").value,
//                                "orderid": document.getElementById("order_id").value,
//                                "branchid" :document.getElementById("branch_id").value,
//                                "ratetype"  :portion_or_unit,
//                                "unittype":packet_or_loose,
//                                "unitweight":unitweight,
//                                "baseunitweight":baseunitweight,
//                                "unitid":unitid,
//                                "baseunitid":baseunitid
//                            };
                            
                            data = $(this).serialize() + "&" + $.param(data);
                            var addon=new Array();
                            if($('.addo_each_menu_div').is(':visible')) {
                               $(".addo_each_menu_div").each(function() {
                                   
                                   var addon_menuid=$(this).find('.addonmenu').attr('id').split('_');
                                   var addon_menurate=parseFloat($(this).find('#addonrate_'+$.trim(addon_menuid[1])).text().replace(',',''));
                                   var addon_menuqty=$(this).find('#addonqty_'+$.trim(addon_menuid[1])).val();

                                   if(addon_menuqty>0){
                                     addon.push({
                                        'menu_id':$.trim(addon_menuid[1]),
                                        'menu_rate':addon_menurate,
                                        'menu_qty':addon_menuqty,
                                      });
                                  }
                                });
                             var addon1=JSON.stringify(addon);
                             
                            }
                            
                            var data1 = {
                                "action": "add",
                                "tableid" :document.getElementById("table_id").value,
                                "floorid": document.getElementById("floor_id").value,
                                "stewardid" : document.getElementById("steward_id").value,
                                "orderid": document.getElementById("order_id").value,
                                "branchid" :document.getElementById("branch_id").value,
                                "ratetype"  :portion_or_unit,
                                "unittype":packet_or_loose,
                                "unitweight":unitweight,
                                "baseunitweight":baseunitweight,
                                "unitid":unitid,
                                "baseunitid":baseunitid,
                                 "addon":addon1,
                                 "manualrate_val":manualrate_val,
                                 "rate":rate
                            };
                            data1 = $(this).serialize() + "&" + $.param(data1);
                                //alert(data1);
                                var hidtableordernentry_updated = $("#hidtableordernentry_updated").val();
                                var hidtableordernentry_success = $("#hidtableordernentry_success").val();
                                var hidtableordernentry_rate = $("#hidtableordernentry_rate").val();
                                var hidtableordernentry_billed = $("#hidtableordernentry_billed").val();
                                var request=$.ajax({
                                    type: "POST",
                                    dataType: "text",
                                    url: "response.php", 
                                    data: data1,
                                    success: function(data) {
                                        var res=data.trim(); 
                                        $(".md-close").click();
                                        $("#portion_value").text('');
                                        $('.portion_view_btn').text('');
                                        $('.caclulator_btn').removeClass("caclulator_btn_active");
                                        $('.confirmallfdetails').css("display","block");
                                        $(".loaderror").css("display","block");
                                        $(".loaderror").addClass("popup_validate");
                                          $('#search').val('');
                                        if(res=="Item updated"){
                                            $(".loaderror").text(hidtableordernentry_updated);
                                        }else  if(res=="Item Added Sucessfully"){
                                            $(".loaderror").text(hidtableordernentry_success);
                                        }
                                        else if(res=="Item Not added- Rate 0"){
                                            $(".loaderror").text(hidtableordernentry_rate);
                                        }else if(res=="Order Already Billed"){
                                            $(".loaderror").text(hidtableordernentry_billed);
                                        }$('.loaderror').delay(2000).fadeOut('slow');
                                        $('.ordelist_table').css("display","block");
                                        $('.ordelist_table').load('viewitems.php');
                                        return true;
                                    }
                                });
                                }  
                        });
                                return  res;
                                data = null;
                                data1 = null;
                                request.onreadystatechange = null;
                                request.abort = null;
                                request = null;
                            }
                        }
                    }else{
                        //alert(rate);
                        var popup_addrate=$('#popup_addrate').val();
                        $(".loaderrpop").css("display","block"); 
                        $(".loaderrpop").addClass("popup_validate");
                        $(".loaderrpop").text(popup_addrate);
                        $('.loaderrpop').delay(2000).fadeOut('slow');
                    }
                }
                $('.ordelist_table').css("display","block");
                $('.ordelist_table').load('viewitems.php');
                return true;
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
	/*************************************** Submit each starts *************************************************  */
	
	/*************************************** Popup function starts *************************************************  */
	
    $('.md-close').click( function(event) {  
        event.stopImmediatePropagation();		
        
       
        //alert(focus_on)
        $('.mynewpopupload').empty();
        $('.mynewpopupload').css("display","none");
        $(".olddiv").removeClass("new_overlay"); 
         var focus_on=$('#be_search_focus').val();
        $('#'+focus_on).focus(); 
    });
	/***************************************  Popup function starts *************************************************  */
	
	/*************************************** dropdown 1 starts *************************************************  */
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
	/*************************************** dropdown 1 ends *************************************************  */
	
	/*************************************** take away , dine in click starts *************************************************  */
    $(".take_btn_cc").click(function(){
		if($(this).hasClass('take_btn_cc_act'))
		{
			$(".take_btn_cc").removeClass('take_btn_cc_act');
			$(this).removeClass('take_btn_cc_act');
		}else
		{
			$(".take_btn_cc").removeClass('take_btn_cc_act');
			$(this).addClass('take_btn_cc_act');
		}
		var type=($(this).attr("id"));
		if(type==1)
			{
				var ty="Dinein";
			}else
			{
				var ty="TakeAway";
			}
		$.post("load_div.php", {type:ty,set:'settype'});	
	});
	/*************************************** take away , dine in click ends *************************************************  */
    $('#rate_value').click(function () {
            
            $(".enter-qty-act").removeClass("focussed");
            $('.weight-field').removeClass("focussed");
            $('.looseweight').removeClass('enter-qty-act');
            $('.addonqty').removeClass("focussed");
            localStorage.addon_menuid='';
            $('#rate_value').addClass("focussed");
            
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
           $('#rate_value').removeClass("focussed");
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
          if(packet_or_loose=='')
                 
		$.post("load_div.php", {portionval:selval,unitval:'',baseunit:'',set:'portionset'});
            }
            else if(portion_or_unit=='Unit'){
                            
                if(packet_or_loose=='Packet'){
                    var portion_id1=id.split('-');
                    var selval=portion_id1[1];
                    //alert(selval);
                    var portion_id2=selval.split('_');
                    var port_id2=portion_id2[1];
                    //alert(port_id2);
                     var stock_num=$('#unit_stock_number-'+selval).attr('stock');
                           $.post("load_div.php", {portionval:'',unitval:port_id2,baseunit:'',set:'portionset'});     
                }    
                else if(packet_or_loose=='Loose'){
                    var portion_id1=id.split('_');
                var selval=portion_id1[1];
                         $.post("load_div.php", {portionval:'',unitval:'',baseunit:selval,set:'portionset'});        
                }
            }
            //alert(stock_num);
          $('#stockshow').html(stock_num);
        });
    $('.looseweight').click(function(){
           
           $('.enter-qty').removeClass('enter-qty-act');
           $('.enter-qty').removeClass('focussed');
           $('.addonqty').removeClass("focussed");
           localStorage.addon_menuid='';
           $('#rate_value').removeClass("focussed");
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
        $('#rate_value').removeClass("focussed");
        
        $(this).addClass('focussed');
        var qtyid=$(this).attr('id').split('_');
        var addon_menuid=$.trim(qtyid[1]);
        localStorage.addon_menuid=addon_menuid;
        $('#addon_menuid').val(addon_menuid);
        
    });   
        
        
        
       
        
       
        
	/*************************************** Calculator clicks starts *************************************************  */
     
    
    
    $('.caclulator_btn').click(function (){  
	
            
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
        if($('#rate_value').hasClass("focussed")){
            var strg=$("#rate_value").val() + 1;
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
	}
        else if(strg.length<0)
	{ //alert("negative");
            if($('#rate_value').hasClass("focussed")){
                //alert("fadbghhb");
                if($('#rate_value').val()=="0"){
                    var tot=selval; 
		}
                else if($('#rate_value').val()=="")
                {
                   
                    var tot="0.";
                }
                else
		{
                  if(selval=="." && !tot.includes("."))
                    {
                    var tot=$('#rate_value').val();
		    }
                    else{
                        var tot=$('#rate_value').val() + selval;
                    }
		}
                $('#rate_value').focus();
                $('#rate_value').val(tot);
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
            var rt       =  parseFloat($('#portionrate_'+port_id2).text());
		
            if($('#rate_value').val()==""||$('#rate_value').val()=='0'){
                if($(".enter-qty-act").val()=="0")
                {
                  var totl=parseFloat(rt);  
                }else{
                    var totl=parseFloat(rt) * parseFloat($(".enter-qty-act").val());
             }
           
             } else
             {
                var totl= parseFloat($('#rate_value').val())*parseFloat($(".enter-qty-act").val());
             }
            $("#load_portionrate").html(totl.toFixed(decimal));
            $.post("load_div.php", {qtyval:tot,set:'quantityset'});	
	}
	else
	{ 
            
            if(portion_or_unit=='Portion'){
                
               if($('#rate_value').hasClass("focussed")){
                    //alert($('#rate_value').val());
                    if($('#rate_value').val()=="0"){
                   
                        var tot="0"+selval; 
                    }
                    else if(($('#rate_value').val()=="") && (selval==".") )
                    {
                   
                        var tot="0.";
                    }
                    else
                    {   
                        if(selval=="."){
                            var tot=$('#rate_value').val()+".";
                    
                        }
                        else{
                          
                                //var tot=$('#rate_value').val() + selval;
                                if (window.getSelection) {
                   if(window.getSelection()!=''){
                      var tot=selval;
                   }else{
                     var tot=$('#rate_value').val() + selval; 
                   }
                   }else{ 
                      var tot=$('#rate_value').val() + selval;
                  }
                        }
                    }
                    
                    $('#rate_value').focus();
                    $('#rate_value').val(tot);
                    var totl= parseFloat($('#rate_value').val())*parseFloat($(".enter-qty-act").val());
                }  
                else if($('.enter-qty-act').hasClass("focussed")){
                
                    if(selval!="."){
                    
                        if($(".enter-qty-act").val()=="0"){
                        var tot=selval; 
                        }else
                        {
                        var tot=$(".enter-qty-act").val() + selval;
                        }
                        
                        if(localStorage.edit_di=='N'){
                       $(".enter-qty-act").val('');
                       $(".enter-qty-act").val(selval);
                      var tot=selval;
                       localStorage.edit_di='Y';
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
               
            if($('#rate_value').val()==""||$('#rate_value').val()==0){
                if($('#load_portionrate').text()=="0")
                {
                  var totl=parseFloat(rt); 
                   
                }else{
            var totl=parseFloat(rt) * parseFloat($(".enter-qty-act").val());
             
             }
           
         } else
             {
                var totl= parseFloat($('#rate_value').val())*parseFloat($(".enter-qty-act").val());
             }  
                
            $("#load_portionrate").html(totl.toFixed(decimal));
            }
            else if(portion_or_unit=='Unit'){
                if(packet_or_loose=='Packet'){
                    if($('#rate_value').hasClass("focussed")){
                    //alert($('#rate_value').val());
                    if($('#rate_value').val()=="0"){
                   
                        var tot="0"+selval; 
                    }
                    else if(($('#rate_value').val()=="") && (selval==".") )
                    {
                   
                        var tot="0.";
                    }
                    else
                    {   
                        if(selval=="."){
                            var tot=$('#rate_value').val()+".";
                    
                        }
                        else{
                           // var tot=$('#rate_value').val() + selval;
                                    if (window.getSelection) {
                   if(window.getSelection()!=''){
                      var tot=selval;
                   }else{
                     var tot=$('#rate_value').val() + selval; 
                   }
                   }else{ 
                      var tot=$('#rate_value').val() + selval;
                  }
                        }
                    }
                    $('#rate_value').focus();
                    $('#rate_value').val(tot);
                    var totl= parseFloat($('#rate_value').val())*parseFloat($(".enter-qty-act").val());
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
                
                 if(localStorage.edit_di=='N'){
                       $(".enter-qty-act").val('');
                       $(".enter-qty-act").val(selval);
                      var tot=selval;
                       localStorage.edit_di='Y';
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
                if($('#rate_value').val()==""||$('#rate_value').val()==0){
                if($('#load_portionrate').text()=="0")
                {
                  var totl=parseFloat(rt);  
                }else{
            var totl=parseFloat(rt) * parseFloat($(".enter-qty-act").val());
             }
         } else
             {
                var totl= parseFloat($('#rate_value').val())*parseFloat($(".enter-qty-act").val());
             }  
                
            $("#load_packetrate").html(totl.toFixed(decimal));
                }
                else if(packet_or_loose=='Loose'){
                    
                    
                      if($('#rate_value').hasClass("focussed")){
                    //alert($('#rate_value').val());
                    if($('#rate_value').val()=="0"){
                   
                        var tot="0"+selval; 
                    }
                    else if(($('#rate_value').val()=="") && (selval==".") )
                    {
                   
                        var tot="0.";
                    }
                    else
                    {   
                        if(selval=="."){
                            var tot=$('#rate_value').val()+".";
                    
                        }
                        else{
                           // var tot=$('#rate_value').val() + selval;
                                    if (window.getSelection) {
                   if(window.getSelection()!=''){
                      var tot=selval;
                   }else{
                     var tot=$('#rate_value').val() + selval; 
                   }
                   }else{ 
                      var tot=$('#rate_value').val() + selval;
                  }
                        }
                    }
                    $('#rate_value').focus();
                    $('#rate_value').val(tot);
                    var totl= parseFloat($('#rate_value').val())*parseFloat($(".enter-qty-act").val());
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
                
                 if(localStorage.edit_di=='N'){
                       $(".enter-qty-act").val('');
                       $(".enter-qty-act").val(selval);
                      var tot=selval;
                       localStorage.edit_di='Y';
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
            
            $.post("load_div.php", {qtyval:tot,set:'quantityset'});
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
              
              
               if($('#rate_value').hasClass("focussed")){
                     $('#rate_value').val('');
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
                    if($('#rate_value').hasClass("focussed")){
                    $('#rate_value').val('');
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
                     if($('#rate_value').hasClass("focussed")){
                         
                    $('#rate_value').val('');
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
	/*************************************** Calculator clicks ends *************************************************  */
	
	/*************************************** portion starts *************************************************  */
	$('.position_mn_cc li').click(function () {
           // alert('t');
		var val=$(this).find("a").text();
		var id_str   =  $(this).find("a").attr("title");
		var id_arr	  =	 id_str.split("_");
		var selval       =  id_arr[1];
		var portion_text="port_"+selval;
		$("#portion_value").text(val);
		$("#portion_value").attr("title",portion_text);
		$(".position_mn_cc li ").find("a").removeClass("position_mn_cc_focus");
		$(this).find("a").addClass('position_mn_cc_focus');
		$('.portion_view_btn').text('');
		$(".position_mn_cc_focus").find('.portion_view_btn').text('');
		$("#calc_value").text('0');
		
		var id_rate   =  $(this).find("a").attr("rate");
		var id_rates	  =	 id_rate.split("_");
		var rate       =  id_rates[1];
		$("#load_portionrate").html(rate);
		
		$('.caclulator_btn').removeClass("caclulator_btn_active");
		$.post("load_div.php", {portionval:selval,set:'portionset'});
//                $.post("load_popupmenu.php", {portionvalcode:selval,set:'portcod'});
               
               var stk= $(this).find("a").attr("stock");
               $('#stockshow').html(stk);        
        
             
               
                
	});
	/*************************************** portion ends *************************************************  */
	
	
	/*************************************** Negative KOT starts *************************************************  */
	$('.negativekot').click(function () {
		var qty=$(".position_mn_cc_focus>.portion_view_btn").text();
		if(qty.indexOf('-') == -1)
		{
		  $(".position_mn_cc_focus>.portion_view_btn").prepend("-");
		  $("#calc_value").prepend("-");
		}
	
	});
	
	/***************************************  Negative KOT ends *************************************************  */

    $('#popup_order_edit').click(function () {
        
        
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
         
        //var mode_in=$('#typesub').val();
         
        var dataString1 = 'set=check_plus_cart_stock&menuid='+mn+"&qty="+qty_stk+"&weight="+wgt_stk+"&mode=di&type=popup&mode_in=Edit";
       // alert(dataString1);
	$.ajax({
	type: "POST",
	url: "load_index.php",
	data: dataString1,
	success: function(data) { 
            
            //alert(data);
            
            $(this).attr("menusub",'m_'+mn);
            
            if($.trim(data)=='OK'){ 
        
        
        
        
        var portion_or_unit='';
        var packet_or_loose='';
        var unitweight='';
        var baseunitweight='';
        var unitid='';
        var baseunitid='';
        var portion_or_unit=$('#portion-or-unit').val();
        var packet_or_loose=$('#packet-or-loose').val();
      
       
        if($('.weight-field').hasClass("focussed")){
            var port_id=$(".weight-field").attr('id');
            var portion_id1=port_id.split('_');
            var portionid1=portion_id1[1];
        }
        else if($('.enter-qty').hasClass("enter-qty-act")){
            
            if(packet_or_loose=='Packet'){
                var port_id=$(".enter-qty-act").attr('id'); 
                var portion_id11=port_id.split('-');
                var portion_id1=portion_id11[1];
                var portion_id2=port_id.split('_');
                //alert($('#unit_stock_number-'+portion_id1).attr('stock'));
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
        else if($('#rate_value').hasClass("focussed")){
            if(packet_or_loose=='Packet'){
                
                var port_id=$(".enter-qty-act").attr('id'); 
                var portion_id11=port_id.split('-');
                var portion_id1=portion_id11[1];
               
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
        $('#'+focus_on).focus(); 
        var mn1=$('#menuofid').val();
       
        
        var stk2= parseFloat($('#stockshow').text());
        var qty5=$('.enter-qty-act').val();
        if(qty5==''){
            qty5=0;
        }
        
        var stockonoff=$('#stockonoff').val();
        
        if(stockonoff=="Y"){     
            
            if(parseFloat(stock_num)>=parseFloat(qty5)){
                event.stopImmediatePropagation();
                var preftext= $("#preftext").val();
               
                var mn1=$('#menuofid').val();
                var qty=$('.enter-qty-act').val();
               
                var manualrate_val=$('#rate_value').attr('manualrate');
                var manualrate_val=$('#rate_value').attr('manualrate');
                var rate=$('#portionrate_'+portionid1).text().replace(',','');
                if(manualrate_val=='Y'){
                    var rate=$('#rate_value').val();
                }
		if(portion_or_unit=='Portion'){
                    var rate=$('#portionrate_'+portionid1).text().replace(',','');
                    var qty=$('.enter-qty-act').val();
                    var por=portionid1;
                    if(manualrate_val=='Y'){
                        var rate=$('#rate_value').val();
                    }
                }
                else if(portion_or_unit=='Unit'){
                    if(packet_or_loose=='Packet'){
                        var qty=$('.enter-qty-act').val();
                        var unitweight=$('#unitweight-'+portion_id1).text();
                       
                        var unitid=portion_id2[1];
                        
                        var rate=$('#unitrate-'+portion_id1).text().replace(',','');
                       
                    }    
                    else if(packet_or_loose=='Loose'){
                      
                        var qty=$('#baseunitqty_'+portionid1).val();
                        var baseunitweight=$('#baseunitweight_'+portionid1).text();
                        var baseunitid=portionid1;
                        var looserate=$('#load_looserate').text().split('=');
                        var rate       =  parseFloat(looserate[1].replace(',',''))*parseFloat(baseunitweight);
                    }
                }
		var sl_no = $('#edit_serialno').val();
                    if(packet_or_loose=="Loose" &&  (baseunitweight==0 || baseunitweight=="")){
                        $(".loaderrpop").css("display","block"); 
                        $(".loaderrpop").addClass("popup_validate");
                        $(".loaderrpop").text("Add Weight");
                        $('.loaderrpop').delay(2000).fadeOut('slow');
                        
                    }
                    else{
			if(manualrate_val=="Y" && rate>0 || manualrate_val=="N")
			{ 
			if( portion_or_unit=='Portion'&& (por=="" || por==0))
			{
                            $(".loaderrpop").css("display","block"); 
                            $(".loaderrpop").addClass("popup_validate");
                            $(".loaderrpop").text("Select "+ portionnamedef +"...");
                            $('.loaderrpop').delay(2000).fadeOut('slow');
                            
			}else
			{
                            $.post("load_div.php", {qtyval1:qty,set:'quantityset'});	
                            $.post("load_div.php", {rateval:rate,set:'rateset'});	
                            if(qty=="" || qty==0){ 
				var selqty=$('#popup_selectqty').val();
                                
				$(".loaderrpop").css("display","block"); 
				$(".loaderrpop").addClass("popup_validate");
				$(".loaderrpop").text(selqty);
				$('.loaderrpop').delay(2000).fadeOut('slow');
                                
                            }else{
                                
				var id_str   =  $(this).attr("menusub");
				var id_arr	  =	 id_str.split("_");
				var menunames       =  id_arr[1];
                                
				$.post("load_div.php", {menu:menunames,set:'setmenuids'})
				var selectvalue=$(".prefdp"+menunames).val();
				
                               
                                var textvalue=$(".preftext"+menunames).val();
                                
				if(selectvalue==null){
                                    selectvalue="";
				}
				if(textvalue==null){
                                    textvalue="";
				}
				
				
				var set1= "preferenceset";
                                if(selectvalue==""){
                                    var selectval=selectvalue;
				}else{
                                    var selectval=selectvalue;    
                                }
                               
                               
				var textval=textvalue;
                                
                                var all1=selectval.concat(textval);
				data="set="+set1+"&all="+all1;
                                
				var request= $.ajax({
                                    type: "POST",
                                    dataType: "text",
                                    url: "load_div.php", 
                                    data: data,
                                    success: function(data) {
                                    }
				});
				data = null;
				request.onreadystatechange = null;
				request.abort = null;
				request = null;
                               
                                var selectval1='';
                                if(selectval!=''){
                                    selectval1=selectval.join(',');
                                }
                                if(preftext!=''){
                                    preftext=preftext+',';
                                }
                                var preftext1=preftext+selectval1
                               
                               
                            var addon=new Array();
                            if($('.addo_each_menu_div').is(':visible')) {
                               $(".addo_each_menu_div").each(function() {
                                   var addon_menuid=$(this).find('.addonmenu').attr('id').split('_');
                                   var addon_slno=$(this).find('.addonmenu').attr('addon_slno');
                                   var addon_menurate=parseFloat($(this).find('#addonrate_'+$.trim(addon_menuid[1])).text().replace(',',''));
                                   var addon_menuqty=$(this).find('#addonqty_'+$.trim(addon_menuid[1])).val();

                                   
                                     addon.push({
                                        'menu_id':$.trim(addon_menuid[1]),
                                        'menu_slno':addon_slno,
                                        'menu_rate':addon_menurate,
                                        'menu_qty':addon_menuqty,
                                      });
                                  
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
                                
                            
				var data = {
                                    "action": "update1",
                                    "portion": por,
                                    "menuid" :document.getElementById("idofmenu").value,
                                    "floorid": $('#idofmenu').attr('floorid'),
                                    "branchid": document.getElementById("branch_id").value,
                                    "slno": sl_no, 
                                    "qty" :qty,
                                    "final1":rate,
                                    "pref_text" :preftext1,
                                    "manual_rate" :$('#rate_value').val(),
                                    "manualrate_entry" :$('#rate_value').attr('manualrate'),
                                    "ratetype"  :portion_or_unit,
                                    "unittype":packet_or_loose,
                                    "unitweight":unitweight,
                                    "baseunitweight":baseunitweight,
                                    "unitid":unitid,
                                    "baseunitid":baseunitid,
                                    "addon":addon1,
                                    "pref_ids":pref_ids
                                };
                                
				data = $(this).serialize() + "&" + $.param(data);
				
                                var request= 	$.ajax({
                                    type: "POST",
                                    dataType: "json",
                                    url: "response.php", 
                                    data: data,
                                    success: function(datas) {
                                       
					var obj = JSON.parse(datas["json"]);
					var last=obj.msg;
                                        
                                        if(last=="sorry"){
                                            checkinsert="ok";
					}
                                    }
				});
				$.ajaxSetup({cache: false});
                                data = null;
                                request.onreadystatechange = null;
                                request.abort = null;
                                request = null;
				function checkins(val){ 
                                    var data1 = {
                                        "action": val,
                                        "tableid" :document.getElementById("table_id").value,
                                        "floorid": document.getElementById("floor_id").value,
                                        "stewardid" : document.getElementById("steward_id").value,
                                        "orderid": document.getElementById("order_id").value,
                                        "branchid" :document.getElementById("branch_id").value
                                    };
                                    data1 = $(this).serialize() + "&" + $.param(data1);
                                    
                                    var hidtableordernentry_updated = $("#hidtableordernentry_updated").val();
                                    var hidtableordernentry_success = $("#hidtableordernentry_success").val();
                                    var hidtableordernentry_rate = $("#hidtableordernentry_rate").val();
                                    var hidtableordernentry_billed = $("#hidtableordernentry_billed").val();
                                    var request=$.ajax({
                                        type: "POST",
					dataType: "text",
                                        url: "response.php", 
					data: data1,
					success: function(data) {
                                            var res=data.trim();
                                            $(".md-close").click();
                                            $("#portion_value").text('');
                                            $('.portion_view_btn').text('');
                                            $('.caclulator_btn').removeClass("caclulator_btn_active");
                                            $('.confirmallfdetails').css("display","block");
                                            $(".loaderror").css("display","block");
                                            $(".loaderror").addClass("popup_validate");
                                            if(res=="Item updated"){ 
                                                $(".loaderror").text(hidtableordernentry_updated);
                                            }else  if(res=="Item Added Sucessfully"){ 
                                                $(".loaderror").text(hidtableordernentry_success);
                                            }else if(res=="Item Not added- Rate 0"){ 
                                                $(".loaderror").text(hidtableordernentry_rate);
                                            }else if(res=="Order Already Billed"){ 
                                                $(".loaderror").text(hidtableordernentry_billed);
                                            }
                                            $('.loaderror').delay(2000).fadeOut('slow');
                                            
                                            $('.ordelist_table').css("display","block");
                                            $('.ordelist_table').load('viewitems.php');
					}
                                    });
                                    return  res;
                                    data = null;
                                    data1 = null;
                                    request.onreadystatechange = null;
                                    request.abort = null;
                                    request = null;
				};
                                $(".olddiv").removeClass("new_overlay"); 
                                $('.mynewpopupload').empty();
                                $('.mynewpopupload').css("display","none");
                            }
			}
                    }else{
			var popup_addrate=$('#popup_addrate').val();
			$(".loaderrpop").css("display","block"); 
			$(".loaderrpop").addClass("popup_validate");
			$(".loaderrpop").text(popup_addrate);
			$('.loaderrpop').delay(2000).fadeOut('slow');
                        
                    } 
                } 
                $('.ordelist_table').css("display","block");
		$('.ordelist_table').load('viewitems.php');
		return true;
            }
            else{ 
                if(stock_num!=0){
                    var popup_addrate1="Only "+stock_num+" In Stock";
                }else{
                    var popup_addrate1="Out of Stock";   
                }
		$(".loaderrpop").css("display","block"); 
		
		$(".loaderrpop").text(popup_addrate1);
		$('.loaderrpop').delay(2000).fadeOut('slow');
            }
 }
 else{ 
                        event.stopImmediatePropagation();
                        var manualrate_val=$('#rate_value').attr('manualrate');
                        
                        if(portion_or_unit=='Portion'){
			var rate=$('#portionrate_'+portionid1).text().replace(',','');
                       
                        var qty=$('.enter-qty-act').val();
                        var por=portionid1;
                        if(manualrate_val=='Y'){
                            var rate=$('#rate_value').val();
                            
                        }
                        }
                        else if(portion_or_unit=='Unit'){
                            
                            if(packet_or_loose=='Packet'){
                                var qty=$('.enter-qty-act').val();
                                var unitweight=$('#unitweight-'+portion_id1).text();
                                var unitid=portion_id2[1];
                                var rate=$('#unitrate-'+portion_id1).text().replace(',','');
                               
                            }    
                            else if(packet_or_loose=='Loose'){
                              
                                var qty=$('#baseunitqty_'+portionid1).val();
                                var baseunitweight=$('#baseunitweight_'+portionid1).text();
                                var baseunitid=portionid1;
                                var looserate=$('#load_looserate').text().split('=');
                                var rate       =  parseFloat(looserate[1].replace(',',''))*parseFloat(baseunitweight);
                            }
                        }
                        var preftext= $("#preftext").val();
                        var sl_no = $('#edit_serialno').val();
                       
                        if(packet_or_loose=="Loose" &&  (baseunitweight==0 || baseunitweight=="")){
                            
                            $(".loaderrpop").css("display","block"); 
                            $(".loaderrpop").addClass("popup_validate");
                            $(".loaderrpop").text("Add Weight");
                            $('.loaderrpop').delay(2000).fadeOut('slow');
                            $('#popup_order_edit').css('pointer-events','inherit');
                        }
                        else{
                        
                        
			if(manualrate_val=="Y" && rate>0 || manualrate_val=="N")
			{ 
			if(portion_or_unit=='Portion'&& (por=="" || por==0))
			{
				$(".loaderrpop").css("display","block"); 
				$(".loaderrpop").addClass("popup_validate");
			 	$(".loaderrpop").text("Select "+ portionnamedef +"...");
				$('.loaderrpop').delay(2000).fadeOut('slow');
                                $('#popup_order_edit').css('pointer-events','inherit');
			}else
			{
				
				$.post("load_div.php", {qtyval1:qty,set:'quantityset'});	
				
					$.post("load_div.php", {rateval:rate,set:'rateset'});	
					if(qty=="" || qty==0)
					 { 
					 var selqty=$('#popup_selectqty').val();
                                          
						  $(".loaderrpop").css("display","block"); 
						  $(".loaderrpop").addClass("popup_validate");
						  $(".loaderrpop").text(selqty);
						  $('.loaderrpop').delay(2000).fadeOut('slow');
                                                  $('#popup_order_edit').css('pointer-events','inherit');
					  }else
					  {
                                              
                                              
					  var id_str   =  $(this).attr("menusub");
					  var id_arr	  =	 id_str.split("_");
					  var menunames       =  id_arr[1];
                                           
					  $.post("load_div.php", {menu:menunames,set:'setmenuids'})
					  var selectvalue=$(".prefdp"+menunames).val();
					 
                                          
					 var textvalue=$(".preftext"+menunames).val();
                                      
					  if(selectvalue==null)
					{
						 selectvalue="";
					  }
					  if(textvalue==null)
					  {
						textvalue="";
				}
					  
					 var set1= "preferenceset";
                                                if(selectvalue=="")
					  {
						 var selectval=selectvalue;
					  }else
                                          {
                                            var selectval=selectvalue;    
                                          }
						
					        var textval=textvalue;
                                                 
                                                var all1=selectval.concat(textval);
						
						data="set="+set1+"&all="+all1;
                                               
					 var request= $.ajax({
						  type: "POST",
						  dataType: "text",
						  url: "load_div.php", 
						  data: data,
						  success: function(data) {
							  
						  }
						});
					  
					  	data = null;
						request.onreadystatechange = null;
						request.abort = null;
						request = null;
                                            
					   var checkinsert="";

                                            var selectval1='';
                                            if(selectval!=''){
                                            selectval1=selectval.join(',');
                                            }
                                            if(preftext!=''){
                                                preftext=preftext+',';
                                            }
                                            var preftext1=preftext+selectval1;
                                                
                                           
                            var addon=new Array();
                            if($('.addo_each_menu_div').is(':visible')) {
                               $(".addo_each_menu_div").each(function() {
                                   var addon_menuid=$(this).find('.addonmenu').attr('id').split('_');
                                   var addon_slno=$(this).find('.addonmenu').attr('addon_slno');
                                   var addon_menurate=parseFloat($(this).find('#addonrate_'+$.trim(addon_menuid[1])).text().replace(',',''));
                                   var addon_menuqty=$(this).find('#addonqty_'+$.trim(addon_menuid[1])).val();

                                   
                                     addon.push({
                                        'menu_id':$.trim(addon_menuid[1]),
                                        'menu_slno':addon_slno,
                                        'menu_rate':addon_menurate,
                                        'menu_qty':addon_menuqty,
                                      });
                                  
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
                                        
					   var data = {
						  "action": "update1",
                                                  "portion": por,
						  "menuid" :document.getElementById("idofmenu").value,
                                                  "floorid": $('#idofmenu').attr('floorid'),
                                                  "branchid": document.getElementById("branch_id").value,
						  "slno": sl_no, 
                                                  "qty" :qty,
                                                  "final1":rate,
                                                   "pref_text" :preftext1,
                                                   "manual_rate" :$('#rate_value').val(),
                                                   "manualrate_entry" :$('#rate_value').attr('manualrate'),
                                                   "ratetype"  :portion_or_unit,
                                                  "unittype":packet_or_loose,
                                                  "unitweight":unitweight,
                                                  "baseunitweight":baseunitweight,
                                                  "unitid":unitid,
                                                  "baseunitid":baseunitid,
                                                  "addon":addon1,
                                                  "pref_ids":pref_ids
						  
						};
                                                 
					data = $(this).serialize() + "&" + $.param(data);
                                         
					var request= 	$.ajax({
						  type: "POST",
						  dataType: "json",
						  url: "response.php", 
						  data: data,
						  success: function(datas) { 
                                                      
							 var obj = JSON.parse(datas["json"]);
							 var last=obj.msg;
							// alert(last);
							 if(last=="sorry")
							 {
								checkinsert="ok";
								
							 }
						  }
						});
						$.ajaxSetup({cache: false});
						data = null;
						request.onreadystatechange = null;
						request.abort = null;
						request = null;
				   function checkins1(val){
				   
					var data1 = {
						  "action": val,
						  "tableid" :document.getElementById("table_id").value,
						  "floorid": document.getElementById("floor_id").value,
						  "stewardid" : document.getElementById("steward_id").value,
						  "orderid": document.getElementById("order_id").value,
						  "branchid" :document.getElementById("branch_id").value
						};
						data1 = $(this).serialize() + "&" + $.param(data1);
						var hidtableordernentry_updated = $("#hidtableordernentry_updated").val();
							var hidtableordernentry_success = $("#hidtableordernentry_success").val();
							var hidtableordernentry_rate = $("#hidtableordernentry_rate").val();
							var hidtableordernentry_billed = $("#hidtableordernentry_billed").val();
						var request=$.ajax({
						  type: "POST",
						  dataType: "text",
						  url: "response.php", 
						  data: data1,
						  success: function(data) { 
							  var res=data.trim(); alert(res);
							  $(".md-close").click();
							  $("#calc_value").text('');
							  $(".position_mn_cc_focus>.portion_view_btn").text('');
							  $("#portion_value").text('');
							  $(".position_mn_cc>li>a.position_mn_cc_focus").removeClass("position_mn_cc_focus");
							  $('.portion_view_btn').text('');
							  $("#calc_value").text('');
							  $('.caclulator_btn').removeClass("caclulator_btn_active");
							  $('.confirmallfdetails').css("display","block");
							  
							  
							  $(".loaderror").css("display","block");
							  $(".loaderror").addClass("popup_validate");
							 if(res=="Item updated")
							  { $(".loaderror").text(hidtableordernentry_updated);
							  }else  if(res=="Item Added Sucessfully")
							  { $(".loaderror").text(hidtableordernentry_success);
							  }else if(res=="Item Not added- Rate 0")
							  { $(".loaderror").text(hidtableordernentry_rate);
							  }else if(res=="Order Already Billed")
							  { $(".loaderror").text(hidtableordernentry_billed);
							  }
							  $('.loaderror').delay(2000).fadeOut('slow');
                                                          $('#popup_order_edit').css('pointer-events','inherit');
                                                           $('.ordelist_table').css("display","block");
                                                            $('.ordelist_table').load('viewitems.php');
						  }
						});
						return  res;
						data = null;
						data1 = null;
						request.onreadystatechange = null;
						request.abort = null;
						request = null;
						
			}
                           $(".olddiv").removeClass("new_overlay"); 
			   $('.mynewpopupload').empty();
			   $('.mynewpopupload').css("display","none");
		}
			
                        
		  }
			}else
			{
			     var popup_addrate=$('#popup_addrate').val();
				$(".loaderrpop").css("display","block"); 
				$(".loaderrpop").addClass("popup_validate");
			 	$(".loaderrpop").text(popup_addrate);
				$('.loaderrpop').delay(2000).fadeOut('slow');
                                $('#popup_order_edit').css('pointer-events','inherit');
			} 
                        }  
                         
                    
		  $('.ordelist_table').css("display","block");
		  $('.ordelist_table').load('viewitems.php');
		  return true;
    }
                 
            $('.ordelist_table').css("display","block");
            $('.ordelist_table').load('viewitems.php');       
		  
                  
       }else{
                        $('.alert_error_popup_all_in_one').show();
                        
                        $('.alert_error_popup_all_in_one').css('z-index', '9999999');
                        
                        $('.alert_error_popup_all_in_one').text('NO STOCK IN INVENTORY');
                       
                        $('.alert_error_popup_all_in_one').delay(1000).fadeOut('slow');  
            
  }
                          
  }
  });            
                  
                  
 });
                
                
                
                

});



    function ratecalculation(prtnid){
     
      var qty_test=$('#portionqty_'+prtnid).val(); 
      var result  = /^[0-9]+$/.test(qty_test);
      if(!result){
       $('#portionqty_'+prtnid).val($.trim($('#portionqty_'+prtnid).val()).slice(0, -1));
      }
        var decimal=$("#decimal").val();
        var portion_rate='';
        var quantity=$('#portionqty_'+prtnid).val();
        //alert($('#rate_value').attr('manualrate'));
        if($('#rate_value').attr('manualrate')=='Y'){
            //alert('1');
            if($('#rate_value').val()!=''){
                //alert('2');
                portion_rate=$('#rate_value').val();
            }
            else{
                //alert('3');
                portion_rate=0;
            }
        }
        else if($('#rate_value').attr('manualrate')=='N'){
            //alert('4')
            portion_rate=$('#portionrate_'+prtnid).text().replace(',','');
        }
        //alert(quantity);
        //alert(portion_rate);
        var total_rate=parseFloat(quantity)*parseFloat(portion_rate);
        //alert(total_rate);
        if(quantity!="" && quantity>0){
            $('#load_portionrate').text((total_rate).toFixed(decimal));
        }else{
            $('#load_portionrate').text((0).toFixed(decimal)); 
        }
    }