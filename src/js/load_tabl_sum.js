// JavaScript Document
$(document).ready(function(){
    
    
   var pole_on=$('#pole_on').val();
   
   if(pole_on=='Y'){
       
                        setTimeout(function () {
                            
                        var data_pole = "set_pole=pole_display_all&display=none";
			$.ajax({
			type: "POST",
			url: "index.php",
			data: data_pole,
			success: function(data5) {
			
			}
			});
                      
                        }, 7000);
    }                
                        
    $(".pin_close").click(function(){
     
           $('#copop').show();
	   $(".split_permission").hide();  
           $(".confrmation_overlay_new").hide();
           $(".pin_proceed").removeClass('bill_reprtint_from_front');
           $(".pin_proceed").removeClass('bill_regenerate_from_front');
           $('.confrmation_overlay_reprint').css('display','none');
           $(".table_chaange_pop").hide();
             $(".kotcancel_reason_popup_new_head").text('Order Split Authorization');
             $('.confrmation_overlay_settle').hide();
             $('.settle_auth').hide();
             
            $('#cash').click();
             
             
  });            
                        
    
    
    $(".pin_close_pay").click(function(){
         
         
	   $(".split_permission").hide();  
           $(".confrmation_overlay_new").hide();
           $(".pin_proceed").removeClass('bill_reprtint_from_front');
           $(".pin_proceed").removeClass('bill_regenerate_from_front');
           $('.confrmation_overlay_reprint').css('display','none');
            $('.auth_popup_payment').css('display','none');
            $('#cash').click();
           
  }); 
    
    
    $('#pin_pay').keypress(function(ev){
         
             if(ev.keyCode == 13){
             ev.stopImmediatePropagation();
             $('.pin_proceed_pay').trigger('click');
            }
   });
    
    
    
    $('#pin_split').keypress(function(ev){
      
             if(ev.keyCode == 13){
             ev.stopImmediatePropagation();
             $('.pin_proceed').trigger('click');
            }
   });
        
    $('#pin_table').keypress(function(ev){
    
             if(ev.keyCode == 13){
             ev.stopImmediatePropagation();
             $('.table_change_go').trigger('click');
            }
   });
   
    
    $('.table_change_close').click(function(event) {
          $('.table_chaange_pop').hide();
              $('.confrmation_overlay').hide();
             
      });
      
      
       $('.table_change_go').click(function(event) {
           
            var pin=$('#pin_table').val();
            if(pin!=''){
            
            $.post("load_div.php", {pin:pin,type:'authpincheck',set:'pincheck'},
                    function(data)
                    { 
                   
                        data=$.trim(data);
                        var staff_sl=data.split('*');
                        
     var staff_log=staff_sl[13].split(':');
     
   
                        if(data!="NO")
                        { 
                            if($.trim(staff_sl[12])=='change_table:Y'){

             $('.table_chaange_pop').hide();
              $('.confrmation_overlay').hide();
              
                          document.getElementById('popDiv').style.display = 'block';  
                        
                          var dataString_log ='value=pin_log&staff='+staff_log[1]+"&type=table_change";
                                $.ajax({
                                    type: "POST",
                                    url: "load_div.php",
                                    data: dataString_log,
                                    success: function(data) {
                                    }
                                });
                          
                          
                          
                               }else{
                               $("#pin_error_table").css("display","block");
                               $("#pin_error_table").text("No Permission For Table Change");
                               $("#pin_error_table").delay(2000).fadeOut('slow');
                               $("#pin_table").val('');
                                $("#pin_table").focus();
                               }
                        }
                        else{
                            $("#pin_error_table").css("display","block");
                            $("#pin_error_table").text("CODE IS NOT REGISTERED !");
                            $("#pin_error_table").delay(2000).fadeOut('slow');
                            $("#pin_table").val('');
                             $("#pin_table").focus();
                        }
                    });
                }else{
                        $("#pin_error_table").css("display","block");
			$("#pin_error_table").text("ENTER YOUR PIN");
			$("#pin_error_table").delay(2000).fadeOut('slow');
                         $("#pin_table").focus();
                        }
         
      });
      
      
      
      
      
      
      
	/***************************************  table selection  starts ******************************************************************  */
	/***$('.center_cc_btn li a').on('click',  function(event, ui) {
	//$('.center_cc_btn li a').click(function (e) {
			  /*single selection*/
			  //alert("tbl");
			   //event.preventDefault();
			   //event.stopImmediatePropagation();****/
			/**** if ($(this).hasClass('table_select'))
			  {
				   $(this).removeClass('table_select'); 
			  }else
			  {
					$(this).addClass('table_select');
			  }
				  var selected_activities =$('.table_select');
				  var ids = new Array();
				  selected_activities.each(function(){
						var id_str   =  $(this).attr("title");
						var id_arr	  =	 id_str.split("_");
						var selval       =  id_arr[1];
					  if(selval!='undefined' && selval!='' && selval!=null){
						  ids.push(selval);
					  }
					});
				$.post("load_div.php", {tableid:ids,set:'tableselectionauto'},
				function(data)
				{
				data=$.trim(data);
				});
				
		});******/
                
             
    
    $(".dbl_click1").dblclick(function(e){
        
        
        e.stopImmediatePropagation();
        
           var green_order= $(this).attr('ordrd');
          
          if(green_order=='undefined' || green_order==undefined || green_order=='' ){
              
                $('.change_table_btn').addClass('disablegenerate');
                
                $('.confrmation_overlay_proce_load').css('display','block');
                $('#bill_print_loader_new').html('<img src="img/ajax-loaders/pls_wait.gif" />');
               
                        $(this).addClass('table_select'); 
           
                        var selected_activities =$('.table_select');
                        var ids = new Array();
                        var asci=new Array();
                        selected_activities.each(function(){
                                  var id_str   =  $(this).attr("title");
                                  var id_arr	  =	 id_str.split("_");
                                  var selval       =  id_arr[1];
                                  if(selval!='undefined' && selval!='' && selval!=null){
                                    ids.push(selval);
                                  }
                                   var as_str   =  $(this).attr("asval");
                                   var as_arr	  =	 as_str.split("_");
                                   var selas       =  as_arr[1];
                                   if(selas!='undefined' && selas!='' && selas!=null){
                                   asci.push(selas);
                                }
           });
           
         
        var steward1=$('#stewardsel').val();
        var pr=$(this).attr('person_dbl');
            
       
    if(ids!=''){ 
     
              $.post("load_div.php", {tableid:ids,steward:steward1,persons:pr,type:'single',set:'takeorder'},
              function(data)
                { 
                   
                   if(steward1!='' && steward1!='null' && steward1!=null){
                       
                     window.location="menu_order.php?tableid="+ids+"&staffid="+steward1+"&asciival="+asci;      
                     
                   }else{
                     
                     $('.loaderrorsel').css("display",'block');
		     $('.loaderrorsel').addClass("tableselection_validate");
		     $('.loaderrorsel').text('SELECT STEWARD');
		     $('.loaderrorsel').delay(2000).fadeOut('slow');
                   }
                 
                });
            
        }else{
                           
                $('.loaderrorsel').css("display",'block');
		$('.loaderrorsel').addClass("tableselection_validate");
		$('.loaderrorsel').text('DOUBLE CLICK INACTIVE ');
		$('.loaderrorsel').delay(2000).fadeOut('slow');
                
        }
                    
         }else{
                $('.confrmation_overlay_proce_load').css('display','block');
                $('#bill_print_loader_new').html('<img src="img/ajax-loaders/pls_wait.gif" />');
            
                var steward=$('#stewardsel').val();
            
                var   orderid=   green_order.split('my_');   
                
                
                
                window.location="menu_order.php?orderid="+orderid[1]+"&staffid="+steward;       
                        
       }
});
    
                
      var doubleClicked = false;
    
      $('.center_cc_btn li a').on('click',  function(event, ui) {
     
          if (doubleClicked) {
       
          var green_order= $(this).attr('ordrd');
         
          if(green_order=='undefined' || green_order==undefined || green_order=='' ){
              
                        $('.change_table_btn').addClass('disablegenerate');
                
                        $(this).addClass('table_select'); 
           
                        var selected_activities =$('.table_select');
                        var ids = new Array();
                        var asci=new Array();
                        selected_activities.each(function(){
                            
                                  var id_str   =  $(this).attr("title");
                                  var id_arr	  =	 id_str.split("_");
                                  var selval       =  id_arr[1];
                                  if(selval!='undefined' && selval!='' && selval!=null){
                                    ids.push(selval);
                                  }
                                   var as_str   =  $(this).attr("asval");
                                   var as_arr	  =	 as_str.split("_");
                                   var selas       =  as_arr[1];
                                   if(selas!='undefined' && selas!='' && selas!=null){
                                   asci.push(selas);
                                }
           });
           
         
        var steward1=$('#stewardsel').val();
        var pr=$(this).attr('person_dbl');
            
       
          if(ids!=''){ 
              
                 $('.confrmation_overlay_proce_load').css('display','block');
                 $('#bill_print_loader_new').html('<img src="img/ajax-loaders/pls_wait.gif" />');
     
              $.post("load_div.php", {tableid:ids,steward:steward1,persons:pr,type:'single',set:'takeorder'},
              function(data)
                { 
                   
                   
                   $('.confrmation_overlay_proce_load').css('display','none');
                 //  window.location="menu_order.php?tableid="+ids+"&staffid="+steward1+"&asciival="+asci;  
                 
                   if(steward1!='' && steward1!='null' && steward1!=null){
                       window.location.replace("menu_order.php?tableid="+ids+"&staffid="+steward1+"&asciival="+asci);
                   }else{
                     
                     $('.loaderrorsel').css("display",'block');
		     $('.loaderrorsel').addClass("tableselection_validate");
		     $('.loaderrorsel').text('SELECT STEWARD');
		     $('.loaderrorsel').delay(2000).fadeOut('slow');
                   }
                   
                   
                });
            
        }else{
                           
                $('.loaderrorsel').css("display",'block');
		$('.loaderrorsel').addClass("tableselection_validate");
		$('.loaderrorsel').text('DOUBLE CLICK INACTIVE ');
		$('.loaderrorsel').delay(2000).fadeOut('slow');
                
        }
                    
         }else{
             
                $('.confrmation_overlay_proce_load').css('display','block');
                $('#bill_print_loader_new').html('<img src="img/ajax-loaders/pls_wait.gif" />');
            
                var steward=$('#stewardsel').val();
            
                var   orderid=   green_order.split('my_');   
                
                if(steward!='' && steward!='null' && steward!=null){
                           window.location="menu_order.php?orderid="+orderid[1]+"&staffid="+steward;       
                  }else{
                      
                     $('.confrmation_overlay_proce_load').css('display','none');
                     $('.loaderrorsel').css("display",'block');
		     $('.loaderrorsel').addClass("tableselection_validate");
		     $('.loaderrorsel').text('SELECT STEWARD');
		     $('.loaderrorsel').delay(2000).fadeOut('slow');
                   }
                   
                   
          }
         
         
         
     }else{
         
                localStorage.clickcount=0;
               
                if (!$(this).hasClass('selectstafforedit')) {
                    
                var input = document.querySelector('.screen');
                input.innerHTML = '';
                $('#personscount').val(input.innerHTML);
                $('#personscount').focus();
                decimalAdded = false;
                $('#takorder').show(); 
                if ($(this).hasClass('table_select'))
	           {
                       
		    $(this).removeClass('table_select'); 
                    $('.selectstafforedit').removeClass('table_select');
                    $('.selectstafforedit').removeClass('allready');
                    $('#takorder').removeClass('orderedtable');
                 
                    var n = $( ".table_select" ).length;
                      
                    if(n==0){
                       $('#takorder').hide(); 
                    }
                     $( ".selectedtables" ).text( "Selected Table (" + n + ")");
	           }else
			{   
                            $('.print-button-table-sel').removeAttr('order');
                            $('.print-button-table-sel').removeAttr('floor');
                            $('.print-button-table-sel').hide();
                            $('#order_split_btn').hide();
                            $('.edit_pax_sec_rhgt').hide(); 
                            $('#kot_cancel_front').hide();
                            $('.di_loy_icon').hide();
                            $('#selected_table_for_bill_print').val('');
                            $.post("load_div.php", {set:'unsetonfloorselection'},
                                function(data)
                                {
                                    
                                data=$.trim(data);

                                });
                            
                            if(document.getElementById('tablebutton1').disabled  == false){
                            $(".line_higt_table_summ").removeClass('table_select');
                            }else{
                                   var n = $( ".table_select" ).length+1;
                                   $( ".selectedtables" ).text( "Selected Table (" + n + ")");
                                 }
        
					$(this).addClass('table_select');
                                        $('.selectstafforedit').removeClass('table_select');
                                        $('.selectstafforedit').removeClass('allready');
                                        $('#takorder').removeClass('orderedtable');
			}
                                  var n = $( ".table_select" ).length;
                                  $( ".selectedtables" ).text( "Selected Table (" + n + ")");
				  var selected_activities =$('.table_select');
				  var ids = new Array();
                                  var tablename11 = new Array();
				  selected_activities.each(function(){
						var id_str   =  $(this).attr("title");
						var id_arr	  =	 id_str.split("_");
						var selval       =  id_arr[1];
					  if(selval!='undefined' && selval!='' && selval!=null){
						  ids.push(selval);
					  }
                                          
                                        var id_str1   =  $(this).attr("tableno");

                                        if(id_str1!='undefined' && id_str1!='' && id_str1!=null){
                                            tablename11.push(id_str1);
                                        }  
                                          
                                          
                                          
					});
                                        
                    $.post("load_div.php", {tableid:ids[0],set:'search_table_loy'},
                    function(data){
                       
			data=$.trim(data);
                     
                        $('.customer_dtl_sec').html(data);
                    }); 
                                        
                                        
				$.post("load_div.php", {tableid:ids,set:'tableselectionauto',tablename:tablename11,qr_ord:''},
				function(data)
				{ 
				data=$.trim(data);
				});
                                
                  }else{
                                
                             
                  var id_str1   =  $(this).attr("tableno");
                                  
                   var match = id_str1.split(',');
    
                   var lt=(match.length)-1;
    
                   $( ".selectedtables" ).text( "Selected Table (" + lt + ")");
                      
                 }
             }     
             
             
        doubleClicked = true;
         setTimeout(function(){
            doubleClicked = false;
        }, 250);
             
             
             
				
  });
                
    $('.tablecamp').click(function(){
        
       
        $('.print-button-table-sel').removeAttr('order');
        $('.selectstafforedit').removeClass('table_select');
        $('.line_higt_table_summ').removeClass('table_select');
        $('.selectstafforedit').removeClass('allready');
        
        var selected_activities =$('.table_select');
        var ids = new Array();
        selected_activities.each(function(){
            var id_str   =  $(this).attr("title");
            var id_arr	  =	 id_str.split("_");
            var selval       =  id_arr[1];
		if(selval!='undefined' && selval!='' && selval!=null){
		    ids.push(selval);
		}
	    });
            
	    $.post("load_div.php", {tableid:ids,set:'tableselectionauto'},
	    function(data)
	    {
               $('.line_higt_table_summ').removeClass('table_select');    
				
	    });     
                                                        

       $( ".selectedtables" ).text( "Selected Table (" + 0 + ")");
       $('.line_higt_table_summ').removeClass('table_select'); 
       $(".tablecamp1").css("display","block");
       $(".tablecamp").css("display","none");

    });
    

    $('.tablecamp1').click(function(){
        
      
        $('#takorder').removeClass('orderedtable');
        $('#selected_table_for_bill_print').val('');
        $('.print-button-table-sel').removeAttr('order');
        $('.print-button-table-sel').removeAttr('floor');
        $('.selectstafforedit').removeClass('table_select');
        $('.line_higt_table_summ').removeClass('table_select');
        $('.selectstafforedit').removeClass('allready'); 
            
          var selected_activities =$('.table_select');
          var ids = new Array();
          selected_activities.each(function(){
              
            var id_str   =  $(this).attr("title");
            var id_arr	  =	 id_str.split("_");
            var selval       =  id_arr[1];
	    if(selval!='undefined' && selval!='' && selval!=null){
		    ids.push(selval);
	    }
	    });
            
		$.post("load_div.php", {tableid:ids,set:'tableselectionauto'},
		function(data)
		{
                    $('.line_higt_table_summ').removeClass('table_select');    
				
		});

       $(".selectedtables" ).text( "Selected Table (" + 0 + ")");
       $('.line_higt_table_summ').removeClass('table_select');
       $(".tablecamp").css("display","block");
       $(".tablecamp1").css("display","none");
   
      });
      
   /*********************************end*********************/       

	/***************************************  floor selection  starts ************************************************************  */
	
	
		$('.table_floor_select_btn').bind("click",function (event) {
                   
			
		event.stopImmediatePropagation();
		$('.right_over_scroll').empty();
		$('.table_floor_select_btn').removeClass("table_floor_select_btn_act");
		
		$(this).addClass('table_floor_select_btn_act'); 
		var id_str   =  $(this).attr("id");
		var id_arr	  =	 id_str.split("_");
		var table_id       = id_arr[1];
                
                
		var selval       = "- " + id_arr[1];
		var tit_str   =  $(this).find("a").attr("title");
		$('#flrno').html(tit_str);	
		$('#load_tables').html('<img src="img/ajax-loaders/ajax-loader.gif" />');
		$('#load_tables').css("text-align","center");
	  	$('#load_tables').css("vertical-align","middle");
	    
		$('#load_tables').css("width","100%");
		$('#load_tables').css("height","100%");
		
		 $.post("load_div.php", {set:'unsetonfloorselection'},
			function(data)
			{
			data=$.trim(data);
																	  
			});
			data=null;
		  var data = {
			  "set": "summary",
			  "tab" :table_id
			};
			data = $(this).serialize() + "&" + $.param(data);
		 var request= $.ajax({
			  type: "POST",
			  dataType: "text",
			  url: "load_div.php", 
			  data: data,
			  success: function(data) {
				  
				 $('#load_tables').html(data);
				  $('#load_tables').css("text-align","center");
				  $('#load_tables').css("display","inherit");	
				  $('#load_tables').css("width","auto");	
				  $('#load_tables').css("height","inherit");
				  $('#load_tables').css("float","none");	
				  
				  $('#loadfromtable').load('load_div.php?set=fromtable');
			  	$('#loadtotable').load('load_div.php?set=totable');
			  }
			});
		  
               $('#load_order_count').load('load_div.php?set=load_order_count&floor_id='+table_id);   
                  
                  
			data = null;
			request.onreadystatechange = null;
			request.abort = null;
			request = null;	
			
			 
			return false;
	 });
	/***************************************  floor selection ends ************************************************************  */ 
   
    
    
	/***************************************  check staff selected on edit  starts *****************************************  */
	$('.selectstafforedit').click(function () { 
            
            
             var ids = new Array();
                    
                        var id_str   =  $(this).attr("title");
                        var id_arr	  =	 id_str.split("_");
                        var selval       =  id_arr[1];
                        if(selval!='undefined' && selval!='' && selval!=null){
                            ids.push(selval);
			}
                        var tablename11 = new Array();
                        var id_str1='';
                        
                        var id_str11   =  $(this).attr("tableno");
                        
                        var id_str1=id_str11.split(',');
                       
                       
                        for(var i=0;i<(id_str1.length);i++){
                            
                        if(id_str1[i]!='undefined' && id_str1[i]!='' && id_str1[i]!=null){
                            tablename11.push(id_str1[i]);
			}
                    }
                
                
                
                
                 var current_floor=$('.table_floor_select_btn_act').attr('fl_id_change');
                 
                 $.post("load_div.php", {tableid:ids[0],set:'search_table_loy',floor_loy:current_floor},
                    function(data){
                       
			data=$.trim(data);
                       
                        $('.customer_dtl_sec').html(data);
                        
                    });
            
            
            
            
            $('#takorder').show();
            if(document.getElementById('tablebutton1').disabled  == true){
               
                if($(this).hasClass('table_select allready')){
                    
                    $(this).removeClass('table_select allready');
                    var selected_tables=$('#selected_table_for_bill_print').val();
                  
                    var id_str11   =  $(this).attr("tableno");
                        var id_str1=id_str11.split(',');
                        for(var i=0;i<(id_str1.length);i++){
                            if(id_str1[i]!='undefined' && id_str1[i]!='' && id_str1[i]!=null){
                                if(selected_tables.includes(id_str1[i])){
                                var new_selected_tables=    selected_tables.replace(id_str1[i],'');
                                    
                                }
                            }
                        }
                        $('#selected_table_for_bill_print').val(new_selected_tables);
                     
                        var tablename11=new Array();
                        var id_str1=new_selected_tables.split(',');
                        for(var i=0;i<(id_str1.length);i++){
                            if(id_str1[i]!='undefined' && id_str1[i]!='' && id_str1[i]!=null){
                                tablename11.push(id_str1[i]);
                            }
                        }
                        
                        var order_of_selected_table= $(this).attr('ordrd').split('_');
                        
                            if(order_of_selected_table[1]!='undefined' && order_of_selected_table[1]!='' && order_of_selected_table[1]!=null){
                                if($('.print-button-table-sel').attr('order').includes(order_of_selected_table[1])){
                                var neworderid2=  $('.print-button-table-sel').attr('order').replace(order_of_selected_table[1],'');
                                $('.print-button-table-sel').attr('order',neworderid2);
                                }
                            }
                        
                            
                        var order_of_selected_table1= $('.print-button-table-sel').attr('order').split('_');
                        
                       
                        if(typeof($('.print-button-table-sel').attr('order'))!=typeof undefined){
                           
                        var neworderid1=$('.print-button-table-sel').attr('order').split('_');
                        
                        var v=0;
                        var neworderid11=neworderid1[1].split(',');
                           for(var w=0;w<neworderid11.length;w++){
                              
                                 if(neworderid11[w]!='undefined' && neworderid11[w]!='' && neworderid11[w]!=null){
                               v++;
                                 }
                               
                           }
                        
                       
                       
                            if(v>1){
                           
                                $('#takorder').hide();
                            }
                        
                        else if(v==1){
                           
                            
                            $('#takorder').show();
                        }
                        else if(v==0){
                            $('#takorder').hide();
                            $('.print-button-table-sel').hide();
                              $('#order_split_btn').hide();
                               $('.edit_pax_sec_rhgt').hide();
                               $('#kot_cancel_front').hide();
                                $('.di_loy_icon').hide();
                           $('.print-button-table-sel').removeAttr('order');
                            $('.print-button-table-sel').removeAttr('floor'); 
                        }
                        
                    }
                  
                }
                else{
                    
                $(this).addClass('table_select');
                $(this).addClass('allready');
                
                if(!$('#takorder').hasClass('orderedtable')){
                    $('#takorder').addClass('orderedtable');
                }
                if($(this).hasClass('print_bill_from_table')){
                    $('.print-button-table-sel').show();
                   $('#order_split_btn').show();   
                    $('.edit_pax_sec_rhgt').show();
                    $('#kot_cancel_front').show();
                     $('.di_loy_icon').show();
                    
                    
                    if(typeof($('.print-button-table-sel').attr('order'))==typeof undefined){
                        
                        
                        $('.print-button-table-sel').attr('order',$(this).attr('ordrd'));
                        $('.print-button-table-sel').attr('floor',$(this).attr('floor'));
                    }
                    else{
                       var neworderid=$(this).attr('ordrd').split('_');
                       if(neworderid.length>0){
                           $('#takorder').hide();
                       }
                       $('.print-button-table-sel').attr('order',$('.print-button-table-sel').attr('order')+','+neworderid[1]);
                    }
                        
                        var ids = new Array();
                        var tablename11= new Array();
                        var id_str   =  $(this).attr("title");
                        var id_arr	  =	 id_str.split("_");
                        var selval       =  id_arr[1];
                        if(selval!='undefined' && selval!='' && selval!=null){
                                  ids.push(selval);
                            }
                           
                            if($('#selected_table_for_bill_print').val()!=''){
                                
                                var previous_selected_tables=$('#selected_table_for_bill_print').val().split(',');
                                for(var s=0;s <previous_selected_tables.length;s++){
                                    if(previous_selected_tables[s]!='undefined' && previous_selected_tables[s]!='' && previous_selected_tables[s]!=null){
                                        tablename11.push(previous_selected_tables[s]);
                                }
                                }
                               
                            }
                        var id_str11   =  $(this).attr("tableno");
                        var id_str1=id_str11.split(',');
                        for(var i=0;i<(id_str1.length);i++){
                            if(id_str1[i]!='undefined' && id_str1[i]!='' && id_str1[i]!=null){
                                tablename11.push(id_str1[i]);
                            }
                        }
                        
                        $('#selected_table_for_bill_print').val(tablename11);     
                       
                }
                else {
                    
                    $('#takorder').show();
                    $(".tablecamp").css("display","block");
                    $(".tablecamp1").css("display","none");
                    document.getElementById('tablebutton1').disabled  = false;
                    
                    $('.selectstafforedit').removeClass('table_select');
                    $('.line_higt_table_summ').removeClass('table_select');
                    $('.selectstafforedit').removeClass('allready');
                    
                    $(this).addClass('table_select');
                    $(this).addClass('allready');
                    $('#takorder').addClass('orderedtable');
                      $('#order_split_btn').hide();
                       $('.edit_pax_sec_rhgt').hide();
                       $('#kot_cancel_front').hide();
                        $('.di_loy_icon').hide();
                    $('.print-button-table-sel').hide();
                    $('.print-button-table-sel').removeAttr('order');
                    $('.print-button-table-sel').removeAttr('floor');
                   
                        var ids = new Array();
                        var id_str   =  $(this).attr("title");
                        var id_arr	  =	 id_str.split("_");
                        var selval       =  id_arr[1];
                        if(selval!='undefined' && selval!='' && selval!=null){
                            ids.push(selval);
			}
                        var tablename11 = new Array();
                        var id_str1='';
                        
                        var id_str11   =  $(this).attr("tableno");
                        
                        var id_str1=id_str11.split(',');
                       
                       
                        for(var i=0;i<(id_str1.length);i++){
                            
                        if(id_str1[i]!='undefined' && id_str1[i]!='' && id_str1[i]!=null){
                            tablename11.push(id_str1[i]);
			}
                    }
                    $('#selected_table_for_bill_print').val('');
                    $.post("load_div.php", {set:'unsetonfloorselection'},
			function(data)
			{
                           
			data=$.trim(data);
																	  
			});
                    }
                }
            }
            else{
                if($(this).hasClass('table_select allready')){
                    $('#takorder').hide();
                    $('.print-table-btn').hide();
                    $('#order_split_btn').hide();
                     $('.edit_pax_sec_rhgt').hide();
                     $('#kot_cancel_front').hide();
                      $('.di_loy_icon').hide();
                    $(this).removeClass('table_select allready');
                    $('.print-button-table-sel').removeAttr('order');
                    $('.print-button-table-sel').removeAttr('floor');
                }
                else{
            $('#takorder').show();
             $('.print-table-btn').show();
             
                $('#order_split_btn').show();
                 $('.edit_pax_sec_rhgt').show();
                  $('.di_loy_icon').show();
                  
                  var ord_loy=$(this).attr('ordrd').split('my_');
                  $('.di_loy_icon').attr('order_no',ord_loy[1]);
                  
                  
                 $('#kot_cancel_front').show();
            $('.selectstafforedit').removeClass('table_select');
            $('.line_higt_table_summ').removeClass('table_select');
            $('.selectstafforedit').removeClass('allready'); 
                    $(this).addClass('table_select');
                    $(this).addClass('allready');
                    $('#takorder').addClass('orderedtable');
                    if($(this).hasClass('print_bill_from_table')){
                       $('#order_split_btn').show();
                        $('#kot_cancel_front').show();
                         $('.edit_pax_sec_rhgt').show();
                          $('.di_loy_icon').show();
                       $('.print-button-table-sel').show();
                       $('.print-button-table-sel').attr('order',$(this).attr('ordrd'));
                       $('.print-button-table-sel').attr('floor',$(this).attr('floor'));
                        
                        
                        
                    }
                   else{
                        $('.print-button-table-sel').removeAttr('order');
                       $('.print-button-table-sel').removeAttr('floor');
                       $('.print-button-table-sel').hide();
                       $('#order_split_btn').hide();
                        $('.edit_pax_sec_rhgt').hide();
                        $('#kot_cancel_front').hide();
                         $('.di_loy_icon').hide();
                    }
                    
                    var ids = new Array();
                    
                        var id_str   =  $(this).attr("title");
                        var id_arr	  =	 id_str.split("_");
                        var selval       =  id_arr[1];
                        if(selval!='undefined' && selval!='' && selval!=null){
                            ids.push(selval);
			}
                        var tablename11 = new Array();
                        var id_str1='';
                        
                        var id_str11   =  $(this).attr("tableno");
                        
                        var id_str1=id_str11.split(',');
                       
                       
                        for(var i=0;i<(id_str1.length);i++){
                            
                        if(id_str1[i]!='undefined' && id_str1[i]!='' && id_str1[i]!=null){
                            tablename11.push(id_str1[i]);
			}
                    }
                }
                
                }
                
                 var current_floor=$('.table_floor_select_btn_act').attr('fl_id_change');
                 
                 $.post("load_div.php", {tableid:ids[0],set:'search_table_loy',floor_loy:current_floor},
                    function(data){
                       
			data=$.trim(data);
                       
                        $('.customer_dtl_sec').html(data);
                        
                    });
                
                
                
                
                    $.post("load_div.php", {tableid:ids,set:'tableselectionauto',tablename:tablename11,qr_ord:''},
                    function(data){
                        
			data=$.trim(data);
                    });
                    
		
                $.post("load_div.php", {tableid:ids[0],set:'check_table_loy',floor_loy:current_floor},
                    function(data){
                     
			var datax=$.trim(data).split('*');
                       
                        $('#personscount').val(datax[0]);
                        
                        
                       if(datax[1]=='yes'){
                           
                           $('.di_loy_icon').hide();
                       }else{
                           
                           $('.di_loy_icon').show();
                       }
                    });
                    
                    
                   
                    
                    
                    var od_red=$(this).attr('ordrd').split('my_');
                    
                    if(ids[0]=='undefined' || ids[0]==undefined ){
                     
                     
                      $.post("load_div.php", {order:od_red[1],set:'search_table_red'},
                    function(datay){
                       
			datay=$.trim(datay);
                       
                        $('#personscount').val(datay[0]);
                        
                    });
                     
                     
                 }
                    
                    
		});
	/***************************************  check staff selected on edit ends     *********************************************  */ 
	
	/***************************************  reserve cancel starts ******************************************************************  */
	$('.cancelreservation').click(function () {
		var calcrese=$('#hidcaclresermsg').val();
		 $('.confirmationpop').css('display','block');
		 $('.confrmation_overlay').css('display','block');
		 $('.confirmationpop .content_pop').html(calcrese);
		 $('#hidcancelnumber').val($(this).attr("ordrd"));
		
	});
	/***************************************  reserve cancel ends  *********************************************  */ 
	
        
	/***************************************  reserve close starts ******************************************************************  */
	$('.closecancel').click(function () {
		$('.confirmationpop').css('display','none');
		$('.confrmation_overlay').css('display','none');
	
	});
	/***************************************  reserve close starts ******************************************************************  */
	/***************************************  reserve ok starts ******************************************************************  */
	$('.closeok').click(function () {
		var ids;
		var id_str   = $('#hidcancelnumber').val();
		var id_arr	  =	 id_str.split("_");
		var selval       =  id_arr[1];
		if(selval!='undefined' && selval!='' && selval!=null){
		  ids=(selval);
		}
		
		 $.post("load_div.php", {tableid:ids,set:'cancelreservation'},
		  function(data)
		  {
		  data=$.trim(data);
		  	if(data=="ok")
			{
				$('#load_tables').load('load_div.php?tab=&set=summary');
				 if($('#stewardsel').val()=="")
				 {
					$('#stewardsel').load('load_div.php?stafid=&set=staffatt');
				 }else
				 {
					 var stfid=$('#stewardsel').val();
					 $('#stewardsel').load('load_div.php?stafid='+stfid+'&set=staffatt');
				 }
			}
		  });
		  $('.confirmationpop').css('display','none');
		  $('.confrmation_overlay').css('display','none');
		   $('#loadfromtable').load('load_div.php?set=fromtable');
			  $('#loadtotable').load('load_div.php?set=totable');
	
	});
	/***************************************  reserve ok starts ******************************************************************  */
	/***************************************  disable starts ******************************************************************  */
	$('.clickdiableinuse').click(function () {
                var msg4 = ($("#msg4").val());
		$('.loaderrorsel').css("display",'block');
		$('.loaderrorsel').addClass("tableselection_validate");
		$('.loaderrorsel').text(msg4);
		$('.loaderrorsel').delay(2000).fadeOut('slow');
	});
	/***************************************  disable starts ******************************************************************  */
	/********************************************bill print from table selection starts ************************************************/
        
         $('.bill_print_auth').click(function (event) {
             event.stopImmediatePropagation();
             if($('#pop_head').text()=="Bill Print Authorization"){
         
            var pin= $('#pin').val();
                if(pin !=''){
                $.post("load_div.php", {set:'pincheck',pin:pin,type:'authpincheck'},
                function(data)
                {
                   if($.trim(data)!='NO'){
                    var check=$.trim(data).split('*');
                   
                    if(check[10]=="billprint:Y"){
            
          $('.bill_entry').hide();
          $('.confrmation_overlay').hide();
          
          var staff_log=check[13].split(':');
          
          
          var dataString_log ='value=pin_log&staff='+staff_log[1]+"&type=bill_print";
                                $.ajax({
                                    type: "POST",
                                    url: "load_div.php",
                                    data: dataString_log,
                                    success: function(data) {
                                    }
                                });
          
          
                if ( $( '.buttons_tab_active_2' ).hasClass( "table_select" ) ) {
               
                var ordno=$('.print-table-btn').attr('order');
               
                   var ordno1=ordno.split('_');
                  var ordno11= ordno1[1].split(',');
                 
                  var ordno_array=new Array();
                  for(var i=0;i<ordno11.length;i++){
                     
                      if(ordno11[i]!='' && !ordno_array.includes(ordno11[i]) ){
                           ordno_array.push(ordno11[i]);
                      }
                  }
                
                   var floor=$('.print-table-btn').attr('floor');
                   
                  var data = "ordno="+ordno_array+"&flooor="+floor+"&set=proceedbill";
                  var request= $.ajax({
			  type: "POST",
			  dataType: "text",
			  url: "load_print_bill_view.php", 
			  data: data,
			  success: function(data) {
			$('.print-bill-in-tableselection-popup-cc').css('display','block');
                        $('.print-bill-in-tableselection-popup-cc').html(data);
                          }
                          });
                     }else{
                              $('#alertdiv').show();
                              $('#alertdiv').text('Select Table To Print Bill ');
                               $('#alertdiv').delay(2000).fadeOut('slow');
                          }
                  }else{
                      $('#pin_error').css("display",'block');
                      $('#pin_error').text('No Permission');
                       $('#pin_error').delay(2000).fadeOut('slow');
                       $('#pin').val('');
                        $('#pin').focus();
                   }
                   
                    }
                   else{
                      $('#pin_error').css("display",'block');
                      $('#pin_error').text('Code Not Registered');
                       $('#pin_error').delay(2000).fadeOut('slow');
                       $('#pin').val('');
                        $('#pin').focus();
                   }
                 });  
                    
             }else{
                      $('#pin_error').css("display",'block');
                      $('#pin_error').text('ENTER PIN');
                       $('#pin_error').delay(2000).fadeOut('slow');
                       $('#pin').val('');
                        $('#pin').focus();
                   }
               }
             });
        
        
        
        $(".print-table-btn").click( function(event){
            
            var entry=$('#mode_of_entry').val();
            
            if(entry=="Card/Pin"){
               
            $('#bill_prnt_btn').show();
            $('#takeorder_btn').hide();
            $('#settle_prnt_btn').hide();
          $('.bill_entry').show();
          $('.confrmation_overlay').show();
          $('#pop_head').text('Bill Print Authorization');
          $('#pin').focus();
          $('#pin').val('');
            }else{
                if ( $( '.buttons_tab_active_2' ).hasClass( "table_select" ) ) {
                event.stopImmediatePropagation();
                var ordno=$(this).attr('order');
                
                   var ordno1=ordno.split('_');
                  var ordno11= ordno1[1].split(',');
                 
                  var ordno_array=new Array();
                  for(var i=0;i<ordno11.length;i++){
                    
                      if(ordno11[i]!='' && !ordno_array.includes(ordno11[i]) ){
                           ordno_array.push(ordno11[i]);
                      }
                  }
                  
                   var floor=$(this).attr('floor');
 
                    var data = "ordno="+ordno_array+"&flooor="+floor+"&set=proceedbill";
                   
                        var request= $.ajax({
			  type: "POST",
			  dataType: "text",
			  url: "load_print_bill_view.php", 
			  data: data,
			  success: function(data) {
				  
                                
                                $('.print-bill-in-tableselection-popup-cc').css('display','block');
                                $('.print-bill-in-tableselection-popup-cc').html(data);
                                
                          }
                          
			  
			});
                     }else{
                              $('#alertdiv').show();
                              $('#alertdiv').text('Select Table To Print Bill ');
                               $('#alertdiv').delay(2000).fadeOut('slow');
                          }     
            }
          });
          
   $(".print-bill-popup-close").click( function(){
                      
                      $.post("load_div.php", {tableid:'',set:'tableselectionauto',tablename:'',qr_ord:''});
                      $('.print-table-btn').removeAttr('order');
                      $('.print-table-btn').removeAttr('floor');
                       $('.print_bill_details_from_tablesel').val('');
                      $('.print-bill-in-tableselection-popup-cc').css('display','none');
                    
                      
    }); 
          
         
      $('#no_print_di_new').unbind().click(function(event){
          
          
          
          var  dataString1 = 'set=set_print_option_di&print_option=N' ;
                      
		$.ajax({
		type: "POST",
		url: "load_index.php",
		data: dataString1,
		success: function(data) {
                    
                
          var flr_id=	$('#floor_id').val();
          var Bill_print = "Bill_print";
          $.post("printercheck_1.php", {type:Bill_print,floor:flr_id},
                                               
            function(data)
            { 
            data=$.trim(data); 
           
            if(data !='')
            { 
                                            
               $('.kotconfirmpopup').css('display','block');   
              $('#kotfailmsg').html(data);
               $(".confrmation_overlay_2nd").css("display","block");                              
                                          
            }
            else{
                
                 if ( $( '.buttons_tab_active_2' ).hasClass( "table_select" ) ) {
                
                $('#print_bill_from_tablesel').css('pointer-events','none');
                event.stopImmediatePropagation();
               
                
                var discount_from_drop='';
                var type=''
                var discount_mode='';
                var orderno_from_tablesel=new Array();
                var tableno_from_tablesel1=new Array();
                var discount=0;
                var orderno_from_tablesel1=$('.print_bill_details_from_tablesel').attr('ordval').split(',');
               
                
                for(var j=0;j<orderno_from_tablesel1.length;j++){
                    if(orderno_from_tablesel1[j]!="" || orderno_from_tablesel1[j]!='undefined'){
                        orderno_from_tablesel.push(orderno_from_tablesel1[j]);
                    }
                }
               
              	var tableno_from_tablesel=$('.print_bill_details_from_tablesel').val().split(',');
                 
                for (var p=0;p<tableno_from_tablesel.length;p++){
                    
                    if(tableno_from_tablesel[p].length!=0 && tableno_from_tablesel[p]!='undefined'){
                        
                        tableno_from_tablesel1.push(tableno_from_tablesel[p]);
                    }
                }
                 
                
               var tb=tableno_from_tablesel1[0].split('(');
               var current_floor=$('.table_floor_select_btn_act').attr('fl_id_change'); 
               
             
            if($('#redeem_amount_total').text()!=""){
               var redeem_amount=$('#redeem_amount_total').text().replace(',','');
            }
            else{
                redeem_amount=0;
            }
            
            
            if($('#ly_number').val()!=""){
                                               
                                           var loyalty_id=$('#ly_id').val();
                                           var loyalty_billamount6=$('#subtotal_loy_org').val().replace(',','');
                                            var loyalty_billamount=loyalty_billamount6.replace(',','');
                                           var loyalty_billamount11=$('#subtotal_loy').text().replace(',','');
                                             var loyalty_billamount1=loyalty_billamount11.replace(',','');
                                           var lp_add=$('#point_rule_add').val();
                                           var lp_amt=$('#point_rule_add').attr('amt_add');
                                           var tot_point=parseFloat((loyalty_billamount1/lp_amt)*lp_add);
                                           var loyalty_pointredeem=parseFloat($('#redeem_point_total').text().replace(',',''));
                                           var loyalty_redeemamount=$('#redeem_amount_total').text().replace(',','');
                                           var loy_number=$('#ly_number').val();
                                           var loy_name=$('#ly_name').val();
                              
                               }else{
                                  tot_point=0;
                                  loyalty_pointredeem=0;
                                  loyalty_redeemamount=0;
                               }
       
    
     $.post("load_div.php", {tableid:tb[0],set:'delete_table_loy',floor_loy:current_floor},
                function(data){
                       
		data=$.trim(data);
                   
                var bill_loy=$.trim(data).split('*');
                
               if(bill_loy[0]!=''){
                   
                   var name_loy=bill_loy[0];
               }else{
                     var name_loy='';
               }
                
               if(bill_loy[1]!=''){
                     var num_loy=bill_loy[1];
               }else{
                     var num_loy='';
               }
               
               if(bill_loy[2]!=''){
                   var gst_loy=bill_loy[2];  
               }else{
                    var gst_loy=''; 
               }
                
    
                if($('#disountamount_drop').length || $('#disountamount').length){
                    
                    if($('#disountamount_drop').val()){
                        discount=$('#disountamount_drop').val();
                        type="drop";
                        discount_mode='';
                    }
                
                    else if($('#disountamount').val()){
                        discount=$('#disountamount').val();
                        type="text";
                        discount_mode=$('#discountmode').val();
                    }
                    
                    var data_passing={ tabname:tableno_from_tablesel1,tableid:'',prefx:'',discount:discount,disctype:discount_mode,loyalityid:'',type:type,ord:orderno_from_tablesel,billname:name_loy,billnum:num_loy,billgst:gst_loy,redeem_amount:redeem_amount,id_loy:loyalty_id,point_add:tot_point,point_redeem:loyalty_pointredeem,billamount:loyalty_billamount,redeemamount:loyalty_redeemamount,new_bill_amt:loyalty_billamount1,loy_number:loy_number,loy_name:loy_name,set:'proceedbill' };
                }
                else{
                    var data_passing={ tabname:tableno_from_tablesel1,tableid:'',prefx:'',discount:discount,disctype:discount_mode,loyalityid:'',ord:orderno_from_tablesel,billname:name_loy,billnum:num_loy,billgst:gst_loy,redeem_amount:redeem_amount,id_loy:loyalty_id,point_add:tot_point,point_redeem:loyalty_pointredeem,billamount:loyalty_billamount,redeemamount:loyalty_redeemamount,new_bill_amt:loyalty_billamount1,loy_number:loy_number,loy_name:loy_name,set:'proceedbill' };
                }
               
   
            
                
                $.post("load_completedorder.php", data_passing,
                function(data){  
                    
                    
                    $('.customer_dtl_sec').show();
                    $('.customer_set_data5').show();
                    $('.customer_set_data4').html('');
                    $('.customer_set_data5').show();
                    
                    $('.print-bill-in-tableselection-popup-cc').css('display','none');
                    $('.confrmation_overlay_proce_load').css('display','block');
                    $('#bill_print_loader_new').html('<img src="img/ajax-loaders/loader_print.gif" />');
                    
                setTimeout(function () {
                    
                     $('.confrmation_overlay_proce_load').css('display','none');
                     $('#bill_print_loader_new').hide();
                     $('#bill_print_loader_new').html('');
                     
               }, 1000);
           
                    
                    
                   
                    $.post("load_div.php", {tableid:'',set:'tableselectionauto',tablename:'',qr_ord:''});
                    
//                    $.post("print_details.php", {set:'billprint'},
//                    function(data1){
//                        
//                    });
                    
                    
                var  dataString1 = 'set=set_print_option_di&print_option=Y' ;
                      
		$.ajax({
		type: "POST",
		url: "load_index.php",
		data: dataString1,
		success: function(data) {
                    
                }
                });
                
                    
                     $('#takorder').show();
                    
                     $('.button').removeClass('table_select allready')
                     $('#takorder').css('display','none');
                     $('.print-table-btn').css('display','none');
                     $('#order_split_btn').hide();
                     $('.edit_pax_sec_rhgt').hide();
                     $('#kot_cancel_front').hide();
                     $('.di_loy_icon').hide();
                    
                     $(".tablecamp").css("display","block");
                     $(".tablecamp1").css("display","none");
                    
                        var data1=$.trim(data);
                        $('#alertdiv').css('display','block');
                        $('#alertdiv').text(data1);
                        $('#alertdiv').delay(2000).fadeOut('slow');
                    document.getElementById('tablebutton1').disabled  = false;
                    data=$.trim(data);
                   
                    
                
                });
                
                });
                
                if(tot_point>0 || loyalty_pointredeem>0 ){
                var data_passing1={ id_loy:loyalty_id,point_add:tot_point,point_redeem:loyalty_pointredeem,billamount:loyalty_billamount,redeemamount:loyalty_redeemamount,new_bill_amt:loyalty_billamount1,loy_number:loy_number,loy_name:loy_name,set:'msg_in_loyalty' };
                
                $.post("load_completedorder.php", data_passing1,
                function(data){
                    
                });
                }
                
            }else{
                              $('#alertdiv').show();
                              $('#alertdiv').text('Select Table To Print Bill ');
                              $('#alertdiv').delay(2000).fadeOut('slow');
            }
                
            }
        });
        
        
             
   }
   });
        
        
  });   
         
         
         
         
    $('#print_bill_from_tablesel').unbind().click(function(event){
           
         
          var flr_id=	$('#floor_id').val();
          var Bill_print = "Bill_print";
          $.post("printercheck_1.php", {type:Bill_print,floor:flr_id},
                                               
            function(data)
            { 
            data=$.trim(data); 
           
            if(data !='')
            { 
                                            
               $('.kotconfirmpopup').css('display','block');   
              $('#kotfailmsg').html(data);
               $(".confrmation_overlay_2nd").css("display","block");                              
                                          
            }
            else{
                
                 if ( $( '.buttons_tab_active_2' ).hasClass( "table_select" ) ) {
                
                $('#print_bill_from_tablesel').css('pointer-events','none');
                event.stopImmediatePropagation();
               
                
                var discount_from_drop='';
                var type=''
                var discount_mode='';
                var orderno_from_tablesel=new Array();
                var tableno_from_tablesel1=new Array();
                var discount=0;
                var orderno_from_tablesel1=$('.print_bill_details_from_tablesel').attr('ordval').split(',');
               
                
                for(var j=0;j<orderno_from_tablesel1.length;j++){
                    if(orderno_from_tablesel1[j]!="" || orderno_from_tablesel1[j]!='undefined'){
                        orderno_from_tablesel.push(orderno_from_tablesel1[j]);
                    }
                }
               
              	var tableno_from_tablesel=$('.print_bill_details_from_tablesel').val().split(',');
                 
                for (var p=0;p<tableno_from_tablesel.length;p++){
                    
                    if(tableno_from_tablesel[p].length!=0 && tableno_from_tablesel[p]!='undefined'){
                        
                        tableno_from_tablesel1.push(tableno_from_tablesel[p]);
                    }
                }
                 
                
               var tb=tableno_from_tablesel1[0].split('(');
               var current_floor=$('.table_floor_select_btn_act').attr('fl_id_change'); 
               
             
            if($('#redeem_amount_total').text()!=""){
               var redeem_amount=$('#redeem_amount_total').text().replace(',','');
            }
            else{
                redeem_amount=0;
            }
            
            
            if($('#ly_number').val()!=""){
                                               
                                           var loyalty_id=$('#ly_id').val();
                                           var loyalty_billamount6=$('#subtotal_loy_org').val().replace(',','');
                                            var loyalty_billamount=loyalty_billamount6.replace(',','');
                                           var loyalty_billamount11=$('#subtotal_loy').text().replace(',','');
                                             var loyalty_billamount1=loyalty_billamount11.replace(',','');
                                           var lp_add=$('#point_rule_add').val();
                                           var lp_amt=$('#point_rule_add').attr('amt_add');
                                           var tot_point=parseFloat((loyalty_billamount1/lp_amt)*lp_add);
                                           var loyalty_pointredeem=parseFloat($('#redeem_point_total').text().replace(',',''));
                                           var loyalty_redeemamount=$('#redeem_amount_total').text().replace(',','');
                                           var loy_number=$('#ly_number').val();
                                           var loy_name=$('#ly_name').val();
                              
                               }else{
                                  tot_point=0;
                                  loyalty_pointredeem=0;
                                  loyalty_redeemamount=0;
                               }
       
    
     $.post("load_div.php", {tableid:tb[0],set:'delete_table_loy',floor_loy:current_floor},
                function(data){
                       
		data=$.trim(data);
                   
                var bill_loy=$.trim(data).split('*');
                
               if(bill_loy[0]!=''){
                   
                   var name_loy=bill_loy[0];
               }else{
                     var name_loy='';
               }
                
               if(bill_loy[1]!=''){
                     var num_loy=bill_loy[1];
               }else{
                     var num_loy='';
               }
               
               if(bill_loy[2]!=''){
                   var gst_loy=bill_loy[2];  
               }else{
                    var gst_loy=''; 
               }
                
    
                if($('#disountamount_drop').length || $('#disountamount').length){
                    
                    if($('#disountamount_drop').val()){
                        discount=$('#disountamount_drop').val();
                        type="drop";
                        discount_mode='';
                    }
                
                    else if($('#disountamount').val()){
                        discount=$('#disountamount').val();
                        type="text";
                        discount_mode=$('#discountmode').val();
                    }
                    
                    var data_passing={ tabname:tableno_from_tablesel1,tableid:'',prefx:'',discount:discount,disctype:discount_mode,loyalityid:'',type:type,ord:orderno_from_tablesel,billname:name_loy,billnum:num_loy,billgst:gst_loy,redeem_amount:redeem_amount,id_loy:loyalty_id,point_add:tot_point,point_redeem:loyalty_pointredeem,billamount:loyalty_billamount,redeemamount:loyalty_redeemamount,new_bill_amt:loyalty_billamount1,loy_number:loy_number,loy_name:loy_name,set:'proceedbill' };
                }
                else{
                    var data_passing={ tabname:tableno_from_tablesel1,tableid:'',prefx:'',discount:discount,disctype:discount_mode,loyalityid:'',ord:orderno_from_tablesel,billname:name_loy,billnum:num_loy,billgst:gst_loy,redeem_amount:redeem_amount,id_loy:loyalty_id,point_add:tot_point,point_redeem:loyalty_pointredeem,billamount:loyalty_billamount,redeemamount:loyalty_redeemamount,new_bill_amt:loyalty_billamount1,loy_number:loy_number,loy_name:loy_name,set:'proceedbill' };
                }
               
     //   alert(discount); alert(discount_mode);
            
                
                $.post("load_completedorder.php", data_passing,
                function(data){  
                    
                    
                    $('.customer_dtl_sec').show();
                     $('.customer_set_data5').show();
                       $('.customer_set_data4').html('');
                     $('.customer_set_data5').show();
                    
                     $('.print-bill-in-tableselection-popup-cc').css('display','none');
                    $('.confrmation_overlay_proce_load').css('display','block');
                    $('#bill_print_loader_new').html('<img src="img/ajax-loaders/loader_print.gif" />');
                    
                     setTimeout(function () {
                  $('.confrmation_overlay_proce_load').css('display','none');
                   $('#bill_print_loader_new').hide();
                    $('#bill_print_loader_new').html('');
                }, 1000);
           
                    
                    
                   
                    $.post("load_div.php", {tableid:'',set:'tableselectionauto',tablename:'',qr_ord:''});
                    
                    $.post("print_details.php", {set:'billprint','ord':orderno_from_tablesel},
                    function(data1){
                        
			
                    });
                    
                    
                var  dataString1 = 'set=set_print_option_di&print_option=Y' ;
                      
		$.ajax({
		type: "POST",
		url: "load_index.php",
		data: dataString1,
		success: function(data) {
                    
                  
                    
                }
                });
                    
                     $('#takorder').show();
                    
                     $('.button').removeClass('table_select allready')
                     $('#takorder').css('display','none');
                     $('.print-table-btn').css('display','none');
                     $('#order_split_btn').hide();
                     $('.edit_pax_sec_rhgt').hide();
                     $('#kot_cancel_front').hide();
                     $('.di_loy_icon').hide();
                    
                    $(".tablecamp").css("display","block");
                    $(".tablecamp1").css("display","none");
                    
                        var data1=$.trim(data);
                        $('#alertdiv').css('display','block');
                        $('#alertdiv').text(data1);
                        $('#alertdiv').delay(2000).fadeOut('slow');
                    document.getElementById('tablebutton1').disabled  = false;
                    data=$.trim(data);
                   
                    
                
                });
                
                });
                
                
                if(tot_point>0 || loyalty_pointredeem>0 ){
                var data_passing1={ id_loy:loyalty_id,point_add:tot_point,point_redeem:loyalty_pointredeem,billamount:loyalty_billamount,redeemamount:loyalty_redeemamount,new_bill_amt:loyalty_billamount1,loy_number:loy_number,loy_name:loy_name,set:'msg_in_loyalty' };
                
                $.post("load_completedorder.php", data_passing1,
                function(data){
                    
                });
                      }
                
                }else{
                              $('#alertdiv').show();
                              $('#alertdiv').text('Select Table To Print Bill ');
                              $('#alertdiv').delay(2000).fadeOut('slow');
                }
                
            }
        });
          });
          
  $('.confirmbillclose').click(function(){
     
      $('.kotconfirmpopup').css('display','none');    
      $(".confrmation_overlay_2nd").css("display","none");
  });  
          
          
  $('.confirmbillok').unbind().click(function(){
            
                $('.confirmbillok').css('pointer-events','none');
               
                event.stopImmediatePropagation();
                var billname=$('#billname').val();
                var billnum=$('#billnum').val();
                var billgst=$('#billgst').val();
                if(!$('#billname').length){
                    var billname='';
                }
                if(!$('#billnum').length){
                    var billnum='';
                }
                if(!$('#billgst').length){
                    var billgst='';
                }
                var discount_from_drop='';
                var type=''
                var discount_mode='';
                var orderno_from_tablesel=new Array();
                var tableno_from_tablesel1=new Array();
                var discount=0;
                var orderno_from_tablesel1=$('.print_bill_details_from_tablesel').attr('ordval').split(',');
               
                
                for(var j=0;j<orderno_from_tablesel1.length;j++){
                    if(orderno_from_tablesel1[j]!="" || orderno_from_tablesel1[j]!='undefined'){
                        orderno_from_tablesel.push(orderno_from_tablesel1[j]);
                    }
                }
               
              	var tableno_from_tablesel=$('.print_bill_details_from_tablesel').val().split(',');
                
                for (var p=0;p<tableno_from_tablesel.length;p++){
                    
                    if(tableno_from_tablesel[p].length!=0 && tableno_from_tablesel[p]!='undefined'){
                        
                        tableno_from_tablesel1.push(tableno_from_tablesel[p]);
                    }
                }
                
                
                if($('#disountamount_drop').length || $('#disountamount').length){
                    
                    if($('#disountamount_drop').val()){
                        discount=$('#disountamount_drop').val();
                        type="drop";
                        discount_mode='';
                    }
                
                    else if($('#disountamount').val()){
                        discount=$('#disountamount').val();
                        type="text";
                        discount_mode=$('#discountmode').val();
                    }
                    
                    if($('#redeem_amount_total').text()!=""){
               var redeem_amount=$('#redeem_amount_total').text();
            }
            else{
                redeem_amount=0;
            }
                    
                         if($('#ly_number').val()!=""){
                                               
                                           var loyalty_id=$('#ly_id').val();
                                           var loyalty_billamount6=$('#subtotal_loy_org').val();
                                            var loyalty_billamount=loyalty_billamount6.replace(',','');
                                            
                                           var loyalty_billamount13=$('#subtotal_loy').text();
                                             var loyalty_billamount1=loyalty_billamount13.replace(',','');
                                           var lp_add=$('#point_rule_add').val();
                                           var lp_amt=$('#point_rule_add').attr('amt_add');
                                           var tot_point=parseFloat((loyalty_billamount1/lp_amt)*lp_add);
                                           var loyalty_pointredeem=parseFloat($('#redeem_point_total').text());
                                           var loyalty_redeemamount=$('#redeem_amount_total').text();
                                           var loy_number=$('#ly_number').val();
                                           var loy_name=$('#ly_name').val();
                              
                               }else{
                                  tot_point=0;
                                  loyalty_pointredeem=0;
                               }
                    
                    
                    var data_passing={ tabname:tableno_from_tablesel1,tableid:'',prefx:'',discount:discount,disctype:discount_mode,loyalityid:'',type:type,ord:orderno_from_tablesel,billname:billname,billnum:billnum,billgst:billgst,redeem_amount:redeem_amount,id_loy:loyalty_id,point_add:tot_point,point_redeem:loyalty_pointredeem,billamount:loyalty_billamount,redeemamount:loyalty_redeemamount,new_bill_amt:loyalty_billamount1,loy_number:loy_number,loy_name:loy_name,set:'proceedbill' };
                }
                else{
                    var data_passing={ tabname:tableno_from_tablesel1,tableid:'',prefx:'',discount:discount,disctype:discount_mode,loyalityid:'',ord:orderno_from_tablesel,billname:billname,billnum:billnum,billgst:billgst,redeem_amount:redeem_amount,id_loy:loyalty_id,point_add:tot_point,point_redeem:loyalty_pointredeem,billamount:loyalty_billamount,redeemamount:loyalty_redeemamount,new_bill_amt:loyalty_billamount1,loy_number:loy_number,loy_name:loy_name,set:'proceedbill' };
                }
                
                
             
                $.post("load_completedorder.php", data_passing,
                function(data){
                   
                    $('#takorder').show();
                    $('.print-bill-in-tableselection-popup-cc').css('display','none');
                    $('.button').removeClass('table_select allready')
                    $('#takorder').css('display','none');
                    $('.print-table-btn').css('display','none');
                    $('#order_split_btn').hide();
                     $('.edit_pax_sec_rhgt').hide();
                     $('#kot_cancel_front').hide();
                     $('.di_loy_icon').hide();
                    $.post("load_div.php", {tableid:'',set:'tableselectionauto',tablename:'',qr_ord:''});
                    
                    $(".tablecamp").css("display","block");
                    $(".tablecamp1").css("display","none");
                    
                        var data1=$.trim(data);
                        $('#alertdiv').css('display','block');
                        $('#alertdiv').text(data1);
                        $('#alertdiv').delay(2000).fadeOut('slow');
                    document.getElementById('tablebutton1').disabled  = false;
                    data=$.trim(data);
                    
                    $.post("print_details.php", {set:'billprint','ord':orderno_from_tablesel},
                    function(data1){
                      
			
                    });
                
                
                
                });
             
             
             if(tot_point>0 || loyalty_pointredeem>0 ){
                var data_passing1={ id_loy:loyalty_id,point_add:tot_point,point_redeem:loyalty_pointredeem,billamount:loyalty_billamount,redeemamount:loyalty_redeemamount,new_bill_amt:loyalty_billamount1,loy_number:loy_number,loy_name:loy_name,set:'msg_in_loyalty' };
                
                $.post("load_completedorder.php", data_passing1,
                function(data){
                    
                });
                      }
             
             
            });
          
        /********************************************bill print from table selection ends ************************************************/	
	
        $(".check_class").click(function() {
            
         $(".check_class").prop("checked",false); 
          $(this).prop("checked",true); 
          var ch_val=   $(this).val();
          if(ch_val=='manual'){
                $("#text_bill_split").val('');
                $("#text_bill_split").focus();
                 $("#text_bill_split").attr("placeholder", "No of Bills").placeholder();
                
          }else{
               $("#text_bill_split").val('');
                $("#text_bill_split").focus();
                $("#text_bill_split").attr("placeholder", "No of Bills").placeholder();
                
          }
   });
   
   
   $('.split_popup_right_num_pad').click(function(event) {
                event.stopImmediatePropagation();
                $('#focusedtext_split').val('text_bill_split');
		var focused=$('#focusedtext_split').val();
          
		var calval=($(this).text());
		var org=$('#'+focused).val();
             
		if(calval>=0)
		{   
                if(org.length < 2){
		if(org==0)
		{
		$('#'+focused).val(calval);
		}else if(org>0)
		{
		$('#'+focused).val(org+calval);
		}else if(org<0)
		{
		$('#'+focused).val(org+calval);
		}
                }
                }else if(calval==" CLEAR ")
		{
		$('#'+focused).val("");
		}
		$('#'+focused).change();
		$('#'+focused).focus();
		
	});
        
        
        
   //Bill Settlement from table selection page starts from here.
   //settlement Pop up display , validation ,reprint, regenertion and other functioning are also included in this section.
   // All are from here onwards
    
    
    
 /******************billed table click  ************/
   
 $('.billedclic').click(function (){ 
     
     
        var billedno=$(this).attr('billedno');
        
        if (billedno.indexOf(',') > -1)
           {
               var bill_new_one=billedno.split(',');
               var billedno1=bill_new_one[0];
             
         }else{
                 var billedno1=billedno; 
         }
           
           
           
    if($('#all_shift_closer').val()=='Y' || $('#shift_yes').val()=='N'){
      
        $('.counter_settle_popup_section_cont').show();
        $('#bill_settle_button').addClass('disablegenerate'); 
        
        
        $('#bill_settle_button').hide();
        
        $('#grandtotal').text('');
        $('#totaldisc').text('');
        $('#final').text('');
      
        
            var dataString_log ='action=billamount&billno='+billedno1;
            $.ajax({
            type: "POST",
            url: "settle_popup_front.php",
            data: dataString_log,
            success: function(billamount) { 
              
            var parsed_data=JSON.parse(billamount);
           
             $('#grandtotal').text(parsed_data['FINAL'].replace(",",''));
             $('#paidamount').val(parsed_data['FINAL'].replace(",",'')); 
             
              $('#bill_settle_button').removeClass('disablegenerate');
                
            if(parsed_data['FINAL'] !=''){  
               
               if(parsed_data['DISCOUNT_ITEM']>0){
                   
                  $('#dis_item_new').text(parsed_data['DISCOUNT_ITEM']);
                 
                  $('.dis_view2').show();
                  
             }else{
                 
                 $('#dis_item_new').text('0.000');  
                 $('.dis_view2').hide();
                 
             }
             
                $('#totaldisc').text(parsed_data['DISCOUNT']);
                $('#final').text(parsed_data['SUBTOTAL']);
              
                $('#tip_amount').val(parsed_data['TIP']);
              
                $('#balanceamout').val('0.000');
                $('#paidamount').select() ;
         
                if(parsed_data['DISCOUNT']>0){
                   
                   
                                            setTimeout(function(){
                
                                                  $('.dis_view1').show();
                   
                                                  var  dataString77 = 'set=discount_bill_format&billno='+billedno1+"&mode=DI";
                                                  $.ajax({
                                                   type: "POST",
                                                   url: "load_index.php",
                                                   data: dataString77,
                                                   success: function(data3) {
                                                     
                                                   var dis_ld= data3.trim().split(","); 
                                                      
                                                   if(dis_ld[1]!=''){
                                                       
                                                            $('#dis_details_new').text(dis_ld[0]+' ['+dis_ld[2]+' : '+dis_ld[1]+']');
                                                    }else{
                                                        
                                                            $('#dis_details_new').text('')  ;
                                                    }
                                                        
                                                    }
                                                });
                                                
                                                            $('#discount_after_bill_btn').hide();
                                                
                                                
                                                 }, 1500);  
                                                
                                            }else{
                                                
                                                  $('#dis_details_new').text('')  ;
                                                  $('.dis_view1').show();
                                                  $('#discount_after_bill_btn').show();
                                                  
                                            }
                                            
               
                 $.each( parsed_data['TAX'], function( key, value ){
                     
                      $("#taxdetails_div").append(
                        '<div style="width:100%; " class="lable_counter_paymnet_cc counter_right_lable" id='+value['ID']+'>'+key+
                        ':<span >'+value['AMOUNT']+
                        '</span></div>'
                    );
                });
                
                
                var pole_on=$('#pole_on').val();
                     
                if(pole_on=='Y'){
                         
                 var data_pole = 'set_pole=pole_display_all&pole_bill='+billedno+"&pole_amount="+parsed_data['FINAL']+"&display=show";
                 $.ajax({
			type: "POST",
			url: "index.php",
			data: data_pole,
			success: function(data5) {
			
			}
			});
                }
                     
                     
                
                }
            }
        });
        
         setTimeout(function(){
             
         
            var dataString_loy ='set=check_customer_di&billno='+billedno1;
            $.ajax({
            type: "POST",
            url: "load_div.php",
            data: dataString_loy,
            success: function(dataloy) {
               
                var det_loy=$.trim(dataloy).split('*');
                
                   if(det_loy[1]!=''){
                                                   
                              $('#num_sms_new').val(det_loy[1]);
                              $('#name_sms_new').val(det_loy[0]);
                                                    
                              $('#num_sms_new').prop('disabled',true);
                              $('#name_sms_new').prop('disabled',true);
                  } 
                
            }
        });
        
         }, 1500);  
        
        
        var bill_count=billedno.split(',');
         
        $('#settleingbilno').empty();
        
        for(var i=0;i<bill_count.length;i++){
            
            if(i==0){
                var selected="selected";
            }else{
                var selected='';
            }
            
         $('#settleingbilno').append("<option value='"+bill_count[i]+"'  "+selected+">"+bill_count[i]+"</option>" ); 
         
        }
        
        $('#auth_val_set').val('yes_auth_pop');
        $('#takorder').hide();
       
        $('#bill_settle_button').show();
        $("#taxdetails_div").empty();
          
        sessionStorage.currency_onoff=$('#currencyonoff').val();
        sessionStorage.base_currency=$('#base_currency').val();

        $('.view_items_btn').text('View Items');
        $('.pop_payment_mode_sel_btn:first').click();
        
        var cash_drawer_on_off=$('#cash_drawer_on_off').val();
  
        if(cash_drawer_on_off=='Y'){  
            
                        var dataString = 'set=drawer_open';
                         $.ajax({
                        type: "POST",
                        url: "cashdrawer_details.php",
                        data: dataString,
                        success: function(data3) {

                        }
                       });
       }        
       
          var crd_view= $('#credit_view_per').val();
          var comp_view= $('#comp_view_per').val();
          
          if(crd_view=="N"){
              
              $('#credit_person').hide();
          }
          
          if(comp_view=="N"){
              $('#complimentary').hide();
          }
            
            
            
            
        }else{
            
            $('.confrmation_overlay_proce_load').css('display','block');
            $('#bill_print_loader_new').html('<img src="img/ajax-loaders/pls_wait.gif" />');
            
            var dataStr ='set=check_sift&billno='+billedno1;
        
            $.ajax({
            type: "POST",
            url: "load_div.php",
            data: dataStr,
            success: function(datal) {  
               
            if($.trim(datal)=='yes'){
                    
                $('#grandtotal').text('');
                $('#totaldisc').text('');
                $('#final').text('');
              
        $('.counter_settle_popup_section_cont').show();
        
        var dataString_log ='action=billamount&billno='+billedno1;
        $.ajax({
            type: "POST",
            url: "settle_popup_front.php",
            data: dataString_log,
            success: function(billamount) { 
                
            $('.confrmation_overlay_proce_load').css('display','none');
            $('#bill_print_loader_new').html('');
                
            var parsed_data=JSON.parse(billamount);
                
            if(parsed_data['FINAL'] !=''){  
               
               if(parsed_data['DISCOUNT_ITEM']>0){
                   
                  $('#dis_item_new').text(parsed_data['DISCOUNT_ITEM']);
                 
                  $('.dis_view2').show();
                  
             }else{
                 
                 $('#dis_item_new').text('0.000');  
                 $('.dis_view2').show();
                 
             }
             
                $('#grandtotal').text(parsed_data['FINAL'].replace(",",''));
                
                $('#totaldisc').text(parsed_data['DISCOUNT']);
                $('#final').text(parsed_data['SUBTOTAL']);
              
                $('#tip_amount').val(parsed_data['TIP']);
              
                $('#paidamount').val(parsed_data['FINAL'].replace(",",''));
                $('#balanceamout').val('0.000');
                $('#paidamount').select() ;
         
                if(parsed_data['DISCOUNT']>0){
                   
                                                  $('.dis_view1').show();
                   
                                                  var  dataString77 = 'set=discount_bill_format&billno='+billedno1+"&mode=DI";
                                                  $.ajax({
                                                   type: "POST",
                                                   url: "load_index.php",
                                                   data: dataString77,
                                                   success: function(data3) {
                                                     
                                                   var dis_ld= data3.trim().split(","); 
                                                      
                                                   if(dis_ld[1]!=''){
                                                       
                                                            $('#dis_details_new').text(dis_ld[0]+' ['+dis_ld[2]+' : '+dis_ld[1]+']');
                                                    }else{
                                                        
                                                            $('#dis_details_new').text('')  ;
                                                    }
                                                        
                                                    }
                                                });
                                                
                                                $('#discount_after_bill_btn').hide();
                                                
                                            }else{
                                                
                                                  $('#dis_details_new').text('0')  ;
                                                  $('.dis_view1').show();
                                                  $('#discount_after_bill_btn').show();
                                                  
                                            }
               
                 $.each( parsed_data['TAX'], function( key, value ){
                     
                      $("#taxdetails_div").append(
                        '<div style="width:100%; " class="lable_counter_paymnet_cc counter_right_lable" id='+value['ID']+'>'+key+
                        ':<span >'+value['AMOUNT']+
                        '</span></div>'
                    );
                });
                
                
                 var pole_on=$('#pole_on').val();
                     
                 if(pole_on=='Y'){
                         
                 var data_pole = 'set_pole=pole_display_all&pole_bill='+billedno+"&pole_amount="+parsed_data['FINAL']+"&display=show";
                 $.ajax({
			type: "POST",
			url: "index.php",
			data: data_pole,
			success: function(data5) {
			
			}
			});
                     }
                
                }
            }
        });
        
        
        var dataString_loy ='set=check_customer_di&billno='+billedno1;
       $.ajax({
            type: "POST",
            url: "load_div.php",
            data: dataString_loy,
            success: function(dataloy) {
               
                var det_loy=$.trim(dataloy).split('*');
                
                   if(det_loy[1]!=''){
                                                   
                              $('#num_sms_new').val(det_loy[1]);
                              $('#name_sms_new').val(det_loy[0]);
                                                    
                              $('#num_sms_new').prop('disabled',true);
                              $('#name_sms_new').prop('disabled',true);
                  } 
                
            }
        });
        
        var bill_count=billedno.split(',');
         
        $('#settleingbilno').empty();
        
        for(var i=0;i<bill_count.length;i++){
            
            if(i==0){
                var selected="selected";
            }else{
                var selected='';
            }
            
         $('#settleingbilno').append("<option value='"+bill_count[i]+"'  "+selected+">"+bill_count[i]+"</option>" ); 
         
        }
        
        $('#auth_val_set').val('yes_auth_pop');
        $('#takorder').hide();
       
        $('#bill_settle_button').show();
        $("#taxdetails_div").empty();
        
              
        sessionStorage.currency_onoff=$('#currencyonoff').val();
        sessionStorage.base_currency=$('#base_currency').val();

        $('.view_items_btn').text('View Items');
        $('.pop_payment_mode_sel_btn:first').click();
        
        var cash_drawer_on_off=$('#cash_drawer_on_off').val();
  
        if(cash_drawer_on_off=='Y'){  
            
                        var dataString = 'set=drawer_open';
                         $.ajax({
                        type: "POST",
                        url: "cashdrawer_details.php",
                        data: dataString,
                        success: function(data3) {

                        }
                       });
       }        
       
          var crd_view= $('#credit_view_per').val();
          var comp_view= $('#comp_view_per').val();
          
          if(crd_view=="N"){
              
              $('#credit_person').hide();
          }
          
          if(comp_view=="N"){
              $('#complimentary').hide();
          }
      
       }else{
           
        $('.confrmation_overlay_proce_load').css('display','none');
        $('#bill_print_loader_new').html('');
        $('.alert_error_popup_all_in_one').show();
        $('.alert_error_popup_all_in_one').text('BILL ['+billedno1+'] IS NOT IN YOUR SHIFT');
        $('.alert_error_popup_all_in_one').delay(2000).fadeOut('slow');  
       
       }
       
       }
       });  
       
       }
        
  });
    
    /**********billed table click ends *************/
    
    $('#front_settle_popup_close').click(function(){
        
        $('.view_items_list_in_settle_sec').removeClass('on_view_setlle_dl');
        $('.counter_settle_popup_section_cont').hide();
        $('#auth_val_set').val('');
        
        $("#taxdetails_div").empty();

                $('#totaldisc').text('');
                $('#final').text('');
                $('#grandtotal').text('');
                $('#tip_amount').val('');
                
//         var data_pole = "set_pole=pole_display_all&display=none";
//       
//			$.ajax({
//			type: "POST",
//			url: "index.php",
//			data: data_pole,
//			success: function(data5) {
//			
//			}
//			});
//        
      
    });
    
    
    
  $('#settleingbilno').unbind().change(function(){
        
        
        $("#taxdetails_div").empty();
        var billedno = $('#settleingbilno').val();
        var dataString_log ='action=billamount&billno='+billedno;
        $.ajax({
            type: "POST",
            url: "settle_popup_front.php",
            data: dataString_log,
            success: function(billamount) {  
                
                var parsed_data=JSON.parse(billamount);
                $('#totaldisc').text(parsed_data['DISCOUNT']);
                $('#final').text(parsed_data['SUBTOTAL']);
                $('#grandtotal').text(parsed_data['FINAL']);
                
                 $.each( parsed_data['TAX'], function( key, value ){
                    $("#taxdetails_div").append(
                        '<div style="width:100%; " class="lable_counter_paymnet_cc counter_right_lable" id='+value['ID']+'>'+key+
                        ':<span >'+value['AMOUNT']+
                        '</span></div>'
                    );
                });
            }
        });
        
        $('.view_items_list_in_settle_sec').removeClass("on_view_setlle_dl"); 
        $('.pop_payment_mode_sel_btn:first').click();
        
        setTimeout(function(){
            
            $('#paidamount').val($('#grandtotal').text());
            
        }, 500);
        
    });
    
    /********************************************reprint from settlepopup front ************************************************/
    
 $('#reprint_button').unbind().click(function(){
     
          $("#rsn").hide();
          $("#reasontxt").hide();
          $('#paidamount').val('');
        
        var flr=$(this).attr('fl_chk');
        var Bill_reprint = "Bill_reprint";
        var billno=$('#settleingbilno').val();
        
        $.post("printercheck_1.php", {type:Bill_reprint,floor:flr},
        function(data){ 
            data=$.trim(data);
            
            if(data !=0)
            { 
                $('.confirmpopup_reprint_di').css('display','block');   
                $('#failmsg_reprint_di').html(data);
                $(".confrmation_overlay_reprint").css("display","block");
            }else{
                
                if($('#hidbilreprint').val()=='Y'){
                    
                    if($('#hidauthorise_with_code').val()=='Y'){
                        
                        $('.kotcancel_reason_popup_new').css('display','block');
                        $("#pin_split").val('');
                        $('.kotcancel_reason_popup_new_head').text('BILL REPRINT AUTHORIZATION');
                        $(".pin_proceed").addClass('bill_reprtint_from_front');
			$('.confrmation_overlay_reprint').css('display','block');
                       
                        $("#rsn").css("display","none"); 
                        $("#pin_split").focus();
                        
                        $('#paidamount').removeClass('focused');
                        $('#cheqamount').removeClass('focused');
                        $('#coupamount').removeClass('focused');
                        $('#paidamount_credit').removeClass('focused');
                        $('#multi_cardamount').removeClass('focused');
                        if(sessionStorage.currency_onoff=='Y'){
                           $('#paid_amount_in_currency').removeClass('focused');
                           $('#credit_paid_amount_in_currency').removeClass('focused');
                        }
                    }else{
                        $('.loadcanceldetails').css('display','block');
			$('.confrmation_overlay').css('display','block');
                        
                    }
		}else{
                    
                    var dataString_log ='set_log_reprint_bill=log_reprint_bill&billno_reprint='+billno;
                    $.ajax({
                    type: "POST",
                    url: "printercheck_1.php",
                    data: dataString_log,
                    success: function(data) {

                    }
                    });
                    
                    $.post("print_details.php", {bilno:billno,bill_reprint:'Y',set:'billprint'},
                    function(data){
                        data=$.trim(data);
                        
                    });
                       
                    $('.kotcancel_reason_popup_new').css('display','none');
                    $('.confrmation_overlay').css('display','none');
                    $('#pin_split').val('');
                    
		}
            }
        });
    });
    
 $('.confirm_close_reprint_di').unbind().click(function(){
       
        $('.confirmpopup_reprint_di').css('display','none'); 
        $(".confrmation_overlay_reprint").css("display","none");
  });
    
 $('.confirm_ok_reprint_di').unbind().click(function(){
        $('.confirmpopup_reprint_di').css('display','none'); 
        $(".confrmation_overlay_reprint").css("display","none");  
        var flr=$('#reprint_button').attr('fl_chk');
        var Bill_reprint = "Bill_reprint";
        var billno=$('#settleingbilno').val();
         if($('#hidbilreprint').val()=='Y'){
            if($('#hidauthorise_with_code').val()=='Y'){
                $('.kotcancel_reason_popup_new').css('display','block');
                $("#pin_split").val('');
                $('.kotcancel_reason_popup_new_head').text('BILL REPRINT AUTHORIZATION');
                $(".pin_proceed").addClass('bill_reprtint_from_front');
                $('.confrmation_overlay_reprint').css('display','block');

                $("#rsn").css("display","none"); 
                $("#pin_split").focus();
            }else{
                $('.loadcanceldetails').css('display','block');
                $('.confrmation_overlay').css('display','block');
               
            }
        }else{

            var dataString_log ='set_log_reprint_bill=log_reprint_bill&billno_reprint='+billno;
            $.ajax({
            type: "POST",
            url: "printercheck_1.php",
            data: dataString_log,
            success: function(data) {

            }
            });

            $.post("print_details.php", {bilno:billno,bill_reprint:'Y',set:'billprint'},
            function(data){
                data=$.trim(data);

            });

            $('.kotcancel_reason_popup_new').css('display','none');
            $('.confrmation_overlay').css('display','none');
            $('#pin_split').val('');

        }
    });
        
   /********************************************reprint from settlepopup front ends ************************************************/
   
   /********************************************regenerate from settlepopup front ************************************************/	
    $('#regenerate_button').unbind().click(function(){
        
        $("#rsn").show();
        $("#reasontxt").show();
        $('#cash').click();
        
        $('#paidamount').val('');  
        $('#balanceamout').val('0');
                                 
        var billno=$('#settleingbilno').val();
        
        if($('#hidbilgenper').val()=='Y'){
            
            if($('#hidauthorise_with_code').val()=='Y'){
                
                $('.kotcancel_reason_popup_new').css('display','block');
                $("#rsn").css("display","block"); 
                $("#pin_split").val('');
                $('.kotcancel_reason_popup_new_head').text('BILL REGENERATE AUTHORIZATION');
                $(".pin_proceed").addClass('bill_regenerate_from_front');
                $('.confrmation_overlay_reprint').css('display','block');
                $("#pin_split").focus();
                
                $('.regen_reason').show();
                 
                $('#paidamount').removeClass('focused');
                $('#cheqamount').removeClass('focused');
                $('#coupamount').removeClass('focused');
                $('#paidamount_credit').removeClass('focused');
                $('#multi_cardamount').removeClass('focused');
                if(sessionStorage.currency_onoff=='Y'){
                   $('#paid_amount_in_currency').removeClass('focused');
                   $('#credit_paid_amount_in_currency').removeClass('focused');
                }
            }else{
                $('.loadcanceldetails').css('display','block');
                $('.confrmation_overlay').css('display','block');
               
            }
	}else{
            
            var dataString_log ='set=regen_split&billno_regen='+billno;
          
            $.ajax({
                type: "POST",
                url: "load_paymentpending.php",
                data: dataString_log,
                success: function(data) {
                    var split_permission=$.trim(data);
                    if(split_permission=="N"){
                        var reasontext = $('#reasontxt').val();
                        var hidproc_regen=$('#hidproc_regen').val();
                        $.post("load_paymentpending.php", {reasontext:'',secretkey:'',stafflist:'',bilno:billno,set:'billregenerate'},
                        function(data2){
                            data2=$.trim(data2);
                            if(data2.indexOf("exception") == -1){
                                $(".pin_proceed").removeClass('bill_regenerate_from_front');
                                $('#pin_split').val('');
                                $('.kotcancel_reason_popup_new').css('display','none');
                                $('.confrmation_overlay_reprint').css('display','none');
                                $('.counter_settle_popup_section_cont').hide();
                                $('#alertdiv').css('display','block');
                                $('#alertdiv').text(data2);
                                $('#alertdiv').delay(2000).fadeOut('slow');
                            }else{
                                alert(data2)
                            }
                        });
                    }else{
                        $("#pin_error_split").css("display","block");
                        $("#pin_error_split").addClass("billgenration_validate");
                        $("#pin_error_split").text("Spliited Bill Can't Be Regenerated");
                        $("#pin_error_split").delay(3000).fadeOut('slow');
                    }
		}
            });
        }
    });
   /********************************************regenerate from settlepopup front ************************************************/
   
    /********************************************settle mode switch from settlepopup front ************************************************/
    
    $('#discount_after_bill_btn').click(function(){
        
       $('.discount_after_cc').show();
        
       $('.paid_amount_cc').hide();
      
       $('.credit_cc_normal').hide();
       
       
       $('.cheque_cc').hide();
        
       $('.paid_amount_cc_credit').hide();
       $('.credit_type').hide();
         
         
       $('.complimentrary_cc').hide();
          
       $('.voucher_cc').hide();
       $('.coupon_cc').hide();
              
              
       $('#dis_after_manual').focus();
       
       $('#dis_after_manual').val('');
      
    });
    
    
    
    
    
    
    $('.pop_payment_mode_sel_btn').unbind().click(function(){
        
       var mode_id=$(this).attr('id');
          
       if( mode_id=='credit'){
           
           $("#paidamount").css('width','140px'); 
           $("#balanceamout").css('width','70px'); 
          
           $("#paidamount").css('margin-left','-7px');       
           $(".paid_cls").css('font-size','13px');       
          
           $("#balanceamout").css('margin-left','285px'); 
           $("#balanceamout").css('margin-top','-38px'); 
          
           $(".bal_cls").css('font-size','13px');   
           
           $(".bal_cls").css('margin-top','-38px');   
            
           $(".bal_cls").css('margin-left','200px'); 
           
           $(".bal_cls_div").css('display','none'); 
           
           
     }else{
          
           $(".bal_cls_div").css('display','block'); 
           $("#paidamount").css('width','138px'); 
           $("#balanceamout").css('width','138px');
           $("#paidamount").css('margin-left','0px');       
           $("#paidamount").css('font-size','15px');    
           
           $("#balanceamout").css('margin-left','0px'); 
           $("#balanceamout").css('margin-top','0px'); 
           
           $(".bal_cls").css('font-size','15px'); 
           $(".paid_cls").css('font-size','15px');       
            
           $(".bal_cls").css('margin-top','0px');   
            
           $(".bal_cls").css('margin-left','0px'); 
          
      }
        
        var decimal=$('#decimal').val();
        var bill_no=$('#settleingbilno').val();
        var bill_final_amount=$('#grandtotal').text().replace(",",'');
        $('.pop_payment_mode_sel_btn').removeClass('mode_sel_btn_act');
        $(this).addClass('mode_sel_btn_act');
        $('.cardadder').empty();
      
        
    if(mode_id=='cash'){
            
              $("#paidamount").val($('#grandtotal').text().replace(",",''));
              
              $("#balanceamout").val("0");
              $("#paidamount").select();
                   
              $('.discount_after_cc').hide();
              payment_entering_feilds_hide();
            
              $('.paid_amount_cc').show(500);
           
            if(sessionStorage.currency_onoff=='Y'){
                
                $('.currency_main_div').show();
                $('#paid_amount_in_currency').focus();
                $('#paid_amount_in_currency').val('');
                $('#paidamount').prop('readonly',true);
                $('#base_currency_shortcode_display').show();
                $('#currency_shortcode_dipslay').text('- in '+$('#currency_selected option:selected').attr('shortcode'));
                
            }else{
                
                $('#base_currency_shortcode_display').hide();
                $('#paidamount').prop('readonly',false);
                $('#paidamount').focus();
            }
            
        }
        else if(mode_id=='credit'){ 
            
            $('.discount_after_cc').hide();
            payment_entering_feilds_hide();
            
            $('.paid_amount_cc').show(500);
            $('.credit_cc_normal').show(1500);
            
             $('#multi_cardamount').focus();
             $('#transcationid').val(0);
             sessionStorage.card_sum=0;
             $('#transbal').val(bill_final_amount);
             $('#transcationid').val(0);
             
            $('#multi_cardamount').val(bill_final_amount);
            
            var last_card_details ='action=load_added_cards&billno=temp_'+bill_no;
            $.ajax({
                type: "POST",
                url: "settle_popup_front.php",
                data: last_card_details,
                success: function(data_return) {
                    
                    data_return=JSON.parse(data_return);
                    
                    if(data_return['CARD_SUM']){
                        
                   //  $('#multibanktype').val('');     
                    $('#multicardtype').val('');
                    $('#card_1').val('');
                    $('#multi_cardamount').val('');
                    $('#multi_cardamount').focus();
                      $("#multibanktype").val($("#multibanktype option:first").val());  
                    
                    if(!data_return['CARD_SUM']){
                        data_return['CARD_SUM']=0;
                     }    
                    sessionStorage.card_sum=data_return['CARD_SUM'];
                    $('#transcationid').val(data_return['CARD_SUM']);
                    $('#transbal').val((parseFloat(bill_final_amount)-parseFloat(data_return['CARD_SUM'])).toFixed(decimal));
                   
                    $.each(data_return['DETAILS'], function( key1, value1 ){
                                                
                        if(value1['CARD_NUMBER']==null){
                            value1['CARD_NUMBER']='';
                        }
                        
                        if(value1['CARD_TYPE']==null){
                            value1['CARD_TYPE']='';
                        }
                        
                         if(value1['BANK_TYPE']==null){
                            value1['BANK_TYPE']='';
                        }
                        
                        $(".cardadder").append("<div class='card_detail_popup_list refdiv_card ' id='card_detail_popup_list"+value1['SLNO']+"'  style='margin-bottom:3px'> <div class='card_detail_popup_type' style='width:25%;margin-right:1%;display:none'>"+
                            "<div class='card_type_dropdwn cardselect' style='text-align:center;padding-top:7px' id='multicardtype"+value1['SLNO']+"' >"+value1['CARD_TYPE']+
                            "</div>"+
                            "</div>"+  
                            "  <div class='card_detail_popup_type' style='width: 30%;display:none'>"+
                            "<input class='card_popup_digits cardno' type='text' id='card_1"+value1['SLNO']+"' value='" + value1['CARD_NUMBER'] + "' name='card_1"+value1['SLNO']+"'  onkeypress='return numonly()' onclick='return pincard()' onchange='return pincard()' maxlength='4' autocomplete='off'>"+
                            "</div>"+
                            "<div class='card_detail_popup_type' style='width:45%;margin-left:1%'>"+
                            "<input type='text' class='card_type_dropdwn amountall' id='multi_cardamount"+value1['SLNO']+"' value='" + value1['CARD_AMOUNT'] + "' name='multi_cardamount"+value1['SLNO']+"' onkeypress='return isNumberKey()' onkeyup='return cardsum()' onclick='return cardsum()' onchange='return cardsum()' autocomplete='off'>"+
                            " </div>"+
                            
                             "<div class='card_detail_popup_type' style='width:38%;margin-right:1%'>"+
                            "<div class='card_type_dropdwn ' style='text-align:center;padding-top:7px' id='multibanktype"+value1['SLNO']+"' >"+value1['BANK_TYPE']+
                            "</div>"+
                            "</div>"+  
                            
                            
                            "<div style='margin-top:0px;width: 12%;height: 34px;margin-top: -1px;float: right' id='del_card"+value1['SLNO']+"' name='del_card"+value1['SLNO']+"' class='menut_add_bq_btn' onclick='return deletecard("+value1['SLNO']+","+value1['SLNO']+");'><img width='23px' src='img/cancel-icon.png'></div>"+
                            "</div>"        
                        );
                      
                    });
                    
                }else{
                    
             $('#transbal').val(0);
            
              setTimeout(function(){ 
                 $('#multi_cardamount').val(bill_final_amount);
               }, 500);  
               
             $('#paidamount').val(0);
             $('#multi_cardamount').focus();
            
            
             }
            }
            });
            
            
            $('#paidamount').val('');
            $('#balanceamout').val(0);
            
            if(sessionStorage.currency_onoff=='Y'){
                $('.currency_main_div').show();
                $('#paid_amount_in_currency').focus();
                $('#paid_amount_in_currency').val('');
                $('#paidamount').prop('readonly',true);
                $('#base_currency_shortcode_display').show();
                $('#currency_shortcode_dipslay').text('- in '+$('#currency_selected option:selected').attr('shortcode'));
            }else{
                $('#paidamount').focus();
                $('#base_currency_shortcode_display').hide();
                $('#paidamount').prop('readonly',false);
            }
        }
        else if(mode_id=='cheque'){
             $('.discount_after_cc').hide();
            payment_entering_feilds_hide();
            $('.cheque_cc').show(500);
            $('#cheqamount').focus();
            $('#paidamount').removeClass('focused')
            $('#cheqamount').addClass('focused');
           
            $('.paid_amount_cc').show(500);
            $('#cheqamount').val('');
            $('#cheqbal').val(bill_final_amount);
            $('#paidamount').val('');
            $('#balanceamout').val(0);
            if(sessionStorage.currency_onoff=='Y'){
                $('.currency_main_div').show();
                $('#paid_amount_in_currency').val('');
                $('#paidamount').prop('readonly',true);
                $('#base_currency_shortcode_display').show();
                $('#currency_shortcode_dipslay').text('- in '+$('#currency_selected option:selected').attr('shortcode'));
            }else{
                
                $('#base_currency_shortcode_display').hide();
                $('#paidamount').prop('readonly',false);
            }
        }
        else if(mode_id=='credit_person'){
           
         
           $('.discount_after_cc').hide();
         
             $("#pin_pay").val('');
          $("#pin_pay").focus();
            payment_entering_feilds_hide();
          
          
          ///company auto set code///
          
          var default_company=$('#default_company').val();
          
          
          if(default_company=='Y'){
              
              $('#selectcreditypes').val('4');
              $("#selectcreditypes").trigger("change");
              
            var bill_check= $('#settleingbilno').text();
          
            var chk_bill = 'value=check_company&bill_check='+bill_check;
            $.ajax({
            type: "POST",
            url: "load_div.php",
            data: chk_bill,
            success: function(msg) {
                
              if($.trim(msg)!='no'){ 
                  //$('#selectcreditdetailsname').val($.trim(msg));
                  $('#selectcreditdetailsname').val('');
                  $('#selectcreditdetailsname').focus();
               }else{
                  $('#selectcreditdetailsname').val('Select Company'); 
               }
                
                }
               });
              $('.auth_popup_payment').hide();
              $('.confrmation_overlay_reprint').css('display','hide');
         
        }else{
         
           $('.auth_popup_payment').show();
             $('.head_change').text('Credit Authorization');
           $('.confrmation_overlay_reprint').css('display','block');
        }
       /////////company ends/////////   
           
            
            $('.paid_amount_cc_credit').show(500);
            $('.credit_type').show(500);
          
            $('#selectcreditdetailsname').val('');
            $('#selectcreditdetailsnumber').val('');
            var gt=$('#grandtotal').text();
            $('#amount_credit').val(gt)
            
            if(sessionStorage.currency_onoff=='Y'){
                $('.credit_crrency_select').show();
                $('#credit_paid_amount_in_currency').val('');
               // $('#credit_paid_amount_in_currency').focus();
                $('#paidamount_credit').prop('readonly',true);
                $('#credit_base_currency_shortcode_display').show();
                $('#credit_currency_shortcode_dipslay').text('- in '+$('#currency_selected option:selected').attr('shortcode'));
            }else{
               // $('#paidamount_credit').focus();
                $('#credit_base_currency_shortcode_display').hide();
                $('#paidamount_credit').prop('readonly',false);
            }
        }
        else if(mode_id=='complimentary'){
          $('.discount_after_cc').hide();   
            $('.auth_popup_payment').show();
            $('.head_change').text('Complimentary Authorization');
            $('.confrmation_overlay_reprint').css('display','block');
             $("#pin_pay").val('');
             $("#pin_pay").focus();
            payment_entering_feilds_hide();
            $('.complimentrary_cc').show(500);
            $('#completext').val('');
            //$('#completext').focus();
            $('.currency_main_div').hide();
        }
        else if(mode_id=='coupon'){
            payment_entering_feilds_hide();
         $('.discount_after_cc').hide();   
            $('.paid_amount_cc').show(500);
            $('#paidamount').val('');
            $('#balanceamout').val(0);
            $('.coupon_cc').show(500);
            $('#coupamount').val('');
             $('#coupname').val('');
            $('#coupname').focus();
            $('#paidamount').removeClass('focused');
            $('#coupamount').addClass('focused');
            $('#coupbal').val(bill_final_amount);
            if(sessionStorage.currency_onoff=='Y'){
                $('.currency_main_div').show();
                $('#paid_amount_in_currency').val('');
                $('#paidamount').prop('readonly',true);
                $('#base_currency_shortcode_display').show();
                $('#currency_shortcode_dipslay').text('- in '+$('#currency_selected option:selected').attr('shortcode'));
            }else{
                
                $('#base_currency_shortcode_display').hide();
                $('#paidamount').prop('readonly',false);
            }
        }
        else if(mode_id=='voucher'){
            payment_entering_feilds_hide();
            if(sessionStorage.currency_onoff=='Y'){
                $('.currency_main_div').show();
            }
             $('.discount_after_cc').hide();
            $('.paid_amount_cc').show(500);
            $('#paidamount').val('');
            $('#balanceamout').val(0);
            $('.voucher_cc').show(500);
            $('#vocamount').val('');
            $('#vocamount').focus();
            $('#paidamount').removeClass('focused');
            $('#vocamount').addClass('focused');
            $('#vouchbal').val(bill_final_amount);
            if(sessionStorage.currency_onoff=='Y'){
                $('.currency_main_div').show();
                $('#paid_amount_in_currency').val('');
                $('#paidamount').prop('readonly',true);
                $('#base_currency_shortcode_display').show();
                $('#currency_shortcode_dipslay').text('- in '+$('#currency_selected option:selected').attr('shortcode'));
            }else{
                
                $('#base_currency_shortcode_display').show();
                $('#paidamount').prop('readonly',false);
            }
        }
        else if(mode_id=='upi'){
            payment_entering_feilds_hide();
            $('.upi_cc').show(500);
             $('.discount_after_cc').hide();
        }
        
        if(mode_id=='credit_person'){
            $('#credit_paid_amount_in_currency').attr('selected_currency_id',$('#credit_currency_selected option:selected').val());
        }else{
            $('#paid_amount_in_currency').attr('selected_currency_id',$('#currency_selected option:selected').val());
        }
        var currency_rate = 'action=currency_conversion_rate&selected_currency='+$('#currency_selected option:selected').val();
        $.ajax({
            type: "POST",
            url: "settle_popup_front.php",
            data: currency_rate,
            success: function(data_return) {
                sessionStorage.currency_rate=$.trim(data_return);
                //alert(sessionStorage.currency_rate);
            }
        });
    });
    
    
    
    
    
    $(".pin_proceed_pay").unbind().click(function(event){
        $('.settle_auth').hide();
        $('.confrmation_overlay_settle').hide();
        
      event.stopImmediatePropagation();
      var pin =  $('#pin_pay').val();
       if(pin!=''){
            
             if( $('.complimentrary_cc').css('display') == 'block'){
                $.post("load_paymentpending.php", {pin:pin,type:'authpincheck',set:'pincheck'},
                            function(data){
                                data=$.trim(data);
                                if(data!="NO"){
                                var spl=data.split('*');
                                if(spl[11]=='comp:Y'){
                                  
                       $('#code_comp_credit').val(spl[12]);             
             $('.auth_popup_payment').hide();
            $('.confrmation_overlay_reprint').css('display','none');
            $("#completext").focus();
            $(".payment_pend_right_cash_error").text(" ");
                                    }else{
                                        $("#pin_error_split").css("display","block");
					$("#pin_error_split").text("No Permission");
					$("#pin_error_split").delay(2000).fadeOut('slow');
                                        $("#pin_pay").val('');
                                        $("#pin_pay").focus();
                                    }    
                                }else{
                                    $("#pin_error_split").css("display","block");
                                    $("#pin_error_split").text("CODE IS NOT REGISTERED");
                                    $("#pin_error_split").delay(2000).fadeOut('slow');
                                    $("#pin_pay").val('');
                                    $("#pin_pay").focus();
						
				}
                            });
                 
             }else  if( $('.paid_amount_cc_credit').css('display') == 'block'){
               $.post("load_paymentpending.php", {pin:pin,type:'authpincheck',set:'pincheck'},
                            function(data){
                            data=$.trim(data);
                            if(data!="NO"){
                            var spl=data.split('*');
                            if(spl[10]=='credit:Y'){
            $('#code_comp_credit').val(spl[12]);    
            $('.auth_popup_payment').hide();
            $('.confrmation_overlay_reprint').css('display','none');
            $("#paidamount_credit").focus();
            $(".payment_pend_right_cash_error").text(" ");
            $('.paid_amount_cc_credit').show(500);
            $('.credit_type').show(500);
            $('#paidamount_credit').val('0');
            $('#selectcreditdetailsname').val('');
            $('#selectcreditdetailsnumber').val('');
             $('#selectcreditdetails').val('');
               $('#selectcreditypes').val('');
            
            var gt=$('#grandtotal').text();
            $('#amount_credit').val(gt)
            
            if(sessionStorage.currency_onoff=='Y'){
                $('.credit_crrency_select').show();
                $('#credit_paid_amount_in_currency').val('');
                $('#credit_paid_amount_in_currency').focus();
                $('#paidamount_credit').prop('readonly',true);
                $('#credit_base_currency_shortcode_display').show();
                $('#credit_currency_shortcode_dipslay').text('- in '+$('#currency_selected option:selected').attr('shortcode'));
            }else{
                $('#paidamount_credit').focus();
                $('#credit_base_currency_shortcode_display').hide();
                $('#paidamount_credit').prop('readonly',false);
            }
            
                                    }else{
                                        $("#pin_error_split").css("display","block");
					$("#pin_error_split").text("No Permission");
					$("#pin_error_split").delay(2000).fadeOut('slow');
                                        $("#pin_pay").val('');
                                        $("#pin_pay").focus();
                                    }    
                                }else{
                                    $("#pin_error_split").css("display","block");
                                    $("#pin_error_split").text("CODE IS NOT REGISTERED");
                                    $("#pin_error_split").delay(2000).fadeOut('slow');
                                    $("#pin_pay").val('');
                                    $("#pin_pay").focus();
						
				}
                            });
            
             }
            
        
    
                 }else{
                        $("#pin_error_split").css("display","block");
			$("#pin_error_split").text("ENTER YOUR PIN ");
			$("#pin_error_split").delay(2000).fadeOut('slow');
                        $("#pin_pay").focus();
                 }
  
  
    });
    
    
    
    /********************************************settle mode switch from settlepopup front ends ************************************************/
    
    /*******************************************Quick Cash & key pad Click *******************************/ 
    $('.settle_calc_btn_from_front').unbind().click(function(){
        
         var decimal=$('#decimal').val();
         
        if($('#tip_amount').hasClass('focused')){
            if($(this).text()!='Clear'){
                if($(this).hasClass('quick_cash')){
                    $('#tip_amount').val($.trim($(this).text()));
                }
                else{
                    
                    if($('#tip_amount').val()!='' && $('#tip_amount').val()!=0){
                        if(($.trim($(this).text())!='.' ||($.trim($(this).text())=='.' && !$('#tip_amount').val().includes('.')))&& $('#tip_amount').val().length<13){
                            $('#tip_amount').val($('#tip_amount').val()+$.trim($(this).text()));
                        }    
                    }
                    else{
                        $('#tip_amount').val($.trim($(this).text()));
                    }
                }
                $('#tip_amount').focus();
            }
            else{
                $('#tip_amount').val(0);
                $('#tip_amount').focus();
            }
        }else{
            var enterd_amount=0;
            var balance_amount=0;
            var bill_final_amount=$('#grandtotal').text().replace(',','');
            var settle_mode=$.trim($('.mode_sel_btn_act').attr('id'));

            /******** CASH *******************************/ 
                if(settle_mode=='cash'){
                    
                
                 if($('.discount_after_cc:visible').length == 1){ 
                      if($(this).text()!='Clear'){
                          
                             var id_val='';
                         //$('#dis_after_manual').val($.trim($(this).text()));
                           id_val='dis_after_manual'; 
                        

                        if($('#'+id_val).val()!='' && $('#'+id_val).val()!=0){
                            if(($.trim($(this).text())!='.' ||($.trim($(this).text())=='.' && !$('#'+id_val).val().includes('.')))&& $('#'+id_val).val().length<13){
                                $('#'+id_val).val($('#'+id_val).val()+$.trim($(this).text()));
                            }    
                           
                        }
                        else{

                            $('#'+id_val).val($.trim($(this).text()));
                          
                        }
                       
                        
                        var typ=$('#dis_after_type').val();
                       
                       
                        if( ($('#'+id_val).val()>=100 && typ=='P') || (typ=='V' && $('#'+id_val).val()>=parseFloat(bill_final_amount ) )){
                          $('#dis_after_manual').val('');
                        }
                        
                          
                        }else{
                            $('#dis_after_manual').val('');
                        }
                        
                }else{
                    
                    
                    
                if($(this).text()!='Clear'){
                    if($(this).hasClass('quick_cash')){
                        if(sessionStorage.currency_onoff=='Y'){
                            $('#paid_amount_in_currency').val($.trim($(this).text()));
                            $('#paidamount').val((parseFloat($('#paid_amount_in_currency').val())*parseFloat(sessionStorage.currency_rate)).toFixed(decimal));
                        }
                        else{
                            $('#paidamount').val($.trim($(this).text()));
                        }
                        enterd_amount=$('#paidamount').val();
                        balance_amount=parseFloat(enterd_amount-bill_final_amount);
                        if(balance_amount>0){
                            $('#balanceamout').val(balance_amount.toFixed(decimal));
                        }else{

                            $('#balanceamout').val(0);
                        }
                    }
                    else{
                        var id_val='';
                        if(sessionStorage.currency_onoff=='Y'){
                           id_val='paid_amount_in_currency'; 
                        }else{
                            id_val='paidamount'; 
                        }

                        if($('#'+id_val).val()!='' && $('#'+id_val).val()!=0){
                            if(($.trim($(this).text())!='.' ||($.trim($(this).text())=='.' && !$('#'+id_val).val().includes('.')))&& $('#'+id_val).val().length<13){
                                $('#'+id_val).val($('#'+id_val).val()+$.trim($(this).text()));
                            }    
                            if(sessionStorage.currency_onoff=='Y'){
                               $('#paidamount').val((parseFloat($('#'+id_val).val())*parseFloat(sessionStorage.currency_rate)).toFixed(decimal));
                            }else{
                                $('#paidamount').val($('#'+id_val).val()); 
                            }
                            enterd_amount=$('#paidamount').val();
                            balance_amount=parseFloat(enterd_amount-bill_final_amount);
                            if(balance_amount>0){
                                $('#balanceamout').val(balance_amount.toFixed(decimal));
                            }else{

                                $('#balanceamout').val(0);
                            }

                        }
                        else{

                            $('#'+id_val).val($.trim($(this).text()));
                            if(sessionStorage.currency_onoff=='Y'){
                               $('#paidamount').val((parseFloat($('#'+id_val).val())*parseFloat(sessionStorage.currency_rate)).toFixed(decimal));
                            }else{
                                $('#paidamount').val($('#'+id_val).val()); 
                            }
                        }

                    }
                    $('#'+id_val).focus();
                }
                else{

                    $('#paidamount').val('');
                    $('#balanceamout').val(0);
                    $('#paidamount').focus();
                    if(sessionStorage.currency_onoff=='Y'){
                        $('#paid_amount_in_currency').val('');
                        $('#paid_amount_in_currency').focus();
                    }
                }
                
                
            }
                
                
            }

            /******** CHEQUE *******************************/ 
                else if(settle_mode=='cheque'){

                if($(this).text()!='Clear'){
                    if($(this).hasClass('quick_cash')){

                        if($('#cheqamount').hasClass('focused')){
                            $('#cheqamount').val($.trim($(this).text()));
                            var cheque_amount=$('#cheqamount').val();
                            balance_amount=parseFloat(bill_final_amount-cheque_amount);
                            if(balance_amount>=0){
                                $('#cheqbal').val(balance_amount.toFixed(decimal));
                            }else{
                                $('#cheqamount').val('');
                                $('#cheqbal').val(bill_final_amount);
                                $('#paidamount').val('');
                                $('#balanceamout').val(0);
                                $('#cheqamount').focus();
                                $(".payment_pend_right_cash_error").css("display","block");
                                $(".payment_pend_right_cash_error").addClass("popup_validate");
                                $(".payment_pend_right_cash_error").text('Check  Cheque Amount');
                                $('.payment_pend_right_cash_error').delay(2000).fadeOut('slow');
                                return false;
                            }
                            if($('#paidamount').val()!='' && (parseFloat($('#paidamount').val())>parseFloat($('#cheqbal').val())) ){

                                $('#balanceamout').val((parseFloat($('#paidamount').val())-parseFloat($('#cheqbal').val())).toFixed(decimal));
                            }
                            $('#cheqamount').focus();
                        }
                        else {
                            if(sessionStorage.currency_onoff=='Y'){
                                $('#paid_amount_in_currency').val($.trim($(this).text()));
                                $('#paidamount').val((parseFloat($('#paid_amount_in_currency').val())*parseFloat(sessionStorage.currency_rate)).toFixed(decimal));
                            }else{
                                $('#paidamount').val($.trim($(this).text()));
                            }

                            enterd_amount=$('#paidamount').val();
                            var checque_bal=$('#cheqbal').val();
                            balance_amount=parseFloat(enterd_amount-checque_bal);
                            if(balance_amount>0){
                            $('#balanceamout').val(balance_amount.toFixed(decimal));
                            }else{

                                $('#balanceamout').val(0);
                            }
                            $('#cheqamount').focus();
                        }
                    }
                    else{
                        var id_val='';
                        if(sessionStorage.currency_onoff=='Y'){
                           id_val='paid_amount_in_currency'; 
                        }else{
                            id_val='paidamount'; 
                        }
                        if($('#cheqamount').hasClass('focused')){
                            if($('#cheqamount').val()!='' && $('#cheqamount').val()!=0){
                                if(($.trim($(this).text())!='.' ||($.trim($(this).text())=='.' && !$('#cheqamount').val().includes('.')))&& $('#cheqamount').val().length<13){
                                    $('#cheqamount').val($('#cheqamount').val()+$.trim($(this).text()));
                                }
                                cheque_amount=$('#cheqamount').val();
                                balance_amount=parseFloat(bill_final_amount-cheque_amount);
                                if(balance_amount>=0){
                                    $('#cheqbal').val(balance_amount.toFixed(decimal));
                                }else{
                                    $('#cheqamount').val('');
                                    $('#cheqbal').val(bill_final_amount);
                                    $('#paidamount').val('');
                                    $('#balanceamout').val(0);
                                    $('#cheqamount').focus();
                                    $(".payment_pend_right_cash_error").css("display","block");
                                    $(".payment_pend_right_cash_error").addClass("popup_validate");
                                    $(".payment_pend_right_cash_error").text('Check  Cheque Amount');
                                    $('.payment_pend_right_cash_error').delay(2000).fadeOut('slow');
                                    return false;
                                }
                            }
                            else{

                                $('#cheqamount').val($.trim($(this).text()));
                                cheque_amount=$('#cheqamount').val();
                                balance_amount=parseFloat(bill_final_amount-cheque_amount);
                                $('#cheqbal').val(balance_amount.toFixed(decimal));

                            }
                            if($('#paidamount').val()!='' && (parseFloat($('#paidamount').val())>parseFloat($('#cheqbal').val())) ){

                                $('#balanceamout').val((parseFloat($('#paidamount').val())-parseFloat($('#cheqbal').val())).toFixed(decimal));
                            }
                            $('#cheqamount').focus();
                        }

                        else if($('#'+id_val).hasClass('focused')){

                            if($('#'+id_val).val()!='' && $('#'+id_val).val()!=0){
                                if(($.trim($(this).text())!='.' ||($.trim($(this).text())=='.' && !$('#'+id_val).val().includes('.')))&& $('#'+id_val).val().length<13){
                                    $('#'+id_val).val($('#'+id_val).val()+$.trim($(this).text()));
                                }

                                if(sessionStorage.currency_onoff=='Y'){
                                   $('#paidamount').val((parseFloat($('#'+id_val).val())*parseFloat(sessionStorage.currency_rate)).toFixed(decimal));
                                }
                            }
                            else{
                                $('#'+id_val).val($.trim($(this).text()));
                                if(sessionStorage.currency_onoff=='Y'){
                                   $('#paidamount').val((parseFloat($('#'+id_val).val())*parseFloat(sessionStorage.currency_rate)).toFixed(decimal));
                                }else{
                                    $('#paidamount').val($('#'+id_val).val()); 
                                } 
                            }
                            enterd_amount=$('#paidamount').val();
                            var checque_bal=$('#cheqbal').val();
                            balance_amount=parseFloat(enterd_amount-checque_bal);
                            if(balance_amount>0){
                                $('#balanceamout').val(balance_amount.toFixed(decimal));
                            }else{

                                $('#balanceamout').val(0);
                            }
                            $('#'+id_val).focus();
                        }
                    }
                }
                else{

                    $('#cheqamount').val('');
                    $('#cheqbal').val(bill_final_amount);
                    $('#paidamount').val('');
                    $('#balanceamout').val(0);

                    if($('#paidamount').hasClass('focused')){
                        $('#paidamount').focus();
                    }else{
                      $('#cheqamount').focus();  
                    }
                    if(sessionStorage.currency_onoff=='Y'){
                        $('#paid_amount_in_currency').val('');
                        if($('#paid_amount_in_currency').hasClass('focused')){
                            $('#paid_amount_in_currency').focus();
                        }    
                    }
                }    
            }

            /******** CREDIT PERSON *******************************/ 
                else if(settle_mode=='credit_person'){
                    if($(this).text()!='Clear'){
                        if($(this).hasClass('quick_cash')){
                            if(sessionStorage.currency_onoff=='Y'){
                                $('#credit_paid_amount_in_currency').val($.trim($(this).text()));
                                $('#paidamount_credit').val((parseFloat($('#credit_paid_amount_in_currency').val())*parseFloat(sessionStorage.currency_rate)).toFixed(decimal));
                            }else{
                                $('#paidamount_credit').val($.trim($(this).text()));
                            }

                            enterd_amount=$('#paidamount_credit').val();
                            balance_amount=parseFloat(bill_final_amount-enterd_amount);
                            if(balance_amount>0){
                                $('#amount_credit').val(balance_amount.toFixed(decimal));
                            }else{

                                $('#paidamount_credit').val('');
                                $('#amount_credit').val(bill_final_amount);
                                if(sessionStorage.currency_onoff=='Y'){
                                    $('#credit_paid_amount_in_currency').val('');
                                    $('#credit_paid_amount_in_currency').focus();
                                }else{
                                    $('#paidamount_credit').focus();
                                }

                                $(".payment_pend_right_cash_error").css("display","block");
                                $(".payment_pend_right_cash_error").addClass("popup_validate");
                                $(".payment_pend_right_cash_error").text('Cash Paid Should be Less than Total');
                                $('.payment_pend_right_cash_error').delay(2000).fadeOut('slow');
                                return false;
                            }
                        }
                        else{
                            var id_val='';
                            if(sessionStorage.currency_onoff=='Y'){
                               id_val='credit_paid_amount_in_currency'; 
                            }else{
                                id_val='paidamount_credit'; 
                            }
                            if($('#'+id_val).val()!='' && $('#'+id_val).val()!=0){

                                if(($.trim($(this).text())!='.' ||($.trim($(this).text())=='.' && !$('#'+id_val).val().includes('.')))&& $('#'+id_val).val().length<13){
                                    $('#'+id_val).val($('#'+id_val).val()+$.trim($(this).text()));
                                }
                                if(sessionStorage.currency_onoff=='Y'){
                                    $('#paidamount_credit').val((parseFloat($('#credit_paid_amount_in_currency').val())*parseFloat(sessionStorage.currency_rate)).toFixed(decimal));
                                }else{
                                    $('#paidamount_credit').val($('#'+id_val).val());
                                }

                                enterd_amount=$('#paidamount_credit').val();
                                balance_amount=parseFloat(bill_final_amount-enterd_amount);
                                if(balance_amount>0){
                                   $('#amount_credit').val(balance_amount.toFixed(decimal));
                                }else{
                                    $('#'+id_val).val('');
                                    $('#paidamount_credit').val('');
                                    $('#amount_credit').val(bill_final_amount);
                                    if(sessionStorage.currency_onoff=='Y'){
                                    $('#credit_paid_amount_in_currency').val('');
                                    $('#credit_paid_amount_in_currency').focus();
                                    }else{
                                        $('#paidamount_credit').focus();
                                    }
                                    $(".payment_pend_right_cash_error").css("display","block");
                                    $(".payment_pend_right_cash_error").addClass("popup_validate");
                                    $(".payment_pend_right_cash_error").text('Cash Paid Should be Less than Total');
                                    $('.payment_pend_right_cash_error').delay(2000).fadeOut('slow');
                                    return false;
                                }
                            }
                            else{
                                $('#'+id_val).val($.trim($(this).text()));
                                if(sessionStorage.currency_onoff=='Y'){
                                    $('#paidamount_credit').val((parseFloat($('#credit_paid_amount_in_currency').val())*parseFloat(sessionStorage.currency_rate)).toFixed(decimal));
                                }else{
                                    $('#paidamount_credit').val($('#'+id_val).val());
                                }
                                enterd_amount=$('#paidamount_credit').val();
                                balance_amount=parseFloat(bill_final_amount-enterd_amount);
                                $('#amount_credit').val(balance_amount.toFixed(decimal));
                            }
                            $('#'+id_val).focus();
                        }
                    }else{
                        $('#paidamount_credit').val('');
                        $('#amount_credit').val(bill_final_amount);
                        $('#paidamount_credit').focus();
                        if(sessionStorage.currency_onoff=='Y'){
                            $('#credit_paid_amount_in_currency').focus();
                        }
                    }

                }

            /******** COUPON *******************************/ 
                else if(settle_mode=='coupon'){

                    if($(this).text()!='Clear'){
                        if($(this).hasClass('quick_cash')){

                            if($('#coupamount').hasClass('focused')){
                                $('#coupamount').val($.trim($(this).text()));
                                var coupon_amount=$('#coupamount').val();
                                balance_amount=parseFloat(bill_final_amount-coupon_amount);
                                if(balance_amount>=0){
                                    $('#coupbal').val(balance_amount.toFixed(decimal));
                                }else{
                                    $('#coupamount').val('');
                                    $('#coupbal').val(bill_final_amount);
                                    $('#paidamount').val('');
                                    $('#balanceamout').val(0);
                                    $('#coupamount').focus();
                                    $(".payment_pend_right_cash_error").css("display","block");
                                    $(".payment_pend_right_cash_error").addClass("popup_validate");
                                    $(".payment_pend_right_cash_error").text('Check  Coupon Amount');
                                    $('.payment_pend_right_cash_error').delay(2000).fadeOut('slow');
                                    return false;
                                }
                                if($('#paidamount').val()!='' && (parseFloat($('#paidamount').val())>parseFloat($('#coupbal').val())) ){

                                    $('#balanceamout').val((parseFloat($('#paidamount').val())-parseFloat($('#coupbal').val())).toFixed(decimal));
                                }
                                $('#coupamount').focus();
                            }
                            else{
                                if(sessionStorage.currency_onoff=='Y'){
                                    $('#paid_amount_in_currency').val($.trim($(this).text()));
                                    $('#paidamount').val((parseFloat($('#paid_amount_in_currency').val())*parseFloat(sessionStorage.currency_rate)).toFixed(decimal));
                                }else{
                                    $('#paidamount').val($.trim($(this).text()));
                                }
                                enterd_amount=$('#paidamount').val();
                                var coupon_bal=$('#coupbal').val();
                                balance_amount=parseFloat(enterd_amount-coupon_bal);
                                if(balance_amount>0){
                                $('#balanceamout').val(balance_amount.toFixed(decimal));
                                }else{

                                    $('#balanceamout').val(0);
                                }
                                $('#paidamount').focus();
                            }
                        }
                        else{
                            var id_val='';
                            if(sessionStorage.currency_onoff=='Y'){
                               id_val='paid_amount_in_currency'; 
                            }else{
                                id_val='paidamount'; 
                            }
                            if($('#coupamount').hasClass('focused')){
                                if($('#coupamount').val()!='' && $('#coupamount').val()!=0){
                                    if(($.trim($(this).text())!='.' ||($.trim($(this).text())=='.' && !$('#coupamount').val().includes('.')))&& $('#coupamount').val().length<13){
                                        $('#coupamount').val($('#coupamount').val()+$.trim($(this).text()));
                                    }
                                    coupon_amount=$('#coupamount').val();
                                    balance_amount=parseFloat(bill_final_amount-coupon_amount);
                                    if(balance_amount>=0){
                                        $('#coupbal').val(balance_amount.toFixed(decimal));
                                    }else{
                                        $('#coupamount').val('');
                                        $('#coupbal').val(bill_final_amount);
                                        $('#paidamount').val('');
                                        $('#balanceamout').val(0);
                                        $('#coupamount').focus();
                                        $(".payment_pend_right_cash_error").css("display","block");
                                        $(".payment_pend_right_cash_error").addClass("popup_validate");
                                        $(".payment_pend_right_cash_error").text('Check  Coupon Amount');
                                        $('.payment_pend_right_cash_error').delay(2000).fadeOut('slow');
                                        return false;
                                    }
                                }
                                else{

                                    $('#coupamount').val($.trim($(this).text()));
                                    coupon_amount=$('#coupamount').val();
                                    balance_amount=parseFloat(bill_final_amount-coupon_amount);
                                    $('#coupbal').val(balance_amount.toFixed(decimal));
                                }
                                if($('#paidamount').val()!='' && (parseFloat($('#paidamount').val())>parseFloat($('#coupbal').val())) ){

                                    $('#balanceamout').val((parseFloat($('#paidamount').val())-parseFloat($('#coupbal').val())).toFixed(decimal));
                                }
                                $('#coupamount').focus();
                            }
                            else if($('#'+id_val).hasClass('focused')){
                                if($('#'+id_val).val()!='' && $('#'+id_val).val()!=0){

                                    if(($.trim($(this).text())!='.' ||($.trim($(this).text())=='.' && !$('#'+id_val).val().includes('.')))&& $('#'+id_val).val().length<13){
                                        $('#'+id_val).val($('#'+id_val).val()+$.trim($(this).text()));
                                    }

                                    if(sessionStorage.currency_onoff=='Y'){
                                       $('#paidamount').val((parseFloat($('#'+id_val).val())*parseFloat(sessionStorage.currency_rate)).toFixed(decimal));
                                    }
                                }
                                else{
                                    $('#'+id_val).val($.trim($(this).text()));
                                    if(sessionStorage.currency_onoff=='Y'){
                                       $('#paidamount').val((parseFloat($('#'+id_val).val())*parseFloat(sessionStorage.currency_rate)).toFixed(decimal));
                                    }else{
                                        $('#paidamount').val($('#'+id_val).val()); 
                                    } 
                                }
                                enterd_amount=$('#paidamount').val();
                                var coupon_bal=$('#coupbal').val();
                                balance_amount=parseFloat(enterd_amount-coupon_bal);
                                if(balance_amount>0){
                                    $('#balanceamout').val(balance_amount.toFixed(decimal));
                                }else{

                                    $('#balanceamout').val(0);
                                }
                                $('#'+id_val).focus();
                            }
                        }
                    }
                    else{

                        $('#coupamount').val('');
                        $('#coupbal').val(bill_final_amount);
                        $('#paidamount').val('');
                        $('#balanceamout').val(0);
                        if($('#paidamount').hasClass('focused')){
                            $('#paidamount').focus();
                        }else{
                            $('#coupamount').focus();
                        }
                        if(sessionStorage.currency_onoff=='Y'){
                            $('#paid_amount_in_currency').val('');
                            $('#paid_amount_in_currency').focus();
                        }
                    }    
                } 

            /******** VOUCHER *******************************/ 
                /******************* Voucher method not  using **********************/  
    //        else if(settle_mode=='voucher'){
    //             
    //        }
            /******************* Voucher method not  using ********************/

            /************* COMPLIMENTARY *******************************/ 
                else if(settle_mode=='complimentary'){
                    if($(this).text()!='Clear'){
                        if($(this).hasClass('quick_cash')){
                            $('#completext').val($.trim($(this).text()));
                            $('#completext').focus();
                        }else{
                            if($('#completext').val()!=''){
                                $('#completext').val($('#completext').val()+$.trim($(this).text()));
                            }else{
                                 $('#completext').val($.trim($(this).text()));
                            }
                            $('#completext').focus();
                        }
                    }
                    else{
                        $('#completext').val('');
                        $('#completext').focus();
                    }
                }

            /************ CREDIT *******************************/
                else if(settle_mode=='credit'){

                    var new_card_amount=0;
                    var added_card_amount=sessionStorage.card_sum;
                    var total_added_card_amount=0;

                    if($(this).text()!='Clear'){
                        if($(this).hasClass('quick_cash')){
                            if($('#multi_cardamount').hasClass('focused')){
                                $('#multi_cardamount').val($.trim($(this).text()));

                                if($('#multi_cardamount').val()!=''){
                                    new_card_amount=$('#multi_cardamount').val();
                                }
                                total_added_card_amount=parseFloat(new_card_amount)+parseFloat(added_card_amount);
                                $('#transcationid').val(total_added_card_amount);
                                balance_amount=parseFloat(bill_final_amount-total_added_card_amount);
                                if(balance_amount>=0){
                                    $('#transbal').val(balance_amount.toFixed(decimal));
                                }else{
                                    balance_amount=parseFloat(bill_final_amount)-parseFloat(added_card_amount);
                                    $('#multi_cardamount').val('');
                                    $('#multi_cardamount').focus();
                                    $('#card_1').val('');
                                    $('#multicardtype').val('');
                                    $('#transcationid').val(sessionStorage.card_sum);
                                    $('#transbal').val(balance_amount.toFixed(decimal));
                                    $('#paidamount').val('');
                                    $('#balanceamout').val(0);

                                    $(".payment_pend_right_cash_error").css("display","block");
                                    $(".payment_pend_right_cash_error").addClass("popup_validate");
                                    $(".payment_pend_right_cash_error").text('Check Card Amount');
                                    $('.payment_pend_right_cash_error').delay(2000).fadeOut('slow');
                                    return false;
                                }
                                if($('#paidamount').val()!='' && (parseFloat($('#paidamount').val())>parseFloat($('#transbal').val())) ){

                                    $('#balanceamout').val((parseFloat($('#paidamount').val())-parseFloat($('#transbal').val())).toFixed(decimal));
                                }
                                $('#multi_cardamount').focus();
                            }
                            else {
                                if(sessionStorage.currency_onoff=='Y'){
                                    $('#paid_amount_in_currency').val($.trim($(this).text()));
                                    $('#paidamount').val((parseFloat($('#paid_amount_in_currency').val())*parseFloat(sessionStorage.currency_rate)).toFixed(decimal));
                                }else{
                                    $('#paidamount').val($.trim($(this).text()));
                                }
                                enterd_amount=$('#paidamount').val();
                                var card_bal=$('#transbal').val();
                                balance_amount=parseFloat(enterd_amount-card_bal);
                                if(balance_amount>0){
                                    $('#balanceamout').val(balance_amount.toFixed(decimal));
                                }else{

                                    $('#balanceamout').val(0);
                                }
                                $('#paidamount').focus();
                            }
                        }
                        else{
                            var id_val='';
                            if(sessionStorage.currency_onoff=='Y'){
                               id_val='paid_amount_in_currency'; 
                            }else{
                                id_val='paidamount'; 
                            }
                            if($('#multi_cardamount').hasClass('focused')){

                                if($('#multi_cardamount').val()!='' && $('#multi_cardamount').val()!=0){
                                    if(($.trim($(this).text())!='.' ||($.trim($(this).text())=='.' && !$('#multi_cardamount').val().includes('.')))&& $('#multi_cardamount').val().length<13){
                                        $('#multi_cardamount').val($('#multi_cardamount').val()+$.trim($(this).text()));
                                    }

                                    if($('#multi_cardamount').val()!=''){
                                        new_card_amount=$('#multi_cardamount').val();
                                    }
                                    total_added_card_amount=parseFloat(new_card_amount)+parseFloat(added_card_amount);
                                    $('#transcationid').val(total_added_card_amount);
                                    balance_amount=parseFloat(bill_final_amount-total_added_card_amount);
                                    if(balance_amount>=0){
                                        $('#transbal').val(balance_amount.toFixed(decimal));
                                    }else{
                                        balance_amount=parseFloat(bill_final_amount)-parseFloat(added_card_amount);
                                        $('#multi_cardamount').val('');
                                        $('#multi_cardamount').focus();
                                        $('#card_1').val('');
                                        $('#multicardtype').val('');
                                        $('#transcationid').val(sessionStorage.card_sum);
                                        $('#transbal').val(balance_amount.toFixed(decimal));
                                        $('#paidamount').val('');
                                        $('#balanceamout').val(0);

                                        $(".payment_pend_right_cash_error").css("display","block");
                                        $(".payment_pend_right_cash_error").addClass("popup_validate");
                                        $(".payment_pend_right_cash_error").text('Check Card Amount');
                                        $('.payment_pend_right_cash_error').delay(2000).fadeOut('slow');
                                        return false;
                                    }
                                }
                                else{

                                    $('#multi_cardamount').val($.trim($(this).text()));
                                    if($('#multi_cardamount').val()!=''){
                                        new_card_amount=$('#multi_cardamount').val();
                                    }    
                                    total_added_card_amount=parseFloat(new_card_amount)+parseFloat(added_card_amount);
                                    $('#transcationid').val(total_added_card_amount);
                                    balance_amount=parseFloat(bill_final_amount-total_added_card_amount);
                                    if(balance_amount>=0){
                                        $('#transbal').val(balance_amount.toFixed(decimal));
                                    }else{
                                        balance_amount=parseFloat(bill_final_amount)-parseFloat(added_card_amount);
                                        $('#multi_cardamount').val('');
                                        $('#multi_cardamount').focus();
                                        $('#card_1').val('');
                                        $('#multicardtype').val('');
                                        $('#transcationid').val(sessionStorage.card_sum);
                                        $('#transbal').val(balance_amount.toFixed(decimal));
                                        $('#paidamount').val('');
                                        $('#balanceamout').val(0);

                                        $(".payment_pend_right_cash_error").css("display","block");
                                        $(".payment_pend_right_cash_error").addClass("popup_validate");
                                        $(".payment_pend_right_cash_error").text('Check Card Amount');
                                        $('.payment_pend_right_cash_error').delay(2000).fadeOut('slow');
                                        return false;
                                    }
                                }
                                if($('#paidamount').val()!='' && (parseFloat($('#paidamount').val())>parseFloat($('#transbal').val())) ){

                                    $('#balanceamout').val((parseFloat($('#paidamount').val())-parseFloat($('#transbal').val())).toFixed(decimal));
                                }
                                $('#multi_cardamount').focus();
                            }
                            else if($('#'+id_val).hasClass('focused')){
                                if($('#'+id_val).val()!='' && $('#'+id_val).val()!=0){
                                    if(($.trim($(this).text())!='.' ||($.trim($(this).text())=='.' && !$('#'+id_val).val().includes('.')))&& $('#'+id_val).val().length<13){
                                        $('#'+id_val).val($('#'+id_val).val()+$.trim($(this).text()));
                                    }

                                    if(sessionStorage.currency_onoff=='Y'){
                                       $('#paidamount').val((parseFloat($('#'+id_val).val())*parseFloat(sessionStorage.currency_rate)).toFixed(decimal));
                                    }
                                }
                                else{
                                    $('#'+id_val).val($.trim($(this).text()));
                                    if(sessionStorage.currency_onoff=='Y'){
                                       $('#paidamount').val((parseFloat($('#'+id_val).val())*parseFloat(sessionStorage.currency_rate)).toFixed(decimal));
                                    }else{
                                        $('#paidamount').val($('#'+id_val).val()); 
                                    } 
                                }
                                enterd_amount=$('#paidamount').val();
                                var card_bal=$('#transbal').val();
                                balance_amount=parseFloat(enterd_amount-card_bal);
                                if(balance_amount>0){
                                    $('#balanceamout').val(balance_amount.toFixed(decimal));
                                }else{

                                    $('#balanceamout').val(0);
                                }
                                $('#'+id_val).focus();
                            }
                        }
                    }
                    else{
                        balance_amount=parseFloat(bill_final_amount)-parseFloat(added_card_amount);

                        $('#multi_cardamount').val('');
                        $('#card_1').val('');
                        $('#multicardtype').val('');
                        $('#transcationid').val(sessionStorage.card_sum);
                        $('#transbal').val(balance_amount.toFixed(decimal));
                        $('#paidamount').val('');
                        $('#balanceamout').val(0);
                                                
                        if(sessionStorage.currency_onoff=='Y'){
                            $('#paid_amount_in_currency').val('');
                            if($('#paid_amount_in_currency').hasClass('focused')){
                                $('#paid_amount_in_currency').focus();
                            }
                            else if($('#multi_cardamount').hasClass('focused')){
                                $('#multi_cardamount').focus();  
                            }
                        }else{
                            if($('#paidamount').hasClass('focused')){
                                $('#paidamount').focus();   
                            }
                            else if($('#multi_cardamount').hasClass('focused')){
                                $('#multi_cardamount').focus();  
                            }
                        }
                        
                    }
                }
        }        
    });
    
    /*******************************************Quick Cash & key pad Click Ends *******************************/
    
    /*************************************  credit types selecion starts **********************************************************  */
    $('#selectcreditypes').unbind().change(function () {
     
             var decimal=$('#decimal').val();
            var pd1=$('#paidamount_credit').val();
              var gr=$('#grandtotal').text();
            var gr1=gr.replace(',','');
          
            var sm1=gr1-pd1;
            var bill_final_amount1=$('#grandtotal').text();
             var bill_final_amount=bill_final_amount1.replace(',','');
            var credittype=	$(this).val();//alert(credittype)
            $('.credtitypeloads').html('<img src="img/ajax-loaders/ajax-loader-6.gif" />');
            var labelname=$("#selectcreditypes").find('option:selected').attr('label');
			 
            $.post("settle_popup_front.php", {credittype:credittype,action:'loadcreditypes'},
            function(data){
                //alert(data);
                $('.credtitypeloads').html(data);	
                $('.labelname').html(labelname);	
                var enterd_amount=$('#paidamount_credit').val();
                
                var balance_amount=parseFloat(bill_final_amount-enterd_amount);
                    if(balance_amount>0){
                        $('#amount_credit').val(balance_amount.toFixed(decimal));
                    }
            });
	});
			  
    /***************************************  credit types selection ends **********************************************************  */
    
    
    /********************************************settle button click from settlepopup front ************************************************/	
    
      $('.settle_print_auth').unbind().click(function(){
          
          
          if($('#pop_head').text()=="Settle Bill Authorization"){
              
               var pin= $('#pin').val();
                if(pin !=''){
                $.post("load_div.php", {set:'pincheck',pin:pin,type:'authpincheck'},
                function(data)
                {
                    
                        if($.trim(data)!='NO'){
                    var check=$.trim(data).split('*');
                 
                    if(check[11]=="billsettle:Y"){
                        
                        
                        
                       $('.settle_auth').hide();
        $('.confrmation_overlay_settle').hide();
        
        
         
        
        
        
         var settlebill=$('#settlebill').val();
        var bill_final_amount=$('#grandtotal').text();
        var settlement_bill=$('#settleingbilno').val();
        var settlement_mode =$('.mode_sel_btn_act').attr('id');
        var settlement_mode_id=$('.mode_sel_btn_act').attr('idval');
        var amount_paid=0;
        var balance_amount=0;
        var upi_amount=0;
        var upi_txn_id=null;
        var transaction_amount=0;
        var transaction_balance=0;
        var bank=0;
        var compliemntary_settle='N';
        var complimentary_remak=null;
        var voucher_id=null;
        var coupon_company=null;
        var coupon_amount=0;
        var coupon_balance_amount=0;
        var coupon_code='';
        var cheque_no=null;
        var cheque_bank_name=null;
        var cheque_amount=0;
        var cheque_balance_amount=0;
        var credit_settle='N'
        var credit_master_id=0;
        var credit_type=null;
        var credit_amount=0;
        var complementary_mgnt_staff=null;
        var complementary_mgnt_secretkey=null;
        var complementary_mgnt_staffid=null;
        var credit_remark=null;
        var guest_name=null;
        var guest_number=null;
        var room=null;
        var settlement_details1='';
        var last_adding_card_type=null;
        var last_adding_card_number=null;
        var last_adding_card_amount=0;
        var tip_amount=0;
        var tip_mode='C';
        
         var bill_final_amount_new= bill_final_amount.replace(',','');
        
        if($('#tip_amount').val()!='' && $('#tip_amount').val()>0){
            tip_amount=$('#tip_amount').val();
            tip_mode=$('#tip_pay_mode').val();
        }
        if(settlement_mode=='cash'){
            
            if($('#paidamount').val()!='' && $('#paidamount').val()>0){
              
                amount_paid=$('#paidamount').val();
                balance_amount=$('#balanceamout').val();
               var bill_final_amount1= bill_final_amount.replace(',','');
             
              
                if(parseFloat(amount_paid)>=parseFloat(bill_final_amount1)){
                    submit_values();
                }else{
                    $('#paidamount').focus();
                    $(".payment_pend_right_cash_error").css("display","block");
                    $(".payment_pend_right_cash_error").addClass("popup_validate");
                    $(".payment_pend_right_cash_error").text('Insufficient Amount Paid');
                    $('.payment_pend_right_cash_error').delay(2000).fadeOut('slow');
                    return false;
                }
            }else{
                $('#paidamount').focus();
                $(".payment_pend_right_cash_error").css("display","block");
		$(".payment_pend_right_cash_error").addClass("popup_validate");
		$(".payment_pend_right_cash_error").text('Check Amount Paid');
		$('.payment_pend_right_cash_error').delay(2000).fadeOut('slow');
                return false;
            }
        }
        else if(settlement_mode=='cheque'){
            cheque_no               =$('#cheqname').val();
            cheque_bank_name        =$('#cheqbank').val();
            cheque_amount           =$('#cheqamount').val();
            cheque_balance_amount   =$('#cheqbal').val();
            if(cheque_balance_amount>0 && $('#paidamount').val()!=''){
                amount_paid         =$('#paidamount').val();
                balance_amount      =$('#balanceamout').val();
            }
            
            
            if(cheque_amount=='' || cheque_amount==0){
                $('#cheqamount').focus();
                $(".payment_pend_right_cash_error").css("display","block");
                $(".payment_pend_right_cash_error").addClass("popup_validate");
                $(".payment_pend_right_cash_error").text('Check Cheque Amount');
                $('.payment_pend_right_cash_error').delay(2000).fadeOut('slow');
                return false;
            }
            else{
                
                if(parseFloat(amount_paid)<parseFloat(cheque_balance_amount)){
                    $('#paidamount').focus();
                    $(".payment_pend_right_cash_error").css("display","block");
                    $(".payment_pend_right_cash_error").addClass("popup_validate");
                    $(".payment_pend_right_cash_error").text('Insufficient Amount');
                    $('.payment_pend_right_cash_error').delay(2000).fadeOut('slow');
                    return false;
                }
                else{
                    submit_values();
                }
            }
        }        
        else if(settlement_mode=='complimentary'){
            compliemntary_settle='Y';
            if($.trim($('#completext').val())!=''){
                complimentary_remak=$('#completext').val();
            }    
            if(complimentary_remak==null){
                $('#completext').val('');
                $(".payment_pend_right_cash_error").css("display","block");
		$(".payment_pend_right_cash_error").addClass("popup_validate");
		$(".payment_pend_right_cash_error").text('Add Complimentary Remark');
		$('.payment_pend_right_cash_error').delay(2000).fadeOut('slow');
                return false;
            }
            else{
                submit_values();
            }
        }
        else if(settlement_mode=='credit_person'){
            credit_settle           ='Y';
            credit_amount           =$('#amount_credit').val();
            if($('#paidamount_credit').val()>0){
                amount_paid         =$('#paidamount_credit').val();
            }
            credit_remark           =$('#credit_remark').val();
            credit_type             =$('#selectcreditypes').val();
            
            if(credit_type==2){
               credit_master_id        =$('#selectcreditdetails').val();
            }
            if(credit_type==3|| credit_type==4){
                guest_name              =$('#selectcreditdetailsname').val();
                if(credit_type==4){
                    guest_number            =$('#selectcreditdetailsnumber').val();
                }
            }
            if(credit_type==1){
                room=$("#selectcreditdetails option:selected").text();
            }
            
            if(credit_type==''){
                $(".payment_pend_right_cash_error").css("display","block");
                $(".payment_pend_right_cash_error").addClass("popup_validate");
                $(".payment_pend_right_cash_error").text('Select Credit Type');
                $('.payment_pend_right_cash_error').delay(2000).fadeOut('slow');
                return false;
            }
            else{
                if(credit_type==2 && credit_master_id==0){
                    $(".payment_pend_right_cash_error").css("display","block");
                    $(".payment_pend_right_cash_error").addClass("popup_validate");
                    $(".payment_pend_right_cash_error").text('Select Staff');
                    $('.payment_pend_right_cash_error').delay(2000).fadeOut('slow');
                    return false;
                }
                else if((credit_type==3||credit_type==4) && guest_name==''){
                    
                    $(".payment_pend_right_cash_error").css("display","block");
                    $(".payment_pend_right_cash_error").addClass("popup_validate");
                    $(".payment_pend_right_cash_error").text('Enter Name');
                    $('.payment_pend_right_cash_error').delay(2000).fadeOut('slow');
                    return false;
                }else if(credit_type==1 && room==''){
                    $(".payment_pend_right_cash_error").css("display","block");
                    $(".payment_pend_right_cash_error").addClass("popup_validate");
                    $(".payment_pend_right_cash_error").text('Select Room');
                    $('.payment_pend_right_cash_error').delay(2000).fadeOut('slow');
                    return false;
                }
                else{
                    submit_values();
                }
            }
        }
        else if(settlement_mode=='coupon'){
            coupon_company          =$('#coupname').val();
            coupon_amount           =$('#coupamount').val();
            coupon_balance_amount   =$('#coupbal').val();
            coupon_code              =$('#coupon_code').val();
        
            if(coupon_balance_amount>0 && $('#paidamount').val()!=''){
                amount_paid         =$('#paidamount').val();
                balance_amount      =$('#balanceamout').val();
            }
            
            
            if(coupon_amount=='' || coupon_amount==0){
                $('#coupamount').focus();
                $(".payment_pend_right_cash_error").css("display","block");
                $(".payment_pend_right_cash_error").addClass("popup_validate");
                $(".payment_pend_right_cash_error").text('Check Coupon Amount');
                $('.payment_pend_right_cash_error').delay(2000).fadeOut('slow');
                return false;
            }
            else{
                
                if(parseFloat(amount_paid)<parseFloat(coupon_balance_amount)){
                    $('#paidamount').focus();
                    $(".payment_pend_right_cash_error").css("display","block");
                    $(".payment_pend_right_cash_error").addClass("popup_validate");
                    $(".payment_pend_right_cash_error").text('Insufficient Amount');
                    $('.payment_pend_right_cash_error').delay(2000).fadeOut('slow');
                    return false;
                }
                else{
                    submit_values();
                }
            }
        }
        else if(settlement_mode=='credit'){
            bank                    =$('#bankdetails').val();
            transaction_amount      =$('#transcationid').val();
            transaction_balance     =$('#transbal').val();
            if(transaction_balance>0 && $('#paidamount').val()!=''){
                amount_paid         =$('#paidamount').val();             
                balance_amount      =$('#balanceamout').val();
            }
            if($('#multicardtype').val()!=''){
                last_adding_card_type   =$('#multicardtype').val();
            }
            if($('#card_1').val()!=''){
                last_adding_card_number =$('#card_1').val();
            }
            last_adding_card_amount =$('#multi_cardamount').val();
            
            if(bank==null){
                $('#bankdetails').focus();
                $(".payment_pend_right_cash_error").css("display","block");
                $(".payment_pend_right_cash_error").addClass("popup_validate");
                $(".payment_pend_right_cash_error").text('Select Bank');
                $('.payment_pend_right_cash_error').delay(2000).fadeOut('slow');
                return false;
            }else{
                if(transaction_amount<=0){
                    $('#multi_cardamount').focus();
                    $(".payment_pend_right_cash_error").css("display","block");
                    $(".payment_pend_right_cash_error").addClass("popup_validate");
                    $(".payment_pend_right_cash_error").text('Add Card Amount');
                    $('.payment_pend_right_cash_error').delay(2000).fadeOut('slow');
                    return false;
                }
                else{
                    if(parseFloat(amount_paid)<parseFloat(transaction_balance)){
                        $('#paidamount').focus();
                        $(".payment_pend_right_cash_error").css("display","block");
                        $(".payment_pend_right_cash_error").addClass("popup_validate");
                        $(".payment_pend_right_cash_error").text('Insufficient Amount');
                        $('.payment_pend_right_cash_error').delay(2000).fadeOut('slow');
                        return false;
                    }else{
                        var card_details = {
                            "settlement_bill"               :settlement_bill,
                            "last_adding_card_type"         :last_adding_card_type,
                            "last_adding_card_number"       :last_adding_card_number,
                            "last_adding_card_amount"       :last_adding_card_amount
                        }
                        var card_details1=JSON.stringify(card_details);
                        
                        var last_card_details ='action=last_card_insert&card_details='+card_details1;
                        $.ajax({
                            type: "POST",
                            url: "settle_popup_front.php",
                            data: last_card_details,
                            success: function(data_return) {
                                
                                submit_values();
                            }
                        });    
                    }
                }
            }
            
            
        }
        /******************* Voucher method not  using **********************/  
//        else if(settlement_mode=='voucher'){
//             
//        }
        /******************* Voucher method not  using ********************/
        
        /******************* Upi coding pending **********************/  
//        else if(settlement_mode=='upi'){
//             
//        }
        /******************* Upi coding pending *********************/
        
        function submit_values(){
            
            var settlement_details = {
                "settlement_bill"               :settlement_bill,
                "settlement_mode"               :settlement_mode,
                "settlement_mode_id"            :settlement_mode_id,
                "amount_paid"                   :amount_paid,
                "upi_amount"                    :upi_amount,
                "upi_txn_id"                    :upi_txn_id,
                "transaction_amount"            :transaction_amount,
                "bank"                          :bank,
                "compliemntary_settle"          :compliemntary_settle,
                "complimentary_remak"           :complimentary_remak,
                "voucher_id"                    :voucher_id,
                "coupon_company"                :coupon_company,
                "coupon_amount"                 :coupon_amount,
                "coupon_code"                   :coupon_code,
                "cheque_no"                     :cheque_no,
                "cheque_bank_name"              :cheque_bank_name,
                "cheque_amount"                 :cheque_amount,
                "credit_settle"                 :credit_settle,
                "credit_master_id"              :credit_master_id,
                "credit_type"                   :credit_type,
                "credit_amount"                 :credit_amount,
                "balance_amount"                :balance_amount,
                "complementary_mgnt_staff"      :complementary_mgnt_staff,
                "complementary_mgnt_secretkey"  :complementary_mgnt_secretkey,
                "complementary_mgnt_staffid"    :complementary_mgnt_staffid,
                "credit_remark"                 :credit_remark,
                "guest_name"                    :guest_name,
                "guest_number"                  :guest_number,
                "room"                          :room,
                "tip_amount"                    :tip_amount,
                "tip_mode"                      :tip_mode,
                "bill_final_amount_new"            :bill_final_amount_new
            };
            settlement_details1=JSON.stringify(settlement_details);
           
           var auth=$('#code_comp_credit').val();
            var settlement_data ='action=bill_settle&settlement_details='+settlement_details1+"&auth_staff="+auth;
            $.ajax({
                type: "POST",
                url: "settle_popup_front.php",
                data: settlement_data,
                success: function(data_return) {
                    
                    
                    $('#copop').hide();
                      $('.counter_settle_popup_section_cont').hide();
                    
                        if($.trim(data_return)=='Payment succesfully processed'){
                            
                            
                            
                            var staff_log=check[13].split(':');
        
        var dataString_log ='value=pin_log&staff='+staff_log[1]+"&type=settle_bill";
                                $.ajax({
                                    type: "POST",
                                    url: "load_div.php",
                                    data: dataString_log,
                                    success: function(data) {
                                    }
                                });
                            
                            var pole_on=$('#pole_on').val();
                    
                     if(pole_on=='Y'){
                            
                            var data_pole = "set_pole=pole_display_all&display=thankyou";
			$.ajax({
			type: "POST",
			url: "index.php",
			data: data_pole,
			success: function(data5) {
			
			}
			});
                            
                        }   
                        
                        
                        
                      var  dataString = 'set=drawer_open_on_settle';
                         $.ajax({
                        type: "POST",
                        url: "cashdrawer_details.php",
                        data: dataString,
                        success: function(data3) {
                                
                                }
                        });       
                        
                        
                            
                            if(settlebill=='Y'){
                                $.post("print_details.php", {set:'billprint',bilno:settlement_bill});
                            }    
                            if($('#settleingbilno option').length==1){
                            $("#settleingbilno option[value="+settlement_bill+"]").remove();
                            $('.counter_settle_popup_section_cont').hide();
                            $('#alertdiv').css('display','block');
                            $('#alertdiv').text($.trim(data_return));
                            $('#alertdiv').delay(2000).fadeOut('slow');
                        }else if($('#settleingbilno option').length>1){
                            
                            $(".payment_pend_right_cash_error").css("display","block");
                            $(".payment_pend_right_cash_error").addClass("popup_validate");
                            $(".payment_pend_right_cash_error").text($.trim(data_return));
                            $('.payment_pend_right_cash_error').delay(2000).fadeOut('slow');
                            $("#settleingbilno option[value="+settlement_bill+"]").remove();
                            $('#settleingbilno').change();
                            //$('.pop_payment_mode_sel_btn:first').click();
                        }
                    }else{
                        $(".payment_pend_right_cash_error").css("display","block");
                        $(".payment_pend_right_cash_error").addClass("popup_validate");
                        $(".payment_pend_right_cash_error").text($.trim(data_return));
                        $('.payment_pend_right_cash_error').delay(2000).fadeOut('slow');
                    }  
                }
            });    
        }
                        
                    }else{
                        $('#pin_error').css("display",'block');
                      $('#pin_error').text('No Permission!');
                       $('#pin_error').delay(2000).fadeOut('slow');
                       $('#pin').val('');
                        $('#pin').focus();
                    }
                        
                        
                        
                        
                    }else{
                         $('#pin_error').css("display",'block');
                      $('#pin_error').text('CODE NOT REGISTERED!');
                       $('#pin_error').delay(2000).fadeOut('slow');
                       $('#pin').val('');
                        $('#pin').focus();
                    }
          });
          
                }else{
                    
                        $('#pin_error').css("display",'block');
                        $('#pin_error').text('Enter Pin');
                        $('#pin_error').delay(2000).fadeOut('slow');
                        $('#pin').val('');
                        $('#pin').focus();
                }
            }
      });
    
    
   ///real settle//// 
    
 $('#bill_settle_button').unbind().click(function(){ 
     
        
        $('#bill_settle_button').addClass('disablegenerate');    
     
     
        var entry=$('#di_settle_auth').val();
            
        if(entry=="Card/Pin"){
            
          $('#takeorder_btn').hide();
          $('#bill_prnt_btn').hide();
          $('#settle_prnt_btn').show();
         
         
        
         if ($('.table_chaange_pop').css('display') == 'none'){
             
         $('.settle_auth').show();
         $('.confrmation_overlay_settle').show();
         
         }
        
        $('#pop_head').text('Settle Bill Authorization')
        $('#pin').focus();
        $('#pin').val('');
        
        }else{
            
        var settlebill=$('#settlebill').val();
        var bill_final_amount=$('#grandtotal').text();
        var settlement_bill=$('#settleingbilno').val();
        var settlement_mode =$('.mode_sel_btn_act').attr('id');
        var settlement_mode_id=$('.mode_sel_btn_act').attr('idval');
        var amount_paid=0;
        var balance_amount=0;
        var upi_amount=0;
        var upi_txn_id=null;
        var transaction_amount=0;
        var transaction_balance=0;
        var bank=0;
        var compliemntary_settle='N';
        var complimentary_remak=null;
        var voucher_id=null;
        var coupon_company=null;
        var coupon_amount=0;
        var coupon_balance_amount=0;
        var coupon_code='';
        var cheque_no=null;
        var cheque_bank_name=null;
        var cheque_amount=0;
        var cheque_balance_amount=0;
        var credit_settle='N'
        var credit_master_id=0;
        var credit_type=null;
        var credit_amount=0;
        var complementary_mgnt_staff=null;
        var complementary_mgnt_secretkey=null;
        var complementary_mgnt_staffid=null;
        var credit_remark=null;
        var guest_name=null;
        var guest_number=null;
        var room=null;
        var settlement_details1='';
        var last_adding_card_type=null;
        var last_adding_card_number=null;
        var last_adding_card_amount=0;
        var tip_amount=0;
        var tip_mode='C';
        
         var bill_final_amount_new= bill_final_amount.replace(',','');
        
        if($('#tip_amount').val()!='' && $('#tip_amount').val()>0){
            
            tip_amount=$('#tip_amount').val();
            tip_mode=$('#tip_pay_mode').val();
        }
        
        
        
        if(settlement_mode=='cash'){
            
                if($('#paidamount').val()!='' && $('#paidamount').val()>0){
              
                amount_paid=$('#paidamount').val();
                balance_amount=$('#balanceamout').val();
                var bill_final_amount1= bill_final_amount.replace(',','');
             
              
                if(parseFloat(amount_paid)>=parseFloat(bill_final_amount1)){
                    submit_values();
                }else{
                    
                    $('#bill_settle_button').removeClass('disablegenerate');  
                    $('#paidamount').focus();
                    $(".payment_pend_right_cash_error").css("display","block");
                    $(".payment_pend_right_cash_error").addClass("popup_validate");
                    $(".payment_pend_right_cash_error").text('Insufficient Amount Paid');
                    $('.payment_pend_right_cash_error').delay(2000).fadeOut('slow');
                    return false;
                    
                }
                
            }else{
                 $('#bill_settle_button').removeClass('disablegenerate');  
                $('#paidamount').focus();
                $(".payment_pend_right_cash_error").css("display","block");
		$(".payment_pend_right_cash_error").addClass("popup_validate");
		$(".payment_pend_right_cash_error").text('Check Amount Paid');
		$('.payment_pend_right_cash_error').delay(2000).fadeOut('slow');
                return false;
                
            }
            
            
            
        }else if(settlement_mode=='cheque'){
            
            
            cheque_no               =$('#cheqname').val();
            cheque_bank_name        =$('#cheqbank').val();
            cheque_amount           =$('#cheqamount').val();
            cheque_balance_amount   =$('#cheqbal').val();
            if(cheque_balance_amount>0 && $('#paidamount').val()!=''){
                amount_paid         =$('#paidamount').val();
                balance_amount      =$('#balanceamout').val();
            }
            
            
            if(cheque_amount=='' || cheque_amount==0){
                $('#cheqamount').focus();
                $(".payment_pend_right_cash_error").css("display","block");
                $(".payment_pend_right_cash_error").addClass("popup_validate");
                $(".payment_pend_right_cash_error").text('Check Cheque Amount');
                $('.payment_pend_right_cash_error').delay(2000).fadeOut('slow');
                return false;
            }
            else{
                
                if(parseFloat(amount_paid)<parseFloat(cheque_balance_amount)){
                    $('#paidamount').focus();
                    $(".payment_pend_right_cash_error").css("display","block");
                    $(".payment_pend_right_cash_error").addClass("popup_validate");
                    $(".payment_pend_right_cash_error").text('Insufficient Amount');
                    $('.payment_pend_right_cash_error').delay(2000).fadeOut('slow');
                    return false;
                }
                else{
                    submit_values();
                }
            }
            
            
        }else if(settlement_mode=='complimentary'){
            
            
            compliemntary_settle='Y';
            if($.trim($('#completext').val())!=''){
                complimentary_remak=$('#completext').val();
            } 
            
            if(complimentary_remak==null){
                $('#completext').val('');
                $(".payment_pend_right_cash_error").css("display","block");
		$(".payment_pend_right_cash_error").addClass("popup_validate");
		$(".payment_pend_right_cash_error").text('Add Complimentary Remarks');
		$('.payment_pend_right_cash_error').delay(2000).fadeOut('slow');
                return false;
                 $('#bill_settle_button').removeClass('disablegenerate');  
            }
            else{
                submit_values();
            }
        }
        else if(settlement_mode=='credit_person'){
            
             var creditype1=$('#selectcreditypes').val();
             var guestnumber1=$('#selectcreditdetailsnumber').val();
                                        var dataString66 = 'set=check_user_credit&number='+guestnumber1;
					$.ajax({
					type: "POST",
					url: "load_index.php",
					data: dataString66,
					success: function(datal) {
                                                           
            if(($.trim(datal)=='ok' && creditype1=='4') || creditype1!='4'){
            
            
            credit_settle           ='Y';
            credit_amount           =$('#amount_credit').val();
            if($('#paidamount_credit').val()>0){
                amount_paid         =$('#paidamount_credit').val();
            }
            credit_remark           =$('#credit_remark').val();
            credit_type             =$('#selectcreditypes').val();
            
            if(credit_type==2){
               credit_master_id        =$('#selectcreditdetails').val();
            }
            if(credit_type==3|| credit_type==4){
                guest_name              =$('#selectcreditdetailsname').val();
                if(credit_type==4){
                    guest_number            =$('#selectcreditdetailsnumber').val();
                }
            }
            if(credit_type==1){
                room=$("#selectcreditdetails option:selected").text();
            }
            
            if(credit_type==''){
                $(".payment_pend_right_cash_error").css("display","block");
                $(".payment_pend_right_cash_error").addClass("popup_validate");
                $(".payment_pend_right_cash_error").text('Select Credit Type');
                $('.payment_pend_right_cash_error').delay(2000).fadeOut('slow');
                return false;
                 $('#bill_settle_button').removeClass('disablegenerate');  
            }
            else{
                if(credit_type==2 && credit_master_id==0){
                    $(".payment_pend_right_cash_error").css("display","block");
                    $(".payment_pend_right_cash_error").addClass("popup_validate");
                    $(".payment_pend_right_cash_error").text('Select Staff');
                    $('.payment_pend_right_cash_error').delay(2000).fadeOut('slow');
                    return false;
                     $('#bill_settle_button').removeClass('disablegenerate');  
                }
                
                else if((credit_type==3||credit_type==4) && guest_name==''){
                    
                    $(".payment_pend_right_cash_error").css("display","block");
                    $(".payment_pend_right_cash_error").addClass("popup_validate");
                    $(".payment_pend_right_cash_error").text('Enter Name & Number');
                    $('.payment_pend_right_cash_error').delay(2000).fadeOut('slow');
                    return false;
                     $('#bill_settle_button').removeClass('disablegenerate');  
                }else if(credit_type==4 && guest_number==''){
                    
                    $(".payment_pend_right_cash_error").css("display","block");
                    $(".payment_pend_right_cash_error").addClass("popup_validate");
                    $(".payment_pend_right_cash_error").text('Enter Number');
                    $('.payment_pend_right_cash_error').delay(2000).fadeOut('slow');
                    return false;
                     $('#bill_settle_button').removeClass('disablegenerate');  
                }
                
                    else if(credit_type==1 && room==''){
                    $(".payment_pend_right_cash_error").css("display","block");
                    $(".payment_pend_right_cash_error").addClass("popup_validate");
                    $(".payment_pend_right_cash_error").text('Select Room');
                    $('.payment_pend_right_cash_error').delay(2000).fadeOut('slow');
                    return false;
                     $('#bill_settle_button').removeClass('disablegenerate');  
                }
                else{
                    submit_values();
                }
            }
            
            } else{
                                               
                                             
                                            $('#selectcreditdetailsname').val('');
                                           $('#selectcreditdetailsnumber').val('');
                                           
                                           $(".payment_pend_right_cash_error").css("display","block");
					   $(".payment_pend_right_cash_error").addClass("popup_validate");
					   $(".payment_pend_right_cash_error").text("CUSTOMER INVALID");
					   $('.payment_pend_right_cash_error').delay(2000).fadeOut('slow');
                                           
                                           } 
                                                      
                                         }
                                         });
            
        }else if(settlement_mode=='coupon'){
            
            coupon_company          =$('#coupname').val();
            coupon_amount           =$('#coupamount').val();
            coupon_balance_amount   =$('#coupbal').val();
            coupon_code              =$('#coupon_code').val();
        
            if(coupon_balance_amount>0 && $('#paidamount').val()!=''){
                amount_paid         =$('#paidamount').val();
                balance_amount      =$('#balanceamout').val();
            }
            
            
            if(coupon_amount=='' || coupon_amount==0){
                $('#coupamount').focus();
                $(".payment_pend_right_cash_error").css("display","block");
                $(".payment_pend_right_cash_error").addClass("popup_validate");
                $(".payment_pend_right_cash_error").text('Check Coupon Amount');
                $('.payment_pend_right_cash_error').delay(2000).fadeOut('slow');
                return false;
            }
            else{
                
                if(parseFloat(amount_paid)<parseFloat(coupon_balance_amount)){
                    $('#paidamount').focus();
                    $(".payment_pend_right_cash_error").css("display","block");
                    $(".payment_pend_right_cash_error").addClass("popup_validate");
                    $(".payment_pend_right_cash_error").text('Insufficient Amount');
                    $('.payment_pend_right_cash_error').delay(2000).fadeOut('slow');
                    return false;
                }
                else{
                    submit_values();
                }
            }
        }
        else if(settlement_mode=='credit'){
            
            bank                    =$('#bankdetails').val();
            
            transaction_amount      =$('#transcationid').val();
            
            transaction_balance     =$('#transbal').val();
            
            if(transaction_balance>0 && $('#paidamount').val()!=''){
                amount_paid         =$('#paidamount').val();             
                balance_amount      =$('#balanceamout').val();
            }
            if($('#multicardtype').val()!=''){
                last_adding_card_type   =$('#multicardtype').val();
            }
            if($('#card_1').val()!=''){
                last_adding_card_number =$('#card_1').val();
            }
            last_adding_card_amount =$('#multi_cardamount').val();
            
            var last_adding_bank_type=null;
   
                if($('#multibanktype').val()!=''){
                     last_adding_bank_type   =$('#multibanktype').val();
                 }

          
            
            if(bank==null){
                
                $('#bill_settle_button').removeClass('disablegenerate');  
                
                $('#bankdetails').focus();
                $(".payment_pend_right_cash_error").css("display","block");
                $(".payment_pend_right_cash_error").addClass("popup_validate");
                $(".payment_pend_right_cash_error").text('Select Bank');
                $('.payment_pend_right_cash_error').delay(2000).fadeOut('slow');
                return false;
                
            }else{
                
                var multi_amt=parseFloat($('#multi_cardamount').val());   
                                     
                var grand_new_1=parseFloat($('#grandtotal').text());
                                     
              
                if(transaction_amount<=0 && grand_new_1!=multi_amt){
                    
                    $('#multi_cardamount').focus();
                    $('#bill_settle_button').removeClass('disablegenerate');  
                    $(".payment_pend_right_cash_error").css("display","block");
                    $(".payment_pend_right_cash_error").addClass("popup_validate");
                    $(".payment_pend_right_cash_error").text('Add Card Amount');
                    $('.payment_pend_right_cash_error').delay(2000).fadeOut('slow');
                    return false;
                     
                }
                else{
                    
                    if(parseFloat(amount_paid)<parseFloat(transaction_balance)){
                        
                        $('#paidamount').focus();
                        $('#bill_settle_button').removeClass('disablegenerate');  
                        $(".payment_pend_right_cash_error").css("display","block");
                        $(".payment_pend_right_cash_error").addClass("popup_validate");
                        $(".payment_pend_right_cash_error").text('Insufficient Amount');
                        $('.payment_pend_right_cash_error').delay(2000).fadeOut('slow');
                        return false;
                        
                    }else{
                        
                        
                      
                        if( ((transaction_balance=='0.00' || transaction_balance=='0.000' || transaction_balance=='0' ) && balance_amount=='0') || (transaction_balance>0 && parseFloat(amount_paid)>=transaction_balance  ))
			{       
                        
                            var card_details = {
                            "settlement_bill"               :settlement_bill,
                            "last_adding_card_type"         :last_adding_card_type,
                            "last_adding_card_number"       :last_adding_card_number,
                            "last_adding_card_amount"       :last_adding_card_amount,
                            "last_adding_bank_type"         :last_adding_bank_type
                        }
                        var card_details1=JSON.stringify(card_details);
                       
                        var last_card_details ='action=last_card_insert&card_details='+card_details1;
                       
                            $.ajax({
                            type: "POST",
                            url: "settle_popup_front.php",
                            data: last_card_details,
                            success: function(data_return) {
                                
                                 submit_values();
                            }
                            });  
                        
                        
                        }else{
                            
                          var multi_amt=parseFloat($('#multi_cardamount').val());   
                                     
                          var grand_new_1=parseFloat($('#grandtotal').text());
                                     
                        if(multi_amt==grand_new_1){ 
                            
                            
                            var card_details = {
                            "settlement_bill"               :settlement_bill,
                            "last_adding_card_type"         :last_adding_card_type,
                            "last_adding_card_number"       :last_adding_card_number,
                            "last_adding_card_amount"       :last_adding_card_amount
                          }
                        
                            var card_details1=JSON.stringify(card_details);
                        
                            var last_card_details ='action=last_card_insert&card_details='+card_details1;
                           
                            $.ajax({
                            type: "POST",
                            url: "settle_popup_front.php",
                            data: last_card_details,
                            success: function(data_return) {
                                
                                submit_values();
                            }
                            });  
                            
                        }else{
                            
                            
                            $('#bill_settle_button').removeClass('disablegenerate'); 
                            $(".payment_pend_right_cash_error").css("display","block");
                            $(".payment_pend_right_cash_error").addClass("popup_validate");
                            $(".payment_pend_right_cash_error").text('ADD CARD AMOUNT');
                            $('.payment_pend_right_cash_error').delay(2000).fadeOut('slow');
                            return false;  
                        
                        }
                        
                                                                                    
                        }
                        
                        
                    }
                }
            }
            
             var multi_amt=parseFloat($('#multi_cardamount').val());   
                                     
             var grand_new_1=parseFloat($('#grandtotal').text());
             
             if(grand_new_1==multi_amt){
                 
                  transaction_amount      =$('#multi_cardamount').val();
                  bank= $('#multibanktype').val();
             }
            
            
            
        }

        
        function submit_values(){
            
            var settlement_details = {
                "settlement_bill"               :settlement_bill,
                "settlement_mode"               :settlement_mode,
                "settlement_mode_id"            :settlement_mode_id,
                "amount_paid"                   :amount_paid,
                "upi_amount"                    :upi_amount,
                "upi_txn_id"                    :upi_txn_id,
                "transaction_amount"            :transaction_amount,
                "bank"                          :bank,
                "compliemntary_settle"          :compliemntary_settle,
                "complimentary_remak"           :complimentary_remak,
                "voucher_id"                    :voucher_id,
                "coupon_company"                :coupon_company,
                "coupon_amount"                 :coupon_amount,
                "coupon_code"                   :coupon_code,
                "cheque_no"                     :cheque_no,
                "cheque_bank_name"              :cheque_bank_name,
                "cheque_amount"                 :cheque_amount,
                "credit_settle"                 :credit_settle,
                "credit_master_id"              :credit_master_id,
                "credit_type"                   :credit_type,
                "credit_amount"                 :credit_amount,
                "balance_amount"                :balance_amount,
                "complementary_mgnt_staff"      :complementary_mgnt_staff,
                "complementary_mgnt_secretkey"  :complementary_mgnt_secretkey,
                "complementary_mgnt_staffid"    :complementary_mgnt_staffid,
                "credit_remark"                 :credit_remark,
                "guest_name"                    :guest_name,
                "guest_number"                  :guest_number,
                "room"                          :room,
                "tip_amount"                    :tip_amount,
                "tip_mode"                      :tip_mode,
                "bill_final_amount_new"         :bill_final_amount_new
            };
            
            settlement_details1=JSON.stringify(settlement_details);
           
           var auth=$('#code_comp_credit').val();
           
           if($("#sms_bill_settle").is(':checked'))
		{
			var sms_bill_settle='Y';
		}
		else
		{
		        var sms_bill_settle='N';
		}     
              var num_sms_new=$('#num_sms_new').val(); 
              var name_sms_new=$('#name_sms_new').val(); 
                   
              $('#bill_settle_button').css('pointer-events','none');
           
           
            setTimeout(function(){
                
                 $('#bill_settle_button').removeClass('disablegenerate');    
             
            }, 4000); 
           
            var settlement_data ='action=bill_settle&settlement_details='+settlement_details1+"&auth_staff="+auth+"&sms_bill_settle="+sms_bill_settle+"&num_sms_new="+num_sms_new+"&name_sms_new="+name_sms_new;
           
                $.ajax({
                type: "POST",
                url: "settle_popup_front.php",
                data: settlement_data,
                success: function(data_return) {
                   
                 var dt=$.trim(data_return).split('{');
                    
                 if(dt[0].includes('Payment succesfully processed')){
                     
                     $('#sms_bill_settle').prop('checked',false);      
                     $('#num_sms_new').val(''); 
                     $('#name_sms_new').val(''); 
                        
                    $('.confrmation_overlay_proce_load').css('display','block');
                    $('#bill_print_loader_new').html('<img src="img/ajax-loaders/loader_settling.gif" />');
                    
                    setTimeout(function () {
                         
                    $('.confrmation_overlay_proce_load').css('display','none');
                    $('#bill_print_loader_new').hide();
                    $('#bill_print_loader_new').html('');
                    
                    }, 1000);
                            
                         
                         
                       setTimeout(function(){
                              
                        $('#loader_disable'+settlement_bill).addClass('disablegenerate');
                                   
                        $('#loader_to_bill_id'+settlement_bill).css('display','block');
                        $('#loader_to_bill_id'+settlement_bill).fadeOut(3000);
                        
		        $('#loader_to_bill_id'+settlement_bill).html('Payment Processing');
                        
                         }, 100);
                         
                         var pole_on=$('#pole_on').val();
  
                       if(pole_on=='Y'){
                           
                        var data_pole = "set_pole=pole_display_all&display=thankyou";
			$.ajax({
			type: "POST",
			url: "index.php",
			data: data_pole,
			success: function(data5) {
			
			}
			});
                        
                        }   
                       
                       var cash_drawer_on_off=$('#cash_drawer_on_off').val();
  
                       if(cash_drawer_on_off=='Y'){  
                            
                        var dataString; 
                        dataString = 'set=drawer_open_on_settle';
                        $.ajax({
                        type: "POST",
                        url: "cashdrawer_details.php",
                        data: dataString,
                        success: function(data3) {
                                
                                }
                        });      
                        }
                            
                            if(settlebill=='Y'){
                                
                                $.post("print_details.php", {set:'billprint',bilno:settlement_bill});
                            }    
                            
                            
                            if($('#settleingbilno option').length==1){
                                
                            $("#settleingbilno option[value="+settlement_bill+"]").remove();
                            $('.counter_settle_popup_section_cont').hide();
                            $('#alertdiv').css('display','block');
                            $('#alertdiv').text('Payment succesfully processed');
                            $('#alertdiv').delay(2000).fadeOut('slow');
                            
                           }else if($('#settleingbilno option').length>1){
                            
                            $(".payment_pend_right_cash_error").css("display","block");
                            $(".payment_pend_right_cash_error").addClass("popup_validate");
                            $(".payment_pend_right_cash_error").text('Payment succesfully processed');
                            $('.payment_pend_right_cash_error').delay(2000).fadeOut('slow');
                            $("#settleingbilno option[value="+settlement_bill+"]").remove();
                            $('#settleingbilno').change();
                           
                           }
                        
                        
       
        ///lukado setup///
        var bil_lukado=settlement_bill;
       // setTimeout(function(){
         // alert(bil_lukado);
           //$.post("lukado.php", {set:'lukado_bill_dine',mode:'DI',billno:bil_lukado},function(data){ });
        
        // }, 1800); 
         ///lukado setup end///
        
                    }else{
                        $(".payment_pend_right_cash_error").css("display","block");
                        $(".payment_pend_right_cash_error").addClass("popup_validate");
                        $(".payment_pend_right_cash_error").text($.trim(data_return));
                        $('.payment_pend_right_cash_error').delay(2000).fadeOut('slow');
                    } 
                    
                    $('#bill_settle_button').css('pointer-events','inherit');
                }
            });    
        }
    }
    });
    
    
    /********************************************settle button click from settlepopup front ends ************************************************/	
    $('.currency_selected').unbind().change( function(){
          var decimal=$('#decimal').val();
        var mode_id=$('.mode_sel_btn_act').attr('id');
        var selected_currency='';
        if(mode_id=='credit_person'){
            $('#credit_currency_shortcode_dipslay').text('- in '+$('#credit_currency_selected option:selected').attr('shortcode'));
            $('#credit_paid_amount_in_currency').attr('selected_currency_id',$('#credit_currency_selected option:selected').val());
            selected_currency=$('#credit_currency_selected option:selected').val();
        }else{
            $('#currency_shortcode_dipslay').text('- in '+$('#currency_selected option:selected').attr('shortcode'));
            $('#paid_amount_in_currency').attr('selected_currency_id',$('#currency_selected option:selected').val());
            selected_currency=$('#currency_selected option:selected').val();
        }
        var currency_rate = 'action=currency_conversion_rate&selected_currency='+selected_currency;
        $.ajax({
            type: "POST",
            url: "settle_popup_front.php",
            data: currency_rate,
            success: function(data_return) {
                sessionStorage.currency_rate=$.trim(data_return);
                
                if(mode_id=='credit_person'){
                    if($('#credit_paid_amount_in_currency').val()!=''){
                        var enterd_amount=parseFloat($('#credit_paid_amount_in_currency').val())*parseFloat(sessionStorage.currency_rate);
                        
                        $('#paidamount_credit').val(enterd_amount.toFixed(decimal));
                    }else{
                        $('#paidamount_credit').val('');
                    }
                    enterbalance(event,'paidamount');
                    $('#credit_paid_amount_in_currency').focus();
                    
                }else{
                    if($('#paid_amount_in_currency').val()!=''){
                        var enterd_amount=parseFloat($('#paid_amount_in_currency').val())*parseFloat(sessionStorage.currency_rate);
                        $('#paidamount').val(enterd_amount.toFixed(decimal));
                    }else{
                        $('#paidamount').val('');
                    }
                    enterbalance(event,'paidamount');
                    $('#paid_amount_in_currency').focus();
                }
            }
        });
          
    });

});

