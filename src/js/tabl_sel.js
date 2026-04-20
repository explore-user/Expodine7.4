// JavaScript Document  
	
$(document).ready(function(event){
       if(!localStorage.clickcount){
          localStorage.clickcount=0; 
       }
	var loaderrorvar=$('.loaderrorsel');
	
	/***************************************  Calculator functions  starts ****************************************************  */
	//text box change
	$('#personscount').change(function () {
	  var input = document.querySelector('.screen');
	  input.innerHTML=$('#personscount').val();
	 
	  if(!isNumeric($('#personscount').val()))
	  {
		  $('.loaderrorsel').css("display",'block');
		  $('.loaderrorsel').addClass("tableselection_validate");
		  $('.loaderrorsel').text("Enter a valid persons count");
		  $('.loaderrorsel').delay(2000).fadeOut('slow');
	  }
	  $('#personscount').focus();
 	});
	//backspace
   $('.eval').click(function () {
	  var input = document.querySelector('.screen');
	  var str =$('#personscount').val();
	  str = str.substring(0, str.length - 1);
	  $('#personscount').val(str);
	  input.innerHTML=$('#personscount').val();
	  $('#personscount').focus();
  
   });
   
    $('#load_tables').on('click',  function(event, ui) {
       var n = $( ".table_select" ).length;
       if(n >= 1){
       var selected_activities =$('.table_select');
          var ids = new Array();
          var sum = 0;
          selected_activities.each(function(){
            var id_str   =  $(this).attr("vcct");
            var id_arr = id_str.split("_");
            var selval =  id_arr[1];
            sum += Number(selval);
                        //alert(sum);    
            var str =$('#personscount').val();
            str = sum;
            $('#personscount').val(str);
             document.getElementById('personscount').select();
             $('#personscount').focus();
 	});
         }else{
        //alert("sorry");
         $('#personscount').val('');
         
       }
        });
        

	/***************************************  Calculator functions ends *************************************************************  */ 
	
	/***************************************  take order  starts ******************************************************************  */
	$('#takorder').click(function (e) { 
            
            
            e.stopImmediatePropagation();
                
                localStorage.clickcount++;
                
                if(localStorage.clickcount==1){
             
        if($('#takorder').hasClass('orderedtable')){
                    
                    var staff_sel_mode= $('#staff_selection_mode').val();
                    var msg1 = ($("#msg1").val()); 
                    var msg2 = ($("#msg2").val());
                    var msg3 = ($("#msg3").val());
                    var msg5 = ($("#msg5").val());
                    var orderid='';
                        var stv   =  $('.allready').attr("stvid");
                        
			var stv_n	  =	 stv.split("_");
			var stv_id       =  stv_n[1];
                        
			if(stv_id=="")
			{
				var steward=$('#stewardsel').val();
                               
				if(steward!="" && $('#stewardsel').val()!="null" && $('#stewardsel').val()!=null)
				{
				  var order   =  $('.allready').attr("ordrd");
				  var order_v	  =	 order.split("_");
				  var orderid       =  order_v[1];
                                  $('#takorder').css('pointer-events','none');
				  window.location="menu_order.php?orderid="+orderid+"&staffid="+steward;
                                  
				}else
				{       
                                    $('#takorder').css('pointer-events','inherit');
					$('.loaderrorsel').css("display",'block');
					$('.loaderrorsel').addClass("tableselection_validate");
					$('.loaderrorsel').text("Select any steward to Proceed");
					$('.loaderrorsel').delay(2000).fadeOut('slow');
                                        localStorage.clickcount=0;
				}
			}else
			{  
                            
                        if(staff_sel_mode == 'Drop_Down'){
                                
                                var steward=$('#stewardsel').val();
				var order   =  $('.allready').attr("ordrd");
				var order_v	  =	 order.split("_");
				var orderid       =  order_v[1];
                                $('.selectstafforedit').removeClass('allready');    
                                $('#takorder').removeClass('orderedtable');
                                $('#takorder').css('pointer-events','none');
                                
                                if(steward!="" && $('#stewardsel').val()!="null" && $('#stewardsel').val()!=null)
				{
				           window.location="menu_order.php?orderid="+orderid+"&staffid="+steward;
                                }else{
                                     
                                        $('#takorder').css('pointer-events','inherit');
                                        loaderrorvar.css("display",'block');
                                        loaderrorvar.addClass("tableselection_validate");
                                        loaderrorvar.text('Select Steward');
                                        $('.loaderrorsel').delay(2000).fadeOut('slow');
                                        localStorage.clickcount=0;  
                                     
                                }
                                
                            }else if(staff_sel_mode == 'Card/Pin'){
                                
                                $('#takorder').css('pointer-events','inherit');
                                $('#pop_head').text('PLEASE SWIPE YOUR CARD');
                                $('.take_order_staff_sel_popup').css('display','block');
                                $('.confrmation_overlay').css('display','block');
                                $('#pin').focus();
                                $('#pin').val('');
                                localStorage.clickcount=0;
                                
                            }
                                
			}
                    
        }else{
                   
                    
                var staff_sel_mode= $('#staff_selection_mode').val();
                var msg1 = ($("#msg1").val()); 
                var msg2 = ($("#msg2").val());
                var msg3 = ($("#msg3").val());
                var msg5 = ($("#msg5").val());
                var ids = new Array();
                var input = document.querySelector('.screen');
                var inputVal = input.innerHTML;
                
                if(isNumeric(inputVal))
                      {
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
                        if(ids!="")
                        { 
                            var persons=$('#personscount').val();
                            persons=persons.trim();
                            if(persons!=0){
                            //---
                            if(staff_sel_mode == 'Drop_Down'){
                                //---
                                var tablect=ids.length;
                                var type="";
                                if(tablect==1)
                                {
                                        type="Single";
                                }
                                else if(tablect>1)
                                {
                                        type="Group";
                                }
                                var steward=$('#stewardsel').val();
                                
                                if($('#stewardsel').val()!="" && $('#stewardsel').val()!="null" && $('#stewardsel').val()!=null)
                                {
                                        
                                        if($('#personscount').val()!="")
                                        {
                                            
                                            
                                          
                                                 $.post("load_div.php", {tableid:ids,steward:steward,persons:persons,type:type,set:'takeorder'},
                                                      function(data)
                                                      {
                                                      data=$.trim(data);
                                                  
                                                      if(data.indexOf("exception") == -1)
                                                      {

                                                      if(data==0)
                                                            {
                                                                
                                                                if(staff_sel_mode == 'Drop_Down'){
                                                                    
                                                                   $('#takorder').css('pointer-events','none');
                                                                   window.location="menu_order.php?tableid="+ids+"&staffid="+steward+"&asciival="+asci;
                                                                }
                                                                    
                                                            }
                                                      }else
                                                      {
                                                              
                                                               $('#takorder').css('pointer-events','inherit');
                                                               localStorage.clickcount=0;
                                                      }
                                                           
                                                      });
                                        }else
                                        {       
                                                $('#takorder').css('pointer-events','inherit');
                                                loaderrorvar.css("display",'block');
                                                loaderrorvar.addClass("tableselection_validate");
                                                loaderrorvar.text(msg3);
                                                $('.loaderrorsel').delay(2000).fadeOut('slow');
                                                $('#personscount').focus();
                                                localStorage.clickcount=0;
                                        }
                                        
                                }else
                                {      
                                    
                                        $('#takorder').css('pointer-events','inherit');
                                        loaderrorvar.css("display",'block');
                                        loaderrorvar.addClass("tableselection_validate");
                                        loaderrorvar.text(msg2);
                                        $('.loaderrorsel').delay(2000).fadeOut('slow');
                                        localStorage.clickcount=0;
                                }
                                //----------
                            }else if(staff_sel_mode == 'Card/Pin'){
                                
                                $('#takorder').css('pointer-events','inherit');
                                $('#pop_head').text('PLEASE SWIPE YOUR CARD');
                                $('.take_order_staff_sel_popup').css('display','block');
                                $('.confrmation_overlay').css('display','block');
                                $('#pin').focus();
                                $('#pin').val('');
                                localStorage.clickcount=0;
                            }

                        }else
                        {
                            $('#takorder').css('pointer-events','inherit');
                                loaderrorvar.css("display",'block');
                                loaderrorvar.addClass("tableselection_validate");
                                loaderrorvar.text(msg5);
                                $('.loaderrorsel').delay(2000).fadeOut('slow');
                                 localStorage.clickcount=0;
                        }
                        }else
                        {
                            $('#takorder').css('pointer-events','inherit');
                                loaderrorvar.css("display",'block');
                                loaderrorvar.addClass("tableselection_validate");
                                loaderrorvar.text(msg1);
                                $('.loaderrorsel').delay(2000).fadeOut('slow');
                                 localStorage.clickcount=0;
                        }
                      }else
                      {         $('#takorder').css('pointer-events','inherit');
                              loaderrorvar.css("display",'block');
                              loaderrorvar.addClass("tableselection_validate");
                              loaderrorvar.text("Enter a valid persons count");
                              $('.loaderrorsel').delay(2000).fadeOut('slow');
                               localStorage.clickcount=0;
                      }   
                      
                } }
                      
        });
	/***************************************  take order ends ******************************************************************  */
        /***************************************  pin popup start ******************************************************************  */
        
        $('#take_order_staff_sel_popup_textbox_btn').click(function (e) {
            
            if($('#pop_head').text()!="Bill Print Authorization" && $('#pop_head').text()!="Settle Bill Authorization"){
                e.stopImmediatePropagation();
                localStorage.clickcount++;
                if(localStorage.clickcount==1){
                var pin= $('#pin').val();
                if(pin !=''){
                $.post("load_div.php", {set:'pincheck',pin:pin,type:'staffsel'},
                function(data)
                {
                    data=$.trim(data);
                    
                    if(data!='NO'){
                        
                      if( data.indexOf('NO PERMISSION') != -1 ){
                         $('#pin_error').css("display",'block');
                      $('#pin_error').text('NO PERMISSION!');
                      $('#pin_error').delay(2000).fadeOut('slow');
                      $('#pin').val('');
                        $('#pin').focus();
                         localStorage.clickcount=0; 
                      }else{
                      
                      
                      
                    var  data1=data.split('*');
                var steward=data1[0];
                
                
                 
                
                
                
                if($('#takorder').hasClass('orderedtable')){
                    
                   
                    
                    
                    var staff_sel_mode= $('#staff_selection_mode').val();
                    
                                
				if(steward!="")
				{
				  var order   =  $('.allready').attr("ordrd");
				  var order_v	  =	 order.split("_");
				  var orderid       =  order_v[1];
				  window.location="menu_order.php?orderid="+orderid+"&staffid="+steward;
                                  
                                  
                                   var dataString_log ='value=pin_log&staff='+steward+"&type=take_order";
                                   $.ajax({
                                    type: "POST",
                                    url: "load_div.php",
                                    data: dataString_log,
                                    success: function(data) {
                                    }
                                });
                                  
                                  
				}
			
                    $('.selectstafforedit').removeClass('allready');    
                    $('#takorder').removeClass('orderedtable');
                }
                else{
                    
                var staff_sel_mode= $('#staff_selection_mode').val();
                var msg1 = ($("#msg1").val()); 
                var msg2 = ($("#msg2").val());
                var msg3 = ($("#msg3").val());
                var ids = new Array();
                var input = document.querySelector('.screen');
                var inputVal = input.innerHTML;
                if(isNumeric(inputVal))
                      {
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
                        if(ids!="")
                        {
                           
                                var tablect=ids.length;
                                var type="";
                                if(tablect==1)
                                {
                                        type="Single";
                                }
                                else if(tablect>1)
                                {
                                        type="Group";
                                }
                                
                                if($('#stewardsel').val()!="")
                                {
                                        var persons=$('#personscount').val();
                                        persons=persons.trim();
                                        if($('#personscount').val()!="")
                                        {
                                                 $.post("load_div.php", {tableid:ids,steward:steward,persons:persons,type:type,set:'takeorder'},
                                                      function(data)
                                                      {
                                                      data=$.trim(data);
                                                      if(data.indexOf("exception") == -1)
                                                      {

                                                      if(data==0)
                                                            {
                                                                   
                                           window.location="menu_order.php?tableid="+ids+"&staffid="+steward+"&asciival="+asci;
                                                                
                                                                  
                                    var dataString_log ='value=pin_log&staff='+steward+"&type=take_order";
                                   $.ajax({
                                    type: "POST",
                                    url: "load_div.php",
                                    data: dataString_log,
                                    success: function(data) {
                                    }
                                    });
                                                                  
                                                                    
                                                            }
                                                      }else
                                                      {
                                                              alert(data);
                                                      }

                                                      });
                                        }else
                                        {
                                                loaderrorvar.css("display",'block');
                                                loaderrorvar.addClass("tableselection_validate");
                                                loaderrorvar.text(msg3);
                                                $('.loaderrorsel').delay(2000).fadeOut('slow');
                                                $('#personscount').focus();
                                                localStorage.clickcount=0;
                                        }
                                }else
                                {
                                        loaderrorvar.css("display",'block');
                                        loaderrorvar.addClass("tableselection_validate");
                                        loaderrorvar.text(msg2);
                                        $('.loaderrorsel').delay(2000).fadeOut('slow');
                                        localStorage.clickcount=0;
                                }
                                //----------
                            
                        }else
                        {
                            
                                loaderrorvar.css("display",'block');
                                loaderrorvar.addClass("tableselection_validate");
                                loaderrorvar.text(msg1);
                                $('.loaderrorsel').delay(2000).fadeOut('slow');
                                localStorage.clickcount=0;
                        }
                      }else
                      {
                              loaderrorvar.css("display",'block');
                              loaderrorvar.addClass("tableselection_validate");
                              loaderrorvar.text("Enter a valid persons count");
                              $('.loaderrorsel').delay(2000).fadeOut('slow');
                              localStorage.clickcount=0;
                      }
                    }
                      }
                  }
                  else{
                      $('#pin_error').css("display",'block');
                      $('#pin_error').text('CODE NOT REGISTERED!');
                       $('#pin_error').delay(2000).fadeOut('slow');
                       $('#pin').val('');
                         $('#pin').focus();
                       localStorage.clickcount=0;
                  }
                  });  
                  }
                  else{ 
                      $('#pin_error').css("display",'block');
                      $('#pin_error').text('ENTER PIN');
                       $('#pin_error').delay(2000).fadeOut('slow');
                       $('#pin').val('');
                         $('#pin').focus();
                       localStorage.clickcount=0;
                  }
              }
          }
        });
        
        /***************************************  pin popup ends ******************************************************************  */
        function pinvalidate(){
            var pin = $('#pin').val();
            if(Number(parseFloat(pin))==pin){
                alert("yes");
            }else{
                alert("no");
            }
        }
        
        
//        jQuery('#pin').keyup(function (e) { 
//            this.value = this.value.replace(/[^0-9\.]/g,'');
//            if(!Number(this.value)||($(this).val().length <4)){
//                
//                    $('#pin_error').css("display",'block');
//                    $('#pin_error').text('ENTER VALID NUMBERS');
//                    $('#pin_error').delay(2000).fadeOut('slow');
//               
//               
//            }
//        });

	//------------number pad starts
        $('.calculator_settle').click( function(event) {
           
		event.stopImmediatePropagation();
                $('#focusedtext').val('pin');
		var focused=$('#focusedtext').val();
               
		var calval=($(this).text());//alert(focused);alert(calval);
		
		var org=$('#'+focused).val();
			if(calval>=0)
			{
                            if(org.length < 4){
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
        
        $('.calculator_settle_back').click( function(event) {
            var str =$('#pin').val();
            str = str.substring(0, str.length - 1);
            $('#pin').val(str);
            input.innerHTML=$('#pin').val();
            $('#pin').focus();
        });
        
     
        //-------------number pad end
	/***************************************  reserve  starts ******************************************************************  */
	$('#reservetable').click(function () {
	  var msg5 = ($("#msg5").val());
          var msg1 = ($("#msg1").val());
	  var time=$('#timepicker1').val();
	  var reserve=(ConvertTimeformat("00:00", time));
	  //alert(timevalue)
	  var ids = new Array();
	  var input = document.querySelector('.screen');
	  var inputVal = input.innerHTML;
	  if(isNumeric(inputVal))
		{
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
		  if(ids!="")
		  {
			  var tablect=ids.length;
			  var type="";
			  if(tablect==1)
			  {
				  type="Single";
			  }
			  else if(tablect>1)
			  {
				  type="Group";
			  }
			  var persons=$('#personscount').val();
			  persons=persons.trim();
			  if($('#personscount').val()!="")
			  {
				   $.post("load_div.php", {tableid:ids,persons:persons,type:type,resrvtim:reserve,set:'reserve'},
					function(data)
					{
					data=$.trim(data);
					if(data.indexOf("exception") == -1)
					{
						  if(data==0)
						  {
								window.location="table_selection.php";
						  }
					}else
					{
						alert(data)
                                                
					}
										  
					});
			  }else
			  {
				  loaderrorvar.css("display",'block');
				  loaderrorvar.addClass("tableselection_validate");
				  loaderrorvar.text(msg5);
				  $('.loaderrorsel').delay(2000).fadeOut('slow');
				  $('#personscount').focus();
			  }
		  }else
		  {
			  loaderrorvar.css("display",'block');
			  loaderrorvar.addClass("tableselection_validate");
			  loaderrorvar.text(msg1);
			  $('.loaderrorsel').delay(2000).fadeOut('slow');
		  }
		}else
		{
			loaderrorvar.css("display",'block');
			loaderrorvar.addClass("tableselection_validate");
			loaderrorvar.text("Enter a valid persons count");
			$('.loaderrorsel').delay(2000).fadeOut('slow');
		}
		
	});
	/***************************************  reserve ends ******************************************************************  */	 
		
	/***************************************  dropdown change  starts *************************************************  */
	/*$('#menu').fancySelect().on('change', function() {
		  newSection = $('#' + $(this).val())
		  if (newSection.hasClass('current')) {
			  return;
		  }
		  $('section').removeClass('current');
		  newSection.addClass('current');

		  $('section:not(.current)').fadeOut(300, function() {
			  newSection.fadeIn(300);
		  });
    });*/
	/***************************************  dropdown change ends     *********************************************  */ 
	
	/***************************************  table change  starts ******************************************************************  */
	$('.changetableeach').click(function () {
		//hidchangprevid hidchangprevpx hidchangnewid hidchangnewpx
		
		var fromtable_id= $("#fromtable").find('option:selected').attr('tabid');
		var totable_id=$("#totable").find('option:selected').attr('tabid');
		
		var fromtable_pfx= $("#fromtable").find('option:selected').attr('prefx');
		var totable_pfx=$("#totable").find('option:selected').attr('prefx');
		
		if($("#fromtable").val()=="Select")
		{
			
			 $("#errorsetcahnge").css("display","block");
			 // $("#errorsetcahnge").addClass("billgenration_validate");
			  $("#errorsetcahnge").text("Select From Table");
			  $("#errorsetcahnge").delay(2000).fadeOut('slow');
		}else if($("#totable").val()=="Select")
		{
			$("#errorsetcahnge").css("display","block");
			 // $("#errorsetcahnge").addClass("billgenration_validate");
			  $("#errorsetcahnge").text("Select To Table");
			  $("#errorsetcahnge").delay(2000).fadeOut('slow');
		} else
		{
			$('#hidchangprevid').val(fromtable_id);
			$('#hidchangprevpx').val(totable_id); 
			$('#hidchangnewid').val(fromtable_pfx);
			$('#hidchangnewpx').val(totable_pfx);
			$('.confirmationpop_confrm').css('display','block');
			$('.confrmation_overlay').css('display','block');
                        
                        
                   var current_floor=$('.table_floor_select_btn_act').attr('fl_id_change');
                   var selected_floor=$('#floor_change_val').val();
                   
                   
                   if(current_floor == selected_floor){
                       var check_floor_sts='Y';
                   }else{
                      var check_floor_sts='N';  
                   }
                  $('#hid_ch_floor_id').val(check_floor_sts);
                  $('#hid_ch_floor_id_selected').val(selected_floor);
                       
		}
		
		/*$.post("load_div.php", {fromtable_id:fromtable_id,totable_id:totable_id,fromtable_pfx:fromtable_pfx,totable_pfx:totable_pfx,set:'changetable'},
			function(data)
			{
			  data=$.trim(data);
			  
			  loaderrorvar.css("display",'block');
			  loaderrorvar.addClass("tableselection_validate");
			  loaderrorvar.text(data);
			  $('.loaderrorsel').delay(2000).fadeOut('slow');
			  
			  $('#fromtable').find('option:first').attr('selected', 'selected');
			  $('#totable').find('option:first').attr('selected', 'selected');
			  document.getElementById('popDiv').style.display = 'none';
			});*/
		
	
	});
	/***************************************  table change  ends ******************************************************************  */
	/***************************************  table cancel  starts ******************************************************************  */
	$('.changetableeach_cancel').click(function () {
	$('.confirmationpop_confrm').css('display','none');
		$('.confrmation_overlay').css('display','none');
		$('#hidchangprevid').val('');
			$('#hidchangprevpx').val(''); 
			$('#hidchangnewid').val('');
			$('#hidchangnewpx').val('');
		document.getElementById('popDiv').style.display = 'none';
	});
	/***************************************  table cancel  ends ******************************************************************  */
	/***************************************  table cancel  starts ******************************************************************  */
	$('.changecancel').click(function () {
		$('.confirmationpop_confrm').css('display','none');
		$('.confrmation_overlay').css('display','none');
		$('#hidchangprevid').val('');
			$('#hidchangprevpx').val(''); 
			$('#hidchangnewid').val('');
			$('#hidchangnewpx').val('');
		//document.getElementById('popDiv').style.display = 'none';
	});
	/***************************************  table cancel  ends ******************************************************************  */
	/***************************************  table ok  starts ******************************************************************  */
	$('.changeok').click(function () {
		
		  var fromtable_id= $('#hidchangprevid').val();
		  var totable_id= $('#hidchangprevpx').val(); 
		  var fromtable_pfx= $('#hidchangnewid').val();
		  var totable_pfx= $('#hidchangnewpx').val();
                  
                  
                  var hid_ch_floor_id=$('#hid_ch_floor_id').val();
                  
                    var floor
                  if(hid_ch_floor_id=='Y'){
                       floor='no';
                      
                  }else{
                       floor=$('#hid_ch_floor_id_selected').val();
                  }
                  
                 
		  var hidproc_tablechange_changed= $('#hidproc_tablechange_changed').val();
		  var hidproc_tablechange_parcel= $('#hidproc_tablechange_parcel').val();
                  
                  
               
                  
		$.post("load_div.php", {fromtable_id:fromtable_id,totable_id:totable_id,fromtable_pfx:fromtable_pfx,totable_pfx:totable_pfx,floor:floor,set:'changetable'},
			function(data)
			{
			  data=$.trim(data);
			 
			  loaderrorvar.css("display",'block');
			  loaderrorvar.addClass("tableselection_validate");
			  if(data=="Table has been changed")
			  {
                        $('.alert_error_popup_all_in_one').show();
                        $('.alert_error_popup_all_in_one').text('Table Changed Suscessfully');
                        $('.alert_error_popup_all_in_one').delay(2000).fadeOut('slow');
                      
                        
                                
                                //alert('Table Changed Sucessfully');
				  loaderrorvar.text(hidproc_tablechange_changed);
			  }else if(data=="Table is Parcel")
			  {
                              $('.alert_error_popup_all_in_one').show();
                        $('.alert_error_popup_all_in_one').text('Cant Change . Table is Parcel Table');
                        $('.alert_error_popup_all_in_one').delay(2000).fadeOut('slow');
                              
                              //alert('Cant Change . Table is Parcel Table');
				  loaderrorvar.text(hidproc_tablechange_parcel);
			  }
			  
			  $('.loaderrorsel').delay(2000).fadeOut('slow');
			  
			  $('#fromtable').find('option:first').attr('selected', 'selected');
			  $('#totable').find('option:first').attr('selected', 'selected');
			  $('.confirmationpop_confrm').css('display','none');
			 $('.confrmation_overlay').css('display','none');
			 $('#hidchangprevid').val('');
			$('#hidchangprevpx').val(''); 
			$('#hidchangnewid').val('');
			$('#hidchangnewpx').val('');
			  document.getElementById('popDiv').style.display = 'none';
			  $('#load_tables').load('load_div.php?tab=&set=summary');
			  $('#loadfromtable').load('load_div.php?set=fromtable');
			  $('#loadtotable').load('load_div.php?set=totable');
			 
                         
                          setTimeout(function(){
                           window.location.href='table_selection.php';
                            
                        }, 1500); 
                         
			});
	});
	/***************************************  table ok  ends ******************************************************************  */
	
	/***************************************  clear assigned   starts ******************************************************************  */
	$('.clearallassigned').click(function () {
            
            $('.confirmationpop_clear').css('display','block');
			$('.confrmation_overlay').css('display','block');
            
            //alert('1');
//            $.post("load_div.php", {set:'clearallasigned'},
//                function(data)
//                {
//
//                });
//		if($('.buttons').hasClass('clickdiableinuse'))
//		{ 
//			$('.confirmationpop_clear').css('display','block');
//			$('.confrmation_overlay').css('display','block');
//		}else
//		{
//			 $('.loaderrorsel').css("display",'block');
//			 $('.loaderrorsel').addClass("tableselection_validate");
//			 $('.loaderrorsel').text('Select Table');
//			 $('.loaderrorsel').delay(2000).fadeOut('slow');
//			
//		}
                 
	});
	/***************************************  clear assigned ends ******************************************************************  */
	
	/***************************************  clear assigned  ok  starts ******************************************************************  */
	$('.yesclear').click(function () {
		
		$('.confirmationpop_clear').css('display','none');
		$('.confrmation_overlay').css('display','none');
	
	 $.post("load_div.php", {set:'clearallasigned'},
	  function(data)
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
	  
							
	  });
	
	});
	/***************************************  clear assigned ok ends ******************************************************************  */
	
	/***************************************  clear assigned  no  starts ******************************************************************  */
	$('.noclear').click(function () {
		
		$('.confirmationpop_clear').css('display','none');
		$('.confrmation_overlay').css('display','none');
	
	
	
	});
	/***************************************  clear assigned no ends ******************************************************************  */
	
	/***************************************  KOT refresh   starts ******************************************************************  */
	
		 $('.refreshkot').click(function () {
		  $.post("autoload_menu.php", {set:'korprintrefresh'},
			  function(data)
			  {
				  data=$.trim(data);
				  
				  var kot=data.split(',');
				  var legth=kot.length;
				  for(var i=0;i<legth;i++)
				  {
				  var kt=kot[i];
				  $.post("print_details.php", {kot:kt,set:'kotprint',check:'kotmissed'},
					  function(data1)
					  {
					  data1=$.trim(data1);
					  
					  });	
			  }
			  });	
		}); 
	
	
	/***************************************   KOT refresh ends ******************************************************************  */
	
});
$(document).unbind().keyup(function(e){
     e.preventDefault();
    if (e.keyCode == 27) {
        if($('.take_order_staff_sel_popup:visible').length == 1)
            {   
                 $('.take_order_staff_sel_popup').css("display","none");
                $(".confrmation_overlay").css("display","none");
            }
        if($('#popDiv:visible').length == 1)
            {   
                 $('#popDiv').css("display","none");
                $(".confrmation_overlay").css("display","none");
            }
        if($('.confirmationpop_clear:visible').length == 1)
            {   
                 $('.confirmationpop_clear').css("display","none");
                $(".confrmation_overlay").css("display","none");
            } 
        if($('.print-bill-in-tableselection-popup:visible').length == 1 && $('.kotcancel_reason_popup_new:visible').length == 0)
            {   
                 $('.print-bill-in-tableselection-popup').css("display","none");
                $(".print-bill-in-tableselection-popup-cc").css("display","none");
            }    
        if($('.kotcancel_reason_popup_new:visible').length == 1)
            {   
                 $('.kotcancel_reason_popup_new').css("display","none");
                $(".confrmation_overlay_new").css("display","none");
               
            }     
    }
});
function ConvertTimeformat(format, str) {
	var time = str.split(":");
    var hours = Number(time[0]);
    var minutes = Number(time[1]);
    var AMPM = time[2].trim();
    var pm = ['P', 'p', 'PM', 'pM', 'pm', 'Pm'];
    var am = ['A', 'a', 'AM', 'aM', 'am', 'Am'];
    if (pm.indexOf(AMPM) >= 0 && hours < 12) hours = hours + 12;
    if (am.indexOf(AMPM) >= 0 && hours == 12) hours = hours - 12;
    var sHours = hours.toString();
    var sMinutes = minutes.toString();
    if (hours < 10) sHours = "0" + sHours;
    if (minutes < 10) sMinutes = "0" + sMinutes;
    if (format == '0000') {
        return (sHours + sMinutes);
    } else if (format == '00:00') {
        return (sHours + ":" + sMinutes + ":00" );
    } else {
        return false;
    }
}

	 