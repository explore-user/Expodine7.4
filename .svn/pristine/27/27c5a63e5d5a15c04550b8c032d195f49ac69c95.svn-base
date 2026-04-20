// JavaScript Document
$(document).ready(function(){
	
	/*************************************** category selection  starts *************************************************  */
	$('.holdview_each').click(function (event) {
		//e.preventDefault();
		event.stopImmediatePropagation();
		
		var bil=$(this).attr('bilno');
		//alert(bil);
		 var request = $.ajax({
					url: "popup/view_hold.php",
					method: "POST",
					data: {bilno:bil},
					dataType: "html"
				  });
				   
				  request.done(function( msg ) {//alert(msg);
					$( "#load_holdlist" ).html( msg );
					//$('.countergenerate').css("display","block");
				  });
				  
				  data = null;
					msg=null;
				  request.onreadystatechange = null;
				  request.abort = null;
				  request = null;
		

  });
	/***************************************  category selection  ends *************************************************  */
	
	$('.holdview_each_tr').click(function (event) {
		//e.preventDefault();
		event.stopImmediatePropagation();
		if($(this).hasClass('payment_hol_act'))
		{
			$(this).removeClass('holdview_each_tr');
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
					
					$('#load_holdlist').css("display","block");
                                        $(".confrmation_overlay").css("display","block");
                                        $( "#load_holdlist" ).html( msg );
				  });
				  
				  data = null;
					msg=null;
				  request.onreadystatechange = null;
				  request.abort = null;
				  request = null;
                
                
                
                
            }
		
	});	
	
 $(".holdlistcheck").on('click', function() {
				  var $box = $(this);
				  if ($box.is(":checked")) {
						$('.holdview_each_tr').addClass('payment_hol_act')  
				  }else
				  {
					  $('.holdview_each_tr').removeClass('payment_hol_act') 
				  }
});

$('.deleteallselecthold').click(function (event) {
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
        
$(".deleteholdallok").click(function(event){
	 var holdno=new Array();
				 var selected_activities =$(".payment_hol_act");
				  selected_activities.each(function(){
					var id_str       =  $(this).attr("bilno");
					if(id_str!='undefined' && id_str!='' && id_str!=null){
							holdno.push(id_str);
						}
				  });//alert(holdno);
				  
				  var request = $.ajax({
					url: "load_counter_sales.php",
					method: "POST",
					data: {value:'deletehold_all',bilno:holdno},
					dataType: "html"
				  });
				   
				  request.done(function( msg ) {
					
					window.location="counter_sales.php";
					
				  });
				  
				  data = null;
					msg=null;
				  request.onreadystatechange = null;
				  request.abort = null;
				  request = null;
			
	});
        
$(".deleteholdallccl").click(function(event){
	
			$("#deleteallhold").css("display","none");
			$(".confrmation_overlay").css("display","none");
});

$(".deletfromholdlist").click(function(event){
	
			$("#deletehold").css("display","block");
			$(".confrmation_overlay").css("display","block");
                         $('.delete_con_pop').show();
	}); 
        
$(".deleteholdok").click(function(event){
	var bil=$('.hidbilno').val();
			event.stopImmediatePropagation();
			
			var request = $.ajax({
					url: "load_counter_sales.php",
					method: "POST",
					data: {value:'deletehold',bilno:bil},
					dataType: "html"
				  });
				   
				  request.done(function( msg ) {
					//$( ".counter_menu_popup" ).html( msg );
					window.location="counter_sales.php";
					
				  });
				  
				  data = null;
					msg=null;
				  request.onreadystatechange = null;
				  request.abort = null;
				  request = null;
	});
        
$(".deleteholdccl").click(function(event){
            
            
            $('.delete_con_pop').hide();
            
	});	
	

	$(".revertholdccl").click(function(event){
		$("#reverthold").css("display","none");
			$(".confrmation_overlay").css("display","none");
	});	
	
        
	$(".addlisttomainlist_cs").click(function(event){
	
		var bil=$('.hidbilno').val();
			event.stopImmediatePropagation();
			
			var request = $.ajax({
					url: "load_counter_sales.php",
					method: "POST",
					data: {value:'releasehold',bilno:bil},
					dataType: "html"
				  });
				   
				  request.done(function( msg ) {
					//$( ".counter_menu_popup" ).html( msg );
					window.location="counter_sales.php";
					
				  });
				  
				  data = null;
					msg=null;
				  request.onreadystatechange = null;
				  request.abort = null;
				  request = null;	
	
	});
        
$(".maincloseholdlist").click(function(){
            $('.holdview_each_tr').removeClass('payment_hol_act');
			$("#load_holdlist").css("display","none");
			$(".right_top_action_btn").css("display","block");
			$(".counter_menu_popup_overlay").css("display","none");
                        
                         $('.holdlistcheck').prop('checked', false); 
});
		
});