//function go_to_order(table,asci){
//        var stewardsel=$('#stewardsel').val();
//        var persons=$('#personscount').val();
//        
//     $.post("load_div.php", {tableid:table,steward:stewardsel,persons:persons,type:'Single',set:'takeorder'},
//                                                      function(data)
//                                                      { alert(data);
//                                       window.location="menu_order.php?tableid="+table+"&staffid="+stewardsel+"&asciival="+asci;                     
//                                                      });
//          
//         
//      }  



$(document).keyup(function(e){
    
   e.stopImmediatePropagation();
    if(e.keyCode==13){
       
        var entry=$('#mode_of_entry').val();
            
   
        
        if($('#multi_cardamount').hasClass('focused') && entry!="Card/Pin"){
            
            if(parseFloat($('#transbal').val())==0){
                $('#bill_settle_button').click();
            }else{
                AddCard();
            }
        }
        else if($('.kotcancel_reason_popup_new:visible').length != 1 && $('.take_order_staff_sel_popup:visible').length==0 && $('.head_change').text()!="Complimentary Authorization" && $('.head_change').text()!="Credit Authorization" ){
           
         
            if($('#auth_val_set').val()=='yes_auth_pop')
            {
                
            $('#bill_settle_button').click();
            
            }
            
        }
        else if($('.take_order_staff_sel_popup:visible').length == 1 && $('#pop_head').text()!="Bill Print Authorization" && $('#pop_head').text()!="Settle Bill Authorization"){
            
            $('#take_order_staff_sel_popup_textbox_btn').click();
            
        }else if($('#pop_head').text()=="Bill Print Authorization"){
             $('.bill_print_auth').click();
        }else if($('#pop_head').text()=="Settle Bill Authorization"){
                $('.settle_print_auth').click();
          
        }
       
    }
    else if(e.keyCode==27){
        
        if($('.kotcancel_reason_popup_new:visible').length != 1 && $('.confirmpopup_reprint_di:visible').length != 1){
            if($('.counter_settle_popup:visible').length == 1){  
                $('#front_settle_popup_close').click();
            }
            else if($('.print-bill-in-tableselection-popup-cc:visible').length == 1){
            
            $('.print-bill-popup-close').click(); 
        }
        }
        else if($('.confirmpopup_reprint_di:visible').length == 1){
            $('.confirm_close_reprint_di').click(); 
        }
        else if($('.kotcancel_reason_popup_new:visible').length == 1){
            $('#kotcancel_reason_popup_new_cancel_btn').click(); 
        }
        
    }
});

