// JavaScript Document
$(document).ready(function(){
	
	/*************************************** category selection  starts *************************************************  */
	$('.holdview_each').click(function (event) {alert("hw");//load_counter_sales.php
		//e.preventDefault();
		event.stopImmediatePropagation();
		
		var bil=$(this).attr('bilno');
                  var mode=$(this).attr('mode');
                  
		alert(mode);
		 var request = $.ajax({
					url: "popup/view_hold.php",
					method: "POST",
					data: {bilno:bil},
					dataType: "html"
				  });
				   
				  request.done(function( msg ) {//alert(msg);
					$( "#load_ta_holdlist" ).html( msg );
					//$('.countergenerate').css("display","block");
				  });
				  
				  data = null;
					msg=null;
				  request.onreadystatechange = null;
				  request.abort = null;
				  request = null;
		

  });
	/***************************************  category selection  ends *************************************************  */
	
	$('.holdview_each_tr').click(function (event) {//alert("h");//load_counter_sales.php
		//e.preventDefault();
		event.stopImmediatePropagation();
		if($(this).hasClass('payment_hol_act'))
		{
			$(this).removeClass('payment_hol_act');
		}else
		{
			$(this).addClass('payment_hol_act');
                        var bil=$(this).attr('bilno');
                  var mode=$(this).attr('mode');
                  
		
		 var request = $.ajax({
					url: "popup/view_hold.php",
					method: "POST",
					data: {bilno:bil,mode:mode},
					dataType: "html"
				  });
				   
				  request.done(function( msg ) {//alert(msg);
                                      $('#load_ta_holdlist').css("display","block");
                                        $(".confrmation_overlay").css("display","block");
					$( "#load_ta_holdlist" ).html( msg );
					//$('.countergenerate').css("display","block");
				  });
				  
				  data = null;
					msg=null;
				  request.onreadystatechange = null;
				  request.abort = null;
				  request = null;
		}
                
                
                
                
                
		
	});	
	
	$(".holdlistcheck").on('click', function() {//alert("g");//input:checkbox
				  var $box = $(this);
				  if ($box.is(":checked")) {
						$('.holdview_each_tr').addClass('payment_hol_act')  
				  }else
				  {
					  $('.holdview_each_tr').removeClass('payment_hol_act') 
				  }
	});
	$('.deleteallselecthold').click(function (event) {//alert("h");//load_counter_sales.php
		//e.preventDefault();
		event.stopImmediatePropagation();
		
		if($('.holdview_each_tr').hasClass('payment_hol_act'))
		{
			
			$("#deleteallhold").css("display","block");
			$(".confrmation_overlay").css("display","block");
		}else
		{
			$('.ta_errormsg').css("display",'block');
			  $('.ta_errormsg').text("Nothing to delete...");
			  $('.ta_errormsg').delay(2000).fadeOut('slow');
		}
		
		
		
		
	
	});
	$(".deleteholdallok").click(function(event){//alert("h");
	 var holdno=new Array();
				 var selected_activities =$(".payment_hol_act");
				  selected_activities.each(function(){
					var id_str       =  $(this).attr("bilno");
					if(id_str!='undefined' && id_str!='' && id_str!=null){
							holdno.push(id_str);
						}
				  });//alert(holdno);
				  
				  var request = $.ajax({
					url: "load_takeaway.php",
					method: "POST",
					data: {value:'deletehold_all',bilno:holdno},
					dataType: "html"
				  });
				   
				  request.done(function( msg ) {//alert(msg);
					//$( ".counter_menu_popup" ).html( msg );
					window.location="take_away_.php";
                                        
					
				  });
				  
				  data = null;
					msg=null;
				  request.onreadystatechange = null;
				  request.abort = null;
				  request = null;
			
	});
	$(".deleteholdallccl").click(function(event){//alert("h");
	
			$("#deleteallhold").css("display","none");
			$(".confrmation_overlay").css("display","none");
	});
	$(".deletfromholdlist").click(function(event){//alert("h");
	
			$("#deletehold").css("display","block");
			$(".confrmation_overlay").css("display","block");
	});
	$(".deleteholdok").click(function(event){
	var bil=$('.hidbilno').val();
			event.stopImmediatePropagation();
		
			var request = $.ajax({
					url: "load_takeaway.php",
					method: "POST",
					data: {value:'deletehold',bilno:bil},
					dataType: "html"
				  });
				   
				  request.done(function( msg ) {//alert(msg);
					//$( ".counter_menu_popup" ).html( msg );
					window.location="take_away_.php";
					
				  });
				  
				  data = null;
					msg=null;
				  request.onreadystatechange = null;
				  request.abort = null;
				  request = null;
	});
	$(".deleteholdccl").click(function(event){
		$("#deletehold").css("display","none");
			$(".confrmation_overlay").css("display","none");
                        
                        $("#load_ta_holdlist").css("display","block");
			$(".right_top_action_btn").css("display","block");
			$(".confrmation_overlay").css("display","block");
                        
	});	
        
       
	
//	$(".revertholdok").click(function(event){
//	//var bil=$(this).attr('bilno');
//	var bil=$('.hidbilno').val();
//			event.stopImmediatePropagation();
//			
//			var request = $.ajax({
//					url: "load_takeaway.php",
//					method: "POST",
//					data: {value:'releasehold',bilno:bil},
//					dataType: "html"
//				  });
//				   
//				  request.done(function( msg ) {//alert(msg);
//					//$( ".counter_menu_popup" ).html( msg );
//					window.location="take_away_.php";
//					
//				  });
//				  
//				  data = null;
//					msg=null;
//				  request.onreadystatechange = null;
//				  request.abort = null;
//				  request = null;
//	});
        
       
        
	$(".revertholdccl").click(function(event){
		$("#reverthold").css("display","none");
			$(".confrmation_overlay").css("display","none");
                        
                        $("#load_ta_holdlist").css("display","block");
			$(".right_top_action_btn").css("display","block");
			$(".confrmation_overlay").css("display","block");
	});	
	
	$(".addlisttomainlist_ta").click(function(event){
	
//			$("#reverthold").css("display","block");
//			$(".confrmation_overlay").css("display","block");
			
		var bil=$('.hidbilno').val();
			event.stopImmediatePropagation();
			
			var request = $.ajax({
					url: "load_takeaway.php",
					method: "POST",
					data: {value:'releasehold',bilno:bil},
					dataType: "html"
				  });
				   
				  request.done(function( msg ) {//alert(msg);
					//$( ".counter_menu_popup" ).html( msg );
					window.location="take_away_.php";
					
				  });
				  
				  data = null;
					msg=null;
				  request.onreadystatechange = null;
				  request.abort = null;
				  request = null;	
	});
	$(".maincloseholdlist").click(function(){//alert("t");
			$("#load_ta_holdlist").css("display","none");
			$(".right_top_action_btn").css("display","block");
			$(".confrmation_overlay").css("display","none");
                        
                      $('.holdlistcheck').prop('checked', false); 
		});
                $(".deletfromholdlist").click(function(event){//alert("h");
	
			$("#deletehold").css("display","block");
			$(".confrmation_overlay").css("display","block");
	});
		
});