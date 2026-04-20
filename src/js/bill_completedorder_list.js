// JavaScript Document
$(document).ready(function(){
	

 /*************************************** delete table starts *********************************************************  */  
	  $('.deletetablefromlist').click(function () {
           
	   var orderlist       =  $(this).attr("orderlist");
	   $('.clickeachrowcompld').filter('[ordno="'+orderlist+'"]').removeClass('tr_bill_gen_active');
	 // $('.listorderlist tr').filter('[listorders="'+orderlist+'"]').remove();
	 
	 
	  var selected_activities =$('.tr_bill_gen_active');
			 var ordno = new Array(); 
			
			 selected_activities.each(function(){
			  var id_str       =  $(this).attr("ordno");
				  if(id_str!='undefined' && id_str!='' && id_str!=null){
					  ordno.push(id_str);
				  }
		
			});
			ordno=unique(ordno) 
			//alert(ordno)
			$('.loadcancel').css("display","block");
			 $('.loadtotal').css("display","block");
			$('#listwholedetailslist').load("load_completedorder.php?set=loadbillwholelist_co&ordno="+ordno);	
			$('.loadproceedbutton').css("display","block");
			
	  
	  }); 
	  
	  /*************************************** delete table ends ***********************************************************  */
	  
	  /*************************************** close popup starts *********************************************************  */  
	  $('.closepopup').click(function () {
		  
		  $('.confrimcancel').css('display','none');
		   $('.confrimenable').css('display','none');
		   $('.confrimeachcancel').css('display','none');
		   $('.loadcanceldetails').css('display','none');
		  $('.confrmation_overlay').css('display','none');
		  
	 }); 
	  
	  /***************************************  close popup ends ***********************************************************  */	
	    
		 /*************************************** close popup starts *********************************************************  */  
	  $('.closepopup_noeach').click(function () {
		  
		  $('.confrimcancel').css('display','none');
		   $('.confrimenable').css('display','none');
		   $('.confrimeachcancel').css('display','none');
		   $('.loadcanceldetails').css('display','none');
		  $('.confrmation_overlay').css('display','none');
		  
		   var selected_activities =$('.tr_bill_gen_active');
			 var ordno = new Array(); 
			
			 selected_activities.each(function(){
			  var id_str       =  $(this).attr("ordno");
				  if(id_str!='undefined' && id_str!='' && id_str!=null){
					  ordno.push(id_str);
				  }
		
			});
			ordno=unique(ordno) 
			//alert(ordno)
			$('.loadcancel').css("display","block");
			 $('.loadtotal').css("display","block");
			$('#listwholedetailslist').load("load_completedorder.php?set=loadbillwholelist_co&ordno="+ordno);	
			$('.loadproceedbutton').css("display","block");
		  
	 }); 
	  
	  /***************************************  close popup ends ***********************************************************  */	
		
		 /*************************************** close popupcancel starts *********************************************************  */  
	  $('.closepopup').click(function () {
		 $('.confrimcancel').css('display','none');
		   $('.confrimenable').css('display','none');
		   $('.confrimeachcancel').css('display','none');
		   $('.loadcanceldetails').css('display','none');
		  $('.confrmation_overlay').css('display','none');
		  
		   var selected_activities =$('.tr_bill_gen_active');
			 var ordno = new Array(); 
			
			 selected_activities.each(function(){
			  var id_str       =  $(this).attr("ordno");
				  if(id_str!='undefined' && id_str!='' && id_str!=null){
					  ordno.push(id_str);
				  }
		
			});
			ordno=unique(ordno) 
			//alert(ordno)
			$('.loadcancel').css("display","block");
			 $('.loadtotal').css("display","block");
			$('#listwholedetailslist').load("load_completedorder.php?set=loadbillwholelist_co&ordno="+ordno);	
			$('.loadproceedbutton').css("display","block");
			
			
			$('#hid_menuchange').val('');
			$('#hid_portchange').val('');
			$('#hid_kotchange').val('');
			$('#hid_ordchange').val('');
			$('#hid_final').val('');
			
		}); 
	  
	  /***************************************  close popupcancel ends ***********************************************************  */	
	  
	   /*************************************** show detailspop starts *********************************************************  */  
	  $('.canceleachitems').click(function () {
		  if($('#hidcancelsecret').val()=="Y")
		  {
			$('.loadcanceldetails').css('display','block');
			$('.confrimcancel').css('display','none');
			$('.confrimenable').css('display','none');
			$('.confrimeachcancel').css('display','none');
			$('.confrmation_overlay').css('display','block');
		  
		  }else
		  {
			$('.loadcanceldetails').css('display','none');
			$('.confrimcancel').css('display','none');
			$('.confrimenable').css('display','none');
			$('.confrimeachcancel').css('display','none');
			$('.confrmation_overlay').css('display','none');  
			$('.submitcancelation').click();
		  }
		  
		  	  
	 }); 
	  
	  /***************************************  show detailspop ends ***********************************************************  */
	  
	    
	  

	  	
	   /*************************************** delete item starts *********************************************************  */  
	  $('.deleteeachitembill').click(function () {
		  
		  $('.confrimcancel').css('display','block');
		  $('.confrmation_overlay').css('display','block');
		  
		  var ordernumber       =  $(this).attr("ordernumber");
		  var kotno       	  =  $(this).attr("kotno");
		  var slno       		  =  $(this).attr("slno");
		  var menuid       	  =  $(this).attr("menuid");
		  var qty       		  =  $(this).attr("qty");
		  
		  $('#hidordernumber').val(ordernumber);
		  $('#hidkotno').val(kotno);
		  $('#hidslno').val(slno);
		  $('#hidmenuid').val(menuid);
		  $('#hidqty').val(qty);
		  		
	   }); 
	  
	  /*************************************** delete item ends ***********************************************************  */
	  
	  
	   /*************************************** delete item starts *********************************************************  */  
	  $('.cancelitems').click(function () {
		  
		  $('.confrimcancel').css('display','none');
		  $('.confrmation_overlay').css('display','none');
		  if($('#hidcancelsecretsinlgeauth').val()=="N")
		  {
		  		  
	   		var ordernumber       =  $('#hidordernumber').val();
	   		var kotno       	  =  $('#hidkotno').val();
		 	var slno       		  =  $('#hidslno').val();
			var menuid       	  =  $('#hidmenuid').val();
			var qty       		  =  $('#hidqty').val();
			var itemcclmsg=$('#itemcclmsg').val();
			 $.post("load_completedorder.php", {st:"cancel",menu:menuid,sln:slno,kot:kotno,qty:qty,ordernumber:ordernumber,set:'deleteachitem'},
			  function(data)
			  {
			  data=$.trim(data);
			  
				var selected_activities =$('.tr_bill_gen_active');
				var ordno = new Array(); 
				selected_activities.each(function(){
					var id_str       =  $(this).attr("ordno");
					if(id_str!='undefined' && id_str!='' && id_str!=null){
					ordno.push(id_str);
					}
				});
				ordno=unique(ordno) 
				$('.loadcancel').css("display","block");
				$('.loadtotal').css("display","block");
				$('#listwholedetailslist').load("load_completedorder.php?set=loadbillwholelist_co&ordno="+ordno);	
				$('.loadproceedbutton').css("display","block");
				$('#hidordernumber').val('');
				$('#hidkotno').val('');
				$('#hidslno').val('');
				$('#hidmenuid').val('');
				$('#hidqty').val('');
				$(".error_feed").css("display","block");
				$(".error_feed").addClass("billgenration_validate");
				$(".error_feed").text(itemcclmsg);
				$(".error_feed").delay(2000).fadeOut('slow');
			  });
		  }else
		  {
			  $('.loadsinglecancelauth').css('display','block');
		 	 $('.confrmation_overlay').css('display','block');
		  }
	   }); 
	  
	  /*************************************** delete item ends ***********************************************************  */
	  
	   /***************************************  staff starts ******************************************************************  */
   $('#stafflist_sca').change(function () {
		var stafflist       = $("#stafflist_sca").find('option:selected').attr('cancelkey');//alert(stafflist);
		//alert(stafflist)
		if(stafflist=='Y')
		{
			$(' #typeentery ').text('OTP');
			$(' .btn_index_popup_send ').css('display','block');
			$(' .btn_index_popup_send a').css('display','block');
		}else
		{
			$(' #typeentery ').text('Password');
			$(' .btn_index_popup_send').css('display','none');
			$(' .btn_index_popup_send a').css('display','block');
		}
		/*$.post("load_bill_history.php", {stafflist:stafflist,set:'sendotp'},
			function(data)
			{
			data=$.trim(data);
			//alert(data);
			});*/
	 
	 
	 });
	 /***************************************  staff ends ******************************************************************  */
	   /*************************************** delete item auth close starts *********************************************************  */  
	  $('.closepopupauth').click(function () {
		  
		  $('.loadsinglecancelauth').css('display','none');
		  $('.confrmation_overlay').css('display','none');
	  }); 
	 /*************************************** delete item   auth close ends *********************************************************  */   
	   /*************************************** delete item auth ok starts *********************************************************  */  
	  $('.submitsinglecancelauth').click(function () {
		  
		 

		var reasontext       =  $('#reasontext_sca').val();
		var secretkey        =  $('#secretkey_sca').val();
		var stafflist        =  $('#stafflist_sca').val();
		
		
		 $.post("load_bill_history.php", {secretkey:secretkey,stafflist:stafflist,set:'secretkeycheck'},
			function(data)
			{
			data=$.trim(data);
			if(data=="ok")
			{ 
			 $('.loadsinglecancelauth').css('display','none');
		 	 $('.confrmation_overlay').css('display','none'); 
				 var stafflist=($('#stafflist_sca').val())
				 
				 var ordernumber       =  $('#hidordernumber').val();
				var kotno       	  =  $('#hidkotno').val();
				var slno       		  =  $('#hidslno').val();
				var menuid       	  =  $('#hidmenuid').val();
				var qty       		  =  $('#hidqty').val();
				
				var itemcclmsg=$('#itemcclmsg').val();
				 $.post("load_completedorder.php", {st:"cancel",menu:menuid,sln:slno,kot:kotno,qty:qty,ordernumber:ordernumber,auth:"set",reasontext:reasontext,secretkey:secretkey,stafflist:stafflist,set:'deleteachitem'},
				  function(data)
				  {
				  data=$.trim(data);
				  
					var selected_activities =$('.tr_bill_gen_active');
					var ordno = new Array(); 
					selected_activities.each(function(){
						var id_str       =  $(this).attr("ordno");
						if(id_str!='undefined' && id_str!='' && id_str!=null){
						ordno.push(id_str);
						}
					});
					ordno=unique(ordno) 
					$('#reasontext_sca').val('');
					$('#secretkey_sca').val('');
					$('#stafflist_sca').find('option:first').attr('selected', 'selected');
					$('.loadcancel').css("display","block");
					$('.loadtotal').css("display","block");
					$('#listwholedetailslist').load("load_completedorder.php?set=loadbillwholelist_co&ordno="+ordno);	
					$('.loadproceedbutton').css("display","block");
					$('#hidordernumber').val('');
					$('#hidkotno').val('');
					$('#hidslno').val('');
					$('#hidmenuid').val('');
					$('#hidqty').val('');
					$(".error_feed").css("display","block");
					$(".error_feed").addClass("billgenration_validate");
					$(".error_feed").text(itemcclmsg);
					$(".error_feed").delay(2000).fadeOut('slow');
				  });
				 
				 
			}else
			{
				var tp='';
				var stafflist       = $("#stafflist_sca").find('option:selected').attr('cancelkey');//alert(stafflist);
				if(stafflist=='Y')
				{
					tp='OTP';
				}else
				{
					tp='Password';
				}
				$("#deatilserror_sca").css("display","block");
				$("#deatilserror_sca").text(tp+" Error!!");
				$("#deatilserror_sca").delay(2000).fadeOut('slow');
			}
		  }); 
	  }); 
	 /*************************************** delete item   auth ok ends *********************************************************  */   
	 
	 
	   /*************************************** enable item  starts *********************************************************  */  
	  $('.enabledeleteditembill').click(function () {
		  
		  $('.confrimenable').css('display','block');
		  $('.confrmation_overlay').css('display','block');
		  
		  var ordernumber       =  $(this).attr("ordernumber");
		  var kotno       	  =  $(this).attr("kotno");
		  var slno       		  =  $(this).attr("slno");
		  var menuid       	  =  $(this).attr("menuid");
		  var qty       		  =  $(this).attr("qty");
		  
		  $('#hidordernumber').val(ordernumber);
		  $('#hidkotno').val(kotno);
		  $('#hidslno').val(slno);
		  $('#hidmenuid').val(menuid);
		  $('#hidqty').val(qty);
		  		
	   }); 
	  
	  /*************************************** enable item ends ***********************************************************  */
	  
	  
	   /*************************************** delete item starts *********************************************************  */  
	  $('.enableitems').click(function () {
	   		 $('.confrimenable').css('display','none');
		    $('.confrmation_overlay').css('display','none');
		  		  
	   		var ordernumber       =  $('#hidordernumber').val();
	   		var kotno       	  =  $('#hidkotno').val();
		 	var slno       		  =  $('#hidslno').val();
			var menuid       	  =  $('#hidmenuid').val();
			var qty       		  =  $('#hidqty').val();
			var remmsg=$('#removcclmsg').val();
			
			 $.post("load_completedorder.php", {st:"enable",menu:menuid,sln:slno,kot:kotno,qty:qty,ordernumber:ordernumber,set:'deleteachitem'},
			  function(data)
			  {
				  data=$.trim(data);
				  var selected_activities =$('.tr_bill_gen_active');
				  var ordno = new Array(); 
				  selected_activities.each(function(){
					  var id_str       =  $(this).attr("ordno");
					  if(id_str!='undefined' && id_str!='' && id_str!=null){
					  ordno.push(id_str);
					  }
				  });
				  ordno=unique(ordno) 
				  $('.loadcancel').css("display","block");
				  $('.loadtotal').css("display","block");
				  $('#listwholedetailslist').load("load_completedorder.php?set=loadbillwholelist_co&ordno="+ordno);	
				  $('.loadproceedbutton').css("display","block");
				  $('#hidordernumber').val('');
				$('#hidkotno').val('');
				$('#hidslno').val('');
				$('#hidmenuid').val('');
				$('#hidqty').val('');
				$(".error_feed").css("display","block");
				$(".error_feed").addClass("billgenration_validate");
				$(".error_feed").text(remmsg);
				$(".error_feed").delay(2000).fadeOut('slow');
			  });
		
	   }); 
	  
	  /*************************************** delete item ends ***********************************************************  */
	  
	  
	  
	    /***************************************  ok click starts ******************************************************************  */
 	  
     
  
	 /***************************************  ok click ends ******************************************************************  */
	  
	  
	  
	  
	  
	  
});