/********************************************BILL SETTLEMENT FUNCTIONS  ************************************************/	    
function AddClass(id){
    
    if(id=='tip_amount'){
        $('#paidamount').removeClass('focused');
        $('#cheqamount').removeClass('focused');
        $('#coupamount').removeClass('focused');
        $('#paidamount_credit').removeClass('focused');
        $('#multi_cardamount').removeClass('focused');
        if(sessionStorage.currency_onoff=='Y'){
           $('#paid_amount_in_currency').removeClass('focused');
           $('#credit_paid_amount_in_currency').removeClass('focused');
        }
       $('#tip_amount').addClass('focused');
    }else{
        $('#tip_amount').removeClass('focused');
        var settle_mode=$.trim($('.mode_sel_btn_act').attr('id'));
        if(settle_mode=='cheque'){
            if(id=='cheqamount'){
                if(sessionStorage.currency_onoff=='Y'){
                   $('#paid_amount_in_currency').removeClass('focused');  
                }else{
                    $('#paidamount').removeClass('focused');
                }
                $('#cheqamount').addClass('focused');

            }else{
                $('#cheqamount').removeClass('focused');
                if(sessionStorage.currency_onoff=='Y'){
                   $('#paid_amount_in_currency').addClass('focused');  
                }else{
                    $('#paidamount').addClass('focused');
                } 
            }
        }
        else if(settle_mode=='coupon'){
            if(id=='coupamount'){
                if(sessionStorage.currency_onoff=='Y'){
                   $('#paid_amount_in_currency').removeClass('focused');  
                }else{
                    $('#paidamount').removeClass('focused');
                }
                $('#coupamount').addClass('focused');

            }else{
                $('#coupamount').removeClass('focused');
                if(sessionStorage.currency_onoff=='Y'){
                   $('#paid_amount_in_currency').addClass('focused');  
                }else{
                    $('#paidamount').addClass('focused');
                } 
            }

        }
        else if(settle_mode=='voucher'){
            if(id=='vocamount'){
                if(sessionStorage.currency_onoff=='Y'){
                   $('#paid_amount_in_currency').removeClass('focused');  
                }else{
                    $('#paidamount').removeClass('focused');
                }
                $('#vocamount').addClass('focused');

            }else{
                $('#vocamount').removeClass('focused');
                if(sessionStorage.currency_onoff=='Y'){
                   $('#paid_amount_in_currency').addClass('focused');  
                }else{
                    $('#paidamount').addClass('focused');
                } 
            }

        }
        else if(settle_mode=='credit'){
            if(id=='multi_cardamount'){
                if(sessionStorage.currency_onoff=='Y'){
                   $('#paid_amount_in_currency').removeClass('focused');  
                }else{
                    $('#paidamount').removeClass('focused');
                }
                $('#multi_cardamount').addClass('focused');

            }else{
                $('#multi_cardamount').removeClass('focused');
                if(sessionStorage.currency_onoff=='Y'){
                   $('#paid_amount_in_currency').addClass('focused');  
                }else{
                    $('#paidamount').addClass('focused');
                } 
            }

        }
    }
}
function payment_entering_feilds_hide(){
    $('.paid_amount_cc').hide();
    $('.paid_amount_cc_credit').hide();
    $('.cheque_cc').hide();
    $('.credit_type').hide();
    $('.credit_cc_normal').hide();
    $('.complimentrary_cc').hide();
    $('.voucher_cc').hide();
    $('.coupon_cc').hide();
    $('.upi_cc').hide();
    $('#paidamount').removeClass('focused');
    $('#cheqamount').removeClass('focused');
    $('#coupamount').removeClass('focused');
    $('#paidamount_credit').removeClass('focused');
    $('#multi_cardamount').removeClass('focused');
    if(sessionStorage.currency_onoff=='Y'){
       $('#paid_amount_in_currency').removeClass('focused');
       $('#credit_paid_amount_in_currency').removeClass('focused');
    }
    $('#tip_amount').removeClass('focused');
}
function enterbalance(e,field_id){
    
    var decimal=$('#decimal').val();
  
    
    var enterd_amount=0;
    var settle_mode=$.trim($('.mode_sel_btn_act').attr('id'));
    var bill_final_amount=$('#grandtotal').text().replace(",",'');
    var balance_amount=0;
    
  //if((105 >= e.keyCode && e.keyCode >=96) ||(57 >= e.keyCode && e.keyCode >=48)|| e.keyCode==110 || e.keyCode==46 || e.keyCode==8){
        if(settle_mode=='cash'){
            if(sessionStorage.currency_onoff=='Y'){
                if($('#paid_amount_in_currency').val()!=''){
                    enterd_amount=parseFloat($('#paid_amount_in_currency').val())*parseFloat(sessionStorage.currency_rate);
                    $('#paidamount').val(enterd_amount.toFixed(decimal));
                }else{
                    $('#paidamount').val('');
                }
            }
            enterd_amount=$('#paidamount').val();
            balance_amount=parseFloat(enterd_amount-bill_final_amount);
            if(balance_amount>0){
                $('#balanceamout').val(balance_amount.toFixed(decimal));
            }else{

                $('#balanceamout').val(0);
            }
            
                var paid=$('#paidamount').val();
                
                
                if($('#pole_on').val()=='Y'){ 
                    
                
                if(paid=="" || paid=="undefined" || paid=='0'){
                    var paid_display=0;
                    var bal_display=0;
                    var data_pole = 'set_pole_paid=pole_display_paid&paid='+paid_display+"&balance="+bal_display+"&mode=cash";
                    $.ajax({
                        type: "POST",
                        url: "index.php",
                        data: data_pole,
                        success: function(data5) {

                        }
                    });
                }  
                } 
                
                var paid_display=parseFloat(paid).toFixed(decimal);
                var bal_display=parseFloat(balance_amount).toFixed(decimal);


                
                if($('#pole_on').val()=='Y'){ 
                var data_pole = 'set_pole_paid=pole_display_paid&paid='+paid_display+"&balance="+bal_display+"&mode=cash";
                $.ajax({
                    type: "POST",
                    url: "index.php",
                    data: data_pole,
                    success: function(data5) {

                    }
                });
            }
                
                
        }
        
        else if(settle_mode=='cheque'){
            var checque_amount=$('#cheqamount').val();
            if(sessionStorage.currency_onoff=='Y'){
                if($('#paid_amount_in_currency').val()!=''){
                    enterd_amount=parseFloat($('#paid_amount_in_currency').val())*parseFloat(sessionStorage.currency_rate);
                    $('#paidamount').val(enterd_amount.toFixed(decimal));
                }else{
                    $('#paidamount').val('');
                }
            }
            enterd_amount=$('#paidamount').val();
            if(field_id=='cheqamount'){
              balance_amount=parseFloat(bill_final_amount-checque_amount);
                if(balance_amount>=0){
                    $('#cheqbal').val(balance_amount.toFixed(decimal));
                }else{
                    $('#cheqamount').val('');
                    $('#cheqbal').val(0);
                    $('#paidamount').val('');
                    $('#balanceamout').val(0);
                    $('#cheqamount').focus();
                    $(".payment_pend_right_cash_error").css("display","block");
                    $(".payment_pend_right_cash_error").addClass("popup_validate");
                    $(".payment_pend_right_cash_error").text('Check  Cheque Amount');
                    $('.payment_pend_right_cash_error').delay(2000).fadeOut('slow');
                    return false;
                } 
                if($('#paidamount').val()!='' && (parseFloat($('#paidamount').val())>parseFloat($('#cheqbal').val())) ){
                    
                    $('#balanceamout').val((parseFloat($('#paidamount').val())-parseFloat($('#cheqbal').val())).toFixed(decimal));
                }
            }
            else if(field_id=='paidamount'){
                var checque_bal=$('#cheqbal').val();
                balance_amount=parseFloat(enterd_amount-checque_bal);
                if(balance_amount>0){
                $('#balanceamout').val(balance_amount.toFixed(decimal));
                }else{

                    $('#balanceamout').val(0);
                }
            }
            
        }
        
        else if(settle_mode=='credit_person'){
            
            if(sessionStorage.currency_onoff=='Y'){
                if($('#credit_paid_amount_in_currency').val()!=''){
                    enterd_amount=parseFloat($('#credit_paid_amount_in_currency').val())*parseFloat(sessionStorage.currency_rate);
                    $('#paidamount_credit').val(enterd_amount.toFixed(decimal));
                }else{
                    $('#paidamount_credit').val('');
                }
            }
            
            enterd_amount=$('#paidamount_credit').val();
            balance_amount=parseFloat(bill_final_amount-enterd_amount);
            
            if(balance_amount>0){
                $('#amount_credit').val(balance_amount.toFixed(decimal));
            }else{
                if(sessionStorage.currency_onoff=='Y'){
                    $('#credit_paid_amount_in_currency').val('');
                    $('#credit_paid_amount_in_currency').focus();
                    $('#paidamount_credit').val('');
                     
                }else{
                    $('#paidamount_credit').val('');
                    $('#paidamount_credit').focus('');
                }    
                $('#amount_credit').val(bill_final_amount);
                
                $(".payment_pend_right_cash_error").css("display","block");
                $(".payment_pend_right_cash_error").addClass("popup_validate");
                $(".payment_pend_right_cash_error").text('Cash Paid Should be Less than Total');
                $('.payment_pend_right_cash_error').delay(2000).fadeOut('slow');
                return false;
            }
        }
        
        else if(settle_mode=='coupon'){
            var coupon_amount=$('#coupamount').val();
            if(sessionStorage.currency_onoff=='Y'){
                if($('#paid_amount_in_currency').val()!=''){
                    enterd_amount=parseFloat($('#paid_amount_in_currency').val())*parseFloat(sessionStorage.currency_rate);
                    $('#paidamount').val(enterd_amount.toFixed(decimal));
                }else{
                    $('#paidamount').val('');
                }
            }
            enterd_amount=$('#paidamount').val();
            if(field_id=='coupamount'){
              balance_amount=parseFloat(bill_final_amount-coupon_amount);
                if(balance_amount>=0){
                    $('#coupbal').val(balance_amount.toFixed(decimal));
                }else{
                    $('#coupamount').val('');
                    $('#coupbal').val(bill_final_amount);
                    $('#paidamount').val('');
                    $('#balanceamout').val(0);
                    $('#coupamount').focus();
                    $(".payment_pend_right_cash_error").css("display","block");
                    $(".payment_pend_right_cash_error").addClass("popup_validate");
                    $(".payment_pend_right_cash_error").text('Check  Coupon Amount');
                    $('.payment_pend_right_cash_error').delay(2000).fadeOut('slow');
                    return false;
                }
                if($('#paidamount').val()!='' && (parseFloat($('#paidamount').val())>parseFloat($('#coupbal').val())) ){
                    
                    $('#balanceamout').val((parseFloat($('#paidamount').val())-parseFloat($('#coupbal').val())).toFixed(decimal));
                }
            }
            else if(field_id=='paidamount'){
                var coupon_bal=$('#coupbal').val();
                balance_amount=parseFloat(enterd_amount-coupon_bal);
                if(balance_amount>0){
                $('#balanceamout').val(balance_amount.toFixed(decimal));
                }else{

                    $('#balanceamout').val(0);
                }
            }
            
        }
        
//        else if(settle_mode=='voucher'){
//            
//            
//        }
        
        else if(settle_mode=='credit'){
            
            var new_card_amount=0;
            if($('#multi_cardamount').val()!=''){
                new_card_amount=$('#multi_cardamount').val();
            }
            var added_card_amount=sessionStorage.card_sum;
            var total_added_card_amount=(parseFloat(new_card_amount)+parseFloat(added_card_amount)).toFixed(decimal);
            
            if(field_id=='multi_cardamount'){
               
              balance_amount=parseFloat(bill_final_amount)-parseFloat(total_added_card_amount);
              
                if(balance_amount>=0){
                    $('#transcationid').val(total_added_card_amount);
                    $('#transbal').val(balance_amount.toFixed(decimal));
                }else{
                    balance_amount=parseFloat(bill_final_amount)-parseFloat(added_card_amount);
                    $('#multi_cardamount').val('');
                    $('#transcationid').val(sessionStorage.card_sum);
                    $('#transbal').val(balance_amount.toFixed(decimal));
                    
                    $('#paidamount').val('');
                    $('#balanceamout').val(0);
                    $('#multi_cardamount').focus();
                    $(".payment_pend_right_cash_error").css("display","block");
                    $(".payment_pend_right_cash_error").addClass("popup_validate");
                    $(".payment_pend_right_cash_error").text('Transaction Amount cannot be more than Total');
                    $('.payment_pend_right_cash_error').delay(2000).fadeOut('slow');
                    return false;
                }
                if($('#paidamount').val()!='' && (parseFloat($('#paidamount').val())>parseFloat($('#transbal').val())) ){
                    
                    $('#balanceamout').val((parseFloat($('#paidamount').val())-parseFloat($('#transbal').val())).toFixed(decimal));
                }
            }
            else{
                if(sessionStorage.currency_onoff=='Y'){
                    if($('#paid_amount_in_currency').val()!=''){
                        enterd_amount=parseFloat($('#paid_amount_in_currency').val())*parseFloat(sessionStorage.currency_rate);
                        $('#paidamount').val(enterd_amount.toFixed(decimal));
                    }else{
                        $('#paidamount').val('');
                    }
                }
                enterd_amount=$('#paidamount').val();
                var trans_bal=$('#transbal').val();
                balance_amount=parseFloat(enterd_amount)-parseFloat(trans_bal);
                if(balance_amount>0){
                $('#balanceamout').val(balance_amount.toFixed(decimal));
                }else{

                    $('#balanceamout').val(0);
                }
            }
            
        }
    //}
}

 function comp_text(){
       
       var com=$('#completext').val();
      
                
                if($('#pole_on').val()=='Y'){ 
        var data_pole = 'set_pole_paid=pole_display_paid&paid='+com+"&mode=complimentary";
			$.ajax({
			type: "POST",
			url: "index.php",
			data: data_pole,
			success: function(data5) {
			
			}
			});
                    }       
   }       



 function numdot(e) {     
  
            var charCode;
            
            if (e.keyCode > 0) {
                charCode = e.which || e.keyCode;
            }
            else if (typeof (e.charCode) != "undefined") {
                charCode = e.which || e.keyCode;
            }
            if (charCode == 43)
                return true
            if (charCode > 31 && (charCode < 48 || charCode > 57))
                 
                return false;
            return true;
          
        }

function charlimit(evt,value)
{   
    evt = (evt) ? evt : window.event;
    var charCode = (evt.which) ? evt.which : evt.keyCode;
    
    if ((charCode<48 ||charCode>57) && charCode!=46)
    {
        return false;
    }else if(charCode==46 && value.includes('.')){
       return false; 
    }
    else if(value.length>13){
        return false;
    }
    return true;
}


function name_search_click() {
     $("#suggession_name").hide();
}


function foc_credit_calc(){
    $('.cr_first_key').show();
    $('.key_credit').hide();
}


function number_search(number) {
    
    $('.cr_first_key').hide();
    $('.key_credit').show();
    
    $('#focusedtext1').val('selectcreditdetailsnumber');
    
     var credit_type=$('#selectcreditypes').val();
     
   // $("#suggession_name").html('');
    
    if(number.length>1){
        
        $("#suggession_number").show(); 
        
        
       if($("#suggession_number").html()!=''){
         //alert('1');
        // $('#selectcreditdetailsname').val('');
     }
        var data_number='';
        var data_name='';
        var data1="set=guestnumber_search&number="+number+"&name=&credit_type="+credit_type;;
        $.ajax({
        type: "POST",
        url: "load_paymentpending.php",
        data: data1,
        success: function(data)
        {  $("#suggession_number").html('');
            //alert(data);
            data1=JSON.parse(data);
           var data_number=data1.mobile;
           var data_name=data1.name;
           //alert(data_name);
        for(var i=0;i<data_number.length;i++)
                {
                   $("#suggession_number").append('<div id="'+data_name[i]+'"  onclick="return number_select(this.id,'+data_number[i]+')">'+data_number[i]+' - '+data_name[i]+'</div>') ;
                     
                }
        }
         
        });
       
    }
     else{
            
              $("#suggession_number").hide();
              $("#suggession_number").html('');
              $("#suggession_name").hide();
           //   $("#suggession_name").html('');
             
            //  $('#selectcreditdetailsname').val('');
            
        }
}
function number_select(name,number){
    //alert(name);
    $('#selectcreditdetailsnumber').val(number);
    $('#selectcreditdetailsname').val(name);
    $("#suggession_number").html('');
    
}
function name_search(name) {
    
    var credit_type=$('#selectcreditypes').val();
    //alert(credit_type);
      
   // $("#suggession_number").html('');
    
    if(name.length>1){
        
        $("#suggession_number").show();
        
        if($("#suggession_name").html()!=''){
           //alert('2');
          $('#selectcreditdetailsnumber').val('');
      }
        
       if(credit_type=='4'){
           
        var data_number='';
        var data_name='';
        var data1="set=guestnumber_search&number=&name="+name+"&credit_type="+credit_type;
        $.ajax({
        type: "POST",
        url: "load_paymentpending.php",
        data: data1,
        success: function(data)
        {  
            $("#suggession_name").show();
            $("#suggession_name").html('');
            //alert(data);
            data1=JSON.parse(data);
           var data_number=data1.mobile;
           var data_name=data1.name;
           //alert(data_number);
        for(var j=0;j<data_name.length;j++)
                {
                   $("#suggession_name").append('<div class="name_apend" id="'+data_name[j]+'" number="'+data_number[j]+'"  onclick="return name_select(this.id,'+data_number[j]+')">'+data_number[j]+' - '+data_name[j]+'</div>') ;
                     
                }
        }
    });
    }
    
        else if(credit_type=='3'){
            //alert(name);
            var data_number='';
        var data_name='';
        var data1="set=guestnumber_search&number=&name="+name+"&credit_type="+credit_type;
        $.ajax({
        type: "POST",
        url: "load_paymentpending.php",
        data: data1,
        success: function(data)
        {   $("#suggession_name").show();
            $("#suggession_name").html('');
            //alert(data);
            data1=JSON.parse(data);
           var data_name=data1.name;
           //alert(data_number);
        for(var j=0;j<data_name.length;j++)
                {
                   $("#suggession_name").append('<div class="name_apend" id="'+data_name[j]+'" name="'+data_name[j]+'"  onclick="return name_select(this.id)">'+data_name[j]+'</div>') ;
                     
                }
        }
        });
        
        }
         
        }else{
            
              $("#suggession_number").hide();
             // $("#suggession_number").html('');
              $("#suggession_name").hide();
              $("#suggession_name").html('');
             // $('#selectcreditdetailsnumber').val('');
            
        }
       
    }
function name_select(name,number){
    
    var credit_type=$('#selectcreditypes').val();
    if(credit_type=='4'){
    $('#selectcreditdetailsnumber').val(number);
    $('#selectcreditdetailsname').val(name);
    }
    else if(credit_type=='3'){
        $('#selectcreditdetailsname').val(name);
    }
    $("#suggession_name").html('');
   
    
}

function name_select1(name){
    
      $('#selectcreditdetailsname').val(name);
      $("#suggession_name").html('');
      
    
 }



function AddCard(){
    
       $('.plusbtn').addClass('disablegenerate'); 
    
        setTimeout(function(){
           
          $('.plusbtn').removeClass('disablegenerate'); 
          
        }, 2500);
        
  var decimal=$('#decimal').val();
  var settlement_bill=$('#settleingbilno').val();
  var bill_final_amount=$('#grandtotal').text().replace(",",'');
  var last_adding_card_type=null;
  var last_adding_card_number=null;
  var last_adding_card_amount=0;
  
   var last_adding_bank_type=null;
   
   
    var bankdefault =  $("#bankdetails").val();   
  
   if($('#multibanktype').val()!=''){
        last_adding_bank_type   =$('#multibanktype').val();
    }
  
    if($('#multicardtype').val()!=''){
        last_adding_card_type   =$('#multicardtype').val();
    }
    if($('#card_1').val()!=''){
        last_adding_card_number =$('#card_1').val();
    }
    if($('#multi_cardamount').val()!=''){
        last_adding_card_amount =$('#multi_cardamount').val();
    }
    else{
        
        $('#multi_cardamount').focus();
         
        $(".payment_pend_right_cash_error").css("display","block");
        $(".payment_pend_right_cash_error").addClass("popup_validate");
        $(".payment_pend_right_cash_error").text('Enter Amount');
        $('.payment_pend_right_cash_error').delay(2000).fadeOut('slow');
        return false;
    }
    if(last_adding_card_amount>0){
        
        var card_details = {
            "settlement_bill"               :settlement_bill,
            "last_adding_card_type"         :last_adding_card_type,
            "last_adding_card_number"       :last_adding_card_number,
            "last_adding_card_amount"       :last_adding_card_amount,
            "last_adding_bank_type"         :last_adding_bank_type,
            "bankdefault"                   :bankdefault
        }
        var card_details1=JSON.stringify(card_details);
       
            var last_card_details ='action=last_card_insert&card_details='+card_details1+"&add_multicard=";
            $.ajax({
            type: "POST",
            url: "settle_popup_front.php",
            data: last_card_details,
            success: function(data_return) {
               // alert(data_return);
              
                data_return=JSON.parse(data_return);
                
                $("#multibanktype").val($("#multibanktype option:first").val());  
                $('#multicardtype').val('');
                
                $('#card_1').val('');
                $('#multi_cardamount').val('');
                $('#multi_cardamount').focus();
                sessionStorage.card_sum=data_return['CARD_SUM'];
                $('#transcationid').val(data_return['CARD_SUM']);
                $('#transbal').val((parseFloat(bill_final_amount)-parseFloat(data_return['CARD_SUM'])).toFixed(decimal));
                
                $.each(data_return['DETAILS'], function( key1, value1 ){
                    
                    
                    if(value1['CARD_NUMBER']==null){
                        value1['CARD_NUMBER']='';
                    }
                    
                    if(value1['CARD_TYPE']==null){
                        value1['CARD_TYPE']='';
                    }
                    
                     if(value1['BANK_TYPE']==null){
                        value1['BANK_TYPE']='';
                    }
                    
                    $(".cardadder").prepend("<div class='card_detail_popup_list refdiv_card ' id='card_detail_popup_list"+value1['SLNO']+"'  style='margin-bottom:3px'> <div class='card_detail_popup_type' style='width:25%;margin-right:1%;display:none'>"+
                        "<div class='card_type_dropdwn cardselect' style='text-align:center;padding-top:7px' id='multicardtype"+value1['SLNO']+"' >"+value1['CARD_TYPE']+
                        "</div>"+
                        "</div>"+  
                        "  <div class='card_detail_popup_type' style='width: 30%;display:none'>"+
                        "<input class='card_popup_digits cardno' type='text' id='card_1"+value1['SLNO']+"' value='" + value1['CARD_NUMBER'] + "' name='card_1"+value1['SLNO']+"'   maxlength='4' autocomplete='off'>"+
                        "</div>"+
                        "<div class='card_detail_popup_type' style='width:45%;margin-left:1%'>"+
                        "<input type='text' class='card_type_dropdwn amountall' id='multi_cardamount"+value1['SLNO']+"' value='" + value1['CARD_AMOUNT'] + "' name='multi_cardamount"+value1['SLNO']+"'  autocomplete='off' readonly>"+
                        " </div>"+
                        
                         "<div class='card_detail_popup_type' style='width:38%;margin-right:1%'>"+
                        "<div class='card_type_dropdwn cardselect' style='text-align:center;padding-top:7px' id='multibanktype"+value1['SLNO']+"' >"+value1['BANK_TYPE']+
                        "</div>"+
                        "</div>"+
                        
                        
                        "<div style='margin-top:0px;width: 12%;height: 34px;margin-top: -1px;float: right' id='del_card"+value1['SLNO']+"' name='del_card"+value1['SLNO']+"' class='menut_add_bq_btn' onclick='return deletecard("+value1['SLNO']+");'><img width='23px' src='img/cancel-icon.png'></div>"+
                        "</div>"        
                    );
                    
                });
            }
        }); 
    }
    
           
   
  
   if($('#multi_cardamount').val() == $('#grandtotal').text() ){
         
                $('#transcationid').val($('#multi_cardamount').val());
        
                $('#paidamount').val('0');
			
	        $('#transbal').val('0');
                          
                $('#bill_settle_button').click();  
           
    }
  
   

}

function deletecard(slno){
    
    var decimal=$('#decimal').val();
    var billno="temp_"+$('#settleingbilno').val();
    var bill_final_amount=$('#grandtotal').text().replace(",",'');
    var card_delete ='action=card_delete&card_slno='+slno+"&billno="+billno;
    $.ajax({
        type: "POST",
        url: "settle_popup_front.php",
        data: card_delete,
        success: function(data_return){
            $('#card_detail_popup_list'+slno).remove();
            data_return=JSON.parse(data_return);
            
            if(data_return['CARD_SUM']){
                sessionStorage.card_sum=data_return['CARD_SUM'];
            }else{
                sessionStorage.card_sum=0;
            }
            $('#transcationid').val(sessionStorage.card_sum);
            $('#transbal').val((parseFloat(bill_final_amount)-parseFloat(sessionStorage.card_sum)).toFixed(decimal));
            
           
        }
    });    
}
/********************************************menuload in settlepopup front  ************************************************/	    
function front_settle_popup_menuload(){
    $(".table_body").empty();
    var data1 = "action=billitems_select&billno="+$.trim($('#settleingbilno').val());
    var request= $.ajax({
        type: "POST",
        dataType: "text",
        url: "settle_popup_front.php", 
        data: data1,
        success: function(data) {
            
            var i=0;
            var parsed_data=JSON.parse(data);
            //alert(data);
            $('#table_list_view').text(parsed_data['TABLE']);
            $('#kot_list_view').text(parsed_data['KOT']);
            $('#grandtotal_sec_sub').text(parsed_data['SUBTOTAL']);
            $('#grandtotal_sec').text(parsed_data['FINAL']);
            
            $.each( parsed_data['MENUS'], function( key, value ){
                i++;
                $(".table_body").append(
                    '<tr>'+
                        '<td width="10%">'+i+'</td>'+
                        '<td style="text-align:left;padding-left:5px" width="40%"><span class="addon_txt">'+value['ADDON']+'</span>' +value['ITEM']+' (<span class="addon_txt">'+value['PORTION']+'</span>)' +
                        '<span class="combo_tbl_lst">'+value['COMBO_PACK_MENUS']+'</span>'+'</td>'+
                        '<td width="10%">'+value['QTY']+'</td>'+
                        '<td width="15%">'+value['RATE']+'</td>'+
                        '<td width="22%">'+value['TOTAL']+'</td>'+
                    '</tr>'
                );
            });   
        }
    });
}  
/********************************************menuload in settlepopup front ends ************************************************/

/********************************************BILL SETTLEMENT FUNCTIONS ENDS  ************************************************/	    

function table_enableButton1() {
        $('#personscount').val('');
        var input = document.querySelector('.screen');
            input.innerHTML = '';
            $('#personscount').val(input.innerHTML);
            $('#personscount').focus();
            decimalAdded = false;
        $('.line_higt_table_summ').removeClass('table_select');  
        document.getElementById("tablebutton2").disabled = false;
        document.getElementById("tablebutton1").disabled = true;
    }

function table_enableButton2() {
     var input = document.querySelector('.screen');
        input.innerHTML = '';
        $('#personscount').val(input.innerHTML);
        $('#personscount').focus();
        decimalAdded = false;
        $('#personscount').val('');
        $('.line_higt_table_summ').removeClass('table_select'); 
        $('.selectstafforedit').removeClass('table_select'); 
        document.getElementById("tablebutton2").disabled = true;
        document.getElementById("tablebutton1").disabled = false;
    }
    
function enter_proceed(e){
        
        var num=$('#text_bill_split').val();
        
         if (e.keyCode == 13 && num>0) {
       $('#proceed_split').click();
         }
    }
	    
$('#proceed_split').click(function(event) {
                event.stopImmediatePropagation();

      var txt_no=$('#text_bill_split').val();
      var floor=$('.table_floor_select_btn_act').attr('id');
      var floor_split=floor.split('flr_');
      var stw=$('#stewardsel').val();
      
      var ordno=$('.print-table-btn').attr('order');
                
                  var ordno1=ordno.split('_');
                  var ordno11= ordno1[1].split(',');
                  
                  var ordno_array=new Array();
                  for(var i=0;i<ordno11.length;i++){
                     
                 if(ordno11[i]!='' && !ordno_array.includes(ordno11[i]) ){
                     ordno_array.push(ordno11[i]);
                 }
                      }
          
    var arr_count_check=ordno_array.length;
    if(arr_count_check=='1'){
               var data1 = "set_qty=order_qty&all_order_no="+ordno_array;;
    
  
                        var request= $.ajax({
			  type: "POST",
			  dataType: "text",
			  url: "load_div.php", 
			  data: data1,
			  success: function(data) {
                          var data3=$.trim(data);
                        
                            var ctt=data3.split('*');
                           if(txt_no!="" && txt_no>1){
                               
     if ($('#manualcheck').is(":checked"))
    {
      
        var count=ctt[0];
        var msg="Quantity";
        
    }   else{
      
       count=ctt[0];
       msg=" Quantity";
    }         
      
     if(parseFloat(txt_no)<=parseFloat(count)){
     
     if ($('#manualcheck').is(":checked"))
    {
         var data = "set_split=order_split&billcount="+txt_no+"&order_no="+ordno_array+"&floor_split="+floor_split[1]+"&steward="+stw;
    }else{
         var data = "set_split=order_split&billcount="+txt_no+"&order_no="+ordno_array+"&floor_split="+floor_split[1]+"&steward="+stw;
    }
    
    if ($('#manualcheck').is(":checked"))
   {
  var split_option_new=$('#manualcheck').val();
  }
  
  if ($('#holdsplit').is(":checked"))
   {
  var split_option_new=$('#holdsplit').val();
  }
   
    
    if(split_option_new=='manual'){
  
                        var request= $.ajax({
			  type: "POST",
			  dataType: "text",
			  url: "order_split.php", 
			  data: data,
			  success: function(data) {
                       
                               window.location.href="order_split.php";
                          }
                      });
                  }else{
                      
                      var request= $.ajax({
			  type: "POST",
			  dataType: "text",
			  url: "order_split_hold.php", 
			  data: data,
			  success: function(data) {
                       
                               window.location.href="order_split_hold.php";
                          }
                      });
                      
                      
                  }
                  
                  
                  
                  
                      
                          }else{
        $("#error_split").css("display","block");
        $("#error_split").text("Invalid Entry . Please Check "+msg);
        $("#error_split").delay(2000).fadeOut('slow');
        $('#text_bill_split').focus();
        $('#text_bill_split').val('');
                          }
                      
      }else{
          
        $("#error_split").css("display","block");
        $("#error_split").text("Enter Valid Details");
        $("#error_split").delay(2000).fadeOut('slow');
        $('#text_bill_split').focus();
        $('#text_bill_split').val('');
         
      }
                          
                          
                          
                          
                          }
                      });       
                      }else{
         $("#error_split").css("display","block");
        $("#error_split").text("Combined Orders Cant Be Splitted");
        $("#error_split").delay(2000).fadeOut('slow');
        $('#text_bill_split').focus();
        $('#text_bill_split').val('');
                      }
});



 $('.pay_settle_btn_cr').click( function(event) {
          
		event.stopImmediatePropagation();
                $('#focusedtext').val('selectcreditdetailsnumber');
		var focused=$('#focusedtext').val();
               
		var calval=($(this).text());//alert(focused);alert(calval);
		
		var org=$('#'+focused).val();
			if(calval>=0)
			{
                            if(org.length < 12){
				if(org==0)
				{
					 $('#'+focused).val(calval);
				}else if(org>0)
				{
					$('#'+focused).val(org+calval);
				  
				}else if(org<0)
				{
					$('#'+focused).val(org+calval);
				}
                            }
			}else if(calval=="Clear")
			{
				$('#'+focused).val("");
			}else if(calval==".")
			{
				$('#'+focused).val(org+".");
			}
			$('#'+focused).change();
		$('#'+focused).focus();
	
	});

    
                